<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_login extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('C_home', 'refresh');
		} else {
			if (ENVIRONMENT == 'development') {
				$this->load->view('V_login');
			} else {
				redirect('C_onelogin_logout/invalidaccess', 'refresh');
			}
		}
	}

	public function login()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('C_home', 'refresh');
		} else {
			$this->load->view('V_login');
		}
	}

	public function logout()
	{
		redirect('C_login');
	}
}
