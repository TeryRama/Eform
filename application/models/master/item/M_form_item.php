<?php
class M_form_item extends CI_Model {
    function __construct(){
            parent:: __construct();
            $CI = &get_instance();
            $this->db1= $this->load->database('db1',TRUE);
    }


    function get_records_payroll(){
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_departemen"));
    }
    
    function get_records(){
        return $this->db1->query("select * from tblmst_formitem_hdr where inactive='0' order by tgl_efective desc")->result();
    }

    function get_dt_form(){
        return $this->db1->query("select distinct formnm from vwmst_form")->result();
    }

    function cek_spec($dtkode_form, $dtparameter, $dtdepartemen, $dttgl_efective){
        $this->db1->from('tblmst_formitem_hdr');
        $this->db1->where('form_kode', $dtkode_form);
        $this->db1->where('parameter', $dtparameter);
        $this->db1->where('departemen', $dtdepartemen);
        $this->db1->where('tgl_efective', $dttgl_efective);
        $this->db1->where('inactive', '0');
        $query = $this->db1->get();
        return $query;
    }

    function cek_spec2($dtkode_form, $dtparameter, $dtdepartemen, $dttgl_efective, $headerid){
        $this->db1->from('tblmst_formitem_hdr');
        $this->db1->where('form_kode', $dtkode_form);
        $this->db1->where('parameter', $dtparameter);
        $this->db1->where('departemen', $dtdepartemen);
        $this->db1->where('tgl_efective', $dttgl_efective);
        $this->db1->where('inactive', '0');
        $this->db1->where('headerid !=', $headerid);
        $query = $this->db1->get();
        return $query;
    }

    function insert_hdr($data_header){
        $this->db1->trans_begin();
        $query=$this->db1->insert('tblmst_formitem_hdr', $data_header);
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
            $insert_id = $this->db1->insert_id();
            return $insert_id;
        }

