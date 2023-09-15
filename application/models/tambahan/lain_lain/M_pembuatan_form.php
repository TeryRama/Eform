<?php

class M_pembuatan_form extends CI_Model {

        var $tabel1 = 'tbltrn_ketidaksesuaian'; //variabel tabel

        function __construct(){
                parent::__construct();
                $CI = &get_instance();
                $this->db1 = $this->load->database('db1',TRUE);
        }

        function get_list_permintaan(){
            $query= $this->db1->query("select * from tbltrn_pembuatan_form_hdr where verify_status is NULL");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }
              
}
?>
