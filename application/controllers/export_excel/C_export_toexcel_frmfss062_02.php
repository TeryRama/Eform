<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_frmfss062_02 extends CI_Controller
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

        $dtheader = $this->M_formfrmfss062_02->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date          = $dtheaderrow->create_date;  //2021-02-08

            $create_date            = date("d-m-Y", strtotime($dtheaderrow->create_date));  //08-02-2021
            $docno                  = $dtheaderrow->docno;
            $deptabbr               = $dtheaderrow->deptabbr;
            $kode_mesin             = $dtheaderrow->kode_mesin;
            $periode                = $dtheaderrow->periode;

            $app1_by                = $dtheaderrow->app1_by;
            $app2_by                = $dtheaderrow->app2_by;

            $app1_position          = $dtheaderrow->app1_position;
            $app2_position          = $dtheaderrow->app2_position;

            $app1_personalid        = $dtheaderrow->app1_personalid;
            $app2_personalid        = $dtheaderrow->app2_personalid;

            $app1_personalstatus    = $dtheaderrow->app1_personalstatus;
            $app2_personalstatus    = $dtheaderrow->app2_personalstatus;

            $app1date               = $dtheaderrow->app1_date;
            $app2date               = $dtheaderrow->app2_date;

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
        }

        $arr_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail   = $this->M_formfrmfss062_02->get_detail_byidx($this->header_id);
        } else {
            $dtdetail   = $this->M_formfrmfss062_02->get_detail_byid($this->header_id);
        }

        $no = 1;
        foreach ($dtdetail as $dtdetail_row) {
            $nomor[]         = $no++;
            $nama_mesin[]    = trim($dtdetail_row->nama_mesin);
            $kode_mesin[]    = trim($dtdetail_row->kode_mesin);
            $tanggal[]       = trim($dtdetail_row->tanggal);
            $total_operasi[] = trim($dtdetail_row->total_operasi);
            $oli_jenis[]     = trim($dtdetail_row->oli_jenis);
            $oli_jumlah[]    = trim($dtdetail_row->oli_jumlah);
            $keterangan[]    = trim($dtdetail_row->keterangan);
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
        $HDRheaderStyle         = new PHPExcel_Style();

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
        $HDRheaderStyle->applyFromArray($this->xls->HDRheaderStyle);
        // end style

        $obj = new Excel();

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('assets/images/PSG_logo_2022.png');
        $objPHPExcel = $obj->createSheet(0);

        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getPageSetup()->setFitToPage(false);
        $objPHPExcel->getPageSetup()->setScale(70);
        $objPHPExcel->getPageMargins()->setLeft(0.2);
        $objPHPExcel->getPageMargins()->setRight(0.2);
        $objPHPExcel->getPageMargins()->setBottom(0.2);
        $objPHPExcel->getPageMargins()->setTop(0.2);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);

        $range = array();
        $rangeCol = "AJ";
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


            $objPHPExcel->mergeCells('A' .   $start_row . ':C' . ($start_row + 1));
            $objPHPExcel->mergeCells('D' .   $start_row . ':AC' . ($start_row + 1))->setCellValue('D' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AD' .  $start_row . ':AF' . $start_row)->setCellValue('AD' . $start_row, 'Doc');
            $objPHPExcel->mergeCells('AG' .  $start_row . ':AJ' . $start_row)->setCellValue('AG' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('AD' . ($start_row + 1) . ':AF' . ($start_row + 1))->setCellValue('AD' . ($start_row + 1), 'Date');
            $objPHPExcel->mergeCells('AG' . ($start_row + 1) . ':AJ' . ($start_row + 1))->setCellValue('AG' . ($start_row + 1), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' .  ($start_row + 2) . ':C' .  ($start_row + 2))->setCellValue('A' .  ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('D' .  ($start_row + 2) . ':AC' . ($start_row + 2))->setCellValue('D' .  ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AD' . ($start_row + 2) . ':AF' . ($start_row + 2))->setCellValue('AD' . ($start_row + 2), 'Page');
            $objPHPExcel->mergeCells('AG' . ($start_row + 2) . ':AJ' . ($start_row + 2))->setCellValue('AG' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle,   'D' .  $start_row .      ':AC' .  ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':AJ' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':AJ' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':AC' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AD' . ($start_row) . ':AJ' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AG' .  $start_row  . ':AJ' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AD' . ($start_row + 2) . ':AJ' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AG' . ($start_row + 2) . ':AJ' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'D' . ($start_row) . ':AC' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':AC' . ($start_row + 2));

            $hdr_row = $start_row + 0;

            $objPHPExcel->mergeCells('B' .  ($hdr_row + 4) . ':D' .  ($hdr_row + 4))->setCellValue('B' .  ($hdr_row + 4), "Dept");
            $objPHPExcel->mergeCells('E' .  ($hdr_row + 4) . ':I' .  ($hdr_row + 4))->setCellValue('E' .  ($hdr_row + 4), ': ' . $deptabbr);

            $objPHPExcel->mergeCells('B' .  ($hdr_row + 5) . ':D' .  ($hdr_row + 5))->setCellValue('B' .  ($hdr_row + 5), "Periode");
            $objPHPExcel->mergeCells('E' .  ($hdr_row + 5) . ':I' .  ($hdr_row + 5))->setCellValue('E' .  ($hdr_row + 5), ': ' . $arr_bulan[(float)date("m", strtotime($create_date))] . ' ' . date("Y", strtotime($create_date)));

            $objPHPExcel->setSharedStyle($headerStyleRight, 'AJ' . ($hdr_row + 3) . ':AJ' . ($hdr_row + 5));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hdr_row + 3) . ':A' .  ($hdr_row + 5));
            $objPHPExcel->setSharedStyle($HDRheaderStyle, 'B' . ($hdr_row + 4) . ':AI' . ($hdr_row + 5));
            $objPHPExcel->getStyle('B' . ($hdr_row + 4) . ':AI' . ($hdr_row + 4))->getFont()->setSize(9);


            $th_row = $start_row + 3;
            $objPHPExcel->mergeCells('V' .  ($th_row + 4) . ':AA' .  ($th_row + 4))->setCellValue('V' .  ($th_row + 4), "OLI/GREASE");
            $objPHPExcel->mergeCells('B' .  ($th_row + 4) . ':B' .  ($th_row + 6))->setCellValue('B' .  ($th_row + 4), "NO");
            $objPHPExcel->mergeCells('C' .  ($th_row + 4) . ':J' .  ($th_row + 6))->setCellValue('C' .  ($th_row + 4), "NAMA MESIN/BAGIAN MESIN");
            $objPHPExcel->mergeCells('K' .  ($th_row + 4) . ':N' .  ($th_row + 6))->setCellValue('K' .  ($th_row + 4), "KODE MESIN");
            $objPHPExcel->mergeCells('O' .  ($th_row + 4) . ':R' .  ($th_row + 6))->setCellValue('O' .  ($th_row + 4), "TANGGAL");
            $objPHPExcel->mergeCells('S' .  ($th_row + 4) . ':U' .  ($th_row + 6))->setCellValue('S' .  ($th_row + 4), "TOTAL OPERASI");
            $objPHPExcel->mergeCells('V' .  ($th_row + 5) . ':X' .  ($th_row + 6))->setCellValue('V' .  ($th_row + 5), "JENIS");
            $objPHPExcel->mergeCells('Y' .  ($th_row + 5) . ':AA' .  ($th_row + 6))->setCellValue('Y' .  ($th_row + 5), "JUMLAH");
            $objPHPExcel->mergeCells('AB' .  ($th_row + 4) . ':AI' .  ($th_row + 6))->setCellValue('AB' .  ($th_row + 4), "KETERANGAN");

            $objPHPExcel->setSharedStyle($headerStyleRight, 'AJ' . ($th_row + 3) . ':AJ' . ($th_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($th_row + 3) . ':A' .  ($th_row + 6));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($th_row + 4) . ':AI' . ($th_row + 6));

            $dtl_row = $th_row + 7;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(20);

                if (isset($nomor[$a])) {
                    $dt_nomor[$a] = $nomor[$a];
                } else {
                    $dt_nomor[$a] = "";
                }
                if (isset($nama_mesin[$a])) {
                    $dt_nama_mesin[$a] = $nama_mesin[$a];
                } else {
                    $dt_nama_mesin[$a] = "";
                }
                if (isset($kode_mesin[$a])) {
                    $dt_kode_mesin[$a] = $kode_mesin[$a];
                } else {
                    $dt_kode_mesin[$a] = "";
                }
                if (isset($tanggal[$a])) {
                    $dt_tanggal[$a] = date('d-m-Y', strtotime($tanggal[$a]));
                } else {
                    $dt_tanggal[$a] = "";
                }
                if (isset($total_operasi[$a])) {
                    $dt_total_operasi[$a] = $total_operasi[$a];
                } else {
                    $dt_total_operasi[$a] = "";
                }
                if (isset($oli_jenis[$a])) {
                    $dt_oli_jenis[$a] = $oli_jenis[$a];
                } else {
                    $dt_oli_jenis[$a] = "";
                }
                if (isset($oli_jumlah[$a])) {
                    $dt_oli_jumlah[$a] = $oli_jumlah[$a];
                } else {
                    $dt_oli_jumlah[$a] = "";
                }
                if (isset($keterangan[$a])) {
                    $dt_keterangan[$a] = $keterangan[$a];
                } else {
                    $dt_keterangan[$a] = "";
                }

                if ($dt_nama_mesin[$a] != '') {
                    $objPHPExcel->mergeCells('B' .  ($dtl_row) . ':B' .  ($dtl_row))->setCellValue('B' .  ($dtl_row), $dt_nomor[$a]);
                    $objPHPExcel->mergeCells('C' .  ($dtl_row) . ':J' .  ($dtl_row))->setCellValue('C' .  ($dtl_row), $dt_nama_mesin[$a]);
                    $objPHPExcel->mergeCells('K' .  ($dtl_row) . ':N' .  ($dtl_row))->setCellValue('K' .  ($dtl_row), $dt_kode_mesin[$a]);
                    $objPHPExcel->mergeCells('O' .  ($dtl_row) . ':R' .  ($dtl_row))->setCellValue('O' .  ($dtl_row), $dt_tanggal[$a]);
                    $objPHPExcel->mergeCells('S' .  ($dtl_row) . ':U' .  ($dtl_row))->setCellValue('S' .  ($dtl_row), $dt_total_operasi[$a]);
                    $objPHPExcel->mergeCells('V' .  ($dtl_row) . ':X' .  ($dtl_row))->setCellValue('V' .  ($dtl_row), $dt_oli_jenis[$a]);
                    $objPHPExcel->mergeCells('Y' .  ($dtl_row) . ':AA' .  ($dtl_row))->setCellValue('Y' .  ($dtl_row), $dt_oli_jumlah[$a]);
                    $objPHPExcel->mergeCells('AB' .  ($dtl_row) . ':AI' .  ($dtl_row))->setCellValue('AB' .  ($dtl_row), $dt_keterangan[$a]);
                } else {
                    $objPHPExcel->mergeCells('B' .  ($dtl_row) . ':B' .  ($dtl_row))->setCellValue('B' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('C' .  ($dtl_row) . ':J' .  ($dtl_row))->setCellValue('C' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('K' .  ($dtl_row) . ':N' .  ($dtl_row))->setCellValue('K' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('O' .  ($dtl_row) . ':R' .  ($dtl_row))->setCellValue('O' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('S' .  ($dtl_row) . ':U' .  ($dtl_row))->setCellValue('S' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('V' .  ($dtl_row) . ':X' .  ($dtl_row))->setCellValue('V' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('Y' .  ($dtl_row) . ':AA' .  ($dtl_row))->setCellValue('Y' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('AB' .  ($dtl_row) . ':AI' .  ($dtl_row))->setCellValue('AB' .  ($dtl_row), "");
                }

                $objPHPExcel->setSharedStyle($bodyStyle, 'B' .        $dtl_row . ':AI' . $dtl_row);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'AJ' . ($dtl_row) . ':AJ' . ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row) . ':A' .  ($dtl_row));

                $dtl_row++;
            }

            $app_row = $dtl_row + 1;
            $objPHPExcel->mergeCells('B' . ($app_row) . ':M' .  ($app_row + 9))->setCellValue('B' .  ($app_row), '');
            $objPHPExcel->mergeCells('N' . ($app_row) . ':X' .  ($app_row + 1))->setCellValue('N' .  ($app_row), 'Dibuat Oleh,');
            $objPHPExcel->mergeCells('Y' . ($app_row) . ':AI' . ($app_row + 1))->setCellValue('Y' . ($app_row), 'Disetujui Oleh,');

            $objPHPExcel->mergeCells('N' . ($app_row + 2) . ':X' .  ($app_row + 6))->setCellValue('N' . ($app_row + 2), '');
            $objPHPExcel->mergeCells('Y' . ($app_row + 2) . ':AI' . ($app_row + 6))->setCellValue('Y' . ($app_row + 2), '');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($app_row) . ':AI' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AJ' . ($app_row - 1) . ':AJ' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row - 1) . ':A' . ($app_row + 6));


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
                    $sign_img->setCoordinates('R' . ($app_row + 3));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('R' . ($app_row + 3));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('R' . ($app_row + 2));
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
                    $sign_img2->setCoordinates('AC' . ($app_row + 3));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('AC' . ($app_row + 3));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AC' . ($app_row + 2));
                }
            }

            $objPHPExcel->mergeCells('N' . ($app_row + 7) . ':P' . ($app_row + 7))->setCellValue('N' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('Q' . ($app_row + 7) . ':X' . ($app_row + 7))->setCellValue('Q' . ($app_row + 7), ': ' . $app1_by);
            $objPHPExcel->mergeCells('N' . ($app_row + 8) . ':P' . ($app_row + 8))->setCellValue('N' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('Q' . ($app_row + 8) . ':X' . ($app_row + 8))->setCellValue('Q' . ($app_row + 8), ': ' . $app1_position);
            $objPHPExcel->mergeCells('N' . ($app_row + 9) . ':P' . ($app_row + 9))->setCellValue('N' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('Q' . ($app_row + 9) . ':X' . ($app_row + 9))->setCellValue('Q' . ($app_row + 9), ': ' . $app1date);

            $objPHPExcel->mergeCells('Y' . ($app_row + 7) . ':AA' . ($app_row + 7))->setCellValue('Y' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('AB' . ($app_row + 7) . ':AI' . ($app_row + 7))->setCellValue('AB' . ($app_row + 7), ': ' . $app2_by);
            $objPHPExcel->mergeCells('Y' . ($app_row + 8) . ':AA' . ($app_row + 8))->setCellValue('Y' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('AB' . ($app_row + 8) . ':AI' . ($app_row + 8))->setCellValue('AB' . ($app_row + 8), ': ' . $app2_position);
            $objPHPExcel->mergeCells('Y' . ($app_row + 9) . ':AA' . ($app_row + 9))->setCellValue('Y' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('AB' . ($app_row + 9) . ':AI' . ($app_row + 9))->setCellValue('AB' . ($app_row + 9), ': ' . $app2date);

            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row + 7) . ':AI' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'B' . ($app_row + 7) . ':B' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'N' . ($app_row + 7) . ':N' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'Y' . ($app_row + 7) . ':Y' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($noborderStyle, 'AI' . ($app_row + 7) . ':AS' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AI' . ($app_row + 7) . ':AI' . ($app_row + 9));

            $objPHPExcel->getStyle('B' . ($app_row + 7) . ':AI' . ($app_row + 9))->getFont()->setBold(true);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AJ' . ($app_row + 7) . ':AJ' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));

            $start_row3 = $app_row + 9;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('R' . ($start_row3 + 1) . ':AJ' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($start_row3 + 1) . ':AJ' . ($start_row3 + 1))->setCellValue('R' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($start_row3 + 1) . ':AJ' . ($start_row3 + 1));
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
