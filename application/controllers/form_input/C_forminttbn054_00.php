<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_forminttbn054_00 extends CI_Controller
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
            echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini !');
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

            $docno = 'LBB/PWP-TBN/' . date("Y", strtotime($create_date)) . '/' .  str_pad($date_day, 3, '0', STR_PAD_LEFT);

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil",
                'data'    => $docno
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_bulan()
    {
        if ($this->session->userdata('logged_in')) {
            $create_date  = $this->input->post('create_date');
            $bulan = $this->model->get_tanggal_indo(date('-m-', strtotime($create_date)));
            $trimbulan = trim($bulan, ' ');

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil",
                'data'    => $trimbulan
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_tahun()
    {
        if ($this->session->userdata('logged_in')) {
            $create_date  = $this->input->post('create_date');
            $sub_tahun = substr($create_date, -4);

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil",
                'data'    => $sub_tahun
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_tanggal_bahan_bakar()
    {
        if ($this->session->userdata('logged_in')) {
            $create_date  = date("Y-m-d", strtotime($this->input->post('create_date')));
            $bulan        = date('m', strtotime($create_date));
            $tahun        = date('Y', strtotime($create_date));

            $tanggal_bahan_bakar = $this->model->get_tanggal_bahan_bakar($bulan, $tahun);

            if (!empty($tanggal_bahan_bakar)) {
                $pesan = "Berhasil Memuat Data, Silahkan Simpan Terlebih Dahulu !";

                $result = [
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => $pesan,
                    'data'    => $tanggal_bahan_bakar
                ];
            } else {
                $result = [
                    'status'  => 1,
                    'vstatus' => 'error',
                    'pesan'   => "Gagal, data belum tersedia !",
                ];
            }

            echo json_encode($result);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function check_data()
    {
        if ($this->session->userdata('logged_in')) {
            $bulan = $this->input->post('bulan');
            $tahun  = $this->input->post('tahun');

            $dthasil = $this->model->check_data($bulan, $tahun);

            if ($dthasil['cek_data_semua']->jml_data == 0) {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => 'Silahkan input data awal !',
                    'data'    => $dthasil['cek_data_semua'],
                );
            } else if ($dthasil['cek_data_bulan']->jml_data == 0) {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'success',
                    'pesan'   => 'Silahkan input data !',
                    'data'    => $dthasil['cek_data_bulan'],
                );
            } else {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'error',
                    'pesan'   => "Data periode ini sudah tersedia ! \n Silahkan input mulai bulan \n" . $this->model->get_tanggal_indo(date("Y-m", strtotime($dthasil['cek_data_terakhir']->data_terakhir . ' + 1 month'))),
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

            $LevelUser                  = $session_data['leveluserid'];
            $UserName                   = $session_data['username'];
            $LevelUserNm                = $session_data['levelusernm'];

            $cekLevelUserNm             = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm']     = substr($LevelUserNm, 0, 7);

            $menus                      = $this->M_menu->menus($LevelUser);
            $data2                      = array('menus' => $menus);

            //ambil variabel URL
            $frmkode                    = $this->uri->segment(4);
            $frmvrs                     = $this->uri->segment(5);
            $frmaksi                    = $this->uri->segment(6);

            $dtfrm                      = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                      = array('dtfrm' => $dtfrm);

            $frmnm                      = $dtfrm[0]->formnm;

            // hdr
            $headerid                   = addslashes($this->input->post('headerid'));
            $complete_userid            = $session_data['userid'];
            $complete_date              = date('Y-m-d');
            $complete_time              = date('H:i:s');
            $complete_by                = $session_data['nmlengkap'];
            $complete_comp              = $this->session->userdata('hostname');                                     // versi user original
            $create_date                = date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));  // dari inputan d-m-Y
            $bulan                      = addslashes($this->input->post('bulan'));
            $tahun                      = addslashes($this->input->post('tahun'));
            $docno                      = addslashes($this->input->post('docno'));
            $supply_awal_total          = addslashes($this->input->post('supply_awal_total'));
            $supply_akhir_total         = addslashes($this->input->post('supply_akhir_total'));
            $supply_total_total         = addslashes($this->input->post('supply_total_total'));
            $asf_awal_total             = addslashes($this->input->post('asf_awal_total'));
            $asf_akhir_total            = addslashes($this->input->post('asf_akhir_total'));
            $asf_total_total            = addslashes($this->input->post('asf_total_total'));
            $soft_awal_total            = addslashes($this->input->post('soft_awal_total'));
            $soft_akhir_total           = addslashes($this->input->post('soft_akhir_total'));
            $soft_total_total           = addslashes($this->input->post('soft_total_total'));

            $detail_id                  = $this->input->post('detail_id');
            $tanggal_bahan_bakar        = $this->input->post('tanggal_bahan_bakar');
            $supply_flow_awal           = $this->input->post('supply_flow_awal');
            $supply_flow_akhir          = $this->input->post('supply_flow_akhir');
            $supply_total               = $this->input->post('supply_total');
            $asf_flow_awal              = $this->input->post('asf_flow_awal');
            $asf_flow_akhir             = $this->input->post('asf_flow_akhir');
            $asf_total                  = $this->input->post('asf_total');
            $soft_flow_awal             = $this->input->post('soft_flow_awal');
            $soft_flow_akhir            = $this->input->post('soft_flow_akhir');
            $soft_total                 = $this->input->post('soft_total');

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $bulan);

                // cek kalau create date dan nama bulan sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    $create_date         = addslashes($this->input->post('create_date'));
                    $bulan               = addslashes($this->input->post('bulan'));
                    $tahun               = addslashes($this->input->post('tahun'));
                    $tanggal_bahan_bakar = count($this->input->post('tanggal_bahan_bakar'));
                    $data                = array(
                        // pesan gagal krn data sudah ada
                        'message'     => 'Gagal, Data pada Bulan : ' . $bulan . ' dan Tahun : ' . $tahun . ', sudah pernah disimpan.',
                        'create_date' => $create_date,
                        'bulan'       => $bulan,
                        'tahun'       => $tahun,

                        'docno' => $docno,
                        'jmldtl' => $tanggal_bahan_bakar,
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
                        'complete_useridx'   => $complete_userid,
                        'complete_byx'       => $complete_by,
                        'complete_datex'     => $complete_date,
                        'complete_timex'     => $complete_time,
                        'complete_compx'     => $complete_comp,
                        'status_detail'      => '0',
                        'status_detailx'     => '0',
                        'create_date'        => $create_date,
                        'bulan'              => $bulan,
                        'tahun'              => $tahun,
                        'docno'              => $docno,
                        'supply_awal_total'  => $supply_awal_total,
                        'supply_akhir_total' => $supply_akhir_total,
                        'supply_total_total' => $supply_total_total,
                        'asf_awal_total'     => $asf_awal_total,
                        'asf_akhir_total'    => $asf_akhir_total,
                        'asf_total_total'    => $asf_total_total,
                        'soft_awal_total'    => $soft_awal_total,
                        'soft_akhir_total'   => $soft_akhir_total,
                        'soft_total_total'   => $soft_total_total
                    );

                    $this->model->insert_dtheader($data4);
                    $max_hdr_id = $this->db1->insert_id();

                    $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                    // dtl
                    $jml = count($this->input->post('tanggal_bahan_bakar'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data5 = array(
                            'headerid'                => $max_hdr_id,
                            'stdtl'                   => $stdtl,
                            'tanggal_bahan_bakar'     => $tanggal_bahan_bakar[$i],
                            'supply_flow_awal'        => $supply_flow_awal[$i],
                            'supply_flow_akhir'       => $supply_flow_akhir[$i],
                            'supply_total'            => $supply_total[$i],
                            'asf_flow_awal'           => $asf_flow_awal[$i],
                            'asf_flow_akhir'          => $asf_flow_akhir[$i],
                            'asf_total'               => $asf_total[$i],
                            'soft_flow_awal'          => $soft_flow_awal[$i],
                            'soft_flow_akhir'         => $soft_flow_akhir[$i],
                            'soft_total'              => $soft_total[$i],
                        );
                        $this->model->insert_detail($data5);
                    }

                    $this->model->insert_detailx($max_hdr_id);

                    echo "<script>alert('Data berhasil disimpan !');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $max_hdr_id, 'refresh');
                }
            } elseif ($frmaksi == 'dtopen') {
                $id = $this->uri->segment(7);

                $data['dtheader'] = $this->model->get_header_byid($id);

                if ($cekLevelUserNm == 'Auditor') {
                    $data['dtdetail'] = $this->model->get_detail_byidx($id);
                } else {
                    $data['dtdetail'] = $this->model->get_detail_byid($id);
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
                            $alertmessage = "<script>alert('Gagal, Data sudah dikomplit ! ');</script>";
                        } else {
                            switch ($_POST['btnproses']) {
                                case $_POST['btnproses'] == 'btnupdate':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data4 = array(
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,
                                        );
                                    } else {
                                        $data4 = array(
                                            // versi user original
                                            'complete_userid' => $complete_userid,
                                            'complete_by'     => $complete_by,
                                            'complete_date'   => $complete_date,

                                            // versi user audit
                                            'complete_useridx'   => $complete_userid,
                                            'complete_byx'       => $complete_by,
                                            'complete_datex'     => $complete_date,
                                            'complete_timex'     => $complete_time,
                                            'complete_compx'     => $complete_comp,
                                            'supply_awal_total'  => $supply_awal_total,
                                            'supply_akhir_total' => $supply_akhir_total,
                                            'supply_total_total' => $supply_total_total,
                                            'asf_awal_total'     => $asf_awal_total,
                                            'asf_akhir_total'    => $asf_akhir_total,
                                            'asf_total_total'    => $asf_total_total,
                                            'soft_awal_total'    => $soft_awal_total,
                                            'soft_akhir_total'   => $soft_akhir_total,
                                            'soft_total_total'   => $soft_total_total
                                        );
                                    }

                                    $alertmessage = "<script>alert('Data berhasil disimpan ! ');</script>";
                                    break;

                                case $_POST['btnproses'] == 'btncomplete':
                                    if ($cekLevelUserNm == "Auditor") {
                                        $data4 = array(
                                            // versi user audit
                                            'complete_useridx' => $complete_userid,
                                            'complete_byx'     => $complete_by,
                                            'complete_datex'   => $complete_date,
                                            'complete_timex'   => $complete_time,
                                            'complete_compx'   => $complete_comp,

                                            'status_detailx' => '1',

                                        );
                                    } else {
                                        $data4 = array(
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
                                            'app1_comp'           => $complete_comp,                    // versi user original
                                            'status_detail'       => '1',
                                            'status_detailx'      => '1',
                                            'supply_awal_total'   => $supply_awal_total,
                                            'supply_akhir_total'  => $supply_akhir_total,
                                            'supply_total_total'  => $supply_total_total,
                                            'asf_awal_total'      => $asf_awal_total,
                                            'asf_akhir_total'     => $asf_akhir_total,
                                            'asf_total_total'     => $asf_total_total,
                                            'soft_awal_total'     => $soft_awal_total,
                                            'soft_akhir_total'    => $soft_akhir_total,
                                            'soft_total_total'    => $soft_total_total
                                        );
                                    }
                                    $alertmessage = "<script>alert('Data berhasil dikomplit ! ');</script>";
                                    break;
                                default:
                                    break;
                            }

                            $this->model->update_hdr($headerid, $data4);

                            $stdtl = $cekLevelUserNm == "Auditor" ? "0" : "1";

                            //edit detail
                            $jml = count($this->input->post('tanggal_bahan_bakar'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($detail_id[$i])) {
                                    $data5 = array(
                                        'stdtl'                   => $stdtl,
                                        'tanggal_bahan_bakar'     => $tanggal_bahan_bakar[$i],
                                        'supply_flow_awal'        => $supply_flow_awal[$i],
                                        'supply_flow_akhir'       => $supply_flow_akhir[$i],
                                        'supply_total'            => $supply_total[$i],
                                        'asf_flow_awal'           => $asf_flow_awal[$i],
                                        'asf_flow_akhir'          => $asf_flow_akhir[$i],
                                        'asf_total'               => $asf_total[$i],
                                        'soft_flow_awal'          => $soft_flow_awal[$i],
                                        'soft_flow_akhir'         => $soft_flow_akhir[$i],
                                        'soft_total'              => $soft_total[$i]
                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtl($detail_id[$i], $data5);
                                    } else {
                                        $this->model->update_dtl($detail_id[$i], $data5);
                                        $this->model->update_dtl($detail_id[$i], $data5);
                                    }
                                } else {
                                    $data5 = array(
                                        'headerid'                => $headerid,
                                        'stdtl'                   => $stdtl,
                                        'tanggal_bahan_bakar'     => $tanggal_bahan_bakar[$i],
                                        'supply_flow_awal'        => $supply_flow_awal[$i],
                                        'supply_flow_akhir'       => $supply_flow_akhir[$i],
                                        'supply_total'            => $supply_total[$i],
                                        'asf_flow_awal'           => $asf_flow_awal[$i],
                                        'asf_flow_akhir'          => $asf_flow_akhir[$i],
                                        'asf_total'               => $asf_total[$i],
                                        'soft_flow_awal'          => $soft_flow_awal[$i],
                                        'soft_flow_akhir'         => $soft_flow_akhir[$i],
                                        'soft_total'              => $soft_total[$i]
                                    );

                                    $this->model->insert_detail($data5);
                                }
                            }

                            $this->model->insert_detailx($headerid);
                        }
                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
                } else {
                    echo "<script>alert('gagal, tidak ada aksi !');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                }
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}
