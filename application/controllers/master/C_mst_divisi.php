<?php
class C_mst_divisi extends  CI_Controller {
    function  __construct(){
		parent:: __construct();
		$this->load->helper('form','url');
		$this->load->model(array('M_menu','master/M_mst_divisi'));
	}

    function index() {
        if($this->session->userdata('logged_in')) {
            $session_data           = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['Titel']          = 'Master - Divisi';
            
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            
            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $dt_divisi              = $this->M_mst_divisi->get_records_payroll();
            $data3                  = array('dt_divisi' => $dt_divisi);
            
            $this->load->view('master/V_mst_divisi', array_merge($data, $data2, $data3));

		} else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
	}
} ?>
