<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_frmfss054_04 extends CI_Controller
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

        $dtheader = $this->M_formfrmfss054_04->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date          = $dtheaderrow->create_date; //2021-02-08

            $create_date            = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno                  = $dtheaderrow->docno;
            $rev                    = $dtheaderrow->rev;
            $gugus                  = $dtheaderrow->gugus;
            $tahun                  = $dtheaderrow->tahun;
            $deptabbr               = $dtheaderrow->deptabbr;

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

        $list_month = $this->M_formfrmfss054_04->get_month($tahun);
        if ($this->cekLevelUserNm == 'Auditor') {
            $dtdetail   = $this->M_formfrmfss054_04->get_detail_byidx($this->header_id);
        } else {
            $dtdetail   = $this->M_formfrmfss054_04->get_detail_byid($this->header_id);
        }

        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        //detail a
        if (isset($dtdetail)) {
            $no = 1;
            $parent = -1;
            foreach ($dtdetail as $dtdetail_row) {
                $parent++;
                $arr_number[]       = $no++;
                $arr_nama_mesin[]   = $dtdetail_row->nama_mesin;
                $arr_kode_mesin[]   = $dtdetail_row->kode_mesin;
                $arr_frekuensi[]    = $dtdetail_row->frekuensi;
                $arr_gugus[]    = $dtdetail_row->gugus;
                $arr_ket[]          = $dtdetail_row->ket;

                foreach ($list_month as $list_month_row) {
                    ${'arr_month' . $list_month_row->month}[] = date('d-m-Y', strtotime($dtdetail_row->{'month' . $list_month_row->month})) == '01-01-1970' ? '' : date('d-m-Y', strtotime($dtdetail_row->{'month' . $list_month_row->month}));
                }

                if (isset($dtdetail_row->children)) {
                    foreach ($dtdetail_row->children as $child_row) {
                        $arr_sch[] = $child_row->tgl_schedule;
                    }
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
        $jml_data_perpage = 30;
        if ($count1 < $jml_data_perpage) {
            $jml_page_a = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page_a = $count1 / $jml_data_perpage;
            } else {
                $jml_page_a = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }

        $jml_row_perpage  = ($jml_data_perpage) + 18;

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
            $objPHPExcel->mergeCells('AW' . ($start_row + 3) . ':BA' . ($start_row + 3))->setCellValue('AW' . ($start_row + 3), ': ' . ($i1 + 1) . ' of ' . ($jml_page_a));

            $objPHPExcel->setSharedStyle($headerStyle,   'A' . $start_row . ':D' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row) . ':AT' . ($start_row + 3));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AU' . ($start_row) . ':BA' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AW' . $start_row  . ':BA' . ($start_row + 3));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AU' . ($start_row + 2) . ':BA' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AW' . ($start_row + 2) . ':BA' . ($start_row + 3));


            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':AT' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyleBold, 'B' . ($start_row + 4) . ':AT' . ($start_row + 4));

            $objPHPExcel->mergeCells('A' . ($start_row + 4) . ':AT' . ($start_row + 4))->setCellValue('A' . ($start_row + 4), ' GUGUS : Water Treatment');
            $objPHPExcel->mergeCells('A' . ($start_row + 5) . ':AT' . ($start_row + 5))->setCellValue('A' . ($start_row + 5), ' DEPARTEMEN : ' . $deptabbr);
            $objPHPExcel->mergeCells('AU' . ($start_row + 5) . ':BA' . ($start_row + 5))->setCellValue('AU' . ($start_row + 5), ' TAHUN : ' . $tahun);

            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A' . ($start_row + 4) . ':A' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($noborderStyleBold, 'B' . ($start_row + 4) . ':AZ' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BA' . ($start_row + 4) . ':BA' . ($start_row + 5));


            $objPHPExcel->mergeCells('A' . ($start_row + 6) . ':A' . ($start_row + 7))->setCellValue('A' . ($start_row + 6), 'No.');
            $objPHPExcel->mergeCells('B' . ($start_row + 6) . ':E' . ($start_row + 7))->setCellValue('B' . ($start_row + 6), 'N A M A');
            $objPHPExcel->mergeCells('F' . ($start_row + 6) . ':H' . ($start_row + 7))->setCellValue('F' . ($start_row + 6), 'KODE');
            $objPHPExcel->mergeCells('I' . ($start_row + 6) . ':K' . ($start_row + 7))->setCellValue('I' . ($start_row + 6), 'FREQUENCY');
            // $objPHPExcel->mergeCells('L' . ($start_row + 6) . ':N' . ($start_row + 7))->setCellValue('L' . ($start_row + 6), 'G U G U S');

            $objPHPExcel->mergeCells('L' . ($start_row + 6) . ':AU' . ($start_row + 6))->setCellValue('L' . ($start_row + 6), "BULAN");

            $col_tgl = ['L', 'O', 'R', 'U', 'X', 'AA', 'AD', 'AG', 'AJ', 'AM', 'AP', 'AS'];
            $a1 = -1;
            foreach ($list_month as $list_month_row) {
                $a1++;
                $objPHPExcel->mergeCells(getColRange($col_tgl[$a1], ($start_row + 7), 2))->setCellValue($col_tgl[$a1] . ($start_row + 7), $bulan[$list_month_row->month]);
            }
            $objPHPExcel->mergeCells('AV' . ($start_row + 6) . ':BA' . ($start_row + 7))->setCellValue('AV' . ($start_row + 6), "KETERANGAN");

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row + 6) . ':BA' . ($start_row + 7));

            $dtl_row = $start_row + 7;
            $no = 1;
            $rowspan_b = -1;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {
                $dtl_row++;
                $rowspan_b++;
                // $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(28);
                if (isset($arr_number[$arr])) {
                    $dt_number[$arr] = $arr_number[$arr];
                } else {
                    $dt_number[$arr] = "";
                }
                if (isset($arr_nama_mesin[$arr])) {
                    $dt_nama_mesin[$arr] = $arr_nama_mesin[$arr];
                } else {
                    $dt_nama_mesin[$arr] = "";
                }
                if (isset($arr_kode_mesin[$arr])) {
                    $dt_kode_mesin[$arr] = $arr_kode_mesin[$arr];
                } else {
                    $dt_kode_mesin[$arr] = "";
                }
                if (isset($arr_frekuensi[$arr])) {
                    $dt_frekuensi[$arr] = $arr_frekuensi[$arr];
                } else {
                    $dt_frekuensi[$arr] = "";
                }
                if (isset($arr_gugus[$arr])) {
                    $dt_gugus[$arr] = $arr_gugus[$arr];
                } else {
                    $dt_gugus[$arr] = "";
                }
                if (isset($arr_ket[$arr])) {
                    $dt_ket[$arr] = $arr_ket[$arr];
                } else {
                    $dt_ket[$arr] = "";
                }
                if (isset($arr_sch[$arr])) {
                    $dt_sch[$arr] = $arr_sch[$arr];
                } else {
                    $dt_sch[$arr] = "";
                }

                foreach ($list_month as $list_month_row) {
                    if (isset(${'arr_month' . $list_month_row->month}[$arr])) {
                        ${'dt_month' . $list_month_row->month}[$arr] = ${'arr_month' . $list_month_row->month}[$arr];
                    } else {
                        ${'dt_month' . $list_month_row->month}[$arr] = "";
                    }
                }
                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . ($dtl_row) . ':BA' . ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'B' . ($dtl_row) . ':E' . ($dtl_row));

                $objPHPExcel->mergeCells('A' . ($dtl_row) . ':A' . ($dtl_row))->setCellValue('A' . ($dtl_row), $dt_number[$arr]);
                $objPHPExcel->mergeCells('B' . ($dtl_row) . ':E' . ($dtl_row))->setCellValue('B' . ($dtl_row), $dt_nama_mesin[$arr]);
                $objPHPExcel->mergeCells('F' . ($dtl_row) . ':H' . ($dtl_row))->setCellValue('F' . ($dtl_row), $dt_kode_mesin[$arr]);
                $objPHPExcel->mergeCells('I' . ($dtl_row) . ':K' . ($dtl_row))->setCellValue('I' . ($dtl_row), $dt_frekuensi[$arr]);
                // $objPHPExcel->mergeCells('L' . ($dtl_row) . ':N' . ($dtl_row))->setCellValue('L' . ($dtl_row), $dt_gugus[$arr]);

                $a1 = -1;
                foreach ($list_month as $list_month_row) {
                    $a1++;
                    $objPHPExcel->mergeCells(getColRange($col_tgl[$a1], ($dtl_row), 2))->setCellValue($col_tgl[$a1] . ($dtl_row), ${'dt_month' . $list_month_row->month}[$arr]);

                    $arr_tgl_sch = explode(',', $dt_sch[$arr]);
                    foreach ($arr_tgl_sch as $arr_tgl_sch_row) {
                        if ($arr_tgl_sch_row == $list_month_row->month) {
                            $objPHPExcel->getStyle(getColRange($col_tgl[$a1], ($dtl_row), 2))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '4dffff'))));
                        }
                    }
                }
                $objPHPExcel->mergeCells('AV' . ($dtl_row) . ':BA' . ($dtl_row))->setCellValue('AV' . ($dtl_row), $dt_ket[$arr]);
            }
            $app_row = $dtl_row + 2;

            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A' . ($app_row - 1) . ':A' . ($app_row - 1));
            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row - 1) . ':AY' . ($app_row - 1));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BA' . ($app_row - 1) . ':BA' . ($app_row - 1));

            $objPHPExcel->mergeCells('A' . ($app_row) . ':R' . ($app_row))->setCellValue('A' . ($app_row), 'Dibuat Oleh,');
            $objPHPExcel->mergeCells('S' . ($app_row) . ':AI' . ($app_row))->setCellValue('S' . ($app_row), 'Diketahui Oleh,');
            $objPHPExcel->mergeCells('AJ' . ($app_row) . ':AZ' . ($app_row))->setCellValue('AJ' . ($app_row), 'Disetujui Oleh,');

            $objPHPExcel->mergeCells('A' . ($app_row + 1) . ':R' . ($app_row + 3))->setCellValue('A' . ($app_row + 1), '');
            $objPHPExcel->mergeCells('S' . ($app_row + 1) . ':AI' . ($app_row + 3))->setCellValue('S' . ($app_row + 1), '');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 1) . ':AZ' . ($app_row + 3))->setCellValue('AJ' . ($app_row + 1), '');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($app_row) . ':BA' . ($app_row + 3));


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
                    $sign_img2->setCoordinates('Z' . ($app_row + 1));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('Z' . ($app_row + 1));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('Z' . ($app_row + 1));
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
                    $sign_img3->setCoordinates('AQ' . ($app_row + 1));
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('AQ' . ($app_row + 1));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AQ' . ($app_row + 1));
                }
            }


            $objPHPExcel->mergeCells('A' . ($app_row + 4) . ':B' . ($app_row + 4))->setCellValue('A' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('C' . ($app_row + 4) . ':R' . ($app_row + 4))->setCellValue('C' . ($app_row + 4), ': ' . $app1_by);
            $objPHPExcel->mergeCells('A' . ($app_row + 5) . ':B' . ($app_row + 5))->setCellValue('A' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('C' . ($app_row + 5) . ':R' . ($app_row + 5))->setCellValue('C' . ($app_row + 5), ': ' . $app1_position);
            $objPHPExcel->mergeCells('A' . ($app_row + 6) . ':B' . ($app_row + 6))->setCellValue('A' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('C' . ($app_row + 6) . ':R' . ($app_row + 6))->setCellValue('C' . ($app_row + 6), ': ' . $app1date);

            $objPHPExcel->mergeCells('S' . ($app_row + 4) . ':U' . ($app_row + 4))->setCellValue('S' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('V' . ($app_row + 4) . ':AI' . ($app_row + 4))->setCellValue('V' . ($app_row + 4), ': ' . $app2_by);
            $objPHPExcel->mergeCells('S' . ($app_row + 5) . ':U' . ($app_row + 5))->setCellValue('S' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('V' . ($app_row + 5) . ':AI' . ($app_row + 5))->setCellValue('V' . ($app_row + 5), ': ' . $app2_position);
            $objPHPExcel->mergeCells('S' . ($app_row + 6) . ':U' . ($app_row + 6))->setCellValue('S' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('V' . ($app_row + 6) . ':AI' . ($app_row + 6))->setCellValue('V' . ($app_row + 6), ': ' . $app2date);

            $objPHPExcel->mergeCells('AJ' . ($app_row + 4) . ':AL' . ($app_row + 4))->setCellValue('AJ' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('AM' . ($app_row + 4) . ':AZ' . ($app_row + 4))->setCellValue('AM' . ($app_row + 4), ': ' . $app3_by);
            $objPHPExcel->mergeCells('AJ' . ($app_row + 5) . ':AL' . ($app_row + 5))->setCellValue('AJ' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('AM' . ($app_row + 5) . ':AZ' . ($app_row + 5))->setCellValue('AM' . ($app_row + 5), ': ' . $app3_position);
            $objPHPExcel->mergeCells('AJ' . ($app_row + 6) . ':AL' . ($app_row + 6))->setCellValue('AJ' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('AM' . ($app_row + 6) . ':AZ' . ($app_row + 6))->setCellValue('AM' . ($app_row + 6), ': ' . $app3date);

            $objPHPExcel->mergeCells('Z' . ($app_row + 1) . ':AB' . ($app_row + 1))->setCellValue('Z' . ($app_row + 1), '');
            // $objPHPExcel->mergeCells('AA' . ($app_row + 2) . ':AZ' . ($app_row + 2))->setCellValue('AA' . ($app_row + 2), '');

            // $objPHPExcel->setSharedStyle($noborderStyle, 'Y' . ($app_row) . ':AZ' . ($app_row + 6));
            // $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($app_row + 4) . ':BA' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 4) . ':A' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'S' . ($app_row + 4) . ':S' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AJ' . ($app_row + 4) . ':AJ' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AZ' . ($app_row + 4) . ':AZ' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BA' . ($app_row) . ':BA' . ($app_row + 6));

            // $objPHPExcel->getStyle('AK' . ($app_row + 7) . ':CE' . ($app_row + 9))->getFont()->setBold(true);
            // $objPHPExcel->setSharedStyle($bodyStyleRight, 'CF' . ($app_row + 7) . ':CF' . ($app_row + 9));
            // $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AK' . ($app_row + 7) . ':AK' . ($app_row + 9));

            $foot_row = $app_row + 6;
            $objPHPExcel->mergeCells('A' . ($foot_row + 1) . ':H' . ($foot_row + 1))->setCellValue('A' . ($foot_row + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($foot_row + 1) . ':H' . ($foot_row + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('I' . ($foot_row + 1) . ':BA' . ($foot_row + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('I' . ($foot_row + 1) . ':BA' . ($foot_row + 1))->setCellValue('I' . ($foot_row + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($foot_row + 1) . ':H' . ($foot_row + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'I' . ($foot_row + 1) . ':BA' . ($foot_row + 1));
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
