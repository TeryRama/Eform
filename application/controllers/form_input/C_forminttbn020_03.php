<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_forminttbn020_03 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->db1 = $this->load->database('db1', TRUE);

        $frmkode   = $this->uri->segment(4);
        $frmvrs    = $this->uri->segment(5);

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

            $dthasil      = $this->model->get_docno(date("m", strtotime($create_date)), date("Y", strtotime($create_date)));

            $last_docno   = isset($dthasil->vdocno) ? $dthasil->vdocno + 0 : 1;

            $date_day     = date("d", strtotime($create_date));
            $arr_bulan    = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];

            $docno        = 'LHPBK/PWP-TBN/' . date("y", strtotime($create_date)) . '/' . $arr_bulan[(float)date("m", strtotime($create_date))] . '/' .  str_pad($date_day, 3, '0', STR_PAD_LEFT);

            $hasil = array(
                'status'  => 1,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil",
                'data'    => $docno,
            );

            echo json_encode($hasil);
        } else {
            redirect('C_login', 'refresh');
        }
    }

    function get_bulan()
    {
        if ($this->session->userdata('logged_in')) {
            $create_date  = $this->input->post('create_date');
            $bulan = 'Pemakaian Rata-Rata ' . $this->model->get_tanggal_indo(date('Y-m-', strtotime($create_date)));
            $hasil = array(
                'status'  => 1,
                'vstatus' => 'berhasil',
                'pesan'   => "berhasil",
                'data'    => $bulan,
            );

            echo json_encode($hasil);
        } else {
            redirect('C_login', 'refresh');
        }
    }

    function get_list_item()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $create_date  = $this->input->post('create_date');
            $dthasil      = $this->model->get_list_item('Tipe 1', date("Y-m-d", strtotime($create_date)));

            if (count($dthasil) > 0) {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'berhasil',
                    'pesan'   => "Berhasil Memuat data !",
                    'data'    => $dthasil,
                );
            } else {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'gagal',
                    'pesan'   => "Data detail tidak ditemukan !",
                );
            }

            echo json_encode($hasil);
        } else {
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

            $dtfrm                  = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                  = array('dtfrm' => $dtfrm);

            foreach ($dtfrm as $dt_form) {
                $frmnm              = $dt_form->formnm;
            }


            $frmaksi                = $this->uri->segment(6);

            // data hedder
            $headerid                = addslashes($this->input->post('headerid'));
            $complete_userid         = $session_data['userid'];
            $complete_personalid     = $session_data['personalid'];
            $complete_position       = $session_data['jabnm'];
            $complete_personalstatus = $session_data['personalstatus'];
            $complete_date           = date('Y-m-d');
            $complete_time           = date('H:i:s');
            $complete_by             = $session_data['nmlengkap'];
            $complete_comp           = $this->session->userdata('hostname');                                     // versi user original
            $create_date             = date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));  // dari inputan d-m-Y
            $docno                   = addslashes($this->input->post('docno'));

            $detail_id         = $this->input->post('detail_id');
            $item_kimia        = $this->input->post('item_kimia');
            $satuan            = $this->input->post('satuan');
            $stock_awal        = $this->input->post('stock_awal');
            $terima            = $this->input->post('terima');
            $terima_akum       = $this->input->post('terima_akum');
            $pakai             = $this->input->post('pakai');
            $pakai_akum        = $this->input->post('pakai_akum');
            $kirim             = $this->input->post('kirim');
            $kirim_akum        = $this->input->post('kirim_akum');
            $minimum_stock     = $this->input->post('minimum_stock');
            $stock_akhir       = $this->input->post('stock_akhir');
            $ratarata_perbulan = $this->input->post('ratarata_perbulan');
            $ratarata_perhari  = $this->input->post('ratarata_perhari');
            $outstanding_ppb   = $this->input->post('outstanding_ppb');
            $keterangan        = $this->input->post('keterangan');
            $detail_id_item    = $this->input->post('detail_id_item');

            $data['jmldtl']             = count($this->input->post('item_kimia'));

            if ($frmaksi == 'dtsave') {
                $cekheader                        = $this->model->check($create_date, $docno);
                if ($cekheader->num_rows() > 0) {
                    $data['message']              = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ' dan No Dokumen : ' . $docno . ' sudah pernah disimpan';

                    $data['dtcreate_date']        = addslashes($this->input->post('create_date'));
                    $data['dtdocno']              = addslashes($this->input->post('docno'));

                    $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
                } else {
                    $status_detail  = '0';
                    $status_detailx = '0';
                    $data5 = array(
                        'complete_userid'           => $complete_userid,
                        'complete_personalstatus'   => $complete_personalstatus,
                        'complete_personalid'       => $complete_personalid,
                        'complete_position'         => $complete_position,
                        'complete_by'               => $complete_by,
                        'complete_date'             => $complete_date,
                        'complete_time'             => $complete_time,
                        'complete_comp'             => $complete_comp, // versi user original
                        'complete_useridx'          => $complete_userid,
                        'complete_personalidx'      => $complete_personalid,
                        'complete_positionx'        => $complete_position,
                        'complete_personalstatusx'  => $complete_personalstatus,
                        'complete_byx'              => $complete_by,
                        'complete_datex'            => $complete_date,
                        'complete_timex'            => $complete_time,
                        'complete_compx'            => $complete_comp, // versi user audit
                        'status_detail'             => $status_detail,
                        'status_detailx'            => $status_detailx,
                        'create_date'               => $create_date,
                        'docno'                     => $docno
                    );
                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    $jml   = count($this->input->post('item_kimia'));
                    for ($i = 0; $i < $jml; $i++) {
                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }
                        $data6 = array(
                            'headerid'          => $max_hdr_id,
                            'stdtl'             => $stdtl,
                            'item_kimia'        => $item_kimia[$i],
                            'satuan'            => $satuan[$i],
                            'stock_awal'        => $stock_awal[$i],
                            'terima'            => $terima[$i],
                            'terima_akum'       => $terima_akum[$i],
                            'pakai'             => $pakai[$i],
                            'pakai_akum'        => $pakai_akum[$i],
                            'kirim'             => $kirim[$i],
                            'kirim_akum'        => $kirim_akum[$i],
                            'minimum_stock'     => $minimum_stock[$i],
                            'stock_akhir'       => $stock_akhir[$i],
                            'ratarata_perbulan' => $ratarata_perbulan[$i],
                            'ratarata_perhari'  => $ratarata_perhari[$i],
                            'outstanding_ppb'   => $outstanding_ppb[$i],
                            'keterangan'        => $keterangan[$i],
                            'detail_id_item'    => $detail_id_item[$i]
                        );
                        $this->model->insert_detail($data6);
                    }

                    $id = $max_hdr_id;
                    $this->model->insert_detailx($max_hdr_id);

                    echo "<script>alert('Data berhasil disimpan !');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $max_hdr_id, 'refresh');
                }
            } elseif ($frmaksi == 'dtopen') {
                $id         = $this->uri->segment(7);
                $dtheader   = $this->model->get_header_byid($id); // manggil data header
                $data7      = array('dtheader' => $dtheader);

                foreach ($dtheader as $hdrrow) {
                    $dtcreate_date = $hdrrow->create_date;
                    $sts_detail    = $hdrrow->status_detail;
                    $sts_detailx   = $hdrrow->status_detailx;
                }

                if ($cekLevelUserNm == "Auditor") {
                    $data['komplit']    = $sts_detailx;
                    $dtdetail           = $this->model->get_detail_byidx($id);
                } else {
                    $data['komplit']    = $sts_detail;
                    $dtdetail           = $this->model->get_detail_byid($id);
                }

                $data8  = array('dtdetail' => $dtdetail);

                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
            } else {
                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $headerid);

                    if ($cekheader->num_rows() > 0) {
                        echo "<script>alert('Gagal, Data pada tanggal Laporan : '.$create_date.' dan No Dokumen : '.$docno.'  sudah pernah disimpan');</script>";
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    } else {
                        if ($cekLevelUserNm == "Auditor") {
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
                                        $data5 = array(
                                            'complete_useridx'          => $complete_userid,
                                            'complete_personalstatus'   => $complete_personalstatus,
                                            'complete_personalid'       => $complete_personalid,
                                            'complete_position'         => $complete_position,
                                            'complete_byx'              => $complete_by,
                                            'complete_datex'            => $complete_date,
                                            'complete_timex'            => $complete_time,
                                            'complete_compx'            => $complete_comp,
                                            'create_date'               => $create_date,
                                            'docno'                     => $docno
                                        );
                                    } else {
                                        $data5 = array(
                                            'complete_userid'           => $complete_userid,
                                            'complete_personalstatus'   => $complete_personalstatus,
                                            'complete_personalid'       => $complete_personalid,
                                            'complete_position'         => $complete_position,
                                            'complete_by'               => $complete_by,
                                            'complete_date'             => $complete_date,
                                            'complete_time'             => $complete_time,
                                            'complete_comp'             => $complete_comp, // versi user original

                                            'complete_useridx'          => $complete_userid,
                                            'complete_personalstatusx'  => $complete_personalstatus,
                                            'complete_personalidx'      => $complete_personalid,
                                            'complete_positionx'        => $complete_position,
                                            'complete_byx'              => $complete_by,
                                            'complete_datex'            => $complete_date,
                                            'complete_timex'            => $complete_time,
                                            'complete_compx'            => $complete_comp, // versi user audit
                                            'create_date'               => $create_date,
                                            'docno'                     => $docno
                                        );
                                    }
                                    $alertmessage = "<script>alert('Data berhasil disimpan ! ');</script>";
                                    break;
                                case $_POST['btnproses'] == 'btncomplete':
                                    $data5 = array(
                                        'complete_userid'          => $complete_userid,
                                        'complete_personalstatus'  => $complete_personalstatus,
                                        'complete_personalid'      => $complete_personalid,
                                        'complete_position'        => $complete_position,
                                        'complete_by'              => $complete_by,
                                        'complete_date'            => $complete_date,
                                        'complete_time'            => $complete_time,
                                        'complete_comp'            => $complete_comp, // versi user original

                                        'complete_useridx'         => $complete_userid,
                                        'complete_personalstatusx' => $complete_personalstatus,
                                        'complete_personalidx'     => $complete_personalid,
                                        'complete_positionx'       => $complete_position,
                                        'complete_byx'             => $complete_by,
                                        'complete_datex'           => $complete_date,
                                        'complete_timex'           => $complete_time,
                                        'complete_compx'           => $complete_comp, // versi user audit

                                        'status_detail'             => '1',
                                        'status_detailx'            => '1',
                                        'create_date'               => $create_date,
                                        'docno'                     => $docno
                                    );
                                    $alertmessage = "<script>alert('Data berhasil dikomplit ! ');</script>";
                                    break;
                                default:
                                    break;
                            }

                            $this->model->update_hdr($headerid, $data5);

                            $jml = count($this->input->post('item_kimia'));
                            for ($i = 0; $i < $jml; $i++) {
                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }
                                if (isset($detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'             => $stdtl,
                                        'item_kimia'        => $item_kimia[$i],
                                        'satuan'            => $satuan[$i],
                                        'stock_awal'        => $stock_awal[$i],
                                        'terima'            => $terima[$i],
                                        'terima_akum'       => $terima_akum[$i],
                                        'pakai'             => $pakai[$i],
                                        'pakai_akum'        => $pakai_akum[$i],
                                        'kirim'             => $kirim[$i],
                                        'kirim_akum'        => $kirim_akum[$i],
                                        'minimum_stock'     => $minimum_stock[$i],
                                        'stock_akhir'       => $stock_akhir[$i],
                                        'ratarata_perbulan' => $ratarata_perbulan[$i],
                                        'ratarata_perhari'  => $ratarata_perhari[$i],
                                        'outstanding_ppb'   => $outstanding_ppb[$i],
                                        'keterangan'        => $keterangan[$i],
                                        'detail_id_item'    => $detail_id_item[$i]
                                    );

                                    $datadetail = $detail_id[$i];
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtlx($datadetail, $data6);
                                    } else {
                                        $this->model->update_dtl($datadetail, $data6);
                                        $this->model->update_dtlx($datadetail, $data6);
                                    }
                                } else {
                                    $data6 = array(
                                        'headerid'          => $headerid,
                                        'stdtl'             => $stdtl,
                                        'item_kimia'        => $item_kimia[$i],
                                        'satuan'            => $satuan[$i],
                                        'stock_awal'        => $stock_awal[$i],
                                        'terima'            => $terima[$i],
                                        'terima_akum'       => $terima_akum[$i],
                                        'pakai'             => $pakai[$i],
                                        'pakai_akum'        => $pakai_akum[$i],
                                        'kirim'             => $kirim[$i],
                                        'kirim_akum'        => $kirim_akum[$i],
                                        'minimum_stock'     => $minimum_stock[$i],
                                        'stock_akhir'       => $stock_akhir[$i],
                                        'ratarata_perbulan' => $ratarata_perbulan[$i],
                                        'ratarata_perhari'  => $ratarata_perhari[$i],
                                        'outstanding_ppb'   => $outstanding_ppb[$i],
                                        'keterangan'        => $keterangan[$i],
                                        'detail_id_item'    => $detail_id_item[$i]
                                    );
                                    $this->model->insert_detail($data6);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtlx($id);
                            }
                        }
                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
                } else {
                    echo "<script>alert('Tidak ada aksi atau hapus data tidak sesuai halaman shift ! ');</script>";
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                }
            }
        } else {
            redirect('C_login', 'refresh');
        }
    }
}

/* End of file C_forminttbn020_03.php */
