<?php

class C_changepsw extends CI_Controller {
	
	var $data = array();
	
	function __construct() {
		
		parent :: __construct();

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		
		$this->load->model(array('M_menu','M_user','master/M_changepsw'));
	}
	
	function index() {
            if($this->session->userdata('logged_in')) {
            $session_data 			= $this->session->userdata('logged_in');
            $data['username']                   = $session_data['username'];
            $data['password']                   = $session_data['password'];
            $data['jabid'] 			= $session_data['jabid'];
            $data['leveluserid']                = $session_data['leveluserid'];
            $data['nmdepan']                    = $session_data['nmdepan'];
            $data['levelusernm']                = $session_data['levelusernm'];
            $data['bagnm']                      = $session_data['bagnm'];
            $data['jabnm']                      = $session_data['jabnm'];
            $data['Titel'] = 'Home';
            
            $LevelUser = $session_data['leveluserid'];
            $UserName = $session_data['username'];
            $LevelUserNm = $session_data['levelusernm'];

            $cekLevelUserNm = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $dtuser = $this->M_changepsw->get_dtuser($UserName);
            $data3 = array('dtuser' => $dtuser);

	    $this->load->view('master/V_changepsw', array_merge($data, $data2, $data3));

		} else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
		}		
	}

	function change() {
        $session_data                       = $this->session->userdata('logged_in');
        $data['username']                   = $session_data['username'];
        $data['password']                   = $session_data['password'];
        $data['jabid']                      = $session_data['jabid'];
        $data['leveluserid']                = $session_data['leveluserid'];
        $data['nmdepan']                    = $session_data['nmdepan'];
        $data['levelusernm']                = $session_data['levelusernm'];
        $data['bagnm']                      = $session_data['bagnm'];
        $data['jabnm']                      = $session_data['jabnm'];
        $data['Titel'] = 'Home';
        
        $LevelUser = $session_data['leveluserid'];
        $UserName = $session_data['username'];
        $LevelUserNm = $session_data['levelusernm'];

        $cekLevelUserNm = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);

        $menus = $this->M_menu->menus($LevelUser);
        $data2 = array('menus' => $menus);
            
        //ambil variabel dari form
        $id                             = trim($this->input->post('dtuserid'));
        $dtoldusername          	= addslashes(strtoupper($this->input->post('dtoldusername')));
        $dtusername          		= addslashes(strtoupper($this->input->post('dtusername')));
        $dtoldpass                      = addslashes(strtoupper($this->input->post('dtoldpass')));
        $dtpass                         = addslashes(strtoupper($this->input->post('dtpass')));

        $check = $this->M_changepsw->check_dtuser($id,$dtusername);
        if($check->num_rows() > 0 ){
            $data['message'] = 'Data dengan username : <b>'.$dtusername.'</b> sudah ada silahkan ganti dengan yang lain!';
             $this->load->view('master/V_changepsw', array_merge($data,$data2));
        }else{
            if($dtpass==""){
            $data3 = array(
            'username'       => $dtusername,
            'password'       => $dtoldpass,
            'last_update_password' => date('Y-m-d')
            );}else{
             $data3 = array(
            'username'       => $dtusername,
            'password'       => $dtpass,
            'last_update_password' => date('Y-m-d')
             );
            }
            $this->M_changepsw->update_dtuser($id, $data3); //modal update data barang
            echo "<script>alert('Data berhasil diubah....!!!! ');</script>";

            $this->load->view('V_home', array_merge($data, $data2));
        }
   }
}
?>