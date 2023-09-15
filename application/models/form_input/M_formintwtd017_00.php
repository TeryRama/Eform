<?php

class M_formintwtd017_00 extends CI_Model
{

    var $tabel1 = 'tblfrmintwtd017hdr';
    var $tabel2 = 'tblfrmintwtd017dtl';
    var $tabel3 = 'tblfrmintwtd017dtlx';
    var $tabel4 = 'tblfrmintwtd017dtl_b';
    var $tabel5 = 'tblfrmintwtd017dtl_bx';

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

    // function get_list_item($tipe, $create_date)
    // {
    //     $q = $this->db1->query("select 
    //                                 *,
    //                                 'item1' dtl_level
    //                               from 
    //                                 tblmst_formitem_hdr a 
    //                               join
    //                                 tblmst_formitem_dtl b 
    //                                 on a.headerid=b.headerid
    //                               where 
    //                                 a.inactive='0'
    //                                 and form_kode = 'FRM-FSS-520'
    //                                 and parameter = '$tipe'
    //                                 and departemen = 'WTD'
    //                                 and tgl_efective in (select 
    //                                                   max(tgl_efective) 
    //                                                 from 
    //                                                   tblmst_formitem_hdr 
    //                                                 where
    //                                                   inactive='0'
    //                                                   and form_kode = 'FRM-FSS-520'
    //                                                   and parameter = '$tipe'
    //                                                   and departemen = 'WTD'
    //                                                   and tgl_efective <='$create_date') 
    //                                                   ORDER BY detail_id")->result();

    //     $final = array();
    //     if (count($q) > 0) {
    //         foreach ($q as $row) {
    //             $q2 = $this->db1->query("select 
    //                                       *,
    //                                       'item2' dtl_level
    //                                     from 
    //                                       tblmst_formitem_dtl_b
    //                                     where 
    //                                       headerid=$row->headerid
    //                                       and detail_id_a=$row->detail_id
    //                                       ORDER BY 1")->result();
    //             if (count($q2) > 0) {
    //                 foreach ($q2 as $row2) {
    //                     $q3 = $this->db1->query("select 
    //                                               *,
    //                                               'item3' dtl_level
    //                                             from 
    //                                               tblmst_formitem_dtl_c
    //                                             where 
    //                                               headerid=$row->headerid
    //                                               and detail_id_b=$row2->detail_id_b")->result();
    //                     if (count($q3) > 0) {
    //                         foreach ($q3 as $row3) {
    //                             $q4 = $this->db1->query("select 
    //                                                       *,
    //                                                       'item4' dtl_level
    //                                                     from 
    //                                                       tblmst_formitem_dtl_d
    //                                                     where 
    //                                                       headerid=$row->headerid
    //                                                       and detail_id_c=$row3->detail_id_c")->result();
    //                             if (count($q4) > 0) {
    //                                 $row3->children3 = $q4;
    //                             }
    //                         }
    //                         $row2->children2 = $q3;
    //                     }
    //                 }
    //                 $row->children = $q2;
    //             }
    //             array_push($final, $row);
    //         }
    //     }
    //     return $final;
    // }

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
                              sedimen_ph_6a,
                              sedimen_ph_6b,
                              sedimen_colour_6a,
                              sedimen_colour_6b,
                              sedimen_tds_6a,
                              sedimen_tds_6b,
                              cone_ph,
                              cone_colour,
                              cone_tds,
                              tsf_colour_sf1,
                              tsf_colour_sf2,
                              tsf_colour_sf3,
                              tsf_colour_sf4,
                              tsf_colour_sf5,
                              tsf_colour_sf6,
                              tsf_colour_sf7

                              
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.shift,
                              b.sedimen_ph_6a,
                              b.sedimen_ph_6b,
                              b.sedimen_colour_6a,
                              b.sedimen_colour_6b,
                              b.sedimen_tds_6a,
                              b.sedimen_tds_6b,
                              b.cone_ph,
                              b.cone_colour,
                              b.cone_tds,
                              b.tsf_colour_sf1,
                              b.tsf_colour_sf2,
                              b.tsf_colour_sf3,
                              b.tsf_colour_sf4,
                              b.tsf_colour_sf5,
                              b.tsf_colour_sf6,
                              b.tsf_colour_sf7
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

                             
                              jam,
                              uraian,
                              tindakan,
                              keterangan
                              
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              
                              b.jam,
                              b.uraian,
                              b.tindakan,
                              b.keterangan
                             
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
}
