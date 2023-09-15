<?php
class M_forminput extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

    public function get_dtform($frmkode, $frmvrs)
    {
        $this->db1->select('*');
        $this->db1->from('tblmstformnew');
        $this->db1->where('formkd', $frmkode);
        $this->db1->where('formversi', $frmvrs);
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_dtform_by_level($frmkode, $frmvrs, $LevelUser)
    {
        $query = $this->db1->query("SELECT
                                        a.*,
                                        b.form_create,
                                        b.form_update,
                                        b.form_delete,
                                        b.form_excel
                                    FROM
                                        tblmstformnew
                                        AS A LEFT JOIN tblmstform_akses2 AS b ON A.formid = b.formid
                                    WHERE
                                        formkd = '$frmkode'
                                        AND formversi = '$frmvrs'
                                        AND b.leveluserid = '$LevelUser'");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function getButton_Akses($LevelUser)
    {
        $this->db1->select("*");
        $this->db1->from("tblmstbutton_akses");
        $this->db1->where('leveluserid', $LevelUser);
        $query = $this->db1->get();
        if ($query->num_rows() > 0 && !empty($this->session->userdata('logged_in')['akses_sambupedia'])) {
            $result = [];
            foreach ($query->result()[0] as $q_key => $q_value) {
                $result[$q_key] = 0;
            }

            $result2[] = (object)$result;

            return $result2;
        } else if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid($id)
    {
        $this->db1->from($this->table2);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_dataharian($tablehead, $item_select, $dtl, $dtl1, $dtl2, $dtl3, $BagNm, $LevelUser, $userid)
    {
        if ($tablehead == 'tblfrmfrmehs055hdr') {
            $query = $this->db1->query("select $item_select FROM $tablehead as a join tblmst_item1_regulasi as b on a.aspek=b.detail_id where $dtl='0' order by a.headerid desc");
            return $query;
        } else if (
            $tablehead == 'tblfrmfrmfss315hdr' ||
            $tablehead == 'tblfrmfrmfss318hdr' ||
            $tablehead == 'tblfrmfrmfss520hdr' ||
            $tablehead == 'tblfrmintwtd014hdr' ||
            $tablehead == 'tblfrmintwtd017hdr'
        ) {
            $query = $this->db1->query("select $item_select FROM $tablehead  where $dtl1='0' OR $dtl2='0' OR $dtl3='0' order by headerid desc");
            return $query;
        } else {
            $query = $this->db1->query("select $item_select from $tablehead where $dtl='0' order by headerid desc");
            return $query;
        }
    }

    function get_datalaporan($dtquery)
    {
        $query = $this->db1->query($dtquery);
        if ($query->num_rows() > 0) {
            return $query;
        }
    }

    function get_dataapproval($tablehead, $appno)
    {
        $this->db1->select('*');
        $this->db1->from($tablehead);
        $this->db1->where($appno, '0');
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query;
        }
    }

    function delete_data_hdr($tablehead, $id, $UserName, $frmkode)
    {
        $this->db1->trans_start();
        $activity = $this->db1->query("insert into tbl_log_activity (log_activity_action, log_activity_description, log_activity_by, log_activity_date, log_activity_time, log_activity_table)
                                    select 'DELETE DATA HARIAN', rtrim(ltrim(replace($tablehead::text, ',', '_'), '('), ')'), '$UserName',CURRENT_DATE,CURRENT_TIME(0), '$tablehead' from $tablehead where headerid='$id'");
        $query  = $this->db1->query("delete from " . $tablehead . " WHERE headerid = '$id'");
        $this->db1->trans_complete();
        if ($this->db1->affected_rows() == '1') {
            return true;
        } else {
            if ($this->db1->trans_status() === false) {
                return false;
            } else {
                return true;
            }
        }
    }

    function delete_data($tablehead, $tabledetail, $tabledetailx, $id, $UserName, $frmkode)
    {
        $this->db1->trans_start();
        $activity = $this->db1->query("insert into tbl_log_activity (log_activity_action, log_activity_description, log_activity_by, log_activity_date, log_activity_time, log_activity_table)
                                    select 'DELETE DATA HARIAN', rtrim(ltrim(replace($tablehead::text, ',', '_'), '('), ')'), '$UserName',CURRENT_DATE,CURRENT_TIME(0), '$tablehead' from $tablehead where headerid='$id'");
        $query2 = $this->db1->query("delete from " . $tabledetail . " where headerid = '$id'");
        $query3 = $this->db1->query("delete from " . $tabledetailx . " WHERE headerid = '$id'");
        $query  = $this->db1->query("delete from " . $tablehead . " WHERE headerid = '$id'");
        $this->db1->trans_complete();
        if ($this->db1->affected_rows() == '1') {
            return true;
        } else {
            if ($this->db1->trans_status() === false) {
                return false;
            } else {
                return true;
            }
        }
    }

    function delete_data_multidetail($tablehead, $tabledetail, $tabledetailx, $id, $UserName, $frmkode, $tabledetailb, $tabledetailbx, $tabledetailc, $tabledetailcx)
    {
        $this->db1->trans_start();
        $activity = $this->db1->query("insert into tbl_log_activity (log_activity_action, log_activity_description, log_activity_by, log_activity_date, log_activity_time, log_activity_table)
                                    select 'DELETE DATA HARIAN', rtrim(ltrim(replace($tablehead::text, ',', '_'), '('), ')'), '$UserName',CURRENT_DATE,CURRENT_TIME(0), '$tablehead' from $tablehead where headerid='$id'");
        $query2 = $this->db1->query("delete from " . $tabledetail . " where headerid = '$id'");
        $query3 = $this->db1->query("delete from " . $tabledetailx . " WHERE headerid = '$id'");
        $query  = $this->db1->query("delete from " . $tablehead . " WHERE headerid = '$id'");
        $this->db1->trans_complete();
        if ($this->db1->affected_rows() == '1') {
            return true;
        } else {
            if ($this->db1->trans_status() === false) {
                return false;
            } else {
                return true;
            }
        }
    }

    function delete_laporan_hdr($tablehead, $id, $UserName)
    {
        $activity = $this->db1->query("insert into tbl_log_activity (log_activity_action, log_activity_description, log_activity_by, log_activity_date, log_activity_time, log_activity_table)
                                select 'DELETE LAPORAN', rtrim(ltrim(replace($tablehead::text, ',', '_'), '('), ')'), '$UserName',CURRENT_DATE,CURRENT_TIME(0), '$tablehead' from $tablehead where headerid='$id'");
        $query = $this->db1->delete($tablehead, "headerid = '$id'");
        return $query;
    }

    function delete_laporan($tablehead, $tabledetail, $tabledetailx, $id, $UserName)
    {
        $activity = $this->db1->query("insert into tbl_log_activity (log_activity_action, log_activity_description, log_activity_by, log_activity_date, log_activity_time, log_activity_table)
                                select 'DELETE LAPORAN', rtrim(ltrim(replace($tablehead::text, ',', '_'), '('), ')'), '$UserName',CURRENT_DATE,CURRENT_TIME(0), '$tablehead' from $tablehead where headerid='$id'");
        $query2 = $this->db1->delete($tabledetail, "headerid = '$id'");
        return $query2;
        $query3 = $this->db1->delete($tabledetailx, "headerid = '$id'");
        return $query3;
        $query = $this->db1->delete($tablehead, "headerid = '$id'");
        return $query;
    }

    function get_frmversi($frmkode, $tgl_parameter)
    {
        $query = $this->db1->query("select max(formversi) as formversi from tblmstformnew where formkd='$frmkode' and formefective<='$tgl_parameter'");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_list_item($frmkode, $frmvrs, $dept, $tipe, $create_date)
    {
        $q = $this->db1->query("select 
                                    *,
                                    'item1' dtl_level
                                  from 
                                    tblmst_formitem_hdr a 
                                  join
                                    tblmst_formitem_dtl b 
                                    on a.headerid=b.headerid
                                  where 
                                    a.inactive='0'
                                    and lower(replace(form_kode, '-', '')) = '$frmkode'
                                    and parameter = '$tipe'
                                    and departemen = '$dept'
                                    and tgl_efective in (select 
                                                      max(tgl_efective) 
                                                    from 
                                                      tblmst_formitem_hdr 
                                                    where
                                                      inactive='0'
                                                      and lower(replace(form_kode, '-', '')) = '$frmkode'
                                                      and parameter = '$tipe'
                                                      and departemen = '$dept'
                                                      and tgl_efective <='$create_date') 
                                                    order by 
                                                      1")->result();

        $final = array();
        if (count($q) > 0) {
            foreach ($q as $row) {
                $q2 = $this->db1->query("select 
                                          *,
                                          'item2' dtl_level
                                        from 
                                          tblmst_formitem_dtl_b
                                        where 
                                          headerid=$row->headerid
                                          and detail_id_a=$row->detail_id
                                        order by 
                                          1")->result();
                if (count($q2) > 0) {
                    foreach ($q2 as $row2) {
                        $q3 = $this->db1->query("select 
                                                  *,
                                                  'item3' dtl_level
                                                from 
                                                  tblmst_formitem_dtl_c
                                                where 
                                                  headerid=$row->headerid
                                                  and detail_id_b=$row2->detail_id_b
                                                order by 
                                                  1")->result();
                        if (count($q3) > 0) {
                            foreach ($q3 as $row3) {
                                $q4 = $this->db1->query("select 
                                                          *,
                                                          'item4' dtl_level
                                                        from 
                                                          tblmst_formitem_dtl_d
                                                        where 
                                                          headerid=$row->headerid
                                                          and detail_id_c=$row3->detail_id_c
                                                        order by 
                                                          1")->result();
                                if (count($q4) > 0) {
                                    $row3->children3 = $q4;
                                }
                            }
                            $row2->children2 = $q3;
                        }
                    }
                    $row->children = $q2;
                }
                array_push($final, $row);
            }
        }
        return $final;
    }

    function get_list_pj($create_date, $formkd)
    {
        return $this->db1->query("select 
                                    * 
                                  from 
                                    tblmst_penanggung_jawab a
                                  join
                                    tblmst_penanggung_jawab_dtl b
                                    on a.headerid=b.headerid
                                  where 
                                    a.inactive='0' 
                                    and b.inactive='0' 
                                    and form_kode='$formkd' 
                                    and tgl_efektif in (select 
                                                      max(tgl_efektif) 
                                                    from 
                                                      tblmst_penanggung_jawab 
                                                    where 
                                                      inactive='0' 
                                                      and form_kode='$formkd'
                                                      and tgl_efektif <='$create_date') 
                                  order by 
                                    nama")->result();
    }

    function get_pj_by($detail_id)
    {
        return $this->db1->query("select 
                                    * 
                                  from 
                                    tblmst_penanggung_jawab a
                                  join
                                    tblmst_penanggung_jawab_dtl b
                                    on a.headerid=b.headerid
                                  where 
                                    b.detail_id='$detail_id'")->row();
    }

    function get_all_komponenmesin($deptabbr)
    {
        $arr_deptabbr = (explode(',', $deptabbr));
        $str_deptabbr = "'" . implode("','", $arr_deptabbr) . "'";

        $this->db1->from('tblmstkomponenmesin');
        $this->db1->where('deptabbr IN (' . $str_deptabbr . ')');
        $this->db1->order_by('komponen_id', 'asc');
        $query = $this->db1->get()->result();
        return $query;
    }

    function get_all_komponenmesin_trafo()
    {
        return $this->db1->query("	WITH RankedData AS (
                                                SELECT
                                                    b.*,
                                                    C.*,
                                                    ROW_NUMBER() OVER (PARTITION BY b.item1 ORDER BY b.item1) AS no_urut_asc_raw,
                                                    ROW_NUMBER() OVER (PARTITION BY b.item1 ORDER BY b.detail_id DESC) AS no_urut_desc_raw,
                                                    COUNT(*) OVER (PARTITION BY b.item1) AS total_rows_in_partition
                                                FROM
                                                    tblmstformitemmesin_hdr A
                                                LEFT JOIN tblmstformitemmesin_dtl b ON A.headerid = b.headerid
                                                LEFT JOIN tblmstformitemmesin_dtl_b C ON A.headerid = C.headerid  and b.detail_id = c.detail_id_a
                                                WHERE
                                                    A.departemen = 'WTD' 
                                                    AND A.PARAMETER = 'Tipe 1' 
                                                    AND A.form_kode = 'INT-WTD-009'
                                            )
                                            SELECT
                                                *,
                                                no_urut_asc_raw AS no_urut_asc,
                                                total_rows_in_partition - no_urut_desc_raw + 1 AS no_urut_desc
                                            FROM
                                                RankedData
                                ")->result();
    }

    function get_all_komponenpanel($deptabbr)
    {
        $arr_deptabbr = (explode(',', $deptabbr));
        $str_deptabbr = "'" . implode("','", $arr_deptabbr) . "'";

        $this->db1->from('tblmstkomponenmesin');
        $this->db1->where('deptabbr IN (' . $str_deptabbr . ')');
        $this->db1->order_by('komponen_id', 'asc');
        $query = $this->db1->get()->result();
        return $query;
    }
    function get_records_payroll($deptabbr)
    {

        $arr_deptabbr = (explode(',', $deptabbr));
        $str_deptabbr = "'" . implode("','", $arr_deptabbr) . "'";
        return json_decode($this->curl->simple_get(setAPI() . "p1_get_all_departemen_byakses2/" . $str_deptabbr));
    }

    // get specific for form
    function get_spek_forminput($up_create_date, $parameter, $tipe_contoh, $jenis_produk, $form_kode, $form_versi)
    { //seleksi per parameter
        $query = $this->db1->query("select 
                                        a.tgl_start as tgl_efective,
                                        a.formula,
                                        b.parameter,
                                        b.spec_min,
                                        b.spec_max,
                                        b.status_analisa
                                    from 
                                        tblmst_productspec_hdr as a
                                    full join 
                                        tblmst_productspec_dtl as b
                                            on a.headerid=b.headerid
                                    where 
                                        b.parameter='$parameter'
                                        and ((a.form_kode='$form_kode' and a.form_versi='$form_versi') OR (a.tipe_contoh='$tipe_contoh' and a.jenis_produk='$jenis_produk'))
                                        and b.status_analisa='Active'
                                        and a.headerid  in (select max(headerid) from tblmst_productspec_hdr where ((form_kode='$form_kode' and form_versi='$form_versi') OR (tipe_contoh='$tipe_contoh' and jenis_produk='$jenis_produk')) and tgl_start is not null and tgl_start <= '$up_create_date' group by formula ORDER BY max(headerid) ASC)
                                    order by
                                        b.parameter,
                                        a.formula");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    function get_spek_form($up_create_date, $parameter, $tipe_contoh, $jenis_produk, $form_kode, $form_versi)
    { //seleksi per parameter
        $query = $this->db1->query("select 
                                        a.tgl_start as tgl_efective,
                                        a.formula,
                                        b.parameter,
                                        b.spec_min,
                                        b.spec_max,
                                        b.status_analisa
                                    from 
                                        tblmst_productspec_hdr as a
                                    full join 
                                        tblmst_productspec_dtl as b
                                            on a.headerid=b.headerid
                                    where 
                                        -- b.parameter='$parameter'
                                        ((a.form_kode='$form_kode' and a.form_versi='$form_versi') OR (a.tipe_contoh='$tipe_contoh' and a.jenis_produk='$jenis_produk'))
                                        and b.status_analisa='Active'
                                        and a.headerid  in (select max(headerid) from tblmst_productspec_hdr where ((form_kode='$form_kode' and form_versi='$form_versi') OR (tipe_contoh='$tipe_contoh' and jenis_produk='$jenis_produk')) and tgl_start is not null and tgl_start <= '$up_create_date' group by formula ORDER BY max(headerid) ASC)
                                    order by
                                        b.parameter,
                                        a.formula");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
}
