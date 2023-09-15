<?php
class M_form extends CI_Model {
	function __construct(){
		parent:: __construct();
		$CI = &get_instance();
		$this->db1= $this->load->database('db1',TRUE);
		}
		
		function get_records($criteria='' , $order='', $limit='' , $offset=0) {
			$this->db1->select('*');
			$this->db1->from('tblmstform');
				
				if ($criteria !='')
					$this->db1->where($criteria);
				if ($order !='')
					$this->db1->order_by($order);
					
				if ($limit !='')
					$this->db1->limit($limit, $offset);
					$query = $this->db1->get();
					return $query;
				}
						
				
				function insert($data) {
				$query=$this->db1->insert('tblmstformnew', $data);
				return $query;
				}
				
				function update_by_id($data, $formid){
					$this->db1->where("formid ='$formid'");
					$query= $this->db1->update('tblmstform', $data);
					return $query;
				}
					
				function delete_by_id($id){
				$query = $this->db1->delete('tblmstform',"formid ='$id'");
				return $query;
	}

                                function getAllJnsid()
                                {
                                $query = $this->db1->query('SELECT * from tblmstformjenis');
                                return $query->result();

        }
                                
                               function getFormKat($fjnsid){
                                $this->db1->where('formjnsid',$fjnsid);
                                $result = $this->db1->get('tblmstformkategori');
                                if($result->num_rows()>0){
                                    return $result->result_array();
                                }else{
                                    return array();
                                }
                            }
                               
				
}	

	?>
	