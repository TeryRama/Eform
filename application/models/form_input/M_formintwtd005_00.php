<?php
class M_formintwtd005_00 extends CI_Model
{

    var $tabel1 = 'tblfrmintwtd005hdr';
    var $tabel2 = 'tblfrmintwtd005dtl';
    var $tabel3 = 'tblfrmintwtd005dtlx';

    var $tabel_trn_dtl = 'tbltrn_schedule_dtl';


    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

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
    function get_date_calender($bulan, $tahun)
    {
        return $this->db1->query("SELECT
                                    (extract (day from date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) ) AS day 
                                FROM
                                    generate_series (
                                        0,
                                        ( EXTRACT ( DAY FROM date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: INTEGER - 1 ) 
                                    ) n ")->result();
    }
    function get_list_komponen($create_date, $kode_pallet)
    {
        return $this->db1->query("select 
                                    d.item3,
                                    c.part_komponen
                                from
                                    tblmstformitemmesin_hdr a
                                left join
                                    tblmstformitemmesin_dtl b
                                    on a.headerid=b.headerid
                                left join
                                    tblmstformitemmesin_dtl_b c
                                    on a.headerid=c.headerid
                                left join
                                    tblmstformitemmesin_dtl_c d
                                    on a.headerid=d.headerid
									and d.detail_id_b = c.detail_id
                                left join
                                    tblfrmfrmfss064dtl e
                                    on d.item3::int = e.detail_id
                                where
                                    a.departemen = 'WTD'
                                    and c.detail_id = '12'
                                    and a.parameter = 'Tipe 1'
                                    and a.form_kode = 'FRM-FSS-812'
                                    and d.item3 = '$kode_pallet'
                                    and tgl_efective in (select 
                                                      max(tgl_efective) 
                                                    from 
                                                      tblmstformitemmesin_hdr 
                                                    where
                                                      form_kode = 'FRM-FSS-812'
                                                      and parameter = 'Tipe 1'
                                                      and departemen = 'WTD'
                                                      and tgl_efective <='$create_date') 
                                GROUP BY
                                    d.item3,
                                    c.part_komponen
                                order by 
                                    d.item3")->result();
    }
    function get_list_hand_pallet($create_date)
    {
        return $this->db1->query("select 
                                    c.detail_id,
                                    c.item2,
                                    c.part_komponen,
                                    d.item3,
                                    e.kode_mesin
                                from
                                    tblmstformitemmesin_hdr a
                                left join
                                    tblmstformitemmesin_dtl b
                                    on a.headerid=b.headerid
                                left join
                                    tblmstformitemmesin_dtl_b c
                                    on a.headerid=c.headerid
                                left join
                                    tblmstformitemmesin_dtl_c d
                                    on a.headerid=d.headerid
									and d.detail_id_b = c.detail_id
                                left join
                                    tblfrmfrmfss064dtl e
                                    on d.item3::int = e.detail_id
                                where
                                    a.departemen = 'WTD'
                                    and c.detail_id = '12'
                                    and a.parameter = 'Tipe 1'
                                    and a.form_kode = 'FRM-FSS-812'
                                    and tgl_efective in (select 
                                                      max(tgl_efective) 
                                                    from 
                                                      tblmstformitemmesin_hdr 
                                                    where
                                                      form_kode = 'FRM-FSS-812'
                                                      and parameter = 'Tipe 1'
                                                      and departemen = 'WTD'
                                                      and tgl_efective <='$create_date') 
                                GROUP BY
                                    c.detail_id,
                                    c.item2,
                                    d.detail_id,
                                    d.item3,
                                    e.kode_mesin
                                order by 
                                    d.detail_id")->result();
    }

    function get_dtfrmfss188_by($bulan, $tahun, $create_date, $headerid)
    {
        $q = $this->db1->query("select 
                                    ROW_NUMBER ( ) OVER ( PARTITION BY detail_id ORDER BY c.detail_id_b DESC ) no_urut_desc,
                                    ROW_NUMBER ( ) OVER ( PARTITION BY detail_id ORDER BY c.detail_id_b ) no_urut,
                                    b.detail_id as point,
                                    b.item1 as v_point,
                                    c.detail_id_b as kode,
                                    c.item2 as v_kode,
                                    c.spek2 as frequency,
                                    d.item3 as v_pic,
                                    d.spek3 as ket,
                                    d.detail_id_c as pic
                                from 
                                    tblmst_formitem_hdr a 
                                join
                                    tblmst_formitem_dtl b 
                                    on a.headerid=b.headerid
                                join
                                    tblmst_formitem_dtl_b c
                                    on a.headerid=c.headerid
                                    and b.detail_id=c.detail_id_a
                                join
                                    tblmst_formitem_dtl_c d
                                    on a.headerid=d.headerid
                                    and c.detail_id_b=d.detail_id_b
                                where 
                                    a.inactive='0'
                                    and form_kode = 'FRM-FSS-188'
                                    and parameter = 'Tipe 1'
                                    and departemen = 'WTD'
                                    and tgl_efective in (select 
                                                            max(tgl_efective) 
                                                        from 
                                                            tblmst_formitem_hdr 
                                                        where
                                                            inactive='0'
                                                            and form_kode = 'FRM-FSS-188'
                                                            and parameter = 'Tipe 1'
                                                            and departemen = 'WTD'
                                                            and tgl_efective <='$create_date') 
                                ORDER BY 
                                    detail_id,
                                    c.detail_id_b,
                                    detail_id_c")->result();
        $final = array();
        if (count($q) > 0) {
            foreach ($q as $row) {
                $q2 = $this->db1->query("select
											EXTRACT(DAY FROM ( date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS date, 
											EXTRACT(MONTH FROM ( date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS month,
											EXTRACT(YEAR FROM ( date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS year
									    FROM
											generate_series ( 0, ( EXTRACT ( DAY FROM date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: INTEGER - 1 )  ) n")->result();
                if (count($q2) > 0) {
                    foreach ($q2 as $row2) {
                        $q3 = $this->db1->query("select
                                                    a.create_date,
                                                    a.dept,
                                                    a.deptabbr,
                                                    a.minggu,
                                                    b.point,
                                                    b.kode,
                                                    b.gagal_lulus
                                                from
                                                    tblfrmfrmfss188hdr a
                                                join
                                                    tblfrmfrmfss188dtl b
                                                    on a.headerid=b.headerid
                                                where
                                                    EXTRACT ( DAY FROM create_date ) = '$row2->date'
                                                    AND EXTRACT ( MONTH FROM create_date ) = '$row2->month'
                                                    AND EXTRACT ( YEAR FROM create_date ) = '$row2->year'
                                                    and b.point = '$row->point'
                                                    and b.kode = '$row->kode'
                                                    and a.status_detail = '1'
                                                ORDER BY
                                                    a.create_date,
                                                    b.detail_id")->result();
                        $row2->children2 = $q3;
                        $q4 = $this->db1->query("select
                                                    a.tgl_schedule
                                                from
                                                    tbltrn_schedule_dtl a
                                                where
                                                    a.nama = '$row->point'
                                                    and a.kode = '$row->kode'
                                                    and a.pic = '$row->pic'
                                                    and a.kode_form = 'intwtd005'
                                                    and a.headerid_form = '$headerid'
                                                ORDER BY
                                                    a.detail_id")->result();
                        $row2->children3 = $q4;
                    }
                    $row->children = $q2;
                }
                array_push($final, $row);
            }
        }
        return $final;
    }
    function get_dtfrmfss188x_by($bulan, $tahun, $create_date, $headerid)
    {
        $q = $this->db1->query("select 
                                    ROW_NUMBER ( ) OVER ( PARTITION BY detail_id ORDER BY c.detail_id_b DESC ) no_urut_desc,
                                    ROW_NUMBER ( ) OVER ( PARTITION BY detail_id ORDER BY c.detail_id_b ) no_urut,
                                    b.detail_id as point,
                                    b.item1 as v_point,
                                    c.detail_id_b as kode,
                                    c.item2 as v_kode,
                                    c.spek2 as frequency,
                                    d.item3 as v_pic,
                                    d.spek3 as ket,
                                    d.detail_id_c as pic
                                from 
                                    tblmst_formitem_hdr a 
                                join
                                    tblmst_formitem_dtl b 
                                    on a.headerid=b.headerid
                                join
                                    tblmst_formitem_dtl_b c
                                    on a.headerid=c.headerid
                                    and b.detail_id=c.detail_id_a
                                join
                                    tblmst_formitem_dtl_c d
                                    on a.headerid=d.headerid
                                    and c.detail_id_b=d.detail_id_b
                                where 
                                    a.inactive='0'
                                    and form_kode = 'FRM-FSS-188'
                                    and parameter = 'Tipe 1'
                                    and departemen = 'WTD'
                                    and tgl_efective in (select 
                                                            max(tgl_efective) 
                                                        from 
                                                            tblmst_formitem_hdr 
                                                        where
                                                            inactive='0'
                                                            and form_kode = 'FRM-FSS-188'
                                                            and parameter = 'Tipe 1'
                                                            and departemen = 'WTD'
                                                            and tgl_efective <='$create_date') 
                                ORDER BY 
                                    detail_id,
                                    c.detail_id_b,
                                    detail_id_c")->result();
        $final = array();
        if (count($q) > 0) {
            foreach ($q as $row) {
                $q2 = $this->db1->query("select
											EXTRACT(DAY FROM ( date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS date, 
											EXTRACT(MONTH FROM ( date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS month,
											EXTRACT(YEAR FROM ( date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS year
									    FROM
											generate_series ( 0, ( EXTRACT ( DAY FROM date_trunc( 'MONTH', ( '" . $tahun . $bulan . "' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: INTEGER - 1 )  ) n")->result();
                if (count($q2) > 0) {
                    foreach ($q2 as $row2) {
                        $q3 = $this->db1->query("select
                                                    a.create_date,
                                                    a.dept,
                                                    a.deptabbr,
                                                    a.minggu,
                                                    b.point,
                                                    b.kode,
                                                    b.gagal_lulus
                                                from
                                                    tblfrmxhdr a
                                                join
                                                    tblfrmfrmfss188dtlx b
                                                    on a.headerid=b.headerid
                                                where
                                                    EXTRACT ( DAY FROM create_date ) = '$row2->date'
                                                    AND EXTRACT ( MONTH FROM create_date ) = '$row2->month'
                                                    AND EXTRACT ( YEAR FROM create_date ) = '$row2->year'
                                                    and b.point = '$row->point'
                                                    and b.kode = '$row->kode'
                                                    and a.status_detail = '1'
                                                ORDER BY
                                                    a.create_date,
                                                    b.detail_id")->result();
                        $row2->children2 = $q3;
                        $q4 = $this->db1->query("select
                                                    a.tgl_schedule
                                                from
                                                    tbltrn_schedule_dtl a
                                                where
                                                    a.nama = '$row->point'
                                                    and a.kode = '$row->kode'
                                                    and a.pic = '$row->pic'
                                                    and a.kode_form = 'intwtd005'
                                                    and a.headerid_form = '$headerid'
                                                ORDER BY
                                                    a.detail_id")->result();
                        $row2->children3 = $q4;
                    }
                    $row->children = $q2;
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

    function get_trans_byid($id, $kode_form)
    {
        $this->db1->select("$this->tabel_trn_dtl.*,
                            tblmst_formitem_dtl.item1 as v_nama,
                            tblmst_formitem_dtl_b.item2 as v_kode,
                            tblmst_formitem_dtl_b.spek2 as frequency,
                            tblmst_formitem_dtl_c.item3 as v_pic,
                            ROW_NUMBER ( ) OVER ( PARTITION BY nama ORDER BY $this->tabel_trn_dtl.detail_id DESC ) no_urut_desc,
                            ROW_NUMBER ( ) OVER ( PARTITION BY nama ORDER BY $this->tabel_trn_dtl.detail_id ) no_urut,");
        $this->db1->from($this->tabel_trn_dtl);
        $this->db1->join('tblmst_formitem_dtl', 'tblmst_formitem_dtl.detail_id = (' . $this->tabel_trn_dtl . '.nama::INT)');
        $this->db1->join('tblmst_formitem_dtl_b', 'tblmst_formitem_dtl_b.detail_id_b = (' . $this->tabel_trn_dtl . '.kode::INT)');
        $this->db1->join('tblmst_formitem_dtl_c', 'tblmst_formitem_dtl_c.detail_id_c = ' . $this->tabel_trn_dtl . '.pic');
        $this->db1->where('headerid_form', $id);
        $this->db1->where('kode_form', $kode_form);
        $this->db1->order_by($this->tabel_trn_dtl . ".detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
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
    /// check group
    function check($create_date, $docno, $kode, $bulan)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);
        $this->db1->where('docno', $docno);
        $this->db1->where('kode', $kode);
        $this->db1->where('bulan', $bulan);
        $query = $this->db1->get();
        return $query;
    }

    function check2($create_date, $docno, $kode, $bulan, $headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);
        $this->db1->where('docno', $docno);
        $this->db1->where('kode', $kode);
        $this->db1->where('bulan', $bulan);
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

    function insert_trans($data_modal)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel_trn_dtl, $data_modal);
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

    function insert_detail($data6b)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel2, $data6b);
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

                              nama_bagian,
                              day1,
                              day2,
                              day3,
                              day4,
                              day5,
                              day6,
                              day7,
                              day8,
                              day9,
                              day10,
                              day11,
                              day12,
                              day13,
                              day14,
                              day15,
                              day16,
                              day17,
                              day18,
                              day19,
                              day20,
                              day21,
                              day22,
                              day23,
                              day24,
                              day25,
                              day26,
                              day27,
                              day28,
                              day29,
                              day30,
                              day31
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.nama_bagian,
                              b.day1,
                              b.day2,
                              b.day3,
                              b.day4,
                              b.day5,
                              b.day6,
                              b.day7,
                              b.day8,
                              b.day9,
                              b.day10,
                              b.day11,
                              b.day12,
                              b.day13,
                              b.day14,
                              b.day15,
                              b.day16,
                              b.day17,
                              b.day18,
                              b.day19,
                              b.day20,
                              b.day21,
                              b.day22,
                              b.day23,
                              b.day24,
                              b.day25,
                              b.day26,
                              b.day27,
                              b.day28,
                              b.day29,
                              b.day30,
                              b.day31
                             
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

    /// update group
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
    function update_trans($detail_id, $data_modal)
    {
        $this->db1->trans_begin();
        $this->db1->set($data_modal);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_trn_dtl, $data_modal);
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

    function delete_detail($detail_id)
    {
        $this->db1->where('detail_id', $detail_id);
        $query1 = $this->db1->delete($this->tabel2);
        return $query1;
    }

    function delete_detailx($detail_id)
    {
        $this->db1->where('detail_id', $detail_id);
        $query2 = $this->db1->delete($this->tabel3);
        return $query2;
    }
}
