<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_inttbn008_03 extends CI_Controller
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
        $frmkode                  = $this->uri->segment(4);
        $frmvrs                   = $this->uri->segment(5);
        $this->header_id          = $this->uri->segment(6);
        $dtfrm                    = $this->M_forminput->get_dtform($frmkode, $frmvrs);

        foreach ($dtfrm as $datafrm) {
            $this->frmkd          = $datafrm->formkd;
            $this->frmjdl         = $datafrm->formjudul;
            $this->frmnm          = $datafrm->formnm;
            $this->frmver         = $datafrm->formversi;
            $this->frmefective    = date("d.m.Y", strtotime($datafrm->formefective));
        }

        $dtheader = $this->M_forminttbn008_03->get_header_byid($this->header_id);

        if (isset($dtheader)) {
            foreach ($dtheader as $dtheader_row) {
                $dtcreate_date                 = $dtheader_row->create_date;
                $create_date                   = date("d-m-Z", strtotime($dtheader_row->create_date));
                $bulan                         = date('N', strtotime($dtheader_row->create_date));
                $bulan                    = $dtheader_row->bulan;
                $docno                         = $dtheader_row->docno;
                $batubara_stock_awal_total     = $dtheader_row->batubara_stock_awal_total;
                $batubara_terima_total         = $dtheader_row->batubara_terima_total;
                $batubara_pakai_total          = $dtheader_row->batubara_pakai_total;
                $batubara_stock_akhir_total    = $dtheader_row->batubara_stock_akhir_total;
                $debu_arang_terima_total       = $dtheader_row->debu_arang_terima_total;
                $debu_arang_pakai_total        = $dtheader_row->debu_arang_pakai_total;
                $tempurung_stock_awal_total    = $dtheader_row->tempurung_stock_awal_total;
                $tempurung_terima_total        = $dtheader_row->tempurung_terima_total;
                $tempurung_pakai_total         = $dtheader_row->tempurung_pakai_total;
                $tempurung_stock_akhir_total   = $dtheader_row->tempurung_stock_akhir_total;
                $sabut_stock_awal_total        = $dtheader_row->sabut_stock_awal_total;
                $sabut_terima_total            = $dtheader_row->sabut_terima_total;
                $sabut_pakai_total             = $dtheader_row->sabut_pakai_total;
                $sabut_stock_akhir_total       = $dtheader_row->sabut_stock_akhir_total;
                $cocopiet_terima_total         = $dtheader_row->cocopiet_terima_total;
                $cocopiet_pakai_total          = $dtheader_row->cocopiet_pakai_total;
                $total_pakai_bahan_bakar_total = $dtheader_row->total_pakai_bahan_bakar_total;

                $batubara_stock_awal_rata2     = $dtheader_row->batubara_stock_awal_rata2;
                $batubara_terima_rata2         = $dtheader_row->batubara_terima_rata2;
                $batubara_pakai_rata2          = $dtheader_row->batubara_pakai_rata2;
                $batubara_stock_akhir_rata2    = $dtheader_row->batubara_stock_akhir_rata2;
                $debu_arang_terima_rata2       = $dtheader_row->debu_arang_terima_rata2;
                $debu_arang_pakai_rata2        = $dtheader_row->debu_arang_pakai_rata2;
                $tempurung_stock_awal_rata2    = $dtheader_row->tempurung_stock_awal_rata2;
                $tempurung_terima_rata2        = $dtheader_row->tempurung_terima_rata2;
                $tempurung_pakai_rata2         = $dtheader_row->tempurung_pakai_rata2;
                $tempurung_stock_akhir_rata2   = $dtheader_row->tempurung_stock_akhir_rata2;
                $sabut_stock_awal_rata2        = $dtheader_row->sabut_stock_awal_rata2;
                $sabut_terima_rata2            = $dtheader_row->sabut_terima_rata2;
                $sabut_pakai_rata2             = $dtheader_row->sabut_pakai_rata2;
                $sabut_stock_akhir_rata2       = $dtheader_row->sabut_stock_akhir_rata2;
                $cocopiet_terima_rata2         = $dtheader_row->cocopiet_terima_rata2;
                $cocopiet_pakai_rata2          = $dtheader_row->cocopiet_pakai_rata2;
                $total_pakai_bahan_bakar_rata2 = $dtheader_row->total_pakai_bahan_bakar_rata2;
            }
        }

        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail   = $this->M_forminttbn008_03->get_detail_byidx($this->header_id);
        } else {
            $dtdetail   = $this->M_forminttbn008_03->get_detail_byid($this->header_id);
        }

        $no = 1;
        foreach ($dtdetail as $dtdetail_row) {
            $detail_id[]               = $dtdetail_row->detail_id;
            $tanggal_bahan_bakar[]     = $dtdetail_row->tanggal_bahan_bakar;
            $batubara_stock_awal[]     = $dtdetail_row->batubara_stock_awal;
            $batubara_terima[]         = $dtdetail_row->batubara_terima;
            $batubara_pakai[]          = $dtdetail_row->batubara_pakai;
            $batubara_stock_akhir[]    = $dtdetail_row->batubara_stock_akhir;
            $debu_arang_terima[]       = $dtdetail_row->debu_arang_terima;
            $debu_arang_pakai[]        = $dtdetail_row->debu_arang_pakai;
            $tempurung_stock_awal[]    = $dtdetail_row->tempurung_stock_awal;
            $tempurung_terima[]        = $dtdetail_row->tempurung_terima;
            $tempurung_pakai[]         = $dtdetail_row->tempurung_pakai;
            $tempurung_stock_akhir[]   = $dtdetail_row->tempurung_stock_akhir;
            $sabut_stock_awal[]        = $dtdetail_row->sabut_stock_awal;
            $sabut_terima[]            = $dtdetail_row->sabut_terima;
            $sabut_pakai[]             = $dtdetail_row->sabut_pakai;
            $sabut_stock_akhir[]       = $dtdetail_row->sabut_stock_akhir;
            $cocopiet_terima[]         = $dtdetail_row->cocopiet_terima;
            $cocopiet_pakai[]          = $dtdetail_row->cocopiet_pakai;
            $total_pakai_bahan_bakar[] = $dtdetail_row->total_pakai_bahan_bakar;
        }

        //end Get dtheader
        // style
        $PTStyle                   = new PHPExcel_Style();
        $headerStyle               = new PHPExcel_Style();
        $headerStyleRight          = new PHPExcel_Style();
        $headerStyleLeftTop        = new PHPExcel_Style();
        $headerStyleRightTop       = new PHPExcel_Style();
        $headerStyleLeftBottomTop  = new PHPExcel_Style();
        $headerStyleRightBottomTop = new PHPExcel_Style();
        $DetailheaderStyle         = new PHPExcel_Style();
        $bodyStyle                 = new PHPExcel_Style();
        $bodyStyleAlignLeft        = new PHPExcel_Style();
        $noborderStyle             = new PHPExcel_Style();
        $bodyStyleLeft             = new PHPExcel_Style();
        $headerStyleLeft           = new PHPExcel_Style();
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
        $headerStyleLeft->applyFromArray($this->xls->headerStyleLeft);
        $headerStyleRight->applyFromArray($this->xls->headerStyleRight);
        $footerStyleLeftbottom->applyFromArray($this->xls->footerStyleLeftbottom);
        $footerStyleRightbottom->applyFromArray($this->xls->footerStyleRightbottom);

        $colorlightgreen = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '90EE90')
            )
        );
        $colorlightskyblue = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '87CEFA')
            )
        );
        $colorlightpink = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FFB6C1')
            )
        );
        $colorlightyellow = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FFFFE0')
            )
        );
        $colorlightgray = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'D3D3D3')
            )
        );
        // end style

        $obj = new Excel();

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('assets/images/PSG_logo_2022.png');
        $objPHPExcel = $obj->createSheet(0);

        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getPageSetup()->setFitToPage(false);
        $objPHPExcel->getPageSetup()->setScale(48);
        $objPHPExcel->getPageMargins()->setLeft(0.2);
        $objPHPExcel->getPageMargins()->setRight(0.2);
        $objPHPExcel->getPageMargins()->setBottom(0.2);
        $objPHPExcel->getPageMargins()->setTop(0.2);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);

        $range = array();
        $rangeCol = "BV";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(4);
        }

        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(15);
        }

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
        $jml_row_perpage  = $count1 + 19;


        // $number = 0;
        for ($i1 = 0; $i1 < $jml_page_a; $i1++) {

            $start_row = ($i1 * $jml_row_perpage) + 1;
            $finish_row = ((($i1 * $jml_row_perpage) + 1) + ($jml_row_perpage));

            $start_detail = ($i1 * $jml_data_perpage);
            $finish_detail = (($i1 * $jml_data_perpage) + ($jml_data_perpage - 1));


            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/PSG_logo_2022.png');
            $gbr->setWidthAndHeight(50, 50);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('B' . $start_row);


            $objPHPExcel->mergeCells('A' .   $start_row . ':D' . ($start_row + 2));
            $objPHPExcel->mergeCells('E' .   $start_row . ':BM' . ($start_row))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('BN' .  $start_row . ':BP' . $start_row)->setCellValue('BN' . $start_row, 'Doc');
            $objPHPExcel->mergeCells('BQ' .  $start_row . ':BV' . $start_row)->setCellValue('BQ' . $start_row, ': ' . $docno);
            $objPHPExcel->mergeCells('BN' . ($start_row + 1) . ':BP' . ($start_row + 1))->setCellValue('BN' . ($start_row + 1), 'Date');
            $objPHPExcel->mergeCells('BQ' . ($start_row + 1) . ':BV' . ($start_row + 1))->setCellValue('BQ' . ($start_row + 1), ': ' . $bulan);
            $objPHPExcel->mergeCells('A' .  ($start_row + 2) . ':D' .  ($start_row + 2))->setCellValue('A' .  ($start_row + 2), '');
            $objPHPExcel->mergeCells('E' .  ($start_row + 1) . ':BM' . ($start_row + 1))->setCellValue('E' .  ($start_row + 1), 'DEPARTMENT PWP-TBN');
            $objPHPExcel->mergeCells('E' .  ($start_row + 2) . ':BM' . ($start_row + 2))->setCellValue('E' .  ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('BN' . ($start_row + 2) . ':BP' . ($start_row + 2))->setCellValue('BN' . ($start_row + 2), 'Page');
            $objPHPExcel->mergeCells('BQ' . ($start_row + 2) . ':BV' . ($start_row + 2))->setCellValue('BQ' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row .      ':D' .  ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':BV' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':BV' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':BM' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AJ' . ($start_row) . ':BV' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AM' .  $start_row  . ':BV' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AJ' . ($start_row + 2) . ':BV' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AM' . ($start_row + 2) . ':BV' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':BM' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 2));
            $objPHPExcel->getStyle('AM' . ($start_row) . ':BV' . ($start_row))->getFont()->setSize(10);


            $objPHPExcel->mergeCells('B' .  ($start_row + 4) . ':E' .  ($start_row + 6))->setCellValue('B' .  ($start_row + 4), "Tanggal");
            $objPHPExcel->mergeCells('F' .  ($start_row + 4) . ':U' .  ($start_row + 4))->setCellValue('F' .  ($start_row + 4), "Batubara");
            $objPHPExcel->mergeCells('F' .  ($start_row + 5) . ':I' .  ($start_row + 6))->setCellValue('F' .  ($start_row + 5), "Stock Awal Batubara");
            $objPHPExcel->mergeCells('J' .  ($start_row + 5) . ':M' .  ($start_row + 6))->setCellValue('J' .  ($start_row + 5), "Terima Batubara");
            $objPHPExcel->mergeCells('N' .  ($start_row + 5) . ':Q' .  ($start_row + 6))->setCellValue('N' .  ($start_row + 5), "Pakai Batubara (a)");
            $objPHPExcel->mergeCells('R' .  ($start_row + 5) . ':U' .  ($start_row + 6))->setCellValue('R' .  ($start_row + 5), "Stock Akhir Batubara");
            $objPHPExcel->mergeCells('V' .  ($start_row + 4) . ':AC' .  ($start_row + 4))->setCellValue('V' .  ($start_row + 4), "Debu Arang");
            $objPHPExcel->mergeCells('V' .  ($start_row + 5) . ':Y' .  ($start_row + 6))->setCellValue('V' .  ($start_row + 5), "Terima Debu Arang");
            $objPHPExcel->mergeCells('Z' .  ($start_row + 5) . ':AC' .  ($start_row + 6))->setCellValue('Z' .  ($start_row + 5), "Pakai Debu Arang (b)");
            $objPHPExcel->mergeCells('AD' .  ($start_row + 4) . ':AS' .  ($start_row + 4))->setCellValue('AD' .  ($start_row + 4), "Tempurung");
            $objPHPExcel->mergeCells('AD' .  ($start_row + 5) . ':AG' .  ($start_row + 6))->setCellValue('AD' .  ($start_row + 5), "Stock Awal Tempurung");
            $objPHPExcel->mergeCells('AH' .  ($start_row + 5) . ':AK' .  ($start_row + 6))->setCellValue('AH' .  ($start_row + 5), "Terima Tempurung");
            $objPHPExcel->mergeCells('AL' .  ($start_row + 5) . ':AO' .  ($start_row + 6))->setCellValue('AL' .  ($start_row + 5), "Pakai Tempurung (c)");
            $objPHPExcel->mergeCells('AP' .  ($start_row + 5) . ':AS' .  ($start_row + 6))->setCellValue('AP' .  ($start_row + 5), "Stock Akhir Tempurung");
            $objPHPExcel->mergeCells('AT' .  ($start_row + 4) . ':BI' .  ($start_row + 4))->setCellValue('AT' .  ($start_row + 4), "Sabut");
            $objPHPExcel->mergeCells('AT' .  ($start_row + 5) . ':AW' .  ($start_row + 6))->setCellValue('AT' .  ($start_row + 5), "Stock Awal Sabut");
            $objPHPExcel->mergeCells('AX' .  ($start_row + 5) . ':BA' .  ($start_row + 6))->setCellValue('AX' .  ($start_row + 5), "Terima Sabut");
            $objPHPExcel->mergeCells('BB' .  ($start_row + 5) . ':BE' .  ($start_row + 6))->setCellValue('BB' .  ($start_row + 5), "Pakai Sabut (c)");
            $objPHPExcel->mergeCells('BF' .  ($start_row + 5) . ':BI' .  ($start_row + 6))->setCellValue('BF' .  ($start_row + 5), "Stock Akhir Sabut");
            $objPHPExcel->mergeCells('BJ' .  ($start_row + 4) . ':BQ' .  ($start_row + 4))->setCellValue('BJ' .  ($start_row + 4), "Cocopiet");
            $objPHPExcel->mergeCells('BJ' .  ($start_row + 5) . ':BM' .  ($start_row + 6))->setCellValue('BJ' .  ($start_row + 5), "Terima Cocopiet");
            $objPHPExcel->mergeCells('BN' .  ($start_row + 5) . ':BQ' .  ($start_row + 6))->setCellValue('BN' .  ($start_row + 5), "Pakai Cocopiet (d)");
            $objPHPExcel->mergeCells('BR' .  ($start_row + 4) . ':BU' .  ($start_row + 6))->setCellValue('BR' .  ($start_row + 4), "Total Pakai Bahan Bakar (a+b+c+d)");
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BV' . ($start_row + 3) . ':BV' . ($start_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row + 3) . ':A' .  ($start_row + 6));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($start_row + 4) . ':BU' . ($start_row + 6));
            // $objPHPExcel->getStyle('B' . ($start_row + 4) . ':BV' . ($start_row + 5))->getFont()->setBold(true)->setSize(9);
            $objPHPExcel->getStyle('F' .  ($start_row + 4) . ':U' .  ($start_row + 6))->applyFromArray($colorlightpink);
            $objPHPExcel->getStyle('V' .  ($start_row + 4) . ':AC' .  ($start_row + 6))->applyFromArray($colorlightyellow);
            $objPHPExcel->getStyle('AD' .  ($start_row + 4) . ':AS' .  ($start_row + 6))->applyFromArray($colorlightgreen);
            $objPHPExcel->getStyle('AT' .  ($start_row + 4) . ':BI' .  ($start_row + 6))->applyFromArray($colorlightskyblue);
            $objPHPExcel->getStyle('BJ' .  ($start_row + 4) . ':BQ' .  ($start_row + 6))->applyFromArray($colorlightgray);

            $dtl_row = $start_row + 7;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(20);

                if (isset($tanggal_bahan_bakar[$a])) {
                    $tanggal_bahan_bakar[$a] = $tanggal_bahan_bakar[$a];
                } else {
                    $tanggal_bahan_bakar[$a]         = "";
                }

                if (isset($batubara_stock_awal[$a])) {
                    $batubara_stock_awal[$a] = $batubara_stock_awal[$a];
                } else {
                    $batubara_stock_awal[$a]         = "";
                }

                if (isset($batubara_terima[$a])) {
                    $batubara_terima[$a] = $batubara_terima[$a];
                } else {
                    $batubara_terima[$a]         = "";
                }

                if (isset($batubara_pakai[$a])) {
                    $batubara_pakai[$a] = $batubara_pakai[$a];
                } else {
                    $batubara_pakai[$a]         = "";
                }

                if (isset($batubara_stock_akhir[$a])) {
                    $batubara_stock_akhir[$a] = $batubara_stock_akhir[$a];
                } else {
                    $batubara_stock_akhir[$a]         = "";
                }

                if (isset($debu_arang_terima[$a])) {
                    $debu_arang_terima[$a] = $debu_arang_terima[$a];
                } else {
                    $debu_arang_terima[$a]         = "";
                }

                if (isset($debu_arang_pakai[$a])) {
                    $debu_arang_pakai[$a] = $debu_arang_pakai[$a];
                } else {
                    $debu_arang_pakai[$a]         = "";
                }

                if (isset($tempurung_stock_awal[$a])) {
                    $tempurung_stock_awal[$a] = $tempurung_stock_awal[$a];
                } else {
                    $tempurung_stock_awal[$a]         = "";
                }

                if (isset($tempurung_terima[$a])) {
                    $tempurung_terima[$a] = $tempurung_terima[$a];
                } else {
                    $tempurung_terima[$a]         = "";
                }

                if (isset($tempurung_pakai[$a])) {
                    $tempurung_pakai[$a] = $tempurung_pakai[$a];
                } else {
                    $tempurung_pakai[$a]         = "";
                }

                if (isset($tempurung_stock_akhir[$a])) {
                    $tempurung_stock_akhir[$a] = $tempurung_stock_akhir[$a];
                } else {
                    $tempurung_stock_akhir[$a]         = "";
                }

                if (isset($sabut_stock_awal[$a])) {
                    $sabut_stock_awal[$a] = $sabut_stock_awal[$a];
                } else {
                    $sabut_stock_awal[$a]         = "";
                }

                if (isset($sabut_terima[$a])) {
                    $sabut_terima[$a] = $sabut_terima[$a];
                } else {
                    $sabut_terima[$a]         = "";
                }

                if (isset($zsabut_pakai[$a])) {
                    $zsabut_pakai[$a] = $zsabut_pakai[$a];
                } else {
                    $zsabut_pakai[$a]         = "";
                }

                if (isset($sabut_stock_akhir[$a])) {
                    $sabut_stock_akhir[$a] = $sabut_stock_akhir[$a];
                } else {
                    $sabut_stock_akhir[$a]         = "";
                }

                if (isset($cocpiet_terima[$a])) {
                    $cocpiet_terima[$a] = $cocpiet_terima[$a];
                } else {
                    $cocpiet_terima[$a]         = "";
                }

                if (isset($cocopiet_pakai[$a])) {
                    $cocopiet_pakai[$a] = $cocopiet_pakai[$a];
                } else {
                    $cocopiet_pakai[$a]         = "";
                }

                if (isset($total_pakai_bahan_bakar[$a])) {
                    $total_pakai_bahan_bakar[$a] = $total_pakai_bahan_bakar[$a];
                } else {
                    $total_pakai_bahan_bakar[$a]         = "";
                }

                $objPHPExcel->mergeCells('B' .  $dtl_row . ':E' .  $dtl_row)->setCellValue('B' .  $dtl_row, $tanggal_bahan_bakar[$a]);
                $objPHPExcel->mergeCells('F' .  $dtl_row . ':I' .  $dtl_row)->setCellValue('F' .  $dtl_row, $batubara_stock_awal[$a]);
                $objPHPExcel->mergeCells('J' .  $dtl_row . ':M' .  $dtl_row)->setCellValue('J' .  $dtl_row, $batubara_terima[$a]);
                $objPHPExcel->mergeCells('N' .  $dtl_row . ':Q' .  $dtl_row)->setCellValue('N' .  $dtl_row, $batubara_pakai[$a]);
                $objPHPExcel->mergeCells('R' .  $dtl_row . ':U' .  $dtl_row)->setCellValue('R' .  $dtl_row, $batubara_stock_akhir[$a]);
                $objPHPExcel->mergeCells('V' .  $dtl_row . ':Y' .  $dtl_row)->setCellValue('V' .  $dtl_row, $debu_arang_terima[$a]);
                $objPHPExcel->mergeCells('Z' .  $dtl_row . ':AC' .  $dtl_row)->setCellValue('Z' .  $dtl_row, $debu_arang_pakai[$a]);
                $objPHPExcel->mergeCells('AD' .  $dtl_row . ':AG' .  $dtl_row)->setCellValue('AD' .  $dtl_row, $tempurung_stock_awal[$a]);
                $objPHPExcel->mergeCells('AH' .  $dtl_row . ':AK' .  $dtl_row)->setCellValue('AH' .  $dtl_row, $tempurung_terima[$a]);
                $objPHPExcel->mergeCells('AL' .  $dtl_row . ':AO' .  $dtl_row)->setCellValue('AL' .  $dtl_row, $tempurung_pakai[$a]);
                $objPHPExcel->mergeCells('AP' .  $dtl_row . ':AS' .  $dtl_row)->setCellValue('AP' .  $dtl_row, $tempurung_stock_akhir[$a]);
                $objPHPExcel->mergeCells('AT' .  $dtl_row . ':AW' .  $dtl_row)->setCellValue('AT' .  $dtl_row, $sabut_stock_awal[$a]);
                $objPHPExcel->mergeCells('AX' .  $dtl_row . ':BA' .  $dtl_row)->setCellValue('AX' .  $dtl_row, $sabut_terima[$a]);
                $objPHPExcel->mergeCells('BB' .  $dtl_row . ':BE' .  $dtl_row)->setCellValue('BB' .  $dtl_row, $sabut_pakai[$a]);
                $objPHPExcel->mergeCells('BF' .  $dtl_row . ':BI' .  $dtl_row)->setCellValue('BF' .  $dtl_row, $sabut_stock_akhir[$a]);
                $objPHPExcel->mergeCells('BJ' .  $dtl_row . ':BM' .  $dtl_row)->setCellValue('BJ' .  $dtl_row, $cocopiet_terima[$a]);
                $objPHPExcel->mergeCells('BN' .  $dtl_row . ':BQ' .  $dtl_row)->setCellValue('BN' .  $dtl_row, $cocopiet_pakai[$a]);
                $objPHPExcel->mergeCells('BR' .  $dtl_row . ':BU' .  $dtl_row)->setCellValue('BR' .  $dtl_row, $total_pakai_bahan_bakar[$a]);
                $objPHPExcel->setSharedStyle($bodyStyle, 'B' .        $dtl_row . ':BU' . $dtl_row);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'BV' . ($dtl_row) . ':BV' . ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row) . ':A' .  ($dtl_row));
                $objPHPExcel->getStyle('B' . ($dtl_row) .     ':E' . ($dtl_row))->getFont()->setBold(true);
                $objPHPExcel->getStyle('B' . ($dtl_row) .     ':BV' . ($dtl_row))->getFont()->setSize(9);
                $objPHPExcel->getStyle('F' .  ($dtl_row) . ':U' .  ($dtl_row))->applyFromArray($colorlightpink);
                $objPHPExcel->getStyle('V' .  ($dtl_row) . ':AC' .  ($dtl_row))->applyFromArray($colorlightyellow);
                $objPHPExcel->getStyle('AD' .  ($dtl_row) . ':AS' .  ($dtl_row))->applyFromArray($colorlightgreen);
                $objPHPExcel->getStyle('AT' .  ($dtl_row) . ':BI' .  ($dtl_row))->applyFromArray($colorlightskyblue);
                $objPHPExcel->getStyle('BJ' .  ($dtl_row) . ':BQ' .  ($dtl_row))->applyFromArray($colorlightgray);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'BV' . ($dtl_row + 1) . ':BV' . ($dtl_row + 2));
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($dtl_row + 1) . ':A' . ($dtl_row + 2));
                $dtl_row++;
            }

            $hdr_total_row = $dtl_row;
            $objPHPExcel->mergeCells('B' . ($hdr_total_row) . ':E' . ($hdr_total_row))->setCellValue('B' . ($hdr_total_row), 'Total ');
            $objPHPExcel->mergeCells('F' . ($hdr_total_row) . ':I' . ($hdr_total_row))->setCellValue('F' . ($hdr_total_row), $batubara_stock_awal_total);
            $objPHPExcel->mergeCells('J' . ($hdr_total_row) . ':M' . ($hdr_total_row))->setCellValue('J' . ($hdr_total_row), $batubara_terima_total);
            $objPHPExcel->mergeCells('N' . ($hdr_total_row) . ':Q' . ($hdr_total_row))->setCellValue('N' . ($hdr_total_row), $batubara_pakai_total);
            $objPHPExcel->mergeCells('R' . ($hdr_total_row) . ':U' . ($hdr_total_row))->setCellValue('R' . ($hdr_total_row), $batubara_stock_akhir_total);
            $objPHPExcel->mergeCells('V' . ($hdr_total_row) . ':Y' . ($hdr_total_row))->setCellValue('V' . ($hdr_total_row), $debu_arang_terima_total);
            $objPHPExcel->mergeCells('Z' . ($hdr_total_row) . ':AC' . ($hdr_total_row))->setCellValue('Z' . ($hdr_total_row), $debu_arang_pakai_total);
            $objPHPExcel->mergeCells('AD' . ($hdr_total_row) . ':AG' . ($hdr_total_row))->setCellValue('AD' . ($hdr_total_row), $tempurung_stock_awal_total);
            $objPHPExcel->mergeCells('AH' . ($hdr_total_row) . ':AK' . ($hdr_total_row))->setCellValue('AH' . ($hdr_total_row), $tempurung_terima_total);
            $objPHPExcel->mergeCells('AL' . ($hdr_total_row) . ':AO' . ($hdr_total_row))->setCellValue('AL' . ($hdr_total_row), $tempurung_pakai_total);
            $objPHPExcel->mergeCells('AP' . ($hdr_total_row) . ':AS' . ($hdr_total_row))->setCellValue('AP' . ($hdr_total_row), $tempurung_stock_akhir_total);
            $objPHPExcel->mergeCells('AT' . ($hdr_total_row) . ':AW' . ($hdr_total_row))->setCellValue('AT' . ($hdr_total_row), $sabut_stock_awal_total);
            $objPHPExcel->mergeCells('AX' . ($hdr_total_row) . ':BA' . ($hdr_total_row))->setCellValue('AX' . ($hdr_total_row), $sabut_terima_total);
            $objPHPExcel->mergeCells('BB' . ($hdr_total_row) . ':BE' . ($hdr_total_row))->setCellValue('BB' . ($hdr_total_row), $sabut_pakai_total);
            $objPHPExcel->mergeCells('BF' . ($hdr_total_row) . ':BI' . ($hdr_total_row))->setCellValue('BF' . ($hdr_total_row), $sabut_stock_akhir_total);
            $objPHPExcel->mergeCells('BJ' . ($hdr_total_row) . ':BM' . ($hdr_total_row))->setCellValue('BJ' . ($hdr_total_row), $cocopiet_terima_total);
            $objPHPExcel->mergeCells('BN' . ($hdr_total_row) . ':BQ' . ($hdr_total_row))->setCellValue('BN' . ($hdr_total_row), $cocopiet_pakai_total);
            $objPHPExcel->mergeCells('BR' . ($hdr_total_row) . ':BU' . ($hdr_total_row))->setCellValue('BR' . ($hdr_total_row), $total_pakai_bahan_bakar_total);
            $objPHPExcel->setSharedStyle($bodyStyle, 'B' .        $hdr_total_row . ':BU' . $hdr_total_row);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BV' . ($hdr_total_row) . ':BV' . ($hdr_total_row));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hdr_total_row) . ':A' .  ($hdr_total_row));
            $objPHPExcel->getStyle('B' . ($hdr_total_row) .     ':BU' . ($hdr_total_row))->getFont()->setBold(true);
            $objPHPExcel->getStyle('B' . ($hdr_total_row) .     ':BU' . ($hdr_total_row))->getFont()->setSize(9);
            $objPHPExcel->getStyle('F' .  ($hdr_total_row) . ':U' .  ($hdr_total_row))->applyFromArray($colorlightpink);
            $objPHPExcel->getStyle('V' .  ($hdr_total_row) . ':AC' .  ($hdr_total_row))->applyFromArray($colorlightyellow);
            $objPHPExcel->getStyle('AD' .  ($hdr_total_row) . ':AS' .  ($hdr_total_row))->applyFromArray($colorlightgreen);
            $objPHPExcel->getStyle('AT' .  ($hdr_total_row) . ':BI' .  ($hdr_total_row))->applyFromArray($colorlightskyblue);
            $objPHPExcel->getStyle('BJ' .  ($hdr_total_row) . ':BQ' .  ($hdr_total_row))->applyFromArray($colorlightgray);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BV' . ($hdr_total_row + 1) . ':BV' . ($hdr_total_row + 2));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($hdr_total_row + 1) . ':A' . ($hdr_total_row + 2));

            $hdr_rata2_row = $hdr_total_row + 1;
            $objPHPExcel->mergeCells('B' . ($hdr_rata2_row) . ':E' . ($hdr_rata2_row))->setCellValue('B' . ($hdr_rata2_row), 'Rata - Rata ');
            $objPHPExcel->mergeCells('F' . ($hdr_rata2_row) . ':I' . ($hdr_rata2_row))->setCellValue('F' . ($hdr_rata2_row), $batubara_stock_awal_rata2);
            $objPHPExcel->mergeCells('J' . ($hdr_rata2_row) . ':M' . ($hdr_rata2_row))->setCellValue('J' . ($hdr_rata2_row), $batubara_terima_rata2);
            $objPHPExcel->mergeCells('N' . ($hdr_rata2_row) . ':Q' . ($hdr_rata2_row))->setCellValue('N' . ($hdr_rata2_row), $batubara_pakai_rata2);
            $objPHPExcel->mergeCells('R' . ($hdr_rata2_row) . ':U' . ($hdr_rata2_row))->setCellValue('R' . ($hdr_rata2_row), $batubara_stock_akhir_rata2);
            $objPHPExcel->mergeCells('V' . ($hdr_rata2_row) . ':Y' . ($hdr_rata2_row))->setCellValue('V' . ($hdr_rata2_row), $debu_arang_terima_rata2);
            $objPHPExcel->mergeCells('Z' . ($hdr_rata2_row) . ':AC' . ($hdr_rata2_row))->setCellValue('Z' . ($hdr_rata2_row), $debu_arang_pakai_rata2);
            $objPHPExcel->mergeCells('AD' . ($hdr_rata2_row) . ':AG' . ($hdr_rata2_row))->setCellValue('AD' . ($hdr_rata2_row), $tempurung_stock_awal_rata2);
            $objPHPExcel->mergeCells('AH' . ($hdr_rata2_row) . ':AK' . ($hdr_rata2_row))->setCellValue('AH' . ($hdr_rata2_row), $tempurung_terima_rata2);
            $objPHPExcel->mergeCells('AL' . ($hdr_rata2_row) . ':AO' . ($hdr_rata2_row))->setCellValue('AL' . ($hdr_rata2_row), $tempurung_pakai_rata2);
            $objPHPExcel->mergeCells('AP' . ($hdr_rata2_row) . ':AS' . ($hdr_rata2_row))->setCellValue('AP' . ($hdr_rata2_row), $tempurung_stock_akhir_rata2);
            $objPHPExcel->mergeCells('AT' . ($hdr_rata2_row) . ':AW' . ($hdr_rata2_row))->setCellValue('AT' . ($hdr_rata2_row), $sabut_stock_awal_rata2);
            $objPHPExcel->mergeCells('AX' . ($hdr_rata2_row) . ':BA' . ($hdr_rata2_row))->setCellValue('AX' . ($hdr_rata2_row), $sabut_terima_rata2);
            $objPHPExcel->mergeCells('BB' . ($hdr_rata2_row) . ':BE' . ($hdr_rata2_row))->setCellValue('BB' . ($hdr_rata2_row), $sabut_pakai_rata2);
            $objPHPExcel->mergeCells('BF' . ($hdr_rata2_row) . ':BI' . ($hdr_rata2_row))->setCellValue('BF' . ($hdr_rata2_row), $sabut_stock_akhir_rata2);
            $objPHPExcel->mergeCells('BJ' . ($hdr_rata2_row) . ':BM' . ($hdr_rata2_row))->setCellValue('BJ' . ($hdr_rata2_row), $cocopiet_terima_rata2);
            $objPHPExcel->mergeCells('BN' . ($hdr_rata2_row) . ':BQ' . ($hdr_rata2_row))->setCellValue('BN' . ($hdr_rata2_row), $cocopiet_pakai_rata2);
            $objPHPExcel->mergeCells('BR' . ($hdr_rata2_row) . ':BU' . ($hdr_rata2_row))->setCellValue('BR' . ($hdr_rata2_row), $total_pakai_bahan_bakar_rata2);
            $objPHPExcel->setSharedStyle($bodyStyle, 'B' .        $hdr_rata2_row . ':BU' . $hdr_rata2_row);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BV' . ($hdr_rata2_row) . ':BV' . ($hdr_rata2_row));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hdr_rata2_row) . ':A' .  ($hdr_rata2_row));
            $objPHPExcel->getStyle('B' . ($hdr_rata2_row) .     ':BU' . ($hdr_rata2_row))->getFont()->setBold(true);
            $objPHPExcel->getStyle('B' . ($hdr_rata2_row) .     ':BU' . ($hdr_rata2_row))->getFont()->setSize(9);
            $objPHPExcel->getStyle('F' .  ($hdr_rata2_row) . ':U' .  ($hdr_rata2_row))->applyFromArray($colorlightpink);
            $objPHPExcel->getStyle('V' .  ($hdr_rata2_row) . ':AC' .  ($hdr_rata2_row))->applyFromArray($colorlightyellow);
            $objPHPExcel->getStyle('AD' .  ($hdr_rata2_row) . ':AS' .  ($hdr_rata2_row))->applyFromArray($colorlightgreen);
            $objPHPExcel->getStyle('AT' .  ($hdr_rata2_row) . ':BI' .  ($hdr_rata2_row))->applyFromArray($colorlightskyblue);
            $objPHPExcel->getStyle('BJ' .  ($hdr_rata2_row) . ':BQ' .  ($hdr_rata2_row))->applyFromArray($colorlightgray);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BV' . ($hdr_rata2_row + 1) . ':BV' . ($hdr_rata2_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($hdr_rata2_row + 1) . ':A' . ($hdr_rata2_row + 9));

            $start_row3 = $hdr_rata2_row + 9;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('R' . ($start_row3 + 1) . ':BV' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($start_row3 + 1) . ':BV' . ($start_row3 + 1))->setCellValue('R' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($start_row3 + 1) . ':BV' . ($start_row3 + 1));
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
