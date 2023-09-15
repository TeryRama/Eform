<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formintwtd032_00 extends CI_Controller
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
            echo "<script>alert('Anda tidak memiliki akses untuk data ini!');
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
            $dthasil      = $this->model->get_docno(date("m", strtotime($create_date)), date("Y", strtotime($create_date)));
            $last_docno   = !empty($dthasil->vdocno) ? $dthasil->vdocno + 1 : 1;
            $date_day     = date("d", strtotime($create_date));
            $arr_bulan    = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
            $docno        = 'OHT/WTD/' . date("Y", strtotime($create_date)) . '/' .  $arr_bulan[(float)date("m", strtotime($create_date))];
            $hasil = array(
                'status'  => (bool)1,
                'vstatus' => 'success',
                'pesan'   => "berhasil!",
                'data'    => $docno,
            );
            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    // function get_docno()
    // {
    //     if ($this->session->userdata('logged_in')) {
    //         $session_data = $this->session->userdata('logged_in');
    //         $create_date  = $this->input->post('create_date');

    //         $dthasil  = $this->model->get_docno(date("m", strtotime($create_date)), date("Y", strtotime($create_date)));

    //         $last_docno = !empty($dthasil) ? $dthasil->vdocno + 1 : 1;

    //         $arr_bulan = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

    //         $docno = 'LHP/WTD/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' . str_pad($last_docno, 3, '0', STR_PAD_LEFT);

    //         $hasil = array(
    //             'status'  => (bool)1,
    //             'vstatus' => 'success',
    //             'pesan'   => "berhasil!",
    //             'data'    => $docno,
    //         );

    //         echo json_encode($hasil);
    //     } else {
    //         //Jika tidak ada session di kembalikan ke halaman login
    //         redirect('C_login', 'refresh');
    //     }
    // }


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

            $LevelUser   = $session_data['leveluserid'];
            $UserName    = $session_data['username'];
            $LevelUserNm = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
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
            $headerid         = addslashes($this->input->post('headerid'));
            $complete_userid  = $session_data['userid'];
            $complete_date    = date('Y-m-d');
            $complete_time    = date('H:i:s');
            $complete_by      = $session_data['nmlengkap'];
            $complete_comp    = $this->session->userdata('hostname');
            $create_date      = date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));  // versi user original dari inputan d-m-Y
            $docno            = addslashes($this->input->post('docno'));
            $equipment_name   = addslashes($this->input->post('equipment_name'));
            $equipment_code   = addslashes($this->input->post('equipment_code'));
            $running_test     = date("Y-m-d", strtotime(addslashes($this->input->post('running_test'))));
            $operational_date = date("Y-m-d", strtotime(addslashes($this->input->post('operational_date'))));

            $dta_id                = $this->input->post('dta_id');
            $dta_problem_condition = $this->input->post('dta_problem_condition');
            $dta_problem_solving   = $this->input->post('dta_problem_solving');
            $dta_start             = $this->input->post('dta_start');
            $dta_finish            = $this->input->post('dta_finish');
            $dta_usage_material    = $this->input->post('dta_usage_material');
            $dta_total             = $this->input->post('dta_total');
            $dta_remark            = $this->input->post('dta_remark');

            $data['dta_count'] = count($this->input->post('dta_problem_condition'));

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno);
                // cek kalau create date dan nama bulan sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    $data['message'] = 'Gagal, Data pada Tanggal : ' . $create_date . ' dan Dokumen : ' . $docno . ', sudah pernah disimpan!';
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
                        'equipment_name'   => $equipment_name,
                        'equipment_code'   => $equipment_code,
                        'running_test'     => $running_test,
                        'operational_date' => $operational_date
                    );
                    $this->model->insert_hdr($data4);
                    $max_hdr_id = $this->db1->insert_id();

                    $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                    $dta_count = count($this->input->post('dta_problem_condition'));
                    for ($i = 0; $i < $dta_count; $i++) {
                        $data5 = array(
                            'headerid'              => $max_hdr_id,
                            'stdtl'                 => $stdtl,
                            'dta_problem_condition' => $dta_problem_condition[$i],
                            'dta_problem_solving'   => $dta_problem_solving[$i],
                            'dta_start'             => $dta_start[$i],
                            'dta_finish'            => $dta_finish[$i],
                            'dta_usage_material'    => $dta_usage_material[$i],
                            'dta_total'             => $dta_total[$i],
                            'dta_remark'            => $dta_remark[$i]
                        );
                        $this->model->insert_dtl($data5);
                    }
                    $this->model->insert_dtlx($max_hdr_id);

                    echo "<script>alert('Data berhasil disimpan!');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $max_hdr_id, 'refresh');
                }
            } elseif ($frmaksi == 'dtopen') {
                $id               = $this->uri->segment(7);
                $data['dtheader'] = $this->model->get_header_byid($id);
                if ($cekLevelUserNm == 'Auditor') {
                    $data['dtdetail'] = $this->model->get_detail_byidx($id);
                } else {
                    $data['dtdetail'] = $this->model->get_detail_byid($id);
                }
                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
            } else {
                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $headerid);
                    if ($cekheader->num_rows() > 0) {
                        echo "<script>alert('Gagal, Data pada Tanggal : $create_date ,  dan Dokumen : '.$docno.' sudah pernah disimpan!');</script>";
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    } else {
                        if ($cekLevelUserNm == 'Auditor') {
                            $cekdetail = $this->model->cek_stdtlx($headerid);
                        } else {
                            $cekdetail = $this->model->cek_stdtl($headerid);
                        }
                        if ($cekdetail->num_rows() > 0) {
                            $alertmessage = "<script>alert('Gagal, Data sudah dikomplit!');</script>";
                        } else {
                            switch ($_POST['btnproses']) {
                                case $_POST['btnproses'] == 'btnupdate':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data4 = array(
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp
                                        );
                                    } else {
                                        $data4 = array(
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,
                                            'complete_userid'  => $complete_userid,
                                            'complete_by'      => $complete_by,
                                            'complete_date'    => $complete_date,
                                            'complete_time'    => $complete_time,
                                            'complete_comp'    => $complete_comp,
                                            'create_date'      => $create_date,
                                            'docno'            => $docno,
                                            'equipment_name'   => $equipment_name,
                                            'equipment_code'   => $equipment_code,
                                            'running_test'     => $running_test,
                                            'operational_date' => $operational_date
                                        );
                                    }
                                    $alertmessage = "<script>alert('Data berhasil disimpan!');</script>";
                                    break;

                                case $_POST['btnproses'] == 'btncomplete':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data4 = array(
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp
                                        );
                                    } else {
                                        $data4 = array(
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,
                                            'status_detail'    => '1',
                                            'status_detailx'   => '1',
                                            'create_date'      => $create_date,
                                            'docno'            => $docno,
                                            'equipment_name'   => $equipment_name,
                                            'equipment_code'   => $equipment_code,
                                            'running_test'     => $running_test,
                                            'operational_date' => $operational_date
                                        );
                                    }
                                    $alertmessage = "<script>alert('Data berhasil dikomplit!');</script>";
                                    break;
                                default:
                                    break;
                            }
                            $this->model->update_hdr($headerid, $data4);

                            $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                            $dta_count = count($this->input->post('dta_problem_condition'));
                            for ($i = 0; $i < $dta_count; $i++) {
                                if (isset($dta_id[$i])) {
                                    $data5 = array(
                                        'stdtl'                 => $stdtl,
                                        'dta_problem_condition' => $dta_problem_condition[$i],
                                        'dta_problem_solving'   => $dta_problem_solving[$i],
                                        'dta_start'             => $dta_start[$i],
                                        'dta_finish'            => $dta_finish[$i],
                                        'dta_usage_material'    => $dta_usage_material[$i],
                                        'dta_total'             => $dta_total[$i],
                                        'dta_remark'            => $dta_remark[$i]
                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtlx($dta_id[$i], $data5);
                                    } else {
                                        $this->model->update_dtl($dta_id[$i], $data5);
                                        $this->model->update_dtlx($dta_id[$i], $data5);
                                    }
                                } else {
                                    $data5 = array(
                                        'headerid'              => $headerid,
                                        'stdtl'                 => $stdtl,
                                        'dta_problem_condition' => $dta_problem_condition[$i],
                                        'dta_problem_solving'   => $dta_problem_solving[$i],
                                        'dta_start'             => $dta_start[$i],
                                        'dta_finish'            => $dta_finish[$i],
                                        'dta_usage_material'    => $dta_usage_material[$i],
                                        'dta_total'             => $dta_total[$i],
                                        'dta_remark'            => $dta_remark[$i]
                                    );
                                    $this->model->insert_dtl($data5);
                                }
                            }
                            $this->model->insert_dtlx($headerid);
                        }
                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
                } elseif (isset($_POST['dta_btndelete'])) {
                    if ($cekLevelUserNm == "Auditor") {
                        $cekdetail = $this->model->cek_stdtlx($headerid);
                    } else {
                        $cekdetail = $this->model->cek_stdtl($headerid);
                    }
                    if ($cekdetail->num_rows() > 0) {
                        $alertmessage = "<script>alert('Maaf data tidak bisa dihapus karena sudah dikomplit!');</script>";
                    } else {
                        $data4 =
                            array(
                                'complete_userid'  => $complete_userid,
                                'complete_by'      => $complete_by,
                                'complete_date'    => $complete_date,
                                'complete_time'    => $complete_time,
                                'complete_comp'    => $complete_comp,
                                'complete_useridx' => $complete_userid,
                                'complete_byx'     => $complete_by,
                                'complete_datex'   => $complete_date,
                                'complete_timex'   => $complete_time,
                                'complete_compx'   => $complete_comp
                            );
                        $this->model->update_hdr($headerid, $data4);

                        $chk    = $this->input->post('dta_chk');
                        $jmlchk = count($this->input->post('dta_chk'));
                        if ($jmlchk != 0) {
                            for ($i = 0; $i < $jmlchk; $i++) {
                                $detail_id = $chk[$i];
                                if ($cekLevelUserNm == "Auditor") {
                                    $this->model->update_stdtlx($detail_id);
                                } else {
                                    $this->model->delete_dtl($detail_id);
                                    $this->model->delete_dtlx($detail_id);
                                }
                            }
                            $alertmessage = "<script>alert('Data berhasil dihapus!');</script>";
                        } else {
                            $alertmessage = "<script>alert('Data belum dipilih!');</script>";
                        }
                    }
                    echo $alertmessage;
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
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
