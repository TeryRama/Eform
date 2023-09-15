<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_formfrmfss520_08 extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $CI        = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);

        $frmkode   = $this->uri->segment(4);
        $frmvrs    = $this->uri->segment(5);

        $this->load->model(array('M_user', 'M_menu', 'tambahan/M_tambahan', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->library(array('table', 'form_validation', 'excel', 'image_lib'));
        $this->load->helper(array('form', 'url', 'html', 'file', 'path'));

        $this->model = $this->{'M_form' . $frmkode . '_' . $frmvrs};

        //////////////////////////////////
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
        //////////////////////////////////
    }

    function get_docno()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $create_date  = $this->input->post('create_date');

            $dthasil      = $this->model->get_docno(date("m", strtotime($create_date)), date("Y", strtotime($create_date)));
            $dthasil2      = $this->model->get_docno(date("m", strtotime($create_date)), date("Y", strtotime($create_date)));

            $last_docno   = isset($dthasil->vdocno) ? $dthasil->vdocno + 1 : 1;
            $last_docno   = isset($dthasil2->vdocno) ? $dthasil2->vdocno + 1 : 1;

            $arr_bulan    = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            $docno        = 'CIP/WTD/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' . str_pad($last_docno, 3, '0', STR_PAD_LEFT);

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil!",
                'data'    => $docno,
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_list_item()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $tipe_dtl     = $this->input->post('tipe_dtl');
            $create_date  = $this->input->post('create_date');
            $rasult       = $this->model->get_list_item($tipe_dtl, date("Y-m-d", strtotime($this->input->post('create_date'))));

            if (count($rasult) > 0) {
                $hasil2 = array(
                    'status'  => 0,
                    'vstatus' => 'berhasil',
                    'pesan'   => "Berhasil memuat data, \nsilahkan simpan dahulu!",
                    'data'    => $rasult,
                );
            } else {
                $hasil2 = array(
                    'status'  => 1,
                    'vstatus' => 'gagal',
                    'pesan'   => "Data detail tidak ditemukan!!!",
                );
            }
            echo json_encode($hasil2);
        } else {

            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function form()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data           = $this->session->userdata('logged_in');
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

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);

            //ambil variabel URL
            $frmkode                = $this->uri->segment(4);
            $frmvrs                 = $this->uri->segment(5);

            $dtfrm                  = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                  = array('dtfrm' => $dtfrm);

            $frmaksi                = $this->uri->segment(6);

            // data hedder
            $headerid               = addslashes($this->input->post('headerid'));
            $page_shift             = addslashes($this->input->post('page_shift'));

            $shift_now              = ($page_shift != '') ? explode(" ", $page_shift)[1] : '';

            $complete_userid        = $session_data['userid'];
            $complete_date          = date('Y-m-d');
            $complete_time          = date('H:i:s');
            $complete_by            = $session_data['nmlengkap'];
            $complete_comp          = $this->session->userdata('hostname'); // versi user original

            $create_date            = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y
            $docno                  = addslashes($this->input->post('docno'));

            // detail
            $dtl_detail_id      = $this->input->post('dtl_detail_id');
            $dtl_shift          = $this->input->post('dtl_shift');
            $dtl_nama_mesin     = $this->input->post('dtl_nama_mesin');
            $dtl_kode           = $this->input->post('dtl_kode');
            $dtl_parameter      = $this->input->post('dtl_parameter');
            $dtl_jml_per_mesin  = $this->input->post('dtl_jml_per_mesin');
            $dtl_cek_shift_jam1 = $this->input->post('dtl_cek_shift_jam1');
            $dtl_cek_shift_jam2 = $this->input->post('dtl_cek_shift_jam2');
            $dtl_cek_shift_jam3 = $this->input->post('dtl_cek_shift_jam3');
            $dtl_cek_shift_jam4 = $this->input->post('dtl_cek_shift_jam4');
            $dtl_cek_shift_jam5 = $this->input->post('dtl_cek_shift_jam5');
            $dtl_cek_shift_jam6 = $this->input->post('dtl_cek_shift_jam6');
            $dtl_cek_shift_jam7 = $this->input->post('dtl_cek_shift_jam7');
            $dtl_cek_shift_jam8 = $this->input->post('dtl_cek_shift_jam8');

            // detail b
            $dtl_b_detail_id    = $this->input->post('dtl_b_detail_id');
            $dtl_b_shift        = $this->input->post('dtl_b_shift');
            $dtl_b_time_check   = $this->input->post('dtl_b_time_check');
            $dtl_b_ph_air       = $this->input->post('dtl_b_ph_air');
            $dtl_b_ph_caustic   = $this->input->post('dtl_b_ph_caustic');
            $dtl_b_temp_caustic = $this->input->post('dtl_b_temp_caustic');
            $dtl_b_ph_acid      = $this->input->post('dtl_b_ph_acid');
            $dtl_b_temp_acid    = $this->input->post('dtl_b_temp_acid');

            // detail c
            $dtl_c_detail_id    = $this->input->post('dtl_c_detail_id');
            $dtl_c_shift        = $this->input->post('dtl_c_shift');
            $dtl_c_time_check   = $this->input->post('dtl_c_time_check');
            $dtl_c_ph           = $this->input->post('dtl_c_ph');
            $dtl_c_residu_caustic   = $this->input->post('dtl_c_residu_caustic');
            $dtl_c_residu_acid  = $this->input->post('dtl_c_residu_acid');

            // detail d
            $dtl_d_detail_id    = $this->input->post('dtl_d_detail_id');
            $dtl_d_shift        = $this->input->post('dtl_d_shift');
            $dtl_d_jam          = $this->input->post('dtl_d_jam');
            $dtl_d_uraian       = $this->input->post('dtl_d_uraian');
            $dtl_d_tindakan     = $this->input->post('dtl_d_tindakan');
            $dtl_d_pj_id        = $this->input->post('dtl_d_pj_id');
            $dtl_d_keterangan   = $this->input->post('dtl_d_keterangan');


            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno);

                if ($cekheader->num_rows() > 0) {
                    $data['message']       = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ' dan No Dokumen : ' . $docno . ' sudah pernah disimpan';

                    $data['page_shift']    = addslashes($this->input->post('page_shift'));

                    $data['dtcreate_date'] = addslashes($this->input->post('create_date'));
                    $data['dtdocno']       = addslashes($this->input->post('docno'));

                    $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
                } else {
                    $data5 = array(
                        'complete_userid'    => $complete_userid,
                        'complete_by'        => $complete_by,
                        'complete_date'      => $complete_date,
                        'complete_time'      => $complete_time,
                        'complete_comp'      => $complete_comp,     // versi user original

                        'complete_useridx'   => $complete_userid,
                        'complete_byx'       => $complete_by,
                        'complete_datex'     => $complete_date,
                        'complete_timex'     => $complete_time,
                        'complete_compx'     => $complete_comp,     // versi user audit                        

                        'status_detail_sf1'  => '0',
                        'status_detailx_sf1' => '0',
                        'status_detail_sf2'  => '0',
                        'status_detailx_sf2' => '0',
                        'status_detail_sf3'  => '0',
                        'status_detailx_sf3' => '0',

                        'create_date'        => $create_date,
                        'docno'              => $docno,
                    );

                    // operator sebagai app1
                    // $data5['app1_userid']         = $complete_userid;
                    // $data5['app1_by']             = $complete_by;
                    // $data5['app1_date']           = $complete_date;
                    // $data5['app1_time']           = $complete_time;
                    // $data5['app1_position']       = $session_data['jabnm'];
                    // $data5['app1_status']         = '1';
                    // $data5['app1_comp']           = $complete_comp;
                    // $data5['app1_personalid']     = $session_data['personalid'];
                    // $data5['app1_personalstatus'] = $session_data['personalstatus'];

                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    if ($cekLevelUserNm == "Auditor") {
                        $stdtl = '0';
                    } else {
                        $stdtl = '1';
                    }

                    // detail
                    $jml = count($this->input->post('dtl_shift'));
                    for ($i = 0; $i < $jml; $i++) {

                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'shift'          => $dtl_shift[$i],
                            'nama_mesin'     => $dtl_nama_mesin[$i],
                            'kode'           => $dtl_kode[$i],
                            'parameter'      => $dtl_parameter[$i],
                            'jml_per_mesin'  => $dtl_jml_per_mesin[$i],

                            'cek_shift_jam1' => $dtl_shift[$i] == 'shift_1' ? $dtl_cek_shift_jam1[$i] : null, // untuk input awal nilai hanya utk shift 1 aja ya
                            'cek_shift_jam2' => $dtl_shift[$i] == 'shift_1' ? $dtl_cek_shift_jam2[$i] : null,
                            'cek_shift_jam3' => $dtl_shift[$i] == 'shift_1' ? $dtl_cek_shift_jam3[$i] : null,
                            'cek_shift_jam4' => $dtl_shift[$i] == 'shift_1' ? $dtl_cek_shift_jam4[$i] : null,
                            'cek_shift_jam5' => $dtl_shift[$i] == 'shift_1' ? $dtl_cek_shift_jam5[$i] : null,
                            'cek_shift_jam6' => $dtl_shift[$i] == 'shift_1' ? $dtl_cek_shift_jam6[$i] : null,
                            'cek_shift_jam7' => $dtl_shift[$i] == 'shift_1' ? $dtl_cek_shift_jam7[$i] : null,
                            'cek_shift_jam8' => $dtl_shift[$i] == 'shift_1' ? $dtl_cek_shift_jam8[$i] : null,

                        );
                        $this->model->insert_detail($data6);
                    }

                    //detail b
                    $jml2 = count($this->input->post('dtl_b_time_check'));
                    for ($i2 = 0; $i2 < $jml2; $i2++) {
                        $data6b = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'shift' => $dtl_b_shift[$i2],

                            'time_check'   => $dtl_b_shift[$i2] == 'shift_1' ? $dtl_b_time_check[$i2] : null,
                            'ph_air'       => $dtl_b_shift[$i2] == 'shift_1' ? $dtl_b_ph_air[$i2] : null,
                            'ph_caustic'   => $dtl_b_shift[$i2] == 'shift_1' ? $dtl_b_ph_caustic[$i2] : null,
                            'temp_caustic' => $dtl_b_shift[$i2] == 'shift_1' ? $dtl_b_temp_caustic[$i2] : null,
                            'ph_acid'      => $dtl_b_shift[$i2] == 'shift_1' ? $dtl_b_ph_acid[$i2] : null,
                            'temp_acid'    => $dtl_b_shift[$i2] == 'shift_1' ? $dtl_b_temp_acid[$i2] : null,
                        );

                        $this->model->insert_detail_b($data6b);
                    }

                    //detail c
                    $jml3 = count($this->input->post('dtl_c_ph'));
                    for ($i3 = 0; $i3 < $jml3; $i3++) {
                        $data6c = array(
                            'headerid'  => $max_hdr_id,
                            'stdtl'     => $stdtl,

                            'shift'     => $dtl_c_shift[$i3],

                            'time_check'     => $dtl_c_shift[$i3] == 'shift_1' ? $dtl_c_time_check[$i3] : null,
                            'ph'             => $dtl_c_shift[$i3] == 'shift_1' ? $dtl_c_ph[$i3] : null,
                            'residu_caustic' => $dtl_c_shift[$i3] == 'shift_1' ? $dtl_c_residu_caustic[$i3] : null,
                            'residu_acid'    => $dtl_c_shift[$i3] == 'shift_1' ? $dtl_c_residu_acid[$i3] : null,

                        );

                        $this->model->insert_detail_c($data6c);
                    }

                    //detail d
                    $jml4 = count($this->input->post('dtl_d_jam'));
                    for ($i4 = 0; $i4 < $jml4; $i4++) {

                        if ($dtl_d_pj_id[$i4] != '') {
                            $dt_pj_by = $this->model->get_pj_by($dtl_d_pj_id[$i4]);

                            $pj_personalstatus[$i4] = $dt_pj_by->personalstatus;
                            $pj_personalid[$i4]     = $dt_pj_by->personalid;
                            $pj_nik[$i4]            = $dt_pj_by->nik;
                            $pj_nama[$i4]           = $dt_pj_by->nama;
                        } else {
                            $pj_personalstatus[$i4] = null;
                            $pj_personalid[$i4]     = null;
                            $pj_nik[$i4]            = null;
                            $pj_nama[$i4]           = null;
                        }

                        $data6d = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'shift' => $dtl_d_shift[$i4],

                            'jam'      => $dtl_d_shift[$i4] == 'shift_1' ? $dtl_d_jam[$i4] : null,
                            'tindakan' => $dtl_d_shift[$i4] == 'shift_1' ? $dtl_d_tindakan[$i4] : null,

                            'pj_id'             => $dtl_d_shift[$i4] == 'shift_1' ? $dtl_d_pj_id[$i4] : null,
                            'pj_personalstatus' => $dtl_d_shift[$i4] == 'shift_1' ? $pj_personalstatus[$i4] : null,
                            'pj_personalid'     => $dtl_d_shift[$i4] == 'shift_1' ? $pj_personalid[$i4] : null,
                            'pj_nik'            => $dtl_d_shift[$i4] == 'shift_1' ? $pj_nik[$i4] : null,
                            'pj_nama'           => $dtl_d_shift[$i4] == 'shift_1' ? $pj_nama[$i4] : null,
                        );

                        $this->model->insert_detail_d($data6d);
                    }

                    $this->model->insert_detailx($max_hdr_id);
                    $this->model->insert_detail_bx($max_hdr_id);
                    $this->model->insert_detail_cx($max_hdr_id);
                    $this->model->insert_detail_dx($max_hdr_id);

                    echo "<script>alert('Data berhasil disimpan!!');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $max_hdr_id, 'refresh');
                }
            } elseif ($frmaksi == 'dtopen') {
                $id       = $this->uri->segment(7);

                $dtheader = $this->model->get_header_byid($id); // get data header
                $data6b    = array('dtheader' => $dtheader);

                foreach ($dtheader as $hdrrow) {
                    $dtcreate_date = $hdrrow->create_date;

                    // kondisi form shift
                    $data['page_shift']    = 'Shift Komplit';
                    for ($i = 1; $i <= 3; $i++) {
                        if ($cekLevelUserNm == "Auditor" && $hdrrow->{'status_detailx_sf' . $i} == '0') {
                            $data['page_shift'] = 'Shift ' . $i;
                            break;
                        } else if ($hdrrow->{'status_detail_sf' . $i} == '0') {
                            $data['page_shift'] = 'Shift ' . $i;
                            break;
                        }
                    }
                }


                $data['list_pj'] = $this->model->get_list_pj($dtcreate_date);

                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail       = $this->model->get_detail_byidx($id);
                    $dtdetail_b     = $this->model->get_detail_byid_bx($id);
                    $dtdetail_c     = $this->model->get_detail_byid_cx($id);
                    $dtdetail_d     = $this->model->get_detail_byid_dx($id);
                } else {
                    $dtdetail       = $this->model->get_detail_byid($id);
                    $dtdetail_b     = $this->model->get_detail_byid_b($id);
                    $dtdetail_c     = $this->model->get_detail_byid_c($id);
                    $dtdetail_d     = $this->model->get_detail_byid_d($id);
                }

                $data8  = array('dtdetail' => $dtdetail, 'dtdetail_b' => $dtdetail_b, 'dtdetail_c' => $dtdetail_c, 'dtdetail_d' => $dtdetail_d);

                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data6b, $data8));
            } else {

                if (isset($_POST['btnproses'])) {

                    $cekheader = $this->model->check2($create_date, $docno, $headerid);

                    if ($cekheader->num_rows() > 0) {
                        echo "<script>alert('Gagal, Data pada tanggal Laporan : '.$create_date.' dan No Dokumen : '.$docno.' sudah pernah disimpan');</script>";
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    } else {
                        if ($cekLevelUserNm == "Auditor") {
                            $cekdetail = $this->model->cek_stdetailx($headerid);
                            // $cekdetail = $this->model->cek_stdetail_bx($headerid);
                        } else {
                            $cekdetail = $this->model->cek_stdetail($headerid);
                            // $cekdetail = $this->model->cek_stdetail_b($headerid);
                        }

                        if ($cekdetail->num_rows() > 0) {
                            $alertmessage = "<script>alert('Gagal, Data sudah dikomplit....!!!! ');</script>";
                        } else {

                            if ($cekLevelUserNm == "Auditor") {
                                $data5 = array(
                                    'complete_useridx' => $complete_userid,
                                    'complete_byx'     => $complete_by,
                                    'complete_datex'   => $complete_date,
                                    'complete_timex'   => $complete_time,
                                    'complete_compx'   => $complete_comp, // versi user audit
                                );
                            } else {
                                $data5 = array(
                                    'complete_useridx' => $complete_userid,
                                    'complete_byx'     => $complete_by,
                                    'complete_datex'   => $complete_date,
                                    'complete_timex'   => $complete_time,
                                    'complete_compx'   => $complete_comp,     // versi user audit

                                    'complete_userid'  => $complete_userid,
                                    'complete_by'      => $complete_by,
                                    'complete_date'    => $complete_date,
                                    'complete_time'    => $complete_time,
                                    'complete_comp'    => $complete_comp,     // versi user original
                                );
                            }

                            for ($i = $shift_now; $i <= $shift_now; $i++) {
                                switch ($_POST['btnproses']) {
                                        // update per shift
                                    case $_POST['btnproses'] == 'btnupdate_sf' . $i:
                                        // sebagai approval operator
                                        // $data5['app' . ($i * 2 - 1) . '_userid']         = $complete_userid;
                                        // $data5['app' . ($i * 2 - 1) . '_by']             = $complete_by;
                                        // $data5['app' . ($i * 2 - 1) . '_date']           = $complete_date;
                                        // $data5['app' . ($i * 2 - 1) . '_time']           = $complete_time;
                                        // $data5['app' . ($i * 2 - 1) . '_position']       = $session_data['jabnm'];
                                        // $data5['app' . ($i * 2 - 1) . '_status']         = '1';
                                        // $data5['app' . ($i * 2 - 1) . '_comp']           = $complete_comp;
                                        // $data5['app' . ($i * 2 - 1) . '_personalid']     = $session_data['personalid'];
                                        // $data5['app' . ($i * 2 - 1) . '_personalstatus'] = $session_data['personalstatus'];

                                        $alertmessage = "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                                        break;

                                        // komplit per shift
                                    case $_POST['btnproses'] == 'btncomplete_sf' . $i:
                                        // flag komplit per shift
                                        $data5['status_detail_sf' . $i]  = '1';
                                        $data5['status_detailx_sf' . $i] = '1';

                                        // sebagai approval kr
                                        $data5['app' . ($i * 1) . '_userid']         = $complete_userid;
                                        $data5['app' . ($i * 1) . '_by']             = $complete_by;
                                        $data5['app' . ($i * 1) . '_date']           = $complete_date;
                                        $data5['app' . ($i * 1) . '_time']           = $complete_time;
                                        $data5['app' . ($i * 1) . '_position']       = $session_data['jabnm'];
                                        $data5['app' . ($i * 1) . '_status']         = '1';
                                        $data5['app' . ($i * 1) . '_comp']           = $complete_comp;
                                        $data5['app' . ($i * 1) . '_personalid']     = $session_data['personalid'];
                                        $data5['app' . ($i * 1) . '_personalstatus'] = $session_data['personalstatus'];

                                        $alertmessage = "<script>alert('Data berhasil dikomplit....!!!! ');</script>";
                                        break;

                                    default:
                                        break;
                                }
                            }

                            $this->model->update_hdr($headerid, $data5);

                            if ($cekLevelUserNm == "Auditor") {
                                $stdtl = '0';
                            } else {
                                $stdtl = '1';
                            }

                            // detail
                            $jml = count($this->input->post('dtl_shift'));
                            for ($i = 0; $i < $jml; $i++) {

                                $data6 = array(
                                    'stdtl'    => $stdtl,

                                    'cek_shift_jam1' => $dtl_cek_shift_jam1[$i],
                                    'cek_shift_jam2' => $dtl_cek_shift_jam2[$i],
                                    'cek_shift_jam3' => $dtl_cek_shift_jam3[$i],
                                    'cek_shift_jam4' => $dtl_cek_shift_jam4[$i],
                                    'cek_shift_jam5' => $dtl_cek_shift_jam5[$i],
                                    'cek_shift_jam6' => $dtl_cek_shift_jam6[$i],
                                    'cek_shift_jam7' => $dtl_cek_shift_jam7[$i],
                                    'cek_shift_jam8' => $dtl_cek_shift_jam8[$i],

                                );

                                if ($shift_now == substr($dtl_shift[$i], -1)) {
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtlx($dtl_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl($dtl_detail_id[$i], $data6);
                                        $this->model->update_dtlx($dtl_detail_id[$i], $data6);
                                    }
                                }
                            }

                            // detail b
                            $jml2 = count($this->input->post('dtl_b_time_check'));
                            for ($i2 = 0; $i2 < $jml2; $i2++) {
                                $data6b = array(
                                    'stdtl'    => $stdtl,

                                    'time_check'        => $dtl_b_time_check[$i2],
                                    'ph_air'            => $dtl_b_ph_air[$i2],
                                    'ph_caustic'        => $dtl_b_ph_caustic[$i2],
                                    'temp_caustic'      => $dtl_b_temp_caustic[$i2],
                                    'ph_acid'           => $dtl_b_ph_acid[$i2],
                                    'temp_acid'         => $dtl_b_temp_acid[$i2],

                                );

                                if ($dtl_b_detail_id[$i2] != '') { // special case detail_id selalu deklar

                                    if ($shift_now == substr($dtl_b_shift[$i2], -1)) {        //cek shift
                                        if ($cekLevelUserNm == "Auditor") {
                                            $this->model->update_dtl_bx($dtl_b_detail_id[$i2], $data6b);
                                        } else {
                                            $this->model->update_dtl_b($dtl_b_detail_id[$i2], $data6b);
                                            $this->model->update_dtl_bx($dtl_b_detail_id[$i2], $data6b);
                                        }
                                    }
                                } else {
                                    // tambah parameter headerid dan shift untuk $data6b ketika insert
                                    $data6b = $data6b + array(
                                        'headerid' => $headerid,
                                        'shift' => $dtl_b_shift[$i2],
                                    );

                                    if ($shift_now == substr($dtl_b_shift[$i2], -1)) {
                                        $this->model->insert_detail_b($data6b);
                                    }
                                }
                            }

                            // detail c
                            $jml3 = count($this->input->post('dtl_c_ph'));
                            for ($i3 = 0; $i3 < $jml3; $i3++) {

                                $data6c = array(
                                    'stdtl'    => $stdtl,

                                    'time_check'       => $dtl_c_time_check[$i3],
                                    'ph'               => $dtl_c_ph[$i3],
                                    'residu_caustic'   => $dtl_c_residu_caustic[$i3],
                                    'residu_acid'      => $dtl_c_residu_acid[$i3],


                                );
                                if ($dtl_c_detail_id[$i3] != '') { // special case detail_id selalu deklar

                                    if ($shift_now == substr($dtl_c_shift[$i3], -1)) {        //cek shift
                                        if ($cekLevelUserNm == "Auditor") {
                                            $this->model->update_dtlcx($dtl_c_detail_id[$i3], $data6c);
                                        } else {
                                            $this->model->update_dtlc($dtl_c_detail_id[$i3], $data6c);
                                            $this->model->update_dtlcx($dtl_c_detail_id[$i3], $data6c);
                                        }
                                    }
                                } else {
                                    // tambah parameter headerid dan shift untuk $data6b ketika insert
                                    $data6c = $data6c + array(
                                        'headerid' => $headerid,
                                        'shift' => $dtl_c_shift[$i3],
                                    );

                                    if ($shift_now == substr($dtl_c_shift[$i3], -1)) {
                                        $this->model->insert_detail_c($data6c);
                                    }
                                }
                            }



                            // detail d
                            $jml4 = count($this->input->post('dtl_d_uraian'));
                            for ($i4 = 0; $i4 < $jml4; $i4++) {

                                if ($dtl_d_pj_id[$i4] != '') {
                                    $dt_pj_by              = $this->model->get_pj_by($dtl_d_pj_id[$i4]);
                                    $pj_personalstatus[$i4] = $dt_pj_by->personalstatus;
                                    $pj_personalid[$i4]     = $dt_pj_by->personalid;
                                    $pj_nik[$i4]            = $dt_pj_by->nik;
                                    $pj_nama[$i4]           = $dt_pj_by->nama;
                                } else {
                                    $pj_personalstatus[$i4] = null;
                                    $pj_personalid[$i4]     = null;
                                    $pj_nik[$i4]            = null;
                                    $pj_nama[$i4]           = null;
                                }

                                $data6d = array(
                                    'stdtl'    => $stdtl,

                                    'shift'             => $dtl_d_shift[$i4],
                                    'jam'               => $dtl_d_jam[$i4],
                                    'uraian'            => $dtl_d_uraian[$i4],
                                    'tindakan'          => $dtl_d_tindakan[$i4],
                                    'keterangan'        => $dtl_d_keterangan[$i4],

                                    'pj_id'             => $dtl_d_pj_id[$i4],
                                    'pj_personalstatus' => $pj_personalstatus[$i4],
                                    'pj_personalid'     => $pj_personalid[$i4],
                                    'pj_nik'            => $pj_nik[$i4],
                                    'pj_nama'           => $pj_nama[$i4],


                                );

                                if (isset($dtl_d_detail_id[$i4])) { // gak selalu deklar, baris baru gak ada input dtl_d_detail_id

                                    if ($shift_now == substr($dtl_d_shift[$i4], -1)) {        //cek shift
                                        if ($cekLevelUserNm == "Auditor") {
                                            $this->model->update_dtldx($dtl_d_detail_id[$i4], $data6d);
                                        } else {
                                            $this->model->update_dtld($dtl_d_detail_id[$i4], $data6d);
                                            $this->model->update_dtldx($dtl_d_detail_id[$i4], $data6d);
                                        }
                                    }
                                } else {
                                    // tambah parameter headerid dan shift untuk $data6d ketika insert
                                    $data6d = $data6d + array(
                                        'headerid' => $headerid,

                                        'shift' => $dtl_d_shift[$i4],
                                    );

                                    if ($shift_now == substr($dtl_d_shift[$i4], -1)) {
                                        $this->model->insert_detail_d($data6d);
                                    }
                                }
                            }
                        }

                        $this->model->insert_detail_bx($headerid);
                        $this->model->insert_detail_cx($headerid);
                        $this->model->insert_detail_dx($headerid);

                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
                } else if (isset($_POST['btndelete_dtlb'])) {
                    $data5 = array(
                        'complete_useridx' => $complete_userid,
                        'complete_byx'     => $complete_by,
                        'complete_datex'   => $complete_date,
                        'complete_timex'   => $complete_time,
                        'complete_compx'   => $complete_comp, // versi user audit
                    );

                    if ($cekLevelUserNm == 'Auditor') {
                        $cekdetail = $this->model->cek_stdetailx($headerid);
                    } else {
                        $cekdetail = $this->model->cek_stdetail($headerid);

                        $data5['complete_userid']  = $complete_userid;
                        $data5['complete_by']      = $complete_by;
                        $data5['complete_date']    = $complete_date;
                        $data5['complete_time']    = $complete_time;
                        $data5['complete_comp']    = $complete_comp; // versi user original
                    }

                    if ($cekdetail->num_rows() > 0) {
                        $alertmessage = "<script>alert('Maaf data tidak bisa dihapus karena sudah dikomplit!! ');</script>";
                    } else {
                        $this->model->update_hdr($headerid, $data5);
                        $alertmessage = "<script>alert('Data berhasil dihapus!! ');</script>";

                        $chk = $this->input->post('dtl_d_chk');
                        $jml = count($this->input->post('dtl_d_chk'));

                        for ($i = 0; $i < $jml; $i++) {
                            if ($shift_now == substr(explode(" ", $chk[$i])[0], -1)) {
                                if ($cekLevelUserNm == 'Auditor') {
                                    $data6_d = array(
                                        'stdtl'    => '0',
                                    );
                                    $this->model->update_dtldx(explode(" ", $chk[$i])[1], $data6_d);
                                } else {
                                    $this->model->delete_detail_d(explode(" ", $chk[$i])[1]);
                                    $this->model->delete_detail_dx(explode(" ", $chk[$i])[1]);
                                }
                                $alertmessage = "<script>alert('Data berhasil dihapus!! ');</script>";
                            } else {
                                $alertmessage = "<script>alert('Maaf, tidak dapat menghapus data shift lain! ');</script>";
                            }
                        }
                    }

                    echo $alertmessage;
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                }
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}
