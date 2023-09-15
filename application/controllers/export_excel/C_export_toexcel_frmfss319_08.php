<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_frmfss319_08 extends CI_Controller
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

        $dtheader = $this->M_formfrmfss319_08->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date              = $dtheaderrow->create_date; //2021-02-08

            $create_date                = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $bulan                      = date('M', strtotime($dtheaderrow->create_date));
            $docno                      = $dtheaderrow->docno;

            $total_dtlc_total_jam      = $dtheaderrow->total_dtlc_total_jam;
            $total_dtlc_jam_akm        = $dtheaderrow->total_dtlc_jam_akm;
            $total_dtlc_tmpr_kg        = $dtheaderrow->total_dtlc_tmpr_kg;
            $total_dtlc_tmpr_akm       = $dtheaderrow->total_dtlc_tmpr_akm;
            $total_dtlc_steam_ton      = $dtheaderrow->total_dtlc_steam_ton;
            $total_dtlc_steam_akm      = $dtheaderrow->total_dtlc_steam_akm;
            $total_dtlc_total_air      = $dtheaderrow->total_dtlc_total_air;
            $total_dtlc_air_akm        = $dtheaderrow->total_dtlc_air_akm;
            $total_dtld_tmpr_kg        = $dtheaderrow->total_dtld_tmpr_kg;
            $total_dtld_tmpr_akm       = $dtheaderrow->total_dtld_tmpr_akm;
            $total_dtld_steam_ton      = $dtheaderrow->total_dtld_steam_ton;
            $total_dtld_steam_akm      = $dtheaderrow->total_dtld_steam_akm;
            $total_dtld_total_air      = $dtheaderrow->total_dtld_total_air;
            $total_dtld_air_akm        = $dtheaderrow->total_dtld_air_akm;
            $selisih_opname            = $dtheaderrow->selisih_opname;
            $total_dtlb_penerimaan_kg  = $dtheaderrow->total_dtlb_penerimaan_kg;
            $total_dtlb_penerimaan_akm = $dtheaderrow->total_dtlb_penerimaan_akm;
            $total_dtlb_pemakaian_kg   = $dtheaderrow->total_dtlb_pemakaian_kg;
            $total_dtlb_pemakaian_akm  = $dtheaderrow->total_dtlb_pemakaian_akm;
            $stock_akhir_tmp           = $dtheaderrow->stock_akhir_tmp;
            $air_dearator              = $dtheaderrow->air_dearator;
            $air_wtd                   = $dtheaderrow->air_wtd;
            $air_condensate            = $dtheaderrow->air_condensate;
            $air_blr                   = $dtheaderrow->air_blr;
            $total_return              = $dtheaderrow->total_return;
            $prsn_air_wtd              = $dtheaderrow->prsn_air_wtd;
            $prsn_air_condensate       = $dtheaderrow->prsn_air_condensate;
            $prsn_air_blr              = $dtheaderrow->prsn_air_blr;
            $realisasi                 = $dtheaderrow->realisasi;
            $temp_bulan_lalu           = $dtheaderrow->temp_bulan_lalu;
            $app1_by                   = $dtheaderrow->app1_by;
            $app2_by                   = $dtheaderrow->app2_by;
            $app3_by                   = $dtheaderrow->app3_by;
            $app1_position             = $dtheaderrow->app1_position;
            $app2_position             = $dtheaderrow->app2_position;
            $app3_position             = $dtheaderrow->app3_position;
            $app1_personalid           = $dtheaderrow->app1_personalid;
            $app2_personalid           = $dtheaderrow->app2_personalid;
            $app3_personalid           = $dtheaderrow->app3_personalid;
            $app1_personalstatus       = $dtheaderrow->app1_personalstatus;
            $app2_personalstatus       = $dtheaderrow->app2_personalstatus;
            $app3_personalstatus       = $dtheaderrow->app3_personalstatus;
            $app1date                  = $dtheaderrow->app1_date;
            $app2date                  = $dtheaderrow->app2_date;
            $app3date                  = $dtheaderrow->app3_date;

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



        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail           = $this->M_formfrmfss319_08->get_detail_byidx($this->header_id);
            $dtdetail_b         = $this->M_formfrmfss319_08->get_detail_byid_bx($this->header_id);
            $dtdetail_b2        = $this->M_formfrmfss319_08->get_detail_byid_b2x($this->header_id);
            $dtdetail_c         = $this->M_formfrmfss319_08->get_detail_byid_cx($this->header_id);
            $dtdetail_d         = $this->M_formfrmfss319_08->get_detail_byid_dx($this->header_id);
        } else {
            $dtdetail           = $this->M_formfrmfss319_08->get_detail_byid($this->header_id);
            $dtdetail_b         = $this->M_formfrmfss319_08->get_detail_byid_b($this->header_id);
            $dtdetail_b2        = $this->M_formfrmfss319_08->get_detail_byid_b2($this->header_id);
            $dtdetail_c         = $this->M_formfrmfss319_08->get_detail_byid_c($this->header_id);
            $dtdetail_d         = $this->M_formfrmfss319_08->get_detail_byid_d($this->header_id);
        }

        $no = 1;
        foreach ($dtdetail as $dtdetail_row) {
            $boiler[]               = $dtdetail_row->boiler;
            $tekanan_07[]           = $dtdetail_row->tekanan_07;
            $tekanan_08[]           = $dtdetail_row->tekanan_08;
            $tekanan_09[]           = $dtdetail_row->tekanan_09;
            $tekanan_10[]           = $dtdetail_row->tekanan_10;
            $tekanan_11[]           = $dtdetail_row->tekanan_11;
            $tekanan_12[]           = $dtdetail_row->tekanan_12;
            $tekanan_13[]           = $dtdetail_row->tekanan_13;
            $tekanan_14[]           = $dtdetail_row->tekanan_14;
            $tekanan_15[]           = $dtdetail_row->tekanan_15;
            $tekanan_16[]           = $dtdetail_row->tekanan_16;
            $tekanan_17[]           = $dtdetail_row->tekanan_17;
            $tekanan_18[]           = $dtdetail_row->tekanan_18;
            $tekanan_19[]           = $dtdetail_row->tekanan_19;
            $tekanan_20[]           = $dtdetail_row->tekanan_20;
            $tekanan_21[]           = $dtdetail_row->tekanan_21;
            $tekanan_22[]           = $dtdetail_row->tekanan_22;
            $tekanan_23[]           = $dtdetail_row->tekanan_23;
            $tekanan_24[]           = $dtdetail_row->tekanan_24;
            $tekanan_01[]           = $dtdetail_row->tekanan_01;
            $tekanan_02[]           = $dtdetail_row->tekanan_02;
            $tekanan_03[]           = $dtdetail_row->tekanan_03;
            $tekanan_04[]           = $dtdetail_row->tekanan_04;
            $tekanan_05[]           = $dtdetail_row->tekanan_05;
            $tekanan_06[]           = $dtdetail_row->tekanan_06;
            $keterangan[]           = $dtdetail_row->keterangan;
        }

        foreach ($dtdetail_b as $dtdetail_b_row) {
            $dtlb_uraian[]          = $dtdetail_b_row->dtlb_uraian;
            $dtlb_penerimaan_kg[]   = $dtdetail_b_row->dtlb_penerimaan_kg;
            $dtlb_penerimaan_akm[]  = $dtdetail_b_row->dtlb_penerimaan_akm;
            $dtlb_pemakaian_kg[]    = $dtdetail_b_row->dtlb_pemakaian_kg;
            $dtlb_pemakaian_akm[]   = $dtdetail_b_row->dtlb_pemakaian_akm;
            $dtlb_stock_tmp[]       = $dtdetail_b_row->dtlb_stock_tmp;
        }

        foreach ($dtdetail_b2 as $dtdetail_b2_row) {
            $dtlb2_uraian[]         = $dtdetail_b2_row->dtlb2_uraian;
            $dtlb2_terima[]         = $dtdetail_b2_row->dtlb2_terima;
            $dtlb2_pakai[]          = $dtdetail_b2_row->dtlb2_pakai;
            $dtlb2_akm[]            = $dtdetail_b2_row->dtlb2_akm;
            $dtlb2_eff[]            = $dtdetail_b2_row->dtlb2_eff;
            $dtlb2_stock[]          = $dtdetail_b2_row->dtlb2_stock;
            $dtlb2_nodo[]           = $dtdetail_b2_row->dtlb2_nodo;
        }

        foreach ($dtdetail_c as $dtdetail_c_row) {
            $detail_id_c[]          = $dtdetail_c_row->detail_id_c;
            $dtlc_item_id[]         = $dtdetail_c_row->dtlc_item_id;
            $dtlc_kode_boiler[]     = $dtdetail_c_row->dtlc_kode_boiler;
            $dtlc_total_jam[]       = $dtdetail_c_row->dtlc_total_jam;
            $dtlc_jam_akm[]         = $dtdetail_c_row->dtlc_jam_akm;
            $dtlc_tmpr_kg[]         = $dtdetail_c_row->dtlc_tmpr_kg;
            $dtlc_tmpr_akm[]        = $dtdetail_c_row->dtlc_tmpr_akm;
            $dtlc_steam_ton[]       = $dtdetail_c_row->dtlc_steam_ton;
            $dtlc_steam_akm[]       = $dtdetail_c_row->dtlc_steam_akm;
            $dtlc_total_air[]       = $dtdetail_c_row->dtlc_total_air;
            $dtlc_air_akm[]         = $dtdetail_c_row->dtlc_air_akm;
        }

        foreach ($dtdetail_d as $dtdetail_d_row) {
            $detail_id_d[]          = $dtdetail_d_row->detail_id_d;
            $dtld_item_id[]         = $dtdetail_d_row->dtld_item_id;
            $dtld_uraian[]          = $dtdetail_d_row->dtld_uraian;
            $dtld_total_jam[]       = $dtdetail_d_row->dtld_total_jam;
            $dtld_tmpr_kg[]         = $dtdetail_d_row->dtld_tmpr_kg;
            $dtld_tmpr_akm[]        = $dtdetail_d_row->dtld_tmpr_akm;
            $dtld_steam_ton[]       = $dtdetail_d_row->dtld_steam_ton;
            $dtld_steam_akm[]       = $dtdetail_d_row->dtld_steam_akm;
            $dtld_total_air[]       = $dtdetail_d_row->dtld_total_air;
            $dtld_air_akm[]         = $dtdetail_d_row->dtld_air_akm;
        }

        // echo"<pre>";
        // print_r($dtdetail_b);exit();
        // echo"</pre>";

        //end Get dtheader
        // style
        $PTStyle                   = new PHPExcel_Style();
        $headerStyle               = new PHPExcel_Style();
        $headerStyleLeft           = new PHPExcel_Style();
        $headerStyleRight           = new PHPExcel_Style();
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
        $headerStyleLeft->applyFromArray($this->xls->headerStyleLeft);
        $headerStyleRight->applyFromArray($this->xls->headerStyleRight);
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
        $objPHPExcel->getPageSetup()->setFitToPage(true);
        $objPHPExcel->getPageSetup()->setScale(63);
        $objPHPExcel->getPageMargins()->setLeft(0.2);
        $objPHPExcel->getPageMargins()->setRight(0.2);
        $objPHPExcel->getPageMargins()->setBottom(0.2);
        $objPHPExcel->getPageMargins()->setTop(0.2);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);
        $objPHPExcel->getPageSetup()->setVerticalCentered(true);

        $range = array();
        $rangeCol = "AL";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(5);
        }
        $objPHPExcel->getColumnDimension("F")->setWidth(8);
        $objPHPExcel->getColumnDimension("AE")->setWidth(8);

        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(15);
        }

        $count1 = count($dtdetail);
        $jml_data_perpage = 8;
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
        $jml_data_perpage_b = 5;
        if ($count2 < $jml_data_perpage_b) {
            $jml_page_b = 1;
        } else {
            if (($count2 % $jml_data_perpage_b) == 0) {
                $jml_page_b = $count2 / $jml_data_perpage_b;
            } else {
                $jml_page_b = floor(($count2 / $jml_data_perpage_b)) + 1;
            }
        }
        $count2b = count($dtdetail_b2);
        $jml_data_perpage_b2 = 5;
        if ($count2b < $jml_data_perpage_b2) {
            $jml_page_b2 = 1;
        } else {
            if (($count2b % $jml_data_perpage_b2) == 0) {
                $jml_page_b2 = $count2b / $jml_data_perpage_b2;
            } else {
                $jml_page_b2 = floor(($count2b / $jml_data_perpage_b2)) + 1;
            }
        }

        $count3 = count($dtdetail_c);
        $jml_data_perpage_c = 8;
        if ($count3 < $jml_data_perpage_c) {
            $jml_page_c = 1;
        } else {
            if (($count3 % $jml_data_perpage_c) == 0) {
                $jml_page_c = $count3 / $jml_data_perpage_c;
            } else {
                $jml_page_c = floor(($count3 / $jml_data_perpage_c)) + 1;
            }
        }

        $count4 = count($dtdetail_d);
        $jml_data_perpage_d = 9;
        if ($count4 < $jml_data_perpage_d) {
            $jml_page_d = 1;
        } else {
            if (($count4 % $jml_data_perpage_d) == 0) {
                $jml_page_d = $count4 / $jml_data_perpage_d;
            } else {
                $jml_page_d = floor(($count4 / $jml_data_perpage_d)) + 1;
            }
        }


        $jml_row_perpage  = 98;


        $jml_page = max($jml_page_a, $jml_page_b, $jml_page_b2, $jml_page_c, $jml_page_d);

        // $number = 0;
        for ($i1 = 0; $i1 < $jml_page; $i1++) {

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


            $objPHPExcel->mergeCells('A' .   $start_row . ':D' . ($start_row + 1));
            $objPHPExcel->mergeCells('E' .   $start_row . ':AF' . ($start_row + 1))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AG' .  $start_row . ':AH' . $start_row)->setCellValue('AG' . $start_row, 'Doc');
            $objPHPExcel->mergeCells('AI' .  $start_row . ':AL' . $start_row)->setCellValue('AI' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('AG' . ($start_row + 1) . ':AH' . ($start_row + 1))->setCellValue('AG' . ($start_row + 1), 'Date');
            $objPHPExcel->mergeCells('AI' . ($start_row + 1) . ':AL' . ($start_row + 1))->setCellValue('AI' . ($start_row + 1), ':' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' .  ($start_row + 2) . ':D' .  ($start_row + 2))->setCellValue('A' .  ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' .  ($start_row + 2) . ':AF' . ($start_row + 2))->setCellValue('E' .  ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AG' . ($start_row + 2) . ':AH' . ($start_row + 2))->setCellValue('AG' . ($start_row + 2), 'Page');
            $objPHPExcel->mergeCells('AI' . ($start_row + 2) . ':AL' . ($start_row + 2))->setCellValue('AI' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row .      ':D' .  ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':AL' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':AL' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':AF' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AG' . ($start_row) . ':AL' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AI' .  $start_row  . ':AL' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AG' . ($start_row + 2) . ':AL' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AI' . ($start_row + 2) . ':AL' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':AF' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 2));
            $objPHPExcel->getStyle('AI' . ($start_row) . ':AL' . ($start_row))->getFont()->setSize(10);

            $objPHPExcel->mergeCells('B' .  ($start_row + 4) . ':F' .  ($start_row + 5))->setCellValue('B' .  ($start_row + 4), 'OPERASIONAL BOILER');
            $objPHPExcel->mergeCells('G' .  ($start_row + 4) . ':AD' .  ($start_row + 4))->setCellValue('G' .  ($start_row + 4), 'TEKANAN PERJAM (BAR)');
            $objPHPExcel->mergeCells('G' .  ($start_row + 5) . ':G' .  ($start_row + 5))->setCellValue('G' .  ($start_row + 5), '07');
            $objPHPExcel->mergeCells('H' .  ($start_row + 5) . ':H' .  ($start_row + 5))->setCellValue('H' .  ($start_row + 5), '08');
            $objPHPExcel->mergeCells('I' .  ($start_row + 5) . ':I' .  ($start_row + 5))->setCellValue('I' .  ($start_row + 5), '09');
            $objPHPExcel->mergeCells('J' .  ($start_row + 5) . ':J' .  ($start_row + 5))->setCellValue('J' .  ($start_row + 5), '10');
            $objPHPExcel->mergeCells('K' .  ($start_row + 5) . ':K' .  ($start_row + 5))->setCellValue('K' .  ($start_row + 5), '11');
            $objPHPExcel->mergeCells('L' .  ($start_row + 5) . ':L' .  ($start_row + 5))->setCellValue('L' .  ($start_row + 5), '12');
            $objPHPExcel->mergeCells('M' .  ($start_row + 5) . ':M' .  ($start_row + 5))->setCellValue('M' .  ($start_row + 5), '13');
            $objPHPExcel->mergeCells('N' .  ($start_row + 5) . ':N' .  ($start_row + 5))->setCellValue('N' .  ($start_row + 5), '14');
            $objPHPExcel->mergeCells('O' .  ($start_row + 5) . ':O' .  ($start_row + 5))->setCellValue('O' .  ($start_row + 5), '15');
            $objPHPExcel->mergeCells('P' .  ($start_row + 5) . ':P' .  ($start_row + 5))->setCellValue('P' .  ($start_row + 5), '16');
            $objPHPExcel->mergeCells('Q' .  ($start_row + 5) . ':Q' .  ($start_row + 5))->setCellValue('Q' .  ($start_row + 5), '17');
            $objPHPExcel->mergeCells('R' .  ($start_row + 5) . ':R' .  ($start_row + 5))->setCellValue('R' .  ($start_row + 5), '18');
            $objPHPExcel->mergeCells('S' .  ($start_row + 5) . ':S' .  ($start_row + 5))->setCellValue('S' .  ($start_row + 5), '19');
            $objPHPExcel->mergeCells('T' .  ($start_row + 5) . ':T' .  ($start_row + 5))->setCellValue('T' .  ($start_row + 5), '20');
            $objPHPExcel->mergeCells('U' .  ($start_row + 5) . ':U' .  ($start_row + 5))->setCellValue('U' .  ($start_row + 5), '21');
            $objPHPExcel->mergeCells('V' .  ($start_row + 5) . ':V' .  ($start_row + 5))->setCellValue('V' .  ($start_row + 5), '22');
            $objPHPExcel->mergeCells('W' .  ($start_row + 5) . ':W' .  ($start_row + 5))->setCellValue('W' .  ($start_row + 5), '23');
            $objPHPExcel->mergeCells('X' .  ($start_row + 5) . ':X' .  ($start_row + 5))->setCellValue('X' .  ($start_row + 5), '24');
            $objPHPExcel->mergeCells('Y' .  ($start_row + 5) . ':Y' .  ($start_row + 5))->setCellValue('Y' .  ($start_row + 5), '01');
            $objPHPExcel->mergeCells('Z' .  ($start_row + 5) . ':Z' .  ($start_row + 5))->setCellValue('Z' .  ($start_row + 5), '02');
            $objPHPExcel->mergeCells('AA' .  ($start_row + 5) . ':AA' .  ($start_row + 5))->setCellValue('AA' .  ($start_row + 5), '03');
            $objPHPExcel->mergeCells('AB' .  ($start_row + 5) . ':AB' .  ($start_row + 5))->setCellValue('AB' .  ($start_row + 5), '04');
            $objPHPExcel->mergeCells('AC' .  ($start_row + 5) . ':AC' .  ($start_row + 5))->setCellValue('AC' .  ($start_row + 5), '05');
            $objPHPExcel->mergeCells('AD' .  ($start_row + 5) . ':AD' .  ($start_row + 5))->setCellValue('AD' .  ($start_row + 5), '06');
            $objPHPExcel->mergeCells('AE' .  ($start_row + 4) . ':AK' .  ($start_row + 5))->setCellValue('AE' .  ($start_row + 4), 'KETERANGAN');

            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row + 3) . ':A' .  ($start_row + 5));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AL' . ($start_row + 3) . ':AL' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($start_row + 4) . ':AK' . ($start_row + 5));
            $objPHPExcel->getStyle('B' . ($start_row + 4) . ':AK' . ($start_row + 5))->getFont()->setBold(true)->setSize(9);


            $dtl_row = $start_row + 6;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {

                // $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(20);
                // if (isset($no_urut_desc[$arr])) { $dt_no_urut_desc[$arr] = $no_urut_desc[$arr] - 1; } else { $dt_no_urut_desc[$arr] = 0;}
                // if (isset($no_urut[$arr])) { $dt_no_urut[$arr] = $no_urut[$arr]; } else { $dt_no_urut[$arr] = ""; }
                if (isset($boiler[$arr])) {
                    $dt_boiler[$arr] = $boiler[$arr];
                } else {
                    $dt_boiler[$arr] = "";
                }
                // print_r($dt_boiler[$arr]);exit();
                if (isset($tekanan_07[$arr])) {
                    $dt_tekanan_07[$arr] = $tekanan_07[$arr];
                } else {
                    $dt_tekanan_07[$arr] = "";
                }
                if (isset($tekanan_08[$arr])) {
                    $dt_tekanan_08[$arr] = $tekanan_08[$arr];
                } else {
                    $dt_tekanan_08[$arr] = "";
                }
                if (isset($tekanan_09[$arr])) {
                    $dt_tekanan_09[$arr] = $tekanan_09[$arr];
                } else {
                    $dt_tekanan_09[$arr] = "";
                }
                if (isset($tekanan_10[$arr])) {
                    $dt_tekanan_10[$arr] = $tekanan_10[$arr];
                } else {
                    $dt_tekanan_10[$arr] = "";
                }
                if (isset($tekanan_11[$arr])) {
                    $dt_tekanan_11[$arr] = $tekanan_11[$arr];
                } else {
                    $dt_tekanan_11[$arr] = "";
                }
                if (isset($tekanan_12[$arr])) {
                    $dt_tekanan_12[$arr] = $tekanan_12[$arr];
                } else {
                    $dt_tekanan_12[$arr] = "";
                }
                if (isset($tekanan_13[$arr])) {
                    $dt_tekanan_13[$arr] = $tekanan_13[$arr];
                } else {
                    $dt_tekanan_13[$arr] = "";
                }
                if (isset($tekanan_14[$arr])) {
                    $dt_tekanan_14[$arr] = $tekanan_14[$arr];
                } else {
                    $dt_tekanan_14[$arr] = "";
                }
                if (isset($tekanan_15[$arr])) {
                    $dt_tekanan_15[$arr] = $tekanan_15[$arr];
                } else {
                    $dt_tekanan_15[$arr] = "";
                }
                if (isset($tekanan_16[$arr])) {
                    $dt_tekanan_16[$arr] = $tekanan_16[$arr];
                } else {
                    $dt_tekanan_16[$arr] = "";
                }
                if (isset($tekanan_17[$arr])) {
                    $dt_tekanan_17[$arr] = $tekanan_17[$arr];
                } else {
                    $dt_tekanan_17[$arr] = "";
                }
                if (isset($tekanan_18[$arr])) {
                    $dt_tekanan_18[$arr] = $tekanan_18[$arr];
                } else {
                    $dt_tekanan_18[$arr] = "";
                }
                if (isset($tekanan_19[$arr])) {
                    $dt_tekanan_19[$arr] = $tekanan_19[$arr];
                } else {
                    $dt_tekanan_19[$arr] = "";
                }
                if (isset($tekanan_20[$arr])) {
                    $dt_tekanan_20[$arr] = $tekanan_20[$arr];
                } else {
                    $dt_tekanan_20[$arr] = "";
                }
                if (isset($tekanan_21[$arr])) {
                    $dt_tekanan_21[$arr] = $tekanan_21[$arr];
                } else {
                    $dt_tekanan_21[$arr] = "";
                }
                if (isset($tekanan_22[$arr])) {
                    $dt_tekanan_22[$arr] = $tekanan_22[$arr];
                } else {
                    $dt_tekanan_22[$arr] = "";
                }
                if (isset($tekanan_23[$arr])) {
                    $dt_tekanan_23[$arr] = $tekanan_23[$arr];
                } else {
                    $dt_tekanan_23[$arr] = "";
                }
                if (isset($tekanan_24[$arr])) {
                    $dt_tekanan_24[$arr] = $tekanan_24[$arr];
                } else {
                    $dt_tekanan_24[$arr] = "";
                }
                if (isset($tekanan_01[$arr])) {
                    $dt_tekanan_01[$arr] = $tekanan_01[$arr];
                } else {
                    $dt_tekanan_01[$arr] = "";
                }
                if (isset($tekanan_02[$arr])) {
                    $dt_tekanan_02[$arr] = $tekanan_02[$arr];
                } else {
                    $dt_tekanan_02[$arr] = "";
                }
                if (isset($tekanan_03[$arr])) {
                    $dt_tekanan_03[$arr] = $tekanan_03[$arr];
                } else {
                    $dt_tekanan_03[$arr] = "";
                }
                if (isset($tekanan_04[$arr])) {
                    $dt_tekanan_04[$arr] = $tekanan_04[$arr];
                } else {
                    $dt_tekanan_04[$arr] = "";
                }
                if (isset($tekanan_05[$arr])) {
                    $dt_tekanan_05[$arr] = $tekanan_05[$arr];
                } else {
                    $dt_tekanan_05[$arr] = "";
                }
                if (isset($tekanan_06[$arr])) {
                    $dt_tekanan_06[$arr] = $tekanan_06[$arr];
                } else {
                    $dt_tekanan_06[$arr] = "";
                }
                if (isset($keterangan[$arr])) {
                    $dt_keterangan[$arr] = $keterangan[$arr];
                } else {
                    $dt_keterangan[$arr] = "";
                }

                //     if ($dt_no_urut[$a] == 1) {
                //         $objPHPExcel->mergeCells('B' .  $dtl_row . ':G' .  ($dtl_row + $dt_no_urut_desc[$a]))->setCellValue('B' .  $dtl_row, $dt_nama_jenis_air[$a]);
                //     } else if ($dt_no_urut[$a] == 0) {
                //         $objPHPExcel->mergeCells('B' .  $dtl_row . ':G' .  $dtl_row)->setCellValue('B' .  $dtl_row, "");
                //     }
                $objPHPExcel->mergeCells('B' .  $dtl_row . ':F' .  $dtl_row)->setCellValue('B' .  $dtl_row, $dt_boiler[$arr]);
                $objPHPExcel->mergeCells('G' .  $dtl_row . ':G' .  $dtl_row)->setCellValue('G' .  $dtl_row, $dt_tekanan_07[$arr]);
                $objPHPExcel->mergeCells('H' .  $dtl_row . ':H' .  $dtl_row)->setCellValue('H' .  $dtl_row, $dt_tekanan_08[$arr]);
                $objPHPExcel->mergeCells('I' .  $dtl_row . ':I' .  $dtl_row)->setCellValue('I' .  $dtl_row, $dt_tekanan_09[$arr]);
                $objPHPExcel->mergeCells('J' .  $dtl_row . ':J' .  $dtl_row)->setCellValue('J' .  $dtl_row, $dt_tekanan_10[$arr]);
                $objPHPExcel->mergeCells('K' .  $dtl_row . ':K' .  $dtl_row)->setCellValue('K' .  $dtl_row, $dt_tekanan_11[$arr]);
                $objPHPExcel->mergeCells('L' .  $dtl_row . ':L' .  $dtl_row)->setCellValue('L' .  $dtl_row, $dt_tekanan_12[$arr]);
                $objPHPExcel->mergeCells('M' .  $dtl_row . ':M' .  $dtl_row)->setCellValue('M' .  $dtl_row, $dt_tekanan_13[$arr]);
                $objPHPExcel->mergeCells('N' .  $dtl_row . ':N' .  $dtl_row)->setCellValue('N' .  $dtl_row, $dt_tekanan_14[$arr]);
                $objPHPExcel->mergeCells('O' .  $dtl_row . ':O' .  $dtl_row)->setCellValue('O' .  $dtl_row, $dt_tekanan_15[$arr]);
                $objPHPExcel->mergeCells('P' .  $dtl_row . ':P' .  $dtl_row)->setCellValue('P' .  $dtl_row, $dt_tekanan_16[$arr]);
                $objPHPExcel->mergeCells('Q' .  $dtl_row . ':Q' .  $dtl_row)->setCellValue('Q' .  $dtl_row, $dt_tekanan_17[$arr]);
                $objPHPExcel->mergeCells('R' .  $dtl_row . ':R' .  $dtl_row)->setCellValue('R' .  $dtl_row, $dt_tekanan_18[$arr]);
                $objPHPExcel->mergeCells('S' .  $dtl_row . ':S' .  $dtl_row)->setCellValue('S' .  $dtl_row, $dt_tekanan_19[$arr]);
                $objPHPExcel->mergeCells('T' .  $dtl_row . ':T' .  $dtl_row)->setCellValue('T' .  $dtl_row, $dt_tekanan_20[$arr]);
                $objPHPExcel->mergeCells('U' .  $dtl_row . ':U' .  $dtl_row)->setCellValue('U' .  $dtl_row, $dt_tekanan_21[$arr]);
                $objPHPExcel->mergeCells('V' .  $dtl_row . ':V' .  $dtl_row)->setCellValue('V' .  $dtl_row, $dt_tekanan_22[$arr]);
                $objPHPExcel->mergeCells('W' .  $dtl_row . ':W' .  $dtl_row)->setCellValue('W' .  $dtl_row, $dt_tekanan_23[$arr]);
                $objPHPExcel->mergeCells('X' .  $dtl_row . ':X' .  $dtl_row)->setCellValue('X' .  $dtl_row, $dt_tekanan_24[$arr]);
                $objPHPExcel->mergeCells('Y' .  $dtl_row . ':Y' .  $dtl_row)->setCellValue('Y' .  $dtl_row, $dt_tekanan_01[$arr]);
                $objPHPExcel->mergeCells('Z' .  $dtl_row . ':Z' .  $dtl_row)->setCellValue('Z' .  $dtl_row, $dt_tekanan_02[$arr]);
                $objPHPExcel->mergeCells('AA' .  $dtl_row . ':AA' .  $dtl_row)->setCellValue('AA' .  $dtl_row, $dt_tekanan_03[$arr]);
                $objPHPExcel->mergeCells('AB' .  $dtl_row . ':AB' .  $dtl_row)->setCellValue('AB' .  $dtl_row, $dt_tekanan_04[$arr]);
                $objPHPExcel->mergeCells('AC' .  $dtl_row . ':AC' .  $dtl_row)->setCellValue('AC' .  $dtl_row, $dt_tekanan_05[$arr]);
                $objPHPExcel->mergeCells('AD' .  $dtl_row . ':AD' .  $dtl_row)->setCellValue('AD' .  $dtl_row, $dt_tekanan_06[$arr]);
                $objPHPExcel->mergeCells('AE' .  $dtl_row . ':AK' .  $dtl_row)->setCellValue('AE' .  $dtl_row, $dt_keterangan[$arr]);

                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $dtl_row . ':AK' . $dtl_row);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'AL' . ($dtl_row) . ':AL' . ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row) . ':A' .  ($dtl_row));
                $dtl_row++;
            }
            $table2 = $dtl_row;

            $objPHPExcel->mergeCells('B' .  ($table2 + 1) . ':E' .  ($table2 + 2))->setCellValue('B' .  ($table2 + 1), 'URAIAN');
            $objPHPExcel->mergeCells('F' .  ($table2 + 1) . ':K' .  ($table2 + 1))->setCellValue('F' .  ($table2 + 1), 'PENERIMAAN');
            $objPHPExcel->mergeCells('F' .  ($table2 + 2) . ':H' .  ($table2 + 2))->setCellValue('F' .  ($table2 + 2), 'Kg');
            $objPHPExcel->mergeCells('I' .  ($table2 + 2) . ':K' .  ($table2 + 2))->setCellValue('I' .  ($table2 + 2), 'Akumulatif');
            $objPHPExcel->mergeCells('L' .  ($table2 + 1) . ':Q' .  ($table2 + 1))->setCellValue('L' .  ($table2 + 1), 'PEMAKAIAN');
            $objPHPExcel->mergeCells('L' .  ($table2 + 2) . ':N' .  ($table2 + 2))->setCellValue('L' .  ($table2 + 2), 'Kg');
            $objPHPExcel->mergeCells('O' .  ($table2 + 2) . ':Q' .  ($table2 + 2))->setCellValue('O' .  ($table2 + 2), 'Akumulatif');
            $objPHPExcel->mergeCells('R' .  ($table2 + 1) . ':U' .  ($table2 + 2))->setCellValue('R' .  ($table2 + 1), 'STOCK TEMPURUNG (kg)');
            $objPHPExcel->setSharedStyle($headerStyle, 'B' . ($table2 + 1) . ':U' . ($table2 + 2));

            $objPHPExcel->mergeCells('V' .  ($table2 + 1) . ':AK' .  ($table2 + 1))->setCellValue('V' .  ($table2 + 1), 'BAHAN KIMIA (Kg)');
            $objPHPExcel->mergeCells('V' .  ($table2 + 2) . ':Y' .  ($table2 + 2))->setCellValue('V' .  ($table2 + 2), 'URAIAN');
            $objPHPExcel->mergeCells('Z' .  ($table2 + 2) . ':AA' .  ($table2 + 2))->setCellValue('Z' .  ($table2 + 2), 'TERIMA');
            $objPHPExcel->mergeCells('AB' .  ($table2 + 2) . ':AC' .  ($table2 + 2))->setCellValue('AB' .  ($table2 + 2), 'PAKAI');
            $objPHPExcel->mergeCells('AD' .  ($table2 + 2) . ':AE' .  ($table2 + 2))->setCellValue('AD' .  ($table2 + 2), 'Akumulatif');
            $objPHPExcel->mergeCells('AF' .  ($table2 + 2) . ':AG' .  ($table2 + 2))->setCellValue('AF' .  ($table2 + 2), 'EFF(%)');
            $objPHPExcel->mergeCells('AH' .  ($table2 + 2) . ':AI' .  ($table2 + 2))->setCellValue('AH' .  ($table2 + 2), 'STOCK');
            $objPHPExcel->mergeCells('AJ' .  ($table2 + 2) . ':AK' .  ($table2 + 2))->setCellValue('AJ' .  ($table2 + 2), 'NO. DO');
            $objPHPExcel->setSharedStyle($headerStyle, 'V' . ($table2 + 1) . ':AK' . ($table2 + 2));


            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($table2) . ':A' . ($table2 + 2));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AL' . ($table2) . ':AL' . ($table2 + 2));
            $objPHPExcel->getStyle('B' . ($table2 + 1) . ':AK' . ($table2 + 2))->getFont()->setBold(true)->setSize(9);

            $table2_dtl = $table2 + 3;
            $start_detail2 = ($i1 * $jml_data_perpage_b);
            $finish_detail2 = (($i1 * $jml_data_perpage_b) + ($jml_data_perpage_b - 1));

            for ($arrb = $start_detail2; $arrb <= $finish_detail2; $arrb++) {

                // $objPHPExcel->getRowDimension($table2_dtl)->setRowHeight(20);
                // if (isset($no_urut_desc[$arrb])) { $dt_no_urut_desc[$arrb] = $no_urut_desc[$arrb] - 1; } else { $dt_no_urut_desc[$arrb] = 0;}
                // if (isset($no_urut[$arrb])) { $dt_no_urut[$arrb] = $no_urut[$arrb]; } else { $dt_no_urut[$arrb] = ""; }
                if (isset($dtlb_uraian[$arrb])) {
                    $dt_dtlb_uraian[$arrb] = $dtlb_uraian[$arrb];
                } else {
                    $dt_dtlb_uraian[$arrb] = "";
                }
                if (isset($dtlb_penerimaan_kg[$arrb])) {
                    $dt_dtlb_penerimaan_kg[$arrb] = $dtlb_penerimaan_kg[$arrb];
                } else {
                    $dt_dtlb_penerimaan_kg[$arrb] = "";
                }
                if (isset($dtlb_penerimaan_akm[$arrb])) {
                    $dt_dtlb_penerimaan_akm[$arrb] = $dtlb_penerimaan_akm[$arrb];
                } else {
                    $dt_dtlb_penerimaan_akm[$arrb] = "";
                }
                if (isset($dtlb_pemakaian_kg[$arrb])) {
                    $dt_dtlb_pemakaian_kg[$arrb] = $dtlb_pemakaian_kg[$arrb];
                } else {
                    $dt_dtlb_pemakaian_kg[$arrb] = "";
                }
                if (isset($dtlb_pemakaian_akm[$arrb])) {
                    $dt_dtlb_pemakaian_akm[$arrb] = $dtlb_pemakaian_akm[$arrb];
                } else {
                    $dt_dtlb_pemakaian_akm[$arrb] = "";
                }
                if (isset($dtlb_stock_tmp[$arrb])) {
                    $dt_dtlb_stock_tmp[$arrb] = $dtlb_stock_tmp[$arrb];
                } else {
                    $dt_dtlb_stock_tmp[$arrb] = "";
                }

                if (isset($dtlb2_uraian[$arrb])) {
                    $dt_dtlb2_uraian[$arrb] = $dtlb2_uraian[$arrb];
                } else {
                    $dtlb2_uraian[$arrb] = "";
                }
                if (isset($dtlb2_terima[$arrb])) {
                    $dt_dtlb2_terima[$arrb] = $dtlb2_terima[$arrb];
                } else {
                    $dtlb2_terima[$arrb] = "";
                }
                if (isset($dtlb2_pakai[$arrb])) {
                    $dt_dtlb2_pakai[$arrb] = $dtlb2_pakai[$arrb];
                } else {
                    $dtlb2_pakai[$arrb] = "";
                }
                if (isset($dtlb2_akm[$arrb])) {
                    $dt_dtlb2_akm[$arrb] = $dtlb2_akm[$arrb];
                } else {
                    $dtlb2_akm[$arrb] = "";
                }
                if (isset($dtlb2_eff[$arrb])) {
                    $dt_dtlb2_eff[$arrb] = $dtlb2_eff[$arrb];
                } else {
                    $dtlb2_eff[$arrb] = "";
                }
                if (isset($dtlb2_stock[$arrb])) {
                    $dt_dtlb2_stock[$arrb] = $dtlb2_stock[$arrb];
                } else {
                    $dtlb2_stock[$arrb] = "";
                }
                if (isset($dtlb2_nodo[$arrb])) {
                    $dt_dtlb2_nodo[$arrb] = $dtlb2_nodo[$arrb];
                } else {
                    $dtlb2_nodo[$arrb] = "";
                }

                //     if ($dt_no_urut[$a] == 1) {
                //         $objPHPExcel->mergeCells('B' .  $table2_dtl . ':G' .  ($table2_dtl + $dt_no_urut_desc[$a]))->setCellValue('B' .  $table2_dtl, $dt_nama_jenis_air[$a]);
                //     } else if ($dt_no_urut[$a] == 0) {
                //         $objPHPExcel->mergeCells('B' .  $table2_dtl . ':G' .  $table2_dtl)->setCellValue('B' .  $table2_dtl, "");
                //     }

                $objPHPExcel->mergeCells('B' .  $table2_dtl . ':E' .  $table2_dtl)->setCellValue('B' .  $table2_dtl, $dt_dtlb_uraian[$arrb]);
                $objPHPExcel->mergeCells('F' .  $table2_dtl . ':H' .  $table2_dtl)->setCellValue('F' .  $table2_dtl, $dt_dtlb_penerimaan_kg[$arrb]);
                $objPHPExcel->mergeCells('I' .  $table2_dtl . ':K' .  $table2_dtl)->setCellValue('I' .  $table2_dtl, $dt_dtlb_penerimaan_akm[$arrb]);
                $objPHPExcel->mergeCells('L' .  $table2_dtl . ':N' .  $table2_dtl)->setCellValue('L' .  $table2_dtl, $dt_dtlb_pemakaian_kg[$arrb]);
                $objPHPExcel->mergeCells('O' .  $table2_dtl . ':Q' .  $table2_dtl)->setCellValue('O' .  $table2_dtl, $dt_dtlb_pemakaian_akm[$arrb]);
                $objPHPExcel->mergeCells('R' .  $table2_dtl . ':U' .  $table2_dtl)->setCellValue('R' .  $table2_dtl, $dt_dtlb_stock_tmp[$arrb]);

                $objPHPExcel->mergeCells('V' .  $table2_dtl . ':Y' .  $table2_dtl)->setCellValue('V' .  $table2_dtl, $dt_dtlb2_uraian[$arrb]);
                $objPHPExcel->mergeCells('Z' .  $table2_dtl . ':AA' .  $table2_dtl)->setCellValue('Z' .  $table2_dtl, $dt_dtlb2_terima[$arrb]);
                $objPHPExcel->mergeCells('AB' .  $table2_dtl . ':AC' .  $table2_dtl)->setCellValue('AB' .  $table2_dtl, $dt_dtlb2_pakai[$arrb]);
                $objPHPExcel->mergeCells('AD' .  $table2_dtl . ':AE' .  $table2_dtl)->setCellValue('AD' .  $table2_dtl, $dt_dtlb2_akm[$arrb]);
                $objPHPExcel->mergeCells('AF' .  $table2_dtl . ':AG' .  $table2_dtl)->setCellValue('AF' .  $table2_dtl, $dt_dtlb2_eff[$arrb]);
                $objPHPExcel->mergeCells('AH' .  $table2_dtl . ':AI' .  $table2_dtl)->setCellValue('AH' .  $table2_dtl, $dt_dtlb2_stock[$arrb]);
                $objPHPExcel->mergeCells('AJ' .  $table2_dtl . ':AK' .  $table2_dtl)->setCellValue('AJ' .  $table2_dtl, $dt_dtlb2_nodo[$arrb]);

                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $table2_dtl . ':AK' . $table2_dtl);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'AL' . ($table2_dtl) . ':AL' . ($table2_dtl));
                $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($table2_dtl) . ':A' .  ($table2_dtl));
                $table2_dtl++;
            }
            $objPHPExcel->mergeCells('B' .  ($table2 + 7) . ':E' .  ($table2 + 7))->setCellValue('B' .  ($table2 + 7), 'Selisih Opname');
            $objPHPExcel->mergeCells('B' .  ($table2 + 8) . ':E' .  ($table2 + 8))->setCellValue('B' .  ($table2 + 8), 'TOTAL TPR');
            $objPHPExcel->mergeCells('F' .  ($table2 + 8) . ':H' .  ($table2 + 8))->setCellValue('F' .  ($table2 + 8), $total_dtlb_penerimaan_kg);
            $objPHPExcel->mergeCells('I' .  ($table2 + 8) . ':K' .  ($table2 + 8))->setCellValue('I' .  ($table2 + 8), $total_dtlb_penerimaan_akm);
            $objPHPExcel->mergeCells('L' .  ($table2 + 8) . ':N' .  ($table2 + 8))->setCellValue('L' .  ($table2 + 8), $total_dtlb_pemakaian_kg);
            $objPHPExcel->mergeCells('O' .  ($table2 + 8) . ':Q' .  ($table2 + 8))->setCellValue('O' .  ($table2 + 8), $total_dtlb_pemakaian_akm);
            $objPHPExcel->mergeCells('R' .  ($table2 + 7) . ':U' .  ($table2 + 7))->setCellValue('R' .  ($table2 + 7), $selisih_opname);
            $objPHPExcel->mergeCells('R' .  ($table2 + 8) . ':U' .  ($table2 + 8))->setCellValue('R' .  ($table2 + 8), $stock_akhir_tmp);
            $objPHPExcel->setSharedStyle($bodyStyle, 'B' . ($table2 + 8) . ':U' . ($table2 + 8));
            $objPHPExcel->getStyle('B' . ($table2 + 8) . ':AK' . ($table2 + 8))->getFont()->setBold(true)->setSize(9);
            $color = array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B6E5DF')
                )
            );
            $objPHPExcel->getStyle('R' .  ($table2 + 3) . ':U' .  ($table2 + 6))->applyFromArray($color);
            $objPHPExcel->getStyle('F' .  ($table2 + 6) . ':K' .  ($table2 + 6))->applyFromArray($color);
            $objPHPExcel->getStyle('F' .  ($table2 + 7) . ':Q' .  ($table2 + 7))->applyFromArray($color);

            $table3 = $table2_dtl + 1;

            $objPHPExcel->setSharedStyle($noborderStyle,  'A' .  ($table3) . ':AL' .  ($table3 + 12));

            $objPHPExcel->mergeCells('B' .  ($table3 + 1) . ':E' .  ($table3 + 2))->setCellValue('B' .  ($table3 + 1), 'KODE BOILER');
            $objPHPExcel->mergeCells('F' .  ($table3 + 1) . ':G' .  ($table3 + 1))->setCellValue('F' .  ($table3 + 1), 'Jam Operasi');
            $objPHPExcel->mergeCells('F' .  ($table3 + 2) . ':F' .  ($table3 + 2))->setCellValue('F' .  ($table3 + 2), 'Hari ini');
            $objPHPExcel->mergeCells('G' .  ($table3 + 2) . ':G' .  ($table3 + 2))->setCellValue('G' .  ($table3 + 2), 'AKM');
            $objPHPExcel->mergeCells('H' .  ($table3 + 1) . ':O' .  ($table3 + 1))->setCellValue('H' .  ($table3 + 1), 'PEMAKAIAN TEMPURUNG');
            $objPHPExcel->mergeCells('H' .  ($table3 + 2) . ':K' .  ($table3 + 2))->setCellValue('H' .  ($table3 + 2), 'Hari ini (Kg)');
            $objPHPExcel->mergeCells('L' .  ($table3 + 2) . ':O' .  ($table3 + 2))->setCellValue('L' .  ($table3 + 2), 'Akumulatif');
            $objPHPExcel->mergeCells('P' .  ($table3 + 1) . ':W' .  ($table3 + 1))->setCellValue('P' .  ($table3 + 1), 'OUTPUT STEAM');
            $objPHPExcel->mergeCells('P' .  ($table3 + 2) . ':S' .  ($table3 + 2))->setCellValue('P' .  ($table3 + 2), 'Hari ini (Ton)');
            $objPHPExcel->mergeCells('T' .  ($table3 + 2) . ':W' .  ($table3 + 2))->setCellValue('T' .  ($table3 + 2), 'Akumulatif');
            $objPHPExcel->mergeCells('X' .  ($table3 + 1) . ':AC' .  ($table3 + 1))->setCellValue('X' .  ($table3 + 1), 'PEMAKAIAN AIR');
            $objPHPExcel->mergeCells('X' .  ($table3 + 2) . ':Z' .  ($table3 + 2))->setCellValue('X' .  ($table3 + 2), 'Hari ini (㎥)');
            $objPHPExcel->mergeCells('AA' .  ($table3 + 2) . ':AC' .  ($table3 + 2))->setCellValue('AA' .  ($table3 + 2), 'Akumulatif');

            $objPHPExcel->mergeCells('AD' .  ($table3 + 1) . ':AK' .  ($table3 + 1))->setCellValue('AD' .  ($table3 + 1), 'Keterangan');
            $objPHPExcel->mergeCells('AD' .  ($table3 + 2) . ':AF' .  ($table3 + 2))->setCellValue('AD' .  ($table3 + 2), 'Air Dearator =');
            $objPHPExcel->mergeCells('AG' .  ($table3 + 2) . ':AG' .  ($table3 + 2))->setCellValue('AG' .  ($table3 + 2), $air_dearator);
            $objPHPExcel->mergeCells('AH' .  ($table3 + 2) . ':AH' .  ($table3 + 2))->setCellValue('AH' .  ($table3 + 2), 'M3');
            // $objPHPExcel->mergeCells('AD' .  ($table3 + 3) . ':AG' .  ($table3 + 3))->setCellValue('AD' .  ($table3 + 3), '');
            $objPHPExcel->mergeCells('AH' .  ($table3 + 3) . ':AH' .  ($table3 + 3))->setCellValue('AH' .  ($table3 + 3), 'M3');
            // $objPHPExcel->mergeCells('AI' .  ($table3 + 3) . ':AI' .  ($table3 + 7))->setCellValue('AI' .  ($table3 + 3), '');
            // $objPHPExcel->mergeCells('AK' .  ($table3 + 3) . ':AK' .  ($table3 + 7))->setCellValue('AK' .  ($table3 + 3), '');
            $objPHPExcel->mergeCells('AJ' .  ($table3 + 3) . ':AJ' .  ($table3 + 3))->setCellValue('AJ' .  ($table3 + 3), '%');
            $objPHPExcel->mergeCells('AD' .  ($table3 + 4) . ':AF' .  ($table3 + 4))->setCellValue('AD' .  ($table3 + 4), 'Air Dearator');
            $objPHPExcel->mergeCells('AG' .  ($table3 + 4) . ':AG' .  ($table3 + 4))->setCellValue('AG' .  ($table3 + 4), ' = ');
            $objPHPExcel->mergeCells('AH' .  ($table3 + 4) . ':AH' .  ($table3 + 4))->setCellValue('AH' .  ($table3 + 4), $air_wtd);
            $objPHPExcel->mergeCells('AJ' .  ($table3 + 4) . ':AJ' .  ($table3 + 4))->setCellValue('AJ' .  ($table3 + 4), $prsn_air_wtd);
            $objPHPExcel->mergeCells('AD' .  ($table3 + 5) . ':AF' .  ($table3 + 5))->setCellValue('AD' .  ($table3 + 5), 'Air Condensate');
            $objPHPExcel->mergeCells('AG' .  ($table3 + 5) . ':AG' .  ($table3 + 5))->setCellValue('AG' .  ($table3 + 5), ' = ');
            $objPHPExcel->mergeCells('AH' .  ($table3 + 5) . ':AH' .  ($table3 + 5))->setCellValue('AH' .  ($table3 + 5), $air_condensate);
            $objPHPExcel->mergeCells('AJ' .  ($table3 + 5) . ':AJ' .  ($table3 + 5))->setCellValue('AJ' .  ($table3 + 5), $prsn_air_condensate);
            $objPHPExcel->mergeCells('AD' .  ($table3 + 6) . ':AF' .  ($table3 + 6))->setCellValue('AD' .  ($table3 + 6), 'Total Air utk BLR');
            $objPHPExcel->mergeCells('AG' .  ($table3 + 6) . ':AG' .  ($table3 + 6))->setCellValue('AG' .  ($table3 + 6), ' = ');
            $objPHPExcel->mergeCells('AH' .  ($table3 + 6) . ':AH' .  ($table3 + 6))->setCellValue('AH' .  ($table3 + 6), $air_blr);
            $objPHPExcel->mergeCells('AJ' .  ($table3 + 6) . ':AJ' .  ($table3 + 6))->setCellValue('AJ' .  ($table3 + 6), $prsn_air_blr);
            $objPHPExcel->mergeCells('AD' .  ($table3 + 8) . ':AG' .  ($table3 + 8))->setCellValue('AD' .  ($table3 + 8), 'Total Return Condensate');
            $objPHPExcel->mergeCells('AH' .  ($table3 + 8) . ':AH' .  ($table3 + 8))->setCellValue('AH' .  ($table3 + 8), ' = ');
            $objPHPExcel->mergeCells('AI' .  ($table3 + 8) . ':AJ' .  ($table3 + 8))->setCellValue('AI' .  ($table3 + 8), $total_return);
            $objPHPExcel->mergeCells('AK' .  ($table3 + 8) . ':AK' .  ($table3 + 8))->setCellValue('AK' .  ($table3 + 8), 'M3');

            $objPHPExcel->mergeCells('AD' .  ($table3 + 10) . ':AH' .  ($table3 + 10))->setCellValue('AD' .  ($table3 + 10), 'Tempurung (Kg/Jam) = Max 900');
            $objPHPExcel->mergeCells('AI' .  ($table3 + 10) . ':AK' .  ($table3 + 10))->setCellValue('AI' .  ($table3 + 10), 'Realisasi = ' . $realisasi);
            $objPHPExcel->mergeCells('AD' .  ($table3 + 11) . ':AH' .  ($table3 + 11))->setCellValue('AD' .  ($table3 + 11), 'Tempurung (Kg/Jam) Bulan ' . $bulan);
            $objPHPExcel->mergeCells('AI' .  ($table3 + 11) . ':AK' .  ($table3 + 11))->setCellValue('AI' .  ($table3 + 11), $temp_bulan_lalu);

            $objPHPExcel->setSharedStyle($bodyStyle,  'AD' .  ($table3 + 10) . ':AK' .  ($table3 + 11));
            $objPHPExcel->getStyle('AD' . ($table3 + 10) . ':AK' . ($table3 + 11))->getFont()->setBold(true)->setSize(9);
            $objPHPExcel->getStyle('AD' . ($table3 + 8) . ':AK' . ($table3 + 8))->getFont()->setBold(true)->setSize(9);
            $objPHPExcel->getStyle('AD' . ($table3 + 6) . ':AK' . ($table3 + 6))->getFont()->setBold(true)->setSize(9);
            $objPHPExcel->getStyle('AD' . ($table3 + 1) . ':AK' . ($table3 + 1))->getFont()->setBold(true)->setSize(9);

            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($table3 - 1) . ':A' .  ($table3 + 2));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AL' . ($table3 - 1) . ':AL' . ($table3 + 2));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($table3 + 1) . ':AC' . ($table3 + 2));
            $objPHPExcel->getStyle('B' . ($table3 + 1) . ':AC' . ($table3 + 2))->getFont()->setBold(true)->setSize(9);


            $table3_dtl = $table3 + 3;
            $start_detail3 = ($i1 * $jml_data_perpage_c);
            $finish_detail3 = (($i1 * $jml_data_perpage_c) + ($jml_data_perpage_c - 1));

            for ($arrc = $start_detail3; $arrc <= $finish_detail3; $arrc++) {

                if (isset($dtlc_kode_boiler[$arrc])) {
                    $dt_dtlc_kode_boiler[$arrc] = $dtlc_kode_boiler[$arrc];
                } else {
                    $dt_dtlc_kode_boiler[$arrc] = "";
                }
                if (isset($dtlc_total_jam[$arrc])) {
                    $dt_dtlc_total_jam[$arrc] = $dtlc_total_jam[$arrc];
                } else {
                    $dt_dtlc_total_jam[$arrc] = "";
                }
                if (isset($dtlc_jam_akm[$arrc])) {
                    $dt_dtlc_jam_akm[$arrc] = $dtlc_jam_akm[$arrc];
                } else {
                    $dt_dtlc_jam_akm[$arrc] = "";
                }
                if (isset($dtlc_tmpr_kg[$arrc])) {
                    $dt_dtlc_tmpr_kg[$arrc] = $dtlc_tmpr_kg[$arrc];
                } else {
                    $dt_dtlc_tmpr_kg[$arrc] = "";
                }
                if (isset($dtlc_tmpr_akm[$arrc])) {
                    $dt_dtlc_tmpr_akm[$arrc] = $dtlc_tmpr_akm[$arrc];
                } else {
                    $dt_dtlc_tmpr_akm[$arrc] = "";
                }
                if (isset($dtlc_steam_ton[$arrc])) {
                    $dt_dtlc_steam_ton[$arrc] = $dtlc_steam_ton[$arrc];
                } else {
                    $dt_dtlc_steam_ton[$arrc] = "";
                }
                if (isset($dtlc_steam_akm[$arrc])) {
                    $dt_dtlc_steam_akm[$arrc] = $dtlc_steam_akm[$arrc];
                } else {
                    $dt_dtlc_steam_akm[$arrc] = "";
                }
                if (isset($dtlc_total_air[$arrc])) {
                    $dt_dtlc_total_air[$arrc] = $dtlc_total_air[$arrc];
                } else {
                    $dt_dtlc_total_air[$arrc] = "";
                }
                if (isset($dtlc_air_akm[$arrc])) {
                    $dt_dtlc_air_akm[$arrc] = $dtlc_air_akm[$arrc];
                } else {
                    $dt_dtlc_air_akm[$arrc] = "";
                }

                $objPHPExcel->mergeCells('B' .  $table3_dtl . ':E' .  $table3_dtl)->setCellValue('B' .  $table3_dtl, $dt_dtlc_kode_boiler[$arrc]);
                $objPHPExcel->mergeCells('F' .  $table3_dtl . ':F' .  $table3_dtl)->setCellValue('F' .  $table3_dtl, $dt_dtlc_total_jam[$arrc]);
                $objPHPExcel->mergeCells('G' .  $table3_dtl . ':G' .  $table3_dtl)->setCellValue('G' .  $table3_dtl, $dt_dtlc_jam_akm[$arrc]);
                $objPHPExcel->mergeCells('H' .  $table3_dtl . ':K' .  $table3_dtl)->setCellValue('H' .  $table3_dtl, $dt_dtlc_tmpr_kg[$arrc]);
                $objPHPExcel->mergeCells('L' .  $table3_dtl . ':O' .  $table3_dtl)->setCellValue('L' .  $table3_dtl, $dt_dtlc_tmpr_akm[$arrc]);
                $objPHPExcel->mergeCells('P' .  $table3_dtl . ':S' .  $table3_dtl)->setCellValue('P' .  $table3_dtl, $dt_dtlc_steam_ton[$arrc]);
                $objPHPExcel->mergeCells('T' .  $table3_dtl . ':W' .  $table3_dtl)->setCellValue('T' .  $table3_dtl, $dt_dtlc_steam_akm[$arrc]);
                $objPHPExcel->mergeCells('X' .  $table3_dtl . ':Z' .  $table3_dtl)->setCellValue('X' .  $table3_dtl, $dt_dtlc_total_air[$arrc]);
                $objPHPExcel->mergeCells('AA' .  $table3_dtl . ':AC' .  $table3_dtl)->setCellValue('AA' .  $table3_dtl, $dt_dtlc_air_akm[$arrc]);

                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $table3_dtl . ':AC' . $table3_dtl);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'AL' . ($table3_dtl) . ':AL' . ($table3_dtl));
                $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($table3_dtl) . ':A' .  ($table3_dtl));
                $table3_dtl++;
            }
            $objPHPExcel->mergeCells('B' .  ($table3_dtl) . ':E' .  ($table3_dtl))->setCellValue('B' .  ($table3_dtl), 'TOTAL');
            $objPHPExcel->mergeCells('F' .  ($table3_dtl) . ':F' .  ($table3_dtl))->setCellValue('F' .  ($table3_dtl), $total_dtlc_total_jam);
            $objPHPExcel->mergeCells('G' .  ($table3_dtl) . ':G' .  ($table3_dtl))->setCellValue('G' .  ($table3_dtl), $total_dtlc_jam_akm);
            $objPHPExcel->mergeCells('H' .  ($table3_dtl) . ':K' .  ($table3_dtl))->setCellValue('H' .  ($table3_dtl), $total_dtlc_tmpr_kg);
            $objPHPExcel->mergeCells('L' .  ($table3_dtl) . ':O' .  ($table3_dtl))->setCellValue('L' .  ($table3_dtl), $total_dtlc_tmpr_akm);
            $objPHPExcel->mergeCells('P' .  ($table3_dtl) . ':S' .  ($table3_dtl))->setCellValue('P' .  ($table3_dtl), $total_dtlc_steam_ton);
            $objPHPExcel->mergeCells('T' .  ($table3_dtl) . ':W' .  ($table3_dtl))->setCellValue('T' .  ($table3_dtl), $total_dtlc_steam_akm);
            $objPHPExcel->mergeCells('X' .  ($table3_dtl) . ':Z' .  ($table3_dtl))->setCellValue('X' .  ($table3_dtl), $total_dtlc_total_air);
            $objPHPExcel->mergeCells('AA' .  ($table3_dtl) . ':AC' .  ($table3_dtl))->setCellValue('AA' .  ($table3_dtl), $total_dtlc_air_akm);


            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($table3_dtl) . ':AC' . ($table3_dtl));

            // print_r($total_dtlc_total_jam);exit();
            $table4 = $table3_dtl + 1;

            $objPHPExcel->mergeCells('B' .  ($table4 + 1) . ':E' .  ($table4 + 2))->setCellValue('B' .  ($table4 + 1), 'URAIAN');
            $objPHPExcel->mergeCells('F' .  ($table4 + 1) . ':G' .  ($table4 + 2))->setCellValue('F' .  ($table4 + 1), 'JAM');
            $objPHPExcel->mergeCells('H' .  ($table4 + 1) . ':O' .  ($table4 + 1))->setCellValue('H' .  ($table4 + 1), 'PEMAKAIAN TEMPURUNG');
            $objPHPExcel->mergeCells('H' .  ($table4 + 2) . ':K' .  ($table4 + 2))->setCellValue('H' .  ($table4 + 2), 'Hari ini(Kg)');
            $objPHPExcel->mergeCells('L' .  ($table4 + 2) . ':O' .  ($table4 + 2))->setCellValue('L' .  ($table4 + 2), 'Akumulatif');
            $objPHPExcel->mergeCells('P' .  ($table4 + 1) . ':W' .  ($table4 + 1))->setCellValue('P' .  ($table4 + 1), 'PEMAKAIAN STEAM');
            $objPHPExcel->mergeCells('P' .  ($table4 + 2) . ':S' .  ($table4 + 2))->setCellValue('P' .  ($table4 + 2), 'Hari ini(Ton)');
            $objPHPExcel->mergeCells('T' .  ($table4 + 2) . ':W' .  ($table4 + 2))->setCellValue('T' .  ($table4 + 2), 'Akumulatif');
            $objPHPExcel->mergeCells('X' .  ($table4 + 1) . ':AC' .  ($table4 + 1))->setCellValue('X' .  ($table4 + 1), 'PEMAKAIAN AIR');
            $objPHPExcel->mergeCells('X' .  ($table4 + 2) . ':Z' .  ($table4 + 2))->setCellValue('X' .  ($table4 + 2), 'Hari ini(㎥)');
            $objPHPExcel->mergeCells('AA' .  ($table4 + 2) . ':AC' .  ($table4 + 2))->setCellValue('AA' .  ($table4 + 2), 'Akumulatif');

            $objPHPExcel->mergeCells('AE' .  ($table4 + 1) . ':AH' .  ($table4 + 1))->setCellValue('AE' .  ($table4 + 1), 'DEFINISI :');
            $objPHPExcel->getStyle('AE' . ($table4 + 1) . ':AH' . ($table4 + 1))->getFont()->setBold(true)->setSize(9);
            $objPHPExcel->mergeCells('AE' .  ($table4 + 2) . ':AE' .  ($table4 + 2))->setCellValue('AE' .  ($table4 + 2), 'TPR');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 3) . ':AE' .  ($table4 + 3))->setCellValue('AE' .  ($table4 + 3), 'MPD');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 4) . ':AE' .  ($table4 + 4))->setCellValue('AE' .  ($table4 + 4), 'Kg');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 5) . ':AE' .  ($table4 + 5))->setCellValue('AE' .  ($table4 + 5), 'N');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 6) . ':AE' .  ($table4 + 6))->setCellValue('AE' .  ($table4 + 6), 'PMK');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 7) . ':AE' .  ($table4 + 7))->setCellValue('AE' .  ($table4 + 7), 'DRP');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 8) . ':AE' .  ($table4 + 8))->setCellValue('AE' .  ($table4 + 8), 'WTP');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 9) . ':AE' .  ($table4 + 9))->setCellValue('AE' .  ($table4 + 9), 'CMP');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 10) . ':AE' .  ($table4 + 10))->setCellValue('AE' .  ($table4 + 10), 'CWC');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 11) . ':AE' .  ($table4 + 11))->setCellValue('AE' .  ($table4 + 11), 'MGR');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 12) . ':AE' .  ($table4 + 12))->setCellValue('AE' .  ($table4 + 12), 'KB');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 13) . ':AE' .  ($table4 + 13))->setCellValue('AE' .  ($table4 + 13), 'ADM');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 14) . ':AE' .  ($table4 + 14))->setCellValue('AE' .  ($table4 + 14), 'DO');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 15) . ':AE' .  ($table4 + 15))->setCellValue('AE' .  ($table4 + 15), 'BLR');
            $objPHPExcel->mergeCells('AE' .  ($table4 + 16) . ':AE' .  ($table4 + 16))->setCellValue('AE' .  ($table4 + 16), 'AKM');

            $objPHPExcel->mergeCells('AF' .  ($table4 + 2) . ':AF' .  ($table4 + 2))->setCellValue('AF' .  ($table4 + 2), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 3) . ':AF' .  ($table4 + 3))->setCellValue('AF' .  ($table4 + 3), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 4) . ':AF' .  ($table4 + 4))->setCellValue('AF' .  ($table4 + 4), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 5) . ':AF' .  ($table4 + 5))->setCellValue('AF' .  ($table4 + 5), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 6) . ':AF' .  ($table4 + 6))->setCellValue('AF' .  ($table4 + 6), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 7) . ':AF' .  ($table4 + 7))->setCellValue('AF' .  ($table4 + 7), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 8) . ':AF' .  ($table4 + 8))->setCellValue('AF' .  ($table4 + 8), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 9) . ':AF' .  ($table4 + 9))->setCellValue('AF' .  ($table4 + 9), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 10) . ':AF' .  ($table4 + 10))->setCellValue('AF' .  ($table4 + 10), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 11) . ':AF' .  ($table4 + 11))->setCellValue('AF' .  ($table4 + 11), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 12) . ':AF' .  ($table4 + 12))->setCellValue('AF' .  ($table4 + 12), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 13) . ':AF' .  ($table4 + 13))->setCellValue('AF' .  ($table4 + 13), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 14) . ':AF' .  ($table4 + 14))->setCellValue('AF' .  ($table4 + 14), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 15) . ':AF' .  ($table4 + 15))->setCellValue('AF' .  ($table4 + 15), '=');
            $objPHPExcel->mergeCells('AF' .  ($table4 + 16) . ':AF' .  ($table4 + 16))->setCellValue('AF' .  ($table4 + 16), '=');

            $objPHPExcel->mergeCells('AG' .  ($table4 + 2) . ':AK' .  ($table4 + 2))->setCellValue('AG' .  ($table4 + 2), 'Tempurung');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 3) . ':AK' .  ($table4 + 3))->setCellValue('AG' .  ($table4 + 3), 'Meat Preparation Departement');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 4) . ':AK' .  ($table4 + 4))->setCellValue('AG' .  ($table4 + 4), 'Kilo Gram');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 5) . ':AK' .  ($table4 + 5))->setCellValue('AG' .  ($table4 + 5), 'Nalco');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 6) . ':AK' .  ($table4 + 6))->setCellValue('AG' .  ($table4 + 6), 'Pabrik Minyak Kelapa');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 7) . ':AK' .  ($table4 + 7))->setCellValue('AG' .  ($table4 + 7), 'Dry Process');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 8) . ':AK' .  ($table4 + 8))->setCellValue('AG' .  ($table4 + 8), 'Wet Process');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 9) . ':AK' .  ($table4 + 9))->setCellValue('AG' .  ($table4 + 9), 'Coconut Milk Powder');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 10) . ':AK' .  ($table4 + 10))->setCellValue('AG' .  ($table4 + 10), 'Coconut Water Concentrate');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 11) . ':AK' .  ($table4 + 11))->setCellValue('AG' .  ($table4 + 11), 'Manager');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 12) . ':AK' .  ($table4 + 12))->setCellValue('AG' .  ($table4 + 12), 'Kepala Bagian');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 13) . ':AK' .  ($table4 + 13))->setCellValue('AG' .  ($table4 + 13), 'Administrasi');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 14) . ':AK' .  ($table4 + 14))->setCellValue('AG' .  ($table4 + 14), 'Delivery Order');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 15) . ':AK' .  ($table4 + 15))->setCellValue('AG' .  ($table4 + 15), 'Boiler');
            $objPHPExcel->mergeCells('AG' .  ($table4 + 16) . ':AK' .  ($table4 + 16))->setCellValue('AG' .  ($table4 + 16), 'Akumulatif');

            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($table4 - 1) . ':A' .  ($table4 + 2));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AL' . ($table4 - 1) . ':AL' . ($table4 + 2));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($table4 + 1) . ':AC' . ($table4 + 2));
            $objPHPExcel->setSharedStyle($noborderStyle, 'AD' . ($table4 + 1) . ':AK' . ($table4 + 2));

            $table4_dtl = $table4 + 3;
            $start_detail4 = ($i1 * $jml_data_perpage_d);
            $finish_detail4 = (($i1 * $jml_data_perpage_d) + ($jml_data_perpage_d - 1));

            for ($arrc = $start_detail4; $arrc <= $finish_detail4; $arrc++) {

                if (isset($dtld_uraian[$arrc])) {
                    $dt_dtld_uraian[$arrc] = $dtld_uraian[$arrc];
                } else {
                    $dt_dtld_uraian[$arrc] = "";
                }
                if (isset($dtld_total_jam[$arrc])) {
                    $dt_dtld_total_jam[$arrc] = $dtld_total_jam[$arrc];
                } else {
                    $dt_dtld_total_jam[$arrc] = "";
                }
                if (isset($dtld_tmpr_kg[$arrc])) {
                    $dt_dtld_tmpr_kg[$arrc] = $dtld_tmpr_kg[$arrc];
                } else {
                    $dt_dtld_tmpr_kg[$arrc] = "";
                }
                if (isset($dtld_tmpr_akm[$arrc])) {
                    $dt_dtld_tmpr_akm[$arrc] = $dtld_tmpr_akm[$arrc];
                } else {
                    $dt_dtld_tmpr_akm[$arrc] = "";
                }
                if (isset($dtld_steam_ton[$arrc])) {
                    $dt_dtld_steam_ton[$arrc] = $dtld_steam_ton[$arrc];
                } else {
                    $dt_dtld_steam_ton[$arrc] = "";
                }
                if (isset($dtld_steam_akm[$arrc])) {
                    $dt_dtld_steam_akm[$arrc] = $dtld_steam_akm[$arrc];
                } else {
                    $dt_dtld_steam_akm[$arrc] = "";
                }
                if (isset($dtld_total_air[$arrc])) {
                    $dt_dtld_total_air[$arrc] = $dtld_total_air[$arrc];
                } else {
                    $dt_dtld_total_air[$arrc] = "";
                }
                if (isset($dtld_air_akm[$arrc])) {
                    $dt_dtld_air_akm[$arrc] = $dtld_air_akm[$arrc];
                } else {
                    $dt_dtld_air_akm[$arrc] = "";
                }

                $objPHPExcel->mergeCells('B' .  $table4_dtl . ':E' .  $table4_dtl)->setCellValue('B' .  $table4_dtl, $dt_dtld_uraian[$arrc]);
                $objPHPExcel->mergeCells('F' .  $table4_dtl . ':G' .  $table4_dtl)->setCellValue('F' .  $table4_dtl, $dt_dtld_total_jam[$arrc]);
                $objPHPExcel->mergeCells('H' .  $table4_dtl . ':K' .  $table4_dtl)->setCellValue('H' .  $table4_dtl, $dt_dtld_tmpr_kg[$arrc]);
                $objPHPExcel->mergeCells('L' .  $table4_dtl . ':O' .  $table4_dtl)->setCellValue('L' .  $table4_dtl, $dt_dtld_tmpr_akm[$arrc]);
                $objPHPExcel->mergeCells('P' .  $table4_dtl . ':S' .  $table4_dtl)->setCellValue('P' .  $table4_dtl, $dt_dtld_steam_ton[$arrc]);
                $objPHPExcel->mergeCells('T' .  $table4_dtl . ':W' .  $table4_dtl)->setCellValue('T' .  $table4_dtl, $dt_dtld_steam_akm[$arrc]);
                $objPHPExcel->mergeCells('X' .  $table4_dtl . ':Z' .  $table4_dtl)->setCellValue('X' .  $table4_dtl, $dt_dtld_total_air[$arrc]);
                $objPHPExcel->mergeCells('AA' .  $table4_dtl . ':AC' .  $table4_dtl)->setCellValue('AA' .  $table4_dtl, $dt_dtld_air_akm[$arrc]);

                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $table4_dtl . ':AC' . $table4_dtl);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'AL' . ($table4_dtl) . ':AL' . ($table4_dtl));
                $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($table4_dtl) . ':A' .  ($table4_dtl));
                $objPHPExcel->setSharedStyle($noborderStyle, 'AD' . ($table4_dtl) . ':AK' . ($table4_dtl));
                $table4_dtl++;
            }
            $objPHPExcel->mergeCells('B' .  ($table4_dtl) . ':G' .  ($table4_dtl))->setCellValue('B' .  ($table4_dtl), 'TOTAL');
            $objPHPExcel->mergeCells('H' .  ($table4_dtl) . ':K' .  ($table4_dtl))->setCellValue('H' .  ($table4_dtl), $total_dtld_tmpr_kg);
            $objPHPExcel->mergeCells('L' .  ($table4_dtl) . ':O' .  ($table4_dtl))->setCellValue('L' .  ($table4_dtl), $total_dtld_tmpr_akm);
            $objPHPExcel->mergeCells('P' .  ($table4_dtl) . ':S' .  ($table4_dtl))->setCellValue('P' .  ($table4_dtl), $total_dtld_steam_ton);
            $objPHPExcel->mergeCells('T' .  ($table4_dtl) . ':W' .  ($table4_dtl))->setCellValue('T' .  ($table4_dtl), $total_dtld_steam_akm);
            $objPHPExcel->mergeCells('X' .  ($table4_dtl) . ':Z' .  ($table4_dtl))->setCellValue('X' .  ($table4_dtl), $total_dtld_total_air);
            $objPHPExcel->mergeCells('AA' .  ($table4_dtl) . ':AC' .  ($table4_dtl))->setCellValue('AA' .  ($table4_dtl), $total_dtld_air_akm);

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($table4_dtl) . ':AC' . ($table4_dtl));


            $app_row = $table4_dtl + 2;

            $objPHPExcel->mergeCells('B' . ($app_row) . ':G' .  ($app_row + 1))->setCellValue('B' .  ($app_row), 'Dibuat Oleh,');
            $objPHPExcel->mergeCells('H' . ($app_row) . ':M' . ($app_row + 1))->setCellValue('H' .  ($app_row), 'Diketahui Oleh,');
            $objPHPExcel->mergeCells('N' . ($app_row) . ':S' . ($app_row + 1))->setCellValue('N' . ($app_row), 'Disetujui Oleh,');

            $objPHPExcel->mergeCells('B' . ($app_row + 2) . ':G' .  ($app_row + 6))->setCellValue('B' . ($app_row + 2), '');
            $objPHPExcel->mergeCells('H' . ($app_row + 2) . ':M' . ($app_row + 6))->setCellValue('H' . ($app_row + 2), '');
            $objPHPExcel->mergeCells('N' . ($app_row + 2) . ':S' . ($app_row + 6))->setCellValue('N' . ($app_row + 2), '');

            // $objPHPExcel->getStyle('B' . ($app_row) .     ':K'. ($app_row))->getFont()->setSize(10);
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($app_row - 1) . ':AL' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($app_row) . ':S' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AL' . ($app_row - 2) . ':AL' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row - 2) . ':A' . ($app_row + 6));


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
                    $sign_img->setCoordinates('C' . ($app_row + 3));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('C' . ($app_row + 3));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('C' . ($app_row + 2));
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
                    $sign_img2->setCoordinates('I' . ($app_row + 3));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('I' . ($app_row + 3));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('I' . ($app_row + 2));
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
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app3_personalstatus . '_' . $app3_personalid . '.png')) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath('assets/ttd/' . $app3_personalstatus . '_' . $app3_personalid . '.png');
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('O' . ($app_row + 3));
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('O' . ($app_row + 3));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('O' . ($app_row + 2));
                }
            }

            $objPHPExcel->mergeCells('B' . ($app_row + 7) . ':C' . ($app_row + 7))->setCellValue('B' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('D' . ($app_row + 7) . ':G' . ($app_row + 7))->setCellValue('D' . ($app_row + 7), ': ' . $app1_by);
            $objPHPExcel->mergeCells('B' . ($app_row + 8) . ':C' . ($app_row + 8))->setCellValue('B' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('D' . ($app_row + 8) . ':G' . ($app_row + 8))->setCellValue('D' . ($app_row + 8), ': ' . $app1_position);
            $objPHPExcel->mergeCells('B' . ($app_row + 9) . ':C' . ($app_row + 9))->setCellValue('B' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('D' . ($app_row + 9) . ':G' . ($app_row + 9))->setCellValue('D' . ($app_row + 9), ': ' . $app1date);

            $objPHPExcel->mergeCells('H' . ($app_row + 7) . ':I' . ($app_row + 7))->setCellValue('H' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('J' . ($app_row + 7) . ':M' . ($app_row + 7))->setCellValue('J' . ($app_row + 7), ': ' . $app2_by);
            $objPHPExcel->mergeCells('H' . ($app_row + 8) . ':I' . ($app_row + 8))->setCellValue('H' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('J' . ($app_row + 8) . ':M' . ($app_row + 8))->setCellValue('J' . ($app_row + 8), ': ' . $app2_position);
            $objPHPExcel->mergeCells('H' . ($app_row + 9) . ':I' . ($app_row + 9))->setCellValue('H' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('J' . ($app_row + 9) . ':M' . ($app_row + 9))->setCellValue('J' . ($app_row + 9), ': ' . $app2date);

            $objPHPExcel->mergeCells('N' . ($app_row + 7) . ':O' . ($app_row + 7))->setCellValue('N' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('P' . ($app_row + 7) . ':S' . ($app_row + 7))->setCellValue('P' . ($app_row + 7), ': ' . $app3_by);
            $objPHPExcel->mergeCells('N' . ($app_row + 8) . ':O' . ($app_row + 8))->setCellValue('N' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('P' . ($app_row + 8) . ':S' . ($app_row + 8))->setCellValue('P' . ($app_row + 8), ': ' . $app3_position);
            $objPHPExcel->mergeCells('N' . ($app_row + 9) . ':O' . ($app_row + 9))->setCellValue('N' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('P' . ($app_row + 9) . ':S' . ($app_row + 9))->setCellValue('P' . ($app_row + 9), ': ' . $app3date);


            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row + 7) . ':AL' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'B' . ($app_row + 7) . ':B' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'H' . ($app_row + 7) . ':H' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'N' . ($app_row + 7) . ':N' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($noborderStyle, 'AL' . ($app_row + 7) . ':AL' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AL' . ($app_row + 7) . ':AL' . ($app_row + 9));

            $objPHPExcel->getStyle('B' . ($app_row + 7) . ':S' . ($app_row + 9))->getFont()->setBold(true);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'S' . ($app_row + 7) . ':S' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));

            $start_row3 = $app_row + 9;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('R' . ($start_row3 + 1) . ':AL' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($start_row3 + 1) . ':AL' . ($start_row3 + 1))->setCellValue('R' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($start_row3 + 1) . ':AL' . ($start_row3 + 1));
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
