<?php
class M_forminttbn022_06 extends CI_Model
{
    var $tabel_hdr    = 'tblfrminttbn022hdr';
    var $tabel_dtl    = 'tblfrminttbn022dtl';
    var $tabel_dtlx   = 'tblfrminttbn022dtlx';
    var $tabel_dtl_b  = 'tblfrminttbn022dtl_b';
    var $tabel_dtl_bx = 'tblfrminttbn022dtl_bx';
    var $tabel_dtl_c  = 'tblfrminttbn022dtl_c';
    var $tabel_dtl_cx = 'tblfrminttbn022dtl_cx';
    var $tabel_dtl_d  = 'tblfrminttbn022dtl_d';
    var $tabel_dtl_dx = 'tblfrminttbn022dtl_dx';
    var $tabel_dtl_e  = 'tblfrminttbn022dtl_e';
    var $tabel_dtl_ex = 'tblfrminttbn022dtl_ex';
    var $tabel_dtl_f  = 'tblfrminttbn022dtl_f';
    var $tabel_dtl_fx = 'tblfrminttbn022dtl_fx';
    var $tabel_dtl_g  = 'tblfrminttbn022dtl_g';
    var $tabel_dtl_gx = 'tblfrminttbn022dtl_gx';

    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

    /**
     * get_docno
     *
     * @param  mixed $bulan
     * @param  mixed $tahun
     * @return void
     */
    function get_docno($bulan, $tahun)
    {
        return $this->db1->query("select 
                                    substring(docno from '.{3}$')::float vdocno
                                  from 
                                    $this->tabel_hdr 
                                  where 
                                    extract(month from create_date)='$bulan'
                                    and extract(year from create_date)='$tahun'")->row();
    }

    function check_data($create_date, $docno)
    {
        // cek data semua data, jika pertama kali buat form ini maka list master tetap muncul
        $q = $this->db1->query("select count(headerid) jml_data from tblfrminttbn022hdr where tahun='$create_date'")->row();

        // cek data create_date dan docno
        $q2 = $this->db1->query("select count(headerid) jml_data from tblfrminttbn022hdr where create_date='$create_date' and docno='$docno' and status_detail='0'")->row();

        // cek data create_date input laporan terakhir
        $q3 = $this->db1->query("select max(create_date) data_terakhir from tblfrminttbn022hdr where status_detail='0'")->result();
        return [
            'cek_data' => $q,
            'cek_data_2' => $q2,
            'cek_data_3' => $q3,
        ];
    }

    function check($create_date, $docno)
    {
        $this->db1->from($this->tabel_hdr);
        $this->db1->where('create_date', $create_date);
        $this->db1->where('docno', $docno);

        if (!empty($headerid)) {
            $this->db1->where('headerid !=', $headerid);
        }

        $query = $this->db1->get();
        return $query;
    }

    function check2($create_date, $docno, $headerid)
    {
        $this->db1->from($this->tabel_hdr);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);

        $this->db1->where('headerid !=', $headerid);
        $query = $this->db1->get();
        return $query;
    }

    function cek_stdetail($headerid)
    {
        $this->db1->from($this->tabel_hdr);
        $this->db1->where('headerid', $headerid);
        $this->db1->where('status_detail', '1');
        $query = $this->db1->get();
        return $query;
    }

    function cek_stdetailx($headerid)
    {
        $this->db1->from($this->tabel_hdr);
        $this->db1->where('headerid', $headerid);
        $this->db1->where('status_detailx', '1');
        $query = $this->db1->get();
        return $query;
    }

