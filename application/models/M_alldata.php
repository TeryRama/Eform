<?php

class M_alldata extends CI_Model {
    function __construct()
  {
    parent::__construct();
    $CI = &get_instance();
    $this->db1 = $this->load->database('db1',TRUE);
  }



  function get_forminput_by($LevelUser,$frm_jnsid,$frm_kategoriid,$frm_kategori2id) {

       $this->db1->select('*');
        $this->db1->from('tblmstformnew');
        $this->db1->where("formid IN", "(SELECT DISTINCT formid from tblmstform_akses2 where leveluserid=" .$LevelUser. " AND formjnsid " .$frm_jnsid. " AND formkategoriid " .$frm_kategoriid. " AND formkategori2id " .$frm_kategori2id. ")", false);
        $this->db1->where("status_input",'1');
        $this->db1->where("formstatus",'1');
        $this->db1->order_by("formkd","asc");
        $this->db1->order_by("formversi","asc");
        $query=$this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_formdata_by($LevelUser,$frm_jnsid,$frm_kategoriid,$frm_kategori2id) {

       $this->db1->select('*');
        $this->db1->from('tblmstformnew');
        $this->db1->where("formid IN", "(SELECT DISTINCT formid from tblmstform_akses2 where leveluserid=" .$LevelUser. " AND formjnsid " .$frm_jnsid. " AND formkategoriid " .$frm_kategoriid. " AND formkategori2id " .$frm_kategori2id. ")", false);
        $this->db1->where("status_dataharian",'1');
        $this->db1->where("formstatus",'1');
        $this->db1->order_by("formkd","asc");
        $this->db1->order_by("formversi","asc");
        $query=$this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_formlap_by($LevelUser,$frm_jnsid,$frm_kategoriid,$frm_kategori2id) {

       $this->db1->select('*');
        $this->db1->from('tblmstformnew');
        $this->db1->where("formid IN", "(SELECT DISTINCT formid from tblmstform_akses2 where leveluserid=" .$LevelUser. " AND formjnsid " .$frm_jnsid. " AND formkategoriid " .$frm_kategoriid. " AND formkategori2id " .$frm_kategori2id. ")", false);
        // $this->db1->where("formstatus",'1');
        $this->db1->where("(formstatus='1' OR formstatus='2')");
        $this->db1->order_by("formkd","asc");
        $this->db1->order_by("formversi","asc");
        $query=$this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_app_by($LevelUser,$frm_jnsid) {

       $this->db1->select('*');
        $this->db1->from('tblmstformnew');
        $this->db1->where("formid IN", "(SELECT DISTINCT formid from tblmstform_akses2 where leveluserid=" .$LevelUser. " AND formjnsid " .$frm_jnsid. ")", false);
        $this->db1->where('status_app','1');
        $this->db1->where("formstatus",'1');
        $this->db1->order_by("formkd","asc");
        $this->db1->order_by("formversi","asc");
        $query=$this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_frmjenis($frmjnsnm){
        $this->db1->select('formjnsid');
        $this->db1->from('tblmstformjenis');
        $this->db1->like('formjnsnm',$frmjnsnm);
        $query=$this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
}