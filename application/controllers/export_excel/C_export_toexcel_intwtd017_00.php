<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_intwtd017_00 extends CI_Controller
{
    private $xls;
    private $spreadsheet;
    private $cekLevelUserNm;
    private $frmcop;

    var $header_id;
    var $frmnm;
    var $frmjdl;
    var $frmjdl_en;
    var $frmkd;
    var $frmver;
    var $frmefective;

    function __construct()
    {
        parent::__construct();
        $frmkode = $this->uri->segment(4);
        $frmvrs = $this->uri->segment(5);
        $this->load->model(array('M_user', 'master/M_form', 'M_menu', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->library(array('table', 'form_validation', 'excel', 'fpdf'));
        $this->frmcop = $this->config->item("nama_perusahaan");
        $session_data = $this->session->userdata('logged_in');
        $dtheader['Titel'] = 'Home';
        $LevelUser = $session_data['leveluserid'];
        $UserName = $session_data['username'];
        $LevelUserNm = $session_data['levelusernm'];
        $this->cekLevelUserNm = substr($LevelUserNm, 0, 7);
        $this->model = $this->{'M_form' . $frmkode . '_' . $frmvrs};
        ///load  excel ////
        $this->xls = new exelstyles();
        $this->spreadsheet = new Excel();
        $this->sheet =  $this->spreadsheet->getActiveSheet();
        ///end load excel///
    }

    function exportxls()
    {
        // Get dtheader
        $frmkode                = $this->uri->segment(4);
        $frmvrs                 = $this->uri->segment(5);
        $this->header_id        = $this->uri->segment(6);
        $dtfrm                  = $this->M_forminput->get_dtform($frmkode, $frmvrs);
        foreach ($dtfrm as $datafrm) {
            $this->frmkd          = $datafrm->formkd;
            $this->frmjdl         = $datafrm->formjudul;
            $this->frmnm          = $datafrm->formnm;
            $this->frmver         = $datafrm->formversi;
            $this->frmefective    = date("d-m-Y", strtotime($datafrm->formefective));
        }

        $frmkd = $this->frmkd;
        $frmver = $this->frmver;
        $dtheader = $this->model->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date       = $dtheaderrow->create_date; //2021-02-08

            $create_date         = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno               = $dtheaderrow->docno;

            $app1_by             = $dtheaderrow->app1_by;
            $app2_by             = $dtheaderrow->app2_by;
            $app3_by             = $dtheaderrow->app3_by;
            $app4_by             = $dtheaderrow->app4_by;
            $app5_by             = $dtheaderrow->app5_by;
            $app6_by             = $dtheaderrow->app6_by;
            $app7_by             = $dtheaderrow->app7_by;
            $app8_by             = $dtheaderrow->app8_by;

            $app1_position       = $dtheaderrow->app1_position;
            $app2_position       = $dtheaderrow->app2_position;
            $app3_position       = $dtheaderrow->app3_position;
            $app4_position       = $dtheaderrow->app4_position;
            $app5_position       = $dtheaderrow->app5_position;
            $app6_position       = $dtheaderrow->app6_position;
            $app7_position       = $dtheaderrow->app7_position;
            $app8_position       = $dtheaderrow->app8_position;

            $app1_personalid     = $dtheaderrow->app1_personalid;
            $app2_personalid     = $dtheaderrow->app2_personalid;
            $app3_personalid     = $dtheaderrow->app3_personalid;
            $app4_personalid     = $dtheaderrow->app4_personalid;
            $app5_personalid     = $dtheaderrow->app5_personalid;
            $app6_personalid     = $dtheaderrow->app6_personalid;
            $app7_personalid     = $dtheaderrow->app7_personalid;
            $app8_personalid     = $dtheaderrow->app8_personalid;


            $app1_personalstatus = $dtheaderrow->app1_personalstatus;
            $app2_personalstatus = $dtheaderrow->app2_personalstatus;
            $app3_personalstatus = $dtheaderrow->app3_personalstatus;
            $app4_personalstatus = $dtheaderrow->app4_personalstatus;
            $app5_personalstatus = $dtheaderrow->app5_personalstatus;
            $app6_personalstatus = $dtheaderrow->app6_personalstatus;
            $app7_personalstatus = $dtheaderrow->app7_personalstatus;
            $app8_personalstatus = $dtheaderrow->app8_personalstatus;

            $app1date             = $dtheaderrow->app1_date;
            $app2date             = $dtheaderrow->app2_date;
            $app3date             = $dtheaderrow->app3_date;
            $app4date             = $dtheaderrow->app4_date;
            $app5date             = $dtheaderrow->app5_date;
            $app6date             = $dtheaderrow->app6_date;
            $app7date             = $dtheaderrow->app7_date;
            $app8date             = $dtheaderrow->app8_date;


            if (trim($dtheaderrow->app1_date) != '') {
                $app1_date       = date('d-m-Y', strtotime($dtheaderrow->app1_date));
            } else {
                $app1_date = '';
            }
            if (trim($dtheaderrow->app2_date) != '') {
                $app2_date       = date('d-m-Y', strtotime($dtheaderrow->app2_date));
            } else {
                $app2_date = '';
            }
            if (trim($dtheaderrow->app3_date) != '') {
                $app3_date       = date('d-m-Y', strtotime($dtheaderrow->app3_date));
            } else {
                $app3_date = '';
            }
            if (trim($dtheaderrow->app4_date) != '') {
                $app4_date       = date('d-m-Y', strtotime($dtheaderrow->app4_date));
            } else {
                $app4_date = '';
            }
            if (trim($dtheaderrow->app5_date) != '') {
                $app5_date       = date('d-m-Y', strtotime($dtheaderrow->app5_date));
            } else {
                $app5_date = '';
            }
            if (trim($dtheaderrow->app6_date) != '') {
                $app6_date       = date('d-m-Y', strtotime($dtheaderrow->app6_date));
            } else {
                $app6_date = '';
            }
            if (trim($dtheaderrow->app7_date) != '') {
                $app7_date       = date('d-m-Y', strtotime($dtheaderrow->app7_date));
            } else {
                $app7_date = '';
            }
            if (trim($dtheaderrow->app8_date) != '') {
                $app8_date       = date('d-m-Y', strtotime($dtheaderrow->app8_date));
            } else {
                $app8_date = '';
            }
        }

        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail       = $this->model->get_detail_byidx($this->header_id);
            $dtdetail_b     = $this->model->get_detail_byid_bx($this->header_id);
        } else {
            $dtdetail       = $this->model->get_detail_byid($this->header_id);
            $dtdetail_b     = $this->model->get_detail_byid_b($this->header_id);
        }

        $dtspek_frommst  = $this->M_forminput->get_spek_form(date('Y-m-d'), '', '', '', $frmkd, $frmvrs);

        // detail
        $no = 1;

        foreach ($dtdetail as $dtdetail_key => $dtdetail_row) {

            $jam[]                  = $dtdetail_row->jam;
            $sedimen_ph_6a[]        = $dtdetail_row->sedimen_ph_6a;
            $sedimen_ph_6b[]        = $dtdetail_row->sedimen_ph_6b;
            $sedimen_colour_6a[]    = $dtdetail_row->sedimen_colour_6a;
            $sedimen_colour_6b[]    = $dtdetail_row->sedimen_colour_6b;
            $sedimen_tds_6a[]       = $dtdetail_row->sedimen_tds_6a;
            $sedimen_tds_6b[]       = $dtdetail_row->sedimen_tds_6b;
            $cone_ph[]              = $dtdetail_row->cone_ph;
            $cone_colour[]          = $dtdetail_row->cone_colour;
            $cone_tds[]             = $dtdetail_row->cone_tds;
            for ($j = 1; $j <= 7; $j++) {
                ${'tsf_colour_sf' . $j}[]     = $dtdetail_row->{'tsf_colour_sf' . $j};
                ${'tsf_turbidity_sf' . $j}[]     = $dtdetail_row->{'tsf_turbidity_sf' . $j};
            }
            for ($j = 1; $j <= 6; $j++) {
                ${'tcf_colour_cf' . $j}[]     = $dtdetail_row->{'tcf_colour_cf' . $j};
                ${'tcf_turbidity_cf' . $j}[]     = $dtdetail_row->{'tcf_turbidity_cf' . $j};
            }
            for ($j = 1; $j <= 5; $j++) {
                ${'ts_th_st' . $j}[]     = $dtdetail_row->{'ts_th_st' . $j};
            }
            $bak_demin_ph[]         = $dtdetail_row->bak_demin_ph;
            $bak_demin_colour[]     = $dtdetail_row->bak_demin_colour;
            $bak_demin_tbd[]        = $dtdetail_row->bak_demin_tbd;
            $bak2_ph[]              = $dtdetail_row->bak2_ph;
            $bak2_colour[]          = $dtdetail_row->bak2_colour;
            $bak2_tbd[]             = $dtdetail_row->bak2_tbd;
            $bak3_ph[]              = $dtdetail_row->bak3_ph;
            $bak3_colour[]          = $dtdetail_row->bak3_colour;
            $bak3_tbd[]             = $dtdetail_row->bak3_tbd;
            $bak4_ph[]              = $dtdetail_row->bak4_ph;
            $bak4_colour[]          = $dtdetail_row->bak4_colour;
            $bak4_tbd[]             = $dtdetail_row->bak4_tbd;


            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_sedimen_ph_6a);
                    unset($nautoinsedimen_ph_6a);
                    if ($cek_dtspek_frommst->parameter == 'sedimen_ph') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->sedimen_ph_6a) && $dtdetail_row->sedimen_ph_6a > $cek_dtspek_frommst->spec_max) {
                            $ndt_sedimen_ph_6a    = '1';
                            $nautoinsedimen_ph_6a = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->sedimen_ph_6a) && $dtdetail_row->sedimen_ph_6a < $cek_dtspek_frommst->spec_min) {
                            $ndt_sedimen_ph_6a    = '2';
                            $nautoinsedimen_ph_6a = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_sedimen_ph_6a    = '0';
                            $nautoinsedimen_ph_6a = $dtdetail_row->sedimen_ph_6a;
                        }
                    } else {
                        $ndt_sedimen_ph_6a    = '0';
                        $nautoinsedimen_ph_6a = $dtdetail_row->sedimen_ph_6a;
                    }
                }
                $adt_sedimen_ph_6a[]    = $ndt_sedimen_ph_6a;
                $autoinsedimen_ph_6a[] = $nautoinsedimen_ph_6a;
            }

            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_sedimen_ph_6b);
                    unset($nautoinsedimen_ph_6b);
                    if ($cek_dtspek_frommst->parameter == 'sedimen_ph') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->sedimen_ph_6b) && $dtdetail_row->sedimen_ph_6b > $cek_dtspek_frommst->spec_max) {
                            $ndt_sedimen_ph_6b    = '1';
                            $nautoinsedimen_ph_6b = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->sedimen_ph_6b) && $dtdetail_row->sedimen_ph_6b < $cek_dtspek_frommst->spec_min) {
                            $ndt_sedimen_ph_6b    = '2';
                            $nautoinsedimen_ph_6b = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_sedimen_ph_6b    = '0';
                            $nautoinsedimen_ph_6b = $dtdetail_row->sedimen_ph_6b;
                        }
                    } else {
                        $ndt_sedimen_ph_6b    = '0';
                        $nautoinsedimen_ph_6b = $dtdetail_row->sedimen_ph_6b;
                    }
                }
                $adt_sedimen_ph_6b[]    = $ndt_sedimen_ph_6b;
                $autoinsedimen_ph_6b[] = $nautoinsedimen_ph_6b;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_sedimen_colour_6a);
                    unset($nautoinsedimen_colour_6a);
                    if ($cek_dtspek_frommst->parameter == 'sedimen_colour') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->sedimen_colour_6a) && $dtdetail_row->sedimen_colour_6a > $cek_dtspek_frommst->spec_max) {
                            $ndt_sedimen_colour_6a    = '1';
                            $nautoinsedimen_colour_6a = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->sedimen_colour_6a) && $dtdetail_row->sedimen_colour_6a < $cek_dtspek_frommst->spec_min) {
                            $ndt_sedimen_colour_6a    = '2';
                            $nautoinsedimen_colour_6a = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_sedimen_colour_6a    = '0';
                            $nautoinsedimen_colour_6a = $dtdetail_row->sedimen_colour_6a;
                        }
                    } else {
                        $ndt_sedimen_colour_6a    = '0';
                        $nautoinsedimen_colour_6a = $dtdetail_row->sedimen_colour_6a;
                    }
                }
                $adt_sedimen_colour_6a[]    = $ndt_sedimen_colour_6a;
                $autoinsedimen_colour_6a[] = $nautoinsedimen_colour_6a;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_sedimen_colour_6b);
                    unset($nautoinsedimen_colour_6b);
                    if ($cek_dtspek_frommst->parameter == 'sedimen_colour') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->sedimen_colour_6b) && $dtdetail_row->sedimen_colour_6b > $cek_dtspek_frommst->spec_max) {
                            $ndt_sedimen_colour_6b    = '1';
                            $nautoinsedimen_colour_6b = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->sedimen_colour_6b) && $dtdetail_row->sedimen_colour_6b < $cek_dtspek_frommst->spec_min) {
                            $ndt_sedimen_colour_6b    = '2';
                            $nautoinsedimen_colour_6b = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_sedimen_colour_6b    = '0';
                            $nautoinsedimen_colour_6b = $dtdetail_row->sedimen_colour_6b;
                        }
                    } else {
                        $ndt_sedimen_colour_6b    = '0';
                        $nautoinsedimen_colour_6b = $dtdetail_row->sedimen_colour_6b;
                    }
                }
                $adt_sedimen_colour_6b[]    = $ndt_sedimen_colour_6b;
                $autoinsedimen_colour_6b[] = $nautoinsedimen_colour_6b;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_sedimen_tds_6a);
                    unset($nautoinsedimen_tds_6a);
                    if ($cek_dtspek_frommst->parameter == 'sedimen_tds') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->sedimen_tds_6a) && $dtdetail_row->sedimen_tds_6a > $cek_dtspek_frommst->spec_max) {
                            $ndt_sedimen_tds_6a    = '1';
                            $nautoinsedimen_tds_6a = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->sedimen_tds_6a) && $dtdetail_row->sedimen_tds_6a < $cek_dtspek_frommst->spec_min) {
                            $ndt_sedimen_tds_6a    = '2';
                            $nautoinsedimen_tds_6a = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_sedimen_tds_6a    = '0';
                            $nautoinsedimen_tds_6a = $dtdetail_row->sedimen_tds_6a;
                        }
                    } else {
                        $ndt_sedimen_tds_6a    = '0';
                        $nautoinsedimen_tds_6a = $dtdetail_row->sedimen_tds_6a;
                    }
                }
                $adt_sedimen_tds_6a[]    = $ndt_sedimen_tds_6a;
                $autoinsedimen_tds_6a[] = $nautoinsedimen_tds_6a;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_sedimen_tds_6b);
                    unset($nautoinsedimen_tds_6b);
                    if ($cek_dtspek_frommst->parameter == 'sedimen_tds') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->sedimen_tds_6b) && $dtdetail_row->sedimen_tds_6b > $cek_dtspek_frommst->spec_max) {
                            $ndt_sedimen_tds_6b    = '1';
                            $nautoinsedimen_tds_6b = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->sedimen_tds_6b) && $dtdetail_row->sedimen_tds_6b < $cek_dtspek_frommst->spec_min) {
                            $ndt_sedimen_tds_6b    = '2';
                            $nautoinsedimen_tds_6b = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_sedimen_tds_6b    = '0';
                            $nautoinsedimen_tds_6b = $dtdetail_row->sedimen_tds_6b;
                        }
                    } else {
                        $ndt_sedimen_tds_6b    = '0';
                        $nautoinsedimen_tds_6b = $dtdetail_row->sedimen_tds_6b;
                    }
                }
                $adt_sedimen_tds_6b[]    = $ndt_sedimen_tds_6b;
                $autoinsedimen_tds_6b[] = $nautoinsedimen_tds_6b;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_cone_ph);
                    unset($nautoincone_ph);
                    if ($cek_dtspek_frommst->parameter == 'cone_ph') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->cone_ph) && $dtdetail_row->cone_ph > $cek_dtspek_frommst->spec_max) {
                            $ndt_cone_ph    = '1';
                            $nautoincone_ph = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->cone_ph) && $dtdetail_row->cone_ph < $cek_dtspek_frommst->spec_min) {
                            $ndt_cone_ph    = '2';
                            $nautoincone_ph = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_cone_ph    = '0';
                            $nautoincone_ph = $dtdetail_row->cone_ph;
                        }
                    } else {
                        $ndt_cone_ph    = '0';
                        $nautoincone_ph = $dtdetail_row->cone_ph;
                    }
                }
                $adt_cone_ph[]    = $ndt_cone_ph;
                $autoincone_ph[] = $nautoincone_ph;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_cone_colour);
                    unset($nautoincone_colour);
                    if ($cek_dtspek_frommst->parameter == 'cone_colour') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->cone_colour) && $dtdetail_row->cone_colour > $cek_dtspek_frommst->spec_max) {
                            $ndt_cone_colour    = '1';
                            $nautoincone_colour = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->cone_colour) && $dtdetail_row->cone_colour < $cek_dtspek_frommst->spec_min) {
                            $ndt_cone_colour    = '2';
                            $nautoincone_colour = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_cone_colour    = '0';
                            $nautoincone_colour = $dtdetail_row->cone_colour;
                        }
                    } else {
                        $ndt_cone_colour    = '0';
                        $nautoincone_colour = $dtdetail_row->cone_colour;
                    }
                }
                $adt_cone_colour[]    = $ndt_cone_colour;
                $autoincone_colour[] = $nautoincone_colour;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_cone_tds);
                    unset($nautoincone_tds);
                    if ($cek_dtspek_frommst->parameter == 'cone_tds') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->cone_tds) && $dtdetail_row->cone_tds > $cek_dtspek_frommst->spec_max) {
                            $ndt_cone_tds    = '1';
                            $nautoincone_tds = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->cone_tds) && $dtdetail_row->cone_tds < $cek_dtspek_frommst->spec_min) {
                            $ndt_cone_tds    = '2';
                            $nautoincone_tds = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_cone_tds    = '0';
                            $nautoincone_tds = $dtdetail_row->cone_tds;
                        }
                    } else {
                        $ndt_cone_tds    = '0';
                        $nautoincone_tds = $dtdetail_row->cone_tds;
                    }
                }
                $adt_cone_tds[]    = $ndt_cone_tds;
                $autoincone_tds[] = $nautoincone_tds;
            }

            for ($j = 1; $j <= 7; $j++) {
                if (isset($dtspek_frommst)) {
                    foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                        unset($ndt_tsf_colour);
                        unset($nautointsf_colour);
                        if ($cek_dtspek_frommst->parameter == 'tsf_colour') {
                            if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->{'tsf_colour_sf' . $j}) && $dtdetail_row->{'tsf_colour_sf' . $j} > $cek_dtspek_frommst->spec_max) {
                                $ndt_tsf_colour    = '1';
                                $nautointsf_colour = $cek_dtspek_frommst->spec_max;
                                break;
                            } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->{'tsf_colour_sf' . $j}) && $dtdetail_row->{'tsf_colour_sf' . $j} < $cek_dtspek_frommst->spec_min) {
                                $ndt_tsf_colour    = '2';
                                $nautointsf_colour = $cek_dtspek_frommst->spec_min;
                                break;
                            } else {
                                $ndt_tsf_colour    = '0';
                                $nautointsf_colour = $dtdetail_row->{'tsf_colour_sf' . $j};
                            }
                        } else {
                            $ndt_tsf_colour    = '0';
                            $nautointsf_colour = $dtdetail_row->{'tsf_colour_sf' . $j};
                        }
                    }
                    ${'adt_tsf_colour_sf' . $j}[]    = $ndt_tsf_colour;
                    $autointsf_colour[] = $nautointsf_colour;
                }
            }
            for ($j = 1; $j <= 7; $j++) {
                if (isset($dtspek_frommst)) {
                    foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                        unset($ndt_tsf_turbidity);
                        unset($nautointsf_turbidity);
                        if ($cek_dtspek_frommst->parameter == 'tsf_turbidity') {
                            if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->{'tsf_turbidity_sf' . $j}) && $dtdetail_row->{'tsf_turbidity_sf' . $j} > $cek_dtspek_frommst->spec_max) {
                                $ndt_tsf_turbidity    = '1';
                                $nautointsf_turbidity = $cek_dtspek_frommst->spec_max;
                                break;
                            } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->{'tsf_turbidity_sf' . $j}) && $dtdetail_row->{'tsf_turbidity_sf' . $j} < $cek_dtspek_frommst->spec_min) {
                                $ndt_tsf_turbidity    = '2';
                                $nautointsf_turbidity = $cek_dtspek_frommst->spec_min;
                                break;
                            } else {
                                $ndt_tsf_turbidity    = '0';
                                $nautointsf_turbidity = $dtdetail_row->{'tsf_turbidity_sf' . $j};
                            }
                        } else {
                            $ndt_tsf_turbidity    = '0';
                            $nautointsf_turbidity = $dtdetail_row->{'tsf_turbidity_sf' . $j};
                        }
                    }
                    ${'adt_tsf_turbidity_sf' . $j}[]    = $ndt_tsf_turbidity;
                    $autointsf_turbidity[] = $nautointsf_turbidity;
                }
            }
            for ($j = 1; $j <= 6; $j++) {
                if (isset($dtspek_frommst)) {
                    foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                        unset($ndt_tcf_colour);
                        unset($nautointcf_colour);
                        if ($cek_dtspek_frommst->parameter == 'tcf_colour') {
                            if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->{'tcf_colour_cf' . $j}) && $dtdetail_row->{'tcf_colour_cf' . $j} > $cek_dtspek_frommst->spec_max) {
                                $ndt_tcf_colour    = '1';
                                $nautointcf_colour = $cek_dtspek_frommst->spec_max;
                                break;
                            } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->{'tcf_colour_cf' . $j}) && $dtdetail_row->{'tcf_colour_cf' . $j} < $cek_dtspek_frommst->spec_min) {
                                $ndt_tcf_colour    = '2';
                                $nautointcf_colour = $cek_dtspek_frommst->spec_min;
                                break;
                            } else {
                                $ndt_tcf_colour    = '0';
                                $nautointcf_colour = $dtdetail_row->{'tcf_colour_cf' . $j};
                            }
                        } else {
                            $ndt_tcf_colour    = '0';
                            $nautointcf_colour = $dtdetail_row->{'tcf_colour_cf' . $j};
                        }
                    }
                    ${'adt_tcf_colour_cf' . $j}[]    = $ndt_tcf_colour;
                    $autointcf_colour[] = $nautointcf_colour;
                }
            }
            for ($j = 1; $j <= 6; $j++) {
                if (isset($dtspek_frommst)) {
                    foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                        unset($ndt_tcf_turbidity);
                        unset($nautointcf_turbidity);
                        if ($cek_dtspek_frommst->parameter == 'tcf_turbidity') {
                            if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->{'tcf_turbidity_cf' . $j}) && $dtdetail_row->{'tcf_turbidity_cf' . $j} > $cek_dtspek_frommst->spec_max) {
                                $ndt_tcf_turbidity    = '1';
                                $nautointcf_turbidity = $cek_dtspek_frommst->spec_max;
                                break;
                            } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->{'tcf_turbidity_cf' . $j}) && $dtdetail_row->{'tcf_turbidity_cf' . $j} < $cek_dtspek_frommst->spec_min) {
                                $ndt_tcf_turbidity    = '2';
                                $nautointcf_turbidity = $cek_dtspek_frommst->spec_min;
                                break;
                            } else {
                                $ndt_tcf_turbidity    = '0';
                                $nautointcf_turbidity = $dtdetail_row->{'tcf_turbidity_cf' . $j};
                            }
                        } else {
                            $ndt_tcf_turbidity    = '0';
                            $nautointcf_turbidity = $dtdetail_row->{'tcf_turbidity_cf' . $j};
                        }
                    }
                    ${'adt_tcf_turbidity_cf' . $j}[]    = $ndt_tcf_turbidity;
                    $autointcf_turbidity[] = $nautointcf_turbidity;
                }
            }
            for ($j = 1; $j <= 5; $j++) {
                if (isset($dtspek_frommst)) {
                    foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                        unset($ndt_ts_th_st);
                        unset($nautoints_th_st);
                        if ($cek_dtspek_frommst->parameter == 'ts_hardness') {
                            if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->{'ts_th_st' . $j}) && $dtdetail_row->{'ts_th_st' . $j} > $cek_dtspek_frommst->spec_max) {
                                $ndt_ts_th_st    = '1';
                                $nautoints_th_st = $cek_dtspek_frommst->spec_max;
                                break;
                            } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->{'ts_th_st' . $j}) && $dtdetail_row->{'ts_th_st' . $j} < $cek_dtspek_frommst->spec_min) {
                                $ndt_ts_th_st    = '2';
                                $nautoints_th_st = $cek_dtspek_frommst->spec_min;
                                break;
                            } else {
                                $ndt_ts_th_st    = '0';
                                $nautoints_th_st = $dtdetail_row->{'ts_th_st' . $j};
                            }
                        } else {
                            $ndt_ts_th_st    = '0';
                            $nautoints_th_st = $dtdetail_row->{'ts_th_st' . $j};
                        }
                    }
                    ${'adt_ts_th_st' . $j}[]    = $ndt_ts_th_st;
                    $autoints_th_st[] = $nautoints_th_st;
                }
            }

            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_bak_demin_ph);
                    unset($nautoinbak_demin_ph);
                    if ($cek_dtspek_frommst->parameter == 'bak_demin_ph') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak_demin_ph) && $dtdetail_row->bak_demin_ph > $cek_dtspek_frommst->spec_max) {
                            $ndt_bak_demin_ph    = '1';
                            $nautoinbak_demin_ph = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak_demin_ph) && $dtdetail_row->bak_demin_ph < $cek_dtspek_frommst->spec_min) {
                            $ndt_bak_demin_ph    = '2';
                            $nautoinbak_demin_ph = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_bak_demin_ph    = '0';
                            $nautoinbak_demin_ph = $dtdetail_row->bak_demin_ph;
                        }
                    } else {
                        $ndt_bak_demin_ph    = '0';
                        $nautoinbak_demin_ph = $dtdetail_row->bak_demin_ph;
                    }
                }
                $adt_bak_demin_ph[]    = $ndt_bak_demin_ph;
                $autoinbak_demin_ph[] = $nautoinbak_demin_ph;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_bak_demin_colour);
                    unset($nautoinbak_demin_colour);
                    if ($cek_dtspek_frommst->parameter == 'bak_demin_colour') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak_demin_colour) && $dtdetail_row->bak_demin_colour > $cek_dtspek_frommst->spec_max) {
                            $ndt_bak_demin_colour    = '1';
                            $nautoinbak_demin_colour = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak_demin_colour) && $dtdetail_row->bak_demin_colour < $cek_dtspek_frommst->spec_min) {
                            $ndt_bak_demin_colour    = '2';
                            $nautoinbak_demin_colour = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_bak_demin_colour    = '0';
                            $nautoinbak_demin_colour = $dtdetail_row->bak_demin_colour;
                        }
                    } else {
                        $ndt_bak_demin_colour    = '0';
                        $nautoinbak_demin_colour = $dtdetail_row->bak_demin_colour;
                    }
                }
                $adt_bak_demin_colour[]    = $ndt_bak_demin_colour;
                $autoinbak_demin_colour[] = $nautoinbak_demin_colour;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_bak_demin_tbd);
                    unset($nautoinbak_demin_tbd);
                    if ($cek_dtspek_frommst->parameter == 'bak_demin_tbd') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak_demin_tbd) && $dtdetail_row->bak_demin_tbd > $cek_dtspek_frommst->spec_max) {
                            $ndt_bak_demin_tbd    = '1';
                            $nautoinbak_demin_tbd = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak_demin_tbd) && $dtdetail_row->bak_demin_tbd < $cek_dtspek_frommst->spec_min) {
                            $ndt_bak_demin_tbd    = '2';
                            $nautoinbak_demin_tbd = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_bak_demin_tbd    = '0';
                            $nautoinbak_demin_tbd = $dtdetail_row->bak_demin_tbd;
                        }
                    } else {
                        $ndt_bak_demin_tbd    = '0';
                        $nautoinbak_demin_tbd = $dtdetail_row->bak_demin_tbd;
                    }
                }
                $adt_bak_demin_tbd[]    = $ndt_bak_demin_tbd;
                $autoinbak_demin_tbd[] = $nautoinbak_demin_tbd;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_bak2_ph);
                    unset($nautoinbak2_ph);
                    if ($cek_dtspek_frommst->parameter == 'bak2_ph') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak2_ph) && $dtdetail_row->bak2_ph > $cek_dtspek_frommst->spec_max) {
                            $ndt_bak2_ph    = '1';
                            $nautoinbak2_ph = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak2_ph) && $dtdetail_row->bak2_ph < $cek_dtspek_frommst->spec_min) {
                            $ndt_bak2_ph    = '2';
                            $nautoinbak2_ph = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_bak2_ph    = '0';
                            $nautoinbak2_ph = $dtdetail_row->bak2_ph;
                        }
                    } else {
                        $ndt_bak2_ph    = '0';
                        $nautoinbak2_ph = $dtdetail_row->bak2_ph;
                    }
                }
                $adt_bak2_ph[]    = $ndt_bak2_ph;
                $autoinbak2_ph[] = $nautoinbak2_ph;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_bak2_colour);
                    unset($nautoinbak2_colour);
                    if ($cek_dtspek_frommst->parameter == 'bak2_colour') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak2_colour) && $dtdetail_row->bak2_colour > $cek_dtspek_frommst->spec_max) {
                            $ndt_bak2_colour    = '1';
                            $nautoinbak2_colour = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak2_colour) && $dtdetail_row->bak2_colour < $cek_dtspek_frommst->spec_min) {
                            $ndt_bak2_colour    = '2';
                            $nautoinbak2_colour = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_bak2_colour    = '0';
                            $nautoinbak2_colour = $dtdetail_row->bak2_colour;
                        }
                    } else {
                        $ndt_bak2_colour    = '0';
                        $nautoinbak2_colour = $dtdetail_row->bak2_colour;
                    }
                }
                $adt_bak2_colour[]    = $ndt_bak2_colour;
                $autoinbak2_colour[] = $nautoinbak2_colour;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_bak2_tbd);
                    unset($nautoinbak2_tbd);
                    if ($cek_dtspek_frommst->parameter == 'bak2_tbd') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak2_tbd) && $dtdetail_row->bak2_tbd > $cek_dtspek_frommst->spec_max) {
                            $ndt_bak2_tbd    = '1';
                            $nautoinbak2_tbd = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak2_tbd) && $dtdetail_row->bak2_tbd < $cek_dtspek_frommst->spec_min) {
                            $ndt_bak2_tbd    = '2';
                            $nautoinbak2_tbd = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_bak2_tbd    = '0';
                            $nautoinbak2_tbd = $dtdetail_row->bak2_tbd;
                        }
                    } else {
                        $ndt_bak2_tbd    = '0';
                        $nautoinbak2_tbd = $dtdetail_row->bak2_tbd;
                    }
                }
                $adt_bak2_tbd[]    = $ndt_bak2_tbd;
                $autoinbak2_tbd[] = $nautoinbak2_tbd;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_bak3_ph);
                    unset($nautoinbak3_ph);
                    if ($cek_dtspek_frommst->parameter == 'bak3_ph') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak3_ph) && $dtdetail_row->bak3_ph > $cek_dtspek_frommst->spec_max) {
                            $ndt_bak3_ph    = '1';
                            $nautoinbak3_ph = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak3_ph) && $dtdetail_row->bak3_ph < $cek_dtspek_frommst->spec_min) {
                            $ndt_bak3_ph    = '2';
                            $nautoinbak3_ph = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_bak3_ph    = '0';
                            $nautoinbak3_ph = $dtdetail_row->bak3_ph;
                        }
                    } else {
                        $ndt_bak3_ph    = '0';
                        $nautoinbak3_ph = $dtdetail_row->bak3_ph;
                    }
                }
                $adt_bak3_ph[]    = $ndt_bak3_ph;
                $autoinbak3_ph[] = $nautoinbak3_ph;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_bak3_colour);
                    unset($nautoinbak3_colour);
                    if ($cek_dtspek_frommst->parameter == 'bak3_colour') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak3_colour) && $dtdetail_row->bak3_colour > $cek_dtspek_frommst->spec_max) {
                            $ndt_bak3_colour    = '1';
                            $nautoinbak3_colour = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak3_colour) && $dtdetail_row->bak3_colour < $cek_dtspek_frommst->spec_min) {
                            $ndt_bak3_colour    = '2';
                            $nautoinbak3_colour = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_bak3_colour    = '0';
                            $nautoinbak3_colour = $dtdetail_row->bak3_colour;
                        }
                    } else {
                        $ndt_bak3_colour    = '0';
                        $nautoinbak3_colour = $dtdetail_row->bak3_colour;
                    }
                }
                $adt_bak3_colour[]    = $ndt_bak3_colour;
                $autoinbak3_colour[] = $nautoinbak3_colour;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_bak3_tbd);
                    unset($nautoinbak3_tbd);
                    if ($cek_dtspek_frommst->parameter == 'bak3_tbd') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak3_tbd) && $dtdetail_row->bak3_tbd > $cek_dtspek_frommst->spec_max) {
                            $ndt_bak3_tbd    = '1';
                            $nautoinbak3_tbd = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak3_tbd) && $dtdetail_row->bak3_tbd < $cek_dtspek_frommst->spec_min) {
                            $ndt_bak3_tbd    = '2';
                            $nautoinbak3_tbd = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_bak3_tbd    = '0';
                            $nautoinbak3_tbd = $dtdetail_row->bak3_tbd;
                        }
                    } else {
                        $ndt_bak3_tbd    = '0';
                        $nautoinbak3_tbd = $dtdetail_row->bak3_tbd;
                    }
                }
                $adt_bak3_tbd[]    = $ndt_bak3_tbd;
                $autoinbak3_tbd[] = $nautoinbak3_tbd;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_bak4_ph);
                    unset($nautoinbak4_ph);
                    if ($cek_dtspek_frommst->parameter == 'bak4_ph') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak4_ph) && $dtdetail_row->bak4_ph > $cek_dtspek_frommst->spec_max) {
                            $ndt_bak4_ph    = '1';
                            $nautoinbak4_ph = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak4_ph) && $dtdetail_row->bak4_ph < $cek_dtspek_frommst->spec_min) {
                            $ndt_bak4_ph    = '2';
                            $nautoinbak4_ph = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_bak4_ph    = '0';
                            $nautoinbak4_ph = $dtdetail_row->bak4_ph;
                        }
                    } else {
                        $ndt_bak4_ph    = '0';
                        $nautoinbak4_ph = $dtdetail_row->bak4_ph;
                    }
                }
                $adt_bak4_ph[]    = $ndt_bak4_ph;
                $autoinbak4_ph[] = $nautoinbak4_ph;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_bak4_colour);
                    unset($nautoinbak4_colour);
                    if ($cek_dtspek_frommst->parameter == 'bak4_colour') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak4_colour) && $dtdetail_row->bak4_colour > $cek_dtspek_frommst->spec_max) {
                            $ndt_bak4_colour    = '1';
                            $nautoinbak4_colour = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak4_colour) && $dtdetail_row->bak4_colour < $cek_dtspek_frommst->spec_min) {
                            $ndt_bak4_colour    = '2';
                            $nautoinbak4_colour = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_bak4_colour    = '0';
                            $nautoinbak4_colour = $dtdetail_row->bak4_colour;
                        }
                    } else {
                        $ndt_bak4_colour    = '0';
                        $nautoinbak4_colour = $dtdetail_row->bak4_colour;
                    }
                }
                $adt_bak4_colour[]    = $ndt_bak4_colour;
                $autoinbak4_colour[] = $nautoinbak4_colour;
            }
            if (isset($dtspek_frommst)) {
                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                    unset($ndt_bak4_tbd);
                    unset($nautoinbak4_tbd);
                    if ($cek_dtspek_frommst->parameter == 'bak4_tbd') {
                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak4_tbd) && $dtdetail_row->bak4_tbd > $cek_dtspek_frommst->spec_max) {
                            $ndt_bak4_tbd    = '1';
                            $nautoinbak4_tbd = $cek_dtspek_frommst->spec_max;
                            break;
                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak4_tbd) && $dtdetail_row->bak4_tbd < $cek_dtspek_frommst->spec_min) {
                            $ndt_bak4_tbd    = '2';
                            $nautoinbak4_tbd = $cek_dtspek_frommst->spec_min;
                            break;
                        } else {
                            $ndt_bak4_tbd    = '0';
                            $nautoinbak4_tbd = $dtdetail_row->bak4_tbd;
                        }
                    } else {
                        $ndt_bak4_tbd    = '0';
                        $nautoinbak4_tbd = $dtdetail_row->bak4_tbd;
                    }
                }
                $adt_bak4_tbd[]    = $ndt_bak4_tbd;
                $autoinbak4_tbd[] = $nautoinbak4_tbd;
            }
        }

        //detail b
        $no = 1;
        foreach ($dtdetail_b as $dtdetail_b_row) {
            $nomor[]                      = $no++;
            $dtl_b_jam[]                  = trim($dtdetail_b_row->jam);
            $dtl_b_uraian[]               = trim($dtdetail_b_row->uraian);
            $dtl_b_tindakan[]             = trim($dtdetail_b_row->tindakan);
            $dtl_b_keterangan[]           = trim($dtdetail_b_row->keterangan);
        }


        // style
        $PTStyle                   = new PHPExcel_Style();
        $headerStyle               = new PHPExcel_Style();
        $headerStyleLeft           = new PHPExcel_Style();
        $headerStyleLeftTop        = new PHPExcel_Style();
        $headerStyleRightTop       = new PHPExcel_Style();
        $headerStyleLeftBottomTop  = new PHPExcel_Style();
        $headerStyleRightBottomTop = new PHPExcel_Style();
        $DetailheaderStyle         = new PHPExcel_Style();
        $bodyStyle                 = new PHPExcel_Style();
        $bodyStyleAlignLeft        = new PHPExcel_Style();
        $bodyStyleAlignLeftTop        = new PHPExcel_Style();
        $noborderStyle             = new PHPExcel_Style();
        $bodyStyleLeft             = new PHPExcel_Style();
        $bodyStyleRight            = new PHPExcel_Style();
        $footerStyleLeftbottom     = new PHPExcel_Style();
        $footerStyleRightbottom    = new PHPExcel_Style();

        $PTStyle->applyFromArray($this->xls->PT_STYLE);
        $headerStyle->applyFromArray($this->xls->headerStyle);
        $headerStyleLeftTop->applyFromArray($this->xls->headerStyleLeftTop);
        $headerStyleRightTop->applyFromArray($this->xls->headerStyleRightTop);
        $headerStyleLeftBottomTop->applyFromArray($this->xls->headerStyleLeftBottomTop);
        $headerStyleRightBottomTop->applyFromArray($this->xls->headerStyleRightBottomTop);
        $DetailheaderStyle->applyFromArray($this->xls->DetailheaderStyle);
        $bodyStyle->applyFromArray($this->xls->bodyStyle);
        $bodyStyleAlignLeft->applyFromArray($this->xls->bodyStyleAlignLeft);
        $bodyStyleAlignLeftTop->applyFromArray($this->xls->bodyStyleAlignLeftTop);
        $noborderStyle->applyFromArray($this->xls->noborderStyle);
        $bodyStyleLeft->applyFromArray($this->xls->bodyStyleLeft);
        $bodyStyleRight->applyFromArray($this->xls->bodyStyleRight);
        $footerStyleLeftbottom->applyFromArray($this->xls->footerStyleLeftbottom);
        $footerStyleRightbottom->applyFromArray($this->xls->footerStyleRightbottom);
        // end style

        $obj = new Excel();

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('assets/images/PSG_logo_2022.png');
        $objPHPExcel = $obj->createSheet(0);

        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getPageSetup()->setFitToPage(false);
        $objPHPExcel->getPageSetup()->setScale(28);
        $objPHPExcel->getPageMargins()->setLeft(0.1);
        $objPHPExcel->getPageMargins()->setRight(0.1);
        $objPHPExcel->getPageMargins()->setBottom(0.1);
        $objPHPExcel->getPageMargins()->setTop(0.1);
        $objPHPExcel->getPageSetup()->setVerticalCentered(true);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);

        $count1 = count($dtdetail);
        $jml_data_perpage = $count1;
        if ($count1 < $jml_data_perpage) {
            $jml_page_a = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page_a = $count1 / $jml_data_perpage;
            } else {
                $jml_page_a = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }

        $count2 = count($dtdetail_b);
        $jml_data_perpage_b = 15;
        if ($count2 < $jml_data_perpage_b) {
            $jml_page_b = 1;
        } else {
            if (($count2 % $jml_data_perpage_b) == 0) {
                $jml_page_b = $count2 / $jml_data_perpage_b;
            } else {
                $jml_page_b = floor(($count2 / $jml_data_perpage_b)) + 1;
            }
        }

        // $jml_row_perpage  = $jml_data_perpage + 6;
        $jml_row_perpage  = $jml_data_perpage + 33;

        $jml_page   = max($jml_page_a, $jml_page_b);

        $range = array();
        $rangeCol = "BE";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(9);
        }

        for ($rowHeight = 0; $rowHeight < ($jml_row_perpage * $jml_page); $rowHeight++) {
            $objPHPExcel->getRowDimension($rowHeight)->setRowHeight(15);
        }


        $jumlahdata = 0;
        for ($i1 = 0; $i1 < $jml_page; $i1++) {

            $sf1    = ["N", "O", "P", "Q", "R", "S", "T"];
            $sf2    = ["U", "V", "W", "X", "Y", "Z", "AA"];
            $cf1    = ["AB", "AC", "AD", "AE", "AF", "AG"];
            $cf2    = ["AH", "AI", "AJ", "AK", "AL", "AM"];
            $th     = ["AN", "AO", "AP", "AQ", "AR"];
            $ph     = ["AS", "AV", "AY", "BB"];
            $colour = ["AT", "AW", "AZ", "BC"];
            $tbd    = ["AU", "AX", "BA", "BD"];


            $start_row        = ($i1 * $jml_row_perpage) + 1;
            $finish_row       = ((($i1 * $jml_row_perpage) + 1) + ($jml_row_perpage));

            $start_detail     = ($i1 * $jml_data_perpage);
            $finish_detail    = (($i1 * $jml_data_perpage) + ($jml_data_perpage - 1));

            $start_detail_b   = ($i1 * $jml_data_perpage_b);
            $finish_detail_b  = (($i1 * $jml_data_perpage_b) + ($jml_data_perpage_b - 1));

            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/PSG_logo_2022.png');
            $gbr->setWidthAndHeight(45, 45);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('B' . $start_row);

            $objPHPExcel->getColumnDimension("A")->setWidth(3);
            $objPHPExcel->getColumnDimension("B")->setWidth(4);
            $objPHPExcel->getColumnDimension("C")->setWidth(4);
            $objPHPExcel->getColumnDimension("D")->setWidth(4);
            $objPHPExcel->getRowDimension($start_row + 7)->setRowHeight(29);

            $objPHPExcel->getRowDimension($start_row)->setRowHeight(15);
            $objPHPExcel->getRowDimension($start_row + 1)->setRowHeight(15);
            $objPHPExcel->getRowDimension($start_row + 2)->setRowHeight(15);
            $objPHPExcel->getRowDimension($start_row + 3)->setRowHeight(15);
            $objPHPExcel->mergeCells('A' . $start_row . ':D' . ($start_row + 1));
            $objPHPExcel->mergeCells('E' . $start_row . ':AX' . ($start_row + 1))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AY' . $start_row . ':AY' . $start_row)->setCellValue('AY' . $start_row, 'Doc');
            $objPHPExcel->mergeCells('AZ' . $start_row . ':BE' . $start_row)->setCellValue('AZ' . $start_row, ': ' . $docno);
            $objPHPExcel->mergeCells('AY' . ($start_row + 1) . ':AY' . ($start_row + 1))->setCellValue('AY' . ($start_row + 1), 'Date');
            $objPHPExcel->mergeCells('AZ' . ($start_row + 1) . ':BE' . ($start_row + 1))->setCellValue('AZ' . ($start_row + 1), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' . ($start_row + 2) . ':D' . ($start_row + 2))->setCellValue('A' . ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' . ($start_row + 2) . ':AX' . ($start_row + 2))->setCellValue('E' . ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AY' . ($start_row + 2) . ':AY' . ($start_row + 2))->setCellValue('AY' . ($start_row + 2), 'Page');
            $objPHPExcel->mergeCells('AZ' . ($start_row + 2) . ':BE' . ($start_row + 2))->setCellValue('AZ' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page);

            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 2) . ':BE' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':BE' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle, 'A' . ($start_row) . ':AX' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleLeftTop, 'AY' . ($start_row) . ':BE' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AZ' . $start_row . ':BE' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AY' . ($start_row + 2) . ':BE' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AZ' . ($start_row + 2) . ':BE' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':AX' . ($start_row + 2));
            $objPHPExcel->getStyle('AZ' . ($start_row) . ':BE' . ($start_row))->getFont()->setSize(10);

            // detail

            $objPHPExcel->mergeCells('B' . ($start_row + 4) . ':B' . ($start_row + 6))->setCellValue('B' . ($start_row + 4), 'No');
            $objPHPExcel->mergeCells('C' . ($start_row + 4) . ':D' . ($start_row + 6))->setCellValue('C' . ($start_row + 4), 'Jam');
            $objPHPExcel->mergeCells('E' . ($start_row + 4) . ':J' . ($start_row + 4))->setCellValue('E' . ($start_row + 4), 'Sedimen');
            $objPHPExcel->mergeCells('K' . ($start_row + 4) . ':M' . ($start_row + 4))->setCellValue('K' . ($start_row + 4), 'Cone Clarifier');
            $objPHPExcel->mergeCells('N' . ($start_row + 4) . ':AA' . ($start_row + 4))->setCellValue('N' . ($start_row + 4), 'TANGKI SAND FILTER');
            $objPHPExcel->mergeCells('AB' . ($start_row + 4) . ':AM' . ($start_row + 4))->setCellValue('AB' . ($start_row + 4), 'TANGKI CARBON FILTER');
            $objPHPExcel->mergeCells('AN' . ($start_row + 4) . ':AR' . ($start_row + 4))->setCellValue('AN' . ($start_row + 4), 'TANGKI SOFTENER');
            $objPHPExcel->mergeCells('AS' . ($start_row + 4) . ':AU' . ($start_row + 4))->setCellValue('AS' . ($start_row + 4), 'BAK DEMIN');
            $objPHPExcel->mergeCells('AV' . ($start_row + 4) . ':AX' . ($start_row + 4))->setCellValue('AV' . ($start_row + 4), 'BAK 2');
            $objPHPExcel->mergeCells('AY' . ($start_row + 4) . ':BA' . ($start_row + 4))->setCellValue('AY' . ($start_row + 4), 'BAK 3');
            $objPHPExcel->mergeCells('BB' . ($start_row + 4) . ':BD' . ($start_row + 4))->setCellValue('BB' . ($start_row + 4), 'BAK 4');

            $objPHPExcel->mergeCells('E' . ($start_row + 5) . ':F' . ($start_row + 5))->setCellValue('E' . ($start_row + 5), 'PH');
            $objPHPExcel->mergeCells('G' . ($start_row + 5) . ':H' . ($start_row + 5))->setCellValue('G' . ($start_row + 5), 'COLOUR');
            $objPHPExcel->mergeCells('I' . ($start_row + 5) . ':J' . ($start_row + 5))->setCellValue('I' . ($start_row + 5), 'TDS');
            $objPHPExcel->mergeCells('K' . ($start_row + 5) . ':K' . ($start_row + 6))->setCellValue('K' . ($start_row + 5), 'PH');
            $objPHPExcel->mergeCells('L' . ($start_row + 5) . ':L' . ($start_row + 6))->setCellValue('L' . ($start_row + 5), 'COLOUR');
            $objPHPExcel->mergeCells('M' . ($start_row + 5) . ':M' . ($start_row + 6))->setCellValue('M' . ($start_row + 5), 'TDS');
            $objPHPExcel->mergeCells('N' . ($start_row + 5) . ':T' . ($start_row + 5))->setCellValue('N' . ($start_row + 5), 'COLOUR');
            $objPHPExcel->mergeCells('U' . ($start_row + 5) . ':AA' . ($start_row + 5))->setCellValue('U' . ($start_row + 5), 'TURBIDITY');
            $objPHPExcel->mergeCells('AB' . ($start_row + 5) . ':AG' . ($start_row + 5))->setCellValue('AB' . ($start_row + 5), 'COLOUR');
            $objPHPExcel->mergeCells('AH' . ($start_row + 5) . ':AM' . ($start_row + 5))->setCellValue('AH' . ($start_row + 5), 'TURBIDITY');
            $objPHPExcel->mergeCells('AN' . ($start_row + 5) . ':AR' . ($start_row + 5))->setCellValue('AN' . ($start_row + 5), 'TOTAL HARDNESS');
            $objPHPExcel->mergeCells('AS' . ($start_row + 5) . ':AS' . ($start_row + 6))->setCellValue('AS' . ($start_row + 5), 'PH');
            $objPHPExcel->mergeCells('AT' . ($start_row + 5) . ':AT' . ($start_row + 6))->setCellValue('AT' . ($start_row + 5), 'COLOUR');
            $objPHPExcel->mergeCells('AU' . ($start_row + 5) . ':AU' . ($start_row + 6))->setCellValue('AU' . ($start_row + 5), 'TBD');
            $objPHPExcel->mergeCells('AV' . ($start_row + 5) . ':AV' . ($start_row + 6))->setCellValue('AV' . ($start_row + 5), 'PH');
            $objPHPExcel->mergeCells('AW' . ($start_row + 5) . ':AW' . ($start_row + 6))->setCellValue('AW' . ($start_row + 5), 'COLOUR');
            $objPHPExcel->mergeCells('AX' . ($start_row + 5) . ':AX' . ($start_row + 6))->setCellValue('AX' . ($start_row + 5), 'TBD');
            $objPHPExcel->mergeCells('AY' . ($start_row + 5) . ':AY' . ($start_row + 6))->setCellValue('AY' . ($start_row + 5), 'PH');
            $objPHPExcel->mergeCells('AZ' . ($start_row + 5) . ':AZ' . ($start_row + 6))->setCellValue('AZ' . ($start_row + 5), 'COLOUR');
            $objPHPExcel->mergeCells('BA' . ($start_row + 5) . ':BA' . ($start_row + 6))->setCellValue('BA' . ($start_row + 5), 'TBD');
            $objPHPExcel->mergeCells('BB' . ($start_row + 5) . ':BB' . ($start_row + 6))->setCellValue('BB' . ($start_row + 5), 'PH');
            $objPHPExcel->mergeCells('BC' . ($start_row + 5) . ':BC' . ($start_row + 6))->setCellValue('BC' . ($start_row + 5), 'COLOUR');
            $objPHPExcel->mergeCells('BD' . ($start_row + 5) . ':BD' . ($start_row + 6))->setCellValue('BD' . ($start_row + 5), 'TBD');

            $objPHPExcel->mergeCells('E' . ($start_row + 6) . ':E' . ($start_row + 6))->setCellValue('E' . ($start_row + 6), '6A');
            $objPHPExcel->mergeCells('F' . ($start_row + 6) . ':F' . ($start_row + 6))->setCellValue('F' . ($start_row + 6), '6B');
            $objPHPExcel->mergeCells('G' . ($start_row + 6) . ':G' . ($start_row + 6))->setCellValue('G' . ($start_row + 6), '6A');
            $objPHPExcel->mergeCells('H' . ($start_row + 6) . ':H' . ($start_row + 6))->setCellValue('H' . ($start_row + 6), '6B');
            $objPHPExcel->mergeCells('I' . ($start_row + 6) . ':I' . ($start_row + 6))->setCellValue('I' . ($start_row + 6), '6A');
            $objPHPExcel->mergeCells('J' . ($start_row + 6) . ':J' . ($start_row + 6))->setCellValue('J' . ($start_row + 6), '6B');
            for ($k = 1; $k <= 7; $k++) {
                $objPHPExcel->mergeCells($sf1[$k - 1] . ($start_row + 6) . ':' . $sf1[$k - 1] . ($start_row + 6))->setCellValue($sf1[$k - 1] . ($start_row + 6), ('SF' . $k));
                $objPHPExcel->mergeCells($sf2[$k - 1] . ($start_row + 6) . ':' . $sf2[$k - 1] . ($start_row + 6))->setCellValue($sf2[$k - 1] . ($start_row + 6), ('SF' . $k));
                $objPHPExcel->mergeCells($sf1[$k - 1] . ($start_row + 7) . ':' . $sf1[$k - 1] . ($start_row + 7))->setCellValue($sf1[$k - 1] . ($start_row + 7), '50');
                $objPHPExcel->mergeCells($sf2[$k - 1] . ($start_row + 7) . ':' . $sf2[$k - 1] . ($start_row + 7))->setCellValue($sf2[$k - 1] . ($start_row + 7), '5');
            }
            for ($k = 1; $k <= 6; $k++) {
                $objPHPExcel->mergeCells($cf1[$k - 1] . ($start_row + 6) . ':' . $cf1[$k - 1] . ($start_row + 6))->setCellValue($cf1[$k - 1] . ($start_row + 6), ('CT' . $k));
                $objPHPExcel->mergeCells($cf2[$k - 1] . ($start_row + 6) . ':' . $cf2[$k - 1] . ($start_row + 6))->setCellValue($cf2[$k - 1] . ($start_row + 6), ('CT' . $k));
                $objPHPExcel->mergeCells($cf1[$k - 1] . ($start_row + 7) . ':' . $cf1[$k - 1] . ($start_row + 7))->setCellValue($cf1[$k - 1] . ($start_row + 7), '50');
                $objPHPExcel->mergeCells($cf2[$k - 1] . ($start_row + 7) . ':' . $cf2[$k - 1] . ($start_row + 7))->setCellValue($cf2[$k - 1] . ($start_row + 7), '3');
            }
            for ($k = 1; $k <= 5; $k++) {
                $objPHPExcel->mergeCells($th[$k - 1] . ($start_row + 6) . ':' . $th[$k - 1] . ($start_row + 6))->setCellValue($th[$k - 1] . ($start_row + 6), ('ST' . $k));
                $objPHPExcel->mergeCells($th[$k - 1] . ($start_row + 7) . ':' . $th[$k - 1] . ($start_row + 7))->setCellValue($th[$k - 1] . ($start_row + 7), '20');
            }
            $objPHPExcel->mergeCells('B' . ($start_row + 7) . ':D' . ($start_row + 7))->setCellValue('B' . ($start_row + 7), 'SPECIFICATION');
            $objPHPExcel->mergeCells('E' . ($start_row + 7) . ':F' . ($start_row + 7))->setCellValue('E' . ($start_row + 7), '4.5 - 6.5');
            $objPHPExcel->mergeCells('G' . ($start_row + 7) . ':H' . ($start_row + 7))->setCellValue('G' . ($start_row + 7), '80 - 110');
            $objPHPExcel->mergeCells('I' . ($start_row + 7) . ':J' . ($start_row + 7))->setCellValue('I' . ($start_row + 7), '500 max');
            $objPHPExcel->mergeCells('K' . ($start_row + 7) . ':K' . ($start_row + 7))->setCellValue('K' . ($start_row + 7), '5.0 - 7.0');
            $objPHPExcel->mergeCells('L' . ($start_row + 7) . ':L' . ($start_row + 7))->setCellValue('L' . ($start_row + 7), '80 - 110');
            $objPHPExcel->mergeCells('M' . ($start_row + 7) . ':M' . ($start_row + 7))->setCellValue('M' . ($start_row + 7), '500 max');
            $objPHPExcel->mergeCells('M' . ($start_row + 7) . ':M' . ($start_row + 7))->setCellValue('M' . ($start_row + 7), '500 max');
            for ($k = 1; $k <= 4; $k++) {
                $objPHPExcel->mergeCells($ph[$k - 1] . ($start_row + 7) . ':' . $ph[$k - 1] . ($start_row + 7))->setCellValue($ph[$k - 1] . ($start_row + 7), '6,5-8,5');
                $objPHPExcel->mergeCells($colour[$k - 1] . ($start_row + 7) . ':' . $colour[$k - 1] . ($start_row + 7))->setCellValue($colour[$k - 1] . ($start_row + 7), '50');
                if ($k == 2) {
                    $objPHPExcel->mergeCells($tbd[$k - 1] . ($start_row + 7) . ':' . $tbd[$k - 1] . ($start_row + 7))->setCellValue($tbd[$k - 1] . ($start_row + 7), '5');
                } else {
                    $objPHPExcel->mergeCells($tbd[$k - 1] . ($start_row + 7) . ':' . $tbd[$k - 1] . ($start_row + 7))->setCellValue($tbd[$k - 1] . ($start_row + 7), '3');
                }
            }

            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BE' . ($start_row + 3) . ':BE' . ($start_row + 7));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($start_row + 3) . ':A' . ($start_row + 7));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($start_row + 4) . ':BD' . ($start_row + 7));
            $objPHPExcel->getStyle('B' . ($start_row + 4) . ':AQ' . ($start_row + 7))->getFont()->setBold(true);

            $dtl_row = $start_row + 7;

            $no = 1;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {
                $dtl_row++;
                $jumlahdata++;

                $dt_jam[$a]                 = $jam[$a]  ?? "";
                $dt_sedimen_ph_6a[$a]       = $sedimen_ph_6a[$a]  ?? "";
                $dt_sedimen_ph_6b[$a]       = $sedimen_ph_6b[$a]  ?? "";
                $dt_sedimen_colour_6a[$a]   = $sedimen_colour_6a[$a]  ?? "";
                $dt_sedimen_colour_6b[$a]   = $sedimen_colour_6b[$a]  ?? "";
                $dt_sedimen_tds_6a[$a]      = $sedimen_tds_6a[$a]  ?? "";
                $dt_sedimen_tds_6b[$a]      = $sedimen_tds_6b[$a]  ?? "";
                $dt_cone_ph[$a]             = $cone_ph[$a]  ?? "";
                $dt_cone_colour[$a]         = $cone_colour[$a]  ?? "";
                $dt_cone_tds[$a]            = $cone_tds[$a]  ?? "";
                $dt_bak_demin_ph[$a]        = $bak_demin_ph[$a]  ?? "";
                $dt_bak_demin_colour[$a]    = $bak_demin_colour[$a]  ?? "";
                $dt_bak_demin_tbd[$a]       = $bak_demin_tbd[$a]  ?? "";
                $dt_bak2_ph[$a]             = $bak2_ph[$a]  ?? "";
                $dt_bak2_colour[$a]         = $bak2_colour[$a]  ?? "";
                $dt_bak2_tbd[$a]            = $bak2_tbd[$a]  ?? "";
                $dt_bak3_ph[$a]             = $bak3_ph[$a]  ?? "";
                $dt_bak3_colour[$a]         = $bak3_colour[$a]  ?? "";
                $dt_bak3_tbd[$a]            = $bak3_tbd[$a]  ?? "";
                $dt_bak4_ph[$a]             = $bak4_ph[$a]  ?? "";
                $dt_bak4_colour[$a]         = $bak4_colour[$a]  ?? "";
                $dt_bak4_tbd[$a]            = $bak4_tbd[$a]  ?? "";

                for ($j = 1; $j <= 7; $j++) {
                    ${'vdt_tsf_colour_sf' . $j}[$a]       = ${'adt_tsf_colour_sf' . $j}[$a] ?? "";
                    ${'vdt_tsf_turbidity_sf' . $j}[$a]    = ${'adt_tsf_turbidity_sf' . $j}[$a] ?? "";
                    ${'dt_tsf_colour_sf' . $j}[$a]        = ${'tsf_colour_sf' . $j}[$a] ?? "";
                    ${'dt_tsf_turbidity_sf' . $j}[$a]     = ${'tsf_turbidity_sf' . $j}[$a] ?? "";
                }
                for ($j = 1; $j <= 6; $j++) {
                    ${'vdt_tcf_colour_cf' . $j}[$a]       = ${'adt_tcf_colour_cf' . $j}[$a] ?? "";
                    ${'vdt_tcf_turbidity_cf' . $j}[$a]    = ${'adt_tcf_turbidity_cf' . $j}[$a] ?? "";
                    ${'dt_tcf_colour_cf' . $j}[$a]        = ${'tcf_colour_cf' . $j}[$a] ?? "";
                    ${'dt_tcf_turbidity_cf' . $j}[$a]     = ${'tcf_turbidity_cf' . $j}[$a] ?? "";
                }
                for ($j = 1; $j <= 5; $j++) {
                    ${'vdt_ts_th_st' . $j}[$a]            = ${'adt_ts_th_st' . $j}[$a] ?? "";
                    ${'dt_ts_th_st' . $j}[$a]             = ${'ts_th_st' . $j}[$a] ?? "";
                }


                $vdt_sedimen_ph_6a[$a]     = $adt_sedimen_ph_6a[$a]  ?? "";
                $vdt_sedimen_ph_6b[$a]     = $adt_sedimen_ph_6b[$a]  ?? "";
                $vdt_sedimen_colour_6a[$a] = $adt_sedimen_colour_6a[$a]  ?? "";
                $vdt_sedimen_colour_6b[$a] = $adt_sedimen_colour_6b[$a]  ?? "";
                $vdt_sedimen_tds_6a[$a]    = $adt_sedimen_tds_6a[$a]  ?? "";
                $vdt_sedimen_tds_6b[$a]    = $adt_sedimen_tds_6b[$a]  ?? "";
                $vdt_cone_ph[$a]           = $adt_cone_ph[$a]  ?? "";
                $vdt_cone_colour[$a]       = $adt_cone_colour[$a]  ?? "";
                $vdt_cone_tds[$a]          = $adt_cone_tds[$a]  ?? "";
                $vdt_bak_demin_ph[$a]      = $adt_bak_demin_ph[$a]  ?? "";
                $vdt_bak_demin_colour[$a]  = $adt_bak_demin_colour[$a]  ?? "";
                $vdt_bak_demin_tbd[$a]     = $adt_bak_demin_tbd[$a]  ?? "";
                $vdt_bak2_ph[$a]           = $adt_bak2_ph[$a]  ?? "";
                $vdt_bak2_colour[$a]       = $adt_bak2_colour[$a]  ?? "";
                $vdt_bak2_tbd[$a]          = $adt_bak2_tbd[$a]  ?? "";
                $vdt_bak3_ph[$a]           = $adt_bak3_ph[$a]  ?? "";
                $vdt_bak3_colour[$a]       = $adt_bak3_colour[$a]  ?? "";
                $vdt_bak3_tbd[$a]          = $adt_bak3_tbd[$a]  ?? "";
                $vdt_bak4_ph[$a]           = $adt_bak4_ph[$a]  ?? "";
                $vdt_bak4_colour[$a]       = $adt_bak4_colour[$a]  ?? "";
                $vdt_bak4_tbd[$a]          = $adt_bak4_tbd[$a]  ?? "";

                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $dtl_row . ':BD' . $dtl_row);

                $objPHPExcel->mergeCells('B' . $dtl_row . ':B' . ($dtl_row))->setCellValue('B' . $dtl_row, $no++);
                $objPHPExcel->mergeCells('C' . $dtl_row . ':D' . ($dtl_row))->setCellValue('C' . $dtl_row, $jam[$a]);
                if ($vdt_sedimen_ph_6a[$a] > 0) {
                    $objPHPExcel->getStyle('E' . $dtl_row . ':E' . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getStyle('E' . $dtl_row . ':E' . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                    $objPHPExcel->mergeCells('E' . $dtl_row . ':E' . $dtl_row)->setCellValue('E' . $dtl_row, $dt_sedimen_ph_6a[$a]);
                } else {
                    $objPHPExcel->mergeCells('E' . $dtl_row . ':E' . $dtl_row)->setCellValue('E' . $dtl_row, $dt_sedimen_ph_6a[$a]);
                }
                if ($vdt_sedimen_ph_6b[$a] > 0) {
                    $objPHPExcel->getStyle('F' . $dtl_row . ':F' . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getStyle('F' . $dtl_row . ':F' . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                    $objPHPExcel->mergeCells('F' . $dtl_row . ':F' . $dtl_row)->setCellValue('F' . $dtl_row, $dt_sedimen_ph_6b[$a]);
                } else {
                    $objPHPExcel->mergeCells('F' . $dtl_row . ':F' . $dtl_row)->setCellValue('F' . $dtl_row, $dt_sedimen_ph_6b[$a]);
                }
                if ($vdt_sedimen_colour_6a[$a] > 0) {
                    $objPHPExcel->getStyle('G' . $dtl_row . ':G' . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getStyle('G' . $dtl_row . ':G' . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                    $objPHPExcel->mergeCells('G' . $dtl_row . ':G' . $dtl_row)->setCellValue('G' . $dtl_row, $dt_sedimen_colour_6a[$a]);
                } else {
                    $objPHPExcel->mergeCells('G' . $dtl_row . ':G' . $dtl_row)->setCellValue('G' . $dtl_row, $dt_sedimen_colour_6a[$a]);
                }
                if ($vdt_sedimen_colour_6b[$a] > 0) {
                    $objPHPExcel->getStyle('H' . $dtl_row . ':H' . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getStyle('H' . $dtl_row . ':H' . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                    $objPHPExcel->mergeCells('H' . $dtl_row . ':H' . $dtl_row)->setCellValue('H' . $dtl_row, $dt_sedimen_colour_6b[$a]);
                } else {
                    $objPHPExcel->mergeCells('H' . $dtl_row . ':H' . $dtl_row)->setCellValue('H' . $dtl_row, $dt_sedimen_colour_6b[$a]);
                }
                if ($vdt_sedimen_tds_6a[$a] > 0) {
                    $objPHPExcel->getStyle('I' . $dtl_row . ':I' . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getStyle('I' . $dtl_row . ':I' . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                    $objPHPExcel->mergeCells('I' . $dtl_row . ':I' . $dtl_row)->setCellValue('I' . $dtl_row, $dt_sedimen_tds_6a[$a]);
                } else {
                    $objPHPExcel->mergeCells('I' . $dtl_row . ':I' . $dtl_row)->setCellValue('I' . $dtl_row, $dt_sedimen_tds_6a[$a]);
                }
                if ($vdt_sedimen_tds_6b[$a] > 0) {
                    $objPHPExcel->getStyle('J' . $dtl_row . ':J' . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getStyle('J' . $dtl_row . ':J' . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                    $objPHPExcel->mergeCells('J' . $dtl_row . ':J' . $dtl_row)->setCellValue('J' . $dtl_row, $dt_sedimen_tds_6b[$a]);
                } else {
                    $objPHPExcel->mergeCells('J' . $dtl_row . ':J' . $dtl_row)->setCellValue('J' . $dtl_row, $dt_sedimen_tds_6b[$a]);
                }
                if ($vdt_cone_ph[$a] > 0) {
                    $objPHPExcel->getStyle('K' . $dtl_row . ':K' . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getStyle('K' . $dtl_row . ':K' . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                    $objPHPExcel->mergeCells('K' . $dtl_row . ':K' . $dtl_row)->setCellValue('K' . $dtl_row, $dt_cone_ph[$a]);
                } else {
                    $objPHPExcel->mergeCells('K' . $dtl_row . ':K' . $dtl_row)->setCellValue('K' . $dtl_row, $dt_cone_ph[$a]);
                }
                if ($vdt_cone_colour[$a] > 0) {
                    $objPHPExcel->getStyle('L' . $dtl_row . ':L' . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getStyle('L' . $dtl_row . ':L' . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                    $objPHPExcel->mergeCells('L' . $dtl_row . ':L' . $dtl_row)->setCellValue('L' . $dtl_row, $dt_cone_colour[$a]);
                } else {
                    $objPHPExcel->mergeCells('L' . $dtl_row . ':L' . $dtl_row)->setCellValue('L' . $dtl_row, $dt_cone_colour[$a]);
                }
                if ($vdt_cone_tds[$a] > 0) {
                    $objPHPExcel->getStyle('M' . $dtl_row . ':M' . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getStyle('M' . $dtl_row . ':M' . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                    $objPHPExcel->mergeCells('M' . $dtl_row . ':M' . $dtl_row)->setCellValue('M' . $dtl_row, $dt_cone_tds[$a]);
                } else {
                    $objPHPExcel->mergeCells('M' . $dtl_row . ':M' . $dtl_row)->setCellValue('M' . $dtl_row, $dt_cone_tds[$a]);
                }
                for ($j = 1; $j <= 7; $j++) {
                    if (${'vdt_tsf_colour_sf' . $j}[$a] > 0) {
                        $objPHPExcel->getStyle($sf1[$j - 1] . $dtl_row . ':' . $sf1[$j - 1] . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                        $objPHPExcel->getStyle($sf1[$j - 1] . $dtl_row . ':' . $sf1[$j - 1] . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                        $objPHPExcel->mergeCells($sf1[$j - 1] . ($dtl_row) . ':' . $sf1[$j - 1] . ($dtl_row))->setCellValue($sf1[$j - 1] . ($dtl_row), ${'dt_tsf_colour_sf' . $j}[$a]);
                    } else {
                        $objPHPExcel->mergeCells($sf1[$j - 1] . ($dtl_row) . ':' . $sf1[$j - 1] . ($dtl_row))->setCellValue($sf1[$j - 1] . ($dtl_row), ${'dt_tsf_colour_sf' . $j}[$a]);
                    }
                    if (${'vdt_tsf_turbidity_sf' . $j}[$a] > 0) {
                        $objPHPExcel->getStyle($sf2[$j - 1] . $dtl_row . ':' . $sf2[$j - 1] . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                        $objPHPExcel->getStyle($sf2[$j - 1] . $dtl_row . ':' . $sf2[$j - 1] . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                        $objPHPExcel->mergeCells($sf2[$j - 1] . ($dtl_row) . ':' . $sf2[$j - 1] . ($dtl_row))->setCellValue($sf2[$j - 1] . ($dtl_row), ${'dt_tsf_turbidity_sf' . $j}[$a]);
                    } else {
                        $objPHPExcel->mergeCells($sf2[$j - 1] . ($dtl_row) . ':' . $sf2[$j - 1] . ($dtl_row))->setCellValue($sf2[$j - 1] . ($dtl_row), ${'dt_tsf_turbidity_sf' . $j}[$a]);
                    }
                }
                for ($j = 1; $j <= 6; $j++) {
                    if (${'vdt_tcf_colour_cf' . $j}[$a] > 0) {
                        $objPHPExcel->getStyle($cf1[$j - 1] . $dtl_row . ':' . $cf1[$j - 1] . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                        $objPHPExcel->getStyle($cf1[$j - 1] . $dtl_row . ':' . $cf1[$j - 1] . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                        $objPHPExcel->mergeCells($cf1[$j - 1] . ($dtl_row) . ':' . $cf1[$j - 1] . ($dtl_row))->setCellValue($cf1[$j - 1] . ($dtl_row), ${'dt_tcf_colour_cf' . $j}[$a]);
                    } else {
                        $objPHPExcel->mergeCells($cf1[$j - 1] . ($dtl_row) . ':' . $cf1[$j - 1] . ($dtl_row))->setCellValue($cf1[$j - 1] . ($dtl_row), ${'dt_tcf_colour_cf' . $j}[$a]);
                    }
                    if (${'vdt_tcf_turbidity_cf' . $j}[$a] > 0) {
                        $objPHPExcel->getStyle($cf2[$j - 1] . $dtl_row . ':' . $cf2[$j - 1] . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                        $objPHPExcel->getStyle($cf2[$j - 1] . $dtl_row . ':' . $cf2[$j - 1] . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                        $objPHPExcel->mergeCells($cf2[$j - 1] . ($dtl_row) . ':' . $cf2[$j - 1] . ($dtl_row))->setCellValue($cf2[$j - 1] . ($dtl_row), ${'dt_tcf_turbidity_cf' . $j}[$a]);
                    } else {
                        $objPHPExcel->mergeCells($cf2[$j - 1] . ($dtl_row) . ':' . $cf2[$j - 1] . ($dtl_row))->setCellValue($cf2[$j - 1] . ($dtl_row), ${'dt_tcf_turbidity_cf' . $j}[$a]);
                    }
                }
                for ($j = 1; $j <= 5; $j++) {
                    if (${'vdt_ts_th_st' . $j}[$a] > 0) {
                        $objPHPExcel->getStyle($th[$j - 1] . $dtl_row . ':' . $th[$j - 1] . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                        $objPHPExcel->getStyle($th[$j - 1] . $dtl_row . ':' . $th[$j - 1] . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                        $objPHPExcel->mergeCells($th[$j - 1] . ($dtl_row) . ':' . $th[$j - 1] . ($dtl_row))->setCellValue($th[$j - 1] . ($dtl_row), ${'dt_ts_th_st' . $j}[$a]);
                    } else {
                        $objPHPExcel->mergeCells($th[$j - 1] . ($dtl_row) . ':' . $th[$j - 1] . ($dtl_row))->setCellValue($th[$j - 1] . ($dtl_row), ${'dt_ts_th_st' . $j}[$a]);
                    }
                }
                for ($k = 1; $k <= 4; $k++) {

                    switch ($k) {
                        case $k == 1:
                            $vph[$k]           = $vdt_bak_demin_ph[$a];
                            $vcolour[$k]       = $vdt_bak_demin_colour[$a];
                            $vtbd[$k]          = $vdt_bak_demin_tbd[$a];
                            $dt_ph[$k]        = $dt_bak_demin_ph[$a];
                            $dt_colour[$k]    = $dt_bak_demin_colour[$a];
                            $dt_tbd[$k]       = $dt_bak_demin_tbd[$a];
                            break;
                        case $k == 2:
                            $vph[$k]           = $vdt_bak2_ph[$a];
                            $vcolour[$k]       = $vdt_bak2_colour[$a];
                            $vtbd[$k]          = $vdt_bak2_tbd[$a];
                            $dt_ph[$k]        = $dt_bak2_ph[$a];
                            $dt_colour[$k]    = $dt_bak2_colour[$a];
                            $dt_tbd[$k]       = $dt_bak2_tbd[$a];
                            break;
                        case $k == 3:
                            $vph[$k]           = $vdt_bak3_ph[$a];
                            $vcolour[$k]       = $vdt_bak3_colour[$a];
                            $vtbd[$k]          = $vdt_bak3_tbd[$a];
                            $dt_ph[$k]        = $dt_bak3_ph[$a];
                            $dt_colour[$k]    = $dt_bak3_colour[$a];
                            $dt_tbd[$k]       = $dt_bak3_tbd[$a];
                        default:
                            $vph[$k]           = $vdt_bak4_ph[$a];
                            $vcolour[$k]       = $vdt_bak4_colour[$a];
                            $vtbd[$k]          = $vdt_bak4_tbd[$a];
                            $dt_ph[$k]        = $dt_bak4_ph[$a];
                            $dt_colour[$k]    = $dt_bak4_colour[$a];
                            $dt_tbd[$k]       = $dt_bak4_tbd[$a];
                            break;
                    }

                    // echo "<pre>";
                    // print_r($dt_ph[$k]);
                    // echo "</pre>";

                    if ($vph[$k] > 0) {
                        $objPHPExcel->getStyle($ph[$k - 1] . $dtl_row . ':' . $ph[$k - 1] . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                        $objPHPExcel->getStyle($ph[$k - 1] . $dtl_row . ':' . $ph[$k - 1] . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                        $objPHPExcel->mergeCells($ph[$k - 1] . ($dtl_row) . ':' . $ph[$k - 1] . ($dtl_row))->setCellValue($ph[$k - 1] . ($dtl_row), $dt_ph[$k]);
                    } else {
                        $objPHPExcel->mergeCells($ph[$k - 1] . ($dtl_row) . ':' . $ph[$k - 1] . ($dtl_row))->setCellValue($ph[$k - 1] . ($dtl_row), $dt_ph[$k]);
                    }
                    if ($vcolour[$k] > 0) {
                        $objPHPExcel->getStyle($colour[$k - 1] . $dtl_row . ':' . $colour[$k - 1] . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                        $objPHPExcel->getStyle($colour[$k - 1] . $dtl_row . ':' . $colour[$k - 1] . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                        $objPHPExcel->mergeCells($colour[$k - 1] . ($dtl_row) . ':' . $colour[$k - 1] . ($dtl_row))->setCellValue($colour[$k - 1] . ($dtl_row), $dt_colour[$k]);
                    } else {
                        $objPHPExcel->mergeCells($colour[$k - 1] . ($dtl_row) . ':' . $colour[$k - 1] . ($dtl_row))->setCellValue($colour[$k - 1] . ($dtl_row), $dt_colour[$k]);
                    }
                    if ($vtbd[$k] > 0) {
                        $objPHPExcel->getStyle($tbd[$k - 1] . $dtl_row . ':' . $tbd[$k - 1] . $dtl_row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                        $objPHPExcel->getStyle($tbd[$k - 1] . $dtl_row . ':' . $tbd[$k - 1] . $dtl_row)->getFill()->getStartColor()->setRGB('CC0000');
                        $objPHPExcel->mergeCells($tbd[$k - 1] . ($dtl_row) . ':' . $tbd[$k - 1] . ($dtl_row))->setCellValue($tbd[$k - 1] . ($dtl_row), $dt_tbd[$k]);
                    } else {
                        $objPHPExcel->mergeCells($tbd[$k - 1] . ($dtl_row) . ':' . $tbd[$k - 1] . ($dtl_row))->setCellValue($tbd[$k - 1] . ($dtl_row), $dt_tbd[$k]);
                    }
                }


                $objPHPExcel->setSharedStyle($bodyStyleRight, 'BE' . ($dtl_row) . ':BE' . ($dtl_row + 9));
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($dtl_row) . ':A' . ($dtl_row + 9));
            }
            // die;
            // detail b
            $table2 = $dtl_row + 1;
            $objPHPExcel->mergeCells('B'  . ($table2 + 1) . ':BD' . ($table2 + 1))->setCellValue('B' .  ($table2 + 1), "CATATAN KETIDAKSESUAIAN");
            $objPHPExcel->mergeCells('B'  . ($table2 + 2) . ':D' . ($table2 + 2))->setCellValue('B' .  ($table2 + 2), "Jam");
            $objPHPExcel->mergeCells('E'  . ($table2 + 2) . ':N' . ($table2 + 2))->setCellValue('E' .  ($table2 + 2), "Ketidaksesuaian");
            $objPHPExcel->mergeCells('O'  . ($table2 + 2) . ':AS' . ($table2 + 2))->setCellValue('O' .  ($table2 + 2), "Corrective Action");
            $objPHPExcel->mergeCells('AT'  . ($table2 + 2) . ':BD' . ($table2 + 2))->setCellValue('AT' .  ($table2 + 2), "Keterangan");

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($table2 + 1) . ':BD' . ($table2 + 2));
            $objPHPExcel->getStyle('B' . ($table2 + 1) . ':BD' . ($table2 + 2))->getFont()->setBold(true);
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($table2 + 3) . ':BD' . ($table2 + 3));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BE' . ($table2) . ':BE' . ($table2 + 2));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($table2) . ':A' . ($table2 + 2));

            $keterangan1 = $table2 + 2;
            for ($d = $start_detail_b; $d <= $finish_detail_b; $d++) {
                $keterangan1++;
                $objPHPExcel->getRowDimension($keterangan1)->setRowHeight(25);
                $dt_jam[$d]         = $dtl_b_jam[$d] ?? "";
                $dt_uraian[$d]      = $dtl_b_uraian[$d] ?? "";
                $dt_tindakan[$d]    = $dtl_b_tindakan[$d] ?? "";
                $dt_keterangan[$d]  = $dtl_b_keterangan[$d] ?? "";

                $objPHPExcel->setSharedStyle($bodyStyleRight, 'BE' . ($keterangan1) . ':BE' . ($keterangan1));
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($keterangan1) . ':A' . ($keterangan1));
                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $keterangan1 . ':BD' . $keterangan1);                                        // TABEL BODY (DETAIL)
                $objPHPExcel->mergeCells('B' .  $keterangan1 . ':D' .  $keterangan1)->setCellValue('B' .  $keterangan1, $dt_jam[$d]);
                $objPHPExcel->mergeCells('E' .  $keterangan1 . ':N' .  $keterangan1)->setCellValue('E' .  $keterangan1, $dt_uraian[$d]);
                $objPHPExcel->mergeCells('O' .  $keterangan1 . ':AS' . $keterangan1)->setCellValue('O' .  $keterangan1, $dt_tindakan[$d]);
                $objPHPExcel->mergeCells('AT' . $keterangan1 . ':BD' . $keterangan1)->setCellValue('AT' . $keterangan1, $dt_keterangan[$d]);
            }

            // end detail b

            $app_row  = $keterangan1 + 1;

            $objPHPExcel->getRowDimension($app_row + 1)->setRowHeight(6);
            $objPHPExcel->mergeCells('B' . ($app_row + 2) . ':M' . ($app_row + 2))->setCellValue('B' . ($app_row + 2), "Dibuat oleh " . 'shift 1,');
            $objPHPExcel->mergeCells('B' . ($app_row + 3) . ':M' . ($app_row + 6))->setCellValue('B' . ($app_row + 3), '');

            $objPHPExcel->mergeCells('N' . ($app_row + 2) . ':W' . ($app_row + 2))->setCellValue('N' . ($app_row + 2), "Dibuat oleh " . 'shift 2');
            $objPHPExcel->mergeCells('N' . ($app_row + 3) . ':W' . ($app_row + 6))->setCellValue('N' . ($app_row + 3), '');

            $objPHPExcel->mergeCells('X' . ($app_row + 2) . ':AG' . ($app_row + 2))->setCellValue('X' . ($app_row + 2), "Dibuat oleh " . 'shift 3');
            $objPHPExcel->mergeCells('X' . ($app_row + 3) . ':AG' . ($app_row + 6))->setCellValue('X' . ($app_row + 3), '');

            $objPHPExcel->mergeCells('AH' . ($app_row + 2) . ':AR' . ($app_row + 2))->setCellValue('AH' . ($app_row + 2), 'Diketahui Oleh, ');
            $objPHPExcel->mergeCells('AH' . ($app_row + 3) . ':AR' . ($app_row + 6))->setCellValue('AH' . ($app_row + 3), '');

            $objPHPExcel->mergeCells('AS' . ($app_row + 2) . ':BD' . ($app_row + 2))->setCellValue('AS' . ($app_row + 2), 'Disetujui Oleh,');
            $objPHPExcel->mergeCells('AS' . ($app_row + 3) . ':BD' . ($app_row + 6))->setCellValue('AS' . ($app_row + 3), '');

            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($app_row) . ':BE' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row) . ':BD' . ($app_row));
            $objPHPExcel->setSharedStyle($bodyStyle, 'B' . ($app_row + 2) . ':BD' . ($app_row + 2));
            $objPHPExcel->setSharedStyle($bodyStyle, 'B' . ($app_row + 3) . ':BD' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BE' . ($app_row) . ':BE' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row) . ':A' . ($app_row + 6));

            // tabel app
            if ($app1_personalstatus == '2') {
                $imageurlapp1 = '/forviewfoto_pekerja/TTD_TK/';
                $imageformatapp1 = '.png';
            } else if (
                $app1_personalstatus == '1'
            ) {
                $imageurlapp1 = '/forviewfoto_pekerja/';
                $imageformatapp1 = '_0_0.png';
            } else {
                $imageurlapp1 = '';
                $imageformatapp1 = '';
            }

            $fcpath2   = str_replace('utl/', '', FCPATH);

            $sign_img  = '$objDrawing' . $i1;
            if (isset($app1_by)) {
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app1_personalstatus . '_' . $app1_personalid . '.png')) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $app1_personalstatus . '_' . $app1_personalid . '.png');
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('G' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('G' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('G' . ($app_row + 4));
                }
            }

            if ($app2_personalstatus == '2') {
                $imageurlapp2 = '/forviewfoto_pekerja/TTD_TK/';
                $imageformatapp2 = '.png';
            } else if ($app2_personalstatus == '1') {
                $imageurlapp2 = '/forviewfoto_pekerja/';
                $imageformatapp2 = '_0_0.png';
            } else {
                $imageurlapp2 = '';
                $imageformatapp2 = '';
            }

            $sign_img2 = '$objDrawing' . $i1;
            if (isset($app2_by)) {
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app2_personalstatus . '_' . $app2_personalid . '.png')) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $app2_personalstatus . '_' . $app2_personalid . '.png');
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('R' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else  if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('R' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('R' . ($app_row + 4));
                }
            }

            if ($app3_personalstatus == '2') {
                $imageurlapp3 = '/forviewfoto_pekerja/TTD_TK/';
                $imageformatapp3 = '.png';
            } else if ($app3_personalstatus == '1') {
                $imageurlapp3 = '/forviewfoto_pekerja/';
                $imageformatapp3 = '_0_0.png';
            } else {
                $imageurlapp3 = '';
                $imageformatapp3 = '';
            }

            $sign_img3 = '$objDrawing' . $i1;
            if (isset($app3_by)) {
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app3_personalstatus . '_' . $app2_personalid . '.png')) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $app3_personalstatus . '_' . $app2_personalid . '.png');
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AC' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('AC' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AC' . ($app_row + 4));
                }
            }

            if ($app4_personalstatus == '2') {
                $imageurlapp4 = '/forviewfoto_pekerja/TTD_TK/';
                $imageformatapp4 = '.png';
            } else if ($app4_personalstatus == '1') {
                $imageurlapp4 = '/forviewfoto_pekerja/';
                $imageformatapp4 = '_0_0.png';
            } else {
                $imageurlapp4 = '';
                $imageformatapp4 = '';
            }

            $sign_img4 = '$objDrawing' . $i1;
            if (isset($app4_by)) {
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app4_personalstatus . '_' . $app4_personalid . '.png')) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $app4_personalstatus . '_' . $app4_personalid . '.png');
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AM' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else if ($app4_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4)) {
                    $sign_img4 = new PHPExcel_Worksheet_Drawing();
                    $sign_img4->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4);
                    $sign_img4->setWidthAndHeight(135, 135);
                    $sign_img4->setResizeProportional(true);
                    $sign_img4->setWorksheet($objPHPExcel);
                    $sign_img4->setCoordinates('AM' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AM' . ($app_row + 4));
                }
            }

            if ($app5_personalstatus == '2') {
                $imageurlapp5 = '/forviewfoto_pekerja/TTD_TK/';
                $imageformatapp5 = '.png';
            } else if ($app5_personalstatus == '1') {
                $imageurlapp5 = '/forviewfoto_pekerja/';
                $imageformatapp5 = '_0_0.png';
            } else {
                $imageurlapp5 = '';
                $imageformatapp5 = '';
            }

            $sign_img5 = '$objDrawing' . $i1;
            if (isset($app5_by)) {
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app5_personalstatus . '_' . $app5_personalid . '.png')) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $app5_personalstatus . '_' . $app5_personalid . '.png');
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AX' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else if ($app5_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp5 . $app5_personalid . $imageformatapp5)) {
                    $sign_img5 = new PHPExcel_Worksheet_Drawing();
                    $sign_img5->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp5 . $app5_personalid . $imageformatapp5);
                    $sign_img5->setWidthAndHeight(135, 135);
                    $sign_img5->setResizeProportional(true);
                    $sign_img5->setWorksheet($objPHPExcel);
                    $sign_img5->setCoordinates('AX' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AX' . ($app_row + 4));
                }
            }

            $objPHPExcel->mergeCells('B' . ($app_row + 7) . ':D' . ($app_row + 7))->setCellValue('B' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('E' . ($app_row + 7) . ':M' . ($app_row + 7))->setCellValue('E' . ($app_row + 7), ': ' . $app1_by);
            $objPHPExcel->mergeCells('B' . ($app_row + 8) . ':D' . ($app_row + 8))->setCellValue('B' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('E' . ($app_row + 8) . ':M' . ($app_row + 8))->setCellValue('E' . ($app_row + 8), ': ' . $app1_position);
            $objPHPExcel->mergeCells('B' . ($app_row + 9) . ':D' . ($app_row + 9))->setCellValue('B' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('E' . ($app_row + 9) . ':M' . ($app_row + 9))->setCellValue('E' . ($app_row + 9), ': ' . $app1date);

            $objPHPExcel->mergeCells('N' . ($app_row + 7) . ':O' . ($app_row + 7))->setCellValue('N' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('P' . ($app_row + 7) . ':W' . ($app_row + 7))->setCellValue('P' . ($app_row + 7), ': ' . $app2_by);
            $objPHPExcel->mergeCells('N' . ($app_row + 8) . ':O' . ($app_row + 8))->setCellValue('N' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('P' . ($app_row + 8) . ':W' . ($app_row + 8))->setCellValue('P' . ($app_row + 8), ': ' . $app2_position);
            $objPHPExcel->mergeCells('N' . ($app_row + 9) . ':O' . ($app_row + 9))->setCellValue('N' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('P' . ($app_row + 9) . ':W' . ($app_row + 9))->setCellValue('P' . ($app_row + 9), ': ' . $app2date);

            $objPHPExcel->mergeCells('X' . ($app_row + 7) . ':Y' . ($app_row + 7))->setCellValue('X' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('Z' . ($app_row + 7) . ':AG' . ($app_row + 7))->setCellValue('Z' . ($app_row + 7), ': ' . $app3_by);
            $objPHPExcel->mergeCells('X' . ($app_row + 8) . ':Y' . ($app_row + 8))->setCellValue('X' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('Z' . ($app_row + 8) . ':AG' . ($app_row + 8))->setCellValue('Z' . ($app_row + 8), ': ' . $app3_position);
            $objPHPExcel->mergeCells('X' . ($app_row + 9) . ':Y' . ($app_row + 9))->setCellValue('X' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('Z' . ($app_row + 9) . ':AG' . ($app_row + 9))->setCellValue('Z' . ($app_row + 9), ': ' . $app3date);

            $objPHPExcel->mergeCells('AH' . ($app_row + 7) . ':AI' . ($app_row + 7))->setCellValue('AH' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 7) . ':AQ' . ($app_row + 7))->setCellValue('AJ' . ($app_row + 7), ': ' . $app4_by);
            $objPHPExcel->mergeCells('AH' . ($app_row + 8) . ':AI' . ($app_row + 8))->setCellValue('AH' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 8) . ':AQ' . ($app_row + 8))->setCellValue('AJ' . ($app_row + 8), ': ' . $app4_position);
            $objPHPExcel->mergeCells('AH' . ($app_row + 9) . ':AI' . ($app_row + 9))->setCellValue('AH' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 9) . ':AQ' . ($app_row + 9))->setCellValue('AJ' . ($app_row + 9), ': ' . $app4date);

            $objPHPExcel->mergeCells('AS' . ($app_row + 7) . ':AU' . ($app_row + 7))->setCellValue('AS' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('AV' . ($app_row + 7) . ':BD' . ($app_row + 7))->setCellValue('AV' . ($app_row + 7), ': ' . $app5_by);
            $objPHPExcel->mergeCells('AS' . ($app_row + 8) . ':AU' . ($app_row + 8))->setCellValue('AS' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('AV' . ($app_row + 8) . ':BD' . ($app_row + 8))->setCellValue('AV' . ($app_row + 8), ': ' . $app5_position);
            $objPHPExcel->mergeCells('AS' . ($app_row + 9) . ':AU' . ($app_row + 9))->setCellValue('AS' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('AV' . ($app_row + 9) . ':BD' . ($app_row + 9))->setCellValue('AV' . ($app_row + 9), ': ' . $app5date);

            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($app_row + 7) . ':BE' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'B' . ($app_row + 7) . ':B' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'N' . ($app_row + 7) . ':N' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'X' . ($app_row + 7) . ':X' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AH' . ($app_row + 7) . ':AH' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AS' . ($app_row + 7) . ':AS' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'E' . ($app_row + 7) . ':E' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'P' . ($app_row + 7) . ':P' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'Z' . ($app_row + 7) . ':Z' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BD' . ($app_row + 7) . ':BD' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BE' . ($app_row + 7) . ':BE' . ($app_row + 9));


            $foot_row = $app_row + 9;
            $objPHPExcel->mergeCells('A' . ($foot_row + 1) . ':Q' . ($foot_row + 1))->setCellValue('A' . ($foot_row + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('R' . ($foot_row + 1) . ':BE' . ($foot_row + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($foot_row + 1) . ':BE' . ($foot_row + 1))->setCellValue('R' . ($foot_row + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($foot_row + 1) . ':Q' . ($foot_row + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($foot_row + 1) . ':BE' . ($foot_row + 1));
            $objPHPExcel->setBreak('A' . ($foot_row + 1),  PHPExcel_Worksheet::BREAK_ROW);
        }

        ob_clean();
        header('Content-Type: text/html; charset=utf-8');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $this->frmnm . '.xls');
        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
        $objWriter->save('php://output');
        exit();
        ob_end_clean();
    }
}
