<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formfrmfss319_08 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

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

            $last_docno   = isset($dthasil->vdocno) ? $dthasil->vdocno + 0 : 1;

            $date_day     = date("d", strtotime($create_date));
            $arr_bulan    = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            // $docno        = 'LHB/BLR/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' . str_pad($last_docno, 3, '0', STR_PAD_LEFT);
            $docno        = 'LHB/BLR/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' .  str_pad($date_day, 3, '0', STR_PAD_LEFT);

            $hasil = array(
                'status'  => 1,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil!",
                'data'    => $docno,
            );

            echo json_encode($hasil);
        } else {
            redirect('C_login', 'refresh');
        }
    }

    function get_list_item()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $create_date  = $this->input->post('create_date');
            $dthasil      = $this->model->get_list_item('Tipe 1', date("Y-m-d", strtotime($this->input->post('create_date'))));

            if (count($dthasil) > 0) {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'berhasil',
                    'pesan'   => "Berhasil Memuat data. Silahkan Disimpan Terlebih Dahulu",
                    'data'    => $dthasil,
                );
            } else {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'gagal',
                    'pesan'   => "Data detail tidak ditemukan!!!",
                );
            }

            echo json_encode($hasil);
        } else {
            redirect('C_login', 'refresh');
        }
    }

    function get_list_item2()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $create_date  = $this->input->post('create_date');
            $dthasil    = $this->model->get_list_item2('Tipe 2', date("Y-m-d", strtotime($this->input->post('create_date'))));

            if (count($dthasil) > 0) {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'berhasil',
                    'pesan'   => "Berhasil Memuat data. Silahkan Disimpan Terlebih Dahulu",
                    'data'    => $dthasil,
                );
            } else {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'gagal',
                    'pesan'   => "Data detail tidak ditemukan!!!",
                );
            }

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_stock_temp()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $create_date    = $this->input->post('create_date');
            $dthasil        = $this->model->get_stock_temp(date("Y-m-d", strtotime($this->input->post('create_date'))));

            if (count($dthasil) > 0) {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'berhasil',
                    'pesan'   => "Berhasil Memuat data. Silahkan Disimpan Terlebih Dahulu",
                    'data'    => $dthasil,
                );
            } else {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'gagal',
                    'pesan'   => "Stock Tempurung Tidak ditemukan!!!",
                );
            }

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_list_item3()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $create_date  = $this->input->post('create_date');
            $dthasil    = $this->model->get_list_item3('Tipe 3', date("Y-m-d", strtotime($this->input->post('create_date'))));

            if (count($dthasil) > 0) {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'berhasil',
                    'pesan'   => "Berhasil Memuat data. Silahkan Disimpan Terlebih Dahulu",
                    'data'    => $dthasil,
                );
            } else {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'gagal',
                    'pesan'   => "Data detail tidak ditemukan!!!",
                );
            }

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_list_item4()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $create_date  = $this->input->post('create_date');
            $dthasil    = $this->model->get_list_item4('Tipe 4', date("Y-m-d", strtotime($this->input->post('create_date'))));

            if (count($dthasil) > 0) {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'berhasil',
                    'pesan'   => "Berhasil Memuat data. Silahkan Disimpan Terlebih Dahulu",
                    'data'    => $dthasil,
                );
            } else {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'gagal',
                    'pesan'   => "Data detail tidak ditemukan!!!",
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
            $session_data           = $this->session->userdata('logged_in');
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

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);

            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);

            //ambil variabel URL
            $frmkode                = $this->uri->segment(4);
            $frmvrs                 = $this->uri->segment(5);

            $dtfrm                  = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                  = array('dtfrm' => $dtfrm);

            foreach ($dtfrm as $dt_form) {
                $frmnm              = $dt_form->formnm;
            }


            $frmaksi                = $this->uri->segment(6);

            // data hedder
            $headerid                  = addslashes($this->input->post('headerid'));
            $complete_userid           = $session_data['userid'];
            $complete_personalid       = $session_data['personalid'];
            $complete_position         = $session_data['jabnm'];
            $complete_personalstatus   = $session_data['personalstatus'];
            $complete_date             = date('Y-m-d');
            $complete_time             = date('H:i:s');
            $complete_by               = $session_data['nmlengkap'];
            $complete_comp             = $this->session->userdata('hostname');                                     // versi user original
            $create_date               = date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));  // dari inputan d-m-Y
            $docno                     = addslashes($this->input->post('docno'));
            $total_dtlc_total_jam      = addslashes($this->input->post('total_dtlc_total_jam'));
            $total_dtlc_jam_akm        = addslashes($this->input->post('total_dtlc_jam_akm'));
            $total_dtlc_tmpr_kg        = addslashes($this->input->post('total_dtlc_tmpr_kg'));
            $total_dtlc_tmpr_akm       = addslashes($this->input->post('total_dtlc_tmpr_akm'));
            $total_dtlc_steam_ton      = addslashes($this->input->post('total_dtlc_steam_ton'));
            $total_dtlc_steam_akm      = addslashes($this->input->post('total_dtlc_steam_akm'));
            $total_dtlc_total_air      = addslashes($this->input->post('total_dtlc_total_air'));
            $total_dtlc_air_akm        = addslashes($this->input->post('total_dtlc_air_akm'));
            $total_dtld_tmpr_kg        = addslashes($this->input->post('total_dtld_tmpr_kg'));
            $total_dtld_tmpr_akm       = addslashes($this->input->post('total_dtld_tmpr_akm'));
            $total_dtld_steam_ton      = addslashes($this->input->post('total_dtld_steam_ton'));
            $total_dtld_steam_akm      = addslashes($this->input->post('total_dtld_steam_akm'));
            $total_dtld_total_air      = addslashes($this->input->post('total_dtld_total_air'));
            $total_dtld_air_akm        = addslashes($this->input->post('total_dtld_air_akm'));
            $air_dearator              = addslashes($this->input->post('air_dearator'));
            $air_wtd                   = addslashes($this->input->post('air_wtd'));
            $air_condensate            = addslashes($this->input->post('air_condensate'));
            $air_blr                   = addslashes($this->input->post('air_blr'));
            $total_return              = addslashes($this->input->post('total_return'));
            $prsn_air_wtd              = addslashes($this->input->post('prsn_air_wtd'));
            $prsn_air_condensate       = addslashes($this->input->post('prsn_air_condensate'));
            $prsn_air_blr              = addslashes($this->input->post('prsn_air_blr'));
            $realisasi                 = addslashes($this->input->post('realisasi'));
            $temp_bulan_lalu           = addslashes($this->input->post('temp_bulan_lalu'));
            $stock_awal_temp           = addslashes($this->input->post('stock_awal_temp'));
            $selisih_opname            = addslashes($this->input->post('selisih_opname'));
            $total_dtlb_penerimaan_kg  = addslashes($this->input->post('total_dtlb_penerimaan_kg'));
            $total_dtlb_penerimaan_akm = addslashes($this->input->post('total_dtlb_penerimaan_akm'));
            $total_dtlb_pemakaian_kg   = addslashes($this->input->post('total_dtlb_pemakaian_kg'));
            $total_dtlb_pemakaian_akm  = addslashes($this->input->post('total_dtlb_pemakaian_akm'));
            $stock_akhir_tmp           = addslashes($this->input->post('stock_akhir_tmp'));

            /* DTLA */
            $detail_id                  = $this->input->post('detail_id');
            $item_id                    = $this->input->post('item_id');
            $boiler                     = $this->input->post('boiler');
            $tekanan_07                 = $this->input->post('tekanan_07');
            $tekanan_08                 = $this->input->post('tekanan_08');
            $tekanan_09                 = $this->input->post('tekanan_09');
            $tekanan_10                 = $this->input->post('tekanan_10');
            $tekanan_11                 = $this->input->post('tekanan_11');
            $tekanan_12                 = $this->input->post('tekanan_12');
            $tekanan_13                 = $this->input->post('tekanan_13');
            $tekanan_14                 = $this->input->post('tekanan_14');
            $tekanan_15                 = $this->input->post('tekanan_15');
            $tekanan_16                 = $this->input->post('tekanan_16');
            $tekanan_17                 = $this->input->post('tekanan_17');
            $tekanan_18                 = $this->input->post('tekanan_18');
            $tekanan_19                 = $this->input->post('tekanan_19');
            $tekanan_20                 = $this->input->post('tekanan_20');
            $tekanan_21                 = $this->input->post('tekanan_21');
            $tekanan_22                 = $this->input->post('tekanan_22');
            $tekanan_23                 = $this->input->post('tekanan_23');
            $tekanan_24                 = $this->input->post('tekanan_24');
            $tekanan_01                 = $this->input->post('tekanan_01');
            $tekanan_02                 = $this->input->post('tekanan_02');
            $tekanan_03                 = $this->input->post('tekanan_03');
            $tekanan_04                 = $this->input->post('tekanan_04');
            $tekanan_05                 = $this->input->post('tekanan_05');
            $tekanan_06                 = $this->input->post('tekanan_06');
            $keterangan                 = $this->input->post('keterangan');

            /* DTLB */
            $detail_id_b                = $this->input->post('detail_id_b');
            $dtlb_item_id               = $this->input->post('dtlb_item_id');
            $dtlb_uraian                = $this->input->post('dtlb_uraian');
            $dtlb_penerimaan_kg         = $this->input->post('dtlb_penerimaan_kg');
            $dtlb_penerimaan_akm        = $this->input->post('dtlb_penerimaan_akm');
            $dtlb_penerimaan_akm_awal   = $this->input->post('dtlb_penerimaan_akm_awal');
            $dtlb_pemakaian_kg          = $this->input->post('dtlb_pemakaian_kg');
            $dtlb_pemakaian_akm         = $this->input->post('dtlb_pemakaian_akm');
            $dtlb_pemakaian_akm_awal    = $this->input->post('dtlb_pemakaian_akm_awal');

            /* DTLB2 */
            $detail_id_b2               = $this->input->post('detail_id_b2');
            $dtlb2_item_id              = $this->input->post('dtlb2_item_id');
            $dtlb2_uraian               = $this->input->post('dtlb2_uraian');
            $dtlb2_terima               = $this->input->post('dtlb2_terima');
            $dtlb2_pakai                = $this->input->post('dtlb2_pakai');
            $dtlb2_akm                  = $this->input->post('dtlb2_akm');
            $dtlb2_akm_awal             = $this->input->post('dtlb2_akm_awal');
            $dtlb2_eff                  = $this->input->post('dtlb2_eff');
            $dtlb2_stock                = $this->input->post('dtlb2_stock');
            $dtlb2_nodo                 = $this->input->post('dtlb2_nodo');

            /* DTLC */
            $detail_id_c                = $this->input->post('detail_id_c');
            $dtlc_item_id               = $this->input->post('dtlc_item_id');
            $dtlc_kode_boiler           = $this->input->post('dtlc_kode_boiler');
            $dtlc_total_jam             = $this->input->post('dtlc_total_jam');
            $dtlc_jam_akm               = $this->input->post('dtlc_jam_akm');
            $dtlc_jam_akm_awal          = $this->input->post('dtlc_jam_akm_awal');
            $dtlc_tmpr_akm_awal         = $this->input->post('dtlc_tmpr_akm_awal');
            $dtlc_steam_akm_awal        = $this->input->post('dtlc_steam_akm_awal');
            $dtlc_air_akm_awal          = $this->input->post('dtlc_air_akm_awal');
            $dtlc_tmpr_kg               = $this->input->post('dtlc_tmpr_kg');
            $dtlc_tmpr_akm              = $this->input->post('dtlc_tmpr_akm');
            $dtlc_steam_ton             = $this->input->post('dtlc_steam_ton');
            $dtlc_steam_akm             = $this->input->post('dtlc_steam_akm');
            $dtlc_total_air             = $this->input->post('dtlc_total_air');
            $dtlc_air_akm               = $this->input->post('dtlc_air_akm');

            /* DTLD */
            $detail_id_d                = $this->input->post('detail_id_d');
            $dtld_item_id               = $this->input->post('dtld_item_id');
            $dtld_uraian                = $this->input->post('dtld_uraian');
            $dtld_total_jam             = $this->input->post('dtld_total_jam');
            $dtld_tmpr_kg               = $this->input->post('dtld_tmpr_kg');
            $dtld_tmpr_akm              = $this->input->post('dtld_tmpr_akm');
            $dtld_steam_ton             = $this->input->post('dtld_steam_ton');
            $dtld_steam_akm             = $this->input->post('dtld_steam_akm');
            $dtld_total_air             = $this->input->post('dtld_total_air');
            $dtld_air_akm               = $this->input->post('dtld_air_akm');
            $dtld_tmpr_akm_awal         = $this->input->post('dtld_tmpr_akm_awal');
            $dtld_steam_akm_awal        = $this->input->post('dtld_steam_akm_awal');
            $dtld_air_akm_awal          = $this->input->post('dtld_air_akm_awal');

            $data['jmldtl']             = count($this->input->post('boiler'));
            $data['jmldtlb']            = count($this->input->post('dtlb_uraian'));
            $data['jmldtlb2']           = count($this->input->post('dtlb2_uraian'));
            $data['jmldtlc']            = count($this->input->post('dtlc_kode_boiler'));
            $data['jmldtld']            = count($this->input->post('dtld_uraian'));

            if ($frmaksi == 'dtsave') {
                $cekheader                        = $this->model->check($create_date, $docno);
                if ($cekheader->num_rows() > 0) {
                    $data['message']              = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ' dan No Dokumen : ' . $docno . ' sudah pernah disimpan';

                    $data['dtcreate_date']        = addslashes($this->input->post('create_date'));
                    $data['dtdocno']              = addslashes($this->input->post('docno'));
                    $data['dttotal_jam']          = addslashes($this->input->post('total_jam'));
                    $data['dttotal_jam_akm']      = addslashes($this->input->post('total_jam_akm'));
                    $data['dttotal_tmp']          = addslashes($this->input->post('total_tmp'));
                    $data['dttotal_tmp_akm']      = addslashes($this->input->post('total_tmp_akm'));
                    $data['dttotal_steam']        = addslashes($this->input->post('total_steam'));
                    $data['dttotal_steam_akm']    = addslashes($this->input->post('total_steam_akm'));
                    $data['dttotal_air']          = addslashes($this->input->post('total_air'));
                    $data['dttotal_air_akm']      = addslashes($this->input->post('total_air_akm'));

                    $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
                } else {
                    $status_detail  = '0';
                    $status_detailx = '0';
                    $data5 = array(
                        'complete_userid'           => $complete_userid,
                        'complete_personalstatus'   => $complete_personalstatus,
                        'complete_personalid'       => $complete_personalid,
                        'complete_position'         => $complete_position,
                        'complete_by'               => $complete_by,
                        'complete_date'             => $complete_date,
                        'complete_time'             => $complete_time,
                        'complete_comp'             => $complete_comp,               // versi user original
                        'complete_useridx'          => $complete_userid,
                        'complete_personalidx'      => $complete_personalid,
                        'complete_positionx'        => $complete_position,
                        'complete_personalstatusx'  => $complete_personalstatus,
                        'complete_byx'              => $complete_by,
                        'complete_datex'            => $complete_date,
                        'complete_timex'            => $complete_time,
                        'complete_compx'            => $complete_comp,               // versi user audit
                        'status_detail'             => $status_detail,
                        'status_detailx'            => $status_detailx,
                        'create_date'               => $create_date,
                        'docno'                     => $docno,
                        'total_dtlc_total_jam'      => $total_dtlc_total_jam,
                        'total_dtlc_jam_akm'        => $total_dtlc_jam_akm,
                        'total_dtlc_tmpr_kg'        => $total_dtlc_tmpr_kg,
                        'total_dtlc_tmpr_akm'       => $total_dtlc_tmpr_akm,
                        'total_dtlc_steam_ton'      => $total_dtlc_steam_ton,
                        'total_dtlc_steam_akm'      => $total_dtlc_steam_akm,
                        'total_dtlc_total_air'      => $total_dtlc_total_air,
                        'total_dtlc_air_akm'        => $total_dtlc_air_akm,
                        'total_dtld_tmpr_kg'        => $total_dtld_tmpr_kg,
                        'total_dtld_tmpr_akm'       => $total_dtld_tmpr_akm,
                        'total_dtld_steam_ton'      => $total_dtld_steam_ton,
                        'total_dtld_steam_akm'      => $total_dtld_steam_akm,
                        'total_dtld_total_air'      => $total_dtld_total_air,
                        'total_dtld_air_akm'        => $total_dtld_air_akm,
                        'air_dearator'              => $air_dearator,
                        'air_wtd'                   => $air_wtd,
                        'air_condensate'            => $air_condensate,
                        'air_blr'                   => $air_blr,
                        'total_return'              => $total_return,
                        'prsn_air_wtd'              => $prsn_air_wtd,
                        'prsn_air_condensate'       => $prsn_air_condensate,
                        'prsn_air_blr'              => $prsn_air_blr,
                        'realisasi'                 => $realisasi,
                        'temp_bulan_lalu'           => $temp_bulan_lalu,
                        'stock_awal_temp'           => $stock_awal_temp,
                        'selisih_opname'            => $selisih_opname,
                        'total_dtlb_penerimaan_kg'  => $total_dtlb_penerimaan_kg,
                        'total_dtlb_penerimaan_akm' => $total_dtlb_penerimaan_akm,
                        'total_dtlb_pemakaian_kg'   => $total_dtlb_pemakaian_kg,
                        'total_dtlb_pemakaian_akm'  => $total_dtlb_pemakaian_akm,
                        'stock_akhir_tmp'           => $stock_akhir_tmp,
                    );
                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    $jml   = count($this->input->post('boiler'));
                    for ($i = 0; $i < $jml; $i++) {
                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }
                        $data6 = array(
                            'item_id'    => $item_id[$i],
                            'boiler'     => $boiler[$i],
                            'tekanan_07' => $tekanan_07[$i],
                            'tekanan_08' => $tekanan_08[$i],
                            'tekanan_09' => $tekanan_09[$i],
                            'tekanan_10' => $tekanan_10[$i],
                            'tekanan_11' => $tekanan_11[$i],
                            'tekanan_12' => $tekanan_12[$i],
                            'tekanan_13' => $tekanan_13[$i],
                            'tekanan_14' => $tekanan_14[$i],
                            'tekanan_15' => $tekanan_15[$i],
                            'tekanan_16' => $tekanan_16[$i],
                            'tekanan_17' => $tekanan_17[$i],
                            'tekanan_18' => $tekanan_18[$i],
                            'tekanan_19' => $tekanan_19[$i],
                            'tekanan_20' => $tekanan_20[$i],
                            'tekanan_21' => $tekanan_21[$i],
                            'tekanan_22' => $tekanan_22[$i],
                            'tekanan_23' => $tekanan_23[$i],
                            'tekanan_24' => $tekanan_24[$i],
                            'tekanan_01' => $tekanan_01[$i],
                            'tekanan_02' => $tekanan_02[$i],
                            'tekanan_03' => $tekanan_03[$i],
                            'tekanan_04' => $tekanan_04[$i],
                            'tekanan_05' => $tekanan_05[$i],
                            'tekanan_06' => $tekanan_06[$i],
                            'keterangan' => $keterangan[$i],
                            'headerid'   => $max_hdr_id,
                            'stdtl'      => $stdtl
                        );
                        $this->model->insert_detail($data6);
                    }

                    $jmlb   = count($this->input->post('dtlb_uraian'));
                    for ($ib = 0; $ib < $jmlb; $ib++) {
                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }
                        $data6b = array(
                            'dtlb_item_id'             => $dtlb_item_id[$ib],
                            'dtlb_uraian'              => $dtlb_uraian[$ib],
                            'dtlb_penerimaan_kg'       => $dtlb_penerimaan_kg[$ib],
                            'dtlb_penerimaan_akm'      => $dtlb_penerimaan_akm[$ib],
                            'dtlb_penerimaan_akm_awal' => $dtlb_penerimaan_akm_awal[$ib],
                            'dtlb_pemakaian_kg'        => $dtlb_pemakaian_kg[$ib],
                            'dtlb_pemakaian_akm'       => $dtlb_pemakaian_akm[$ib],
                            'dtlb_pemakaian_akm_awal'  => $dtlb_pemakaian_akm_awal[$ib],
                            'headerid'                 => $max_hdr_id,
                            'stdtl'                    => $stdtl
                        );
                        $this->model->insert_detail_b($data6b);
                        // print_r($data6b);exit();
                    }

                    $jmlb2   = count($this->input->post('dtlb2_uraian'));
                    for ($ib2 = 0; $ib2 < $jmlb2; $ib2++) {
                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }
                        $data6b2 = array(
                            'dtlb2_item_id'  => $dtlb2_item_id[$ib2],
                            'dtlb2_uraian'   => $dtlb2_uraian[$ib2],
                            'dtlb2_terima'   => $dtlb2_terima[$ib2],
                            'dtlb2_pakai'    => $dtlb2_pakai[$ib2],
                            'dtlb2_akm'      => $dtlb2_akm[$ib2],
                            'dtlb2_akm_awal' => $dtlb2_akm_awal[$ib2],
                            'dtlb2_eff'      => $dtlb2_eff[$ib2],
                            'dtlb2_stock'    => $dtlb2_stock[$ib2],
                            'dtlb2_nodo'     => $dtlb2_nodo[$ib2],
                            'headerid'       => $max_hdr_id,
                            'stdtl'          => $stdtl
                        );
                        $this->model->insert_detail_b2($data6b2);
                    }

                    $jmlc   = count($this->input->post('dtlc_kode_boiler'));
                    for ($ic = 0; $ic < $jmlc; $ic++) {
                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }
                        $data6c = array(
                            'dtlc_item_id'        => $dtlc_item_id[$ic],
                            'dtlc_kode_boiler'    => $dtlc_kode_boiler[$ic],
                            'dtlc_total_jam'      => $dtlc_total_jam[$ic],
                            'dtlc_jam_akm'        => $dtlc_jam_akm[$ic],
                            'dtlc_jam_akm_awal'   => $dtlc_jam_akm_awal[$ic],
                            'dtlc_tmpr_akm_awal'  => $dtlc_tmpr_akm_awal[$ic],
                            'dtlc_steam_akm_awal' => $dtlc_steam_akm_awal[$ic],
                            'dtlc_air_akm_awal'   => $dtlc_air_akm_awal[$ic],
                            'dtlc_tmpr_kg'        => $dtlc_tmpr_kg[$ic],
                            'dtlc_tmpr_akm'       => $dtlc_tmpr_akm[$ic],
                            'dtlc_steam_ton'      => $dtlc_steam_ton[$ic],
                            'dtlc_steam_akm'      => $dtlc_steam_akm[$ic],
                            'dtlc_total_air'      => $dtlc_total_air[$ic],
                            'dtlc_air_akm'        => $dtlc_air_akm[$ic],
                            'headerid'            => $max_hdr_id,
                            'stdtl'               => $stdtl
                        );
                        $this->model->insert_detail_c($data6c);
                    }

                    $jmld   = count($this->input->post('dtld_uraian'));
                    for ($id = 0; $id < $jmld; $id++) {
                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }
                        $data6d = array(
                            'dtld_item_id'        => $dtld_item_id[$id],
                            'dtld_uraian'         => $dtld_uraian[$id],
                            'dtld_total_jam'      => $dtld_total_jam[$id],
                            'dtld_tmpr_kg'        => $dtld_tmpr_kg[$id],
                            'dtld_tmpr_akm'       => $dtld_tmpr_akm[$id],
                            'dtld_steam_ton'      => $dtld_steam_ton[$id],
                            'dtld_steam_akm'      => $dtld_steam_akm[$id],
                            'dtld_total_air'      => $dtld_total_air[$id],
                            'dtld_air_akm'        => $dtld_air_akm[$id],
                            'dtld_tmpr_akm_awal'  => $dtld_tmpr_akm_awal[$id],
                            'dtld_steam_akm_awal' => $dtld_steam_akm_awal[$id],
                            'dtld_air_akm_awal'   => $dtld_air_akm_awal[$id],
                            'headerid'            => $max_hdr_id,
                            'stdtl'               => $stdtl
                        );
                        $this->model->insert_detail_d($data6d);
                    }

                    $id = $max_hdr_id;
                    $this->model->insert_detailx($max_hdr_id);
                    $this->model->insert_detail_cx($max_hdr_id);
                    $this->model->insert_detail_dx($max_hdr_id);

                    echo "<script>alert('Data berhasil disimpan!!');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $max_hdr_id, 'refresh');
                }
            } elseif ($frmaksi == 'dtopen') {
                $id         = $this->uri->segment(7);
                $dtheader   = $this->model->get_header_byid($id); // manggil data header
                $data7      = array('dtheader' => $dtheader);

                foreach ($dtheader as $hdrrow) {
                    $dtcreate_date = $hdrrow->create_date;
                    $sts_detail    = $hdrrow->status_detail;
                    $sts_detailx   = $hdrrow->status_detailx;
                }

                if ($cekLevelUserNm == "Auditor") {
                    $data['komplit']    = $sts_detailx;
                    $dtdetail           = $this->model->get_detail_byidx($id);
                    $dtdetail_b         = $this->model->get_detail_byid_bx($id);
                    $dtdetail_b2        = $this->model->get_detail_byid_b2x($id);
                    $dtdetail_c         = $this->model->get_detail_byid_cx($id);
                    $dtdetail_d         = $this->model->get_detail_byid_dx($id);
                } else {
                    $data['komplit']    = $sts_detail;
                    $dtdetail           = $this->model->get_detail_byid($id);
                    $dtdetail_b         = $this->model->get_detail_byid_b($id);
                    $dtdetail_b2        = $this->model->get_detail_byid_b2($id);
                    $dtdetail_c         = $this->model->get_detail_byid_c($id);
                    $dtdetail_d         = $this->model->get_detail_byid_d($id);
                }

                $data8  = array('dtdetail' => $dtdetail);
                $data10 = array('dtdetail_c' => $dtdetail_c);
                $data11 = array('dtdetail_d' => $dtdetail_d);
                $data12 = array('dtdetail_b2' => $dtdetail_b2);
                $data13 = array('dtdetail_b' => $dtdetail_b);

                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8, $data10, $data11, $data12, $data13));
            } else {
                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $headerid);

                    if ($cekheader->num_rows() > 0) {
                        echo "<script>alert('Gagal, Data pada tanggal Laporan : '.$create_date.' dan No Dokumen : '.$docno.'  sudah pernah disimpan');</script>";
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
                            switch ($_POST['btnproses']) {
                                case $_POST['btnproses'] == 'btnupdate':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data5 = array(
                                            'complete_useridx'          => $complete_userid,
                                            'complete_personalstatus'   => $complete_personalstatus,
                                            'complete_personalid'       => $complete_personalid,
                                            'complete_position'         => $complete_position,
                                            'complete_byx'              => $complete_by,
                                            'complete_datex'            => $complete_date,
                                            'complete_timex'            => $complete_time,
                                            'complete_compx'            => $complete_comp,
                                            'create_date'               => $create_date,
                                            'docno'                     => $docno,
                                            'total_dtlc_total_jam'      => $total_dtlc_total_jam,
                                            'total_dtlc_jam_akm'        => $total_dtlc_jam_akm,
                                            'total_dtlc_tmpr_kg'        => $total_dtlc_tmpr_kg,
                                            'total_dtlc_tmpr_akm'       => $total_dtlc_tmpr_akm,
                                            'total_dtlc_steam_ton'      => $total_dtlc_steam_ton,
                                            'total_dtlc_steam_akm'      => $total_dtlc_steam_akm,
                                            'total_dtlc_total_air'      => $total_dtlc_total_air,
                                            'total_dtlc_air_akm'        => $total_dtlc_air_akm,
                                            'total_dtld_tmpr_kg'        => $total_dtld_tmpr_kg,
                                            'total_dtld_tmpr_akm'       => $total_dtld_tmpr_akm,
                                            'total_dtld_steam_ton'      => $total_dtld_steam_ton,
                                            'total_dtld_steam_akm'      => $total_dtld_steam_akm,
                                            'total_dtld_total_air'      => $total_dtld_total_air,
                                            'total_dtld_air_akm'        => $total_dtld_air_akm,
                                            'air_dearator'              => $air_dearator,
                                            'air_wtd'                   => $air_wtd,
                                            'air_condensate'            => $air_condensate,
                                            'air_blr'                   => $air_blr,
                                            'total_return'              => $total_return,
                                            'prsn_air_wtd'              => $prsn_air_wtd,
                                            'prsn_air_condensate'       => $prsn_air_condensate,
                                            'prsn_air_blr'              => $prsn_air_blr,
                                            'realisasi'                 => $realisasi,
                                            'temp_bulan_lalu'           => $temp_bulan_lalu,
                                            'stock_awal_temp'           => $stock_awal_temp,
                                            'selisih_opname'            => $selisih_opname,
                                            'total_dtlb_penerimaan_kg'  => $total_dtlb_penerimaan_kg,
                                            'total_dtlb_penerimaan_akm' => $total_dtlb_penerimaan_akm,
                                            'total_dtlb_pemakaian_kg'   => $total_dtlb_pemakaian_kg,
                                            'total_dtlb_pemakaian_akm'  => $total_dtlb_pemakaian_akm,
                                            'stock_akhir_tmp'           => $stock_akhir_tmp

                                        );
                                    } else {
                                        $data5 = array(
                                            'complete_userid'           => $complete_userid,
                                            'complete_personalstatus'   => $complete_personalstatus,
                                            'complete_personalid'       => $complete_personalid,
                                            'complete_position'         => $complete_position,
                                            'complete_by'               => $complete_by,
                                            'complete_date'             => $complete_date,
                                            'complete_time'             => $complete_time,
                                            'complete_comp'             => $complete_comp, // versi user original

                                            'complete_useridx'          => $complete_userid,
                                            'complete_personalstatusx'  => $complete_personalstatus,
                                            'complete_personalidx'      => $complete_personalid,
                                            'complete_positionx'        => $complete_position,
                                            'complete_byx'              => $complete_by,
                                            'complete_datex'            => $complete_date,
                                            'complete_timex'            => $complete_time,
                                            'complete_compx'            => $complete_comp,               // versi user audit
                                            'create_date'               => $create_date,
                                            'docno'                     => $docno,
                                            'total_dtlc_total_jam'      => $total_dtlc_total_jam,
                                            'total_dtlc_jam_akm'        => $total_dtlc_jam_akm,
                                            'total_dtlc_tmpr_kg'        => $total_dtlc_tmpr_kg,
                                            'total_dtlc_tmpr_akm'       => $total_dtlc_tmpr_akm,
                                            'total_dtlc_steam_ton'      => $total_dtlc_steam_ton,
                                            'total_dtlc_steam_akm'      => $total_dtlc_steam_akm,
                                            'total_dtlc_total_air'      => $total_dtlc_total_air,
                                            'total_dtlc_air_akm'        => $total_dtlc_air_akm,
                                            'total_dtld_tmpr_kg'        => $total_dtld_tmpr_kg,
                                            'total_dtld_tmpr_akm'       => $total_dtld_tmpr_akm,
                                            'total_dtld_steam_ton'      => $total_dtld_steam_ton,
                                            'total_dtld_steam_akm'      => $total_dtld_steam_akm,
                                            'total_dtld_total_air'      => $total_dtld_total_air,
                                            'total_dtld_air_akm'        => $total_dtld_air_akm,
                                            'air_dearator'              => $air_dearator,
                                            'air_wtd'                   => $air_wtd,
                                            'air_condensate'            => $air_condensate,
                                            'air_blr'                   => $air_blr,
                                            'total_return'              => $total_return,
                                            'prsn_air_wtd'              => $prsn_air_wtd,
                                            'prsn_air_condensate'       => $prsn_air_condensate,
                                            'prsn_air_blr'              => $prsn_air_blr,
                                            'realisasi'                 => $realisasi,
                                            'temp_bulan_lalu'           => $temp_bulan_lalu,
                                            'stock_awal_temp'           => $stock_awal_temp,
                                            'selisih_opname'            => $selisih_opname,
                                            'total_dtlb_penerimaan_kg'  => $total_dtlb_penerimaan_kg,
                                            'total_dtlb_penerimaan_akm' => $total_dtlb_penerimaan_akm,
                                            'total_dtlb_pemakaian_kg'   => $total_dtlb_pemakaian_kg,
                                            'total_dtlb_pemakaian_akm'  => $total_dtlb_pemakaian_akm,
                                            'stock_akhir_tmp'           => $stock_akhir_tmp
                                        );
                                    }
                                    $alertmessage = "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                                    break;
                                case $_POST['btnproses'] == 'btncomplete':
                                    $data5 = array(
                                        'complete_userid'          => $complete_userid,
                                        'complete_personalstatus'  => $complete_personalstatus,
                                        'complete_personalid'      => $complete_personalid,
                                        'complete_position'        => $complete_position,
                                        'complete_by'              => $complete_by,
                                        'complete_date'            => $complete_date,
                                        'complete_time'            => $complete_time,
                                        'complete_comp'            => $complete_comp,             // versi user original

                                        'complete_useridx'         => $complete_userid,
                                        'complete_personalstatusx' => $complete_personalstatus,
                                        'complete_personalidx'     => $complete_personalid,
                                        'complete_positionx'       => $complete_position,
                                        'complete_byx'             => $complete_by,
                                        'complete_datex'           => $complete_date,
                                        'complete_timex'           => $complete_time,
                                        'complete_compx'           => $complete_comp,             // versi user audit

                                        'status_detail'             => '1',
                                        'status_detailx'            => '1',
                                        'create_date'               => $create_date,
                                        'docno'                     => $docno,
                                        'total_dtlc_total_jam'      => $total_dtlc_total_jam,
                                        'total_dtlc_jam_akm'        => $total_dtlc_jam_akm,
                                        'total_dtlc_tmpr_kg'        => $total_dtlc_tmpr_kg,
                                        'total_dtlc_tmpr_akm'       => $total_dtlc_tmpr_akm,
                                        'total_dtlc_steam_ton'      => $total_dtlc_steam_ton,
                                        'total_dtlc_steam_akm'      => $total_dtlc_steam_akm,
                                        'total_dtlc_total_air'      => $total_dtlc_total_air,
                                        'total_dtlc_air_akm'        => $total_dtlc_air_akm,
                                        'total_dtld_tmpr_kg'        => $total_dtld_tmpr_kg,
                                        'total_dtld_tmpr_akm'       => $total_dtld_tmpr_akm,
                                        'total_dtld_steam_ton'      => $total_dtld_steam_ton,
                                        'total_dtld_steam_akm'      => $total_dtld_steam_akm,
                                        'total_dtld_total_air'      => $total_dtld_total_air,
                                        'total_dtld_air_akm'        => $total_dtld_air_akm,
                                        'air_dearator'              => $air_dearator,
                                        'air_wtd'                   => $air_wtd,
                                        'air_condensate'            => $air_condensate,
                                        'air_blr'                   => $air_blr,
                                        'total_return'              => $total_return,
                                        'prsn_air_wtd'              => $prsn_air_wtd,
                                        'prsn_air_condensate'       => $prsn_air_condensate,
                                        'prsn_air_blr'              => $prsn_air_blr,
                                        'realisasi'                 => $realisasi,
                                        'temp_bulan_lalu'           => $temp_bulan_lalu,
                                        'stock_awal_temp'           => $stock_awal_temp,
                                        'selisih_opname'            => $selisih_opname,
                                        'total_dtlb_penerimaan_kg'  => $total_dtlb_penerimaan_kg,
                                        'total_dtlb_penerimaan_akm' => $total_dtlb_penerimaan_akm,
                                        'total_dtlb_pemakaian_kg'   => $total_dtlb_pemakaian_kg,
                                        'total_dtlb_pemakaian_akm'  => $total_dtlb_pemakaian_akm,
                                        'stock_akhir_tmp'           => $stock_akhir_tmp,
                                    );
                                    $alertmessage = "<script>alert('Data berhasil dikomplit....!!!! ');</script>";
                                    break;
                                default:
                                    break;
                            }

                            $this->model->update_hdr($headerid, $data5);

                            $jml = count($this->input->post('boiler'));
                            for ($i = 0; $i < $jml; $i++) {
                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }
                                if (isset($detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'      => $stdtl,
                                        'item_id'    => $item_id[$i],
                                        'boiler'     => $boiler[$i],
                                        'tekanan_07' => $tekanan_07[$i],
                                        'tekanan_08' => $tekanan_08[$i],
                                        'tekanan_09' => $tekanan_09[$i],
                                        'tekanan_10' => $tekanan_10[$i],
                                        'tekanan_11' => $tekanan_11[$i],
                                        'tekanan_12' => $tekanan_12[$i],
                                        'tekanan_13' => $tekanan_13[$i],
                                        'tekanan_14' => $tekanan_14[$i],
                                        'tekanan_15' => $tekanan_15[$i],
                                        'tekanan_16' => $tekanan_16[$i],
                                        'tekanan_17' => $tekanan_17[$i],
                                        'tekanan_18' => $tekanan_18[$i],
                                        'tekanan_19' => $tekanan_19[$i],
                                        'tekanan_20' => $tekanan_20[$i],
                                        'tekanan_21' => $tekanan_21[$i],
                                        'tekanan_22' => $tekanan_22[$i],
                                        'tekanan_23' => $tekanan_23[$i],
                                        'tekanan_24' => $tekanan_24[$i],
                                        'tekanan_01' => $tekanan_01[$i],
                                        'tekanan_02' => $tekanan_02[$i],
                                        'tekanan_03' => $tekanan_03[$i],
                                        'tekanan_04' => $tekanan_04[$i],
                                        'tekanan_05' => $tekanan_05[$i],
                                        'tekanan_06' => $tekanan_06[$i],
                                        'keterangan' => $keterangan[$i]
                                    );

                                    $datadetail = $detail_id[$i];
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtlx($datadetail, $data6);
                                    } else {
                                        $this->model->update_dtl($datadetail, $data6);
                                        $this->model->update_dtlx($datadetail, $data6);
                                    }
                                } else {
                                    $data6 = array(
                                        'headerid'   => $headerid,
                                        'stdtl'      => $stdtl,
                                        'item_id'    => $item_id[$i],
                                        'boiler'     => $boiler[$i],
                                        'tekanan_07' => $tekanan_07[$i],
                                        'tekanan_08' => $tekanan_08[$i],
                                        'tekanan_09' => $tekanan_09[$i],
                                        'tekanan_10' => $tekanan_10[$i],
                                        'tekanan_11' => $tekanan_11[$i],
                                        'tekanan_12' => $tekanan_12[$i],
                                        'tekanan_13' => $tekanan_13[$i],
                                        'tekanan_14' => $tekanan_14[$i],
                                        'tekanan_15' => $tekanan_15[$i],
                                        'tekanan_16' => $tekanan_16[$i],
                                        'tekanan_17' => $tekanan_17[$i],
                                        'tekanan_18' => $tekanan_18[$i],
                                        'tekanan_19' => $tekanan_19[$i],
                                        'tekanan_20' => $tekanan_20[$i],
                                        'tekanan_21' => $tekanan_21[$i],
                                        'tekanan_22' => $tekanan_22[$i],
                                        'tekanan_23' => $tekanan_23[$i],
                                        'tekanan_24' => $tekanan_24[$i],
                                        'tekanan_01' => $tekanan_01[$i],
                                        'tekanan_02' => $tekanan_02[$i],
                                        'tekanan_03' => $tekanan_03[$i],
                                        'tekanan_04' => $tekanan_04[$i],
                                        'tekanan_05' => $tekanan_05[$i],
                                        'tekanan_06' => $tekanan_06[$i],
                                        'keterangan' => $keterangan[$i]
                                    );
                                    $this->model->insert_detail($data6);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtlx($id);
                            }
                            $jmlb = count($this->input->post('dtlb_uraian'));
                            for ($ib = 0; $ib < $jmlb; $ib++) {
                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }
                                if (isset($detail_id_b[$ib])) {
                                    $data6b = array(
                                        'stdtl'                    => $stdtl,
                                        'dtlb_item_id'             => $dtlb_item_id[$ib],
                                        'dtlb_uraian'              => $dtlb_uraian[$ib],
                                        'dtlb_penerimaan_kg'       => $dtlb_penerimaan_kg[$ib],
                                        'dtlb_penerimaan_akm'      => $dtlb_penerimaan_akm[$ib],
                                        'dtlb_penerimaan_akm_awal' => $dtlb_penerimaan_akm_awal[$ib],
                                        'dtlb_pemakaian_kg'        => $dtlb_pemakaian_kg[$ib],
                                        'dtlb_pemakaian_akm'       => $dtlb_pemakaian_akm[$ib],
                                        'dtlb_pemakaian_akm_awal'  => $dtlb_pemakaian_akm_awal[$ib]
                                    );

                                    $datadetail = $detail_id_b[$ib];
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtl_bx($datadetail, $data6b);
                                    } else {
                                        $this->model->update_dtl_b($datadetail, $data6b);
                                        $this->model->update_dtl_bx($datadetail, $data6b);
                                    }
                                } else {
                                    $data6b = array(
                                        'headerid'                 => $headerid,
                                        'stdtl'                    => $stdtl,
                                        'dtlb_item_id'             => $dtlb_item_id[$ib],
                                        'dtlb_uraian'              => $dtlb_uraian[$ib],
                                        'dtlb_penerimaan_kg'       => $dtlb_penerimaan_kg[$ib],
                                        'dtlb_penerimaan_akm'      => $dtlb_penerimaan_akm[$ib],
                                        'dtlb_penerimaan_akm_awal' => $dtlb_penerimaan_akm_awal[$ib],
                                        'dtlb_pemakaian_kg'        => $dtlb_pemakaian_kg[$ib],
                                        'dtlb_pemakaian_akm'       => $dtlb_pemakaian_akm[$ib],
                                        'dtlb_pemakaian_akm_awal'  => $dtlb_pemakaian_akm_awal[$ib]
                                    );
                                    $this->model->insert_detail_b($data6b);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtl_bx($id);
                            }

                            $jmlb2 = count($this->input->post('dtlb2_uraian'));
                            for ($ib2 = 0; $ib2 < $jmlb2; $ib2++) {
                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }
                                if (isset($detail_id_b2[$ib2])) {
                                    $data6b2 = array(
                                        'stdtl'          => $stdtl,
                                        'dtlb2_item_id'  => $dtlb2_item_id[$ib2],
                                        'dtlb2_uraian'   => $dtlb2_uraian[$ib2],
                                        'dtlb2_terima'   => $dtlb2_terima[$ib2],
                                        'dtlb2_pakai'    => $dtlb2_pakai[$ib2],
                                        'dtlb2_akm'      => $dtlb2_akm[$ib2],
                                        'dtlb2_akm_awal' => $dtlb2_akm_awal[$ib2],
                                        'dtlb2_eff'      => $dtlb2_eff[$ib2],
                                        'dtlb2_stock'    => $dtlb2_stock[$ib2],
                                        'dtlb2_nodo'     => $dtlb2_nodo[$ib2]
                                    );

                                    $datadetail = $detail_id_b2[$ib2];
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtl_b2x($datadetail, $data6b2);
                                    } else {
                                        $this->model->update_dtl_b2($datadetail, $data6b2);
                                        $this->model->update_dtl_b2x($datadetail, $data6b2);
                                    }
                                } else {
                                    $data6b2 = array(
                                        'headerid'       => $headerid,
                                        'stdtl'          => $stdtl,
                                        'dtlb2_item_id'  => $dtlb2_item_id[$ib2],
                                        'dtlb2_uraian'   => $dtlb2_uraian[$ib2],
                                        'dtlb2_terima'   => $dtlb2_terima[$ib2],
                                        'dtlb2_pakai'    => $dtlb2_pakai[$ib2],
                                        'dtlb2_akm'      => $dtlb2_akm[$ib2],
                                        'dtlb2_akm_awal' => $dtlb2_akm_awal[$ib2],
                                        'dtlb2_eff'      => $dtlb2_eff[$ib2],
                                        'dtlb2_stock'    => $dtlb2_stock[$ib2],
                                        'dtlb2_nodo'     => $dtlb2_nodo[$ib2]
                                    );
                                    $this->model->insert_detail_b2($data6b2);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtl_b2x($id);
                            }

                            $jmlc = count($this->input->post('boiler'));
                            for ($ic = 0; $ic < $jmlc; $ic++) {
                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }
                                if (isset($detail_id_c[$ic])) {
                                    $data6c = array(
                                        'stdtl'               => $stdtl,
                                        'dtlc_item_id'        => $dtlc_item_id[$ic],
                                        'dtlc_kode_boiler'    => $dtlc_kode_boiler[$ic],
                                        'dtlc_total_jam'      => $dtlc_total_jam[$ic],
                                        'dtlc_jam_akm'        => $dtlc_jam_akm[$ic],
                                        'dtlc_jam_akm_awal'   => $dtlc_jam_akm_awal[$ic],
                                        'dtlc_tmpr_akm_awal'  => $dtlc_tmpr_akm_awal[$ic],
                                        'dtlc_steam_akm_awal' => $dtlc_steam_akm_awal[$ic],
                                        'dtlc_air_akm_awal'   => $dtlc_air_akm_awal[$ic],
                                        'dtlc_tmpr_kg'        => $dtlc_tmpr_kg[$ic],
                                        'dtlc_tmpr_akm'       => $dtlc_tmpr_akm[$ic],
                                        'dtlc_steam_ton'      => $dtlc_steam_ton[$ic],
                                        'dtlc_steam_akm'      => $dtlc_steam_akm[$ic],
                                        'dtlc_total_air'      => $dtlc_total_air[$ic],
                                        'dtlc_air_akm'        => $dtlc_air_akm[$ic]
                                    );

                                    $datadetail = $detail_id_c[$ic];
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtl_cx($datadetail, $data6c);
                                    } else {
                                        $this->model->update_dtl_c($datadetail, $data6c);
                                        $this->model->update_dtl_cx($datadetail, $data6c);
                                    }
                                } else {
                                    $data6c = array(
                                        'headerid'            => $headerid,
                                        'stdtl'               => $stdtl,
                                        'dtlc_item_id'        => $dtlc_item_id[$ic],
                                        'dtlc_kode_boiler'    => $dtlc_kode_boiler[$ic],
                                        'dtlc_total_jam'      => $dtlc_total_jam[$ic],
                                        'dtlc_jam_akm'        => $dtlc_jam_akm[$ic],
                                        'dtlc_jam_akm_awal'   => $dtlc_jam_akm_awal[$ic],
                                        'dtlc_tmpr_akm_awal'  => $dtlc_tmpr_akm_awal[$ic],
                                        'dtlc_steam_akm_awal' => $dtlc_steam_akm_awal[$ic],
                                        'dtlc_air_akm_awal'   => $dtlc_air_akm_awal[$ic],
                                        'dtlc_tmpr_kg'        => $dtlc_tmpr_kg[$ic],
                                        'dtlc_tmpr_akm'       => $dtlc_tmpr_akm[$ic],
                                        'dtlc_steam_ton'      => $dtlc_steam_ton[$ic],
                                        'dtlc_steam_akm'      => $dtlc_steam_akm[$ic],
                                        'dtlc_total_air'      => $dtlc_total_air[$ic],
                                        'dtlc_air_akm'        => $dtlc_air_akm[$ic]
                                    );
                                    $this->model->insert_detail_c($data6c);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtl_cx($id);
                            }

                            $jmld = count($this->input->post('dtld_uraian'));
                            for ($idd = 0; $idd < $jmld; $idd++) {
                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }
                                if (isset($detail_id_d[$idd])) {
                                    $data6d = array(
                                        'stdtl'               => $stdtl,
                                        'dtld_item_id'        => $dtld_item_id[$idd],
                                        'dtld_uraian'         => $dtld_uraian[$idd],
                                        'dtld_total_jam'      => $dtld_total_jam[$idd],
                                        'dtld_tmpr_kg'        => $dtld_tmpr_kg[$idd],
                                        'dtld_tmpr_akm'       => $dtld_tmpr_akm[$idd],
                                        'dtld_steam_ton'      => $dtld_steam_ton[$idd],
                                        'dtld_steam_akm'      => $dtld_steam_akm[$idd],
                                        'dtld_total_air'      => $dtld_total_air[$idd],
                                        'dtld_air_akm'        => $dtld_air_akm[$idd],
                                        'dtld_tmpr_akm_awal'  => $dtld_tmpr_akm_awal[$idd],
                                        'dtld_steam_akm_awal' => $dtld_steam_akm_awal[$idd],
                                        'dtld_air_akm_awal'   => $dtld_air_akm_awal[$idd]
                                    );

                                    $datadetail = $detail_id_d[$idd];
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtl_dx($datadetail, $data6d);
                                    } else {
                                        $this->model->update_dtl_d($datadetail, $data6d);
                                        $this->model->update_dtl_dx($datadetail, $data6d);
                                    }
                                } else {
                                    $data6d = array(
                                        'headerid'            => $headerid,
                                        'stdtl'               => $stdtl,
                                        'dtld_item_id'        => $dtld_item_id[$idd],
                                        'dtld_uraian'         => $dtld_uraian[$idd],
                                        'dtld_total_jam'      => $dtld_total_jam[$idd],
                                        'dtld_tmpr_kg'        => $dtld_tmpr_kg[$idd],
                                        'dtld_tmpr_akm'       => $dtld_tmpr_akm[$idd],
                                        'dtld_steam_ton'      => $dtld_steam_ton[$idd],
                                        'dtld_steam_akm'      => $dtld_steam_akm[$idd],
                                        'dtld_total_air'      => $dtld_total_air[$idd],
                                        'dtld_air_akm'        => $dtld_air_akm[$idd],
                                        'dtld_tmpr_akm_awal'  => $dtld_tmpr_akm_awal[$idd],
                                        'dtld_steam_akm_awal' => $dtld_steam_akm_awal[$idd],
                                        'dtld_air_akm_awal'   => $dtld_air_akm_awal[$idd]
                                    );
                                    $this->model->insert_detail_d($data6d);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtl_dx($id);
                            }
                        }
                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
                } elseif (isset($_POST['btndelete_dtl'])) {
                    if ($cekLevelUserNm == 'Auditor') {
                        $cekdetail = $this->model->cek_stdetailx($headerid);

                        $data5 = array(
                            'complete_useridx'          => $complete_userid,
                            'complete_personalstatus'   => $complete_personalstatus,
                            'complete_personalid'       => $complete_personalid,
                            'complete_position'         => $complete_position,
                            'complete_byx'              => $complete_by,
                            'complete_datex'            => $complete_date,
                            'complete_timex'            => $complete_time,
                            'complete_compx'            => $complete_comp, // versi user audit
                        );
                    } else {
                        $cekdetail = $this->model->cek_stdetail($headerid);
                        $data5                          = array(
                            'complete_userid'           => $complete_userid,
                            'complete_personalstatus'   => $complete_personalstatus,
                            'complete_personalid'       => $complete_personalid,
                            'complete_position'         => $complete_position,
                            'complete_by'               => $complete_by,
                            'complete_date'             => $complete_date,
                            'complete_time'             => $complete_time,
                            'complete_comp'             => $complete_comp, // versi user original

                            'complete_useridx'          => $complete_userid,
                            'complete_personalstatusx'  => $complete_personalstatus,
                            'complete_personalid'       => $complete_personalid,
                            'complete_position'         => $complete_position,
                            'complete_byx'              => $complete_by,
                            'complete_datex'            => $complete_date,
                            'complete_timex'            => $complete_time,
                            'complete_compx'            => $complete_comp, // versi user audit

                        );
                    }

                    if ($cekdetail->num_rows() > 0) {
                        $alertmessage = "<script>alert('Maaf data tidak bisa dihapus karena sudah dikomplit!! ');</script>";
                    } else {
                        $this->model->update_hdr($headerid, $data5);
                        $alertmessage = "<script>alert('Data berhasil dihapus!! ');</script>";

                        $chk    = $this->input->post('dtl_chk');
                        $jml    = count($this->input->post('dtl_chk'));

                        if ($cekLevelUserNm == 'Auditor') {
                            for ($i = 0; $i < $jml; $i++) {
                                $this->model->update_stdtl($chk[$i]);
                            }
                        } else {
                            for ($i = 0; $i < $jml; $i++) {
                                $this->model->delete_detail($chk[$i]);
                                $this->model->delete_detailx($chk[$i]);
                            }
                        }
                    }
                    echo $alertmessage;
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                } else {
                    echo "<script>alert('Tidak ada aksi atau hapus data tidak sesuai halaman shift!! ');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                }
            }
        } else {
            redirect('C_login', 'refresh');
        }
    }
}

/* End of file C_formfrmfss319_08.php */
