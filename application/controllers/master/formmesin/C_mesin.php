<?php
class C_mesin extends  CI_Controller
{

    var $data = array();

    function  __construct()
    {
        parent::__construct();

        $this->load->helper('form', 'url');
        $this->load->model(array('M_user', 'M_menu', 'master/formmesin/M_mesin'));
        $this->load->library('session');

        //////////////////////////////////
        /// prevent direct url accses
        $session_data = $this->session->userdata('logged_in');
        $leveluid     = $session_data['leveluserid'];
        $url_str      = uri_string();

        $akses_check = $this->M_user->check_akses_bylevelid($leveluid, 'C_form_item');
        if ($akses_check == false) {
            echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini..!!');
                          window.location.assign('";
            echo base_url();
            echo "C_login');
                       </script>";
        }
        /// end prevent direct url accses
        //////////////////////////////////
    }

    function index()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data           = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['Titel']          = 'Master - Mesin';

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);
            $Bagian                 = $session_data['bagnm'];

            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);

            $data['sectionmesin']  = $this->M_mesin->getsectionmesin_records();
            $data['tipemesin']     = $this->M_mesin->gettipemesin_records();
            $data['komponenmesin'] = $this->M_mesin->getkomponenmesin_records();
            $this->data['query']   = $this->M_mesin->getmesin_records();
            $this->load->view('master/formmesin/V_listmesin', array_merge($data, $data2, $this->data));
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }


    function formKomponenMesin()
    {
        $session_data           = $this->session->userdata('logged_in');
        $data['username']       = $session_data['username'];
        $data['password']       = $session_data['password'];
        $data['jabid']          = $session_data['jabid'];
        $data['leveluserid']    = $session_data['leveluserid'];
        $data['nmdepan']        = $session_data['nmdepan'];
        $data['levelusernm']    = $session_data['levelusernm'];
        $data['bagnm']          = $session_data['bagnm'];
        $data['jabnm']          = $session_data['jabnm'];
        $data['Titel']          = 'Master - Mesin';

        $LevelUser              = $session_data['leveluserid'];
        $LevelUserNm            = $session_data['levelusernm'];

        $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

        $menus                  = $this->M_menu->menus($LevelUser);
        $data2                  = array('menus' => $menus);

        //ambil variabel dari URL
        $mau_ke                 = $this->uri->segment(5);
        $idu                    = $this->uri->segment(6);

        //ambil variabel dari form
        $komponen_id            = $this->input->post('komponen_id');
        $nama_komponen          = $this->input->post('nama_komponen');
        $update_by              = $session_data['nmlengkap'];
        $update_date            = date('Y-m-d');
        $update_time            = date('H:i:s');
        $update_comp            = $_SERVER['REMOTE_ADDR'];

        //mengarahkan fungsi form sesuai dengan uri segmentnya
        if ($mau_ke == "add") {
            $data4['aksi'] = 'aksi_add';
            $data['title'] = 'Tambah Data Komponen Mesin';
            $this->load->view('master/formmesin/V_add_komponen', array_merge($data, $data2, $data4));
        } else if ($mau_ke == "edit") {
            $data['title'] = 'Edit Data Komponen Mesin';
            $data5['dtkomponenmesin']  = $this->M_mesin->get_komponenmesin_byid($idu);
            $data6['aksi'] = 'aksi_edit';
            $this->load->view('master/formmesin/V_add_komponen',  array_merge($data, $data2, $data5, $data6));
        } else if ($mau_ke == "aksi_add") {
            $val = array(
                'nama_komponen' => $nama_komponen,
                'update_by'     => $update_by,
                'update_date'   => $update_date,
                'update_time'   => $update_time,
                'update_comp'   => $update_comp,
            );

            $this->M_mesin->insert_komponen($val);

            echo "<script>alert('Data Komponen Mesin berhasil disimpan....!!!! ');</script>";
            redirect('/master/formmesin/C_mesin', 'refresh');
        } else if ($mau_ke == "aksi_edit") {
            $val = array(
                'nama_komponen' => $nama_komponen,
                'update_by'       => $update_by,
                'update_date'     => $update_date,
                'update_time'     => $update_time,
                'update_comp'     => $update_comp,
            );
            $this->M_mesin->update_komponenmesin($komponen_id, $val);
            echo "<script>alert('Data Komponen Mesin berhasil di update....!!!! ');</script>";
            redirect('/master/formmesin/C_mesin', 'refresh');
        } else {
            echo "aksi tidak ditemukan";
            exit();
        }
    }


    function formInventarisMesin()
    {
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
        $LevelUserNm            = $session_data['levelusernm'];

        $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

        $menus                  = $this->M_menu->menus($LevelUser);
        $data2                  = array('menus' => $menus);

        //ambil variabel URL
        $mau_ke                 = $this->uri->segment(5);
        $idu                    = $this->uri->segment(6);

        //ambil variabel dari form
        $mesin_id               = $this->input->post('mesin_id');
        $nama_mesin             = $this->input->post('nama_mesin');
        $kode_mesin             = $this->input->post('kode_mesin');
        $lokasi_mesin           = $this->input->post('lokasi_mesin');
        $post_inactive          = $this->input->post('inactive');

        if (trim($post_inactive) == '') {
            $inactive = NULL;
        } else {
            $inactive = $post_inactive;
        }
        $update_by              = $session_data['nmdepan'];
        $update_date            = date('Y-m-d');
        $update_time            = date('H:i:s');
        $update_comp            = $_SERVER['REMOTE_ADDR'];
        $bagian                 = $this->input->post('bagian');
        $ket_mesin              = $this->input->post('ket_mesin');

        //mengarahkan fungsi form sesuai dengan uri segmentnya
        if ($mau_ke == "add") {            //jika uri segmentnya add
            $data4['aksi'] = 'aksi_add';
            $data['title']         = 'Tambah Data Inventaris Mesin';
            $this->load->view('master/formmesin/V_add_mesin', array_merge($data, $data2, $data4));
        } else if ($mau_ke == "edit") {
            $data['title']         = 'Tambah Data Inventaris Mesin';        //jika uri segmentnya edit
            $data5['dtmesin']  = $this->M_mesin->get_mesin_byid($idu);
            $data6['aksi'] = 'aksi_edit';

            $this->load->view('master/formmesin/V_add_mesin',  array_merge($data, $data2, $data5, $data6));
        } else if ($mau_ke == "aksi_add") { //jika uri segmentnya aksi_add sebagai fungsi untuk insert
            $data = array(
                'nama_mesin'  => $nama_mesin,
                'kode_mesin'  => $kode_mesin,
                'lokasi_mesin' => $lokasi_mesin,
                'inactive'    => $inactive,
                'update_by'   => $update_by,
                'update_date' => $update_date,
                'update_time' => $update_time,
                'update_comp' => $update_comp,
                'bagian'      => $bagian,
                'ket_mesin'   => $ket_mesin
            );

            $this->M_mesin->insert($data); //model insert data barang       

            echo "<script>alert('Data Inventaris Mesin berhasil disimpan....!!!! ');</script>"; //pesan yang tampil setalah berhasil di insert
            redirect('/master/formmesin/C_mesin');
        } else if ($mau_ke == "aksi_edit") { //jika uri segmentnya aksi_edit sebagai fungsi untuk update
            $data = array(
                'nama_mesin'  => $nama_mesin,
                'kode_mesin'  => $kode_mesin,
                'lokasi_mesin' => $lokasi_mesin,
                'inactive'    => $inactive,
                'update_by'   => $update_by,
                'update_date' => $update_date,
                'update_time' => $update_time,
                'update_comp' => $update_comp,
                'bagian'      => $bagian,
                'ket_mesin'   => $ket_mesin

            );
            $this->M_mesin->update_mesin($mesin_id, $data); //modal update data kode mesin
            echo "<script>alert('Data Inventaris Mesin berhasil di update....!!!! ');</script>"; //pesan yang tampil setalah berhasil di update
            redirect('/master/formmesin/C_mesin',  array_merge($data, $data2));
        } else if ($mau_ke == "delete") {
            $data = array(
                'inactive'  => '1'
            );

            $this->M_mesin->update_mesin($idu, $data); {
                redirect('master/formmesin/C_mesin');
            }
        }
    }
    function formSectionMesin()
    {
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
        $LevelUserNm            = $session_data['levelusernm'];

        $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

        $menus                  = $this->M_menu->menus($LevelUser);
        $data2                  = array('menus' => $menus);

        //ambil variabel URL
        $mau_ke                 = $this->uri->segment(5);
        $idu                    = $this->uri->segment(6);

        //ambil variabel dari form
        $section_id             = $this->input->post('section_id');
        $nama_section           = $this->input->post('nama_section');
        $no_urut                = $this->input->post('no_urut');

        $update_by              = $session_data['nmdepan'];
        $update_date            = date('Y-m-d');
        $update_time            = date('H:i:s');
        $update_comp            = $_SERVER['REMOTE_ADDR'];

        //mengarahkan fungsi form sesuai dengan uri segmentnya
        if ($mau_ke == "add") {            //jika uri segmentnya add
            $data4['aksi'] = 'aksi_add';
            $data['title']         = 'Tambah Data Section Mesin';
            $this->load->view('master/formmesin/V_add_section', array_merge($data, $data2, $data4));
        } else if ($mau_ke == "edit") {
            $data['title']         = 'Tambah Data Section Mesin';        //jika uri segmentnya edit
            $data5['dtsection']  = $this->M_mesin->get_mesin_byid($idu);
            $data6['aksi'] = 'aksi_edit';

            $this->load->view('master/formmesin/V_add_section',  array_merge($data, $data2, $data5, $data6));
        } else if ($mau_ke == "aksi_add") { //jika uri segmentnya aksi_add sebagai fungsi untuk insert
            $data = array(
                'nama_section' => $nama_section,
                'no_urut'      => $no_urut,
                'update_by'    => $update_by,
                'update_date'  => $update_date,
                'update_time'  => $update_time,
                'update_comp'  => $update_comp
            );

            $this->M_mesin->insert($data); //model insert data barang       

            echo "<script>alert('Data Section Mesin berhasil disimpan....!!!! ');</script>"; //pesan yang tampil setalah berhasil di insert
            redirect('/master/formmesin/C_mesin');
        } else if ($mau_ke == "aksi_edit") { //jika uri segmentnya aksi_edit sebagai fungsi untuk update
            $data = array(
                'nama_section' => $nama_section,
                'no_urut'      => $no_urut,
                'update_by'    => $update_by,
                'update_date'  => $update_date,
                'update_time'  => $update_time,
                'update_comp'  => $update_comp

            );
            $this->M_mesin->update_mesin($section_id, $data); //modal update data kode mesin
            echo "<script>alert('Data Section Mesin berhasil di update....!!!! ');</script>"; //pesan yang tampil setalah berhasil di update
            redirect('/master/formmesin/C_mesin',  array_merge($data, $data2));
        } else {
            echo "<script>alert('Data aksi tidak ditemukan....!!!! ');</script>";
            exit();
        }
    }
}
