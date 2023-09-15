<?php

class Sidebar extends CI_Controller {
function __construct() {
        parent:: __construct();

        $this->load->helper('form', 'url');
        $this->load->model('M_user','M_menu');
        $this->load->library(array('Template'));
    }
    public function index() {
        $data['username'] = 'Test';
        $this->template->display('template/sidebar', $data);
    }

}

/* End of file  datauser.php */
/* Location: ./application/controllers/ datauser.php */