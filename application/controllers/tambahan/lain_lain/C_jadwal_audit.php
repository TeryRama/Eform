<?php

class C_jadwal_audit extends CI_Controller {

	var $data = array();

	function __construct() {

		parent :: __construct();

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');

		$this->load->model(array('M_menu','tambahan/lain_lain/M_jadwal_audit'));

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

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            $Bagian                 = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $jadwal_audit      = $this->M_jadwal_audit->get_jadwal_audit();
            $data_jadwal_audit = array('jadwal_audit' => $jadwal_audit);

            $data['date_from']          = date('Y-m-01');
            $data['date_to']            = date('Y-m-t');

            $this->load->view('tambahan/lain_lain/V_jadwal_audit', array_merge($data, $data2, $data_jadwal_audit));

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

            $jadwal_audit      = $this->M_jadwal_audit->get_jadwal_audit_bydate($date_from, $date_to);
            $data_jadwal_audit = array('jadwal_audit' => $jadwal_audit);

            $data['date_from']          = $date_from;
            $data['date_to']            = $date_to;

            $this->load->view('tambahan/lain_lain/V_jadwal_audit', array_merge($data, $data2, $data_jadwal_audit));

        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }

    function addjadwal(){
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
            $Bagian                 = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            /*echo "<script>alert('test....!!!! ');</script>";*/
            $id = $this->input->post('id');

            if($id=='0'){
                echo $html_jadwal = '<div class="form-group">
                              <label for="modal_jadwal_from" class="text-primary col-sm-4 control-label" style="text-align:left;">From Date</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="modal_jadwal_id" id="modal_jadwal_id" class="form-control" value=""/>
                                  <input type="hidden" name="modal_aksi" id="modal_aksi" class="form-control" value="add"/>
                                  <input type="text" name="modal_jadwal_from" id="modal_jadwal_from" class="modal_jadwal_from dttgl form-control input-group date" data-date="" data-date-format="yyyy-mm-dd"/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_jadwal_to" class="text-primary col-sm-4 control-label" style="text-align:left;">To Date</label>
                              <div class="col-sm-8">
                                  <input type="text" name="modal_jadwal_to" id="modal_jadwal_to" class="modal_jadwal_to dttgl form-control input-group date" data-date="" data-date-format="yyyy-mm-dd" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_jadwal_guest" class="text-primary col-sm-4 control-label" style="text-align:left;">Guest</label>
                              <div class="col-sm-8">
                                  <input type="text" name="modal_jadwal_guest" id="modal_jadwal_guest" class="form-control"/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_jadwal_remarks" class="text-primary col-sm-4 control-label" style="text-align:left;">Remarks</label>
                              <div class="col-sm-8">
                                  <textarea name="modal_jadwal_remarks" id="modal_jadwal_remarks" class="form-control" rows="3" placeholder="Remarks"></textarea>
                              </div>
                            </div>';
            }else{

                $data_jadwal_audit = $this->M_jadwal_audit->get_jadwal_audit_byid($id);

                foreach($data_jadwal_audit as $data_jadwal_audit_row){
                    $jadwal_id         = $data_jadwal_audit_row->jadwal_id;
                    $jadwal_from         = $data_jadwal_audit_row->jadwal_from;
                    $jadwal_to           = $data_jadwal_audit_row->jadwal_to;
                    $jadwal_guest        = $data_jadwal_audit_row->jadwal_guest;
                    $jadwal_remarks      = $data_jadwal_audit_row->jadwal_remarks;
                }

                echo $html_jadwal = '<div class="form-group">
                              <label for="modal_jadwal_from" class="text-primary col-sm-4 control-label" style="text-align:left;">From Date</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="modal_jadwal_id" id="modal_jadwal_id" class="form-control" value="'.$jadwal_id.'"/>
                                  <input type="hidden" name="modal_aksi" id="modal_aksi" class="form-control" value="add"/>
                                  <input type="text" name="modal_jadwal_from" id="modal_jadwal_from" class="modal_jadwal_from dttgl form-control input-group date" data-date="" data-date-format="yyyy-mm-dd" value="'.$jadwal_from.'" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_jadwal_to" class="text-primary col-sm-4 control-label" style="text-align:left;">To Date</label>
                              <div class="col-sm-8">
                                  <input type="text" name="modal_jadwal_to" id="modal_jadwal_to" class="modal_jadwal_to dttgl form-control input-group date" data-date="" data-date-format="yyyy-mm-dd" value="'.$jadwal_to.'"/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_jadwal_guest" class="text-primary col-sm-4 control-label" style="text-align:left;">Guest</label>
                              <div class="col-sm-8">
                                  <input type="text" name="modal_jadwal_guest" id="modal_jadwal_guest" class="form-control" value="'.$jadwal_guest.'"/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="modal_jadwal_remarks" class="text-primary col-sm-4 control-label" style="text-align:left;">Remarks</label>
                              <div class="col-sm-8">
                                  <textarea name="modal_jadwal_remarks" id="modal_jadwal_remarks" class="form-control" rows="3" placeholder="Remarks">'.$jadwal_remarks.'</textarea>
                              </div>
                            </div>';

            }
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }    
    }


    function savejadwal(){
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
            $Bagian                 = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $aksi = $this->input->post('modal_aksi');

           if($aksi=='add'){
                $modal_jadwal_id          = $this->input->post('modal_jadwal_id');
                $nmodal_jadwal_from        = $this->input->post('modal_jadwal_from');
                if(trim($nmodal_jadwal_from)==''){
                    $modal_jadwal_from = NULL;
                }else{
                    $modal_jadwal_from = $nmodal_jadwal_from;
                }
                $nmodal_jadwal_to        = $this->input->post('modal_jadwal_to');
                if(trim($nmodal_jadwal_to)==''){
                    $modal_jadwal_to = NULL;
                }else{
                    $modal_jadwal_to = $nmodal_jadwal_to;
                }
                $modal_jadwal_guest       = $this->input->post('modal_jadwal_guest');
                $modal_jadwal_remarks     = $this->input->post('modal_jadwal_remarks');
                $modal_jadwal_by          = $UserName;
                $modal_jadwal_date        = date('Y-m-d');
                $modal_jadwal_time        = date('H:i:s');
                $modal_jadwal_comp        = gethostbyaddr($_SERVER['REMOTE_ADDR']);

                if($modal_jadwal_id==''){
                    $data_jadwal=array(
                        'jadwal_from'            => $modal_jadwal_from,
                        'jadwal_to'              => $modal_jadwal_to,
                        'jadwal_guest'           => $modal_jadwal_guest,
                        'jadwal_remarks'         => $modal_jadwal_remarks,
                        'create_by'              => $modal_jadwal_by,
                        'create_date'            => $modal_jadwal_date,
                        'create_time'            => $modal_jadwal_time,
                        'create_comp'            => $modal_jadwal_comp
                    );
                    $this->M_jadwal_audit->insert_detail($data_jadwal);
                }else{
                    $data_jadwal=array(
                        'jadwal_from'            => $modal_jadwal_from,
                        'jadwal_to'              => $modal_jadwal_to,
                        'jadwal_guest'           => $modal_jadwal_guest,
                        'jadwal_remarks'         => $modal_jadwal_remarks,
                        'update_by'              => $modal_jadwal_by,
                        'update_date'            => $modal_jadwal_date,
                        'update_time'            => $modal_jadwal_time,
                        'update_comp'            => $modal_jadwal_comp
                    );
                    $this->M_jadwal_audit->update_detail($modal_jadwal_id, $data_jadwal);
                }

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


    function delete_jadwal(){
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
            $Bagian                 = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $chk = $this->input->post('chk');
            $jmlchk = count($this->input->post('chk'));
            for($i=0;$i<$jmlchk;$i++){
                $id = $chk[$i];
                $this->M_jadwal_audit->delete_detail($id);
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