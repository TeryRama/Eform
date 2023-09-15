<?php

class C_product_spec extends CI_Controller {

    var $data = array();
    
    function __construct(){
        
        parent :: __construct();
        $this->load->model(array('M_user', 'M_menu','master/product_spec/M_product_spec'));

        $this->load->library(array('table','form_validation','excel','image_lib'));
        $this->load->helper(array('form','url','html','file','path'));        
        $this->db1 = $this->load->database('db1',TRUE);

        //////////////////////////////////
        if ($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $leveluid     = $session_data['leveluserid'];
            $url_str      = uri_string();
            $akses_check  = $this->M_user->check_akses_bylevelid($leveluid,'C_product_spec');
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
        $data['Titel']          = 'Master - Product Spesification';
        
        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];
        
        $cekLevelUserNm         = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        
        $data['menus']          = $this->M_menu->menus($LevelUser);
        
        $data['list_data']      = $this->M_product_spec->get_records();
        $data['dt_formjnsnm']   = $this->M_product_spec->get_dt_formktgr($LevelUser);
        
        $this->load->view('master/product_spec/V_product_spec', array_merge($data));
    }

    function get_form_kategori(){
        $session_data           = $this->session->userdata('logged_in');
        $LevelUser              = $session_data['leveluserid'];

        $dt_formjnsnm = $this->M_product_spec->get_dt_formktgr($LevelUser);

        $data3 = '<option value="">- pilih -</option>';
        foreach($dt_formjnsnm as $row){
             $data3 .= '<option value="'.$row->formjnsnm.'">'.$row->formjnsnm.'</option>';
        }
        echo json_encode($data3);
    }

    function get_form_code(){

        $formjnsnm     = $this->input->post('formjnsnm');

        $dt_formjnsnm = $this->M_product_spec->get_dt_formjnsnm($formjnsnm);
        // $data3 = '<option value="">- pilih -</option>';
        // foreach($dt_formjnsnm as $row){
        //      $data3 .= '<option value="'.$row->formkd.'">' .$row->formnm. '</option>';
        // }
        echo json_encode($dt_formjnsnm);
    }
     function get_form_versi(){

        $formkd     = $this->input->post('formkd');

        $dt_formversi = $this->M_product_spec->get_dt_formversi($formkd);
        // $data4 = "<option value=''>- pilih -</option>";
        // foreach($dt_formversi as $row){
        //      $data4 .= '<option value="'.$row->formversi.'">' .$row->formversi. '</option>';
        // }
        echo json_encode($dt_formversi);
    }