        return $result;
        return TRUE;
    }

    // start grup insert detail
    function insert_detail($data_detail){
        $this->db1->trans_begin();
        $query=$this->db1->insert('tblmst_formitem_dtl', $data_detail);
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

    function insert_detail_b($modal_detail){
        $this->db1->trans_begin();
        $query=$this->db1->insert('tblmst_formitem_dtl_b', $modal_detail);
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

    function insert_detail_c($modal_detail_c){
        $this->db1->trans_begin();
        $query=$this->db1->insert('tblmst_formitem_dtl_c', $modal_detail_c);
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

    function insert_detail_d($modal_detail_d){
        $this->db1->trans_begin();
        $query=$this->db1->insert('tblmst_formitem_dtl_d', $modal_detail_d);
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

    function insert_detail_e($modal_detail_e){
        $this->db1->trans_begin();
        $query=$this->db1->insert('tblmst_formitem_dtl_e', $modal_detail_e);
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
     //end grup insert detail


    function getdata_header($headerid){
    //     return $this->db1->query("select * from tblmst_formitem_hdr where inactive='0' order by tgl_efective desc")->result();
    // }

        $this->db1->from('tblmst_formitem_hdr');
        $this->db1->where('headerid', $headerid);
        $query = $this->db1->get();
        if ($query->num_rows() >0){
            return $query->result();
        }else{
            return array();
        }
    }

     //start view data detail
    function getdata_detail($headerid){
        $this->db1->from('tblmst_formitem_dtl');
        $this->db1->where('headerid', $headerid);
        $this->db1->order_by("detail_id","asc");
        $query = $this->db1->get();
        if ($query->num_rows() >0){
            return $query->result();
        }else{
            return array();
        }
    }

    function getdata_detail_b($headerid, $detail_id){
        $query = $this->db1->query("SELECT
            *
        FROM
            tblmst_formitem_dtl a
        LEFT JOIN
            tblmst_formitem_dtl_b b
            ON
                a.detail_id = b.detail_id_a
        WHERE
            a.headerid = '$headerid'
            AND a.detail_id = '$detail_id'
        ORDER BY
            b.detail_id_b ASC");

        if ($query->num_rows()>0){
            return $query->result();
        }else{
            return array();
        }
    }

    function getdata_detail_c($headerid, $detail_id_b){
        $query = $this->db1->query("SELECT
            *
        FROM
            tblmst_formitem_dtl a
        JOIN
            tblmst_formitem_dtl_b b
            ON
                a.detail_id = b.detail_id_a
        LEFT JOIN
            tblmst_formitem_dtl_c c
            ON
                b.detail_id_b = c.detail_id_b
        WHERE
            a.headerid = '$headerid'
            AND b.detail_id_b = '$detail_id_b'
        ORDER BY
            c.detail_id_c ASC");

        if ($query->num_rows() >0){
            return $query->result();
        }else{
            return array();
        }
    }

    function getdata_detail_d($headerid, $detail_id_c){
        $query = $this->db1->query("SELECT
            *
        FROM
            tblmst_formitem_dtl a
        JOIN
            tblmst_formitem_dtl_b b
            ON
                a.detail_id = b.detail_id_a
        JOIN
            tblmst_formitem_dtl_c c
            ON
                b.detail_id_b = c.detail_id_b
        LEFT JOIN
            tblmst_formitem_dtl_d d
            ON
                c.detail_id_c = d.detail_id_c
        WHERE
            a.headerid = '$headerid'
            AND c.detail_id_c = '$detail_id_c'
        ORDER BY
            d.detail_id_d ASC");

        if ($query->num_rows() >0){
            return $query->result();
        }else{
            return array();
        }
    }

    function getdata_detail_e($headerid, $detail_id_d){
        $query = $this->db1->query("SELECT
            *
        FROM
            tblmst_formitem_dtl a
        JOIN
            tblmst_formitem_dtl_b b
            ON
                a.detail_id = b.detail_id_a
        JOIN
            tblmst_formitem_dtl_c c
            ON
                b.detail_id_b = c.detail_id_b
        JOIN
            tblmst_formitem_dtl_d d
            ON
                c.detail_id_c = d.detail_id_c
        LEFT JOIN
            tblmst_formitem_dtl_e e
            ON
                d.detail_id_d = e.detail_id_d
        WHERE
            a.headerid = '$headerid'
            AND d.detail_id_d = '$detail_id_d'
        ORDER BY
            e.detail_id_e ASC");

        if ($query->num_rows() >0){
            return $query->result();
        }else{
            return array();
        }
    }

    function getdata_detail_b_view($headerid){
        $query = $this->db1->query("SELECT
            tblmst_formitem_dtl.headerid,
            tblmst_formitem_dtl.detail_id,
            tblmst_formitem_dtl.item1 AS item1_dtl,
            tblmst_formitem_dtl_b.detail_id_b,
            tblmst_formitem_dtl_b.item2 AS item2_dtl_b,
            tblmst_formitem_dtl_b.spek2,
            tblmst_formitem_dtl_b.tipe_cek2
        FROM
            tblmst_formitem_dtl
        RIGHT JOIN
            tblmst_formitem_dtl_b
            ON
                tblmst_formitem_dtl.detail_id = tblmst_formitem_dtl_b.detail_id_a
        WHERE
            tblmst_formitem_dtl.headerid = '$headerid'
        ORDER BY
            tblmst_formitem_dtl.detail_id ASC, tblmst_formitem_dtl_b.detail_id_b ASC");

        if ($query->num_rows() >0){
            return $query->result();
        }else{
            return array();
        }
    }

    function getdata_detail_c_view($headerid){
        $query = $this->db1->query("SELECT
            tblmst_formitem_dtl.headerid,
            tblmst_formitem_dtl.detail_id,
            tblmst_formitem_dtl.item1 AS item1_dtl,
            tblmst_formitem_dtl_b.detail_id_b,
            tblmst_formitem_dtl_b.item2 AS item2_dtl_b,
            tblmst_formitem_dtl_c.detail_id_c,
            tblmst_formitem_dtl_c.item3 AS item3_dtl_c,
            tblmst_formitem_dtl_c.spek3,
            tblmst_formitem_dtl_c.tipe_cek3
        FROM
            tblmst_formitem_dtl
        RIGHT JOIN
            tblmst_formitem_dtl_b
            ON
                tblmst_formitem_dtl.detail_id = tblmst_formitem_dtl_b.detail_id_a
        RIGHT JOIN
            tblmst_formitem_dtl_c
            ON
                tblmst_formitem_dtl_b.detail_id_b = tblmst_formitem_dtl_c.detail_id_b
        WHERE
            tblmst_formitem_dtl.headerid = '$headerid'
        ORDER BY
            tblmst_formitem_dtl.detail_id ASC, tblmst_formitem_dtl_b.detail_id_b ASC, tblmst_formitem_dtl_c.detail_id_c ASC");

        if ($query->num_rows() >0){
            return $query->result();
        }else{
            return array();
        }
    }

    function getdata_detail_d_view($headerid){
        $query = $this->db1->query("SELECT
            tblmst_formitem_dtl.headerid,
            tblmst_formitem_dtl.detail_id,
            tblmst_formitem_dtl.item1 AS item1_dtl,
            tblmst_formitem_dtl_b.detail_id_b,
            tblmst_formitem_dtl_b.item2 AS item2_dtl_b,
            tblmst_formitem_dtl_c.detail_id_c,
            tblmst_formitem_dtl_c.item3 AS item3_dtl_c,
            tblmst_formitem_dtl_d.detail_id_d,
            tblmst_formitem_dtl_d.item4 AS item4_dtl_d,
            tblmst_formitem_dtl_d.spek4,
            tblmst_formitem_dtl_d.tipe_cek4
        FROM
            tblmst_formitem_dtl
        RIGHT JOIN
            tblmst_formitem_dtl_b
            ON
                tblmst_formitem_dtl.detail_id = tblmst_formitem_dtl_b.detail_id_a
        RIGHT JOIN
            tblmst_formitem_dtl_c
            ON
                tblmst_formitem_dtl_b.detail_id_b = tblmst_formitem_dtl_c.detail_id_b
        RIGHT JOIN
            tblmst_formitem_dtl_d
            ON
                tblmst_formitem_dtl_c.detail_id_c = tblmst_formitem_dtl_d.detail_id_c
        WHERE
            tblmst_formitem_dtl.headerid = '$headerid'
        ORDER BY
            tblmst_formitem_dtl.detail_id ASC, tblmst_formitem_dtl_b.detail_id_b ASC, tblmst_formitem_dtl_c.detail_id_c ASC, tblmst_formitem_dtl_d.detail_id_d ASC");

        if ($query->num_rows() >0){
            return $query->result();
        }else{
            return array();
        }
    }

    function getdata_detail_e_view($headerid){
        $query = $this->db1->query("SELECT
            row_number() over(partition by tblmst_formitem_dtl.item1 order by tblmst_formitem_dtl.detail_id ASC, tblmst_formitem_dtl_b.detail_id_b ASC, tblmst_formitem_dtl_c.detail_id_c ASC, tblmst_formitem_dtl_d.detail_id_d ASC, tblmst_formitem_dtl_e.detail_id_e ASC) rnum,
            row_number() over(partition by tblmst_formitem_dtl_b.item2 order by tblmst_formitem_dtl.detail_id ASC, tblmst_formitem_dtl_b.detail_id_b ASC, tblmst_formitem_dtl_c.detail_id_c ASC, tblmst_formitem_dtl_d.detail_id_d ASC, tblmst_formitem_dtl_e.detail_id_e ASC) rnum2,
            row_number() over(partition by tblmst_formitem_dtl_c.item3 order by tblmst_formitem_dtl.detail_id ASC, tblmst_formitem_dtl_b.detail_id_b ASC, tblmst_formitem_dtl_c.detail_id_c ASC, tblmst_formitem_dtl_d.detail_id_d ASC, tblmst_formitem_dtl_e.detail_id_e ASC) rnum3,
            row_number() over(partition by tblmst_formitem_dtl_d.item4 order by tblmst_formitem_dtl.detail_id ASC, tblmst_formitem_dtl_b.detail_id_b ASC, tblmst_formitem_dtl_c.detail_id_c ASC, tblmst_formitem_dtl_d.detail_id_d ASC, tblmst_formitem_dtl_e.detail_id_e ASC) rnum4,
            row_number() over(partition by tblmst_formitem_dtl_e.item5 order by tblmst_formitem_dtl.detail_id ASC, tblmst_formitem_dtl_b.detail_id_b ASC, tblmst_formitem_dtl_c.detail_id_c ASC, tblmst_formitem_dtl_d.detail_id_d ASC, tblmst_formitem_dtl_e.detail_id_e ASC) rnum5,
            tblmst_formitem_dtl.headerid,
            tblmst_formitem_dtl.detail_id,
            tblmst_formitem_dtl.item1 AS item1_dtl,
            tblmst_formitem_dtl.spek1,
            tblmst_formitem_dtl.tipe_cek1,
            tblmst_formitem_dtl_b.detail_id_b,
            tblmst_formitem_dtl_b.item2 AS item2_dtl_b,
            tblmst_formitem_dtl_b.spek2,
            tblmst_formitem_dtl_b.tipe_cek2,
            tblmst_formitem_dtl_c.detail_id_c,
            tblmst_formitem_dtl_c.item3 AS item3_dtl_c,
            tblmst_formitem_dtl_c.spek3,
            tblmst_formitem_dtl_c.tipe_cek3,
            tblmst_formitem_dtl_d.detail_id_d,
            tblmst_formitem_dtl_d.item4 AS item4_dtl_d,
            tblmst_formitem_dtl_d.spek4,
            tblmst_formitem_dtl_d.tipe_cek4,
            tblmst_formitem_dtl_e.detail_id_e,
            tblmst_formitem_dtl_e.item5 AS item5_dtl_e,
            tblmst_formitem_dtl_e.spek5,
            tblmst_formitem_dtl_e.tipe_cek5
        FROM
            tblmst_formitem_dtl
        FULL JOIN
            tblmst_formitem_dtl_b
            ON
                tblmst_formitem_dtl.detail_id = tblmst_formitem_dtl_b.detail_id_a
        FULL JOIN
            tblmst_formitem_dtl_c
            ON
                tblmst_formitem_dtl_b.detail_id_b = tblmst_formitem_dtl_c.detail_id_b
        FULL JOIN
            tblmst_formitem_dtl_d
            ON
                tblmst_formitem_dtl_c.detail_id_c = tblmst_formitem_dtl_d.detail_id_c
        FULL JOIN
            tblmst_formitem_dtl_e
            ON
                tblmst_formitem_dtl_d.detail_id_d = tblmst_formitem_dtl_e.detail_id_d
        WHERE
            tblmst_formitem_dtl.headerid = '$headerid'
        ORDER BY
            tblmst_formitem_dtl.detail_id ASC, tblmst_formitem_dtl_b.detail_id_b ASC, tblmst_formitem_dtl_c.detail_id_c ASC, tblmst_formitem_dtl_d.detail_id_d ASC, tblmst_formitem_dtl_e.detail_id_e ASC");

        if ($query->num_rows() >0){
            return $query->result();
        }else{
            return array();
        }
    }
    //end view data detail

    //grup update data
    function update_hdr($headerid, $data_header){
        $this->db1->trans_begin();
        $this->db1->where('headerid', $headerid);
        $this->db1->update('tblmst_formitem_hdr', $data_header);
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

    function update_dtl($detailid, $data_detail){
        $this->db1->trans_begin();
        $this->db1->set($data_detail);
        $this->db1->where('detail_id', $detailid);
        $this->db1->update('tblmst_formitem_dtl', $data_detail);
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

    function update_detail_b($detailid, $modal_detail){
        $this->db1->trans_begin();
        $this->db1->set($modal_detail);
        $this->db1->where('detail_id_b', $detailid);
        $this->db1->update('tblmst_formitem_dtl_b', $modal_detail);
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

    function update_detail_c($detailid_c, $modal_detail_c){
        $this->db1->trans_begin();
        $this->db1->set($modal_detail_c);
        $this->db1->where('detail_id_c', $detailid_c);
        $this->db1->update('tblmst_formitem_dtl_c', $modal_detail_c);
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

    function update_detail_d($detailid_d, $modal_detail_d){
        $this->db1->trans_begin();
        $this->db1->set($modal_detail_d);
        $this->db1->where('detail_id_d', $detailid_d);
        $this->db1->update('tblmst_formitem_dtl_d', $modal_detail_d);
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

    function update_detail_e($detailid_e, $modal_detail_e){
        $this->db1->trans_begin();
        $this->db1->set($modal_detail_e);
        $this->db1->where('detail_id_e', $detailid_e);
        $this->db1->update('tblmst_formitem_dtl_e', $modal_detail_e);
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
    // end grup update data


    function delete_detail($detail_id){
        $this->db1->trans_begin();
        $this->db1->delete('tblmst_formitem_dtl', "detail_id = '$detail_id'");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $detail_result = 0;
        } else {
            $this->db1->trans_commit();
            $detail_result = 1;
        }

        return $detail_result;
    }

    function delete_header($headerid){
        $this->db1->trans_begin();
        $this->db1->delete('tblmst_formitem_hdr', "headerid = '$headerid'");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $header_result = 0;
        } else {
            $this->db1->trans_commit();
            $header_result = 1;
        }

        return $header_result;
    }


    //start grup delete data detail in modal
    function modal_delete_detail($modal_detail_id){
        $this->db1->trans_begin();
        $this->db1->delete('tblmst_formitem_dtl_b', "detail_id_b = '$modal_detail_id'");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $detail_result = 0;
        } else {
            $this->db1->trans_commit();
            $detail_result = 1;
        }

        return $detail_result;
    }

    function modal_delete_detail_c($modal_detail_id_c){
        $this->db1->trans_begin();
        $this->db1->delete('tblmst_formitem_dtl_c', "detail_id_c = '$modal_detail_id_c'");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $detail_result = 0;
        } else {
            $this->db1->trans_commit();
            $detail_result = 1;
        }

        return $detail_result;
    }

    function modal_delete_detail_d($modal_detail_id_d){
        $this->db1->trans_begin();
        $this->db1->delete('tblmst_formitem_dtl_d', "detail_id_d = '$modal_detail_id_d'");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $detail_result = 0;
        } else {
            $this->db1->trans_commit();
            $detail_result = 1;
        }

        return $detail_result;
    }

    function modal_delete_detail_e($modal_detail_id_e){
        $this->db1->trans_begin();
        $this->db1->delete('tblmst_formitem_dtl_e', "detail_id_e = '$modal_detail_id_e'");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $detail_result = 0;
        } else {
            $this->db1->trans_commit();
            $detail_result = 1;
        }

        return $detail_result;
    }
    //start grup delete data detail in modal


    // function getParameter($tipe_contoh){
    //     $query = $this->db1->query("select * from tblmst_parameter_pengujian where tipe_contoh='$tipe_contoh' order by parameter asc");

    //     if($query->num_rows()>0){
    //         return $query->result();
    //     }else{
    //         return array();
    //     }
    // }

    // function getParameter_all($tipe_contoh){
    //     $query = $this->db1->query("select * from tblmst_parameter_pengujian where tipe_contoh='$tipe_contoh' order by parameter asc");

    //     if($query->num_rows()>0){
    //         return $query->result();
    //     }else{
    //         return array();
    //     }
    // }

    function copy_detail_b($headerid, $datadetail){
        $query = $this->db1->query("insert into tblmst_formitem_dtl_b select * from tblmst_formitem_dtl_b where headerid='$headerid' and detail_id_b='$datadetail'");
        return $query;
    }

    function copy_detail_b2($headerid, $datadetail, $maxid, $max_detail_id){
        $query = $this->db1->query("insert into tblmst_formitem_dtl_b (item2, headerid, detail_id_a) select item2, '$maxid', '$max_detail_id' from tblmst_formitem_dtl_b where headerid='$headerid' and detail_id_a='$datadetail'");
        return $query;
    }

    function copy_detail_c2($headerid, $datadetail, $maxid, $max_detail_id_c){
        $query = $this->db1->query("insert into tblmst_formitem_dtl_c (item3, headerid, detail_id_b) select item3, '$maxid', '$max_detail_id_c' from tblmst_formitem_dtl_c where headerid='$headerid' and detail_id_b='$datadetail'");
        return $query;
    }

    function cek_dolo($detail_id_b){
        if($detail_id_b == ''){
            $detail_crot = "where detail_id_b = '$detail_id_b'";
        }else{
            $detail_crot = "";
        }

        $query = $this->db1->query("SELECT detail_id_b from tblmst_formitem_dtl_b $detail_crot");
        return $query->result();
    }

    function get_all_item($headerid) {
        $q = $this->db1->query("SELECT * FROM tblmst_formitem_dtl WHERE headerid='$headerid' ORDER BY detail_id ASC");
        $final = array();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $q2 = $this->db1->query("SELECT * FROM tblmst_formitem_dtl_b WHERE headerid='".$row->headerid."' AND detail_id_a='".$row->detail_id."' ORDER BY detail_id_b ASC");
                if ($q2->num_rows() > 0) {
                    foreach ($q2->result() as $row2) {
                        $q3 = $this->db1->query("SELECT * FROM tblmst_formitem_dtl_c WHERE headerid='".$row->headerid."' AND detail_id_b='".$row2->detail_id_b."' ORDER BY detail_id_c ASC");
                        if ($q3->num_rows() > 0) {
                            foreach ($q3->result() as $row3) {
                                $q4 = $this->db1->query("SELECT * FROM tblmst_formitem_dtl_d WHERE headerid='".$row->headerid."' AND detail_id_c='".$row3->detail_id_c."' ORDER BY detail_id_d ASC");
                                if ($q4->num_rows() > 0) {
                                    foreach ($q4->result() as $row4) {
                                        $q5 = $this->db1->query("SELECT * FROM tblmst_formitem_dtl_e WHERE headerid='".$row->headerid."' AND detail_id_d='".$row4->detail_id_d."' ORDER BY detail_id_e ASC");
                                        if ($q5->num_rows() > 0) {
                                            $row4->children4 = $q5->result();
                                        }
                                    }
                                    $row3->children3 = $q4->result();
                                }
                            }
                            $row2->children2 = $q3->result();
                        }else{}
                    }
                    $row->children = $q2->result();
                }else{}

                array_push($final, $row);
            }
        }
        return $final;
    }

} ?>