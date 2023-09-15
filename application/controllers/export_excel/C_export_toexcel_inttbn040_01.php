<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_inttbn040_01 extends CI_Controller
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
            $this->frmefective    = date("d-m-Z", strtotime($datafrm->formefective));
        }

        $dtheader = $this->M_forminttbn040_01->get_header_byid($this->header_id);

        if(isset($dtheader)){
            foreach ($dtheader as $dtheaderrow) {
                $dtcreate_date       = $dtheaderrow->create_date;
                $create_date         = date("d-m-Z", strtotime($dtheaderrow->create_date));
                $bulan               = date('N', strtotime($dtheaderrow->create_date));
                $docno               = $dtheaderrow->docno;
                $app1_by             = $dtheaderrow->app1_by;
                $app2_by             = $dtheaderrow->app2_by;
                $app3_by             = $dtheaderrow->app3_by;
                $app4_by             = $dtheaderrow->app4_by;
                $app5_by             = $dtheaderrow->app5_by;
                $app1_position       = $dtheaderrow->app1_position;
                $app2_position       = $dtheaderrow->app2_position;
                $app3_position       = $dtheaderrow->app3_position;
                $app4_position       = $dtheaderrow->app4_position;
                $app5_position       = $dtheaderrow->app5_position;
                $app1_personalid     = $dtheaderrow->app1_personalid;
                $app2_personalid     = $dtheaderrow->app2_personalid;
                $app3_personalid     = $dtheaderrow->app3_personalid;
                $app4_personalid     = $dtheaderrow->app4_personalid;
                $app5_personalid     = $dtheaderrow->app5_personalid;
                $app1_personalstatus = $dtheaderrow->app1_personalstatus;
                $app2_personalstatus = $dtheaderrow->app2_personalstatus;
                $app3_personalstatus = $dtheaderrow->app3_personalstatus;
                $app4_personalstatus = $dtheaderrow->app4_personalstatus;
                $app5_personalstatus = $dtheaderrow->app5_personalstatus;
                $app1date            = $dtheaderrow->app1_date;
                $app2date            = $dtheaderrow->app2_date;
                $app3date            = $dtheaderrow->app3_date;
                $app4date            = $dtheaderrow->app4_date;
                $app5date            = $dtheaderrow->app5_date;
                $jam1_hdr            = $dtheaderrow->jam1_hdr;
                $jam2_hdr            = $dtheaderrow->jam2_hdr;
                $jam3_hdr            = $dtheaderrow->jam3_hdr;
                $jam4_hdr            = $dtheaderrow->jam4_hdr;
                $jam5_hdr            = $dtheaderrow->jam5_hdr;
                $jam6_hdr            = $dtheaderrow->jam6_hdr;
                $jam7_hdr            = $dtheaderrow->jam7_hdr;
                $jam8_hdr            = $dtheaderrow->jam8_hdr;
                $jam9_hdr            = $dtheaderrow->jam9_hdr;
                $jam10_hdr           = $dtheaderrow->jam10_hdr;
                $jam11_hdr           = $dtheaderrow->jam11_hdr;
                $jam12_hdr           = $dtheaderrow->jam12_hdr;
                $jam13_hdr           = $dtheaderrow->jam13_hdr;
                $jam14_hdr           = $dtheaderrow->jam14_hdr;
                $jam15_hdr           = $dtheaderrow->jam15_hdr;
                $jam16_hdr           = $dtheaderrow->jam16_hdr;
                $jam17_hdr           = $dtheaderrow->jam17_hdr;
                $jam18_hdr           = $dtheaderrow->jam18_hdr;
                $jam19_hdr           = $dtheaderrow->jam19_hdr;
                $jam20_hdr           = $dtheaderrow->jam20_hdr;
                $jam21_hdr           = $dtheaderrow->jam21_hdr;
                $jam22_hdr           = $dtheaderrow->jam22_hdr;
                $jam23_hdr           = $dtheaderrow->jam23_hdr;
                $jam24_hdr           = $dtheaderrow->jam24_hdr;
                $jam25_hdr           = $dtheaderrow->jam25_hdr;
                $jam26_hdr           = $dtheaderrow->jam26_hdr;
                $jam27_hdr           = $dtheaderrow->jam27_hdr;
                $jam28_hdr           = $dtheaderrow->jam28_hdr;
                $jam29_hdr           = $dtheaderrow->jam29_hdr;
                $jam30_hdr           = $dtheaderrow->jam30_hdr;
                $jam31_hdr           = $dtheaderrow->jam31_hdr;
                $jam32_hdr           = $dtheaderrow->jam32_hdr;
                $jam33_hdr           = $dtheaderrow->jam33_hdr;
                $jam34_hdr           = $dtheaderrow->jam34_hdr;
                $total_soft          = $dtheaderrow->total_soft;
                $total_pro           = $dtheaderrow->total_pro;
                $total_feed          = $dtheaderrow->total_feed;
                $total_product       = $dtheaderrow->total_product;
                $total_reject        = $dtheaderrow->total_reject;
                $keterangan_hdr      = $dtheaderrow->keterangan_hdr;
    
                if (trim($dtheaderrow->app1_date) != '') {
                    $app1date       = date('d-m-Z', strtotime($dtheaderrow->app1_date));
                } else {
                    $app1date = '';
                }
    
                if (trim($dtheaderrow->app2_date) != '') {
                    $app2date       = date('d-m-Z', strtotime($dtheaderrow->app2_date));
                } else {
                    $app2date = '';
                }
    
                if (trim($dtheaderrow->app3_date) != '') {
                    $app3date       = date('d-m-Z', strtotime($dtheaderrow->app3_date));
                } else {
                    $app3date = '';
                }

                if (trim($dtheaderrow->app4_date) != '') {
                    $app4date       = date('d-m-Z', strtotime($dtheaderrow->app4_date));
                } else {
                    $app4date = '';
                }

                if (trim($dtheaderrow->app5_date) != '') {
                    $app5date       = date('d-m-Z', strtotime($dtheaderrow->app5_date));
                } else {
                    $app5date = '';
                }
            }
        } 
        
        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail   = $this->M_forminttbn040_01->get_detail_byidx($this->header_id);
            $dtdetailb = $this->M_forminttbn040_01->get_detail_byidbx($this->header_id);
            $dtdetailc = $this->M_forminttbn040_01->get_detail_byidcx($this->header_id);
            $dtdetaild = $this->M_forminttbn040_01->get_detail_byiddx($this->header_id);
            $dtdetaile = $this->M_forminttbn040_01->get_detail_byidex($this->header_id);
            $dtdetailf = $this->M_forminttbn040_01->get_detail_byidfx($this->header_id);
            $dtdetailg = $this->M_forminttbn040_01->get_detail_byidgx($this->header_id);
        } else {
            $dtdetail   = $this->M_forminttbn040_01->get_detail_byid($this->header_id);
            $dtdetailb = $this->M_forminttbn040_01->get_detail_byidb($this->header_id);
            $dtdetailc = $this->M_forminttbn040_01->get_detail_byidc($this->header_id);
            $dtdetaild = $this->M_forminttbn040_01->get_detail_byidd($this->header_id);
            $dtdetaile = $this->M_forminttbn040_01->get_detail_byide($this->header_id);
            $dtdetailf = $this->M_forminttbn040_01->get_detail_byidf($this->header_id);
            $dtdetailg = $this->M_forminttbn040_01->get_detail_byidg($this->header_id);
        }

        $no = 1;
        foreach ($dtdetail as $dtdetail_row) {
            $jam1[]         = $dtdetail_row->jam1;
            $pressure_1[]   = $dtdetail_row->pressure_1;
            $h566[]         = $dtdetail_row->h566;
            $jam2[]         = $dtdetail_row->jam2;
            $pressure2      = $dtdetail_row->pressure2;
            $ph_bilas[]     = $dtdetail_row->ph_bilas;
            $jam3[]         = $dtdetail_row->jam3;
            $pressure3      = $dtdetail_row->pressure3;
            $h277[]         = $dtdetail_row->h277;
        }

        foreach($dtdetailb as $dtdetailb_row){
            $flow_awal[]    = $dtdetailb_row->flow_awal;
            $flow_akhir[]   = $dtdetailb_row->flow_akhir;
            $total[]        = $dtdetailb_row->total;
            $formula[]      = $dtdetailb_row->formula;
        }

        foreach($dtdetailc AS $dtdetail_c_row){
            $jam[]                  = $dtdetail_c_row->jam;
            $uraian[]               = $dtdetail_c_row->uraian;
            $tindakan[]             = $dtdetail_c_row->tindakan;
            $nama[]                 = $dtdetail_c_row->pj_nama;
            $paraf[]                = $dtdetail_c_row->paraf;
            $pj_personalstatus[]    = $dtdetail_c_row->pj_personalstatus;
            $pj_personalid[]        = $dtdetail_c_row->pj_personalid;
            $keterangan[]           = $dtdetail_c_row->keterangan;
        }

        foreach($dtdetailg as $dtdetail_g_row){
            $jam_waktu[]            = $dtdetail_g_row->jam_waktu;
            $start_stop[]           = $dtdetail_g_row->start_stop;
            $feed_ph[]              = $dtdetail_g_row->feed_ph;
            $feed_konduktivity[]    = $dtdetail_g_row->feed_konduktivity;
            $feed_th[]              = $dtdetail_g_row->feed_th;
            $feed_turbidity[]       = $dtdetail_g_row->feed_turbidity;
            $feed_cl[]              = $dtdetail_g_row->feed_cl;
            $feed_fcl[]             = $dtdetail_g_row->feed_fcl;
            $product_ph[]           = $dtdetail_g_row->product_ph;
            $product_konduktivity[] = $dtdetail_g_row->product_konduktivity;
        }
        
        foreach($dtdetaile as $dtdetail_e_row){
            $shift_e[]        = $dtdetail_e_row->shift_e;
            $soft_awal[]      = $dtdetail_e_row->soft_awal;
            $soft_akhir[]     = $dtdetail_e_row->soft_akhir;
            $soft_total[]     = $dtdetail_e_row->soft_total;
            $pro_awal[]       = $dtdetail_e_row->pro_awal;
            $pro_akhir[]      = $dtdetail_e_row->pro_akhir;
            $pro_total[]      = $dtdetail_e_row->pro_total;
        }

        foreach($dtdetailf as $dtdetail_f_row){
            $shift_f[]        = $dtdetail_f_row->shift_f;
            $no_pompa[]       = $dtdetail_f_row->no_pompa;
            $feed_awal[]      = $dtdetail_f_row->feed_awal;
            $feed_akhir[]     = $dtdetail_f_row->feed_akhir;
            $feed_total[]     = $dtdetail_f_row->feed_total;
            $product_flow[]   = $dtdetail_f_row->product_flow;
            $product_waktu[]  = $dtdetail_f_row->product_waktu;
            $product_total[]  = $dtdetail_f_row->product_total;
            $reject_flow[]    = $dtdetail_f_row->reject_flow;
            $reject_waktu[]   = $dtdetail_f_row->reject_waktu;
            $reject_total[]   = $dtdetail_f_row->reject_total;
        }

        foreach($dtdetaild as $dtdetail_d_row){
            $nama_mesin[] = $dtdetail_d_row->nama_mesin;
            $kode_mesin[] = $dtdetail_d_row->kode_mesin;
            $parameter[]  = $dtdetail_d_row->parameter;
            $dtl_opr1[]   = $dtdetail_d_row->dtl_opr1;
            $dtl_opr2[]   = $dtdetail_d_row->dtl_opr2;
            $dtl_opr3[]   = $dtdetail_d_row->dtl_opr3;
            $dtl_opr4[]   = $dtdetail_d_row->dtl_opr4;
            $dtl_opr5[]   = $dtdetail_d_row->dtl_opr5;
            $dtl_opr6[]   = $dtdetail_d_row->dtl_opr6;
            $dtl_opr7[]   = $dtdetail_d_row->dtl_opr7;
            $dtl_opr8[]   = $dtdetail_d_row->dtl_opr8;
            $dtl_opr9[]   = $dtdetail_d_row->dtl_opr9;
            $dtl_opr10[]  = $dtdetail_d_row->dtl_opr10;
            $dtl_opr11[]  = $dtdetail_d_row->dtl_opr11;
            $dtl_opr12[]  = $dtdetail_d_row->dtl_opr12;
            $dtl_opr13[]  = $dtdetail_d_row->dtl_opr13;
            $dtl_opr14[]  = $dtdetail_d_row->dtl_opr14;
            $dtl_opr15[]  = $dtdetail_d_row->dtl_opr15;
            $dtl_opr16[]  = $dtdetail_d_row->dtl_opr16;
            $dtl_opr17[]  = $dtdetail_d_row->dtl_opr17;
            $dtl_opr18[]  = $dtdetail_d_row->dtl_opr18;
            $dtl_opr19[]  = $dtdetail_d_row->dtl_opr19;
            $dtl_opr20[]  = $dtdetail_d_row->dtl_opr20;
            $dtl_opr21[]  = $dtdetail_d_row->dtl_opr21;
            $dtl_opr22[]  = $dtdetail_d_row->dtl_opr22;
            $dtl_opr23[]  = $dtdetail_d_row->dtl_opr23;
            $dtl_opr24[]  = $dtdetail_d_row->dtl_opr24;
            $dtl_opr25[]  = $dtdetail_d_row->dtl_opr25;
            $dtl_opr26[]  = $dtdetail_d_row->dtl_opr26;
            $dtl_opr27[]  = $dtdetail_d_row->dtl_opr27;
            $dtl_opr28[]  = $dtdetail_d_row->dtl_opr28;
            $dtl_opr29[]  = $dtdetail_d_row->dtl_opr29;
            $dtl_opr30[]  = $dtdetail_d_row->dtl_opr30;
            $dtl_opr31[]  = $dtdetail_d_row->dtl_opr31;
            $dtl_opr32[]  = $dtdetail_d_row->dtl_opr32;
            $dtl_opr33[]  = $dtdetail_d_row->dtl_opr33;
            $dtl_opr34[]  = $dtdetail_d_row->dtl_opr34;
        }

        // foreach()

        // style
        $PTStyle                   = new PHPExcel_Style();
        $headerStyle               = new PHPExcel_Style();
        $headerStyleLeft           = new PHPExcel_Style();
        $headerStyleRight          = new PHPExcel_Style();
        $headerStyleLeftTop        = new PHPExcel_Style();
        $headerStyleRightTop       = new PHPExcel_Style();
        $headerStyleLeftBottomTop  = new PHPExcel_Style();
        $headerStyleRightBottomTop = new PHPExcel_Style();
        $DetailheaderStyle         = new PHPExcel_Style();
        $bodyStyle                 = new PHPExcel_Style();
        $bodyStyleAlignLeft        = new PHPExcel_Style();
        $noborderStyle             = new PHPExcel_Style();
        $bodyStyleLeft             = new PHPExcel_Style();
        $bodyStyleRight            = new PHPExcel_Style();
        $footerStyleLeftbottom     = new PHPExcel_Style();
        $footerStyleRightbottom    = new PHPExcel_Style();

        $PTStyle->applyFromArray($this->xls->PT_STYLE);
        $headerStyle->applyFromArray($this->xls->headerStyle);
        $headerStyleLeftTop->applyFromArray($this->xls->headerStyleLeftTop);
        $headerStyleLeft->applyFromArray($this->xls->headerStyleLeft);
        $headerStyleRight->applyFromArray($this->xls->headerStyleRight);
        $headerStyleRightTop->applyFromArray($this->xls->headerStyleRightTop);
        $headerStyleLeftBottomTop->applyFromArray($this->xls->headerStyleLeftBottomTop);
        $headerStyleRightBottomTop->applyFromArray($this->xls->headerStyleRightBottomTop);
        $DetailheaderStyle->applyFromArray($this->xls->DetailheaderStyle);
        $bodyStyle->applyFromArray($this->xls->bodyStyle);
        $bodyStyleAlignLeft->applyFromArray($this->xls->bodyStyleAlignLeft);
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

        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getPageSetup()->setFitToPage(true);
        $objPHPExcel->getPageSetup()->setScale(63);
        $objPHPExcel->getPageMargins()->setLeft(0.2);
        $objPHPExcel->getPageMargins()->setRight(0.2);
        $objPHPExcel->getPageMargins()->setBottom(0.2);
        $objPHPExcel->getPageMargins()->setTop(0.2);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);
        $objPHPExcel->getPageSetup()->setVerticalCentered(true);

        $range = array();
        $rangeCol = "AN";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(5);
        }
        $objPHPExcel->getColumnDimension("B")->setWidth(10);
        $objPHPExcel->getColumnDimension("C")->setWidth(7);
        $objPHPExcel->getColumnDimension("E")->setWidth(15);
        
        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(15);
        }
        // $objPHPExcel->getRowDimension("46")->setRowHeight(45);
        
        $count1 = count($dtdetail);
        $jml_data_perpage = 7;
        if ($count1 < $jml_data_perpage) {
            $jml_page_a = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page_a = $count1 / $jml_data_perpage;
            } else {
                $jml_page_a = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }

        
        $count2 = count($dtdetailb);
        $jml_data_perpage_b = 2;
        if ($count2 < $jml_data_perpage_b) {
            $jml_page_b = 1;
        } else {
            if (($count2 % $jml_data_perpage_b) == 0) {
                $jml_page_b = $count2 / $jml_data_perpage_b;
            } else {
                $jml_page_b = floor(($count2 / $jml_data_perpage_b)) + 1;
            }
        }

        $count3 = count($dtdetailc);
        $jml_data_perpage_c = 10;
        if ($count3 < $jml_data_perpage_c) {
            $jml_page_c = 1;
        } else {
            if (($count3 % $jml_data_perpage_c) == 0) {
                $jml_page_c = $count3 / $jml_data_perpage_c;
            } else {
                $jml_page_c = floor(($count3 / $jml_data_perpage_c)) + 1;
            }
        }
        
        $count4 = count($dtdetailg);
        $jml_data_perpage_g = 28;
        if ($count4 < $jml_data_perpage_g) {
            $jml_page_g = 1;
        } else {
            if (($count4 % $jml_data_perpage_g) == 0) {
                $jml_page_g = $count4 / $jml_data_perpage_g;
            } else {
                $jml_page_g = floor(($count4 / $jml_data_perpage_g)) + 1;
            }
        }

        $count5 = count($dtdetaile);
        $jml_data_perpage_e = 3;
        if ($count5 < $jml_data_perpage_e) {
            $jml_page_e = 1;
        } else {
            if (($count5 % $jml_data_perpage_e) == 0) {
                $jml_page_e = $count5 / $jml_data_perpage_e;
            } else {
                $jml_page_e = floor(($count5 / $jml_data_perpage_e)) + 1;
            }
        }

        $count6 = count($dtdetailf);
        $jml_data_perpage_f = 3;
        if ($count6 < $jml_data_perpage_f) {
            $jml_page_f = 1;
        } else {
            if (($count6 % $jml_data_perpage_f) == 0) {
                $jml_page_f = $count6 / $jml_data_perpage_f;
            } else {
                $jml_page_f = floor(($count6 / $jml_data_perpage_f)) + 1;
            }
        }

        $count7 = count($dtdetaild);
        $jml_data_perpage_d = 13;
        if ($count7 < $jml_data_perpage_d) {
            $jml_page_d = 1;
        } else {
            if (($count7 % $jml_data_perpage_d) == 0) {
                $jml_page_d = $count7 / $jml_data_perpage_d;
            } else {
                $jml_page_d = floor(($count7 / $jml_data_perpage_d)) + 1;
            }
        }

        $jml_row_perpage  = 500;

        $jml_page = max($jml_page_a, $jml_page_b ,$jml_page_c, $jml_page_g, $jml_page_e, $jml_page_f, $jml_page_d);

        // $number = 0;
        for ($i1 = 0; $i1 < $jml_page; $i1++) {

            $start_row = ($i1 * $jml_row_perpage) + 1;
            $finish_row = ((($i1 * $jml_row_perpage) + 1) + ($jml_row_perpage));

            $start_detail = ($i1 * $jml_data_perpage);
            $finish_detail = (($i1 * $jml_data_perpage) + ($jml_data_perpage - 1));

            $start_detail_b = ($i1 * $jml_data_perpage_b);
            $finish_detail_b = (($i1 * $jml_data_perpage_b) + ($jml_data_perpage_b - 1));

            $start_detail_d = ($i1 * $jml_data_perpage_d);
            $finish_detail_d = (($i1 * $jml_data_perpage_d) + ($jml_data_perpage_d - 1));

            $start_detail_g = ($i1 * $jml_data_perpage_g);
            $finish_detail_g = (($i1 * $jml_data_perpage_g) + ($jml_data_perpage_g - 1));

            $start_detail_e = ($i1 * $jml_data_perpage_e);
            $finish_detail_e = (($i1 * $jml_data_perpage_e) + ($jml_data_perpage_e - 1));

            $start_detail_f = ($i1 * $jml_data_perpage_f);
            $finish_detail_f = (($i1 * $jml_data_perpage_f) + ($jml_data_perpage_f - 1));

            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/PSG_logo_2022.png');
            $gbr->setWidthAndHeight(45, 45);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('A' . $start_row)->setOffsetX(42);


            $objPHPExcel->mergeCells('A' .   $start_row . ':B' . ($start_row + 1));
            $objPHPExcel->mergeCells('C' .   $start_row . ':AI' . ($start_row +1))->setCellValue('C' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AJ' .  $start_row . ':AJ' . $start_row)->setCellValue('AJ' . $start_row, 'Doc');
            $objPHPExcel->mergeCells('AK' .  $start_row . ':AN' . $start_row)->setCellValue('AK' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('AJ' . ($start_row + 1) . ':AJ' . ($start_row + 1))->setCellValue('AJ' . ($start_row + 1), 'Date');
            $objPHPExcel->mergeCells('AK' . ($start_row + 1) . ':AN' . ($start_row + 1))->setCellValue('AK' . ($start_row + 1), ': ' . $dtcreate_date);

            $objPHPExcel->mergeCells('A' .  ($start_row + 2) . ':B' .  ($start_row + 2))->setCellValue('A' .  ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('C' .  ($start_row + 2) . ':AI' . ($start_row + 2))->setCellValue('C' .  ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AJ' . ($start_row + 2) . ':AJ' . ($start_row + 2))->setCellValue('AJ' . ($start_row + 2), 'Page');
            $objPHPExcel->mergeCells('AK' . ($start_row + 2) . ':AN' . ($start_row + 2))->setCellValue('AK' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row .      ':B' .  ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':AN' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':AN' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':AI' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AJ' . ($start_row) . ':AN' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AK' .  $start_row  . ':AN' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AJ' . ($start_row + 2) . ':AN' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AK' . ($start_row + 2) . ':AN' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'C' . ($start_row) . ':AI' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':B' . ($start_row + 2));
            $objPHPExcel->getStyle('AJ' . ($start_row) . ':AN' . ($start_row))->getFont()->setSize(10);

            $objPHPExcel->mergeCells('A' .  ($start_row + 4) . ':A' .  ($start_row + 6))->setCellValue('A' .  ($start_row + 4), 'NO');
            $objPHPExcel->mergeCells('B' .  ($start_row + 4) . ':B' .  ($start_row + 6))->setCellValue('B' .  ($start_row + 4), "NAMA \n MESIN");
            $objPHPExcel->mergeCells('C' .  ($start_row + 4) . ':C' .  ($start_row + 6))->setCellValue('C' .  ($start_row + 4), 'KODE');
            $objPHPExcel->mergeCells('D' .  ($start_row + 4) . ':F' .  ($start_row + 6))->setCellValue('D' .  ($start_row + 4), 'PARAMETER');
            $objPHPExcel->mergeCells('G' .  ($start_row + 4) . ':AN' .  ($start_row + 5))->setCellValue('G' .  ($start_row + 4), 'OPERASI (JAM)');
            $objPHPExcel->mergeCells('G' .  ($start_row + 6) . ':G' .  ($start_row + 6))->setCellValue('G' .  ($start_row + 6), $jam1_hdr);
            $objPHPExcel->mergeCells('H' .  ($start_row + 6) . ':H' .  ($start_row + 6))->setCellValue('H' .  ($start_row + 6), $jam2_hdr);
            $objPHPExcel->mergeCells('I' .  ($start_row + 6) . ':I' .  ($start_row + 6))->setCellValue('I' .  ($start_row + 6), $jam3_hdr);
            $objPHPExcel->mergeCells('J' .  ($start_row + 6) . ':J' .  ($start_row + 6))->setCellValue('J' .  ($start_row + 6), $jam4_hdr);
            $objPHPExcel->mergeCells('K' .  ($start_row + 6) . ':K' .  ($start_row + 6))->setCellValue('K' .  ($start_row + 6), $jam5_hdr);
            $objPHPExcel->mergeCells('L' .  ($start_row + 6) . ':L' .  ($start_row + 6))->setCellValue('L' .  ($start_row + 6), $jam6_hdr);
            $objPHPExcel->mergeCells('M' .  ($start_row + 6) . ':M' .  ($start_row + 6))->setCellValue('M' .  ($start_row + 6), $jam7_hdr);
            $objPHPExcel->mergeCells('N' .  ($start_row + 6) . ':N' .  ($start_row + 6))->setCellValue('N' .  ($start_row + 6), $jam8_hdr);
            $objPHPExcel->mergeCells('O' .  ($start_row + 6) . ':O' .  ($start_row + 6))->setCellValue('O' .  ($start_row + 6), $jam9_hdr);
            $objPHPExcel->mergeCells('P' .  ($start_row + 6) . ':P' .  ($start_row + 6))->setCellValue('P' .  ($start_row + 6), $jam10_hdr);
            $objPHPExcel->mergeCells('Q' .  ($start_row + 6) . ':Q' .  ($start_row + 6))->setCellValue('Q' .  ($start_row + 6), $jam11_hdr);
            $objPHPExcel->mergeCells('R' .  ($start_row + 6) . ':R' .  ($start_row + 6))->setCellValue('R' .  ($start_row + 6), $jam12_hdr);
            $objPHPExcel->mergeCells('S' .  ($start_row + 6) . ':S' .  ($start_row + 6))->setCellValue('S' .  ($start_row + 6), $jam13_hdr);
            $objPHPExcel->mergeCells('G' .  ($start_row + 6) . ':G' .  ($start_row + 6))->setCellValue('G' .  ($start_row + 6), $jam14_hdr);
            $objPHPExcel->mergeCells('U' .  ($start_row + 6) . ':U' .  ($start_row + 6))->setCellValue('U' .  ($start_row + 6), $jam15_hdr);
            $objPHPExcel->mergeCells('V' .  ($start_row + 6) . ':V' .  ($start_row + 6))->setCellValue('V' .  ($start_row + 6), $jam16_hdr);
            $objPHPExcel->mergeCells('W' .  ($start_row + 6) . ':W' .  ($start_row + 6))->setCellValue('W' .  ($start_row + 6), $jam17_hdr);
            $objPHPExcel->mergeCells('X' .  ($start_row + 6) . ':X' .  ($start_row + 6))->setCellValue('X' .  ($start_row + 6), $jam18_hdr);
            $objPHPExcel->mergeCells('Y' .  ($start_row + 6) . ':Y' .  ($start_row + 6))->setCellValue('Y' .  ($start_row + 6), $jam19_hdr);
            $objPHPExcel->mergeCells('Z' .  ($start_row + 6) . ':Z' .  ($start_row + 6))->setCellValue('Z' .  ($start_row + 6), $jam20_hdr);
            $objPHPExcel->mergeCells('AA' .  ($start_row + 6) . ':AA' .  ($start_row + 6))->setCellValue('AA' .  ($start_row + 6), $jam21_hdr);
            $objPHPExcel->mergeCells('AB' .  ($start_row + 6) . ':AB' .  ($start_row + 6))->setCellValue('AB' .  ($start_row + 6), $jam22_hdr);
            $objPHPExcel->mergeCells('AC' .  ($start_row + 6) . ':AC' .  ($start_row + 6))->setCellValue('AC' .  ($start_row + 6), $jam23_hdr);
            $objPHPExcel->mergeCells('AD' .  ($start_row + 6) . ':AD' .  ($start_row + 6))->setCellValue('AD' .  ($start_row + 6), $jam24_hdr);
            $objPHPExcel->mergeCells('AE' .  ($start_row + 6) . ':AE' .  ($start_row + 6))->setCellValue('AE' .  ($start_row + 6), $jam25_hdr);
            $objPHPExcel->mergeCells('AF' .  ($start_row + 6) . ':AF' .  ($start_row + 6))->setCellValue('AF' .  ($start_row + 6), $jam26_hdr);
            $objPHPExcel->mergeCells('AG' .  ($start_row + 6) . ':AG' .  ($start_row + 6))->setCellValue('AG' .  ($start_row + 6), $jam27_hdr);
            $objPHPExcel->mergeCells('AH' .  ($start_row + 6) . ':AH' .  ($start_row + 6))->setCellValue('AH' .  ($start_row + 6), $jam28_hdr);
            $objPHPExcel->mergeCells('AI' .  ($start_row + 6) . ':AI' .  ($start_row + 6))->setCellValue('AI' .  ($start_row + 6), $jam29_hdr);
            $objPHPExcel->mergeCells('AJ' .  ($start_row + 6) . ':AJ' .  ($start_row + 6))->setCellValue('AJ' .  ($start_row + 6), $jam30_hdr);
            $objPHPExcel->mergeCells('AK' .  ($start_row + 6) . ':AK' .  ($start_row + 6))->setCellValue('AK' .  ($start_row + 6), $jam31_hdr);
            $objPHPExcel->mergeCells('AL' .  ($start_row + 6) . ':AL' .  ($start_row + 6))->setCellValue('AL' .  ($start_row + 6), $jam32_hdr);
            $objPHPExcel->mergeCells('AM' .  ($start_row + 6) . ':AM' .  ($start_row + 6))->setCellValue('AM' .  ($start_row + 6), $jam33_hdr);
            $objPHPExcel->mergeCells('AN' .  ($start_row + 6) . ':AN' .  ($start_row + 6))->setCellValue('AN' .  ($start_row + 6), $jam34_hdr);

            $objPHPExcel->setSharedStyle($noborderStyle,  'A' .  ($start_row + 3) . ':AN' .  ($start_row + 30));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row + 3) . ':A' .  ($start_row + 15));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AN' . ($start_row + 3) . ':AN' . ($start_row + 15));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row + 4) . ':AN' . ($start_row + 6));
            // $objPHPExcel->getStyle('C' . ($start_row + 4) . ':AL' . ($start_row + 5))->getFont()->setBold(true)->setSize(9);

            $dtl_row = $start_row + 7;
            $no = 1;
            for ($arr = $start_detail_d; $arr <= $finish_detail_d; $arr++) {

                if (isset($nama_mesin[$arr])) { $dt_nama_mesin[$arr] = $nama_mesin[$arr]; } else { $dt_nama_mesin[$arr] = ""; }
                if (isset($kode_mesin[$arr])) { $dt_kode_mesin[$arr] = $kode_mesin[$arr]; } else { $dt_kode_mesin[$arr] = ""; }
                if (isset($parameter[$arr])) { $dt_parameter[$arr] = $parameter[$arr]; } else { $dt_parameter[$arr] = ""; }
                if (isset($dtl_opr1[$arr])) { $dt_dtl_opr1[$arr] = $dtl_opr1[$arr]; } else { $dt_dtl_opr1[$arr] = ""; }
                if (isset($dtl_opr2[$arr])) { $dt_dtl_opr2[$arr] = $dtl_opr2[$arr]; } else { $dt_dtl_opr2[$arr] = ""; }
                if (isset($dtl_opr3[$arr])) { $dt_dtl_opr3[$arr] = $dtl_opr3[$arr]; } else { $dt_dtl_opr3[$arr] = ""; }
                if (isset($dtl_opr4[$arr])) { $dt_dtl_opr4[$arr] = $dtl_opr4[$arr]; } else { $dt_dtl_opr4[$arr] = ""; }
                if (isset($dtl_opr5[$arr])) { $dt_dtl_opr5[$arr] = $dtl_opr5[$arr]; } else { $dt_dtl_opr5[$arr] = ""; }
                if (isset($dtl_opr6[$arr])) { $dt_dtl_opr6[$arr] = $dtl_opr6[$arr]; } else { $dt_dtl_opr6[$arr] = ""; }
                if (isset($dtl_opr7[$arr])) { $dt_dtl_opr7[$arr] = $dtl_opr7[$arr]; } else { $dt_dtl_opr7[$arr] = ""; }
                if (isset($dtl_opr8[$arr])) { $dt_dtl_opr8[$arr] = $dtl_opr8[$arr]; } else { $dt_dtl_opr8[$arr] = ""; }
                if (isset($dtl_opr9[$arr])) { $dt_dtl_opr9[$arr] = $dtl_opr9[$arr]; } else { $dt_dtl_opr9[$arr] = ""; }
                if (isset($dtl_opr10[$arr])) { $dt_dtl_opr10[$arr] = $dtl_opr10[$arr]; } else { $dt_dtl_opr10[$arr] = ""; }
                if (isset($dtl_opr11[$arr])) { $dt_dtl_opr11[$arr] = $dtl_opr11[$arr]; } else { $dt_dtl_opr11[$arr] = ""; }
                if (isset($dtl_opr12[$arr])) { $dt_dtl_opr12[$arr] = $dtl_opr12[$arr]; } else { $dt_dtl_opr12[$arr] = ""; }
                if (isset($dtl_opr13[$arr])) { $dt_dtl_opr13[$arr] = $dtl_opr13[$arr]; } else { $dt_dtl_opr13[$arr] = ""; }
                if (isset($dtl_opr14[$arr])) { $dt_dtl_opr14[$arr] = $dtl_opr14[$arr]; } else { $dt_dtl_opr14[$arr] = ""; }
                if (isset($dtl_opr15[$arr])) { $dt_dtl_opr15[$arr] = $dtl_opr15[$arr]; } else { $dt_dtl_opr15[$arr] = ""; }
                if (isset($dtl_opr16[$arr])) { $dt_dtl_opr16[$arr] = $dtl_opr16[$arr]; } else { $dt_dtl_opr16[$arr] = ""; }
                if (isset($dtl_opr17[$arr])) { $dt_dtl_opr17[$arr] = $dtl_opr17[$arr]; } else { $dt_dtl_opr17[$arr] = ""; }
                if (isset($dtl_opr18[$arr])) { $dt_dtl_opr18[$arr] = $dtl_opr18[$arr]; } else { $dt_dtl_opr18[$arr] = ""; }
                if (isset($dtl_opr19[$arr])) { $dt_dtl_opr19[$arr] = $dtl_opr19[$arr]; } else { $dt_dtl_opr19[$arr] = ""; }
                if (isset($dtl_opr20[$arr])) { $dt_dtl_opr20[$arr] = $dtl_opr20[$arr]; } else { $dt_dtl_opr20[$arr] = ""; }
                if (isset($dtl_opr21[$arr])) { $dt_dtl_opr21[$arr] = $dtl_opr21[$arr]; } else { $dt_dtl_opr21[$arr] = ""; }
                if (isset($dtl_opr22[$arr])) { $dt_dtl_opr22[$arr] = $dtl_opr22[$arr]; } else { $dt_dtl_opr22[$arr] = ""; }
                if (isset($dtl_opr23[$arr])) { $dt_dtl_opr23[$arr] = $dtl_opr23[$arr]; } else { $dt_dtl_opr23[$arr] = ""; }
                if (isset($dtl_opr24[$arr])) { $dt_dtl_opr24[$arr] = $dtl_opr24[$arr]; } else { $dt_dtl_opr24[$arr] = ""; }
                if (isset($dtl_opr25[$arr])) { $dt_dtl_opr25[$arr] = $dtl_opr25[$arr]; } else { $dt_dtl_opr25[$arr] = ""; }
                if (isset($dtl_opr26[$arr])) { $dt_dtl_opr26[$arr] = $dtl_opr26[$arr]; } else { $dt_dtl_opr26[$arr] = ""; }
                if (isset($dtl_opr27[$arr])) { $dt_dtl_opr27[$arr] = $dtl_opr27[$arr]; } else { $dt_dtl_opr27[$arr] = ""; }
                if (isset($dtl_opr28[$arr])) { $dt_dtl_opr28[$arr] = $dtl_opr28[$arr]; } else { $dt_dtl_opr28[$arr] = ""; }
                if (isset($dtl_opr29[$arr])) { $dt_dtl_opr29[$arr] = $dtl_opr29[$arr]; } else { $dt_dtl_opr29[$arr] = ""; }
                if (isset($dtl_opr30[$arr])) { $dt_dtl_opr30[$arr] = $dtl_opr30[$arr]; } else { $dt_dtl_opr30[$arr] = ""; }
                if (isset($dtl_opr31[$arr])) { $dt_dtl_opr31[$arr] = $dtl_opr31[$arr]; } else { $dt_dtl_opr31[$arr] = ""; }
                if (isset($dtl_opr32[$arr])) { $dt_dtl_opr32[$arr] = $dtl_opr32[$arr]; } else { $dt_dtl_opr32[$arr] = ""; }
                if (isset($dtl_opr33[$arr])) { $dt_dtl_opr33[$arr] = $dtl_opr33[$arr]; } else { $dt_dtl_opr33[$arr] = ""; }
                if (isset($dtl_opr34[$arr])) { $dt_dtl_opr34[$arr] = $dtl_opr34[$arr]; } else { $dt_dtl_opr34[$arr] = ""; }

                    $objPHPExcel->mergeCells('A' .  $dtl_row . ':A' .  $dtl_row)->setCellValue('A' .  $dtl_row, $no++);
                    $objPHPExcel->mergeCells('C' .  $dtl_row . ':C' .  $dtl_row)->setCellValue('C' .  $dtl_row, $dt_kode_mesin[$arr]);
                    $objPHPExcel->mergeCells('D' .  $dtl_row . ':F' .  $dtl_row)->setCellValue('D' .  $dtl_row, $dt_parameter[$arr]);
                    $objPHPExcel->mergeCells('E' .  $dtl_row . ':E' .  $dtl_row)->setCellValue('E' .  $dtl_row, $dt_dtl_opr1[$arr]);
                    $objPHPExcel->mergeCells('G' .  $dtl_row . ':G' .  $dtl_row)->setCellValue('G' .  $dtl_row, $dt_dtl_opr2[$arr]);
                    $objPHPExcel->mergeCells('H' .  $dtl_row . ':H' .  $dtl_row)->setCellValue('H' .  $dtl_row, $dt_dtl_opr3[$arr]);
                    $objPHPExcel->mergeCells('I' .  $dtl_row . ':I' .  $dtl_row)->setCellValue('I' .  $dtl_row, $dt_dtl_opr4[$arr]);
                    $objPHPExcel->mergeCells('J' .  $dtl_row . ':J' .  $dtl_row)->setCellValue('J' .  $dtl_row, $dt_dtl_opr5[$arr]);
                    $objPHPExcel->mergeCells('K' .  $dtl_row . ':K' .  $dtl_row)->setCellValue('K' .  $dtl_row, $dt_dtl_opr6[$arr]);
                    $objPHPExcel->mergeCells('L' .  $dtl_row . ':L' .  $dtl_row)->setCellValue('L' .  $dtl_row, $dt_dtl_opr7[$arr]);
                    $objPHPExcel->mergeCells('M' .  $dtl_row . ':M' .  $dtl_row)->setCellValue('M' .  $dtl_row, $dt_dtl_opr8[$arr]);
                    $objPHPExcel->mergeCells('N' .  $dtl_row . ':N' .  $dtl_row)->setCellValue('N' .  $dtl_row, $dt_dtl_opr9[$arr]);
                    $objPHPExcel->mergeCells('O' .  $dtl_row . ':O' .  $dtl_row)->setCellValue('O' .  $dtl_row, $dt_dtl_opr10[$arr]);
                    $objPHPExcel->mergeCells('P' .  $dtl_row . ':P' .  $dtl_row)->setCellValue('P' .  $dtl_row, $dt_dtl_opr11[$arr]);
                    $objPHPExcel->mergeCells('Q' .  $dtl_row . ':Q' .  $dtl_row)->setCellValue('Q' .  $dtl_row, $dt_dtl_opr12[$arr]);
                    $objPHPExcel->mergeCells('R' .  $dtl_row . ':R' .  $dtl_row)->setCellValue('R' .  $dtl_row, $dt_dtl_opr13[$arr]);
                    $objPHPExcel->mergeCells('S' .  $dtl_row . ':S' .  $dtl_row)->setCellValue('S' .  $dtl_row, $dt_dtl_opr14[$arr]);
                    $objPHPExcel->mergeCells('T' .  $dtl_row . ':T' .  $dtl_row)->setCellValue('T' .  $dtl_row, $dt_dtl_opr15[$arr]);
                    $objPHPExcel->mergeCells('U' .  $dtl_row . ':U' .  $dtl_row)->setCellValue('U' .  $dtl_row, $dt_dtl_opr16[$arr]);
                    $objPHPExcel->mergeCells('V' .  $dtl_row . ':V' .  $dtl_row)->setCellValue('V' .  $dtl_row, $dt_dtl_opr17[$arr]);
                    $objPHPExcel->mergeCells('W' .  $dtl_row . ':W' .  $dtl_row)->setCellValue('W' .  $dtl_row, $dt_dtl_opr18[$arr]);
                    $objPHPExcel->mergeCells('X' .  $dtl_row . ':X' .  $dtl_row)->setCellValue('X' .  $dtl_row, $dt_dtl_opr19[$arr]);
                    $objPHPExcel->mergeCells('Y' .  $dtl_row . ':Y' .  $dtl_row)->setCellValue('Y' .  $dtl_row, $dt_dtl_opr20[$arr]);
                    $objPHPExcel->mergeCells('Z' .  $dtl_row . ':Z' .  $dtl_row)->setCellValue('Z' .  $dtl_row, $dt_dtl_opr21[$arr]);
                    $objPHPExcel->mergeCells('AA' .  $dtl_row . ':AA' .  $dtl_row)->setCellValue('AA' .  $dtl_row, $dt_dtl_opr22[$arr]);
                    $objPHPExcel->mergeCells('AB' .  $dtl_row . ':AB' .  $dtl_row)->setCellValue('AB' .  $dtl_row, $dt_dtl_opr23[$arr]);
                    $objPHPExcel->mergeCells('AC' .  $dtl_row . ':AC' .  $dtl_row)->setCellValue('AC' .  $dtl_row, $dt_dtl_opr24[$arr]);
                    $objPHPExcel->mergeCells('AD' .  $dtl_row . ':AD' .  $dtl_row)->setCellValue('AD' .  $dtl_row, $dt_dtl_opr25[$arr]);
                    $objPHPExcel->mergeCells('AE' .  $dtl_row . ':AE' .  $dtl_row)->setCellValue('AE' .  $dtl_row, $dt_dtl_opr26[$arr]);
                    $objPHPExcel->mergeCells('AF' .  $dtl_row . ':AF' .  $dtl_row)->setCellValue('AF' .  $dtl_row, $dt_dtl_opr27[$arr]);
                    $objPHPExcel->mergeCells('AG' .  $dtl_row . ':AG' .  $dtl_row)->setCellValue('AG' .  $dtl_row, $dt_dtl_opr28[$arr]);
                    $objPHPExcel->mergeCells('AH' .  $dtl_row . ':AH' .  $dtl_row)->setCellValue('AH' .  $dtl_row, $dt_dtl_opr29[$arr]);
                    $objPHPExcel->mergeCells('AI' .  $dtl_row . ':AI' .  $dtl_row)->setCellValue('AI' .  $dtl_row, $dt_dtl_opr30[$arr]);
                    $objPHPExcel->mergeCells('AJ' .  $dtl_row . ':AJ' .  $dtl_row)->setCellValue('AJ' .  $dtl_row, $dt_dtl_opr31[$arr]);
                    $objPHPExcel->mergeCells('AK' .  $dtl_row . ':AK' .  $dtl_row)->setCellValue('AK' .  $dtl_row, $dt_dtl_opr32[$arr]);
                    $objPHPExcel->mergeCells('AL' .  $dtl_row . ':AL' .  $dtl_row)->setCellValue('AL' .  $dtl_row, $dt_dtl_opr33[$arr]);
                    $objPHPExcel->mergeCells('AM' .  $dtl_row . ':AM' .  $dtl_row)->setCellValue('AM' .  $dtl_row, $dt_dtl_opr34[$arr]);
                
                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $dtl_row . ':AN' . $dtl_row);
                $objPHPExcel->getStyle('B' . ($dtl_row) . ':B' . ($dtl_row + 1))->getAlignment()->setTextRotation(90);

                $dtl_row++;
            }
            
            
            $table2 = $dtl_row + 1;
            
            $objPHPExcel->mergeCells('B' .  ($table2 - 14) . ':B' .  ($table2 - 2))->setCellValue('B' .  ($table2 - 14), "Reverse Osmosis 1");

            $objPHPExcel->mergeCells('A' .  ($table2) . ':B' .  ($table2))->setCellValue('A' .  ($table2), 'FLOWMETER');
            $objPHPExcel->mergeCells('C' .  ($table2) . ':I' .  ($table2))->setCellValue('C' .  ($table2), 'SOFTENER');
            $objPHPExcel->mergeCells('J' .  ($table2) . ':S' .  ($table2))->setCellValue('J' .  ($table2), 'PROSES DEMIN (RO)');
            $objPHPExcel->mergeCells('A' .  ($table2 + 1) . ':B' .  ($table2 + 1))->setCellValue('A' .  ($table2 + 1), 'SHIFT');
            $objPHPExcel->mergeCells('C' .  ($table2 + 1) . ':D' .  ($table2 + 1))->setCellValue('C' .  ($table2 + 1), 'AWAL');
            $objPHPExcel->mergeCells('E' .  ($table2 + 1) . ':E' .  ($table2 + 1))->setCellValue('E' .  ($table2 + 1), 'AKHIR');
            $objPHPExcel->mergeCells('F' .  ($table2 + 1) . ':I' .  ($table2 + 1))->setCellValue('F' .  ($table2 + 1), 'TOTAL');
            $objPHPExcel->mergeCells('J' .  ($table2 + 1) . ':M' .  ($table2 + 1))->setCellValue('J' .  ($table2 + 1), 'AWAL');
            $objPHPExcel->mergeCells('N' .  ($table2 + 1) . ':P' .  ($table2 + 1))->setCellValue('N' .  ($table2 + 1), 'AKHIR');
            $objPHPExcel->mergeCells('Q' .  ($table2 + 1) . ':S' .  ($table2 + 1))->setCellValue('Q' .  ($table2 + 1), 'TOTAL');

            $objPHPExcel->mergeCells('A' .  ($table2 + 5) . ':B' .  ($table2 + 5))->setCellValue('A' .  ($table2 + 5), 'TOTAL');
            $objPHPExcel->mergeCells('F' .  ($table2 + 5) . ':I' .  ($table2 + 5))->setCellValue('F' .  ($table2 + 5), $total_soft);
            $objPHPExcel->mergeCells('Q' .  ($table2 + 5) . ':S' .  ($table2 + 5))->setCellValue('Q' .  ($table2 + 5), $total_pro);
            $objPHPExcel->mergeCells('C' .  ($table2 + 5) . ':E' .  ($table2 + 5))->setCellValue('C' .  ($table2 + 5), '');
            $objPHPExcel->mergeCells('J' .  ($table2 + 5) . ':P' .  ($table2 + 5))->setCellValue('J' .  ($table2 + 5), '');
            
            $objPHPExcel->mergeCells('AA' .  ($table2) . ':AC' .  ($table2))->setCellValue('AA' .  ($table2), 'Keterangan :');
            $objPHPExcel->mergeCells('AD' .  ($table2) . ':AD' .  ($table2))->setCellValue('AD' .  ($table2), '*');
            $objPHPExcel->mergeCells('AE' .  ($table2) . ':AM' .  ($table2))->setCellValue('AE' .  ($table2), 'Catridge diganti jika:'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 1) . ':AM' .  ($table2 + 1))->setCellValue('AE' .  ($table2 + 1), 'Delta P  0,7 ( Delta P = Inlet Cartridge - Outlet Cartridge )'); 
            $objPHPExcel->mergeCells('AD' .  ($table2 + 2) . ':AD' .  ($table2 + 2))->setCellValue('AD' .  ($table2 + 2), '*');
            $objPHPExcel->mergeCells('AE' .  ($table2 + 2) . ':AM' .  ($table2 + 2))->setCellValue('AE' .  ($table2 + 2), 'CIP Dilakukan Jika:'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 3) . ':AM' .  ($table2 + 3))->setCellValue('AE' .  ($table2 + 3), 'Delta P 3,5 bar'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 4) . ':AM' .  ($table2 + 4))->setCellValue('AE' .  ($table2 + 4), '( Delta P = P. Inlet membran - P. Outlet stage 1 atau'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 5) . ':AM' .  ($table2 + 5))->setCellValue('AE' .  ($table2 + 5), 'P. Outlet stage 1 - P. Concentrate )'); 
            $objPHPExcel->mergeCells('AD' .  ($table2 + 6) . ':AD' .  ($table2 + 6))->setCellValue('AD' .  ($table2 + 6), '*');
            $objPHPExcel->mergeCells('AE' .  ($table2 + 6) . ':AM' .  ($table2 + 6))->setCellValue('AE' .  ($table2 + 6), 'Cleaning Bag filter setiap hari'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 7) . ':AM' .  ($table2 + 7))->setCellValue('AE' .  ($table2 + 7), 'PG : Pressure Gauge'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 8) . ':AM' .  ($table2 + 8))->setCellValue('AE' .  ($table2 + 8), 'DP  : Dosing Pump'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 9) . ':AM' .  ($table2 + 9))->setCellValue('AE' .  ($table2 + 9), 'FL :  Flow Meter'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 10) . ':AM' .  ($table2 + 10))->setCellValue('AE' .  ($table2 + 10), 'M3 : Meter kubik'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 11) . ':AM' .  ($table2 + 11))->setCellValue('AE' .  ($table2 + 11), 'TH : Total Hardness'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 12) . ':AM' .  ($table2 + 12))->setCellValue('AE' .  ($table2 + 12), 'TB : Turbidity'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 13) . ':AM' .  ($table2 + 13))->setCellValue('AE' .  ($table2 + 13), 'FCl : Free Chlorine'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 14) . ':AM' .  ($table2 + 14))->setCellValue('AE' .  ($table2 + 14), 'Cl- : Chloride'); 
            $objPHPExcel->mergeCells('AE' .  ($table2 + 15) . ':AM' .  ($table2 + 15))->setCellValue('AE' .  ($table2 + 15), 'Kond : Konduktivity'); 
            
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($table2 - 1) . ':A' .  ($table2 + 5));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AN' . ($table2 - 1) . ':AN' . ($table2 + 5));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($table2) . ':S' . ($table2 + 1));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($table2 + 5) . ':S' . ($table2 + 5));

            $dtl_row3 = $table2 + 2;
            for ($arr = $start_detail_e; $arr <= $finish_detail_e; $arr++) {

                if (isset($shift_e[$arr])) { $dt_shift_e[$arr] = $shift_e[$arr]; } else { $dt_shift_e[$arr] = ""; }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                if (isset($soft_awal[$arr])) { $dt_soft_awal[$arr] = $soft_awal[$arr]; } else { $dt_soft_awal[$arr] = ""; }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                if (isset($soft_akhir[$arr])) { $dt_soft_akhir[$arr] = $soft_akhir[$arr]; } else { $dt_soft_akhir[$arr] = ""; }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                if (isset($soft_total[$arr])) { $dt_soft_total[$arr] = $soft_total[$arr]; } else { $dt_soft_total[$arr] = ""; }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                if (isset($pro_awal[$arr])) { $dt_pro_awal[$arr] = $pro_awal[$arr]; } else { $dt_pro_awal[$arr] = ""; }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                if (isset($pro_akhir[$arr])) { $dt_pro_akhir[$arr] = $pro_akhir[$arr]; } else { $dt_pro_akhir[$arr] = ""; }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                if (isset($pro_total[$arr])) { $dt_pro_total[$arr] = $pro_total[$arr]; } else { $dt_pro_total[$arr] = ""; }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          

                    $objPHPExcel->mergeCells('A' .  $dtl_row3 . ':B' .  $dtl_row3)->setCellValue('A' .  $dtl_row3, $dt_shift_e[$arr]);
                    $objPHPExcel->mergeCells('C' .  $dtl_row3 . ':D' .  $dtl_row3)->setCellValue('C' .  $dtl_row3, $dt_soft_awal[$arr]);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                    $objPHPExcel->mergeCells('E' .  $dtl_row3 . ':E' .  $dtl_row3)->setCellValue('E' .  $dtl_row3, $dt_soft_akhir[$arr]);
                    $objPHPExcel->mergeCells('F' .  $dtl_row3 . ':I' .  $dtl_row3)->setCellValue('F' .  $dtl_row3, $dt_soft_total[$arr]);
                    $objPHPExcel->mergeCells('J' .  $dtl_row3 . ':M' .  $dtl_row3)->setCellValue('J' .  $dtl_row3, $dt_pro_awal[$arr]);
                    $objPHPExcel->mergeCells('N' .  $dtl_row3 . ':P' .  $dtl_row3)->setCellValue('N' .  $dtl_row3, $dt_pro_akhir[$arr]);
                    $objPHPExcel->mergeCells('Q' .  $dtl_row3 . ':S' .  $dtl_row3)->setCellValue('Q' .  $dtl_row3, $dt_pro_total[$arr]);
                
                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $dtl_row3 . ':S' . $dtl_row3);
                $dtl_row3++;
            }

            $table2_2 = $dtl_row3 + 4;

            $objPHPExcel->mergeCells('A' .  ($table2_2) . ':B' .  ($table2_2 + 1))->setCellValue('A' .  ($table2_2), "PROSES \n PRODUKSI");
            $objPHPExcel->mergeCells('C' .  ($table2_2) . ':D' .  ($table2_2 + 1))->setCellValue('C' .  ($table2_2), "NO POMPA \n FEED");
            $objPHPExcel->mergeCells('E' .  ($table2_2) . ':K' .  ($table2_2 + 1))->setCellValue('E' .  ($table2_2), 'SOFTENER (FEED WATER)');
            $objPHPExcel->mergeCells('L' .  ($table2_2) . ':T' .  ($table2_2 + 1))->setCellValue('L' .  ($table2_2), 'PERMEATE ( PRODUCT )');
            $objPHPExcel->mergeCells('U' .  ($table2_2) . ':AC' .  ($table2_2 + 1))->setCellValue('U' .  ($table2_2), 'CONSENTRATE ( REJECT)');
            $objPHPExcel->mergeCells('A' .  ($table2_2 + 2) . ':B' .  ($table2_2 + 2))->setCellValue('A' .  ($table2_2 + 2), 'SHIFT');
            $objPHPExcel->mergeCells('E' .  ($table2_2 + 2) . ':F' .  ($table2_2 + 2))->setCellValue('E' .  ($table2_2 + 2), 'Awal');
            $objPHPExcel->mergeCells('G' .  ($table2_2 + 2) . ':I' .  ($table2_2 + 2))->setCellValue('G' .  ($table2_2 + 2), 'Akhir');
            $objPHPExcel->mergeCells('J' .  ($table2_2 + 2) . ':K' .  ($table2_2 + 2))->setCellValue('J' .  ($table2_2 + 2), 'Total (m3)');
            $objPHPExcel->mergeCells('L' .  ($table2_2 + 2) . ':N' .  ($table2_2 + 2))->setCellValue('L' .  ($table2_2 + 2), 'Flow (m3)');
            $objPHPExcel->mergeCells('O' .  ($table2_2 + 2) . ':Q' .  ($table2_2 + 2))->setCellValue('O' .  ($table2_2 + 2), 'Waktu ( jam )');
            $objPHPExcel->mergeCells('R' .  ($table2_2 + 2) . ':T' .  ($table2_2 + 2))->setCellValue('R' .  ($table2_2 + 2), 'Total (m3)');
            $objPHPExcel->mergeCells('U' .  ($table2_2 + 2) . ':W' .  ($table2_2 + 2))->setCellValue('U' .  ($table2_2 + 2), 'Flow (m3)');
            $objPHPExcel->mergeCells('X' .  ($table2_2 + 2) . ':Z' .  ($table2_2 + 2))->setCellValue('X' .  ($table2_2 + 2), 'Waktu ( jam )');
            $objPHPExcel->mergeCells('AA' .  ($table2_2 + 2) . ':AC' .  ($table2_2 + 2))->setCellValue('AA' .  ($table2_2 + 2), 'Total (m3)');

            $objPHPExcel->mergeCells('A' .  ($table2_2 + 6) . ':B' .  ($table2_2 + 6))->setCellValue('A' .  ($table2_2 + 6), 'TOTAL');
            $objPHPExcel->mergeCells('J' .  ($table2_2 + 6) . ':K' .  ($table2_2 + 6))->setCellValue('J' .  ($table2_2 + 6), $total_feed);
            $objPHPExcel->mergeCells('R' .  ($table2_2 + 6) . ':T' .  ($table2_2 + 6))->setCellValue('R' .  ($table2_2 + 6), $total_product);
            $objPHPExcel->mergeCells('AA' .  ($table2_2 + 6) . ':AC' .  ($table2_2 + 6))->setCellValue('AA' .  ($table2_2 + 6), $total_reject);
            $objPHPExcel->mergeCells('C' .  ($table2_2 + 6) . ':I' .  ($table2_2 + 6))->setCellValue('C' .  ($table2_2 + 6), '');
            $objPHPExcel->mergeCells('L' .  ($table2_2 + 6) . ':Q' .  ($table2_2 + 6))->setCellValue('L' .  ($table2_2 + 6), '');
            $objPHPExcel->mergeCells('U' .  ($table2_2 + 6) . ':Z' .  ($table2_2 + 6))->setCellValue('U' .  ($table2_2 + 6), '');
            
            $objPHPExcel->setSharedStyle($noborderStyle,  'A' .  ($table2_2 - 1) . ':AN' .  ($table2_2 + 10));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($table2_2 - 1) . ':A' .  ($table2_2 + 10));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AN' . ($table2_2 - 1) . ':AN' . ($table2_2 + 10));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($table2_2 + 6) . ':AC' . ($table2_2 + 6));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($table2_2) . ':AC' . ($table2_2 + 2));

            $dtl_row3_2 = $table2_2 + 3;
            for ($arr = $start_detail_f; $arr <= $finish_detail_f; $arr++) {

                if (isset($shift_f[$arr])) { $dt_shift_f[$arr] = $shift_f[$arr]; } else { $dt_shift_f[$arr] = ""; }        
                if (isset($no_pompa[$arr])) { $dt_no_pompa[$arr] = $no_pompa[$arr]; } else { $dt_no_pompa[$arr] = ""; }        
                if (isset($feed_awal[$arr])) { $dt_feed_awal[$arr] = $feed_awal[$arr]; } else { $dt_feed_awal[$arr] = ""; }        
                if (isset($feed_akhir[$arr])) { $dt_feed_akhir[$arr] = $feed_akhir[$arr]; } else { $dt_feed_akhir[$arr] = ""; }        
                if (isset($feed_total[$arr])) { $dt_feed_total[$arr] = $feed_total[$arr]; } else { $dt_feed_total[$arr] = ""; }        
                if (isset($product_flow[$arr])) { $dt_product_flow[$arr] = $product_flow[$arr]; } else { $dt_product_flow[$arr] = ""; }        
                if (isset($product_waktu[$arr])) { $dt_product_waktu[$arr] = $product_waktu[$arr]; } else { $dt_product_waktu[$arr] = ""; }        
                if (isset($product_total[$arr])) { $dt_product_total[$arr] = $product_total[$arr]; } else { $dt_product_total[$arr] = ""; }        
                if (isset($reject_flow[$arr])) { $dt_reject_flow[$arr] = $reject_flow[$arr]; } else { $dt_reject_flow[$arr] = ""; }   
                if (isset($reject_waktu[$arr])) { $dt_reject_waktu[$arr] = $reject_waktu[$arr]; } else { $dt_reject_waktu[$arr] = ""; }   
                if (isset($reject_total[$arr])) { $dt_reject_total[$arr] = $reject_total[$arr]; } else { $dt_reject_total[$arr] = ""; }   
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        

                    $objPHPExcel->mergeCells('A' .  $dtl_row3_2 . ':B' .  $dtl_row3_2)->setCellValue('A' .  $dtl_row3_2, $dt_shift_f[$arr]);
                    $objPHPExcel->mergeCells('C' .  $dtl_row3_2 . ':D' .  $dtl_row3_2)->setCellValue('C' .  $dtl_row3_2, $dt_no_pompa[$arr]);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                    $objPHPExcel->mergeCells('E' .  $dtl_row3_2 . ':F' .  $dtl_row3_2)->setCellValue('E' .  $dtl_row3_2, $dt_feed_awal[$arr]);
                    $objPHPExcel->mergeCells('G' .  $dtl_row3_2 . ':I' .  $dtl_row3_2)->setCellValue('G' .  $dtl_row3_2, $dt_feed_akhir[$arr]);
                    $objPHPExcel->mergeCells('J' .  $dtl_row3_2 . ':K' .  $dtl_row3_2)->setCellValue('J' .  $dtl_row3_2, $dt_feed_total[$arr]);
                    $objPHPExcel->mergeCells('L' .  $dtl_row3_2 . ':N' .  $dtl_row3_2)->setCellValue('L' .  $dtl_row3_2, $dt_product_flow[$arr]);
                    $objPHPExcel->mergeCells('O' .  $dtl_row3_2 . ':Q' .  $dtl_row3_2)->setCellValue('O' .  $dtl_row3_2, $dt_product_waktu[$arr]);
                    $objPHPExcel->mergeCells('R' .  $dtl_row3_2 . ':T' .  $dtl_row3_2)->setCellValue('R' .  $dtl_row3_2, $dt_product_total[$arr]);
                    $objPHPExcel->mergeCells('U' .  $dtl_row3_2 . ':W' .  $dtl_row3_2)->setCellValue('U' .  $dtl_row3_2, $dt_reject_flow[$arr]);
                    $objPHPExcel->mergeCells('X' .  $dtl_row3_2 . ':Z' .  $dtl_row3_2)->setCellValue('X' .  $dtl_row3_2, $dt_reject_waktu[$arr]);
                    $objPHPExcel->mergeCells('AA' .  $dtl_row3_2 . ':AC' .  $dtl_row3_2)->setCellValue('AA' .  $dtl_row3_2, $dt_reject_total[$arr]);
                
                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $dtl_row3_2 . ':AC' . $dtl_row3_2);
                $dtl_row3_2++;
            }


            $start_row3 = $dtl_row3_2 + 4;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':R' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':R' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('S' . ($start_row3 + 1) . ':AN' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('S' . ($start_row3 + 1) . ':AN' . ($start_row3 + 1))->setCellValue('S' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':R' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'S' . ($start_row3 + 1) . ':AN' . ($start_row3 + 1));
            $objPHPExcel->setBreak('A' . ($start_row3 + 1),  PHPExcel_Worksheet::BREAK_ROW);


            // =======================================PAGE 2============================================== //

            $start_row_ke2 = $start_row3 + 3;

            $gbr_2 = '$objDrawing' . $i1;
            $gbr_2 = new PHPExcel_Worksheet_Drawing();
            $gbr_2->setPath('assets/images/PSG_logo_2022.png');
            $gbr_2->setWidthAndHeight(45, 45);
            $gbr_2->setWorksheet($objPHPExcel);
            $gbr_2->setCoordinates('A' . $start_row_ke2)->setOffsetX(42);


            $objPHPExcel->mergeCells('A' .   $start_row_ke2 . ':B' . ($start_row_ke2 + 1));
            $objPHPExcel->mergeCells('C' .   $start_row_ke2 . ':AI' . ($start_row_ke2 +1))->setCellValue('C' . $start_row_ke2,  $this->frmcop);
            $objPHPExcel->mergeCells('AJ' .  $start_row_ke2 . ':AJ' . $start_row_ke2)->setCellValue('AJ' . $start_row_ke2, 'Doc');
            $objPHPExcel->mergeCells('AK' .  $start_row_ke2 . ':AN' . $start_row_ke2)->setCellValue('AK' . $start_row_ke2, ': ' . $docno);

            $objPHPExcel->mergeCells('AJ' . ($start_row_ke2 + 1) . ':AJ' . ($start_row_ke2 + 1))->setCellValue('AJ' . ($start_row_ke2 + 1), 'Date');
            $objPHPExcel->mergeCells('AK' . ($start_row_ke2 + 1) . ':AN' . ($start_row_ke2 + 1))->setCellValue('AK' . ($start_row_ke2 + 1), ': ' . $dtcreate_date);

            $objPHPExcel->mergeCells('A' .  ($start_row_ke2 + 2) . ':B' .  ($start_row_ke2 + 2))->setCellValue('A' .  ($start_row_ke2 + 2), 'JUDUL');
            $objPHPExcel->mergeCells('C' .  ($start_row_ke2 + 2) . ':AI' . ($start_row_ke2 + 2))->setCellValue('C' .  ($start_row_ke2 + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AJ' . ($start_row_ke2 + 2) . ':AJ' . ($start_row_ke2 + 2))->setCellValue('AJ' . ($start_row_ke2 + 2), 'Page');
            $objPHPExcel->mergeCells('AK' . ($start_row_ke2 + 2) . ':AN' . ($start_row_ke2 + 2))->setCellValue('AK' . ($start_row_ke2 + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row_ke2 .      ':B' .  ($start_row_ke2 + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row_ke2 + 3) . ':AN' . ($start_row_ke2 + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row_ke2 + 4) . ':AN' . ($start_row_ke2 + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row_ke2)     . ':AI' . ($start_row_ke2 + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AJ' . ($start_row_ke2) . ':AN' . ($start_row_ke2 + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AK' .  $start_row_ke2  . ':AN' . ($start_row_ke2 + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AJ' . ($start_row_ke2 + 2) . ':AN' . ($start_row_ke2 + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AK' . ($start_row_ke2 + 2) . ':AN' . ($start_row_ke2 + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'C' . ($start_row_ke2) . ':AI' . ($start_row_ke2 + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row_ke2) . ':B' . ($start_row_ke2 + 2));
            $objPHPExcel->getStyle('AJ' . ($start_row_ke2) . ':AN' . ($start_row_ke2))->getFont()->setSize(10);

            $objPHPExcel->mergeCells('A' .  ($start_row_ke2 + 4) . ':B' .  ($start_row_ke2 + 6))->setCellValue('A' .  ($start_row_ke2 + 4), 'WAKTU');
            $objPHPExcel->mergeCells('C' .  ($start_row_ke2 + 4) . ':C' .  ($start_row_ke2 + 6))->setCellValue('C' .  ($start_row_ke2 + 4), "START \n STOP");
            $objPHPExcel->mergeCells('D' .  ($start_row_ke2 + 4) . ':O' .  ($start_row_ke2 + 4))->setCellValue('D' .  ($start_row_ke2 + 4), 'FEED WATER ( SOFTENER )');
            $objPHPExcel->mergeCells('D' .  ($start_row_ke2 + 5) . ':E' .  ($start_row_ke2 + 5))->setCellValue('D' .  ($start_row_ke2 + 5), 'pH');
            $objPHPExcel->mergeCells('D' .  ($start_row_ke2 + 6) . ':E' .  ($start_row_ke2 + 6))->setCellValue('D' .  ($start_row_ke2 + 6), '6,5 - 8,5');
            $objPHPExcel->mergeCells('F' .  ($start_row_ke2 + 5) . ':G' .  ($start_row_ke2 + 5))->setCellValue('F' .  ($start_row_ke2 + 5), 'Konduktivity');
            $objPHPExcel->mergeCells('F' .  ($start_row_ke2 + 6) . ':G' .  ($start_row_ke2 + 6))->setCellValue('F' .  ($start_row_ke2 + 6), 'µs/cm');
            $objPHPExcel->mergeCells('H' .  ($start_row_ke2 + 5) . ':I' .  ($start_row_ke2 + 5))->setCellValue('H' .  ($start_row_ke2 + 5), 'TH');
            $objPHPExcel->mergeCells('H' .  ($start_row_ke2 + 6) . ':I' .  ($start_row_ke2 + 6))->setCellValue('H' .  ($start_row_ke2 + 6), 'µmol/L');
            $objPHPExcel->mergeCells('J' .  ($start_row_ke2 + 5) . ':K' .  ($start_row_ke2 + 5))->setCellValue('J' .  ($start_row_ke2 + 5), 'Turbidity');
            $objPHPExcel->mergeCells('J' .  ($start_row_ke2 + 6) . ':K' .  ($start_row_ke2 + 6))->setCellValue('J' .  ($start_row_ke2 + 6), 'NTU');
            $objPHPExcel->mergeCells('L' .  ($start_row_ke2 + 5) . ':M' .  ($start_row_ke2 + 5))->setCellValue('L' .  ($start_row_ke2 + 5), 'Cl-');
            $objPHPExcel->mergeCells('L' .  ($start_row_ke2 + 6) . ':M' .  ($start_row_ke2 + 6))->setCellValue('L' .  ($start_row_ke2 + 6), 'ppm');
            $objPHPExcel->mergeCells('N' .  ($start_row_ke2 + 5) . ':O' .  ($start_row_ke2 + 5))->setCellValue('N' .  ($start_row_ke2 + 5), 'FCl');
            $objPHPExcel->mergeCells('N' .  ($start_row_ke2 + 6) . ':O' .  ($start_row_ke2 + 6))->setCellValue('N' .  ($start_row_ke2 + 6), 'ppm');
            $objPHPExcel->mergeCells('P' .  ($start_row_ke2 + 4) . ':U' .  ($start_row_ke2 + 4))->setCellValue('P' .  ($start_row_ke2 + 4), 'PERMEATE ( PRODUCT )');
            $objPHPExcel->mergeCells('P' .  ($start_row_ke2 + 5) . ':R' .  ($start_row_ke2 + 5))->setCellValue('P' .  ($start_row_ke2 + 5), 'pH');
            $objPHPExcel->mergeCells('P' .  ($start_row_ke2 + 6) . ':R' .  ($start_row_ke2 + 6))->setCellValue('P' .  ($start_row_ke2 + 6), '6,5 - 8,5');
            $objPHPExcel->mergeCells('S' .  ($start_row_ke2 + 5) . ':U' .  ($start_row_ke2 + 5))->setCellValue('S' .  ($start_row_ke2 + 5), 'Konduktivity (µs/cm)');
            $objPHPExcel->mergeCells('S' .  ($start_row_ke2 + 6) . ':U' .  ($start_row_ke2 + 6))->setCellValue('S' .  ($start_row_ke2 + 6), ' <40  ');

            $objPHPExcel->mergeCells('X' .  ($start_row_ke2 + 6) . ':Z' .  ($start_row_ke2 + 6))->setCellValue('X' .  ($start_row_ke2 + 6), 'Keterangan :');
            $objPHPExcel->mergeCells('Y' .  ($start_row_ke2 + 7) . ':AL' .  ($start_row_ke2 + 7))->setCellValue('Y' .  ($start_row_ke2 + 7), $keterangan_hdr);
            
            $objPHPExcel->setSharedStyle($noborderStyle,  'A' .  ($start_row_ke2 + 3) . ':AN' .  ($start_row_ke2 + 30));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row_ke2 + 3) . ':A' .  ($start_row_ke2 + 15));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AN' . ($start_row_ke2 + 3) . ':AN' . ($start_row_ke2 + 15));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row_ke2 + 4) . ':U' . ($start_row_ke2 + 6));
            // $objPHPExcel->getStyle('C' . ($start_row_ke2 + 4) . ':AL' . ($start_row_ke2 + 5))->getFont()->setBold(true)->setSize(9);

            $dtl_row_ke2 = $start_row_ke2 + 7;
            for ($arr = $start_detail_g; $arr <= $finish_detail_g; $arr++) {

                if (isset($jam_waktu[$arr])) { $dt_jam_waktu[$arr] = $jam_waktu[$arr]; } else { $dt_jam_waktu[$arr] = ""; }
                if (isset($start_stop[$arr])) { $dt_start_stop[$arr] = $start_stop[$arr]; } else { $dt_start_stop[$arr] = ""; }
                if (isset($feed_ph[$arr])) { $dt_feed_ph[$arr] = $feed_ph[$arr]; } else { $dt_feed_ph[$arr] = ""; }
                if (isset($feed_konduktivity[$arr])) { $dt_feed_konduktivity[$arr] = $feed_konduktivity[$arr]; } else { $dt_feed_konduktivity[$arr] = ""; }
                if (isset($feed_th[$arr])) { $dt_feed_th[$arr] = $feed_th[$arr]; } else { $dt_feed_th[$arr] = ""; }
                if (isset($feed_turbidity[$arr])) { $dt_feed_turbidity[$arr] = $feed_turbidity[$arr]; } else { $dt_feed_turbidity[$arr] = ""; }
                if (isset($feed_cl[$arr])) { $dt_feed_cl[$arr] = $feed_cl[$arr]; } else { $dt_feed_cl[$arr] = ""; }
                if (isset($feed_fcl[$arr])) { $dt_feed_fcl[$arr] = $feed_fcl[$arr]; } else { $dt_feed_fcl[$arr] = ""; }
                if (isset($product_ph[$arr])) { $dt_product_ph[$arr] = $product_ph[$arr]; } else { $dt_product_ph[$arr] = ""; }
                if (isset($product_konduktivity[$arr])) { $dt_product_konduktivity[$arr] = $product_konduktivity[$arr]; } else { $dt_product_konduktivity[$arr] = ""; }

                    $objPHPExcel->mergeCells('A' .  $dtl_row_ke2 . ':B' .  $dtl_row_ke2)->setCellValue('A' .  $dtl_row_ke2, $dt_jam_waktu[$arr]);
                    $objPHPExcel->mergeCells('C' .  $dtl_row_ke2 . ':C' .  $dtl_row_ke2)->setCellValue('C' .  $dtl_row_ke2, $dt_start_stop[$arr]);
                    $objPHPExcel->mergeCells('D' .  $dtl_row_ke2 . ':E' .  $dtl_row_ke2)->setCellValue('D' .  $dtl_row_ke2, $dt_feed_ph[$arr]);
                    $objPHPExcel->mergeCells('F' .  $dtl_row_ke2 . ':G' .  $dtl_row_ke2)->setCellValue('F' .  $dtl_row_ke2, $dt_feed_konduktivity[$arr]);
                    $objPHPExcel->mergeCells('H' .  $dtl_row_ke2 . ':I' .  $dtl_row_ke2)->setCellValue('H' .  $dtl_row_ke2, $dt_feed_th[$arr]);
                    $objPHPExcel->mergeCells('J' .  $dtl_row_ke2 . ':K' .  $dtl_row_ke2)->setCellValue('J' .  $dtl_row_ke2, $dt_feed_turbidity[$arr]);
                    $objPHPExcel->mergeCells('L' .  $dtl_row_ke2 . ':M' .  $dtl_row_ke2)->setCellValue('L' .  $dtl_row_ke2, $dt_feed_cl[$arr]);
                    $objPHPExcel->mergeCells('N' .  $dtl_row_ke2 . ':O' .  $dtl_row_ke2)->setCellValue('N' .  $dtl_row_ke2, $dt_feed_fcl[$arr]);
                    $objPHPExcel->mergeCells('P' .  $dtl_row_ke2 . ':R' .  $dtl_row_ke2)->setCellValue('P' .  $dtl_row_ke2, $dt_product_ph[$arr]);
                    $objPHPExcel->mergeCells('S' .  $dtl_row_ke2 . ':U' .  $dtl_row_ke2)->setCellValue('S' .  $dtl_row_ke2, $dt_product_konduktivity[$arr]);

                $objPHPExcel->setSharedStyle($noborderStyle, 'A' . $dtl_row_ke2 . ':AN' . ($dtl_row_ke2 + 1));
                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $dtl_row_ke2 . ':U' . $dtl_row_ke2);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'AN' . $dtl_row_ke2 . ':AN' . ($dtl_row_ke2 + 1));
                $dtl_row_ke2++;
            }
            // $objPHPExcel->mergeCells('B' .  ($dtl_row_ke2 + 1) . ':C' .  ($dtl_row_ke2 + 1))->setCellValue('B' .  ($dtl_row_ke2 + 1), 'Keterangan :');
            // $objPHPExcel->mergeCells('B' .  ($dtl_row_ke2 + 2) . ':C' .  ($dtl_row_ke2 + 2))->setCellValue('B' .  ($dtl_row_ke2 + 2), 'Dianalisa Sekali Perhari');
            // $objPHPExcel->mergeCells('B' .  ($dtl_row_ke2 + 3) . ':C' .  ($dtl_row_ke2 + 3))->setCellValue('B' .  ($dtl_row_ke2 + 3), 'Dianalisa Persatu Minggu');

            $start_row3_ke2 = $dtl_row_ke2;
            $objPHPExcel->mergeCells('A' . ($start_row3_ke2 + 1) . ':R' . ($start_row3_ke2 + 1))->setCellValue('A' . ($start_row3_ke2 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3_ke2 + 1) . ':R' . ($start_row3_ke2 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('S' . ($start_row3_ke2 + 1) . ':AN' . ($start_row3_ke2 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('S' . ($start_row3_ke2 + 1) . ':AN' . ($start_row3_ke2 + 1))->setCellValue('S' . ($start_row3_ke2 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3_ke2 + 1) . ':R' . ($start_row3_ke2 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'S' . ($start_row3_ke2 + 1) . ':AN' . ($start_row3_ke2 + 1));
            $objPHPExcel->setBreak('A' . ($start_row3_ke2 + 1),  PHPExcel_Worksheet::BREAK_ROW);


            // ======================================== PAGE 3 =============================================== //
            
            
            $start_row_ke3 = $start_row3_ke2 + 3;

            $gbr_2 = '$objDrawing' . $i1;
            $gbr_2 = new PHPExcel_Worksheet_Drawing();
            $gbr_2->setPath('assets/images/PSG_logo_2022.png');
            $gbr_2->setWidthAndHeight(45, 45);
            $gbr_2->setWorksheet($objPHPExcel);
            $gbr_2->setCoordinates('A' . $start_row_ke3)->setOffsetX(42);


            $objPHPExcel->mergeCells('A' .   $start_row_ke3 . ':B' . ($start_row_ke3 + 1));
            $objPHPExcel->mergeCells('C' .   $start_row_ke3 . ':AI' . ($start_row_ke3 +1))->setCellValue('C' . $start_row_ke3,  $this->frmcop);
            $objPHPExcel->mergeCells('AJ' .  $start_row_ke3 . ':AJ' . $start_row_ke3)->setCellValue('AJ' . $start_row_ke3, 'Doc');
            $objPHPExcel->mergeCells('AK' .  $start_row_ke3 . ':AN' . $start_row_ke3)->setCellValue('AK' . $start_row_ke3, ': ' . $docno);

            $objPHPExcel->mergeCells('AJ' . ($start_row_ke3 + 1) . ':AJ' . ($start_row_ke3 + 1))->setCellValue('AJ' . ($start_row_ke3 + 1), 'Date');
            $objPHPExcel->mergeCells('AK' . ($start_row_ke3 + 1) . ':AN' . ($start_row_ke3 + 1))->setCellValue('AK' . ($start_row_ke3 + 1), ': ' . $dtcreate_date);

            $objPHPExcel->mergeCells('A' .  ($start_row_ke3 + 2) . ':B' .  ($start_row_ke3 + 2))->setCellValue('A' .  ($start_row_ke3 + 2), 'JUDUL');
            $objPHPExcel->mergeCells('C' .  ($start_row_ke3 + 2) . ':AI' . ($start_row_ke3 + 2))->setCellValue('C' .  ($start_row_ke3 + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AJ' . ($start_row_ke3 + 2) . ':AJ' . ($start_row_ke3 + 2))->setCellValue('AJ' . ($start_row_ke3 + 2), 'Page');
            $objPHPExcel->mergeCells('AK' . ($start_row_ke3 + 2) . ':AN' . ($start_row_ke3 + 2))->setCellValue('AK' . ($start_row_ke3 + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row_ke3 .      ':B' .  ($start_row_ke3 + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row_ke3 + 3) . ':AN' . ($start_row_ke3 + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row_ke3 + 4) . ':AN' . ($start_row_ke3 + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row_ke3)     . ':AI' . ($start_row_ke3 + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AJ' . ($start_row_ke3) . ':AN' . ($start_row_ke3 + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AK' .  $start_row_ke3  . ':AN' . ($start_row_ke3 + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AJ' . ($start_row_ke3 + 2) . ':AN' . ($start_row_ke3 + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AK' . ($start_row_ke3 + 2) . ':AN' . ($start_row_ke3 + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'C' . ($start_row_ke3) . ':AI' . ($start_row_ke3 + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row_ke3) . ':B' . ($start_row_ke3 + 2));
            $objPHPExcel->getStyle('AJ' . ($start_row_ke3) . ':AN' . ($start_row_ke3))->getFont()->setSize(10);

            $objPHPExcel->mergeCells('A' .  ($start_row_ke3 + 4) . ':B' .  ($start_row_ke3 + 4))->setCellValue('A' .  ($start_row_ke3 + 4), 'WAKTU');
            $objPHPExcel->mergeCells('C' .  ($start_row_ke3 + 4) . ':D' .  ($start_row_ke3 + 4))->setCellValue('C' .  ($start_row_ke3 + 4), 'Pressure');
            $objPHPExcel->mergeCells('E' .  ($start_row_ke3 + 4) . ':F' .  ($start_row_ke3 + 4))->setCellValue('E' .  ($start_row_ke3 + 4), 'H-566 (pH 10-13)');
            $objPHPExcel->mergeCells('G' .  ($start_row_ke3 + 4) . ':H' .  ($start_row_ke3 + 4))->setCellValue('G' .  ($start_row_ke3 + 4), 'WAKTU');
            $objPHPExcel->mergeCells('I' .  ($start_row_ke3 + 4) . ':J' .  ($start_row_ke3 + 4))->setCellValue('I' .  ($start_row_ke3 + 4), 'Pressure');
            $objPHPExcel->mergeCells('K' .  ($start_row_ke3 + 4) . ':M' .  ($start_row_ke3 + 4))->setCellValue('K' .  ($start_row_ke3 + 4), 'pH bilas ≤ 10');
            $objPHPExcel->mergeCells('N' .  ($start_row_ke3 + 4) . ':P' .  ($start_row_ke3 + 4))->setCellValue('N' .  ($start_row_ke3 + 4), 'WAKTU');
            $objPHPExcel->mergeCells('Q' .  ($start_row_ke3 + 4) . ':R' .  ($start_row_ke3 + 4))->setCellValue('Q' .  ($start_row_ke3 + 4), 'Pressure');
            $objPHPExcel->mergeCells('S' .  ($start_row_ke3 + 4) . ':U' .  ($start_row_ke3 + 4))->setCellValue('S' .  ($start_row_ke3 + 4), 'H- 277 (pH 1-4 )');
            $objPHPExcel->mergeCells('V' .  ($start_row_ke3 + 4) . ':X' .  ($start_row_ke3 + 4))->setCellValue('V' .  ($start_row_ke3 + 4), 'WAKTU');
            $objPHPExcel->mergeCells('Y' .  ($start_row_ke3 + 4) . ':Z' .  ($start_row_ke3 + 4))->setCellValue('Y' .  ($start_row_ke3 + 4), 'Pressure');
            $objPHPExcel->mergeCells('AA' .  ($start_row_ke3 + 4) . ':AC' .  ($start_row_ke3 + 4))->setCellValue('AA' .  ($start_row_ke3 + 4), 'pH bilas (≥ 6,5)');
            
            $objPHPExcel->mergeCells('AD' .  ($start_row_ke3 + 4) . ':AF' .  ($start_row_ke3 + 4))->setCellValue('AD' .  ($start_row_ke3 + 4), 'FLOW AWAL');
            $objPHPExcel->mergeCells('AG' .  ($start_row_ke3 + 4) . ':AI' .  ($start_row_ke3 + 4))->setCellValue('AG' .  ($start_row_ke3 + 4), 'FLOW AKHIR');
            $objPHPExcel->mergeCells('AJ' .  ($start_row_ke3 + 4) . ':AL' .  ($start_row_ke3 + 4))->setCellValue('AJ' .  ($start_row_ke3 + 4), 'TOTAL');
            $objPHPExcel->mergeCells('AM' .  ($start_row_ke3 + 4) . ':AN' .  ($start_row_ke3 + 4))->setCellValue('AM' .  ($start_row_ke3 + 4), 'FORMULA');

            $objPHPExcel->setSharedStyle($noborderStyle,  'A' .  ($start_row_ke3 + 3) . ':AN' .  ($start_row_ke3 + 30));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row_ke3 + 3) . ':A' .  ($start_row_ke3 + 15));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AN' . ($start_row_ke3 + 3) . ':AN' . ($start_row_ke3 + 15));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row_ke3 + 4) . ':AC' . ($start_row_ke3 + 4));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AD' . ($start_row_ke3 + 4) . ':AN' . ($start_row_ke3 + 4));
            // $objPHPExcel->getStyle('C' . ($start_row_ke3 + 4) . ':AL' . ($start_row_ke3 + 5))->getFont()->setBold(true)->setSize(9);

            $dtl_row_ke3 = $start_row_ke3 + 5;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {

                if (isset($jam1[$arr])) { $dt_jam1[$arr] = $jam1[$arr]; } else { $dt_jam1[$arr] = ""; }
                if (isset($pressure_1[$arr])) { $dt_pressure_1[$arr] = $pressure_1[$arr]; } else { $dt_pressure_1[$arr] = ""; }
                if (isset($h566[$arr])) { $dt_h566[$arr] = $h566[$arr]; } else { $dt_h566[$arr] = ""; }
                if (isset($jam2[$arr])) { $dt_jam2[$arr] = $jam2[$arr]; } else { $dt_jam2[$arr] = ""; }
                if (isset($pressure2[$arr])) { $dt_pressure2[$arr] = $pressure2[$arr]; } else { $dt_pressure2[$arr] = ""; }
                if (isset($ph_bilas[$arr])) { $dt_ph_bilas[$arr] = $ph_bilas[$arr]; } else { $dt_ph_bilas[$arr] = ""; }
                if (isset($jam3[$arr])) { $dt_jam3[$arr] = $jam3[$arr]; } else { $dt_jam3[$arr] = ""; }
                if (isset($pressure3[$arr])) { $dt_pressure3[$arr] = $pressure3[$arr]; } else { $dt_pressure3[$arr] = ""; }
                if (isset($h277[$arr])) { $dt_h277[$arr] = $h277[$arr]; } else { $dt_h277[$arr] = ""; }
                if (isset($jam4[$arr])) { $dt_jam4[$arr] = $jam4[$arr]; } else { $dt_jam4[$arr] = ""; }
                if (isset($pressure4[$arr])) { $dt_pressure4[$arr] = $pressure4[$arr]; } else { $dt_pressure4[$arr] = ""; }
                if (isset($ph_bilas4[$arr])) { $dt_ph_bilas4[$arr] = $ph_bilas4[$arr]; } else { $dt_ph_bilas4[$arr] = ""; }

                    $objPHPExcel->mergeCells('A' .  $dtl_row_ke3 . ':B' .  $dtl_row_ke3)->setCellValue('A' .  $dtl_row_ke3, $dt_jam1[$arr]);
                    $objPHPExcel->mergeCells('C' .  $dtl_row_ke3 . ':D' .  $dtl_row_ke3)->setCellValue('C' .  $dtl_row_ke3, $dt_pressure_1[$arr]);
                    $objPHPExcel->mergeCells('E' .  $dtl_row_ke3 . ':F' .  $dtl_row_ke3)->setCellValue('E' .  $dtl_row_ke3, $dt_h566[$arr]);
                    $objPHPExcel->mergeCells('G' .  $dtl_row_ke3 . ':H' .  $dtl_row_ke3)->setCellValue('G' .  $dtl_row_ke3, $dt_jam2[$arr]);
                    $objPHPExcel->mergeCells('I' .  $dtl_row_ke3 . ':J' .  $dtl_row_ke3)->setCellValue('I' .  $dtl_row_ke3, $dt_pressure2[$arr]);
                    $objPHPExcel->mergeCells('K' .  $dtl_row_ke3 . ':M' .  $dtl_row_ke3)->setCellValue('K' .  $dtl_row_ke3, $dt_ph_bilas[$arr]);
                    $objPHPExcel->mergeCells('N' .  $dtl_row_ke3 . ':P' .  $dtl_row_ke3)->setCellValue('N' .  $dtl_row_ke3, $dt_jam3[$arr]);
                    $objPHPExcel->mergeCells('Q' .  $dtl_row_ke3 . ':R' .  $dtl_row_ke3)->setCellValue('Q' .  $dtl_row_ke3, $dt_pressure3[$arr]);
                    $objPHPExcel->mergeCells('S' .  $dtl_row_ke3 . ':U' .  $dtl_row_ke3)->setCellValue('S' .  $dtl_row_ke3, $dt_h277[$arr]);
                    $objPHPExcel->mergeCells('V' .  $dtl_row_ke3 . ':X' .  $dtl_row_ke3)->setCellValue('V' .  $dtl_row_ke3, $dt_jam4[$arr]);
                    $objPHPExcel->mergeCells('Y' .  $dtl_row_ke3 . ':Z' .  $dtl_row_ke3)->setCellValue('Y' .  $dtl_row_ke3, $dt_pressure4[$arr]);
                    $objPHPExcel->mergeCells('AA' .  $dtl_row_ke3 . ':AC' .  $dtl_row_ke3)->setCellValue('AA' .  $dtl_row_ke3, $dt_ph_bilas4[$arr]);
                
                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $dtl_row_ke3 . ':AC' . $dtl_row_ke3);
                $dtl_row_ke3++;
            }

            $dtl_row2_ke3 = $start_row_ke3 + 5;
            for ($arr = $start_detail_b; $arr <= $finish_detail_b; $arr++) {

                if (isset($flow_awal[$arr])) { $dtflow_awal[$arr] = $flow_awal[$arr]; } else { $dtflow_awal[$arr] = ""; }
                if (isset($flow_akhir[$arr])) { $dtflow_akhir[$arr] = $flow_akhir[$arr]; } else { $dtflow_akhir[$arr] = ""; }
                if (isset($total[$arr])) { $dttotal[$arr] = $total[$arr]; } else { $dttotal[$arr] = ""; }
                if (isset($formula[$arr])) { $dtformula[$arr] = $formula[$arr]; } else { $dtformula[$arr] = ""; }


                    $objPHPExcel->mergeCells('AD' .  $dtl_row2_ke3 . ':AF' .  $dtl_row2_ke3)->setCellValue('AD' .  $dtl_row2_ke3, $dtflow_awal[$arr]);
                    $objPHPExcel->mergeCells('AG' .  $dtl_row2_ke3 . ':AI' .  $dtl_row2_ke3)->setCellValue('AG' .  $dtl_row2_ke3, $dtflow_akhir[$arr]);
                    $objPHPExcel->mergeCells('AJ' .  $dtl_row2_ke3 . ':AL' .  $dtl_row2_ke3)->setCellValue('AJ' .  $dtl_row2_ke3, $dttotal[$arr]);
                    $objPHPExcel->mergeCells('AM' .  $dtl_row2_ke3 . ':AN' .  $dtl_row2_ke3)->setCellValue('AM' .  $dtl_row2_ke3, $dtformula[$arr]);
                
                $objPHPExcel->setSharedStyle($bodyStyle, 'AD' . $dtl_row2_ke3 . ':AN' . $dtl_row2_ke3);
                $dtl_row2_ke3++;
            }

            $table2_ke3 = $dtl_row_ke3 + 1;

            $objPHPExcel->mergeCells('A' .  ($table2_ke3 + 1) . ':B' .  ($table2_ke3 + 1))->setCellValue('A' .  ($table2_ke3 + 1), 'JAM');
            $objPHPExcel->mergeCells('C' .  ($table2_ke3 + 1) . ':J' .  ($table2_ke3 + 1))->setCellValue('C' .  ($table2_ke3 + 1), 'URAIAN KETIDAKSESUAIAN');
            $objPHPExcel->mergeCells('K' .  ($table2_ke3 + 1) . ':T' .  ($table2_ke3 + 1))->setCellValue('K' .  ($table2_ke3 + 1), 'TINDAKAN PERBAIKAN');
            $objPHPExcel->mergeCells('U' .  ($table2_ke3 + 1) . ':Y' .  ($table2_ke3 + 1))->setCellValue('U' .  ($table2_ke3 + 1), 'NAMA');
            $objPHPExcel->mergeCells('Z' .  ($table2_ke3 + 1) . ':AB' .  ($table2_ke3 + 1))->setCellValue('Z' .  ($table2_ke3 + 1), 'PARAF');
            $objPHPExcel->mergeCells('AC' .  ($table2_ke3 + 1) . ':AN' .  ($table2_ke3 + 1))->setCellValue('AC' .  ($table2_ke3 + 1), 'KETERANGAN');
            
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($table2_ke3) . ':A' .  ($table2_ke3 + 2));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AN' . ($table2_ke3) . ':AN' . ($table2_ke3 + 2));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($table2_ke3 + 1) . ':AN' . ($table2_ke3 + 1));

            $dtl_row3_ke3 = $table2_ke3 + 2;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {

                if (isset($jam[$arr])) { $dt_jam[$arr] = $jam[$arr]; } else { $dt_jam[$arr] = ""; }
                if (isset($uraian[$arr])) { $dt_uraian[$arr] = $uraian[$arr]; } else { $dt_uraian[$arr] = ""; }
                if (isset($tindakan[$arr])) { $dt_tindakan[$arr] = $tindakan[$arr]; } else { $dt_tindakan[$arr] = ""; }
                if (isset($nama[$arr])) { $dt_nama[$arr] = $nama[$arr]; } else { $dt_nama[$arr] = ""; }
                if (isset($paraf[$arr])) { $dt_paraf[$arr] = $paraf[$arr]; } else { $dt_paraf[$arr] = ""; }
                if (isset($pj_personalstatus[$arr])) { $dt_pj_personalstatus[$arr] = $pj_personalstatus[$arr]; } else { $dt_pj_personalstatus[$arr] = ""; }
                if (isset($pj_personalid[$arr])) { $dt_pj_personalid[$arr] = $pj_personalid[$arr]; } else { $dt_pj_personalid[$arr] = ""; }
                if (isset($keterangan[$arr])) { $dt_keterangan[$arr] = $keterangan[$arr]; } else { $dt_keterangan[$arr] = ""; }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              

                    $objPHPExcel->mergeCells('A' .  $dtl_row3_ke3 . ':B' .  $dtl_row3_ke3)->setCellValue('A' .  $dtl_row3_ke3, $dt_jam[$arr]);
                    $objPHPExcel->mergeCells('C' .  $dtl_row3_ke3 . ':J' .  $dtl_row3_ke3)->setCellValue('C' .  $dtl_row3_ke3, $dt_uraian[$arr]);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                    $objPHPExcel->mergeCells('K' .  $dtl_row3_ke3 . ':T' .  $dtl_row3_ke3)->setCellValue('K' .  $dtl_row3_ke3, $dt_tindakan[$arr]);
                    $objPHPExcel->mergeCells('U' .  $dtl_row3_ke3 . ':Y' .  $dtl_row3_ke3)->setCellValue('U' .  $dtl_row3_ke3, $dt_nama[$arr]);
                    $objPHPExcel->mergeCells('Z' .  $dtl_row3_ke3 . ':AB' .  $dtl_row3_ke3)->setCellValue('Z' .  $dtl_row3_ke3, '');
                    $objPHPExcel->mergeCells('AC' .  $dtl_row3_ke3 . ':AN' .  $dtl_row3_ke3)->setCellValue('AC' .  $dtl_row3_ke3, $dt_keterangan[$arr]);

                    if ($dt_pj_personalstatus[$arr] == '2') {
                        $pj_imageurl = '/forviewfoto_pekerja/TTD_TK/';
                        $pj_imageformat = '.png';
                    } else if ($dt_pj_personalstatus[$arr] == '1') {
                        $pj_imageurl = '/forviewfoto_pekerja/';
                        $pj_imageformat = '_0_0.png';
                    } else {
                        $pj_imageurl = '';
                        $pj_imageformat = '';
                    }
    
                    $fcpath2   = str_replace('utl/', '', FCPATH);
                    $sign_img_pj  = '$objDrawing' . $i1;
                    if (file_exists($fcpath2 . 'utl/assets/ttd/' . $dt_pj_personalstatus[$arr] . '_' . $dt_pj_personalid[$arr] . '.png')) {
                        $objPHPExcel->getRowDimension($dtl_row3_ke3)->setRowHeight(50);
                        $sign_img = new PHPExcel_Worksheet_Drawing();
                        $sign_img->setPath('assets/ttd/' . $dt_pj_personalstatus[$arr] . '_' . $dt_pj_personalid[$arr] . '.png');
                        $sign_img->setWidthAndHeight(80, 80);
                        $sign_img->setResizeProportional(true);
                        $sign_img->setWorksheet($objPHPExcel);
                        $sign_img->setCoordinates('AA' . ($dtl_row3_ke3))->setOffsetY(2)->setOffsetX(-10);
                    } else {
                        if ($dt_pj_personalid[$arr] != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $pj_imageurl . $dt_pj_personalid[$arr] . $pj_imageformat)) {
                            $objPHPExcel->getRowDimension($dtl_row3_ke3)->setRowHeight(50);
                            $sign_img_pj = new PHPExcel_Worksheet_Drawing();
                            $sign_img_pj->setPath($_SERVER['DOCUMENT_ROOT'] . $pj_imageurl . $dt_pj_personalid[$arr] . $pj_imageformat);
                            $sign_img_pj->setWidthAndHeight(80, 80);
                            $sign_img_pj->setResizeProportional(true);
                            $sign_img_pj->setWorksheet($objPHPExcel);
                            $sign_img_pj->setCoordinates('AA' . ($dtl_row3_ke3))->setOffsetY(3)->setOffsetX(-10);
                        }
                    }
                
                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $dtl_row3_ke3 . ':AN' . $dtl_row3_ke3);
                $dtl_row3_ke3++;
            }

            $app_row_ke3 = $dtl_row3_ke3 + 2;

            $objPHPExcel->mergeCells('C' . ($app_row_ke3) . ':H' .  ($app_row_ke3 + 1))->setCellValue('C' .  ($app_row_ke3), 'SHIFT PAGI');
            $objPHPExcel->mergeCells('I' . ($app_row_ke3) . ':N' . ($app_row_ke3 + 1))->setCellValue('I' .  ($app_row_ke3), 'SHIFT SORE');
            $objPHPExcel->mergeCells('O' . ($app_row_ke3) . ':T' . ($app_row_ke3 + 1))->setCellValue('O' . ($app_row_ke3), 'SHIFT MALAM');
            $objPHPExcel->mergeCells('U' . ($app_row_ke3) . ':Z' . ($app_row_ke3 + 1))->setCellValue('U' . ($app_row_ke3), 'DIKETAHUI');
            $objPHPExcel->mergeCells('AA' . ($app_row_ke3) . ':AF' . ($app_row_ke3 + 1))->setCellValue('AA' . ($app_row_ke3), 'DISETUJUI');

            $objPHPExcel->mergeCells('C' . ($app_row_ke3 + 2) . ':H' .  ($app_row_ke3 + 6))->setCellValue('C' . ($app_row_ke3 + 2), '');
            $objPHPExcel->mergeCells('I' . ($app_row_ke3 + 2) . ':N' . ($app_row_ke3 + 6))->setCellValue('I' . ($app_row_ke3 + 2), '');
            $objPHPExcel->mergeCells('O' . ($app_row_ke3 + 2) . ':T' . ($app_row_ke3 + 6))->setCellValue('O' . ($app_row_ke3 + 2), '');
            $objPHPExcel->mergeCells('U' . ($app_row_ke3 + 2) . ':Z' . ($app_row_ke3 + 6))->setCellValue('U' . ($app_row_ke3 + 2), '');
            $objPHPExcel->mergeCells('AA' . ($app_row_ke3 + 2) . ':AF' . ($app_row_ke3 + 6))->setCellValue('AA' . ($app_row_ke3 + 2), '');

            // $objPHPExcel->getStyle('C' . ($app_row_ke3) .     ':L'. ($app_row_ke3))->getFont()->setSize(10);
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($app_row_ke3 - 1) . ':AN' . ($app_row_ke3 + 6));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'C' . ($app_row_ke3) . ':AF' . ($app_row_ke3 + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AN' . ($app_row_ke3 - 2) . ':AN' . ($app_row_ke3 + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row_ke3 - 2) . ':A' . ($app_row_ke3 + 6));


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
                    $sign_img->setCoordinates('D' . ($app_row_ke3 + 3));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('D' . ($app_row_ke3 + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('D' . ($app_row_ke3 + 2));
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
                    $sign_img2->setCoordinates('J' . ($app_row_ke3 + 3));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('J' . ($app_row_ke3 + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('J' . ($app_row_ke3 + 2));
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
                    $sign_img3->setCoordinates('P' . ($app_row_ke3 + 3));
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('P' . ($app_row_ke3 + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('P' . ($app_row_ke3 + 2));
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
                    $sign_img4 = new PHPExcel_Worksheet_Drawing();
                    $sign_img4->setPath('assets/ttd/' . $app4_personalstatus . '_' . $app4_personalid . '.png');
                    $sign_img4->setWidthAndHeight(135, 135);
                    $sign_img4->setResizeProportional(true);
                    $sign_img4->setWorksheet($objPHPExcel);
                    $sign_img4->setCoordinates('W' . ($app_row_ke3 + 3));
                } else if ($app4_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4)) {
                    $sign_img4 = new PHPExcel_Worksheet_Drawing();
                    $sign_img4->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4);
                    $sign_img4->setWidthAndHeight(135, 135);
                    $sign_img4->setResizeProportional(true);
                    $sign_img4->setWorksheet($objPHPExcel);
                    $sign_img4->setCoordinates('W' . ($app_row_ke3 + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('W' . ($app_row_ke3 + 2));
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
                    $sign_img5 = new PHPExcel_Worksheet_Drawing();
                    $sign_img5->setPath('assets/ttd/' . $app5_personalstatus . '_' . $app5_personalid . '.png');
                    $sign_img5->setWidthAndHeight(135, 135);
                    $sign_img5->setResizeProportional(true);
                    $sign_img5->setWorksheet($objPHPExcel);
                    $sign_img5->setCoordinates('AC' . ($app_row_ke3 + 3));
                } else if ($app5_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp5 . $app5_personalid . $imageformatapp5)) {
                    $sign_img5 = new PHPExcel_Worksheet_Drawing();
                    $sign_img5->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp5 . $app5_personalid . $imageformatapp5);
                    $sign_img5->setWidthAndHeight(135, 135);
                    $sign_img5->setResizeProportional(true);
                    $sign_img5->setWorksheet($objPHPExcel);
                    $sign_img5->setCoordinates('AC' . ($app_row_ke3 + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AC' . ($app_row_ke3 + 2));
                }
            }

            $objPHPExcel->mergeCells('C' . ($app_row_ke3 + 7) . ':D' . ($app_row_ke3 + 7))->setCellValue('C' . ($app_row_ke3 + 7), 'Nama');
            $objPHPExcel->mergeCells('E' . ($app_row_ke3 + 7) . ':H' . ($app_row_ke3 + 7))->setCellValue('E' . ($app_row_ke3 + 7), ': ' . $app1_by);
            $objPHPExcel->mergeCells('C' . ($app_row_ke3 + 8) . ':D' . ($app_row_ke3 + 8))->setCellValue('C' . ($app_row_ke3 + 8), 'Jabatan');
            $objPHPExcel->mergeCells('E' . ($app_row_ke3 + 8) . ':H' . ($app_row_ke3 + 8))->setCellValue('E' . ($app_row_ke3 + 8), ': ' . $app1_position);
            $objPHPExcel->mergeCells('C' . ($app_row_ke3 + 9) . ':D' . ($app_row_ke3 + 9))->setCellValue('C' . ($app_row_ke3 + 9), 'Tanggal');
            $objPHPExcel->mergeCells('E' . ($app_row_ke3 + 9) . ':H' . ($app_row_ke3 + 9))->setCellValue('E' . ($app_row_ke3 + 9), ': ' . $app1date);

            $objPHPExcel->mergeCells('I' . ($app_row_ke3 + 7) . ':J' . ($app_row_ke3 + 7))->setCellValue('I' . ($app_row_ke3 + 7), 'Nama');
            $objPHPExcel->mergeCells('K' . ($app_row_ke3 + 7) . ':N' . ($app_row_ke3 + 7))->setCellValue('K' . ($app_row_ke3 + 7), ': ' . $app2_by);
            $objPHPExcel->mergeCells('I' . ($app_row_ke3 + 8) . ':J' . ($app_row_ke3 + 8))->setCellValue('I' . ($app_row_ke3 + 8), 'Jabatan');
            $objPHPExcel->mergeCells('K' . ($app_row_ke3 + 8) . ':N' . ($app_row_ke3 + 8))->setCellValue('K' . ($app_row_ke3 + 8), ': ' . $app2_position);
            $objPHPExcel->mergeCells('I' . ($app_row_ke3 + 9) . ':J' . ($app_row_ke3 + 9))->setCellValue('I' . ($app_row_ke3 + 9), 'Tanggal');
            $objPHPExcel->mergeCells('K' . ($app_row_ke3 + 9) . ':N' . ($app_row_ke3 + 9))->setCellValue('K' . ($app_row_ke3 + 9), ': ' . $app2date);
           
            $objPHPExcel->mergeCells('O' . ($app_row_ke3 + 7) . ':P' . ($app_row_ke3 + 7))->setCellValue('O' . ($app_row_ke3 + 7), 'Nama');
            $objPHPExcel->mergeCells('Q' . ($app_row_ke3 + 7) . ':T' . ($app_row_ke3 + 7))->setCellValue('Q' . ($app_row_ke3 + 7), ': ' . $app3_by);
            $objPHPExcel->mergeCells('O' . ($app_row_ke3 + 8) . ':P' . ($app_row_ke3 + 8))->setCellValue('O' . ($app_row_ke3 + 8), 'Jabatan');
            $objPHPExcel->mergeCells('Q' . ($app_row_ke3 + 8) . ':T' . ($app_row_ke3 + 8))->setCellValue('Q' . ($app_row_ke3 + 8), ': ' . $app3_position);
            $objPHPExcel->mergeCells('O' . ($app_row_ke3 + 9) . ':P' . ($app_row_ke3 + 9))->setCellValue('O' . ($app_row_ke3 + 9), 'Tanggal');
            $objPHPExcel->mergeCells('Q' . ($app_row_ke3 + 9) . ':T' . ($app_row_ke3 + 9))->setCellValue('Q' . ($app_row_ke3 + 9), ': ' . $app3date);

            $objPHPExcel->mergeCells('U' . ($app_row_ke3 + 7) . ':V' . ($app_row_ke3 + 7))->setCellValue('U' . ($app_row_ke3 + 7), 'Nama');
            $objPHPExcel->mergeCells('W' . ($app_row_ke3 + 7) . ':Z' . ($app_row_ke3 + 7))->setCellValue('W' . ($app_row_ke3 + 7), ': ' . $app4_by);
            $objPHPExcel->mergeCells('U' . ($app_row_ke3 + 8) . ':V' . ($app_row_ke3 + 8))->setCellValue('U' . ($app_row_ke3 + 8), 'Jabatan');
            $objPHPExcel->mergeCells('W' . ($app_row_ke3 + 8) . ':Z' . ($app_row_ke3 + 8))->setCellValue('W' . ($app_row_ke3 + 8), ': ' . $app4_position);
            $objPHPExcel->mergeCells('U' . ($app_row_ke3 + 9) . ':V' . ($app_row_ke3 + 9))->setCellValue('U' . ($app_row_ke3 + 9), 'Tanggal');
            $objPHPExcel->mergeCells('W' . ($app_row_ke3 + 9) . ':Z' . ($app_row_ke3 + 9))->setCellValue('W' . ($app_row_ke3 + 9), ': ' . $app4date);
            
             $objPHPExcel->mergeCells('AA' . ($app_row_ke3 + 7) . ':AB' . ($app_row_ke3 + 7))->setCellValue('AA' . ($app_row_ke3 + 7), 'Nama');
             $objPHPExcel->mergeCells('AC' . ($app_row_ke3 + 7) . ':AF' . ($app_row_ke3 + 7))->setCellValue('AC' . ($app_row_ke3 + 7), ': ' . $app5_by);
             $objPHPExcel->mergeCells('AA' . ($app_row_ke3 + 8) . ':AB' . ($app_row_ke3 + 8))->setCellValue('AA' . ($app_row_ke3 + 8), 'Jabatan');
             $objPHPExcel->mergeCells('AC' . ($app_row_ke3 + 8) . ':AF' . ($app_row_ke3 + 8))->setCellValue('AC' . ($app_row_ke3 + 8), ': ' . $app5_position);
             $objPHPExcel->mergeCells('AA' . ($app_row_ke3 + 9) . ':AB' . ($app_row_ke3 + 9))->setCellValue('AA' . ($app_row_ke3 + 9), 'Tanggal');
             $objPHPExcel->mergeCells('AC' . ($app_row_ke3 + 9) . ':AF' . ($app_row_ke3 + 9))->setCellValue('AC' . ($app_row_ke3 + 9), ': ' . $app5date);
            
            

            $objPHPExcel->setSharedStyle($noborderStyle, 'C' . ($app_row_ke3 + 7) . ':AN' . ($app_row_ke3 + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'C' . ($app_row_ke3 + 7) . ':C' . ($app_row_ke3 + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'I' . ($app_row_ke3 + 7) . ':I' . ($app_row_ke3 + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'O' . ($app_row_ke3 + 7) . ':O' . ($app_row_ke3 + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AA' . ($app_row_ke3 + 7) . ':AA' . ($app_row_ke3 + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row_ke3 + 7) . ':A' . ($app_row_ke3 + 9));
            $objPHPExcel->setSharedStyle($noborderStyle, 'AN' . ($app_row_ke3 + 7) . ':AN' . ($app_row_ke3 + 9));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AF' . ($app_row_ke3 + 7) . ':AF' . ($app_row_ke3 + 9));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AN' . ($app_row_ke3 + 7) . ':AN' . ($app_row_ke3 + 9));

            $objPHPExcel->getStyle('C' . ($app_row_ke3 + 7) . ':AF' . ($app_row_ke3 + 9))->getFont()->setBold(true);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'T' . ($app_row_ke3 + 7) . ':T' . ($app_row_ke3 + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row_ke3 + 7) . ':A' . ($app_row_ke3 + 9));

            $start_row3_ke3 = $app_row_ke3 + 9;
            $objPHPExcel->mergeCells('A' . ($start_row3_ke3 + 1) . ':R' . ($start_row3_ke3 + 1))->setCellValue('A' . ($start_row3_ke3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3_ke3 + 1) . ':R' . ($start_row3_ke3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('S' . ($start_row3_ke3 + 1) . ':AN' . ($start_row3_ke3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('S' . ($start_row3_ke3 + 1) . ':AN' . ($start_row3_ke3 + 1))->setCellValue('S' . ($start_row3_ke3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3_ke3 + 1) . ':R' . ($start_row3_ke3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'S' . ($start_row3_ke3 + 1) . ':AN' . ($start_row3_ke3 + 1));
            $objPHPExcel->setBreak('A' . ($start_row3_ke3 + 1),  PHPExcel_Worksheet::BREAK_ROW);
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
