<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_inttbn022_06 extends CI_Controller
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
        $frmkode                  = $this->uri->segment(4);
        $frmvrs                   = $this->uri->segment(5);
        $this->header_id          = $this->uri->segment(6);
        $dtfrm                    = $this->M_forminput->get_dtform($frmkode, $frmvrs);

        foreach ($dtfrm as $datafrm) {
            $this->frmkd          = $datafrm->formkd;
            $this->frmjdl         = $datafrm->formjudul;
            $this->frmnm          = $datafrm->formnm;
            $this->frmver         = $datafrm->formversi;
            $this->frmefective    = date("d.m.Y", strtotime($datafrm->formefective));
        }

        $dtheader = $this->M_forminttbn022_06->get_header_byid($this->header_id);

        if (isset($dtheader)) {
            foreach ($dtheader as $dtheader_row) {
                $dtcreate_date   = $dtheader_row->create_date;
                $create_date     = date("d-m-Y", strtotime($dtheader_row->create_date));
                $docno           = $dtheader_row->docno;
                $notification    = $dtheader_row->notification;
                $shift_1         = $dtheader_row->shift_1;
                $shift_2         = $dtheader_row->shift_2;
                $shift_3         = $dtheader_row->shift_3;
                $total_usedwater = $dtheader_row->total_usedwater;

                $app1_by             = $dtheader_row->app1_by;
                $app2_by             = $dtheader_row->app2_by;
                $app3_by             = $dtheader_row->app3_by;
                $app4_by             = $dtheader_row->app4_by;
                $app5_by             = $dtheader_row->app5_by;

                $app1_position       = $dtheader_row->app1_position;
                $app2_position       = $dtheader_row->app2_position;
                $app3_position       = $dtheader_row->app3_position;
                $app4_position       = $dtheader_row->app4_position;
                $app5_position       = $dtheader_row->app5_position;

                $app1_personalid     = $dtheader_row->app1_personalid;
                $app2_personalid     = $dtheader_row->app2_personalid;
                $app3_personalid     = $dtheader_row->app3_personalid;
                $app4_personalid     = $dtheader_row->app4_personalid;
                $app5_personalid     = $dtheader_row->app5_personalid;

                $app1_personalstatus = $dtheader_row->app1_personalstatus;
                $app2_personalstatus = $dtheader_row->app2_personalstatus;
                $app3_personalstatus = $dtheader_row->app3_personalstatus;
                $app4_personalstatus = $dtheader_row->app4_personalstatus;
                $app5_personalstatus = $dtheader_row->app5_personalstatus;

                $app1date             = $dtheader_row->app1_date;
                $app2date             = $dtheader_row->app2_date;
                $app3date             = $dtheader_row->app3_date;
                $app4date             = $dtheader_row->app4_date;
                $app5date             = $dtheader_row->app5_date;


                if (trim($dtheader_row->app1date) != '') {
                    $app1date       = date('d-m-Y', strtotime($dtheader_row->app1date));
                } else {
                    $app1_date = '';
                }
                if (trim($dtheader_row->app2date) != '') {
                    $app2date       = date('d-m-Y', strtotime($dtheader_row->app2date));
                } else {
                    $app2_date = '';
                }
                if (trim($dtheader_row->app3date) != '') {
                    $app3date       = date('d-m-Y', strtotime($dtheader_row->app3date));
                } else {
                    $app3_date = '';
                }
                if (trim($dtheader_row->app4date) != '') {
                    $app4date       = date('d-m-Y', strtotime($dtheader_row->app4date));
                } else {
                    $app4_date = '';
                }
                if (trim($dtheader_row->app5date) != '') {
                    $app5date       = date('d-m-Y', strtotime($dtheader_row->app5date));
                } else {
                    $app5_date = '';
                }
            }
        }

        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail   = $this->M_forminttbn022_06->get_detail_byidx($this->header_id);
            $dtdetail_b   = $this->M_forminttbn022_06->get_detail_byid_bx($this->header_id);
            $dtdetail_c   = $this->M_forminttbn022_06->get_detail_byid_cx($this->header_id);
            $dtdetail_d   = $this->M_forminttbn022_06->get_detail_byid_dx($this->header_id);
            $dtdetail_e   = $this->M_forminttbn022_06->get_detail_byid_ex($this->header_id);
            $dtdetail_f   = $this->M_forminttbn022_06->get_detail_byid_fx($this->header_id);
            $dtdetail_g   = $this->M_forminttbn022_06->get_detail_byid_gx($this->header_id);
        } else {
            $dtdetail   = $this->M_forminttbn022_06->get_detail_byid($this->header_id);
            $dtdetail_b   = $this->M_forminttbn022_06->get_detail_byid_b($this->header_id);
            $dtdetail_c   = $this->M_forminttbn022_06->get_detail_byid_c($this->header_id);
            $dtdetail_d   = $this->M_forminttbn022_06->get_detail_byid_d($this->header_id);
            $dtdetail_e   = $this->M_forminttbn022_06->get_detail_byid_e($this->header_id);
            $dtdetail_f   = $this->M_forminttbn022_06->get_detail_byid_f($this->header_id);
            $dtdetail_g   = $this->M_forminttbn022_06->get_detail_byid_g($this->header_id);
        }

        foreach ($dtdetail as $row) {
            $a1_time[]            = $row->a1_time;
            $a1_alkalinity[]      = $row->a1_alkalinity;
            $a1_ph[]              = $row->a1_ph;
            $a1_conductivity[]    = $row->a1_conductivity;
            $a1_thardness[]       = $row->a1_thardness;
            $a1_dissolvedoxygen[] = $row->a1_dissolvedoxygen;
            $a1_silica[]          = $row->a1_silica;
            $a1_fe[]              = $row->a1_fe;
            $a2_time[]            = $row->a2_time;
            $a2_alkalinityp[]     = $row->a2_alkalinityp;
            $a2_alkalinitym[]     = $row->a2_alkalinitym;
            $a2_ph[]              = $row->a2_ph;
            $a2_conductivity[]    = $row->a2_conductivity;
            $a2_ion[]             = $row->a2_ion;
            $a2_silica[]          = $row->a2_silica;
            $a3_time[]            = $row->a3_time;
            $a3_ph[]              = $row->a3_ph;
            $a3_conductivity[]    = $row->a3_conductivity;
            $a3_silica[]          = $row->a3_silica;
            $a3_fe[]              = $row->a3_fe;
            $a4_time[]            = $row->a4_time;
            $a4_ph[]              = $row->a4_ph;
            $a4_conductivity[]    = $row->a4_conductivity;
            $a4_silica[]          = $row->a4_silica;
            $a4_fe[]              = $row->a4_fe;
        }

        foreach ($dtdetail_b as $row) {
            $b1_time[]            = $row->b1_time;
            $b1_alkalinity[]      = $row->b1_alkalinity;
            $b1_ph[]              = $row->b1_ph;
            $b1_conductivity[]    = $row->b1_conductivity;
            $b1_thardness[]       = $row->b1_thardness;
            $b1_dissolvedoxygen[] = $row->b1_dissolvedoxygen;
            $b1_silica[]          = $row->b1_silica;
            $b1_fe[]              = $row->b1_fe;
            $b2_time[]            = $row->b2_time;
            $b2_alkalinityp[]     = $row->b2_alkalinityp;
            $b2_alkalinitym[]     = $row->b2_alkalinitym;
            $b2_ph[]              = $row->b2_ph;
            $b2_conductivity[]    = $row->b2_conductivity;
            $b2_ion[]             = $row->b2_ion;
            $b2_silica[]          = $row->b2_silica;
            $b3_time[]            = $row->b3_time;
            $b3_ph[]              = $row->b3_ph;
            $b3_conductivity[]    = $row->b3_conductivity;
            $b3_silica[]          = $row->b3_silica;
            $b3_fe[]              = $row->b3_fe;
            $b4_time[]            = $row->b4_time;
            $b4_ph[]              = $row->b4_ph;
            $b4_conductivity[]    = $row->b4_conductivity;
            $b4_silica[]          = $row->b4_silica;
            $b4_fe[]              = $row->b4_fe;
        }

        foreach ($dtdetail_c as $row) {
            $c1_time[]            = $row->c1_time;
            $c1_alkalinity[]      = $row->c1_alkalinity;
            $c1_ph[]              = $row->c1_ph;
            $c1_conductivity[]    = $row->c1_conductivity;
            $c1_thardness[]       = $row->c1_thardness;
            $c1_dissolvedoxygen[] = $row->c1_dissolvedoxygen;
            $c1_silica[]          = $row->c1_silica;
            $c1_fe[]              = $row->c1_fe;
            $c2_time[]            = $row->c2_time;
            $c2_alkalinityp[]     = $row->c2_alkalinityp;
            $c2_alkalinitym[]     = $row->c2_alkalinitym;
            $c2_ph[]              = $row->c2_ph;
            $c2_conductivity[]    = $row->c2_conductivity;
            $c2_ion[]             = $row->c2_ion;
            $c2_silica[]          = $row->c2_silica;
            $c3_time[]            = $row->c3_time;
            $c3_ph[]              = $row->c3_ph;
            $c3_conductivity[]    = $row->c3_conductivity;
            $c3_silica[]          = $row->c3_silica;
            $c3_fe[]              = $row->c3_fe;
            $c4_time[]            = $row->c4_time;
            $c4_ph[]              = $row->c4_ph;
            $c4_conductivity[]    = $row->c4_conductivity;
            $c4_silica[]          = $row->c4_silica;
            $c4_fe[]              = $row->c4_fe;
            $c5_time[]            = $row->c5_time;
            $c5_conductivity[]    = $row->c5_conductivity;
            $c5_thardness[]       = $row->c5_thardness;
            $c5_ph[]              = $row->c5_ph;
        }

        foreach ($dtdetail_d as $row) {
            $d1_time[]            = $row->d1_time;
            $d1_thardness[]       = $row->d1_thardness;
            $d1_ph[]              = $row->d1_ph;
            $d1_conductivity[]    = $row->d1_conductivity;
            $d1_dissolvedoxygen[] = $row->d1_dissolvedoxygen;
            $d1_silica[]          = $row->d1_silica;
            $d1_fe[]              = $row->d1_fe;
            $d2_time[]            = $row->d2_time;
            $d2_thardness[]       = $row->d2_thardness;
            $d2_ph[]              = $row->d2_ph;
            $d2_conductivity[]    = $row->d2_conductivity;
            $d2_dissolvedoxygen[] = $row->d2_dissolvedoxygen;
            $d2_silica[]          = $row->d2_silica;
            $d2_fe[]              = $row->d2_fe;
            $d3_time[]            = $row->d3_time;
            $d3_alkalinity[]      = $row->d3_alkalinity;
            $d3_conductivity[]    = $row->d3_conductivity;
            $d3_thardness[]       = $row->d3_thardness;
            $d3_ph[]              = $row->d3_ph;
            $d3_suhu_inlet[]      = $row->d3_suhu_inlet;
            $d3_suhu_outlet[]     = $row->d3_suhu_outlet;
            $d3_turbuditi[]       = $row->d3_turbuditi;
            $d3_ci[]              = $row->d3_ci;
            $d3_freeci2[]         = $row->d3_freeci2;
            $d4_time[]            = $row->d4_time;
            $d4_thardness[]       = $row->d4_thardness;
            $d4_ph[]              = $row->d4_ph;
            $d4_conductivity[]    = $row->d4_conductivity;
            $d4_turbuditi[]       = $row->d4_turbuditi;
            $d4_ci[]              = $row->d4_ci;
            $d4_freeci2[]         = $row->d4_freeci2;
            $d5_time[]            = $row->d5_time;
            $d5_ph[]              = $row->d5_ph;
            $d5_conductivity[]    = $row->d5_conductivity;
            $d5_hardness[]        = $row->d5_hardness;
        }

        foreach ($dtdetail_e as $row) {
            $e1_time[]         = $row->e1_time;
            $e1_startstop[]    = $row->e1_startstop;
            $e1_turbuditi[]    = $row->e1_turbuditi;
            $e1_pressure[]     = $row->e1_pressure;
            $e1_flowmeter[]    = $row->e1_flowmeter;
            $e1_ph[]           = $row->e1_ph;
            $e1_conductivity[] = $row->e1_conductivity;
            $e2_acidion[]      = $row->e2_acidion;
            $e3_conductivity[] = $row->e3_conductivity;
            $e3_ph[]           = $row->e3_ph;
            $e4_acidion[]      = $row->e4_acidion;
            $e5_conductivity[] = $row->e5_conductivity;
            $e5_ph[]           = $row->e5_ph;
            $e5_silica[]       = $row->e5_silica;
        }

        foreach ($dtdetail_f as $row) {
            $f1_timestart[] = $row->f1_timestart;
            $f1_timestop[]  = $row->f1_timestop;
            $f1_ro[]        = $row->f1_ro;
            $f1_flowstart[] = $row->f1_flowstart;
            $f1_flowstop[]  = $row->f1_flowstop;
            $f1_total[]     = $row->f1_total;
        }

        foreach ($dtdetail_g as $row) {
            $g1_timestart[] = $row->g1_timestart;
            $g1_timestop[] = $row->g1_timestop;
            $g1_note[] = $row->g1_note;
            $g1_flowstart[] = $row->g1_flowstart;
            $g1_flowstop[] = $row->g1_flowstop;
            $g1_total[] = $row->g1_total;
        }

        $jml_data         = count($dtdetail);
        $jml_data_b       = count($dtdetail_b);
        $jml_data_c       = count($dtdetail_c);
        $jml_data_d       = count($dtdetail_d);

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

        $colorpurple = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '9B59B6')
            )
        );
        $colorblue = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '3498DB')
            )
        );

        $noborderleftboldsize12 = array(
            'fill'   => array(
                'type'    => PHPExcel_Style_Fill::FILL_SOLID
            ),
            'font' => array(
                'bold'    => true,
                'name' => 'Times New Roman',
                'size' => 12
            ),
            'numberformat'   => array(
                'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap'       => true
            ),
        );

        $borderleftboldsize9 = array(
            'fill'   => array(
                'type'    => PHPExcel_Style_Fill::FILL_SOLID
            ),
            'font' => array(
                'bold'    => true,
                'name' => 'Times New Roman',
                'size' => 9
            ),
            'numberformat'   => array(
                'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT
            ),
            'borders' => array(
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap'       => true
            ),
        );

        $borderleftsize9 = array(
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
                'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap'       => true
            ),
        );

        $noborderlefttopboldsize9 = array(
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
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP,
                'wrap'       => true
            ),
        );

        $obj = new Excel();
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('assets/images/PSG_logo_2022.png');
        $objPHPExcel = $obj->createSheet(0);
        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getPageSetup()->setFitToPage(false);
        $objPHPExcel->getPageSetup()->setScale(48);
        $objPHPExcel->getPageMargins()->setLeft(0.2);
        $objPHPExcel->getPageMargins()->setRight(0.2);
        $objPHPExcel->getPageMargins()->setBottom(0.2);
        $objPHPExcel->getPageMargins()->setTop(0.2);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);

        $range = array();
        $rangeCol = "CQ";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(3);
        }

        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(20);
        }

        $start_row = 1;
        $gbr = '$objDrawing';
        $gbr = new PHPExcel_Worksheet_Drawing();
        $gbr->setPath('assets/images/PSG_logo_2022.png');
        $gbr->setWidthAndHeight(50, 50);
        $gbr->setWorksheet($objPHPExcel);
        $gbr->setCoordinates('B' . $start_row);

        $objPHPExcel->mergeCells('A' .   $start_row . ':D' . ($start_row + 2));
        $objPHPExcel->mergeCells('E' .   $start_row . ':BN' . ($start_row))->setCellValue('E' . $start_row,  $this->frmcop);
        $objPHPExcel->mergeCells('E' .  ($start_row + 1) . ':BN' . ($start_row + 1))->setCellValue('E' .  ($start_row + 1), 'DEPARTEMENT POWER PLANT (TURBINE)');
        $objPHPExcel->mergeCells('E' .  ($start_row + 2) . ':BN' . ($start_row + 2))->setCellValue('E' .  ($start_row + 2), $this->frmjdl);
        $objPHPExcel->mergeCells('BO' .  $start_row . ':BQ' . $start_row)->setCellValue('BO' . $start_row, 'Date');
        $objPHPExcel->mergeCells('BR' .  $start_row . ':BY' . $start_row)->setCellValue('BR' . $start_row, ': ' . $create_date);
        $objPHPExcel->mergeCells('BO' . ($start_row + 1) . ':BQ' . ($start_row + 1))->setCellValue('BO' . ($start_row + 1), 'Doc');
        $objPHPExcel->mergeCells('BR' . ($start_row + 1) . ':BY' . ($start_row + 1))->setCellValue('BR' . ($start_row + 1), ': ' . $docno);
        $objPHPExcel->mergeCells('BO' . ($start_row + 2) . ':BQ' . ($start_row + 2))->setCellValue('BO' . ($start_row + 2), 'Page');
        $objPHPExcel->mergeCells('BR' . ($start_row + 2) . ':BY' . ($start_row + 2))->setCellValue('BR' . ($start_row + 2), ': ' . 1 . ' of ' . 4);
        $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row .      ':D' .  ($start_row + 2));
        $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':BQ' . ($start_row + 2));
        $objPHPExcel->setSharedStyle($headerStyle, 'BO' .  $start_row  . ':BY' . ($start_row + 2));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row + 3) . ':A' .  ($start_row + 5));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BY' . ($start_row + 3) . ':BY' . ($start_row + 5));

        $hd_row = $start_row + 5;
        $objPHPExcel->mergeCells('B' .  ($hd_row) . ':BX' .  ($hd_row))->setCellValue('B' .  ($hd_row), "Water Analyis Results : BOILER #1");
        $objPHPExcel->mergeCells('B' .  ($hd_row + 1) . ':D' .  ($hd_row + 2))->setCellValue('B' .  ($hd_row + 1), "Sampling Point");
        $objPHPExcel->mergeCells('B' .  ($hd_row + 3) . ':D' .  ($hd_row + 6))->setCellValue('B' .  ($hd_row + 3), "Time");
        $objPHPExcel->mergeCells('E' .  ($hd_row + 1) . ':Y' .  ($hd_row + 1))->setCellValue('E' .  ($hd_row + 1), "Dearator");
        $objPHPExcel->mergeCells('E' .  ($hd_row + 2) . ':Y' .  ($hd_row + 2))->setCellValue('E' .  ($hd_row + 2), "102 - 104 °C");
        $objPHPExcel->mergeCells('E' .  ($hd_row + 3) . ':G' .  ($hd_row + 3))->setCellValue('E' .  ($hd_row + 3), "Alkalinity");
        $objPHPExcel->mergeCells('E' .  ($hd_row + 4) . ':G' .  ($hd_row + 4))->setCellValue('E' .  ($hd_row + 4), "M");
        $objPHPExcel->mergeCells('E' .  ($hd_row + 5) . ':G' .  ($hd_row + 5))->setCellValue('E' .  ($hd_row + 5), "mmol/ L");
        $objPHPExcel->mergeCells('E' .  ($hd_row + 6) . ':G' .  ($hd_row + 6))->setCellValue('E' .  ($hd_row + 6), "≤0.5");
        $objPHPExcel->mergeCells('H' .  ($hd_row + 3) . ':J' .  ($hd_row + 5))->setCellValue('H' .  ($hd_row + 3), "pH");
        $objPHPExcel->mergeCells('H' .  ($hd_row + 6) . ':J' .  ($hd_row + 6))->setCellValue('H' .  ($hd_row + 6), "8.5 -9.3");
        $objPHPExcel->mergeCells('K' .  ($hd_row + 3) . ':M' .  ($hd_row + 4))->setCellValue('K' .  ($hd_row + 3), "Conduc-tivity");
        $objPHPExcel->mergeCells('K' .  ($hd_row + 5) . ':M' .  ($hd_row + 5))->setCellValue('K' .  ($hd_row + 5), "µs/ cm");
        $objPHPExcel->mergeCells('K' .  ($hd_row + 6) . ':M' .  ($hd_row + 6))->setCellValue('K' .  ($hd_row + 6), "≤10");
        $objPHPExcel->mergeCells('N' .  ($hd_row + 3) . ':P' .  ($hd_row + 4))->setCellValue('N' .  ($hd_row + 3), "T. Hardness");
        $objPHPExcel->mergeCells('N' .  ($hd_row + 5) . ':P' .  ($hd_row + 5))->setCellValue('N' .  ($hd_row + 5), "µmol/L");
        $objPHPExcel->mergeCells('N' .  ($hd_row + 6) . ':P' .  ($hd_row + 6))->setCellValue('N' .  ($hd_row + 6), "≤ 15");
        $objPHPExcel->mergeCells('Q' .  ($hd_row + 3) . ':S' .  ($hd_row + 4))->setCellValue('Q' .  ($hd_row + 3), "Dissolved Oxygen");
        $objPHPExcel->mergeCells('Q' .  ($hd_row + 5) . ':S' .  ($hd_row + 5))->setCellValue('Q' .  ($hd_row + 5), "ppb O2");
        $objPHPExcel->mergeCells('Q' .  ($hd_row + 6) . ':S' .  ($hd_row + 6))->setCellValue('Q' .  ($hd_row + 6), "≤ 15");
        $objPHPExcel->mergeCells('T' .  ($hd_row + 3) . ':V' .  ($hd_row + 4))->setCellValue('T' .  ($hd_row + 3), "Silica");
        $objPHPExcel->mergeCells('T' .  ($hd_row + 5) . ':V' .  ($hd_row + 5))->setCellValue('T' .  ($hd_row + 5), "ppm");
        $objPHPExcel->mergeCells('T' .  ($hd_row + 6) . ':V' .  ($hd_row + 6))->setCellValue('T' .  ($hd_row + 6), "0.5 Max");
        $objPHPExcel->mergeCells('W' .  ($hd_row + 3) . ':Y' .  ($hd_row + 4))->setCellValue('W' .  ($hd_row + 3), "Fe");
        $objPHPExcel->mergeCells('W' .  ($hd_row + 5) . ':Y' .  ($hd_row + 5))->setCellValue('W' .  ($hd_row + 5), "ppm");
        $objPHPExcel->mergeCells('W' .  ($hd_row + 6) . ':Y' .  ($hd_row + 6))->setCellValue('W' .  ($hd_row + 6), "≤0,10");

        $objPHPExcel->mergeCells('Z' .  ($hd_row + 1) . ':AB' .  ($hd_row + 2))->setCellValue('Z' .  ($hd_row + 1), "Sampling Point");
        $objPHPExcel->mergeCells('Z' .  ($hd_row + 3) . ':AB' .  ($hd_row + 6))->setCellValue('Z' .  ($hd_row + 3), "Time");
        $objPHPExcel->mergeCells('AC' .  ($hd_row + 1) . ':AT' .  ($hd_row + 1))->setCellValue('AC' .  ($hd_row + 1), "Boiler Water");
        $objPHPExcel->mergeCells('AC' .  ($hd_row + 2) . ':AT' .  ($hd_row + 2))->setCellValue('AC' .  ($hd_row + 2), "120 - 150 °C");
        $objPHPExcel->mergeCells('AC' .  ($hd_row + 3) . ':AH' .  ($hd_row + 3))->setCellValue('AC' .  ($hd_row + 3), "Total Alkalinity");
        $objPHPExcel->mergeCells('AC' .  ($hd_row + 4) . ':AE' .  ($hd_row + 4))->setCellValue('AC' .  ($hd_row + 4), "P");
        $objPHPExcel->mergeCells('AC' .  ($hd_row + 5) . ':AE' .  ($hd_row + 5))->setCellValue('AC' .  ($hd_row + 5), "ppm");
        $objPHPExcel->mergeCells('AC' .  ($hd_row + 6) . ':AE' .  ($hd_row + 6))->setCellValue('AC' .  ($hd_row + 6), "max 50");
        $objPHPExcel->mergeCells('AF' .  ($hd_row + 4) . ':AH' .  ($hd_row + 4))->setCellValue('AF' .  ($hd_row + 4), "M");
        $objPHPExcel->mergeCells('AF' .  ($hd_row + 5) . ':AH' .  ($hd_row + 5))->setCellValue('AF' .  ($hd_row + 5), "ppm");
        $objPHPExcel->mergeCells('AF' .  ($hd_row + 6) . ':AH' .  ($hd_row + 6))->setCellValue('AF' .  ($hd_row + 6), "max 100");
        $objPHPExcel->mergeCells('AI' .  ($hd_row + 3) . ':AK' .  ($hd_row + 5))->setCellValue('AI' .  ($hd_row + 3), "pH");
        $objPHPExcel->mergeCells('AI' .  ($hd_row + 6) . ':AK' .  ($hd_row + 6))->setCellValue('AI' .  ($hd_row + 6), "9,5 - 10,5");
        $objPHPExcel->mergeCells('AL' .  ($hd_row + 3) . ':AN' .  ($hd_row + 4))->setCellValue('AL' .  ($hd_row + 3), "Conductivity");
        $objPHPExcel->mergeCells('AL' .  ($hd_row + 5) . ':AN' .  ($hd_row + 5))->setCellValue('AL' .  ($hd_row + 5), "µs/ cm");
        $objPHPExcel->mergeCells('AL' .  ($hd_row + 6) . ':AN' .  ($hd_row + 6))->setCellValue('AL' .  ($hd_row + 6), "≤500");
        $objPHPExcel->mergeCells('AO' .  ($hd_row + 3) . ':AQ' .  ($hd_row + 4))->setCellValue('AO' .  ($hd_row + 3), "(PO4)³ֿ ion");
        $objPHPExcel->mergeCells('AO' .  ($hd_row + 5) . ':AQ' .  ($hd_row + 5))->setCellValue('AO' .  ($hd_row + 5), "ppm");
        $objPHPExcel->mergeCells('AO' .  ($hd_row + 6) . ':AQ' .  ($hd_row + 6))->setCellValue('AO' .  ($hd_row + 6), "5 - 15");
        $objPHPExcel->mergeCells('AR' .  ($hd_row + 3) . ':AT' .  ($hd_row + 4))->setCellValue('AR' .  ($hd_row + 3), "Silica");
        $objPHPExcel->mergeCells('AR' .  ($hd_row + 5) . ':AT' .  ($hd_row + 5))->setCellValue('AR' .  ($hd_row + 5), "ppm");
        $objPHPExcel->mergeCells('AR' .  ($hd_row + 6) . ':AT' .  ($hd_row + 6))->setCellValue('AR' .  ($hd_row + 6), "30 Max");

        $objPHPExcel->mergeCells('AU' .  ($hd_row + 1) . ':AW' .  ($hd_row + 2))->setCellValue('AU' .  ($hd_row + 1), "Sampling Point");
        $objPHPExcel->mergeCells('AU' .  ($hd_row + 3) . ':AW' .  ($hd_row + 6))->setCellValue('AU' .  ($hd_row + 3), "Time");
        $objPHPExcel->mergeCells('AX' .  ($hd_row + 1) . ':BI' .  ($hd_row + 1))->setCellValue('AX' .  ($hd_row + 1), "Live Steam");
        $objPHPExcel->mergeCells('AX' .  ($hd_row + 2) . ':BI' .  ($hd_row + 2))->setCellValue('AX' .  ($hd_row + 2), "300 - 350 °C");
        $objPHPExcel->mergeCells('AX' .  ($hd_row + 3) . ':AZ' .  ($hd_row + 5))->setCellValue('AX' .  ($hd_row + 3), "pH");
        $objPHPExcel->mergeCells('AX' .  ($hd_row + 6) . ':AZ' .  ($hd_row + 6))->setCellValue('AX' .  ($hd_row + 6), "8,0 - 9,0");
        $objPHPExcel->mergeCells('BA' .  ($hd_row + 3) . ':BC' .  ($hd_row + 4))->setCellValue('BA' .  ($hd_row + 3), "Conductivity");
        $objPHPExcel->mergeCells('BA' .  ($hd_row + 5) . ':BC' .  ($hd_row + 5))->setCellValue('BA' .  ($hd_row + 5), "µs/ cm");
        $objPHPExcel->mergeCells('BA' .  ($hd_row + 6) . ':BC' .  ($hd_row + 6))->setCellValue('BA' .  ($hd_row + 6), "≤10");
        $objPHPExcel->mergeCells('BD' .  ($hd_row + 3) . ':BF' .  ($hd_row + 4))->setCellValue('BD' .  ($hd_row + 3), "Fe");
        $objPHPExcel->mergeCells('BD' .  ($hd_row + 5) . ':BF' .  ($hd_row + 5))->setCellValue('BD' .  ($hd_row + 5), "ppm");
        $objPHPExcel->mergeCells('BD' .  ($hd_row + 6) . ':BF' .  ($hd_row + 6))->setCellValue('BD' .  ($hd_row + 6), "0,1 max");
        $objPHPExcel->mergeCells('BG' .  ($hd_row + 3) . ':BI' .  ($hd_row + 4))->setCellValue('BG' .  ($hd_row + 3), "Silica");
        $objPHPExcel->mergeCells('BG' .  ($hd_row + 5) . ':BI' .  ($hd_row + 5))->setCellValue('BG' .  ($hd_row + 5), "ppm");
        $objPHPExcel->mergeCells('BG' .  ($hd_row + 6) . ':BI' .  ($hd_row + 6))->setCellValue('BG' .  ($hd_row + 6), "0,2 max");

        $objPHPExcel->mergeCells('BJ' .  ($hd_row + 1) . ':BL' .  ($hd_row + 2))->setCellValue('BJ' .  ($hd_row + 1), "Sampling Point");
        $objPHPExcel->mergeCells('BJ' .  ($hd_row + 3) . ':BL' .  ($hd_row + 6))->setCellValue('BJ' .  ($hd_row + 3), "Time");
        $objPHPExcel->mergeCells('BM' .  ($hd_row + 1) . ':BX' .  ($hd_row + 1))->setCellValue('BM' .  ($hd_row + 1), "Superheated Steam");
        $objPHPExcel->mergeCells('BM' .  ($hd_row + 2) . ':BX' .  ($hd_row + 2))->setCellValue('BM' .  ($hd_row + 2), "420 - 450 °C");
        $objPHPExcel->mergeCells('BM' .  ($hd_row + 3) . ':BO' .  ($hd_row + 5))->setCellValue('BM' .  ($hd_row + 3), "pH");
        $objPHPExcel->mergeCells('BM' .  ($hd_row + 6) . ':BO' .  ($hd_row + 6))->setCellValue('BM' .  ($hd_row + 6), "8.0 -9.0");
        $objPHPExcel->mergeCells('BP' .  ($hd_row + 3) . ':BR' .  ($hd_row + 4))->setCellValue('BP' .  ($hd_row + 3), "Conduc-tivity");
        $objPHPExcel->mergeCells('BP' .  ($hd_row + 5) . ':BR' .  ($hd_row + 5))->setCellValue('BP' .  ($hd_row + 5), "µs/ cm");
        $objPHPExcel->mergeCells('BP' .  ($hd_row + 6) . ':BR' .  ($hd_row + 6))->setCellValue('BP' .  ($hd_row + 6), "≤10");
        $objPHPExcel->mergeCells('BS' .  ($hd_row + 3) . ':BU' .  ($hd_row + 4))->setCellValue('BS' .  ($hd_row + 3), "Fe");
        $objPHPExcel->mergeCells('BS' .  ($hd_row + 5) . ':BU' .  ($hd_row + 5))->setCellValue('BS' .  ($hd_row + 5), "ppm");
        $objPHPExcel->mergeCells('BS' .  ($hd_row + 6) . ':BU' .  ($hd_row + 6))->setCellValue('BS' .  ($hd_row + 6), "0,1 max");
        $objPHPExcel->mergeCells('BV' .  ($hd_row + 3) . ':BX' .  ($hd_row + 4))->setCellValue('BV' .  ($hd_row + 3), "Silica");
        $objPHPExcel->mergeCells('BV' .  ($hd_row + 5) . ':BX' .  ($hd_row + 5))->setCellValue('BV' .  ($hd_row + 5), "ppm");
        $objPHPExcel->mergeCells('BV' .  ($hd_row + 6) . ':BX' .  ($hd_row + 6))->setCellValue('BV' .  ($hd_row + 6), "0.2 max");
        $objPHPExcel->getStyle('B' . ($hd_row) . ':BX' . ($hd_row))->applyFromArray($noborderleftboldsize12);
        $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($hd_row + 1) . ':BX' . ($hd_row + 6));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hd_row) . ':A' .  ($hd_row + 6));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BY' . ($hd_row) . ':BY' . ($hd_row + 6));

        $dtl_row = $hd_row + 7;
        for ($i = 1; $i <= $jml_data; $i++) {

            $objPHPExcel->getRowDimension($dtl_row)->setRowHeight(20);

            if (isset($a1_time[$i])) {
                $a1_time[$i] = $a1_time[$i];
            } else {
                $a1_time[$i] = "";
            }

            if (isset($a1_alkalinity[$i])) {
                $a1_alkalinity[$i] = $a1_alkalinity[$i];
            } else {
                $a1_alkalinity[$i] = "";
            }

            if (isset($a1_ph[$i])) {
                $a1_ph[$i] = $a1_ph[$i];
            } else {
                $a1_ph[$i] = "";
            }

            if (isset($a1_conductivity[$i])) {
                $a1_conductivity[$i] = $a1_conductivity[$i];
            } else {
                $a1_conductivity[$i] = "";
            }

            if (isset($a1_thardness[$i])) {
                $a1_thardness[$i] = $a1_thardness[$i];
            } else {
                $a1_thardness[$i] = "";
            }

            if (isset($a1_dissolvedoxygen[$i])) {
                $a1_dissolvedoxygen[$i] = $a1_dissolvedoxygen[$i];
            } else {
                $a1_dissolvedoxygen[$i] = "";
            }

            if (isset($a1_silica[$i])) {
                $a1_silica[$i] = $a1_silica[$i];
            } else {
                $a1_silica[$i] = "";
            }

            if (isset($a1_fe[$i])) {
                $a1_fe[$i] = $a1_fe[$i];
            } else {
                $a1_fe[$i] = "";
            }

            if (isset($a2_time[$i])) {
                $a2_time[$i] = $a2_time[$i];
            } else {
                $a2_time[$i] = "";
            }

            if (isset($a2_alkalinityp[$i])) {
                $a2_alkalinityp[$i] = $a2_alkalinityp[$i];
            } else {
                $a2_alkalinityp[$i] = "";
            }

            if (isset($a2_alkalinitym[$i])) {
                $a2_alkalinitym[$i] = $a2_alkalinitym[$i];
            } else {
                $a2_alkalinitym[$i] = "";
            }

            if (isset($a2_ph[$i])) {
                $a2_ph[$i] = $a2_ph[$i];
            } else {
                $a2_ph[$i] = "";
            }

            if (isset($a2_conductivity[$i])) {
                $a2_conductivity[$i] = $a2_conductivity[$i];
            } else {
                $a2_conductivity[$i] = "";
            }

            if (isset($a2_ion[$i])) {
                $a2_ion[$i] = $a2_ion[$i];
            } else {
                $a2_ion[$i] = "";
            }

            if (isset($a2_silica[$i])) {
                $a2_silica[$i] = $a2_silica[$i];
            } else {
                $a2_silica[$i] = "";
            }

            if (isset($a3_time[$i])) {
                $a3_time[$i] = $a3_time[$i];
            } else {
                $a3_time[$i] = "";
            }

            if (isset($a3_ph[$i])) {
                $a3_ph[$i] = $a3_ph[$i];
            } else {
                $a3_ph[$i] = "";
            }

            if (isset($a3_conductivity[$i])) {
                $a3_conductivity[$i] = $a3_conductivity[$i];
            } else {
                $a3_conductivity[$i] = "";
            }

            if (isset($a3_silica[$i])) {
                $a3_silica[$i] = $a3_silica[$i];
            } else {
                $a3_silica[$i] = "";
            }

            if (isset($a3_fe[$i])) {
                $a3_fe[$i] = $a3_fe[$i];
            } else {
                $a3_fe[$i] = "";
            }

            if (isset($a4_time[$i])) {
                $a4_time[$i] = $a4_time[$i];
            } else {
                $a4_time[$i] = "";
            }

            if (isset($a4_ph[$i])) {
                $a4_ph[$i] = $a4_ph[$i];
            } else {
                $a4_ph[$i] = "";
            }

            if (isset($a4_conductivity[$i])) {
                $a4_conductivity[$i] = $a4_conductivity[$i];
            } else {
                $a4_conductivity[$i] = "";
            }

            if (isset($a4_silica[$i])) {
                $a4_silica[$i] = $a4_silica[$i];
            } else {
                $a4_silica[$i] = "";
            }

            if (isset($a4_fe[$i])) {
                $a4_fe[$i] = $a4_fe[$i];
            } else {
                $a4_fe[$i] = "";
            }

            $objPHPExcel->mergeCells('B' .  $dtl_row . ':D' .  $dtl_row)->setCellValue('B' .  $dtl_row, $a1_time[$i]);
            $objPHPExcel->mergeCells('E' .  $dtl_row . ':G' .  $dtl_row)->setCellValue('E' .  $dtl_row, $a1_alkalinity[$i]);
            $objPHPExcel->mergeCells('H' .  $dtl_row . ':J' .  $dtl_row)->setCellValue('H' .  $dtl_row, $a1_ph[$i]);
            $objPHPExcel->mergeCells('K' .  $dtl_row . ':M' .  $dtl_row)->setCellValue('K' .  $dtl_row, $a1_conductivity[$i]);
            $objPHPExcel->mergeCells('N' .  $dtl_row . ':P' .  $dtl_row)->setCellValue('N' .  $dtl_row, $a1_thardness[$i]);
            $objPHPExcel->mergeCells('Q' .  $dtl_row . ':S' .  $dtl_row)->setCellValue('Q' .  $dtl_row, $a1_dissolvedoxygen[$i]);
            $objPHPExcel->mergeCells('T' .  $dtl_row . ':V' .  $dtl_row)->setCellValue('T' .  $dtl_row, $a1_silica[$i]);
            $objPHPExcel->mergeCells('W' .  $dtl_row . ':Y' .  $dtl_row)->setCellValue('W' .  $dtl_row, $a1_fe[$i]);
            $objPHPExcel->mergeCells('Z' .  $dtl_row . ':AB' .  $dtl_row)->setCellValue('Z' .  $dtl_row, $a2_time[$i]);
            $objPHPExcel->mergeCells('AC' .  $dtl_row . ':AE' .  $dtl_row)->setCellValue('AC' .  $dtl_row, $a2_alkalinityp[$i]);
            $objPHPExcel->mergeCells('AF' .  $dtl_row . ':AH' .  $dtl_row)->setCellValue('AF' .  $dtl_row, $a2_alkalinitym[$i]);
            $objPHPExcel->mergeCells('AI' .  $dtl_row . ':AK' .  $dtl_row)->setCellValue('AI' .  $dtl_row, $a2_ph[$i]);
            $objPHPExcel->mergeCells('AL' .  $dtl_row . ':AN' .  $dtl_row)->setCellValue('AL' .  $dtl_row, $a2_conductivity[$i]);
            $objPHPExcel->mergeCells('AO' .  $dtl_row . ':AQ' .  $dtl_row)->setCellValue('AO' .  $dtl_row, $a2_ion[$i]);
            $objPHPExcel->mergeCells('AR' .  $dtl_row . ':AT' .  $dtl_row)->setCellValue('AR' .  $dtl_row, $a2_silica[$i]);
            $objPHPExcel->mergeCells('AU' .  $dtl_row . ':AW' .  $dtl_row)->setCellValue('AU' .  $dtl_row, $a3_time[$i]);
            $objPHPExcel->mergeCells('AX' .  $dtl_row . ':AZ' .  $dtl_row)->setCellValue('AX' .  $dtl_row, $a3_ph[$i]);
            $objPHPExcel->mergeCells('BA' .  $dtl_row . ':BC' .  $dtl_row)->setCellValue('BA' .  $dtl_row, $a3_conductivity[$i]);
            $objPHPExcel->mergeCells('BD' .  $dtl_row . ':BF' .  $dtl_row)->setCellValue('BD' .  $dtl_row, $a3_silica[$i]);
            $objPHPExcel->mergeCells('BG' .  $dtl_row . ':BI' .  $dtl_row)->setCellValue('BG' .  $dtl_row, $a3_fe[$i]);
            $objPHPExcel->mergeCells('BJ' .  $dtl_row . ':BL' .  $dtl_row)->setCellValue('BJ' .  $dtl_row, $a4_time[$i]);
            $objPHPExcel->mergeCells('BM' .  $dtl_row . ':BO' .  $dtl_row)->setCellValue('BM' .  $dtl_row, $a4_ph[$i]);
            $objPHPExcel->mergeCells('BP' .  $dtl_row . ':BR' .  $dtl_row)->setCellValue('BP' .  $dtl_row, $a4_conductivity[$i]);
            $objPHPExcel->mergeCells('BS' .  $dtl_row . ':BU' .  $dtl_row)->setCellValue('BS' .  $dtl_row, $a4_silica[$i]);
            $objPHPExcel->mergeCells('BV' .  $dtl_row . ':BX' .  $dtl_row)->setCellValue('BV' .  $dtl_row, $a4_fe[$i]);
            $objPHPExcel->setSharedStyle($DetailStyle, 'B' . $dtl_row  . ':BX' . $dtl_row);
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' . $dtl_row . ':A' . $dtl_row);
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BY' . $dtl_row . ':BY' . $dtl_row);

            $dtl_row++;
        }

        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row) . ':A' .  ($dtl_row + 2));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BY' . ($dtl_row) . ':BY' . ($dtl_row + 2));

        $hd_row_b = $dtl_row + 2;
        $objPHPExcel->mergeCells('B' .  ($hd_row_b) . ':BX' .  ($hd_row_b))->setCellValue('B' .  ($hd_row_b), "Water Analyis Results : BOILER #2");
        $objPHPExcel->mergeCells('B' .  ($hd_row_b + 1) . ':D' .  ($hd_row_b + 2))->setCellValue('B' .  ($hd_row_b + 1), "Sampling Point");
        $objPHPExcel->mergeCells('B' .  ($hd_row_b + 3) . ':D' .  ($hd_row_b + 6))->setCellValue('B' .  ($hd_row_b + 3), "Time");
        $objPHPExcel->mergeCells('E' .  ($hd_row_b + 1) . ':Y' .  ($hd_row_b + 1))->setCellValue('E' .  ($hd_row_b + 1), "Dearator");
        $objPHPExcel->mergeCells('E' .  ($hd_row_b + 2) . ':Y' .  ($hd_row_b + 2))->setCellValue('E' .  ($hd_row_b + 2), "102 - 104 °C");
        $objPHPExcel->mergeCells('E' .  ($hd_row_b + 3) . ':G' .  ($hd_row_b + 3))->setCellValue('E' .  ($hd_row_b + 3), "Alkalinity");
        $objPHPExcel->mergeCells('E' .  ($hd_row_b + 4) . ':G' .  ($hd_row_b + 4))->setCellValue('E' .  ($hd_row_b + 4), "M");
        $objPHPExcel->mergeCells('E' .  ($hd_row_b + 5) . ':G' .  ($hd_row_b + 5))->setCellValue('E' .  ($hd_row_b + 5), "mmol/ L");
        $objPHPExcel->mergeCells('E' .  ($hd_row_b + 6) . ':G' .  ($hd_row_b + 6))->setCellValue('E' .  ($hd_row_b + 6), "≤0.5");
        $objPHPExcel->mergeCells('H' .  ($hd_row_b + 3) . ':J' .  ($hd_row_b + 5))->setCellValue('H' .  ($hd_row_b + 3), "pH");
        $objPHPExcel->mergeCells('H' .  ($hd_row_b + 6) . ':J' .  ($hd_row_b + 6))->setCellValue('H' .  ($hd_row_b + 6), "8.5 -9.3");
        $objPHPExcel->mergeCells('K' .  ($hd_row_b + 3) . ':M' .  ($hd_row_b + 4))->setCellValue('K' .  ($hd_row_b + 3), "Conduc-tivity");
        $objPHPExcel->mergeCells('K' .  ($hd_row_b + 5) . ':M' .  ($hd_row_b + 5))->setCellValue('K' .  ($hd_row_b + 5), "µs/ cm");
        $objPHPExcel->mergeCells('K' .  ($hd_row_b + 6) . ':M' .  ($hd_row_b + 6))->setCellValue('K' .  ($hd_row_b + 6), "≤10");
        $objPHPExcel->mergeCells('N' .  ($hd_row_b + 3) . ':P' .  ($hd_row_b + 4))->setCellValue('N' .  ($hd_row_b + 3), "T. Hardness");
        $objPHPExcel->mergeCells('N' .  ($hd_row_b + 5) . ':P' .  ($hd_row_b + 5))->setCellValue('N' .  ($hd_row_b + 5), "µmol/L");
        $objPHPExcel->mergeCells('N' .  ($hd_row_b + 6) . ':P' .  ($hd_row_b + 6))->setCellValue('N' .  ($hd_row_b + 6), "≤ 15");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_b + 3) . ':S' .  ($hd_row_b + 4))->setCellValue('Q' .  ($hd_row_b + 3), "Dissolved Oxygen");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_b + 5) . ':S' .  ($hd_row_b + 5))->setCellValue('Q' .  ($hd_row_b + 5), "ppb O2");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_b + 6) . ':S' .  ($hd_row_b + 6))->setCellValue('Q' .  ($hd_row_b + 6), "≤ 15");
        $objPHPExcel->mergeCells('T' .  ($hd_row_b + 3) . ':V' .  ($hd_row_b + 4))->setCellValue('T' .  ($hd_row_b + 3), "Silica");
        $objPHPExcel->mergeCells('T' .  ($hd_row_b + 5) . ':V' .  ($hd_row_b + 5))->setCellValue('T' .  ($hd_row_b + 5), "ppm");
        $objPHPExcel->mergeCells('T' .  ($hd_row_b + 6) . ':V' .  ($hd_row_b + 6))->setCellValue('T' .  ($hd_row_b + 6), "0.5 Max");
        $objPHPExcel->mergeCells('W' .  ($hd_row_b + 3) . ':Y' .  ($hd_row_b + 4))->setCellValue('W' .  ($hd_row_b + 3), "Fe");
        $objPHPExcel->mergeCells('W' .  ($hd_row_b + 5) . ':Y' .  ($hd_row_b + 5))->setCellValue('W' .  ($hd_row_b + 5), "ppm");
        $objPHPExcel->mergeCells('W' .  ($hd_row_b + 6) . ':Y' .  ($hd_row_b + 6))->setCellValue('W' .  ($hd_row_b + 6), "≤0,10");

        $objPHPExcel->mergeCells('Z' .  ($hd_row_b + 1) . ':AB' .  ($hd_row_b + 2))->setCellValue('Z' .  ($hd_row_b + 1), "Sampling Point");
        $objPHPExcel->mergeCells('Z' .  ($hd_row_b + 3) . ':AB' .  ($hd_row_b + 6))->setCellValue('Z' .  ($hd_row_b + 3), "Time");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_b + 1) . ':AT' .  ($hd_row_b + 1))->setCellValue('AC' .  ($hd_row_b + 1), "Boiler Water");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_b + 2) . ':AT' .  ($hd_row_b + 2))->setCellValue('AC' .  ($hd_row_b + 2), "120 - 150 °C");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_b + 3) . ':AH' .  ($hd_row_b + 3))->setCellValue('AC' .  ($hd_row_b + 3), "Total Alkalinity");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_b + 4) . ':AE' .  ($hd_row_b + 4))->setCellValue('AC' .  ($hd_row_b + 4), "P");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_b + 5) . ':AE' .  ($hd_row_b + 5))->setCellValue('AC' .  ($hd_row_b + 5), "ppm");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_b + 6) . ':AE' .  ($hd_row_b + 6))->setCellValue('AC' .  ($hd_row_b + 6), "max 50");
        $objPHPExcel->mergeCells('AF' .  ($hd_row_b + 4) . ':AH' .  ($hd_row_b + 4))->setCellValue('AF' .  ($hd_row_b + 4), "M");
        $objPHPExcel->mergeCells('AF' .  ($hd_row_b + 5) . ':AH' .  ($hd_row_b + 5))->setCellValue('AF' .  ($hd_row_b + 5), "ppm");
        $objPHPExcel->mergeCells('AF' .  ($hd_row_b + 6) . ':AH' .  ($hd_row_b + 6))->setCellValue('AF' .  ($hd_row_b + 6), "max 100");
        $objPHPExcel->mergeCells('AI' .  ($hd_row_b + 3) . ':AK' .  ($hd_row_b + 5))->setCellValue('AI' .  ($hd_row_b + 3), "pH");
        $objPHPExcel->mergeCells('AI' .  ($hd_row_b + 6) . ':AK' .  ($hd_row_b + 6))->setCellValue('AI' .  ($hd_row_b + 6), "9,5 - 10,5");
        $objPHPExcel->mergeCells('AL' .  ($hd_row_b + 3) . ':AN' .  ($hd_row_b + 4))->setCellValue('AL' .  ($hd_row_b + 3), "Conductivity");
        $objPHPExcel->mergeCells('AL' .  ($hd_row_b + 5) . ':AN' .  ($hd_row_b + 5))->setCellValue('AL' .  ($hd_row_b + 5), "µs/ cm");
        $objPHPExcel->mergeCells('AL' .  ($hd_row_b + 6) . ':AN' .  ($hd_row_b + 6))->setCellValue('AL' .  ($hd_row_b + 6), "≤500");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_b + 3) . ':AQ' .  ($hd_row_b + 4))->setCellValue('AO' .  ($hd_row_b + 3), "(PO4)³ֿ ion");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_b + 5) . ':AQ' .  ($hd_row_b + 5))->setCellValue('AO' .  ($hd_row_b + 5), "ppm");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_b + 6) . ':AQ' .  ($hd_row_b + 6))->setCellValue('AO' .  ($hd_row_b + 6), "5 - 15");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_b + 3) . ':AT' .  ($hd_row_b + 4))->setCellValue('AR' .  ($hd_row_b + 3), "Silica");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_b + 5) . ':AT' .  ($hd_row_b + 5))->setCellValue('AR' .  ($hd_row_b + 5), "ppm");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_b + 6) . ':AT' .  ($hd_row_b + 6))->setCellValue('AR' .  ($hd_row_b + 6), "30 Max");

        $objPHPExcel->mergeCells('AU' .  ($hd_row_b + 1) . ':AW' .  ($hd_row_b + 2))->setCellValue('AU' .  ($hd_row_b + 1), "Sampling Point");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_b + 3) . ':AW' .  ($hd_row_b + 6))->setCellValue('AU' .  ($hd_row_b + 3), "Time");
        $objPHPExcel->mergeCells('AX' .  ($hd_row_b + 1) . ':BI' .  ($hd_row_b + 1))->setCellValue('AX' .  ($hd_row_b + 1), "Live Steam");
        $objPHPExcel->mergeCells('AX' .  ($hd_row_b + 2) . ':BI' .  ($hd_row_b + 2))->setCellValue('AX' .  ($hd_row_b + 2), "300 - 350 °C");
        $objPHPExcel->mergeCells('AX' .  ($hd_row_b + 3) . ':AZ' .  ($hd_row_b + 5))->setCellValue('AX' .  ($hd_row_b + 3), "pH");
        $objPHPExcel->mergeCells('AX' .  ($hd_row_b + 6) . ':AZ' .  ($hd_row_b + 6))->setCellValue('AX' .  ($hd_row_b + 6), "8,0 - 9,0");
        $objPHPExcel->mergeCells('BA' .  ($hd_row_b + 3) . ':BC' .  ($hd_row_b + 4))->setCellValue('BA' .  ($hd_row_b + 3), "Conductivity");
        $objPHPExcel->mergeCells('BA' .  ($hd_row_b + 5) . ':BC' .  ($hd_row_b + 5))->setCellValue('BA' .  ($hd_row_b + 5), "µs/ cm");
        $objPHPExcel->mergeCells('BA' .  ($hd_row_b + 6) . ':BC' .  ($hd_row_b + 6))->setCellValue('BA' .  ($hd_row_b + 6), "≤10");
        $objPHPExcel->mergeCells('BD' .  ($hd_row_b + 3) . ':BF' .  ($hd_row_b + 4))->setCellValue('BD' .  ($hd_row_b + 3), "Fe");
        $objPHPExcel->mergeCells('BD' .  ($hd_row_b + 5) . ':BF' .  ($hd_row_b + 5))->setCellValue('BD' .  ($hd_row_b + 5), "ppm");
        $objPHPExcel->mergeCells('BD' .  ($hd_row_b + 6) . ':BF' .  ($hd_row_b + 6))->setCellValue('BD' .  ($hd_row_b + 6), "0,1 max");
        $objPHPExcel->mergeCells('BG' .  ($hd_row_b + 3) . ':BI' .  ($hd_row_b + 4))->setCellValue('BG' .  ($hd_row_b + 3), "Silica");
        $objPHPExcel->mergeCells('BG' .  ($hd_row_b + 5) . ':BI' .  ($hd_row_b + 5))->setCellValue('BG' .  ($hd_row_b + 5), "ppm");
        $objPHPExcel->mergeCells('BG' .  ($hd_row_b + 6) . ':BI' .  ($hd_row_b + 6))->setCellValue('BG' .  ($hd_row_b + 6), "0,2 max");

        $objPHPExcel->mergeCells('BJ' .  ($hd_row_b + 1) . ':BL' .  ($hd_row_b + 2))->setCellValue('BJ' .  ($hd_row_b + 1), "Sampling Point");
        $objPHPExcel->mergeCells('BJ' .  ($hd_row_b + 3) . ':BL' .  ($hd_row_b + 6))->setCellValue('BJ' .  ($hd_row_b + 3), "Time");
        $objPHPExcel->mergeCells('BM' .  ($hd_row_b + 1) . ':BX' .  ($hd_row_b + 1))->setCellValue('BM' .  ($hd_row_b + 1), "Superheated Steam");
        $objPHPExcel->mergeCells('BM' .  ($hd_row_b + 2) . ':BX' .  ($hd_row_b + 2))->setCellValue('BM' .  ($hd_row_b + 2), "420 - 450 °C");
        $objPHPExcel->mergeCells('BM' .  ($hd_row_b + 3) . ':BO' .  ($hd_row_b + 5))->setCellValue('BM' .  ($hd_row_b + 3), "pH");
        $objPHPExcel->mergeCells('BM' .  ($hd_row_b + 6) . ':BO' .  ($hd_row_b + 6))->setCellValue('BM' .  ($hd_row_b + 6), "8.0 -9.0");
        $objPHPExcel->mergeCells('BP' .  ($hd_row_b + 3) . ':BR' .  ($hd_row_b + 4))->setCellValue('BP' .  ($hd_row_b + 3), "Conduc-tivity");
        $objPHPExcel->mergeCells('BP' .  ($hd_row_b + 5) . ':BR' .  ($hd_row_b + 5))->setCellValue('BP' .  ($hd_row_b + 5), "µs/ cm");
        $objPHPExcel->mergeCells('BP' .  ($hd_row_b + 6) . ':BR' .  ($hd_row_b + 6))->setCellValue('BP' .  ($hd_row_b + 6), "≤10");
        $objPHPExcel->mergeCells('BS' .  ($hd_row_b + 3) . ':BU' .  ($hd_row_b + 4))->setCellValue('BS' .  ($hd_row_b + 3), "Fe");
        $objPHPExcel->mergeCells('BS' .  ($hd_row_b + 5) . ':BU' .  ($hd_row_b + 5))->setCellValue('BS' .  ($hd_row_b + 5), "ppm");
        $objPHPExcel->mergeCells('BS' .  ($hd_row_b + 6) . ':BU' .  ($hd_row_b + 6))->setCellValue('BS' .  ($hd_row_b + 6), "0,1 max");
        $objPHPExcel->mergeCells('BV' .  ($hd_row_b + 3) . ':BX' .  ($hd_row_b + 4))->setCellValue('BV' .  ($hd_row_b + 3), "Silica");
        $objPHPExcel->mergeCells('BV' .  ($hd_row_b + 5) . ':BX' .  ($hd_row_b + 5))->setCellValue('BV' .  ($hd_row_b + 5), "ppm");
        $objPHPExcel->mergeCells('BV' .  ($hd_row_b + 6) . ':BX' .  ($hd_row_b + 6))->setCellValue('BV' .  ($hd_row_b + 6), "0.2 max");
        $objPHPExcel->getStyle('B' . ($hd_row_b) . ':BX' . ($hd_row_b))->applyFromArray($noborderleftboldsize12);
        $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($hd_row_b + 1) . ':BX' . ($hd_row_b + 6));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hd_row_b) . ':A' .  ($hd_row_b + 6));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BY' . ($hd_row_b) . ':BY' . ($hd_row_b + 6));

        $dtl_row_b = $hd_row_b + 7;
        for ($i = 1; $i <= $jml_data_b; $i++) {

            $objPHPExcel->getRowDimension($dtl_row_b)->setRowHeight(20);

            if (isset($b1_time[$i])) {
                $b1_time[$i] = $b1_time[$i];
            } else {
                $b1_time[$i] = "";
            }

            if (isset($b1_alkalinity[$i])) {
                $b1_alkalinity[$i] = $b1_alkalinity[$i];
            } else {
                $b1_alkalinity[$i] = "";
            }

            if (isset($b1_ph[$i])) {
                $b1_ph[$i] = $b1_ph[$i];
            } else {
                $b1_ph[$i] = "";
            }

            if (isset($b1_conductivity[$i])) {
                $b1_conductivity[$i] = $b1_conductivity[$i];
            } else {
                $b1_conductivity[$i] = "";
            }

            if (isset($b1_thardness[$i])) {
                $b1_thardness[$i] = $b1_thardness[$i];
            } else {
                $b1_thardness[$i] = "";
            }

            if (isset($b1_dissolvedoxygen[$i])) {
                $b1_dissolvedoxygen[$i] = $b1_dissolvedoxygen[$i];
            } else {
                $b1_dissolvedoxygen[$i] = "";
            }

            if (isset($b1_silica[$i])) {
                $b1_silica[$i] = $b1_silica[$i];
            } else {
                $b1_silica[$i] = "";
            }

            if (isset($b1_fe[$i])) {
                $b1_fe[$i] = $b1_fe[$i];
            } else {
                $b1_fe[$i] = "";
            }

            if (isset($b2_time[$i])) {
                $b2_time[$i] = $b2_time[$i];
            } else {
                $b2_time[$i] = "";
            }

            if (isset($b2_alkalinityp[$i])) {
                $b2_alkalinityp[$i] = $b2_alkalinityp[$i];
            } else {
                $b2_alkalinityp[$i] = "";
            }

            if (isset($b2_alkalinitym[$i])) {
                $b2_alkalinitym[$i] = $b2_alkalinitym[$i];
            } else {
                $b2_alkalinitym[$i] = "";
            }

            if (isset($b2_ph[$i])) {
                $b2_ph[$i] = $b2_ph[$i];
            } else {
                $b2_ph[$i] = "";
            }

            if (isset($b2_conductivity[$i])) {
                $b2_conductivity[$i] = $b2_conductivity[$i];
            } else {
                $b2_conductivity[$i] = "";
            }

            if (isset($b2_ion[$i])) {
                $b2_ion[$i] = $b2_ion[$i];
            } else {
                $b2_ion[$i] = "";
            }

            if (isset($b2_silica[$i])) {
                $b2_silica[$i] = $b2_silica[$i];
            } else {
                $b2_silica[$i] = "";
            }

            if (isset($b3_time[$i])) {
                $b3_time[$i] = $b3_time[$i];
            } else {
                $b3_time[$i] = "";
            }

            if (isset($b3_ph[$i])) {
                $b3_ph[$i] = $b3_ph[$i];
            } else {
                $b3_ph[$i] = "";
            }

            if (isset($b3_conductivity[$i])) {
                $b3_conductivity[$i] = $b3_conductivity[$i];
            } else {
                $b3_conductivity[$i] = "";
            }

            if (isset($b3_silica[$i])) {
                $b3_silica[$i] = $b3_silica[$i];
            } else {
                $b3_silica[$i] = "";
            }

            if (isset($b3_fe[$i])) {
                $b3_fe[$i] = $b3_fe[$i];
            } else {
                $b3_fe[$i] = "";
            }

            if (isset($b4_time[$i])) {
                $b4_time[$i] = $b4_time[$i];
            } else {
                $b4_time[$i] = "";
            }

            if (isset($b4_ph[$i])) {
                $b4_ph[$i] = $b4_ph[$i];
            } else {
                $b4_ph[$i] = "";
            }

            if (isset($b4_conductivity[$i])) {
                $b4_conductivity[$i] = $b4_conductivity[$i];
            } else {
                $b4_conductivity[$i] = "";
            }

            if (isset($b4_silica[$i])) {
                $b4_silica[$i] = $b4_silica[$i];
            } else {
                $b4_silica[$i] = "";
            }

            if (isset($b4_fe[$i])) {
                $b4_fe[$i] = $b4_fe[$i];
            } else {
                $b4_fe[$i] = "";
            }

            $objPHPExcel->mergeCells('B' .  $dtl_row_b . ':D' .  $dtl_row_b)->setCellValue('B' .  $dtl_row_b, $b1_time[$i]);
            $objPHPExcel->mergeCells('E' .  $dtl_row_b . ':G' .  $dtl_row_b)->setCellValue('E' .  $dtl_row_b, $b1_alkalinity[$i]);
            $objPHPExcel->mergeCells('H' .  $dtl_row_b . ':J' .  $dtl_row_b)->setCellValue('H' .  $dtl_row_b, $b1_ph[$i]);
            $objPHPExcel->mergeCells('K' .  $dtl_row_b . ':M' .  $dtl_row_b)->setCellValue('K' .  $dtl_row_b, $b1_conductivity[$i]);
            $objPHPExcel->mergeCells('N' .  $dtl_row_b . ':P' .  $dtl_row_b)->setCellValue('N' .  $dtl_row_b, $b1_thardness[$i]);
            $objPHPExcel->mergeCells('Q' .  $dtl_row_b . ':S' .  $dtl_row_b)->setCellValue('Q' .  $dtl_row_b, $b1_dissolvedoxygen[$i]);
            $objPHPExcel->mergeCells('T' .  $dtl_row_b . ':V' .  $dtl_row_b)->setCellValue('T' .  $dtl_row_b, $b1_silica[$i]);
            $objPHPExcel->mergeCells('W' .  $dtl_row_b . ':Y' .  $dtl_row_b)->setCellValue('W' .  $dtl_row_b, $b1_fe[$i]);
            $objPHPExcel->mergeCells('Z' .  $dtl_row_b . ':AB' .  $dtl_row_b)->setCellValue('Z' .  $dtl_row_b, $b2_time[$i]);
            $objPHPExcel->mergeCells('AC' .  $dtl_row_b . ':AE' .  $dtl_row_b)->setCellValue('AC' .  $dtl_row_b, $b2_alkalinityp[$i]);
            $objPHPExcel->mergeCells('AF' .  $dtl_row_b . ':AH' .  $dtl_row_b)->setCellValue('AF' .  $dtl_row_b, $b2_alkalinitym[$i]);
            $objPHPExcel->mergeCells('AI' .  $dtl_row_b . ':AK' .  $dtl_row_b)->setCellValue('AI' .  $dtl_row_b, $b2_ph[$i]);
            $objPHPExcel->mergeCells('AL' .  $dtl_row_b . ':AN' .  $dtl_row_b)->setCellValue('AL' .  $dtl_row_b, $b2_conductivity[$i]);
            $objPHPExcel->mergeCells('AO' .  $dtl_row_b . ':AQ' .  $dtl_row_b)->setCellValue('AO' .  $dtl_row_b, $b2_ion[$i]);
            $objPHPExcel->mergeCells('AR' .  $dtl_row_b . ':AT' .  $dtl_row_b)->setCellValue('AR' .  $dtl_row_b, $b2_silica[$i]);
            $objPHPExcel->mergeCells('AU' .  $dtl_row_b . ':AW' .  $dtl_row_b)->setCellValue('AU' .  $dtl_row_b, $b3_time[$i]);
            $objPHPExcel->mergeCells('AX' .  $dtl_row_b . ':AZ' .  $dtl_row_b)->setCellValue('AX' .  $dtl_row_b, $b3_ph[$i]);
            $objPHPExcel->mergeCells('BA' .  $dtl_row_b . ':BC' .  $dtl_row_b)->setCellValue('BA' .  $dtl_row_b, $b3_conductivity[$i]);
            $objPHPExcel->mergeCells('BD' .  $dtl_row_b . ':BF' .  $dtl_row_b)->setCellValue('BD' .  $dtl_row_b, $b3_silica[$i]);
            $objPHPExcel->mergeCells('BG' .  $dtl_row_b . ':BI' .  $dtl_row_b)->setCellValue('BG' .  $dtl_row_b, $b3_fe[$i]);
            $objPHPExcel->mergeCells('BJ' .  $dtl_row_b . ':BL' .  $dtl_row_b)->setCellValue('BJ' .  $dtl_row_b, $b4_time[$i]);
            $objPHPExcel->mergeCells('BM' .  $dtl_row_b . ':BO' .  $dtl_row_b)->setCellValue('BM' .  $dtl_row_b, $b4_ph[$i]);
            $objPHPExcel->mergeCells('BP' .  $dtl_row_b . ':BR' .  $dtl_row_b)->setCellValue('BP' .  $dtl_row_b, $b4_conductivity[$i]);
            $objPHPExcel->mergeCells('BS' .  $dtl_row_b . ':BU' .  $dtl_row_b)->setCellValue('BS' .  $dtl_row_b, $b4_silica[$i]);
            $objPHPExcel->mergeCells('BV' .  $dtl_row_b . ':BX' .  $dtl_row_b)->setCellValue('BV' .  $dtl_row_b, $b4_fe[$i]);
            $objPHPExcel->setSharedStyle($DetailStyle, 'B' . $dtl_row_b  . ':BX' . $dtl_row_b);
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' . $dtl_row_b . ':A' . $dtl_row_b);
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BY' . $dtl_row_b . ':BY' . $dtl_row_b);

            $dtl_row_b++;
        }

        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row_b) . ':A' .  ($dtl_row_b + 2));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BY' . ($dtl_row_b) . ':BY' . ($dtl_row_b + 2));

        $ftr_row = $dtl_row_b + 2;
        $objPHPExcel->mergeCells('B' .  ($ftr_row) . ':F' .  ($ftr_row))->setCellValue('B' .  ($ftr_row), "Notifications :");
        $objPHPExcel->mergeCells('G' .  ($ftr_row  + 1) . ':I' .  ($ftr_row + 1))->setCellValue('G' .  ($ftr_row + 1), "");
        $objPHPExcel->mergeCells('J' .  ($ftr_row  + 1) . ':Q' .  ($ftr_row + 1))->setCellValue('J' .  ($ftr_row + 1), ": Analysis once a month");
        $objPHPExcel->getStyle('G' . ($ftr_row + 1) . ':I' . ($ftr_row + 1))->applyFromArray($colorpurple);
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($ftr_row) . ':A' .  ($ftr_row + 1));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BY' . ($ftr_row) . ':BY' . ($ftr_row + 1));

        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($ftr_row + 2) . ':A' .  ($ftr_row + 3));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BY' . ($ftr_row + 2) . ':BY' . ($ftr_row + 3));

        $objPHPExcel->mergeCells('A' . ($ftr_row + 4) . ':Q' . ($ftr_row + 4))->setCellValue('A' . ($ftr_row + 4), 'Effective date on ' . $this->frmefective);
        $objPHPExcel->mergeCells('R' . ($ftr_row + 4) . ':BY' . ($ftr_row + 4))->setCellValue('R' . ($ftr_row + 4), $this->frmnm . '-' . $this->frmver);
        $objPHPExcel->getStyle('A' . ($ftr_row + 4) . ':BY' . ($ftr_row + 4))->getFont()->setBold(true);
        $objPHPExcel->getStyle('R' . ($ftr_row + 4) . ':BY' . ($ftr_row + 4))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($ftr_row + 4) . ':Q' . ($ftr_row + 4));
        $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($ftr_row + 4) . ':BY' . ($ftr_row + 4));

        $objPHPExcel->setBreak('A' . ($ftr_row + 4),  PHPExcel_Worksheet::BREAK_ROW);

        // Worksheet 2 (1 page) ===========================================================================================================================================================================

        $start_row_2 = $ftr_row + 7;
        $gbr_2 = '$objDrawing';
        $gbr_2 = new PHPExcel_Worksheet_Drawing();
        $gbr_2->setPath('assets/images/PSG_logo_2022.png');
        $gbr_2->setWidthAndHeight(50, 50);
        $gbr_2->setWorksheet($objPHPExcel);
        $gbr_2->setCoordinates('B' . $start_row_2);

        $objPHPExcel->mergeCells('A' .   $start_row_2 . ':D' . ($start_row_2 + 2));
        $objPHPExcel->mergeCells('E' .   $start_row_2 . ':CF' . ($start_row_2))->setCellValue('E' . $start_row_2,  $this->frmcop);
        $objPHPExcel->mergeCells('E' .  ($start_row_2 + 1) . ':CF' . ($start_row_2 + 1))->setCellValue('E' .  ($start_row_2 + 1), 'DEPARTEMENT POWER PLANT (TURBINE)');
        $objPHPExcel->mergeCells('E' .  ($start_row_2 + 2) . ':CF' . ($start_row_2 + 2))->setCellValue('E' .  ($start_row_2 + 2), $this->frmjdl);
        $objPHPExcel->mergeCells('CG' .  $start_row_2 . ':CI' . $start_row_2)->setCellValue('CG' . $start_row_2, 'Date');
        $objPHPExcel->mergeCells('CJ' .  $start_row_2 . ':CQ' . $start_row_2)->setCellValue('CJ' . $start_row_2, ': ' . $create_date);
        $objPHPExcel->mergeCells('CG' . ($start_row_2 + 1) . ':CI' . ($start_row_2 + 1))->setCellValue('CG' . ($start_row_2 + 1), 'Doc');
        $objPHPExcel->mergeCells('CJ' . ($start_row_2 + 1) . ':CQ' . ($start_row_2 + 1))->setCellValue('CJ' . ($start_row_2 + 1), ': ' . $docno);
        $objPHPExcel->mergeCells('CG' . ($start_row_2 + 2) . ':CI' . ($start_row_2 + 2))->setCellValue('CG' . ($start_row_2 + 2), 'Page');
        $objPHPExcel->mergeCells('CJ' . ($start_row_2 + 2) . ':CQ' . ($start_row_2 + 2))->setCellValue('CJ' . ($start_row_2 + 2), ': ' . 2 . ' of ' . 4);
        $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row_2 .      ':D' .  ($start_row_2 + 2));
        $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row_2) . ':CF' . ($start_row_2 + 2));
        $objPHPExcel->setSharedStyle($headerStyle, 'CG' .  $start_row_2  . ':CQ' . ($start_row_2 + 2));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row_2 + 3) . ':A' .  ($start_row_2 + 5));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'CQ' . ($start_row_2 + 3) . ':CQ' . ($start_row_2 + 5));

        $hd_row_c = $start_row_2 + 5;
        $objPHPExcel->mergeCells('B' .  ($hd_row_c) . ':BX' .  ($hd_row_c))->setCellValue('B' .  ($hd_row_c), "Water Analyis Results : BOILER #3");
        $objPHPExcel->mergeCells('B' .  ($hd_row_c + 1) . ':D' .  ($hd_row_c + 2))->setCellValue('B' .  ($hd_row_c + 1), "Sampling Point");
        $objPHPExcel->mergeCells('B' .  ($hd_row_c + 3) . ':D' .  ($hd_row_c + 6))->setCellValue('B' .  ($hd_row_c + 3), "Time");
        $objPHPExcel->mergeCells('E' .  ($hd_row_c + 1) . ':Y' .  ($hd_row_c + 1))->setCellValue('E' .  ($hd_row_c + 1), "Dearator");
        $objPHPExcel->mergeCells('E' .  ($hd_row_c + 2) . ':Y' .  ($hd_row_c + 2))->setCellValue('E' .  ($hd_row_c + 2), "102 - 104 °C");
        $objPHPExcel->mergeCells('E' .  ($hd_row_c + 3) . ':G' .  ($hd_row_c + 3))->setCellValue('E' .  ($hd_row_c + 3), "Alkalinity");
        $objPHPExcel->mergeCells('E' .  ($hd_row_c + 4) . ':G' .  ($hd_row_c + 4))->setCellValue('E' .  ($hd_row_c + 4), "M");
        $objPHPExcel->mergeCells('E' .  ($hd_row_c + 5) . ':G' .  ($hd_row_c + 5))->setCellValue('E' .  ($hd_row_c + 5), "mmol/ L");
        $objPHPExcel->mergeCells('E' .  ($hd_row_c + 6) . ':G' .  ($hd_row_c + 6))->setCellValue('E' .  ($hd_row_c + 6), "≤0.5");
        $objPHPExcel->mergeCells('H' .  ($hd_row_c + 3) . ':J' .  ($hd_row_c + 5))->setCellValue('H' .  ($hd_row_c + 3), "pH");
        $objPHPExcel->mergeCells('H' .  ($hd_row_c + 6) . ':J' .  ($hd_row_c + 6))->setCellValue('H' .  ($hd_row_c + 6), "8.5 -9.3");
        $objPHPExcel->mergeCells('K' .  ($hd_row_c + 3) . ':M' .  ($hd_row_c + 4))->setCellValue('K' .  ($hd_row_c + 3), "Conduc-tivity");
        $objPHPExcel->mergeCells('K' .  ($hd_row_c + 5) . ':M' .  ($hd_row_c + 5))->setCellValue('K' .  ($hd_row_c + 5), "µs/ cm");
        $objPHPExcel->mergeCells('K' .  ($hd_row_c + 6) . ':M' .  ($hd_row_c + 6))->setCellValue('K' .  ($hd_row_c + 6), "≤10");
        $objPHPExcel->mergeCells('N' .  ($hd_row_c + 3) . ':P' .  ($hd_row_c + 4))->setCellValue('N' .  ($hd_row_c + 3), "T. Hardness");
        $objPHPExcel->mergeCells('N' .  ($hd_row_c + 5) . ':P' .  ($hd_row_c + 5))->setCellValue('N' .  ($hd_row_c + 5), "µmol/L");
        $objPHPExcel->mergeCells('N' .  ($hd_row_c + 6) . ':P' .  ($hd_row_c + 6))->setCellValue('N' .  ($hd_row_c + 6), "≤ 15");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_c + 3) . ':S' .  ($hd_row_c + 4))->setCellValue('Q' .  ($hd_row_c + 3), "Dissolved Oxygen");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_c + 5) . ':S' .  ($hd_row_c + 5))->setCellValue('Q' .  ($hd_row_c + 5), "ppb O2");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_c + 6) . ':S' .  ($hd_row_c + 6))->setCellValue('Q' .  ($hd_row_c + 6), "≤ 15");
        $objPHPExcel->mergeCells('T' .  ($hd_row_c + 3) . ':V' .  ($hd_row_c + 4))->setCellValue('T' .  ($hd_row_c + 3), "Silica");
        $objPHPExcel->mergeCells('T' .  ($hd_row_c + 5) . ':V' .  ($hd_row_c + 5))->setCellValue('T' .  ($hd_row_c + 5), "ppm");
        $objPHPExcel->mergeCells('T' .  ($hd_row_c + 6) . ':V' .  ($hd_row_c + 6))->setCellValue('T' .  ($hd_row_c + 6), "0.5 Max");
        $objPHPExcel->mergeCells('W' .  ($hd_row_c + 3) . ':Y' .  ($hd_row_c + 4))->setCellValue('W' .  ($hd_row_c + 3), "Fe");
        $objPHPExcel->mergeCells('W' .  ($hd_row_c + 5) . ':Y' .  ($hd_row_c + 5))->setCellValue('W' .  ($hd_row_c + 5), "ppm");
        $objPHPExcel->mergeCells('W' .  ($hd_row_c + 6) . ':Y' .  ($hd_row_c + 6))->setCellValue('W' .  ($hd_row_c + 6), "≤0,10");

        $objPHPExcel->mergeCells('Z' .  ($hd_row_c + 1) . ':AQ' .  ($hd_row_c + 1))->setCellValue('Z' .  ($hd_row_c + 1), "Boiler WAQer");
        $objPHPExcel->mergeCells('Z' .  ($hd_row_c + 2) . ':AQ' .  ($hd_row_c + 2))->setCellValue('Z' .  ($hd_row_c + 2), "120 - 150 °C");
        $objPHPExcel->mergeCells('Z' .  ($hd_row_c + 3) . ':AE' .  ($hd_row_c + 3))->setCellValue('Z' .  ($hd_row_c + 3), "Total Alkalinity");
        $objPHPExcel->mergeCells('Z' .  ($hd_row_c + 4) . ':AB' .  ($hd_row_c + 4))->setCellValue('Z' .  ($hd_row_c + 4), "P");
        $objPHPExcel->mergeCells('Z' .  ($hd_row_c + 5) . ':AB' .  ($hd_row_c + 5))->setCellValue('Z' .  ($hd_row_c + 5), "ppm");
        $objPHPExcel->mergeCells('Z' .  ($hd_row_c + 6) . ':AB' .  ($hd_row_c + 6))->setCellValue('Z' .  ($hd_row_c + 6), "max 50");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_c + 4) . ':AE' .  ($hd_row_c + 4))->setCellValue('AC' .  ($hd_row_c + 4), "M");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_c + 5) . ':AE' .  ($hd_row_c + 5))->setCellValue('AC' .  ($hd_row_c + 5), "ppm");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_c + 6) . ':AE' .  ($hd_row_c + 6))->setCellValue('AC' .  ($hd_row_c + 6), "max 100");
        $objPHPExcel->mergeCells('AF' .  ($hd_row_c + 3) . ':AH' .  ($hd_row_c + 5))->setCellValue('AF' .  ($hd_row_c + 3), "pH");
        $objPHPExcel->mergeCells('AF' .  ($hd_row_c + 6) . ':AH' .  ($hd_row_c + 6))->setCellValue('AF' .  ($hd_row_c + 6), "9,5 - 10,5");
        $objPHPExcel->mergeCells('AI' .  ($hd_row_c + 3) . ':AK' .  ($hd_row_c + 4))->setCellValue('AI' .  ($hd_row_c + 3), "Conductivity");
        $objPHPExcel->mergeCells('AI' .  ($hd_row_c + 5) . ':AK' .  ($hd_row_c + 5))->setCellValue('AI' .  ($hd_row_c + 5), "µs/ cm");
        $objPHPExcel->mergeCells('AI' .  ($hd_row_c + 6) . ':AK' .  ($hd_row_c + 6))->setCellValue('AI' .  ($hd_row_c + 6), "≤500");
        $objPHPExcel->mergeCells('AL' .  ($hd_row_c + 3) . ':AN' .  ($hd_row_c + 4))->setCellValue('AL' .  ($hd_row_c + 3), "(PO4)³ֿ ion");
        $objPHPExcel->mergeCells('AL' .  ($hd_row_c + 5) . ':AN' .  ($hd_row_c + 5))->setCellValue('AL' .  ($hd_row_c + 5), "ppm");
        $objPHPExcel->mergeCells('AL' .  ($hd_row_c + 6) . ':AN' .  ($hd_row_c + 6))->setCellValue('AL' .  ($hd_row_c + 6), "5 - 15");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_c + 3) . ':AQ' .  ($hd_row_c + 4))->setCellValue('AO' .  ($hd_row_c + 3), "Silica");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_c + 5) . ':AQ' .  ($hd_row_c + 5))->setCellValue('AO' .  ($hd_row_c + 5), "ppm");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_c + 6) . ':AQ' .  ($hd_row_c + 6))->setCellValue('AO' .  ($hd_row_c + 6), "30 Max");

        $objPHPExcel->mergeCells('AR' .  ($hd_row_c + 1) . ':BC' .  ($hd_row_c + 1))->setCellValue('AR' .  ($hd_row_c + 1), "Live Steam");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_c + 2) . ':BC' .  ($hd_row_c + 2))->setCellValue('AR' .  ($hd_row_c + 2), "300 - 350 °C");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_c + 3) . ':AT' .  ($hd_row_c + 5))->setCellValue('AR' .  ($hd_row_c + 3), "pH");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_c + 6) . ':AT' .  ($hd_row_c + 6))->setCellValue('AR' .  ($hd_row_c + 6), "8,0 - 9,0");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_c + 3) . ':AW' .  ($hd_row_c + 4))->setCellValue('AU' .  ($hd_row_c + 3), "Conductivity");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_c + 5) . ':AW' .  ($hd_row_c + 5))->setCellValue('AU' .  ($hd_row_c + 5), "µs/ cm");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_c + 6) . ':AW' .  ($hd_row_c + 6))->setCellValue('AU' .  ($hd_row_c + 6), "≤10");
        $objPHPExcel->mergeCells('AX' .  ($hd_row_c + 3) . ':AZ' .  ($hd_row_c + 4))->setCellValue('AX' .  ($hd_row_c + 3), "Fe");
        $objPHPExcel->mergeCells('AX' .  ($hd_row_c + 5) . ':AZ' .  ($hd_row_c + 5))->setCellValue('AX' .  ($hd_row_c + 5), "ppm");
        $objPHPExcel->mergeCells('AX' .  ($hd_row_c + 6) . ':AZ' .  ($hd_row_c + 6))->setCellValue('AX' .  ($hd_row_c + 6), "0,1 max");
        $objPHPExcel->mergeCells('BA' .  ($hd_row_c + 3) . ':BC' .  ($hd_row_c + 4))->setCellValue('BA' .  ($hd_row_c + 3), "Silica");
        $objPHPExcel->mergeCells('BA' .  ($hd_row_c + 5) . ':BC' .  ($hd_row_c + 5))->setCellValue('BA' .  ($hd_row_c + 5), "ppm");
        $objPHPExcel->mergeCells('BA' .  ($hd_row_c + 6) . ':BC' .  ($hd_row_c + 6))->setCellValue('BA' .  ($hd_row_c + 6), "0,2 max");

        $objPHPExcel->mergeCells('BD' .  ($hd_row_c + 1) . ':BO' .  ($hd_row_c + 1))->setCellValue('BD' .  ($hd_row_c + 1), "Superheated Steam");
        $objPHPExcel->mergeCells('BD' .  ($hd_row_c + 2) . ':BO' .  ($hd_row_c + 2))->setCellValue('BD' .  ($hd_row_c + 2), "420 - 450 °C");
        $objPHPExcel->mergeCells('BD' .  ($hd_row_c + 3) . ':BF' .  ($hd_row_c + 5))->setCellValue('BD' .  ($hd_row_c + 3), "pH");
        $objPHPExcel->mergeCells('BD' .  ($hd_row_c + 6) . ':BF' .  ($hd_row_c + 6))->setCellValue('BD' .  ($hd_row_c + 6), "8.0 -9.0");
        $objPHPExcel->mergeCells('BG' .  ($hd_row_c + 3) . ':BI' .  ($hd_row_c + 4))->setCellValue('BG' .  ($hd_row_c + 3), "Conduc-tivity");
        $objPHPExcel->mergeCells('BG' .  ($hd_row_c + 5) . ':BI' .  ($hd_row_c + 5))->setCellValue('BG' .  ($hd_row_c + 5), "µs/ cm");
        $objPHPExcel->mergeCells('BG' .  ($hd_row_c + 6) . ':BI' .  ($hd_row_c + 6))->setCellValue('BG' .  ($hd_row_c + 6), "≤10");
        $objPHPExcel->mergeCells('BJ' .  ($hd_row_c + 3) . ':BL' .  ($hd_row_c + 4))->setCellValue('BJ' .  ($hd_row_c + 3), "Silica");
        $objPHPExcel->mergeCells('BJ' .  ($hd_row_c + 5) . ':BL' .  ($hd_row_c + 5))->setCellValue('BJ' .  ($hd_row_c + 5), "ppm");
        $objPHPExcel->mergeCells('BJ' .  ($hd_row_c + 6) . ':BL' .  ($hd_row_c + 6))->setCellValue('BJ' .  ($hd_row_c + 6), "0,1 max");
        $objPHPExcel->mergeCells('BM' .  ($hd_row_c + 3) . ':BO' .  ($hd_row_c + 4))->setCellValue('BM' .  ($hd_row_c + 3), "Fe");
        $objPHPExcel->mergeCells('BM' .  ($hd_row_c + 5) . ':BO' .  ($hd_row_c + 5))->setCellValue('BM' .  ($hd_row_c + 5), "ppm");
        $objPHPExcel->mergeCells('BM' .  ($hd_row_c + 6) . ':BO' .  ($hd_row_c + 6))->setCellValue('BM' .  ($hd_row_c + 6), "0.2 max");

        $objPHPExcel->mergeCells('BP' .  ($hd_row_c + 1) . ':BX' .  ($hd_row_c + 2))->setCellValue('BP' .  ($hd_row_c + 1), "Drain Tank");
        $objPHPExcel->mergeCells('BP' .  ($hd_row_c + 3) . ':BR' .  ($hd_row_c + 4))->setCellValue('BP' .  ($hd_row_c + 3), "Conductivity");
        $objPHPExcel->mergeCells('BP' .  ($hd_row_c + 5) . ':BR' .  ($hd_row_c + 5))->setCellValue('BP' .  ($hd_row_c + 5), "µs/ cm");
        $objPHPExcel->mergeCells('BP' .  ($hd_row_c + 6) . ':BR' .  ($hd_row_c + 6))->setCellValue('BP' .  ($hd_row_c + 6), "≤10");
        $objPHPExcel->mergeCells('BS' .  ($hd_row_c + 3) . ':BU' .  ($hd_row_c + 4))->setCellValue('BS' .  ($hd_row_c + 3), "T. Hardness");
        $objPHPExcel->mergeCells('BS' .  ($hd_row_c + 5) . ':BU' .  ($hd_row_c + 5))->setCellValue('BS' .  ($hd_row_c + 5), "µmol/L");
        $objPHPExcel->mergeCells('BS' .  ($hd_row_c + 6) . ':BU' .  ($hd_row_c + 6))->setCellValue('BS' .  ($hd_row_c + 6), "≤2.0");
        $objPHPExcel->mergeCells('BV' .  ($hd_row_c + 3) . ':BX' .  ($hd_row_c + 5))->setCellValue('BV' .  ($hd_row_c + 3), "pH");
        $objPHPExcel->mergeCells('BV' .  ($hd_row_c + 6) . ':BX' .  ($hd_row_c + 6))->setCellValue('BV' .  ($hd_row_c + 6), "8.0 - 9.0");
        $objPHPExcel->getStyle('B' . ($hd_row_c) . ':BX' . ($hd_row_c))->applyFromArray($noborderleftboldsize12);
        $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($hd_row_c + 1) . ':BX' . ($hd_row_c + 6));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hd_row_c) . ':A' .  ($hd_row_c + 6));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'CQ' . ($hd_row_c) . ':CQ' . ($hd_row_c + 6));

        $dtl_row_c = $hd_row_c + 7;
        for ($i = 1; $i <= $jml_data_c; $i++) {

            $objPHPExcel->getRowDimension($dtl_row_c)->setRowHeight(20);

            if (isset($c1_time[$i])) {
                $c1_time[$i] = $c1_time[$i];
            } else {
                $c1_time[$i] = "";
            }

            if (isset($c1_alkalinity[$i])) {
                $c1_alkalinity[$i] = $c1_alkalinity[$i];
            } else {
                $c1_alkalinity[$i] = "";
            }

            if (isset($c1_ph[$i])) {
                $c1_ph[$i] = $c1_ph[$i];
            } else {
                $c1_ph[$i] = "";
            }

            if (isset($c1_conductivity[$i])) {
                $c1_conductivity[$i] = $c1_conductivity[$i];
            } else {
                $c1_conductivity[$i] = "";
            }

            if (isset($c1_thardness[$i])) {
                $c1_thardness[$i] = $c1_thardness[$i];
            } else {
                $c1_thardness[$i] = "";
            }

            if (isset($c1_dissolvedoxygen[$i])) {
                $c1_dissolvedoxygen[$i] = $c1_dissolvedoxygen[$i];
            } else {
                $c1_dissolvedoxygen[$i] = "";
            }

            if (isset($c1_silica[$i])) {
                $c1_silica[$i] = $c1_silica[$i];
            } else {
                $c1_silica[$i] = "";
            }

            if (isset($c1_fe[$i])) {
                $c1_fe[$i] = $c1_fe[$i];
            } else {
                $c1_fe[$i] = "";
            }

            if (isset($c2_alkalinityp[$i])) {
                $c2_alkalinityp[$i] = $c2_alkalinityp[$i];
            } else {
                $c2_alkalinityp[$i] = "";
            }

            if (isset($c2_alkalinitym[$i])) {
                $c2_alkalinitym[$i] = $c2_alkalinitym[$i];
            } else {
                $c2_alkalinitym[$i] = "";
            }

            if (isset($c2_ph[$i])) {
                $c2_ph[$i] = $c2_ph[$i];
            } else {
                $c2_ph[$i] = "";
            }

            if (isset($c2_conductivity[$i])) {
                $c2_conductivity[$i] = $c2_conductivity[$i];
            } else {
                $c2_conductivity[$i] = "";
            }

            if (isset($c2_ion[$i])) {
                $c2_ion[$i] = $c2_ion[$i];
            } else {
                $c2_ion[$i] = "";
            }

            if (isset($c2_silica[$i])) {
                $c2_silica[$i] = $c2_silica[$i];
            } else {
                $c2_silica[$i] = "";
            }

            if (isset($c3_ph[$i])) {
                $c3_ph[$i] = $c3_ph[$i];
            } else {
                $c3_ph[$i] = "";
            }

            if (isset($c3_conductivity[$i])) {
                $c3_conductivity[$i] = $c3_conductivity[$i];
            } else {
                $c3_conductivity[$i] = "";
            }

            if (isset($c3_silica[$i])) {
                $c3_silica[$i] = $c3_silica[$i];
            } else {
                $c3_silica[$i] = "";
            }

            if (isset($c3_fe[$i])) {
                $c3_fe[$i] = $c3_fe[$i];
            } else {
                $c3_fe[$i] = "";
            }

            if (isset($c4_ph[$i])) {
                $c4_ph[$i] = $c4_ph[$i];
            } else {
                $c4_ph[$i] = "";
            }

            if (isset($c4_conductivity[$i])) {
                $c4_conductivity[$i] = $c4_conductivity[$i];
            } else {
                $c4_conductivity[$i] = "";
            }

            if (isset($c4_silica[$i])) {
                $c4_silica[$i] = $c4_silica[$i];
            } else {
                $c4_silica[$i] = "";
            }

            if (isset($c4_fe[$i])) {
                $c4_fe[$i] = $c4_fe[$i];
            } else {
                $c4_fe[$i] = "";
            }

            if (isset($c5_conductivity[$i])) {
                $c5_conductivity[$i] = $c5_conductivity[$i];
            } else {
                $c5_conductivity[$i] = "";
            }

            if (isset($c5_thardness[$i])) {
                $c5_thardness[$i] = $c5_thardness[$i];
            } else {
                $c5_thardness[$i] = "";
            }

            if (isset($c5_ph[$i])) {
                $c5_ph[$i] = $c5_ph[$i];
            } else {
                $c5_ph[$i] = "";
            }

            $objPHPExcel->mergeCells('B' .  $dtl_row_c . ':D' .  $dtl_row_c)->setCellValue('B' .  $dtl_row_c, $c1_time[$i]);
            $objPHPExcel->mergeCells('E' .  $dtl_row_c . ':G' .  $dtl_row_c)->setCellValue('E' .  $dtl_row_c, $c1_alkalinity[$i]);
            $objPHPExcel->mergeCells('H' .  $dtl_row_c . ':J' .  $dtl_row_c)->setCellValue('H' .  $dtl_row_c, $c1_ph[$i]);
            $objPHPExcel->mergeCells('K' .  $dtl_row_c . ':M' .  $dtl_row_c)->setCellValue('K' .  $dtl_row_c, $c1_conductivity[$i]);
            $objPHPExcel->mergeCells('N' .  $dtl_row_c . ':P' .  $dtl_row_c)->setCellValue('N' .  $dtl_row_c, $c1_thardness[$i]);
            $objPHPExcel->mergeCells('Q' .  $dtl_row_c . ':S' .  $dtl_row_c)->setCellValue('Q' .  $dtl_row_c, $c1_dissolvedoxygen[$i]);
            $objPHPExcel->mergeCells('T' .  $dtl_row_c . ':V' .  $dtl_row_c)->setCellValue('T' .  $dtl_row_c, $c1_silica[$i]);
            $objPHPExcel->mergeCells('W' .  $dtl_row_c . ':Y' .  $dtl_row_c)->setCellValue('W' .  $dtl_row_c, $c1_fe[$i]);
            $objPHPExcel->mergeCells('Z' .  $dtl_row_c . ':AB' .  $dtl_row_c)->setCellValue('Z' .  $dtl_row_c, $c2_alkalinityp[$i]);
            $objPHPExcel->mergeCells('AC' .  $dtl_row_c . ':AE' .  $dtl_row_c)->setCellValue('AC' .  $dtl_row_c, $c2_alkalinitym[$i]);
            $objPHPExcel->mergeCells('AF' .  $dtl_row_c . ':AH' .  $dtl_row_c)->setCellValue('AF' .  $dtl_row_c, $c2_ph[$i]);
            $objPHPExcel->mergeCells('AI' .  $dtl_row_c . ':AK' .  $dtl_row_c)->setCellValue('AI' .  $dtl_row_c, $c2_conductivity[$i]);
            $objPHPExcel->mergeCells('AL' .  $dtl_row_c . ':AN' .  $dtl_row_c)->setCellValue('AL' .  $dtl_row_c, $c2_ion[$i]);
            $objPHPExcel->mergeCells('AO' .  $dtl_row_c . ':AQ' .  $dtl_row_c)->setCellValue('AO' .  $dtl_row_c, $c2_silica[$i]);
            $objPHPExcel->mergeCells('AR' .  $dtl_row_c . ':AT' .  $dtl_row_c)->setCellValue('AR' .  $dtl_row_c, $c3_ph[$i]);
            $objPHPExcel->mergeCells('AU' .  $dtl_row_c . ':AW' .  $dtl_row_c)->setCellValue('AU' .  $dtl_row_c, $c3_conductivity[$i]);
            $objPHPExcel->mergeCells('AX' .  $dtl_row_c . ':AZ' .  $dtl_row_c)->setCellValue('AX' .  $dtl_row_c, $c3_silica[$i]);
            $objPHPExcel->mergeCells('BA' .  $dtl_row_c . ':BC' .  $dtl_row_c)->setCellValue('BA' .  $dtl_row_c, $c3_fe[$i]);
            $objPHPExcel->mergeCells('BD' .  $dtl_row_c . ':BF' .  $dtl_row_c)->setCellValue('BD' .  $dtl_row_c, $c4_ph[$i]);
            $objPHPExcel->mergeCells('BG' .  $dtl_row_c . ':BI' .  $dtl_row_c)->setCellValue('BG' .  $dtl_row_c, $c4_conductivity[$i]);
            $objPHPExcel->mergeCells('BJ' .  $dtl_row_c . ':BL' .  $dtl_row_c)->setCellValue('BJ' .  $dtl_row_c, $c4_silica[$i]);
            $objPHPExcel->mergeCells('BM' .  $dtl_row_c . ':BO' .  $dtl_row_c)->setCellValue('BM' .  $dtl_row_c, $c4_fe[$i]);
            $objPHPExcel->mergeCells('BP' .  $dtl_row_c . ':BR' .  $dtl_row_c)->setCellValue('BP' .  $dtl_row_c, $c5_conductivity[$i]);
            $objPHPExcel->mergeCells('BS' .  $dtl_row_c . ':BU' .  $dtl_row_c)->setCellValue('BS' .  $dtl_row_c, $c5_thardness[$i]);
            $objPHPExcel->mergeCells('BV' .  $dtl_row_c . ':BX' .  $dtl_row_c)->setCellValue('BV' .  $dtl_row_c, $c5_ph[$i]);
            $objPHPExcel->setSharedStyle($DetailStyle, 'B' . $dtl_row_c  . ':BX' . $dtl_row_c);
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' . $dtl_row_c . ':A' . $dtl_row_c);
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'CQ' . $dtl_row_c . ':CQ' . $dtl_row_c);

            $dtl_row_c++;
        }

        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row_c) . ':A' .  ($dtl_row_c + 2));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'CQ' . ($dtl_row_c) . ':CQ' . ($dtl_row_c + 2));

        $hd_row_d = $dtl_row_c + 2;
        $objPHPExcel->mergeCells('B' .  ($hd_row_d) . ':CP' .  ($hd_row_d))->setCellValue('B' .  ($hd_row_d), "Water Analyis Results");
        $objPHPExcel->mergeCells('B' .  ($hd_row_d + 1) . ':D' .  ($hd_row_d + 2))->setCellValue('B' .  ($hd_row_d + 1), "Sampling Point");
        $objPHPExcel->mergeCells('B' .  ($hd_row_d + 3) . ':D' .  ($hd_row_d + 6))->setCellValue('B' .  ($hd_row_d + 3), "Time");
        $objPHPExcel->mergeCells('E' .  ($hd_row_d + 1) . ':V' .  ($hd_row_d + 2))->setCellValue('E' .  ($hd_row_d + 1), "Water Analyis Results");
        $objPHPExcel->mergeCells('E' .  ($hd_row_d + 3) . ':G' .  ($hd_row_d + 4))->setCellValue('E' .  ($hd_row_d + 3), "T. Hardness");
        $objPHPExcel->mergeCells('E' .  ($hd_row_d + 5) . ':G' .  ($hd_row_d + 5))->setCellValue('E' .  ($hd_row_d + 5), "µmol/L");
        $objPHPExcel->mergeCells('E' .  ($hd_row_d + 6) . ':G' .  ($hd_row_d + 6))->setCellValue('E' .  ($hd_row_d + 6), "≤2.0");
        $objPHPExcel->mergeCells('H' .  ($hd_row_d + 3) . ':J' .  ($hd_row_d + 5))->setCellValue('H' .  ($hd_row_d + 3), "pH");
        $objPHPExcel->mergeCells('H' .  ($hd_row_d + 6) . ':J' .  ($hd_row_d + 6))->setCellValue('H' .  ($hd_row_d + 6), "8.0 -9.0");
        $objPHPExcel->mergeCells('K' .  ($hd_row_d + 3) . ':M' .  ($hd_row_d + 4))->setCellValue('K' .  ($hd_row_d + 3), "Conduc- tivity");
        $objPHPExcel->mergeCells('K' .  ($hd_row_d + 5) . ':M' .  ($hd_row_d + 5))->setCellValue('K' .  ($hd_row_d + 5), "µs/ cm");
        $objPHPExcel->mergeCells('K' .  ($hd_row_d + 6) . ':M' .  ($hd_row_d + 6))->setCellValue('K' .  ($hd_row_d + 6), "≤10");
        $objPHPExcel->mergeCells('N' .  ($hd_row_d + 3) . ':P' .  ($hd_row_d + 4))->setCellValue('N' .  ($hd_row_d + 3), "Dissolved Oxygen");
        $objPHPExcel->mergeCells('N' .  ($hd_row_d + 5) . ':P' .  ($hd_row_d + 5))->setCellValue('N' .  ($hd_row_d + 5), "ppb O2");
        $objPHPExcel->mergeCells('N' .  ($hd_row_d + 6) . ':P' .  ($hd_row_d + 6))->setCellValue('N' .  ($hd_row_d + 6), "≤ 50");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_d + 3) . ':S' .  ($hd_row_d + 4))->setCellValue('Q' .  ($hd_row_d + 3), "Silica");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_d + 5) . ':S' .  ($hd_row_d + 5))->setCellValue('Q' .  ($hd_row_d + 5), "ppm");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_d + 6) . ':S' .  ($hd_row_d + 6))->setCellValue('Q' .  ($hd_row_d + 6), "0,2 max");
        $objPHPExcel->mergeCells('T' .  ($hd_row_d + 3) . ':V' .  ($hd_row_d + 4))->setCellValue('T' .  ($hd_row_d + 3), "Fe");
        $objPHPExcel->mergeCells('T' .  ($hd_row_d + 5) . ':V' .  ($hd_row_d + 5))->setCellValue('T' .  ($hd_row_d + 5), "ppm");
        $objPHPExcel->mergeCells('T' .  ($hd_row_d + 6) . ':V' .  ($hd_row_d + 6))->setCellValue('T' .  ($hd_row_d + 6), "0,1 max");

        $objPHPExcel->mergeCells('W' .  ($hd_row_d + 1) . ':AN' .  ($hd_row_d + 2))->setCellValue('W' .  ($hd_row_d + 1), "Condensed Turbine Water ( #2)");
        $objPHPExcel->mergeCells('W' .  ($hd_row_d + 3) . ':Y' .  ($hd_row_d + 4))->setCellValue('W' .  ($hd_row_d + 3), "T. Hardness");
        $objPHPExcel->mergeCells('W' .  ($hd_row_d + 5) . ':Y' .  ($hd_row_d + 5))->setCellValue('W' .  ($hd_row_d + 5), "µmol/L");
        $objPHPExcel->mergeCells('W' .  ($hd_row_d + 6) . ':Y' .  ($hd_row_d + 6))->setCellValue('W' .  ($hd_row_d + 6), "≤3.0");
        $objPHPExcel->mergeCells('Z' .  ($hd_row_d + 3) . ':AB' .  ($hd_row_d + 5))->setCellValue('Z' .  ($hd_row_d + 3), "pH");
        $objPHPExcel->mergeCells('Z' .  ($hd_row_d + 6) . ':AB' .  ($hd_row_d + 6))->setCellValue('Z' .  ($hd_row_d + 6), "8.0 -9.0");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_d + 3) . ':AE' .  ($hd_row_d + 4))->setCellValue('AC' .  ($hd_row_d + 3), "Conduc- tivity");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_d + 5) . ':AE' .  ($hd_row_d + 5))->setCellValue('AC' .  ($hd_row_d + 5), "µs/ cm");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_d + 6) . ':AE' .  ($hd_row_d + 6))->setCellValue('AC' .  ($hd_row_d + 6), "≤10");
        $objPHPExcel->mergeCells('AF' .  ($hd_row_d + 3) . ':AH' .  ($hd_row_d + 4))->setCellValue('AF' .  ($hd_row_d + 3), "Dissolved Oxygen");
        $objPHPExcel->mergeCells('AF' .  ($hd_row_d + 5) . ':AH' .  ($hd_row_d + 5))->setCellValue('AF' .  ($hd_row_d + 5), "ppb O2");
        $objPHPExcel->mergeCells('AF' .  ($hd_row_d + 6) . ':AH' .  ($hd_row_d + 6))->setCellValue('AF' .  ($hd_row_d + 6), "≤ 50");
        $objPHPExcel->mergeCells('AI' .  ($hd_row_d + 3) . ':AK' .  ($hd_row_d + 4))->setCellValue('AI' .  ($hd_row_d + 3), "Silica");
        $objPHPExcel->mergeCells('AI' .  ($hd_row_d + 5) . ':AK' .  ($hd_row_d + 5))->setCellValue('AI' .  ($hd_row_d + 5), "ppm");
        $objPHPExcel->mergeCells('AI' .  ($hd_row_d + 6) . ':AK' .  ($hd_row_d + 6))->setCellValue('AI' .  ($hd_row_d + 6), "0,2 max");
        $objPHPExcel->mergeCells('AL' .  ($hd_row_d + 3) . ':AN' .  ($hd_row_d + 4))->setCellValue('AL' .  ($hd_row_d + 3), "Fe");
        $objPHPExcel->mergeCells('AL' .  ($hd_row_d + 5) . ':AN' .  ($hd_row_d + 5))->setCellValue('AL' .  ($hd_row_d + 5), "ppm");
        $objPHPExcel->mergeCells('AL' .  ($hd_row_d + 6) . ':AN' .  ($hd_row_d + 6))->setCellValue('AL' .  ($hd_row_d + 6), "0,1 max");

        $objPHPExcel->mergeCells('AO' .  ($hd_row_d + 1) . ':BO' .  ($hd_row_d + 2))->setCellValue('AO' .  ($hd_row_d + 1), "Cooling System Water");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_d + 3) . ':AQ' .  ($hd_row_d + 3))->setCellValue('AO' .  ($hd_row_d + 3), "Alkal-inity");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_d + 4) . ':AQ' .  ($hd_row_d + 4))->setCellValue('AO' .  ($hd_row_d + 4), "M");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_d + 5) . ':AQ' .  ($hd_row_d + 5))->setCellValue('AO' .  ($hd_row_d + 5), "ppm");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_d + 6) . ':AQ' .  ($hd_row_d + 6))->setCellValue('AO' .  ($hd_row_d + 6), "≤ 800");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_d + 3) . ':AT' .  ($hd_row_d + 4))->setCellValue('AR' .  ($hd_row_d + 3), "Conduc- tivity");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_d + 5) . ':AT' .  ($hd_row_d + 5))->setCellValue('AR' .  ($hd_row_d + 5), "µs/ cm");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_d + 6) . ':AT' .  ($hd_row_d + 6))->setCellValue('AR' .  ($hd_row_d + 6), "max 3500");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_d + 3) . ':AW' .  ($hd_row_d + 4))->setCellValue('AU' .  ($hd_row_d + 3), "T. Hardness ");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_d + 5) . ':AW' .  ($hd_row_d + 5))->setCellValue('AU' .  ($hd_row_d + 5), "ppm");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_d + 6) . ':AW' .  ($hd_row_d + 6))->setCellValue('AU' .  ($hd_row_d + 6), "≤ 500");
        $objPHPExcel->mergeCells('AX' .  ($hd_row_d + 3) . ':AZ' .  ($hd_row_d + 5))->setCellValue('AX' .  ($hd_row_d + 3), "pH");
        $objPHPExcel->mergeCells('AX' .  ($hd_row_d + 6) . ':AZ' .  ($hd_row_d + 6))->setCellValue('AX' .  ($hd_row_d + 6), "7,5 - 9,5");
        $objPHPExcel->mergeCells('BA' .  ($hd_row_d + 3) . ':BF' .  ($hd_row_d + 4))->setCellValue('BA' .  ($hd_row_d + 3), "Suhu");
        $objPHPExcel->mergeCells('BA' .  ($hd_row_d + 5) . ':BF' .  ($hd_row_d + 5))->setCellValue('BA' .  ($hd_row_d + 5), "oC");
        $objPHPExcel->mergeCells('BA' .  ($hd_row_d + 6) . ':BC' .  ($hd_row_d + 6))->setCellValue('BA' .  ($hd_row_d + 6), "Inlet");
        $objPHPExcel->mergeCells('BD' .  ($hd_row_d + 6) . ':BF' .  ($hd_row_d + 6))->setCellValue('BD' .  ($hd_row_d + 6), "Outlet");
        $objPHPExcel->mergeCells('BG' .  ($hd_row_d + 3) . ':BI' .  ($hd_row_d + 4))->setCellValue('BG' .  ($hd_row_d + 3), "Turbuditi");
        $objPHPExcel->mergeCells('BG' .  ($hd_row_d + 5) . ':BI' .  ($hd_row_d + 5))->setCellValue('BG' .  ($hd_row_d + 5), "NTU");
        $objPHPExcel->mergeCells('BG' .  ($hd_row_d + 6) . ':BI' .  ($hd_row_d + 6))->setCellValue('BG' .  ($hd_row_d + 6), "≤40");
        $objPHPExcel->mergeCells('BJ' .  ($hd_row_d + 3) . ':BL' .  ($hd_row_d + 4))->setCellValue('BJ' .  ($hd_row_d + 3), "Cl-");
        $objPHPExcel->mergeCells('BJ' .  ($hd_row_d + 5) . ':BL' .  ($hd_row_d + 5))->setCellValue('BJ' .  ($hd_row_d + 5), "ppm");
        $objPHPExcel->mergeCells('BJ' .  ($hd_row_d + 6) . ':BL' .  ($hd_row_d + 6))->setCellValue('BJ' .  ($hd_row_d + 6), "≤ 300");
        $objPHPExcel->mergeCells('BM' .  ($hd_row_d + 3) . ':BO' .  ($hd_row_d + 4))->setCellValue('BM' .  ($hd_row_d + 3), "Free Cl2");
        $objPHPExcel->mergeCells('BM' .  ($hd_row_d + 5) . ':BO' .  ($hd_row_d + 5))->setCellValue('BM' .  ($hd_row_d + 5), "ppm");
        $objPHPExcel->mergeCells('BM' .  ($hd_row_d + 6) . ':BO' .  ($hd_row_d + 6))->setCellValue('BM' .  ($hd_row_d + 6), "0,5 - 1,0");

        $objPHPExcel->mergeCells('BP' .  ($hd_row_d + 1) . ':CG' .  ($hd_row_d + 2))->setCellValue('BP' .  ($hd_row_d + 1), "Make Up Cooling System Water ( ASF )");
        $objPHPExcel->mergeCells('BP' .  ($hd_row_d + 3) . ':BR' .  ($hd_row_d + 4))->setCellValue('BP' .  ($hd_row_d + 3), "T. Hardness");
        $objPHPExcel->mergeCells('BP' .  ($hd_row_d + 5) . ':BR' .  ($hd_row_d + 5))->setCellValue('BP' .  ($hd_row_d + 5), "ppm (max)");
        $objPHPExcel->mergeCells('BP' .  ($hd_row_d + 6) . ':BR' .  ($hd_row_d + 6))->setCellValue('BP' .  ($hd_row_d + 6), "50");
        $objPHPExcel->mergeCells('BS' .  ($hd_row_d + 3) . ':BU' .  ($hd_row_d + 5))->setCellValue('BS' .  ($hd_row_d + 3), "pH");
        $objPHPExcel->mergeCells('BS' .  ($hd_row_d + 6) . ':BU' .  ($hd_row_d + 6))->setCellValue('BS' .  ($hd_row_d + 6), "6,5 - 8,5");
        $objPHPExcel->mergeCells('BV' .  ($hd_row_d + 3) . ':BX' .  ($hd_row_d + 4))->setCellValue('BV' .  ($hd_row_d + 3), "Conduc- tivity");
        $objPHPExcel->mergeCells('BV' .  ($hd_row_d + 5) . ':BX' .  ($hd_row_d + 5))->setCellValue('BV' .  ($hd_row_d + 5), "µs/ cm");
        $objPHPExcel->mergeCells('BV' .  ($hd_row_d + 6) . ':BX' .  ($hd_row_d + 6))->setCellValue('BV' .  ($hd_row_d + 6), "≤1000");
        $objPHPExcel->mergeCells('BY' .  ($hd_row_d + 3) . ':CA' .  ($hd_row_d + 4))->setCellValue('BY' .  ($hd_row_d + 3), "Turbuditi");
        $objPHPExcel->mergeCells('BY' .  ($hd_row_d + 5) . ':CA' .  ($hd_row_d + 5))->setCellValue('BY' .  ($hd_row_d + 5), "NTU");
        $objPHPExcel->mergeCells('BY' .  ($hd_row_d + 6) . ':CA' .  ($hd_row_d + 6))->setCellValue('BY' .  ($hd_row_d + 6), "≤5");
        $objPHPExcel->mergeCells('CB' .  ($hd_row_d + 3) . ':CD' .  ($hd_row_d + 4))->setCellValue('CB' .  ($hd_row_d + 3), "Cl-");
        $objPHPExcel->mergeCells('CB' .  ($hd_row_d + 5) . ':CD' .  ($hd_row_d + 5))->setCellValue('CB' .  ($hd_row_d + 5), "ppm");
        $objPHPExcel->mergeCells('CB' .  ($hd_row_d + 6) . ':CD' .  ($hd_row_d + 6))->setCellValue('CB' .  ($hd_row_d + 6), "≤ 250");
        $objPHPExcel->mergeCells('CE' .  ($hd_row_d + 3) . ':CG' .  ($hd_row_d + 4))->setCellValue('CE' .  ($hd_row_d + 3), "Free Cl2");
        $objPHPExcel->mergeCells('CE' .  ($hd_row_d + 5) . ':CG' .  ($hd_row_d + 5))->setCellValue('CE' .  ($hd_row_d + 5), "ppm");
        $objPHPExcel->mergeCells('CE' .  ($hd_row_d + 6) . ':CG' .  ($hd_row_d + 6))->setCellValue('CE' .  ($hd_row_d + 6), "0,1 - 0,6");

        $objPHPExcel->mergeCells('CH' .  ($hd_row_d + 1) . ':CP' .  ($hd_row_d + 2))->setCellValue('CH' .  ($hd_row_d + 1), "DEMIN WATER");
        $objPHPExcel->mergeCells('CH' .  ($hd_row_d + 3) . ':CJ' .  ($hd_row_d + 5))->setCellValue('CH' .  ($hd_row_d + 3), "pH");
        $objPHPExcel->mergeCells('CH' .  ($hd_row_d + 6) . ':CJ' .  ($hd_row_d + 6))->setCellValue('CH' .  ($hd_row_d + 6), "6,5 - 9,2");
        $objPHPExcel->mergeCells('CK' .  ($hd_row_d + 3) . ':CM' .  ($hd_row_d + 4))->setCellValue('CK' .  ($hd_row_d + 3), "Conducti-vity");
        $objPHPExcel->mergeCells('CK' .  ($hd_row_d + 5) . ':CM' .  ($hd_row_d + 5))->setCellValue('CK' .  ($hd_row_d + 5), "µs/ cm");
        $objPHPExcel->mergeCells('CK' .  ($hd_row_d + 6) . ':CM' .  ($hd_row_d + 6))->setCellValue('CK' .  ($hd_row_d + 6), "≤10");
        $objPHPExcel->mergeCells('CN' .  ($hd_row_d + 3) . ':CP' .  ($hd_row_d + 4))->setCellValue('CN' .  ($hd_row_d + 3), "Hard-ness");
        $objPHPExcel->mergeCells('CN' .  ($hd_row_d + 5) . ':CP' .  ($hd_row_d + 5))->setCellValue('CN' .  ($hd_row_d + 5), "mmol/ L");
        $objPHPExcel->mergeCells('CN' .  ($hd_row_d + 6) . ':CP' .  ($hd_row_d + 6))->setCellValue('CN' .  ($hd_row_d + 6), "0");
        $objPHPExcel->getStyle('B' . ($hd_row_d) . ':CP' . ($hd_row_d))->applyFromArray($noborderleftboldsize12);
        $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($hd_row_d + 1) . ':CP' . ($hd_row_d + 6));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hd_row_d) . ':A' .  ($hd_row_d + 6));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'CQ' . ($hd_row_d) . ':CQ' . ($hd_row_d + 6));

        $dtl_row_d = $hd_row_d + 7;
        for ($i = 1; $i <= $jml_data_d; $i++) {

            $objPHPExcel->getRowDimension($dtl_row_d)->setRowHeight(20);

            if (isset($d1_time[$i])) {
                $d1_time[$i] = $d1_time[$i];
            } else {
                $d1_time[$i] = "";
            }

            if (isset($d1_thardness[$i])) {
                $d1_thardness[$i] = $d1_thardness[$i];
            } else {
                $d1_thardness[$i] = "";
            }

            if (isset($d1_ph[$i])) {
                $d1_ph[$i] = $d1_ph[$i];
            } else {
                $d1_ph[$i] = "";
            }

            if (isset($d1_conductivity[$i])) {
                $d1_conductivity[$i] = $d1_conductivity[$i];
            } else {
                $d1_conductivity[$i] = "";
            }

            if (isset($d1_dissolvedoxygen[$i])) {
                $d1_dissolvedoxygen[$i] = $d1_dissolvedoxygen[$i];
            } else {
                $d1_dissolvedoxygen[$i] = "";
            }

            if (isset($d1_silica[$i])) {
                $d1_silica[$i] = $d1_silica[$i];
            } else {
                $d1_silica[$i] = "";
            }

            if (isset($d1_fe[$i])) {
                $d1_fe[$i] = $d1_fe[$i];
            } else {
                $d1_fe[$i] = "";
            }

            if (isset($d2_time[$i])) {
                $d2_time[$i] = $d2_time[$i];
            } else {
                $d2_time[$i] = "";
            }

            if (isset($d2_thardness[$i])) {
                $d2_thardness[$i] = $d2_thardness[$i];
            } else {
                $d2_thardness[$i] = "";
            }

            if (isset($d2_ph[$i])) {
                $d2_ph[$i] = $d2_ph[$i];
            } else {
                $d2_ph[$i] = "";
            }

            if (isset($d2_conductivity[$i])) {
                $d2_conductivity[$i] = $d2_conductivity[$i];
            } else {
                $d2_conductivity[$i] = "";
            }

            if (isset($d2_dissolvedoxygen[$i])) {
                $d2_dissolvedoxygen[$i] = $d2_dissolvedoxygen[$i];
            } else {
                $d2_dissolvedoxygen[$i] = "";
            }

            if (isset($d2_silica[$i])) {
                $d2_silica[$i] = $d2_silica[$i];
            } else {
                $d2_silica[$i] = "";
            }

            if (isset($d2_fe[$i])) {
                $d2_fe[$i] = $d2_fe[$i];
            } else {
                $d2_fe[$i] = "";
            }

            if (isset($d3_time[$i])) {
                $d3_time[$i] = $d3_time[$i];
            } else {
                $d3_time[$i] = "";
            }

            if (isset($d3_alkalinity[$i])) {
                $d3_alkalinity[$i] = $d3_alkalinity[$i];
            } else {
                $d3_alkalinity[$i] = "";
            }

            if (isset($d3_conductivity[$i])) {
                $d3_conductivity[$i] = $d3_conductivity[$i];
            } else {
                $d3_conductivity[$i] = "";
            }

            if (isset($d3_thardness[$i])) {
                $d3_thardness[$i] = $d3_thardness[$i];
            } else {
                $d3_thardness[$i] = "";
            }

            if (isset($d3_ph[$i])) {
                $d3_ph[$i] = $d3_ph[$i];
            } else {
                $d3_ph[$i] = "";
            }

            if (isset($d3_suhu_inlet[$i])) {
                $d3_suhu_inlet[$i] = $d3_suhu_inlet[$i];
            } else {
                $d3_suhu_inlet[$i] = "";
            }

            if (isset($d3_suhu_outlet[$i])) {
                $d3_suhu_outlet[$i] = $d3_suhu_outlet[$i];
            } else {
                $d3_suhu_outlet[$i] = "";
            }

            if (isset($d3_turbuditi[$i])) {
                $d3_turbuditi[$i] = $d3_turbuditi[$i];
            } else {
                $d3_turbuditi[$i] = "";
            }

            if (isset($d3_ci[$i])) {
                $d3_ci[$i] = $d3_ci[$i];
            } else {
                $d3_ci[$i] = "";
            }

            if (isset($d3_freeci2[$i])) {
                $d3_freeci2[$i] = $d3_freeci2[$i];
            } else {
                $d3_freeci2[$i] = "";
            }

            if (isset($d4_time[$i])) {
                $d4_time[$i] = $d4_time[$i];
            } else {
                $d4_time[$i] = "";
            }

            if (isset($d4_thardness[$i])) {
                $d4_thardness[$i] = $d4_thardness[$i];
            } else {
                $d4_thardness[$i] = "";
            }

            if (isset($d4_ph[$i])) {
                $d4_ph[$i] = $d4_ph[$i];
            } else {
                $d4_ph[$i] = "";
            }

            if (isset($d4_conductivity[$i])) {
                $d4_conductivity[$i] = $d4_conductivity[$i];
            } else {
                $d4_conductivity[$i] = "";
            }

            if (isset($d4_turbuditi[$i])) {
                $d4_turbuditi[$i] = $d4_turbuditi[$i];
            } else {
                $d4_turbuditi[$i] = "";
            }

            if (isset($d4_ci[$i])) {
                $d4_ci[$i] = $d4_ci[$i];
            } else {
                $d4_ci[$i] = "";
            }

            if (isset($d4_freeci2[$i])) {
                $d4_freeci2[$i] = $d4_freeci2[$i];
            } else {
                $d4_freeci2[$i] = "";
            }

            if (isset($d5_time[$i])) {
                $d5_time[$i] = $d5_time[$i];
            } else {
                $d5_time[$i] = "";
            }

            if (isset($d5_ph[$i])) {
                $d5_ph[$i] = $d5_ph[$i];
            } else {
                $d5_ph[$i] = "";
            }

            if (isset($d5_conductivity[$i])) {
                $d5_conductivity[$i] = $d5_conductivity[$i];
            } else {
                $d5_conductivity[$i] = "";
            }

            if (isset($d5_hardness[$i])) {
                $d5_hardness[$i] = $d5_hardness[$i];
            } else {
                $d5_hardness[$i] = "";
            }

            $objPHPExcel->mergeCells('B' .  $dtl_row_d . ':D' .  $dtl_row_d)->setCellValue('B' .  $dtl_row_d, $d1_time[$i]);
            $objPHPExcel->mergeCells('E' .  $dtl_row_d . ':G' .  $dtl_row_d)->setCellValue('E' .  $dtl_row_d, $d1_thardness[$i]);
            $objPHPExcel->mergeCells('H' .  $dtl_row_d . ':J' .  $dtl_row_d)->setCellValue('H' .  $dtl_row_d, $d1_ph[$i]);
            $objPHPExcel->mergeCells('K' .  $dtl_row_d . ':M' .  $dtl_row_d)->setCellValue('K' .  $dtl_row_d, $d1_conductivity[$i]);
            $objPHPExcel->mergeCells('N' .  $dtl_row_d . ':P' .  $dtl_row_d)->setCellValue('N' .  $dtl_row_d, $d1_dissolvedoxygen[$i]);
            $objPHPExcel->mergeCells('Q' .  $dtl_row_d . ':S' .  $dtl_row_d)->setCellValue('Q' .  $dtl_row_d, $d1_silica[$i]);
            $objPHPExcel->mergeCells('T' .  $dtl_row_d . ':V' .  $dtl_row_d)->setCellValue('T' .  $dtl_row_d, $d1_fe[$i]);
            $objPHPExcel->mergeCells('W' .  $dtl_row_d . ':Y' .  $dtl_row_d)->setCellValue('W' .  $dtl_row_d, $d2_thardness[$i]);
            $objPHPExcel->mergeCells('Z' .  $dtl_row_d . ':AB' .  $dtl_row_d)->setCellValue('Z' .  $dtl_row_d, $d2_ph[$i]);
            $objPHPExcel->mergeCells('AC' .  $dtl_row_d . ':AE' .  $dtl_row_d)->setCellValue('AC' .  $dtl_row_d, $d2_conductivity[$i]);
            $objPHPExcel->mergeCells('AF' .  $dtl_row_d . ':AH' .  $dtl_row_d)->setCellValue('AF' .  $dtl_row_d, $d2_dissolvedoxygen[$i]);
            $objPHPExcel->mergeCells('AI' .  $dtl_row_d . ':AK' .  $dtl_row_d)->setCellValue('AI' .  $dtl_row_d, $d2_silica[$i]);
            $objPHPExcel->mergeCells('AL' .  $dtl_row_d . ':AN' .  $dtl_row_d)->setCellValue('AL' .  $dtl_row_d, $d2_fe[$i]);
            $objPHPExcel->mergeCells('AO' .  $dtl_row_d . ':AQ' .  $dtl_row_d)->setCellValue('AO' .  $dtl_row_d, $d3_alkalinity[$i]);
            $objPHPExcel->mergeCells('AR' .  $dtl_row_d . ':AT' .  $dtl_row_d)->setCellValue('AR' .  $dtl_row_d, $d3_conductivity[$i]);
            $objPHPExcel->mergeCells('AU' .  $dtl_row_d . ':AW' .  $dtl_row_d)->setCellValue('AU' .  $dtl_row_d, $d3_thardness[$i]);
            $objPHPExcel->mergeCells('AX' .  $dtl_row_d . ':AZ' .  $dtl_row_d)->setCellValue('AX' .  $dtl_row_d, $d3_ph[$i]);
            $objPHPExcel->mergeCells('BA' .  $dtl_row_d . ':BC' .  $dtl_row_d)->setCellValue('BA' .  $dtl_row_d, $d3_suhu_inlet[$i]);
            $objPHPExcel->mergeCells('BD' .  $dtl_row_d . ':BF' .  $dtl_row_d)->setCellValue('BD' .  $dtl_row_d, $d3_suhu_outlet[$i]);
            $objPHPExcel->mergeCells('BG' .  $dtl_row_d . ':BI' .  $dtl_row_d)->setCellValue('BG' .  $dtl_row_d, $d3_turbuditi[$i]);
            $objPHPExcel->mergeCells('BJ' .  $dtl_row_d . ':BL' .  $dtl_row_d)->setCellValue('BJ' .  $dtl_row_d, $d3_ci[$i]);
            $objPHPExcel->mergeCells('BM' .  $dtl_row_d . ':BO' .  $dtl_row_d)->setCellValue('BM' .  $dtl_row_d, $d3_freeci2[$i]);
            $objPHPExcel->mergeCells('BP' .  $dtl_row_d . ':BR' .  $dtl_row_d)->setCellValue('BP' .  $dtl_row_d, $d4_thardness[$i]);
            $objPHPExcel->mergeCells('BS' .  $dtl_row_d . ':BU' .  $dtl_row_d)->setCellValue('BS' .  $dtl_row_d, $d4_ph[$i]);
            $objPHPExcel->mergeCells('BV' .  $dtl_row_d . ':BX' .  $dtl_row_d)->setCellValue('BV' .  $dtl_row_d, $d4_conductivity[$i]);
            $objPHPExcel->mergeCells('BY' .  $dtl_row_d . ':CA' .  $dtl_row_d)->setCellValue('BY' .  $dtl_row_d, $d4_turbuditi[$i]);
            $objPHPExcel->mergeCells('CB' .  $dtl_row_d . ':CD' .  $dtl_row_d)->setCellValue('CB' .  $dtl_row_d, $d4_ci[$i]);
            $objPHPExcel->mergeCells('CE' .  $dtl_row_d . ':CG' .  $dtl_row_d)->setCellValue('CE' .  $dtl_row_d, $d4_freeci2[$i]);
            $objPHPExcel->mergeCells('CH' .  $dtl_row_d . ':CJ' .  $dtl_row_d)->setCellValue('CH' .  $dtl_row_d, $d5_ph[$i]);
            $objPHPExcel->mergeCells('CK' .  $dtl_row_d . ':CN' .  $dtl_row_d)->setCellValue('CK' .  $dtl_row_d, $d5_conductivity[$i]);
            $objPHPExcel->mergeCells('CN' .  $dtl_row_d . ':CP' .  $dtl_row_d)->setCellValue('CN' .  $dtl_row_d, $d5_hardness[$i]);
            $objPHPExcel->setSharedStyle($DetailStyle, 'B' . $dtl_row_d  . ':CP' . $dtl_row_d);
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' . $dtl_row_d . ':A' . $dtl_row_d);
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'CQ' . $dtl_row_d . ':CQ' . $dtl_row_d);

            $dtl_row_d++;
        }

        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row_d) . ':A' .  ($dtl_row_d + 2));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'CQ' . ($dtl_row_d) . ':CQ' . ($dtl_row_d + 2));

        $ftr_row_2 = $dtl_row_d + 2;
        $objPHPExcel->mergeCells('B' .  ($ftr_row_2) . ':F' .  ($ftr_row_2))->setCellValue('B' .  ($ftr_row_2), "Notifications :");
        $objPHPExcel->mergeCells('G' .  ($ftr_row_2  + 1) . ':I' .  ($ftr_row_2 + 1))->setCellValue('G' .  ($ftr_row_2 + 1), "");
        $objPHPExcel->mergeCells('J' .  ($ftr_row_2  + 1) . ':Q' .  ($ftr_row_2 + 1))->setCellValue('J' .  ($ftr_row_2 + 1), ": Not analyzed");
        $objPHPExcel->mergeCells('G' .  ($ftr_row_2  + 2) . ':I' .  ($ftr_row_2 + 2))->setCellValue('G' .  ($ftr_row_2 + 2), "");
        $objPHPExcel->mergeCells('J' .  ($ftr_row_2  + 2) . ':Q' .  ($ftr_row_2 + 2))->setCellValue('J' .  ($ftr_row_2 + 2), ": Analysis once a month");
        $objPHPExcel->getStyle('G' . ($ftr_row_2 + 1) . ':I' . ($ftr_row_2 + 1))->applyFromArray($colorblue);
        $objPHPExcel->getStyle('G' . ($ftr_row_2 + 2) . ':I' . ($ftr_row_2 + 2))->applyFromArray($colorpurple);
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($ftr_row_2) . ':A' .  ($ftr_row_2 + 2));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'CQ' . ($ftr_row_2) . ':CQ' . ($ftr_row_2 + 2));

        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($ftr_row_2 + 3) . ':A' .  ($ftr_row_2 + 4));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'CQ' . ($ftr_row_2 + 3) . ':CQ' . ($ftr_row_2 + 4));

        $objPHPExcel->mergeCells('A' . ($ftr_row_2 + 5) . ':Q' . ($ftr_row_2 + 5))->setCellValue('A' . ($ftr_row_2 + 5), 'Effective date on ' . $this->frmefective);
        $objPHPExcel->mergeCells('R' . ($ftr_row_2 + 5) . ':CQ' . ($ftr_row_2 + 5))->setCellValue('R' . ($ftr_row_2 + 5), $this->frmnm . '-' . $this->frmver);
        $objPHPExcel->getStyle('A' . ($ftr_row_2 + 5) . ':CQ' . ($ftr_row_2 + 5))->getFont()->setBold(true);
        $objPHPExcel->getStyle('R' . ($ftr_row_2 + 5) . ':CQ' . ($ftr_row_2 + 5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($ftr_row_2 + 5) . ':Q' . ($ftr_row_2 + 5));
        $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($ftr_row_2 + 5) . ':CQ' . ($ftr_row_2 + 5));

        $objPHPExcel->setBreak('A' . ($ftr_row_2 + 5),  PHPExcel_Worksheet::BREAK_ROW);

        // Worksheet 3 (1 page) ===========================================================================================================================================================================

        $start_row_3 = $ftr_row_2 + 8;
        $gbr_3 = '$objDrawing';
        $gbr_3 = new PHPExcel_Worksheet_Drawing();
        $gbr_3->setPath('assets/images/PSG_logo_2022.png');
        $gbr_3->setWidthAndHeight(50, 50);
        $gbr_3->setWorksheet($objPHPExcel);
        $gbr_3->setCoordinates('B' . $start_row_3);

        $objPHPExcel->mergeCells('A' .   $start_row_3 . ':D' . ($start_row_3 + 2));
        $objPHPExcel->mergeCells('E' .   $start_row_3 . ':BE' . ($start_row_3))->setCellValue('E' . $start_row_3,  $this->frmcop);
        $objPHPExcel->mergeCells('E' .  ($start_row_3 + 1) . ':BE' . ($start_row_3 + 1))->setCellValue('E' .  ($start_row_3 + 1), 'DEPARTEMENT POWER PLANT (TURBINE)');
        $objPHPExcel->mergeCells('E' .  ($start_row_3 + 2) . ':BE' . ($start_row_3 + 2))->setCellValue('E' .  ($start_row_3 + 2), $this->frmjdl);
        $objPHPExcel->mergeCells('BF' .  $start_row_3 . ':BH' . $start_row_3)->setCellValue('BF' . $start_row_3, 'Date');
        $objPHPExcel->mergeCells('BI' .  $start_row_3 . ':BP' . $start_row_3)->setCellValue('BI' . $start_row_3, ': ' . $create_date);
        $objPHPExcel->mergeCells('BF' . ($start_row_3 + 1) . ':BH' . ($start_row_3 + 1))->setCellValue('BF' . ($start_row_3 + 1), 'Doc');
        $objPHPExcel->mergeCells('BI' . ($start_row_3 + 1) . ':BP' . ($start_row_3 + 1))->setCellValue('BI' . ($start_row_3 + 1), ': ' . $docno);
        $objPHPExcel->mergeCells('BF' . ($start_row_3 + 2) . ':BH' . ($start_row_3 + 2))->setCellValue('BF' . ($start_row_3 + 2), 'Page');
        $objPHPExcel->mergeCells('BI' . ($start_row_3 + 2) . ':BP' . ($start_row_3 + 2))->setCellValue('BI' . ($start_row_3 + 2), ': ' . 3 . ' of ' . 4);
        $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row_3 .      ':D' .  ($start_row_3 + 2));
        $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row_3) . ':BE' . ($start_row_3 + 2));
        $objPHPExcel->setSharedStyle($headerStyle, 'BF' .  $start_row_3  . ':BP' . ($start_row_3 + 2));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row_3 + 3) . ':A' .  ($start_row_3 + 5));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BP' . ($start_row_3 + 3) . ':BP' . ($start_row_3 + 5));

        $hd_row_e = $start_row_3 + 5;
        $objPHPExcel->mergeCells('B' .  ($hd_row_e) . ':BO' .  ($hd_row_e))->setCellValue('B' .  ($hd_row_e), "Water Analysis Results : Chemical Water Treatment");
        $objPHPExcel->mergeCells('B' .  ($hd_row_e + 1) . ':G' .  ($hd_row_e + 2))->setCellValue('B' .  ($hd_row_e + 1), "Sampling Point");
        $objPHPExcel->mergeCells('B' .  ($hd_row_e + 3) . ':D' .  ($hd_row_e + 6))->setCellValue('B' .  ($hd_row_e + 3), "Time");
        $objPHPExcel->mergeCells('E' .  ($hd_row_e + 3) . ':G' .  ($hd_row_e + 6))->setCellValue('E' .  ($hd_row_e + 3), "Start / Stop");
        $objPHPExcel->mergeCells('H' .  ($hd_row_e + 1) . ':V' .  ($hd_row_e + 2))->setCellValue('H' .  ($hd_row_e + 1), "Reverse Osmosis");
        $objPHPExcel->mergeCells('H' .  ($hd_row_e + 3) . ':J' .  ($hd_row_e + 4))->setCellValue('H' .  ($hd_row_e + 3), "Turbuditi");
        $objPHPExcel->mergeCells('H' .  ($hd_row_e + 5) . ':J' .  ($hd_row_e + 5))->setCellValue('H' .  ($hd_row_e + 5), "NTU");
        $objPHPExcel->mergeCells('H' .  ($hd_row_e + 6) . ':J' .  ($hd_row_e + 6))->setCellValue('H' .  ($hd_row_e + 6), "Max 3");
        $objPHPExcel->mergeCells('K' .  ($hd_row_e + 3) . ':M' .  ($hd_row_e + 4))->setCellValue('K' .  ($hd_row_e + 3), "Pressure");
        $objPHPExcel->mergeCells('K' .  ($hd_row_e + 5) . ':M' .  ($hd_row_e + 5))->setCellValue('K' .  ($hd_row_e + 5), "mPa");
        $objPHPExcel->mergeCells('K' .  ($hd_row_e + 6) . ':M' .  ($hd_row_e + 6))->setCellValue('K' .  ($hd_row_e + 6), "0,18 - 0,30");
        $objPHPExcel->mergeCells('N' .  ($hd_row_e + 3) . ':P' .  ($hd_row_e + 4))->setCellValue('N' .  ($hd_row_e + 3), "Flow Meter");
        $objPHPExcel->mergeCells('N' .  ($hd_row_e + 5) . ':P' .  ($hd_row_e + 6))->setCellValue('N' .  ($hd_row_e + 5), "ton/ h");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_e + 3) . ':S' .  ($hd_row_e + 5))->setCellValue('Q' .  ($hd_row_e + 3), "pH");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_e + 6) . ':S' .  ($hd_row_e + 6))->setCellValue('Q' .  ($hd_row_e + 6), "6.5 - 8.5");
        $objPHPExcel->mergeCells('T' .  ($hd_row_e + 3) . ':V' .  ($hd_row_e + 4))->setCellValue('Y' .  ($hd_row_e + 3), "Conduc- tivity");
        $objPHPExcel->mergeCells('T' .  ($hd_row_e + 5) . ':V' .  ($hd_row_e + 5))->setCellValue('Y' .  ($hd_row_e + 5), "µs/ cm");
        $objPHPExcel->mergeCells('T' .  ($hd_row_e + 6) . ':V' .  ($hd_row_e + 6))->setCellValue('Y' .  ($hd_row_e + 6), "≤40");
        $objPHPExcel->mergeCells('W' .  ($hd_row_e + 1) . ':Y' .  ($hd_row_e + 2))->setCellValue('W' .  ($hd_row_e + 1), "Cation 1");
        $objPHPExcel->mergeCells('W' .  ($hd_row_e + 3) . ':Y' .  ($hd_row_e + 4))->setCellValue('W' .  ($hd_row_e + 3), "acid ion");
        $objPHPExcel->mergeCells('W' .  ($hd_row_e + 5) . ':Y' .  ($hd_row_e + 5))->setCellValue('W' .  ($hd_row_e + 5), "mmol/ L");
        $objPHPExcel->mergeCells('W' .  ($hd_row_e + 6) . ':Y' .  ($hd_row_e + 6))->setCellValue('W' .  ($hd_row_e + 6), "≥1,0");
        $objPHPExcel->mergeCells('Z' .  ($hd_row_e + 1) . ':AE' .  ($hd_row_e + 2))->setCellValue('Z' .  ($hd_row_e + 1), "Anion 1");
        $objPHPExcel->mergeCells('Z' .  ($hd_row_e + 3) . ':AB' .  ($hd_row_e + 4))->setCellValue('Z' .  ($hd_row_e + 3), "Conduc- tivity");
        $objPHPExcel->mergeCells('Z' .  ($hd_row_e + 5) . ':AB' .  ($hd_row_e + 5))->setCellValue('Z' .  ($hd_row_e + 5), "µs/ cm");
        $objPHPExcel->mergeCells('Z' .  ($hd_row_e + 6) . ':AB' .  ($hd_row_e + 6))->setCellValue('Z' .  ($hd_row_e + 6), "≤200");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_e + 3) . ':AE' .  ($hd_row_e + 5))->setCellValue('AC' .  ($hd_row_e + 3), "pH");
        $objPHPExcel->mergeCells('AC' .  ($hd_row_e + 6) . ':AE' .  ($hd_row_e + 6))->setCellValue('AC' .  ($hd_row_e + 6), "≥3,0");
        $objPHPExcel->mergeCells('AF' .  ($hd_row_e + 1) . ':AH' .  ($hd_row_e + 2))->setCellValue('AF' .  ($hd_row_e + 1), "Cation 2");
        $objPHPExcel->mergeCells('AF' .  ($hd_row_e + 3) . ':AH' .  ($hd_row_e + 4))->setCellValue('AF' .  ($hd_row_e + 3), "acid ion");
        $objPHPExcel->mergeCells('AF' .  ($hd_row_e + 5) . ':AH' .  ($hd_row_e + 5))->setCellValue('AF' .  ($hd_row_e + 5), "mmol/ L");
        $objPHPExcel->mergeCells('AF' .  ($hd_row_e + 6) . ':AH' .  ($hd_row_e + 6))->setCellValue('AF' .  ($hd_row_e + 6), ">0.2");
        $objPHPExcel->mergeCells('AI' .  ($hd_row_e + 1) . ':AQ' .  ($hd_row_e + 2))->setCellValue('AI' .  ($hd_row_e + 1), "Anion 2");
        $objPHPExcel->mergeCells('AI' .  ($hd_row_e + 3) . ':AK' .  ($hd_row_e + 4))->setCellValue('AI' .  ($hd_row_e + 3), "Conduc- tivity");
        $objPHPExcel->mergeCells('AI' .  ($hd_row_e + 5) . ':AK' .  ($hd_row_e + 5))->setCellValue('AI' .  ($hd_row_e + 5), "µs/ cm");
        $objPHPExcel->mergeCells('AI' .  ($hd_row_e + 6) . ':AK' .  ($hd_row_e + 6))->setCellValue('AI' .  ($hd_row_e + 6), "≤10");
        $objPHPExcel->mergeCells('AL' .  ($hd_row_e + 3) . ':AN' .  ($hd_row_e + 5))->setCellValue('AL' .  ($hd_row_e + 3), "pH");
        $objPHPExcel->mergeCells('AL' .  ($hd_row_e + 6) . ':AN' .  ($hd_row_e + 6))->setCellValue('AL' .  ($hd_row_e + 6), "6,5 - 9.2");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_e + 3) . ':AQ' .  ($hd_row_e + 4))->setCellValue('AO' .  ($hd_row_e + 3), "Silica");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_e + 5) . ':AQ' .  ($hd_row_e + 5))->setCellValue('AO' .  ($hd_row_e + 5), "mg/ L");
        $objPHPExcel->mergeCells('AO' .  ($hd_row_e + 6) . ':AQ' .  ($hd_row_e + 6))->setCellValue('AO' .  ($hd_row_e + 6), "≤ 0,2");
        $objPHPExcel->getStyle('B' . ($hd_row_e) . ':AQ' . ($hd_row_e))->applyFromArray($noborderleftboldsize12);
        $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($hd_row_e + 1) . ':AQ' . ($hd_row_e + 6));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hd_row_e) . ':A' .  ($hd_row_e + 6));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BP' . ($hd_row_e) . ':BP' . ($hd_row_e + 6));

        $dtl_row_e = $hd_row_e + 7;
        for ($i = 1; $i <= 28; $i++) {

            $objPHPExcel->getRowDimension($dtl_row_e)->setRowHeight(20);

            if (isset($e1_time[$i])) {
                $e1_time[$i] = $e1_time[$i];
            } else {
                $e1_time[$i] = "";
            }

            if (isset($e1_startstop[$i])) {
                $e1_startstop[$i] = $e1_startstop[$i];
            } else {
                $e1_startstop[$i] = "";
            }

            if (isset($e1_turbuditi[$i])) {
                $e1_turbuditi[$i] = $e1_turbuditi[$i];
            } else {
                $e1_turbuditi[$i] = "";
            }

            if (isset($e1_pressure[$i])) {
                $e1_pressure[$i] = $e1_pressure[$i];
            } else {
                $e1_pressure[$i] = "";
            }

            if (isset($e1_flowmeter[$i])) {
                $e1_flowmeter[$i] = $e1_flowmeter[$i];
            } else {
                $e1_flowmeter[$i] = "";
            }

            if (isset($e1_ph[$i])) {
                $e1_ph[$i] = $e1_ph[$i];
            } else {
                $e1_ph[$i] = "";
            }

            if (isset($e1_conductivity[$i])) {
                $e1_conductivity[$i] = $e1_conductivity[$i];
            } else {
                $e1_conductivity[$i] = "";
            }

            if (isset($e2_acidion[$i])) {
                $e2_acidion[$i] = $e2_acidion[$i];
            } else {
                $e2_acidion[$i] = "";
            }

            if (isset($e3_conductivity[$i])) {
                $e3_conductivity[$i] = $e3_conductivity[$i];
            } else {
                $e3_conductivity[$i] = "";
            }

            if (isset($e3_ph[$i])) {
                $e3_ph[$i] = $e3_ph[$i];
            } else {
                $e3_ph[$i] = "";
            }

            if (isset($e4_acidion[$i])) {
                $e4_acidion[$i] = $e4_acidion[$i];
            } else {
                $e4_acidion[$i] = "";
            }

            if (isset($e5_conductivity[$i])) {
                $e5_conductivity[$i] = $e5_conductivity[$i];
            } else {
                $e5_conductivity[$i] = "";
            }

            if (isset($e5_ph[$i])) {
                $e5_ph[$i] = $e5_ph[$i];
            } else {
                $e5_ph[$i] = "";
            }

            if (isset($e5_silica[$i])) {
                $e5_silica[$i] = $e5_silica[$i];
            } else {
                $e5_silica[$i] = "";
            }

            $objPHPExcel->mergeCells('B' .  $dtl_row_e . ':D' .  $dtl_row_e)->setCellValue('B' .  $dtl_row_e, $e1_time[$i]);
            $objPHPExcel->mergeCells('E' .  $dtl_row_e . ':G' .  $dtl_row_e)->setCellValue('E' .  $dtl_row_e, $e1_startstop[$i]);
            $objPHPExcel->mergeCells('H' .  $dtl_row_e . ':J' .  $dtl_row_e)->setCellValue('H' .  $dtl_row_e, $e1_turbuditi[$i]);
            $objPHPExcel->mergeCells('K' .  $dtl_row_e . ':M' .  $dtl_row_e)->setCellValue('K' .  $dtl_row_e, $e1_pressure[$i]);
            $objPHPExcel->mergeCells('N' .  $dtl_row_e . ':P' .  $dtl_row_e)->setCellValue('N' .  $dtl_row_e, $e1_flowmeter[$i]);
            $objPHPExcel->mergeCells('Q' .  $dtl_row_e . ':S' .  $dtl_row_e)->setCellValue('Q' .  $dtl_row_e, $e1_ph[$i]);
            $objPHPExcel->mergeCells('T' .  $dtl_row_e . ':V' .  $dtl_row_e)->setCellValue('T' .  $dtl_row_e, $e1_conductivity[$i]);
            $objPHPExcel->mergeCells('W' .  $dtl_row_e . ':Y' .  $dtl_row_e)->setCellValue('W' .  $dtl_row_e, $e2_acidion[$i]);
            $objPHPExcel->mergeCells('Z' .  $dtl_row_e . ':AB' .  $dtl_row_e)->setCellValue('Z' .  $dtl_row_e, $e3_conductivity[$i]);
            $objPHPExcel->mergeCells('AC' .  $dtl_row_e . ':AE' .  $dtl_row_e)->setCellValue('AC' .  $dtl_row_e, $e3_ph[$i]);
            $objPHPExcel->mergeCells('AF' .  $dtl_row_e . ':AH' .  $dtl_row_e)->setCellValue('AF' .  $dtl_row_e, $e4_acidion[$i]);
            $objPHPExcel->mergeCells('AI' .  $dtl_row_e . ':AK' .  $dtl_row_e)->setCellValue('AI' .  $dtl_row_e, $e5_conductivity[$i]);
            $objPHPExcel->mergeCells('AL' .  $dtl_row_e . ':AN' .  $dtl_row_e)->setCellValue('AL' .  $dtl_row_e, $e5_ph[$i]);
            $objPHPExcel->mergeCells('AO' .  $dtl_row_e . ':AQ' .  $dtl_row_e)->setCellValue('AO' .  $dtl_row_e, $e5_silica[$i]);
            $objPHPExcel->setSharedStyle($DetailStyle, 'B' . $dtl_row_e  . ':AQ' . $dtl_row_e);
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' . $dtl_row_e . ':A' . $dtl_row_e);
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BP' . $dtl_row_e . ':BP' . $dtl_row_e);

            $dtl_row_e++;
        }

        $hd_row_f = $start_row_3 + 5;
        $objPHPExcel->mergeCells('AR' .  ($hd_row_f + 1) . ':BO' .  ($hd_row_f + 2))->setCellValue('AR' .  ($hd_row_f + 1), "Flowmeter  Demin Process");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_f + 3) . ':AW' .  ($hd_row_f + 5))->setCellValue('AR' .  ($hd_row_f + 3), "Time");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_f + 6) . ':AT' .  ($hd_row_f + 6))->setCellValue('AR' .  ($hd_row_f + 6), "Start");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_f + 6) . ':AW' .  ($hd_row_f + 6))->setCellValue('AU' .  ($hd_row_f + 6), "Stop");
        $objPHPExcel->mergeCells('AX' .  ($hd_row_f + 3) . ':BC' .  ($hd_row_f + 6))->setCellValue('AX' .  ($hd_row_f + 3), "RO");
        $objPHPExcel->mergeCells('BD' .  ($hd_row_f + 3) . ':BI' .  ($hd_row_f + 5))->setCellValue('BD' .  ($hd_row_f + 3), "Flow");
        $objPHPExcel->mergeCells('BD' .  ($hd_row_f + 6) . ':BF' .  ($hd_row_f + 6))->setCellValue('BD' .  ($hd_row_f + 6), "Start");
        $objPHPExcel->mergeCells('BG' .  ($hd_row_f + 6) . ':BI' .  ($hd_row_f + 6))->setCellValue('BG' .  ($hd_row_f + 6), "Stop");
        $objPHPExcel->mergeCells('BJ' .  ($hd_row_f + 3) . ':BO' .  ($hd_row_f + 6))->setCellValue('BJ' .  ($hd_row_f + 3), "Total (m3)");
        $objPHPExcel->setSharedStyle($noborderStyle, 'AR' . ($hd_row_f) . ':BO' . ($hd_row_f));
        $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AR' . ($hd_row_f + 1) . ':BO' . ($hd_row_f + 6));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hd_row_f) . ':A' .  ($hd_row_f + 6));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BP' . ($hd_row_f) . ':BP' . ($hd_row_f + 6));

        $dtl_row_f = $hd_row_f + 7;
        for ($i = 1; $i <= 12; $i++) {

            $objPHPExcel->getRowDimension($dtl_row_f)->setRowHeight(20);

            if (isset($f1_timestart[$i])) {
                $f1_timestart[$i] = $f1_timestart[$i];
            } else {
                $f1_timestart[$i] = "";
            }

            if (isset($f1_timestop[$i])) {
                $f1_timestop[$i] = $f1_timestop[$i];
            } else {
                $f1_timestop[$i] = "";
            }

            if (isset($f1_ro[$i])) {
                $f1_ro[$i] = $f1_ro[$i];
            } else {
                $f1_ro[$i] = "";
            }

            if (isset($f1_flowstart[$i])) {
                $f1_flowstart[$i] = $f1_flowstart[$i];
            } else {
                $f1_flowstart[$i] = "";
            }

            if (isset($f1_flowstop[$i])) {
                $f1_flowstop[$i] = $f1_flowstop[$i];
            } else {
                $f1_flowstop[$i] = "";
            }

            if (isset($f1_total[$i])) {
                $f1_total[$i] = $f1_total[$i];
            } else {
                $f1_total[$i] = "";
            }

            $objPHPExcel->mergeCells('AR' .  $dtl_row_f . ':AT' .  $dtl_row_f)->setCellValue('AR' .  $dtl_row_f, $f1_timestart[$i]);
            $objPHPExcel->mergeCells('AU' .  $dtl_row_f . ':AW' .  $dtl_row_f)->setCellValue('AU' .  $dtl_row_f, $f1_timestop[$i]);
            $objPHPExcel->mergeCells('AX' .  $dtl_row_f . ':BC' .  $dtl_row_f)->setCellValue('AX' .  $dtl_row_f, $f1_ro[$i]);
            $objPHPExcel->mergeCells('BD' .  $dtl_row_f . ':BF' .  $dtl_row_f)->setCellValue('BD' .  $dtl_row_f, $f1_flowstart[$i]);
            $objPHPExcel->mergeCells('BG' .  $dtl_row_f . ':BI' .  $dtl_row_f)->setCellValue('BG' .  $dtl_row_f, $f1_flowstop[$i]);
            $objPHPExcel->mergeCells('BJ' .  $dtl_row_f . ':BO' .  $dtl_row_f)->setCellValue('BJ' .  $dtl_row_f, $f1_total[$i]);
            $objPHPExcel->setSharedStyle($DetailStyle, 'AR' . $dtl_row_f  . ':BO' . $dtl_row_f);
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' . $dtl_row_f . ':A' . $dtl_row_f);
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BP' . $dtl_row_f . ':BP' . $dtl_row_f);

            $dtl_row_f++;
        }

        $hd_row_g = $dtl_row_f;
        $objPHPExcel->mergeCells('AR' .  ($hd_row_g) . ':BO' .  ($hd_row_g + 1))->setCellValue('AR' .  ($hd_row_g), "Flowmeter Blowdown Cooling Tower and Backwash Sand Filter");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_g + 2) . ':AW' .  ($hd_row_g + 3))->setCellValue('AR' .  ($hd_row_g + 2), "Time");
        $objPHPExcel->mergeCells('AR' .  ($hd_row_g + 4) . ':AT' .  ($hd_row_g + 4))->setCellValue('AR' .  ($hd_row_g + 4), "Start");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_g + 4) . ':AW' .  ($hd_row_g + 4))->setCellValue('AU' .  ($hd_row_g + 4), "Stop");
        $objPHPExcel->mergeCells('AX' .  ($hd_row_g + 2) . ':BC' .  ($hd_row_g + 4))->setCellValue('AX' .  ($hd_row_g + 2), "Note");
        $objPHPExcel->mergeCells('BD' .  ($hd_row_g + 2) . ':BI' .  ($hd_row_g + 3))->setCellValue('BD' .  ($hd_row_g + 2), "Flow");
        $objPHPExcel->mergeCells('BD' .  ($hd_row_g + 4) . ':BF' .  ($hd_row_g + 4))->setCellValue('BD' .  ($hd_row_g + 4), "Start");
        $objPHPExcel->mergeCells('BG' .  ($hd_row_g + 4) . ':BI' .  ($hd_row_g + 4))->setCellValue('BG' .  ($hd_row_g + 4), "Stop");
        $objPHPExcel->mergeCells('BJ' .  ($hd_row_g + 2) . ':BO' .  ($hd_row_g + 4))->setCellValue('BJ' .  ($hd_row_g + 2), "Total (m3)");
        $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AR' . ($hd_row_g) . ':BO' . ($hd_row_g + 4));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hd_row_g) . ':A' .  ($hd_row_g + 4));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BP' . ($hd_row_g) . ':BP' . ($hd_row_g + 4));

        $dtl_row_g = $hd_row_g + 5;
        for ($i = 1; $i <= 11; $i++) {

            $objPHPExcel->getRowDimension($dtl_row_g)->setRowHeight(20);

            if (isset($g1_timestart[$i])) {
                $g1_timestart[$i] = $g1_timestart[$i];
            } else {
                $g1_timestart[$i] = "";
            }

            if (isset($g1_timestop[$i])) {
                $g1_timestop[$i] = $g1_timestop[$i];
            } else {
                $g1_timestop[$i] = "";
            }

            if (isset($g1_note[$i])) {
                $g1_note[$i] = $g1_note[$i];
            } else {
                $g1_note[$i] = "";
            }

            if (isset($g1_flowstart[$i])) {
                $g1_flowstart[$i] = $g1_flowstart[$i];
            } else {
                $g1_flowstart[$i] = "";
            }

            if (isset($g1_flowstop[$i])) {
                $g1_flowstop[$i] = $g1_flowstop[$i];
            } else {
                $g1_flowstop[$i] = "";
            }

            if (isset($g1_total[$i])) {
                $g1_total[$i] = $g1_total[$i];
            } else {
                $g1_total[$i] = "";
            }

            $objPHPExcel->mergeCells('AR' .  $dtl_row_g . ':AT' .  $dtl_row_g)->setCellValue('AR' .  $dtl_row_g, $g1_timestart[$i]);
            $objPHPExcel->mergeCells('AU' .  $dtl_row_g . ':AW' .  $dtl_row_g)->setCellValue('AU' .  $dtl_row_g, $g1_timestop[$i]);
            $objPHPExcel->mergeCells('AX' .  $dtl_row_g . ':BC' .  $dtl_row_g)->setCellValue('AX' .  $dtl_row_g, $g1_note[$i]);
            $objPHPExcel->mergeCells('BD' .  $dtl_row_g . ':BF' .  $dtl_row_g)->setCellValue('BD' .  $dtl_row_g, $g1_flowstart[$i]);
            $objPHPExcel->mergeCells('BG' .  $dtl_row_g . ':BI' .  $dtl_row_g)->setCellValue('BG' .  $dtl_row_g, $g1_flowstop[$i]);
            $objPHPExcel->mergeCells('BJ' .  $dtl_row_g . ':BO' .  $dtl_row_g)->setCellValue('BJ' .  $dtl_row_g, $g1_total[$i]);
            $objPHPExcel->setSharedStyle($DetailStyle, 'AR' . $dtl_row_g  . ':BO' . $dtl_row_g);
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' . $dtl_row_g . ':A' . $dtl_row_g);
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'BP' . $dtl_row_g . ':BP' . $dtl_row_g);

            $dtl_row_g++;
        }

        $ftr_row_3 = $dtl_row_g;
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($ftr_row_3) . ':A' .  ($ftr_row_3 + 1));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BP' . ($ftr_row_3) . ':BP' . ($ftr_row_3 + 1));

        $objPHPExcel->mergeCells('A' . ($ftr_row_3 + 2) . ':Q' . ($ftr_row_3 + 2))->setCellValue('A' . ($ftr_row_3 + 2), 'Effective date on ' . $this->frmefective);
        $objPHPExcel->mergeCells('R' . ($ftr_row_3 + 2) . ':BP' . ($ftr_row_3 + 2))->setCellValue('R' . ($ftr_row_3 + 2), $this->frmnm . '-' . $this->frmver);
        $objPHPExcel->getStyle('A' . ($ftr_row_3 + 2) . ':BP' . ($ftr_row_3 + 2))->getFont()->setBold(true);
        $objPHPExcel->getStyle('R' . ($ftr_row_3 + 2) . ':BP' . ($ftr_row_3 + 2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($ftr_row_3 + 2) . ':Q' . ($ftr_row_3 + 2));
        $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($ftr_row_3 + 2) . ':BP' . ($ftr_row_3 + 2));

        $objPHPExcel->setBreak('A' . ($ftr_row_3 + 2),  PHPExcel_Worksheet::BREAK_ROW);

        // Worksheet 4 (1 page) ===========================================================================================================================================================================

        $start_row_4 = $ftr_row_3 + 5;
        $gbr_4 = '$objDrawing';
        $gbr_4 = new PHPExcel_Worksheet_Drawing();
        $gbr_4->setPath('assets/images/PSG_logo_2022.png');
        $gbr_4->setWidthAndHeight(50, 50);
        $gbr_4->setWorksheet($objPHPExcel);
        $gbr_4->setCoordinates('B' . $start_row_4);

        $objPHPExcel->mergeCells('A' .   $start_row_4 . ':D' . ($start_row_4 + 2));
        $objPHPExcel->mergeCells('E' .   $start_row_4 . ':BD' . ($start_row_4))->setCellValue('E' . $start_row_4,  $this->frmcop);
        $objPHPExcel->mergeCells('E' .  ($start_row_4 + 1) . ':BD' . ($start_row_4 + 1))->setCellValue('E' .  ($start_row_4 + 1), 'DEPARTEMENT POWER PLANT (TURBINE)');
        $objPHPExcel->mergeCells('E' .  ($start_row_4 + 2) . ':BD' . ($start_row_4 + 2))->setCellValue('E' .  ($start_row_4 + 2), $this->frmjdl);
        $objPHPExcel->mergeCells('BE' .  $start_row_4 . ':BG' . $start_row_4)->setCellValue('BE' . $start_row_4, 'Date');
        $objPHPExcel->mergeCells('BH' .  $start_row_4 . ':BO' . $start_row_4)->setCellValue('BH' . $start_row_4, ': ' . $create_date);
        $objPHPExcel->mergeCells('BE' . ($start_row_4 + 1) . ':BG' . ($start_row_4 + 1))->setCellValue('BE' . ($start_row_4 + 1), 'Doc');
        $objPHPExcel->mergeCells('BH' . ($start_row_4 + 1) . ':BO' . ($start_row_4 + 1))->setCellValue('BH' . ($start_row_4 + 1), ': ' . $docno);
        $objPHPExcel->mergeCells('BE' . ($start_row_4 + 2) . ':BG' . ($start_row_4 + 2))->setCellValue('BE' . ($start_row_4 + 2), 'Page');
        $objPHPExcel->mergeCells('BH' . ($start_row_4 + 2) . ':BO' . ($start_row_4 + 2))->setCellValue('BH' . ($start_row_4 + 2), ': ' . 4 . ' of ' . 4);
        $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row_4 .      ':D' .  ($start_row_4 + 2));
        $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row_4) . ':BD' . ($start_row_4 + 2));
        $objPHPExcel->setSharedStyle($headerStyle, 'BE' .  $start_row_4  . ':BO' . ($start_row_4 + 2));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row_4 + 3) . ':A' .  ($start_row_4 + 5));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BO' . ($start_row_4 + 3) . ':BO' . ($start_row_4 + 5));

        $hd_row_notification = $start_row_4 + 5;
        $objPHPExcel->mergeCells('B' .  ($hd_row_notification) . ':BN' .  ($hd_row_notification))->setCellValue('B' .  ($hd_row_notification), "Notifications :");
        $objPHPExcel->mergeCells('H' .  ($hd_row_notification + 1) . ':BN' .  ($hd_row_notification + 25))->setCellValue('H' .  ($hd_row_notification + 1), $notification);
        $objPHPExcel->getStyle('B' . ($hd_row_notification) . ':G' . ($hd_row_notification))->applyFromArray($noborderleftboldsize12);
        $objPHPExcel->getStyle('B' . ($hd_row_notification + 1) . ':BN' . ($hd_row_notification + 25))->applyFromArray($noborderlefttopboldsize9);
        // $objPHPExcel->setSharedStyle($noborderStyle, 'B' . ($hd_row_notification + 1) . ':BN' . ($hd_row_notification + 25));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hd_row_notification) . ':A' .  ($hd_row_notification + 27));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BO' . ($hd_row_notification) . ':BO' . ($hd_row_notification + 27));
        // posisis notification

        $hd_row_total = $hd_row_notification + 28;
        $objPHPExcel->mergeCells('B' .  ($hd_row_total) . ':M' .  ($hd_row_total))->setCellValue('B' .  ($hd_row_total), "Total of Used Water");
        $objPHPExcel->mergeCells('B' .  ($hd_row_total + 1) . ':G' .  ($hd_row_total + 1))->setCellValue('B' .  ($hd_row_total + 1), "SHIFT I (Morning)");
        $objPHPExcel->mergeCells('H' .  ($hd_row_total + 1) . ':K' .  ($hd_row_total + 1))->setCellValue('H' .  ($hd_row_total + 1), $shift_1);
        $objPHPExcel->mergeCells('L' .  ($hd_row_total + 1) . ':M' .  ($hd_row_total + 1))->setCellValue('L' .  ($hd_row_total + 1), "M3");
        $objPHPExcel->mergeCells('B' .  ($hd_row_total + 2) . ':G' .  ($hd_row_total + 2))->setCellValue('B' .  ($hd_row_total + 2), "SHIFT II (Afternoon))");
        $objPHPExcel->mergeCells('H' .  ($hd_row_total + 2) . ':K' .  ($hd_row_total + 2))->setCellValue('H' .  ($hd_row_total + 2),  $shift_2);
        $objPHPExcel->mergeCells('L' .  ($hd_row_total + 2) . ':M' .  ($hd_row_total + 2))->setCellValue('L' .  ($hd_row_total + 2), "M3");
        $objPHPExcel->mergeCells('B' .  ($hd_row_total + 3) . ':G' .  ($hd_row_total + 3))->setCellValue('B' .  ($hd_row_total + 3), "SHIFT III (Night))");
        $objPHPExcel->mergeCells('H' .  ($hd_row_total + 3) . ':K' .  ($hd_row_total + 3))->setCellValue('H' .  ($hd_row_total + 3),  $shift_3);
        $objPHPExcel->mergeCells('L' .  ($hd_row_total + 3) . ':M' .  ($hd_row_total + 3))->setCellValue('L' .  ($hd_row_total + 3), "M3");
        $objPHPExcel->mergeCells('B' .  ($hd_row_total + 4) . ':G' .  ($hd_row_total + 4))->setCellValue('B' .  ($hd_row_total + 4), "TOTAL :");
        $objPHPExcel->mergeCells('H' .  ($hd_row_total + 4) . ':K' .  ($hd_row_total + 4))->setCellValue('H' .  ($hd_row_total + 4),  $total_usedwater);
        $objPHPExcel->mergeCells('L' .  ($hd_row_total + 4) . ':M' .  ($hd_row_total + 4))->setCellValue('L' .  ($hd_row_total + 4), "M3");
        $objPHPExcel->setSharedStyle($PTStyle, 'B' . ($hd_row_total) . ':M' . ($hd_row_total));
        $objPHPExcel->setSharedStyle($headerStyle, 'B' . ($hd_row_total + 1) . ':G' . ($hd_row_total + 4));
        $objPHPExcel->setSharedStyle($DetailStyle, 'H' . ($hd_row_total + 1) . ':M' . ($hd_row_total + 4));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hd_row_total) . ':A' .  ($hd_row_total + 4));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BO' . ($hd_row_total) . ':BO' . ($hd_row_total + 4));

        $hd_row_apv = $hd_row_total;
        $objPHPExcel->mergeCells('Q' .  ($hd_row_apv) . ':Z' .  ($hd_row_apv))->setCellValue('Q' .  ($hd_row_apv), "SHIFT I");
        $objPHPExcel->mergeCells('AA' .  ($hd_row_apv) . ':AJ' .  ($hd_row_apv))->setCellValue('AA' .  ($hd_row_apv), "SHIFT II");
        $objPHPExcel->mergeCells('AK' .  ($hd_row_apv) . ':AT' .  ($hd_row_apv))->setCellValue('AK' .  ($hd_row_apv), "SHIFT III");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_apv) . ':BD' .  ($hd_row_apv))->setCellValue('AU' .  ($hd_row_apv), "Known by");
        $objPHPExcel->mergeCells('BE' .  ($hd_row_apv) . ':BN' .  ($hd_row_apv))->setCellValue('BE' .  ($hd_row_apv), "Approved by");
        $objPHPExcel->setSharedStyle($DetailheaderStyle, 'Q' . ($hd_row_apv) . ':BN' . ($hd_row_apv));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hd_row_apv) . ':A' .  ($hd_row_apv));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BO' . ($hd_row_apv) . ':BO' . ($hd_row_apv));

        $objPHPExcel->mergeCells('Q' .  ($hd_row_apv + 1) . ':Z' .  ($hd_row_apv + 3))->setCellValue('Q' .  ($hd_row_apv + 1), "");
        $objPHPExcel->mergeCells('AA' .  ($hd_row_apv + 1) . ':AJ' .  ($hd_row_apv + 3))->setCellValue('AA' .  ($hd_row_apv + 1), "");
        $objPHPExcel->mergeCells('AK' .  ($hd_row_apv + 1) . ':AT' .  ($hd_row_apv + 3))->setCellValue('AK' .  ($hd_row_apv + 1), "");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_apv + 1) . ':BD' .  ($hd_row_apv + 3))->setCellValue('AU' .  ($hd_row_apv + 1), "");
        $objPHPExcel->mergeCells('BE' .  ($hd_row_apv + 1) . ':BN' .  ($hd_row_apv + 3))->setCellValue('BE' .  ($hd_row_apv + 1), "");
        $objPHPExcel->setSharedStyle($DetailStyle, 'Q' . ($hd_row_apv + 1) . ':BN' . ($hd_row_apv + 3));
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hd_row_apv + 1) . ':A' .  ($hd_row_apv + 3));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BO' . ($hd_row_apv + 1) . ':BO' . ($hd_row_apv + 3));

        $fcpath2   = str_replace('utl/', '', FCPATH);

        if ($app1_personalstatus == '2') {
            $imageurlapp = '/forviewfoto_pekerja/TTD_TK/';
            $imageformatapp = '.png';
        } else if (
            $app1_personalstatus == '1'
        ) {
            $imageurlapp = '/forviewfoto_pekerja/';
            $imageformatapp = '_0_0.png';
        } else {
            $imageurlapp = '';
            $imageformatapp = '';
        }
        $sign_img  = '$objDrawing';
        if (isset($app1_by)) {
            if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app1_personalstatus . '_' . $app1_personalid . '.png')) {
                $sign_img = new PHPExcel_Worksheet_Drawing();
                $sign_img->setPath('assets/ttd/' . $app1_personalstatus . '_' . $app1_personalid . '.png');
                $sign_img->setWidthAndHeight(135, 135);
                $sign_img->setResizeProportional(true);
                $sign_img->setWorksheet($objPHPExcel);
                $sign_img->setCoordinates('S' . ($hd_row_apv + 1));
            } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp . $app1_personalid . $imageformatapp)) {
                $sign_img = new PHPExcel_Worksheet_Drawing();
                $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp . $app1_personalid . $imageformatapp);
                $sign_img->setWidthAndHeight(135, 135);
                $sign_img->setResizeProportional(true);
                $sign_img->setWorksheet($objPHPExcel);
                $sign_img->setCoordinates('S' . ($hd_row_apv + 1));
            } else {
                $sign_img = new PHPExcel_Worksheet_Drawing();
                $sign_img->setPath('assets/images/approved.png');
                $sign_img->setWidthAndHeight(105, 105);
                $sign_img->setResizeProportional(true);
                $sign_img->setWorksheet($objPHPExcel);
                $sign_img->setCoordinates('S' . ($hd_row_apv + 1));
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
        $sign_img2 = '$objDrawing';
        if (isset($app2_by)) {
            if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app2_personalstatus . '_' . $app2_personalid . '.png')) {
                $sign_img2 = new PHPExcel_Worksheet_Drawing();
                $sign_img2->setPath('assets/ttd/' . $app2_personalstatus . '_' . $app2_personalid . '.png');
                $sign_img2->setWidthAndHeight(135, 135);
                $sign_img2->setResizeProportional(true);
                $sign_img2->setWorksheet($objPHPExcel);
                $sign_img2->setCoordinates('AC' . ($hd_row_apv + 1));
            } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                $sign_img2 = new PHPExcel_Worksheet_Drawing();
                $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                $sign_img2->setWidthAndHeight(135, 135);
                $sign_img2->setResizeProportional(true);
                $sign_img2->setWorksheet($objPHPExcel);
                $sign_img2->setCoordinates('AC' . ($hd_row_apv + 1));
            } else {
                $sign_img2 = new PHPExcel_Worksheet_Drawing();
                $sign_img2->setPath('assets/images/approved.png');
                $sign_img2->setWidthAndHeight(105, 105);
                $sign_img2->setResizeProportional(true);
                $sign_img2->setWorksheet($objPHPExcel);
                $sign_img2->setCoordinates('AC' . ($hd_row_apv + 1));
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
        $sign_img3 = '$objDrawing';
        if (isset($app3_by)) {
            if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app3_personalstatus . '_' . $app3_personalid . '.png')) {
                $sign_img3 = new PHPExcel_Worksheet_Drawing();
                $sign_img3->setPath('assets/ttd/' . $app3_personalstatus . '_' . $app3_personalid . '.png');
                $sign_img3->setWidthAndHeight(135, 135);
                $sign_img3->setResizeProportional(true);
                $sign_img3->setWorksheet($objPHPExcel);
                $sign_img3->setCoordinates('AM' . ($hd_row_apv + 1));
            } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                $sign_img3 = new PHPExcel_Worksheet_Drawing();
                $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                $sign_img3->setWidthAndHeight(135, 135);
                $sign_img3->setResizeProportional(true);
                $sign_img3->setWorksheet($objPHPExcel);
                $sign_img3->setCoordinates('AM' . ($hd_row_apv + 1));
            } else {
                $sign_img3 = new PHPExcel_Worksheet_Drawing();
                $sign_img3->setPath('assets/images/approved.png');
                $sign_img3->setWidthAndHeight(105, 105);
                $sign_img3->setResizeProportional(true);
                $sign_img3->setWorksheet($objPHPExcel);
                $sign_img3->setCoordinates('AM' . ($hd_row_apv + 1));
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
        $sign_img4 = '$objDrawing';
        if (isset($app4_by)) {
            if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app4_personalstatus . '_' . $app4_personalid . '.png')) {
                $sign_img4 = new PHPExcel_Worksheet_Drawing();
                $sign_img4->setPath('assets/ttd/' . $app4_personalstatus . '_' . $app4_personalid . '.png');
                $sign_img4->setWidthAndHeight(135, 135);
                $sign_img4->setResizeProportional(true);
                $sign_img4->setWorksheet($objPHPExcel);
                $sign_img4->setCoordinates('AW' . ($hd_row_apv + 1));
            } else if ($app4_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4)) {
                $sign_img4 = new PHPExcel_Worksheet_Drawing();
                $sign_img4->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4);
                $sign_img4->setWidthAndHeight(135, 135);
                $sign_img4->setResizeProportional(true);
                $sign_img4->setWorksheet($objPHPExcel);
                $sign_img4->setCoordinates('AW' . ($hd_row_apv + 1));
            } else {
                $sign_img4 = new PHPExcel_Worksheet_Drawing();
                $sign_img4->setPath('assets/images/approved.png');
                $sign_img4->setWidthAndHeight(105, 105);
                $sign_img4->setResizeProportional(true);
                $sign_img4->setWorksheet($objPHPExcel);
                $sign_img4->setCoordinates('AW' . ($hd_row_apv + 1));
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
        $sign_img5 = '$objDrawing';
        if (isset($app5_by)) {
            if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app5_personalstatus . '_' . $app5_personalid . '.png')) {
                $sign_img5 = new PHPExcel_Worksheet_Drawing();
                $sign_img5->setPath('assets/ttd/' . $app5_personalstatus . '_' . $app5_personalid . '.png');
                $sign_img5->setWidthAndHeight(135, 135);
                $sign_img5->setResizeProportional(true);
                $sign_img5->setWorksheet($objPHPExcel);
                $sign_img5->setCoordinates('BG' . ($hd_row_apv + 1));
            } else if ($app5_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp5 . $app5_personalid . $imageformatapp5)) {
                $sign_img5 = new PHPExcel_Worksheet_Drawing();
                $sign_img5->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp5 . $app5_personalid . $imageformatapp5);
                $sign_img5->setWidthAndHeight(135, 135);
                $sign_img5->setResizeProportional(true);
                $sign_img5->setWorksheet($objPHPExcel);
                $sign_img5->setCoordinates('BG' . ($hd_row_apv + 1));
            } else {
                $sign_img5 = new PHPExcel_Worksheet_Drawing();
                $sign_img5->setPath('assets/images/approved.png');
                $sign_img5->setWidthAndHeight(105, 105);
                $sign_img5->setResizeProportional(true);
                $sign_img5->setWorksheet($objPHPExcel);
                $sign_img5->setCoordinates('BG' . ($hd_row_apv + 1));
            }
        }

        $objPHPExcel->mergeCells('Q' .  ($hd_row_apv + 4) . ':S' .  ($hd_row_apv + 4))->setCellValue('Q' .  ($hd_row_apv + 4), "Name");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_apv + 5) . ':S' .  ($hd_row_apv + 5))->setCellValue('Q' .  ($hd_row_apv + 5), "Position");
        $objPHPExcel->mergeCells('Q' .  ($hd_row_apv + 6) . ':S' .  ($hd_row_apv + 6))->setCellValue('Q' .  ($hd_row_apv + 6), "Date");
        $objPHPExcel->getStyle('Q' . ($hd_row_total + 4) . ':S' . ($hd_row_total + 6))->applyFromArray($borderleftboldsize9);

        $objPHPExcel->mergeCells('T' .  ($hd_row_apv + 4) . ':Z' .  ($hd_row_apv + 4))->setCellValue('T' .  ($hd_row_apv + 4), ': ' . $app1_by);
        $objPHPExcel->mergeCells('T' .  ($hd_row_apv + 5) . ':Z' .  ($hd_row_apv + 5))->setCellValue('T' .  ($hd_row_apv + 5), ': ' . $app1_position);
        $objPHPExcel->mergeCells('T' .  ($hd_row_apv + 6) . ':Z' .  ($hd_row_apv + 6))->setCellValue('T' .  ($hd_row_apv + 6), ': ' . $app1date);
        $objPHPExcel->getStyle('T' . ($hd_row_total + 4) . ':Z' . ($hd_row_total + 6))->applyFromArray($borderleftsize9);

        $objPHPExcel->mergeCells('AA' .  ($hd_row_apv + 4) . ':AC' .  ($hd_row_apv + 4))->setCellValue('AA' .  ($hd_row_apv + 4), "Name");
        $objPHPExcel->mergeCells('AA' .  ($hd_row_apv + 5) . ':AC' .  ($hd_row_apv + 5))->setCellValue('AA' .  ($hd_row_apv + 5), "Position");
        $objPHPExcel->mergeCells('AA' .  ($hd_row_apv + 6) . ':AC' .  ($hd_row_apv + 6))->setCellValue('AA' .  ($hd_row_apv + 6), "Date");
        $objPHPExcel->getStyle('AA' . ($hd_row_apv + 4) . ':AC' . ($hd_row_apv + 6))->applyFromArray($borderleftboldsize9);

        $objPHPExcel->mergeCells('AD' .  ($hd_row_apv + 4) . ':AJ' .  ($hd_row_apv + 4))->setCellValue('AD' .  ($hd_row_apv + 4), ': ' . $app2_by);
        $objPHPExcel->mergeCells('AD' .  ($hd_row_apv + 5) . ':AJ' .  ($hd_row_apv + 5))->setCellValue('AD' .  ($hd_row_apv + 5), ': ' . $app2_position);
        $objPHPExcel->mergeCells('AD' .  ($hd_row_apv + 6) . ':AJ' .  ($hd_row_apv + 6))->setCellValue('AD' .  ($hd_row_apv + 6), ': ' . $app2date);
        $objPHPExcel->getStyle('AD' . ($hd_row_total + 4) . ':AJ' . ($hd_row_total + 6))->applyFromArray($borderleftsize9);

        $objPHPExcel->mergeCells('AK' .  ($hd_row_apv + 4) . ':AM' .  ($hd_row_apv + 4))->setCellValue('AK' .  ($hd_row_apv + 4), "Name");
        $objPHPExcel->mergeCells('AK' .  ($hd_row_apv + 5) . ':AM' .  ($hd_row_apv + 5))->setCellValue('AK' .  ($hd_row_apv + 5), "Position");
        $objPHPExcel->mergeCells('AK' .  ($hd_row_apv + 6) . ':AM' .  ($hd_row_apv + 6))->setCellValue('AK' .  ($hd_row_apv + 6), "Date");
        $objPHPExcel->getStyle('AK' . ($hd_row_apv + 4) . ':AM' . ($hd_row_apv + 6))->applyFromArray($borderleftboldsize9);

        $objPHPExcel->mergeCells('AN' .  ($hd_row_apv + 4) . ':AT' .  ($hd_row_apv + 4))->setCellValue('AN' .  ($hd_row_apv + 4), ': ' . $app3_by);
        $objPHPExcel->mergeCells('AN' .  ($hd_row_apv + 5) . ':AT' .  ($hd_row_apv + 5))->setCellValue('AN' .  ($hd_row_apv + 5), ': ' . $app3_position);
        $objPHPExcel->mergeCells('AN' .  ($hd_row_apv + 6) . ':AT' .  ($hd_row_apv + 6))->setCellValue('AN' .  ($hd_row_apv + 6), ': ' . $app3date);
        $objPHPExcel->getStyle('AN' . ($hd_row_total + 4) . ':AT' . ($hd_row_total + 6))->applyFromArray($borderleftsize9);

        $objPHPExcel->mergeCells('AU' .  ($hd_row_apv + 4) . ':AW' .  ($hd_row_apv + 4))->setCellValue('AU' .  ($hd_row_apv + 4), "Name");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_apv + 5) . ':AW' .  ($hd_row_apv + 5))->setCellValue('AU' .  ($hd_row_apv + 5), "Position");
        $objPHPExcel->mergeCells('AU' .  ($hd_row_apv + 6) . ':AW' .  ($hd_row_apv + 6))->setCellValue('AU' .  ($hd_row_apv + 6), "Date");
        $objPHPExcel->getStyle('AU' . ($hd_row_apv + 4) . ':AW' . ($hd_row_apv + 6))->applyFromArray($borderleftboldsize9);

        $objPHPExcel->mergeCells('AX' .  ($hd_row_apv + 4) . ':BD' .  ($hd_row_apv + 4))->setCellValue('AX' .  ($hd_row_apv + 4), ': ' . $app4_by);
        $objPHPExcel->mergeCells('AX' .  ($hd_row_apv + 5) . ':BD' .  ($hd_row_apv + 5))->setCellValue('AX' .  ($hd_row_apv + 5), ': ' . $app4_position);
        $objPHPExcel->mergeCells('AX' .  ($hd_row_apv + 6) . ':BD' .  ($hd_row_apv + 6))->setCellValue('AX' .  ($hd_row_apv + 6), ': ' . $app4date);
        $objPHPExcel->getStyle('AX' . ($hd_row_total + 4) . ':BD' . ($hd_row_total + 6))->applyFromArray($borderleftsize9);

        $objPHPExcel->mergeCells('BE' .  ($hd_row_apv + 4) . ':BG' .  ($hd_row_apv + 4))->setCellValue('BE' .  ($hd_row_apv + 4), "Name");
        $objPHPExcel->mergeCells('BE' .  ($hd_row_apv + 5) . ':BG' .  ($hd_row_apv + 5))->setCellValue('BE' .  ($hd_row_apv + 5), "Position");
        $objPHPExcel->mergeCells('BE' .  ($hd_row_apv + 6) . ':BG' .  ($hd_row_apv + 6))->setCellValue('BE' .  ($hd_row_apv + 6), "Date");
        $objPHPExcel->getStyle('BE' . ($hd_row_apv + 4) . ':BG' . ($hd_row_apv + 6))->applyFromArray($borderleftboldsize9);

        $objPHPExcel->mergeCells('BH' .  ($hd_row_apv + 4) . ':BN' .  ($hd_row_apv + 4))->setCellValue('BH' .  ($hd_row_apv + 4), ': ' . $app5_by);
        $objPHPExcel->mergeCells('BH' .  ($hd_row_apv + 5) . ':BN' .  ($hd_row_apv + 5))->setCellValue('BH' .  ($hd_row_apv + 5), ': ' . $app5_position);
        $objPHPExcel->mergeCells('BH' .  ($hd_row_apv + 6) . ':BN' .  ($hd_row_apv + 6))->setCellValue('BH' .  ($hd_row_apv + 6), ': ' . $app5date);
        $objPHPExcel->getStyle('BH' . ($hd_row_total + 4) . ':BN' . ($hd_row_total + 6))->applyFromArray($borderleftsize9);

        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($hd_row_apv + 4) . ':A' .  ($hd_row_apv + 6));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BO' . ($hd_row_apv + 4) . ':BO' . ($hd_row_apv + 6));

        $ftr_row_4 = $hd_row_apv + 7;
        $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($ftr_row_4) . ':A' .  ($ftr_row_4 + 1));
        $objPHPExcel->setSharedStyle($bodyStyleRight, 'BO' . ($ftr_row_4) . ':BO' . ($ftr_row_4 + 1));
        $objPHPExcel->mergeCells('A' . ($ftr_row_4 + 2) . ':Q' . ($ftr_row_4 + 2))->setCellValue('A' . ($ftr_row_4 + 2), 'Effective date on ' . $this->frmefective);
        $objPHPExcel->mergeCells('R' . ($ftr_row_4 + 2) . ':BO' . ($ftr_row_4 + 2))->setCellValue('R' . ($ftr_row_4 + 2), $this->frmnm . '-' . $this->frmver);
        $objPHPExcel->getStyle('A' . ($ftr_row_4 + 2) . ':BO' . ($ftr_row_4 + 2))->getFont()->setBold(true);
        $objPHPExcel->getStyle('R' . ($ftr_row_4 + 2) . ':BO' . ($ftr_row_4 + 2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($ftr_row_4 + 2) . ':Q' . ($ftr_row_4 + 2));
        $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($ftr_row_4 + 2) . ':BO' . ($ftr_row_4 + 2));

        $objPHPExcel->setBreak('A' . ($ftr_row_4 + 2),  PHPExcel_Worksheet::BREAK_ROW);

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
