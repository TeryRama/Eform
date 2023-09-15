<?php

class C_flowmeter extends CI_Controller {
    
    var $data = array();
    
    function __construct(){
        
        parent :: __construct();
        $this->load->model(array('M_user', 'M_menu','master/flowmeter/M_flowmeter'));

        $this->load->library(array('table','form_validation','excel','image_lib'));
        $this->load->helper(array('form','url','html','file','path'));        
        $this->db1 = $this->load->database('db1',TRUE);

        //////////////////////////////////
        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $leveluid     = $session_data['leveluserid'];
            $url_str      = uri_string();
            $akses_check  = $this->M_user->check_akses_bylevelid($leveluid,'C_flowmeter');
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
        $data['Titel']          = 'Master - Flow Meter';
        
        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];
        
        $cekLevelUserNm         = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        
        $data['menus']          = $this->M_menu->menus($LevelUser);
        
        $data['list_data']      = $this->M_flowmeter->get_records();
        $data['list_air']       = $this->M_flowmeter->get_list_air();

        $dt_departemen          = $this->M_flowmeter->get_records_payroll();
        $data3                  = array('dt_departemen' => $dt_departemen);

        $dt_dept                = $this->M_flowmeter->dept_lainnya();
        $data4                  = array('dt_dept' => $dt_dept);
        
        $this->load->view('master/flowmeter/V_flowmeter', array_merge($data, $data3, $data4));
    }


    function form(){
        $session_data      = $this->session->userdata('logged_in');
        $mdl1_headerid     = $this->input->post('mdl1_headerid');
        $mdl1_id_jenis_air = $this->input->post('mdl1_id_jenis_air');
        $mdl1_id_dept      = $this->input->post('mdl1_id_dept');
        $mdl1_nama_dept    = $this->input->post('mdl1_nama_dept');
        $mdl1_nama_flow    = $this->input->post('mdl1_nama_flow');
        $mdl1_tgl_efektif  = date("Y-m-d",strtotime($this->input->post('mdl1_tgl_efektif')));

        if ((isset($_POST['btnproses']) && $this->uri->segment(5)=='add') || (isset($_POST['btncopy']) && $this->uri->segment(5)=='update')){
            if($this->M_flowmeter->cek_header($mdl1_id_dept, $mdl1_id_jenis_air, $mdl1_nama_flow, $mdl1_tgl_efektif)->num_rows()==0){ 
                // par default master
                $data['created_userid'] = $session_data['userid'];
                $data['created_by']     = $session_data['nmlengkap'];
                $data['created_date']   = date('Y-m-d');
                $data['created_time']   = date('H:i:s');
                $data['created_comp']   = $_SERVER['REMOTE_ADDR'];
                
                $data['inactive']       = '0';               
                
                // par kebutuhan master
                $data['id_dept']      = $mdl1_id_dept;
                $data['id_jenis_air'] = $mdl1_id_jenis_air;
                $data['nama_dept']    = $mdl1_nama_dept;
                $data['nama_flow']    = $mdl1_nama_flow;
                $data['tgl_efektif']  = $mdl1_tgl_efektif;

                if ($this->M_flowmeter->insert_hdr($data)){
                    if(isset($_POST['btncopy'])){
                        echo "<script>alert('Data berhasil dicopy....!!!! ');</script>";                        
                    }else{
                        echo "<script>alert('Data berhasil disimpan....!!!! ');</script>";                        
                    }
                }
            }else{
                echo '<script>alert("Gagal menyimpan!!!\nData dengan untuk Departemen : '.$mdl1_nama_dept.' nama flow : '.$mdl1_nama_flow.' dan tanggal : '.$mdl1_tgl_efektif.' sudah pernah disimpan.");</script>';
            }

        }else if (isset($_POST['btnproses']) && $this->uri->segment(5)=='update'){
            if($this->M_flowmeter->cek_header2($mdl1_id_dept, $mdl1_id_jenis_air, $mdl1_nama_flow, $mdl1_tgl_efektif, $mdl1_headerid)->num_rows()==0){
                // par default master
                $data['updated_userid'] = $session_data['userid'];
                $data['updated_by']     = $session_data['nmlengkap'];
                $data['updated_date']   = date('Y-m-d');
                $data['updated_time']   = date('H:i:s');
                $data['updated_comp']   = $_SERVER['REMOTE_ADDR'];
                
                // par kebutuhan master
                $data['id_dept']      = $mdl1_id_dept;
                $data['id_jenis_air'] = $mdl1_id_jenis_air;
                $data['nama_dept']    = $mdl1_nama_dept;
                $data['nama_flow']    = $mdl1_nama_flow;
                $data['tgl_efektif']  = $mdl1_tgl_efektif;

                if ($this->M_flowmeter->update_hdr($mdl1_headerid, $data)){
                    echo "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                }
            }else{
                echo '<script>alert("Gagal menyimpan!!!\nData dengan untuk Departemen : '.$mdl1_nama_dept.' nama flow : '.$mdl1_nama_flow.' dan tanggal : '.$mdl1_tgl_efektif.' sudah pernah disimpan.");</script>';
            }
        }else{                
            echo "<script>alert('Gagal, tidak ada aksi!!');</script>";
        }

        redirect('master/flowmeter/C_flowmeter', 'refresh');
        
    }

    function get_dt_update(){   
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $headerid     = $this->input->post('headerid');
            
            $dtdetail     = $this->M_flowmeter->get_records_by($headerid);

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

            if ($this->M_flowmeter->update_hdr($id, $data)){
                redirect('master/flowmeter/C_flowmeter');
            }

        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
    
} ?>