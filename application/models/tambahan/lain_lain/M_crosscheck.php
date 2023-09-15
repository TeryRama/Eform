<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_crosscheck extends CI_Model {

	var $tabel = 'tblmst_photoforcrosscheck';
		function __construct(){
                parent::__construct();
                $CI = &get_instance();
                $this->db1 = $this->load->database('db1',TRUE);
        }
	// Fungsi untuk menampilkan semua data gambar
	public function view(){
		return $this->db1->get('tblmst_photoforcrosscheck')->result();
	}
	
	// Fungsi untuk melakukan proses upload file
	public function upload(){
		$config['upload_path'] = './assets/foto_frmfss482/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']	= '2048';
		$config['remove_space'] = TRUE;
	
		$this->load->library('upload', $config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('input_gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
	
	// Fungsi untuk menyimpan data ke database
	public function save($upload){
		$data = array(
			'caption'   =>$this->input->post('caption'),
			'photos'   => $upload['file']['file_name'],
			'ukuran_file' => $upload['file']['file_size'],
			'tipe_file'   => $upload['file']['file_type']
		);
		
		$this->db1->insert('tblmst_photoforcrosscheck', $data);
	}

	function get_records() {
		$this->db1->select('*');
		$this->db1->from('tblmst_photoforcrosscheck');
		$query= $this->db1->get();

		return $query;
	}

	function get_photo_byid($id_photo) {
	    $this->db1->from($this->tabel);
	    $this->db1->where('id_photo', $id_photo);

	    $query = $this->db1->get();

	    if ($query->num_rows() > 0) {
	        return $query->result();
	    }
	}

	function update_interpolasi($id_photo, $data) {
	    $this->db1->where('id_photo', $id_photo);
	    $this->db1->update($this->tabel, $data);

	    return TRUE;
	}

	function insert($data) {
		$query= $this->db1->insert('tblmst_photoforcrosscheck', $data);
		return TRUE;
	}

	function delete_by_id($id_photo,$data){
		$this->db1->where('id_photo', $id_photo);
		$query= $this->db1->delete($this->tabel, $data);
		return $query;
	}

	function update_by_id($data, $id_photo){
		$this->db1->where("id_photo ='$id_photo'");
		$query=$this->db1->update('tblmst_photoforcrosscheck',$data);

		return $query;
	}
}
