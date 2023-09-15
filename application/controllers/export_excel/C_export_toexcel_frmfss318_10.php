<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_frmfss318_10 extends CI_Controller
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
        $frmkode = $this->uri->segment(4);
        $frmvrs = $this->uri->segment(5);
        $this->load->model(array('M_user', 'master/M_form', 'M_menu', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->library(array('table', 'form_validation', 'excel', 'fpdf'));
        $this->frmcop = $this->config->item("nama_perusahaan");
        $session_data = $this->session->userdata('logged_in');
        $dtheader['Titel'] = 'Home';
        $LevelUser = $session_data['leveluserid'];
        $UserName = $session_data['username'];
        $LevelUserNm = $session_data['levelusernm'];
        $this->cekLevelUserNm = substr($LevelUserNm, 0, 7);
        $this->model = $this->{'M_form' . $frmkode . '_' . $frmvrs};
        ///load  excel ////
        $this->xls = new exelstyles();
        $this->spreadsheet = new Excel();
        $this->sheet =  $this->spreadsheet->getActiveSheet();
        ///end load excel///
    }

    function exportxls()
    {
        // Get dtheader
        $frmkode                = $this->uri->segment(4);
        $frmvrs                 = $this->uri->segment(5);
        $this->header_id        = $this->uri->segment(6);
        $dtfrm                  = $this->M_forminput->get_dtform($frmkode, $frmvrs);
        foreach ($dtfrm as $datafrm) {
            $this->frmkd          = $datafrm->formkd;
            $this->frmjdl         = $datafrm->formjudul;
            $this->frmnm          = $datafrm->formnm;
            $this->frmver         = $datafrm->formversi;
            $this->frmefective    = date("d-m-Y", strtotime($datafrm->formefective));
        }
        $dtheader = $this->model->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date       = $dtheaderrow->create_date; //2021-02-08

            $create_date         = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno               = $dtheaderrow->docno;

            $app1_by             = $dtheaderrow->app1_by;
            $app2_by             = $dtheaderrow->app2_by;
            $app3_by             = $dtheaderrow->app3_by;
            $app4_by             = $dtheaderrow->app4_by;
            $app5_by             = $dtheaderrow->app5_by;
            $app6_by             = $dtheaderrow->app6_by;
            $app7_by             = $dtheaderrow->app7_by;
            $app8_by             = $dtheaderrow->app8_by;

            $app1_position       = $dtheaderrow->app1_position;
            $app2_position       = $dtheaderrow->app2_position;
            $app3_position       = $dtheaderrow->app3_position;
            $app4_position       = $dtheaderrow->app4_position;
            $app5_position       = $dtheaderrow->app5_position;
            $app6_position       = $dtheaderrow->app6_position;
            $app7_position       = $dtheaderrow->app7_position;
            $app8_position       = $dtheaderrow->app8_position;

            $app1_personalid     = $dtheaderrow->app1_personalid;
            $app2_personalid     = $dtheaderrow->app2_personalid;
            $app3_personalid     = $dtheaderrow->app3_personalid;
            $app4_personalid     = $dtheaderrow->app4_personalid;
            $app5_personalid     = $dtheaderrow->app5_personalid;
            $app6_personalid     = $dtheaderrow->app6_personalid;
            $app7_personalid     = $dtheaderrow->app7_personalid;
            $app8_personalid     = $dtheaderrow->app8_personalid;


            $app1_personalstatus = $dtheaderrow->app1_personalstatus;
            $app2_personalstatus = $dtheaderrow->app2_personalstatus;
            $app3_personalstatus = $dtheaderrow->app3_personalstatus;
            $app4_personalstatus = $dtheaderrow->app4_personalstatus;
            $app5_personalstatus = $dtheaderrow->app5_personalstatus;
            $app6_personalstatus = $dtheaderrow->app6_personalstatus;
            $app7_personalstatus = $dtheaderrow->app7_personalstatus;
            $app8_personalstatus = $dtheaderrow->app8_personalstatus;

            $app1date             = $dtheaderrow->app1_date;
            $app2date             = $dtheaderrow->app2_date;
            $app3date             = $dtheaderrow->app3_date;
            $app4date             = $dtheaderrow->app4_date;
            $app5date             = $dtheaderrow->app5_date;
            $app6date             = $dtheaderrow->app6_date;
            $app7date             = $dtheaderrow->app7_date;
            $app8date             = $dtheaderrow->app8_date;


            if (trim($dtheaderrow->app1_date) != '') {
                $app1_date       = date('d-m-Y', strtotime($dtheaderrow->app1_date));
            } else {
                $app1_date = '';
            }
            if (trim($dtheaderrow->app2_date) != '') {
                $app2_date       = date('d-m-Y', strtotime($dtheaderrow->app2_date));
            } else {
                $app2_date = '';
            }
            if (trim($dtheaderrow->app3_date) != '') {
                $app3_date       = date('d-m-Y', strtotime($dtheaderrow->app3_date));
            } else {
                $app3_date = '';
            }
            if (trim($dtheaderrow->app4_date) != '') {
                $app4_date       = date('d-m-Y', strtotime($dtheaderrow->app4_date));
            } else {
                $app4_date = '';
            }
            if (trim($dtheaderrow->app5_date) != '') {
                $app5_date       = date('d-m-Y', strtotime($dtheaderrow->app5_date));
            } else {
                $app5_date = '';
            }
            if (trim($dtheaderrow->app6_date) != '') {
                $app6_date       = date('d-m-Y', strtotime($dtheaderrow->app6_date));
            } else {
                $app6_date = '';
            }
            if (trim($dtheaderrow->app7_date) != '') {
                $app7_date       = date('d-m-Y', strtotime($dtheaderrow->app7_date));
            } else {
                $app7_date = '';
            }
            if (trim($dtheaderrow->app8_date) != '') {
                $app8_date       = date('d-m-Y', strtotime($dtheaderrow->app8_date));
            } else {
                $app8_date = '';
            }
        }

        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail       = $this->model->get_detail_byidx($this->header_id);
            $dtdetail_b     = $this->model->get_detail_byid_bx($this->header_id);
        } else {
            $dtdetail       = $this->model->get_detail_byid($this->header_id);
            $dtdetail_b     = $this->model->get_detail_byid_b($this->header_id);
        }

        // detail
        $no = 1;
        
        foreach ($dtdetail as $dtdetail_key => $dtdetail_row) {
            // ini mau nampilin list item aja 
            if ($dtdetail_row->shift == 'shift_1') {

                $dtl_nama_mesin[]   = trim($dtdetail_row->nama_mesin);
                $dtl_kode[]         = trim($dtdetail_row->kode);
                $jml_per_mesin[]    = trim($dtdetail_row->jml_per_mesin);
                $jml_per_kode[]     = trim($dtdetail_row->jml_per_kode);
                $no_urut_mesin[]    = trim($dtdetail_row->no_urut_mesin);
                $no_urut_kode[]     = trim($dtdetail_row->no_urut_kode);

                $dtl_parameter[]    = $dtdetail_row->parameter;

                $dtl_no[] = $no++;
                for ($tbl_a_i = 1; $tbl_a_i <= 3; $tbl_a_i++) {
                    foreach ($dtdetail as ${'dtdetail_key_sf' . $tbl_a_i} => ${'dtdetail_row_sf' . $tbl_a_i}) {
                        if (
                            ${'dtdetail_row_sf' . $tbl_a_i}->shift == 'shift_' . $tbl_a_i
                            && $dtdetail_row->nama_mesin == ${'dtdetail_row_sf' . $tbl_a_i}->nama_mesin
                            && $dtdetail_row->kode == ${'dtdetail_row_sf' . $tbl_a_i}->kode
                            && $dtdetail_row->parameter == ${'dtdetail_row_sf' . $tbl_a_i}->parameter
                        ) {

                            ${'dtl_cek_shift_jam1_shift_' . $tbl_a_i}[] = ${'dtdetail_row_sf' . $tbl_a_i}->cek_shift_jam1;
                            ${'dtl_cek_shift_jam2_shift_' . $tbl_a_i}[] = ${'dtdetail_row_sf' . $tbl_a_i}->cek_shift_jam2;
                            ${'dtl_cek_shift_jam3_shift_' . $tbl_a_i}[] = ${'dtdetail_row_sf' . $tbl_a_i}->cek_shift_jam3;
                            ${'dtl_cek_shift_jam4_shift_' . $tbl_a_i}[] = ${'dtdetail_row_sf' . $tbl_a_i}->cek_shift_jam4;
                            ${'dtl_cek_shift_jam5_shift_' . $tbl_a_i}[] = ${'dtdetail_row_sf' . $tbl_a_i}->cek_shift_jam5;
                            ${'dtl_cek_shift_jam6_shift_' . $tbl_a_i}[] = ${'dtdetail_row_sf' . $tbl_a_i}->cek_shift_jam6;
                            ${'dtl_cek_shift_jam7_shift_' . $tbl_a_i}[] = ${'dtdetail_row_sf' . $tbl_a_i}->cek_shift_jam7;
                            ${'dtl_cek_shift_jam8_shift_' . $tbl_a_i}[] = ${'dtdetail_row_sf' . $tbl_a_i}->cek_shift_jam8;

                            break;
                        }
                    }
                }
            }
        }

        //detail b
        $no = 1;
        foreach ($dtdetail_b as $dtdetail_b_row) {
            $nomor[]                      = $no++;
            $dtl_b_shift[]                = trim ($dtdetail_b_row->shift);
            $dtl_b_jam[]                  = trim ($dtdetail_b_row->jam);
            $dtl_b_uraian[]               = trim ($dtdetail_b_row->uraian);
            $dtl_b_tindakan[]             = trim ($dtdetail_b_row->tindakan);
            $dtl_b_pj_nama[]              = trim ($dtdetail_b_row->pj_nama);
            $dtl_b_pj_personalstatus[]    = trim ($dtdetail_b_row->pj_personalstatus);
            $dtl_b_pj_personalid[]        = trim ($dtdetail_b_row->pj_personalid);
            $dtl_b_paraf[]                = trim ($dtdetail_b_row->paraf);
            $dtl_b_keterangan[]           = trim ($dtdetail_b_row->keterangan);
            $dtl_b_hasil_analisa[]        = trim ($dtdetail_b_row->hasil_analisa);
            $dtl_b_air_recycle[]          = trim ($dtdetail_b_row->air_recycle);
            $dtl_b_terbuang[]             = trim ($dtdetail_b_row->terbuang);

            
        }


        // style
        $PTStyle                   = new PHPExcel_Style();
        $headerStyle               = new PHPExcel_Style();
        $headerStyleLeft           = new PHPExcel_Style();
        $headerStyleLeftTop        = new PHPExcel_Style();
        $headerStyleRightTop       = new PHPExcel_Style();
        $headerStyleLeftBottomTop  = new PHPExcel_Style();
        $headerStyleRightBottomTop = new PHPExcel_Style();
        $DetailheaderStyle         = new PHPExcel_Style();
        $bodyStyle                 = new PHPExcel_Style();
        $bodyStyleAlignLeft        = new PHPExcel_Style();
        $bodyStyleAlignLeftTop        = new PHPExcel_Style();
        $noborderStyle             = new PHPExcel_Style();
        $bodyStyleLeft             = new PHPExcel_Style();
        $bodyStyleRight            = new PHPExcel_Style();
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
        $bodyStyleAlignLeftTop->applyFromArray($this->xls->bodyStyleAlignLeftTop);
        $noborderStyle->applyFromArray($this->xls->noborderStyle);
        $bodyStyleLeft->applyFromArray($this->xls->bodyStyleLeft);
        $bodyStyleRight->applyFromArray($this->xls->bodyStyleRight);
        $footerStyleLeftbottom->applyFromArray($this->xls->footerStyleLeftbottom);
        $footerStyleRightbottom->applyFromArray($this->xls->footerStyleRightbottom);
        // end style

        $obj = new Excel();

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('assets/images/PSG_logo_2022.png');
        $objPHPExcel = $obj->createSheet(0);

        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getPageSetup()->setFitToPage(false);
        $objPHPExcel->getPageSetup()->setScale(35);
        $objPHPExcel->getPageMargins()->setLeft(0.1);
        $objPHPExcel->getPageMargins()->setRight(0.1);
        $objPHPExcel->getPageMargins()->setBottom(0.1);
        $objPHPExcel->getPageMargins()->setTop(0.1);
        $objPHPExcel->getPageSetup()->setVerticalCentered(true);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);

        $count1 = count($dtdetail) / 3; //dibagi karena 3 shift
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

        $count2 = count($dtdetail_b);
        $jml_data_perpage_b = 15;
        if ($count2 < $jml_data_perpage_b) {
            $jml_page_b = 1;
        } else {
            if (($count2 % $jml_data_perpage_b) == 0) {
                $jml_page_b = $count2 / $jml_data_perpage_b;
            } else {
                $jml_page_b = floor(($count2 / $jml_data_perpage_b)) + 1;
            }
        }

        // $jml_row_perpage  = $jml_data_perpage + 6;
        $jml_row_perpage  = $jml_data_perpage + 33;

        $jml_page   = max($jml_page_a, $jml_page_b);

        $range = array();
        $rangeCol = "BW";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(4);
        }

        for ($rowHeight = 0; $rowHeight < ($jml_row_perpage * $jml_page); $rowHeight++) {
            $objPHPExcel->getRowDimension($rowHeight)->setRowHeight(15);
        }
        

        $jumlahdata = 0;
        for ($i1 = 0; $i1 < $jml_page; $i1++) {

            $start_row        = ($i1 * $jml_row_perpage) + 1;
            $finish_row       = ((($i1 * $jml_row_perpage) + 1) + ($jml_row_perpage));

            $start_detail     = ($i1 * $jml_data_perpage);
            $finish_detail    = (($i1 * $jml_data_perpage) + ($jml_data_perpage - 1));

            $start_detail_b   = ($i1 * $jml_data_perpage_b);
            $finish_detail_b  = (($i1 * $jml_data_perpage_b) + ($jml_data_perpage_b - 1));

            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/PSG_logo_2022.png');
            $gbr->setWidthAndHeight(45, 45);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('B' . $start_row);

            $objPHPExcel->getRowDimension($start_row)->setRowHeight(15);
            $objPHPExcel->getRowDimension($start_row + 1)->setRowHeight(15);
            $objPHPExcel->getRowDimension($start_row + 2)->setRowHeight(15);
            $objPHPExcel->getRowDimension($start_row + 3)->setRowHeight(15);
            $objPHPExcel->mergeCells('A' . $start_row . ':D' . ($start_row + 1));
            $objPHPExcel->mergeCells('E' . $start_row . ':BH' . ($start_row + 1))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('BI' . $start_row . ':BK' . $start_row)->setCellValue('BI' . $start_row, 'Doc');
            $objPHPExcel->mergeCells('BL' . $start_row . ':BW' . $start_row)->setCellValue('BL' . $start_row, ': ' . $docno);
            $objPHPExcel->mergeCells('BI' . ($start_row + 1) . ':BK' . ($start_row + 1))->setCellValue('BI' . ($start_row + 1), 'Date');
            $objPHPExcel->mergeCells('BL' . ($start_row + 1) . ':BW' . ($start_row + 1))->setCellValue('BL' . ($start_row + 1), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' . ($start_row + 2) . ':D' . ($start_row + 2))->setCellValue('A' . ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' . ($start_row + 2) . ':BH' . ($start_row + 2))->setCellValue('E' . ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('BI' . ($start_row + 2) . ':BK' . ($start_row + 2))->setCellValue('BI' . ($start_row + 2), 'Page');
            $objPHPExcel->mergeCells('BL' . ($start_row + 2) . ':BW' . ($start_row + 2))->setCellValue('BL' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page);

            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 2) . ':BW' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':BW' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle, 'A' . ($start_row) . ':BH' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleLeftTop, 'BI' . ($start_row) . ':BW' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'BL' . $start_row . ':BW' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'BI' . ($start_row + 2) . ':BW' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'BL' . ($start_row + 2) . ':BW' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':BH' . ($start_row + 2));
            $objPHPExcel->getStyle('BL' . ($start_row) . ':BW' . ($start_row))->getFont()->setSize(10);

            // detail

            $objPHPExcel->mergeCells('B' . ($start_row + 4) . ':C' . ($start_row + 5))->setCellValue('B' . ($start_row + 4), "No");
            $objPHPExcel->mergeCells('D' . ($start_row + 4) . ':F' . ($start_row + 5))->setCellValue('D' . ($start_row + 4), "NAMA MESIN");
            $objPHPExcel->mergeCells('G' . ($start_row + 4) . ':K' . ($start_row + 5))->setCellValue('G' . ($start_row + 4), "KODE");
            $objPHPExcel->mergeCells('L' . ($start_row + 4) . ':S' . ($start_row + 5))->setCellValue('L' . ($start_row + 4), "PARAMETER");
            $objPHPExcel->mergeCells('BP' . ($start_row + 4) . ':BV' . ($start_row + 5))->setCellValue('BP' . ($start_row + 4), "KETERANGAN");
            $objPHPExcel->mergeCells('T' . ($start_row + 4) . ':AI' . ($start_row + 4))->setCellValue('T' . ($start_row + 4), "SHIFT I");
            $objPHPExcel->mergeCells('T' . ($start_row + 5) . ':U' . ($start_row + 5))->setCellValue('T' . ($start_row + 5), '07');
            $objPHPExcel->mergeCells('V' . ($start_row + 5) . ':W' . ($start_row + 5))->setCellValue('V' . ($start_row + 5), '08');
            $objPHPExcel->mergeCells('X' . ($start_row + 5) . ':Y' . ($start_row + 5))->setCellValue('X' . ($start_row + 5), '09');
            $objPHPExcel->mergeCells('Z' . ($start_row + 5) . ':AA' . ($start_row + 5))->setCellValue('Z' . ($start_row + 5), '10');
            $objPHPExcel->mergeCells('AB' . ($start_row + 5) . ':AC' . ($start_row + 5))->setCellValue('AB' . ($start_row + 5), '11');
            $objPHPExcel->mergeCells('AD' . ($start_row + 5) . ':AE' . ($start_row + 5))->setCellValue('AD' . ($start_row + 5), '12');
            $objPHPExcel->mergeCells('AF' . ($start_row + 5) . ':AG' . ($start_row + 5))->setCellValue('AF' . ($start_row + 5), '13');
            $objPHPExcel->mergeCells('AH' . ($start_row + 5) . ':AI' . ($start_row + 5))->setCellValue('AH' . ($start_row + 5), '14');

            $objPHPExcel->mergeCells('AJ' . ($start_row + 4) . ':AY' . ($start_row + 4))->setCellValue('AJ' . ($start_row + 4), "SHIFT II");
            $objPHPExcel->mergeCells('AJ' . ($start_row + 5) . ':AK' . ($start_row + 5))->setCellValue('AJ' . ($start_row + 5), '15');
            $objPHPExcel->mergeCells('AL' . ($start_row + 5) . ':AM' . ($start_row + 5))->setCellValue('AL' . ($start_row + 5), '16');
            $objPHPExcel->mergeCells('AN' . ($start_row + 5) . ':AO' . ($start_row + 5))->setCellValue('AN' . ($start_row + 5), '17');
            $objPHPExcel->mergeCells('AP' . ($start_row + 5) . ':AQ' . ($start_row + 5))->setCellValue('AP' . ($start_row + 5), '18');
            $objPHPExcel->mergeCells('AR' . ($start_row + 5) . ':AS' . ($start_row + 5))->setCellValue('AR' . ($start_row + 5), '19');
            $objPHPExcel->mergeCells('AT' . ($start_row + 5) . ':AU' . ($start_row + 5))->setCellValue('AT' . ($start_row + 5), '20');
            $objPHPExcel->mergeCells('AV' . ($start_row + 5) . ':AW' . ($start_row + 5))->setCellValue('AV' . ($start_row + 5), '21');
            $objPHPExcel->mergeCells('AX' . ($start_row + 5) . ':AY' . ($start_row + 5))->setCellValue('AX' . ($start_row + 5), '22');

            $objPHPExcel->mergeCells('AZ' . ($start_row + 4) . ':BO' . ($start_row + 4))->setCellValue('AZ' . ($start_row + 4), "SHIFT III");
            $objPHPExcel->mergeCells('AZ' . ($start_row + 5) . ':BA' . ($start_row + 5))->setCellValue('AZ' . ($start_row + 5), '23');
            $objPHPExcel->mergeCells('BB' . ($start_row + 5) . ':BC' . ($start_row + 5))->setCellValue('BB' . ($start_row + 5), '24');
            $objPHPExcel->mergeCells('BD' . ($start_row + 5) . ':BE' . ($start_row + 5))->setCellValue('BD' . ($start_row + 5), '01');
            $objPHPExcel->mergeCells('BF' . ($start_row + 5) . ':BG' . ($start_row + 5))->setCellValue('BF' . ($start_row + 5), '02');
            $objPHPExcel->mergeCells('BH' . ($start_row + 5) . ':BI' . ($start_row + 5))->setCellValue('BH' . ($start_row + 5), '03');
            $objPHPExcel->mergeCells('BJ' . ($start_row + 5) . ':BK' . ($start_row + 5))->setCellValue('BJ' . ($start_row + 5), '04');
            $objPHPExcel->mergeCells('BL' . ($start_row + 5) . ':BM' . ($start_row + 5))->setCellValue('BL' . ($start_row + 5), '05');
            $objPHPExcel->mergeCells('BN' . ($start_row + 5) . ':BO' . ($start_row + 5))->setCellValue('BN' . ($start_row + 5), '06');

            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BW' . ($start_row + 3) . ':BW' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($start_row + 3) . ':A' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($start_row + 4) . ':BV' . ($start_row + 5));
            $objPHPExcel->getStyle('B' . ($start_row + 4) . ':AQ' . ($start_row + 5))->getFont()->setBold(true);

            $dtl_row = $start_row + 5;
            
            $objPHPExcel->mergeCells('BP' . ($dtl_row+1)  . ':BV' . ($dtl_row + ($finish_detail+1)))->setCellValue('BP' . ($dtl_row+1), "CF = Carbon filter
                                                                                                                                        ST = Softener
                                                                                                                                        SF = Sand Filter
                                                                                                                                        M3 : Meter kubik");
            $objPHPExcel->setSharedStyle($bodyStyleAlignLeftTop, 'BP' . ($dtl_row+1) . ':BV' . ($dtl_row + ($finish_detail+1)));
            $no = 1;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {
                $dtl_row++;
                $jumlahdata++;

                $dt_no[$a]         = $dtl_no[$a]         ?? "";
                $dt_nama_mesin[$a] = $dtl_nama_mesin[$a] ?? "";
                $dt_kode[$a]       = $dtl_kode[$a]       ?? "";
                $dt_parameter[$a]  = $dtl_parameter[$a]  ?? "";

                $dt_cek_shift_jam1_shift_1[$a] = $dtl_cek_shift_jam1_shift_1[$a] ?? "";
                $dt_cek_shift_jam2_shift_1[$a] = $dtl_cek_shift_jam2_shift_1[$a] ?? "";
                $dt_cek_shift_jam3_shift_1[$a] = $dtl_cek_shift_jam3_shift_1[$a] ?? "";
                $dt_cek_shift_jam4_shift_1[$a] = $dtl_cek_shift_jam4_shift_1[$a] ?? "";
                $dt_cek_shift_jam5_shift_1[$a] = $dtl_cek_shift_jam5_shift_1[$a] ?? "";
                $dt_cek_shift_jam6_shift_1[$a] = $dtl_cek_shift_jam6_shift_1[$a] ?? "";
                $dt_cek_shift_jam7_shift_1[$a] = $dtl_cek_shift_jam7_shift_1[$a] ?? "";
                $dt_cek_shift_jam8_shift_1[$a] = $dtl_cek_shift_jam8_shift_1[$a] ?? "";

                $dt_cek_shift_jam1_shift_2[$a] = $dtl_cek_shift_jam1_shift_2[$a] ?? "";
                $dt_cek_shift_jam2_shift_2[$a] = $dtl_cek_shift_jam2_shift_2[$a] ?? "";
                $dt_cek_shift_jam3_shift_2[$a] = $dtl_cek_shift_jam3_shift_2[$a] ?? "";
                $dt_cek_shift_jam4_shift_2[$a] = $dtl_cek_shift_jam4_shift_2[$a] ?? "";
                $dt_cek_shift_jam5_shift_2[$a] = $dtl_cek_shift_jam5_shift_2[$a] ?? "";
                $dt_cek_shift_jam6_shift_2[$a] = $dtl_cek_shift_jam6_shift_2[$a] ?? "";
                $dt_cek_shift_jam7_shift_2[$a] = $dtl_cek_shift_jam7_shift_2[$a] ?? "";
                $dt_cek_shift_jam8_shift_2[$a] = $dtl_cek_shift_jam8_shift_2[$a] ?? "";

                $dt_cek_shift_jam1_shift_3[$a] = $dtl_cek_shift_jam1_shift_3[$a] ?? "";
                $dt_cek_shift_jam2_shift_3[$a] = $dtl_cek_shift_jam2_shift_3[$a] ?? "";
                $dt_cek_shift_jam3_shift_3[$a] = $dtl_cek_shift_jam3_shift_3[$a] ?? "";
                $dt_cek_shift_jam4_shift_3[$a] = $dtl_cek_shift_jam4_shift_3[$a] ?? "";
                $dt_cek_shift_jam5_shift_3[$a] = $dtl_cek_shift_jam5_shift_3[$a] ?? "";
                $dt_cek_shift_jam6_shift_3[$a] = $dtl_cek_shift_jam6_shift_3[$a] ?? "";
                $dt_cek_shift_jam7_shift_3[$a] = $dtl_cek_shift_jam7_shift_3[$a] ?? "";
                $dt_cek_shift_jam8_shift_3[$a] = $dtl_cek_shift_jam8_shift_3[$a] ?? "";

                if (isset($jml_per_mesin[$a])) {
                    $dt_jml_per_mesin[$a] = $jml_per_mesin[$a] - 1;
                } else {
                    $dt_jml_per_mesin[$a] = 0;
                }
                if (isset($jml_per_kode[$a])) {
                    $dt_jml_per_kode[$a]  = $jml_per_kode[$a];
                } else {
                    $dt_jml_per_kode[$a]  = "";
                }
                if (isset($no_urut_mesin[$a])) {
                    $dt_no_urut_mesin[$a] = $no_urut_mesin[$a] - 1;
                } else {
                    $dt_no_urut_mesin[$a] = 0;
                }
                if (isset($no_urut_kode[$a])) {
                    $dt_no_urut_kode[$a]  = $no_urut_kode[$a];
                } else {
                    $dt_no_urut_kode[$a]  = "";
                }
                // if (isset($nama_mesin[$a])) {
                //     $dt_nama_mesin[$a]    = $nama_mesin[$a];
                // } else {
                //     $dt_nama_mesin[$a]    = "";
                // }

                if ($no_urut_mesin[$a] == 1) {
                    $objPHPExcel->mergeCells('B' . $dtl_row . ':C' . ($dtl_row + ($jml_per_mesin[$a]*$jml_per_kode[$a]-1)))->setCellValue('B' . $dtl_row, $no++);
                    $objPHPExcel->mergeCells('D' .  $dtl_row . ':F' .  ($dtl_row + ($jml_per_mesin[$a]*$jml_per_kode[$a]-1)))->setCellValue('D' .  $dtl_row, $dt_nama_mesin[$a]);
                } else {
                    $objPHPExcel->mergeCells('D' .  $dtl_row . ':F' .  $dtl_row)->setCellValue('D' .  $dtl_row, "");
                    // $objPHPExcel->mergeCells('BP' .  $dtl_row . ':BV' .  $dtl_row)->setCellValue('BP' .  $dtl_row, "");
                    // $objPHPExcel->setSharedStyle($noborderStyle ,'BP' .  $dtl_row . ':BV' .  $dtl_row);
                }

                if ($no_urut_kode[$a] == 1) {
                    $objPHPExcel->mergeCells('G' .  $dtl_row . ':K' .  ($dtl_row + ($jml_per_kode[$a]-1)))->setCellValue('G' .  $dtl_row, $dt_kode[$a]);
                }
                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $dtl_row . ':BO' . $dtl_row);
                // $objPHPExcel->mergeCells('D' . $dtl_row . ':F' . $dtl_row)->setCellValue('D' . $dtl_row, $dt_nama_mesin[$a]);
                // $objPHPExcel->mergeCells('G' . $dtl_row . ':K' . $dtl_row)->setCellValue('G' . $dtl_row, $dt_kode[$a]);
                $objPHPExcel->mergeCells('L' . $dtl_row . ':S' . $dtl_row)->setCellValue('L' . $dtl_row, $dt_parameter[$a]);

                $objPHPExcel->mergeCells('T' . $dtl_row . ':U' . $dtl_row)->setCellValue('T' . $dtl_row, $dt_cek_shift_jam1_shift_1[$a]);
                $objPHPExcel->mergeCells('V' . $dtl_row . ':W' . $dtl_row)->setCellValue('V' . $dtl_row, $dt_cek_shift_jam2_shift_1[$a]);
                $objPHPExcel->mergeCells('X' . $dtl_row . ':Y' . $dtl_row)->setCellValue('X' . $dtl_row, $dt_cek_shift_jam3_shift_1[$a]);
                $objPHPExcel->mergeCells('Z' . $dtl_row . ':AA' . $dtl_row)->setCellValue('Z' . $dtl_row, $dt_cek_shift_jam4_shift_1[$a]);
                $objPHPExcel->mergeCells('AB' . $dtl_row . ':AC' . $dtl_row)->setCellValue('AB' . $dtl_row, $dt_cek_shift_jam5_shift_1[$a]);
                $objPHPExcel->mergeCells('AD' . $dtl_row . ':AE' . $dtl_row)->setCellValue('AD' . $dtl_row, $dt_cek_shift_jam6_shift_1[$a]);
                $objPHPExcel->mergeCells('AF' . $dtl_row . ':AG' . $dtl_row)->setCellValue('AF' . $dtl_row, $dt_cek_shift_jam7_shift_1[$a]);
                $objPHPExcel->mergeCells('AH' . $dtl_row . ':AI' . $dtl_row)->setCellValue('AH' . $dtl_row, $dt_cek_shift_jam8_shift_1[$a]);
                
                $objPHPExcel->mergeCells('AJ' . $dtl_row . ':AK' . $dtl_row)->setCellValue('AJ' . $dtl_row, $dt_cek_shift_jam1_shift_2[$a]);
                $objPHPExcel->mergeCells('AL' . $dtl_row . ':AM' . $dtl_row)->setCellValue('AL' . $dtl_row, $dt_cek_shift_jam2_shift_2[$a]);
                $objPHPExcel->mergeCells('AN' . $dtl_row . ':AO' . $dtl_row)->setCellValue('AN' . $dtl_row, $dt_cek_shift_jam3_shift_2[$a]);
                $objPHPExcel->mergeCells('AP' . $dtl_row . ':AQ' . $dtl_row)->setCellValue('AP' . $dtl_row, $dt_cek_shift_jam4_shift_2[$a]);
                $objPHPExcel->mergeCells('AR' . $dtl_row . ':AS' . $dtl_row)->setCellValue('AR' . $dtl_row, $dt_cek_shift_jam5_shift_2[$a]);
                $objPHPExcel->mergeCells('AT' . $dtl_row . ':AU' . $dtl_row)->setCellValue('AT' . $dtl_row, $dt_cek_shift_jam6_shift_2[$a]);
                $objPHPExcel->mergeCells('AV' . $dtl_row . ':AW' . $dtl_row)->setCellValue('AV' . $dtl_row, $dt_cek_shift_jam7_shift_2[$a]);
                $objPHPExcel->mergeCells('AX' . $dtl_row . ':AY' . $dtl_row)->setCellValue('AX' . $dtl_row, $dt_cek_shift_jam8_shift_2[$a]);

                $objPHPExcel->mergeCells('AZ' . $dtl_row . ':BA' . $dtl_row)->setCellValue('AZ' . $dtl_row, $dt_cek_shift_jam1_shift_3[$a]);
                $objPHPExcel->mergeCells('BB' . $dtl_row . ':BC' . $dtl_row)->setCellValue('BB' . $dtl_row, $dt_cek_shift_jam2_shift_3[$a]);
                $objPHPExcel->mergeCells('BD' . $dtl_row . ':BE' . $dtl_row)->setCellValue('BD' . $dtl_row, $dt_cek_shift_jam3_shift_3[$a]);
                $objPHPExcel->mergeCells('BF' . $dtl_row . ':BG' . $dtl_row)->setCellValue('BF' . $dtl_row, $dt_cek_shift_jam4_shift_3[$a]);
                $objPHPExcel->mergeCells('BH' . $dtl_row . ':BI' . $dtl_row)->setCellValue('BH' . $dtl_row, $dt_cek_shift_jam5_shift_3[$a]);
                $objPHPExcel->mergeCells('BJ' . $dtl_row . ':BK' . $dtl_row)->setCellValue('BJ' . $dtl_row, $dt_cek_shift_jam6_shift_3[$a]);
                $objPHPExcel->mergeCells('BL' . $dtl_row . ':BM' . $dtl_row)->setCellValue('BL' . $dtl_row, $dt_cek_shift_jam7_shift_3[$a]);
                $objPHPExcel->mergeCells('BN' . $dtl_row . ':BO' . $dtl_row)->setCellValue('BN' . $dtl_row, $dt_cek_shift_jam8_shift_3[$a]);

                

               
                // $objPHPExcel->mergeCells('BP' . $dtl_row  . ':BV' . $dtl_row)->setCellValue('BP' . $dtl_row, "PG : Pressure Gauge\n
                // DP  : Dosing Pump");

                $objPHPExcel->setSharedStyle($bodyStyleRight, 'BW' . ($dtl_row) . ':BW' . ($dtl_row + 9));
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($dtl_row) . ':A' . ($dtl_row + 9));
            }

            // end detail
            
            $start_row2 = $dtl_row + 1;
            $objPHPExcel->mergeCells('A' . ($start_row2 + 1) . ':Q' . ($start_row2 + 1))->setCellValue('A' . ($start_row2 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('R' . ($start_row2 + 1) . ':BW' . ($start_row2 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($start_row2 + 1) . ':BW' . ($start_row2 + 1))->setCellValue('R' . ($start_row2 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row2 + 1) . ':Q' . ($start_row2 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($start_row2 + 1) . ':BW' . ($start_row2 + 1));
            $objPHPExcel->setBreak('A' . ($start_row2 + 1),  PHPExcel_Worksheet::BREAK_ROW);
            
            $start_row3 = $start_row2 + 2;

            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/PSG_logo_2022.png');
            $gbr->setWidthAndHeight(45, 45);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('B' . $start_row3);

            $objPHPExcel->getRowDimension($start_row3)->setRowHeight(15);
            $objPHPExcel->getRowDimension($start_row3 + 1)->setRowHeight(15);
            $objPHPExcel->getRowDimension($start_row3 + 2)->setRowHeight(15);
            $objPHPExcel->getRowDimension($start_row3 + 3)->setRowHeight(15);
            $objPHPExcel->mergeCells('A' . $start_row3 . ':D' . ($start_row3 + 1));
            $objPHPExcel->mergeCells('E' . $start_row3 . ':BH' . ($start_row3 + 1))->setCellValue('E' . $start_row3,  $this->frmcop);
            $objPHPExcel->mergeCells('BI' . $start_row3 . ':BK' . $start_row3)->setCellValue('BI' . $start_row3, 'Doc');
            $objPHPExcel->mergeCells('BL' . $start_row3 . ':BW' . $start_row3)->setCellValue('BL' . $start_row3, ': ' . $docno);
            $objPHPExcel->mergeCells('BI' . ($start_row3 + 1) . ':BK' . ($start_row3 + 1))->setCellValue('BI' . ($start_row3 + 1), 'Date');
            $objPHPExcel->mergeCells('BL' . ($start_row3 + 1) . ':BW' . ($start_row3 + 1))->setCellValue('BL' . ($start_row3 + 1), ': ' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' . ($start_row3 + 2) . ':D' . ($start_row3 + 2))->setCellValue('A' . ($start_row3 + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' . ($start_row3 + 2) . ':BH' . ($start_row3 + 2))->setCellValue('E' . ($start_row3 + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('BI' . ($start_row3 + 2) . ':BK' . ($start_row3 + 2))->setCellValue('BI' . ($start_row3 + 2), 'Page');
            $objPHPExcel->mergeCells('BL' . ($start_row3 + 2) . ':BW' . ($start_row3 + 2))->setCellValue('BL' . ($start_row3 + 2), ': ' . ($i1 + 2) . ' of ' . ($jml_page*2));

            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row3 + 2) . ':BW' . ($start_row3 + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row3 + 4) . ':BW' . ($start_row3 + 4));
            $objPHPExcel->setSharedStyle($headerStyle, 'A' . ($start_row3) . ':BH' . ($start_row3 + 2));
            $objPHPExcel->setSharedStyle($headerStyleLeftTop, 'BI' . ($start_row3) . ':BW' . ($start_row3 + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'BL' . $start_row3 . ':BW' . ($start_row3 + 2));
            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'BI' . ($start_row3 + 2) . ':BW' . ($start_row3 + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'BL' . ($start_row3 + 2) . ':BW' . ($start_row3 + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row3) . ':BH' . ($start_row3 + 2));
            $objPHPExcel->getStyle('BL' . ($start_row3) . ':BW' . ($start_row3))->getFont()->setSize(10);
            // detail d
            $table2 = $start_row3+3;
            $objPHPExcel->mergeCells('B'  . ($table2 + 1) . ':BV' . ($table2 + 1))->setCellValue('B' .  ($table2 + 1), "CATATAN KETIDAKSESUAIAN");
            $objPHPExcel->mergeCells('B'  . ($table2 + 2) . ':H' . ($table2 + 2))->setCellValue('B' .  ($table2 + 2), "Jam");
            $objPHPExcel->mergeCells('I'  . ($table2 + 2) . ':W' . ($table2 + 2))->setCellValue('I' .  ($table2 + 2), "Uraian ketidaksesuaian");
            $objPHPExcel->mergeCells('X'  . ($table2 + 2) . ':AL' . ($table2 + 2))->setCellValue('X' .  ($table2 + 2), "Tindakan Perbaikan");
            $objPHPExcel->mergeCells('AM'  . ($table2 + 2) . ':AQ' . ($table2 + 2))->setCellValue('AM' .  ($table2 + 2), "Hasil Analisa");
            $objPHPExcel->mergeCells('AR'  . ($table2 + 2) . ':AZ' . ($table2 + 2))->setCellValue('AR' .  ($table2 + 2), "Nama");
            $objPHPExcel->mergeCells('BA'  . ($table2 + 2) . ':BH' . ($table2 + 2))->setCellValue('BA' .  ($table2 + 2), "Paraf");
            $objPHPExcel->mergeCells('BI'  . ($table2 + 2) . ':BM' . ($table2 + 2))->setCellValue('BI' .  ($table2 + 2), "Air Recycle");
            $objPHPExcel->mergeCells('BN'  . ($table2 + 2) . ':BR' . ($table2 + 2))->setCellValue('BN' .  ($table2 + 2), "Terbuang");
            $objPHPExcel->mergeCells('BS'  . ($table2 + 2) . ':BV' . ($table2 + 2))->setCellValue('BS' .  ($table2 + 2), "Keterangan");

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($table2 + 1) . ':BV' . ($table2 + 2));
            $objPHPExcel->getStyle('B' . ($table2 + 1) . ':BV' . ($table2 + 2))->getFont()->setBold(true);
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($table2 + 3) . ':BV' . ($table2 + 3));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BW' . ($table2) . ':BW' . ($table2 + 2));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($table2) . ':A' . ($table2 + 2));

            $keterangan1 = $table2 + 2;
            for ($d = $start_detail_b; $d <= $finish_detail_b; $d++) {
                $keterangan1++;
                $objPHPExcel->getRowDimension($keterangan1)->setRowHeight(25);
                $dt_jam               [$d] = $dtl_b_jam[$d]                ?? "";
                $dt_uraian            [$d] = $dtl_b_uraian[$d]             ?? "";
                $dt_tindakan          [$d] = $dtl_b_tindakan[$d]           ?? "";
                $dt_pj_nama           [$d] = $dtl_b_pj_nama[$d]            ?? "";
                $dt_pj_personalstatus [$d] = $dtl_b_pj_personalstatus[$d]  ?? "";
                $dt_pj_personalid     [$d] = $dtl_b_pj_personalid[$d]      ?? "";
                $dt_paraf             [$d] = $dtl_b_paraf[$d]              ?? "";
                $dt_keterangan        [$d] = $dtl_b_keterangan[$d]         ?? "";
                $dt_hasil_analisa     [$d] = $dtl_b_hasil_analisa[$d]         ?? "";
                $dt_air_recycle       [$d] = $dtl_b_air_recycle[$d]         ?? "";
                $dt_terbuang          [$d] = $dtl_b_terbuang[$d]         ?? "";

                $objPHPExcel->setSharedStyle($bodyStyleRight, 'BW' . ($keterangan1) . ':BW' . ($keterangan1));
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($keterangan1) . ':A' . ($keterangan1));
                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $keterangan1 . ':BV' . $keterangan1);                                        // TABEL BODY (DETAIL)
                $objPHPExcel->mergeCells('B' .  $keterangan1 . ':H' .  $keterangan1)->setCellValue('B' .  $keterangan1, $dt_jam[$d]);
                $objPHPExcel->mergeCells('I' .  $keterangan1 . ':W' .  $keterangan1)->setCellValue('I' .  $keterangan1, $dt_uraian[$d]);
                $objPHPExcel->mergeCells('X' .  $keterangan1 . ':AL' . $keterangan1)->setCellValue('X' .  $keterangan1, $dt_tindakan[$d]);
                $objPHPExcel->mergeCells('AM' .  $keterangan1 . ':AQ' . $keterangan1)->setCellValue('AM' .  $keterangan1, $dt_hasil_analisa[$d]);
                $objPHPExcel->mergeCells('AR' . $keterangan1 . ':AZ' . $keterangan1)->setCellValue('AR' . $keterangan1, $dt_pj_nama[$d]);
                $objPHPExcel->mergeCells('BA' . $keterangan1 . ':BH' . $keterangan1)->setCellValue('BA' . $keterangan1, $dt_paraf[$d]);
                $objPHPExcel->mergeCells('BI' . $keterangan1 . ':BM' . $keterangan1)->setCellValue('BI' . $keterangan1, $dt_keterangan[$d]);
                $objPHPExcel->mergeCells('BN' . $keterangan1 . ':BR' . $keterangan1)->setCellValue('BN' . $keterangan1, $dt_air_recycle[$d]);
                $objPHPExcel->mergeCells('BS' . $keterangan1 . ':BV' . $keterangan1)->setCellValue('BS' . $keterangan1, $dt_terbuang[$d]);

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
                    $objPHPExcel->getRowDimension($keterangan1)->setRowHeight(50);
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $dt_pj_personalstatus[$d] . '_' . $dt_pj_personalid[$d] . '.png');
                    $sign_img->setWidthAndHeight(100, 100);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('BC' . ($keterangan1))->setOffsetY(2)->setOffsetX(-3);
                } else {
                    if ($dt_pj_personalid[$d] != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $dt_pj_personalid[$d] . $imageformatapp1)) {
                        $objPHPExcel->getRowDimension($keterangan1)->setRowHeight(50);
                        $sign_img = new PHPExcel_Worksheet_Drawing();
                        $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $dt_pj_personalid[$d] . $imageformatapp1);
                        $sign_img->setWidthAndHeight(100, 100);
                        $sign_img->setResizeProportional(true);
                        $sign_img->setWorksheet($objPHPExcel);
                        $sign_img->setCoordinates('BC' . ($keterangan1))->setOffsetY(3)->setOffsetX(-3);
                    }
                }
            }

            // end detail d

            $app_row  = $keterangan1 + 1;

            $objPHPExcel->getRowDimension($app_row + 1)->setRowHeight(6);
            $objPHPExcel->mergeCells('B' . ($app_row + 2) . ':S' . ($app_row + 2))->setCellValue('B' . ($app_row + 2), "Dibuat oleh " . 'shift 1,');
            $objPHPExcel->mergeCells('B' . ($app_row + 3) . ':S' . ($app_row + 6))->setCellValue('B' . ($app_row + 3), '');

            $objPHPExcel->mergeCells('T' . ($app_row + 2) . ':AK' . ($app_row + 2))->setCellValue('T' . ($app_row + 2), "Dibuat oleh " . 'shift 2');
            $objPHPExcel->mergeCells('T' . ($app_row + 3) . ':AK' . ($app_row + 6))->setCellValue('T' . ($app_row + 3), '');

            $objPHPExcel->mergeCells('AL' . ($app_row + 2) . ':BC' . ($app_row + 2))->setCellValue('AL' . ($app_row + 2), "Dibuat oleh " . 'shift 3');
            $objPHPExcel->mergeCells('AL' . ($app_row + 3) . ':BC' . ($app_row + 6))->setCellValue('AL' . ($app_row + 3), '');

            $objPHPExcel->mergeCells('BD' . ($app_row + 2) . ':BM' . ($app_row + 2))->setCellValue('BD' . ($app_row + 2), 'Diketahui Oleh, ');
            $objPHPExcel->mergeCells('BD' . ($app_row + 3) . ':BM' . ($app_row + 6))->setCellValue('BD' . ($app_row + 3), '');

            $objPHPExcel->mergeCells('BN' . ($app_row + 2) . ':BV' . ($app_row + 2))->setCellValue('BN' . ($app_row + 2), 'Disetujui Oleh,');
            $objPHPExcel->mergeCells('BN' . ($app_row + 3) . ':BV' . ($app_row + 6))->setCellValue('BN' . ($app_row + 3), '');

            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($app_row) . ':BW' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row) . ':BV' . ($app_row));
            $objPHPExcel->setSharedStyle($bodyStyle, 'B' . ($app_row + 2) . ':BV' . ($app_row + 2));
            $objPHPExcel->setSharedStyle($bodyStyle, 'B' . ($app_row + 3) . ':BV' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BW' . ($app_row) . ':BW' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row) . ':A' . ($app_row + 6));

            // tabel app
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
                    $sign_img->setCoordinates('G' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                        $sign_img = new PHPExcel_Worksheet_Drawing();
                        $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                        $sign_img->setWidthAndHeight(135, 135);
                        $sign_img->setResizeProportional(true);
                        $sign_img->setWorksheet($objPHPExcel);
                        $sign_img->setCoordinates('G' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                    
                }else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('G' . ($app_row + 4));
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
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $app2_personalstatus . '_' . $app2_personalid . '.png');
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('Z' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else  if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                        $sign_img2 = new PHPExcel_Worksheet_Drawing();
                        $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                        $sign_img2->setWidthAndHeight(135, 135);
                        $sign_img2->setResizeProportional(true);
                        $sign_img2->setWorksheet($objPHPExcel);
                        $sign_img2->setCoordinates('Z' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                }else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('Z' . ($app_row + 4));
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
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app3_personalstatus . '_' . $app2_personalid . '.png')) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $app3_personalstatus . '_' . $app2_personalid . '.png');
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AQ' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                        $sign_img3 = new PHPExcel_Worksheet_Drawing();
                        $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                        $sign_img3->setWidthAndHeight(135, 135);
                        $sign_img3->setResizeProportional(true);
                        $sign_img3->setWorksheet($objPHPExcel);
                        $sign_img3->setCoordinates('AQ' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                }else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AQ' . ($app_row + 4));
                }
            }

            if ($app4_personalstatus == '2') {
                $imageurlapp4 = '/forviewfoto_pekerja/TTD_TK/';
                $imageformatapp4 = '.png';
            } else if ($app4_personalstatus == '1') {
                $imageurlapp4 = '/forviewfoto_pekerja/';
                $imageformatapp4 = '_0_0.png';
            } else {
                $imageurlapp4 = '';
                $imageformatapp4 = '';
            }

            $sign_img4 = '$objDrawing' . $i1;
            if (isset($app4_by)) {
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app4_personalstatus . '_' . $app4_personalid . '.png')) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $app4_personalstatus . '_' . $app4_personalid . '.png');
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('BF' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else if ($app4_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4)) {
                        $sign_img4 = new PHPExcel_Worksheet_Drawing();
                        $sign_img4->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4);
                        $sign_img4->setWidthAndHeight(135, 135);
                        $sign_img4->setResizeProportional(true);
                        $sign_img4->setWorksheet($objPHPExcel);
                        $sign_img4->setCoordinates('BF' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                }else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('BF' . ($app_row + 4));
                }
            }

            if ($app5_personalstatus == '2') {
                $imageurlapp5 = '/forviewfoto_pekerja/TTD_TK/';
                $imageformatapp5 = '.png';
            } else if ($app5_personalstatus == '1') {
                $imageurlapp5 = '/forviewfoto_pekerja/';
                $imageformatapp5 = '_0_0.png';
            } else {
                $imageurlapp5 = '';
                $imageformatapp5 = '';
            }

            $sign_img5 = '$objDrawing' . $i1;
            if (isset($app5_by)) {
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app5_personalstatus . '_' . $app5_personalid . '.png')) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $app5_personalstatus . '_' . $app5_personalid . '.png');
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('BP' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                } else if ($app5_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp5 . $app5_personalid . $imageformatapp5)) {
                        $sign_img5 = new PHPExcel_Worksheet_Drawing();
                        $sign_img5->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp5 . $app5_personalid . $imageformatapp5);
                        $sign_img5->setWidthAndHeight(135, 135);
                        $sign_img5->setResizeProportional(true);
                        $sign_img5->setWorksheet($objPHPExcel);
                        $sign_img5->setCoordinates('BP' . ($app_row + 4))->setOffsetY(3)->setOffsetX(-3);
                }else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('BP' . ($app_row + 4));
                }
            }

            $objPHPExcel->mergeCells('B' . ($app_row + 7) . ':D' . ($app_row + 7))->setCellValue('B' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('E' . ($app_row + 7) . ':S' . ($app_row + 7))->setCellValue('E' . ($app_row + 7), ': ' . $app1_by);
            $objPHPExcel->mergeCells('B' . ($app_row + 8) . ':D' . ($app_row + 8))->setCellValue('B' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('E' . ($app_row + 8) . ':S' . ($app_row + 8))->setCellValue('E' . ($app_row + 8), ': ' . $app1_position);
            $objPHPExcel->mergeCells('B' . ($app_row + 9) . ':D' . ($app_row + 9))->setCellValue('B' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('E' . ($app_row + 9) . ':S' . ($app_row + 9))->setCellValue('E' . ($app_row + 9), ': ' . $app1date);

            $objPHPExcel->mergeCells('T' . ($app_row + 7) . ':V' . ($app_row + 7))->setCellValue('T' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('W' . ($app_row + 7) . ':AK' . ($app_row + 7))->setCellValue('W' . ($app_row + 7), ': ' . $app2_by);
            $objPHPExcel->mergeCells('T' . ($app_row + 8) . ':V' . ($app_row + 8))->setCellValue('T' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('W' . ($app_row + 8) . ':AK' . ($app_row + 8))->setCellValue('W' . ($app_row + 8), ': ' . $app2_position);
            $objPHPExcel->mergeCells('T' . ($app_row + 9) . ':V' . ($app_row + 9))->setCellValue('T' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('W' . ($app_row + 9) . ':AK' . ($app_row + 9))->setCellValue('W' . ($app_row + 9), ': ' . $app2date);

            $objPHPExcel->mergeCells('AL' . ($app_row + 7) . ':AN' . ($app_row + 7))->setCellValue('AL' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('AO' . ($app_row + 7) . ':BC' . ($app_row + 7))->setCellValue('AO' . ($app_row + 7), ': ' . $app3_by);
            $objPHPExcel->mergeCells('AL' . ($app_row + 8) . ':AN' . ($app_row + 8))->setCellValue('AL' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('AO' . ($app_row + 8) . ':BC' . ($app_row + 8))->setCellValue('AO' . ($app_row + 8), ': ' . $app3_position);
            $objPHPExcel->mergeCells('AL' . ($app_row + 9) . ':AN' . ($app_row + 9))->setCellValue('AL' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('AO' . ($app_row + 9) . ':BC' . ($app_row + 9))->setCellValue('AO' . ($app_row + 9), ': ' . $app3date);

            $objPHPExcel->mergeCells('BD' . ($app_row + 7) . ':BF' . ($app_row + 7))->setCellValue('BD' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('BG' . ($app_row + 7) . ':BM' . ($app_row + 7))->setCellValue('BG' . ($app_row + 7), ': ' . $app4_by);
            $objPHPExcel->mergeCells('BD' . ($app_row + 8) . ':BF' . ($app_row + 8))->setCellValue('BD' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('BG' . ($app_row + 8) . ':BM' . ($app_row + 8))->setCellValue('BG' . ($app_row + 8), ': ' . $app4_position);
            $objPHPExcel->mergeCells('BD' . ($app_row + 9) . ':BF' . ($app_row + 9))->setCellValue('BD' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('BG' . ($app_row + 9) . ':BM' . ($app_row + 9))->setCellValue('BG' . ($app_row + 9), ': ' . $app4date);

            $objPHPExcel->mergeCells('BN' . ($app_row + 7) . ':BP' . ($app_row + 7))->setCellValue('BN' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('BQ' . ($app_row + 7) . ':BV' . ($app_row + 7))->setCellValue('BQ' . ($app_row + 7), ': ' . $app5_by);
            $objPHPExcel->mergeCells('BN' . ($app_row + 8) . ':BP' . ($app_row + 8))->setCellValue('BN' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('BQ' . ($app_row + 8) . ':BV' . ($app_row + 8))->setCellValue('BQ' . ($app_row + 8), ': ' . $app5_position);
            $objPHPExcel->mergeCells('BN' . ($app_row + 9) . ':BP' . ($app_row + 9))->setCellValue('BN' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('BQ' . ($app_row + 9) . ':BV' . ($app_row + 9))->setCellValue('BQ' . ($app_row + 9), ': ' . $app5date);

            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($app_row + 7) . ':BW' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'B' . ($app_row + 7) . ':B' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'K' . ($app_row + 7) . ':K' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'T' . ($app_row + 7) . ':T' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AC' . ($app_row + 7) . ':AC' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AL' . ($app_row + 7) . ':AL' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AU' . ($app_row + 7) . ':AU' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'BD' . ($app_row + 7) . ':BD' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'BN' . ($app_row + 7) . ':BN' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BV' . ($app_row + 7) . ':BV' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BW' . ($app_row + 7) . ':BW' . ($app_row + 9));
            

            $foot_row = $app_row + 9;
            $objPHPExcel->mergeCells('A' . ($foot_row + 1) . ':Q' . ($foot_row + 1))->setCellValue('A' . ($foot_row + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('R' . ($foot_row + 1) . ':BW' . ($foot_row + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($foot_row + 1) . ':BW' . ($foot_row + 1))->setCellValue('R' . ($foot_row + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($foot_row + 1) . ':Q' . ($foot_row + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($foot_row + 1) . ':BW' . ($foot_row + 1));
            $objPHPExcel->setBreak('A' . ($foot_row + 1),  PHPExcel_Worksheet::BREAK_ROW);
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
