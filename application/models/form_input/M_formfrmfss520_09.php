<?php

class M_formfrmfss520_09 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss520hdr';
    var $tabel2 = 'tblfrmfrmfss520dtl';
    var $tabel3 = 'tblfrmfrmfss520dtlx';
    var $tabel4 = 'tblfrmfrmfss520dtl_b';
    var $tabel5 = 'tblfrmfrmfss520dtl_bx';
    var $tabel6 = 'tblfrmfrmfss520dtl_c';
    var $tabel7 = 'tblfrmfrmfss520dtl_cx';
    var $tabel8 = 'tblfrmfrmfss520dtl_d';
    var $tabel9 = 'tblfrmfrmfss520dtl_dx';

    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
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
                                    and form_kode='FRM-FSS-520' 
                                    and tgl_efektif in (select 
                                                      max(tgl_efektif) 
                                                    from 
                                                      tblmst_penanggung_jawab 
                                                    where 
                                                      inactive='0' 
                                                      and form_kode='FRM-FSS-520'
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

    function get_list_item($tipe, $create_date)
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
                                    and form_kode = 'FRM-FSS-520'
                                    and parameter = '$tipe'
                                    and departemen = 'WTD'
                                    and tgl_efective in (select 
                                                      max(tgl_efective) 
                                                    from 
                                                      tblmst_formitem_hdr 
                                                    where
                                                      inactive='0'
                                                      and form_kode = 'FRM-FSS-520'
                                                      and parameter = '$tipe'
                                                      and departemen = 'WTD'
                                                      and tgl_efective <='$create_date') 
                                                      ORDER BY detail_id")->result();

        $final = array();
        if (count($q) > 0) {
            foreach ($q as $row) {
                $q2 = $this->db1->query("select 
                                          *,
                                          'item2' dtl_level
                                        from 
                                          tblmst_formitem_dtl_b
                                        where 
                                          headerid=$row->headerid
                                          and detail_id_a=$row->detail_id
                                          ORDER BY 1")->result();
                if (count($q2) > 0) {
                    foreach ($q2 as $row2) {
                        $q3 = $this->db1->query("select 
                                                  *,
                                                  'item3' dtl_level
                                                from 
                                                  tblmst_formitem_dtl_c
                                                where 
                                                  headerid=$row->headerid
                                                  and detail_id_b=$row2->detail_id_b")->result();
                        if (count($q3) > 0) {
                            foreach ($q3 as $row3) {
                                $q4 = $this->db1->query("select 
                                                          *,
                                                          'item4' dtl_level
                                                        from 
                                                          tblmst_formitem_dtl_d
                                                        where 
                                                          headerid=$row->headerid
                                                          and detail_id_c=$row3->detail_id_c")->result();
                                if (count($q4) > 0) {
                                    $row3->children3 = $q4;
                                }
                            }
                            $row2->children2 = $q3;
                        }
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

    function get_detail_byid_lap($id)
    {
        $this->db1->from($this->tabel2);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_lapx($id)
    {
        $this->db1->from($this->tabel3);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_lapb($id)
    {
        $result = [];
        for ($i = 1; $i <= 3; $i++) {
            $this->db1->from($this->tabel4);
            $this->db1->where('headerid', $id);
            $this->db1->where('shift', 'shift_' . $i);
            $this->db1->order_by("detail_id", "asc");
            $result['shift_' . $i] = $this->db1->get()->result();
        }

        return $result;
    }

    function get_detail_byid_lapbx($id)
    {
        $result = [];
        for ($i = 1; $i <= 3; $i++) {
            $this->db1->from($this->tabel5);
            $this->db1->where('headerid', $id);
            $this->db1->where('shift', 'shift_' . $i);
            $this->db1->order_by("detail_id", "asc");
            $result['shift_' . $i] = $this->db1->get()->result();
        }

        return $result;
    }
    function get_detail_byid_lapc($id)
    {
        $result = [];
        for ($i = 1; $i <= 3; $i++) {
            $this->db1->from($this->tabel6);
            $this->db1->where('headerid', $id);
            $this->db1->where('shift', 'shift_' . $i);
            $this->db1->order_by("detail_id", "asc");
            $result['shift_' . $i] = $this->db1->get()->result();
        }

        return $result;
    }

    function get_detail_byid_lapcx($id)
    {
        $result = [];
        for ($i = 1; $i <= 3; $i++) {
            $this->db1->from($this->tabel7);
            $this->db1->where('headerid', $id);
            $this->db1->where('shift', 'shift_' . $i);
            $this->db1->order_by("detail_id", "asc");
            $result['shift_' . $i] = $this->db1->get()->result();
        }

        return $result;
    }
    function get_detail_byid_lapd($id)
    {
        $this->db1->from($this->tabel8);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_lapdx($id)
    {
        $this->db1->from($this->tabel9);
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

    function get_detail_byid_c($id)
    {
        $this->db1->from($this->tabel6);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_cx($id)
    {
        $this->db1->from($this->tabel7);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_d($id)
    {
        $this->db1->from($this->tabel8);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_dx($id)
    {
        $this->db1->from($this->tabel9);
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
                                        row_number () over (partition by b.nama_mesin,b.shift order by detail_id) no_urut,
                                        row_number() over (partition by b.nama_mesin,b.shift order by detail_id desc) no_urut_desc,
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

    /// check group
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
        $this->db1->where('status_detail_sf1', '1');
        $this->db1->where('status_detail_sf2', '1');
        $this->db1->where('status_detail_sf3', '1');
        $query = $this->db1->get();
        return $query;
    }

    function cek_stdetailx($headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('headerid', $headerid);
        $this->db1->where('status_detailx_sf1', '1');
        $this->db1->where('status_detailx_sf2', '1');
        $this->db1->where('status_detailx_sf3', '1');
        $query = $this->db1->get();
        return $query;
    }

    // function cek_stdetail_b($headerid) {
    //     $this->db1->from($this->tabel1);
    //     $this->db1->where('headerid', $headerid);
    //     $this->db1->where('status_detail', '1');
    //     $query = $this->db1->get();
    //     return $query;
    // }

    // function cek_stdetail_bx($headerid) {
    //     $this->db1->from($this->tabel1);
    //     $this->db1->where('headerid', $headerid);
    //     $this->db1->where('status_detailx', '1');
    //     $query = $this->db1->get();
    //     return $query;
    // }

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

                              shift,
                              nama_mesin,
                              kode,
                              parameter,
                              jml_per_mesin,
                              cek_shift_jam1,
                              cek_shift_jam2,
                              cek_shift_jam3,
                              cek_shift_jam4,
                              cek_shift_jam5,
                              cek_shift_jam6,
                              cek_shift_jam7,
                              cek_shift_jam8
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.shift,
                              b.nama_mesin,
                              b.kode,
                              b.parameter,
                              b.jml_per_mesin,
                              b.cek_shift_jam1,
                              b.cek_shift_jam2,
                              b.cek_shift_jam3,
                              b.cek_shift_jam4,
                              b.cek_shift_jam5,
                              b.cek_shift_jam6,
                              b.cek_shift_jam7,
                              b.cek_shift_jam8
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

    function insert_detail_b($data6b)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel4, $data6b);
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

                              time_check,
                              ph_air,
                              ph_caustic,
                              temp_caustic,
                              ph_acid,
                              temp_acid,
                              shift
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.time_check,
                              b.ph_air,
                              b.ph_caustic,
                              b.temp_caustic,
                              b.ph_acid,
                              b.temp_acid,
                              b.shift
                             
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

    function insert_detail_c($data6c)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel6, $data6c);
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

    function insert_detail_cx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel7 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              time_check,
                              ph,
                              residu_caustic,
                              residu_acid,
                              shift
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.time_check,
                              b.ph,
                              b.residu_caustic,
                              b.residu_acid,
                              b.shift
                            from 
                              $this->tabel6 as b 
                            left join 
                              $this->tabel7 as bx 
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


    function insert_detail_d($data6d)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel8, $data6d);
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

    function insert_detail_dx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel9 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              shift,
                              jam,
                              uraian,
                              tindakan,
                              keterangan,
                              pj_id,
                              pj_personalstatus,
                              pj_personalid,
                              pj_nik,
                              pj_nama
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.shift,
                              b.jam,
                              b.uraian,
                              b.tindakan,
                              b.keterangan,
                              b.pj_id,
                              b.pj_personalstatus,
                              b.pj_personalid,
                              b.pj_nik,
                              b.pj_nama
                            from 
                              $this->tabel8 as b 
                            left join 
                              $this->tabel9 as bx 
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

    function update_dtl_b($detail_id, $data6b)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6b);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel4, $data6b);
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

    function update_dtl_bx($detail_id, $data6b)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6b);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel5, $data6b);
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

    function update_dtlc($detail_id, $data6c)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6c);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel6, $data6c);
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

    function update_dtlcx($detail_id, $data6c)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6c);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel7, $data6c);
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


    function update_dtld($detail_id, $data6d)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6d);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel8, $data6d);
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

    function update_dtldx($detail_id, $data6d)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6d);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel9, $data6d);
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



    function delete_detail_b($detail_id)
    {
        $this->db1->where('detail_id', $detail_id);
        $query1 = $this->db1->delete($this->tabel4);
        return $query1;
    }

    function delete_detail_bx($detail_id)
    {
        $this->db1->where('detail_id', $detail_id);
        $query2 = $this->db1->delete($this->tabel5);
        return $query2;
    }

    function delete_detail_c($detail_id)
    {
        $this->db1->where('detail_id', $detail_id);
        $query1 = $this->db1->delete($this->tabel6);
        return $query1;
    }

    function delete_detail_cx($detail_id)
    {
        $this->db1->where('detail_id', $detail_id);
        $query2 = $this->db1->delete($this->tabel7);
        return $query2;
    }
    function delete_detail_d($detail_id)
    {
        $this->db1->where('detail_id', $detail_id);
        $query1 = $this->db1->delete($this->tabel8);
        return $query1;
    }

    function delete_detail_dx($detail_id)
    {
        $this->db1->where('detail_id', $detail_id);
        $query2 = $this->db1->delete($this->tabel9);
        return $query2;
    }
}
