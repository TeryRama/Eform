<?php
class M_form_item_mesin extends CI_Model {
    function __construct(){
            parent:: __construct();
            $CI = &get_instance();
            $this->db1= $this->load->database('db1',TRUE);
    }
        function get_records_payroll($deptabbr){
            
            $arr_deptabbr = (explode(',',$deptabbr));
            $str_deptabbr = "'".implode("','",$arr_deptabbr)."'";
            return json_decode($this->curl->simple_get(setAPI()."p1_get_all_departemen_byakses2/".$str_deptabbr));
        }
        function get_records(){
            $query = $this->db1->query("select * from tblmstformitemmesin_hdr order by form_jenis asc, form_kategori asc, form_kode asc, tgl_efective asc");
            return $query->result();
        }

        function get_formjenis(){
            $query = $this->db1->query("SELECT DISTINCT(formjnsnm) FROM vwmst_form ORDER BY formjnsnm ASC");
            return $query->result();
        }

        function get_formkategori($formjnsnm){
            $query = $this->db1->query("SELECT DISTINCT(formkategorinm) FROM vwmst_form WHERE formjnsnm = '$formjnsnm' ORDER BY formkategorinm ASC");
            return $query->result();
        }

        function get_dt_formjnsnm($formjnsnm,$formkategorinm){
            if($formkategorinm!=''){
                $vformkategorinm = '= '.$formkategorinm;
            }else{
                $vformkategorinm = 'IS NULL';
            }
            $query = $this->db1->query("select DISTINCT (formkd), formnm FROM vwmst_form WHERE formjnsnm='$formjnsnm' AND formkategorinm $vformkategorinm group by formkd, formnm");
            if($query->num_rows()>0){
                return $query->result();
            }else{
                return array();
            }
         }

