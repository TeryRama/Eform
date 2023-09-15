<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_forminttbn009_02 extends CI_Controller
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

            $date_day     = date("d", strtotime($create_date));
            $arr_bulan    = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            $docno        = 'LH/TBN/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' .  str_pad($date_day, 3, '0', STR_PAD_LEFT);

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
            $session_data                   = $this->session->userdata('logged_in');
            $create_date                    = date("Y-m-d", strtotime($this->input->post('create_date')));
            $tgl_kemarin                    = date('Y-m-d', strtotime($create_date . "-1 days"));

            $result_master_generator        = $this->model->get_master_generator($create_date);
            $result_master_steam            = $this->model->get_master_steam($create_date);
            $result_master_trafo            = $this->model->get_master_trafo($create_date);
            $result_master_meteran          = $this->model->get_master_meteran_kwh($create_date);
            $result_master_dept_pengguna    = $this->model->get_master_dept_pengguna($create_date);

            if (!empty($result_master_steam) && !empty($result_master_trafo)) {
                $pesan = "Berhasil mengambil data!";
                $pesan .= !empty($result_master_generator) ? "\n MASTER GENERATOR ✔" : "\n MASTER GENERATOR ✘";
                $pesan .= !empty($result_master_steam) ? "\n MASTER STEAM ✔" : "\n MASTER STEAM ✘";
                $pesan .= !empty($result_master_trafo) ? "\n MASTER TRAFO ✔" : "\n MASTER TRAFO ✘";
                $pesan .= !empty($result_master_meteran) ? "\n MASTER METERAN ✔" : "\n MASTER METERAN ✘";
                $pesan .= !empty($result_master_dept_pengguna) ? "\n MASTER DEPT PENGGUNA ✔" : "\n MASTER DEPT PENGGUNA ✘";

                $result = [
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => $pesan,
                    'data'    => [
                        'result_master_generator'     => $result_master_generator,
                        'result_master_steam'         => $result_master_steam,
                        'result_master_trafo'         => $result_master_trafo,
                        'result_master_meteran'       => $result_master_meteran,
                        'result_master_dept_pengguna' => $result_master_dept_pengguna
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
            $session_data                 = $this->session->userdata('logged_in');
            $data['userid']               = $session_data['userid'];
            $data['username']             = $session_data['username'];
            $data['password']             = $session_data['password'];
            $data['jabid']                = $session_data['jabid'];
            $data['leveluserid']          = $session_data['leveluserid'];
            $data['nmdepan']              = $session_data['nmdepan'];
            $data['nmlengkap']            = $session_data['nmlengkap'];
            $data['levelusernm']          = $session_data['levelusernm'];
            $data['bagnm']                = $session_data['bagnm'];
            $data['bagian_akses']         = $session_data['bagian_akses'];
            $data['jabnm']                = $session_data['jabnm'];
            $data['personalid']           = $session_data['personalid'];
            $data['personalstatus']       = $session_data['personalstatus'];
            $data['Titel']                = 'MONITORING';

            $LevelUser                    = $session_data['leveluserid'];
            $UserName                     = $session_data['username'];
            $LevelUserNm                  = $session_data['levelusernm'];

            $cekLevelUserNm               = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm']       = substr($LevelUserNm, 0, 7);

            $menus                        = $this->M_menu->menus($LevelUser);
            $data2                        = array('menus' => $menus);

            //ambil variabel URL
            $frmkode                      = $this->uri->segment(4);
            $frmvrs                       = $this->uri->segment(5);
            $frmaksi                      = $this->uri->segment(6);

            $dtfrm                        = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                        = array('dtfrm' => $dtfrm);

            $frmnm                        = $dtfrm[0]->formnm;

            // data hedder
            $headerid                     = addslashes($this->input->post('headerid'));

            $complete_userid              = $session_data['userid'];
            $complete_date                = date('Y-m-d');
            $complete_time                = date('H:i:s');
            $complete_by                  = $session_data['nmlengkap'];
            $complete_comp                = $this->session->userdata('hostname');  // versi user original

            $create_date                             = date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));    // dari inputan d-m-Y
            $docno                                   = addslashes($this->input->post('docno'));
            $supplay_pwh                             = addslashes($this->input->post('supplay_pwh'));
            $total_dtl_e_kwh_nilai                   = addslashes($this->input->post('total_dtl_e_kwh_nilai'));
            $total_dtl_e_kwh_akumulatif              = addslashes($this->input->post('total_dtl_e_kwh_akumulatif'));
            $total_dtl_a_steam_nilai                 = addslashes($this->input->post('total_dtl_a_steam_nilai'));
            $total_dtl_a_steam_akumulatif            = addslashes($this->input->post('total_dtl_a_steam_akumulatif'));
            $total_dtl_a_press_nilai                 = addslashes($this->input->post('total_dtl_a_press_nilai'));
            $total_dtl_a_press_akumulatif            = addslashes($this->input->post('total_dtl_a_press_akumulatif'));
            $total_dtl_a_batubara_nilai              = addslashes($this->input->post('total_dtl_a_batubara_nilai'));
            $total_dtl_a_batubara_akumulatif         = addslashes($this->input->post('total_dtl_a_batubara_akumulatif'));
            $total_dtl_a_debu_nilai                  = addslashes($this->input->post('total_dtl_a_debu_nilai'));
            $total_dtl_a_debu_akumulatif             = addslashes($this->input->post('total_dtl_a_debu_akumulatif'));
            $total_dtl_a_cocopit_nilai               = addslashes($this->input->post('total_dtl_a_cocopit_nilai'));
            $total_dtl_a_cocopit_akumulatif          = addslashes($this->input->post('total_dtl_a_cocopit_akumulatif'));
            $total_dtl_a_tempurung_nilai             = addslashes($this->input->post('total_dtl_a_tempurung_nilai'));
            $total_dtl_a_tempurung_akumulatif        = addslashes($this->input->post('total_dtl_a_tempurung_akumulatif'));
            $total_dtl_a_bb_nilai                    = addslashes($this->input->post('total_dtl_a_bb_nilai'));
            $total_dtl_a_bb_akumulatif               = addslashes($this->input->post('total_dtl_a_bb_akumulatif'));
            $total_dtl_a_sabut_nilai                 = addslashes($this->input->post('total_dtl_a_sabut_nilai'));
            $total_dtl_a_sabut_akumulatif            = addslashes($this->input->post('total_dtl_a_sabut_akumulatif'));
            $total_dtl_a_steam_batubara_nilai        = addslashes($this->input->post('total_dtl_a_steam_batubara_nilai'));
            $total_dtl_a_steam_batubara_akumulatif   = addslashes($this->input->post('total_dtl_a_steam_batubara_akumulatif'));
            $total_dtl_a_steam_bahanbakar_nilai      = addslashes($this->input->post('total_dtl_a_steam_bahanbakar_nilai'));
            $total_dtl_a_steam_bahanbakar_akumulatif = addslashes($this->input->post('total_dtl_a_steam_bahanbakar_akumulatif'));
            $total_dtl_a_operasi_nilai               = addslashes($this->input->post('total_dtl_a_operasi_nilai'));
            $total_dtl_a_operasi_akumulatif          = addslashes($this->input->post('total_dtl_a_operasi_akumulatif'));
            $total_dtl_a_dearator_nilai              = addslashes($this->input->post('total_dtl_a_dearator_nilai'));
            $total_dtl_a_dearator_akumulatif         = addslashes($this->input->post('total_dtl_a_dearator_akumulatif'));
            $total_dtl_a_demian_nilai                = addslashes($this->input->post('total_dtl_a_demian_nilai'));
            $total_dtl_a_demian_akumulatif           = addslashes($this->input->post('total_dtl_a_demian_akumulatif'));
            $total_dtl_a_ct_nilai                    = addslashes($this->input->post('total_dtl_a_ct_nilai'));
            $total_dtl_a_ct_akumulatif               = addslashes($this->input->post('total_dtl_a_ct_akumulatif'));
            $total_2generator                        = addslashes($this->input->post('total_2generator'));
            $total_2generator_akumulatif             = addslashes($this->input->post('total_2generator_akumulatif'));
            $selisih_kwh_generator                   = addslashes($this->input->post('selisih_kwh_generator'));
            $total_dtl_b_kwh_nilai                   = addslashes($this->input->post('total_dtl_b_kwh_nilai'));
            $total_dtl_b_kwh_akumulatif              = addslashes($this->input->post('total_dtl_b_kwh_akumulatif'));
            $total_dtl_b_bahanbakar_nilai            = addslashes($this->input->post('total_dtl_b_bahanbakar_nilai'));
            $total_dtl_b_bahanbakar_akumulatif       = addslashes($this->input->post('total_dtl_b_bahanbakar_akumulatif'));
            $total_dtl_b_kwh_efisiensi_nilai         = addslashes($this->input->post('total_dtl_b_kwh_efisiensi_nilai'));
            $total_dtl_b_kwh_efisiensi_akumulatif    = addslashes($this->input->post('total_dtl_b_kwh_efisiensi_akumulatif'));
            $total_dtl_b_operasi_nilai               = addslashes($this->input->post('total_dtl_b_operasi_nilai'));
            $total_dtl_b_operasi_akumulatif          = addslashes($this->input->post('total_dtl_b_operasi_akumulatif'));
            $total_dtl_b_solar_nilai                 = addslashes($this->input->post('total_dtl_b_solar_nilai'));
            $total_dtl_b_solar_akumulatif            = addslashes($this->input->post('total_dtl_b_solar_akumulatif'));
            $total_real_pakai                        = addslashes($this->input->post('total_real_pakai'));
            $total_kwh_generator1_nilai              = addslashes($this->input->post('total_kwh_generator1_nilai'));
            $total_kwh_generator2_nilai              = addslashes($this->input->post('total_kwh_generator2_nilai'));
            $total_star_genset                       = addslashes($this->input->post('total_star_genset'));
            $total_generator                         = addslashes($this->input->post('total_generator'));
            $total_kwh_loss_nilai                    = addslashes($this->input->post('total_kwh_loss_nilai'));
            $total_dtl_d_pemakai_kwh                 = addslashes($this->input->post('total_dtl_d_pemakai_kwh'));
            $total_dtl_d_pemakai_kwh_loss            = addslashes($this->input->post('total_dtl_d_pemakai_kwh_loss'));
            $total_dtl_d_pemakai_kwh_total           = addslashes($this->input->post('total_dtl_d_pemakai_kwh_total'));
            $total_dtl_d_pemakai_persen              = addslashes($this->input->post('total_dtl_d_pemakai_persen'));
            $total_dtl_d_pemakai_akumulatif          = addslashes($this->input->post('total_dtl_d_pemakai_akumulatif'));
            $total_dtl_d_bahan_bakar_kwh             = addslashes($this->input->post('total_dtl_d_bahan_bakar_kwh'));
            $total_dtl_d_bahan_bakar_persen          = addslashes($this->input->post('total_dtl_d_bahan_bakar_persen'));
            $total_dtl_d_bahan_bakar_akumulatif      = addslashes($this->input->post('total_dtl_d_bahan_bakar_akumulatif'));
            $ef_ton_steam                            = addslashes($this->input->post('ef_ton_steam'));
            $ef_kg_bb                                = addslashes($this->input->post('ef_kg_bb'));
            $stock_batubara                          = addslashes($this->input->post('stock_batubara'));
            $ef_kwh                                  = addslashes($this->input->post('ef_kwh'));
            $ef_bb                                   = addslashes($this->input->post('ef_bb'));
            $ef_kwh2                                 = addslashes($this->input->post('ef_kwh2'));
            $ef_bb2                                  = addslashes($this->input->post('ef_bb2'));

            // dtl a
            $dtl_a_detail_id                        = $this->input->post('dtl_a_detail_id');
            $dtl_a_dept_steam                       = $this->input->post('dtl_a_dept_steam');
            $dtl_a_steam_nilai                      = $this->input->post('dtl_a_steam_nilai');
            $dtl_a_steam_akumulatif                 = $this->input->post('dtl_a_steam_akumulatif');
            $dtl_a_steam_akumulatif_awal            = $this->input->post('dtl_a_steam_akumulatif_awal');
            $dtl_a_press_nilai                      = $this->input->post('dtl_a_press_nilai');
            $dtl_a_press_akumulatif                 = $this->input->post('dtl_a_press_akumulatif');
            $dtl_a_press_akumulatif_awal            = $this->input->post('dtl_a_press_akumulatif_awal');
            $dtl_a_batubara_nilai                   = $this->input->post('dtl_a_batubara_nilai');
            $dtl_a_batubara_akumulatif              = $this->input->post('dtl_a_batubara_akumulatif');
            $dtl_a_batubara_akumulatif_awal         = $this->input->post('dtl_a_batubara_akumulatif_awal');
            $dtl_a_cocopit_nilai                    = $this->input->post('dtl_a_cocopit_nilai');
            $dtl_a_cocopit_akumulatif               = $this->input->post('dtl_a_cocopit_akumulatif');
            $dtl_a_cocopit_akumulatif_awal          = $this->input->post('dtl_a_cocopit_akumulatif_awal');
            $dtl_a_tempurung_nilai                  = $this->input->post('dtl_a_tempurung_nilai');
            $dtl_a_tempurung_akumulatif             = $this->input->post('dtl_a_tempurung_akumulatif');
            $dtl_a_tempurung_akumulatif_awal        = $this->input->post('dtl_a_tempurung_akumulatif_awal');
            $dtl_a_bb_nilai                         = $this->input->post('dtl_a_bb_nilai');
            $dtl_a_bb_akumulatif                    = $this->input->post('dtl_a_bb_akumulatif');
            $dtl_a_bb_akumulatif_awal               = $this->input->post('dtl_a_bb_akumulatif_awal');
            $dtl_a_sabut_nilai                      = $this->input->post('dtl_a_sabut_nilai');
            $dtl_a_sabut_akumulatif                 = $this->input->post('dtl_a_sabut_akumulatif');
            $dtl_a_sabut_akumulatif_awal            = $this->input->post('dtl_a_sabut_akumulatif_awal');
            $dtl_a_steam_batubara_nilai             = $this->input->post('dtl_a_steam_batubara_nilai');
            $dtl_a_steam_batubara_akumulatif        = $this->input->post('dtl_a_steam_batubara_akumulatif');
            $dtl_a_steam_batubara_akumulatif_awal   = $this->input->post('dtl_a_steam_batubara_akumulatif_awal');
            $dtl_a_steam_bahanbakar_nilai           = $this->input->post('dtl_a_steam_bahanbakar_nilai');
            $dtl_a_steam_bahanbakar_akumulatif      = $this->input->post('dtl_a_steam_bahanbakar_akumulatif');
            $dtl_a_steam_bahanbakar_akumulatif_awal = $this->input->post('dtl_a_steam_bahanbakar_akumulatif_awal');
            $dtl_a_operasi_nilai                    = $this->input->post('dtl_a_operasi_nilai');
            $dtl_a_operasi_akumulatif               = $this->input->post('dtl_a_operasi_akumulatif');
            $dtl_a_operasi_akumulatif_awal          = $this->input->post('dtl_a_operasi_akumulatif_awal');
            $dtl_a_dearator_nilai                   = $this->input->post('dtl_a_dearator_nilai');
            $dtl_a_dearator_akumulatif              = $this->input->post('dtl_a_dearator_akumulatif');
            $dtl_a_dearator_akumulatif_awal         = $this->input->post('dtl_a_dearator_akumulatif_awal');
            $dtl_a_demian_nilai                     = $this->input->post('dtl_a_demian_nilai');
            $dtl_a_demian_akumulatif                = $this->input->post('dtl_a_demian_akumulatif');
            $dtl_a_demian_akumulatif_awal           = $this->input->post('dtl_a_demian_akumulatif_awal');
            $dtl_a_ct_nilai                         = $this->input->post('dtl_a_ct_nilai');
            $dtl_a_ct_akumulatif                    = $this->input->post('dtl_a_ct_akumulatif');
            $dtl_a_ct_akumulatif_awal               = $this->input->post('dtl_a_ct_akumulatif_awal');
            $dtl_a_debu_nilai                       = $this->input->post('dtl_a_debu_nilai');
            $dtl_a_debu_akumulatif                  = $this->input->post('dtl_a_debu_akumulatif');
            $dtl_a_debu_akumulatif_awal             = $this->input->post('dtl_a_debu_akumulatif_awal');

            // dtl b
            $dtl_b_detail_id                     = $this->input->post('dtl_b_detail_id');
            $dtl_b_trafo                         = $this->input->post('dtl_b_trafo');
            $dtl_b_kwh_nilai                     = $this->input->post('dtl_b_kwh_nilai');
            $dtl_b_kwh_akumulatif                = $this->input->post('dtl_b_kwh_akumulatif');
            $dtl_b_bahanbakar_nilai              = $this->input->post('dtl_b_bahanbakar_nilai');
            $dtl_b_bahanbakar_akumulatif         = $this->input->post('dtl_b_bahanbakar_akumulatif');
            $dtl_b_kwh_efisiensi_nilai           = $this->input->post('dtl_b_kwh_efisiensi_nilai');
            $dtl_b_kwh_efisiensi_akumulatif      = $this->input->post('dtl_b_kwh_efisiensi_akumulatif');
            $dtl_b_operasi_nilai                 = $this->input->post('dtl_b_operasi_nilai');
            $dtl_b_operasi_akumulatif            = $this->input->post('dtl_b_operasi_akumulatif');
            $dtl_b_solar_nilai                   = $this->input->post('dtl_b_solar_nilai');
            $dtl_b_solar_akumulatif              = $this->input->post('dtl_b_solar_akumulatif');
            $dtl_b_nama_trafo                    = $this->input->post('dtl_b_nama_trafo');
            $dtl_b_read_ct_trafo                 = $this->input->post('dtl_b_read_ct_trafo');
            $dtl_b_rata_hari                     = $this->input->post('dtl_b_rata_hari');
            $dtl_b_jam                           = $this->input->post('dtl_b_jam');
            $dtl_b_kwh_6k5_nilai                 = $this->input->post('dtl_b_kwh_6k5_nilai');
            $dtl_b_trafo_awal                    = $this->input->post('dtl_b_trafo_awal');
            $dtl_b_trafo_akhir                   = $this->input->post('dtl_b_trafo_akhir');
            $dtl_b_trafo_putaran                 = $this->input->post('dtl_b_trafo_putaran');
            $dtl_b_kwh_akumulatif_awal           = $this->input->post('dtl_b_kwh_akumulatif_awal');
            $dtl_b_bahanbakar_akumulatif_awal    = $this->input->post('dtl_b_bahanbakar_akumulatif_awal');
            $dtl_b_kwh_efisiensi_akumulatif_awal = $this->input->post('dtl_b_kwh_efisiensi_akumulatif_awal');
            $dtl_b_operasi_akumulatif_awal       = $this->input->post('dtl_b_operasi_akumulatif_awal');
            $dtl_b_solar_akumulatif_awal         = $this->input->post('dtl_b_solar_akumulatif_awal');

            // dtl c
            $dtl_c_detail_id                        = $this->input->post('dtl_c_detail_id');
            $dtl_c_kode                             = $this->input->post('dtl_c_kode');
            $dtl_c_item_id                          = $this->input->post('dtl_c_item_id');
            $dtl_c_reading_ct                       = $this->input->post('dtl_c_reading_ct');
            $dtl_c_dept_panel                       = $this->input->post('dtl_c_dept_panel');
            $dtl_c_dept_user                        = $this->input->post('dtl_c_dept_user');
            $dtl_c_status_beban                     = $this->input->post('dtl_c_status_beban');
            $dtl_c_kwh_awal                         = $this->input->post('dtl_c_kwh_awal');
            $dtl_c_kwh_akhir                        = $this->input->post('dtl_c_kwh_akhir');
            $dtl_c_putaran_hasil                    = $this->input->post('dtl_c_putaran_hasil');
            $dtl_c_kwh_nilai                        = $this->input->post('dtl_c_kwh_nilai');
            $dtl_c_kwh_real_nilai                   = $this->input->post('dtl_c_kwh_real_nilai');
            $dtl_c_rata_hari                        = $this->input->post('dtl_c_rata_hari');
            $dtl_c_jam_operasi                      = $this->input->post('dtl_c_jam_operasi');
            $dtl_c_kwh_6k6_hasil                    = $this->input->post('dtl_c_kwh_6k6_hasil');
            $dtl_c_beban_persen                     = $this->input->post('dtl_c_beban_persen');
            $dtl_c_beban_persen_fix                 = $this->input->post('dtl_c_beban_persen_fix');
            $dtl_c_beban                            = $this->input->post('dtl_c_beban');

            // dtl d
            $dtl_d_detail_id                        = $this->input->post('dtl_d_detail_id');
            $dtl_d_id_pemakai_panel                 = $this->input->post('dtl_d_id_pemakai_panel');
            $dtl_d_pemakai_panel                    = $this->input->post('dtl_d_pemakai_panel');
            $dtl_d_pemakai_kwh                      = $this->input->post('dtl_d_pemakai_kwh');
            $dtl_d_pemakai_kwh_loss                 = $this->input->post('dtl_d_pemakai_kwh_loss');
            $dtl_d_pemakai_kwh_total                = $this->input->post('dtl_d_pemakai_kwh_total');
            $dtl_d_pemakai_persen                   = $this->input->post('dtl_d_pemakai_persen');
            $dtl_d_pemakai_akumulatif               = $this->input->post('dtl_d_pemakai_akumulatif');
            $dtl_d_bahan_bakar_kwh                  = $this->input->post('dtl_d_bahan_bakar_kwh');
            $dtl_d_bahan_bakar_persen               = $this->input->post('dtl_d_bahan_bakar_persen');
            $dtl_d_bahan_bakar_akumulatif           = $this->input->post('dtl_d_bahan_bakar_akumulatif');
            $dtl_d_pakai_akumulatif_sementara       = $this->input->post('dtl_d_pakai_akumulatif_sementara');
            $dtl_d_bahan_bakar_akumulatif_sementara = $this->input->post('dtl_d_bahan_bakar_akumulatif_sementara');

            // dtl e
            $dtl_e_detail_id                        = $this->input->post('dtl_e_detail_id');
            $dtl_e_item_id                          = $this->input->post('dtl_e_item_id');
            $dtl_e_generator                        = $this->input->post('dtl_e_generator');
            $dtl_e_shift                            = $this->input->post('dtl_e_shift');
            $dtl_e_read_ct                          = $this->input->post('dtl_e_read_ct');
            $dtl_e_putaran                          = $this->input->post('dtl_e_putaran');
            $dtl_e_kwh_nilai                        = $this->input->post('dtl_e_kwh_nilai');
            $dtl_e_kwh_akumulatif                   = $this->input->post('dtl_e_kwh_akumulatif');
            $dtl_e_kwh_akumulatif_awal              = $this->input->post('dtl_e_kwh_akumulatif_awal');

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno);

                // cek kalau create date dan docno sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    // pesan gagal krn data sudah ada
                    $data['message']                                   = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ' dan No Dokumen : ' . $docno . ' sudah pernah disimpan';
                    $data['dtcreate_date']                             = addslashes($this->input->post('create_date'));
                    $data['dtdocno']                                   = addslashes($this->input->post('docno'));
                    $data['dtsupplay_pwh']                             = addslashes($this->input->post('supplay_pwh'));
                    $data['dttotal_dtl_e_kwh_nilai']                   = addslashes($this->input->post('total_dtl_e_kwh_nilai'));
                    $data['dttotal_dtl_e_kwh_akumulatif']              = addslashes($this->input->post('total_dtl_e_kwh_akumulatif'));
                    $data['dttotal_dtl_a_steam_nilai']                 = addslashes($this->input->post('total_dtl_a_steam_nilai'));
                    $data['dttotal_dtl_a_steam_akumulatif']            = addslashes($this->input->post('total_dtl_a_steam_akumulatif'));
                    $data['dttotal_dtl_a_press_nilai']                 = addslashes($this->input->post('total_dtl_a_press_nilai'));
                    $data['dttotal_dtl_a_press_akumulatif']            = addslashes($this->input->post('total_dtl_a_press_akumulatif'));
                    $data['dttotal_dtl_a_batubara_nilai']              = addslashes($this->input->post('total_dtl_a_batubara_nilai'));
                    $data['dttotal_dtl_a_batubara_akumulatif']         = addslashes($this->input->post('total_dtl_a_batubara_akumulatif'));
                    $data['dttotal_dtl_a_debu_nilai']                  = addslashes($this->input->post('total_dtl_a_debu_nilai'));
                    $data['dttotal_dtl_a_debu_akumulatif']             = addslashes($this->input->post('total_dtl_a_debu_akumulatif'));
                    $data['dttotal_dtl_a_cocopit_nilai']               = addslashes($this->input->post('total_dtl_a_cocopit_nilai'));
                    $data['dttotal_dtl_a_cocopit_akumulatif']          = addslashes($this->input->post('total_dtl_a_cocopit_akumulatif'));
                    $data['dttotal_dtl_a_tempurung_nilai']             = addslashes($this->input->post('total_dtl_a_tempurung_nilai'));
                    $data['dttotal_dtl_a_tempurung_akumulatif']        = addslashes($this->input->post('total_dtl_a_tempurung_akumulatif'));
                    $data['dttotal_dtl_a_bb_nilai']                    = addslashes($this->input->post('total_dtl_a_bb_nilai'));
                    $data['dttotal_dtl_a_bb_akumulatif']               = addslashes($this->input->post('total_dtl_a_bb_akumulatif'));
                    $data['dttotal_dtl_a_sabut_nilai']                 = addslashes($this->input->post('total_dtl_a_sabut_nilai'));
                    $data['dttotal_dtl_a_sabut_akumulatif']            = addslashes($this->input->post('total_dtl_a_sabut_akumulatif'));
                    $data['dttotal_dtl_a_steam_batubara_nilai']        = addslashes($this->input->post('total_dtl_a_steam_batubara_nilai'));
                    $data['dttotal_dtl_a_steam_batubara_akumulatif']   = addslashes($this->input->post('total_dtl_a_steam_batubara_akumulatif'));
                    $data['dttotal_dtl_a_steam_bahanbakar_nilai']      = addslashes($this->input->post('total_dtl_a_steam_bahanbakar_nilai'));
                    $data['dttotal_dtl_a_steam_bahanbakar_akumulatif'] = addslashes($this->input->post('total_dtl_a_steam_bahanbakar_akumulatif'));
                    $data['dttotal_dtl_a_operasi_nilai']               = addslashes($this->input->post('total_dtl_a_operasi_nilai'));
                    $data['dttotal_dtl_a_operasi_akumulatif']          = addslashes($this->input->post('total_dtl_a_operasi_akumulatif'));
                    $data['dttotal_dtl_a_dearator_nilai']              = addslashes($this->input->post('total_dtl_a_dearator_nilai'));
                    $data['dttotal_dtl_a_dearator_akumulatif']         = addslashes($this->input->post('total_dtl_a_dearator_akumulatif'));
                    $data['dttotal_dtl_a_demian_nilai']                = addslashes($this->input->post('total_dtl_a_demian_nilai'));
                    $data['dttotal_dtl_a_demian_akumulatif']           = addslashes($this->input->post('total_dtl_a_demian_akumulatif'));
                    $data['dttotal_dtl_a_ct_nilai']                    = addslashes($this->input->post('total_dtl_a_ct_nilai'));
                    $data['dttotal_dtl_a_ct_akumulatif']               = addslashes($this->input->post('total_dtl_a_ct_akumulatif'));
                    $data['dttotal_2generator']                        = addslashes($this->input->post('total_2generator'));
                    $data['dttotal_2generator_akumulatif']             = addslashes($this->input->post('total_2generator_akumulatif'));
                    $data['dtselisih_kwh_generator']                   = addslashes($this->input->post('selisih_kwh_generator'));
                    $data['dttotal_dtl_b_kwh_nilai']                   = addslashes($this->input->post('total_dtl_b_kwh_nilai'));
                    $data['dttotal_dtl_b_kwh_akumulatif']              = addslashes($this->input->post('total_dtl_b_kwh_akumulatif'));
                    $data['dttotal_dtl_b_bahanbakar_nilai']            = addslashes($this->input->post('total_dtl_b_bahanbakar_nilai'));
                    $data['dttotal_dtl_b_bahanbakar_akumulatif']       = addslashes($this->input->post('total_dtl_b_bahanbakar_akumulatif'));
                    $data['dttotal_dtl_b_kwh_efisiensi_nilai']         = addslashes($this->input->post('total_dtl_b_kwh_efisiensi_nilai'));
                    $data['dttotal_dtl_b_kwh_efisiensi_akumulatif']    = addslashes($this->input->post('total_dtl_b_kwh_efisiensi_akumulatif'));
                    $data['dttotal_dtl_b_operasi_nilai']               = addslashes($this->input->post('total_dtl_b_operasi_nilai'));
                    $data['dttotal_dtl_b_operasi_akumulatif']          = addslashes($this->input->post('total_dtl_b_operasi_akumulatif'));
                    $data['dttotal_dtl_b_solar_nilai']                 = addslashes($this->input->post('total_dtl_b_solar_nilai'));
                    $data['dttotal_dtl_b_solar_akumulatif']            = addslashes($this->input->post('total_dtl_b_solar_akumulatif'));
                    $data['dttotal_real_pakai']                        = addslashes($this->input->post('total_real_pakai'));
                    $data['dttotal_kwh_generator1_nilai']              = addslashes($this->input->post('total_kwh_generator1_nilai'));
                    $data['dttotal_kwh_generator2_nilai']              = addslashes($this->input->post('total_kwh_generator2_nilai'));
                    $data['dttotal_star_genset']                       = addslashes($this->input->post('total_star_genset'));
                    $data['dttotal_generator']                         = addslashes($this->input->post('total_generator'));
                    $data['dttotal_kwh_loss_nilai']                    = addslashes($this->input->post('total_kwh_loss_nilai'));
                    $data['dttotal_dtl_d_pemakai_kwh']                 = addslashes($this->input->post('total_dtl_d_pemakai_kwh'));
                    $data['dttotal_dtl_d_pemakai_kwh_loss']            = addslashes($this->input->post('total_dtl_d_pemakai_kwh_loss'));
                    $data['dttotal_dtl_d_pemakai_kwh_total']           = addslashes($this->input->post('total_dtl_d_pemakai_kwh_total'));
                    $data['dttotal_dtl_d_pemakai_persen']              = addslashes($this->input->post('total_dtl_d_pemakai_persen'));
                    $data['dttotal_dtl_d_pemakai_akumulatif']          = addslashes($this->input->post('total_dtl_d_pemakai_akumulatif'));
                    $data['dttotal_dtl_d_bahan_bakar_kwh']             = addslashes($this->input->post('total_dtl_d_bahan_bakar_kwh'));
                    $data['dttotal_dtl_d_bahan_bakar_persen']          = addslashes($this->input->post('total_dtl_d_bahan_bakar_persen'));
                    $data['dttotal_dtl_d_bahan_bakar_akumulatif']      = addslashes($this->input->post('total_dtl_d_bahan_bakar_akumulatif'));
                    $data['dtef_ton_steam']                            = addslashes($this->input->post('ef_ton_steam'));
                    $data['dtef_kg_bb']                                = addslashes($this->input->post('ef_kg_bb'));
                    $data['dtstock_batubara']                          = addslashes($this->input->post('stock_batubara'));
                    $data['dtef_kwh']                                  = addslashes($this->input->post('ef_kwh'));
                    $data['dtef_bb']                                   = addslashes($this->input->post('ef_bb'));
                    $data['dtef_kwh2']                                 = addslashes($this->input->post('ef_kwh2'));
                    $data['dtef_bb2']                                  = addslashes($this->input->post('ef_bb2'));

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
                        'complete_useridx'                        => $complete_userid,
                        'complete_byx'                            => $complete_by,
                        'complete_datex'                          => $complete_date,
                        'complete_timex'                          => $complete_time,
                        'complete_compx'                          => $complete_comp,
                        'status_detail'                           => '0',
                        'status_detailx'                          => '0',
                        'create_date'                             => $create_date,
                        'docno'                                   => $docno,
                        'supplay_pwh'                             => $supplay_pwh,
                        'total_dtl_e_kwh_nilai'                   => $total_dtl_e_kwh_nilai,
                        'total_dtl_e_kwh_akumulatif'              => $total_dtl_e_kwh_akumulatif,
                        'total_dtl_a_steam_nilai'                 => $total_dtl_a_steam_nilai,
                        'total_dtl_a_steam_akumulatif'            => $total_dtl_a_steam_akumulatif,
                        'total_dtl_a_press_nilai'                 => $total_dtl_a_press_nilai,
                        'total_dtl_a_press_akumulatif'            => $total_dtl_a_press_akumulatif,
                        'total_dtl_a_batubara_nilai'              => $total_dtl_a_batubara_nilai,
                        'total_dtl_a_batubara_akumulatif'         => $total_dtl_a_batubara_akumulatif,
                        'total_dtl_a_debu_nilai'                  => $total_dtl_a_debu_nilai,
                        'total_dtl_a_debu_akumulatif'             => $total_dtl_a_debu_akumulatif,
                        'total_dtl_a_cocopit_nilai'               => $total_dtl_a_cocopit_nilai,
                        'total_dtl_a_cocopit_akumulatif'          => $total_dtl_a_cocopit_akumulatif,
                        'total_dtl_a_tempurung_nilai'             => $total_dtl_a_tempurung_nilai,
                        'total_dtl_a_tempurung_akumulatif'        => $total_dtl_a_tempurung_akumulatif,
                        'total_dtl_a_bb_nilai'                    => $total_dtl_a_bb_nilai,
                        'total_dtl_a_bb_akumulatif'               => $total_dtl_a_bb_akumulatif,
                        'total_dtl_a_sabut_nilai'                 => $total_dtl_a_sabut_nilai,
                        'total_dtl_a_sabut_akumulatif'            => $total_dtl_a_sabut_akumulatif,
                        'total_dtl_a_steam_batubara_nilai'        => $total_dtl_a_steam_batubara_nilai,
                        'total_dtl_a_steam_batubara_akumulatif'   => $total_dtl_a_steam_batubara_akumulatif,
                        'total_dtl_a_steam_bahanbakar_nilai'      => $total_dtl_a_steam_bahanbakar_nilai,
                        'total_dtl_a_steam_bahanbakar_akumulatif' => $total_dtl_a_steam_bahanbakar_akumulatif,
                        'total_dtl_a_operasi_nilai'               => $total_dtl_a_operasi_nilai,
                        'total_dtl_a_operasi_akumulatif'          => $total_dtl_a_operasi_akumulatif,
                        'total_dtl_a_dearator_nilai'              => $total_dtl_a_dearator_nilai,
                        'total_dtl_a_dearator_akumulatif'         => $total_dtl_a_dearator_akumulatif,
                        'total_dtl_a_demian_nilai'                => $total_dtl_a_demian_nilai,
                        'total_dtl_a_demian_akumulatif'           => $total_dtl_a_demian_akumulatif,
                        'total_dtl_a_ct_nilai'                    => $total_dtl_a_ct_nilai,
                        'total_dtl_a_ct_akumulatif'               => $total_dtl_a_ct_akumulatif,
                        'total_2generator'                        => $total_2generator,
                        'total_2generator_akumulatif'             => $total_2generator_akumulatif,
                        'selisih_kwh_generator'                   => $selisih_kwh_generator,
                        'total_dtl_b_kwh_nilai'                   => $total_dtl_b_kwh_nilai,
                        'total_dtl_b_kwh_akumulatif'              => $total_dtl_b_kwh_akumulatif,
                        'total_dtl_b_bahanbakar_nilai'            => $total_dtl_b_bahanbakar_nilai,
                        'total_dtl_b_bahanbakar_akumulatif'       => $total_dtl_b_bahanbakar_akumulatif,
                        'total_dtl_b_kwh_efisiensi_nilai'         => $total_dtl_b_kwh_efisiensi_nilai,
                        'total_dtl_b_kwh_efisiensi_akumulatif'    => $total_dtl_b_kwh_efisiensi_akumulatif,
                        'total_dtl_b_operasi_nilai'               => $total_dtl_b_operasi_nilai,
                        'total_dtl_b_operasi_akumulatif'          => $total_dtl_b_operasi_akumulatif,
                        'total_dtl_b_solar_nilai'                 => $total_dtl_b_solar_nilai,
                        'total_dtl_b_solar_akumulatif'            => $total_dtl_b_solar_akumulatif,
                        'total_real_pakai'                        => $total_real_pakai,
                        'total_kwh_generator1_nilai'              => $total_kwh_generator1_nilai,
                        'total_kwh_generator2_nilai'              => $total_kwh_generator2_nilai,
                        'total_star_genset'                       => $total_star_genset,
                        'total_generator'                         => $total_generator,
                        'total_kwh_loss_nilai'                    => $total_kwh_loss_nilai,
                        'total_dtl_d_pemakai_kwh'                 => $total_dtl_d_pemakai_kwh,
                        'total_dtl_d_pemakai_kwh_loss'            => $total_dtl_d_pemakai_kwh_loss,
                        'total_dtl_d_pemakai_kwh_total'           => $total_dtl_d_pemakai_kwh_total,
                        'total_dtl_d_pemakai_persen'              => $total_dtl_d_pemakai_persen,
                        'total_dtl_d_pemakai_akumulatif'          => $total_dtl_d_pemakai_akumulatif,
                        'total_dtl_d_bahan_bakar_kwh'             => $total_dtl_d_bahan_bakar_kwh,
                        'total_dtl_d_bahan_bakar_persen'          => $total_dtl_d_bahan_bakar_persen,
                        'total_dtl_d_bahan_bakar_akumulatif'      => $total_dtl_d_bahan_bakar_akumulatif,
                        'ef_ton_steam'                            => $ef_ton_steam,
                        'ef_kg_bb'                                => $ef_kg_bb,
                        'stock_batubara'                          => $stock_batubara,
                        'ef_kwh'                                  => $ef_kwh,
                        'ef_bb'                                   => $ef_bb,
                        'ef_kwh2'                                 => $ef_kwh2,
                        'ef_bb2'                                  => $ef_bb2,
                    );


                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                    // dtl a
                    $jml = count($this->input->post('dtl_a_dept_steam'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid'                         => $max_hdr_id,
                            'stdtl'                            => $stdtl,
                            'dept_steam'                       => $dtl_a_dept_steam[$i],
                            'steam_nilai'                      => $dtl_a_steam_nilai[$i],
                            'steam_akumulatif'                 => $dtl_a_steam_akumulatif[$i],
                            'steam_akumulatif_awal'            => $dtl_a_steam_akumulatif_awal[$i],
                            'press_nilai'                      => $dtl_a_press_nilai[$i],
                            'press_akumulatif'                 => $dtl_a_press_akumulatif[$i],
                            'press_akumulatif_awal'            => $dtl_a_press_akumulatif_awal[$i],
                            'batubara_nilai'                   => $dtl_a_batubara_nilai[$i],
                            'batubara_akumulatif'              => $dtl_a_batubara_akumulatif[$i],
                            'batubara_akumulatif_awal'         => $dtl_a_batubara_akumulatif_awal[$i],
                            'cocopit_nilai'                    => $dtl_a_cocopit_nilai[$i],
                            'cocopit_akumulatif'               => $dtl_a_cocopit_akumulatif[$i],
                            'cocopit_akumulatif_awal'          => $dtl_a_cocopit_akumulatif_awal[$i],
                            'tempurung_nilai'                  => $dtl_a_tempurung_nilai[$i],
                            'tempurung_akumulatif'             => $dtl_a_tempurung_akumulatif[$i],
                            'tempurung_akumulatif_awal'        => $dtl_a_tempurung_akumulatif_awal[$i],
                            'bb_nilai'                         => $dtl_a_bb_nilai[$i],
                            'bb_akumulatif'                    => $dtl_a_bb_akumulatif[$i],
                            'bb_akumulatif_awal'               => $dtl_a_bb_akumulatif_awal[$i],
                            'sabut_nilai'                      => $dtl_a_sabut_nilai[$i],
                            'sabut_akumulatif'                 => $dtl_a_sabut_akumulatif[$i],
                            'sabut_akumulatif_awal'            => $dtl_a_sabut_akumulatif_awal[$i],
                            'steam_batubara_nilai'             => $dtl_a_steam_batubara_nilai[$i],
                            'steam_batubara_akumulatif'        => $dtl_a_steam_batubara_akumulatif[$i],
                            'steam_batubara_akumulatif_awal'   => $dtl_a_steam_batubara_akumulatif_awal[$i],
                            'steam_bahanbakar_nilai'           => $dtl_a_steam_bahanbakar_nilai[$i],
                            'steam_bahanbakar_akumulatif'      => $dtl_a_steam_bahanbakar_akumulatif[$i],
                            'steam_bahanbakar_akumulatif_awal' => $dtl_a_steam_bahanbakar_akumulatif_awal[$i],
                            'operasi_nilai'                    => $dtl_a_operasi_nilai[$i],
                            'operasi_akumulatif'               => $dtl_a_operasi_akumulatif[$i],
                            'operasi_akumulatif_awal'          => $dtl_a_operasi_akumulatif_awal[$i],
                            'dearator_nilai'                   => $dtl_a_dearator_nilai[$i],
                            'dearator_akumulatif'              => $dtl_a_dearator_akumulatif[$i],
                            'dearator_akumulatif_awal'         => $dtl_a_dearator_akumulatif_awal[$i],
                            'demian_nilai'                     => $dtl_a_demian_nilai[$i],
                            'demian_akumulatif'                => $dtl_a_demian_akumulatif[$i],
                            'demian_akumulatif_awal'           => $dtl_a_demian_akumulatif_awal[$i],
                            'ct_nilai'                         => $dtl_a_ct_nilai[$i],
                            'ct_akumulatif'                    => $dtl_a_ct_akumulatif[$i],
                            'ct_akumulatif_awal'               => $dtl_a_ct_akumulatif_awal[$i],
                            'debu_nilai'                       => $dtl_a_debu_nilai[$i],
                            'debu_akumulatif'                  => $dtl_a_debu_akumulatif[$i],
                            'debu_akumulatif_awal'             => $dtl_a_debu_akumulatif_awal[$i],
                        );
                        $this->model->insert_detail($data6);
                    }

                    // dtl b
                    $jml = count($this->input->post('dtl_b_trafo'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'trafo'                         => $dtl_b_trafo[$i],
                            'kwh_nilai'                     => $dtl_b_kwh_nilai[$i],
                            'kwh_akumulatif'                => $dtl_b_kwh_akumulatif[$i],
                            'bahanbakar_nilai'              => $dtl_b_bahanbakar_nilai[$i],
                            'bahanbakar_akumulatif'         => $dtl_b_bahanbakar_akumulatif[$i],
                            'kwh_efisiensi_nilai'           => $dtl_b_kwh_efisiensi_nilai[$i],
                            'kwh_efisiensi_akumulatif'      => $dtl_b_kwh_efisiensi_akumulatif[$i],
                            'operasi_nilai'                 => $dtl_b_operasi_nilai[$i],
                            'operasi_akumulatif'            => $dtl_b_operasi_akumulatif[$i],
                            'solar_nilai'                   => $dtl_b_solar_nilai[$i],
                            'solar_akumulatif'              => $dtl_b_solar_akumulatif[$i],
                            'nama_trafo'                    => $dtl_b_nama_trafo[$i],
                            'read_ct_trafo'                 => $dtl_b_read_ct_trafo[$i],
                            'rata_hari'                     => $dtl_b_rata_hari[$i],
                            'jam'                           => $dtl_b_jam[$i],
                            'kwh_6k5_nilai'                 => $dtl_b_kwh_6k5_nilai[$i],
                            'trafo_awal'                    => $dtl_b_trafo_awal[$i],
                            'trafo_akhir'                   => $dtl_b_trafo_akhir[$i],
                            'trafo_putaran'                 => $dtl_b_trafo_putaran[$i],
                            'kwh_akumulatif_awal'           => $dtl_b_kwh_akumulatif_awal[$i],
                            'bahanbakar_akumulatif_awal'    => $dtl_b_bahanbakar_akumulatif_awal[$i],
                            'kwh_efisiensi_akumulatif_awal' => $dtl_b_kwh_efisiensi_akumulatif_awal[$i],
                            'operasi_akumulatif_awal'       => $dtl_b_operasi_akumulatif_awal[$i],
                            'solar_akumulatif_awal'         => $dtl_b_solar_akumulatif_awal[$i],
                        );
                        $this->model->insert_detail_b($data6);
                    }

                    // dtl c
                    $jml = count($this->input->post('dtl_c_dept_panel'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'kode_kwh'         => $dtl_c_kode[$i],
                            'dtl_c_item_id'    => $dtl_c_item_id[$i],
                            'reading_ct'       => $dtl_c_reading_ct[$i],
                            'dept_panel'       => $dtl_c_dept_panel[$i],
                            'dept_user'        => $dtl_c_dept_user[$i],
                            'status_beban'     => $dtl_c_status_beban[$i],
                            'kwh_awal'         => $dtl_c_kwh_awal[$i],
                            'kwh_akhir'        => $dtl_c_kwh_akhir[$i],
                            'putaran_hasil'    => $dtl_c_putaran_hasil[$i],
                            'kwh_nilai'        => $dtl_c_kwh_nilai[$i],
                            'kwh_real_nilai'   => $dtl_c_kwh_real_nilai[$i],
                            'rata_hari'        => $dtl_c_rata_hari[$i],
                            'jam_operasi'      => $dtl_c_jam_operasi[$i],
                            'kwh_6k6_hasil'    => $dtl_c_kwh_6k6_hasil[$i],
                            'beban_persen'     => $dtl_c_beban_persen[$i],
                            'beban_persen_fix' => $dtl_c_beban_persen_fix[$i],
                            'beban'            => $dtl_c_beban[$i],
                        );
                        $this->model->insert_detail_c($data6);
                    }

                    // dtl d
                    $jml = count($this->input->post('dtl_d_pemakai_panel'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'id_pemakai_panel'                       => $dtl_d_id_pemakai_panel[$i],
                            'pemakai_panel'                          => $dtl_d_pemakai_panel[$i],
                            'pemakai_kwh'                            => $dtl_d_pemakai_kwh[$i],
                            'pemakai_kwh_loss'                       => $dtl_d_pemakai_kwh_loss[$i],
                            'pemakai_kwh_total'                      => $dtl_d_pemakai_kwh_total[$i],
                            'pemakai_persen'                         => $dtl_d_pemakai_persen[$i],
                            'pemakai_akumulatif'                     => $dtl_d_pemakai_akumulatif[$i],
                            'bahan_bakar_kwh'                        => $dtl_d_bahan_bakar_kwh[$i],
                            'bahan_bakar_persen'                     => $dtl_d_bahan_bakar_persen[$i],
                            'bahan_bakar_akumulatif'                 => $dtl_d_bahan_bakar_akumulatif[$i],
                            'dtl_d_pakai_akumulatif_sementara'       => $dtl_d_pakai_akumulatif_sementara[$i],
                            'dtl_d_bahan_bakar_akumulatif_sementara' => $dtl_d_bahan_bakar_akumulatif_sementara[$i],
                        );
                        $this->model->insert_detail_d($data6);
                    }

                    // dtl e
                    $jml = count($this->input->post('dtl_e_generator'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'generator'           => $dtl_e_generator[$i],
                            'item_id'             => $dtl_e_item_id[$i],
                            'shift'               => $dtl_e_shift[$i],
                            'read_ct'             => $dtl_e_read_ct[$i],
                            'putaran'             => $dtl_e_putaran[$i],
                            'kwh_nilai'           => $dtl_e_kwh_nilai[$i],
                            'kwh_akumulatif'      => $dtl_e_kwh_akumulatif[$i],
                            'kwh_akumulatif_awal' => $dtl_e_kwh_akumulatif_awal[$i],
                        );
                        $this->model->insert_detail_e($data6);
                    }

                    $this->model->insert_detailx($max_hdr_id);
                    $this->model->insert_detail_bx($max_hdr_id);
                    $this->model->insert_detail_cx($max_hdr_id);
                    $this->model->insert_detail_dx($max_hdr_id);
                    $this->model->insert_detail_ex($max_hdr_id);

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
                    $data['dtdetail_d']       = $this->model->get_detail_byid_dx($id);
                    $data['dtdetail_e']       = $this->model->get_detail_byid_ex($id);
                } else {
                    $data['dtdetail']         = $this->model->get_detail_byid($id);
                    $data['dtdetail_b']       = $this->model->get_detail_byid_b($id);
                    $data['dtdetail_c']       = $this->model->get_detail_byid_c($id);
                    $data['dtdetail_d']       = $this->model->get_detail_byid_d($id);
                    $data['dtdetail_e']       = $this->model->get_detail_byid_e($id);
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
                                            'complete_userid'                         => $complete_userid,
                                            'complete_by'                             => $complete_by,
                                            'complete_date'                           => $complete_date,
                                            'total_dtl_e_kwh_akumulatif'              => $total_dtl_e_kwh_akumulatif,
                                            'total_dtl_a_steam_nilai'                 => $total_dtl_a_steam_nilai,
                                            'total_dtl_a_steam_akumulatif'            => $total_dtl_a_steam_akumulatif,
                                            'total_dtl_a_press_nilai'                 => $total_dtl_a_press_nilai,
                                            'total_dtl_a_press_akumulatif'            => $total_dtl_a_press_akumulatif,
                                            'total_dtl_a_batubara_nilai'              => $total_dtl_a_batubara_nilai,
                                            'total_dtl_a_batubara_akumulatif'         => $total_dtl_a_batubara_akumulatif,
                                            'total_dtl_a_debu_nilai'                  => $total_dtl_a_debu_nilai,
                                            'total_dtl_a_debu_akumulatif'             => $total_dtl_a_debu_akumulatif,
                                            'total_dtl_a_cocopit_nilai'               => $total_dtl_a_cocopit_nilai,
                                            'total_dtl_a_cocopit_akumulatif'          => $total_dtl_a_cocopit_akumulatif,
                                            'total_dtl_a_tempurung_nilai'             => $total_dtl_a_tempurung_nilai,
                                            'total_dtl_a_tempurung_akumulatif'        => $total_dtl_a_tempurung_akumulatif,
                                            'total_dtl_a_bb_nilai'                    => $total_dtl_a_bb_nilai,
                                            'total_dtl_a_bb_akumulatif'               => $total_dtl_a_bb_akumulatif,
                                            'total_dtl_a_sabut_nilai'                 => $total_dtl_a_sabut_nilai,
                                            'total_dtl_a_sabut_akumulatif'            => $total_dtl_a_sabut_akumulatif,
                                            'total_dtl_a_steam_batubara_nilai'        => $total_dtl_a_steam_batubara_nilai,
                                            'total_dtl_a_steam_batubara_akumulatif'   => $total_dtl_a_steam_batubara_akumulatif,
                                            'total_dtl_a_steam_bahanbakar_nilai'      => $total_dtl_a_steam_bahanbakar_nilai,
                                            'total_dtl_a_steam_bahanbakar_akumulatif' => $total_dtl_a_steam_bahanbakar_akumulatif,
                                            'total_dtl_a_operasi_nilai'               => $total_dtl_a_operasi_nilai,
                                            'total_dtl_a_operasi_akumulatif'          => $total_dtl_a_operasi_akumulatif,
                                            'total_dtl_a_dearator_nilai'              => $total_dtl_a_dearator_nilai,
                                            'total_dtl_a_dearator_akumulatif'         => $total_dtl_a_dearator_akumulatif,
                                            'total_dtl_a_demian_nilai'                => $total_dtl_a_demian_nilai,
                                            'total_dtl_a_demian_akumulatif'           => $total_dtl_a_demian_akumulatif,
                                            'total_dtl_a_ct_nilai'                    => $total_dtl_a_ct_nilai,
                                            'total_dtl_a_ct_akumulatif'               => $total_dtl_a_ct_akumulatif,
                                            'total_2generator'                        => $total_2generator,
                                            'total_2generator_akumulatif'             => $total_2generator_akumulatif,
                                            'selisih_kwh_generator'                   => $selisih_kwh_generator,
                                            'total_dtl_b_kwh_nilai'                   => $total_dtl_b_kwh_nilai,
                                            'total_dtl_b_kwh_akumulatif'              => $total_dtl_b_kwh_akumulatif,
                                            'total_dtl_b_bahanbakar_nilai'            => $total_dtl_b_bahanbakar_nilai,
                                            'total_dtl_b_bahanbakar_akumulatif'       => $total_dtl_b_bahanbakar_akumulatif,
                                            'total_dtl_b_kwh_efisiensi_nilai'         => $total_dtl_b_kwh_efisiensi_nilai,
                                            'total_dtl_b_kwh_efisiensi_akumulatif'    => $total_dtl_b_kwh_efisiensi_akumulatif,
                                            'total_dtl_b_operasi_nilai'               => $total_dtl_b_operasi_nilai,
                                            'total_dtl_b_operasi_akumulatif'          => $total_dtl_b_operasi_akumulatif,
                                            'total_dtl_b_solar_nilai'                 => $total_dtl_b_solar_nilai,
                                            'total_dtl_b_solar_akumulatif'            => $total_dtl_b_solar_akumulatif,
                                            'total_real_pakai'                        => $total_real_pakai,
                                            'total_kwh_generator1_nilai'              => $total_kwh_generator1_nilai,
                                            'total_kwh_generator2_nilai'              => $total_kwh_generator2_nilai,
                                            'total_star_genset'                       => $total_star_genset,
                                            'total_generator'                         => $total_generator,
                                            'total_kwh_loss_nilai'                    => $total_kwh_loss_nilai,
                                            'total_dtl_d_pemakai_kwh'                 => $total_dtl_d_pemakai_kwh,
                                            'total_dtl_d_pemakai_kwh_loss'            => $total_dtl_d_pemakai_kwh_loss,
                                            'total_dtl_d_pemakai_kwh_total'           => $total_dtl_d_pemakai_kwh_total,
                                            'total_dtl_d_pemakai_persen'              => $total_dtl_d_pemakai_persen,
                                            'total_dtl_d_pemakai_akumulatif'          => $total_dtl_d_pemakai_akumulatif,
                                            'total_dtl_d_bahan_bakar_kwh'             => $total_dtl_d_bahan_bakar_kwh,
                                            'total_dtl_d_bahan_bakar_persen'          => $total_dtl_d_bahan_bakar_persen,
                                            'total_dtl_d_bahan_bakar_akumulatif'      => $total_dtl_d_bahan_bakar_akumulatif,
                                            'ef_ton_steam'                            => $ef_ton_steam,
                                            'ef_kg_bb'                                => $ef_kg_bb,
                                            'stock_batubara'                          => $stock_batubara,
                                            'ef_kwh'                                  => $ef_kwh,
                                            'ef_bb'                                   => $ef_bb,
                                            'ef_kwh2'                                 => $ef_kwh2,
                                            'ef_bb2'                                  => $ef_bb2,
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


                            //edit detail a
                            $jml = count($this->input->post('dtl_a_dept_steam'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_a_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'                             => $stdtl,
                                        'dept_steam'                        => $dtl_a_dept_steam[$i],
                                        'steam_nilai'                       => $dtl_a_steam_nilai[$i],
                                        'steam_akumulatif'                  => $dtl_a_steam_akumulatif[$i],
                                        'steam_akumulatif_awal'             => $dtl_a_steam_akumulatif_awal[$i],
                                        'press_nilai'                       => $dtl_a_press_nilai[$i],
                                        'press_akumulatif'                  => $dtl_a_press_akumulatif[$i],
                                        'press_akumulatif_awal'             => $dtl_a_press_akumulatif_awal[$i],
                                        'batubara_nilai'                    => $dtl_a_batubara_nilai[$i],
                                        'batubara_akumulatif'               => $dtl_a_batubara_akumulatif[$i],
                                        'batubara_akumulatif_awal'          => $dtl_a_batubara_akumulatif_awal[$i],
                                        'cocopit_nilai'                     => $dtl_a_cocopit_nilai[$i],
                                        'cocopit_akumulatif'                => $dtl_a_cocopit_akumulatif[$i],
                                        'cocopit_akumulatif_awal'           => $dtl_a_cocopit_akumulatif_awal[$i],
                                        'tempurung_nilai'                   => $dtl_a_tempurung_nilai[$i],
                                        'tempurung_akumulatif'              => $dtl_a_tempurung_akumulatif[$i],
                                        'tempurung_akumulatif_awal'         => $dtl_a_tempurung_akumulatif_awal[$i],
                                        'bb_nilai'                          => $dtl_a_bb_nilai[$i],
                                        'bb_akumulatif'                     => $dtl_a_bb_akumulatif[$i],
                                        'bb_akumulatif_awal'                => $dtl_a_bb_akumulatif_awal[$i],
                                        'sabut_nilai'                       => $dtl_a_sabut_nilai[$i],
                                        'sabut_akumulatif'                  => $dtl_a_sabut_akumulatif[$i],
                                        'sabut_akumulatif_awal'             => $dtl_a_sabut_akumulatif_awal[$i],
                                        'steam_batubara_nilai'              => $dtl_a_steam_batubara_nilai[$i],
                                        'steam_batubara_akumulatif'         => $dtl_a_steam_batubara_akumulatif[$i],
                                        'steam_batubara_akumulatif_awal'    => $dtl_a_steam_batubara_akumulatif_awal[$i],
                                        'steam_bahanbakar_nilai'            => $dtl_a_steam_bahanbakar_nilai[$i],
                                        'steam_bahanbakar_akumulatif'       => $dtl_a_steam_bahanbakar_akumulatif[$i],
                                        'steam_bahanbakar_akumulatif_awal'  => $dtl_a_steam_bahanbakar_akumulatif_awal[$i],
                                        'operasi_nilai'                     => $dtl_a_operasi_nilai[$i],
                                        'operasi_akumulatif'                => $dtl_a_operasi_akumulatif[$i],
                                        'operasi_akumulatif_awal'           => $dtl_a_operasi_akumulatif_awal[$i],
                                        'dearator_nilai'                    => $dtl_a_dearator_nilai[$i],
                                        'dearator_akumulatif'               => $dtl_a_dearator_akumulatif[$i],
                                        'dearator_akumulatif_awal'          => $dtl_a_dearator_akumulatif_awal[$i],
                                        'demian_nilai'                      => $dtl_a_demian_nilai[$i],
                                        'demian_akumulatif'                 => $dtl_a_demian_akumulatif[$i],
                                        'demian_akumulatif_awal'            => $dtl_a_demian_akumulatif_awal[$i],
                                        'ct_nilai'                          => $dtl_a_ct_nilai[$i],
                                        'ct_akumulatif'                     => $dtl_a_ct_akumulatif[$i],
                                        'ct_akumulatif_awal'                => $dtl_a_ct_akumulatif_awal[$i],
                                        'debu_nilai'                        => $dtl_a_debu_nilai[$i],
                                        'debu_akumulatif'                   => $dtl_a_debu_akumulatif[$i],
                                        'debu_akumulatif_awal'              => $dtl_a_debu_akumulatif_awal[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl($dtl_a_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl($dtl_a_detail_id[$i], $data6);
                                        $this->model->update_dtl($dtl_a_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'                          => $headerid,
                                        'stdtl'                             => $stdtl,
                                        'dept_steam'                        => $dtl_a_dept_steam[$i],
                                        'steam_nilai'                       => $dtl_a_steam_nilai[$i],
                                        'steam_akumulatif'                  => $dtl_a_steam_akumulatif[$i],
                                        'steam_akumulatif_awal'             => $dtl_a_steam_akumulatif_awal[$i],
                                        'press_nilai'                       => $dtl_a_press_nilai[$i],
                                        'press_akumulatif'                  => $dtl_a_press_akumulatif[$i],
                                        'press_akumulatif_awal'             => $dtl_a_press_akumulatif_awal[$i],
                                        'batubara_nilai'                    => $dtl_a_batubara_nilai[$i],
                                        'batubara_akumulatif'               => $dtl_a_batubara_akumulatif[$i],
                                        'batubara_akumulatif_awal'          => $dtl_a_batubara_akumulatif_awal[$i],
                                        'cocopit_nilai'                     => $dtl_a_cocopit_nilai[$i],
                                        'cocopit_akumulatif'                => $dtl_a_cocopit_akumulatif[$i],
                                        'cocopit_akumulatif_awal'           => $dtl_a_cocopit_akumulatif_awal[$i],
                                        'tempurung_nilai'                   => $dtl_a_tempurung_nilai[$i],
                                        'tempurung_akumulatif'              => $dtl_a_tempurung_akumulatif[$i],
                                        'tempurung_akumulatif_awal'         => $dtl_a_tempurung_akumulatif_awal[$i],
                                        'bb_nilai'                          => $dtl_a_bb_nilai[$i],
                                        'bb_akumulatif'                     => $dtl_a_bb_akumulatif[$i],
                                        'bb_akumulatif_awal'                => $dtl_a_bb_akumulatif_awal[$i],
                                        'sabut_nilai'                       => $dtl_a_sabut_nilai[$i],
                                        'sabut_akumulatif'                  => $dtl_a_sabut_akumulatif[$i],
                                        'sabut_akumulatif_awal'             => $dtl_a_sabut_akumulatif_awal[$i],
                                        'steam_batubara_nilai'              => $dtl_a_steam_batubara_nilai[$i],
                                        'steam_batubara_akumulatif'         => $dtl_a_steam_batubara_akumulatif[$i],
                                        'steam_batubara_akumulatif_awal'    => $dtl_a_steam_batubara_akumulatif_awal[$i],
                                        'steam_bahanbakar_nilai'            => $dtl_a_steam_bahanbakar_nilai[$i],
                                        'steam_bahanbakar_akumulatif'       => $dtl_a_steam_bahanbakar_akumulatif[$i],
                                        'steam_bahanbakar_akumulatif_awal'  => $dtl_a_steam_bahanbakar_akumulatif_awal[$i],
                                        'operasi_nilai'                     => $dtl_a_operasi_nilai[$i],
                                        'operasi_akumulatif'                => $dtl_a_operasi_akumulatif[$i],
                                        'operasi_akumulatif_awal'           => $dtl_a_operasi_akumulatif_awal[$i],
                                        'dearator_nilai'                    => $dtl_a_dearator_nilai[$i],
                                        'dearator_akumulatif'               => $dtl_a_dearator_akumulatif[$i],
                                        'dearator_akumulatif_awal'          => $dtl_a_dearator_akumulatif_awal[$i],
                                        'demian_nilai'                      => $dtl_a_demian_nilai[$i],
                                        'demian_akumulatif'                 => $dtl_a_demian_akumulatif[$i],
                                        'demian_akumulatif_awal'            => $dtl_a_demian_akumulatif_awal[$i],
                                        'ct_nilai'                          => $dtl_a_ct_nilai[$i],
                                        'ct_akumulatif'                     => $dtl_a_ct_akumulatif[$i],
                                        'ct_akumulatif_awal'                => $dtl_a_ct_akumulatif_awal[$i],
                                        'debu_nilai'                        => $dtl_a_debu_nilai[$i],
                                        'debu_akumulatif'                   => $dtl_a_debu_akumulatif[$i],
                                        'debu_akumulatif_awal'              => $dtl_a_debu_akumulatif_awal[$i],
                                    );

                                    $this->model->insert_detail($data6);
                                }
                            }

                            //edit detail b
                            $jml = count($this->input->post('dtl_b_trafo'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_b_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'                         => $stdtl,
                                        'trafo'                         => $dtl_b_trafo[$i],
                                        'kwh_nilai'                     => $dtl_b_kwh_nilai[$i],
                                        'kwh_akumulatif'                => $dtl_b_kwh_akumulatif[$i],
                                        'bahanbakar_nilai'              => $dtl_b_bahanbakar_nilai[$i],
                                        'bahanbakar_akumulatif'         => $dtl_b_bahanbakar_akumulatif[$i],
                                        'kwh_efisiensi_nilai'           => $dtl_b_kwh_efisiensi_nilai[$i],
                                        'kwh_efisiensi_akumulatif'      => $dtl_b_kwh_efisiensi_akumulatif[$i],
                                        'operasi_nilai'                 => $dtl_b_operasi_nilai[$i],
                                        'operasi_akumulatif'            => $dtl_b_operasi_akumulatif[$i],
                                        'solar_nilai'                   => $dtl_b_solar_nilai[$i],
                                        'solar_akumulatif'              => $dtl_b_solar_akumulatif[$i],
                                        'nama_trafo'                    => $dtl_b_nama_trafo[$i],
                                        'read_ct_trafo'                 => $dtl_b_read_ct_trafo[$i],
                                        'rata_hari'                     => $dtl_b_rata_hari[$i],
                                        'jam'                           => $dtl_b_jam[$i],
                                        'kwh_6k5_nilai'                 => $dtl_b_kwh_6k5_nilai[$i],
                                        'trafo_awal'                    => $dtl_b_trafo_awal[$i],
                                        'trafo_akhir'                   => $dtl_b_trafo_akhir[$i],
                                        'trafo_putaran'                 => $dtl_b_trafo_putaran[$i],
                                        'kwh_akumulatif_awal'           => $dtl_b_kwh_akumulatif_awal[$i],
                                        'bahanbakar_akumulatif_awal'    => $dtl_b_bahanbakar_akumulatif_awal[$i],
                                        'kwh_efisiensi_akumulatif_awal' => $dtl_b_kwh_efisiensi_akumulatif_awal[$i],
                                        'operasi_akumulatif_awal'       => $dtl_b_operasi_akumulatif_awal[$i],
                                        'solar_akumulatif_awal'         => $dtl_b_solar_akumulatif_awal[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_bx($dtl_b_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_b($dtl_b_detail_id[$i], $data6);
                                        $this->model->update_dtl_bx($dtl_b_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'                      => $headerid,
                                        'stdtl'                         => $stdtl,
                                        'trafo'                         => $dtl_b_trafo[$i],
                                        'kwh_nilai'                     => $dtl_b_kwh_nilai[$i],
                                        'kwh_akumulatif'                => $dtl_b_kwh_akumulatif[$i],
                                        'bahanbakar_nilai'              => $dtl_b_bahanbakar_nilai[$i],
                                        'bahanbakar_akumulatif'         => $dtl_b_bahanbakar_akumulatif[$i],
                                        'kwh_efisiensi_nilai'           => $dtl_b_kwh_efisiensi_nilai[$i],
                                        'kwh_efisiensi_akumulatif'      => $dtl_b_kwh_efisiensi_akumulatif[$i],
                                        'operasi_nilai'                 => $dtl_b_operasi_nilai[$i],
                                        'operasi_akumulatif'            => $dtl_b_operasi_akumulatif[$i],
                                        'solar_nilai'                   => $dtl_b_solar_nilai[$i],
                                        'solar_akumulatif'              => $dtl_b_solar_akumulatif[$i],
                                        'nama_trafo'                    => $dtl_b_nama_trafo[$i],
                                        'read_ct_trafo'                 => $dtl_b_read_ct_trafo[$i],
                                        'rata_hari'                     => $dtl_b_rata_hari[$i],
                                        'jam'                           => $dtl_b_jam[$i],
                                        'kwh_6k5_nilai'                 => $dtl_b_kwh_6k5_nilai[$i],
                                        'trafo_awal'                    => $dtl_b_trafo_awal[$i],
                                        'trafo_akhir'                   => $dtl_b_trafo_akhir[$i],
                                        'trafo_putaran'                 => $dtl_b_trafo_putaran[$i],
                                        'kwh_akumulatif_awal'           => $dtl_b_kwh_akumulatif_awal[$i],
                                        'bahanbakar_akumulatif_awal'    => $dtl_b_bahanbakar_akumulatif_awal[$i],
                                        'kwh_efisiensi_akumulatif_awal' => $dtl_b_kwh_efisiensi_akumulatif_awal[$i],
                                        'operasi_akumulatif_awal'       => $dtl_b_operasi_akumulatif_awal[$i],
                                        'solar_akumulatif_awal'         => $dtl_b_solar_akumulatif_awal[$i],
                                    );

                                    $this->model->insert_detail_b($data6);
                                }
                            }

                            //edit detail c
                            $jml = count($this->input->post('dtl_c_dept_panel'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_c_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'            => $stdtl,
                                        'kode_kwh'         => $dtl_c_kode[$i],
                                        'dtl_c_item_id'    => $dtl_c_item_id[$i],
                                        'reading_ct'       => $dtl_c_reading_ct[$i],
                                        'dept_panel'       => $dtl_c_dept_panel[$i],
                                        'dept_user'        => $dtl_c_dept_user[$i],
                                        'status_beban'     => $dtl_c_status_beban[$i],
                                        'kwh_awal'         => $dtl_c_kwh_awal[$i],
                                        'kwh_akhir'        => $dtl_c_kwh_akhir[$i],
                                        'putaran_hasil'    => $dtl_c_putaran_hasil[$i],
                                        'kwh_nilai'        => $dtl_c_kwh_nilai[$i],
                                        'kwh_real_nilai'   => $dtl_c_kwh_real_nilai[$i],
                                        'rata_hari'        => $dtl_c_rata_hari[$i],
                                        'jam_operasi'      => $dtl_c_jam_operasi[$i],
                                        'kwh_6k6_hasil'    => $dtl_c_kwh_6k6_hasil[$i],
                                        'beban_persen'     => $dtl_c_beban_persen[$i],
                                        'beban_persen_fix' => $dtl_c_beban_persen_fix[$i],
                                        'beban'            => $dtl_c_beban[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_cx($dtl_c_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_c($dtl_c_detail_id[$i], $data6);
                                        $this->model->update_dtl_cx($dtl_c_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'         => $headerid,
                                        'stdtl'            => $stdtl,
                                        'kode_kwh'         => $dtl_c_kode[$i],
                                        'dtl_c_item_id'    => $dtl_c_item_id[$i],
                                        'reading_ct'       => $dtl_c_reading_ct[$i],
                                        'dept_panel'       => $dtl_c_dept_panel[$i],
                                        'dept_user'        => $dtl_c_dept_user[$i],
                                        'status_beban'     => $dtl_c_status_beban[$i],
                                        'kwh_awal'         => $dtl_c_kwh_awal[$i],
                                        'kwh_akhir'        => $dtl_c_kwh_akhir[$i],
                                        'putaran_hasil'    => $dtl_c_putaran_hasil[$i],
                                        'kwh_nilai'        => $dtl_c_kwh_nilai[$i],
                                        'kwh_real_nilai'   => $dtl_c_kwh_real_nilai[$i],
                                        'rata_hari'        => $dtl_c_rata_hari[$i],
                                        'jam_operasi'      => $dtl_c_jam_operasi[$i],
                                        'kwh_6k6_hasil'    => $dtl_c_kwh_6k6_hasil[$i],
                                        'beban_persen'     => $dtl_c_beban_persen[$i],
                                        'beban_persen_fix' => $dtl_c_beban_persen_fix[$i],
                                        'beban'            => $dtl_c_beban[$i],
                                    );

                                    $this->model->insert_detail_c($data6);
                                }
                            }

                            //edit detail d
                            $jml = count($this->input->post('dtl_d_pemakai_panel'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_d_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'                                  => $stdtl,
                                        'id_pemakai_panel'                       => $dtl_d_id_pemakai_panel[$i],
                                        'pemakai_panel'                          => $dtl_d_pemakai_panel[$i],
                                        'pemakai_kwh'                            => $dtl_d_pemakai_kwh[$i],
                                        'pemakai_kwh_loss'                       => $dtl_d_pemakai_kwh_loss[$i],
                                        'pemakai_kwh_total'                      => $dtl_d_pemakai_kwh_total[$i],
                                        'pemakai_persen'                         => $dtl_d_pemakai_persen[$i],
                                        'pemakai_akumulatif'                     => $dtl_d_pemakai_akumulatif[$i],
                                        'bahan_bakar_kwh'                        => $dtl_d_bahan_bakar_kwh[$i],
                                        'bahan_bakar_persen'                     => $dtl_d_bahan_bakar_persen[$i],
                                        'bahan_bakar_akumulatif'                 => $dtl_d_bahan_bakar_akumulatif[$i],
                                        'dtl_d_pakai_akumulatif_sementara'       => $dtl_d_pakai_akumulatif_sementara[$i],
                                        'dtl_d_bahan_bakar_akumulatif_sementara' => $dtl_d_bahan_bakar_akumulatif_sementara[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_dx($dtl_d_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_d($dtl_d_detail_id[$i], $data6);
                                        $this->model->update_dtl_dx($dtl_d_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'                               => $headerid,
                                        'stdtl'                                  => $stdtl,
                                        'id_pemakai_panel'                       => $dtl_d_id_pemakai_panel[$i],
                                        'pemakai_panel'                          => $dtl_d_pemakai_panel[$i],
                                        'pemakai_kwh'                            => $dtl_d_pemakai_kwh[$i],
                                        'pemakai_kwh_loss'                       => $dtl_d_pemakai_kwh_loss[$i],
                                        'pemakai_kwh_total'                      => $dtl_d_pemakai_kwh_total[$i],
                                        'pemakai_persen'                         => $dtl_d_pemakai_persen[$i],
                                        'pemakai_akumulatif'                     => $dtl_d_pemakai_akumulatif[$i],
                                        'bahan_bakar_kwh'                        => $dtl_d_bahan_bakar_kwh[$i],
                                        'bahan_bakar_persen'                     => $dtl_d_bahan_bakar_persen[$i],
                                        'bahan_bakar_akumulatif'                 => $dtl_d_bahan_bakar_akumulatif[$i],
                                        'dtl_d_pakai_akumulatif_sementara'       => $dtl_d_pakai_akumulatif_sementara[$i],
                                        'dtl_d_bahan_bakar_akumulatif_sementara' => $dtl_d_bahan_bakar_akumulatif_sementara[$i],
                                    );

                                    $this->model->insert_detail_d($data6);
                                }
                            }
                            //edit detail d
                            $jml = count($this->input->post('dtl_e_generator'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_e_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'               => $stdtl,
                                        'generator'           => $dtl_e_generator[$i],
                                        'item_id'             => $dtl_e_item_id[$i],
                                        'shift'               => $dtl_e_shift[$i],
                                        'read_ct'             => $dtl_e_read_ct[$i],
                                        'putaran'             => $dtl_e_putaran[$i],
                                        'kwh_nilai'           => $dtl_e_kwh_nilai[$i],
                                        'kwh_akumulatif'      => $dtl_e_kwh_akumulatif[$i],
                                        'kwh_akumulatif_awal' => $dtl_e_kwh_akumulatif_awal[$i],
                                    );

                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_ex($dtl_e_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl_e($dtl_e_detail_id[$i], $data6);
                                        $this->model->update_dtl_ex($dtl_e_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'            => $headerid,
                                        'stdtl'               => $stdtl,
                                        'generator'           => $dtl_e_generator[$i],
                                        'item_id'             => $dtl_e_item_id[$i],
                                        'shift'               => $dtl_e_shift[$i],
                                        'read_ct'             => $dtl_e_read_ct[$i],
                                        'putaran'             => $dtl_e_putaran[$i],
                                        'kwh_nilai'           => $dtl_e_kwh_nilai[$i],
                                        'kwh_akumulatif'      => $dtl_e_kwh_akumulatif[$i],
                                        'kwh_akumulatif_awal' => $dtl_e_kwh_akumulatif_awal[$i],
                                    );

                                    $this->model->insert_detail_e($data6);
                                }
                            }


                            $this->model->insert_detailx($headerid);
                            $this->model->insert_detail_bx($headerid);
                            $this->model->insert_detail_cx($headerid);
                            $this->model->insert_detail_dx($headerid);
                            $this->model->insert_detail_ex($headerid);
                        }
                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
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
