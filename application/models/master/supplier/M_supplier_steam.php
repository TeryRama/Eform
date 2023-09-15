<?php

class M_supplier_steam extends CI_Model {
		
	var $tabel1 = 'tblmst_supplier_steam';

	function __construct(){			
		parent :: __construct();
		$CI 		= &get_instance();
		$this->db1 	= $this->load->database('db1',TRUE);
	}
		
    function get_records(){
        return $this->db1->query("select * from $this->tabel1 where inactive='0' order by tgl_efektif desc")->result();
    }

    function get_records_by($headerid){
        return $this->db1->query("select * from $this->tabel1 a where a.inactive='0' and a.headerid='$headerid'")->result();
    }

    function get_list_form(){
        return $this->db1->query("select distinct formnm from vwmst_form")->result();
    }

    function cek_header($mdl1_dept_steam, $mdl1_tgl_efektif){
        $this->db1->from($this->tabel1);
        $this->db1->where('dept_steam', $mdl1_dept_steam);
        $this->db1->where('tgl_efektif', $mdl1_tgl_efektif);
        return $this->db1->get();
    }

    function cek_header2($mdl1_dept_steam, $mdl1_tgl_efektif, $mdl1_headerid){
        $this->db1->from($this->tabel1);
        $this->db1->where('dept_steam', $mdl1_dept_steam);
        $this->db1->where('tgl_efektif', $mdl1_tgl_efektif);
        $this->db1->where('headerid !=', $mdl1_headerid);
        return $this->db1->get();
    }
		
	function insert_hdr($data){
		$query = $this->db1->insert($this->tabel1, $data);
		return TRUE;
	}

    function update_hdr($headerid, $data){
        $this->db1->where('headerid', $headerid);
        $this->db1->update($this->tabel1, $data);
        return TRUE;
    }

}
