<?php

class C_managemen_lab extends CI_Controller {

	var $data = array();

	function __construct() {

		parent :: __construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1',TRUE);    
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper('path');

		$this->load->model(array('M_menu','master/M_form','form_input/M_forminput','tambahan/lain_lain/M_managemen_lab'));
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

	}

	function getall() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['password'] = $session_data['password'];
            $data['jabid'] = $session_data['jabid'];
            $data['leveluserid'] = $session_data['leveluserid'];
            $data['nmdepan'] = $session_data['nmdepan'];
            $data['levelusernm'] = $session_data['levelusernm'];
            $data['bagnm'] = $session_data['bagnm'];
            $data['jabnm'] = $session_data['jabnm'];
            $data['Titel'] = 'Home';

            $LevelUser = $session_data['leveluserid'];
            $UserName = $session_data['username'];
            $LevelUserNm = $session_data['levelusernm'];

            $cekLevelUserNm = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);

            $file_kategori    = $this->uri->segment(5);
            $file_kategorisub = $this->uri->segment(6);

            $data['file_kategori']    = $this->uri->segment(5);
            $data['file_kategorisub']   = $this->uri->segment(6);

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $all_dokumen      = $this->M_managemen_lab->get_all_dokumen($file_kategori,$file_kategorisub);
            $data_all_dokumen = array('all_dokumen' => $all_dokumen);

            $this->load->view('tambahan/lain_lain/V_managemen_lab', array_merge($data,$data2, $data_all_dokumen));
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function adddocument() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['password'] = $session_data['password'];
            $data['jabid'] = $session_data['jabid'];
            $data['leveluserid'] = $session_data['leveluserid'];
            $data['nmdepan'] = $session_data['nmdepan'];
            $data['levelusernm'] = $session_data['levelusernm'];
            $data['bagnm'] = $session_data['bagnm'];
            $data['jabnm'] = $session_data['jabnm'];
            $data['Titel'] = 'Home';

            $LevelUser = $session_data['leveluserid'];
            $UserName = $session_data['username'];
            $LevelUserNm = $session_data['levelusernm'];

            $cekLevelUserNm = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $val_id = $this->input->post('id');
            $arr_id = explode('//', $val_id);

            $id               = $arr_id[0];
            $file_kategori    = $arr_id[1];
            $file_kategorisub = $arr_id[2];

             if($id=='0'){
                echo $html_dok = '<div class="form-group">
                              <label for="modal_bagian" class="text-primary col-sm-4 control-label" style="text-align:left;">File Description</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="file_id" id="file_id" class="form-control" value=""/>
                                  <input type="hidden" name="file_kategori" id="file_kategori" class="form-control" value="'.$file_kategori.'"/>
                                  <input type="hidden" name="file_kategorisub" id="file_kategorisub" class="form-control" value="'.$file_kategorisub.'"/>
                                  <input type="hidden" name="modal_aksi" id="modal_aksi" class="form-control" value="add"/>
                                  <input type="text" name="file_description" id="file_description" class="form-control" value=""/>
                              </div>
                            </div>
                            <br/>
                            <div class="form-group">
                              <label for="modal_bagian" class="text-primary col-sm-4 control-label" style="text-align:left;">File Number</label>
                              <div class="col-sm-8">
                                  <input type="text" name="file_no" id="file_no" class="form-control" value=""/>
                              </div>
                            </div>
                            <br/>
                            <div class="form-group">
                              <label for="modal_form_kategori" class="text-primary col-sm-4 control-label" style="text-align:left;">File</label>
                              <div class="col-sm-8">
                                  <input type="file" name="file" id="file" class="form-control" >
                              </div>
                            </div>';
            }else{
                $data_dok = $this->M_managemen_lab->get_dokumen_byid($id);
                foreach($data_dok as $row){
                     $file_id          = $row->file_id;
                     $file_description = $row->file_description;
                     $file_ext         = $row->file_ext;  
                     $file_no          = $row->file_no;  
                     $file_kategori    = $row->file_kategori;  
                     $file_kategorisub = $row->file_kategorisub;     
                }
                echo $html_dok = '<div class="form-group">
                              <label for="modal_bagian" class="text-primary col-sm-4 control-label" style="text-align:left;">File Description</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="file_id" id="file_id" class="form-control" value="'.$file_id.'"/>
                                  <input type="hidden" name="file_kategori" id="file_kategori" class="form-control" value="'.$file_kategori.'"/>
                                  <input type="hidden" name="file_kategorisub" id="file_kategorisub" class="form-control" value="'.$file_kategorisub.'"/>
                                  <input type="hidden" name="modal_aksi" id="modal_aksi" class="form-control" value="add"/>
                                  <input type="text" name="file_description" id="file_description" class="form-control" value="'.$file_description.'"/>
                              </div>
                            </div>
                            <br/>
                            <div class="form-group">
                              <label for="modal_bagian" class="text-primary col-sm-4 control-label" style="text-align:left;">File Number</label>
                              <div class="col-sm-8">
                                  <input type="text" name="file_no" id="file_no" class="form-control" value="'.$file_no.'"/>
                              </div>
                            </div>
                            <br/>
                            <div class="form-group">
                              <label for="modal_form_kategori" class="text-primary col-sm-4 control-label" style="text-align:left;">File</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="file_ext" id="file_ext" class="form-control" value="'.$file_ext.'">
                                  <input type="file" name="file" id="file" class="form-control" >
                              </div>
                            </div>';
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function savedokumen(){
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
            $data['on_audit']       = $session_data['on_audit'];

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            $Bagian                 = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $aksi = 'add';

           if($aksi=='add'){
                $modal_file_id                 = $this->input->post('file_id');
                $modal_file_kategori           = $this->input->post('file_kategori');
                $val_modal_file_kategorisub    = $this->input->post('file_kategorisub');
                $modal_file_description        = $this->input->post('file_description');
                $modal_file_ext                = $this->input->post('file_ext');
                $modal_file_no                 = $this->input->post('file_no');
                $modal_create_by               = $UserName;
                $modal_create_date             = date('Y-m-d');
                $modal_create_time             = date('H:i:s');
                $modal_create_comp             = gethostbyaddr($_SERVER['REMOTE_ADDR']);

                if($val_modal_file_kategorisub!='-'){$modal_file_kategorisub=$val_modal_file_kategorisub;}else{$modal_file_kategorisub=NULL;}

                $file_ext = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
                $file_size = $_FILES ['file'] ['size'];

                if($modal_file_id==''){
                    if($file_ext=='gif'||$file_ext=='jpg'||$file_ext=='jpeg'||$file_ext=='pdf'||$file_ext=='PDF'||$file_ext=='doc'||$file_ext=='docx'||$file_ext=='xml'||$file_ext=='xls'||$file_ext=='xlsx'){
                           if($file_size <= 4000000){
                                $data_dokumen=array(
                                    'file_description'      => $modal_file_description,
                                    'file_ext'              => $file_ext,
                                    'create_by'             => $modal_create_by,
                                    'create_date'           => $modal_create_date,
                                    'create_time'           => $modal_create_time,
                                    'create_comp'           => $modal_create_comp,
                                    'file_no'               => $modal_file_no,
                                    'file_kategori'         => $modal_file_kategori,
                                    'file_kategorisub'      => $modal_file_kategorisub
                                );
                                $this->M_managemen_lab->insert_data($data_dokumen);

                                $maxid = $this->db1->insert_id();

                                $file = '/var/www/html/foruploads';

                                $config =  array(
                                    // 'upload_path'     => './uploadfile_managemen_lab',
                                    'upload_path'     => set_realpath($file),
                                    'allowed_types'   => "gif|jpg|png|jpeg|pdf|PDF|doc|docx|xml|xls|xlsx",
                                    'overwrite'       => TRUE,
                                    'encrypt_name'    => FALSE,
                                    'max_size'        => "4000000",
                                    'max_height'      => "768",
                                    'max_width'       => "1024"
                                );

                                $new_name = $maxid;
                                $config['file_name'] = $new_name;

                                $this->load->library('upload', $config);
                                $files = $_FILES;

                                $_FILES ['file'] ['name']       = $files ['file'] ['name'];
                                $_FILES ['file'] ['type']       = $files ['file'] ['type'];
                                $_FILES ['file'] ['tmp_name']   = $files ['file'] ['tmp_name'];
                                $_FILES ['file'] ['error']      = $files ['file'] ['error'];
                                $_FILES ['file'] ['size']       = $files ['file'] ['size'];

                                $this->upload->do_upload('file');

                                $pesan_alert = "Data Berhasil Disimpan...!!"; 
                           }else{
                               $pesan_alert = "Maaf Size File Yang Diupload : $file_size KB, Melebihi Batas Maksimal Yakni 4000000 KB..!!";
                           }
                                 
                    }else{
                        $pesan_alert = "Maaf File Dengan Extention : $file_ext Tidak Bisa Disimpan..!!";      
                    }
                }else{
                    if($file_ext=='gif'||$file_ext=='jpg'||$file_ext=='jpeg'||$file_ext=='pdf'||$file_ext=='doc'||$file_ext=='docx'||$file_ext=='xml'||$file_ext=='xls'||$file_ext=='xlsx'){
                            if($file_size <= 4000000){
                                if(empty($_FILES['file']['name'])){
                                    $data_dokumen=array(
                                        'file_description'      => $modal_file_description,
                                        'file_ext'              => $modal_file_ext,
                                        'update_by'             => $modal_create_by,
                                        'update_date'           => $modal_create_date,
                                        'update_time'           => $modal_create_time,
                                        'update_comp'           => $modal_create_comp,
                                        'file_no'               => $modal_file_no,
                                        'file_kategori'         => $modal_file_kategori,
                                        'file_kategorisub'      => $modal_file_kategorisub
                                    );
                                    $this->M_managemen_lab->update_data($modal_file_id, $data_dokumen);   

                                    $pesan_alert = "Data Berhasil Disimpan...!!"; 
                                }else{
                                    $file_ext = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
                                    if($file_ext == $modal_file_ext){
                                        $modal_file_ext_update = $modal_file_ext; 
                                    }else{
                                        $modal_file_ext_update =  $file_ext;  
                                        $file = '/var/www/html/foruploads';
                                        if (file_exists("/var/www/html/foruploads/".$modal_file_id.'.'.$modal_file_ext)){
                                            unlink("/var/www/html/foruploads/".$modal_file_id.'.'.$modal_file_ext);
                                        }else{} 
                                    }
                                    
                                    $data_dokumen=array(
                                            'file_description'      => $modal_file_description,
                                            'file_ext'              => $modal_file_ext_update,
                                            'update_by'             => $modal_create_by,
                                            'update_date'           => $modal_create_date,
                                            'update_time'           => $modal_create_time,
                                            'update_comp'           => $modal_create_comp,
                                            'file_no'               => $modal_file_no,
                                            'file_kategori'         => $modal_file_kategori,
                                            'file_kategorisub'      => $modal_file_kategorisub
                                    );   

                                    $this->M_managemen_lab->update_data($modal_file_id, $data_dokumen);  

                                    $file = '/var/www/html/foruploads';

                                    $config =  array(
                                        // 'upload_path'     => './uploadfile_managemen_lab',
                                        'upload_path'     => set_realpath($file),
                                        'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|docx|xml|xls|xlsx",
                                        'overwrite'       => TRUE,
                                        'encrypt_name'    => FALSE,
                                        'max_size'        => "4000000",
                                        'max_height'      => "768",
                                        'max_width'       => "1024"
                                    );

                                    $new_name = $modal_file_id;
                                    $config['file_name'] = $new_name;

                                    $this->load->library('upload', $config);
                                    $files = $_FILES;

                                    $_FILES ['file'] ['name']       = $files ['file'] ['name'];
                                    $_FILES ['file'] ['type']       = $files ['file'] ['type'];
                                    $_FILES ['file'] ['tmp_name']   = $files ['file'] ['tmp_name'];
                                    $_FILES ['file'] ['error']      = $files ['file'] ['error'];
                                    $_FILES ['file'] ['size']       = $files ['file'] ['size'];

                                    $this->upload->do_upload('file');    

                                    $pesan_alert = "Data Berhasil Disimpan...!!";   
                                }     
                            }else{
                                $pesan_alert = "Maaf Size File Yang Diupload : $file_size KB, Melebihi Batas Maksimal Yakni 4000000 KB..!!";     
                            }
                                   
                    }else{
                        $pesan_alert = "Maaf File Dengan Extention : $file_ext Tidak Bisa Disimpan..!!";      
                    }        
                }
                echo $pesan = '//'.$pesan_alert.'//'.$modal_file_kategori.'//'.$modal_file_kategorisub.'//';

           }else{
             $pesan_alert = "No Action...!!";

                echo $pesan = '//'.$pesan_alert.'//'.$modal_file_kategori.'//'.$modal_file_kategorisub.'//';   
           }

            
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function delete_dokumen(){
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
            $data['on_audit']       = $session_data['on_audit'];

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            $Bagian                 = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            //$id = $this->input->post('id');
            $id       = $this->input->post('id');
            $ext       = $this->input->post('ext');
            $file_kategori    = $this->input->post('file_kategori');
            $file_kategorisub = $this->input->post('file_kategorisub');
            
            if(trim($id)!=''){
                 $deleted_dok = $this->M_managemen_lab->delete_detail($id);
                 $file = '/var/www/html/foruploads';
                    if (file_exists("/var/www/html/foruploads/".$id.'.'.$ext)){
                        unlink("/var/www/html/foruploads/".$id.'.'.$ext);
                        $pesan_alert = "Data Berhasil Dihapus...!!"; 
                    }else{
                        $pesan_alert = "Dokumen Batal DiHapus...!!"; 
                    }
            }else{
               $pesan_alert = "Data Batal Dihapus...!!";     
            }
    
            echo $pesan = '//'.$pesan_alert.'//'.$file_kategori.'//'.$file_kategorisub.'//'; 
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }


}