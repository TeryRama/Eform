<?php
class M_mst_hirarki_peraturan extends CI_Model {
	function __construct(){
		parent:: __construct();
		$CI = &get_instance();
		$this->db1= $this->load->database('db1',TRUE);
	}
		
    function get_records() {
            $query = $this->db1->query("select *, CASE WHEN LENGTH(no_urut) = 1 THEN '0'||no_urut ELSE no_urut END AS no_urut2 FROM tblmst_hirarki_peraturan where inactive = 0 order by no_urut2 asc");
            return $query->result();
    }

    function get_records_by($id){
        $query = $this->db1->query("select * from tblmst_hirarki_peraturan where inactive=0 and detail_id='$id'");
        return $query->result();
    }

    function get_max_no_urut(){
        $query = $this->db1->query("select max(no_urut::int+1) max_no_urut from tblmst_hirarki_peraturan where inactive=0");
        return $query;
    }
						
	function insert($data) {
    	$query=$this->db1->insert('tblmst_hirarki_peraturan', $data);
    	return $query;
	}
				
	function update_by_id($data, $id){
		$this->db1->where("detail_id ='$id'");
		$query= $this->db1->update('tblmst_hirarki_peraturan', $data);
		return $query;
	}
					
	function nonactive_by_id($id){
        $this->db1->set('inactive', '1');
        $this->db1->where("detail_id ='$id'");
        $query = $this->db1->update('tblmst_hirarki_peraturan');
        return $query;
	}

} ?>
	