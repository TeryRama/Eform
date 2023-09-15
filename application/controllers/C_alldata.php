<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class C_alldata extends CI_Controller {
        function __construct() {
            parent::__construct();
            $this->load->model(array('M_alldata','M_user','M_menu'));
        }

        function getAllItem(){
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
                
                $menus                  = $this->M_menu->menus($LevelUser);
                $data2                  = array('menus' => $menus);
                
                $levelnm                = $this->M_menu->getLevelnm($LevelUser);
                $datalv                 = array('levelnm' => $levelnm);
                
                $item                   = $this->uri->segment(3);
                
                $sfrm_jnsid             = $this->uri->segment(4);
                $sfrm_kategoriid        = $this->uri->segment(5);
                $sfrm_kategori2id       = $this->uri->segment(6);

                if(isset($sfrm_jnsid)){ $frm_jnsid = '='.$sfrm_jnsid; }else{ $frm_jnsid = 'IS NULL'; }
                if(isset($sfrm_kategoriid)){ $frm_kategoriid = '='.$sfrm_kategoriid; }else{ $frm_kategoriid = 'IS NULL'; }
                if(isset($sfrm_kategori2id)){ $frm_kategori2id = '='.$sfrm_kategori2id; }else{ $frm_kategori2id = 'IS NULL'; }

                switch($item){
                    case $item =='allform':
                        $data['judul']   = 'Form Input';
                        $data['Titel']   = 'Form Input';
                        $data['bg']      = 'info';
                        $data['dtforms'] = $this->M_alldata->get_forminput_by($LevelUser,$frm_jnsid,$frm_kategoriid,$frm_kategori2id);
                        $data['aksi']    = 'openfrm';
                        $data['ctr']     ='form_input/C_forminput';
                        $this->load->view('V_allitem', array_merge($data, $data2, $datalv));
                    break;
                    case $item =='alldata':
                        $data['judul']   = 'Monitoring';
                        $data['Titel']   = 'Monitoring';
                        $data['bg']      = 'success';
                        $data['dtforms'] = $this->M_alldata->get_formdata_by($LevelUser,$frm_jnsid,$frm_kategoriid,$frm_kategori2id);
                        $data['aksi']    = 'opendata';
                        $data['ctr']     ='data_harian/C_dataharian';
                        $this->load->view('V_allitem', array_merge($data, $data2, $datalv));
                    break;
                    case $item =='alllap':
                        $data['judul']   = 'Laporan';
                        $data['Titel']   = 'Laporan';
                        $data['bg']      = 'danger';
                        $data['dtforms'] = $this->M_alldata->get_formlap_by($LevelUser,$frm_jnsid,$frm_kategoriid,$frm_kategori2id);
                        $data['aksi']    = 'openlap';
                        $data['ctr']     ='laporan/C_laporan';
                        $this->load->view('V_allitem', array_merge($data, $data2, $datalv));
                    break;
                    case $item =='allapp':
                        $data['judul']   = 'Approval';
                        $data['Titel']   = 'Approval';
                        $data['bg']      = 'danger';
                        $data['dtforms'] = $this->M_alldata->get_app_by($LevelUser,$frm_jnsid);
                        $data['aksi']    = 'openapp';
                        $data['ctr']     ='approval/C_approval';
                        $this->load->view('approval/V_allapp', array_merge($data, $data2, $datalv));
                    break;
                    default:
                    break;
                }
            }else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
            }                
        }

    }