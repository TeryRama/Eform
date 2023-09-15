<?php

class M_daftar_form extends CI_Model {

    var $tabel = 'tblmstleveluser'; //variabel tabel
     var $tabel2 = 'tblmstsubmenu_akses2'; //variabel tabel
     var $tabel3 = 'tblmstform_akses2'; //variabel tabel
     var $tabel4 = 'tblmstapproval_akses2'; //variabel tabel
     var $tabel5 = 'tblmstbutton_akses'; //variabel tabel

    function __construct() {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

    function get_daftar_form(){
        $this->db1->distinct();
        $this->db1->select("formjnsnm");
        $this->db1->from("vwmst_form");
        $this->db1->order_by("formjnsnm", "asc");
        $q = $this->db1->get();

        $final = array();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $this->db1->distinct();
                $this->db1->select("formkategorinm");
                $this->db1->from("vwmst_form");
                $this->db1->where("formjnsnm", $row->formjnsnm);
                $this->db1->order_by("formkategorinm", "asc");
                $q2 = $this->db1->get();

                if ($q2->num_rows() > 0) {
                    foreach ($q2->result() as $row2) {
                        $this->db1->distinct();
                        $this->db1->select("formkategori2nm");
                        $this->db1->from("vwmst_form");
                        $this->db1->where("formjnsnm", $row->formjnsnm);
                        $this->db1->where("formkategorinm", $row2->formkategorinm);
                        $this->db1->order_by("formkategori2nm", "asc");
                        $q3 = $this->db1->get();

                        if ($q3->num_rows() > 0) {
                            foreach ($q3->result() as $row3) {
                                $q4 = $this->db1->query("select distinct(formkd), formnm ,max(formjudul) as formjudul,
                                                        array_to_string(array(
                                                            select distinct(trim(formversi)) as formversi
                                                            from vwmst_form
                                                            where formkd = h.formkd
                                                            order by formversi asc
                                                            ), ' , '
                                                        ) formversi,  max(formstatus) as formstatus, status_input, status_lap, status_dataharian, status_lap, status_app, max(formket) as formket
                                                    from vwmst_form h where h.formjnsnm = '".$row->formjnsnm."'
                                                    group by formkd, formnm, formjudul, status_input, status_lap, status_dataharian, status_lap, status_app, formket, formstatus
                                                    order by formkd asc");

                                     $row3->children3 = $q4->result();
                            }
                        }else{
                        	/*===== GET DATA FORM BY FORMJNSNM & FORMKATEGORINM ONLY =====*/
                        			$q5 = $this->db1->query("select distinct(formkd), formnm ,max(formjudul) as formjudul,
                                                        array_to_string(array(
                                                            select distinct(trim(formversi)) as formversi
                                                            from vwmst_form
                                                            where formkd = h.formkd
                                                            order by formversi asc
                                                            ), ' , '
                                                        ) formversi,  max(formstatus) as formstatus, status_input, status_lap, status_dataharian, status_lap, status_app, max(formket) as formket
                                                    from vwmst_form h where h.formjnsnm = '".$row->formjnsnm."' and h.formkategorinm = '".$row2->formkategorinm."' and h.formkategori2nm is null
                                                    group by formkd, formnm, formjudul, status_input, status_lap, status_dataharian, status_lap, status_app, formket, formstatus
                                                    order by formkd asc");

                                     $row2->children4 = $q5->result();
                        }
                        $row2->children2 = $q3->result();
                    }
                   $row->children = $q2->result();
                }else{
                	/*===== GET DATA FORM BY FORMJNSNM ONLY =====*/
                			$q6 = $this->db1->query("select distinct(formkd), formnm ,max(formjudul) as formjudul,
                                                        array_to_string(array(
                                                            select distinct(trim(formversi)) as formversi
                                                            from vwmst_form
                                                            where formkd = h.formkd
                                                            order by formversi asc
                                                            ), ' , '
                                                        ) formversi,  max(formstatus) as formstatus, status_input, status_lap, status_dataharian, status_lap, status_app, max(formket) as formket
                                                    from vwmst_form h where h.formjnsnm = '".$row->formjnsnm."' and h.formkategorinm is null and h.formkategori2nm is null
                                                    group by formkd, formnm, formjudul, status_input, status_lap, status_dataharian, status_lap, status_app, formket, formstatus
                                                    order by formkd asc");
                            
                			$row->children5 = $q6->result();
                }
                
                array_push($final, $row);
            }
        }else{
        	/*===== NO ACITIVITY =====*/
        }

        return $final;
    }



}