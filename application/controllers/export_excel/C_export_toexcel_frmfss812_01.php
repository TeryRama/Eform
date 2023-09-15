<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_frmfss812_01 extends CI_Controller
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
        $this->BagianAkses   = $session_data['bagian_akses'];
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

        $dtheader = $this->M_formfrmfss812_01->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date          = $dtheaderrow->create_date; //2021-02-08

            $create_date            = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno                  = $dtheaderrow->docno;
            $rev                    = $dtheaderrow->rev;
            $gugus                  = $dtheaderrow->gugus;
            $jns_mesin              = $dtheaderrow->jns_mesin;
            $deptabbr               = $dtheaderrow->deptabbr;
            $id_jns_mesin           = $dtheaderrow->id_jns_mesin;
            $id_gugus               = $dtheaderrow->id_gugus;

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
        //end Get dtheader

        $list_pj            = $this->M_forminput->get_list_pj($dtcreate_date, $this->frmnm);
        $dtkomponenmesin    = $this->M_formfrmfss812_01->get_all_komponenmesin($this->BagianAkses);
        $dtjenis_mesin      = $this->M_formfrmfss812_01->get_jenis_mesin_by($deptabbr, $dtcreate_date);
        $dtgugus            = $this->M_formfrmfss812_01->get_gugus_by($deptabbr, $id_jns_mesin, $dtcreate_date);
        $dtitem_mesin       = $this->M_formfrmfss812_01->get_itemmesin($deptabbr, $id_jns_mesin, $id_gugus, $dtcreate_date);
        if ($this->cekLevelUserNm == 'Auditor') {
            $dtdetail   = $this->M_formfrmfss812_01->get_detail_byidx($this->header_id);
        } else {
            $dtdetail   = $this->M_formfrmfss812_01->get_detail_byid($this->header_id);
        }

        foreach ($dtitem_mesin as $dtitem_mesin_row) {
            $part_komponen = explode(",", $dtitem_mesin_row->part_komponen);
        }
        //detail a
        if(isset($dtdetail)){
            $no = 1;
            foreach ($dtdetail as $dtdetail_row) {
                $arr_number[]               = $no++;
                $arr_nama_mesin[]           = trim ($dtdetail_row->nama_mesin);
                $arr_kode_mesin[]           = trim ($dtdetail_row->kode_mesin);
                $arr_frekuensi[]            = trim ($dtdetail_row->frekuensi);
                $arr_pj_nama[]              = trim ($dtdetail_row->pj_nama);
                $arr_pj_personalstatus[]    = trim ($dtdetail_row->pj_personalstatus);
                $arr_pj_personalid[]        = trim ($dtdetail_row->pj_personalid);
                $arr_jam_operasi[]          = trim ($dtdetail_row->jam_operasi);
                $arr_ket[]                  = trim ($dtdetail_row->ket);

                for ($i_komponen=1; $i_komponen <= count($part_komponen); $i_komponen++) {
                    ${'arr_komponen'.$i_komponen}[] = $dtdetail_row->{'komponen'.$i_komponen};
                }
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
        $DiagonalBorder             = new PHPExcel_Style();

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
        $DiagonalBorder->applyFromArray($this->xls->DiagonalBorder);
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

        $jml_row_perpage  = ($jml_data_perpage)+22;

        // $jml_page = max($jml_page_a);

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
            $objPHPExcel->mergeCells('E' .  $start_row . ':AL' . ($start_row + 2))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AM' . $start_row . ':AN' . $start_row)->setCellValue('AM' . $start_row, 'DOK');
            $objPHPExcel->mergeCells('AO' . $start_row . ':AS' . $start_row)->setCellValue('AO' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('AM' . ($start_row + 1) . ':AN' . ($start_row + 1))->setCellValue('AM' . ($start_row + 1), 'Rev');
            $objPHPExcel->mergeCells('AO' . ($start_row + 1) . ':AS' . ($start_row + 1))->setCellValue('AO' . ($start_row + 1), ': ' . $rev);

            $objPHPExcel->mergeCells('AM' . ($start_row + 2) . ':AN' . ($start_row + 2))->setCellValue('AM' . ($start_row + 2), 'Tanggal');
            $objPHPExcel->mergeCells('AO' . ($start_row + 2) . ':AS' . ($start_row + 2))->setCellValue('AO' . ($start_row + 2), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' . ($start_row + 3) . ':D' . ($start_row + 3))->setCellValue('A' . ($start_row + 3), 'JUDUL');
            $objPHPExcel->mergeCells('E' . ($start_row + 3) . ':AL' . ($start_row + 3))->setCellValue('E' . ($start_row + 3), $this->frmjdl);

            $objPHPExcel->mergeCells('AM' . ($start_row + 3) . ':AN' . ($start_row + 3))->setCellValue('AM' . ($start_row + 3), 'HLM');
            $objPHPExcel->mergeCells('AO' . ($start_row + 3) . ':AS' . ($start_row + 3))->setCellValue('AO' . ($start_row + 3), ': ' . ($i1 + 1) . ' of ' . ($jml_page_a));

            $objPHPExcel->setSharedStyle($headerStyle,   'A' . $start_row . ':D' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row) . ':AL' . ($start_row + 3));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AM' . ($start_row) . ':AS' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AO' . $start_row  . ':AS' . ($start_row + 3));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AM' . ($start_row + 2) . ':AS' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AO' . ($start_row + 2) . ':AS' . ($start_row + 3));

            
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':AL' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyleBold, 'B' . ($start_row+4) . ':AL' . ($start_row + 4));
            
            $objPHPExcel->mergeCells('A' . ($start_row + 4) . ':AL' . ($start_row + 4))->setCellValue('A' . ($start_row + 4), ' JENIS MESIN : ' . $jns_mesin);
            $objPHPExcel->mergeCells('AM' . ($start_row + 4) . ':AS' . ($start_row + 4))->setCellValue('AM' . ($start_row + 4), ' GUGUS : ' . $gugus);

            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A' . ($start_row + 4) . ':A' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($noborderStyleBold, 'B' . ($start_row + 4) . ':AR' . ($start_row + 12));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AS' . ($start_row + 4) . ':AS' . ($start_row + 12));

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row + 6) . ':AR' . ($start_row + 12));

            $objPHPExcel->mergeCells('A' . ($start_row + 6) . ':A' . ($start_row + 12))->setCellValue('A' . ($start_row + 6), 'No.');
            $objPHPExcel->mergeCells('B' . ($start_row + 6) . ':H' . ($start_row + 12))->setCellValue('B' . ($start_row + 6), 'NAMA MESIN');
            $objPHPExcel->mergeCells('I' . ($start_row + 6) . ':K' . ($start_row + 6))->setCellValue('I' . ($start_row + 6), 'BAGIAN');
            $objPHPExcel->mergeCells('I' . ($start_row + 7) . ':K' . ($start_row + 11))->setCellValue('I' . ($start_row + 7), '');
            $objPHPExcel->mergeCells('I' . ($start_row + 12) . ':K' . ($start_row + 12))->setCellValue('I' . ($start_row + 12), 'CODE');
            $objPHPExcel->mergeCells('L' . ($start_row + 6) . ':N' . ($start_row + 12))->setCellValue('L' . ($start_row + 6), 'FREKUENSI');

            $objPHPExcel->setSharedStyle($DiagonalBorder, 'I' . ($start_row + 7)  . ':K' . ($start_row + 11));
            $objPHPExcel->getStyle('I' . ($start_row + 6) . ':K' . ($start_row + 6))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $objPHPExcel->getStyle('I' . ($start_row + 6) . ':K' . ($start_row + 6))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getStyle('I' . ($start_row + 12) . ':K' . ($start_row + 12))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
            $objPHPExcel->getStyle('I' . ($start_row + 12) . ':K' . ($start_row + 12))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            $col_komponen = 'N';
            foreach ($dtkomponenmesin as $dtkomponenmesin_row) {
                foreach ($part_komponen as $part_komponen_row) {
                    if($dtkomponenmesin_row->komponen_id == $part_komponen_row){
                        $col_komponen++;
                        $objPHPExcel->mergeCells($col_komponen . ($start_row + 6) . ':' . $col_komponen.($start_row + 12))->setCellValue($col_komponen . ($start_row + 6), $dtkomponenmesin_row->nama_komponen);
                        $objPHPExcel->getStyle($col_komponen . ($start_row + 6) . ':' . $col_komponen . ($start_row + 12))->getAlignment()->setTextRotation(90)->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
                    }
                }
            }
            $objPHPExcel->mergeCells('AB' . ($start_row + 6) . ':AB'. ($start_row + 12))->setCellValue('AB' . ($start_row + 6), 'Jam Operasi');
            $objPHPExcel->getStyle('AB' . ($start_row + 6) . ':AB' . ($start_row + 12))->getAlignment()->setTextRotation(90)->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
            
            $objPHPExcel->mergeCells('AC' . ($start_row + 6) . ':AL'. ($start_row + 8))->setCellValue('AC' . ($start_row + 6), 'INSPEKTUR');
            $objPHPExcel->mergeCells('AC' . ($start_row + 9) . ':AG'. ($start_row + 12))->setCellValue('AC' . ($start_row + 9), 'NAMA');
            $objPHPExcel->mergeCells('AH' . ($start_row + 9) . ':AL'. ($start_row + 12))->setCellValue('AH' . ($start_row + 9), 'PARAF');
            $objPHPExcel->mergeCells('AM' . ($start_row + 6) . ':AR'. ($start_row + 12))->setCellValue('AM' . ($start_row + 6), "KETERANGAN");


            $dtl_row = $start_row + 12;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {
                $dtl_row++;
                // $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(28);
                if(isset($arr_number[$arr])){
                    $dt_number[$arr] = $arr_number[$arr];
                }else{
                    $dt_number[$arr] = "";
                }
                if(isset($arr_nama_mesin[$arr])){
                    $dt_nama_mesin[$arr] = $arr_nama_mesin[$arr];
                }else{
                    $dt_nama_mesin[$arr] = "";
                }
                if(isset($arr_kode_mesin[$arr])){
                    $dt_kode_mesin[$arr] = $arr_kode_mesin[$arr];
                }else{
                    $dt_kode_mesin[$arr] = "";
                }
                if(isset($arr_frekuensi[$arr])){
                    $dt_frekuensi[$arr] = $arr_frekuensi[$arr];
                }else{
                    $dt_frekuensi[$arr] = "";
                }
                if(isset($arr_ket[$arr])){
                    $dt_ket[$arr] = $arr_ket[$arr];
                }else{
                    $dt_ket[$arr] = "";
                }
                if(isset($arr_pj_nama[$arr])){
                    $dt_pj_nama[$arr] = $arr_pj_nama[$arr];
                }else{
                    $dt_pj_nama[$arr] = "";
                }
                if(isset($arr_pj_personalstatus[$arr])){
                    $dt_pj_personalstatus[$arr] = $arr_pj_personalstatus[$arr];
                }else{
                    $dt_pj_personalstatus[$arr] = "";
                }
                if(isset($arr_pj_personalid[$arr])){
                    $dt_pj_personalid[$arr] = $arr_pj_personalid[$arr];
                }else{
                    $dt_pj_personalid[$arr] = "";
                }
                if(isset($arr_jam_operasi[$arr])){
                    $dt_jam_operasi[$arr] = $arr_jam_operasi[$arr];
                }else{
                    $dt_jam_operasi[$arr] = "";
                }
                
                for ($i_komponen=1; $i_komponen <= count($part_komponen); $i_komponen++) {
                    if(isset(${'arr_komponen'.$i_komponen}[$arr])){
                        ${'dt_komponen'.$i_komponen}[$arr] = ${'arr_komponen'.$i_komponen}[$arr];
                    }else{
                        ${'dt_komponen'.$i_komponen}[$arr] = "";
                    }
                }
                $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($dtl_row) . ':AR' . ($dtl_row));
                $objPHPExcel->setSharedStyle($headerStyleRight, 'AS' . ($dtl_row) . ':AS' . ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . ($dtl_row) . ':AR' . ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'B' . ($dtl_row) . ':E' . ($dtl_row));

                $objPHPExcel->mergeCells('A' . ($dtl_row) . ':A' . ($dtl_row))->setCellValue('A' . ($dtl_row), $dt_number[$arr]);
                $objPHPExcel->mergeCells('B' . ($dtl_row) . ':H' . ($dtl_row))->setCellValue('B' . ($dtl_row), $dt_nama_mesin[$arr]);
                $objPHPExcel->mergeCells('I' . ($dtl_row) . ':K' . ($dtl_row))->setCellValue('I' . ($dtl_row), $dt_kode_mesin[$arr]);
                $objPHPExcel->mergeCells('L' . ($dtl_row) . ':N' . ($dtl_row))->setCellValue('L' . ($dtl_row), $dt_frekuensi[$arr]);
                $col_komponen = 'N';
                for ($i_komponen=1; $i_komponen <= count($part_komponen); $i_komponen++) {
                    $col_komponen++;
                    if(${'dt_komponen'.$i_komponen}[$arr]=='NA'){
                        $objPHPExcel->mergeCells($col_komponen . ($dtl_row) . ':' . $col_komponen.($dtl_row))->setCellValue($col_komponen . ($dtl_row), "NA");
                    }elseif(${'dt_komponen'.$i_komponen}[$arr]=='0'){
                        $objPHPExcel->mergeCells($col_komponen . ($dtl_row) . ':' . $col_komponen.($dtl_row))->setCellValue($col_komponen . ($dtl_row), "✔");
                    }elseif(${'dt_komponen'.$i_komponen}[$arr]=='1'){
                        $objPHPExcel->mergeCells($col_komponen . ($dtl_row) . ':' . $col_komponen.($dtl_row))->setCellValue($col_komponen . ($dtl_row), "✖");
                    }elseif(${'dt_komponen'.$i_komponen}[$arr]=='2'){
                        $objPHPExcel->mergeCells($col_komponen . ($dtl_row) . ':' . $col_komponen.($dtl_row))->setCellValue($col_komponen . ($dtl_row), "Δ");
                    }else{
                        $objPHPExcel->mergeCells($col_komponen . ($dtl_row) . ':' . $col_komponen.($dtl_row))->setCellValue($col_komponen . ($dtl_row), "");
                    }
                }
                $objPHPExcel->mergeCells('AB' . ($dtl_row) . ':AB' . ($dtl_row))->setCellValue('AB' . ($dtl_row), $dt_jam_operasi[$arr]);
                $objPHPExcel->mergeCells('AC' . ($dtl_row) . ':AG' . ($dtl_row))->setCellValue('AC' . ($dtl_row), $dt_pj_nama[$arr]);
                $objPHPExcel->mergeCells('AH' . ($dtl_row) . ':AL' . ($dtl_row))->setCellValue('AH' . ($dtl_row), '');

                if ($dt_pj_personalstatus[$arr] == '2') {
                    $imageurlapp1 = '/forviewfoto_pekerja/TTD_TK/';
                    $imageformatapp1 = '.png';
                } else if ($dt_pj_personalstatus[$arr] == '1') {
                    $imageurlapp1 = '/forviewfoto_pekerja/';
                    $imageformatapp1 = '_0_0.png';
                } else {
                    $imageurlapp1 = '';
                    $imageformatapp1 = '';
                }

                $fcpath2   = str_replace('utl/', '', FCPATH);

                $sign_img  = '$objDrawing' . $i1;
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $dt_pj_personalstatus[$arr] . '_' . $dt_pj_personalid[$arr] . '.png')) {
                    $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(50);
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $dt_pj_personalstatus[$arr] . '_' . $dt_pj_personalid[$arr] . '.png');
                    $sign_img->setWidthAndHeight(100, 100);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AI' . ($dtl_row))->setOffsetY(2)->setOffsetX(-3);
                } else {
                    if ($dt_pj_personalid[$arr] != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $dt_pj_personalid[$arr] . $imageformatapp1)) {
                        $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(50);
                        $sign_img = new PHPExcel_Worksheet_Drawing();
                        $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $dt_pj_personalid[$arr] . $imageformatapp1);
                        $sign_img->setWidthAndHeight(100, 100);
                        $sign_img->setResizeProportional(true);
                        $sign_img->setWorksheet($objPHPExcel);
                        $sign_img->setCoordinates('AI' . ($dtl_row))->setOffsetY(3)->setOffsetX(-3);
                    }else if(!empty($dt_pj_personalid[$arr])){
                        $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(45);
                        $sign_img = new PHPExcel_Worksheet_Drawing();
                        $sign_img->setPath('assets/images/approved.png');
                        $sign_img->setWidthAndHeight(70, 70);
                        $sign_img->setResizeProportional(true);
                        $sign_img->setWorksheet($objPHPExcel);
                        $sign_img->setCoordinates('AI' . ($dtl_row))->setOffsetY(3)->setOffsetX(4);
                    }
                }
                $objPHPExcel->mergeCells('AM' . ($dtl_row) . ':AR' . ($dtl_row))->setCellValue('AM' . ($dtl_row), $dt_ket[$arr]);
            }
            $app_row = $dtl_row + 2;

            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A' . ($app_row - 1) . ':A' . ($app_row - 1));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row - 1) . ':AR' . ($app_row - 1));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AS' . ($app_row - 1) . ':AS' . ($app_row - 1));

            $objPHPExcel->mergeCells('B' . ($app_row) . ':G' . ($app_row))->setCellValue('B' . ($app_row), 'Di Isi Dengan :');
            $objPHPExcel->mergeCells('C' . ($app_row+1) . ':C' . ($app_row+1))->setCellValue('C' . ($app_row+1), 'NA');
            $objPHPExcel->mergeCells('D' . ($app_row+1) . ':J' . ($app_row+1))->setCellValue('D' . ($app_row+1), ': Not Applicable');
            $objPHPExcel->mergeCells('C' . ($app_row+2) . ':C' . ($app_row+2))->setCellValue('C' . ($app_row+2), '✔');
            $objPHPExcel->mergeCells('D' . ($app_row+2) . ':J' . ($app_row+2))->setCellValue('D' . ($app_row+2), ': Normal');
            $objPHPExcel->mergeCells('C' . ($app_row+3) . ':C' . ($app_row+3))->setCellValue('C' . ($app_row+3), 'Δ');
            $objPHPExcel->mergeCells('D' . ($app_row+3) . ':J' . ($app_row+3))->setCellValue('D' . ($app_row+3), ': Ada Masalah Langsung Action');
            $objPHPExcel->mergeCells('C' . ($app_row+4) . ':C' . ($app_row+4))->setCellValue('C' . ($app_row+4), '✖');
            $objPHPExcel->mergeCells('D' . ($app_row+4) . ':J' . ($app_row+4))->setCellValue('D' . ($app_row+4), ': Ada Masalah Tertunda');

            $objPHPExcel->mergeCells('AC' . ($app_row) . ':AJ' . ($app_row))->setCellValue('AC' . ($app_row), 'Dilaporkan Oleh,');
            $objPHPExcel->mergeCells('AK' . ($app_row) . ':AR' . ($app_row))->setCellValue('AK' . ($app_row), 'Disetujui Oleh,');

            $objPHPExcel->mergeCells('AC' . ($app_row + 1) . ':AJ' . ($app_row + 3))->setCellValue('AC' . ($app_row + 1), '');
            $objPHPExcel->mergeCells('AK' . ($app_row + 1) . ':AR' . ($app_row + 3))->setCellValue('AK' . ($app_row + 1), '');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AC' . ($app_row) . ':AR' . ($app_row + 3));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AS' . ($app_row) . ':AS' . ($app_row + 3));


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
                    $sign_img->setCoordinates('AE' . ($app_row + 1));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AE' . ($app_row + 1));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AE' . ($app_row + 1));
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
                    $sign_img2->setCoordinates('AM' . ($app_row + 1));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('AM' . ($app_row + 1));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AM' . ($app_row + 1));
                }
            }


            $objPHPExcel->mergeCells('AC' . ($app_row + 4) . ':AD' . ($app_row + 4))->setCellValue('AC' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('AE' . ($app_row + 4) . ':AJ' . ($app_row + 4))->setCellValue('AE' . ($app_row + 4), ': ' . $app1_by);
            $objPHPExcel->mergeCells('AC' . ($app_row + 5) . ':AD' . ($app_row + 5))->setCellValue('AC' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('AE' . ($app_row + 5) . ':AJ' . ($app_row + 5))->setCellValue('AE' . ($app_row + 5), ': ' . $app1_position);
            $objPHPExcel->mergeCells('AC' . ($app_row + 6) . ':AD' . ($app_row + 6))->setCellValue('AC' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('AE' . ($app_row + 6) . ':AJ' . ($app_row + 6))->setCellValue('AE' . ($app_row + 6), ': ' . $app1date);

            $objPHPExcel->mergeCells('AK' . ($app_row + 4) . ':AL' . ($app_row + 4))->setCellValue('AK' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('AM' . ($app_row + 4) . ':AR' . ($app_row + 4))->setCellValue('AM' . ($app_row + 4), ': ' . $app2_by);
            $objPHPExcel->mergeCells('AK' . ($app_row + 5) . ':AL' . ($app_row + 5))->setCellValue('AK' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('AM' . ($app_row + 5) . ':AR' . ($app_row + 5))->setCellValue('AM' . ($app_row + 5), ': ' . $app2_position);
            $objPHPExcel->mergeCells('AK' . ($app_row + 6) . ':AL' . ($app_row + 6))->setCellValue('AK' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('AM' . ($app_row + 6) . ':AR' . ($app_row + 6))->setCellValue('AM' . ($app_row + 6), ': ' . $app2date);

            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A' . ($app_row) . ':A' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row) . ':AB' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($noborderStyle, 'AC' . ($app_row + 4) . ':AR' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AC' . ($app_row + 4) . ':AC' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AK' . ($app_row + 4) . ':AK' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AR' . ($app_row + 4) . ':AR' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AS' . ($app_row + 4) . ':AS' . ($app_row + 6));

            $foot_row = $app_row + 6;
            $objPHPExcel->mergeCells('A' . ($foot_row + 1) . ':H' . ($foot_row + 1))->setCellValue('A' . ($foot_row + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($foot_row + 1) . ':H' . ($foot_row + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('I' . ($foot_row + 1) . ':AS' . ($foot_row + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('I' . ($foot_row + 1) . ':AS' . ($foot_row + 1))->setCellValue('I' . ($foot_row + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($foot_row + 1) . ':H' . ($foot_row + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'I' . ($foot_row + 1) . ':AS' . ($foot_row + 1));
            $objPHPExcel->setBreak('A' . ($foot_row + 1),  PHPExcel_Worksheet::BREAK_ROW);
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
