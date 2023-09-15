<?php

class M_history_activity extends CI_Model {


        function __construct(){
                parent::__construct();
                $CI = &get_instance();
                $this->db1 = $this->load->database('db1',TRUE);
        }

        function get_list_history(){
            $query= $this->db1->query("select * from (select * from tbl_history_activity where history_date=current_date and history_param not like '%chk%' order by history_date desc, history_id desc limit 100)x order by history_date asc, history_id asc");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function insert_history_activity($detail_history_activity){
            $this->db1->trans_begin();
            $this->db1->insert('tbl_history_activity', $detail_history_activity);
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

        function cek_history($history_date,$history_comp,$history_by,$history_formkd,$history_formvrs,$history_headerid,$history_param,$history_data_old,$history_data_new,$history_leveluser,$history_bagnm,$history_detail_id){
            $this->db1->from('tbl_history_activity');
            $this->db1->where('history_date', $history_date);
            $this->db1->where('history_comp', $history_comp);
            $this->db1->where('history_by', $history_by);
            $this->db1->where('history_formkd', $history_formkd);
            $this->db1->where('history_formvrs', $history_formvrs);
            $this->db1->where('history_headerid', $history_headerid);
            $this->db1->where('history_param', $history_param);
            $this->db1->where('history_data_old', $history_data_old);
            $this->db1->where('history_data_new', $history_data_new);
            $this->db1->where('history_leveluser', $history_leveluser);
            $this->db1->where('history_bagnm', $history_bagnm);
            $this->db1->where('history_detail_id', $history_detail_id);
            $query = $this->db1->get();
            return $query->result();
        }

        function update_history_activity($detail_history_activity,$history_id){
            $this->db1->trans_begin();
            $this->db1->set($detail_history_activity);
            $this->db1->where('history_id', $history_id);
            $this->db1->update('tbl_history_activity', $detail_history_activity);
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

        function get_history_activity_bydate($date_from, $date_to){
            $query= $this->db1->query("select * from tbl_history_activity where history_date between '$date_from' and '$date_to' order by history_date asc, history_id asc");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

}
?>
