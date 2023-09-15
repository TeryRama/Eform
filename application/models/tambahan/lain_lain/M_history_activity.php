<?php

class M_history_activity extends CI_Model {


        function __construct(){
                parent::__construct();
                $CI = &get_instance();
                $this->db1 = $this->load->database('db1',TRUE);
        }

        function get_list_history(){
            $double_quote = '"';
            $query= $this->db1->query("select x.schema_name, x.table_name, x.user_name, x.action_tstamp, x.action_tstamp::timestamp::date as action_date, substring((x.action_tstamp::timestamp::time::text), 1, 8) as action_time, x.action, x.action_by, x.action_comp, x.action_byx, x.action_compx, x.id_header, x.id_detail, string_agg(data_old, ', ') AS data_old, string_agg(data_new, ', ') AS data_new, y.formjnsnm, y.formkategorinm, y.formkategori2nm
from
(with t1 as(SELECT schema_name, table_name, user_name, action_tstamp, action, unnest(string_to_array(replace(replace(replace(replace(old_data::text,'null',''),'{',''),'}',''),'$double_quote',''),',')) AS JsonArray, action_by, action_comp, action_byx, action_compx, id_header, id_detail FROM audit.logged_actions where action='U' and table_name not like '%x%' and action_tstamp::timestamp::date = current_date),
t2 as(SELECT schema_name, table_name, user_name, action_tstamp, action, unnest(string_to_array(replace(replace(replace(replace(new_data::text,'null',''),'{',''),'}',''),'$double_quote',''),',')) AS JsonArray, action_by, action_comp, action_byx, action_compx, id_header, id_detail FROM audit.logged_actions where action='U' and table_name not like '%x%' and action_tstamp::timestamp::date = current_date)
select t2.schema_name, t2.table_name, t2.user_name, t2.action_tstamp, t2.action, t1.JsonArray as data_old, t2.JsonArray as data_new, t2.action_by, t2.action_comp, t2.action_byx, t2.action_compx, t2.id_header, t2.id_detail from t1 join t2 on t1.table_name=t2.table_name and t1.id_header=t2.id_header and t1.id_detail=t2.id_detail and SPLIT_PART(t1.JsonArray, ':', 1)=SPLIT_PART(t2.JsonArray, ':', 1) where SPLIT_PART(t1.JsonArray, ':', 2)<>SPLIT_PART(t2.JsonArray, ':', 2) and ((TRIM(SPLIT_PART(t1.JsonArray, ':', 2))!='') OR (TRIM(SPLIT_PART(t2.JsonArray, ':', 2))='')))x 
    left join vwmst_form as y on SUBSTRING(x.table_name,7,9) = y.formkd
where x.action_tstamp::timestamp::date = current_date
group by x.schema_name, x.table_name, x.user_name, x.action_tstamp, x.action, x.action_by, x.action_comp, x.action_byx, x.action_compx, x.id_header, x.id_detail, y.formjnsnm, y.formkategorinm, y.formkategori2nm order by x.action_tstamp desc limit 100");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

         function get_list_history_x(){
            $double_quote = '"';
            $query= $this->db1->query("SELECT tanggal as action_date, jam as action_time, komputer as action_comp,
                 history_user as action_by, 'tblfrm'||lower(replace(form_kode,'-',''))||'hdr' as table_name, form_jenis as formjnsnm,
                 form_kategori as formkategorinm, form_subkategori as formkategori2nm, data_lama as data_old, data_baru as data_new, 
                 data_headerid as id_header, data_detail_id as id_detail
                 from tbl_history_activity_user where tanggal = current_date and history_action='U'");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_list_history_delete(){
            $double_quote = '"';
            $query= $this->db1->query("select x.schema_name, x.table_name, x.user_name, x.action_tstamp, x.action_tstamp::timestamp::date as action_date, substring((x.action_tstamp::timestamp::time::text), 1, 8) as action_time, x.action, x.action_by, x.action_comp, x.action_byx, x.action_compx, x.id_header, x.id_detail, replace(cast(x.old_data as text),'$double_quote','') as data_old, y.formjnsnm, y.formkategorinm, y.formkategori2nm from audit.logged_actions as x left join vwmst_form as y on SUBSTRING(x.table_name,7,9) = y.formkd  where x.action_tstamp::timestamp::date = current_date and x.action='D' and x.table_name not like '%x%'");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_list_history_delete_x(){
            $double_quote = '"';
            $query= $this->db1->query("SELECT tanggal as action_date, jam as action_time, komputer as action_comp,
                 history_user as action_by, 'tblfrm'||lower(replace(form_kode,'-',''))||'hdr' as table_name, form_jenis as formjnsnm,
                 form_kategori as formkategorinm, form_subkategori as formkategori2nm, data_delete as data_old
                 from tbl_history_activity_user where tanggal = current_date and history_action='D'");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function insert_history_activity($detail_history_activity){
            $this->db1->trans_begin();
            $this->db1->insert('tbl_history_activity_user', $detail_history_activity);
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

        /*function cek_history($history_date,$history_comp,$history_by,$history_formkd,$history_formvrs,$history_headerid,$history_param,$history_data_old,$history_data_new,$history_leveluser,$history_bagnm,$history_detail_id){
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
        }*/

        /*function update_history_activity($detail_history_activity,$history_id){
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
        }*/

        function get_history_activity_bydate($date_from, $date_to, $formjnsnm){
            if(trim($formjnsnm)!=''){$con_jns_form = "and y.formjnsnm = '$formjnsnm'";}else{$con_jns_form = '';}   
            $double_quote = '"';
            $query= $this->db1->query("select x.schema_name, x.table_name, x.user_name, x.action_tstamp, x.action_tstamp::timestamp::date as action_date, substring((x.action_tstamp::timestamp::time::text), 1, 8) as action_time, x.action, x.action_by, x.action_comp, x.action_byx, x.action_compx, x.id_header, x.id_detail, string_agg(data_old, ', ') AS data_old, string_agg(data_new, ', ') AS data_new, y.formjnsnm, y.formkategorinm, y.formkategori2nm
from
(with t1 as(SELECT schema_name, table_name, user_name, action_tstamp, action, unnest(string_to_array(replace(replace(replace(replace(old_data::text,'null',''),'{',''),'}',''),'$double_quote',''),',')) AS JsonArray, action_by, action_comp, action_byx, action_compx, id_header, id_detail FROM audit.logged_actions where action='U' and table_name not like '%x%' and action_tstamp::timestamp::date between '$date_from' and '$date_to'),
t2 as(SELECT schema_name, table_name, user_name, action_tstamp, action, unnest(string_to_array(replace(replace(replace(replace(new_data::text,'null',''),'{',''),'}',''),'$double_quote',''),',')) AS JsonArray, action_by, action_comp, action_byx, action_compx, id_header, id_detail FROM audit.logged_actions where action='U' and table_name not like '%x%' and action_tstamp::timestamp::date between '$date_from' and '$date_to')
select t2.schema_name, t2.table_name, t2.user_name, t2.action_tstamp, t2.action, t1.JsonArray as data_old, t2.JsonArray as data_new, t2.action_by, t2.action_comp, t2.action_byx, t2.action_compx, t2.id_header, t2.id_detail from t1 join t2 on t1.table_name=t2.table_name and t1.id_header=t2.id_header and t1.id_detail=t2.id_detail and SPLIT_PART(t1.JsonArray, ':', 1)=SPLIT_PART(t2.JsonArray, ':', 1) where SPLIT_PART(t1.JsonArray, ':', 2)<>SPLIT_PART(t2.JsonArray, ':', 2) and ((TRIM(SPLIT_PART(t1.JsonArray, ':', 2))!='') OR (TRIM(SPLIT_PART(t2.JsonArray, ':', 2))='')))x 
    left join vwmst_form as y on SUBSTRING(x.table_name,7,9) = y.formkd
where x.action_tstamp::timestamp::date between '$date_from' and '$date_to' $con_jns_form
group by x.schema_name, x.table_name, x.user_name, x.action_tstamp, x.action, x.action_by, x.action_comp, x.action_byx, x.action_compx, x.id_header, x.id_detail, y.formjnsnm, y.formkategorinm, y.formkategori2nm order by x.action_tstamp desc");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_history_activity_bydate_x($date_from, $date_to, $formjnsnm){
            if(trim($formjnsnm)!=''){$con_jns_form = "and form_jenis = '$formjnsnm'";}else{$con_jns_form = '';}   
            $double_quote = '"';
            $query= $this->db1->query("SELECT tanggal as action_date, jam as action_time, komputer as action_comp,
                 history_user as action_by, 'tblfrm'||lower(replace(form_kode,'-',''))||'hdr' as table_name, form_jenis as formjnsnm,
                 form_kategori as formkategorinm, form_subkategori as formkategori2nm, data_lama as data_old, data_baru as data_new, 
                 data_headerid as id_header, data_detail_id as id_detail
                 from tbl_history_activity_user where tanggal between '$date_from' and '$date_to' and history_action='U' $con_jns_form");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_list_history_delete_bydate($date_from, $date_to, $formjnsnm){
            if(trim($formjnsnm)!=''){$con_jns_form = "and y.formjnsnm = '$formjnsnm'";}else{$con_jns_form = '';}
            $query= $this->db1->query("select x.schema_name, x.table_name, x.user_name, x.action_tstamp, x.action_tstamp::timestamp::date as action_date, substring((x.action_tstamp::timestamp::time::text), 1, 8) as action_time, x.action, x.action_by, x.action_comp, x.action_byx, x.action_compx, x.id_header, x.id_detail, replace(cast(x.old_data as text),'$double_quote','') as data_old, y.formjnsnm, y.formkategorinm, y.formkategori2nm from audit.logged_actions as x left join vwmst_form as y on SUBSTRING(x.table_name,7,9) = y.formkd  where x.action_tstamp::timestamp::date between '$date_from' and '$date_to' and x.action='D' and x.table_name not like '%x%' $con_jns_form");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_list_history_delete_bydate_x($date_from, $date_to, $formjnsnm){
            if(trim($formjnsnm)!=''){$con_jns_form = "and form_jenis = '$formjnsnm'";}else{$con_jns_form = '';}
            $query= $this->db1->query("SELECT tanggal as action_date, jam as action_time, komputer as action_comp,
                 history_user as action_by, 'tblfrm'||lower(replace(form_kode,'-',''))||'hdr' as table_name, form_jenis as formjnsnm,
                 form_kategori as formkategorinm, form_subkategori as formkategori2nm, data_delete as data_old
                 from tbl_history_activity_user where tanggal between '$date_from' and '$date_to' and history_action='D' $con_jns_form");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_header_form($tabel, $tgl_parameter, $val_headerid){
           $query= $this->db1->query("select ".$tgl_parameter." as value_parameter from ".$tabel." where headerid='$val_headerid'");
                if ($query->num_rows() >0 ){
                    return $query->result();
                } 
        }

        function get_frmversi($val_form_kode, $tgl_parameter, $value_parameter) {
        $query=$this->db1->query("select max(formversi) as formversi from tblmstformnew where formkd='$val_form_kode' and formefective<='$value_parameter'");
        if ($query->num_rows()>0) {
                return $query->result();
        }
    }

        

}
?>
