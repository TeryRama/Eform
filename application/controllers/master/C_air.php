<?php

class C_air extends CI_Controller {

    var $data = array();
    
    function __construct(){
        
        parent :: __construct();
        $this->load->model(array('M_user', 'M_menu','master/M_air'));

        $this->load->library(array('table','form_validation','excel','image_lib'));
        $this->load->helper(array('form','url','html','file','path'));        
        $this->db1 = $this->load->database('db1',TRUE);

        //////////////////////////////////
        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $leveluid     = $session_data['leveluserid'];
            $url_str      = uri_string();
            $akses_check  = $this->M_user->check_akses_bylevelid($leveluid,'C_air');
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
        $data['Titel']          = 'Master - Jenis Air';
        
        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];
        
        $cekLevelUserNm         = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        
        $data['menus']          = $this->M_menu->menus($LevelUser);
        
        $data['list_data']      = $this->M_air->get_records();
        $data['list_kode_form'] = $this->M_air->get_list_form();
        
        $this->load->view('master/V_air', array_merge($data));
    }

    function form(){
        if($this->session->userdata('logged_in')){
            $session_data         = $this->session->userdata('logged_in');
            
            $mdl1_headerid        = $this->input->post('mdl1_headerid');    
            $mdl1_air            = $this->input->post('mdl1_air');   
            $mdl1_urutan            = $this->input->post('mdl1_urutan');   
            $mdl1_tgl_efektif     = date("Y-m-d",strtotime($this->input->post('mdl1_tgl_efektif')));

            // if ((isset($_POST['btnproses']) || isset($_POST['btncopy'])) && $this->uri->segment(4)=='add'){
            if ((isset($_POST['btnproses']) && $this->uri->segment(4)=='add') || (isset($_POST['btncopy']) && $this->uri->segment(4)=='update')){
                if($this->M_air->cek_header($mdl1_air, $mdl1_urutan, $mdl1_tgl_efektif)->num_rows()==0){
                    $data['air']             = $mdl1_air; 
                    $data['urutan']             = $mdl1_urutan; 
                    $data['tgl_efektif']     = $mdl1_tgl_efektif;
                    $data['inactive']        = '0';               
                    
                    $data['created_userid']  = $session_data['userid'];
                    $data['created_by']      = $session_data['nmlengkap'];
                    $data['created_date']    = date('Y-m-d');
                    $data['created_time']    = date('H:i:s');
                    $data['created_comp']    = $_SERVER['REMOTE_ADDR'];

                    if ($this->M_air->insert_hdr($data)){
                        if(isset($_POST['btncopy'])){
                            echo "<script>alert('Data berhasil dicopy....!!!! ');</script>";                        
                        }else{
                            echo "<script>alert('Data berhasil disimpan....!!!! ');</script>";                        
                        }
                    }
                }else{
                    echo '<script>alert("Gagal menyimpan!!!\nData dengan air : '.$mdl1_air.', untuk tanggal : '.$mdl1_tgl_efektif.' sudah pernah disimpan.");</script>';
                }
            }else if (isset($_POST['btnproses']) && $this->uri->segment(4)=='update'){
                if($this->M_air->cek_header2($mdl1_air, $mdl1_urutan, $mdl1_tgl_efektif, $mdl1_headerid)->num_rows()==0){
                    $data['air']             = $mdl1_air;
                    $data['urutan']             = $mdl1_urutan;  
                    $data['tgl_efektif']     = $mdl1_tgl_efektif;            
                    
                    $data['updated_userid']  = $session_data['userid'];
                    $data['updated_by']      = $session_data['nmlengkap'];
                    $data['updated_date']    = date('Y-m-d');
                    $data['updated_time']    = date('H:i:s');
                    $data['updated_comp']    = $_SERVER['REMOTE_ADDR'];

                    if ($this->M_air->update_hdr($mdl1_headerid, $data)){
                        echo "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                    }
                }else{
                    echo '<script>alert("Gagal menyimpan!!!\nData dengan air : '.$mdl1_air.', untuk tanggal : '.$mdl1_tgl_efektif.' sudah pernah disimpan.");</script>';
                }
            }else{                
                echo "<script>alert('Gagal, tidak ada aksi!!');</script>";
            }

            redirect('master/C_air', 'refresh');
        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_dt_update(){   
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $headerid     = $this->input->post('headerid');
            
            $dtdetail     = $this->M_air->get_records_by($headerid);

            if(count($dtdetail)>0){
                $hasil = array(
                                'status'  => 0,
                                'vstatus' => 'berhasil',
                                'pesan'   => 'berhasil',
                                'data'    => $dtdetail,
                            );
            }else{
                $hasil = array(
                                'status'  => 1,
                                'vstatus' => 'gagal',
                                'pesan'   => 'Data detail tidak ditemukan!!!',
                            );

            }

            echo json_encode($hasil);

        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function delete($id){
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            
            $data['inactive']       = '1';            
            
            $data['updated_userid'] = $session_data['userid'];
            $data['updated_by']     = $session_data['nmlengkap'];
            $data['updated_date']   = date('Y-m-d');
            $data['updated_time']   = date('H:i:s');
            $data['updated_comp']   = $_SERVER['REMOTE_ADDR'];

            if ($this->M_air->update_hdr($id, $data)){
                redirect('master/C_air');
            }

        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}
?>