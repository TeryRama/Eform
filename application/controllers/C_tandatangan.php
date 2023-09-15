<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class C_tandatangan extends CI_Controller {
        function __construct() {
            parent::__construct();

            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->load->model(array('M_user', 'M_menu', 'master/user/M_menu_user', 'master/M_userlevel', 'master/M_tandatangan'));
            $this->load->helper('date');
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
                $data['Titel']          = 'Home';

                $LevelUser      = $session_data['leveluserid'];
                $UserName       = $session_data['username'];
                $LevelUserNm    = $session_data['levelusernm'];

                $cekLevelUserNm = substr($LevelUserNm,0,7);
                $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
                $Bagian     = $session_data['bagnm'];

                $menus = $this->M_menu->menus($LevelUser);
                $data2 = array('menus' => $menus);

                $dt_ttd = $this->M_tandatangan->get_all_ttd();
                $data3  = array('dt_ttd' => $dt_ttd);

                switch ($Bagian) {
                    case $Bagian == 'ITD':
                        $dtbag = "";
                        break;
                    default:
                        $dtbag = "WHERE bagnm like '%" . $Bagian . "%'";
                        break;
                }

                $this->data['query'] = $this->M_menu_user->get_records($dtbag);
                $this->load->view('V_tandatangan', array_merge($data, $data2, $data3));

            } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
            }
        }

        function get_canvas_ttd(){
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
                $data['Titel']          = 'Home';

                $LevelUser   = $session_data['leveluserid'];
                $UserName    = $session_data['username'];
                $LevelUserNm = $session_data['levelusernm'];

                $cekLevelUserNm = substr($LevelUserNm,0,7);
                $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);

                $menus = $this->M_menu->menus($LevelUser);
                $data2 = array('menus' => $menus);

                $this->load->view('V_ttd_canvas', array_merge($data, $data2));

            }
            else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
            }
        }
    }