    function get_header_byid($id)
    {
        $this->db1->from($this->tabel_hdr);
        $this->db1->where('headerid', $id);
        $query = $this->db1->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

    function get_detail_byid($id)
    {
        $this->db1->from($this->tabel_dtl);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byidx($id)
    {
        $this->db1->from($this->tabel_dtlx);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_b($id)
    {
        $this->db1->from($this->tabel_dtl_b);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_bx($id)
    {
        $this->db1->from($this->tabel_dtl_bx);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_c($id)
    {
        $this->db1->from($this->tabel_dtl_c);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_cx($id)
    {
        $this->db1->from($this->tabel_dtl_cx);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_d($id)
    {
        $this->db1->from($this->tabel_dtl_d);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_dx($id)
    {
        $this->db1->from($this->tabel_dtl_dx);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_e($id)
    {
        $this->db1->from($this->tabel_dtl_e);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_ex($id)
    {
        $this->db1->from($this->tabel_dtl_ex);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_f($id)
    {
        $this->db1->from($this->tabel_dtl_f);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_fx($id)
    {
        $this->db1->from($this->tabel_dtl_fx);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_g($id)
    {
        $this->db1->from($this->tabel_dtl_g);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_gx($id)
    {
        $this->db1->from($this->tabel_dtl_gx);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function insert_dtheader($data5)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel_hdr, $data5);
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
        $this->db1->insert($this->tabel_dtl, $data6);
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
        $this->db1->query("insert into $this->tabel_dtlx 
                            (
                              detail_id,
                              headerid,
                              stdtl,
                              a1_time,           
                              a1_alkalinity,     
                              a1_ph,             
                              a1_conductivity,   
                              a1_thardness,      
                              a1_dissolvedoxygen,
                              a1_silica,         
                              a1_fe,             
                              a2_time,           
                              a2_alkalinityp,    
                              a2_alkalinitym,    
                              a2_ph,             
                              a2_conductivity,   
                              a2_ion,            
                              a2_silica,         
                              a3_time,           
                              a3_ph,             
                              a3_conductivity,   
                              a3_silica,         
                              a3_fe,             
                              a4_time,           
                              a4_ph,             
                              a4_conductivity,   
                              a4_silica,         
                              a4_fe             
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.a1_time,           
                              b.a1_alkalinity,     
                              b.a1_ph,             
                              b.a1_conductivity,   
                              b.a1_thardness,      
                              b.a1_dissolvedoxygen,
                              b.a1_silica,         
                              b.a1_fe,             
                              b.a2_time,           
                              b.a2_alkalinityp,    
                              b.a2_alkalinitym,    
                              b.a2_ph,             
                              b.a2_conductivity,   
                              b.a2_ion,            
                              b.a2_silica,         
                              b.a3_time,           
                              b.a3_ph,             
                              b.a3_conductivity,   
                              b.a3_silica,         
                              b.a3_fe,             
                              b.a4_time,           
                              b.a4_ph,             
                              b.a4_conductivity,   
                              b.a4_silica,         
                              b.a4_fe
                            from 
                              $this->tabel_dtl as b 
                            left join 
                              $this->tabel_dtlx as bx 
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

    function insert_detail_b($data6)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel_dtl_b, $data6);
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
        $this->db1->query("insert into $this->tabel_dtl_bx 
                            (
                              detail_id,
                              headerid,
                              stdtl,
                              b1_time,           
                              b1_alkalinity,     
                              b1_ph,             
                              b1_conductivity,   
                              b1_thardness,      
                              b1_dissolvedoxygen,
                              b1_silica,         
                              b1_fe,             
                              b2_time,           
                              b2_alkalinityp,    
                              b2_alkalinitym,    
                              b2_ph,             
                              b2_conductivity,   
                              b2_ion,            
                              b2_silica,         
                              b3_time,           
                              b3_ph,             
                              b3_conductivity,   
                              b3_silica,         
                              b3_fe,             
                              b4_time,           
                              b4_ph,             
                              b4_conductivity,   
                              b4_silica,         
                              b4_fe             
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.b1_time,           
                              b.b1_alkalinity,     
                              b.b1_ph,             
                              b.b1_conductivity,   
                              b.b1_thardness,      
                              b.b1_dissolvedoxygen,
                              b.b1_silica,         
                              b.b1_fe,             
                              b.b2_time,           
                              b.b2_alkalinityp,    
                              b.b2_alkalinitym,    
                              b.b2_ph,             
                              b.b2_conductivity,   
                              b.b2_ion,            
                              b.b2_silica,         
                              b.b3_time,           
                              b.b3_ph,             
                              b.b3_conductivity,   
                              b.b3_silica,         
                              b.b3_fe,             
                              b.b4_time,           
                              b.b4_ph,             
                              b.b4_conductivity,   
                              b.b4_silica,         
                              b.b4_fe
                            from 
                              $this->tabel_dtl_b as b 
                            left join 
                              $this->tabel_dtl_bx as bx 
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

    function insert_detail_c($data6)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel_dtl_c, $data6);
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
        $this->db1->query("insert into $this->tabel_dtl_cx 
                            (
                              detail_id,
                              headerid,
                              stdtl,
                              c1_time,
                              c1_alkalinity,
                              c1_ph,
                              c1_conductivity,
                              c1_thardness,
                              c1_dissolvedoxygen,
                              c1_silica,
                              c1_fe,
                              c2_time,
                              c2_alkalinityp,
                              c2_alkalinitym,
                              c2_ph,
                              c2_conductivity,
                              c2_ion,
                              c2_silica,
                              c3_time,
                              c3_ph,
                              c3_conductivity,
                              c3_silica,
                              c3_fe,
                              c4_time,
                              c4_ph,
                              c4_conductivity,
                              c4_silica,
                              c4_fe,
                              c5_time,
                              c5_conductivity,
                              c5_thardness,
                              c5_ph             
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.c1_time,
                              b.c1_alkalinity,
                              b.c1_ph,
                              b.c1_conductivity,
                              b.c1_thardness,
                              b.c1_dissolvedoxygen,
                              b.c1_silica,
                              b.c1_fe,
                              b.c2_time,
                              b.c2_alkalinityp,
                              b.c2_alkalinitym,
                              b.c2_ph,
                              b.c2_conductivity,
                              b.c2_ion,
                              b.c2_silica,
                              b.c3_time,
                              b.c3_ph,
                              b.c3_conductivity,
                              b.c3_silica,
                              b.c3_fe,
                              b.c4_time,
                              b.c4_ph,
                              b.c4_conductivity,
                              b.c4_silica,
                              b.c4_fe,
                              b.c5_time,
                              b.c5_conductivity,
                              b.c5_thardness,
                              b.c5_ph       
                            from 
                              $this->tabel_dtl_c as b 
                            left join 
                              $this->tabel_dtl_cx as bx 
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

    function insert_detail_d($data6)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel_dtl_d, $data6);
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
        $this->db1->query("insert into $this->tabel_dtl_dx 
                            (
                              detail_id,
                              headerid,
                              stdtl,
                              d1_time,            
                              d1_thardness,       
                              d1_ph,              
                              d1_conductivity,    
                              d1_dissolvedoxygen, 
                              d1_silica,          
                              d1_fe,              
                              d2_time,            
                              d2_thardness,       
                              d2_ph,              
                              d2_conductivity,    
                              d2_dissolvedoxygen, 
                              d2_silica,          
                              d2_fe,              
                              d3_time,            
                              d3_alkalinity,      
                              d3_conductivity,    
                              d3_thardness,       
                              d3_ph,              
                              d3_suhu_inlet,      
                              d3_suhu_outlet,     
                              d3_turbuditi,       
                              d3_ci,              
                              d3_freeci2,         
                              d4_time,            
                              d4_thardness,       
                              d4_ph,              
                              d4_conductivity,    
                              d4_turbuditi,       
                              d4_ci,              
                              d4_freeci2,         
                              d5_time,            
                              d5_ph,              
                              d5_conductivity,    
                              d5_hardness           
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.d1_time,            
                              b.d1_thardness,       
                              b.d1_ph,              
                              b.d1_conductivity,    
                              b.d1_dissolvedoxygen, 
                              b.d1_silica,          
                              b.d1_fe,              
                              b.d2_time,            
                              b.d2_thardness,       
                              b.d2_ph,              
                              b.d2_conductivity,    
                              b.d2_dissolvedoxygen, 
                              b.d2_silica,          
                              b.d2_fe,              
                              b.d3_time,            
                              b.d3_alkalinity,      
                              b.d3_conductivity,    
                              b.d3_thardness,       
                              b.d3_ph,              
                              b.d3_suhu_inlet,      
                              b.d3_suhu_outlet,     
                              b.d3_turbuditi,       
                              b.d3_ci,              
                              b.d3_freeci2,         
                              b.d4_time,            
                              b.d4_thardness,       
                              b.d4_ph,              
                              b.d4_conductivity,    
                              b.d4_turbuditi,       
                              b.d4_ci,              
                              b.d4_freeci2,         
                              b.d5_time,            
                              b.d5_ph,              
                              b.d5_conductivity,    
                              b.d5_hardness          
                            from 
                              $this->tabel_dtl_d as b 
                            left join 
                              $this->tabel_dtl_dx as bx 
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

    function insert_detail_e($data6)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel_dtl_e, $data6);
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

    function insert_detail_ex($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel_dtl_ex 
                            (
                              detail_id,
                              headerid,
                              stdtl,
                              e1_time,         
                              e1_startstop,    
                              e1_turbuditi,    
                              e1_pressure,     
                              e1_flowmeter,    
                              e1_ph,           
                              e1_conductivity, 
                              e2_acidion,      
                              e3_conductivity, 
                              e3_ph,           
                              e4_acidion,      
                              e5_conductivity, 
                              e5_ph,           
                              e5_silica                 
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.e1_time,         
                              b.e1_startstop,    
                              b.e1_turbuditi,    
                              b.e1_pressure,     
                              b.e1_flowmeter,    
                              b.e1_ph,           
                              b.e1_conductivity, 
                              b.e2_acidion,      
                              b.e3_conductivity, 
                              b.e3_ph,           
                              b.e4_acidion,      
                              b.e5_conductivity, 
                              b.e5_ph,           
                              b.e5_silica          
                            from 
                              $this->tabel_dtl_e as b 
                            left join 
                              $this->tabel_dtl_ex as bx 
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

    function insert_detail_f($data6)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel_dtl_f, $data6);
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

    function insert_detail_fx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel_dtl_fx 
                            (
                              detail_id,
                              headerid,
                              stdtl,
                              f1_timestart,
                              f1_timestop, 
                              f1_ro,       
                              f1_flowstart,
                              f1_flowstop, 
                              f1_total                  
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.f1_timestart,
                              b.f1_timestop, 
                              b.f1_ro,       
                              b.f1_flowstart,
                              b.f1_flowstop, 
                              b.f1_total        
                            from 
                              $this->tabel_dtl_f as b 
                            left join 
                              $this->tabel_dtl_fx as bx 
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

    function insert_detail_g($data6)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel_dtl_g, $data6);
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

    function insert_detail_gx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel_dtl_gx 
                            (
                              detail_id,
                              headerid,
                              stdtl,
                              g1_timestart,
                              g1_timestop, 
                              g1_note,       
                              g1_flowstart,
                              g1_flowstop, 
                              g1_total                  
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.g1_timestart,
                              b.g1_timestop, 
                              b.g1_note,       
                              b.g1_flowstart,
                              b.g1_flowstop, 
                              b.g1_total        
                            from 
                              $this->tabel_dtl_g as b 
                            left join 
                              $this->tabel_dtl_gx as bx 
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
        $this->db1->update($this->tabel_hdr, $data5);
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
        $this->db1->update($this->tabel_dtl, $data6);
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
        $this->db1->update($this->tabel_dtlx, $data6);
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

    function update_dtl_b($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl_b, $data6);
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

    function update_dtl_bx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl_bx, $data6);
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

    function update_dtl_c($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl_c, $data6);
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

    function update_dtl_cx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl_cx, $data6);
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

    function update_dtl_d($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl_d, $data6);
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

    function update_dtl_dx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl_dx, $data6);
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

    function update_dtl_e($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl_e, $data6);
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

    function update_dtl_ex($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl_ex, $data6);
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

    function update_dtl_f($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl_f, $data6);
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

    function update_dtl_fx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl_fx, $data6);
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

    function update_dtl_g($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl_g, $data6);
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

    function update_dtl_gx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl_gx, $data6);
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
        $this->db1->query("Update $this->tabel_dtlx set stdtl='0' where detail_id ='$detail_id'");
        $this->db1->trans_complete();
    }

    // delete aja, jadi gak ada update
    function delete_detail_byheaderid_a($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel_dtl);
        return $query1;
    }

    function delete_detail_byheaderid_ax($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel_dtlx);
        return $query2;
    }
}
