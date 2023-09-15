<?php

class C_history_activity extends CI_Controller {

	var $data = array();

	function __construct() {

		parent :: __construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1',TRUE);
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');

		$this->load->model(array('M_menu','tambahan/lain_lain/M_history_activity'));

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

            if ($cekLevelUserNm == "Auditor") {
                $list_history      = $this->M_history_activity->get_list_history_x();
                $data_list_history = array('list_history' => $list_history);

                $list_history_delete      = $this->M_history_activity->get_list_history_delete_x();
                $data_list_history_delete = array('list_history_delete' => $list_history_delete);
                $data['status_au'] = 'yes';
            }else{
                $list_history      = $this->M_history_activity->get_list_history();
                $data_list_history = array('list_history' => $list_history);

                $list_history_delete      = $this->M_history_activity->get_list_history_delete();
                $data_list_history_delete = array('list_history_delete' => $list_history_delete);
                $data['date_from'] = 'no';
            }

            $data['date_from']             = '';
            $data['date_to']               = '';
            $data['formjnsnm']             = '';

            $this->load->view('tambahan/lain_lain/V_history_activity', array_merge($data, $data2, $data_list_history, $data_list_history_delete));

        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }


    function move_history() {
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
            $nmdepan                = $session_data['nmdepan'];

            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            $Bagian                 = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            //$arr_history             = $this->input->post('arr_history');
            $post_no                 = $this->input->post('post_no');
            $post_tanggal            = $this->input->post('post_tanggal');
            $post_jam                = $this->input->post('post_jam');
            $post_komputer           = $this->input->post('post_komputer');
            $post_user               = $this->input->post('post_user');
            $post_form_kode          = $this->input->post('post_form_kode');
            $post_form_jenis         = $this->input->post('post_form_jenis');
            $post_form_kategori      = $this->input->post('post_form_kategori');
            $post_form_subkategori   = $this->input->post('post_form_subkategori');
            $post_data_old           = $this->input->post('post_data_old');
            $post_data_new           = $this->input->post('post_data_new');
            $post_headerid           = $this->input->post('post_headerid');
            $post_detail_id          = $this->input->post('post_detail_id');

           // $count_history  = count($arr_history);
            $create_by      = $nmdepan;      
            $create_date    = date('Y-m-d');
            $create_time    = date('H:i:s');
            $create_comp    = gethostbyaddr($_SERVER['REMOTE_ADDR']);

            //$history_tanggal      = $arr_history[2];
            

            $detail_history_activity = array(
                         'tanggal'          => $post_tanggal,
                         'jam'              => $post_jam,
                         'komputer'         => $post_komputer,
                         'history_user'     => $post_user,
                         'form_kode'        => $post_form_kode,
                         'form_jenis'       => trim($post_form_jenis),
                         'form_kategori'    => trim($post_form_kategori),
                         'form_subkategori' => trim($post_form_subkategori),
                         'data_lama'        => trim($post_data_old),
                         'data_baru'        => trim($post_data_new),
                         'data_headerid'    => $post_headerid,
                         'data_detail_id'   => $post_detail_id,
                         'create_by'        => $create_by,
                         'create_date'      => $create_date,
                         'create_time'      => $create_time,
                         'create_comp'      => $create_comp,
                         'history_action'   => 'U'
                    );

            $this->M_history_activity->insert_history_activity($detail_history_activity);
            
            echo $move = $count_history;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }

