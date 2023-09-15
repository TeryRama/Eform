<?php

class M_formfrmfss319_08 extends CI_Model
{

    var $tabel1  = 'tblfrmfrmfss319hdr';
    var $tabel2  = 'tblfrmfrmfss319dtl';
    var $tabel3  = 'tblfrmfrmfss319dtlx';
    var $tabel4  = 'tblfrmfrmfss319dtl_b2';
    var $tabel5  = 'tblfrmfrmfss319dtl_b2x';
    var $tabel6  = 'tblfrmfrmfss319dtl_c';
    var $tabel7  = 'tblfrmfrmfss319dtl_cx';
    var $tabel8  = 'tblfrmfrmfss319dtl_d';
    var $tabel9  = 'tblfrmfrmfss319dtl_dx';
    var $tabel10 = 'tblfrmfrmfss319dtl_b';
    var $tabel11 = 'tblfrmfrmfss319dtl_bx';

    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

    /// get data group
    function get_docno($bulan, $tahun)
    {
        return $this->db1->query("select
                                    substring(docno from '.{3}$')::float vdocno
                                  from
                                    $this->tabel1
                                  where
                                    extract(month from create_date)='$bulan'
                                    and extract(year from create_date)='$tahun'")->row();
    }

    function get_stock_temp($create_date)
    {
        return $this->db1->query("SELECT
                                    headerid,
                                    stock_awal_temp AS stock_temp,
                                    stock_akhir_tmp AS stock_akhir,
                                    create_date
                                FROM
                                    tblfrmfrmfss319hdr
                                WHERE
                                    create_date = (SELECT MAX(create_date) FROM tblfrmfrmfss319hdr)
                                    AND create_date >= to_date( '$create_date', 'yyyy-mm-01' )
                                    AND create_date <= '$create_date'
                                    ")->row();
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
                                    AND form_kode = 'FRM-FSS-319'
                                    AND PARAMETER = '$tipe'
                                    AND departemen = 'BLR'
                                    AND tgl_efective IN (
                                    SELECT MAX
                                        ( tgl_efective )
                                    FROM
                                        tblmst_formitem_hdr
                                    WHERE
                                        inactive = '0'
                                        AND form_kode = 'FRM-FSS-319'
                                        AND PARAMETER = '$tipe'
                                        AND departemen = 'BLR'
                                        AND tgl_efective <= '$create_date'
                                    )
                                ORDER BY
                                    D.detail_id_c");

        $final = array();
        if (count($q) > 0) {
            foreach ($q->result() as $row) {
                $q2 = $this->db1->query("SELECT
                                            '$create_date' :: DATE create_date,
                                            ( SUM ( COALESCE ( NULLIF ( dtlc_total_jam, '' ), '0' ) :: NUMERIC ) ) AS akumulatif_jam,
                                            ( SUM ( COALESCE ( NULLIF ( dtlc_tmpr_kg, '' ), '0' ) :: NUMERIC ) ) AS akumulatif_tempurung,
                                            ( SUM ( COALESCE ( NULLIF ( dtlc_steam_ton, '' ), '0' ) :: NUMERIC ) ) AS akumulatif_steam,
                                            ( SUM ( COALESCE ( NULLIF ( dtlc_total_air, '' ), '0' ) :: NUMERIC ) ) AS akumulatif_air
                                        FROM
                                            tblfrmfrmfss319hdr
                                            A JOIN tblfrmfrmfss319dtl_c b ON A.headerid = b.headerid
                                        WHERE
                                            A.create_date >= to_date( '$create_date', 'yyyy-mm-01' )
                                            AND A.create_date <= '$create_date'
                                            AND b.dtlc_item_id = '$row->detail_id_a'");

                if (count($q2) > 0) {
                    $row->children = $q2->result();
                }
                array_push($final, $row);
            }
            return $final;
            // return $q;
        }
    }


    function get_list_item2($tipe, $create_date)
    {
        // $q = $this->db1->query("SELECT
        $q = $this->db1->query("SELECT
                                    *,
                                    'item1' dtl_level
                                FROM
                                    tblmst_formitem_hdr
                                    A JOIN tblmst_formitem_dtl b ON A.headerid = b.headerid
                                WHERE
                                    A.inactive = '0'
                                    AND form_kode = 'FRM-FSS-319'
                                    AND PARAMETER = '$tipe'
                                    AND departemen = 'BLR'
                                    AND tgl_efective IN (
                                    SELECT MAX
                                        ( tgl_efective )
                                    FROM
                                        tblmst_formitem_hdr
                                    WHERE
                                        inactive = '0'
                                        AND form_kode = 'FRM-FSS-319'
                                        AND PARAMETER = '$tipe'
                                        AND departemen = 'BLR'
                                        AND tgl_efective <= '$create_date'
                                    )
                                ORDER BY
                                    b.detail_id");

        $final = array();
        if (count($q) > 0) {
            foreach ($q->result() as $row) {
                $q2 = $this->db1->query("SELECT
                                            '$create_date' :: DATE create_date,
                                            ( SUM ( COALESCE ( NULLIF ( dtlb_penerimaan_kg, '' ), '0' ) :: NUMERIC ) ) AS akm_penerimaan,
                                            ( SUM ( COALESCE ( NULLIF ( dtlb_pemakaian_kg, '' ), '0' ) :: NUMERIC ) ) AS akm_pemakaian
                                        FROM
                                            tblfrmfrmfss319hdr
                                            A JOIN tblfrmfrmfss319dtl_b b ON A.headerid = b.headerid
                                        WHERE
                                            A.create_date >= to_date( '$create_date', 'yyyy-mm-01' )
                                            AND A.create_date <= '$create_date'
                                            AND b.dtlb_item_id = '$row->detail_id'");

                if (count($q2) > 0) {
                    $row->children = $q2->result();
                }
                array_push($final, $row);
            }
            return $final;
            // return $q;
        }
    }

    function get_list_item3($tipe, $create_date)
    {
        $q = $this->db1->query("SELECT
                                    *,
                                    'item1' dtl_level
                                FROM
                                    tblmst_formitem_hdr
                                    A JOIN tblmst_formitem_dtl b ON A.headerid = b.headerid
                                WHERE
                                    A.inactive = '0'
                                    AND form_kode = 'FRM-FSS-319'
                                    AND PARAMETER = '$tipe'
                                    AND departemen = 'BLR'
                                    AND tgl_efective IN (
                                    SELECT MAX
                                        ( tgl_efective )
                                    FROM
                                        tblmst_formitem_hdr
                                    WHERE
                                        inactive = '0'
                                        AND form_kode = 'FRM-FSS-319'
                                        AND PARAMETER = '$tipe'
                                        AND departemen = 'BLR'
                                        AND tgl_efective <= '$create_date'
                                    )
                                ORDER BY
                                    b.detail_id");

        $final = array();
        // if (count($q) > 0) {
        //     foreach ($q->result() as $row) {
        //         $q2 = $this->db1->query("SELECT
        //                                      '$create_date' :: DATE create_date,
        //                                      ( SUM ( COALESCE ( NULLIF ( dtld_tmpr_kg, '' ), '0' ) :: NUMERIC ) ) AS d_akumulatif_tempurung,
        //                                      ( SUM ( COALESCE ( NULLIF ( dtld_steam_ton, '' ), '0' ) :: NUMERIC ) ) AS d_akumulatif_steam,
        //                                      ( SUM ( COALESCE ( NULLIF ( dtld_total_air, '' ), '0' ) :: NUMERIC ) ) AS d_akumulatif_air
        //                                  FROM
        //                                      tblfrmfrmfss319hdr
        //                                      A JOIN tblfrmfrmfss319dtl_d b ON A.headerid = b.headerid
        //                                  WHERE
        //                                      A.create_date >= to_date( '$create_date', 'yyyy-mm-01' )
        //                                      AND A.create_date <= '$create_date'
        //                                      AND b.dtld_item_id = '$row->detail_id'");

        //         if (count($q2) > 0) {
        //             $row->children = $q2->result();
        //         }
        //         array_push($final, $row);
        //     }
        //     return $final;
        //     // return $q;
        // }

        if (count($q) > 0) {
            foreach ($q->result() as $row) {
                $q2 = $this->db1->query("SELECT A
                                            .headerid,
                                            b.dtld_tmpr_akm AS d_akumulatif_tempurung,
                                            b.dtld_steam_akm AS d_akumulatif_steam,
                                            b.dtld_air_akm AS d_akumulatif_air,
                                            A.create_date 
                                        FROM
                                            tblfrmfrmfss319hdr
                                            AS A LEFT JOIN tblfrmfrmfss319dtl_d AS b ON A.headerid = b.headerid 
                                        WHERE
                                            A.create_date = ( SELECT MAX ( create_date ) FROM tblfrmfrmfss319hdr ) 
                                            AND A.create_date >= to_date( '$create_date', 'yyyy-mm-01' ) 
                                            AND A.create_date <= '$create_date'
                                            AND b.dtld_item_id = '$row->detail_id'");

                if (count($q2) > 0) {
                    $row->children = $q2->result();
                }
                array_push($final, $row);
            }
            return $final;
            // return $q;
        }
    }

    function get_list_item4($tipe, $create_date)
    {
        $q = $this->db1->query("SELECT
                                    *,
                                    'item1' dtl_level
                                FROM
                                    tblmst_formitem_hdr
                                    A JOIN tblmst_formitem_dtl b ON A.headerid = b.headerid
                                WHERE
                                    A.inactive = '0'
                                    AND form_kode = 'FRM-FSS-319'
                                    AND PARAMETER = '$tipe'
                                    AND departemen = 'BLR'
                                    AND tgl_efective IN (
                                    SELECT MAX
                                        ( tgl_efective )
                                    FROM
                                        tblmst_formitem_hdr
                                    WHERE
                                        inactive = '0'
                                        AND form_kode = 'FRM-FSS-319'
                                        AND PARAMETER = '$tipe'
                                        AND departemen = 'BLR'
                                        AND tgl_efective <= '$create_date'
                                    )
                                ORDER BY
                                    b.detail_id");

        $final = array();
        if (count($q) > 0) {
            foreach ($q->result() as $row) {
                $q2 = $this->db1->query("SELECT
                                             '$create_date' :: DATE create_date,
                                             ( SUM ( COALESCE ( NULLIF ( dtlb2_pakai, '' ), '0' ) :: NUMERIC ) ) AS b2_akumulatif
                                         FROM
                                             tblfrmfrmfss319hdr
                                             A JOIN tblfrmfrmfss319dtl_b2 b ON A.headerid = b.headerid
                                         WHERE
                                             A.create_date >= to_date( '$create_date', 'yyyy-mm-01' )
                                             AND A.create_date <= '$create_date'
                                             AND b.dtlb2_item_id = '$row->detail_id'");

                if (count($q2) > 0) {
                    $row->children = $q2->result();
                }
                array_push($final, $row);
            }
            return $final;
            // return $q;
        }
    }


    function check($create_date, $docno)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);
        $this->db1->where('docno', $docno);
        $query = $this->db1->get();
        return $query;
    }

    function insert_dtheader($data5)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel1, $data5);
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
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);
        $this->db1->where('docno', $docno);
        $this->db1->where('headerid !=', $headerid);
        $query = $this->db1->get();
        return $query;
    }

    function cek_stdetail($headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('headerid', $headerid);
        $this->db1->where('status_detail', '1');
        $query = $this->db1->get();
        return $query;
    }

    function cek_stdetailx($headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('headerid', $headerid);
        $this->db1->where('status_detailx', '1');
        $query = $this->db1->get();
        return $query;
    }

    function update_hdr($headerid, $data5)
    {
        $this->db1->trans_begin();
        $this->db1->where('headerid', $headerid);
        $this->db1->update($this->tabel1, $data5);
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
        $dtlid = $this->db1->insert($this->tabel2, $data6);
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

    function insert_detail_b($data6b)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel10, $data6b);
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

    function insert_detail_b2($data6b2)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel4, $data6b2);
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

    function insert_detail_c($data6c)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel6, $data6c);
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

    function insert_detail_d($data6d)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel8, $data6d);
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
        $this->db1->update($this->tabel2, $data6);
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
        $this->db1->update($this->tabel3, $data6);
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

    function update_dtl_b($datadetail, $data6b)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6b);
        $this->db1->where('detail_id_b', $datadetail);
        $this->db1->update($this->tabel10, $data6b);
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

