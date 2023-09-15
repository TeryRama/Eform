<?php
class C_formmenu extends CI_Controller {

    var $data = array();

    function __construct() {
        parent:: __construct();
        $this->db1 = $this->load->database('db1', TRUE);

        $this->load->helper('form', 'url');
        $this->load->model(array('M_user', 'M_menu', 'master/M_formmenu','master/M_form', 'form_input/M_forminput'));

        //////////////////////////////////
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $leveluid     = $session_data['leveluserid'];
            $url_str      = uri_string();
            $akses_check  = $this->M_user->check_akses_bylevelid($leveluid,'C_formmenu');
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

    function index() {
        $session_data           = $this->session->userdata('logged_in');
        $data['username']       = $session_data['username'];
        $data['password']       = $session_data['password'];
        $data['jabid']          = $session_data['jabid'];
        $data['leveluserid']    = $session_data['leveluserid'];
        $data['nmdepan']        = $session_data['nmdepan'];
        $data['levelusernm']    = $session_data['levelusernm'];
        $data['bagnm']          = $session_data['bagnm'];
        $data['jabnm']          = $session_data['jabnm'];
        $data['Titel']          = 'Master - Form';
        
        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];
        
        $cekLevelUserNm         = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        
        $data['menus']          = $this->M_menu->menus($LevelUser);
        
        $data['query']          = $this->M_formmenu->get_records();
        $data['jnsid']          = $this->M_formmenu->getAllJnsid();
        $this->load->view('master/form/V_formmenu', array_merge($data));
    }

    function form_modal() {
        $session_data              = $this->session->userdata('logged_in');
        
        $formid                    = $this->input->post('formid');
        $data['formnm']            = $this->input->post('formnm');
        $data['formkd']            = $this->input->post('formkd');
        $data['formversi']         = $this->input->post('formversi');
        $data['formefective']      = date("Y-m-d",strtotime($this->input->post('formefective')));
        $data['formjudul']         = $this->input->post('formjudul');
        $data['formjudul_english'] = $this->input->post('formjudul_english');
        $data['formket']           = $this->input->post('formket');
        $data['formstatus']        = $this->input->post('formstatus');
        $data['formjnsid']         = $this->input->post('formjnsid');
        $formkd                    = $data['formkd'];
        $formket                   = $data['formket'];
        $formjnsid                 = $data['formjnsid'];
        $frm_kate                  = $this->input->post('formkategoriid');
        $frm_kate2                 = $this->input->post('formkategori2id');

        if($frm_kate  ==""){ $data['formkategoriid'] = NULL; }else{ $data['formkategoriid'] = $frm_kate; }
        if($frm_kate2 ==""){ $data['formkategori2id'] = NULL; }else{ $data['formkategori2id'] = $frm_kate2; }
        
        $st_input = $this->input->post('status_input');
        $st_dh    = $this->input->post('status_dataharian');
        $st_lap   = $this->input->post('status_lap');
        $st_app   = $this->input->post('status_app');

        if(isset($st_input)){ $data['status_input']   = '1'; }else{ $data['status_input'] = '0'; }
        if(isset($st_dh)){ $data['status_dataharian'] = '1'; }else{ $data['status_dataharian'] = '0'; }
        if(isset($st_lap)){ $data['status_lap']       = '1'; }else{ $data['status_lap'] = '0'; }
        if(isset($st_app)){ $data['status_app']       = '1'; }else{ $data['status_app'] = '0'; }
        
        $data['efective_parameter']                  = $this->input->post('efective_parameter');
        $data['parameter_jlh_approval']              = $this->input->post('parameter_jlh_approval');
        $data['parameter_approval']                  = $this->input->post('parameter_approval');
        $data['parameter_jenis_approval']            = $this->input->post('parameter_jenis_approval');        

        if ($this->uri->segment(5)=='add') {
            $data['createby']   = $session_data['username'];
            $data['createdate'] = date('Y-m-d');
            $data['createcomp'] = $_SERVER['REMOTE_ADDR'];

            if ($this->M_formmenu->insert($data))
                $dtformid = $this->db1->insert_id();
                $dtform      = $this->M_formmenu->search_form($formkd, $formket);
                if($formket == 'In-Progress'){
                    if(isset($dtform)){
                        $this->M_formmenu->insert_revisi_formakses_admin_by($dtform->formid, $dtformid);
                    }else{
                        $this->M_formmenu->insert_new_formakses_admin_by($dtformid, $formjnsid, $frm_kate, $frm_kate2);
                    }
                }
                echo "<script>alert('Data berhasil ditambah!!');
                      window.location.assign('".base_url()."master/form/C_formmenu');
                   </script>";
        }else if ($this->uri->segment(5)=='update'){
            $data['updateby']   = $session_data['username'];
            $data['updatedate'] = date('Y-m-d');
            $data['updatecomp'] = $_SERVER['REMOTE_ADDR'];
            
            if ($this->M_formmenu->update_by_id($data, $formid))
                $dtform      = $this->M_formmenu->search_form($formkd, $formket);
                if($formket == 'Complete'){
                    $dtform      = $this->M_formmenu->search_form($formkd, $formket);
                    if(isset($dtform)){
                        $this->M_formmenu->insert_formakses($dtform->formid, $formid);
                        if($st_app == '1'){
                            $this->M_formmenu->insert_appakses($dtform->formid, $formid);
                        }
                    }
                }else if($formket == 'In-Progress'){
                    if(isset($dtform)){
                        $this->M_formmenu->insert_revisi_formakses_admin_by($dtform->formid, $formid);
                    }else{
                        $this->M_formmenu->insert_new_formakses_admin_by($formid, $formjnsid, $frm_kate, $frm_kate2);
                    }
                }
                echo "<script>alert('Data berhasil diupdate!!');
                      window.location.assign('".base_url()."master/form/C_formmenu');
                   </script>";
        }else if ($this->uri->segment(5)=='copy'){
            $data['createby']   = $session_data['username'];
            $data['createdate'] = date('Y-m-d');
            $data['createcomp'] = $_SERVER['REMOTE_ADDR'];

            if ($this->M_formmenu->insert($data))
                $dtformid = $this->db1->insert_id();
                $dtform   = $this->M_formmenu->search_form($formkd, $formket);
                if ($formket == 'In-Progress') {
                    if (isset($dtform)) {
                        $this->M_formmenu->insert_revisi_formakses_admin_by($dtform->formid, $dtformid);
                    } else {
                        $this->M_formmenu->insert_new_formakses_admin_by($dtformid, $formjnsid, $frm_kate, $frm_kate2);
                    }
                }
                echo "<script>alert('Data berhasil dicopy!!');
                      window.location.assign('".base_url()."master/form/C_formmenu');
                   </script>";
        }else{                
            echo "<script>alert('Gagal, tidak ada aksi!!');
                  window.location.assign('".base_url()."master/form/C_formmenu');
               </script>";
        }
    }

