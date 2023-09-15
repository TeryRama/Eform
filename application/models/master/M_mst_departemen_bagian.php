<?php
class M_mst_departemen_bagian extends CI_Model {

    var $table    = 'tblmst_bagian';
    var $id_table = 'id_bagian';

    function __construct(){
            parent:: __construct();
            $CI = &get_instance();
            $this->db= $this->load->database('default',TRUE);
    }

    function get_records_payroll(){
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_bagian"));
    }

} ?>
