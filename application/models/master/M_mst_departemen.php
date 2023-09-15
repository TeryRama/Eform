<?php
class M_mst_departemen extends CI_Model {

    var $table    = 'tblmst_departemen';
    var $id_table = 'id_dept';

    function __construct(){
        parent:: __construct();
        $CI = &get_instance();
        $this->db = $this->load->database('default',TRUE);
    }

    function get_records_payroll(){
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_departemen"));
    }

    function get_records_payroll_byakses($bagian_akses){
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_departemen_byakses/".$bagian_akses));
    }

    function get_deptid($from){
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_departemen_byid/".$from));
    }

} ?>
