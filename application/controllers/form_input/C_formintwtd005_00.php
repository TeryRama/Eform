<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_formintwtd005_00 extends CI_Controller
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
            $list_hand_pallet = $this->model->get_list_hand_pallet($create_date);

            $last_docno   = !empty($dthasil->vdocno) ? $dthasil->vdocno + 1 : 1;

            $arr_bulan    = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            $docno        = 'CPHP/WTD/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' . str_pad($last_docno, 3, '0', STR_PAD_LEFT);

            $hasil = array(
                'status'           => 0,
                'vstatus'          => 'berhasil',
                'pesan'            => "berhasil!",
                'data'             => $docno,
                'data_hand_pallet' => $list_hand_pallet,
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
            $create_date    = $this->input->post('create_date');
            $kode_pallet    = $this->input->post('kode_pallet');
            $bulan          = $this->input->post('bulan');
            $tahun          = date("Y");

            $date_calender    = $this->model->get_date_calender($bulan, $tahun);
            $dt_komponen      = $this->model->get_list_komponen($create_date, $kode_pallet);

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
            $BagianAkses            = $session_data['bagian_akses'];

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
            $headerid           = addslashes($this->input->post('headerid'));

            $complete_userid    = $session_data['userid'];
            $complete_date      = date('Y-m-d');
            $complete_time      = date('H:i:s');
            $complete_by        = $session_data['nmlengkap'];
            $complete_comp      = $this->session->userdata('hostname'); // versi user original

            $create_date        = date("Y-m-d", strtotime(addslashes($this->input->post('create_date')))); // dari inputan d-m-Y
            $docno              = addslashes($this->input->post('docno'));
            $kode               = addslashes($this->input->post('kode'));
            $kode_name          = addslashes($this->input->post('kode_name'));
            $bulan              = addslashes($this->input->post('bulan'));

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

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno, $kode, $bulan);

                // cek kalau create date dan docno sudah pernah disimpan
                if ($cekheader->num_rows() > 0) {
                    // pesan gagal krn data sudah ada
                    $data['message']          = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ' dan No Dokumen : ' . $docno . ' sudah pernah disimpan';

                    $data['dtcreate_date']    = addslashes($this->input->post('create_date'));
                    $data['dtdocno']          = addslashes($this->input->post('docno'));
                    $data['dtkode']           = addslashes($this->input->post('kode'));
                    $data['dtkode_name']      = addslashes($this->input->post('kode_name'));
                    $data['dtbulan']          = addslashes($this->input->post('bulan'));

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
                        'kode'             => $kode,
                        'kode_name'        => $kode_name,
                        'bulan'            => $bulan,
                    );


                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    if ($cekLevelUserNm == "Auditor") {
                        $stdtl = '0';
                    } else {
                        $stdtl = '1';
                    }

                    //detail d
                    $jml = count($this->input->post('dtl_a_nama_bagian'));
                    for ($i = 0; $i < $jml; $i++) {
                        $data6 = array(
                            'headerid'    => $max_hdr_id,
                            'stdtl'       => $stdtl,

                            'nama_bagian' => $dtl_a_nama_bagian[$i],
                            'day1'        => $dtl_a_day1[$i],
                            'day2'        => $dtl_a_day2[$i],
                            'day3'        => $dtl_a_day3[$i],
                            'day4'        => $dtl_a_day4[$i],
                            'day5'        => $dtl_a_day5[$i],
                            'day6'        => $dtl_a_day6[$i],
                            'day7'        => $dtl_a_day7[$i],
                            'day8'        => $dtl_a_day8[$i],
                            'day9'        => $dtl_a_day9[$i],
                            'day10'       => $dtl_a_day10[$i],
                            'day11'       => $dtl_a_day11[$i],
                            'day12'       => $dtl_a_day12[$i],
                            'day13'       => $dtl_a_day13[$i],
                            'day14'       => $dtl_a_day14[$i],
                            'day15'       => $dtl_a_day15[$i],
                            'day16'       => $dtl_a_day16[$i],
                            'day17'       => $dtl_a_day17[$i],
                            'day18'       => $dtl_a_day18[$i],
                            'day19'       => $dtl_a_day19[$i],
                            'day20'       => $dtl_a_day20[$i],
                            'day21'       => $dtl_a_day21[$i],
                            'day22'       => $dtl_a_day22[$i],
                            'day23'       => $dtl_a_day23[$i],
                            'day24'       => $dtl_a_day24[$i],
                            'day25'       => $dtl_a_day25[$i],
                            'day26'       => $dtl_a_day26[$i],
                            'day27'       => $dtl_a_day27[$i],
                            'day28'       => $dtl_a_day28[$i],
                            'day29'       => $dtl_a_day29[$i],
                            'day30'       => $dtl_a_day30[$i],
                            'day31'       => $dtl_a_day31[$i],
                            'ket'       => $dtl_a_ket[$i],
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
                    $bulan          = $dtheaderrow->bulan;
                }
                $data['dthand_pallet'] = $this->model->get_list_hand_pallet($create_date);
                $data['date_calender']      = $this->model->get_date_calender($bulan, date("Y"));
                $data['dtkomponenmesin']  = $this->M_forminput->get_all_komponenmesin($BagianAkses);

                if ($cekLevelUserNm == 'Auditor') {
                    $dtdetail   = $this->model->get_detail_byidx($id);
                } else {
                    $dtdetail   = $this->model->get_detail_byid($id);
                }

                $data8  = array('dtdetail' => $dtdetail);
                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
            } else {

                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $kode, $bulan, $headerid);

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
                            $jml = count($this->input->post('dtl_a_nama_bagian'));
                            for ($i1 = 0; $i1 < $jml; $i1++) {
                                $data6 = array(
                                    'stdtl'    => $stdtl,
                                    'headerid'          => $headerid,

                                    'nama_bagian' => $dtl_a_nama_bagian[$i1],
                                    'day1'        => $dtl_a_day1[$i1],
                                    'day2'        => $dtl_a_day2[$i1],
                                    'day3'        => $dtl_a_day3[$i1],
                                    'day4'        => $dtl_a_day4[$i1],
                                    'day5'        => $dtl_a_day5[$i1],
                                    'day6'        => $dtl_a_day6[$i1],
                                    'day7'        => $dtl_a_day7[$i1],
                                    'day8'        => $dtl_a_day8[$i1],
                                    'day9'        => $dtl_a_day9[$i1],
                                    'day10'       => $dtl_a_day10[$i1],
                                    'day11'       => $dtl_a_day11[$i1],
                                    'day12'       => $dtl_a_day12[$i1],
                                    'day13'       => $dtl_a_day13[$i1],
                                    'day14'       => $dtl_a_day14[$i1],
                                    'day15'       => $dtl_a_day15[$i1],
                                    'day16'       => $dtl_a_day16[$i1],
                                    'day17'       => $dtl_a_day17[$i1],
                                    'day18'       => $dtl_a_day18[$i1],
                                    'day19'       => $dtl_a_day19[$i1],
                                    'day20'       => $dtl_a_day20[$i1],
                                    'day21'       => $dtl_a_day21[$i1],
                                    'day22'       => $dtl_a_day22[$i1],
                                    'day23'       => $dtl_a_day23[$i1],
                                    'day24'       => $dtl_a_day24[$i1],
                                    'day25'       => $dtl_a_day25[$i1],
                                    'day26'       => $dtl_a_day26[$i1],
                                    'day27'       => $dtl_a_day27[$i1],
                                    'day28'       => $dtl_a_day28[$i1],
                                    'day29'       => $dtl_a_day29[$i1],
                                    'day30'       => $dtl_a_day30[$i1],
                                    'day31'       => $dtl_a_day31[$i1],
                                    'ket'       => $dtl_a_ket[$i1],


                                );

                                if (isset($dtl_a_detail_id[$i1])) { // gak selalu deklar, baris baru gak ada input dtl_a_detail_id
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtlx($dtl_a_detail_id[$i1], $data6);
                                    } else {
                                        $this->model->update_dtl($dtl_a_detail_id[$i1], $data6);
                                        $this->model->update_dtlx($dtl_a_detail_id[$i1], $data6);
                                    }
                                } else {
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
