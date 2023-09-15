<?php

class C_ncr extends CI_Controller {

	var $data = array();

	function __construct() {

		parent :: __construct();

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');

		$this->load->model(array('M_menu','tambahan/lain_lain/M_ncr'));
	}

	function get_spec_byformula(){
        $spec_date            = trim($this->input->post('spec_date'));  
        $spec_form_kode       = trim($this->input->post('spec_form_kode'));  
        $spec_form_versi      = trim($this->input->post('spec_form_versi'));  
        $spec_bagian          = trim($this->input->post('spec_bagian'));  
        $spec_tipe_contoh     = trim($this->input->post('spec_tipe_contoh'));  
        $spec_jenis_produk    = trim($this->input->post('spec_jenis_produk'));  
        $formula              = trim($this->input->post('formula'));
        
        $dtspec = $this->M_ncr->get_spec_byformula($spec_date,$spec_form_kode,$spec_form_versi,$spec_bagian, $spec_tipe_contoh, $spec_jenis_produk, $formula);

        $data4 ="";
                $no=0;
                $data4 .= '<ul class="nav nav-pills nav-stacked">';               
                foreach($dtspec as $row){$no++;
                    if(trim($row->spec_min)!='' || $row->spec_min!=null){$spec_min = $row->spec_min;}else{$spec_min ='-';}
                    if(trim($row->spec_max)!='' || $row->spec_max!=null){$spec_max = $row->spec_max;}else{$spec_max ='-';}
                    $data4 .= '<li class="bg-info"><a href="#"><span class="fa-stack fa-1x"><strong class="fa-stack-1x text-primary">'.$no.'</strong></span> Junk <span class="label label-primary pull-right">'.$spec_min.'</span><span class="label label-warning pull-right">'.$spec_max.'</span></a>
                                    </li>';
                }
                $data4 .= '</ul>';

        $data = $data4;
        echo $data;
    }

    function cek_spec_byformula(){
        
    }
}
?>