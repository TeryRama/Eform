<?php

class C_hak_akses extends CI_Controller {

	var $data = array();

	function __construct() {

		parent :: __construct();

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');

		$this->load->model(array('M_menu','tambahan/lain_lain/M_hak_akses'));

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

            $list_bagian      = $this->M_hak_akses->get_list_bagian();
            $data_list_bagian = array('list_bagian' => $list_bagian);

            $data['bagian']             = '';
            $data['bagianid']           = '';
            $data['posisi']             = '';
            $data['level']              = '';
            $data['nik']                = '';
            $data['nama']               = '';
            $data['showall']            = '';
            $data['form_bagian']        = '';
            $data['form_kategori']      = '';
            $data['form_subkategori']   = '';
            $data['form_nama']          = '';
            $data['form_kode']          = '';
            $data['form_versi']         = '';

            $this->load->view('tambahan/lain_lain/V_hak_akses', array_merge($data, $data2, $data_list_bagian));

        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }

    function get_hak_akses() {
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

            $list_bagian      = $this->M_hak_akses->get_list_bagian();
            $data_list_bagian = array('list_bagian' => $list_bagian);

            $bagian             = $this->input->post('bagian');
            $posisi             = $this->input->post('posisi');
            $level              = $this->input->post('level');
            $nik                = $this->input->post('nik');
            $nama               = $this->input->post('nama');
            $showall            = $this->input->post('showall');
            $form_bagian        = $this->input->post('form_bagian');
            $form_kategori      = $this->input->post('form_kategori');
            $form_subkategori   = $this->input->post('form_subkategori');
            $form_nama          = $this->input->post('form_nama');
            $form_versi         = $this->input->post('form_versi');

            $data['bagian']             = $this->input->post('bagian');
            $data['bagianid']           = $this->input->post('bagianid');
            $data['posisi']             = $this->input->post('posisi');
            $data['level']              = $this->input->post('level');
            $data['nik']                = $this->input->post('nik');
            $data['nama']               = $this->input->post('nama');
            $data['showall']            = $this->input->post('showall');
            $data['form_bagian']        = $this->input->post('form_bagian');
            $data['form_kategori']      = $this->input->post('form_kategori');
            $data['form_subkategori']   = $this->input->post('form_subkategori');
            $data['form_nama']          = $this->input->post('form_nama');
            $data['form_kode']          = $this->input->post('form_kode');
            $data['form_versi']         = $this->input->post('form_versi');

            if(isset($showall)){
              $hak_akses      = $this->M_hak_akses->get_hak_akses_all();
            }else{
              $hak_akses      = $this->M_hak_akses->get_hak_akses($bagian,$posisi,$level,$nik,$nama,$form_bagian,$form_kategori,$form_subkategori,$form_nama, $form_versi);
            }

            $data_hak_akses = array('hak_akses' => $hak_akses);

            if($hak_akses==false){$data['message'] ='Maaf Data Tidak Ditemukan..!!';}else{$data['message'] ='';}
            

            $this->load->view('tambahan/lain_lain/V_hak_akses', array_merge($data, $data2, $data_hak_akses, $data_list_bagian));

        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }

    function get_form_kategori(){
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

            $bagian = $this->input->post('bagian');

            $result_kategori = $this->M_hak_akses->get_kategori($bagian);

            $data1='';
            foreach($result_kategori as $result_kategori_row){
                if(trim($result_kategori_row->formkategorinm)==''){
                    $data1 .= "<option value='-'>-</option>";
                }else{
                    $data1 .= "<option value='".$result_kategori_row->formkategorinm."'>".$result_kategori_row->formkategorinm."</option>";
                }
            }

            echo $html_kategori = $data1;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function get_form_subkategori(){
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

            $bagian = $this->input->post('bagian');
            $form_kategori = $this->input->post('form_kategori');

            $result_subkategori = $this->M_hak_akses->get_subkategori($bagian, $form_kategori);

            $data1='';
            foreach($result_subkategori as $result_subkategori_row){
                if(trim($result_subkategori_row->formkategori2nm)==''){
                    $data1 .= "<option value='-'>-</option>";
                }else{
                    $data1 .= "<option value='".$result_subkategori_row->formkategori2nm."'>".$result_subkategori_row->formkategori2nm."</option>";
                }
            }

            echo $html_subkategori = $data1;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function get_form_kode(){
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

            $bagian = $this->input->post('bagian');
            $form_kategori = $this->input->post('form_kategori');
            $form_subkategori = $this->input->post('form_subkategori');

            $result_formkode = $this->M_hak_akses->get_formkode($bagian, $form_kategori, $form_subkategori);

            $data1='';
            foreach($result_formkode as $result_formkode_row){
                if(trim($result_formkode_row->formkd)==''){
                    $data1 .= "<option value='-'>-</option>";
                }else{
                    $data1 .= "<option value='".$result_formkode_row->formkd."'>".$result_formkode_row->formnm."</option>";
                }
            }

            echo $html_formkode = $data1;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function get_form_versi(){
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

            $form_kode = $this->input->post('form_kode');

            $result_formversi = $this->M_hak_akses->get_formversi($form_kode);

            $data1='';
            foreach($result_formversi as $result_formversi_row){
                if(trim($result_formversi_row->formversi)==''){
                    $data1 .= "<option value='-'>-</option>";
                }else{
                    $data1 .= "<option value='".$result_formversi_row->formversi."'>".$result_formversi_row->formversi."</option>";
                }
            }

            echo $html_formversi = $data1;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    } 

    function get_posisi(){
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

            $deptid = $this->input->post('deptid');

            $result_posisi = $this->M_hak_akses->get_posisi($deptid);
            $result_level = $this->M_hak_akses->get_level($deptid);

            $data1='';
            foreach($result_posisi as $result_posisi_row){
                if(trim($result_posisi_row->jabnm)==''){
                    $data1 .= "<option value='-'>-</option>";
                }else{
                    $data1 .= "<option value='".$result_posisi_row->jabnm."'>".$result_posisi_row->jabnm."</option>";
                }
            }

            $data2='';
            foreach($result_level as $result_level_row){
                if(trim($result_level_row->levelusernm)==''){
                    $data2 .= "<option value='-'>-</option>";
                }else{
                    $data2 .= "<option value='".$result_level_row->levelusernm."'>".$result_level_row->levelusernm."</option>";
                }
            }

            echo $html_posisi = $data1.'//'.$data2;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

}
?>