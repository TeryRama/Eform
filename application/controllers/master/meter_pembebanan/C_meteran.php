<?php

class C_meteran extends CI_Controller {
    
    var $data = array();
    
    function __construct(){
        
        parent :: __construct();
        $this->load->model(array('M_user', 'M_menu','master/meter_pembebanan/M_meteran'));

        $this->load->library(array('table','form_validation','excel','image_lib'));
        $this->load->helper(array('form','url','html','file','path'));        
        $this->db1 = $this->load->database('db1',TRUE);

        //////////////////////////////////
        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $leveluid     = $session_data['leveluserid'];
            $url_str      = uri_string();
            $akses_check  = $this->M_user->check_akses_bylevelid($leveluid,'C_meteran');
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
        
        $data['list_data']       = $this->M_meteran->get_records();
        $data['list_flow_meter'] = $this->M_meteran->get_list_flow_meter();
        $data['list_dept']       = $this->M_meteran->get_list_dept();
        $data['list_panel']      = $this->M_meteran->get_list_panel();
        
        $this->load->view('master/meter_pembebanan/V_meteran', array_merge($data));
    }

    function form(){
        $session_data       = $this->session->userdata('logged_in');
        
        $mdl1_headerid      = $this->input->post('mdl1_headerid');
        $mdl1_tgl_efektif   = date("Y-m-d",strtotime($this->input->post('mdl1_tgl_efektif')));
        
        $mdl1_detail_id          = $this->input->post('mdl1_detail_id');
        $mdl1_chk                = $this->input->post('mdl1_chk');
        $mdl1_kode_kwh           = $this->input->post('mdl1_kode_kwh');
        $mdl1_ratio_ct           = $this->input->post('mdl1_ratio_ct');
        $mdl1_read_ct            = $this->input->post('mdl1_read_ct');
        $mdl1_nama_meteran       = $this->input->post('mdl1_nama_meteran');
        $mdl1_status_beban       = $this->input->post('mdl1_status_beban');
        $mdl1_panel_induk        = $this->input->post('mdl1_panel_induk');
        $mdl1_dept_pengguna      = $this->input->post('mdl1_dept_pengguna');
        $mdl1_panel_lokasi       = $this->input->post('mdl1_panel_lokasi');
        $mdl1_beban_tetap        = $this->input->post('mdl1_beban_tetap');
        $mdl1_persen_beban_tetap = $this->input->post('mdl1_persen_beban_tetap');
        $mdl1_keterangan         = $this->input->post('mdl1_keterangan');

        if ((isset($_POST['btnproses']) && $this->uri->segment(5)=='add') || (isset($_POST['btncopy']) && $this->uri->segment(5)=='update')){

            if($this->M_meteran->cek_header($mdl1_tgl_efektif)->num_rows()==0){
                $data['tgl_efektif']    = $mdl1_tgl_efektif; 
                
                $data['inactive']       = '0';               
                
                $data['created_userid'] = $session_data['userid'];
                $data['created_by']     = $session_data['nmlengkap'];
                $data['created_date']   = date('Y-m-d');
                $data['created_time']   = date('H:i:s');
                $data['created_comp']   = $_SERVER['REMOTE_ADDR'];

                if ($this->M_meteran->insert_hdr($data)){
                    $headerid = $this->db1->insert_id();

                    for($i=0; $i<count($this->input->post('mdl1_kode_kwh')); $i++){
                        // par default master 
                        $data_detail['headerid']        = $headerid;
                        $data_detail['inactive']        = '0';
                        
                        // par kebutuhan master 
                        $data_detail['kode_kwh']           = $mdl1_kode_kwh[$i];
                        $data_detail['ratio_ct']           = $mdl1_ratio_ct[$i];
                        $data_detail['read_ct']            = $mdl1_read_ct[$i];
                        $data_detail['nama_meteran']       = $mdl1_nama_meteran[$i];
                        $data_detail['status_beban']       = $mdl1_status_beban[$i];
                        $data_detail['panel_induk']        = $mdl1_panel_induk[$i];
                        $data_detail['dept_pengguna']      = $mdl1_dept_pengguna[$i];
                        $data_detail['panel_lokasi']       = $mdl1_panel_lokasi[$i];
                        $data_detail['beban_tetap']        = $mdl1_beban_tetap[$i];
                        $data_detail['persen_beban_tetap'] = $mdl1_persen_beban_tetap[$i];
                        $data_detail['keterangan']         = $mdl1_keterangan[$i];
                        
                        $this->M_meteran->insert_dtl($data_detail);
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
            
               if($this->M_meteran->cek_header2($mdl1_tgl_efektif, $mdl1_headerid)->num_rows()==0){
                $data['tgl_efektif']    = $mdl1_tgl_efektif;             
                
                $data['updated_userid'] = $session_data['userid'];
                $data['updated_by']     = $session_data['nmlengkap'];
                $data['updated_date']   = date('Y-m-d');
                $data['updated_time']   = date('H:i:s');
                $data['updated_comp']   = $_SERVER['REMOTE_ADDR'];

                if ($this->M_meteran->update_hdr($mdl1_headerid, $data)){

                        for($i=0; $i<count($this->input->post('mdl1_kode_kwh')); $i++){

                        if(isset($mdl1_detail_id[$i])) {
                            // par kebutuhan master 
                            $data_detail['kode_kwh']           = $mdl1_kode_kwh[$i];
                            $data_detail['ratio_ct']           = $mdl1_ratio_ct[$i];
                            $data_detail['read_ct']            = $mdl1_read_ct[$i];
                            $data_detail['nama_meteran']       = $mdl1_nama_meteran[$i];
                            $data_detail['status_beban']       = $mdl1_status_beban[$i];
                            $data_detail['panel_induk']        = $mdl1_panel_induk[$i];
                            $data_detail['dept_pengguna']      = $mdl1_dept_pengguna[$i];
                            $data_detail['panel_lokasi']       = $mdl1_panel_lokasi[$i];
                            $data_detail['beban_tetap']        = $mdl1_beban_tetap[$i];
                            $data_detail['persen_beban_tetap'] = $mdl1_persen_beban_tetap[$i];
                            $data_detail['keterangan']         = $mdl1_keterangan[$i];
                            
                            $this->M_meteran->update_dtl($mdl1_detail_id[$i], $data_detail);

                        }else{
                            // par default master 
                            $data_detail['headerid'] = $mdl1_headerid;
                            $data_detail['inactive'] = '0';

                            // par kebutuhan master 
                            $data_detail['kode_kwh']           = $mdl1_kode_kwh[$i];
                            $data_detail['ratio_ct']           = $mdl1_ratio_ct[$i];
                            $data_detail['read_ct']            = $mdl1_read_ct[$i];
                            $data_detail['nama_meteran']       = $mdl1_nama_meteran[$i];
                            $data_detail['status_beban']       = $mdl1_status_beban[$i];
                            $data_detail['panel_induk']        = $mdl1_panel_induk[$i];
                            $data_detail['dept_pengguna']      = $mdl1_dept_pengguna[$i];
                            $data_detail['panel_lokasi']       = $mdl1_panel_lokasi[$i];
                            $data_detail['beban_tetap']        = $mdl1_beban_tetap[$i];
                            $data_detail['persen_beban_tetap'] = $mdl1_persen_beban_tetap[$i];
                            $data_detail['keterangan']         = $mdl1_keterangan[$i];
                            
                            $this->M_meteran->insert_dtl($data_detail);
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

            if ($this->M_meteran->update_hdr($mdl1_headerid, $data)){

                for($i=0; $i<count($this->input->post('mdl1_chk')); $i++){
                    if(isset($mdl1_chk[$i])){
                        $data_detail['inactive'] = '1';
                        
                        $this->M_meteran->update_dtl($mdl1_chk[$i], $data_detail);
                    }
                }

                echo "<script>alert('Data berhasil dihapus....!!!! ');</script>";
            }
        }else{                
            echo "<script>alert('Gagal, tidak ada aksi!!');</script>";
        }

        redirect('master/meter_pembebanan/C_meteran', 'refresh');
    }


    function get_dt_update(){   
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $headerid     = $this->input->post('headerid');
            
            $dtdetail     = $this->M_meteran->get_records_dtl($headerid);

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

            if ($this->M_meteran->update_hdr($id, $data)){
                redirect('master/meter_pembebanan/C_meteran');
            }

        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
    
}
