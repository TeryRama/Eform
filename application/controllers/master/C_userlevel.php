<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_userlevel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('master/M_userlevel','M_user','M_menu'));
        $this->load->helper('form','url');
        $this->load->library('session');

        //////////////////////////////////
        /// prevent direct url accses
        $session_data = $this->session->userdata('logged_in');
        $leveluid     = $session_data['leveluserid'];
        $url_str      = uri_string();

        $akses_check = $this->M_user->check_akses_bylevelid($leveluid,'C_userlevel');
        if($akses_check==false){
            echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini..!!');
                          window.location.assign('";echo base_url();echo "C_login');
                       </script>"; 
        }
        /// end prevent direct url accses
        //////////////////////////////////
    }
//class fungsi awal ketika kita panggil controller barang
    function index(){
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
            $data['Titel']          = 'Master - level User';
            
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            
            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $data['dtcompany']      = $this->M_user->get_allcompany();
            
            $data['dtdivisi']       = $this->M_user->get_alldivisi();
            
            $data['dtdepartemen']   = $this->M_user->get_alldepartemen();
            
            $data['dtbagian']       = $this->M_user->get_allbagian();
            
            $dtlevel                = $this->M_userlevel->get_alllevel(); //model semua level
            $data3                  = array('dtlevel' => $dtlevel);

            $this->load->view('master/V_userlevel', array_merge($data, $data2,$data3));
        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_opt_divisi(){
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
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $id_company             = trim($this->input->post('id_company'));
            
            $opt_divisi             = $this->M_userlevel->get_opt_divisi($id_company);
            
            $list_divisi            = '';
            if(count($opt_divisi)>0){
                $no=0;
                foreach($opt_divisi as $row_divisi){$no++;
                    $list_divisi .= '<option value="'.$row_divisi->kodedivisi.'">' .$row_divisi->divisi. '</option>';
                }
            }else{}
            
            echo $html_divisi = $list_divisi;

        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_opt_dept(){
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
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $id_company             = trim($this->input->post('id_company'));
            $id_divisi              = trim($this->input->post('id_divisi'));
            
            $opt_dept               = $this->M_userlevel->get_opt_dept($id_company,$id_divisi);
            
            $list_dept              = '';
            if(count($opt_dept)>0){
                $no=0;
                foreach($opt_dept as $row_dept){$no++;
                    $list_dept .= '<option value="'.$row_dept->deptid.'">' .$row_dept->deptabbr. '</option>';
                }
            }else{}
            
            echo $html_dept = $list_dept;

        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_opt_bagian(){
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
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $id_company             = trim($this->input->post('id_company'));
            $id_divisi              = trim($this->input->post('id_divisi'));
            $id_dept                = trim($this->input->post('id_dept'));
            
            $opt_bagian             = $this->M_userlevel->get_opt_bagian($id_company,$id_divisi,$id_dept);
            
            $list_bagian            = '';
            if(count($opt_bagian)>0){
                $no=0;
                foreach($opt_bagian as $row_bagian){$no++;
                    $list_bagian .= '<option value="'.$row_bagian->bagianid.'">' .$row_bagian->bagianabbr. '</option>';
                }
            }else{}
            
            echo $html_bagian = $list_bagian;

        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function form(){
        $session_data           = $this->session->userdata('logged_in');
        $data['username']       = $session_data['username'];
        $data['password']       = $session_data['password'];
        $data['jabid']          = $session_data['jabid'];
        $data['leveluserid']    = $session_data['leveluserid'];
        $data['nmdepan']        = $session_data['nmdepan'];
        $data['levelusernm']    = $session_data['levelusernm'];
        $data['bagnm']          = $session_data['bagnm'];
        $data['jabnm']          = $session_data['jabnm'];
        $data['Titel']          = 'Master - Level User';
        
        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];
        
        $cekLevelUserNm         = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        
        $menus                  = $this->M_menu->menus($LevelUser);
        $data2                  = array('menus' => $menus);
        
        $dtlevel                = $this->M_userlevel->get_alllevel(); //model semua level
        $data3                  = array('dtlevel' => $dtlevel);
        
        $dtnmlv                 = $this->M_menu->getLevelnm($LevelUser); //model semua app
        $data8                  = array('dtnmlv'=>$dtnmlv);
        
        $list_bagian            = $this->M_userlevel->get_list_bagian();
        $data_list_bagian       = array('list_bagian' => $list_bagian);
        
        //ambil variabel URL
        $mau_ke                 = $this->uri->segment(4);
        $idu                    = $this->uri->segment(5);        
        
        //ambil variabel dari form
        $id                     = addslashes($this->input->post('leveluserid'));
        $id_audit               = addslashes($this->input->post('leveluserid_audit'));
        $kode                   = addslashes($this->input->post('leveluserid'));
        $namalevel              = addslashes($this->input->post('levelusernm'));
        $bagianid               = addslashes($this->input->post('bagianid'));
        $id_company             = addslashes($this->input->post('id_company'));
        $id_divisi              = addslashes($this->input->post('id_divisi'));
        $id_dept                = addslashes($this->input->post('id_dept'));
        $id_bagian              = addslashes($this->input->post('id_bagian'));
        $post_ori_akses         = $this->input->post('ori_akses');
        $post_audit_akses       = $this->input->post('audit_akses');
        
        if(isset($post_ori_akses)){$ori_akses     ='1';}else{$ori_akses='0';}
        if(isset($post_audit_akses)){$audit_akses ='1';}else{$audit_akses='0';}
        
        if(isset($o)){$btn_create                 ='1';}else{$btn_create='0';}
        
        $post_bagian_akses = $this->input->post('bagian_akses');
        if(isset($post_bagian_akses)){
            foreach($post_bagian_akses as $post_bagian_akses_item){
                $arr_val_bagian_akses[] = $post_bagian_akses_item;
            }
            $bagian_akses = implode(',',$arr_val_bagian_akses);
        }

        $data_btn_create       = $this->input->post('btn_create');
        $data_btn_update       = $this->input->post('btn_update');
        $data_btn_complete     = $this->input->post('btn_complete');
        $data_btn_delete       = $this->input->post('btn_delete');
        $data_btn_delete_dh    = $this->input->post('btn_delete_dh');
        $data_btn_export_pdf   = $this->input->post('btn_export_pdf');
        $data_btn_export_excel = $this->input->post('btn_export_excel');
        $data_btn_restore      = $this->input->post('btn_restore');

        if(isset($data_btn_create)){$btn_create='1';}else{$btn_create='0';}
        if(isset($data_btn_update)){$btn_update='1';}else{$btn_update='0';}
        if(isset($data_btn_complete)){$btn_complete='1';}else{$btn_complete='0';}
        if(isset($data_btn_delete)){$btn_delete='1';}else{$btn_delete='0';}
        if(isset($data_btn_delete_dh)){$btn_delete_dh='1';}else{$btn_delete_dh='0';}
        if(isset($data_btn_export_pdf)){$btn_export_pdf='1';}else{$btn_export_pdf='0';}
        if(isset($data_btn_export_excel)){$btn_export_excel='1';}else{$btn_export_excel='0';}
        if(isset($data_btn_restore)){$btn_restore='1';}else{$btn_restore='0';}

        //mengarahkan fungsi form sesuai dengan uri segmentnya
        if ($mau_ke == "add") { //jika uri segmentnya add
            $allcompany    = $this->M_userlevel->allcompany(); //model semua company
            $data_company  = array('allcompany'=>$allcompany);
            
            $allmenu       = $this->M_userlevel->allmenu(); //model semua menu
            $data5         = array('allmenu'=>$allmenu);
            
            $allform       = $this->M_userlevel->allform(); //model semua form
            $data6         = array('allform'=>$allform);
            
            $allapp        = $this->M_userlevel->allapp(); //model semua app
            $data7         = array('allapp'=>$allapp);
            
            $data4['aksi'] = 'aksi_add';
            $this->load->view('master/V_formleveluser', array_merge($data, $data2,$data3,$data4,$data5,$data6,$data7,$data8,$data_list_bagian,$data_company));

        }else if ($mau_ke == "edit") {//jika uri segmentnya edit
            $allcompany      = $this->M_userlevel->allcompany(); //model semua company
            $data_company    = array('allcompany'=>$allcompany);
            
            $allmenu         = $this->M_userlevel->allmenu2($idu); //model semua menu
            $data5           = array('allmenu'=>$allmenu);
            
            $allform         = $this->M_userlevel->allform2($idu); //model semua form
            $data6           = array('allform'=>$allform);
            
            $allapp          = $this->M_userlevel->allapp2($idu); //model semua app
            $data7           = array('allapp'=>$allapp);
            
            $allbutton       = $this->M_userlevel->allbutton($idu); //model semua button
            $data_button     = array('allbutton'=>$allbutton);
            
            
            $data['dtlevel'] = $this->M_userlevel->get_level_byid($idu);

            foreach($data['dtlevel'] as $level_row){
                $id_company = $level_row->id_company;
                $id_divisi  = $level_row->id_divisi;
                $id_dept    = $level_row->id_dept;
                $id_bagian  = $level_row->id_bagian;
            }

            $data['all_divisi_by'] = $this->M_userlevel->get_opt_divisi($id_company);
            $data['all_dept_by']   = $this->M_userlevel->get_opt_dept($id_company, $id_divisi);
            $data['all_bagian_by'] = $this->M_userlevel->get_opt_bagian($id_company, $id_divisi, $id_dept);
            
            $data['title']         = 'Edit Level user';
            $data['aksi']          = 'aksi_edit';
            
            $this->load->view('master/V_formleveluser',  array_merge($data,$data2,$data5,$data6,$data7,$data_button,$data_list_bagian,$data_company));

        }else if ($mau_ke == "aksi_add") {//jika uri segmentnya aksi_add sebagai fungsi untuk insert
            $cek_level = $this->M_userlevel->cek_level($namalevel);
            if($cek_level->num_rows() > 0 ){
                $allcompany      = $this->M_userlevel->allcompany(); //model semua company
                $data_company    = array('allcompany'=>$allcompany);
                
                $allmenu         = $this->M_userlevel->allmenu(); //model semua menu
                $data5           = array('allmenu'=>$allmenu);
                
                $allform         = $this->M_userlevel->allform(); //model semua form
                $data6           = array('allform'=>$allform);
                
                $allapp          = $this->M_userlevel->allapp(); //model semua app
                $data7           = array('allapp'=>$allapp);
                
                $data['message'] = 'Level user:  <b>'.$namalevel.'</b> sudah ada, silahkan ganti dengan level user yang lain ';
                $data4['aksi']   = 'aksi_add';
                $this->load->view('master/V_formleveluser', array_merge($data, $data2,$data3,$data4,$data5,$data6,$data7,$data8,$data_list_bagian));
            }else{
                $data = array(
                    'levelusernm'  => $namalevel,
                    'bagian_akses' => $bagian_akses,
                    'ori_akses'    => $ori_akses,
                    'audit_akses'  => $audit_akses,
                    'id_company'   => $id_company,
                    'id_divisi'    => $id_divisi,
                    'id_dept'      => $id_dept,
                    'bagid'        => $id_bagian,
                    'id_bagian'    => $id_bagian
                );
                $this->M_userlevel->insert_level($data); //model insert user level

                $maxid = $this->db->insert_id();

                $jmlsub =count($this->input->post('submenu'));//counting number of row's

                $data_button = array(
                    'leveluserid'       => $maxid,
                    'btn_create'        => $btn_create,
                    'btn_update'        => $btn_update,
                    'btn_delete'        => $btn_delete,
                    'btn_delete_dh'     => $btn_delete_dh,
                    'btn_export_pdf'    => $btn_export_pdf,
                    'btn_export_excel'  => $btn_export_excel,
                    'btn_complete'      => $btn_complete,
                    'btn_restore'       => $btn_restore
                );
                $this->M_userlevel->insert_allbutton($data_button); 
                //model insert data button akses
                
                $sub = $this->input->post('submenu');
                foreach ($sub as $dtsub){
                    $dtstring = explode('/',$dtsub);
                    $jmlarray = count($dtstring);
                    switch($jmlarray){
                        case $jmlarray=='1':
                            $test = $dtstring[0];
                            $data_menu = array(
                                            'leveluserid' => $maxid,
                                            'menuid'      => $test
                                        );
                        break;
                        case $jmlarray=='2':
                            $test = $dtstring[0];
                            $test2 = $dtstring[1];
                            $data_menu = array(
                                            'leveluserid' => $maxid,
                                            'menuid'      => $test,
                                            'submenuid'   => $test2
                                        );
                        break;
                        case $jmlarray=='3':
                            $test = $dtstring[0];
                            $test2 = $dtstring[1];
                            $test3 = $dtstring[2];
                            $data_menu = array(
                                            'leveluserid' => $maxid,
                                            'menuid'      => $test,
                                            'submenuid'   => $test2,
                                            'submenu2id'  => $test3
                                        );
                        break;
                        case $jmlarray=='4':
                            $test = $dtstring[0];
                            $test2 = $dtstring[1];
                            $test3 = $dtstring[2];
                            $test4 = $dtstring[3];
                            $data_menu = array(
                                            'leveluserid' => $maxid,
                                            'menuid'      => $test,
                                            'submenuid'   => $test2,
                                            'submenu2id'  => $test3,
                                            'submenu3id'  => $test4
                                        );
                        break;
                        default:
                        break;
                    }

                      $this->M_userlevel->insert_allmenu($data_menu);
                }

                $frm = $this->input->post('formid');

                foreach ($frm as $dtform){
                    $dtstring2 = explode('/',$dtform);
                    $jmlarray2 = count ($dtstring2);
                    switch($jmlarray2){
                        case $jmlarray2=='2':
                            $formid    = $dtstring2[0];
                            $formjnsid = $dtstring2[1];
                            $data_form = array(
                                            'leveluserid' => $maxid,
                                            'formid'      => $formid,
                                            'formjnsid'   => $formjnsid
                                        );
                        break;
                        case $jmlarray2=='3':
                            $formid         = $dtstring2[0];
                            $formjnsid      = $dtstring2[1];
                            $formkategoriid = $dtstring2[2];
                            $data_form  = array(
                                            'leveluserid'    => $maxid,
                                            'formid'         => $formid,
                                            'formjnsid'      => $formjnsid,
                                            'formkategoriid' => $formkategoriid
                                        );
                        break;
                        case $jmlarray2=='4':
                            $formid          = $dtstring2[0];
                            $formjnsid       = $dtstring2[1];
                            $formkategoriid  = $dtstring2[2];
                            $formkategori2id = $dtstring2[3];
                            $data_form  = array(
                                            'leveluserid'     => $maxid,
                                            'formid'          => $formid,
                                            'formjnsid'       => $formjnsid,
                                            'formkategoriid'  => $formkategoriid,
                                            'formkategori2id' => $formkategori2id
                                        );
                        break;
                        case $jmlarray2=='8':
                            $val_formid             = $dtstring2[0];
                            $val_formjnsid          = $dtstring2[1];
                            $val_formkategoriid     = $dtstring2[2];
                            $val_formkategori2id    = $dtstring2[3];
                            $val_form_create        = $dtstring2[4];
                            $val_form_update        = $dtstring2[5];
                            $val_form_delete        = $dtstring2[6];
                            $val_form_excel         = $dtstring2[7];
                            
                            if($val_formid          !=''){$formid=$val_formid;}else{$formid=NULL;}
                            if($val_formjnsid       !=''){$formjnsid=$val_formjnsid;}else{$formjnsid=NULL;}
                            if($val_formkategoriid  !=''){$formkategoriid=$val_formkategoriid;}else{$formkategoriid=NULL;}
                            if($val_formkategori2id !=''){$formkategori2id=$val_formkategori2id;}else{$formkategori2id=NULL;}
                            if($val_form_create     !=''){$form_create=$val_form_create;}else{$form_create=NULL;}
                            if($val_form_update     !=''){$form_update=$val_form_update;}else{$form_update=NULL;}
                            if($val_form_delete     !=''){$form_delete=$val_form_delete;}else{$form_delete=NULL;}
                            if($val_form_excel      !=''){$form_excel=$val_form_excel;}else{$form_excel=NULL;}

                            $data_form  = array(
                                            'leveluserid'     => $maxid,
                                            'formid'          => $formid,
                                            'formjnsid'       => $formjnsid,
                                            'formkategoriid'  => $formkategoriid,
                                            'formkategori2id' => $formkategori2id,
                                            'form_create'     => $form_create,
                                            'form_update'     => $form_update,
                                            'form_delete'     => $form_delete,
                                            'form_excel'      => $form_excel
                                        );
                        break;
                        default:
                            echo "<script>alert('$jmlarray2');</script>";
                        break;
                    }
                      $this->M_userlevel->insert_allform($data_form);
                }

                $jmlapp      = $this->input->post('dtjml_app');
                $dtappformid = $this->input->post('appformid');
                $app1        = $this->input->post('app1');
                $app2        = $this->input->post('app2');
                $app3        = $this->input->post('app3');
                $app4        = $this->input->post('app4');
                $app5        = $this->input->post('app5');
                $app6        = $this->input->post('app6');
                $app7        = $this->input->post('app7');
                $app8        = $this->input->post('app8');
                $app9        = $this->input->post('app9');
                $app10       = $this->input->post('app10');

                for($i=0; $i<=$jmlapp;$i++){
                    if(isset($app1[$i])){$dtapp1[$i]='1';}else{$dtapp1[$i]='0';}
                    if(isset($app2[$i])){$dtapp2[$i]='1';}else{$dtapp2[$i]='0';}
                    if(isset($app3[$i])){$dtapp3[$i]='1';}else{$dtapp3[$i]='0';}
                    if(isset($app4[$i])){$dtapp4[$i]='1';}else{$dtapp4[$i]='0';}
                    if(isset($app5[$i])){$dtapp5[$i]='1';}else{$dtapp5[$i]='0';}
                    if(isset($app6[$i])){$dtapp6[$i]='1';}else{$dtapp6[$i]='0';}
                    if(isset($app7[$i])){$dtapp7[$i]='1';}else{$dtapp7[$i]='0';}
                    if(isset($app8[$i])){$dtapp8[$i]='1';}else{$dtapp8[$i]='0';}
                    if(isset($app9[$i])){$dtapp9[$i]='1';}else{$dtapp9[$i]='0';}
                    if(isset($app10[$i])){$dtapp10[$i]='1';}else{$dtapp10[$i]='0';}

                    if(isset($dtappformid[$i])){
                        $dtstring3 = explode('/',$dtappformid[$i]);
                        $jmlarray3 = count ($dtstring3);
                        switch($jmlarray3){
                            case $jmlarray3=='2':
                                $appformid = $dtstring3[0];
                                $appformjnsid = $dtstring3[1];
                                $data_app = array(
                                                'leveluserid' => $maxid,
                                                'formid'      =>$appformid,
                                                'app1'        => $dtapp1[$i],
                                                'app2'        => $dtapp2[$i],
                                                'app3'        => $dtapp3[$i],
                                                'app4'        => $dtapp4[$i],
                                                'app5'        => $dtapp5[$i],
                                                'app6'        => $dtapp6[$i],
                                                'app7'        => $dtapp7[$i],
                                                'app8'        => $dtapp8[$i],
                                                'app9'        => $dtapp9[$i],
                                                'app10'       => $dtapp10[$i],
                                                'formjnsid'   => $appformjnsid
                                            );
                                $this->M_userlevel->insert_allapp($data_app);
                            break;
                            case $jmlarray3=='3':
                                $appformid         = $dtstring3[0];
                                $appformjnsid      = $dtstring3[1];
                                $appformkategoriid = $dtstring3[2];
                                $data_app = array(
                                                'leveluserid'    => $maxid,
                                                'formid'         => $appformid,
                                                'app1'           => $dtapp1[$i],
                                                'app2'           => $dtapp2[$i],
                                                'app3'           => $dtapp3[$i],
                                                'app4'           => $dtapp4[$i],
                                                'app5'           => $dtapp5[$i],
                                                'app6'           => $dtapp6[$i],
                                                'app7'           => $dtapp7[$i],
                                                'app8'           => $dtapp8[$i],
                                                'app9'           => $dtapp9[$i],
                                                'app10'          => $dtapp10[$i],
                                                'formjnsid'      => $appformjnsid,
                                                'formkategoriid' => $appformkategoriid
                                            );
                                $this->M_userlevel->insert_allapp($data_app);
                            break;
                            case $jmlarray3=='4':
                                $appformid          = $dtstring3[0];
                                $appformjnsid       = $dtstring3[1];
                                $appformkategoriid  = $dtstring3[2];
                                $appformkategori2id = $dtstring3[3];
                                 $data_app = array(
                                                'leveluserid'     => $maxid,
                                                'formid'          =>$appformid,
                                                'app1'            => $dtapp1[$i],
                                                'app2'            => $dtapp2[$i],
                                                'app3'            => $dtapp3[$i],
                                                'app4'            => $dtapp4[$i],
                                                'app5'            => $dtapp5[$i],
                                                'app6'            => $dtapp6[$i],
                                                'app7'            => $dtapp7[$i],
                                                'app8'            => $dtapp8[$i],
                                                'app9'            => $dtapp9[$i],
                                                'app10'           => $dtapp10[$i],
                                                'formjnsid'       => $appformjnsid,
                                                'formkategoriid'  => $appformkategoriid,
                                                'formkategori2id' => $appformkategori2id
                                            );
                                $this->M_userlevel->insert_allapp($data_app);
                            break;
                            default:
                            break;
                        }
                    }

                }
               
                //strat ---insert auto uset audit
                $data_audit = array(
                    'levelusernm'  => 'Auditor '.$namalevel,
                    'bagian_akses' => $bagian_akses,
                    'ori_akses'    => $ori_akses,
                    'audit_akses'  => $audit_akses,
                    'id_company'   => $id_company,
                    'id_divisi'    => $id_divisi,
                    'id_dept'      => $id_dept,
                    'bagid'        => $id_bagian,
                    'id_bagian'    => $id_bagian
                );
                $this->M_userlevel->insert_level_audit($data_audit); //model insert user level
                $maxid_audit = $this->db->insert_id();

                $this->M_userlevel->insert_allbutton_audit($maxid, $maxid_audit);
                $this->M_userlevel->insert_allmenu_audit($maxid, $maxid_audit);
                $this->M_userlevel->insert_allform_audit($maxid, $maxid_audit);
                $this->M_userlevel->insert_allapp_audit($maxid, $maxid_audit);
                //end ---insert auto uset audit

                $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>"); //pesan yang tampil setalah berhasil di insert
                redirect('master/C_userlevel');
            }
        }else if ($mau_ke == "aksi_edit") { //jika uri segmentnya aksi_edit sebagai fungsi untuk update
            $data = array(
                'levelusernm'   => $namalevel,
                'bagian_akses'  => $bagian_akses,
                'ori_akses'     => $ori_akses,
                'audit_akses'   => $audit_akses,
                'id_company'    => $id_company,
                'id_divisi'     => $id_divisi,
                'id_dept'       => $id_dept,
                'id_bagian'     => $id_bagian
            );

            $this->M_userlevel->delete_button_akses($id);
            $this->M_userlevel->delete_menu_akses($id);
            $this->M_userlevel->delete_form_akses($id);
            $this->M_userlevel->delete_app_akses($id);

            $this->M_userlevel->delete_button_akses_audit($id_audit);
            $this->M_userlevel->delete_menu_akses_audit($id_audit);
            $this->M_userlevel->delete_form_akses_audit($id_audit);
            $this->M_userlevel->delete_app_akses_audit($id_audit);

            $this->M_userlevel->update_level($id,$data); //modal update data userlevel

            $data_button = array(
                'leveluserid'       => $id,
                'btn_create'        => $btn_create,
                'btn_update'        => $btn_update,
                'btn_delete'        => $btn_delete,
                'btn_delete_dh'     => $btn_delete_dh,
                'btn_export_pdf'    => $btn_export_pdf,
                'btn_export_excel'  => $btn_export_excel,
                'btn_complete'      => $btn_complete,
                'btn_restore'       => $btn_restore
            );
            $this->M_userlevel->insert_allbutton($data_button); //model insert data button akses


            $jmlsub =count($this->input->post('submenu'));//counting number of row's

            $sub = $this->input->post('submenu');
            foreach ($sub as $dtsub){
                $dtstring = explode('/',$dtsub);
                $jmlarray = count($dtstring);
                switch($jmlarray){
                    case $jmlarray=='1':
                        $test = $dtstring[0];
                        $data_menu = array(
                                        'leveluserid' => $id,
                                        'menuid'      => $test
                                    );
                    break;
                    case $jmlarray=='2':
                        $test  = $dtstring[0];
                        $test2 = $dtstring[1];
                        $data_menu = array(
                                        'leveluserid' => $id,
                                        'menuid'      => $test,
                                        'submenuid'   => $test2
                                    );
                    break;
                    case $jmlarray=='3':
                        $test  = $dtstring[0];
                        $test2 = $dtstring[1];
                        $test3 = $dtstring[2];
                        $data_menu = array(
                                        'leveluserid' => $id,
                                        'menuid'      => $test,
                                        'submenuid'   => $test2,
                                        'submenu2id'  => $test3
                                    );
                    break;
                    case $jmlarray=='4':
                        $test  = $dtstring[0];
                        $test2 = $dtstring[1];
                        $test3 = $dtstring[2];
                        $test4 = $dtstring[3];
                        $data_menu = array(
                                        'leveluserid' => $id,
                                        'menuid'      => $test,
                                        'submenuid'   => $test2,
                                        'submenu2id'  => $test3,
                                        'submenu3id'  => $test4
                                    );
                    break;
                    default:
                    break;
                }

                  $this->M_userlevel->insert_allmenu($data_menu);
            }

            $frm = $this->input->post('formid');
            foreach ($frm as $dtform){
                $dtstring2 = explode('/',$dtform);
                $jmlarray2 = count ($dtstring2);
                switch($jmlarray2){
                    case $jmlarray2=='2':
                        $formid    = $dtstring2[0];
                        $formjnsid = $dtstring2[1];
                        $data_form = array(
                                        'leveluserid' => $id,
                                        'formid'      => $formid,
                                        'formjnsid'   => $formjnsid
                                    );
                    break;
                    case $jmlarray2=='3':
                        $formid         = $dtstring2[0];
                        $formjnsid      = $dtstring2[1];
                        $formkategoriid = $dtstring2[2];
                        $data_form  = array(
                                        'leveluserid'    => $id,
                                        'formid'         => $formid,
                                        'formjnsid'      => $formjnsid,
                                        'formkategoriid' => $formkategoriid
                                    );
                    break;
                    case $jmlarray2=='4':
                        $formid          = $dtstring2[0];
                        $formjnsid       = $dtstring2[1];
                        $formkategoriid  = $dtstring2[2];
                        $formkategori2id = $dtstring2[3];
                        $data_form  = array(
                                        'leveluserid'     => $id,
                                        'formid'          => $formid,
                                        'formjnsid'       => $formjnsid,
                                        'formkategoriid'  => $formkategoriid,
                                        'formkategori2id' => $formkategori2id
                                    );
                    break;
                    case $jmlarray2=='8':
                        $val_formid             = $dtstring2[0];
                        $val_formjnsid          = $dtstring2[1];
                        $val_formkategoriid     = $dtstring2[2];
                        $val_formkategori2id    = $dtstring2[3];
                        $val_form_create        = $dtstring2[4];
                        $val_form_update        = $dtstring2[5];
                        $val_form_delete        = $dtstring2[6];
                        $val_form_excel         = $dtstring2[7];
                        
                        if($val_formid          !=''){$formid=$val_formid;}else{$formid=NULL;}
                        if($val_formjnsid       !=''){$formjnsid=$val_formjnsid;}else{$formjnsid=NULL;}
                        if($val_formkategoriid  !=''){$formkategoriid=$val_formkategoriid;}else{$formkategoriid=NULL;}
                        if($val_formkategori2id !=''){$formkategori2id=$val_formkategori2id;}else{$formkategori2id=NULL;}
                        if($val_form_create     !=''){$form_create=$val_form_create;}else{$form_create=NULL;}
                        if($val_form_update     !=''){$form_update=$val_form_update;}else{$form_update=NULL;}
                        if($val_form_delete     !=''){$form_delete=$val_form_delete;}else{$form_delete=NULL;}
                        if($val_form_excel      !=''){$form_excel=$val_form_excel;}else{$form_excel=NULL;}

                        $data_form  = array(
                                        'leveluserid'     => $id,
                                        'formid'          => $formid,
                                        'formjnsid'       => $formjnsid,
                                        'formkategoriid'  => $formkategoriid,
                                        'formkategori2id' => $formkategori2id,
                                        'form_create'     => $form_create,
                                        'form_update'     => $form_update,
                                        'form_delete'     => $form_delete,
                                        'form_excel'      => $form_excel
                                    );
                    break;
                    default:
                    break;
                }
                $this->M_userlevel->insert_allform($data_form);
            }

            $jmlapp      = $this->input->post('dtjml_app');
            $dtappformid = $this->input->post('appformid');
            $app1        = $this->input->post('app1');
            $app2        = $this->input->post('app2');
            $app3        = $this->input->post('app3');
            $app4        = $this->input->post('app4');
            $app5        = $this->input->post('app5');
            $app6        = $this->input->post('app6');
            $app7        = $this->input->post('app7');
            $app8        = $this->input->post('app8');
            $app9        = $this->input->post('app9');
            $app10       = $this->input->post('app10');

            for($i=0; $i<=$jmlapp;$i++){
                if(isset($app1[$i])){$dtapp1[$i]='1';}else{$dtapp1[$i]='0';}
                if(isset($app2[$i])){$dtapp2[$i]='1';}else{$dtapp2[$i]='0';}
                if(isset($app3[$i])){$dtapp3[$i]='1';}else{$dtapp3[$i]='0';}
                if(isset($app4[$i])){$dtapp4[$i]='1';}else{$dtapp4[$i]='0';}
                if(isset($app5[$i])){$dtapp5[$i]='1';}else{$dtapp5[$i]='0';}
                if(isset($app6[$i])){$dtapp6[$i]='1';}else{$dtapp6[$i]='0';}
                if(isset($app7[$i])){$dtapp7[$i]='1';}else{$dtapp7[$i]='0';}
                if(isset($app8[$i])){$dtapp8[$i]='1';}else{$dtapp8[$i]='0';}
                if(isset($app9[$i])){$dtapp9[$i]='1';}else{$dtapp9[$i]='0';}
                if(isset($app10[$i])){$dtapp10[$i]='1';}else{$dtapp10[$i]='0';}

                if(isset($dtappformid[$i])){
                    $dtstring3 = explode('/',$dtappformid[$i]);
                    $jmlarray3 = count ($dtstring3);
                    switch($jmlarray3){
                        case $jmlarray3=='2':
                            $appformid    = $dtstring3[0];
                            $appformjnsid = $dtstring3[1];
                            $data_app = array(
                                            'leveluserid' => $id,
                                            'formid'      =>$appformid,
                                            'app1'        => $dtapp1[$i],
                                            'app2'        => $dtapp2[$i],
                                            'app3'        => $dtapp3[$i],
                                            'app4'        => $dtapp4[$i],
                                            'app5'        => $dtapp5[$i],
                                            'app6'        => $dtapp6[$i],
                                            'app7'        => $dtapp7[$i],
                                            'app8'        => $dtapp8[$i],
                                            'app9'        => $dtapp9[$i],
                                            'app10'       => $dtapp10[$i],
                                            'formjnsid'   => $appformjnsid
                                        );
                            $this->M_userlevel->insert_allapp($data_app);
                        break;
                        case $jmlarray3=='3':
                            $appformid         = $dtstring3[0];
                            $appformjnsid      = $dtstring3[1];
                            $appformkategoriid = $dtstring3[2];
                            $data_app = array(
                                            'leveluserid'    => $id,
                                            'formid'         =>$appformid,
                                            'app1'           => $dtapp1[$i],
                                            'app2'           => $dtapp2[$i],
                                            'app3'           => $dtapp3[$i],
                                            'app4'           => $dtapp4[$i],
                                            'app5'           => $dtapp5[$i],
                                            'app6'           => $dtapp6[$i],
                                            'app7'           => $dtapp7[$i],
                                            'app8'           => $dtapp8[$i],
                                            'app9'           => $dtapp9[$i],
                                            'app10'          => $dtapp10[$i],
                                            'formjnsid'      => $appformjnsid,
                                            'formkategoriid' => $appformkategoriid
                                        );
                            $this->M_userlevel->insert_allapp($data_app);
                        break;
                        case $jmlarray3=='4':
                            $appformid          = $dtstring3[0];
                            $appformjnsid       = $dtstring3[1];
                            $appformkategoriid  = $dtstring3[2];
                            $appformkategori2id = $dtstring3[3];
                            $data_app = array(
                                            'leveluserid'     => $id,
                                            'formid'          =>$appformid,
                                            'app1'            => $dtapp1[$i],
                                            'app2'            => $dtapp2[$i],
                                            'app3'            => $dtapp3[$i],
                                            'app4'            => $dtapp4[$i],
                                            'app5'            => $dtapp5[$i],
                                            'app6'            => $dtapp6[$i],
                                            'app7'            => $dtapp7[$i],
                                            'app8'            => $dtapp8[$i],
                                            'app9'            => $dtapp9[$i],
                                            'app10'           => $dtapp10[$i],
                                            'formjnsid'       => $appformjnsid,
                                            'formkategoriid'  => $appformkategoriid,
                                            'formkategori2id' => $appformkategori2id
                                        );
                             $this->M_userlevel->insert_allapp($data_app);
                        break;
                        default:
                        break;
                    }
                }

            }

            $maxid       = $kode;
            $maxid_audit = $id_audit;

            $data_audit = array(
                                'levelusernm'   => 'Auditor '.$namalevel,
                                'bagian_akses'  => $bagian_akses,
                                'ori_akses'     => $ori_akses,
                                'audit_akses'   => $audit_akses,
                                'id_company'    => $id_company,
                                'id_divisi'     => $id_divisi,
                                'id_dept'       => $id_dept,
                                'id_bagian'     => $id_bagian
                            );

            $this->M_userlevel->update_level_audit($id_audit,$data_audit); //modal update data userlevel

            $this->M_userlevel->insert_allbutton_audit($maxid, $maxid_audit);
            $this->M_userlevel->insert_allmenu_audit($maxid, $maxid_audit);
            $this->M_userlevel->insert_allform_audit($maxid, $maxid_audit);
            $this->M_userlevel->insert_allapp_audit($maxid, $maxid_audit);

            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>"); //pesan yang tampil setelah berhasil di update

            redirect('master/C_userlevel',  array_merge($data, $data2));
        }
    }

    function hapus($id){ //fungsi hapus barang sesuai dengan id
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
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $id                     = $this->uri->segment(4);
            $id_audit               = $this->uri->segment(5);
            
            $this->M_userlevel->delete_button_akses($id);
            $this->M_userlevel->del_level($id);
            $this->M_userlevel->del_allmenu($id);
            $this->M_userlevel->del_allform($id);
            $this->M_userlevel->del_allapp($id);
            
            $this->M_userlevel->delete_button_akses_audit($id_audit);
            $this->M_userlevel->del_level_audit($id_audit);
            $this->M_userlevel->del_allmenu_audit($id_audit);
            $this->M_userlevel->del_allform_audit($id_audit);
            $this->M_userlevel->del_allapp_audit($id_audit);            
            
            $this->session->set_flashdata("pesan", "<div class =\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Barang berhasil dihapus</div>");
            redirect('master/C_userlevel');    
        }else{
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}

