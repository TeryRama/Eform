<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_intwtd016_04 extends CI_Controller
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

        $dtheader = $this->M_formintwtd016_04->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date          = $dtheaderrow->create_date; //2021-02-08

            $create_date            = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno                  = $dtheaderrow->docno;
            $rev                    = $dtheaderrow->rev;
            $periode                = explode("-", $dtheaderrow->periode);
            $bulan                  = $periode[0];
            $tahun                  = $periode[1];

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

        $date_calender = $this->M_formintwtd016_04->get_date_calender($bulan, $tahun);
        if ($this->cekLevelUserNm == 'Auditor') {
            $dtdetail   = $this->M_formintwtd016_04->get_detail_byidx($this->header_id);
            $dtdetail_b = $this->M_formintwtd016_04->get_dtfrmfss188x_by($bulan, $tahun, $dtcreate_date, $this->header_id);
        } else {
            $dtdetail   = $this->M_formintwtd016_04->get_detail_byid($this->header_id);
            $dtdetail_b = $this->M_formintwtd016_04->get_dtfrmfss188_by($bulan, $tahun, $dtcreate_date, $this->header_id);
        }

        //detail a
        if(isset($dtdetail)){
            $no = 1;
            foreach ($dtdetail as $dtdetail_row) {
                $nomor[]                    = $no++;
                $dtl_a_shift[]              = trim ($dtdetail_row->shift);
                $dtl_a_jam[]                = trim ($dtdetail_row->jam);
                $dtl_a_tanggal[]            = trim (date('d-m-Y',strtotime($dtdetail_row4->tanggal)) == '01-01-1970' ? NULL : date('d-m-Y',strtotime($dtdetail_row4->tanggal)));
                $dtl_a_uraian[]             = trim ($dtdetail_row->uraian);
                $dtl_a_tindakan[]           = trim ($dtdetail_row->tindakan);
                $dtl_a_pj_nama[]            = trim ($dtdetail_row->pj_nama);
                $dtl_a_pj_personalstatus[]  = trim ($dtdetail_row->pj_personalstatus);
                $dtl_a_pj_personalid[]      = trim ($dtdetail_row->pj_personalid);
                $dtl_a_paraf[]              = trim ($dtdetail_row->paraf);
                $dtl_a_keterangan[]         = trim ($dtdetail_row->keterangan);   
            }
        }
        //end detail a
        //detail b
        if(isset($dtdetail_b)){
            $no = 1;
            $parent = -1;
            foreach ($dtdetail_b as $dtdetail_b_row) { 
                $parent++;
                $arr_number[]         = $dtdetail_b_row->no_urut == 1 ? $no++ : "";
                $arr_no_urut[]         = $dtdetail_b_row->no_urut;
                $arr_no_urut_desc[]    = $dtdetail_b_row->no_urut_desc;
                $arr_v_point[]         = $dtdetail_b_row->v_point;
                $arr_v_kode[]          = $dtdetail_b_row->v_kode;
                $arr_frequency[]       = $dtdetail_b_row->frequency;
                $arr_v_pic[]           = $dtdetail_b_row->v_pic;
                $arr_ket[]             = $dtdetail_b_row->ket;

                if(isset($dtdetail_b_row->children)){
                    $child_no_parent = -1;
                    $jml_child = count($dtdetail_b_row->children);
                    foreach ($dtdetail_b_row->children as $child_row) {
                        $child_no_parent++;
                        $jml_child2 = count($child_row->children2);
                        if(isset($child_row->children2)){
                            foreach ($child_row->children2 as $child2_row) {
                                $arr_ach[$parent][$child_no_parent][] = $child2_row->gagal_lulus;
                            }
                        }
                        if(isset($child_row->children3)){
                            foreach ($child_row->children3 as $child3_row) {
                                if($child3_row->tgl_schedule != NULL){
                                    $tgl_schedule = explode(',',$child3_row->tgl_schedule);
                                    foreach ($tgl_schedule as $tgl_schedule_row) {
                                        if($tgl_schedule_row == $child_row->date){
                                            $arr_sch[$parent][$child_no_parent][] = 1;
                                        }
                                    }
                                }
                            } 
                        }
                    }
                }
            } 
        }
        
        //end detail b

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
        $jml_data_perpage = 4;
        if ($count1 < $jml_data_perpage) {
            $jml_page_a = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page_a = $count1 / $jml_data_perpage;
            } else {
                $jml_page_a = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }
        //tabel a
        $count2 = count($dtdetail_b);
        $jml_data_perpage_b = 17;
        if ($count2 < $jml_data_perpage_b) {
            $jml_page_b = 1;
        } else {
            if (($count2 % $jml_data_perpage_b) == 0) {
                $jml_page_b = $count2 / $jml_data_perpage_b;
            } else {
                $jml_page_b = floor(($count2 / $jml_data_perpage_b)) + 1;
            }
        }

        $jml_row_perpage  = ($jml_data_perpage + $jml_data_perpage_b)+35;

        $jml_page = max($jml_page_a, $jml_page_b);

        for ($i1 = 0; $i1 < $jml_page; $i1++) {

            $start_row = ($i1 * $jml_row_perpage) + 1;
            $finish_row = ((($i1 * $jml_row_perpage) + 1) + ($jml_row_perpage));

            $start_detail = ($i1 * $jml_data_perpage);
            $finish_detail = (($i1 * $jml_data_perpage) + ($jml_data_perpage - 1));

            $start_detail_b = ($i1 * $jml_data_perpage_b);
            $finish_detail_b = (($i1 * $jml_data_perpage_b) + ($jml_data_perpage_b - 1));


            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/PSG_logo_2022.png');
            $gbr->setWidthAndHeight(60, 60);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('B' . $start_row);


            $objPHPExcel->mergeCells('A' .  $start_row . ':D' . ($start_row + 2));
            $objPHPExcel->mergeCells('E' .  $start_row . ':AT' . ($start_row + 2))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AU' . $start_row . ':AV' . $start_row)->setCellValue('AU' . $start_row, 'DOK');
            $objPHPExcel->mergeCells('AW' . $start_row . ':BA' . $start_row)->setCellValue('AW' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('AU' . ($start_row + 1) . ':AV' . ($start_row + 1))->setCellValue('AU' . ($start_row + 1), 'Rev');
            $objPHPExcel->mergeCells('AW' . ($start_row + 1) . ':BA' . ($start_row + 1))->setCellValue('AW' . ($start_row + 1), ': ' . $rev);

            $objPHPExcel->mergeCells('AU' . ($start_row + 2) . ':AV' . ($start_row + 2))->setCellValue('AU' . ($start_row + 2), 'Tanggal');
            $objPHPExcel->mergeCells('AW' . ($start_row + 2) . ':BA' . ($start_row + 2))->setCellValue('AW' . ($start_row + 2), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' . ($start_row + 3) . ':D' . ($start_row + 3))->setCellValue('A' . ($start_row + 3), 'JUDUL');
            $objPHPExcel->mergeCells('E' . ($start_row + 3) . ':AT' . ($start_row + 3))->setCellValue('E' . ($start_row + 3), $this->frmjdl);

            $objPHPExcel->mergeCells('AU' . ($start_row + 3) . ':AV' . ($start_row + 3))->setCellValue('AU' . ($start_row + 3), 'HLM');
            $objPHPExcel->mergeCells('AW' . ($start_row + 3) . ':BA' . ($start_row + 3))->setCellValue('AW' . ($start_row + 3), ': ' . ($i1 + 1) . ' of ' . ($jml_page));

            $objPHPExcel->setSharedStyle($headerStyle,   'A' . $start_row . ':D' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row) . ':AT' . ($start_row + 3));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AU' . ($start_row) . ':BA' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AW' . $start_row  . ':BA' . ($start_row + 3));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AU' . ($start_row + 2) . ':BA' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AW' . ($start_row + 2) . ':BA' . ($start_row + 3));

            
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':AT' . ($start_row + 3));
            
            $objPHPExcel->mergeCells('A' . ($start_row + 4) . ':AT' . ($start_row + 4))->setCellValue('A' . ($start_row + 4), 'PERIODE : '. $NamaBulan . ' ' . $tahun);

            $objPHPExcel->setSharedStyle($headerStyleLeftTop, 'A' . ($start_row + 4) . ':A' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($noborderStyleBold, 'B' . ($start_row + 4) . ':AY' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BA' . ($start_row + 4) . ':BA' . ($start_row + 4));


            $objPHPExcel->mergeCells('A' . ($start_row + 5) . ':A' . ($start_row + 6))->setCellValue('A' . ($start_row + 5), 'No.');
            $objPHPExcel->mergeCells('B' . ($start_row + 5) . ':E' . ($start_row + 6))->setCellValue('B' . ($start_row + 5), 'N A M A');
            $objPHPExcel->mergeCells('F' . ($start_row + 5) . ':H' . ($start_row + 6))->setCellValue('F' . ($start_row + 5), 'KODE');
            $objPHPExcel->mergeCells('I' . ($start_row + 5) . ':K' . ($start_row + 6))->setCellValue('I' . ($start_row + 5), 'FREQUENCY');
            $objPHPExcel->mergeCells('L' . ($start_row + 5) . ':M' . ($start_row + 6))->setCellValue('L' . ($start_row + 5), 'PIC');
            $objPHPExcel->mergeCells('N' . ($start_row + 5) . ':O' . ($start_row + 6))->setCellValue('N' . ($start_row + 5), "SCH\nACT");
            
            $objPHPExcel->mergeCells('P' . ($start_row + 5) . ':AT' . ($start_row + 5))->setCellValue('P' . ($start_row + 5), "TANGGAL");
            $a1 = 'O';
            foreach ($date_calender as $date_calender_row) {
                $a1++;
                $objPHPExcel->mergeCells($a1 . ($start_row + 6) . ':'. $a1 . ($start_row + 6))->setCellValue($a1 . ($start_row + 6), $date_calender_row->day);
            }
            $objPHPExcel->mergeCells('AU' . ($start_row + 5) . ':BA' . ($start_row + 6))->setCellValue('AU' . ($start_row + 5), "KETERANGAN");

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row + 5) . ':BA' . ($start_row + 6));

            $col_tgl = ['P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT'];

            $dtl_row = $start_row + 6;
            $no = 1;
            $rowspan_b = -1; 
            for ($arr = $start_detail_b; $arr <= $finish_detail_b; $arr++) {
                $dtl_row++;
                $rowspan_b++;
                // $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(28);
                if(isset($arr_number[$arr])){
                    $dt_number[$arr] = $arr_number[$arr];
                }else{
                    $dt_number[$arr] = "";
                }
                if(isset($arr_no_urut[$arr])){
                    $dt_no_urut[$arr] = $arr_no_urut[$arr];
                }else{
                    $dt_no_urut[$arr] = "";
                }
                if(isset($arr_no_urut_desc[$arr])){
                    $dt_no_urut_desc[$arr] = ($arr_no_urut_desc[$arr]-1)*2;
                }else{
                    $dt_no_urut_desc[$arr] = "";
                }
                if(isset($arr_v_point[$arr])){
                    $dt_v_point[$arr] = $arr_v_point[$arr];
                }else{
                    $dt_v_point[$arr] = "";
                }
                if(isset($arr_v_kode[$arr])){
                    $dt_v_kode[$arr] = $arr_v_kode[$arr];
                }else{
                    $dt_v_kode[$arr] = "";
                }
                if(isset($arr_frequency[$arr])){
                    $dt_frequency[$arr] = $arr_frequency[$arr];
                }else{
                    $dt_frequency[$arr] = "";
                }
                if(isset($arr_v_pic[$arr])){
                    $dt_v_pic[$arr] = $arr_v_pic[$arr];
                }else{
                    $dt_v_pic[$arr] = "";
                }
                if(isset($arr_ket[$arr])){
                    $dt_ket[$arr] = $arr_ket[$arr];
                }else{
                    $dt_ket[$arr] = "";
                }

                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . (($dtl_row + ($rowspan_b * 1))) . ':BA' . (($dtl_row + (($rowspan_b * 1) + 1))));
                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'B' . (($dtl_row + ($rowspan_b * 1))) . ':E' . (($dtl_row + (($rowspan_b * 1) + 1))));
                
                if(isset($arr_v_point[$arr])){
                    if($dt_no_urut[$arr] == 1){
                        $objPHPExcel->mergeCells('A' . ($dtl_row + ($rowspan_b * 1)) . ':A' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('A' . ($dtl_row + ($rowspan_b * 1)), $dt_number[$arr]);
                        $objPHPExcel->mergeCells('B' . ($dtl_row + ($rowspan_b * 1)) . ':E' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('B' . ($dtl_row + ($rowspan_b * 1)), $dt_v_point[$arr]);
                    }else{
                        $objPHPExcel->mergeCells('A' . ($dtl_row + ($rowspan_b * 1)) . ':A' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('A' . ($dtl_row + ($rowspan_b * 1)), "");
                        $objPHPExcel->mergeCells('B' . ($dtl_row + ($rowspan_b * 1)) . ':E' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('B' . ($dtl_row + ($rowspan_b * 1)), "");
                    }
                    $objPHPExcel->mergeCells('F' . ($dtl_row + ($rowspan_b * 1)) . ':H' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('F' . ($dtl_row + ($rowspan_b * 1)), $dt_v_kode[$arr]);
                    $objPHPExcel->mergeCells('I' . ($dtl_row + ($rowspan_b * 1)) . ':K' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('I' . ($dtl_row + ($rowspan_b * 1)), $dt_frequency[$arr]);
                    $objPHPExcel->mergeCells('L' . ($dtl_row + ($rowspan_b * 1)) . ':M' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('L' . ($dtl_row + ($rowspan_b * 1)), $dt_v_pic[$arr]);

                    $objPHPExcel->mergeCells('N' . ($dtl_row + ($rowspan_b * 1)) . ':O' . ($dtl_row + ($rowspan_b * 1)))->setCellValue('N' . ($dtl_row + ($rowspan_b * 1)), "SCH");
                    $objPHPExcel->mergeCells('N' . ($dtl_row + ($rowspan_b * 1) + 1) . ':O' . ($dtl_row + ($rowspan_b * 1) + 1))->setCellValue('N' . ($dtl_row + ($rowspan_b * 1) + 1), "ACT");

                    for ($arr2=0; $arr2 < count($date_calender); $arr2++) {
                        if(isset($arr_sch[$arr][$arr2])){
                            if($arr_sch[$arr][$arr2][0] == 1){
                                $objPHPExcel->getStyle($col_tgl[$arr2] . ($dtl_row + ($rowspan_b * 1)) . ':' . $col_tgl[$arr2] . ($dtl_row + ($rowspan_b * 1)))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '4dffff'))));
                            }else{
                                $objPHPExcel->mergeCells($col_tgl[$arr2] . ($dtl_row + ($rowspan_b * 1)) . ':'. $col_tgl[$arr2] . ($dtl_row + ($rowspan_b * 1)))->setCellValue($col_tgl[$arr2] . ($dtl_row + ($rowspan_b * 1)), "");
                            }
                        }else{
                            $objPHPExcel->mergeCells($col_tgl[$arr2] . ($dtl_row + ($rowspan_b * 1)) . ':'. $col_tgl[$arr2] . ($dtl_row + ($rowspan_b * 1)))->setCellValue($col_tgl[$arr2] . ($dtl_row + ($rowspan_b * 1)), "");
                        }
                        if(isset($arr_ach[$arr][$arr2])){
                            if($arr_ach[$arr][$arr2][0] == 'Lulus'){
                                $objPHPExcel->mergeCells($col_tgl[$arr2] . ($dtl_row + (($rowspan_b * 1) + 1)) . ':'. $col_tgl[$arr2] . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue($col_tgl[$arr2] . ($dtl_row + (($rowspan_b * 1) + 1)), "✔");
                            }else{
                                $objPHPExcel->mergeCells($col_tgl[$arr2] . ($dtl_row + (($rowspan_b * 1) + 1)) . ':'. $col_tgl[$arr2] . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue($col_tgl[$arr2] . ($dtl_row + (($rowspan_b * 1) + 1)), "");
                            }
                        }else{
                            $objPHPExcel->mergeCells($col_tgl[$arr2] . ($dtl_row + (($rowspan_b * 1) + 1)) . ':'. $col_tgl[$arr2] . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue($col_tgl[$arr2] . ($dtl_row + (($rowspan_b * 1) + 1)), "");
                        }
                    }
    
                    $objPHPExcel->mergeCells('AU' . ($dtl_row + ($rowspan_b * 1)) . ':BA' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('AU' . ($dtl_row + ($rowspan_b * 1)), $dt_ket[$arr]);
                }else{
                    $objPHPExcel->mergeCells('A' . ($dtl_row + ($rowspan_b * 1)) . ':A' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('A' . ($dtl_row + ($rowspan_b * 1)), "");
                    $objPHPExcel->mergeCells('B' . ($dtl_row + ($rowspan_b * 1)) . ':E' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('B' . ($dtl_row + ($rowspan_b * 1)), "");
                    $objPHPExcel->mergeCells('F' . ($dtl_row + ($rowspan_b * 1)) . ':H' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('F' . ($dtl_row + ($rowspan_b * 1)), "");
                    $objPHPExcel->mergeCells('I' . ($dtl_row + ($rowspan_b * 1)) . ':K' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('I' . ($dtl_row + ($rowspan_b * 1)), "");
                    $objPHPExcel->mergeCells('L' . ($dtl_row + ($rowspan_b * 1)) . ':M' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('L' . ($dtl_row + ($rowspan_b * 1)), "");
                    $objPHPExcel->mergeCells('N' . ($dtl_row + ($rowspan_b * 1)) . ':O' . ($dtl_row + ($rowspan_b * 1)))->setCellValue('N' . ($dtl_row + ($rowspan_b * 1)), "");
                    $objPHPExcel->mergeCells('N' . ($dtl_row + ($rowspan_b * 1) + 1) . ':O' . ($dtl_row + ($rowspan_b * 1) + 1))->setCellValue('N' . ($dtl_row + ($rowspan_b * 1) + 1), "");
                    for ($arr2=0; $arr2 < count($date_calender); $arr2++) {
                        $objPHPExcel->mergeCells($col_tgl[$arr2] . ($dtl_row + ($rowspan_b * 1)) . ':'. $col_tgl[$arr2] . ($dtl_row + ($rowspan_b * 1)))->setCellValue($col_tgl[$arr2] . ($dtl_row + ($rowspan_b * 1)), "");
                        $objPHPExcel->mergeCells($col_tgl[$arr2] . ($dtl_row + (($rowspan_b * 1) + 1)) . ':'. $col_tgl[$arr2] . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue($col_tgl[$arr2] . ($dtl_row + (($rowspan_b * 1) + 1)), "");
                    }
                    $objPHPExcel->mergeCells('AU' . ($dtl_row + ($rowspan_b * 1)) . ':BA' . ($dtl_row + (($rowspan_b * 1) + 1)))->setCellValue('AU' . ($dtl_row + ($rowspan_b * 1)), $dt_ket[$arr]);
                }
            }
            $row2 = (($dtl_row + (($rowspan_b * 1) + 3)));
            
            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A' . ($row2 - 1) . ':A' . ($row2 - 1));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($row2 - 1) . ':AY' . ($row2 - 1));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BA' . ($row2 - 1) . ':BA' . ($row2 - 1));

            $objPHPExcel->mergeCells('A' . ($row2) . ':E' . ($row2))->setCellValue('A' . ($row2), 'TANGGAL');
            $objPHPExcel->mergeCells('F' . ($row2) . ':T' . ($row2))->setCellValue('F' . ($row2), 'KETIDAK SESUAIAN');
            $objPHPExcel->mergeCells('U' . ($row2) . ':AE' . ($row2))->setCellValue('U' . ($row2), 'PENYEBAB');
            $objPHPExcel->mergeCells('AF' . ($row2) . ':AL' . ($row2))->setCellValue('AF' . ($row2), 'NAMA');
            $objPHPExcel->mergeCells('AM' . ($row2) . ':AR' . ($row2))->setCellValue('AM' . ($row2), 'PARAF');
            $objPHPExcel->mergeCells('AS' . ($row2) . ':BA' . ($row2))->setCellValue('AS' . ($row2), 'KETERANGAN');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($row2) . ':BA' . ($row2));
            $dtl_row2 = $row2;

            for ($d = $start_detail; $d <= $finish_detail; $d++) {
                $dtl_row2++;
                // $objPHPExcel->getRowDimension($dtl_row2)->setRowHeight(25);
                $dt_tanggal           [$d]  = $dtl_a_tanggal[$d]                ?? "";
                $dt_jam               [$d]  = $dtl_a_jam[$d]                ?? "";
                $dt_uraian            [$d]  = $dtl_a_uraian[$d]             ?? "";
                $dt_tindakan          [$d]  = $dtl_a_tindakan[$d]           ?? "";
                $dt_pj_nama           [$d]  = $dtl_a_pj_nama[$d]            ?? "";
                $dt_pj_personalstatus [$d]  = $dtl_a_pj_personalstatus[$d]  ?? "";
                $dt_pj_personalid     [$d]  = $dtl_a_pj_personalid[$d]      ?? "";
                $dt_paraf             [$d]  = $dtl_a_paraf[$d]              ?? "";
                $dt_keterangan        [$d]  = $dtl_a_keterangan[$d]         ?? "";

                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $dtl_row2 . ':BA' . $dtl_row2); // TABEL BODY (DETAIL)
                
                $objPHPExcel->mergeCells('A' . ($dtl_row2) . ':E' . ($dtl_row2))->setCellValue('A' . ($dtl_row2), $dt_tanggal[$d]);
                $objPHPExcel->mergeCells('F' . ($dtl_row2) . ':T' . ($dtl_row2))->setCellValue('F' . ($dtl_row2), $dt_jam[$d]);
                $objPHPExcel->mergeCells('U' . ($dtl_row2) . ':AE' . ($dtl_row2))->setCellValue('U' . ($dtl_row2), $dt_tindakan[$d]);
                $objPHPExcel->mergeCells('AF' . ($dtl_row2) . ':AL' . ($dtl_row2))->setCellValue('AF' . ($dtl_row2), $dt_pj_nama[$d]);
                $objPHPExcel->mergeCells('AM' . ($dtl_row2) . ':AR' . ($dtl_row2))->setCellValue('AM' . ($dtl_row2), '');
                $objPHPExcel->mergeCells('AS' . ($dtl_row2) . ':BA' . ($dtl_row2))->setCellValue('AS' . ($dtl_row2), $dt_keterangan[$d]);

                if ($dt_pj_personalstatus[$d] == '2') {
                    $imageurlapp1 = '/forviewfoto_pekerja/TTD_TK/';
                    $imageformatapp1 = '.png';
                } else if ($dt_pj_personalstatus[$d] == '1') {
                    $imageurlapp1 = '/forviewfoto_pekerja/';
                    $imageformatapp1 = '_0_0.png';
                } else {
                    $imageurlapp1 = '';
                    $imageformatapp1 = '';
                }

                $fcpath2   = str_replace('utl/', '', FCPATH);

                $sign_img  = '$objDrawing' . $i1;
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $dt_pj_personalstatus[$d] . '_' . $dt_pj_personalid[$d] . '.png')) {
                    $objPHPExcel->getRowDimension($dtl_row2)->setRowHeight(50);
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $dt_pj_personalstatus[$d] . '_' . $dt_pj_personalid[$d] . '.png');
                    $sign_img->setWidthAndHeight(100, 100);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AM' . ($dtl_row2))->setOffsetY(2)->setOffsetX(-3);
                } else {
                    if ($dt_pj_personalid[$d] != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $dt_pj_personalid[$d] . $imageformatapp1)) {
                        $objPHPExcel->getRowDimension($dtl_row2)->setRowHeight(50);
                        $sign_img = new PHPExcel_Worksheet_Drawing();
                        $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $dt_pj_personalid[$d] . $imageformatapp1);
                        $sign_img->setWidthAndHeight(100, 100);
                        $sign_img->setResizeProportional(true);
                        $sign_img->setWorksheet($objPHPExcel);
                        $sign_img->setCoordinates('AM' . ($dtl_row2))->setOffsetY(3)->setOffsetX(-3);
                    }
                }
            }
            $app_row = $dtl_row2 + 2;

            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A' . ($app_row - 1) . ':A' . ($app_row - 1));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row - 1) . ':AY' . ($app_row - 1));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BA' . ($app_row - 1) . ':BA' . ($app_row - 1));

            $objPHPExcel->mergeCells('A' . ($app_row) . ':H' . ($app_row))->setCellValue('A' . ($app_row), 'Dibuat Oleh,');
            $objPHPExcel->mergeCells('I' . ($app_row) . ':P' . ($app_row))->setCellValue('I' . ($app_row), 'Diketahui Oleh,');
            $objPHPExcel->mergeCells('Q' . ($app_row) . ':X' . ($app_row))->setCellValue('Q' . ($app_row), 'Disetujui Oleh,');

            $objPHPExcel->mergeCells('A' . ($app_row + 1) . ':H' . ($app_row + 3))->setCellValue('A' . ($app_row + 1), '');
            $objPHPExcel->mergeCells('I' . ($app_row + 1) . ':P' . ($app_row + 3))->setCellValue('I' . ($app_row + 1), '');
            $objPHPExcel->mergeCells('Q' . ($app_row + 1) . ':X' . ($app_row + 3))->setCellValue('Q' . ($app_row + 1), '');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($app_row) . ':X' . ($app_row + 3));


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
                    $sign_img->setCoordinates('B' . ($app_row + 1));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('B' . ($app_row + 1));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('B' . ($app_row + 1));
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
                    $sign_img2->setCoordinates('J' . ($app_row + 1));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('J' . ($app_row + 1));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('J' . ($app_row + 1));
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
                if (file_exists($fcpath2 . 'assets/ttd/' . $app3_personalstatus . '_' . $app3_personalid . '.png')) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath('assets/ttd/' . $app3_personalstatus . '_' . $app3_personalid . '.png');
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('R' . ($app_row + 1));
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('R' . ($app_row + 1));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('R' . ($app_row + 1));
                }
            }


            $objPHPExcel->mergeCells('A' . ($app_row + 4) . ':B' . ($app_row + 4))->setCellValue('A' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('C' . ($app_row + 4) . ':H' . ($app_row + 4))->setCellValue('C' . ($app_row + 4), ': ' . $app1_by);
            $objPHPExcel->mergeCells('A' . ($app_row + 5) . ':B' . ($app_row + 5))->setCellValue('A' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('C' . ($app_row + 5) . ':H' . ($app_row + 5))->setCellValue('C' . ($app_row + 5), ': ' . $app1_position);
            $objPHPExcel->mergeCells('A' . ($app_row + 6) . ':B' . ($app_row + 6))->setCellValue('A' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('C' . ($app_row + 6) . ':H' . ($app_row + 6))->setCellValue('C' . ($app_row + 6), ': ' . $app1date);

            $objPHPExcel->mergeCells('I' . ($app_row + 4) . ':J' . ($app_row + 4))->setCellValue('I' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('K' . ($app_row + 4) . ':P' . ($app_row + 4))->setCellValue('K' . ($app_row + 4), ': ' . $app2_by);
            $objPHPExcel->mergeCells('I' . ($app_row + 5) . ':J' . ($app_row + 5))->setCellValue('I' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('K' . ($app_row + 5) . ':P' . ($app_row + 5))->setCellValue('K' . ($app_row + 5), ': ' . $app2_position);
            $objPHPExcel->mergeCells('I' . ($app_row + 6) . ':J' . ($app_row + 6))->setCellValue('I' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('K' . ($app_row + 6) . ':P' . ($app_row + 6))->setCellValue('K' . ($app_row + 6), ': ' . $app2date);

            $objPHPExcel->mergeCells('Q' . ($app_row + 4) . ':R' . ($app_row + 4))->setCellValue('Q' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('S' . ($app_row + 4) . ':X' . ($app_row + 4))->setCellValue('S' . ($app_row + 4), ': ' . $app3_by);
            $objPHPExcel->mergeCells('Q' . ($app_row + 5) . ':R' . ($app_row + 5))->setCellValue('Q' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('S' . ($app_row + 5) . ':X' . ($app_row + 5))->setCellValue('S' . ($app_row + 5), ': ' . $app3_position);
            $objPHPExcel->mergeCells('Q' . ($app_row + 6) . ':R' . ($app_row + 6))->setCellValue('Q' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('S' . ($app_row + 6) . ':X' . ($app_row + 6))->setCellValue('S' . ($app_row + 6), ': ' . $app3date);

            $objPHPExcel->mergeCells('Z' . ($app_row + 1) . ':AB' . ($app_row + 1))->setCellValue('Z' . ($app_row + 1), 'Note :');
            $objPHPExcel->mergeCells('AA' . ($app_row + 2) . ':AZ' . ($app_row + 2))->setCellValue('AA' . ($app_row + 2), '- Sch harus dilaksanakan,jika tertunda/maju di tulis, alasan harus jelas, sesuai waktu pelaksanaannya');

            $objPHPExcel->setSharedStyle($noborderStyle, 'Y' . ($app_row) . ':AZ' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($app_row + 4) . ':X' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 4) . ':A' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'I' . ($app_row + 4) . ':I' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'Q' . ($app_row + 4) . ':Q' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'X' . ($app_row + 4) . ':X' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BA' . ($app_row) . ':BA' . ($app_row + 6));

            // $objPHPExcel->getStyle('AK' . ($app_row + 7) . ':CE' . ($app_row + 9))->getFont()->setBold(true);
            // $objPHPExcel->setSharedStyle($bodyStyleRight, 'CF' . ($app_row + 7) . ':CF' . ($app_row + 9));
            // $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AK' . ($app_row + 7) . ':AK' . ($app_row + 9));

            $start_row3 = $app_row + 6;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':H' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':H' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('I' . ($start_row3 + 1) . ':BA' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('I' . ($start_row3 + 1) . ':BA' . ($start_row3 + 1))->setCellValue('I' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':H' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'I' . ($start_row3 + 1) . ':BA' . ($start_row3 + 1));
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
