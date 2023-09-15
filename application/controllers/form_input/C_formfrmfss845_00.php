<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formfrmfss845_00 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $CI        = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);

        $frmkode   = $this->uri->segment(4);
        $frmvrs    = $this->uri->segment(5);

        $this->load->model(array('M_user', 'M_menu', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
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
            $deptabbr  = $this->input->post('deptabbr');

            $dthasil      = $this->model->get_docno(date("m", strtotime($create_date)), date("Y", strtotime($create_date)));

            $last_docno   = !empty($dthasil->vdocno) ? $dthasil->vdocno + 1 : 1;

            $arr_bulan    = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            $docno        = 'KP/' . $deptabbr . '/' . date("y", strtotime($create_date));

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
    function get_namapanel()
    {
        $dept  = $this->input->post('dept');
        $dtnamapanel      = $this->model->get_nampanel($dept);
        echo json_encode($dtnamapanel);
    }
    function get_kodepanel()
    {
        $dept         = $this->input->post('dept');
        $nama_panel   = $this->input->post('nama_panel');
        $dtkodepanel  = $this->model->get_kodepanel($dept, $nama_panel);
        echo json_encode($dtkodepanel);
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

            $BagianAkses            = $session_data['bagian_akses'];
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
            $frmaksi                = $this->uri->segment(6);

            $dtfrm                  = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                  = array('dtfrm' => $dtfrm);

            foreach ($dtfrm as $dt_form) {
                $frmnm              = $dt_form->formnm;
            }

            $data['dtdept']         = $this->model->get_records_payroll($BagianAkses);

            // data hedder
            $headerid               = addslashes($this->input->post('headerid'));

            $complete_userid        = $session_data['userid'];
            $complete_date          = date('Y-m-d');
            $complete_time          = date('H:i:s');
            $complete_by            = $session_data['nmlengkap'];
            $complete_comp          = $this->session->userdata('hostname'); // versi user original

            $create_date            = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y
            $docno                  = addslashes($this->input->post('docno'));
            $rev                    = addslashes($this->input->post('rev'));
            $dept                   = addslashes($this->input->post('dept'));
            $deptabbr               = addslashes($this->input->post('deptabbr'));
            $nama_panel             = addslashes($this->input->post('nama_panel'));
            $id_nama_panel          = addslashes($this->input->post('id_nama_panel'));
            $kode_panel             = addslashes($this->input->post('kode_panel'));
            $lokasi_panel           = addslashes($this->input->post('lokasi_panel'));

            //data detail
            $detail_id              = $this->input->post('detail_id');
            $nama_komponen          = $this->input->post('nama_komponen');
            $kode_komponen          = $this->input->post('kode_komponen');
            $type_komponen          = $this->input->post('type_komponen');
            $merek                  = $this->input->post('merek');
            $standard               = $this->input->post('standard');
            $arus                   = $this->input->post('arus');
            $tenaga                 = $this->input->post('tenaga');
            $keterangan             = $this->input->post('keterangan');


            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno, $rev, $dept, $deptabbr, $nama_panel, $kode_panel, $lokasi_panel);

                // cek kalau create date dan docno sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    // pesan gagal krn data sudah ada
                    $data['message']          = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ' dan No Dokumen : ' . $docno . ' sudah pernah disimpan';

                    $data['dtcreate_date']    = addslashes($this->input->post('create_date'));
                    $data['dtdocno']          = addslashes($this->input->post('docno'));
                    $data['dtrev']            = addslashes($this->input->post('rev'));
                    $data['dtdept']           = addslashes($this->input->post('dept'));
                    $data['dtdeptabbr']       = addslashes($this->input->post('deptabbr'));
                    $data['dtnama_panel']      = addslashes($this->input->post('nama_panel'));
                    $data['dtkode_panel']      = addslashes($this->input->post('kode_panel'));
                    $data['dtlokasi_panel']      = addslashes($this->input->post('lokasi_panel'));

                    $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
                } else {
                    $data5 = array(
                        // 'app1_userid'         => $complete_userid,
                        // 'app1_by'             => $complete_by,
                        // 'app1_date'           => $complete_date,
                        // 'app1_time'           => $complete_time,
                        // 'app1_position'       => $session_data['jabnm'],
                        // 'app1_personalid'     => $session_data['personalid'],
                        // 'app1_personalstatus' => $session_data['personalstatus'],
                        // 'app1_status'         => '1', // versi user original
                        // 'app1_comp'           => $complete_comp, // versi user original

                        'complete_userid'        => $complete_userid,
                        'complete_by'            => $complete_by,
                        'complete_date'          => $complete_date,
                        'complete_time'          => $complete_time,
                        'complete_comp'          => $complete_comp,
                        'complete_useridx'       => $complete_userid,
                        'complete_byx'           => $complete_by,
                        'complete_datex'         => $complete_date,
                        'complete_timex'         => $complete_time,
                        'complete_compx'         => $complete_comp,     // versi user audit
                        'status_detail'          => '0',
                        'status_detailx'         => '0',
                        'create_date'            => $create_date,
                        'docno'                  => $docno,
                        'rev'                    => $rev,
                        'dept'                   => $dept,
                        'deptabbr'               => $deptabbr,
                        'id_nama_panel'          => $id_nama_panel,
                        'nama_panel'             => $nama_panel,
                        'kode_panel'             => $kode_panel,
                        'lokasi_panel'           => $lokasi_panel,
                    );


                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    if ($cekLevelUserNm == "Auditor") {
                        $stdtl = '0';
                    } else {
                        $stdtl = '1';
                    }

                    // detail
                    $jml = count($this->input->post('nama_komponen'));
                    for ($i = 0; $i < $jml; $i++) {

                        $data6 = array(
                            'headerid'       => $max_hdr_id,
                            'stdtl'          => $stdtl,

                            'nama_komponen' => $nama_komponen[$i],
                            'kode_komponen'  => $kode_komponen[$i],
                            'type_komponen'  => $type_komponen[$i],
                            'merek'          => $merek[$i],
                            'standard'       => $standard[$i],
                            'arus'           => $arus[$i],
                            'tenaga'         => $tenaga[$i],
                            'keterangan'     => $keterangan[$i],

                        );
                        $this->model->insert_detail($data6);
                    }

                    $this->model->insert_detailx($max_hdr_id);

                    echo "<script>alert('Data berhasil disimpan!!');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $max_hdr_id, 'refresh');
                }
            } elseif ($frmaksi == 'dtopen') {
                $id                     = $this->uri->segment(7);

                $dtheader               = $this->model->get_header_byid($id); // manggil data header
                $data7                  = array('dtheader' => $dtheader);

                foreach ($dtheader as $dtheaderrow) {
                    $dept = $dtheaderrow->dept;
                    $nama_panel = $dtheaderrow->id_nama_panel;
                }
                $data['dtnamapanel']    = $this->model->get_nampanel2($dept);
                $data['dtkodepanel']    = $this->model->get_kodepanel2($dept, $nama_panel);

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail           = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail           = $this->model->get_detail_byid($id);
                }

                $data8  = array('dtdetail' => $dtdetail);
                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
            } else {

                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $rev, $dept, $deptabbr, $headerid, $nama_panel, $kode_panel, $lokasi_panel);

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
                                            'docno'            => $docno,
                                            'rev'              => $rev,
                                            'dept'             => $dept,
                                            'deptabbr'         => $deptabbr,
                                            'nama_panel'       => $nama_panel,
                                            'id_nama_panel'    => $id_nama_panel,
                                            'kode_panel'       => $kode_panel,
                                            'lokasi_panel'     => $lokasi_panel,
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
                            $jml = count($this->input->post('nama_komponen'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'                   => $stdtl,

                                        'nama_komponen' => $nama_komponen[$i],
                                        'kode_komponen'  => $kode_komponen[$i],
                                        'type_komponen'  => $type_komponen[$i],
                                        'merek'          => $merek[$i],
                                        'standard'       => $standard[$i],
                                        'arus'           => $arus[$i],
                                        'tenaga'         => $tenaga[$i],
                                        'keterangan'     => $keterangan[$i],

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

                                        'nama_komponen' => $nama_komponen[$i],
                                        'kode_komponen'  => $kode_komponen[$i],
                                        'type_komponen'  => $type_komponen[$i],
                                        'merek'          => $merek[$i],
                                        'standard'       => $standard[$i],
                                        'arus'           => $arus[$i],
                                        'tenaga'         => $tenaga[$i],
                                        'keterangan'     => $keterangan[$i],
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

                        $chk = $this->input->post('chk');
                        $jml = count($this->input->post('chk'));

                        if ($cekLevelUserNm == 'Auditor') {
                            for ($i = 0; $i < $jml; $i++) {
                                $this->model->update_stdtlx($chk[$i]);
                            }
                        } else {
                            for ($i = 0; $i < $jml; $i++) {
                                $this->model->delete_detail($chk[$i]);
                                $this->model->delete_detailx($chk[$i]);
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
