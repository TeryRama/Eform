<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_intwtd005_00 extends CI_Controller
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

        $dtheader = $this->M_formintwtd005_00->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date          = $dtheaderrow->create_date; //2021-02-08

            $create_date            = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno                  = $dtheaderrow->docno;
            $kode                   = $dtheaderrow->kode;
            $kode_name              = $dtheaderrow->kode_name;
            $bulan                  = $dtheaderrow->bulan;
            $tahun                  = date("Y");

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

        if ($bulan == 1) {
            $NamaBulan = "Januari";
        } else if ($bulan == 2) {
            $NamaBulan = "Februari";
        } else if ($bulan == 3) {
            $NamaBulan = "Maret";
        } else if ($bulan == 5) {
            $NamaBulan = "April";
        } else if ($bulan == 5) {
            $NamaBulan = "Mei";
        } else if ($bulan == 6) {
            $NamaBulan = "Juni";
        } else if ($bulan == 7) {
            $NamaBulan = "Juli";
        } else if ($bulan == 8) {
            $NamaBulan = "Agustus";
        } else if ($bulan == 9) {
            $NamaBulan = "September";
        } else if ($bulan == 10) {
            $NamaBulan = "Oktober";
        } else if ($bulan == 11) {
            $NamaBulan = "November";
        } else if ($bulan == 12) {
            $NamaBulan = "Desember";
        }

        $date_calender = $this->M_formintwtd005_00->get_date_calender($bulan, $tahun);
        if ($this->cekLevelUserNm == 'Auditor') {
            $dtdetail   = $this->M_formintwtd005_00->get_detail_byidx($this->header_id);
        } else {
            $dtdetail   = $this->M_formintwtd005_00->get_detail_byid($this->header_id);
        }

        //detail a
        if(isset($dtdetail)){
            $no = 1;
            foreach ($dtdetail as $dtdetail_row) {
                $nomor[]                = $no++;
                $arr_a_nama_bagian[]    = trim ($dtdetail_row->nama_bagian);
                foreach ($date_calender as $date_calender_row) {
                    ${'arr_a_day'.$date_calender_row->day}[] = trim ($dtdetail_row->{'day'.$date_calender_row->day});
                }
                $arr_a_ket[]            = trim ($dtdetail_row->ket);
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

        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);  
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
            $objPHPExcel->getColumnDimension($columnID)->setWidth(5);
        }

        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(15);
        }
        //tabel a
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

        $jml_row_perpage  = ($jml_data_perpage)+35;

        for ($i1 = 0; $i1 < $jml_page_a; $i1++) {

            $start_row = ($i1 * $jml_row_perpage) + 1;
            $finish_row = ((($i1 * $jml_row_perpage) + 1) + ($jml_row_perpage));

            $start_detail = ($i1 * $jml_data_perpage);
            $finish_detail = (($i1 * $jml_data_perpage) + ($jml_data_perpage - 1));


            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/PSG_logo_2022.png');
            $gbr->setWidthAndHeight(60, 60);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('B' . $start_row);


            $objPHPExcel->mergeCells('A' .  $start_row . ':D' . ($start_row + 2));
            $objPHPExcel->mergeCells('E' .  $start_row . ':AJ' . ($start_row + 2))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AK' . $start_row . ':AL' . $start_row)->setCellValue('AK' . $start_row, 'DOK');
            $objPHPExcel->mergeCells('AM' . $start_row . ':AQ' . $start_row)->setCellValue('AM' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('AK' . ($start_row + 1) . ':AL' . ($start_row + 1))->setCellValue('AK' . ($start_row + 1), 'DEPT.');
            $objPHPExcel->mergeCells('AM' . ($start_row + 1) . ':AQ' . ($start_row + 1))->setCellValue('AM' . ($start_row + 1), ': WTD');

            $objPHPExcel->mergeCells('AK' . ($start_row + 2) . ':AL' . ($start_row + 2))->setCellValue('AK' . ($start_row + 2), 'Tanggal');
            $objPHPExcel->mergeCells('AM' . ($start_row + 2) . ':AQ' . ($start_row + 2))->setCellValue('AM' . ($start_row + 2), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' . ($start_row + 3) . ':D' . ($start_row + 3))->setCellValue('A' . ($start_row + 3), 'JUDUL');
            $objPHPExcel->mergeCells('E' . ($start_row + 3) . ':AJ' . ($start_row + 3))->setCellValue('E' . ($start_row + 3), $this->frmjdl);

            $objPHPExcel->mergeCells('AK' . ($start_row + 3) . ':AL' . ($start_row + 3))->setCellValue('AK' . ($start_row + 3), 'HLM');
            $objPHPExcel->mergeCells('AM' . ($start_row + 3) . ':AQ' . ($start_row + 3))->setCellValue('AM' . ($start_row + 3), ': ' . ($i1 + 1) . ' of ' . ($jml_page_a));

            $objPHPExcel->setSharedStyle($headerStyle,   'A' . $start_row . ':D' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row) . ':AJ' . ($start_row + 3));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AK' . ($start_row) . ':AQ' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AM' . $start_row  . ':AQ' . ($start_row + 3));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AK' . ($start_row + 2) . ':AQ' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AM' . ($start_row + 2) . ':AQ' . ($start_row + 3));

            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':AJ' . ($start_row + 3));
            
            $objPHPExcel->mergeCells('A' . ($start_row + 4) . ':X' . ($start_row + 4))->setCellValue('A' . ($start_row + 4), 'KODE : '. $kode_name);
            $objPHPExcel->mergeCells('Y' . ($start_row + 4) . ':AJ' . ($start_row + 4))->setCellValue('Y' . ($start_row + 4), 'BULAN : '. $NamaBulan);

            $objPHPExcel->setSharedStyle($headerStyleLeftTop, 'A' . ($start_row + 4) . ':A' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($noborderStyleBold, 'B' . ($start_row + 4) . ':AP' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AQ' . ($start_row + 4) . ':AQ' . ($start_row + 4));


            $objPHPExcel->mergeCells('A' . ($start_row + 5) . ':A' . ($start_row + 6))->setCellValue('A' . ($start_row + 5), 'No.');
            $objPHPExcel->mergeCells('B' . ($start_row + 5) . ':E' . ($start_row + 6))->setCellValue('B' . ($start_row + 5), 'Nama/Bagian');
            $objPHPExcel->mergeCells('F' . ($start_row + 5) . ':AJ' . ($start_row + 5))->setCellValue('F' . ($start_row + 5), 'Tanggal');
            $a1 = 'E';
            foreach ($date_calender as $date_calender_row) {
                $a1++;
                $objPHPExcel->mergeCells($a1 . ($start_row + 6) . ':'. $a1 . ($start_row + 6))->setCellValue($a1 . ($start_row + 6), $date_calender_row->day);
            }
            $objPHPExcel->mergeCells('AK' . ($start_row + 5) . ':AQ' . ($start_row + 6))->setCellValue('AK' . ($start_row + 5), "KETERANGAN");

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row + 5) . ':AQ' . ($start_row + 6));

            $col_tgl = ['P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT'];

            $dtl_row = $start_row + 6;
            $no = 1;
            $rowspan_b = -1; 
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {
                $dtl_row++;
                $rowspan_b++;
                
                if(isset($nomor[$arr])){
                    $dt_number[$arr] = $nomor[$arr];
                }else{
                    $dt_number[$arr] = "";
                }
                if(isset($arr_a_nama_bagian[$arr])){
                    $dt_a_nama_bagian[$arr] = $arr_a_nama_bagian[$arr];
                }else{
                    $dt_a_nama_bagian[$arr] = "";
                }
                if(isset($arr_a_ket[$arr])){
                    $dt_a_ket[$arr] = $arr_a_ket[$arr];
                }else{
                    $dt_a_ket[$arr] = "";
                }
                foreach ($date_calender as $date_calender_row) {
                    if(isset(${'arr_a_day'.$date_calender_row->day}[$arr])){
                        ${'dt_a_day'.$date_calender_row->day}[$arr] = ${'arr_a_day'.$date_calender_row->day}[$arr];
                    }else{
                        ${'dt_a_day'.$date_calender_row->day}[$arr] = "";
                    }
                }

                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . (($dtl_row)) . ':AQ' . (($dtl_row)));
                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'B' . (($dtl_row)) . ':E' . (($dtl_row)));
                
                if(trim($arr_a_nama_bagian[$arr]) == 'Nama Petugas'){
                    $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(28);
                    $objPHPExcel->mergeCells('A' . ($dtl_row) . ':E' . ($dtl_row))->setCellValue('A' . ($dtl_row), $dt_a_nama_bagian[$arr]);

                    $a2 = 'E';
                    foreach ($date_calender as $date_calender_row) {
                        $a2++;                        
                        if(isset(${'dt_a_day'.$date_calender_row->day}[$arr])){
                            $objPHPExcel->mergeCells($a2 . ($dtl_row) . ':'. $a2 . ($dtl_row))->setCellValue($a2 . ($dtl_row), ${'dt_a_day'.$date_calender_row->day}[$arr]);
                        }else{
                            $objPHPExcel->mergeCells($a2 . ($dtl_row) . ':'. $a2 . ($dtl_row))->setCellValue($a2 . ($dtl_row), "");
                        }
                    }
    
                    $objPHPExcel->mergeCells('AK' . ($dtl_row) . ':AQ' . ($dtl_row))->setCellValue('AK' . ($dtl_row), $dt_a_ket[$arr]);
                }else{
                    $objPHPExcel->mergeCells('A' . ($dtl_row) . ':A' . ($dtl_row))->setCellValue('A' . ($dtl_row), $dt_number[$arr]);
                    $objPHPExcel->mergeCells('B' . ($dtl_row) . ':E' . ($dtl_row))->setCellValue('B' . ($dtl_row), $dt_a_nama_bagian[$arr]);

                    $a2 = 'E';
                    foreach ($date_calender as $date_calender_row) {
                        $a2++;                        
                        if(isset(${'dt_a_day'.$date_calender_row->day}[$arr])){
                            if(${'dt_a_day'.$date_calender_row->day}[$arr] == '0'){
                                $objPHPExcel->mergeCells($a2 . ($dtl_row) . ':'. $a2 . ($dtl_row))->setCellValue($a2 . ($dtl_row), "✔");
                            }elseif(${'dt_a_day'.$date_calender_row->day}[$arr] == '1'){
                                $objPHPExcel->mergeCells($a2 . ($dtl_row) . ':'. $a2 . ($dtl_row))->setCellValue($a2 . ($dtl_row), "✖");
                            }elseif(${'dt_a_day'.$date_calender_row->day}[$arr] == '2'){
                                $objPHPExcel->mergeCells($a2 . ($dtl_row) . ':'. $a2 . ($dtl_row))->setCellValue($a2 . ($dtl_row), "Δ");
                            }elseif(${'dt_a_day'.$date_calender_row->day}[$arr] == '3'){
                                $objPHPExcel->mergeCells($a2 . ($dtl_row) . ':'. $a2 . ($dtl_row))->setCellValue($a2 . ($dtl_row), "NA");
                            }
                        }else{
                            $objPHPExcel->mergeCells($a2 . ($dtl_row) . ':'. $a2 . ($dtl_row))->setCellValue($a2 . ($dtl_row), "");
                        }
                    }
    
                    $objPHPExcel->mergeCells('AK' . ($dtl_row) . ':AQ' . ($dtl_row))->setCellValue('AK' . ($dtl_row), $dt_a_ket[$arr]);
                }
            }
            $app_row = $dtl_row + 2;

            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A' . ($app_row - 1) . ':A' . ($app_row - 1));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row - 1) . ':AP' . ($app_row - 1));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AQ' . ($app_row - 1) . ':AQ' . ($app_row - 1));

            $objPHPExcel->mergeCells('A' . ($app_row) . ':D' . ($app_row))->setCellValue('A' . ($app_row), 'Keterangan :');
            $objPHPExcel->mergeCells('B' . ($app_row + 1) . ':C' . ($app_row + 1))->setCellValue('B' . ($app_row + 1), '✔');
            $objPHPExcel->mergeCells('B' . ($app_row + 2) . ':C' . ($app_row + 2))->setCellValue('B' . ($app_row + 2), '✖');
            $objPHPExcel->mergeCells('B' . ($app_row + 3) . ':C' . ($app_row + 3))->setCellValue('B' . ($app_row + 3), 'Δ');
            $objPHPExcel->mergeCells('B' . ($app_row + 4) . ':C' . ($app_row + 4))->setCellValue('B' . ($app_row + 4), 'NA');
            $objPHPExcel->mergeCells('D' . ($app_row + 1) . ':K' . ($app_row + 1))->setCellValue('D' . ($app_row + 1), ':  Baik/normal');
            $objPHPExcel->mergeCells('D' . ($app_row + 2) . ':K' . ($app_row + 2))->setCellValue('D' . ($app_row + 2), ':  Ada Masalah Langsung Action');
            $objPHPExcel->mergeCells('D' . ($app_row + 3) . ':K' . ($app_row + 3))->setCellValue('D' . ($app_row + 3), ':  Ada Masalah Tertunda');
            $objPHPExcel->mergeCells('D' . ($app_row + 4) . ':K' . ($app_row + 4))->setCellValue('D' . ($app_row + 4), ':  Not Applicable');

            $objPHPExcel->mergeCells('AB' . ($app_row) . ':AI' . ($app_row))->setCellValue('AB' . ($app_row), 'Diperiksa oleh,');
            $objPHPExcel->mergeCells('AJ' . ($app_row) . ':AQ' . ($app_row))->setCellValue('AJ' . ($app_row), 'Diketahui Oleh,');

            $objPHPExcel->mergeCells('AB' . ($app_row + 1) . ':AI' . ($app_row + 3))->setCellValue('AB' . ($app_row + 1), '');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 1) . ':AQ' . ($app_row + 3))->setCellValue('AJ' . ($app_row + 1), '');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AB' . ($app_row) . ':AQ' . ($app_row + 3));


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
                    $sign_img->setCoordinates('AD' . ($app_row + 1));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AD' . ($app_row + 1));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AD' . ($app_row + 1));
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
                    $sign_img2->setCoordinates('AL' . ($app_row + 1));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('AL' . ($app_row + 1));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AL' . ($app_row + 1));
                }
            }

            $objPHPExcel->mergeCells('AB' . ($app_row + 4) . ':AC' . ($app_row + 4))->setCellValue('AB' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('AD' . ($app_row + 4) . ':AI' . ($app_row + 4))->setCellValue('AD' . ($app_row + 4), ': ' . $app1_by);
            $objPHPExcel->mergeCells('AB' . ($app_row + 5) . ':AC' . ($app_row + 5))->setCellValue('AB' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('AD' . ($app_row + 5) . ':AI' . ($app_row + 5))->setCellValue('AD' . ($app_row + 5), ': ' . $app1_position);
            $objPHPExcel->mergeCells('AB' . ($app_row + 6) . ':AC' . ($app_row + 6))->setCellValue('AB' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('AD' . ($app_row + 6) . ':AI' . ($app_row + 6))->setCellValue('AD' . ($app_row + 6), ': ' . $app1date);

            $objPHPExcel->mergeCells('AJ' . ($app_row + 4) . ':AK' . ($app_row + 4))->setCellValue('AJ' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('AL' . ($app_row + 4) . ':AQ' . ($app_row + 4))->setCellValue('AL' . ($app_row + 4), ': ' . $app2_by);
            $objPHPExcel->mergeCells('AJ' . ($app_row + 5) . ':AK' . ($app_row + 5))->setCellValue('AJ' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('AL' . ($app_row + 5) . ':AQ' . ($app_row + 5))->setCellValue('AL' . ($app_row + 5), ': ' . $app2_position);
            $objPHPExcel->mergeCells('AJ' . ($app_row + 6) . ':AK' . ($app_row + 6))->setCellValue('AJ' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('AL' . ($app_row + 6) . ':AQ' . ($app_row + 6))->setCellValue('AL' . ($app_row + 6), ': ' . $app2date);

            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A' . ($app_row) . ':A' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row) . ':AA' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($noborderStyle, 'AB' . ($app_row + 4) . ':AQ' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AB' . ($app_row + 4) . ':AB' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AJ' . ($app_row + 4) . ':AJ' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AQ' . ($app_row + 4) . ':AQ' . ($app_row + 6));

            // $objPHPExcel->getStyle('AK' . ($app_row + 7) . ':CE' . ($app_row + 9))->getFont()->setBold(true);
            // $objPHPExcel->setSharedStyle($bodyStyleRight, 'CF' . ($app_row + 7) . ':CF' . ($app_row + 9));
            // $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AK' . ($app_row + 7) . ':AK' . ($app_row + 9));

            $start_row3 = $app_row + 6;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':H' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':H' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('I' . ($start_row3 + 1) . ':AQ' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('I' . ($start_row3 + 1) . ':AQ' . ($start_row3 + 1))->setCellValue('I' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':H' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'I' . ($start_row3 + 1) . ':AQ' . ($start_row3 + 1));
            $objPHPExcel->setBreak('A' . ($start_row3 + 1),  PHPExcel_Worksheet::BREAK_ROW);
        }

            // die;
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
