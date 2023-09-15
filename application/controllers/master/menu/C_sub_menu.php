<?php

class C_sub_menu extends CI_Controller {
	
	var $data = array();
	
	function __construct(){
		
		parent :: __construct();

		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->model(array('M_user', 'M_menu','master/menu/M_sub_menu'));

        //////////////////////////////////
        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $leveluid     = $session_data['leveluserid'];
            $url_str      = uri_string();
            $akses_check  = $this->M_user->check_akses_bylevelid($leveluid,'C_sub_menu');
            /// prevent direct url accses
            if($akses_check==false){
                echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini..!!');
                              window.location.assign('"; echo base_url();echo "C_login');
                           </script>"; 
            }        
        } else {
            /// Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
        //////////////////////////////////
	}
	
	function index(){
        $session_data           = $this->session->userdata('logged_in');
        $data['username']       = $session_data['username'];
        $data['password']       = $session_data['password'];
        $data['jabid']          = $session_data['jabid'];
        $data['leveluserid']    = $session_data['leveluserid'];
        $data['nmdepan']        = $session_data['nmdepan'];
        $data['levelusernm']    = $session_data['levelusernm'];
        $data['bagnm']          = $session_data['bagnm'];
        $data['jabnm']          = $session_data['jabnm'];
        $data['Titel']          = 'Master - Menu';
        
        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];
        
        $cekLevelUserNm         = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        
        $data['menus']          = $this->M_menu->menus($LevelUser);
        
        $data['query']          = $this->M_sub_menu->get_records();
        $data['query2']         = $this->M_sub_menu->get_records_sub();
        $data['query3']         = $this->M_sub_menu->get_records_sub2();
        $data['query4']         = $this->M_sub_menu->get_records_sub3();
        
        $data['dtmenu']         = $this->M_sub_menu->get_allmenu();
        $data['dtsubmenu']      = $this->M_sub_menu->get_allsubmenu();
        $data['dtsubmenu2']     = $this->M_sub_menu->get_allsubmenu2();
        
