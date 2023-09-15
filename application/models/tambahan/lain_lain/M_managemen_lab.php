<?php

class M_managemen_lab extends CI_Model {

        var $tabel1 = 'tbltrn_managemen_lab'; //variabel tabel

        function __construct(){
                parent::__construct();
                $CI = &get_instance();
                $this->db1 = $this->load->database('db1',TRUE);
        }

        function get_all_dokumen($file_kategori,$file_kategorisub){
            if(trim($file_kategorisub)=='-'){$con_sub = "and file_kategorisub IS NULL";}else{$con_sub = "and file_kategorisub='".$file_kategorisub."'";}
            if(trim($file_kategori)=='document'){$con_short = "order by file_description asc";}else{$con_short = "order by file_description asc";}
            $query= $this->db1->query("select * from tbltrn_managemen_lab where file_kategori='".$file_kategori."' $con_sub $con_short");   
            if ($query->num_rows() >0 ){
                return $query->result();
            }
        }

        function get_dokumen_byid($id){
            $query= $this->db1->query("select * from tbltrn_managemen_lab where file_id='$id'");   
            if ($query->num_rows() >0 ){
                return $query->result();
            }
        }


        function insert_data($data_dokumen) {
            $this->db1->trans_begin();
            $this->db1->insert($this->tabel1, $data_dokumen);
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

        function update_data($modal_file_id, $data_dokumen){
            $this->db1->trans_begin();
            $this->db1->set($data_dokumen);
            $this->db1->where('file_id', $modal_file_id);
            $this->db1->update($this->tabel1, $data_dokumen);
            if ($this->db1->trans_status() == FALSE){
            $this->db1->trans_rollback();
            $result = 0;
            }else{
               $this->db1->trans_commit();
             $result = 1;
            }
            return $result;
        }

        function delete_detail($id){
            $query1 = $this->db1->query("delete from tbltrn_managemen_lab where file_id='$id'");
        }

        
              
}
?>
