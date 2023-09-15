<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class C_expired_password extends CI_Controller {
        function __construct() {
            parent::__construct();
            $this->load->model('M_user','',TRUE); //nantinya diteruskan di user.php pada folder models
            $this->load->helper('date');
        }
    function index() {
        if($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                $data['userid'] = $session_data['userid'];
                $data['username'] = $session_data['username'];
                $data['password'] = $session_data['password'];
                $data['jabid'] = $session_data['jabid'];
                $data['leveluserid'] = $session_data['leveluserid'];
                $data['nmdepan'] = $session_data['nmdepan'];
                $data['levelusernm'] = $session_data['levelusernm'];
                $data['bagnm'] = $session_data['bagnm'];
                $data['jabnm'] = $session_data['jabnm'];
                $data['Titel'] = 'Home';
                $data['status_password'] = $session_data['status_password'];

                $username = trim(strtoupper($this->input->post('username')));
                $password = trim(strtoupper($this->input->post('password'))); 
                $new_password = trim(strtoupper($this->input->post('new_password'))); 
                $post_userid = trim(strtoupper($this->input->post('post_userid')));


                $update  = $this->M_user->update_expired_password($new_password,$post_userid); 

                if($update==TRUE){
                    $this->session->set_flashdata("pesan_new_password", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Password berhasil diperbaharui, silahkan login ulang!!</div>"); 
                    redirect('C_login');   
                }else{
                    $this->session->set_flashdata("pesan_gagal", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Password Batal diupdate, silahkan ulangi lagi!!</div>");
                    $this->load->view('V_expired_password', array_merge($data));
                }
        }else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
            }
    }
    
    }
    