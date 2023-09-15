<?php

	class M_tandatangan extends CI_Model {

		var $tabel = 'tblmst_user';
		var $tabel1 = 'tblmst_sign';

		function __construct() {

			parent :: __construct();
			$this->db1= $this->load->database('db1',TRUE);
		}

                function get_data_user($id){
                    /*$this->db->select('*');
                    $this->db->from($this->tabel);
                    $this->db->where('userid', $id);
                    $query = $this->db->get();*/
                    $query = $this->db->query("SELECT * FROM view_data_user where userid='$id' ORDER BY nmdepan ASC");
                    //cek apakah ada ba
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                }

                function get_data_nm($nmlengkap){
                    $this->db->select('*');
                    $this->db->from($this->tabel);
                    $this->db->where('nmlengkap', $nmlengkap);
                    $query = $this->db->get();

                    //cek apakah ada ba
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
				}
		// TTD NON USER
		function get_recordsttd() {
			$query = $this->db1->query("SELECT * FROM tblmst_sign ORDER BY nama ASC");
			return $query->result();
		}

		function insert_sign($data) {
			$query = $this->db1->insert('tblmst_sign', $data);
			return TRUE;
		}

		function get_sign_byid($idu) {
	        $this->db1->from('tblmst_sign');
	        $this->db1->where('sign_id', $idu);

	        $query = $this->db1->get();

	        if ($query->num_rows() == 1) {
	            return $query->result();
	        }
		}

		function update_sign($signid,$data) {
	        $this->db1->where('sign_id', $signid);
	        $this->db1->update($this->tabel1, $data);

	        return TRUE;
		}

		function delete_user_sign($idu) {
			$query = $this->db1->delete('tblmst_sign', "sign_id = '$idu'");
			return $query;
		}
		// TTD NON USER

		function get_records($dtbag) {
                        $query = $this->db->query("SELECT * FROM view_data_user $dtbag ORDER BY nmdepan ASC");
			return $query;
		}

		function get_alluser() {
	        $this->db->from($this->tabel);
	        $this->db->order_by('nmlengkap','asc');
	        $query = $this->db->get();

	        //cek apakah ada ba
	        if ($query->num_rows() > 0) {
	            return $query->result();
	        }
	    }

            function get_alllevel($dtbag_level) {
	       $query = $this->db->query("SELECT * from tblmstleveluser $dtbag_level ORDER by levelusernm asc");
                 return $query->result();
	    }

            function get_alljab($dtbag2) {
                $query = $this->db->query("SELECT a.*, b.* from tblmstjabatan as a join tblmstbagian as b on a.deptid = b.bagid $dtbag2 order by b.bagnm asc, a.jabnm asc");
                 return $query->result();
	    }

            function get_allbag($dtbag3) {
	       $query = $this->db->query("SELECT * from tblmstbagian $dtbag3 order by bagnm asc");
                 return $query->result();
	    }



		function get_user_byid($id) {
	        $this->db->from('view_data_user');
	        $this->db->where('userid', $id);
	        $this->db->order_by("nmlengkap", "asc");

	        $query = $this->db->get();

	        if ($query->num_rows() == 1) {
	            return $query->result();
	        }
	    }

	    function update_user($id, $data) {
	        $this->db->where('userid', $id);
	        $this->db->update($this->tabel, $data);

	        return TRUE;
	    }

		function insert($data) {
			$query = $this->db->insert('tblmst_user', $data);
			return TRUE;
		}

		function update_by_id($data, $id) {
			$this->db->where("userid = '$id'");
			$query = $this->db->update('tblmst_user', $data);
			return $query;
		}

		function delete_by_id($id) {
			$query = $this->db->delete('tblmst_user', "userid = '$id'");
			return $query;
		}
	}
?>