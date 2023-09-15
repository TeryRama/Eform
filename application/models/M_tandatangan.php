<?php

class M_tandatangan extends CI_Model {


    function __construct()
  {
    parent::__construct();
    $CI = &get_instance();
    $this->db1 = $this->load->database('db1',TRUE);
  }

  function get_all_ttd(){
      $this->db->from('view_data_ttd');
        $this->db->order_by('bagnm','asc');
        $this->db->order_by('jabnm','asc');
        $this->db1->order_by('nmlengkap','asc');
        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }
  }

  
}