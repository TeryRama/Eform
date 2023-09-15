<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_forminttbn008_03 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $CI        = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);

        $frmkode = $this->uri->segment(4);
        $frmvrs  = $this->uri->segment(5);

        $this->load->model(array('M_user', 'M_menu', 'tambahan/M_tambahan', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->library(array('table', 'form_validation', 'excel', 'image_lib'));
        $this->load->helper(array('form', 'url', 'html', 'file', 'path'));

        $this->model = $this->{'M_form' . $frmkode . '_' . $frmvrs};

        /// prevent direct url accses
        $session_data = $this->session->userdata('logged_in');
        $leveluid     = $session_data['leveluserid'];
        $url_str      = uri_string();

        $akses_check = $this->M_user->check_akses_bylevelid($leveluid, $frmkode);
        if ($akses_check == false) {
            echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini !');
            window.location.assign('";
            echo base_url();
            echo "C_login');
            </script>";
            exit;
        }
        /// end prevent direct url accses
    }

    function get_docno()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

            $create_date  = $this->input->post('create_date');
            $dthasil = $this->model->get_docno(date("m", strtotime($create_date)), date("Y", strtotime($create_date)));

            $last_docno = !empty($dthasil->vdocno) ? $dthasil->vdocno + 1 : 1;

            $date_day  = date("d", strtotime($create_date));
            $arr_bulan = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            $docno = 'LBB/PWP-TBN/' . date("Y", strtotime($create_date)) . '/' .  str_pad($date_day, 3, '0', STR_PAD_LEFT);

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil",
                'data'    => $docno
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_bulan()
    {
        if ($this->session->userdata('logged_in')) {
            $create_date  = $this->input->post('create_date');
            $bulan = $this->model->get_tanggal_indo(date('-m-', strtotime($create_date)));
            $trimbulan = trim($bulan, ' ');

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil",
                'data'    => $trimbulan
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_tahun()
    {
        if ($this->session->userdata('logged_in')) {
            $create_date  = $this->input->post('create_date');
            $sub_tahun = substr($create_date, -4);

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil",
                'data'    => $sub_tahun
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_tanggal_bahan_bakar()
    {
        if ($this->session->userdata('logged_in')) {
            $create_date  = date("Y-m-d", strtotime($this->input->post('create_date')));
            $bulan        = date('m', strtotime($create_date));
            $tahun        = date('Y', strtotime($create_date));

            $tanggal_bahan_bakar = $this->model->get_tanggal_bahan_bakar($bulan, $tahun);

            if (!empty($tanggal_bahan_bakar)) {
                $pesan = "Berhasil Memuat Data, Silahkan Simpan Terlebih Dahulu !";

                $result = [
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => $pesan,
                    'data'    => $tanggal_bahan_bakar
                ];
            } else {
                $result = [
                    'status'  => 1,
                    'vstatus' => 'error',
                    'pesan'   => "Gagal, data belum tersedia !",
                ];
            }

            echo json_encode($result);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function check_data()
    {
        if ($this->session->userdata('logged_in')) {
            $bulan = $this->input->post('bulan');
            $tahun  = $this->input->post('tahun');

            $dthasil = $this->model->check_data($bulan, $tahun);

            if ($dthasil['cek_data_semua']->jml_data == 0) {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => 'Silahkan input data awal !',
                    'data'    => $dthasil['cek_data_semua'],
                );
            } else if ($dthasil['cek_data_bulan']->jml_data == 0) {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => 'Silahkan input data !',
                    'data'    => $dthasil['cek_data_bulan'],
                );
            } else {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'error',
                    'pesan'   => "Data periode ini sudah tersedia ! \n Silahkan input mulai bulan \n" . $this->model->get_tanggal_indo(date("Y-m", strtotime($dthasil['cek_data_terakhir']->data_terakhir . ' + 1 month'))),
                );
            }

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function form()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data     = $this->session->userdata('logged_in');
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

            $LevelUser   = $session_data['leveluserid'];
            $UserName    = $session_data['username'];
            $LevelUserNm = $session_data['levelusernm'];

            $cekLevelUserNm   = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            //ambil variabel URL
            $frmkode = $this->uri->segment(4);
            $frmvrs  = $this->uri->segment(5);
            $frmaksi = $this->uri->segment(6);

            $dtfrm = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3 = array('dtfrm' => $dtfrm);

            $frmnm = $dtfrm[0]->formnm;

            // hdr
            $headerid                      = addslashes($this->input->post('headerid'));
            $complete_userid               = $session_data['userid'];
            $complete_date                 = date('Y-m-d');
            $complete_time                 = date('H:i:s');
            $complete_by                   = $session_data['nmlengkap'];
            $complete_comp                 = $this->session->userdata('hostname');                                     // versi user original
            $create_date                   = date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));  // dari inputan d-m-Y
            $bulan                         = addslashes($this->input->post('bulan'));
            $tahun                         = addslashes($this->input->post('tahun'));
            $docno                         = addslashes($this->input->post('docno'));
            $batubara_stock_awal_total     = addslashes($this->input->post('batubara_stock_awal_total'));
            $batubara_terima_total         = addslashes($this->input->post('batubara_terima_total'));
            $batubara_pakai_total          = addslashes($this->input->post('batubara_pakai_total'));
            $batubara_stock_akhir_total    = addslashes($this->input->post('batubara_stock_akhir_total'));
            $debu_arang_terima_total       = addslashes($this->input->post('debu_arang_terima_total'));
            $debu_arang_pakai_total        = addslashes($this->input->post('debu_arang_pakai_total'));
            $tempurung_stock_awal_total    = addslashes($this->input->post('tempurung_stock_awal_total'));
            $tempurung_terima_total        = addslashes($this->input->post('tempurung_terima_total'));
            $tempurung_pakai_total         = addslashes($this->input->post('tempurung_pakai_total'));
            $tempurung_stock_akhir_total   = addslashes($this->input->post('tempurung_stock_akhir_total'));
            $sabut_stock_awal_total        = addslashes($this->input->post('sabut_stock_awal_total'));
            $sabut_terima_total            = addslashes($this->input->post('sabut_terima_total'));
            $sabut_pakai_total             = addslashes($this->input->post('sabut_pakai_total'));
            $sabut_stock_akhir_total       = addslashes($this->input->post('sabut_stock_akhir_total'));
            $cocopiet_terima_total         = addslashes($this->input->post('cocopiet_terima_total'));
            $cocopiet_pakai_total          = addslashes($this->input->post('cocopiet_pakai_total'));
            $total_pakai_bahan_bakar_total = addslashes($this->input->post('total_pakai_bahan_bakar_total'));
            $batubara_stock_awal_rata2     = addslashes($this->input->post('batubara_stock_awal_rata2'));
            $batubara_terima_rata2         = addslashes($this->input->post('batubara_terima_rata2'));
            $batubara_pakai_rata2          = addslashes($this->input->post('batubara_pakai_rata2'));
            $batubara_stock_akhir_rata2    = addslashes($this->input->post('batubara_stock_akhir_rata2'));
            $debu_arang_terima_rata2       = addslashes($this->input->post('debu_arang_terima_rata2'));
            $debu_arang_pakai_rata2        = addslashes($this->input->post('debu_arang_pakai_rata2'));
            $tempurung_stock_awal_rata2    = addslashes($this->input->post('tempurung_stock_awal_rata2'));
            $tempurung_terima_rata2        = addslashes($this->input->post('tempurung_terima_rata2'));
            $tempurung_pakai_rata2         = addslashes($this->input->post('tempurung_pakai_rata2'));
            $tempurung_stock_akhir_rata2   = addslashes($this->input->post('tempurung_stock_akhir_rata2'));
            $sabut_stock_awal_rata2        = addslashes($this->input->post('sabut_stock_awal_rata2'));
            $sabut_terima_rata2            = addslashes($this->input->post('sabut_terima_rata2'));
            $sabut_pakai_rata2             = addslashes($this->input->post('sabut_pakai_rata2'));
            $sabut_stock_akhir_rata2       = addslashes($this->input->post('sabut_stock_akhir_rata2'));
            $cocopiet_terima_rata2         = addslashes($this->input->post('cocopiet_terima_rata2'));
            $cocopiet_pakai_rata2          = addslashes($this->input->post('cocopiet_pakai_rata2'));
            $total_pakai_bahan_bakar_rata2 = addslashes($this->input->post('total_pakai_bahan_bakar_rata2'));

            // dtl
            // $tanggal_bahan_bakar     = addslashes($this->input->post('tanggal_bahan_bakar'));
            // $batubara_stock_awal     = addslashes($this->input->post('batubara_stock_awal'));
            // $batubara_terima         = addslashes($this->input->post('batubara_terima'));
            // $batubara_pakai          = addslashes($this->input->post('batubara_pakai'));
            // $batubara_stock_akhir    = addslashes($this->input->post('batubara_stock_akhir'));
            // $debu_arang_terima       = addslashes($this->input->post('debu_arang_terima'));
            // $debu_arang_pakai        = addslashes($this->input->post('debu_arang_pakai'));
            // $tempurung_stock_awal    = addslashes($this->input->post('tempurung_stock_awal'));
            // $tempurung_terima        = addslashes($this->input->post('tempurung_terima'));
            // $tempurung_pakai         = addslashes($this->input->post('tempurung_pakai'));
            // $tempurung_stock_akhir   = addslashes($this->input->post('tempurung_stock_akhir'));
            // $sabut_stock_awal        = addslashes($this->input->post('sabut_stock_awal'));
            // $sabut_terima            = addslashes($this->input->post('sabut_terima'));
            // $sabut_pakai             = addslashes($this->input->post('sabut_pakai'));
            // $sabut_stock_akhir       = addslashes($this->input->post('sabut_stock_akhir'));
            // $cocopiet_terima         = addslashes($this->input->post('cocopiet_terima'));
            // $cocopiet_pakai          = addslashes($this->input->post('cocopiet_pakai'));
            // $total_pakai_bahan_bakar = addslashes($this->input->post('total_pakai_bahan_bakar'));

            $detail_id               = $this->input->post('detail_id');
            $tanggal_bahan_bakar     = $this->input->post('tanggal_bahan_bakar');
            $batubara_stock_awal     = $this->input->post('batubara_stock_awal');
            $batubara_terima         = $this->input->post('batubara_terima');
            $batubara_pakai          = $this->input->post('batubara_pakai');
            $batubara_stock_akhir    = $this->input->post('batubara_stock_akhir');
            $debu_arang_terima       = $this->input->post('debu_arang_terima');
            $debu_arang_pakai        = $this->input->post('debu_arang_pakai');
            $tempurung_stock_awal    = $this->input->post('tempurung_stock_awal');
            $tempurung_terima        = $this->input->post('tempurung_terima');
            $tempurung_pakai         = $this->input->post('tempurung_pakai');
            $tempurung_stock_akhir   = $this->input->post('tempurung_stock_akhir');
            $sabut_stock_awal        = $this->input->post('sabut_stock_awal');
            $sabut_terima            = $this->input->post('sabut_terima');
            $sabut_pakai             = $this->input->post('sabut_pakai');
            $sabut_stock_akhir       = $this->input->post('sabut_stock_akhir');
            $cocopiet_terima         = $this->input->post('cocopiet_terima');
            $cocopiet_pakai          = $this->input->post('cocopiet_pakai');
            $total_pakai_bahan_bakar = $this->input->post('total_pakai_bahan_bakar');

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $bulan);

                // cek kalau create date dan nama bulan sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    $create_date         = addslashes($this->input->post('create_date'));
                    $bulan               = addslashes($this->input->post('bulan'));
                    $tahun               = addslashes($this->input->post('tahun'));
                    $tanggal_bahan_bakar = count($this->input->post('tanggal_bahan_bakar'));
                    $data                = array(
                        // pesan gagal krn data sudah ada
                        'message'     => 'Gagal, Data pada Bulan : ' . $bulan . ' dan Tahun : ' . $tahun . ', sudah pernah disimpan.',
                        'create_date' => $create_date,
                        'bulan'       => $bulan,
                        'tahun'       => $tahun,

                        'docno' => $docno,
                        // 'batubara_stock_awal_total'     => $batubara_stock_awal_total,
                        // 'batubara_terima_total'         => $batubara_terima_total,
                        // 'batubara_pakai_total'          => $batubara_pakai_total,
                        // 'batubara_stock_akhir_total'    => $batubara_stock_akhir_total,
                        // 'debu_arang_terima_total'       => $debu_arang_terima_total,
                        // 'debu_arang_pakai_total'        => $debu_arang_pakai_total,
                        // 'tempurung_stock_awal_total'    => $tempurung_stock_awal_total,
                        // 'tempurung_terima_total'        => $tempurung_terima_total,
                        // 'tempurung_pakai_total'         => $tempurung_pakai_total,
                        // 'tempurung_stock_akhir_total'   => $tempurung_stock_akhir_total,
                        // 'sabut_stock_awal_total'        => $sabut_stock_awal_total,
                        // 'sabut_terima_total'            => $sabut_terima_total,
                        // 'sabut_pakai_total'             => $sabut_pakai_total,
                        // 'sabut_stock_akhir_total'       => $sabut_stock_akhir_total,
                        // 'cocopiet_terima_total'         => $cocopiet_terima_total,
                        // 'cocopiet_pakai_total'          => $cocopiet_pakai_total,
                        // 'total_pakai_bahan_bakar_total' => $total_pakai_bahan_bakar_total,
                        // 'batubara_stock_awal_rata2'     => $batubara_stock_awal_rata2,
                        // 'batubara_terima_rata2'         => $batubara_terima_rata2,
                        // 'batubara_pakai_rata2'          => $batubara_pakai_rata2,
                        // 'batubara_stock_akhir_rata2'    => $batubara_stock_akhir_rata2,
                        // 'debu_arang_terima_rata2'       => $debu_arang_terima_rata2,
                        // 'debu_arang_pakai_rata2'        => $debu_arang_pakai_rata2,
                        // 'tempurung_stock_awal_rata2'    => $tempurung_stock_awal_rata2,
                        // 'tempurung_terima_rata2'        => $tempurung_terima_rata2,
                        // 'tempurung_pakai_rata2'         => $tempurung_pakai_rata2,
                        // 'tempurung_stock_akhir_rata2'   => $tempurung_stock_akhir_rata2,
                        // 'sabut_stock_awal_rata2'        => $sabut_stock_awal_rata2,
                        // 'sabut_terima_rata2'            => $sabut_terima_rata2,
                        // 'sabut_pakai_rata2'             => $sabut_pakai_rata2,
                        // 'sabut_stock_akhir_rata2'       => $sabut_stock_akhir_rata2,
                        // 'cocopiet_terima_rata2'         => $cocopiet_terima_rata2,
                        // 'cocopiet_pakai_rata2'          => $cocopiet_pakai_rata2,
                        // 'total_pakai_bahan_bakar_rata2' => $total_pakai_bahan_bakar_rata2,

                        'jmldtl' => $tanggal_bahan_bakar,
                    );
                    $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
                } else {
                    $data4 = array(
                        // versi user original
                        'complete_userid' => $complete_userid,
                        'complete_by'     => $complete_by,
                        'complete_date'   => $complete_date,
                        'complete_time'   => $complete_time,
                        'complete_comp'   => $complete_comp,

                        // versi user audit
                        'complete_useridx'              => $complete_userid,
                        'complete_byx'                  => $complete_by,
                        'complete_datex'                => $complete_date,
                        'complete_timex'                => $complete_time,
                        'complete_compx'                => $complete_comp,
                        'status_detail'                 => '0',
                        'status_detailx'                => '0',
                        'create_date'                   => $create_date,
                        'bulan'                         => $bulan,
                        'tahun'                         => $tahun,
                        'docno'                         => $docno,
                        'batubara_stock_awal_total'     => $batubara_stock_awal_total,
                        'batubara_terima_total'         => $batubara_terima_total,
                        'batubara_pakai_total'          => $batubara_pakai_total,
                        'batubara_stock_akhir_total'    => $batubara_stock_akhir_total,
                        'debu_arang_terima_total'       => $debu_arang_terima_total,
                        'debu_arang_pakai_total'        => $debu_arang_pakai_total,
                        'tempurung_stock_awal_total'    => $tempurung_stock_awal_total,
                        'tempurung_terima_total'        => $tempurung_terima_total,
                        'tempurung_pakai_total'         => $tempurung_pakai_total,
                        'tempurung_stock_akhir_total'   => $tempurung_stock_akhir_total,
                        'sabut_stock_awal_total'        => $sabut_stock_awal_total,
                        'sabut_terima_total'            => $sabut_terima_total,
                        'sabut_pakai_total'             => $sabut_pakai_total,
                        'sabut_stock_akhir_total'       => $sabut_stock_akhir_total,
                        'cocopiet_terima_total'         => $cocopiet_terima_total,
                        'cocopiet_pakai_total'          => $cocopiet_pakai_total,
                        'total_pakai_bahan_bakar_total' => $total_pakai_bahan_bakar_total,
                        'batubara_stock_awal_rata2'     => $batubara_stock_awal_rata2,
                        'batubara_terima_rata2'         => $batubara_terima_rata2,
                        'batubara_pakai_rata2'          => $batubara_pakai_rata2,
                        'batubara_stock_akhir_rata2'    => $batubara_stock_akhir_rata2,
                        'debu_arang_terima_rata2'       => $debu_arang_terima_rata2,
                        'debu_arang_pakai_rata2'        => $debu_arang_pakai_rata2,
                        'tempurung_stock_awal_rata2'    => $tempurung_stock_awal_rata2,
                        'tempurung_terima_rata2'        => $tempurung_terima_rata2,
                        'tempurung_pakai_rata2'         => $tempurung_pakai_rata2,
                        'tempurung_stock_akhir_rata2'   => $tempurung_stock_akhir_rata2,
                        'sabut_stock_awal_rata2'        => $sabut_stock_awal_rata2,
                        'sabut_terima_rata2'            => $sabut_terima_rata2,
                        'sabut_pakai_rata2'             => $sabut_pakai_rata2,
                        'sabut_stock_akhir_rata2'       => $sabut_stock_akhir_rata2,
                        'cocopiet_terima_rata2'         => $cocopiet_terima_rata2,
                        'cocopiet_pakai_rata2'          => $cocopiet_pakai_rata2,
                        'total_pakai_bahan_bakar_rata2' => $total_pakai_bahan_bakar_rata2
                    );

                    $this->model->insert_dtheader($data4);
                    $max_hdr_id = $this->db1->insert_id();

                    $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                    // dtl
                    $jml = count($this->input->post('tanggal_bahan_bakar'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data5 = array(
                            'headerid'                => $max_hdr_id,
                            'stdtl'                   => $stdtl,
                            'tanggal_bahan_bakar'     => $tanggal_bahan_bakar[$i],
                            'batubara_stock_awal'     => $batubara_stock_awal[$i],
                            'batubara_terima'         => $batubara_terima[$i],
                            'batubara_pakai'          => $batubara_pakai[$i],
                            'batubara_stock_akhir'    => $batubara_stock_akhir[$i],
                            'debu_arang_terima'       => $debu_arang_terima[$i],
                            'debu_arang_pakai'        => $debu_arang_pakai[$i],
                            'tempurung_stock_awal'    => $tempurung_stock_awal[$i],
                            'tempurung_terima'        => $tempurung_terima[$i],
                            'tempurung_pakai'         => $tempurung_pakai[$i],
                            'tempurung_stock_akhir'   => $tempurung_stock_akhir[$i],
                            'sabut_stock_awal'        => $sabut_stock_awal[$i],
                            'sabut_terima'            => $sabut_terima[$i],
                            'sabut_pakai'             => $sabut_pakai[$i],
                            'sabut_stock_akhir'       => $sabut_stock_akhir[$i],
                            'cocopiet_terima'         => $cocopiet_terima[$i],
                            'cocopiet_pakai'          => $cocopiet_pakai[$i],
                            'total_pakai_bahan_bakar' => $total_pakai_bahan_bakar[$i]
                        );
                        $this->model->insert_detail($data5);
                    }

                    $this->model->insert_detailx($max_hdr_id);

                    echo "<script>alert('Data berhasil disimpan !');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $max_hdr_id, 'refresh');
                }
            } elseif ($frmaksi == 'dtopen') {
                $id = $this->uri->segment(7);

                $data['dtheader'] = $this->model->get_header_byid($id);

                if ($cekLevelUserNm == 'Auditor') {
                    $data['dtdetail'] = $this->model->get_detail_byidx($id);
                } else {
                    $data['dtdetail'] = $this->model->get_detail_byid($id);
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
                            $alertmessage = "<script>alert('Gagal, Data sudah dikomplit ! ');</script>";
                        } else {
                            switch ($_POST['btnproses']) {
                                case $_POST['btnproses'] == 'btnupdate':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data4 = array(
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,
                                        );
                                    } else {
                                        $data4 = array(
                                            // versi user original
                                            'complete_userid' => $complete_userid,
                                            'complete_by'     => $complete_by,
                                            'complete_date'   => $complete_date,

                                            // versi user audit
                                            'complete_useridx'              => $complete_userid,
                                            'complete_byx'                  => $complete_by,
                                            'complete_datex'                => $complete_date,
                                            'complete_timex'                => $complete_time,
                                            'complete_compx'                => $complete_comp,
                                            'batubara_stock_awal_total'     => $batubara_stock_awal_total,
                                            'batubara_terima_total'         => $batubara_terima_total,
                                            'batubara_pakai_total'          => $batubara_pakai_total,
                                            'batubara_stock_akhir_total'    => $batubara_stock_akhir_total,
                                            'debu_arang_terima_total'       => $debu_arang_terima_total,
                                            'debu_arang_pakai_total'        => $debu_arang_pakai_total,
                                            'tempurung_stock_awal_total'    => $tempurung_stock_awal_total,
                                            'tempurung_terima_total'        => $tempurung_terima_total,
                                            'tempurung_pakai_total'         => $tempurung_pakai_total,
                                            'tempurung_stock_akhir_total'   => $tempurung_stock_akhir_total,
                                            'sabut_stock_awal_total'        => $sabut_stock_awal_total,
                                            'sabut_terima_total'            => $sabut_terima_total,
                                            'sabut_pakai_total'             => $sabut_pakai_total,
                                            'sabut_stock_akhir_total'       => $sabut_stock_akhir_total,
                                            'cocopiet_terima_total'         => $cocopiet_terima_total,
                                            'cocopiet_pakai_total'          => $cocopiet_pakai_total,
                                            'total_pakai_bahan_bakar_total' => $total_pakai_bahan_bakar_total,
                                            'batubara_stock_awal_rata2'     => $batubara_stock_awal_rata2,
                                            'batubara_terima_rata2'         => $batubara_terima_rata2,
                                            'batubara_pakai_rata2'          => $batubara_pakai_rata2,
                                            'batubara_stock_akhir_rata2'    => $batubara_stock_akhir_rata2,
                                            'debu_arang_terima_rata2'       => $debu_arang_terima_rata2,
                                            'debu_arang_pakai_rata2'        => $debu_arang_pakai_rata2,
                                            'tempurung_stock_awal_rata2'    => $tempurung_stock_awal_rata2,
                                            'tempurung_terima_rata2'        => $tempurung_terima_rata2,
                                            'tempurung_pakai_rata2'         => $tempurung_pakai_rata2,
                                            'tempurung_stock_akhir_rata2'   => $tempurung_stock_akhir_rata2,
                                            'sabut_stock_awal_rata2'        => $sabut_stock_awal_rata2,
                                            'sabut_terima_rata2'            => $sabut_terima_rata2,
                                            'sabut_pakai_rata2'             => $sabut_pakai_rata2,
                                            'sabut_stock_akhir_rata2'       => $sabut_stock_akhir_rata2,
                                            'cocopiet_terima_rata2'         => $cocopiet_terima_rata2,
                                            'cocopiet_pakai_rata2'          => $cocopiet_pakai_rata2,
                                            'total_pakai_bahan_bakar_rata2' => $total_pakai_bahan_bakar_rata2
                                        );
                                    }

                                    $alertmessage = "<script>alert('Data berhasil disimpan ! ');</script>";
                                    break;

                                case $_POST['btnproses'] == 'btncomplete':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data4 = array(
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,

                                            'status_detailx' => '1',

                                        );
                                    } else {
                                        $data4 = array(
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,

                                            // versi user original
                                            'app1_userid'                   => $complete_userid,
                                            'app1_by'                       => $complete_by,
                                            'app1_date'                     => $complete_date,
                                            'app1_time'                     => $complete_time,
                                            'app1_position'                 => $session_data['jabnm'],
                                            'app1_personalid'               => $session_data['personalid'],
                                            'app1_personalstatus'           => $session_data['personalstatus'],
                                            'app1_status'                   => '1',
                                            'app1_comp'                     => $complete_comp,  // versi user original
                                            'status_detail'                 => '1',
                                            'status_detailx'                => '1',
                                            'batubara_stock_awal_total'     => $batubara_stock_awal_total,
                                            'batubara_terima_total'         => $batubara_terima_total,
                                            'batubara_pakai_total'          => $batubara_pakai_total,
                                            'batubara_stock_akhir_total'    => $batubara_stock_akhir_total,
                                            'debu_arang_terima_total'       => $debu_arang_terima_total,
                                            'debu_arang_pakai_total'        => $debu_arang_pakai_total,
                                            'tempurung_stock_awal_total'    => $tempurung_stock_awal_total,
                                            'tempurung_terima_total'        => $tempurung_terima_total,
                                            'tempurung_pakai_total'         => $tempurung_pakai_total,
                                            'tempurung_stock_akhir_total'   => $tempurung_stock_akhir_total,
                                            'sabut_stock_awal_total'        => $sabut_stock_awal_total,
                                            'sabut_terima_total'            => $sabut_terima_total,
                                            'sabut_pakai_total'             => $sabut_pakai_total,
                                            'sabut_stock_akhir_total'       => $sabut_stock_akhir_total,
                                            'cocopiet_terima_total'         => $cocopiet_terima_total,
                                            'cocopiet_pakai_total'          => $cocopiet_pakai_total,
                                            'total_pakai_bahan_bakar_total' => $total_pakai_bahan_bakar_total,
                                            'batubara_stock_awal_rata2'     => $batubara_stock_awal_rata2,
                                            'batubara_terima_rata2'         => $batubara_terima_rata2,
                                            'batubara_pakai_rata2'          => $batubara_pakai_rata2,
                                            'batubara_stock_akhir_rata2'    => $batubara_stock_akhir_rata2,
                                            'debu_arang_terima_rata2'       => $debu_arang_terima_rata2,
                                            'debu_arang_pakai_rata2'        => $debu_arang_pakai_rata2,
                                            'tempurung_stock_awal_rata2'    => $tempurung_stock_awal_rata2,
                                            'tempurung_terima_rata2'        => $tempurung_terima_rata2,
                                            'tempurung_pakai_rata2'         => $tempurung_pakai_rata2,
                                            'tempurung_stock_akhir_rata2'   => $tempurung_stock_akhir_rata2,
                                            'sabut_stock_awal_rata2'        => $sabut_stock_awal_rata2,
                                            'sabut_terima_rata2'            => $sabut_terima_rata2,
                                            'sabut_pakai_rata2'             => $sabut_pakai_rata2,
                                            'sabut_stock_akhir_rata2'       => $sabut_stock_akhir_rata2,
                                            'cocopiet_terima_rata2'         => $cocopiet_terima_rata2,
                                            'cocopiet_pakai_rata2'          => $cocopiet_pakai_rata2,
                                            'total_pakai_bahan_bakar_rata2' => $total_pakai_bahan_bakar_rata2
                                        );
                                    }
                                    $alertmessage = "<script>alert('Data berhasil dikomplit ! ');</script>";
                                    break;
                                default:
                                    break;
                            }

                            $this->model->update_hdr($headerid, $data4);

                            $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                            ///
                            /// update detail belum fix
                            /// jadi rencananya hanya yg table atau field bisa di edit aja yg operasi_nilai update data
                            /// sisanya insert ulang aja (hapus dulu data sebelumnya)
                            /// ersyad 20220718
                            ///

                            //edit detail
                            $jml = count($this->input->post('tanggal_bahan_bakar'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($detail_id[$i])) {
                                    $data5 = array(
                                        'stdtl'                   => $stdtl,
                                        'tanggal_bahan_bakar'     => $tanggal_bahan_bakar[$i],
                                        'batubara_stock_awal'     => $batubara_stock_awal[$i],
                                        'batubara_terima'         => $batubara_terima[$i],
                                        'batubara_pakai'          => $batubara_pakai[$i],
                                        'batubara_stock_akhir'    => $batubara_stock_akhir[$i],
                                        'debu_arang_terima'       => $debu_arang_terima[$i],
                                        'debu_arang_pakai'        => $debu_arang_pakai[$i],
                                        'tempurung_stock_awal'    => $tempurung_stock_awal[$i],
                                        'tempurung_terima'        => $tempurung_terima[$i],
                                        'tempurung_pakai'         => $tempurung_pakai[$i],
                                        'tempurung_stock_akhir'   => $tempurung_stock_akhir[$i],
                                        'sabut_stock_awal'        => $sabut_stock_awal[$i],
                                        'sabut_terima'            => $sabut_terima[$i],
                                        'sabut_pakai'             => $sabut_pakai[$i],
                                        'sabut_stock_akhir'       => $sabut_stock_akhir[$i],
                                        'cocopiet_terima'         => $cocopiet_terima[$i],
                                        'cocopiet_pakai'          => $cocopiet_pakai[$i],
                                        'total_pakai_bahan_bakar' => $total_pakai_bahan_bakar[$i]
                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl($detail_id[$i], $data5);
                                    } else {
                                        $this->model->update_dtl($detail_id[$i], $data5);
                                        $this->model->update_dtl($detail_id[$i], $data5);
                                    }
                                } else {
                                    $data5 = array(
                                        'headerid'                => $headerid,
                                        'stdtl'                   => $stdtl,
                                        'tanggal_bahan_bakar'     => $tanggal_bahan_bakar[$i],
                                        'batubara_stock_awal'     => $batubara_stock_awal[$i],
                                        'batubara_terima'         => $batubara_terima[$i],
                                        'batubara_pakai'          => $batubara_pakai[$i],
                                        'batubara_stock_akhir'    => $batubara_stock_akhir[$i],
                                        'debu_arang_terima'       => $debu_arang_terima[$i],
                                        'debu_arang_pakai'        => $debu_arang_pakai[$i],
                                        'tempurung_stock_awal'    => $tempurung_stock_awal[$i],
                                        'tempurung_terima'        => $tempurung_terima[$i],
                                        'tempurung_pakai'         => $tempurung_pakai[$i],
                                        'tempurung_stock_akhir'   => $tempurung_stock_akhir[$i],
                                        'sabut_stock_awal'        => $sabut_stock_awal[$i],
                                        'sabut_terima'            => $sabut_terima[$i],
                                        'sabut_pakai'             => $sabut_pakai[$i],
                                        'sabut_stock_akhir'       => $sabut_stock_akhir[$i],
                                        'cocopiet_terima'         => $cocopiet_terima[$i],
                                        'cocopiet_pakai'          => $cocopiet_pakai[$i],
                                        'total_pakai_bahan_bakar' => $total_pakai_bahan_bakar[$i]
                                    );

                                    $this->model->insert_detail($data5);
                                }
                            }

                            $this->model->insert_detailx($headerid);
                        }
                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
                } else {
                    echo "<script>alert('gagal, tidak ada aksi !');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                }
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}
