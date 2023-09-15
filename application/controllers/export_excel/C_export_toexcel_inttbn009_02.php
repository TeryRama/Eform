<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_inttbn009_02 extends CI_Controller
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

        $dtheader = $this->M_forminttbn009_02->get_header_byid($this->header_id);

        if(isset($dtheader)){
            foreach ($dtheader as $dtheaderrow) {
                $dtcreate_date                           = $dtheaderrow->create_date;
                $create_date                             = date("d-m-Z", strtotime($dtheaderrow->create_date));
                $bulan                                   = date('N', strtotime($dtheaderrow->create_date));
                $docno                                   = $dtheaderrow->docno;
                $supplay_pwh                             = $dtheaderrow->supplay_pwh;
                $total_dtl_e_kwh_nilai                   = $dtheaderrow->total_dtl_e_kwh_nilai;
                $total_dtl_e_kwh_akumulatif              = $dtheaderrow->total_dtl_e_kwh_akumulatif;
                $total_dtl_a_steam_nilai                 = $dtheaderrow->total_dtl_a_steam_nilai;
                $total_dtl_a_steam_akumulatif            = $dtheaderrow->total_dtl_a_steam_akumulatif;
                $total_dtl_a_press_nilai                 = $dtheaderrow->total_dtl_a_press_nilai;
                $total_dtl_a_press_akumulatif            = $dtheaderrow->total_dtl_a_press_akumulatif;
                $total_dtl_a_batubara_nilai              = $dtheaderrow->total_dtl_a_batubara_nilai;
                $total_dtl_a_batubara_akumulatif         = $dtheaderrow->total_dtl_a_batubara_akumulatif;
                $total_dtl_a_debu_nilai                  = $dtheaderrow->total_dtl_a_debu_nilai;
                $total_dtl_a_debu_akumulatif             = $dtheaderrow->total_dtl_a_debu_akumulatif;
                $total_dtl_a_cocopit_nilai               = $dtheaderrow->total_dtl_a_cocopit_nilai;
                $total_dtl_a_cocopit_akumulatif          = $dtheaderrow->total_dtl_a_cocopit_akumulatif;
                $total_dtl_a_tempurung_nilai             = $dtheaderrow->total_dtl_a_tempurung_nilai;
                $total_dtl_a_tempurung_akumulatif        = $dtheaderrow->total_dtl_a_tempurung_akumulatif;
                $total_dtl_a_bb_nilai                    = $dtheaderrow->total_dtl_a_bb_nilai;
                $total_dtl_a_bb_akumulatif               = $dtheaderrow->total_dtl_a_bb_akumulatif;
                $total_dtl_a_sabut_nilai                 = $dtheaderrow->total_dtl_a_sabut_nilai;
                $total_dtl_a_sabut_akumulatif            = $dtheaderrow->total_dtl_a_sabut_akumulatif;
                $total_dtl_a_steam_batubara_nilai        = $dtheaderrow->total_dtl_a_steam_batubara_nilai;
                $total_dtl_a_steam_batubara_akumulatif   = $dtheaderrow->total_dtl_a_steam_batubara_akumulatif;
                $total_dtl_a_steam_bahanbakar_nilai      = $dtheaderrow->total_dtl_a_steam_bahanbakar_nilai;
                $total_dtl_a_steam_bahanbakar_akumulatif = $dtheaderrow->total_dtl_a_steam_bahanbakar_akumulatif;
                $total_dtl_a_operasi_nilai               = $dtheaderrow->total_dtl_a_operasi_nilai;
                $total_dtl_a_operasi_akumulatif          = $dtheaderrow->total_dtl_a_operasi_akumulatif;
                $total_dtl_a_dearator_nilai              = $dtheaderrow->total_dtl_a_dearator_nilai;
                $total_dtl_a_dearator_akumulatif         = $dtheaderrow->total_dtl_a_dearator_akumulatif;
                $total_dtl_a_demian_nilai                = $dtheaderrow->total_dtl_a_demian_nilai;
                $total_dtl_a_demian_akumulatif           = $dtheaderrow->total_dtl_a_demian_akumulatif;
                $total_dtl_a_ct_nilai                    = $dtheaderrow->total_dtl_a_ct_nilai;
                $total_dtl_a_ct_akumulatif               = $dtheaderrow->total_dtl_a_ct_akumulatif;
                $total_2generator                        = $dtheaderrow->total_2generator;
                $total_2generator_akumulatif             = $dtheaderrow->total_2generator_akumulatif;
                $selisih_kwh_generator                   = $dtheaderrow->selisih_kwh_generator;
                $total_dtl_b_kwh_nilai                   = $dtheaderrow->total_dtl_b_kwh_nilai;
                $total_dtl_b_kwh_akumulatif              = $dtheaderrow->total_dtl_b_kwh_akumulatif;
                $total_dtl_b_bahanbakar_nilai            = $dtheaderrow->total_dtl_b_bahanbakar_nilai;
                $total_dtl_b_bahanbakar_akumulatif       = $dtheaderrow->total_dtl_b_bahanbakar_akumulatif;
                $total_dtl_b_kwh_efisiensi_nilai         = $dtheaderrow->total_dtl_b_kwh_efisiensi_nilai;
                $total_dtl_b_kwh_efisiensi_akumulatif    = $dtheaderrow->total_dtl_b_kwh_efisiensi_akumulatif;
                $total_dtl_b_operasi_nilai               = $dtheaderrow->total_dtl_b_operasi_nilai;
                $total_dtl_b_operasi_akumulatif          = $dtheaderrow->total_dtl_b_operasi_akumulatif;
                $total_dtl_b_solar_nilai                 = $dtheaderrow->total_dtl_b_solar_nilai;
                $total_dtl_b_solar_akumulatif            = $dtheaderrow->total_dtl_b_solar_akumulatif;
                $total_real_pakai                        = $dtheaderrow->total_real_pakai;
                $total_kwh_generator1_nilai              = $dtheaderrow->total_kwh_generator1_nilai;
                $total_kwh_generator2_nilai              = $dtheaderrow->total_kwh_generator2_nilai;
                $total_star_genset                       = $dtheaderrow->total_star_genset;
                $total_generator                         = $dtheaderrow->total_generator;
                $total_kwh_loss_nilai                    = $dtheaderrow->total_kwh_loss_nilai;
                $total_dtl_d_pemakai_kwh                 = $dtheaderrow->total_dtl_d_pemakai_kwh;
                $total_dtl_d_pemakai_kwh_loss            = $dtheaderrow->total_dtl_d_pemakai_kwh_loss;
                $total_dtl_d_pemakai_kwh_total           = $dtheaderrow->total_dtl_d_pemakai_kwh_total;
                $total_dtl_d_pemakai_persen              = $dtheaderrow->total_dtl_d_pemakai_persen;
                $total_dtl_d_pemakai_akumulatif          = $dtheaderrow->total_dtl_d_pemakai_akumulatif;
                $total_dtl_d_bahan_bakar_kwh             = $dtheaderrow->total_dtl_d_bahan_bakar_kwh;
                $total_dtl_d_bahan_bakar_persen          = $dtheaderrow->total_dtl_d_bahan_bakar_persen;
                $total_dtl_d_bahan_bakar_akumulatif      = $dtheaderrow->total_dtl_d_bahan_bakar_akumulatif;
                $app1_by                                 = $dtheaderrow->app1_by;
                $app2_by                                 = $dtheaderrow->app2_by;
                $app3_by                                 = $dtheaderrow->app3_by;
                $app1_position                           = $dtheaderrow->app1_position;
                $app2_position                           = $dtheaderrow->app2_position;
                $app3_position                           = $dtheaderrow->app3_position;
                $app1_personalid                         = $dtheaderrow->app1_personalid;
                $app2_personalid                         = $dtheaderrow->app2_personalid;
                $app3_personalid                         = $dtheaderrow->app3_personalid;
                $app1_personalstatus                     = $dtheaderrow->app1_personalstatus;
                $app2_personalstatus                     = $dtheaderrow->app2_personalstatus;
                $app3_personalstatus                     = $dtheaderrow->app3_personalstatus;
                $app1date                                = $dtheaderrow->app1_date;
                $app2date                                = $dtheaderrow->app2_date;
                $app3date                                = $dtheaderrow->app3_date;
    
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
            }
        } 
        
        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail   = $this->M_forminttbn009_02->get_detail_byidx($this->header_id);
            $dtdetail_b = $this->M_forminttbn009_02->get_detail_byid_bx($this->header_id);
            $dtdetail_c = $this->M_forminttbn009_02->get_detail_byid_cx($this->header_id);
            $dtdetail_d = $this->M_forminttbn009_02->get_detail_byid_dx($this->header_id);
            $dtdetail_e = $this->M_forminttbn009_02->get_detail_byid_ex($this->header_id);
        } else {
            $dtdetail   = $this->M_forminttbn009_02->get_detail_byid($this->header_id);
            $dtdetail_b = $this->M_forminttbn009_02->get_detail_byid_b($this->header_id);
            $dtdetail_c = $this->M_forminttbn009_02->get_detail_byid_c($this->header_id);
            $dtdetail_d = $this->M_forminttbn009_02->get_detail_byid_d($this->header_id);
            $dtdetail_e = $this->M_forminttbn009_02->get_detail_byid_e($this->header_id);
        }

        $no = 1;
        foreach ($dtdetail as $dtdetail_row) {
            $a_dept_steam[]                       = $dtdetail_row->dept_steam;
            $a_steam_nilai[]                      = $dtdetail_row->steam_nilai;
            $a_steam_akumulatif[]                 = $dtdetail_row->steam_akumulatif;
            $a_press_nilai[]                      = $dtdetail_row->press_nilai;
            $a_press_akumulatif[]                 = $dtdetail_row->press_akumulatif;
            $a_batubara_nilai[]                   = $dtdetail_row->batubara_nilai;
            $a_batubara_akumulatif[]              = $dtdetail_row->batubara_akumulatif;
            $a_cocopit_nilai[]                    = $dtdetail_row->cocopit_nilai;
            $a_cocopit_akumulatif[]               = $dtdetail_row->cocopit_akumulatif;
            $a_tempurung_nilai[]                  = $dtdetail_row->tempurung_nilai;
            $a_tempurung_akumulatif[]             = $dtdetail_row->tempurung_akumulatif;
            $a_bb_nilai[]                         = $dtdetail_row->bb_nilai;
            $a_bb_akumulatif[]                    = $dtdetail_row->bb_akumulatif;
            $a_sabut_nilai[]                      = $dtdetail_row->sabut_nilai;
            $a_sabut_akumulatif[]                 = $dtdetail_row->sabut_akumulatif;
            $a_steam_batubara_nilai[]             = $dtdetail_row->steam_batubara_nilai;
            $a_steam_batubara_akumulatif[]        = $dtdetail_row->steam_batubara_akumulatif;
            $a_steam_bahanbakar_nilai[]           = $dtdetail_row->steam_bahanbakar_nilai;
            $a_steam_bahanbakar_akumulatif[]      = $dtdetail_row->steam_bahanbakar_akumulatif;
            $a_operasi_nilai[]                    = $dtdetail_row->operasi_nilai;
            $a_operasi_akumulatif[]               = $dtdetail_row->operasi_akumulatif;
            $a_dearator_nilai[]                   = $dtdetail_row->dearator_nilai;
            $a_dearator_akumulatif[]              = $dtdetail_row->dearator_akumulatif;
            $a_demian_nilai[]                     = $dtdetail_row->demian_nilai;
            $a_demian_akumulatif[]                = $dtdetail_row->demian_akumulatif;
            $a_debu_nilai[]                       = $dtdetail_row->debu_nilai;
            $a_debu_akumulatif[]                  = $dtdetail_row->debu_akumulatif;
            $a_ct_nilai[]                         = $dtdetail_row->ct_nilai;
            $a_ct_akumulatif[]                    = $dtdetail_row->ct_akumulatif;
        }

        foreach($dtdetail_b as $dtdetail_b_row){
            $b_trafo[]                            = $dtdetail_b_row->trafo;
            $b_kwh_akumulatif[]                   = $dtdetail_b_row->kwh_akumulatif;
            $b_bahanbakar_nilai[]                 = $dtdetail_b_row->bahanbakar_nilai;
            $b_bahanbakar_akumulatif[]            = $dtdetail_b_row->bahanbakar_akumulatif;
            $b_kwh_efisiensi_nilai[]              = $dtdetail_b_row->kwh_efisiensi_nilai;
            $b_kwh_efisiensi_akumulatif[]         = $dtdetail_b_row->kwh_efisiensi_akumulatif;
            $b_operasi_nilai[]                    = $dtdetail_b_row->operasi_nilai;
            $b_operasi_akumulatif[]               = $dtdetail_b_row->operasi_akumulatif;
            $b_solar_nilai[]                      = $dtdetail_b_row->solar_nilai;
            $b_solar_akumulatif[]                 = $dtdetail_b_row->solar_akumulatif;
            $b_kwh_akumulatif_awal[]              = $dtdetail_b_row->kwh_akumulatif_awal;
            $b_bahanbakar_akumulatif_awal[]       = $dtdetail_b_row->bahanbakar_akumulatif_awal;
            $b_kwh_efisiensi_akumulatif_awal[]    = $dtdetail_b_row->kwh_efisiensi_akumulatif_awal;
            $b_operasi_akumulatif_awal[]          = $dtdetail_b_row->operasi_akumulatif_awal;
            $b_solar_akumulatif_awal[]            = $dtdetail_b_row->solar_akumulatif_awal;
            $b_nama_trafo[]                       = $dtdetail_b_row->nama_trafo;
            $b_read_ct_trafo[]                    = $dtdetail_b_row->read_ct_trafo;
            $b_rata_hari[]                        = $dtdetail_b_row->rata_hari;
            $b_jam[]                              = $dtdetail_b_row->jam;
            $b_kwh_6k5_nilai[]                    = $dtdetail_b_row->kwh_6k5_nilai;
            $b_trafo_awal[]                       = $dtdetail_b_row->trafo_awal;
            $b_trafo_akhir[]                      = $dtdetail_b_row->trafo_akhir;
            $b_trafo_putaran[]                    = $dtdetail_b_row->trafo_putaran;
            $b_kwh_nilai[]                        = $dtdetail_b_row->kwh_nilai;
        }

        foreach($dtdetail_c AS $dtdetail_c_row){
            $c_dept_panel[]                       = $dtdetail_c_row->dept_panel;
            $c_kwh_awal[]                         = $dtdetail_c_row->kwh_awal;
            $c_kwh_akhir[]                        = $dtdetail_c_row->kwh_akhir;
            $c_putaran_hasil[]                    = $dtdetail_c_row->putaran_hasil;
            $c_kwh_nilai[]                        = $dtdetail_c_row->kwh_nilai;
            $c_kode_kwh[]                         = $dtdetail_c_row->kode_kwh;
            $c_reading_ct[]                       = $dtdetail_c_row->reading_ct;
            $c_dept_user[]                        = $dtdetail_c_row->dept_user;
            $c_status_beban[]                     = $dtdetail_c_row->status_beban;
            $c_rata_hari[]                        = $dtdetail_c_row->rata_hari;
            $c_jam_operasi[]                      = $dtdetail_c_row->jam_operasi;
            $c_kwh_6k6_hasil[]                    = $dtdetail_c_row->kwh_6k6_hasil;
            $c_beban_persen[]                     = $dtdetail_c_row->beban_persen;
            $c_beban[]                            = $dtdetail_c_row->beban;
            $c_kwh_real_nilai[]                   = $dtdetail_c_row->kwh_real_nilai;
            $c_beban_persen_fix[]                 = $dtdetail_c_row->beban_persen_fix;
            $c_dtl_c_item_id[]                    = $dtdetail_c_row->dtl_c_item_id;
            // $test =  $c_kwh_real_nilai;

                // if($c_status_beban != 'TIDAK'){
                //     $c_status_beban == $dtdetail_c_row->status_beban; 
                // } else {
                //     $c_status_beban == ""; 
                // }       
            }
            // if (isset($dtdetail_c)){
            //     foreach($dtdetail_c as $dtdt){

            //         if($c_status_beban != 'TIDAK'){
            //         $c_kwh_real_nilai == $dtdt->kwh_real_nilai; 
            //             } else {
            //                 $c_kwh_real_nilai == ""; 
            //             }     
                        
            //             echo "<pre>";
            //             print_r ($c_kwh_real_nilai);
            //             echo "</pre>";
            //     }
            // } exit();
              
        
        foreach($dtdetail_d AS $dtdetail_d_row){
            $d_pemakai_panel[]                    = $dtdetail_d_row->pemakai_panel;
            $d_pemakai_kwh[]                      = $dtdetail_d_row->pemakai_kwh;
            $d_pemakai_persen[]                   = $dtdetail_d_row->pemakai_persen;
            $d_pemakai_akumulatif[]               = $dtdetail_d_row->pemakai_akumulatif;
            $d_bahan_bakar_kwh[]                  = $dtdetail_d_row->bahan_bakar_kwh;
            $d_bahan_bakar_persen[]               = $dtdetail_d_row->bahan_bakar_persen;
            $d_bahan_bakar_akumulatif[]           = $dtdetail_d_row->bahan_bakar_akumulatif;
            $d_pemakai_kwh_loss[]                 = $dtdetail_d_row->pemakai_kwh_loss;
            $d_pemakai_kwh_total[]                = $dtdetail_d_row->pemakai_kwh_total;
            $d_id_pemakai_panel[]                 = $dtdetail_d_row->id_pemakai_panel;
        }

        foreach($dtdetail_e AS $dtdetail_e_row){
            $e_generator[]                        = $dtdetail_e_row->generator;
            $e_shift[]                            = $dtdetail_e_row->shift;
            $e_read_ct[]                          = $dtdetail_e_row->read_ct;
            $e_putaran[]                          = $dtdetail_e_row->putaran;
            $e_kwh_nilai[]                        = $dtdetail_e_row->kwh_nilai;
            $e_kwh_akumulatif[]                   = $dtdetail_e_row->kwh_akumulatif;
            $e_kwh_akumulatif_awal[]              = $dtdetail_e_row->kwh_akumulatif_awal;
            $e_item_id[]                          = $dtdetail_e_row->item_id;
        }
            // echo"<pre>";
            // print_r($dtdetail_e);exit();
            // echo"</pre>";

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
        $rangeCol = "AO";
        for ($y = "C", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(12);
        }
        $objPHPExcel->getColumnDimension("C")->setWidth(40);
        $objPHPExcel->getColumnDimension("G")->setWidth(25);
        $objPHPExcel->getColumnDimension("K")->setWidth(25);
        $objPHPExcel->getColumnDimension("AC")->setWidth(18);
        $objPHPExcel->getColumnDimension("AF")->setWidth(18);
        
        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(15);
        }
        $objPHPExcel->getRowDimension("46")->setRowHeight(45);
        
        $count1 = count($dtdetail_e);
        $jml_data_perpage = 6;
        if ($count1 < $jml_data_perpage) {
            $jml_page_a = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page_a = $count1 / $jml_data_perpage;
            } else {
                $jml_page_a = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }

        
        $count2 = count($dtdetail);
        $jml_data_perpage_b = 5;
        if ($count2 < $jml_data_perpage_b) {
            $jml_page_b = 1;
        } else {
            if (($count2 % $jml_data_perpage_b) == 0) {
                $jml_page_b = $count2 / $jml_data_perpage_b;
            } else {
                $jml_page_b = floor(($count2 / $jml_data_perpage_b)) + 1;
            }
        }

        $count3 = count($dtdetail_b);
        $jml_data_perpage_c = 23;
        if ($count3 < $jml_data_perpage_c) {
            $jml_page_c = 1;
        } else {
            if (($count3 % $jml_data_perpage_c) == 0) {
                $jml_page_c = $count3 / $jml_data_perpage_c;
            } else {
                $jml_page_c = floor(($count3 / $jml_data_perpage_c)) + 1;
            }
        }

        $count4 = count($dtdetail_d);
        $jml_data_perpage_d = $count4;
        if ($count4 < $jml_data_perpage_d) {
            $jml_page_d = 1;
        } else {
            if (($count4 % $jml_data_perpage_d) == 0) {
                $jml_page_d = $count4 / $jml_data_perpage_d;
            } else {
                $jml_page_d = floor(($count4 / $jml_data_perpage_d)) + 1;
            }
        }

        $count5 = count($dtdetail_c);
        $jml_data_perpage_e = $count5;
        if ($count5 < $jml_data_perpage_e) {
            $jml_page_e = 1;
        } else {
            if (($count5 % $jml_data_perpage_e) == 0) {
                $jml_page_e = $count5 / $jml_data_perpage_e;
            } else {
                $jml_page_e = floor(($count5 / $jml_data_perpage_e)) + 1;
            }
        }

        $jml_row_perpage  = 500;

        $jml_page = max($jml_page_a, $jml_page_b, $jml_page_e ,$jml_page_c, $jml_page_d);

        // $number = 0;
        for ($i1 = 0; $i1 < $jml_page; $i1++) {

            $start_row = ($i1 * $jml_row_perpage) + 1;
            $finish_row = ((($i1 * $jml_row_perpage) + 1) + ($jml_row_perpage));

            $start_detail = ($i1 * $jml_data_perpage);
            $finish_detail = (($i1 * $jml_data_perpage) + ($jml_data_perpage - 1));

            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/PSG_logo_2022.png');
            $gbr->setWidthAndHeight(45, 45);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('A' . $start_row)->setOffsetX(42);


            $objPHPExcel->mergeCells('A' .   $start_row . ':B' . ($start_row + 1));
            $objPHPExcel->mergeCells('C' .   $start_row . ':AK' . ($start_row +1))->setCellValue('C' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AL' .  $start_row . ':AL' . $start_row)->setCellValue('AL' . $start_row, 'Doc');
            $objPHPExcel->mergeCells('AM' .  $start_row . ':AO' . $start_row)->setCellValue('AM' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('AL' . ($start_row + 1) . ':AL' . ($start_row + 1))->setCellValue('AL' . ($start_row + 1), 'Date');
            $objPHPExcel->mergeCells('AM' . ($start_row + 1) . ':AO' . ($start_row + 1))->setCellValue('AM' . ($start_row + 1), ': ' . $dtcreate_date);

            $objPHPExcel->mergeCells('A' .  ($start_row + 2) . ':B' .  ($start_row + 2))->setCellValue('A' .  ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('C' .  ($start_row + 2) . ':AK' . ($start_row + 2))->setCellValue('C' .  ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AL' . ($start_row + 2) . ':AL' . ($start_row + 2))->setCellValue('AL' . ($start_row + 2), 'Page');
            $objPHPExcel->mergeCells('AM' . ($start_row + 2) . ':AO' . ($start_row + 2))->setCellValue('AM' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' .  $start_row .      ':B' .  ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':AO' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':AO' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':AK' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'AL' . ($start_row) . ':AO' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AM' .  $start_row  . ':AO' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AL' . ($start_row + 2) . ':AO' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AM' . ($start_row + 2) . ':AO' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'C' . ($start_row) . ':AK' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':B' . ($start_row + 2));
            $objPHPExcel->getStyle('AJ' . ($start_row) . ':AO' . ($start_row))->getFont()->setSize(10);

            /* TABLE 1 */
            $objPHPExcel->mergeCells('A' .  ($start_row + 4) . ':I' .  ($start_row + 4))->setCellValue('A' .  ($start_row + 4), 'CATATAN KWH GENERATOR');
            $objPHPExcel->mergeCells('A' .  ($start_row + 5) . ':B' .  ($start_row + 5))->setCellValue('A' .  ($start_row + 5), 'GENERATOR');
            $objPHPExcel->mergeCells('A' .  ($start_row + 6) . ':B' .  ($start_row + 8))->setCellValue('A' .  ($start_row + 6), 'GENERATOR 1');
            $objPHPExcel->mergeCells('A' .  ($start_row + 9) . ':B' .  ($start_row + 11))->setCellValue('A' .  ($start_row + 9), 'GENERATOR 2');
            $objPHPExcel->mergeCells('C' .  ($start_row + 5) . ':C' .  ($start_row + 5))->setCellValue('C' .  ($start_row + 5), 'SHIFT');
            $objPHPExcel->mergeCells('D' .  ($start_row + 5) . ':D' .  ($start_row + 5))->setCellValue('D' .  ($start_row + 5), 'READ CT');
            $objPHPExcel->mergeCells('E' .  ($start_row + 5) . ':E' .  ($start_row + 5))->setCellValue('E' .  ($start_row + 5), 'PUTARAN');
            $objPHPExcel->mergeCells('F' .  ($start_row + 5) . ':G' .  ($start_row + 5))->setCellValue('F' .  ($start_row + 5), 'KWH');
            $objPHPExcel->mergeCells('H' .  ($start_row + 5) . ':I' .  ($start_row + 5))->setCellValue('H' .  ($start_row + 5), 'AKUMULATIF');
            $objPHPExcel->mergeCells('A' .  ($start_row + 12) . ':E' .  ($start_row + 12))->setCellValue('A' .  ($start_row + 12), 'TOTAL 2 GENERATOR');
            $objPHPExcel->mergeCells('A' .  ($start_row + 13) . ':E' .  ($start_row + 13))->setCellValue('A' .  ($start_row + 13), 'SUPPLY DARI KWH');
            if(isset($dtheader)){
                $objPHPExcel->mergeCells('F' .  ($start_row + 12) . ':G' .  ($start_row + 12))->setCellValue('F' .  ($start_row + 12), $total_dtl_e_kwh_nilai);
                $objPHPExcel->mergeCells('H' .  ($start_row + 12) . ':I' .  ($start_row + 12))->setCellValue('H' .  ($start_row + 12), $total_dtl_e_kwh_akumulatif);
                $objPHPExcel->mergeCells('F' .  ($start_row + 13) . ':G' .  ($start_row + 13))->setCellValue('F' .  ($start_row + 13), $supplay_pwh);
            }else{
                $objPHPExcel->mergeCells('F' .  ($start_row + 12) . ':G' .  ($start_row + 12))->setCellValue('F' .  ($start_row + 12), "0");
                $objPHPExcel->mergeCells('H' .  ($start_row + 12) . ':I' .  ($start_row + 12))->setCellValue('H' .  ($start_row + 12), "0");
                $objPHPExcel->mergeCells('F' .  ($start_row + 13) . ':G' .  ($start_row + 13))->setCellValue('F' .  ($start_row + 13), "0");
            }
            
            /* TABLE 2 */
            $objPHPExcel->mergeCells('J' .  ($start_row + 4) . ':P' .  ($start_row + 4))->setCellValue('J' .  ($start_row + 4), 'STEAM');
            $objPHPExcel->mergeCells('Q' .  ($start_row + 4) . ':AC' .  ($start_row + 4))->setCellValue('Q' .  ($start_row + 4), 'BAHAN BAKAR');
            $objPHPExcel->mergeCells('J' .  ($start_row + 5) . ':L' .  ($start_row + 6))->setCellValue('J' .  ($start_row + 5), 'DEPARTEMEN');
            $objPHPExcel->mergeCells('M' .  ($start_row + 5) . ':N' .  ($start_row + 5))->setCellValue('M' .  ($start_row + 5), 'Steam (Ton)');
            $objPHPExcel->mergeCells('O' .  ($start_row + 5) . ':P' .  ($start_row + 5))->setCellValue('O' .  ($start_row + 5), 'Press (Bar)');
            $objPHPExcel->mergeCells('Q' .  ($start_row + 5) . ':S' .  ($start_row + 5))->setCellValue('Q' .  ($start_row + 5), '( a ) Batubara ( Kg )');
            $objPHPExcel->mergeCells('T' .  ($start_row + 5) . ':U' .  ($start_row + 5))->setCellValue('T' .  ($start_row + 5), '( b) arang (Kg)');
            $objPHPExcel->mergeCells('V' .  ($start_row + 5) . ':W' .  ($start_row + 5))->setCellValue('V' .  ($start_row + 5), '( c ) cocopeat');
            $objPHPExcel->mergeCells('X' .  ($start_row + 5) . ':Y' .  ($start_row + 5))->setCellValue('X' .  ($start_row + 5), '( d ) Tempurung (kg)');
            $objPHPExcel->mergeCells('Z' .  ($start_row + 5) . ':AA' .  ($start_row + 5))->setCellValue('Z' .  ($start_row + 5), 'Pakai Bahan Bakar (a+b+c+d)');
            $objPHPExcel->mergeCells('AB' .  ($start_row + 5) . ':AC' .  ($start_row + 5))->setCellValue('AB' .  ($start_row + 5), 'Sabut (Kg)');
            $objPHPExcel->mergeCells('AD' .  ($start_row + 4) . ':AE' .  ($start_row + 5))->setCellValue('AD' .  ($start_row + 4), "EFESIENSI  \n Steam Kg/ Kg Batu Bara (d)");
            $objPHPExcel->mergeCells('AF' .  ($start_row + 4) . ':AG' .  ($start_row + 5))->setCellValue('AF' .  ($start_row + 4), "EFESIENSI  \n Steam Kg/ Kg Bahan Bakar (a+b+c+d)");
            $objPHPExcel->mergeCells('AH' .  ($start_row + 4) . ':AI' .  ($start_row + 5))->setCellValue('AH' .  ($start_row + 4), "Jam Operasi");
            $objPHPExcel->mergeCells('AJ' .  ($start_row + 4) . ':AK' .  ($start_row + 5))->setCellValue('AJ' .  ($start_row + 4), "Air Dearator");
            $objPHPExcel->mergeCells('AL' .  ($start_row + 4) . ':AM' .  ($start_row + 5))->setCellValue('AL' .  ($start_row + 4), "Air Demin");
            $objPHPExcel->mergeCells('AN' .  ($start_row + 4) . ':AO' .  ($start_row + 5))->setCellValue('AN' .  ($start_row + 4), "Air CT");
            $objPHPExcel->mergeCells('M' .  ($start_row + 6) . ':M' .  ($start_row + 6))->setCellValue('M' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('N' .  ($start_row + 6) . ':N' .  ($start_row + 6))->setCellValue('N' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('O' .  ($start_row + 6) . ':O' .  ($start_row + 6))->setCellValue('O' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('P' .  ($start_row + 6) . ':P' .  ($start_row + 6))->setCellValue('P' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('Q' .  ($start_row + 6) . ':R' .  ($start_row + 6))->setCellValue('Q' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('S' .  ($start_row + 6) . ':S' .  ($start_row + 6))->setCellValue('S' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('T' .  ($start_row + 6) . ':T' .  ($start_row + 6))->setCellValue('T' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('U' .  ($start_row + 6) . ':U' .  ($start_row + 6))->setCellValue('U' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('V' .  ($start_row + 6) . ':V' .  ($start_row + 6))->setCellValue('V' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('W' .  ($start_row + 6) . ':W' .  ($start_row + 6))->setCellValue('W' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('X' .  ($start_row + 6) . ':X' .  ($start_row + 6))->setCellValue('X' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('Y' .  ($start_row + 6) . ':Y' .  ($start_row + 6))->setCellValue('Y' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('Z' .  ($start_row + 6) . ':Z' .  ($start_row + 6))->setCellValue('Z' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('AA' .  ($start_row + 6) . ':AA' .  ($start_row + 6))->setCellValue('AA' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('AB' .  ($start_row + 6) . ':AB' .  ($start_row + 6))->setCellValue('AB' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('AC' .  ($start_row + 6) . ':AC' .  ($start_row + 6))->setCellValue('AC' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('AD' .  ($start_row + 6) . ':AD' .  ($start_row + 6))->setCellValue('AD' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('AE' .  ($start_row + 6) . ':AE' .  ($start_row + 6))->setCellValue('AE' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('AF' .  ($start_row + 6) . ':AF' .  ($start_row + 6))->setCellValue('AF' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('AG' .  ($start_row + 6) . ':AG' .  ($start_row + 6))->setCellValue('AG' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('AH' .  ($start_row + 6) . ':AH' .  ($start_row + 6))->setCellValue('AH' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('AI' .  ($start_row + 6) . ':AI' .  ($start_row + 6))->setCellValue('AI' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('AJ' .  ($start_row + 6) . ':AJ' .  ($start_row + 6))->setCellValue('AJ' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('AK' .  ($start_row + 6) . ':AK' .  ($start_row + 6))->setCellValue('AK' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('AL' .  ($start_row + 6) . ':AL' .  ($start_row + 6))->setCellValue('AL' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('AM' .  ($start_row + 6) . ':AM' .  ($start_row + 6))->setCellValue('AM' .  ($start_row + 6), "AKM");
            $objPHPExcel->mergeCells('AN' .  ($start_row + 6) . ':AN' .  ($start_row + 6))->setCellValue('AN' .  ($start_row + 6), "Hari ini");
            $objPHPExcel->mergeCells('AO' .  ($start_row + 6) . ':AO' .  ($start_row + 6))->setCellValue('AO' .  ($start_row + 6), "AKM");

            $objPHPExcel->mergeCells('J' .  ($start_row + 13) . ':L' .  ($start_row + 13))->setCellValue('J' .  ($start_row + 13), "TOTAL");
            if(isset($dtheader)){
                $objPHPExcel->mergeCells('M' .  ($start_row + 13) . ':M' .  ($start_row + 13))->setCellValue('M' .  ($start_row + 13), $total_dtl_a_steam_nilai);
                $objPHPExcel->mergeCells('N' .  ($start_row + 13) . ':N' .  ($start_row + 13))->setCellValue('N' .  ($start_row + 13), $total_dtl_a_steam_akumulatif);
                $objPHPExcel->mergeCells('O' .  ($start_row + 13) . ':O' .  ($start_row + 13))->setCellValue('O' .  ($start_row + 13), $total_dtl_a_press_nilai);
                $objPHPExcel->mergeCells('P' .  ($start_row + 13) . ':P' .  ($start_row + 13))->setCellValue('P' .  ($start_row + 13), $total_dtl_a_press_akumulatif);
                $objPHPExcel->mergeCells('Q' .  ($start_row + 13) . ':R' .  ($start_row + 13))->setCellValue('Q' .  ($start_row + 13), $total_dtl_a_batubara_nilai);
                $objPHPExcel->mergeCells('S' .  ($start_row + 13) . ':S' .  ($start_row + 13))->setCellValue('S' .  ($start_row + 13), $total_dtl_a_batubara_akumulatif);
                $objPHPExcel->mergeCells('T' .  ($start_row + 13) . ':T' .  ($start_row + 13))->setCellValue('T' .  ($start_row + 13), $total_dtl_a_debu_nilai);
                $objPHPExcel->mergeCells('U' .  ($start_row + 13) . ':U' .  ($start_row + 13))->setCellValue('U' .  ($start_row + 13), $total_dtl_a_debu_akumulatif);
                $objPHPExcel->mergeCells('V' .  ($start_row + 13) . ':V' .  ($start_row + 13))->setCellValue('V' .  ($start_row + 13), $total_dtl_a_cocopit_nilai);
                $objPHPExcel->mergeCells('W' .  ($start_row + 13) . ':W' .  ($start_row + 13))->setCellValue('W' .  ($start_row + 13), $total_dtl_a_cocopit_akumulatif);
                $objPHPExcel->mergeCells('X' .  ($start_row + 13) . ':X' .  ($start_row + 13))->setCellValue('X' .  ($start_row + 13), $total_dtl_a_tempurung_nilai);
                $objPHPExcel->mergeCells('Y' .  ($start_row + 13) . ':Y' .  ($start_row + 13))->setCellValue('Y' .  ($start_row + 13), $total_dtl_a_tempurung_akumulatif);
                $objPHPExcel->mergeCells('Z' .  ($start_row + 13) . ':Z' .  ($start_row + 13))->setCellValue('Z' .  ($start_row + 13), $total_dtl_a_bb_nilai);
                $objPHPExcel->mergeCells('AA' .  ($start_row + 13) . ':AA' .  ($start_row + 13))->setCellValue('AA' .  ($start_row + 13), $total_dtl_a_bb_akumulatif);
                $objPHPExcel->mergeCells('AB' .  ($start_row + 13) . ':AB' .  ($start_row + 13))->setCellValue('AB' .  ($start_row + 13), $total_dtl_a_sabut_nilai);
                $objPHPExcel->mergeCells('AC' .  ($start_row + 13) . ':AC' .  ($start_row + 13))->setCellValue('AC' .  ($start_row + 13), $total_dtl_a_sabut_akumulatif);
                $objPHPExcel->mergeCells('AD' .  ($start_row + 13) . ':AD' .  ($start_row + 13))->setCellValue('AD' .  ($start_row + 13), $total_dtl_a_steam_batubara_nilai);
                $objPHPExcel->mergeCells('AE' .  ($start_row + 13) . ':AE' .  ($start_row + 13))->setCellValue('AE' .  ($start_row + 13), $total_dtl_a_steam_batubara_akumulatif);
                $objPHPExcel->mergeCells('AF' .  ($start_row + 13) . ':AF' .  ($start_row + 13))->setCellValue('AF' .  ($start_row + 13), $total_dtl_a_steam_bahanbakar_nilai);
                $objPHPExcel->mergeCells('AG' .  ($start_row + 13) . ':AG' .  ($start_row + 13))->setCellValue('AG' .  ($start_row + 13), $total_dtl_a_steam_bahanbakar_akumulatif);
                $objPHPExcel->mergeCells('AH' .  ($start_row + 13) . ':AH' .  ($start_row + 13))->setCellValue('AH' .  ($start_row + 13), $total_dtl_a_operasi_nilai);
                $objPHPExcel->mergeCells('AI' .  ($start_row + 13) . ':AI' .  ($start_row + 13))->setCellValue('AI' .  ($start_row + 13), $total_dtl_a_operasi_akumulatif);
                $objPHPExcel->mergeCells('AJ' .  ($start_row + 13) . ':AJ' .  ($start_row + 13))->setCellValue('AJ' .  ($start_row + 13), $total_dtl_a_dearator_nilai);
                $objPHPExcel->mergeCells('AK' .  ($start_row + 13) . ':AK' .  ($start_row + 13))->setCellValue('AK' .  ($start_row + 13), $total_dtl_a_dearator_akumulatif);
                $objPHPExcel->mergeCells('AL' .  ($start_row + 13) . ':AL' .  ($start_row + 13))->setCellValue('AL' .  ($start_row + 13), $total_dtl_a_demian_nilai);
                $objPHPExcel->mergeCells('AM' .  ($start_row + 13) . ':AM' .  ($start_row + 13))->setCellValue('AM' .  ($start_row + 13), $total_dtl_a_demian_akumulatif);
                $objPHPExcel->mergeCells('AN' .  ($start_row + 13) . ':AN' .  ($start_row + 13))->setCellValue('AN' .  ($start_row + 13), $total_dtl_a_ct_nilai);
                $objPHPExcel->mergeCells('AO' .  ($start_row + 13) . ':AO' .  ($start_row + 13))->setCellValue('AO' .  ($start_row + 13), $total_dtl_a_ct_akumulatif);
            }else{
                $objPHPExcel->mergeCells('M' .  ($start_row + 13) . ':M' .  ($start_row + 13))->setCellValue('M' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('N' .  ($start_row + 13) . ':N' .  ($start_row + 13))->setCellValue('N' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('O' .  ($start_row + 13) . ':O' .  ($start_row + 13))->setCellValue('O' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('P' .  ($start_row + 13) . ':P' .  ($start_row + 13))->setCellValue('P' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('Q' .  ($start_row + 13) . ':R' .  ($start_row + 13))->setCellValue('Q' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('S' .  ($start_row + 13) . ':S' .  ($start_row + 13))->setCellValue('S' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('T' .  ($start_row + 13) . ':T' .  ($start_row + 13))->setCellValue('T' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('U' .  ($start_row + 13) . ':U' .  ($start_row + 13))->setCellValue('U' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('V' .  ($start_row + 13) . ':V' .  ($start_row + 13))->setCellValue('V' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('W' .  ($start_row + 13) . ':W' .  ($start_row + 13))->setCellValue('W' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('X' .  ($start_row + 13) . ':X' .  ($start_row + 13))->setCellValue('X' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('Y' .  ($start_row + 13) . ':Y' .  ($start_row + 13))->setCellValue('Y' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('Z' .  ($start_row + 13) . ':Z' .  ($start_row + 13))->setCellValue('Z' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AA' .  ($start_row + 13) . ':AA' .  ($start_row + 13))->setCellValue('AA' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AB' .  ($start_row + 13) . ':AB' .  ($start_row + 13))->setCellValue('AB' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AC' .  ($start_row + 13) . ':AC' .  ($start_row + 13))->setCellValue('AC' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AD' .  ($start_row + 13) . ':AD' .  ($start_row + 13))->setCellValue('AD' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AE' .  ($start_row + 13) . ':AE' .  ($start_row + 13))->setCellValue('AE' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AF' .  ($start_row + 13) . ':AF' .  ($start_row + 13))->setCellValue('AF' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AG' .  ($start_row + 13) . ':AG' .  ($start_row + 13))->setCellValue('AG' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AH' .  ($start_row + 13) . ':AH' .  ($start_row + 13))->setCellValue('AH' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AI' .  ($start_row + 13) . ':AI' .  ($start_row + 13))->setCellValue('AI' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AJ' .  ($start_row + 13) . ':AJ' .  ($start_row + 13))->setCellValue('AJ' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AK' .  ($start_row + 13) . ':AK' .  ($start_row + 13))->setCellValue('AK' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AL' .  ($start_row + 13) . ':AL' .  ($start_row + 13))->setCellValue('AL' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AM' .  ($start_row + 13) . ':AM' .  ($start_row + 13))->setCellValue('AM' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AN' .  ($start_row + 13) . ':AN' .  ($start_row + 13))->setCellValue('AN' .  ($start_row + 13), "0");
                $objPHPExcel->mergeCells('AO' .  ($start_row + 13) . ':AO' .  ($start_row + 13))->setCellValue('AO' .  ($start_row + 13), "0");
            }

            
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($start_row + 3) . ':A' .  ($start_row + 5));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($start_row + 3) . ':AO' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row + 4) . ':I' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row + 6) . ':B' . ($start_row + 11));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($start_row + 12) . ':I' . ($start_row + 13));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'J' . ($start_row + 4) . ':AO' . ($start_row + 6));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'J' . ($start_row + 13) . ':AO' . ($start_row + 13));
            // $objPHPExcel->getStyle('C' . ($start_row + 4) . ':AL' . ($start_row + 5))->getFont()->setBold(true)->setSize(9);

            $dtl_row = $start_row + 6;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {

                if (isset($e_generator[$arr])) { $dt_generator[$arr] = $e_generator[$arr]; } else { $dt_generator[$arr] = ""; }
                if (isset($e_shift[$arr])) { $dt_shift[$arr] = $e_shift[$arr]; } else { $dt_shift[$arr] = ""; }
                if (isset($e_read_ct[$arr])) { $dt_read_ct[$arr] = $e_read_ct[$arr]; } else { $dt_read_ct[$arr] = ""; }
                if (isset($e_putaran[$arr])) { $dt_putaran[$arr] = $e_putaran[$arr]; } else { $dt_putaran[$arr] = ""; }
                if (isset($e_kwh_nilai[$arr])) { $dt_kwh_nilai[$arr] = $e_kwh_nilai[$arr]; } else { $dt_kwh_nilai[$arr] = ""; }
                if (isset($e_kwh_akumulatif[$arr])) { $dt_kwh_akumulatif[$arr] = $e_kwh_akumulatif[$arr]; } else { $dt_kwh_akumulatif[$arr] = ""; }
                if (isset($e_item_id[$arr])) { $dt_item_id[$arr] = $e_item_id[$arr]; } else { $dt_item_id[$arr] = ""; }

                    $objPHPExcel->mergeCells('C' .  $dtl_row . ':C' .  $dtl_row)->setCellValue('C' .  $dtl_row, $dt_shift[$arr]);
                    $objPHPExcel->mergeCells('D' .  $dtl_row . ':D' .  $dtl_row)->setCellValue('D' .  $dtl_row, $dt_read_ct[$arr]);
                    $objPHPExcel->mergeCells('E' .  $dtl_row . ':E' .  $dtl_row)->setCellValue('E' .  $dtl_row, $dt_putaran[$arr]);
                    $objPHPExcel->mergeCells('F' .  $dtl_row . ':G' .  $dtl_row)->setCellValue('F' .  $dtl_row, $dt_kwh_nilai[$arr]);
                    $objPHPExcel->mergeCells('H' .  $dtl_row . ':I' .  $dtl_row)->setCellValue('H' .  $dtl_row, $dt_kwh_akumulatif[$arr]);
                
                $objPHPExcel->setSharedStyle($bodyStyle, 'C' . $dtl_row . ':I' . $dtl_row);
                // $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($dtl_row) . ':AO' . ($dtl_row));
                // $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row) . ':A' .  ($dtl_row));
                $dtl_row++;
            }

            $dtl_row2 = $start_row + 7;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {

                if (isset($a_dept_steam[$arr])) { $dta_dept_steam[$arr] = $a_dept_steam[$arr]; } else { $dta_dept_steam[$arr] = ""; }
                if (isset($a_steam_nilai[$arr])) { $dta_steam_nilai[$arr] = $a_steam_nilai[$arr]; } else { $dta_steam_nilai[$arr] = ""; }
                if (isset($a_steam_akumulatif[$arr])) { $dta_steam_akumulatif[$arr] = $a_steam_akumulatif[$arr]; } else { $dta_steam_akumulatif[$arr] = ""; }
                if (isset($a_press_nilai[$arr])) { $dta_press_nilai[$arr] = $a_press_nilai[$arr]; } else { $dta_press_nilai[$arr] = ""; }
                if (isset($a_press_akumulatif[$arr])) { $dta_press_akumulatif[$arr] = $a_press_akumulatif[$arr]; } else { $dta_press_akumulatif[$arr] = ""; }
                if (isset($a_batubara_nilai[$arr])) { $dta_batubara_nilai[$arr] = $a_batubara_nilai[$arr]; } else { $dta_batubara_nilai[$arr] = ""; }
                if (isset($a_batubara_akumulatif[$arr])) { $dta_batubara_akumulatif[$arr] = $a_batubara_akumulatif[$arr]; } else { $dta_batubara_akumulatif[$arr] = ""; }
                if (isset($a_cocopit_nilai[$arr])) { $dta_cocopit_nilai[$arr] = $a_cocopit_nilai[$arr]; } else { $dta_cocopit_nilai[$arr] = ""; }
                if (isset($a_cocopit_akumulatif[$arr])) { $dta_cocopit_akumulatif[$arr] = $a_cocopit_akumulatif[$arr]; } else { $dta_cocopit_akumulatif[$arr] = ""; }
                if (isset($a_tempurung_nilai[$arr])) { $dta_tempurung_nilai[$arr] = $a_tempurung_nilai[$arr]; } else { $dta_tempurung_nilai[$arr] = ""; }
                if (isset($a_tempurung_akumulatif[$arr])) { $dta_tempurung_akumulatif[$arr] = $a_tempurung_akumulatif[$arr]; } else { $dta_tempurung_akumulatif[$arr] = ""; }
                if (isset($a_bb_nilai[$arr])) { $dta_bb_nilai[$arr] = $a_bb_nilai[$arr]; } else { $dta_bb_nilai[$arr] = ""; }
                if (isset($a_bb_akumulatif[$arr])) { $dta_bb_akumulatif[$arr] = $a_bb_akumulatif[$arr]; } else { $dta_bb_akumulatif[$arr] = ""; }
                if (isset($a_sabut_nilai[$arr])) { $dta_sabut_nilai[$arr] = $a_sabut_nilai[$arr]; } else { $dta_sabut_nilai[$arr] = ""; }
                if (isset($a_sabut_akumulatif[$arr])) { $dta_sabut_akumulatif[$arr] = $a_sabut_akumulatif[$arr]; } else { $dta_sabut_akumulatif[$arr] = ""; }
                if (isset($a_steam_batubara_nilai[$arr])) { $dta_steam_batubara_nilai[$arr] = $a_steam_batubara_nilai[$arr]; } else { $dta_steam_batubara_nilai[$arr] = ""; }
                if (isset($a_steam_batubara_akumulatif[$arr])) { $dta_steam_batubara_akumulatif[$arr] = $a_steam_batubara_akumulatif[$arr]; } else { $dta_steam_batubara_akumulatif[$arr] = ""; }
                if (isset($a_steam_bahanbakar_nilai[$arr])) { $dta_steam_bahanbakar_nilai[$arr] = $a_steam_bahanbakar_nilai[$arr]; } else { $dta_steam_bahanbakar_nilai[$arr] = ""; }
                if (isset($a_steam_bahanbakar_akumulatif[$arr])) { $dta_steam_bahanbakar_akumulatif[$arr] = $a_steam_bahanbakar_akumulatif[$arr]; } else { $dta_steam_bahanbakar_akumulatif[$arr] = ""; }
                if (isset($a_operasi_nilai[$arr])) { $dta_operasi_nilai[$arr] = $a_operasi_nilai[$arr]; } else { $dta_operasi_nilai[$arr] = ""; }
                if (isset($a_operasi_akumulatif[$arr])) { $dta_operasi_akumulatif[$arr] = $a_operasi_akumulatif[$arr]; } else { $dta_operasi_akumulatif[$arr] = ""; }
                if (isset($a_dearator_nilai[$arr])) { $dta_dearator_nilai[$arr] = $a_dearator_nilai[$arr]; } else { $dta_dearator_nilai[$arr] = ""; }
                if (isset($a_dearator_akumulatif[$arr])) { $dta_dearator_akumulatif[$arr] = $a_dearator_akumulatif[$arr]; } else { $dta_dearator_akumulatif[$arr] = ""; }
                if (isset($a_demian_nilai[$arr])) { $dta_demian_nilai[$arr] = $a_demian_nilai[$arr]; } else { $dta_demian_nilai[$arr] = ""; }
                if (isset($a_demian_akumulatif[$arr])) { $dta_demian_akumulatif[$arr] = $a_demian_akumulatif[$arr]; } else { $dta_demian_akumulatif[$arr] = ""; }
                if (isset($a_debu_nilai[$arr])) { $dta_debu_nilai[$arr] = $a_debu_nilai[$arr]; } else { $dta_debu_nilai[$arr] = ""; }
                if (isset($a_debu_akumulatif[$arr])) { $dta_debu_akumulatif[$arr] = $a_debu_akumulatif[$arr]; } else { $dta_debu_akumulatif[$arr] = ""; }
                if (isset($a_ct_nilai[$arr])) { $dta_ct_nilai[$arr] = $a_ct_nilai[$arr]; } else { $dta_ct_nilai[$arr] = ""; }
                if (isset($a_ct_akumulatif[$arr])) { $dta_ct_akumulatif[$arr] = $a_ct_akumulatif[$arr]; } else { $dta_ct_akumulatif[$arr] = ""; }


                    $objPHPExcel->mergeCells('J' .  $dtl_row2 . ':L' .  $dtl_row2)->setCellValue('J' .  $dtl_row2, $dta_dept_steam[$arr]);
                    $objPHPExcel->mergeCells('M' .  $dtl_row2 . ':M' .  $dtl_row2)->setCellValue('M' .  $dtl_row2, $dta_steam_nilai[$arr]);
                    $objPHPExcel->mergeCells('N' .  $dtl_row2 . ':N' .  $dtl_row2)->setCellValue('N' .  $dtl_row2, $dta_steam_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('O' .  $dtl_row2 . ':O' .  $dtl_row2)->setCellValue('O' .  $dtl_row2, $dta_press_nilai[$arr]);
                    $objPHPExcel->mergeCells('P' .  $dtl_row2 . ':P' .  $dtl_row2)->setCellValue('P' .  $dtl_row2, $dta_press_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('Q' .  $dtl_row2 . ':R' .  $dtl_row2)->setCellValue('Q' .  $dtl_row2, $dta_batubara_nilai[$arr]);
                    $objPHPExcel->mergeCells('S' .  $dtl_row2 . ':S' .  $dtl_row2)->setCellValue('S' .  $dtl_row2, $dta_batubara_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('T' .  $dtl_row2 . ':T' .  $dtl_row2)->setCellValue('T' .  $dtl_row2, $dta_debu_nilai[$arr]);
                    $objPHPExcel->mergeCells('U' .  $dtl_row2 . ':U' .  $dtl_row2)->setCellValue('U' .  $dtl_row2, $dta_debu_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('V' .  $dtl_row2 . ':V' .  $dtl_row2)->setCellValue('V' .  $dtl_row2, $dta_cocopit_nilai[$arr]);
                    $objPHPExcel->mergeCells('W' .  $dtl_row2 . ':W' .  $dtl_row2)->setCellValue('W' .  $dtl_row2, $dta_cocopit_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('X' .  $dtl_row2 . ':X' .  $dtl_row2)->setCellValue('X' .  $dtl_row2, $dta_tempurung_nilai[$arr]);
                    $objPHPExcel->mergeCells('Y' .  $dtl_row2 . ':Y' .  $dtl_row2)->setCellValue('Y' .  $dtl_row2, $dta_tempurung_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('Z' .  $dtl_row2 . ':Z' .  $dtl_row2)->setCellValue('Z' .  $dtl_row2, $dta_bb_nilai[$arr]);
                    $objPHPExcel->mergeCells('AA' .  $dtl_row2 . ':AA' .  $dtl_row2)->setCellValue('AA' .  $dtl_row2, $dta_bb_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('AB' .  $dtl_row2 . ':AB' .  $dtl_row2)->setCellValue('AB' .  $dtl_row2, $dta_sabut_nilai[$arr]);
                    $objPHPExcel->mergeCells('AC' .  $dtl_row2 . ':AC' .  $dtl_row2)->setCellValue('AC' .  $dtl_row2, $dta_sabut_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('AD' .  $dtl_row2 . ':AD' .  $dtl_row2)->setCellValue('AD' .  $dtl_row2, $dta_steam_batubara_nilai[$arr]);
                    $objPHPExcel->mergeCells('AE' .  $dtl_row2 . ':AE' .  $dtl_row2)->setCellValue('AE' .  $dtl_row2, $dta_steam_batubara_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('AF' .  $dtl_row2 . ':AF' .  $dtl_row2)->setCellValue('AF' .  $dtl_row2, $dta_steam_bahanbakar_nilai[$arr]);
                    $objPHPExcel->mergeCells('AG' .  $dtl_row2 . ':AG' .  $dtl_row2)->setCellValue('AG' .  $dtl_row2, $dta_steam_bahanbakar_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('AH' .  $dtl_row2 . ':AH' .  $dtl_row2)->setCellValue('AH' .  $dtl_row2, $dta_operasi_nilai[$arr]);
                    $objPHPExcel->mergeCells('AI' .  $dtl_row2 . ':AI' .  $dtl_row2)->setCellValue('AI' .  $dtl_row2, $dta_operasi_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('AJ' .  $dtl_row2 . ':AJ' .  $dtl_row2)->setCellValue('AJ' .  $dtl_row2, $dta_dearator_nilai[$arr]);
                    $objPHPExcel->mergeCells('AK' .  $dtl_row2 . ':AK' .  $dtl_row2)->setCellValue('AK' .  $dtl_row2, $dta_dearator_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('AL' .  $dtl_row2 . ':AL' .  $dtl_row2)->setCellValue('AL' .  $dtl_row2, $dta_demian_nilai[$arr]);
                    $objPHPExcel->mergeCells('AM' .  $dtl_row2 . ':AM' .  $dtl_row2)->setCellValue('AM' .  $dtl_row2, $dta_demian_akumulatif[$arr]);
                    $objPHPExcel->mergeCells('AN' .  $dtl_row2 . ':AN' .  $dtl_row2)->setCellValue('AN' .  $dtl_row2, $dta_ct_nilai[$arr]);
                    $objPHPExcel->mergeCells('AO' .  $dtl_row2 . ':AO' .  $dtl_row2)->setCellValue('AO' .  $dtl_row2, $dta_ct_akumulatif[$arr]);
                
                $objPHPExcel->setSharedStyle($bodyStyle, 'J' . $dtl_row2 . ':AO' . $dtl_row2);
                // $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($dtl_row2) . ':AO' . ($dtl_row2));
                // $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($dtl_row2) . ':A' .  ($dtl_row2));
                $dtl_row2++;
            }

            $table2 = $dtl_row + 2;

            $objPHPExcel->mergeCells('A' .  ($table2 + 1) . ':A' .  ($table2 + 3))->setCellValue('A' .  ($table2 + 1), 'NO');
            $objPHPExcel->mergeCells('B' .  ($table2 + 1) . ':M' .  ($table2 + 1))->setCellValue('B' .  ($table2 + 1), 'CATATAN KWH TRAFO');
            $objPHPExcel->mergeCells('B' .  ($table2 + 2) . ':B' .  ($table2 + 3))->setCellValue('B' .  ($table2 + 2), 'KODE TRAFO');
            $objPHPExcel->mergeCells('C' .  ($table2 + 2) . ':C' .  ($table2 + 3))->setCellValue('C' .  ($table2 + 2), 'NAMA TRAFO');
            $objPHPExcel->mergeCells('D' .  ($table2 + 2) . ':F' .  ($table2 + 2))->setCellValue('D' .  ($table2 + 2), '6k5 & 6k6');
            $objPHPExcel->mergeCells('D' .  ($table2 + 3) . ':D' .  ($table2 + 3))->setCellValue('D' .  ($table2 + 3), 'RATA2/HARI');
            $objPHPExcel->mergeCells('E' .  ($table2 + 3) . ':E' .  ($table2 + 3))->setCellValue('E' .  ($table2 + 3), 'JAM');
            $objPHPExcel->mergeCells('F' .  ($table2 + 3) . ':F' .  ($table2 + 3))->setCellValue('F' .  ($table2 + 3), 'KWH');
            $objPHPExcel->mergeCells('G' .  ($table2 + 2) . ':M' .  ($table2 + 2))->setCellValue('G' .  ($table2 + 2), '6K1,6K3,6K4,6K8,6K9,6K10,6K11,6K12,6K13,611,622,633,1#IDF,2#IDF,3IDF,1PAF,2#PAF,3PAF');
            $objPHPExcel->mergeCells('G' .  ($table2 + 3) . ':G' .  ($table2 + 3))->setCellValue('G' .  ($table2 + 3), 'READ CT');
            $objPHPExcel->mergeCells('H' .  ($table2 + 3) . ':H' .  ($table2 + 3))->setCellValue('H' .  ($table2 + 3), 'AWAL');
            $objPHPExcel->mergeCells('I' .  ($table2 + 3) . ':I' .  ($table2 + 3))->setCellValue('I' .  ($table2 + 3), 'AKHIR');
            $objPHPExcel->mergeCells('J' .  ($table2 + 3) . ':J' .  ($table2 + 3))->setCellValue('J' .  ($table2 + 3), 'PUTARAN');
            $objPHPExcel->mergeCells('K' .  ($table2 + 3) . ':K' .  ($table2 + 3))->setCellValue('K' .  ($table2 + 3), 'KWH HARI INI');
            $objPHPExcel->mergeCells('L' .  ($table2 + 3) . ':M' .  ($table2 + 3))->setCellValue('L' .  ($table2 + 3), 'AKUMULATIF KWH');
            $objPHPExcel->mergeCells('N' .  ($table2 + 1) . ':R' .  ($table2 + 1))->setCellValue('N' .  ($table2 + 1), 'REKAP BAHAN BAKAR');
            $objPHPExcel->mergeCells('N' .  ($table2 + 2) . ':R' .  ($table2 + 2))->setCellValue('N' .  ($table2 + 2), 'BAHAN BAKAR');
            $objPHPExcel->mergeCells('N' .  ($table2 + 3) . ':O' .  ($table2 + 3))->setCellValue('N' .  ($table2 + 3), 'HARI INI');
            $objPHPExcel->mergeCells('P' .  ($table2 + 3) . ':R' .  ($table2 + 3))->setCellValue('P' .  ($table2 + 3), 'AKUMULATIF');
            $objPHPExcel->mergeCells('S' .  ($table2 + 1) . ':X' .  ($table2 + 1))->setCellValue('S' .  ($table2 + 1), 'EFISIENSI');
            $objPHPExcel->mergeCells('S' .  ($table2 + 2) . ':X' .  ($table2 + 2))->setCellValue('S' .  ($table2 + 2), 'KWH / KG BAHAN BAKAR');
            $objPHPExcel->mergeCells('S' .  ($table2 + 3) . ':V' .  ($table2 + 3))->setCellValue('S' .  ($table2 + 3), 'HARI INI');
            $objPHPExcel->mergeCells('W' .  ($table2 + 3) . ':X' .  ($table2 + 3))->setCellValue('W' .  ($table2 + 3), 'AKUMULATIF');
            $objPHPExcel->mergeCells('Y' .  ($table2 + 1) . ':Z' .  ($table2 + 2))->setCellValue('Y' .  ($table2 + 1), 'JAM OPERASI');
            $objPHPExcel->mergeCells('Y' .  ($table2 + 3) . ':Y' .  ($table2 + 3))->setCellValue('Y' .  ($table2 + 3), 'HARI INI');
            $objPHPExcel->mergeCells('Z' .  ($table2 + 3) . ':Z' .  ($table2 + 3))->setCellValue('Z' .  ($table2 + 3), 'AKM');
            $objPHPExcel->mergeCells('AA' .  ($table2 + 1) . ':AB' .  ($table2 + 2))->setCellValue('AA' .  ($table2 + 1), 'SOLAR');
            $objPHPExcel->mergeCells('AA' .  ($table2 + 3) . ':AA' .  ($table2 + 3))->setCellValue('AA' .  ($table2 + 3), 'HARI INI');
            $objPHPExcel->mergeCells('AB' .  ($table2 + 3) . ':AB' .  ($table2 + 3))->setCellValue('AB' .  ($table2 + 3), 'AKM');
            
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($table2 + 1) . ':AO' . ($table2 + 50));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($table2 + 1) . ':AB' . ($table2 + 3));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($table2) . ':AO' . ($table2 + 2));
            $objPHPExcel->getStyle('C' . ($table2 + 1) . ':AL' . ($table2 + 2))->getFont()->setBold(true)->setSize(9);
            
            $objPHPExcel->mergeCells('AH' .  ($table2 + 1) . ':AK' .  ($table2 + 1))->setCellValue('AH' .  ($table2 + 1), 'Keterangan :');
            $objPHPExcel->mergeCells('AH' .  ($table2 + 3) . ':AK' .  ($table2 + 3))->setCellValue('AH' .  ($table2 + 3), 'Selisih KWH = Total KWH');
            $objPHPExcel->mergeCells('AH' .  ($table2 + 4) . ':AK' .  ($table2 + 4))->setCellValue('AH' .  ($table2 + 4), 'Output Gen - Output KWH');
            $objPHPExcel->mergeCells('AH' .  ($table2 + 5) . ':AK' .  ($table2 + 5))->setCellValue('AH' .  ($table2 + 5), '(Start Transf + 6k1 s/d 6k12 + Oprt TBN)');
            $objPHPExcel->mergeCells('AH' .  ($table2 + 7) . ':AK' .  ($table2 + 7))->setCellValue('AH' .  ($table2 + 7), 'Operasional TBN = ');
            $objPHPExcel->mergeCells('AH' .  ($table2 + 8) . ':AK' .  ($table2 + 8))->setCellValue('AH' .  ($table2 + 8), 'Output KWH Trafo #1 + Trafo #2 + Trafo #3');
            $objPHPExcel->mergeCells('AH' .  ($table2 + 9) . ':AK' .  ($table2 + 9))->setCellValue('AH' .  ($table2 + 9), '(IDF SAF BOILER 1,2 dan 3)');
            $objPHPExcel->mergeCells('AH' .  ($table2 + 19) . ':AK' .  ($table2 + 19))->setCellValue('AH' .  ($table2 + 19), 'KWH Generator 1 = ');
            $objPHPExcel->mergeCells('AH' .  ($table2 + 20) . ':AK' .  ($table2 + 20))->setCellValue('AH' .  ($table2 + 20), 'KWH Generator 2 = ');
            $objPHPExcel->mergeCells('AH' .  ($table2 + 22) . ':AK' .  ($table2 + 22))->setCellValue('AH' .  ($table2 + 22), 'KWH Start Genset = ');
            $objPHPExcel->mergeCells('AH' .  ($table2 + 26) . ':AK' .  ($table2 + 26))->setCellValue('AH' .  ($table2 + 26), 'Total KWH =');
            
            $table2_dtl = $table2 + 4;

            $start_detail2 = ($i1 * $jml_data_perpage_c);
            $finish_detail2 = (($i1 * $jml_data_perpage_c) + ($jml_data_perpage_c - 1));
            
            $nob = 1;
            for ($arrb = $start_detail2; $arrb <= $finish_detail2; $arrb++) {
                  
                if (isset($b_trafo[$arrb])) { $dtb_trafo[$arrb] = $b_trafo[$arrb]; } else { $dtb_trafo[$arrb] = ""; }
                if (isset($b_kwh_akumulatif[$arrb])) { $dtb_kwh_akumulatif[$arrb] = $b_kwh_akumulatif[$arrb]; } else { $dtb_kwh_akumulatif[$arrb] = ""; }
                if (isset($b_bahanbakar_nilai[$arrb])) { $dtb_bahanbakar_nilai[$arrb] = $b_bahanbakar_nilai[$arrb]; } else { $dtb_bahanbakar_nilai[$arrb] = ""; }
                if (isset($b_bahanbakar_akumulatif[$arrb])) { $dtb_bahanbakar_akumulatif[$arrb] = $b_bahanbakar_akumulatif[$arrb]; } else { $dtb_bahanbakar_akumulatif[$arrb] = ""; }
                if (isset($b_kwh_efisiensi_nilai[$arrb])) { $dtb_kwh_efisiensi_nilai[$arrb] = $b_kwh_efisiensi_nilai[$arrb]; } else { $dtb_kwh_efisiensi_nilai[$arrb] = ""; }
                if (isset($b_kwh_efisiensi_akumulatif[$arrb])) { $dtb_kwh_efisiensi_akumulatif[$arrb] = $b_kwh_efisiensi_akumulatif[$arrb]; } else { $dtb_kwh_efisiensi_akumulatif[$arrb] = ""; }
                if (isset($b_operasi_nilai[$arrb])) { $dtb_operasi_nilai[$arrb] = $b_operasi_nilai[$arrb]; } else { $dtb_operasi_nilai[$arrb] = ""; }
                if (isset($b_operasi_akumulatif[$arrb])) { $dtb_operasi_akumulatif[$arrb] = $b_operasi_akumulatif[$arrb]; } else { $dtb_operasi_akumulatif[$arrb] = ""; }
                if (isset($b_solar_nilai[$arrb])) { $dtb_solar_nilai[$arrb] = $b_solar_nilai[$arrb]; } else { $dtb_solar_nilai[$arrb] = ""; }
                if (isset($b_solar_akumulatif[$arrb])) { $dtb_solar_akumulatif[$arrb] = $b_solar_akumulatif[$arrb]; } else { $dtb_solar_akumulatif[$arrb] = ""; }
                if (isset($b_nama_trafo[$arrb])) { $dtb_nama_trafo[$arrb] = $b_nama_trafo[$arrb]; } else { $dtb_nama_trafo[$arrb] = ""; }
                if (isset($b_read_ct_trafo[$arrb])) { $dtb_read_ct_trafo[$arrb] = $b_read_ct_trafo[$arrb]; } else { $dtb_read_ct_trafo[$arrb] = ""; }
                if (isset($b_rata_hari[$arrb])) { $dtb_rata_hari[$arrb] = $b_rata_hari[$arrb]; } else { $dtb_rata_hari[$arrb] = ""; }
                if (isset($b_jam[$arrb])) { $dtb_jam[$arrb] = $b_jam[$arrb]; } else { $dtb_jam[$arrb] = ""; }
                if (isset($b_kwh_6k5_nilai[$arrb])) { $dtb_kwh_6k5_nilai[$arrb] = $b_kwh_6k5_nilai[$arrb]; } else { $dtb_kwh_6k5_nilai[$arrb] = ""; }
                if (isset($b_trafo_awal[$arrb])) { $dtb_trafo_awal[$arrb] = $b_trafo_awal[$arrb]; } else { $dtb_trafo_awal[$arrb] = ""; }
                if (isset($b_trafo_akhir[$arrb])) { $dtb_trafo_akhir[$arrb] = $b_trafo_akhir[$arrb]; } else { $dtb_trafo_akhir[$arrb] = ""; }
                if (isset($b_trafo_putaran[$arrb])) { $dtb_trafo_putaran[$arrb] = $b_trafo_putaran[$arrb]; } else { $dtb_trafo_putaran[$arrb] = ""; }
                if (isset($b_kwh_nilai[$arrb])) { $dtb_kwh_nilai[$arrb] = $b_kwh_nilai[$arrb]; } else { $dtb_kwh_nilai[$arrb] = ""; }

                    $objPHPExcel->mergeCells('A' .  $table2_dtl . ':A' .  $table2_dtl)->setCellValue('A' .  $table2_dtl, $nob++);
                    $objPHPExcel->mergeCells('B' .  $table2_dtl . ':B' .  $table2_dtl)->setCellValue('B' .  $table2_dtl, $dtb_trafo[$arrb]);
                    $objPHPExcel->mergeCells('C' .  $table2_dtl . ':C' .  $table2_dtl)->setCellValue('C' .  $table2_dtl, $dtb_nama_trafo[$arrb]);
                    $objPHPExcel->mergeCells('D' .  $table2_dtl . ':D' .  $table2_dtl)->setCellValue('D' .  $table2_dtl, $dtb_rata_hari[$arrb]);
                    $objPHPExcel->mergeCells('E' .  $table2_dtl . ':E' .  $table2_dtl)->setCellValue('E' .  $table2_dtl, $dtb_jam[$arrb]);
                    $objPHPExcel->mergeCells('F' .  $table2_dtl . ':F' .  $table2_dtl)->setCellValue('F' .  $table2_dtl, $dtb_kwh_6k5_nilai[$arrb]);
                    $objPHPExcel->mergeCells('G' .  $table2_dtl . ':G' .  $table2_dtl)->setCellValue('G' .  $table2_dtl, $dtb_read_ct_trafo[$arrb]);
                    $objPHPExcel->mergeCells('H' .  $table2_dtl . ':H' .  $table2_dtl)->setCellValue('H' .  $table2_dtl, $dtb_trafo_awal[$arrb]);
                    $objPHPExcel->mergeCells('I' .  $table2_dtl . ':I' .  $table2_dtl)->setCellValue('I' .  $table2_dtl, $dtb_trafo_akhir[$arrb]);
                    $objPHPExcel->mergeCells('J' .  $table2_dtl . ':J' .  $table2_dtl)->setCellValue('J' .  $table2_dtl, $dtb_trafo_putaran[$arrb]);
                    $objPHPExcel->mergeCells('K' .  $table2_dtl . ':K' .  $table2_dtl)->setCellValue('K' .  $table2_dtl, $dtb_kwh_nilai[$arrb]);
                    $objPHPExcel->mergeCells('L' .  $table2_dtl . ':M' .  $table2_dtl)->setCellValue('L' .  $table2_dtl, $dtb_kwh_akumulatif[$arrb]);
                    $objPHPExcel->mergeCells('N' .  $table2_dtl . ':O' .  $table2_dtl)->setCellValue('N' .  $table2_dtl, $dtb_bahanbakar_nilai[$arrb]);
                    $objPHPExcel->mergeCells('P' .  $table2_dtl . ':R' .  $table2_dtl)->setCellValue('P' .  $table2_dtl, $dtb_bahanbakar_akumulatif[$arrb]);
                    $objPHPExcel->mergeCells('S' .  $table2_dtl . ':V' .  $table2_dtl)->setCellValue('S' .  $table2_dtl, $dtb_kwh_efisiensi_nilai[$arrb]);
                    $objPHPExcel->mergeCells('W' .  $table2_dtl . ':X' .  $table2_dtl)->setCellValue('W' .  $table2_dtl, $dtb_kwh_efisiensi_akumulatif[$arrb]);
                    $objPHPExcel->mergeCells('Y' .  $table2_dtl . ':Y' .  $table2_dtl)->setCellValue('Y' .  $table2_dtl, $dtb_operasi_nilai[$arrb]);
                    $objPHPExcel->mergeCells('Z' .  $table2_dtl . ':Z' .  $table2_dtl)->setCellValue('Z' .  $table2_dtl, $dtb_operasi_akumulatif[$arrb]);
                    $objPHPExcel->mergeCells('AA' .  $table2_dtl . ':AA' .  $table2_dtl)->setCellValue('AA' .  $table2_dtl, $dtb_solar_nilai[$arrb]);
                    $objPHPExcel->mergeCells('AB' .  $table2_dtl . ':AB' .  $table2_dtl)->setCellValue('AB' .  $table2_dtl, $dtb_solar_akumulatif[$arrb]);

                    $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $table2_dtl . ':AB' . $table2_dtl);
                    $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($table2_dtl) . ':AO' . ($table2_dtl));
                    $table2_dtl++;
                }

                $lanjutan3 = $table2_dtl;
                
                $objPHPExcel->mergeCells('A' .  ($lanjutan3) . ':J' .  ($lanjutan3))->setCellValue('A' .  ($lanjutan3), 'SELISIH KWH TRAFO DAN GENERATOR');
                $objPHPExcel->mergeCells('A' .  ($lanjutan3 + 1) . ':J' .  ($lanjutan3 + 1))->setCellValue('A' .  ($lanjutan3 + 1), 'TOTAL');
                $objPHPExcel->mergeCells('K' .  ($lanjutan3) . ':K' .  ($lanjutan3))->setCellValue('K' .  ($lanjutan3), $selisih_kwh_generator);
                $objPHPExcel->mergeCells('K' .  ($lanjutan3 + 1) . ':K' .  ($lanjutan3 + 1))->setCellValue('K' .  ($lanjutan3 + 1), $total_dtl_b_kwh_nilai);
                $objPHPExcel->mergeCells('L' .  ($lanjutan3) . ':AB' .  ($lanjutan3))->setCellValue('L' .  ($lanjutan3), '');
                $objPHPExcel->mergeCells('L' .  ($lanjutan3 + 1) . ':M' .  ($lanjutan3 + 1))->setCellValue('L' .  ($lanjutan3 + 1), $total_dtl_b_kwh_akumulatif);
                $objPHPExcel->mergeCells('N' .  ($lanjutan3 + 1) . ':O' .  ($lanjutan3 + 1))->setCellValue('N' .  ($lanjutan3 + 1), $total_dtl_b_bahanbakar_nilai);
                $objPHPExcel->mergeCells('P' .  ($lanjutan3 + 1) . ':R' .  ($lanjutan3 + 1))->setCellValue('P' .  ($lanjutan3 + 1), $total_dtl_b_bahanbakar_akumulatif);
                $objPHPExcel->mergeCells('S' .  ($lanjutan3 + 1) . ':V' .  ($lanjutan3 + 1))->setCellValue('S' .  ($lanjutan3 + 1), $total_dtl_b_kwh_efisiensi_nilai);
                $objPHPExcel->mergeCells('W' .  ($lanjutan3 + 1) . ':X' .  ($lanjutan3 + 1))->setCellValue('W' .  ($lanjutan3 + 1), $total_dtl_b_kwh_efisiensi_akumulatif);
                $objPHPExcel->mergeCells('Y' .  ($lanjutan3 + 1) . ':Y' .  ($lanjutan3 + 1))->setCellValue('Y' .  ($lanjutan3 + 1), $total_dtl_b_operasi_nilai);
                $objPHPExcel->mergeCells('Z' .  ($lanjutan3 + 1) . ':Z' .  ($lanjutan3 + 1))->setCellValue('Z' .  ($lanjutan3 + 1), $total_dtl_b_operasi_akumulatif);
                $objPHPExcel->mergeCells('AA' .  ($lanjutan3 + 1) . ':AA' .  ($lanjutan3 + 1))->setCellValue('AA' .  ($lanjutan3 + 1), $total_dtl_b_solar_nilai);
                $objPHPExcel->mergeCells('AB' .  ($lanjutan3 + 1) . ':AB' .  ($lanjutan3 + 1))->setCellValue('AB' .  ($lanjutan3 + 1), $total_dtl_b_solar_akumulatif);
                
                $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($lanjutan3) . ':AB' . ($lanjutan3 + 1));

                $table3 = $lanjutan3 + 2;
                
                $objPHPExcel->setSharedStyle($noborderStyle,  'A' .  ($table3) . ':AO' .  ($table3 + 12)); 
                
                $objPHPExcel->mergeCells('A' .  ($table3 + 1) . ':G' .  ($table3 + 1))->setCellValue('A' .  ($table3 + 1), 'DEPARTEMENT');
                $objPHPExcel->mergeCells('A' .  ($table3 + 2) . ':A' .  ($table3 + 2))->setCellValue('A' .  ($table3 + 2), 'NO');
                $objPHPExcel->mergeCells('B' .  ($table3 + 2) . ':B' .  ($table3 + 2))->setCellValue('B' .  ($table3 + 2), 'KODE');
                $objPHPExcel->mergeCells('C' .  ($table3 + 2) . ':C' .  ($table3 + 2))->setCellValue('C' .  ($table3 + 2), 'READING CT');
                $objPHPExcel->mergeCells('D' .  ($table3 + 2) . ':G' .  ($table3 + 2))->setCellValue('D' .  ($table3 + 2), 'NAMA');
                $objPHPExcel->mergeCells('H' .  ($table3 + 1) . ':J' .  ($table3 + 1))->setCellValue('H' .  ($table3 + 1), '6K6');
                $objPHPExcel->mergeCells('H' .  ($table3 + 2) . ':H' .  ($table3 + 2))->setCellValue('H' .  ($table3 + 2), 'RATA2/HARI');
                $objPHPExcel->mergeCells('I' .  ($table3 + 2) . ':I' .  ($table3 + 2))->setCellValue('I' .  ($table3 + 2), 'JAM OPERASI');
                $objPHPExcel->mergeCells('J' .  ($table3 + 2) . ':J' .  ($table3 + 2))->setCellValue('J' .  ($table3 + 2), 'KWH');
                $objPHPExcel->mergeCells('K' .  ($table3 + 1) . ':L' .  ($table3 + 1))->setCellValue('K' .  ($table3 + 1), 'BELUM ADA METERAN SENDIRI');
                $objPHPExcel->mergeCells('K' .  ($table3 + 2) . ':K' .  ($table3 + 2))->setCellValue('K' .  ($table3 + 2), 'BEBAN TETAP/HARI BERDASARKAN %');
                $objPHPExcel->mergeCells('L' .  ($table3 + 2) . ':L' .  ($table3 + 2))->setCellValue('L' .  ($table3 + 2), 'BEBAN TETAP/HARI');
                $objPHPExcel->mergeCells('M' .  ($table3 + 1) . ':P' .  ($table3 + 1))->setCellValue('M' .  ($table3 + 1), 'CATATAN KWH METERAN');
                $objPHPExcel->mergeCells('M' .  ($table3 + 2) . ':M' .  ($table3 + 2))->setCellValue('M' .  ($table3 + 2), 'AWAL');
                $objPHPExcel->mergeCells('N' .  ($table3 + 2) . ':N' .  ($table3 + 2))->setCellValue('N' .  ($table3 + 2), 'AKHIR');
                $objPHPExcel->mergeCells('O' .  ($table3 + 2) . ':O' .  ($table3 + 2))->setCellValue('O' .  ($table3 + 2), 'PUTARAN');
                $objPHPExcel->mergeCells('P' .  ($table3 + 2) . ':P' .  ($table3 + 2))->setCellValue('P' .  ($table3 + 2), 'KWH');
                $objPHPExcel->mergeCells('Q' .  ($table3 + 1) . ':Q' .  ($table3 + 2))->setCellValue('Q' .  ($table3 + 1), 'PAKAI KWH REAL HARI INI');
                $objPHPExcel->mergeCells('R' .  ($table3 + 1) . ':R' .  ($table3 + 2))->setCellValue('R' .  ($table3 + 1), 'NO');
                $objPHPExcel->mergeCells('S' .  ($table3 + 1) . ':X' .  ($table3 + 2))->setCellValue('S' .  ($table3 + 1), 'DEPARTEMENT');
                $objPHPExcel->mergeCells('Y' .  ($table3 + 1) . ':AA' .  ($table3 + 1))->setCellValue('Y' .  ($table3 + 1), 'KWH');
                $objPHPExcel->mergeCells('Y' .  ($table3 + 2) . ':Y' .  ($table3 + 2))->setCellValue('Y' .  ($table3 + 2), 'PAKAI KWH REAL HARI INI');
                $objPHPExcel->mergeCells('Z' .  ($table3 + 2) . ':Z' .  ($table3 + 2))->setCellValue('Z' .  ($table3 + 2), 'LOSS KWH HARI INI');
                $objPHPExcel->mergeCells('AA' .  ($table3 + 2) . ':AA' .  ($table3 + 2))->setCellValue('AA' .  ($table3 + 2), 'TOTAL KWH HARI INI');
                $objPHPExcel->mergeCells('AB' .  ($table3 + 1) . ':AB' .  ($table3 + 2))->setCellValue('AB' .  ($table3 + 1), '%');
                $objPHPExcel->mergeCells('AC' .  ($table3 + 1) . ':AC' .  ($table3 + 2))->setCellValue('AC' .  ($table3 + 1), "AKUMULATIF \n KWH");
                $objPHPExcel->mergeCells('AD' .  ($table3 + 1) . ':AD' .  ($table3 + 2))->setCellValue('AD' .  ($table3 + 1), '%');
                $objPHPExcel->mergeCells('AE' .  ($table3 + 1) . ':AE' .  ($table3 + 2))->setCellValue('AE' .  ($table3 + 1), 'PEMAKAIAN BAHAN BAKAR');
                $objPHPExcel->mergeCells('AF' .  ($table3 + 1) . ':AF' .  ($table3 + 2))->setCellValue('AF' .  ($table3 + 1), "AKUMULATIF \n BAHAN BAKAR");

            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($table3) . ':AO' . ($table3 + 275));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($table3 - 1) . ':AO' . ($table3 + 2));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A' . ($table3 + 1) . ':AF' . ($table3 + 2));
            // $objPHPExcel->getStyle('C' . ($table3 + 1) . ':AD' . ($table3 + 2))->getFont()->setBold(true)->setSize(9);
              
            $table3_dtl = $table3 + 3;
            $start_detail3 = ($i1 * $jml_data_perpage_e);
            $finish_detail3 = (($i1 * $jml_data_perpage_e) + ($jml_data_perpage_e - 1));

            $noc = 1;
            for ($arrc = $start_detail3; $arrc <= $finish_detail3; $arrc++) {
                if (isset($c_dept_panel[$arrc])) { $dtc_dept_panel[$arrc] = $c_dept_panel[$arrc]; } else { $dtc_dept_panel[$arrc] = ""; }
                if (isset($c_kwh_awal[$arrc])) { $dtc_kwh_awal[$arrc] = $c_kwh_awal[$arrc]; } else { $dtc_kwh_awal[$arrc] = ""; }
                if (isset($c_kwh_akhir[$arrc])) { $dtc_kwh_akhir[$arrc] = $c_kwh_akhir[$arrc]; } else { $dtc_kwh_akhir[$arrc] = ""; }
                if (isset($c_putaran_hasil[$arrc])) { $dtc_putaran_hasil[$arrc] = $c_putaran_hasil[$arrc]; } else { $dtc_putaran_hasil[$arrc] = ""; }
                if (isset($c_kwh_nilai[$arrc])) { $dtc_kwh_nilai[$arrc] = $c_kwh_nilai[$arrc]; } else { $dtc_kwh_nilai[$arrc] = ""; }
                if (isset($c_kode_kwh[$arrc])) { $dtc_kode_kwh[$arrc] = $c_kode_kwh[$arrc]; } else { $dtc_kode_kwh[$arrc] = ""; }
                if (isset($c_reading_ct[$arrc])) { $dtc_reading_ct[$arrc] = $c_reading_ct[$arrc]; } else { $dtc_reading_ct[$arrc] = ""; }
                if (isset($c_dept_user[$arrc])) { $dtc_dept_user[$arrc] = $c_dept_user[$arrc]; } else { $dtc_dept_user[$arrc] = ""; }
                if (isset($c_status_beban[$arrc])) { $dtc_status_beban[$arrc] = $c_status_beban[$arrc]; } else { $dtc_status_beban[$arrc] = ""; }
                if (isset($c_rata_hari[$arrc])) { $dtc_rata_hari[$arrc] = $c_rata_hari[$arrc]; } else { $dtc_rata_hari[$arrc] = ""; }
                if (isset($c_jam_operasi[$arrc])) { $dtc_jam_operasi[$arrc] = $c_jam_operasi[$arrc]; } else { $dtc_jam_operasi[$arrc] = ""; }
                if (isset($c_kwh_6k6_hasil[$arrc])) { $dtc_kwh_6k6_hasil[$arrc] = $c_kwh_6k6_hasil[$arrc]; } else { $dtc_kwh_6k6_hasil[$arrc] = ""; }
                if (isset($c_beban_persen[$arrc])) { $dtc_beban_persen[$arrc] = $c_beban_persen[$arrc]; } else { $dtc_beban_persen[$arrc] = ""; }
                if (isset($c_beban[$arrc])) { $dtc_beban[$arrc] = $c_beban[$arrc]; } else { $dtc_beban[$arrc] = ""; }
                if (isset($c_kwh_real_nilai[$arrc])) {
                    if($dtc_status_beban != 'TIDAK'){
                        $dtc_kwh_real_nilai[$arrc] = $c_kwh_real_nilai[$arrc]; 
                   } else {
                            $dtc_kwh_real_nilai[$arrc] = ""; 
                           }
                    } else {
                        $dtc_kwh_real_nilai[$arrc] = ""; 
                       }

                if (isset($c_beban_persen_fix[$arrc])) { $dtc_beban_persen_fix[$arrc] = $c_beban_persen_fix[$arrc]; } else { $dtc_beban_persen_fix[$arrc] = ""; }
                if (isset($c_dtl_c_item_id[$arrc])) { $dtc_dtl_c_item_id[$arrc] = $c_dtl_c_item_id[$arrc]; } else { $dtc_dtl_c_item_id[$arrc] = ""; }
                
                    $objPHPExcel->mergeCells('A' .  $table3_dtl . ':A' .  $table3_dtl)->setCellValue('A' .  $table3_dtl, $noc++);
                    $objPHPExcel->mergeCells('B' .  $table3_dtl . ':B' .  $table3_dtl)->setCellValue('B' .  $table3_dtl, $dtc_kode_kwh[$arrc]);
                    $objPHPExcel->mergeCells('C' .  $table3_dtl . ':C' .  $table3_dtl)->setCellValue('C' .  $table3_dtl, $dtc_reading_ct[$arrc]);
                    $objPHPExcel->mergeCells('D' .  $table3_dtl . ':G' .  $table3_dtl)->setCellValue('D' .  $table3_dtl, $dtc_dept_panel[$arrc]);
                    $objPHPExcel->mergeCells('H' .  $table3_dtl . ':H' .  $table3_dtl)->setCellValue('H' .  $table3_dtl, $dtc_rata_hari[$arrc]);
                    $objPHPExcel->mergeCells('I' .  $table3_dtl . ':I' .  $table3_dtl)->setCellValue('I' .  $table3_dtl, $dtc_jam_operasi[$arrc]);
                    $objPHPExcel->mergeCells('J' .  $table3_dtl . ':J' .  $table3_dtl)->setCellValue('J' .  $table3_dtl, $dtc_kwh_6k6_hasil[$arrc]);
                    $objPHPExcel->mergeCells('K' .  $table3_dtl . ':K' .  $table3_dtl)->setCellValue('K' .  $table3_dtl, $dtc_beban_persen[$arrc]);
                    $objPHPExcel->mergeCells('L' .  $table3_dtl . ':L' .  $table3_dtl)->setCellValue('L' .  $table3_dtl, $dtc_beban[$arrc]);
                    $objPHPExcel->mergeCells('M' .  $table3_dtl . ':M' .  $table3_dtl)->setCellValue('M' .  $table3_dtl, $dtc_kwh_awal[$arrc]);
                    $objPHPExcel->mergeCells('N' .  $table3_dtl . ':N' .  $table3_dtl)->setCellValue('N' .  $table3_dtl, $dtc_kwh_akhir[$arrc]);
                    $objPHPExcel->mergeCells('O' .  $table3_dtl . ':O' .  $table3_dtl)->setCellValue('O' .  $table3_dtl, $dtc_putaran_hasil[$arrc]);
                    $objPHPExcel->mergeCells('P' .  $table3_dtl . ':P' .  $table3_dtl)->setCellValue('P' .  $table3_dtl, $dtc_kwh_nilai[$arrc]);
                    if($dtc_status_beban[$arrc] == 'TIDAK'){
                        $objPHPExcel->mergeCells('Q' .  $table3_dtl . ':Q' .  $table3_dtl)->setCellValue('Q' .  $table3_dtl, '');
                    }else {
                        $objPHPExcel->mergeCells('Q' .  $table3_dtl . ':Q' .  $table3_dtl)->setCellValue('Q' .  $table3_dtl, $dtc_kwh_real_nilai[$arrc]);
                    }
                    // $objPHPExcel->mergeCells('Q' .  $table3_dtl . ':Q' .  $table3_dtl)->setCellValue('Q' .  $table3_dtl, $c_kwh_fix[$arrc]);
                    
                $objPHPExcel->setSharedStyle($bodyStyle, 'A' . $table3_dtl . ':Q' . $table3_dtl);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($table3_dtl) . ':AO' . ($table3_dtl));
                // $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' .  ($table3_dtl) . ':A' .  ($table3_dtl));
                $table3_dtl++;
            }
            $objPHPExcel->mergeCells('I' .  ($table3_dtl) . ':P' .  ($table3_dtl))->setCellValue('I' .  ($table3_dtl), 'Total Real Pakai merupakan akumulatif kesesluruhan, (kecuali yang berwarna merah)');
            $objPHPExcel->mergeCells('Q' .  ($table3_dtl) . ':Q' .  ($table3_dtl))->setCellValue('Q' .  ($table3_dtl), $total_real_pakai);
            $objPHPExcel->mergeCells('M' .  ($table3_dtl + 2) . ':P' .  ($table3_dtl + 2))->setCellValue('M' .  ($table3_dtl + 2), 'KWH Generator 1');
            $objPHPExcel->mergeCells('Q' .  ($table3_dtl + 2) . ':Q' .  ($table3_dtl + 2))->setCellValue('Q' .  ($table3_dtl + 2), $total_kwh_generator1_nilai);
            $objPHPExcel->mergeCells('M' .  ($table3_dtl + 3) . ':P' .  ($table3_dtl + 3))->setCellValue('M' .  ($table3_dtl + 3), 'KWH Generator 2');
            $objPHPExcel->mergeCells('Q' .  ($table3_dtl + 3) . ':Q' .  ($table3_dtl + 3))->setCellValue('Q' .  ($table3_dtl + 3), $total_kwh_generator2_nilai);
            $objPHPExcel->mergeCells('M' .  ($table3_dtl + 4) . ':P' .  ($table3_dtl + 4))->setCellValue('M' .  ($table3_dtl + 4), 'Star Gengset');
            $objPHPExcel->mergeCells('Q' .  ($table3_dtl + 4) . ':Q' .  ($table3_dtl + 4))->setCellValue('Q' .  ($table3_dtl + 4), $total_star_genset);
            $objPHPExcel->mergeCells('M' .  ($table3_dtl + 5) . ':P' .  ($table3_dtl + 5))->setCellValue('M' .  ($table3_dtl + 5), 'Total');
            $objPHPExcel->mergeCells('Q' .  ($table3_dtl + 5) . ':Q' .  ($table3_dtl + 5))->setCellValue('Q' .  ($table3_dtl + 5), $total_generator);
            $objPHPExcel->mergeCells('I' .  ($table3_dtl + 7) . ':P' .  ($table3_dtl + 7))->setCellValue('I' .  ($table3_dtl + 7), 'Total Loss Merupakan Selisih dari output Generator 1 +  Generator 2 +  Star genset dikurang total pakai kwh real hari ini');
            $objPHPExcel->mergeCells('Q' .  ($table3_dtl + 7) . ':Q' .  ($table3_dtl + 7))->setCellValue('Q' .  ($table3_dtl + 7), $total_kwh_loss_nilai);

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'I' . ($table3_dtl) . ':Q' . ($table3_dtl));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'M' . ($table3_dtl + 2) . ':Q' . ($table3_dtl + 5));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'I' . ($table3_dtl + 7) . ':Q' . ($table3_dtl + 7));
            
            // print_r($total_dtlc_total_jam);exit();
            $table4_dtl = $table3 + 3;

            $start_detail4 = ($i1 * $jml_data_perpage_d);
            $finish_detail4 = (($i1 * $jml_data_perpage_d) + ($jml_data_perpage_d - 1));

            $NOD = 1;
            for ($arrd = $start_detail4; $arrd <= $finish_detail4; $arrd++) {

                if (isset($d_pemakai_panel[$arrd])) { $dtd_pemakai_panel[$arrd] = $d_pemakai_panel[$arrd]; } else { $dtd_pemakai_panel[$arrd] = ""; }
                if (isset($d_pemakai_kwh[$arrd])) { $dtd_pemakai_kwh[$arrd] = $d_pemakai_kwh[$arrd]; } else { $dtd_pemakai_kwh[$arrd] = ""; }
                if (isset($d_pemakai_persen[$arrd])) { $dtd_pemakai_persen[$arrd] = $d_pemakai_persen[$arrd]; } else { $dtd_pemakai_persen[$arrd] = ""; }
                if (isset($d_pemakai_akumulatif[$arrd])) { $dtd_pemakai_akumulatif[$arrd] = $d_pemakai_akumulatif[$arrd]; } else { $dtd_pemakai_akumulatif[$arrd] = ""; }
                if (isset($d_bahan_bakar_kwh[$arrd])) { $dtd_bahan_bakar_kwh[$arrd] = $d_bahan_bakar_kwh[$arrd]; } else { $dtd_bahan_bakar_kwh[$arrd] = ""; }
                if (isset($d_bahan_bakar_persen[$arrd])) { $dtd_bahan_bakar_persen[$arrd] = $d_bahan_bakar_persen[$arrd]; } else { $dtd_bahan_bakar_persen[$arrd] = ""; }
                if (isset($d_bahan_bakar_akumulatif[$arrd])) { $dtd_bahan_bakar_akumulatif[$arrd] = $d_bahan_bakar_akumulatif[$arrd]; } else { $dtd_bahan_bakar_akumulatif[$arrd] = ""; }
                if (isset($d_pemakai_kwh_loss[$arrd])) { $dtd_pemakai_kwh_loss[$arrd] = $d_pemakai_kwh_loss[$arrd]; } else { $dtd_pemakai_kwh_loss[$arrd] = ""; }
                if (isset($d_pemakai_kwh_total[$arrd])) { $dtd_pemakai_kwh_total[$arrd] = $d_pemakai_kwh_total[$arrd]; } else { $dtd_pemakai_kwh_total[$arrd] = ""; }
                if (isset($d_id_pemakai_panel[$arrd])) { $dtd_id_pemakai_panel[$arrd] = $d_id_pemakai_panel[$arrd]; } else { $dtd_id_pemakai_panel[$arrd] = ""; }
                
                    $objPHPExcel->mergeCells('R' .  $table4_dtl . ':R' .  $table4_dtl)->setCellValue('R' .  $table4_dtl, $NOD++);
                    $objPHPExcel->mergeCells('S' .  $table4_dtl . ':X' .  $table4_dtl)->setCellValue('S' .  $table4_dtl, $dtd_pemakai_panel[$arrd]);
                    $objPHPExcel->mergeCells('Y' .  $table4_dtl . ':Y' .  $table4_dtl)->setCellValue('Y' .  $table4_dtl, $dtd_pemakai_kwh[$arrd]);
                    $objPHPExcel->mergeCells('Z' .  $table4_dtl . ':Z' .  $table4_dtl)->setCellValue('Z' .  $table4_dtl, $dtd_pemakai_kwh_loss[$arrd]);
                    $objPHPExcel->mergeCells('AA' .  $table4_dtl . ':AA' .  $table4_dtl)->setCellValue('AA' .  $table4_dtl, $dtd_pemakai_kwh_total[$arrd]);
                    $objPHPExcel->mergeCells('AB' .  $table4_dtl . ':AB' .  $table4_dtl)->setCellValue('AB' .  $table4_dtl, $dtd_pemakai_persen[$arrd]);
                    $objPHPExcel->mergeCells('AC' .  $table4_dtl . ':AC' .  $table4_dtl)->setCellValue('AC' .  $table4_dtl, $dtd_pemakai_akumulatif[$arrd]);
                    $objPHPExcel->mergeCells('AD' .  $table4_dtl . ':AD' .  $table4_dtl)->setCellValue('AD' .  $table4_dtl, $dtd_bahan_bakar_persen[$arrd]);
                    $objPHPExcel->mergeCells('AE' .  $table4_dtl . ':AE' .  $table4_dtl)->setCellValue('AE' .  $table4_dtl, $dtd_bahan_bakar_kwh[$arrd]);
                    $objPHPExcel->mergeCells('AF' .  $table4_dtl . ':AF' .  $table4_dtl)->setCellValue('AF' .  $table4_dtl, $dtd_bahan_bakar_akumulatif[$arrd]);

                $objPHPExcel->setSharedStyle($bodyStyle, 'R' . $table4_dtl . ':AF' . $table4_dtl);
                $table4_dtl++;
            }
            
            $keteragan = $table4_dtl + 2;
            
              $objPHPExcel->mergeCells('R' .  ($table4_dtl) . ':X' .  ($table4_dtl))->setCellValue('R' .  ($table4_dtl), 'TOTAL');
              $objPHPExcel->mergeCells('Y' .  ($table4_dtl) . ':Y' .  ($table4_dtl))->setCellValue('Y' .  ($table4_dtl), $total_dtl_d_pemakai_kwh);
              $objPHPExcel->mergeCells('Z' .  ($table4_dtl) . ':Z' .  ($table4_dtl))->setCellValue('Z' .  ($table4_dtl), $total_dtl_d_pemakai_kwh_loss);
              $objPHPExcel->mergeCells('AA' .  ($table4_dtl) . ':AA' .  ($table4_dtl))->setCellValue('AA' .  ($table4_dtl), $total_dtl_d_pemakai_kwh_total);
              $objPHPExcel->mergeCells('AB' .  ($table4_dtl) . ':AB' .  ($table4_dtl))->setCellValue('AB' .  ($table4_dtl), $total_dtl_d_pemakai_persen);
              $objPHPExcel->mergeCells('AC' .  ($table4_dtl) . ':AC' .  ($table4_dtl))->setCellValue('AC' .  ($table4_dtl), $total_dtl_d_pemakai_akumulatif);
              $objPHPExcel->mergeCells('AD' .  ($table4_dtl) . ':AD' .  ($table4_dtl))->setCellValue('AD' .  ($table4_dtl), $total_dtl_d_bahan_bakar_persen);
              $objPHPExcel->mergeCells('AE' .  ($table4_dtl) . ':AE' .  ($table4_dtl))->setCellValue('AE' .  ($table4_dtl), $total_dtl_d_bahan_bakar_kwh);
              $objPHPExcel->mergeCells('AF' .  ($table4_dtl) . ':AF' .  ($table4_dtl))->setCellValue('AF' .  ($table4_dtl), $total_dtl_d_bahan_bakar_akumulatif);
              $objPHPExcel->setSharedStyle($DetailheaderStyle, 'R' . $table4_dtl . ':AF' . $table4_dtl);

            $objPHPExcel->mergeCells('T' . ($keteragan) . ':V' .  ($keteragan))->setCellValue('T' .  ($keteragan), 'Efisiensi Bahan Bakar / Steam');
            $objPHPExcel->mergeCells('T' . ($keteragan + 1) . ':V' .  ($keteragan + 1))->setCellValue('T' .  ($keteragan + 1), '*1 Ton Steam');
            $objPHPExcel->mergeCells('T' . ($keteragan + 2) . ':V' .  ($keteragan + 2))->setCellValue('T' .  ($keteragan + 2), '*1 Kg BB');

            $objPHPExcel->mergeCells('T' . ($keteragan + 4) . ':V' .  ($keteragan + 4))->setCellValue('T' .  ($keteragan + 4), 'Stock Batubara');

            $objPHPExcel->mergeCells('T' . ($keteragan + 6) . ':V' .  ($keteragan + 6))->setCellValue('T' .  ($keteragan + 6), 'Target Efisiensi :');
            $objPHPExcel->mergeCells('T' . ($keteragan + 7) . ':V' .  ($keteragan + 7))->setCellValue('T' .  ($keteragan + 7), 'Solar ( KWH/LTR )');
            $objPHPExcel->mergeCells('T' . ($keteragan + 8) . ':V' .  ($keteragan + 8))->setCellValue('T' .  ($keteragan + 8), 'Bahan Bakar ( KWH/KG )');
            $objPHPExcel->mergeCells('T' . ($keteragan + 9) . ':V' .  ($keteragan + 9))->setCellValue('T' .  ($keteragan + 9), 'Steam/Bahan Bakar');
            $objPHPExcel->mergeCells('T' . ($keteragan + 10) . ':V' .  ($keteragan + 10))->setCellValue('T' .  ($keteragan + 10), 'Steam/KWH');

            $objPHPExcel->mergeCells('T' . ($keteragan + 12) . ':V' .  ($keteragan + 12))->setCellValue('T' .  ($keteragan + 12), 'Definisi :');
            $objPHPExcel->mergeCells('T' . ($keteragan + 13) . ':V' .  ($keteragan + 13))->setCellValue('T' .  ($keteragan + 13), 'KWH');
            $objPHPExcel->mergeCells('T' . ($keteragan + 14) . ':V' .  ($keteragan + 14))->setCellValue('T' .  ($keteragan + 14), 'PMK');
            $objPHPExcel->mergeCells('T' . ($keteragan + 15) . ':V' .  ($keteragan + 15))->setCellValue('T' .  ($keteragan + 15), 'WTP');
            $objPHPExcel->mergeCells('T' . ($keteragan + 16) . ':V' .  ($keteragan + 16))->setCellValue('T' .  ($keteragan + 16), 'DWP');
            $objPHPExcel->mergeCells('T' . ($keteragan + 17) . ':V' .  ($keteragan + 17))->setCellValue('T' .  ($keteragan + 17), 'CMP');
            $objPHPExcel->mergeCells('T' . ($keteragan + 18) . ':V' .  ($keteragan + 18))->setCellValue('T' .  ($keteragan + 18), 'CPS');
            $objPHPExcel->mergeCells('T' . ($keteragan + 19) . ':V' .  ($keteragan + 19))->setCellValue('T' .  ($keteragan + 19), 'MPD');
            $objPHPExcel->mergeCells('T' . ($keteragan + 20) . ':V' .  ($keteragan + 20))->setCellValue('T' .  ($keteragan + 20), 'RMP');
            $objPHPExcel->mergeCells('T' . ($keteragan + 21) . ':V' .  ($keteragan + 21))->setCellValue('T' .  ($keteragan + 21), 'SPD');
            $objPHPExcel->mergeCells('T' . ($keteragan + 22) . ':V' .  ($keteragan + 22))->setCellValue('T' .  ($keteragan + 22), 'PWH');
            $objPHPExcel->mergeCells('T' . ($keteragan + 23) . ':V' .  ($keteragan + 23))->setCellValue('T' .  ($keteragan + 23), 'WTD');
            $objPHPExcel->mergeCells('T' . ($keteragan + 24) . ':V' .  ($keteragan + 24))->setCellValue('T' .  ($keteragan + 24), 'WTP/CHL');
            $objPHPExcel->mergeCells('T' . ($keteragan + 25) . ':V' .  ($keteragan + 25))->setCellValue('T' .  ($keteragan + 25), 'MWS');
            $objPHPExcel->mergeCells('T' . ($keteragan + 26) . ':V' .  ($keteragan + 26))->setCellValue('T' .  ($keteragan + 26), 'CST');
            $objPHPExcel->mergeCells('T' . ($keteragan + 27) . ':V' .  ($keteragan + 27))->setCellValue('T' .  ($keteragan + 27), 'PIS');
            $objPHPExcel->mergeCells('T' . ($keteragan + 28) . ':V' .  ($keteragan + 28))->setCellValue('T' .  ($keteragan + 28), 'QSD');
            $objPHPExcel->mergeCells('T' . ($keteragan + 29) . ':V' .  ($keteragan + 29))->setCellValue('T' .  ($keteragan + 29), 'BMD');
            $objPHPExcel->mergeCells('T' . ($keteragan + 30) . ':V' .  ($keteragan + 30))->setCellValue('T' .  ($keteragan + 30), 'ATP');
            $objPHPExcel->mergeCells('T' . ($keteragan + 31) . ':V' .  ($keteragan + 31))->setCellValue('T' .  ($keteragan + 31), 'HED');
            $objPHPExcel->mergeCells('T' . ($keteragan + 32) . ':V' .  ($keteragan + 32))->setCellValue('T' .  ($keteragan + 32), 'C.OFC');
            $objPHPExcel->mergeCells('T' . ($keteragan + 33) . ':V' .  ($keteragan + 33))->setCellValue('T' .  ($keteragan + 33), 'QAD');
            $objPHPExcel->mergeCells('T' . ($keteragan + 34) . ':V' .  ($keteragan + 34))->setCellValue('T' .  ($keteragan + 34), 'PHD/WHS');
            $objPHPExcel->mergeCells('T' . ($keteragan + 35) . ':V' .  ($keteragan + 35))->setCellValue('T' .  ($keteragan + 35), 'GAF');
            $objPHPExcel->mergeCells('T' . ($keteragan + 36) . ':V' .  ($keteragan + 36))->setCellValue('T' .  ($keteragan + 36), 'PSN');
            $objPHPExcel->mergeCells('T' . ($keteragan + 37) . ':V' .  ($keteragan + 37))->setCellValue('T' .  ($keteragan + 37), 'CT. PWH');
            $objPHPExcel->mergeCells('T' . ($keteragan + 38) . ':V' .  ($keteragan + 38))->setCellValue('T' .  ($keteragan + 38), 'Loss Turbin');
            $objPHPExcel->mergeCells('T' . ($keteragan + 39) . ':V' .  ($keteragan + 39))->setCellValue('T' .  ($keteragan + 39), 'BB');
            $objPHPExcel->mergeCells('T' . ($keteragan + 40) . ':V' .  ($keteragan + 40))->setCellValue('T' .  ($keteragan + 40), 'PAKAI BB');
            $objPHPExcel->mergeCells('T' . ($keteragan + 41) . ':V' .  ($keteragan + 41))->setCellValue('T' .  ($keteragan + 41), 'STEAM T/Kg');
            $objPHPExcel->mergeCells('T' . ($keteragan + 42) . ':V' .  ($keteragan + 42))->setCellValue('T' .  ($keteragan + 42), 'CLN');

            
            $objPHPExcel->mergeCells('X' . ($keteragan + 13) . ':AB' .  ($keteragan + 13))->setCellValue('X' .  ($keteragan + 13), ': Kilowatt / jam');
            $objPHPExcel->mergeCells('X' . ($keteragan + 14) . ':AB' .  ($keteragan + 14))->setCellValue('X' .  ($keteragan + 14), ': Pengolahan Minyak Kelapa');
            $objPHPExcel->mergeCells('X' . ($keteragan + 15) . ':AB' .  ($keteragan + 15))->setCellValue('X' .  ($keteragan + 15), ': Wet Process');
            $objPHPExcel->mergeCells('X' . ($keteragan + 16) . ':AB' .  ($keteragan + 16))->setCellValue('X' .  ($keteragan + 16), ': Drinking Water');
            $objPHPExcel->mergeCells('X' . ($keteragan + 17) . ':AB' .  ($keteragan + 17))->setCellValue('X' .  ($keteragan + 17), ': Coconut Milk Powder');
            $objPHPExcel->mergeCells('X' . ($keteragan + 18) . ':AB' .  ($keteragan + 18))->setCellValue('X' .  ($keteragan + 18), ': Coconut Paster & Square');
            $objPHPExcel->mergeCells('X' . ($keteragan + 19) . ':AB' .  ($keteragan + 19))->setCellValue('X' .  ($keteragan + 19), ': Meat Preparation Dept.');
            $objPHPExcel->mergeCells('X' . ($keteragan + 20) . ':AB' .  ($keteragan + 20))->setCellValue('X' .  ($keteragan + 20), ': Raw Material Purcashing');
            $objPHPExcel->mergeCells('X' . ($keteragan + 21) . ':AB' .  ($keteragan + 21))->setCellValue('X' .  ($keteragan + 21), ': Santan Press Departement');
            $objPHPExcel->mergeCells('X' . ($keteragan + 22) . ':AB' .  ($keteragan + 22))->setCellValue('X' .  ($keteragan + 22), ': Power House');
            $objPHPExcel->mergeCells('X' . ($keteragan + 23) . ':AB' .  ($keteragan + 23))->setCellValue('X' .  ($keteragan + 23), ': Water Treatement');
            $objPHPExcel->mergeCells('X' . ($keteragan + 24) . ':AB' .  ($keteragan + 24))->setCellValue('X' .  ($keteragan + 24), ': WTP / Chiller');
            $objPHPExcel->mergeCells('X' . ($keteragan + 25) . ':AB' .  ($keteragan + 25))->setCellValue('X' .  ($keteragan + 25), ': Mechanical Workshop');
            $objPHPExcel->mergeCells('X' . ($keteragan + 26) . ':AB' .  ($keteragan + 26))->setCellValue('X' .  ($keteragan + 26), ': Central Store');
            $objPHPExcel->mergeCells('X' . ($keteragan + 27) . ':AB' .  ($keteragan + 27))->setCellValue('X' .  ($keteragan + 27), ': PIC Store');
            $objPHPExcel->mergeCells('X' . ($keteragan + 28) . ':AB' .  ($keteragan + 28))->setCellValue('X' .  ($keteragan + 28), ': Quality System Dept.');
            $objPHPExcel->mergeCells('X' . ($keteragan + 29) . ':AB' .  ($keteragan + 29))->setCellValue('X' .  ($keteragan + 29), ': Building Maintenance Dept.');
            $objPHPExcel->mergeCells('X' . ($keteragan + 30) . ':AB' .  ($keteragan + 30))->setCellValue('X' .  ($keteragan + 30), ': Arang Tempurung');
            $objPHPExcel->mergeCells('X' . ($keteragan + 31) . ':AB' .  ($keteragan + 31))->setCellValue('X' .  ($keteragan + 31), ': Heavy Equipmment Dept.');
            $objPHPExcel->mergeCells('X' . ($keteragan + 32) . ':AB' .  ($keteragan + 32))->setCellValue('X' .  ($keteragan + 32), ': Central Office');
            $objPHPExcel->mergeCells('X' . ($keteragan + 33) . ':AB' .  ($keteragan + 33))->setCellValue('X' .  ($keteragan + 33), ': Quality Assurance Dept.');
            $objPHPExcel->mergeCells('X' . ($keteragan + 34) . ':AB' .  ($keteragan + 34))->setCellValue('X' .  ($keteragan + 34), ': Port Handling / Ware House');
            $objPHPExcel->mergeCells('X' . ($keteragan + 35) . ':AB' .  ($keteragan + 35))->setCellValue('X' .  ($keteragan + 35), ': General Affair Dept.');
            $objPHPExcel->mergeCells('X' . ($keteragan + 36) . ':AB' .  ($keteragan + 36))->setCellValue('X' .  ($keteragan + 36), ': Personalia');
            $objPHPExcel->mergeCells('X' . ($keteragan + 37) . ':AB' .  ($keteragan + 37))->setCellValue('X' .  ($keteragan + 37), ': Cooling Tower Power House');
            $objPHPExcel->mergeCells('X' . ($keteragan + 38) . ':AB' .  ($keteragan + 38))->setCellValue('X' .  ($keteragan + 38), ': Selisih Antara Output KWH Generator Dengan Output KWH Dept.');
            $objPHPExcel->mergeCells('X' . ($keteragan + 39) . ':AB' .  ($keteragan + 39))->setCellValue('X' .  ($keteragan + 39), ': Bahan Bakar');
            $objPHPExcel->mergeCells('X' . ($keteragan + 40) . ':AB' .  ($keteragan + 40))->setCellValue('X' .  ($keteragan + 40), ': Pakai Bahan Bakar');
            $objPHPExcel->mergeCells('X' . ($keteragan + 41) . ':AB' .  ($keteragan + 41))->setCellValue('X' .  ($keteragan + 41), ': Steam Ton / Kg Bahan Bakar');
            $objPHPExcel->mergeCells('X' . ($keteragan + 42) . ':AB' .  ($keteragan + 42))->setCellValue('X' .  ($keteragan + 42), ': Klinik');

            $objPHPExcel->mergeCells('X' . ($keteragan + 7) . ':X' .  ($keteragan + 7))->setCellValue('X' .  ($keteragan + 7), ': Min 1,09');
            $objPHPExcel->mergeCells('X' . ($keteragan + 8) . ':X' .  ($keteragan + 8))->setCellValue('X' .  ($keteragan + 8), ': Min 0,65');
            $objPHPExcel->mergeCells('X' . ($keteragan + 9) . ':X' .  ($keteragan + 9))->setCellValue('X' .  ($keteragan + 9), ': Min 3,64');
            $objPHPExcel->mergeCells('X' . ($keteragan + 10) . ':X' .  ($keteragan + 10))->setCellValue('X' .  ($keteragan + 10), ': Max 5,30');
            
            $objPHPExcel->mergeCells('T' . ($keteragan + 44) . ':T' .  ($keteragan + 44))->setCellValue('T' .  ($keteragan + 44), 'Keterangan :');
            $objPHPExcel->mergeCells('U' . ($keteragan + 45) . ':AA' .  ($keteragan + 45))->setCellValue('U' .  ($keteragan + 45), 'Loss Turbin : KWH Output Generator - Total Pemakaian KWH (RELASI + Operasional Turbin)');
            $objPHPExcel->mergeCells('U' . ($keteragan + 46) . ':AA' .  ($keteragan + 46))->setCellValue('U' .  ($keteragan + 46), 'Loss TBN akan ditambah ke setiap Departemen, dengan rumus :');
            $objPHPExcel->mergeCells('U' . ($keteragan + 47) . ':AA' .  ($keteragan + 47))->setCellValue('U' .  ($keteragan + 47), 'Penambahan Loss = Pemakaian Dept. / (Total Pemakaian Seluruh Dept. x Loss TBN)');

            $objPHPExcel->mergeCells('T' . ($keteragan + 49) . ':T' .  ($keteragan + 49))->setCellValue('T' .  ($keteragan + 49), 'Catatan :');
            $objPHPExcel->mergeCells('U' . ($keteragan + 50) . ':AA' .  ($keteragan + 50))->setCellValue('U' .  ($keteragan + 50), 'Operasional Boiler 1 & Boiler 3');
            $objPHPExcel->mergeCells('U' . ($keteragan + 51) . ':AA' .  ($keteragan + 51))->setCellValue('U' .  ($keteragan + 51), 'Operasional Turbin 1 & Turbin 3');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'C' . ($table4_dtl) . ':AD' . ($table4_dtl));


            $app_row = $table3_dtl + 10;

            $objPHPExcel->mergeCells('C' . ($app_row) . ':H' .  ($app_row + 1))->setCellValue('C' .  ($app_row), 'Dibuat Oleh,');
            $objPHPExcel->mergeCells('I' . ($app_row) . ':N' . ($app_row + 1))->setCellValue('I' .  ($app_row), 'Diketahui Oleh,');
            $objPHPExcel->mergeCells('O' . ($app_row) . ':T' . ($app_row + 1))->setCellValue('O' . ($app_row), 'Disetujui Oleh,');

            $objPHPExcel->mergeCells('C' . ($app_row + 2) . ':H' .  ($app_row + 6))->setCellValue('C' . ($app_row + 2), '');
            $objPHPExcel->mergeCells('I' . ($app_row + 2) . ':N' . ($app_row + 6))->setCellValue('I' . ($app_row + 2), '');
            $objPHPExcel->mergeCells('O' . ($app_row + 2) . ':T' . ($app_row + 6))->setCellValue('O' . ($app_row + 2), '');

            // $objPHPExcel->getStyle('C' . ($app_row) .     ':L'. ($app_row))->getFont()->setSize(10);
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($app_row - 1) . ':AO' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'C' . ($app_row) . ':T' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($app_row - 2) . ':AO' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row - 2) . ':A' . ($app_row + 6));


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
                    $sign_img->setCoordinates('D' . ($app_row + 3));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('D' . ($app_row + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('D' . ($app_row + 2));
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
                    $sign_img2->setCoordinates('J' . ($app_row + 3));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('J' . ($app_row + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('J' . ($app_row + 2));
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
                    $sign_img3->setCoordinates('P' . ($app_row + 3));
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('P' . ($app_row + 3));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('P' . ($app_row + 2));
                }
            }

            $objPHPExcel->mergeCells('C' . ($app_row + 7) . ':D' . ($app_row + 7))->setCellValue('C' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('E' . ($app_row + 7) . ':H' . ($app_row + 7))->setCellValue('E' . ($app_row + 7), ': ' . $app1_by);
            $objPHPExcel->mergeCells('C' . ($app_row + 8) . ':D' . ($app_row + 8))->setCellValue('C' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('E' . ($app_row + 8) . ':H' . ($app_row + 8))->setCellValue('E' . ($app_row + 8), ': ' . $app1_position);
            $objPHPExcel->mergeCells('C' . ($app_row + 9) . ':D' . ($app_row + 9))->setCellValue('C' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('E' . ($app_row + 9) . ':H' . ($app_row + 9))->setCellValue('E' . ($app_row + 9), ': ' . $app1date);

            $objPHPExcel->mergeCells('I' . ($app_row + 7) . ':J' . ($app_row + 7))->setCellValue('I' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('J' . ($app_row + 7) . ':N' . ($app_row + 7))->setCellValue('J' . ($app_row + 7), ': ' . $app2_by);
            $objPHPExcel->mergeCells('I' . ($app_row + 8) . ':J' . ($app_row + 8))->setCellValue('I' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('J' . ($app_row + 8) . ':N' . ($app_row + 8))->setCellValue('J' . ($app_row + 8), ': ' . $app2_position);
            $objPHPExcel->mergeCells('I' . ($app_row + 9) . ':J' . ($app_row + 9))->setCellValue('I' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('J' . ($app_row + 9) . ':N' . ($app_row + 9))->setCellValue('J' . ($app_row + 9), ': ' . $app2date);
           
            $objPHPExcel->mergeCells('O' . ($app_row + 7) . ':P' . ($app_row + 7))->setCellValue('O' . ($app_row + 7), 'Nama');
            $objPHPExcel->mergeCells('Q' . ($app_row + 7) . ':T' . ($app_row + 7))->setCellValue('Q' . ($app_row + 7), ': ' . $app3_by);
            $objPHPExcel->mergeCells('O' . ($app_row + 8) . ':P' . ($app_row + 8))->setCellValue('O' . ($app_row + 8), 'Jabatan');
            $objPHPExcel->mergeCells('Q' . ($app_row + 8) . ':T' . ($app_row + 8))->setCellValue('Q' . ($app_row + 8), ': ' . $app3_position);
            $objPHPExcel->mergeCells('O' . ($app_row + 9) . ':P' . ($app_row + 9))->setCellValue('O' . ($app_row + 9), 'Tanggal');
            $objPHPExcel->mergeCells('Q' . ($app_row + 9) . ':T' . ($app_row + 9))->setCellValue('Q' . ($app_row + 9), ': ' . $app3date);


            $objPHPExcel->setSharedStyle($noborderStyle, 'C' . ($app_row + 7) . ':AO' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'C' . ($app_row + 7) . ':C' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'I' . ($app_row + 7) . ':I' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'O' . ($app_row + 7) . ':O' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($noborderStyle, 'AO' . ($app_row + 7) . ':AO' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'AO' . ($app_row + 7) . ':AO' . ($app_row + 9));

            $objPHPExcel->getStyle('C' . ($app_row + 7) . ':T' . ($app_row + 9))->getFont()->setBold(true);
            $objPHPExcel->setSharedStyle($headerStyleRight, 'T' . ($app_row + 7) . ':T' . ($app_row + 9));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));

            $start_row3 = $app_row + 9;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':R' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':R' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('S' . ($start_row3 + 1) . ':AO' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('S' . ($start_row3 + 1) . ':AO' . ($start_row3 + 1))->setCellValue('S' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':R' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'S' . ($start_row3 + 1) . ':AO' . ($start_row3 + 1));
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
