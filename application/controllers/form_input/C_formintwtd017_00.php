<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_formintwtd017_00 extends CI_Controller
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

            $docno        = 'KAAP/' . date("Y", strtotime($create_date)) . '/WTD/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' . str_pad($last_docno, 3, '0', STR_PAD_LEFT);

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
            $dtl_detail_id         = $this->input->post('dtl_detail_id');
            $dtl_shift             = $this->input->post('dtl_shift');
            $dtl_sedimen_ph_6a     = $this->input->post('dtl_sedimen_ph_6a');
            $dtl_sedimen_ph_6b     = $this->input->post('dtl_sedimen_ph_6b');
            $dtl_sedimen_colour_6a = $this->input->post('dtl_sedimen_colour_6a');
            $dtl_sedimen_colour_6b = $this->input->post('dtl_sedimen_colour_6b');
            $dtl_sedimen_tds_6a    = $this->input->post('dtl_sedimen_tds_6a');
            $dtl_sedimen_tds_6b    = $this->input->post('dtl_sedimen_tds_6b');
            $dtl_cone_ph           = $this->input->post('dtl_cone_ph');
            $dtl_cone_colour       = $this->input->post('dtl_cone_colour');
            $dtl_cone_tds          = $this->input->post('dtl_cone_tds');
            for ($j = 1; $j <= 7; $j++) {
                ${'dtl_tsf_colour_sf' . $j} = $this->input->post('dtl_tsf_colour_sf' . $j);
                ${'dtl_tsf_turbidity_sf' . $j} = $this->input->post('dtl_tsf_turbidity_sf' . $j);
            }
            for ($j = 1; $j <= 6; $j++) {
                ${'dtl_tcf_colour_cf' . $j} = $this->input->post('dtl_tcf_colour_cf' . $j);
                ${'dtl_tcf_turbidity_cf' . $j} = $this->input->post('dtl_tcf_turbidity_cf' . $j);
            }
            for ($j = 1; $j <= 5; $j++) {
                ${'dtl_ts_th_st' . $j} = $this->input->post('dtl_ts_th_st' . $j);
            }
            $dtl_bak_demin_ph     = $this->input->post('dtl_bak_demin_ph');
            $dtl_bak_demin_colour = $this->input->post('dtl_bak_demin_colour');
            $dtl_bak_demin_tbd    = $this->input->post('dtl_bak_demin_tbd');
            $dtl_bak2_ph          = $this->input->post('dtl_bak2_ph');
            $dtl_bak2_colour      = $this->input->post('dtl_bak2_colour');
            $dtl_bak2_tbd         = $this->input->post('dtl_bak2_tbd');
            $dtl_bak3_ph          = $this->input->post('dtl_bak3_ph');
            $dtl_bak3_colour      = $this->input->post('dtl_bak3_colour');
            $dtl_bak3_tbd         = $this->input->post('dtl_bak3_tbd');
            $dtl_bak4_ph          = $this->input->post('dtl_bak4_ph');
            $dtl_bak4_colour      = $this->input->post('dtl_bak4_colour');
            $dtl_bak4_tbd         = $this->input->post('dtl_bak4_tbd');
            $dtl_jam              = $this->input->post('dtl_jam');

            // detail b
            $dtl_b_detail_id        = $this->input->post('dtl_b_detail_id');
            // $dtl_b_shift            = $this->input->post('dtl_b_shift');
            $dtl_b_jam              = $this->input->post('dtl_b_jam');
            $dtl_b_uraian           = $this->input->post('dtl_b_uraian');
            $dtl_b_tindakan         = $this->input->post('dtl_b_tindakan');
            $dtl_b_keterangan       = $this->input->post('dtl_b_keterangan');



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

                            'shift'                => $dtl_shift[$i],
                            'sedimen_ph_6a'        => $dtl_shift[$i] != '' ? $dtl_sedimen_ph_6a[$i] : null,
                            'sedimen_ph_6b'        => $dtl_shift[$i] != '' ? $dtl_sedimen_ph_6b[$i] : null,
                            'sedimen_colour_6a'    => $dtl_shift[$i] != '' ? $dtl_sedimen_colour_6a[$i] : null,
                            'sedimen_colour_6b'    => $dtl_shift[$i] != '' ? $dtl_sedimen_colour_6b[$i] : null,
                            'sedimen_tds_6a'       => $dtl_shift[$i] != '' ? $dtl_sedimen_tds_6a[$i] : null,      // untuk input awal nilai hanya utk shift 1 aja ya
                            'sedimen_tds_6b'       => $dtl_shift[$i] != '' ? $dtl_sedimen_tds_6b[$i] : null,
                            'cone_ph'              => $dtl_shift[$i] != '' ? $dtl_cone_ph[$i] : null,
                            'cone_colour'          => $dtl_shift[$i] != '' ? $dtl_cone_colour[$i] : null,
                            'cone_tds'             => $dtl_shift[$i] != '' ? $dtl_cone_tds[$i] : null,
                            'tsf_colour_sf1'       => $dtl_shift[$i] != '' ? $dtl_tsf_colour_sf1[$i] : null,
                            'tsf_colour_sf2'       => $dtl_shift[$i] != '' ? $dtl_tsf_colour_sf2[$i] : null,
                            'tsf_colour_sf3'       => $dtl_shift[$i] != '' ? $dtl_tsf_colour_sf3[$i] : null,
                            'tsf_colour_sf4'       => $dtl_shift[$i] != '' ? $dtl_tsf_colour_sf4[$i] : null,
                            'tsf_colour_sf5'       => $dtl_shift[$i] != '' ? $dtl_tsf_colour_sf5[$i] : null,
                            'tsf_colour_sf6'       => $dtl_shift[$i] != '' ? $dtl_tsf_colour_sf6[$i] : null,
                            'tsf_colour_sf7'       => $dtl_shift[$i] != '' ? $dtl_tsf_colour_sf7[$i] : null,
                            'tsf_turbidity_sf1'    => $dtl_shift[$i] != '' ? $dtl_tsf_turbidity_sf1[$i] : null,
                            'tsf_turbidity_sf2'    => $dtl_shift[$i] != '' ? $dtl_tsf_turbidity_sf2[$i] : null,
                            'tsf_turbidity_sf3'    => $dtl_shift[$i] != '' ? $dtl_tsf_turbidity_sf3[$i] : null,
                            'tsf_turbidity_sf4'    => $dtl_shift[$i] != '' ? $dtl_tsf_turbidity_sf4[$i] : null,
                            'tsf_turbidity_sf5'    => $dtl_shift[$i] != '' ? $dtl_tsf_turbidity_sf5[$i] : null,
                            'tsf_turbidity_sf6'    => $dtl_shift[$i] != '' ? $dtl_tsf_turbidity_sf6[$i] : null,
                            'tsf_turbidity_sf7'    => $dtl_shift[$i] != '' ? $dtl_tsf_turbidity_sf7[$i] : null,
                            'tcf_colour_cf1'       => $dtl_shift[$i] != '' ? $dtl_tcf_colour_cf1[$i] : null,
                            'tcf_colour_cf2'       => $dtl_shift[$i] != '' ? $dtl_tcf_colour_cf2[$i] : null,
                            'tcf_colour_cf3'       => $dtl_shift[$i] != '' ? $dtl_tcf_colour_cf3[$i] : null,
                            'tcf_colour_cf4'       => $dtl_shift[$i] != '' ? $dtl_tcf_colour_cf4[$i] : null,
                            'tcf_colour_cf5'       => $dtl_shift[$i] != '' ? $dtl_tcf_colour_cf5[$i] : null,
                            'tcf_colour_cf6'       => $dtl_shift[$i] != '' ? $dtl_tcf_colour_cf6[$i] : null,
                            'tcf_turbidity_cf1'    => $dtl_shift[$i] != '' ? $dtl_tcf_turbidity_cf1[$i] : null,
                            'tcf_turbidity_cf2'    => $dtl_shift[$i] != '' ? $dtl_tcf_turbidity_cf2[$i] : null,
                            'tcf_turbidity_cf3'    => $dtl_shift[$i] != '' ? $dtl_tcf_turbidity_cf3[$i] : null,
                            'tcf_turbidity_cf4'    => $dtl_shift[$i] != '' ? $dtl_tcf_turbidity_cf4[$i] : null,
                            'tcf_turbidity_cf5'    => $dtl_shift[$i] != '' ? $dtl_tcf_turbidity_cf5[$i] : null,
                            'tcf_turbidity_cf6'    => $dtl_shift[$i] != '' ? $dtl_tcf_turbidity_cf6[$i] : null,
                            'ts_th_st1'            => $dtl_shift[$i] != '' ? $dtl_ts_th_st1[$i] : null,
                            'ts_th_st2'            => $dtl_shift[$i] != '' ? $dtl_ts_th_st2[$i] : null,
                            'ts_th_st3'            => $dtl_shift[$i] != '' ? $dtl_ts_th_st3[$i] : null,
                            'ts_th_st4'            => $dtl_shift[$i] != '' ? $dtl_ts_th_st4[$i] : null,
                            'ts_th_st5'            => $dtl_shift[$i] != '' ? $dtl_ts_th_st5[$i] : null,
                            'bak_demin_ph'         => $dtl_shift[$i] != '' ? $dtl_bak_demin_ph[$i] : null,
                            'bak_demin_colour'     => $dtl_shift[$i] != '' ? $dtl_bak_demin_colour[$i] : null,
                            'bak_demin_tbd'        => $dtl_shift[$i] != '' ? $dtl_bak_demin_tbd[$i] : null,
                            'bak2_ph'              => $dtl_shift[$i] != '' ? $dtl_bak2_ph[$i] : null,
                            'bak2_colour '         => $dtl_shift[$i] != '' ? $dtl_bak2_colour[$i] : null,
                            'bak2_tbd'             => $dtl_shift[$i] != '' ? $dtl_bak2_tbd[$i] : null,
                            'bak3_ph'              => $dtl_shift[$i] != '' ? $dtl_bak3_ph[$i] : null,
                            'bak3_colour'          => $dtl_shift[$i] != '' ? $dtl_bak3_colour[$i] : null,
                            'bak3_tbd'             => $dtl_shift[$i] != '' ? $dtl_bak3_tbd[$i] : null,
                            'bak4_ph'              => $dtl_shift[$i] != '' ? $dtl_bak4_ph[$i] : null,
                            'bak4_colour'          => $dtl_shift[$i] != '' ? $dtl_bak4_colour[$i] : null,
                            'bak4_tbd'             => $dtl_shift[$i] != '' ? $dtl_bak4_tbd[$i] : null,
                            'jam'                  => $dtl_shift[$i] != '' ? $dtl_jam[$i] : null,

                        );
                        $this->model->insert_detail($data6);
                    }

                    //detail b
                    $jml4 = count($this->input->post('dtl_b_jam'));
                    for ($i4 = 0; $i4 < $jml4; $i4++) {

                        $data6b = array(
                            'headerid'          => $max_hdr_id,
                            'stdtl'             => $stdtl,

                            'jam'               => $dtl_shift[$i4] != '' ? $dtl_b_jam[$i4]          : null,
                            'uraian'            => $dtl_shift[$i4] != '' ? $dtl_b_uraian[$i4]     : null,
                            'tindakan'          => $dtl_shift[$i4] != '' ? $dtl_b_tindakan[$i4]     : null,
                            'keterangan'        => $dtl_shift[$i4] != '' ? $dtl_b_keterangan[$i4]     : null,


                        );

                        $this->model->insert_detail_b($data6b);
                    }

                    $this->model->insert_detailx($max_hdr_id);
                    $this->model->insert_detail_bx($max_hdr_id);

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


                // $data['list_pj'] = $this->model->get_list_pj($dtcreate_date);

                if ($cekLevelUserNm == "Auditor") {
                    $dtdetail       = $this->model->get_detail_byidx($id);
                    $dtdetail_b     = $this->model->get_detail_byid_bx($id);
                } else {
                    $dtdetail       = $this->model->get_detail_byid($id);
                    $dtdetail_b     = $this->model->get_detail_byid_b($id);
                }

                $data8  = array('dtdetail' => $dtdetail, 'dtdetail_b' => $dtdetail_b);

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

                                    'sedimen_ph_6a'     => $dtl_sedimen_ph_6a[$i],
                                    'sedimen_ph_6b'     => $dtl_sedimen_ph_6b[$i],
                                    'sedimen_colour_6a' => $dtl_sedimen_colour_6a[$i],
                                    'sedimen_colour_6b' => $dtl_sedimen_colour_6b[$i],
                                    'sedimen_tds_6a'    => $dtl_sedimen_tds_6a[$i],
                                    'sedimen_tds_6b'    => $dtl_sedimen_tds_6b[$i],
                                    'cone_ph'           => $dtl_cone_ph[$i],
                                    'cone_colour'       => $dtl_cone_colour[$i],
                                    'cone_tds'          => $dtl_cone_tds[$i],
                                    'tsf_colour_sf1'    => $dtl_tsf_colour_sf1[$i],
                                    'tsf_colour_sf2'    => $dtl_tsf_colour_sf2[$i],
                                    'tsf_colour_sf3'    => $dtl_tsf_colour_sf3[$i],
                                    'tsf_colour_sf4'    => $dtl_tsf_colour_sf4[$i],
                                    'tsf_colour_sf5'    => $dtl_tsf_colour_sf5[$i],
                                    'tsf_colour_sf6'    => $dtl_tsf_colour_sf6[$i],
                                    'tsf_colour_sf7'    => $dtl_tsf_colour_sf7[$i],
                                    'tsf_turbidity_sf1' => $dtl_tsf_turbidity_sf1[$i],
                                    'tsf_turbidity_sf2' => $dtl_tsf_turbidity_sf2[$i],
                                    'tsf_turbidity_sf3' => $dtl_tsf_turbidity_sf3[$i],
                                    'tsf_turbidity_sf4' => $dtl_tsf_turbidity_sf4[$i],
                                    'tsf_turbidity_sf5' => $dtl_tsf_turbidity_sf5[$i],
                                    'tsf_turbidity_sf6' => $dtl_tsf_turbidity_sf6[$i],
                                    'tsf_turbidity_sf7' => $dtl_tsf_turbidity_sf7[$i],
                                    'tcf_colour_cf1'    => $dtl_tcf_colour_cf1[$i],
                                    'tcf_colour_cf2'    => $dtl_tcf_colour_cf2[$i],
                                    'tcf_colour_cf3'    => $dtl_tcf_colour_cf3[$i],
                                    'tcf_colour_cf4'    => $dtl_tcf_colour_cf4[$i],
                                    'tcf_colour_cf5'    => $dtl_tcf_colour_cf5[$i],
                                    'tcf_colour_cf6'    => $dtl_tcf_colour_cf6[$i],
                                    'tcf_turbidity_cf1' => $dtl_tcf_turbidity_cf1[$i],
                                    'tcf_turbidity_cf2' => $dtl_tcf_turbidity_cf2[$i],
                                    'tcf_turbidity_cf3' => $dtl_tcf_turbidity_cf3[$i],
                                    'tcf_turbidity_cf4' => $dtl_tcf_turbidity_cf4[$i],
                                    'tcf_turbidity_cf5' => $dtl_tcf_turbidity_cf5[$i],
                                    'tcf_turbidity_cf6' => $dtl_tcf_turbidity_cf6[$i],
                                    'ts_th_st1'         => $dtl_ts_th_st1[$i],
                                    'ts_th_st2'         => $dtl_ts_th_st2[$i],
                                    'ts_th_st3'         => $dtl_ts_th_st3[$i],
                                    'ts_th_st4'         => $dtl_ts_th_st4[$i],
                                    'ts_th_st5'         => $dtl_ts_th_st5[$i],
                                    'bak_demin_ph'      => $dtl_bak_demin_ph[$i],
                                    'bak_demin_colour'  => $dtl_bak_demin_colour[$i],
                                    'bak_demin_tbd'     => $dtl_bak_demin_tbd[$i],
                                    'bak2_ph'           => $dtl_bak2_ph[$i],
                                    'bak2_colour '      => $dtl_bak2_colour[$i],
                                    'bak2_tbd'          => $dtl_bak2_tbd[$i],
                                    'bak3_ph'           => $dtl_bak3_ph[$i],
                                    'bak3_colour'       => $dtl_bak3_colour[$i],
                                    'bak3_tbd'          => $dtl_bak3_tbd[$i],
                                    'bak4_ph'           => $dtl_bak4_ph[$i],
                                    'bak4_colour'       => $dtl_bak4_colour[$i],
                                    'bak4_tbd'          => $dtl_bak4_tbd[$i],
                                    'jam'               => $dtl_jam[$i],

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
                        }

                        // detail d
                        $jml4 = count($this->input->post('dtl_b_uraian'));
                        for ($i4 = 0; $i4 < $jml4; $i4++) {

                            $data6d = array(
                                'stdtl'             => $stdtl,

                                // 'shift'             => $dtl_b_shift[$i4],
                                'jam'               => $dtl_b_jam[$i4],
                                'uraian'            => $dtl_b_uraian[$i4],
                                'tindakan'          => $dtl_b_tindakan[$i4],
                                'keterangan'        => $dtl_b_keterangan[$i4],


                            );

                            if (isset($dtl_b_detail_id[$i4])) { // gak selalu deklar, baris baru gak ada input dtl_b_detail_id

                                // if ($shift_now == substr($dtl_shift[$i4], -1)) {        //cek shift
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtl_bx($dtl_b_detail_id[$i4], $data6d);
                                    } else {
                                        $this->model->update_dtl_b($dtl_b_detail_id[$i4], $data6d);
                                        $this->model->update_dtl_bx($dtl_b_detail_id[$i4], $data6d);
                                    }
                                // }
                            } else {
                                // tambah parameter headerid dan shift untuk $data6d ketika insert
                                $data6d = $data6d + array(
                                    'headerid' => $headerid,

                                    // 'shift' => $dtl_b_shift[$i4],
                                );

                                if ($shift_now == substr($dtl_shift[$i4], -1)) {
                                    $this->model->insert_detail_b($data6d);
                                }
                            }
                        }



                        $this->model->insert_detail_bx($headerid);

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
