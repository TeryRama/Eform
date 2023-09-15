<?php
class M_formfrmfss060_04 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss060hdr';
    var $tabel2 = 'tblfrmfrmfss060dtl';
    var $tabel3 = 'tblfrmfrmfss060dtlx';


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
    function get_frmfss812($bulan, $tahun, $dept)
    {
        $query = "select
                        a.create_date,
                        a.deptabbr,
                        a.jns_mesin,
                        a.gugus,
                        b.*
                    from
                        tblfrmfrmfss812hdr a
                    join
                        tblfrmfrmfss812dtl b
                        on a.headerid = b.headerid
                    WHERE
                        extract(month from create_date) = '$bulan'
                        and extract(year from create_date) = '$tahun'
                        and a.dept = '$dept'
                        and (";
        // looping total komponen all
        for ($i_komponen = 1; $i_komponen <= 14; $i_komponen++) {
            if ($i_komponen == 14) {
                $query .= " (komponen" . $i_komponen . "='1' or komponen" . $i_komponen . "='2') ";
            } else {
                $query .= " (komponen" . $i_komponen . "='1' or komponen" . $i_komponen . "='2') or";
            }
        }
        $query .= ') order by a.create_date,nama_mesin';

        return $this->db1->query($query)->result();
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

    function check($create_date, $docno, $periode, $dept, $deptabbr, $kategori)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('periode', $periode);
        $this->db1->where('dept', $dept);
        $this->db1->where('deptabbr', $deptabbr);
        $this->db1->where('kategori', $kategori);

        $query = $this->db1->get();
        return $query;
    }

    function check2($create_date, $docno, $periode, $dept, $deptabbr, $kategori, $headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('periode', $periode);
        $this->db1->where('dept', $dept);
        $this->db1->where('deptabbr', $deptabbr);
        $this->db1->where('kategori', $kategori);

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
                              detail_id_812,
                              headerid_812,
                              stdtl,

                              nama_mesin,
                              kode_mesin,
                              tgl_start,
                              waktu_start,
                              tgl_stop,
                              waktu_stop,
                              durasi,
                              status_perbaikan,
                              kategori,
                              planned,
                              perbaikan,
                              analisa,
                              tindakan,
                              keterangan
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              b.detail_id_812,
                              b.headerid_812,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.nama_mesin,
                              b.kode_mesin,
                              b.tgl_start,
                              b.waktu_start,
                              b.tgl_stop,
                              b.waktu_stop,
                              b.durasi,
                              b.status_perbaikan,
                              b.kategori,
                              b.planned,
                              b.perbaikan,
                              b.analisa,
                              b.tindakan,
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

    function fn_update_frmutl060($update_bulan, $update_tahun, $update_dept)
    {
        $this->db1->trans_begin();
        $query = $this->db1->query("SELECT * FROM fn_update_frmutl060('$update_bulan','$update_tahun','$update_dept')");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }
    function update_stdtlx($detail_id)
    {
        $this->db1->trans_start();
        $this->db1->query("Update tblfrmfrmfss060dtlx set stdtl='0' where detail_id ='$detail_id'");
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
