<?php

class C_ketidaksesuaian extends CI_Controller {

	var $data = array();

	function __construct() {

		parent :: __construct();

		$this->load->helper(array('form','url','html','file'));
    $this->load->helper('path');
		$this->load->library(array('form_validation','user_agent'));

		$this->load->model(array('M_user','M_menu','tambahan/lain_lain/M_ketidaksesuaian'));

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
            $data['on_audit']       = $session_data['on_audit'];
            
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            $Bagian                 = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $result_jadwal = $this->M_user->check_jadwal_audit();
            if($result_jadwal){
              $on_audit ='1';
              $data['on_audit']       = '1';
            }else{
              $on_audit ='0'; 
              $data['on_audit']       = '0'; 
            }

            $ketidaksesuaian      = $this->M_ketidaksesuaian->get_ketidaksesuaian($on_audit);
            $data_ketidaksesuaian = array('ketidaksesuaian' => $ketidaksesuaian);

            $data['date_from']          = date('Y-m-01');
            $data['date_to']            = date('Y-m-t');

            $this->load->view('tambahan/lain_lain/V_ketidaksesuaian', array_merge($data, $data2, $data_ketidaksesuaian));

        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }

    function get_by_date() {
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

            $date_from    = $this->input->post('date_from');
            $date_to      = $this->input->post('date_to');
            
            $result_jadwal = $this->M_user->check_jadwal_audit();
            if($result_jadwal){
              $on_audit ='1';
              $data['on_audit']       = '1';
            }else{
              $on_audit ='0'; 
              $data['on_audit']       = '0'; 
            }

            $ketidaksesuaian      = $this->M_ketidaksesuaian->get_ketidaksesuaian_bydate($date_from, $date_to,$on_audit);
            $data_ketidaksesuaian = array('ketidaksesuaian' => $ketidaksesuaian);

            $data['date_from']          = $date_from;
            $data['date_to']            = $date_to;

            $this->load->view('tambahan/lain_lain/V_ketidaksesuaian', array_merge($data, $data2, $data_ketidaksesuaian));

        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }

