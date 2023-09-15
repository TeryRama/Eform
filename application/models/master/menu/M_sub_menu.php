<?php

class M_sub_menu extends CI_Model {
		
	var $tabel = 'tblmstmenu';

	function __construct(){			
		parent :: __construct();
		$CI 		= &get_instance();
		$this->db1 	= $this->load->database('db1',TRUE);
	}
		
	function get_records($criteria='', $order='', $limit='', $offset=0){
		$this->db1->select('*');
		$this->db1->from('tblmstmenu');
		
		if($criteria != '')
			$this->db1->where($criteria);
			$this->db1->order_by('menuid', 'asc');
		if($limit != '')
			$this->db1->limit($limit, $offset);
			
		$query = $this->db1->get();
		return $query;
	}

    function get_records_sub(){
        $query = $this->db1->query('select tblmstsubmenu.*,tblmstmenu.*  FROM tblmstsubmenu INNER join tblmstmenu ON tblmstmenu.menuid = tblmstsubmenu.menuid order by tblmstmenu.menunm asc, tblmstsubmenu.submenunm asc');
        return $query;
    }

    function get_records_sub2(){
        $query = $this->db1->query('select tblmstsubmenu.*,tblmstsubmenu2.*  FROM tblmstsubmenu INNER join tblmstsubmenu2 ON tblmstsubmenu.submenuid = tblmstsubmenu2.submenuid order by tblmstsubmenu.submenunm asc, tblmstsubmenu2.submenu2nm asc');
        return $query;
    }

    function get_records_sub3(){
        $query = $this->db1->query('select tblmstsubmenu3.*,tblmstsubmenu2.*  FROM tblmstsubmenu3 INNER join tblmstsubmenu2 ON tblmstsubmenu3.submenu2id = tblmstsubmenu2.submenu2id order by tblmstsubmenu2.submenu2nm asc, tblmstsubmenu3.submenu3nm asc');
        return $query;
    }

	function get_allmenu(){
        $this->db1->from($this->tabel);
        $this->db1->order_by('menunm','asc');
        $query = $this->db1->get();
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    function get_allsubmenu(){
        $this->db1->from('tblmstsubmenu');
        $this->db1->order_by('submenunm','asc');
        $query = $this->db1->get();
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    function get_allsubmenu2(){
	    $query = $this->db1->query("select a.*, b.submenunm from tblmstsubmenu2 as a join tblmstsubmenu as b on a.submenuid = b.submenuid order by submenu2nm asc");
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

	function get_menu_byid($id){
        $this->db1->from($this->tabel);
        $this->db1->where('menuid', $id);
        $this->db1->order_by("menunm", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() == 1){
            return $query->result();
        }
    }

    function get_submenu_byid($subid){
        $this->db1->from('tblmstsubmenu');
        $this->db1->where('submenuid', $subid);
        $this->db1->order_by("submenunm", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() == 1){
            return $query->result();
        }
    }

    function get_submenu2_byid($subid){
        $this->db1->from('tblmstsubmenu2');
        $this->db1->where('submenu2id', $subid);
        $this->db1->order_by("submenu2nm", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() == 1){
            return $query->result();
        }
    }

    function get_submenu3_byid($subid){
        $this->db1->from('tblmstsubmenu3');
        $this->db1->where('submenu3id', $subid);
        $this->db1->order_by("submenu3nm", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() == 1){
            return $query->result();
        }
    }

    function update_menu($id, $data){
        $this->db1->where('menuid', $id);
        $this->db1->update($this->tabel, $data);
        return TRUE;
    }
		
	function insert($data){
		$query = $this->db1->insert('tblmstmenu', $data);
		return TRUE;
	}

	function insert_sub($data){
		$query = $this->db1->insert('tblmstsubmenu', $data);
		return TRUE;
	}

	function insert_sub2($data){
		$query = $this->db1->insert('tblmstsubmenu2', $data);
		return TRUE;
	}

	function insert_sub3($data){
		$query = $this->db1->insert('tblmstsubmenu3', $data);
		return TRUE;
	}

	function update_by_id($data, $id){
		$this->db1->where("menuid = '$id'");
		$query = $this->db1->update('tblmstmenu', $data);
		return $query;
	}

	function update_submenu_by_id($data, $submenuid){
		$this->db1->where("submenuid = '$submenuid'");
		$query = $this->db1->update('tblmstsubmenu', $data);
		return $query;
	}

	function update_submenu2_by_id($data, $submenu2id){
		$this->db1->where("submenu2id = '$submenu2id'");
		$query = $this->db1->update('tblmstsubmenu2', $data);
		return $query;
	}

	function update_submenu3_by_id($data, $submenu3id){
		$this->db1->where("submenu3id = '$submenu3id'");
		$query = $this->db1->update('tblmstsubmenu3', $data);
		return $query;
	}

	function delete_menu_by_id($id){
		$query = $this->db1->delete('tblmstmenu', "menuid = '$id'");
		return $query;
	}

	function delete_submenu_by_id($id){
		$query = $this->db1->delete('tblmstsubmenu', "submenuid = '$id'");
		return $query;
	}

	function delete_submenu2_by_id($id){
		$query = $this->db1->delete('tblmstsubmenu2', "submenu2id = '$id'");
		return $query;
	}

	function delete_submenu3_by_id($id){
		$query = $this->db1->delete('tblmstsubmenu3', "submenu3id = '$id'");
		return $query;
	}
} ?>