<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formfrmfss065_04 extends CI_Controller
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

            $docno        = 'HC/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' . date("d", strtotime($create_date));

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
    function get_jenis_mesin_by()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $dept           = $this->input->post('dept');
            $item           = $this->input->post('item');
            $create_date      = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y
            // print_r($item);
            // die;
            $dthasil        = $this->model->get_jenis_mesin_by($dept, $create_date, $item);

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
    function get_gugus_by()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data         = $this->session->userdata('logged_in');
            $dept                 = $this->input->post('dept');
            $id_jns_mesin         = $this->input->post('id_jns_mesin');
            $create_date          = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y

            $dthasil              = $this->model->get_gugus_by($dept, $id_jns_mesin, $create_date);

            $hasil = array(
                'status'     => 0,
                'vstatus'    => 'berhasil',
                'pesan'      => "berhasil!",
                'data'       => $dthasil,
            );

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
    // function get_gugus_by()
    // {
    //     if ($this->session->userdata('logged_in')) {
    //         $session_data   = $this->session->userdata('logged_in');
    //         $dept           = $this->input->post('dept');

    //         $dthasil        = $this->model->get_gugus_by($dept);

    //         $hasil = array(
    //             'status'  => 0,
    //             'vstatus' => 'berhasil',
    //             'pesan'   => "berhasil!",
    //             'data'    => $dthasil,
    //         );

    //         echo json_encode($hasil);
    //     } else {
    //         //Jika tidak ada session di kembalikan ke halaman login
    //         redirect('C_login', 'refresh');
    //     }
    // }
    function get_mesin_frmfss064()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $dept           = $this->input->post('dept');
            $gugus          = $this->input->post('gugus');
            $item           = $this->input->post('item');

            $dthasil        = $this->model->get_list_mesin_by($dept, $item, $gugus);

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
    function get_frmfss060()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $tahun          = date("Y", strtotime(addslashes($this->input->post('tahun')))); // dari inputan d-m-Y
            $dept           = $this->input->post('dept');
            $nama_mesin     = $this->input->post('nama_mesin');

            $dthasil        = $this->model->get_frmfss060($tahun, $dept, $nama_mesin);

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

            $BagianAkses            = $session_data['bagian_akses'];
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

            $data['dtdept']  = $this->model->get_records_payroll($BagianAkses);

            // data hedder
            $headerid        = addslashes($this->input->post('headerid'));

            $complete_userid = $session_data['userid'];
            $complete_date   = date('Y-m-d');
            $complete_time   = date('H: i: s');
            $complete_by     = $session_data['nmlengkap'];
            $complete_comp   = $this->session->userdata('hostname'); // versi user original

            $create_date     = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y
            $docno           = addslashes($this->input->post('docno'));
            $dept            = addslashes($this->input->post('dept'));
            $deptabbr        = addslashes($this->input->post('deptabbr'));
            $gugus           = addslashes($this->input->post('gugus'));
            $nama_mesin      = addslashes($this->input->post('nama_mesin'));
            $tahun           = addslashes($this->input->post('tahun'));
            $item            = addslashes($this->input->post('item'));
            $id_jns_mesin    = addslashes($this->input->post('id_jns_mesin'));
            $jns_mesin       = addslashes($this->input->post('jns_mesin'));
            $id_gugus        = addslashes($this->input->post('id_gugus'));
            $gugus           = addslashes($this->input->post('gugus'));

            //data detail
            $detail_id       = $this->input->post('detail_id');
            $detail_id_060   = $this->input->post('detail_id_060');
            $headerid_060    = $this->input->post('headerid_060');
            $dtl_a_tanggal   = $this->input->post('dtl_a_tanggal');
            $dtl_a_kategori  = $this->input->post('dtl_a_kategori');
            $dtl_a_tindakan  = $this->input->post('dtl_a_tindakan');
            $dtl_a_waktu     = $this->input->post('dtl_a_waktu');
            $dtl_a_plan      = $this->input->post('dtl_a_plan');

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno, $dept, $deptabbr, $gugus, $nama_mesin, $tahun, $item, $id_jns_mesin, $id_gugus);

                // cek kalau create date dan docno sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    // pesan gagal krn data sudah ada
                    $data['message']          = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ', No Dokumen : ' . $docno . ', Dept : ' . $deptabbr . ', Gugus : ' . $gugus . ' dan Nama Mesin : ' . $nama_mesin . ' sudah pernah disimpan';

                    $data['dtcreate_date']    = addslashes($this->input->post('create_date'));
                    $data['dtdocno']          = addslashes($this->input->post('docno'));
                    $data['dtrev']            = addslashes($this->input->post('rev'));
                    $data['dtdept']           = addslashes($this->input->post('dept'));
                    $data['dtdeptabbr']       = addslashes($this->input->post('deptabbr'));
                    $data['dtgugus']          = addslashes($this->input->post('gugus'));
                    $data['dttahun']          = addslashes($this->input->post('tahun'));
                    $data['dtitem']           = addslashes($this->input->post('item'));
                    $data['dtid_jns_mesin']   = addslashes($this->input->post('id_jns_mesin'));
                    $data['dtjns_mesin']      = addslashes($this->input->post('jns_mesin'));
                    $data['dtid_gugus']       = addslashes($this->input->post('id_gugus'));
                    $data['dtgugus']          = addslashes($this->input->post('gugus'));

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
                        'dept'             => $dept,
                        'deptabbr'         => $deptabbr,
                        'gugus'            => $gugus,
                        'id_gugus'            => $id_gugus,
                        'nama_mesin'       => $nama_mesin,
                        'tahun'            => $tahun,
                        'item'             => $item,
                        'id_jns_mesin'     => $id_jns_mesin,
                        'jns_mesin'        => $jns_mesin,
                    );


                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    if ($cekLevelUserNm == "Auditor") {
                        $stdtl = '0';
                    } else {
                        $stdtl = '1';
                    }

                    // detail
                    $jml = count($this->input->post('dtl_a_tanggal'));
                    for ($i = 0; $i < $jml; $i++) {

                        if ($dtl_a_tanggal[$i] != '') {
                            if (date("Y-m-d", strtotime($dtl_a_tanggal[$i])) != '1970-01-01') {
                                $vdtl_a_tanggal[$i]   = date("Y-m-d", strtotime($dtl_a_tanggal[$i]));
                            } else {
                                $vdtl_a_tanggal[$i]   = NULL;
                            }
                        } else {
                            $vdtl_a_tanggal[$i]   = NULL;
                        }
                        $data6 = array(
                            'headerid'      => $max_hdr_id,
                            'stdtl'         => $stdtl,

                            'detail_id_060' => $detail_id_060[$i],
                            'headerid_060'  => $headerid_060[$i],
                            'tanggal'       => $vdtl_a_tanggal[$i],
                            'kategori'      => $dtl_a_kategori[$i],
                            'tindakan'      => $dtl_a_tindakan[$i],
                            'waktu'         => $dtl_a_waktu[$i],
                            'planned'       => $dtl_a_plan[$i]
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
                    $create_date    = $dtheaderrow->create_date;
                    $dept           = $dtheaderrow->dept;
                    $deptabbr       = $dtheaderrow->deptabbr;
                    $item           = $dtheaderrow->item;
                    $gugus          = $dtheaderrow->id_gugus;
                }

                $data['dtjenis_mesin']   = $this->model->get_jenis_mesin_by($deptabbr, $create_date);
                $data['dtgugus']   = $this->model->get_gugus_by($deptabbr);
                $data['list_mesin_frmfss064']   = $this->model->get_list_mesin_by($deptabbr, $item, $gugus);

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail           = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail           = $this->model->get_detail_byid($id);
                }

                $data8  = array('dtdetail' => $dtdetail);
                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
            } else {

                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $dept, $deptabbr, $gugus, $nama_mesin, $tahun, $item, $id_jns_mesin, $id_gugus, $headerid);

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
                            $jml = count($this->input->post('dtl_a_tanggal'));
                            for ($i = 0; $i < $jml; $i++) {

                                if ($dtl_a_tanggal[$i] != '') {
                                    if (date("Y-m-d", strtotime($dtl_a_tanggal[$i])) != '1970-01-01') {
                                        $vdtl_a_tanggal[$i]   = date("Y-m-d", strtotime($dtl_a_tanggal[$i]));
                                    } else {
                                        $vdtl_a_tanggal[$i]   = NULL;
                                    }
                                } else {
                                    $vdtl_a_tanggal[$i]   = NULL;
                                }
                                if (isset($detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'         => $stdtl,

                                        'detail_id_060' => $detail_id_060[$i],
                                        'headerid_060'  => $headerid_060[$i],
                                        'tanggal'       => $vdtl_a_tanggal[$i],
                                        'kategori'      => $dtl_a_kategori[$i],
                                        'tindakan'      => $dtl_a_tindakan[$i],
                                        'waktu'         => $dtl_a_waktu[$i],
                                        'planned'       => $dtl_a_plan[$i]

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtlx($detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl($detail_id[$i], $data6);
                                        $this->model->update_dtlx($detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'      => $headerid,
                                        'stdtl'         => $stdtl,

                                        'detail_id_060' => $detail_id_060[$i],
                                        'headerid_060'  => $headerid_060[$i],
                                        'tanggal'       => $vdtl_a_tanggal[$i],
                                        'kategori'      => $dtl_a_kategori[$i],
                                        'tindakan'      => $dtl_a_tindakan[$i],
                                        'waktu'         => $dtl_a_waktu[$i],
                                        'planned'       => $dtl_a_plan[$i]
                                    );

                                    $this->model->insert_detail($data6);
                                }
                            }

                            $this->model->insert_detailx($headerid);
                        }
                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
                } else if (isset($_POST['btnrefresh'])) {
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
                        $alertmessage = "<script>alert('Maaf data tidak bisa direfresh karena sudah dikomplit!! ');</script>";
                    } else {
                        $this->model->update_hdr($headerid, $data5);
                        $dtheader    = $this->model->get_header_byid($headerid); // manggil data header

                        foreach ($dtheader as $dtheaderrow) {
                            $update_dept         = $dtheaderrow->dept;
                            $update_tahun          = $dtheaderrow->tahun;
                            $update_nama_mesin    = trim($dtheaderrow->nama_mesin);
                        }

                        $this->model->fn_update_frmfss065_060($update_tahun, $update_dept, $update_nama_mesin);

                        $alertmessage = "<script>alert('Data berhasil direfresh!! ');</script>";
                    }
                    echo $alertmessage;
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
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

                        $dtl_a_chk = $this->input->post('dtl_a_chk');
                        $jml = count($this->input->post('dtl_a_chk'));

                        if ($cekLevelUserNm == 'Auditor') {
                            for ($i = 0; $i < $jml; $i++) {
                                $this->model->update_stdtlx($dtl_a_chk[$i]);
                            }
                        } else {
                            for ($i = 0; $i < $jml; $i++) {
                                // delete detail
                                $this->model->delete_detail($dtl_a_chk[$i]);
                                $this->model->delete_detailx($dtl_a_chk[$i]);
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
