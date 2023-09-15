<?php

class M_forminttbn040_01 extends CI_Model {

    var $table1  = 'tblfrminttbn040hdr';
    var $table2  = 'tblfrminttbn040dtl';
    var $table3  = 'tblfrminttbn040dtlx';
    var $table4  = 'tblfrminttbn040dtl_b';
    var $table5  = 'tblfrminttbn040dtl_bx';
    var $table6  = 'tblfrminttbn040dtl_c';
    var $table7  = 'tblfrminttbn040dtl_cx';
    var $table8  = 'tblfrminttbn040dtl_d';
    var $table9  = 'tblfrminttbn040dtl_dx';
    var $table10 = 'tblfrminttbn040dtl_e';
    var $table11 = 'tblfrminttbn040dtl_ex';
    var $table12 = 'tblfrminttbn040dtl_f';
    var $table13 = 'tblfrminttbn040dtl_fx';
    var $table14 = 'tblfrminttbn040dtl_g';
    var $table15 = 'tblfrminttbn040dtl_gx';

    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
        $this->db2 = $this->load->database('db2', TRUE);
    }

    /// get data group

    function get_docno($bulan, $tahun)
    {
        return $this->db1->query("select 
                                    docno
                                  from 
                                    $this->table1 
                                  where 
                                    extract(month from create_date)='$bulan'
                                    and extract(year from create_date)='$tahun'")->row();
    }


    function get_list_item($tipe, $create_date)
    {
        $q = $this->db1->query("SELECT
                                    ROW_NUMBER ( ) OVER ( PARTITION BY item1 ORDER BY D.detail_id_c ASC ) AS nourut,
                                    ROW_NUMBER ( ) OVER ( PARTITION BY item1 ORDER BY D.detail_id_c DESC ) AS nourutdesc,
                                    *,
                                    'item2' dtl_level
                                FROM
                                    tblmst_formitem_hdr
                                    A JOIN tblmst_formitem_dtl b ON A.headerid = b.headerid
                                    LEFT JOIN tblmst_formitem_dtl_b C ON A.headerid = C.headerid
                                    AND b.detail_id = C.detail_id_a
                                    LEFT JOIN tblmst_formitem_dtl_c D ON A.headerid = D.headerid
                                    AND C.detail_id_b = D.detail_id_b
                                WHERE
                                    A.inactive = '0'
                                    AND form_kode = 'INT-TBN-040'
                                    AND PARAMETER = '$tipe'
                                    AND departemen = 'PWP'
                                    AND tgl_efective IN (
                                    SELECT MAX
                                        ( tgl_efective )
                                    FROM
                                        tblmst_formitem_hdr
                                    WHERE
                                        inactive = '0'
                                        AND form_kode = 'INT-TBN-040'
                                        AND PARAMETER = '$tipe'
                                        AND departemen = 'PWP'
                                        AND tgl_efective <= '$create_date'
                                    )
                                ORDER BY
                                    D.detail_id_c")->result();
                                    return $q;
    }


    function get_user()
    {
        $q = $this->db2->query("SELECT * FROM tblmst_user WHERE id_dept = '69' AND inactive = '0'")->result(); return $q;
    }

    function get_user_by($user_id)
    {
        $q = $this->db2->query("SELECT * FROM tblmst_user WHERE id_dept = '69' AND inactive = '0' AND userid = '$user_id'")->result(); return $q;
    }

    
    function get_list_pj($create_date)
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
                                    and form_kode ='INT-TBN-040' 
                                    and tgl_efektif in (select 
                                                      max(tgl_efektif) 
                                                    from 
                                                      tblmst_penanggung_jawab 
                                                    where 
                                                      inactive='0' 
                                                      and form_kode ='INT-TBN-040'
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

    function check($create_date, $docno)
    {
        $this->db1->from($this->table1);
        $this->db1->where('create_date', $create_date);
        $this->db1->where('docno', $docno);
        $query = $this->db1->get();
        return $query;
    }

    function insert_dtheader($data5)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->table1, $data5);
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

    function check2($create_date, $docno, $headerid)
    {
        $this->db1->from($this->table1);
        $this->db1->where('create_date', $create_date);
        $this->db1->where('docno', $docno);
        $this->db1->where('headerid !=', $headerid);
        $query = $this->db1->get();
        return $query;
    }

    function cek_stdetail($headerid)
    {
        $this->db1->from($this->table1);
        $this->db1->where('headerid', $headerid);
        $this->db1->where('status_detail', '1');
        $query = $this->db1->get();
        return $query;
    }

    function cek_stdetailx($headerid)
    {
        $this->db1->from($this->table1);
        $this->db1->where('headerid', $headerid);
        $this->db1->where('status_detailx', '1');
        $query = $this->db1->get();
        return $query;
    }

    function update_hdr($headerid, $data5)
    {
        $this->db1->trans_begin();
        $this->db1->where('headerid', $headerid);
        $this->db1->update($this->table1, $data5);
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

    function insert_detail($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->table2, $data6);
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

    function insert_detailb($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->table4, $data6);
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

    function insert_detailc($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->table6, $data6);
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

    function insert_detaild($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->table8, $data6);
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

    function insert_detaile($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->table10, $data6);
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

    function insert_detailf($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->table12, $data6);
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

    function insert_detailg($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->table14, $data6);
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

    
    function update_dtl($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table2, $data6);
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

    function update_dtlb($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table4, $data6);
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

    function update_dtlc($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table6, $data6);
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

    function update_dtld($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table8, $data6);
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

    function update_dtle($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table10, $data6);
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

    function update_dtlf($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table12, $data6);
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

    function update_dtlg($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table14, $data6);
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

    function update_dtlx($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table3, $data6);
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

    function update_dtlbx($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table5, $data6);
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

    function update_dtlcx($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table7, $data6);
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

    function update_dtldx($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table9, $data6);
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

    function update_dtlex($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table11, $data6);
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

    function update_dtlfx($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table13, $data6);
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

    function update_dtlgx($datadetail, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $datadetail);
        $this->db1->update($this->table15, $data6);
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

    function new_insert2_dtlx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table3
            (   
                detail_id,
                stdtl,
                headerid,
                jam1,
                pressure_1,
                h566,
                jam2,
                pressure2,
                ph_bilas,
                jam3,
                pressure3,
                h277,
                jam4,
                pressure4,
                ph_bilas4
            )
            SELECT
                b.detail_id,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.jam1,
                b.pressure_1,
                b.h566,
                b.jam2,
                b.pressure2,
                b.ph_bilas,
                b.jam3,
                b.pressure3,
                b.h277,
                b.jam4,
                b.pressure4,
                b.ph_bilas4
            FROM
                $this->table2 AS b LEFT JOIN $this->table3 AS bx ON b.detail_id = bx.detail_id
            WHERE bx.detail_id IS NULL AND b.headerid = $id ORDER BY b.detail_id ASC"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function insert_detailx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table3
            (
                detail_id,
                stdtl,
                headerid,
                jam1,
                pressure_1,
                h566,
                jam2,
                pressure2,
                ph_bilas,
                jam3,
                pressure3,
                h277,
                jam4,
                pressure4,
                ph_bilas4
            )
            SELECT
                b.detail_id,
                    CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.jam1,
                b.pressure_1,
                b.h566,
                b.jam2,
                b.pressure2,
                b.ph_bilas,
                b.jam3,
                b.pressure3,
                b.h277,
                b.jam4,
                b.pressure4,
                b.ph_bilas4
            FROM
                $this->table2 AS b
            where b.headerid='$id' order by b.detail_id asc"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }
    
    function new_insert2_dtlbx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table5
            (   
                detail_id,
                stdtl,
                headerid,
                flow_awal,
                flow_akhir,
                total,
                formula
            )
            SELECT
                b.detail_id,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.flow_awal,
                b.flow_akhir,
                b.total,
                b.formula
            FROM
                $this->table5 AS b LEFT JOIN $this->table4 AS bx ON b.detail_id = bx.detail_id
            WHERE bx.detail_id IS NULL AND b.headerid = $id ORDER BY b.detail_id ASC"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function insert_detailbx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table5
            (
                detail_id,
                stdtl,
                headerid,
                flow_awal,
                flow_akhir,
                total,
                formula
            )
            SELECT
                b.detail_id,
                    CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.flow_awal,
                b.flow_akhir,
                b.total,
                b.formula
            FROM
                $this->table4 AS b
            where b.headerid='$id' order by b.detail_id asc"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function new_insert2_dtlcx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table7
            (   
                detail_id,
                stdtl,
                headerid,
                jam,
                uraian,
                tindakan,
                pj_id,
                keterangan
            )
            SELECT
                b.detail_id,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.jam,
                b.uraian,
                b.tindakan,
                b.pj_id,
                b.keterangan
            FROM
                $this->table7 AS b LEFT JOIN $this->table6 AS bx ON b.detail_id = bx.detail_id
            WHERE bx.detail_id IS NULL AND b.headerid = $id ORDER BY b.detail_id ASC"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function insert_detailcx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table7
            (
                detail_id,
                stdtl,
                headerid,
                jam,
                uraian,
                tindakan,
                pj_id,
                keterangan
            )
            SELECT
                b.detail_id,
                    CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.jam,
                b.uraian,
                b.tindakan,
                b.pj_id,
                b.keterangan
            FROM
                $this->table6 AS b
            where b.headerid='$id' order by b.detail_id asc"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function new_insert2_dtldx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table9
            (   
                detail_id,
                stdtl,
                headerid,
                nama_mesin,
                kode_mesin,
                parameter,
                dtl_opr1,
                dtl_opr2,
                dtl_opr3,
                dtl_opr4,
                dtl_opr5,
                dtl_opr6,
                dtl_opr7,
                dtl_opr8,
                dtl_opr9,
                dtl_opr10,
                dtl_opr11,
                dtl_opr12,
                dtl_opr13,
                dtl_opr14,
                dtl_opr15,
                dtl_opr16,
                dtl_opr17,
                dtl_opr18,
                dtl_opr19,
                dtl_opr20,
                dtl_opr21,
                dtl_opr22,
                dtl_opr23,
                dtl_opr24,
                dtl_opr25,
                dtl_opr26,
                dtl_opr27,
                dtl_opr28,
                dtl_opr29,
                dtl_opr30,
                dtl_opr31,
                dtl_opr32,
                dtl_opr33,
                dtl_opr34
            )
            SELECT
                b.detail_id,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.nama_mesin,
                b.kode_mesin,
                b.parameter,
                b.dtl_opr1,
                b.dtl_opr2,
                b.dtl_opr3,
                b.dtl_opr4,
                b.dtl_opr5,
                b.dtl_opr6,
                b.dtl_opr7,
                b.dtl_opr8,
                b.dtl_opr9,
                b.dtl_opr10,
                b.dtl_opr11,
                b.dtl_opr12,
                b.dtl_opr13,
                b.dtl_opr14,
                b.dtl_opr15,
                b.dtl_opr16,
                b.dtl_opr17,
                b.dtl_opr18,
                b.dtl_opr19,
                b.dtl_opr20,
                b.dtl_opr21,
                b.dtl_opr22,
                b.dtl_opr23,
                b.dtl_opr24,
                b.dtl_opr25,
                b.dtl_opr26,
                b.dtl_opr27,
                b.dtl_opr28,
                b.dtl_opr29,
                b.dtl_opr30,
                b.dtl_opr31,
                b.dtl_opr32,
                b.dtl_opr33,
                b.dtl_opr34
            FROM
                $this->table9 AS b LEFT JOIN $this->table8 AS bx ON b.detail_id = bx.detail_id
            WHERE bx.detail_id IS NULL AND b.headerid = $id ORDER BY b.detail_id ASC"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function insert_detaildx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table9
            (
                detail_id,
                stdtl,
                headerid,
                nama_mesin,
                kode_mesin,
                parameter,
                dtl_opr1,
                dtl_opr2,
                dtl_opr3,
                dtl_opr4,
                dtl_opr5,
                dtl_opr6,
                dtl_opr7,
                dtl_opr8,
                dtl_opr9,
                dtl_opr10,
                dtl_opr11,
                dtl_opr12,
                dtl_opr13,
                dtl_opr14,
                dtl_opr15,
                dtl_opr16,
                dtl_opr17,
                dtl_opr18,
                dtl_opr19,
                dtl_opr20,
                dtl_opr21,
                dtl_opr22,
                dtl_opr23,
                dtl_opr24,
                dtl_opr25,
                dtl_opr26,
                dtl_opr27,
                dtl_opr28,
                dtl_opr29,
                dtl_opr30,
                dtl_opr31,
                dtl_opr32,
                dtl_opr33,
                dtl_opr34
            )
            SELECT
                b.detail_id,
                    CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.nama_mesin,
                b.kode_mesin,
                b.parameter,
                b.dtl_opr1,
                b.dtl_opr2,
                b.dtl_opr3,
                b.dtl_opr4,
                b.dtl_opr5,
                b.dtl_opr6,
                b.dtl_opr7,
                b.dtl_opr8,
                b.dtl_opr9,
                b.dtl_opr10,
                b.dtl_opr11,
                b.dtl_opr12,
                b.dtl_opr13,
                b.dtl_opr14,
                b.dtl_opr15,
                b.dtl_opr16,
                b.dtl_opr17,
                b.dtl_opr18,
                b.dtl_opr19,
                b.dtl_opr20,
                b.dtl_opr21,
                b.dtl_opr22,
                b.dtl_opr23,
                b.dtl_opr24,
                b.dtl_opr25,
                b.dtl_opr26,
                b.dtl_opr27,
                b.dtl_opr28,
                b.dtl_opr29,
                b.dtl_opr30,
                b.dtl_opr31,
                b.dtl_opr32,
                b.dtl_opr33,
                b.dtl_opr34
            FROM
                $this->table8 AS b
            where b.headerid='$id' order by b.detail_id asc"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function new_insert2_dtlex($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table11
            (   
                detail_id,
                stdtl,
                headerid,
                shift_e,
                soft_awal,
                soft_akhir,
                soft_total,
                pro_awal,
                pro_akhir,
                pro_total
            )
            SELECT
                b.detail_id,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.shift_e,
                b.soft_awal,
                b.soft_akhir,
                b.soft_total,
                b.pro_awal,
                b.pro_akhir,
                b.pro_total
            FROM
                $this->table11 AS b LEFT JOIN $this->table10 AS bx ON b.detail_id = bx.detail_id
            WHERE bx.detail_id IS NULL AND b.headerid = $id ORDER BY b.detail_id ASC"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function insert_detailex($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table11
            (
                detail_id,
                stdtl,
                headerid,
                shift_e,
                soft_awal,
                soft_akhir,
                soft_total,
                pro_awal,
                pro_akhir,
                pro_total
            )
            SELECT
                b.detail_id,
                    CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.shift_e,
                b.soft_awal,
                b.soft_akhir,
                b.soft_total,
                b.pro_awal,
                b.pro_akhir,
                b.pro_total
            FROM
                $this->table10 AS b
            where b.headerid='$id' order by b.detail_id asc"
        );
    }

    function new_insert2_dtlfx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table13
            (   
                detail_id,
                stdtl,
                headerid,
                shift_f,
                no_pompa,
                feed_awal,
                feed_akhir,
                feed_total,
                product_flow,
                product_waktu,
                product_total,
                reject_flow,
                reject_waktu,
                reject_total
            )
            SELECT
                b.detail_id,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.shift_f,
                b.no_pompa,
                b.feed_awal,
                b.feed_akhir,
                b.feed_total,
                b.product_flow,
                b.product_waktu,
                b.product_total,
                b.reject_flow,
                b.reject_waktu,
                b.reject_total
            FROM
                $this->table13 AS b LEFT JOIN $this->table12 AS bx ON b.detail_id = bx.detail_id
            WHERE bx.detail_id IS NULL AND b.headerid = $id ORDER BY b.detail_id ASC"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function insert_detailfx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table13
            (
                detail_id,
                stdtl,
                headerid,
                shift_f,
                no_pompa,
                feed_awal,
                feed_akhir,
                feed_total,
                product_flow,
                product_waktu,
                product_total,
                reject_flow,
                reject_waktu,
                reject_total
            )
            SELECT
                b.detail_id,
                    CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.shift_f,
                b.no_pompa,
                b.feed_awal,
                b.feed_akhir,
                b.feed_total,
                b.product_flow,
                b.product_waktu,
                b.product_total,
                b.reject_flow,
                b.reject_waktu,
                b.reject_total
            FROM
                $this->table12 AS b
            where b.headerid='$id' order by b.detail_id asc"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function new_insert2_dtlgx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table15
            (   
                detail_id,
                stdtl,
                headerid,
                jam_waktu,
                start_stop,
                feed_ph,
                feed_konduktivity,
                feed_th,
                feed_turbidity,
                feed_cl,
                feed_fcl,
                product_ph,
                product_konduktivity
            )
            SELECT
                b.detail_id,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.jam_waktu,
                b.start_stop,
                b.feed_ph,
                b.feed_konduktivity,
                b.feed_th,
                b.feed_turbidity,
                b.feed_cl,
                b.feed_fcl,
                b.product_ph,
                b.product_konduktivity
            FROM
                $this->table15 AS b LEFT JOIN $this->table14 AS bx ON b.detail_id = bx.detail_id
            WHERE bx.detail_id IS NULL AND b.headerid = $id ORDER BY b.detail_id ASC"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function insert_detailgx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->table15
            (
                detail_id,
                stdtl,
                headerid,
                jam_waktu,
                start_stop,
                feed_ph,
                feed_konduktivity,
                feed_th,
                feed_turbidity,
                feed_cl,
                feed_fcl,
                product_ph,
                product_konduktivity
            )
            SELECT
                b.detail_id,
                    CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.jam_waktu,
                b.start_stop,
                b.feed_ph,
                b.feed_konduktivity,
                b.feed_th,
                b.feed_turbidity,
                b.feed_cl,
                b.feed_fcl,
                b.product_ph,
                b.product_konduktivity
            FROM
                $this->table14 AS b
            where b.headerid='$id' order by b.detail_id asc"
        );

        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function get_header_byid($id)
    {
        $this->db1->from($this->table1);
        $this->db1->where('headerid', $id);
        $query = $this->db1->get();
        if ($query->num_rows() == 1) {
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
    
    function get_detail_byidx($id)
    {
        $this->db1->from($this->table3);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byidb($id)
    {
        $this->db1->from($this->table4);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byidbx($id)
    {
        $this->db1->from($this->table5);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byidc($id)
    {
        $this->db1->from($this->table6);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byidcx($id)
    {
        $this->db1->from($this->table7);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byidd($id)
    {
        $this->db1->from($this->table8);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byiddx($id)
    {
        $this->db1->from($this->table9);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byide($id)
    {
        $this->db1->from($this->table10);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byidex($id)
    {
        $this->db1->from($this->table11);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byidf($id)
    {
        $this->db1->from($this->table12);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byidfx($id)
    {
        $this->db1->from($this->table13);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byidg($id)
    {
        $this->db1->from($this->table14);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byidgx($id)
    {
        $this->db1->from($this->table15);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function update_stdtl($chk)
    {
        $this->db1->trans_start();
        $this->db1->query("Update $this->table3 set stdtl='0' where detail_id ='$chk'");
        $this->db1->trans_complete();
    }

    function update_stdtlb($chk)
    {
        $this->db1->trans_start();
        $this->db1->query("Update $this->table5 set stdtl='0' where detail_id ='$chk'");
        $this->db1->trans_complete();
    }

    function update_stdtlc($chk)
    {
        $this->db1->trans_start();
        $this->db1->query("Update $this->table7 set stdtl='0' where detail_id ='$chk'");
        $this->db1->trans_complete();
    }

    function update_stdtld($chk)
    {
        $this->db1->trans_start();
        $this->db1->query("Update $this->table9 set stdtl='0' where detail_id ='$chk'");
        $this->db1->trans_complete();
    }

    function update_stdtle($chk)
    {
        $this->db1->trans_start();
        $this->db1->query("Update $this->table11 set stdtl='0' where detail_id ='$chk'");
        $this->db1->trans_complete();
    }

    function update_stdtlf($chk)
    {
        $this->db1->trans_start();
        $this->db1->query("Update $this->table13 set stdtl='0' where detail_id ='$chk'");
        $this->db1->trans_complete();
    }

    function update_stdtlg($chk)
    {
        $this->db1->trans_start();
        $this->db1->query("Update $this->table15 set stdtl='0' where detail_id ='$chk'");
        $this->db1->trans_complete();
    }

    function delete_detail($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query1 = $this->db1->delete($this->table2);
        return $query1;
    }
  
    function delete_detailx($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query2 = $this->db1->delete($this->table3);
        return $query2;
    }

    function delete_detailb($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query1 = $this->db1->delete($this->table4);
        return $query1;
    }
  
    function delete_detailbx($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query2 = $this->db1->delete($this->table5);
        return $query2;
    }

    function delete_detailc($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query1 = $this->db1->delete($this->table6);
        return $query1;
    }
  
    function delete_detailcx($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query2 = $this->db1->delete($this->table7);
        return $query2;
    }

    function delete_detaild($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query1 = $this->db1->delete($this->table8);
        return $query1;
    }
  
    function delete_detaildx($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query2 = $this->db1->delete($this->table9);
        return $query2;
    }

    function delete_detaile($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query1 = $this->db1->delete($this->table10);
        return $query1;
    }
  
    function delete_detailex($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query2 = $this->db1->delete($this->table11);
        return $query2;
    }

    function delete_detailf($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query1 = $this->db1->delete($this->table12);
        return $query1;
    }
  
    function delete_detailfx($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query2 = $this->db1->delete($this->table13);
        return $query2;
    }

    function delete_detailg($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query1 = $this->db1->delete($this->table14);
        return $query1;
    }
  
    function delete_detailgx($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query2 = $this->db1->delete($this->table15);
        return $query2;
    }

}