    function move_history_delete() {
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
            $nmdepan                = $session_data['nmdepan'];

            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            $Bagian                 = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            //$arr_history             = $this->input->post('arr_history');
            $delete_no                 = $this->input->post('delete_no');
            $delete_tanggal            = $this->input->post('delete_tanggal');
            $delete_jam                = $this->input->post('delete_jam');
            $delete_komputer           = $this->input->post('delete_komputer');
            $delete_user               = $this->input->post('delete_user');
            $delete_form_kode          = $this->input->post('delete_form_kode');
            $delete_form_jenis         = $this->input->post('delete_form_jenis');
            $delete_form_kategori      = $this->input->post('delete_form_kategori');
            $delete_form_subkategori   = $this->input->post('delete_form_subkategori');
            $delete_data_old           = $this->input->post('delete_data_old');

           // $count_history  = count($arr_history);
            $create_by      = $nmdepan;      
            $create_date    = date('Y-m-d');
            $create_time    = date('H:i:s');
            $create_comp    = gethostbyaddr($_SERVER['REMOTE_ADDR']);

            //$history_tanggal      = $arr_history[2];
            

            $detail_history_activity = array(
                         'tanggal'          => $delete_tanggal,
                         'jam'              => $delete_jam,
                         'komputer'         => $delete_komputer,
                         'history_user'     => $delete_user,
                         'form_kode'        => $delete_form_kode,
                         'form_jenis'       => trim($delete_form_jenis),
                         'form_kategori'    => trim($delete_form_kategori),
                         'form_subkategori' => trim($delete_form_subkategori),
                         'data_delete'      => trim($delete_data_old),
                         'create_by'        => $create_by,
                         'create_date'      => $create_date,
                         'create_time'      => $create_time,
                         'create_comp'      => $create_comp,
                         'history_action'   => 'D'
                    );

            $this->M_history_activity->insert_history_activity($detail_history_activity);
            
            echo $move = $count_history;
        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }

    function get_history_by_date() {
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
            $formjnsnm    = $this->input->post('formjnsnm'); 

            if ($cekLevelUserNm == "Auditor") {
                $list_history      = $this->M_history_activity->get_history_activity_bydate_x($date_from, $date_to, $formjnsnm);
                $data_list_history = array('list_history' => $list_history);

                $list_history_delete      = $this->M_history_activity->get_list_history_delete_bydate_x($date_from, $date_to, $formjnsnm);
                $data_list_history_delete = array('list_history_delete' => $list_history_delete);

                $data['status_au'] = 'yes';
            }else{
                $list_history      = $this->M_history_activity->get_history_activity_bydate($date_from, $date_to, $formjnsnm);
                $data_list_history = array('list_history' => $list_history);

                $list_history_delete      = $this->M_history_activity->get_list_history_delete_bydate($date_from, $date_to, $formjnsnm);
                $data_list_history_delete = array('list_history_delete' => $list_history_delete);

                $data['status_au'] = 'no';
            }

            $data['date_from']          = $date_from;
            $data['date_to']            = $date_to;
            $data['formjnsnm']          = $formjnsnm;

            $this->load->view('tambahan/lain_lain/V_history_activity', array_merge($data, $data2, $data_list_history, $data_list_history_delete));

        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }

