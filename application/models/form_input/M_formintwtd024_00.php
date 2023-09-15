<?php
class M_formintwtd024_00 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss317hdr';
    var $tabel2 = 'tblfrmfrmfss317dtl';
    var $tabel3 = 'tblfrmintwtd024dtlx';


    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
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

    function get_date_calender($bulan, $tahun)
    {
        return $this->db1->query("SELECT
                                    (extract (day from date_trunc( 'MONTH', ( '".$tahun . $bulan."' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) ) AS DATE 
                                FROM
                                    generate_series (
                                        0,
                                        ( EXTRACT ( DAY FROM date_trunc( 'MONTH', ( '".$tahun . $bulan."' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: INTEGER - 1 ) 
                                    ) n ")->result();
    }

    function get_detail_lap_bydate($bulan, $tahun)
    {

        $q = $this->db1->query("SELECT
                                    ROW_NUMBER ( ) OVER ( PARTITION BY nama_jenis_air ORDER BY nama_departemen DESC ) no_urut_desc,
                                    ROW_NUMBER ( ) OVER ( PARTITION BY nama_jenis_air ORDER BY nama_departemen ) no_urut,
                                    ROW_NUMBER ( ) OVER ( PARTITION BY nama_jenis_air, nama_departemen ORDER BY  nama_departemen ) no_urut2_asc,
                                    nama_jenis_air,
                                    nama_departemen
                                FROM
                                    tblfrmfrmfss317hdr A
                                LEFT JOIN
                                    tblfrmfrmfss317dtl b 
                                    ON A.headerid = b.headerid 
                                WHERE
                                    EXTRACT ( MONTH FROM create_date ) = '$bulan'
                                    and EXTRACT ( YEAR FROM create_date ) = '$tahun'
                                GROUP BY
                                    nama_jenis_air,
                                    nama_departemen
                                ORDER BY
                                    nama_jenis_air")->result();
        $final = array();
        if (count($q) > 0) {
            foreach ($q as $row) {
                $q2 = $this->db1->query("WITH tb1 as(SELECT
                                                        pemakaian,
                                                        EXTRACT ( DAY FROM create_date ) day_date,
                                                        EXTRACT ( MONTH FROM create_date ) month_date 
                                                    FROM
                                                        tblfrmfrmfss317hdr
                                                        A full JOIN tblfrmfrmfss317dtl b ON A.headerid = b.headerid
                                                    WHERE
                                                        EXTRACT ( MONTH FROM create_date ) = '$bulan' 
                                                        AND EXTRACT ( YEAR FROM create_date ) = '$tahun' 
                                                        AND nama_jenis_air = '$row->nama_jenis_air' 
                                                        AND nama_departemen = '$row->nama_departemen' 
                                                    ORDER BY
                                                        create_date),
                                            tb2 as (SELECT
                                                        EXTRACT(DAY FROM ( date_trunc( 'MONTH', ( '" . $tahun . $bulan ."' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS DATE, 
                                                        EXTRACT(MONTH FROM ( date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS DATE_MONTH2  
                                                    FROM
                                                        generate_series ( 0, ( EXTRACT ( DAY FROM date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: INTEGER - 1 )  ) n )
                                        SELECT
                                            CASE
                                            WHEN pemakaian IS NOT NULL THEN
                                                pemakaian :: numeric
                                            ELSE
                                                0
                                            END pemakaian,
                                            tb2.DATE as day_date,
                                            tb2.DATE_MONTH2 as month_date
                                        FROM
                                            tb1
                                        FULL JOIN
                                            tb2
                                            on tb1.day_date = tb2.date")->result();
                $row->children = $q2;
                $q3 = $this->db1->query("WITH tb1 as(SELECT
                                                        sum(pemakaian::NUMERIC) total_pemakaian,
                                                        EXTRACT ( DAY FROM create_date ) day_date,
                                                        EXTRACT ( MONTH FROM create_date ) month_date 
                                                    FROM
                                                        tblfrmfrmfss317hdr
                                                        A full JOIN tblfrmfrmfss317dtl b ON A.headerid = b.headerid
                                                    WHERE
                                                        EXTRACT ( MONTH FROM create_date ) = '$bulan' 
                                                        AND EXTRACT ( YEAR FROM create_date ) = '$tahun' 
                                                        AND nama_jenis_air = '$row->nama_jenis_air'  
                                                    group by
                                                        create_date
                                                    ORDER BY
                                                        create_date),
                                            tb2 as (SELECT
                                                        EXTRACT(DAY FROM ( date_trunc( 'MONTH', ( '" . $tahun . $bulan ."' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS DATE, 
                                                        EXTRACT(MONTH FROM ( date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS DATE_MONTH2  
                                                    FROM
                                                        generate_series ( 0, ( EXTRACT ( DAY FROM date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: INTEGER - 1 )  ) n )
                                        SELECT
                                            CASE
                                            WHEN total_pemakaian IS NOT NULL THEN
                                                total_pemakaian :: numeric
                                            ELSE
                                                0
                                            END total_pemakaian,
                                            tb2.DATE as day_date,
                                            tb2.DATE_MONTH2 as month_date
                                        FROM
                                            tb1
                                        FULL JOIN
                                            tb2
                                            on tb1.day_date = tb2.date")->result();
                $row->children2 = $q3;
                $q4 = $this->db1->query("WITH tb1 as(SELECT
                                                        sum(pemakaian::NUMERIC) total_grand_pemakaian,
                                                        EXTRACT ( DAY FROM create_date ) day_date,
                                                        EXTRACT ( MONTH FROM create_date ) month_date 
                                                    FROM
                                                        tblfrmfrmfss317hdr
                                                        A full JOIN tblfrmfrmfss317dtl b ON A.headerid = b.headerid
                                                    WHERE
                                                        EXTRACT ( MONTH FROM create_date ) = '$bulan' 
                                                        AND EXTRACT ( YEAR FROM create_date ) = '$tahun'  
                                                    group by
                                                        create_date
                                                    ORDER BY
                                                        create_date),
                                            tb2 as (SELECT
                                                        EXTRACT(DAY FROM ( date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS DATE, 
                                                        EXTRACT(MONTH FROM ( date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS DATE_MONTH2 
                                                    FROM
                                                        generate_series ( 0, ( EXTRACT ( DAY FROM date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: INTEGER - 1 )  ) n )
                                        SELECT
                                            CASE
                                            WHEN total_grand_pemakaian IS NOT NULL THEN
                                                total_grand_pemakaian :: numeric
                                            ELSE
                                                0
                                            END total_grand_pemakaian,
                                            tb2.DATE as day_date,
                                            tb2.DATE_MONTH2 as month_date
                                        FROM
                                            tb1
                                        FULL JOIN
                                            tb2
                                            on tb1.day_date = tb2.date")->result();
                $row->children3 = $q4;
                $q5 = $this->db1->query("SELECT
                                            sum(pemakaian::NUMERIC) pemakaian_akumulatif
                                            -- akumulatif::NUMERIC pemakaian_akumulatif
                                        FROM
                                            tblfrmfrmfss317hdr
                                            A full JOIN tblfrmfrmfss317dtl b ON A.headerid = b.headerid
                                        WHERE
                                            -- create_date = (select max(create_date) from tblfrmfrmfss317hdr where EXTRACT ( MONTH FROM create_date ) = '$bulan' AND EXTRACT ( YEAR FROM create_date ) = '$tahun')
                                            EXTRACT ( MONTH FROM create_date ) = '$bulan' 
                                            AND EXTRACT ( YEAR FROM create_date ) = '$tahun'
                                            AND nama_jenis_air = '$row->nama_jenis_air' 
                                            AND nama_departemen = '$row->nama_departemen'")->result();
                $row->children4 = $q5;
                $q6 = $this->db1->query("SELECT
                                            sum(pemakaian::NUMERIC) pemakaian_akumulatif_per_jenis
                                            -- akumulatif::NUMERIC pemakaian_akumulatif_per_jenis
                                        FROM
                                            tblfrmfrmfss317hdr
                                            A full JOIN tblfrmfrmfss317dtl b ON A.headerid = b.headerid
                                        WHERE
                                            -- create_date = (select max(create_date) from tblfrmfrmfss317hdr where EXTRACT ( MONTH FROM create_date ) = '$bulan' AND EXTRACT ( YEAR FROM create_date ) = '$tahun')  
                                            EXTRACT ( MONTH FROM create_date ) = '$bulan' 
                                            AND EXTRACT ( YEAR FROM create_date ) = '$tahun'
                                            AND nama_jenis_air = '$row->nama_jenis_air'")->result();
                $row->children5 = $q6;
                $q7 = $this->db1->query("SELECT
                                            sum(pemakaian::NUMERIC) pemakaian_akumulatif_seluruhan
                                            -- sum(akumulatif::NUMERIC) pemakaian_akumulatif_seluruhan
                                        FROM
                                            tblfrmfrmfss317hdr
                                            A full JOIN tblfrmfrmfss317dtl b ON A.headerid = b.headerid
                                        WHERE
                                            -- create_date = (select max(create_date) from tblfrmfrmfss317hdr where EXTRACT ( MONTH FROM create_date ) = '$bulan' AND EXTRACT ( YEAR FROM create_date ) = '$tahun')
                                            EXTRACT ( MONTH FROM create_date ) = '$bulan' 
                                            AND EXTRACT ( YEAR FROM create_date ) = '$tahun'
                                            ")->result();
                $row->children6 = $q7;
                array_push($final, $row);
            }
        }
        return $final;
    }

    function get_detail_byid($id)
    {
        $query = $this->db1->query("SELECT
                                        *,
                                        ROW_NUMBER ( ) OVER ( PARTITION BY nama_jenis_air ORDER BY detail_id DESC ) no_urut_desc,
                                        ROW_NUMBER ( ) OVER ( PARTITION BY nama_jenis_air ORDER BY detail_id ) no_urut,
                                        ROW_NUMBER ( ) OVER ( PARTITION BY nama_jenis_air, nama_departemen ORDER BY detail_id ) no_urut2_asc,
                                        ROW_NUMBER ( ) OVER ( PARTITION BY nama_jenis_air, nama_departemen ORDER BY detail_id DESC ) no_urut2_desc
                                    FROM
                                        tblfrmfrmfss317dtl 
                                    WHERE
                                        headerid = '$id'
                                    order by detail_id ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_nama_air()
    {
        return $this->db1->query("SELECT DISTINCT nama_jenis_air,nama_departemen FROM tblfrmfrmfss317dtl")->result();
    }

    function get_detail_bulanan($bln,$tgl)
    {
        $tbl = $tbl ?? $this->tabel2;
        
        return $this->db1->query("SELECT
                                        a.akumulatif 
                                    FROM
                                        $this->tabel1 a
                                    LEFT JOIN 
                                         $tbl b 
                                            ON a.headerid = b.headerid 
                                    WHERE
                                        EXTRACT ( MONTH FROM create_date ) = '$bln' 
                                        AND status_detail = '1' 
                                        AND create_date = '$tgl' 
                                    ORDER BY
                                        detail_id")->result();
    }
}
