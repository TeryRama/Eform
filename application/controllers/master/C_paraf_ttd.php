<?php
class C_paraf_ttd extends  CI_Controller {
        function get_canvas_ttd(){
            if($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['password'] = $session_data['password'];
                $data['jabid'] = $session_data['jabid'];
                $data['leveluserid'] = $session_data['leveluserid'];
                $data['nmdepan'] = $session_data['nmdepan'];
                $data['levelusernm'] = $session_data['levelusernm'];
                $data['bagnm'] = $session_data['bagnm'];
                $data['jabnm'] = $session_data['jabnm'];
                $data['Titel'] = 'Home';

                $LevelUser = $session_data['leveluserid'];
                $UserName = $session_data['username'];
                $LevelUserNm = $session_data['levelusernm'];

                $cekLevelUserNm = substr($LevelUserNm,0,7);
                $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);

                $menus = $this->M_menu->menus($LevelUser);
                $data2 = array('menus' => $menus);

                $dt_sign = $this->M_tandatangan->get_recordsttd();
                $data3   = array('dt_sign' => $dt_sign);

                $this->load->view('V_paraf_ttd', array_merge($data, $data2, $data3));
                // $this->load->view('V_ttd_canvas', array_merge($data, $data2));

            }
            else {
                //Jika tidak ada session di kembalikan ke halaman login
                redirect('C_login', 'refresh');
            }
        }
    function __construct(){
        parent:: __construct();
        $this->load->helper('form','url');
        $this->load->model(array('M_user','M_menu','master/M_tandatangan'));
        $this->load->library('session');

        $session_data     = $this->session->userdata('logged_in');
        $cek_status_login = $this->M_user->cek_status_login($session_data['username'],$_SERVER['REMOTE_ADDR'],date('Y-m-d'));
        foreach ($cek_status_login as $dt) {
            $status_log=$dt->status;
        }

        if(count($cek_status_login)>0 && $status_log == 'offline'){
            echo "<script>alert('Akun Sudah Dialihkan Ke Device Lain !!'); </script>";
            session_destroy();
            redirect('C_login', 'refresh');
        }
    }

    function index() {
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['Titel']          = 'Tanda tangan';

            $LevelUser      = $session_data['leveluserid'];
            $UserName       = $session_data['username'];
            $LevelUserNm    = $session_data['levelusernm'];

            $cekLevelUserNm = substr($LevelUserNm,0,7);
            $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            $dt_ttd = $this->M_tandatangan->get_recordsttd();
            $data3  = array('dt_ttd' => $dt_ttd);

            $this->load->view('V_paraf_ttd', array_merge($data, $data2, $data3));

        }
        else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
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
        $data['Titel']          = 'Master - TTD';


        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];

        $cekLevelUserNm         = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        $Bagian                 = $session_data['bagnm'];

        $menus                  = $this->M_menu->menus($LevelUser);
        $data2                  = array('menus' => $menus);

        //ambil variabel URL
        $mau_ke   = $this->uri->segment(4);
        $idu      = $this->uri->segment(5);

        //ambil variabel dari form
        $signid                 = addslashes($this->input->post('signid'));
        $nama                   = addslashes($this->input->post('namattd'));
        $jabatan                = addslashes($this->input->post('jabatanttd'));
        $update_by              = $session_data['nmdepan'];
        $update_date            = date('Y-m-d');
        $update_time            = date('H:i:s');
        $update_comp            = $_SERVER['REMOTE_ADDR'];
        $upload_dir             = "assets/ttd/TD_NON_USER/";
        $file                   = $upload_dir . $nama . ".png";

	   //mengarahkan fungsi form sesuai dengan uri segmentnya
        if ($mau_ke == "add") {			//jika uri segmentnya add
            $data4['aksi'] = 'aksi_add';

            $this->load->view('master/formsign/V_menu_sign', array_merge($data,$data2,$data4));

        } else if ($mau_ke == "edit") {			//jika uri segmentnya edit
            $data5['dtsign']  = $this->M_tandatangan->get_sign_byid($idu);
            $data6['aksi'] = 'aksi_edit';

            $this->load->view('master/formsign/V_menu_sign',  array_merge($data,$data2,$data5,$data6));

        } else if ($mau_ke == "aksi_add") {//jika uri segmentnya aksi_add sebagai fungsi untuk insert
            $data = array(
            	'nama'        => $nama,
                'jabatan'     => $jabatan,
                'update_by'   => $update_by,
                'update_date' => $update_date,
                'update_time' => $update_time,
                'update_comp' => $update_comp
            );

            $this->M_tandatangan->insert_sign($data); //model insert data
            $img     = $this->input->post('hidden_data');
            $imges   = str_replace('data:image/png;base64,', '', $img);
            $imge    = str_replace(' ', '+', $imges);
            $image   = base64_decode($imge);
            $success = file_put_contents($file, $image);

            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di insert</div>"); //pesan yang tampil setalah berhasil di insert
            redirect('master/C_paraf_ttd');
        } else if ($mau_ke == "aksi_edit") { //jika uri segmentnya aksi_edit sebagai fungsi untuk update
	        $data = array(
                'nama'        => $nama,
                'jabatan'     => $jabatan,
                'update_by'   => $update_by,
                'update_date' => $update_date,
                'update_time' => $update_time,
                'update_comp' => $update_comp

            );
            $this->M_tandatangan->update_sign($signid,$data); //modal update data
            $img     = $this->input->post('hidden_data');
            $imges   = str_replace('data:image/png;base64,', '', $img);
            $imge    = str_replace(' ', '+', $imges);
            $image   = base64_decode($imge);
            $success = file_put_contents($file, $image);
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>"); //pesan yang tampil setelah berhasil di update


            redirect('master/C_paraf_ttd',  array_merge($data, $data2));
        }else if ($mau_ke == "delete") {
            $getdata = $this->M_tandatangan->get_sign_byid($idu);
            foreach ($getdata as $row) {
                $nama = $row->nama;
            }
            $this->M_tandatangan->delete_user_sign($idu);
            $upload_dir = "assets/ttd/TD_NON_USER/";
            $file       = $upload_dir . $nama . ".png";
            if (file_exists($file)) {
                unlink($file);
            }
            redirect('master/C_paraf_ttd');
        }

    }
}
?>
