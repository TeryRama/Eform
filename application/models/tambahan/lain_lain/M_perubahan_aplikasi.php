<?php

class M_formfrmnon006_01 extends CI_Model {

    var $table1= 'tblfrmitdnon001hdr';
    var $table2= 'tblfrmitdnon001dtl';
    var $table3= 'tblfrmitdnon001dtlx';

        function __construct(){
                parent::__construct();
                $CI = &get_instance();
                $this->db1 = $this->load->database('db1',TRUE);
        }

        function insert_dt($data5){
                $this->db1->trans_begin();
                $query=$this->db1->insert($this->table1, $data5);
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

        function insert_detail($data6){
                $this->db1->trans_begin();
                $this->db1->insert($this->table2, $data6);
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

        function insert_detailx($data6x){
                $this->db1->trans_begin();
                $this->db1->insert($this->table3, $data6x);
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

        function get_permintaan(){
            $query= $this->db1->query('Select * from tblfrmitdnon001hdr');
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_header_byid($id){
                $this->db1->from($this->table1);
                $this->db1->where('headerid', $id);
                $query= $this->db1->get();
                if ($query->num_rows() ==1 ){
                        return $query->result();
                        }
                }


        function get_detail_byid($id){
        $this->db1->from($this->table2);
        $this->db1->where('headerid',$id);
        $this->db1->where('stdtl','1');
        $this->db1->order_by("detail_id_sampel","asc");
        $query = $this->db1->get();
        if ($query->num_rows() >0){
                return $query->result();
                }
        }

        function get_detail_byidx($id){
                $this->db1->from($this->table3);
                $this->db1->where('headerid',$id);
                $this->db1->where('stdtl','1');
                $this->db1->order_by("detail_id_sampel", "asc");
                $query= $this->db1->get();
                if ($query->num_rows() >0) {
                return $query->result();
                }
        }

        function update_hdr($headerid, $data5){
                $this->db1->trans_begin();
                $this->db1->where('headerid', $headerid);
                $this->db1->update($this->table1, $data5);
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



        function update_detail($datadetail, $data6){
                $this->db1->trans_begin();
                $this->db1->set($data6);
                $this->db1->where('detail_id', $datadetail);
                $this->db1->update($this->table2, $data6);
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


        function update_detailx($datadetail, $data6){
                $this->db1->trans_begin();
                $this->db1->set($data6);
                $this->db1->where('detail_id', $datadetail);
                $this->db1->update($this->table3, $data6);
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

        function cek_header($tanggal){
                        $this->db1->from($this->table1);
                        $this->db1->where('tanggal', $tanggal);
                        $query = $this->db1->get();
                        return $query;
                        }

        function cek_stdetail($headerid){
                        $this->db1->from($this->table1);
                        $this->db1->where('headerid', $headerid);
                        $this->db1->where('status_detail', '1');
                        $query = $this->db1->get();
                        return $query;
                        }
        function cek_stdetailx($headerid){
                        $this->db1->from($this->table1);
                        $this->db1->where('headerid', $headerid);
                        $this->db1->where('status_detailx', '1');
                        $query = $this->db1->get();
                        return $query;
                        }
        function delete_detail($detail_id) {
            $query1 = $this->db1->delete($this->table2, "detail_id = '$detail_id'");
            return $query1;
        }
        function delete_detailx($detail_id) {;
            $query2 = $this->db1->delete($this->table3, "detail_id = '$detail_id'");
            return $query2;
        }

        function update_stdtlx($detail_id){
                $this->db1->trans_start();
                $this->db1->query("Update tblfrmfrmnon006dtlx set stdtl='0' where detail_id ='$detail_id'");
                $this->db1->trans_complete();
        }

        function get_header2_byid($id){
            $query=$this->db1->query("select * from tblfrmfrmnon006dtl where headerid ='$id'");
            if ($query->num_rows()>0){
                return $query->result();
            }
        }

        function get_dtsampel006($dttanggal){
                $this->db1->select('detail_id as detail_id002, jam_sampling, deskripsi');
                $this->db1->from('tblfrmfrmlqs002dtl');
                $this->db1->join('tblfrmfrmlqs002hdr', 'tblfrmfrmlqs002hdr.headerid = tblfrmfrmlqs002dtl.headerid');
                $this->db1->where('tblfrmfrmlqs002hdr.lab_penguji','Laboratorium Kimia (CHE)');
                $this->db1->where('tblfrmfrmlqs002hdr.tipe_contoh','Utility');
                $this->db1->where('tblfrmfrmlqs002hdr.jns_produk','Boiler');
                $this->db1->where('tblfrmfrmlqs002hdr.tgl_dokumen',$dttanggal);
                $this->db1->where('tblfrmfrmlqs002hdr.tgl_antar',$dttanggal);
                $this->db1->where('tblfrmfrmlqs002hdr.tgl_produksi',$dttanggal);
                $this->db1->where('tblfrmfrmlqs002dtl.stdtl','1');
                $this->db1->order_by("tblfrmfrmlqs002dtl.detail_id", "asc");
                $query = $this->db1->get();
                if ($query->num_rows() > 0){
                return $query->result();
                }
            }

        function get_dtsampel006x($dttanggal){
                $this->db1->select('detail_id as detail_id002, jam_sampling, deskripsi');
                $this->db1->from('tblfrmfrmlqs002dtlx');
                $this->db1->join('tblfrmfrmlqs002hdr', 'tblfrmfrmlqs002hdr.headerid = tblfrmfrmlqs002dtl.headerid');
                $this->db1->where('tblfrmfrmlqs002hdr.lab_penguji','Laboratorium Kimia (CHE)');
                $this->db1->where('tblfrmfrmlqs002hdr.tipe_contoh','Utility');
                $this->db1->where('tblfrmfrmlqs002hdr.jns_produk','Boiler');
                $this->db1->where('tblfrmfrmlqs002hdr.tgl_dokumen',$dttanggal);
                $this->db1->where('tblfrmfrmlqs002hdr.tgl_antar',$dttanggal);
                $this->db1->where('tblfrmfrmlqs002hdr.tgl_produksi',$dttanggal);
                $this->db1->where('tblfrmfrmlqs002dtlx.stdtl','1');
                $this->db1->order_by("tblfrmfrmlqs002dtlx.detail_id", "asc");
                $query = $this->db1->get();
                if ($query->num_rows() > 0){
                return $query->result();
                }
            }

         function update_datasampel($tanggal_update){
            $this->db1->trans_begin();
            $query = $this->db1->query("SELECT * FROM update_frmnon006('$tanggal_update')");
                    if ($this->db1->trans_status() == FALSE) {
                        $this->db1->trans_rollback();
                        $result = 0;
                    } else {
                            $this->db1->trans_commit();
                            $result = 1;
                    }

                    return $result;
        }

         function update_datasampelx($tanggal_update){
            $this->db1->trans_begin();
            $query = $this->db1->query("SELECT * FROM update_frmnon006x('$tanggal_update')");
                    if ($this->db1->trans_status() == FALSE) {
                        $this->db1->trans_rollback();
                        $result = 0;
                    } else {
                            $this->db1->trans_commit();
                            $result = 1;
                    }

                    return $result;
        }

        

           

  
              
}
?>
