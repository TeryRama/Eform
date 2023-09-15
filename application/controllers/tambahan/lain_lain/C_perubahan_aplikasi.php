<?php

class C_perubahan_aplikasi extends CI_Controller {

	var $data = array();

	function __construct() {

		parent :: __construct();

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');

		$this->load->model(array('M_menu','tambahan/lain_lain/M_perubahan_aplikasi'));

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

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            $Bagian                 = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $permintaan      = $this->M_perubahan_aplikasi->get_permintaan();
            $data_permintaan = array('permintaan' => $permintaan);

            $this->load->view('tambahan/lain_lain/V_perubahan_aplikasi', array_merge($data, $data2, $data_permintaan));

        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }
}
?>