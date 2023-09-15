<?php

class M_ncr extends CI_Model {

    function __construct() {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

    function get_spec_byformula($spec_date,$spec_form_kode,$spec_form_versi,$spec_bagian, $spec_tipe_contoh, $spec_jenis_produk, $formula){

    	if(trim($spec_form_kode)!=''){$con_form_kode="and form_kode='$spec_form_kode'";}else{$con_form_kode="and form_kode is null";}
    	if(trim($spec_form_versi)!=''){$con_form_versi="and form_versi='$spec_form_versi'";}else{$con_form_versi="and form_versi is null";}
    	if(trim($spec_bagian)!=''){$con_bagian="and bagian='$spec_bagian'";}else{$con_bagian="and bagian is null";}
    	if(trim($spec_tipe_contoh)!=''){$con_tipe_contoh="and tipe_contoh='$spec_tipe_contoh'";}else{$con_tipe_contoh="and tipe_contoh is null";}
    	if(trim($spec_jenis_produk)!=''){$con_jenis_produk="and jenis_produk='$spec_jenis_produk'";}else{$con_jenis_produk="and jenis_produk is null";}
    	if(trim($spec_formula)!=''){$con_formula="and formula='$spec_formula'";}else{$con_formula="and formula is null";}

    	$query = $this->db1->query("select a.headerid, a.formula, b.* from tblmst_productspec_hdr as a join tblmst_productspec_dtl as b on a.headerid=b.headerid where a.headerid in (select max(headerid) as spec_headerid from tblmst_productspec_hdr where tgl_start<='$spec_date' $con_form_kode $con_form_versi $con_bagian $con_tipe_contoh $con_jenis_produk $con_formula ) and b.status_analisa ='Active'");
    	return $query->result();
    }

}