        function get_partkomponen($deptabbr) {
            $arr_deptabbr = (explode(',',$deptabbr));
            $str_deptabbr = "'".implode("','",$arr_deptabbr)."'";

            $this->db1->from('tblmstkomponenmesin');
            $this->db1->where('deptabbr IN ('.$str_deptabbr.')');
            $this->db1->order_by('komponen_id', 'asc');
            $query = $this->db1->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            }
             
         }
        function get_records_by_komponen($komponen_id) {
             $this->db1->from('tblmstkomponenmesin');
             $this->db1->where('komponen_id', $komponen_id);
             $this->db1->order_by('komponen_id', 'asc');
             $query = $this->db1->get();
             if ($query->num_rows() > 0) {
                return $query->result();
            }
             
         }

        function get_mesin() {
             $this->db1->from('tblfrmfrmfss064dtl');
             $this->db1->order_by('kode_mesin', 'asc');
             $query = $this->db1->get();
             if ($query->num_rows() > 0) {
                return $query->result();
            }
             
         }
         
         function cek_header($dtform_jenis,$dtkategori_form,$dtkode_form,$dtparameter,$dtdepartemen,$dttgl_efective){
            $this->db1->from('tblmstformitemmesin_hdr');
            $this->db1->where('form_jenis', $dtform_jenis);
            $this->db1->where('form_kategori', $dtkategori_form);
            $this->db1->where('form_kode', $dtkode_form);
            $this->db1->where('parameter', $dtparameter);
            $this->db1->where('departemen', $dtdepartemen);
            $this->db1->where('tgl_efective', $dttgl_efective);
            $query = $this->db1->get();
            return $query;
         }


         function cek_spec2($dtkode_form,$dtversi_form,$dtbagian,$tipe_contoh,$jns_produk,$tgl_start,$formula,$headerid){
            $this->db1->from('tblmstformitem_hdr');
            $this->db1->where('form_kode', $dtkode_form);
            $this->db1->where('form_versi', $dtversi_form);
            $this->db1->where('bagian', $dtbagian);
            $this->db1->where('tipe_contoh', $tipe_contoh);
            $this->db1->where('jenis_produk', $jns_produk);
            $this->db1->where('tgl_start', $tgl_start);
            $this->db1->where('formula', $formula);
            $this->db1->where('headerid !=', $headerid);
            $query = $this->db1->get();
            return $query;
         }

        function cek_header_komponen($mdl1_dept, $mdl1_nama_komponen, $mdl1_kode_komponen){
            $this->db1->from('tblmstkomponenmesin');
            $this->db1->where('deptid', $mdl1_dept);
            $this->db1->where('nama_komponen', $mdl1_nama_komponen);
            $this->db1->where('kode_komponen', $mdl1_kode_komponen);
            return $this->db1->get();
        }

        function cek_header2_komponen($mdl1_dept, $mdl1_nama_komponen, $mdl1_kode_komponen, $mdl1_komponen_id){
            $this->db1->from('tblmstkomponenmesin');
            $this->db1->where('deptid', $mdl1_dept);
            $this->db1->where('nama_komponen', $mdl1_nama_komponen);
            $this->db1->where('kode_komponen', $mdl1_kode_komponen);
            $this->db1->where('komponen_id !=', $mdl1_komponen_id);
            return $this->db1->get();
        }
            
        function insert_hdr_komponen($data){
            $query = $this->db1->insert('tblmstkomponenmesin', $data);
            return TRUE;
        }

        function update_hdr_komponen($komponen_id, $data){
            $this->db1->where('komponen_id', $komponen_id);
            $this->db1->update('tblmstkomponenmesin', $data);
            return TRUE;
        }

         function insert_hdr($data_header){
            $this->db1->trans_begin();
                $query=$this->db1->insert('tblmstformitemmesin_hdr', $data_header);
                    if ($this->db1->trans_status() == FALSE) {
                        $this->db1->trans_rollback();
                        $result = 0;
                    } else {
                            $this->db1->trans_commit();
                            $result = 1;
                            $insert_id = $this->db1->insert_id();
                            return $insert_id;
                    }

                return $result;
                return TRUE;
        }

        // start grup insert detail
         function insert_detail($data_detail){
            $this->db1->trans_begin();
                $query=$this->db1->insert('tblmstformitemmesin_dtl', $data_detail);
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

         function insert_detail_b($modal_detail){
            $this->db1->trans_begin();
                $query=$this->db1->insert('tblmstformitemmesin_dtl_b', $modal_detail);
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

         function insert_detail_c($modal_detail_c){
            $this->db1->trans_begin();
                $query=$this->db1->insert('tblmstformitemmesin_dtl_c', $modal_detail_c);
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
         //end grup insert detail

         function getdata_header($headerid){
            $this->db1->from('tblmstformitemmesin_hdr');
            $this->db1->where('headerid',$headerid);
            $query = $this->db1->get();
            if ($query->num_rows() >0){
                return $query->result();
            }else{
                return array();
            }   
         }

         //start view data detail
         function getdata_detail($headerid){
            $this->db1->from('tblmstformitemmesin_dtl');
            $this->db1->where('headerid',$headerid);
            $this->db1->order_by("detail_id","asc");
            $query = $this->db1->get();
            if ($query->num_rows() >0){
                return $query->result();
            }else{
                return array();
            }   
         }

         function getdata_detail_b($headerid,$detail_id){
            $query = $this->db1->query("SELECT
                                            A.headerid,
                                            A.detail_id,
                                            A.item1 AS item1_dtl,
                                            B.detail_id AS detail_id_b,
                                            B.item2 AS item2_dtl_b,
                                            B.part_komponen	
                                        FROM
                                            tblmstformitemmesin_dtl AS A
                                            FULL JOIN tblmstformitemmesin_dtl_b AS B ON A.detail_id = B.detail_id_a 
                                        WHERE
                                            A.headerid = '$headerid' 
                                            AND A.detail_id = '$detail_id' 
                                        ORDER BY
                                            B.detail_id ASC");
            if ($query->num_rows() >0){
                return $query->result();
            }else{
                return array();
            }   
         }

         function getdata_detail_c($headerid,$detail_id,$detail_id_b){
            $query = $this->db1->query("SELECT
                                            A.headerid,
                                            A.detail_id,
                                            A.item1 AS item1_dtl,
                                            B.detail_id AS detail_id_b,
                                            B.item2 AS item2_dtl_b,
                                            B.part_komponen,
                                            C.detail_id AS detail_id_c,
                                            C.item3 AS item3_dtl_c,
                                            C.part_komponen_na 
                                        FROM
                                            tblmstformitemmesin_dtl AS A
                                            FULL JOIN tblmstformitemmesin_dtl_b AS B ON A.detail_id = B.detail_id_a
                                            FULL JOIN tblmstformitemmesin_dtl_c AS C ON B.detail_id = C.detail_id_b 
                                        WHERE
                                            A.headerid = '$headerid' 
                                            AND A.detail_id = '$detail_id' 
                                            AND B.detail_id = '$detail_id_b' 
                                        ORDER BY
                                            C.detail_id ASC");
            if ($query->num_rows() >0){
                return $query->result();
            }else{
                return array();
            }   
         }

         function getdata_detail_b_view($headerid){
            $query = $this->db1->query("SELECT
                tblmstformitemmesin_dtl.headerid,
                tblmstformitemmesin_dtl.detail_id,
                tblmstformitemmesin_dtl.item1 AS item1_dtl,
                tblmstformitemmesin_dtl_b.detail_id AS detail_id_b,
                tblmstformitemmesin_dtl_b.item2 AS item2_dtl_b
            FROM
                tblmstformitemmesin_dtl
            RIGHT JOIN 
                tblmstformitemmesin_dtl_b 
                ON 
                    tblmstformitemmesin_dtl.detail_id = tblmstformitemmesin_dtl_b.detail_id_a
            WHERE
                tblmstformitemmesin_dtl.headerid = '$headerid'
            ORDER BY
                tblmstformitemmesin_dtl.detail_id ASC, tblmstformitemmesin_dtl_b.detail_id ASC");
            if ($query->num_rows() >0){
                return $query->result();
            }else{
                return array();
            }   
         }

         function getdata_detail_c_view($headerid){
                $query = $this->db1->query("SELECT
                    tblmstformitem_dtl.headerid,
                    tblmstformitem_dtl.detail_id,
                    tblmstformitem_dtl.item1 AS item1_dtl,
                    tblmstformitem_dtl_b.detail_id_b,
                    tblmstformitem_dtl_b.item2 AS item2_dtl_b,
                    tblmstformitem_dtl_c.detail_id_c,
                    tblmstformitem_dtl_c.item3 AS item3_dtl_c
                FROM
                    tblmstformitem_dtl
                RIGHT JOIN 
                    tblmstformitem_dtl_b 
                    ON 
                        tblmstformitem_dtl.detail_id = tblmstformitem_dtl_b.detail_id_a
                RIGHT JOIN 
                    tblmstformitem_dtl_c 
                    ON 
                        tblmstformitem_dtl_b.detail_id_b = tblmstformitem_dtl_c.detail_id_b
                WHERE
                    tblmstformitem_dtl.headerid = '$headerid'
                ORDER BY
                    tblmstformitem_dtl.detail_id ASC, tblmstformitem_dtl_b.detail_id_b ASC, tblmstformitem_dtl_c.detail_id_c ASC");
            if ($query->num_rows() >0){
                return $query->result();
            }else{
                return array();
            }   
         }

         function getdata_detail_d_view($headerid){
            $query = $this->db1->query("SELECT
                tblmstformitem_dtl.headerid,
                tblmstformitem_dtl.detail_id,
                tblmstformitem_dtl.item1 AS item1_dtl,
                tblmstformitem_dtl_b.detail_id_b,
                tblmstformitem_dtl_b.item2 AS item2_dtl_b,
                tblmstformitem_dtl_c.detail_id_c,
                tblmstformitem_dtl_c.item3 AS item3_dtl_c,
                tblmstformitem_dtl_d.detail_id_d,
                tblmstformitem_dtl_d.item4 AS item4_dtl_d
            FROM
                tblmstformitem_dtl
            RIGHT JOIN 
                tblmstformitem_dtl_b 
                ON 
                    tblmstformitem_dtl.detail_id = tblmstformitem_dtl_b.detail_id_a
            RIGHT JOIN 
                tblmstformitem_dtl_c 
                ON 
                    tblmstformitem_dtl_b.detail_id_b = tblmstformitem_dtl_c.detail_id_b
            RIGHT JOIN 
                tblmstformitem_dtl_d 
                ON 
                    tblmstformitem_dtl_c.detail_id_c = tblmstformitem_dtl_d.detail_id_c
            WHERE
                tblmstformitem_dtl.headerid = '$headerid'
            ORDER BY
                tblmstformitem_dtl.detail_id ASC, tblmstformitem_dtl_b.detail_id_b ASC, tblmstformitem_dtl_c.detail_id_c ASC, tblmstformitem_dtl_d.detail_id_d ASC");
            if ($query->num_rows() >0){
                return $query->result();
            }else{
                return array();
            }   
         }

         function getdata_detail_e_view($headerid){
            $query = $this->db1->query("SELECT
                                            tblmstformitemmesin_dtl.headerid,
                                            tblmstformitemmesin_dtl.detail_id,
                                            tblmstformitemmesin_dtl.item1 AS item1_dtl,
                                            tblmstformitemmesin_dtl_b.detail_id as detail_id_b,
                                            tblmstformitemmesin_dtl_b.item2 AS item2_dtl_b,
                                            tblmstformitemmesin_dtl_b.part_komponen,
                                            tblmstformitemmesin_dtl_c.detail_id as detail_id_c,
                                            tblmstformitemmesin_dtl_c.item3 AS item3_dtl_c,
                                            tblmstformitemmesin_dtl_c.part_komponen_na,
                                            tblfrmfrmfss064dtl.nama_mesin,
                                            tblfrmfrmfss064dtl.kode_mesin
                                        FROM
                                            tblmstformitemmesin_dtl
                                            FULL JOIN tblmstformitemmesin_dtl_b ON tblmstformitemmesin_dtl.detail_id = tblmstformitemmesin_dtl_b.detail_id_a
                                            FULL JOIN tblmstformitemmesin_dtl_c ON tblmstformitemmesin_dtl_b.detail_id = tblmstformitemmesin_dtl_c.detail_id_b
                                            LEFT JOIN tblfrmfrmfss064dtl ON tblmstformitemmesin_dtl_c.item3 = tblfrmfrmfss064dtl.detail_id::VARCHAR
                                        WHERE
                                            tblmstformitemmesin_dtl.headerid = '$headerid' 
                                        ORDER BY
                                            tblmstformitemmesin_dtl.detail_id ASC,
                                            tblmstformitemmesin_dtl_b.detail_id ASC,
                                            tblmstformitemmesin_dtl_c.detail_id ASC");
            if ($query->num_rows() >0){
                return $query->result();
            }else{
                return array();
            }   
         }
         //end view data detail

         //grup update data
         function update_hdr($headerid, $data_header){
                $this->db1->trans_begin();
                $this->db1->where('headerid', $headerid);
                $this->db1->update('tblmstformitemmesin_hdr', $data_header);
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

        function update_dtl($detailid,$data_detail){
                $this->db1->trans_begin();
                $this->db1->set($data_detail);
                $this->db1->where('detail_id', $detailid);
                $this->db1->update('tblmstformitemmesin_dtl', $data_detail);
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

        function update_detail_b($detailid, $modal_detail){
                $this->db1->trans_begin();
                $this->db1->set($modal_detail);
                $this->db1->where('detail_id',$detailid);
                $this->db1->update('tblmstformitemmesin_dtl_b', $modal_detail);
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

        function update_detail_c($detailid_c, $modal_detail_c){
                $this->db1->trans_begin();
                $this->db1->set($modal_detail_c);
                $this->db1->where('detail_id',$detailid_c);
                $this->db1->update('tblmstformitemmesin_dtl_c', $modal_detail_c);
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


        function delete_detail($detail_id){
            $this->db1->trans_begin();
            $this->db1->delete('tblmstformitemmesin_dtl', "detail_id = '$detail_id'");
            if ($this->db1->trans_status() == FALSE) {
                        $this->db1->trans_rollback();
                        $detail_result = 0;
                    } else {
                            $this->db1->trans_commit();
                            $detail_result = 1;
                    }

                return $detail_result;
        }

        function delete_komponen($komponen_id){
            $this->db1->trans_begin();
            $this->db1->delete('tblmstkomponenmesin', "komponen_id = '$komponen_id'");
            if ($this->db1->trans_status() == FALSE) {
                        $this->db1->trans_rollback();
                        $header_result = 0;
                    } else {
                            $this->db1->trans_commit();
                            $header_result = 1;
                    }

                return $header_result;
        }
        function delete_header($headerid){
            $this->db1->trans_begin();
            $this->db1->delete('tblmstformitemmesin_hdr', "headerid = '$headerid'");
            if ($this->db1->trans_status() == FALSE) {
                        $this->db1->trans_rollback();
                        $header_result = 0;
                    } else {
                            $this->db1->trans_commit();
                            $header_result = 1;
                    }

                return $header_result;
        }

        //start grup delete data detail in modal
        function modal_delete_detail_b($modal_detail_id){
            $this->db1->trans_begin();
            $this->db1->delete('tblmstformitemmesin_dtl_b', "detail_id = '$modal_detail_id'");
            if ($this->db1->trans_status() == FALSE) {
                        $this->db1->trans_rollback();
                        $detail_result = 0;
                    } else {
                            $this->db1->trans_commit();
                            $detail_result = 1;
                    }

                return $detail_result;
        }

        function modal_delete_detail_c($modal_detail_id_c){
            $this->db1->trans_begin();
            $this->db1->delete('tblmstformitemmesin_dtl_c', "detail_id = '$modal_detail_id_c'");
            if ($this->db1->trans_status() == FALSE) {
                        $this->db1->trans_rollback();
                        $detail_result = 0;
                    } else {
                            $this->db1->trans_commit();
                            $detail_result = 1;
                    }

                return $detail_result;
        }


    function get_all_item($headerid) {

        $q = $this->db1->query("SELECT * FROM tblmstformitemmesin_dtl WHERE headerid='$headerid' ORDER BY detail_id ASC");
        $final = array();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $q2 = $this->db1->query("SELECT * FROM tblmstformitemmesin_dtl_b WHERE headerid='".$row->headerid."' AND detail_id_a='".$row->detail_id."' ORDER BY detail_id ASC");
                if ($q2->num_rows() > 0) {
                    foreach ($q2->result() as $row2) {
                        $q3 = $this->db1->query("SELECT a.*,b.nama_mesin,b.kode_mesin,b.detail_id FROM tblmstformitemmesin_dtl_c as a JOIN tblfrmfrmfss064dtl as b on a.item3 = b.detail_id::VARCHAR WHERE a.headerid='".$row->headerid."' AND detail_id_b='".$row2->detail_id."' ORDER BY a.detail_id ASC");
                        if ($q3->num_rows() > 0) {
                            // foreach ($q3->result() as $row3) {
                            //     $q4 = $this->db1->query("SELECT * FROM tblmstformitemmesin_dtl_d WHERE headerid='".$row->headerid."' AND detail_id_c='".$row3->detail_id_c."' ORDER BY detail_id_d ASC");
                            //     if ($q4->num_rows() > 0) {
                            //         foreach ($q4->result() as $row4) {
                            //             $q5 = $this->db1->query("SELECT * FROM tblmstformitemmesin_dtl_e WHERE headerid='".$row->headerid."' AND detail_id_d='".$row4->detail_id_d."' ORDER BY detail_id_e ASC");
                            //             if ($q5->num_rows() > 0) {
                            //                 $row4->children4 = $q5->result();
                            //             }
                            //         }
                            //         $row3->children3 = $q4->result();
                            //     }
                            // }
                            $row2->children2 = $q3->result();
                        }else{}
                    }
                    $row->children = $q2->result();
                }else{}

                array_push($final, $row);
            }
        }
        return $final;
    }

}
