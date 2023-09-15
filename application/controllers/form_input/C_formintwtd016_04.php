<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formintwtd016_04 extends CI_Controller
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

    function get_list_item()
    {
        if ($this->session->userdata('logged_in')) {
            $id           = $this->input->post('headerid_form');
            $kode_form    = $this->input->post('kode_form');
            $periode            = explode("-",$this->input->post('periode'));
            $bulan              = $periode[0];
            $tahun              = $periode[1];

            $date_calender      = $this->model->get_date_calender($bulan, $tahun);
            $dt_transfer      = $this->model->get_trans_byid($id, $kode_form);

            if (!empty($dt_transfer)) {
                $hasil = array(
                    'status'        => 0,
                    'vstatus'       => 'success',
                    'data'          => $dt_transfer,
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
    function get_list_schedule()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data       = $this->session->userdata('logged_in');
            $create_date        = date("Y-m-d", strtotime($this->input->post('create_date')));
            $periode            = explode("-",$this->input->post('periode'));
            $bulan              = $periode[0];
            $tahun              = $periode[1];

            $date_calender      = $this->model->get_date_calender($bulan, $tahun);
            $result_frmfss188   = $this->model->get_dtfrmfss188_by($bulan, $tahun, $create_date);

            if (!empty($result_frmfss188)) {
                $pesan = "Berhasil mengambil data!";
                $pesan .= !empty($result_frmfss188) ? "\n FRM-FSS-188 ✔" : "\n FRM-FSS-188 ✘";
                $hasil = array(
                    'status'     => 0,
                    'vstatus'    => 'success',
                    'pesan'      => $pesan,
                    'dtcalender' => $date_calender,
                    'data'       => $result_frmfss188,
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
    function save_modal_schedule()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data         = $this->session->userdata('logged_in');
            $modal_headerid       = addslashes($this->input->post('modal_headerid'));
            $modal_kodeform       = addslashes($this->input->post('modal_kodeform'));
            $mdl1_detail_id       = $this->input->post('mdl1_detail_id');
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
            for ($mdl_i=0; $mdl_i < $jml_dtl_mdl; $mdl_i++) { 
                if (isset($mdl1_tgl_schedule2[$mdl_i])) {
                        $v_mdl1_tgl_schedule2[$mdl_i] = $mdl1_tgl_schedule2[$mdl_i];
                    } else {
                        $v_mdl1_tgl_schedule2[$mdl_i] = NULL;
                    }
                $data_mdl = array(
                    'nama'          => $mdl1_point[$mdl_i],
                    'kode'          => $mdl1_kode[$mdl_i],
                    'frequency'     => $mdl1_frequency[$mdl_i],
                    'pic'           => $mdl1_pic[$mdl_i],
                    'tgl_schedule'  => $v_mdl1_tgl_schedule2[$mdl_i],
                    'headerid_form' => $modal_headerid,
                    'kode_form'     => $modal_kodeform,
                );
                if($mdl1_detail_id[$mdl_i] != ''){
                    $pesan = "Data berhasil diupdate";
                    $this->model->update_trans($mdl1_detail_id[$mdl_i], $data_mdl);
                }else{
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
            $frmaksi                = $this->uri->segment(6);

            $dtfrm                  = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                  = array('dtfrm' => $dtfrm);

            foreach ($dtfrm as $dt_form) {
                $frmnm              = $dt_form->formnm;
            }

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
            $periode                = addslashes($this->input->post('periode'));

            //data detail
            $dtl_a_detail_id        = $this->input->post('dtl_a_detail_id');
            $dtl_a_shift            = $this->input->post('dtl_a_shift');
            $dtl_a_jam              = $this->input->post('dtl_a_jam');
            $dtl_a_tanggal          = $this->input->post('dtl_a_tanggal');
            $dtl_a_uraian           = $this->input->post('dtl_a_uraian');
            $dtl_a_tindakan         = $this->input->post('dtl_a_tindakan');
            $dtl_a_pj_id            = $this->input->post('dtl_a_pj_id');
            $dtl_a_keterangan       = $this->input->post('dtl_a_keterangan');


            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno, $rev, $periode);

                // cek kalau create date dan docno sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    // pesan gagal krn data sudah ada
                    $data['message']          = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ' dan No Dokumen : ' . $docno . ' sudah pernah disimpan';

                    $data['dtcreate_date']    = addslashes($this->input->post('create_date'));
                    $data['dtdocno']          = addslashes($this->input->post('docno'));
                    $data['dtrev']            = addslashes($this->input->post('rev'));
                    $data['dtperiode']        = addslashes($this->input->post('periode'));

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
                        'periode'          => $periode,
                    );


                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    if ($cekLevelUserNm == "Auditor") {
                        $stdtl = '0';
                    } else {
                        $stdtl = '1';
                    }

                    //detail d
                    $jml = count($this->input->post('dtl_a_jam'));
                    for ($i = 0; $i < $jml; $i++) {

                        if ($dtl_a_pj_id[$i] != '') {
                            $dt_pj_by = $this->model->get_pj_by($dtl_a_pj_id[$i]);

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

                        if($dtl_a_tanggal[$i] != ''){
                            if(date('Y-m-d',strtotime($dtl_a_tanggal[$i])) != '1970-01-01'){
                                $vdtl_a_tanggal[$i] = date('Y-m-d',strtotime($dtl_a_tanggal[$i]));
                            }else{
                                $vdtl_a_tanggal[$i] = NULL;
                            }
                        }else{
                            $vdtl_a_tanggal[$i] = NULL;
                        }
                        $data6 = array(
                            'headerid'          => $max_hdr_id,
                            'stdtl'             => $stdtl,

                            'shift'             => $dtl_a_shift[$i],

                            'jam'               => $dtl_a_jam[$i],
                            'tanggal'           => $vdtl_a_tanggal[$i],
                            'tindakan'          => $dtl_a_tindakan[$i],

                            'pj_id'             => $dtl_a_pj_id[$i],
                            'pj_personalstatus' => $pj_personalstatus[$i],
                            'pj_personalid'     => $pj_personalid[$i],
                            'pj_nik'            => $pj_nik[$i],
                            'pj_nama'           => $pj_nama[$i],
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
                    $periode        = explode("-", $dtheaderrow->periode);
                    $bulan          = $periode[0];
                    $tahun          = $periode[1];
                }
                $data['date_calender']      = $this->model->get_date_calender($bulan, $tahun);
                $data['result_list_item']   = $this->model->get_list_item($create_date);

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail   = $this->model->get_detail_byidx($id);
                    $dtdetail2  = $this->model->get_dtfrmfss188x_by($bulan, $tahun, $create_date, $id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid($id);
                    $dtdetail2  = $this->model->get_dtfrmfss188_by($bulan, $tahun, $create_date, $id);
                }

                $data8  = array('dtdetail' => $dtdetail,'dtdetail2' => $dtdetail2);
                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
            } else {

                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $rev, $periode, $headerid);

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
                            // detail d
                            $jml = count($this->input->post('dtl_a_uraian'));
                            for ($i1 = 0; $i1 < $jml; $i1++) {

                                if ($dtl_a_pj_id[$i1] != '') {
                                    $dt_pj_by              = $this->model->get_pj_by($dtl_a_pj_id[$i1]);
                                    $pj_personalstatus[$i1] = $dt_pj_by->personalstatus;
                                    $pj_personalid[$i1]     = $dt_pj_by->personalid;
                                    $pj_nik[$i1]            = $dt_pj_by->nik;
                                    $pj_nama[$i1]           = $dt_pj_by->nama;
                                } else {
                                    $pj_personalstatus[$i1] = null;
                                    $pj_personalid[$i1]     = null;
                                    $pj_nik[$i1]            = null;
                                    $pj_nama[$i1]           = null;
                                }
                                if($dtl_a_tanggal[$i1] != ''){
                                    $vdtl_a_tanggal[$i1] = date('Y-m-d',strtotime($dtl_a_tanggal[$i1]));
                                }else{
                                    $vdtl_a_tanggal[$i1] = NULL;
                                }

                                $data6 = array(
                                    'stdtl'    => $stdtl,
                                    'headerid'          => $headerid,

                                    'shift'             => $dtl_a_shift[$i1],
                                    'jam'               => $dtl_a_jam[$i1],
                                    'tanggal'           => $vdtl_a_tanggal[$i1],
                                    'uraian'            => $dtl_a_uraian[$i1],
                                    'tindakan'          => $dtl_a_tindakan[$i1],
                                    'keterangan'        => $dtl_a_keterangan[$i1],

                                    'pj_id'             => $dtl_a_pj_id[$i1],
                                    'pj_personalstatus' => $pj_personalstatus[$i1],
                                    'pj_personalid'     => $pj_personalid[$i1],
                                    'pj_nik'            => $pj_nik[$i1],
                                    'pj_nama'           => $pj_nama[$i1],


                                );

                                if (isset($dtl_a_detail_id[$i1])) { // gak selalu deklar, baris baru gak ada input dtl_a_detail_id
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtlx($dtl_a_detail_id[$i1], $data6);
                                    } else {
                                        $this->model->update_dtl($dtl_a_detail_id[$i1], $data6);
                                        $this->model->update_dtlx($dtl_a_detail_id[$i1], $data6);
                                    }
                                }else{
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
