<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_forminttbn022_06 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $CI        = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);

        $frmkode = $this->uri->segment(4);
        $frmvrs  = $this->uri->segment(5);

        $this->load->model(array('M_user', 'M_menu', 'tambahan/M_tambahan', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->library(array('table', 'form_validation', 'excel', 'image_lib'));
        $this->load->helper(array('form', 'url', 'html', 'file', 'path'));

        $this->model = $this->{'M_form' . $frmkode . '_' . $frmvrs};

        /// prevent direct url accses
        $session_data = $this->session->userdata('logged_in');
        $leveluid     = $session_data['leveluserid'];
        $url_str      = uri_string();

        $akses_check = $this->M_user->check_akses_bylevelid($leveluid, $frmkode);
        if ($akses_check == false) {
            echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini..!!');
            window.location.assign('";
            echo base_url();
            echo "C_login');
            </script>";
            exit;
        }
        /// end prevent direct url accses
    }

    function get_docno()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

            $create_date  = $this->input->post('create_date');
            $dthasil = $this->model->get_docno(date("m", strtotime($create_date)), date("Y", strtotime($create_date)));

            $last_docno = !empty($dthasil->vdocno) ? $dthasil->vdocno + 1 : 1;

            $date_day  = date("d", strtotime($create_date));
            $arr_bulan = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            $docno = 'WAR/PWP-TBN/' . date("Y", strtotime($create_date)) . '/' .  str_pad($date_day, 3, '0', STR_PAD_LEFT);

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil!",
                'data'    => $docno
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function check_data()
    {
        if ($this->session->userdata('logged_in')) {
            $create_date = $this->input->post('create_date');
            $docno  = $this->input->post('docno');

            $dthasil = $this->model->check_data($create_date, $docno);

            if ($dthasil['cek_data']->jml_data == 0) {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => 'Silahkan input data awal!',
                    'data'    => $dthasil['cek_data'],
                );
            } else if ($dthasil['cek_data_2']->jml_data == 0) {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => 'Silahkan input data!',
                    'data'    => $dthasil['cek_data_2'],
                );
            } else {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'error',
                    'pesan'   => "Data periode ini sudah tersedia! \n Silahkan input mulai tanggal \n" . $this->model->date("Y-m-d", strtotime($dthasil['cek_data_3']->data_terakhir . ' + 1 days')),
                );
            }

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function form()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data     = $this->session->userdata('logged_in');
            $data['userid']         = $session_data['userid'];
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['nmlengkap']      = $session_data['nmlengkap'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['bagian_akses']   = $session_data['bagian_akses'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['personalid']     = $session_data['personalid'];
            $data['personalstatus'] = $session_data['personalstatus'];
            $data['Titel']          = 'MONITORING';

            $LevelUser   = $session_data['leveluserid'];
            $UserName    = $session_data['username'];
            $LevelUserNm = $session_data['levelusernm'];

            $cekLevelUserNm   = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

            $menus = $this->M_menu->menus($LevelUser);
            $data2 = array('menus' => $menus);

            //ambil variabel URL
            $frmkode = $this->uri->segment(4);
            $frmvrs  = $this->uri->segment(5);
            $frmaksi = $this->uri->segment(6);

            $dtfrm = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3 = array('dtfrm' => $dtfrm);

            $frmnm = $dtfrm[0]->formnm;

            // hdr
            $headerid        = addslashes($this->input->post('headerid'));
            $complete_userid = $session_data['userid'];
            $complete_date   = date('Y-m-d');
            $complete_time   = date('H:i:s');
            $complete_by     = $session_data['nmlengkap'];
            $complete_comp   = $this->session->userdata('hostname');                                     // versi user original
            $create_date     = date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));  // dari inputan d-m-Y
            $docno           = addslashes($this->input->post('docno'));
            $notification    = addslashes($this->input->post('notification'));
            $shift_1         = addslashes($this->input->post('shift_1'));
            $shift_2         = addslashes($this->input->post('shift_2'));
            $shift_3         = addslashes($this->input->post('shift_3'));
            $total_usedwater = addslashes($this->input->post('total_usedwater'));

            $detail_id          = $this->input->post('detail_id');
            $a1_time            = $this->input->post('a1_time');
            $a1_alkalinity      = $this->input->post('a1_alkalinity');
            $a1_ph              = $this->input->post('a1_ph');
            $a1_conductivity    = $this->input->post('a1_conductivity');
            $a1_thardness       = $this->input->post('a1_thardness');
            $a1_dissolvedoxygen = $this->input->post('a1_dissolvedoxygen');
            $a1_silica          = $this->input->post('a1_silica');
            $a1_fe              = $this->input->post('a1_fe');
            $a2_time            = $this->input->post('a2_time');
            $a2_alkalinityp     = $this->input->post('a2_alkalinityp');
            $a2_alkalinitym     = $this->input->post('a2_alkalinitym');
            $a2_ph              = $this->input->post('a2_ph');
            $a2_conductivity    = $this->input->post('a2_conductivity');
            $a2_ion             = $this->input->post('a2_ion');
            $a2_silica          = $this->input->post('a2_silica');
            $a3_time            = $this->input->post('a3_time');
            $a3_ph              = $this->input->post('a3_ph');
            $a3_conductivity    = $this->input->post('a3_conductivity');
            $a3_silica          = $this->input->post('a3_silica');
            $a3_fe              = $this->input->post('a3_fe');
            $a4_time            = $this->input->post('a4_time');
            $a4_ph              = $this->input->post('a4_ph');
            $a4_conductivity    = $this->input->post('a4_conductivity');
            $a4_silica          = $this->input->post('a4_silica');
            $a4_fe              = $this->input->post('a4_fe');

            $detail_id_b        = $this->input->post('detail_id_b');
            $b1_time            = $this->input->post('b1_time');
            $b1_alkalinity      = $this->input->post('b1_alkalinity');
            $b1_ph              = $this->input->post('b1_ph');
            $b1_conductivity    = $this->input->post('b1_conductivity');
            $b1_thardness       = $this->input->post('b1_thardness');
            $b1_dissolvedoxygen = $this->input->post('b1_dissolvedoxygen');
            $b1_silica          = $this->input->post('b1_silica');
            $b1_fe              = $this->input->post('b1_fe');
            $b2_time            = $this->input->post('b2_time');
            $b2_alkalinityp     = $this->input->post('b2_alkalinityp');
            $b2_alkalinitym     = $this->input->post('b2_alkalinitym');
            $b2_ph              = $this->input->post('b2_ph');
            $b2_conductivity    = $this->input->post('b2_conductivity');
            $b2_ion             = $this->input->post('b2_ion');
            $b2_silica          = $this->input->post('b2_silica');
            $b3_time            = $this->input->post('b3_time');
            $b3_ph              = $this->input->post('b3_ph');
            $b3_conductivity    = $this->input->post('b3_conductivity');
            $b3_silica          = $this->input->post('b3_silica');
            $b3_fe              = $this->input->post('b3_fe');
            $b4_time            = $this->input->post('b4_time');
            $b4_ph              = $this->input->post('b4_ph');
            $b4_conductivity    = $this->input->post('b4_conductivity');
            $b4_silica          = $this->input->post('b4_silica');
            $b4_fe              = $this->input->post('b4_fe');

            $detail_id_c        = $this->input->post('detail_id_c');
            $c1_time            = $this->input->post('c1_time');
            $c1_alkalinity      = $this->input->post('c1_alkalinity');
            $c1_ph              = $this->input->post('c1_ph');
            $c1_conductivity    = $this->input->post('c1_conductivity');
            $c1_thardness       = $this->input->post('c1_thardness');
            $c1_dissolvedoxygen = $this->input->post('c1_dissolvedoxygen');
            $c1_silica          = $this->input->post('c1_silica');
            $c1_fe              = $this->input->post('c1_fe');
            $c2_time            = $this->input->post('c2_time');
            $c2_alkalinityp     = $this->input->post('c2_alkalinityp');
            $c2_alkalinitym     = $this->input->post('c2_alkalinitym');
            $c2_ph              = $this->input->post('c2_ph');
            $c2_conductivity    = $this->input->post('c2_conductivity');
            $c2_ion             = $this->input->post('c2_ion');
            $c2_silica          = $this->input->post('c2_silica');
            $c3_time            = $this->input->post('c3_time');
            $c3_ph              = $this->input->post('c3_ph');
            $c3_conductivity    = $this->input->post('c3_conductivity');
            $c3_silica          = $this->input->post('c3_silica');
            $c3_fe              = $this->input->post('c3_fe');
            $c4_time            = $this->input->post('c4_time');
            $c4_ph              = $this->input->post('c4_ph');
            $c4_conductivity    = $this->input->post('c4_conductivity');
            $c4_silica          = $this->input->post('c4_silica');
            $c4_fe              = $this->input->post('c4_fe');
            $c5_time            = $this->input->post('c5_time');
            $c5_conductivity    = $this->input->post('c5_conductivity');
            $c5_thardness       = $this->input->post('c5_thardness');
            $c5_ph              = $this->input->post('c5_ph');

            $detail_id_d        = $this->input->post('detail_id_d');
            $d1_time            = $this->input->post('d1_time');
            $d1_thardness       = $this->input->post('d1_thardness');
            $d1_ph              = $this->input->post('d1_ph');
            $d1_conductivity    = $this->input->post('d1_conductivity');
            $d1_dissolvedoxygen = $this->input->post('d1_dissolvedoxygen');
            $d1_silica          = $this->input->post('d1_silica');
            $d1_fe              = $this->input->post('d1_fe');
            $d2_time            = $this->input->post('d2_time');
            $d2_thardness       = $this->input->post('d2_thardness');
            $d2_ph              = $this->input->post('d2_ph');
            $d2_conductivity    = $this->input->post('d2_conductivity');
            $d2_dissolvedoxygen = $this->input->post('d2_dissolvedoxygen');
            $d2_silica          = $this->input->post('d2_silica');
            $d2_fe              = $this->input->post('d2_fe');
            $d3_time            = $this->input->post('d3_time');
            $d3_alkalinity      = $this->input->post('d3_alkalinity');
            $d3_conductivity    = $this->input->post('d3_conductivity');
            $d3_thardness       = $this->input->post('d3_thardness');
            $d3_ph              = $this->input->post('d3_ph');
            $d3_suhu_inlet      = $this->input->post('d3_suhu_inlet');
            $d3_suhu_outlet     = $this->input->post('d3_suhu_outlet');
            $d3_turbuditi       = $this->input->post('d3_turbuditi');
            $d3_ci              = $this->input->post('d3_ci');
            $d3_freeci2         = $this->input->post('d3_freeci2');
            $d4_time            = $this->input->post('d4_time');
            $d4_thardness       = $this->input->post('d4_thardness');
            $d4_ph              = $this->input->post('d4_ph');
            $d4_conductivity    = $this->input->post('d4_conductivity');
            $d4_turbuditi       = $this->input->post('d4_turbuditi');
            $d4_ci              = $this->input->post('d4_ci');
            $d4_freeci2         = $this->input->post('d4_freeci2');
            $d5_time            = $this->input->post('d5_time');
            $d5_ph              = $this->input->post('d5_ph');
            $d5_conductivity    = $this->input->post('d5_conductivity');
            $d5_hardness        = $this->input->post('d5_hardness');

            $detail_id_e     = $this->input->post('detail_id_e');
            $e1_time         = $this->input->post('e1_time');
            $e1_startstop    = $this->input->post('e1_startstop');
            $e1_turbuditi    = $this->input->post('e1_turbuditi');
            $e1_pressure     = $this->input->post('e1_pressure');
            $e1_flowmeter    = $this->input->post('e1_flowmeter');
            $e1_ph           = $this->input->post('e1_ph');
            $e1_conductivity = $this->input->post('e1_conductivity');
            $e2_acidion      = $this->input->post('e2_acidion');
            $e3_conductivity = $this->input->post('e3_conductivity');
            $e3_ph           = $this->input->post('e3_ph');
            $e4_acidion      = $this->input->post('e4_acidion');
            $e5_conductivity = $this->input->post('e5_conductivity');
            $e5_ph           = $this->input->post('e5_ph');
            $e5_silica       = $this->input->post('e5_silica');

            $detail_id_f  = $this->input->post('detail_id_f');
            $f1_timestart = $this->input->post('f1_timestart');
            $f1_timestop  = $this->input->post('f1_timestop');
            $f1_ro        = $this->input->post('f1_ro');
            $f1_flowstart = $this->input->post('f1_flowstart');
            $f1_flowstop  = $this->input->post('f1_flowstop');
            $f1_total     = $this->input->post('f1_total');

            $detail_id_g  = $this->input->post('detail_id_g');
            $g1_timestart = $this->input->post('g1_timestart');
            $g1_timestop  = $this->input->post('g1_timestop');
            $g1_note      = $this->input->post('g1_note');
            $g1_flowstart = $this->input->post('g1_flowstart');
            $g1_flowstop  = $this->input->post('g1_flowstop');
            $g1_total     = $this->input->post('g1_total');

            $data['jmldtl_e'] = count($this->input->post('e1_time'));
            $data['jmldtl_f'] = count($this->input->post('f1_timestart'));
            $data['jmldtl_g'] = count($this->input->post('g1_timestart'));


            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno);

                // cek kalau create date dan nama bulan sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    $data                = array(
                        // pesan gagal krn data sudah ada
                        'message'     => 'Gagal, Data pada Tanggal Laporan : ' . $create_date . ' dan No. Dokumen : ' . $docno . ', sudah pernah disimpan.',
                        'create_date' => $create_date,
                        'docno' => $docno,

                    );
                    $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
                } else {
                    $data4 = array(
                        // versi user original
                        'complete_userid' => $complete_userid,
                        'complete_by'     => $complete_by,
                        'complete_date'   => $complete_date,
                        'complete_time'   => $complete_time,
                        'complete_comp'   => $complete_comp,

                        // versi user audit
                        'complete_useridx' => $complete_userid,
                        'complete_byx'     => $complete_by,
                        'complete_datex'   => $complete_date,
                        'complete_timex'   => $complete_time,
                        'complete_compx'   => $complete_comp,
                        'status_detail'    => '0',
                        'status_detailx'   => '0',
                        'create_date'      => $create_date,
                        'docno'            => $docno,
                        'notification'     => $notification,
                        'shift_1'          => $shift_1,
                        'shift_2'          => $shift_2,
                        'shift_3'          => $shift_3,
                        'total_usedwater'  => $total_usedwater
                    );

                    $this->model->insert_dtheader($data4);
                    $max_hdr_id = $this->db1->insert_id();

                    $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                    $jmldtl = count($this->input->post('a1_time'));
                    for ($i = 0; $i < $jmldtl; $i++) {
                        $data5 = array(
                            'headerid'           => $max_hdr_id,
                            'stdtl'              => $stdtl,
                            'a1_time'            => $a1_time[$i],
                            'a1_alkalinity'      => $a1_alkalinity[$i],
                            'a1_ph'              => $a1_ph[$i],
                            'a1_conductivity'    => $a1_conductivity[$i],
                            'a1_thardness'       => $a1_thardness[$i],
                            'a1_dissolvedoxygen' => $a1_dissolvedoxygen[$i],
                            'a1_silica'          => $a1_silica[$i],
                            'a1_fe'              => $a1_fe[$i],
                            'a2_time'            => $a2_time[$i],
                            'a2_alkalinityp'     => $a2_alkalinityp[$i],
                            'a2_alkalinitym'     => $a2_alkalinitym[$i],
                            'a2_ph'              => $a2_ph[$i],
                            'a2_conductivity'    => $a2_conductivity[$i],
                            'a2_ion'             => $a2_ion[$i],
                            'a2_silica'          => $a2_silica[$i],
                            'a3_time'            => $a3_time[$i],
                            'a3_ph'              => $a3_ph[$i],
                            'a3_conductivity'    => $a3_conductivity[$i],
                            'a3_silica'          => $a3_silica[$i],
                            'a3_fe'              => $a3_fe[$i],
                            'a4_time'            => $a4_time[$i],
                            'a4_ph'              => $a4_ph[$i],
                            'a4_conductivity'    => $a4_conductivity[$i],
                            'a4_silica'          => $a4_silica[$i],
                            'a4_fe'              => $a4_fe[$i]
                        );
                        $this->model->insert_detail($data5);
                    }
                    $this->model->insert_detailx($max_hdr_id);

                    $jmldtl_b = count($this->input->post('b1_time'));
                    for ($i = 0; $i < $jmldtl_b; $i++) {
                        $data5 = array(
                            'headerid'           => $max_hdr_id,
                            'stdtl'              => $stdtl,
                            'b1_time'            => $b1_time[$i],
                            'b1_alkalinity'      => $b1_alkalinity[$i],
                            'b1_ph'              => $b1_ph[$i],
                            'b1_conductivity'    => $b1_conductivity[$i],
                            'b1_thardness'       => $b1_thardness[$i],
                            'b1_dissolvedoxygen' => $b1_dissolvedoxygen[$i],
                            'b1_silica'          => $b1_silica[$i],
                            'b1_fe'              => $b1_fe[$i],
                            'b2_time'            => $b2_time[$i],
                            'b2_alkalinityp'     => $b2_alkalinityp[$i],
                            'b2_alkalinitym'     => $b2_alkalinitym[$i],
                            'b2_ph'              => $b2_ph[$i],
                            'b2_conductivity'    => $b2_conductivity[$i],
                            'b2_ion'             => $b2_ion[$i],
                            'b2_silica'          => $b2_silica[$i],
                            'b3_time'            => $b3_time[$i],
                            'b3_ph'              => $b3_ph[$i],
                            'b3_conductivity'    => $b3_conductivity[$i],
                            'b3_silica'          => $b3_silica[$i],
                            'b3_fe'              => $b3_fe[$i],
                            'b4_time'            => $b4_time[$i],
                            'b4_ph'              => $b4_ph[$i],
                            'b4_conductivity'    => $b4_conductivity[$i],
                            'b4_silica'          => $b4_silica[$i],
                            'b4_fe'              => $b4_fe[$i]
                        );
                        $this->model->insert_detail_b($data5);
                    }
                    $this->model->insert_detail_bx($max_hdr_id);

                    $jmldtl_c = count($this->input->post('c1_time'));
                    for ($i = 0; $i < $jmldtl_c; $i++) {
                        $data5 = array(
                            'headerid'           => $max_hdr_id,
                            'stdtl'              => $stdtl,
                            'c1_time'            => $c1_time[$i],
                            'c1_alkalinity'      => $c1_alkalinity[$i],
                            'c1_ph'              => $c1_ph[$i],
                            'c1_conductivity'    => $c1_conductivity[$i],
                            'c1_thardness'       => $c1_thardness[$i],
                            'c1_dissolvedoxygen' => $c1_dissolvedoxygen[$i],
                            'c1_silica'          => $c1_silica[$i],
                            'c1_fe'              => $c1_fe[$i],
                            'c2_time'            => $c2_time[$i],
                            'c2_alkalinityp'     => $c2_alkalinityp[$i],
                            'c2_alkalinitym'     => $c2_alkalinitym[$i],
                            'c2_ph'              => $c2_ph[$i],
                            'c2_conductivity'    => $c2_conductivity[$i],
                            'c2_ion'             => $c2_ion[$i],
                            'c2_silica'          => $c2_silica[$i],
                            'c3_time'            => $c3_time[$i],
                            'c3_ph'              => $c3_ph[$i],
                            'c3_conductivity'    => $c3_conductivity[$i],
                            'c3_silica'          => $c3_silica[$i],
                            'c3_fe'              => $c3_fe[$i],
                            'c4_time'            => $c4_time[$i],
                            'c4_ph'              => $c4_ph[$i],
                            'c4_conductivity'    => $c4_conductivity[$i],
                            'c4_silica'          => $c4_silica[$i],
                            'c4_fe'              => $c4_fe[$i],
                            'c5_time'            => $c5_time[$i],
                            'c5_conductivity'    => $c5_conductivity[$i],
                            'c5_thardness'       => $c5_thardness[$i],
                            'c5_ph'              => $c5_ph[$i]
                        );
                        $this->model->insert_detail_c($data5);
                    }
                    $this->model->insert_detail_cx($max_hdr_id);

                    $jmldtl_d = count($this->input->post('d1_time'));
                    for ($i = 0; $i < $jmldtl_d; $i++) {
                        $data5 = array(
                            'headerid'           => $max_hdr_id,
                            'stdtl'              => $stdtl,
                            'd1_time'            => $d1_time[$i],
                            'd1_thardness'       => $d1_thardness[$i],
                            'd1_ph'              => $d1_ph[$i],
                            'd1_conductivity'    => $d1_conductivity[$i],
                            'd1_dissolvedoxygen' => $d1_dissolvedoxygen[$i],
                            'd1_silica'          => $d1_silica[$i],
                            'd1_fe'              => $d1_fe[$i],
                            'd2_time'            => $d2_time[$i],
                            'd2_thardness'       => $d2_thardness[$i],
                            'd2_ph'              => $d2_ph[$i],
                            'd2_conductivity'    => $d2_conductivity[$i],
                            'd2_dissolvedoxygen' => $d2_dissolvedoxygen[$i],
                            'd2_silica'          => $d2_silica[$i],
                            'd2_fe'              => $d2_fe[$i],
                            'd3_time'            => $d3_time[$i],
                            'd3_alkalinity'      => $d3_alkalinity[$i],
                            'd3_conductivity'    => $d3_conductivity[$i],
                            'd3_thardness'       => $d3_thardness[$i],
                            'd3_ph'              => $d3_ph[$i],
                            'd3_suhu_inlet'      => $d3_suhu_inlet[$i],
                            'd3_suhu_outlet'     => $d3_suhu_outlet[$i],
                            'd3_turbuditi'       => $d3_turbuditi[$i],
                            'd3_ci'              => $d3_ci[$i],
                            'd3_freeci2'         => $d3_freeci2[$i],
                            'd4_time'            => $d4_time[$i],
                            'd4_thardness'       => $d4_thardness[$i],
                            'd4_ph'              => $d4_ph[$i],
                            'd4_conductivity'    => $d4_conductivity[$i],
                            'd4_turbuditi'       => $d4_turbuditi[$i],
                            'd4_ci'              => $d4_ci[$i],
                            'd4_freeci2'         => $d4_freeci2[$i],
                            'd5_time'            => $d5_time[$i],
                            'd5_ph'              => $d5_ph[$i],
                            'd5_conductivity'    => $d5_conductivity[$i],
                            'd5_hardness'        => $d5_hardness[$i]
                        );
                        $this->model->insert_detail_d($data5);
                    }
                    $this->model->insert_detail_dx($max_hdr_id);

                    $jmldtl_e = count($this->input->post('e1_time'));
                    for ($i = 0; $i < $jmldtl_e; $i++) {
                        $data5 = array(
                            'headerid'        => $max_hdr_id,
                            'stdtl'           => $stdtl,
                            'e1_time'         => $e1_time[$i],
                            'e1_startstop'    => $e1_startstop[$i],
                            'e1_turbuditi'    => $e1_turbuditi[$i],
                            'e1_pressure'     => $e1_pressure[$i],
                            'e1_flowmeter'    => $e1_flowmeter[$i],
                            'e1_ph'           => $e1_ph[$i],
                            'e1_conductivity' => $e1_conductivity[$i],
                            'e2_acidion'      => $e2_acidion[$i],
                            'e3_conductivity' => $e3_conductivity[$i],
                            'e3_ph'           => $e3_ph[$i],
                            'e4_acidion'      => $e4_acidion[$i],
                            'e5_conductivity' => $e5_conductivity[$i],
                            'e5_ph'           => $e5_ph[$i],
                            'e5_silica'       => $e5_silica[$i]
                        );
                        $this->model->insert_detail_e($data5);
                    }
                    $this->model->insert_detail_ex($max_hdr_id);

                    $jmldtl_f = count($this->input->post('f1_timestart'));
                    for ($i = 0; $i < $jmldtl_f; $i++) {
                        $data5 = array(
                            'headerid'     => $max_hdr_id,
                            'stdtl'        => $stdtl,
                            'f1_timestart' => $f1_timestart[$i],
                            'f1_timestop'  => $f1_timestop[$i],
                            'f1_ro'        => $f1_ro[$i],
                            'f1_flowstart' => $f1_flowstart[$i],
                            'f1_flowstop'  => $f1_flowstop[$i],
                            'f1_total'     => $f1_total[$i]

                        );
                        $this->model->insert_detail_f($data5);
                    }
                    $this->model->insert_detail_fx($max_hdr_id);

                    $jmldtl_g = count($this->input->post('g1_timestart'));
                    for ($i = 0; $i < $jmldtl_g; $i++) {
                        $data5 = array(
                            'headerid'     => $max_hdr_id,
                            'stdtl'        => $stdtl,
                            'g1_timestart' => $g1_timestart[$i],
                            'g1_timestop'  => $g1_timestop[$i],
                            'g1_note'      => $g1_note[$i],
                            'g1_flowstart' => $g1_flowstart[$i],
                            'g1_flowstop'  => $g1_flowstop[$i],
                            'g1_total'     => $g1_total[$i]
                        );
                        $this->model->insert_detail_g($data5);
                    }
                    $this->model->insert_detail_gx($max_hdr_id);

                    echo "<script>alert('Data berhasil disimpan!!');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $max_hdr_id, 'refresh');
                }
            } elseif ($frmaksi == 'dtopen') {
                $id = $this->uri->segment(7);

                $data['dtheader'] = $this->model->get_header_byid($id);

                if ($cekLevelUserNm == 'Auditor') {
                    $data['dtdetail']   = $this->model->get_detail_byidx($id);
                    $data['dtdetail_b'] = $this->model->get_detail_byid_bx($id);
                    $data['dtdetail_c'] = $this->model->get_detail_byid_cx($id);
                    $data['dtdetail_d'] = $this->model->get_detail_byid_dx($id);
                    $data['dtdetail_e'] = $this->model->get_detail_byid_ex($id);
                    $data['dtdetail_f'] = $this->model->get_detail_byid_fx($id);
                    $data['dtdetail_g'] = $this->model->get_detail_byid_gx($id);
                } else {
                    $data['dtdetail']   = $this->model->get_detail_byid($id);
                    $data['dtdetail_b'] = $this->model->get_detail_byid_b($id);
                    $data['dtdetail_c'] = $this->model->get_detail_byid_c($id);
                    $data['dtdetail_d'] = $this->model->get_detail_byid_d($id);
                    $data['dtdetail_e'] = $this->model->get_detail_byid_e($id);
                    $data['dtdetail_f'] = $this->model->get_detail_byid_f($id);
                    $data['dtdetail_g'] = $this->model->get_detail_byid_g($id);
                }

                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
            } else {

                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $headerid);

                    if ($cekheader->num_rows() > 0) {
                        echo "<script>alert('Gagal, Data pada Tanggal Laporan : $create_date ,  dan No Dokumen : '.$docno.' sudah pernah disimpan');</script>";
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    } else {
                        if ($cekLevelUserNm == 'Auditor') {
                            $cekdetail = $this->model->cek_stdetailx($headerid);
                        } else {
                            $cekdetail = $this->model->cek_stdetail($headerid);
                        }

                        if ($cekdetail->num_rows() > 0) {
                            $alertmessage = "<script>alert('Gagal, Data sudah dikomplit....!!!! ');</script>";
                        } else {
                            switch ($_POST['btnproses']) {
                                case $_POST['btnproses'] == 'btnupdate':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data4 = array(
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,
                                        );
                                    } else {
                                        $data4 = array(
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'   => $complete_by,
                                            'complete_datex' => $complete_date,
                                            'complete_timex' => $complete_time,
                                            'complete_compx' => $complete_comp,

                                            'complete_userid' => $complete_userid,
                                            'complete_by'     => $complete_by,
                                            'complete_date'   => $complete_date,
                                            'complete_time'   => $complete_time,
                                            'complete_comp'   => $complete_comp,

                                            'notification'    => $notification,
                                            'shift_1'         => $shift_1,
                                            'shift_2'         => $shift_2,
                                            'shift_3'         => $shift_3,
                                            'total_usedwater' => $total_usedwater,
                                        );
                                    }

                                    $alertmessage = "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                                    break;

                                case $_POST['btnproses'] == 'btncomplete':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data4 = array(
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,
                                        );
                                    } else {
                                        $data4 = array(
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,

                                            'app1_userid'         => $complete_userid,
                                            'app1_by'             => $complete_by,
                                            'app1_date'           => $complete_date,
                                            'app1_time'           => $complete_time,
                                            'app1_position'       => $session_data['jabnm'],
                                            'app1_personalid'     => $session_data['personalid'],
                                            'app1_personalstatus' => $session_data['personalstatus'],
                                            'app1_status'         => '1',
                                            'app1_comp'           => $complete_comp,
                                            'status_detail'       => '1',
                                            'status_detailx'      => '1',

                                            'notification'    => $notification,
                                            'shift_1'         => $shift_1,
                                            'shift_2'         => $shift_2,
                                            'shift_3'         => $shift_3,
                                            'total_usedwater' => $total_usedwater
                                        );
                                    }
                                    $alertmessage = "<script>alert('Data berhasil dikomplit....!!!! ');</script>";
                                    break;
                                default:
                                    break;
                            }
                            $this->model->update_hdr($headerid, $data4);

                            $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                            $jmldtl = count($this->input->post('a1_time'));
                            for ($i = 0; $i < $jmldtl; $i++) {
                                if (isset($detail_id[$i])) {
                                    $data5 = array(
                                        'stdtl'              => $stdtl,
                                        'a1_time'            => $a1_time[$i],
                                        'a1_alkalinity'      => $a1_alkalinity[$i],
                                        'a1_ph'              => $a1_ph[$i],
                                        'a1_conductivity'    => $a1_conductivity[$i],
                                        'a1_thardness'       => $a1_thardness[$i],
                                        'a1_dissolvedoxygen' => $a1_dissolvedoxygen[$i],
                                        'a1_silica'          => $a1_silica[$i],
                                        'a1_fe'              => $a1_fe[$i],
                                        'a2_time'            => $a2_time[$i],
                                        'a2_alkalinityp'     => $a2_alkalinityp[$i],
                                        'a2_alkalinitym'     => $a2_alkalinitym[$i],
                                        'a2_ph'              => $a2_ph[$i],
                                        'a2_conductivity'    => $a2_conductivity[$i],
                                        'a2_ion'             => $a2_ion[$i],
                                        'a2_silica'          => $a2_silica[$i],
                                        'a3_time'            => $a3_time[$i],
                                        'a3_ph'              => $a3_ph[$i],
                                        'a3_conductivity'    => $a3_conductivity[$i],
                                        'a3_silica'          => $a3_silica[$i],
                                        'a3_fe'              => $a3_fe[$i],
                                        'a4_time'            => $a4_time[$i],
                                        'a4_ph'              => $a4_ph[$i],
                                        'a4_conductivity'    => $a4_conductivity[$i],
                                        'a4_silica'          => $a4_silica[$i],
                                        'a4_fe'              => $a4_fe[$i]
                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtlx($detail_id[$i], $data5);
                                    } else {
                                        $this->model->update_dtl($detail_id[$i], $data5);
                                        $this->model->update_dtlx($detail_id[$i], $data5);
                                    }
                                } else {
                                    $data5 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'a1_time'            => $a1_time[$i],
                                        'a1_alkalinity'      => $a1_alkalinity[$i],
                                        'a1_ph'              => $a1_ph[$i],
                                        'a1_conductivity'    => $a1_conductivity[$i],
                                        'a1_thardness'       => $a1_thardness[$i],
                                        'a1_dissolvedoxygen' => $a1_dissolvedoxygen[$i],
                                        'a1_silica'          => $a1_silica[$i],
                                        'a1_fe'              => $a1_fe[$i],
                                        'a2_time'            => $a2_time[$i],
                                        'a2_alkalinityp'     => $a2_alkalinityp[$i],
                                        'a2_alkalinitym'     => $a2_alkalinitym[$i],
                                        'a2_ph'              => $a2_ph[$i],
                                        'a2_conductivity'    => $a2_conductivity[$i],
                                        'a2_ion'             => $a2_ion[$i],
                                        'a2_silica'          => $a2_silica[$i],
                                        'a3_time'            => $a3_time[$i],
                                        'a3_ph'              => $a3_ph[$i],
                                        'a3_conductivity'    => $a3_conductivity[$i],
                                        'a3_silica'          => $a3_silica[$i],
                                        'a3_fe'              => $a3_fe[$i],
                                        'a4_time'            => $a4_time[$i],
                                        'a4_ph'              => $a4_ph[$i],
                                        'a4_conductivity'    => $a4_conductivity[$i],
                                        'a4_silica'          => $a4_silica[$i],
                                        'a4_fe'              => $a4_fe[$i]
                                    );
                                    $this->model->insert_detail($data5);
                                }
                            }
                            $this->model->insert_detailx($headerid);

                            $jmldtl_b = count($this->input->post('b1_time'));
                            for ($i = 0; $i < $jmldtl_b; $i++) {
                                if (isset($detail_id_b[$i])) {
                                    $data5 = array(
                                        'stdtl'              => $stdtl,
                                        'b1_time'            => $b1_time[$i],
                                        'b1_alkalinity'      => $b1_alkalinity[$i],
                                        'b1_ph'              => $b1_ph[$i],
                                        'b1_conductivity'    => $b1_conductivity[$i],
                                        'b1_thardness'       => $b1_thardness[$i],
                                        'b1_dissolvedoxygen' => $b1_dissolvedoxygen[$i],
                                        'b1_silica'          => $b1_silica[$i],
                                        'b1_fe'              => $b1_fe[$i],
                                        'b2_time'            => $b2_time[$i],
                                        'b2_alkalinityp'     => $b2_alkalinityp[$i],
                                        'b2_alkalinitym'     => $b2_alkalinitym[$i],
                                        'b2_ph'              => $b2_ph[$i],
                                        'b2_conductivity'    => $b2_conductivity[$i],
                                        'b2_ion'             => $b2_ion[$i],
                                        'b2_silica'          => $b2_silica[$i],
                                        'b3_time'            => $b3_time[$i],
                                        'b3_ph'              => $b3_ph[$i],
                                        'b3_conductivity'    => $b3_conductivity[$i],
                                        'b3_silica'          => $b3_silica[$i],
                                        'b3_fe'              => $b3_fe[$i],
                                        'b4_time'            => $b4_time[$i],
                                        'b4_ph'              => $b4_ph[$i],
                                        'b4_conductivity'    => $b4_conductivity[$i],
                                        'b4_silica'          => $b4_silica[$i],
                                        'b4_fe'              => $b4_fe[$i]
                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_bx($detail_id[$i], $data5);
                                    } else {
                                        $this->model->update_dtl_b($detail_id[$i], $data5);
                                        $this->model->update_dtl_bx($detail_id[$i], $data5);
                                    }
                                } else {
                                    $data5 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'b1_time'            => $b1_time[$i],
                                        'b1_alkalinity'      => $b1_alkalinity[$i],
                                        'b1_ph'              => $b1_ph[$i],
                                        'b1_conductivity'    => $b1_conductivity[$i],
                                        'b1_thardness'       => $b1_thardness[$i],
                                        'b1_dissolvedoxygen' => $b1_dissolvedoxygen[$i],
                                        'b1_silica'          => $b1_silica[$i],
                                        'b1_fe'              => $b1_fe[$i],
                                        'b2_time'            => $b2_time[$i],
                                        'b2_alkalinityp'     => $b2_alkalinityp[$i],
                                        'b2_alkalinitym'     => $b2_alkalinitym[$i],
                                        'b2_ph'              => $b2_ph[$i],
                                        'b2_conductivity'    => $b2_conductivity[$i],
                                        'b2_ion'             => $b2_ion[$i],
                                        'b2_silica'          => $b2_silica[$i],
                                        'b3_time'            => $b3_time[$i],
                                        'b3_ph'              => $b3_ph[$i],
                                        'b3_conductivity'    => $b3_conductivity[$i],
                                        'b3_silica'          => $b3_silica[$i],
                                        'b3_fe'              => $b3_fe[$i],
                                        'b4_time'            => $b4_time[$i],
                                        'b4_ph'              => $b4_ph[$i],
                                        'b4_conductivity'    => $b4_conductivity[$i],
                                        'b4_silica'          => $b4_silica[$i],
                                        'b4_fe'              => $b4_fe[$i]
                                    );
                                    $this->model->insert_detail_b($data5);
                                }
                            }
                            $this->model->insert_detail_bx($headerid);

                            $jmldtl_c = count($this->input->post('c1_time'));
                            for ($i = 0; $i < $jmldtl_c; $i++) {
                                if (isset($detail_id_c[$i])) {
                                    $data5 = array(
                                        'stdtl'              => $stdtl,
                                        'c1_time'            => $c1_time[$i],
                                        'c1_alkalinity'      => $c1_alkalinity[$i],
                                        'c1_ph'              => $c1_ph[$i],
                                        'c1_conductivity'    => $c1_conductivity[$i],
                                        'c1_thardness'       => $c1_thardness[$i],
                                        'c1_dissolvedoxygen' => $c1_dissolvedoxygen[$i],
                                        'c1_silica'          => $c1_silica[$i],
                                        'c1_fe'              => $c1_fe[$i],
                                        'c2_time'            => $c2_time[$i],
                                        'c2_alkalinityp'     => $c2_alkalinityp[$i],
                                        'c2_alkalinitym'     => $c2_alkalinitym[$i],
                                        'c2_ph'              => $c2_ph[$i],
                                        'c2_conductivity'    => $c2_conductivity[$i],
                                        'c2_ion'             => $c2_ion[$i],
                                        'c2_silica'          => $c2_silica[$i],
                                        'c3_time'            => $c3_time[$i],
                                        'c3_ph'              => $c3_ph[$i],
                                        'c3_conductivity'    => $c3_conductivity[$i],
                                        'c3_silica'          => $c3_silica[$i],
                                        'c3_fe'              => $c3_fe[$i],
                                        'c4_time'            => $c4_time[$i],
                                        'c4_ph'              => $c4_ph[$i],
                                        'c4_conductivity'    => $c4_conductivity[$i],
                                        'c4_silica'          => $c4_silica[$i],
                                        'c4_fe'              => $c4_fe[$i],
                                        'c5_time'            => $c5_time[$i],
                                        'c5_conductivity'    => $c5_conductivity[$i],
                                        'c5_thardness'       => $c5_thardness[$i],
                                        'c5_ph'              => $c5_ph[$i]
                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_cx($detail_id[$i], $data5);
                                    } else {
                                        $this->model->update_dtl_c($detail_id[$i], $data5);
                                        $this->model->update_dtl_cx($detail_id[$i], $data5);
                                    }
                                } else {
                                    $data5 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'c1_time'            => $c1_time[$i],
                                        'c1_alkalinity'      => $c1_alkalinity[$i],
                                        'c1_ph'              => $c1_ph[$i],
                                        'c1_conductivity'    => $c1_conductivity[$i],
                                        'c1_thardness'       => $c1_thardness[$i],
                                        'c1_dissolvedoxygen' => $c1_dissolvedoxygen[$i],
                                        'c1_silica'          => $c1_silica[$i],
                                        'c1_fe'              => $c1_fe[$i],
                                        'c2_time'            => $c2_time[$i],
                                        'c2_alkalinityp'     => $c2_alkalinityp[$i],
                                        'c2_alkalinitym'     => $c2_alkalinitym[$i],
                                        'c2_ph'              => $c2_ph[$i],
                                        'c2_conductivity'    => $c2_conductivity[$i],
                                        'c2_ion'             => $c2_ion[$i],
                                        'c2_silica'          => $c2_silica[$i],
                                        'c3_time'            => $c3_time[$i],
                                        'c3_ph'              => $c3_ph[$i],
                                        'c3_conductivity'    => $c3_conductivity[$i],
                                        'c3_silica'          => $c3_silica[$i],
                                        'c3_fe'              => $c3_fe[$i],
                                        'c4_time'            => $c4_time[$i],
                                        'c4_ph'              => $c4_ph[$i],
                                        'c4_conductivity'    => $c4_conductivity[$i],
                                        'c4_silica'          => $c4_silica[$i],
                                        'c4_fe'              => $c4_fe[$i],
                                        'c5_time'            => $c5_time[$i],
                                        'c5_conductivity'    => $c5_conductivity[$i],
                                        'c5_thardness'       => $c5_thardness[$i],
                                        'c5_ph'              => $c5_ph[$i]
                                    );
                                    $this->model->insert_detail_c($data5);
                                }
                            }
                            $this->model->insert_detail_cx($headerid);

                            $jmldtl_d = count($this->input->post('d1_time'));
                            for ($i = 0; $i < $jmldtl_d; $i++) {
                                if (isset($detail_id_d[$i])) {
                                    $data5 = array(
                                        'stdtl'              => $stdtl,
                                        'd1_time'            => $d1_time[$i],
                                        'd1_thardness'       => $d1_thardness[$i],
                                        'd1_ph'              => $d1_ph[$i],
                                        'd1_conductivity'    => $d1_conductivity[$i],
                                        'd1_dissolvedoxygen' => $d1_dissolvedoxygen[$i],
                                        'd1_silica'          => $d1_silica[$i],
                                        'd1_fe'              => $d1_fe[$i],
                                        'd2_time'            => $d2_time[$i],
                                        'd2_thardness'       => $d2_thardness[$i],
                                        'd2_ph'              => $d2_ph[$i],
                                        'd2_conductivity'    => $d2_conductivity[$i],
                                        'd2_dissolvedoxygen' => $d2_dissolvedoxygen[$i],
                                        'd2_silica'          => $d2_silica[$i],
                                        'd2_fe'              => $d2_fe[$i],
                                        'd3_time'            => $d3_time[$i],
                                        'd3_alkalinity'      => $d3_alkalinity[$i],
                                        'd3_conductivity'    => $d3_conductivity[$i],
                                        'd3_thardness'       => $d3_thardness[$i],
                                        'd3_ph'              => $d3_ph[$i],
                                        'd3_suhu_inlet'      => $d3_suhu_inlet[$i],
                                        'd3_suhu_outlet'     => $d3_suhu_outlet[$i],
                                        'd3_turbuditi'       => $d3_turbuditi[$i],
                                        'd3_ci'              => $d3_ci[$i],
                                        'd3_freeci2'         => $d3_freeci2[$i],
                                        'd4_time'            => $d4_time[$i],
                                        'd4_thardness'       => $d4_thardness[$i],
                                        'd4_ph'              => $d4_ph[$i],
                                        'd4_conductivity'    => $d4_conductivity[$i],
                                        'd4_turbuditi'       => $d4_turbuditi[$i],
                                        'd4_ci'              => $d4_ci[$i],
                                        'd4_freeci2'         => $d4_freeci2[$i],
                                        'd5_time'            => $d5_time[$i],
                                        'd5_ph'              => $d5_ph[$i],
                                        'd5_conductivity'    => $d5_conductivity[$i],
                                        'd5_hardness'        => $d5_hardness[$i]
                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_dx($detail_id[$i], $data5);
                                    } else {
                                        $this->model->update_dtl_d($detail_id[$i], $data5);
                                        $this->model->update_dtl_dx($detail_id[$i], $data5);
                                    }
                                } else {
                                    $data5 = array(
                                        'headerid'           => $headerid,
                                        'stdtl'              => $stdtl,
                                        'd1_time'            => $d1_time[$i],
                                        'd1_thardness'       => $d1_thardness[$i],
                                        'd1_ph'              => $d1_ph[$i],
                                        'd1_conductivity'    => $d1_conductivity[$i],
                                        'd1_dissolvedoxygen' => $d1_dissolvedoxygen[$i],
                                        'd1_silica'          => $d1_silica[$i],
                                        'd1_fe'              => $d1_fe[$i],
                                        'd2_time'            => $d2_time[$i],
                                        'd2_thardness'       => $d2_thardness[$i],
                                        'd2_ph'              => $d2_ph[$i],
                                        'd2_conductivity'    => $d2_conductivity[$i],
                                        'd2_dissolvedoxygen' => $d2_dissolvedoxygen[$i],
                                        'd2_silica'          => $d2_silica[$i],
                                        'd2_fe'              => $d2_fe[$i],
                                        'd3_time'            => $d3_time[$i],
                                        'd3_alkalinity'      => $d3_alkalinity[$i],
                                        'd3_conductivity'    => $d3_conductivity[$i],
                                        'd3_thardness'       => $d3_thardness[$i],
                                        'd3_ph'              => $d3_ph[$i],
                                        'd3_suhu_inlet'      => $d3_suhu_inlet[$i],
                                        'd3_suhu_outlet'     => $d3_suhu_outlet[$i],
                                        'd3_turbuditi'       => $d3_turbuditi[$i],
                                        'd3_ci'              => $d3_ci[$i],
                                        'd3_freeci2'         => $d3_freeci2[$i],
                                        'd4_time'            => $d4_time[$i],
                                        'd4_thardness'       => $d4_thardness[$i],
                                        'd4_ph'              => $d4_ph[$i],
                                        'd4_conductivity'    => $d4_conductivity[$i],
                                        'd4_turbuditi'       => $d4_turbuditi[$i],
                                        'd4_ci'              => $d4_ci[$i],
                                        'd4_freeci2'         => $d4_freeci2[$i],
                                        'd5_time'            => $d5_time[$i],
                                        'd5_ph'              => $d5_ph[$i],
                                        'd5_conductivity'    => $d5_conductivity[$i],
                                        'd5_hardness'        => $d5_hardness[$i]
                                    );
                                    $this->model->insert_detail_d($data5);
                                }
                            }
                            $this->model->insert_detail_dx($headerid);

                            $jmldtl_e = count($this->input->post('e1_time'));
                            for ($i = 0; $i < $jmldtl_e; $i++) {
                                if (isset($detail_id_e[$i])) {
                                    $data5 = array(
                                        'stdtl'           => $stdtl,
                                        'e1_time'         => $e1_time[$i],
                                        'e1_startstop'    => $e1_startstop[$i],
                                        'e1_turbuditi'    => $e1_turbuditi[$i],
                                        'e1_pressure'     => $e1_pressure[$i],
                                        'e1_flowmeter'    => $e1_flowmeter[$i],
                                        'e1_ph'           => $e1_ph[$i],
                                        'e1_conductivity' => $e1_conductivity[$i],
                                        'e2_acidion'      => $e2_acidion[$i],
                                        'e3_conductivity' => $e3_conductivity[$i],
                                        'e3_ph'           => $e3_ph[$i],
                                        'e4_acidion'      => $e4_acidion[$i],
                                        'e5_conductivity' => $e5_conductivity[$i],
                                        'e5_ph'           => $e5_ph[$i],
                                        'e5_silica'       => $e5_silica[$i]
                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_ex($detail_id[$i], $data5);
                                    } else {
                                        $this->model->update_dtl_e($detail_id[$i], $data5);
                                        $this->model->update_dtl_ex($detail_id[$i], $data5);
                                    }
                                } else {
                                    $data5 = array(
                                        'headerid'        => $headerid,
                                        'stdtl'           => $stdtl,
                                        'e1_time'         => $e1_time[$i],
                                        'e1_startstop'    => $e1_startstop[$i],
                                        'e1_turbuditi'    => $e1_turbuditi[$i],
                                        'e1_pressure'     => $e1_pressure[$i],
                                        'e1_flowmeter'    => $e1_flowmeter[$i],
                                        'e1_ph'           => $e1_ph[$i],
                                        'e1_conductivity' => $e1_conductivity[$i],
                                        'e2_acidion'      => $e2_acidion[$i],
                                        'e3_conductivity' => $e3_conductivity[$i],
                                        'e3_ph'           => $e3_ph[$i],
                                        'e4_acidion'      => $e4_acidion[$i],
                                        'e5_conductivity' => $e5_conductivity[$i],
                                        'e5_ph'           => $e5_ph[$i],
                                        'e5_silica'       => $e5_silica[$i]
                                    );
                                    $this->model->insert_detail_e($data5);
                                }
                            }
                            $this->model->insert_detail_ex($headerid);

                            $jmldtl_f = count($this->input->post('f1_timestart'));
                            for ($i = 0; $i < $jmldtl_f; $i++) {
                                if (isset($detail_id_f[$i])) {
                                    $data5 = array(
                                        'stdtl'        => $stdtl,
                                        'f1_timestart' => $f1_timestart[$i],
                                        'f1_timestop'  => $f1_timestop[$i],
                                        'f1_ro'        => $f1_ro[$i],
                                        'f1_flowstart' => $f1_flowstart[$i],
                                        'f1_flowstop'  => $f1_flowstop[$i],
                                        'f1_total'     => $f1_total[$i]
                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_fx($detail_id[$i], $data5);
                                    } else {
                                        $this->model->update_dtl_f($detail_id[$i], $data5);
                                        $this->model->update_dtl_fx($detail_id[$i], $data5);
                                    }
                                } else {
                                    $data5 = array(
                                        'headerid'     => $headerid,
                                        'stdtl'        => $stdtl,
                                        'f1_timestart' => $f1_timestart[$i],
                                        'f1_timestop'  => $f1_timestop[$i],
                                        'f1_ro'        => $f1_ro[$i],
                                        'f1_flowstart' => $f1_flowstart[$i],
                                        'f1_flowstop'  => $f1_flowstop[$i],
                                        'f1_total'     => $f1_total[$i]
                                    );
                                    $this->model->insert_detail_f($data5);
                                }
                            }
                            $this->model->insert_detail_fx($headerid);

                            $jmldtl_g = count($this->input->post('g1_timestart'));
                            for ($i = 0; $i < $jmldtl_g; $i++) {
                                if (isset($detail_id_g[$i])) {
                                    $data5 = array(
                                        'stdtl'        => $stdtl,
                                        'g1_timestart' => $g1_timestart[$i],
                                        'g1_timestop'  => $g1_timestop[$i],
                                        'g1_note'      => $g1_note[$i],
                                        'g1_flowstart' => $g1_flowstart[$i],
                                        'g1_flowstop'  => $g1_flowstop[$i],
                                        'g1_total'     => $g1_total[$i]
                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl_gx($detail_id[$i], $data5);
                                    } else {
                                        $this->model->update_dtl_g($detail_id[$i], $data5);
                                        $this->model->update_dtl_gx($detail_id[$i], $data5);
                                    }
                                } else {
                                    $data5 = array(
                                        'headerid'     => $headerid,
                                        'stdtl'        => $stdtl,
                                        'g1_timestart' => $g1_timestart[$i],
                                        'g1_timestop'  => $g1_timestop[$i],
                                        'g1_note'      => $g1_note[$i],
                                        'g1_flowstart' => $g1_flowstart[$i],
                                        'g1_flowstop'  => $g1_flowstop[$i],
                                        'g1_total'     => $g1_total[$i]
                                    );
                                    $this->model->insert_detail_g($data5);
                                }
                            }
                            $this->model->insert_detail_gx($headerid);
                        }
                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
                } else {
                    echo "<script>alert('gagal, tidak ada aksi!');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                }
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}
