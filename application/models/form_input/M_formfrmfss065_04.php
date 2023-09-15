<?php
class M_formfrmfss065_04 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss065hdr';
    var $tabel2 = 'tblfrmfrmfss065dtl';
    var $tabel3 = 'tblfrmfrmfss065dtlx';

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

    function get_month($tahun)
    {
        return $this->db1->query("select
                                        (n + 1) AS MONTH
                                    FROM
                                        generate_series ( 0, ( EXTRACT ( MONTH FROM date_trunc( 'MONTH', ( '$tahun' || '1201' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: INTEGER - 1 ) ) n")->result();
    }

    function get_jenis_mesin_by($dept, $create_date)
    {
        return $this->db1->query("select 
                                    b.detail_id,
                                    b.item1
                                from
                                    tblmstformitemmesin_hdr a
                                left join
                                    tblmstformitemmesin_dtl b
                                    on a.headerid=b.headerid
                                where
                                    a.departemen = '$dept'
                                    and a.parameter = 'Tipe 1'
                                    and a.form_kode = 'FRM-FSS-812'
                                    and tgl_efective in (select 
                                                      max(tgl_efective) 
                                                    from 
                                                      tblmstformitemmesin_hdr 
                                                    where
                                                      form_kode = 'FRM-FSS-812'
                                                      and parameter = 'Tipe 1'
                                                      and departemen = '$dept'
                                                      and tgl_efective <='$create_date') 
                                order by 
                                    detail_id")->result();
    }

    function get_gugus_by($deptabbr)
    {
        return $this->db1->query("select 
                                    b.detail_id,
                                    b.item2 gugus
                                from 
                                    tblmstformitemmesin_hdr a 
                                left join
                                    tblmstformitemmesin_dtl_b b 
                                    on a.headerid = b.headerid
                                where
                                    a.departemen = '$deptabbr'")->result();
    }
    function get_list_mesin_by($dept, $item, $gugus)
    {
        return $this->db1->query("SELECT
                                    d.nama_mesin,
                                    d.kode_mesin 
                                FROM
                                    tblmstformitemmesin_hdr A 
                                LEFT JOIN 
                                    tblmstformitemmesin_dtl_b b 
                                    ON A.headerid = b.headerid
                                LEFT JOIN
                                    tblmstformitemmesin_dtl_c C 
                                    ON A.headerid = C.headerid 
                                    AND b.detail_id = C.detail_id_b
                                LEFT JOIN 
                                    tblfrmfrmfss064dtl d 
                                    ON C.item3 :: INT = d.detail_id 
                                RIGHT JOIN 
                                    tblfrmfrmfss064hdr e 
                                    ON d.headerid = e.headerid
                                WHERE
                                    A.departemen = '$dept' 
                                    AND e.item  ='$item'
                                    and b.detail_id = '$gugus'
                                ORDER BY
                                    d.detail_id")->result();
    }
    function get_mesin_frmfss064($dept)
    {
        return $this->db1->query("select 
                                    b.nama_mesin 
                                from 
                                    tblfrmfrmfss064hdr a 
                                join 
                                    tblfrmfrmfss064dtl b 
                                    on a.headerid=b.headerid 
                                where 
                                    a.dept = '$dept'
                                group by 
                                    b.nama_mesin,
                                    b.detail_id
                                order by 
                                    b.detail_id asc")->result();
    }
    function get_kode_frmfss064($dept, $nama_mesin)
    {
        return $this->db1->query("select 
                                    b.kode_mesin 
                                from 
                                    tblfrmfrmfss064hdr a 
                                join 
                                    tblfrmfrmfss064dtl b 
                                    on a.headerid=b.headerid 
                                where 
                                    a.dept = '$dept' 
                                    and b.nama_mesin='$nama_mesin' 
                                group by 
                                    b.kode_mesin,
                                    b.detail_id 
                                order by 
                                    b.detail_id asc")->result();
    }
    function get_frmfss060($create_date, $dept, $nama_mesin)
    {
        return $this->db1->query("select 
                                    b.*
                                from 
                                    tblfrmfrmfss060hdr a 
                                join 
                                    tblfrmfrmfss060dtl b 
                                    on a.headerid=b.headerid 
                                where 
                                    a.dept = '$dept' 
                                    and DATE_PART('YEAR', a.create_date) = '$create_date'
                                    and b.nama_mesin = '$nama_mesin' 
                                group by 
                                    b.nama_mesin,
                                    b.detail_id
                                order by 
                                    b.detail_id asc")->result();
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

    function check($create_date, $docno, $dept, $gugus, $nama_mesin, $deptabbr, $tahun, $item, $id_jns_mesin, $id_gugus)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('dept', $dept);
        $this->db1->where('deptabbr', $deptabbr);
        $this->db1->where('gugus', $gugus);
        $this->db1->where('nama_mesin', $nama_mesin);
        $this->db1->where('tahun', $tahun);
        $this->db1->where('item', $item);
        $this->db1->where('id_jns_mesin', $id_jns_mesin);
        $this->db1->where('id_gugus', $id_gugus);

        $query = $this->db1->get();
        return $query;
    }

    function check2($create_date, $docno, $dept, $deptabbr, $gugus, $nama_mesin, $tahun, $item, $id_jns_mesin, $id_gugus, $headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('dept', $dept);
        $this->db1->where('deptabbr', $deptabbr);
        $this->db1->where('gugus', $gugus);
        $this->db1->where('nama_mesin', $nama_mesin);
        $this->db1->where('tahun', $tahun);
        $this->db1->where('item', $item);
        $this->db1->where('id_jns_mesin', $id_jns_mesin);
        $this->db1->where('id_gugus', $id_gugus);

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

                              detail_id_060,
                              headerid_060,
                              tanggal,
                              tindakan,
                              waktu,
                              planned
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.detail_id_060,
                              b.headerid_060,
                              b.tanggal,
                              b.tindakan,
                              b.waktu,
                              b.planned
                              
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
    function update_stdtlx($detail_id)
    {
        $this->db1->trans_start();
        $this->db1->query("Update tblfrmfrmfss065dtlx set stdtl='0' where detail_id ='$detail_id'");
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

    function fn_update_frmfss065_060($update_tahun, $update_dept, $update_nama_mesin){
        $this->db1->trans_begin();
        $query = $this->db1->query("SELECT * FROM fn_update_frmutl065 ( '$update_tahun', '$update_dept', '$update_nama_mesin' )");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }
}
