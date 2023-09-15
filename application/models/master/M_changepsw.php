<?php
class M_changepsw extends CI_Model {
	function __construct(){
		parent:: __construct();
		$CI = &get_instance();
		$this->db1= $this->load->database('db1',TRUE);
		}

                function get_dtuser($UserName){
                    $this->db->select ('*');
                    $this->db->from ('tblmst_user');
                    $this->db->where('username',$UserName);
                    $query = $this->db->get();
		    return $query->result();
                }

                function check_dtuser($id,$dtusername){
                    $query=$this->db->query("select * from tblmst_user where userid<>'$id' and username='$dtusername'");
                    return $query;
                }

		function update_dtuser($id, $data3){
                        $this->db->where("userid ='$id'");
                        $query= $this->db->update('tblmst_user', $data3);
                        return $query;
                }


					              			
}	
?>
	