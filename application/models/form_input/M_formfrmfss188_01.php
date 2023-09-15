<?php
class M_formfrmfss188_01 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss188hdr';
    var $tabel2 = 'tblfrmfrmfss188dtl';
    var $tabel3 = 'tblfrmfrmfss188dtlx';


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
    function get_list_item($tipe, $create_date, $dept)
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
                                    and form_kode = 'FRM-FSS-188'
                                    and parameter = '$tipe'
                                    and departemen = '$dept'
                                    and tgl_efective in (select 
                                                      max(tgl_efective) 
                                                    from 
                                                      tblmst_formitem_hdr 
                                                    where
                                                      inactive='0'
                                                      and form_kode = 'FRM-FSS-188'
                                                      and parameter = '$tipe'
                                                      and departemen = '$dept'
                                                      and tgl_efective <='$create_date') 
                                                      ORDER BY detail_id")->result();

        return $q;
    }
    function get_item_by($detail_id){
        $q = $this->db1->query("select 
                                    *
                                from 
                                    tblmst_formitem_dtl
                                where 
                                    detail_id='$detail_id'
                                ORDER BY 1")->row();
        return $q;

    }
    function get_item2_by($detail_id_b){
        $q = $this->db1->query("select 
                                    *
                                from 
                                    tblmst_formitem_dtl_b
                                where 
                                    detail_id_b='$detail_id_b'
                                ORDER BY 1")->row();
        return $q;

    }
    function get_list_item2($detail_id)
    {
        
        $q2 = $this->db1->query("select 
                                    *,
                                    'item2' dtl_level
                                from 
                                    tblmst_formitem_dtl_b
                                where 
                                    detail_id_a='$detail_id'
                                order by
                                    detail_id_b")->result();
        return $q2;
    }

    /// get data group
    function get_list_pj($create_date)
    {
        return $this->db1->query("select 
                                    * 
                                  from 
                                    tblmst_penanggung_jawab a
                                  join
                                    tblmst_penanggung_jawab_dtl b
                                    on a.headerid=b.headerid
                                  where 
                                    a.inactive='0' 
                                    and b.inactive='0' 
                                    and form_kode='FRM-FSS-188' 
                                    and tgl_efektif in (select 
                                                      max(tgl_efektif) 
                                                    from 
                                                      tblmst_penanggung_jawab 
                                                    where 
                                                      inactive='0' 
                                                      and form_kode='FRM-FSS-188'
                                                      and tgl_efektif <='$create_date') 
                                  order by 
                                    nama")->result();
    }

    function get_pj_by($detail_id)
    {
        return $this->db1->query("select 
                                    * 
                                  from 
                                    tblmst_penanggung_jawab a
                                  join
                                    tblmst_penanggung_jawab_dtl b
                                    on a.headerid=b.headerid
                                  where 
                                    b.detail_id='$detail_id'")->row();
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

    function check($create_date, $docno)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);

        $query = $this->db1->get();
        return $query;
    }

    function check2($create_date, $docno, $headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);

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

                              point,
                              kode,
                              area,
                              temuan,
                              tindakan_koreksi,
                              pj_id_dilakukan,
                              pj_personalstatus_dilakukan,
                              pj_personalid_dilakukan,
                              pj_nik_dilakukan,
                              pj_nama_dilakukan,
                              pj_id_dicek,
                              pj_personalstatus_dicek,
                              pj_personalid_dicek,
                              pj_nik_dicek,
                              pj_nama_dicek,
                              pj_id_verfikasi,
                              pj_personalstatus_verfikasi,
                              pj_personalid_verfikasi,
                              pj_nik_verfikasi,
                              pj_nama_verfikasi,
                              gagal_lulus
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.point,
                              b.kode,
                              b.area,
                              b.temuan,
                              b.tindakan_koreksi,
                              b.pj_id_dilakukan,
                              b.pj_personalstatus_dilakukan,
                              b.pj_personalid_dilakukan,
                              b.pj_nik_dilakukan,
                              b.pj_nama_dilakukan,
                              b.pj_id_dicek,
                              b.pj_personalstatus_dicek,
                              b.pj_personalid_dicek,
                              b.pj_nik_dicek,
                              b.pj_nama_dicek,
                              b.pj_id_verfikasi,
                              b.pj_personalstatus_verfikasi,
                              b.pj_personalid_verfikasi,
                              b.pj_nik_verfikasi,
                              b.pj_nama_verfikasi,
                              b.gagal_lulus
                              
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
        $this->db1->query("Update tblfrmfrmfss188dtlx set stdtl='0' where detail_id ='$detail_id'");
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
