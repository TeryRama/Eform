<?php

class M_struktur_qad extends CI_Model {

    var $tabel = 'tblmstleveluser'; //variabel tabel
     var $tabel2 = 'tblmstsubmenu_akses2'; //variabel tabel
     var $tabel3 = 'tblmstform_akses2'; //variabel tabel
     var $tabel4 = 'tblmstapproval_akses2'; //variabel tabel
     var $tabel5 = 'tblmstbutton_akses'; //variabel tabel

    function __construct() {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

    function get_struktur_qad(){
            $q = $this->db->query("select distinct(level) as level from tblmst_jabatan order by level asc");
            $final = array();
            if ($q->num_rows() > 0) {
                foreach ($q->result() as $row) {
                    $q2 = $this->db->query("select distinct(level_bag) as level_bag from tblmst_jabatan where level='".$row->level."' and level_bag is not null order by level_bag asc");
                    if ($q2->num_rows() > 0) {
                       foreach ($q2->result() as $row2) {
                          $q3 = $this->db->query("select distinct(level_bag2) as level_bag2 from tblmst_jabatan where level='".$row->level."' and level_bag='".$row2->level_bag."' and level_bag2 is not null  order by level_bag2 asc");
                          if ($q3->num_rows() > 0) {
                            foreach($q3->result() as $row3){
                                $q4 = $this->db->query("select distinct(level_bag3) as level_bag3 from tblmst_jabatan where level='".$row->level."' and level_bag='".$row2->level_bag."' and level_bag2='".$row3->level_bag2."' and level_bag3 is not null  order by level_bag3 asc");
                                if ($q4->num_rows() > 0) {
                                  $row3->children3 = $q4->result();
                                }                    
                            }
                            $row2->children2 = $q3->result();
                          }
                       }
                       $row->children = $q2->result();
                    }

                    array_push($final, $row);
                }
            }else{

            }
            return $final;
        }


}