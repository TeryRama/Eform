<?php
class M_formfrmfss054_03 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss054hdr';
    var $tabel2 = 'tblfrmfrmfss054dtl';
    var $tabel3 = 'tblfrmfrmfss054dtlx';

    var $tabel_trn_dtl = 'tbltrn_schedule_dtl';


    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

    function get_records_payroll($deptabbr){
        
        $arr_deptabbr = (explode(',',$deptabbr));
        $str_deptabbr = "'".implode("','",$arr_deptabbr)."'";
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_departemen_byakses2/".$str_deptabbr));
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
    function get_list_mesin_by($deptabbr)
    {
        return $this->db1->query("select 
                                    b.item2 gugus,
                                    d.detail_id,
                                    d.nama_mesin,
                                    d.kode_mesin
                                from 
                                    tblmstformitemmesin_hdr a 
                                left join
                                    tblmstformitemmesin_dtl_b b 
                                    on a.headerid = b.headerid
                                left join
                                    tblmstformitemmesin_dtl_c c 
                                    on a.headerid = c.headerid
                                    and b.detail_id = c.detail_id_b
                                left join
                                    tblfrmfrmfss064dtl d
                                    on c.item3::int = d.detail_id
                                where
                                    a.departemen = 'WTD'
                                order by
                                    d.detail_id")->result();
    }
    function get_trans_by($nama_mesin, $kode_mesin, $frekuensi, $kode_form, $headerid)
    {
        return $this->db1->query("select 
                                    * 
                                from
                                    $this->tabel_trn_dtl
                                where
                                    nama = '$nama_mesin'
                                    and kode = '$kode_mesin'
                                    and frequency = '$frekuensi'
                                    and kode_form = '$kode_form'
                                    and headerid_form = '$headerid'")->result();
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

        $final = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $query2 = $this->db1->query("select 
                                                *
                                            from
                                                $this->tabel_trn_dtl
                                            where
                                                nama = '$row->nama_mesin'
                                                and kode = '$row->kode_mesin'
                                                and frequency = '$row->frekuensi'
                                                and kode_form = 'frmfss054'
                                                and headerid_form = '$row->headerid'");
                // if ($query2->num_rows() > 0) {
                    $row->children = $query2->result();
                // }
                array_push($final, $row);
            }
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

    function check($create_date, $docno, $rev, $dept, $gugus, $tahun, $deptabbr)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('rev', $rev);
        $this->db1->where('dept', $dept);
        $this->db1->where('deptabbr', $deptabbr);
        $this->db1->where('gugus', $gugus);
        $this->db1->where('tahun', $tahun);

        $query = $this->db1->get();
        return $query;
    }

    function check2($create_date, $docno, $rev, $dept, $deptabbr, $gugus, $tahun, $headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('rev', $rev);
        $this->db1->where('dept', $dept);
        $this->db1->where('deptabbr', $deptabbr);
        $this->db1->where('gugus', $gugus);
        $this->db1->where('tahun', $tahun);

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

                              nama_mesin,
                              kode_mesin,
                              frekuensi,
                              gugus,
                              month1,
                              month2,
                              month3,
                              month4,
                              month5,
                              month6,
                              month7,
                              month8,
                              month9,
                              month10,
                              month11,
                              month12,
                              ket
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.nama_mesin,
                              b.kode_mesin,
                              b.frekuensi,
                              b.gugus,
                              b.month1,
                              b.month2,
                              b.month3,
                              b.month4,
                              b.month5,
                              b.month6,
                              b.month7,
                              b.month8,
                              b.month9,
                              b.month10,
                              b.month11,
                              b.month12,
                              b.ket 
                              
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
        $this->db1->query("Update tblfrmfrmfss054dtlx set stdtl='0' where detail_id ='$detail_id'");
        $this->db1->trans_complete();
    }
    function delete_trans($chk,$id,$frmkd)
    {
        $this->db1->where('detail_id_form', $chk);
        $this->db1->where('headerid_form', $id);
        $this->db1->where('kode_form', $frmkd);
        $query1 = $this->db1->delete($this->tabel_trn_dtl);
        return $query1;
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
