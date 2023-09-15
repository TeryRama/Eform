<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_forminttbn040_02 extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $CI        = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);

        $frmkode   = $this->uri->segment(4);
        $frmvrs    = $this->uri->segment(5);

        $this->load->model(array('M_user', 'M_menu', 'tambahan/M_tambahan', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs,));
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
            echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini !');
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

    function get_item()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('legged_in');
            $create_date  = $this->input->post('create_date');
            $dthasil      = $this->model->get_list_item('Tipe 1', date("Y-m-d", strtotime($this->input->post('create_date'))));

            if (count($dthasil) > 0) {
                $hasil = array(
                    'status'    => 1,
                    'vstatus'   => 'berhasil',
                    'pesan'     => "Berhasil Memuat Data, Silahkan Simpan Terlebih Dahulu !",
                    'data'      => $dthasil,
                );
            } else {
                $hasil = array(
                    'status'    => 0,
                    'vstatus'   => 'Gagaal',
                    'pesan'     => "Data Belum tersedia, Silahkan Cek Terlebih Dahulu Sumber Datanya !",
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
            $session_data               = $this->session->userdata('logged_in');
            $data['userid']             = $session_data['userid'];
            $data['username']           = $session_data['username'];
            $data['password']           = $session_data['password'];
            $data['jabid']              = $session_data['jabid'];
            $data['leveluserid']        = $session_data['leveluserid'];
            $data['nmdepan']            = $session_data['nmdepan'];
            $data['nmlengkap']          = $session_data['nmlengkap'];
            $data['levelusernm']        = $session_data['levelusernm'];
            $data['bagnm']              = $session_data['bagnm'];
            $data['bagian_akses']       = $session_data['bagian_akses'];
            $data['jabnm']              = $session_data['jabnm'];
            $data['personalid']         = $session_data['personalid'];
            $data['personalstatus']     = $session_data['personalstatus'];
            $data['Titel']              = 'MONITORING';

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

            $dtfrm                      = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                      = array('dtfrm' => $dtfrm);

            foreach ($dtfrm as $dt_form) {
                $frmnm                  = $dt_form->formnm;
            }

            $frmaksi                    = $this->uri->segment(6);

            // data hedder
            $headerid                = addslashes($this->input->post('headerid'));
            $complete_userid         = $session_data['userid'];
            $complete_personalid     = $session_data['personalid'];
            $complete_position       = $session_data['jabnm'];
            $complete_personalstatus = $session_data['personalstatus'];
            $complete_date           = date('Y-m-d');
            $complete_time           = date('H:i:s');
            $complete_by             = $session_data['nmlengkap'];
            $complete_comp           = $this->session->userdata('hostname');                                    // versi user original
            $create_date             = date("Y-m-d", strtotime(addslashes($this->input->post('create_date'))));  // dari inputan d-m-Y
            $docno                   = addslashes($this->input->post('docno'));
            $jam1_hdr                = $this->input->post('jam1_hdr');
            $jam2_hdr                = $this->input->post('jam2_hdr');
            $jam3_hdr                = $this->input->post('jam3_hdr');
            $jam4_hdr                = $this->input->post('jam4_hdr');
            $jam5_hdr                = $this->input->post('jam5_hdr');
            $jam6_hdr                = $this->input->post('jam6_hdr');
            $jam7_hdr                = $this->input->post('jam7_hdr');
            $jam8_hdr                = $this->input->post('jam8_hdr');
            $jam9_hdr                = $this->input->post('jam9_hdr');
            $jam10_hdr               = $this->input->post('jam10_hdr');
            $jam11_hdr               = $this->input->post('jam11_hdr');
            $jam12_hdr               = $this->input->post('jam12_hdr');
            $jam13_hdr               = $this->input->post('jam13_hdr');
            $jam14_hdr               = $this->input->post('jam14_hdr');
            $jam15_hdr               = $this->input->post('jam15_hdr');
            $jam16_hdr               = $this->input->post('jam16_hdr');
            $jam17_hdr               = $this->input->post('jam17_hdr');
            $jam18_hdr               = $this->input->post('jam18_hdr');
            $jam19_hdr               = $this->input->post('jam19_hdr');
            $jam20_hdr               = $this->input->post('jam20_hdr');
            $jam21_hdr               = $this->input->post('jam21_hdr');
            $jam22_hdr               = $this->input->post('jam22_hdr');
            $jam23_hdr               = $this->input->post('jam23_hdr');
            $jam24_hdr               = $this->input->post('jam24_hdr');
            $jam25_hdr               = $this->input->post('jam25_hdr');
            $jam26_hdr               = $this->input->post('jam26_hdr');
            $jam27_hdr               = $this->input->post('jam27_hdr');
            $jam28_hdr               = $this->input->post('jam28_hdr');
            $jam29_hdr               = $this->input->post('jam29_hdr');
            $jam30_hdr               = $this->input->post('jam30_hdr');
            $jam31_hdr               = $this->input->post('jam31_hdr');
            $jam32_hdr               = $this->input->post('jam32_hdr');
            $jam33_hdr               = $this->input->post('jam33_hdr');
            $jam34_hdr               = $this->input->post('jam34_hdr');
            $total_soft              = $this->input->post('total_soft');
            $total_pro               = $this->input->post('total_pro');
            $total_feed              = $this->input->post('total_feed');
            $total_product           = $this->input->post('total_product');
            $total_reject            = $this->input->post('total_reject');
            $keterangan_hdr          = $this->input->post('keterangan_hdr');
            // dtl a
            $detail_id                  = $this->input->post('detail_id');
            $jam1                       = $this->input->post('jam1');
            $pressure_1                 = $this->input->post('pressure_1');
            $h566                       = $this->input->post('h566');
            $jam2                       = $this->input->post('jam2');
            $pressure2                  = $this->input->post('pressure2');
            $ph_bilas                   = $this->input->post('ph_bilas');
            $jam3                       = $this->input->post('jam3');
            $pressure3                  = $this->input->post('pressure3');
            $h277                       = $this->input->post('h277');
            $jam4                       = $this->input->post('jam4');
            $pressure4                  = $this->input->post('pressure4');
            $ph_bilas4                  = $this->input->post('ph_bilas4');
            // dtl b
            $detail_idb                 = $this->input->post('detail_idb');
            $flow_awal                  = $this->input->post('flow_awal');
            $flow_akhir                 = $this->input->post('flow_akhir');
            $total                      = $this->input->post('total');
            $formula                    = $this->input->post('formula');
            // dtl c
            $detail_idc                 = $this->input->post('detail_idc');
            $jam                        = $this->input->post('jam');
            $uraian                     = $this->input->post('uraian');
            $tindakan                   = $this->input->post('tindakan');
            $nama                       = $this->input->post('nama');
            $shift                      = $this->input->post('shift');
            $dtlc_pj_id                 = $this->input->post('dtlc_pj_id');
            $keterangan                 = $this->input->post('keterangan');
            // dtl d
            $detail_idd                 = $this->input->post('detail_idd');
            $nama_mesin                 = $this->input->post('nama_mesin');
            $kode_mesin                 = $this->input->post('kode_mesin');
            $parameter                  = $this->input->post('parameter');
            $dtl_opr1                   = $this->input->post('dtl_opr1');
            $dtl_opr2                   = $this->input->post('dtl_opr2');
            $dtl_opr3                   = $this->input->post('dtl_opr3');
            $dtl_opr4                   = $this->input->post('dtl_opr4');
            $dtl_opr5                   = $this->input->post('dtl_opr5');
            $dtl_opr6                   = $this->input->post('dtl_opr6');
            $dtl_opr7                   = $this->input->post('dtl_opr7');
            $dtl_opr8                   = $this->input->post('dtl_opr8');
            $dtl_opr9                   = $this->input->post('dtl_opr9');
            $dtl_opr10                  = $this->input->post('dtl_opr10');
            $dtl_opr11                  = $this->input->post('dtl_opr11');
            $dtl_opr12                  = $this->input->post('dtl_opr12');
            $dtl_opr13                  = $this->input->post('dtl_opr13');
            $dtl_opr14                  = $this->input->post('dtl_opr14');
            $dtl_opr15                  = $this->input->post('dtl_opr15');
            $dtl_opr16                  = $this->input->post('dtl_opr16');
            $dtl_opr17                  = $this->input->post('dtl_opr17');
            $dtl_opr18                  = $this->input->post('dtl_opr18');
            $dtl_opr19                  = $this->input->post('dtl_opr19');
            $dtl_opr20                  = $this->input->post('dtl_opr20');
            $dtl_opr21                  = $this->input->post('dtl_opr21');
            $dtl_opr22                  = $this->input->post('dtl_opr22');
            $dtl_opr23                  = $this->input->post('dtl_opr23');
            $dtl_opr24                  = $this->input->post('dtl_opr24');
            $dtl_opr25                  = $this->input->post('dtl_opr25');
            $dtl_opr26                  = $this->input->post('dtl_opr26');
            $dtl_opr27                  = $this->input->post('dtl_opr27');
            $dtl_opr28                  = $this->input->post('dtl_opr28');
            $dtl_opr29                  = $this->input->post('dtl_opr29');
            $dtl_opr30                  = $this->input->post('dtl_opr30');
            $dtl_opr31                  = $this->input->post('dtl_opr31');
            $dtl_opr32                  = $this->input->post('dtl_opr32');
            $dtl_opr33                  = $this->input->post('dtl_opr33');
            $dtl_opr34                  = $this->input->post('dtl_opr34');
            // dtl e
            $detail_ide                 = $this->input->post('detail_ide');
            $shift_e                    = $this->input->post('shift_e');
            $soft_awal                  = $this->input->post('soft_awal');
            $soft_akhir                 = $this->input->post('soft_akhir');
            $soft_total                 = $this->input->post('soft_total');
            $pro_awal                   = $this->input->post('pro_awal');
            $pro_akhir                  = $this->input->post('pro_akhir');
            $pro_total                  = $this->input->post('pro_total');
            // dtl f
            $detail_idf                 = $this->input->post('detail_idf');
            $shift_f                    = $this->input->post('shift_f');
            $no_pompa                   = $this->input->post('no_pompa');
            $feed_awal                  = $this->input->post('feed_awal');
            $feed_akhir                 = $this->input->post('feed_akhir');
            $feed_total                 = $this->input->post('feed_total');
            $product_flow               = $this->input->post('product_flow');
            $product_waktu              = $this->input->post('product_waktu');
            $product_total              = $this->input->post('product_total');
            $reject_flow                = $this->input->post('reject_flow');
            $reject_waktu               = $this->input->post('reject_waktu');
            $reject_total               = $this->input->post('reject_total');
            // dtl g
            $detail_idg                 = $this->input->post('detail_idg');
            $jam_waktu                  = $this->input->post('jam_waktu');
            $start_stop                 = $this->input->post('start_stop');
            $feed_ph                    = $this->input->post('feed_ph');
            $feed_konduktivity          = $this->input->post('feed_konduktivity');
            $feed_th                    = $this->input->post('feed_th');
            $feed_turbidity             = $this->input->post('feed_turbidity');
            $feed_cl                    = $this->input->post('feed_cl');
            $feed_fcl                   = $this->input->post('feed_fcl');
            $product_ph                 = $this->input->post('product_ph');
            $product_konduktivity       = $this->input->post('product_konduktivity');


            $data['jmldtl']             = count($this->input->post('jam1'));
            $data['jmldtl_2']           = count($this->input->post('flow_awal'));
            $data['jmldtl_3']           = count($this->input->post('jam'));
            $data['jmldtl_4']           = count($this->input->post('nama_mesin'));
            $data['jmldtl_5']           = count($this->input->post('shift_e'));
            $data['jmldtl_6']           = count($this->input->post('shift_f'));
            $data['jmldtl_7']           = count($this->input->post('jam_waktu'));

            if ($frmaksi == 'dtsave') {
                $cekheader = $this->model->check($create_date, $docno);
                if ($cekheader->num_rows() > 0) {
                    $data['message']          = 'Gagal, Data pada tanggal Laporan : ' . $create_date . ' dan No Dokumen : ' . $docno . ' sudah pernah disimpan';

                    $data['dtcreate_date']    = addslashes($this->input->post('create_date'));
                    $data['dtdocno']          = addslashes($this->input->post('docno'));

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

                        'create_date'    => $create_date,
                        'docno'          => $docno,
                        'jam1_hdr'       => $jam1_hdr,
                        'jam2_hdr'       => $jam2_hdr,
                        'jam3_hdr'       => $jam3_hdr,
                        'jam4_hdr'       => $jam4_hdr,
                        'jam5_hdr'       => $jam5_hdr,
                        'jam6_hdr'       => $jam6_hdr,
                        'jam7_hdr'       => $jam7_hdr,
                        'jam8_hdr'       => $jam8_hdr,
                        'jam9_hdr'       => $jam9_hdr,
                        'jam10_hdr'      => $jam10_hdr,
                        'jam11_hdr'      => $jam11_hdr,
                        'jam12_hdr'      => $jam12_hdr,
                        'jam13_hdr'      => $jam13_hdr,
                        'jam14_hdr'      => $jam14_hdr,
                        'jam15_hdr'      => $jam15_hdr,
                        'jam16_hdr'      => $jam16_hdr,
                        'jam17_hdr'      => $jam17_hdr,
                        'jam18_hdr'      => $jam18_hdr,
                        'jam19_hdr'      => $jam19_hdr,
                        'jam20_hdr'      => $jam20_hdr,
                        'jam21_hdr'      => $jam21_hdr,
                        'jam22_hdr'      => $jam22_hdr,
                        'jam23_hdr'      => $jam23_hdr,
                        'jam24_hdr'      => $jam24_hdr,
                        'jam25_hdr'      => $jam25_hdr,
                        'jam26_hdr'      => $jam26_hdr,
                        'jam27_hdr'      => $jam27_hdr,
                        'jam28_hdr'      => $jam28_hdr,
                        'jam29_hdr'      => $jam29_hdr,
                        'jam30_hdr'      => $jam30_hdr,
                        'jam31_hdr'      => $jam31_hdr,
                        'jam32_hdr'      => $jam32_hdr,
                        'jam33_hdr'      => $jam33_hdr,
                        'total_soft'     => $total_soft,
                        'total_pro'      => $total_pro,
                        'total_feed'     => $total_feed,
                        'total_product'  => $total_product,
                        'total_reject'   => $total_reject,
                        'keterangan_hdr' => $keterangan_hdr,
                        'jam34_hdr'      => $jam34_hdr
                    );

                    $this->model->insert_dtheader($data5);
                    $max_hdr_id    = $this->db1->insert_id();

                    $jmldtl   = count($this->input->post('jam1'));
                    for ($i = 0; $i < $jmldtl; $i++) {
                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }
                        $data6 = array(
                            'jam1'       => $jam1[$i],
                            'pressure_1' => $pressure_1[$i],
                            'h566'       => $h566[$i],
                            'jam2'       => $jam2[$i],
                            'pressure2'  => $pressure2[$i],
                            'ph_bilas'   => $ph_bilas[$i],
                            'jam3'       => $jam3[$i],
                            'pressure3'  => $pressure3[$i],
                            'h277'       => $h277[$i],
                            'jam4'       => $jam4[$i],
                            'pressure4'  => $pressure4[$i],
                            'ph_bilas4'  => $ph_bilas4[$i],
                            'headerid'   => $max_hdr_id,
                            'stdtl'      => $stdtl
                        );
                        $this->model->insert_detail($data6);
                    }

                    $jmldtl_2   = count($this->input->post('flow_awal'));
                    for ($i2 = 0; $i2 < $jmldtl_2; $i2++) {
                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }
                        $data6 = array(
                            'flow_awal'  => $flow_awal[$i2],
                            'flow_akhir' => $flow_akhir[$i2],
                            'total'      => $total[$i2],
                            'formula'    => $formula[$i2],
                            'headerid'   => $max_hdr_id,
                            'stdtl'      => $stdtl
                        );
                        $this->model->insert_detailb($data6);
                    }

                    $jmldtl_3   = count($this->input->post('jam'));
                    for ($i3 = 0; $i3 < $jmldtl_3; $i3++) {

                        // $pj_personalstatus[$i3] = null;
                        // $pj_personalid[$i3]     = null;
                        // $pj_nik[$i3]            = null;
                        // $pj_nama[$i3]           = null;

                        // if ($dtlc_pj_id[$i3]          != '') {
                        //     $dt_pj_by               = $this->model->get_pj_by($dtlc_pj_id[$i3]);
                        //     $pj_personalstatus[$i3] = $dt_pj_by->personalstatus;
                        //     $pj_personalid[$i3]     = $dt_pj_by->personalid;
                        //     $pj_nik[$i3]            = $dt_pj_by->nik;
                        //     $pj_nama[$i3]           = $dt_pj_by->nama;
                        // }

                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }

                        $data6 = array(
                            'jam'      => $jam[$i3],
                            'uraian'   => $uraian[$i3],
                            'tindakan' => $tindakan[$i3],
                            'nama'     => $nama[$i3],
                            'shift'    => $shift[$i3],

                            // 'pj_id'             => $dtlc_pj_id[$i3],
                            // 'pj_personalstatus' => $pj_personalstatus[$i3],
                            // 'pj_personalid'     => $pj_personalid[$i3],
                            // 'pj_nik'            => $pj_nik[$i3],
                            // 'pj_nama'           => $pj_nama[$i3],

                            'keterangan'        => $keterangan[$i3],
                            'headerid'          => $max_hdr_id,
                            'stdtl'             => $stdtl
                        );
                        $this->model->insert_detailc($data6);
                    }

                    $jmldtl_4   = count($this->input->post('nama_mesin'));
                    for ($i4 = 0; $i4 < $jmldtl_4; $i4++) {
                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }
                        $data6 = array(
                            'nama_mesin' => $nama_mesin[$i4],
                            'kode_mesin' => $kode_mesin[$i4],
                            'parameter'  => $parameter[$i4],
                            'dtl_opr1'   => $dtl_opr1[$i4],
                            'dtl_opr2'   => $dtl_opr2[$i4],
                            'dtl_opr3'   => $dtl_opr3[$i4],
                            'dtl_opr4'   => $dtl_opr4[$i4],
                            'dtl_opr5'   => $dtl_opr5[$i4],
                            'dtl_opr6'   => $dtl_opr6[$i4],
                            'dtl_opr7'   => $dtl_opr7[$i4],
                            'dtl_opr8'   => $dtl_opr8[$i4],
                            'dtl_opr9'   => $dtl_opr9[$i4],
                            'dtl_opr10'  => $dtl_opr10[$i4],
                            'dtl_opr11'  => $dtl_opr11[$i4],
                            'dtl_opr12'  => $dtl_opr12[$i4],
                            'dtl_opr13'  => $dtl_opr13[$i4],
                            'dtl_opr14'  => $dtl_opr14[$i4],
                            'dtl_opr15'  => $dtl_opr15[$i4],
                            'dtl_opr16'  => $dtl_opr16[$i4],
                            'dtl_opr17'  => $dtl_opr17[$i4],
                            'dtl_opr18'  => $dtl_opr18[$i4],
                            'dtl_opr19'  => $dtl_opr19[$i4],
                            'dtl_opr20'  => $dtl_opr20[$i4],
                            'dtl_opr21'  => $dtl_opr21[$i4],
                            'dtl_opr22'  => $dtl_opr22[$i4],
                            'dtl_opr23'  => $dtl_opr23[$i4],
                            'dtl_opr24'  => $dtl_opr24[$i4],
                            'dtl_opr25'  => $dtl_opr25[$i4],
                            'dtl_opr26'  => $dtl_opr26[$i4],
                            'dtl_opr27'  => $dtl_opr27[$i4],
                            'dtl_opr28'  => $dtl_opr28[$i4],
                            'dtl_opr29'  => $dtl_opr29[$i4],
                            'dtl_opr30'  => $dtl_opr30[$i4],
                            'dtl_opr31'  => $dtl_opr31[$i4],
                            'dtl_opr32'  => $dtl_opr32[$i4],
                            'dtl_opr33'  => $dtl_opr33[$i4],
                            'dtl_opr34'  => $dtl_opr34[$i4],
                            'headerid'   => $max_hdr_id,
                            'stdtl'      => $stdtl
                        );
                        $this->model->insert_detaild($data6);
                    }

                    $jmldtl_5   = count($this->input->post('shift_e'));
                    for ($i5 = 0; $i5 < $jmldtl_5; $i5++) {
                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }
                        $data6 = array(
                            'shift_e'    => $shift_e[$i5],
                            'soft_awal'  => $soft_awal[$i5],
                            'soft_akhir' => $soft_akhir[$i5],
                            'soft_total' => $soft_total[$i5],
                            'pro_awal'   => $pro_awal[$i5],
                            'pro_akhir'  => $pro_akhir[$i5],
                            'pro_total'  => $pro_total[$i5],
                            'headerid'   => $max_hdr_id,
                            'stdtl'      => $stdtl
                        );
                        $this->model->insert_detaile($data6);
                    }

                    $jmldtl_6   = count($this->input->post('shift_f'));
                    for ($i6 = 0; $i6 < $jmldtl_6; $i6++) {
                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }
                        $data6 = array(
                            'shift_f'       => $shift_f[$i6],
                            'no_pompa'      => $no_pompa[$i6],
                            'feed_awal'     => $feed_awal[$i6],
                            'feed_akhir'    => $feed_akhir[$i6],
                            'feed_total'    => $feed_total[$i6],
                            'product_flow'  => $product_flow[$i6],
                            'product_waktu' => $product_waktu[$i6],
                            'product_total' => $product_total[$i6],
                            'reject_flow'   => $reject_flow[$i6],
                            'reject_waktu'  => $reject_waktu[$i6],
                            'reject_total'  => $reject_total[$i6],
                            'headerid'      => $max_hdr_id,
                            'stdtl'         => $stdtl
                        );
                        $this->model->insert_detailf($data6);
                    }

                    $jmldtl_7   = count($this->input->post('jam_waktu'));
                    for ($i7 = 0; $i7 < $jmldtl_7; $i7++) {
                        if ($cekLevelUserNm == "Auditor") {
                            $stdtl    = '0';
                            $stdtlx   = '1';
                        } else {
                            $stdtl    = '1';
                            $stdtlx   = '1';
                        }
                        $data6 = array(
                            'jam_waktu'            => $jam_waktu[$i7],
                            'start_stop'           => $start_stop[$i7],
                            'feed_ph'              => $feed_ph[$i7],
                            'feed_konduktivity'    => $feed_konduktivity[$i7],
                            'feed_th'              => $feed_th[$i7],
                            'feed_turbidity'       => $feed_turbidity[$i7],
                            'feed_cl'              => $feed_cl[$i7],
                            'feed_fcl'             => $feed_fcl[$i7],
                            'product_ph'           => $product_ph[$i7],
                            'product_konduktivity' => $product_konduktivity[$i7],
                            'headerid'             => $max_hdr_id,
                            'stdtl'                => $stdtl
                        );
                        $this->model->insert_detailg($data6);
                    }
                    $id = $max_hdr_id;
                    $this->model->insert_detailx($max_hdr_id);
                    $this->model->insert_detailbx($max_hdr_id);
                    $this->model->insert_detailcx($max_hdr_id);
                    $this->model->insert_detaildx($max_hdr_id);
                    $this->model->insert_detailex($max_hdr_id);
                    $this->model->insert_detailfx($max_hdr_id);
                    $this->model->insert_detailgx($max_hdr_id);

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
                    $dtdetailb          = $this->model->get_detail_byidbx($id);
                    $dtdetailc          = $this->model->get_detail_byidcx($id);
                    $dtdetaild          = $this->model->get_detail_byiddx($id);
                    $dtdetaile          = $this->model->get_detail_byidex($id);
                    $dtdetailf          = $this->model->get_detail_byidfx($id);
                    $dtdetailg          = $this->model->get_detail_byidgx($id);
                    $list_pj          = $this->model->get_list_pj($dtcreate_date);
                } else {
                    $data['komplit']    = $sts_detail;
                    $dtdetail           = $this->model->get_detail_byid($id);
                    $dtdetailb          = $this->model->get_detail_byidb($id);
                    $dtdetailc          = $this->model->get_detail_byidc($id);
                    $dtdetaild          = $this->model->get_detail_byidd($id);
                    $dtdetaile          = $this->model->get_detail_byide($id);
                    $dtdetailf          = $this->model->get_detail_byidf($id);
                    $dtdetailg          = $this->model->get_detail_byidg($id);
                    $list_pj          = $this->model->get_list_pj($dtcreate_date);
                }




                $data8  = array('dtdetail' => $dtdetail, 'dtdetailb' => $dtdetailb, 'dtdetailc' => $dtdetailc, 'dtdetaild' => $dtdetaild, 'dtdetaile' => $dtdetaile, 'dtdetailf' => $dtdetailf, 'list_pj' => $list_pj, 'dtdetailg' => $dtdetailg);

                $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8));
                // $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data7, $data8, $data9, $data10, $data11, $data12, $data13, $data14, $data15));
            } else {
                if (isset($_POST['btnproses'])) {
                    $cekheader = $this->model->check2($create_date, $docno, $headerid);

                    if ($cekheader->num_rows() > 0) {
                        echo "<script>alert('Gagal, Data pada tanggal Laporan : '.$create_date.' dan No Dokumen : '.$docno.' sudah pernah disimpan');</script>";
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
                                            'complete_useridx'        => $complete_userid,
                                            'complete_personalstatus' => $complete_personalstatus,
                                            'complete_personalid'     => $complete_personalid,
                                            'complete_position'       => $complete_position,
                                            'complete_byx'            => $complete_by,
                                            'complete_datex'          => $complete_date,
                                            'complete_timex'          => $complete_time,
                                            'complete_compx'          => $complete_comp,
                                            'create_date'             => $create_date,
                                            'docno'                   => $docno,
                                            'jam1_hdr'                => $jam1_hdr,
                                            'jam2_hdr'                => $jam2_hdr,
                                            'jam3_hdr'                => $jam3_hdr,
                                            'jam4_hdr'                => $jam4_hdr,
                                            'jam5_hdr'                => $jam5_hdr,
                                            'jam6_hdr'                => $jam6_hdr,
                                            'jam7_hdr'                => $jam7_hdr,
                                            'jam8_hdr'                => $jam8_hdr,
                                            'jam9_hdr'                => $jam9_hdr,
                                            'jam10_hdr'               => $jam10_hdr,
                                            'jam11_hdr'               => $jam11_hdr,
                                            'jam12_hdr'               => $jam12_hdr,
                                            'jam13_hdr'               => $jam13_hdr,
                                            'jam14_hdr'               => $jam14_hdr,
                                            'jam15_hdr'               => $jam15_hdr,
                                            'jam16_hdr'               => $jam16_hdr,
                                            'jam17_hdr'               => $jam17_hdr,
                                            'jam18_hdr'               => $jam18_hdr,
                                            'jam19_hdr'               => $jam19_hdr,
                                            'jam20_hdr'               => $jam20_hdr,
                                            'jam21_hdr'               => $jam21_hdr,
                                            'jam22_hdr'               => $jam22_hdr,
                                            'jam23_hdr'               => $jam23_hdr,
                                            'jam24_hdr'               => $jam24_hdr,
                                            'jam25_hdr'               => $jam25_hdr,
                                            'jam26_hdr'               => $jam26_hdr,
                                            'jam27_hdr'               => $jam27_hdr,
                                            'jam28_hdr'               => $jam28_hdr,
                                            'jam29_hdr'               => $jam29_hdr,
                                            'jam30_hdr'               => $jam30_hdr,
                                            'jam31_hdr'               => $jam31_hdr,
                                            'jam32_hdr'               => $jam32_hdr,
                                            'jam33_hdr'               => $jam33_hdr,
                                            'total_soft'              => $total_soft,
                                            'total_pro'               => $total_pro,
                                            'total_feed'              => $total_feed,
                                            'total_product'           => $total_product,
                                            'total_reject'            => $total_reject,
                                            'keterangan_hdr'          => $keterangan_hdr,
                                            'jam34_hdr'               => $jam34_hdr

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

                                            'complete_useridx'         => $complete_userid,
                                            'complete_personalstatusx' => $complete_personalstatus,
                                            'complete_personalidx'     => $complete_personalid,
                                            'complete_positionx'       => $complete_position,
                                            'complete_byx'             => $complete_by,
                                            'complete_datex'           => $complete_date,
                                            'complete_timex'           => $complete_time,
                                            'complete_compx'           => $complete_comp,             // versi user audit
                                            'create_date'              => $create_date,
                                            'docno'                    => $docno,
                                            'jam1_hdr'                 => $jam1_hdr,
                                            'jam2_hdr'                 => $jam2_hdr,
                                            'jam3_hdr'                 => $jam3_hdr,
                                            'jam4_hdr'                 => $jam4_hdr,
                                            'jam5_hdr'                 => $jam5_hdr,
                                            'jam6_hdr'                 => $jam6_hdr,
                                            'jam7_hdr'                 => $jam7_hdr,
                                            'jam8_hdr'                 => $jam8_hdr,
                                            'jam9_hdr'                 => $jam9_hdr,
                                            'jam10_hdr'                => $jam10_hdr,
                                            'jam11_hdr'                => $jam11_hdr,
                                            'jam12_hdr'                => $jam12_hdr,
                                            'jam13_hdr'                => $jam13_hdr,
                                            'jam14_hdr'                => $jam14_hdr,
                                            'jam15_hdr'                => $jam15_hdr,
                                            'jam16_hdr'                => $jam16_hdr,
                                            'jam17_hdr'                => $jam17_hdr,
                                            'jam18_hdr'                => $jam18_hdr,
                                            'jam19_hdr'                => $jam19_hdr,
                                            'jam20_hdr'                => $jam20_hdr,
                                            'jam21_hdr'                => $jam21_hdr,
                                            'jam22_hdr'                => $jam22_hdr,
                                            'jam23_hdr'                => $jam23_hdr,
                                            'jam24_hdr'                => $jam24_hdr,
                                            'jam25_hdr'                => $jam25_hdr,
                                            'jam26_hdr'                => $jam26_hdr,
                                            'jam27_hdr'                => $jam27_hdr,
                                            'jam28_hdr'                => $jam28_hdr,
                                            'jam29_hdr'                => $jam29_hdr,
                                            'jam30_hdr'                => $jam30_hdr,
                                            'jam31_hdr'                => $jam31_hdr,
                                            'jam32_hdr'                => $jam32_hdr,
                                            'jam33_hdr'                => $jam33_hdr,
                                            'total_soft'               => $total_soft,
                                            'total_pro'                => $total_pro,
                                            'total_feed'               => $total_feed,
                                            'total_product'            => $total_product,
                                            'total_reject'             => $total_reject,
                                            'keterangan_hdr'           => $keterangan_hdr,
                                            'jam34_hdr'                => $jam34_hdr
                                        );
                                    }
                                    $alertmessage = "<script>alert('Data berhasil disimpan ! ');</script>";
                                    break;
                                case $_POST['btnproses'] == 'btncomplete':
                                    $data5 = array(
                                        'complete_userid'           => $complete_userid,
                                        'complete_personalstatus'   => $complete_personalstatus,
                                        'complete_personalid'       => $complete_personalid,
                                        'complete_position'         => $complete_position,
                                        'complete_by'               => $complete_by,
                                        'complete_date'             => $complete_date,
                                        'complete_time'             => $complete_time,
                                        'complete_comp'             => $complete_comp, // versi user original
                                        'complete_status'           => '0',

                                        'complete_useridx'          => $complete_userid,
                                        'complete_personalstatusx'  => $complete_personalstatus,
                                        'complete_personalidx'      => $complete_personalid,
                                        'complete_positionx'        => $complete_position,
                                        'complete_byx'              => $complete_by,
                                        'complete_datex'            => $complete_date,
                                        'complete_timex'            => $complete_time,
                                        'complete_compx'            => $complete_comp, // versi user audit

                                        'status_detail'  => '1',
                                        'status_detailx' => '1',
                                        'create_date'    => $create_date,
                                        'docno'          => $docno,
                                        'jam1_hdr'       => $jam1_hdr,
                                        'jam2_hdr'       => $jam2_hdr,
                                        'jam3_hdr'       => $jam3_hdr,
                                        'jam4_hdr'       => $jam4_hdr,
                                        'jam5_hdr'       => $jam5_hdr,
                                        'jam6_hdr'       => $jam6_hdr,
                                        'jam7_hdr'       => $jam7_hdr,
                                        'jam8_hdr'       => $jam8_hdr,
                                        'jam9_hdr'       => $jam9_hdr,
                                        'jam10_hdr'      => $jam10_hdr,
                                        'jam11_hdr'      => $jam11_hdr,
                                        'jam12_hdr'      => $jam12_hdr,
                                        'jam13_hdr'      => $jam13_hdr,
                                        'jam14_hdr'      => $jam14_hdr,
                                        'jam15_hdr'      => $jam15_hdr,
                                        'jam16_hdr'      => $jam16_hdr,
                                        'jam17_hdr'      => $jam17_hdr,
                                        'jam18_hdr'      => $jam18_hdr,
                                        'jam19_hdr'      => $jam19_hdr,
                                        'jam20_hdr'      => $jam20_hdr,
                                        'jam21_hdr'      => $jam21_hdr,
                                        'jam22_hdr'      => $jam22_hdr,
                                        'jam23_hdr'      => $jam23_hdr,
                                        'jam24_hdr'      => $jam24_hdr,
                                        'jam25_hdr'      => $jam25_hdr,
                                        'jam26_hdr'      => $jam26_hdr,
                                        'jam27_hdr'      => $jam27_hdr,
                                        'jam28_hdr'      => $jam28_hdr,
                                        'jam29_hdr'      => $jam29_hdr,
                                        'jam30_hdr'      => $jam30_hdr,
                                        'jam31_hdr'      => $jam31_hdr,
                                        'jam32_hdr'      => $jam32_hdr,
                                        'jam33_hdr'      => $jam33_hdr,
                                        'total_soft'     => $total_soft,
                                        'total_pro'      => $total_pro,
                                        'total_feed'     => $total_feed,
                                        'total_product'  => $total_product,
                                        'total_reject'   => $total_reject,
                                        'keterangan_hdr' => $keterangan_hdr,
                                        'jam34_hdr'      => $jam34_hdr
                                    );
                                    $alertmessage = "<script>alert('Data berhasil dikomplit ! ');</script>";
                                    break;
                                default:
                                    break;
                            }

                            $this->model->update_hdr($headerid, $data5);

                            $jmldtl = count($this->input->post('jam1'));
                            for ($i = 0; $i < $jmldtl; $i++) {
                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }
                                if (isset($detail_id[$i])) {
                                    $data6 = array(
                                        'stdtl'      => $stdtl,
                                        'jam1'       => $jam1[$i],
                                        'pressure_1' => $pressure_1[$i],
                                        'h566'       => $h566[$i],
                                        'jam2'       => $jam2[$i],
                                        'pressure2'  => $pressure2[$i],
                                        'ph_bilas'   => $ph_bilas[$i],
                                        'jam3'       => $jam3[$i],
                                        'pressure3'  => $pressure3[$i],
                                        'h277'       => $h277[$i],
                                        'jam4'       => $jam4[$i],
                                        'pressure4'  => $pressure4[$i],
                                        'ph_bilas4'  => $ph_bilas4[$i],
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
                                        'headerid'   => $headerid,
                                        'stdtl'      => $stdtl,
                                        'jam1'       => $jam1[$i],
                                        'pressure_1' => $pressure_1[$i],
                                        'h566'       => $h566[$i],
                                        'jam2'       => $jam2[$i],
                                        'pressure2'  => $pressure2[$i],
                                        'ph_bilas'   => $ph_bilas[$i],
                                        'jam3'       => $jam3[$i],
                                        'pressure3'  => $pressure3[$i],
                                        'h277'       => $h277[$i],
                                        'jam4'       => $jam4[$i],
                                        'pressure4'  => $pressure4[$i],
                                        'ph_bilas4'  => $ph_bilas4[$i],
                                    );
                                    $this->model->insert_detail($data6);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtlx($id);
                            }

                            $jmldtl_2 = count($this->input->post('flow_awal'));
                            for ($i2 = 0; $i2 < $jmldtl_2; $i2++) {
                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }
                                if (isset($detail_idb[$i2])) {
                                    $data6 = array(
                                        'stdtl'      => $stdtl,
                                        'flow_awal'  => $flow_awal[$i2],
                                        'flow_akhir' => $flow_akhir[$i2],
                                        'total'      => $total[$i2],
                                        'formula'    => $formula[$i2]
                                    );

                                    $datadetail = $detail_idb[$i2];
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtlbx($datadetail, $data6);
                                    } else {
                                        $this->model->update_dtlb($datadetail, $data6);
                                        $this->model->update_dtlbx($datadetail, $data6);
                                    }
                                } else {
                                    $data6 = array(
                                        'headerid'   => $headerid,
                                        'stdtl'      => $stdtl,
                                        'flow_awal'  => $flow_awal[$i2],
                                        'flow_akhir' => $flow_akhir[$i2],
                                        'formula'    => $formula[$i2],
                                        'total'      => $total[$i2]
                                    );
                                    $this->model->insert_detailb($data6);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtlbx($id);
                            }

                            $jmldtl_3 = count($this->input->post('jam'));
                            for ($i3 = 0; $i3 < $jmldtl_3; $i3++) {


                                // $pj_personalstatus[$i3] = null;
                                // $pj_personalid[$i3]     = null;
                                // $pj_nik[$i3]            = null;
                                // $pj_nama[$i3]           = null;

                                // if ($dtlc_pj_id[$i3]          != '') {
                                //     $dt_pj_by              = $this->model->get_pj_by($dtlc_pj_id[$i3]);
                                //     $pj_personalstatus[$i3] = $dt_pj_by->personalstatus;
                                //     $pj_personalid[$i3]     = $dt_pj_by->personalid;
                                //     $pj_nik[$i3]            = $dt_pj_by->nik;
                                //     $pj_nama[$i3]           = $dt_pj_by->nama;
                                // }

                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }

                                if (isset($detail_idc[$i3])) {
                                    $data6 = array(
                                        'stdtl'    => $stdtl,
                                        'jam'      => $jam[$i3],
                                        'uraian'   => $uraian[$i3],
                                        'tindakan' => $tindakan[$i3],
                                        'nama'     => $nama[$i3],
                                        'shift'    => $shift[$i3],

                                        // 'pj_id'             => $dtlc_pj_id[$i3],
                                        // 'pj_personalstatus' => $pj_personalstatus[$i3],
                                        // 'pj_personalid'     => $pj_personalid[$i3],
                                        // 'pj_nik'            => $pj_nik[$i3],
                                        // 'pj_nama'           => $pj_nama[$i3],

                                        'keterangan'      => $keterangan[$i3],
                                    );

                                    $datadetail = $detail_idc[$i3];
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtlcx($datadetail, $data6);
                                    } else {
                                        $this->model->update_dtlc($datadetail, $data6);
                                        $this->model->update_dtlcx($datadetail, $data6);
                                    }
                                } else {
                                    $data6 = array(
                                        'headerid' => $headerid,
                                        'stdtl'    => $stdtl,
                                        'jam'      => $jam[$i3],
                                        'uraian'   => $uraian[$i3],
                                        'tindakan' => $tindakan[$i3],
                                        'nama'     => $nama[$i3],
                                        'shift'    => $shift[$i3],

                                        // 'pj_id'             => $dtlc_pj_id[$i3],
                                        // 'pj_personalstatus' => $pj_personalstatus[$i3],
                                        // 'pj_personalid'     => $pj_personalid[$i3],
                                        // 'pj_nik'            => $pj_nik[$i3],
                                        // 'pj_nama'           => $pj_nama[$i3],

                                        'keterangan'      => $keterangan[$i3],
                                    );
                                    $this->model->insert_detailc($data6);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtlcx($id);
                            }

                            $jmldtl_4 = count($this->input->post('nama_mesin'));
                            for ($i4 = 0; $i4 < $jmldtl_4; $i4++) {
                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }
                                if (isset($detail_idd[$i4])) {
                                    $data6 = array(
                                        'stdtl'         => $stdtl,
                                        'nama_mesin'    => $nama_mesin[$i4],
                                        'kode_mesin'    => $kode_mesin[$i4],
                                        'parameter'     => $parameter[$i4],
                                        'dtl_opr1'  => $dtl_opr1[$i4],
                                        'dtl_opr2'  => $dtl_opr2[$i4],
                                        'dtl_opr3'  => $dtl_opr3[$i4],
                                        'dtl_opr4'  => $dtl_opr4[$i4],
                                        'dtl_opr5'  => $dtl_opr5[$i4],
                                        'dtl_opr6'  => $dtl_opr6[$i4],
                                        'dtl_opr7'  => $dtl_opr7[$i4],
                                        'dtl_opr8'  => $dtl_opr8[$i4],
                                        'dtl_opr9'  => $dtl_opr9[$i4],
                                        'dtl_opr10' => $dtl_opr10[$i4],
                                        'dtl_opr11' => $dtl_opr11[$i4],
                                        'dtl_opr12' => $dtl_opr12[$i4],
                                        'dtl_opr13' => $dtl_opr13[$i4],
                                        'dtl_opr14' => $dtl_opr14[$i4],
                                        'dtl_opr15' => $dtl_opr15[$i4],
                                        'dtl_opr16' => $dtl_opr16[$i4],
                                        'dtl_opr17' => $dtl_opr17[$i4],
                                        'dtl_opr18' => $dtl_opr18[$i4],
                                        'dtl_opr19' => $dtl_opr19[$i4],
                                        'dtl_opr20' => $dtl_opr20[$i4],
                                        'dtl_opr21' => $dtl_opr21[$i4],
                                        'dtl_opr22' => $dtl_opr22[$i4],
                                        'dtl_opr23' => $dtl_opr23[$i4],
                                        'dtl_opr24' => $dtl_opr24[$i4],
                                        'dtl_opr25' => $dtl_opr25[$i4],
                                        'dtl_opr26' => $dtl_opr26[$i4],
                                        'dtl_opr27' => $dtl_opr27[$i4],
                                        'dtl_opr28' => $dtl_opr28[$i4],
                                        'dtl_opr29' => $dtl_opr29[$i4],
                                        'dtl_opr30' => $dtl_opr30[$i4],
                                        'dtl_opr31' => $dtl_opr31[$i4],
                                        'dtl_opr32' => $dtl_opr32[$i4],
                                        'dtl_opr33' => $dtl_opr33[$i4],
                                        'dtl_opr34' => $dtl_opr34[$i4]
                                    );

                                    $datadetail = $detail_idd[$i4];
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtldx($datadetail, $data6);
                                    } else {
                                        $this->model->update_dtld($datadetail, $data6);
                                        $this->model->update_dtldx($datadetail, $data6);
                                    }
                                } else {
                                    $data6 = array(
                                        'headerid'      => $headerid,
                                        'stdtl'         => $stdtl,
                                        'nama_mesin'    => $nama_mesin[$i4],
                                        'kode_mesin'    => $kode_mesin[$i4],
                                        'parameter'     => $parameter[$i4],
                                        'dtl_opr1'  => $dtl_opr1[$i4],
                                        'dtl_opr2'  => $dtl_opr2[$i4],
                                        'dtl_opr3'  => $dtl_opr3[$i4],
                                        'dtl_opr4'  => $dtl_opr4[$i4],
                                        'dtl_opr5'  => $dtl_opr5[$i4],
                                        'dtl_opr6'  => $dtl_opr6[$i4],
                                        'dtl_opr7'  => $dtl_opr7[$i4],
                                        'dtl_opr8'  => $dtl_opr8[$i4],
                                        'dtl_opr9'  => $dtl_opr9[$i4],
                                        'dtl_opr10' => $dtl_opr10[$i4],
                                        'dtl_opr11' => $dtl_opr11[$i4],
                                        'dtl_opr12' => $dtl_opr12[$i4],
                                        'dtl_opr13' => $dtl_opr13[$i4],
                                        'dtl_opr14' => $dtl_opr14[$i4],
                                        'dtl_opr15' => $dtl_opr15[$i4],
                                        'dtl_opr16' => $dtl_opr16[$i4],
                                        'dtl_opr17' => $dtl_opr17[$i4],
                                        'dtl_opr18' => $dtl_opr18[$i4],
                                        'dtl_opr19' => $dtl_opr19[$i4],
                                        'dtl_opr20' => $dtl_opr20[$i4],
                                        'dtl_opr21' => $dtl_opr21[$i4],
                                        'dtl_opr22' => $dtl_opr22[$i4],
                                        'dtl_opr23' => $dtl_opr23[$i4],
                                        'dtl_opr24' => $dtl_opr24[$i4],
                                        'dtl_opr25' => $dtl_opr25[$i4],
                                        'dtl_opr26' => $dtl_opr26[$i4],
                                        'dtl_opr27' => $dtl_opr27[$i4],
                                        'dtl_opr28' => $dtl_opr28[$i4],
                                        'dtl_opr29' => $dtl_opr29[$i4],
                                        'dtl_opr30' => $dtl_opr30[$i4],
                                        'dtl_opr31' => $dtl_opr31[$i4],
                                        'dtl_opr32' => $dtl_opr32[$i4],
                                        'dtl_opr33' => $dtl_opr33[$i4],
                                        'dtl_opr34' => $dtl_opr34[$i4]
                                    );
                                    $this->model->insert_detaild($data6);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtldx($id);
                            }

                            $jmldtl_5 = count($this->input->post('shift_e'));
                            for ($i5 = 0; $i5 < $jmldtl_5; $i5++) {
                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }
                                if (isset($detail_ide[$i5])) {
                                    $data6 = array(
                                        'stdtl'      => $stdtl,
                                        'shift_e'    => $shift_e[$i5],
                                        'soft_awal'  => $soft_awal[$i5],
                                        'soft_akhir' => $soft_akhir[$i5],
                                        'soft_total' => $soft_total[$i5],
                                        'pro_awal'   => $pro_awal[$i5],
                                        'pro_akhir'  => $pro_akhir[$i5],
                                        'pro_total'  => $pro_total[$i5]
                                    );

                                    $datadetail = $detail_ide[$i5];
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtlex($datadetail, $data6);
                                    } else {
                                        $this->model->update_dtle($datadetail, $data6);
                                        $this->model->update_dtlex($datadetail, $data6);
                                    }
                                } else {
                                    $data6 = array(
                                        'headerid'   => $headerid,
                                        'stdtl'      => $stdtl,
                                        'shift_e'    => $shift_e[$i5],
                                        'soft_awal'  => $soft_awal[$i5],
                                        'soft_akhir' => $soft_akhir[$i5],
                                        'soft_total' => $soft_total[$i5],
                                        'pro_awal'   => $pro_awal[$i5],
                                        'pro_akhir'  => $pro_akhir[$i5],
                                        'pro_total'  => $pro_total[$i5]
                                    );
                                    $this->model->insert_detaile($data6);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtlex($id);
                            }

                            $jmldtl_6 = count($this->input->post('shift_f'));
                            for ($i6 = 0; $i6 < $jmldtl_6; $i6++) {
                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }
                                if (isset($detail_idf[$i6])) {
                                    $data6 = array(
                                        'stdtl'         => $stdtl,
                                        'shift_f'       => $shift_f[$i6],
                                        'no_pompa'      => $no_pompa[$i6],
                                        'feed_awal'     => $feed_awal[$i6],
                                        'feed_akhir'    => $feed_akhir[$i6],
                                        'feed_total'    => $feed_total[$i6],
                                        'product_flow'  => $product_flow[$i6],
                                        'product_waktu' => $product_waktu[$i6],
                                        'product_total' => $product_total[$i6],
                                        'reject_flow'   => $reject_flow[$i6],
                                        'reject_waktu'  => $reject_waktu[$i6],
                                        'reject_total'  => $reject_total[$i6]
                                    );

                                    $datadetail = $detail_idf[$i6];
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtlfx($datadetail, $data6);
                                    } else {
                                        $this->model->update_dtlf($datadetail, $data6);
                                        $this->model->update_dtlfx($datadetail, $data6);
                                    }
                                } else {
                                    $data6 = array(
                                        'headerid'      => $headerid,
                                        'stdtl'         => $stdtl,
                                        'shift_f'       => $shift_f[$i6],
                                        'no_pompa'      => $no_pompa[$i6],
                                        'feed_awal'     => $feed_awal[$i6],
                                        'feed_akhir'    => $feed_akhir[$i6],
                                        'feed_total'    => $feed_total[$i6],
                                        'product_flow'  => $product_flow[$i6],
                                        'product_waktu' => $product_waktu[$i6],
                                        'product_total' => $product_total[$i6],
                                        'reject_flow'   => $reject_flow[$i6],
                                        'reject_waktu'  => $reject_waktu[$i6],
                                        'reject_total'  => $reject_total[$i6]
                                    );
                                    $this->model->insert_detailf($data6);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtlfx($id);
                            }

                            $jmldtl_7 = count($this->input->post('jam_waktu'));
                            for ($i7 = 0; $i7 < $jmldtl_7; $i7++) {
                                if ($cekLevelUserNm == "Auditor") {
                                    $stdtl    = '0';
                                    $stdtlx   = '1';
                                } else {
                                    $stdtl    = '1';
                                    $stdtlx   = '1';
                                }
                                if (isset($detail_idg[$i7])) {
                                    $data6 = array(
                                        'stdtl'                => $stdtl,
                                        'jam_waktu'            => $jam_waktu[$i7],
                                        'start_stop'           => $start_stop[$i7],
                                        'feed_ph'              => $feed_ph[$i7],
                                        'feed_konduktivity'    => $feed_konduktivity[$i7],
                                        'feed_th'              => $feed_th[$i7],
                                        'feed_turbidity'       => $feed_turbidity[$i7],
                                        'feed_cl'              => $feed_cl[$i7],
                                        'feed_fcl'             => $feed_fcl[$i7],
                                        'product_ph'           => $product_ph[$i7],
                                        'product_konduktivity' => $product_konduktivity[$i7]
                                    );

                                    $datadetail = $detail_idg[$i7];
                                    if ($cekLevelUserNm == "Auditor") {
                                        $this->model->update_dtlgx($datadetail, $data6);
                                    } else {
                                        $this->model->update_dtlg($datadetail, $data6);
                                        $this->model->update_dtlgx($datadetail, $data6);
                                    }
                                } else {
                                    $data6 = array(
                                        'headerid'             => $headerid,
                                        'stdtl'                => $stdtl,
                                        'jam_waktu'            => $jam_waktu[$i7],
                                        'start_stop'           => $start_stop[$i7],
                                        'feed_ph'              => $feed_ph[$i7],
                                        'feed_konduktivity'    => $feed_konduktivity[$i7],
                                        'feed_th'              => $feed_th[$i7],
                                        'feed_turbidity'       => $feed_turbidity[$i7],
                                        'feed_cl'              => $feed_cl[$i7],
                                        'feed_fcl'             => $feed_fcl[$i7],
                                        'product_ph'           => $product_ph[$i7],
                                        'product_konduktivity' => $product_konduktivity[$i7]
                                    );
                                    $this->model->insert_detailg($data6);
                                }
                                $id = $headerid;
                                $this->model->new_insert2_dtlgx($id);
                            }
                        }
                        echo $alertmessage;
                        redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                    }
                } elseif (isset($_POST['btndelete_dtl'])) {
                    if ($cekLevelUserNm == 'Auditor') {
                        $cekdetail = $this->model->cek_stdetailx($headerid);

                        $data5 = array(
                            'complete_useridx'          => $complete_userid,
                            'complete_personalstatus'   => $complete_personalstatus,
                            'complete_personalid'       => $complete_personalid,
                            'complete_position'         => $complete_position,
                            'complete_byx'              => $complete_by,
                            'complete_datex'            => $complete_date,
                            'complete_timex'            => $complete_time,
                            'complete_compx'            => $complete_comp, // versi user audit
                        );
                    } else {
                        $cekdetail = $this->model->cek_stdetail($headerid);
                        $data5                          = array(
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
                            'complete_personalid'       => $complete_personalid,
                            'complete_position'         => $complete_position,
                            'complete_byx'              => $complete_by,
                            'complete_datex'            => $complete_date,
                            'complete_timex'            => $complete_time,
                            'complete_compx'            => $complete_comp, // versi user audit

                        );
                    }

                    if ($cekdetail->num_rows() > 0) {
                        $alertmessage = "<script>alert('Maaf data tidak bisa dihapus karena sudah dikomplit ! ');</script>";
                    } else {
                        $this->model->update_hdr($headerid, $data5);
                        $alertmessage = "<script>alert('Data berhasil dihapus ! ');</script>";

                        $chk    = $this->input->post('dtl_chk');
                        $jmldtl    = count($this->input->post('dtl_chk'));

                        if ($cekLevelUserNm == 'Auditor') {
                            for ($i = 0; $i < $jmldtl; $i++) {
                                $this->model->update_stdtl($chk[$i]);
                            }
                        } else {
                            for ($i = 0; $i < $jmldtl; $i++) {
                                $this->model->delete_detail($chk[$i]);
                                $this->model->delete_detailx($chk[$i]);
                            }
                        }
                    }
                    echo $alertmessage;
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                } elseif (isset($_POST['btndelete_dtl_b'])) {
                    if ($cekLevelUserNm == 'Auditor') {
                        $cekdetail = $this->model->cek_stdetailx($headerid);

                        $data5 = array(
                            'complete_useridx'          => $complete_userid,
                            'complete_personalstatus'   => $complete_personalstatus,
                            'complete_personalid'       => $complete_personalid,
                            'complete_position'         => $complete_position,
                            'complete_byx'              => $complete_by,
                            'complete_datex'            => $complete_date,
                            'complete_timex'            => $complete_time,
                            'complete_compx'            => $complete_comp, // versi user audit
                        );
                    } else {
                        $cekdetail = $this->model->cek_stdetail($headerid);
                        $data5                          = array(
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
                            'complete_personalid'       => $complete_personalid,
                            'complete_position'         => $complete_position,
                            'complete_byx'              => $complete_by,
                            'complete_datex'            => $complete_date,
                            'complete_timex'            => $complete_time,
                            'complete_compx'            => $complete_comp, // versi user audit

                        );
                    }

                    if ($cekdetail->num_rows() > 0) {
                        $alertmessage = "<script>alert('Maaf data tidak bisa dihapus karena sudah dikomplit ! ');</script>";
                    } else {
                        $this->model->update_hdr($headerid, $data5);
                        $alertmessage = "<script>alert('Data berhasil dihapus ! ');</script>";

                        $chkb   = $this->input->post('dtl_chkb');
                        $jmldtlb = count($this->input->post('dtl_chkb'));

                        if ($cekLevelUserNm == 'Auditor') {
                            for ($i = 0; $i < $jmldtlb; $i++) {
                                $this->model->update_stdtlb($chkb[$i]);
                            }
                        } else {
                            for ($i = 0; $i < $jmldtlb; $i++) {
                                $this->model->delete_detailb($chkb[$i]);
                                $this->model->delete_detailbx($chkb[$i]);
                            }
                        }
                    }
                    echo $alertmessage;
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                } elseif (isset($_POST['btndelete_dtl_c'])) {
                    if ($cekLevelUserNm == 'Auditor') {
                        $cekdetail = $this->model->cek_stdetailx($headerid);

                        $data5 = array(
                            'complete_useridx'          => $complete_userid,
                            'complete_personalstatus'   => $complete_personalstatus,
                            'complete_personalid'       => $complete_personalid,
                            'complete_position'         => $complete_position,
                            'complete_byx'              => $complete_by,
                            'complete_datex'            => $complete_date,
                            'complete_timex'            => $complete_time,
                            'complete_compx'            => $complete_comp, // versi user audit
                        );
                    } else {
                        $cekdetail = $this->model->cek_stdetail($headerid);
                        $data5                          = array(
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
                            'complete_personalid'       => $complete_personalid,
                            'complete_position'         => $complete_position,
                            'complete_byx'              => $complete_by,
                            'complete_datex'            => $complete_date,
                            'complete_timex'            => $complete_time,
                            'complete_compx'            => $complete_comp, // versi user audit

                        );
                    }

                    if ($cekdetail->num_rows() > 0) {
                        $alertmessage = "<script>alert('Maaf data tidak bisa dihapus karena sudah dikomplit ! ');</script>";
                    } else {
                        $this->model->update_hdr($headerid, $data5);
                        $alertmessage = "<script>alert('Data berhasil dihapus ! ');</script>";

                        $chkc   = $this->input->post('dtl_chkc');
                        $jmldtlc = count($this->input->post('dtl_chkc'));

                        if ($cekLevelUserNm == 'Auditor') {
                            for ($i = 0; $i < $jmldtlc; $i++) {
                                $this->model->update_stdtlc($chkc[$i]);
                            }
                        } else {
                            for ($i = 0; $i < $jmldtlc; $i++) {
                                $this->model->delete_detailc($chkc[$i]);
                                $this->model->delete_detailcx($chkc[$i]);
                            }
                        }
                    }
                    echo $alertmessage;
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
                } elseif (isset($_POST['btndelete_dtl_g'])) {
                    if ($cekLevelUserNm == 'Auditor') {
                        $cekdetail = $this->model->cek_stdetailx($headerid);

                        $data5 = array(
                            'complete_useridx'          => $complete_userid,
                            'complete_personalstatus'   => $complete_personalstatus,
                            'complete_personalid'       => $complete_personalid,
                            'complete_position'         => $complete_position,
                            'complete_byx'              => $complete_by,
                            'complete_datex'            => $complete_date,
                            'complete_timex'            => $complete_time,
                            'complete_compx'            => $complete_comp, // versi user audit
                        );
                    } else {
                        $cekdetail = $this->model->cek_stdetail($headerid);
                        $data5                          = array(
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
                            'complete_personalid'       => $complete_personalid,
                            'complete_position'         => $complete_position,
                            'complete_byx'              => $complete_by,
                            'complete_datex'            => $complete_date,
                            'complete_timex'            => $complete_time,
                            'complete_compx'            => $complete_comp, // versi user audit

                        );
                    }

                    if ($cekdetail->num_rows() > 0) {
                        $alertmessage = "<script>alert('Maaf data tidak bisa dihapus karena sudah dikomplit ! ');</script>";
                    } else {
                        $this->model->update_hdr($headerid, $data5);
                        $alertmessage = "<script>alert('Data berhasil dihapus ! ');</script>";

                        $chkg   = $this->input->post('dtl_chkg');
                        $jmldtlg = count($this->input->post('dtl_chkg'));

                        if ($cekLevelUserNm == 'Auditor') {
                            for ($i = 0; $i < $jmldtlg; $i++) {
                                $this->model->update_stdtlg($chkg[$i]);
                            }
                        } else {
                            for ($i = 0; $i < $jmldtlg; $i++) {
                                $this->model->delete_detailg($chkg[$i]);
                                $this->model->delete_detailgx($chkg[$i]);
                            }
                        }
                    }
                    echo $alertmessage;
                    redirect('/form_input/C_form' . $frmkode . '_' . $frmvrs . '/form/' . $frmkode . '/' . $frmvrs . '/dtopen/' . $headerid, 'refresh');
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
