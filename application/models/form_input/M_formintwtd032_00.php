<?php
class M_formintwtd032_00 extends CI_Model
{
    var $tabel_hdr    = 'tblfrmintwtd032hdr';
    var $tabel_dtl    = 'tblfrmintwtd032dtl';
    var $tabel_dtlx   = 'tblfrmintwtd032dtlx';

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
        return $this->db1->query(" SELECT 
                                        CAST(SUBSTRING(docno, LENGTH(docno) - 2) AS FLOAT) AS vdocno 
                                    FROM 
                                        $this->tabel_hdr 
                                    WHERE 
                                        EXTRACT(MONTH FROM create_date) = '$bulan' AND 
                                        EXTRACT(YEAR FROM create_date) = '$tahun' AND
                                        SUBSTRING(docno, LENGTH(docno) - 2) ~ '^\d+(\.\d+)?$'")->row();
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

    function cek_stdtl($headerid)
    {
        $this->db1->from($this->tabel_hdr);
        $this->db1->where('headerid', $headerid);
        $this->db1->where('status_detail', '1');
        $query = $this->db1->get();
        return $query;
    }

    function cek_stdtlx($headerid)
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

    function insert_hdr($data4)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel_hdr, $data4);
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

    function insert_dtl($data5)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel_dtl, $data5);
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

    function insert_dtlx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("INSERT INTO $this->tabel_dtlx 
                            (
                              detail_id,
                              headerid,
                              stdtl,
                              dta_problem_condition,           
                              dta_problem_solving,     
                              dta_start,             
                              dta_finish,   
                              dta_usage_material,      
                              dta_total,
                              dta_remark       
                            ) 
                            SELECT 
                              b.detail_id,
                              b.headerid,
                              CASE WHEN (b.stdtl)='0' THEN '1' ELSE b.stdtl END AS stdtl,
                              b.dta_problem_condition,           
                              b.dta_problem_solving,     
                              b.dta_start,             
                              b.dta_finish,   
                              b.dta_usage_material,      
                              b.dta_total,
                              b.dta_remark 
                            FROM 
                              $this->tabel_dtl AS b 
                            LEFT JOIN 
                              $this->tabel_dtlx AS bx 
                              ON b.detail_id = bx.detail_id 
                            WHERE 
                              bx.detail_id IS NULL 
                              AND b.headerid='$id' 
                            ORDER BY 
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

    function update_hdr($headerid, $data4)
    {
        $this->db1->trans_begin();
        $this->db1->where('headerid', $headerid);
        $this->db1->update($this->tabel_hdr, $data4);
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

    function update_dtl($detail_id, $data5)
    {
        $this->db1->trans_begin();
        $this->db1->set($data5);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtl, $data5);
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

    function update_dtlx($detail_id, $data5)
    {
        $this->db1->trans_begin();
        $this->db1->set($data5);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel_dtlx, $data5);
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
        $this->db1->query("UPDATE $this->tabel_dtlx set stdtl='0' where detail_id ='$detail_id'");
        $this->db1->trans_complete();
    }

    function delete_dtl($detail_id)
    {
        $query1 = $this->db1->delete($this->tabel_dtl, "detail_id = '$detail_id'");
        return $query1;
    }

    function delete_dtlx($detail_id)
    {
        $query2 = $this->db1->delete($this->tabel_dtlx, "detail_id = '$detail_id'");
        return $query2;
    }
}
