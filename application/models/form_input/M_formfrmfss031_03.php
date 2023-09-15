<?php
class M_formfrmfss031_03 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss031hdr';
    var $tabel2 = 'tblfrmfrmfss031dtl';
    var $tabel3 = 'tblfrmfrmfss031dtlx';

    var $tabel4 = 'tblfrmfrmfss064dtl';
    var $tabel5 = 'tblfrmfrmfss064hdr';

    var $tabel6 = 'tblfrmfrmfss845hdr';
    var $tabel7 = 'tblfrmfrmfss845dtl';


    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

    function get_records_payroll($deptabbr)
    {

        $arr_deptabbr = (explode(',', $deptabbr));
        $str_deptabbr = "'" . implode("','", $arr_deptabbr) . "'";
        return json_decode($this->curl->simple_get(setAPI() . "p1_get_all_departemen_byakses2/" . $str_deptabbr));
    }

    function get_nama_mesin($dept, $item)
    {
        return $this->db1->query("select a.nama_mesin from $this->tabel4 a join $this->tabel5 b on a.headerid = b.headerid where b.dept = '$dept' and b.item = '$item' order by a.nama_mesin asc")->result();
        // return $this->db1->query("select a.nama_mesin from $this->tabel4 a join $this->tabel5 b on a.headerid = b.headerid where b.item = '$item' order by a.nama_mesin asc")->result();
    }

    function get_nama_panel($dept)
    {
        return $this->db1->query("select nama_panel from $this->tabel6 where dept = '$dept' order by nama_panel asc")->result();
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

    function get_kode_mesin($nama_mesin)
    {
        return $this->db1->query("select 
                                    b.kode_mesin 
                                from 
                                    tblfrmfrmfss064dtl b 
                                where 
                                    b.nama_mesin='$nama_mesin' 
                                group by 
                                    b.kode_mesin,
                                    b.detail_id 
                                order by 
                                    b.detail_id asc")->result();
    }

    function get_kode_panel($nama_panel)
    {
        return $this->db1->query("select 
                                    kode_panel 
                                from 
                                    $this->tabel6
                                where 
                                    nama_panel like'%$nama_panel%'")->result();
    }

    function get_partkomponen($deptabbr)
    {
        $this->db1->from('tblmstkomponenmesin');
        // $this->db1->where('deptabbr', $deptabbr);
        $this->db1->order_by('komponen_id', 'asc');
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_partkomponen_panel($kode_panel)
    {
        return $this->db1->query("SELECT
                                        A.nama_komponen 
                                    FROM
                                        $this->tabel7 A 
                                    LEFT JOIN $this->tabel6 b 
                                    ON A.headerid = b.headerid 
                                    WHERE
                                        b.kode_panel = '$kode_panel'")->result();
    }

    function getdata_detail_e_view($nama_mesin, $kode_mesin)
    {
        $query = $this->db1->query("SELECT
                                        tblmstformitemmesin_dtl.headerid,
                                        tblmstformitemmesin_dtl.detail_id,
                                        tblmstformitemmesin_dtl.item1 AS item1_dtl,
                                        tblmstformitemmesin_dtl_b.detail_id as detail_id_b,
                                        tblmstformitemmesin_dtl_b.item2 AS item2_dtl_b,
                                        tblmstformitemmesin_dtl_b.part_komponen,
                                        tblmstformitemmesin_dtl_c.detail_id as detail_id_c,
                                        tblmstformitemmesin_dtl_c.item3 AS item3_dtl_c,
                                        tblmstformitemmesin_dtl_c.part_komponen_na,
                                        tblfrmfrmfss064dtl.nama_mesin,
                                        tblfrmfrmfss064dtl.kode_mesin
                                    FROM
                                        tblmstformitemmesin_dtl
                                        FULL JOIN tblmstformitemmesin_dtl_b ON tblmstformitemmesin_dtl.detail_id = tblmstformitemmesin_dtl_b.detail_id_a
                                        FULL JOIN tblmstformitemmesin_dtl_c ON tblmstformitemmesin_dtl_b.detail_id = tblmstformitemmesin_dtl_c.detail_id_b
                                        LEFT JOIN tblfrmfrmfss064dtl ON tblmstformitemmesin_dtl_c.item3 = tblfrmfrmfss064dtl.detail_id::VARCHAR
                                    where
                                        tblfrmfrmfss064dtl.nama_mesin = '$nama_mesin'
                                        and tblfrmfrmfss064dtl.kode_mesin = '$kode_mesin'
                                    ORDER BY
                                        tblmstformitemmesin_dtl.detail_id ASC,
                                        tblmstformitemmesin_dtl_b.detail_id ASC,
                                        tblmstformitemmesin_dtl_c.detail_id ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
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

    function get_detail_lap_byid($id, $tbl = null)
    {
        $tbl = $tbl ?? $this->tabel2;

        return $this->db1->query("select
                                        row_number () over (partition by b.nama_jenis_air order by detail_id) no_urut,
                                        row_number() over (partition by b.nama_jenis_air order by detail_id desc) no_urut_desc,
                                        *
                                    from
                                        $this->tabel1 a
                                    join 
                                        $tbl b
                                            on a.headerid=b.headerid
                                    where 
                                        a.headerid=$id
                                    order by 
                                        detail_id")->result();
    }

    function get_detail_lap_byidx($id)
    {
        return $this->get_detail_lap_byid($id, $this->tabel3);
    }

    function check($create_date, $docno, $dept, $nama_mesin, $kode_mesin, $jam, $total_operasi)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('dept', $dept);
        $this->db1->where('nama_mesin', $nama_mesin);
        $this->db1->where('kode_mesin', $kode_mesin);
        $this->db1->where('jam', $jam);
        $this->db1->where('total_operasi', $total_operasi);

        $query = $this->db1->get();
        return $query;
    }

    function check2($create_date, $docno, $dept, $nama_mesin, $kode_mesin, $jam, $total_operasi, $headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('dept', $dept);
        $this->db1->where('nama_mesin', $nama_mesin);
        $this->db1->where('kode_mesin', $kode_mesin);
        $this->db1->where('jam', $jam);
        $this->db1->where('total_operasi', $total_operasi);

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

                              bagian_mesin,
                              kondisi_masalah,
                              tindakan,
                              suku_cadang_jenis,
                              suku_cadang_jumlah,
                              keterangan
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.bagian_mesin,
                              b.kondisi_masalah,
                              b.tindakan,
                              b.suku_cadang_jenis,
                              b.suku_cadang_jumlah,
                              b.keterangan
                              
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
        $this->db1->query("Update tblfrmfrmfss031dtlx set stdtl='0' where detail_id ='$detail_id'");
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
}
