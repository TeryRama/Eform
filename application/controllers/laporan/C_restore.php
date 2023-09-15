<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_restore extends CI_Controller {

    function __construct() {
        parent::__construct();
        $frmkode = $this->uri->segment(4);
        $frmvrs = $this->uri->segment(5);
        $this->load->model(array('M_user', 'master/M_form','M_menu', 'form_input/M_forminput', 'laporan/M_restore', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->library(array('table','form_validation','excel','pdf'));
        $this->load->helper('form');

        //////////////////////////////////
        /// prevent direct url accses
        $session_data = $this->session->userdata('logged_in');
        $leveluid     = $session_data['leveluserid'];
        $url_str      = uri_string();

        $akses_check = $this->M_user->check_akses_bylevelid($leveluid,$frmkode);
        if($akses_check==false){
            echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini..!!');
                          window.location.assign('";echo base_url();echo "C_login');
                       </script>"; 
        }
        /// end prevent direct url accses
        //////////////////////////////////
    }

    function restore_laporan() {
            $session_data           = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['Titel']          = 'Laporan';
            
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            $bagianabbr             = $session_data['bagnm'];
            
            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $frmkode                = $this->uri->segment(4);
            $frmvrs                 = $this->uri->segment(5);
            $fileaksi               = $this->uri->segment(6);
            $id                     = $this->uri->segment(7);
            
            $complete_userid        = $session_data['userid'];
            $complete_date          = date('Y-m-d');
            $complete_time          = date('H:i:s');
            $complete_by            = $session_data['nmlengkap'];
            $complete_comp          = $this->session->userdata('hostname');
            
            $dtfrm                  = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
            $data3                  = array('dtfrm' => $dtfrm);

        foreach ($dtfrm as $datafrm){
            $frmkd                 = $datafrm->formkd;
            $frm_vrs               = $datafrm->formversi;
            $frmefective_parameter = $datafrm->efective_parameter;
            $jml_app               = $datafrm->parameter_jlh_approval;
            $frm_jenis_approval    = $datafrm->parameter_jenis_approval;
        }

        if($frm_jenis_approval=='Shift'){
            if($cekLevelUserNm=='Auditor'){
                $data_app_update = array(
                    'complete_useridx'   => $complete_userid,
                    'complete_byx'       => $complete_by,
                    'complete_datex'     => $complete_date,
                    'complete_timex'     => $complete_time,
                    'complete_compx'     => $complete_comp,     // versi user audit
                    
                    'status_detailx_sf1' => '0',
                    'status_detailx_sf2' => '0',
                    'status_detailx_sf3' => '0',
                );
            }else{
                $data_app_update = array(
                    'complete_useridx'   => $complete_userid,
                    'complete_byx'       => $complete_by,
                    'complete_datex'     => $complete_date,
                    'complete_timex'     => $complete_time,
                    'complete_compx'     => $complete_comp,     // versi user audit
                    
                    'complete_userid'    => $complete_userid,
                    'complete_by'        => $complete_by,
                    'complete_date'      => $complete_date,
                    'complete_time'      => $complete_time,
                    'complete_comp'      => $complete_comp,      // versi user original
                    
                    'status_detail_sf1'  => '0',
                    'status_detailx_sf1' => '0',
                    'status_detail_sf2'  => '0',
                    'status_detailx_sf2' => '0',
                    'status_detail_sf3'  => '0',
                    'status_detailx_sf3' => '0',
                );
            }
        }else{
            if($cekLevelUserNm=='Auditor'){
                $data_app_update = array(
                    'complete_useridx' => $complete_userid,
                    'complete_byx'     => $complete_by,
                    'complete_datex'   => $complete_date,
                    'complete_timex'   => $complete_time,
                    'complete_compx'   => $complete_comp,     // versi user audit

                    'status_detailx'   => '0',
                );
            }else{
                $data_app_update = array(
                    'complete_useridx' => $complete_userid,
                    'complete_byx'     => $complete_by,
                    'complete_datex'   => $complete_date,
                    'complete_timex'   => $complete_time,
                    'complete_compx'   => $complete_comp,     // versi user audit
                    
                    'complete_userid'  => $complete_userid,
                    'complete_by'      => $complete_by,
                    'complete_date'    => $complete_date,
                    'complete_time'    => $complete_time,
                    'complete_comp'    => $complete_comp,      // versi user original
                    
                    'status_detail'    => '0',
                    'status_detailx'   => '0',
                );
            }
        }

        $data_app_update['comment_by']     = $complete_by;
        $data_app_update['comment_date']   = $complete_date;
        $data_app_update['comment_time']   = $complete_time;
        $data_app_update['comment_status'] = '1';
        $data_app_update['comment']        = 'Laporan ini telah direstore!!!';

        for ($i=1; $i <= $jml_app; $i++) { 
            $data_app_update['app'.$i.'_userid']         = null;
            $data_app_update['app'.$i.'_by']             = null;
            $data_app_update['app'.$i.'_date']           = null;
            $data_app_update['app'.$i.'_time']           = null;
            $data_app_update['app'.$i.'_position']       = null;
            $data_app_update['app'.$i.'_status']         = null;
            $data_app_update['app'.$i.'_comp']           = null;
            $data_app_update['app'.$i.'_personalid']     = null;
            $data_app_update['app'.$i.'_personalstatus'] = null;
        }
        
        $tablehead = 'tblfrm' . $frmkd . 'hdr';

        $this->M_restore->restore_laporan($data_app_update, $tablehead, $id);

        echo "<script>alert('Laporan berhasil direstore!!');</script>";
        redirect('laporan/C_laporan/openlap/' .$frmkd.'/'.$frmvrs, 'refresh');
    }
   
    function restore_laporan_pershift() {
        $session_data           = $this->session->userdata('logged_in');
        $data['username']       = $session_data['username'];
        $data['password']       = $session_data['password'];
        $data['jabid']          = $session_data['jabid'];
        $data['leveluserid']    = $session_data['leveluserid'];
        $data['nmdepan']        = $session_data['nmdepan'];
        $data['levelusernm']    = $session_data['levelusernm'];
        $data['bagnm']          = $session_data['bagnm'];
        $data['jabnm']          = $session_data['jabnm'];
        $data['Titel']          = 'Laporan';
        
        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];
        $bagianabbr             = $session_data['bagnm'];
        
        $cekLevelUserNm         = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        
        $menus                  = $this->M_menu->menus($LevelUser);
        $data2                  = array('menus' => $menus);
        
        $frmkode                = $this->uri->segment(4);
        $frmvrs                 = $this->uri->segment(5);
        $fileaksi               = $this->uri->segment(6);
        $id                     = $this->uri->segment(7);
        $shift                  = $this->uri->segment(8);
        $app_no                 = $this->uri->segment(9);
        
        $complete_userid        = $session_data['userid'];
        $complete_date          = date('Y-m-d');
        $complete_time          = date('H:i:s');
        $complete_by            = $session_data['nmlengkap'];
        $complete_comp          = $this->session->userdata('hostname');
        
        $dtfrm                  = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
        $data3                  = array('dtfrm' => $dtfrm);

        foreach ($dtfrm as $datafrm){
            $frmkd                 = $datafrm->formkd;
            $frm_vrs               = $datafrm->formversi;
            $frmefective_parameter = $datafrm->efective_parameter;
            $jml_app               = $datafrm->parameter_jlh_approval;
            $frm_jenis_approval    = $datafrm->parameter_jenis_approval;
        }

        if($frm_jenis_approval=='Shift'){
            if($cekLevelUserNm=='Auditor'){
                if($shift == 'shift_1'){
                    $data_app_update = array(
                        'complete_useridx'   => $complete_userid,
                        'complete_byx'       => $complete_by,
                        'complete_datex'     => $complete_date,
                        'complete_timex'     => $complete_time,
                        'complete_compx'     => $complete_comp,     // versi user audit
                        
                        'status_detailx_sf1' => '0',
                    );
                }elseif($shift == 'shift_2'){
                    $data_app_update = array(
                        'complete_useridx'   => $complete_userid,
                        'complete_byx'       => $complete_by,
                        'complete_datex'     => $complete_date,
                        'complete_timex'     => $complete_time,
                        'complete_compx'     => $complete_comp,     // versi user audit
                        
                        'status_detailx_sf2' => '0',
                    );
                }elseif($shift == 'shift_3'){
                    $data_app_update = array(
                        'complete_useridx'   => $complete_userid,
                        'complete_byx'       => $complete_by,
                        'complete_datex'     => $complete_date,
                        'complete_timex'     => $complete_time,
                        'complete_compx'     => $complete_comp,     // versi user audit
                        
                        'status_detailx_sf3' => '0',
                    );
                }
            }else{
                if($shift == 'shift_1'){
                    $data_app_update = array(
                        'complete_useridx'   => $complete_userid,
                        'complete_byx'       => $complete_by,
                        'complete_datex'     => $complete_date,
                        'complete_timex'     => $complete_time,
                        'complete_compx'     => $complete_comp,     // versi user audit
                        
                        'complete_userid'    => $complete_userid,
                        'complete_by'        => $complete_by,
                        'complete_date'      => $complete_date,
                        'complete_time'      => $complete_time,
                        'complete_comp'      => $complete_comp,      // versi user original
                        
                        'status_detail_sf1'  => '0',
                        'status_detailx_sf1' => '0',
                    );
                }elseif($shift == 'shift_2'){
                    $data_app_update = array(
                        'complete_useridx'   => $complete_userid,
                        'complete_byx'       => $complete_by,
                        'complete_datex'     => $complete_date,
                        'complete_timex'     => $complete_time,
                        'complete_compx'     => $complete_comp,     // versi user audit
                        
                        'complete_userid'    => $complete_userid,
                        'complete_by'        => $complete_by,
                        'complete_date'      => $complete_date,
                        'complete_time'      => $complete_time,
                        'complete_comp'      => $complete_comp,      // versi user original
                        
                        'status_detail_sf2'  => '0',
                        'status_detailx_sf2' => '0',
                    );
                }elseif($shift == 'shift_3'){
                    $data_app_update = array(
                        'complete_useridx'   => $complete_userid,
                        'complete_byx'       => $complete_by,
                        'complete_datex'     => $complete_date,
                        'complete_timex'     => $complete_time,
                        'complete_compx'     => $complete_comp,     // versi user audit
                        
                        'complete_userid'    => $complete_userid,
                        'complete_by'        => $complete_by,
                        'complete_date'      => $complete_date,
                        'complete_time'      => $complete_time,
                        'complete_comp'      => $complete_comp,      // versi user original
                        
                        'status_detail_sf3'  => '0',
                        'status_detailx_sf3' => '0',
                    );
                }
            }
        }

        $data_app_update['comment_by']     = $complete_by;
        $data_app_update['comment_date']   = $complete_date;
        $data_app_update['comment_time']   = $complete_time;
        $data_app_update['comment_status'] = '1';
        if($shift == 'shift_1'){
            $data_app_update['comment']        = 'Laporan ini telah direstore Shift 1 !!!';
            $data_app_update['app1_userid']         = null;
            $data_app_update['app1_by']             = null;
            $data_app_update['app1_date']           = null;
            $data_app_update['app1_time']           = null;
            $data_app_update['app1_position']       = null;
            $data_app_update['app1_status']         = null;
            $data_app_update['app1_comp']           = null;
            $data_app_update['app1_personalid']     = null;
            $data_app_update['app1_personalstatus'] = null;
        }elseif($shift == 'shift_2'){
            $data_app_update['comment']        = 'Laporan ini telah direstore Shift 2 !!!';
            $data_app_update['app2_userid']         = null;
            $data_app_update['app2_by']             = null;
            $data_app_update['app2_date']           = null;
            $data_app_update['app2_time']           = null;
            $data_app_update['app2_position']       = null;
            $data_app_update['app2_status']         = null;
            $data_app_update['app2_comp']           = null;
            $data_app_update['app2_personalid']     = null;
            $data_app_update['app2_personalstatus'] = null;
        }elseif($shift == 'shift_3'){
            $data_app_update['comment']        = 'Laporan ini telah direstore Shift 3 !!!';
            $data_app_update['app3_userid']         = null;
            $data_app_update['app3_by']             = null;
            $data_app_update['app3_date']           = null;
            $data_app_update['app3_time']           = null;
            $data_app_update['app3_position']       = null;
            $data_app_update['app3_status']         = null;
            $data_app_update['app3_comp']           = null;
            $data_app_update['app3_personalid']     = null;
            $data_app_update['app3_personalstatus'] = null;
        }
        
        $tablehead = 'tblfrm' . $frmkd . 'hdr';

        $this->M_restore->restore_laporan($data_app_update, $tablehead, $id);
        if($shift == 'shift_1'){
            echo "<script>alert('Laporan berhasil direstore shift 1!!');</script>";
        }elseif($shift == 'shift_2'){
            echo "<script>alert('Laporan berhasil direstore shift 2!!');</script>";
        }elseif($shift == 'shift_3'){
            echo "<script>alert('Laporan berhasil direstore shift 3!!');</script>";
        }
        redirect('laporan/C_laporan/openlap/' .$frmkd.'/'.$frmvrs, 'refresh');
    } 
}