<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formfrmfss317_15 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $CI        = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);

        $frmkode   = $this->uri->segment(4);
        $frmvrs    = $this->uri->segment(5);

        $this->load->model(array('M_user', 'M_menu', 'tambahan/M_tambahan', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->library(array('table', 'form_validation', 'excel', 'image_lib'));
        $this->load->helper(array('form', 'url', 'html', 'file', 'path'));

        $this->model = $this->{'M_form' . $frmkode . '_' . $frmvrs};

        //////////////////////////////////
        /// prevent direct url accses
        $session_data = $this->session->userdata('logged_in');
        $leveluid     = $session_data['leveluserid'];
        $url_str      = uri_string();

        $akses_check = $this->M_user->check_akses_bylevelid($leveluid, $frmkode);
        if ($akses_check == false) {
            echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini..!!');
            window.location.assign('";
            echo base_url();
            echo "C_login');
            </script>";
            exit;
        }
        /// end prevent direct url accses
        //////////////////////////////////
    }

    function get_docno()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $create_date  = $this->input->post('create_date');

            $dthasil      = $this->model->get_docno(date("m", strtotime($create_date)), date("Y", strtotime($create_date)));

            $last_docno   = !empty($dthasil->vdocno) ? $dthasil->vdocno + 1 : 1;

            $arr_bulan    = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            $docno        = 'LH/WTD/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' .  date("d", strtotime($create_date));

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil!",
                'data'    => $docno,
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_forminput()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data       = $this->session->userdata('logged_in');
            $create_date        = date("Y-m-d", strtotime($this->input->post('create_date')));
            $tgl_kemarin        = date('Y-m-d', strtotime($create_date . "-1 days"));
            $persen             = $this->input->post('persen');
            // print_r($persen);
            // die;

            $result_frmfss315   = $this->model->get_frmfss315($create_date, $persen);
            $result_frmfss316   = $this->model->get_frmfss316($create_date);
            $result_frmfss317   = $this->model->get_frmfss317_wtd($create_date);
            $result_frmfss317_f = $this->model->get_frmfss317_f_akumulatif($create_date);
            $result_intwtd014   = $this->model->get_intwtd014($create_date);
            $result_operasi_jam = $this->model->get_frmfss317_operasi_jam($create_date);
            $stok_air           = $this->model->get_list_data_kemarin_stok_air($tgl_kemarin);
            $result_frmfss520   = $this->model->get_frmfss520($create_date);

            if (!empty($result_frmfss315) || !empty($result_frmfss316) || !empty($result_frmfss520) || !empty($result_frmfss317)) {
                $pesan = "Berhasil mengambil data!";
                $pesan .= !empty($result_frmfss315) ? "\n FRM-FSS-315 ✔" : "\n FRM-FSS-315 ✘";
                $pesan .= !empty($result_frmfss316) ? "\n FRM-FSS-316 ✔" : "\n FRM-FSS-316 ✘";
                $pesan .= !empty($result_frmfss520) ? "\n FRM-FSS-520 ✔" : "\n FRM-FSS-520 ✘";
                $pesan .= !empty($result_intwtd014) ? "\n INT-WTD-014 ✔" : "\n INT-WTD-014 ✘";

                $result = [
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => $pesan,
                    'data'    => [
                        'result_frmfss315'   => $result_frmfss315,
                        'result_frmfss316'   => $result_frmfss316,
                        'result_frmfss317'   => $result_frmfss317,
                        'result_frmfss317_f'   => $result_frmfss317_f,
                        'stok_air'           => $stok_air,
                        'result_operasi_jam' => $result_operasi_jam,
                        'result_frmfss520'   => $result_frmfss520,
                        'result_intwtd014'   => $result_intwtd014,
                    ],
                ];
            } else {
                $result = [
                    'status'  => 1,
                    'vstatus' => 'error',
                    'pesan'   => "Gagal, data belum tersedia!",
                ];
            }

            echo json_encode($result);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function form()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data                     = $this->session->userdata('logged_in');
            $data['userid']                   = $session_data['userid'];
            $data['username']                 = $session_data['username'];
            $data['password']                 = $session_data['password'];
            $data['jabid']                    = $session_data['jabid'];
            $data['leveluserid']              = $session_data['leveluserid'];
            $data['nmdepan']                  = $session_data['nmdepan'];
            $data['nmlengkap']                = $session_data['nmlengkap'];
            $data['levelusernm']              = $session_data['levelusernm'];
            $data['bagnm']                    = $session_data['bagnm'];
            $data['bagian_akses']             = $session_data['bagian_akses'];
            $data['jabnm']                    = $session_data['jabnm'];
            $data['personalid']               = $session_data['personalid'];
            $data['personalstatus']           = $session_data['personalstatus'];
            $data['Titel']                    = 'MONITORING';

            $LevelUser                        = $session_data['leveluserid'];
            $UserName                         = $session_data['username'];
            $LevelUserNm                      = $session_data['levelusernm'];

            $cekLevelUserNm                   = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm']           = substr($LevelUserNm, 0, 7);

            $menus                            = $this->M_menu->menus($LevelUser);
            $data2                            = array('menus' => $menus);

            //ambil variabel URL
            $frmkode                          = $this->uri->segment(4);
            $frmvrs                           = $this->uri->segment(5);
            $frmaksi                          = $this->uri->segment(6);

            $dtfrm                            = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                            = array('dtfrm' => $dtfrm);

            $frmnm                            = $dtfrm[0]->formnm;

            // data hedder
            $headerid                         = addslashes($this->input->post('headerid'));

            $complete_userid                  = $session_data['userid'];
            $complete_date                    = date('Y-m-d');
            $complete_time                    = date('H:i:s');
            $complete_by                      = $session_data['nmlengkap'];
            $complete_comp                    = $this->session->userdata('hostname');  // versi user original

            $create_date                      = date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));  // dari inputan d-m-Y
            $docno                            = addslashes($this->input->post('docno'));
            $persen                            = addslashes($this->input->post('persen'));

            $dtsampel_frmfss315_headerid      = addslashes($this->input->post('dtsampel_frmfss315_headerid'));
            $dtsampel_frmfss315_complete_date = addslashes($this->input->post('dtsampel_frmfss315_complete_date'));
            $dtsampel_frmfss315_complete_time = addslashes($this->input->post('dtsampel_frmfss315_complete_time'));
            $dtsampel_frmfss316_headerid      = addslashes($this->input->post('dtsampel_frmfss316_headerid'));
            $dtsampel_frmfss316_complete_date = addslashes($this->input->post('dtsampel_frmfss316_complete_date'));
            $dtsampel_frmfss316_complete_time = addslashes($this->input->post('dtsampel_frmfss316_complete_time'));
            $dtsampel_frmfss317_headerid      = addslashes($this->input->post('dtsampel_frmfss317_headerid'));
            $dtsampel_frmfss317_complete_date = addslashes($this->input->post('dtsampel_frmfss317_complete_date'));
            $dtsampel_frmfss317_complete_time = addslashes($this->input->post('dtsampel_frmfss317_complete_time'));
            $dtsampel_frmfss520_headerid      = addslashes($this->input->post('dtsampel_frmfss520_headerid'));
            $dtsampel_frmfss520_complete_date = addslashes($this->input->post('dtsampel_frmfss520_complete_date'));
            $dtsampel_frmfss520_complete_time = addslashes($this->input->post('dtsampel_frmfss520_complete_time'));

            // dtl a
            $dtl_a_detail_id                  = $this->input->post('dtl_a_detail_id');
            $dtl_a_id_flow_meter              = $this->input->post('dtl_a_id_flow_meter');
            $dtl_a_nama_jenis_air             = $this->input->post('dtl_a_nama_jenis_air');
            $dtl_a_nama_departemen            = $this->input->post('dtl_a_nama_departemen');
            $dtl_a_nama_flow                  = $this->input->post('dtl_a_nama_flow');
            $dtl_a_pemakaian                  = $this->input->post('dtl_a_pemakaian');
            $dtl_a_persen                     = $this->input->post('dtl_a_persen');
            $dtl_a_akumulatif                 = $this->input->post('dtl_a_akumulatif');

            // dtl b
            $dtl_b_detail_id                  = $this->input->post('dtl_b_detail_id');
            $dtl_b_operasi_jenis              = $this->input->post('dtl_b_operasi_jenis');
            $dtl_b_operasi_satuan             = $this->input->post('dtl_b_operasi_satuan');
            $dtl_b_operasi_nilai              = $this->input->post('dtl_b_operasi_nilai');
            $dtl_b_operasi_akumulatif         = $this->input->post('dtl_b_operasi_akumulatif');

            // dtl c
            $dtl_c_detail_id                  = $this->input->post('dtl_c_detail_id');
            $dtl_c_operasi_jenis              = $this->input->post('dtl_c_operasi_jenis');
            $dtl_c_operasi_satuan             = $this->input->post('dtl_c_operasi_satuan');
            $dtl_c_operasi_nilai              = $this->input->post('dtl_c_operasi_nilai');
            $dtl_c_operasi_akumulatif         = $this->input->post('dtl_c_operasi_akumulatif');
            $dtl_c_operasi_status             = $this->input->post('dtl_c_operasi_status');

            // dtl d
            $dtl_d_detail_id                  = $this->input->post('dtl_d_detail_id');
            $dtl_d_stok_air_awal              = $this->input->post('dtl_d_stok_air_awal');

            // dtl e
            $dtl_e_detail_id                  = $this->input->post('dtl_e_detail_id');
            $dtl_e_operasi_jenis              = $this->input->post('dtl_e_operasi_jenis');
            $dtl_e_operasi_satuan             = $this->input->post('dtl_e_operasi_satuan');
            $dtl_e_operasi_nilai              = $this->input->post('dtl_e_operasi_nilai');
            $dtl_e_operasi_akumulatif         = $this->input->post('dtl_e_operasi_akumulatif');

            // dtl f
            $dtl_f_detail_id                  = $this->input->post('dtl_f_detail_id');
            $dtl_f_operasi_jenis              = $this->input->post('dtl_f_operasi_jenis');
            $dtl_f_operasi_satuan             = $this->input->post('dtl_f_operasi_satuan');
            $dtl_f_operasi_nilai              = $this->input->post('dtl_f_operasi_nilai');
            $dtl_f_operasi_akumulatif_awal    = $this->input->post('dtl_f_operasi_akumulatif_awal');
            $dtl_f_operasi_akumulatif         = $this->input->post('dtl_f_operasi_akumulatif');

            // dtl g
            $dtl_g_detail_id                  = $this->input->post('dtl_g_detail_id');
            $dtl_g_stok_air_akhir             = $this->input->post('dtl_g_stok_air_akhir');
            $dtl_g_stok_air_akhir_awal        = $this->input->post('dtl_g_stok_air_akhir_awal');
            $dtl_g_t_distribusi               = $this->input->post('dtl_g_t_distribusi');
            $dtl_g_stok_air_awal              = $this->input->post('dtl_g_stok_air_awal');
            $dtl_g_total_proses               = $this->input->post('dtl_g_total_proses');

            // dtl h
            $dtl_h_detail_id                  = $this->input->post('dtl_h_detail_id');
            $dtl_h_drain_sedimen              = $this->input->post('dtl_h_drain_sedimen');
            $dtl_h_backwash_tanki             = $this->input->post('dtl_h_backwash_tanki');
            $dtl_h_cleaning_bak               = $this->input->post('dtl_h_cleaning_bak');
            $dtl_h_operasional                = $this->input->post('dtl_h_operasional');

            // dtl i
            $dtl_i_detail_id                  = $this->input->post('dtl_i_detail_id');
            $dtl_i_operasi_jenis              = $this->input->post('dtl_i_operasi_jenis');
            $dtl_i_operasi_nilai              = $this->input->post('dtl_i_operasi_nilai');
            $dtl_i_operasi_akumulatif         = $this->input->post('dtl_i_operasi_akumulatif');
            $dtl_i_operasi_stok               = $this->input->post('dtl_i_operasi_stok');
            $dtl_i_operasi_effisiensi         = $this->input->post('dtl_i_operasi_effisiensi');

            // dtl j
            $dtl_j_detail_id                  = $this->input->post('dtl_j_detail_id');
            $dtl_j_operasi_jenis              = $this->input->post('dtl_j_operasi_jenis');
            $dtl_j_target                     = $this->input->post('dtl_j_target');
            $dtl_j_operasi_satuan             = $this->input->post('dtl_j_operasi_satuan');

            // dtl k
            $dtl_k_detail_id                  = $this->input->post('dtl_k_detail_id');
            $dtl_k_operasi_jenis              = $this->input->post('dtl_k_operasi_jenis');
            $dtl_k_operasi_nilai              = $this->input->post('dtl_k_operasi_nilai');
            $dtl_k_effisiensi                 = $this->input->post('dtl_k_effisiensi');
            $dtl_k_operasi_akumulatif         = $this->input->post('dtl_k_operasi_akumulatif');
            $dtl_k_keterangan                 = $this->input->post('dtl_k_keterangan');
            $dtl_k_stock                      = $this->input->post('dtl_k_stock');

            // dtl l
            $dtl_l_detail_id                  = $this->input->post('dtl_l_detail_id');
            $dtl_l_operasi_jenis              = $this->input->post('dtl_l_operasi_jenis');
            $dtl_l_operasi_nilai              = $this->input->post('dtl_l_operasi_nilai');
            $dtl_l_effisiensi                 = $this->input->post('dtl_l_effisiensi');
            $dtl_l_operasi_akumulatif         = $this->input->post('dtl_l_operasi_akumulatif');
            $dtl_l_operasi_stok               = $this->input->post('dtl_l_operasi_stok');

            // dtl m
            $dtl_m_detail_id                  = $this->input->post('dtl_m_detail_id');
            $dtl_m_operasi_jenis              = $this->input->post('dtl_m_operasi_jenis');
            $dtl_m_operasi_nilai              = $this->input->post('dtl_m_operasi_nilai');
            $dtl_m_effisiensi                 = $this->input->post('dtl_m_effisiensi');
            $dtl_m_operasi_akumulatif         = $this->input->post('dtl_m_operasi_akumulatif');
            $dtl_m_operasi_stok               = $this->input->post('dtl_m_operasi_stok');

            // dtl n
            $dtl_n_detail_id                  = $this->input->post('dtl_n_detail_id');
            $dtl_n_operasi_jenis              = $this->input->post('dtl_n_operasi_jenis');
            $dtl_n_operasi_nilai              = $this->input->post('dtl_n_operasi_nilai');
            $dtl_n_operasi_akumulatif         = $this->input->post('dtl_n_operasi_akumulatif');
            $dtl_n_operasi_stok               = $this->input->post('dtl_n_operasi_stok');

            // dtl o
            $dtl_o_detail_id                  = $this->input->post('dtl_o_detail_id');
            $dtl_o_operasi_jenis              = $this->input->post('dtl_o_operasi_jenis');
            $dtl_o_operasi_produk             = $this->input->post('dtl_o_operasi_produk');
            $dtl_o_operasi_jam                = $this->input->post('dtl_o_operasi_jam');
            $dtl_o_operasi_satuan             = $this->input->post('dtl_o_operasi_satuan');

            // dtl p
            $dtl_p_detail_id                  = $this->input->post('dtl_p_detail_id');
            $dtl_p_item                       = $this->input->post('dtl_p_item');
            $dtl_p_ph                         = $this->input->post('dtl_p_ph');
            $dtl_p_turbidity                  = $this->input->post('dtl_p_turbidity');
            $dtl_p_colour                     = $this->input->post('dtl_p_colour');
            $dtl_p_ket                        = $this->input->post('dtl_p_ket');

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno);

                // cek kalau create date dan docno sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    // pesan gagal krn data sudah ada
                    $data['message']             = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ' dan No Dokumen : ' . $docno . ' sudah pernah disimpan';

                    $data['dtcreate_date']       = addslashes($this->input->post('create_date'));
                    $data['dtdocno']             = addslashes($this->input->post('docno'));
                    $data['dtpersen']            = addslashes($this->input->post('persen'));

                    $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
                } else {
                    $data5 = array(
                        // versi user original
                        'complete_userid' => $complete_userid,
                        'complete_by'     => $complete_by,
                        'complete_date'   => $complete_date,
                        'complete_time'   => $complete_time,
                        'complete_comp'   => $complete_comp,

                        // versi user audit
                        'complete_useridx' => $complete_userid,
                        'complete_byx'     => $complete_by,
                        'complete_datex'   => $complete_date,
                        'complete_timex'   => $complete_time,
                        'complete_compx'   => $complete_comp,

                        'status_detail'  => '0',
                        'status_detailx' => '0',

                        'create_date' => $create_date,
                        'docno'       => $docno,
                        'persen'       => $persen,

                        'dtsampel_frmfss315_headerid'      => !empty($dtsampel_frmfss315_headerid) ? $dtsampel_frmfss315_headerid : null,
                        'dtsampel_frmfss315_complete_date' => !empty($dtsampel_frmfss315_complete_date) ? $dtsampel_frmfss315_complete_date : null,
                        'dtsampel_frmfss315_complete_time' => !empty($dtsampel_frmfss315_complete_time) ? $dtsampel_frmfss315_complete_time : null,
                        'dtsampel_frmfss316_headerid'      => !empty($dtsampel_frmfss316_headerid) ? $dtsampel_frmfss316_headerid : null,
                        'dtsampel_frmfss316_complete_date' => !empty($dtsampel_frmfss316_complete_date) ? $dtsampel_frmfss316_complete_date : null,
                        'dtsampel_frmfss316_complete_time' => !empty($dtsampel_frmfss316_complete_time) ? $dtsampel_frmfss316_complete_time : null,
                        'dtsampel_frmfss317_headerid'      => !empty($dtsampel_frmfss317_headerid) ? $dtsampel_frmfss317_headerid : null,
                        'dtsampel_frmfss317_complete_date' => !empty($dtsampel_frmfss317_complete_date) ? $dtsampel_frmfss317_complete_date : null,
                        'dtsampel_frmfss317_complete_time' => !empty($dtsampel_frmfss317_complete_time) ? $dtsampel_frmfss317_complete_time : null,
                        'dtsampel_frmfss520_headerid'      => !empty($dtsampel_frmfss520_headerid) ? $dtsampel_frmfss520_headerid : null,
                        'dtsampel_frmfss520_complete_date' => !empty($dtsampel_frmfss520_complete_date) ? $dtsampel_frmfss520_complete_date : null,
                        'dtsampel_frmfss520_complete_time' => !empty($dtsampel_frmfss520_complete_time) ? $dtsampel_frmfss520_complete_time : null,
                    );


                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                    // dtl a
                    $jml = count($this->input->post('dtl_a_nama_departemen'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'id_flow_meter'   => $dtl_a_id_flow_meter[$i] == '' ? NULL : $dtl_a_id_flow_meter[$i],
                            'nama_jenis_air'  => $dtl_a_nama_jenis_air[$i],
                            'nama_departemen' => $dtl_a_nama_departemen[$i],
                            'nama_flow'       => $dtl_a_nama_flow[$i],
                            'pemakaian'       => $dtl_a_pemakaian[$i],
                            'persen'          => $dtl_a_persen[$i],
                            'akumulatif'      => $dtl_a_akumulatif[$i],
                        );
                        $this->model->insert_detail($data6);
                    }

                    // dtl b
                    $jml = count($this->input->post('dtl_b_operasi_jenis'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'operasi_jenis'      => $dtl_b_operasi_jenis[$i],
                            'operasi_satuan'     => $dtl_b_operasi_satuan[$i],
                            'operasi_nilai'      => $dtl_b_operasi_nilai[$i],
                            'operasi_akumulatif' => $dtl_b_operasi_akumulatif[$i],
                        );
                        $this->model->insert_detail_b($data6);
                    }

                    // dtl c
                    $jml = count($this->input->post('dtl_c_operasi_jenis'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'operasi_jenis'      => $dtl_c_operasi_jenis[$i],
                            'operasi_satuan'     => $dtl_c_operasi_satuan[$i],
                            'operasi_nilai'      => $dtl_c_operasi_nilai[$i],
                            'operasi_akumulatif' => $dtl_c_operasi_akumulatif[$i],
                            'operasi_status'     => $dtl_c_operasi_status[$i],
                        );
                        $this->model->insert_detail_c($data6);
                    }

                    // dtl d
                    $jml = count($this->input->post('dtl_d_stok_air_awal'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'stok_air_awal'      => $dtl_d_stok_air_awal[$i],
                        );
                        $this->model->insert_detail_d($data6);
                    }

                    // dtl e
                    $jml = count($this->input->post('dtl_e_operasi_jenis'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'operasi_jenis'      => $dtl_e_operasi_jenis[$i],
                            'operasi_satuan'     => $dtl_e_operasi_satuan[$i],
                            'operasi_nilai'      => $dtl_e_operasi_nilai[$i],
                            'operasi_akumulatif' => $dtl_e_operasi_akumulatif[$i],
                        );
                        $this->model->insert_detail_e($data6);
                    }

                    // dtl f
                    $jml = count($this->input->post('dtl_f_operasi_jenis'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid'           => $max_hdr_id,
                            'stdtl'              => $stdtl,
                            'stdtl'              => $stdtl,
                            'operasi_satuan'     => $dtl_f_operasi_satuan[$i],
                            'operasi_nilai'      => $dtl_f_operasi_nilai[$i],
                            'operasi_akumulatif' => $dtl_f_operasi_akumulatif[$i],
                            'operasi_akumulatif_awal' => $dtl_f_operasi_akumulatif_awal[$i],
                            'operasi_jenis'      => $dtl_f_operasi_jenis[$i],
                        );
                        $this->model->insert_detail_f($data6);
                    }

                    // dtl g
                    $jml = count($this->input->post('dtl_g_stok_air_akhir'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid'            => $max_hdr_id,
                            'stdtl'               => $stdtl,

                            'stok_air_akhir_awal' => $dtl_g_stok_air_akhir_awal[$i],
                            'stok_air_akhir'      => $dtl_g_stok_air_akhir[$i],
                            't_distribusi'        => $dtl_g_t_distribusi[$i],
                            'stok_air_awal'       => $dtl_g_stok_air_awal[$i],
                            'total_proses'        => $dtl_g_total_proses[$i],
                        );
                        $this->model->insert_detail_g($data6);
                    }

                    // dtl h
                    $jml = count($this->input->post('dtl_h_drain_sedimen'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'drain_sedimen'  => $dtl_h_drain_sedimen[$i],
                            'backwash_tanki' => $dtl_h_backwash_tanki[$i],
                            'cleaning_bak'   => $dtl_h_cleaning_bak[$i],
                            'operasional'    => $dtl_h_operasional[$i],
                        );
                        $this->model->insert_detail_h($data6);
                    }

                    // dtl i
                    $jml = count($this->input->post('dtl_i_operasi_jenis'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'operasi_jenis'      => $dtl_i_operasi_jenis[$i],
                            'operasi_nilai'      => $dtl_i_operasi_nilai[$i],
                            'operasi_akumulatif' => $dtl_i_operasi_akumulatif[$i],
                            'operasi_stok'       => $dtl_i_operasi_stok[$i],
                            'operasi_effisiensi'       => $dtl_i_operasi_effisiensi[$i],
                        );
                        $this->model->insert_detail_i($data6);
                    }

                    // dtl j
                    $jml = count($this->input->post('dtl_j_target'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'operasi_jenis'  => $dtl_j_operasi_jenis[$i],
                            'target'         => $dtl_j_target[$i],
                            'operasi_satuan' => $dtl_j_operasi_satuan[$i],
                        );
                        $this->model->insert_detail_j($data6);
                    }

                    // dtl k
                    $jml = count($this->input->post('dtl_k_operasi_jenis'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'operasi_jenis'      => $dtl_k_operasi_jenis[$i],
                            'operasi_nilai'      => $dtl_k_operasi_nilai[$i],
                            'effisiensi'         => $dtl_k_effisiensi[$i],
                            'operasi_akumulatif' => $dtl_k_operasi_akumulatif[$i],
                            'keterangan'         => $dtl_k_keterangan[$i],
                            'stock'         => $dtl_k_stock[$i],
                        );
                        $this->model->insert_detail_k($data6);
                    }

                    // dtl l
                    $jml = count($this->input->post('dtl_l_operasi_jenis'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'operasi_jenis'      => $dtl_l_operasi_jenis[$i],
                            'operasi_nilai'      => $dtl_l_operasi_nilai[$i],
                            'effisiensi'         => $dtl_l_effisiensi[$i],
                            'operasi_akumulatif' => $dtl_l_operasi_akumulatif[$i],
                            'operasi_stok'       => $dtl_l_operasi_stok[$i],
                        );
                        $this->model->insert_detail_l($data6);
                    }

                    // dtl m
                    $jml = count($this->input->post('dtl_m_operasi_jenis'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'operasi_jenis'      => $dtl_m_operasi_jenis[$i],
                            'operasi_nilai'      => $dtl_m_operasi_nilai[$i],
                            'effisiensi'         => $dtl_m_effisiensi[$i],
                            'operasi_akumulatif' => $dtl_m_operasi_akumulatif[$i],
                            'operasi_stok'       => $dtl_m_operasi_stok[$i],
                        );
                        $this->model->insert_detail_m($data6);
                    }

                    // dtl n
                    $jml = count($this->input->post('dtl_n_operasi_jenis'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'operasi_jenis'      => $dtl_n_operasi_jenis[$i],
                            'operasi_nilai'      => $dtl_n_operasi_nilai[$i],
                            'operasi_akumulatif' => $dtl_n_operasi_akumulatif[$i],
                            'operasi_stok'       => $dtl_n_operasi_stok[$i],
                        );
                        $this->model->insert_detail_n($data6);
                    }

                    // dtl o
                    $jml = count($this->input->post('dtl_o_operasi_jenis'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'operasi_jenis'  => $dtl_o_operasi_jenis[$i],
                            'operasi_produk' => $dtl_o_operasi_produk[$i],
                            'operasi_jam'    => $dtl_o_operasi_jam[$i],
                            'operasi_satuan' => $dtl_o_operasi_satuan[$i],
                        );
                        $this->model->insert_detail_o($data6);
                    }

                    // dtl p
                    $jml = count($this->input->post('dtl_p_item'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'item'      => $dtl_p_item[$i],
                            'ph'        => $dtl_p_ph[$i],
                            'turbidity' => $dtl_p_turbidity[$i],
                            'colour'    => $dtl_p_colour[$i],
                            'ket'       => $dtl_p_ket[$i],
                        );
                        $this->model->insert_detail_p($data6);
                    }

                    $this->model->insert_detailx($max_hdr_id);
                    $this->model->insert_detail_bx($max_hdr_id);
                    $this->model->insert_detail_cx($max_hdr_id);
                    $this->model->insert_detail_dx($max_hdr_id);
                    $this->model->insert_detail_ex($max_hdr_id);
                    $this->model->insert_detail_fx($max_hdr_id);
                    $this->model->insert_detail_gx($max_hdr_id);
                    $this->model->insert_detail_hx($max_hdr_id);
                    $this->model->insert_detail_ix($max_hdr_id);
                    $this->model->insert_detail_jx($max_hdr_id);
                    $this->model->insert_detail_kx($max_hdr_id);
                    $this->model->insert_detail_lx($max_hdr_id);
                    $this->model->insert_detail_mx($max_hdr_id);
                    $this->model->insert_detail_nx($max_hdr_id);
                    $this->model->insert_detail_ox($max_hdr_id);
                    $this->model->insert_detail_px($max_hdr_id);

                    echo "<script>alert('Data berhasil disimpan!!');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $max_hdr_id, 'refresh');
                }
            } elseif ($frmaksi == 'dtopen') {
                $id = $this->uri->segment(7);

                $data['dtheader'] = $this->model->get_header_byid($id);

                if ($cekLevelUserNm == 'Auditor') {
                    $data['dtdetail']         = $this->model->get_detail_byidx($id);
                    $data['dtdetail_b']       = $this->model->get_detail_byid_bx($id);
                    $data['dtdetail_c']       = $this->model->get_detail_byid_cx($id);
                    $data['dtdetail_c_uf']    = $this->model->get_detail_byid_c_ufx($id);
                    $data['dtdetail_d']       = $this->model->get_detail_byid_dx($id);
                    $data['dtdetail_e']       = $this->model->get_detail_byid_ex($id);
                    $data['dtdetail_f']       = $this->model->get_detail_byid_fx($id);
                    $data['dtdetail_g']       = $this->model->get_detail_byid_gx($id);
                    $data['dtdetail_h']       = $this->model->get_detail_byid_hx($id);
                    $data['dtdetail_i']       = $this->model->get_detail_byid_ix($id);
                    $data['dtdetail_j']       = $this->model->get_detail_byid_jx($id);
                    $data['dtdetail_k']       = $this->model->get_detail_byid_kx($id);
                    $data['dtdetail_l']       = $this->model->get_detail_byid_lx($id);
                    $data['dtdetail_m']       = $this->model->get_detail_byid_mx($id);
                    $data['dtdetail_n']       = $this->model->get_detail_byid_nx($id);
                    $data['dtdetail_o']       = $this->model->get_detail_byid_ox($id);
                    $data['dtdetail_p']       = $this->model->get_detail_byid_px($id);
                } else {
                    $data['dtdetail']         = $this->model->get_detail_byid($id);
                    $data['dtdetail_b']       = $this->model->get_detail_byid_b($id);
                    $data['dtdetail_c']       = $this->model->get_detail_byid_c($id);
                    $data['dtdetail_c_uf']    = $this->model->get_detail_byid_c_uf($id);
                    $data['dtdetail_d']       = $this->model->get_detail_byid_d($id);
                    $data['dtdetail_e']       = $this->model->get_detail_byid_e($id);
                    $data['dtdetail_f']       = $this->model->get_detail_byid_f($id);
                    $data['dtdetail_g']       = $this->model->get_detail_byid_g($id);
                    $data['dtdetail_h']       = $this->model->get_detail_byid_h($id);
                    $data['dtdetail_i']       = $this->model->get_detail_byid_i($id);
                    $data['dtdetail_j']       = $this->model->get_detail_byid_j($id);
                    $data['dtdetail_k']       = $this->model->get_detail_byid_k($id);
                    $data['dtdetail_l']       = $this->model->get_detail_byid_l($id);
                    $data['dtdetail_m']       = $this->model->get_detail_byid_m($id);
                    $data['dtdetail_n']       = $this->model->get_detail_byid_n($id);
                    $data['dtdetail_o']       = $this->model->get_detail_byid_o($id);
                    $data['dtdetail_p']       = $this->model->get_detail_byid_p($id);
                }

                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
            } else {

                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check($create_date, $docno, $headerid);

                    if ($cekheader->num_rows() > 0) {
                        echo "<script>alert('Gagal, Data pada tanggal Laporan : $create_date ,  dan No Dokumen : '.$docno.' sudah pernah disimpan');</script>";
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    } else {
                        if ($cekLevelUserNm == 'Auditor') {
                            $cekdetail = $this->model->cek_stdetailx($headerid);
                        } else {
                            $cekdetail = $this->model->cek_stdetail($headerid);
                        }

                        if ($cekdetail->num_rows() > 0) {
                            $alertmessage = "<script>alert('Gagal, Data sudah dikomplit....!!!! ');</script>";
                        } else {
                            switch ($_POST['btnproses']) {
                                case $_POST['btnproses'] == 'btnupdate':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data5 = array(
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,
                                        );
                                    } else {
                                        $data5 = array(
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,

                                            // versi user original
                                            'complete_userid'  => $complete_userid,
                                            'complete_by'      => $complete_by,
                                            'complete_date'    => $complete_date,
                                            'complete_time'    => $complete_time,
                                            'complete_comp'    => $complete_comp,
                                            'docno'            => $docno,
                                            'persen'            => $persen,
                                        );
                                    }

                                    $alertmessage = "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                                    break;

                                case $_POST['btnproses'] == 'btncomplete':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data5 = array(
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,

                                            'status_detailx'   => '1',

                                        );
                                    } else {
                                        $data5 = array(
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,

                                            // versi user original
                                            'app1_userid'         => $complete_userid,
                                            'app1_by'             => $complete_by,
                                            'app1_date'           => $complete_date,
                                            'app1_time'           => $complete_time,
                                            'app1_position'       => $session_data['jabnm'],
                                            'app1_personalid'     => $session_data['personalid'],
                                            'app1_personalstatus' => $session_data['personalstatus'],
                                            'app1_status'         => '1',
                                            'app1_comp'           => $complete_comp,     // versi user original

                                            'status_detail'    => '1',
                                            'status_detailx'   => '1',
                                        );
                                    }
                                    $alertmessage = "<script>alert('Data berhasil dikomplit....!!!! ');</script>";
                                    break;
                                default:
                                    break;
                            }


                            $this->model->update_hdr($headerid, $data5);

                            $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                            ///
                            /// update detail belum fix
                            /// jadi rencananya hanya yg table atau field bisa di edit aja yg operasi_nilai update data
                            /// sisanya insert ulang aja (hapus dulu data sebelumnya)
                            /// ersyad 20220718
                            ///

                            //edit detail a
                            $jml = count($this->input->post('dtl_a_nama_departemen'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_a_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'           => $stdtl,
                                        'id_flow_meter'   => $dtl_a_id_flow_meter[$i] == '' ? NULL : $dtl_a_id_flow_meter[$i],
                                        'nama_jenis_air'  => $dtl_a_nama_jenis_air[$i],
                                        'nama_departemen' => $dtl_a_nama_departemen[$i],
                                        'nama_flow'       => $dtl_a_nama_flow[$i],
                                        'pemakaian'       => $dtl_a_pemakaian[$i],
                                        'persen'          => $dtl_a_persen[$i],
                                        'akumulatif'      => $dtl_a_akumulatif[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl($dtl_a_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl($dtl_a_detail_id[$i], $data6);
                                        $this->model->update_dtl($dtl_a_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'        => $headerid,
                                        'stdtl'           => $stdtl,
                                        'id_flow_meter'   => $dtl_a_id_flow_meter[$i] == '' ? NULL : $dtl_a_id_flow_meter[$i],
                                        'nama_jenis_air'  => $dtl_a_nama_jenis_air[$i],
                                        'nama_departemen' => $dtl_a_nama_departemen[$i],
                                        'nama_flow'       => $dtl_a_nama_flow[$i],
                                        'pemakaian'       => $dtl_a_pemakaian[$i],
                                        'persen'          => $dtl_a_persen[$i],
                                        'akumulatif'      => $dtl_a_akumulatif[$i],
                                    );

                                    $this->model->insert_detail($data6);
                                }
                            }

                            //edit detail b
                            $jml = count($this->input->post('dtl_b_operasi_jenis'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_b_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_b_operasi_jenis[$i],
                                        'operasi_satuan'     => $dtl_b_operasi_satuan[$i],
                                        'operasi_nilai'      => $dtl_b_operasi_nilai[$i],
                                        'operasi_akumulatif' => $dtl_b_operasi_akumulatif[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_bx($dtl_b_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_b($dtl_b_detail_id[$i], $data6);
                                        $this->model->update_dtl_bx($dtl_b_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_b_operasi_jenis[$i],
                                        'operasi_satuan'     => $dtl_b_operasi_satuan[$i],
                                        'operasi_nilai'      => $dtl_b_operasi_nilai[$i],
                                        'operasi_akumulatif' => $dtl_b_operasi_akumulatif[$i],
                                    );

                                    $this->model->insert_detail_b($data6);
                                }
                            }

                            //edit detail c
                            $jml = count($this->input->post('dtl_c_operasi_jenis'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_c_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_c_operasi_jenis[$i],
                                        'operasi_satuan'     => $dtl_c_operasi_satuan[$i],
                                        'operasi_nilai'      => $dtl_c_operasi_nilai[$i],
                                        'operasi_akumulatif' => $dtl_c_operasi_akumulatif[$i],
                                        'operasi_status'     => $dtl_c_operasi_status[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_cx($dtl_c_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_c($dtl_c_detail_id[$i], $data6);
                                        $this->model->update_dtl_cx($dtl_c_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_c_operasi_jenis[$i],
                                        'operasi_satuan'     => $dtl_c_operasi_satuan[$i],
                                        'operasi_nilai'      => $dtl_c_operasi_nilai[$i],
                                        'operasi_akumulatif' => $dtl_c_operasi_akumulatif[$i],
                                        'operasi_status'     => $dtl_c_operasi_status[$i],
                                    );

                                    $this->model->insert_detail_c($data6);
                                }
                            }

                            //edit detail d
                            $jml = count($this->input->post('dtl_d_stok_air_awal'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_d_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'         => $stdtl,
                                        'stok_air_awal' => $dtl_d_stok_air_awal[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_dx($dtl_d_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_d($dtl_d_detail_id[$i], $data6);
                                        $this->model->update_dtl_dx($dtl_d_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'      => $headerid,
                                        'stdtl'         => $stdtl,
                                        'stok_air_awal' => $dtl_d_stok_air_awal[$i],
                                    );

                                    $this->model->insert_detail_d($data6);
                                }
                            }

                            //edit detail e
                            $jml = count($this->input->post('dtl_e_operasi_jenis'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_e_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'              => $stdtl,
                                        'operasi_satuan'     => $dtl_e_operasi_satuan[$i],
                                        'operasi_nilai'      => $dtl_e_operasi_nilai[$i],
                                        'operasi_jenis'      => $dtl_e_operasi_jenis[$i],
                                        'operasi_akumulatif' => $dtl_e_operasi_akumulatif[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_ex($dtl_e_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_e($dtl_e_detail_id[$i], $data6);
                                        $this->model->update_dtl_ex($dtl_e_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'operasi_satuan'     => $dtl_e_operasi_satuan[$i],
                                        'operasi_nilai'      => $dtl_e_operasi_nilai[$i],
                                        'operasi_jenis'      => $dtl_e_operasi_jenis[$i],
                                        'operasi_akumulatif' => $dtl_e_operasi_akumulatif[$i],
                                    );

                                    $this->model->insert_detail_e($data6);
                                }
                            }

                            //edit detail f
                            $jml = count($this->input->post('dtl_f_operasi_jenis'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_f_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'              => $stdtl,
                                        'operasi_satuan'     => $dtl_f_operasi_satuan[$i],
                                        'operasi_nilai'      => $dtl_f_operasi_nilai[$i],
                                        'operasi_jenis'      => $dtl_f_operasi_jenis[$i],
                                        'operasi_akumulatif' => $dtl_f_operasi_akumulatif[$i],
                                        'operasi_akumulatif_awal' => $dtl_f_operasi_akumulatif_awal[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_fx($dtl_f_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_f($dtl_f_detail_id[$i], $data6);
                                        $this->model->update_dtl_fx($dtl_f_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'operasi_satuan'     => $dtl_f_operasi_satuan[$i],
                                        'operasi_nilai'      => $dtl_f_operasi_nilai[$i],
                                        'operasi_jenis'      => $dtl_f_operasi_jenis[$i],
                                        'operasi_akumulatif' => $dtl_f_operasi_akumulatif[$i],
                                        'operasi_akumulatif_awal' => $dtl_f_operasi_akumulatif_awal[$i],
                                    );

                                    $this->model->insert_detail_f($data6);
                                }
                            }

                            //edit detail g
                            $jml = count($this->input->post('dtl_g_stok_air_akhir'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_g_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'          => $stdtl,
                                        'stok_air_akhir_awal' => $dtl_g_stok_air_akhir_awal[$i],
                                        'stok_air_akhir' => $dtl_g_stok_air_akhir[$i],
                                        't_distribusi'   => $dtl_g_t_distribusi[$i],
                                        'stok_air_awal'  => $dtl_g_stok_air_awal[$i],
                                        'total_proses'   => $dtl_g_total_proses[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_gx($dtl_g_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_g($dtl_g_detail_id[$i], $data6);
                                        $this->model->update_dtl_gx($dtl_g_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'       => $headerid,
                                        'stdtl'          => $stdtl,
                                        'stok_air_akhir_awal' => $dtl_g_stok_air_akhir_awal[$i],
                                        'stok_air_akhir' => $dtl_g_stok_air_akhir[$i],
                                        't_distribusi'   => $dtl_g_t_distribusi[$i],
                                        'stok_air_awal'  => $dtl_g_stok_air_awal[$i],
                                        'total_proses'   => $dtl_g_total_proses[$i],
                                    );

                                    $this->model->insert_detail_g($data6);
                                }
                            }

                            //edit detail h
                            $jml = count($this->input->post('dtl_h_drain_sedimen'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_h_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'          => $stdtl,
                                        'drain_sedimen'  => $dtl_h_drain_sedimen[$i],
                                        'backwash_tanki' => $dtl_h_backwash_tanki[$i],
                                        'cleaning_bak'   => $dtl_h_cleaning_bak[$i],
                                        'operasional'    => $dtl_h_operasional[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_hx($dtl_h_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_h($dtl_h_detail_id[$i], $data6);
                                        $this->model->update_dtl_hx($dtl_h_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'       => $headerid,
                                        'stdtl'          => $stdtl,
                                        'drain_sedimen'  => $dtl_h_drain_sedimen[$i],
                                        'backwash_tanki' => $dtl_h_backwash_tanki[$i],
                                        'cleaning_bak'   => $dtl_h_cleaning_bak[$i],
                                        'operasional'    => $dtl_h_operasional[$i],
                                    );

                                    $this->model->insert_detail_h($data6);
                                }
                            }

                            //edit detail i
                            $jml = count($this->input->post('dtl_i_operasi_jenis'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_i_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_i_operasi_jenis[$i],
                                        'operasi_nilai'      => $dtl_i_operasi_nilai[$i],
                                        'operasi_akumulatif' => $dtl_i_operasi_akumulatif[$i],
                                        'operasi_stok'       => $dtl_i_operasi_stok[$i],
                                        'operasi_effisiensi'       => $dtl_i_operasi_effisiensi[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_ix($dtl_i_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_i($dtl_i_detail_id[$i], $data6);
                                        $this->model->update_dtl_ix($dtl_i_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_i_operasi_jenis[$i],
                                        'operasi_nilai'      => $dtl_i_operasi_nilai[$i],
                                        'operasi_akumulatif' => $dtl_i_operasi_akumulatif[$i],
                                        'operasi_stok'       => $dtl_i_operasi_stok[$i],
                                        'operasi_effisiensi'       => $dtl_i_operasi_effisiensi[$i],
                                    );

                                    $this->model->insert_detail_i($data6);
                                }
                            }

                            //edit detail j
                            $jml = count($this->input->post('dtl_j_target'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_j_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'          => $stdtl,
                                        'operasi_jenis'  => $dtl_j_operasi_jenis[$i],
                                        'target'         => $dtl_j_target[$i],
                                        'operasi_satuan' => $dtl_j_operasi_satuan[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_jx($dtl_j_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_j($dtl_j_detail_id[$i], $data6);
                                        $this->model->update_dtl_jx($dtl_j_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'       => $headerid,
                                        'stdtl'          => $stdtl,
                                        'operasi_jenis'  => $dtl_j_operasi_jenis[$i],
                                        'target'         => $dtl_j_target[$i],
                                        'operasi_satuan' => $dtl_j_operasi_satuan[$i],
                                    );

                                    $this->model->insert_detail_j($data6);
                                }
                            }

                            //edit detail k
                            $jml = count($this->input->post('dtl_k_operasi_jenis'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_k_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_k_operasi_jenis[$i],
                                        'operasi_nilai'      => $dtl_k_operasi_nilai[$i],
                                        'effisiensi'         => $dtl_k_effisiensi[$i],
                                        'operasi_akumulatif' => $dtl_k_operasi_akumulatif[$i],
                                        'keterangan'         => $dtl_k_keterangan[$i],
                                        'stock'         => $dtl_k_stock[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_kx($dtl_k_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_k($dtl_k_detail_id[$i], $data6);
                                        $this->model->update_dtl_kx($dtl_k_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_k_operasi_jenis[$i],
                                        'operasi_nilai'      => $dtl_k_operasi_nilai[$i],
                                        'effisiensi'         => $dtl_k_effisiensi[$i],
                                        'operasi_akumulatif' => $dtl_k_operasi_akumulatif[$i],
                                        'keterangan'         => $dtl_k_keterangan[$i],
                                        'stock'         => $dtl_k_stock[$i],
                                    );

                                    $this->model->insert_detail_k($data6);
                                }
                            }

                            //edit detail l
                            $jml = count($this->input->post('dtl_l_operasi_jenis'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_l_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_l_operasi_jenis[$i],
                                        'operasi_nilai'      => $dtl_l_operasi_nilai[$i],
                                        'effisiensi'         => $dtl_l_effisiensi[$i],
                                        'operasi_akumulatif' => $dtl_l_operasi_akumulatif[$i],
                                        'operasi_stok'       => $dtl_l_operasi_stok[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_lx($dtl_l_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_l($dtl_l_detail_id[$i], $data6);
                                        $this->model->update_dtl_lx($dtl_l_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_l_operasi_jenis[$i],
                                        'operasi_nilai'      => $dtl_l_operasi_nilai[$i],
                                        'effisiensi'         => $dtl_l_effisiensi[$i],
                                        'operasi_akumulatif' => $dtl_l_operasi_akumulatif[$i],
                                        'operasi_stok'       => $dtl_l_operasi_stok[$i],
                                    );

                                    $this->model->insert_detail_l($data6);
                                }
                            }

                            //edit detail m
                            $jml = count($this->input->post('dtl_m_operasi_jenis'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_m_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_m_operasi_jenis[$i],
                                        'operasi_nilai'      => $dtl_m_operasi_nilai[$i],
                                        'effisiensi'         => $dtl_m_effisiensi[$i],
                                        'operasi_akumulatif' => $dtl_m_operasi_akumulatif[$i],
                                        'operasi_stok'       => $dtl_m_operasi_stok[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_mx($dtl_m_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_m($dtl_m_detail_id[$i], $data6);
                                        $this->model->update_dtl_mx($dtl_m_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_m_operasi_jenis[$i],
                                        'operasi_nilai'      => $dtl_m_operasi_nilai[$i],
                                        'effisiensi'         => $dtl_m_effisiensi[$i],
                                        'operasi_akumulatif' => $dtl_m_operasi_akumulatif[$i],
                                        'operasi_stok'       => $dtl_m_operasi_stok[$i],
                                    );

                                    $this->model->insert_detail_m($data6);
                                }
                            }

                            //edit detail n
                            $jml = count($this->input->post('dtl_n_operasi_jenis'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_n_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_n_operasi_jenis[$i],
                                        'operasi_nilai'      => $dtl_n_operasi_nilai[$i],
                                        'operasi_akumulatif' => $dtl_n_operasi_akumulatif[$i],
                                        'operasi_stok'       => $dtl_n_operasi_stok[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_nx($dtl_n_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_n($dtl_n_detail_id[$i], $data6);
                                        $this->model->update_dtl_nx($dtl_n_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'operasi_jenis'      => $dtl_n_operasi_jenis[$i],
                                        'operasi_nilai'      => $dtl_n_operasi_nilai[$i],
                                        'operasi_akumulatif' => $dtl_n_operasi_akumulatif[$i],
                                        'operasi_stok'       => $dtl_n_operasi_stok[$i],
                                    );

                                    $this->model->insert_detail_n($data6);
                                }
                            }

                            //edit detail o
                            $jml = count($this->input->post('dtl_o_operasi_jenis'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_o_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'          => $stdtl,
                                        'operasi_jenis'  => $dtl_o_operasi_jenis[$i],
                                        'operasi_produk' => $dtl_o_operasi_produk[$i],
                                        'operasi_jam'    => $dtl_o_operasi_jam[$i],
                                        'operasi_satuan' => $dtl_o_operasi_satuan[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_ox($dtl_o_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_o($dtl_o_detail_id[$i], $data6);
                                        $this->model->update_dtl_ox($dtl_o_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'       => $headerid,
                                        'stdtl'          => $stdtl,
                                        'operasi_jenis'  => $dtl_o_operasi_jenis[$i],
                                        'operasi_produk' => $dtl_o_operasi_produk[$i],
                                        'operasi_jam'    => $dtl_o_operasi_jam[$i],
                                        'operasi_satuan' => $dtl_o_operasi_satuan[$i],
                                    );

                                    $this->model->insert_detail_o($data6);
                                }
                            }

                            //edit detail p
                            $jml = count($this->input->post('dtl_p_item'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_p_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'     => $stdtl,
                                        'item'      => $dtl_p_item[$i],
                                        'ph'        => $dtl_p_ph[$i],
                                        'turbidity' => $dtl_p_turbidity[$i],
                                        'colour'    => $dtl_p_colour[$i],
                                        'ket'       => $dtl_p_ket[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_px($dtl_p_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_p($dtl_p_detail_id[$i], $data6);
                                        $this->model->update_dtl_px($dtl_p_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'  => $headerid,
                                        'stdtl'     => $stdtl,
                                        'item'      => $dtl_p_item[$i],
                                        'ph'        => $dtl_p_ph[$i],
                                        'turbidity' => $dtl_p_turbidity[$i],
                                        'colour'    => $dtl_p_colour[$i],
                                        'ket'       => $dtl_p_ket[$i],
                                    );

                                    $this->model->insert_detail_p($data6);
                                }
                            }

                            $this->model->insert_detailx($headerid);
                            $this->model->insert_detail_bx($headerid);
                            $this->model->insert_detail_cx($headerid);
                            $this->model->insert_detail_dx($headerid);
                            $this->model->insert_detail_ex($headerid);
                            $this->model->insert_detail_fx($headerid);
                            $this->model->insert_detail_gx($headerid);
                            $this->model->insert_detail_hx($headerid);
                            $this->model->insert_detail_ix($headerid);
                            $this->model->insert_detail_jx($headerid);
                            $this->model->insert_detail_kx($headerid);
                            $this->model->insert_detail_lx($headerid);
                            $this->model->insert_detail_mx($headerid);
                            $this->model->insert_detail_nx($headerid);
                            $this->model->insert_detail_ox($headerid);
                            $this->model->insert_detail_px($headerid);
                        }
                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
                } else if (isset($_POST['btnrefresh'])) {
                    $id = $headerid;

                    $data['dtheader'] = $this->model->get_header_byid($id);

                    foreach ($data['dtheader'] as $headerrow) {
                        $update_create_date = $headerrow->create_date;
                    }

                    $this->model->fn_update_frmfss317a($update_create_date);

                    echo "<script>alert('Data berhasil direfresh....!!!! ');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $id, 'refresh');
                } else {
                    echo "<script>alert('gagal, tidak ada aksi!');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                }
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}
