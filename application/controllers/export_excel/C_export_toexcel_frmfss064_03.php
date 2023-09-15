<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_frmfss064_03 extends CI_Controller
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

        $dtheader = $this->M_formfrmfss064_03->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date       = $dtheaderrow->create_date; //2021-02-08

            $create_date         = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno               = $dtheaderrow->docno;

            $app1_by             = $dtheaderrow->app1_by;
            $app2_by             = $dtheaderrow->app2_by;
            $app3_by             = $dtheaderrow->app3_by;
            // $app4_by             = $dtheaderrow->app4_by;
            // $app5_by             = $dtheaderrow->app5_by;

            $app1_position       = $dtheaderrow->app1_position;
            $app2_position       = $dtheaderrow->app2_position;
            $app3_position       = $dtheaderrow->app3_position;
            // $app4_position       = $dtheaderrow->app4_position;
            // $app5_position       = $dtheaderrow->app5_position;

            $app1_personalid     = $dtheaderrow->app1_personalid;
            $app2_personalid     = $dtheaderrow->app2_personalid;
            $app3_personalid     = $dtheaderrow->app3_personalid;
            // $app4_personalid     = $dtheaderrow->app4_personalid;
            // $app5_personalid     = $dtheaderrow->app5_personalid;

            $app1_personalstatus = $dtheaderrow->app1_personalstatus;
            $app2_personalstatus = $dtheaderrow->app2_personalstatus;
            $app3_personalstatus = $dtheaderrow->app3_personalstatus;
            // $app4_personalstatus = $dtheaderrow->app4_personalstatus;
            // $app5_personalstatus = $dtheaderrow->app5_personalstatus;

            $app1date            = $dtheaderrow->app1_date;
            $app2date            = $dtheaderrow->app2_date;
            $app3date            = $dtheaderrow->app3_date;
            // $app4date            = $dtheaderrow->app4_date;
            // $app5date            = $dtheaderrow->app5_date;

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

            // if (trim($dtheaderrow->app4_date) != '') {
            //     $app4date       = date('d-m-Y', strtotime($dtheaderrow->app4_date));
            // } else {
            //     $app4date = '';
            // }
        }

        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail   = $this->M_formfrmfss064_03->get_detail_byidx($this->header_id);
        } else {
            $dtdetail   = $this->M_formfrmfss064_03->get_detail_byid($this->header_id);
        }

        $no = 1;
        foreach ($dtdetail as $dtdetail_row) {

            $nomor[]        = $no++;
            $nama_mesin[]   = trim($dtdetail_row->nama_mesin);
            $merek[]        = trim($dtdetail_row->merek);
            $tahun[]        = trim($dtdetail_row->tahun);
            $seri[]        = trim($dtdetail_row->seri);
            $daya[]         = trim($dtdetail_row->daya);
            $putaran[]      = trim($dtdetail_row->putaran);
            $tegangan[]     = trim($dtdetail_row->tegangan);
            $arus[]         = trim($dtdetail_row->arus);
            $berat[]        = trim($dtdetail_row->berat);
            $kapasitas[]    = trim($dtdetail_row->kapasitas);
            $rangkain[]     = trim($dtdetail_row->rangkain);
            $ket[]          = trim($dtdetail_row->ket);
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
        // end style

        $obj = new Excel();

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('assets/images/PSG_logo_2022.png');
        $objPHPExcel = $obj->createSheet(0);

        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getPageSetup()->setFitToPage(false);
        $objPHPExcel->getPageSetup()->setScale(65);
        $objPHPExcel->getPageMargins()->setLeft(0.2);
        $objPHPExcel->getPageMargins()->setRight(0.2);
        $objPHPExcel->getPageMargins()->setBottom(0.2);
        $objPHPExcel->getPageMargins()->setTop(0.2);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);

        $range = array();
        $rangeCol = "AR";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(5);
        }

        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(15);
        }

        $count1 = count($dtdetail);
        $jml_data_perpage = 25;
        if ($count1 < $jml_data_perpage) {
            $jml_page_a = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page_a = $count1 / $jml_data_perpage;
            } else {
                $jml_page_a = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }
        $jml_row_perpage  = $jml_data_perpage + 19;


        // $number = 0;
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


            $objPHPExcel->mergeCells('A' .   $start_row . ':D' . ($start_row + 1));
            $objPHPExcel->mergeCells('E' .   $start_row . ':AI' . ($start_row + 1))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AJ' .  $start_row . ':AL' . $start_row)->setCellValue('AJ' . $start_row, 'Doc');
            $objPHPExcel->mergeCells('AM' .  $start_row . ':AR' . $start_row)->setCellValue('AM' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('AJ' . ($start_row + 1) . ':AL' . ($start_row + 1))->setCellValue('AJ' . ($start_row + 1), 'Date');
            $objPHPExcel->mergeCells('AM' . ($start_row + 1) . ':AR' . ($start_row + 1))->setCellValue('AM' . ($start_row + 1), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' .  ($start_row + 2) . ':D' .  ($start_row + 2))->setCellValue('A' .  ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' .  ($start_row + 2) . ':AI' . ($start_row + 2))->setCellValue('E' .  ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AJ' . ($start_row + 2) . ':AL' . ($start_row + 2))->setCellValue('AJ' . ($start_row + 2), 'Page');
            $objPHPExcel->mergeCells('AM' . ($start_row + 2) . ':AR' . ($start_row + 2))->setCellValue('AM' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row .      ':D' .  ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':AR' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':AR' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':AI' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AJ' . ($start_row) . ':AR' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AM' .  $start_row  . ':AR' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AJ' . ($start_row + 2) . ':AR' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AM' . ($start_row + 2) . ':AR' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':AI' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 2));
            $objPHPExcel->getStyle('AM' . ($start_row) . ':AR' . ($start_row))->getFont()->setSize(10);



            $objPHPExcel->mergeCells('I' .  ($start_row + 4) . ':AL' .  ($start_row + 4))->setCellValue('I' .  ($start_row + 4), "SPESIFIKASI");
            $objPHPExcel->mergeCells('B' .  ($start_row + 4) . ':B' .  ($start_row + 6))->setCellValue('B' .  ($start_row + 4), "NO");
            $objPHPExcel->mergeCells('C' .  ($start_row + 4) . ':H' .  ($start_row + 6))->setCellValue('C' .  ($start_row + 4), "NAMA MESIN");
            $objPHPExcel->mergeCells('I' .  ($start_row + 5) . ':K' .  ($start_row + 6))->setCellValue('I' .  ($start_row + 5), "MERK/JENIS");
            $objPHPExcel->mergeCells('L' .  ($start_row + 5) . ':N' .  ($start_row + 6))->setCellValue('L' .  ($start_row + 5), "TAHUN PERMBUATAN");
            $objPHPExcel->mergeCells('O' .  ($start_row + 5) . ':Q' .  ($start_row + 6))->setCellValue('O' .  ($start_row + 5), "NO SERI");
            $objPHPExcel->mergeCells('R' .  ($start_row + 5) . ':T' .  ($start_row + 6))->setCellValue('R' .  ($start_row + 5), "DAYA (HP/kW)");
            $objPHPExcel->mergeCells('U' .  ($start_row + 5) . ':W' .  ($start_row + 6))->setCellValue('U' .  ($start_row + 5), "PUTARAN (RPM)");
            $objPHPExcel->mergeCells('X' .  ($start_row + 5) . ':Z' .  ($start_row + 6))->setCellValue('X' .  ($start_row + 5), "TEGANGAN (VOLT)");
            $objPHPExcel->mergeCells('AA' .  ($start_row + 5) . ':AC' .  ($start_row + 6))->setCellValue('AA' .  ($start_row + 5), "ARUS (ampere)");
            $objPHPExcel->mergeCells('AD' .  ($start_row + 5) . ':AF' .  ($start_row + 6))->setCellValue('AD' .  ($start_row + 5), "BERAT (Kg)");
            $objPHPExcel->mergeCells('AG' .  ($start_row + 5) . ':AI' .  ($start_row + 6))->setCellValue('AG' .  ($start_row + 5), "KAPASITAS (TONASE)");
            $objPHPExcel->mergeCells('AJ' .  ($start_row + 5) . ':AL' .  ($start_row + 6))->setCellValue('AJ' .  ($start_row + 5), "Rangkain");
            $objPHPExcel->mergeCells('AM' .  ($start_row + 4) . ':AQ' .  ($start_row + 6))->setCellValue('AM' .  ($start_row + 4), "KETERANGAN");

            $objPHPExcel->setSharedStyle($headerStyleRight, 'AR' . ($start_row + 3) . ':AR' . ($start_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row + 3) . ':A' .  ($start_row + 6));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($start_row + 4) . ':AQ' . ($start_row + 6));
            $objPHPExcel->getStyle('B' . ($start_row + 4) . ':AQ' . ($start_row + 6))->getFont()->setBold(true)->setSize(9);


            $dtl_row = $start_row + 7;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(20);

                if (isset($nomor[$a])) {
                    $dt_nomor[$a]    = $nomor[$a];
                } else {
                    $dt_nomor[$a]    = "";
                }
                if (isset($nama_mesin[$a])) {
                    $dt_nama_mesin[$a]    = $nama_mesin[$a];
                } else {
                    $dt_nama_mesin[$a]    = "";
                }
                if (isset($merek[$a])) {
                    $dt_merek[$a]         = $merek[$a];
                } else {
                    $dt_merek[$a]         = "";
                }
                if (isset($tahun[$a])) {
                    $dt_tahun[$a]         = $tahun[$a];
                } else {
                    $dt_tahun[$a]         = "";
                }
                if (isset($seri[$a])) {
                    $dt_seri[$a]         = $seri[$a];
                } else {
                    $dt_seri[$a]         = "";
                }
                if (isset($daya[$a])) {
                    $dt_daya[$a]          = $daya[$a];
                } else {
                    $dt_daya[$a]          = "";
                }
                if (isset($putaran[$a])) {
                    $dt_putaran[$a]       = $putaran[$a];
                } else {
                    $dt_putaran[$a]       = "";
                }
                if (isset($tegangan[$a])) {
                    $dt_tegangan[$a]      = $tegangan[$a];
                } else {
                    $dt_tegangan[$a]      = "";
                }
                if (isset($arus[$a])) {
                    $dt_arus[$a]          = $arus[$a];
                } else {
                    $dt_arus[$a]          = "";
                }
                if (isset($berat[$a])) {
                    $dt_berat[$a]         = $berat[$a];
                } else {
                    $dt_berat[$a]         = "";
                }
                if (isset($kapasitas[$a])) {
                    $dt_kapasitas[$a]     = $kapasitas[$a];
                } else {
                    $dt_kapasitas[$a]     = "";
                }
                if (isset($rangkain[$a])) {
                    $dt_rangkain[$a]      = $rangkain[$a];
                } else {
                    $dt_rangkain[$a]      = "";
                }
                if (isset($ket[$a])) {
                    $dt_ket[$a]           = $ket[$a];
                } else {
                    $dt_ket[$a]           = "";
                }

                if($dt_nama_mesin[$a]!=''){
                    $objPHPExcel->mergeCells('B' .  ($dtl_row) . ':B' .  ($dtl_row))->setCellValue('B' .  ($dtl_row), $dt_nomor[$a]);
                    $objPHPExcel->mergeCells('C' .  ($dtl_row) . ':H' .  ($dtl_row))->setCellValue('C' .  ($dtl_row), $dt_nama_mesin[$a]);
                    $objPHPExcel->mergeCells('I' .  ($dtl_row) . ':K' .  ($dtl_row))->setCellValue('I' .  ($dtl_row), $dt_merek[$a]);
                    $objPHPExcel->mergeCells('L' .  ($dtl_row) . ':N' .  ($dtl_row))->setCellValue('L' .  ($dtl_row), $dt_tahun[$a]);
                    $objPHPExcel->mergeCells('O' .  ($dtl_row) . ':Q' .  ($dtl_row))->setCellValue('O' .  ($dtl_row), $dt_seri[$a]);
                    $objPHPExcel->mergeCells('R' .  ($dtl_row) . ':T' .  ($dtl_row))->setCellValue('R' .  ($dtl_row), $dt_daya[$a]);
                    $objPHPExcel->mergeCells('U' .  ($dtl_row) . ':W' .  ($dtl_row))->setCellValue('U' .  ($dtl_row), $dt_putaran[$a]);
                    $objPHPExcel->mergeCells('X' .  ($dtl_row) . ':Z' .  ($dtl_row))->setCellValue('X' .  ($dtl_row), $dt_tegangan[$a]);
                    $objPHPExcel->mergeCells('AA' .  ($dtl_row) . ':AC' .  ($dtl_row))->setCellValue('AA' .  ($dtl_row), $dt_arus[$a]);
                    $objPHPExcel->mergeCells('AD' .  ($dtl_row) . ':AF' .  ($dtl_row))->setCellValue('AD' .  ($dtl_row), $dt_berat[$a]);
                    $objPHPExcel->mergeCells('AG' .  ($dtl_row) . ':AI' .  ($dtl_row))->setCellValue('AG' .  ($dtl_row), $dt_kapasitas[$a]);
                    $objPHPExcel->mergeCells('AJ' .  ($dtl_row) . ':AL' .  ($dtl_row))->setCellValue('AJ' .  ($dtl_row), $dt_rangkain[$a]);
                    $objPHPExcel->mergeCells('AM' .  ($dtl_row) . ':AQ' .  ($dtl_row))->setCellValue('AM' .  ($dtl_row), $dt_ket[$a]);
                }else{
                    $objPHPExcel->mergeCells('B' .  ($dtl_row) . ':B' .  ($dtl_row))->setCellValue('B' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('C' .  ($dtl_row) . ':H' .  ($dtl_row))->setCellValue('C' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('I' .  ($dtl_row) . ':K' .  ($dtl_row))->setCellValue('I' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('L' .  ($dtl_row) . ':N' .  ($dtl_row))->setCellValue('L' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('O' .  ($dtl_row) . ':Q' .  ($dtl_row))->setCellValue('O' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('R' .  ($dtl_row) . ':T' .  ($dtl_row))->setCellValue('R' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('U' .  ($dtl_row) . ':W' .  ($dtl_row))->setCellValue('U' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('X' .  ($dtl_row) . ':Z' .  ($dtl_row))->setCellValue('X' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('AA' .  ($dtl_row) . ':AC' .  ($dtl_row))->setCellValue('AA' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('AD' .  ($dtl_row) . ':AF' .  ($dtl_row))->setCellValue('AD' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('AG' .  ($dtl_row) . ':AI' .  ($dtl_row))->setCellValue('AG' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('AJ' .  ($dtl_row) . ':AL' .  ($dtl_row))->setCellValue('AJ' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('AM' .  ($dtl_row) . ':AQ' .  ($dtl_row))->setCellValue('AM' .  ($dtl_row), "");
                }

                $objPHPExcel->setSharedStyle($bodyStyle, 'B' .        $dtl_row . ':AQ' . $dtl_row);
                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'C' .        $dtl_row . ':H' . $dtl_row);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'AR' . ($dtl_row) . ':AR' . ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row) . ':A' .  ($dtl_row));

                $dtl_row++;
            }

            $app_row = $dtl_row + 1;

            $objPHPExcel->mergeCells('B' . ($app_row) . ':O' .  ($app_row + 1))->setCellValue('B' .  ($app_row), 'Dibuat Oleh,');
            $objPHPExcel->mergeCells('P' . ($app_row) . ':AC' . ($app_row + 1))->setCellValue('P' .  ($app_row), 'Diketahui Oleh,');
            $objPHPExcel->mergeCells('AD' . ($app_row) . ':AQ' . ($app_row + 1))->setCellValue('AD' . ($app_row), 'Disetujui Oleh,');

            $objPHPExcel->mergeCells('B' . ($app_row + 2) . ':O' .  ($app_row + 6))->setCellValue('B' . ($app_row + 2), '');
            $objPHPExcel->mergeCells('P' . ($app_row + 2) . ':AC' . ($app_row + 6))->setCellValue('V' . ($app_row + 2), '');
            $objPHPExcel->mergeCells('AD' . ($app_row + 2) . ':AQ' . ($app_row + 6))->setCellValue('AD' . ($app_row + 2), '');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($app_row) . ':AQ' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AR' . ($app_row-1) . ':AR' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row-1) . ':A' . ($app_row + 6));


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
                    $sign_img->setCoordinates('F' . ($app_row + 3));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('F' . ($app_row + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('E' . ($app_row + 2));
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
                    $sign_img2->setCoordinates('U' . ($app_row + 3));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('U' . ($app_row + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('U' . ($app_row + 2));
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
                    $sign_img3->setCoordinates('AJ' . ($app_row + 3));
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('AJ' . ($app_row + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AJ' . ($app_row + 2));
                }
            }

            // if ($app4_personalstatus == '2') {
            //     $imageurlapp4 = '/forviewfoto_pekerja/TTD_TK/';
            //     $imageformatapp4 = '.png';
            // } else if ($app4_personalstatus == '1') {
            //     $imageurlapp4 = '/forviewfoto_pekerja/';
            //     $imageformatapp4 = '_0_0.png';
            // } else {
            //     $imageurlapp4 = '';
            //     $imageformatapp4 = '';
            // }

            // $sign_img4 = '$objDrawing' . $i1;
            // if (isset($app4_by)) {
            //     if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app4_personalstatus . '_' . $app4_personalid . '.png')) {
            //         $sign_img4 = new PHPExcel_Worksheet_Drawing();
            //         $sign_img4->setPath('assets/ttd/' . $app4_personalstatus . '_' . $app4_personalid . '.png');
            //         $sign_img4->setWidthAndHeight(135, 135);
            //         $sign_img4->setResizeProportional(true);
            //         $sign_img4->setWorksheet($objPHPExcel);
            //         $sign_img4->setCoordinates('AK' . ($app_row + 3));
            //     } else if ($app4_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4)) {
            //         $sign_img4 = new PHPExcel_Worksheet_Drawing();
            //         $sign_img4->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4);
            //         $sign_img4->setWidthAndHeight(135, 135);
            //         $sign_img4->setResizeProportional(true);
            //         $sign_img4->setWorksheet($objPHPExcel);
            //         $sign_img4->setCoordinates('AK' . ($app_row + 3));
            //     }
            // }


            $objPHPExcel->mergeCells('B' . ($app_row + 7) . ':D' . ($app_row + 7))->setCellValue('B' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('E' . ($app_row + 7) . ':O' . ($app_row + 7))->setCellValue('E' . ($app_row + 7), ': ' . $app1_by);
            $objPHPExcel->mergeCells('B' . ($app_row + 8) . ':D' . ($app_row + 8))->setCellValue('B' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('E' . ($app_row + 8) . ':O' . ($app_row + 8))->setCellValue('E' . ($app_row + 8), ': ' . $app1_position);
            $objPHPExcel->mergeCells('B' . ($app_row + 9) . ':D' . ($app_row + 9))->setCellValue('B' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('E' . ($app_row + 9) . ':O' . ($app_row + 9))->setCellValue('E' . ($app_row + 9), ': ' . $app1date);

            $objPHPExcel->mergeCells('P' . ($app_row + 7) . ':R' . ($app_row + 7))->setCellValue('P' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('S' . ($app_row + 7) . ':AC' . ($app_row + 7))->setCellValue('S' . ($app_row + 7), ': ' . $app2_by);
            $objPHPExcel->mergeCells('P' . ($app_row + 8) . ':R' . ($app_row + 8))->setCellValue('P' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('S' . ($app_row + 8) . ':AC' . ($app_row + 8))->setCellValue('S' . ($app_row + 8), ': ' . $app2_position);
            $objPHPExcel->mergeCells('P' . ($app_row + 9) . ':R' . ($app_row + 9))->setCellValue('P' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('S' . ($app_row + 9) . ':AC' . ($app_row + 9))->setCellValue('S' . ($app_row + 9), ': ' . $app2date);
        
            $objPHPExcel->mergeCells('AD' . ($app_row + 7) . ':AF' . ($app_row + 7))->setCellValue('AD' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('AG' . ($app_row + 7) . ':AQ' . ($app_row + 7))->setCellValue('AG' . ($app_row + 7), ': ' . $app3_by);
            $objPHPExcel->mergeCells('AD' . ($app_row + 8) . ':AF' . ($app_row + 8))->setCellValue('AD' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('AG' . ($app_row + 8) . ':AQ' . ($app_row + 8))->setCellValue('AG' . ($app_row + 8), ': ' . $app3_position);
            $objPHPExcel->mergeCells('AD' . ($app_row + 9) . ':AF' . ($app_row + 9))->setCellValue('AD' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('AG' . ($app_row + 9) . ':AQ' . ($app_row + 9))->setCellValue('AG' . ($app_row + 9), ': ' . $app3date);

            // $objPHPExcel->mergeCells('AF' . ($app_row + 7) . ':AH' . ($app_row + 7))->setCellValue('AF' . ($app_row + 7), 'Nama');
            // $objPHPExcel->mergeCells('AI' . ($app_row + 7) . ':AQ' . ($app_row + 7))->setCellValue('AI' . ($app_row + 7), ': ' . $app4_by);
            // $objPHPExcel->mergeCells('AF' . ($app_row + 8) . ':AH' . ($app_row + 8))->setCellValue('AF' . ($app_row + 8), 'Jabatan');
            // $objPHPExcel->mergeCells('AI' . ($app_row + 8) . ':AQ' . ($app_row + 8))->setCellValue('AI' . ($app_row + 8), ': ' . $app4_position);
            // $objPHPExcel->mergeCells('AF' . ($app_row + 9) . ':AH' . ($app_row + 9))->setCellValue('AF' . ($app_row + 9), 'Tanggal');
            // $objPHPExcel->mergeCells('AI' . ($app_row + 9) . ':AQ' . ($app_row + 9))->setCellValue('AI' . ($app_row + 9), ': ' . $app4date);

            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row + 7) . ':AQ' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'B' . ($app_row + 7) . ':B' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'P' . ($app_row + 7) . ':P' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AD' . ($app_row + 7) . ':AD' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($noborderStyle, 'AQ' . ($app_row + 7) . ':AS' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AQ' . ($app_row + 7) . ':AQ' . ($app_row + 9));

            $objPHPExcel->getStyle('B' . ($app_row + 7) . ':AQ' . ($app_row + 9))->getFont()->setBold(true);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AR' . ($app_row + 7) . ':AR' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));

            $start_row3 = $app_row + 9;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('R' . ($start_row3 + 1) . ':AR' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($start_row3 + 1) . ':AR' . ($start_row3 + 1))->setCellValue('R' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($start_row3 + 1) . ':AR' . ($start_row3 + 1));
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
