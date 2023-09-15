<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_intwtd028_00 extends CI_Controller
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
        $frmkode    = $this->uri->segment(4);
        $frmvrs     = $this->uri->segment(5);
        $segment6   = $this->uri->segment(6);
        $segment7   = $this->uri->segment(7);
        if (trim($segment6) != '-') {
            $bulan  = urldecode($segment6);
        } else {
            $bulan  = '';
        }
        if (trim($segment7) != '-') {
            $tahun  = urldecode($segment7);
        } else {
            $tahun  = '';
        }
        $dtfrm                    = $this->M_forminput->get_dtform($frmkode, $frmvrs);

        foreach ($dtfrm as $datafrm) {
            $this->frmkd          = $datafrm->formkd;
            $this->frmjdl         = $datafrm->formjudul;
            $this->frmnm          = $datafrm->formnm;
            $this->frmver         = $datafrm->formversi;
            $this->frmefective    = date("d-m-Y", strtotime($datafrm->formefective));
        }
        //end Get dtheader

        if ($this->cekLevelUserNm == 'Auditor') {
            $date_calender = $this->M_formintwtd028_00->get_date_calender($bulan, $tahun);
            $dtdetail_lap = $this->M_formintwtd028_00->get_detail_lap_bydate($bulan, $tahun);
        } else {
            $date_calender = $this->M_formintwtd028_00->get_date_calender($bulan, $tahun);
            $dtdetail_lap = $this->M_formintwtd028_00->get_detail_lap_bydate($bulan, $tahun);
        }

        $no = 1;
        $arr_parent = -1;
        foreach ($dtdetail_lap as $dtlaporan_row) {
            $arr_parent++;
            $number[]           = $no++;
            $nama_jenis_air[]   = $dtlaporan_row->nama_jenis_air;
            $nama_departemen[]  = $dtlaporan_row->nama_departemen;
            $nama_flow[]        = $dtlaporan_row->nama_flow;
            $no_urut_desc[]     = $dtlaporan_row->no_urut_desc;
            $no_urut[]          = $dtlaporan_row->no_urut;
            // $no_urut2[]         = $dtlaporan_row->no_urut2_asc;
            if (isset($dtlaporan_row->children)) {
                foreach ($dtlaporan_row->children as $child_row) {
                    $pemakaian[$arr_parent][]       = $child_row->pemakaian;
                    $day_date                       = $child_row->day_date;
                    $arr_day_date[$arr_parent][]    = $child_row->day_date;
                    $month_date                     = $child_row->month_date;
                }
            } else {
                $arr_day_date[$arr_parent][]    = '';
            }
            if (isset($dtlaporan_row->children2)) {
                foreach ($dtlaporan_row->children2 as $child_row2) {
                    $dtl_a_total_pemakaian[$arr_parent][]    = $child_row2->total_pemakaian;
                }
            }
            if (isset($dtlaporan_row->children3)) {
                foreach ($dtlaporan_row->children3 as $child_row3) {
                    $dtl_a_total_grand_pemakaian[]    = $child_row3->total_grand_pemakaian;
                }
            }
            if (isset($dtlaporan_row->children4)) {
                foreach ($dtlaporan_row->children4 as $child_row4) {
                    $dtl_a_pemakaian_akumulatif[]    = $child_row4->pemakaian_akumulatif;
                }
            }
            if (isset($dtlaporan_row->children5)) {
                foreach ($dtlaporan_row->children5 as $child_row5) {
                    $dtl_a_pemakaian_akumulatif_per_jenis[]    = $child_row5->pemakaian_akumulatif_per_jenis;
                }
            }
            if (isset($dtlaporan_row->children6)) {
                foreach ($dtlaporan_row->children6 as $child_row6) {
                    $dtl_a_pemakaian_akumulatif_seluruhan    = $child_row6->pemakaian_akumulatif_seluruhan;
                }
            }
        }
        if (isset($date_calender)) {
            foreach ($date_calender as $dtlaporan_date_row) {
                $date[] = $dtlaporan_date_row->date;
            }
        }
        // style
        $PTStyle                    = new PHPExcel_Style();
        $headerStyle                = new PHPExcel_Style();
        $headerStyleLeft            = new PHPExcel_Style();
        $headerStyleRight            = new PHPExcel_Style();
        $headerStyleLeftTop         = new PHPExcel_Style();
        $headerStyleRightTop        = new PHPExcel_Style();
        $headerStyleLeftBottomTop   = new PHPExcel_Style();
        $headerStyleRightBottomTop  = new PHPExcel_Style();
        $DetailheaderStyle          = new PHPExcel_Style();
        $bodyStyle                  = new PHPExcel_Style();
        $bodyStyleAlignLeft         = new PHPExcel_Style();
        $noborderStyle              = new PHPExcel_Style();
        $noborderStyleBold          = new PHPExcel_Style();
        $noborderStyleAlignRight    = new PHPExcel_Style();
        $noborderStyleUnderline    = new PHPExcel_Style();
        $bodyStyleLeft              = new PHPExcel_Style();
        $bodyStyleRight             = new PHPExcel_Style();
        $footerStyleLeftbottom      = new PHPExcel_Style();
        $footerStyleRightbottom     = new PHPExcel_Style();

        $PTStyle->applyFromArray($this->xls->PT_STYLE);
        $headerStyle->applyFromArray($this->xls->headerStyle);
        $headerStyleLeft->applyFromArray($this->xls->headerStyleLeft);
        $headerStyleRight->applyFromArray($this->xls->headerStyleRight);
        $headerStyleLeftTop->applyFromArray($this->xls->headerStyleLeftTop);
        $headerStyleRightTop->applyFromArray($this->xls->headerStyleRightTop);
        $headerStyleLeftBottomTop->applyFromArray($this->xls->headerStyleLeftBottomTop);
        $headerStyleRightBottomTop->applyFromArray($this->xls->headerStyleRightBottomTop);
        $DetailheaderStyle->applyFromArray($this->xls->DetailheaderStyle);
        $bodyStyle->applyFromArray($this->xls->bodyStyle);
        $bodyStyleAlignLeft->applyFromArray($this->xls->bodyStyleAlignLeft);
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
        $rangeCol = "BT";
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
        $count1 = 1;
        $jml_data_perpage = $count1 + 5;
        if ($count1 < $jml_data_perpage) {
            $jml_page = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page = $count1 / $jml_data_perpage;
            } else {
                $jml_page = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }

        $jml_row_perpage  = 100;

        

        $bulan = $month_date;
        if ($bulan == 1) {
            $NamaBulan = "JANUARI";
        } else if ($bulan == 2) {
            $NamaBulan = "FEBRUARI";
        } else if ($bulan == 3) {
            $NamaBulan = "MARET";
        } else if ($bulan == 4) {
            $NamaBulan = "APRIL";
        } else if ($bulan == 5) {
            $NamaBulan = "MEI";
        } else if ($bulan == 6) {
            $NamaBulan = "JUNI";
        } else if ($bulan == 7) {
            $NamaBulan = "JULI";
        } else if ($bulan == 8) {
            $NamaBulan = "AGUSTUS";
        } else if ($bulan == 9) {
            $NamaBulan = "SEPTEMBER";
        } else if ($bulan == 10) {
            $NamaBulan = "OKTOBER";
        } else if ($bulan == 11) {
            $NamaBulan = "NOVEMBER";
        } else if ($bulan == 12) {
            $NamaBulan = "DESEMBER";
        }

        

        // $number = 0;
        for ($i1 = 0; $i1 < $jml_page; $i1++) {

            $start_row = ($i1 * $jml_row_perpage) + 1;
            $finish_row = ((($i1 * $jml_row_perpage) + 1) + ($jml_row_perpage));

            $start_detail = ($i1 * $jml_data_perpage);
            $finish_detail = (($i1 * $jml_data_perpage) + ($jml_data_perpage - 1));

            $lastday = $day_date;
            $awal = ["K","M","O","Q","S","U","W","Y","AA","AC","AE","AG","AI","AK","AM","AO","AQ","AS","AU","AW","AY","BA","BC","BE","BG","BI","BK","BM","BO","BQ","BS","BU"];
            $akhir =["L","N","P","R","T","V","X","Z","AB","AD","AF","AH","AJ","AL","AN","AP","AR","AT","AV","AX","AZ","BB","BD","BF","BH","BJ","BL","BN","BP","BR","BT","BV"];


            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/PSG_logo_2022.png');
            $gbr->setWidthAndHeight(45, 45);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('B' . $start_row);


            $objPHPExcel->mergeCells('A' .  $start_row . ':D' . ($start_row + 1));
            $objPHPExcel->mergeCells('E' .  $start_row . ':BV' . ($start_row + 1))->setCellValue('E' . $start_row,  $this->frmcop);

            $objPHPExcel->mergeCells('A' . ($start_row + 2) . ':D' . ($start_row + 2))->setCellValue('A' . ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' . ($start_row + 2) . ':BV' . ($start_row + 2))->setCellValue('E' . ($start_row + 2), $this->frmjdl);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' . $start_row . ':D' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':BV' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':BV' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':BS' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':BV' . ($start_row + 2));
            $objPHPExcel->getStyle('BX' . ($start_row) . ':BV' . ($start_row))->getFont()->setSize(10);

            $objPHPExcel->mergeCells('A' . ($start_row + 3) . ':A' . ($start_row + 4))->setCellValue('A' . ($start_row + 3), 'No.');
            $objPHPExcel->mergeCells('B' . ($start_row + 3) . ':D' . ($start_row + 4))->setCellValue('B' . ($start_row + 3), 'Jenis Air');
            $objPHPExcel->mergeCells('E' . ($start_row + 3) . ':J' . ($start_row + 3))->setCellValue('E' . ($start_row + 3), $NamaBulan);
            $objPHPExcel->mergeCells('E' . ($start_row + 4) . ':J' . ($start_row + 4))->setCellValue('E' . ($start_row + 4), 'Departemen Pemakaian');
         
            for ($i = 1; $i <= $lastday; $i++) { 
                $objPHPExcel->mergeCells($awal[$i - 1] . ($start_row + 3) . ':'.$akhir[$i - 1] . ($start_row + 4))->setCellValue($awal[$i - 1] . ($start_row + 3),  $i);
            } 
            $objPHPExcel->mergeCells($awal[$i - 1] . ($start_row + 3) . ':'.$akhir[$i - 1] . ($start_row + 4))->setCellValue($awal[$i - 1] . ($start_row + 3),  'Akumulatif');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row + 3) . ':BV' . ($start_row + 4));

            $detail = $start_row + 5;
            for ($arr = 0; $arr < count($dtdetail_lap); $arr++) { 
                
                 if($nama_jenis_air[$arr] == 'ACF'){
                    $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $detail . ':BV' . ($detail + 1));
                    $objPHPExcel->mergeCells('A' . ($detail) . ':A' . ($detail))->setCellValue('A' . ($detail), $number[$arr]);
                    if ($no_urut[$arr] == 1) {
                        $objPHPExcel->mergeCells('B' . ($detail) . ':D' . (($detail) + ($no_urut_desc[$arr] - 1)))->setCellValue('B' . ($detail), $nama_jenis_air[$arr]);
                    }

                    $objPHPExcel->mergeCells('E' . ($detail) . ':J' . ($detail))->setCellValue('E' . ($detail), $nama_flow[$arr]);

                    for ($arr2 = 0; $arr2 < $day_date; $arr2++) {
                        $objPHPExcel->mergeCells($awal[$arr2] . ($detail) . ':'.$akhir[$arr2] . ($detail))->setCellValue($awal[$arr2] . ($detail),  isset($pemakaian[$arr][$arr2]) ? $pemakaian[$arr][$arr2] : 0);
                    }

                    $objPHPExcel->mergeCells($awal[$arr2] . ($detail) . ':'.$akhir[$arr2] . ($detail))->setCellValue($awal[$arr2] . ($detail), isset($dtl_a_pemakaian_akumulatif[$arr]) ? $dtl_a_pemakaian_akumulatif[$arr] : 0);
                    
                    if ($no_urut_desc[$arr] == 1) {
                        $objPHPExcel->mergeCells('A' . ($detail + 1) . ':J' . ($detail + 1))->setCellValue('A' . ($detail + 1), 'Total '.$nama_jenis_air[$arr]);
                        
                        for ($arr2 = 0; $arr2 < $day_date; $arr2++) {
                            $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 1) . ':'.$akhir[$arr2] . ($detail + 1))->setCellValue($awal[$arr2] . ($detail + 1),  isset($dtl_a_total_pemakaian[$arr][$arr2]) ? $dtl_a_total_pemakaian[$arr][$arr2] : 0);
                        }
                        $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 1) . ':'.$akhir[$arr2] . ($detail + 1))->setCellValue($awal[$arr2] . ($detail + 1),  isset($dtl_a_pemakaian_akumulatif_per_jenis[$arr]) ? $dtl_a_pemakaian_akumulatif_per_jenis[$arr] : 0 );
                        
                        $objPHPExcel->getStyle('A' . ($detail + 1) . ':BV' . ($detail + 1))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99')))); 
                    }
                }
                if($nama_jenis_air[$arr] == 'ASF'){
                    $objPHPExcel->setSharedStyle($bodyStyle, 'A' . ($detail + 1) . ':BV' . ($detail + 2));
                    $objPHPExcel->mergeCells('A' . ($detail + 1) . ':A' . ($detail + 1))->setCellValue('A' . ($detail + 1), $number[$arr]);
                    if ($no_urut[$arr] == 1) {
                        $objPHPExcel->mergeCells('B' . ($detail + 1) . ':D' . (($detail + 1) + ($no_urut_desc[$arr] - 1)))->setCellValue('B' . ($detail + 1), $nama_jenis_air[$arr + 1]);
                    }

                    $objPHPExcel->mergeCells('E' . ($detail + 1) . ':J' . ($detail + 1))->setCellValue('E' . ($detail + 1), $nama_flow[$arr]);

                    for ($arr2 = 0; $arr2 < $day_date; $arr2++) {
                        $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 1) . ':'.$akhir[$arr2] . ($detail + 1))->setCellValue($awal[$arr2] . ($detail + 1),  isset($pemakaian[$arr][$arr2]) ? $pemakaian[$arr][$arr2] : 0);
                    }

                    $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 1) . ':'.$akhir[$arr2] . ($detail + 1))->setCellValue($awal[$arr2] . ($detail + 1), isset($dtl_a_pemakaian_akumulatif[$arr]) ? $dtl_a_pemakaian_akumulatif[$arr] : 0);
                    
                    if ($no_urut_desc[$arr] == 1) {
                        $objPHPExcel->mergeCells('A' . ($detail + 2) . ':J' . ($detail + 2))->setCellValue('A' . ($detail + 2), 'Total '.$nama_jenis_air[$arr]);
                        
                        for ($arr2 = 0; $arr2 < $day_date; $arr2++) {
                            $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 2) . ':'.$akhir[$arr2] . ($detail + 2))->setCellValue($awal[$arr2] . ($detail + 2),  isset($dtl_a_total_pemakaian[$arr][$arr2]) ? $dtl_a_total_pemakaian[$arr][$arr2] : 0);
                        }
                        $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 2) . ':'.$akhir[$arr2] . ($detail + 2))->setCellValue($awal[$arr2] . ($detail + 2),  isset($dtl_a_pemakaian_akumulatif_per_jenis[$arr]) ? $dtl_a_pemakaian_akumulatif_per_jenis[$arr] : 0 );
                       
                        $objPHPExcel->getStyle('A' . ($detail + 2) . ':BV' . ($detail + 2))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99')))); 
                    }
                }
                if($nama_jenis_air[$arr] == 'AST'){
                    $objPHPExcel->setSharedStyle($bodyStyle, 'A' . ($detail + 2) . ':BV' . ($detail + 3));
                    $objPHPExcel->mergeCells('A' . ($detail + 2) . ':A' . ($detail + 2))->setCellValue('A' . ($detail + 2), $number[$arr]);
                    if ($no_urut[$arr] == 1) {
                        $objPHPExcel->mergeCells('B' . ($detail + 2) . ':D' . (($detail + 2) + ($no_urut_desc[$arr] - 1)))->setCellValue('B' . ($detail + 2), $nama_jenis_air[$arr + 2]);
                    }

                    $objPHPExcel->mergeCells('E' . ($detail + 2) . ':J' . ($detail + 2))->setCellValue('E' . ($detail + 2), $nama_flow[$arr]);

                    for ($arr2 = 0; $arr2 < $day_date; $arr2++) {
                        $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 2) . ':'.$akhir[$arr2] . ($detail + 2))->setCellValue($awal[$arr2] . ($detail + 2),  isset($pemakaian[$arr][$arr2]) ? $pemakaian[$arr][$arr2] : 0);
                    }

                    $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 2) . ':'.$akhir[$arr2] . ($detail + 2))->setCellValue($awal[$arr2] . ($detail + 2), isset($dtl_a_pemakaian_akumulatif[$arr]) ? $dtl_a_pemakaian_akumulatif[$arr] : 0);
                    
                    if ($no_urut_desc[$arr] == 1) {
                        $objPHPExcel->mergeCells('A' . ($detail + 3) . ':J' . ($detail + 3))->setCellValue('A' . ($detail + 3), 'Total '.$nama_jenis_air[$arr]);
                        
                        for ($arr2 = 0; $arr2 < $day_date; $arr2++) {
                            $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 3) . ':'.$akhir[$arr2] . ($detail + 3))->setCellValue($awal[$arr2] . ($detail + 3),  isset($dtl_a_total_pemakaian[$arr][$arr2]) ? $dtl_a_total_pemakaian[$arr][$arr2] : 0);
                        }
                        $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 3) . ':'.$akhir[$arr2] . ($detail + 3))->setCellValue($awal[$arr2] . ($detail + 3),  isset($dtl_a_pemakaian_akumulatif_per_jenis[$arr]) ? $dtl_a_pemakaian_akumulatif_per_jenis[$arr] : 0 );
                       
                        $objPHPExcel->getStyle('A' . ($detail + 3) . ':BV' . ($detail + 3))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99')))); 
                    }
                }
                if($nama_jenis_air[$arr] == 'RO'){
                    $objPHPExcel->setSharedStyle($bodyStyle, 'A' . ($detail + 3) . ':BV' . ($detail + 4));
                    $objPHPExcel->mergeCells('A' . ($detail + 3) . ':A' . ($detail + 3))->setCellValue('A' . ($detail + 3), $number[$arr]);
                    if ($no_urut[$arr] == 1) {
                        $objPHPExcel->mergeCells('B' . ($detail + 3) . ':D' . (($detail + 3) + ($no_urut_desc[$arr] - 1)))->setCellValue('B' . ($detail + 3), $nama_jenis_air[$arr + 3]);
                    }

                    $objPHPExcel->mergeCells('E' . ($detail + 3) . ':J' . ($detail + 3))->setCellValue('E' . ($detail + 3), $nama_flow[$arr]);

                    for ($arr2 = 0; $arr2 < $day_date; $arr2++) {
                        $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 3) . ':'.$akhir[$arr2] . ($detail + 3))->setCellValue($awal[$arr2] . ($detail + 3),  isset($pemakaian[$arr][$arr2]) ? $pemakaian[$arr][$arr2] : 0);
                    }

                    $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 3) . ':'.$akhir[$arr2] . ($detail + 3))->setCellValue($awal[$arr2] . ($detail + 3), isset($dtl_a_pemakaian_akumulatif[$arr]) ? $dtl_a_pemakaian_akumulatif[$arr] : 0);
                    
                    if ($no_urut_desc[$arr] == 1) {
                        $objPHPExcel->mergeCells('A' . ($detail + 4) . ':J' . ($detail + 4))->setCellValue('A' . ($detail + 4), 'Total '.$nama_jenis_air[$arr]);
                        
                        for ($arr2 = 0; $arr2 < $day_date; $arr2++) {
                            $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 4) . ':'.$akhir[$arr2] . ($detail + 4))->setCellValue($awal[$arr2] . ($detail + 4),  isset($dtl_a_total_pemakaian[$arr][$arr2]) ? $dtl_a_total_pemakaian[$arr][$arr2] : 0);
                        }
                        $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 4) . ':'.$akhir[$arr2] . ($detail + 4))->setCellValue($awal[$arr2] . ($detail + 4),  isset($dtl_a_pemakaian_akumulatif_per_jenis[$arr]) ? $dtl_a_pemakaian_akumulatif_per_jenis[$arr] : 0 );
                        $objPHPExcel->getStyle('A' . ($detail + 4) . ':BV' . ($detail + 4))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99'))));
                    }
                }
                if($nama_jenis_air[$arr] == 'UF'){
                    $objPHPExcel->setSharedStyle($bodyStyle, 'A' . ($detail + 4) . ':BV' . ($detail + 5));
                    $objPHPExcel->mergeCells('A' . ($detail + 4) . ':A' . ($detail + 4))->setCellValue('A' . ($detail + 4), $number[$arr]);
                    if ($no_urut[$arr] == 1) {
                        $objPHPExcel->mergeCells('B' . ($detail + 4) . ':D' . (($detail + 4) + ($no_urut_desc[$arr] - 1)))->setCellValue('B' . ($detail + 4), $nama_jenis_air[$arr]);
                    }

                    $objPHPExcel->mergeCells('E' . ($detail + 4) . ':J' . ($detail + 4))->setCellValue('E' . ($detail + 4), $nama_flow[$arr]);

                    for ($arr2 = 0; $arr2 < $day_date; $arr2++) {
                        $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 4) . ':'.$akhir[$arr2] . ($detail + 4))->setCellValue($awal[$arr2] . ($detail + 4),  isset($pemakaian[$arr][$arr2]) ? $pemakaian[$arr][$arr2] : 0);
                    }

                    $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 4) . ':'.$akhir[$arr2] . ($detail + 4))->setCellValue($awal[$arr2] . ($detail + 4), isset($dtl_a_pemakaian_akumulatif[$arr]) ? $dtl_a_pemakaian_akumulatif[$arr] : 0);
                    
                    if ($no_urut_desc[$arr] == 1) {
                        $objPHPExcel->mergeCells('A' . ($detail + 5) . ':J' . ($detail + 5))->setCellValue('A' . ($detail + 5), 'Total '.$nama_jenis_air[$arr]);
                        
                        for ($arr2 = 0; $arr2 < $day_date; $arr2++) {
                            $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 5) . ':'.$akhir[$arr2] . ($detail + 5))->setCellValue($awal[$arr2] . ($detail + 5),  isset($dtl_a_total_pemakaian[$arr][$arr2]) ? $dtl_a_total_pemakaian[$arr][$arr2] : 0);
                        }
                        $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 5) . ':'.$akhir[$arr2] . ($detail + 5))->setCellValue($awal[$arr2] . ($detail + 5),  isset($dtl_a_pemakaian_akumulatif_per_jenis[$arr]) ? $dtl_a_pemakaian_akumulatif_per_jenis[$arr] : 0 );
                        $objPHPExcel->getStyle('A' . ($detail + 5) . ':BV' . ($detail + 5))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99'))));
                    }
                }
                
                
                // $objPHPExcel->getStyle('B' . ($detail) . ':D' . ($detail + 5))->getAlignment()->setTextRotation(90)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getStyle('B' . ($detail) . ':J' . ($detail + 5))->getFont()->setBold(true);
                $objPHPExcel->getStyle('B' . ($detail) . ':D' . ($detail + 5))->getFont()->setSize(12);
                $detail++;
            }
            
            //Grand Total
            $objPHPExcel->setSharedStyle($bodyStyle, 'A' . ($detail + 5) . ':BV' . ($detail + 5));
            $objPHPExcel->mergeCells('A' . ($detail + 5) . ':J' . ($detail + 5))->setCellValue('A' . ($detail + 5), 'Grand Total');
            for ($arr2 = 0; $arr2 < $day_date; $arr2++) {
                $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 5) . ':'.$akhir[$arr2] . ($detail + 5))->setCellValue($awal[$arr2] . ($detail + 5), isset($dtl_a_total_grand_pemakaian[$arr2]) ? $dtl_a_total_grand_pemakaian[$arr2] : 0);   
            }
            $objPHPExcel->mergeCells($awal[$arr2] . ($detail + 5) . ':'.$akhir[$arr2] . ($detail + 5))->setCellValue($awal[$arr2] . ($detail + 5),  isset($dtl_a_pemakaian_akumulatif_seluruhan) ? $dtl_a_pemakaian_akumulatif_seluruhan : 0 );
            $objPHPExcel->getStyle('A' . ($detail + 5) . ':BV' . ($detail + 5))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0fd4ff'))));
            
            $start_row3 = $detail + 6;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':BE' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':BE' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('BF' . ($start_row3 + 1) . ':BV' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('BF' . ($start_row3 + 1) . ':BV' . ($start_row3 + 1))->setCellValue('BF' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':BE' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'BF' . ($start_row3 + 1) . ':BV' . ($start_row3 + 1));
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
