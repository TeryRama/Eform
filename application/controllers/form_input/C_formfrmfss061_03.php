<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formfrmfss061_03 extends CI_Controller
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

            $docno        = 'RPO/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' . date("d", strtotime($create_date));

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
    function get_mesin_frmfss064()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $dept           = $this->input->post('dept');

            $dthasil        = $this->model->get_mesin_frmfss064($dept);

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
    function get_kode_frmfss064()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $dept           = $this->input->post('dept');
            $nama_mesin     = $this->input->post('nama_mesin');

            $dthasil        = $this->model->get_kode_frmfss064($dept, $nama_mesin);

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
    function get_add_sch()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $dept           = $this->input->post('dept');
            $kode_form      = $this->input->post('kode_form');
            $headerid       = $this->input->post('headerid');
            $tahun          = $this->input->post('tahun');

            $month          = $this->model->get_month($tahun);
            $dthasil        = $this->model->get_detail_byid($headerid);
            if (count($dthasil) > 0) {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'berhasil',
                    'pesan'   => "berhasil!",
                    'data'    => $dthasil,
                    'list_month' => $month,
                );
            } else {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'berhasil',
                    'pesan'   => "Data belum di isi!",
                    'list_month' => $month,
                );
            }

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function save_modal_schedule()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data         = $this->session->userdata('logged_in');
            $modal_headerid       = addslashes($this->input->post('modal_headerid'));
            $modal_kodeform       = addslashes($this->input->post('modal_kodeform'));
            $mdl1_detail_id       = $this->input->post('mdl1_detail_id');
            $mdl1_detail_id_form  = $this->input->post('mdl1_detail_id_form');
            $mdl1_point           = $this->input->post('mdl1_point');
            $mdl1_kode            = $this->input->post('mdl1_kode');
            $mdl1_frequency       = $this->input->post('mdl1_frequency');
            $mdl1_pic             = $this->input->post('mdl1_pic');

            $mdl1_tgl_schedule    = $this->input->post('mdl1_tgl_schedule');
            if (isset($mdl1_tgl_schedule)) {
                foreach ($mdl1_tgl_schedule as $key => $mdl1_tgl_schedule_item) {
                    $arr_val_mdl1_tgl_schedule = $mdl1_tgl_schedule_item;
                    $mdl1_tgl_schedule2[$key] = implode(',', $arr_val_mdl1_tgl_schedule);
                }
            }

            $jml_dtl_mdl = count($this->input->post('mdl1_point'));
            for ($mdl_i = 0; $mdl_i < $jml_dtl_mdl; $mdl_i++) {
                if (isset($mdl1_tgl_schedule2[$mdl_i])) {
                    $v_mdl1_tgl_schedule2[$mdl_i] = $mdl1_tgl_schedule2[$mdl_i];
                } else {
                    $v_mdl1_tgl_schedule2[$mdl_i] = NULL;
                }
                $data_mdl = array(
                    'nama'           => $mdl1_point[$mdl_i],
                    'kode'           => $mdl1_kode[$mdl_i],
                    'frequency'      => $mdl1_frequency[$mdl_i],
                    'pic'            => $mdl1_pic[$mdl_i],
                    'tgl_schedule'   => $v_mdl1_tgl_schedule2[$mdl_i],
                    'detail_id_form' => $mdl1_detail_id_form[$mdl_i],
                    'headerid_form'  => $modal_headerid,
                    'kode_form'      => $modal_kodeform,
                );
                if ($mdl1_detail_id[$mdl_i] != '') {
                    $pesan = "Data berhasil diupdate";
                    $this->model->update_trans($mdl1_detail_id[$mdl_i], $data_mdl);
                } else {
                    $pesan = "Data berhasil disimpan";
                    $this->model->insert_trans($data_mdl);
                }
            }
            $save_mdl = array(
                'vstatus'  => 'success',
                'pesan'    => $pesan,
                'headerid' => $modal_headerid
            );
            echo json_encode($save_mdl);
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

            $data['dtdept']   = $this->model->get_records_payroll($BagianAkses);

            // data hedder
            $headerid         = addslashes($this->input->post('headerid'));

            $complete_userid  = $session_data['userid'];
            $complete_date    = date('Y-m-d');
            $complete_time    = date('H:i:s');
            $complete_by      = $session_data['nmlengkap'];
            $complete_comp    = $this->session->userdata('hostname'); // versi user original

            $create_date      = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y
            $docno            = addslashes($this->input->post('docno'));
            $rev              = addslashes($this->input->post('rev'));
            $dept             = addslashes($this->input->post('dept'));
            $deptabbr         = addslashes($this->input->post('deptabbr'));
            $gugus            = addslashes($this->input->post('gugus'));
            $tahun            = addslashes($this->input->post('tahun'));

            //data detail
            $detail_id        = $this->input->post('detail_id');
            $dtl_a_nama_mesin = $this->input->post('dtl_a_nama_mesin');
            $dtl_a_kode_mesin = $this->input->post('dtl_a_kode_mesin');
            $dtl_a_frekuensi  = $this->input->post('dtl_a_frekuensi');
            $dtl_a_jenis_oli  = $this->input->post('dtl_a_jenis_oli');
            $dtl_a_volume     = $this->input->post('dtl_a_volume');
            $dtl_a_ket        = $this->input->post('dtl_a_ket');

            $list_month       = $this->model->get_month(date('Y'));
            foreach ($list_month as $list_month_row) {
                ${'dtl_a_month' . $list_month_row->month}   = date("Y-m-d", strtotime($this->input->post('dtl_a_month' . $list_month_row->month)));
            }

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno, $rev, $dept, $deptabbr, $gugus, $tahun);

                // cek kalau create date dan docno sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    // pesan gagal krn data sudah ada
                    $data['message']          = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ', No Dokumen : ' . $docno . ', Revisi : ' . $rev . ', Dept : ' . $deptabbr . ', Gugus : ' . $gugus . ' dan Tahun : ' . $tahun . ' sudah pernah disimpan';

                    $data['dtcreate_date']    = addslashes($this->input->post('create_date'));
                    $data['dtdocno']          = addslashes($this->input->post('docno'));
                    $data['dtrev']            = addslashes($this->input->post('rev'));
                    $data['dtdept']           = addslashes($this->input->post('dept'));
                    $data['dtdeptabbr']       = addslashes($this->input->post('deptabbr'));
                    $data['dtgugus']          = addslashes($this->input->post('gugus'));
                    $data['dttahun']          = addslashes($this->input->post('tahun'));

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
                        'rev'              => $rev,
                        'dept'             => $dept,
                        'deptabbr'         => $deptabbr,
                        'gugus'            => $gugus,
                        'tahun'            => $tahun,
                    );


                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    if ($cekLevelUserNm == "Auditor") {
                        $stdtl = '0';
                    } else {
                        $stdtl = '1';
                    }

                    // detail
                    $jml = count($this->input->post('dtl_a_nama_mesin'));
                    for ($i = 0; $i < $jml; $i++) {

                        $data6 = array(
                            'headerid'   => $max_hdr_id,
                            'stdtl'      => $stdtl,

                            'nama_mesin' => $dtl_a_nama_mesin[$i],
                            'kode_mesin' => $dtl_a_kode_mesin[$i],
                            'frekuensi'  => $dtl_a_frekuensi[$i],
                            'jenis_oli'  => $dtl_a_jenis_oli[$i],
                            'volume'     => $dtl_a_volume[$i],
                            'month1'     => $dtl_a_month1[$i],
                            'month2'     => $dtl_a_month2[$i],
                            'month3'     => $dtl_a_month3[$i],
                            'month4'     => $dtl_a_month4[$i],
                            'month5'     => $dtl_a_month5[$i],
                            'month6'     => $dtl_a_month6[$i],
                            'month7'     => $dtl_a_month7[$i],
                            'month8'     => $dtl_a_month8[$i],
                            'month9'     => $dtl_a_month9[$i],
                            'month10'    => $dtl_a_month10[$i],
                            'month11'    => $dtl_a_month11[$i],
                            'month12'    => $dtl_a_month12[$i],
                            'ket'        => $dtl_a_ket[$i],
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
                    $tahun = $dtheaderrow->tahun;
                    $dept = $dtheaderrow->dept;
                }

                $data['list_month']             = $this->model->get_month($tahun);
                $data['list_mesin_frmfss064']   = $this->model->get_mesin_frmfss064($dept);
                foreach ($data['list_mesin_frmfss064'] as $mesin_frmfss064_row) {
                    $vnama_mesin = $mesin_frmfss064_row->nama_mesin;
                }
                $data['list_kode_frmfss064']   = $this->model->get_kode_frmfss064($dept, $vnama_mesin);

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail           = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail           = $this->model->get_detail_byid($id);
                }

                $data8  = array('dtdetail' => $dtdetail);
                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
            } else {

                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $rev, $dept, $deptabbr, $gugus, $tahun, $headerid);

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
                            $jml = count($this->input->post('dtl_a_nama_mesin'));
                            for ($i = 0; $i < $jml; $i++) {

                                foreach ($list_month as $list_month_row) {
                                    if (${'dtl_a_month' . $list_month_row->month}[$i] != '') {
                                        if (date("Y-m-d", strtotime(${'dtl_a_month' . $list_month_row->month}[$i])) != '1970-01-01') {
                                            ${'vdtl_a_month' . $list_month_row->month}[$i]   = date("Y-m-d", strtotime(${'dtl_a_month' . $list_month_row->month}[$i]));
                                        } else {
                                            ${'vdtl_a_month' . $list_month_row->month}[$i]   = NULL;
                                        }
                                    } else {
                                        ${'vdtl_a_month' . $list_month_row->month}[$i]   = NULL;
                                    }
                                }
                                if (isset($detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'      => $stdtl,

                                        'nama_mesin' => $dtl_a_nama_mesin[$i],
                                        'kode_mesin' => $dtl_a_kode_mesin[$i],
                                        'frekuensi'  => $dtl_a_frekuensi[$i],
                                        'jenis_oli'  => $dtl_a_jenis_oli[$i],
                                        'volume'     => $dtl_a_volume[$i],
                                        'month1'     => $vdtl_a_month1[$i],
                                        'month2'     => $vdtl_a_month2[$i],
                                        'month3'     => $vdtl_a_month3[$i],
                                        'month4'     => $vdtl_a_month4[$i],
                                        'month5'     => $vdtl_a_month5[$i],
                                        'month6'     => $vdtl_a_month6[$i],
                                        'month7'     => $vdtl_a_month7[$i],
                                        'month8'     => $vdtl_a_month8[$i],
                                        'month9'     => $vdtl_a_month9[$i],
                                        'month10'    => $vdtl_a_month10[$i],
                                        'month11'    => $vdtl_a_month11[$i],
                                        'month12'    => $vdtl_a_month12[$i],
                                        'ket'        => $dtl_a_ket[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtlx($detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl($detail_id[$i], $data6);
                                        $this->model->update_dtlx($detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'   => $headerid,
                                        'stdtl'      => $stdtl,

                                        'nama_mesin' => $dtl_a_nama_mesin[$i],
                                        'kode_mesin' => $dtl_a_kode_mesin[$i],
                                        'frekuensi'  => $dtl_a_frekuensi[$i],
                                        'jenis_oli'  => $dtl_a_jenis_oli[$i],
                                        'volume'     => $dtl_a_volume[$i],
                                        'month1'     => $vdtl_a_month1[$i],
                                        'month2'     => $vdtl_a_month2[$i],
                                        'month3'     => $vdtl_a_month3[$i],
                                        'month4'     => $vdtl_a_month4[$i],
                                        'month5'     => $vdtl_a_month5[$i],
                                        'month6'     => $vdtl_a_month6[$i],
                                        'month7'     => $vdtl_a_month7[$i],
                                        'month8'     => $vdtl_a_month8[$i],
                                        'month9'     => $vdtl_a_month9[$i],
                                        'month10'    => $vdtl_a_month10[$i],
                                        'month11'    => $vdtl_a_month11[$i],
                                        'month12'    => $vdtl_a_month12[$i],
                                        'ket'        => $dtl_a_ket[$i],
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

                        $dtl_a_chk = $this->input->post('dtl_a_chk');
                        $jml = count($this->input->post('dtl_a_chk'));

                        if ($cekLevelUserNm == 'Auditor') {
                            for ($i = 0; $i < $jml; $i++) {
                                $this->model->update_stdtlx($dtl_a_chk[$i]);
                            }
                        } else {
                            for ($i = 0; $i < $jml; $i++) {
                                // delete scheduled
                                $this->model->delete_trans($dtl_a_chk[$i], $headerid, $frmkode);

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