    function update_dtl_bx($datadetail, $data6b)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6b);
        $this->db1->where('detail_id_b', $datadetail);
        $this->db1->update($this->tabel11, $data6b);
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

    function update_dtl_b2($datadetail, $data6b2)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6b2);
        $this->db1->where('detail_id_b2', $datadetail);
        $this->db1->update($this->tabel4, $data6b2);
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

    function update_dtl_b2x($datadetail, $data6b2)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6b2);
        $this->db1->where('detail_id_b2', $datadetail);
        $this->db1->update($this->tabel5, $data6b2);
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

    function update_dtl_c($datadetail, $data6c)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6c);
        $this->db1->where('detail_id_c', $datadetail);
        $this->db1->update($this->tabel6, $data6c);
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

    function update_dtl_cx($datadetail, $data6c)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6c);
        $this->db1->where('detail_id_c', $datadetail);
        $this->db1->update($this->tabel7, $data6c);
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

    function update_dtl_d($datadetail, $data6d)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6d);
        $this->db1->where('detail_id_d', $datadetail);
        $this->db1->update($this->tabel8, $data6d);
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

    function update_dtl_dx($datadetail, $data6d)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6d);
        $this->db1->where('detail_id_d', $datadetail);
        $this->db1->update($this->tabel9, $data6d);
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
            "INSERT INTO $this->tabel3
            (   
                detail_id,
                stdtl,
                headerid,
                boiler,
                tekanan_07,
                tekanan_08,
                tekanan_09,
                tekanan_10,
                tekanan_11,
                tekanan_12,
                tekanan_13,
                tekanan_14,
                tekanan_15,
                tekanan_16,
                tekanan_17,
                tekanan_18,
                tekanan_19,
                tekanan_20,
                tekanan_21,
                tekanan_22,
                tekanan_23,
                tekanan_24,
                tekanan_01,
                tekanan_02,
                tekanan_03,
                tekanan_04,
                tekanan_05,
                tekanan_06,
                keterangan      
                            )
            SELECT
                b.detail_id,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.boiler,
                b.tekanan_07,
                b.tekanan_08,
                b.tekanan_09,
                b.tekanan_10,
                b.tekanan_11,
                b.tekanan_12,
                b.tekanan_13,
                b.tekanan_14,
                b.tekanan_15,
                b.tekanan_16,
                b.tekanan_17,
                b.tekanan_18,
                b.tekanan_19,
                b.tekanan_20,
                b.tekanan_21,
                b.tekanan_22,
                b.tekanan_23,
                b.tekanan_24,
                b.tekanan_01,
                b.tekanan_02,
                b.tekanan_03,
                b.tekanan_04,
                b.tekanan_05,
                b.tekanan_06,
                b.keterangan
            FROM
                $this->tabel2 AS b LEFT JOIN $this->tabel3 AS bx ON b.detail_id = bx.detail_id
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
            "INSERT INTO $this->tabel3
            (
                detail_id,
                stdtl,
                headerid,
                boiler,
                tekanan_07,
                tekanan_08,
                tekanan_09,
                tekanan_10,
                tekanan_11,
                tekanan_12,
                tekanan_13,
                tekanan_14,
                tekanan_15,
                tekanan_16,
                tekanan_17,
                tekanan_18,
                tekanan_19,
                tekanan_20,
                tekanan_21,
                tekanan_22,
                tekanan_23,
                tekanan_24,
                tekanan_01,
                tekanan_02,
                tekanan_03,
                tekanan_04,
                tekanan_05,
                tekanan_06,
                keterangan
            )
            SELECT
                b.detail_id,
                    CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.boiler,
                b.tekanan_07,
                b.tekanan_08,
                b.tekanan_09,
                b.tekanan_10,
                b.tekanan_11,
                b.tekanan_12,
                b.tekanan_13,
                b.tekanan_14,
                b.tekanan_15,
                b.tekanan_16,
                b.tekanan_17,
                b.tekanan_18,
                b.tekanan_19,
                b.tekanan_20,
                b.tekanan_21,
                b.tekanan_22,
                b.tekanan_23,
                b.tekanan_24,
                b.tekanan_01,
                b.tekanan_02,
                b.tekanan_03,
                b.tekanan_04,
                b.tekanan_05,
                b.tekanan_06,
                b.keterangan
            FROM
                $this->tabel2 AS b
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

    function new_insert2_dtl_bx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->tabel11
            (   
                detail_id_b,
                stdtl,
                headerid,
                dtlb_item_id,
                dtlb_uraian,
                dtlb_penerimaan_kg,
                dtlb_penerimaan_akm,
                dtlb_penerimaan_akm_awal,
                dtlb_pemakaian_kg,
                dtlb_pemakaian_akm,
                dtlb_pemakaian_akm_awal
                            )
            SELECT
                b.detail_id_b,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.dtlb_item_id,
                b.dtlb_uraian,
                b.dtlb_penerimaan_kg,
                b.dtlb_penerimaan_akm,
                b.dtlb_penerimaan_akm_awal,
                b.dtlb_pemakaian_kg,
                b.dtlb_pemakaian_akm,
                b.dtlb_pemakaian_akm_awal
            FROM
                $this->tabel10 AS b LEFT JOIN $this->tabel11 AS bx ON b.detail_id_b = bx.detail_id_b
            WHERE bx.detail_id_b IS NULL AND b.headerid = $id ORDER BY b.detail_id_b ASC"
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

    function insert_detail_bx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->tabel5
            (
                detail_id_b,
                stdtl,
                headerid,
                dtlb_item_id,
                dtlb_uraian,
                dtlb_penerimaan_kg,
                dtlb_penerimaan_akm,
                dtlb_penerimaan_akm_awal,
                dtlb_pemakaian_kg,
                dtlb_pemakaian_akm,
                dtlb_pemakaian_akm_awal
            )
            SELECT
                b.detail_id_b,
                    CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.dtlb_item_id,
                b.dtlb_uraian,
                b.dtlb_penerimaan_kg,
                b.dtlb_penerimaan_akm,
                b.dtlb_penerimaan_akm_awal,
                b.dtlb_pemakaian_kg,
                b.dtlb_pemakaian_akm,
                b.dtlb_pemakaian_akm_awal
            FROM
                $this->tabel4 AS b
            where b.headerid='$id' order by b.detail_id_b asc"
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

    function new_insert2_dtl_b2x($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->tabel5
            (   
                detail_id_b2,
                stdtl,
                headerid,
                dtlb2_item_id,
                dtlb2_uraian,
                dtlb2_terima,
                dtlb2_pakai,
                dtlb2_akm,
                dtlb2_akm_awal,
                dtlb2_eff,
                dtlb2_stock,
                dtlb2_nodo
                            )
            SELECT
                b.detail_id_b2,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.dtlb2_item_id,
                b.dtlb2_uraian,
                b.dtlb2_terima,
                b.dtlb2_pakai,
                b.dtlb2_akm,
                b.dtlb2_akm_awal,
                b.dtlb2_eff,
                b.dtlb2_stock,
                b.dtlb2_nodo
            FROM
                $this->tabel4 AS b LEFT JOIN $this->tabel5 AS bx ON b.detail_id_b2 = bx.detail_id_b2
            WHERE bx.detail_id_b2 IS NULL AND b.headerid = $id ORDER BY b.detail_id_b2 ASC"
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

    function insert_detail_b2x($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->tabel5
            (
                detail_id_b2,
                stdtl,
                headerid,
                dtlb2_item_id,
                dtlb2_uraian,
                dtlb2_terima,
                dtlb2_pakai,
                dtlb2_akm,
                dtlb2_akm_awal,
                dtlb2_eff,
                dtlb2_stock,
                dtlb2_nodo
            )
            SELECT
                b.detail_id_b2,
                    CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.dtlb2_item_id,
                b.dtlb2_uraian,
                b.dtlb2_terima,
                b.dtlb2_pakai,
                b.dtlb2_akm,
                b.dtlb2_akm_awal,
                b.dtlb2_eff,
                b.dtlb2_stock,
                b.dtlb2_nodo
            FROM
                $this->tabel4 AS b
            where b.headerid='$id' order by b.detail_id_b2 asc"
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

    function new_insert2_dtl_cx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->tabel7
            (   
                detail_id_c,
                stdtl,
                headerid,
                dtlc_item_id,
                dtlc_kode_boiler,
                dtlc_total_jam,
                dtlc_jam_akm,
                dtlc_jam_akm_awal,
                dtlc_tmpr_akm_awal,
                dtlc_steam_akm_awal,
                dtlc_air_akm_awal,
                dtlc_tmpr_kg,
                dtlc_tmpr_akm,
                dtlc_steam_ton,
                dtlc_steam_akm,
                dtlc_total_air,
                dtlc_air_akm 
                            )
            SELECT
                b.detail_id_c,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.dtlc_item_id,
                b.dtlc_kode_boiler,
                b.dtlc_total_jam,
                b.dtlc_jam_akm,
                b.dtlc_jam_akm_awal,
                b.dtlc_tmpr_akm_awal,
                b.dtlc_steam_akm_awal,
                b.dtlc_air_akm_awal,
                b.dtlc_tmpr_kg,
                b.dtlc_tmpr_akm,
                b.dtlc_steam_ton,
                b.dtlc_steam_akm,
                b.dtlc_total_air,
                b.dtlc_air_akm
            FROM
                $this->tabel6 AS b LEFT JOIN $this->tabel7 AS bx ON b.detail_id_c = bx.detail_id_c
            WHERE bx.detail_id_c IS NULL AND b.headerid = $id ORDER BY b.detail_id_c ASC"
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

    function insert_detail_cx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->tabel7
            (
                detail_id_c,
                stdtl,
                headerid,
                dtlc_item_id,
                dtlc_kode_boiler,
                dtlc_total_jam,
                dtlc_jam_akm,
                dtlc_jam_akm_awal,
                dtlc_tmpr_akm_awal,
                dtlc_steam_akm_awal,
                dtlc_air_akm_awal,
                dtlc_tmpr_kg,
                dtlc_tmpr_akm,
                dtlc_steam_ton,
                dtlc_steam_akm,
                dtlc_total_air,
                dtlc_air_akm
            )
            SELECT
                b.detail_id_c,
                    CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.dtlc_item_id,
                b.dtlc_kode_boiler,
                b.dtlc_total_jam,
                b.dtlc_jam_akm,
                b.dtlc_jam_akm_awal,
                b.dtlc_tmpr_akm_awal,
                b.dtlc_steam_akm_awal,
                b.dtlc_air_akm_awal,
                b.dtlc_tmpr_kg,
                b.dtlc_tmpr_akm,
                b.dtlc_steam_ton,
                b.dtlc_steam_akm,
                b.dtlc_total_air,
                b.dtlc_air_akm
            FROM
                $this->tabel6 AS b
            where b.headerid='$id' order by b.detail_id_c asc"
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

    function new_insert2_dtl_dx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->tabel9
            (   
                detail_id_d,
                stdtl,
                headerid,
                dtld_item_id,
                dtld_uraian,
                dtld_total_jam,
                dtld_tmpr_kg,
                dtld_tmpr_akm,
                dtld_steam_ton,
                dtld_steam_akm,
                dtld_total_air,
                dtld_air_akm, 
                dtld_tmpr_akm_awal, 
                dtld_steam_akm_awal, 
                dtld_air_akm_awal 
                            )
            SELECT
                b.detail_id_d,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.dtld_item_id,
                b.dtld_uraian,
                b.dtld_total_jam,
                b.dtld_tmpr_kg,
                b.dtld_tmpr_akm,
                b.dtld_steam_ton,
                b.dtld_steam_akm,
                b.dtld_total_air,
                b.dtld_air_akm, 
                b.dtld_tmpr_akm_awal, 
                b.dtld_steam_akm_awal, 
                b.dtld_air_akm_awal 
            FROM
                $this->tabel8 AS b LEFT JOIN $this->tabel9 AS bx ON b.detail_id_d = bx.detail_id_d
            WHERE bx.detail_id_d IS NULL AND b.headerid = $id ORDER BY b.detail_id_d ASC"
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

    function insert_detail_dx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query(
            "INSERT INTO $this->tabel9
            (
                detail_id_d,
                stdtl,
                headerid,
                dtld_item_id,
                dtld_uraian,
                dtld_total_jam,
                dtld_tmpr_kg,
                dtld_tmpr_akm,
                dtld_steam_ton,
                dtld_steam_akm,
                dtld_total_air,
                dtld_air_akm,
                dtld_tmpr_akm_awal,
                dtld_steam_akm_awal,
                dtld_air_akm_awal
            )
            SELECT
                b.detail_id_d,
                    CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.dtld_item_id,
                b.dtld_uraian,
                b.dtld_total_jam,
                b.dtld_tmpr_kg,
                b.dtld_tmpr_akm,
                b.dtld_steam_ton,
                b.dtld_steam_akm,
                b.dtld_total_air,
                b.dtld_air_akm,
                b.dtld_tmpr_akm_awal,
                b.dtld_steam_akm_awal,
                b.dtld_air_akm_awal
            FROM
                $this->tabel8 AS b
            where b.headerid='$id' order by b.detail_id_d asc"
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
        $this->db1->from($this->tabel1);
        $this->db1->where('headerid', $id);
        $query = $this->db1->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

    function get_detail_byid($id)
    {
        $this->db1->from($this->tabel2);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byidx($id)
    {
        $this->db1->from($this->tabel3);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_b($id)
    {
        $this->db1->from($this->tabel10);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id_b", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_bx($id)
    {
        $this->db1->from($this->tabel11);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id_b", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_b2($id)
    {
        $this->db1->from($this->tabel4);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id_b2", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_b2x($id)
    {
        $this->db1->from($this->tabel5);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id_b2", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_c($id)
    {
        $this->db1->from($this->tabel6);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id_c", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_cx($id)
    {
        $this->db1->from($this->tabel7);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id_c", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_d($id)
    {
        $this->db1->from($this->tabel8);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id_d", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_dx($id)
    {
        $this->db1->from($this->tabel9);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id_d", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function update_stdtl($chk)
    {
        $this->db1->trans_start();
        $this->db1->query("Update $this->tabel3 set stdtl='0' where detail_id ='$chk'");
        $this->db1->trans_complete();
    }

    function update_stdtl_c($chk)
    {
        $this->db1->trans_start();
        $this->db1->query("Update $this->tabel7 set stdtl='0' where detail_id_c ='$chk'");
        $this->db1->trans_complete();
    }

    function update_stdtl_d($chk)
    {
        $this->db1->trans_start();
        $this->db1->query("Update $this->tabel9 set stdtl='0' where detail_id_d ='$chk'");
        $this->db1->trans_complete();
    }

    function delete_detail($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query1 = $this->db1->delete($this->tabel2);
        return $query1;
    }

    function delete_detailx($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query2 = $this->db1->delete($this->tabel3);
        return $query2;
    }

    function delete_detail_c($chk)
    {
        $this->db1->where('detail_id_c', $chk);
        $query1 = $this->db1->delete($this->tabel6);
        return $query1;
    }

    function delete_detail_cx($chk)
    {
        $this->db1->where('detail_id_c', $chk);
        $query2 = $this->db1->delete($this->tabel7);
        return $query2;
    }
}

/* End of file M_formfrmfss319_08.php */
