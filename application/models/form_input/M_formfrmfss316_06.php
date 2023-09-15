<?php
class M_formfrmfss316_06 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss316hdr';
    var $tabel2 = 'tblfrmfrmfss316dtl';
    var $tabel3 = 'tblfrmfrmfss316dtlx';


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

    function get_list_dept_pemakaian_air($create_date, $tgl_kemarin)
    {
        // cek data all data, jika pertama kali buat form ini maka list master tetap muncul
        $q = $this->db1->query("select
                                    count(headerid) jml_data
                                from
                                    tblfrmfrmfss316hdr")->row();

        // cek data kemarin
        $q2 = $this->db1->query("select
                                    count(headerid) jml_data
                                from
                                    tblfrmfrmfss316hdr
                                where
                                    create_date='$tgl_kemarin'
                                    and status_detail='1'")->row();
        // cek data tanggal input laporan terakhir
        $q4 = $this->db1->query("select
                                    max(create_date) last_create_date
                                from
                                    tblfrmfrmfss316hdr
                                where
                                    status_detail='1'")->row();

        // get data mst list FM + data FM kemarin
        $q3 = $this->db1->query("with 
                                    tbl_mst as (
                                        select 
                                            *
                                        from 
                                            tblmst_supplier a
                                        join 
                                            tblmst_supplierdtl b
                                                on a.headerid=b.headerid
                                        join 
                                            tblmst_flowmeter c
                                                on c.headerid=b.id_flow_meter
                                        join 
                                            tblmst_air d
                                                on d.headerid=c.id_jenis_air
                                        where 
                                            a.inactive='0'
                                            and b.inactive='0'
                                            and a.tgl_efektif in 
                                                (select 
                                                    max ( tgl_efektif ) 
                                                from 
                                                    tblmst_supplier 
                                                where 
                                                    inactive = '0' 
                                                    and tgl_efektif <= '$create_date')),

                                    tbl_frmfss316 as (
                                        select
                                            a.headerid headerid_frmfss316, 
                                            id_flow_meter id_flow_meter_frmfss316, 
                                            fm_akhir
                                        from
                                            tblfrmfrmfss316hdr a 
                                        join tblfrmfrmfss316dtl b
                                            on a.headerid=b.headerid
                                            and a.create_date='$tgl_kemarin'
                                            and a.status_detail='1'
                                    )
                                    
                                    select 
                                        *,
                                        -- jika list flow baru/ belum pernah ada data fm akhir nya, maka set 0
                                        case 
                                        when fm_akhir is null then '0'
                                        else fm_akhir end
                                    from 
                                        tbl_mst a
                                    left join 
                                        tbl_frmfss316 b 
                                            on a.id_flow_meter=b.id_flow_meter_frmfss316
                                    order by
                                        urutan,detail_id ")->result();
        return [
            'cek_data_semua'   => $q,
            'cek_data_kemarin' => $q2,
            'cek_create_date'  => $q4,
            'list_data'        => $q3,
        ];
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

                              id_flow_meter,
                              nama_jenis_air,
                              nama_departemen,
                              nama_flow,
                              fm_awal,
                              fm_akhir,
                              total,
                              ket
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.id_flow_meter,
                              b.nama_jenis_air,
                              b.nama_departemen,
                              b.nama_flow,
                              b.fm_awal,
                              b.fm_akhir,
                              b.total,
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
        $this->db1->query("Update tblfrmfrmfss316dtlx set stdtl='0' where detail_id ='$detail_id'");
        $this->db1->trans_complete();
    }
}
