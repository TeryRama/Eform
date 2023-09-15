<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_frmfss065_03 extends CI_Controller
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

        $dtheader = $this->M_formfrmfss065_03->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date          = $dtheaderrow->create_date; //2021-02-08

            $create_date            = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno                  = $dtheaderrow->docno;
            $gugus                  = $dtheaderrow->gugus;
            $nama_mesin             = $dtheaderrow->nama_mesin;
            $deptabbr               = $dtheaderrow->deptabbr;
        }
        //end Get dtheader

        if ($this->cekLevelUserNm == 'Auditor') {
            $dtdetail   = $this->M_formfrmfss065_03->get_detail_byidx($this->header_id);
        } else {
            $dtdetail   = $this->M_formfrmfss065_03->get_detail_byid($this->header_id);
        }


        //detail a
        if(isset($dtdetail)){
            $no = 1;
            foreach ($dtdetail as $dtdetail_row) {
                $arr_number[]   = $no++;
                $arr_tanggal[]  = $dtdetail_row->tanggal;
                $arr_kategori[] = $dtdetail_row->kategori;
                $arr_tindakan[] = $dtdetail_row->tindakan;
                $arr_waktu[]    = $dtdetail_row->waktu;
                $arr_planned[]  = $dtdetail_row->planned;
            } 
        }
        
        //end detail a

        function getColRange($start_letter, $row_number, $count)
        {
            $range = array();
            $rangeCol = "DB";
            for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
                $range[] = $y;
            }
            $start_idx = array_search(
                $start_letter,
                $range
            );
            
            return sprintf(
                "%s%s:%s%s",
                $start_letter,
                $row_number,
                $range[$start_idx + $count],
                $row_number
            );
        }

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
            $objPHPExcel->getColumnDimension($columnID)->setWidth(3);
        }

        $objPHPExcel->getColumnDimension('AV')->setWidth(5);

        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(15);
        }
        //tabel a
        $count1 = count($dtdetail);
        $jml_data_perpage = 28;
        if ($count1 < $jml_data_perpage) {
            $jml_page_a = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page_a = $count1 / $jml_data_perpage;
            } else {
                $jml_page_a = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }

        $jml_row_perpage  = ($jml_data_perpage)+10;

        // $jml_page = max($jml_page_a);

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
            $objPHPExcel->mergeCells('E' .  $start_row . ':AT' . ($start_row + 1))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AU' . $start_row . ':AV' . $start_row)->setCellValue('AU' . $start_row, 'DOK');
            $objPHPExcel->mergeCells('AW' . $start_row . ':BA' . $start_row)->setCellValue('AW' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('AU' . ($start_row + 1) . ':AV' . ($start_row + 1))->setCellValue('AU' . ($start_row + 1), 'Tanggal');
            $objPHPExcel->mergeCells('AW' . ($start_row + 1) . ':BA' . ($start_row + 1))->setCellValue('AW' . ($start_row + 1), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' . ($start_row + 2) . ':D' . ($start_row + 2))->setCellValue('A' . ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' . ($start_row + 2) . ':AT' . ($start_row + 2))->setCellValue('E' . ($start_row + 2), $this->frmjdl);

            $objPHPExcel->mergeCells('AU' . ($start_row + 2) . ':AV' . ($start_row + 2))->setCellValue('AU' . ($start_row + 2), 'HLM');
            $objPHPExcel->mergeCells('AW' . ($start_row + 2) . ':BA' . ($start_row + 2))->setCellValue('AW' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . ($jml_page_a));

            $objPHPExcel->setSharedStyle($headerStyle,   'A' . $start_row . ':D' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row) . ':AT' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AU' . ($start_row) . ':BA' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AW' . $start_row  . ':BA' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AU' . ($start_row + 2) . ':BA' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AW' . ($start_row + 2) . ':BA' . ($start_row + 2));

            
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':AT' . ($start_row + 2));
            
            $objPHPExcel->mergeCells('A' . ($start_row + 4) . ':AQ' . ($start_row + 4))->setCellValue('A' . ($start_row + 4), ' NAMA MESIN : ' . $nama_mesin);
            $objPHPExcel->mergeCells('AR' . ($start_row + 4) . ':BA' . ($start_row + 4))->setCellValue('AR' . ($start_row + 4), ' GUGUS : ' . $gugus);
            $objPHPExcel->mergeCells('AR' . ($start_row + 5) . ':BA' . ($start_row + 5))->setCellValue('AR' . ($start_row + 5), ' DEPARTEMEN : ' . $deptabbr);

            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A' . ($start_row + 3) . ':A' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($noborderStyleBold, 'B' . ($start_row + 3) . ':AZ' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BA' . ($start_row + 3) . ':BA' . ($start_row + 5));

            $objPHPExcel->mergeCells('A' . ($start_row + 6) . ':D' . ($start_row + 7))->setCellValue('A' . ($start_row + 6), 'TANGGAL');
            $objPHPExcel->mergeCells('E' . ($start_row + 6) . ':V' . ($start_row + 7))->setCellValue('E' . ($start_row + 6), 'MEKANIK');
            $objPHPExcel->mergeCells('W' . ($start_row + 6) . ':AM' . ($start_row + 7))->setCellValue('W' . ($start_row + 6), 'LISTRIK');
            $objPHPExcel->mergeCells('AN' . ($start_row + 6) . ':AQ' . ($start_row + 7))->setCellValue('AN' . ($start_row + 6), 'WAKTU');
            $objPHPExcel->mergeCells('AR' . ($start_row + 6) . ':AV' . ($start_row + 7))->setCellValue('AR' . ($start_row + 6), 'UNPLANNED');
            $objPHPExcel->mergeCells('AW' . ($start_row + 6) . ':BA' . ($start_row + 7))->setCellValue('AW' . ($start_row + 6), 'PLANNED');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row + 6) . ':BA' . ($start_row + 7));

            $dtl_row = $start_row + 7;
            $no = 1;
            $rowspan_b = -1; 
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {
                $dtl_row++;
                $rowspan_b++;

                if(isset($arr_tanggal[$arr])){
                    $dt_tanggal[$arr] = $arr_tanggal[$arr];
                }else{
                    $dt_tanggal[$arr] = "";
                }

                if(isset($arr_kategori[$arr])){
                    $dt_kategori[$arr] = $arr_kategori[$arr];
                }else{
                    $dt_kategori[$arr] = "";
                }
                if(isset($arr_tindakan[$arr])){
                    $dt_tindakan[$arr] = $arr_tindakan[$arr];
                }else{
                    $dt_tindakan[$arr] = "";
                }
                
                if(isset($arr_waktu[$arr])){
                    $dt_waktu[$arr] = $arr_waktu[$arr];
                }else{
                    $dt_waktu[$arr] = "";
                }
                if(isset($arr_planned[$arr])){
                    $dt_planned[$arr] = $arr_planned[$arr];
                }else{
                    $dt_planned[$arr] = "";
                }

                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . ($dtl_row) . ':BA' . ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'E' . ($dtl_row) . ':AM' . ($dtl_row));

                $objPHPExcel->mergeCells('A' . ($dtl_row) . ':D' . ($dtl_row))->setCellValue('A' . ($dtl_row), $dt_tanggal[$arr]);
                $objPHPExcel->mergeCells('E' . ($dtl_row) . ':V' . ($dtl_row))->setCellValue('E' . ($dtl_row), $dt_kategori[$arr] == 'Mekanik' ? $dt_tindakan[$arr] : '');
                $objPHPExcel->mergeCells('W' . ($dtl_row) . ':AM' . ($dtl_row))->setCellValue('W' . ($dtl_row), $dt_kategori[$arr] == 'Listrik' ? $dt_tindakan[$arr] : '');
                $objPHPExcel->mergeCells('AN' . ($dtl_row) . ':AQ' . ($dtl_row))->setCellValue('AN' . ($dtl_row), $dt_waktu[$arr]);
                $objPHPExcel->mergeCells('AR' . ($dtl_row) . ':AV' . ($dtl_row))->setCellValue('AR' . ($dtl_row), $dt_planned[$arr] == 'Unplanned' ? '✓' : '');
                $objPHPExcel->mergeCells('AW' . ($dtl_row) . ':BA' . ($dtl_row))->setCellValue('AW' . ($dtl_row), $dt_planned[$arr] == 'Planned' ? '✓' : '');
            }
            $foot_row = $dtl_row + 1;
            $objPHPExcel->mergeCells('B' . ($foot_row) . ':F' . ($foot_row))->setCellValue('B' . ($foot_row), 'Keterangan :');
            $objPHPExcel->mergeCells('G' . ($foot_row) . ':AZ' . ($foot_row))->setCellValue('G' . ($foot_row), 'Unplanned : Perbaikan tidak Direncanakan');
            $objPHPExcel->mergeCells('G' . ($foot_row + 1) . ':AZ' . ($foot_row + 1))->setCellValue('G' . ($foot_row + 1), 'Planned : Perbaikan yang Direncanakan');

            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A' . ($foot_row) . ':A' . ($foot_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($foot_row) . ':AZ' . ($foot_row + 3));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BA' . ($foot_row) . ':BA' . ($foot_row + 3));


            $objPHPExcel->mergeCells('A' . ($foot_row + 3) . ':H' . ($foot_row + 3))->setCellValue('A' . ($foot_row + 3), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($foot_row + 3) . ':H' . ($foot_row + 3))->getFont()->setBold(true);
            $objPHPExcel->getStyle('I' . ($foot_row + 3) . ':BA' . ($foot_row + 3))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('I' . ($foot_row + 3) . ':BA' . ($foot_row + 3))->setCellValue('I' . ($foot_row + 3), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($foot_row + 3) . ':H' . ($foot_row + 3));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'I' . ($foot_row + 3) . ':BA' . ($foot_row + 3));
            $objPHPExcel->setBreak('A' . ($foot_row + 3),  PHPExcel_Worksheet::BREAK_ROW);
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
