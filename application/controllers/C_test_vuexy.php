<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
    class C_test_vuexy extends CI_Controller { 
        function __construct() {
            parent::__construct();
            $this->load->model(array('M_menu','M_user','M_home', 'tambahan/lain_lain/M_jadwal_audit'));
        }
    
        function index() {
            if($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                $data['userid'] = $session_data['userid'];
                $data['username'] = $session_data['username'];
                $data['password'] = $session_data['password'];
                $data['jabid'] = $session_data['jabid'];
                $data['leveluserid'] = $session_data['leveluserid'];
                $data['nmdepan'] = $session_data['nmdepan'];
                $data['levelusernm'] = $session_data['levelusernm'];
                $data['bagnm'] = $session_data['bagnm'];
                $data['jabnm'] = $session_data['jabnm'];
                $data['Titel'] = 'Home';
                $data['status_password'] = $session_data['status_password'];
                
                if($session_data['status_password']=='Password Expired'){
                    $this->load->view('V_expired_password', array_merge($data));
                }else{
                    $LevelUser = $session_data['leveluserid'];
                    $UserName = $session_data['username'];
                    $LevelUserNm = $session_data['levelusernm'];

                    $cekLevelUserNm = substr($LevelUserNm,0,7);
                    $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);

                    $menus = $this->M_menu->menus($LevelUser);
                    $data2 = array('menus' => $menus);

                    $user_ol = $this->M_home->get_dt_user_ol();
                    $dt_user_ol = array('user_ol' => $user_ol);

                    $list_form = $this->M_home->get_form_list($LevelUser);
                    $dt_list_form = array('list_form' => $list_form);

                    $jadwal_audit      = $this->M_jadwal_audit->get_jadwal_audit_home();
                    $data_jadwal_audit = array('jadwal_audit' => $jadwal_audit);
                    
                    $data['jml_ol'] = count($user_ol);

                        if($cekLevelUserNm=='Auditor'){ 
                          $data['status_au'] = 'yes';
                        }else{
                          $data['status_au'] = 'no';
                        }
                
                    $this->load->view('V_test_vuexy', array_merge($data, $data2,$dt_user_ol,$dt_list_form,$data_jadwal_audit));
                }
        
            }
            else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
            }
        }
    
        function logout() {
            $session_data = $this->session->userdata('logged_in');
            $username = $session_data['username'];
            $logdate = date("Y-m-d");
            $this->M_user->simpan_log_out($username,$logdate);
            $this->session->unset_userdata('logged_in');
            session_destroy();
            redirect('C_test_vuexy', 'refresh');
        }

        function get_exp_date()
        {
            if('IS_AJAX') {
                $dt_shelf_life    = $this->input->post('dt_shelf_life');
                $dt_date          = date('Y-m-d', strtotime($this->input->post('dt_date')));
                $row = $this->M_user->date_calculate($dt_date,$dt_shelf_life);
                $data = date('d-m-Y', strtotime($row->fn_expiry_date));
                echo json_encode($data);
            }   
        } 
    }
   