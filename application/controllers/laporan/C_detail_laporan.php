<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_detail_laporan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $frmkode = $this->uri->segment(4);
        $frmvrs  = $this->uri->segment(5);
        $this->load->model(array('M_user', 'master/M_form', 'M_menu', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->library(array('table', 'form_validation', 'excel', 'pdf'));
        $this->load->helper('form');

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

    function opendetail()
    {
        $session_data           = $this->session->userdata('logged_in');
        $data['username']       = $session_data['username'];
        $data['password']       = $session_data['password'];
        $data['jabid']          = $session_data['jabid'];
        $data['leveluserid']    = $session_data['leveluserid'];
        $data['nmdepan']        = $session_data['nmdepan'];
        $data['nmlengkap']      = $session_data['nmlengkap'];
        $data['levelusernm']    = $session_data['levelusernm'];
        $data['bagnm']          = $session_data['bagnm'];
        $data['jabnm']          = $session_data['jabnm'];
        $data['Titel']          = 'Laporan';
        $data['personalid']     = $session_data['personalid'];
        $data['personalstatus'] = $session_data['personalstatus'];

        $BagianAkses            = $session_data['bagian_akses'];
        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];

        $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
        $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

        $menus                  = $this->M_menu->menus($LevelUser);
        $data2                  = array('menus' => $menus);

        $frmkode                = $this->uri->segment(4);
        $frmvrs                 = $this->uri->segment(5);

        $dtfrm                  = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
        $data3                  = array('dtfrm' => $dtfrm);

        foreach ($dtfrm as $datafrm) {
            $frmkd = $datafrm->formkd;
            $frmnm = $datafrm->formnm;
        }

        $filekd     = $this->uri->segment(6);
        $id         = $this->uri->segment(7);
        $dtapp_pos  = $this->uri->segment(8);
        $dtapp_pos2 = $this->uri->segment(9);

        if (isset($dtapp_pos)) {
            $data['app_pos'] = $dtapp_pos;
        } else {
            $data['app_pos'] = '';
        }

        if (isset($dtapp_pos2)) {
            $data['app_pos2'] = $dtapp_pos2;
        } else {
            $data['app_pos2'] = '';
        }

        $model = 'M_form' . $frmkd . '_' . $frmvrs;

        /*
        |--------------------------------------------------------------------------
        | Data Get Header and Detail
        |--------------------------------------------------------------------------
        */

        switch ($frmkode) {
            case $frmkode == "frmfss315":
                $dtheader = $this->model->get_header_byid($id);
                $data7    = array('dtheader' => $dtheader);

                $data['headerid'] = $id;

                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail   = $this->model->get_detail_byidx($id);
                    $dtdetail_b = $this->model->get_detail_byid_bx($id);
                    $dtdetail_c = $this->model->get_detail_byid_cx($id);
                    $dtdetail_d = $this->model->get_detail_byid_dx($id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid($id);
                    $dtdetail_b = $this->model->get_detail_byid_b($id);
                    $dtdetail_c = $this->model->get_detail_byid_c($id);
                    $dtdetail_d = $this->model->get_detail_byid_d($id);
                }

                $data8 = array('dtdetail' => $dtdetail, 'dtdetail_b' => $dtdetail_b, 'dtdetail_c' => $dtdetail_c, 'dtdetail_d' => $dtdetail_d);
                break;

            case $frmkode == "frmfss316":
                $dtheader   = $this->model->get_header_byid($id);
                $data7      = array('dtheader' => $dtheader);
                $data['headerid'] = $id;

                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail = $this->model->get_detail_lap_byidx($id);
                } else {
                    $dtdetail = $this->model->get_detail_lap_byid($id);
                }

                $data8 = array('dtdetail' => $dtdetail);
                break;

            case $frmkode == "frmfss319":
                $dtheader   = $this->model->get_header_byid($id);
                $data7      = array('dtheader' => $dtheader);
                $data['headerid'] = $id;

                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail    = $this->model->get_detail_byidx($id);
                    $dtdetail_b  = $this->model->get_detail_byid_bx($id);
                    $dtdetail_b2 = $this->model->get_detail_byid_b2x($id);
                    $dtdetail_c  = $this->model->get_detail_byid_cx($id);
                    $dtdetail_d  = $this->model->get_detail_byid_dx($id);
                } else {
                    $dtdetail    = $this->model->get_detail_byid($id);
                    $dtdetail_b  = $this->model->get_detail_byid_b($id);
                    $dtdetail_b2 = $this->model->get_detail_byid_b2($id);
                    $dtdetail_c  = $this->model->get_detail_byid_c($id);
                    $dtdetail_d  = $this->model->get_detail_byid_d($id);
                }

                $data8 = array('dtdetail' => $dtdetail, 'dtdetail_b' => $dtdetail_b, 'dtdetail_c' => $dtdetail_c, 'dtdetail_d' => $dtdetail_d, 'dtdetail_b2' => $dtdetail_b2);
                break;

            case $frmkode == "frmfss520":
                $dtheader = $this->model->get_header_byid($id);
                $data7    = array('dtheader' => $dtheader);

                $data['headerid'] = $id;

                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail   = $this->model->get_detail_byid_lapx($id);
                    $dtdetail_b = $this->model->get_detail_byid_lapbx($id);
                    $dtdetail_c = $this->model->get_detail_byid_lapcx($id);
                    $dtdetail_d = $this->model->get_detail_byid_lapdx($id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid_lap($id);
                    $dtdetail_b = $this->model->get_detail_byid_lapb($id);
                    $dtdetail_c = $this->model->get_detail_byid_lapc($id);
                    $dtdetail_d = $this->model->get_detail_byid_lapd($id);
                }

                $data8 = array('dtdetail' => $dtdetail, 'dtdetail_b' => $dtdetail_b, 'dtdetail_c' => $dtdetail_c, 'dtdetail_d' => $dtdetail_d);
                break;
            case $frmkode == "inttbn009":
                $dtheader   = $this->model->get_header_byid($id);
                $data7      = array('dtheader' => $dtheader);
                $data['headerid'] = $id;

                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail   = $this->model->get_detail_byidx($id);
                    $dtdetail_b = $this->model->get_detail_byid_bx($id);
                    $dtdetail_c = $this->model->get_detail_byid_cx($id);
                    $dtdetail_d = $this->model->get_detail_byid_dx($id);
                    $dtdetail_e = $this->model->get_detail_byid_ex($id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid($id);
                    $dtdetail_b = $this->model->get_detail_byid_b($id);
                    $dtdetail_c = $this->model->get_detail_byid_c($id);
                    $dtdetail_d = $this->model->get_detail_byid_d($id);
                    $dtdetail_e = $this->model->get_detail_byid_e($id);
                }

                $data8 = array('dtdetail' => $dtdetail, 'dtdetail_b' => $dtdetail_b, 'dtdetail_c' => $dtdetail_c, 'dtdetail_d' => $dtdetail_d, 'dtdetail_e' => $dtdetail_e);
                break;

            case $frmkode == "inttbn040":
                $dtheader   = $this->model->get_header_byid($id);
                $data7      = array('dtheader' => $dtheader);
                $data['headerid'] = $id;

                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail   = $this->model->get_detail_byidx($id);
                    $dtdetailb = $this->model->get_detail_byidbx($id);
                    $dtdetailc = $this->model->get_detail_byidcx($id);
                    $dtdetaild = $this->model->get_detail_byiddx($id);
                    $dtdetaile = $this->model->get_detail_byidex($id);
                    $dtdetailf = $this->model->get_detail_byidfx($id);
                    $dtdetailg = $this->model->get_detail_byidgx($id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid($id);
                    $dtdetailb = $this->model->get_detail_byidb($id);
                    $dtdetailc = $this->model->get_detail_byidc($id);
                    $dtdetaild = $this->model->get_detail_byidd($id);
                    $dtdetaile = $this->model->get_detail_byide($id);
                    $dtdetailf = $this->model->get_detail_byidf($id);
                    $dtdetailg = $this->model->get_detail_byidg($id);
                }

                $data8 = array('dtdetail' => $dtdetail, 'dtdetailb' => $dtdetailb, 'dtdetailc' => $dtdetailc, 'dtdetaild' => $dtdetaild, 'dtdetaile' => $dtdetaile, 'dtdetailf' => $dtdetailf, 'dtdetailg' => $dtdetailg);
                break;

            case $frmkode == "frmfss520":
                $dtheader = $this->model->get_header_byid($id);
                $data7    = array('dtheader' => $dtheader);

                $data['headerid'] = $id;

                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail   = $this->model->get_detail_byid_lapx($id);
                    $dtdetail_b = $this->model->get_detail_byid_lapbx($id);
                    $dtdetail_c = $this->model->get_detail_byid_lapcx($id);
                    $dtdetail_d = $this->model->get_detail_byid_lapdx($id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid_lap($id);
                    $dtdetail_b = $this->model->get_detail_byid_lapb($id);
                    $dtdetail_c = $this->model->get_detail_byid_lapc($id);
                    $dtdetail_d = $this->model->get_detail_byid_lapd($id);
                }

                $data8 = array('dtdetail' => $dtdetail, 'dtdetail_b' => $dtdetail_b, 'dtdetail_c' => $dtdetail_c, 'dtdetail_d' => $dtdetail_d);
                break;
            case $frmkode == "frmfss188":
                $dtheader = $this->model->get_header_byid($id);
                $data7    = array('dtheader' => $dtheader);

                foreach ($dtheader as $dtheader_row) {
                    $create_date = $dtheader_row->create_date;
                    $dept        = $dtheader_row->deptabbr;
                }
                $tipe = 'Tipe 1';

                $data['headerid']      = $id;
                $data['dt_list_point'] = $this->model->get_list_item($tipe, $create_date, $dept);

                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail = $this->model->get_detail_byid($id);
                }

                $data8 = array('dtdetail' => $dtdetail);
                break;
            case $frmkode == "frmfss317":
                $dtheader = $this->model->get_header_byid($id);
                $data7    = array('dtheader' => $dtheader);

                $data['headerid'] = $id;

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail      = $this->model->get_detail_byidx($id);
                    $dtdetail_b    = $this->model->get_detail_byid_bx($id);
                    $dtdetail_c    = $this->model->get_detail_byid_cx($id);
                    $dtdetail_c_uf = $this->model->get_detail_byid_c_ufx($id);
                    $dtdetail_d    = $this->model->get_detail_byid_dx($id);
                    $dtdetail_e    = $this->model->get_detail_byid_ex($id);
                    $dtdetail_f    = $this->model->get_detail_byid_fx($id);
                    $dtdetail_g    = $this->model->get_detail_byid_gx($id);
                    $dtdetail_h    = $this->model->get_detail_byid_hx($id);
                    $dtdetail_i    = $this->model->get_detail_byid_ix($id);
                    $dtdetail_j    = $this->model->get_detail_byid_jx($id);
                    $dtdetail_k    = $this->model->get_detail_byid_kx($id);
                    $dtdetail_l    = $this->model->get_detail_byid_lx($id);
                    $dtdetail_m    = $this->model->get_detail_byid_mx($id);
                    $dtdetail_n    = $this->model->get_detail_byid_nx($id);
                    $dtdetail_o    = $this->model->get_detail_byid_ox($id);
                    $dtdetail_p    = $this->model->get_detail_byid_px($id);
                } else {
                    $dtdetail      = $this->model->get_detail_byid($id);
                    $dtdetail_b    = $this->model->get_detail_byid_b($id);
                    $dtdetail_c    = $this->model->get_detail_byid_c($id);
                    $dtdetail_c_uf = $this->model->get_detail_byid_c_uf($id);
                    $dtdetail_d    = $this->model->get_detail_byid_d($id);
                    $dtdetail_e    = $this->model->get_detail_byid_e($id);
                    $dtdetail_f    = $this->model->get_detail_byid_f($id);
                    $dtdetail_g    = $this->model->get_detail_byid_g($id);
                    $dtdetail_h    = $this->model->get_detail_byid_h($id);
                    $dtdetail_i    = $this->model->get_detail_byid_i($id);
                    $dtdetail_j    = $this->model->get_detail_byid_j($id);
                    $dtdetail_k    = $this->model->get_detail_byid_k($id);
                    $dtdetail_l    = $this->model->get_detail_byid_l($id);
                    $dtdetail_m    = $this->model->get_detail_byid_m($id);
                    $dtdetail_n    = $this->model->get_detail_byid_n($id);
                    $dtdetail_o    = $this->model->get_detail_byid_o($id);
                    $dtdetail_p    = $this->model->get_detail_byid_p($id);
                }

                $data8 = array(
                    'dtdetail'      => $dtdetail,
                    'dtdetail_b'    => $dtdetail_b,
                    'dtdetail_c'    => $dtdetail_c,
                    'dtdetail_c_uf' => $dtdetail_c_uf,
                    'dtdetail_d'    => $dtdetail_d,
                    'dtdetail_e'    => $dtdetail_e,
                    'dtdetail_f'    => $dtdetail_f,
                    'dtdetail_g'    => $dtdetail_g,
                    'dtdetail_h'    => $dtdetail_h,
                    'dtdetail_i'    => $dtdetail_i,
                    'dtdetail_j'    => $dtdetail_j,
                    'dtdetail_k'    => $dtdetail_k,
                    'dtdetail_l'    => $dtdetail_l,
                    'dtdetail_m'    => $dtdetail_m,
                    'dtdetail_n'    => $dtdetail_n,
                    'dtdetail_o'    => $dtdetail_o,
                    'dtdetail_p'    => $dtdetail_p

                );
                break;
            case $frmkode == "frmfss318":
                $dtheader = $this->model->get_header_byid($id);
                $data7    = array('dtheader' => $dtheader);

                $data['headerid'] = $id;

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail   = $this->model->get_detail_byidx($id);
                    $dtdetail_b = $this->model->get_detail_byid_bx($id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid($id);
                    $dtdetail_b = $this->model->get_detail_byid_b($id);
                }

                $data8 = array(
                    'dtdetail'   => $dtdetail,
                    'dtdetail_b' => $dtdetail_b

                );
                break;
            case $frmkode == "intwtd017":
                $dtheader = $this->model->get_header_byid($id);
                $data7    = array('dtheader' => $dtheader);

                $data['headerid'] = $id;

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail   = $this->model->get_detail_byidx($id);
                    $dtdetail_b = $this->model->get_detail_byid_bx($id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid($id);
                    $dtdetail_b = $this->model->get_detail_byid_b($id);
                }

                $data['dtspek_frommst']       = $this->M_forminput->get_spek_form(date('Y-m-d'), '', '', '', $frmkode, $frmvrs);

                $data8 = array(
                    'dtdetail'   => $dtdetail,
                    'dtdetail_b' => $dtdetail_b

                );
                break;
            case $frmkode == "frmfss054":
            case $frmkode == "frmfss061":
                $dtheader = $this->model->get_header_byid($id);
                $data7    = array('dtheader' => $dtheader);

                $data['headerid'] = $id;

                foreach ($dtheader as $dtheaderrow) {
                    $tahun = $dtheaderrow->tahun;
                }

                $data['list_month']             = $this->model->get_month($tahun);
                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail   = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid($id);
                }

                $data8 = array(
                    'dtdetail'   => $dtdetail
                );
                break;
            case $frmkode == "intwtd016":
                $dtheader = $this->model->get_header_byid($id);
                $data7    = array('dtheader' => $dtheader);

                $data['headerid'] = $id;

                foreach ($dtheader as $dtheaderrow) {
                    $create_date    = $dtheaderrow->create_date;
                    $periode        = explode("-", $dtheaderrow->periode);
                    $data['bulan']          = $periode[0];
                    $data['tahun']          = $periode[1];
                }
                $data['date_calender']      = $this->model->get_date_calender($data['bulan'], $data['tahun']);
                $data['result_list_item']   = $this->model->get_list_item($create_date);

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail   = $this->model->get_detail_byidx($id);
                    $dtdetail_b = $this->model->get_dtfrmfss188x_by($data['bulan'], $data['tahun'], $create_date, $id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid($id);
                    $dtdetail_b = $this->model->get_dtfrmfss188_by($data['bulan'], $data['tahun'], $create_date, $id);
                }

                $data8 = array(
                    'dtdetail'   => $dtdetail,
                    'dtdetail_b' => $dtdetail_b

                );
                break;
            case $frmkode == "intwtd005":
                $dtheader = $this->model->get_header_byid($id);
                $data7    = array('dtheader' => $dtheader);

                $data['headerid'] = $id;

                foreach ($dtheader as $dtheaderrow) {
                    $create_date    = $dtheaderrow->create_date;
                    $data['bulan']          = $dtheaderrow->bulan;
                    $data['tahun']          = date("Y", strtotime($create_date));
                }
                $data['date_calender']      = $this->model->get_date_calender($data['bulan'], $data['tahun']);

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail   = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid($id);
                }

                $data8 = array(
                    'dtdetail'   => $dtdetail,
                );
                break;
            case $frmkode == "frmfss812":
                $dtheader = $this->model->get_header_byid($id);
                $data7    = array('dtheader' => $dtheader);
                $data['headerid'] = $id;
                foreach ($dtheader as $dtheaderrow) {
                    $dtcreate_date    = $dtheaderrow->create_date;
                    $dtdept           = $dtheaderrow->deptabbr;
                    $dtid_jns_mesin   = $dtheaderrow->id_jns_mesin;
                    $dtid_gugus       = $dtheaderrow->id_gugus;
                }
                $data['list_pj']            = $this->M_forminput->get_list_pj($dtcreate_date, $frmnm);
                $data['dtkomponenmesin']    = $this->model->get_all_komponenmesin($BagianAkses);
                $data['dtjenis_mesin']      = $this->model->get_jenis_mesin_by($dtdept, $dtcreate_date);
                $data['dtgugus']            = $this->model->get_gugus_by($dtdept, $dtid_jns_mesin, $dtcreate_date);
                $data['dtitem_mesin']       = $this->model->get_itemmesin($dtdept, $dtid_jns_mesin, $dtid_gugus, $dtcreate_date);
                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail           = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail           = $this->model->get_detail_byid($id);
                }
                $data8 = array(
                    'dtdetail'   => $dtdetail
                );
                break;
            case $frmkode == "frmfss846":
                $dtheader = $this->model->get_header_byid($id);
                $data7    = array('dtheader' => $dtheader);
                $data['headerid'] = $id;
                foreach ($dtheader as $dtheaderrow) {
                    $dtcreate_date    = $dtheaderrow->create_date;
                    $dtdept           = $dtheaderrow->dept;
                    $dtid_nama_panel  = $dtheaderrow->id_nama_panel;
                    $dtid_kode_panel  = $dtheaderrow->kode_panel;
                    $dtlokasi_panel   = $dtheaderrow->lokasi_panel;
                }

                $data['list_pj']            = $this->M_forminput->get_list_pj($dtcreate_date, $frmnm);
                $data['dtkomponenmesin']    = $this->model->get_all_komponenmesin($BagianAkses);
                $data['dtjenis_mesin']      = $this->model->get_jenis_mesin_by($dtdept, $dtcreate_date);
                $data['dtkode']             = $this->model->get_kode_by($dtdept, $dtid_nama_panel, $dtcreate_date);
                $data['dtlokasi']           = $this->model->get_lokasi_by($dtdept, $dtid_nama_panel, $dtcreate_date);
                $data['dtitem_mesin']       = $this->model->get_itemmesin($dtdept, $dtid_nama_panel, $dtid_kode_panel, $dtlokasi_panel);
                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail           = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail           = $this->model->get_detail_byid($id);
                }
                $data8 = array(
                    'dtdetail'   => $dtdetail
                );
                break;
            case $frmkode == "inttbn022":
                $dtheader   = $this->model->get_header_byid($id);
                $data7      = array('dtheader' => $dtheader);
                $data['headerid'] = $id;
                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail   = $this->model->get_detail_byidx($id);
                    $dtdetail_b = $this->model->get_detail_byid_bx($id);
                    $dtdetail_c = $this->model->get_detail_byid_cx($id);
                    $dtdetail_d = $this->model->get_detail_byid_dx($id);
                    $dtdetail_e = $this->model->get_detail_byid_ex($id);
                    $dtdetail_f = $this->model->get_detail_byid_fx($id);
                    $dtdetail_g = $this->model->get_detail_byid_gx($id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid($id);
                    $dtdetail_b = $this->model->get_detail_byid_b($id);
                    $dtdetail_c = $this->model->get_detail_byid_c($id);
                    $dtdetail_d = $this->model->get_detail_byid_d($id);
                    $dtdetail_e = $this->model->get_detail_byid_e($id);
                    $dtdetail_f = $this->model->get_detail_byid_f($id);
                    $dtdetail_g = $this->model->get_detail_byid_g($id);
                }
                $data8 = array('dtdetail' => $dtdetail, 'dtdetail_b' => $dtdetail_b, 'dtdetail_c' => $dtdetail_c, 'dtdetail_d' => $dtdetail_d, 'dtdetail_e' => $dtdetail_e, 'dtdetail_f' => $dtdetail_f, 'dtdetail_g' => $dtdetail_g);
                break;
            case $frmkode == "intwtd032":
                $dtheader   = $this->model->get_header_byid($id);
                $data7      = array('dtheader' => $dtheader);
                $data['headerid'] = $id;
                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail   = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid($id);
                }
                $data8 = array('dtdetail' => $dtdetail);
                break;
            default:
                $dtheader   = $this->model->get_header_byid($id);
                $data7      = array('dtheader' => $dtheader);
                $data['headerid'] = $id;
                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail = $this->model->get_detail_byid($id);
                }
                $data8 = array('dtdetail' => $dtdetail);
                break;
        }

        /*
        |--------------------------------------------------------------------------
        | Data righheader dan left header
        |--------------------------------------------------------------------------
        */

        if (isset($dtheader)) {
            $bulan_indo = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            foreach ($dtheader as $headrow) {
                switch ($frmkode) {
                    case $frmkode == "frmfss054":
                    case $frmkode == "frmfss061":
                        $data['leftheader'] =
                            array(
                                'Gugus : ' . $headrow->gugus,
                                'Departemen : ' . $headrow->deptabbr,
                                'Tahun : ' . $headrow->tahun,
                            );
                        break;
                    case $frmkode == "frmfss065":
                        $data['leftheader'] =
                            array(
                                'Gugus : ' . $headrow->gugus,
                                'Departemen : ' . $headrow->deptabbr,
                                'Nama Mesin : ' . $headrow->nama_mesin,
                            );
                        break;
                    case $frmkode == "frmfss812":
                        $data['leftheader'] =
                            array(
                                'Departemen : ' . $headrow->deptabbr,
                                'Jenis Mesin : ' . $headrow->jns_mesin,
                                'Gugus : ' . $headrow->gugus,
                            );

                        break;
                    case $frmkode == "intwtd016":
                        $data['leftheader'] =
                            array(
                                'Periode : ' . $bulan_indo[str_replace('0', '', explode('-', $headrow->periode)[0])] . ' ' . explode('-', $headrow->periode)[1],
                            );

                        break;
                    case $frmkode == "intwtd005":
                        $data['leftheader'] =
                            array(
                                'Kode : ' . $headrow->kode_name,
                                'Bulan : ' . $bulan_indo[str_replace('0', '', $headrow->bulan)],
                            );
                        break;
                    case $frmkode == "frmfss060":
                        $data['leftheader'] =
                            array(
                                'Departemen : ' . $headrow->deptabbr,
                                'Periode : ' . $bulan_indo[str_replace('0', '', explode('-', $headrow->periode)[1])] . ' ' . explode('-', $headrow->periode)[0],
                            );
                        break;
                    default:
                        break;
                }
            }
        }
        /*
        |--------------------------------------------------------------------------
        | Add link to open view
        |--------------------------------------------------------------------------
        */
        $this->load->view('laporan/V_laporan_detail_' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
    }
}
