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

            $list_history      = $this->M_history_activity->get_list_history();
            $data_list_history = array('list_history' => $list_history);

            $data['date_from']             = '';
            $data['date_to']             = '';

            $this->load->view('tambahan/lain_lain/V_history_activity', array_merge($data, $data2, $data_list_history));

        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }


    function save_history() {
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

            $history_formkd          = $this->input->post('completeform');
            $history_formvrs         = $this->input->post('completeformvrs');
            $val_history_headerid    = $this->input->post('headerid');
            if($val_history_headerid=='undefined'){
                $history_headerid    = NULL;
            }else{
                $history_headerid    = $val_history_headerid;
            }
            $history_param           = $this->input->post('param');
            $history_data_old        = $this->input->post('data_old');
            $history_data_new        = $this->input->post('data_new');
            $val_history_detail_id   = $this->input->post('detail_id');
            if(trim($val_history_detail_id)!=''){
                $history_detail_id    = $val_history_detail_id;
            }else{
                $history_detail_id    = NULL;
            }
            $history_date            = date('Y-m-d');  
            $history_time            = date('H:i:s');
            $history_comp            = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $history_by              = $session_data['nmdepan'];
            $history_leveluser       = $session_data['levelusernm'];
            $history_bagnm           = $session_data['bagnm'];

            $detail_history_activity = array(
                'history_date'      => $history_date,
                'history_time'      => $history_time,
                'history_comp'      => $history_comp,
                'history_by'        => $history_by,
                'history_formkd'    => $history_formkd,
                'history_formvrs'   => $history_formvrs,
                'history_headerid'  => $history_headerid,
                'history_param'     => $history_param,
                'history_data_old'  => $history_data_old,
                'history_data_new'  => $history_data_new,
                'history_leveluser' => $history_leveluser,
                'history_bagnm'     => $history_bagnm,
                'history_detail_id' => $history_detail_id
            );

            if($history_headerid!=NULL){
                if($history_detail_id!=NULL){
                    $cek_history = $this->M_history_activity->cek_history($history_date,$history_comp,$history_by,$history_formkd,$history_formvrs,$history_headerid,$history_param,$history_data_old,$history_data_new,$history_leveluser,$history_bagnm,$history_detail_id);
                    if(empty($cek_history)){
                         $this->M_history_activity->insert_history_activity($detail_history_activity);
                    }else{
                        foreach($cek_history as $cek_history_row){
                            $history_id = $cek_history_row->history_id;
                            $this->M_history_activity->update_history_activity($detail_history_activity,$history_id);
                        }  
                    }
                }else{}
            }else{}

            echo $save_history = 'save history ok';
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

            $list_history               = $this->M_history_activity->get_history_activity_bydate($date_from, $date_to);
            $data_list_history          = array('list_history' => $list_history);

            $data['date_from']          = $date_from;
            $data['date_to']            = $date_to;

            $this->load->view('tambahan/lain_lain/V_history_activity', array_merge($data, $data2, $data_list_history));

        } else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
        }
    }

}
?>