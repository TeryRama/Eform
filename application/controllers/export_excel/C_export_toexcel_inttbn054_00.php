<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_inttbn054_00 extends CI_Controller
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

        $dtheader = $this->M_forminttbn054_00->get_header_byid($this->header_id);

        if (isset($dtheader)) {
            foreach ($dtheader as $dtheader_row) {
                $dtcreate_date      = $dtheader_row->create_date;
                $create_date        = date("d-m-Z", strtotime($dtheader_row->create_date));
                $bulan              = date('N', strtotime($dtheader_row->create_date));
                $bulan              = $dtheader_row->bulan;
                $docno              = $dtheader_row->docno;
                $tahun              = $dtheader_row->tahun;
                $supply_awal_total  = $dtheader_row->supply_awal_total;
                $supply_akhir_total = $dtheader_row->supply_akhir_total;
                $supply_total_total = $dtheader_row->supply_total_total;
                $asf_awal_total     = $dtheader_row->asf_awal_total;
                $asf_akhir_total    = $dtheader_row->asf_akhir_total;
                $asf_total_total    = $dtheader_row->asf_total_total;
                $soft_awal_total    = $dtheader_row->soft_awal_total;
                $soft_akhir_total   = $dtheader_row->soft_akhir_total;
                $soft_total_total   = $dtheader_row->soft_total_total;
            }
        }

        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail   = $this->M_forminttbn054_00->get_detail_byidx($this->header_id);
        } else {
            $dtdetail   = $this->M_forminttbn054_00->get_detail_byid($this->header_id);
        }

        $no = 1;
        foreach ($dtdetail as $dtdetail_row) {
            $detail_id          [] = $dtdetail_row->detail_id;
            $tanggal_bahan_bakar[] = $dtdetail_row->tanggal_bahan_bakar;
            $supply_flow_awal   [] = $dtdetail_row->supply_flow_awal;
            $supply_flow_akhir  [] = $dtdetail_row->supply_flow_akhir;
            $supply_total       [] = $dtdetail_row->supply_total;
            $asf_flow_awal      [] = $dtdetail_row->asf_flow_awal;
            $asf_flow_akhir     [] = $dtdetail_row->asf_flow_akhir;
            $asf_total          [] = $dtdetail_row->asf_total;
            $soft_flow_awal     [] = $dtdetail_row->soft_flow_awal;
            $soft_flow_akhir    [] = $dtdetail_row->soft_flow_akhir;
            $soft_total         [] = $dtdetail_row->soft_total;
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
        $rangeCol = "AP";
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
            $objPHPExcel->mergeCells('E' .   $start_row . ':AG' . ($start_row))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AH' .  $start_row . ':AJ' . $start_row)->setCellValue('AH' . $start_row, 'Doc');
            $objPHPExcel->mergeCells('AK' .  $start_row . ':AP' . $start_row)->setCellValue('AK' . $start_row, ': ' . $docno);
            $objPHPExcel->mergeCells('AH' . ($start_row + 1) . ':AJ' . ($start_row + 1))->setCellValue('AH' . ($start_row + 1), 'Date');
            $objPHPExcel->mergeCells('AK' . ($start_row + 1) . ':AP' . ($start_row + 1))->setCellValue('AK' . ($start_row + 1), ': ' . $bulan);
            $objPHPExcel->mergeCells('A' .  ($start_row + 2) . ':D' .  ($start_row + 2))->setCellValue('A' .  ($start_row + 2), '');
            $objPHPExcel->mergeCells('E' .  ($start_row + 1) . ':AG' . ($start_row + 1))->setCellValue('E' .  ($start_row + 1), 'DEPARTMENT PWP-TBN');
            $objPHPExcel->mergeCells('E' .  ($start_row + 2) . ':AG' . ($start_row + 2))->setCellValue('E' .  ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AH' . ($start_row + 2) . ':AJ' . ($start_row + 2))->setCellValue('AH' . ($start_row + 2), 'Page');
            $objPHPExcel->mergeCells('AK' . ($start_row + 2) . ':AP' . ($start_row + 2))->setCellValue('AK' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row .      ':D' .  ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':AP' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':AP' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':AG' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AH' . ($start_row) . ':AP' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AM' .  $start_row  . ':AP' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AH' . ($start_row + 2) . ':AP' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AM' . ($start_row + 2) . ':AP' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':AG' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 2));
            $objPHPExcel->getStyle('AM' . ($start_row) . ':AP' . ($start_row))->getFont()->setSize(10);


            $objPHPExcel->mergeCells('B' .  ($start_row + 4) . ':E' .  ($start_row + 6))->setCellValue('B' .  ($start_row + 4), "Tanggal");
            $objPHPExcel->mergeCells('F' .  ($start_row + 4) . ':Q' .  ($start_row + 4))->setCellValue('F' .  ($start_row + 4), "SUPPLY DEMIN TO DEARATOR");
            $objPHPExcel->mergeCells('F' .  ($start_row + 5) . ':I' .  ($start_row + 6))->setCellValue('F' .  ($start_row + 5), "Flow Awal");
            $objPHPExcel->mergeCells('J' .  ($start_row + 5) . ':M' .  ($start_row + 6))->setCellValue('J' .  ($start_row + 5), "Flow Akhir");
            $objPHPExcel->mergeCells('N' .  ($start_row + 5) . ':Q' .  ($start_row + 6))->setCellValue('N' .  ($start_row + 5), "Total");
            $objPHPExcel->mergeCells('R' .  ($start_row + 4) . ':AC' .  ($start_row + 4))->setCellValue('R' .  ($start_row + 4), "SUPPLY DEMIN TO DEARATOR");
            $objPHPExcel->mergeCells('R' .  ($start_row + 5) . ':U' .  ($start_row + 6))->setCellValue('R' .  ($start_row + 5), "Flow Awal");
            $objPHPExcel->mergeCells('V' .  ($start_row + 5) . ':Y' .  ($start_row + 6))->setCellValue('V' .  ($start_row + 5), "Flow Akhir");
            $objPHPExcel->mergeCells('Z' .  ($start_row + 5) . ':AC' .  ($start_row + 6))->setCellValue('Z' .  ($start_row + 5), "Total");
            $objPHPExcel->mergeCells('AD' .  ($start_row + 4) . ':AO' .  ($start_row + 4))->setCellValue('AD' .  ($start_row + 4), "SUPPLY DEMIN TO DEARATOR");
            $objPHPExcel->mergeCells('AD' .  ($start_row + 5) . ':AG' .  ($start_row + 6))->setCellValue('AD' .  ($start_row + 5), "Flow Awal");
            $objPHPExcel->mergeCells('AH' .  ($start_row + 5) . ':AK' .  ($start_row + 6))->setCellValue('AH' .  ($start_row + 5), "Flow Akhir");
            $objPHPExcel->mergeCells('AL' .  ($start_row + 5) . ':AO' .  ($start_row + 6))->setCellValue('AL' .  ($start_row + 5), "Total");
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AP' . ($start_row + 3) . ':AP' . ($start_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row + 3) . ':A' .  ($start_row + 6));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($start_row + 4) . ':AO' . ($start_row + 6));
            // $objPHPExcel->getStyle('B' . ($start_row + 4) . ':AP' . ($start_row + 5))->getFont()->setBold(true)->setSize(9);
            $objPHPExcel->getStyle('F' .  ($start_row + 4) . ':Q' .  ($start_row + 6))->applyFromArray($colorlightskyblue);
            $objPHPExcel->getStyle('R' .  ($start_row + 4) . ':AC' .  ($start_row + 6))->applyFromArray($colorlightgray);
            $objPHPExcel->getStyle('AD' .  ($start_row + 4) . ':AO' .  ($start_row + 6))->applyFromArray($colorlightyellow);

            $dtl_row = $start_row + 7;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(20);

                if (isset($tanggal_bahan_bakar[$a])) {
                    $tanggal_bahan_bakar[$a] = $tanggal_bahan_bakar[$a];
                } else {
                    $tanggal_bahan_bakar[$a]         = "";
                }

                if (isset($supply_flow_awal[$a])) {
                    $supply_flow_awal[$a] = $supply_flow_awal[$a];
                } else {
                    $supply_flow_awal[$a]         = "";
                }

                if (isset($supply_flow_akhir[$a])) {
                    $supply_flow_akhir[$a] = $supply_flow_akhir[$a];
                } else {
                    $supply_flow_akhir[$a]         = "";
                }

                if (isset($supply_total[$a])) {
                    $supply_total[$a] = $supply_total[$a];
                } else {
                    $supply_total[$a]         = "";
                }

                if (isset($asf_flow_awal[$a])) {
                    $asf_flow_awal[$a] = $asf_flow_awal[$a];
                } else {
                    $asf_flow_awal[$a]         = "";
                }

                if (isset($asf_flow_akhir[$a])) {
                    $asf_flow_akhir[$a] = $asf_flow_akhir[$a];
                } else {
                    $asf_flow_akhir[$a]         = "";
                }

                if (isset($asf_total[$a])) {
                    $asf_total[$a] = $asf_total[$a];
                } else {
                    $asf_total[$a]         = "";
                }

                if (isset($soft_flow_awal[$a])) {
                    $soft_flow_awal[$a] = $soft_flow_awal[$a];
                } else {
                    $soft_flow_awal[$a]         = "";
                }

                if (isset($soft_flow_akhir[$a])) {
                    $soft_flow_akhir[$a] = $soft_flow_akhir[$a];
                } else {
                    $soft_flow_akhir[$a]         = "";
                }

                if (isset($soft_total[$a])) {
                    $soft_total[$a] = $soft_total[$a];
                } else {
                    $soft_total[$a]         = "";
                }

                $objPHPExcel->mergeCells('B' .  $dtl_row . ':E' .  $dtl_row)->setCellValue('B' .  $dtl_row, $tanggal_bahan_bakar[$a]);
                $objPHPExcel->mergeCells('F' .  $dtl_row . ':I' .  $dtl_row)->setCellValue('F' .  $dtl_row, $supply_flow_awal[$a]);
                $objPHPExcel->mergeCells('J' .  $dtl_row . ':M' .  $dtl_row)->setCellValue('J' .  $dtl_row, $supply_flow_akhir[$a]);
                $objPHPExcel->mergeCells('N' .  $dtl_row . ':Q' .  $dtl_row)->setCellValue('N' .  $dtl_row, $supply_total[$a]);
                $objPHPExcel->mergeCells('R' .  $dtl_row . ':U' .  $dtl_row)->setCellValue('R' .  $dtl_row, $asf_flow_awal[$a]);
                $objPHPExcel->mergeCells('V' .  $dtl_row . ':Y' .  $dtl_row)->setCellValue('V' .  $dtl_row, $asf_flow_akhir[$a]);
                $objPHPExcel->mergeCells('Z' .  $dtl_row . ':AC' .  $dtl_row)->setCellValue('Z' .  $dtl_row, $asf_total[$a]);
                $objPHPExcel->mergeCells('AD' .  $dtl_row . ':AG' .  $dtl_row)->setCellValue('AD' .  $dtl_row, $soft_flow_awal[$a]);
                $objPHPExcel->mergeCells('AH' .  $dtl_row . ':AK' .  $dtl_row)->setCellValue('AH' .  $dtl_row, $soft_flow_akhir[$a]);
                $objPHPExcel->mergeCells('AL' .  $dtl_row . ':AO' .  $dtl_row)->setCellValue('AL' .  $dtl_row, $soft_total[$a]);
                $objPHPExcel->setSharedStyle($bodyStyle, 'B' .        $dtl_row . ':AO' . $dtl_row);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'AP' . ($dtl_row) . ':AP' . ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row) . ':A' .  ($dtl_row));
                $objPHPExcel->getStyle('B' . ($dtl_row) .     ':E' . ($dtl_row))->getFont()->setBold(true);
                $objPHPExcel->getStyle('B' . ($dtl_row) .     ':AP' . ($dtl_row))->getFont()->setSize(9);
                $objPHPExcel->getStyle('F' .  ($dtl_row) . ':Q' .  ($dtl_row))->applyFromArray($colorlightskyblue);
                $objPHPExcel->getStyle('R' .  ($dtl_row) . ':AC' .  ($dtl_row))->applyFromArray($colorlightgray);
                $objPHPExcel->getStyle('AD' .  ($dtl_row) . ':AO' .  ($dtl_row))->applyFromArray($colorlightyellow);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'AP' . ($dtl_row + 1) . ':AP' . ($dtl_row + 2));
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($dtl_row + 1) . ':A' . ($dtl_row + 2));
                $dtl_row++;
            }

            $hdr_total_row = $dtl_row;
            $objPHPExcel->mergeCells('B' . ($hdr_total_row) . ':E' . ($hdr_total_row))->setCellValue('B' . ($hdr_total_row), 'Total ');
            $objPHPExcel->mergeCells('F' . ($hdr_total_row) . ':I' . ($hdr_total_row))->setCellValue('F' . ($hdr_total_row), $supply_awal_total);
            $objPHPExcel->mergeCells('J' . ($hdr_total_row) . ':M' . ($hdr_total_row))->setCellValue('J' . ($hdr_total_row), $supply_akhir_total);
            $objPHPExcel->mergeCells('N' . ($hdr_total_row) . ':Q' . ($hdr_total_row))->setCellValue('N' . ($hdr_total_row), $supply_total_total);
            $objPHPExcel->mergeCells('R' . ($hdr_total_row) . ':U' . ($hdr_total_row))->setCellValue('R' . ($hdr_total_row), $asf_awal_total);
            $objPHPExcel->mergeCells('V' . ($hdr_total_row) . ':Y' . ($hdr_total_row))->setCellValue('V' . ($hdr_total_row), $asf_akhir_total);
            $objPHPExcel->mergeCells('Z' . ($hdr_total_row) . ':AC' . ($hdr_total_row))->setCellValue('Z' . ($hdr_total_row), $asf_total_total);
            $objPHPExcel->mergeCells('AD' . ($hdr_total_row) . ':AG' . ($hdr_total_row))->setCellValue('AD' . ($hdr_total_row), $soft_awal_total);
            $objPHPExcel->mergeCells('AH' . ($hdr_total_row) . ':AK' . ($hdr_total_row))->setCellValue('AH' . ($hdr_total_row), $soft_akhir_total);
            $objPHPExcel->mergeCells('AL' . ($hdr_total_row) . ':AO' . ($hdr_total_row))->setCellValue('AL' . ($hdr_total_row), $soft_total_total);
            $objPHPExcel->setSharedStyle($bodyStyle, 'B' .        $hdr_total_row . ':AO' . $hdr_total_row);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AP' . ($hdr_total_row) . ':AP' . ($hdr_total_row));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hdr_total_row) . ':A' .  ($hdr_total_row));
            $objPHPExcel->getStyle('B' . ($hdr_total_row) .     ':AO' . ($hdr_total_row))->getFont()->setBold(true);
            $objPHPExcel->getStyle('B' . ($hdr_total_row) .     ':AO' . ($hdr_total_row))->getFont()->setSize(9);
            $objPHPExcel->getStyle('F' .  ($hdr_total_row) . ':Q' .  ($hdr_total_row))->applyFromArray($colorlightskyblue);
            $objPHPExcel->getStyle('R' .  ($hdr_total_row) . ':AC' .  ($hdr_total_row))->applyFromArray($colorlightgray);
            $objPHPExcel->getStyle('AD' .  ($hdr_total_row) . ':AO' .  ($hdr_total_row))->applyFromArray($colorlightyellow);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AP' . ($hdr_total_row + 1) . ':AP' . ($hdr_total_row + 2));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($hdr_total_row + 1) . ':A' . ($hdr_total_row + 2));

            $start_row3 = $hdr_total_row + 1;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('R' . ($start_row3 + 1) . ':AP' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($start_row3 + 1) . ':AP' . ($start_row3 + 1))->setCellValue('R' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($start_row3 + 1) . ':AP' . ($start_row3 + 1));
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
