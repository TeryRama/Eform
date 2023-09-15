<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_frmfss187_00 extends CI_Controller
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

        $dtheader = $this->M_formfrmfss187_00->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date          = $dtheaderrow->create_date; //2021-02-08

            $create_date            = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno                  = $dtheaderrow->docno;
            $deptabbr               = $dtheaderrow->deptabbr;
            $minggu                 = $dtheaderrow->minggu;

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
            $dtdetail   = $this->M_formfrmfss187_00->get_detail_byidx($this->header_id);
        } else {
            $dtdetail   = $this->M_formfrmfss187_00->get_detail_byid($this->header_id);
        }

        $no = 1;
        foreach ($dtdetail as $dtdetail_row) {

            $nomor[]                          = $no++;
            $point[]                          = $this->M_formfrmfss187_00->get_item_by($dtdetail_row->point)->item1;
            $kode[]                           = $this->M_formfrmfss187_00->get_item2_by($dtdetail_row->kode)->item2;
            $area[]                           = trim($dtdetail_row->area);
            $temuan[]                         = trim($dtdetail_row->temuan);
            $tindakan_koreksi[]               = trim($dtdetail_row->tindakan_koreksi);
            $pj_id_dilakukan[]                = trim($dtdetail_row->pj_id_dilakukan);
            $pj_personalstatus_dilakukan[]    = trim($dtdetail_row->pj_personalstatus_dilakukan);
            $pj_personalid_dilakukan[]        = trim($dtdetail_row->pj_personalid_dilakukan);
            $pj_nik_dilakukan[]               = trim($dtdetail_row->pj_nik_dilakukan);
            $pj_nama_dilakukan[]              = trim($dtdetail_row->pj_nama_dilakukan);
            $pj_id_dicek[]                    = trim($dtdetail_row->pj_id_dicek);
            $pj_personalstatus_dicek[]        = trim($dtdetail_row->pj_personalstatus_dicek);
            $pj_personalid_dicek[]            = trim($dtdetail_row->pj_personalid_dicek);
            $pj_nik_dicek[]                   = trim($dtdetail_row->pj_nik_dicek);
            $pj_nama_dicek[]                  = trim($dtdetail_row->pj_nama_dicek);
            $pj_id_verfikasi[]                = trim($dtdetail_row->pj_id_verfikasi);
            $pj_personalstatus_verfikasi[]    = trim($dtdetail_row->pj_personalstatus_verfikasi);
            $pj_personalid_verfikasi[]        = trim($dtdetail_row->pj_personalid_verfikasi);
            $pj_nik_verfikasi[]               = trim($dtdetail_row->pj_nik_verfikasi);
            $pj_nama_verfikasi[]              = trim($dtdetail_row->pj_nama_verfikasi);
            $gagal_lulus[]                    = trim($dtdetail_row->gagal_lulus);
        }

        //end Get dtheader
        // style
        $PTStyle                   = new PHPExcel_Style();
        $headerStyle               = new PHPExcel_Style();
        $headerStyleRight           = new PHPExcel_Style();
        $headerStyleLeftTop        = new PHPExcel_Style();
        $headerStyleRightTop       = new PHPExcel_Style();
        $headerStyleLeftBottomTop  = new PHPExcel_Style();
        $headerStyleRightBottomTop = new PHPExcel_Style();
        $DetailheaderStyle         = new PHPExcel_Style();
        $bodyStyle                 = new PHPExcel_Style();
        $bodyStyleAlignLeft        = new PHPExcel_Style();
        $noborderStyle             = new PHPExcel_Style();
        $bodyStyleLeft             = new PHPExcel_Style();
        $headerStyleLeft            = new PHPExcel_Style();
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
        $noborderStyle->applyFromArray($this->xls->noborderStyle);
        $bodyStyleLeft->applyFromArray($this->xls->bodyStyleLeft);
        $headerStyleLeft->applyFromArray($this->xls->headerStyleLeft);
        $headerStyleRight->applyFromArray($this->xls->headerStyleRight);
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
        // $objPHPExcel->getPageSetup()->setScale(65);
        
        $objPHPExcel->getPageSetup()->setFitToPage(true);
        $objPHPExcel->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getPageSetup()->setFitToHeight(0);
        $objPHPExcel->getPageMargins()->setLeft(0.2);
        $objPHPExcel->getPageMargins()->setRight(0.2);
        $objPHPExcel->getPageMargins()->setBottom(0.2);
        $objPHPExcel->getPageMargins()->setTop(0.2);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);

        $range = array();
        $rangeCol = "BZ";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(3);
        }

        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(15);
        }

        $count1 = count($dtdetail);
        $jml_data_perpage = 14;
        if ($count1 < $jml_data_perpage) {
            $jml_page_a = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page_a = $count1 / $jml_data_perpage;
            } else {
                $jml_page_a = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }
        $jml_row_perpage  = $count1 + 19;


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


            $objPHPExcel->mergeCells('A' .   $start_row . ':D' . ($start_row + 1));
            $objPHPExcel->mergeCells('E' .   $start_row . ':BN' . ($start_row + 1))->setCellValue('E' . $start_row,  $this->frmcop);

            $objPHPExcel->mergeCells('BO' .  $start_row . ':BQ' . $start_row)->setCellValue('BO' . $start_row, 'Doc');
            $objPHPExcel->mergeCells('BR' .  $start_row . ':BX' . $start_row)->setCellValue('BR' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('BO' . ($start_row + 1) . ':BQ' . ($start_row + 1))->setCellValue('BO' . ($start_row + 1), 'Date');
            $objPHPExcel->mergeCells('BR' . ($start_row + 1) . ':BX' . ($start_row + 1))->setCellValue('BR' . ($start_row + 1), ':' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' .  ($start_row + 2) . ':D' .  ($start_row + 2))->setCellValue('A' .  ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' .  ($start_row + 2) . ':BN' . ($start_row + 2))->setCellValue('E' .  ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('BO' . ($start_row + 2) . ':BQ' . ($start_row + 2))->setCellValue('BO' . ($start_row + 2), 'Week');
            $objPHPExcel->mergeCells('BR' . ($start_row + 2) . ':BX' . ($start_row + 2))->setCellValue('BR' . ($start_row + 2), ': '.$minggu);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row .      ':D' .  ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':BX' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':BX' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':BN' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'BO' . ($start_row) . ':BX' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'BR' .  $start_row  . ':BX' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'BO' . ($start_row + 2) . ':BX' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'BR' . ($start_row + 2) . ':BX' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':BN' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 2));
            $objPHPExcel->getStyle('AM' . ($start_row) . ':BX' . ($start_row))->getFont()->setSize(10);

            $objPHPExcel->mergeCells('B' .  ($start_row + 4) . ':C' .  ($start_row + 5))->setCellValue('B' .  ($start_row + 4), "No");
            $objPHPExcel->mergeCells('D' .  ($start_row + 4) . ':K' .  ($start_row + 5))->setCellValue('D' .  ($start_row + 4), "Point");
            $objPHPExcel->mergeCells('L' .  ($start_row + 4) . ':Q' .  ($start_row + 5))->setCellValue('L' .  ($start_row + 4), "Kode");
            $objPHPExcel->mergeCells('R' .  ($start_row + 4) . ':U' . ($start_row + 5))->setCellValue('R' .  ($start_row + 4), "Area");
            $objPHPExcel->mergeCells('V' . ($start_row + 4) . ':AH' . ($start_row + 5))->setCellValue('V' . ($start_row + 4), "Temuan");
            $objPHPExcel->mergeCells('AI' . ($start_row + 4) . ':AU' . ($start_row + 5))->setCellValue('AI' . ($start_row + 4), "Tindakan Koreksi");

            $objPHPExcel->mergeCells('AV' . ($start_row + 4) . ':BC' . ($start_row + 4))->setCellValue('AV' . ($start_row + 4), "Dilakukan oleh,");
            $objPHPExcel->mergeCells('AV' . ($start_row + 5) . ':AZ' . ($start_row + 5))->setCellValue('AV' . ($start_row + 5), "Nama");
            $objPHPExcel->mergeCells('BA' . ($start_row + 5) . ':BC' . ($start_row + 5))->setCellValue('BA' . ($start_row + 5), "Ttd");

            $objPHPExcel->mergeCells('BD' . ($start_row + 4) . ':BK' . ($start_row + 4))->setCellValue('BD' . ($start_row + 4), "Dicek oleh,");
            $objPHPExcel->mergeCells('BD' . ($start_row + 5) . ':BH' . ($start_row + 5))->setCellValue('BD' . ($start_row + 5), "Nama");
            $objPHPExcel->mergeCells('BI' . ($start_row + 5) . ':BK' . ($start_row + 5))->setCellValue('BI' . ($start_row + 5), "Ttd");

            $objPHPExcel->mergeCells('BL' . ($start_row + 4) . ':BW' . ($start_row + 4))->setCellValue('BL' . ($start_row + 4), "Diverfikasi,");
            $objPHPExcel->mergeCells('BL' . ($start_row + 5) . ':BP' . ($start_row + 5))->setCellValue('BL' . ($start_row + 5), "Nama");
            $objPHPExcel->mergeCells('BQ' . ($start_row + 5) . ':BS' . ($start_row + 5))->setCellValue('BQ' . ($start_row + 5), "Ttd");

            $objPHPExcel->mergeCells('BT' . ($start_row + 5) . ':BW' . ($start_row + 5))->setCellValue('BT' . ($start_row + 5), "Gagal/Lulus*)");

            $objPHPExcel->setSharedStyle($headerStyleRight, 'BX' . ($start_row + 3) . ':BX' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row + 3) . ':A' .  ($start_row + 5));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($start_row + 4) . ':BW' . ($start_row + 5));
            // $objPHPExcel->getStyle('B' . ($start_row + 4) . ':AQ' . ($start_row + 5))->getFont()->setBold(true)->setSize(9);


            $dtl_row = $start_row + 6;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {
                $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(23);

                $dt_nomor[$a]                         = $nomor[$a] ?? "";
                $dt_point[$a]                         = $point[$a] ?? "";
                $dt_kode[$a]                          = $kode[$a] ?? "";
                $dt_area[$a]                          = $area[$a] ?? "";
                $dt_temuan[$a]                        = $temuan[$a] ?? "";
                $dt_tindakan_koreksi[$a]              = $tindakan_koreksi[$a] ?? "";
                $dt_pj_id_dilakukan[$a]               = $pj_id_dilakukan[$a] ?? "";
                $dt_pj_personalstatus_dilakukan[$a]   = $pj_personalstatus_dilakukan[$a] ?? "";
                $dt_pj_personalid_dilakukan[$a]       = $pj_personalid_dilakukan[$a] ?? "";
                $dt_pj_nik_dilakukan[$a]              = $pj_nik_dilakukan[$a] ?? "";
                $dt_pj_nama_dilakukan[$a]             = $pj_nama_dilakukan[$a] ?? "";
                $dt_pj_id_dicek[$a]                   = $pj_id_dicek[$a] ?? "";
                $dt_pj_personalstatus_dicek[$a]       = $pj_personalstatus_dicek[$a] ?? "";
                $dt_pj_personalid_dicek[$a]           = $pj_personalid_dicek[$a] ?? "";
                $dt_pj_nik_dicek[$a]                  = $pj_nik_dicek[$a] ?? "";
                $dt_pj_nama_dicek[$a]                 = $pj_nama_dicek[$a] ?? "";
                $dt_pj_id_verfikasi[$a]               = $pj_id_verfikasi[$a] ?? "";
                $dt_pj_personalstatus_verfikasi[$a]   = $pj_personalstatus_verfikasi[$a] ?? "";
                $dt_pj_personalid_verfikasi[$a]       = $pj_personalid_verfikasi[$a] ?? "";
                $dt_pj_nik_verfikasi[$a]              = $pj_nik_verfikasi[$a] ?? "";
                $dt_pj_nama_verfikasi[$a]             = $pj_nama_verfikasi[$a] ?? "";
                $dt_gagal_lulus[$a]                   = $gagal_lulus[$a] ?? "";

                $objPHPExcel->mergeCells('B' .  ($dtl_row) . ':C' .  ($dtl_row))->setCellValue('B' .  ($dtl_row), $dt_nomor[$a]);
                $objPHPExcel->mergeCells('D' .  ($dtl_row) . ':K' .  ($dtl_row))->setCellValue('D' .  ($dtl_row), $dt_point[$a]);
                $objPHPExcel->mergeCells('L' .  ($dtl_row) . ':Q' .  ($dtl_row))->setCellValue('L' .  ($dtl_row), $dt_kode[$a]);
                $objPHPExcel->mergeCells('R' .  ($dtl_row) . ':U' . ($dtl_row))->setCellValue('R' .  ($dtl_row), $dt_area[$a]);
                $objPHPExcel->mergeCells('V' . ($dtl_row) . ':AH' . ($dtl_row))->setCellValue('V' . ($dtl_row), $dt_temuan[$a]);
                $objPHPExcel->mergeCells('AI' . ($dtl_row) . ':AU' . ($dtl_row))->setCellValue('AI' . ($dtl_row), $dt_tindakan_koreksi[$a]);
                $objPHPExcel->mergeCells('AV' . ($dtl_row) . ':AZ' . ($dtl_row))->setCellValue('AV' . ($dtl_row), $dt_pj_nama_dilakukan[$a]);
                $objPHPExcel->mergeCells('BA' . ($dtl_row) . ':BC' . ($dtl_row))->setCellValue('BA' . ($dtl_row), '');
                $objPHPExcel->mergeCells('BD' . ($dtl_row) . ':BH' . ($dtl_row))->setCellValue('BD' . ($dtl_row), $dt_pj_nama_dicek[$a]);
                $objPHPExcel->mergeCells('BI' . ($dtl_row) . ':BK' . ($dtl_row))->setCellValue('BI' . ($dtl_row), '');
                $objPHPExcel->mergeCells('BL' . ($dtl_row) . ':BP' . ($dtl_row))->setCellValue('BL' . ($dtl_row), $dt_pj_nama_verfikasi[$a]);
                $objPHPExcel->mergeCells('BQ' . ($dtl_row) . ':BS' . ($dtl_row))->setCellValue('BQ' . ($dtl_row), '');
                $objPHPExcel->mergeCells('BT' . ($dtl_row) . ':BW' . ($dtl_row))->setCellValue('BT' . ($dtl_row), $dt_gagal_lulus[$a]);

                $arr_pj = ['dilakukan','dicek','verfikasi'];
                $col_pj = ['BA','BI','BQ'];
                for ($i_pj=0; $i_pj < count($arr_pj); $i_pj++) { 
                    if (${'dt_pj_personalstatus_'.$arr_pj[$i_pj]}[$a] == '2') {
                        $imageurlapp1 = '/forviewfoto_pekerja/TTD_TK/';
                        $imageformatapp1 = '.png';
                    } else if (${'dt_pj_personalstatus_'.$arr_pj[$i_pj]}[$a] == '1') {
                        $imageurlapp1 = '/forviewfoto_pekerja/';
                        $imageformatapp1 = '_0_0.png';
                    } else {
                        $imageurlapp1 = '';
                        $imageformatapp1 = '';
                    }

                    $fcpath2   = str_replace('utl/', '', FCPATH);

                    $sign_img  = '$objDrawing' . $i1;
                    if (file_exists($fcpath2 . 'utl/assets/ttd/' . ${'dt_pj_personalstatus_'.$arr_pj[$i_pj]}[$a] . '_' . ${'dt_pj_personalid_'.$arr_pj[$i_pj]}[$a] . '.png')) {
                        $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(45);
                        $sign_img = new PHPExcel_Worksheet_Drawing();
                        $sign_img->setPath('assets/ttd/' . ${'dt_pj_personalstatus_'.$arr_pj[$i_pj]}[$a] . '_' . ${'dt_pj_personalid_'.$arr_pj[$i_pj]}[$a] . '.png');
                        $sign_img->setWidthAndHeight(58, 65);
                        $sign_img->setResizeProportional(true);
                        $sign_img->setWorksheet($objPHPExcel);
                        $sign_img->setCoordinates($col_pj[$i_pj] . ($dtl_row))->setOffsetY(3)->setOffsetX(4);
                    } else if (${'dt_pj_personalid_'.$arr_pj[$i_pj]}[$a] != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . ${'dt_pj_personalid_'.$arr_pj[$i_pj]}[$a] . $imageformatapp1)) {
                        $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(45);
                        $sign_img = new PHPExcel_Worksheet_Drawing();
                        $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . ${'dt_pj_personalid_'.$arr_pj[$i_pj]}[$a] . $imageformatapp1);
                        $sign_img->setWidthAndHeight(58, 65);
                        $sign_img->setResizeProportional(true);
                        $sign_img->setWorksheet($objPHPExcel);
                        $sign_img->setCoordinates($col_pj[$i_pj] . ($dtl_row))->setOffsetY(3)->setOffsetX(4);
                    } else if(!empty(${'dt_pj_personalid_'.$arr_pj[$i_pj]}[$a])){
                        $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(45);
                        $sign_img = new PHPExcel_Worksheet_Drawing();
                        $sign_img->setPath('assets/images/approved.png');
                        $sign_img->setWidthAndHeight(70, 70);
                        $sign_img->setResizeProportional(true);
                        $sign_img->setWorksheet($objPHPExcel);
                        $sign_img->setCoordinates($col_pj[$i_pj] . ($dtl_row))->setOffsetY(3)->setOffsetX(4);
                    }
                }

                $objPHPExcel->setSharedStyle($bodyStyle,  'B' .  ($dtl_row) . ':BW' .  ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft,  'C' .  ($dtl_row) . ':K' .  ($dtl_row));
                $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row) . ':A' .  ($dtl_row));
                $objPHPExcel->setSharedStyle($headerStyleRight, 'BX' . ($dtl_row) . ':BX' . ($dtl_row));
                $dtl_row++;
            }
            $app_row = $dtl_row + 1;

            $objPHPExcel->mergeCells('B' . ($app_row) . ':O' .  ($app_row + 1))->setCellValue('B' .  ($app_row), 'Diperiksa Oleh,');
            $objPHPExcel->mergeCells('P' . ($app_row) . ':AC' . ($app_row + 1))->setCellValue('P' .  ($app_row), 'Disetujui Oleh,');

            $objPHPExcel->mergeCells('B' . ($app_row + 2) . ':O' .  ($app_row + 6))->setCellValue('B' . ($app_row + 2), '');
            $objPHPExcel->mergeCells('P' . ($app_row + 2) . ':AC' . ($app_row + 6))->setCellValue('V' . ($app_row + 2), '');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($app_row) . ':AC' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BX' . ($app_row-1) . ':BX' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row-1) . ':A' . ($app_row + 6));


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
                    $sign_img->setCoordinates('F' . ($app_row + 3));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('F' . ($app_row + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('E' . ($app_row + 2));
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
                    $sign_img2->setCoordinates('U' . ($app_row + 3));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('U' . ($app_row + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('U' . ($app_row + 2));
                }
            }

            $objPHPExcel->mergeCells('B' . ($app_row + 7) . ':D' . ($app_row + 7))->setCellValue('B' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('E' . ($app_row + 7) . ':O' . ($app_row + 7))->setCellValue('E' . ($app_row + 7), ': ' . $app1_by);
            $objPHPExcel->mergeCells('B' . ($app_row + 8) . ':D' . ($app_row + 8))->setCellValue('B' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('E' . ($app_row + 8) . ':O' . ($app_row + 8))->setCellValue('E' . ($app_row + 8), ': ' . $app1_position);
            $objPHPExcel->mergeCells('B' . ($app_row + 9) . ':D' . ($app_row + 9))->setCellValue('B' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('E' . ($app_row + 9) . ':O' . ($app_row + 9))->setCellValue('E' . ($app_row + 9), ': ' . $app1date);

            $objPHPExcel->mergeCells('P' . ($app_row + 7) . ':R' . ($app_row + 7))->setCellValue('P' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('S' . ($app_row + 7) . ':AC' . ($app_row + 7))->setCellValue('S' . ($app_row + 7), ': ' . $app2_by);
            $objPHPExcel->mergeCells('P' . ($app_row + 8) . ':R' . ($app_row + 8))->setCellValue('P' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('S' . ($app_row + 8) . ':AC' . ($app_row + 8))->setCellValue('S' . ($app_row + 8), ': ' . $app2_position);
            $objPHPExcel->mergeCells('P' . ($app_row + 9) . ':R' . ($app_row + 9))->setCellValue('P' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('S' . ($app_row + 9) . ':AC' . ($app_row + 9))->setCellValue('S' . ($app_row + 9), ': ' . $app2date);

            $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($app_row + 7) . ':AQ' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'B' . ($app_row + 7) . ':B' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'P' . ($app_row + 7) . ':P' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AC' . ($app_row + 7) . ':AC' . ($app_row + 9));

            $objPHPExcel->getStyle('B' . ($app_row + 7) . ':AC' . ($app_row + 9))->getFont()->setBold(true);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'BX' . ($app_row + 7) . ':BX' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));

            $start_row3 = $app_row + 9;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('R' . ($start_row3 + 1) . ':BX' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($start_row3 + 1) . ':BX' . ($start_row3 + 1))->setCellValue('R' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($start_row3 + 1) . ':BX' . ($start_row3 + 1));
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
