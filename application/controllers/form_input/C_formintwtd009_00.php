<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formintwtd009_00 extends CI_Controller
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
            $dept  = $this->input->post('dept');

            $dthasil      = $this->model->get_docno(date("m", strtotime($create_date)), date("Y", strtotime($create_date)));

            $last_docno   = !empty($dthasil->vdocno) ? $dthasil->vdocno + 1 : 1;

            $arr_bulan    = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            $docno        = 'CPTL/' . $dept . '/' . date("Y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))];

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
            $dept           = $this->input->post('dept');
            $create_date      = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y

            $dthasil        = $this->model->get_nama_mesin($dept);
            // print_r($dthasil);
            // die;

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
            $dept           = $this->input->post('dept');
            $create_date    = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y
            $nama_mesin     = $this->input->post('nama_mesin');

            // print_r($nama_mesin);
            // die;

            $dthasil        = $this->model->get_kode_mesin($dept, $nama_mesin);

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
    function get_list_item()
    {
        if ($this->session->userdata('logged_in')) {
            $create_date    =  date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));
            $kode_mesin     = $this->input->post('kode_mesin');
            // $bulan          = $this->input->post('bulan');
            $monthNumber    = $this->input->post('monthNumber');
            $tahun          = date("Y");
            $date_calender  = $this->model->get_date_calender($monthNumber, $tahun);
            // $dt_komponen      = $this->model->get_item_mesin($create_date, $nama_mesin);
            $dt_komponen    = $this->model->get_list_komponen($create_date, $kode_mesin);
            // print_r($dt_komponen);
            // die;

            if (!empty($dt_komponen)) {
                $hasil = array(
                    'status'        => 0,
                    'vstatus'       => 'success',
                    'data'          => $dt_komponen,
                    'dt_calender'   => $date_calender,
                );
            } else {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'error',
                    'pesan'   => "Data Tidak Ditemukan!",
                );
            }
            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
    function get_item_mesin()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data         = $this->session->userdata('logged_in');
            $dept                 = $this->input->post('dept');
            // $id_jns_mesin         = $this->input->post('id_jns_mesin');
            // $id_gugus             = $this->input->post('id_gugus');
            $create_date          = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y
            // print_r($create_date);
            // die;

            // $dthasil_list_mesin   = $this->model->get_item_mesin($dept, $id_jns_mesin, $create_date);
            $dthasil_list_mesin   = $this->model->get_item_mesin($dept,  $create_date);

            if (count($dthasil_list_mesin) > 0) {
                $pesan = "Berhasil mengambil data!";
                $pesan .= !empty($dthasil_list_mesin) ? "\n MASTER ITEM MESIN ✔" : "\n MASTER ITEM MESIN ✘";
                $hasil = array(
                    'status'     => 0,
                    'vstatus'    => 'success',
                    'pesan'      => $pesan,
                    'data'       => $dthasil_list_mesin,
                );
            } else {
                $hasil = array(
                    'status'     => 1,
                    'vstatus'    => 'error',
                    'pesan'      => "Data Tidak Ditemukan!!",
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

            $data['dtdept']       = $this->M_forminput->get_records_payroll($BagianAkses);

            // data hedder
            $headerid           = addslashes($this->input->post('headerid'));

            $complete_userid    = $session_data['userid'];
            $complete_date      = date('Y-m-d');
            $complete_time      = date('H:i:s');
            $complete_by        = $session_data['nmlengkap'];
            $complete_comp      = $this->session->userdata('hostname'); // versi user original

            $create_date        = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y
            $docno              = addslashes($this->input->post('docno'));
            $kode_mesin         = addslashes($this->input->post('kode_mesin'));
            // $rev                  = addslashes($this->input->post('rev'));
            $dept               = addslashes($this->input->post('dept'));
            $deptabbr           = addslashes($this->input->post('deptabbr'));
            $gugus              = addslashes($this->input->post('gugus'));
            // $id_gugus             = addslashes($this->input->post('id_gugus'));
            $jns_mesin          = addslashes($this->input->post('jns_mesin'));
            $nama_mesin         = addslashes($this->input->post('nama_mesin'));
            $bulan              = addslashes($this->input->post('bulan'));
            $jenis_trafo        = addslashes($this->input->post('jenis_trafo'));

            //data detail
            $dtl_a_detail_id        = $this->input->post('dtl_a_detail_id');
            $dtl_a_nama_bagian      = $this->input->post('dtl_a_nama_bagian');
            $dtl_a_day1             = $this->input->post('dtl_a_day1');
            $dtl_a_day2             = $this->input->post('dtl_a_day2');
            $dtl_a_day3             = $this->input->post('dtl_a_day3');
            $dtl_a_day4             = $this->input->post('dtl_a_day4');
            $dtl_a_day5             = $this->input->post('dtl_a_day5');
            $dtl_a_day6             = $this->input->post('dtl_a_day6');
            $dtl_a_day7             = $this->input->post('dtl_a_day7');
            $dtl_a_day8             = $this->input->post('dtl_a_day8');
            $dtl_a_day9             = $this->input->post('dtl_a_day9');
            $dtl_a_day10            = $this->input->post('dtl_a_day10');
            $dtl_a_day11            = $this->input->post('dtl_a_day11');
            $dtl_a_day12            = $this->input->post('dtl_a_day12');
            $dtl_a_day13            = $this->input->post('dtl_a_day13');
            $dtl_a_day14            = $this->input->post('dtl_a_day14');
            $dtl_a_day15            = $this->input->post('dtl_a_day15');
            $dtl_a_day16            = $this->input->post('dtl_a_day16');
            $dtl_a_day17            = $this->input->post('dtl_a_day17');
            $dtl_a_day18            = $this->input->post('dtl_a_day18');
            $dtl_a_day19            = $this->input->post('dtl_a_day19');
            $dtl_a_day20            = $this->input->post('dtl_a_day20');
            $dtl_a_day21            = $this->input->post('dtl_a_day21');
            $dtl_a_day22            = $this->input->post('dtl_a_day22');
            $dtl_a_day23            = $this->input->post('dtl_a_day23');
            $dtl_a_day24            = $this->input->post('dtl_a_day24');
            $dtl_a_day25            = $this->input->post('dtl_a_day25');
            $dtl_a_day26            = $this->input->post('dtl_a_day26');
            $dtl_a_day27            = $this->input->post('dtl_a_day27');
            $dtl_a_day28            = $this->input->post('dtl_a_day28');
            $dtl_a_day29            = $this->input->post('dtl_a_day29');
            $dtl_a_day30            = $this->input->post('dtl_a_day30');
            $dtl_a_day31            = $this->input->post('dtl_a_day31');
            $dtl_a_ket            = $this->input->post('dtl_a_ket');

            for ($i = 1; $i <= 14; $i++) {
                ${'dtl_a_komponen' . $i}   = $this->input->post('dtl_a_komponen' . $i);
            }

            if ($frmaksi == 'dtsave') {
                // $cekheader = $this->model->check($create_date, $docno, $rev, $dept, $deptabbr, $id_gugus, $nama_mesin);
                $cekheader = $this->model->check($create_date, $docno, $dept, $deptabbr,  $nama_mesin);

                // cek kalau create date dan docno sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    // pesan gagal krn data sudah ada
                    $data['message']          = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ', No Dokumen : ' . $docno .  ', Dept : ' . $deptabbr . ', Gugus : ' . $gugus . ' dan Jenis Mesin : ' . $jns_mesin . ' sudah pernah disimpan';

                    $data['dtcreate_date']    = addslashes($this->input->post('create_date'));
                    $data['dtdocno']          = addslashes($this->input->post('docno'));
                    $data['dtdept']           = addslashes($this->input->post('dept'));
                    $data['dtdeptabbr']       = addslashes($this->input->post('deptabbr'));
                    $data['dtgugus']          = addslashes($this->input->post('gugus'));
                    // $data['dtid_gugus']       = addslashes($this->input->post('id_gugus'));
                    $data['dtkode_mesin']    = addslashes($this->input->post('kode_mesin'));
                    $data['dtjns_mesin']      = addslashes($this->input->post('jns_mesin'));
                    $data['dtnama_mesin']     = addslashes($this->input->post('nama_mesin'));
                    $data['dtbulan']          = addslashes($this->input->post('bulan'));

                    $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
                } else {
                    $data5 = array(
                        'complete_userid' => $complete_userid,
                        'complete_by'     => $complete_by,
                        'complete_date'   => $complete_date,
                        'complete_time'   => $complete_time,
                        'complete_comp'   => $complete_comp,

                        'complete_useridx' => $complete_userid,
                        'complete_byx'     => $complete_by,
                        'complete_datex'   => $complete_date,
                        'complete_timex'   => $complete_time,
                        'complete_compx'   => $complete_comp,     // versi user audit

                        'status_detail'  => '0',
                        'status_detailx' => '0',

                        'create_date' => $create_date,
                        'docno'       => $docno,
                        'kode_mesin'  => $kode_mesin,
                        'nama_mesin'  => $nama_mesin,
                        'bulan'       => $bulan,
                        'jenis_trafo' => $jenis_trafo,
                        'dept'        => $dept,
                        'deptabbr'    => $deptabbr,

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

                        if ($dtl_a_pj_id[$i] != '') {
                            $dt_pj_by = $this->M_tambahan->get_pj_by($dtl_a_pj_id[$i]);

                            $pj_personalstatus[$i] = $dt_pj_by->personalstatus;
                            $pj_personalid[$i]     = $dt_pj_by->personalid;
                            $pj_nik[$i]            = $dt_pj_by->nik;
                            $pj_nama[$i]           = $dt_pj_by->nama;
                        } else {
                            $pj_personalstatus[$i] = null;
                            $pj_personalid[$i]     = null;
                            $pj_nik[$i]            = null;
                            $pj_nama[$i]           = null;
                        }

                        $data6 = array(
                            'headerid'          => $max_hdr_id,
                            'stdtl'             => $stdtl,

                            'nama_mesin'        => $dtl_a_nama_mesin[$i],
                            'kode_mesin'        => $dtl_a_kode_mesin[$i],
                            'frekuensi'         => $dtl_a_frekuensi[$i],
                            'komponen1'         => $dtl_a_komponen1[$i],
                            'komponen2'         => $dtl_a_komponen2[$i],
                            'komponen3'         => $dtl_a_komponen3[$i],
                            'komponen4'         => $dtl_a_komponen4[$i],
                            'komponen5'         => $dtl_a_komponen5[$i],
                            'komponen6'         => $dtl_a_komponen6[$i],
                            'komponen7'         => $dtl_a_komponen7[$i],
                            'komponen8'         => $dtl_a_komponen8[$i],
                            'komponen9'         => $dtl_a_komponen9[$i],
                            'komponen10'        => $dtl_a_komponen10[$i],
                            'komponen11'        => $dtl_a_komponen11[$i],
                            'komponen12'        => $dtl_a_komponen12[$i],
                            'komponen13'        => $dtl_a_komponen13[$i],
                            'komponen14'        => $dtl_a_komponen14[$i],
                            'pj_id'             => $dtl_a_pj_id[$i],
                            'pj_personalstatus' => $pj_personalstatus[$i],
                            'pj_personalid'     => $pj_personalid[$i],
                            'pj_nik'            => $pj_nik[$i],
                            'pj_nama'           => $pj_nama[$i],
                            'ket'               => $dtl_a_ket[$i],
                            'jam_operasi'       => $dtl_a_jam_operasi[$i],
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
                // print_r($dtheader);
                // die;
                $data7       = array('dtheader' => $dtheader);

                foreach ($dtheader as $dtheaderrow) {
                    $dtcreate_date    = $dtheaderrow->create_date;
                    $dtdept           = $dtheaderrow->deptabbr;
                    $dtkode_mesin     = $dtheaderrow->kode_mesin;
                    // $dtid_jns_mesin   = $dtheaderrow->id_jns_mesin;
                    $dtnama_mesin     = $dtheaderrow->nama_mesin;
                    // $dtid_gugus       = $dtheaderrow->id_gugus;
                }

                $data['list_pj']            = $this->M_tambahan->get_list_pj($dtcreate_date, $frmnm);
                // $data['dtkomponenmesin']    = $this->model->get_all_komponenmesin($BagianAkses);
                $data['dtnama_mesin']      = $this->model->get_nama_mesin($dtdept);
                // $data['dtgugus']            = $this->model->get_gugus_by($dtdept, $dtid_jns_mesin, $dtcreate_date);
                // $data['dtitem_mesin']       = $this->model->get_item_mesin($dtdept, $dtid_jns_mesin, $dtid_gugus, $dtcreate_date);
                $data['dtitem_mesin']       = $this->model->get_item_mesin($dtdept,   $dtcreate_date);

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail           = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail           = $this->model->get_detail_byid($id);
                }

                $data8  = array('dtdetail' => $dtdetail);
                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
            } else {

                if (isset($_POST['btnproses'])) {
                    // $cekheader = $this->model->check2($create_date, $docno, $rev, $dept, $deptabbr, $id_gugus, $id_jns_mesin, $headerid);
                    $cekheader = $this->model->check2($create_date, $docno,  $dept, $deptabbr, $headerid);

                    if ($cekheader->num_rows() > 0) {
                        echo "<script>alert('Gagal, Data pada Tanggal Laporan : $create_date , No Dokumen : '.$docno.',  Dept : ' . $deptabbr . ',  dan Jenis Mesin : ' . $jns_mesin . ' sudah pernah disimpan');</script>";
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
                            $jml = count($this->input->post('dtl_a_nama_mesin'));
                            for ($i = 0; $i < $jml; $i++) {

                                if ($dtl_a_pj_id[$i] != '') {
                                    $dt_pj_by = $this->M_tambahan->get_pj_by($dtl_a_pj_id[$i]);

                                    $pj_personalstatus[$i] = $dt_pj_by->personalstatus;
                                    $pj_personalid[$i]     = $dt_pj_by->personalid;
                                    $pj_nik[$i]            = $dt_pj_by->nik;
                                    $pj_nama[$i]           = $dt_pj_by->nama;
                                } else {
                                    $pj_personalstatus[$i] = null;
                                    $pj_personalid[$i]     = null;
                                    $pj_nik[$i]            = null;
                                    $pj_nama[$i]           = null;
                                }

                                if (isset($detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'             => $stdtl,

                                        'nama_mesin'        => $dtl_a_nama_mesin[$i],
                                        'kode_mesin'        => $dtl_a_kode_mesin[$i],
                                        'frekuensi'         => $dtl_a_frekuensi[$i],
                                        'frekuensi'         => $dtl_a_frekuensi[$i],
                                        'komponen1'         => $dtl_a_komponen1[$i],
                                        'komponen2'         => $dtl_a_komponen2[$i],
                                        'komponen3'         => $dtl_a_komponen3[$i],
                                        'komponen4'         => $dtl_a_komponen4[$i],
                                        'komponen5'         => $dtl_a_komponen5[$i],
                                        'komponen6'         => $dtl_a_komponen6[$i],
                                        'komponen7'         => $dtl_a_komponen7[$i],
                                        'komponen8'         => $dtl_a_komponen8[$i],
                                        'komponen9'         => $dtl_a_komponen9[$i],
                                        'komponen10'        => $dtl_a_komponen10[$i],
                                        'komponen11'        => $dtl_a_komponen11[$i],
                                        'komponen12'        => $dtl_a_komponen12[$i],
                                        'komponen13'        => $dtl_a_komponen13[$i],
                                        'komponen14'        => $dtl_a_komponen14[$i],
                                        'pj_id'             => $dtl_a_pj_id[$i],
                                        'pj_personalstatus' => $pj_personalstatus[$i],
                                        'pj_personalid'     => $pj_personalid[$i],
                                        'pj_nik'            => $pj_nik[$i],
                                        'pj_nama'           => $pj_nama[$i],
                                        'ket'               => $dtl_a_ket[$i],
                                        'jam_operasi'       => $dtl_a_jam_operasi[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtlx($detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl($detail_id[$i], $data6);
                                        $this->model->update_dtlx($detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'          => $headerid,
                                        'stdtl'             => $stdtl,

                                        'nama_mesin'        => $dtl_a_nama_mesin[$i],
                                        'kode_mesin'        => $dtl_a_kode_mesin[$i],
                                        'frekuensi'         => $dtl_a_frekuensi[$i],
                                        'komponen1'         => $dtl_a_komponen1[$i],
                                        'komponen2'         => $dtl_a_komponen2[$i],
                                        'komponen3'         => $dtl_a_komponen3[$i],
                                        'komponen4'         => $dtl_a_komponen4[$i],
                                        'komponen5'         => $dtl_a_komponen5[$i],
                                        'komponen6'         => $dtl_a_komponen6[$i],
                                        'komponen7'         => $dtl_a_komponen7[$i],
                                        'komponen8'         => $dtl_a_komponen8[$i],
                                        'komponen9'         => $dtl_a_komponen9[$i],
                                        'komponen10'        => $dtl_a_komponen10[$i],
                                        'komponen11'        => $dtl_a_komponen11[$i],
                                        'komponen12'        => $dtl_a_komponen12[$i],
                                        'komponen13'        => $dtl_a_komponen13[$i],
                                        'komponen14'        => $dtl_a_komponen14[$i],
                                        'pj_id'             => $dtl_a_pj_id[$i],
                                        'pj_personalstatus' => $pj_personalstatus[$i],
                                        'pj_personalid'     => $pj_personalid[$i],
                                        'pj_nik'            => $pj_nik[$i],
                                        'pj_nama'           => $pj_nama[$i],
                                        'ket'               => $dtl_a_ket[$i],
                                        'jam_operasi'       => $dtl_a_jam_operasi[$i],
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
