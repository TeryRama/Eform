<?php
class M_formmenu extends CI_Model {
	function __construct(){
		parent:: __construct();
		$CI = &get_instance();
		$this->db1= $this->load->database('db1',TRUE);
	}
		
    function get_records() {
            $query = $this->db1->query('select * from vwmst_form order by formnm asc');
            return $query;
    }

    function get_records_by($id){
        $query = $this->db1->query("select * from vwmst_form where formid='$id'");
        return $query;
    }
		
    function search_form($formkd, $formket)
    {
        $query = $this->db1->query("select * from vwmst_form where formkd='$formkd' and formket='Complete' and formstatus='0' ORDER BY formid DESC LIMIT 1");
        return $query->row();
    }				
	function insert($data) {
    	$query=$this->db1->insert('tblmstformnew', $data);
    	return $query;
	}
	
    function insert_formakses($bef_formid,$new_formid)
    {
        $q_leveluserid = $this->db1->query("SELECT
                                            string_agg(leveluserid::text, ', ') AS leveluserid 
                                        FROM
                                            tblmstform_akses2 
                                        WHERE
                                            formid = '$new_formid'")->row();

        $arr_leveuserid = explode(',', $q_leveluserid->leveluserid);
        $str_arr_leveuserid = "'".implode("','",$arr_leveuserid)."'";
        return $this->db1->query("INSERT INTO 
                                        tblmstform_akses2 
                                    SELECT
                                        leveluserid,
                                        '$new_formid',
                                        formjnsid,
                                        formkategoriid,
                                        formkategori2id,
                                        form_create,
                                        form_update,
                                        form_delete,
                                        form_excel
                                    FROM
                                        tblmstform_akses2 
                                    WHERE
                                        formid = '$bef_formid'
                                        and leveluserid not in ($str_arr_leveuserid)");
    }

    function insert_appakses($bef_formid,$new_formid)
    {
        $q_leveluserid = $this->db1->query("SELECT
                                            string_agg(leveluserid::text, ', ') AS leveluserid 
                                        FROM
                                            tblmstapproval_akses2 
                                        WHERE
                                            formid = '$new_formid'")->row();

        $arr_leveuserid = explode(',', $q_leveluserid->leveluserid);
        $str_arr_leveuserid = "'".implode("','",$arr_leveuserid)."'";
        return $this->db1->query("INSERT INTO 
                                        tblmstapproval_akses2 
                                    SELECT
                                        appid,
                                        leveluserid,
                                        '$new_formid',
                                        app1,
                                        app2,
                                        app3,
                                        app4,
                                        app5,
                                        app6,
                                        app7,
                                        app8,
                                        app9,
                                        app10,
                                        formjnsid,
                                        formkategoriid,
                                        formkategori2id,
                                        app_ket
                                    FROM
                                        tblmstapproval_akses2 
                                    WHERE
                                        formid = '$bef_formid'
                                        and leveluserid not in ($str_arr_leveuserid)");
    }

    function insert_revisi_formakses_admin_by($bef_formid,$new_formid)
    {
        
        $query = $this->db1->query("INSERT INTO 
                                        tblmstform_akses2 
                                    SELECT
                                        leveluserid,
                                        '$new_formid',
                                        formjnsid,
                                        formkategoriid,
                                        formkategori2id,
                                        form_create,
                                        form_update,
                                        form_delete,
                                        form_excel
                                    FROM
                                        tblmstform_akses2 
                                    WHERE
                                        formid = '$bef_formid' and leveluserid = '619'");
        return $query;
    }

    function insert_new_formakses_admin_by($new_formid, $formjnsid, $frm_kate, $frm_kate2)
    {
        $new_formjnsid = $formjnsid == '' ? 'NULL' : "'".$formjnsid."'";
        $new_frm_kate = $frm_kate == '' ? 'NULL' : "'".$frm_kate."'";
        $new_frm_kate2 = $frm_kate2 == '' ? 'NULL' : "'".$frm_kate2."'";

        $query = $this->db1->query("INSERT INTO 
                                        tblmstform_akses2 
                                    SELECT
                                        leveluserid,
                                        '$new_formid',
                                        $new_formjnsid,
                                        $new_frm_kate,
                                        $new_frm_kate2,
                                        form_create,
                                        form_update,
                                        form_delete,
                                        form_excel
                                    FROM
                                        tblmstform_akses2 
                                    WHERE
                                        leveluserid = '619'
                                    LIMIT 1");
        return $query;
    }		
	function update_by_id($data, $formid){
		$this->db1->where("formid ='$formid'");
		$query= $this->db1->update('tblmstformnew', $data);
		return $query;
	}
					
	function delete_by_id($id){
    	$query = $this->db1->delete('tblmstformnew',"formid ='$id'");
    	return $query;
	}

    function getAllJnsid(){
        $query = $this->db1->query('SELECT DISTINCT (submenunm), submenuid  from tblmstsubmenu where menuid=2');
        return $query->result();
    }

    function getFormKat($fjnsid){
        $result = $this->db1->query("SELECT DISTINCT (submenu2nm), submenu2id  from tblmstsubmenu2 where submenuid='$fjnsid'");
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return array();
        }
    }

    function getFormKat2($formkategoriid){
        $result = $this->db1->query("SELECT DISTINCT (submenu3nm), submenu3id  from tblmstsubmenu3 where submenu2id='$formkategoriid'");
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return array();
        }
    }

} ?>
	