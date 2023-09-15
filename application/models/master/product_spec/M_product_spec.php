<?php

class M_product_spec extends CI_Model {
		
	var $tabel1 = 'tblmst_productspec_hdr';
	var $tabel2 = 'tblmst_productspec_dtl';

	function __construct(){			
		parent :: __construct();
		$CI 		= &get_instance();
		$this->db1 	= $this->load->database('db1',TRUE);
	}
		
    function get_records(){
        return $this->db1->query("select * from $this->tabel1 order by headerid asc")->result();
    }

    function get_records_by($headerid){
        return $this->db1->query("select * from $this->tabel1 a where a.headerid='$headerid' order by a.headerid")->result();
    }

    function get_records_dtl_by($headerid){
        return $this->db1->query("select * from $this->tabel2 a where a.headerid='$headerid' order by a.detail_id")->result();
    }


         function get_dt_formktgr($leveluser){
            $query = $this->db1->query("select formjnsnm FROM vwmst_form WHERE formjnsid in (SELECT DISTINCT formjnsid from tblmstform_akses2 where leveluserid=" .$leveluser. ") group by formjnsnm");
            if($query->num_rows()>0){
                return $query->result();
            }else{
                return array();
            }
         }

         function get_dt_formjnsnm($formjnsnm){
            $query = $this->db1->query("select DISTINCT (formkd), formnm FROM vwmst_form WHERE formjnsnm='$formjnsnm' group by formkd, formnm");
            if($query->num_rows()>0){
                return $query->result();
            }else{
                return array();
            }
         }

         function get_dt_formversi($formkd){
            $query = $this->db1->query("select DISTINCT (formversi) FROM vwmst_form WHERE formkd='$formkd' group by formversi");
            if($query->num_rows()>0){
                return $query->result();
            }else{
                return array();
            }
         }
    function get_list_form(){
        return $this->db1->query("select distinct formnm from vwmst_form")->result();
    }

    function cek_header($mdl_dtbagian,$mdl_dtform_kode,$mdl_dtversi_form, $mdl_tgl_start, $mdl_tgl_finish){
        $this->db1->from($this->tabel1);
        $this->db1->where('bagian', $mdl_dtbagian);
        $this->db1->where('form_kode', $mdl_dtform_kode);
        $this->db1->where('form_versi', $mdl_dtversi_form);
        $this->db1->where('tgl_start', $mdl_tgl_start);
        $this->db1->where('tgl_finish', $mdl_tgl_finish);
        return $this->db1->get();
    }

    function cek_header2($mdl_dtbagian,$mdl_dtform_kode,$mdl_dtversi_form, $mdl_tgl_start, $mdl_tgl_finish, $mdl_headerid){
        $this->db1->from($this->tabel1);
        $this->db1->where('bagian', $mdl_dtbagian);
        $this->db1->where('form_kode', $mdl_dtform_kode);
        $this->db1->where('form_versi', $mdl_dtversi_form);
        $this->db1->where('tgl_start', $mdl_tgl_start);
        $this->db1->where('tgl_finish', $mdl_tgl_finish);
        $this->db1->where('headerid !=', $mdl_headerid);
        return $this->db1->get();
    }
		
	function insert_hdr($data){
		$query = $this->db1->insert($this->tabel1, $data);
		return TRUE;
	}

    function insert_dtl($data_detail){
        $this->db1->trans_begin();
            $query=$this->db1->insert($this->tabel2, $data_detail);
                if ($this->db1->trans_status() == FALSE) {
                    $this->db1->trans_rollback();
                    $result = 0;
                } else {
                        $this->db1->trans_commit();
                        $result = 1;
                }

            return $result;
            return TRUE;
    }
    
    function update_hdr($headerid, $data){
        $this->db1->where('headerid', $headerid);
        $this->db1->update($this->tabel1, $data);
        return TRUE;
    }
    function update_dtl($datadetail,$data_detail){
            $this->db1->trans_begin();
            $this->db1->set($data_detail);
            $this->db1->where('detail_id', $datadetail);
            $this->db1->update($this->tabel2, $data_detail);
            if ($this->db1->trans_status() == FALSE) {
                    $this->db1->trans_rollback();
                    $result = 0;
                } else {
                        $this->db1->trans_commit();
                        $result = 1;
                }

            return $result;
            return TRUE;            
    }
    
    function delete_detail($headerid){
        $this->db1->trans_begin();
        $this->db1->delete($this->tabel2, "headerid = '$headerid'");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $detail_result = 0;
        } else {
            $this->db1->trans_commit();
            $detail_result = 1;
        }

            return $detail_result;
    }

    function delete_header($headerid){
        $this->db1->trans_begin();
        $this->db1->delete($this->tabel1, "headerid = '$headerid'");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $header_result = 0;
        } else {
            $this->db1->trans_commit();
            $header_result = 1;
        }

            return $header_result;
    }
    function modal_delete_detail($modal_detail_id) {
        $query1 = $this->db1->delete($this->tabel2, "detail_id = '$modal_detail_id'");
        return $query1;
    }
} ?>