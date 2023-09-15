<?php

class C_menu_user extends CI_Controller {

	var $data = array();

	function __construct(){

		parent :: __construct();

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');

		$this->load->model(array('M_user', 'M_menu','master/user/M_menu_user'));

        //////////////////////////////////
        /// prevent direct url accses
        $session_data = $this->session->userdata('logged_in');
        $leveluid     = $session_data['leveluserid'];
        $url_str      = uri_string();

        $akses_check = $this->M_user->check_akses_bylevelid($leveluid,'C_menu_user');
        if($akses_check==false){
            echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini..!!');
                          window.location.assign('";echo base_url();echo "C_login');
                       </script>"; 
        }
        /// end prevent direct url accses
        //////////////////////////////////
	}

	function index(){
		if($this->session->userdata('logged_in')){
          $session_data           = $this->session->userdata('logged_in');
          $data['username']       = $session_data['username'];
          $data['password']       = $session_data['password'];
          $data['jabid']          = $session_data['jabid'];
          $data['leveluserid']    = $session_data['leveluserid'];
          $data['nmdepan']        = $session_data['nmdepan'];
          $data['levelusernm']    = $session_data['levelusernm'];
          $data['bagnm']          = $session_data['bagnm'];
          $data['jabnm']          = $session_data['jabnm'];
          $data['bagian_akses']   = $session_data['bagian_akses'];
          $data['ori_akses']      = $session_data['ori_akses'];
          $data['audit_akses']    = $session_data['audit_akses'];
          $data['Titel']          = 'Master - User';
          
          $LevelUser              = $session_data['leveluserid'];
          $UserName               = $session_data['username'];
          
          $LevelUserNm            = $session_data['levelusernm'];
          
          $cekLevelUserNm         = substr($LevelUserNm,0,7);
          $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
          $Bagian                 = $session_data['bagnm'];
          $arr_bagian_akses       = explode(',', $session_data['bagian_akses']);
          
          $menus                  = $this->M_menu->menus($LevelUser);
          $data2                  = array('menus' => $menus);
          
          $data['list_user']      = $this->M_menu_user->get_allrecords();    
          
		  $this->load->view('master/user/V_menu_user', array_merge($data, $data2));

		}else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
		}
	}

    function get_datapersonal(){
        if($this->session->userdata('logged_in')){
            $session_data           = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['bagian_akses']   = $session_data['bagian_akses'];
            $data['ori_akses']      = $session_data['ori_akses'];
            $data['audit_akses']    = $session_data['audit_akses'];
            
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            
            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);
            $Bagian                 = $session_data['bagnm'];
            $arr_bagian_akses       = explode(',', $session_data['bagian_akses']);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $nik                    = trim($this->input->post('nik'));
            $personalstatus         = trim($this->input->post('personalstatus'));

            $datapost = array(
                'nik'      => $nik
            );

            if($personalstatus == '1'){
                $result_personal = $this->M_menu_user->get_personalkar($datapost);
            }elseif($personalstatus == '2'){
                $result_personal = $this->M_menu_user->get_personaltk($datapost);
            }else{
                $result_personal = '';
            }

            $id_company    = '1';

            if(count($result_personal) > 0){
                foreach ($result_personal as $result_personal_row){
                    $status        = $result_personal_row->TanggalKeluar;
                    $personalid    = $result_personal_row->HeaderID;
                    $nama          = $result_personal_row->NAMA;  
                    
                    if($personalstatus == '1'){
                        $id_divisi     = $result_personal_row->kodedivisi;
                        $id_departemen = $result_personal_row->DeptID;
                        $id_bagian     = $result_personal_row->BagianID;
                        $id_jabatan    = $result_personal_row->JabatanID;
                    }else{
                        $id_divisi     = '';
                        $id_departemen = '';
                        $id_bagian     = '';
                        $id_jabatan    = '';
                    }                  
                }
            }else{
                $personalid    = '';
                $nama          = '';
                $id_divisi     = '';
                $id_departemen = '';
                $id_bagian     = '';
                $id_jabatan    = '';
                $status        = '';
            }

            echo $nama.'//'.$status.'//'.$personalid.'//'.$id_company.'//'.$id_divisi.'//'.$id_departemen.'//'.$id_bagian.'//'.$id_jabatan;
        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_dtusertamu(){
        if($this->session->userdata('logged_in')){
            $session_data           = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['bagian_akses']   = $session_data['bagian_akses'];
            $data['ori_akses']      = $session_data['ori_akses'];
            $data['audit_akses']    = $session_data['audit_akses'];
            
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            
            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);
            $Bagian                 = $session_data['bagnm'];
            $arr_bagian_akses       = explode(',', $session_data['bagian_akses']);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $usertamu               = trim($this->input->post('usertamu'));
            
            $result_usertamu        = $this->M_menu_user->get_personaltoptamu($usertamu);

            if(count($result_usertamu) > 0){
                foreach ($result_usertamu as $result_usertamu_row){
                    $username   = $result_usertamu_row->UserID;
                    $nik        = $result_usertamu_row->NIK;
                    $personalid = $result_usertamu_row->personalid;
                    $nmlengkap  = $result_usertamu_row->Nama;
                    $status     = '';
                }
            }else{
                $username   = '';
                $nik        = '';
                $personalid = '';
                $nmlengkap  = '';
                $status     = '';
            }

            //id di mst PSGBORONGAN gak sama dgn payroll, dahlah deklar aja lagi males nyocokin
            $id_company             = '1';
            $id_divisi              = '';
            $id_departemen          = '';
            $id_bagian              = '';
            $id_jabatan             = '';

            echo $nmlengkap.'//'.$status.'//'.$personalid.'//'.$id_company.'//'.$id_divisi.'//'.$id_departemen.'//'.$id_bagian.'//'.$id_jabatan;
        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_allstatus_user(){
        if($this->session->userdata('logged_in')){
            $session_data           = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['bagian_akses']   = $session_data['bagian_akses'];
            $data['ori_akses']      = $session_data['ori_akses'];
            $data['audit_akses']    = $session_data['audit_akses'];
            
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            
            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);
            $Bagian                 = $session_data['bagnm'];
            $arr_bagian_akses       = explode(',', $session_data['bagian_akses']);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $personalid             = trim($this->input->post('personalid'));
            $personalstatus         = trim($this->input->post('personalstatus'));
            
            $result_allstatus       = $this->M_menu_user->get_allstatus_user($personalid, $personalstatus);

            if(count($result_allstatus['q2']) > 0){
                $st_personal  = '<i>registered</i> &#9989;';
                $st_personal2 = '1';
            }else{
                $st_personal  = '<i>unregistered</i> &#10060;';
                $st_personal2 = '0';
            }

            foreach ($result_allstatus['q3'] as $result_allstatus_row){
                $nst_onelogin   = $result_allstatus_row->userOnelogin;
            }

            if($nst_onelogin > 0){
                $st_onelogin  = '<i>registered</i> &#9989;';
                $st_onelogin2 = '1';
            }else{
                $st_onelogin  = '<i>unregistered</i> &#10060;';
                $st_onelogin2 = '0';
            }

            $data_html = $st_personal.'//'.$st_onelogin.'//'.$st_personal2.'//'.$st_onelogin2.'//';
            echo $data_html;
        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_list_dept(){
        if($this->session->userdata('logged_in')){
            $session_data           = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['bagian_akses']   = $session_data['bagian_akses'];
            $data['ori_akses']      = $session_data['ori_akses'];
            $data['audit_akses']    = $session_data['audit_akses'];
            
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            
            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);
            $Bagian                 = $session_data['bagnm'];
            $arr_bagian_akses       = explode(',', $session_data['bagian_akses']);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $id_company             = trim($this->input->post('id_company'));
            $id_divisi              = trim($this->input->post('id_divisi'));
            
            $list_dept              = $this->M_menu_user->get_dept_by($id_company, $id_divisi);
            
            $vlist_dept             = '<option value="">- pilih -</option>';
            if(count($list_dept)>0){
                foreach($list_dept as $list_dept_row){
                    $vlist_dept .= '<option value="'.$list_dept_row->deptid.'">' .$list_dept_row->deptabbr. '</option>';
                }
            }
            
            echo $vlist_dept;
        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_list_bag(){
        if($this->session->userdata('logged_in')){
            $session_data           = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['bagian_akses']   = $session_data['bagian_akses'];
            $data['ori_akses']      = $session_data['ori_akses'];
            $data['audit_akses']    = $session_data['audit_akses'];
            
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            
            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);
            $Bagian                 = $session_data['bagnm'];
            $arr_bagian_akses       = explode(',', $session_data['bagian_akses']);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $id_company             = trim($this->input->post('id_company'));
            $id_divisi              = trim($this->input->post('id_divisi'));
            $id_dept                = trim($this->input->post('id_dept'));
            
            $list_bag              = $this->M_menu_user->get_bag_by($id_company, $id_divisi, $id_dept);
            
            $vlist_bag             = '<option value="">- pilih -</option>';
            if(count($list_bag)>0){
                foreach($list_bag as $list_bag_row){
                    $vlist_bag .= '<option value="'.$list_bag_row->bagianid.'">' .$list_bag_row->bagianabbr. '</option>';
                }
            }
            
            echo $vlist_bag;
        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }    

    function get_list_jab(){
        if($this->session->userdata('logged_in')){
            $session_data           = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['bagian_akses']   = $session_data['bagian_akses'];
            $data['ori_akses']      = $session_data['ori_akses'];
            $data['audit_akses']    = $session_data['audit_akses'];
            
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            
            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);
            $Bagian                 = $session_data['bagnm'];
            $arr_bagian_akses       = explode(',', $session_data['bagian_akses']);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $id_company             = trim($this->input->post('id_company'));
            $id_divisi              = trim($this->input->post('id_divisi'));
            $id_dept                = trim($this->input->post('id_dept'));
            $id_dept                = trim($this->input->post('id_dept'));
            $id_bagian              = trim($this->input->post('id_bagian'));
            
            $list_jab               = $this->M_menu_user->get_jab_by($id_company, $id_divisi, $id_dept, $id_bagian);
            
            $vlist_jab              = '<option value="">- pilih -</option>';
            if(count($list_jab)>0){
                foreach($list_jab as $list_jab_row){
                    $vlist_jab .= '<option value="'.$list_jab_row->JabatanID.'">' .$list_jab_row->JabatanName. '</option>';
                }
            }
            
            echo $vlist_jab;
        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_list_leveluser(){
        if($this->session->userdata('logged_in')){
            $session_data           = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['bagian_akses']   = $session_data['bagian_akses'];
            $data['ori_akses']      = $session_data['ori_akses'];
            $data['audit_akses']    = $session_data['audit_akses'];
            
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            
            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);
            $Bagian                 = $session_data['bagnm'];
            $arr_bagian_akses       = explode(',', $session_data['bagian_akses']);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $bagian_abbr            = trim($this->input->post('bagian_abbr'));
            // if ($bagian_abbr == "ITD"){
            //     $list_leveluser         = $this->M_menu_user->get_leveluser_by_ITD();
            // }else{
            $list_leveluser         = $this->M_menu_user->get_leveluser_by($bagian_abbr);
            // }
            

            $vlist_leveluser = '<option value="">- pilih -</option>';
            if(count($list_leveluser)>0){
                foreach($list_leveluser as $list_leveluser_row){
                    $vlist_leveluser .= '<option value="'.$list_leveluser_row->leveluserid.'">' .$list_leveluser_row->levelusernm. '</option>';
                }
            }
            
            echo $vlist_leveluser;
        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function form(){
        $session_data           = $this->session->userdata('logged_in');
        $data['username']       = $session_data['username'];
        $data['password']       = $session_data['password'];
        $data['jabid']          = $session_data['jabid'];
        $data['leveluserid']    = $session_data['leveluserid'];
        $data['nmdepan']        = $session_data['nmdepan'];
        $data['nmlengkap']      = $session_data['nmlengkap'];
        $data['levelusernm']    = $session_data['levelusernm'];
        $data['bagnm']          = $session_data['bagnm'];
        $data['jabnm']          = $session_data['jabnm'];
        $data['bagian_akses']   = $session_data['bagian_akses'];
        $data['ori_akses']      = $session_data['ori_akses'];
        $data['audit_akses']    = $session_data['audit_akses'];  
        $data['Titel']          = 'Master - User';      
        
        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];
        
        $cekLevelUserNm         = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        $Bagian                 = $session_data['bagnm'];
        $arr_bagian_akses       = explode(',', $session_data['bagian_akses']);
        
        $menus                  = $this->M_menu->menus($LevelUser);
        $data2                  = array('menus' => $menus);
        
        //ambil variabel URL
        $mau_ke                 = $this->uri->segment(5);
        $idu                    = $this->uri->segment(6);
        
        //ambil variabel dari form
        $id                     = addslashes($this->input->post('userid'));
        $kode                   = addslashes($this->input->post('userid'));
        $nomornik               = addslashes($this->input->post('nik'));
        $personalid             = addslashes($this->input->post('personalid'));
        $personalstatus         = addslashes($this->input->post('personalstatus'));
        $namadepan              = addslashes(strtoupper($this->input->post('nmdepan')));
        $namalengkap            = addslashes(strtoupper($this->input->post('nmlengkap')));
        $id_company             = addslashes($this->input->post('id_company'));
        $id_divisi              = addslashes($this->input->post('id_divisi'));
        $id_dept                = addslashes($this->input->post('id_dept'));
        $id_bagian              = addslashes($this->input->post('id_bagian'));
        $id_jabatan             = addslashes($this->input->post('id_jabatan'));
        $leveluserid            = addslashes($this->input->post('leveluserid'));
        $username               = addslashes(strtoupper($this->input->post('username')));
        $password               = addslashes(strtoupper($this->input->post('password')));
        $stuser                 = addslashes($this->input->post('stuser'));
        $status_otp             = addslashes($this->input->post('status_otp'));
        
        $create_by              = $session_data['nmlengkap'];
        $create_date            = date('Y-m-d');
        $create_time            = date("H:i:s");
        
        $data['dtcompany']      = $this->M_user->get_allcompany();
        
        $data['dtdivisi']       = $this->M_user->get_alldivisi();
        
        $data['dtdepartemen']   = $this->M_user->get_alldepartemen();
        
        $data['dtbagian']       = $this->M_user->get_allbagian();
        
        $data['dtjabatan']      = $this->M_user->get_alljabatan();
        
        $data['dttamu']         = $this->M_menu_user->get_all_dttamu_onelogin();
        
        $data['dtleveluser']    = $this->M_menu_user->get_allleveluser();

        //mengarahkan fungsi form sesuai dengan uri segmentnya
        if($mau_ke == "add"){         //jika uri segmentnya add
            $data4['aksi']        = 'aksi_add';
            
            $this->load->view('master/user/V_menu_form_user', array_merge($data, $data2, $data4));

        }else if($mau_ke == "edit"){         //jika uri segmentnya edit
            $data4['aksi']   = 'aksi_edit';
            
            $data5['dtuser'] = $this->M_menu_user->get_user_byid($idu);
            
            $this->load->view('master/user/V_menu_form_user', array_merge($data, $data2, $data4, $data5));

        }else if($mau_ke == "aksi_add"){//jika uri segmentnya aksi_add sebagai fungsi untuk insert
            $data = array(
                'personalid'           => trim($personalid),
                'personalstatus'       => trim($personalstatus),
                'nik'                  => trim($nomornik),
                'nmdepan'              => trim($namadepan),
                'nmlengkap'            => trim($namalengkap),
                'username'             => trim($username),
                'password'             => trim($password),
                'leveluserid'          => $leveluserid,
                'inactive'             => $stuser,
                'status_otp'           => $status_otp,
                'create_by'            => $create_by,
                'create_date'          => $create_date,
                'create_time'          => $create_time,
                'id_company'           => $id_company,
                'id_divisi'            => $id_divisi,
                'id_dept'              => $id_dept,
                'id_bagian'            => $id_bagian,
                'id_jabatan'           => $id_jabatan,
                'last_update_password' => date('Y-m-d'),
            );

            $cek_user = $this->M_menu_user->cek_username($username);
            if($cek_user->num_rows() > 0 ){
                echo "<script>alert('Maaf.. gagal menyimpan data, user $username sudah ada...!!!! ');
                    window.location.href = '../';</script>";
                // redirect('master/user/C_menu_user');
            }else{
                $this->M_menu_user->insert($data); //model insert data barang
                redirect('master/user/C_menu_user');
            }
           
        }else if($mau_ke == "aksi_edit"){ //jika uri segmentnya aksi_edit sebagai fungsi untuk update

            $cek_user = $this->M_menu_user->cek_username2($username, $kode);
            if($cek_user->num_rows() > 0 ){
                echo "<script>alert('Maaf.. gagal menyimpan data, user $username sudah ada...!!!! ');
                    window.location.href = '../';</script>";
                // redirect('master/user/C_menu_user');
            }else{
                $data = array(
                    'personalid'           => trim($personalid),
                    'personalstatus'       => trim($personalstatus),
                    'nik'                  => trim($nomornik),
                    'nmdepan'              => trim($namadepan),
                    'nmlengkap'            => trim($namalengkap),
                    'username'             => trim($username),
                    'password'             => trim($password),
                    'leveluserid'          => $leveluserid,
                    'inactive'             => $stuser,
                    'status_otp'           => $status_otp,
                    'create_by'            => $create_by,
                    'create_date'          => $create_date,
                    'create_time'          => $create_time,
                    'id_company'           => $id_company,
                    'id_divisi'            => $id_divisi,
                    'id_dept'              => $id_dept,
                    'id_bagian'            => $id_bagian,
                    'id_jabatan'           => $id_jabatan,
                    'last_update_password' => date('Y-m-d'),
                );

                $this->M_menu_user->update_user($id, $data); //modal update data barang
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>"); //pesan yang tampil setelah berhasil di update

                redirect('master/user/C_menu_user',  array_merge($data, $data2));
            }            
        }
    }	

    function delete(){
		$id = $this->uri->segment(5);

        $data = array(
            'inactive' => '1',
        );

        $this->M_menu_user->update_user($id, $data);
        redirect('master/user/C_menu_user');
	}

} ?>