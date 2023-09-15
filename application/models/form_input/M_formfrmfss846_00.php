<?php
class M_formfrmfss846_00 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss846hdr';
    var $tabel2 = 'tblfrmfrmfss846dtl';
    var $tabel3 = 'tblfrmfrmfss846dtlx';
    var $tabel4 = 'tblfrmfrmfss846dtl_b';
    var $tabel5 = 'tblfrmfrmfss846dtl_bx';

    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
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

    function get_jenis_mesin_by($dept, $create_date)
    {
        return $this->db1->query("select 
                                    b.detail_id,
                                    b.nama_mesin
                                from
                                    tblfrmfrmfss064hdr a
                                left join
                                    tblfrmfrmfss064dtl b
                                    on a.headerid=b.headerid
                                where
                                    a.dept = '$dept'
                                    and a.item = 'panel'
                                    -- and a.create_date in (select 
                                                           --  max(create_date) 
                                                        -- from 
                                                            -- tblfrmfrmfss064hdr 
                                                        -- where
                                                            -- dept = '$dept'
                                                            -- and create_date <='$create_date')
                                order by 
                                    b.detail_id")->result();
    }
    function get_kode_by($dept, $id_jns_mesin, $create_date)
    {
        return $this->db1->query("select 
                                    b.detail_id,
                                    b.kode_mesin
                                from
                                    tblfrmfrmfss064hdr a
                                left join
                                    tblfrmfrmfss064dtl b
                                    on a.headerid=b.headerid
                                where
                                    a.dept = '$dept'
                                    and a.item = 'panel'
                                    and b.detail_id = '$id_jns_mesin'
                                    -- and a.create_date in (select 
                                                            -- max(create_date) 
                                                        -- from 
                                                            -- tblfrmfrmfss064hdr 
                                                        -- where
                                                            -- dept = '$dept'
                                                            -- and create_date <='$create_date')
                                order by 
                                    b.detail_id")->result();
    }
    function get_lokasi_by($dept, $id_nama_panel, $create_date)
    {
        return $this->db1->query("select 
                                    a.lokasi_panel
                                from
                                    tblfrmfrmfss845hdr a
                                where
                                    a.dept = '$dept'
                                    and a.id_nama_panel = '$id_nama_panel'
                                    -- and a.create_date in (select 
                                                           --  max(create_date) 
                                                        -- from 
                                                           --  tblfrmfrmfss845hdr 
                                                        -- where
                                                            -- dept = '$dept'
                                                            -- and create_date <='$create_date')
                                order by 
                                    a.lokasi_panel")->result();
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

    function get_itemmesin($dept, $id_nama_panel, $kode_panel, $lokasi_panel)
    {
        return $this->db1->query("SELECT
                                    b.detail_id,
                                    b.nama_komponen,
                                    b.kode_komponen,
                                    b.type_komponen,
                                    b.merek,
                                    b.standard,
                                    b.arus,
                                    b.tenaga 
                                FROM
                                    tblfrmfrmfss845hdr AS A 
                                LEFT JOIN 
                                    tblfrmfrmfss845dtl AS b 
                                    ON A.headerid = b.headerid 
                                WHERE
                                    A.dept = '$dept' 
                                    AND A.id_nama_panel = '$id_nama_panel' 
                                    AND A.kode_panel = '$kode_panel' 
                                    AND A.lokasi_panel = '$lokasi_panel'
                                order by
                                    b.detail_id")->result();
    }
    function get_nama_komponen($dept, $panel)
    {
        $query = $this->db1->query("SELECT
                                        b.detail_id,
                                        b.headerid,
                                        b.nama_komponen,
                                        b.kode_komponen,
                                        b.arus
                                    FROM
                                        tblfrmfrmfss845hdr A
                                    LEFT JOIN
                                        tblfrmfrmfss845dtl b
                                        ON A.headerid = b.headerid
                                    WHERE
                                        A.dept = '$dept'
                                        AND A.id_nama_panel = '$panel'");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
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

    function check($create_date, $docno, $rev, $dept, $deptabbr, $id_gugus, $id_jns_mesin, $lokasi_panel)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('rev', $rev);
        $this->db1->where('dept', $dept);
        $this->db1->where('deptabbr', $deptabbr);
        $this->db1->where('id_kode_panel', $id_gugus);
        $this->db1->where('id_nama_panel', $id_jns_mesin);
        $this->db1->where('lokasi_panel', $lokasi_panel);

        $query = $this->db1->get();
        return $query;
    }

    function check2($create_date, $docno, $rev, $dept, $deptabbr, $id_kode_panel, $id_nama_panel, $lokasi_panel, $headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('rev', $rev);
        $this->db1->where('dept', $dept);
        $this->db1->where('deptabbr', $deptabbr);
        $this->db1->where('id_kode_panel', $id_kode_panel);
        $this->db1->where('id_nama_panel', $id_nama_panel);
        $this->db1->where('lokasi_panel', $lokasi_panel);

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
        $this->db1->where('status_detail', '1');
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

                              waktu_tanggal,
                              waktu_jam
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.waktu_tanggal,
                              b.waktu_jam
                              
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

                              nama_komponen,
                              kode_komponen,
                              ampere,
                              ket
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.nama_komponen,
                              b.kode_komponen,
                              b.ampere,
                              b.ket
                              
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

    function update_stdtlx($detail_id)
    {
        $this->db1->trans_start();
        $this->db1->query("Update tblfrmfrmfss846dtlx set stdtl='0' where detail_id ='$detail_id'");
        $this->db1->trans_complete();
    }

    function update_stdtl_bx($detail_id)
    {
        $this->db1->trans_start();
        $this->db1->query("Update tblfrmfrmfss846dtl_bx set stdtl='0' where detail_id ='$detail_id'");
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

    function delete_detail_b($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query1 = $this->db1->delete($this->tabel4);
        return $query1;
    }

    function delete_detail_bx($chk)
    {
        $this->db1->where('detail_id', $chk);
        $query2 = $this->db1->delete($this->tabel5);
        return $query2;
    }
}
