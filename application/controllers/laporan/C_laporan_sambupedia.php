<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_laporan_sambupedia extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('table','form_validation'));
        $this->load->helper('form');
    }

    function index(){
        $form_kode          = $this->input->get('form_kode');
        $form_versi         = $this->input->get('form_versi');
        $user_id            = $this->input->get('user_id');

        $this->session->unset_userdata('logged_in');

        $dt_user_sambupedia = json_decode($this->curl->simple_get(setAPI_sambupedia()."es_data_byid/sp_user/$user_id"));

        if(!empty($dt_user_sambupedia) && file_exists(APPPATH."models/form_input/M_form".$form_kode."_".$form_versi.".php")){
            $sess_array         = array(
                'userid'           => $dt_user_sambupedia->id_company.$dt_user_sambupedia->personalstatus.$dt_user_sambupedia->personalid,
                'username'         => $dt_user_sambupedia->nama,
                'password'         => $dt_user_sambupedia->personalid,
                'leveluserid'      => 619,
                'levelusernm'      => 'Auditor LIMITED ACCESS FROM SAMBUPEDIA APP',
                
                'companyid'        => $dt_user_sambupedia->psg_pekerja->id_company,
                'companynm'        => $dt_user_sambupedia->psg_pekerja->company_abbr,
                'divisiid'         => $dt_user_sambupedia->psg_pekerja->id_divisi,
                'divisinm'         => $dt_user_sambupedia->psg_pekerja->divisi_abbr,
                'deptid'           => $dt_user_sambupedia->psg_pekerja->id_dept,
                'deptnm'           => $dt_user_sambupedia->psg_pekerja->dept_abbr,
                'bagid'            => $dt_user_sambupedia->psg_pekerja->id_bagian,
                'bagnm'            => $dt_user_sambupedia->psg_pekerja->bagian_abbr,
                'jabid'            => $dt_user_sambupedia->psg_pekerja->id_jabatan,
                'jabnm'            => $dt_user_sambupedia->psg_pekerja->jabatan_nama,

                'nmdepan'          => $dt_user_sambupedia->nama,
                'nmlengkap'        => $dt_user_sambupedia->psg_pekerja->nama,
                'bagian_akses'     => '',
                'ori_akses'        => 0,
                'audit_akses'      => 1,
                'on_audit'         => 1,
                'status_password'  => 'Password Ok',
                'personalid'       => $dt_user_sambupedia->personalstatus,
                'personalstatus'   => $dt_user_sambupedia->personalid,

                'akses_sambupedia' => 1,
            );

            $this->session->set_userdata('logged_in', $sess_array);

            redirect('laporan/C_laporan/openlap/'.$form_kode.'/'.$form_versi, 'refresh');
        }else{
            $this->sambupedia_not_found();
        }
    }
    
    function sambupedia_not_found()
    {
        $this->load->view('sambupedianotfound');
    } 
}