<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_intwtd023_00 extends CI_Controller
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
        ///load  excel ////
        $this->xls            = new exelstyles();
        $this->spreadsheet    = new Excel();
        $this->sheet          = $this->spreadsheet->getActiveSheet();
        ///end load excel///
    }

    function cellColor($cells, $color)
    {
        global $objPHPExcel;

        $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => $color
            )
        ));
    }
    function exportxls()
    {
        // Get dtheader
        $frmkode                  = $this->uri->segment(4);
        $frmvrs                   = $this->uri->segment(5);
        $this->header_id          = $this->uri->segment(6);
        $dtfrm                    = $this->M_forminput->get_dtform($frmkode, $frmvrs);

        foreach ($dtfrm as $datafrm) {
            $this->frmkd          = $datafrm->formkd;
            $this->frmjdl         = $datafrm->formjudul;
            $this->frmnm          = $datafrm->formnm;
            $this->frmver         = $datafrm->formversi;
            $this->frmefective    = date("d-m-Y", strtotime($datafrm->formefective));
        }

        $dtheader = $this->M_formintwtd023_00->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date          = $dtheaderrow->create_date; //2021-02-08

            $create_date            = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno                  = $dtheaderrow->docno;
            $date_before            = date("m-Y", strtotime($dtheaderrow->date_before.'-01'));
            $date_today             = date("m-Y", strtotime($dtheaderrow->date_today.'-01'));
            $date_next              = date("m-Y", strtotime($dtheaderrow->date_next.'-01'));

            $app1_by                = $dtheaderrow->app1_by;
            $app2_by                = $dtheaderrow->app2_by;
            $app3_by                = $dtheaderrow->app3_by;

            $app1_position          = $dtheaderrow->app1_position;
            $app2_position          = $dtheaderrow->app2_position;
            $app3_position          = $dtheaderrow->app3_position;

            $app1_personalid        = $dtheaderrow->app1_personalid;
            $app2_personalid        = $dtheaderrow->app2_personalid;
            $app3_personalid        = $dtheaderrow->app3_personalid;

            $app1_personalstatus    = $dtheaderrow->app1_personalstatus;
            $app2_personalstatus    = $dtheaderrow->app2_personalstatus;
            $app3_personalstatus    = $dtheaderrow->app3_personalstatus;

            $app1date               = $dtheaderrow->app1_date;
            $app2date               = $dtheaderrow->app2_date;
            $app3date               = $dtheaderrow->app3_date;

            if (trim($dtheaderrow->app1_date) != '') {
                $app1date       = date('d-m-Y', strtotime($dtheaderrow->app1_date));
            } else {
                $app1date = '';
            }

            if (trim($dtheaderrow->app2_date) != '') {
                $app2date       = date('d-m-Y', strtotime($dtheaderrow->app2_date));
            } else {
                $app2date = '';
            }

            if (trim($dtheaderrow->app3_date) != '') {
                $app3date       = date('d-m-Y', strtotime($dtheaderrow->app3_date));
            } else {
                $app3date = '';
            }
        }
        //end Get dtheader

        if ($this->cekLevelUserNm == 'Auditor') {
            $dtdetail         = $this->M_formintwtd023_00->get_detail_byidx($this->header_id);
        } else {
            $dtdetail         = $this->M_formintwtd023_00->get_detail_byid($this->header_id);
        }

        //detail a
        if (isset($dtdetail)) {
            foreach ($dtdetail as $dtdetail_row) {
                $arr_dtl_a_definisi_1[]               = $dtdetail_row->dtl_a_definisi_1;
                $arr_dtl_a_definisi_2[]               = $dtdetail_row->dtl_a_definisi_2;
                $arr_dtl_a_definisi_3[]               = $dtdetail_row->dtl_a_definisi_3;
                $arr_dtl_a_realisai_before[]          = $dtdetail_row->dtl_a_realisai_before;
                $arr_dtl_a_realisai_persen_before[]   = $dtdetail_row->dtl_a_realisai_persen_before;
                $arr_dtl_a_target_today[]             = $dtdetail_row->dtl_a_target_today;
                $arr_dtl_a_target_persen_today[]      = $dtdetail_row->dtl_a_target_persen_today;
                $arr_dtl_a_realisai_today[]           = $dtdetail_row->dtl_a_realisai_today;
                $arr_dtl_a_realisai_persen_today[]    = $dtdetail_row->dtl_a_realisai_persen_today;
                $arr_dtl_a_target_next[]              = $dtdetail_row->dtl_a_target_next;
                $arr_dtl_a_target_persen_next[]       = $dtdetail_row->dtl_a_target_persen_next;
                $arr_no_urut[]                        = $dtdetail_row->no_urut;
                $arr_no_urut_desc[]                   = $dtdetail_row->no_urut_desc;
                $arr_no_urut_b[]                      = $dtdetail_row->no_urut_b;
                $arr_no_urut_b_desc[]                 = $dtdetail_row->no_urut_b_desc;
            }
        }
        //end detail a

        // style
        $PTStyle                    = new PHPExcel_Style();
        $headerStyle                = new PHPExcel_Style();
        $headerStyleLeft            = new PHPExcel_Style();
        $headerStyleRight           = new PHPExcel_Style();
        $headerStyleLeftRight       = new PHPExcel_Style();
        $headerStyleLeftTop         = new PHPExcel_Style();
        $headerStyleRightTop        = new PHPExcel_Style();
        $headerStyleLeftBottomTop   = new PHPExcel_Style();
        $headerStyleRightBottomTop  = new PHPExcel_Style();
        $DetailheaderStyle          = new PHPExcel_Style();
        $bodyStyle                  = new PHPExcel_Style();
        $bodyStyleAlignLeft         = new PHPExcel_Style();
        $bodyStyleAlignLeftBold     = new PHPExcel_Style();
        $noborderStyle              = new PHPExcel_Style();
        $noborderStyleBold          = new PHPExcel_Style();
        $noborderStyleAlignRight    = new PHPExcel_Style();
        $noborderStyleUnderline     = new PHPExcel_Style();
        $bodyStyleLeft              = new PHPExcel_Style();
        $bodyStyleRight             = new PHPExcel_Style();
        $footerStyleLeftbottom      = new PHPExcel_Style();
        $footerStyleRightbottom     = new PHPExcel_Style();

        $PTStyle->applyFromArray($this->xls->PT_STYLE);
        $headerStyle->applyFromArray($this->xls->headerStyle);
        $headerStyleLeft->applyFromArray($this->xls->headerStyleLeft);
        $headerStyleRight->applyFromArray($this->xls->headerStyleRight);
        $headerStyleLeftRight->applyFromArray($this->xls->headerStyleLeftRight);
        $headerStyleLeftTop->applyFromArray($this->xls->headerStyleLeftTop);
        $headerStyleRightTop->applyFromArray($this->xls->headerStyleRightTop);
        $headerStyleLeftBottomTop->applyFromArray($this->xls->headerStyleLeftBottomTop);
        $headerStyleRightBottomTop->applyFromArray($this->xls->headerStyleRightBottomTop);
        $DetailheaderStyle->applyFromArray($this->xls->DetailheaderStyle);
        $bodyStyle->applyFromArray($this->xls->bodyStyle);
        $bodyStyleAlignLeft->applyFromArray($this->xls->bodyStyleAlignLeft);
        $bodyStyleAlignLeftBold->applyFromArray($this->xls->bodyStyleAlignLeftBold);
        $noborderStyle->applyFromArray($this->xls->noborderStyle);
        $noborderStyleBold->applyFromArray($this->xls->noborderStyleBold);
        $noborderStyleAlignRight->applyFromArray($this->xls->noborderStyleAlignRight);
        $noborderStyleUnderline->applyFromArray($this->xls->noborderStyleUnderline);
        $bodyStyleLeft->applyFromArray($this->xls->bodyStyleLeft);
        $bodyStyleRight->applyFromArray($this->xls->bodyStyleRight);
        $footerStyleLeftbottom->applyFromArray($this->xls->footerStyleLeftbottom);
        $footerStyleRightbottom->applyFromArray($this->xls->footerStyleRightbottom);
        // end style

        $obj = new Excel();

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('assets/images/PSG_logo_2022.png');
        $objPHPExcel = $obj->createSheet(0);

        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        // $objPHPExcel->getPageSetup()->setFitToPage(false);
        // $objPHPExcel->getPageSetup()->setScale(30);
        // $objPHPExcel->getPageMargins()->setLeft(0.2);
        // $objPHPExcel->getPageMargins()->setRight(0.2);
        // $objPHPExcel->getPageMargins()->setBottom(0.2);
        // $objPHPExcel->getPageMargins()->setTop(0.2);
        $objPHPExcel->getPageSetup()->setFitToPage(true);
        $objPHPExcel->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getPageSetup()->setFitToHeight(0);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);

        $range = array();
        $rangeCol = "CF";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(4);
        }

        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(15);
        }
        //tabel a
        $count1 = count($dtdetail);
        $jml_data_perpage = $count1 + 23;
        if ($count1 < $jml_data_perpage) {
            $jml_page_a = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page_a = $count1 / $jml_data_perpage;
            } else {
                $jml_page_a = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }

        $jml_row_perpage  = $jml_data_perpage+14;

        for ($i1 = 0; $i1 < $jml_page_a; $i1++) {

            $start_row = ($i1 * $jml_row_perpage) + 1;
            $finish_row = ((($i1 * $jml_row_perpage) + 1) + ($jml_row_perpage));

            $start_detail = ($i1 * $jml_data_perpage);
            $finish_detail = (($i1 * $jml_data_perpage) + ($jml_data_perpage - 1));


            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/PSG_logo_2022.png');
            $gbr->setWidthAndHeight(45, 45);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('B' . $start_row);


            $objPHPExcel->mergeCells('A' .  $start_row . ':D' . ($start_row + 1));
            $objPHPExcel->mergeCells('E' .  $start_row . ':AH' . ($start_row + 1))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AI' . $start_row . ':AJ' . $start_row)->setCellValue('AI' . $start_row, 'DOK');
            $objPHPExcel->mergeCells('AK' . $start_row . ':AO' . $start_row)->setCellValue('AK' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('AI' . ($start_row + 1) . ':AJ' . ($start_row + 1))->setCellValue('AI' . ($start_row + 1), 'Tanggal');
            $objPHPExcel->mergeCells('AK' . ($start_row + 1) . ':AO' . ($start_row + 1))->setCellValue('AK' . ($start_row + 1), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' . ($start_row + 2) . ':D' . ($start_row + 2))->setCellValue('A' . ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' . ($start_row + 2) . ':AH' . ($start_row + 2))->setCellValue('E' . ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AI' . ($start_row + 2) . ':AJ' . ($start_row + 2))->setCellValue('AI' . ($start_row + 2), 'HLM');
            $objPHPExcel->mergeCells('AK' . ($start_row + 2) . ':AO' . ($start_row + 2))->setCellValue('AK' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' . $start_row . ':D' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':AO' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':AO' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':AH' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AI' . ($start_row) . ':AO' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AK' . $start_row  . ':AO' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AI' . ($start_row + 2) . ':AO' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AK' . ($start_row + 2) . ':AO' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A' . ($start_row + 3) . ':A' . ($start_row + ($jml_row_perpage-1)));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($start_row + 3) . ':AN' . ($start_row + ($jml_row_perpage-1)));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($start_row + 3) . ':AO' . ($start_row + ($jml_row_perpage-1)));

            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':AH' . ($start_row + 2));
            $objPHPExcel->getStyle('AK' . ($start_row) . ':AO' . ($start_row))->getFont()->setSize(10);

            $objPHPExcel->mergeCells('A' . ($start_row + 4) . ':A' . ($start_row + 5))->setCellValue('A' . ($start_row + 4), 'NO.');
            $objPHPExcel->mergeCells('B' . ($start_row + 4) . ':J' . ($start_row + 5))->setCellValue('B' . ($start_row + 4), 'URAIAN');
            $objPHPExcel->mergeCells('K' . ($start_row + 4) . ':R' . ($start_row + 4))->setCellValue('K' . ($start_row + 4), $date_before);
            $objPHPExcel->mergeCells('K' . ($start_row + 5) . ':O' . ($start_row + 5))->setCellValue('K' . ($start_row + 5), 'REALISASI');
            $objPHPExcel->mergeCells('P' . ($start_row + 5) . ':R' . ($start_row + 5))->setCellValue('P' . ($start_row + 5), '%');
            $objPHPExcel->mergeCells('S' . ($start_row + 4) . ':AG' . ($start_row + 4))->setCellValue('S' . ($start_row + 4), $date_today);
            $objPHPExcel->mergeCells('S' . ($start_row + 5) . ':W' . ($start_row + 5))->setCellValue('S' . ($start_row + 5), 'TARGET');
            $objPHPExcel->mergeCells('X' . ($start_row + 5) . ':Z' . ($start_row + 5))->setCellValue('X' . ($start_row + 5), '%');
            $objPHPExcel->mergeCells('AA' . ($start_row + 5) . ':AD' . ($start_row + 5))->setCellValue('AA' . ($start_row + 5), 'REALISASI');
            $objPHPExcel->mergeCells('AE' . ($start_row + 5) . ':AG' . ($start_row + 5))->setCellValue('AE' . ($start_row + 5), '%');
            $objPHPExcel->mergeCells('AH' . ($start_row + 4) . ':AO' . ($start_row + 4))->setCellValue('AH' . ($start_row + 4), $date_next);
            $objPHPExcel->mergeCells('AH' . ($start_row + 5) . ':AL' . ($start_row + 5))->setCellValue('AH' . ($start_row + 5), 'TARGET');
            $objPHPExcel->mergeCells('AM' . ($start_row + 5) . ':AO' . ($start_row + 5))->setCellValue('AM' . ($start_row + 5), '%');
            $objPHPExcel->setSharedStyle($DetailheaderStyle,   'A' . ($start_row + 4)     . ':AO' . ($start_row + 5));

            $dtl_row = $start_row + 5;

            $no = 1;
            $total_dt_biaya_dtl_a_realisai_before = 0;
            $total_dt_biaya_dtl_a_realisai_persen_before = 0;
            $total_dt_biaya_dtl_a_target_today = 0;
            $total_dt_biaya_dtl_a_target_persen_today = 0;
            $total_dt_biaya_dtl_a_realisai_today = 0;
            $total_dt_biaya_dtl_a_realisai_persen_today = 0;
            $total_dt_biaya_dtl_a_target_next = 0;
            $total_dt_biaya_dtl_a_target_persen_next = 0;

            $total_dt_rp1_dtl_a_realisai_before = 0;
            $total_dt_rp1_dtl_a_realisai_persen_before = 0;
            $total_dt_rp1_dtl_a_target_today = 0;
            $total_dt_rp1_dtl_a_target_persen_today = 0;
            $total_dt_rp1_dtl_a_realisai_today = 0;
            $total_dt_rp1_dtl_a_realisai_persen_today = 0;
            $total_dt_rp1_dtl_a_target_next = 0;
            $total_dt_rp1_dtl_a_target_persen_next = 0;

            $total_dt_rp2_dtl_a_realisai_before = 0;
            $total_dt_rp2_dtl_a_realisai_persen_before = 0;
            $total_dt_rp2_dtl_a_target_today = 0;
            $total_dt_rp2_dtl_a_target_persen_today = 0;
            $total_dt_rp2_dtl_a_realisai_today = 0;
            $total_dt_rp2_dtl_a_realisai_persen_today = 0;
            $total_dt_rp2_dtl_a_target_next = 0;
            $total_dt_rp2_dtl_a_target_persen_next = 0;

            $total_dt_acf_dtl_a_realisai_before = 0;
            $total_dt_acf_dtl_a_realisai_persen_before = 0;
            $total_dt_acf_dtl_a_target_today = 0;
            $total_dt_acf_dtl_a_target_persen_today = 0;
            $total_dt_acf_dtl_a_realisai_today = 0;
            $total_dt_acf_dtl_a_realisai_persen_today = 0;
            $total_dt_acf_dtl_a_target_next = 0;
            $total_dt_acf_dtl_a_target_persen_next = 0;

            $total_dt_asf_dtl_a_realisai_before = 0;
            $total_dt_asf_dtl_a_realisai_persen_before = 0;
            $total_dt_asf_dtl_a_target_today = 0;
            $total_dt_asf_dtl_a_target_persen_today = 0;
            $total_dt_asf_dtl_a_realisai_today = 0;
            $total_dt_asf_dtl_a_realisai_persen_today = 0;
            $total_dt_asf_dtl_a_target_next = 0;
            $total_dt_asf_dtl_a_target_persen_next = 0;

            $total_dt_aro_dtl_a_realisai_before = 0;
            $total_dt_aro_dtl_a_realisai_persen_before = 0;
            $total_dt_aro_dtl_a_target_today = 0;
            $total_dt_aro_dtl_a_target_persen_today = 0;
            $total_dt_aro_dtl_a_realisai_today = 0;
            $total_dt_aro_dtl_a_realisai_persen_today = 0;
            $total_dt_aro_dtl_a_target_next = 0;
            $total_dt_aro_dtl_a_target_persen_next = 0;

            $total_dt_auf_dtl_a_realisai_before = 0;
            $total_dt_auf_dtl_a_realisai_persen_before = 0;
            $total_dt_auf_dtl_a_target_today = 0;
            $total_dt_auf_dtl_a_target_persen_today = 0;
            $total_dt_auf_dtl_a_realisai_today = 0;
            $total_dt_auf_dtl_a_realisai_persen_today = 0;
            $total_dt_auf_dtl_a_target_next = 0;
            $total_dt_auf_dtl_a_target_persen_next = 0;

            $total_dt_tk_dtl_a_realisai_before = 0;
            $total_dt_tk_dtl_a_realisai_persen_before = 0;
            $total_dt_tk_dtl_a_target_today = 0;
            $total_dt_tk_dtl_a_target_persen_today = 0;
            $total_dt_tk_dtl_a_realisai_today = 0;
            $total_dt_tk_dtl_a_realisai_persen_today = 0;
            $total_dt_tk_dtl_a_target_next = 0;
            $total_dt_tk_dtl_a_target_persen_next = 0;

            for ($arr = $start_detail; $arr < $finish_detail; $arr++) {
                $dtl_row++;
                if (isset($arr_dtl_a_definisi_1[$arr])) {
                    if (trim($arr_dtl_a_definisi_1[$arr])) {
                        $dt_dtl_a_definisi_1[$arr] = $arr_dtl_a_definisi_1[$arr];
                    } else {
                        $dt_dtl_a_definisi_1[$arr] = '-';
                    }
                } else {
                    $dt_dtl_a_definisi_1[$arr] = '';
                }
                if (isset($arr_dtl_a_definisi_2[$arr])) {
                    if (trim($arr_dtl_a_definisi_2[$arr])) {
                        $dt_dtl_a_definisi_2[$arr] = $arr_dtl_a_definisi_2[$arr];
                    } else {
                        $dt_dtl_a_definisi_2[$arr] = '-';
                    }
                } else {
                    $dt_dtl_a_definisi_2[$arr] = '';
                }
                if (isset($arr_dtl_a_definisi_3[$arr])) {
                    if (trim($arr_dtl_a_definisi_3[$arr])) {
                        $dt_dtl_a_definisi_3[$arr] = $arr_dtl_a_definisi_3[$arr];
                    } else {
                        $dt_dtl_a_definisi_3[$arr] = '-';
                    }
                } else {
                    $dt_dtl_a_definisi_3[$arr] = '';
                }
                if (isset($arr_dtl_a_realisai_before[$arr])) {
                    if (trim($arr_dtl_a_realisai_before[$arr])) {
                        $dt_dtl_a_realisai_before[$arr] = $arr_dtl_a_realisai_before[$arr];
                    } else {
                        $dt_dtl_a_realisai_before[$arr] = '-';
                    }
                } else {
                    $dt_dtl_a_realisai_before[$arr] = '';
                }
                if (isset($arr_dtl_a_realisai_persen_before[$arr])) {
                    if (trim($arr_dtl_a_realisai_persen_before[$arr])) {
                        $dt_dtl_a_realisai_persen_before[$arr] = $arr_dtl_a_realisai_persen_before[$arr];
                    } else {
                        $dt_dtl_a_realisai_persen_before[$arr] = '-';
                    }
                } else {
                    $dt_dtl_a_realisai_persen_before[$arr] = '';
                }
                if (isset($arr_dtl_a_target_today[$arr])) {
                    if (trim($arr_dtl_a_target_today[$arr])) {
                        $dt_dtl_a_target_today[$arr] = $arr_dtl_a_target_today[$arr];
                    } else {
                        $dt_dtl_a_target_today[$arr] = '-';
                    }
                } else {
                    $dt_dtl_a_target_today[$arr] = '';
                }
                if (isset($arr_dtl_a_target_persen_today[$arr])) {
                    if (trim($arr_dtl_a_target_persen_today[$arr])) {
                        $dt_dtl_a_target_persen_today[$arr] = $arr_dtl_a_target_persen_today[$arr];
                    } else {
                        $dt_dtl_a_target_persen_today[$arr] = '-';
                    }
                } else {
                    $dt_dtl_a_target_persen_today[$arr] = '';
                }
                if (isset($arr_dtl_a_realisai_today[$arr])) {
                    if (trim($arr_dtl_a_realisai_today[$arr])) {
                        $dt_dtl_a_realisai_today[$arr] = $arr_dtl_a_realisai_today[$arr];
                    } else {
                        $dt_dtl_a_realisai_today[$arr] = '-';
                    }
                } else {
                    $dt_dtl_a_realisai_today[$arr] = '';
                }
                if (isset($arr_dtl_a_realisai_persen_today[$arr])) {
                    if (trim($arr_dtl_a_realisai_persen_today[$arr])) {
                        $dt_dtl_a_realisai_persen_today[$arr] = $arr_dtl_a_realisai_persen_today[$arr];
                    } else {
                        $dt_dtl_a_realisai_persen_today[$arr] = '-';
                    }
                } else {
                    $dt_dtl_a_realisai_persen_today[$arr] = '';
                }
                if (isset($arr_dtl_a_target_next[$arr])) {
                    if (trim($arr_dtl_a_target_next[$arr])) {
                        $dt_dtl_a_target_next[$arr] = $arr_dtl_a_target_next[$arr];
                    } else {
                        $dt_dtl_a_target_next[$arr] = '-';
                    }
                } else {
                    $dt_dtl_a_target_next[$arr] = '';
                }
                if (isset($arr_dtl_a_target_persen_next[$arr])) {
                    if (trim($arr_dtl_a_target_persen_next[$arr])) {
                        $dt_dtl_a_target_persen_next[$arr] = $arr_dtl_a_target_persen_next[$arr];
                    } else {
                        $dt_dtl_a_target_persen_next[$arr] = '-';
                    }
                } else {
                    $dt_dtl_a_target_persen_next[$arr] = '';
                }
                if (isset($arr_no_urut[$arr])) {
                    if (trim($arr_no_urut[$arr])) {
                        $dt_no_urut[$arr] = $arr_no_urut[$arr];
                    } else {
                        $dt_no_urut[$arr] = '-';
                    }
                } else {
                    $dt_no_urut[$arr] = '';
                }
                if (isset($arr_no_urut_desc[$arr])) {
                    if (trim($arr_no_urut_desc[$arr])) {
                        $dt_no_urut_desc[$arr] = $arr_no_urut_desc[$arr];
                    } else {
                        $dt_no_urut_desc[$arr] = '-';
                    }
                } else {
                    $dt_no_urut_desc[$arr] = '';
                }
                if (isset($arr_no_urut_b[$arr])) {
                    if (trim($arr_no_urut_b[$arr])) {
                        $dt_no_urut_b[$arr] = $arr_no_urut_b[$arr];
                    } else {
                        $dt_no_urut_b[$arr] = '-';
                    }
                } else {
                    $dt_no_urut_b[$arr] = '';
                }
                if (isset($arr_no_urut_b_desc[$arr])) {
                    if (trim($arr_no_urut_b_desc[$arr])) {
                        $dt_no_urut_b_desc[$arr] = $arr_no_urut_b_desc[$arr];
                    } else {
                        $dt_no_urut_b_desc[$arr] = '-';
                    }
                } else {
                    $dt_no_urut_b_desc[$arr] = '';
                }

                // $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row)     . ':AO' . ($dtl_row));
                $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(25);
                if ($dt_dtl_a_definisi_1[$arr] == 'Out put ( AIR )') {
                    if ($dt_no_urut[$arr] == 1) {
                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'A' . ($dtl_row)     . ':AO' . ($dtl_row));
                        $objPHPExcel->mergeCells('A' . ($dtl_row) . ':A' . ($dtl_row))->setCellValue('A' . ($dtl_row), $no++);
                        $objPHPExcel->mergeCells('B' . ($dtl_row) . ':AO' . ($dtl_row))->setCellValue('B' . ($dtl_row), $dt_dtl_a_definisi_1[$arr]);
                    }
                    if ($arr_no_urut_b[$arr] == 1) {
                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + 1)     . ':AO' . ($dtl_row + 1));
                        $objPHPExcel->mergeCells('B' . ($dtl_row + 1) . ':J' . ($dtl_row + 1))->setCellValue('B' . ($dtl_row + 1), $dt_dtl_a_definisi_2[$arr]);
                    }
                    $objPHPExcel->mergeCells('K' . ($dtl_row + 1) . ':O' . ($dtl_row + 1))->setCellValue('K' . ($dtl_row + 1), $dt_dtl_a_realisai_before[$arr]);
                    $objPHPExcel->mergeCells('P' . ($dtl_row + 1) . ':R' . ($dtl_row + 1))->setCellValue('P' . ($dtl_row + 1), $dt_dtl_a_realisai_persen_before[$arr]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row + 1) . ':W' . ($dtl_row + 1))->setCellValue('S' . ($dtl_row + 1), $dt_dtl_a_target_today[$arr]);
                    $objPHPExcel->mergeCells('X' . ($dtl_row + 1) . ':Z' . ($dtl_row + 1))->setCellValue('X' . ($dtl_row + 1), $dt_dtl_a_target_persen_today[$arr]);
                    $objPHPExcel->mergeCells('AA' . ($dtl_row + 1) . ':AD' . ($dtl_row + 1))->setCellValue('AA' . ($dtl_row + 1), $dt_dtl_a_realisai_today[$arr]);
                    $objPHPExcel->mergeCells('AE' . ($dtl_row + 1) . ':AG' . ($dtl_row + 1))->setCellValue('AE' . ($dtl_row + 1), $dt_dtl_a_realisai_persen_today[$arr]);
                    $objPHPExcel->mergeCells('AH' . ($dtl_row + 1) . ':AL' . ($dtl_row + 1))->setCellValue('AH' . ($dtl_row + 1), $dt_dtl_a_target_next[$arr]);
                    $objPHPExcel->mergeCells('AM' . ($dtl_row + 1) . ':AO' . ($dtl_row + 1))->setCellValue('AM' . ($dtl_row + 1), $dt_dtl_a_target_persen_next[$arr]);
                }
                if ($dt_dtl_a_definisi_1[$arr] == 'Biaya Operasional ( Rp )') {
                    $total_dt_biaya_dtl_a_realisai_before           += $dt_dtl_a_realisai_before[$arr];
                    $total_dt_biaya_dtl_a_realisai_persen_before    += $dt_dtl_a_realisai_persen_before[$arr];
                    $total_dt_biaya_dtl_a_target_today              += $dt_dtl_a_target_today[$arr];
                    $total_dt_biaya_dtl_a_target_persen_today       += $dt_dtl_a_target_persen_today[$arr];
                    $total_dt_biaya_dtl_a_realisai_today            += $dt_dtl_a_realisai_today[$arr];
                    $total_dt_biaya_dtl_a_realisai_persen_today     += $dt_dtl_a_realisai_persen_today[$arr];
                    $total_dt_biaya_dtl_a_target_next               += $dt_dtl_a_target_next[$arr];
                    $total_dt_biaya_dtl_a_target_persen_next        += $dt_dtl_a_target_persen_next[$arr];

                    if ($dt_no_urut[$arr] == 1) {
                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'A' . ($dtl_row + 1)     . ':AO' . ($dtl_row + 1));
                        $objPHPExcel->mergeCells('A' . ($dtl_row + 1) . ':A' . ($dtl_row + 1))->setCellValue('A' . ($dtl_row + 1), $no++);
                        $objPHPExcel->mergeCells('B' . ($dtl_row + 1) . ':AO' . ($dtl_row + 1))->setCellValue('B' . ($dtl_row + 1), $dt_dtl_a_definisi_1[$arr]);
                    }
                    if ($arr_no_urut_b[$arr] == 1) {
                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + 2)     . ':AO' . ($dtl_row + 2));
                        $objPHPExcel->mergeCells('B' . ($dtl_row + 2) . ':J' . ($dtl_row + 2))->setCellValue('B' . ($dtl_row + 2), $dt_dtl_a_definisi_2[$arr]);
                    }
                    $objPHPExcel->mergeCells('K' . ($dtl_row + 2) . ':O' . ($dtl_row + 2))->setCellValue('K' . ($dtl_row + 2), $dt_dtl_a_realisai_before[$arr]);
                    $objPHPExcel->mergeCells('P' . ($dtl_row + 2) . ':R' . ($dtl_row + 2))->setCellValue('P' . ($dtl_row + 2), $dt_dtl_a_realisai_persen_before[$arr]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row + 2) . ':W' . ($dtl_row + 2))->setCellValue('S' . ($dtl_row + 2), $dt_dtl_a_target_today[$arr]);
                    $objPHPExcel->mergeCells('X' . ($dtl_row + 2) . ':Z' . ($dtl_row + 2))->setCellValue('X' . ($dtl_row + 2), $dt_dtl_a_target_persen_today[$arr]);
                    $objPHPExcel->mergeCells('AA' . ($dtl_row + 2) . ':AD' . ($dtl_row + 2))->setCellValue('AA' . ($dtl_row + 2), $dt_dtl_a_realisai_today[$arr]);
                    $objPHPExcel->mergeCells('AE' . ($dtl_row + 2) . ':AG' . ($dtl_row + 2))->setCellValue('AE' . ($dtl_row + 2), $dt_dtl_a_realisai_persen_today[$arr]);
                    $objPHPExcel->mergeCells('AH' . ($dtl_row + 2) . ':AL' . ($dtl_row + 2))->setCellValue('AH' . ($dtl_row + 2), $dt_dtl_a_target_next[$arr]);
                    $objPHPExcel->mergeCells('AM' . ($dtl_row + 2) . ':AO' . ($dtl_row + 2))->setCellValue('AM' . ($dtl_row + 2), $dt_dtl_a_target_persen_next[$arr]);

                    $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2))     . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)));
                    $objPHPExcel->mergeCells('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)) . ':J' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)))->setCellValue('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)), 'Total');
                    $objPHPExcel->mergeCells('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)) . ':O' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)))->setCellValue('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)), $total_dt_biaya_dtl_a_realisai_before);
                    $objPHPExcel->mergeCells('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)) . ':R' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)))->setCellValue('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)), $total_dt_biaya_dtl_a_realisai_persen_before);
                    $objPHPExcel->mergeCells('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)) . ':W' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)))->setCellValue('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)), $total_dt_biaya_dtl_a_target_today);
                    $objPHPExcel->mergeCells('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)) . ':Z' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)))->setCellValue('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)), $total_dt_biaya_dtl_a_target_persen_today);
                    $objPHPExcel->mergeCells('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)) . ':AD' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)))->setCellValue('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)), $total_dt_biaya_dtl_a_realisai_today);
                    $objPHPExcel->mergeCells('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)) . ':AG' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)))->setCellValue('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)), $total_dt_biaya_dtl_a_realisai_persen_today);
                    $objPHPExcel->mergeCells('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)) . ':AL' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)))->setCellValue('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)), $total_dt_biaya_dtl_a_target_next);
                    $objPHPExcel->mergeCells('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)) . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)))->setCellValue('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 2)), $total_dt_biaya_dtl_a_target_persen_next);
                }
                if ($dt_dtl_a_definisi_1[$arr] == 'PEMAKAIAN BAHAN KIMIA') {
                    if ($dt_no_urut[$arr] == 1) {
                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'A' . ($dtl_row + 3)     . ':AO' . ($dtl_row + 3));
                        $objPHPExcel->mergeCells('A' . ($dtl_row + 3) . ':A' . ($dtl_row + 3))->setCellValue('A' . ($dtl_row + 3), $no++);
                        $objPHPExcel->mergeCells('B' . ($dtl_row + 3) . ':AO' . ($dtl_row + 3))->setCellValue('B' . ($dtl_row + 3), $dt_dtl_a_definisi_1[$arr]);
                    }
                    if ($arr_no_urut_b[$arr] == 1) {
                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + 4)     . ':AO' . ($dtl_row + 4));
                        $objPHPExcel->mergeCells('B' . ($dtl_row + 4) . ':J' . ($dtl_row + 4))->setCellValue('B' . ($dtl_row + 4), $dt_dtl_a_definisi_2[$arr]);
                    }
                    $objPHPExcel->mergeCells('K' . ($dtl_row + 4) . ':O' . ($dtl_row + 4))->setCellValue('K' . ($dtl_row + 4), $dt_dtl_a_realisai_before[$arr]);
                    $objPHPExcel->mergeCells('P' . ($dtl_row + 4) . ':R' . ($dtl_row + 4))->setCellValue('P' . ($dtl_row + 4), $dt_dtl_a_realisai_persen_before[$arr]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row + 4) . ':W' . ($dtl_row + 4))->setCellValue('S' . ($dtl_row + 4), $dt_dtl_a_target_today[$arr]);
                    $objPHPExcel->mergeCells('X' . ($dtl_row + 4) . ':Z' . ($dtl_row + 4))->setCellValue('X' . ($dtl_row + 4), $dt_dtl_a_target_persen_today[$arr]);
                    $objPHPExcel->mergeCells('AA' . ($dtl_row + 4) . ':AD' . ($dtl_row + 4))->setCellValue('AA' . ($dtl_row + 4), $dt_dtl_a_realisai_today[$arr]);
                    $objPHPExcel->mergeCells('AE' . ($dtl_row + 4) . ':AG' . ($dtl_row + 4))->setCellValue('AE' . ($dtl_row + 4), $dt_dtl_a_realisai_persen_today[$arr]);
                    $objPHPExcel->mergeCells('AH' . ($dtl_row + 4) . ':AL' . ($dtl_row + 4))->setCellValue('AH' . ($dtl_row + 4), $dt_dtl_a_target_next[$arr]);
                    $objPHPExcel->mergeCells('AM' . ($dtl_row + 4) . ':AO' . ($dtl_row + 4))->setCellValue('AM' . ($dtl_row + 4), $dt_dtl_a_target_persen_next[$arr]);
                }
                if ($dt_dtl_a_definisi_1[$arr] == 'Effs') {
                    if ($dt_no_urut[$arr] == 1) {
                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'A' . ($dtl_row + 4)     . ':AO' . ($dtl_row + 4));
                        $objPHPExcel->mergeCells('A' . ($dtl_row + 4) . ':A' . ($dtl_row + 4))->setCellValue('A' . ($dtl_row + 4), $no++);
                        $objPHPExcel->mergeCells('B' . ($dtl_row + 4) . ':AO' . ($dtl_row + 4))->setCellValue('B' . ($dtl_row + 4), $dt_dtl_a_definisi_1[$arr]);
                    }
                    if ($arr_no_urut_b[$arr] == 1) {
                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + 5)     . ':AO' . ($dtl_row + 5));
                        $objPHPExcel->mergeCells('B' . ($dtl_row + 5) . ':J' . ($dtl_row + 5))->setCellValue('B' . ($dtl_row + 5), $dt_dtl_a_definisi_2[$arr]);
                    }
                    $objPHPExcel->mergeCells('K' . ($dtl_row + 5) . ':O' . ($dtl_row + 5))->setCellValue('K' . ($dtl_row + 5), $dt_dtl_a_realisai_before[$arr]);
                    $objPHPExcel->mergeCells('P' . ($dtl_row + 5) . ':R' . ($dtl_row + 5))->setCellValue('P' . ($dtl_row + 5), $dt_dtl_a_realisai_persen_before[$arr]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row + 5) . ':W' . ($dtl_row + 5))->setCellValue('S' . ($dtl_row + 5), $dt_dtl_a_target_today[$arr]);
                    $objPHPExcel->mergeCells('X' . ($dtl_row + 5) . ':Z' . ($dtl_row + 5))->setCellValue('X' . ($dtl_row + 5), $dt_dtl_a_target_persen_today[$arr]);
                    $objPHPExcel->mergeCells('AA' . ($dtl_row + 5) . ':AD' . ($dtl_row + 5))->setCellValue('AA' . ($dtl_row + 5), $dt_dtl_a_realisai_today[$arr]);
                    $objPHPExcel->mergeCells('AE' . ($dtl_row + 5) . ':AG' . ($dtl_row + 5))->setCellValue('AE' . ($dtl_row + 5), $dt_dtl_a_realisai_persen_today[$arr]);
                    $objPHPExcel->mergeCells('AH' . ($dtl_row + 5) . ':AL' . ($dtl_row + 5))->setCellValue('AH' . ($dtl_row + 5), $dt_dtl_a_target_next[$arr]);
                    $objPHPExcel->mergeCells('AM' . ($dtl_row + 5) . ':AO' . ($dtl_row + 5))->setCellValue('AM' . ($dtl_row + 5), $dt_dtl_a_target_persen_next[$arr]);
                }
                if ($dt_dtl_a_definisi_1[$arr] == 'Rp / ton air') {
                    if($dt_dtl_a_definisi_2[$arr] == '5.1 Total Proses Air WTD') {
                        $total_dt_rp1_dtl_a_realisai_before           += $dt_dtl_a_realisai_before[$arr];
                        $total_dt_rp1_dtl_a_realisai_persen_before    += $dt_dtl_a_realisai_persen_before[$arr];
                        $total_dt_rp1_dtl_a_target_today              += $dt_dtl_a_target_today[$arr];
                        $total_dt_rp1_dtl_a_target_persen_today       += $dt_dtl_a_target_persen_today[$arr];
                        $total_dt_rp1_dtl_a_realisai_today            += $dt_dtl_a_realisai_today[$arr];
                        $total_dt_rp1_dtl_a_realisai_persen_today     += $dt_dtl_a_realisai_persen_today[$arr];
                        $total_dt_rp1_dtl_a_target_next               += $dt_dtl_a_target_next[$arr];
                        $total_dt_rp1_dtl_a_target_persen_next        += $dt_dtl_a_target_persen_next[$arr];
                        if ($dt_no_urut[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'A' . ($dtl_row + 5)     . ':AO' . ($dtl_row + 5));
                            $objPHPExcel->mergeCells('A' . ($dtl_row + 5) . ':A' . ($dtl_row + 5))->setCellValue('A' . ($dtl_row + 5), $no++);
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 5) . ':AO' . ($dtl_row + 5))->setCellValue('B' . ($dtl_row + 5), $dt_dtl_a_definisi_1[$arr]);
                        }
                        if ($arr_no_urut_b[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'B' . ($dtl_row + 6)     . ':AO' . ($dtl_row + 6));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 6) . ':AO' . ($dtl_row + 6))->setCellValue('B' . ($dtl_row + 6), $dt_dtl_a_definisi_2[$arr]);
                        }
                        if ($arr_dtl_a_definisi_3[$arr] != '') {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + 7)     . ':AO' . ($dtl_row + 7));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 7) . ':J' . ($dtl_row + 7))->setCellValue('B' . ($dtl_row + 7), $dt_dtl_a_definisi_3[$arr]);
                        }
                        $objPHPExcel->mergeCells('K' . ($dtl_row + 7) . ':O' . ($dtl_row + 7))->setCellValue('K' . ($dtl_row + 7), $dt_dtl_a_realisai_before[$arr]);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + 7) . ':R' . ($dtl_row + 7))->setCellValue('P' . ($dtl_row + 7), $dt_dtl_a_realisai_persen_before[$arr]);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + 7) . ':W' . ($dtl_row + 7))->setCellValue('S' . ($dtl_row + 7), $dt_dtl_a_target_today[$arr]);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + 7) . ':Z' . ($dtl_row + 7))->setCellValue('X' . ($dtl_row + 7), $dt_dtl_a_target_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + 7) . ':AD' . ($dtl_row + 7))->setCellValue('AA' . ($dtl_row + 7), $dt_dtl_a_realisai_today[$arr]);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + 7) . ':AG' . ($dtl_row + 7))->setCellValue('AE' . ($dtl_row + 7), $dt_dtl_a_realisai_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + 7) . ':AL' . ($dtl_row + 7))->setCellValue('AH' . ($dtl_row + 7), $dt_dtl_a_target_next[$arr]);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + 7) . ':AO' . ($dtl_row + 7))->setCellValue('AM' . ($dtl_row + 7), $dt_dtl_a_target_persen_next[$arr]);

                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7))     . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)));
                        $objPHPExcel->mergeCells('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)) . ':J' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)))->setCellValue('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)), 'Total (Non Efektif)');
                        $objPHPExcel->mergeCells('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)) . ':O' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)))->setCellValue('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)), $total_dt_rp1_dtl_a_realisai_before);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)) . ':R' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)))->setCellValue('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)), $total_dt_rp1_dtl_a_realisai_persen_before);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)) . ':W' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)))->setCellValue('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)), $total_dt_rp1_dtl_a_target_today);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)) . ':Z' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)))->setCellValue('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)), $total_dt_rp1_dtl_a_target_persen_today);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)) . ':AD' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)))->setCellValue('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)), $total_dt_rp1_dtl_a_realisai_today);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)) . ':AG' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)))->setCellValue('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)), $total_dt_rp1_dtl_a_realisai_persen_today);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)) . ':AL' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)))->setCellValue('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)), $total_dt_rp1_dtl_a_target_next);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)) . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)))->setCellValue('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 7)), $total_dt_rp1_dtl_a_target_persen_next);
                    }
                    if($dt_dtl_a_definisi_2[$arr] == '5.2 Pemakaian Air Efektif ( Total Pakai air - pemakaian oleh WTD )'){
                        $total_dt_rp2_dtl_a_realisai_before           += $dt_dtl_a_realisai_before[$arr];
                        $total_dt_rp2_dtl_a_realisai_persen_before    += $dt_dtl_a_realisai_persen_before[$arr];
                        $total_dt_rp2_dtl_a_target_today              += $dt_dtl_a_target_today[$arr];
                        $total_dt_rp2_dtl_a_target_persen_today       += $dt_dtl_a_target_persen_today[$arr];
                        $total_dt_rp2_dtl_a_realisai_today            += $dt_dtl_a_realisai_today[$arr];
                        $total_dt_rp2_dtl_a_realisai_persen_today     += $dt_dtl_a_realisai_persen_today[$arr];
                        $total_dt_rp2_dtl_a_target_next               += $dt_dtl_a_target_next[$arr];
                        $total_dt_rp2_dtl_a_target_persen_next        += $dt_dtl_a_target_persen_next[$arr];
                        if ($dt_no_urut[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'A' . ($dtl_row + 7)     . ':AO' . ($dtl_row + 7));
                            $objPHPExcel->mergeCells('A' . ($dtl_row + 7) . ':A' . ($dtl_row + 7))->setCellValue('A' . ($dtl_row + 7), $no++);
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 7) . ':AO' . ($dtl_row + 7))->setCellValue('B' . ($dtl_row + 7), $dt_dtl_a_definisi_1[$arr]);
                        }
                        if ($arr_no_urut_b[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'B' . ($dtl_row + 8)     . ':AO' . ($dtl_row + 8));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 8) . ':AO' . ($dtl_row + 8))->setCellValue('B' . ($dtl_row + 8), $dt_dtl_a_definisi_2[$arr]);
                        }
                        if ($arr_dtl_a_definisi_3[$arr] != '') {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + 9)     . ':AO' . ($dtl_row + 9));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 9) . ':J' . ($dtl_row + 9))->setCellValue('B' . ($dtl_row + 9), $dt_dtl_a_definisi_3[$arr]);
                        }
                        $objPHPExcel->mergeCells('K' . ($dtl_row + 9) . ':O' . ($dtl_row + 9))->setCellValue('K' . ($dtl_row + 9), $dt_dtl_a_realisai_before[$arr]);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + 9) . ':R' . ($dtl_row + 9))->setCellValue('P' . ($dtl_row + 9), $dt_dtl_a_realisai_persen_before[$arr]);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + 9) . ':W' . ($dtl_row + 9))->setCellValue('S' . ($dtl_row + 9), $dt_dtl_a_target_today[$arr]);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + 9) . ':Z' . ($dtl_row + 9))->setCellValue('X' . ($dtl_row + 9), $dt_dtl_a_target_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + 9) . ':AD' . ($dtl_row + 9))->setCellValue('AA' . ($dtl_row + 9), $dt_dtl_a_realisai_today[$arr]);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + 9) . ':AG' . ($dtl_row + 9))->setCellValue('AE' . ($dtl_row + 9), $dt_dtl_a_realisai_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + 9) . ':AL' . ($dtl_row + 9))->setCellValue('AH' . ($dtl_row + 9), $dt_dtl_a_target_next[$arr]);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + 9) . ':AO' . ($dtl_row + 9))->setCellValue('AM' . ($dtl_row + 9), $dt_dtl_a_target_persen_next[$arr]);
        
                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9))     . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)));
                        $objPHPExcel->mergeCells('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)) . ':J' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)))->setCellValue('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)), 'Total HPP Efektif');
                        $objPHPExcel->mergeCells('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)) . ':O' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)))->setCellValue('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)), $total_dt_rp2_dtl_a_realisai_before);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)) . ':R' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)))->setCellValue('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)), $total_dt_rp2_dtl_a_realisai_persen_before);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)) . ':W' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)))->setCellValue('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)), $total_dt_rp2_dtl_a_target_today);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)) . ':Z' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)))->setCellValue('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)), $total_dt_rp2_dtl_a_target_persen_today);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)) . ':AD' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)))->setCellValue('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)), $total_dt_rp2_dtl_a_realisai_today);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)) . ':AG' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)))->setCellValue('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)), $total_dt_rp2_dtl_a_realisai_persen_today);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)) . ':AL' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)))->setCellValue('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)), $total_dt_rp2_dtl_a_target_next);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)) . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)))->setCellValue('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 9)), $total_dt_rp2_dtl_a_target_persen_next);
                    }

                }
                if ($dt_dtl_a_definisi_1[$arr] == 'Distribusi Air') {
                    if ($dt_dtl_a_definisi_2[$arr] == '6.1 After Sand filter') {
                        $total_dt_asf_dtl_a_realisai_before           += $dt_dtl_a_realisai_before[$arr];
                        $total_dt_asf_dtl_a_realisai_persen_before    += $dt_dtl_a_realisai_persen_before[$arr];
                        $total_dt_asf_dtl_a_target_today              += $dt_dtl_a_target_today[$arr];
                        $total_dt_asf_dtl_a_target_persen_today       += $dt_dtl_a_target_persen_today[$arr];
                        $total_dt_asf_dtl_a_realisai_today            += $dt_dtl_a_realisai_today[$arr];
                        $total_dt_asf_dtl_a_realisai_persen_today     += $dt_dtl_a_realisai_persen_today[$arr];
                        $total_dt_asf_dtl_a_target_next               += $dt_dtl_a_target_next[$arr];
                        $total_dt_asf_dtl_a_target_persen_next        += $dt_dtl_a_target_persen_next[$arr];

                        if ($dt_no_urut[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'A' . ($dtl_row + 9)     . ':AO' . ($dtl_row + 9));
                            $objPHPExcel->mergeCells('A' . ($dtl_row + 9) . ':A' . ($dtl_row + 9))->setCellValue('A' . ($dtl_row + 9), $no++);
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 9) . ':AO' . ($dtl_row + 9))->setCellValue('B' . ($dtl_row + 9), $dt_dtl_a_definisi_1[$arr]);
                        }
                        if ($arr_no_urut_b[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'B' . ($dtl_row + 10)     . ':AO' . ($dtl_row + 10));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 10) . ':AO' . ($dtl_row + 10))->setCellValue('B' . ($dtl_row + 10), $dt_dtl_a_definisi_2[$arr]);
                        }
                        if ($arr_dtl_a_definisi_3[$arr] != '') {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + 11)     . ':AO' . ($dtl_row + 11));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 11) . ':J' . ($dtl_row + 11))->setCellValue('B' . ($dtl_row + 11), $dt_dtl_a_definisi_3[$arr]);
                        }
                        $objPHPExcel->mergeCells('K' . ($dtl_row + 11) . ':O' . ($dtl_row + 11))->setCellValue('K' . ($dtl_row + 11), $dt_dtl_a_realisai_before[$arr]);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + 11) . ':R' . ($dtl_row + 11))->setCellValue('P' . ($dtl_row + 11), $dt_dtl_a_realisai_persen_before[$arr]);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + 11) . ':W' . ($dtl_row + 11))->setCellValue('S' . ($dtl_row + 11), $dt_dtl_a_target_today[$arr]);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + 11) . ':Z' . ($dtl_row + 11))->setCellValue('X' . ($dtl_row + 11), $dt_dtl_a_target_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + 11) . ':AD' . ($dtl_row + 11))->setCellValue('AA' . ($dtl_row + 11), $dt_dtl_a_realisai_today[$arr]);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + 11) . ':AG' . ($dtl_row + 11))->setCellValue('AE' . ($dtl_row + 11), $dt_dtl_a_realisai_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + 11) . ':AL' . ($dtl_row + 11))->setCellValue('AH' . ($dtl_row + 11), $dt_dtl_a_target_next[$arr]);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + 11) . ':AO' . ($dtl_row + 11))->setCellValue('AM' . ($dtl_row + 11), $dt_dtl_a_target_persen_next[$arr]);

                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11))     . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)));
                        $objPHPExcel->mergeCells('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)) . ':J' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)))->setCellValue('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)), 'Total After Sand filter');
                        $objPHPExcel->mergeCells('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)) . ':O' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)))->setCellValue('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)), $total_dt_asf_dtl_a_realisai_before);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)) . ':R' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)))->setCellValue('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)), $total_dt_asf_dtl_a_realisai_persen_before);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)) . ':W' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)))->setCellValue('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)), $total_dt_asf_dtl_a_target_today);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)) . ':Z' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)))->setCellValue('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)), $total_dt_asf_dtl_a_target_persen_today);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)) . ':AD' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)))->setCellValue('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)), $total_dt_asf_dtl_a_realisai_today);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)) . ':AG' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)))->setCellValue('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)), $total_dt_asf_dtl_a_realisai_persen_today);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)) . ':AL' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)))->setCellValue('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)), $total_dt_asf_dtl_a_target_next);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)) . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)))->setCellValue('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 11)), $total_dt_asf_dtl_a_target_persen_next);
                    }
                    if ($dt_dtl_a_definisi_2[$arr] == '6.2 After Carbon filter') {
                        $total_dt_acf_dtl_a_realisai_before           += $dt_dtl_a_realisai_before[$arr];
                        $total_dt_acf_dtl_a_realisai_persen_before    += $dt_dtl_a_realisai_persen_before[$arr];
                        $total_dt_acf_dtl_a_target_today              += $dt_dtl_a_target_today[$arr];
                        $total_dt_acf_dtl_a_target_persen_today       += $dt_dtl_a_target_persen_today[$arr];
                        $total_dt_acf_dtl_a_realisai_today            += $dt_dtl_a_realisai_today[$arr];
                        $total_dt_acf_dtl_a_realisai_persen_today     += $dt_dtl_a_realisai_persen_today[$arr];
                        $total_dt_acf_dtl_a_target_next               += $dt_dtl_a_target_next[$arr];
                        $total_dt_acf_dtl_a_target_persen_next        += $dt_dtl_a_target_persen_next[$arr];

                        if ($dt_no_urut[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'A' . ($dtl_row + 11)     . ':AO' . ($dtl_row + 11));
                            $objPHPExcel->mergeCells('A' . ($dtl_row + 11) . ':A' . ($dtl_row + 11))->setCellValue('A' . ($dtl_row + 11), $no++);
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 11) . ':AO' . ($dtl_row + 11))->setCellValue('B' . ($dtl_row + 11), $dt_dtl_a_definisi_1[$arr]);
                        }
                        if ($arr_no_urut_b[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'B' . ($dtl_row + 12)     . ':AO' . ($dtl_row + 12));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 12) . ':AO' . ($dtl_row + 12))->setCellValue('B' . ($dtl_row + 12), $dt_dtl_a_definisi_2[$arr]);
                        }
                        if ($arr_dtl_a_definisi_3[$arr] != '') {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + 13)     . ':AO' . ($dtl_row + 13));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 13) . ':J' . ($dtl_row + 13))->setCellValue('B' . ($dtl_row + 13), $dt_dtl_a_definisi_3[$arr]);
                        }
                        $objPHPExcel->mergeCells('K' . ($dtl_row + 13) . ':O' . ($dtl_row + 13))->setCellValue('K' . ($dtl_row + 13), $dt_dtl_a_realisai_before[$arr]);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + 13) . ':R' . ($dtl_row + 13))->setCellValue('P' . ($dtl_row + 13), $dt_dtl_a_realisai_persen_before[$arr]);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + 13) . ':W' . ($dtl_row + 13))->setCellValue('S' . ($dtl_row + 13), $dt_dtl_a_target_today[$arr]);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + 13) . ':Z' . ($dtl_row + 13))->setCellValue('X' . ($dtl_row + 13), $dt_dtl_a_target_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + 13) . ':AD' . ($dtl_row + 13))->setCellValue('AA' . ($dtl_row + 13), $dt_dtl_a_realisai_today[$arr]);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + 13) . ':AG' . ($dtl_row + 13))->setCellValue('AE' . ($dtl_row + 13), $dt_dtl_a_realisai_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + 13) . ':AL' . ($dtl_row + 13))->setCellValue('AH' . ($dtl_row + 13), $dt_dtl_a_target_next[$arr]);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + 13) . ':AO' . ($dtl_row + 13))->setCellValue('AM' . ($dtl_row + 13), $dt_dtl_a_target_persen_next[$arr]);

                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13))     . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)));
                        $objPHPExcel->mergeCells('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)) . ':J' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)))->setCellValue('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)), 'Total After Carbon filter');
                        $objPHPExcel->mergeCells('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)) . ':O' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)))->setCellValue('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)), $total_dt_acf_dtl_a_realisai_before);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)) . ':R' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)))->setCellValue('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)), $total_dt_acf_dtl_a_realisai_persen_before);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)) . ':W' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)))->setCellValue('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)), $total_dt_acf_dtl_a_target_today);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)) . ':Z' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)))->setCellValue('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)), $total_dt_acf_dtl_a_target_persen_today);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)) . ':AD' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)))->setCellValue('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)), $total_dt_acf_dtl_a_realisai_today);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)) . ':AG' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)))->setCellValue('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)), $total_dt_acf_dtl_a_realisai_persen_today);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)) . ':AL' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)))->setCellValue('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)), $total_dt_acf_dtl_a_target_next);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)) . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)))->setCellValue('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 13)), $total_dt_acf_dtl_a_target_persen_next);
                    }
                    if ($dt_dtl_a_definisi_2[$arr] == '6.3 After Softener') {
                        $total_dt_asf_dtl_a_realisai_before           += $dt_dtl_a_realisai_before[$arr];
                        $total_dt_asf_dtl_a_realisai_persen_before    += $dt_dtl_a_realisai_persen_before[$arr];
                        $total_dt_asf_dtl_a_target_today              += $dt_dtl_a_target_today[$arr];
                        $total_dt_asf_dtl_a_target_persen_today       += $dt_dtl_a_target_persen_today[$arr];
                        $total_dt_asf_dtl_a_realisai_today            += $dt_dtl_a_realisai_today[$arr];
                        $total_dt_asf_dtl_a_realisai_persen_today     += $dt_dtl_a_realisai_persen_today[$arr];
                        $total_dt_asf_dtl_a_target_next               += $dt_dtl_a_target_next[$arr];
                        $total_dt_asf_dtl_a_target_persen_next        += $dt_dtl_a_target_persen_next[$arr];

                        if ($dt_no_urut[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'A' . ($dtl_row + 13)     . ':AO' . ($dtl_row + 13));
                            $objPHPExcel->mergeCells('A' . ($dtl_row + 13) . ':A' . ($dtl_row + 13))->setCellValue('A' . ($dtl_row + 13), $no++);
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 13) . ':AO' . ($dtl_row + 13))->setCellValue('B' . ($dtl_row + 13), $dt_dtl_a_definisi_1[$arr]);
                        }
                        if ($arr_no_urut_b[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'B' . ($dtl_row + 14)     . ':AO' . ($dtl_row + 14));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 14) . ':AO' . ($dtl_row + 14))->setCellValue('B' . ($dtl_row + 14), $dt_dtl_a_definisi_2[$arr]);
                        }
                        if ($arr_dtl_a_definisi_3[$arr] != '') {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + 15)     . ':AO' . ($dtl_row + 15));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 15) . ':J' . ($dtl_row + 15))->setCellValue('B' . ($dtl_row + 15), $dt_dtl_a_definisi_3[$arr]);
                        }
                        $objPHPExcel->mergeCells('K' . ($dtl_row + 15) . ':O' . ($dtl_row + 15))->setCellValue('K' . ($dtl_row + 15), $dt_dtl_a_realisai_before[$arr]);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + 15) . ':R' . ($dtl_row + 15))->setCellValue('P' . ($dtl_row + 15), $dt_dtl_a_realisai_persen_before[$arr]);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + 15) . ':W' . ($dtl_row + 15))->setCellValue('S' . ($dtl_row + 15), $dt_dtl_a_target_today[$arr]);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + 15) . ':Z' . ($dtl_row + 15))->setCellValue('X' . ($dtl_row + 15), $dt_dtl_a_target_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + 15) . ':AD' . ($dtl_row + 15))->setCellValue('AA' . ($dtl_row + 15), $dt_dtl_a_realisai_today[$arr]);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + 15) . ':AG' . ($dtl_row + 15))->setCellValue('AE' . ($dtl_row + 15), $dt_dtl_a_realisai_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + 15) . ':AL' . ($dtl_row + 15))->setCellValue('AH' . ($dtl_row + 15), $dt_dtl_a_target_next[$arr]);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + 15) . ':AO' . ($dtl_row + 15))->setCellValue('AM' . ($dtl_row + 15), $dt_dtl_a_target_persen_next[$arr]);

                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15))     . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)));
                        $objPHPExcel->mergeCells('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)) . ':J' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)))->setCellValue('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)), 'Total After Softener');
                        $objPHPExcel->mergeCells('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)) . ':O' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)))->setCellValue('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)), $total_dt_asf_dtl_a_realisai_before);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)) . ':R' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)))->setCellValue('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)), $total_dt_asf_dtl_a_realisai_persen_before);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)) . ':W' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)))->setCellValue('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)), $total_dt_asf_dtl_a_target_today);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)) . ':Z' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)))->setCellValue('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)), $total_dt_asf_dtl_a_target_persen_today);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)) . ':AD' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)))->setCellValue('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)), $total_dt_asf_dtl_a_realisai_today);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)) . ':AG' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)))->setCellValue('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)), $total_dt_asf_dtl_a_realisai_persen_today);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)) . ':AL' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)))->setCellValue('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)), $total_dt_asf_dtl_a_target_next);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)) . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)))->setCellValue('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 15)), $total_dt_asf_dtl_a_target_persen_next);
                    }
                    if ($dt_dtl_a_definisi_2[$arr] == '6.4 After Reverse Osmosis') {

                        $total_dt_aro_dtl_a_realisai_before           += $dt_dtl_a_realisai_before[$arr];
                        $total_dt_aro_dtl_a_realisai_persen_before    += $dt_dtl_a_realisai_persen_before[$arr];
                        $total_dt_aro_dtl_a_target_today              += $dt_dtl_a_target_today[$arr];
                        $total_dt_aro_dtl_a_target_persen_today       += $dt_dtl_a_target_persen_today[$arr];
                        $total_dt_aro_dtl_a_realisai_today            += $dt_dtl_a_realisai_today[$arr];
                        $total_dt_aro_dtl_a_realisai_persen_today     += $dt_dtl_a_realisai_persen_today[$arr];
                        $total_dt_aro_dtl_a_target_next               += $dt_dtl_a_target_next[$arr];
                        $total_dt_aro_dtl_a_target_persen_next        += $dt_dtl_a_target_persen_next[$arr];

                        if ($dt_no_urut[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'A' . ($dtl_row + 15)     . ':AO' . ($dtl_row + 15));
                            $objPHPExcel->mergeCells('A' . ($dtl_row + 15) . ':A' . ($dtl_row + 15))->setCellValue('A' . ($dtl_row + 15), $no++);
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 15) . ':AO' . ($dtl_row + 15))->setCellValue('B' . ($dtl_row + 15), $dt_dtl_a_definisi_1[$arr]);
                        }
                        if ($arr_no_urut_b[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'B' . ($dtl_row + 16)     . ':AO' . ($dtl_row + 16));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 16) . ':AO' . ($dtl_row + 16))->setCellValue('B' . ($dtl_row + 16), $dt_dtl_a_definisi_2[$arr]);
                        }
                        if ($arr_dtl_a_definisi_3[$arr] != '') {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + 17)     . ':AO' . ($dtl_row + 17));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 17) . ':J' . ($dtl_row + 17))->setCellValue('B' . ($dtl_row + 17), $dt_dtl_a_definisi_3[$arr]);
                        }
                        $objPHPExcel->mergeCells('K' . ($dtl_row + 17) . ':O' . ($dtl_row + 17))->setCellValue('K' . ($dtl_row + 17), $dt_dtl_a_realisai_before[$arr]);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + 17) . ':R' . ($dtl_row + 17))->setCellValue('P' . ($dtl_row + 17), $dt_dtl_a_realisai_persen_before[$arr]);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + 17) . ':W' . ($dtl_row + 17))->setCellValue('S' . ($dtl_row + 17), $dt_dtl_a_target_today[$arr]);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + 17) . ':Z' . ($dtl_row + 17))->setCellValue('X' . ($dtl_row + 17), $dt_dtl_a_target_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + 17) . ':AD' . ($dtl_row + 17))->setCellValue('AA' . ($dtl_row + 17), $dt_dtl_a_realisai_today[$arr]);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + 17) . ':AG' . ($dtl_row + 17))->setCellValue('AE' . ($dtl_row + 17), $dt_dtl_a_realisai_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + 17) . ':AL' . ($dtl_row + 17))->setCellValue('AH' . ($dtl_row + 17), $dt_dtl_a_target_next[$arr]);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + 17) . ':AO' . ($dtl_row + 17))->setCellValue('AM' . ($dtl_row + 17), $dt_dtl_a_target_persen_next[$arr]);

                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17))     . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)));
                        $objPHPExcel->mergeCells('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)) . ':J' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)))->setCellValue('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)), 'Total After Reverse Osmosis');
                        $objPHPExcel->mergeCells('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)) . ':O' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)))->setCellValue('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)), $total_dt_aro_dtl_a_realisai_before);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)) . ':R' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)))->setCellValue('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)), $total_dt_aro_dtl_a_realisai_persen_before);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)) . ':W' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)))->setCellValue('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)), $total_dt_aro_dtl_a_target_today);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)) . ':Z' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)))->setCellValue('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)), $total_dt_aro_dtl_a_target_persen_today);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)) . ':AD' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)))->setCellValue('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)), $total_dt_aro_dtl_a_realisai_today);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)) . ':AG' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)))->setCellValue('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)), $total_dt_aro_dtl_a_realisai_persen_today);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)) . ':AL' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)))->setCellValue('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)), $total_dt_aro_dtl_a_target_next);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)) . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)))->setCellValue('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 17)), $total_dt_aro_dtl_a_target_persen_next);
                    }
                    if ($dt_dtl_a_definisi_2[$arr] == '6.5 After Ultra Filter') {

                        $total_dt_auf_dtl_a_realisai_before           += $dt_dtl_a_realisai_before[$arr];
                        $total_dt_auf_dtl_a_realisai_persen_before    += $dt_dtl_a_realisai_persen_before[$arr];
                        $total_dt_auf_dtl_a_target_today              += $dt_dtl_a_target_today[$arr];
                        $total_dt_auf_dtl_a_target_persen_today       += $dt_dtl_a_target_persen_today[$arr];
                        $total_dt_auf_dtl_a_realisai_today            += $dt_dtl_a_realisai_today[$arr];
                        $total_dt_auf_dtl_a_realisai_persen_today     += $dt_dtl_a_realisai_persen_today[$arr];
                        $total_dt_auf_dtl_a_target_next               += $dt_dtl_a_target_next[$arr];
                        $total_dt_auf_dtl_a_target_persen_next        += $dt_dtl_a_target_persen_next[$arr];

                        if ($dt_no_urut[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'A' . ($dtl_row + 17)     . ':AO' . ($dtl_row + 17));
                            $objPHPExcel->mergeCells('A' . ($dtl_row + 17) . ':A' . ($dtl_row + 17))->setCellValue('A' . ($dtl_row + 17), $no++);
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 17) . ':AO' . ($dtl_row + 17))->setCellValue('B' . ($dtl_row + 17), $dt_dtl_a_definisi_1[$arr]);
                        }
                        if ($arr_no_urut_b[$arr] == 1) {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'B' . ($dtl_row + 18)     . ':AO' . ($dtl_row + 18));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 18) . ':AO' . ($dtl_row + 18))->setCellValue('B' . ($dtl_row + 18), $dt_dtl_a_definisi_2[$arr]);
                        }
                        if ($arr_dtl_a_definisi_3[$arr] != '') {
                            $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + 19)     . ':AO' . ($dtl_row + 19));
                            $objPHPExcel->mergeCells('B' . ($dtl_row + 19) . ':J' . ($dtl_row + 19))->setCellValue('B' . ($dtl_row + 19), $dt_dtl_a_definisi_3[$arr]);
                        }
                        $objPHPExcel->mergeCells('K' . ($dtl_row + 19) . ':O' . ($dtl_row + 19))->setCellValue('K' . ($dtl_row + 19), $dt_dtl_a_realisai_before[$arr]);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + 19) . ':R' . ($dtl_row + 19))->setCellValue('P' . ($dtl_row + 19), $dt_dtl_a_realisai_persen_before[$arr]);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + 19) . ':W' . ($dtl_row + 19))->setCellValue('S' . ($dtl_row + 19), $dt_dtl_a_target_today[$arr]);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + 19) . ':Z' . ($dtl_row + 19))->setCellValue('X' . ($dtl_row + 19), $dt_dtl_a_target_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + 19) . ':AD' . ($dtl_row + 19))->setCellValue('AA' . ($dtl_row + 19), $dt_dtl_a_realisai_today[$arr]);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + 19) . ':AG' . ($dtl_row + 19))->setCellValue('AE' . ($dtl_row + 19), $dt_dtl_a_realisai_persen_today[$arr]);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + 19) . ':AL' . ($dtl_row + 19))->setCellValue('AH' . ($dtl_row + 19), $dt_dtl_a_target_next[$arr]);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + 19) . ':AO' . ($dtl_row + 19))->setCellValue('AM' . ($dtl_row + 19), $dt_dtl_a_target_persen_next[$arr]);

                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19))     . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)));
                        $objPHPExcel->mergeCells('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)) . ':J' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)))->setCellValue('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)), 'Total After Ultra Filter');
                        $objPHPExcel->mergeCells('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)) . ':O' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)))->setCellValue('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)), $total_dt_auf_dtl_a_realisai_before);
                        $objPHPExcel->mergeCells('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)) . ':R' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)))->setCellValue('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)), $total_dt_auf_dtl_a_realisai_persen_before);
                        $objPHPExcel->mergeCells('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)) . ':W' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)))->setCellValue('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)), $total_dt_auf_dtl_a_target_today);
                        $objPHPExcel->mergeCells('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)) . ':Z' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)))->setCellValue('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)), $total_dt_auf_dtl_a_target_persen_today);
                        $objPHPExcel->mergeCells('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)) . ':AD' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)))->setCellValue('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)), $total_dt_auf_dtl_a_realisai_today);
                        $objPHPExcel->mergeCells('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)) . ':AG' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)))->setCellValue('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)), $total_dt_auf_dtl_a_realisai_persen_today);
                        $objPHPExcel->mergeCells('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)) . ':AL' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)))->setCellValue('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)), $total_dt_auf_dtl_a_target_next);
                        $objPHPExcel->mergeCells('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)) . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)))->setCellValue('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 19)), $total_dt_auf_dtl_a_target_persen_next);
                    }
                }
                if ($dt_dtl_a_definisi_1[$arr] == 'Tenaga kerja') {
                    $total_dt_tk_dtl_a_realisai_before           += $dt_dtl_a_realisai_before[$arr];
                    $total_dt_tk_dtl_a_realisai_persen_before    += $dt_dtl_a_realisai_persen_before[$arr];
                    $total_dt_tk_dtl_a_target_today              += $dt_dtl_a_target_today[$arr];
                    $total_dt_tk_dtl_a_target_persen_today       += $dt_dtl_a_target_persen_today[$arr];
                    $total_dt_tk_dtl_a_realisai_today            += $dt_dtl_a_realisai_today[$arr];
                    $total_dt_tk_dtl_a_realisai_persen_today     += $dt_dtl_a_realisai_persen_today[$arr];
                    $total_dt_tk_dtl_a_target_next               += $dt_dtl_a_target_next[$arr];
                    $total_dt_tk_dtl_a_target_persen_next        += $dt_dtl_a_target_persen_next[$arr];
                    if ($dt_no_urut[$arr] == 1) {
                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeftBold,   'A' . ($dtl_row + 20)     . ':AO' . ($dtl_row + 20));
                        $objPHPExcel->mergeCells('A' . ($dtl_row + 20) . ':A' . ($dtl_row + 20))->setCellValue('A' . ($dtl_row + 20), $no++);
                        $objPHPExcel->mergeCells('B' . ($dtl_row + 20) . ':AO' . ($dtl_row + 20))->setCellValue('B' . ($dtl_row + 20), $dt_dtl_a_definisi_1[$arr]);
                    }
                    if ($arr_no_urut_b[$arr] == 1) {
                        $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + 21)     . ':AO' . ($dtl_row + 21));
                        $objPHPExcel->mergeCells('B' . ($dtl_row + 21) . ':J' . ($dtl_row + 21))->setCellValue('B' . ($dtl_row + 21), $dt_dtl_a_definisi_2[$arr]);
                    }
                    $objPHPExcel->mergeCells('K' . ($dtl_row + 21) . ':O' . ($dtl_row + 21))->setCellValue('K' . ($dtl_row + 21), $dt_dtl_a_realisai_before[$arr]);
                    $objPHPExcel->mergeCells('P' . ($dtl_row + 21) . ':R' . ($dtl_row + 21))->setCellValue('P' . ($dtl_row + 21), $dt_dtl_a_realisai_persen_before[$arr]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row + 21) . ':W' . ($dtl_row + 21))->setCellValue('S' . ($dtl_row + 21), $dt_dtl_a_target_today[$arr]);
                    $objPHPExcel->mergeCells('X' . ($dtl_row + 21) . ':Z' . ($dtl_row + 21))->setCellValue('X' . ($dtl_row + 21), $dt_dtl_a_target_persen_today[$arr]);
                    $objPHPExcel->mergeCells('AA' . ($dtl_row + 21) . ':AD' . ($dtl_row + 21))->setCellValue('AA' . ($dtl_row + 21), $dt_dtl_a_realisai_today[$arr]);
                    $objPHPExcel->mergeCells('AE' . ($dtl_row + 21) . ':AG' . ($dtl_row + 21))->setCellValue('AE' . ($dtl_row + 21), $dt_dtl_a_realisai_persen_today[$arr]);
                    $objPHPExcel->mergeCells('AH' . ($dtl_row + 21) . ':AL' . ($dtl_row + 21))->setCellValue('AH' . ($dtl_row + 21), $dt_dtl_a_target_next[$arr]);
                    $objPHPExcel->mergeCells('AM' . ($dtl_row + 21) . ':AO' . ($dtl_row + 21))->setCellValue('AM' . ($dtl_row + 21), $dt_dtl_a_target_persen_next[$arr]);

                    $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,   'B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21))     . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)));
                    $objPHPExcel->mergeCells('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)) . ':J' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)))->setCellValue('B' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)), 'Total');
                    $objPHPExcel->mergeCells('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)) . ':O' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)))->setCellValue('K' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)), $total_dt_tk_dtl_a_realisai_before);
                    $objPHPExcel->mergeCells('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)) . ':R' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)))->setCellValue('P' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)), $total_dt_tk_dtl_a_realisai_persen_before);
                    $objPHPExcel->mergeCells('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)) . ':W' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)))->setCellValue('S' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)), $total_dt_tk_dtl_a_target_today);
                    $objPHPExcel->mergeCells('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)) . ':Z' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)))->setCellValue('X' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)), $total_dt_tk_dtl_a_target_persen_today);
                    $objPHPExcel->mergeCells('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)) . ':AD' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)))->setCellValue('AA' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)), $total_dt_tk_dtl_a_realisai_today);
                    $objPHPExcel->mergeCells('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)) . ':AG' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)))->setCellValue('AE' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)), $total_dt_tk_dtl_a_realisai_persen_today);
                    $objPHPExcel->mergeCells('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)) . ':AL' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)))->setCellValue('AH' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)), $total_dt_tk_dtl_a_target_next);
                    $objPHPExcel->mergeCells('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)) . ':AO' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)))->setCellValue('AM' . ($dtl_row + ($dt_no_urut_b_desc[$arr] + 21)), $total_dt_tk_dtl_a_target_persen_next);
                }
            }
            
            $app_row = $dtl_row + 2;

            $objPHPExcel->setSharedStyle($headerStyleLeftTop, 'A' . ($app_row-1) . ':A' . ($app_row - 1));

            $objPHPExcel->mergeCells('B' . ($app_row) . ':E' . ($app_row))->setCellValue('B' . ($app_row), 'Catatan :');
            $objPHPExcel->mergeCells('F' . ($app_row) . ':P' . ($app_row+6))->setCellValue('F' . ($app_row), '');
            $objPHPExcel->mergeCells('R' . ($app_row) . ':Y' . ($app_row))->setCellValue('R' . ($app_row), 'Dibuat Oleh,');
            $objPHPExcel->mergeCells('Z' . ($app_row) . ':AG' . ($app_row))->setCellValue('Z' . ($app_row), 'Diketahui Oleh,');
            $objPHPExcel->mergeCells('AH' . ($app_row) . ':AO' . ($app_row))->setCellValue('AH' . ($app_row), 'Disetujui Oleh,');

            $objPHPExcel->mergeCells('R' . ($app_row + 1) . ':Y' . ($app_row + 3))->setCellValue('R' . ($app_row + 1), '');
            $objPHPExcel->mergeCells('Z' . ($app_row + 1) . ':AG' . ($app_row + 3))->setCellValue('Z' . ($app_row + 1), '');
            $objPHPExcel->mergeCells('AH' . ($app_row + 1) . ':AO' . ($app_row + 3))->setCellValue('AH' . ($app_row + 1), '');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'R' . ($app_row) . ':AO' . ($app_row + 3));


            //tabel app
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
                    $sign_img->setCoordinates('AO' . ($app_row + 1));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AO' . ($app_row + 1));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AO' . ($app_row + 1));
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
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath('assets/ttd/' . $app2_personalstatus . '_' . $app2_personalid . '.png');
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('BE' . ($app_row + 1));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('BE' . ($app_row + 1));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('BE' . ($app_row + 1));
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
                if (file_exists($fcpath2 . 'assets/ttd/' . $app3_personalstatus . '_' . $app3_personalid . '.png')) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath('assets/ttd/' . $app3_personalstatus . '_' . $app3_personalid . '.png');
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('BU' . ($app_row + 1));
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('BU' . ($app_row + 1));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('BU' . ($app_row + 1));
                }
            }


            $objPHPExcel->mergeCells('R' . ($app_row + 4) . ':S' . ($app_row + 4))->setCellValue('R' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('T' . ($app_row + 4) . ':Y' . ($app_row + 4))->setCellValue('T' . ($app_row + 4), ': ' . $app1_by);
            $objPHPExcel->mergeCells('R' . ($app_row + 5) . ':S' . ($app_row + 5))->setCellValue('R' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('T' . ($app_row + 5) . ':Y' . ($app_row + 5))->setCellValue('T' . ($app_row + 5), ': ' . $app1_position);
            $objPHPExcel->mergeCells('R' . ($app_row + 6) . ':S' . ($app_row + 6))->setCellValue('R' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('T' . ($app_row + 6) . ':Y' . ($app_row + 6))->setCellValue('T' . ($app_row + 6), ': ' . $app1date);

            $objPHPExcel->mergeCells('Z' . ($app_row + 4) . ':AA' . ($app_row + 4))->setCellValue('Z' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('AB' . ($app_row + 4) . ':AG' . ($app_row + 4))->setCellValue('AB' . ($app_row + 4), ': ' . $app2_by);
            $objPHPExcel->mergeCells('Z' . ($app_row + 5) . ':AA' . ($app_row + 5))->setCellValue('Z' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('AB' . ($app_row + 5) . ':AG' . ($app_row + 5))->setCellValue('AB' . ($app_row + 5), ': ' . $app2_position);
            $objPHPExcel->mergeCells('Z' . ($app_row + 6) . ':AA' . ($app_row + 6))->setCellValue('Z' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('AB' . ($app_row + 6) . ':AG' . ($app_row + 6))->setCellValue('AB' . ($app_row + 6), ': ' . $app2date);

            $objPHPExcel->mergeCells('AH' . ($app_row + 4) . ':AI' . ($app_row + 4))->setCellValue('AH' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 4) . ':AO' . ($app_row + 4))->setCellValue('AJ' . ($app_row + 4), ': ' . $app3_by);
            $objPHPExcel->mergeCells('AH' . ($app_row + 5) . ':AI' . ($app_row + 5))->setCellValue('AH' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 5) . ':AO' . ($app_row + 5))->setCellValue('AJ' . ($app_row + 5), ': ' . $app3_position);
            $objPHPExcel->mergeCells('AH' . ($app_row + 6) . ':AI' . ($app_row + 6))->setCellValue('AH' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 6) . ':AO' . ($app_row + 6))->setCellValue('AJ' . ($app_row + 6), ': ' . $app3date);

            $objPHPExcel->setSharedStyle($noborderStyle, 'R' . ($app_row + 4) . ':AO' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'R' . ($app_row + 4) . ':R' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'Z' . ($app_row + 4) . ':Z' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AH' . ($app_row + 4) . ':AH' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($app_row + 4) . ':AO' . ($app_row + 6));

            // $objPHPExcel->getStyle('AK' . ($app_row + 7) . ':CE' . ($app_row + 9))->getFont()->setBold(true);
            // $objPHPExcel->setSharedStyle($bodyStyleRight, 'CF' . ($app_row + 7) . ':CF' . ($app_row + 9));
            // $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AK' . ($app_row + 7) . ':AK' . ($app_row + 9));

            $start_row3 = $app_row + 6;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':H' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':H' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('I' . ($start_row3 + 1) . ':AO' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('I' . ($start_row3 + 1) . ':AO' . ($start_row3 + 1))->setCellValue('I' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':H' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'I' . ($start_row3 + 1) . ':AO' . ($start_row3 + 1));
            $objPHPExcel->setBreak('A' . ($start_row3 + 1),  PHPExcel_Worksheet::BREAK_ROW);
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
