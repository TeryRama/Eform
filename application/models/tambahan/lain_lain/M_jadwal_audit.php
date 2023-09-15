<?php

class M_jadwal_audit extends CI_Model {

        var $tabel1 = 'tbltrn_jadwal_audit'; //variabel tabel

        function __construct(){
                parent::__construct();
                $CI = &get_instance();
                $this->db1 = $this->load->database('db1',TRUE);
        }

        function get_jadwal_audit(){
            $query= $this->db1->query('select * from tbltrn_jadwal_audit where extract(month from jadwal_from) >= extract(month from now()) and extract(years from jadwal_from) >= extract(years from now()) order by jadwal_from ASC');
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_jadwal_audit_home(){
            $query= $this->db1->query('select * from tbltrn_jadwal_audit where jadwal_from >= current_date order by jadwal_from ASC');
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_jadwal_audit_bydate($date_from, $date_to){
            $query= $this->db1->query("select * from tbltrn_jadwal_audit where jadwal_from between '$date_from' and '$date_to' order by jadwal_from ASC");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_jadwal_audit_byid($id){
            $query= $this->db1->query("select * from tbltrn_jadwal_audit where jadwal_id='$id'");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }


        function insert_detail($data_jadwal) {
            $this->db1->trans_begin();
            $this->db1->insert($this->tabel1, $data_jadwal);
            if ($this->db1->trans_status() == FALSE) {
                $this->db1->trans_rollback();
                $result = 0;
                } else {
                    $this->db1->trans_commit();
                    $result = 1;
                }
                return $result;
                return TRUE;
        }


        function delete_detail($id){
            $query1 = $this->db1->query("delete from tbltrn_jadwal_audit where jadwal_id='$id'");
        }

        function update_detail($modal_jadwal_id, $data_jadwal){
            $this->db1->trans_begin();
            $this->db1->set($data_jadwal);
            $this->db1->where('jadwal_id', $modal_jadwal_id);
            $this->db1->update($this->tabel1, $data_jadwal);
            if ($this->db1->trans_status() == FALSE){
            $this->db1->trans_rollback();
            $result = 0;
            }else{
               $this->db1->trans_commit();
             $result = 1;
            }
            return $result;
        }

        

        
              
}
?>
