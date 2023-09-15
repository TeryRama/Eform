<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $frmkode = $this->uri->segment(4);
        $frmvrs = $this->uri->segment(5);
        $this->load->model(array('M_user', 'master/M_form', 'M_menu', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs, 'master/M_mst_departemen'));
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

    function openlap()
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
            $data['Titel']          = 'Laporan';

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            $bagianabbr             = $session_data['bagnm'];

            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);

            $dtbutton               = $this->M_forminput->getButton_Akses($LevelUser);
            $data_button_akses      = array('dtbutton' => $dtbutton);

            $frmkode                = $this->uri->segment(4);
            $frmvrs                 = $this->uri->segment(5);

            $fileaksi               = $this->uri->segment(6);

            $dtfrm                  = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                  = array('dtfrm' => $dtfrm);

            $mdl = 'M_form' . $frmkode . '_' . $frmvrs;
            foreach ($dtbutton as $dtbuttonrow) {
                $btn_create         = $dtbuttonrow->btn_create;
                $btn_update         = $dtbuttonrow->btn_update;
                $btn_delete         = $dtbuttonrow->btn_delete;
                $btn_delete_dh      = $dtbuttonrow->btn_delete_dh;
                $btn_export_pdf     = $dtbuttonrow->btn_export_pdf;
                $btn_export_excel   = $dtbuttonrow->btn_export_excel;
                $btn_restore        = $dtbuttonrow->btn_restore;
            }

            if ($btn_restore == '1') {
                $head_restore = "Restore Laporan";
            } else {
                $head_restore = "";
            }

            foreach ($dtfrm as $datafrm) {
                $frmkd                 = $datafrm->formkd;
                $frm_vrs               = $datafrm->formversi;
                $frmefective_parameter = $datafrm->efective_parameter;
                $frm_jenis_approval    = $datafrm->parameter_jenis_approval;
            }

            if ($btn_restore == '1' && $frm_jenis_approval == 'Shift') {
                $head_restore_shift1 = "Restore Laporan Sf 1";
                $head_restore_shift2 = "Restore Laporan Sf 2";
                $head_restore_shift3 = "Restore Laporan Sf 3";
            } else {
                $head_restore_shift1 = "";
                $head_restore_shift2 = "";
                $head_restore_shift3 = "";
            }

            if (!isset($fileaksi)) {
                $data['createtable'] = "";
                $this->load->view('laporan/V_laporan', array_merge($data, $data2, $data3));
            } else {
                $dtstart          = date("Y-m-d", strtotime(addslashes($this->input->post('dtstart'))));
                $dtfinish         = date("Y-m-d", strtotime(addslashes($this->input->post('dtfinish'))));

                $data['dtstart']  = addslashes($this->input->post('dtstart'));
                $data['dtfinish'] = addslashes($this->input->post('dtfinish'));

                if ($frm_jenis_approval == 'Shift') {
                    if ($cekLevelUserNm == 'Auditor') {
                        $dtl = 'status_detailx_sf1';
                    } else {
                        $dtl = 'status_detail_sf1';
                    }
                } else {
                    if ($cekLevelUserNm == 'Auditor') {
                        $dtl = 'status_detailx';
                    } else {
                        $dtl = 'status_detail';
                    }
                }

                $dtquery   = "select * from tblfrm" . $frmkode . "hdr where $frmefective_parameter>='$dtstart' and $frmefective_parameter<='$dtfinish' and $dtl='1' order by 1 desc";

                switch (true) {
                    case $frmkode == 'frmfss316':
                    case $frmkode == 'frmfss317':
                    case $frmkode == 'inttbn009':
                    case $frmkode == 'frmfss520':
                    case $frmkode == 'intwtd014':
                    case $frmkode == 'intwtd017':
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                    case $frmkode == 'frmfss315':
                    case $frmkode == 'frmfss318':
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore, $head_restore_shift1, $head_restore_shift2, $head_restore_shift3);
                        break;
                    case $frmkode == 'intwtd016':
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Rev', 'Periode', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                    case $frmkode == 'frmfss064':
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Revisi', 'Departemen', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                    case $frmkode == 'frmfss187':
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Tahun', 'Departemen', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                    case $frmkode == 'frmfss188':
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Minggu', 'Departemen', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                    case $frmkode == 'frmfss060':
                    case $frmkode == 'frmfss062':
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Periode', 'Departemen', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                    case $frmkode == 'frmfss054':
                    case $frmkode == 'frmfss061':
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Revisi', 'Gugus', 'Departemen', 'Tahun', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                    case $frmkode == 'frmfss065':
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Gugus', 'Departemen', 'Nama Mesin', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                    case $frmkode == 'frmfss845':
                    case $frmkode == 'frmfss846':
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Revisi', 'Departemen', 'Nama Panel', 'Kode Panel', 'Lokasi Panel', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                    case $frmkode == 'frmfss812':
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Revisi', 'Departemen', 'Jenis Mesin', 'Gugus',  'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                    case $frmkode == 'frmfss031':
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Nama Mesin', 'Kode Mesin', 'Total Operasi', 'Jam', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                    case $frmkode == 'intwtd032':
                        $itemhead     = array('No', 'Tanggal', 'Dokumen', 'Nama Mesin', 'Kode Mesin', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                    default:
                        $itemhead     = array('No', 'Tanggal Pembuatan Laporan', 'Lihat Laporan', 'Export to Pdf', 'Export to Excel', $head_restore);
                        break;
                }
                switch (true) {
                    case $frmkode == 'intwtd028':
                    case $frmkode == 'intwtd024':
                        $dtmonth_year               = $this->input->post('dtmonth_year');
                        $arr_dtmonth_year           = explode('-', $dtmonth_year);
                        $data4['bulan']             = $arr_dtmonth_year[0];
                        $data4['tahun']             = $arr_dtmonth_year[1];
                        $data4['dtlaporan']         = $this->$mdl->get_detail_lap_bydate($arr_dtmonth_year[0], $arr_dtmonth_year[1]);
                        $data4['dtlaporan_date']    = $this->$mdl->get_date_calender($arr_dtmonth_year[0], $arr_dtmonth_year[1]);
                        break;
                    default:
                        $dtlaporan = $this->M_forminput->get_datalaporan($dtquery);
                        break;
                }

                if (isset($dtlaporan)) {

                    if ($cekLevelUserNm == 'Auditor') {
                        $head_create_info = array();
                    } else {
                        switch (true) {
                            case $frmkode == 'frmfss315':
                            case $frmkode == 'frmfss318':
                                $head_create_info = array('Dibuat oleh shift 1 (KR)', 'Dibuat oleh shift 2 (KR)', 'Dibuat oleh shift 3 (KR)', 'Diketahui oleh', 'Disetujui oleh');
                                break;
                            case $frmkode == 'frmfss520':
                            case $frmkode == 'intwtd014':
                            case $frmkode == 'intwtd017':
                                $head_create_info = array('Dibuat oleh shift 1', 'Dibuat oleh shift 2', 'Dibuat oleh shift 3', 'Diketahui oleh', 'Disetujui oleh');
                                break;
                            case $frmkode == 'intwtd016':
                            case $frmkode == 'frmfss054':
                            case $frmkode == 'frmfss061':
                                $head_create_info = array('Dibuat Oleh', 'Diketahui oleh', 'Disetujui oleh');
                                break;
                            case $frmkode == 'frmfss846':
                                $head_create_info = array('Dilaporkan Oleh', 'Diperiksa oleh', 'Diketahui oleh');
                                break;
                            case $frmkode == 'frmfss065':
                                $head_create_info = array('Dikomplit Oleh');
                                break;

                            default:
                                $head_create_info = array('Dikomplit Oleh', 'Diketahui oleh', 'Disetujui oleh');
                                break;
                        }
                    }

                    // tambah info approval
                    switch (true) {
                        case $frmkode == 'frmfss315':
                        case $frmkode == 'frmfss318':
                            array_splice($itemhead, -7, 0, $head_create_info);
                            break;

                        default:
                            array_splice($itemhead, -4, 0, $head_create_info);
                            break;
                    }

                    $tmpl = array('table_open'  => '<table id="example1" class="table table-striped table-bordered complex-headers">');
                    $this->table->set_template($tmpl);
                    $this->table->set_heading($itemhead);

                    $no   = 0;
                    foreach ($dtlaporan->result() as $row) {
                        $tgl_parameter = $row->$frmefective_parameter;
                        $dt_form_versi = $this->M_forminput->get_frmversi($frmkode, $tgl_parameter);
                        $frm_vrs = !empty($dt_form_versi) ? $dt_form_versi[0]->formversi : '';

                        $no++;

                        $links  = anchor_popup('laporan/C_detail_laporan/opendetail/' . $frmkode . '/' . $frm_vrs . '/dtlap/' . $row->headerid, '<span class="btn bg-gradient-info feather icon-search"></span>');
                        $links2 = anchor('laporan/C_export_topdf/exporttopdf/' . $frmkode . '/' . $frm_vrs . '/export/' . $row->headerid, '<span class="btn bg-gradient-dark fa fa-file-pdf-o"></span>');
                        $links3 = anchor('laporan/C_export_toexcel/exportxls/' . $frmkode . '/' . $frm_vrs . '/export/' . $row->headerid, '<span class="btn bg-gradient-success fa fa-file-excel-o"></span>');
                        $links4 = anchor('export_excel/C_export_toexcel_' . $frmkode . '_' . $frm_vrs . '/exportxls/' . $frmkode . '/' . $frm_vrs . '/' . $row->headerid, '<span class="btn bg-gradient-success fa fa-file-excel-o"></span>');
                        $links5 = anchor('laporan/C_restore/restore_laporan/' . $frmkode . '/' . $frm_vrs . '/restore/' . $row->headerid, '<span class="btn bg-gradient-danger feather icon-rotate-ccw"></span>');
                        $links6_sf1 = anchor('laporan/C_restore/restore_laporan_pershift/' . $frmkode . '/' . $frm_vrs . '/restore/' . $row->headerid . '/shift_1', '<span class="btn bg-gradient-danger feather icon-rotate-ccw"></span>');
                        $links6_sf2 = anchor('laporan/C_restore/restore_laporan_pershift/' . $frmkode . '/' . $frm_vrs . '/restore/' . $row->headerid . '/shift_2', '<span class="btn bg-gradient-danger feather icon-rotate-ccw"></span>');
                        $links6_sf3 = anchor('laporan/C_restore/restore_laporan_pershift/' . $frmkode . '/' . $frm_vrs . '/restore/' . $row->headerid . '/shift_3', '<span class="btn bg-gradient-danger feather icon-rotate-ccw"></span>');

                        $item_restore = $btn_restore == '1' ? $links5 : '';

                        $item_restore_persihft1 = ($btn_restore == '1' && $frm_jenis_approval == 'Shift') ? $links6_sf1 : '';
                        $item_restore_persihft2 = ($btn_restore == '1' && $frm_jenis_approval == 'Shift') ? $links6_sf2 : '';
                        $item_restore_persihft3 = ($btn_restore == '1' && $frm_jenis_approval == 'Shift') ? $links6_sf3 : '';

                        if ($cekLevelUserNm == 'Auditor') {
                            $complete_date = $row->complete_datex;
                            $complete_time = $row->complete_timex;
                            $complete_by   = $row->complete_byx;
                        } else {
                            $complete_date = $row->complete_date;
                            $complete_time = $row->complete_time;
                            $complete_by   = $row->complete_by;
                        }

                        for ($i = 1; $i <= 10; $i++) {
                            ${'str_app' . $i} = !empty($row->{'app' . $i . '_status'}) && $row->{'app' . $i . '_status'} == '1' ? $row->{'app' . $i . '_by'} . '<br/>' . date("d-m-Y", strtotime($row->{'app' . $i . '_date'})) . ' ' . $row->{'app' . $i . '_time'} : '';
                        }

                        switch ($frmkode) {
                            case $frmkode == "frmfss316":
                            case $frmkode == "frmfss317":
                            case $frmkode == "inttbn009":
                            case $frmkode == "frmfss520":
                            case $frmkode == "intwtd014":
                            case $frmkode == "intwtd017":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                            case $frmkode == "frmfss315":
                            case $frmkode == "frmfss318":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore,
                                    $item_restore_persihft1,
                                    $item_restore_persihft2,
                                    $item_restore_persihft3
                                );
                                break;
                            case $frmkode == "intwtd016":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $row->rev,
                                    $row->periode,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                            case $frmkode == "frmfss064":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $row->rev,
                                    $row->deptabbr,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                            case $frmkode == "frmfss187":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $row->tahun,
                                    $row->deptabbr,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                            case $frmkode == "frmfss188":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $row->minggu,
                                    $row->deptabbr,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                            case $frmkode == "frmfss060":
                            case $frmkode == "frmfss062":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $row->periode,
                                    $row->deptabbr,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                            case $frmkode == "frmfss054":
                            case $frmkode == "frmfss061":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $row->rev,
                                    $row->gugus,
                                    $row->deptabbr,
                                    $row->tahun,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                            case $frmkode == "frmfss065":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $row->gugus,
                                    $row->deptabbr,
                                    $row->nama_mesin,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                            case $frmkode == "frmfss845":
                            case $frmkode == "frmfss846":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $row->rev,
                                    $row->deptabbr,
                                    $row->nama_panel,
                                    $row->kode_panel,
                                    $row->lokasi_panel,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                            case $frmkode == "frmfss812":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $row->rev,
                                    $row->deptabbr,
                                    $row->jns_mesin,
                                    $row->gugus,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                            case $frmkode == "frmfss031":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $row->nama_mesin,
                                    $row->kode_mesin,
                                    $row->total_operasi,
                                    $row->jam,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                            case $frmkode == "intwtd032":
                                $itemarray = array(
                                    $no,
                                    date("d-m-Y", strtotime($row->$frmefective_parameter)),
                                    $row->docno,
                                    $row->equipment_name,
                                    $row->equipment_code,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                            default:
                                $itemarray = array(
                                    $no,
                                    $row->$frmefective_parameter,
                                    $links,
                                    $links2,
                                    $links4,
                                    $item_restore
                                );
                                break;
                        }

                        if ($cekLevelUserNm == 'Auditor') {
                            $val_create_info = array();
                        } else {
                            switch (true) {
                                case $frmkode == 'frmfss315':
                                case $frmkode == 'frmfss318':
                                case $frmkode == 'frmfss520':
                                case $frmkode == 'intwtd014':
                                case $frmkode == 'intwtd017':
                                    $val_create_info = array($str_app1, $str_app2, $str_app3, $str_app4, $str_app5);
                                    break;
                                case $frmkode == 'frmfss316':
                                case $frmkode == 'frmfss317':
                                case $frmkode == 'frmfss064':
                                case $frmkode == 'intwtd016':
                                case $frmkode == 'frmfss054':
                                case $frmkode == 'frmfss061':
                                case $frmkode == 'inttbn009':
                                case $frmkode == 'frmfss845':
                                case $frmkode == 'frmfss846':
                                    $val_create_info = array($str_app1, $str_app2, $str_app3);
                                    break;
                                case $frmkode == 'frmfss065':
                                    $val_create_info = array($complete_by . '<br/>' . date("d-m-Y", strtotime($complete_date)));
                                    break;

                                default:
                                    $val_create_info = array($complete_by . '<br/>' . date("d-m-Y", strtotime($complete_date)) . ' ' . $complete_time, $str_app1, $str_app2);
                                    break;
                            }
                        }

                        switch (true) {
                            case $frmkode == 'frmfss315':
                            case $frmkode == 'frmfss318':
                                array_splice($itemarray, -7, 0, $val_create_info);
                                break;
                            default:
                                array_splice($itemarray, -4, 0, $val_create_info);
                                break;
                        }


                        $this->table->add_row($itemarray);
                    }

                    $data['createtable'] = $this->table->generate();
                } else {
                    $data['createtable'] = '';
                }
                switch (true) {
                    case $frmkode == 'intwtd028':
                    case $frmkode == 'intwtd024':
                        $this->load->view('laporan/V_laporan_detail_' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3, $data4));
                        break;
                    default:
                        $this->load->view('laporan/V_laporan', array_merge($data, $data2, $data3));
                        break;
                }
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}