        $this->load->view('master/menu/V_menu', array_merge($data));
	}

    function form_modal_menu(){
        $session_data   = $this->session->userdata('logged_in');
        
        $mdl1_detail_id = $this->input->post('mdl1_detail_id');    

        if ($this->uri->segment(5)=='add'){
            $data['menunm']     = $this->input->post('mdl1_menunm'); 
            $data['menulink']   = $this->input->post('mdl1_menulink'); 
            $data['menufaicon'] = $this->input->post('mdl1_menufaicon'); 
            if ($this->M_sub_menu->insert($data))
                echo "<script>alert('Data berhasil ditambah!!');
                      window.location.assign('".base_url()."master/menu/C_sub_menu');
                   </script>";
        }else if ($this->uri->segment(5)=='update'){
            $data['menunm']     = $this->input->post('mdl1_menunm'); 
            $data['menulink']   = $this->input->post('mdl1_menulink'); 
            $data['menufaicon'] = $this->input->post('mdl1_menufaicon'); 
            if ($this->M_sub_menu->update_menu($mdl1_detail_id, $data))
                echo "<script>alert('Data berhasil diupdate!!');
                      window.location.assign('".base_url()."master/menu/C_sub_menu');
                   </script>";
        }else{                
            echo "<script>alert('Gagal, tidak ada aksi!!');
                  window.location.assign('".base_url()."master/menu/C_sub_menu');
               </script>";
        }
    }

    function get_dt_update_menu(){        
        $id         = $this->input->post('id');        
        $dt_update  = $this->M_sub_menu->get_menu_byid($id);
        
        $menunm     = '';
        $menulink   = '';
        $menufaicon = '';

        foreach($dt_update as $dt_update_row){
            $menunm     = $dt_update_row->menunm;
            $menulink   = $dt_update_row->menulink;
            $menufaicon = $dt_update_row->menufaicon;
        }

        echo $menunm.'//'.$menulink.'//'.$menufaicon;
    }

    function delete($id){
        if($this->M_sub_menu->delete_menu_by_id($id)){
            redirect('master/menu/C_sub_menu');
        }
    }

    function form_modal_submenu(){
        $session_data   = $this->session->userdata('logged_in');
        
        $mdl2_detail_id = $this->input->post('mdl2_detail_id');    

        if ($this->uri->segment(5)=='add'){
            $data['submenunm']   = $this->input->post('mdl2_submenunm'); 
            $data['submenulink'] = $this->input->post('mdl2_submenulink'); 
            $data['menuid']      = $this->input->post('mdl2_menuid'); 
            if ($this->M_sub_menu->insert_sub($data))
                echo "<script>alert('Data berhasil ditambah!!');
                      window.location.assign('".base_url()."master/menu/C_sub_menu');
                   </script>";
        }else if ($this->uri->segment(5)=='update'){
            $data['submenunm']   = $this->input->post('mdl2_submenunm'); 
            $data['submenulink'] = $this->input->post('mdl2_submenulink'); 
            $data['menuid']      = $this->input->post('mdl2_menuid'); 
            if ($this->M_sub_menu->update_submenu_by_id($data, $mdl2_detail_id))
                echo "<script>alert('Data berhasil diupdate!!');
                      window.location.assign('".base_url()."master/menu/C_sub_menu');
                   </script>";
        }else{                
            echo "<script>alert('Gagal, tidak ada aksi!!');
                  window.location.assign('".base_url()."master/menu/C_sub_menu');
               </script>";
        }
    }

    function get_dt_update_submenu(){        
        $id          = $this->input->post('id');        
        $dt_update   = $this->M_sub_menu->get_submenu_byid($id);
        
        $submenunm   = '';
        $submenulink = '';
        $menuid      = '';

        foreach($dt_update as $dt_update_row){
            $submenunm   = $dt_update_row->submenunm;
            $submenulink = $dt_update_row->submenulink;
            $menuid      = $dt_update_row->menuid;
        }

        echo $submenunm.'//'.$submenulink.'//'.$menuid;
    }

    function delete_sub($id){
        if($this->M_sub_menu->delete_submenu_by_id($id)){
            redirect('master/menu/C_sub_menu');
        }
    }

    function form_modal_submenu2(){
        $session_data   = $this->session->userdata('logged_in');
        
        $mdl3_detail_id = $this->input->post('mdl3_detail_id');    

        if ($this->uri->segment(5)=='add'){
            $data['submenu2nm']   = $this->input->post('mdl3_submenu2nm'); 
            $data['submenu2link'] = $this->input->post('mdl3_submenu2link'); 
            $data['submenuid']    = $this->input->post('mdl3_submenuid'); 
            if ($this->M_sub_menu->insert_sub2($data))
                echo "<script>alert('Data berhasil ditambah!!');
                      window.location.assign('".base_url()."master/menu/C_sub_menu');
                   </script>";
        }else if ($this->uri->segment(5)=='update'){
            $data['submenu2nm']   = $this->input->post('mdl3_submenu2nm'); 
            $data['submenu2link'] = $this->input->post('mdl3_submenu2link'); 
            $data['submenuid']    = $this->input->post('mdl3_submenuid'); 
            if ($this->M_sub_menu->update_submenu2_by_id($data, $mdl3_detail_id))
                echo "<script>alert('Data berhasil diupdate!!');
                      window.location.assign('".base_url()."master/menu/C_sub_menu');
                   </script>";
        }else{                
            echo "<script>alert('Gagal, tidak ada aksi!!');
                  window.location.assign('".base_url()."master/menu/C_sub_menu');
               </script>";
        }
    }

    function get_dt_update_submenu2(){        
        $id           = $this->input->post('id');        
        $dt_update    = $this->M_sub_menu->get_submenu2_byid($id);
        
        $submenu2nm   = '';
        $submenu2link = '';
        $submenuid    = '';

        foreach($dt_update as $dt_update_row){
            $submenu2nm   = $dt_update_row->submenu2nm;
            $submenu2link = $dt_update_row->submenu2link;
            $submenuid    = $dt_update_row->submenuid;
        }

        echo $submenu2nm.'//'.$submenu2link.'//'.$submenuid;
    }

    function delete_sub2($id){
        if($this->M_sub_menu->delete_submenu2_by_id($id)){
            redirect('master/menu/C_sub_menu');
        }
    }

    function form_modal_submenu3(){
        $session_data   = $this->session->userdata('logged_in');
        
        $mdl4_detail_id = $this->input->post('mdl4_detail_id');    

        if ($this->uri->segment(5)=='add'){
            $data['submenu3nm']   = $this->input->post('mdl4_submenu3nm'); 
            $data['submenu3link'] = $this->input->post('mdl4_submenu3link'); 
            $data['submenu2id']   = $this->input->post('mdl4_submenu2id'); 
            if ($this->M_sub_menu->insert_sub3($data))
                echo "<script>alert('Data berhasil ditambah!!');
                      window.location.assign('".base_url()."master/menu/C_sub_menu');
                   </script>";
        }else if ($this->uri->segment(5)=='update'){
            $data['submenu3nm']   = $this->input->post('mdl4_submenu3nm'); 
            $data['submenu3link'] = $this->input->post('mdl4_submenu3link'); 
            $data['submenu2id']   = $this->input->post('mdl4_submenu2id'); 
            if ($this->M_sub_menu->update_submenu3_by_id($data, $mdl4_detail_id))
                echo "<script>alert('Data berhasil diupdate!!');
                      window.location.assign('".base_url()."master/menu/C_sub_menu');
                   </script>";
        }else{                
            echo "<script>alert('Gagal, tidak ada aksi!!');
                  window.location.assign('".base_url()."master/menu/C_sub_menu');
               </script>";
        }
    }

    function get_dt_update_submenu3(){        
        $id           = $this->input->post('id');        
        $dt_update    = $this->M_sub_menu->get_submenu3_byid($id);
        
        $submenu3nm   = '';
        $submenu3link = '';
        $submenu2id   = '';

        foreach($dt_update as $dt_update_row){
            $submenu3nm   = $dt_update_row->submenu3nm;
            $submenu3link = $dt_update_row->submenu3link;
            $submenu2id   = $dt_update_row->submenu2id;
        }

        echo $submenu3nm.'//'.$submenu3link.'//'.$submenu2id;
    }

    function delete_sub3($id){
        if($this->M_sub_menu->delete_submenu3_by_id($id)){
            redirect('master/menu/C_sub_menu');
        }
    }
	
} ?>