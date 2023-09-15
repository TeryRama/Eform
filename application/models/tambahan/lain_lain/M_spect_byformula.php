<?php

class M_spect_byformula extends CI_Model {

    function __construct() {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

    function get_all_spect_byformula($spec_tipe_contoh, $spec_jenis_produk,$spec_formula, $frmkode, $val_date){
	    switch ($frmkode){
	        case $frmkode == "frmehs037":
	            $item_parameter = "tanggal";
	        break; 
	        default:
	            $item_parameter = "create_date";
	        break;
	    }

	    $query=$this->db1->query("select a.headerid, a.formula, b.* from tblmst_productspec_hdr as a join tblmst_productspec_dtl as b on a.headerid=b.detail_id where a.tipe_contoh='$spec_tipe_contoh' and a.jenis_produk='$spec_jenis_produk' and formula='$spec_formula'");
        if ($query->num_rows()>0) {
                return $query->result();
        }
    }            

}