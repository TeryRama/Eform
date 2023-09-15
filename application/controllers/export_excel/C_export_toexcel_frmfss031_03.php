<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_frmfss031_03 extends CI_Controller
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

        $dtheader = $this->M_formfrmfss031_03->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date          = $dtheaderrow->create_date;  //2021-02-08

            $create_date            = date("d-m-Y", strtotime($dtheaderrow->create_date));  //08-02-2021
            $docno                  = $dtheaderrow->docno;
            $nama_mesin             = $dtheaderrow->nama_mesin;
            $item                   = $dtheaderrow->item;
            $kode_mesin             = $dtheaderrow->kode_mesin;
            $total_operasi          = $dtheaderrow->total_operasi;
            $jam                    = $dtheaderrow->jam;
            $hasil_pengujian        = $dtheaderrow->hasil_pengujian;

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

        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail   = $this->M_formfrmfss031_03->get_detail_byidx($this->header_id);
        } else {
            $dtdetail   = $this->M_formfrmfss031_03->get_detail_byid($this->header_id);
        }

        $no = 1;
        foreach ($dtdetail as $dtdetail_row) {
            $nomor[]              = $no++;
            $bagian_mesin[]        = trim($dtdetail_row->bagian_mesin);
            $kondisi_masalah[]    = trim($dtdetail_row->kondisi_masalah);
            $tindakan[]           = trim($dtdetail_row->tindakan);
            $suku_cadang_jenis[]  = trim($dtdetail_row->suku_cadang_jenis);
            $suku_cadang_jumlah[] = trim($dtdetail_row->suku_cadang_jumlah);
            $keterangan[]         = trim($dtdetail_row->keterangan);
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
        $HDRheaderStyle            = new PHPExcel_Style();

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
        $objPHPExcel->getPageSetup()->setScale(68);
        $objPHPExcel->getPageMargins()->setLeft(0.2);
        $objPHPExcel->getPageMargins()->setRight(0.2);
        $objPHPExcel->getPageMargins()->setBottom(0.2);
        $objPHPExcel->getPageMargins()->setTop(0.2);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);

        $range = array();
        $rangeCol = "AO";
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
            $objPHPExcel->mergeCells('D' .   $start_row . ':AH' . ($start_row + 1))->setCellValue('D' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AI' .  $start_row . ':AK' . $start_row)->setCellValue('AI' . $start_row, 'Doc');
            $objPHPExcel->mergeCells('AL' .  $start_row . ':AO' . $start_row)->setCellValue('AL' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('AI' . ($start_row + 1) . ':AK' . ($start_row + 1))->setCellValue('AI' . ($start_row + 1), 'Date');
            $objPHPExcel->mergeCells('AL' . ($start_row + 1) . ':AO' . ($start_row + 1))->setCellValue('AL' . ($start_row + 1), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' .  ($start_row + 2) . ':C' .  ($start_row + 2))->setCellValue('A' .  ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('D' .  ($start_row + 2) . ':AH' . ($start_row + 2))->setCellValue('D' .  ($start_row + 2), $this->frmjdl . ' ' . strtoupper($item));
            $objPHPExcel->mergeCells('AI' . ($start_row + 2) . ':AK' . ($start_row + 2))->setCellValue('AI' . ($start_row + 2), 'Page');
            $objPHPExcel->mergeCells('AL' . ($start_row + 2) . ':AO' . ($start_row + 2))->setCellValue('AL' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle,   'D' .  $start_row .      ':AH' .  ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':AO' . ($start_row + 7));
            // $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 2) . ':AO' . ($start_row + 6));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':AH' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AI' . ($start_row) . ':AO' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AL' .  $start_row  . ':AO' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AI' . ($start_row + 2) . ':AO' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AL' . ($start_row + 2) . ':AO' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'D' . ($start_row) . ':AE' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':AH' . ($start_row + 2));
            $objPHPExcel->getStyle('AL' . ($start_row) . ':AO' . ($start_row))->getFont()->setSize(10);


            $hdr_row = $start_row + 0;
            $objPHPExcel->mergeCells('M' .  ($hdr_row + 4) . ':AG' .  ($hdr_row + 6))->setCellValue('M' .  ($hdr_row + 4), "");

            $objPHPExcel->mergeCells('B' .  ($hdr_row + 4) . ':E' .  ($hdr_row + 4))->setCellValue('B' .  ($hdr_row + 4), "Nama " . ucwords($item));
            $objPHPExcel->mergeCells('F' .  ($hdr_row + 4) . ':L' .  ($hdr_row + 4))->setCellValue('F' .  ($hdr_row + 4), ': ' . $nama_mesin);
            $objPHPExcel->mergeCells('AI' .  ($hdr_row + 4) . ':AK' .  ($hdr_row + 4))->setCellValue('AI' .  ($hdr_row + 4), "Tanggal");
            $objPHPExcel->mergeCells('AL' .  ($hdr_row + 4) . ':AO' .  ($hdr_row + 4))->setCellValue('AL' .  ($hdr_row + 4), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('B' .  ($hdr_row + 5) . ':E' .  ($hdr_row + 5))->setCellValue('B' .  ($hdr_row + 5), "Kode");
            $objPHPExcel->mergeCells('F' .  ($hdr_row + 5) . ':L' .  ($hdr_row + 5))->setCellValue('F' .  ($hdr_row + 5), ': ' . $kode_mesin);
            $objPHPExcel->mergeCells('AI' .  ($hdr_row + 5) . ':AK' .  ($hdr_row + 5))->setCellValue('AI' .  ($hdr_row + 5), "Jam");
            $objPHPExcel->mergeCells('AL' .  ($hdr_row + 5) . ':AO' .  ($hdr_row + 5))->setCellValue('AL' .  ($hdr_row + 5), ': ' . $jam);

            $objPHPExcel->mergeCells('B' .  ($hdr_row + 6) . ':E' .  ($hdr_row + 6))->setCellValue('B' .  ($hdr_row + 6), "Total Operasi (jam)");
            $objPHPExcel->mergeCells('F' .  ($hdr_row + 6) . ':L' .  ($hdr_row + 6))->setCellValue('F' .  ($hdr_row + 6), ': ' . $total_operasi);
            $objPHPExcel->mergeCells('AI' .  ($hdr_row + 6) . ':AO' .  ($hdr_row + 6))->setCellValue('AI' .  ($hdr_row + 6), "");

            $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($hdr_row + 3) . ':AO' . ($hdr_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hdr_row + 3) . ':A' .  ($hdr_row + 6));
            $objPHPExcel->setSharedStyle($HDRheaderStyle, 'B' . ($hdr_row + 4) . ':AN' . ($hdr_row + 6));
            $objPHPExcel->getStyle('B' . ($hdr_row + 4) . ':AN' . ($hdr_row + 4))->getFont()->setSize(9);


            $th_row = $start_row + 4;
            $objPHPExcel->mergeCells('AA' .  ($th_row + 4) . ':AF' .  ($th_row + 4))->setCellValue('AA' .  ($th_row + 4), "SUKU CADANG");
            $objPHPExcel->mergeCells('B' .  ($th_row + 4) . ':B' .  ($th_row + 6))->setCellValue('B' .  ($th_row + 4), "NO");
            $objPHPExcel->mergeCells('C' .  ($th_row + 4) . ':J' .  ($th_row + 6))->setCellValue('C' .  ($th_row + 4), "NAMA " . strtoupper($item) . " / BAGIAN " . strtoupper($item));
            $objPHPExcel->mergeCells('K' .  ($th_row + 4) . ':R' .  ($th_row + 6))->setCellValue('K' .  ($th_row + 4), "KONDISI/MASALAH");
            $objPHPExcel->mergeCells('S' .  ($th_row + 4) . ':Z' .  ($th_row + 6))->setCellValue('S' .  ($th_row + 4), "TINDAKAN");
            $objPHPExcel->mergeCells('AA' .  ($th_row + 5) . ':AC' .  ($th_row + 6))->setCellValue('AA' .  ($th_row + 5), "JENIS");
            $objPHPExcel->mergeCells('AD' .  ($th_row + 5) . ':AF' .  ($th_row + 6))->setCellValue('AD' .  ($th_row + 5), "JUMLAH");
            $objPHPExcel->mergeCells('AG' .  ($th_row + 4) . ':AN' .  ($th_row + 6))->setCellValue('AG' .  ($th_row + 4), "KETERANGAN");

            $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($th_row + 3) . ':AO' . ($th_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($th_row + 3) . ':A' .  ($th_row + 6));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($th_row + 4) . ':AN' . ($th_row + 6));
            $objPHPExcel->getStyle('B' . ($th_row + 4) . ':AN' . ($th_row + 6))->getFont()->setSize(9);


            $dtl_row = $th_row + 7;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(20);

                if (isset($nomor[$a])) {
                    $dt_nomor[$a] = $nomor[$a];
                } else {
                    $dt_nomor[$a] = "";
                }
                if (isset($bagian_mesin[$a])) {
                    $dt_bagian_mesin[$a] = $bagian_mesin[$a];
                } else {
                    $dt_bagian_mesin[$a] = "";
                }
                if (isset($kondisi_masalah[$a])) {
                    $dt_kondisi_masalah[$a] = $kondisi_masalah[$a];
                } else {
                    $dt_kondisi_masalah[$a] = "";
                }
                if (isset($tindakan[$a])) {
                    $dt_tindakan[$a] = $tindakan[$a];
                } else {
                    $dt_tindakan[$a] = "";
                }
                if (isset($suku_cadang_jenis[$a])) {
                    $dt_suku_cadang_jenis[$a] = $suku_cadang_jenis[$a];
                } else {
                    $dt_suku_cadang_jenis[$a] = "";
                }
                if (isset($suku_cadang_jumlah[$a])) {
                    $dt_suku_cadang_jumlah[$a] = $suku_cadang_jumlah[$a];
                } else {
                    $dt_suku_cadang_jumlah[$a] = "";
                }
                if (isset($keterangan[$a])) {
                    $dt_keterangan[$a] = $keterangan[$a];
                } else {
                    $dt_keterangan[$a] = "";
                }

                if ($dt_bagian_mesin[$a] != '') {
                    $objPHPExcel->mergeCells('B' .  ($dtl_row) . ':B' .  ($dtl_row))->setCellValue('B' .  ($dtl_row), $dt_nomor[$a]);
                    $objPHPExcel->mergeCells('C' .  ($dtl_row) . ':J' .  ($dtl_row))->setCellValue('C' .  ($dtl_row), $dt_bagian_mesin[$a]);
                    $objPHPExcel->mergeCells('K' .  ($dtl_row) . ':R' .  ($dtl_row))->setCellValue('K' .  ($dtl_row), $dt_kondisi_masalah[$a]);
                    $objPHPExcel->mergeCells('S' .  ($dtl_row) . ':Z' .  ($dtl_row))->setCellValue('S' .  ($dtl_row), $dt_tindakan[$a]);
                    $objPHPExcel->mergeCells('AA' .  ($dtl_row) . ':AC' .  ($dtl_row))->setCellValue('AA' .  ($dtl_row), $dt_suku_cadang_jenis[$a]);
                    $objPHPExcel->mergeCells('AD' .  ($dtl_row) . ':AF' .  ($dtl_row))->setCellValue('AD' .  ($dtl_row), $dt_suku_cadang_jumlah[$a]);
                    $objPHPExcel->mergeCells('AG' .  ($dtl_row) . ':AN' .  ($dtl_row))->setCellValue('AG' .  ($dtl_row), $dt_keterangan[$a]);
                } else {
                    $objPHPExcel->mergeCells('B' .  ($dtl_row) . ':B' .  ($dtl_row))->setCellValue('B' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('C' .  ($dtl_row) . ':J' .  ($dtl_row))->setCellValue('C' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('K' .  ($dtl_row) . ':R' .  ($dtl_row))->setCellValue('K' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('S' .  ($dtl_row) . ':Z' .  ($dtl_row))->setCellValue('S' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('AA' .  ($dtl_row) . ':AC' .  ($dtl_row))->setCellValue('AA' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('AD' .  ($dtl_row) . ':AF' .  ($dtl_row))->setCellValue('AD' .  ($dtl_row), "");
                    $objPHPExcel->mergeCells('AG' .  ($dtl_row) . ':AN' .  ($dtl_row))->setCellValue('AG' .  ($dtl_row), "");
                }

                $objPHPExcel->setSharedStyle($bodyStyle, 'B' .        $dtl_row . ':AN' . $dtl_row);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($dtl_row) . ':AO' . ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row) . ':A' .  ($dtl_row));

                $dtl_row++;
            }

            $app_row = $dtl_row + 1;
            $objPHPExcel->mergeCells('B' . ($app_row) . ':F' .  ($app_row + 2))->setCellValue('B' .  ($app_row), "Hasil Pengujian/Running Test\n(coret yang tidak perlu)");
            $objPHPExcel->mergeCells('G' . ($app_row) . ':N' .  ($app_row + 2))->setCellValue('G' .  ($app_row), " : " . $hasil_pengujian);
            $objPHPExcel->mergeCells('O' . ($app_row) . ':AA' .  ($app_row + 1))->setCellValue('O' .  ($app_row), 'Dibuat Oleh,');
            $objPHPExcel->mergeCells('AB' . ($app_row) . ':AN' . ($app_row + 1))->setCellValue('AB' . ($app_row), 'Disetujui Oleh,');

            $objPHPExcel->mergeCells('O' . ($app_row + 2) . ':AA' .  ($app_row + 6))->setCellValue('O' . ($app_row + 2), '');
            $objPHPExcel->mergeCells('AB' . ($app_row + 2) . ':AN' . ($app_row + 6))->setCellValue('AB' . ($app_row + 2), '');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'O' . ($app_row) . ':AN' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row-1) . ':AN' . ($app_row-1));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row) . ':N' . ($app_row + 10));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($app_row - 1) . ':AO' . ($app_row + 6));
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
                    $sign_img->setCoordinates('T' . ($app_row + 3));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('T' . ($app_row + 3));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('T' . ($app_row + 2));
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
                    $sign_img2->setCoordinates('AG' . ($app_row + 3));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('AG' . ($app_row + 3));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AG' . ($app_row + 2));
                }
            }

            $objPHPExcel->mergeCells('O' . ($app_row + 7) . ':Q' . ($app_row + 7))->setCellValue('O' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('R' . ($app_row + 7) . ':AA' . ($app_row + 7))->setCellValue('R' . ($app_row + 7), ': ' . $app1_by);
            $objPHPExcel->mergeCells('O' . ($app_row + 8) . ':Q' . ($app_row + 8))->setCellValue('O' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('R' . ($app_row + 8) . ':AA' . ($app_row + 8))->setCellValue('R' . ($app_row + 8), ': ' . $app1_position);
            $objPHPExcel->mergeCells('O' . ($app_row + 9) . ':Q' . ($app_row + 9))->setCellValue('O' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('R' . ($app_row + 9) . ':AA' . ($app_row + 9))->setCellValue('R' . ($app_row + 9), ': ' . $app1date);

            $objPHPExcel->mergeCells('AB' . ($app_row + 7) . ':AD' . ($app_row + 7))->setCellValue('AB' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('AE' . ($app_row + 7) . ':AN' . ($app_row + 7))->setCellValue('AE' . ($app_row + 7), ': ' . $app2_by);
            $objPHPExcel->mergeCells('AB' . ($app_row + 8) . ':AD' . ($app_row + 8))->setCellValue('AB' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('AE' . ($app_row + 8) . ':AN' . ($app_row + 8))->setCellValue('AE' . ($app_row + 8), ': ' . $app2_position);
            $objPHPExcel->mergeCells('AB' . ($app_row + 9) . ':AD' . ($app_row + 9))->setCellValue('AB' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('AE' . ($app_row + 9) . ':AN' . ($app_row + 9))->setCellValue('AE' . ($app_row + 9), ': ' . $app2date);

            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row + 7) . ':AN' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'O' . ($app_row + 7) . ':P' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AB' . ($app_row + 7) . ':AD' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($noborderStyle, 'AN' . ($app_row + 7) . ':AS' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AN' . ($app_row + 7) . ':AN' . ($app_row + 9));

            $objPHPExcel->getStyle('B' . ($app_row + 7) . ':AN' . ($app_row + 9))->getFont()->setBold(true);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($app_row + 7) . ':AO' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));

            $start_row3 = $app_row + 9;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('R' . ($start_row3 + 1) . ':AO' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($start_row3 + 1) . ':AO' . ($start_row3 + 1))->setCellValue('R' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($start_row3 + 1) . ':AO' . ($start_row3 + 1));
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
