<?php

class M_forminttbn020_03 extends CI_Model
{

    var $tabel_hdr  = 'tblfrminttbn020hdr';
    var $tabel_dtl  = 'tblfrminttbn020dtl';
    var $tabel_dtlx  = 'tblfrminttbn020dtlx';

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
                                    $this->tabel_hdr
                                  where
                                    extract(month from create_date)='$bulan'
                                    and extract(year from create_date)='$tahun'")->row();
    }

    function get_tanggal_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    function get_stock_temp($create_date)
    {
        return $this->db1->query("SELECT
                                    headerid,
                                    stock_awal_temp AS stock_temp,
                                    stock_akhir_tmp AS stock_akhir,
                                    create_date
                                FROM
                                    tblfrminttbn020hdr
                                WHERE
                                    create_date = (SELECT MAX(create_date) FROM tblfrminttbn020hdr)
                                    AND create_date >= to_date( '$create_date', 'yyyy-mm-01' )
                                    AND create_date <= '$create_date'
                                    ")->row();
    }


    function get_list_item($tipe, $create_date)
    {
        $q = $this->db1->query("SELECT
                                    ROW_NUMBER ( ) OVER ( PARTITION BY item1 ORDER BY D.detail_id_c ASC ),
                                    ROW_NUMBER ( ) OVER ( PARTITION BY item1 ORDER BY D.detail_id_c DESC ),
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
                                    AND form_kode = 'INT-TBN-020'
                                    AND PARAMETER = '$tipe'
                                    AND departemen = 'PWP'
                                    AND tgl_efective IN (
                                    SELECT MAX
                                        ( tgl_efective )
                                    FROM
                                        tblmst_formitem_hdr
                                    WHERE
                                        inactive = '0'
                                        AND form_kode = 'INT-TBN-020'
                                        AND PARAMETER = '$tipe'
                                        AND departemen = 'PWP'
                                        AND tgl_efective <= '$create_date'
                                    )
                                ORDER BY
                                    b.detail_id");

        $final = array();
        if (count($q) > 0) {
            foreach ($q->result() as $row) {
                $q2 = $this->db1->query(
                    "SELECT
                                            '$create_date' :: DATE create_date, 
                                            ( SUM ( COALESCE ( NULLIF ( terima, '' ), '0' ) :: NUMERIC ) )  AS dt_terima,
                                            ( SUM ( COALESCE ( NULLIF ( terima_akum, '' ), '0' ) :: NUMERIC ) )  AS dt_terima_akum,
                                            ( SUM ( COALESCE ( NULLIF ( pakai_akum, '' ), '0' ) :: NUMERIC ) )  AS dt_pakai_akum,
                                            ( SUM ( COALESCE ( NULLIF ( kirim_akum, '' ), '0' ) :: NUMERIC ) )  AS dt_kirim_akum,
                                            ( SUM ( COALESCE ( NULLIF ( minimum_stock, '' ), '0' ) :: NUMERIC ) )  AS dt_minimum_stock, 
                                            ( SUM ( COALESCE ( NULLIF ( ratarata_perbulan, '' ), '0' ) :: NUMERIC ) )  AS dt_ratarata_perbulan,
                                            ( SUM ( COALESCE ( NULLIF ( ratarata_perhari, '' ), '0' ) :: NUMERIC ) )  AS dt_ratarata_perhari,
                                            ( SUM ( COALESCE ( NULLIF ( outstanding_ppb, '' ), '0' ) :: NUMERIC ) )  AS dt_outstanding_ppb
                                        FROM
                                            tblfrminttbn020hdr
                                            A JOIN tblfrminttbn020dtl b ON A.headerid = b.headerid
                                        WHERE
                                            A.create_date >= to_date( '$create_date', 'yyyy-mm-01' )
                                            AND A.create_date <= '$create_date'
                                            AND b.detail_id_item = '$row->detail_id'"
                );
                // "SELECT
                //     a.headerid,
                //     (COALESCE (NULLIF (b.terima, ''), '0'):: NUMERIC ) AS dt_terima,
                //     (COALESCE (NULLIF (b.terima_akum, ''), '0'):: NUMERIC ) AS dt_terima_akum,
                //     (COALESCE (NULLIF (b.pakai_akum, ''), '0'):: NUMERIC ) AS dt_pakai_akum,
                //     (COALESCE (NULLIF (b.kirim_akum, ''), '0'):: NUMERIC ) AS dt_kirim_akum,
                //     (COALESCE (NULLIF (b.minimum_stock, ''), '0'):: NUMERIC ) AS dt_minimum_stock,
                //     (COALESCE (NULLIF (b.ratarata_perhari, ''), '0'):: NUMERIC ) AS dt_ratarata_perhari,
                //     (COALESCE (NULLIF (b.outstanding_ppb, ''), '0'):: NUMERIC ) AS dt_outstanding_ppb,
                //     -- b.ratarata_perbulan AS dt_ratarata_perbulan,
                //     a.create_date
                // FROM
                //     tblfrminttbn020hdr
                //     A JOIN tblfrminttbn020dtl b ON A.headerid = b.headerid
                // WHERE 
                //     A.create_date = ( SELECT MAX (create_date) FROM tblfrminttbn020hdr )
                //     AND A.create_date >= to_date('$create_date', 'yyyy-mm-01')
                //     AND A.create_date <= '$create_date'
                //     AND b.detail_id_item = '$row->detail_id'");

                if (count($q2) > 0) {
                    foreach ($q2->result() as $row2) {
                        $q3 = $this->db1->query("SELECT
                                                    A.stock_awal,
                                                    A.stock_akhir,
                                                    B.create_date
                                                FROM
                                                tblfrminttbn020dtl AS A
                                                    LEFT JOIN tblfrminttbn020hdr AS B ON B.headerid = A.headerid
                                                WHERE 
                                                    B.create_date = ( SELECT MAX ( create_date ) FROM tblfrminttbn020hdr ) 
                                                    AND B.create_date >= to_date ('$create_date', 'yyyy-mm-01')
                                                    AND B.create_date <= '$create_date' 
                                                    AND A.detail_id_item = '$row->detail_id'
                                                ");
                        if (count($q3) > 0) {
                            $row2->children2 = $q3->result();
                        }
                    }
                    $row->children = $q2->result();
                }

                // if (count($q2) > 0) {
                //     $row->children = $q2->result();
                // }
                array_push($final, $row);
            }
            // return $q;
        }
        return $final;
    }

    function check($create_date, $docno)
    {
        $this->db1->from($this->tabel_hdr);
        $this->db1->where('create_date', $create_date);
        $this->db1->where('docno', $docno);
        $query = $this->db1->get();
        return $query;
    }

    function insert_dtheader($data5)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel_hdr, $data5);
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
        $this->db1->from($this->tabel_hdr);
        $this->db1->where('create_date', $create_date);
        $this->db1->where('docno', $docno);
        $this->db1->where('headerid !=', $headerid);
        $query = $this->db1->get();
        return $query;
    }

    function cek_stdetail($headerid)
    {
        $this->db1->from($this->tabel_hdr);
        $this->db1->where('headerid', $headerid);
        $this->db1->where('status_detail', '1');
        $query = $this->db1->get();
        return $query;
    }

    function cek_stdetailx($headerid)
    {
        $this->db1->from($this->tabel_hdr);
        $this->db1->where('headerid', $headerid);
        $this->db1->where('status_detailx', '1');
        $query = $this->db1->get();
        return $query;
    }

    function update_hdr($headerid, $data5)
    {
        $this->db1->trans_begin();
        $this->db1->where('headerid', $headerid);
        $this->db1->update($this->tabel_hdr, $data5);
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
        $dtlid = $this->db1->insert($this->tabel_dtl, $data6);
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
        $this->db1->update($this->tabel_dtl, $data6);
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
        $this->db1->update($this->tabel_dtlx, $data6);
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
            "INSERT INTO $this->tabel_dtlx
            (   
                detail_id,
                stdtl,
                headerid,
                item_kimia,
                satuan,
                stock_awal,
                terima,
                terima_akum,
                pakai,
                pakai_akum,
                kirim,
                kirim_akum,
                minimum_stock,
                stock_akhir,
                ratarata_perbulan,
                ratarata_perhari,
                outstanding_ppb,
                keterangan,
                detail_id_item 
                            )
            SELECT
                b.detail_id,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.item_kimia,
                b.satuan,
                b.stock_awal,
                b.terima,
                b.terima_akum,
                b.pakai,
                b.pakai_akum,
                b.kirim,
                b.kirim_akum,
                b.minimum_stock,
                b.stock_akhir,
                b.ratarata_perbulan,
                b.ratarata_perhari,
                b.outstanding_ppb,
                b.keterangan,
                b.detail_id_item
            FROM
                $this->tabel_dtl AS b LEFT JOIN $this->tabel_dtlx AS bx ON b.detail_id = bx.detail_id
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
            "INSERT INTO $this->tabel_dtlx
            (
                detail_id,
                stdtl,
                headerid,
                item_kimia,
                satuan,
                stock_awal,
                terima,
                terima_akum,
                pakai,
                pakai_akum,
                kirim,
                kirim_akum,
                minimum_stock,
                stock_akhir,
                ratarata_perbulan,
                ratarata_perhari,
                outstanding_ppb,
                keterangan,
                detail_id_item
            )
            SELECT
                b.detail_id,
                CASE WHEN (b.stdtl) = '0' THEN '1' ELSE b.stdtl END AS stdtl,
                b.headerid,
                b.item_kimia,
                b.satuan,
                b.stock_awal,
                b.terima,
                b.terima_akum,
                b.pakai,
                b.pakai_akum,
                b.kirim,
                b.kirim_akum,
                b.minimum_stock,
                b.stock_akhir,
                b.ratarata_perbulan,
                b.ratarata_perhari,
                b.outstanding_ppb,
                b.keterangan,
                b.detail_id_item
            FROM
                $this->tabel_dtl AS b
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
        $this->db1->from($this->tabel_hdr);
        $this->db1->where('headerid', $id);
        $query = $this->db1->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

    function get_detail_byid($id)
    {
        $this->db1->from($this->tabel_dtl);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byidx($id)
    {
        $this->db1->from($this->tabel_dtlx);
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
        $this->db1->query("Update $this->tabel_dtlx set stdtl='0' where detail_id ='$chk'");
        $this->db1->trans_complete();
    }

    function delete_detail($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query1 = $this->db1->delete($this->tabel_dtl);
        return $query1;
    }

    function delete_detailx($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query2 = $this->db1->delete($this->tabel_dtlx);
        return $query2;
    }
}

/* End of file M_forminttbn020_03.php */