    function delete($id) {
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

        if ($this->M_formmenu->delete_by_id($id)) { 
            echo "<script>alert('Data berhasil dihapus!!');
                  window.location.assign('".base_url()."master/form/C_formmenu');
               </script>";
        } else { 
            echo "<script>alert('Gagal, tidak ada aksi!!');
                  window.location.assign('".base_url()."master/form/C_formmenu');
               </script>";		
        }
    }

    function getFormKat(){
        $fjnsid = $this->input->post('formjnsid');
        $frmjns = $this->M_formmenu->getFormKat($fjnsid);
        $data   = "<option value=''>- pilih -</option>";
        foreach($frmjns as $row){
            $data .= '<option value="'.$row->submenu2id.'">'.$row->submenu2nm.'</option>';
        }
        echo $data;
    }

    function getFormKat2(){
        $formkategoriid = $this->input->post('formkategoriid');
        $frmkate        = $this->M_formmenu->getFormKat2($formkategoriid);
        $data           = "<option value=''>- pilih -</option>";
        foreach($frmkate as $row){
            $data .= '<option value="'.$row->submenu3id.'">'.$row->submenu3nm.'</option>';
        }
        echo $data;
    }

    function get_dt_update() {        
        $id        = $this->input->post('id');        
        $dt_update = $this->M_formmenu->get_records_by($id);
        
        $data      = '';
        $data2     = '';
        $data3     = '';
        $data4     = '';
        $data5     = '';
        $data6     = '';
        $data7     = '';
        $data8     = '';
        $data9     = '';
        $data10    = '';
        $data11    = '';
        $data12    = '';
        $data13    = '';
        $data14    = '';
        $data15    = '';
        $data16    = '';
        $data17    = '';
        $data18    = '';
        $data19    = '';
        $data20    = '<option value="">- pilih -</option>';
        $data21    = '<option value="">- pilih -</option>';
        $data22    = '<option value="">- pilih -</option>';

        foreach($dt_update->result() as $dt_update_row){
            $data      = $dt_update_row->formnm;
            $data2     = $dt_update_row->formkd;
            $data3     = $dt_update_row->formversi;
            $data4     = date("d-m-Y",strtotime($dt_update_row->formefective));
            $data5     = $dt_update_row->formjudul;
            $data6     = $dt_update_row->formjudul_english;
            $data7     = $dt_update_row->formket;
            $data8     = $dt_update_row->formstatus;
            $data9     = $dt_update_row->formjnsid;
            $data10    = $dt_update_row->formkategoriid;
            $data11    = $dt_update_row->formkategori2id;
            $data12    = $dt_update_row->efective_parameter;
            $data13    = $dt_update_row->parameter_jenis_approval;
            $data14    = $dt_update_row->parameter_jlh_approval;
            $data15    = $dt_update_row->parameter_approval;
            $data16    = $dt_update_row->status_input;
            $data17    = $dt_update_row->status_dataharian;
            $data18    = $dt_update_row->status_lap;
            $data19    = $dt_update_row->status_app;
        }

        if($data9!=''){
            $list_formjnsid = $this->M_formmenu->getAllJnsid();
            $data22         .= '';
            foreach($list_formjnsid as $list_formjnsid){
                if($data9==$list_formjnsid->submenuid){
                    $v_selected = 'selected';
                }else{
                    $v_selected = '';
                }
                $data22 .= '<option value="'.$list_formjnsid->submenuid.'" '.$v_selected.'>'.$list_formjnsid->submenunm.'</option>';
            }
        }

        if($data9!=''){
            $list_formkategoriid = $this->M_formmenu->getFormKat($data9);
            $data20              .= '';
            foreach($list_formkategoriid as $list_formkategoriid){
                if($data10==$list_formkategoriid->submenu2id){
                    $v_selected2 = 'selected';
                }else{
                    $v_selected2 = 'selected';
                }
                $data20 .= '<option value="'.$list_formkategoriid->submenu2id.'" '.$v_selected2.'>'.$list_formkategoriid->submenu2nm.'</option>';
            }
        }

        if($data10!=''){
            $formkategori2id = $this->M_formmenu->getFormKat2($data10);
            $data21          .= '';
            foreach($formkategori2id as $formkategori2id_row){
                if($data11==$formkategori2id_row->submenu3id){
                    $v_selected3 = 'selected';
                }else{
                    $v_selected3 = 'selected';
                }
                $data21 .= '<option value="'.$formkategori2id_row->submenu3id.'" '.$v_selected3.'>'.$formkategori2id_row->submenu3nm.'</option>';
            }
        }

        echo $data.
            '//'.$data2.
            '//'.$data3.
            '//'.$data4.
            '//'.$data5.
            '//'.$data6.
            '//'.$data7.
            '//'.$data8.
            '//'.$data9.
            '//'.$data10.
            '//'.$data11.
            '//'.$data12.
            '//'.$data13.
            '//'.$data14.
            '//'.$data15.
            '//'.$data16.
            '//'.$data17.
            '//'.$data18.
            '//'.$data19.
            '//'.$data20.
            '//'.$data21.
            '//'.$data22;

    }
    
