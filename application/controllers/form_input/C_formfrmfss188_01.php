<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formfrmfss188_01 extends CI_Controller
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

            $last_docno   = !empty($dthasil->vdocno) ? $dthasil->vdocno + 1 : 1;

            $arr_bulan    = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            $docno        = 'LHP/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' . date("d", strtotime($create_date));

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

    function get_list_point()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $create_date    = date("Y-m-d", strtotime($this->input->post('create_date')));
            $tipe           = 'Tipe 1';
            $dept           = $this->input->post('dept');

            $dthasil = $this->model->get_list_item($tipe, $create_date, $dept);

            if (count($dthasil) > 0) {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => 'Berhasil mengambil data!',
                    'data'    => $dthasil,
                );
            } else {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'error',
                    'pesan'   => "Data belum tersedia!",
                );
            }

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_list_kode()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $detail_id      = $this->input->post('detail_id');

            $dthasil = $this->model->get_list_item2($detail_id);

            if (count($dthasil) > 0) {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => 'Berhasil mengambil data!',
                    'data'    => $dthasil,
                );
            } else {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'error',
                    'pesan'   => "Data belum tersedia!",
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
            $session_data            = $this->session->userdata('logged_in');
            $data['userid']          = $session_data['userid'];
            $data['username']        = $session_data['username'];
            $data['password']        = $session_data['password'];
            $data['jabid']           = $session_data['jabid'];
            $data['leveluserid']     = $session_data['leveluserid'];
            $data['nmdepan']         = $session_data['nmdepan'];
            $data['nmlengkap']       = $session_data['nmlengkap'];
            $data['levelusernm']     = $session_data['levelusernm'];
            $data['bagnm']           = $session_data['bagnm'];
            $data['bagian_akses']    = $session_data['bagian_akses'];
            $data['jabnm']           = $session_data['jabnm'];
            $data['personalid']      = $session_data['personalid'];
            $data['personalstatus']  = $session_data['personalstatus'];
            $data['Titel']           = 'MONITORING';

            $BagianAkses             = $session_data['bagian_akses'];
            $LevelUser               = $session_data['leveluserid'];
            $UserName                = $session_data['username'];
            $LevelUserNm             = $session_data['levelusernm'];

            $cekLevelUserNm          = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm']  = substr($LevelUserNm, 0, 7);

            $menus                   = $this->M_menu->menus($LevelUser);
            $data2                   = array('menus' => $menus);

            //ambil variabel URL
            $frmkode                 = $this->uri->segment(4);
            $frmvrs                  = $this->uri->segment(5);
            $frmaksi                 = $this->uri->segment(6);

            $dtfrm                   = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                   = array('dtfrm' => $dtfrm);

            foreach ($dtfrm as $dt_form) {
                $frmnm = $dt_form->formnm;
            }

            $data['dtdept']           = $this->model->get_records_payroll($BagianAkses);
            // data hedder
            $headerid                 = addslashes($this->input->post('headerid'));

            $complete_userid          = $session_data['userid'];
            $complete_date            = date('Y-m-d');
            $complete_time            = date('H:i:s');
            $complete_by              = $session_data['nmlengkap'];
            $complete_comp            = $this->session->userdata('hostname'); // versi user original

            $create_date              = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y
            $tgl                      = date("Y-m-d", strtotime(addslashes($this->input->post('tgl')))); // dari inputan d-m-Y
            $docno                    = addslashes($this->input->post('docno'));
            $minggu                   = addslashes($this->input->post('minggu'));
            $dept                     = addslashes($this->input->post('dept'));
            $deptabbr                 = addslashes($this->input->post('deptabbr'));

            //data detail
            $detail_id                = $this->input->post('detail_id');
            $dtl_a_point              = $this->input->post('dtl_a_point');
            $dtl_a_kode               = $this->input->post('dtl_a_kode');
            $dtl_a_area               = $this->input->post('dtl_a_area');
            $dtl_a_temuan             = $this->input->post('dtl_a_temuan');
            $dtl_a_tindakan_koreksi   = $this->input->post('dtl_a_tindakan_koreksi');
            $dtl_a_pj_id_dilakukan    = $this->input->post('dtl_a_pj_id_dilakukan');
            $dtl_a_pj_id_dicek        = $this->input->post('dtl_a_pj_id_dicek');
            $dtl_a_pj_id_verfikasi    = $this->input->post('dtl_a_pj_id_verfikasi');
            $dtl_a_gagal_lulus        = $this->input->post('dtl_a_gagal_lulus');

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno, $minggu, $dept);

                // cek kalau create date dan docno sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    // pesan gagal krn data sudah ada
                    $data['message']             = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ', No Dokumen : ' . $docno . ', Minggu : ' . $minggu . 'dan Dept : ' . $dept . ' sudah pernah disimpan';

                    $data['dtcreate_date']       = addslashes($this->input->post('create_date'));
                    $data['dtdocno']             = addslashes($this->input->post('docno'));
                    $data['dtminggu']            = addslashes($this->input->post('minggu'));
                    $data['dtdept']              = addslashes($this->input->post('dept'));
                    $data['dtdeptabbr']          = addslashes($this->input->post('deptabbr'));

                    $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
                } else {
                    $data5 = array(
                        'complete_userid'  => $complete_userid,
                        'complete_by'      => $complete_by,
                        'complete_date'    => $complete_date,
                        'complete_time'    => $complete_time,
                        'complete_comp'    => $complete_comp,  

                        'complete_useridx' => $complete_userid,
                        'complete_byx'     => $complete_by,
                        'complete_datex'   => $complete_date,
                        'complete_timex'   => $complete_time,
                        'complete_compx'   => $complete_comp, // versi user audit

                        'status_detail'    => '0',
                        'status_detailx'   => '0',

                        'create_date'      => $create_date,
                        'docno'            => $docno,
                        'minggu'           => $minggu,
                        'dept'             => $dept,
                        'deptabbr'         => $deptabbr,
                    );


                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    if ($cekLevelUserNm == "Auditor") {
                        $stdtl = '0';
                    } else {
                        $stdtl = '1';
                    }

                    // detail
                    $jml = count($this->input->post('dtl_a_point'));
                    for ($i = 0; $i < $jml; $i++) {

                        $arr_pj = array('dilakukan','dicek','verfikasi');
                        for ($i_pj=0; $i_pj < count($arr_pj); $i_pj++) { 
                            if (${'dtl_a_pj_id_'.$arr_pj[$i_pj]}[$i] != '') {
                                $dt_pj_by                        = $this->model->get_pj_by(${'dtl_a_pj_id_'.$arr_pj[$i_pj]}[$i]);
                                ${'pj_personalstatus_'.$arr_pj[$i_pj]}[$i] = $dt_pj_by->personalstatus;
                                ${'pj_personalid_'.$arr_pj[$i_pj]}[$i]     = $dt_pj_by->personalid;
                                ${'pj_nik_'.$arr_pj[$i_pj]}[$i]            = $dt_pj_by->nik;
                                ${'pj_nama_'.$arr_pj[$i_pj]}[$i]           = $dt_pj_by->nama;
                            } else {
                                ${'pj_personalstatus_'.$arr_pj[$i_pj]}[$i] = null;
                                ${'pj_personalid_'.$arr_pj[$i_pj]}[$i]     = null;
                                ${'pj_nik_'.$arr_pj[$i_pj]}[$i]            = null;
                                ${'pj_nama_'.$arr_pj[$i_pj]}[$i]           = null;
                            }
                        }

                        $data6 = array(
                            'headerid'                    => $max_hdr_id,
                            'stdtl'                       => $stdtl,

                            'point'                       => $dtl_a_point[$i],
                            'kode'                        => $dtl_a_kode[$i],
                            'area'                        => $dtl_a_area[$i],
                            'temuan'                      => $dtl_a_temuan[$i],
                            'tindakan_koreksi'            => $dtl_a_tindakan_koreksi[$i],
                            'pj_id_dilakukan'             => $dtl_a_pj_id_dilakukan[$i],
                            'pj_personalstatus_dilakukan' => $pj_personalstatus_dilakukan[$i],
                            'pj_personalid_dilakukan'     => $pj_personalid_dilakukan[$i],
                            'pj_nik_dilakukan'            => $pj_nik_dilakukan[$i],
                            'pj_nama_dilakukan'           => $pj_nama_dilakukan[$i],
                            'pj_id_dicek'                 => $dtl_a_pj_id_dicek[$i],
                            'pj_personalstatus_dicek'     => $pj_personalstatus_dicek[$i],
                            'pj_personalid_dicek'         => $pj_personalid_dicek[$i],
                            'pj_nik_dicek'                => $pj_nik_dicek[$i],
                            'pj_nama_dicek'               => $pj_nama_dicek[$i],
                            'pj_id_verfikasi'             => $dtl_a_pj_id_verfikasi[$i],
                            'pj_personalstatus_verfikasi' => $pj_personalstatus_verfikasi[$i],
                            'pj_personalid_verfikasi'     => $pj_personalid_verfikasi[$i],
                            'pj_nik_verfikasi'            => $pj_nik_verfikasi[$i],
                            'pj_nama_verfikasi'           => $pj_nama_verfikasi[$i],
                            'gagal_lulus'                 => $dtl_a_gagal_lulus[$i],

                        );
                        $this->model->insert_detail($data6);
                    }

                    $this->model->insert_detailx($max_hdr_id);

                    echo "<script>alert('Data berhasil disimpan!!');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $max_hdr_id, 'refresh');
                }
            } elseif ($frmaksi == 'dtopen') {
                $id          = $this->uri->segment(7);

                $dtheader    = $this->model->get_header_byid($id); // manggil data header
                $data7       = array('dtheader' => $dtheader);

                foreach ($dtheader as $dtheader_row) {
                    $create_date = $dtheader_row->create_date;
                    $dept = $dtheader_row->deptabbr;
                }
                $tipe = 'Tipe 1';

                $data['dt_list_point']    = $this->model->get_list_item($tipe, $create_date, $dept);
                $data['list_pj']          = $this->model->get_list_pj($create_date);

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail           = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail           = $this->model->get_detail_byid($id);
                }

                $data8  = array('dtdetail' => $dtdetail);
                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
            } else {

                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $headerid);

                    if ($cekheader->num_rows() > 0) {
                        echo "<script>alert('Gagal, Data pada tanggal Laporan : $create_date ,  dan No Dokumen : '.$docno.' sudah pernah disimpan');</script>";
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
                                            // 'docno'            => $docno,
                                        );
                                    }

                                    $alertmessage = "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                                    break;

                                case $_POST['btnproses'] == 'btncomplete':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data5 = array(
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp, // versi user audit

                                            // 'status_detailx'    => '1',

                                        );
                                    } else {
                                        $data5 = array(
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,     // versi user audit

                                            // 'app1_userid'         => $complete_userid,
                                            // 'app1_by'             => $complete_by,
                                            // 'app1_date'           => $complete_date,
                                            // 'app1_time'           => $complete_time,
                                            // 'app1_position'       => $session_data['jabnm'],
                                            // 'app1_personalid'     => $session_data['personalid'],
                                            // 'app1_personalstatus' => $session_data['personalstatus'],
                                            // 'app1_status'         => '1',
                                            // 'app1_comp'           => $complete_comp,     // versi user original

                                            'status_detail'    => '1',
                                            'status_detailx'   => '1',
                                        );
                                    }
                                    $alertmessage = "<script>alert('Data berhasil dikomplit....!!!! ');</script>";
                                    break;
                                default:
                                    break;
                            }


                            $this->model->update_hdr($headerid, $data5);

                            if ($cekLevelUserNm == "Auditor") {
                                $stdtl = '0';
                            } else {
                                $stdtl = '1';
                            }


                            //edit detail1
                            $jml = count($this->input->post('dtl_a_point'));
                            for ($i = 0; $i < $jml; $i++) {
                                
                                $arr_pj = array('dilakukan','dicek','verfikasi');
                                for ($i_pj=0; $i_pj < count($arr_pj); $i_pj++) { 
                                    if (${'dtl_a_pj_id_'.$arr_pj[$i_pj]}[$i] != '') {
                                        $dt_pj_by                        = $this->model->get_pj_by(${'dtl_a_pj_id_'.$arr_pj[$i_pj]}[$i]);
                                        ${'pj_personalstatus_'.$arr_pj[$i_pj]}[$i] = $dt_pj_by->personalstatus;
                                        ${'pj_personalid_'.$arr_pj[$i_pj]}[$i]     = $dt_pj_by->personalid;
                                        ${'pj_nik_'.$arr_pj[$i_pj]}[$i]            = $dt_pj_by->nik;
                                        ${'pj_nama_'.$arr_pj[$i_pj]}[$i]           = $dt_pj_by->nama;
                                    } else {
                                        ${'pj_personalstatus_'.$arr_pj[$i_pj]}[$i] = null;
                                        ${'pj_personalid_'.$arr_pj[$i_pj]}[$i]     = null;
                                        ${'pj_nik_'.$arr_pj[$i_pj]}[$i]            = null;
                                        ${'pj_nama_'.$arr_pj[$i_pj]}[$i]           = null;
                                    }
                                }
                                if (isset($detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'                   => $stdtl,

                                        'point'                       => $dtl_a_point[$i],
                                        'kode'                        => $dtl_a_kode[$i],
                                        'area'                        => $dtl_a_area[$i],
                                        'temuan'                      => $dtl_a_temuan[$i],
                                        'tindakan_koreksi'            => $dtl_a_tindakan_koreksi[$i],
                                        'pj_id_dilakukan'             => $dtl_a_pj_id_dilakukan[$i],
                                        'pj_personalstatus_dilakukan' => $pj_personalstatus_dilakukan[$i],
                                        'pj_personalid_dilakukan'     => $pj_personalid_dilakukan[$i],
                                        'pj_nik_dilakukan'            => $pj_nik_dilakukan[$i],
                                        'pj_nama_dilakukan'           => $pj_nama_dilakukan[$i],
                                        'pj_id_dicek'                 => $dtl_a_pj_id_dicek[$i],
                                        'pj_personalstatus_dicek'     => $pj_personalstatus_dicek[$i],
                                        'pj_personalid_dicek'         => $pj_personalid_dicek[$i],
                                        'pj_nik_dicek'                => $pj_nik_dicek[$i],
                                        'pj_nama_dicek'               => $pj_nama_dicek[$i],
                                        'pj_id_verfikasi'             => $dtl_a_pj_id_verfikasi[$i],
                                        'pj_personalstatus_verfikasi' => $pj_personalstatus_verfikasi[$i],
                                        'pj_personalid_verfikasi'     => $pj_personalid_verfikasi[$i],
                                        'pj_nik_verfikasi'            => $pj_nik_verfikasi[$i],
                                        'pj_nama_verfikasi'           => $pj_nama_verfikasi[$i],
                                        'gagal_lulus'                 => $dtl_a_gagal_lulus[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtlx($detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl($detail_id[$i], $data6);
                                        $this->model->update_dtlx($detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'                => $headerid,
                                        'stdtl'                   => $stdtl,

                                        'point'                       => $dtl_a_point[$i],
                                        'kode'                        => $dtl_a_kode[$i],
                                        'area'                        => $dtl_a_area[$i],
                                        'temuan'                      => $dtl_a_temuan[$i],
                                        'tindakan_koreksi'            => $dtl_a_tindakan_koreksi[$i],
                                        'pj_id_dilakukan'             => $dtl_a_pj_id_dilakukan[$i],
                                        'pj_personalstatus_dilakukan' => $pj_personalstatus_dilakukan[$i],
                                        'pj_personalid_dilakukan'     => $pj_personalid_dilakukan[$i],
                                        'pj_nik_dilakukan'            => $pj_nik_dilakukan[$i],
                                        'pj_nama_dilakukan'           => $pj_nama_dilakukan[$i],
                                        'pj_id_dicek'                 => $dtl_a_pj_id_dicek[$i],
                                        'pj_personalstatus_dicek'     => $pj_personalstatus_dicek[$i],
                                        'pj_personalid_dicek'         => $pj_personalid_dicek[$i],
                                        'pj_nik_dicek'                => $pj_nik_dicek[$i],
                                        'pj_nama_dicek'               => $pj_nama_dicek[$i],
                                        'pj_id_verfikasi'             => $dtl_a_pj_id_verfikasi[$i],
                                        'pj_personalstatus_verfikasi' => $pj_personalstatus_verfikasi[$i],
                                        'pj_personalid_verfikasi'     => $pj_personalid_verfikasi[$i],
                                        'pj_nik_verfikasi'            => $pj_nik_verfikasi[$i],
                                        'pj_nama_verfikasi'           => $pj_nama_verfikasi[$i],
                                        'gagal_lulus'                 => $dtl_a_gagal_lulus[$i],
                                    );

                                    $this->model->insert_detail($data6);
                                }
                            }

                            $this->model->insert_detailx($headerid);
                        }
                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
                } else if (isset($_POST['btndelete'])) {
                    if ($cekLevelUserNm == 'Auditor') {
                        $cekdetail = $this->model->cek_stdetailx($headerid);

                        $data5 = array(
                            'complete_useridx'  => $complete_userid,
                            'complete_byx'      => $complete_by,
                            'complete_datex'    => $complete_date,
                            'complete_timex'    => $complete_time,
                            'complete_compx'    => $complete_comp, // versi user audit
                        );
                    } else {
                        $cekdetail = $this->model->cek_stdetail($headerid);

                        $data5 = array(
                            'complete_userid'   => $complete_userid,
                            'complete_by'       => $complete_by,
                            'complete_date'     => $complete_date,
                            'complete_time'     => $complete_time,
                            'complete_comp'     => $complete_comp, // versi user original

                            'complete_useridx'  => $complete_userid,
                            'complete_byx'      => $complete_by,
                            'complete_datex'    => $complete_date,
                            'complete_timex'    => $complete_time,
                            'complete_compx'    => $complete_comp, // versi user audit

                        );
                    }

                    if ($cekdetail->num_rows() > 0) {
                        $alertmessage = "<script>alert('Maaf data tidak bisa dihapus karena sudah dikomplit!! ');</script>";
                    } else {
                        $this->model->update_hdr($headerid, $data5);
                        $alertmessage = "<script>alert('Data berhasil dihapus!! ');</script>";

                        $dlta_chk = $this->input->post('dlta_chk');
                        $jml = count($this->input->post('dlta_chk'));

                        if ($cekLevelUserNm == 'Auditor') {
                            for ($i = 0; $i < $jml; $i++) {
                                $this->model->update_stdtlx($dlta_chk[$i]);
                            }
                        } else {
                            for ($i = 0; $i < $jml; $i++) {
                                $this->model->delete_detail($dlta_chk[$i]);
                                $this->model->delete_detailx($dlta_chk[$i]);
                            }
                        }
                    }


                    echo $alertmessage;
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                } else {
                    echo "<script>alert('Tidak ada aksi atau hapus data tidak sesuai halaman shift!! ');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                }
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}
