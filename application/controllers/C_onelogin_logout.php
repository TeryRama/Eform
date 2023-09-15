<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_onelogin_logout extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_menu', 'M_user', 'M_home', 'tambahan/lain_lain/M_jadwal_audit'));
    }

    function index()
    {
        $session_data = $this->session->userdata('logged_in');
        $username = $session_data['username'];
        $logdate = date("Y-m-d");
        $this->M_user->simpan_log_out($username, $logdate);
        $this->session->unset_userdata('logged_in');
        session_destroy();

        $this->load->view('errors/html/logout');

        // echo '<div align="center" style="width:100%;background-color:#F08519;"><img height="100%" src="' . base_url() . '/assets/out.png" alt=""></div>';
        // exit();
    }

    public function out()
    {
        $this->load->view('errors/html/logout');
    }

    function invalidaccess()
    {
        session_destroy();
        $this->load->view('errors/html/invalid');
        // echo '<div align="center" style="width:100%;background-color:#F08519;"><img height="100%" src="'.base_url().'/assets/403.png" alt=""></div>'; 
        // exit();
    }
}