    function open_data() {
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
            $nmdepan                = $session_data['nmdepan'];

            $cekLevelUserNm         = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            $Bagian                 = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            //$arr_history             = $this->input->post('arr_history');
            $valbutton                 = $this->input->post('valbutton');
            $arr_valbutton             = explode('//', $valbutton);

            $val_form_kode = strtolower(str_replace('-', '', $arr_valbutton[0]));
            $val_headerid  = $arr_valbutton[1];
            $val_detail_id = $arr_valbutton[2];

            $tabel = 'tblfrm'.$val_form_kode.'hdr';

                switch ($val_form_kode){
                    case $val_form_kode == "frmehs037":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs082":
                        $tgl_parameter = 'tgl_produksi';
                    break;
                    case $val_form_kode == "frmnon039":
                        $tgl_parameter = 'tgl_produksi';
                    break;
                    case $val_form_kode == "frmnon041":
                        $tgl_parameter = 'tgl_antar';
                    break;
                    case $val_form_kode == "frmnon003":
                        $tgl_parameter = 'tgl_dok';
                    break;
                    case $val_form_kode == "frmnon006":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad150":
                        $tgl_parameter = 'tgl_produksi';
                    break;
                    case $val_form_kode == "intqad145":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad118":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad090":
                        $tgl_parameter = 'tanggal';
                    break;
                     case $val_form_kode == "frmfss529":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmnon052":
                        $tgl_parameter = 'tgl_laporan';
                    break;
                    case $val_form_kode == "frmnon031":
                        $tgl_parameter = 'tgl_antar';
                    break;
                    case $val_form_kode == "intqad047":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad094":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad133":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmfss499":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad064":
                        $tgl_parameter = 'tanggal_laporan';
                    break;
                    case $val_form_kode == "frmfss084":
                        $tgl_parameter = 'completedate';
                    break;
                    case $val_form_kode == "intqad074":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad061":
                        $tgl_parameter = 'tgl_laporan';
                    break;
                    case $val_form_kode == "frmfss482":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad098":
                        $tgl_parameter = 'create_date';
                    break;
                    case $val_form_kode == "intqad099":
                        $tgl_parameter = 'create_date';
                    break;
                    case $val_form_kode == "frmfss092":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmnon073":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmfss155":
                        $tgl_parameter = 'completedate';
                    break;
                    case $val_form_kode == "intqad070":
                        $tgl_parameter = 'tanggal_laporan';
                    break;
                    case $val_form_kode == "intqad088":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad086":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad085":
                        $tgl_parameter = 'tanggal';
                    break;
                     case $val_form_kode == "frmnon040":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad134":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmfss089":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad104":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmfss088":
                        $tgl_parameter = 'date';
                    break;
                    case $val_form_kode == "intqad078":
                        $tgl_parameter = 'tgl_dok';
                    break;
                    case $val_form_kode == "frmhwt001":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmnon009":
                        $tgl_parameter = 'tgl_laporan';
                    break;
                    case $val_form_kode == "frmlqs001":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs002":
                        $tgl_parameter = 'tgl_dokumen';
                    break;
                    case $val_form_kode == "frmehs058":
                        $tgl_parameter = 'tgl_sampling';
                    break;
                    case $val_form_kode == "frmehs059":
                        $tgl_parameter = 'tgl_pengambilan_sampel';
                    break;
                    case $val_form_kode == "frmlqs093":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs037":
                        $tgl_parameter = 'tgl_uji';
                    break;
                    case $val_form_kode == "frmlqs077":
                        $tgl_parameter = 'tgl_data';
                    break;
                    case $val_form_kode == "frmlqs030":
                       $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs031":
                       $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs212":
                       $tgl_parameter = 'create_date';
                    break;
                    case $val_form_kode == "frmlqs181":
                       $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs099":
                       $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs057":
                       $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs094":
                       $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs072":
                       $tgl_parameter = 'tgl_uji';
                    break;
                    case $val_form_kode == "frmlqs096":
                       $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs095":
                       $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs113":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs029":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmfss095":
                        $tgl_parameter = 'tgl_data';
                    break;
                    case $val_form_kode == "frmnon010":
                        $tgl_parameter = 'tgl_laporan';
                    break;
                    case $val_form_kode == "intqad054":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmfss495":
                        $tgl_parameter = 'date';
                    break;
                    case $val_form_kode == "frmlqs079":
                        $tgl_parameter = 'completedate';
                    break;
                    case $val_form_kode == "intqad063":
                        $tgl_parameter = 'tgl_laporan';
                    break;
                    case $val_form_kode == "intqad056":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad067":
                        $tgl_parameter = 'tgl_checklist';
                    break;
                    case $val_form_kode == "frmfss153":
                        $tgl_parameter = 'produksi_date';
                    break;
                    case $val_form_kode == "intqad087":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad091":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad066":
                        $tgl_parameter = 'tgl_sampling';
                    break;
                    case $val_form_kode == "intqad081":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad127":
                        $tgl_parameter = 'tgl_produksi';
                    break;
                    case $val_form_kode == "frmnon033":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad116":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs122":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs142":
                        $tgl_parameter = 'tanggal_hdr';
                    break;
                    case $val_form_kode == "frmnon065":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad084":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad089":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad068":
                        $tgl_parameter = 'tgl_data';
                    break;
                    case $val_form_kode == "intqad097":
                        $tgl_parameter = 'tgl_sampling';
                    break;
                    case $val_form_kode == "intqad114":
                        $tgl_parameter = 'bln_tahun';
                    break;
                    case $val_form_kode == "intqad119":
                        $tgl_parameter = 'tgl_sampling';
                    break;
                    case $val_form_kode == "intqad120":
                        $tgl_parameter = 'tgl_dok';
                    break;
                    case $val_form_kode == "intqad053":
                        $tgl_parameter = 'production_date';
                    break;
                    case $val_form_kode == "intqad092":
                        $tgl_parameter = 'tgl_laporan';
                    break;
                    case $val_form_kode == "intqad065":
                        $tgl_parameter = 'date';
                    break;
                    case $val_form_kode == "intqad073":
                        $tgl_parameter ='tgl_laporan';
                    break;
                    case $val_form_kode == "intqad079":
                        $tgl_parameter ='tgl_laporan';
                    break;
                    case $val_form_kode == "frmnon051":
                        $tgl_parameter ='tgl_laporan';
                    break;
                    case $val_form_kode == "intqad076":
                        $tgl_parameter ='tgl_laporan';
                    break;
                    case $val_form_kode == "intqad129":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad072":
                        $tgl_parameter = 'tanggal_laporan';
                    break;
                    case $val_form_kode == "intqad057":
                        $tgl_parameter = 'tanggal_laporan';
                    break;
                    case $val_form_kode == "frmfss086":
                        $tgl_parameter = 'tgl_laporan';
                    break;
                    case $val_form_kode == "frmfss087":
                        $tgl_parameter = 'dtdate';
                    break;
                    case $val_form_kode == "frmfss090":
                        $tgl_parameter = 'dtdate';
                    break;
                    case $val_form_kode == "frmfss096":
                        $tgl_parameter = 'dtdate';
                    break;
                    case $val_form_kode == "frmfss121":
                        $tgl_parameter = 'tgl_produksi';
                    break;
                    case $val_form_kode == "frmfss530":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmfss593":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmfss126":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmhcp003":
                        $tgl_parameter = 'tgl_doc';
                    break;
                    case $val_form_kode == "intrnd057":
                        $tgl_parameter = 'dtdate';
                    break;
                    case $val_form_kode == "frmfss109":
                       $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmlqs211":
                       $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmfss108":
                       $tgl_parameter = 'dtdate';
                    break;
                    case $val_form_kode == "frmnon055":
                       $tgl_parameter = 'tgl_terima';
                    break;
                    case $val_form_kode == "frmnon066":
                         $tgl_parameter = 'tanggal';    
                    break;
                    case $val_form_kode == "frmlqs137":
                         $tgl_parameter = 'date_report';    
                    break;
                    case $val_form_kode == "frmlqs136":
                         $tgl_parameter = 'date_report';    
                    break;
                    case $val_form_kode == "frmhcc004":
                       $tgl_parameter = 'completedate';
                    break;
                    case $val_form_kode == "frmhcc003":
                       $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmnon080":
                       $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad062":
                        $tgl_parameter = 'tgl_inkubasi';
                    break;
                    case $val_form_kode == "intqad167":
                        $tgl_parameter = 'tanggal_laporan';
                    break;
                    case $val_form_kode == "frmnon086":
                        $tgl_parameter = 'tanggal_laporan';
                    break;
                    case $val_form_kode == "frmlqs180":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad121":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "intqad157":
                        $tgl_parameter = 'tanggal';
                    break;
                    case $val_form_kode == "frmnon089":
                        $tgl_parameter = 'tanggal';
                    break;
                    default:
                         $tgl_parameter = 'create_date';
                    break;
                }

                $data_head = $this->M_history_activity->get_header_form($tabel, $tgl_parameter, $val_headerid);

                foreach($data_head as $data_head_row){
                    $value_parameter = $data_head_row->value_parameter;
                }

                $dt_form_versi = $this->M_history_activity->get_frmversi($val_form_kode, $tgl_parameter, $value_parameter);

                foreach($dt_form_versi as $dtformversi) {
                    $frm_vrs = $dtformversi->formversi;
                }

                echo $show = $val_form_kode.'//'.$val_headerid.'//'.$frm_vrs.'//';


        
      }else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }

}
?>