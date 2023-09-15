<?php
class M_approval_pengganti extends CI_Model {
    function __construct(){
        parent:: __construct();
        $CI = &get_instance();
        $this->db1= $this->load->database('db1',TRUE);
    }

    function get_dt_formjnsnm(){
        $query = $this->db1->query("select DISTINCT (formkd), formnm FROM vwmst_form WHERE status_app='1' group by formkd, formnm");
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return array();
        }
    }

    function get_dt_formversi($formkodenm){
        $query = $this->db1->query("select DISTINCT (formversi) FROM vwmst_form WHERE formkd='$formkodenm' group by formversi");
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return array();
        }
    }

    function get_dt_jmlapp($formkodenm,$formversi){
        $query = $this->db1->query("select unnest(array(SELECT * FROM generate_series(1, coalesce(parameter_jlh_approval::integer,0)))) as listapp, parameter_jlh_approval from vwmst_form WHERE formkd='$formkodenm' and formversi='$formversi' ");
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return array();
        }
    }

    function get_app_position($dt_formid,$LevelUser){
        $query = $this->db1->query("SELECT CASE greatest(app1, app2, app3, app4, app5, app6, app7, app8, app9, app10) "
          ." WHEN app1 THEN 'app1' "
          ." WHEN app2 THEN 'app2' "
          ." WHEN app3 THEN 'app3' "
          ." WHEN app4 THEN 'app4' "
          ." WHEN app5 THEN 'app5' "
          ." WHEN app6 THEN 'app6' "
          ." WHEN app7 THEN 'app7' "
          ." WHEN app8 THEN 'app8' "
          ." WHEN app9 THEN 'app9' "
          ." WHEN app10 THEN 'app10' "
          ."END AS app_pos "
          ."from tblmstapproval_akses2 where formid='$dt_formid' and leveluserid='$LevelUser'");

        return $query->result();
    }

    function update_approval($data_app_update,$Hd,$app_tabel){
        $this->db1->set($data_app_update);
        $this->db1->where('headerid', $Hd);
        $this->db1->update($app_tabel, $data_app_update);

        return TRUE;
    }

}
