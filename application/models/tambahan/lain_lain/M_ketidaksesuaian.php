<?php

class M_ketidaksesuaian extends CI_Model {

        var $tabel1 = 'tbltrn_ketidaksesuaian'; //variabel tabel

        function __construct(){
                parent::__construct();
                $CI = &get_instance();
                $this->db1 = $this->load->database('db1',TRUE);
        }

        function get_ketidaksesuaian($on_audit){
            if($on_audit=='1'){
               $query= $this->db1->query("select * from tbltrn_ketidaksesuaian where (extract(month from report_date) = extract(month from now()) and extract(years from report_date) = extract(years from now()) or  action_status is NULL or verifi_status is null) and (verifi_hidden='0' or verifi_hidden is null) ");  
            }else{
               $query= $this->db1->query('select * from tbltrn_ketidaksesuaian where extract(month from report_date) = extract(month from now()) and extract(years from report_date) = extract(years from now()) or action_status is NULL or verifi_status is null;');  
            }
            
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_ketidaksesuaian_bydate($date_from, $date_to,$on_audit){
            if($on_audit=='1'){
               $query= $this->db1->query("select * from tbltrn_ketidaksesuaian where report_date between '$date_from' and '$date_to' and (verifi_hidden='0' or verifi_hidden is null)");     
            }else{
               $query= $this->db1->query("select * from tbltrn_ketidaksesuaian where report_date between '$date_from' and '$date_to'");     
            }
            
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }


        function insert_detail($data_nc) {
            $this->db1->trans_begin();
            $this->db1->insert($this->tabel1, $data_nc);
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

        function get_kategori($bagian){
            $query= $this->db1->query("select distinct(formkategorinm) from vwmst_form where formjnsnm='$bagian' order by formkategorinm asc");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_subkategori($bagian, $form_kategori){
            if($form_kategori!='-'){
                $query= $this->db1->query("select distinct(formkategori2nm) from vwmst_form where formjnsnm='$bagian' and formkategorinm='$form_kategori' order by formkategori2nm asc");
            }else{
                 $query= $this->db1->query("select distinct(formkategori2nm) from vwmst_form where formjnsnm='$bagian' and formkategorinm IS NULL order by formkategori2nm asc");   
            }
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_formkode($bagian, $form_kategori, $form_subkategori){
            if(($form_kategori=='-') && ($form_subkategori=='-')){
                 $query= $this->db1->query("select distinct(formkd),formnm from vwmst_form where  formjnsnm='$bagian' and formkategorinm IS NULL and formkategori2nm IS NULL group by formkd, formnm order by formnm asc");  
            }else if(($form_kategori!='-') && ($form_subkategori=='-')){
                 $query= $this->db1->query("select distinct(formkd),formnm from vwmst_form where  formjnsnm='$bagian' and formkategorinm='$form_kategori' and formkategori2nm IS NULL group by formkd, formnm order by formnm asc"); 
            }else{
                $query= $this->db1->query("select distinct(formkd),formnm from vwmst_form where  formjnsnm='$bagian' and formkategorinm='$form_kategori' and formkategori2nm='$form_subkategori' group by formkd, formnm order by formnm asc");  
            }
            
            if ($query->num_rows() >0 ){
                return $query->result();
            }
        }

        function get_formversi($form_kode){
             $query= $this->db1->query("select distinct(formversi) from vwmst_form where formkd='$form_kode' order by formversi asc");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_formjudul($form_kode,$form_versi){
            $query= $this->db1->query("select formjudul from vwmst_form where formkd='$form_kode' and formversi='$form_versi'");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function delete_detail($id){
            $query1 = $this->db1->query("delete from tbltrn_ketidaksesuaian where id='$id'");
        }

        function update_detail($modal_id, $data_nc){
            $this->db1->trans_begin();
            $this->db1->set($data_nc);
            $this->db1->where('id', $modal_id);
            $this->db1->update($this->tabel1, $data_nc);
            if ($this->db1->trans_status() == FALSE){
            $this->db1->trans_rollback();
            $result = 0;
            }else{
               $this->db1->trans_commit();
             $result = 1;
            }
            return $result;
        }

        function get_ketidaksesuaian_byid($id){
            $query= $this->db1->query("Select * from tbltrn_ketidaksesuaian where id='$id'");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }
              
}
?>
