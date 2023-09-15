<?php
class M_formfrmfss845_00 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss845hdr';
    var $tabel2 = 'tblfrmfrmfss845dtl';
    var $tabel3 = 'tblfrmfrmfss845dtlx';


    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }
    function get_nampanel($dept)
    {
        return $this->db1->query("SELECT
                                        b.detail_id id_nama_panel,
                                        b.nama_mesin nama_panel
                                    FROM
                                        tblfrmfrmfss064hdr AS A 
                                    LEFT JOIN
                                        tblfrmfrmfss064dtl AS b
                                        ON A.headerid = b.headerid
                                    WHERE
                                        a.dept = '$dept'
                                        AND a.item = 'panel'
                                    GROUP BY
                                        b.detail_id,
                                        b.nama_mesin
                                    ORDER BY
                                        b.detail_id")->result();
    }
    function get_nampanel2($dept)
    {
        return $this->db1->query("SELECT
                                        id_nama_panel,
                                        nama_panel
                                    FROM
                                    $this->tabel1 
                                    WHERE
                                        dept = '$dept'")->result();
    }
    function get_kodepanel($dept, $nama_panel)
    {
        return $this->db1->query("SELECT
                                        b.detail_id id_kode_panel,
                                        b.kode_mesin kode_panel
                                    FROM
                                        tblfrmfrmfss064hdr AS A 
                                    LEFT JOIN
                                        tblfrmfrmfss064dtl AS b
                                        ON A.headerid = b.headerid
                                    WHERE
                                        a.dept = '$dept'
                                        AND a.item = 'panel'
                                        AND b.detail_id = '$nama_panel'
                                    GROUP BY
                                        b.detail_id,
                                        b.kode_mesin
                                    ORDER BY
                                        b.detail_id")->result();
    }
    function get_kodepanel2($dept, $nama_panel)
    {
        return $this->db1->query("SELECT
                                        id_kode_panel,
                                        kode_panel
                                    FROM
                                        $this->tabel1 
                                    WHERE
                                        dept = '$dept'")->result();
    }
    function get_records_payroll($deptabbr)
    {

        $arr_deptabbr = (explode(',', $deptabbr));
        $str_deptabbr = "'" . implode("','", $arr_deptabbr) . "'";
        return json_decode($this->curl->simple_get(setAPI() . "p1_get_all_departemen_byakses2/" . $str_deptabbr));
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

        return $this->db1->query("")->result();
    }

    function get_detail_lap_byidx($id)
    {
        return $this->get_detail_lap_byid($id, $this->tabel3);
    }

    function check($create_date, $docno, $rev, $dept, $deptabbr, $nama_panel, $kode_panel, $lokasi_panel)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('rev', $rev);
        $this->db1->where('dept', $dept);
        $this->db1->where('deptabbr', $deptabbr);
        $this->db1->where('nama_panel', $nama_panel);
        $this->db1->where('kode_panel', $kode_panel);

        $query = $this->db1->get();
        return $query;
    }

    function check2($create_date, $docno, $rev, $dept, $deptabbr, $headerid, $nama_panel, $kode_panel, $lokasi_panel)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('rev', $rev);
        $this->db1->where('dept', $dept);
        $this->db1->where('deptabbr', $deptabbr);
        $this->db1->where('nama_panel', $nama_panel);
        $this->db1->where('kode_panel', $kode_panel);
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

                              nama_komponen,
                              kode_komponen,
                              type_komponen,
                              merek,
                              standard,
                              arus,
                              tenaga,
                              keterangan
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.nama_komponen,
                              b.kode_komponen,
                              b.type_komponen,
                              b.merek,
                              b.standard,
                              b.arus,
                              b.tenaga,
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
        $this->db1->query("Update tblfrmfrmfss064dtlx set stdtl='0' where detail_id ='$detail_id'");
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
