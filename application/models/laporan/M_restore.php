<?php
class M_restore extends CI_Model {
    function __construct(){
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1',TRUE);
    }

    function restore_laporan($data_app_update,$tablehead,$id){
        $this->db1->where('headerid', $id);
        $this->db1->update($tablehead, $data_app_update);
        $affected_rows = $this->db1->affected_rows();
        return TRUE;
    }
    
} ?>
