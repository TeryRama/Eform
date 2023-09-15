<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_dataharian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $frmkode = $this->uri->segment(4);
        $frmvrs = $this->uri->segment(5);
        // $this->load->model(array('M_user', 'master/M_form', 'M_menu', 'form_input/M_forminput', 'form_input/tambahan/lain_lain/M_jadwal_audit', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->model(array('M_user', 'master/M_form', 'M_menu', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->library(array('table', 'form_validation'));
        $this->load->helper('form');

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
        }
        /// end prevent direct url accses
        //////////////////////////////////
    }

    function opendata()
    {

        if ($this->session->userdata('logged_in')) {
            $session_data           = $this->session->userdata('logged_in');
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['Titel']          = 'MONITORING';

            $BagNm                  = $session_data['bagnm'];

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            $userid                 = $session_data['userid']; //untuk form kalibrasi

            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);

            $dtbutton               = $this->M_forminput->getButton_Akses($LevelUser);
            $data_button_akses      = array('dtbutton' => $dtbutton);

            $frmkode                = $this->uri->segment(4);
            $frmvrs                 = $this->uri->segment(5);
            $tipeform               = $this->uri->segment(6);

            $dtfrm                  = $this->M_forminput->get_dtform($frmkode, $frmvrs);
            $data3                  = array('dtfrm' => $dtfrm);

            foreach ($dtbutton as $dtbuttonrow) {
                $btn_create         = $dtbuttonrow->btn_create;
                $btn_update         = $dtbuttonrow->btn_update;
                $btn_delete         = $dtbuttonrow->btn_delete;
                $btn_delete_dh      = $dtbuttonrow->btn_delete_dh;
                $btn_export_pdf     = $dtbuttonrow->btn_export_pdf;
                $btn_export_excel   = $dtbuttonrow->btn_export_excel;
            }

            if ($btn_delete_dh == '1') {
                $head_hapus = "Hapus Data";
            } else {
                $head_hapus = "";
            }

            foreach ($dtfrm as $datafrm) {
                $frmkd                 = $datafrm->formkd;
                $frm_vrs               = $datafrm->formversi;
                $frmefective_parameter = $datafrm->efective_parameter;
                $frm_jenis_approval    = $datafrm->parameter_jenis_approval;
            }

            $item_select  = '*';

            switch ($frmkode) {
                case $frmkode == 'frmfss315':
                case $frmkode == 'frmfss316':
                case $frmkode == 'frmfss317':
                case $frmkode == 'inttbn009':
                case $frmkode == 'frmfss520':
                case $frmkode == 'intwtd023':
                case $frmkode == 'frmfss318':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'intwtd016':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Rev', 'Periode', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'frmfss064':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Revisi', 'Departemen', 'Item', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'frmfss846':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Revisi', 'Departemen', 'Nama Panel', 'Kode Panel', 'Lokasi Panel', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'frmfss187':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Tahun', 'Departemen', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'frmfss188':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Minggu', 'Departemen', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'frmfss060':
                case $frmkode == 'frmfss062':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Periode', 'Departemen', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'frmfss054':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Revisi', 'Departemen', 'Tahun', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'frmfss061':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Revisi', 'Gugus', 'Departemen', 'Tahun', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'frmfss065':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Departemen', 'Item', 'Jenis', 'Gugus', 'Nama Mesin', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'frmfss845':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Revisi', 'Departemen', 'Nama Panel', 'Kode Panel', 'Lokasi Panel', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'frmfss812':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Revisi', 'Departemen', 'Jenis Mesin', 'Gugus', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'frmfss031':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Departemen', 'Nama Mesin', 'Kode Mesin', 'Total Operasi', 'Jam', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'intwtd005':
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Kode Pallet', 'Bulan', 'Lihat Data', $head_hapus);
                    break;
                case $frmkode == 'intwtd032':
                    $itemhead     = array('No', 'Tanggal', 'Dokumen', 'Nama Alat', 'Kode Alat', 'Lihat Data', $head_hapus);
                    break;
                default:
                    $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Lihat Data', $head_hapus);
                    break;
            }

            $head_create_info = array('Diinput Terakhir', 'Komentar Disapprove');
            array_splice($itemhead, -2, 0, $head_create_info);

            $tablehead = 'tblfrm' . $frmkd . 'hdr';

            if ($frm_jenis_approval == 'Shift') {
                if ($cekLevelUserNm == 'Auditor') {
                    $dtl = 'status_detailx';
                    $dtl1 = 'status_detailx_sf1';
                    $dtl2 = 'status_detailx_sf2';
                    $dtl3 = 'status_detailx_sf3';
                } else {
                    $dtl = 'status_detail';
                    $dtl1 = 'status_detail_sf1';
                    $dtl2 = 'status_detail_sf2';
                    $dtl3 = 'status_detail_sf3';
                }
            } else {
                if ($cekLevelUserNm == 'Auditor') {
                    $dtl = 'status_detailx';
                    $dtl1 = '';
                    $dtl2 = '';
                    $dtl3 = '';
                } else {
                    $dtl = 'status_detail';
                    $dtl1 = '';
                    $dtl2 = '';
                    $dtl3 = '';
                }
            }

            $dtharian = $this->M_forminput->get_dataharian($tablehead, $item_select, $dtl, $dtl1, $dtl2, $dtl3, $BagNm, $LevelUser, $userid);

            $tmpl     = array('table_open'  => '<table id="example1" class="table table-striped table-bordered complex-headers">');

            $this->table->set_template($tmpl);

            $this->table->set_heading($itemhead);

            $no       = 0;
            foreach ($dtharian->result() as $row) {

                $tgl_parameter = $row->$frmefective_parameter;

                $dt_form_versi = $this->M_forminput->get_frmversi($frmkode, $tgl_parameter);

                foreach ($dt_form_versi as $dtformversi) {
                    $frm_vrs = $dtformversi->formversi;
                }

                $no++;

                $links  = anchor('form_input/C_form' . $frmkode . '_' . $frm_vrs . '/form/' . $frmkode . '/' . $frm_vrs . '/dtopen/' . $row->headerid, '<span class="btn bg-gradient-info feather icon-search"></span>');

                $links2 = anchor('form_input/C_forminput/delete_file/' . $frmkode . '/' . $frm_vrs . '/dtdelete/' . $row->headerid, '<span class="btn bg-gradient-danger feather icon-trash-2"></span>', array('onclick' => 'return confirmDialog();'));

                if ($btn_delete_dh == '1') {
                    $item_hapus = "$links2";
                } else {
                    $item_hapus = "";
                }

                if ($cekLevelUserNm == 'Auditor') {
                    $complete_date = date("d-m-Y", strtotime($row->complete_datex));
                    $complete_time = $row->complete_timex;
                    $complete_by   = $row->complete_byx;
                } else {
                    $complete_date = date("d-m-Y", strtotime($row->complete_date));
                    $complete_time = $row->complete_time;
                    $complete_by   = $row->complete_by;
                }

                if (isset($row->comment_status)) {
                    if ($row->comment_status == '1') {
                        $str_comment = $row->comment . ' <br/>(' . $row->comment_by . ' ' . date("d-m-Y", strtotime($row->comment_date)) . ' ' . $row->comment_time . ')';
                    } else {
                        $str_comment = '';
                    }
                } else {
                    $str_comment = '';
                }

                switch ($frmkode) {
                    case $frmkode == 'frmfss315':
                    case $frmkode == 'frmfss316':
                    case $frmkode == 'frmfss317':
                    case $frmkode == 'inttbn009':
                    case $frmkode == 'frmfss520':
                    case $frmkode == 'intwtd023':
                    case $frmkode == 'frmfss318':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'intwtd016':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->rev,
                            $row->periode,
                            $links,
                            $item_hapus
                        );
                        break;

                    case $frmkode == 'frmfss064':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->rev,
                            $row->deptabbr,
                            $row->item,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'frmfss846':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->rev,
                            $row->deptabbr,
                            $row->nama_panel,
                            $row->kode_panel,
                            $row->lokasi_panel,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'frmfss187':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->tahun,
                            $row->deptabbr,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'frmfss188':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->minggu,
                            $row->deptabbr,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'frmfss060':
                    case $frmkode == 'frmfss062':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            date("m-Y", strtotime($row->periode . '-01')),
                            $row->deptabbr,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'frmfss054':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->rev,
                            $row->deptabbr,
                            $row->tahun,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'frmfss061':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->rev,
                            $row->gugus,
                            $row->deptabbr,
                            $row->tahun,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'frmfss065':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->deptabbr,
                            $row->gugus,
                            $row->item,
                            $row->jns_mesin,
                            $row->nama_mesin,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'frmfss845':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->rev,
                            $row->deptabbr,
                            $row->nama_panel,
                            $row->kode_panel,
                            $row->lokasi_panel,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'frmfss812':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->rev,
                            $row->deptabbr,
                            $row->jns_mesin,
                            $row->gugus,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'frmfss031':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->deptabbr,
                            $row->nama_mesin,
                            $row->kode_mesin,
                            $row->total_operasi,
                            $row->jam,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'intwtd005':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->kode_name,
                            $row->bulan,
                            $links,
                            $item_hapus
                        );
                        break;
                    case $frmkode == 'intwtd032':
                        $itemarray = array(
                            $no,
                            date("d-m-Y", strtotime($row->create_date)),
                            $row->docno,
                            $row->equipment_name,
                            $row->equipment_code,
                            $links,
                            $item_hapus
                        );
                        break;
                    default:
                        $itemarray = array($no, $row->$frmefective_parameter, $links, $item_hapus);
                        break;
                }

                if ($cekLevelUserNm == 'Auditor') {
                } else {
                    $val_create_info = array($complete_by . '<br> ' . $complete_date . ' ' . $complete_time, $str_comment);
                    array_splice($itemarray, -2, 0, $val_create_info);
                }

                $this->table->add_row($itemarray);
            }

            $data['createtable'] = $this->table->generate();
            $this->load->view('data_harian/V_dataharian', array_merge($data, $data2, $data3));
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}
