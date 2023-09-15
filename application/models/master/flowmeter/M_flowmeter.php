<?php

class M_flowmeter extends CI_Model {
		
	var $tabel1 = 'tblmst_flowmeter';
	var $tabel2 = 'tblmst_area';

	function __construct(){			
		parent :: __construct();
		$CI 		= &get_instance();
		$this->db1 	= $this->load->database('db1',TRUE);
	}

    function get_records_payroll(){
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_departemen_byakses"));
    }
		
    function get_records(){
        return $this->db1->query("select 
                                    a.* ,
                                    b.air
                                from 
                                    $this->tabel1 a 
                                join 
                                    tblmst_air b 
                                        on a.id_jenis_air=b.headerid
                                where 
                                    a.inactive='0' 
                                    and b.inactive='0' 
                                order by
                                    b.headerid,
                                    a.nama_dept,
                                    a.nama_flow")->result();
    }

    function dept_lainnya()
    {
        return $this->db1->query("select * from $this->tabel2 where inactive='0'")->result();
    }

    function get_records_by($headerid){
        return $this->db1->query("select * from $this->tabel1 where inactive='0' and headerid='$headerid'")->result();
    }

    function get_list_air(){
        return $this->db1->query("select 
                                    * 
                                from 
                                    tblmst_air
                                where
                                    inactive='0'
                                    and tgl_efektif<=now()::date 
                                order by 
                                    air")->result();
    }


    function cek_header($mdl1_id_dept, $mdl1_id_jenis_air, $mdl1_nama_flow, $mdl1_tgl_efektif){
        $this->db1->from($this->tabel1);
        $this->db1->where('id_dept', $mdl1_id_dept);
        $this->db1->where('id_jenis_air', $mdl1_id_jenis_air);
        $this->db1->where('nama_flow', $mdl1_nama_flow);
        $this->db1->where('tgl_efektif', $mdl1_tgl_efektif);
        return $this->db1->get();
    }

    function cek_header2($mdl1_id_dept, $mdl1_id_jenis_air, $mdl1_nama_flow, $mdl1_tgl_efektif, $mdl1_headerid){
        $this->db1->from($this->tabel1);
        $this->db1->where('id_dept', $mdl1_id_dept);
        $this->db1->where('id_jenis_air', $mdl1_id_jenis_air);
        $this->db1->where('nama_flow', $mdl1_nama_flow);
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

} ?>