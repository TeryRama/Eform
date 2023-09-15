<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class M_approval extends CI_Model {

    var $tabel_acc     = 'tbl_transaksi_boiler';
    var $tabel_blr     = 'tblfrmfrmfss319dtl_c';
    var $tabel_blr_hdr = 'tblfrmfrmfss319hdr';

    function __construct()
  {
    parent::__construct();
    $CI           = &get_instance();
    $this->db1    = $this->load->database('db1',TRUE);
    $this->db_acc = $this->load->database('db_acc',TRUE);
//    $this->load->model('M_user','',TRUE);
  }

  function get_app_by($LevelUser,$frm_jnsid) {
        $query=$this->db1->query("select * from tblmstformnew where formid in (select max(a.formid) from tblmstapproval_akses2 as a left join tblmstformnew as b on a.formid=b.formid where a.leveluserid='".$LevelUser."' and a.formjnsid='".$frm_jnsid."' and formstatus='1' group by b.formkd) and status_app='1' and formstatus='1' order by formnm asc");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function get_dtform_app($dt_formid){
        $this->db1->select('*');
        $this->db1->from('tblmstformnew');
        $this->db1->where('formid',$dt_formid);
        $query=$this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
  }

    function get_data_app2($dtquery){
        $query = $this->db1->query($dtquery);
       
             return $query;
        
    }

    function get_data_app($tablehead,$item_select,$dtl,$BagNm,$app_status){
        switch($app_status){
          case $app_status =='app1':
            $con_app = 'AND app1_status IS NULL';
          break;
          case $app_status =='app2':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NULL';
          break;
          case $app_status=='app3':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NULL';
          break;
          case $app_status=='app4':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NULL';
          break;
          case $app_status=='app5':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NULL';
          break;
          case $app_status=='app6':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NULL';
          break;
          case $app_status=='app7':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NULL';
          break;
          case $app_status=='app8':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NULL';
          break;
          case $app_status=='app9':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NOT NULL AND app9_status IS NULL';
          break;
          case $app_status=='app10':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NOT NULL AND app10_status IS NULL AND app10_status IS NULL';
          break;
          default:
            $con_app = '';
          break;
        }
        if($tablehead=='tblfrmfrmlqs002hdr'){
            if($BagNm=='BOILER'){
                $condition = "AND tipe_contoh='Utility' AND jns_produk='Boiler'";
            }elseif($BagNm=='WTD'){
                $condition = "AND tipe_contoh='Utility' AND jns_produk='Water Treatment'";
            }else{
                $condition="";
            }

           $query = $this->db1->query("select $item_select from $tablehead where $dtl='1' $con_app $condition ");
        }else{
           $query = $this->db1->query("select $item_select from $tablehead where $dtl='1' $con_app");
        }
            return $query;
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

    function cek_status($Hd,$app_tabel,$app_status){
        $this->db1->from($app_tabel);
        $this->db1->where('headerid', $Hd);
        $this->db1->where($app_status, '1');
        $query = $this->db1->get();
        return $query;
    }

    function get_header_frm_byid($Hd,$app_tabel){
        $this->db1->from($app_tabel);
        $this->db1->where('headerid', $Hd);
        $query = $this->db1->get();
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_header_frm_byid2($par_efective,$tipefrm,$dtcreate_date,$app_tabel){
        $this->db1->from($app_tabel);
        $this->db1->where($par_efective, $dtcreate_date);
        $this->db1->where('jnsformtkk', $tipefrm);
        $query = $this->db1->get();
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    // function send_to_accounting($id){
    //     $this->db_acc->trans_begin();
    //     $this->db_acc->query("INSERT INTO $this->tabel_acc
    //                             (
    //                                 detail_id,
    //                                 headerid,
    //                                 kode_boiler,
    //                                 jam_op_hari_ini,
    //                                 jam_op_akm,
    //                                 pakai_tempurung_hari_ini,
    //                                 pakai_tempurung_akm,
    //                                 output_steam_hari_ini,
    //                                 output_steam_akm,
    //                                 pakai_air_hari_ini
    //                                 pakai_air_akm
    //                             )
    //                 SELECT * FROM
    //                     dblink ( 'host=192.168.3.8 user=postgres password=sa123 dbname=dbutl_frm', 
    //                             'SELECT
    //                                 b.detail_id_c,
    //                                 b.headerid,
    //                                 b.dtlc_kode_boiler,
    //                                 b.dtlc_total_jam,	
    //                                 b.dtlc_jam_akm,
    //                                 b.dtlc_tmpr_kg,
    //                                 b.dtlc_tmpr_akm,
    //                                 b.dtlc_steam_ton,
    //                                 b.dtlc_steam_akm,
    //                                 b.dtlc_total_air,
    //                                 b.dtlc_air_akm
    //                             FROM
    //                                 tblfrmfrmfss319dtl_c AS b
    //                             where b.headerid=''' || '$id' || ''' order by b.detail_id_c asc;') AS TBL1 
    //                             (
    //                                 detail_id_c INTEGER,
    //                                 headerid INTEGER,
    //                                 dtlc_kode_boiler TEXT,
    //                                 dtlc_total_jam TEXT,
    //                                 dtlc_jam_akm TEXT,
    //                                 dtlc_tmpr_kg TEXT,
    //                                 dtlc_tmpr_akm TEXT,
    //                                 dtlc_steam_ton TEXT,
    //                                 dtlc_steam_akm TEXT,
    //                                 dtlc_total_air TEXT,
    //                                 dtlc_air_akm TEXT
    //                             )");

    // }

    function send_to_accounting($blr_data)
    {
        $this->db_acc->trans_begin();
        $this->db_acc->insert($this->tabel_acc, $blr_data);
        if ($this->db_acc->trans_status() == FALSE) {
            $this->db_acc->trans_rollback();
            $result = 0;
        } else {
            $this->db_acc->trans_commit();
            $result = 1;
        }
        return $result;
        return TRUE;
    }

 
    function get_data_boiler($id)
    {
       return $this->db1->query("SELECT A
                                .*,
                                B.create_date 
                            FROM
                                tblfrmfrmfss319dtl_c
                                AS A LEFT JOIN tblfrmfrmfss319hdr AS B ON B.headerid = A.headerid 
                            WHERE
                                A.headerid = '$id' 
                            ORDER BY
                                detail_id_c ASC")->result();
    }
}

?>
