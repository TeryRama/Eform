<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_frmfss317_15 extends CI_Controller
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

        $dtheader = $this->M_formfrmfss317_15->get_header_byid($this->header_id);
        foreach ($dtheader as $dtheaderrow) {
            $dtcreate_date       = $dtheaderrow->create_date; //2021-02-08

            $create_date         = date("d-m-Y", strtotime($dtheaderrow->create_date)); //08-02-2021
            $docno               = $dtheaderrow->docno;

            $app1_by             = $dtheaderrow->app1_by;
            $app2_by             = $dtheaderrow->app2_by;
            $app3_by             = $dtheaderrow->app3_by;

            $app1_position       = $dtheaderrow->app1_position;
            $app2_position       = $dtheaderrow->app2_position;
            $app3_position       = $dtheaderrow->app3_position;

            $app1_personalid     = $dtheaderrow->app1_personalid;
            $app2_personalid     = $dtheaderrow->app2_personalid;
            $app3_personalid     = $dtheaderrow->app3_personalid;

            $app1_personalstatus = $dtheaderrow->app1_personalstatus;
            $app2_personalstatus = $dtheaderrow->app2_personalstatus;
            $app3_personalstatus = $dtheaderrow->app3_personalstatus;

            $app1date            = $dtheaderrow->app1_date;
            $app2date            = $dtheaderrow->app2_date;
            $app3date            = $dtheaderrow->app3_date;

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

        if ($this->cekLevelUserNm == 'Auditor') {
            $dtdetail         = $this->M_formfrmfss317_15->get_detail_byidx($this->header_id);
            $dtdetail_b       = $this->M_formfrmfss317_15->get_detail_byid_bx($this->header_id);
            $dtdetail_c       = $this->M_formfrmfss317_15->get_detail_byid_cx($this->header_id);
            $dtdetail_c_uf    = $this->M_formfrmfss317_15->get_detail_byid_c_ufx($this->header_id);
            $dtdetail_d       = $this->M_formfrmfss317_15->get_detail_byid_dx($this->header_id);
            $dtdetail_e       = $this->M_formfrmfss317_15->get_detail_byid_ex($this->header_id);
            $dtdetail_f       = $this->M_formfrmfss317_15->get_detail_byid_fx($this->header_id);
            $dtdetail_g       = $this->M_formfrmfss317_15->get_detail_byid_gx($this->header_id);
            $dtdetail_h       = $this->M_formfrmfss317_15->get_detail_byid_hx($this->header_id);
            $dtdetail_i       = $this->M_formfrmfss317_15->get_detail_byid_ix($this->header_id);
            $dtdetail_j       = $this->M_formfrmfss317_15->get_detail_byid_jx($this->header_id);
            $dtdetail_k       = $this->M_formfrmfss317_15->get_detail_byid_kx($this->header_id);
            $dtdetail_l       = $this->M_formfrmfss317_15->get_detail_byid_lx($this->header_id);
            $dtdetail_m       = $this->M_formfrmfss317_15->get_detail_byid_mx($this->header_id);
            $dtdetail_n       = $this->M_formfrmfss317_15->get_detail_byid_nx($this->header_id);
            $dtdetail_o       = $this->M_formfrmfss317_15->get_detail_byid_ox($this->header_id);
            $dtdetail_p       = $this->M_formfrmfss317_15->get_detail_byid_px($this->header_id);
        } else {
            $dtdetail         = $this->M_formfrmfss317_15->get_detail_byid($this->header_id);
            $dtdetail_b       = $this->M_formfrmfss317_15->get_detail_byid_b($this->header_id);
            $dtdetail_c       = $this->M_formfrmfss317_15->get_detail_byid_c($this->header_id);
            $dtdetail_c_uf    = $this->M_formfrmfss317_15->get_detail_byid_c_uf($this->header_id);
            $dtdetail_d       = $this->M_formfrmfss317_15->get_detail_byid_d($this->header_id);
            $dtdetail_e       = $this->M_formfrmfss317_15->get_detail_byid_e($this->header_id);
            $dtdetail_f       = $this->M_formfrmfss317_15->get_detail_byid_f($this->header_id);
            $dtdetail_g       = $this->M_formfrmfss317_15->get_detail_byid_g($this->header_id);
            $dtdetail_h       = $this->M_formfrmfss317_15->get_detail_byid_h($this->header_id);
            $dtdetail_i       = $this->M_formfrmfss317_15->get_detail_byid_i($this->header_id);
            $dtdetail_j       = $this->M_formfrmfss317_15->get_detail_byid_j($this->header_id);
            $dtdetail_k       = $this->M_formfrmfss317_15->get_detail_byid_k($this->header_id);
            $dtdetail_l       = $this->M_formfrmfss317_15->get_detail_byid_l($this->header_id);
            $dtdetail_m       = $this->M_formfrmfss317_15->get_detail_byid_m($this->header_id);
            $dtdetail_n       = $this->M_formfrmfss317_15->get_detail_byid_n($this->header_id);
            $dtdetail_o       = $this->M_formfrmfss317_15->get_detail_byid_o($this->header_id);
            $dtdetail_p       = $this->M_formfrmfss317_15->get_detail_byid_p($this->header_id);
        }

        //detail a
        $no = 1;
        $total_bawah = 0;
        $dtl_a_grand_total_pemakaian = 0;
        $dtl_a_grand_total_persen = 0;
        $dtl_a_grand_total_akumulatif = 0;

        if(isset($dtdetail)){
            foreach ($dtdetail as $dtdetail_row) {
                $total_bawah += $dtdetail_row->akumulatif;

                $nomor[]              = $no++;
                $no_urut_desc[]       = trim($dtdetail_row->no_urut_desc);
                $no_urut[]            = trim($dtdetail_row->no_urut);
                $no_urut2_asc[]       = trim($dtdetail_row->no_urut2_asc);
                $nama_jenis_air[]     = trim($dtdetail_row->nama_jenis_air);
                $nama_departemen[]    = trim($dtdetail_row->nama_departemen);
                $pemakaian[]          = trim($dtdetail_row->pemakaian);
                $persen[]             = trim($dtdetail_row->persen);
                $akumulatif[]         = trim($dtdetail_row->akumulatif);

                $dtl_a_grand_total_pemakaian    += $dtdetail_row->pemakaian;
                $dtl_a_grand_total_persen       += $dtdetail_row->persen;
                $dtl_a_grand_total_akumulatif   += $dtdetail_row->akumulatif;

            }
        }else{
            $nomor[]              = "";
            $no_urut_desc[]       = "";
            $no_urut[]            = "";
            $no_urut2_asc[]       = "";
            $nama_jenis_air[]     = "";
            $nama_departemen[]    = "";
            $pemakaian[]          = "";
            $persen[]             = "";
            $akumulatif[]         = "";
        }
        //end detail a

        //detail b
        if(isset($dtdetail_b)){
            foreach ($dtdetail_b as $dtdetail_row_b) {
                $operasi_jenis[]        = trim($dtdetail_row_b->operasi_jenis);
                $operasi_nilai[]        = trim($dtdetail_row_b->operasi_nilai);
                $operasi_akumulatif[]   = trim($dtdetail_row_b->operasi_akumulatif);
                $operasi_satuan[]       = trim($dtdetail_row_b->operasi_satuan);
            }
        }else{
            $operasi_jenis[]        = '';
            $operasi_nilai[]        = '';
            $operasi_akumulatif[]   = '';
        }
        //end detail b

        //detail c
        if(isset($dtdetail_c)){
            foreach ($dtdetail_c as $dtdetail_row_c) {
                $operasi_jenis_c[]        = trim($dtdetail_row_c->operasi_jenis);
                $operasi_nilai_c[]        = trim($dtdetail_row_c->operasi_nilai);
                $operasi_akumulatif_c[]   = trim($dtdetail_row_c->operasi_akumulatif);
                $operasi_satuan_c[]       = trim($dtdetail_row_c->operasi_satuan);
            }
        }else{
            $operasi_jenis_c[]        = '';
            $operasi_nilai_c[]        = '';
            $operasi_akumulatif_c[]   = '';
        }
        //end detail c

        //detail c
        if(isset($dtdetail_c_uf)){
            foreach ($dtdetail_c_uf as $dtdetail_row_c) {
                $operasi_jenis_c_uf[]        = trim($dtdetail_row_c->operasi_jenis);
                $operasi_nilai_c_uf[]        = trim($dtdetail_row_c->operasi_nilai);
                $operasi_akumulatif_c_uf[]   = trim($dtdetail_row_c->operasi_akumulatif);
                $operasi_satuan_c_uf[]       = trim($dtdetail_row_c->operasi_satuan);
            }
        }else{
            $operasi_jenis_c_uf[]        = '';
            $operasi_nilai_c_uf[]        = '';
            $operasi_akumulatif_c_uf[]   = '';
        }
        //end detail c
        
        //detail d
        if(isset($dtdetail_d)){
            foreach ($dtdetail_d as $dtdetail_row_d) {
                $stok_air_awal[]        = trim($dtdetail_row_d->stok_air_awal);
            }
        }else{
            $stok_air_awal[]        = '';
        }
        //detail e
        $total_operasi_nilai_e = 0;
        $total_operasi_akumulatif_e = 0;
        if(isset($dtdetail_e)){
            foreach ($dtdetail_e as $dtdetail_row_e) {
                $total_operasi_nilai_e += $dtdetail_row_e->operasi_nilai;
                $total_operasi_akumulatif_e += $dtdetail_row_e->operasi_akumulatif;
                $total_operasi_satuan_e = $dtdetail_row_e->operasi_satuan_e;

                $operasi_jenis_e[]        = trim($dtdetail_row_e->operasi_jenis);
                $operasi_nilai_e[]        = trim($dtdetail_row_e->operasi_nilai);
                $operasi_akumulatif_e[]   = trim($dtdetail_row_e->operasi_akumulatif);
                $operasi_satuan_e[]       = trim($dtdetail_row_e->operasi_satuan);
            }
        }else{
            $operasi_jenis_e[]        = '';
            $operasi_nilai_e[]        = '';
            $operasi_akumulatif_e[]   = '';
            $operasi_satuan_e[]       = '';
        }
        //end detail e
        
        //detail f
        $total_dtl_f_operasi_nilai = 0;
        $total_dtl_f_operasi_akumulatif = 0;
        if(isset($dtdetail_f)){
            foreach ($dtdetail_f as $dtdetail_row_f) {
                $total_dtl_f_operasi_nilai += $dtdetail_row_f->operasi_nilai;
                $total_dtl_f_operasi_akumulatif += $dtdetail_row_f->operasi_akumulatif;

                $operasi_jenis_f[]        = trim($dtdetail_row_f->operasi_jenis);
                $operasi_nilai_f[]        = trim($dtdetail_row_f->operasi_nilai);
                $operasi_akumulatif_f[]   = trim($dtdetail_row_f->operasi_akumulatif);
                $operasi_satuan_f[]       = trim($dtdetail_row_f->operasi_satuan);
                $operasi_satuan_f_total   = trim($dtdetail_row_f->operasi_satuan);
            }
        }else{
            $operasi_jenis_f[]        = '';
            $operasi_nilai_f[]        = '';
            $operasi_akumulatif_f[]   = '';
            $operasi_satuan_f[]       = '';
            $operasi_satuan_f_total   = '';
        }
        //end detail f

        //detail g
        $dtl_g_total_bawah = 0;
        if(isset($dtdetail_g)){
            foreach ($dtdetail_g as $dtdetail_row_g) {
                $dtl_g_total_bawah = $dtdetail_row_g->stok_air_akhir + $dtdetail_row_g->t_distribusi - $dtdetail_row_g->stok_air_awal - $dtdetail_row_g->total_proses;

                $stok_air_akhir_g[]   = trim($dtdetail_row_g->stok_air_akhir);
                $t_distribusi_g[]     = trim($dtdetail_row_g->t_distribusi);
                $stok_air_awal_g[]    = trim($dtdetail_row_g->stok_air_awal);
                $total_proses_g[]     = trim($dtdetail_row_g->total_proses);
            }
        }else{
            $dtl_g_total_bawah = '';
            
            $stok_air_akhir_g[]   = '';
            $t_distribusi_g[]     = '';
            $stok_air_awal_g[]    = '';
            $total_proses_g[]     = '';
        }
        //end detail g

        //detail h
        if(isset($dtdetail_h)){
            foreach ($dtdetail_h as $dtdetail_row_h) {
                $drain_sedimen_h[]    = trim($dtdetail_row_h->drain_sedimen);
                $backwash_tanki_h[]   = trim($dtdetail_row_h->backwash_tanki);
                $cleaning_bak_h[]     = trim($dtdetail_row_h->cleaning_bak);
                $operasional_h[]      = trim($dtdetail_row_h->operasional);
            }
        }else{
            $drain_sedimen_h[]    = '';
            $backwash_tanki_h[]   = '';
            $cleaning_bak_h[]     = '';
        }
        //end detail h

        //detail i
        if(isset($dtdetail_i)){
            foreach ($dtdetail_i as $dtdetail_row_i) {
                $operasi_jenis_i[]        = trim($dtdetail_row_i->operasi_jenis);
                $operasi_nilai_i[]        = trim($dtdetail_row_i->operasi_nilai);
                $operasi_akumulatif_i[]   = trim($dtdetail_row_i->operasi_akumulatif);
                $operasi_effisiensi_i[]   = trim($dtdetail_row_i->operasi_effisiensi);
                $operasi_stok_i[]         = trim($dtdetail_row_i->operasi_stok);
            }
        }else{
            $operasi_jenis_i[]        = '';
            $operasi_nilai_i[]        = '';
            $operasi_akumulatif_i[]   = '';
            $operasi_effisiensi_i[]   = '';
        }
        //end detail i
        
        //detail j
        if(isset($dtdetail_j)){
            foreach ($dtdetail_j as $dtdetail_row_j) {
                $operasi_jenis_j[]    = trim($dtdetail_row_j->operasi_jenis);
                $target_j[]           = trim($dtdetail_row_j->target);
                $operasi_satuan_j[]   = trim($dtdetail_row_j->operasi_satuan);
            }
        }else{
            $operasi_jenis_j[]    = '';
            $target_j[]           = '';
            $operasi_satuan_j[]           = '';
        }
        //end detail j

        //detail k
        if(isset($dtdetail_k)){
            foreach ($dtdetail_k as $dtdetail_row_k) {
                $operasi_jenis_k[]        = trim($dtdetail_row_k->operasi_jenis);
                $operasi_nilai_k[]        = trim($dtdetail_row_k->operasi_nilai);
                $effisiensi_k[]           = trim($dtdetail_row_k->effisiensi);
                $operasi_akumulatif_k[]   = trim($dtdetail_row_k->operasi_akumulatif);
                $keterangan_k[]           = trim($dtdetail_row_k->keterangan);
                $stock_k[]                = trim($dtdetail_row_k->stock);
            }
        }else{
            $operasi_jenis_k[]        = '';
            $operasi_nilai_k[]        = '';
            $effisiensi_k[]           = '';
            $operasi_akumulatif_k[]   = '';
            $keterangan_k[]           = '';
        }
        //end detail k
       
        //detail l
        if(isset($dtdetail_l)){
            foreach ($dtdetail_l as $dtdetail_row_l) {
                $operasi_jenis_l[]        = trim($dtdetail_row_l->operasi_jenis);
                $operasi_nilai_l[]        = trim($dtdetail_row_l->operasi_nilai);
                $effisiensi_l[]           = trim($dtdetail_row_l->effisiensi);
                $operasi_akumulatif_l[]   = trim($dtdetail_row_l->operasi_akumulatif);
                $stok_l[]                 = trim($dtdetail_row_l->operasi_stok);
            }
        }else{
            $operasi_jenis_l[]        = '';
            $operasi_nilai_l[]        = '';
            $effisiensi_l[]           = '';
            $operasi_akumulatif_l[]   = '';
        }
        //end detail l
        
        //detail m
        if(isset($dtdetail_m)){
            foreach ($dtdetail_m as $dtdetail_row_m) {
                $operasi_jenis_m[]        = trim($dtdetail_row_m->operasi_jenis);
                $operasi_nilai_m[]        = trim($dtdetail_row_m->operasi_nilai);
                $effisiensi_m[]           = trim($dtdetail_row_m->effisiensi);
                $operasi_akumulatif_m[]   = trim($dtdetail_row_m->operasi_akumulatif);
                $stok_m[]                 = trim($dtdetail_row_m->operasi_stok);
            }
        }else{
            $operasi_jenis_m[]        = '';
            $operasi_nilai_m[]        = '';
            $effisiensi_m[]           = '';
            $operasi_akumulatif_m[]   = '';
        }
        //end detail m
        
        //detail n
        if(isset($dtdetail_n)){
            foreach ($dtdetail_n as $dtdetail_row_n) {
                $operasi_jenis_n[]        = trim($dtdetail_row_n->operasi_jenis);
                $operasi_nilai_n[]        = trim($dtdetail_row_n->operasi_nilai);
                $operasi_akumulatif_n[]   = trim($dtdetail_row_n->operasi_akumulatif);
                $stok_n[]                 = trim($dtdetail_row_n->operasi_stok);
            }
        }else{
            $operasi_jenis_n[]        = '';
            $operasi_nilai_n[]        = '';
            $operasi_akumulatif_n[]   = '';
        }
        //end detail n
        
        //detail o
        $dtl_o_total_m3 = 0;
        $dtl_o_total_jam = 0;
        if(isset($dtdetail_o)){
            foreach ($dtdetail_o as $dtdetail_row_o) {
                $dtl_o_total_m3     += $dtdetail_row_o->operasi_produk;
                $dtl_o_total_jam    += $dtdetail_row_o->operasi_jam;
                $dtl_o_total_satuan = $dtdetail_row_o->operasi_satuan;


                $operasi_jenis_o[]    = trim($dtdetail_row_o->operasi_jenis);
                $operasi_produk_o[]   = trim($dtdetail_row_o->operasi_produk);
                $operasi_jam_o[]      = trim($dtdetail_row_o->operasi_jam);
                $operasi_satuan_o[]   = trim($dtdetail_row_o->operasi_satuan);
            }
        }else{
            $dtl_o_total_satuan = '';


            $operasi_jenis_o[]    = '';
            $operasi_produk_o[]   = '';
            $operasi_jam_o[]      = '';
        }
        //end detail o

         //detail p
         if(isset($dtdetail_p)){
            foreach ($dtdetail_p as $dtdetail_row_p) {
                $item_p[]         = trim($dtdetail_row_p->item);
                $ph_p[]           = trim($dtdetail_row_p->ph);
                $turbidity_p[]    = trim($dtdetail_row_p->turbidity);
                $colour_p[]       = trim($dtdetail_row_p->colour);
                $ket_p[]          = trim($dtdetail_row_p->ket);
            }
        }else{
            $item_p[]         = '';
            $ph_p[]           = '';
            $turbidity_p[]    = '';
            $colour_p[]       = '';
        }
        //end detail p
        
        // style
        $PTStyle                    = new PHPExcel_Style();
        $headerStyle                = new PHPExcel_Style();
        $headerStyleLeft            = new PHPExcel_Style();
        $headerStyleRight            = new PHPExcel_Style();
        $headerStyleLeftTop         = new PHPExcel_Style();
        $headerStyleRightTop        = new PHPExcel_Style();
        $headerStyleLeftBottomTop   = new PHPExcel_Style();
        $headerStyleRightBottomTop  = new PHPExcel_Style();
        $DetailheaderStyle          = new PHPExcel_Style();
        $bodyStyle                  = new PHPExcel_Style();
        $bodyStyleAlignLeft         = new PHPExcel_Style();
        $noborderStyle              = new PHPExcel_Style();
        $noborderStyleBold          = new PHPExcel_Style();
        $noborderStyleAlignRight    = new PHPExcel_Style();
        $noborderStyleUnderline    = new PHPExcel_Style();
        $bodyStyleLeft              = new PHPExcel_Style();
        $bodyStyleRight             = new PHPExcel_Style();
        $footerStyleLeftbottom      = new PHPExcel_Style();
        $footerStyleRightbottom     = new PHPExcel_Style();

        $PTStyle->applyFromArray($this->xls->PT_STYLE);
        $headerStyle->applyFromArray($this->xls->headerStyle);
        $headerStyleRight->applyFromArray($this->xls->headerStyleRight);
        $headerStyleLeftTop->applyFromArray($this->xls->headerStyleLeftTop);
        $headerStyleRightTop->applyFromArray($this->xls->headerStyleRightTop);
        $headerStyleLeftBottomTop->applyFromArray($this->xls->headerStyleLeftBottomTop);
        $headerStyleRightBottomTop->applyFromArray($this->xls->headerStyleRightBottomTop);
        $DetailheaderStyle->applyFromArray($this->xls->DetailheaderStyle);
        $bodyStyle->applyFromArray($this->xls->bodyStyle);
        $bodyStyleAlignLeft->applyFromArray($this->xls->bodyStyleAlignLeft);
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
            $objPHPExcel->getColumnDimension($columnID)->setWidth(4);
        }

        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(15);
        }
        //tabel a
        $count1 = count($dtdetail);
        $jml_data_perpage = $count1+5;
        if ($count1 < $jml_data_perpage) {
            $jml_page_a = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $jml_page_a = $count1 / $jml_data_perpage;
            } else {
                $jml_page_a = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }
        //tabel b
        $count2 = count($dtdetail_b);
        $jml_data_perpage_b = $count2;
        if ($count2 < $jml_data_perpage_b) {
            $jml_page_b = 1;
        } else {
            if (($count2 % $jml_data_perpage_b) == 0) {
                $jml_page_b = $count2 / $jml_data_perpage_b;
            } else {
                $jml_page_b = floor(($count2 / $jml_data_perpage_b)) + 1;
            }
        }
        //tabel c
        $count3 = count($dtdetail_c);
        $jml_data_perpage_c = $count3;
        if ($count3 < $jml_data_perpage_c) {
            $jml_page_c = 1;
        } else {
            if (($count3 % $jml_data_perpage_c) == 0) {
                $jml_page_c = $count3 / $jml_data_perpage_c;
            } else {
                $jml_page_c = floor(($count3 / $jml_data_perpage_c)) + 1;
            }
        }
        //tabel c
        $count3_uf = count($dtdetail_c_uf);
        $jml_data_perpage_c_uf = $count3_uf;
        if ($count3_uf < $jml_data_perpage_c_uf) {
            $jml_page_c_uf = 1;
        } else {
            if (($count3_uf % $jml_data_perpage_c_uf) == 0) {
                $jml_page_c_uf = $count3_uf / $jml_data_perpage_c_uf;
            } else {
                $jml_page_c_uf = floor(($count3_uf / $jml_data_perpage_c_uf)) + 1;
            }
        }
        //tabel d
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
        //tabel e
        $count5 = count($dtdetail_e);
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
        //tabel f
        $count6 = count($dtdetail_f);
        $jml_data_perpage_f = $count6;
        if ($count6 < $jml_data_perpage_f) {
            $jml_page_f = 1;
        } else {
            if (($count6 % $jml_data_perpage_f) == 0) {
                $jml_page_f = $count6 / $jml_data_perpage_f;
            } else {
                $jml_page_f = floor(($count6 / $jml_data_perpage_f)) + 1;
            }
        }
        //tabel g
        $count7 = count($dtdetail_g);
        $jml_data_perpage_g = $count7;
        if ($count7 < $jml_data_perpage_g) {
            $jml_page_g = 1;
        } else {
            if (($count7 % $jml_data_perpage_g) == 0) {
                $jml_page_g = $count7 / $jml_data_perpage_g;
            } else {
                $jml_page_g = floor(($count7 / $jml_data_perpage_g)) + 1;
            }
        }
        //tabel h
        $count8 = count($dtdetail_h);
        $jml_data_perpage_h = $count8;
        if ($count8 < $jml_data_perpage_h) {
            $jml_page_h = 1;
        } else {
            if (($count8 % $jml_data_perpage_h) == 0) {
                $jml_page_h = $count8 / $jml_data_perpage_h;
            } else {
                $jml_page_h = floor(($count8 / $jml_data_perpage_h)) + 1;
            }
        }
        //tabel i
        $count9 = count($dtdetail_i);
        $jml_data_perpage_i = $count9;
        if ($count9 < $jml_data_perpage_i) {
            $jml_page_i = 1;
        } else {
            if (($count9 % $jml_data_perpage_i) == 0) {
                $jml_page_i = $count9 / $jml_data_perpage_i;
            } else {
                $jml_page_i = floor(($count9 / $jml_data_perpage_i)) + 1;
            }
        }
        //tabel j
        $count10 = count($dtdetail_j);
        $jml_data_perpage_j = $count10;
        if ($count10 < $jml_data_perpage_j) {
            $jml_page_j = 1;
        } else {
            if (($count10 % $jml_data_perpage_j) == 0) {
                $jml_page_j = $count10 / $jml_data_perpage_j;
            } else {
                $jml_page_j = floor(($count10 / $jml_data_perpage_j)) + 1;
            }
        }
        //tabel k
        $count11 = count($dtdetail_k);
        $jml_data_perpage_k = $count11;
        if ($count11 < $jml_data_perpage_k) {
            $jml_page_k = 1;
        } else {
            if (($count11 % $jml_data_perpage_k) == 0) {
                $jml_page_k = $count11 / $jml_data_perpage_k;
            } else {
                $jml_page_k = floor(($count11 / $jml_data_perpage_k)) + 1;
            }
        }
        //tabel l
        $count12 = count($dtdetail_l);
        $jml_data_perpage_l = $count12;
        if ($count12 < $jml_data_perpage_l) {
            $jml_page_l = 1;
        } else {
            if (($count12 % $jml_data_perpage_l) == 0) {
                $jml_page_l = $count12 / $jml_data_perpage_l;
            } else {
                $jml_page_l = floor(($count12 / $jml_data_perpage_l)) + 1;
            }
        }
        //tabel m
        $count13 = count($dtdetail_m);
        $jml_data_perpage_m = $count13;
        if ($count13 < $jml_data_perpage_m) {
            $jml_page_m = 1;
        } else {
            if (($count13 % $jml_data_perpage_m) == 0) {
                $jml_page_m = $count13 / $jml_data_perpage_m;
            } else {
                $jml_page_m = floor(($count13 / $jml_data_perpage_m)) + 1;
            }
        }
        //tabel n
        $count14 = count($dtdetail_n);
        $jml_data_perpage_n = $count14;
        if ($count14 < $jml_data_perpage_n) {
            $jml_page_n = 1;
        } else {
            if (($count14 % $jml_data_perpage_n) == 0) {
                $jml_page_n = $count14 / $jml_data_perpage_n;
            } else {
                $jml_page_n = floor(($count14 / $jml_data_perpage_n)) + 1;
            }
        }
        //tabel o
        $count15 = count($dtdetail_o);
        $jml_data_perpage_o = $count15;
        if ($count15 < $jml_data_perpage_o) {
            $jml_page_o = 1;
        } else {
            if (($count15 % $jml_data_perpage_o) == 0) {
                $jml_page_o = $count15 / $jml_data_perpage_o;
            } else {
                $jml_page_o = floor(($count15 / $jml_data_perpage_o)) + 1;
            }
        }
        //tabel p
        $count16 = count($dtdetail_p);
        $jml_data_perpage_p = $count16;
        if ($count16 < $jml_data_perpage_p) {
            $jml_page_p = 1;
        } else {
            if (($count16 % $jml_data_perpage_p) == 0) {
                $jml_page_p = $count16 / $jml_data_perpage_p;
            } else {
                $jml_page_p = floor(($count16 / $jml_data_perpage_p)) + 1;
            }
        }

        $jml_row_perpage  = 100;

        $jml_page = max($jml_page_a, $jml_page_b, $jml_page_c, $jml_page_c_uf, $jml_page_d, $jml_page_e, $jml_page_f, $jml_page_g, $jml_page_h, $jml_page_i, $jml_page_j, $jml_page_k, $jml_page_l, $jml_page_m, $jml_page_n, $jml_page_o, $jml_page_p);
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
            $gbr->setCoordinates('B' . $start_row);


            $objPHPExcel->mergeCells('A' .  $start_row . ':D' . ($start_row + 1));
            $objPHPExcel->mergeCells('E' .  $start_row . ':BS' . ($start_row+1))->setCellValue('E' . $start_row,  $this->frmcop);
            $objPHPExcel->mergeCells('BT' . $start_row . ':BW' . $start_row)->setCellValue('BT' . $start_row, 'DOK');
            $objPHPExcel->mergeCells('BX' . $start_row . ':CF' . $start_row)->setCellValue('BX' . $start_row, ': ' . $docno);

            $objPHPExcel->mergeCells('BT' . ($start_row + 1) . ':BW' . ($start_row + 1))->setCellValue('BT' . ($start_row + 1), 'Tanggal');
            $objPHPExcel->mergeCells('BX' . ($start_row + 1) . ':CF' . ($start_row + 1))->setCellValue('BX' . ($start_row + 1), ':' . date('d-m-Y', strtotime($create_date)));

            $objPHPExcel->mergeCells('A' . ($start_row + 2) . ':D' . ($start_row + 2))->setCellValue('A' . ($start_row + 2), 'JUDUL');
            $objPHPExcel->mergeCells('E' . ($start_row + 2) . ':BS' . ($start_row + 2))->setCellValue('E' . ($start_row + 2), $this->frmjdl);
            $objPHPExcel->mergeCells('BT' . ($start_row + 2) . ':BW' . ($start_row + 2))->setCellValue('BT' . ($start_row + 2), 'HLM');
            $objPHPExcel->mergeCells('BX' . ($start_row + 2) . ':CF' . ($start_row + 2))->setCellValue('BX' . ($start_row + 2), ': ' . ($i1 + 1) . ' of ' . $jml_page_a);

            $objPHPExcel->setSharedStyle($headerStyle,   'A' . $start_row . ':D' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 3) . ':CF' . ($start_row + 3));
            $objPHPExcel->setSharedStyle($noborderStyle, 'A' . ($start_row + 4) . ':CF' . ($start_row + 4));
            $objPHPExcel->setSharedStyle($headerStyle,   'A' . ($start_row)     . ':BS' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftTop,  'BT' . ($start_row) . ':CF' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'BX' . $start_row  . ':CF' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'BT' . ($start_row + 2) . ':CF' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'BX' . ($start_row + 2) . ':CF' . ($start_row + 2));

            $objPHPExcel->setSharedStyle($PTStyle, 'E' . ($start_row) . ':BS' . ($start_row + 2));
            $objPHPExcel->setSharedStyle($PTStyle, 'A' . ($start_row) . ':D' . ($start_row + 2));
            $objPHPExcel->getStyle('BX' . ($start_row) . ':CF' . ($start_row))->getFont()->setSize(10);

            


            //header table a
            $objPHPExcel->mergeCells('B' . ($start_row + 4) . ':D' . ($start_row + 5))->setCellValue('B' . ($start_row + 4), "No");
            $objPHPExcel->mergeCells('E' . ($start_row + 4) . ':R' . ($start_row + 4))->setCellValue('E' . ($start_row + 4), "Uraian");
            $objPHPExcel->mergeCells('E' . ($start_row + 5) . ':J' . ($start_row + 5))->setCellValue('E' . ($start_row + 5), "Supplay Air");
            $objPHPExcel->mergeCells('K' . ($start_row + 5) . ':R' . ($start_row + 5))->setCellValue('K' . ($start_row + 5), "Departemen Pemakai");
            $objPHPExcel->mergeCells('S' . ($start_row + 4) . ':X' . ($start_row + 5))->setCellValue('S' . ($start_row + 4), "Pemakaian");
            $objPHPExcel->mergeCells('Y' . ($start_row + 4) . ':AD' . ($start_row + 5))->setCellValue('Y' . ($start_row + 4), "Persen (%)");
            $objPHPExcel->mergeCells('AE' . ($start_row + 4) . ':AJ' . ($start_row + 5))->setCellValue('AE' . ($start_row + 4), "Akumulatif");


            // $objPHPExcel->setSharedStyle($bodyStyleRight, 'AR' . ($start_row + 3) . ':AR' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' . ($start_row + 3) . ':A' . ($start_row + 5));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . ($start_row + 4) . ':CE' . ($start_row + 5));
            $objPHPExcel->getStyle('B' . ($start_row + 4) . ':CE' . ($start_row + 5))->getFont()->setBold(true)->setSize(9);

            $no                       = 1;
            $dt_total_acf_pemakaian   = 0;
            $dt_total_acf_persen      = 0;
            $dt_total_acf_akumulatif  = 0;
            $dt_total_asf_pemakaian   = 0;
            $dt_total_asf_persen      = 0;
            $dt_total_asf_akumulatif  = 0;
            $dt_total_ast_pemakaian   = 0;
            $dt_total_ast_persen      = 0;
            $dt_total_ast_akumulatif  = 0;
            $dt_total_ro_pemakaian    = 0;
            $dt_total_ro_persen       = 0;
            $dt_total_ro_akumulatif   = 0;
            $dt_total_uf_pemakaian    = 0;
            $dt_total_uf_persen       = 0;
            $dt_total_uf_akumulatif   = 0;

            $dtl_row_a = $start_row + 6;

            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_a)->setRowHeight(20);

                if (isset($no_urut_desc[$a])) {
                    $dt_no_urut_desc[$a]    = $no_urut_desc[$a] - 1;
                } else {
                    $dt_no_urut_desc[$a]    = 0;
                }
                if (isset($no_urut[$a])) {
                    $dt_no_urut[$a]         = $no_urut[$a];
                } else {
                    $dt_no_urut[$a]         = "";
                }
                if (isset($nama_jenis_air[$a])) {
                    $dt_nama_jenis_air[$a]  = $nama_jenis_air[$a];
                } else {
                    $dt_nama_jenis_air[$a]  = "";
                }
                if (isset($nomor[$a])) {
                    $dt_nomor[$a]           = $nomor[$a];
                } else {
                    $dt_nomor[$a]           = "";
                }
                if (isset($nama_departemen[$a])) {
                    $dt_nama_departemen[$a]       = $nama_departemen[$a];
                } else {
                    $dt_nama_departemen[$a]       = "";
                }
                if (isset($pemakaian[$a])) {
                    $dt_pemakaian[$a]       = $pemakaian[$a];
                } else {
                    $dt_pemakaian[$a]       = "";
                }
                if (isset($persen[$a])) {
                    $dt_persen[$a]          = $persen[$a];
                } else {
                    $dt_persen[$a]          = "";
                }
                if (isset($akumulatif[$a])) {
                    $dt_akumulatif[$a]      = $akumulatif[$a];
                } else {
                    $dt_akumulatif[$a]      = "";
                }
                

                if($dt_nama_jenis_air[$a] == 'ACF'){
                    $dt_total_acf_pemakaian   += $dt_pemakaian[$a];
                    $dt_total_acf_persen      += $persen[$a];
                    $dt_total_acf_akumulatif  += $akumulatif[$a];
                    
                    if ($dt_no_urut[$a] == 1) {
                        $objPHPExcel->mergeCells('E' . ($dtl_row_a) . ':J' . (($dtl_row_a) + ($dt_no_urut_desc[$a])))->setCellValue('E' . ($dtl_row_a), $dt_nama_jenis_air[$a]);
                    }
                    $objPHPExcel->mergeCells('B' . ($dtl_row_a) . ':D' . ($dtl_row_a))->setCellValue('B' . ($dtl_row_a), $no++);
                    $objPHPExcel->mergeCells('K' . ($dtl_row_a) . ':R' . ($dtl_row_a))->setCellValue('K' . ($dtl_row_a), $dt_nama_departemen[$a]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row_a) . ':X' . ($dtl_row_a))->setCellValue('S' . ($dtl_row_a), $dt_pemakaian[$a]);
                    $objPHPExcel->mergeCells('Y' . ($dtl_row_a) . ':AD' . ($dtl_row_a))->setCellValue('Y' . ($dtl_row_a), number_format($dt_persen[$a],1));
                    $objPHPExcel->mergeCells('AE' . ($dtl_row_a) . ':AJ' . ($dtl_row_a))->setCellValue('AE' . ($dtl_row_a), $dt_akumulatif[$a]);
                    
                    $objPHPExcel->mergeCells('B' . ($dtl_row_a + ($dt_no_urut_desc[$a]+1)) . ':R' . ($dtl_row_a + ($dt_no_urut_desc[$a]+1)))->setCellValue('B' . ($dtl_row_a + ($dt_no_urut_desc[$a]+1)), 'Total '. $dt_nama_jenis_air[$a]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row_a + ($dt_no_urut_desc[$a]+1)) . ':X' . ($dtl_row_a + ($dt_no_urut_desc[$a]+1)))->setCellValue('S' . ($dtl_row_a + ($dt_no_urut_desc[$a]+1)), $dt_total_acf_pemakaian);
                    $objPHPExcel->mergeCells('Y' . ($dtl_row_a + ($dt_no_urut_desc[$a]+1)) . ':AD' . ($dtl_row_a + ($dt_no_urut_desc[$a]+1)))->setCellValue('Y' . ($dtl_row_a + ($dt_no_urut_desc[$a]+1)), number_format($dt_total_acf_persen,1));
                    $objPHPExcel->mergeCells('AE' . ($dtl_row_a + ($dt_no_urut_desc[$a]+1)) . ':AJ' . ($dtl_row_a + ($dt_no_urut_desc[$a]+1)))->setCellValue('AE' . ($dtl_row_a + ($dt_no_urut_desc[$a]+1)), $dt_total_acf_akumulatif);
                    
                }
                if ($dt_nama_jenis_air[$a] == 'ASF') {
                    $dt_total_asf_pemakaian   += $dt_pemakaian[$a];
                    $dt_total_asf_persen      += $persen[$a];
                    $dt_total_asf_akumulatif  += $akumulatif[$a];

                    if ($dt_no_urut[$a] == 1) {
                        $objPHPExcel->mergeCells('E' . ($dtl_row_a+1) . ':J' . (($dtl_row_a+1) + ($dt_no_urut_desc[$a])))->setCellValue('E' . ($dtl_row_a+1), $dt_nama_jenis_air[$a]);
                    }
                    $objPHPExcel->mergeCells('B' . ($dtl_row_a + 1) . ':D' . ($dtl_row_a + 1))->setCellValue('B' . ($dtl_row_a + 1), $no++);
                    $objPHPExcel->mergeCells('K' . ($dtl_row_a + 1) . ':R' . ($dtl_row_a + 1))->setCellValue('K' . ($dtl_row_a + 1), $dt_nama_departemen[$a]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row_a + 1) . ':X' . ($dtl_row_a + 1))->setCellValue('S' . ($dtl_row_a + 1), $dt_pemakaian[$a]);
                    $objPHPExcel->mergeCells('Y' . ($dtl_row_a + 1) . ':AD' . ($dtl_row_a + 1))->setCellValue('Y' . ($dtl_row_a + 1), number_format($dt_persen[$a],1));
                    $objPHPExcel->mergeCells('AE' . ($dtl_row_a + 1) . ':AJ' . ($dtl_row_a + 1))->setCellValue('AE' . ($dtl_row_a + 1), $dt_akumulatif[$a]);

                    $objPHPExcel->mergeCells('B' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 2)) . ':R' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 2)))->setCellValue('B' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 2)), 'Total ' . $dt_nama_jenis_air[$a]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 2)) . ':X' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 2)))->setCellValue('S' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 2)), $dt_total_asf_pemakaian);
                    $objPHPExcel->mergeCells('Y' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 2)) . ':AD' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 2)))->setCellValue('Y' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 2)), number_format($dt_total_asf_persen,1));
                    $objPHPExcel->mergeCells('AE' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 2)) . ':AJ' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 2)))->setCellValue('AE' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 2)), $dt_total_asf_akumulatif);
                }
                if ($dt_nama_jenis_air[$a] == 'AST') {
                    $dt_total_ast_pemakaian   += $dt_pemakaian[$a];
                    $dt_total_ast_persen      += $persen[$a];
                    $dt_total_ast_akumulatif  += $akumulatif[$a];

                    if ($dt_no_urut[$a] == 1) {
                        $objPHPExcel->mergeCells('E' . ($dtl_row_a+2) . ':J' . (($dtl_row_a+2) + ($dt_no_urut_desc[$a])))->setCellValue('E' . ($dtl_row_a+2), $dt_nama_jenis_air[$a]);
                    }
                    $objPHPExcel->mergeCells('B' . ($dtl_row_a + 2) . ':D' . ($dtl_row_a + 2))->setCellValue('B' . ($dtl_row_a + 2), $no++);
                    $objPHPExcel->mergeCells('K' . ($dtl_row_a + 2) . ':R' . ($dtl_row_a + 2))->setCellValue('K' . ($dtl_row_a + 2), $dt_nama_departemen[$a]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row_a + 2) . ':X' . ($dtl_row_a + 2))->setCellValue('S' . ($dtl_row_a + 2), $dt_pemakaian[$a]);
                    $objPHPExcel->mergeCells('Y' . ($dtl_row_a + 2) . ':AD' . ($dtl_row_a + 2))->setCellValue('Y' . ($dtl_row_a + 2), number_format($dt_persen[$a],1));
                    $objPHPExcel->mergeCells('AE' . ($dtl_row_a + 2) . ':AJ' . ($dtl_row_a + 2))->setCellValue('AE' . ($dtl_row_a + 2), $dt_akumulatif[$a]);

                    $objPHPExcel->mergeCells('B' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 3)) . ':R' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 3)))->setCellValue('B' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 3)), 'Total ' . $dt_nama_jenis_air[$a]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 3)) . ':X' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 3)))->setCellValue('S' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 3)), $dt_total_ast_pemakaian);
                    $objPHPExcel->mergeCells('Y' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 3)) . ':AD' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 3)))->setCellValue('Y' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 3)), number_format($dt_total_ast_persen,1));
                    $objPHPExcel->mergeCells('AE' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 3)) . ':AJ' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 3)))->setCellValue('AE' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 3)), $dt_total_ast_akumulatif);

                }
                if ($dt_nama_jenis_air[$a] == 'RO') {
                    $dt_total_ro_pemakaian   += $dt_pemakaian[$a];
                    $dt_total_ro_persen      += $persen[$a];
                    $dt_total_ro_akumulatif  += $akumulatif[$a];

                    if ($dt_no_urut[$a] == 1) {
                        $objPHPExcel->mergeCells('E' . ($dtl_row_a+3) . ':J' . (($dtl_row_a+3) + ($dt_no_urut_desc[$a])))->setCellValue('E' . ($dtl_row_a+3), $dt_nama_jenis_air[$a]);
                    }
                    $objPHPExcel->mergeCells('B' . ($dtl_row_a + 3) . ':D' . ($dtl_row_a + 3))->setCellValue('B' . ($dtl_row_a + 3), $no++);
                    $objPHPExcel->mergeCells('K' . ($dtl_row_a + 3) . ':R' . ($dtl_row_a + 3))->setCellValue('K' . ($dtl_row_a + 3), $dt_nama_departemen[$a]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row_a + 3) . ':X' . ($dtl_row_a + 3))->setCellValue('S' . ($dtl_row_a + 3), $dt_pemakaian[$a]);
                    $objPHPExcel->mergeCells('Y' . ($dtl_row_a + 3) . ':AD' . ($dtl_row_a + 3))->setCellValue('Y' . ($dtl_row_a + 3), number_format($dt_persen[$a],1));
                    $objPHPExcel->mergeCells('AE' . ($dtl_row_a + 3) . ':AJ' . ($dtl_row_a + 3))->setCellValue('AE' . ($dtl_row_a + 3), $dt_akumulatif[$a]);
                    
                    $objPHPExcel->mergeCells('B' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 4)) . ':R' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 4)))->setCellValue('B' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 4)), 'Total ' . $dt_nama_jenis_air[$a]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 4)) . ':X' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 4)))->setCellValue('S' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 4)), $dt_total_ro_pemakaian);
                    $objPHPExcel->mergeCells('Y' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 4)) . ':AD' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 4)))->setCellValue('Y' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 4)), number_format($dt_total_ro_persen,1));
                    $objPHPExcel->mergeCells('AE' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 4)) . ':AJ' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 4)))->setCellValue('AE' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 4)), $dt_total_ro_akumulatif);
                }
                if ($dt_nama_jenis_air[$a] == 'UF') {
                    $dt_total_uf_pemakaian   += $dt_pemakaian[$a];
                    $dt_total_uf_persen      += $persen[$a];
                    $dt_total_uf_akumulatif  += $akumulatif[$a];

                    if ($dt_no_urut[$a] == 1) {
                        $objPHPExcel->mergeCells('E' . ($dtl_row_a+4) . ':J' . (($dtl_row_a+4) + ($dt_no_urut_desc[$a])))->setCellValue('E' . ($dtl_row_a+4), $dt_nama_jenis_air[$a]);
                    }
                    $objPHPExcel->mergeCells('B' . ($dtl_row_a + 4) . ':D' . ($dtl_row_a + 4))->setCellValue('B' . ($dtl_row_a + 4), $no++);
                    $objPHPExcel->mergeCells('K' . ($dtl_row_a + 4) . ':R' . ($dtl_row_a + 4))->setCellValue('K' . ($dtl_row_a + 4), $dt_nama_departemen[$a]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row_a + 4) . ':X' . ($dtl_row_a + 4))->setCellValue('S' . ($dtl_row_a + 4), $dt_pemakaian[$a]);
                    $objPHPExcel->mergeCells('Y' . ($dtl_row_a + 4) . ':AD' . ($dtl_row_a + 4))->setCellValue('Y' . ($dtl_row_a + 4), $dt_persen[$a]);
                    $objPHPExcel->mergeCells('AE' . ($dtl_row_a + 4) . ':AJ' . ($dtl_row_a + 4))->setCellValue('AE' . ($dtl_row_a + 4), $dt_akumulatif[$a]);
                    
                    $objPHPExcel->mergeCells('B' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 5)) . ':R' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 5)))->setCellValue('B' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 5)), 'Total ' . $dt_nama_jenis_air[$a]);
                    $objPHPExcel->mergeCells('S' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 5)) . ':X' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 5)))->setCellValue('S' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 5)), $dt_total_uf_pemakaian);
                    $objPHPExcel->mergeCells('Y' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 5)) . ':AD' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 5)))->setCellValue('Y' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 5)), $dt_total_uf_persen);
                    $objPHPExcel->mergeCells('AE' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 5)) . ':AJ' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 5)))->setCellValue('AE' . ($dtl_row_a + ($dt_no_urut_desc[$a] + 5)), $dt_total_uf_akumulatif);
                }
                        
                $objPHPExcel->setSharedStyle($bodyStyle, 'B' . $dtl_row_a . ':AJ' . $dtl_row_a);
                $objPHPExcel->setSharedStyle($bodyStyleRight, 'AR' . ($dtl_row_a) . ':AR' . ($dtl_row_a));
                $objPHPExcel->setSharedStyle($bodyStyleLeft,  'A' . ($dtl_row_a) . ':A' . ($dtl_row_a));
                $objPHPExcel->getStyle('B' . ($dtl_row_a) . ':R' . ($dtl_row_a))->getFont()->setBold(true);
                $objPHPExcel->getStyle('B' . ($dtl_row_a) . ':AQ' . ($dtl_row_a))->getFont()->setSize(9);
                $objPHPExcel->getStyle('E' . ($dtl_row_a) . ':J' . ($dtl_row_a))->getAlignment()->setTextRotation(90)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'A' . ($dtl_row_a + 1) . ':A' . ($dtl_row_a + 2));
                $dtl_row_a++;
            }

            $total_row = $dtl_row_a;
            $objPHPExcel->mergeCells('B' . ($total_row) . ':R' . ($total_row))->setCellValue('B' . ($total_row), 'Total ASF, ACF, AST, dan RO');
            $objPHPExcel->mergeCells('S' . ($total_row) . ':X' . ($total_row))->setCellValue('S' . ($total_row), $dtl_a_grand_total_pemakaian);
            $objPHPExcel->mergeCells('Y' . ($total_row) . ':AD' . ($total_row))->setCellValue('Y' . ($total_row), number_format($dtl_a_grand_total_persen,1));
            $objPHPExcel->mergeCells('AE' . ($total_row) . ':AJ' . ($total_row))->setCellValue('AE' . ($total_row), $dtl_a_grand_total_akumulatif);
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'B' . $total_row . ':AJ' . ($total_row));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'CF' . ($start_row + 3) . ':CF' . ($total_row));
            //end tabel a

            $start_detail = ($i1 * $jml_data_perpage_b);
            $finish_detail = (($i1 * $jml_data_perpage_b) + ($jml_data_perpage_b - 1));

            //tabel b
            $objPHPExcel->mergeCells('AK' . ($start_row + 4) . ':AQ' . ($start_row + 5))->setCellValue('AK' . ($start_row + 4), "Item");
            $objPHPExcel->mergeCells('AR' . ($start_row + 4) . ':AV' . ($start_row + 5))->setCellValue('AR' . ($start_row + 4), "Pemakaian");
            $objPHPExcel->mergeCells('AW' . ($start_row + 4) . ':BA' . ($start_row + 5))->setCellValue('AW' . ($start_row + 4), "Akumulatif");
            $objPHPExcel->mergeCells('BB' . ($start_row + 4) . ':BD' . ($start_row + 5))->setCellValue('BB' . ($start_row + 4), "Satuan");

            $dtl_row_b = $start_row + 6;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {
                    
                if (isset($operasi_jenis[$a])) {
                    $dt_operasi_jenis[$a]         = $operasi_jenis[$a];
                } else {
                    $dt_operasi_jenis[$a]         = "";
                }
                if (isset($operasi_nilai[$a])) {
                    $dt_operasi_nilai[$a]         = $operasi_nilai[$a];
                } else {
                    $dt_operasi_nilai[$a]         = "";
                }
                if (isset($operasi_akumulatif[$a])) {
                    $dt_operasi_akumulatif[$a]    = $operasi_akumulatif[$a];
                } else {
                    $dt_operasi_akumulatif[$a]    = "";
                }
                if (isset($operasi_satuan[$a])) {
                    $dt_operasi_satuan[$a]        = $operasi_satuan[$a];
                } else {
                    $dt_operasi_satuan[$a]        = "";
                }


                $objPHPExcel->getRowDimension($dtl_row_b)->setRowHeight(20);
                $objPHPExcel->mergeCells('AK' . $dtl_row_b . ':AQ' . $dtl_row_b)->setCellValue('AK' . $dtl_row_b, $dt_operasi_jenis[$a]);
                $objPHPExcel->mergeCells('AR' . $dtl_row_b . ':AV' . $dtl_row_b)->setCellValue('AR' . $dtl_row_b, $dt_operasi_nilai[$a]);
                $objPHPExcel->mergeCells('AW' . $dtl_row_b . ':BA' . $dtl_row_b)->setCellValue('AW' . $dtl_row_b, $dt_operasi_akumulatif[$a]);
                $objPHPExcel->mergeCells('BB' . $dtl_row_b . ':BD' . $dtl_row_b)->setCellValue('BB' . $dtl_row_b, $dt_operasi_satuan[$a]);

                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'AK' . $dtl_row_b . ':AQ' . $dtl_row_b);
                $objPHPExcel->setSharedStyle($bodyStyle, 'AR' . $dtl_row_b . ':BD' . $dtl_row_b);
                $dtl_row_b++;
            }
            $objPHPExcel->mergeCells('AK' . ($dtl_row_b) . ':BD' . ($dtl_row_b))->setCellValue('AK' . ($dtl_row_b), '');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AK' . ($dtl_row_b) . ':BD' . ($dtl_row_b));
            $objPHPExcel->getStyle('AK' . ($dtl_row_b) . ':BD' . ($dtl_row_b))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '99ff99'))));
            $objPHPExcel->mergeCells('AK' . ($dtl_row_b + 1) . ':BD' . ($dtl_row_b + 1))->setCellValue('AK' . ($dtl_row_b + 1), 'PROSES RO');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AK' . ($dtl_row_b + 1) . ':BD' . ($dtl_row_b + 1));
            //end table b

            $start_detail = ($i1 * $jml_data_perpage_c);
            $finish_detail = (($i1 * $jml_data_perpage_c) + ($jml_data_perpage_c - 1));

            //tabel c
            $dtl_row_c = $dtl_row_b + 2;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                if (isset($operasi_jenis_c[$a])) {
                    $dt_operasi_jenis_c[$a]  = $operasi_jenis_c[$a];
                } else {
                    $dt_operasi_jenis_c[$a]  = "";
                }
                if (isset($operasi_nilai_c[$a])) {
                    $dt_operasi_nilai_c[$a]           = $operasi_nilai_c[$a];
                } else {
                    $dt_operasi_nilai_c[$a]           = "";
                }
                if (isset($operasi_akumulatif_c[$a])) {
                    $dt_operasi_akumulatif_c[$a]      = $operasi_akumulatif_c[$a];
                } else {
                    $dt_operasi_akumulatif_c[$a]      = "";
                }
                if (isset($operasi_satuan_c[$a])) {
                    $dt_operasi_satuan_c[$a]       = $operasi_satuan_c[$a];
                } else {
                    $dt_operasi_satuan_c[$a]       = "";
                }
                    
                    
                $objPHPExcel->getRowDimension($dtl_row_c)->setRowHeight(20);
                $objPHPExcel->mergeCells('AK' . $dtl_row_c . ':AQ' . $dtl_row_c)->setCellValue('AK' . $dtl_row_c, $dt_operasi_jenis_c[$a]);
                $objPHPExcel->mergeCells('AR' . $dtl_row_c . ':AV' . $dtl_row_c)->setCellValue('AR' . $dtl_row_c, $dt_operasi_nilai_c[$a]);
                $objPHPExcel->mergeCells('AW' . $dtl_row_c . ':BA' . $dtl_row_c)->setCellValue('AW' . $dtl_row_c, $dt_operasi_akumulatif_c[$a]);
                $objPHPExcel->mergeCells('BB' . $dtl_row_c . ':BD' . $dtl_row_c)->setCellValue('BB' . $dtl_row_c, $dt_operasi_satuan_c[$a]);

                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'AK' . $dtl_row_c . ':AQ' . $dtl_row_c);
                $objPHPExcel->setSharedStyle($bodyStyle, 'AR' . $dtl_row_c . ':BD' . $dtl_row_c);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'BD' . ($dtl_row_c + 1) . ':BD' . ($dtl_row_c + 2));
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AK' . ($dtl_row_c + 1) . ':AK' . ($dtl_row_c + 2));
                $dtl_row_c++;
            }
            $objPHPExcel->mergeCells('AK' . ($dtl_row_c) . ':BD' . ($dtl_row_c))->setCellValue('AK' . ($dtl_row_c), '');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AK' . ($dtl_row_c) . ':BD' . ($dtl_row_c));
            $objPHPExcel->getStyle('AK' . ($dtl_row_c) . ':BD' . ($dtl_row_c))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99'))));
            $objPHPExcel->mergeCells('AK' . ($dtl_row_c + 1) . ':BD' . ($dtl_row_c + 1))->setCellValue('AK' . ($dtl_row_c + 1), 'PROSES UF');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AK' . ($dtl_row_c + 1) . ':BD' . ($dtl_row_c + 1));
            //end table b

            $start_detail = ($i1 * $jml_data_perpage_c_uf);
            $finish_detail = (($i1 * $jml_data_perpage_c_uf) + ($jml_data_perpage_c_uf - 1));

            //tabel c
            $dtl_row_c_uf = $dtl_row_c + 2;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                if (isset($operasi_jenis_c_uf[$a])) {
                    $dt_operasi_jenis_c_uf[$a]        = $operasi_jenis_c_uf[$a];
                } else {
                    $dt_operasi_jenis_c_uf[$a]        = "";
                }
                if (isset($operasi_nilai_c_uf[$a])) {
                    $dt_operasi_nilai_c_uf[$a]        = $operasi_nilai_c_uf[$a];
                } else {
                    $dt_operasi_nilai_c_uf[$a]        = "";
                }
                if (isset($operasi_akumulatif_c_uf[$a])) {
                    $dt_operasi_akumulatif_c_uf[$a]   = $operasi_akumulatif_c_uf[$a];
                } else {
                    $dt_operasi_akumulatif_c_uf[$a]   = "";
                }
                if (isset($operasi_satuan_c_uf[$a])) {
                    $dt_operasi_satuan_c_uf[$a]       = $operasi_satuan_c_uf[$a];
                } else {
                    $dt_operasi_satuan_c_uf[$a]       = "";
                }


                $objPHPExcel->getRowDimension($dtl_row_c_uf)->setRowHeight(20);
                $objPHPExcel->mergeCells('AK' . $dtl_row_c_uf . ':AQ' . $dtl_row_c_uf)->setCellValue('AK' . $dtl_row_c_uf, $dt_operasi_jenis_c_uf[$a]);
                $objPHPExcel->mergeCells('AR' . $dtl_row_c_uf . ':AV' . $dtl_row_c_uf)->setCellValue('AR' . $dtl_row_c_uf, $dt_operasi_nilai_c_uf[$a]);
                $objPHPExcel->mergeCells('AW' . $dtl_row_c_uf . ':BA' . $dtl_row_c_uf)->setCellValue('AW' . $dtl_row_c_uf, $dt_operasi_akumulatif_c_uf[$a]);
                $objPHPExcel->mergeCells('BB' . $dtl_row_c_uf . ':BD' . $dtl_row_c_uf)->setCellValue('BB' . $dtl_row_c_uf, $dt_operasi_satuan_c_uf[$a]);

                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'AK' . $dtl_row_c_uf . ':AQ' . $dtl_row_c_uf);
                $objPHPExcel->setSharedStyle($bodyStyle, 'AR' . $dtl_row_c_uf . ':BD' . $dtl_row_c_uf);
                $dtl_row_c_uf++;
            }
            $objPHPExcel->mergeCells('AK' . ($dtl_row_c_uf) . ':BD' . ($dtl_row_c_uf))->setCellValue('AK' . ($dtl_row_c_uf), '');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AK' . ($dtl_row_c_uf) . ':BD' . ($dtl_row_c_uf));
            $objPHPExcel->getStyle('AK' . ($dtl_row_c_uf) . ':BD' . ($dtl_row_c_uf))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99'))));
            $objPHPExcel->mergeCells('AK' . ($dtl_row_c_uf + 1) . ':BD' . ($dtl_row_c_uf + 1))->setCellValue('AK' . ($dtl_row_c_uf + 1), 'STOK AIR AWAL');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AK' . ($dtl_row_c_uf + 1) . ':BD' . ($dtl_row_c_uf + 1));
            //end table c

            //tabel d
            $start_detail = ($i1 * $jml_data_perpage_d);
            $finish_detail = (($i1 * $jml_data_perpage_d) + ($jml_data_perpage_d - 1));
            
            $dtl_row_d = $dtl_row_c_uf + 2;
            
            $objPHPExcel->mergeCells('AK' . $dtl_row_d . ':AQ' . $dtl_row_d)->setCellValue('AK' . $dtl_row_d, 'Total Stok');
            $objPHPExcel->mergeCells('BB' . $dtl_row_d . ':BD' . $dtl_row_d)->setCellValue('BB' . $dtl_row_d, 'M3');

            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_d)->setRowHeight(20);

                if (isset($dtdetail_d)) {
                    
                    if (isset($stok_air_awal[$a])) {
                        $dt_stok_air_awal[$a]  = $stok_air_awal[$a];
                    } else {
                        $dt_stok_air_awal[$a]  = "";
                    }
                }

                $objPHPExcel->mergeCells('AR' . $dtl_row_d . ':BA' . $dtl_row_d)->setCellValue('AR' . $dtl_row_d, $dt_stok_air_awal[$a]);

                $objPHPExcel->setSharedStyle($bodyStyle, 'AK' . $dtl_row_d . ':BD' . $dtl_row_d);
                $dtl_row_d++;
            }
            $objPHPExcel->mergeCells('AK' . ($dtl_row_d) . ':BD' . ($dtl_row_d))->setCellValue('AK' . ($dtl_row_d), '');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BE' . ($dtl_row_d) . ':CE' . ($dtl_row_d));
            $objPHPExcel->getStyle('AK' . ($dtl_row_d) . ':BD' . ($dtl_row_d))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99'))));
            
            $objPHPExcel->mergeCells('AK' . ($dtl_row_d + 1) . ':BD' . ($dtl_row_d + 1))->setCellValue('AK' . ($dtl_row_d + 1), 'STOK AIR AKHIR');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AK' . ($dtl_row_d + 1) . ':BD' . ($dtl_row_d + 1));
            //end table d
            // table e
            $start_detail = ($i1 * $jml_data_perpage_e);
            $finish_detail = (($i1 * $jml_data_perpage_e) + ($jml_data_perpage_e - 1));

            $dtl_row_e = $dtl_row_d + 2;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_e)->setRowHeight(20);   
                if (isset($operasi_jenis_e[$a])) {
                    $dt_operasi_jenis_e[$a]  = $operasi_jenis_e[$a];
                } else {
                    $dt_operasi_jenis_e[$a]  = "";
                }
                if (isset($operasi_nilai_e[$a])) {
                    $dt_operasi_nilai_e[$a]           = $operasi_nilai_e[$a];
                } else {
                    $dt_operasi_nilai_e[$a]           = "";
                }
                if (isset($operasi_akumulatif_e[$a])) {
                    $dt_operasi_akumulatif_e[$a]      = $operasi_akumulatif_e[$a];
                } else {
                    $dt_operasi_akumulatif_e[$a]      = "";
                }
                if (isset($operasi_satuan_e[$a])) {
                    $dt_operasi_satuan_e[$a]       = $operasi_satuan_e[$a];
                } else {
                    $dt_operasi_satuan_e[$a]       = "";
                }
                

                $objPHPExcel->mergeCells('AK' . $dtl_row_e . ':AQ' . $dtl_row_e)->setCellValue('AK' . $dtl_row_e, $dt_operasi_jenis_e[$a]);
                $objPHPExcel->mergeCells('AR' . $dtl_row_e . ':AV' . $dtl_row_e)->setCellValue('AR' . $dtl_row_e, $dt_operasi_nilai_e[$a]);
                $objPHPExcel->mergeCells('AW' . $dtl_row_e . ':BA' . $dtl_row_e)->setCellValue('AW' . $dtl_row_e, $dt_operasi_akumulatif_e[$a]);
                $objPHPExcel->mergeCells('BB' . $dtl_row_e . ':BD' . $dtl_row_e)->setCellValue('BB' . $dtl_row_e, $dt_operasi_satuan_e[$a]);

                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'AK' . $dtl_row_e . ':AQ' . $dtl_row_e);
                $objPHPExcel->setSharedStyle($bodyStyle, 'AR' . $dtl_row_e . ':BD' . $dtl_row_e);
                $dtl_row_e++;
            }
            $objPHPExcel->mergeCells('AK' . $dtl_row_e . ':AQ' . $dtl_row_e)->setCellValue('AK' . $dtl_row_e, 'Total Stok');
            $objPHPExcel->mergeCells('AR' . $dtl_row_e . ':AV' . $dtl_row_e)->setCellValue('AR' . $dtl_row_e, $total_operasi_nilai_e);
            $objPHPExcel->mergeCells('AW' . $dtl_row_e . ':BA' . $dtl_row_e)->setCellValue('AW' . $dtl_row_e, $total_operasi_akumulatif_e);
            $objPHPExcel->mergeCells('BB' . $dtl_row_e . ':BD' . $dtl_row_e)->setCellValue('BB' . $dtl_row_e, $total_operasi_satuan_e);
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AK' . ($dtl_row_e) . ':BD' . ($dtl_row_e));

            $objPHPExcel->mergeCells('AK' . ($dtl_row_e+1) . ':BD' . ($dtl_row_e+1))->setCellValue('AK' . ($dtl_row_e+1), '');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AK' . ($dtl_row_e+1) . ':BD' . ($dtl_row_e+1));
            $objPHPExcel->getStyle('AK' . ($dtl_row_e+1) . ':BD' . ($dtl_row_e+1))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99'))));
            
            $objPHPExcel->mergeCells('AK' . ($dtl_row_e + 2) . ':BD' . ($dtl_row_e + 2))->setCellValue('AK' . ($dtl_row_e + 2), 'PROSES AIR RECYCLE');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AK' . ($dtl_row_e + 2) . ':BD' . ($dtl_row_e + 2));
            //end table e
            //tabel f

            $start_detail = ($i1 * $jml_data_perpage_f);
            $finish_detail = (($i1 * $jml_data_perpage_f) + ($jml_data_perpage_f - 1));
            
            $dtl_row_f = $dtl_row_e + 3;
            
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_f)->setRowHeight(20);

                if (isset($operasi_jenis_f[$a])) {
                    $dt_operasi_jenis_f[$a]  = $operasi_jenis_f[$a];
                } else {
                    $dt_operasi_jenis_f[$a]  = "";
                }
                if (isset($operasi_nilai_f[$a])) {
                    $dt_operasi_nilai_f[$a]           = $operasi_nilai_f[$a];
                } else {
                    $dt_operasi_nilai_f[$a]           = "";
                }
                if (isset($operasi_akumulatif_f[$a])) {
                    $dt_operasi_akumulatif_f[$a]       = $operasi_akumulatif_f[$a];
                } else {
                    $dt_operasi_akumulatif_f[$a]       = "";
                }
                if (isset($operasi_satuan_f[$a])) {
                    $dt_operasi_satuan_f[$a]       = $operasi_satuan_f[$a];
                } else {
                    $dt_operasi_satuan_f[$a]       = "";
                }

                $objPHPExcel->mergeCells('AK' . $dtl_row_f . ':AQ' . $dtl_row_f)->setCellValue('AK' . $dtl_row_f, $dt_operasi_jenis_f[$a]);
                $objPHPExcel->mergeCells('AR' . $dtl_row_f . ':AV' . $dtl_row_f)->setCellValue('AR' . $dtl_row_f, $dt_operasi_nilai_f[$a]);
                $objPHPExcel->mergeCells('AW' . $dtl_row_f . ':BA' . $dtl_row_f)->setCellValue('AW' . $dtl_row_f, $dt_operasi_akumulatif_f[$a]);
                $objPHPExcel->mergeCells('BB' . $dtl_row_f . ':BD' . $dtl_row_f)->setCellValue('BB' . $dtl_row_f, $dt_operasi_satuan_f[$a]);

                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'AK' . $dtl_row_f . ':AQ' . $dtl_row_f);
                $objPHPExcel->setSharedStyle($bodyStyle, 'AR' . $dtl_row_f . ':BD' . $dtl_row_f);
                $dtl_row_f++;
            }

            $objPHPExcel->mergeCells('AK' . ($dtl_row_f) . ':AQ' . ($dtl_row_f))->setCellValue('AK' . ($dtl_row_f), 'Total');
            $objPHPExcel->mergeCells('AR' . ($dtl_row_f) . ':AV' . ($dtl_row_f))->setCellValue('AR' . ($dtl_row_f),  $total_dtl_f_operasi_nilai );
            $objPHPExcel->mergeCells('AW' . ($dtl_row_f) . ':BA' . ($dtl_row_f))->setCellValue('AW' . ($dtl_row_f),  $total_dtl_f_operasi_akumulatif );
            $objPHPExcel->mergeCells('BB' . ($dtl_row_f) . ':BD' . ($dtl_row_f))->setCellValue('BB' . ($dtl_row_f),  $operasi_satuan_f_total );

            $objPHPExcel->mergeCells('AK' . ($dtl_row_f + 1) . ':BD' . ($dtl_row_f + 1))->setCellValue('AK' . ($dtl_row_f + 1), '');
            $objPHPExcel->mergeCells('AK' . ($dtl_row_f + 2) . ':AQ' . ($dtl_row_f + 2))->setCellValue('AK' . ($dtl_row_f + 2), 'Stok Air Akhir + Recycle');
            $objPHPExcel->mergeCells('AR' . ($dtl_row_f + 2) . ':AV' . ($dtl_row_f + 2))->setCellValue('AR' . ($dtl_row_f + 2), 'T.Distribusi');
            $objPHPExcel->mergeCells('AW' . ($dtl_row_f + 2) . ':BA' . ($dtl_row_f + 2))->setCellValue('AW' . ($dtl_row_f + 2), 'Stok Air Awal');
            $objPHPExcel->mergeCells('BB' . ($dtl_row_f + 2) . ':BD' . ($dtl_row_f + 2))->setCellValue('BB' . ($dtl_row_f + 2), 'Total Proses');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AK' . ($dtl_row_f ) . ':BD' . ($dtl_row_f + 2));

            $objPHPExcel->getStyle('AK' . ($dtl_row_f+1) . ':BD' . ($dtl_row_f+1))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '4dffff'))));
            //end table f
            //table g
            $start_detail = ($i1 * $jml_data_perpage_g);
            $finish_detail = (($i1 * $jml_data_perpage_g) + ($jml_data_perpage_g - 1));

            $dtl_row_g = $dtl_row_f + 3;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_g)->setRowHeight(20);

                if (isset($stok_air_akhir_g[$a])) {
                    $dt_stok_air_akhir_g[$a]    = $stok_air_akhir_g[$a];
                } else {
                    $dt_stok_air_akhir_g[$a]    = "";
                }
                if (isset($t_distribusi_g[$a])) {
                    $dt_t_distribusi_g[$a]      = $t_distribusi_g[$a];
                } else {
                    $dt_t_distribusi_g[$a]      = "";
                }
                if (isset($stok_air_awal_g[$a])) {
                    $dt_stok_air_awal_g[$a]     = $stok_air_awal_g[$a];
                } else {
                    $dt_stok_air_awal_g[$a]     = "";
                }
                if (isset($total_proses_g[$a])) {
                    $dt_total_proses_g[$a]      = $total_proses_g[$a];
                } else {
                    $dt_total_proses_g[$a]      = "";
                }
                

                $objPHPExcel->mergeCells('AK' . $dtl_row_g . ':AQ' . $dtl_row_g)->setCellValue('AK' . $dtl_row_g, $dt_stok_air_akhir_g[$a]);
                $objPHPExcel->mergeCells('AR' . $dtl_row_g . ':AV' . $dtl_row_g)->setCellValue('AR' . $dtl_row_g, $dt_t_distribusi_g[$a]);
                $objPHPExcel->mergeCells('AW' . $dtl_row_g . ':BA' . $dtl_row_g)->setCellValue('AW' . $dtl_row_g, $dt_stok_air_awal_g[$a]);
                $objPHPExcel->mergeCells('BB' . $dtl_row_g . ':BD' . $dtl_row_g)->setCellValue('BB' . $dtl_row_g, $dt_total_proses_g[$a]);

                $objPHPExcel->setSharedStyle($bodyStyle, 'AK' . $dtl_row_g . ':BD' . $dtl_row_g);
                $dtl_row_g++;
            }
            $objPHPExcel->mergeCells('BB' . ($dtl_row_g) . ':BD' . ($dtl_row_g))->setCellValue('BB' . ($dtl_row_g),  number_format($dtl_g_total_bawah, 1) );
            $objPHPExcel->setSharedStyle($noborderStyle, 'AK' . ($dtl_row_g ) . ':BA' . ($dtl_row_g));
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BB' . ($dtl_row_g ) . ':BD' . ($dtl_row_g));
            //end table g
            //tanle h
            $start_detail = ($i1 * $jml_data_perpage_h);
            $finish_detail = (($i1 * $jml_data_perpage_h) + ($jml_data_perpage_h - 1));
            
            $dtl_row_h = $dtl_row_g + 1;
            
            $objPHPExcel->mergeCells('AK' . ($dtl_row_h) . ':BD' . ($dtl_row_h))->setCellValue('AK' . ($dtl_row_h), 'Catatan : ');
            $objPHPExcel->mergeCells('AK' . ($dtl_row_h + 1) . ':AU' . ($dtl_row_h + 1))->setCellValue('AK' . ($dtl_row_h + 1), "Drain (M3)");
            $objPHPExcel->mergeCells('AK' . ($dtl_row_h + 2) . ':AU' . ($dtl_row_h + 2))->setCellValue('AK' . ($dtl_row_h + 2), "Backwash Tangki / CIP (M3)");
            $objPHPExcel->mergeCells('AK' . ($dtl_row_h + 3) . ':AU' . ($dtl_row_h + 3))->setCellValue('AK' . ($dtl_row_h + 3), "Cleaning Bak (M3)");
            $objPHPExcel->mergeCells('AK' . ($dtl_row_h + 4) . ':AU' . ($dtl_row_h + 4))->setCellValue('AK' . ($dtl_row_h + 4), "Operasional WTD (M3)");
            $objPHPExcel->mergeCells('AK' . ($dtl_row_h + 5) . ':AU' . ($dtl_row_h + 5))->setCellValue('AK' . ($dtl_row_h + 5), "Konservasi Energi");

            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_h)->setRowHeight(20);

                if (isset($drain_sedimen_h[$a])) {
                    $dt_drain_sedimen_h[$a]   = $drain_sedimen_h[$a];
                } else {
                    $dt_drain_sedimen_h[$a]   = "";
                }
                if (isset($backwash_tanki_h[$a])) {
                    $dt_backwash_tanki_h[$a]  = $backwash_tanki_h[$a];
                } else {
                    $dt_backwash_tanki_h[$a]  = "";
                }
                if (isset($cleaning_bak_h[$a])) {
                    $dt_cleaning_bak_h[$a]    = $cleaning_bak_h[$a];
                } else {
                    $dt_cleaning_bak_h[$a]    = "";
                }
                if (isset($operasional_h[$a])) {
                    $dt_operasional_h[$a]     = $operasional_h[$a];
                } else {
                    $dt_operasional_h[$a]     = "";
                }
                if(isset($operasi_nilai_f[4])){
                    $dt_operasi_nilai_f[4]     = $operasi_nilai_f[4];
                } else {
                    $dt_operasi_nilai_f[4]     = "";

                }

                $objPHPExcel->mergeCells('AV' . ($dtl_row_h + 1) . ':BD' . ($dtl_row_h + 1))->setCellValue('AV' . ($dtl_row_h + 1), " : ".$dt_drain_sedimen_h[$a]);
                $objPHPExcel->mergeCells('AV' . ($dtl_row_h + 2) . ':BD' . ($dtl_row_h + 2))->setCellValue('AV' . ($dtl_row_h + 2)," : ". $dt_backwash_tanki_h[$a]);
                $objPHPExcel->mergeCells('AV' . ($dtl_row_h + 3) . ':BD' . ($dtl_row_h + 3))->setCellValue('AV' . ($dtl_row_h + 3)," : ". $dt_cleaning_bak_h[$a]);
                $objPHPExcel->mergeCells('AV' . ($dtl_row_h + 4) . ':BD' . ($dtl_row_h + 4))->setCellValue('AV' . ($dtl_row_h + 4)," : ". $dt_operasional_h[$a]);
                $objPHPExcel->mergeCells('AV' . ($dtl_row_h + 5) . ':BD' . ($dtl_row_h + 5))->setCellValue('AV' . ($dtl_row_h + 5)," : ". $dt_operasi_nilai_f[4] ." (Reject RO Turbin)");

                $objPHPExcel->setSharedStyle($headerStyleRight, 'BD' . ($dtl_row_h) . ':BD' . ($total_row));
                $objPHPExcel->setSharedStyle($headerStyleRight, 'BD' . ($dtl_row_h ) . ':BD' . ($dtl_row_h + 3));
                $objPHPExcel->setSharedStyle($noborderStyle,'AK' . ($dtl_row_h) . ':BC' . ($dtl_row_h + 3));
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AK' . ($dtl_row_h ) . ':AK' . ($dtl_row_h + 4));
                $dtl_row_h++;
            }
            $objPHPExcel->setSharedStyle($noborderStyle, 'AK' . $dtl_row_h . ':BC' . ($total_row));
            //end table h
            //table i
            $start_detail = ($i1 * $jml_data_perpage_i);
            $finish_detail = (($i1 * $jml_data_perpage_i) + ($jml_data_perpage_i - 1));

            $objPHPExcel->mergeCells('BE' . ($start_row + 4) . ':BY' . ($start_row + 4))->setCellValue('BE' . ($start_row + 4), "BAHAN BAKU LARUTAN (KG");
            $objPHPExcel->mergeCells('BE' . ($start_row + 5) . ':BK' . ($start_row + 5))->setCellValue('BE' . ($start_row + 5), "Bahan Kimia");
            $objPHPExcel->mergeCells('BL' . ($start_row + 5) . ':BR' . ($start_row + 5))->setCellValue('BL' . ($start_row + 5), "Pakai");
            $objPHPExcel->mergeCells('BS' . ($start_row + 5) . ':BY' . ($start_row + 5))->setCellValue('BS' . ($start_row + 5), "Effesiensi");
            $objPHPExcel->mergeCells('BZ' . ($start_row + 4) . ':CE' . ($start_row + 5))->setCellValue('BZ' . ($start_row + 4), "");
            $objPHPExcel->getStyle('BE' . ($start_row + 4) . ':BY' . ($start_row + 5))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'ffff1a'))));
            
            $dtl_row_i = $start_row + 6;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_i)->setRowHeight(20);

                if (isset($operasi_jenis_i[$a])) {
                    $dt_operasi_jenis_i[$a]         = $operasi_jenis_i[$a];
                } else {
                    $dt_operasi_jenis_i[$a]         = "";
                }
                if (isset($operasi_nilai_i[$a])) {
                    $dt_operasi_nilai_i[$a]         = $operasi_nilai_i[$a];
                } else {
                    $dt_operasi_nilai_i[$a]         = "";
                }
                if (isset($operasi_akumulatif_i[$a])) {
                    $dt_operasi_akumulatif_i[$a]    = $operasi_akumulatif_i[$a];
                } else {
                    $dt_operasi_akumulatif_i[$a]    = "";
                }
                if (isset($operasi_effisiensi_i[$a])) {
                    $dt_operasi_effisiensi_i[$a]    = $operasi_effisiensi_i[$a];
                } else {
                    $dt_operasi_effisiensi_i[$a]    = "";
                }
                if (isset($operasi_stok_i[$a])) {
                    $dt_operasi_stok_i[$a]          = $operasi_stok_i[$a];
                } else {
                    $dt_operasi_stok_i[$a]          = "";
                }

                $objPHPExcel->mergeCells('BE' . $dtl_row_i . ':BK' . $dtl_row_i)->setCellValue('BE' . $dtl_row_i, $dt_operasi_jenis_i[$a]);
                $objPHPExcel->mergeCells('BL' . $dtl_row_i . ':BR' . $dtl_row_i)->setCellValue('BL' . $dtl_row_i, $dt_operasi_nilai_i[$a]);
                $objPHPExcel->mergeCells('BS' . $dtl_row_i . ':BY' . $dtl_row_i)->setCellValue('BS' . $dtl_row_i, $dt_operasi_effisiensi_i[$a]);
                $objPHPExcel->mergeCells('BZ' . $dtl_row_i . ':CE' . $dtl_row_i)->setCellValue('BZ' . $dtl_row_i, '');

                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'BE' . $dtl_row_i . ':BK' . $dtl_row_i);
                $objPHPExcel->setSharedStyle($bodyStyle, 'BL' . $dtl_row_i . ':CE' . $dtl_row_i);
                $dtl_row_i++;
            }
            $objPHPExcel->mergeCells('BE' . ($dtl_row_i ) . ':CE' . ($dtl_row_i ))->setCellValue('BE' . ($dtl_row_i ), '');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BE' . ($dtl_row_i) . ':CE' . ($dtl_row_i));
            $objPHPExcel->getStyle('BE' . ($dtl_row_i) . ':CE' . ($dtl_row_i))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99'))));
            //end table i

            //table j            
            $start_detail = ($i1 * $jml_data_perpage_j);
            $finish_detail = (($i1 * $jml_data_perpage_j) + ($jml_data_perpage_j - 1));
            
            $objPHPExcel->mergeCells('BE' . ($dtl_row_i + 1) . ':CE' . ($dtl_row_i + 1))->setCellValue('BE' . ($dtl_row_i + 1), 'Target :');
            $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'BE' . ($dtl_row_i + 1) . ':CE' . ($dtl_row_i + 1));

            $dtl_row_j = $dtl_row_i + 2;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_j)->setRowHeight(20);

                if (isset($operasi_jenis_j[$a])) {
                    $dt_operasi_jenis_j[$a]   = $operasi_jenis_j[$a];
                } else {
                    $dt_operasi_jenis_j[$a]   = "";
                }
                if (isset($target_j[$a])) {
                    $dt_target_j[$a]          = $target_j[$a];
                } else {
                    $dt_target_j[$a]          = "";
                }
                if (isset($operasi_satuan_j[$a])) {
                    $dt_operasi_satuan_j[$a]  = $operasi_satuan_j[$a];
                } else {
                    $dt_operasi_satuan_j[$a]  = "";
                }
            

                $objPHPExcel->mergeCells('BE' . $dtl_row_j . ':BK' . $dtl_row_j)->setCellValue('BE' . $dtl_row_j, $dt_operasi_jenis_j[$a]);
                $objPHPExcel->mergeCells('BL' . $dtl_row_j . ':BY' . $dtl_row_j)->setCellValue('BL' . $dtl_row_j, $dt_target_j[$a]);
                $objPHPExcel->mergeCells('BZ' . $dtl_row_j . ':CE' . $dtl_row_j)->setCellValue('BZ' . $dtl_row_j, $dt_operasi_satuan_j[$a]);

                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'BE' . $dtl_row_j . ':CE' . $dtl_row_j);
                $dtl_row_j++;
            }
            $objPHPExcel->mergeCells('BE' . ($dtl_row_j) . ':CE' . ($dtl_row_j))->setCellValue('BE' . ($dtl_row_j), '');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BE' . ($dtl_row_j) . ':CE' . ($dtl_row_j));
            $objPHPExcel->getStyle('BE' . ($dtl_row_j) . ':CE' . ($dtl_row_j))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99'))));
            //end table j

            //table k

            $start_detail = ($i1 * $jml_data_perpage_k);
            $finish_detail = (($i1 * $jml_data_perpage_k) + ($jml_data_perpage_k - 1));

            $objPHPExcel->mergeCells('BE' . ($dtl_row_j + 1) . ':CE' . ($dtl_row_j + 1))->setCellValue('BE' . ($dtl_row_j + 1), 'PEMAKAIAN BAHAN KIMIA SAND FILTER');
            
            $objPHPExcel->mergeCells('BE' . ( $dtl_row_j + 2) . ':BK' . ( $dtl_row_j + 2))->setCellValue('BE' . ( $dtl_row_j + 2), "Bahan Kimia");
            $objPHPExcel->mergeCells('BL' . ( $dtl_row_j + 2) . ':BR' . ( $dtl_row_j + 2))->setCellValue('BL' . ( $dtl_row_j + 2), "Pakai");
            $objPHPExcel->mergeCells('BS' . ( $dtl_row_j + 2) . ':BY' . ( $dtl_row_j + 2))->setCellValue('BS' . ( $dtl_row_j + 2), "Akumulatif");
            $objPHPExcel->mergeCells('BZ' . ( $dtl_row_j + 2) . ':CE' . ( $dtl_row_j + 2))->setCellValue('BZ' . ( $dtl_row_j + 2), "Stock");
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BE' . ($dtl_row_j + 1) . ':CE' . ($dtl_row_j + 2));

            $objPHPExcel->getStyle('BE' . ($dtl_row_j + 1) . ':CE' . ($dtl_row_j + 1))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'e580ff'))));

            $dtl_row_k = $dtl_row_j + 3;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_k)->setRowHeight(20);

                if (isset($operasi_jenis_k[$a])) {
                    $dt_operasi_jenis_k[$a]         = $operasi_jenis_k[$a];
                } else {
                    $dt_operasi_jenis_k[$a]         = "";
                }
                if (isset($operasi_nilai_k[$a])) {
                    $dt_operasi_nilai_k[$a]         = $operasi_nilai_k[$a];
                } else {
                    $dt_operasi_nilai_k[$a]         = "";
                }
                if (isset($effisiensi_k[$a])) {
                    $dt_effisiensi_k[$a]            = $effisiensi_k[$a];
                } else {
                    $dt_effisiensi_k[$a]            = "";
                }
                if (isset($operasi_akumulatif_k[$a])) {
                    $dt_operasi_akumulatif_k[$a]    = $operasi_akumulatif_k[$a];
                } else {
                    $dt_operasi_akumulatif_k[$a]    = "";
                }
                if (isset($keterangan_k[$a])) {
                    $dt_keterangan_k[$a]            = $keterangan_k[$a];
                } else {
                    $dt_keterangan_k[$a]            = "";
                }
                if (isset($stock_k[$a])) {
                    $dt_stock_k[$a]            = $stock_k[$a];
                } else {
                    $dt_stock_k[$a]            = "";
                }
            

                $objPHPExcel->mergeCells('BE' . $dtl_row_k . ':BK' . $dtl_row_k)->setCellValue('BE' . $dtl_row_k, $dt_operasi_jenis_k[$a]);
                $objPHPExcel->mergeCells('BL' . $dtl_row_k . ':BR' . $dtl_row_k)->setCellValue('BL' . $dtl_row_k, $dt_operasi_nilai_k[$a]);
                $objPHPExcel->mergeCells('BS' . $dtl_row_k . ':BY' . $dtl_row_k)->setCellValue('BS' . $dtl_row_k, $dt_operasi_akumulatif_k[$a]);
                $objPHPExcel->mergeCells('BZ' . $dtl_row_k . ':CE' . $dtl_row_k)->setCellValue('BZ' . $dtl_row_k, $dt_stock_k[$a]);

                $objPHPExcel->setSharedStyle($bodyStyle, 'BL' . $dtl_row_k . ':CE' . $dtl_row_k);
                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'BE' . $dtl_row_k . ':BK' . $dtl_row_k);
                $dtl_row_k++;
            }
            $objPHPExcel->mergeCells('BE' . ($dtl_row_k) . ':CE' . ($dtl_row_k))->setCellValue('BE' . ($dtl_row_k ), '');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BE' . ($dtl_row_k) . ':CE' . ($dtl_row_k));
            $objPHPExcel->getStyle('BE' . ($dtl_row_k) . ':CE' . ($dtl_row_k))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99'))));
            //end table k

            //table l
            $start_detail = ($i1 * $jml_data_perpage_l);
            $finish_detail = (($i1 * $jml_data_perpage_l) + ($jml_data_perpage_l - 1));
            
            $objPHPExcel->mergeCells('BE' . ($dtl_row_k + 1) . ':CE' . ($dtl_row_k + 1))->setCellValue('BE' . ($dtl_row_k + 1), 'PEMAKAIAN BAHAN KIMIA SOFTENER');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BE' . ($dtl_row_k + 1) . ':CE' . ($dtl_row_k + 1));

            $objPHPExcel->getStyle('BE' . ($dtl_row_k + 1) . ':CE' . ($dtl_row_k + 1))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'e580ff'))));

            $dtl_row_l = $dtl_row_k + 2;

            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_l)->setRowHeight(20);

                if (isset($operasi_jenis_l[$a])) {
                    $dt_operasi_jenis_l[$a] = $operasi_jenis_l[$a];
                } else {
                    $dt_operasi_jenis_l[$a] = "";
                }
                if (isset($operasi_nilai_l[$a])) {
                    $dt_operasi_nilai_l[$a] = $operasi_nilai_l[$a];
                } else {
                    $dt_operasi_nilai_l[$a] = "";
                }
                if (isset($effisiensi_l[$a])) {
                    $dt_effisiensi_l[$a] = $effisiensi_l[$a];
                } else {
                    $dt_effisiensi_l[$a] = "";
                }
                if (isset($operasi_akumulatif_l[$a])) {
                    $dt_operasi_akumulatif_l[$a] = $operasi_akumulatif_l[$a];
                } else {
                    $dt_operasi_akumulatif_l[$a] = "";
                }
                if (isset($stok_l[$a])) {
                    $dt_stok_l[$a] = $stok_l[$a];
                } else {
                    $dt_stok_l[$a] = "";
                }
            

                $objPHPExcel->mergeCells('BE' . $dtl_row_l . ':BK' . $dtl_row_l)->setCellValue('BE' . $dtl_row_l, $dt_operasi_jenis_l[$a]);
                $objPHPExcel->mergeCells('BL' . $dtl_row_l . ':BR' . $dtl_row_l)->setCellValue('BL' . $dtl_row_l, $dt_operasi_nilai_l[$a]);
                $objPHPExcel->mergeCells('BS' . $dtl_row_l . ':BY' . $dtl_row_l)->setCellValue('BS' . $dtl_row_l, $dt_operasi_akumulatif_l[$a]);
                $objPHPExcel->mergeCells('BZ' . $dtl_row_l . ':CE' . $dtl_row_l)->setCellValue('BZ' . $dtl_row_l, $dt_stok_l[$a]);

                $objPHPExcel->setSharedStyle($bodyStyle, 'BL' . $dtl_row_l . ':CE' . $dtl_row_l);
                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'BE' . $dtl_row_l . ':BK' . $dtl_row_l);
                $dtl_row_l++;
            }
            $objPHPExcel->mergeCells('BE' . ($dtl_row_l) . ':CE' . ($dtl_row_l))->setCellValue('BE' . ($dtl_row_l), '');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BE' . ($dtl_row_l) . ':CE' . ($dtl_row_l));
            $objPHPExcel->getStyle('BE' . ($dtl_row_l) . ':CE' . ($dtl_row_l))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99'))));
            //end table l

            //table m
            $start_detail = ($i1 * $jml_data_perpage_m);
            $finish_detail = (($i1 * $jml_data_perpage_m) + ($jml_data_perpage_m - 1));
            
            $objPHPExcel->mergeCells('BE' . ($dtl_row_l + 1) . ':CE' . ($dtl_row_l + 1))->setCellValue('BE' . ($dtl_row_l + 1), 'PEMAKAIAN BAHAN KIMIA RO & UF');
            
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BE' . ($dtl_row_l + 1) . ':CE' . ($dtl_row_l + 1));

            $objPHPExcel->getStyle('BE' . ($dtl_row_l + 1) . ':CE' . ($dtl_row_l + 1))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'e580ff'))));

            $dtl_row_m = $dtl_row_l + 2;

            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_m)->setRowHeight(20);

                if (isset($operasi_jenis_m[$a])) {
                    $dt_operasi_jenis_m[$a] = $operasi_jenis_m[$a];
                } else {
                    $dt_operasi_jenis_m[$a] = "";
                }
                if (isset($operasi_nilai_m[$a])) {
                    $dt_operasi_nilai_m[$a] = $operasi_nilai_m[$a];
                } else {
                    $dt_operasi_nilai_m[$a] = "";
                }
                if (isset($effisiensi_m[$a])) {
                    $dt_effisiensi_m[$a] = $effisiensi_m[$a];
                } else {
                    $dt_effisiensi_m[$a] = "";
                }
                if (isset($operasi_akumulatif_m[$a])) {
                    $dt_operasi_akumulatif_m[$a] = $operasi_akumulatif_m[$a];
                } else {
                    $dt_operasi_akumulatif_m[$a] = "";
                }
                if (isset($stok_m[$a])) {
                    $dt_stok_m[$a] = $stok_m[$a];
                } else {
                    $dt_stok_m[$a] = "";
                }
            

                $objPHPExcel->mergeCells('BE' . $dtl_row_m . ':BK' . $dtl_row_m)->setCellValue('BE' . $dtl_row_m, $dt_operasi_jenis_m[$a]);
                $objPHPExcel->mergeCells('BL' . $dtl_row_m . ':BR' . $dtl_row_m)->setCellValue('BL' . $dtl_row_m, $dt_operasi_nilai_m[$a]);
                $objPHPExcel->mergeCells('BS' . $dtl_row_m . ':BY' . $dtl_row_m)->setCellValue('BS' . $dtl_row_m, $dt_operasi_akumulatif_m[$a]);
                $objPHPExcel->mergeCells('BZ' . $dtl_row_m . ':CE' . $dtl_row_m)->setCellValue('BZ' . $dtl_row_m, $dt_stok_m[$a]);

                $objPHPExcel->setSharedStyle($bodyStyle, 'BL' . $dtl_row_m . ':CE' . $dtl_row_m);
                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'BE' . $dtl_row_m . ':BK' . $dtl_row_m);
                $dtl_row_m++;
            }

            $objPHPExcel->mergeCells('BE' . ($dtl_row_m) . ':CE' . ($dtl_row_m))->setCellValue('BE' . ($dtl_row_m), '');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BE' . ($dtl_row_m) . ':CE' . ($dtl_row_m));
            $objPHPExcel->getStyle('BE' . ($dtl_row_m) . ':CE' . ($dtl_row_m))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99'))));
            //end table m

            //table n
            
            $start_detail = ($i1 * $jml_data_perpage_n);
            $finish_detail = (($i1 * $jml_data_perpage_n) + ($jml_data_perpage_n - 1));

            $objPHPExcel->mergeCells('BE' . ($dtl_row_m + 1) . ':CE' . ($dtl_row_m + 1))->setCellValue('BE' . ($dtl_row_m + 1), 'PEMAKAIAN BAHAN FILTER RO & UF');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BE' . ($dtl_row_m + 1) . ':CE' . ($dtl_row_m + 1));

            $objPHPExcel->getStyle('BE' . ($dtl_row_m + 1) . ':CE' . ($dtl_row_m + 1))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'e580ff'))));

            $dtl_row_n = $dtl_row_m + 2;

            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_n)->setRowHeight(20);

                if (isset($operasi_jenis_n[$a])) {
                    $dt_operasi_jenis_n[$a]         = $operasi_jenis_n[$a];
                } else {
                    $dt_operasi_jenis_n[$a]         = "";
                }
                if (isset($operasi_nilai_n[$a])) {
                    $dt_operasi_nilai_n[$a]         = $operasi_nilai_n[$a];
                } else {
                    $dt_operasi_nilai_n[$a]         = "";
                }
                if (isset($operasi_akumulatif_n[$a])) {
                    $dt_operasi_akumulatif_n[$a]    = $operasi_akumulatif_n[$a];
                } else {
                    $dt_operasi_akumulatif_n[$a]    = "";
                }
                if (isset($stok_n[$a])) {
                    $dt_stok_n[$a]                  = $stok_n[$a];
                } else {
                    $dt_stok_n[$a]                  = "";
                }
            

                $objPHPExcel->mergeCells('BE' . $dtl_row_n . ':BK' . $dtl_row_n)->setCellValue('BE' . $dtl_row_n, $dt_operasi_jenis_n[$a]);
                $objPHPExcel->mergeCells('BL' . $dtl_row_n . ':BR' . $dtl_row_n)->setCellValue('BL' . $dtl_row_n, $dt_operasi_nilai_n[$a]);
                $objPHPExcel->mergeCells('BS' . $dtl_row_n . ':BY' . $dtl_row_n)->setCellValue('BS' . $dtl_row_n, $dt_operasi_akumulatif_n[$a]);
                $objPHPExcel->mergeCells('BZ' . $dtl_row_n . ':CE' . $dtl_row_n)->setCellValue('BZ' . $dtl_row_n, $dt_stok_n[$a]);

                $objPHPExcel->setSharedStyle($bodyStyle, 'BL' . $dtl_row_n . ':CE' . $dtl_row_n);
                $objPHPExcel->setSharedStyle($bodyStyleAlignLeft, 'BE' . $dtl_row_n . ':BK' . $dtl_row_n);
                $dtl_row_n++;
            }

            $objPHPExcel->mergeCells('BE' . ($dtl_row_n ) . ':CE' . ($dtl_row_n ))->setCellValue('BE' . ($dtl_row_n ), '');
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BE' . ($dtl_row_n) . ':CE' . ($dtl_row_n));
            $objPHPExcel->getStyle('BE' . ($dtl_row_n) . ':CE' . ($dtl_row_n))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '99ff99'))));
            //end table n
            
            //table o
            $start_detail = ($i1 * $jml_data_perpage_o);
            $finish_detail = (($i1 * $jml_data_perpage_o) + ($jml_data_perpage_o - 1));
            
            $objPHPExcel->mergeCells('BE' . ($dtl_row_n + 1) . ':CE' . ($dtl_row_n + 2))->setCellValue('BE' . ($dtl_row_n + 1), 'Keterangan Proses RO :');
            $objPHPExcel->setSharedStyle($noborderStyleBold, 'BE' . ($dtl_row_n + 1) . ':CE' . ($dtl_row_n + 2));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'CE' . ($dtl_row_n + 1) . ':CE' . ($dtl_row_n + 2));
            
            $dtl_row_o = $dtl_row_n + 3;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_o)->setRowHeight(20);

                if (isset($operasi_jenis_o[$a])) {
                    $dt_operasi_jenis_o[$a]   = $operasi_jenis_o[$a];
                } else {
                    $dt_operasi_jenis_o[$a]   = "";
                }
                if (isset($operasi_produk_o[$a])) {
                    $dt_operasi_produk_o[$a]  = $operasi_produk_o[$a];
                } else {
                    $dt_operasi_produk_o[$a]  = "";
                }
                if (isset($operasi_jam_o[$a])) {
                    $dt_operasi_jam_o[$a]     = $operasi_jam_o[$a];
                } else {
                    $dt_operasi_jam_o[$a]     = "";
                }
                if (isset($operasi_satuan_o[$a])) {
                    $dt_operasi_satuan_o[$a]  = $operasi_satuan_o[$a];
                } else {
                    $dt_operasi_satuan_o[$a]  = "";
                }
            

                $objPHPExcel->mergeCells('BE' . $dtl_row_o . ':BK' . $dtl_row_o)->setCellValue('BE' . $dtl_row_o, $dt_operasi_jenis_o[$a]);
                $objPHPExcel->mergeCells('BL' . $dtl_row_o . ':BT' . $dtl_row_o)->setCellValue('BL' . $dtl_row_o, $dt_operasi_produk_o[$a]);
                $objPHPExcel->mergeCells('BU' . $dtl_row_o . ':BV' . $dtl_row_o)->setCellValue('BU' . $dtl_row_o, "M3 : ");
                $objPHPExcel->mergeCells('BW' . $dtl_row_o . ':BZ' . $dtl_row_o)->setCellValue('BW' . $dtl_row_o, $dt_operasi_jam_o[$a]);
                $objPHPExcel->mergeCells('CA' . $dtl_row_o . ':CE' . $dtl_row_o)->setCellValue('CA' . $dtl_row_o, $dt_operasi_satuan_o[$a]);

                $objPHPExcel->setSharedStyle($noborderStyle, 'BE' . ($dtl_row_o) . ':CE' . ($dtl_row_o));
                $objPHPExcel->setSharedStyle($noborderStyleAlignRight, 'BW' . ($dtl_row_o) . ':BZ' . ($dtl_row_o));
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'BE' . ($dtl_row_o) . ':BE' . ($dtl_row_o));
                $objPHPExcel->setSharedStyle($headerStyleRight, 'CE' . ($dtl_row_o) . ':CE' . ($dtl_row_o));

                $dtl_row_o++;
            }
            $objPHPExcel->mergeCells('BE' . ($dtl_row_o) . ':BK' . ($dtl_row_o))->setCellValue('BE' . ($dtl_row_o), "Total Produk");
            $objPHPExcel->mergeCells('BL' . ($dtl_row_o) . ':BT' . ($dtl_row_o))->setCellValue('BL' . ($dtl_row_o), $dtl_o_total_m3);
            $objPHPExcel->mergeCells('BU' . ($dtl_row_o) . ':BV' . ($dtl_row_o))->setCellValue('BU' . ($dtl_row_o), "M3 : ");
            $objPHPExcel->mergeCells('BW' . ($dtl_row_o) . ':BZ' . ($dtl_row_o))->setCellValue('BW' . ($dtl_row_o), $dtl_o_total_jam);
            $objPHPExcel->mergeCells('CA' . ($dtl_row_o) . ':CE' . ($dtl_row_o))->setCellValue('CA' . ($dtl_row_o), $dtl_o_total_satuan);

            $objPHPExcel->setSharedStyle($noborderStyleBold, 'BE' . ($dtl_row_o) . ':CE' . ($dtl_row_o));
            $objPHPExcel->setSharedStyle($noborderStyleAlignRight, 'BW' . ($dtl_row_o) . ':BZ' . ($dtl_row_o));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'BE' . ($dtl_row_o) . ':BE' . ($dtl_row_o));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'CE' . ($dtl_row_o) . ':CE' . ($dtl_row_o));
            //end table o

            //table p
            $start_detail = ($i1 * $jml_data_perpage_p);
            $finish_detail = (($i1 * $jml_data_perpage_p) + ($jml_data_perpage_p - 1));
            
            $objPHPExcel->mergeCells('BE' . ($dtl_row_o + 1) . ':CE' . ($dtl_row_o + 1))->setCellValue('BE' . ($dtl_row_o + 1), 'Outspec Analisa');
            $objPHPExcel->mergeCells('BE' . ( $dtl_row_o + 2) . ':BK' . ( $dtl_row_o + 2))->setCellValue('BE' . ( $dtl_row_o + 2), "");
            $objPHPExcel->mergeCells('BL' . ( $dtl_row_o + 2) . ':BP' . ( $dtl_row_o + 2))->setCellValue('BL' . ( $dtl_row_o + 2), "pH");
            $objPHPExcel->mergeCells('BQ' . ( $dtl_row_o + 2) . ':BU' . ( $dtl_row_o + 2))->setCellValue('BQ' . ( $dtl_row_o + 2), "Turbidity");
            $objPHPExcel->mergeCells('BV' . ( $dtl_row_o + 2) . ':BZ' . ( $dtl_row_o + 2))->setCellValue('BV' . ( $dtl_row_o + 2), "colour");
            $objPHPExcel->mergeCells('CA' . ( $dtl_row_o + 2) . ':CE' . ( $dtl_row_o + 2))->setCellValue('CA' . ( $dtl_row_o + 2), "Keterangan");
            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'BE' . ($dtl_row_o + 1) . ':CE' . ($dtl_row_o + 2));

            $dtl_row_p = $dtl_row_o + 3;

            for ($a = $start_detail; $a <= $finish_detail; $a++) {

                $objPHPExcel->getRowDimension($dtl_row_p)->setRowHeight(20);

                if (isset($item_p[$a])) {
                    $dt_item_p[$a] = $item_p[$a];
                } else {
                    $dt_item_p[$a] = "";
                }
                if (isset($ph_p[$a])) {
                    $dt_ph_p[$a] = $ph_p[$a];
                } else {
                    $dt_ph_p[$a] = "";
                }
                if (isset($turbidity_p[$a])) {
                    $dt_turbidity_p[$a] = $turbidity_p[$a];
                } else {
                    $dt_turbidity_p[$a] = "";
                }
                if (isset($colour_p[$a])) {
                    $dt_colour_p[$a] = $colour_p[$a];
                } else {
                    $dt_colour_p[$a] = "";
                }
                if (isset($ket_p[$a])) {
                    $dt_ket_p[$a] = $ket_p[$a];
                } else {
                    $dt_ket_p[$a] = "";
                }
            

                $objPHPExcel->mergeCells('BE' . $dtl_row_p . ':BK' . $dtl_row_p)->setCellValue('BE' . $dtl_row_p, $dt_item_p[$a]);
                $objPHPExcel->mergeCells('BL' . $dtl_row_p . ':BP' . $dtl_row_p)->setCellValue('BL' . $dtl_row_p, $dt_ph_p[$a]);
                $objPHPExcel->mergeCells('BQ' . $dtl_row_p . ':BU' . $dtl_row_p)->setCellValue('BQ' . $dtl_row_p, $dt_turbidity_p[$a]);
                $objPHPExcel->mergeCells('BV' . $dtl_row_p . ':BZ' . $dtl_row_p)->setCellValue('BV' . $dtl_row_p, $dt_colour_p[$a]);
                $objPHPExcel->mergeCells('CA' . $dtl_row_p . ':CE' . $dtl_row_p)->setCellValue('CA' . $dtl_row_p, $dt_ket_p[$a]);

                $objPHPExcel->setSharedStyle($bodyStyle, 'BE' . $dtl_row_p . ':CE' . $dtl_row_p);
                $objPHPExcel->setSharedStyle($headerStyleRight, 'CE' . ($dtl_row_p + 1) . ':CE' . ($total_row));
                $objPHPExcel->setSharedStyle($headerStyleRight, 'CE' . ($dtl_row_p + 1) . ':CE' . ($dtl_row_p + 2));
                $objPHPExcel->setSharedStyle($bodyStyleLeft, 'BE' . ($dtl_row_p + 1) . ':BE' . ($dtl_row_p + 2));
                $dtl_row_p++;
            }
            $objPHPExcel->mergeCells('BE' . ($dtl_row_p ) . ':CE' . ($dtl_row_p ))->setCellValue('BE' . ($dtl_row_p ), '');
            //end table p

            //DEFINISI 
            $objPHPExcel->setSharedStyle($noborderStyle, 'BE' . ($dtl_row_p) . ':CD' . ($dtl_row_p + 9));
            $objPHPExcel->setSharedStyle($noborderStyleUnderline, 'BE' . ($dtl_row_p + 1) . ':BK' . ($dtl_row_p + 1));
            $objPHPExcel->mergeCells('BE' . ( $dtl_row_p + 1) . ':BK' . ( $dtl_row_p + 1))->setCellValue('BE' . ( $dtl_row_p + 1), "Definisi :");
            $objPHPExcel->mergeCells('BE' . ( $dtl_row_p + 2) . ':BK' . ( $dtl_row_p + 2))->setCellValue('BE' . ( $dtl_row_p + 2), "RO");
            $objPHPExcel->mergeCells('BE' . ( $dtl_row_p + 3) . ':BK' . ( $dtl_row_p + 3))->setCellValue('BE' . ( $dtl_row_p + 3), "ACF ");
            $objPHPExcel->mergeCells('BE' . ( $dtl_row_p + 4) . ':BK' . ( $dtl_row_p + 4))->setCellValue('BE' . ( $dtl_row_p + 4), "MC ");
            
            $objPHPExcel->mergeCells('BQ' . ( $dtl_row_p + 2) . ':BW' . ( $dtl_row_p + 2))->setCellValue('BQ' . ( $dtl_row_p + 2), "M3 ");
            $objPHPExcel->mergeCells('BQ' . ( $dtl_row_p + 3) . ':BW' . ( $dtl_row_p + 3))->setCellValue('BQ' . ( $dtl_row_p + 3), "Eff ");
            $objPHPExcel->mergeCells('BQ' . ( $dtl_row_p + 4) . ':BW' . ( $dtl_row_p + 4))->setCellValue('BQ' . ( $dtl_row_p + 4), "RW ");

            $objPHPExcel->mergeCells('BL' . ( $dtl_row_p + 2) . ':BP' . ( $dtl_row_p + 2))->setCellValue('BL' . ( $dtl_row_p + 2), ": Reverse Osmosis");
            $objPHPExcel->mergeCells('BL' . ( $dtl_row_p + 3) . ':BP' . ( $dtl_row_p + 3))->setCellValue('BL' . ( $dtl_row_p + 3), ": After carbon Filter ");
            $objPHPExcel->mergeCells('BL' . ( $dtl_row_p + 4) . ':BP' . ( $dtl_row_p + 4))->setCellValue('BL' . ( $dtl_row_p + 4), ": Membran cleaner ");
            
            $objPHPExcel->mergeCells('BX' . ( $dtl_row_p + 2) . ':CE' . ( $dtl_row_p + 2))->setCellValue('BX' . ( $dtl_row_p + 2), ": Meter Kubik ");
            $objPHPExcel->mergeCells('BX' . ( $dtl_row_p + 3) . ':CE' . ( $dtl_row_p + 3))->setCellValue('BX' . ( $dtl_row_p + 3), ": Effisiensi ");
            $objPHPExcel->mergeCells('BX' . ( $dtl_row_p + 4) . ':CE' . ( $dtl_row_p + 4))->setCellValue('BX' . ( $dtl_row_p + 4), ": Raw Water ");
        
            $app_row = $dtl_row_a - 6;

            $objPHPExcel->mergeCells('AK' . ($app_row) . ':AY' . ($app_row))->setCellValue('AK' . ($app_row), 'Dibuat Oleh,');
            $objPHPExcel->mergeCells('AZ' . ($app_row) . ':BO' . ($app_row))->setCellValue('AZ' . ($app_row), 'Diketahui Oleh,');
            $objPHPExcel->mergeCells('BP' . ($app_row) . ':CE' . ($app_row))->setCellValue('BP' . ($app_row), 'Disetujui Oleh,');

            $objPHPExcel->mergeCells('AK' . ($app_row + 1) . ':AY' . ($app_row + 3))->setCellValue('AK' . ($app_row + 1), '');
            $objPHPExcel->mergeCells('AZ' . ($app_row + 1) . ':BO' . ($app_row + 3))->setCellValue('AZ' . ($app_row + 1), '');
            $objPHPExcel->mergeCells('BP' . ($app_row + 1) . ':CE' . ($app_row + 3))->setCellValue('BP' . ($app_row + 1), '');

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'AK' . ($app_row) . ':CE' . ($app_row + 3));


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
                    $sign_img->setCoordinates('AO' . ($app_row + 1));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp1 . $app1_personalid . $imageformatapp1);
                    $sign_img->setWidthAndHeight(135, 135);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AO' . ($app_row + 1));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('AO' . ($app_row + 1));
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
                    $sign_img2->setCoordinates('BE' . ($app_row + 1));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(135, 135);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('BE' . ($app_row + 1));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('BE' . ($app_row + 1));
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
                    $sign_img3->setCoordinates('BU' . ($app_row + 1));
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                    $sign_img3->setWidthAndHeight(135, 135);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('BU' . ($app_row + 1));
                }
                else{
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(105, 105);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('BU' . ($app_row + 1));
                }
            }


            $objPHPExcel->mergeCells('AK' . ($app_row + 4) . ':AN' . ($app_row + 4))->setCellValue('AK' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('AO' . ($app_row + 4) . ':AY' . ($app_row + 4))->setCellValue('AO' . ($app_row + 4), ': ' . $app1_by);
            $objPHPExcel->mergeCells('AK' . ($app_row + 5) . ':AN' . ($app_row + 5))->setCellValue('AK' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('AO' . ($app_row + 5) . ':AY' . ($app_row + 5))->setCellValue('AO' . ($app_row + 5), ': ' . $app1_position);
            $objPHPExcel->mergeCells('AK' . ($app_row + 6) . ':AN' . ($app_row + 6))->setCellValue('AK' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('AO' . ($app_row + 6) . ':AY' . ($app_row + 6))->setCellValue('AO' . ($app_row + 6), ': ' . $app1date);

            $objPHPExcel->mergeCells('AZ' . ($app_row + 4) . ':BC' . ($app_row + 4))->setCellValue('AZ' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('BD' . ($app_row + 4) . ':BO' . ($app_row + 4))->setCellValue('BD' . ($app_row + 4), ': ' . $app2_by);
            $objPHPExcel->mergeCells('AZ' . ($app_row + 5) . ':BC' . ($app_row + 5))->setCellValue('AZ' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('BD' . ($app_row + 5) . ':BO' . ($app_row + 5))->setCellValue('BD' . ($app_row + 5), ': ' . $app2_position);
            $objPHPExcel->mergeCells('AZ' . ($app_row + 6) . ':BC' . ($app_row + 6))->setCellValue('AZ' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('BD' . ($app_row + 6) . ':BO' . ($app_row + 6))->setCellValue('BD' . ($app_row + 6), ': ' . $app2date);
           
            $objPHPExcel->mergeCells('BP' . ($app_row + 4) . ':BS' . ($app_row + 4))->setCellValue('BP' . ($app_row + 4), 'Nama');
            $objPHPExcel->mergeCells('BT' . ($app_row + 4) . ':CE' . ($app_row + 4))->setCellValue('BT' . ($app_row + 4), ': ' . $app3_by);
            $objPHPExcel->mergeCells('BP' . ($app_row + 5) . ':BS' . ($app_row + 5))->setCellValue('BP' . ($app_row + 5), 'Jabatan');
            $objPHPExcel->mergeCells('BT' . ($app_row + 5) . ':CE' . ($app_row + 5))->setCellValue('BT' . ($app_row + 5), ': ' . $app3_position);
            $objPHPExcel->mergeCells('BP' . ($app_row + 6) . ':BS' . ($app_row + 6))->setCellValue('BP' . ($app_row + 6), 'Tanggal');
            $objPHPExcel->mergeCells('BT' . ($app_row + 6) . ':CE' . ($app_row + 6))->setCellValue('BT' . ($app_row + 6), ': ' . $app3date);

            $objPHPExcel->setSharedStyle($noborderStyle, 'AK' . ($app_row + 4) . ':CE' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AK' . ($app_row + 4) . ':AK' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AZ' . ($app_row + 4) . ':AZ' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($bodyStyleLeft, 'BP' . ($app_row + 4) . ':BP' . ($app_row + 6));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'CE' . ($app_row + 4) . ':CE' . ($app_row + 6));

            // $objPHPExcel->getStyle('AK' . ($app_row + 7) . ':CE' . ($app_row + 9))->getFont()->setBold(true);
            // $objPHPExcel->setSharedStyle($bodyStyleRight, 'CF' . ($app_row + 7) . ':CF' . ($app_row + 9));
            // $objPHPExcel->setSharedStyle($bodyStyleLeft, 'AK' . ($app_row + 7) . ':AK' . ($app_row + 9));

            $start_row3 = $app_row + 6;
            $objPHPExcel->mergeCells('A' . ($start_row3 + 1) . ':BE' . ($start_row3 + 1))->setCellValue('A' . ($start_row3 + 1), 'Mulai Berlaku ' . $this->frmefective);
            $objPHPExcel->getStyle('A' . ($start_row3 + 1) . ':BE' . ($start_row3 + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('BF' . ($start_row3 + 1) . ':CF' . ($start_row3 + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('BF' . ($start_row3 + 1) . ':CF' . ($start_row3 + 1))->setCellValue('BF' . ($start_row3 + 1), $this->frmnm . '-' . $this->frmver);
            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A' . ($start_row3 + 1) . ':BE' . ($start_row3 + 1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'BF' . ($start_row3 + 1) . ':CF' . ($start_row3 + 1));
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
