<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formfrmfss031_03 extends CI_Controller
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

            $dthasil      = $this->model->get_docno(date("m", strtotime($create_date)), date("Y", strtotime($create_date)));

            $last_docno   = !empty($dthasil->vdocno) ? $dthasil->vdocno + 1 : 1;

            $arr_bulan    = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            $docno        = 'LTPM/WTD/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' . date("y", strtotime($create_date));

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

    function get_nama_mesin()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $dept     = $this->input->post('dept');
            $item     = $this->input->post('item');

            $dthasil        = $this->model->get_nama_mesin($dept, $item);

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil!",
                'data'    => $dthasil,
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_nama_panel()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $dept     = $this->input->post('dept');

            $dthasil        = $this->model->get_nama_panel($dept);

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil!",
                'data'    => $dthasil,
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_kode_mesin()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $nama_mesin     = $this->input->post('nama_mesin');

            $dthasil        = $this->model->get_kode_mesin($nama_mesin);

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil!",
                'data'    => $dthasil,
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_kode_panel()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $nama_panel     = $this->input->post('nama_mesin');

            $dthasil        = $this->model->get_kode_panel($nama_panel);

            $hasil = array(
                'status'  => 0,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil!",
                'data'    => $dthasil,
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_partkomponen()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $deptabbr       = $this->input->post('deptabbr');
            $nama_mesin     = $this->input->post('nama_mesin');
            $kode_mesin     = $this->input->post('kode_mesin');
            $data           = $this->model->get_partkomponen($deptabbr);
            $dtdetail5      = $this->model->getdata_detail_e_view($nama_mesin, $kode_mesin);

            $hasil = array(
                'status'           => 0,
                'vstatus'          => 'berhasil',
                'pesan'            => "berhasil!",
                'data_na_komponen' => $dtdetail5,
                'data_komponen'    => $data,

            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_partkomponen_panel()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $deptabbr       = $this->input->post('deptabbr');
            $nama_panel    = $this->input->post('nama_mesin');
            $kode_panel    = $this->input->post('kode_mesin');
            $data           = $this->model->get_partkomponen_panel($kode_panel);

            $hasil = array(
                'status'           => 0,
                'vstatus'          => 'berhasil',
                'pesan'            => "berhasil!",
                'data_komponen'    => $data,

            );

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

            // $data['dtmesin']     = $this->model->get_nama_mesin();

            // data hedder
            $headerid               = addslashes($this->input->post('headerid'));

            $complete_userid        = $session_data['userid'];
            $complete_date          = date('Y-m-d');
            $complete_time          = date('H:i:s');
            $complete_by            = $session_data['nmlengkap'];
            $complete_comp          = $this->session->userdata('hostname');  // versi user original

            $create_date            = date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));  // dari inputan d-m-Y
            $docno                  = addslashes($this->input->post('docno'));
            $dept                   = addslashes($this->input->post('dept'));
            $deptabbr               = addslashes($this->input->post('deptabbr'));
            $item                   = addslashes($this->input->post('item'));
            $nama_mesin             = addslashes($this->input->post('nama_mesin'));
            $kode_mesin             = addslashes($this->input->post('kode_mesin'));
            $jam                    = addslashes($this->input->post('jam'));
            $total_operasi          = addslashes($this->input->post('total_operasi'));
            $hasil_pengujian        = addslashes($this->input->post('hasil_pengujian'));

            //data detail
            $detail_id              = $this->input->post('detail_id');
            $bagian_mesin           = $this->input->post('bagian_mesin');
            $kondisi_masalah        = $this->input->post('kondisi_masalah');
            $tindakan               = $this->input->post('tindakan');
            $suku_cadang_jenis      = $this->input->post('suku_cadang_jenis');
            $suku_cadang_jumlah     = $this->input->post('suku_cadang_jumlah');
            $keterangan             = $this->input->post('keterangan');

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno, $dept, $nama_mesin, $kode_mesin, $jam, $total_operasi);

                // cek kalau create date dan docno sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    // pesan gagal krn data sudah ada
                    $data['message']              = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ' dan No Dokumen : ' . $docno . ' sudah pernah disimpan';

                    $data['dtcreate_date']        = addslashes($this->input->post('create_date'));
                    $data['dtdocno']              = addslashes($this->input->post('docno'));
                    $data['dtdept']               = addslashes($this->input->post('dept'));
                    $data['dtdeptabbr']           = addslashes($this->input->post('deptabbr'));
                    $data['dtitem']               = addslashes($this->input->post('item'));
                    $data['dtnama_mesin']         = addslashes($this->input->post('nama_mesin'));
                    $data['dtkode_mesin']         = addslashes($this->input->post('kode_mesin'));
                    $data['dtjam']                = addslashes($this->input->post('jam'));
                    $data['dttotal_operasi']      = addslashes($this->input->post('total_operasi'));
                    $data['dthasil_pengujian']    = addslashes($this->input->post('hasil_pengujian'));

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

                        'complete_userid'  => $complete_userid,
                        'complete_by'      => $complete_by,
                        'complete_date'    => $complete_date,
                        'complete_time'    => $complete_time,
                        'complete_comp'    => $complete_comp,

                        'complete_useridx' => $complete_userid,
                        'complete_byx'     => $complete_by,
                        'complete_datex'   => $complete_date,
                        'complete_timex'   => $complete_time,
                        'complete_compx'   => $complete_comp,     // versi user audit

                        'status_detail'    => '0',
                        'status_detailx'   => '0',

                        'create_date'      => $create_date,
                        'docno'            => $docno,
                        'dept'             => $dept,
                        'deptabbr'         => $deptabbr,
                        'item'             => $item,
                        'nama_mesin'       => $nama_mesin,
                        'kode_mesin'       => $kode_mesin,
                        'jam'              => $jam,
                        'total_operasi'    => $total_operasi,
                        'hasil_pengujian'  => $hasil_pengujian
                    );

                    // print_r($data5);
                    // die;


                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    if ($cekLevelUserNm == "Auditor") {
                        $stdtl = '0';
                    } else {
                        $stdtl = '1';
                    }

                    // detail
                    $jml = count($this->input->post('bagian_mesin'));
                    for ($i = 0; $i < $jml; $i++) {

                        $data6 = array(
                            'headerid'   => $max_hdr_id,
                            'stdtl'      => $stdtl,

                            'bagian_mesin' => $bagian_mesin[$i],
                            'kondisi_masalah' => $kondisi_masalah[$i],
                            'tindakan'      => $tindakan[$i],
                            'suku_cadang_jenis'      => $suku_cadang_jenis[$i],
                            'suku_cadang_jumlah'      => $suku_cadang_jumlah[$i],
                            'keterangan'       => $keterangan[$i]
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

                foreach ($dtheader as $dtheaderrow) {
                    $dept = $dtheaderrow->dept;
                    $item = $dtheaderrow->item;
                }
                $data['dtmesin']     = $this->model->get_nama_mesin($dept, $item);

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail           = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail           = $this->model->get_detail_byid($id);
                }

                $data8  = array('dtdetail' => $dtdetail);
                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
            } else {

                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $dept, $nama_mesin, $kode_mesin, $jam, $total_operasi, $headerid);

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
                                            'dept'             => $dept,
                                            'deptabbr'         => $deptabbr,
                                            'item'             => $item,
                                            'nama_mesin'       => $nama_mesin,
                                            'kode_mesin'       => $kode_mesin,
                                            'jam'              => $jam,
                                            'total_operasi'    => $total_operasi,
                                            'hasil_pengujian'  => $hasil_pengujian
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

                            if ($cekLevelUserNm == "Auditor") {
                                $stdtl = '0';
                            } else {
                                $stdtl = '1';
                            }


                            //edit detail1
                            $jml = count($this->input->post('bagian_mesin'));
                            for ($i = 0; $i < $jml; $i++) {
                                if (isset($detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl' => $stdtl,

                                        'bagian_mesin'       => $bagian_mesin[$i],
                                        'kondisi_masalah'    => $kondisi_masalah[$i],
                                        'tindakan'           => $tindakan[$i],
                                        'suku_cadang_jenis'  => $suku_cadang_jenis[$i],
                                        'suku_cadang_jumlah' => $suku_cadang_jumlah[$i],
                                        'keterangan'         => $keterangan[$i]
                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtlx($detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl($detail_id[$i], $data6);
                                        $this->model->update_dtlx($detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid' => $headerid,
                                        'stdtl'    => $stdtl,

                                        'bagian_mesin'       => $bagian_mesin[$i],
                                        'kondisi_masalah'    => $kondisi_masalah[$i],
                                        'tindakan'           => $tindakan[$i],
                                        'suku_cadang_jenis'  => $suku_cadang_jenis[$i],
                                        'suku_cadang_jumlah' => $suku_cadang_jumlah[$i],
                                        'keterangan'         => $keterangan[$i]
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

                        $dltc_chk = $this->input->post('dltc_chk');
                        $jml = count($this->input->post('dltc_chk'));

                        if ($cekLevelUserNm == 'Auditor') {
                            for ($i = 0; $i < $jml; $i++) {
                                $this->model->update_stdtlx($dltc_chk[$i]);
                            }
                        } else {
                            for ($i = 0; $i < $jml; $i++) {
                                $this->model->delete_detail($dltc_chk[$i]);
                                $this->model->delete_detailx($dltc_chk[$i]);
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
