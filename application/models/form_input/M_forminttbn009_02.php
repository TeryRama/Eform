<?php
class M_forminttbn009_02 extends CI_Model
{
    var $tabel1  = 'tblfrminttbn009hdr';
    var $tabel2  = 'tblfrminttbn009dtl';
    var $tabel3  = 'tblfrminttbn009dtlx';
    var $tabel4  = 'tblfrminttbn009dtl_b';
    var $tabel5  = 'tblfrminttbn009dtl_bx';
    var $tabel6  = 'tblfrminttbn009dtl_c';
    var $tabel7  = 'tblfrminttbn009dtl_cx';
    var $tabel8  = 'tblfrminttbn009dtl_d';
    var $tabel9  = 'tblfrminttbn009dtl_dx';
    var $tabel10  = 'tblfrminttbn009dtl_e';
    var $tabel11  = 'tblfrminttbn009dtl_ex';

    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }
    
    /**
     * get_docno
     *
     * @param  mixed $bulan
     * @param  mixed $tahun
     * @return void
     */
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

    function get_master_meteran_kwh($create_date)
    {
        // return $this->db1->query("SELECT
        //                                 * 
        //                             FROM
        //                                 tblmst_meteran
        //                                 A JOIN tblmst_meterandtl b ON A.headerid = b.headerid 
        //                             WHERE
        //                                 A.inactive = '0' 
        //                                 AND b.inactive = '0' 
        //                                 AND A.tgl_efektif <= '$create_date' 
        //                             ORDER BY
        //                             b.dept_pengguna,
        //                             b.detail_id")->result();

        $q = $this->db1->query("SELECT
                                     * 
                                 FROM
                                     tblmst_meteran
                                     A JOIN tblmst_meterandtl b ON A.headerid = b.headerid 
                                 WHERE
                                     A.inactive = '0' 
                                     AND b.inactive = '0' 
                                     AND A.tgl_efektif <= '$create_date' 
                                 ORDER BY
                                 b.dept_pengguna,
                                 b.detail_id");
         $final = array();
         if(count($q) > 0){
             foreach($q->result() as $row){
                 $q2 = $this->db1->query("SELECT
                                            A.kwh_awal,
                                            A.kwh_akhir,
                                            B.create_date 
                                        FROM
                                            tblfrminttbn009dtl_c
                                            AS A LEFT JOIN tblfrminttbn009hdr AS B ON B.headerid = A.headerid 
                                        WHERE
                                            B.create_date = ( SELECT MAX ( create_date ) FROM tblfrminttbn009hdr ) 
                                            AND B.create_date >= to_date( '$create_date', 'yyyy-mm-01' ) 
                                            AND B.create_date <= '$create_date'
                                            AND A.kode_kwh = '$row->kode_kwh'
                                            ");
                if(count($q2) > 0){
                    $row->children = $q2->result();
                }
                array_push($final,$row);
            }
            return $final;
        }
    }

    function get_trafo_awal($create_date)
    {
        return $this->db1->query("SELECT
                                        A.trafo_awal,
                                        A.trafo_akhir,
                                        B.create_date
                                    FROM
                                        tblfrminttbn009dtl_b AS A
                                        LEFT JOIN tblfrminttbn009hdr AS B ON B.headerid = A.headerid
                                    WHERE 
                                        B.create_date = ( SELECT MAX ( create_date ) FROM tblfrminttbn009hdr ) 
                                        AND B.create_date >= to_date ('$create_date', 'yyyy-mm-01')
                                        AND B.create_date <= '$create_date'")->result();
    }

    function get_master_generator($create_date)
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
                                        AND form_kode = 'INT-TBN-009' 
                                        AND PARAMETER = 'Tipe 1' 
                                        AND departemen = 'TBN' 
                                        AND tgl_efective IN (
                                        SELECT MAX
                                            ( tgl_efective ) 
                                        FROM
                                            tblmst_formitem_hdr 
                                        WHERE
                                            inactive = '0' 
                                            AND form_kode = 'INT-TBN-009' 
                                            AND PARAMETER = 'Tipe 1' 
                                            AND departemen = 'TBN' 
                                            AND tgl_efective <= '$create_date' 
                                        ) 
                                    ORDER BY
                                        D.detail_id_c");

        $final = array();
        if(count($q) > 0){
            foreach($q->result() as $row){
                $q2 = $this->db1->query("SELECT
                                                '$create_date' :: DATE create_date,
                                                ( SUM ( COALESCE ( NULLIF ( kwh_nilai, '' ), '0' ) :: NUMERIC ) ) AS kwh_akm
                                            FROM
                                                tblfrminttbn009hdr
                                                A JOIN tblfrminttbn009dtl_e b ON A.headerid = b.headerid 
                                            WHERE
                                                A.create_date >= to_date( '$create_date', 'yyyy-mm-01' ) 
                                                AND A.create_date <= '$create_date'
                                                AND b.item_id = '$row->detail_id_c'");
                if(count($q2) > 0){
                    $row->children = $q2->result();
                }
                array_push($final,$row);
            }
            return $final;
        }
    }

    // function get_master_dept_pengguna($create_date)
    // {
    //     return $this->db1->query("select * from tblmst_dept_pengguna where inactive='0' and tgl_efektif<='$create_date' order by headerid asc")->result();
    // }

    function get_master_dept_pengguna($create_date){
        $q = $this->db1->query("SELECT
                                    * 
                                FROM
                                    tblmst_dept_pengguna 
                                WHERE
                                    inactive = '0' 
                                    AND tgl_efektif <= '$create_date' 
                                ORDER BY
                                    headerid ASC");
        $final = array();
        if(count($q) > 0){
            foreach($q->result() as $row){
                    $q2 = $this->db1->query("SELECT
                                            '$create_date' :: DATE create_date,
                                            ( SUM ( COALESCE ( NULLIF ( pemakai_kwh_total, '' ), '0' ) :: NUMERIC ) ) AS d_kwh_akm,
                                            ( SUM ( COALESCE ( NULLIF ( bahan_bakar_kwh, '' ), '0' ) :: NUMERIC ) ) AS d_bahanbakar_akm
                                        FROM
                                            tblfrminttbn009hdr
                                            A JOIN tblfrminttbn009dtl_d b ON A.headerid = b.headerid 
                                        WHERE
                                            A.create_date >= to_date( '$create_date', 'yyyy-mm-01' ) 
                                            AND A.create_date <= '$create_date'
                                            AND b.pemakai_panel = '$row->dept_pengguna'");
                        if(count($q2) > 0){
                            $row->children = $q2->result();
                        }
                        array_push($final, $row);
                    }
                    return $final;
                }
    }

    function get_master_steam($create_date)
    {
        $q = $this->db1->query("SELECT
                                        * 
                                    FROM
                                        tblmst_supplier_steam A 
                                    WHERE
                                        A.inactive = '0' 
                                        AND A.form_penggunaan = 'INT-TBN-009' 
                                        AND A.tgl_efektif <= '$create_date' 
                                    ORDER BY
                                        1");
        $final = array();
        if(count($q) > 0){
            foreach($q->result() as $row){
                $q2 = $this->db1->query("SELECT
                                        '$create_date' :: DATE create_date,
                                        ( SUM ( COALESCE ( NULLIF ( steam_nilai, '' ), '0' ) :: NUMERIC ) ) AS steam_akm,
                                        ( SUM ( COALESCE ( NULLIF ( press_nilai, '' ), '0' ) :: NUMERIC ) ) AS press_akm,
                                        ( SUM ( COALESCE ( NULLIF ( batubara_nilai, '' ), '0' ) :: NUMERIC ) ) AS batubara_akm,
                                        ( SUM ( COALESCE ( NULLIF ( cocopit_nilai, '' ), '0' ) :: NUMERIC ) ) AS cocopit_akm, 
                                        ( SUM ( COALESCE ( NULLIF ( tempurung_nilai, '' ), '0' ) :: NUMERIC ) ) AS tempurung_akm, 
                                        ( SUM ( COALESCE ( NULLIF ( bb_nilai, '' ), '0' ) :: NUMERIC ) ) AS bb_akm, 
                                        ( SUM ( COALESCE ( NULLIF ( sabut_nilai, '' ), '0' ) :: NUMERIC ) ) AS sabut_akm, 
                                        ( SUM ( COALESCE ( NULLIF ( steam_batubara_nilai, '' ), '0' ) :: NUMERIC ) ) AS steam_batubara_akm, 
                                        ( SUM ( COALESCE ( NULLIF ( steam_bahanbakar_nilai, '' ), '0' ) :: NUMERIC ) ) AS steam_bahanbakar_akm, 
                                        ( SUM ( COALESCE ( NULLIF ( operasi_nilai, '' ), '0' ) :: NUMERIC ) ) AS operasi_akm, 
                                        ( SUM ( COALESCE ( NULLIF ( dearator_nilai, '' ), '0' ) :: NUMERIC ) ) AS dearator_akm, 
                                        ( SUM ( COALESCE ( NULLIF ( demian_nilai, '' ), '0' ) :: NUMERIC ) ) AS demian_akm, 
                                        ( SUM ( COALESCE ( NULLIF ( debu_nilai, '' ), '0' ) :: NUMERIC ) ) AS dabu_akm, 
                                        ( SUM ( COALESCE ( NULLIF ( ct_nilai, '' ), '0' ) :: NUMERIC ) ) AS ct_akm
                                    FROM
                                        tblfrminttbn009hdr
                                        A JOIN tblfrminttbn009dtl b ON A.headerid = b.headerid 
                                    WHERE
                                        A.create_date >= to_date( '$create_date', 'yyyy-mm-01' ) 
                                        AND A.create_date <= '$create_date'
                                        AND b.dept_steam = '$row->dept_steam'");
                if(count($q2) > 0){
                    $row->children = $q2->result();
                }
                array_push($final, $row);
            }
            return $final;
        }
    }
    function get_master_trafo($create_date) {
        $q = $this->db1->query("SELECT
                                        * 
                                    FROM
                                        tblmst_trafo A 
                                    WHERE
                                        A.inactive = '0' 
                                        AND A.inactive = '0' 
                                        AND A.form_penggunaan = 'INT-TBN-009' 
                                        AND A.tgl_efektif <= '$create_date' 
                                    ORDER BY
                                        1");
        $final = array();
        if(count($q) > 0){
            foreach($q->result() as $row){
                $q2 = $this->db1->query("SELECT
                                            '$create_date' :: DATE create_date,
                                            ( SUM ( COALESCE ( NULLIF ( kwh_nilai, '' ), '0' ) :: NUMERIC ) ) AS kwh_akm,
                                            ( SUM ( COALESCE ( NULLIF ( bahanbakar_nilai, '' ), '0' ) :: NUMERIC ) ) AS bahanbakar_akm,
                                            ( SUM ( COALESCE ( NULLIF ( kwh_efisiensi_nilai, '' ), '0' ) :: NUMERIC ) ) AS kwh_efisien_akm,
                                            ( SUM ( COALESCE ( NULLIF ( operasi_nilai, '' ), '0' ) :: NUMERIC ) ) AS operasi_akm,
                                            ( SUM ( COALESCE ( NULLIF ( solar_nilai, '' ), '0' ) :: NUMERIC ) ) AS solar_akm
                                        FROM
                                            tblfrminttbn009hdr
                                            A JOIN tblfrminttbn009dtl_b b ON A.headerid = b.headerid 
                                        WHERE
                                            A.create_date >= to_date( '$create_date', 'yyyy-mm-01' ) 
                                            AND A.create_date <= '$create_date'
                                            AND b.trafo = '$row->trafo'");
                if(count($q2) > 0){
                    foreach($q2->result() as $row2){
                        $q3 = $this->db1->query("SELECT
                                                    A.trafo_awal,
                                                    A.trafo_akhir,
                                                    B.create_date
                                                FROM
                                                    tblfrminttbn009dtl_b AS A
                                                    LEFT JOIN tblfrminttbn009hdr AS B ON B.headerid = A.headerid
                                                WHERE 
                                                    B.create_date = ( SELECT MAX ( create_date ) FROM tblfrminttbn009hdr ) 
                                                    AND B.create_date >= to_date ('$create_date', 'yyyy-mm-01')
                                                    AND B.create_date <= '$create_date'
                                                    AND A.trafo = '$row->trafo'
                                                ");
                        if(count($q3) > 0){
                            $row2->children2 = $q3->result();
                        }
                    } 
                    $row->children = $q2->result();
                }
                array_push($final, $row);
            }
        }
        return $final;
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

    function get_detail_lap_generator1_byid($id, $tbl = null)
    {
        $tbl = $tbl ?? $this->tabel10;

        $this->db1->from($tbl);
        $this->db1->where('headerid', $id);
        $this->db1->where('generator', '1');
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_lap_generator1_byidx($id)
    {
        return $this->get_detail_lap_generator1_byid($id, $this->tabel11);
    }
    function get_detail_lap_generator2_byid($id, $tbl = null)
    {
        $tbl = $tbl ?? $this->tabel10;

        $this->db1->from($tbl);
        $this->db1->where('headerid', $id);
        $this->db1->where('generator', '2');
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_lap_generator2_byidx($id)
    {
        return $this->get_detail_lap_generator2_byid($id, $this->tabel11);
    }

    function get_detail_byid_b($id)
    {
        $this->db1->from($this->tabel4);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_bx($id)
    {
        $this->db1->from($this->tabel5);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_c($id)
    {
        $this->db1->from($this->tabel6);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_cx($id)
    {
        $this->db1->from($this->tabel7);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_d($id)
    {
        $this->db1->from($this->tabel8);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_dx($id)
    {
        $this->db1->from($this->tabel9);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_e($id)
    {
        return $this->db1->query("SELECT 
                                        ROW_NUMBER ( ) OVER ( PARTITION BY generator ORDER BY detail_id ASC ) AS nourut,
                                        ROW_NUMBER ( ) OVER ( PARTITION BY generator ORDER BY detail_id DESC ) AS nourutdesc,
                                        * 
                                    FROM
                                        tblfrminttbn009dtl_e 
                                    WHERE
                                        headerid = '$id' 
                                    ORDER BY
                                        detail_id ASC")->result();
    }
    function get_detail_byid_ex($id)
    {
        $this->db1->from($this->tabel11);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }


    function check($create_date, $docno, $headerid = null)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);

        if (!empty($headerid)) {
            $this->db1->where('headerid !=', $headerid);
        }

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

    /// insert group
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

    function insert_detailx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel3 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              dept_steam,
                              steam_nilai,
                              steam_akumulatif,
                              press_nilai,
                              press_akumulatif,
                              batubara_nilai,
                              batubara_akumulatif,
                              cocopit_nilai,
                              cocopit_akumulatif,
                              tempurung_nilai,
                              tempurung_akumulatif,
                              bb_nilai,
                              bb_akumulatif,
                              sabut_nilai,
                              sabut_akumulatif,
                              steam_batubara_nilai,
                              steam_batubara_akumulatif,
                              steam_bahanbakar_nilai,
                              steam_bahanbakar_akumulatif,
                              operasi_nilai,
                              operasi_akumulatif,
                              dearator_nilai,
                              dearator_akumulatif,
                              demian_nilai,
                              demian_akumulatif,
                              ct_nilai,
                              ct_akumulatif,
                              debu_nilai,
                              debu_akumulatif
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.dept_steam,
                              b.steam_nilai,
                              b.steam_akumulatif,
                              b.press_nilai,
                              b.press_akumulatif,
                              b.batubara_nilai,
                              b.batubara_akumulatif,
                              b.cocopit_nilai,
                              b.cocopit_akumulatif,
                              b.tempurung_nilai,
                              b.tempurung_akumulatif,
                              b.bb_nilai,
                              b.bb_akumulatif,
                              b.sabut_nilai,
                              b.sabut_akumulatif,
                              b.steam_batubara_nilai,
                              b.steam_batubara_akumulatif,
                              b.steam_bahanbakar_nilai,
                              b.steam_bahanbakar_akumulatif,
                              b.operasi_nilai,
                              b.operasi_akumulatif,
                              b.dearator_nilai,
                              b.dearator_akumulatif,
                              b.demian_nilai,
                              b.demian_akumulatif,
                              b.ct_nilai,
                              b.ct_akumulatif,
                              b.debu_nilai,
                              b.debu_akumulatif
                              
                            from 
                              $this->tabel2 as b 
                            left join 
                              $this->tabel3 as bx 
                              on b.detail_id = bx.detail_id 
                            where 
                              bx.detail_id is null 
                              and b.headerid='$id' 
                            order by 
                              b.detail_id");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function insert_detail_b($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel4, $data6);
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

    function insert_detail_bx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel5 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              trafo,
                              kwh_nilai,
                              kwh_akumulatif,
                              bahanbakar_nilai,
                              bahanbakar_akumulatif,
                              kwh_efisiensi_nilai,
                              kwh_efisiensi_akumulatif,
                              operasi_nilai,
                              operasi_akumulatif,
                              solar_nilai,
                              solar_akumulatif
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.trafo,
                              b.kwh_nilai,
                              b.kwh_akumulatif,
                              b.bahanbakar_nilai,
                              b.bahanbakar_akumulatif,
                              b.kwh_efisiensi_nilai,
                              b.kwh_efisiensi_akumulatif,
                              b.operasi_nilai,
                              b.operasi_akumulatif,
                              b.solar_nilai,
                              b.solar_akumulatif
                              
                            from 
                              $this->tabel4 as b 
                            left join 
                              $this->tabel5 as bx 
                              on b.detail_id = bx.detail_id 
                            where 
                              bx.detail_id is null 
                              and b.headerid='$id' 
                            order by 
                              b.detail_id");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function insert_detail_c($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel6, $data6);
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

    function insert_detail_cx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel7 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              kode_kwh,
                              reading_ct,
                              dept_panel,
                              dept_user,
                              status_beban,
                              kwh_awal,
                              kwh_akhir,
                              putaran_hasil,
                              kwh_real_nilai,
                              kwh_nilai
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.kode_kwh,
                              b.reading_ct,
                              b.dept_panel,
                              b.dept_user,
                              b.status_beban,
                              b.kwh_awal,
                              b.kwh_akhir,
                              b.putaran_hasil,
                              b.kwh_real_nilai,
                              b.kwh_nilai
                              
                            from 
                              $this->tabel6 as b 
                            left join 
                              $this->tabel7 as bx 
                              on b.detail_id = bx.detail_id 
                            where 
                              bx.detail_id is null 
                              and b.headerid='$id' 
                            order by 
                              b.detail_id");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function insert_detail_d($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel8, $data6);
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

    function insert_detail_dx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel9 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              id_pemakai_panel,
                              pemakai_panel,
                              pemakai_kwh,
                              pemakai_kwh_loss,
                              pemakai_kwh_total,
                              pemakai_persen,
                              pemakai_akumulatif,
                              bahan_bakar_kwh,
                              bahan_bakar_persen,
                              bahan_bakar_akumulatif
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.id_pemakai_panel,
                              b.pemakai_panel,
                              b.pemakai_kwh,
                              b.pemakai_kwh_loss,
                              b.pemakai_kwh_total,
                              b.pemakai_persen,
                              b.pemakai_akumulatif,
                              b.bahan_bakar_kwh,
                              b.bahan_bakar_persen,
                              b.bahan_bakar_akumulatif
                              
                            from 
                              $this->tabel8 as b 
                            left join 
                              $this->tabel9 as bx 
                              on b.detail_id = bx.detail_id 
                            where 
                              bx.detail_id is null 
                              and b.headerid='$id' 
                            order by 
                              b.detail_id");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function insert_detail_e($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel10, $data6);
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

    function insert_detail_ex($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel11 
                            (
                              detail_id,
                              headerid,
                              stdtl,
                              generator,
                              item_id,
                              shift,
                              read_ct,
                              putaran,
                              kwh_nilai,
                              kwh_akumulatif,
                              kwh_akumulatif_awal
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.generator,
                              b.item_id,
                              b.shift,
                              b.read_ct,
                              b.putaran,
                              b.kwh_nilai,
                              b.kwh_akumulatif,
                              b.kwh_akumulatif_awal
                              
                            from 
                              $this->tabel10 as b 
                            left join 
                              $this->tabel11 as bx 
                              on b.detail_id = bx.detail_id 
                            where 
                              bx.detail_id is null 
                              and b.headerid='$id' 
                            order by 
                              b.detail_id");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
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

    function update_dtl($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
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

    function update_dtlx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
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

    function update_dtl_b($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel4, $data6);
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

    function update_dtl_bx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel5, $data6);
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

    function update_dtl_c($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel6, $data6);
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

    function update_dtl_cx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel7, $data6);
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

    function update_dtl_d($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel8, $data6);
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

    function update_dtl_dx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel9, $data6);
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

    function update_dtl_e($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel10, $data6);
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

    function update_dtl_ex($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel11, $data6);
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

    function update_stdtlx($detail_id)
    {
        $this->db1->trans_start();
        $this->db1->query("Update $this->tabel3 set stdtl='0' where detail_id ='$detail_id'");
        $this->db1->trans_complete();
    }

    // delete aja, jadi gak ada update
    function delete_detail_byheaderid_a($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel2);
        return $query1;
    }

    function delete_detail_byheaderid_ax($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel3);
        return $query2;
    }

    function delete_detail_byheaderid_b($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel4);
        return $query1;
    }

    function delete_detail_byheaderid_bx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel5);
        return $query2;
    }

    function delete_detail_byheaderid_c($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel6);
        return $query1;
    }

    function delete_detail_byheaderid_cx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel7);
        return $query2;
    }

    function delete_detail_byheaderid_d($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel8);
        return $query1;
    }

    function delete_detail_byheaderid_dx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel9);
        return $query2;
    }
    function delete_detail_byheaderid_e($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel10);
        return $query1;
    }

    function delete_detail_byheaderid_ex($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel11);
        return $query2;
    }
}
