<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formintwtd023_00 extends CI_Controller
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

            $docno        = 'LH/WTD/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' .  date("d", strtotime($create_date));

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

    function get_forminput()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data           = $this->session->userdata('logged_in');
            $bulantahun             = $this->input->post('bulantahun');
            $date_today            = date("Y-m", strtotime('01-' . $this->input->post('date_today')));
            $date_before            = date("Y-m", strtotime('01-' . $this->input->post('date_before')));
            $create_date            = date("Y-m-d", strtotime($this->input->post('create_date')));

            $result_frmfss317       = $this->model->get_frmfss317_a($bulantahun, $create_date, $date_today, $date_before);

            if (!empty($result_frmfss317)) {
                $pesan = "Berhasil mengambil data!";
                $pesan .= !empty($result_frmfss317) ? "\n FRM-FSS-317 ✔" : "\n FRM-FSS-317 ✘";

                $result = [
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => $pesan,
                    'data'    => [
                        'result_frmfss317' => $result_frmfss317
                    ],
                ];
            } else {
                $result = [
                    'status'  => 1,
                    'vstatus' => 'error',
                    'pesan'   => "Gagal, data belum tersedia!",
                ];
            }

            echo json_encode($result);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function form()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data                       = $this->session->userdata('logged_in');
            $data['userid']                     = $session_data['userid'];
            $data['username']                   = $session_data['username'];
            $data['password']                   = $session_data['password'];
            $data['jabid']                      = $session_data['jabid'];
            $data['leveluserid']                = $session_data['leveluserid'];
            $data['nmdepan']                    = $session_data['nmdepan'];
            $data['nmlengkap']                  = $session_data['nmlengkap'];
            $data['levelusernm']                = $session_data['levelusernm'];
            $data['bagnm']                      = $session_data['bagnm'];
            $data['bagian_akses']               = $session_data['bagian_akses'];
            $data['jabnm']                      = $session_data['jabnm'];
            $data['personalid']                 = $session_data['personalid'];
            $data['personalstatus']             = $session_data['personalstatus'];
            $data['Titel']                      = 'MONITORING';

            $LevelUser                          = $session_data['leveluserid'];
            $UserName                           = $session_data['username'];
            $LevelUserNm                        = $session_data['levelusernm'];

            $cekLevelUserNm                     = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm']             = substr($LevelUserNm, 0, 7);

            $menus                              = $this->M_menu->menus($LevelUser);
            $data2                              = array('menus' => $menus);

            //ambil variabel URL
            $frmkode                            = $this->uri->segment(4);
            $frmvrs                             = $this->uri->segment(5);
            $frmaksi                            = $this->uri->segment(6);

            $dtfrm                              = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                              = array('dtfrm' => $dtfrm);

            $frmnm                              = $dtfrm[0]->formnm;

            // data hedder
            $headerid                           = addslashes($this->input->post('headerid'));

            $complete_userid                    = $session_data['userid'];
            $complete_date                      = date('Y-m-d');
            $complete_time                      = date('H:i:s');
            $complete_by                        = $session_data['nmlengkap'];
            $complete_comp                      = $this->session->userdata('hostname');  // versi user original

            $create_date                        = date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));  // dari inputan d-m-Y
            $docno                              = addslashes($this->input->post('docno'));
            $date_before                        = date("Y-m", strtotime(addslashes('01-' . $this->input->post('date_before'))));
            $date_today                         = date("Y-m", strtotime(addslashes('01-' . $this->input->post('date_today'))));
            $date_next                          = date("Y-m", strtotime(addslashes('01-' . $this->input->post('date_next'))));

            $dtsampel_frmfss317_headerid        = addslashes($this->input->post('dtsampel_frmfss317_headerid'));
            $dtsampel_frmfss317_complete_date   = addslashes($this->input->post('dtsampel_frmfss317_complete_date'));
            $dtsampel_frmfss317_complete_time   = addslashes($this->input->post('dtsampel_frmfss317_complete_time'));

            // dtl a
            $dtl_a_detail_id                    = $this->input->post('dtl_a_detail_id');
            $dtl_a_definisi_1                   = $this->input->post('dtl_a_definisi_1');
            $dtl_a_definisi_2                   = $this->input->post('dtl_a_definisi_2');
            $dtl_a_definisi_3                   = $this->input->post('dtl_a_definisi_3');
            $dtl_a_realisai_before              = $this->input->post('dtl_a_realisai_before');
            $dtl_a_realisai_persen_before       = $this->input->post('dtl_a_realisai_persen_before');
            $dtl_a_target_today                 = $this->input->post('dtl_a_target_today');
            $dtl_a_target_persen_today          = $this->input->post('dtl_a_target_persen_today');
            $dtl_a_realisai_today               = $this->input->post('dtl_a_realisai_today');
            $dtl_a_realisai_persen_today        = $this->input->post('dtl_a_realisai_persen_today');
            $dtl_a_target_next                  = $this->input->post('dtl_a_target_next');
            $dtl_a_target_persen_next           = $this->input->post('dtl_a_target_persen_next');

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno);

                // cek kalau create date dan docno sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    // pesan gagal krn data sudah ada
                    $data['message']             = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ' dan No Dokumen : ' . $docno . ' sudah pernah disimpan';

                    $data['dtcreate_date']       = addslashes($this->input->post('create_date'));
                    $data['dtdocno']             = addslashes($this->input->post('docno'));

                    $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
                } else {
                    $data5 = array(
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

                        'status_detail'  => '0',
                        'status_detailx' => '0',

                        'create_date' => $create_date,
                        'docno'       => $docno,
                        'date_before' => $date_before,
                        'date_today'  => $date_today,
                        'date_next'   => $date_next,

                        'dtsampel_frmfss317_headerid'      => !empty($dtsampel_frmfss317_headerid) ? $dtsampel_frmfss317_headerid : null,
                        'dtsampel_frmfss317_complete_date' => !empty($dtsampel_frmfss317_complete_date) ? $dtsampel_frmfss317_complete_date : null,
                        'dtsampel_frmfss317_complete_time' => !empty($dtsampel_frmfss317_complete_time) ? $dtsampel_frmfss317_complete_time : null,
                    );


                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                    // dtl a
                    $jml = count($this->input->post('dtl_a_definisi_1'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid' => $max_hdr_id,
                            'stdtl'    => $stdtl,

                            'dtl_a_definisi_1'                => $dtl_a_definisi_1[$i],
                            'dtl_a_definisi_2'                => $dtl_a_definisi_2[$i],
                            'dtl_a_definisi_3'                => $dtl_a_definisi_3[$i],
                            'dtl_a_realisai_before'           => $dtl_a_realisai_before[$i],
                            'dtl_a_realisai_persen_before'    => $dtl_a_realisai_persen_before[$i],
                            'dtl_a_target_today'              => $dtl_a_target_today[$i],
                            'dtl_a_target_persen_today'       => $dtl_a_target_persen_today[$i],
                            'dtl_a_realisai_today'            => $dtl_a_realisai_today[$i],
                            'dtl_a_realisai_persen_today'     => $dtl_a_realisai_persen_today[$i],
                            'dtl_a_target_next'               => $dtl_a_target_next[$i],
                            'dtl_a_target_persen_next'        => $dtl_a_target_persen_next[$i],
                        );
                        $this->model->insert_detail($data6);
                    }

                    $this->model->insert_detailx($max_hdr_id);

                    echo "<script>alert('Data berhasil disimpan!!');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $max_hdr_id, 'refresh');
                }
            } elseif ($frmaksi == 'dtopen') {
                $id = $this->uri->segment(7);

                $data['dtheader'] = $this->model->get_header_byid($id);

                if ($cekLevelUserNm == 'Auditor') {
                    $data['dtdetail']         = $this->model->get_detail_byidx($id);
                } else {
                    $data['dtdetail']         = $this->model->get_detail_byid($id);
                }

                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
            } else {

                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check($create_date, $docno, $headerid);

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
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,
                                        );
                                    } else {
                                        $data5 = array(
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,

                                            // versi user original
                                            'complete_userid'  => $complete_userid,
                                            'complete_by'      => $complete_by,
                                            'complete_date'    => $complete_date,
                                            'complete_time'    => $complete_time,
                                            'complete_comp'    => $complete_comp,
                                            'docno'            => $docno,
                                            'date_before' => $date_before,
                                            'date_today'  => $date_today,
                                            'date_next'   => $date_next,
                                        );
                                    }

                                    $alertmessage = "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                                    break;

                                case $_POST['btnproses'] == 'btncomplete':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data5 = array(
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,

                                            'status_detailx'   => '1',

                                        );
                                    } else {
                                        $data5 = array(
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,

                                            // versi user original
                                            'app1_userid'         => $complete_userid,
                                            'app1_by'             => $complete_by,
                                            'app1_date'           => $complete_date,
                                            'app1_time'           => $complete_time,
                                            'app1_position'       => $session_data['jabnm'],
                                            'app1_personalid'     => $session_data['personalid'],
                                            'app1_personalstatus' => $session_data['personalstatus'],
                                            'app1_status'         => '1',
                                            'app1_comp'           => $complete_comp,     // versi user original

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

                            $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                            ///
                            /// update detail belum fix
                            /// jadi rencananya hanya yg table atau field bisa di edit aja yg operasi_nilai update data
                            /// sisanya insert ulang aja (hapus dulu data sebelumnya)
                            /// ersyad 20220718
                            ///

                            //edit detail a
                            $jml = count($this->input->post('dtl_a_definisi_1'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($dtl_a_detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'           => $stdtl,
                                        'dtl_a_definisi_1'                => $dtl_a_definisi_1[$i],
                                        'dtl_a_definisi_2'                => $dtl_a_definisi_2[$i],
                                        'dtl_a_definisi_3'                => $dtl_a_definisi_3[$i],
                                        'dtl_a_realisai_before'           => $dtl_a_realisai_before[$i],
                                        'dtl_a_realisai_persen_before'    => $dtl_a_realisai_persen_before[$i],
                                        'dtl_a_target_today'              => $dtl_a_target_today[$i],
                                        'dtl_a_target_persen_today'       => $dtl_a_target_persen_today[$i],
                                        'dtl_a_realisai_today'            => $dtl_a_realisai_today[$i],
                                        'dtl_a_realisai_persen_today'     => $dtl_a_realisai_persen_today[$i],
                                        'dtl_a_target_next'               => $dtl_a_target_next[$i],
                                        'dtl_a_target_persen_next'        => $dtl_a_target_persen_next[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl($dtl_a_detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl($dtl_a_detail_id[$i], $data6);
                                        $this->model->update_dtl($dtl_a_detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'        => $headerid,
                                        'stdtl'           => $stdtl,
                                        'dtl_a_definisi_1'                => $dtl_a_definisi_1[$i],
                                        'dtl_a_definisi_2'                => $dtl_a_definisi_2[$i],
                                        'dtl_a_definisi_3'                => $dtl_a_definisi_3[$i],
                                        'dtl_a_realisai_before'           => $dtl_a_realisai_before[$i],
                                        'dtl_a_realisai_persen_before'    => $dtl_a_realisai_persen_before[$i],
                                        'dtl_a_target_today'              => $dtl_a_target_today[$i],
                                        'dtl_a_target_persen_today'       => $dtl_a_target_persen_today[$i],
                                        'dtl_a_realisai_today'            => $dtl_a_realisai_today[$i],
                                        'dtl_a_realisai_persen_today'     => $dtl_a_realisai_persen_today[$i],
                                        'dtl_a_target_next'               => $dtl_a_target_next[$i],
                                        'dtl_a_target_persen_next'        => $dtl_a_target_persen_next[$i],
                                    );

                                    $this->model->insert_detail($data6);
                                }
                            }

                            $this->model->insert_detailx($headerid);
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