    function form(){
        if($this->session->userdata('logged_in')){
            $session_data       = $this->session->userdata('logged_in');
            
            $mdl_headerid       = $this->input->post('mdl_headerid');
            $mdl_dtbagian       = $this->input->post('mdl_dtbagian');
            $mdl_dtkode_form    = $this->input->post('mdl_dtkode_form');
            $mdl_dtversi_form   = $this->input->post('mdl_dtversi_form');
            $mdl_tgl_start      = date("Y-m-d",strtotime($this->input->post('mdl_tgl_start')));
            $mdl_tgl_finish     = date("Y-m-d",strtotime($this->input->post('mdl_tgl_finish')));

            $detail_id          = $this->input->post('detail_id');
            $chk                = $this->input->post('chk');
            $dt_parameter       = $this->input->post('dt_parameter');
            $dt_spec_minimal    = $this->input->post('dt_spec_minimal');
            $dt_spec_maximal    = $this->input->post('dt_spec_maximal');
            $status_analisa     = $this->input->post('status_analisa');

            // if ((isset($_POST['btnproses']) || isset($_POST['btncopy'])) && $this->uri->segment(4)=='add'){
            if ((isset($_POST['btnproses']) && $this->uri->segment(5)=='add') || (isset($_POST['btncopy']) && $this->uri->segment(5)=='update')){
                if($this->M_product_spec->cek_header($mdl_dtbagian,$mdl_dtkode_form,$mdl_dtversi_form, $mdl_tgl_start, $mdl_tgl_finish)->num_rows()==0){

                    if(trim($mdl_tgl_start)!='1970-01-01'){$v_tgl_start=$mdl_tgl_start;}else{$v_tgl_start=NULL;}
                    if(trim($mdl_tgl_finish)!='1970-01-01'){$v_tgl_finish=$mdl_tgl_finish;}else{$v_tgl_finish=NULL;}

                    $data['bagian']             = $mdl_dtbagian;
                    $data['form_kode']          = $mdl_dtkode_form;
                    $data['form_versi']         = $mdl_dtversi_form;
                    $data['tgl_start']          = $v_tgl_start;
                    $data['tgl_finish']         = $v_tgl_finish;
                    
                    $data['create_by']         = $session_data['nmlengkap'];
                    $data['create_date']       = date('Y-m-d');
                    $data['create_time']       = date('H:i:s');
                    $data['create_computer']    = $_SERVER['REMOTE_ADDR'];

                    $insert_id = $this->M_product_spec->insert_hdr($data);
                    $maxid = $this->db1->insert_id();
                    
                    $jml = count($this->input->post('dt_parameter'));

                    for($i=0; $i<$jml;$i++){

                        if(trim($dt_parameter[$i])!=''){$n_parameter[$i]=$dt_parameter[$i];}else{$n_parameter[$i]=NULL;}
                        if(trim($dt_spec_minimal[$i])!=''){$n_spec_minimal[$i]=$dt_spec_minimal[$i];}else{$n_spec_minimal[$i]=NULL;}
                        if(trim($dt_spec_maximal[$i])!=''){$n_spec_maximal[$i]=$dt_spec_maximal[$i];}else{$n_spec_maximal[$i]=NULL;}

                        $data_detail = array(
                            'parameter'      => $n_parameter[$i],
                            'spec_min'       => $n_spec_minimal[$i],
                            'spec_max'       => $n_spec_maximal[$i],
                            'headerid'       => $maxid,
                            'status_analisa' => $status_analisa[$i]
                        );

                        $this->M_product_spec->insert_dtl($data_detail);
                    }
                    
                    if(isset($_POST['btncopy'])){
                        echo "<script>alert('Data berhasil dicopy....!!!! ');</script>";                        
                    }else{
                        echo "<script>alert('Data berhasil disimpan....!!!! ');</script>";                        
                    }
                }else{
                    echo '<script>alert("Gagal menyimpan!!!\nData dengan Jenis Form : '.$bagian. ', Kode Form : ' . $form_kode . ',Versi Form : ' . $form_versi . ', untuk tanggal : '.$tgl_start.' sudah pernah disimpan.");</script>';
                }
               
            }else if (isset($_POST['btnproses']) && $this->uri->segment(5)=='update'){
                if($this->M_product_spec->cek_header2($mdl_dtbagian,$mdl_dtkode_form,$mdl_dtversi_form, $mdl_tgl_start, $mdl_tgl_finish, $mdl_headerid)->num_rows()==0){
                    if(trim($mdl_tgl_start)!='1970-01-01'){$v_tgl_start=$mdl_tgl_start;}else{$v_tgl_start=NULL;}
                    if(trim($mdl_tgl_finish)!='1970-01-01'){$v_tgl_finish=$mdl_tgl_finish;}else{$v_tgl_finish=NULL;}

                    $data['bagian']             = $mdl_dtbagian;
                    $data['form_kode']          = $mdl_dtkode_form;
                    $data['form_versi']         = $mdl_dtversi_form;
                    $data['tgl_start']          = $v_tgl_start;
                    $data['tgl_finish']         = $v_tgl_finish;
                    
                    $data['update_by']           = $session_data['nmlengkap'];
                    $data['update_date']         = date('Y-m-d');
                    $data['update_time']         = date('H:i:s');
                    $data['update_computer']      = $_SERVER['REMOTE_ADDR'];

                    $this->M_product_spec->update_hdr($mdl_headerid, $data);
                    
                    $jml = count($this->input->post('dt_parameter'));
                    for($i=0; $i<$jml;$i++){

                        if(trim($dt_parameter[$i])!=''){$n_parameter[$i]=$dt_parameter[$i];}else{$n_parameter[$i]=NULL;}
                        if(trim($dt_spec_minimal[$i])!=''){$n_spec_minimal[$i]=$dt_spec_minimal[$i];}else{$n_spec_minimal[$i]=NULL;}
                        if(trim($dt_spec_maximal[$i])!=''){$n_spec_maximal[$i]=$dt_spec_maximal[$i];}else{$n_spec_maximal[$i]=NULL;}

                        if(isset($detail_id[$i])){

                            $data_detail = array(
                                'parameter'      => $n_parameter[$i],
                                'spec_min'       => $n_spec_minimal[$i],
                                'spec_max'       => $n_spec_maximal[$i],
                                'headerid'       => $mdl_headerid,
                                'status_analisa' => $status_analisa[$i]
                                );

                            $datadetail = $detail_id[$i];
                            $this->M_product_spec->update_dtl($datadetail,$data_detail);

                        }else{

                                $data_detail = array(
                                'parameter'      => $n_parameter[$i],
                                'spec_min'       => $n_spec_minimal[$i],
                                'spec_max'       => $n_spec_maximal[$i],
                                'headerid'       => $mdl_headerid,
                                'status_analisa' => $status_analisa[$i]
                            );

                            $this->M_product_spec->insert_dtl($data_detail);  
                        }
                    }
                    echo "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                }else{
                    echo '<script>alert("Gagal menyimpan!!!\nData dengan Jenis Form : '.$bagian. ', Kode Form : ' . $form_kode . ',Versi Form : ' . $form_versi . ', untuk tanggal : '.$tgl_start.' sudah pernah disimpan.");</script>';
                }
                
            }else if (isset($_POST['btndelete_dtl']) && $this->uri->segment(5)=='update'){
                $data['update_by']           = $session_data['nmlengkap'];
                $data['update_date']         = date('Y-m-d');
                $data['update_time']         = date('H:i:s');
                $data['update_computer']      = $_SERVER['REMOTE_ADDR'];

                if ($this->M_product_spec->update_hdr($mdl_headerid, $data)){

                    for($i=0; $i<count($this->input->post('chk')); $i++){
                        if(isset($chk[$i])){                            
                            $this->M_product_spec->modal_delete_detail($chk[$i]);
                        }
                    }

                    echo "<script>alert('Data berhasil dihapus....!!!! ');</script>";
                }
            }else{                
                echo "<script>alert('Gagal, tidak ada aksi!!');</script>";
            }

            redirect('master/product_spec/C_product_spec', 'refresh');
        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_dt_update(){   
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $headerid     = $this->input->post('headerid');
            
            $dtheader     = $this->M_product_spec->get_records_by($headerid);
            $dtdetail     = $this->M_product_spec->get_records_dtl_by($headerid);

            if(count($dtheader)>0){
                $hasil = array(
                                'status'  => 0,
                                'vstatus' => 'berhasil',
                                'pesan'   => 'berhasil',
                                'data_hdr'    => $dtheader,
                                'data_dtl'    => $dtdetail,
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
            $detail_result = $this->M_product_spec->delete_detail($id);
            if($detail_result=='1'){
                $header_result = $this->M_product_spec->delete_header($id);
                if($header_result=='1'){
                    echo "<script>alert('Data Berhasil Dihapus!!');</script>";
                }else{
                    echo $delete_data = "Data Header Batal Dihapus!!";
                }
            }else{
                echo $delete_data = "Data Detail Batal Dihapus!!";
            }
            redirect('master/product_spec/C_product_spec', 'refresh');
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}
?>