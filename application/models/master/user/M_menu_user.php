<?php

	class M_menu_user extends CI_Model {

	var $tabel = 'tblmst_user';

	function __construct(){
		parent :: __construct();
	}

	function get_allrecords(){
        $q  = json_decode($this->curl->simple_get(setAPI2() . "p1psg_all_personal_aktif"));
        $q2 = json_decode($this->curl->simple_get(setAPI2() . "p1psg_all_onelogin_aktif"));
        return $this->db->query("with
                                    tblpekerja as (
                                        select
                                        	(elem->>'personalstatus')::text tblpekerja_personalstatus,
                                        	(elem->>'personalid')::text tblpekerja_personalid,
                                        	(elem->>'vpersonalstatus')::text tblpekerja_vpersonalstatus,
                                        	(elem->>'nik')::text tblpekerja_nik,
                                        	(elem->>'id_company')::text tblpekerja_id_company,
                                        	(elem->>'company')::text tblpekerja_company,
                                        	(elem->>'company_branch')::text tblpekerja_company_branch,
                                        	(elem->>'company_abbr')::text tblpekerja_company_abbr,
                                        	(elem->>'cv_abbr')::text tblpekerja_cv_abbr,
                                        	(elem->>'id_divisi')::text tblpekerja_id_divisi,
                                        	(elem->>'divisi_abbr')::text tblpekerja_divisi_abbr,
                                        	(elem->>'divisi_nama')::text tblpekerja_divisi_nama,
                                        	(elem->>'id_dept')::text tblpekerja_id_dept,
                                        	(elem->>'dept_abbr')::text tblpekerja_dept_abbr,
                                        	(elem->>'dept_nama')::text tblpekerja_dept_nama,
                                        	(elem->>'id_bagian')::text tblpekerja_id_bagian,
                                        	(elem->>'bagian_abbr')::text tblpekerja_bagian_abbr,
                                        	(elem->>'bagian_nama')::text tblpekerja_bagian_nama,
                                        	(elem->>'id_jabatan')::text tblpekerja_id_jabatan,
                                        	(elem->>'jabatan_nama')::text tblpekerja_jabatan_nama
                                        from
                                        	json_array_elements('" . json_encode($q) . "') elem),

                                    tblonelogin as (
                                        select
                                        	(elem2->>'personalstatus')::text tblonelogin_personalstatus,
                                        	(elem2->>'personalid')::text tblonelogin_personalid
                                        from
                                        	json_array_elements('" . json_encode($q2) . "') elem2),

                                    tbluser as (select * from view_data_user where inactive='0')

                                    select
                                        *
                                    from
                                        view_data_user a
                                    left join
                                        tblpekerja b
                                        on a.personalstatus::text=b.tblpekerja_personalstatus
                                        and a.personalid::text=b.tblpekerja_personalid
                                    left join
                                        tblonelogin c
                                        on a.personalstatus::text=c.tblonelogin_personalstatus
                                        and a.personalid::text=c.tblonelogin_personalid
                                    where
                                    	a.inactive='0'
                                    order by
                                        nmlengkap")->result();
    }

	function get_user_byid($id){
        $this->db->from('view_data_user');
        $this->db->where('userid', $id);
        $this->db->order_by("nmlengkap", "asc");
        $query = $this->db->get();
        if ($query->num_rows() == 1){
            return $query->result();
        }
    }

    function update_user($id, $data){
        $this->db->where('userid', $id);
        $this->db->update($this->tabel, $data);
        return TRUE;
    }

	function insert($data){
		$query = $this->db->insert('tblmst_user', $data);
		return TRUE;
	}

	function update_by_id($data, $id){
		$this->db->where("userid = '$id'");
		$query = $this->db->update('tblmst_user', $data);
		return $query;
	}

	function delete_by_id($id){
		$query = $this->db->delete('tblmst_user', "userid = '$id'");
		return $query;
	}

	function cek_username($username){
		$this->db->from('tblmst_user');
        $this->db->where('username', $username);
        $this->db->where('inactive', '0');
        $query = $this->db->get();
        return $query;
	}

	function cek_username2($username,$kode){
		$this->db->from('tblmst_user');
        $this->db->where('username', $username);
        $this->db->where('inactive', '0');
        $this->db->where('userid !=', $kode);
        $query = $this->db->get();
        return $query;
	}

	// function get_allrecords(){
	// 	$this->db->select('*');
	// 	$this->db->from('view_data_user');
	// 	$this->db->where('inactive','0');
	// 	$this->db->order_by("nmlengkap", "asc");
	// 	$query = $this->db->get();
	// 	return $query;
	// }

    function get_all_dttamu_onelogin(){
        return json_decode($this->curl->simple_get(setAPI2()."get_alluserOL_tamu"));
    }

    function get_dept_by($id_company, $id_divisi){
		return json_decode($this->curl->simple_get(setAPI()."p1_get_select_departemen/".$id_company."/".$id_divisi));
	}

    function get_bag_by($id_company, $id_divisi, $id_dept){
		return json_decode($this->curl->simple_get(setAPI()."p1_get_select_bagian/".$id_company."/".$id_divisi. "/".$id_dept));
	}

    function get_jab_by($id_company, $id_divisi, $id_dept, $id_bagian){
		return json_decode($this->curl->simple_get(setAPI()."p1_get_select_jabatan/".$id_dept));
	}

	function get_alldepartemen()
    {
        return json_decode($this->curl->simple_get(setAPI() . "p1_get_all_departemen"));
    }

    function get_allbagian()
    {
        return json_decode($this->curl->simple_get(setAPI() . "p1_get_all_bagian"));
    }

    function get_alljabatan()
    {
        return json_decode($this->curl->simple_get(setAPI() . "p1_get_all_jabatan"));
    }

    function get_allleveluser(){
        $query = $this->db->query("select
        							*
	        					from
	        						tblmst_leveluser
	        					where
	        						levelusernm not like 'Auditor %'
	        					order by
	        						levelusernm");
        return $query->result();
    }

    function get_leveluser_by($bagian_abbr){
        $query = $this->db->query("select
        							*
	        					from
	        						tblmst_leveluser
	        					where
	        						levelusernm not like 'Auditor %'
	        					and bagian_akses like '%$bagian_abbr%'
	        					order by
	        						levelusernm");
        return $query->result();
    }

    function get_leveluser_by_ITD(){
        $query = $this->db->query("select
        							*
	        					from
	        						tblmst_leveluser
	        					where
	        						levelusernm not like 'Auditor %'
	        					order by
	        						levelusernm");
        return $query->result();
    }

    function get_personalkar($datapost){
        return json_decode($this->curl->simple_post(setAPI2()."get_bynik_karyawan",$datapost,array(CURLOPT_BUFFERSIZE => 10)));
    }

    function get_personaltk($datapost){
        return json_decode($this->curl->simple_post(setAPI2()."get_bynik_tkerja",$datapost,array(CURLOPT_BUFFERSIZE => 10)));
    }


	function get_personaltoptamu($id){
		return json_decode($this->curl->simple_get(setAPI2() . "get_userOL_tamu/{$id}"));
	}

    function get_allstatus_user($personalid, $personalstatus){
		$datapost       = array(
			'personalid'     => $personalid,
			'personalstatus' => $personalstatus
		);

		// cek status personal aktif
		$q2 = json_decode($this->curl->simple_post(setAPI2()."get_byno_personal", $datapost, array(CURLOPT_BUFFERSIZE => 10)));

		// cek status akun onelogin
		$q3 = json_decode($this->curl->simple_post(setAPI2()."get_byno_onelogin", $datapost, array(CURLOPT_BUFFERSIZE => 10)));

		return array(
			'q2' => $q2,
			'q3' => $q3
		);
	}

} ?>