    function addreport(){
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

            /*echo "<script>alert('test....!!!! ');</script>";*/
            $id = $this->input->post('id');

            if($id=='0'){
                echo $html_nc = '<div class="form-group">
                              <label for="modal_bagian" class="text-primary col-sm-4 control-label" style="text-align:left;">Bagian</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="modal_id" id="modal_id" class="form-control" value=""/>
                                  <input type="hidden" name="modal_aksi" id="modal_aksi" class="form-control" value="add"/>
                                  <select name="modal_bagian" id="modal_bagian" class="form-control">
                                      <option value="">- pilih -</option>
                                      <option value="Form Lab Kimia">Form Lab Kimia</option>
                                      <option value="Form Lab Kimia & Mikro">Form Lab Kimia & Mikro</option>
                                      <option value="Form Lab Kimia, Mikro & Monitoring">Form Lab Kimia, Mikro & Monitoring</option>
                                      <option value="Form Lab Mikro">Form Lab Mikro</option>
                                      <option value="Form Monitoring">Form Monitoring</option>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_form_kategori" class="text-primary col-sm-4 control-label" style="text-align:left;">Form Kategori</label>
                              <div class="col-sm-8">
                                  <select name="modal_form_kategori" id="modal_form_kategori" class="form-control">
                                      <option value="">- pilih -</option>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_form_subkategori" class="text-primary col-sm-4 control-label" style="text-align:left;">Form Sub Kategori</label>
                              <div class="col-sm-8">
                                  <select name="modal_form_subkategori" id="modal_form_subkategori" class="form-control">
                                      <option value="">- pilih -</option>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_form_kode" class="text-primary col-sm-4 control-label" style="text-align:left;">Form Nama</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="modal_form_nama" id="modal_form_nama" class="form-control" value=""/>
                                  <select name="modal_form_kode" id="modal_form_kode" class="form-control">
                                      <option value="">- pilih -</option>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_form_versi" class="text-primary col-sm-4 control-label" style="text-align:left;">Form Versi</label>
                              <div class="col-sm-8">
                                  <select name="modal_form_versi" id="modal_form_versi" class="form-control">
                                      <option value="">- pilih -</option>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_form_judul" class="text-primary col-sm-4 control-label" style="text-align:left;">Form Judul</label>
                              <div class="col-sm-8">
                                  <input type="text" name="modal_form_judul" id="modal_form_judul" class="form-control" readonly/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="userfile" class="text-primary col-sm-4 control-label" style="text-align:left;">Upload Foto</label>
                              <div class="col-sm-8">
                                  <input type="file" name="userfile" id="userfile" class="userfile" value="" style="text-align: center;" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_ketidaksesuaian" class="text-primary col-sm-4 control-label" style="text-align:left;">Ketidaksesuaian</label>
                              <div class="col-sm-8">
                                  <textarea name="modal_ketidaksesuaian" id="modal_ketidaksesuaian" class="form-control" rows="3" placeholder="Deskripsi Ketidaksesuaian"></textarea>
                              </div>
                            </div>';
            }else{

                $data_report = $this->M_ketidaksesuaian->get_ketidaksesuaian_byid($id);

                foreach($data_report as $data_report_row){
                    $report_date         = $data_report_row->report_date;
                    $report_time         = $data_report_row->report_time;
                    $report_by           = $data_report_row->report_by;
                    $bagian              = $data_report_row->bagian;
                    $form_kode           = $data_report_row->form_kode;   
                    $form_versi          = $data_report_row->form_versi;
                    $form_judul          = $data_report_row->form_judul;
                    $ketidaksesuaian     = $data_report_row->ketidaksesuaian;
                    $fotoKetidaksesuaian = $data_report_row->foto_ketidaksesuaian;
                    $form_kategori       = $data_report_row->form_kategori;
                    $form_subkategori    = $data_report_row->form_subkategori;
                    $form_nama           = $data_report_row->form_nama;
                }

                if($bagian=='Form Lab Kimia'){
                    $ops1_a = '';
                    $ops1_b = 'selected';
                    $ops1_c = '';
                    $ops1_d = '';
                    $ops1_e = '';
                    $ops1_f = '';
                }else if($bagian=='Form Lab Kimia & Mikro'){
                    $ops1_a = '';
                    $ops1_b = '';
                    $ops1_c = 'selected';
                    $ops1_d = '';
                    $ops1_e = '';
                    $ops1_f = '';
                }else if($bagian=='Form Lab Kimia, Mikro & Monitoring'){
                    $ops1_a = '';
                    $ops1_b = '';
                    $ops1_c = '';
                    $ops1_d = 'selected';
                    $ops1_e = '';
                    $ops1_f = '';
                }else if($bagian=='Form Lab Mikro'){
                    $ops1_a = '';
                    $ops1_b = '';
                    $ops1_c = '';
                    $ops1_d = '';
                    $ops1_e = 'selected';
                    $ops1_f = '';
                }else if($bagian=='Form Monitoring'){
                    $ops1_a = '';
                    $ops1_b = '';
                    $ops1_c = '';
                    $ops1_d = '';
                    $ops1_e = '';
                    $ops1_f = 'selected';
                }else{
                    $ops1_a = '';
                    $ops1_b = '';
                    $ops1_c = '';
                    $ops1_d = '';
                    $ops1_e = '';
                    $ops1_f = '';
                }

                $result_kategori = $this->M_ketidaksesuaian->get_kategori($bagian);
                $arr_kategori = '';
                foreach($result_kategori as $result_kategori_row){
                    if($result_kategori_row->formkategorinm==$form_kategori){$select_kategori='selected';}else{$select_kategori='';}
                    if(trim($result_kategori_row->formkategorinm)==''){
                        $arr_kategori .= "<option value='-' selected>-</option>";
                    }else{
                        $arr_kategori .= "<option value='".$result_kategori_row->formkategorinm."' ".$select_kategori.">".$result_kategori_row->formkategorinm."</option>";
                    }
                }

                $result_subkategori = $this->M_ketidaksesuaian->get_subkategori($bagian, $form_kategori);
                $arr_subkategori='';
                foreach($result_subkategori as $result_subkategori_row){
                    if($result_subkategori_row->formkategori2nm==$form_subkategori){$select_subkategori='selected';}else{$select_subkategori='';}
                    if(trim($result_subkategori_row->formkategori2nm)==''){
                        $arr_subkategori .= "<option value='-' selected>-</option>";
                    }else{
                        $arr_subkategori .= "<option value='".$result_subkategori_row->formkategori2nm."' ".$select_subkategori.">".$result_subkategori_row->formkategori2nm."</option>";
                    }
                }

                $result_formkode = $this->M_ketidaksesuaian->get_formkode($bagian, $form_kategori, $form_subkategori);
                $arr_formkode='';
                foreach($result_formkode as $result_formkode_row){
                    if($result_formkode_row->formkd==$form_kode){$select_formkode='selected';}else{$select_formkode='';}
                    if(trim($result_formkode_row->formkd)==''){
                        $arr_formkode .= "<option value='-' selected>-</option>";
                    }else{
                        $arr_formkode .= "<option value='".$result_formkode_row->formkd."' ".$select_formkode.">".$result_formkode_row->formnm."</option>";
                    }
                }

                $result_formversi = $this->M_ketidaksesuaian->get_formversi($form_kode);
                $arr_formversi='';
                foreach($result_formversi as $result_formversi_row){
                    if($result_formversi_row->formversi==$form_versi){$select_formversi='selected';}else{$select_formversi='';}
                    if(trim($result_formversi_row->formversi)==''){
                        $arr_formversi .= "<option value='-' selected>-</option>";
                    }else{
                        $arr_formversi .= "<option value='".$result_formversi_row->formversi."' ".$select_formversi.">".$result_formversi_row->formversi."</option>";
                    }
                }

                echo $html_nc = '<div class="form-group">
                              <label for="modal_bagian" class="text-primary col-sm-4 control-label" style="text-align:left;">Bagian</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="modal_id" id="modal_id" class="form-control" value="'.$id.'"/>
                                  <input type="hidden" name="modal_aksi" id="modal_aksi" class="form-control" value="add"/>
                                  <select name="modal_bagian" id="modal_bagian" class="form-control">
                                      <option value="" '.$ops1_a.'>- pilih -</option>
                                      <option value="Form Lab Kimia" '.$ops1_b.'>Form Lab Kimia</option>
                                      <option value="Form Lab Kimia & Mikro" '.$ops1_c.'>Form Lab Kimia & Mikro</option>
                                      <option value="Form Lab Kimia, Mikro & Monitoring" '.$ops1_d.'>Form Lab Kimia, Mikro & Monitoring</option>
                                      <option value="Form Lab Mikro" '.$ops1_e.'>Form Lab Mikro</option>
                                      <option value="Form Monitoring" '.$ops1_f.'>Form Monitoring</option>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_form_kategori" class="text-primary col-sm-4 control-label" style="text-align:left;">Form Kategori</label>
                              <div class="col-sm-8">
                                  <select name="modal_form_kategori" id="modal_form_kategori" class="form-control">
                                      <option value="">- pilih -</option>'.$arr_kategori.'
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_form_subkategori" class="text-primary col-sm-4 control-label" style="text-align:left;">Form Sub Kategori</label>
                              <div class="col-sm-8">
                                  <select name="modal_form_subkategori" id="modal_form_subkategori" class="form-control">
                                      <option value="">- pilih -</option>'.$arr_subkategori.'
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_form_kode" class="text-primary col-sm-4 control-label" style="text-align:left;">Form Nama</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="modal_form_nama" id="modal_form_nama" class="form-control" value=""/>
                                  <select name="modal_form_kode" id="modal_form_kode" class="form-control">
                                      <option value="">- pilih -</option>'.$arr_formkode.'
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_form_versi" class="text-primary col-sm-4 control-label" style="text-align:left;">Form Versi</label>
                              <div class="col-sm-8">
                                  <select name="modal_form_versi" id="modal_form_versi" class="form-control">
                                      <option value="">- pilih -</option>'.$arr_formversi.'
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_form_judul" class="text-primary col-sm-4 control-label" style="text-align:left;">Form Judul</label>
                              <div class="col-sm-8">
                                  <input type="text" name="modal_form_judul" id="modal_form_judul" class="form-control" value="'.$form_judul.'" readonly/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="userfile" class="text-primary col-sm-4 control-label" style="text-align:left;">Upload Foto</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="userfile_tampil[]" id="userfile_tampil" value="'.$fotoKetidaksesuaian.'"/>
                                  <input type="file" name="userfile" id="userfile" value="" multiple="multiple" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_ketidaksesuaian" class="text-primary col-sm-4 control-label" style="text-align:left;">Ketidaksesuaian</label>
                              <div class="col-sm-8">
                                  <textarea name="modal_ketidaksesuaian" id="modal_ketidaksesuaian" class="form-control" rows="3" placeholder="Deskripsi Ketidaksesuaian">'.$ketidaksesuaian.'</textarea>
                              </div>
                            </div>';

            }
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function addaction(){
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

            $id = $this->input->post('id');

            $data_action = $this->M_ketidaksesuaian->get_ketidaksesuaian_byid($id);

            foreach($data_action as $data_action_row){
                $action_status = $data_action_row->action_status;
                $action_ket = $data_action_row->action_ket;
            }

            if($action_status=='On Progress'){
                $ops0 = '';
                $ops1 = 'selected';
                $ops2 = '';
            }else if($action_status=='Finished'){
                $ops0 = '';
                $ops1 = '';
                $ops2 = 'selected';
            }else{
                $ops0 = '';
                $ops1 = '';
                $ops2 = '';
            }

            echo $html_nc = '<div class="form-group">
                                          <label for="modal_action_status" class="text-primary col-sm-4 control-label" style="text-align:left;">Tindakan - Status</label>
                                          <div class="col-sm-8">
                                              <input type="hidden" name="modal_id" id="modal_id" class="form-control" value="'.$id.'"/>
                                              <input type="hidden" name="modal_aksi" id="modal_aksi" class="form-control" value="action"/>
                                              <select name="modal_action_status" id="modal_action_status" class="form-control">
                                                  <option value="" '.$ops0.'>- pilih -</option>
                                                  <option value="On Progress" '.$ops1.'>On Progress</option>
                                                  <option value="Finished" '.$ops2.'>Finished</option>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="modal_action_ket" class="text-primary col-sm-4 control-label" style="text-align:left;">action_ket</label>
                                          <div class="col-sm-8">
                                              <textarea name="modal_action_ket" id="modal_action_ket" class="form-control" rows="3" placeholder="Deskripsi Tindakan">'.$action_ket.'</textarea>
                                          </div>
                                        </div>';
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function addverifi(){
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

            $result_jadwal = $this->M_user->check_jadwal_audit();
            if($result_jadwal){
              $on_audit ='1';
              $data['on_audit']       = '1';
            }else{
              $on_audit ='0'; 
              $data['on_audit']       = '0'; 
            }

            $id = $this->input->post('id');

            $data_verifi = $this->M_ketidaksesuaian->get_ketidaksesuaian_byid($id);

            foreach($data_verifi as $data_verifi_row){
                $verifi_status = $data_verifi_row->verifi_status;
                $verifi_ket = $data_verifi_row->verifi_ket;
                $verifi_hidden = $data_verifi_row->verifi_hidden;
            }

            if($verifi_status=='OK'){
                $ops0 = '';
                $ops1 = 'selected';
                $ops2 = '';
            }else if($verifi_status=='NOT OK'){
                $ops0 = '';
                $ops1 = '';
                $ops2 = 'selected';
            }else{
                $ops0 = '';
                $ops1 = '';
                $ops2 = '';
            }

            if($verifi_hidden=='1'){
                $ops_hiddens0 = '';
                $ops_hiddens1 = 'selected';
                $ops_hiddens2 = '';
            }else if($verifi_status=='0'){
                $ops_hiddens0 = '';
                $ops_hiddens1 = '';
                $ops_hiddens2 = 'selected';
            }else{
                $ops_hiddens0 = '';
                $ops_hiddens1 = '';
                $ops_hiddens2 = '';
            }

            if($on_audit=='1'){
                echo $html_nc = '<div class="form-group">
                                          <label for="modal_verifi_status" class="text-primary col-sm-4 control-label" style="text-align:left;">Verify - Status</label>
                                          <div class="col-sm-8">
                                              <input type="hidden" name="modal_id" id="modal_id" class="form-control" value="'.$id.'"/>
                                              <input type="hidden" name="modal_aksi" id="modal_aksi" class="form-control" value="verifi"/>
                                              <select name="modal_verifi_status" id="modal_verifi_status" class="form-control">
                                                  <option value="" '.$ops0.'>- pilih -</option>
                                                  <option value="OK" '.$ops1.'>OK</option>
                                                  <option value="NOT OK" '.$ops2.'>NOT OK</option>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="modal_verifi_ket" class="text-primary col-sm-4 control-label" style="text-align:left;">Verify - Keterangan</label>
                                          <div class="col-sm-8">
                                              <textarea name="modal_verifi_ket" id="modal_verifi_ket" class="form-control" rows="3" placeholder="Deskripsi Verifikasi">'.$verifi_ket.'</textarea>
                                          </div>
                                        </div>';
            }else{
                echo $html_nc = '<div class="form-group">
                                          <label for="modal_verifi_status" class="text-primary col-sm-4 control-label" style="text-align:left;">Verify - Status</label>
                                          <div class="col-sm-8">
                                              <input type="hidden" name="modal_id" id="modal_id" class="form-control" value="'.$id.'"/>
                                              <input type="hidden" name="modal_aksi" id="modal_aksi" class="form-control" value="verifi"/>
                                              <select name="modal_verifi_status" id="modal_verifi_status" class="form-control">
                                                  <option value="" '.$ops0.'>- pilih -</option>
                                                  <option value="OK" '.$ops1.'>OK</option>
                                                  <option value="NOT OK" '.$ops2.'>NOT OK</option>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="modal_verifi_ket" class="text-primary col-sm-4 control-label" style="text-align:left;">Verify - Keterangan</label>
                                          <div class="col-sm-8">
                                              <textarea name="modal_verifi_ket" id="modal_verifi_ket" class="form-control" rows="3" placeholder="Deskripsi Verifikasi">'.$verifi_ket.'</textarea>
                                          </div>
                                        </div>
                                          <div class="form-group">
                                          <label for="modal_verifi_hidden" class="text-primary col-sm-4 control-label" style="text-align:left;">Verify - Hidden</label>
                                          <div class="col-sm-8">
                                              <select name="modal_verifi_hidden" id="modal_verifi_hidden" class="form-control">
                                                  <option value="" '.$ops_hiddens0.'>- pilih -</option>
                                                  <option value="1" '.$ops_hiddens1.'>Hidden</option>
                                                  <option value="0" '.$ops_hiddens2.'>Show</option>
                                              </select>
                                          </div>
                                        </div>';
            }

            
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function savereport(){
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

            $aksi = $this->input->post('modal_aksi');

           if($aksi=='add'){
                $modal_id               = $this->input->post('modal_id');
                $modal_bagian           = $this->input->post('modal_bagian');
                $modal_form_kategori    = $this->input->post('modal_form_kategori');
                $modal_form_subkategori = $this->input->post('modal_form_subkategori');
                $modal_form_kode        = $this->input->post('modal_form_kode');
                $modal_form_nama        = $this->input->post('modal_form_nama');
                $modal_form_versi       = $this->input->post('modal_form_versi');
                $modal_form_judul       = $this->input->post('modal_form_judul');
                $modal_ketidaksesuaian  = $this->input->post('modal_ketidaksesuaian');
                $userfile               = $this->input->post('userfile');
                $modal_report_date      = date('Y-m-d');
                $modal_report_time      = date('H:i:s');
                $modal_report_by        = $UserName;

                $file = '/var/www/html/qa/upload_foto/frmketidaksesuaian/';

                $files = $_FILES;

                $_FILES ['userfile']['name']      = $files ['userfile']['name'][$i];
                $_FILES ['userfile']['type']      = $files ['userfile']['type'][$i];
                $_FILES ['userfile']['tmp_name']  = $files ['userfile']['tmp_name'][$i];
                $_FILES ['userfile']['error']     = $files ['userfile']['error'][$i];
                $_FILES ['userfile']['size']      = $files ['userfile']['size'][$i];

                $data_nc=array(
                    'report_date'          => $modal_report_date,
                    'report_time'          => $modal_report_time,
                    'report_by'            => $modal_report_by,
                    'bagian'               => $modal_bagian,
                    'form_kode'            => $modal_form_kode,
                    'form_versi'           => $modal_form_versi,
                    'form_judul'           => $modal_form_judul,
                    'ketidaksesuaian'      => $modal_ketidaksesuaian,
                    //'foto_ketidaksesuaian' => $_FILES['userfile']['name'],
                    'form_kategori'        => $modal_form_kategori,
                    'form_subkategori'     => $modal_form_subkategori,
                    'form_nama'            => $modal_form_nama
                );

                if($modal_id==''){
                    $this->M_ketidaksesuaian->insert_detail($data_nc);
                    $dtid = $this->db1->insert_id();
                    $config = array(
                        'upload_path'   => set_realpath($file),
                        'allowed_types' => 'jpg|jpeg|png|gif',
                        'overwrite'     => TRUE,
                        'file_name'     => $dtid.".PNG"
                    );
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    $this->upload->do_upload('userfile');
                }else{
                    $this->M_ketidaksesuaian->update_detail($modal_id, $data_nc);
                    $config = array(
                        'upload_path'   => set_realpath($file),
                        'allowed_types' => 'jpg|jpeg|png|gif',
                        'overwrite'     => TRUE,
                        'file_name'     => $modal_id.".PNG"
                    );
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    $this->upload->do_upload('userfile');
                }

                $pesan_alert = "Data Berhasil Disimpan...!!";

                echo $pesan = $pesan_alert;
  
           }else if($aksi=='action'){
             $modal_id                  = $this->input->post('modal_id');
             $modal_action_status       = $this->input->post('modal_action_status');
             $modal_action_ket          = $this->input->post('modal_action_ket');
             $modal_action_date         = date('Y-m-d');
             $modal_action_time         = date('H:i:s');
             $modal_action_by           = $UserName;

             $file = '/var/www/html/qa/upload_foto/frmketidaksesuaian/';

              $files = $_FILES;

              $_FILES ['userfile']['name']      = $files ['userfile']['name'][$i];
              $_FILES ['userfile']['type']      = $files ['userfile']['type'][$i];
              $_FILES ['userfile']['tmp_name']  = $files ['userfile']['tmp_name'][$i];
              $_FILES ['userfile']['error']     = $files ['userfile']['error'][$i];
              $_FILES ['userfile']['size']      = $files ['userfile']['size'][$i];

             $data_nc=array(
                'action_date'           => $modal_action_date,
                'action_time'           => $modal_action_time,
                'action_by'             => $modal_action_by,
                'action_ket'            => $modal_action_ket,
                'action_status'         => $modal_action_status 
             );

             $this->M_ketidaksesuaian->update_detail($modal_id, $data_nc);
              $config = array(
                  'upload_path'   => set_realpath($file),
                  'allowed_types' => 'jpg|jpeg|png|gif',
                  'overwrite'     => TRUE,
                  'file_name'     => $modal_id.".PNG"
              );
              $this->load->library('upload');
              $this->upload->initialize($config);
              $this->upload->do_upload('userfile');

             $pesan_alert = "Data Berhasil Disimpan...!!";

                echo $pesan = $pesan_alert; 
           }else if($aksi=='verifi'){
             $modal_id                  = $this->input->post('modal_id');
             $modal_verifi_status       = $this->input->post('modal_verifi_status');
             $modal_verifi_ket          = $this->input->post('modal_verifi_ket');
             $valmodal_verifi_hidden    = $this->input->post('modal_verifi_hidden');
             if(trim($valmodal_verifi_hidden)==''){$modal_verifi_hidden=NULL;}else{$modal_verifi_hidden=$valmodal_verifi_hidden;}
             $modal_verifi_date         = date('Y-m-d');
             $modal_verifi_time         = date('H:i:s');
             $modal_verifi_by           = $UserName;

             $data_nc=array(
                'verifi_date'           => $modal_verifi_date,
                'verifi_time'           => $modal_verifi_time,
                'verifi_by'             => $modal_verifi_by,
                'verifi_ket'            => $modal_verifi_ket,
                'verifi_status'         => $modal_verifi_status,
                'verifi_hidden'         => $modal_verifi_hidden 
             );

             $this->M_ketidaksesuaian->update_detail($modal_id, $data_nc);

             $pesan_alert = "Data Berhasil Disimpan...!!";

                echo $pesan = $pesan_alert;  
           }else{
             $pesan_alert = "No Action...!!";

                echo $pesan = $pesan_alert;   
           }

            
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function get_form_kategori(){
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

            $bagian = $this->input->post('bagian');

            $result_kategori = $this->M_ketidaksesuaian->get_kategori($bagian);

            $data1='';
            foreach($result_kategori as $result_kategori_row){
                if(trim($result_kategori_row->formkategorinm)==''){
                    $data1 .= "<option value='-'>-</option>";
                }else{
                    $data1 .= "<option value='".$result_kategori_row->formkategorinm."'>".$result_kategori_row->formkategorinm."</option>";
                }
            }

            echo $html_kategori = $data1;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function get_form_subkategori(){
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

            $bagian = $this->input->post('bagian');
            $form_kategori = $this->input->post('form_kategori');

            $result_subkategori = $this->M_ketidaksesuaian->get_subkategori($bagian, $form_kategori);

            $data1='';
            foreach($result_subkategori as $result_subkategori_row){
                if(trim($result_subkategori_row->formkategori2nm)==''){
                    $data1 .= "<option value='-'>-</option>";
                }else{
                    $data1 .= "<option value='".$result_subkategori_row->formkategori2nm."'>".$result_subkategori_row->formkategori2nm."</option>";
                }
            }

            echo $html_subkategori = $data1;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function get_form_kode(){
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

            $bagian = $this->input->post('bagian');
            $form_kategori = $this->input->post('form_kategori');
            $form_subkategori = $this->input->post('form_subkategori');

            $result_formkode = $this->M_ketidaksesuaian->get_formkode($bagian, $form_kategori, $form_subkategori);

            $data1='';
            foreach($result_formkode as $result_formkode_row){
                if(trim($result_formkode_row->formkd)==''){
                    $data1 .= "<option value='-'>-</option>";
                }else{
                    $data1 .= "<option value='".$result_formkode_row->formkd."'>".$result_formkode_row->formnm."</option>";
                }
            }

            echo $html_formkode = $data1;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function get_form_versi(){
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

            $form_kode = $this->input->post('form_kode');

            $result_formversi = $this->M_ketidaksesuaian->get_formversi($form_kode);

            $data1='';
            foreach($result_formversi as $result_formversi_row){
                if(trim($result_formversi_row->formversi)==''){
                    $data1 .= "<option value='-'>-</option>";
                }else{
                    $data1 .= "<option value='".$result_formversi_row->formversi."'>".$result_formversi_row->formversi."</option>";
                }
            }

            echo $html_formversi = $data1;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function get_form_judul(){
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

            $form_kode = $this->input->post('form_kode');
            $form_versi = $this->input->post('form_versi');

            $result_formjudul = $this->M_ketidaksesuaian->get_formjudul($form_kode,$form_versi);

            foreach($result_formjudul as $result_formjudul_row){
                if(trim($result_formjudul_row->formjudul)==''){
                    $data1 = "-";
                }else{
                    $data1 = $result_formjudul_row->formjudul;
                }
            }

            echo $html_formjudul = $data1;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

    function delete_report(){
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

            $chk = $this->input->post('chk');
            $jmlchk = count($this->input->post('chk'));
            for($i=0;$i<$jmlchk;$i++){
                $id = $chk[$i];
                $this->M_ketidaksesuaian->delete_detail($id);
            }

            $pesan_alert = "Data Berhasil Dihapus...!!";

            echo $pesan = $pesan_alert;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }

}
?>