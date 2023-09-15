<?php

class M_supplier extends CI_Model {
		
	var $tabel1 = 'tblmst_supplier';
	var $tabel2 = 'tblmst_supplierdtl';

	function __construct(){			
		parent :: __construct();
		$CI 		= &get_instance();
		$this->db1 	= $this->load->database('db1',TRUE);
	}
		
    function get_records(){
        return $this->db1->query("select 
                                    * 
                                from 
                                    $this->tabel1
                                where 
                                    inactive='0' 
                                order by 
                                    tgl_efektif desc")->result();
    }

	function get_records_dtl($headerid){
        return $this->db1->query("select 
                                    * 
                                from 
                                    $this->tabel1 a 
                                join 
                                    $this->tabel2 b 
                                        on a.headerid=b.headerid 
                                where 
                                    a.inactive='0' 
                                    and b.inactive='0' 
                                    and a.headerid='$headerid' 
                                order by 
                                    1")->result();
	}

    function get_list_flow_meter(){
        return $this->db1->query("select 
                                    a.* ,
                                    b.air
                                from 
                                    tblmst_flowmeter a 
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

    function cek_header($mdl1_tgl_efektif){
        $this->db1->from($this->tabel1);
        $this->db1->where('tgl_efektif', $mdl1_tgl_efektif);
        return $this->db1->get();
    }

    function cek_header2($mdl1_tgl_efektif, $mdl1_headerid){
        $this->db1->from($this->tabel1);
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
		
	function insert_dtl($data){
		$query = $this->db1->insert($this->tabel2, $data);
		return TRUE;
	}

    function update_dtl($detail_id, $data){
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel2, $data);
        return TRUE;
    }

} ?>