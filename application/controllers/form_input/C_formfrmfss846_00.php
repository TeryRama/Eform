<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formfrmfss846_00 extends CI_Controller
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

            $docno        = 'DCPR/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' . date("d", strtotime($create_date));

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
    function get_detail_komponen()
    {
        $headerid       = $this->input->post('headerid');
        $create_date    = $this->input->post('create_date');
        $dept           = $this->input->post('dept');
        $id_nama_panel  = $this->input->post('id_nama_panel');
        $kode_panel     = $this->input->post('kode_panel');

        $dt_detail_b = $this->M_formfrmfss846_00->get_detail_byid_b($headerid);
        $dt_komponen = $this->M_formfrmfss846_00->get_nama_komponen($dept, $id_nama_panel);
        $hasil = array(
                    'list_komponen' => $dt_komponen, 
                    'list_detail_b' => $dt_detail_b, 
                );

        echo json_encode($hasil);
    }
    function get_jenis_mesin_by()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data   = $this->session->userdata('logged_in');
            $dept           = $this->input->post('dept');
            $item           = $this->input->post('item');
            $create_date      = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y

            $dthasil        = $this->model->get_jenis_mesin_by($dept, $create_date);

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
    function get_kode_by()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data         = $this->session->userdata('logged_in');
            $dept                 = $this->input->post('dept');
            $id_nama_panel         = $this->input->post('id_nama_panel');
            $create_date          = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y

            $dthasil              = $this->model->get_kode_by($dept, $id_nama_panel, $create_date);

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
    function get_lokasi_by()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data         = $this->session->userdata('logged_in');
            $dept                 = $this->input->post('dept');
            $id_nama_panel         = $this->input->post('id_nama_panel');
            $create_date          = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y

            $dthasil              = $this->model->get_lokasi_by($dept, $id_nama_panel, $create_date);

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
    function get_itemmesin()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data         = $this->session->userdata('logged_in');
            $dept                 = $this->input->post('dept');
            $id_nama_panel        = $this->input->post('id_nama_panel');
            $kode_panel           = $this->input->post('kode_panel');
            $lokasi_panel         = $this->input->post('lokasi_panel');
            $create_date          = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y
            $bulan                = date("m", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y
            $tahun                = date("Y", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y

            $dthasil_list_mesin   = $this->model->get_itemmesin($dept, $id_nama_panel, $kode_panel, $lokasi_panel);
            $dthasil_list_date    = $this->model->get_date_calender($bulan, $tahun);

            if(count($dthasil_list_date) > 0){
                $pesan = "Berhasil mengambil data!";
                $pesan .= !empty($dthasil_list_mesin) ? "\n FRM-FSS-845 ✔" : "\n FRM-FSS-845 ✘";
                $hasil = array(
                    'status'    => 0,
                    'vstatus'   => 'success',
                    'pesan'     => $pesan,
                    'data'      => $dthasil_list_mesin,
                    'data_date' => $dthasil_list_date,
                    'bulan'     => $bulan,
                    'tahun'     => $tahun,
                );
            }else{
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

            $data['dtdept']         = $this->M_forminput->get_records_payroll($BagianAkses);
            
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
            $kode_panel             = addslashes($this->input->post('kode_panel'));
            $id_kode_panel          = addslashes($this->input->post('id_kode_panel'));
            $nama_panel             = addslashes($this->input->post('nama_panel'));
            $id_nama_panel          = addslashes($this->input->post('id_nama_panel'));
            $lokasi_panel           = addslashes($this->input->post('lokasi_panel'));

            //data detail
            $detail_id              = $this->input->post('detail_id');
            $dtl_a_waktu_tanggal    = $this->input->post('dtl_a_waktu_tanggal');
            $dtl_a_waktu_jam        = $this->input->post('dtl_a_waktu_jam');
            $dtl_a_kabel_induk_a    = $this->input->post('dtl_a_kabel_induk_a');
            $dtl_a_kabel_induk_c    = $this->input->post('dtl_a_kabel_induk_c');
            for ($i=1; $i <= 15; $i++) { 
                ${'dtl_a_kabel_induk_a'.$i}    = $this->input->post('dtl_a_kabel_induk_a'.$i);
                ${'dtl_a_kabel_induk_c'.$i}    = $this->input->post('dtl_a_kabel_induk_c'.$i);
            }
            $dtl_a_busbar           = $this->input->post('dtl_a_busbar');
            $dtl_a_ampere_meter     = $this->input->post('dtl_a_ampere_meter');
            $dtl_a_volt_meter       = $this->input->post('dtl_a_volt_meter');
            $dtl_a_kebersihan       = $this->input->post('dtl_a_kebersihan');
            $dtl_a_ket              = $this->input->post('dtl_a_ket');
            
            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno, $rev, $dept, $deptabbr, $id_kode_panel, $id_nama_panel, $lokasi_panel);

                // cek kalau create date dan docno sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    // pesan gagal krn data sudah ada
                    $data['message']          = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ', No Dokumen : ' . $docno . ', Revisi : ' . $rev . ', Dept : ' . $deptabbr . ', kode_panel : ' . $kode_panel . ' dan Jenis Mesin : ' . $nama_panel . ' sudah pernah disimpan';

                    $data['dtcreate_date']    = addslashes($this->input->post('create_date'));
                    $data['dtdocno']          = addslashes($this->input->post('docno'));
                    $data['dtrev']            = addslashes($this->input->post('rev'));
                    $data['dtdept']           = addslashes($this->input->post('dept'));
                    $data['dtdeptabbr']       = addslashes($this->input->post('deptabbr'));
                    $data['dtkode_panel']     = addslashes($this->input->post('kode_panel'));
                    $data['dtid_kode_panel']  = addslashes($this->input->post('id_kode_panel'));
                    $data['dtnama_panel']     = addslashes($this->input->post('nama_panel'));
                    $data['dtid_nama_panel']  = addslashes($this->input->post('id_nama_panel'));
                    $data['dtlokasi_panel']   = addslashes($this->input->post('lokasi_panel'));

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
                        'kode_panel'       => $kode_panel,
                        'id_kode_panel'    => $id_kode_panel,
                        'nama_panel'       => $nama_panel,
                        'id_nama_panel'    => $id_nama_panel,
                        'lokasi_panel'     => $lokasi_panel,
                    );


                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    if ($cekLevelUserNm == "Auditor") {
                        $stdtl = '0';
                    } else {
                        $stdtl = '1';
                    }

                    // detail
                    $jml = count($this->input->post('dtl_a_waktu_tanggal'));
                    for ($i = 0; $i < $jml; $i++) {
                        
                        $data6 = array(
                            'headerid'        => $max_hdr_id,
                            'stdtl'           => $stdtl,

                            'waktu_tanggal'   => date("Y-m-d", strtotime($dtl_a_waktu_tanggal[$i])),
                            'waktu_jam'       => $dtl_a_waktu_jam[$i],
                            'kabel_induk_a'   => $dtl_a_kabel_induk_a[$i],
                            'kabel_induk_c'   => $dtl_a_kabel_induk_c[$i],
                            'kabel_induk_a1'  => $dtl_a_kabel_induk_a1[$i],
                            'kabel_induk_c1'  => $dtl_a_kabel_induk_c1[$i],
                            'kabel_induk_a2'  => $dtl_a_kabel_induk_a2[$i],
                            'kabel_induk_c2'  => $dtl_a_kabel_induk_c2[$i],
                            'kabel_induk_a3'  => $dtl_a_kabel_induk_a3[$i],
                            'kabel_induk_c3'  => $dtl_a_kabel_induk_c3[$i],
                            'kabel_induk_a4'  => $dtl_a_kabel_induk_a4[$i],
                            'kabel_induk_c4'  => $dtl_a_kabel_induk_c4[$i],
                            'kabel_induk_a5'  => $dtl_a_kabel_induk_a5[$i],
                            'kabel_induk_c5'  => $dtl_a_kabel_induk_c5[$i],
                            'kabel_induk_a6'  => $dtl_a_kabel_induk_a6[$i],
                            'kabel_induk_c6'  => $dtl_a_kabel_induk_c6[$i],
                            'kabel_induk_a7'  => $dtl_a_kabel_induk_a7[$i],
                            'kabel_induk_c7'  => $dtl_a_kabel_induk_c7[$i],
                            'kabel_induk_a8'  => $dtl_a_kabel_induk_a8[$i],
                            'kabel_induk_c8'  => $dtl_a_kabel_induk_c8[$i],
                            'kabel_induk_a9'  => $dtl_a_kabel_induk_a9[$i],
                            'kabel_induk_c9'  => $dtl_a_kabel_induk_c9[$i],
                            'kabel_induk_a10' => $dtl_a_kabel_induk_a10[$i],
                            'kabel_induk_c10' => $dtl_a_kabel_induk_c10[$i],
                            'kabel_induk_a11' => $dtl_a_kabel_induk_a11[$i],
                            'kabel_induk_c11' => $dtl_a_kabel_induk_c11[$i],
                            'kabel_induk_a12' => $dtl_a_kabel_induk_a12[$i],
                            'kabel_induk_c12' => $dtl_a_kabel_induk_c12[$i],
                            'kabel_induk_a13' => $dtl_a_kabel_induk_a13[$i],
                            'kabel_induk_c13' => $dtl_a_kabel_induk_c13[$i],
                            'kabel_induk_a14' => $dtl_a_kabel_induk_a14[$i],
                            'kabel_induk_c14' => $dtl_a_kabel_induk_c14[$i],
                            'kabel_induk_a15' => $dtl_a_kabel_induk_a15[$i],
                            'kabel_induk_c15' => $dtl_a_kabel_induk_c15[$i],
                            'busbar'          => $dtl_a_busbar[$i] == '' ? NULL : $dtl_a_busbar[$i],
                            'ampere_meter'    => $dtl_a_ampere_meter[$i] == '' ? NULL : $dtl_a_ampere_meter[$i],
                            'volt_meter'      => $dtl_a_volt_meter[$i] == '' ? NULL : $dtl_a_volt_meter[$i],
                            'kebersihan'      => $dtl_a_kebersihan[$i] == '' ? NULL : $dtl_a_kebersihan[$i],
                            'ket'             => $dtl_a_ket[$i],
                            
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
                    $dtcreate_date    = $dtheaderrow->create_date;
                    $dtdept           = $dtheaderrow->dept;
                    $dtid_nama_panel  = $dtheaderrow->id_nama_panel;
                    $dtid_kode_panel  = $dtheaderrow->kode_panel;
                    $dtlokasi_panel   = $dtheaderrow->lokasi_panel;
                }

                $data['list_pj']            = $this->M_tambahan->get_list_pj($dtcreate_date, $frmnm);
                $data['dtkomponenmesin']    = $this->model->get_all_komponenmesin($BagianAkses);
                $data['dtjenis_mesin']      = $this->model->get_jenis_mesin_by($dtdept, $dtcreate_date);
                $data['dtkode']             = $this->model->get_kode_by($dtdept, $dtid_nama_panel, $dtcreate_date);
                $data['dtlokasi']           = $this->model->get_lokasi_by($dtdept, $dtid_nama_panel, $dtcreate_date);
                $data['dtitem_mesin']       = $this->model->get_itemmesin($dtdept, $dtid_nama_panel, $dtid_kode_panel, $dtlokasi_panel);
                
                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail           = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail           = $this->model->get_detail_byid($id);
                }

                $data8  = array('dtdetail' => $dtdetail);
                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
            } else {

                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $rev, $dept, $deptabbr, $id_kode_panel, $id_nama_panel, $lokasi_panel, $headerid);

                    if ($cekheader->num_rows() > 0) {
                        echo "<script>alert('Gagal, Data pada Tanggal Laporan : $create_date , No Dokumen : '.$docno.', Revisi : ' . $rev . ', Dept : ' . $deptabbr . ', kode_panel : ' . $kode_panel . ' dan Jenis Mesin : ' . $nama_panel . ' sudah pernah disimpan');</script>";
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
                                            'complete_compx'   => $complete_comp, // versi user audit

                                            // 'app1_userid'         => $complete_userid,
                                            // 'app1_by'             => $complete_by,
                                            // 'app1_date'           => $complete_date,
                                            // 'app1_time'           => $complete_time,
                                            // 'app1_position'       => $session_data['jabnm'],
                                            // 'app1_personalid'     => $session_data['personalid'],
                                            // 'app1_personalstatus' => $session_data['personalstatus'],
                                            // 'app1_status'         => '1',
                                            // 'app1_comp'           => $complete_comp, // versi user original

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
                            $jml = count($this->input->post('dtl_a_waktu_tanggal'));
                            for ($i = 0; $i < $jml; $i++) {

                                if (isset($detail_id[$i])) {
                                    
                                    $data6 = array(
                                        'stdtl'           => $stdtl,

                                        'waktu_tanggal'   => date("Y-m-d", strtotime($dtl_a_waktu_tanggal[$i])),
                                        'waktu_jam'       => $dtl_a_waktu_jam[$i],
                                        'kabel_induk_a'   => $dtl_a_kabel_induk_a[$i],
                                        'kabel_induk_c'   => $dtl_a_kabel_induk_c[$i],
                                        'kabel_induk_a1'  => $dtl_a_kabel_induk_a1[$i],
                                        'kabel_induk_c1'  => $dtl_a_kabel_induk_c1[$i],
                                        'kabel_induk_a2'  => $dtl_a_kabel_induk_a2[$i],
                                        'kabel_induk_c2'  => $dtl_a_kabel_induk_c2[$i],
                                        'kabel_induk_a3'  => $dtl_a_kabel_induk_a3[$i],
                                        'kabel_induk_c3'  => $dtl_a_kabel_induk_c3[$i],
                                        'kabel_induk_a4'  => $dtl_a_kabel_induk_a4[$i],
                                        'kabel_induk_c4'  => $dtl_a_kabel_induk_c4[$i],
                                        'kabel_induk_a5'  => $dtl_a_kabel_induk_a5[$i],
                                        'kabel_induk_c5'  => $dtl_a_kabel_induk_c5[$i],
                                        'kabel_induk_a6'  => $dtl_a_kabel_induk_a6[$i],
                                        'kabel_induk_c6'  => $dtl_a_kabel_induk_c6[$i],
                                        'kabel_induk_a7'  => $dtl_a_kabel_induk_a7[$i],
                                        'kabel_induk_c7'  => $dtl_a_kabel_induk_c7[$i],
                                        'kabel_induk_a8'  => $dtl_a_kabel_induk_a8[$i],
                                        'kabel_induk_c8'  => $dtl_a_kabel_induk_c8[$i],
                                        'kabel_induk_a9'  => $dtl_a_kabel_induk_a9[$i],
                                        'kabel_induk_c9'  => $dtl_a_kabel_induk_c9[$i],
                                        'kabel_induk_a10' => $dtl_a_kabel_induk_a10[$i],
                                        'kabel_induk_c10' => $dtl_a_kabel_induk_c10[$i],
                                        'kabel_induk_a11' => $dtl_a_kabel_induk_a11[$i],
                                        'kabel_induk_c11' => $dtl_a_kabel_induk_c11[$i],
                                        'kabel_induk_a12' => $dtl_a_kabel_induk_a12[$i],
                                        'kabel_induk_c12' => $dtl_a_kabel_induk_c12[$i],
                                        'kabel_induk_a13' => $dtl_a_kabel_induk_a13[$i],
                                        'kabel_induk_c13' => $dtl_a_kabel_induk_c13[$i],
                                        'kabel_induk_a14' => $dtl_a_kabel_induk_a14[$i],
                                        'kabel_induk_c14' => $dtl_a_kabel_induk_c14[$i],
                                        'kabel_induk_a15' => $dtl_a_kabel_induk_a15[$i],
                                        'kabel_induk_c15' => $dtl_a_kabel_induk_c15[$i],
                                        'busbar'          => $dtl_a_busbar[$i] == '' ? NULL : $dtl_a_busbar[$i],
                                        'ampere_meter'    => $dtl_a_ampere_meter[$i] == '' ? NULL : $dtl_a_ampere_meter[$i],
                                        'volt_meter'      => $dtl_a_volt_meter[$i] == '' ? NULL : $dtl_a_volt_meter[$i],
                                        'kebersihan'      => $dtl_a_kebersihan[$i] == '' ? NULL : $dtl_a_kebersihan[$i],
                                        'ket'             => $dtl_a_ket[$i],

                                    );
                                    if ($cekLevelUserNm == 'Auditor') {
                                        $this->model->update_dtlx($detail_id[$i], $data6);
                                    } else {
                                        $this->model->update_dtl($detail_id[$i], $data6);
                                        $this->model->update_dtlx($detail_id[$i], $data6);
                                    }
                                } else {

                                    $data6 = array(
                                        'headerid'        => $headerid,
                                        'stdtl'           => $stdtl,

                                        'waktu_tanggal'   => date("Y-m-d", strtotime($dtl_a_waktu_tanggal[$i])),
                                        'waktu_jam'       => $dtl_a_waktu_jam[$i],
                                        'kabel_induk_a'   => $dtl_a_kabel_induk_a[$i],
                                        'kabel_induk_c'   => $dtl_a_kabel_induk_c[$i],
                                        'kabel_induk_a1'  => $dtl_a_kabel_induk_a1[$i],
                                        'kabel_induk_c1'  => $dtl_a_kabel_induk_c1[$i],
                                        'kabel_induk_a2'  => $dtl_a_kabel_induk_a2[$i],
                                        'kabel_induk_c2'  => $dtl_a_kabel_induk_c2[$i],
                                        'kabel_induk_a3'  => $dtl_a_kabel_induk_a3[$i],
                                        'kabel_induk_c3'  => $dtl_a_kabel_induk_c3[$i],
                                        'kabel_induk_a4'  => $dtl_a_kabel_induk_a4[$i],
                                        'kabel_induk_c4'  => $dtl_a_kabel_induk_c4[$i],
                                        'kabel_induk_a5'  => $dtl_a_kabel_induk_a5[$i],
                                        'kabel_induk_c5'  => $dtl_a_kabel_induk_c5[$i],
                                        'kabel_induk_a6'  => $dtl_a_kabel_induk_a6[$i],
                                        'kabel_induk_c6'  => $dtl_a_kabel_induk_c6[$i],
                                        'kabel_induk_a7'  => $dtl_a_kabel_induk_a7[$i],
                                        'kabel_induk_c7'  => $dtl_a_kabel_induk_c7[$i],
                                        'kabel_induk_a8'  => $dtl_a_kabel_induk_a8[$i],
                                        'kabel_induk_c8'  => $dtl_a_kabel_induk_c8[$i],
                                        'kabel_induk_a9'  => $dtl_a_kabel_induk_a9[$i],
                                        'kabel_induk_c9'  => $dtl_a_kabel_induk_c9[$i],
                                        'kabel_induk_a10' => $dtl_a_kabel_induk_a10[$i],
                                        'kabel_induk_c10' => $dtl_a_kabel_induk_c10[$i],
                                        'kabel_induk_a11' => $dtl_a_kabel_induk_a11[$i],
                                        'kabel_induk_c11' => $dtl_a_kabel_induk_c11[$i],
                                        'kabel_induk_a12' => $dtl_a_kabel_induk_a12[$i],
                                        'kabel_induk_c12' => $dtl_a_kabel_induk_c12[$i],
                                        'kabel_induk_a13' => $dtl_a_kabel_induk_a13[$i],
                                        'kabel_induk_c13' => $dtl_a_kabel_induk_c13[$i],
                                        'kabel_induk_a14' => $dtl_a_kabel_induk_a14[$i],
                                        'kabel_induk_c14' => $dtl_a_kabel_induk_c14[$i],
                                        'kabel_induk_a15' => $dtl_a_kabel_induk_a15[$i],
                                        'kabel_induk_c15' => $dtl_a_kabel_induk_c15[$i],
                                        'busbar'          => $dtl_a_busbar[$i] == '' ? NULL : $dtl_a_busbar[$i],
                                        'ampere_meter'    => $dtl_a_ampere_meter[$i] == '' ? NULL : $dtl_a_ampere_meter[$i],
                                        'volt_meter'      => $dtl_a_volt_meter[$i] == '' ? NULL : $dtl_a_volt_meter[$i],
                                        'kebersihan'      => $dtl_a_kebersihan[$i] == '' ? NULL : $dtl_a_kebersihan[$i],
                                        'ket'             => $dtl_a_ket[$i],
                                    );

                                    $this->model->insert_detail($data6);
                                }
                            }
                            // die;

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
