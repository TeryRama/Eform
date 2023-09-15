<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_inttbn020_03 extends CI_Controller
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
        $this->load->model(array('M_user', 'master/M_form', 'M_menu', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs => 'model'));
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

        $dtheader = $this->model->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $app1_by                   = $dtheaderrow->app1_by;
            $app2_by                   = $dtheaderrow->app2_by;
            $app3_by                   = $dtheaderrow->app3_by;
            $app1_position             = $dtheaderrow->app1_position;
            $app2_position             = $dtheaderrow->app2_position;
            $app3_position             = $dtheaderrow->app3_position;
            $app1_personalid           = $dtheaderrow->app1_personalid;
            $app2_personalid           = $dtheaderrow->app2_personalid;
            $app3_personalid           = $dtheaderrow->app3_personalid;
            $app1_personalstatus       = $dtheaderrow->app1_personalstatus;
            $app2_personalstatus       = $dtheaderrow->app2_personalstatus;
            $app3_personalstatus       = $dtheaderrow->app3_personalstatus;
            $app1date                  = $dtheaderrow->app1_date;
            $app2date                  = $dtheaderrow->app2_date;
            $app3date                  = $dtheaderrow->app3_date;

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

            $dtcreate_date              = $dtheaderrow->create_date; //2021-02-08
            $create_date                = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $bulan                      = date('M', strtotime($dtheaderrow->create_date));
            $docno                      = $dtheaderrow->docno;
        }

        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail           = $this->model->get_detail_byidx($this->header_id);
        } else {
            $dtdetail           = $this->model->get_detail_byid($this->header_id);
        }

        $no = 1;
        foreach ($dtdetail as $dtdetail_row) {
            $nomor[]              = $no++;
            $item_kimia[]        = $dtdetail_row->item_kimia;
            $satuan[]            = $dtdetail_row->satuan;
            $stock_awal[]        = $dtdetail_row->stock_awal;
            $terima[]            = $dtdetail_row->terima;
            $terima_akum[]       = $dtdetail_row->terima_akum;
            $pakai[]             = $dtdetail_row->pakai;
            $pakai_akum[]        = $dtdetail_row->pakai_akum;
            $kirim[]             = $dtdetail_row->kirim;
            $kirim_akum[]        = $dtdetail_row->kirim_akum;
            $minimum_stock[]     = $dtdetail_row->minimum_stock;
            $stock_akhir[]       = $dtdetail_row->stock_akhir;
            $ratarata_perbulan[] = $dtdetail_row->ratarata_perbulan;
            $ratarata_perhari[]  = $dtdetail_row->ratarata_perhari;
            $outstanding_ppb[]   = $dtdetail_row->outstanding_ppb;
            $keterangan[]        = $dtdetail_row->keterangan;
        }

        // style
        $PTStyle                   = new PHPExcel_Style();
        $headerStyle               = new PHPExcel_Style();
        $headerStyleLeft           = new PHPExcel_Style();
        $headerStyleRight          = new PHPExcel_Style();
        $headerStyleLeftTop        = new PHPExcel_Style();
        $headerStyleRightTop       = new PHPExcel_Style();
        $headerStyleLeftBottomTop  = new PHPExcel_Style();
        $headerStyleRightBottomTop = new PHPExcel_Style();
        $noborderStyle             = new PHPExcel_Style();
        $bodyStyle                 = new PHPExcel_Style();
        $bodyStyleLeft             = new PHPExcel_Style();
        $bodyStyleRight            = new PHPExcel_Style();
        $bodyStyleAlignLeft        = new PHPExcel_Style();
        $DetailStyle               = new PHPExcel_Style();
        $DetailheaderStyle         = new PHPExcel_Style();
        $DetailheaderStyleLeft     = new PHPExcel_Style();
        $footerStyle               = new PHPExcel_Style();
        $footerStyleLeftbottom     = new PHPExcel_Style();
        $footerStyleRightbottom    = new PHPExcel_Style();

        $PTStyle->applyFromArray($this->xls->PT_STYLE);
        $headerStyle->applyFromArray($this->xls->headerStyle);
        $headerStyleLeft->applyFromArray($this->xls->headerStyleLeft);
        $headerStyleRight->applyFromArray($this->xls->headerStyleRight);
        $headerStyleLeftTop->applyFromArray($this->xls->headerStyleLeftTop);
        $headerStyleRightTop->applyFromArray($this->xls->headerStyleRightTop);
        $headerStyleLeftBottomTop->applyFromArray($this->xls->headerStyleLeftBottomTop);
        $headerStyleRightBottomTop->applyFromArray($this->xls->headerStyleRightBottomTop);
        $noborderStyle->applyFromArray($this->xls->noborderStyle);
        $bodyStyle->applyFromArray($this->xls->bodyStyle);
        $bodyStyleLeft->applyFromArray($this->xls->bodyStyleLeft);
        $bodyStyleRight->applyFromArray($this->xls->bodyStyleRight);
        $bodyStyleAlignLeft->applyFromArray($this->xls->bodyStyleAlignLeft);
        $DetailStyle->applyFromArray($this->xls->DetailStyle);
        $DetailheaderStyle->applyFromArray($this->xls->DetailheaderStyle);
        $DetailheaderStyleLeft->applyFromArray($this->xls->DetailheaderStyleLeft);
        $footerStyle->applyFromArray($this->xls->footerStyle);
        $footerStyleLeftbottom->applyFromArray($this->xls->footerStyleLeftbottom);
        $footerStyleRightbottom->applyFromArray($this->xls->footerStyleRightbottom);

        $textbold9 = array(
            'font' => array(
                'bold'    => true,
                'name' => 'Times New Roman',
                'size' => 9
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'wrap'       => true
            ),

        );

        $DetailStyle2 = array(
            'fill'   => array(
                'type'    => PHPExcel_Style_Fill::FILL_SOLID
            ),
            'font' => array(
                'bold'    => false,
                'name' => 'Times New Roman',
                'size' => 9
            ),
            'numberformat'   => array(
                'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT
            ),
            'borders' => array(
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap'       => true
            ),

        );

        $noborderapv = array();
        // end style

        $obj = new Excel();
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('assets/images/PSG_logo_2022.png');
        $objPHPExcel = $obj->createSheet(0);
        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getPageSetup()->setFitToPage(true);
        $objPHPExcel->getPageSetup()->setScale(60);
        $objPHPExcel->getPageMargins()->setLeft(0.2);
        $objPHPExcel->getPageMargins()->setRight(0.2);
        $objPHPExcel->getPageMargins()->setBottom(0.2);
        $objPHPExcel->getPageMargins()->setTop(0.2);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);
        $objPHPExcel->getPageSetup()->setVerticalCentered(true);

        $range = array();
        $rangeCol = "AT";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(5);
        }

        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(20);
        }

        $count = count($dtdetail);
        $jml_data_perpage = 16;
        if ($count < $jml_data_perpage) {
            $jml_page = 1;
        } else {
            if (($count % $jml_data_perpage) == 0) {
                $jml_page = $count / $jml_data_perpage;
            } else {
                $jml_page = floor(($count / $jml_data_perpage)) + 1;
            }
        }

        $jml_row_perpage  = 98;

        // $jml_page = max($jml_page);

        // $number = 0;
        for ($i1 = 0; $i1 < $jml_page; $i1++) {
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


            $objPHPExcel->mergeCells('A' .   $start_row . ':D' . ($start_row + 1));
            $objPHPExcel->mergeCells('E' .   $start_row . ':AL' . ($start_row + 1))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('A' .  ($start_row + 2) . ':D' .  ($start_row + 2))->setCellValue('A' .  ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' .  ($start_row + 2) . ':AL' . ($start_row + 2))->setCellValue('E' .  ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AM' .  $start_row . ':AN' . $start_row)->setCellValue('AM' . $start_row, 'DOK.');
            $objPHPExcel->mergeCells('AO' .  $start_row . ':AT' . $start_row)->setCellValue('AO' . $start_row, ': ' . $docno);
            $objPHPExcel->mergeCells('AM' . ($start_row + 1) . ':AN' . ($start_row + 1))->setCellValue('AM' . ($start_row + 1), 'TGL.');
            $objPHPExcel->mergeCells('AO' . ($start_row + 1) . ':AT' . ($start_row + 1))->setCellValue('AO' . ($start_row + 1), ': ' . date('d-m-Y', strtotime($create_date)));
            $objPHPExcel->mergeCells('AM' . ($start_row + 2) . ':AN' . ($start_row + 2))->setCellValue('AM' . ($start_row + 2), 'HAL.');
            $objPHPExcel->mergeCells('AO' . ($start_row + 2) . ':AT' . ($start_row + 2))->setCellValue('AO' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row .      ':D' .  ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':AT' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':AT' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':AL' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AM' . ($start_row) . ':AT' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AO' .  $start_row  . ':AT' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AM' . ($start_row + 2) . ':AT' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AO' . ($start_row + 2) . ':AT' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':AL' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 2));
            $objPHPExcel->getStyle('AO' . ($start_row) . ':AT' . ($start_row))->getFont()->setSize(10);

            function get_tanggal_indo($tanggal)
            {
                $bulan = array(
                    1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
                $pecahkan = explode('-', $tanggal);
                return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
            }
            $bulan = get_tanggal_indo(date('Y-m-', strtotime($create_date)));

            $objPHPExcel->mergeCells('B' .  ($start_row + 4) . ':B' .  ($start_row + 5))->setCellValue('B' .  ($start_row + 4), 'NO');
            $objPHPExcel->mergeCells('C' .  ($start_row + 4) . ':H' .  ($start_row + 5))->setCellValue('C' .  ($start_row + 4), 'ITEM BAHAN KIMIA');
            $objPHPExcel->mergeCells('I' .  ($start_row + 4) . ':J' .  ($start_row + 5))->setCellValue('I' .  ($start_row + 4), 'Satuan');
            $objPHPExcel->mergeCells('K' .  ($start_row + 4) . ':M' .  ($start_row + 5))->setCellValue('K' .  ($start_row + 4), 'Stock Awal');
            $objPHPExcel->mergeCells('N' .  ($start_row + 4) . ':Y' .  ($start_row + 4))->setCellValue('N' .  ($start_row + 4), 'HARI INI');
            $objPHPExcel->mergeCells('N' .  ($start_row + 5) . ':O' .  ($start_row + 5))->setCellValue('N' .  ($start_row + 5), 'TERIMA');
            $objPHPExcel->mergeCells('P' .  ($start_row + 5) . ':Q' .  ($start_row + 5))->setCellValue('P' .  ($start_row + 5), 'Akum');
            $objPHPExcel->mergeCells('R' .  ($start_row + 5) . ':S' .  ($start_row + 5))->setCellValue('R' .  ($start_row + 5), 'PAKAI');
            $objPHPExcel->mergeCells('T' .  ($start_row + 5) . ':U' .  ($start_row + 5))->setCellValue('T' .  ($start_row + 5), 'Akum');
            $objPHPExcel->mergeCells('V' .  ($start_row + 5) . ':W' .  ($start_row + 5))->setCellValue('V' .  ($start_row + 5), 'KIRIM');
            $objPHPExcel->mergeCells('X' .  ($start_row + 5) . ':Y' .  ($start_row + 5))->setCellValue('X' .  ($start_row + 5), 'Akum');
            $objPHPExcel->mergeCells('Z' .  ($start_row + 4) . ':AA' .  ($start_row + 5))->setCellValue('Z' .  ($start_row + 4), 'Minimum Stock');
            $objPHPExcel->mergeCells('AB' .  ($start_row + 4) . ':AD' .  ($start_row + 5))->setCellValue('AB' .  ($start_row + 4), 'STOCK AKHIR');
            $objPHPExcel->mergeCells('AE' .  ($start_row + 4) . ':AG' .  ($start_row + 5))->setCellValue('AE' .  ($start_row + 4), 'Pemakaian Rata-Rata ' . $bulan);
            $objPHPExcel->mergeCells('AH' .  ($start_row + 4) . ':AJ' .  ($start_row + 5))->setCellValue('AH' .  ($start_row + 4), 'Pemakaian Rata-Rata Perhari');
            $objPHPExcel->mergeCells('AK' .  ($start_row + 4) . ':AM' .  ($start_row + 5))->setCellValue('AK' .  ($start_row + 4), 'Outstanding PPB');
            $objPHPExcel->mergeCells('AN' .  ($start_row + 4) . ':AS' .  ($start_row + 5))->setCellValue('AN' .  ($start_row + 4), 'KET');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($start_row + 4) . ':AS' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row + 3) . ':A' .  ($start_row + 5));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AT' . ($start_row + 3) . ':AT' . ($start_row + 5));

            $dtl_row = $start_row + 6;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {
                if (isset($nomor[$arr])) {
                    $dt_nomor[$arr] = $nomor[$arr];
                } else {
                    $dt_nomor[$arr] = "";
                }
                if (isset($item_kimia[$arr])) {
                    $dt_item_kimia[$arr] = $item_kimia[$arr];
                } else {
                    $item_kimia[$arr] = "";
                }
                if (isset($satuan[$arr])) {
                    $dt_satuan[$arr] = $satuan[$arr];
                } else {
                    $satuan[$arr] = "";
                }
                if (isset($stock_awal[$arr])) {
                    $dt_stock_awal[$arr] = $stock_awal[$arr];
                } else {
                    $stock_awal[$arr] = "";
                }
                if (isset($terima[$arr])) {
                    $dt_terima[$arr] = $terima[$arr];
                } else {
                    $terima[$arr] = "";
                }
                if (isset($terima_akum[$arr])) {
                    $dt_terima_akum[$arr] = $terima_akum[$arr];
                } else {
                    $terima_akum[$arr] = "";
                }
                if (isset($pakai[$arr])) {
                    $dt_pakai[$arr] = $pakai[$arr];
                } else {
                    $pakai[$arr] = "";
                }
                if (isset($pakai_akum[$arr])) {
                    $dt_pakai_akum[$arr] = $pakai_akum[$arr];
                } else {
                    $pakai_akum[$arr] = "";
                }
                if (isset($kirim[$arr])) {
                    $dt_kirim[$arr] = $kirim[$arr];
                } else {
                    $kirim[$arr] = "";
                }
                if (isset($kirim_akum[$arr])) {
                    $dt_kirim_akum[$arr] = $kirim_akum[$arr];
                } else {
                    $kirim_akum[$arr] = "";
                }
                if (isset($minimum_stock[$arr])) {
                    $dt_minimum_stock[$arr] = $minimum_stock[$arr];
                } else {
                    $minimum_stock[$arr] = "";
                }
                if (isset($stock_akhir[$arr])) {
                    $dt_stock_akhir[$arr] = $stock_akhir[$arr];
                } else {
                    $stock_akhir[$arr] = "";
                }
                if (isset($ratarata_perbulan[$arr])) {
                    $dt_ratarata_perbulan[$arr] = $ratarata_perbulan[$arr];
                } else {
                    $ratarata_perbulan[$arr] = "";
                }
                if (isset($ratarata_perhari[$arr])) {
                    $dt_ratarata_perhari[$arr] = $ratarata_perhari[$arr];
                } else {
                    $ratarata_perhari[$arr] = "";
                }
                if (isset($outstanding_ppb[$arr])) {
                    $dt_outstanding_ppb[$arr] = $outstanding_ppb[$arr];
                } else {
                    $outstanding_ppb[$arr] = "";
                }
                if (isset($keterangan[$arr])) {
                    $dt_keterangan[$arr] = $keterangan[$arr];
                } else {
                    $keterangan[$arr] = "";
                }

                $objPHPExcel->mergeCells('B' .  ($dtl_row) . ':B' .  ($dtl_row))->setCellValue('B' .  ($dtl_row), $dt_nomor[$arr]);
                $objPHPExcel->mergeCells('C' .  $dtl_row . ':H' .  $dtl_row)->setCellValue('C' .  $dtl_row, $dt_item_kimia[$arr]);
                $objPHPExcel->mergeCells('I' .  $dtl_row . ':J' .  $dtl_row)->setCellValue('I' .  $dtl_row, $dt_satuan[$arr]);
                $objPHPExcel->mergeCells('K' .  $dtl_row . ':M' .  $dtl_row)->setCellValue('K' .  $dtl_row, $dt_stock_awal[$arr]);
                $objPHPExcel->mergeCells('N' .  $dtl_row . ':O' .  $dtl_row)->setCellValue('N' .  $dtl_row, $dt_terima[$arr]);
                $objPHPExcel->mergeCells('P' .  $dtl_row . ':Q' .  $dtl_row)->setCellValue('P' .  $dtl_row, $dt_terima_akum[$arr]);
                $objPHPExcel->mergeCells('R' .  $dtl_row . ':S' .  $dtl_row)->setCellValue('R' .  $dtl_row, $dt_pakai[$arr]);
                $objPHPExcel->mergeCells('T' .  $dtl_row . ':U' .  $dtl_row)->setCellValue('T' .  $dtl_row, $dt_pakai_akum[$arr]);
                $objPHPExcel->mergeCells('V' .  $dtl_row . ':W' .  $dtl_row)->setCellValue('V' .  $dtl_row, $dt_kirim[$arr]);
                $objPHPExcel->mergeCells('X' .  $dtl_row . ':Y' .  $dtl_row)->setCellValue('X' .  $dtl_row, $dt_kirim_akum[$arr]);
                $objPHPExcel->mergeCells('Z' .  $dtl_row . ':AA' .  $dtl_row)->setCellValue('Z' .  $dtl_row, $dt_minimum_stock[$arr]);
                $objPHPExcel->mergeCells('AB' .  $dtl_row . ':AD' .  $dtl_row)->setCellValue('AB' .  $dtl_row, $dt_stock_akhir[$arr]);
                $objPHPExcel->mergeCells('AE' .  $dtl_row . ':AG' .  $dtl_row)->setCellValue('AE' .  $dtl_row, $dt_ratarata_perbulan[$arr]);
                $objPHPExcel->mergeCells('AH' .  $dtl_row . ':AJ' .  $dtl_row)->setCellValue('AH' .  $dtl_row, $dt_ratarata_perhari[$arr]);
                $objPHPExcel->mergeCells('AK' .  $dtl_row . ':AM' .  $dtl_row)->setCellValue('AK' .  $dtl_row, $dt_outstanding_ppb[$arr]);
                $objPHPExcel->mergeCells('AN' .  $dtl_row . ':AS' .  $dtl_row)->setCellValue('AN' .  $dtl_row, $dt_keterangan[$arr]);
                $objPHPExcel->setSharedStyle($DetailStyle,  'B' .  ($dtl_row) . ':B' .  ($dtl_row));
                $objPHPExcel->getStyle('C' . ($dtl_row) . ':H' . ($dtl_row))->applyFromArray($DetailStyle2);
                $objPHPExcel->setSharedStyle($DetailStyle, 'I' . $dtl_row . ':AS' . $dtl_row);
                $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row) . ':A' .  ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyleRight, 'AT' . ($dtl_row) . ':AT' . ($dtl_row));

                $dtl_row++;
            }

            $app_row = $dtl_row;

            $objPHPExcel->mergeCells('B' . ($app_row + 1) . ':C' .  ($app_row + 1))->setCellValue('B' .  ($app_row + 1), 'Catatan :');
            $objPHPExcel->mergeCells('D' . ($app_row + 2) . ':H' .  ($app_row + 2))->setCellValue('D' .  ($app_row + 2), 'NaOH (Soda Kaustik)');
            $objPHPExcel->mergeCells('D' . ($app_row + 3) . ':H' .  ($app_row + 3))->setCellValue('D' .  ($app_row + 3), 'HCL (Asam Klorida) Drum');
            $objPHPExcel->mergeCells('D' . ($app_row + 4) . ':H' .  ($app_row + 4))->setCellValue('D' .  ($app_row + 4), 'Nalco 2556');
            $objPHPExcel->mergeCells('D' . ($app_row + 5) . ':H' .  ($app_row + 5))->setCellValue('D' .  ($app_row + 5), 'Nalco 3273');
            $objPHPExcel->mergeCells('D' . ($app_row + 6) . ':H' .  ($app_row + 6))->setCellValue('D' .  ($app_row + 6), 'Hydro 606');
            $objPHPExcel->mergeCells('D' . ($app_row + 7) . ':H' .  ($app_row + 7))->setCellValue('D' .  ($app_row + 7), 'Hydro 379');
            $objPHPExcel->mergeCells('D' . ($app_row + 8) . ':H' .  ($app_row + 8))->setCellValue('D' .  ($app_row + 8), 'Hydro 377');
            $objPHPExcel->mergeCells('D' . ($app_row + 9) . ':H' .  ($app_row + 9))->setCellValue('D' .  ($app_row + 9), 'Hydro 280');
            $objPHPExcel->mergeCells('D' . ($app_row + 10) . ':H' .  ($app_row + 10))->setCellValue('D' .  ($app_row + 10), 'Hydro 277');
            $objPHPExcel->mergeCells('D' . ($app_row + 11) . ':H' .  ($app_row + 11))->setCellValue('D' .  ($app_row + 11), 'Hydro 566');
            $objPHPExcel->mergeCells('D' . ($app_row + 12) . ':H' .  ($app_row + 12))->setCellValue('D' .  ($app_row + 12), 'Hydro 600');
            $objPHPExcel->mergeCells('D' . ($app_row + 13) . ':H' .  ($app_row + 13))->setCellValue('D' .  ($app_row + 13), 'Filter Cartridge');
            $objPHPExcel->mergeCells('D' . ($app_row + 14) . ':H' .  ($app_row + 14))->setCellValue('D' .  ($app_row + 14), 'Hydro 200');

            $objPHPExcel->mergeCells('I' . ($app_row + 2) . ':K' .  ($app_row + 2))->setCellValue('I' .  ($app_row + 2), '25 Kg/Sak');
            $objPHPExcel->mergeCells('I' . ($app_row + 3) . ':K' .  ($app_row + 3))->setCellValue('I' .  ($app_row + 3), '250 Kg/Drum');
            $objPHPExcel->mergeCells('I' . ($app_row + 4) . ':K' .  ($app_row + 4))->setCellValue('I' .  ($app_row + 4), '25 Kg/Jrg');
            $objPHPExcel->mergeCells('I' . ($app_row + 5) . ':K' .  ($app_row + 5))->setCellValue('I' .  ($app_row + 5), '15 Kg/Jrg');
            $objPHPExcel->mergeCells('I' . ($app_row + 6) . ':K' .  ($app_row + 6))->setCellValue('I' .  ($app_row + 6), '200 Kg/Drum');
            $objPHPExcel->mergeCells('I' . ($app_row + 7) . ':K' .  ($app_row + 7))->setCellValue('I' .  ($app_row + 7), '20 Kg/Pail');
            $objPHPExcel->mergeCells('I' . ($app_row + 8) . ':K' .  ($app_row + 8))->setCellValue('I' .  ($app_row + 8), '200 Kg/Drum');
            $objPHPExcel->mergeCells('I' . ($app_row + 9) . ':K' .  ($app_row + 9))->setCellValue('I' .  ($app_row + 9), '200 Kg/Drum');
            $objPHPExcel->mergeCells('I' . ($app_row + 10) . ':K' .  ($app_row + 10))->setCellValue('I' .  ($app_row + 10), '200 Kg/Drum');
            $objPHPExcel->mergeCells('I' . ($app_row + 11) . ':K' .  ($app_row + 11))->setCellValue('I' .  ($app_row + 11), '200 Kg/Drum');
            $objPHPExcel->mergeCells('I' . ($app_row + 12) . ':K' .  ($app_row + 12))->setCellValue('I' .  ($app_row + 12), '200 Kg/Drum');
            $objPHPExcel->mergeCells('I' . ($app_row + 13) . ':K' .  ($app_row + 13))->setCellValue('I' .  ($app_row + 13), 'Pcs');
            $objPHPExcel->mergeCells('I' . ($app_row + 14) . ':K' .  ($app_row + 14))->setCellValue('I' .  ($app_row + 14), '25 Kg/Jrg');
            $objPHPExcel->getStyle('B' . ($app_row + 1) . ':K' . ($app_row + 14))->applyFromArray($textbold9);

            $objPHPExcel->mergeCells('N' . ($app_row + 1) . ':P' .  ($app_row + 1))->setCellValue('N' .  ($app_row + 1), 'Keterangan :');
            $objPHPExcel->mergeCells('Q' . ($app_row + 2) . ':Z' .  ($app_row + 3))->setCellValue('Q' .  ($app_row + 2), 'Pemakaian bahan kimia dan air tergantung operasional steam dan operasioanal demin di wt turbin.');
            $objPHPExcel->mergeCells('Q' . ($app_row + 4) . ':Z' .  ($app_row + 6))->setCellValue('Q' .  ($app_row + 4), 'Pemakaian bahan kimia terdiri dari pemakaian bahan kimia untuk cooling tower, operasional boiler, dan operasional demin.');
            $objPHPExcel->getStyle('N' . ($app_row + 1) . ':Z' . ($app_row + 6))->applyFromArray($textbold9);

            $objPHPExcel->getStyle('AB' . ($app_row) . ':AS' . ($app_row + 8))->applyFromArray($noborderapv);
            $objPHPExcel->mergeCells('AB' . ($app_row + 8) . ':AG' .  ($app_row + 9))->setCellValue('AB' .  ($app_row + 8), 'Dibuat Oleh,');
            $objPHPExcel->mergeCells('AH' . ($app_row + 8) . ':AM' . ($app_row + 9))->setCellValue('AH' .  ($app_row + 8), 'Diketahui Oleh,');
            $objPHPExcel->mergeCells('AN' . ($app_row + 8) . ':AS' . ($app_row + 9))->setCellValue('AN' . ($app_row + 8), 'Disetujui Oleh,');

            $objPHPExcel->mergeCells('AB' . ($app_row + 10) . ':AG' .  ($app_row + 13))->setCellValue('AB' . ($app_row + 10), '');
            $objPHPExcel->mergeCells('AH' . ($app_row + 10) . ':AM' . ($app_row + 13))->setCellValue('AH' . ($app_row + 10), '');
            $objPHPExcel->mergeCells('AN' . ($app_row + 10) . ':AS' . ($app_row + 13))->setCellValue('AN' . ($app_row + 10), '');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AB' . ($app_row + 8) . ':AS' . ($app_row + 14));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AT' . ($app_row - 2) . ':AT' . ($app_row + 14));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row - 2) . ':A' . ($app_row + 14));

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
                    $sign_img->setCoordinates('AC' . ($app_row + 10));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AC' . ($app_row + 10));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AC' . ($app_row + 10));
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
                    $sign_img2->setCoordinates('AI' . ($app_row + 10));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('AI' . ($app_row + 10));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AI' . ($app_row + 10));
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
                    $sign_img3->setCoordinates('AO' . ($app_row + 10));
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('AO' . ($app_row + 10));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AO' . ($app_row + 10));
                }
            }

            $objPHPExcel->mergeCells('AB' . ($app_row + 14) . ':AC' . ($app_row + 14))->setCellValue('AB' . ($app_row + 14), 'Nama');
            $objPHPExcel->mergeCells('AD' . ($app_row + 14) . ':AG' . ($app_row + 14))->setCellValue('AD' . ($app_row + 14), ': ' . $app1_by);
            $objPHPExcel->mergeCells('AB' . ($app_row + 15) . ':AC' . ($app_row + 15))->setCellValue('AB' . ($app_row + 15), 'Jabatan');
            $objPHPExcel->mergeCells('AD' . ($app_row + 15) . ':AG' . ($app_row + 15))->setCellValue('AD' . ($app_row + 15), ': ' . $app1_position);
            $objPHPExcel->mergeCells('AB' . ($app_row + 16) . ':AC' . ($app_row + 16))->setCellValue('AB' . ($app_row + 16), 'Tanggal');
            $objPHPExcel->mergeCells('AD' . ($app_row + 16) . ':AG' . ($app_row + 16))->setCellValue('AD' . ($app_row + 16), ': ' . $app1date);

            $objPHPExcel->mergeCells('AH' . ($app_row + 14) . ':AI' . ($app_row + 14))->setCellValue('AH' . ($app_row + 14), 'Nama');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 14) . ':AM' . ($app_row + 14))->setCellValue('AJ' . ($app_row + 14), ': ' . $app2_by);
            $objPHPExcel->mergeCells('AH' . ($app_row + 15) . ':AI' . ($app_row + 15))->setCellValue('AH' . ($app_row + 15), 'Jabatan');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 15) . ':AM' . ($app_row + 15))->setCellValue('AJ' . ($app_row + 15), ': ' . $app2_position);
            $objPHPExcel->mergeCells('AH' . ($app_row + 16) . ':AI' . ($app_row + 16))->setCellValue('AH' . ($app_row + 16), 'Tanggal');
            $objPHPExcel->mergeCells('AJ' . ($app_row + 16) . ':AM' . ($app_row + 16))->setCellValue('AJ' . ($app_row + 16), ': ' . $app2date);

            $objPHPExcel->mergeCells('AN' . ($app_row + 14) . ':AO' . ($app_row + 14))->setCellValue('AN' . ($app_row + 14), 'Nama');
            $objPHPExcel->mergeCells('AP' . ($app_row + 14) . ':AS' . ($app_row + 14))->setCellValue('AP' . ($app_row + 14), ': ' . $app3_by);
            $objPHPExcel->mergeCells('AN' . ($app_row + 15) . ':AO' . ($app_row + 15))->setCellValue('AN' . ($app_row + 15), 'Jabatan');
            $objPHPExcel->mergeCells('AP' . ($app_row + 15) . ':AS' . ($app_row + 15))->setCellValue('AP' . ($app_row + 15), ': ' . $app3_position);
            $objPHPExcel->mergeCells('AN' . ($app_row + 16) . ':AO' . ($app_row + 16))->setCellValue('AN' . ($app_row + 16), 'Tanggal');
            $objPHPExcel->mergeCells('AP' . ($app_row + 16) . ':AS' . ($app_row + 16))->setCellValue('AP' . ($app_row + 16), ': ' . $app3date);


            $objPHPExcel->setSharedStyle($noborderStyle, 'AB' . ($app_row + 14) . ':AS' . ($app_row + 16));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AB' . ($app_row + 14) . ':AB' . ($app_row + 16));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AH' . ($app_row + 14) . ':AH' . ($app_row + 16));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AN' . ($app_row + 14) . ':AN' . ($app_row + 16));
            $objPHPExcel->setSharedStyle($noborderStyle, 'AL' . ($app_row + 14) . ':AL' . ($app_row + 16));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 14) . ':A' . ($app_row + 16));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AL' . ($app_row + 14) . ':AL' . ($app_row + 16));

            $objPHPExcel->getStyle('AB' . ($app_row + 14) . ':AS' . ($app_row + 16))->getFont()->setBold(true);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AS' . ($app_row + 14) . ':AS' . ($app_row + 16));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AT' . ($app_row + 14) . ':AT' . ($app_row + 16));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 14) . ':A' . ($app_row + 16));

            $start_row3 = $app_row + 16;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('R' . ($start_row3 + 1) . ':AT' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($start_row3 + 1) . ':AT' . ($start_row3 + 1))->setCellValue('R' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($start_row3 + 1) . ':AT' . ($start_row3 + 1));
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
