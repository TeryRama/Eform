<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_formfrmfss315_16 extends CI_Controller
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

    //fungsi untuk mendapatkan nomor document
    function get_docno()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $create_date  = $this->input->post('create_date');

            $dthasil  = $this->model->get_docno(date("m", strtotime($create_date)), date("Y", strtotime($create_date)));

            $last_docno = !empty($dthasil) ? $dthasil->vdocno + 1 : 1;

            $arr_bulan = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            $docno = 'LHP/WTD/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' . str_pad($last_docno, 3, '0', STR_PAD_LEFT);

            $hasil = array(
                'status'  => (bool)1,
                'vstatus' => 'success',
                'pesan'   => "berhasil!",
                'data'    => $docno,
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_list_item()
    {
        if ($this->session->userdata('logged_in')) {
            $frmkode        = $this->uri->segment(4);
            $frmvrs         = $this->uri->segment(5);

            $create_date    = $this->input->post('create_date');
            //variabel untuk mengambil tanngal kemaren
            $tgl_kemarin    = date('Y-m-d', strtotime($create_date . "-1 days"));
            //variabel untuk menampung data dengan parameter tanggal kemaren
            $dthasil        = $this->model->get_list_data_kemarin_raw_water($tgl_kemarin);
            $dthasil2       = $this->model->get_list_data_kemarin_bahan_kimia($tgl_kemarin);

            $result         = $this->M_forminput->get_list_item($frmkode, $frmvrs, 'WTD', 'Tipe 1', date("Y-m-d", strtotime($create_date)));

            if (!empty($result)) {
                $hasil2 = array(
                    'status'        => (bool)1,
                    'vstatus'       => 'success',
                    'pesan'         => "Berhasil memuat data",
                    'data'          => $result,
                    'data_raw'      => $dthasil,
                    'data_kimia'    => $dthasil2,
                );
            } else {
                $hasil2 = array(
                    'status'  => (bool)0,
                    'vstatus' => 'error',
                    'pesan'   => "Data detail tidak ditemukan!!!",
                );
            }

            echo json_encode($hasil2);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function form()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

            $data['userid']         = $session_data['userid'];
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['nmlengkap']      = $session_data['nmlengkap'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['bagian_akses']   = $session_data['bagian_akses'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['personalid']     = $session_data['personalid'];
            $data['personalstatus'] = $session_data['personalstatus'];
            $data['Titel']          = 'MONITORING';

            $LevelUser                = $session_data['leveluserid'];
            $UserName                 = $session_data['username'];
            $LevelUserNm              = $session_data['levelusernm'];

            $cekLevelUserNm           = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm']   = substr($LevelUserNm, 0, 7);

            $menus                    = $this->M_menu->menus($LevelUser);
            $data2                    = array('menus' => $menus);

            //ambil variabel URL
            $frmkode                  = $this->uri->segment(4);
            $frmvrs                   = $this->uri->segment(5);
            $frmaksi                  = $this->uri->segment(6);

            $dtfrm                    = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                    = array('dtfrm' => $dtfrm);

            // data hedder
            $headerid                 = addslashes($this->input->post('headerid'));
            $page_shift               = addslashes($this->input->post('page_shift'));

            $shift_now                = ($page_shift != '') ? explode(" ", $page_shift)[1] : '';

            $complete_userid          = $session_data['userid'];
            $complete_date            = date('Y-m-d');
            $complete_time            = date('H:i:s');
            $complete_by              = $session_data['nmlengkap'];
            $complete_comp            = $this->session->userdata('hostname');  // versi user original

            $create_date              = date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));  // dari inputan d-m-Y
            $docno                    = addslashes($this->input->post('docno'));

            $remark                   = $this->input->post('remark'); //inputan catatan paling bawah

            // detail a
            $dtl_a_detail_id          = $this->input->post('dtl_a_detail_id');
            $dtl_a_shift              = $this->input->post('dtl_a_shift');
            $dtl_a_rw_1_total_jam     = $this->input->post('dtl_a_rw_1_total_jam');
            $dtl_a_rw_1_fm_awal       = $this->input->post('dtl_a_rw_1_fm_awal');
            $dtl_a_rw_1_fm_akhir      = $this->input->post('dtl_a_rw_1_fm_akhir');
            $dtl_a_rw_1_total         = $this->input->post('dtl_a_rw_1_total');
            $dtl_a_rw_1_drain         = $this->input->post('dtl_a_rw_1_drain');
            $dtl_a_rw_2_total_jam     = $this->input->post('dtl_a_rw_2_total_jam');
            $dtl_a_rw_2_fm_awal       = $this->input->post('dtl_a_rw_2_fm_awal');
            $dtl_a_rw_2_fm_akhir      = $this->input->post('dtl_a_rw_2_fm_akhir');
            $dtl_a_rw_2_total         = $this->input->post('dtl_a_rw_2_total');
            $dtl_a_rw_2_drain         = $this->input->post('dtl_a_rw_2_drain');
            $dtl_a_cone_1_2_total_jam = $this->input->post('dtl_a_cone_1_2_total_jam');
            $dtl_a_cone_1_2_fm_awal   = $this->input->post('dtl_a_cone_1_2_fm_awal');
            $dtl_a_cone_1_2_fm_akhir  = $this->input->post('dtl_a_cone_1_2_fm_akhir');
            $dtl_a_cone_1_2_total     = $this->input->post('dtl_a_cone_1_2_total');
            $dtl_a_cone_1_2_drain     = $this->input->post('dtl_a_cone_1_2_drain');
            $dtl_a_cone_3_4_total_jam = $this->input->post('dtl_a_cone_3_4_total_jam');
            $dtl_a_cone_3_4_fm_awal   = $this->input->post('dtl_a_cone_3_4_fm_awal');
            $dtl_a_cone_3_4_fm_akhir  = $this->input->post('dtl_a_cone_3_4_fm_akhir');
            $dtl_a_cone_3_4_total     = $this->input->post('dtl_a_cone_3_4_total');
            $dtl_a_cone_3_4_drain     = $this->input->post('dtl_a_cone_3_4_drain');

            // detail b
            $dtl_b_detail_id      = $this->input->post('dtl_b_detail_id');
            $dtl_b_shift          = $this->input->post('dtl_b_shift');
            $dtl_b_id_item1       = $this->input->post('dtl_b_id_item1');
            $dtl_b_val_item1      = $this->input->post('dtl_b_val_item1');
            $dtl_b_id_item2       = $this->input->post('dtl_b_id_item2');
            $dtl_b_val_item2      = $this->input->post('dtl_b_val_item2');
            $dtl_b_val_spek2      = $this->input->post('dtl_b_val_spek2');
            $dtl_b_baku_terima    = $this->input->post('dtl_b_baku_terima');
            $dtl_b_baku_pakai     = $this->input->post('dtl_b_baku_pakai');
            $dtl_b_baku_stok      = $this->input->post('dtl_b_baku_stok');
            $dtl_b_larutan_terima = $this->input->post('dtl_b_larutan_terima');
            $dtl_b_larutan_pakai  = $this->input->post('dtl_b_larutan_pakai');
            $dtl_b_larutan_stok   = $this->input->post('dtl_b_larutan_stok');

            // detail c
            $dtl_c_detail_id             = $this->input->post('dtl_c_detail_id');
            $dtl_c_shift                 = $this->input->post('dtl_c_shift');
            $dtl_c_rw_sedimen_a1         = $this->input->post('dtl_c_rw_sedimen_a1');
            $dtl_c_rw_sedimen_a2         = $this->input->post('dtl_c_rw_sedimen_a2');
            $dtl_c_rw_sedimen_a3         = $this->input->post('dtl_c_rw_sedimen_a3');
            $dtl_c_rw_sedimen_a4         = $this->input->post('dtl_c_rw_sedimen_a4');
            $dtl_c_rw_sedimen_a5         = $this->input->post('dtl_c_rw_sedimen_a5');
            $dtl_c_rw_sedimen_a6         = $this->input->post('dtl_c_rw_sedimen_a6');
            $dtl_c_rw_sedimen_b1         = $this->input->post('dtl_c_rw_sedimen_b1');
            $dtl_c_rw_sedimen_b2         = $this->input->post('dtl_c_rw_sedimen_b2');
            $dtl_c_rw_sedimen_b3         = $this->input->post('dtl_c_rw_sedimen_b3');
            $dtl_c_rw_sedimen_b4         = $this->input->post('dtl_c_rw_sedimen_b4');
            $dtl_c_rw_sedimen_b5         = $this->input->post('dtl_c_rw_sedimen_b5');
            $dtl_c_rw_sedimen_b6         = $this->input->post('dtl_c_rw_sedimen_b6');
            $dtl_c_rw_cone_clarifier_1_2 = $this->input->post('dtl_c_rw_cone_clarifier_1_2');
            $dtl_c_rw_cone_clarifier_3_4 = $this->input->post('dtl_c_rw_cone_clarifier_3_4');
            $dtl_c_bsf_sedimen_c1        = $this->input->post('dtl_c_bsf_sedimen_c1');
            $dtl_c_bsf_sedimen_c2        = $this->input->post('dtl_c_bsf_sedimen_c2');
            $dtl_c_bsf_bak_v_notch       = $this->input->post('dtl_c_bsf_bak_v_notch');
            $dtl_c_bsf_bak_reyclce       = $this->input->post('dtl_c_bsf_bak_reyclce');
            $dtl_c_bsf_bak_cw            = $this->input->post('dtl_c_bsf_bak_cw');
            $dtl_c_asf_asf_a             = $this->input->post('dtl_c_asf_asf_a');
            $dtl_c_asf_asf_b             = $this->input->post('dtl_c_asf_asf_b');
            $dtl_c_asf_asf_1a            = $this->input->post('dtl_c_asf_asf_1a');
            $dtl_c_asf_asf_1b            = $this->input->post('dtl_c_asf_asf_1b');
            $dtl_c_asf_bak_2             = $this->input->post('dtl_c_asf_bak_2');
            $dtl_c_asf_bak_3             = $this->input->post('dtl_c_asf_bak_3');
            $dtl_c_asf_tower_tbn         = $this->input->post('dtl_c_asf_tower_tbn');
            $dtl_c_asf_tower_mess        = $this->input->post('dtl_c_asf_tower_mess');
            $dtl_c_acf_acf_a             = $this->input->post('dtl_c_acf_acf_a');
            $dtl_c_acf_acf_b             = $this->input->post('dtl_c_acf_acf_b');
            $dtl_c_acf_bak_iv            = $this->input->post('dtl_c_acf_bak_iv');
            $dtl_c_acf_bak_cip_1         = $this->input->post('dtl_c_acf_bak_cip_1');
            $dtl_c_acf_bak_cip_2         = $this->input->post('dtl_c_acf_bak_cip_2');
            $dtl_c_ast_ast               = $this->input->post('dtl_c_ast_ast');
            $dtl_c_ast_bak_demin         = $this->input->post('dtl_c_ast_bak_demin');
            $dtl_c_ast_tangki_st_mes     = $this->input->post('dtl_c_ast_tangki_st_mes');
            $dtl_c_aro_tangki_ro_mes     = $this->input->post('dtl_c_aro_tangki_ro_mes');
            $dtl_c_aro_tangki_ro         = $this->input->post('dtl_c_aro_tangki_ro');
            $dtl_c_aro_ro_wtp            = $this->input->post('dtl_c_aro_ro_wtp');

            // detail d
            $dtl_d_detail_id = $this->input->post('dtl_d_detail_id');
            $dtl_d_shift     = $this->input->post('dtl_d_shift');
            $dtl_d_drain     = $this->input->post('dtl_d_drain');

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date);

                if ($cekheader->num_rows() > 0) {
                    $data['message']       = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ' dan No Dokumen : ' . $docno . ' sudah pernah disimpan';

                    $data['page_shift']    = addslashes($this->input->post('page_shift'));

                    $data['dtcreate_date'] = addslashes($this->input->post('create_date'));
                    $data['dtdocno']       = addslashes($this->input->post('docno'));

                    $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
                } else {
                    $data5 = array(
                        'complete_userid'    => $complete_userid,
                        'complete_by'        => $complete_by,
                        'complete_date'      => $complete_date,
                        'complete_time'      => $complete_time,
                        'complete_comp'      => $complete_comp,     // versi user original

                        'complete_useridx'   => $complete_userid,
                        'complete_byx'       => $complete_by,
                        'complete_datex'     => $complete_date,
                        'complete_timex'     => $complete_time,
                        'complete_compx'     => $complete_comp,     // versi user audit                        

                        'status_detail_sf1'  => '0',
                        'status_detailx_sf1' => '0',
                        'status_detail_sf2'  => '0',
                        'status_detailx_sf2' => '0',
                        'status_detail_sf3'  => '0',
                        'status_detailx_sf3' => '0',

                        'create_date'        => $create_date,
                        'docno'              => $docno,
                    );

                    // operator sebagai app1
                    $data5['app1_userid']         = $complete_userid;
                    $data5['app1_by']             = $complete_by;
                    $data5['app1_date']           = $complete_date;
                    $data5['app1_time']           = $complete_time;
                    $data5['app1_position']       = $session_data['jabnm'];
                    $data5['app1_status']         = '1';
                    $data5['app1_comp']           = $complete_comp;
                    $data5['app1_personalid']     = $session_data['personalid'];
                    $data5['app1_personalstatus'] = $session_data['personalstatus'];

                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                    // detail a
                    $jml_a = count($this->input->post('dtl_a_shift'));
                    for ($i = 0; $i < $jml_a; $i++) {

                        $data6_a = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'shift' => $dtl_a_shift[$i],

                            // untuk input awal nilai hanya utk shift 1 aja ya
                            'rw_1_total_jam'     => $dtl_a_rw_1_total_jam[$i],
                            'rw_1_fm_awal'       => $dtl_a_rw_1_fm_awal[$i],
                            'rw_1_fm_akhir'      => $dtl_a_rw_1_fm_akhir[$i],
                            'rw_1_total'         => $dtl_a_rw_1_total[$i],
                            'rw_1_drain'         => $dtl_a_rw_1_drain[$i],
                            'rw_2_total_jam'     => $dtl_a_rw_2_total_jam[$i],
                            'rw_2_fm_awal'       => $dtl_a_rw_2_fm_awal[$i],
                            'rw_2_fm_akhir'      => $dtl_a_rw_2_fm_akhir[$i],
                            'rw_2_total'         => $dtl_a_rw_2_total[$i],
                            'rw_2_drain'         => $dtl_a_rw_2_drain[$i],
                            'cone_1_2_total_jam' => $dtl_a_cone_1_2_total_jam[$i],
                            'cone_1_2_fm_awal'   => $dtl_a_cone_1_2_fm_awal[$i],
                            'cone_1_2_fm_akhir'  => $dtl_a_cone_1_2_fm_akhir[$i],
                            'cone_1_2_total'     => $dtl_a_cone_1_2_total[$i],
                            'cone_1_2_drain'     => $dtl_a_cone_1_2_drain[$i],
                            'cone_3_4_total_jam' => $dtl_a_cone_3_4_total_jam[$i],
                            'cone_3_4_fm_awal'   => $dtl_a_cone_3_4_fm_awal[$i],
                            'cone_3_4_fm_akhir'  => $dtl_a_cone_3_4_fm_akhir[$i],
                            'cone_3_4_total'     => $dtl_a_cone_3_4_total[$i],
                            'cone_3_4_drain'     => $dtl_a_cone_3_4_drain[$i],

                        );
                        $this->model->insert_detail($data6_a);
                    }

                    //detail b
                    $jml_b = count($this->input->post('dtl_b_shift'));
                    for ($i2 = 0; $i2 < $jml_b; $i2++) {
                        $data6_b = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'shift' => $dtl_b_shift[$i2],

                            'id_item1'    => !empty($dtl_b_id_item1[$i2]) ? $dtl_b_id_item1[$i2] : null,
                            'val_item1'   => $dtl_b_val_item1[$i2],
                            'id_item2'    => !empty($dtl_b_id_item2[$i2]) ? $dtl_b_id_item2[$i2] : null,
                            'val_item2'   => $dtl_b_val_item2[$i2],
                            'val_spek2'   => $dtl_b_val_spek2[$i2],

                            // untuk input awal nilai hanya utk shift 1 aja ya
                            'baku_terima'    => $dtl_b_baku_terima[$i2],
                            'baku_pakai'     => $dtl_b_baku_pakai[$i2],
                            'baku_stok'      => $dtl_b_baku_stok[$i2],
                            'larutan_terima' => $dtl_b_larutan_terima[$i2],
                            'larutan_pakai'  => $dtl_b_larutan_pakai[$i2],
                            'larutan_stok'   => $dtl_b_larutan_stok[$i2],
                        );

                        $this->model->insert_detail_b($data6_b);
                    }

                    //detail c
                    $jml_c = count($this->input->post('dtl_c_shift'));
                    for ($i3 = 0; $i3 < $jml_c; $i3++) {
                        $data6_c = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'shift' => $dtl_c_shift[$i3],

                            // untuk input awal nilai hanya utk shift 1 aja ya
                            'rw_sedimen_a1'         => $dtl_c_rw_sedimen_a1[$i3],
                            'rw_sedimen_a2'         => $dtl_c_rw_sedimen_a2[$i3],
                            'rw_sedimen_a3'         => $dtl_c_rw_sedimen_a3[$i3],
                            'rw_sedimen_a4'         => $dtl_c_rw_sedimen_a4[$i3],
                            'rw_sedimen_a5'         => $dtl_c_rw_sedimen_a5[$i3],
                            'rw_sedimen_a6'         => $dtl_c_rw_sedimen_a6[$i3],
                            'rw_sedimen_b1'         => $dtl_c_rw_sedimen_b1[$i3],
                            'rw_sedimen_b2'         => $dtl_c_rw_sedimen_b2[$i3],
                            'rw_sedimen_b3'         => $dtl_c_rw_sedimen_b3[$i3],
                            'rw_sedimen_b4'         => $dtl_c_rw_sedimen_b4[$i3],
                            'rw_sedimen_b5'         => $dtl_c_rw_sedimen_b5[$i3],
                            'rw_sedimen_b6'         => $dtl_c_rw_sedimen_b6[$i3],
                            'rw_cone_clarifier_1_2' => $dtl_c_rw_cone_clarifier_1_2[$i3],
                            'rw_cone_clarifier_3_4' => $dtl_c_rw_cone_clarifier_3_4[$i3],
                            'bsf_sedimen_c1'        => $dtl_c_bsf_sedimen_c1[$i3],
                            'bsf_sedimen_c2'        => $dtl_c_bsf_sedimen_c2[$i3],
                            'bsf_bak_v_notch'       => $dtl_c_bsf_bak_v_notch[$i3],
                            'bsf_bak_reyclce'       => $dtl_c_bsf_bak_reyclce[$i3],
                            'bsf_bak_cw'            => $dtl_c_bsf_bak_cw[$i3],
                            'asf_asf_a'             => $dtl_c_asf_asf_a[$i3],
                            'asf_asf_b'             => $dtl_c_asf_asf_b[$i3],
                            'asf_asf_1a'            => $dtl_c_asf_asf_1a[$i3],
                            'asf_asf_1b'            => $dtl_c_asf_asf_1b[$i3],
                            'asf_bak_2'             => $dtl_c_asf_bak_2[$i3],
                            'asf_bak_3'             => $dtl_c_asf_bak_3[$i3],
                            'asf_tower_tbn'         => $dtl_c_asf_tower_tbn[$i3],
                            'asf_tower_mess'        => $dtl_c_asf_tower_mess[$i3],
                            'acf_acf_a'             => $dtl_c_acf_acf_a[$i3],
                            'acf_acf_b'             => $dtl_c_acf_acf_b[$i3],
                            'acf_bak_iv'            => $dtl_c_acf_bak_iv[$i3],
                            'acf_bak_cip_1'         => $dtl_c_acf_bak_cip_1[$i3],
                            'acf_bak_cip_2'         => $dtl_c_acf_bak_cip_2[$i3],
                            'ast_ast'               => $dtl_c_ast_ast[$i3],
                            'ast_bak_demin'         => $dtl_c_ast_bak_demin[$i3],
                            'ast_tangki_st_mes'     => $dtl_c_ast_tangki_st_mes[$i3],
                            'aro_tangki_ro_mes'     => $dtl_c_aro_tangki_ro_mes[$i3],
                            'aro_tangki_ro'         => $dtl_c_aro_tangki_ro[$i3],
                            'aro_ro_wtp'            => $dtl_c_aro_ro_wtp[$i3],

                        );

                        $this->model->insert_detail_c($data6_c);
                    }

                    //detail d
                    $jml_d = count($this->input->post('dtl_d_shift'));
                    for ($i4 = 0; $i4 < $jml_d; $i4++) {

                        $data6_d = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'shift' => $dtl_d_shift[$i4],

                            'drain' => $dtl_d_drain[$i4],
                        );

                        if ($dtl_d_shift[$i4] == 'shift_1') {
                            $this->model->insert_detail_d($data6_d);
                        }
                    }

                    $this->model->insert_detailx($max_hdr_id);
                    $this->model->insert_detail_bx($max_hdr_id);
                    $this->model->insert_detail_cx($max_hdr_id);
                    $this->model->insert_detail_dx($max_hdr_id);

                    echo "<script>alert('Data berhasil disimpan!!');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $max_hdr_id, 'refresh');
                }
            } elseif ($frmaksi == 'dtopen') {
                $id       = $this->uri->segment(7);

                $dtheader = $this->model->get_header_byid($id); // get data header
                $data7    = array('dtheader' => $dtheader);

                foreach ($dtheader as $hdrrow) {
                    // kondisi form shift
                    $data['page_shift']    = 'Shift Komplit';
                    for ($i = 1; $i <= 3; $i++) {
                        if ($cekLevelUserNm == "Auditor" && $hdrrow->{'status_detailx_sf' . $i} == '0') {
                            $data['page_shift'] = 'Shift ' . $i;
                            break;
                        } else if ($hdrrow->{'status_detail_sf' . $i} == '0') {
                            $data['page_shift'] = 'Shift ' . $i;
                            break;
                        }
                    }
                }

                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail       = $this->model->get_detail_byidx($id);
                    $dtdetail_b     = $this->model->get_detail_byid_bx($id);
                    $dtdetail_c     = $this->model->get_detail_byid_cx($id);
                    $dtdetail_d     = $this->model->get_detail_byid_dx($id);
                } else {
                    $dtdetail       = $this->model->get_detail_byid($id);
                    $dtdetail_b     = $this->model->get_detail_byid_b($id);
                    $dtdetail_c     = $this->model->get_detail_byid_c($id);
                    $dtdetail_d     = $this->model->get_detail_byid_d($id);
                }

                $data8  = array('dtdetail' => $dtdetail, 'dtdetail_b' => $dtdetail_b, 'dtdetail_c' => $dtdetail_c, 'dtdetail_d' => $dtdetail_d);

                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
            } else {

                if (isset($_POST['btnproses'])) {

                    $cekheader = $this->model->check2($create_date, $headerid);

                    if ($cekheader->num_rows() > 0) {
                        echo "<script>alert('Gagal, Data pada tanggal Laporan : '.$create_date.' dan No Dokumen : '.$docno.' sudah pernah disimpan');</script>";
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    } else {
                        if ($cekLevelUserNm == "Auditor") {
                            $cekdetail = $this->model->cek_stdetailx($headerid);
                        } else {
                            $cekdetail = $this->model->cek_stdetail($headerid);
                        }

                        if ($cekdetail->num_rows() > 0) {
                            $alertmessage = "<script>alert('Gagal, Data sudah dikomplit....!!!! ');</script>";
                        } else {
                            $data5 = array(
                                'complete_useridx' => $complete_userid,
                                'complete_byx'     => $complete_by,
                                'complete_datex'   => $complete_date,
                                'complete_timex'   => $complete_time,
                                'complete_compx'   => $complete_comp, // versi user audit
                            );

                            if ($cekLevelUserNm != "Auditor") {
                                $data5['complete_userid']  = $complete_userid;
                                $data5['complete_by']      = $complete_by;
                                $data5['complete_date']    = $complete_date;
                                $data5['complete_time']    = $complete_time;
                                $data5['complete_comp']    = $complete_comp; // versi user original
                            }

                            switch ($_POST['btnproses']) {
                                case $_POST['btnproses'] == 'btnupdate_sf' . $shift_now: // update per shift
                                    //     // sebagai approval operator
                                    //     $data5['app' . ($shift_now * 2 - 1) . '_userid']         = $complete_userid;
                                    //     $data5['app' . ($shift_now * 2 - 1) . '_by']             = $complete_by;
                                    //     $data5['app' . ($shift_now * 2 - 1) . '_date']           = $complete_date;
                                    //     $data5['app' . ($shift_now * 2 - 1) . '_time']           = $complete_time;
                                    //     $data5['app' . ($shift_now * 2 - 1) . '_position']       = $session_data['jabnm'];
                                    //     $data5['app' . ($shift_now * 2 - 1) . '_status']         = '1';
                                    //     $data5['app' . ($shift_now * 2 - 1) . '_comp']           = $complete_comp;
                                    //     $data5['app' . ($shift_now * 2 - 1) . '_personalid']     = $session_data['personalid'];
                                    //     $data5['app' . ($shift_now * 2 - 1) . '_personalstatus'] = $session_data['personalstatus'];


                                    $data5['remark'] = $remark;

                                    $alertmessage = "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                                    break;

                                case $_POST['btnproses'] == 'btncomplete_sf' . $shift_now: // komplit per shift
                                    // flag komplit per shift
                                    $data5['status_detail_sf' . $shift_now]  = '1';
                                    $data5['status_detailx_sf' . $shift_now] = '1';

                                    // sebagai approval kr
                                    $data5['app' . ($shift_now) . '_userid']            = $complete_userid;
                                    $data5['app' . ($shift_now) . '_by']                = $complete_by;
                                    $data5['app' . ($shift_now) . '_date']              = $complete_date;
                                    $data5['app' . ($shift_now) . '_time']              = $complete_time;
                                    $data5['app' . ($shift_now) . '_position']          = $session_data['jabnm'];
                                    $data5['app' . ($shift_now) . '_status']            = '1';
                                    $data5['app' . ($shift_now) . '_comp']              = $complete_comp;
                                    $data5['app' . ($shift_now) . '_personalid']        = $session_data['personalid'];
                                    $data5['app' . ($shift_now) . '_personalstatus']    = $session_data['personalstatus'];
                                    $data5['remark']                                    = $remark;

                                    $alertmessage = "<script>alert('Data berhasil dikomplit....!!!! ');</script>";
                                    break;

                                default:
                                    break;
                            }

                            $this->model->update_hdr($headerid, $data5);

                            $stdtl = $cekLevelUserNm != "Auditor" ? $stdtl = '1' : $stdtl = '0';

                            // detail a
                            $jml_a = count($this->input->post('dtl_a_shift'));
                            for ($i_a = 0; $i_a < $jml_a; $i_a++) {

                                $data6_a = array(
                                    'stdtl'    => $stdtl,

                                    'rw_1_fm_awal'       => $dtl_a_rw_1_fm_awal[$i_a],
                                    'rw_2_fm_awal'       => $dtl_a_rw_2_fm_awal[$i_a],
                                    'cone_1_2_fm_awal'   => $dtl_a_cone_1_2_fm_awal[$i_a],
                                    'cone_3_4_fm_awal'   => $dtl_a_cone_3_4_fm_awal[$i_a],
                                );

                                if ($shift_now == substr($dtl_a_shift[$i_a], -1)) {
                                    $data6_a = $data6_a + array(
                                        'rw_1_total_jam'     => $dtl_a_rw_1_total_jam[$i_a],
                                        'rw_1_fm_akhir'      => $dtl_a_rw_1_fm_akhir[$i_a],
                                        'rw_1_total'         => $dtl_a_rw_1_total[$i_a],
                                        'rw_1_drain'         => $dtl_a_rw_1_drain[$i_a],
                                        'rw_2_total_jam'     => $dtl_a_rw_2_total_jam[$i_a],
                                        'rw_2_fm_akhir'      => $dtl_a_rw_2_fm_akhir[$i_a],
                                        'rw_2_total'         => $dtl_a_rw_2_total[$i_a],
                                        'rw_2_drain'         => $dtl_a_rw_2_drain[$i_a],
                                        'cone_1_2_total_jam' => $dtl_a_cone_1_2_total_jam[$i_a],
                                        'cone_1_2_fm_akhir'  => $dtl_a_cone_1_2_fm_akhir[$i_a],
                                        'cone_1_2_total'     => $dtl_a_cone_1_2_total[$i_a],
                                        'cone_1_2_drain'     => $dtl_a_cone_1_2_drain[$i_a],
                                        'cone_3_4_total_jam' => $dtl_a_cone_3_4_total_jam[$i_a],
                                        'cone_3_4_fm_akhir'  => $dtl_a_cone_3_4_fm_akhir[$i_a],
                                        'cone_3_4_total'     => $dtl_a_cone_3_4_total[$i_a],
                                        'cone_3_4_drain'     => $dtl_a_cone_3_4_drain[$i_a],

                                    );
                                }
                                if ($cekLevelUserNm == "Auditor") {
                                    $this->model->update_dtlx($dtl_a_detail_id[$i_a], $data6_a);
                                } else {
                                    $this->model->update_dtl($dtl_a_detail_id[$i_a], $data6_a);
                                    $this->model->update_dtlx($dtl_a_detail_id[$i_a], $data6_a);
                                }
                            }

                            //detail b
                            $jml_b = count($this->input->post('dtl_b_shift'));
                            for ($i_b = 0; $i_b < $jml_b; $i_b++) {
                                $data6_b = array(
                                    'stdtl'    => $stdtl,

                                    'baku_terima'    => $dtl_b_baku_terima[$i_b],
                                    'larutan_terima' => $dtl_b_larutan_terima[$i_b],
                                );

                                if ($shift_now == substr($dtl_b_shift[$i_b], -1)) {
                                    $data6_b = $data6_b + array(
                                        'baku_pakai'     => $dtl_b_baku_pakai[$i_b],
                                        'baku_stok'      => $dtl_b_baku_stok[$i_b],

                                        'larutan_pakai'  => $dtl_b_larutan_pakai[$i_b],
                                        'larutan_stok'   => $dtl_b_larutan_stok[$i_b],
                                    );
                                }

                                if ($cekLevelUserNm == "Auditor") {
                                    $this->model->update_dtl_bx($dtl_b_detail_id[$i_b], $data6_b);
                                } else {
                                    $this->model->update_dtl_b($dtl_b_detail_id[$i_b], $data6_b);
                                    $this->model->update_dtl_bx($dtl_b_detail_id[$i_b], $data6_b);
                                }
                            }

                            //detail c
                            $jml_c = count($this->input->post('dtl_c_shift'));
                            for ($i_c = 0; $i_c < $jml_c; $i_c++) {
                                $data6_c = array(
                                    'stdtl'    => $stdtl,

                                    'rw_sedimen_a1'         => $dtl_c_rw_sedimen_a1[$i_c],
                                    'rw_sedimen_a2'         => $dtl_c_rw_sedimen_a2[$i_c],
                                    'rw_sedimen_a3'         => $dtl_c_rw_sedimen_a3[$i_c],
                                    'rw_sedimen_a4'         => $dtl_c_rw_sedimen_a4[$i_c],
                                    'rw_sedimen_a5'         => $dtl_c_rw_sedimen_a5[$i_c],
                                    'rw_sedimen_a6'         => $dtl_c_rw_sedimen_a6[$i_c],
                                    'rw_sedimen_b1'         => $dtl_c_rw_sedimen_b1[$i_c],
                                    'rw_sedimen_b2'         => $dtl_c_rw_sedimen_b2[$i_c],
                                    'rw_sedimen_b3'         => $dtl_c_rw_sedimen_b3[$i_c],
                                    'rw_sedimen_b4'         => $dtl_c_rw_sedimen_b4[$i_c],
                                    'rw_sedimen_b5'         => $dtl_c_rw_sedimen_b5[$i_c],
                                    'rw_sedimen_b6'         => $dtl_c_rw_sedimen_b6[$i_c],
                                    'rw_cone_clarifier_1_2' => $dtl_c_rw_cone_clarifier_1_2[$i_c],
                                    'rw_cone_clarifier_3_4' => $dtl_c_rw_cone_clarifier_3_4[$i_c],
                                    'bsf_sedimen_c1'        => $dtl_c_bsf_sedimen_c1[$i_c],
                                    'bsf_sedimen_c2'        => $dtl_c_bsf_sedimen_c2[$i_c],
                                    'bsf_bak_v_notch'       => $dtl_c_bsf_bak_v_notch[$i_c],
                                    'bsf_bak_reyclce'       => $dtl_c_bsf_bak_reyclce[$i_c],
                                    'bsf_bak_cw'            => $dtl_c_bsf_bak_cw[$i_c],
                                    'asf_asf_a'             => $dtl_c_asf_asf_a[$i_c],
                                    'asf_asf_b'             => $dtl_c_asf_asf_b[$i_c],
                                    'asf_asf_1a'            => $dtl_c_asf_asf_1a[$i_c],
                                    'asf_asf_1b'            => $dtl_c_asf_asf_1b[$i_c],
                                    'asf_bak_2'             => $dtl_c_asf_bak_2[$i_c],
                                    'asf_bak_3'             => $dtl_c_asf_bak_3[$i_c],
                                    'asf_tower_tbn'         => $dtl_c_asf_tower_tbn[$i_c],
                                    'asf_tower_mess'        => $dtl_c_asf_tower_mess[$i_c],
                                    'acf_acf_a'             => $dtl_c_acf_acf_a[$i_c],
                                    'acf_acf_b'             => $dtl_c_acf_acf_b[$i_c],
                                    'acf_bak_iv'            => $dtl_c_acf_bak_iv[$i_c],
                                    'acf_bak_cip_1'         => $dtl_c_acf_bak_cip_1[$i_c],
                                    'acf_bak_cip_2'         => $dtl_c_acf_bak_cip_2[$i_c],
                                    'ast_ast'               => $dtl_c_ast_ast[$i_c],
                                    'ast_bak_demin'         => $dtl_c_ast_bak_demin[$i_c],
                                    'ast_tangki_st_mes'     => $dtl_c_ast_tangki_st_mes[$i_c],
                                    'aro_tangki_ro_mes'     => $dtl_c_aro_tangki_ro_mes[$i_c],
                                    'aro_tangki_ro'         => $dtl_c_aro_tangki_ro[$i_c],
                                    'aro_ro_wtp'            => $dtl_c_aro_ro_wtp[$i_c],

                                );

                                if ($shift_now == substr($dtl_c_shift[$i_c], -1)) {
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtl_cx($dtl_c_detail_id[$i_c], $data6_c);
                                    } else {
                                        $this->model->update_dtl_c($dtl_c_detail_id[$i_c], $data6_c);
                                        $this->model->update_dtl_cx($dtl_c_detail_id[$i_c], $data6_c);
                                    }
                                }
                            }

                            //detail d
                            $jml_d = count($this->input->post('dtl_d_shift'));
                            for ($i_d = 0; $i_d < $jml_d; $i_d++) {

                                $data6_d = array(
                                    'stdtl'    => $stdtl,

                                    'shift' => $dtl_d_shift[$i_d],

                                    'drain' => $dtl_d_drain[$i_d],
                                );

                                if ($shift_now == substr($dtl_d_shift[$i_d], -1)) { //cek shift
                                    if (isset($dtl_d_detail_id[$i_d])) {
                                        if ($cekLevelUserNm == "Auditor") {
                                            $this->model->update_dtl_dx($dtl_d_detail_id[$i_d], $data6_d);
                                        } else {
                                            $this->model->update_dtl_d($dtl_d_detail_id[$i_d], $data6_d);
                                            $this->model->update_dtl_dx($dtl_d_detail_id[$i_d], $data6_d);
                                        }
                                    } else {
                                        $data6_d = $data6_d + array(
                                            'headerid' => $headerid,
                                        );
                                        $this->model->insert_detail_d($data6_d);
                                    }
                                }
                            }
                        }

                        $this->model->insert_detail_dx($headerid);

                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
                } else if (isset($_POST['btndelete_dtl_d'])) {
                    $data5 = array(
                        'complete_useridx' => $complete_userid,
                        'complete_byx'     => $complete_by,
                        'complete_datex'   => $complete_date,
                        'complete_timex'   => $complete_time,
                        'complete_compx'   => $complete_comp, // versi user audit
                    );

                    if ($cekLevelUserNm == 'Auditor') {
                        $cekdetail = $this->model->cek_stdetailx($headerid);
                    } else {
                        $cekdetail = $this->model->cek_stdetail($headerid);

                        $data5['complete_userid']  = $complete_userid;
                        $data5['complete_by']      = $complete_by;
                        $data5['complete_date']    = $complete_date;
                        $data5['complete_time']    = $complete_time;
                        $data5['complete_comp']    = $complete_comp; // versi user original
                    }

                    if ($cekdetail->num_rows() > 0) {
                        $alertmessage = "<script>alert('Maaf data tidak bisa dihapus karena sudah dikomplit!! ');</script>";
                    } else {
                        $this->model->update_hdr($headerid, $data5);

                        $chk = $this->input->post('dtl_d_chk');
                        $jml = count($this->input->post('dtl_d_chk'));

                        for ($i = 0; $i < $jml; $i++) {
                            if ($shift_now == substr(explode(" ", $chk[$i])[0], -1)) {
                                if ($cekLevelUserNm == 'Auditor') {
                                    $data6_d = array(
                                        'stdtl'    => '0',
                                    );
                                    $this->model->update_dtldx(explode(" ", $chk[$i])[1], $data6_d);
                                } else {
                                    $this->model->delete_detail_d(explode(" ", $chk[$i])[1]);
                                    $this->model->delete_detail_dx(explode(" ", $chk[$i])[1]);
                                }
                                $alertmessage = "<script>alert('Data berhasil dihapus!! ');</script>";
                            } else {
                                $alertmessage = "<script>alert('Maaf, tidak dapat menghapus data shift lain! ');</script>";
                            }
                        }
                    }

                    echo $alertmessage;
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                }
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}
