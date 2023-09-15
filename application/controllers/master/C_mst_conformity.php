<?php
class C_mst_conformity extends  CI_Controller {
    function  __construct(){
		parent:: __construct();
		$this->load->helper('form','url');
		$this->load->model(array('M_user', 'M_menu','master/M_mst_conformity', 'form_input/M_forminput'));

        //////////////////////////////////
        /// prevent direct url accses
        $session_data = $this->session->userdata('logged_in');
        $leveluid     = $session_data['leveluserid'];
        $url_str      = uri_string();

        $akses_check = $this->M_user->check_akses_bylevelid($leveluid,'C_mst_conformity');
        if($akses_check==false){
            echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini..!!');
                          window.location.assign('";echo base_url();echo "C_login');
                       </script>"; 
        }
        /// end prevent direct url accses
        //////////////////////////////////
	}

    function index() {
            if($this->session->userdata('logged_in')) {
            $session_data 		        = $this->session->userdata('logged_in');
            $data['username'] 		    = $session_data['username'];
            $data['password']		    = $session_data['password'];
            $data['jabid'] 		        = $session_data['jabid'];
            $data['leveluserid'] 	    = $session_data['leveluserid'];
            $data['nmdepan']            = $session_data['nmdepan'];
            $data['levelusernm']        = $session_data['levelusernm'];
            $data['bagnm']              = $session_data['bagnm'];
            $data['jabnm']              = $session_data['jabnm'];

            $LevelUser = $session_data['leveluserid'];
            $UserName = $session_data['username'];
            $LevelUserNm = $session_data['levelusernm'];

            $cekLevelUserNm = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

          	$dt_conformity = $this->M_mst_conformity->get_conformityall();
            $data3 = array('dt_conformity' => $dt_conformity);

		    $this->load->view('master/V_mst_conformity', array_merge($data, $data2, $data3));

		} else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
                }
	}

    function getdetail_conformity(){
        $conformity_id             = trim($this->input->post('conformity_id'));
        // $conformity_id             = trim($this->input->get('id'));
        
        $dt_conformity = $this->M_mst_conformity->getdata_header($conformity_id);
        $dt_conformity_list = $this->M_mst_conformity->getdata_detail($conformity_id);

        foreach($dt_conformity as $row_header){
            $data1 = $row_header['conformity_id'];
            $data2 = $row_header['conformity_name'];
            $data3 = date('d-m-Y',strtotime($row_header['tanggal_efektif']));
        }

        $data4 ="";

        if(count($dt_conformity_list) > 0 ){
            foreach($dt_conformity_list as $row){
            $data4 .= '<tr><input type="hidden" name="conformity_list_id[]" id="conformity_list_id" value="'.$row['conformity_list_id'].'" size="1"/>
                            <td><input name="chk[]" type="checkbox" value="'.$row['conformity_list_id'].'"/></td>
                            <td><input type="text" name="conformity_list_name[]" id="conformity_list_name" class="conformity_list_name col-sm-12" value="'.$row['conformity_list_name'].'"/></td>
                            <td><input type="text" name="conformity_ref_website[]" id="conformity_ref_website" class="conformity_ref_website col-sm-12" value="'.$row['conformity_ref_website'].'"/></td>
                            <td><input type="text" name="conformity_sub_ref[]" id="conformity_sub_ref" class="conformity_sub_ref col-sm-12" value="'.$row['conformity_sub_ref'].'"/></td>
                            </tr>'; 
            }
        }else{
            $data4 .= '<tr><td><input name="chk[]" type="checkbox" value=""/></td>
                            <td><input type="text" name="conformity_list_name[]" id="conformity_list_name" class="conformity_list_name col-sm-12" value=""/></td>
                            <td><input type="text" name="conformity_ref_website[]" id="conformity_ref_website" class="conformity_ref_website col-sm-12" value=""/></td>
                            <td><input type="text" name="conformity_sub_ref[]" id="conformity_sub_ref" class="conformity_sub_ref col-sm-12" value=""/></td>
                            </tr>'; 
        }

        $datas = $data1."*".$data2."*".$data3."*".$data4."*";

        echo $datas;
    }

    function delete_detail_conformity(){
        $conformity_id             = trim($this->input->post('conformity_id'));

        
        $detail_result = $this->M_mst_conformity->delete_detail($conformity_id);
        if($detail_result=='1'){
            $header_result = $this->M_mst_conformity->delete_header($conformity_id);
                if($header_result=='1'){
                    echo $delete_data = "Data Berhasil Dihapus!!";
                }else{
                    echo $delete_data = "Data Header Batal Dihapus!!";
                }
        }else{
            echo $delete_data = "Data Detail Batal Dihapus!!";
        }
    }

       function form() {
            $session_data           = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['Titel']          = 'Home';
            
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            
            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);
            
            $jns_button             = $this->input->post('valbutton');
            
            $conformity_id          = addslashes($this->input->post('conformity_id'));
            $conformity_name        = addslashes($this->input->post('conformity_name'));
            $tanggal_efektif        = date('Y-m-d',strtotime(addslashes($this->input->post('tanggal_efektif'))));
            $created_date           = date('Y-m-d');
            $created_by             = $session_data['username'];
            $created_comp           = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $updated_date           = date('Y-m-d');
            $updated_by             = $session_data['username'];
            $updated_comp           = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            
            $conformity_list_id     = $this->input->post('conformity_list_id');
            $conformity_list_name   = $this->input->post('conformity_list_name');
            $conformity_ref_website = $this->input->post('conformity_ref_website');
            $conformity_sub_ref     = $this->input->post('conformity_sub_ref');            

            if($jns_button=='btnmodal_save'){

                if($conformity_id==''){
                    $conformity_id=$conformity_id;
                    $cekhead = $this->M_mst_conformity->cek_header($conformity_name, $tanggal_efektif);
                    
                    if($cekhead->num_rows() > 0 ){
                        $pesan = 'Data Benua/ Negara : '.$conformity_name.' dengan Tanggal Efektif : '.$tanggal_efektif.' sudah pernah disimpan ';
                            echo $pesan;
                    }else{
                        $data_header = array(
                                'conformity_name' => $conformity_name,
                                'tanggal_efektif' => $tanggal_efektif,
                                'created_by'      => $created_by,
                                'created_date'    => $created_date,
                                'created_comp'    => $created_comp
                            );

                            $insert_id = $this->M_mst_conformity->insert_hdr($data_header);
                            $maxid = $insert_id;

                            $jml = count($this->input->post('conformity_list_name'));

                            for($i=0; $i<$jml;$i++){
                              
                              if(trim($conformity_list_name[$i])   !=''){$n_conformity_list_name[$i]=$conformity_list_name[$i];}else{$n_conformity_list_name[$i]=NULL;}
                              if(trim($conformity_ref_website[$i]) !=''){$n_conformity_ref_website[$i]=$conformity_ref_website[$i];}else{$n_conformity_ref_website[$i]=NULL;}
                              if(trim($conformity_sub_ref[$i])     !=''){$n_conformity_sub_ref[$i]=$conformity_sub_ref[$i];}else{$n_conformity_sub_ref[$i]=NULL;}

                              $data_detail = array(
                                'conformity_list_name'   => $n_conformity_list_name[$i],
                                'conformity_ref_website' => $n_conformity_ref_website[$i],
                                'conformity_sub_ref'     => $n_conformity_sub_ref[$i],
                                'conformity_id'          => $maxid
                              );

                              $this->M_mst_conformity->insert_dtl($data_detail);
                            }
                        $pesan = 'Data berhasil disimpan ';
                            echo $pesan;
                    }
                }else{
                        $cekhead2 = $this->M_mst_conformity->cek_header2($conformity_id, $conformity_name, $tanggal_efektif);
                        
                        if($cekhead2->num_rows() > 0 ){
                            // echo $pesan = 'Data Benua/ Negara : '.$conformity_name.' dengan Tanggal Efektif : '.$tanggal_efektif.' sudah pernah disimpan ';

                            $data_header = array(
                                'updated_by'      => $updated_by,
                                'updated_date'    => $updated_date,
                                'updated_comp'    => $updated_comp
                                );

                            $this->M_mst_conformity->update_hdr($conformity_id,$data_header);

                            $jml = count($this->input->post('conformity_list_name'));
                            for($i=0; $i<$jml;$i++){

                              if(trim($conformity_list_name[$i])   !=''){$n_conformity_list_name[$i]=$conformity_list_name[$i];}else{$n_conformity_list_name[$i]=NULL;}
                              if(trim($conformity_ref_website[$i]) !=''){$n_conformity_ref_website[$i]=$conformity_ref_website[$i];}else{$n_conformity_ref_website[$i]=NULL;}
                              if(trim($conformity_sub_ref[$i])     !=''){$n_conformity_sub_ref[$i]=$conformity_sub_ref[$i];}else{$n_conformity_sub_ref[$i]=NULL;}

                              if(isset($conformity_list_id[$i])){

                                $data_detail = array(
                                    'conformity_list_name'   => $n_conformity_list_name[$i],
                                    'conformity_ref_website' => $n_conformity_ref_website[$i],
                                    'conformity_sub_ref'     => $n_conformity_sub_ref[$i]
                                  );

                                $conformitylist_id = $conformity_list_id[$i];

                                  $this->M_mst_conformity->update_dtl($conformitylist_id, $data_detail);

                              }else{

                                  $data_detail = array(
                                    'conformity_list_name'   => $n_conformity_list_name[$i],
                                    'conformity_ref_website' => $n_conformity_ref_website[$i],
                                    'conformity_sub_ref'     => $n_conformity_sub_ref[$i],
                                    'conformity_id'          => $conformity_id
                                  );

                                  $this->M_mst_conformity->insert_dtl($data_detail);
                              }
                            }
                            echo $pesan = 'Data berhasil Disimpan';

                        }else{

                            $data_header = array(
                                'conformity_name' => $conformity_name,
                                'tanggal_efektif' => $tanggal_efektif,
                                'created_by'      => $created_by,
                                'created_date'    => $created_date,
                                'created_comp'    => $created_comp
                            );

                            $insert_id = $this->M_mst_conformity->insert_hdr($data_header);
                            $maxid = $insert_id;

                            $jml = count($this->input->post('conformity_list_name'));

                            for($i=0; $i<$jml;$i++){
                              
                              if(trim($conformity_list_name[$i])   !=''){$n_conformity_list_name[$i]=$conformity_list_name[$i];}else{$n_conformity_list_name[$i]=NULL;}
                              if(trim($conformity_ref_website[$i]) !=''){$n_conformity_ref_website[$i]=$conformity_ref_website[$i];}else{$n_conformity_ref_website[$i]=NULL;}
                              if(trim($conformity_sub_ref[$i])     !=''){$n_conformity_sub_ref[$i]=$conformity_sub_ref[$i];}else{$n_conformity_sub_ref[$i]=NULL;}

                              $data_detail = array(
                                'conformity_list_name'   => $n_conformity_list_name[$i],
                                'conformity_ref_website' => $n_conformity_ref_website[$i],
                                'conformity_sub_ref'     => $n_conformity_sub_ref[$i],
                                'conformity_id'          => $maxid
                              );

                              $this->M_mst_conformity->insert_dtl($data_detail);
                            }
                        $pesan = 'Data berhasil disimpan ';
                            echo $pesan;
                        }                    
                    }                
            }elseif($jns_button=='btnmodal_delete'){
                    $chk = $this->input->post('chk');
                    $jmlchk = count($this->input->post('chk'));
                        for($i=0;$i<$jmlchk;$i++){
                            $modal_detail_id = $chk[$i];
                             $this->M_mst_conformity->modal_delete_detail($modal_detail_id);
                        }
                    echo $pesan = "Data berhasil dihapus...!!";
            }else{}
        }
}
?>


