<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_frmfss170_03 extends CI_Controller
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
        $this->header_id      = $this->uri->segment(6);
        $dtfrm                  = $this->M_forminput->get_dtform($frmkode, $frmvrs);
        foreach ($dtfrm as $datafrm) {
            $this->frmkd          = $datafrm->formkd;
            $this->frmjdl         = $datafrm->formjudul;
            $this->frmnm          = $datafrm->formnm;
            $this->frmver         = $datafrm->formversi;
            $this->frmefective    = date("d-m-Y", strtotime($datafrm->formefective));
        }
        $dtheader = $this->M_formfrmfss170_03->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date       = $dtheaderrow->create_date; //2021-02-08

            $create_date         = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno               = $dtheaderrow->docno;
            $shift1               = $dtheaderrow->shift1;
            $shift2               = $dtheaderrow->shift2;
            $shift3               = $dtheaderrow->shift3;

            $app1_by             = $dtheaderrow->app1_by;
            $app2_by             = $dtheaderrow->app2_by;
            $app3_by             = $dtheaderrow->app3_by;
            $app4_by             = $dtheaderrow->app4_by;

            $app1_position       = $dtheaderrow->app1_position;
            $app2_position       = $dtheaderrow->app2_position;
            $app3_position       = $dtheaderrow->app3_position;
            $app4_position       = $dtheaderrow->app4_position;

            $app1_personalid     = $dtheaderrow->app1_personalid;
            $app2_personalid     = $dtheaderrow->app2_personalid;
            $app3_personalid     = $dtheaderrow->app3_personalid;
            $app4_personalid     = $dtheaderrow->app4_personalid;

            $app1_personalstatus = $dtheaderrow->app1_personalstatus;
            $app2_personalstatus = $dtheaderrow->app2_personalstatus;
            $app3_personalstatus = $dtheaderrow->app3_personalstatus;
            $app4_personalstatus = $dtheaderrow->app4_personalstatus;

            $app1date             = $dtheaderrow->app1_date;
            $app2date             = $dtheaderrow->app2_date;
            $app3date             = $dtheaderrow->app3_date;
            $app4date             = $dtheaderrow->app4_date;

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

            if (trim($dtheaderrow->app4_date) != '') {
                $app4date       = date('d-m-Y', strtotime($dtheaderrow->app4_date));
            } else {
                $app4date = '';
            }
        }
        if ($this->cekLevelUserNm == "Auditor") {

            $dtdetail           = $this->M_formfrmfss170_03->get_detail_byidx($this->header_id);
            $dtdetail_b         = $this->M_formfrmfss170_03->get_detail_byid_bx($this->header_id);
            $dtdetail_shift1    = $this->M_formfrmfss170_03->get_detail_by_id_shift1x($this->header_id);
            $dtdetail_shift2    = $this->M_formfrmfss170_03->get_detail_by_id_shift2x($this->header_id);
            $dtdetail_shift3    = $this->M_formfrmfss170_03->get_detail_by_id_shift3x($this->header_id);
            $dtdetail_c_shift1  = $this->M_formfrmfss170_03->get_detail_cx_shift1($this->header_id);
            $dtdetail_c_shift2  = $this->M_formfrmfss170_03->get_detail_cx_shift2($this->header_id);
            $dtdetail_c_shift3  = $this->M_formfrmfss170_03->get_detail_cx_shift3($this->header_id);
        } else {
            $dtdetail           = $this->M_formfrmfss170_03->get_detail_byid($this->header_id);
            $dtdetail_b         = $this->M_formfrmfss170_03->get_detail_byid_b($this->header_id);
            $dtdetail_shift1    = $this->M_formfrmfss170_03->get_detail_by_id_shift1($this->header_id);
            $dtdetail_shift2    = $this->M_formfrmfss170_03->get_detail_by_id_shift2($this->header_id);
            $dtdetail_shift3    = $this->M_formfrmfss170_03->get_detail_by_id_shift3($this->header_id);
            $dtdetail_c_shift1  = $this->M_formfrmfss170_03->get_detail_c_shift1($this->header_id);
            $dtdetail_c_shift2  = $this->M_formfrmfss170_03->get_detail_c_shift2($this->header_id);
            $dtdetail_c_shift3  = $this->M_formfrmfss170_03->get_detail_c_shift3($this->header_id);
        }

        $tdtl_pcs_kulit_sf1 = 0;
        $tdtl_prsn_kulit_sf1 = 0;
        $tdtl_pcs_sabut_sf1 = 0;
        $tdtl_prsn_sabut_sf1 = 0;
        $tdtl_pcs_tombong_sf1 = 0;
        $tdtl_prsn_tombong_sf1 = 0;
        $tdtl_pcs_benda_sf1 = 0;
        $tdtl_prsn_benda_sf1 = 0;
        $tdtl_pcs_bad_sf1 = 0;
        $tdtl_prsn_bad_sf1 = 0;

        $tjml_pcs_kulit_sf1 = 0;
        $tjml_prsn_kulit_sf1 = 0;
        $tjml_pcs_sabut_sf1 = 0;
        $tjml_prsn_sabut_sf1 = 0;
        $tjml_pcs_tombong_sf1 = 0;
        $tjml_prsn_tombong_sf1 = 0;
        $tjml_pcs_benda_sf1 = 0;
        $tjml_prsn_benda_sf1 = 0;
        $tjml_pcs_bad_sf1 = 0;
        $tjml_prsn_bad_sf1 = 0;

        $no = 1;
        foreach ($dtdetail_shift1 as $dtdetail_row_shift1) {
            $nomor[]             = $no++;
            $jam_sampling[]      = trim($dtdetail_row_shift1->jam_sampling);
            $dtl_pcs_kulit[]     = trim($dtdetail_row_shift1->dtl_pcs_kulit);
            $dtl_prsn_kulit[]    = trim($dtdetail_row_shift1->dtl_prsn_kulit);
            $dtl_pcs_sabut[]     = trim($dtdetail_row_shift1->dtl_pcs_sabut);
            $dtl_prsn_sabut[]    = trim($dtdetail_row_shift1->dtl_prsn_sabut);
            $dtl_pcs_tombong[]   = trim($dtdetail_row_shift1->dtl_pcs_tombong);
            $dtl_prsn_tombong[]  = trim($dtdetail_row_shift1->dtl_prsn_tombong);
            $dtl_pcs_benda[]     = trim($dtdetail_row_shift1->dtl_pcs_benda);
            $dtl_prsn_benda[]    = trim($dtdetail_row_shift1->dtl_prsn_benda);
            $dtl_pcs_bad[]       = trim($dtdetail_row_shift1->dtl_pcs_bad);
            $dtl_prsn_bad[]      = trim($dtdetail_row_shift1->dtl_prsn_bad);

            if(is_numeric($dtdetail_row_shift1->dtl_pcs_kulit)){
                $tdtl_pcs_kulit_sf1 += $dtdetail_row_shift1->dtl_pcs_kulit;
                $tjml_pcs_kulit_sf1++;
            }

            if(is_numeric($dtdetail_row_shift1->dtl_prsn_kulit)){
                $tdtl_prsn_kulit_sf1 += $dtdetail_row_shift1->dtl_prsn_kulit;
                $tjml_prsn_kulit_sf1++;
            }

            if(is_numeric($dtdetail_row_shift1->dtl_pcs_sabut)){
                $tdtl_pcs_sabut_sf1 += $dtdetail_row_shift1->dtl_pcs_sabut;
                $tjml_pcs_sabut_sf1++;
            }

            if(is_numeric($dtdetail_row_shift1->dtl_prsn_sabut)){
                $tdtl_prsn_sabut_sf1 += $dtdetail_row_shift1->dtl_prsn_sabut;
                $tjml_prsn_sabut_sf1++;
            }

            if(is_numeric($dtdetail_row_shift1->dtl_pcs_tombong)){
                $tdtl_pcs_tombong_sf1 += $dtdetail_row_shift1->dtl_pcs_tombong;
                $tjml_pcs_tombong_sf1++;
            }

            if(is_numeric($dtdetail_row_shift1->dtl_prsn_tombong)){
                $tdtl_prsn_tombong_sf1 += $dtdetail_row_shift1->dtl_prsn_tombong;
                $tjml_prsn_tombong_sf1++;
            }

            if(is_numeric($dtdetail_row_shift1->dtl_pcs_benda)){
                $tdtl_pcs_benda_sf1 += $dtdetail_row_shift1->dtl_pcs_benda;
                $tjml_pcs_benda_sf1++;
            }

            if(is_numeric($dtdetail_row_shift1->dtl_prsn_benda)){
                $tdtl_prsn_benda_sf1 += $dtdetail_row_shift1->dtl_prsn_benda;
                $tjml_prsn_benda_sf1++;
            }

            if(is_numeric($dtdetail_row_shift1->dtl_pcs_bad)){
                $tdtl_pcs_bad_sf1 += $dtdetail_row_shift1->dtl_pcs_bad;
                $tjml_pcs_bad_sf1++;
            }

            if(is_numeric($dtdetail_row_shift1->dtl_prsn_bad)){
                $tdtl_prsn_bad_sf1 += $dtdetail_row_shift1->dtl_prsn_bad;
                $tjml_prsn_bad_sf1++;
            }

        }

        $tdtl_pcs_kulit_sf2 = 0;
        $tdtl_prsn_kulit_sf2 = 0;
        $tdtl_pcs_sabut_sf2 = 0;
        $tdtl_prsn_sabut_sf2 = 0;
        $tdtl_pcs_tombong_sf2 = 0;
        $tdtl_prsn_tombong_sf2 = 0;
        $tdtl_pcs_benda_sf2 = 0;
        $tdtl_prsn_benda_sf2 = 0;
        $tdtl_pcs_bad_sf2 = 0;
        $tdtl_prsn_bad_sf2 = 0;

        $tjml_pcs_kulit_sf2 = 0;
        $tjml_prsn_kulit_sf2 = 0;
        $tjml_pcs_sabut_sf2 = 0;
        $tjml_prsn_sabut_sf2 = 0;
        $tjml_pcs_tombong_sf2 = 0;
        $tjml_prsn_tombong_sf2 = 0;
        $tjml_pcs_benda_sf2 = 0;
        $tjml_prsn_benda_sf2 = 0;
        $tjml_pcs_bad_sf2 = 0;
        $tjml_prsn_bad_sf2 = 0;
        $no = 1;
        foreach ($dtdetail_shift2 as $dtdetail_row_shift2) {
            $nomor[]             = $no++;
            $jam_sampling_sf2[]      = trim($dtdetail_row_shift2->jam_sampling);
            $dtl_pcs_kulit_sf2[]     = trim($dtdetail_row_shift2->dtl_pcs_kulit);
            $dtl_prsn_kulit_sf2[]    = trim($dtdetail_row_shift2->dtl_prsn_kulit);
            $dtl_pcs_sabut_sf2[]     = trim($dtdetail_row_shift2->dtl_pcs_sabut);
            $dtl_prsn_sabut_sf2[]    = trim($dtdetail_row_shift2->dtl_prsn_sabut);
            $dtl_pcs_tombong_sf2[]   = trim($dtdetail_row_shift2->dtl_pcs_tombong);
            $dtl_prsn_tombong_sf2[]  = trim($dtdetail_row_shift2->dtl_prsn_tombong);
            $dtl_pcs_benda_sf2[]     = trim($dtdetail_row_shift2->dtl_pcs_benda);
            $dtl_prsn_benda_sf2[]    = trim($dtdetail_row_shift2->dtl_prsn_benda);
            $dtl_pcs_bad_sf2[]       = trim($dtdetail_row_shift2->dtl_pcs_bad);
            $dtl_prsn_bad_sf2[]      = trim($dtdetail_row_shift2->dtl_prsn_bad);

            if (is_numeric($dtdetail_row_shift2->dtl_pcs_kulit)) {
                $tdtl_pcs_kulit_sf2 += $dtdetail_row_shift2->dtl_pcs_kulit;
                $tjml_pcs_kulit_sf2++;
            }

            if (is_numeric($dtdetail_row_shift2->dtl_prsn_kulit)) {
                $tdtl_prsn_kulit_sf2 += $dtdetail_row_shift2->dtl_prsn_kulit;
                $tjml_prsn_kulit_sf2++;
            }

            if (is_numeric($dtdetail_row_shift2->dtl_pcs_sabut)) {
                $tdtl_pcs_sabut_sf2 += $dtdetail_row_shift2->dtl_pcs_sabut;
                $tjml_pcs_sabut_sf2++;
            }

            if (is_numeric($dtdetail_row_shift2->dtl_prsn_sabut)) {
                $tdtl_prsn_sabut_sf2 += $dtdetail_row_shift2->dtl_prsn_sabut;
                $tjml_prsn_sabut_sf2++;
            }

            if (is_numeric($dtdetail_row_shift2->dtl_pcs_tombong)) {
                $tdtl_pcs_tombong_sf2 += $dtdetail_row_shift2->dtl_pcs_tombong;
                $tjml_pcs_tombong_sf2++;
            }

            if (is_numeric($dtdetail_row_shift2->dtl_prsn_tombong)) {
                $tdtl_prsn_tombong_sf2 += $dtdetail_row_shift2->dtl_prsn_tombong;
                $tjml_prsn_tombong_sf2++;
            }

            if (is_numeric($dtdetail_row_shift2->dtl_pcs_benda)) {
                $tdtl_pcs_benda_sf2 += $dtdetail_row_shift2->dtl_pcs_benda;
                $tjml_pcs_benda_sf2++;
            }

            if (is_numeric($dtdetail_row_shift2->dtl_prsn_benda)) {
                $tdtl_prsn_benda_sf2 += $dtdetail_row_shift2->dtl_prsn_benda;
                $tjml_prsn_benda_sf2++;
            }

            if (is_numeric($dtdetail_row_shift2->dtl_pcs_bad)) {
                $tdtl_pcs_bad_sf2 += $dtdetail_row_shift2->dtl_pcs_bad;
                $tjml_pcs_bad_sf2++;
            }

            if (is_numeric($dtdetail_row_shift2->dtl_prsn_bad)) {
                $tdtl_prsn_bad_sf2 += $dtdetail_row_shift2->dtl_prsn_bad;
                $tjml_prsn_bad_sf2++;
            }
        }

        $tdtl_pcs_kulit_sf3 = 0;
        $tdtl_prsn_kulit_sf3 = 0;
        $tdtl_pcs_sabut_sf3 = 0;
        $tdtl_prsn_sabut_sf3 = 0;
        $tdtl_pcs_tombong_sf3 = 0;
        $tdtl_prsn_tombong_sf3 = 0;
        $tdtl_pcs_benda_sf3 = 0;
        $tdtl_prsn_benda_sf3 = 0;
        $tdtl_pcs_bad_sf3 = 0;
        $tdtl_prsn_bad_sf3 = 0;

        $tjml_pcs_kulit_sf3 = 0;
        $tjml_prsn_kulit_sf3 = 0;
        $tjml_pcs_sabut_sf3 = 0;
        $tjml_prsn_sabut_sf3 = 0;
        $tjml_pcs_tombong_sf3 = 0;
        $tjml_prsn_tombong_sf3 = 0;
        $tjml_pcs_benda_sf3 = 0;
        $tjml_prsn_benda_sf3 = 0;
        $tjml_pcs_bad_sf3 = 0;
        $tjml_prsn_bad_sf3 = 0;
        $no = 1;
        foreach ($dtdetail_shift3 as $dtdetail_row_shift3) {
            $nomor[]             = $no++;
            $jam_sampling_sf3[]      = trim($dtdetail_row_shift3->jam_sampling);
            $dtl_pcs_kulit_sf3[]     = trim($dtdetail_row_shift3->dtl_pcs_kulit);
            $dtl_prsn_kulit_sf3[]    = trim($dtdetail_row_shift3->dtl_prsn_kulit);
            $dtl_pcs_sabut_sf3[]     = trim($dtdetail_row_shift3->dtl_pcs_sabut);
            $dtl_prsn_sabut_sf3[]    = trim($dtdetail_row_shift3->dtl_prsn_sabut);
            $dtl_pcs_tombong_sf3[]   = trim($dtdetail_row_shift3->dtl_pcs_tombong);
            $dtl_prsn_tombong_sf3[]  = trim($dtdetail_row_shift3->dtl_prsn_tombong);
            $dtl_pcs_benda_sf3[]     = trim($dtdetail_row_shift3->dtl_pcs_benda);
            $dtl_prsn_benda_sf3[]    = trim($dtdetail_row_shift3->dtl_prsn_benda);
            $dtl_pcs_bad_sf3[]       = trim($dtdetail_row_shift3->dtl_pcs_bad);
            $dtl_prsn_bad_sf3[]      = trim($dtdetail_row_shift3->dtl_prsn_bad);

            if (is_numeric($dtdetail_row_shift3->dtl_pcs_kulit)) {
                $tdtl_pcs_kulit_sf3 += $dtdetail_row_shift3->dtl_pcs_kulit;
                $tjml_pcs_kulit_sf3++;
            }

            if (is_numeric($dtdetail_row_shift3->dtl_prsn_kulit)) {
                $tdtl_prsn_kulit_sf3 += $dtdetail_row_shift3->dtl_prsn_kulit;
                $tjml_prsn_kulit_sf3++;
            }

            if (is_numeric($dtdetail_row_shift3->dtl_pcs_sabut)) {
                $tdtl_pcs_sabut_sf3 += $dtdetail_row_shift3->dtl_pcs_sabut;
                $tjml_pcs_sabut_sf3++;
            }

            if (is_numeric($dtdetail_row_shift3->dtl_prsn_sabut)) {
                $tdtl_prsn_sabut_sf3 += $dtdetail_row_shift3->dtl_prsn_sabut;
                $tjml_prsn_sabut_sf3++;
            }

            if (is_numeric($dtdetail_row_shift3->dtl_pcs_tombong)) {
                $tdtl_pcs_tombong_sf3 += $dtdetail_row_shift3->dtl_pcs_tombong;
                $tjml_pcs_tombong_sf3++;
            }

            if (is_numeric($dtdetail_row_shift3->dtl_prsn_tombong)) {
                $tdtl_prsn_tombong_sf3 += $dtdetail_row_shift3->dtl_prsn_tombong;
                $tjml_prsn_tombong_sf3++;
            }

            if (is_numeric($dtdetail_row_shift3->dtl_pcs_benda)) {
                $tdtl_pcs_benda_sf3 += $dtdetail_row_shift3->dtl_pcs_benda;
                $tjml_pcs_benda_sf3++;
            }

            if (is_numeric($dtdetail_row_shift3->dtl_prsn_benda)) {
                $tdtl_prsn_benda_sf3 += $dtdetail_row_shift3->dtl_prsn_benda;
                $tjml_prsn_benda_sf3++;
            }

            if (is_numeric($dtdetail_row_shift3->dtl_pcs_bad)) {
                $tdtl_pcs_bad_sf3 += $dtdetail_row_shift3->dtl_pcs_bad;
                $tjml_pcs_bad_sf3++;
            }

            if (is_numeric($dtdetail_row_shift3->dtl_prsn_bad)) {
                $tdtl_prsn_bad_sf3 += $dtdetail_row_shift3->dtl_prsn_bad;
                $tjml_prsn_bad_sf3++;
            }
        }

// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2
// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2

        $tdtl_pcs_kulit_sff1 = 0;
        $tdtl_prsn_kulit_sff1 = 0;
        $tdtl_pcs_sabut_sff1 = 0;
        $tdtl_prsn_sabut_sff1 = 0;
        $tdtl_pcs_tombong_sff1 = 0;
        $tdtl_prsn_tombong_sff1 = 0;
        $tdtl_pcs_benda_sff1 = 0;
        $tdtl_prsn_benda_sff1 = 0;
        $tdtl_pcs_bad_sff1 = 0;
        $tdtl_prsn_bad_sff1 = 0;

        $tjml_pcs_kulit_sff1 = 0;
        $tjml_prsn_kulit_sff1 = 0;
        $tjml_pcs_sabut_sff1 = 0;
        $tjml_prsn_sabut_sff1 = 0;
        $tjml_pcs_tombong_sff1 = 0;
        $tjml_prsn_tombong_sff1 = 0;
        $tjml_pcs_benda_sff1 = 0;
        $tjml_prsn_benda_sff1 = 0;
        $tjml_pcs_bad_sff1 = 0;
        $tjml_prsn_bad_sff1 = 0;

        $no = 1;
        foreach ($dtdetail_c_shift1 as $dtdetail_row2_shift1) {
            $nomor[]             = $no++;
            $jam_sampling_sff1[]      = trim($dtdetail_row2_shift1->jam_sampling);
            $dtl_pcs_kulit_sff1[]     = trim($dtdetail_row2_shift1->dtl_pcs_kulit);
            $dtl_prsn_kulit_sff1[]    = trim($dtdetail_row2_shift1->dtl_prsn_kulit);
            $dtl_pcs_sabut_sff1[]     = trim($dtdetail_row2_shift1->dtl_pcs_sabut);
            $dtl_prsn_sabut_sff1[]    = trim($dtdetail_row2_shift1->dtl_prsn_sabut);
            $dtl_pcs_tombong_sff1[]   = trim($dtdetail_row2_shift1->dtl_pcs_tombong);
            $dtl_prsn_tombong_sff1[]  = trim($dtdetail_row2_shift1->dtl_prsn_tombong);
            $dtl_pcs_benda_sff1[]     = trim($dtdetail_row2_shift1->dtl_pcs_benda);
            $dtl_prsn_benda_sff1[]    = trim($dtdetail_row2_shift1->dtl_prsn_benda);
            $dtl_pcs_bad_sff1[]       = trim($dtdetail_row2_shift1->dtl_pcs_bad);
            $dtl_prsn_bad_sff1[]      = trim($dtdetail_row2_shift1->dtl_prsn_bad);

            if (is_numeric($dtdetail_row2_shift1->dtl_pcs_kulit)) {
                $tdtl_pcs_kulit_sff1 += $dtdetail_row2_shift1->dtl_pcs_kulit;
                $tjml_pcs_kulit_sff1++;
            }

            if (is_numeric($dtdetail_row2_shift1->dtl_prsn_kulit)) {
                $tdtl_prsn_kulit_sff1 += $dtdetail_row2_shift1->dtl_prsn_kulit;
                $tjml_prsn_kulit_sff1++;
            }

            if (is_numeric($dtdetail_row2_shift1->dtl_pcs_sabut)) {
                $tdtl_pcs_sabut_sff1 += $dtdetail_row2_shift1->dtl_pcs_sabut;
                $tjml_pcs_sabut_sff1++;
            }

            if (is_numeric($dtdetail_row2_shift1->dtl_prsn_sabut)) {
                $tdtl_prsn_sabut_sff1 += $dtdetail_row2_shift1->dtl_prsn_sabut;
                $tjml_prsn_sabut_sff1++;
            }

            if (is_numeric($dtdetail_row2_shift1->dtl_pcs_tombong)) {
                $tdtl_pcs_tombong_sff1 += $dtdetail_row2_shift1->dtl_pcs_tombong;
                $tjml_pcs_tombong_sff1++;
            }

            if (is_numeric($dtdetail_row2_shift1->dtl_prsn_tombong)) {
                $tdtl_prsn_tombong_sff1 += $dtdetail_row2_shift1->dtl_prsn_tombong;
                $tjml_prsn_tombong_sff1++;
            }

            if (is_numeric($dtdetail_row2_shift1->dtl_pcs_benda)) {
                $tdtl_pcs_benda_sff1 += $dtdetail_row2_shift1->dtl_pcs_benda;
                $tjml_pcs_benda_sff1++;
            }

            if (is_numeric($dtdetail_row2_shift1->dtl_prsn_benda)) {
                $tdtl_prsn_benda_sff1 += $dtdetail_row2_shift1->dtl_prsn_benda;
                $tjml_prsn_benda_sff1++;
            }

            if (is_numeric($dtdetail_row2_shift1->dtl_pcs_bad)) {
                $tdtl_pcs_bad_sff1 += $dtdetail_row2_shift1->dtl_pcs_bad;
                $tjml_pcs_bad_sff1++;
            }

            if (is_numeric($dtdetail_row2_shift1->dtl_prsn_bad)) {
                $tdtl_prsn_bad_sff1 += $dtdetail_row2_shift1->dtl_prsn_bad;
                $tjml_prsn_bad_sff1++;
            }
        }

        // shift 2

        $tdtl_pcs_kulit_sff2 = 0;
        $tdtl_prsn_kulit_sff2 = 0;
        $tdtl_pcs_sabut_sff2 = 0;
        $tdtl_prsn_sabut_sff2 = 0;
        $tdtl_pcs_tombong_sff2 = 0;
        $tdtl_prsn_tombong_sff2 = 0;
        $tdtl_pcs_benda_sff2 = 0;
        $tdtl_prsn_benda_sff2 = 0;
        $tdtl_pcs_bad_sff2 = 0;
        $tdtl_prsn_bad_sff2 = 0;

        $tjml_pcs_kulit_sff2 = 0;
        $tjml_prsn_kulit_sff2 = 0;
        $tjml_pcs_sabut_sff2 = 0;
        $tjml_prsn_sabut_sff2 = 0;
        $tjml_pcs_tombong_sff2 = 0;
        $tjml_prsn_tombong_sff2 = 0;
        $tjml_pcs_benda_sff2 = 0;
        $tjml_prsn_benda_sff2 = 0;
        $tjml_pcs_bad_sff2 = 0;
        $tjml_prsn_bad_sff2 = 0;
        $no = 1;
        foreach ($dtdetail_c_shift2 as $dtdetail_row2_shift2) {
            $nomor[]             = $no++;
            $jam_sampling_sff2[]      = trim($dtdetail_row2_shift2->jam_sampling);
            $dtl_pcs_kulit_sff2[]     = trim($dtdetail_row2_shift2->dtl_pcs_kulit);
            $dtl_prsn_kulit_sff2[]    = trim($dtdetail_row2_shift2->dtl_prsn_kulit);
            $dtl_pcs_sabut_sff2[]     = trim($dtdetail_row2_shift2->dtl_pcs_sabut);
            $dtl_prsn_sabut_sff2[]    = trim($dtdetail_row2_shift2->dtl_prsn_sabut);
            $dtl_pcs_tombong_sff2[]   = trim($dtdetail_row2_shift2->dtl_pcs_tombong);
            $dtl_prsn_tombong_sff2[]  = trim($dtdetail_row2_shift2->dtl_prsn_tombong);
            $dtl_pcs_benda_sff2[]     = trim($dtdetail_row2_shift2->dtl_pcs_benda);
            $dtl_prsn_benda_sff2[]    = trim($dtdetail_row2_shift2->dtl_prsn_benda);
            $dtl_pcs_bad_sff2[]       = trim($dtdetail_row2_shift2->dtl_pcs_bad);
            $dtl_prsn_bad_sff2[]      = trim($dtdetail_row2_shift2->dtl_prsn_bad);

            if (is_numeric($dtdetail_row2_shift2->dtl_pcs_kulit)) {
                $tdtl_pcs_kulit_sff2 += $dtdetail_row2_shift2->dtl_pcs_kulit;
                $tjml_pcs_kulit_sff2++;
            }

            if (is_numeric($dtdetail_row2_shift2->dtl_prsn_kulit)) {
                $tdtl_prsn_kulit_sff2 += $dtdetail_row2_shift2->dtl_prsn_kulit;
                $tjml_prsn_kulit_sff2++;
            }

            if (is_numeric($dtdetail_row2_shift2->dtl_pcs_sabut)) {
                $tdtl_pcs_sabut_sff2 += $dtdetail_row2_shift2->dtl_pcs_sabut;
                $tjml_pcs_sabut_sff2++;
            }

            if (is_numeric($dtdetail_row2_shift2->dtl_prsn_sabut)) {
                $tdtl_prsn_sabut_sff2 += $dtdetail_row2_shift2->dtl_prsn_sabut;
                $tjml_prsn_sabut_sff2++;
            }

            if (is_numeric($dtdetail_row2_shift2->dtl_pcs_tombong)) {
                $tdtl_pcs_tombong_sff2 += $dtdetail_row2_shift2->dtl_pcs_tombong;
                $tjml_pcs_tombong_sff2++;
            }

            if (is_numeric($dtdetail_row2_shift2->dtl_prsn_tombong)) {
                $tdtl_prsn_tombong_sff2 += $dtdetail_row2_shift2->dtl_prsn_tombong;
                $tjml_prsn_tombong_sff2++;
            }

            if (is_numeric($dtdetail_row2_shift2->dtl_pcs_benda)) {
                $tdtl_pcs_benda_sff2 += $dtdetail_row2_shift2->dtl_pcs_benda;
                $tjml_pcs_benda_sff2++;
            }

            if (is_numeric($dtdetail_row2_shift2->dtl_prsn_benda)) {
                $tdtl_prsn_benda_sff2 += $dtdetail_row2_shift2->dtl_prsn_benda;
                $tjml_prsn_benda_sff2++;
            }

            if (is_numeric($dtdetail_row2_shift2->dtl_pcs_bad)) {
                $tdtl_pcs_bad_sff2 += $dtdetail_row2_shift2->dtl_pcs_bad;
                $tjml_pcs_bad_sff2++;
            }

            if (is_numeric($dtdetail_row2_shift2->dtl_prsn_bad)) {
                $tdtl_prsn_bad_sff2 += $dtdetail_row2_shift2->dtl_prsn_bad;
                $tjml_prsn_bad_sff2++;
            }
        }

        // shift 3

        $tdtl_pcs_kulit_sff3 = 0;
        $tdtl_prsn_kulit_sff3 = 0;
        $tdtl_pcs_sabut_sff3 = 0;
        $tdtl_prsn_sabut_sff3 = 0;
        $tdtl_pcs_tombong_sff3 = 0;
        $tdtl_prsn_tombong_sff3 = 0;
        $tdtl_pcs_benda_sff3 = 0;
        $tdtl_prsn_benda_sff3 = 0;
        $tdtl_pcs_bad_sff3 = 0;
        $tdtl_prsn_bad_sff3 = 0;

        $tjml_pcs_kulit_sff3 = 0;
        $tjml_prsn_kulit_sff3 = 0;
        $tjml_pcs_sabut_sff3 = 0;
        $tjml_prsn_sabut_sff3 = 0;
        $tjml_pcs_tombong_sff3 = 0;
        $tjml_prsn_tombong_sff3 = 0;
        $tjml_pcs_benda_sff3 = 0;
        $tjml_prsn_benda_sff3 = 0;
        $tjml_pcs_bad_sff3 = 0;
        $tjml_prsn_bad_sff3 = 0;
        $no = 1;
        foreach ($dtdetail_c_shift3 as $dtdetail_row2_shift3) {
            $nomor[]             = $no++;
            $jam_sampling_sff3[]      = trim($dtdetail_row2_shift3->jam_sampling);
            $dtl_pcs_kulit_sff3[]     = trim($dtdetail_row2_shift3->dtl_pcs_kulit);
            $dtl_prsn_kulit_sff3[]    = trim($dtdetail_row2_shift3->dtl_prsn_kulit);
            $dtl_pcs_sabut_sff3[]     = trim($dtdetail_row2_shift3->dtl_pcs_sabut);
            $dtl_prsn_sabut_sff3[]    = trim($dtdetail_row2_shift3->dtl_prsn_sabut);
            $dtl_pcs_tombong_sff3[]   = trim($dtdetail_row2_shift3->dtl_pcs_tombong);
            $dtl_prsn_tombong_sff3[]  = trim($dtdetail_row2_shift3->dtl_prsn_tombong);
            $dtl_pcs_benda_sff3[]     = trim($dtdetail_row2_shift3->dtl_pcs_benda);
            $dtl_prsn_benda_sff3[]    = trim($dtdetail_row2_shift3->dtl_prsn_benda);
            $dtl_pcs_bad_sff3[]       = trim($dtdetail_row2_shift3->dtl_pcs_bad);
            $dtl_prsn_bad_sff3[]      = trim($dtdetail_row2_shift3->dtl_prsn_bad);

            if (is_numeric($dtdetail_row2_shift3->dtl_pcs_kulit)) {
                $tdtl_pcs_kulit_sff3 += $dtdetail_row2_shift3->dtl_pcs_kulit;
                $tjml_pcs_kulit_sff3++;
            }

            if (is_numeric($dtdetail_row2_shift3->dtl_prsn_kulit)) {
                $tdtl_prsn_kulit_sff3 += $dtdetail_row2_shift3->dtl_prsn_kulit;
                $tjml_prsn_kulit_sff3++;
            }

            if (is_numeric($dtdetail_row2_shift3->dtl_pcs_sabut)) {
                $tdtl_pcs_sabut_sff3 += $dtdetail_row2_shift3->dtl_pcs_sabut;
                $tjml_pcs_sabut_sff3++;
            }

            if (is_numeric($dtdetail_row2_shift3->dtl_prsn_sabut)) {
                $tdtl_prsn_sabut_sff3 += $dtdetail_row2_shift3->dtl_prsn_sabut;
                $tjml_prsn_sabut_sff3++;
            }

            if (is_numeric($dtdetail_row2_shift3->dtl_pcs_tombong)) {
                $tdtl_pcs_tombong_sff3 += $dtdetail_row2_shift3->dtl_pcs_tombong;
                $tjml_pcs_tombong_sff3++;
            }

            if (is_numeric($dtdetail_row2_shift3->dtl_prsn_tombong)) {
                $tdtl_prsn_tombong_sff3 += $dtdetail_row2_shift3->dtl_prsn_tombong;
                $tjml_prsn_tombong_sff3++;
            }

            if (is_numeric($dtdetail_row2_shift3->dtl_pcs_benda)) {
                $tdtl_pcs_benda_sff3 += $dtdetail_row2_shift3->dtl_pcs_benda;
                $tjml_pcs_benda_sff3++;
            }

            if (is_numeric($dtdetail_row2_shift3->dtl_prsn_benda)) {
                $tdtl_prsn_benda_sff3 += $dtdetail_row2_shift3->dtl_prsn_benda;
                $tjml_prsn_benda_sff3++;
            }

            if (is_numeric($dtdetail_row2_shift3->dtl_pcs_bad)) {
                $tdtl_pcs_bad_sff3 += $dtdetail_row2_shift3->dtl_pcs_bad;
                $tjml_pcs_bad_sff3++;
            }

            if (is_numeric($dtdetail_row2_shift3->dtl_prsn_bad)) {
                $tdtl_prsn_bad_sff3 += $dtdetail_row2_shift3->dtl_prsn_bad;
                $tjml_prsn_bad_sff3++;
            }
        }

        foreach ($dtdetail_b as $dtdetail_b_row) {
            $nomor[]                   = $no++;
            $dtl_shift[]               = trim($dtdetail_b_row->shift);
            $dtl_jam[]                 = trim($dtdetail_b_row->jam);
            $dtl_tindakan[]            = trim($dtdetail_b_row->tindakan);
            $dtl_pj_nama[]             = trim($dtdetail_b_row->pj_nama);
            $dtl_pj_personalstatus[]   = trim($dtdetail_b_row->pj_personalstatus);
            $dtl_pj_personalid[]       = trim($dtdetail_b_row->pj_personalid);
            }

        //end Get dtheader
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
        $noborderStyle->applyFromArray($this->xls->noborderStyle);
        $bodyStyleLeft->applyFromArray($this->xls->bodyStyleLeft);
        $bodyStyleRight->applyFromArray($this->xls->bodyStyleRight);
        $footerStyleLeftbottom->applyFromArray($this->xls->footerStyleLeftbottom);
        $footerStyleRightbottom->applyFromArray($this->xls->footerStyleRightbottom);
        // end style

        $obj = new Excel();

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('assets/images/Logo_PSG.gif');
        $objPHPExcel = $obj->createSheet(0);

        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getPageSetup()->setFitToPage(false);
        $objPHPExcel->getPageSetup()->setScale(80);
        $objPHPExcel->getPageMargins()->setLeft(0.1);
        $objPHPExcel->getPageMargins()->setRight(0.1);
        $objPHPExcel->getPageMargins()->setBottom(0.1);
        $objPHPExcel->getPageMargins()->setTop(0.1);
        $objPHPExcel->getPageSetup()->setVerticalCentered(true);
        $objPHPExcel->getPageSetup()->setHorizontalCentered(true);

        $range = array();
        $rangeCol = "AJ";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(3);
        }

        $count1 = count($dtdetail_shift1);
        $jml_data_perpage = 10;
        if ($count1 < $jml_data_perpage) {
            $jml_page = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page = $count1 / $jml_data_perpage;
            } else {
                $jml_page = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }
        // var_dump(count($dtdetail_shift1));
        // die;

        $count1 = count($dtdetail_shift2);
        $jml_data_perpage = 10;
        if($count1 < $jml_data_perpage) {
            $jml_page = 1;
        } else {
            if(($count1 % $jml_data_perpage) == 0){
                $jml_page = $count1 / $jml_data_perpage;
            } else {
                $jml_page = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }

        $count1 = count($dtdetail_shift3);
        $jml_data_perpage = 10;
        if($count1 < $jml_data_perpage) {
            $jml_page = 1;
        } else {
            if(($count1 % $jml_data_perpage) == 0){
                $jml_page = $count1 / $jml_data_perpage;
            } else {
                $jml_page = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }

        $countb = count($dtdetail_b);
        $jml_data_perpage = 10;
        if($countb < $jml_data_perpage) {
            $jml_page = 1;
        } else {
            if(($countb % $jml_data_perpage) == 0){
                $jml_page = $countb / $jml_data_perpage;
            } else {
                $jml_page = floor(($countb / $jml_data_perpage)) + 1;
            }
        }

        $jml_row_perpage = 65;


        for ($i1 = 0; $i1 < $jml_page; $i1++) {

            $start_row = ($i1 * $jml_row_perpage) + 1;
            $finish_row = ((($i1 * $jml_row_perpage) + 1) + ($jml_row_perpage));

            $start_detail = ($i1 * $jml_data_perpage);
            $finish_detail = (($i1 * $jml_data_perpage) + ($jml_data_perpage - 1));

            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/Logo_PSG.gif');
            $gbr->setWidthAndHeight(45, 45);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('B' . $start_row);

            $objPHPExcel->mergeCells('A' . $start_row . ':D' . ($start_row + 1));
            $objPHPExcel->mergeCells('E' . $start_row . ':Z' . ($start_row + 1))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('AA' . $start_row . ':AB' . $start_row)->setCellValue('AA' . $start_row, 'Doc');
            $objPHPExcel->mergeCells('AC' . $start_row . ':AJ' . $start_row)->setCellValue('AC' . $start_row, ': ' . $docno);
            $objPHPExcel->mergeCells('AA' . ($start_row + 1) . ':AB' . ($start_row + 1))->setCellValue('AA' . ($start_row + 1), 'Date');
            $objPHPExcel->mergeCells('AC' . ($start_row + 1) . ':AJ' . ($start_row + 1))->setCellValue('AC' . ($start_row + 1), ':' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' . ($start_row + 2) . ':D' . ($start_row + 2))->setCellValue('A' . ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' . ($start_row + 2) . ':Z' . ($start_row + 2))->setCellValue('E' . ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AA' . ($start_row + 2) . ':AB' . ($start_row + 2))->setCellValue('AA' . ($start_row + 2), 'Page');
            $objPHPExcel->mergeCells('AC' . ($start_row + 2) . ':AJ' . ($start_row + 2))->setCellValue('AC' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . ($jml_page *3));

            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 2) . ':AJ' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle, 'A' . ($start_row) . ':Z' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleLeftTop, 'AA' . ($start_row) . ':AB' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AC' . $start_row . ':AJ' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AA' . ($start_row + 2) . ':AB' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AC' . ($start_row + 2) . ':AJ' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':Z' . ($start_row + 2));
            $objPHPExcel->getStyle('AC' . ($start_row) . ':AJ' . ($start_row))->getFont()->setSize(10);

            $objPHPExcel->mergeCells('B' . ($start_row + 4) . ':W' . ($start_row + 4))->setCellValue('B' . ($start_row + 4), "I. LOKASI INSPEKSI SETELAH PARING (Inspeksi I)");
            $objPHPExcel->mergeCells('X' . ($start_row + 4) . ':AI' . ($start_row + 4))->setCellValue('X' . ($start_row + 4), "Ukuran Sample (n) = 500 Pcs");
            $objPHPExcel->mergeCells('B' . ($start_row + 5) . ':E' . ($start_row + 8))->setCellValue('B' . ($start_row + 5), "JAM AMBIL SAMPLE");
            $objPHPExcel->mergeCells('F' . ($start_row + 5) . ':AI' . ($start_row + 5))->setCellValue('F' . ($start_row + 5), "SHIFT I / " . $shift1 . " / (06:00 - 14:00 WIB)" );
            $objPHPExcel->mergeCells('F' . ($start_row + 6) . ':K' . ($start_row + 7))->setCellValue('F' . ($start_row + 6), "KULIT ARI \n MAX. 4%");
            $objPHPExcel->mergeCells('L' . ($start_row + 6) . ':Q' . ($start_row + 7))->setCellValue('L' . ($start_row + 6), "SABUT \n MAX. 0.5%");
            $objPHPExcel->mergeCells('R' . ($start_row + 6) . ':W' . ($start_row + 7))->setCellValue('R' . ($start_row + 6), "TOMBONG \n MAX. 2%");
            $objPHPExcel->mergeCells('X' . ($start_row + 6) . ':AC' . ($start_row + 7))->setCellValue('X' . ($start_row + 6), "BENDA ASING \n MAX. 0%");
            $objPHPExcel->mergeCells('AD' . ($start_row + 6) . ':AI' . ($start_row + 7))->setCellValue('AD' . ($start_row + 6), "BAD MEAT \n MAX. 4%");
            $objPHPExcel->mergeCells('F' . ($start_row + 8) . ':H' . ($start_row + 8))->setCellValue('F' . ($start_row + 8), "(PCS)");
            $objPHPExcel->mergeCells('I' . ($start_row + 8) . ':K' . ($start_row + 8))->setCellValue('I' . ($start_row + 8), "(%)");
            $objPHPExcel->mergeCells('L' . ($start_row + 8) . ':N' . ($start_row + 8))->setCellValue('L' . ($start_row + 8), "(PCS)");
            $objPHPExcel->mergeCells('O' . ($start_row + 8) . ':Q' . ($start_row + 8))->setCellValue('O' . ($start_row + 8), "(%)");
            $objPHPExcel->mergeCells('R' . ($start_row + 8) . ':T' . ($start_row + 8))->setCellValue('R' . ($start_row + 8), "(PCS)");
            $objPHPExcel->mergeCells('U' . ($start_row + 8) . ':W' . ($start_row + 8))->setCellValue('U' . ($start_row + 8), "(%)");
            $objPHPExcel->mergeCells('X' . ($start_row + 8) . ':Z' . ($start_row + 8))->setCellValue('X' . ($start_row + 8), "(PCS)");
            $objPHPExcel->mergeCells('AA' . ($start_row + 8) . ':AC' . ($start_row + 8))->setCellValue('AA' . ($start_row + 8), "(%)");
            $objPHPExcel->mergeCells('AD' . ($start_row + 8) . ':AF' . ($start_row + 8))->setCellValue('AD' . ($start_row + 8), "(PCS)");
            $objPHPExcel->mergeCells('AG' . ($start_row + 8) . ':AI' . ($start_row + 8))->setCellValue('AG' . ($start_row + 8), "(%)");

            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . ($start_row + 3) . ':AJ' . ($start_row + 8));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($start_row + 3) . ':A' . ($start_row + 8));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($start_row + 5) . ':AI' . ($start_row + 8));
            $objPHPExcel->getStyle('B' . ($start_row + 5) . ':AI' . ($start_row + 8))->getFont()->setBold(true);

            $start_row2 = $start_row + 8;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {
                $start_row2++;
                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $start_row2 . ':AI' . $start_row2);
                $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . ($start_row2) . ':AJ' . ($start_row2));
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($start_row2) . ':A' . ($start_row2));
                $objPHPExcel->getStyle('B' .  $start_row2 . ':AI' .  $start_row2)->getFont()->setBold(false);
                $objPHPExcel->getStyle('B' . ($start_row2) . ':AI' . ($start_row2))->getFont()->setSize(10);
                if (isset($nomor[$arr])) {
                    $dt_nomor[$arr] = $nomor[$arr];
                } else {
                    $dt_nomor[$arr] = "";
                }

                if (isset($jam_sampling[$arr])) {
                    $dt_jam_sampling[$arr] = $jam_sampling[$arr];
                } else {
                    $dt_jam_sampling[$arr] = "";
                }
                if (isset($dtl_pcs_kulit[$arr])) {
                    $dt_dtl_pcs_kulit[$arr] = $dtl_pcs_kulit[$arr];
                } else {
                    $dt_dtl_pcs_kulit[$arr] = "";
                }
                if (isset($dtl_prsn_kulit[$arr])) {
                    $dt_dtl_prsn_kulit[$arr] = $dtl_prsn_kulit[$arr];
                } else {
                    $dt_dtl_prsn_kulit[$arr] = "";
                }

                if (isset($dtl_pcs_sabut[$arr])) {
                    $dt_dtl_pcs_sabut[$arr] = $dtl_pcs_sabut[$arr];
                } else {
                    $dt_dtl_pcs_sabut[$arr] = "";
                }
                if (isset($dtl_prsn_sabut[$arr])) {
                    $dt_dtl_prsn_sabut[$arr] = $dtl_prsn_sabut[$arr];
                } else {
                    $dt_dtl_prsn_sabut[$arr] = "";
                }
                if (isset($dtl_pcs_tombong[$arr])) {
                    $dt_dtl_pcs_tombong[$arr] = $dtl_pcs_tombong[$arr];
                } else {
                    $dt_dtl_pcs_tombong[$arr] = "";
                }
                if (isset($dtl_prsn_tombong[$arr])) {
                    $dt_dtl_prsn_tombong[$arr] = $dtl_prsn_tombong[$arr];
                } else {
                    $dt_dtl_prsn_tombong[$arr] = "";
                }
                if (isset($dtl_pcs_benda[$arr])) {
                    $dt_dtl_pcs_benda[$arr] = $dtl_pcs_benda[$arr];
                } else {
                    $dt_dtl_pcs_benda[$arr] = "";
                }
                if (isset($dtl_prsn_benda[$arr])) {
                    $dt_dtl_prsn_benda[$arr] = $dtl_prsn_benda[$arr];
                } else {
                    $dt_dtl_prsn_benda[$arr] = "";
                }
                if (isset($dtl_pcs_bad[$arr])) {
                    $dt_dtl_pcs_bad[$arr] = $dtl_pcs_bad[$arr];
                } else {
                    $dt_dtl_pcs_bad[$arr] = "";
                }
                if (isset($dtl_prsn_bad[$arr])) {
                    $dt_dtl_prsn_bad[$arr] = $dtl_prsn_bad[$arr];
                } else {
                    $dt_dtl_prsn_bad[$arr] = "";
                }

                $objPHPExcel->mergeCells('B' . $start_row2 . ':E' . $start_row2)->setCellValue('B' . $start_row2, $dt_jam_sampling[$arr]);
                $objPHPExcel->mergeCells('F' . $start_row2 . ':H' . $start_row2)->setCellValue('F' . $start_row2, $dt_dtl_pcs_kulit[$arr]);
                $objPHPExcel->mergeCells('I' . $start_row2 . ':K' . $start_row2)->setCellValue('I' . $start_row2, $dt_dtl_prsn_kulit[$arr]);
                $objPHPExcel->mergeCells('L' . $start_row2 . ':N' . $start_row2)->setCellValue('L' . $start_row2, $dt_dtl_pcs_sabut[$arr]);
                $objPHPExcel->mergeCells('O' . $start_row2 . ':Q' . $start_row2)->setCellValue('O' . $start_row2, $dt_dtl_prsn_sabut[$arr]);
                $objPHPExcel->mergeCells('R' . $start_row2 . ':T' . $start_row2)->setCellValue('R' . $start_row2, $dt_dtl_pcs_tombong[$arr]);
                $objPHPExcel->mergeCells('U' . $start_row2 . ':W' . $start_row2)->setCellValue('U' . $start_row2, $dt_dtl_prsn_tombong[$arr]);
                $objPHPExcel->mergeCells('X' . $start_row2 . ':Z' . $start_row2)->setCellValue('X' . $start_row2, $dt_dtl_pcs_benda[$arr]);
                $objPHPExcel->mergeCells('AA' . $start_row2 . ':AC' . $start_row2)->setCellValue('AA' . $start_row2, $dt_dtl_prsn_benda[$arr]);
                $objPHPExcel->mergeCells('AD' . $start_row2 . ':AF' . $start_row2)->setCellValue('AD' . $start_row2, $dt_dtl_pcs_bad[$arr]);
                $objPHPExcel->mergeCells('AG' . $start_row2 . ':AI' . $start_row2)->setCellValue('AG' . $start_row2, $dt_dtl_prsn_bad[$arr]);
            }

            $total_rata1  = $start_row2 +1;

            $objPHPExcel->setSharedStyle($headerStyle, 'B' . $total_rata1 . ':AI' . ($total_rata1 + 1));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . $total_rata1 . ':AJ' . ($total_rata1 + 1));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . $total_rata1 . ':A' . ($total_rata1 + 1));
            $objPHPExcel->mergeCells('B' . ($total_rata1) . ':E' . ($total_rata1))->setCellValue('B' . ($total_rata1), 'JUMLAH');
            $objPHPExcel->mergeCells('B' . ($total_rata1 + 1) . ':E' . ($total_rata1 + 1))->setCellValue('B' . ($total_rata1 + 1), 'RATA-RATA');
            $objPHPExcel->mergeCells('F' . $total_rata1 . ':H' . $total_rata1)->setCellValue('F' . $total_rata1, $tdtl_pcs_kulit_sf1);
            $objPHPExcel->mergeCells('I' . $total_rata1 . ':K' . $total_rata1)->setCellValue('I' . $total_rata1, $tdtl_prsn_kulit_sf1);
            $objPHPExcel->mergeCells('L' . $total_rata1 . ':N' . $total_rata1)->setCellValue('L' . $total_rata1, $tdtl_pcs_sabut_sf1);
            $objPHPExcel->mergeCells('O' . $total_rata1 . ':Q' . $total_rata1)->setCellValue('O' . $total_rata1, $tdtl_prsn_sabut_sf1);
            $objPHPExcel->mergeCells('R' . $total_rata1 . ':T' . $total_rata1)->setCellValue('R' . $total_rata1, $tdtl_pcs_tombong_sf1);
            $objPHPExcel->mergeCells('U' . $total_rata1 . ':W' . $total_rata1)->setCellValue('U' . $total_rata1, $tdtl_prsn_tombong_sf1);
            $objPHPExcel->mergeCells('X' . $total_rata1 . ':Z' . $total_rata1)->setCellValue('X' . $total_rata1, $tdtl_pcs_benda_sf1);
            $objPHPExcel->mergeCells('AA' . $total_rata1 . ':AC' . $total_rata1)->setCellValue('AA' . $total_rata1, $tdtl_prsn_benda_sf1);
            $objPHPExcel->mergeCells('AD' . $total_rata1 . ':AF' . $total_rata1)->setCellValue('AD' . $total_rata1, $tdtl_pcs_bad_sf1);
            $objPHPExcel->mergeCells('AG' . $total_rata1 . ':AI' . $total_rata1)->setCellValue('AG' . $total_rata1, $tdtl_prsn_bad_sf1);

            $objPHPExcel->mergeCells('F' . ($total_rata1 + 1) . ':H' . ($total_rata1 + 1))->setCellValue('F' . ($total_rata1 + 1), $tjml_pcs_kulit_sf1>0 ? number_format($tdtl_pcs_kulit_sf1/$tjml_pcs_kulit_sf1,2):'');
            $objPHPExcel->mergeCells('I' . ($total_rata1 + 1) . ':K' . ($total_rata1 + 1))->setCellValue('I' . ($total_rata1 + 1), $tjml_prsn_kulit_sf1>0 ? number_format($tdtl_prsn_kulit_sf1/$tjml_prsn_kulit_sf1,2):'');
            $objPHPExcel->mergeCells('L' . ($total_rata1 + 1) . ':N' . ($total_rata1 + 1))->setCellValue('L' . ($total_rata1 + 1), $tjml_pcs_sabut_sf1>0 ? number_format($tdtl_pcs_sabut_sf1/$tjml_pcs_sabut_sf1,2):'');
            $objPHPExcel->mergeCells('O' . ($total_rata1 + 1) . ':Q' . ($total_rata1 + 1))->setCellValue('O' . ($total_rata1 + 1), $tjml_prsn_sabut_sf1>0 ? number_format($tdtl_prsn_sabut_sf1/$tjml_prsn_sabut_sf1,2):'');
            $objPHPExcel->mergeCells('R' . ($total_rata1 + 1) . ':T' . ($total_rata1 + 1))->setCellValue('R' . ($total_rata1 + 1), $tjml_pcs_tombong_sf1>0 ? number_format($tdtl_pcs_tombong_sf1/$tjml_pcs_tombong_sf1,2):'');
            $objPHPExcel->mergeCells('U' . ($total_rata1 + 1) . ':W' . ($total_rata1 + 1))->setCellValue('U' . ($total_rata1 + 1), $tjml_prsn_tombong_sf1>0 ? number_format($tdtl_prsn_tombong_sf1/$tjml_prsn_tombong_sf1,2):'');
            $objPHPExcel->mergeCells('X' . ($total_rata1 + 1) . ':Z' . ($total_rata1 + 1))->setCellValue('X' . ($total_rata1 + 1), $tjml_pcs_benda_sf1>0 ? number_format($tdtl_pcs_benda_sf1/$tjml_pcs_benda_sf1,2):'');
            $objPHPExcel->mergeCells('AA' . ($total_rata1 + 1) . ':AC' . ($total_rata1 + 1))->setCellValue('AA' . ($total_rata1 + 1), $tjml_prsn_benda_sf1>0 ? number_format($tdtl_prsn_benda_sf1/$tjml_prsn_benda_sf1,2):'');
            $objPHPExcel->mergeCells('AD' . ($total_rata1 + 1) . ':AF' . ($total_rata1 + 1))->setCellValue('AD' . ($total_rata1 + 1), $tjml_pcs_bad_sf1>0 ? number_format($tdtl_pcs_bad_sf1/$tjml_pcs_bad_sf1,2):'');
            $objPHPExcel->mergeCells('AG' . ($total_rata1 + 1) . ':AI' . ($total_rata1 + 1))->setCellValue('AG' . ($total_rata1 + 1), $tjml_prsn_bad_sf1>0 ? number_format($tdtl_prsn_bad_sf1/$tjml_prsn_bad_sf1,2):'');


            $start_table2 = $total_rata1 +1;

            $objPHPExcel->mergeCells('A' . ($start_table2 + 1) . ':AJ' . ($start_table2 + 1));
            $objPHPExcel->mergeCells('B' . ($start_table2 + 2) . ':E' . ($start_table2 + 5))->setCellValue('B' . ($start_table2 + 2), "JAM AMBIL SAMPLE");
            $objPHPExcel->mergeCells('F' . ($start_table2 + 2) . ':AI' . ($start_table2 + 2))->setCellValue('F' . ($start_table2 + 2), "SHIFT II / " . $shift2 . " (14:00 - 22:00 WIB)");
            $objPHPExcel->mergeCells('F' . ($start_table2 + 3) . ':K' . ($start_table2 + 4))->setCellValue('F' . ($start_table2 + 3), "KULIT ARI \n MAX. 4%");
            $objPHPExcel->mergeCells('L' . ($start_table2 + 3) . ':Q' . ($start_table2 + 4))->setCellValue('L' . ($start_table2 + 3), "SABUT \n MAX. 0.2%");
            $objPHPExcel->mergeCells('R' . ($start_table2 + 3) . ':W' . ($start_table2 + 4))->setCellValue('R' . ($start_table2 + 3), "TOMBONG \n MAX. 2%");
            $objPHPExcel->mergeCells('X' . ($start_table2 + 3) . ':AC' . ($start_table2 + 4))->setCellValue('X' . ($start_table2 + 3), "BENDA ASING \n MAX. 0%");
            $objPHPExcel->mergeCells('AD' . ($start_table2 + 3) . ':AI' . ($start_table2 + 4))->setCellValue('AD' . ($start_table2 + 3), "BAD MEAT \n MAX. 4%");
            $objPHPExcel->mergeCells('F' . ($start_table2 + 5) . ':H' . ($start_table2 + 5))->setCellValue('F' . ($start_table2 + 5), "(PCS)");
            $objPHPExcel->mergeCells('I' . ($start_table2 + 5) . ':K' . ($start_table2 + 5))->setCellValue('I' . ($start_table2 + 5), "(%)");
            $objPHPExcel->mergeCells('L' . ($start_table2 + 5) . ':N' . ($start_table2 + 5))->setCellValue('L' . ($start_table2 + 5), "(PCS)");
            $objPHPExcel->mergeCells('O' . ($start_table2 + 5) . ':Q' . ($start_table2 + 5))->setCellValue('O' . ($start_table2 + 5), "(%)");
            $objPHPExcel->mergeCells('R' . ($start_table2 + 5) . ':T' . ($start_table2 + 5))->setCellValue('R' . ($start_table2 + 5), "(PCS)");
            $objPHPExcel->mergeCells('U' . ($start_table2 + 5) . ':W' . ($start_table2 + 5))->setCellValue('U' . ($start_table2 + 5), "(%)");
            $objPHPExcel->mergeCells('X' . ($start_table2 + 5) . ':Z' . ($start_table2 + 5))->setCellValue('X' . ($start_table2 + 5), "(PCS)");
            $objPHPExcel->mergeCells('AA' . ($start_table2 + 5) . ':AC' . ($start_table2 + 5))->setCellValue('AA' . ($start_table2 + 5), "(%)");
            $objPHPExcel->mergeCells('AD' . ($start_table2 + 5) . ':AF' . ($start_table2 + 5))->setCellValue('AD' . ($start_table2 + 5), "(PCS)");
            $objPHPExcel->mergeCells('AG' . ($start_table2 + 5) . ':AI' . ($start_table2 + 5))->setCellValue('AG' . ($start_table2 + 5), "(%)");

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($start_table2) . ':AI' . ($start_table2 + 5));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . ($start_table2) . ':AJ' . ($start_table2 + 5));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($start_table2) . ':A' . ($start_table2 + 5));
            $objPHPExcel->getStyle('B' . ($start_table2 + 1) . ':AI' . ($start_table2 + 5))->getFont()->setBold(true);

            $dtl_row2 = $start_table2 + 5;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {
                $dtl_row2++;
                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $dtl_row2 . ':AI' . $dtl_row2);
                $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . $dtl_row2 . ':AJ' . $dtl_row2);
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . $dtl_row2 . ':A' . $dtl_row2);
                $objPHPExcel->getStyle('B' .  $dtl_row2 . ':AI' .  $dtl_row2)->getFont()->setBold(false);
                $objPHPExcel->getStyle('B' . ($dtl_row2) . ':AI' . ($dtl_row2))->getFont()->setSize(10);
                if (isset($nomor[$arr])) {
                    $dt_nomor[$arr] = $nomor[$arr];
                } else {
                    $dt_nomor[$arr] = "";
                }

                if (isset($jam_sampling_sf2[$arr])) {
                    $dt_jam_sampling_sf2[$arr] = $jam_sampling_sf2[$arr];
                } else {
                    $dt_jam_sampling_sf2[$arr] = "";
                }
                if (isset($dtl_pcs_kulit_sf2[$arr])) {
                    $dt_dtl_pcs_kulit_sf2[$arr] = $dtl_pcs_kulit_sf2[$arr];
                } else {
                    $dt_dtl_pcs_kulit_sf2[$arr] = "";
                }
                if (isset($dtl_prsn_kulit_sf2[$arr])) {
                    $dt_dtl_prsn_kulit_sf2[$arr] = $dtl_prsn_kulit_sf2[$arr];
                } else {
                    $dt_dtl_prsn_kulit_sf2[$arr] = "";
                }

                if (isset($dtl_pcs_sabut_sf2[$arr])) {
                    $dt_dtl_pcs_sabut_sf2[$arr] = $dtl_pcs_sabut_sf2[$arr];
                } else {
                    $dt_dtl_pcs_sabut_sf2[$arr] = "";
                }
                if (isset($dtl_prsn_sabut_sf2[$arr])) {
                    $dt_dtl_prsn_sabut_sf2[$arr] = $dtl_prsn_sabut_sf2[$arr];
                } else {
                    $dt_dtl_prsn_sabut_sf2[$arr] = "";
                }
                if (isset($dtl_pcs_tombong_sf2[$arr])) {
                    $dt_dtl_pcs_tombong_sf2[$arr] = $dtl_pcs_tombong_sf2[$arr];
                } else {
                    $dt_dtl_pcs_tombong_sf2[$arr] = "";
                }
                if (isset($dtl_prsn_tombong_sf2[$arr])) {
                    $dt_dtl_prsn_tombong_sf2[$arr] = $dtl_prsn_tombong_sf2[$arr];
                } else {
                    $dt_dtl_prsn_tombong_sf2[$arr] = "";
                }
                if (isset($dtl_pcs_benda_sf2[$arr])) {
                    $dt_dtl_pcs_benda_sf2[$arr] = $dtl_pcs_benda_sf2[$arr];
                } else {
                    $dt_dtl_pcs_benda_sf2[$arr] = "";
                }
                if (isset($dtl_prsn_benda_sf2[$arr])) {
                    $dt_dtl_prsn_benda_sf2[$arr] = $dtl_prsn_benda_sf2[$arr];
                } else {
                    $dt_dtl_prsn_benda_sf2[$arr] = "";
                }
                if (isset($dtl_pcs_bad_sf2[$arr])) {
                    $dt_dtl_pcs_bad_sf2[$arr] = $dtl_pcs_bad_sf2[$arr];
                } else {
                    $dt_dtl_pcs_bad_sf2[$arr] = "";
                }
                if (isset($dtl_prsn_bad_sf2[$arr])) {
                    $dt_dtl_prsn_bad_sf2[$arr] = $dtl_prsn_bad_sf2[$arr];
                } else {
                    $dt_dtl_prsn_bad_sf2[$arr] = "";
                }

                $objPHPExcel->mergeCells('B' . $dtl_row2 . ':E' . $dtl_row2)->setCellValue('B' . $dtl_row2, $dt_jam_sampling_sf2[$arr]);
                $objPHPExcel->mergeCells('F' . $dtl_row2 . ':H' . $dtl_row2)->setCellValue('F' . $dtl_row2, $dt_dtl_pcs_kulit_sf2[$arr]);
                $objPHPExcel->mergeCells('I' . $dtl_row2 . ':K' . $dtl_row2)->setCellValue('I' . $dtl_row2, $dt_dtl_prsn_kulit_sf2[$arr]);
                $objPHPExcel->mergeCells('L' . $dtl_row2 . ':N' . $dtl_row2)->setCellValue('L' . $dtl_row2, $dt_dtl_pcs_sabut_sf2[$arr]);
                $objPHPExcel->mergeCells('O' . $dtl_row2 . ':Q' . $dtl_row2)->setCellValue('O' . $dtl_row2, $dt_dtl_prsn_sabut_sf2[$arr]);
                $objPHPExcel->mergeCells('R' . $dtl_row2 . ':T' . $dtl_row2)->setCellValue('R' . $dtl_row2, $dt_dtl_pcs_tombong_sf2[$arr]);
                $objPHPExcel->mergeCells('U' . $dtl_row2 . ':W' . $dtl_row2)->setCellValue('U' . $dtl_row2, $dt_dtl_prsn_tombong_sf2[$arr]);
                $objPHPExcel->mergeCells('X' . $dtl_row2 . ':Z' . $dtl_row2)->setCellValue('X' . $dtl_row2, $dt_dtl_pcs_benda_sf2[$arr]);
                $objPHPExcel->mergeCells('AA' . $dtl_row2 . ':AC' . $dtl_row2)->setCellValue('AA' . $dtl_row2, $dt_dtl_prsn_benda_sf2[$arr]);
                $objPHPExcel->mergeCells('AD' . $dtl_row2 . ':AF' . $dtl_row2)->setCellValue('AD' . $dtl_row2, $dt_dtl_pcs_bad_sf2[$arr]);
                $objPHPExcel->mergeCells('AG' . $dtl_row2 . ':AI' . $dtl_row2)->setCellValue('AG' . $dtl_row2, $dt_dtl_prsn_bad_sf2[$arr]);
            }


            $total_rata2  = $dtl_row2 +1;

            $objPHPExcel->setSharedStyle($headerStyle, 'B' . $total_rata2 . ':AI' . ($total_rata2 + 1));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . $total_rata2 . ':AJ' . ($total_rata2 + 1));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . $total_rata2 . ':A' . ($total_rata2 + 1));
            $objPHPExcel->mergeCells('B' . ($total_rata2) . ':E' . ($total_rata2))->setCellValue('B' . ($total_rata2), 'JUMLAH');
            $objPHPExcel->mergeCells('B' . ($total_rata2 + 1) . ':E' . ($total_rata2 + 1))->setCellValue('B' . ($total_rata2 + 1), 'RATA-RATA');
            $objPHPExcel->mergeCells('F' . $total_rata2 . ':H' . $total_rata2)->setCellValue('F' . $total_rata2, $tdtl_pcs_kulit_sf2);
            $objPHPExcel->mergeCells('I' . $total_rata2 . ':K' . $total_rata2)->setCellValue('I' . $total_rata2, $tdtl_prsn_kulit_sf2);
            $objPHPExcel->mergeCells('L' . $total_rata2 . ':N' . $total_rata2)->setCellValue('L' . $total_rata2, $tdtl_pcs_sabut_sf2);
            $objPHPExcel->mergeCells('O' . $total_rata2 . ':Q' . $total_rata2)->setCellValue('O' . $total_rata2, $tdtl_prsn_sabut_sf2);
            $objPHPExcel->mergeCells('R' . $total_rata2 . ':T' . $total_rata2)->setCellValue('R' . $total_rata2, $tdtl_pcs_tombong_sf2);
            $objPHPExcel->mergeCells('U' . $total_rata2 . ':W' . $total_rata2)->setCellValue('U' . $total_rata2, $tdtl_prsn_tombong_sf2);
            $objPHPExcel->mergeCells('X' . $total_rata2 . ':Z' . $total_rata2)->setCellValue('X' . $total_rata2, $tdtl_pcs_benda_sf2);
            $objPHPExcel->mergeCells('AA' . $total_rata2 . ':AC' . $total_rata2)->setCellValue('AA' . $total_rata2, $tdtl_prsn_benda_sf2);
            $objPHPExcel->mergeCells('AD' . $total_rata2 . ':AF' . $total_rata2)->setCellValue('AD' . $total_rata2, $tdtl_pcs_bad_sf2);
            $objPHPExcel->mergeCells('AG' . $total_rata2 . ':AI' . $total_rata2)->setCellValue('AG' . $total_rata2, $tdtl_prsn_bad_sf2);

            $objPHPExcel->mergeCells('F' . ($total_rata2 + 1) . ':H' . ($total_rata2 + 1))->setCellValue('F' . ($total_rata2 + 1), $tjml_pcs_kulit_sf2 > 0 ? number_format($tdtl_pcs_kulit_sf2 / $tjml_pcs_kulit_sf2, 2) : '');
            $objPHPExcel->mergeCells('I' . ($total_rata2 + 1) . ':K' . ($total_rata2 + 1))->setCellValue('I' . ($total_rata2 + 1), $tjml_prsn_kulit_sf2 > 0 ? number_format($tdtl_prsn_kulit_sf2 / $tjml_prsn_kulit_sf2, 2) : '');
            $objPHPExcel->mergeCells('L' . ($total_rata2 + 1) . ':N' . ($total_rata2 + 1))->setCellValue('L' . ($total_rata2 + 1), $tjml_pcs_sabut_sf2 > 0 ? number_format($tdtl_pcs_sabut_sf2 / $tjml_pcs_sabut_sf2, 2) : '');
            $objPHPExcel->mergeCells('O' . ($total_rata2 + 1) . ':Q' . ($total_rata2 + 1))->setCellValue('O' . ($total_rata2 + 1), $tjml_prsn_sabut_sf2 > 0 ? number_format($tdtl_prsn_sabut_sf2 / $tjml_prsn_sabut_sf2, 2) : '');
            $objPHPExcel->mergeCells('R' . ($total_rata2 + 1) . ':T' . ($total_rata2 + 1))->setCellValue('R' . ($total_rata2 + 1), $tjml_pcs_tombong_sf2 > 0 ? number_format($tdtl_pcs_tombong_sf2 / $tjml_pcs_tombong_sf2, 2) : '');
            $objPHPExcel->mergeCells('U' . ($total_rata2 + 1) . ':W' . ($total_rata2 + 1))->setCellValue('U' . ($total_rata2 + 1), $tjml_prsn_tombong_sf2 > 0 ? number_format($tdtl_prsn_tombong_sf2 / $tjml_prsn_tombong_sf2, 2) : '');
            $objPHPExcel->mergeCells('X' . ($total_rata2 + 1) . ':Z' . ($total_rata2 + 1))->setCellValue('X' . ($total_rata2 + 1), $tjml_pcs_benda_sf2 > 0 ? number_format($tdtl_pcs_benda_sf2 / $tjml_pcs_benda_sf2, 2) : '');
            $objPHPExcel->mergeCells('AA' . ($total_rata2 + 1) . ':AC' . ($total_rata2 + 1))->setCellValue('AA' . ($total_rata2 + 1), $tjml_prsn_benda_sf2 > 0 ? number_format($tdtl_prsn_benda_sf2 / $tjml_prsn_benda_sf2, 2) : '');
            $objPHPExcel->mergeCells('AD' . ($total_rata2 + 1) . ':AF' . ($total_rata2 + 1))->setCellValue('AD' . ($total_rata2 + 1), $tjml_pcs_bad_sf2 > 0 ? number_format($tdtl_pcs_bad_sf2 / $tjml_pcs_bad_sf2, 2) : '');
            $objPHPExcel->mergeCells('AG' . ($total_rata2 + 1) . ':AI' . ($total_rata2 + 1))->setCellValue('AG' . ($total_rata2 + 1), $tjml_prsn_bad_sf2 > 0 ? number_format($tdtl_prsn_bad_sf2 / $tjml_prsn_bad_sf2, 2) : '');

            $start_table3 = $total_rata2 +1;
            $objPHPExcel->mergeCells('A' . ($start_table3 + 1) . ':AJ' . ($start_table3 + 1));
            $objPHPExcel->mergeCells('B' . ($start_table3 + 2) . ':E' . ($start_table3 + 5))->setCellValue('B' . ($start_table3 + 2), "JAM AMBIL SAMPLE");
            $objPHPExcel->mergeCells('F' . ($start_table3 + 2) . ':AI' . ($start_table3 + 2))->setCellValue('F' . ($start_table3 + 2), "SHIFT III / " . $shift3 . " / (22:00 - 06:00 WIB)");
            $objPHPExcel->mergeCells('F' . ($start_table3 + 3) . ':K' . ($start_table3 + 4))->setCellValue('F' . ($start_table3 + 3), "KULIT ARI \n MAX. 4%");
            $objPHPExcel->mergeCells('L' . ($start_table3 + 3) . ':Q' . ($start_table3 + 4))->setCellValue('L' . ($start_table3 + 3), "SABUT \n MAX. 0.2%");
            $objPHPExcel->mergeCells('R' . ($start_table3 + 3) . ':W' . ($start_table3 + 4))->setCellValue('R' . ($start_table3 + 3), "TOMBONG \n MAX. 2%");
            $objPHPExcel->mergeCells('X' . ($start_table3 + 3) . ':AC' . ($start_table3 + 4))->setCellValue('X' . ($start_table3 + 3), "BENDA ASING \n MAX. 0%");
            $objPHPExcel->mergeCells('AD' . ($start_table3 + 3) . ':AI' . ($start_table3 + 4))->setCellValue('AD' . ($start_table3 + 3), "BAD MEAT \n MAX. 4%");
            $objPHPExcel->mergeCells('F' . ($start_table3 + 5) . ':H' . ($start_table3 + 5))->setCellValue('F' . ($start_table3 + 5), "(PCS)");
            $objPHPExcel->mergeCells('I' . ($start_table3 + 5) . ':K' . ($start_table3 + 5))->setCellValue('I' . ($start_table3 + 5), "(%)");
            $objPHPExcel->mergeCells('L' . ($start_table3 + 5) . ':N' . ($start_table3 + 5))->setCellValue('L' . ($start_table3 + 5), "(PCS)");
            $objPHPExcel->mergeCells('O' . ($start_table3 + 5) . ':Q' . ($start_table3 + 5))->setCellValue('O' . ($start_table3 + 5), "(%)");
            $objPHPExcel->mergeCells('R' . ($start_table3 + 5) . ':T' . ($start_table3 + 5))->setCellValue('R' . ($start_table3 + 5), "(PCS)");
            $objPHPExcel->mergeCells('U' . ($start_table3 + 5) . ':W' . ($start_table3 + 5))->setCellValue('U' . ($start_table3 + 5), "(%)");
            $objPHPExcel->mergeCells('X' . ($start_table3 + 5) . ':Z' . ($start_table3 + 5))->setCellValue('X' . ($start_table3 + 5), "(PCS)");
            $objPHPExcel->mergeCells('AA' . ($start_table3 + 5) . ':AC' . ($start_table3 + 5))->setCellValue('AA' . ($start_table3 + 5), "(%)");
            $objPHPExcel->mergeCells('AD' . ($start_table3 + 5) . ':AF' . ($start_table3 + 5))->setCellValue('AD' . ($start_table3 + 5), "(PCS)");
            $objPHPExcel->mergeCells('AG' . ($start_table3 + 5) . ':AI' . ($start_table3 + 5))->setCellValue('AG' . ($start_table3 + 5), "(%)");

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($start_table3) . ':AI' . ($start_table3 + 5));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . ($start_table3) . ':AJ' . ($start_table3 + 5));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($start_table3) . ':A' . ($start_table3 + 5));
            $objPHPExcel->getStyle('B' . ($start_table3 + 1) . ':AI' . ($start_table3 + 5))->getFont()->setBold(true);

            $dtl_row3 = $start_table3 + 5;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {
                $dtl_row3++;
                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $dtl_row3 . ':AI' . $dtl_row3);
                $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . $dtl_row3 . ':AJ' . $dtl_row3);
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . $dtl_row3 . ':A' . $dtl_row3);
                $objPHPExcel->getStyle('B' .  $dtl_row3 . ':AI' .  $dtl_row3)->getFont()->setBold(false);
                $objPHPExcel->getStyle('B' . ($dtl_row3) . ':AI' . ($dtl_row3))->getFont()->setSize(10);
                if (isset($nomor[$arr])) {
                    $dt_nomor[$arr] = $nomor[$arr];
                } else {
                    $dt_nomor[$arr] = "";
                }

                if (isset($jam_sampling_sf3[$arr])) {
                    $dt_jam_sampling_sf3[$arr] = $jam_sampling_sf3[$arr];
                } else {
                    $dt_jam_sampling_sf3[$arr] = "";
                }
                if (isset($dtl_pcs_kulit_sf3[$arr])) {
                    $dt_dtl_pcs_kulit_sf3[$arr] = $dtl_pcs_kulit_sf3[$arr];
                } else {
                    $dt_dtl_pcs_kulit_sf3[$arr] = "";
                }
                if (isset($dtl_prsn_kulit_sf3[$arr])) {
                    $dt_dtl_prsn_kulit_sf3[$arr] = $dtl_prsn_kulit_sf3[$arr];
                } else {
                    $dt_dtl_prsn_kulit_sf3[$arr] = "";
                }

                if (isset($dtl_pcs_sabut_sf3[$arr])) {
                    $dt_dtl_pcs_sabut_sf3[$arr] = $dtl_pcs_sabut_sf3[$arr];
                } else {
                    $dt_dtl_pcs_sabut_sf3[$arr] = "";
                }
                if (isset($dtl_prsn_sabut_sf3[$arr])) {
                    $dt_dtl_prsn_sabut_sf3[$arr] = $dtl_prsn_sabut_sf3[$arr];
                } else {
                    $dt_dtl_prsn_sabut_sf3[$arr] = "";
                }
                if (isset($dtl_pcs_tombong_sf3[$arr])) {
                    $dt_dtl_pcs_tombong_sf3[$arr] = $dtl_pcs_tombong_sf3[$arr];
                } else {
                    $dt_dtl_pcs_tombong_sf3[$arr] = "";
                }
                if (isset($dtl_prsn_tombong_sf3[$arr])) {
                    $dt_dtl_prsn_tombong_sf3[$arr] = $dtl_prsn_tombong_sf3[$arr];
                } else {
                    $dt_dtl_prsn_tombong_sf3[$arr] = "";
                }
                if (isset($dtl_pcs_benda_sf3[$arr])) {
                    $dt_dtl_pcs_benda_sf3[$arr] = $dtl_pcs_benda_sf3[$arr];
                } else {
                    $dt_dtl_pcs_benda_sf3[$arr] = "";
                }
                if (isset($dtl_prsn_benda_sf3[$arr])) {
                    $dt_dtl_prsn_benda_sf3[$arr] = $dtl_prsn_benda_sf3[$arr];
                } else {
                    $dt_dtl_prsn_benda_sf3[$arr] = "";
                }
                if (isset($dtl_pcs_bad_sf3[$arr])) {
                    $dt_dtl_pcs_bad_sf3[$arr] = $dtl_pcs_bad_sf3[$arr];
                } else {
                    $dt_dtl_pcs_bad_sf3[$arr] = "";
                }
                if (isset($dtl_prsn_bad_sf3[$arr])) {
                    $dt_dtl_prsn_bad_sf3[$arr] = $dtl_prsn_bad_sf3[$arr];
                } else {
                    $dt_dtl_prsn_bad_sf3[$arr] = "";
                }

                $objPHPExcel->mergeCells('B' . $dtl_row3 . ':E' . $dtl_row3)->setCellValue('B' . $dtl_row3, $dt_jam_sampling_sf3[$arr]);
                $objPHPExcel->mergeCells('F' . $dtl_row3 . ':H' . $dtl_row3)->setCellValue('F' . $dtl_row3, $dt_dtl_pcs_kulit_sf3[$arr]);
                $objPHPExcel->mergeCells('I' . $dtl_row3 . ':K' . $dtl_row3)->setCellValue('I' . $dtl_row3, $dt_dtl_prsn_kulit_sf3[$arr]);
                $objPHPExcel->mergeCells('L' . $dtl_row3 . ':N' . $dtl_row3)->setCellValue('L' . $dtl_row3, $dt_dtl_pcs_sabut_sf3[$arr]);
                $objPHPExcel->mergeCells('O' . $dtl_row3 . ':Q' . $dtl_row3)->setCellValue('O' . $dtl_row3, $dt_dtl_prsn_sabut_sf3[$arr]);
                $objPHPExcel->mergeCells('R' . $dtl_row3 . ':T' . $dtl_row3)->setCellValue('R' . $dtl_row3, $dt_dtl_pcs_tombong_sf3[$arr]);
                $objPHPExcel->mergeCells('U' . $dtl_row3 . ':W' . $dtl_row3)->setCellValue('U' . $dtl_row3, $dt_dtl_prsn_tombong_sf3[$arr]);
                $objPHPExcel->mergeCells('X' . $dtl_row3 . ':Z' . $dtl_row3)->setCellValue('X' . $dtl_row3, $dt_dtl_pcs_benda_sf3[$arr]);
                $objPHPExcel->mergeCells('AA' . $dtl_row3 . ':AC' . $dtl_row3)->setCellValue('AA' . $dtl_row3, $dt_dtl_prsn_benda_sf3[$arr]);
                $objPHPExcel->mergeCells('AD' . $dtl_row3 . ':AF' . $dtl_row3)->setCellValue('AD' . $dtl_row3, $dt_dtl_pcs_bad_sf3[$arr]);
                $objPHPExcel->mergeCells('AG' . $dtl_row3 . ':AI' . $dtl_row3)->setCellValue('AG' . $dtl_row3, $dt_dtl_prsn_bad_sf3[$arr]);
            }


            $total_rata3  = $dtl_row3 +1;

            $objPHPExcel->setSharedStyle($headerStyle, 'B' . $total_rata3 . ':AI' . ($total_rata3 + 1));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . $total_rata3 . ':AJ' . ($total_rata3 + 1));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . $total_rata3 . ':A' . ($total_rata3 + 1));
            $objPHPExcel->mergeCells('B' . ($total_rata3) . ':E' . ($total_rata3))->setCellValue('B' . ($total_rata3), 'JUMLAH');
            $objPHPExcel->mergeCells('B' . ($total_rata3 + 1) . ':E' . ($total_rata3 + 1))->setCellValue('B' . ($total_rata3 + 1), 'RATA-RATA');
            $objPHPExcel->mergeCells('F' . $total_rata3 . ':H' . $total_rata3)->setCellValue('F' . $total_rata3, $tdtl_pcs_kulit_sf3);
            $objPHPExcel->mergeCells('I' . $total_rata3 . ':K' . $total_rata3)->setCellValue('I' . $total_rata3, $tdtl_prsn_kulit_sf3);
            $objPHPExcel->mergeCells('L' . $total_rata3 . ':N' . $total_rata3)->setCellValue('L' . $total_rata3, $tdtl_pcs_sabut_sf3);
            $objPHPExcel->mergeCells('O' . $total_rata3 . ':Q' . $total_rata3)->setCellValue('O' . $total_rata3, $tdtl_prsn_sabut_sf3);
            $objPHPExcel->mergeCells('R' . $total_rata3 . ':T' . $total_rata3)->setCellValue('R' . $total_rata3, $tdtl_pcs_tombong_sf3);
            $objPHPExcel->mergeCells('U' . $total_rata3 . ':W' . $total_rata3)->setCellValue('U' . $total_rata3, $tdtl_prsn_tombong_sf3);
            $objPHPExcel->mergeCells('X' . $total_rata3 . ':Z' . $total_rata3)->setCellValue('X' . $total_rata3, $tdtl_pcs_benda_sf3);
            $objPHPExcel->mergeCells('AA' . $total_rata3 . ':AC' . $total_rata3)->setCellValue('AA' . $total_rata3, $tdtl_prsn_benda_sf3);
            $objPHPExcel->mergeCells('AD' . $total_rata3 . ':AF' . $total_rata3)->setCellValue('AD' . $total_rata3, $tdtl_pcs_bad_sf3);
            $objPHPExcel->mergeCells('AG' . $total_rata3 . ':AI' . $total_rata3)->setCellValue('AG' . $total_rata3, $tdtl_prsn_bad_sf3);

            $objPHPExcel->mergeCells('F' . ($total_rata3 + 1) . ':H' . ($total_rata3 + 1))->setCellValue('F' . ($total_rata3 + 1), $tjml_pcs_kulit_sf3 > 0 ? number_format($tdtl_pcs_kulit_sf3 / $tjml_pcs_kulit_sf3, 2) : '');
            $objPHPExcel->mergeCells('I' . ($total_rata3 + 1) . ':K' . ($total_rata3 + 1))->setCellValue('I' . ($total_rata3 + 1), $tjml_prsn_kulit_sf3 > 0 ? number_format($tdtl_prsn_kulit_sf3 / $tjml_prsn_kulit_sf3, 2) : '');
            $objPHPExcel->mergeCells('L' . ($total_rata3 + 1) . ':N' . ($total_rata3 + 1))->setCellValue('L' . ($total_rata3 + 1), $tjml_pcs_sabut_sf3 > 0 ? number_format($tdtl_pcs_sabut_sf3 / $tjml_pcs_sabut_sf3, 2) : '');
            $objPHPExcel->mergeCells('O' . ($total_rata3 + 1) . ':Q' . ($total_rata3 + 1))->setCellValue('O' . ($total_rata3 + 1), $tjml_prsn_sabut_sf3 > 0 ? number_format($tdtl_prsn_sabut_sf3 / $tjml_prsn_sabut_sf3, 2) : '');
            $objPHPExcel->mergeCells('R' . ($total_rata3 + 1) . ':T' . ($total_rata3 + 1))->setCellValue('R' . ($total_rata3 + 1), $tjml_pcs_tombong_sf3 > 0 ? number_format($tdtl_pcs_tombong_sf3 / $tjml_pcs_tombong_sf3, 2) : '');
            $objPHPExcel->mergeCells('U' . ($total_rata3 + 1) . ':W' . ($total_rata3 + 1))->setCellValue('U' . ($total_rata3 + 1), $tjml_prsn_tombong_sf3 > 0 ? number_format($tdtl_prsn_tombong_sf3 / $tjml_prsn_tombong_sf3, 2) : '');
            $objPHPExcel->mergeCells('X' . ($total_rata3 + 1) . ':Z' . ($total_rata3 + 1))->setCellValue('X' . ($total_rata3 + 1), $tjml_pcs_benda_sf3 > 0 ? number_format($tdtl_pcs_benda_sf3 / $tjml_pcs_benda_sf3, 2) : '');
            $objPHPExcel->mergeCells('AA' . ($total_rata3 + 1) . ':AC' . ($total_rata3 + 1))->setCellValue('AA' . ($total_rata3 + 1), $tjml_prsn_benda_sf3 > 0 ? number_format($tdtl_prsn_benda_sf3 / $tjml_prsn_benda_sf3, 2) : '');
            $objPHPExcel->mergeCells('AD' . ($total_rata3 + 1) . ':AF' . ($total_rata3 + 1))->setCellValue('AD' . ($total_rata3 + 1), $tjml_pcs_bad_sf3 > 0 ? number_format($tdtl_pcs_bad_sf3 / $tjml_pcs_bad_sf3, 2) : '');
            $objPHPExcel->mergeCells('AG' . ($total_rata3 + 1) . ':AI' . ($total_rata3 + 1))->setCellValue('AG' . ($total_rata3 + 1), $tjml_prsn_bad_sf3 > 0 ? number_format($tdtl_prsn_bad_sf3 / $tjml_prsn_bad_sf3, 2) : '');
            $start_row3 = $total_rata3 + 1;

            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('R' . ($start_row3 + 1) . ':AJ' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($start_row3 + 1) . ':AJ' . ($start_row3 + 1))->setCellValue('R' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':Q' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($start_row3 + 1) . ':AJ' . ($start_row3 + 1));
            $objPHPExcel->setBreak('A' . ($start_row3 + 1),  PHPExcel_Worksheet::BREAK_ROW);


            // PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2
            // PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2// PAGE 2

            $new_page2 = $start_row3 + 2;

            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/Logo_PSG.gif');
            $gbr->setWidthAndHeight(45, 45);
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('B' . $new_page2);

            $objPHPExcel->mergeCells('A' . $new_page2 . ':D' . ($new_page2 + 1));
            $objPHPExcel->mergeCells('E' . $new_page2 . ':Z' . ($new_page2 + 1))->setCellValue('E' . $new_page2,  $this->frmcop);
            $objPHPExcel->mergeCells('AA' . $new_page2 . ':AB' . $new_page2)->setCellValue('AA' . $new_page2, 'Doc');
            $objPHPExcel->mergeCells('AC' . $new_page2 . ':AJ' . $new_page2)->setCellValue('AC' . $new_page2, ': ' . $docno);
            $objPHPExcel->mergeCells('AA' . ($new_page2 + 1) . ':AB' . ($new_page2 + 1))->setCellValue('AA' . ($new_page2 + 1), 'Date');
            $objPHPExcel->mergeCells('AC' . ($new_page2 + 1) . ':AJ' . ($new_page2 + 1))->setCellValue('AC' . ($new_page2 + 1), ':' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' . ($new_page2 + 2) . ':D' . ($new_page2 + 2))->setCellValue('A' . ($new_page2 + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' . ($new_page2 + 2) . ':Z' . ($new_page2 + 2))->setCellValue('E' . ($new_page2 + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('AA' . ($new_page2 + 2) . ':AB' . ($new_page2 + 2))->setCellValue('AA' . ($new_page2 + 2), 'Page');
            $objPHPExcel->mergeCells('AC' . ($new_page2 + 2) . ':AJ' . ($new_page2 + 2))->setCellValue('AC' . ($new_page2 + 2), ': ' . ($i1 + 2) . ' of ' . ($jml_page *3));

            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($new_page2 + 2) . ':AJ' . ($new_page2 + 4));
            $objPHPExcel->setSharedStyle($headerStyle, 'A' . ($new_page2) . ':Z' . ($new_page2 + 2));
            $objPHPExcel->setSharedStyle($headerStyleLeftTop, 'AA' . ($new_page2) . ':AB' . ($new_page2 + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AC' . $new_page2 . ':AJ' . ($new_page2 + 2));
            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AA' . ($new_page2 + 2) . ':AB' . ($new_page2 + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AC' . ($new_page2 + 2) . ':AJ' . ($new_page2 + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($new_page2) . ':Z' . ($new_page2 + 2));
            $objPHPExcel->getStyle('AC' . ($new_page2) . ':AJ' . ($new_page2))->getFont()->setSize(10);

            $objPHPExcel->mergeCells('B' . ($new_page2 + 4) . ':W' . ($new_page2 + 4))->setCellValue('B' . ($new_page2 + 4), "II. LOKASI INSPEKSI TERAKHIR (SENTRAL SORTIR)");
            $objPHPExcel->mergeCells('X' . ($new_page2 + 4) . ':AI' . ($new_page2 + 4))->setCellValue('X' . ($new_page2 + 4), "Ukuran Sample (n) = 500 Pcs");
            $objPHPExcel->mergeCells('B' . ($new_page2 + 5) . ':E' . ($new_page2 + 8))->setCellValue('B' . ($new_page2 + 5), "JAM AMBIL SAMPLE");
            $objPHPExcel->mergeCells('F' . ($new_page2 + 5) . ':AI' . ($new_page2 + 5))->setCellValue('F' . ($new_page2 + 5), "SHIFT I / (06:00 - 14:00 WIB) / " . $shift1);
            $objPHPExcel->mergeCells('F' . ($new_page2 + 6) . ':K' . ($new_page2 + 7))->setCellValue('F' . ($new_page2 + 6), "KULIT ARI \n MAX. 2%");
            $objPHPExcel->mergeCells('L' . ($new_page2 + 6) . ':Q' . ($new_page2 + 7))->setCellValue('L' . ($new_page2 + 6), "SABUT \n MAX. 0.2%");
            $objPHPExcel->mergeCells('R' . ($new_page2 + 6) . ':W' . ($new_page2 + 7))->setCellValue('R' . ($new_page2 + 6), "TOMBONG \n MAX. 1%");
            $objPHPExcel->mergeCells('X' . ($new_page2 + 6) . ':AC' . ($new_page2 + 7))->setCellValue('X' . ($new_page2 + 6), "BENDA ASING \n MAX. 0%");
            $objPHPExcel->mergeCells('AD' . ($new_page2 + 6) . ':AI' . ($new_page2 + 7))->setCellValue('AD' . ($new_page2 + 6), "BAD MEAT \n MAX. 0%");
            $objPHPExcel->mergeCells('F' . ($new_page2 + 8) . ':H' . ($new_page2 + 8))->setCellValue('F' . ($new_page2 + 8), "(PCS)");
            $objPHPExcel->mergeCells('I' . ($new_page2 + 8) . ':K' . ($new_page2 + 8))->setCellValue('I' . ($new_page2 + 8), "(%)");
            $objPHPExcel->mergeCells('L' . ($new_page2 + 8) . ':N' . ($new_page2 + 8))->setCellValue('L' . ($new_page2 + 8), "(PCS)");
            $objPHPExcel->mergeCells('O' . ($new_page2 + 8) . ':Q' . ($new_page2 + 8))->setCellValue('O' . ($new_page2 + 8), "(%)");
            $objPHPExcel->mergeCells('R' . ($new_page2 + 8) . ':T' . ($new_page2 + 8))->setCellValue('R' . ($new_page2 + 8), "(PCS)");
            $objPHPExcel->mergeCells('U' . ($new_page2 + 8) . ':W' . ($new_page2 + 8))->setCellValue('U' . ($new_page2 + 8), "(%)");
            $objPHPExcel->mergeCells('X' . ($new_page2 + 8) . ':Z' . ($new_page2 + 8))->setCellValue('X' . ($new_page2 + 8), "(PCS)");
            $objPHPExcel->mergeCells('AA' . ($new_page2 + 8) . ':AC' . ($new_page2 + 8))->setCellValue('AA' . ($new_page2 + 8), "(%)");
            $objPHPExcel->mergeCells('AD' . ($new_page2 + 8) . ':AF' . ($new_page2 + 8))->setCellValue('AD' . ($new_page2 + 8), "(PCS)");
            $objPHPExcel->mergeCells('AG' . ($new_page2 + 8) . ':AI' . ($new_page2 + 8))->setCellValue('AG' . ($new_page2 + 8), "(%)");

            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . ($new_page2 + 3) . ':AJ' . ($new_page2 + 8));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($new_page2 + 3) . ':A' . ($new_page2 + 8));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($new_page2 + 5) . ':AI' . ($new_page2 + 8));
            $objPHPExcel->setSharedStyle($headerStyleLeft, 'B' . ($new_page2 + 4) . ':AI' . ($new_page2 + 4));
            $objPHPExcel->getStyle('B' . ($new_page2 + 5) . ':AI' . ($new_page2 + 8))->getFont()->setBold(true);

            $new_dtl1 = $new_page2 + 8;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {
                $new_dtl1++;
                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $new_dtl1 . ':AI' . $new_dtl1);
                $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . ($new_dtl1) . ':AJ' . ($new_dtl1));
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($new_dtl1) . ':A' . ($new_dtl1));
                $objPHPExcel->getStyle('B' .  $new_dtl1 . ':AI' .  $new_dtl1)->getFont()->setBold(false);
                $objPHPExcel->getStyle('B' . ($new_dtl1) . ':AI' . ($new_dtl1))->getFont()->setSize(10);
                if (isset($nomor[$arr])) {
                    $dt_nomor[$arr] = $nomor[$arr];
                } else {
                    $dt_nomor[$arr] = "";
                }

                if (isset($jam_sampling_sff1[$arr])) {
                    $dt_jam_sampling_sff1[$arr] = $jam_sampling_sff1[$arr];
                } else {
                    $dt_jam_sampling_sff1[$arr] = "";
                }
                if (isset($dtl_pcs_kulit_sff1[$arr])) {
                    $dt_dtl_pcs_kulit_sff1[$arr] = $dtl_pcs_kulit_sff1[$arr];
                } else {
                    $dt_dtl_pcs_kulit_sff1[$arr] = "";
                }
                if (isset($dtl_prsn_kulit_sff1[$arr])) {
                    $dt_dtl_prsn_kulit_sff1[$arr] = $dtl_prsn_kulit_sff1[$arr];
                } else {
                    $dt_dtl_prsn_kulit_sff1[$arr] = "";
                }

                if (isset($dtl_pcs_sabut_sff1[$arr])) {
                    $dt_dtl_pcs_sabut_sff1[$arr] = $dtl_pcs_sabut_sff1[$arr];
                } else {
                    $dt_dtl_pcs_sabut_sff1[$arr] = "";
                }
                if (isset($dtl_prsn_sabut_sff1[$arr])) {
                    $dt_dtl_prsn_sabut_sff1[$arr] = $dtl_prsn_sabut_sff1[$arr];
                } else {
                    $dt_dtl_prsn_sabut_sff1[$arr] = "";
                }
                if (isset($dtl_pcs_tombong_sff1[$arr])) {
                    $dt_dtl_pcs_tombong_sff1[$arr] = $dtl_pcs_tombong_sff1[$arr];
                } else {
                    $dt_dtl_pcs_tombong_sff1[$arr] = "";
                }
                if (isset($dtl_prsn_tombong_sff1[$arr])) {
                    $dt_dtl_prsn_tombong_sff1[$arr] = $dtl_prsn_tombong_sff1[$arr];
                } else {
                    $dt_dtl_prsn_tombong_sff1[$arr] = "";
                }
                if (isset($dtl_pcs_benda_sff1[$arr])) {
                    $dt_dtl_pcs_benda_sff1[$arr] = $dtl_pcs_benda_sff1[$arr];
                } else {
                    $dt_dtl_pcs_benda_sff1[$arr] = "";
                }
                if (isset($dtl_prsn_benda_sff1[$arr])) {
                    $dt_dtl_prsn_benda_sff1[$arr] = $dtl_prsn_benda_sff1[$arr];
                } else {
                    $dt_dtl_prsn_benda_sff1[$arr] = "";
                }
                if (isset($dtl_pcs_bad_sff1[$arr])) {
                    $dt_dtl_pcs_bad_sff1[$arr] = $dtl_pcs_bad_sff1[$arr];
                } else {
                    $dt_dtl_pcs_bad_sff1[$arr] = "";
                }
                if (isset($dtl_prsn_bad_sff1[$arr])) {
                    $dt_dtl_prsn_bad_sff1[$arr] = $dtl_prsn_bad_sff1[$arr];
                } else {
                    $dt_dtl_prsn_bad_sff1[$arr] = "";
                }

                $objPHPExcel->mergeCells('B' . $new_dtl1 . ':E' . $new_dtl1)->setCellValue('B' . $new_dtl1, $dt_jam_sampling_sff1[$arr]);
                $objPHPExcel->mergeCells('F' . $new_dtl1 . ':H' . $new_dtl1)->setCellValue('F' . $new_dtl1, $dt_dtl_pcs_kulit_sff1[$arr]);
                $objPHPExcel->mergeCells('I' . $new_dtl1 . ':K' . $new_dtl1)->setCellValue('I' . $new_dtl1, $dt_dtl_prsn_kulit_sff1[$arr]);
                $objPHPExcel->mergeCells('L' . $new_dtl1 . ':N' . $new_dtl1)->setCellValue('L' . $new_dtl1, $dt_dtl_pcs_sabut_sff1[$arr]);
                $objPHPExcel->mergeCells('O' . $new_dtl1 . ':Q' . $new_dtl1)->setCellValue('O' . $new_dtl1, $dt_dtl_prsn_sabut_sff1[$arr]);
                $objPHPExcel->mergeCells('R' . $new_dtl1 . ':T' . $new_dtl1)->setCellValue('R' . $new_dtl1, $dt_dtl_pcs_tombong_sff1[$arr]);
                $objPHPExcel->mergeCells('U' . $new_dtl1 . ':W' . $new_dtl1)->setCellValue('U' . $new_dtl1, $dt_dtl_prsn_tombong_sff1[$arr]);
                $objPHPExcel->mergeCells('X' . $new_dtl1 . ':Z' . $new_dtl1)->setCellValue('X' . $new_dtl1, $dt_dtl_pcs_benda_sff1[$arr]);
                $objPHPExcel->mergeCells('AA' . $new_dtl1 . ':AC' . $new_dtl1)->setCellValue('AA' . $new_dtl1, $dt_dtl_prsn_benda_sff1[$arr]);
                $objPHPExcel->mergeCells('AD' . $new_dtl1 . ':AF' . $new_dtl1)->setCellValue('AD' . $new_dtl1, $dt_dtl_pcs_bad_sff1[$arr]);
                $objPHPExcel->mergeCells('AG' . $new_dtl1 . ':AI' . $new_dtl1)->setCellValue('AG' . $new_dtl1, $dt_dtl_prsn_bad_sff1[$arr]);
            }

            $new_total_rata1  = $new_dtl1 + 1;

            $objPHPExcel->setSharedStyle($headerStyle, 'B' . $new_total_rata1 . ':AI' . ($new_total_rata1 + 1));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . $new_total_rata1 . ':AJ' . ($new_total_rata1 + 1));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . $new_total_rata1 . ':A' . ($new_total_rata1 + 1));
            $objPHPExcel->mergeCells('B' . ($new_total_rata1) . ':E' . ($new_total_rata1))->setCellValue('B' . ($new_total_rata1), 'JUMLAH');
            $objPHPExcel->mergeCells('B' . ($new_total_rata1 + 1) . ':E' . ($new_total_rata1 + 1))->setCellValue('B' . ($new_total_rata1 + 1), 'RATA-RATA');
            $objPHPExcel->mergeCells('F' . $new_total_rata1 . ':H' . $new_total_rata1)->setCellValue('F' . $new_total_rata1, $tdtl_pcs_kulit_sff1);
            $objPHPExcel->mergeCells('I' . $new_total_rata1 . ':K' . $new_total_rata1)->setCellValue('I' . $new_total_rata1, $tdtl_prsn_kulit_sff1);
            $objPHPExcel->mergeCells('L' . $new_total_rata1 . ':N' . $new_total_rata1)->setCellValue('L' . $new_total_rata1, $tdtl_pcs_sabut_sff1);
            $objPHPExcel->mergeCells('O' . $new_total_rata1 . ':Q' . $new_total_rata1)->setCellValue('O' . $new_total_rata1, $tdtl_prsn_sabut_sff1);
            $objPHPExcel->mergeCells('R' . $new_total_rata1 . ':T' . $new_total_rata1)->setCellValue('R' . $new_total_rata1, $tdtl_pcs_tombong_sff1);
            $objPHPExcel->mergeCells('U' . $new_total_rata1 . ':W' . $new_total_rata1)->setCellValue('U' . $new_total_rata1, $tdtl_prsn_tombong_sff1);
            $objPHPExcel->mergeCells('X' . $new_total_rata1 . ':Z' . $new_total_rata1)->setCellValue('X' . $new_total_rata1, $tdtl_pcs_benda_sff1);
            $objPHPExcel->mergeCells('AA' . $new_total_rata1 . ':AC' . $new_total_rata1)->setCellValue('AA' . $new_total_rata1, $tdtl_prsn_benda_sff1);
            $objPHPExcel->mergeCells('AD' . $new_total_rata1 . ':AF' . $new_total_rata1)->setCellValue('AD' . $new_total_rata1, $tdtl_pcs_bad_sff1);
            $objPHPExcel->mergeCells('AG' . $new_total_rata1 . ':AI' . $new_total_rata1)->setCellValue('AG' . $new_total_rata1, $tdtl_prsn_bad_sff1);

            $objPHPExcel->mergeCells('F' . ($new_total_rata1 + 1) . ':H' . ($new_total_rata1 + 1))->setCellValue('F' . ($new_total_rata1 + 1), $tjml_pcs_kulit_sff1 > 0 ? number_format($tdtl_pcs_kulit_sff1 / $tjml_pcs_kulit_sff1, 2) : '');
            $objPHPExcel->mergeCells('I' . ($new_total_rata1 + 1) . ':K' . ($new_total_rata1 + 1))->setCellValue('I' . ($new_total_rata1 + 1), $tjml_prsn_kulit_sff1 > 0 ? number_format($tdtl_prsn_kulit_sff1 / $tjml_prsn_kulit_sff1, 2) : '');
            $objPHPExcel->mergeCells('L' . ($new_total_rata1 + 1) . ':N' . ($new_total_rata1 + 1))->setCellValue('L' . ($new_total_rata1 + 1), $tjml_pcs_sabut_sff1 > 0 ? number_format($tdtl_pcs_sabut_sff1 / $tjml_pcs_sabut_sff1, 2) : '');
            $objPHPExcel->mergeCells('O' . ($new_total_rata1 + 1) . ':Q' . ($new_total_rata1 + 1))->setCellValue('O' . ($new_total_rata1 + 1), $tjml_prsn_sabut_sff1 > 0 ? number_format($tdtl_prsn_sabut_sff1 / $tjml_prsn_sabut_sff1, 2) : '');
            $objPHPExcel->mergeCells('R' . ($new_total_rata1 + 1) . ':T' . ($new_total_rata1 + 1))->setCellValue('R' . ($new_total_rata1 + 1), $tjml_pcs_tombong_sff1 > 0 ? number_format($tdtl_pcs_tombong_sff1 / $tjml_pcs_tombong_sff1, 2) : '');
            $objPHPExcel->mergeCells('U' . ($new_total_rata1 + 1) . ':W' . ($new_total_rata1 + 1))->setCellValue('U' . ($new_total_rata1 + 1), $tjml_prsn_tombong_sff1 > 0 ? number_format($tdtl_prsn_tombong_sff1 / $tjml_prsn_tombong_sff1, 2) : '');
            $objPHPExcel->mergeCells('X' . ($new_total_rata1 + 1) . ':Z' . ($new_total_rata1 + 1))->setCellValue('X' . ($new_total_rata1 + 1), $tjml_pcs_benda_sff1 > 0 ? number_format($tdtl_pcs_benda_sff1 / $tjml_pcs_benda_sff1, 2) : '');
            $objPHPExcel->mergeCells('AA' . ($new_total_rata1 + 1) . ':AC' . ($new_total_rata1 + 1))->setCellValue('AA' . ($new_total_rata1 + 1), $tjml_prsn_benda_sff1 > 0 ? number_format($tdtl_prsn_benda_sff1 / $tjml_prsn_benda_sff1, 2) : '');
            $objPHPExcel->mergeCells('AD' . ($new_total_rata1 + 1) . ':AF' . ($new_total_rata1 + 1))->setCellValue('AD' . ($new_total_rata1 + 1), $tjml_pcs_bad_sff1 > 0 ? number_format($tdtl_pcs_bad_sff1 / $tjml_pcs_bad_sff1, 2) : '');
            $objPHPExcel->mergeCells('AG' . ($new_total_rata1 + 1) . ':AI' . ($new_total_rata1 + 1))->setCellValue('AG' . ($new_total_rata1 + 1), $tjml_prsn_bad_sff1 > 0 ? number_format($tdtl_prsn_bad_sff1 / $tjml_prsn_bad_sff1, 2) : '');

            $new_table2 = $new_total_rata1 + 1;

            $objPHPExcel->mergeCells('A' . ($new_table2 + 1) . ':AJ' . ($new_table2 + 1));
            $objPHPExcel->mergeCells('B' . ($new_table2 + 2) . ':E' . ($new_table2 + 5))->setCellValue('B' . ($new_table2 + 2), "JAM AMBIL SAMPLE");
            $objPHPExcel->mergeCells('F' . ($new_table2 + 2) . ':AI' . ($new_table2 + 2))->setCellValue('F' . ($new_table2 + 2), "SHIFT II / (14:00 - 22:00 WIB) / " . $shift2);
            $objPHPExcel->mergeCells('F' . ($new_table2 + 3) . ':K' . ($new_table2 + 4))->setCellValue('F' . ($new_table2 + 3), "KULIT ARI \n MAX. 2%");
            $objPHPExcel->mergeCells('L' . ($new_table2 + 3) . ':Q' . ($new_table2 + 4))->setCellValue('L' . ($new_table2 + 3), "SABUT \n MAX. 0.2%");
            $objPHPExcel->mergeCells('R' . ($new_table2 + 3) . ':W' . ($new_table2 + 4))->setCellValue('R' . ($new_table2 + 3), "TOMBONG \n MAX. 1%");
            $objPHPExcel->mergeCells('X' . ($new_table2 + 3) . ':AC' . ($new_table2 + 4))->setCellValue('X' . ($new_table2 + 3), "BENDA ASING \n MAX. 0%");
            $objPHPExcel->mergeCells('AD' . ($new_table2 + 3) . ':AI' . ($new_table2 + 4))->setCellValue('AD' . ($new_table2 + 3), "BAD MEAT \n MAX. 0%");
            $objPHPExcel->mergeCells('F' . ($new_table2 + 5) . ':H' . ($new_table2 + 5))->setCellValue('F' . ($new_table2 + 5), "(PCS)");
            $objPHPExcel->mergeCells('I' . ($new_table2 + 5) . ':K' . ($new_table2 + 5))->setCellValue('I' . ($new_table2 + 5), "(%)");
            $objPHPExcel->mergeCells('L' . ($new_table2 + 5) . ':N' . ($new_table2 + 5))->setCellValue('L' . ($new_table2 + 5), "(PCS)");
            $objPHPExcel->mergeCells('O' . ($new_table2 + 5) . ':Q' . ($new_table2 + 5))->setCellValue('O' . ($new_table2 + 5), "(%)");
            $objPHPExcel->mergeCells('R' . ($new_table2 + 5) . ':T' . ($new_table2 + 5))->setCellValue('R' . ($new_table2 + 5), "(PCS)");
            $objPHPExcel->mergeCells('U' . ($new_table2 + 5) . ':W' . ($new_table2 + 5))->setCellValue('U' . ($new_table2 + 5), "(%)");
            $objPHPExcel->mergeCells('X' . ($new_table2 + 5) . ':Z' . ($new_table2 + 5))->setCellValue('X' . ($new_table2 + 5), "(PCS)");
            $objPHPExcel->mergeCells('AA' . ($new_table2 + 5) . ':AC' . ($new_table2 + 5))->setCellValue('AA' . ($new_table2 + 5), "(%)");
            $objPHPExcel->mergeCells('AD' . ($new_table2 + 5) . ':AF' . ($new_table2 + 5))->setCellValue('AD' . ($new_table2 + 5), "(PCS)");
            $objPHPExcel->mergeCells('AG' . ($new_table2 + 5) . ':AI' . ($new_table2 + 5))->setCellValue('AG' . ($new_table2 + 5), "(%)");

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($new_table2) . ':AI' . ($new_table2 + 5));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . ($new_table2) . ':AJ' . ($new_table2 + 5));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($new_table2) . ':A' . ($new_table2 + 5));
            $objPHPExcel->getStyle('B' . ($new_table2 + 1) . ':AI' . ($new_table2 + 5))->getFont()->setBold(true);

            $new_dtl2 = $new_table2 + 5;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {
                $new_dtl2++;
                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $new_dtl2 . ':AI' . $new_dtl2);
                $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . $new_dtl2 . ':AJ' . $new_dtl2);
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . $new_dtl2 . ':A' . $new_dtl2);
                $objPHPExcel->getStyle('B' .  $new_dtl2 . ':AI' .  $new_dtl2)->getFont()->setBold(false);
                $objPHPExcel->getStyle('B' . ($new_dtl2) . ':AI' . ($new_dtl2))->getFont()->setSize(10);
                if (isset($nomor[$arr])) {
                    $dt_nomor[$arr] = $nomor[$arr];
                } else {
                    $dt_nomor[$arr] = "";
                }

                if (isset($jam_sampling_sff2[$arr])) {
                    $dt_jam_sampling_sff2[$arr] = $jam_sampling_sff2[$arr];
                } else {
                    $dt_jam_sampling_sff2[$arr] = "";
                }
                if (isset($dtl_pcs_kulit_sff2[$arr])) {
                    $dt_dtl_pcs_kulit_sff2[$arr] = $dtl_pcs_kulit_sff2[$arr];
                } else {
                    $dt_dtl_pcs_kulit_sff2[$arr] = "";
                }
                if (isset($dtl_prsn_kulit_sff2[$arr])) {
                    $dt_dtl_prsn_kulit_sff2[$arr] = $dtl_prsn_kulit_sff2[$arr];
                } else {
                    $dt_dtl_prsn_kulit_sff2[$arr] = "";
                }

                if (isset($dtl_pcs_sabut_sff2[$arr])) {
                    $dt_dtl_pcs_sabut_sff2[$arr] = $dtl_pcs_sabut_sff2[$arr];
                } else {
                    $dt_dtl_pcs_sabut_sff2[$arr] = "";
                }
                if (isset($dtl_prsn_sabut_sff2[$arr])) {
                    $dt_dtl_prsn_sabut_sff2[$arr] = $dtl_prsn_sabut_sff2[$arr];
                } else {
                    $dt_dtl_prsn_sabut_sff2[$arr] = "";
                }
                if (isset($dtl_pcs_tombong_sff2[$arr])) {
                    $dt_dtl_pcs_tombong_sff2[$arr] = $dtl_pcs_tombong_sff2[$arr];
                } else {
                    $dt_dtl_pcs_tombong_sff2[$arr] = "";
                }
                if (isset($dtl_prsn_tombong_sff2[$arr])) {
                    $dt_dtl_prsn_tombong_sff2[$arr] = $dtl_prsn_tombong_sff2[$arr];
                } else {
                    $dt_dtl_prsn_tombong_sff2[$arr] = "";
                }
                if (isset($dtl_pcs_benda_sff2[$arr])) {
                    $dt_dtl_pcs_benda_sff2[$arr] = $dtl_pcs_benda_sff2[$arr];
                } else {
                    $dt_dtl_pcs_benda_sff2[$arr] = "";
                }
                if (isset($dtl_prsn_benda_sff2[$arr])) {
                    $dt_dtl_prsn_benda_sff2[$arr] = $dtl_prsn_benda_sff2[$arr];
                } else {
                    $dt_dtl_prsn_benda_sff2[$arr] = "";
                }
                if (isset($dtl_pcs_bad_sff2[$arr])) {
                    $dt_dtl_pcs_bad_sff2[$arr] = $dtl_pcs_bad_sff2[$arr];
                } else {
                    $dt_dtl_pcs_bad_sff2[$arr] = "";
                }
                if (isset($dtl_prsn_bad_sff2[$arr])) {
                    $dt_dtl_prsn_bad_sff2[$arr] = $dtl_prsn_bad_sff2[$arr];
                } else {
                    $dt_dtl_prsn_bad_sff2[$arr] = "";
                }

                $objPHPExcel->mergeCells('B' . $new_dtl2 . ':E' . $new_dtl2)->setCellValue('B' . $new_dtl2, $dt_jam_sampling_sff2[$arr]);
                $objPHPExcel->mergeCells('F' . $new_dtl2 . ':H' . $new_dtl2)->setCellValue('F' . $new_dtl2, $dt_dtl_pcs_kulit_sff2[$arr]);
                $objPHPExcel->mergeCells('I' . $new_dtl2 . ':K' . $new_dtl2)->setCellValue('I' . $new_dtl2, $dt_dtl_prsn_kulit_sff2[$arr]);
                $objPHPExcel->mergeCells('L' . $new_dtl2 . ':N' . $new_dtl2)->setCellValue('L' . $new_dtl2, $dt_dtl_pcs_sabut_sff2[$arr]);
                $objPHPExcel->mergeCells('O' . $new_dtl2 . ':Q' . $new_dtl2)->setCellValue('O' . $new_dtl2, $dt_dtl_prsn_sabut_sff2[$arr]);
                $objPHPExcel->mergeCells('R' . $new_dtl2 . ':T' . $new_dtl2)->setCellValue('R' . $new_dtl2, $dt_dtl_pcs_tombong_sff2[$arr]);
                $objPHPExcel->mergeCells('U' . $new_dtl2 . ':W' . $new_dtl2)->setCellValue('U' . $new_dtl2, $dt_dtl_prsn_tombong_sff2[$arr]);
                $objPHPExcel->mergeCells('X' . $new_dtl2 . ':Z' . $new_dtl2)->setCellValue('X' . $new_dtl2, $dt_dtl_pcs_benda_sff2[$arr]);
                $objPHPExcel->mergeCells('AA' . $new_dtl2 . ':AC' . $new_dtl2)->setCellValue('AA' . $new_dtl2, $dt_dtl_prsn_benda_sff2[$arr]);
                $objPHPExcel->mergeCells('AD' . $new_dtl2 . ':AF' . $new_dtl2)->setCellValue('AD' . $new_dtl2, $dt_dtl_pcs_bad_sff2[$arr]);
                $objPHPExcel->mergeCells('AG' . $new_dtl2 . ':AI' . $new_dtl2)->setCellValue('AG' . $new_dtl2, $dt_dtl_prsn_bad_sff2[$arr]);
            }

            $new_total_rata2  = $new_dtl2 + 1;

            $objPHPExcel->setSharedStyle($headerStyle, 'B' . $new_total_rata2 . ':AI' . ($new_total_rata2 + 1));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . $new_total_rata2 . ':AJ' . ($new_total_rata2 + 1));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . $new_total_rata2 . ':A' . ($new_total_rata2 + 1));
            $objPHPExcel->mergeCells('B' . ($new_total_rata2) . ':E' . ($new_total_rata2))->setCellValue('B' . ($new_total_rata2), 'JUMLAH');
            $objPHPExcel->mergeCells('B' . ($new_total_rata2 + 1) . ':E' . ($new_total_rata2 + 1))->setCellValue('B' . ($new_total_rata2 + 1), 'RATA-RATA');
            $objPHPExcel->mergeCells('F' . $new_total_rata2 . ':H' . $new_total_rata2)->setCellValue('F' . $new_total_rata2, $tdtl_pcs_kulit_sff2);
            $objPHPExcel->mergeCells('I' . $new_total_rata2 . ':K' . $new_total_rata2)->setCellValue('I' . $new_total_rata2, $tdtl_prsn_kulit_sff2);
            $objPHPExcel->mergeCells('L' . $new_total_rata2 . ':N' . $new_total_rata2)->setCellValue('L' . $new_total_rata2, $tdtl_pcs_sabut_sff2);
            $objPHPExcel->mergeCells('O' . $new_total_rata2 . ':Q' . $new_total_rata2)->setCellValue('O' . $new_total_rata2, $tdtl_prsn_sabut_sff2);
            $objPHPExcel->mergeCells('R' . $new_total_rata2 . ':T' . $new_total_rata2)->setCellValue('R' . $new_total_rata2, $tdtl_pcs_tombong_sff2);
            $objPHPExcel->mergeCells('U' . $new_total_rata2 . ':W' . $new_total_rata2)->setCellValue('U' . $new_total_rata2, $tdtl_prsn_tombong_sff2);
            $objPHPExcel->mergeCells('X' . $new_total_rata2 . ':Z' . $new_total_rata2)->setCellValue('X' . $new_total_rata2, $tdtl_pcs_benda_sff2);
            $objPHPExcel->mergeCells('AA' . $new_total_rata2 . ':AC' . $new_total_rata2)->setCellValue('AA' . $new_total_rata2, $tdtl_prsn_benda_sff2);
            $objPHPExcel->mergeCells('AD' . $new_total_rata2 . ':AF' . $new_total_rata2)->setCellValue('AD' . $new_total_rata2, $tdtl_pcs_bad_sff2);
            $objPHPExcel->mergeCells('AG' . $new_total_rata2 . ':AI' . $new_total_rata2)->setCellValue('AG' . $new_total_rata2, $tdtl_prsn_bad_sff2);

            $objPHPExcel->mergeCells('F' . ($new_total_rata2 + 1) . ':H' . ($new_total_rata2 + 1))->setCellValue('F' . ($new_total_rata2 + 1), $tjml_pcs_kulit_sff2 > 0 ? number_format($tdtl_pcs_kulit_sff2 / $tjml_pcs_kulit_sff2, 2) : '');
            $objPHPExcel->mergeCells('I' . ($new_total_rata2 + 1) . ':K' . ($new_total_rata2 + 1))->setCellValue('I' . ($new_total_rata2 + 1), $tjml_prsn_kulit_sff2 > 0 ? number_format($tdtl_prsn_kulit_sff2 / $tjml_prsn_kulit_sff2, 2) : '');
            $objPHPExcel->mergeCells('L' . ($new_total_rata2 + 1) . ':N' . ($new_total_rata2 + 1))->setCellValue('L' . ($new_total_rata2 + 1), $tjml_pcs_sabut_sff2 > 0 ? number_format($tdtl_pcs_sabut_sff2 / $tjml_pcs_sabut_sff2, 2) : '');
            $objPHPExcel->mergeCells('O' . ($new_total_rata2 + 1) . ':Q' . ($new_total_rata2 + 1))->setCellValue('O' . ($new_total_rata2 + 1), $tjml_prsn_sabut_sff2 > 0 ? number_format($tdtl_prsn_sabut_sff2 / $tjml_prsn_sabut_sff2, 2) : '');
            $objPHPExcel->mergeCells('R' . ($new_total_rata2 + 1) . ':T' . ($new_total_rata2 + 1))->setCellValue('R' . ($new_total_rata2 + 1), $tjml_pcs_tombong_sff2 > 0 ? number_format($tdtl_pcs_tombong_sff2 / $tjml_pcs_tombong_sff2, 2) : '');
            $objPHPExcel->mergeCells('U' . ($new_total_rata2 + 1) . ':W' . ($new_total_rata2 + 1))->setCellValue('U' . ($new_total_rata2 + 1), $tjml_prsn_tombong_sff2 > 0 ? number_format($tdtl_prsn_tombong_sff2 / $tjml_prsn_tombong_sff2, 2) : '');
            $objPHPExcel->mergeCells('X' . ($new_total_rata2 + 1) . ':Z' . ($new_total_rata2 + 1))->setCellValue('X' . ($new_total_rata2 + 1), $tjml_pcs_benda_sff2 > 0 ? number_format($tdtl_pcs_benda_sff2 / $tjml_pcs_benda_sff2, 2) : '');
            $objPHPExcel->mergeCells('AA' . ($new_total_rata2 + 1) . ':AC' . ($new_total_rata2 + 1))->setCellValue('AA' . ($new_total_rata2 + 1), $tjml_prsn_benda_sff2 > 0 ? number_format($tdtl_prsn_benda_sff2 / $tjml_prsn_benda_sff2, 2) : '');
            $objPHPExcel->mergeCells('AD' . ($new_total_rata2 + 1) . ':AF' . ($new_total_rata2 + 1))->setCellValue('AD' . ($new_total_rata2 + 1), $tjml_pcs_bad_sff2 > 0 ? number_format($tdtl_pcs_bad_sff2 / $tjml_pcs_bad_sff2, 2) : '');
            $objPHPExcel->mergeCells('AG' . ($new_total_rata2 + 1) . ':AI' . ($new_total_rata2 + 1))->setCellValue('AG' . ($new_total_rata2 + 1), $tjml_prsn_bad_sff2 > 0 ? number_format($tdtl_prsn_bad_sff2 / $tjml_prsn_bad_sff2, 2) : '');

            $new_table3 = $new_total_rata2 + 1;
            $objPHPExcel->mergeCells('A' . ($new_table3 + 1) . ':AJ' . ($new_table3 + 1));
            $objPHPExcel->mergeCells('B' . ($new_table3 + 2) . ':E' . ($new_table3 + 5))->setCellValue('B' . ($new_table3 + 2), "JAM AMBIL SAMPLE");
            $objPHPExcel->mergeCells('F' . ($new_table3 + 2) . ':AI' . ($new_table3 + 2))->setCellValue('F' . ($new_table3 + 2), "SHIFT III / (22:00 - 06:00 WIB) / " . $shift3);
            $objPHPExcel->mergeCells('F' . ($new_table3 + 3) . ':K' . ($new_table3 + 4))->setCellValue('F' . ($new_table3 + 3), "KULIT ARI \n MAX. 2%");
            $objPHPExcel->mergeCells('L' . ($new_table3 + 3) . ':Q' . ($new_table3 + 4))->setCellValue('L' . ($new_table3 + 3), "SABUT \n MAX. 0.2%");
            $objPHPExcel->mergeCells('R' . ($new_table3 + 3) . ':W' . ($new_table3 + 4))->setCellValue('R' . ($new_table3 + 3), "TOMBONG \n MAX. 1%");
            $objPHPExcel->mergeCells('X' . ($new_table3 + 3) . ':AC' . ($new_table3 + 4))->setCellValue('X' . ($new_table3 + 3), "BENDA ASING \n MAX. 0%");
            $objPHPExcel->mergeCells('AD' . ($new_table3 + 3) . ':AI' . ($new_table3 + 4))->setCellValue('AD' . ($new_table3 + 3), "BAD MEAT \n MAX. 0%");
            $objPHPExcel->mergeCells('F' . ($new_table3 + 5) . ':H' . ($new_table3 + 5))->setCellValue('F' . ($new_table3 + 5), "(PCS)");
            $objPHPExcel->mergeCells('I' . ($new_table3 + 5) . ':K' . ($new_table3 + 5))->setCellValue('I' . ($new_table3 + 5), "(%)");
            $objPHPExcel->mergeCells('L' . ($new_table3 + 5) . ':N' . ($new_table3 + 5))->setCellValue('L' . ($new_table3 + 5), "(PCS)");
            $objPHPExcel->mergeCells('O' . ($new_table3 + 5) . ':Q' . ($new_table3 + 5))->setCellValue('O' . ($new_table3 + 5), "(%)");
            $objPHPExcel->mergeCells('R' . ($new_table3 + 5) . ':T' . ($new_table3 + 5))->setCellValue('R' . ($new_table3 + 5), "(PCS)");
            $objPHPExcel->mergeCells('U' . ($new_table3 + 5) . ':W' . ($new_table3 + 5))->setCellValue('U' . ($new_table3 + 5), "(%)");
            $objPHPExcel->mergeCells('X' . ($new_table3 + 5) . ':Z' . ($new_table3 + 5))->setCellValue('X' . ($new_table3 + 5), "(PCS)");
            $objPHPExcel->mergeCells('AA' . ($new_table3 + 5) . ':AC' . ($new_table3 + 5))->setCellValue('AA' . ($new_table3 + 5), "(%)");
            $objPHPExcel->mergeCells('AD' . ($new_table3 + 5) . ':AF' . ($new_table3 + 5))->setCellValue('AD' . ($new_table3 + 5), "(PCS)");
            $objPHPExcel->mergeCells('AG' . ($new_table3 + 5) . ':AI' . ($new_table3 + 5))->setCellValue('AG' . ($new_table3 + 5), "(%)");

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($new_table3) . ':AI' . ($new_table3 + 5));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . ($new_table3) . ':AJ' . ($new_table3 + 5));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($new_table3) . ':A' . ($new_table3 + 5));
            $objPHPExcel->getStyle('B' . ($new_table3 + 1) . ':AI' . ($new_table3 + 5))->getFont()->setBold(true);

            $new_dtl_row3 = $new_table3 + 5;
            for ($arr = $start_detail; $arr <= $finish_detail; $arr++) {
                $new_dtl_row3++;
                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $new_dtl_row3 . ':AI' . $new_dtl_row3);
                $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . $new_dtl_row3 . ':AJ' . $new_dtl_row3);
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . $new_dtl_row3 . ':A' . $new_dtl_row3);
                $objPHPExcel->getStyle('B' .  $new_dtl_row3 . ':AI' .  $new_dtl_row3)->getFont()->setBold(false);
                $objPHPExcel->getStyle('B' . ($new_dtl_row3) . ':AI' . ($new_dtl_row3))->getFont()->setSize(10);
                if (isset($nomor[$arr])) {
                    $dt_nomor[$arr] = $nomor[$arr];
                } else {
                    $dt_nomor[$arr] = "";
                }

                if (isset($jam_sampling_sff3[$arr])) {
                    $dt_jam_sampling_sff3[$arr] = $jam_sampling_sff3[$arr];
                } else {
                    $dt_jam_sampling_sff3[$arr] = "";
                }
                if (isset($dtl_pcs_kulit_sff3[$arr])) {
                    $dt_dtl_pcs_kulit_sff3[$arr] = $dtl_pcs_kulit_sff3[$arr];
                } else {
                    $dt_dtl_pcs_kulit_sff3[$arr] = "";
                }
                if (isset($dtl_prsn_kulit_sff3[$arr])) {
                    $dt_dtl_prsn_kulit_sff3[$arr] = $dtl_prsn_kulit_sff3[$arr];
                } else {
                    $dt_dtl_prsn_kulit_sff3[$arr] = "";
                }

                if (isset($dtl_pcs_sabut_sff3[$arr])) {
                    $dt_dtl_pcs_sabut_sff3[$arr] = $dtl_pcs_sabut_sff3[$arr];
                } else {
                    $dt_dtl_pcs_sabut_sff3[$arr] = "";
                }
                if (isset($dtl_prsn_sabut_sff3[$arr])) {
                    $dt_dtl_prsn_sabut_sff3[$arr] = $dtl_prsn_sabut_sff3[$arr];
                } else {
                    $dt_dtl_prsn_sabut_sff3[$arr] = "";
                }
                if (isset($dtl_pcs_tombong_sff3[$arr])) {
                    $dt_dtl_pcs_tombong_sff3[$arr] = $dtl_pcs_tombong_sff3[$arr];
                } else {
                    $dt_dtl_pcs_tombong_sff3[$arr] = "";
                }
                if (isset($dtl_prsn_tombong_sff3[$arr])) {
                    $dt_dtl_prsn_tombong_sff3[$arr] = $dtl_prsn_tombong_sff3[$arr];
                } else {
                    $dt_dtl_prsn_tombong_sff3[$arr] = "";
                }
                if (isset($dtl_pcs_benda_sff3[$arr])) {
                    $dt_dtl_pcs_benda_sff3[$arr] = $dtl_pcs_benda_sff3[$arr];
                } else {
                    $dt_dtl_pcs_benda_sff3[$arr] = "";
                }
                if (isset($dtl_prsn_benda_sff3[$arr])) {
                    $dt_dtl_prsn_benda_sff3[$arr] = $dtl_prsn_benda_sff3[$arr];
                } else {
                    $dt_dtl_prsn_benda_sff3[$arr] = "";
                }
                if (isset($dtl_pcs_bad_sff3[$arr])) {
                    $dt_dtl_pcs_bad_sff3[$arr] = $dtl_pcs_bad_sff3[$arr];
                } else {
                    $dt_dtl_pcs_bad_sff3[$arr] = "";
                }
                if (isset($dtl_prsn_bad_sff3[$arr])) {
                    $dt_dtl_prsn_bad_sff3[$arr] = $dtl_prsn_bad_sff3[$arr];
                } else {
                    $dt_dtl_prsn_bad_sff3[$arr] = "";
                }

                $objPHPExcel->mergeCells('B' . $new_dtl_row3 . ':E' . $new_dtl_row3)->setCellValue('B' . $new_dtl_row3, $dt_jam_sampling_sff3[$arr]);
                $objPHPExcel->mergeCells('F' . $new_dtl_row3 . ':H' . $new_dtl_row3)->setCellValue('F' . $new_dtl_row3, $dt_dtl_pcs_kulit_sff3[$arr]);
                $objPHPExcel->mergeCells('I' . $new_dtl_row3 . ':K' . $new_dtl_row3)->setCellValue('I' . $new_dtl_row3, $dt_dtl_prsn_kulit_sff3[$arr]);
                $objPHPExcel->mergeCells('L' . $new_dtl_row3 . ':N' . $new_dtl_row3)->setCellValue('L' . $new_dtl_row3, $dt_dtl_pcs_sabut_sff3[$arr]);
                $objPHPExcel->mergeCells('O' . $new_dtl_row3 . ':Q' . $new_dtl_row3)->setCellValue('O' . $new_dtl_row3, $dt_dtl_prsn_sabut_sff3[$arr]);
                $objPHPExcel->mergeCells('R' . $new_dtl_row3 . ':T' . $new_dtl_row3)->setCellValue('R' . $new_dtl_row3, $dt_dtl_pcs_tombong_sff3[$arr]);
                $objPHPExcel->mergeCells('U' . $new_dtl_row3 . ':W' . $new_dtl_row3)->setCellValue('U' . $new_dtl_row3, $dt_dtl_prsn_tombong_sff3[$arr]);
                $objPHPExcel->mergeCells('X' . $new_dtl_row3 . ':Z' . $new_dtl_row3)->setCellValue('X' . $new_dtl_row3, $dt_dtl_pcs_benda_sff3[$arr]);
                $objPHPExcel->mergeCells('AA' . $new_dtl_row3 . ':AC' . $new_dtl_row3)->setCellValue('AA' . $new_dtl_row3, $dt_dtl_prsn_benda_sff3[$arr]);
                $objPHPExcel->mergeCells('AD' . $new_dtl_row3 . ':AF' . $new_dtl_row3)->setCellValue('AD' . $new_dtl_row3, $dt_dtl_pcs_bad_sff3[$arr]);
                $objPHPExcel->mergeCells('AG' . $new_dtl_row3 . ':AI' . $new_dtl_row3)->setCellValue('AG' . $new_dtl_row3, $dt_dtl_prsn_bad_sff3[$arr]);
            }
            $new_total_rata3  = $new_dtl_row3 + 1;

            $objPHPExcel->setSharedStyle($headerStyle, 'B' . $new_total_rata3 . ':AI' . ($new_total_rata3 + 1));
            $objPHPExcel->setSharedStyle($bodyStyleRight, 'AJ' . $new_total_rata3 . ':AJ' . ($new_total_rata3 + 1));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . $new_total_rata3 . ':A' . ($new_total_rata3 + 1));
            $objPHPExcel->mergeCells('B' . ($new_total_rata3) . ':E' . ($new_total_rata3))->setCellValue('B' . ($new_total_rata3), 'JUMLAH');
            $objPHPExcel->mergeCells('B' . ($new_total_rata3 + 1) . ':E' . ($new_total_rata3 + 1))->setCellValue('B' . ($new_total_rata3 + 1), 'RATA-RATA');
            $objPHPExcel->mergeCells('F' . $new_total_rata3 . ':H' . $new_total_rata3)->setCellValue('F' . $new_total_rata3, $tdtl_pcs_kulit_sff3);
            $objPHPExcel->mergeCells('I' . $new_total_rata3 . ':K' . $new_total_rata3)->setCellValue('I' . $new_total_rata3, $tdtl_prsn_kulit_sff3);
            $objPHPExcel->mergeCells('L' . $new_total_rata3 . ':N' . $new_total_rata3)->setCellValue('L' . $new_total_rata3, $tdtl_pcs_sabut_sff3);
            $objPHPExcel->mergeCells('O' . $new_total_rata3 . ':Q' . $new_total_rata3)->setCellValue('O' . $new_total_rata3, $tdtl_prsn_sabut_sff3);
            $objPHPExcel->mergeCells('R' . $new_total_rata3 . ':T' . $new_total_rata3)->setCellValue('R' . $new_total_rata3, $tdtl_pcs_tombong_sff3);
            $objPHPExcel->mergeCells('U' . $new_total_rata3 . ':W' . $new_total_rata3)->setCellValue('U' . $new_total_rata3, $tdtl_prsn_tombong_sff3);
            $objPHPExcel->mergeCells('X' . $new_total_rata3 . ':Z' . $new_total_rata3)->setCellValue('X' . $new_total_rata3, $tdtl_pcs_benda_sff3);
            $objPHPExcel->mergeCells('AA' . $new_total_rata3 . ':AC' . $new_total_rata3)->setCellValue('AA' . $new_total_rata3, $tdtl_prsn_benda_sff3);
            $objPHPExcel->mergeCells('AD' . $new_total_rata3 . ':AF' . $new_total_rata3)->setCellValue('AD' . $new_total_rata3, $tdtl_pcs_bad_sff3);
            $objPHPExcel->mergeCells('AG' . $new_total_rata3 . ':AI' . $new_total_rata3)->setCellValue('AG' . $new_total_rata3, $tdtl_prsn_bad_sff3);

            $objPHPExcel->mergeCells('F' . ($new_total_rata3 + 1) . ':H' . ($new_total_rata3 + 1))->setCellValue('F' . ($new_total_rata3 + 1), $tjml_pcs_kulit_sff3 > 0 ? number_format($tdtl_pcs_kulit_sff3 / $tjml_pcs_kulit_sff3, 2) : '');
            $objPHPExcel->mergeCells('I' . ($new_total_rata3 + 1) . ':K' . ($new_total_rata3 + 1))->setCellValue('I' . ($new_total_rata3 + 1), $tjml_prsn_kulit_sff3 > 0 ? number_format($tdtl_prsn_kulit_sff3 / $tjml_prsn_kulit_sff3, 2) : '');
            $objPHPExcel->mergeCells('L' . ($new_total_rata3 + 1) . ':N' . ($new_total_rata3 + 1))->setCellValue('L' . ($new_total_rata3 + 1), $tjml_pcs_sabut_sff3 > 0 ? number_format($tdtl_pcs_sabut_sff3 / $tjml_pcs_sabut_sff3, 2) : '');
            $objPHPExcel->mergeCells('O' . ($new_total_rata3 + 1) . ':Q' . ($new_total_rata3 + 1))->setCellValue('O' . ($new_total_rata3 + 1), $tjml_prsn_sabut_sff3 > 0 ? number_format($tdtl_prsn_sabut_sff3 / $tjml_prsn_sabut_sff3, 2) : '');
            $objPHPExcel->mergeCells('R' . ($new_total_rata3 + 1) . ':T' . ($new_total_rata3 + 1))->setCellValue('R' . ($new_total_rata3 + 1), $tjml_pcs_tombong_sff3 > 0 ? number_format($tdtl_pcs_tombong_sff3 / $tjml_pcs_tombong_sff3, 2) : '');
            $objPHPExcel->mergeCells('U' . ($new_total_rata3 + 1) . ':W' . ($new_total_rata3 + 1))->setCellValue('U' . ($new_total_rata3 + 1), $tjml_prsn_tombong_sff3 > 0 ? number_format($tdtl_prsn_tombong_sff3 / $tjml_prsn_tombong_sff3, 2) : '');
            $objPHPExcel->mergeCells('X' . ($new_total_rata3 + 1) . ':Z' . ($new_total_rata3 + 1))->setCellValue('X' . ($new_total_rata3 + 1), $tjml_pcs_benda_sff3 > 0 ? number_format($tdtl_pcs_benda_sff3 / $tjml_pcs_benda_sff3, 2) : '');
            $objPHPExcel->mergeCells('AA' . ($new_total_rata3 + 1) . ':AC' . ($new_total_rata3 + 1))->setCellValue('AA' . ($new_total_rata3 + 1), $tjml_prsn_benda_sff3 > 0 ? number_format($tdtl_prsn_benda_sff3 / $tjml_prsn_benda_sff3, 2) : '');
            $objPHPExcel->mergeCells('AD' . ($new_total_rata3 + 1) . ':AF' . ($new_total_rata3 + 1))->setCellValue('AD' . ($new_total_rata3 + 1), $tjml_pcs_bad_sff3 > 0 ? number_format($tdtl_pcs_bad_sff3 / $tjml_pcs_bad_sff3, 2) : '');
            $objPHPExcel->mergeCells('AG' . ($new_total_rata3 + 1) . ':AI' . ($new_total_rata3 + 1))->setCellValue('AG' . ($new_total_rata3 + 1), $tjml_prsn_bad_sff3 > 0 ? number_format($tdtl_prsn_bad_sff3 / $tjml_prsn_bad_sff3, 2) : '');

            $footer2 = $new_total_rata3 + 1;

            $objPHPExcel->mergeCells('A' . ($footer2 + 1) . ':Q' . ($footer2 + 1))->setCellValue('A' . ($footer2 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('R' . ($footer2 + 1) . ':AJ' . ($footer2 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('R' . ($footer2 + 1) . ':AJ' . ($footer2 + 1))->setCellValue('R' . ($footer2 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($footer2 + 1) . ':Q' . ($footer2 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'R' . ($footer2 + 1) . ':AJ' . ($footer2 + 1));
            $objPHPExcel->setBreak('A' . ($footer2 + 1),  PHPExcel_Worksheet::BREAK_ROW);

            //PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3
            //PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3//PAGE 3


        }

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('assets/images/Logo_PSG.gif');
        $objPHPExcel2 = $obj->createSheet(1);

        $objPHPExcel2->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel2->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel2->getPageSetup()->setFitToPage(false);
        $objPHPExcel2->getPageSetup()->setScale(80);
        $objPHPExcel2->getPageMargins()->setLeft(0.2);
        $objPHPExcel2->getPageMargins()->setRight(0.2);
        $objPHPExcel2->getPageMargins()->setBottom(0.1);
        $objPHPExcel2->getPageMargins()->setTop(0.1);
        $objPHPExcel2->getPageSetup()->setVerticalCentered(true);
        $objPHPExcel2->getPageSetup()->setHorizontalCentered(true);

        $range = array();
        $rangeCol = "BF";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }

        foreach ($range as $columnID) {
            $objPHPExcel2->getColumnDimension($columnID)->setWidth(3);
        }

            $countb = count($dtdetail_b);
            $jml_data_perpage_b = 24;
            if ($countb < $jml_data_perpage_b) {
                $jml_page2 = 1;
            } else {
                if (($countb % $jml_data_perpage_b) == 0) {
                    $jml_page2 = $countb / $jml_data_perpage_b;
                } else {
                    $jml_page2 = floor(($countb / $jml_data_perpage_b)) + 1;
                }
            }

        $jml_row_perpage = 50;

        for ($i1 = 0; $i1 < $jml_page2; $i1++) {

            $start_row_new = ($i1 * $jml_row_perpage) + 1;
            $finish_row = ((($i1 * $jml_row_perpage) + 1) + ($jml_row_perpage));

            // $start_detail = ($i1 * $jml_data_perpage_b);
            // $finish_detail = (($i1 * $jml_data_perpage_b) + ($jml_data_perpage_b - 1));

            $start_detail2 = ($i1 * $jml_data_perpage_b);
            $finish_detail2 = (($i1 * $jml_data_perpage_b) + ($jml_data_perpage_b - 1));

            $gbr = '$objDrawing' . $i1;
            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/Logo_PSG.gif');
            $gbr->setWidthAndHeight(45, 45);
            $gbr->setWorksheet($objPHPExcel2);
            $gbr->setCoordinates('B' . $start_row_new);

            $objPHPExcel2->mergeCells('A' . $start_row_new . ':D' . ($start_row_new + 1));
            $objPHPExcel2->mergeCells('E' . $start_row_new . ':AS' . ($start_row_new + 1))->setCellValue('E' . $start_row_new,  $this->frmcop);
            $objPHPExcel2->mergeCells('AT' . $start_row_new . ':AW' . $start_row_new)->setCellValue('AT' . $start_row_new, 'Doc');
            $objPHPExcel2->mergeCells('AX' . $start_row_new . ':BF' . $start_row_new)->setCellValue('AX' . $start_row_new, ': ' . $docno);
            $objPHPExcel2->mergeCells('AT' . ($start_row_new + 1) . ':AW' . ($start_row_new + 1))->setCellValue('AT' . ($start_row_new + 1), 'Date');
            $objPHPExcel2->mergeCells('AX' . ($start_row_new + 1) . ':BF' . ($start_row_new + 1))->setCellValue('AX' . ($start_row_new + 1), ':' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel2->mergeCells('A' . ($start_row_new + 2) . ':D' . ($start_row_new + 2))->setCellValue('A' . ($start_row_new + 2), 'JUDUL');
            $objPHPExcel2->mergeCells('E' . ($start_row_new + 2) . ':AS' . ($start_row_new + 2))->setCellValue('E' . ($start_row_new + 2), $this->frmjdl);
            $objPHPExcel2->mergeCells('AT' . ($start_row_new + 2) . ':AW' . ($start_row_new + 2))->setCellValue('AT' . ($start_row_new + 2), 'Page');
            $objPHPExcel2->mergeCells('AX' . ($start_row_new + 2) . ':BF' . ($start_row_new + 2))->setCellValue('AX' . ($start_row_new + 2), ': ' . ($i1 + 3) . ' of ' . ($jml_page *3));

            $objPHPExcel2->setSharedStyle($noborderStyle, 'A' . ($start_row_new + 2) . ':BF' . ($start_row_new + 4));
            $objPHPExcel2->setSharedStyle($headerStyle, 'A' . ($start_row_new) . ':AS' . ($start_row_new + 2));
            $objPHPExcel2->setSharedStyle($headerStyleLeftTop, 'AT' . ($start_row_new) . ':AW' . ($start_row_new + 2));
            $objPHPExcel2->setSharedStyle($headerStyleRightTop, 'AX' . $start_row_new . ':BF' . ($start_row_new + 2));
            $objPHPExcel2->setSharedStyle($headerStyleLeftBottomTop, 'AT' . ($start_row_new + 2) . ':AW' . ($start_row_new + 2));
            $objPHPExcel2->setSharedStyle($headerStyleRightBottomTop, 'AX' . ($start_row_new + 2) . ':BF' . ($start_row_new + 2));
            $objPHPExcel2->setSharedStyle($PTStyle, 'E' . ($start_row_new) . ':AS' . ($start_row_new + 2));
            $objPHPExcel2->getStyle('AX' . ($start_row_new) . ':BF' . ($start_row_new))->getFont()->setSize(10);

                $objPHPExcel2->mergeCells('B' . ($start_row_new + 4) . ':AJ' . ($start_row_new + 4))->setCellValue('B' . ($start_row_new + 4), "III. LEMBAR CATATAN PROSES");
                $objPHPExcel2->mergeCells('B' . ($start_row_new + 5) . ':D' . ($start_row_new + 5))->setCellValue('B' . ($start_row_new + 5), "Jam");
                $objPHPExcel2->mergeCells('E' . ($start_row_new + 5) . ':S' . ($start_row_new + 5))->setCellValue('E' . ($start_row_new + 5), "Catatan Proses / Tindakan Koreksi");
                $objPHPExcel2->mergeCells('T' . ($start_row_new + 5) . ':AB' . ($start_row_new + 5))->setCellValue('T' . ($start_row_new + 5), "Oleh");
                $objPHPExcel2->mergeCells('AC' . ($start_row_new + 5) . ':AJ' . ($start_row_new + 5))->setCellValue('AC' . ($start_row_new + 5), "Tandatangan");

                $objPHPExcel2->mergeCells('AO' . ($start_row_new + 5) . ':BE' . ($start_row_new + 5))->setCellValue('AO' . ($start_row_new + 5), "INSTRUKSI PENGAMBILAN TINDAKAN");
                $objPHPExcel2->mergeCells('AO' . ($start_row_new + 6) . ':BE' . ($start_row_new + 8))->setCellValue('AO' . ($start_row_new + 6), "1. Catat setiap perubahan pada proses (personil, peralatan, \n material, metode, lingkungan atau sistem pengukuran).");
                $objPHPExcel2->mergeCells('AO' . ($start_row_new + 9) . ':BE' . ($start_row_new + 10))->setCellValue('AO' . ($start_row_new + 9), "2. Jangan melakukan perubahan pada prises jika tidak diperlukan.");

                $objPHPExcel2->setSharedStyle($bodyStyleRight, 'BF' . ($start_row_new + 3) . ':BF' . ($start_row_new + 5));
                $objPHPExcel2->setSharedStyle($bodyStyleLeft, 'A' . ($start_row_new + 3) . ':A' . ($start_row_new + 5));
                $objPHPExcel2->setSharedStyle($DetailheaderStyle, 'B' . ($start_row_new + 5) . ':AJ' . ($start_row_new + 5));
                $objPHPExcel2->setSharedStyle($noborderStyle, 'AK' . ($start_row_new + 5) . ':AN' . ($start_row_new + 5));
                $objPHPExcel2->setSharedStyle($DetailheaderStyle, 'AO' . ($start_row_new + 5) . ':BE' . ($start_row_new + 5));
                $objPHPExcel2->setSharedStyle($noborderStyle, 'AO' . ($start_row_new + 5) . ':BE' . ($start_row_new + 10));
                $objPHPExcel2->setSharedStyle($noborderStyle, 'AO' . ($start_row_new + 11) . ':BE' . ($start_row_new + 29));
                $objPHPExcel2->setSharedStyle($DetailheaderStyle, 'AO' . ($start_row_new + 5) . ':BE' . ($start_row_new + 10));
                $objPHPExcel2->getStyle('B' . ($start_row_new + 5) . ':AI' . ($start_row_new + 5))->getFont()->setBold(true);

            $new_start_row2 = $start_row_new + 5;
            for ($b = $start_detail2; $b <= $finish_detail2; $b++) {
                $new_start_row2++;
                $objPHPExcel2->setSharedStyle($noborderStyle, 'B' . $new_start_row2 . ':AN' . $new_start_row2);
                $objPHPExcel2->setSharedStyle($bodyStyle, 'B' . $new_start_row2 . ':AJ' . $new_start_row2);
                $objPHPExcel2->setSharedStyle($bodyStyleRight, 'BF' . ($new_start_row2) . ':BF' . ($new_start_row2));
                $objPHPExcel2->setSharedStyle($bodyStyleLeft, 'A' . ($new_start_row2) . ':A' . ($new_start_row2));
                $objPHPExcel2->getStyle('B' .  $new_start_row2 . ':AI' .  $new_start_row2)->getFont()->setBold(false);
                $objPHPExcel2->getStyle('B' . ($new_start_row2) . ':AI' . ($new_start_row2))->getFont()->setSize(10);

                if (isset($nomor[$b])) { $dt_nomor[$b]                      = $nomor[$b]; } else { $dt_nomor[$b] = ""; }
                if (isset($dtl_jam[$b])) { $dt_dtl_jam[$b]                  = $dtl_jam[$b]; } else { $dt_dtl_jam[$b] = ""; }
                if (isset($dtl_tindakan[$b])) { $dt_dtl_tindakan[$b]        = $dtl_tindakan[$b]; } else { $dt_dtl_tindakan[$b] = ""; } if (isset($dtl_pj_nama[$b])) { $dt_pj_nama[$b] = $dtl_pj_nama[$b]; } else { $dt_pj_nama[$b] = ""; } if (isset($dtl_pj_personalstatus[$b])) { $dt_pj_personalstatus[$b]  = $dtl_pj_personalstatus[$b]; } else { $dt_pj_personalstatus[$b]  = ""; }
                if (isset($dtl_pj_personalid[$b])) { $dt_pj_personalid[$b]  = $dtl_pj_personalid[$b]; } else { $dt_pj_personalid[$b] = ""; } if (isset($dtl_paraf[$b])) { $dt_paraf[$b]                          = $dtl_paraf[$b]; } else { $dt_paraf[$b] = ""; }

                $objPHPExcel2->mergeCells('B' . $new_start_row2 . ':D' . $new_start_row2)->setCellValue('B' . $new_start_row2, $dt_dtl_jam[$b]);
                $objPHPExcel2->mergeCells('E' . $new_start_row2 . ':S' . $new_start_row2)->setCellValue('E' . $new_start_row2, $dt_dtl_tindakan[$b]);
                $objPHPExcel2->mergeCells('T' . $new_start_row2 . ':AB' . $new_start_row2)->setCellValue('T' . $new_start_row2, $dt_pj_nama[$b]);
                $objPHPExcel2->mergeCells('AC' . $new_start_row2 . ':AJ' . $new_start_row2)->setCellValue('AC' . $new_start_row2, $dt_paraf[$b]);

                if ($dt_pj_personalstatus[$b] == '2') {
                    $imageurlapp1 = '/forviewfoto_nomodify/TTD_TK/';
                    $imageformatapp1 = '.png';
                } else if ($dt_pj_personalstatus[$b] == '1') {
                    $imageurlapp1 = '/forviewfoto_nomodify/';
                    $imageformatapp1 = '_0_0.png';
                } else {
                    $imageurlapp1 = '';
                    $imageformatapp1 = '';
                }

                $fcpath2   = str_replace('mpd/', '', FCPATH);

                $sign_img  = '$objDrawing' . $i1;
                if (file_exists($fcpath2 .'mpd/assets/ttd/'.$dt_pj_personalstatus[$b].'_'.$dt_pj_personalid[$b].'.png')) {
                    $objPHPExcel2->getRowDimension($new_start_row2)->setRowHeight(50);
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/'.$dt_pj_personalstatus[$b].'_'.$dt_pj_personalid[$b].'.png');
                    $sign_img->setWidthAndHeight(100, 100);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel2);
                    $sign_img->setCoordinates('AE' . ($new_start_row2))->setOffsetY(2)->setOffsetX(-3);
                } else {
                    if ($dt_pj_personalid[$b] != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $dt_pj_personalid[$b] . $imageformatapp1)) {
                        $objPHPExcel2->getRowDimension($new_start_row2)->setRowHeight(50);
                        $sign_img = new PHPExcel_Worksheet_Drawing();
                        $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $dt_pj_personalid[$b] . $imageformatapp1);
                        $sign_img->setWidthAndHeight(100, 100);
                        $sign_img->setResizeProportional(true);
                        $sign_img->setWorksheet($objPHPExcel2);
                        $sign_img->setCoordinates('AE' . ($new_start_row2))->setOffsetY(3)->setOffsetX(-3);
                    }
                }
                // var_dump($fcpath2);
                // die;
            }
                    $app_row = ($new_start_row2 + 1);

            $objPHPExcel2->mergeCells('J' . ($app_row + 1) . ':U' . ($app_row + 1))->setCellValue('J' . ($app_row + 1), 'Shift I /'. $shift1);
            $objPHPExcel2->mergeCells('V' . ($app_row + 1) . ':AG' . ($app_row + 1))->setCellValue('V' . ($app_row + 1), 'Shift II /'. $shift2);
            $objPHPExcel2->mergeCells('AH' . ($app_row + 1) . ':AS' . ($app_row + 1))->setCellValue('AH' . ($app_row + 1), 'Shift III /'. $shift3);
            $objPHPExcel2->mergeCells('AT' . ($app_row + 1) . ':BE' . ($app_row + 1))->setCellValue('AT' . ($app_row + 1), 'Diketahui Oleh,');

            $objPHPExcel2->mergeCells('J' . ($app_row + 2) . ':U' . ($app_row + 6))->setCellValue('J' . ($app_row + 2), '');
            $objPHPExcel2->mergeCells('V' . ($app_row + 2) . ':AG' . ($app_row + 6))->setCellValue('V' . ($app_row + 2), '');
            $objPHPExcel2->mergeCells('AH' . ($app_row + 2) . ':AS' . ($app_row + 6))->setCellValue('AH' . ($app_row + 2), '');
            $objPHPExcel2->mergeCells('AT' . ($app_row + 2) . ':BE' . ($app_row + 6))->setCellValue('AT' . ($app_row + 2), '');

            $objPHPExcel2->setSharedStyle($bodyStyle, 'J' . ($app_row + 1) . ':BE' . ($app_row + 1));
            $objPHPExcel2->setSharedStyle($bodyStyle, 'J' . ($app_row + 2) . ':BE' . ($app_row + 6));
            $objPHPExcel2->setSharedStyle($bodyStyleRight, 'BF' . ($app_row) . ':BF' . ($app_row + 6));
            $objPHPExcel2->setSharedStyle($bodyStyleLeft, 'A' . ($app_row) . ':A' . ($app_row + 6));
            $objPHPExcel2->setSharedStyle($noborderStyle, 'B' . ($app_row) . ':I' . ($app_row +6));
            $objPHPExcel2->setSharedStyle($noborderStyle, 'B' . ($app_row) . ':BE' . ($app_row));


            // tabel app
            if ($app1_personalstatus == '2') {
                $imageurlapp1 = '/forviewfoto_nomodify/TTD_TK/';
                $imageformatapp1 = '.png';
            } else if ($app1_personalstatus == '1') {
                $imageurlapp1 = '/forviewfoto_nomodify/';
                $imageformatapp1 = '_0_0.png';
            } else {
                $imageurlapp1 = '';
                $imageformatapp1 = '';
            }

            $sign_img1 = '$objDrawing' . $i1;
            if (isset($app1_by)) {
                if (file_exists($fcpath2 .'mpd/assets/ttd/'.$app1_personalstatus.'_'.$app1_personalid.'.png')) {
                    $sign_img1 = new PHPExcel_Worksheet_Drawing();
                    $sign_img1->setPath('assets/ttd/'.$app1_personalstatus.'_'.$app1_personalid.'.png');
                    $sign_img1->setWidthAndHeight(135, 135);
                    $sign_img1->setResizeProportional(true);
                    $sign_img1->setWorksheet($objPHPExcel2);
                    $sign_img1->setCoordinates('L' . ($app_row + 3));
                } else {
                    if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                        $sign_img1 = new PHPExcel_Worksheet_Drawing();
                        $sign_img1->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                        $sign_img1->setWidthAndHeight(135, 135);
                        $sign_img1->setResizeProportional(true);
                        $sign_img1->setWorksheet($objPHPExcel2);
                        $sign_img1->setCoordinates('L' . ($app_row + 3));
                    }
                }
            }

            if ($app2_personalstatus == '2') {
                $imageurlapp2 = '/forviewfoto_nomodify/TTD_TK/';
                $imageformatapp2 = '.png';
            } else if ($app2_personalstatus == '1') {
                $imageurlapp2 = '/forviewfoto_nomodify/';
                $imageformatapp2 = '_0_0.png';
            } else {
                $imageurlapp2 = '';
                $imageformatapp2 = '';
            }

            $sign_img2 = '$objDrawing' . $i1;
            if (isset($app2_by)) {
                if (file_exists($fcpath2 .'mpd/assets/ttd/'.$app2_personalstatus.'_'.$app2_personalid.'.png')) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath('assets/ttd/'.$app2_personalstatus.'_'.$app2_personalid.'.png');
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel2);
                    $sign_img2->setCoordinates('X' . ($app_row + 3));
                } else {
                    if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                        $sign_img2 = new PHPExcel_Worksheet_Drawing();
                        $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                        $sign_img2->setWidthAndHeight(135, 135);
                        $sign_img2->setResizeProportional(true);
                        $sign_img2->setWorksheet($objPHPExcel2);
                        $sign_img2->setCoordinates('X' . ($app_row + 3));
                    }
                }
            }

            if ($app3_personalstatus == '2') {
                $imageurlapp3 = '/forviewfoto_nomodify/TTD_TK/';
                $imageformatapp3 = '.png';
            } else if ($app3_personalstatus == '1') {
                $imageurlapp3 = '/forviewfoto_nomodify/';
                $imageformatapp3 = '_0_0.png';
            } else {
                $imageurlapp3 = '';
                $imageformatapp3 = '';
            }

            $sign_img3 = '$objDrawing' . $i1;
            if (isset($app3_by)) {
                if (file_exists($fcpath2 .'mpd/assets/ttd/'.$app3_personalstatus.'_'.$app3_personalid.'.png')) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath('assets/ttd/'.$app3_personalstatus.'_'.$app3_personalid.'.png');
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel2);
                    $sign_img3->setCoordinates('AJ' . ($app_row + 3));
                } else {
                    if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                        $sign_img3 = new PHPExcel_Worksheet_Drawing();
                        $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                        $sign_img3->setWidthAndHeight(135, 135);
                        $sign_img3->setResizeProportional(true);
                        $sign_img3->setWorksheet($objPHPExcel2);
                        $sign_img3->setCoordinates('AJ' . ($app_row + 3));
                    }
                }
            }

             if ($app4_personalstatus == '2') {
                $imageurlapp4 = '/forviewfoto_nomodify/TTD_TK/';
                $imageformatapp4 = '.png';
            } else if ($app4_personalstatus == '1') {
                $imageurlapp4 = '/forviewfoto_nomodify/';
                $imageformatapp4 = '_0_0.png';
                $imageformatapp4 = '.png';
            } else {
                $imageurlapp4 = '';
                $imageformatapp4 = '';
            }

            $sign_img4 = '$objDrawing' . $i1;
            if (isset($app4_by)) {
                if (file_exists($fcpath2 .'mpd/assets/ttd/'.$app4_personalstatus.'_'.$app4_personalid.'.png')) {
                    $sign_img4 = new PHPExcel_Worksheet_Drawing();
                    $sign_img4->setPath('assets/ttd/'.$app4_personalstatus.'_'.$app4_personalid.'.png');
                    $sign_img4->setWidthAndHeight(135, 135);
                    $sign_img4->setResizeProportional(true);
                    $sign_img4->setWorksheet($objPHPExcel2);
                    $sign_img4->setCoordinates('AW' . ($app_row + 3));
                } else {
                    if ($app4_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4)) {
                        $sign_img4 = new PHPExcel_Worksheet_Drawing();
                        $sign_img4->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp4 . $app4_personalid . $imageformatapp4);
                        $sign_img4->setWidthAndHeight(135, 135);
                        $sign_img4->setResizeProportional(true);
                        $sign_img4->setWorksheet($objPHPExcel2);
                        $sign_img4->setCoordinates('AW' . ($app_row + 3));
                    }
                }
            }

            $objPHPExcel2->mergeCells('J' . ($app_row + 7) . ':M' . ($app_row + 7))->setCellValue('J' . ($app_row + 7), 'Nama');
            $objPHPExcel2->mergeCells('N' . ($app_row + 7) . ':U' . ($app_row + 7))->setCellValue('N' . ($app_row + 7), ': ' . $app1_by);
            $objPHPExcel2->mergeCells('J' . ($app_row + 8) . ':M' . ($app_row + 8))->setCellValue('J' . ($app_row + 8), 'Jabatan');
            $objPHPExcel2->mergeCells('N' . ($app_row + 8) . ':U' . ($app_row + 8))->setCellValue('N' . ($app_row + 8), ': '. $app1_position);
            $objPHPExcel2->mergeCells('J' . ($app_row + 9) . ':M' . ($app_row + 9))->setCellValue('J' . ($app_row + 9), 'Tanggal');
            $objPHPExcel2->mergeCells('N' . ($app_row + 9) . ':U' . ($app_row + 9))->setCellValue('N' . ($app_row + 9), ': ' . $app1date);

            $objPHPExcel2->mergeCells('V' . ($app_row + 7) . ':Y' . ($app_row + 7))->setCellValue('V' . ($app_row + 7), 'Nama');
            $objPHPExcel2->mergeCells('Z' . ($app_row + 7) . ':AG' . ($app_row + 7))->setCellValue('Z' . ($app_row + 7), ': ' . $app2_by);
            $objPHPExcel2->mergeCells('V' . ($app_row + 8) . ':Y' . ($app_row + 8))->setCellValue('V' . ($app_row + 8), 'Jabatan');
            $objPHPExcel2->mergeCells('Z' . ($app_row + 8) . ':AG' . ($app_row + 8))->setCellValue('Z' . ($app_row + 8), ': ' . $app2_position);
            $objPHPExcel2->mergeCells('V' . ($app_row + 9) . ':Y' . ($app_row + 9))->setCellValue('V' . ($app_row + 9), 'Tanggal');
            $objPHPExcel2->mergeCells('Z' . ($app_row + 9) . ':AG' . ($app_row + 9))->setCellValue('Z' . ($app_row + 9), ': ' . $app2date);

            $objPHPExcel2->mergeCells('AH' . ($app_row + 7) . ':AK' . ($app_row + 7))->setCellValue('AH' . ($app_row + 7), 'Nama');
            $objPHPExcel2->mergeCells('AL' . ($app_row + 7) . ':AS' . ($app_row + 7))->setCellValue('AL' . ($app_row + 7), ': ' . $app3_by);
            $objPHPExcel2->mergeCells('AH' . ($app_row + 8) . ':AK' . ($app_row + 8))->setCellValue('AH' . ($app_row + 8), 'Jabatan');
            $objPHPExcel2->mergeCells('AL' . ($app_row + 8) . ':AS' . ($app_row + 8))->setCellValue('AL' . ($app_row + 8), ': ' . $app3_position);
            $objPHPExcel2->mergeCells('AH' . ($app_row + 9) . ':AK' . ($app_row + 9))->setCellValue('AH' . ($app_row + 9), 'Tanggal');
            $objPHPExcel2->mergeCells('AL' . ($app_row + 9) . ':AS' . ($app_row + 9))->setCellValue('AL' . ($app_row + 9), ': ' . $app3date);

            $objPHPExcel2->mergeCells('AT' . ($app_row + 7) . ':AW' . ($app_row + 7))->setCellValue('AT' . ($app_row + 7), 'Nama');
            $objPHPExcel2->mergeCells('AX' . ($app_row + 7) . ':BE' . ($app_row + 7))->setCellValue('AX' . ($app_row + 7), ': ' . $app4_by);
            $objPHPExcel2->mergeCells('AT' . ($app_row + 8) . ':AW' . ($app_row + 8))->setCellValue('AT' . ($app_row + 8), 'Jabatan');
            $objPHPExcel2->mergeCells('AX' . ($app_row + 8) . ':BE' . ($app_row + 8))->setCellValue('AX' . ($app_row + 8), ': ' . $app4_position);
            $objPHPExcel2->mergeCells('AT' . ($app_row + 9) . ':AW' . ($app_row + 9))->setCellValue('AT' . ($app_row + 9), 'Tanggal');
            $objPHPExcel2->mergeCells('AX' . ($app_row + 9) . ':BE' . ($app_row + 9))->setCellValue('AX' . ($app_row + 9), ': ' . $app4date);

            $objPHPExcel2->setSharedStyle($noborderStyle, 'J' . ($app_row + 7) . ':BE' . ($app_row + 9));
            $objPHPExcel2->setSharedStyle($noborderStyle, 'B' . ($app_row + 7) . ':I' . ($app_row + 9));
            $objPHPExcel2->setSharedStyle($bodyStyleRight, 'BF' . ($app_row + 7) . ':BF' . ($app_row + 9));
            $objPHPExcel2->setSharedStyle($bodyStyleLeft, 'A' . ($app_row + 7) . ':A' . ($app_row + 9));
            $objPHPExcel2->setSharedStyle($bodyStyleLeft, 'J' . ($app_row + 7) . ':J' . ($app_row + 9));
            $objPHPExcel2->setSharedStyle($bodyStyleLeft, 'V' . ($app_row + 7) . ':V' . ($app_row + 9));
            $objPHPExcel2->setSharedStyle($bodyStyleLeft, 'AH' . ($app_row + 7) . ':AH' . ($app_row + 9));
            $objPHPExcel2->setSharedStyle($bodyStyleLeft, 'AT' . ($app_row + 7) . ':AT' . ($app_row + 9));
            $objPHPExcel2->setSharedStyle($bodyStyleRight, 'BE' . ($app_row + 7) . ':BE' . ($app_row + 9));

            $footer3 = $app_row + 9;
            $objPHPExcel2->mergeCells('A' . ($footer3 + 1) . ':Q' . ($footer3 + 1))->setCellValue('A' . ($footer3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel2->getStyle('R' . ($footer3 + 1) . ':BF' . ($footer3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel2->mergeCells('R' . ($footer3 + 1) . ':BF' . ($footer3 + 1))->setCellValue('R' . ($footer3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel2->setSharedStyle($footerStyleLeftbottom, 'A' . ($footer3 + 1) . ':Q' . ($footer3 + 1));
            $objPHPExcel2->setSharedStyle($footerStyleRightbottom, 'R' . ($footer3 + 1) . ':BF' . ($footer3 + 1));
            $objPHPExcel2->setBreak('A' . ($footer3 + 1),  PHPExcel_Worksheet::BREAK_ROW);


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
