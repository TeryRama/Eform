<?php
class M_formfrmfss187_00 extends CI_Model
{

    var $tabel1 = 'tblfrmfrmfss187hdr';

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

    function get_docno($tahun)
    {
        return $this->db1->query("select 
                                    substring(docno from '.{2}$')::float vdocno
                                  from 
                                    $this->tabel1 
                                  where 
                                    extract(year from create_date)='$tahun'")->row();
    }
    
    function get_week_calender($tahun)
    {
        return $this->db1->query("SELECT
                                        ( EXTRACT ( WEEK FROM date_trunc( 'YEAR', ( '$tahun' || '0101' ) :: DATE ) + ( n || ' week' ) :: INTERVAL ) ) AS week 
                                    FROM
                                        generate_series ( 0, ( EXTRACT ( WEEK FROM date_trunc( 'YEAR', ( '$tahun' || '0101' ) :: DATE ) + INTERVAL '1 YEAR - 1 week' ) :: INTEGER - 1 )  ) n")->result();
    }

    function get_list_item($create_date, $dept)
    {
        return $this->db1->query("select 
                                    ROW_NUMBER ( ) OVER ( PARTITION BY detail_id ORDER BY c.detail_id_b DESC ) no_urut_desc,
                                    ROW_NUMBER ( ) OVER ( PARTITION BY detail_id ORDER BY c.detail_id_b ) no_urut,
                                    b.detail_id as point,
                                    b.item1 as v_point,
                                    c.detail_id_b as kode,
                                    c.item2 as v_kode,
                                    c.spek2 as frequency,
                                    d.item3 as v_pic,
                                    d.spek3 as ket,
                                    d.detail_id_c as pic
                                from 
                                    tblmst_formitem_hdr a 
                                join
                                    tblmst_formitem_dtl b 
                                    on a.headerid=b.headerid
                                join
                                    tblmst_formitem_dtl_b c
                                    on a.headerid=c.headerid
                                    and b.detail_id=c.detail_id_a
                                join
                                    tblmst_formitem_dtl_c d
                                    on a.headerid=d.headerid
                                    and c.detail_id_b=d.detail_id_b
                                where 
                                    a.inactive='0'
                                    and form_kode = 'FRM-FSS-188'
                                    and parameter = 'Tipe 1'
                                    and departemen = '$dept'
                                    and tgl_efective in (select 
                                                            max(tgl_efective) 
                                                        from 
                                                            tblmst_formitem_hdr 
                                                        where
                                                            inactive='0'
                                                            and form_kode = 'FRM-FSS-188'
                                                            and parameter = 'Tipe 1'
                                                            and departemen = '$dept'
                                                            and tgl_efective <='$create_date') 
                                ORDER BY 
                                    detail_id,
                                    c.detail_id_b,
                                    detail_id_c")->result();
    }

    function get_dtfrmfss188_by($tahun, $create_date, $dept)
    {
        $q = $this->db1->query("select 
                                    ROW_NUMBER ( ) OVER ( PARTITION BY detail_id ORDER BY c.detail_id_b DESC ) no_urut_desc,
                                    ROW_NUMBER ( ) OVER ( PARTITION BY detail_id ORDER BY c.detail_id_b ) no_urut,
                                    b.detail_id as point,
                                    b.item1 as v_point,
                                    c.detail_id_b as kode,
                                    c.item2 as v_kode,
                                    c.spek2 as frequency,
                                    d.item3 as v_pic,
                                    d.spek3 as ket,
                                    d.detail_id_c as pic
                                from 
                                    tblmst_formitem_hdr a 
                                join
                                    tblmst_formitem_dtl b 
                                    on a.headerid=b.headerid
                                join
                                    tblmst_formitem_dtl_b c
                                    on a.headerid=c.headerid
                                    and b.detail_id=c.detail_id_a
                                join
                                    tblmst_formitem_dtl_c d
                                    on a.headerid=d.headerid
                                    and c.detail_id_b=d.detail_id_b
                                where 
                                    a.inactive='0'
                                    and form_kode = 'FRM-FSS-188'
                                    and parameter = 'Tipe 1'
                                    and departemen = '$dept'
                                    and tgl_efective in (select 
                                                            max(tgl_efective) 
                                                        from 
                                                            tblmst_formitem_hdr 
                                                        where
                                                            inactive='0'
                                                            and form_kode = 'FRM-FSS-188'
                                                            and parameter = 'Tipe 1'
                                                            and departemen = '$dept'
                                                            and tgl_efective <='$create_date') 
                                ORDER BY 
                                    detail_id,
                                    c.detail_id_b,
                                    detail_id_c")->result();
        $final = array();
        if (count($q) > 0) {
            foreach ($q as $row) {
                $q2 = $this->db1->query("select
											( EXTRACT ( WEEK FROM date_trunc( 'YEAR', ( '$tahun' || '0101' ) :: DATE ) + ( n || ' week' ) :: INTERVAL ) ) AS week 
									    FROM
											generate_series ( 0, ( EXTRACT ( WEEK FROM date_trunc( 'YEAR', ( '$tahun' || '0101' ) :: DATE ) + INTERVAL '1 YEAR - 1 week' ) :: INTEGER - 1 )  ) n")->result();        
                if (count($q2) > 0) {
                    foreach ($q2 as $row2) {
                        $q3 = $this->db1->query("select
                                                    -- a.create_date,
                                                    b.gagal_lulus
                                                from
                                                    tblfrmfrmfss188hdr a
                                                join
                                                    tblfrmfrmfss188dtl b
                                                    on a.headerid=b.headerid
                                                where
                                                    a.minggu = '$row2->week'
                                                    and a.deptabbr = '$dept'
                                                    and b.point = '$row->point'
                                                    and b.kode = '$row->kode'
                                                    and a.status_detail = '1'
                                                    and b.gagal_lulus != ''
                                                GROUP BY
                                                    -- a.create_date,
                                                    b.gagal_lulus")->result(); 
                        $row2->children2 = $q3;
                        $q4 = $this->db1->query("select
                                                    a.tgl_schedule
                                                from
                                                    tbltrn_schedule_dtl a
                                                where
                                                    a.nama = '$row->point'
                                                    and a.kode = '$row->kode'
                                                    and a.pic = '$row->pic'
                                                    and a.kode_form = 'frmfss187'
                                                ORDER BY
                                                    a.detail_id")->result(); 
                        $row2->children3 = $q4;
                    }
                    $row->children = $q2;
                }
                array_push($final, $row);
            }
        }
        return $final;
    }
    function get_dtfrmfss188x_by($bulan, $tahun, $create_date, $dept)
    {
        $q = $this->db1->query("select 
                                    ROW_NUMBER ( ) OVER ( PARTITION BY detail_id ORDER BY c.detail_id_b DESC ) no_urut_desc,
                                    ROW_NUMBER ( ) OVER ( PARTITION BY detail_id ORDER BY c.detail_id_b ) no_urut,
                                    b.detail_id as point,
                                    b.item1 as v_point,
                                    c.detail_id_b as kode,
                                    c.item2 as v_kode,
                                    c.spek2 as frequency,
                                    d.item3 as v_pic,
                                    d.spek3 as ket,
                                    d.detail_id_c as pic
                                from 
                                    tblmst_formitem_hdr a 
                                join
                                    tblmst_formitem_dtl b 
                                    on a.headerid=b.headerid
                                join
                                    tblmst_formitem_dtl_b c
                                    on a.headerid=c.headerid
                                    and b.detail_id=c.detail_id_a
                                join
                                    tblmst_formitem_dtl_c d
                                    on a.headerid=d.headerid
                                    and c.detail_id_b=d.detail_id_b
                                where 
                                    a.inactive='0'
                                    and form_kode = 'FRM-FSS-188'
                                    and parameter = 'Tipe 1'
                                    and departemen = 'WTD'
                                    and tgl_efective in (select 
                                                            max(tgl_efective) 
                                                        from 
                                                            tblmst_formitem_hdr 
                                                        where
                                                            inactive='0'
                                                            and form_kode = 'FRM-FSS-188'
                                                            and parameter = 'Tipe 1'
                                                            and departemen = 'WTD'
                                                            and tgl_efective <='$create_date') 
                                ORDER BY 
                                    detail_id,
                                    c.detail_id_b,
                                    detail_id_c")->result();
        $final = array();
        if (count($q) > 0) {
            foreach ($q as $row) {
                $q2 = $this->db1->query("select
											EXTRACT(DAY FROM ( date_trunc( 'MONTH', ( '202301' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS date, 
											EXTRACT(MONTH FROM ( date_trunc( 'MONTH', ( '202301' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS month,
											EXTRACT(YEAR FROM ( date_trunc( 'MONTH', ( '202301' || '01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) :: DATE ) AS year
									    FROM
											generate_series ( 0, ( EXTRACT ( DAY FROM date_trunc( 'MONTH', ( '202301' || '01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: INTEGER - 1 )  ) n")->result();        
                if (count($q2) > 0) {
                    foreach ($q2 as $row2) {
                        $q3 = $this->db1->query("select
                                                    a.create_date,
                                                    a.dept,
                                                    a.deptabbr,
                                                    a.minggu,
                                                    b.point,
                                                    b.kode,
                                                    b.gagal_lulus
                                                from
                                                    tblfrmxhdr a
                                                join
                                                    tblfrmfrmfss188dtlx b
                                                    on a.headerid=b.headerid
                                                where
                                                    EXTRACT ( DAY FROM create_date ) = '$row2->date'
                                                    AND EXTRACT ( MONTH FROM create_date ) = '$row2->month'
                                                    AND EXTRACT ( YEAR FROM create_date ) = '$row2->year'
                                                    and b.point = '$row->point'
                                                    and b.kode = '$row->kode'
                                                    and a.status_detail = '1'
                                                ORDER BY
                                                    a.create_date,
                                                    b.detail_id")->result(); 
                        $row2->children2 = $q3;
                        $q4 = $this->db1->query("select
                                                    a.tgl_schedule
                                                from
                                                    tbltrn_schedule_dtl a
                                                where
                                                    a.nama = '$row->point'
                                                    and a.kode = '$row->kode'
                                                    and a.pic = '$row->pic'
                                                    and a.kode_form = 'intwtd016'
                                                ORDER BY
                                                    a.detail_id")->result(); 
                        $row2->children3 = $q4;
                    }
                    $row->children = $q2;
                }
                array_push($final, $row);
            }
        }
        return $final;
    }
    
    function get_trans_byid($id, $kode_form)
    {
        $this->db1->select("$this->tabel_trn_dtl.*,
                            tblmst_formitem_dtl.item1 as v_nama,
                            tblmst_formitem_dtl_b.item2 as v_kode,
                            tblmst_formitem_dtl_b.spek2 as frequency,
                            tblmst_formitem_dtl_c.item3 as v_pic,
                            ROW_NUMBER ( ) OVER ( PARTITION BY nama ORDER BY $this->tabel_trn_dtl.detail_id DESC ) no_urut_desc,
                            ROW_NUMBER ( ) OVER ( PARTITION BY nama ORDER BY $this->tabel_trn_dtl.detail_id ) no_urut,");
        $this->db1->from($this->tabel_trn_dtl);
        $this->db1->join('tblmst_formitem_dtl', 'tblmst_formitem_dtl.detail_id = ('.$this->tabel_trn_dtl.'.nama::INT)');
        $this->db1->join('tblmst_formitem_dtl_b', 'tblmst_formitem_dtl_b.detail_id_b = ('.$this->tabel_trn_dtl.'.kode::INT)');
        $this->db1->join('tblmst_formitem_dtl_c', 'tblmst_formitem_dtl_c.detail_id_c = '.$this->tabel_trn_dtl.'.pic');
        $this->db1->where('headerid_form', $id);
        $this->db1->where('kode_form', $kode_form);
        $this->db1->order_by($this->tabel_trn_dtl.".detail_id", "asc");
        $query = $this->db1->get();
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

    function check($create_date, $docno, $tahun, $dept)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('tahun', $tahun);
        $this->db1->where('dept', $dept);

        $query = $this->db1->get();
        return $query;
    }

    function check2($create_date, $docno, $tahun, $dept, $headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('docno', $docno);
        $this->db1->where('tahun', $tahun);
        $this->db1->where('dept', $dept);

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
