<?php

class M_penanggung_jawab extends CI_Model {
		
	var $tabel1 = 'tblmst_penanggung_jawab';
	var $tabel2 = 'tblmst_penanggung_jawab_dtl';

	function __construct(){			
		parent :: __construct();
		$CI 		= &get_instance();
		$this->db1 	= $this->load->database('db1',TRUE);
	}
		
    function get_records(){
        return $this->db1->query("select * from $this->tabel1 where inactive='0' order by tgl_efektif desc")->result();
    }

	function get_records_dtl($headerid){
        return $this->db1->query("select * from $this->tabel1 a join $this->tabel2 b on a.headerid=b.headerid where a.inactive='0' and b.inactive='0' and a.headerid='$headerid' order by b.nama")->result();
	}

    function get_list_form(){
        return $this->db1->query("select distinct formnm from vwmst_form")->result();
    }

    function get_pekerja_allinfo($personalstatus, $nik){
        $datapost = array(
            'personalstatus' => $personalstatus,
            'nik'            => $nik,
        );
        return json_decode($this->curl->simple_post(setAPI()."p1_pekerja_aktif_allinfo", $datapost,array(CURLOPT_BUFFERSIZE => 10)));
    }

    function cek_header($mdl1_form_kode, $mdl1_tgl_efektif){
        $this->db1->from($this->tabel1);
        $this->db1->where('form_kode', $mdl1_form_kode);
        $this->db1->where('tgl_efektif', $mdl1_tgl_efektif);
        return $this->db1->get();
    }

    function cek_header2($mdl1_form_kode, $mdl1_tgl_efektif, $mdl1_headerid){
        $this->db1->from($this->tabel1);
        $this->db1->where('form_kode', $mdl1_form_kode);
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