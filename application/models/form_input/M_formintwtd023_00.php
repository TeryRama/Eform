<?php
class M_formintwtd023_00 extends CI_Model
{
    var $tabel1  = 'tblfrmintwtd023hdr';
    var $tabel2  = 'tblfrmintwtd023dtl';
    var $tabel3  = 'tblfrmintwtd023dtlx';

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
                                    substring(docno from '.{2}$')::float vdocno
                                  from 
                                    $this->tabel1 
                                  where 
                                    extract(month from create_date)='$bulan'
                                    and extract(year from create_date)='$tahun'")->row();
    }

    function get_frmfss317_a($tahunbulan, $create_date, $date_today, $date_before){
        return $this->db1->query("WITH tbl_item AS (-- get list item
                                                    SELECT
                                                        b.detail_id,
                                                        C.detail_id_b,
                                                        d.detail_id_c,
                                                        item1,
                                                        item2,
                                                        item3 
                                                    FROM
                                                        tblmst_formitem_hdr
                                                        A JOIN tblmst_formitem_dtl b ON A.headerid = b.headerid
                                                        LEFT JOIN tblmst_formitem_dtl_b C ON A.headerid = C.headerid 
                                                        AND b.detail_id = C.detail_id_a
                                                        LEFT JOIN tblmst_formitem_dtl_c d ON A.headerid = d.headerid 
                                                        AND d.detail_id_b = C.detail_id_b 
                                                    WHERE
                                                        A.inactive = '0' 
                                                        AND form_kode = 'INT-WTD-023' 
                                                        AND PARAMETER = 'Tipe 1' 
                                                        AND departemen = 'WTD' 
                                                        AND tgl_efective IN (
                                                        SELECT MAX
                                                            ( tgl_efective ) 
                                                        FROM
                                                            tblmst_formitem_hdr 
                                                        WHERE
                                                            inactive = '0' 
                                                            AND form_kode = 'INT-WTD-023' 
                                                            AND PARAMETER = 'Tipe 1' 
                                                            AND departemen = 'WTD' 
                                                            AND tgl_efective <= '$create_date' 
                                                        ) 
                                                    ORDER BY
                                                        b.detail_id,
                                                        C.detail_id_b,
                                                        d.detail_id_c 
                                                    ),
                                                    tbl_317a AS (-- get total seluruh pakai air
                                                    SELECT
                                                        'Out put ( AIR )' :: TEXT operasi_jenis1,
                                                        '1.1.2 Total pakai Air' :: TEXT operasi_jenis2,
                                                        NULL :: TEXT operasi_jenis3,
                                                        ( SUM ( akumulatif :: NUMERIC ) + operasi_akumulatif :: NUMERIC ) operasi_akumulatif,
                                                        'Ton' :: TEXT operasi_satuan 
                                                    FROM
                                                        tblfrmfrmfss317hdr
                                                        AS A LEFT JOIN tblfrmfrmfss317dtl AS b ON A.headerid = b.headerid
                                                        LEFT JOIN tblfrmfrmfss317dtl_b AS C ON A.headerid = C.headerid 
                                                        AND C.operasi_jenis = 'WTD' 
                                                    WHERE
                                                        A.status_detail = '1' 
                                                        AND A.create_date = ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE
                                                    GROUP BY
	                                                    operasi_akumulatif UNION ALL-- get proses air, lama produksi, dan air wtd
                                                    SELECT
                                                        'Out put ( AIR )' :: TEXT operasi_jenis1,
                                                    CASE
                                                            
                                                            WHEN b.operasi_jenis = 'Jam Operasi (Proses)' THEN
                                                            '-  Lama Produksi' 
                                                            WHEN b.operasi_jenis = 'Total Air Gambut' THEN
                                                            '1.1.1 Total Proses Air' 
                                                            WHEN b.operasi_jenis = 'WTD' THEN
                                                            '1.2 Pemakaian Air oleh WTD' 
                                                        END operasi_jenis2,
                                                    NULL :: TEXT operasi_jenis3,
                                                    b.operasi_akumulatif :: NUMERIC,
                                                CASE
                                                        
                                                        WHEN b.operasi_jenis = 'Jam Operasi (Proses)' THEN
                                                        'Jam' 
                                                        WHEN b.operasi_jenis = 'Total Air Gambut' THEN
                                                        'Ton' 
                                                        WHEN b.operasi_jenis = 'WTD' THEN
                                                        'Ton' 
                                                    END operasi_satuan 
                                                FROM
                                                    tblfrmfrmfss317hdr
                                                    AS A LEFT JOIN tblfrmfrmfss317dtl_b b ON A.headerid = b.headerid 
                                                WHERE
                                                    A.status_detail = '1' 
                                                    AND A.create_date = ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE 
                                                    AND b.operasi_jenis IN ( 'Jam Operasi (Proses)', 'Total Air Gambut', 'WTD' ) UNION ALL-- get rata-rata air per jam
                                                SELECT
                                                    'Out put ( AIR )' :: TEXT operasi_jenis1,
                                                    '-  Rata-rata/Jam' :: TEXT operasi_jenis2,
                                                    NULL :: TEXT operasi_jenis3,
                                                    '0' operasi_nilai,
                                                    'Ton' :: TEXT operasi_satuan 
                                                FROM
                                                    (
                                                    SELECT
                                                        ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE create_date,
                                                        ( SUM ( akumulatif :: NUMERIC ) +  operasi_akumulatif :: NUMERIC  ) pakai_akumulatif 
                                                    FROM
                                                        tblfrmfrmfss317hdr
                                                        AS A LEFT JOIN tblfrmfrmfss317dtl AS b ON A.headerid = b.headerid
                                                        LEFT JOIN tblfrmfrmfss317dtl_b AS C ON A.headerid = C.headerid 
                                                        AND C.operasi_jenis = 'WTD' 
                                                    WHERE
                                                        A.status_detail = '1' 
                                                        AND A.create_date = ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE 
                                                    GROUP BY
	                                                    operasi_akumulatif
                                                    ) AS b
                                                    LEFT JOIN (
                                                    SELECT
                                                        ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE create_date,
                                                        operasi_akumulatif :: NUMERIC 
                                                    FROM
                                                        tblfrmfrmfss317hdr
                                                        AS A LEFT JOIN tblfrmfrmfss317dtl_b AS b ON A.headerid = b.headerid 
                                                    WHERE
                                                        A.status_detail = '1' 
                                                        AND A.create_date = ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE 
                                                        AND operasi_jenis = 'Total Air Gambut' 
                                                    ) AS C ON b.create_date = C.create_date UNION ALL-- get pakai air efektif
                                                SELECT
                                                    'Out put ( AIR )' :: TEXT operasi_jenis1,
                                                    '1.3 Pemakaian air Efektif ( Total pakai air - Pemakaian Air oleh WTD )' :: TEXT operasi_jenis2,
                                                    NULL :: TEXT operasi_jenis3,
                                                    ( pakai_akumulatif - operasi_akumulatif ) operasi_nilai,
                                                    'Ton' :: TEXT operasi_satuan 
                                                FROM
                                                    (
                                                    SELECT
                                                        ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE create_date,
                                                        ( SUM ( akumulatif :: NUMERIC ) + operasi_akumulatif :: NUMERIC ) pakai_akumulatif 
                                                    FROM
                                                        tblfrmfrmfss317hdr
                                                        AS A LEFT JOIN tblfrmfrmfss317dtl AS b ON A.headerid = b.headerid
                                                        LEFT JOIN tblfrmfrmfss317dtl_b AS C ON A.headerid = C.headerid 
                                                        AND C.operasi_jenis = 'WTD' 
                                                    WHERE
                                                        A.status_detail = '1' 
                                                        AND A.create_date = ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE 
                                                    GROUP BY
	                                                    operasi_akumulatif                                                    
                                                    ) AS b
                                                    LEFT JOIN (
                                                    SELECT
                                                        ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE create_date,
                                                        operasi_akumulatif :: NUMERIC 
                                                    FROM
                                                        tblfrmfrmfss317hdr
                                                        AS A LEFT JOIN tblfrmfrmfss317dtl_b AS b ON A.headerid = b.headerid 
                                                    WHERE
                                                        A.status_detail = '1' 
                                                        AND A.create_date = ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE 
                                                        AND operasi_jenis = 'WTD' 
                                                    ) AS C ON b.create_date = C.create_date UNION ALL-- get air bahan kimia kg
                                                SELECT
                                                    'PEMAKAIAN BAHAN KIMIA' :: TEXT operasi_jenis1,
                                                CASE
                                                        
                                                        WHEN operasi_jenis = 'Tawas (Kg)' THEN
                                                        '3.1 Al-Sulfat/Tawas' 
                                                        WHEN operasi_jenis = 'Caustic soda (Kg)' THEN
                                                        '3.2 Coustice Soda' 
                                                        WHEN operasi_jenis = 'TCCA (Kg)' THEN
                                                        '3.3 TCCA' 
                                                    END operasi_jenis2,
                                                    NULL :: TEXT operasi_jenis3,
                                                    operasi_akumulatif :: NUMERIC,
                                                    '(Kg)' :: TEXT operasi_satuan 
                                                FROM
                                                    tblfrmfrmfss317hdr
                                                    AS A LEFT JOIN tblfrmfrmfss317dtl_k AS b ON A.headerid = b.headerid 
                                                WHERE
                                                    A.status_detail = '1' 
                                                    AND A.create_date = ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE UNION ALL-- get effesiensi air bahan kimia
                                                SELECT
                                                    'Effs' :: TEXT operasi_jenis1,
                                                CASE
                                                        
                                                        WHEN operasi_jenis = 'Tawas (Kg)' THEN
                                                        '4.1 Al-Sulfat/Tawas' 
                                                        WHEN operasi_jenis = 'Caustic soda (Kg)' THEN
                                                        '4.2 Coustice Soda' 
                                                        WHEN operasi_jenis = 'TCCA (Kg)' THEN
                                                        '4.3 TCCA' 
                                                    END operasi_jenis2,
                                                    NULL :: TEXT operasi_jenis3,
                                                    ( C.operasi_akumulatif / b.operasi_akumulatif ) operasi_akumulatif,
                                                    '(Kg/M3)' :: TEXT operasi_satuan 
                                                FROM
                                                    (
                                                    SELECT
                                                        ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE create_date,
                                                        operasi_akumulatif :: NUMERIC 
                                                    FROM
                                                        tblfrmfrmfss317hdr
                                                        AS A LEFT JOIN tblfrmfrmfss317dtl_b AS b ON A.headerid = b.headerid 
                                                    WHERE
                                                        A.status_detail = '1' 
                                                        AND A.create_date = ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE 
                                                        AND operasi_jenis = 'Total Air Gambut' 
                                                    ) AS b
                                                    LEFT JOIN (
                                                    SELECT
                                                        ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE create_date,
                                                        operasi_jenis,
                                                        operasi_akumulatif :: NUMERIC 
                                                    FROM
                                                        tblfrmfrmfss317hdr
                                                        AS A LEFT JOIN tblfrmfrmfss317dtl_k AS b ON A.headerid = b.headerid 
                                                    WHERE
                                                        A.status_detail = '1' 
                                                        AND A.create_date = ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE 
                                                    ) AS C ON b.create_date = C.create_date UNION ALL-- get total per departemen
                                                SELECT
                                                    'Distribusi Air' operasi_jenis1,
                                                CASE
                                                        
                                                        WHEN nama_jenis_air = 'ASF' THEN
                                                        '6.1 After Sand filter' 
                                                        WHEN nama_jenis_air = 'ACF' THEN
                                                        '6.2 After Carbon filter' 
                                                        WHEN nama_jenis_air = 'AST' THEN
                                                        '6.3 After Softener' ELSE'6.4 After Reverse Osmosis' 
                                                    END operasi_jenis2,
                                                    nama_departemen operasi_jenis3,
                                                    akumulatif :: NUMERIC operasi_akumulatif,
                                                    '' :: TEXT operasi_satuan 
                                                FROM
                                                    tblfrmfrmfss317hdr
                                                    AS A LEFT JOIN tblfrmfrmfss317dtl AS b ON A.headerid = b.headerid 
                                                WHERE
                                                    A.status_detail = '1' 
                                                    AND A.create_date = ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE 
                                                    ),-- cari total per departemen
                                                    tbl317_persen AS (
                                                    SELECT
                                                        ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE create_date,
                                                    CASE
                                                            
                                                            WHEN nama_jenis_air = 'ASF' THEN
                                                            '6.1 After Sand filter' 
                                                            WHEN nama_jenis_air = 'ACF' THEN
                                                            '6.2 After Carbon filter' 
                                                            WHEN nama_jenis_air = 'AST' THEN
                                                            '6.3 After Softener' 
                                                            WHEN nama_jenis_air = 'RO' THEN
                                                            '6.4 After Reverse Osmosis' 
                                                            WHEN nama_jenis_air = 'UF' THEN
                                                            '6.5 After Ultar Filter' 
                                                        END nama_jenis_air,
                                                    b.nama_departemen,
                                                    SUM ( COALESCE ( NULLIF ( akumulatif, '' ), '0' ) :: NUMERIC ) total_dept 
                                                FROM
                                                    tblfrmfrmfss317hdr
                                                    A JOIN tblfrmfrmfss317dtl b ON A.headerid = b.headerid 
                                                WHERE
                                                    A.status_detail = '1' 
                                                    AND A.create_date = ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE 
                                                GROUP BY
                                                    b.nama_jenis_air,
                                                    b.nama_departemen 
                                                    ),-- get all total depts
                                                    tbl317_grandtotal AS (
                                                    SELECT
                                                        ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE create_date,
                                                        SUM ( COALESCE ( NULLIF ( akumulatif, '' ), '0' ) :: NUMERIC ) grand_total 
                                                    FROM
                                                        tblfrmfrmfss317hdr
                                                        A JOIN tblfrmfrmfss317dtl b ON A.headerid = b.headerid 
                                                    WHERE
                                                        A.status_detail = '1' 
                                                        AND A.create_date = ( date_trunc( 'MONTH', ( '$tahunbulan' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: DATE 
                                                    ),-- get next target
                                                    tbl028_next_target AS (
                                                    SELECT
                                                        b.dtl_a_definisi_1,
                                                        b.dtl_a_definisi_2,
                                                        b.dtl_a_definisi_3,
                                                        b.dtl_a_target_next AS target_today,
                                                        b.dtl_a_target_persen_next AS target_persen_today 
                                                    FROM
                                                        tblfrmintwtd023hdr
                                                        A LEFT JOIN tblfrmintwtd023dtl b ON A.headerid = b.headerid 
                                                    WHERE
                                                        A.date_next = '$date_today' 
                                                    ),-- get before realisasi
                                                    tbl028_before_realisasi AS (
                                                    SELECT
                                                        b.dtl_a_definisi_1,
                                                        b.dtl_a_definisi_2,
                                                        b.dtl_a_definisi_3,
                                                        b.dtl_a_realisai_today AS realisai_before,
                                                        b.dtl_a_realisai_persen_today AS realisai_persen_before 
                                                    FROM
                                                        tblfrmintwtd023hdr
                                                        A LEFT JOIN tblfrmintwtd023dtl b ON A.headerid = b.headerid 
                                                    WHERE
                                                        A.date_today = '$date_before' 
                                                    ) SELECT
                                                    tbl_item.detail_id,
                                                    tbl_item.detail_id_b,
                                                    tbl_item.detail_id_c,
                                                    tbl_item.item1,
                                                    tbl_item.item2,
                                                    tbl_item.item3,
                                                    tbl028_before_realisasi.realisai_before,
                                                    tbl028_before_realisasi.realisai_persen_before,
                                                    tbl028_next_target.target_today,
                                                    tbl028_next_target.target_persen_today,
                                                    tbl_317a.operasi_akumulatif,
                                                    tbl_317a.operasi_satuan,
                                                    tbl317_persen.total_dept / tbl317_grandtotal.grand_total * 100 operasi_persen,
                                                    ROW_NUMBER ( ) OVER ( PARTITION BY tbl_item.item1 ORDER BY tbl_item.detail_id ASC, tbl_item.detail_id_b ASC, tbl_item.detail_id_c ASC ) num_row,
                                                    ROW_NUMBER ( ) OVER ( PARTITION BY tbl_item.item1, tbl_item.item2 ORDER BY tbl_item.detail_id ASC, tbl_item.detail_id_b ASC, tbl_item.detail_id_c ASC ) num_row_b,
                                                    ROW_NUMBER ( ) OVER ( PARTITION BY tbl_item.item1 ORDER BY tbl_item.detail_id DESC, tbl_item.detail_id_b DESC, tbl_item.detail_id_c DESC ) num_row_desc,
                                                    ROW_NUMBER ( ) OVER ( PARTITION BY tbl_item.item1, tbl_item.item2 ORDER BY tbl_item.detail_id DESC, tbl_item.detail_id_b DESC, tbl_item.detail_id_c DESC ) num_row_b_desc 
                                                FROM
                                                    tbl_item
                                                    LEFT JOIN tbl_317a ON tbl_item.item1 = tbl_317a.operasi_jenis1 
                                                    AND tbl_item.item2 = tbl_317a.operasi_jenis2 
                                                    AND tbl_item.item3 LIKE'%' || tbl_317a.operasi_jenis3 || '%' 
                                                    OR tbl_item.item1 = tbl_317a.operasi_jenis1 
                                                    AND tbl_item.item2 = tbl_317a.operasi_jenis2 
                                                    AND tbl_item.item3
                                                    IS NULL LEFT JOIN tbl317_persen ON tbl_item.item2 = tbl317_persen.nama_jenis_air 
                                                    AND tbl_item.item3 LIKE'%' || tbl317_persen.nama_departemen || '%'
                                                    LEFT JOIN tbl317_grandtotal ON tbl317_grandtotal.create_date = tbl317_persen.create_date
                                                    LEFT JOIN tbl028_next_target ON tbl_item.item1 = tbl028_next_target.dtl_a_definisi_1 
                                                    AND tbl_item.item2 = tbl028_next_target.dtl_a_definisi_2 
                                                    AND tbl_item.item3 = tbl028_next_target.dtl_a_definisi_3 
                                                    OR tbl_item.item1 = tbl028_next_target.dtl_a_definisi_1 
                                                    AND tbl_item.item2 = tbl028_next_target.dtl_a_definisi_2 
                                                    AND tbl_item.item3
                                                    IS NULL LEFT JOIN tbl028_before_realisasi ON tbl_item.item1 = tbl028_before_realisasi.dtl_a_definisi_1 
                                                    AND tbl_item.item2 = tbl028_before_realisasi.dtl_a_definisi_2 
                                                    AND tbl_item.item3 = tbl028_before_realisasi.dtl_a_definisi_3 
                                                    OR tbl_item.item1 = tbl028_before_realisasi.dtl_a_definisi_1 
                                                    AND tbl_item.item2 = tbl028_before_realisasi.dtl_a_definisi_2 
                                                    AND tbl_item.item3 IS NULL 
                                                ORDER BY
                                                    tbl_item.detail_id,
                                                    tbl_item.detail_id_b,
                                                    tbl_item.detail_id_c")->result();
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
        $this->db1->select('*,
                            row_number () over (partition by dtl_a_definisi_1 order by detail_id) no_urut,
                            row_number () over (partition by dtl_a_definisi_1 order by detail_id desc) no_urut_desc,
                            row_number () over (partition by dtl_a_definisi_2 order by detail_id) no_urut_b,
                            row_number () over (partition by dtl_a_definisi_2 order by detail_id desc) no_urut_b_desc
                        ');
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

    function get_detail_lap_byid($id)
    {
        $q = $this->db1->query("SELECT
                                    dtl_a_definisi_1
                                FROM
                                    ( SELECT DENSE_RANK ( ) OVER ( PARTITION BY dtl_a_definisi_1 ORDER BY detail_id ) no_urut, dtl_a_definisi_1, headerid, detail_id FROM tblfrmintwtd023dtl ORDER BY detail_id ) x 
                                WHERE
                                    headerid = '$id' 
                                    and no_urut = '1'
                                GROUP BY
                                    dtl_a_definisi_1,
                                    detail_id
                                ORDER BY
                                    detail_id")->result();

        $final = array();
        if (count($q) > 0) {
            foreach ($q as $row) {
                $q2 = $this->db1->query("SELECT dtl_a_definisi_2, dtl_a_realisai_before, dtl_a_realisai_persen_before, dtl_a_target_today, dtl_a_target_persen_today, dtl_a_realisai_today, dtl_a_realisai_persen_today, dtl_a_target_next, dtl_a_target_persen_next FROM tblfrmintwtd023dtl WHERE headerid='$id' AND dtl_a_definisi_1='$row->dtl_a_definisi_1' order by detail_id")->result();
                if (count($q2) > 0) {
                    foreach ($q2 as $row2) {
                        $q3 = $this->db1->query("SELECT dtl_a_definisi_3, dtl_a_realisai_before, dtl_a_realisai_persen_before, dtl_a_target_today, dtl_a_target_persen_today, dtl_a_realisai_today, dtl_a_realisai_persen_today, dtl_a_target_next, dtl_a_target_persen_next FROM tblfrmintwtd023dtl WHERE headerid='$id' AND dtl_a_definisi_1='$row->dtl_a_definisi_1' and dtl_a_definisi_2='$row2->dtl_a_definisi_2' order by detail_id")->result();
                        if (count($q3) > 1) {
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

    function get_detail_lap_byidx($id)
    {
        return $this->get_detail_lap_byid($id, $this->tabel3);
    }

    function check($create_date, $docno, $headerid = null)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        // $this->db1->where('docno', $docno);

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

                              dtl_a_definisi_1,
                              dtl_a_definisi_2,
                              dtl_a_definisi_3,
                              dtl_a_realisai_before,
                              dtl_a_realisai_persen_before,
                              dtl_a_target_today,
                              dtl_a_target_persen_today,
                              dtl_a_realisai_today,
                              dtl_a_realisai_persen_today,
                              dtl_a_target_next,
                              dtl_a_target_persen_next
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.dtl_a_definisi_1,
                              b.dtl_a_definisi_2,
                              b.dtl_a_definisi_3,
                              b.dtl_a_realisai_before,
                              b.dtl_a_realisai_persen_before,
                              b.dtl_a_target_today,
                              b.dtl_a_target_persen_today,
                              b.dtl_a_realisai_today,
                              b.dtl_a_realisai_persen_today,
                              b.dtl_a_target_next,
                              b.dtl_a_target_persen_next
                              
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
    function get_list_item($tipe, $create_date)
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
                                    and form_kode = 'INT-WTD-023'
                                    and parameter = '$tipe'
                                    and departemen = 'WTD'
                                    and tgl_efective in (select 
                                                      max(tgl_efective) 
                                                    from 
                                                      tblmst_formitem_hdr 
                                                    where
                                                      inactive='0'
                                                      and form_kode = 'INT-WTD-023'
                                                      and parameter = '$tipe'
                                                      and departemen = 'WTD'
                                                      and tgl_efective <='$create_date') 
                                                      ORDER BY detail_id")->result();

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
                                          ORDER BY 1")->result();
                if (count($q2) > 0) {
                    foreach ($q2 as $row2) {
                        $q3 = $this->db1->query("select 
                                                  *,
                                                  'item3' dtl_level
                                                from 
                                                  tblmst_formitem_dtl_c
                                                where 
                                                  headerid=$row->headerid
                                                  and detail_id_b=$row2->detail_id_b")->result();
                        if (count($q3) > 0) {
                            foreach ($q3 as $row3) {
                                $q4 = $this->db1->query("select 
                                                          *,
                                                          'item4' dtl_level
                                                        from 
                                                          tblmst_formitem_dtl_d
                                                        where 
                                                          headerid=$row->headerid
                                                          and detail_id_c=$row3->detail_id_c")->result();
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
}
