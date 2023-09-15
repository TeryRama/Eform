<?php
class M_formfrmfss847_00 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss847hdr';
    var $tabel2 = 'tblfrmfrmfss847dtl';
    var $tabel3 = 'tblfrmfrmfss847dtlx';

    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
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
                                    b.item1
                                from
                                    tblmstformitemmesin_hdr a
                                left join
                                    tblmstformitemmesin_dtl b
                                    on a.headerid=b.headerid
                                where
                                    a.departemen = '$dept'
                                    and a.parameter = 'Tipe 1'
                                    and a.form_kode = 'FRM-FSS-847'
                                    and tgl_efective in (select 
                                                      max(tgl_efective) 
                                                    from 
                                                      tblmstformitemmesin_hdr 
                                                    where
                                                      form_kode = 'FRM-FSS-847'
                                                      and parameter = 'Tipe 1'
                                                      and departemen = '$dept'
                                                      and tgl_efective <='$create_date') 
                                order by 
                                    detail_id")->result();
    }
    function get_gugus_by($dept, $id_jns_mesin, $create_date)
    {
        return $this->db1->query("select 
                                    c.detail_id,
                                    c.item2
                                from
                                    tblmstformitemmesin_hdr a
                                left join
                                    tblmstformitemmesin_dtl b
                                    on a.headerid=b.headerid
                                left join
                                    tblmstformitemmesin_dtl_b c
                                    on a.headerid=c.headerid
                                where
                                    a.departemen = '$dept'
                                    and c.detail_id_a = '$id_jns_mesin'
                                    and a.parameter = 'Tipe 1'
                                    and a.form_kode = 'FRM-FSS-847'
                                    and tgl_efective in (select 
                                                      max(tgl_efective) 
                                                    from 
                                                      tblmstformitemmesin_hdr 
                                                    where
                                                      form_kode = 'FRM-FSS-847'
                                                      and parameter = 'Tipe 1'
                                                      and departemen = '$dept'
                                                      and tgl_efective <='$create_date') 
                                GROUP BY
                                    c.detail_id,
                                    c.item2 
                                order by 
                                    c.detail_id")->result();
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

    function get_itemmesin($dept, $id_jns_mesin, $id_gugus, $create_date)
    {
        return $this->db1->query("select 
                                    a.departemen,
                                    a.form_kode,
                                    b.item1 jns_mesin,
                                    c.item2 gugus,
                                    c.part_komponen,
                                    d.part_komponen_na,
                                    e.nama_mesin,
                                    e.kode_mesin
                                from
                                    tblmstformitemmesin_hdr a
                                left join
                                    tblmstformitemmesin_dtl b
                                    on a.headerid = b.headerid
                                left join
                                    tblmstformitemmesin_dtl_b c
                                    on b.headerid = c.headerid
                                    and b.detail_id = c.detail_id_a
                                left join
                                    tblmstformitemmesin_dtl_c d
                                    on c.headerid = d.headerid
                                    and c.detail_id = d.detail_id_b
                                left join
                                    tblfrmfrmfss064dtl e
                                    on e.detail_id = d.item3::int
                                where
                                    a.departemen = '$dept'
                                    and a.parameter = 'Tipe 1'
                                    and a.form_kode = 'FRM-FSS-847'
                                    and c.detail_id_a = '$id_jns_mesin'
                                    and d.detail_id_b = '$id_gugus'
                                    and tgl_efective in (select 
                                                            max(tgl_efective) 
                                                        from 
                                                            tblmstformitemmesin_hdr 
                                                        where
                                                            form_kode = 'FRM-FSS-847'
                                                            and parameter = 'Tipe 1'
                                                            and departemen = '$dept'
                                                            and tgl_efective <='$create_date') 
                                order by 
                                    b.detail_id,
                                    c.detail_id,
                                    d.detail_id,
                                    e.detail_id")->result();
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

    function check($create_date, $docno, $rev, $dept, $deptabbr, $id_gugus, $id_jns_mesin)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('rev', $rev);
        $this->db1->where('dept', $dept);
        $this->db1->where('deptabbr', $deptabbr);
        $this->db1->where('id_gugus', $id_gugus);
        $this->db1->where('id_jns_mesin', $id_jns_mesin);

        $query = $this->db1->get();
        return $query;
    }

    function check2($create_date, $docno, $rev, $dept, $deptabbr, $id_gugus, $id_jns_mesin, $headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('rev', $rev);
        $this->db1->where('dept', $dept);
        $this->db1->where('deptabbr', $deptabbr);
        $this->db1->where('id_gugus', $id_gugus);
        $this->db1->where('id_jns_mesin', $id_jns_mesin);

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
                              komponen1,
                              komponen2,
                              komponen3,
                              komponen4,
                              komponen5,
                              komponen6,
                              komponen7,
                              komponen8,
                              komponen9,
                              komponen10,
                              komponen11,
                              komponen12,
                              komponen13,
                              komponen14,
                              ket
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.nama_mesin,
                              b.kode_mesin,
                              b.frekuensi,
                              b.komponen1,
                              b.komponen2,
                              b.komponen3,
                              b.komponen4,
                              b.komponen5,
                              b.komponen6,
                              b.komponen7,
                              b.komponen8,
                              b.komponen9,
                              b.komponen10,
                              b.komponen11,
                              b.komponen12,
                              b.komponen13,
                              b.komponen14,
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
        $this->db1->query("Update tblfrmfrmfss847dtlx set stdtl='0' where detail_id ='$detail_id'");
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
