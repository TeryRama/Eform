<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_frmfss315_16 extends CI_Controller
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
        $frmkode              = $this->uri->segment(4);
        $frmvrs               = $this->uri->segment(5);
        $this->load->model(array('M_user', 'master/M_form', 'M_menu', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->library(array('table', 'form_validation', 'excel', 'fpdf'));
        $this->frmcop         = $this->config->item("nama_perusahaan");
        $session_data         = $this->session->userdata('logged_in');
        $dtheader['Titel']    = 'Home';
        $LevelUser            = $session_data['leveluserid'];
        $UserName             = $session_data['username'];
        $LevelUserNm          = $session_data['levelusernm'];
        $this->cekLevelUserNm = substr($LevelUserNm, 0, 7);
        $this->model          = $this->{'M_form' . $frmkode . '_' . $frmvrs};
        ///load  excel ////
        $this->xls            = new exelstyles();
        $this->spreadsheet    = new Excel();
        $this->sheet          = $this->spreadsheet->getActiveSheet();
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
        $dtheader = $this->model->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date       = $dtheaderrow->create_date; //2021-02-08

            $create_date         = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno               = $dtheaderrow->docno;
            $remark              = $dtheaderrow->remark;

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
            $dtdetail       = $this->model->get_detail_byid_lapx($this->header_id);
            $dtdetail_b     = $this->model->get_detail_byid_bx($this->header_id);
            $dtdetail_c     = $this->model->get_detail_byid_cx($this->header_id);
            $dtdetail_d     = $this->model->get_detail_byid_lapdx($this->header_id);
        } else {
            $dtdetail       = $this->model->get_detail_byid_lap($this->header_id);
            $dtdetail_b     = $this->model->get_detail_byid_b($this->header_id);
            $dtdetail_c     = $this->model->get_detail_byid_c($this->header_id);
            $dtdetail_d     = $this->model->get_detail_byid_lapd($this->header_id);
        }

        $shift_romawi = [
            'shift_1' => 'I',
            'shift_2' => 'II',
            'shift_3' => 'III',
        ];

        // detail
        $tbl_max = count($dtdetail);
        // var_dump($tbl_max);die;
        $no = 1;
        foreach ($dtdetail as $dtdetail_key => $dtdetail_row) {
            $shift[]              = $dtdetail_row->shift;
            $rw_1_total_jam[]     = $dtdetail_row->rw_1_total_jam;
            $rw_1_fm_awal[]       = $dtdetail_row->rw_1_fm_awal;
            $rw_1_fm_akhir[]      = $dtdetail_row->rw_1_fm_akhir;
            $rw_1_total[]         = $dtdetail_row->rw_1_total;
            $rw_1_drain[]         = $dtdetail_row->rw_1_drain;
            $rw_2_total_jam[]     = $dtdetail_row->rw_2_total_jam;
            $rw_2_fm_awal[]       = $dtdetail_row->rw_2_fm_awal;
            $rw_2_fm_akhir[]      = $dtdetail_row->rw_2_fm_akhir;
            $rw_2_total[]         = $dtdetail_row->rw_2_total;
            $rw_2_drain[]         = $dtdetail_row->rw_2_drain;
            $cone_1_2_total_jam[] = $dtdetail_row->cone_1_2_total_jam;
            $cone_1_2_fm_awal[]   = $dtdetail_row->cone_1_2_fm_awal;
            $cone_1_2_fm_akhir[]  = $dtdetail_row->cone_1_2_fm_akhir;
            $cone_1_2_total[]     = $dtdetail_row->cone_1_2_total;
            $cone_1_2_drain[]     = $dtdetail_row->cone_1_2_drain;
            // $cone_3_4_total_jam[] = $dtdetail_row->cone_3_4_total_jam;
            // $cone_3_4_fm_awal[]   = $dtdetail_row->cone_3_4_fm_awal;
            // $cone_3_4_fm_akhir[]  = $dtdetail_row->cone_3_4_fm_akhir;
            // $cone_3_4_total[]     = $dtdetail_row->cone_3_4_total;
            // $cone_3_4_drain[]     = $dtdetail_row->cone_3_4_drain;
            $no++;
        }

        // detail b
        $tbl_max_b = count($dtdetail_b);
        $no = 1;
        foreach ($dtdetail_b as $dtdetail_b_key => $dtdetail_b_row) {
            // ini mau nampilin list item aja 
            if ($dtdetail_b_row->shift == 'shift_1') {
                $rnum_item1[]      = $dtdetail_b_row->rnum_item1;
                $rnum_item1_desc[] = $dtdetail_b_row->rnum_item1_desc;
                $val_item1[]       = $dtdetail_b_row->val_item1;
                $val_item2[]       = $dtdetail_b_row->val_item2;
                $val_spek2[]       = $dtdetail_b_row->val_spek2;
                $id_item1[]        = $dtdetail_b_row->id_item1;
                $id_item2[]        = $dtdetail_b_row->id_item2;

                $dtl_no[] = $no++;
                for ($tbl_a_i = 1; $tbl_a_i <= 3; $tbl_a_i++) {
                    foreach ($dtdetail_b as ${'dtdetail_b_key_sf' . $tbl_a_i} => ${'dtdetail_b_row_sf' . $tbl_a_i}) {
                        if (
                            ${'dtdetail_b_row_sf' . $tbl_a_i}->shift == 'shift_' . $tbl_a_i
                            && $dtdetail_b_row->id_item1 == ${'dtdetail_b_row_sf' . $tbl_a_i}->id_item1
                            && $dtdetail_b_row->id_item2 == ${'dtdetail_b_row_sf' . $tbl_a_i}->id_item2
                        ) {
                            ${'baku_terima_shift_' . $tbl_a_i}[]    = ${'dtdetail_b_row_sf' . $tbl_a_i}->baku_terima;
                            ${'baku_pakai_shift_' . $tbl_a_i}[]     = ${'dtdetail_b_row_sf' . $tbl_a_i}->baku_pakai;
                            ${'baku_stok_shift_' . $tbl_a_i}[]      = ${'dtdetail_b_row_sf' . $tbl_a_i}->baku_stok;
                            ${'larutan_terima_shift_' . $tbl_a_i}[] = ${'dtdetail_b_row_sf' . $tbl_a_i}->larutan_terima;
                            ${'larutan_pakai_shift_' . $tbl_a_i}[]  = ${'dtdetail_b_row_sf' . $tbl_a_i}->larutan_pakai;
                            ${'larutan_stok_shift_' . $tbl_a_i}[]   = ${'dtdetail_b_row_sf' . $tbl_a_i}->larutan_stok;
                            break;
                        }
                    }
                }
            }
        }
        
        // detail
        $tbl_max_c = count($dtdetail_c);
        $no_c = 1;
        foreach ($dtdetail_c as $dtdetail_c_key => $dtdetail_c_row) {
            $shift[]                 = $dtdetail_c_row->shift;
            $rw_sedimen_a1[]         = $dtdetail_c_row->rw_sedimen_a1;
            $rw_sedimen_a2[]         = $dtdetail_c_row->rw_sedimen_a2;
            $rw_sedimen_a3[]         = $dtdetail_c_row->rw_sedimen_a3;
            $rw_sedimen_a4[]         = $dtdetail_c_row->rw_sedimen_a4;
            $rw_sedimen_a5[]         = $dtdetail_c_row->rw_sedimen_a5;
            $rw_sedimen_a6[]         = $dtdetail_c_row->rw_sedimen_a6;
            $rw_sedimen_b1[]         = $dtdetail_c_row->rw_sedimen_b1;
            $rw_sedimen_b2[]         = $dtdetail_c_row->rw_sedimen_b2;
            $rw_sedimen_b3[]         = $dtdetail_c_row->rw_sedimen_b3;
            $rw_sedimen_b4[]         = $dtdetail_c_row->rw_sedimen_b4;
            $rw_sedimen_b5[]         = $dtdetail_c_row->rw_sedimen_b5;
            $rw_sedimen_b6[]         = $dtdetail_c_row->rw_sedimen_b6;
            $rw_cone_clarifier_1_2[] = $dtdetail_c_row->rw_cone_clarifier_1_2;
            $rw_cone_clarifier_3_4[] = $dtdetail_c_row->rw_cone_clarifier_3_4;
            $bsf_sedimen_c1[]        = $dtdetail_c_row->bsf_sedimen_c1;
            $bsf_sedimen_c2[]        = $dtdetail_c_row->bsf_sedimen_c2;
            $bsf_bak_v_notch[]       = $dtdetail_c_row->bsf_bak_v_notch;
            $bsf_bak_reyclce[]       = $dtdetail_c_row->bsf_bak_reyclce;
            $bsf_bak_cw[]            = $dtdetail_c_row->bsf_bak_cw;
            $asf_asf_a[]             = $dtdetail_c_row->asf_asf_a;
            $asf_asf_b[]             = $dtdetail_c_row->asf_asf_b;
            $asf_asf_1a[]            = $dtdetail_c_row->asf_asf_1a;
            $asf_asf_1b[]            = $dtdetail_c_row->asf_asf_1b;
            $asf_bak_2[]             = $dtdetail_c_row->asf_bak_2;
            $asf_bak_3[]             = $dtdetail_c_row->asf_bak_3;
            $asf_tower_tbn[]         = $dtdetail_c_row->asf_tower_tbn;
            $asf_tower_mess[]        = $dtdetail_c_row->asf_tower_mess;
            $acf_acf_a[]             = $dtdetail_c_row->acf_acf_a;
            $acf_acf_b[]             = $dtdetail_c_row->acf_acf_b;
            $acf_bak_iv[]            = $dtdetail_c_row->acf_bak_iv;
            $acf_bak_cip_1[]         = $dtdetail_c_row->acf_bak_cip_1;
            $acf_bak_cip_2[]         = $dtdetail_c_row->acf_bak_cip_2;
            $ast_ast[]               = $dtdetail_c_row->ast_ast;
            $ast_bak_demin[]         = $dtdetail_c_row->ast_bak_demin;
            $ast_tangki_st_mes[]     = $dtdetail_c_row->ast_tangki_st_mes;
            $aro_tangki_ro_mes[]     = $dtdetail_c_row->aro_tangki_ro_mes;
            $aro_tangki_ro[]         = $dtdetail_c_row->aro_tangki_ro;
            $aro_ro_wtp[]            = $dtdetail_c_row->aro_ro_wtp;
            $no_c++;
        }

        //detail d
        $tbl_max_d = count($dtdetail_d);
        foreach ($dtdetail_d as $dtdetail_d_row) {
            $shift[]              = trim ($dtdetail_d_row->shift);
            $drain[]              = trim ($dtdetail_d_row->drain);
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
        $objPHPExcel->getPageSetup()->setScale(55);
        $objPHPExcel->getPageMargins()->setLeft(0.1);
        $objPHPExcel->getPageMargins()->setRight(0.1);
        $objPHPExcel->getPageMargins()->setBottom(0.1);
        $objPHPExcel->getPageMargins()->setTop(0.1);
        $objPHPExcel->getPageSetup()->setVerticalCentered(true);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);

        $count1 = count($dtdetail) / 3; //dibagi karena 3 shift
        $jml_data_perpage = 16;
        if ($count1 < $jml_data_perpage) {
            $jml_page_a = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page_a = $count1 / $jml_data_perpage;
            } else {
                $jml_page_a = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }

        $count2 = count($dtdetail_b) / 3;
        $jml_data_perpage_b = 1;
        if ($count2 < $jml_data_perpage_b) {
            $jml_page_b = 1;
        } else {
            if (($count2 % $jml_data_perpage_b) == 0) {
                $jml_page_b = $count2 / $jml_data_perpage_b;
            } else {
                $jml_page_b = floor(($count2 / $jml_data_perpage_b)) + 1;
            }
        }

        $count3 = count($dtdetail_c) / 3; //dibagi karena 3 shift
        $jml_data_perpage_c = 16;
        if ($count3 < $jml_data_perpage_c) {
            $jml_page_c = 1;
        } else {
            if (($count3 % $jml_data_perpage_c) == 0) {
                $jml_page_c = $count3 / $jml_data_perpage_c;
            } else {
                $jml_page_c = floor(($count3 / $jml_data_perpage_c)) + 1;
            }
        }

        // $count3 = count($dtdetail_d);
        // $jml_data_perpage_d = 3;
        // if ($count3 < $jml_data_perpage_d) {
        //     $jml_page_d = 1;
        // } else {
        //     if (($count3 % $jml_data_perpage_d) == 0) {
        //         $jml_page_d = $count3 / $jml_data_perpage_d;
        //     } else {
        //         $jml_page_d = floor(($count3 / $jml_data_perpage_d)) + 1;
        //     }
        // }

        $jml_row_perpage  = 48;

        // $jml_page   = max($jml_page_a, $jml_page_b, $jml_page_c, $jml_page_d);
        $jml_page   = 1;

        $range = array();
        $rangeCol = "BO";
        for ($y = "T", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(4);
        }

        $range2 = array();
        $range2Col = "S";
        for ($y = "B", $range2Col++; $y != $range2Col; $y++) {
            $range2[] = $y;
        }

        foreach ($range2 as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(3);
        }

        $objPHPExcel->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getColumnDimension('AP')->setWidth(7);
        $objPHPExcel->getColumnDimension('AQ')->setWidth(6);
        $objPHPExcel->getColumnDimension('BN')->setWidth(6);
        $objPHPExcel->getColumnDimension('BO')->setWidth(6);

        for ($rowHeight = 0; $rowHeight < ($jml_row_perpage * $jml_page); $rowHeight++) {
            $objPHPExcel->getRowDimension($rowHeight)->setRowHeight(25);
        }

        for ($i1 = 0; $i1 < $jml_page; $i1++) {

            $start_row = ($i1 * $jml_row_perpage) + 1;
            $finish_row = ((($i1 * $jml_row_perpage) + 1) + ($jml_row_perpage));

            $start_detail = ($i1 * $jml_data_perpage);
            $finish_detail = (($i1 * $jml_data_perpage) + ($jml_data_perpage - 1));

            $start_detail_b = ($i1 * $jml_data_perpage_b);
            $finish_detail_b = (($i1 * $jml_data_perpage_b) + ($jml_data_perpage_b - 1));

            $start_detail_c = ($i1 * $jml_data_perpage_c);
            $finish_detail_c = (($i1 * $jml_data_perpage_c) + ($jml_data_perpage_c - 1));

            // $start_detail_d = ($i1 * $jml_data_perpage_d);
            // $finish_detail_d = (($i1 * $jml_data_perpage_d) + ($jml_data_perpage_d - 1));

            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/PSG_logo_2022.png');
            $gbr->setWidthAndHeight(45, 45);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('B' . $start_row);

            $objPHPExcel->getRowDimension($start_row)->setRowHeight(15);
            $objPHPExcel->getRowDimension($start_row + 1)->setRowHeight(15);
            $objPHPExcel->getRowDimension($start_row + 2)->setRowHeight(15);
            $objPHPExcel->getRowDimension($start_row + 3)->setRowHeight(15);
            
            $objPHPExcel->mergeCells('A' . $start_row . ':E' . ($start_row + 1));
            $objPHPExcel->mergeCells('F' . $start_row . ':BD' . ($start_row + 1))->setCellValue('F' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('BE' . $start_row . ':BF' . $start_row)->setCellValue('BE' . $start_row, 'Dok');
            $objPHPExcel->mergeCells('BG' . $start_row . ':BO' . $start_row)->setCellValue('BG' . $start_row, ': ' . $docno);
            $objPHPExcel->mergeCells('BE' . ($start_row + 1) . ':BF' . ($start_row + 1))->setCellValue('BE' . ($start_row + 1), 'Tgl');
            $objPHPExcel->mergeCells('BG' . ($start_row + 1) . ':BO' . ($start_row + 1))->setCellValue('BG' . ($start_row + 1), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' . ($start_row + 2) . ':E' . ($start_row + 2))->setCellValue('A' . ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('F' . ($start_row + 2) . ':BD' . ($start_row + 2))->setCellValue('F' . ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('BE' . ($start_row + 2) . ':BF' . ($start_row + 2))->setCellValue('BE' . ($start_row + 2), 'Hlm');
            $objPHPExcel->mergeCells('BG' . ($start_row + 2) . ':BO' . ($start_row + 2))->setCellValue('BG' . ($start_row + 2), ': ' . ($i1 + 1) . ' dari ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle, 'A' . ($start_row) . ':BD' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleLeftTop, 'BE' . ($start_row) . ':BO' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'BG' . $start_row . ':BO' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'BE' . ($start_row + 2) . ':BO' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'BG' . ($start_row + 2) . ':BO' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':BD' . ($start_row + 2));

            // detail

            $objPHPExcel->mergeCells('A' . ($start_row + 3) . ':B' . ($start_row + 5))->setCellValue('A' . ($start_row + 3), "SHIFT");
            $objPHPExcel->mergeCells('C' . ($start_row + 4) . ':H' . ($start_row + 5))->setCellValue('C' . ($start_row + 4), "Total");
            $objPHPExcel->mergeCells('I' . ($start_row + 4) . ':N' . ($start_row + 5))->setCellValue('I' . ($start_row + 4), "FM Awal");
            $objPHPExcel->mergeCells('O' . ($start_row + 4) . ':T' . ($start_row + 5))->setCellValue('O' . ($start_row + 4), "FM Akhir");
            $objPHPExcel->mergeCells('U' . ($start_row + 4) . ':Y' . ($start_row + 5))->setCellValue('U' . ($start_row + 4), "Total");
            $objPHPExcel->mergeCells('Z' . ($start_row + 3) . ':AC' . ($start_row + 5))->setCellValue('Z' . ($start_row + 3), "Drain");
            $objPHPExcel->mergeCells('AD' . ($start_row + 4) . ':AG' . ($start_row + 5))->setCellValue('AD' . ($start_row + 4), "Total");
            $objPHPExcel->mergeCells('AH' . ($start_row + 4) . ':AK' . ($start_row + 5))->setCellValue('AH' . ($start_row + 4), "FM Awal");
            $objPHPExcel->mergeCells('AL' . ($start_row + 4) . ':AO' . ($start_row + 5))->setCellValue('AL' . ($start_row + 4), "FM Akhir");
            $objPHPExcel->mergeCells('AP' . ($start_row + 4) . ':AR' . ($start_row + 5))->setCellValue('AP' . ($start_row + 4), "Total");
            $objPHPExcel->mergeCells('AS' . ($start_row + 3) . ':AV' . ($start_row + 5))->setCellValue('AS' . ($start_row + 3), "Drain");
            $objPHPExcel->mergeCells('AW' . ($start_row + 4) . ':AZ' . ($start_row + 5))->setCellValue('AW' . ($start_row + 4), "Total");
            $objPHPExcel->mergeCells('BA' . ($start_row + 4) . ':BD' . ($start_row + 5))->setCellValue('BA' . ($start_row + 4), "FM Awal");
            $objPHPExcel->mergeCells('BE' . ($start_row + 4) . ':BH' . ($start_row + 5))->setCellValue('BE' . ($start_row + 4), "FM Akhir");
            $objPHPExcel->mergeCells('BI' . ($start_row + 4) . ':BL' . ($start_row + 5))->setCellValue('BI' . ($start_row + 4), "Total");
            $objPHPExcel->mergeCells('BM' . ($start_row + 3) . ':BO' . ($start_row + 5))->setCellValue('BM' . ($start_row + 3), "Drain");
            // $objPHPExcel->mergeCells('BC' . ($start_row + 4) . ':BD' . ($start_row + 5))->setCellValue('BC' . ($start_row + 4), "Total");
            // $objPHPExcel->mergeCells('BE' . ($start_row + 4) . ':BG' . ($start_row + 5))->setCellValue('BE' . ($start_row + 4), "FM Awal");
            // $objPHPExcel->mergeCells('BH' . ($start_row + 4) . ':BJ' . ($start_row + 5))->setCellValue('AU' . ($start_row + 4), "FM Akhir");
            // $objPHPExcel->mergeCells('BK' . ($start_row + 4) . ':BM' . ($start_row + 5))->setCellValue('BK' . ($start_row + 4), "Total");
            // $objPHPExcel->mergeCells('BN' . ($start_row + 3) . ':BO' . ($start_row + 5))->setCellValue('BN' . ($start_row + 3), "Drain");

            
            $objPHPExcel->mergeCells('C' . ($start_row + 3) . ':Y' . ($start_row + 3))->setCellValue('C' . ($start_row + 3), "Proses Raw Water 1");
            $objPHPExcel->mergeCells('AD' . ($start_row + 3) . ':AR' . ($start_row + 3))->setCellValue('AD' . ($start_row + 3), "Proses Raw Water 2");
            $objPHPExcel->mergeCells('AW' . ($start_row + 3) . ':BL' . ($start_row + 3))->setCellValue('AW' . ($start_row + 3), "Proses Cone 1-2");
            // $objPHPExcel->mergeCells('BC' . ($start_row + 3) . ':BM' . ($start_row + 3))->setCellValue('BC' . ($start_row + 3), "Proses Cone 3-4");

            // $objPHPExcel->setSharedStyle($bodyStyleRight, 'BO' . ($start_row + 3) . ':BO' . ($start_row + 5));
            // $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($start_row + 3) . ':A' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row + 3) . ':BO' . ($start_row + 5));
            // $objPHPExcel->getStyle('A' . ($start_row + 4) . ':BO' . ($start_row + 5))->getFont()->setBold(true);

            $dtl_row = $start_row + 5;

            for ($a = 0 ; $a < $tbl_max; $a++) {
                $dtl_row++;

                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $dtl_row . ':BO' . $dtl_row);
                $objPHPExcel->mergeCells('A' . $dtl_row . ':B' . $dtl_row)->setCellValue('A' . $dtl_row, $shift_romawi[$shift[$a]]);
                $objPHPExcel->mergeCells('C' . $dtl_row . ':H' . $dtl_row)->setCellValue('C' . $dtl_row, $rw_1_total_jam[$a]);
                $objPHPExcel->mergeCells('I' . $dtl_row . ':N' . $dtl_row)->setCellValue('I' . $dtl_row, $rw_1_fm_awal[$a]);
                $objPHPExcel->mergeCells('O' . $dtl_row . ':T' . $dtl_row)->setCellValue('O' . $dtl_row, $rw_1_fm_akhir[$a]);
                $objPHPExcel->mergeCells('U' . $dtl_row . ':Y' . $dtl_row)->setCellValue('U' . $dtl_row, $rw_1_total[$a]);
                $objPHPExcel->mergeCells('Z' . $dtl_row . ':AC' . $dtl_row)->setCellValue('Z' . $dtl_row, $rw_1_drain[$a]);
                $objPHPExcel->mergeCells('AD' . $dtl_row . ':AG' . $dtl_row)->setCellValue('AD' . $dtl_row, $rw_2_total_jam[$a]);
                $objPHPExcel->mergeCells('AH' . $dtl_row . ':AK' . $dtl_row)->setCellValue('AH' . $dtl_row, $rw_2_fm_awal[$a]);
                $objPHPExcel->mergeCells('AL' . $dtl_row . ':AO' . $dtl_row)->setCellValue('AL' . $dtl_row, $rw_2_fm_akhir[$a]);
                $objPHPExcel->mergeCells('AP' . $dtl_row . ':AR' . $dtl_row)->setCellValue('AP' . $dtl_row, $rw_2_total[$a]);
                $objPHPExcel->mergeCells('AS' . $dtl_row . ':AV' . $dtl_row)->setCellValue('AS' . $dtl_row, $rw_2_drain[$a]);
                $objPHPExcel->mergeCells('AW' . $dtl_row . ':AZ' . $dtl_row)->setCellValue('AW' . $dtl_row, $cone_1_2_total_jam[$a]);
                $objPHPExcel->mergeCells('BA' . $dtl_row . ':BD' . $dtl_row)->setCellValue('BA' . $dtl_row, $cone_1_2_fm_awal[$a]);
                $objPHPExcel->mergeCells('BE' . $dtl_row . ':BH' . $dtl_row)->setCellValue('BE' . $dtl_row, $cone_1_2_fm_akhir[$a]);
                $objPHPExcel->mergeCells('BI' . $dtl_row . ':BL' . $dtl_row)->setCellValue('BI' . $dtl_row, $cone_1_2_total[$a]);
                $objPHPExcel->mergeCells('BM' . $dtl_row . ':BO' . $dtl_row)->setCellValue('BM' . $dtl_row, $cone_1_2_drain[$a]);
                // $objPHPExcel->mergeCells('BC' . $dtl_row . ':BD' . $dtl_row)->setCellValue('BC' . $dtl_row, $cone_3_4_total_jam[$a]);
                // $objPHPExcel->mergeCells('BE' . $dtl_row . ':BG' . $dtl_row)->setCellValue('BE' . $dtl_row, $cone_3_4_fm_awal[$a]);
                // $objPHPExcel->mergeCells('BH' . $dtl_row . ':BJ' . $dtl_row)->setCellValue('BH' . $dtl_row, $cone_3_4_fm_akhir[$a]);
                // $objPHPExcel->mergeCells('BK' . $dtl_row . ':BM' . $dtl_row)->setCellValue('BK' . $dtl_row, $cone_3_4_total[$a]);
                // $objPHPExcel->mergeCells('BN' . $dtl_row . ':BO' . $dtl_row)->setCellValue('BN' . $dtl_row, $cone_3_4_drain[$a]);
            }

            // end detail

            // detail b

            $start_table2 = $dtl_row;

            $objPHPExcel->mergeCells('A'  . ($start_table2 + 1) . ':H' . ($start_table2 + 3))->setCellValue('A' .  ($start_table2 + 1), "Bahan Kimia");

            $objPHPExcel->mergeCells('I'  . ($start_table2 + 1) . ':AD' . ($start_table2 + 1))->setCellValue('I' .  ($start_table2 + 1), "Shift I");
            $objPHPExcel->mergeCells('I'  . ($start_table2 + 2) . ':T' . ($start_table2 + 2))->setCellValue('I' .  ($start_table2 + 2), "Bahan kimia Baku ( KG )");
            $objPHPExcel->mergeCells('U'  . ($start_table2 + 2) . ':AD' . ($start_table2 + 2))->setCellValue('U' .  ($start_table2 + 2), "Bahan Kimia larutan ( liter)");
            $objPHPExcel->mergeCells('I'  . ($start_table2 + 3) . ':L' . ($start_table2 + 3))->setCellValue('I' .  ($start_table2 + 3), "Terima");
            $objPHPExcel->mergeCells('M'  . ($start_table2 + 3) . ':P' . ($start_table2 + 3))->setCellValue('M' .  ($start_table2 + 3), "Pakai");
            $objPHPExcel->mergeCells('Q'  . ($start_table2 + 3) . ':T' . ($start_table2 + 3))->setCellValue('Q' .  ($start_table2 + 3), "Stok");
            $objPHPExcel->mergeCells('U'  . ($start_table2 + 3) . ':W' . ($start_table2 + 3))->setCellValue('U' .  ($start_table2 + 3), "Terima");
            $objPHPExcel->mergeCells('X'  . ($start_table2 + 3) . ':AA' . ($start_table2 + 3))->setCellValue('X' .  ($start_table2 + 3), "Pakai");
            $objPHPExcel->mergeCells('AB'  . ($start_table2 + 3) . ':AD' . ($start_table2 + 3))->setCellValue('AB' .  ($start_table2 + 3), "Stok");

            $objPHPExcel->mergeCells('AE'  . ($start_table2 + 1) . ':AW' . ($start_table2 + 1))->setCellValue('AE' .  ($start_table2 + 1), "Shift II");
            $objPHPExcel->mergeCells('AE'  . ($start_table2 + 2) . ':AM' . ($start_table2 + 2))->setCellValue('AE' .  ($start_table2 + 2), "Bahan kimia Baku ( KG )");
            $objPHPExcel->mergeCells('AN'  . ($start_table2 + 2) . ':AW' . ($start_table2 + 2))->setCellValue('AN' .  ($start_table2 + 2), "Bahan Kimia larutan ( liter)");
            $objPHPExcel->mergeCells('AE'  . ($start_table2 + 3) . ':AG' . ($start_table2 + 3))->setCellValue('AE' .  ($start_table2 + 3), "Terima");
            $objPHPExcel->mergeCells('AH'  . ($start_table2 + 3) . ':AJ' . ($start_table2 + 3))->setCellValue('AH' .  ($start_table2 + 3), "Pakai");
            $objPHPExcel->mergeCells('AK'  . ($start_table2 + 3) . ':AM' . ($start_table2 + 3))->setCellValue('AK' .  ($start_table2 + 3), "Stok");
            $objPHPExcel->mergeCells('AN'  . ($start_table2 + 3) . ':AQ' . ($start_table2 + 3))->setCellValue('AN' .  ($start_table2 + 3), "Terima");
            $objPHPExcel->mergeCells('AR'  . ($start_table2 + 3) . ':AT' . ($start_table2 + 3))->setCellValue('AR' .  ($start_table2 + 3), "Pakai");
            $objPHPExcel->mergeCells('AU'  . ($start_table2 + 3) . ':AW' . ($start_table2 + 3))->setCellValue('AU' .  ($start_table2 + 3), "Stok");

            $objPHPExcel->mergeCells('AX'  . ($start_table2 + 1) . ':BO' . ($start_table2 + 1))->setCellValue('AX' .  ($start_table2 + 1), "Shift III");
            $objPHPExcel->mergeCells('AX'  . ($start_table2 + 2) . ':BF' . ($start_table2 + 2))->setCellValue('AX' .  ($start_table2 + 2), "Bahan kimia Baku ( KG )");
            $objPHPExcel->mergeCells('BG'  . ($start_table2 + 2) . ':BO' . ($start_table2 + 2))->setCellValue('BG' .  ($start_table2 + 2), "Bahan Kimia larutan ( liter)");
            $objPHPExcel->mergeCells('AX'  . ($start_table2 + 3) . ':AZ' . ($start_table2 + 3))->setCellValue('AX' .  ($start_table2 + 3), "Terima");
            $objPHPExcel->mergeCells('BA'  . ($start_table2 + 3) . ':BC' . ($start_table2 + 3))->setCellValue('BA' .  ($start_table2 + 3), "Pakai");
            $objPHPExcel->mergeCells('BD'  . ($start_table2 + 3) . ':BF' . ($start_table2 + 3))->setCellValue('BD' .  ($start_table2 + 3), "Stok");
            $objPHPExcel->mergeCells('BG'  . ($start_table2 + 3) . ':BI' . ($start_table2 + 3))->setCellValue('BG' .  ($start_table2 + 3), "Terima");
            $objPHPExcel->mergeCells('BJ'  . ($start_table2 + 3) . ':BM' . ($start_table2 + 3))->setCellValue('BJ' .  ($start_table2 + 3), "Pakai");
            $objPHPExcel->mergeCells('BN'  . ($start_table2 + 3) . ':BO' . ($start_table2 + 3))->setCellValue('BN' .  ($start_table2 + 3), "Stok");

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_table2 + 1) . ':BO' . ($start_table2 + 3));
            // $objPHPExcel->getStyle('A' . ($start_table2 + 4) . ':BO' . ($start_table2 + 4))->getFont()->setBold(true);

            $dtl_row2 = $start_table2 + 3;
            for ($b = 0; $b < $count2; $b++) {
                $dtl_row2++;

                $dt_baku_terima_shift_1[$b]    = $baku_terima_shift_1[$b] ?? "";
                $dt_baku_pakai_shift_1[$b]     = $baku_pakai_shift_1[$b] ?? "";
                $dt_baku_stok_shift_1[$b]      = $baku_stok_shift_1[$b] ?? "";
                $dt_larutan_terima_shift_1[$b] = $larutan_terima_shift_1[$b] ?? "";
                $dt_larutan_pakai_shift_1[$b]  = $larutan_pakai_shift_1[$b] ?? "";
                $dt_larutan_stok_shift_1[$b]   = $larutan_stok_shift_1[$b] ?? "";

                $dt_baku_terima_shift_2[$b]    = $baku_terima_shift_2[$b] ?? "";
                $dt_baku_pakai_shift_2[$b]     = $baku_pakai_shift_2[$b] ?? "";
                $dt_baku_stok_shift_2[$b]      = $baku_stok_shift_2[$b] ?? "";
                $dt_larutan_terima_shift_2[$b] = $larutan_terima_shift_2[$b] ?? "";
                $dt_larutan_pakai_shift_2[$b]  = $larutan_pakai_shift_2[$b] ?? "";
                $dt_larutan_stok_shift_2[$b]   = $larutan_stok_shift_2[$b] ?? "";

                $dt_baku_terima_shift_3[$b]    = $baku_terima_shift_3[$b] ?? "";
                $dt_baku_pakai_shift_3[$b]     = $baku_pakai_shift_3[$b] ?? "";
                $dt_baku_stok_shift_3[$b]      = $baku_stok_shift_3[$b] ?? "";
                $dt_larutan_terima_shift_3[$b] = $larutan_terima_shift_3[$b] ?? "";
                $dt_larutan_pakai_shift_3[$b]  = $larutan_pakai_shift_3[$b] ?? "";
                $dt_larutan_stok_shift_3[$b]   = $larutan_stok_shift_3[$b] ?? "";


                $objPHPExcel->setSharedStyle($noborderStyle, 'A' . $dtl_row2 . ':BO' . $dtl_row2);
                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $dtl_row2 . ':BO' . $dtl_row2);
                if($id_item2[$b] != '' || $id_item2[$b] != null){
                    $objPHPExcel->mergeCells('A'  . $dtl_row2 . ':D' . $dtl_row2)->setCellValue('A' .  $dtl_row2, $val_item1[$b]);
                    $objPHPExcel->mergeCells('E'  . $dtl_row2 . ':H' . $dtl_row2)->setCellValue('E' .  $dtl_row2, $val_item2[$b].' '. $val_spek2[$b]);
                }else{
                    $objPHPExcel->mergeCells('A'  . $dtl_row2 . ':H' . $dtl_row2)->setCellValue('A' .  $dtl_row2, $id_item1 == '23' ? $val_item1[$b].' '. $val_spek2[$b] : $val_item1[$b]);
                }

                $objPHPExcel->mergeCells('I' . $dtl_row2 . ':L' . $dtl_row2)->setCellValue('I' . $dtl_row2, $dt_baku_terima_shift_1[$b]);
                $objPHPExcel->mergeCells('M' . $dtl_row2 . ':P' . $dtl_row2)->setCellValue('M' . $dtl_row2, $dt_baku_pakai_shift_1[$b]);
                $objPHPExcel->mergeCells('Q' . $dtl_row2 . ':T' . $dtl_row2)->setCellValue('Q' . $dtl_row2, $dt_baku_stok_shift_1[$b]);
                $objPHPExcel->mergeCells('U' . $dtl_row2 . ':W' . $dtl_row2)->setCellValue('U' . $dtl_row2, $dt_larutan_terima_shift_1[$b]);
                $objPHPExcel->mergeCells('X' . $dtl_row2 . ':AA' . $dtl_row2)->setCellValue('X' . $dtl_row2, $dt_larutan_pakai_shift_1[$b]);
                $objPHPExcel->mergeCells('AB' . $dtl_row2 . ':AD' . $dtl_row2)->setCellValue('AB' . $dtl_row2, $dt_larutan_stok_shift_1[$b]);

                $objPHPExcel->mergeCells('AE' . $dtl_row2 . ':AG' . $dtl_row2)->setCellValue('AE' . $dtl_row2, $dt_baku_terima_shift_2[$b]);
                $objPHPExcel->mergeCells('AH' . $dtl_row2 . ':AJ' . $dtl_row2)->setCellValue('AH' . $dtl_row2, $dt_baku_pakai_shift_2[$b]);
                $objPHPExcel->mergeCells('AK' . $dtl_row2 . ':AM' . $dtl_row2)->setCellValue('AK' . $dtl_row2, $dt_baku_stok_shift_2[$b]);
                $objPHPExcel->mergeCells('AN' . $dtl_row2 . ':AQ' . $dtl_row2)->setCellValue('AN' . $dtl_row2, $dt_larutan_terima_shift_2[$b]);
                $objPHPExcel->mergeCells('AR' . $dtl_row2 . ':AT' . $dtl_row2)->setCellValue('AR' . $dtl_row2, $dt_larutan_pakai_shift_2[$b]);
                $objPHPExcel->mergeCells('AU' . $dtl_row2 . ':AW' . $dtl_row2)->setCellValue('AU' . $dtl_row2, $dt_larutan_stok_shift_2[$b]);

                $objPHPExcel->mergeCells('AX' . $dtl_row2 . ':AZ' . $dtl_row2)->setCellValue('AX' . $dtl_row2, $dt_baku_terima_shift_3[$b]);
                $objPHPExcel->mergeCells('BA' . $dtl_row2 . ':BC' . $dtl_row2)->setCellValue('BA' . $dtl_row2, $dt_baku_pakai_shift_3[$b]);
                $objPHPExcel->mergeCells('BD' . $dtl_row2 . ':BF' . $dtl_row2)->setCellValue('BD' . $dtl_row2, $dt_baku_stok_shift_3[$b]);
                $objPHPExcel->mergeCells('BG' . $dtl_row2 . ':BI' . $dtl_row2)->setCellValue('BG' . $dtl_row2, $dt_larutan_terima_shift_3[$b]);
                $objPHPExcel->mergeCells('BJ' . $dtl_row2 . ':BM' . $dtl_row2)->setCellValue('BJ' . $dtl_row2, $dt_larutan_pakai_shift_3[$b]);
                $objPHPExcel->mergeCells('BN' . $dtl_row2 . ':BO' . $dtl_row2)->setCellValue('BN' . $dtl_row2, $dt_larutan_stok_shift_3[$b]);
            }
            // end detail b

            // detail c

            $dtl_row3  = $dtl_row2+1;

            $objPHPExcel->mergeCells('A'  . ($dtl_row3) . ':AI' . ($dtl_row3))->setCellValue('A' .  ($dtl_row3), "Raw Water");
            $objPHPExcel->mergeCells('AJ'  . ($dtl_row3) . ':AQ' . ($dtl_row3))->setCellValue('AJ' .  ($dtl_row3), "BSF (M³)");
            $objPHPExcel->mergeCells('AR'  . ($dtl_row3) . ':BG' . ($dtl_row3))->setCellValue('AR' .  ($dtl_row3), "After Sand Filter (M³)");
            $objPHPExcel->mergeCells('BH'  . ($dtl_row3) . ':BO' . ($dtl_row3))->setCellValue('BH' .  ($dtl_row3), "ACF (M³)");

            $objPHPExcel->mergeCells('A'  . ($dtl_row3 + 1) . ':A' . ($dtl_row3 + 3))->setCellValue('A' .  ($dtl_row3 + 1), "Shift");

            $objPHPExcel->mergeCells('B'  . ($dtl_row3 + 1) . ':AE' . ($dtl_row3 + 1))->setCellValue('B' .  ($dtl_row3 + 1), "Sedimen");
            $objPHPExcel->mergeCells('B'  . ($dtl_row3 + 2) . ':D' . ($dtl_row3 + 2))->setCellValue('B' .  ($dtl_row3 + 2), "A1");
            $objPHPExcel->mergeCells('E'  . ($dtl_row3 + 2) . ':G' . ($dtl_row3 + 2))->setCellValue('E' .  ($dtl_row3 + 2), "A2");
            $objPHPExcel->mergeCells('H'  . ($dtl_row3 + 2) . ':J' . ($dtl_row3 + 2))->setCellValue('H' .  ($dtl_row3 + 2), "A3");
            $objPHPExcel->mergeCells('K'  . ($dtl_row3 + 2) . ':M' . ($dtl_row3 + 2))->setCellValue('K' .  ($dtl_row3 + 2), "A4");
            $objPHPExcel->mergeCells('N'  . ($dtl_row3 + 2) . ':P' . ($dtl_row3 + 2))->setCellValue('N' .  ($dtl_row3 + 2), "A5");
            $objPHPExcel->mergeCells('Q'  . ($dtl_row3 + 2) . ':S' . ($dtl_row3 + 2))->setCellValue('Q' .  ($dtl_row3 + 2), "A6");
            $objPHPExcel->mergeCells('T'  . ($dtl_row3 + 2) . ':U' . ($dtl_row3 + 2))->setCellValue('T' .  ($dtl_row3 + 2), "B1");
            $objPHPExcel->mergeCells('V'  . ($dtl_row3 + 2) . ':W' . ($dtl_row3 + 2))->setCellValue('V' .  ($dtl_row3 + 2), "B2");
            $objPHPExcel->mergeCells('X'  . ($dtl_row3 + 2) . ':Y' . ($dtl_row3 + 2))->setCellValue('X' .  ($dtl_row3 + 2), "B3");
            $objPHPExcel->mergeCells('Z'  . ($dtl_row3 + 2) . ':AA' . ($dtl_row3 + 2))->setCellValue('Z' .  ($dtl_row3 + 2), "B4");
            $objPHPExcel->mergeCells('AB'  . ($dtl_row3 + 2) . ':AC' . ($dtl_row3 + 2))->setCellValue('AB' .  ($dtl_row3 + 2), "B5");
            $objPHPExcel->mergeCells('AD'  . ($dtl_row3 + 2) . ':AE' . ($dtl_row3 + 2))->setCellValue('AD' .  ($dtl_row3 + 2), "B6");
            $objPHPExcel->mergeCells('B'  . ($dtl_row3 + 3) . ':D' . ($dtl_row3 + 3))->setCellValue('B' .  ($dtl_row3 + 3), "(1898)");
            $objPHPExcel->mergeCells('E'  . ($dtl_row3 + 3) . ':G' . ($dtl_row3 + 3))->setCellValue('E' .  ($dtl_row3 + 3), "(1998)");
            $objPHPExcel->mergeCells('H'  . ($dtl_row3 + 3) . ':J' . ($dtl_row3 + 3))->setCellValue('H' .  ($dtl_row3 + 3), "(1887)");
            $objPHPExcel->mergeCells('K'  . ($dtl_row3 + 3) . ':M' . ($dtl_row3 + 3))->setCellValue('K' .  ($dtl_row3 + 3), "(1963)");
            $objPHPExcel->mergeCells('N'  . ($dtl_row3 + 3) . ':P' . ($dtl_row3 + 3))->setCellValue('N' .  ($dtl_row3 + 3), "(2106)");
            $objPHPExcel->mergeCells('Q'  . ($dtl_row3 + 3) . ':S' . ($dtl_row3 + 3))->setCellValue('Q' .  ($dtl_row3 + 3), "(2015)");
            $objPHPExcel->mergeCells('T'  . ($dtl_row3 + 3) . ':U' . ($dtl_row3 + 3))->setCellValue('T' .  ($dtl_row3 + 3), "(1909)");
            $objPHPExcel->mergeCells('V'  . ($dtl_row3 + 3) . ':W' . ($dtl_row3 + 3))->setCellValue('V' .  ($dtl_row3 + 3), "(1900)");
            $objPHPExcel->mergeCells('X'  . ($dtl_row3 + 3) . ':Y' . ($dtl_row3 + 3))->setCellValue('X' .  ($dtl_row3 + 3), "(1900)");
            $objPHPExcel->mergeCells('Z'  . ($dtl_row3 + 3) . ':AA' . ($dtl_row3 + 3))->setCellValue('Z' .  ($dtl_row3 + 3), "(1752)");
            $objPHPExcel->mergeCells('AB'  . ($dtl_row3 + 3) . ':AC' . ($dtl_row3 + 3))->setCellValue('AB' .  ($dtl_row3 + 3), "(1357)");
            $objPHPExcel->mergeCells('AD'  . ($dtl_row3 + 3) . ':AE' . ($dtl_row3 + 3))->setCellValue('AD' .  ($dtl_row3 + 3), "(1632)");

            $objPHPExcel->mergeCells('AF'  . ($dtl_row3 + 1) . ':AI' . ($dtl_row3 + 1))->setCellValue('AF' .  ($dtl_row3 + 1), "Cone clarifier");
            $objPHPExcel->mergeCells('AF'  . ($dtl_row3 + 2) . ':AG' . ($dtl_row3 + 2))->setCellValue('AF' .  ($dtl_row3 + 2), "1-2");
            $objPHPExcel->mergeCells('AH'  . ($dtl_row3 + 2) . ':AI' . ($dtl_row3 + 2))->setCellValue('AH' .  ($dtl_row3 + 2), "3-4");
            $objPHPExcel->mergeCells('AF'  . ($dtl_row3 + 3) . ':AG' . ($dtl_row3 + 3))->setCellValue('AF' .  ($dtl_row3 + 3), "(600)");
            $objPHPExcel->mergeCells('AH'  . ($dtl_row3 + 3) . ':AI' . ($dtl_row3 + 3))->setCellValue('AH' .  ($dtl_row3 + 3), "(600)");

            $objPHPExcel->mergeCells('AJ'  . ($dtl_row3 + 1) . ':AM' . ($dtl_row3 + 1))->setCellValue('AJ' .  ($dtl_row3 + 1), "Sedimen");
            $objPHPExcel->mergeCells('AJ'  . ($dtl_row3 + 2) . ':AK' . ($dtl_row3 + 2))->setCellValue('AJ' .  ($dtl_row3 + 2), "C1");
            $objPHPExcel->mergeCells('AL'  . ($dtl_row3 + 2) . ':AM' . ($dtl_row3 + 2))->setCellValue('AL' .  ($dtl_row3 + 2), "C2");
            $objPHPExcel->mergeCells('AJ'  . ($dtl_row3 + 3) . ':AK' . ($dtl_row3 + 3))->setCellValue('AJ' .  ($dtl_row3 + 3), "(1080)");
            $objPHPExcel->mergeCells('AL'  . ($dtl_row3 + 3) . ':AM' . ($dtl_row3 + 3))->setCellValue('AL' .  ($dtl_row3 + 3), "(1215)");

            $objPHPExcel->mergeCells('AN'  . ($dtl_row3 + 1) . ':AQ' . ($dtl_row3 + 1))->setCellValue('AN' .  ($dtl_row3 + 1), "Bak");
            $objPHPExcel->mergeCells('AN'  . ($dtl_row3 + 2) . ':AO' . ($dtl_row3 + 2))->setCellValue('AN' .  ($dtl_row3 + 2), "V-Notch");
            $objPHPExcel->mergeCells('AP'  . ($dtl_row3 + 2) . ':AP' . ($dtl_row3 + 2))->setCellValue('AP' .  ($dtl_row3 + 2), "Recycle");
            $objPHPExcel->mergeCells('AQ'  . ($dtl_row3 + 2) . ':AQ' . ($dtl_row3 + 2))->setCellValue('AQ' .  ($dtl_row3 + 2), "CW");
            $objPHPExcel->mergeCells('AN'  . ($dtl_row3 + 3) . ':AO' . ($dtl_row3 + 3))->setCellValue('AN' .  ($dtl_row3 + 3), "(120)");
            $objPHPExcel->mergeCells('AP'  . ($dtl_row3 + 3) . ':AP' . ($dtl_row3 + 3))->setCellValue('AP' .  ($dtl_row3 + 3), "(200)");
            $objPHPExcel->mergeCells('AQ'  . ($dtl_row3 + 3) . ':AQ' . ($dtl_row3 + 3))->setCellValue('AQ' .  ($dtl_row3 + 3), "(180)");

            $objPHPExcel->mergeCells('AR'  . ($dtl_row3 + 1) . ':AS' . ($dtl_row3 + 2))->setCellValue('AR' .  ($dtl_row3 + 1), "ASF A");
            $objPHPExcel->mergeCells('AT'  . ($dtl_row3 + 1) . ':AU' . ($dtl_row3 + 2))->setCellValue('AT' .  ($dtl_row3 + 1), "ASF B");
            $objPHPExcel->mergeCells('AV'  . ($dtl_row3 + 1) . ':AW' . ($dtl_row3 + 2))->setCellValue('AV' .  ($dtl_row3 + 1), "ASF 1A");
            $objPHPExcel->mergeCells('AX'  . ($dtl_row3 + 1) . ':AY' . ($dtl_row3 + 2))->setCellValue('AX' .  ($dtl_row3 + 1), "ASF 1B");
            $objPHPExcel->mergeCells('AZ'  . ($dtl_row3 + 1) . ':BA' . ($dtl_row3 + 2))->setCellValue('AZ' .  ($dtl_row3 + 1), "Bak 2");
            $objPHPExcel->mergeCells('BB'  . ($dtl_row3 + 1) . ':BC' . ($dtl_row3 + 2))->setCellValue('BB' .  ($dtl_row3 + 1), "Bak 3");
            $objPHPExcel->mergeCells('BD'  . ($dtl_row3 + 1) . ':BE' . ($dtl_row3 + 2))->setCellValue('BD' .  ($dtl_row3 + 1), "Tower TBN");
            $objPHPExcel->mergeCells('BF'  . ($dtl_row3 + 1) . ':BG' . ($dtl_row3 + 2))->setCellValue('BF' .  ($dtl_row3 + 1), "Tower Mess");
            $objPHPExcel->mergeCells('AR'  . ($dtl_row3 + 3) . ':AS' . ($dtl_row3 + 3))->setCellValue('AR' .  ($dtl_row3 + 3), "(300)");
            $objPHPExcel->mergeCells('AT'  . ($dtl_row3 + 3) . ':AU' . ($dtl_row3 + 3))->setCellValue('AT' .  ($dtl_row3 + 3), "(175)");
            $objPHPExcel->mergeCells('AV'  . ($dtl_row3 + 3) . ':AW' . ($dtl_row3 + 3))->setCellValue('AV' .  ($dtl_row3 + 3), "(350)");
            $objPHPExcel->mergeCells('AX'  . ($dtl_row3 + 3) . ':AY' . ($dtl_row3 + 3))->setCellValue('AX' .  ($dtl_row3 + 3), "(94)");
            $objPHPExcel->mergeCells('AZ'  . ($dtl_row3 + 3) . ':BA' . ($dtl_row3 + 3))->setCellValue('AZ' .  ($dtl_row3 + 3), "(200)");
            $objPHPExcel->mergeCells('BB'  . ($dtl_row3 + 3) . ':BC' . ($dtl_row3 + 3))->setCellValue('BB' .  ($dtl_row3 + 3), "(180)");
            $objPHPExcel->mergeCells('BD'  . ($dtl_row3 + 3) . ':BE' . ($dtl_row3 + 3))->setCellValue('BD' .  ($dtl_row3 + 3), "(50)");
            $objPHPExcel->mergeCells('BF'  . ($dtl_row3 + 3) . ':BG' . ($dtl_row3 + 3))->setCellValue('BF' .  ($dtl_row3 + 3), "(50)");

            $objPHPExcel->mergeCells('BH'  . ($dtl_row3 + 1) . ':BI' . ($dtl_row3 + 2))->setCellValue('BH' .  ($dtl_row3 + 1), "ACF A");
            $objPHPExcel->mergeCells('BJ'  . ($dtl_row3 + 1) . ':BK' . ($dtl_row3 + 2))->setCellValue('BJ' .  ($dtl_row3 + 1), "ACF B");
            $objPHPExcel->mergeCells('BL'  . ($dtl_row3 + 1) . ':BM' . ($dtl_row3 + 2))->setCellValue('BL' .  ($dtl_row3 + 1), "Bak IV");
            $objPHPExcel->mergeCells('BN'  . ($dtl_row3 + 1) . ':BN' . ($dtl_row3 + 2))->setCellValue('BN' .  ($dtl_row3 + 1), "Bak CIP 1");
            $objPHPExcel->mergeCells('BO'  . ($dtl_row3 + 1) . ':BO' . ($dtl_row3 + 2))->setCellValue('BO' .  ($dtl_row3 + 1), "Bak CIP 2");
            $objPHPExcel->mergeCells('BH'  . ($dtl_row3 + 3) . ':BI' . ($dtl_row3 + 3))->setCellValue('BH' .  ($dtl_row3 + 3), "(150)");
            $objPHPExcel->mergeCells('BJ'  . ($dtl_row3 + 3) . ':BK' . ($dtl_row3 + 3))->setCellValue('BJ' .  ($dtl_row3 + 3), "(165)");
            $objPHPExcel->mergeCells('BL'  . ($dtl_row3 + 3) . ':BM' . ($dtl_row3 + 3))->setCellValue('BL' .  ($dtl_row3 + 3), "(180)");
            $objPHPExcel->mergeCells('BN'  . ($dtl_row3 + 3) . ':BN' . ($dtl_row3 + 3))->setCellValue('BN' .  ($dtl_row3 + 3), "(180)");
            $objPHPExcel->mergeCells('BO'  . ($dtl_row3 + 3) . ':BO' . ($dtl_row3 + 3))->setCellValue('BO' .  ($dtl_row3 + 3), "(90)");

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($dtl_row3 ) . ':BO' . ($dtl_row3 + 4));
            $objPHPExcel->getStyle('B' . ($dtl_row3 + 1) . ':BO' . ($dtl_row3 + 4))->getFont()->setBold(true);

            $dtl_row4 = $dtl_row3 + 3;

            for ($c = 0 ; $c < $tbl_max_c; $c++) {
                $dtl_row4++;

                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $dtl_row4 . ':BO' . $dtl_row4);
                $objPHPExcel->mergeCells('A'  . $dtl_row4 . ':A' .  $dtl_row4)->setCellValue('A' .   $dtl_row4, $shift_romawi[$shift[$c]]);
                $objPHPExcel->mergeCells('B'  . $dtl_row4 . ':D' . $dtl_row4)->setCellValue('B' .  $dtl_row4, $rw_sedimen_a1[$c]);
                $objPHPExcel->mergeCells('E'  . $dtl_row4 . ':G' . $dtl_row4)->setCellValue('E' .  $dtl_row4, $rw_sedimen_a2[$c]);
                $objPHPExcel->mergeCells('H'  . $dtl_row4 . ':J' . $dtl_row4)->setCellValue('H' .  $dtl_row4, $rw_sedimen_a3[$c]);
                $objPHPExcel->mergeCells('K'  . $dtl_row4 . ':M' . $dtl_row4)->setCellValue('K' .  $dtl_row4, $rw_sedimen_a4[$c]);
                $objPHPExcel->mergeCells('N'  . $dtl_row4 . ':P' . $dtl_row4)->setCellValue('N' .  $dtl_row4, $rw_sedimen_a5[$c]);
                $objPHPExcel->mergeCells('Q'  . $dtl_row4 . ':S' . $dtl_row4)->setCellValue('Q' .  $dtl_row4, $rw_sedimen_a6[$c]);
                $objPHPExcel->mergeCells('T'  . $dtl_row4 . ':U' . $dtl_row4)->setCellValue('T' .  $dtl_row4, $rw_sedimen_b1[$c]);
                $objPHPExcel->mergeCells('V'  . $dtl_row4 . ':W' . $dtl_row4)->setCellValue('V' .  $dtl_row4, $rw_sedimen_b2[$c]);
                $objPHPExcel->mergeCells('X'  . $dtl_row4 . ':Y' . $dtl_row4)->setCellValue('X' .  $dtl_row4, $rw_sedimen_b3[$c]);
                $objPHPExcel->mergeCells('Z'  . $dtl_row4 . ':AA' . $dtl_row4)->setCellValue('Z' .  $dtl_row4, $rw_sedimen_b4[$c]);
                $objPHPExcel->mergeCells('AB'  . $dtl_row4 . ':AC' . $dtl_row4)->setCellValue('AB' .  $dtl_row4, $rw_sedimen_b5[$c]);
                $objPHPExcel->mergeCells('AD'  . $dtl_row4 . ':AE' . $dtl_row4)->setCellValue('AD' .  $dtl_row4, $rw_sedimen_b6[$c]);
                $objPHPExcel->mergeCells('AF'  . $dtl_row4 . ':AG' . $dtl_row4)->setCellValue('AF' .  $dtl_row4, $rw_cone_clarifier_1_2[$c]);
                $objPHPExcel->mergeCells('AH'  . $dtl_row4 . ':AI' . $dtl_row4)->setCellValue('AH' .  $dtl_row4, $rw_cone_clarifier_3_4[$c]);
                $objPHPExcel->mergeCells('AJ'  . $dtl_row4 . ':AK' . $dtl_row4)->setCellValue('AJ' .  $dtl_row4, $bsf_sedimen_c1[$c]);
                $objPHPExcel->mergeCells('AL'  . $dtl_row4 . ':AM' . $dtl_row4)->setCellValue('AL' .  $dtl_row4, $bsf_sedimen_c2[$c]);
                $objPHPExcel->mergeCells('AN'  . $dtl_row4 . ':AO' . $dtl_row4)->setCellValue('AN' .  $dtl_row4, $bsf_bak_v_notch[$c]);
                $objPHPExcel->mergeCells('AP'  . $dtl_row4 . ':AP' . $dtl_row4)->setCellValue('AP' .  $dtl_row4, $bsf_bak_reyclce[$c]);
                $objPHPExcel->mergeCells('AQ'  . $dtl_row4 . ':AQ' . $dtl_row4)->setCellValue('AQ' .  $dtl_row4, $bsf_bak_cw[$c]);
                $objPHPExcel->mergeCells('AR'  . $dtl_row4 . ':AS' . $dtl_row4)->setCellValue('AR' .  $dtl_row4, $asf_asf_a[$c]);
                $objPHPExcel->mergeCells('AT'  . $dtl_row4 . ':AU' . $dtl_row4)->setCellValue('AT' .  $dtl_row4, $asf_asf_b[$c]);
                $objPHPExcel->mergeCells('AV'  . $dtl_row4 . ':AW' . $dtl_row4)->setCellValue('AV' .  $dtl_row4, $asf_asf_1a[$c]);
                $objPHPExcel->mergeCells('AX'  . $dtl_row4 . ':AY' . $dtl_row4)->setCellValue('AX' .  $dtl_row4, $asf_asf_1b[$c]);
                $objPHPExcel->mergeCells('AZ'  . $dtl_row4 . ':BA' . $dtl_row4)->setCellValue('AZ' .  $dtl_row4, $asf_bak_2[$c]);
                $objPHPExcel->mergeCells('BB'  . $dtl_row4 . ':BC' . $dtl_row4)->setCellValue('BB' .  $dtl_row4, $asf_bak_3[$c]);
                $objPHPExcel->mergeCells('BD'  . $dtl_row4 . ':BE' . $dtl_row4)->setCellValue('BD' .  $dtl_row4, $asf_tower_tbn[$c]);
                $objPHPExcel->mergeCells('BF'  . $dtl_row4 . ':BG' . $dtl_row4)->setCellValue('BF' .  $dtl_row4, $asf_tower_mess[$c]);
                $objPHPExcel->mergeCells('BH'  . $dtl_row4 . ':BI' . $dtl_row4)->setCellValue('BH' .  $dtl_row4, $acf_acf_a[$c]);
                $objPHPExcel->mergeCells('BJ'  . $dtl_row4 . ':BK' . $dtl_row4)->setCellValue('BJ' .  $dtl_row4, $acf_acf_b[$c]);
                $objPHPExcel->mergeCells('BL'  . $dtl_row4 . ':BM' . $dtl_row4)->setCellValue('BL' .  $dtl_row4, $acf_bak_iv[$c]);
                $objPHPExcel->mergeCells('BN'  . $dtl_row4 . ':BN' . $dtl_row4)->setCellValue('BN' .  $dtl_row4, $acf_bak_cip_1[$c]);
                $objPHPExcel->mergeCells('BO'  . $dtl_row4 . ':BO' . $dtl_row4)->setCellValue('BO' .  $dtl_row4, $acf_bak_cip_2[$c]);
            }

            
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($dtl_row4 + 1) . ':BO' . ($dtl_row4 + 6));

            $objPHPExcel->mergeCells('A'  . ($dtl_row4 + 1) . ':A' . ($dtl_row4 + 3))->setCellValue('A' .  ($dtl_row4 + 1), "Shift");

            $objPHPExcel->mergeCells('B'  . ($dtl_row4 + 1) . ':J' . ($dtl_row4 + 1))->setCellValue('B' .  ($dtl_row4 + 1), "AST (M³)");
            $objPHPExcel->mergeCells('B'  . ($dtl_row4 + 2) . ':D' . ($dtl_row4 + 2))->setCellValue('B' .  ($dtl_row4 + 2), "AST");
            $objPHPExcel->mergeCells('E'  . ($dtl_row4 + 2) . ':G' . ($dtl_row4 + 2))->setCellValue('E' .  ($dtl_row4 + 2), "Bak Demin");
            $objPHPExcel->mergeCells('H'  . ($dtl_row4 + 2) . ':J' . ($dtl_row4 + 2))->setCellValue('H' .  ($dtl_row4 + 2), "Tangki ST Mes");
            $objPHPExcel->mergeCells('B'  . ($dtl_row4 + 3) . ':D' . ($dtl_row4 + 3))->setCellValue('B' .  ($dtl_row4 + 3), "(150)");
            $objPHPExcel->mergeCells('E'  . ($dtl_row4 + 3) . ':G' . ($dtl_row4 + 3))->setCellValue('E' .  ($dtl_row4 + 3), "(90)");
            $objPHPExcel->mergeCells('H'  . ($dtl_row4 + 3) . ':J' . ($dtl_row4 + 3))->setCellValue('H' .  ($dtl_row4 + 3), "(20)");

            $objPHPExcel->mergeCells('K'  . ($dtl_row4 + 1) . ':S' . ($dtl_row4 + 1))->setCellValue('K' .  ($dtl_row4 + 1), "ARO (M³)");
            $objPHPExcel->mergeCells('K'  . ($dtl_row4 + 2) . ':M' . ($dtl_row4 + 2))->setCellValue('K' .  ($dtl_row4 + 2), "Tangki RO Mes");
            $objPHPExcel->mergeCells('N'  . ($dtl_row4 + 2) . ':P' . ($dtl_row4 + 2))->setCellValue('N' .  ($dtl_row4 + 2), "Tangki RO");
            $objPHPExcel->mergeCells('Q'  . ($dtl_row4 + 2) . ':S' . ($dtl_row4 + 2))->setCellValue('Q' .  ($dtl_row4 + 2), "RO WTP");
            $objPHPExcel->mergeCells('K'  . ($dtl_row4 + 3) . ':M' . ($dtl_row4 + 3))->setCellValue('K' .  ($dtl_row4 + 3), "(10)");
            $objPHPExcel->mergeCells('N'  . ($dtl_row4 + 3) . ':P' . ($dtl_row4 + 3))->setCellValue('N' .  ($dtl_row4 + 3), "(60)");
            $objPHPExcel->mergeCells('Q'  . ($dtl_row4 + 3) . ':S' . ($dtl_row4 + 3))->setCellValue('Q' .  ($dtl_row4 + 3), "(75)");
            
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($dtl_row4 + 1) . ':S' . ($dtl_row4 + 6));

            $dtl_row5 = $dtl_row4 + 3;

            for ($d = 0 ; $d < $tbl_max_c; $d++) {
                $dtl_row5++;

                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $dtl_row5 . ':S' . $dtl_row5);
                $objPHPExcel->mergeCells('A'  . $dtl_row5 . ':A' .  $dtl_row5)->setCellValue('A' .   $dtl_row5, $shift_romawi[$shift[$d]]);
                $objPHPExcel->mergeCells('B'  . $dtl_row5 . ':D' . $dtl_row5)->setCellValue('B' .  $dtl_row5, $ast_ast[$d]);
                $objPHPExcel->mergeCells('E'  . $dtl_row5 . ':G' . $dtl_row5)->setCellValue('E' .  $dtl_row5, $ast_bak_demin[$d]);
                $objPHPExcel->mergeCells('H'  . $dtl_row5 . ':J' . $dtl_row5)->setCellValue('H' .  $dtl_row5, $ast_tangki_st_mes[$d]);
                $objPHPExcel->mergeCells('K'  . $dtl_row5 . ':M' . $dtl_row5)->setCellValue('K' .  $dtl_row5, $aro_tangki_ro_mes[$d]);
                $objPHPExcel->mergeCells('N'  . $dtl_row5 . ':P' . $dtl_row5)->setCellValue('N' .  $dtl_row5, $aro_tangki_ro[$d]);
                $objPHPExcel->mergeCells('Q'  . $dtl_row5 . ':S' . $dtl_row5)->setCellValue('Q' .  $dtl_row5, $aro_ro_wtp[$d]);
            }

            // end detail c

            // detail d
            $dtl_row6 = $dtl_row5-5;
            for ($e = 0; $e < count($dtdetail_d); $e++) {
                $dtl_row6++;
                $objPHPExcel->mergeCells('U' .  $dtl_row6 . ':AA' .  ($dtl_row6 + 1))->setCellValue('U' .  $dtl_row6, $drain[$e]);
            }

            // end detail d

            $objPHPExcel->mergeCells('U' .  ($dtl_row5 + -5) . ':AY' .  ($dtl_row5 + -5))->setCellValue('U' .  ($dtl_row5 + -5), "Remark : ".$remark);

            // definisi
            $definisi = $dtl_row5 - 3;
            $objPHPExcel->mergeCells('U' . ($definisi + 1) . ':X' . ($definisi + 1))->setCellValue('U' . ($definisi + 1), "Definisi :");
            $objPHPExcel->mergeCells('Y' . ($definisi + 1) . ':AA' . ($definisi + 1))->setCellValue('Y' . ($definisi + 1), "WTD");
            $objPHPExcel->mergeCells('AB' . ($definisi + 1) . ':AJ' . ($definisi + 1))->setCellValue('AB' . ($definisi + 1), ": Water Treatment");
            $objPHPExcel->mergeCells('AK' . ($definisi + 1) . ':AL' . ($definisi + 1))->setCellValue('AK' . ($definisi + 1), "ASF");
            $objPHPExcel->mergeCells('AM' . ($definisi + 1) . ':AS' . ($definisi + 1))->setCellValue('AM' . ($definisi + 1), ": After Sand Filter");
            $objPHPExcel->mergeCells('AT' . ($definisi + 1) . ':AU' . ($definisi + 1))->setCellValue('AT' . ($definisi + 1), "Kg");
            $objPHPExcel->mergeCells('AV' . ($definisi + 1) . ':BC' . ($definisi + 1))->setCellValue('AV' . ($definisi + 1), ": Kilo Gram");
            $objPHPExcel->mergeCells('BD' . ($definisi + 1) . ':BE' . ($definisi + 1))->setCellValue('BD' . ($definisi + 1), "ACH");
            $objPHPExcel->mergeCells('BF' . ($definisi + 1) . ':BO' . ($definisi + 1))->setCellValue('BF' . ($definisi + 1), ": Alumunium Chloro Hydrate");

            $objPHPExcel->mergeCells('Y' . ($definisi + 2) . ':AA' . ($definisi + 2))->setCellValue('Y' . ($definisi + 2), "M3");
            $objPHPExcel->mergeCells('AB' . ($definisi + 2) . ':AJ' . ($definisi + 2))->setCellValue('AB' . ($definisi + 2), ": Meter kubik");
            $objPHPExcel->mergeCells('AK' . ($definisi + 2) . ':AL' . ($definisi + 2))->setCellValue('AK' . ($definisi + 2), "ACF");
            $objPHPExcel->mergeCells('AM' . ($definisi + 2) . ':AS' . ($definisi + 2))->setCellValue('AM' . ($definisi + 2), ": After Carbon Filter");
            $objPHPExcel->mergeCells('AT' . ($definisi + 2) . ':AU' . ($definisi + 2))->setCellValue('AT' . ($definisi + 2), "AST");
            $objPHPExcel->mergeCells('AV' . ($definisi + 2) . ':BC' . ($definisi + 2))->setCellValue('AV' . ($definisi + 2), ": After Water Softener");
            $objPHPExcel->mergeCells('BD' . ($definisi + 2) . ':BE' . ($definisi + 2))->setCellValue('BD' . ($definisi + 2), "BSF");
            $objPHPExcel->mergeCells('BF' . ($definisi + 2) . ':BO' . ($definisi + 2))->setCellValue('BF' . ($definisi + 2), ": Before Sand Filter");

            $objPHPExcel->mergeCells('Y' . ($definisi + 3) . ':AA' . ($definisi + 3))->setCellValue('Y' . ($definisi + 3), "FM");
            $objPHPExcel->mergeCells('AB' . ($definisi + 3) . ':AJ' . ($definisi + 3))->setCellValue('AB' . ($definisi + 3), ": Flow Meter");
            $objPHPExcel->mergeCells('AK' . ($definisi + 3) . ':AL' . ($definisi + 3))->setCellValue('AK' . ($definisi + 3), "ARO");
            $objPHPExcel->mergeCells('AM' . ($definisi + 3) . ':AS' . ($definisi + 3))->setCellValue('AM' . ($definisi + 3), ": After Reverse Osmosis");
            $objPHPExcel->mergeCells('AT' . ($definisi + 3) . ':AU' . ($definisi + 3))->setCellValue('AT' . ($definisi + 3), "MC");
            $objPHPExcel->mergeCells('AV' . ($definisi + 3) . ':BC' . ($definisi + 3))->setCellValue('AV' . ($definisi + 3), ": Membran Cleaner");

            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'BP' . ($dtl_row4 + 1) . ':BP' . ($definisi + 4));

            // end definisi

            // approval
            $app_row  = $definisi + 3;

            $objPHPExcel->mergeCells('A' . ($app_row + 2) . ':R' . ($app_row + 2))->setCellValue('A' . ($app_row + 2), "Dibuat Oleh Shift I");
            $objPHPExcel->mergeCells('A' . ($app_row + 3) . ':R' . ($app_row + 6))->setCellValue('A' . ($app_row + 3), '');
            // $objPHPExcel->mergeCells('M' . ($app_row + 2) . ':X' . ($app_row + 2))->setCellValue('M' . ($app_row + 2), "Dicek Oleh Shift I");
            // $objPHPExcel->mergeCells('M' . ($app_row + 3) . ':X' . ($app_row + 6))->setCellValue('M' . ($app_row + 3), '');
            $objPHPExcel->mergeCells('S' . ($app_row + 2) . ':AF' . ($app_row + 2))->setCellValue('S' . ($app_row + 2), "Dibuat Oleh Shift II");
            $objPHPExcel->mergeCells('S' . ($app_row + 3) . ':AF' . ($app_row + 6))->setCellValue('S' . ($app_row + 3), '');
            // $objPHPExcel->mergeCells('AG' . ($app_row + 2) . ':AN' . ($app_row + 2))->setCellValue('AG' . ($app_row + 2), "Dicek Oleh Shift II");
            // $objPHPExcel->mergeCells('AG' . ($app_row + 3) . ':AN' . ($app_row + 6))->setCellValue('AG' . ($app_row + 3), '');
            $objPHPExcel->mergeCells('AG' . ($app_row + 2) . ':AP' . ($app_row + 2))->setCellValue('AG' . ($app_row + 2), "Dibuat Oleh Shift III");
            $objPHPExcel->mergeCells('AG' . ($app_row + 3) . ':AP' . ($app_row + 6))->setCellValue('AG' . ($app_row + 3), '');
            $objPHPExcel->mergeCells('AQ' . ($app_row + 2) . ':BB' . ($app_row + 2))->setCellValue('AQ' . ($app_row + 2), "Diketahui oleh,");
            $objPHPExcel->mergeCells('AQ' . ($app_row + 3) . ':BB' . ($app_row + 6))->setCellValue('AQ' . ($app_row + 3), '');
            $objPHPExcel->mergeCells('BC' . ($app_row + 2) . ':BO' . ($app_row + 2))->setCellValue('BC' . ($app_row + 2), "Disetujui Oleh");
            $objPHPExcel->mergeCells('BC' . ($app_row + 3) . ':BO' . ($app_row + 6))->setCellValue('BC' . ($app_row + 3), '');

            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($app_row+1) . ':BO' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyle, 'A' . ($app_row + 2) . ':BO' . ($app_row + 2));
            $objPHPExcel->setSharedStyle($bodyStyle, 'A' . ($app_row + 3) . ':BO' . ($app_row + 6));

            // tabel app 1
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
                    $sign_img->setCoordinates('E' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                        $sign_img = new PHPExcel_Worksheet_Drawing();
                        $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                        $sign_img->setWidthAndHeight(135, 135);
                        $sign_img->setResizeProportional(true);
                        $sign_img->setWorksheet($objPHPExcel);
                        $sign_img->setCoordinates('E' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                    
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('E' . ($app_row + 3));
                }
            }

            // tabel app 2
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
                    $sign_img->setCoordinates('W' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                        $sign_img2 = new PHPExcel_Worksheet_Drawing();
                        $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                        $sign_img2->setWidthAndHeight(135, 135);
                        $sign_img2->setResizeProportional(true);
                        $sign_img2->setWorksheet($objPHPExcel);
                        $sign_img2->setCoordinates('W' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                    
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('W' . ($app_row + 3));
                }
            }

            // tabel app 3
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

            $sign_img2 = '$objDrawing' . $i1;
            if (isset($app3_by)) {
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app3_personalstatus . '_' . $app3_personalid . '.png')) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $app3_personalstatus . '_' . $app3_personalid . '.png');
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AJ' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                        $sign_img2 = new PHPExcel_Worksheet_Drawing();
                        $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                        $sign_img2->setWidthAndHeight(135, 135);
                        $sign_img2->setResizeProportional(true);
                        $sign_img2->setWorksheet($objPHPExcel);
                        $sign_img2->setCoordinates('AJ' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                    
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AJ' . ($app_row + 3));
                }
            }

            // tabel app 4
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
                    $sign_img->setCoordinates('AT' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else if ($app4_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4)) {
                        $sign_img4 = new PHPExcel_Worksheet_Drawing();
                        $sign_img4->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4);
                        $sign_img4->setWidthAndHeight(135, 135);
                        $sign_img4->setResizeProportional(true);
                        $sign_img4->setWorksheet($objPHPExcel);
                        $sign_img4->setCoordinates('AT' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                    
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AT' . ($app_row + 3));
                }
            }

            // tabel app 5
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
                    $sign_img->setCoordinates('BG' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else  if ($app5_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp5 . $app5_personalid . $imageformatapp5)) {
                        $sign_img5 = new PHPExcel_Worksheet_Drawing();
                        $sign_img5->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp5 . $app5_personalid . $imageformatapp5);
                        $sign_img5->setWidthAndHeight(135, 135);
                        $sign_img5->setResizeProportional(true);
                        $sign_img5->setWorksheet($objPHPExcel);
                        $sign_img5->setCoordinates('BG' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                    
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('BG' . ($app_row + 3));
                }
            }


            // if ($app6_personalstatus == '2') {
            //     $imageurlapp6 = '/forviewfoto_pekerja/TTD_TK/';
            //     $imageformatapp6 = '.png';
            // } else if ($app6_personalstatus == '1') {
            //     $imageurlapp6 = '/forviewfoto_pekerja/';
            //     $imageformatapp6 = '_0_0.png';
            // } else {
            //     $imageurlapp6 = '';
            //     $imageformatapp6 = '';
            // }

            // $sign_img6 = '$objDrawing' . $i1;
            // if (isset($app6_by)) {
            //     if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app6_personalstatus . '_' . $app6_personalid . '.png')) {
            //         $sign_img = new PHPExcel_Worksheet_Drawing();
            //         $sign_img->setPath('assets/ttd/' . $app6_personalstatus . '_' . $app6_personalid . '.png');
            //         $sign_img->setWidthAndHeight(135, 135);
            //         $sign_img->setResizeProportional(true);
            //         $sign_img->setWorksheet($objPHPExcel);
            //         $sign_img->setCoordinates('AZ' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
            //     } else {
            //         if ($app6_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp6 . $app6_personalid . $imageformatapp6)) {
            //             $sign_img6 = new PHPExcel_Worksheet_Drawing();
            //             $sign_img6->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp6 . $app6_personalid . $imageformatapp6);
            //             $sign_img6->setWidthAndHeight(135, 135);
            //             $sign_img6->setResizeProportional(true);
            //             $sign_img6->setWorksheet($objPHPExcel);
            //             $sign_img6->setCoordinates('AZ' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
            //         }
            //     }
            // }


            // if ($app7_personalstatus == '2') {
            //     $imageurlapp7 = '/forviewfoto_pekerja/TTD_TK/';
            //     $imageformatapp7 = '.png';
            // } else if ($app7_personalstatus == '1') {
            //     $imageurlapp7 = '/forviewfoto_pekerja/';
            //     $imageformatapp7 = '_0_0.png';
            // } else {
            //     $imageurlapp7 = '';
            //     $imageformatapp7 = '';
            // }

            // $sign_img7 = '$objDrawing' . $i1;
            // if (isset($app7_by)) {
            //     if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app7_personalstatus . '_' . $app7_personalid . '.png')) {
            //         $sign_img = new PHPExcel_Worksheet_Drawing();
            //         $sign_img->setPath('assets/ttd/' . $app7_personalstatus . '_' . $app7_personalid . '.png');
            //         $sign_img->setWidthAndHeight(135, 135);
            //         $sign_img->setResizeProportional(true);
            //         $sign_img->setWorksheet($objPHPExcel);
            //         $sign_img->setCoordinates('BJ' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
            //     } else {
            //         if ($app7_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp7 . $app7_personalid . $imageformatapp7)) {
            //             $sign_img7 = new PHPExcel_Worksheet_Drawing();
            //             $sign_img7->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp7 . $app7_personalid . $imageformatapp7);
            //             $sign_img7->setWidthAndHeight(135, 135);
            //             $sign_img7->setResizeProportional(true);
            //             $sign_img7->setWorksheet($objPHPExcel);
            //             $sign_img7->setCoordinates('BJ' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
            //         }
            //     }
            // }

            $objPHPExcel->mergeCells('A' . ($app_row + 7) . ':C' . ($app_row + 7))->setCellValue('A' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('F' . ($app_row + 7) . ':R' . ($app_row + 7))->setCellValue('F' . ($app_row + 7), ': ' . $app1_by);
            $objPHPExcel->mergeCells('A' . ($app_row + 8) . ':C' . ($app_row + 8))->setCellValue('A' . ($app_row + 8), 'Kabatan');
            $objPHPExcel->mergeCells('F' . ($app_row + 8) . ':R' . ($app_row + 8))->setCellValue('F' . ($app_row + 8), ': ' . $app1_position);
            $objPHPExcel->mergeCells('A' . ($app_row + 9) . ':C' . ($app_row + 9))->setCellValue('A' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('F' . ($app_row + 9) . ':R' . ($app_row + 9))->setCellValue('F' . ($app_row + 9), ': ' . $app1date);

            // $objPHPExcel->mergeCells('S' . ($app_row + 7) . ':P' . ($app_row + 7))->setCellValue('S' . ($app_row + 7), 'Nama');
            // $objPHPExcel->mergeCells('Q' . ($app_row + 7) . ':AF' . ($app_row + 7))->setCellValue('Q' . ($app_row + 7), ': ' . $app2_by);
            // $objPHPExcel->mergeCells('S' . ($app_row + 8) . ':P' . ($app_row + 8))->setCellValue('S' . ($app_row + 8), 'Jabatan');
            // $objPHPExcel->mergeCells('Q' . ($app_row + 8) . ':AF' . ($app_row + 8))->setCellValue('Q' . ($app_row + 8), ': ' . $app2_position);
            // $objPHPExcel->mergeCells('S' . ($app_row + 9) . ':P' . ($app_row + 9))->setCellValue('S' . ($app_row + 9), 'Tanggal');
            // $objPHPExcel->mergeCells('Q' . ($app_row + 9) . ':AF' . ($app_row + 9))->setCellValue('Q' . ($app_row + 9), ': ' . $app2date);

            $objPHPExcel->mergeCells('S' . ($app_row + 7) . ':U' . ($app_row + 7))->setCellValue('S' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('V' . ($app_row + 7) . ':AF' . ($app_row + 7))->setCellValue('V' . ($app_row + 7), ': ' . $app2_by);
            $objPHPExcel->mergeCells('S' . ($app_row + 8) . ':U' . ($app_row + 8))->setCellValue('S' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('V' . ($app_row + 8) . ':AF' . ($app_row + 8))->setCellValue('V' . ($app_row + 8), ': ' . $app2_position);
            $objPHPExcel->mergeCells('S' . ($app_row + 9) . ':U' . ($app_row + 9))->setCellValue('S' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('V' . ($app_row + 9) . ':AF' . ($app_row + 9))->setCellValue('V' . ($app_row + 9), ': ' . $app2date);

            // $objPHPExcel->mergeCells('AG' . ($app_row + 7) . ':AI' . ($app_row + 7))->setCellValue('AG' . ($app_row + 7), 'Nama');
            // $objPHPExcel->mergeCells('AJ' . ($app_row + 7) . ':AN' . ($app_row + 7))->setCellValue('AJ' . ($app_row + 7), ': ' . $app4_by);
            // $objPHPExcel->mergeCells('AG' . ($app_row + 8) . ':AI' . ($app_row + 8))->setCellValue('AG' . ($app_row + 8), 'Jabatan');
            // $objPHPExcel->mergeCells('AJ' . ($app_row + 8) . ':AN' . ($app_row + 8))->setCellValue('AJ' . ($app_row + 8), ': ' . $app4_position);
            // $objPHPExcel->mergeCells('AG' . ($app_row + 9) . ':AI' . ($app_row + 9))->setCellValue('AG' . ($app_row + 9), 'Tanggal');
            // $objPHPExcel->mergeCells('AJ' . ($app_row + 9) . ':AN' . ($app_row + 9))->setCellValue('AJ' . ($app_row + 9), ': ' . $app4date);

            $objPHPExcel->mergeCells('AG' . ($app_row + 7) . ':AI' . ($app_row + 7))->setCellValue('AG' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 7) . ':AP' . ($app_row + 7))->setCellValue('AJ' . ($app_row + 7), ': ' . $app3_by);
            $objPHPExcel->mergeCells('AG' . ($app_row + 8) . ':AI' . ($app_row + 8))->setCellValue('AG' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 8) . ':AP' . ($app_row + 8))->setCellValue('AJ' . ($app_row + 8), ': ' . $app3_position);
            $objPHPExcel->mergeCells('AG' . ($app_row + 9) . ':AI' . ($app_row + 9))->setCellValue('AG' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 9) . ':AP' . ($app_row + 9))->setCellValue('AJ' . ($app_row + 9), ': ' . $app3date);


            $objPHPExcel->mergeCells('AQ' . ($app_row + 7) . ':AR' . ($app_row + 7))->setCellValue('AQ' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('AS' . ($app_row + 7) . ':BB' . ($app_row + 7))->setCellValue('AS' . ($app_row + 7), ': ' . $app4_by);
            $objPHPExcel->mergeCells('AQ' . ($app_row + 8) . ':AR' . ($app_row + 8))->setCellValue('AQ' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('AS' . ($app_row + 8) . ':BB' . ($app_row + 8))->setCellValue('AS' . ($app_row + 8), ': ' . $app4_position);
            $objPHPExcel->mergeCells('AQ' . ($app_row + 9) . ':AR' . ($app_row + 9))->setCellValue('AQ' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('AS' . ($app_row + 9) . ':BB' . ($app_row + 9))->setCellValue('AS' . ($app_row + 9), ': ' . $app4date);

            $objPHPExcel->mergeCells('BC' . ($app_row + 7) . ':BE' . ($app_row + 7))->setCellValue('BC' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('BF' . ($app_row + 7) . ':BO' . ($app_row + 7))->setCellValue('BF' . ($app_row + 7), ': ' . $app5_by);
            $objPHPExcel->mergeCells('BC' . ($app_row + 8) . ':BE' . ($app_row + 8))->setCellValue('BC' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('BF' . ($app_row + 8) . ':BO' . ($app_row + 8))->setCellValue('BF' . ($app_row + 8), ': ' . $app5_position);
            $objPHPExcel->mergeCells('BC' . ($app_row + 9) . ':BE' . ($app_row + 9))->setCellValue('BC' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('BF' . ($app_row + 9) . ':BO' . ($app_row + 9))->setCellValue('BF' . ($app_row + 9), ': ' . $app5date);

            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($app_row + 7) . ':BO' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'S' . ($app_row + 7) . ':S' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AG' . ($app_row + 7) . ':AG' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AQ' . ($app_row + 7) . ':AQ' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'BC' . ($app_row + 7) . ':BC' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AW' . ($app_row + 7) . ':AW' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'BP' . ($app_row + 7) . ':BP' . ($app_row + 9));

            // end approva;

            // footer
            $footer = $app_row + 9;
            $objPHPExcel->mergeCells('A' . ($footer + 1) . ':Q' . ($footer + 1))->setCellValue('A' . ($footer + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('R' . ($footer + 1) . ':BO' . ($footer + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($footer + 1) . ':BO' . ($footer + 1))->setCellValue('R' . ($footer + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($footer + 1) . ':Q' . ($footer + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($footer + 1) . ':BO' . ($footer + 1));
            $objPHPExcel->setBreak('A' . ($footer + 1),  PHPExcel_Worksheet::BREAK_ROW);

            //end footer
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