    function get_dt_copy() {        
        $id        = $this->input->post('id');        
        $dt_update = $this->M_formmenu->get_records_by($id);
        
        $data      = '';
        $data2     = '';
        $data3     = '';
        $data4     = '';
        $data5     = '';
        $data6     = '';
        $data7     = '';
        $data8     = '';
        $data9     = '';
        $data10    = '';
        $data11    = '';
        $data12    = '';
        $data13    = '';
        $data14    = '';
        $data15    = '';
        $data16    = '';
        $data17    = '';
        $data18    = '';
        $data19    = '';
        $data20    = '<option value="">- pilih -</option>';
        $data21    = '<option value="">- pilih -</option>';
        $data22    = '<option value="">- pilih -</option>';

        foreach($dt_update->result() as $dt_update_row){
            $data      = $dt_update_row->formnm;
            $data2     = $dt_update_row->formkd;
            $data3     = $dt_update_row->formversi;
            $data4     = date("d-m-Y",strtotime($dt_update_row->formefective));
            $data5     = $dt_update_row->formjudul;
            $data6     = $dt_update_row->formjudul_english;
            $data7     = $dt_update_row->formket;
            $data8     = $dt_update_row->formstatus;
            $data9     = $dt_update_row->formjnsid;
            $data10    = $dt_update_row->formkategoriid;
            $data11    = $dt_update_row->formkategori2id;
            $data12    = $dt_update_row->efective_parameter;
            $data13    = $dt_update_row->parameter_jenis_approval;
            $data14    = $dt_update_row->parameter_jlh_approval;
            $data15    = $dt_update_row->parameter_approval;
            $data16    = $dt_update_row->status_input;
            $data17    = $dt_update_row->status_dataharian;
            $data18    = $dt_update_row->status_lap;
            $data19    = $dt_update_row->status_app;
        }

        if($data9!=''){
            $list_formjnsid = $this->M_formmenu->getAllJnsid();
            $data22         .= '';
            foreach($list_formjnsid as $list_formjnsid){
                if($data9==$list_formjnsid->submenuid){
                    $v_selected = 'selected';
                }else{
                    $v_selected = '';
                }
                $data22 .= '<option value="'.$list_formjnsid->submenuid.'" '.$v_selected.'>'.$list_formjnsid->submenunm.'</option>';
            }
        }

        if($data9!=''){
            $list_formkategoriid = $this->M_formmenu->getFormKat($data9);
            $data20              .= '';
            foreach($list_formkategoriid as $list_formkategoriid){
                if($data10==$list_formkategoriid->submenu2id){
                    $v_selected2 = 'selected';
                }else{
                    $v_selected2 = 'selected';
                }
                $data20 .= '<option value="'.$list_formkategoriid->submenu2id.'" '.$v_selected2.'>'.$list_formkategoriid->submenu2nm.'</option>';
            }
        }

        if($data10!=''){
            $formkategori2id = $this->M_formmenu->getFormKat2($data10);
            $data21          .= '';
            foreach($formkategori2id as $formkategori2id_row){
                if($data11==$formkategori2id_row->submenu3id){
                    $v_selected3 = 'selected';
                }else{
                    $v_selected3 = 'selected';
                }
                $data21 .= '<option value="'.$formkategori2id_row->submenu3id.'" '.$v_selected3.'>'.$formkategori2id_row->submenu3nm.'</option>';
            }
        }

        echo $data.
            '//'.$data2.
            '//'.$data3.
            '//'.$data4.
            '//'.$data5.
            '//'.$data6.
            '//'.$data7.
            '//'.$data8.
            '//'.$data9.
            '//'.$data10.
            '//'.$data11.
            '//'.$data12.
            '//'.$data13.
            '//'.$data14.
            '//'.$data15.
            '//'.$data16.
            '//'.$data17.
            '//'.$data18.
            '//'.$data19.
            '//'.$data20.
            '//'.$data21.
            '//'.$data22;

    }
    function copy_from(){

        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['nmlengkap']      = $session_data['nmlengkap'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['deptid']         = $session_data['deptid'];
            $data['deptabbr']       = $session_data['deptabbr'];
            $data['bagian_akses']   = $session_data['bagian_akses'];
            $data['ori_akses']      = $session_data['ori_akses'];
            $data['audit_akses']    = $session_data['audit_akses'];
            $data['mode_akses']     = $session_data['mode_akses'];
            $data['on_audit']       = $session_data['on_audit'];
            $data['Titel']          = 'Home';
            $btns           = $this->M_menu->getLevelBtn($session_data['leveluserid']);
            $data['allakses_update_header'] = $btns->btn_update_header;

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            $bag                    = $session_data['bagnm'];
            $ses_deptabbr           = $session_data['deptabbr'];
            $ses_deptid             = $session_data['deptid'];

            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);

            $id                     = $this->uri->segment(5);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);

            $jnsid                  = $this->M_formmenu->getAllJnsid();
            $data3                  = array('jnsid' => $jnsid);

            // $bagid                  = $this->M_formmenu->getAllbagian($bag);
            // $data4                  = array('bagid' => $bagid);

            // $deptid                 = $this->M_formmenu->getAlldepartemen($ses_deptabbr);
            // $data5                  = array('deptid' => $deptid);

            $this->data['query']         = $this->M_formmenu->get_records_by($id);
            $this->data['is_update'] = 2;
            $this->load->view('master/form/V_formtambah_a', array_merge($data, $data2, $data3, $this->data));
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    
    }

} ?>	