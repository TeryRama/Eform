<?php
class C_crosscheck extends  CI_Controller {

	var $data = array();

	function  __construct(){
		parent:: __construct();

		$this->load->helper('form','url');
		$this->load->model(array('M_menu','tambahan/lain_lain/M_crosscheck'));
	}


	function index(){
		if ($this->session->userdata('logged_in')) {
            $session_data            = $this->session->userdata('logged_in');
            $data['username']        = $session_data['username'];
            $data['password']        = $session_data['password'];
            $data['jabid']           = $session_data['jabid'];
            $data['leveluserid']     = $session_data['leveluserid'];
            $data['nmdepan'] = $session_data['nmdepan'];
            $data['levelusernm'] = $session_data['levelusernm'];
            $data['bagnm'] = $session_data['bagnm'];
            $data['jabnm'] = $session_data['jabnm'];


            $LevelUser = $session_data['leveluserid'];
            $UserName = $session_data['username'];
            $LevelUserNm = $session_data['levelusernm'];

            $cekLevelUserNm = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
            $Bagian     = $session_data['bagnm'];

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $this->data['query'] = $this->M_crosscheck->get_records();
            $this->load->view('tambahan/lain_lain/gambar/view', array_merge($data,$data2, $this->data));
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function form() {
        $session_data        = $this->session->userdata('logged_in');
        $data['username']    = $session_data['username'];
        $data['password']    = $session_data['password'];
        $data['jabid']       = $session_data['jabid'];
        $data['leveluserid'] = $session_data['leveluserid'];
        $data['nmdepan']     = $session_data['nmdepan'];
        $data['levelusernm'] = $session_data['levelusernm'];
        $data['bagnm']       = $session_data['bagnm'];
        $data['jabnm']       = $session_data['jabnm'];


        $LevelUser   = $session_data['leveluserid'];
        $UserName    = $session_data['username'];
        $LevelUserNm = $session_data['levelusernm'];

        $cekLevelUserNm         = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        $Bagian                 = $session_data['bagnm'];

        $menus = $this->M_menu->menus($LevelUser);
        $data2 = array('menus' => $menus);
            
        //ambil variabel URL
		$mau_ke = $this->uri->segment(5);
		$idu    = $this->uri->segment(6);

        //ambil variabel dari form
		$id_photo    = addslashes($this->input->post('id_photo'));
		$photos      = addslashes($this->input->post('photos'));
		$caption     = addslashes($this->input->post('caption'));
		$form_kode   = addslashes($this->input->post('form_kode'));
		$ukuran_file = addslashes($this->input->post('ukuran_file'));
		$tipe_file   = addslashes($this->input->post('tipe_file'));


        
	   //mengarahkan fungsi form sesuai dengan uri segmentnya
        if ($mau_ke == "add") {			//jika uri segmentnya add
            $data4['aksi'] = 'aksi_add';

            $this->load->view('tambahan/lain_lain/gambar/form', array_merge($data,$data2,$data4));
        
        } else if ($mau_ke == "edit") {			//jika uri segmentnya edit
            $data5['dtphoto']  = $this->M_crosscheck->get_photo_byid($idu);
            $data6['aksi'] = 'aksi_edit';
            $this->load->view('tambahan/lain_lain/gambar/form',  array_merge($data,$data2,$data5,$data6));
            
        } else if ($mau_ke == "aksi_add") {//jika uri segmentnya aksi_add sebagai fungsi untuk insert
            $data = array(
				'photos'      => $photos,
				'caption'     => $caption,
				'form_kode'   => $form_kode,
				'ukuran_file' => $ukuran_file,
				'tipe_file'   => $tipe_file
            );
			if($is_update==0) {
                if($this->M_crosscheck->insert($data))
                    redirect('tambahan/lain_lain/C_crosscheck');
            } 
            
            $this->M_crosscheck->insert($data); //model insert data barang       

            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>"); //pesan yang tampil setalah berhasil di insert
            redirect('tambahan/lain_lain/C_crosscheck');
        } else if ($mau_ke == "aksi_edit") { //jika uri segmentnya aksi_edit sebagai fungsi untuk update
	        $data = array(
				'photos'      => $photos,
				'caption'     => $caption,
				'form_kode'   => $form_kode,
				'ukuran_file' => $ukuran_file,
				'tipe_file'   => $tipe_file

            );
            $this->M_crosscheck->update_interpolasi($id_photo,$data); //modal update data kode formula
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>"); //pesan yang tampil setelah berhasil di update
            

            redirect('tambahan/lain_lain/C_crosscheck',  array_merge($data, $data2));
        }else if ($mau_ke == "delete") {
            $data = array(
                'photos'      => $photos,
				'caption'     => $caption,
				'form_kode'   => $form_kode
            );
            if($this->M_crosscheck->delete_by_id($idu,$data)) {
            redirect('tambahan/lain_lain/C_crosscheck');
            }
        }

    }

}
?>
