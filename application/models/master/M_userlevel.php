<?php

class M_userlevel extends CI_Model {

    var $tabel = 'tblmst_leveluser'; //variabel tabel
     var $tabel2 = 'tblmstsubmenu_akses2'; //variabel tabel
     var $tabel3 = 'tblmstform_akses2'; //variabel tabel
     var $tabel4 = 'tblmstapproval_akses2'; //variabel tabel
     var $tabel5 = 'tblmstbutton_akses'; //variabel tabel

    function __construct(){
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

    function delete_button_akses($id){
        $query = $this->db1->query("DELETE FROM tblmstbutton_akses WHERE leveluserid='$id'");
        return $query;
    }

    function delete_button_akses_audit($id_audit){
        $query = $this->db1->query("DELETE FROM tblmstbutton_akses WHERE leveluserid='$id_audit'");
        return $query;
    }

    function get_list_bagian(){
        // $query= $this->db1->query("SELECT * FROM dblink('host=192.168.3.8 user=postgres password=sa123 dbname=dbwhs_utl', 'select id_bagian, bagian_abbr from tblmst_bagian where (inactive) ::INTEGER =0 order by bagian_abbr asc') AS tn1(id_bagian integer, bagian_abbr text)");
        // if ($query->num_rows() >0 ){
        //     return $query->result();
        // }
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_bagian"));
    }

    function delete_menu_akses($id){
        $query = $this->db1->query("DELETE FROM tblmstsubmenu_akses2 WHERE leveluserid='$id'");
        return $query;
    }

    function delete_menu_akses_audit($id_audit){
        $query = $this->db1->query("DELETE FROM tblmstsubmenu_akses2 WHERE leveluserid='$id_audit'");
        return $query;
    }

    function delete_form_akses($id){
        $query = $this->db1->query("DELETE FROM tblmstform_akses2 WHERE leveluserid='$id'");
        return $query;
    }

    function delete_form_akses_audit($id_audit){
        $query = $this->db1->query("DELETE FROM tblmstform_akses2 WHERE leveluserid='$id_audit'");
        return $query;
    }

    function delete_app_akses($id){
        $query = $this->db1->query("DELETE FROM tblmstapproval_akses2 WHERE leveluserid='$id'");
        return $query;
    }

    function delete_app_akses_audit($id_audit){
        $query = $this->db1->query("DELETE FROM tblmstapproval_akses2 WHERE leveluserid='$id_audit'");
        return $query;
    }

    function allcompany(){
        // $query = $this->db->query("select * from tblmst_company order by company asc, company_branch asc");
        // if ($query->num_rows() > 0){
        //     return $query->result();
        // }
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_company"));
    }

    function get_opt_divisi($id_company){
        // $query = $this->db->query("select * from tblmst_divisi where id_company='$id_company'");
        // return $query->result();        
        return json_decode($this->curl->simple_get(setAPI()."p1_get_select_divisi/".$id_company));
    }

    function get_opt_company(){
        // $query = $this->db->query("select * from tblmst_company order by  id_company asc");
        // return $query;
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_company"));
    }

    function get_opt_dept($id_company,$id_divisi){
        // $query = $this->db->query("select a.* from tblmst_departemen as a where a.id_company='$id_company' and a.id_divisi='$id_divisi' order by a.dept_abbr asc");
        // return $query->result();
        return json_decode($this->curl->simple_get(setAPI()."p1_get_select_departemen/".$id_company."/".$id_divisi));
    }

    function get_opt_bagian($id_company,$id_divisi,$id_dept){
        // $query = $this->db->query("select a.* from tblmst_bagian as a where a.id_company='$id_company' and a.id_divisi='$id_divisi' and a.id_dept='$id_dept' order by a.bagian_abbr asc");
        // return $query->result();
        return json_decode($this->curl->simple_get(setAPI()."p1_get_select_bagian/".$id_company."/".$id_divisi."/".$id_dept));
    }

    function get_alllevel(){
        $query = $this->db->query("select 
                                        *
                                    from 
                                        tblmst_leveluser 
                                    where 
                                        levelusernm not like '%Auditor%' 
                                    order by 
                                        levelusernm asc");
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    function get_level_byid($id){
        $query = $this->db->query("select 
                                    x.* 
                                from 
                                    (with 
                                        t1 as (select 
                                                * 
                                            from 
                                                tblmst_leveluser 
                                            where 
                                                levelusernm not like '%Auditor%' 
                                                and leveluserid='$id' 
                                            order by 
                                                levelusernm asc),
                                        t2 as (select 
                                                * 
                                            from 
                                                tblmst_leveluser 
                                            where 
                                                levelusernm like '%Auditor%' 
                                            order by 
                                                levelusernm asc)
                                select 
                                    t1.*, 
                                    t2.leveluserid as lvid_audit 
                                from 
                                    t1 
                                left join 
                                    t2 
                                    on trim(upper(replace(t1.levelusernm,' ',''))) = replace(trim(upper(replace(t2.levelusernm,' ',''))),'AUDITOR',''))x ");
        if ($query->num_rows() == 1){
            return $query->result();
        }
    }

    function cek_level($namalevel){
        $this->db->from($this->tabel);
        $this->db->where('levelusernm', $namalevel);
        $query = $this->db->get();
        return $query;
    }

    function get_menuakses_byid($idu){
        $this->db1->from($this->tabel2);
        $this->db1->where('leveluserid', $idu);
        $query = $this->db1->get();
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    function get_formakses_byid($idu){
        $this->db1->from($this->tabel3);
        $this->db1->where('leveluserid', $idu);
        $query = $this->db1->get();
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    function get_appakses_byid($idu){
        $this->db1->from($this->tabel4);
        $this->db1->where('leveluserid', $idu);
        $query = $this->db1->get();
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    function select_max(){
        $row = $this->db->query('SELECT MAX(leveluserid) AS maxid FROM tblmstleveluser')->row();
        if ($row){
            $maxid = $row->maxid;
        }
    }

    function insert_level($data){
        $this->db->insert($this->tabel, $data);
        return TRUE;
    }

    function insert_level_audit($data_audit){
        $this->db->insert($this->tabel, $data_audit);
        return TRUE;
    }

    function insert_allbutton($data_button){
        $this->db1->insert($this->tabel5, $data_button);
        return TRUE;
    }

    function insert_allbutton_audit($maxid, $maxid_audit){
        $query = $this->db1->query("insert into tblmstbutton_akses (leveluserid, btn_create,  btn_update,  btn_delete,  btn_delete_dh,   btn_export_pdf,  btn_export_excel,    btn_complete,    btn_restore) select '$maxid_audit', btn_create,  btn_update,  btn_delete,  btn_delete_dh,   btn_export_pdf,  btn_export_excel,    btn_complete,    btn_restore from tblmstbutton_akses where leveluserid='$maxid'");
        return TRUE;
    }

    function insert_allmenu($data_menu){
        $this->db1->insert($this->tabel2, $data_menu);
        return TRUE;
    }

    function insert_allmenu_audit($maxid, $maxid_audit){
        $query = $this->db1->query("insert into tblmstsubmenu_akses2 (leveluserid,  menuid, submenuid, submenu2id,  submenu3id) select '$maxid_audit', menuid, submenuid, submenu2id,  submenu3id from tblmstsubmenu_akses2 where leveluserid='$maxid'");
        return TRUE;
    }

     function insert_allform($data_form){
        $this->db1->insert($this->tabel3, $data_form);
        return TRUE;
    }

    function insert_allform_audit($maxid, $maxid_audit){
        $query = $this->db1->query("insert into tblmstform_akses2 ( leveluserid, formid, formjnsid, formkategoriid, formkategori2id, form_create, form_update, form_delete, form_excel ) select '$maxid_audit', formid, formjnsid, formkategoriid, formkategori2id, form_create, form_update, form_delete, form_excel from tblmstform_akses2  where leveluserid = '$maxid'");
        return TRUE;
    }

    function insert_allapp($data_app){
        $this->db1->insert($this->tabel4, $data_app);
        return TRUE;
    }

    function insert_allapp_audit($maxid, $maxid_audit){
        $query = $this->db1->query("insert into tblmstapproval_akses2 (leveluserid, formid,  app1,    app2,    app3,    app4,    app5,    app6,    app7,    app8,    app9,    app10,   formjnsid,   formkategoriid,  formkategori2id, app_ket) select '$maxid_audit', formid,  app1,    app2,    app3,    app4,    app5,    app6,    app7,    app8,    app9,    app10,   formjnsid,   formkategoriid,  formkategori2id, app_ket from tblmstapproval_akses2 where leveluserid='$maxid'");
        return TRUE;
    }

    function update_level($id, $data){
        $this->db->where('leveluserid', $id);
        $this->db->update($this->tabel, $data);
        return TRUE;
    }

    function update_level_audit($id_audit,$data_audit){
        $this->db->where('leveluserid', $id_audit);
        $this->db->update($this->tabel, $data_audit);
        return TRUE;
    }

    function update_allbutton($id,$data_button){
        $this->db1->where('leveluserid', $id);
        $this->db1->update($this->tabel5, $data_button);
        return TRUE;
    }

    function del_level($id){
        $this->db->where('leveluserid', $id);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1){
            return TRUE;
        }
        return FALSE;
    }

     function del_level_audit($id_audit){
        $this->db->where('leveluserid', $id_audit);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1){
            return TRUE;
        }
        return FALSE;
    }


    function del_allmenu($id){
        $this->db1->where('leveluserid', $id);
        $this->db1->delete($this->tabel2);
        if ($this->db1->affected_rows() == 1){
            return TRUE;
        }
        return FALSE;
    }

    function del_allmenu_audit($id_audit){
        $this->db1->where('leveluserid', $id_audit);
        $this->db1->delete($this->tabel2);
        if ($this->db1->affected_rows() == 1){
            return TRUE;
        }
        return FALSE;
    }

    function del_allform($id){
        $this->db1->where('leveluserid', $id);
        $this->db1->delete($this->tabel3);
        if ($this->db1->affected_rows() == 1){
            return TRUE;
        }
        return FALSE;
    }

    function del_allform_audit($id_audit){
        $this->db1->where('leveluserid', $id_audit);
        $this->db1->delete($this->tabel3);
        if ($this->db1->affected_rows() == 1){
            return TRUE;
        }
        return FALSE;
    }

     function del_allapp($id){
        $this->db1->where('leveluserid', $id);
        $this->db1->delete($this->tabel4);
        if ($this->db1->affected_rows() == 1){
            return TRUE;
        }
        return FALSE;
    }

    function del_allapp_audit($id_audit){
        $this->db1->where('leveluserid', $id_audit);
        $this->db1->delete($this->tabel4);
        if ($this->db1->affected_rows() == 1){
            return TRUE;
        }
        return FALSE;
    }

    function allbutton($idu){
        $this->db1->from($this->tabel5);
        $this->db1->where('leveluserid', $idu);
        $query = $this->db1->get();
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    function allmenu(){

        $this->db1->select("*");
        $this->db1->from("tblmstmenu");
        $this->db1->order_by("menuid", "asc");
        $q = $this->db1->get();

        $final = array();
        if ($q->num_rows() > 0){
            foreach ($q->result() as $row){
                $this->db1->select("*");
                $this->db1->from("tblmstsubmenu");
                $this->db1->where("menuid", $row->menuid);
                $this->db1->order_by("submenunm", "asc");
                $q2 = $this->db1->get();

                if ($q2->num_rows() > 0){
                    foreach ($q2->result() as $row2){
                        $this->db1->select("*");
                        $this->db1->from("tblmstsubmenu2");
                        $this->db1->where("submenuid", $row2->submenuid);
                        $this->db1->order_by("submenu2nm","asc");
                        $q3 = $this->db1->get();

                        if ($q3->num_rows() > 0){
                            foreach ($q3->result() as $row3){
                                    $this->db1->select("*");
                                    $this->db1->from("tblmstsubmenu3");
                                    $this->db1->where("submenu2id", $row3->submenu2id);
                                    $this->db1->order_by("submenu3nm","asc");
                                    $q4 = $this->db1->get();
                                    if ($q4->num_rows() > 0){
                                        $row3->children3 = $q4->result();
                                    }
                            }
                             $row2->children2 = $q3->result();

                        }
                    }
                   $row->children = $q2->result();
                }

                array_push($final, $row);
            }
        }
        return $final;
    }

    function allform(){
        $this->db1->select("submenuid as formjnsid, submenunm as formjnsnm");
        $this->db1->from("tblmstsubmenu");
        $this->db1->where("menuid", '2');
        $q     = $this->db1->get();
        $final = array();
        if ($q->num_rows() > 0){
            foreach ($q->result() as $row){
                $this->db1->select("submenu2id as formkategoriid, submenu2nm as formkategorinm");
                $this->db1->from("tblmstsubmenu2");
                $this->db1->where("submenuid", $row->formjnsid);
                $q2 = $this->db1->get();

                if ($q2->num_rows() > 0){
                    foreach ($q2->result() as $row2){
                        $this->db1->select("submenu3id as formkategori2id, submenu3nm as formkategori2nm");
                        $this->db1->from("tblmstsubmenu3");
                        $this->db1->where("submenu2id", $row2->formkategoriid);
                        $q3 = $this->db1->get();
                        if ($q3->num_rows() > 0){
                            foreach ($q3->result() as $row3){
                                $this->db1->select("*");
                                $this->db1->from("tblmstformnew");
                                $this->db1->where("formkategori2id", $row3->formkategori2id);
                                $this->db1->order_by("formnm", "asc");
                                $this->db1->order_by("formid", "asc");
                                $q4 = $this->db1->get();
                                if ($q4->num_rows() > 0){
                                    $row3->children3 = $q4->result();
                                }
                            }
                            $row2->children2 = $q3->result();
                        }else{
                            $q5 = $this->db1->query("select * from tblmstformnew where formjnsid ='$row->formjnsid' and formkategoriid='$row2->formkategoriid' and formkategori2id IS NULL order by formnm asc, formid asc");
                            if ($q5->num_rows() > 0){
                                    $row2->children4 = $q5->result();
                                }
                        }
                    }
                    $row->children = $q2->result();
                }else{
                    $q6 = $this->db1->query("select * from tblmstformnew where formjnsid ='$row->formjnsid' and formkategoriid IS NULL and formkategori2id IS NULL order by formnm asc, formid asc");
                       if ($q6->num_rows() > 0){
                          $row->children5 = $q6->result();
                       }
                }

                array_push($final, $row);
            }
        }
        return $final;
    }

    function allapp(){
        $this->db1->select("submenuid as formjnsid, submenunm as formjnsnm");
        $this->db1->from("tblmstsubmenu");
        $this->db1->where("menuid", '2');
        $q     = $this->db1->get();
        
        $final = array();
        if ($q->num_rows() > 0){
            foreach ($q->result() as $row){
                $JenisID = $this->db1->select("submenu2id as formkategoriid, submenu2nm as formkategorinm");
                $this->db1->from("tblmstsubmenu2");
                $this->db1->where("submenuid", $row->formjnsid);
                $q2 = $this->db1->get();
                if ($q2->num_rows() > 0){
                    foreach ($q2->result() as $row2){
                        $this->db1->select("submenu3id as formkategori2id, submenu3nm as formkategori2nm");
                        $this->db1->from("tblmstsubmenu3");
                        $this->db1->where("submenu2id", $row2->formkategoriid);
                        $q3 = $this->db1->get();
                        if ($q3->num_rows() > 0){
                            foreach ($q3->result() as $row3){
                                $this->db1->select("*");
                                $this->db1->from("tblmstformnew");
                                $this->db1->where("formkategori2id", $row3->formkategori2id);
                                $this->db1->where("status_app", '1');
                                $this->db1->order_by("formid", "asc");
                                $q4 = $this->db1->get();
                                if ($q4->num_rows() > 0){
                                    $row3->children3 = $q4->result();
                                }
                            }
                            $row2->children2 = $q3->result();
                        }else{
                            $q5 = $this->db1->query("select * from tblmstformnew where formjnsid ='$row->formjnsid' and formkategoriid='$row2->formkategoriid' and formkategori2id IS NULL and status_app='1' order by formnm asc, formid asc");
                            if ($q5->num_rows() > 0){
                                $row2->children4 = $q5->result();
                            }
                        }
                    }
                    $row->children = $q2->result();
                }else{
                    $q6 = $this->db1->query("select * from tblmstformnew where formjnsid ='$row->formjnsid' and formkategoriid IS NULL and formkategori2id IS NULL and status_app='1' order by formnm asc, formid asc");
                    if ($q6->num_rows() > 0){
                      $row->children5 = $q6->result();
                    }
                }

                array_push($final, $row);
            }
        }
        return $final;
    }

    function allmenu2($idu){
        $this->db1->select("*");
        $this->db1->from("tblmstmenu");
        $this->db1->order_by("menuid", "asc");
        $q     = $this->db1->get();
        
        $final = array();
        if ($q->num_rows() > 0){
            foreach ($q->result() as $row){
                $this->db1->select("*");
                $this->db1->from("tblmstsubmenu");
                $this->db1->where("menuid", $row->menuid);
                $this->db1->order_by("submenunm", "asc");
                $q2   = $this->db1->get();
                
                $test = $this->db1->query("SELECT DISTINCT(menuid) FROM tblmstsubmenu_akses2 WHERE menuid='$row->menuid' AND leveluserid='$idu'");
                if ($q2->num_rows() > 0){
                    foreach ($q2->result() as $row2){
                        $this->db1->select("*");
                        $this->db1->from("tblmstsubmenu2");
                        $this->db1->where("submenuid", $row2->submenuid);
                        $this->db1->order_by("submenu2nm","asc");
                        $q3 = $this->db1->get();

                        $test2 = $this->db1->query("SELECT DISTINCT(submenuid) FROM tblmstsubmenu_akses2 WHERE submenuid='$row2->submenuid' AND leveluserid='$idu'");
                        if ($q3->num_rows() > 0){
                            foreach ($q3->result() as $row3){
                                    $this->db1->select("*");
                                    $this->db1->from("tblmstsubmenu3");
                                    $this->db1->where("submenu2id", $row3->submenu2id);
                                    $this->db1->order_by("submenu3nm","asc");
                                    $q4 = $this->db1->get();

                                    $test3 = $this->db1->query("SELECT DISTINCT(submenu2id) FROM tblmstsubmenu_akses2 WHERE submenuid='$row2->submenuid' AND submenu2id='$row3->submenu2id' AND leveluserid='$idu'");
                                    if ($q4->num_rows() > 0){
                                        $row3->children3 = $q4->result();
                                        foreach ($q4->result() as $row4){
                                            $test4 = $this->db1->query("SELECT DISTINCT(submenu3id) FROM tblmstsubmenu_akses2 WHERE submenuid='$row2->submenuid' AND submenu2id='$row3->submenu2id' AND submenu3id='$row4->submenu3id' AND leveluserid='$idu'");
                                            $row4->children_byid4 = $test4->result();
                                        }
                                    }
                                $row3->children_byid3 = $test3->result();
                            }
                            $row2->children2 = $q3->result();

                        }
                        $row2->children_byid2 = $test2->result();
                    }
                    $row->children = $q2->result();

                }
                $row->children_byid1 = $test->result();
                array_push($final, $row);
            }
        }
        return $final;
    }

    function allform2($idu){
        $this->db1->select("submenuid as formjnsid, submenunm as formjnsnm");
        $this->db1->from("tblmstsubmenu");
        $this->db1->where("menuid", '2');
        $q     = $this->db1->get();
        $final = array();
        if ($q->num_rows() > 0){
            foreach ($q->result() as $row){
                $this->db1->select("submenu2id as formkategoriid, submenu2nm as formkategorinm");
                $this->db1->from("tblmstsubmenu2");
                $this->db1->where("submenuid", $row->formjnsid);
                $q2        = $this->db1->get();
                
                $get_form1 = $this->db1->query("SELECT DISTINCT(formjnsid) FROM tblmstform_akses2 WHERE formjnsid='$row->formjnsid' AND leveluserid='$idu'");
                if ($q2->num_rows() > 0){
                    foreach ($q2->result() as $row2){
                        $this->db1->select("submenu3id as formkategori2id, submenu3nm as formkategori2nm");
                        $this->db1->from("tblmstsubmenu3");
                        $this->db1->where("submenu2id", $row2->formkategoriid);
                        $q3 = $this->db1->get();

                        $get_form2 = $this->db1->query("SELECT DISTINCT(formkategoriid) FROM tblmstform_akses2 WHERE formkategoriid='$row2->formkategoriid' AND formjnsid='$row->formjnsid' AND leveluserid='$idu'");
                        if ($q3->num_rows() > 0){
                            foreach ($q3->result() as $row3){
                                $this->db1->select("*");
                                $this->db1->from("tblmstformnew");
                                $this->db1->where("formkategori2id", $row3->formkategori2id);
                                $this->db1->order_by("formnm", "asc");
                                $this->db1->order_by("formid", "asc");
                                $q4 = $this->db1->get();

                                $get_form3 = $this->db1->query("SELECT DISTINCT(formkategori2id) FROM tblmstform_akses2 WHERE formkategori2id='$row3->formkategori2id' AND formkategoriid='$row2->formkategoriid' AND formjnsid='$row->formjnsid' AND leveluserid='$idu'");
                                if ($q4->num_rows() > 0){
                                    $row3->children3 = $q4->result();
                                    foreach ($q4->result() as $row4){
                                            $get_form4 = $this->db1->query("SELECT DISTINCT(formid),form_create, form_update, form_delete, form_excel FROM tblmstform_akses2 WHERE formid='$row4->formid' AND formkategori2id='$row3->formkategori2id' AND formkategoriid='$row2->formkategoriid' AND formjnsid='$row->formjnsid' AND leveluserid='$idu'");
                                            $row4->form_byid4 = $get_form4->result();
                                        }
                                }
                                $row3->form_byid3 = $get_form3->result();
                            }
                            $row2->children2 = $q3->result();
                        }else{
                            $q5 = $this->db1->query("select * from tblmstformnew where formjnsid ='$row->formjnsid' and formkategoriid='$row2->formkategoriid' and formkategori2id IS NULL order by formnm asc, formid asc");
                            if ($q5->num_rows() > 0){
                                    $row2->children4 = $q5->result();
                                    foreach ($q5->result() as $row5){
                                        $get_form5 = $this->db1->query("SELECT DISTINCT(formid),form_create, form_update, form_delete, form_excel FROM tblmstform_akses2 WHERE formjnsid='$row5->formjnsid' and formkategoriid='$row5->formkategoriid' and formkategori2id IS NULL AND formid='$row5->formid' AND leveluserid='$idu'");
                                        $row5->form_byid5 = $get_form5->result();
                                    }
                                }
                        }
                        $row->form_byid2 = $get_form2->result();
                    }
                    $row->children = $q2->result();
                }else{
                    $q6 = $this->db1->query("select * from tblmstformnew where formjnsid ='$row->formjnsid' and formkategoriid IS NULL and formkategori2id IS NULL order by formnm asc, formid asc");

                       if ($q6->num_rows() > 0){
                          $row->children5 = $q6->result();
                          foreach ($q6->result() as $row6){
                                $get_form6 = $this->db1->query("SELECT DISTINCT(formjnsid) FROM tblmstform_akses2 WHERE formjnsid='$row6->formjnsid' and formkategoriid IS NULL and formkategori2id IS NULL AND leveluserid='$idu'");
                                    $row->form_byid6 = $get_form6->result();
                                $get_form7 = $this->db1->query("SELECT DISTINCT(formid),form_create, form_update, form_delete, form_excel FROM tblmstform_akses2 WHERE formjnsid='$row6->formjnsid' and formkategoriid IS NULL and formkategori2id IS NULL AND leveluserid='$idu' AND formid='$row6->formid'");
                                    $row6->form_byid7 = $get_form7->result();
                                
                            }
                       }
                }
                $row->form_byid1 = $get_form1->result();
                array_push($final, $row);
            }
        }
        return $final;
    }

    function allapp2($idu){
        $this->db1->select("submenuid as formjnsid, submenunm as formjnsnm");
        $this->db1->from("tblmstsubmenu");
        $this->db1->where("menuid", '2');
        $q     = $this->db1->get();
        
        $final = array();
        if ($q->num_rows() > 0){
            foreach ($q->result() as $row){
                $JenisID = $this->db1->select("submenu2id as formkategoriid, submenu2nm as formkategorinm");
                $this->db1->from("tblmstsubmenu2");
                $this->db1->where("submenuid", $row->formjnsid);
                $q2 = $this->db1->get();
                $get_app1 = $this->db1->query("SELECT DISTINCT(formjnsid) FROM tblmstapproval_akses2 WHERE formjnsid='$row->formjnsid' AND leveluserid='$idu'");
                if ($q2->num_rows() > 0){
                    foreach ($q2->result() as $row2){
                        $this->db1->select("submenu3id as formkategori2id, submenu3nm as formkategori2nm");
                        $this->db1->from("tblmstsubmenu3");
                        $this->db1->where("submenu2id", $row2->formkategoriid);
                        $q3 = $this->db1->get();

                        $get_app2 = $this->db1->query("SELECT DISTINCT(appid) FROM tblmstapproval_akses2 WHERE formkategoriid='$row2->formkategoriid' AND formjnsid='$row->formjnsid' AND leveluserid='$idu'");
                        if ($q3->num_rows() > 0){
                            foreach ($q3->result() as $row3){
                                $this->db1->select("*");
                                $this->db1->from("tblmstformnew");
                                $this->db1->where("formkategori2id", $row3->formkategori2id);
                                $this->db1->where("status_app", '1');
                                $this->db1->order_by("formnm", "asc");
                                $this->db1->order_by("formid", "asc");
                                $q4 = $this->db1->get();

                                $get_app3 = $this->db1->query("SELECT DISTINCT(appid) FROM tblmstapproval_akses2 WHERE formkategori2id='$row3->formkategori2id' AND formkategoriid='$row2->formkategoriid' AND formjnsid='$row->formjnsid' AND leveluserid='$idu'");
                                if ($q4->num_rows() > 0){
                                    $row3->children3 = $q4->result();
                                    foreach ($q4->result() as $row4){
                                            $get_app4 = $this->db1->query("SELECT * FROM tblmstapproval_akses2 WHERE formid='$row4->formid' AND formkategori2id='$row3->formkategori2id' AND formkategoriid='$row2->formkategoriid' AND formjnsid='$row->formjnsid' AND leveluserid='$idu'");
                                            $row4->app_byid4 = $get_app4->result();
                                        }
                                }
                                $row3->app_byid3 = $get_app3->result();
                            }
                            $row2->children2 = $q3->result();
                        }else{
                            $q5 = $this->db1->query("select * from tblmstformnew where formjnsid ='$row->formjnsid' and formkategoriid='$row2->formkategoriid' and formkategori2id IS NULL and status_app='1' order by formnm asc, formid asc");
                            if ($q5->num_rows() > 0){
                                    $row2->children4 = $q5->result();
                                    foreach ($q5->result() as $row5){
                                        $get_app5 = $this->db1->query("SELECT DISTINCT(formid),app1, app2, app3, app4, app5, app6, app7, app8, app9, app10 FROM tblmstapproval_akses2 WHERE formid='$row5->formid' and formjnsid='$row5->formjnsid' and formkategoriid='$row5->formkategoriid' and formkategori2id IS NULL AND leveluserid='$idu' group by formid, app1, app2, app3, app4, app5, app6, app7, app8, app9, app10");
                                        $row5->app_byid5 = $get_app5->result();
                                    }
                                }
                        }
                        $row->app_byid2 = $get_app2->result();
                    }
                    $row->children = $q2->result();
                }else{
                    $q6 = $this->db1->query("select * from tblmstformnew where formjnsid ='$row->formjnsid' and formkategoriid IS NULL and formkategori2id IS NULL and status_app='1' order by formnm asc, formid asc");
                    if ($q6->num_rows() > 0){
                        $row->children5 = $q6->result();
                        foreach ($q6->result() as $row6){
                            $get_app7 = $this->db1->query("SELECT DISTINCT(formid) ,app1, app2, app3, app4, app5, app6, app7, app8, app9, app10 FROM tblmstapproval_akses2 WHERE formjnsid='$row6->formjnsid' and formkategoriid IS NULL and formkategori2id IS NULL AND leveluserid='$idu' AND formid='$row6->formid' group by formid, app1, app2, app3, app4, app5, app6, app7, app8, app9, app10");
                                $row6->app_byid7 = $get_app7->result();
                        }
                    }
                }
                $row->app_byid1 = $get_app1->result();
                array_push($final, $row);
            }
        }
        return $final;
    }

}