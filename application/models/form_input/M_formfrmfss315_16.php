<?php

class M_formfrmfss315_16 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss315hdr';
    var $tabel2 = 'tblfrmfrmfss315dtl';
    var $tabel3 = 'tblfrmfrmfss315dtlx';
    var $tabel4 = 'tblfrmfrmfss315dtl_b';
    var $tabel5 = 'tblfrmfrmfss315dtl_bx';
    var $tabel6 = 'tblfrmfrmfss315dtl_c';
    var $tabel7 = 'tblfrmfrmfss315dtl_cx';
    var $tabel8 = 'tblfrmfrmfss315dtl_d';
    var $tabel9 = 'tblfrmfrmfss315dtl_dx';

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

    //ambil data detail a berdasarkan tanggal sebelumnya
    function get_list_data_kemarin_raw_water($tgl_kemarin)
    {
        $query = $this->db1->query("SELECT 
                                        A.create_date,
                                        A.headerid,
                                        b.rw_1_fm_akhir,
                                        b.rw_2_fm_akhir,
                                        b.cone_1_2_fm_akhir,
                                        b.cone_3_4_fm_akhir 
                                    FROM
                                        tblfrmfrmfss315hdr
                                        AS A LEFT JOIN tblfrmfrmfss315dtl AS b ON A.headerid = b.headerid 
                                    WHERE
                                        A.create_date = '$tgl_kemarin' 
                                        AND b.shift = 'shift_3'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    //ambil data detail b berdasarkan tanggal sebelumnya
    function get_list_data_kemarin_bahan_kimia($tgl_kemarin)
    {
        $query = $this->db1->query("SELECT 
                                        b.baku_stok,
                                        b.larutan_stok,
                                        b.id_item1,
	                                    b.val_item1,
                                        b.id_item2,
                                        b.val_item2                                        
                                    FROM
                                        tblfrmfrmfss315hdr
                                        AS A LEFT JOIN tblfrmfrmfss315dtl_b AS b ON A.headerid = b.headerid 
                                    WHERE
                                        A.create_date = '$tgl_kemarin' 
                                        AND b.shift = 'shift_3'");
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

    function get_detail_byid_b($id, $tbl_b = null)
    {
        $tbl_b = $tbl_b ?? $this->tabel4;

        return $this->db1->query("select
                                row_number() over (partition by shift, id_item1 order by detail_id) rnum_item1,
                                row_number() over (partition by shift, id_item1 order by detail_id desc) rnum_item1_desc,
                                *
                            from
                                $tbl_b 
                            where
                                headerid='$id'
                            order by 
                                detail_id")->result();
    }


    function get_detail_byid_bx($id)
    {
        return $this->get_detail_byid_b($id, $this->tabel5);
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

    /// check group
    function check($create_date)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);
        $query = $this->db1->get();
        return $query;
    }

    function check2($create_date, $headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);
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

                              rw_1_total_jam,
                              rw_1_fm_awal,
                              rw_1_fm_akhir,
                              rw_1_total,
                              rw_1_drain,
                              rw_2_total_jam,
                              rw_2_fm_awal,
                              rw_2_fm_akhir,
                              rw_2_total,
                              rw_2_drain,
                              cone_1_2_total_jam,
                              cone_1_2_fm_awal,
                              cone_1_2_fm_akhir,
                              cone_1_2_total,
                              cone_1_2_drain
                              -- cone_3_4_total_jam,
                              -- cone_3_4_fm_awal,
                              -- cone_3_4_fm_akhir,
                              -- cone_3_4_total,
                              -- cone_3_4_drain
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.shift,

                              b.rw_1_total_jam,
                              b.rw_1_fm_awal,
                              b.rw_1_fm_akhir,
                              b.rw_1_total,
                              b.rw_1_drain,
                              b.rw_2_total_jam,
                              b.rw_2_fm_awal,
                              b.rw_2_fm_akhir,
                              b.rw_2_total,
                              b.rw_2_drain,
                              b.cone_1_2_total_jam,
                              b.cone_1_2_fm_awal,
                              b.cone_1_2_fm_akhir,
                              b.cone_1_2_total,
                              b.cone_1_2_drain
                              -- b.cone_3_4_total_jam,
                              -- b.cone_3_4_fm_awal,
                              -- b.cone_3_4_fm_akhir,
                              -- b.cone_3_4_total,
                              -- b.cone_3_4_drain
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

                              shift,

                              id_item1,
                              val_item1,
                              id_item2,
                              val_item2,
                              baku_terima,
                              baku_pakai,
                              baku_Stok,
                              larutan_terima,
                              larutan_pakai,
                              larutan_Stok
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              
                              b.shift,
                              
                              b.id_item1,
                              b.val_item1,
                              b.id_item2,
                              b.val_item2,
                              b.baku_terima,
                              b.baku_pakai,
                              b.baku_Stok,
                              b.larutan_terima,
                              b.larutan_pakai,
                              b.larutan_Stok                             
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

                              shift,

                              rw_sedimen_a1,
                              rw_sedimen_a2,
                              rw_sedimen_a3,
                              rw_sedimen_a4,
                              rw_sedimen_a5,
                              rw_sedimen_a6,
                              rw_sedimen_b1,
                              rw_sedimen_b2,
                              rw_sedimen_b3,
                              rw_sedimen_b4,
                              rw_sedimen_b5,
                              rw_sedimen_b6,
                              rw_cone_clarifier_1_2,
                              rw_cone_clarifier_3_4,
                              bsf_sedimen_c1,
                              bsf_sedimen_c2,
                              bsf_bak_v_notch,
                              bsf_bak_reyclce,
                              bsf_bak_cw,
                              asf_asf_a,
                              asf_asf_b,
                              asf_asf_1a,
                              asf_asf_1b,
                              asf_bak_2,
                              asf_bak_3,
                              asf_tower_tbn,
                              asf_tower_mess,
                              acf_acf_a,
                              acf_acf_b,
                              acf_bak_iv,
                              acf_bak_cip_1,
                              acf_bak_cip_2,
                              ast_ast,
                              ast_bak_demin,
                              ast_tangki_st_mes,
                              aro_tangki_ro_mes,
                              aro_tangki_ro,
                              aro_ro_wtp
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.shift,

                              b.rw_sedimen_a1,
                              b.rw_sedimen_a2,
                              b.rw_sedimen_a3,
                              b.rw_sedimen_a4,
                              b.rw_sedimen_a5,
                              b.rw_sedimen_a6,
                              b.rw_sedimen_b1,
                              b.rw_sedimen_b2,
                              b.rw_sedimen_b3,
                              b.rw_sedimen_b4,
                              b.rw_sedimen_b5,
                              b.rw_sedimen_b6,
                              b.rw_cone_clarifier_1_2,
                              b.rw_cone_clarifier_3_4,
                              b.bsf_sedimen_c1,
                              b.bsf_sedimen_c2,
                              b.bsf_bak_v_notch,
                              b.bsf_bak_reyclce,
                              b.bsf_bak_cw,
                              b.asf_asf_a,
                              b.asf_asf_b,
                              b.asf_asf_1a,
                              b.asf_asf_1b,
                              b.asf_bak_2,
                              b.asf_bak_3,
                              b.asf_tower_tbn,
                              b.asf_tower_mess,
                              b.acf_acf_a,
                              b.acf_acf_b,
                              b.acf_bak_iv,
                              b.acf_bak_cip_1,
                              b.acf_bak_cip_2,
                              b.ast_ast,
                              b.ast_bak_demin,
                              b.ast_tangki_st_mes,
                              b.aro_tangki_ro_mes,
                              b.aro_tangki_ro,
                              b.aro_ro_wtp
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
                              drain
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.shift,
                              b.drain
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

    function update_dtl_c($detail_id, $data6c)
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

    function update_dtl_cx($detail_id, $data6c)
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


    function update_dtl_d($detail_id, $data6d)
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

    function update_dtl_dx($detail_id, $data6d)
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
