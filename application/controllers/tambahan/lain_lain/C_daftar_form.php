<?php

class C_daftar_form extends CI_Controller {

	var $data = array();

	function __construct() {

		parent :: __construct();

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');

		$this->load->model(array('M_menu','tambahan/lain_lain/M_daftar_form'));
	}

	function index() {
		if($this->session->userdata('logged_in')) {
            $session_data 			= $this->session->userdata('logged_in');
            $data['username'] 		= $session_data['username'];
            $data['password'] 		= $session_data['password'];
            $data['jabid'] 			= $session_data['jabid'];
            $data['leveluserid'] 	= $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            $Bagian 	            = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $daftar_form = $this->M_daftar_form->get_daftar_form();
            $data3 = array('daftar_form' => $daftar_form);

			$this->load->view('tambahan/lain_lain/V_daftar_form', array_merge($data, $data2, $data3));

		} else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
		}
	}

	function form() {
        $session_data		     = $this->session->userdata('logged_in');
        $data['username']		 = $session_data['username'];
        $data['password']		 = $session_data['password'];
        $data['jabid'] 		     = $session_data['jabid'];
        $data['leveluserid'] 	 = $session_data['leveluserid'];
        $data['nmdepan'] = $session_data['nmdepan'];
        $data['levelusernm'] = $session_data['levelusernm'];
        $data['bagnm'] = $session_data['bagnm'];
        $data['jabnm'] = $session_data['jabnm'];


        $LevelUser = $session_data['leveluserid'];
        $UserName = $session_data['username'];
        $LevelUserNm = $session_data['levelusernm'];

        $cekLevelUserNm = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        $Bagian 	= $session_data['bagnm'];

        $menus = $this->M_menu->menus($LevelUser);
        $data2 = array('menus' => $menus);

        //ambil variabel URL
        $mau_ke                 = $this->uri->segment(5);
        $idu                    = $this->uri->segment(6);

        //ambil variabel dari form
        $id                     = addslashes($this->input->post('userid'));
        $kode                   = addslashes($this->input->post('userid'));
        $nomornik          		= addslashes($this->input->post('nik'));
        $namadepan              = addslashes(strtoupper($this->input->post('nmdepan')));
        $namalengkap            = addslashes(strtoupper($this->input->post('nmlengkap')));
        $username          		= addslashes(strtoupper($this->input->post('username')));
        $password          		= addslashes($this->input->post('password'));
        $leveluserid            = addslashes($this->input->post('leveluserid'));
        $jabid          		= addslashes($this->input->post('jabid'));
        $bagid          		= addslashes($this->input->post('bagid'));

        switch($Bagian){
                    case $Bagian=='ITD':
                        $dtbag_level = "";
                    break;
                    case $Bagian=='QAD':
                        $dtbag_level = "WHERE levelusernm NOT LIKE '%Administrator%'";
                    break;
                    case $Bagian=='QAD MONITORING':
                        $dtbag_level = "WHERE levelusernm LIKE '%MONITORING%'";
                    break;
                    case $Bagian=='QAD LAB KIMIA':
                        $dtbag_level = "WHERE levelusernm LIKE '%CHE%'";
                    break;
                    case $Bagian=='QAD LAB MIKRO':
                        $dtbag_level = "WHERE levelusernm LIKE '%MIC%'";
                    break;
                    case $Bagian=='QAD CALIBRASI':
                        $dtbag_level = "WHERE levelusernm LIKE '%CAL%'";
                    break;
                    case $Bagian=='QAD MONITORING RM' || $Bagian=='QAD MONITORING WP' || $Bagian=='QAD MONITORING DP':
                        $dtbag_level = "WHERE levelusernm LIKE '%RMM%' OR levelusernm LIKE '%WPM%' OR levelusernm LIKE '%DPM%'";
                    break;
                    default:
                        $dtbag_level = "WHERE levelusernm LIKE '%".$Bagian."%'";
                    break;
                }

        switch($Bagian){
                    case $Bagian=='ITD':
                        $dtbag2 = "";
                        $dtbag3 = "";
                    break;
                    case $Bagian=='QAD MONITORING RM' || $Bagian=='QAD MONITORING WP' || $Bagian=='QAD MONITORING DP':
                       $dtbag2 = "AND b.bagnm like '%WP%' OR b.bagnm like '%RM%' OR b.bagnm like '%DP%'";
                        $dtbag3 = "WHERE bagnm like '%WP%' OR bagnm like '%RM%' OR bagnm like '%DP%'";
                    break;
                    default:
                        $dtbag2 = "AND b.bagnm like '%".$Bagian."%'";
                        $dtbag3 = "WHERE bagnm like '%".$Bagian."%'";
                    break;
                }

	   //mengarahkan fungsi form sesuai dengan uri segmentnya
        if ($mau_ke == "add") {			//jika uri segmentnya add
            $data4['aksi'] = 'aksi_add';

            $dtlevel = $this->M_menu_user->get_alllevel($dtbag_level);
            $data7 = array('dtlevel' => $dtlevel);

            $dtjab = $this->M_menu_user->get_alljab($dtbag2);
            $data8 = array('dtjab' => $dtjab);

            $dtbag = $this->M_menu_user->get_allbag($dtbag3);
            $data9 = array('dtbag' => $dtbag);

            $this->load->view('master/user/V_menu_form_user', array_merge($data,$data2,$data4,$data7,$data8,$data9));

        } else if ($mau_ke == "edit") {			//jika uri segmentnya edit
            $data5['dtuser']    = $this->M_menu_user->get_user_byid($idu);
            $data6['aksi']      = 'aksi_edit';

            $dtlevel = $this->M_menu_user->get_alllevel($dtbag_level);
            $data7 = array('dtlevel' => $dtlevel);

            $dtjab = $this->M_menu_user->get_alljab($dtbag2);
            $data8 = array('dtjab' => $dtjab);

            $dtbag = $this->M_menu_user->get_allbag($dtbag3);
            $data9 = array('dtbag' => $dtbag);

            $this->load->view('master/user/V_menu_form_user',  array_merge($data,$data2,$data5,$data6,$data7,$data8,$data9));

        } else if ($mau_ke == "aksi_add") {//jika uri segmentnya aksi_add sebagai fungsi untuk insert
            $data = array(
            	'nik'           => trim($nomornik),
                'nmdepan'       => trim($namadepan),
                'nmlengkap'     => trim($namalengkap),
                'username'      => trim($username),
                'password'      => trim($password),
                'leveluserid'   => trim($leveluserid),
                'jabid'         => trim($jabid),
                'bagid'         => trim($bagid)
            );

            $cek_user = $this->M_menu_user->cek_username($username);
            if($cek_user->num_rows() > 0 ){
                echo "<script>alert('Maaf user dengan User Name : $username sudah ada, ganti dengan username yang lain...!!!! ');</script>";
                redirect('master/user/C_menu_user');
            }else{

                    if($is_update==0) {
                        if($this->M_menu_user->insert($data))
                            redirect('master/user/C_menu_user');
                    }
                    //}
                $this->M_menu_user->insert($data); //model insert data barang

                $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>"); //pesan yang tampil setalah berhasil di insert
                redirect('master/user/C_menu_user');
            }
           
        } else if ($mau_ke == "aksi_edit") { //jika uri segmentnya aksi_edit sebagai fungsi untuk update

            $cek_user = $this->M_menu_user->cek_username2($username,$kode);
            if($cek_user->num_rows() > 0 ){
                echo "<script>alert('Maaf user dengan User Name : $username sudah ada, ganti dengan username yang lain...!!!! ');</script>";
                redirect('master/user/C_menu_user');
            }else{

                $data = array(
                'userid'        => trim($kode),
                'nik'           => trim($nomornik),
                'nmdepan'       => trim($namadepan),
                'nmlengkap'     => trim($namalengkap),
                'username'      => trim($username),
                'password'      => trim($password),
                'leveluserid'   => trim($leveluserid),
                'jabid'         => trim($jabid),
                'bagid'         => trim($bagid)
            );

            $this->M_menu_user->update_user($id,$data); //modal update data barang
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>"); //pesan yang tampil setelah berhasil di update

            redirect('master/user/C_menu_user',  array_merge($data, $data2));
            }
	        
        }

    }

    function delete($id) {
		if($this->M_menu_user->delete_by_id($id)) {
			redirect('master/user/C_menu_user');
		}
	}

	/*function save($is_update=0) {
		//$data['userid']		= $this->input->post('userid', true);
		$data['nik']			= $this->input->post('nik', true);
		$data['nmdepan']		= $this->input->post('nmdepan', true);
		$data['nmlengkap']		= $this->input->post('nmlengkap', true);
		$data['username']		= $this->input->post('username', true);
		$data['password']		= $this->input->post('password', true);
		$data['leveluserid']	= $this->input->post('leveluserid', true);
		$data['jabid']			= $this->input->post('jabid', true);

		$this->_set_rules();
		if ($this->form_validation->run() == true) {
			if($is_update==0) {
				if($this->M_menu_user->insert($data))
					redirect('master/user/C_menu_user');
			} else {
				$id = $this->input->post('id');
				if($this->M_menu_user->update_by_id($data, $id))
					redirect('master/user/C_menu_user');
			}
		}
	}

	function edit($id) {
		if($this->session->userdata('logged_in')) {
            $session_data 			= $this->session->userdata('logged_in');
            $data['username'] 		= $session_data['username'];
            $data['password'] 		= $session_data['password'];
            $data['jabid'] 			= $session_data['jabid'];
            $data['leveluserid'] 	= $session_data['leveluserid'];

            $LevelUser 	= $session_data['leveluserid'];
            $UserName 	= $session_data['username'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            //$this->_set_rules();

            $this->data['query'] 		= $this->M_menu_user->get_records("userid = '$id'");
			$this->data['is_update'] 	= 1;
			$this->load->view('master/user/V_menu_form_user', array_merge($data, $data2, $this->data));

          	//$this->data['query'] = $this->M_menu_user->get_records();
			//$this->load->view('master/user/V_menu_user', array_merge($data, $data2, $this->data));

		} else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
            }

	}



	function add() {
		if($this->session->userdata('logged_in')) {
            $session_data 			= $this->session->userdata('logged_in');
            $data['username'] 		= $session_data['username'];
            $data['password'] 		= $session_data['password'];
            $data['jabid'] 			= $session_data['jabid'];
            $data['leveluserid'] 	= $session_data['leveluserid'];

            $LevelUser 	= $session_data['leveluserid'];
            $UserName 	= $session_data['username'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $this->data['is_update'] = 0;
			$this->load->view('master/user/V_menu_form_user',array_merge($data, $data2, $this->data));

		} else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
            }

	}*/

	function _set_rules() {
		if($this->session->userdata('logged_in')) {
            $session_data			 = $this->session->userdata('logged_in');
            $data['username']		 = $session_data['username'];
            $data['password']		 = $session_data['password'];
            $data['jabid'] 			 = $session_data['jabid'];
            $data['leveluserid'] 	 = $session_data['leveluserid'];
            $data['nmdepan'] = $session_data['nmdepan'];
            $data['levelusernm'] = $session_data['levelusernm'];
            $data['bagnm'] = $session_data['bagnm'];
            $data['jabnm'] = $session_data['jabnm'];

            $LevelUser = $session_data['leveluserid'];
            $UserName = $session_data['username'];
            $LevelUserNm = $session_data['levelusernm'];

            $cekLevelUserNm = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $this->load->library('form_validation');


	        $this->form_validation->set_rules('nik','NIK','required|max_length[10]');
	        $this->form_validation->set_rules('nmdepan','Nama Depan','required|max_length[30]');
	        $this->form_validation->set_rules('nmlengkap','Nama Lengkap','required|max_length[30]');
	        $this->form_validation->set_rules('username','Username','required|max_length[15]');
	        $this->form_validation->set_rules('password','Password','required|max_length[30]');
	        $this->form_validation->set_rules('leveluserid','Level ID User','required|max_length[10]');
	        $this->form_validation->set_rules('jabid','ID Jabatan','required|max_length[10]');

	        $this->form_validation->set_message('required', '%s <font color="red"><strong>Harus Diisi.</strong></font>');

	        if ($this->form_validation->run() == FALSE)	{
                $this->data['is_update'] = 0;
				$this->load->view('master/user/V_menu_form_user', array_merge($data, $data2,$this->data));
			} else {
				$this->data['is_update'] = 0;
				$this->load->view('master/user/V_menu_form_user', array_merge($data, $data2,$this->data));
				//redirect('master/user/C_menu_user');
			}
		} else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
	}
}
