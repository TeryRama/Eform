<?php
class M_home extends CI_Model
{
//  private $db1;
  function __construct()
  {
    parent::__construct();
    $CI = &get_instance();
    $this->db1 = $this->load->database('db1',TRUE);
  }

  function get_dt_user_ol(){
        $logdate = date('Y-m-d');
        $query = $this->db->query("SELECT
                                    x.*,
                                    y.levelusernm, 
                                    y.nmlengkap
                                  FROM
                                    ( SELECT *, ROW_NUMBER () OVER ( PARTITION BY username ORDER BY logid DESC ) AS row_num FROM tblmst_user_logonline ) x
                                    LEFT JOIN view_data_user AS y ON x.username = y.username 
                                  WHERE
                                    x.row_num = '1' 
                                    AND logdate = '$logdate' 
                                  ORDER BY
                                    username");
        if ($query->num_rows() >0){
            return $query->result();
        }
  }

  function get_dt_transaksi_ncr(){
      $query = $this->db->query("SELECT * from tbl_transaksi_ncr where ncr_action_date = now()::date");
        if ($query->num_rows() >0){
            return $query->result();
        }
  }

  function get_form_list($LevelUser) {
        $q = $this->db1->query("select distinct(a.formjnsnm) as formjnsnm from vwmst_form as a right join tblmstform_akses2 as b on a.formid=b.formid
where b.leveluserid='".$LevelUser."' group by formjnsnm order by formjnsnm asc");

        $final = array();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $q2 = $this->db1->query("select x.* from (select *, row_number() over (partition by formnm order by formefective desc) as row_num from vwmst_form)x right join tblmstform_akses2 as y on y.formid = x.formid where x.formjnsnm='".$row->formjnsnm."' and x.row_num='1' and x.formstatus='1' and y.leveluserid='".$LevelUser."' order by formnm asc");
                if ($q2->num_rows() > 0) {
                    $row->children = $q2->result();
                }else{}

                array_push($final, $row);
            }

        }else{
            /*===== NO ACITIVITY =====*/
        }
        
        return $final;
    }
}
?>
