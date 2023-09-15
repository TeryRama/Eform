<?php

class C_supplier extends CI_Controller {
    
    var $data = array();
    
    function __construct(){
        
        parent :: __construct();
        $this->load->model(array('M_user', 'M_menu','master/supplier/M_supplier'));

        $this->load->library(array('table','form_validation','excel','image_lib'));
        $this->load->helper(array('form','url','html','file','path'));        
        $this->db1 = $this->load->database('db1',TRUE);

        //////////////////////////////////
        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $leveluid     = $session_data['leveluserid'];
            $url_str      = uri_string();
            $akses_check  = $this->M_user->check_akses_bylevelid($leveluid,'C_supplier');
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
        $data['Titel']          = 'Master - Departemen Pemakaian Air';
        
        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];
        
        $cekLevelUserNm         = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        
        $data['menus']          = $this->M_menu->menus($LevelUser);
        
        $data['list_data']       = $this->M_supplier->get_records();
        $data['list_flow_meter'] = $this->M_supplier->get_list_flow_meter();
        
        $this->load->view('master/supplier/V_supplier', array_merge($data));
    }

    function form(){
        $session_data = $this->session->userdata('logged_in');
        
        $mdl1_headerid    = $this->input->post('mdl1_headerid');
        $mdl1_tgl_efektif = date("Y-m-d",strtotime($this->input->post('mdl1_tgl_efektif')));
        
        $mdl1_detail_id     = $this->input->post('mdl1_detail_id');
        $mdl1_chk           = $this->input->post('mdl1_chk');
        $mdl1_id_flow_meter = $this->input->post('mdl1_id_flow_meter');

        if ((isset($_POST['btnproses']) && $this->uri->segment(5)=='add') || (isset($_POST['btncopy']) && $this->uri->segment(5)=='update')){

            if($this->M_supplier->cek_header($mdl1_tgl_efektif)->num_rows()==0){
                $data['tgl_efektif']    = $mdl1_tgl_efektif; 
                
                $data['inactive']       = '0';               
                
                $data['created_userid'] = $session_data['userid'];
                $data['created_by']     = $session_data['nmlengkap'];
                $data['created_date']   = date('Y-m-d');
                $data['created_time']   = date('H:i:s');
                $data['created_comp']   = $_SERVER['REMOTE_ADDR'];

                if ($this->M_supplier->insert_hdr($data)){
                    $headerid = $this->db1->insert_id();

                    for($i=0; $i<count($this->input->post('mdl1_id_flow_meter')); $i++){
                        // par default master 
                        $data_detail['headerid'] = $headerid;
                        $data_detail['inactive'] = '0';
                        
                        // par kebutuhan master 
                        $data_detail['id_flow_meter'] = $mdl1_id_flow_meter[$i];
                        
                        $this->M_supplier->insert_dtl($data_detail);
                    }

                    if(isset($_POST['btncopy'])){
                        echo "<script>alert('Data berhasil dicopy....!!!! ');</script>";                        
                    }else{
                        echo "<script>alert('Data berhasil disimpan....!!!! ');</script>";                        
                    }
                }
            }else{
                echo '<script>alert("Gagal menyimpan!!!\nData dengan tanggal : '.$mdl1_tgl_efektif.' sudah pernah disimpan.");</script>';
            }
            

        }else if (isset($_POST['btnproses']) && $this->uri->segment(5)=='update'){
            
               if($this->M_supplier->cek_header2($mdl1_tgl_efektif, $mdl1_headerid)->num_rows()==0){
                $data['tgl_efektif']    = $mdl1_tgl_efektif;             
                
                $data['updated_userid'] = $session_data['userid'];
                $data['updated_by']     = $session_data['nmlengkap'];
                $data['updated_date']   = date('Y-m-d');
                $data['updated_time']   = date('H:i:s');
                $data['updated_comp']   = $_SERVER['REMOTE_ADDR'];

                if ($this->M_supplier->update_hdr($mdl1_headerid, $data)){

                        for($i=0; $i<count($this->input->post('mdl1_id_flow_meter')); $i++){

                        if(isset($mdl1_detail_id[$i])){
                            // par kebutuhan master 
                            $data_detail['id_flow_meter'] = $mdl1_id_flow_meter[$i];       
                            
                            $this->M_supplier->update_dtl($mdl1_detail_id[$i], $data_detail);

                        }else{
                            // par default master 
                            $data_detail['headerid'] = $mdl1_headerid;
                            $data_detail['inactive'] = '0';

                            // par kebutuhan master 
                            $data_detail['id_flow_meter'] = $mdl1_id_flow_meter[$i];
                            
                            $this->M_supplier->insert_dtl($data_detail);
                        }
                    }

                    echo "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                }
            }else{
                echo '<script>alert("Gagal menyimpan!!!\nData dengan tanggal : '.$mdl1_tgl_efektif.' sudah pernah disimpan.");</script>';
            }


        }else if (isset($_POST['btndelete_dtl']) && $this->uri->segment(5)=='update'){            
            $data['updated_userid'] = $session_data['userid'];
            $data['updated_by']     = $session_data['nmlengkap'];
            $data['updated_date']   = date('Y-m-d');
            $data['updated_time']   = date('H:i:s');
            $data['updated_comp']   = $_SERVER['REMOTE_ADDR'];

            if ($this->M_supplier->update_hdr($mdl1_headerid, $data)){

                for($i=0; $i<count($this->input->post('mdl1_chk')); $i++){
                    if(isset($mdl1_chk[$i])){
                        $data_detail['inactive'] = '1';
                        
                        $this->M_supplier->update_dtl($mdl1_chk[$i], $data_detail);
                    }
                }

                echo "<script>alert('Data berhasil dihapus....!!!! ');</script>";
            }
        }else{                
            echo "<script>alert('Gagal, tidak ada aksi!!');</script>";
        }

        redirect('master/supplier/C_supplier', 'refresh');
    }


    function get_dt_update(){   
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $headerid     = $this->input->post('headerid');
            
            $dtdetail     = $this->M_supplier->get_records_dtl($headerid);

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

            if ($this->M_supplier->update_hdr($id, $data)){
                redirect('master/supplier/C_supplier');
            }

        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
    
} ?>