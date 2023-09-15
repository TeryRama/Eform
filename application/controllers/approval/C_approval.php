<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

//    session_start(); //Memanggil fungsi session Codeigniter
class C_approval extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->db_acc = $this->load->database('db_acc', TRUE);

    $frmkode = $this->uri->segment(4);
    $frmvrs = $this->uri->segment(5);
    $this->load->model(array('M_user', 'master/M_form', 'M_menu', 'form_input/M_forminput', 'approval/M_approval'));
    $this->load->library(array('table', 'form_validation'));
    $this->load->helper('form');
  }

  function openapp()
  {
    if ($this->session->userdata('logged_in')) {
      $session_data           = $this->session->userdata('logged_in');
      $data['username']       = $session_data['username'];
      $data['password']       = $session_data['password'];
      $data['jabid']          = $session_data['jabid'];
      $data['leveluserid']    = $session_data['leveluserid'];
      $data['nmdepan']        = $session_data['nmdepan'];
      $data['nmlengkap']      = $session_data['nmlengkap'];
      $data['levelusernm']    = $session_data['levelusernm'];
      $data['bagnm']          = $session_data['bagnm'];
      $data['jabnm']          = $session_data['jabnm'];
      $data['Titel']          = 'Approval';
      $data['personalid']     = $session_data['personalid'];
      $data['personalstatus'] = $session_data['personalstatus'];


      $BagNm                  = $session_data['bagnm'];

      $LevelUser              = $session_data['leveluserid'];
      $UserName               = $session_data['username'];
      $LevelUserNm            = $session_data['levelusernm'];

      $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
      $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

      $menus                  = $this->M_menu->menus($LevelUser);
      $data2                  = array('menus' => $menus);

      $levelnm                = $this->M_menu->getLevelnm($LevelUser);
      $datalv                 = array('levelnm' => $levelnm);

      $item                   = $this->uri->segment(3);

      $frm_jnsid              = $this->uri->segment(4);
      $data['frm_jnsid']      = $this->uri->segment(4);

      $data3['judul']         = 'Approval';
      $data6['bg']            = 'bg-red';
      $data7['aksi']          = 'openapp';
      $data['ctr']            = 'approval/C_approval';

      $dtforms                = $this->M_approval->get_app_by($LevelUser, $frm_jnsid);
      $data5                  = array('dtforms' => $dtforms);

      //////////////////////////////////
      /// prevent direct url accses
      $session_data = $this->session->userdata('logged_in');
      $leveluid     = $session_data['leveluserid'];
      $url_str      = uri_string();

      $akses_check = $this->M_user->check_akses_bylevelid($leveluid, $url_str);
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

      if (isset($dtforms)) {
        foreach ($dtforms as $dtformsrows) {
          $tablehead = 'tblfrm' . $dtformsrows->formkd . 'hdr';

          $dt_formid             = $dtformsrows->formid;
          $frmkode               = $dtformsrows->formkd;
          $frmefective_parameter = $dtformsrows->efective_parameter;
          $app_kategori          = $dtformsrows->parameter_jenis_approval;

          $app_position = $this->M_approval->get_app_position($dt_formid, $LevelUser);
          foreach ($app_position as $app_position_row) {
            $dt_app_pos = $app_position_row->app_pos;
          }

          if ($app_kategori == 'Shift') {
            if ($dt_app_pos == 'app1' || $dt_app_pos == 'app2' || $dt_app_pos == 'app3') {
              $con_app = 'AND (app1_status IS NULL OR app2_status IS NULL OR app3_status IS NULL)';
            } else {
              switch ($dt_app_pos) {
                case $dt_app_pos == 'app4':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NULL';
                  break;
                case $dt_app_pos == 'app5':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NULL';
                  break;
                case $dt_app_pos == 'app6':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NULL';
                  break;
                case $dt_app_pos == 'app7':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NULL';
                  break;
                case $dt_app_pos == 'app8':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NULL';
                  break;
                case $dt_app_pos == 'app9':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NOT NULL AND app9_status IS NULL';
                  break;
                case $dt_app_pos == 'app10':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NOT NULL AND app9_status IS NOT NULL AND app10_status IS NULL';
                  break;
                default:
                  $con_app = '';
                  break;
              }
            }
          } elseif ($app_kategori == 'Pengecekan') {
            if ($dt_app_pos == 'app1' || $dt_app_pos == 'app2') {
              $con_app = 'AND (app1_status IS NULL OR app2_status IS NULL)';
            } else {
              switch ($dt_app_pos) {
                case $dt_app_pos == 'app3':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NULL';
                  break;
                case $dt_app_pos == 'app4':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NULL';
                  break;
                case $dt_app_pos == 'app5':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NULL';
                  break;
                case $dt_app_pos == 'app6':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NULL';
                  break;
                case $dt_app_pos == 'app7':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NULL';
                  break;
                case $dt_app_pos == 'app8':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NULL';
                  break;
                case $dt_app_pos == 'app9':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NOT NULL AND app9_status IS NULL';
                  break;
                case $dt_app_pos == 'app10':
                  $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NOT NULL AND app9_status IS NOT NULL AND app10_status IS NULL';
                  break;
                default:
                  $con_app = '';
                  break;
              }
            }
          } else {
            switch ($dt_app_pos) {
              case $dt_app_pos == 'app1':
                $con_app = 'AND app1_status IS NULL';
                break;
              case $dt_app_pos == 'app2':
                $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NULL';
                break;
              case $dt_app_pos == 'app3':
                $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NULL';
                break;
              case $dt_app_pos == 'app4':
                $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NULL';
                break;
              case $dt_app_pos == 'app5':
                $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NULL';
                break;
              case $dt_app_pos == 'app6':
                $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NULL';
                break;
              case $dt_app_pos == 'app7':
                $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NULL';
                break;
              case $dt_app_pos == 'app8':
                $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NULL';
                break;
              case $dt_app_pos == 'app9':
                $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NOT NULL AND app9_status IS NULL';
                break;
              case $dt_app_pos == 'app10':
                $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NOT NULL AND app9_status IS NOT NULL AND app10_status IS NULL';
                break;
              default:
                $con_app = '';
                break;
            }
          }

          $head_checkbox  = '<input type="checkbox" class="app_all_' . $frmkode . '" onClick="toggle(this)"/>';
          $head_checkbox1 = '<input type="checkbox" class="app1_all_' . $frmkode . '" onClick="toggle(this)"/>';
          $head_checkbox2 = '<input type="checkbox" class="app2_all_' . $frmkode . '" onClick="toggle(this)"/>';
          $head_checkbox3 = '<input type="checkbox" class="app3_all_' . $frmkode . '" onClick="toggle(this)"/>';

          if ($app_kategori == 'Shift') {
            if ($cekLevelUserNm == 'Auditor') {
              $dtl = 'status_detailx_sf3';
            } else {
              $dtl = 'status_detail_sf3';
            }
          } elseif ($app_kategori == 'Pengecekan') {
            if ($cekLevelUserNm == 'Auditor') {
              $dtl = 'status_detailx';
            } else {
              $dtl = 'status_detail';
            }
          } else {
            if ($cekLevelUserNm == 'Auditor') {
              $dtl = 'status_detailx';
            } else {
              $dtl = 'status_detail';
            }
          }

          $dtquery = "select * from tblfrm" . $frmkode . "hdr where $dtl='1' $con_app order by headerid asc";

          switch ($frmkode) {
            case $frmkode == "frmfss315":
            case $frmkode == "frmfss316":
            case $frmkode == "frmfss317":
            case $frmkode == "frmfss318":
            case $frmkode == "frmfss520":
            case $frmkode == "intwtd014":
            case $frmkode == "intwtd017":
              $itemhead = array('No', 'Tanggal Pembuatan Laporan', 'Doc No');
              break;
            case $frmkode == "intwtd016":
              $itemhead = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Rev', 'Periode');
              break;
            case $frmkode == "frmfss187":
              $itemhead = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Tahun', 'Departemen');
              break;
            case $frmkode == "frmfss188":
              $itemhead = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Minggu', 'Departemen');
              break;
            case $frmkode == "frmfss060":
            case $frmkode == "frmfss062":
              $itemhead = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Periode', 'Departemen');
              break;
            case $frmkode == "frmfss064":
              $itemhead = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Rev', 'Departemen');
              break;
            case $frmkode == "frmfss065":
              $itemhead = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Gugus', 'Departemen', 'Nama Mesin',);
              break;
            case $frmkode == "frmfss812":
              $itemhead = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Revisi', 'Departemen', 'Jenis Mesin', 'Gugus');
              break;
            case $frmkode == "frmfss031":
              $itemhead = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Nama Mesin', 'Kode Mesin', 'Total Operasi', 'Jam');
              break;

            default:
              $itemhead = array('No', 'Tanggal Pembuatan Laporan');
              break;
          }

          if ($cekLevelUserNm == 'Auditor') {
            array_push($itemhead, "Lihat Laporan", $head_checkbox);
          } else {
            switch (true) {
              case $frmkode == 'frmfss315':
              case $frmkode == 'frmfss318':
                array_push($itemhead, 'Komentar Disapprove <br> Sebelumnya', 'Dicek oleh shift 1 (KR)', 'Dicek oleh shift 2 (KR)', 'Dicek oleh shift 3 (KR)', 'Diketahui oleh', 'Disetujui oleh', 'Lihat Laporan', $head_checkbox);
                break;
              case $frmkode == 'frmfss520':
              case $frmkode == "intwtd017":
                array_push($itemhead, 'Komentar Disapprove <br> Sebelumnya', 'Dibuat oleh shift 1', 'Dibuat oleh shift 2', 'Dibuat oleh shift 3', 'Diketahui oleh', 'Disetujui oleh', 'Lihat Laporan', $head_checkbox);
                break;
              case $frmkode == 'intwtd014':
                array_push($itemhead, 'Komentar Disapprove <br> Sebelumnya', 'Dibuat oleh shift 1', 'Dibuat oleh shift 2', 'Dibuat oleh shift 3', 'Diketahui oleh', 'Disetujui oleh', 'Lihat Laporan', $head_checkbox);
                break;
              case $frmkode == 'intwtd016':
              case $frmkode == 'frmfss316':
                array_push($itemhead, 'Komentar Disapprove <br> Sebelumnya', 'Dibuat oleh', 'Diketahui oleh', 'Disetujui oleh', 'Lihat Laporan', $head_checkbox);
                break;
              case $frmkode == 'frmfss317':
                array_push($itemhead, 'Komentar Disapprove <br> Sebelumnya', 'Dibuat oleh', 'Diketahui oleh', 'Disetujui oleh', 'Lihat Laporan', $head_checkbox);
                break;

              default:
                array_push($itemhead, 'Komentar Disapprove <br> Sebelumnya', 'Diketahui oleh', 'Disetujui oleh', 'Lihat Laporan', $head_checkbox);
                break;
            }
          }

          $dt_approval = $this->M_approval->get_data_app2($dtquery);

          if ($dt_approval->num_rows() > 0) {
            $status_row = 1;
          } else {
            $status_row = 0;
          }

        //   $buat_tabel = '<table id="example1_' . $frmkode . '_" class="example1_' . $frmkode . '_ table table-striped table-bordered">';
          $buat_tabel = '<table id="example1_' . $frmkode . '_" class="example1_' . $frmkode . '_ table table-striped table-bordered complex-headers">';
          $tmpl       = array('table_open'  => $buat_tabel);
          $this->table->set_template($tmpl);
          $this->table->set_heading($itemhead);

          $no         = 0;

          foreach ($dt_approval->result() as $row) {
            $tgl_parameter = $row->$frmefective_parameter;
            $dt_form_versi = $this->M_forminput->get_frmversi($frmkode, $tgl_parameter);
            $frm_vrs       = !empty($dt_form_versi) ? $dt_form_versi[0]->formversi : '';

            $no++;

            $links   = anchor_popup('laporan/C_detail_laporan/opendetail/' . $frmkode . '/' . $frm_vrs . '/dtlap/' . $row->headerid . '/' . $dt_app_pos, '<span class="btn bg-gradient-info feather icon-search"></span>');
            $links_a = anchor_popup('laporan/C_detail_laporan/opendetail/' . $frmkode . '/' . $frm_vrs . '/dtlap/' . $row->headerid . '/' . $dt_app_pos . '/1', '<span class="btn bg-gradient-info feather icon-search"></span>');
            $links_b = anchor_popup('laporan/C_detail_laporan/opendetail/' . $frmkode . '/' . $frm_vrs . '/dtlap/' . $row->headerid . '/' . $dt_app_pos . '/2', '<span class="btn bg-gradient-info feather icon-search"></span>');
            $links_c = anchor_popup('laporan/C_detail_laporan/opendetail/' . $frmkode . '/' . $frm_vrs . '/dtlap/' . $row->headerid . '/' . $dt_app_pos . '/3', '<span class="btn bg-gradient-info feather icon-search"></span>');
            $links_d = anchor_popup('laporan/C_detail_laporan/opendetail/' . $frmkode . '/' . $frm_vrs . '/dtlap/' . $row->headerid . '/' . $dt_app_pos . '/4', '<span class="btn bg-gradient-info feather icon-search"></span>');
            $links_e = anchor_popup('laporan/C_detail_laporan/opendetail/' . $frmkode . '/' . $frm_vrs . '/dtlap/' . $row->headerid . '/' . $dt_app_pos . '/5', '<span class="btn bg-gradient-info feather icon-search"></span>');
            $links_f = anchor_popup('laporan/C_detail_laporan/opendetail/' . $frmkode . '/' . $frm_vrs . '/dtlap/' . $row->headerid . '/' . $dt_app_pos . '/6', '<span class="btn bg-gradient-info feather icon-search"></span>');

            $chk_data = array(
              'name'    => 'app_all_' . $frmkode . '[]',
              'class'   => 'app_all_' . $frmkode,
              'value'   => $row->headerid,
              'checked' => False
            );

            $links2  = form_checkbox($chk_data);

            $chk_data1 = array(
              'name'    => 'app1_all_' . $frmkode . '[]',
              'class'   => 'app1_all_' . $frmkode,
              'value'   => $row->headerid,
              'checked' => False
            );

            $links2_1  = form_checkbox($chk_data1);

            $chk_data2 = array(
              'name'    => 'app2_all_' . $frmkode . '[]',
              'class'   => 'app2_all_' . $frmkode,
              'value'   => $row->headerid,
              'checked' => False
            );

            $links2_2  = form_checkbox($chk_data2);

            $chk_data3 = array(
              'name'    => 'app3_all_' . $frmkode . '[]',
              'class'   => 'app3_all_' . $frmkode,
              'value'   => $row->headerid,
              'checked' => False
            );

            $links2_3  = form_checkbox($chk_data3);

            if ($cekLevelUserNm == 'Auditor') {
              $html_completeby = $row->complete_byx . ' ' .  $row->complete_datex . ' ' . $row->complete_timex;
            } else {
              $html_completeby = $row->complete_by . ' ' .  $row->complete_date . ' ' . $row->complete_time;
            }

            for ($i = 1; $i <= 10; $i++) {
              ${'str_app' . $i} = !empty($row->{'app' . $i . '_status'}) && $row->{'app' . $i . '_status'} == '1' ? $row->{'app' . $i . '_by'} . '<br/>' . date("d-m-Y", strtotime($row->{'app' . $i . '_date'})) . ' ' . $row->{'app' . $i . '_time'} : '';
            }

            $str_comment = !empty($row->comment_status) && $row->comment_status == '1' ? $row->comment . ' <br/>(' . $row->comment_by . ' ' . date("d-m-Y", strtotime($row->comment_date)) . ' ' . $row->comment_time . ')' : '';

            switch ($frmkode) {
              case $frmkode == "frmfss315":
              case $frmkode == "frmfss316":
              case $frmkode == "frmfss317":
              case $frmkode == "frmfss318":
              case $frmkode == "frmfss520":
              case $frmkode == "intwtd017":
              case $frmkode == "intwtd014":
                $itemarray = array(
                  $no,
                  date("d-m-Y", strtotime($row->create_date)),
                  $row->docno
                );
                break;
              case $frmkode == "intwtd016":
                $itemarray = array(
                  $no,
                  date("d-m-Y", strtotime($row->create_date)),
                  $row->docno,
                  $row->rev,
                  $row->periode
                );
                break;
              case $frmkode == "frmfss187":
                $itemarray = array(
                  $no,
                  date("d-m-Y", strtotime($row->create_date)),
                  $row->docno,
                  $row->tahun,
                  $row->deptabbr,
                );
                break;
              case $frmkode == "frmfss188":
                $itemarray = array(
                  $no,
                  date("d-m-Y", strtotime($row->create_date)),
                  $row->docno,
                  $row->minggu,
                  $row->deptabbr,
                );
                break;
              case $frmkode == "frmfss060":
              case $frmkode == "frmfss062":
                $itemarray = array(
                  $no,
                  date("d-m-Y", strtotime($row->create_date)),
                  $row->docno,
                  date("m-Y", strtotime($row->periode.'-01')),
                  $row->deptabbr,
                );
                break;
              case $frmkode == "frmfss064":
                $itemarray = array(
                  $no,
                  date("d-m-Y", strtotime($row->create_date)),
                  $row->docno,
                  $row->rev,
                  $row->deptabbr,
                );
                break;
              case $frmkode == "frmfss065":
                $itemarray = array(
                  $no,
                  date("d-m-Y", strtotime($row->create_date)),
                  $row->docno,
                  $row->gugus,
                  $row->deptabbr,
                  $row->nama_mesin,
                );
                break;
              case $frmkode == "frmfss812":
                $itemarray = array(
                  $no,
                  date("d-m-Y", strtotime($row->create_date)),
                  $row->docno,
                  $row->rev,
                  $row->deptabbr,
                  $row->jns_mesin,
                  $row->gugus,
                );
                break;
              case $frmkode == "frmfss031":
                $itemarray = array(
                  $no,
                  date("d-m-Y", strtotime($row->create_date)),
                  $row->docno,
                  $row->nama_mesin,
                  $row->kode_mesin,
                  $row->total_operasi,
                  $row->jam,
                );
                break;

              default:
                $itemarray = array(
                  $no,
                  date("d-m-Y", strtotime($row->$frmefective_parameter))
                );
                break;
            }

            if ($cekLevelUserNm == 'Auditor') {
              array_push($itemarray, $links, $links2);
            } else {
              switch (true) {
                case $frmkode == 'frmfss315':
                case $frmkode == 'frmfss318':
                  array_push($itemarray, $str_comment, $str_app1, $str_app2,  $str_app3, $str_app4, $str_app5, $links, $links2);
                  break;
                case $frmkode == 'frmfss520':
                case $frmkode == "intwtd017":
                  array_push($itemarray, $str_comment, $str_app1, $str_app2,  $str_app3, $str_app4, $str_app5, $links, $links2);
                  break;
                case $frmkode == 'intwtd014':
                  array_push($itemarray, $str_comment, $str_app1, $str_app2,  $str_app3, $str_app4, $str_app5, $links, $links2);
                  break;
                case $frmkode == 'intwtd016':
                case $frmkode == 'frmfss316':
                  array_push($itemarray, $str_comment, $str_app1, $str_app2,  $str_app3, $links, $links2);
                  break;
                case $frmkode == 'frmfss317':
                  array_push($itemarray, $str_comment, $str_app1, $str_app2,  $str_app3, $links, $links2);
                  break;

                default:
                  array_push($itemarray, $str_comment, $str_app1, $str_app2, $links, $links2); // 2 approval, default
                  break;
              }
            }

            $this->table->add_row($itemarray);
          }

          $data['createtable'][] = $this->table->generate();
          $data['app_pos'][] = $dt_app_pos;
          $data['jml_app'][] = $status_row;
        }
      }

      $this->load->view('approval/V_allapp', array_merge($data, $data2, $data3, $datalv, $data5, $data6, $data7));
    } else {
      //Jika tidak ada session di kembalikan ke halaman login
      redirect('C_login', 'refresh');
    }
  }

  function approved_all()
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
      $data['Titel']          = 'Approval';
      $data['personalid']     = $session_data['personalid'];
      $data['personalstatus'] = $session_data['personalstatus'];

      $BagNm                  = $session_data['bagnm'];
      $jabnm                  = $session_data['jabnm'];

      $LevelUser              = $session_data['leveluserid'];
      $UserName               = $session_data['username'];
      $LevelUserNm            = $session_data['levelusernm'];

      $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
      $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

      $menus                  = $this->M_menu->menus($LevelUser);
      $data2                  = array('menus' => $menus);

      $levelnm                = $this->M_menu->getLevelnm($LevelUser);
      $datalv                 = array('levelnm' => $levelnm);

      //////////////////////////////////
      /// prevent direct url accses
      $session_data = $this->session->userdata('logged_in');
      $leveluid     = $session_data['leveluserid'];
      $url_str      = uri_string();

      $akses_check = $this->M_user->check_akses_bylevelid($leveluid, 'C_approval');
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

      $app_by         = $this->input->post('app_by');
      $app_date       = date('Y-m-d');
      $app_time       = date('H:i:s');
      $app_position   = $this->input->post('app_position');
      $app_comp       = $_SERVER['REMOTE_ADDR'];
      $app_form       = $this->input->post('app_form');
      $app_tabel      = 'tblfrm' . $app_form . 'hdr';
      $app_headerid   = $this->input->post('app_all_' . $app_form);
      $app1_headerid  = $this->input->post('app1_all_' . $app_form);
      $app2_headerid  = $this->input->post('app2_all_' . $app_form);
      $app3_headerid  = $this->input->post('app3_all_' . $app_form);
      $personalid     = $this->input->post('personalid');
      $personalstatus = $this->input->post('personalstatus');

      $frm_vrs = $this->uri->segment(4); //untuk kalibrasi

      if (count($app_headerid) > 0) {
        $data_app_update =
          array(
            $app_position . '_by'             => $app_by,
            $app_position . '_date'           => $app_date,
            $app_position . '_time'           => $app_time,
            $app_position . '_position'       => $jabnm,
            $app_position . '_status'         => '1',
            $app_position . '_comp'           => $app_comp,
            $app_position . '_personalid'     => $personalid,
            $app_position . '_personalstatus' => $personalstatus,
            'comment'                       => NULL,
            'comment_by'                    => NULL,
            'comment_date'                  => NULL,
            'comment_time'                  => NULL,
            'comment_status'                => NULL
          );

        foreach ($app_headerid as $Hd) {
          $report =  $this->M_approval->update_approval($data_app_update, $Hd, $app_tabel);
        }
      }

      if (count($app1_headerid) > 0) {
        $data_app1_update =
          array(
            'app1_by'             => $app_by,
            'app1_date'           => $app_date,
            'app1_time'           => $app_time,
            'app1_position'       => $app_position,
            'app1_status'         => '1',
            'app1_comp'           => $app_comp,
            'app1_personalid'     => $personalid,
            'app1_personalstatus' => $personalstatus,
            'comment'             => NULL,
            'comment_by'          => NULL,
            'comment_date'        => NULL,
            'comment_time'        => NULL,
            'comment_status'      => NULL
          );

        foreach ($app1_headerid as $Hd1) {
          $report1 =  $this->M_approval->update_approval1($data_app1_update, $Hd1, $app_tabel);
        }
      }

      if (count($app2_headerid) > 0) {
        $data_app2_update =
          array(
            'app2_by'             => $app_by,
            'app2_date'           => $app_date,
            'app2_time'           => $app_time,
            'app2_position'       => $app_position,
            'app2_status'         => '1',
            'app2_comp'           => $app_comp,
            'app2_personalid'     => $personalid,
            'app2_personalstatus' => $personalstatus,
            'comment'             => NULL,
            'comment_by'          => NULL,
            'comment_date'        => NULL,
            'comment_time'        => NULL,
            'comment_status'      => NULL
          );

        foreach ($app2_headerid as $Hd2) {
          $report2 =  $this->M_approval->update_approval2($data_app2_update, $Hd2, $app_tabel);
        }
      }

      if (count($app3_headerid) > 0) {
        $data_app3_update =
          array(
            'app3_by'             => $app_by,
            'app3_date'           => $app_date,
            'app3_time'           => $app_time,
            'app3_position'       => $app_position,
            'app3_status'         => '1',
            'app3_comp'           => $app_comp,
            'app3_personalid'     => $personalid,
            'app3_personalstatus' => $personalstatus,
            'comment'             => NULL,
            'comment_by'          => NULL,
            'comment_date'        => NULL,
            'comment_time'        => NULL,
            'comment_status'      => NULL
          );

        foreach ($app3_headerid as $Hd3) {
          $report3 =  $this->M_approval->update_approval3($data_app3_update, $Hd3, $app_tabel);
        }
      }

      redirect($this->input->post('redirect'));
      $this->openapp();
    } else {
      //Jika tidak ada session di kembalikan ke halaman login
      redirect('C_login', 'refresh');
    }
  }

  function approve()
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
      $data['Titel']          = 'Approval';
      $data['personalid']     = $session_data['personalid'];
      $data['personalstatus'] = $session_data['personalstatus'];

      $BagNm                  = $session_data['bagnm'];
      $jabnm                  = $session_data['jabnm'];

      $LevelUser              = $session_data['leveluserid'];
      $UserName               = $session_data['username'];
      $LevelUserNm            = $session_data['levelusernm'];

      $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
      $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

      $menus                  = $this->M_menu->menus($LevelUser);
      $data2                  = array('menus' => $menus);

      $frmkode                = $this->uri->segment(4);
      $frmvrs                 = $this->uri->segment(5);
      
      $dtfrm                  = $this->M_forminput->get_dtform($frmkode, $frmvrs);
      $data3                  = array('dtfrm' => $dtfrm);

      //////////////////////////////////
      /// prevent direct url accses
      $session_data = $this->session->userdata('logged_in');
      $leveluid     = $session_data['leveluserid'];
      $url_str      = uri_string();

      $akses_check = $this->M_user->check_akses_bylevelid($leveluid, 'C_approval');
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

      foreach ($dtfrm as $dtfrm_row) {
        $dt_parameter_jlh_approval = $dtfrm_row->parameter_jlh_approval;
        $dt_parameter_jenis_approval = $dtfrm_row->parameter_jenis_approval;
      }

      $app_date       = date('Y-m-d');

      $app_by         = $this->input->post('app_by');
      $app_time       = date('H:i:s');
      $app_position   = $this->input->post('app_position');
      $app_position2  = $this->input->post('app_position2');
      $app_comp       = $_SERVER['REMOTE_ADDR'];
      $personalid     = $this->input->post('personalid');
      $personalstatus = $this->input->post('personalstatus');
      $app_tabel      = 'tblfrm' . $frmkode . 'hdr';
      $Hd             = $this->input->post('headerid');
      $comment        = trim($this->input->post('comment'));

      if (trim($app_position2) != '') {
        $app_status     = 'app' . $app_position2 . '_status';
      } else {
        $app_status     = $app_position . '_status';
      }

      if (isset($_POST['btnproses'])) {
        $cek_status = $this->M_approval->cek_status($Hd, $app_tabel, $app_status);
        if ($cek_status->num_rows() > 0) {
          echo "<script>alert('Maaf laporan sudah diapprove....!!!! ');</script>";
        } else {
          if ($_POST['btnproses'] == 'btn_disapp') {

            if ($cekLevelUserNm == 'Auditor') {
              $dtl = 'status_detailx';
            } else {
              $dtl = 'status_detail';
            }

            if (trim($app_position2) != '') {
              if ($app_position == 'app1' || $app_position == 'app2' || $app_position == 'app3') {
                $data_app_update =
                  array(
                    'status_detail'       => '0',
                    'status_detailx'      => '0',
                    'app1_by'             => NULL,
                    'app1_date'           => NULL,
                    'app1_time'           => NULL,
                    'app1_position'       => NULL,
                    'app1_status'         => NULL,
                    'app1_comp'           => NULL,
                    'app2_by'             => NULL,
                    'app2_date'           => NULL,
                    'app2_time'           => NULL,
                    'app2_position'       => NULL,
                    'app2_status'         => NULL,
                    'app2_comp'           => NULL,
                    'app3_by'             => NULL,
                    'app3_date'           => NULL,
                    'app3_time'           => NULL,
                    'app3_position'       => NULL,
                    'app3_status'         => NULL,
                    'app3_comp'           => NULL,
                    'app1_personalid'     => NULL,
                    'app1_personalstatus' => NULL,
                    'app2_personalid'     => NULL,
                    'app2_personalstatus' => NULL,
                    'app3_personalid'     => NULL,
                    'app3_personalstatus' => NULL,
                    'comment_by'          => $app_by,
                    'comment_date'        => $app_date,
                    'comment_time'        => $app_time,
                    'comment_status'      => '1',
                    'comment'             => $comment
                  );
              } else {
                if ($app_position == 'app4') {
                  $data_app_update =
                    array(
                      'status_detail'     => '0',
                      'status_detailx'    => '0',
                      'app1_by'           => NULL,
                      'app1_date'         => NULL,
                      'app1_time'         => NULL,
                      'app1_position'     => NULL,
                      'app1_status'       => NULL,
                      'app1_comp'         => NULL,
                      'app2_by'           => NULL,
                      'app2_date'         => NULL,
                      'app2_time'         => NULL,
                      'app2_position'     => NULL,
                      'app2_status'       => NULL,
                      'app2_comp'         => NULL,
                      'app3_by'           => NULL,
                      'app3_date'         => NULL,
                      'app3_time'         => NULL,
                      'app3_position'     => NULL,
                      'app3_status'       => NULL,
                      'app3_comp'         => NULL,
                      'app4_by'           => NULL,
                      'app4_date'         => NULL,
                      'app4_time'         => NULL,
                      'app4_position'     => NULL,
                      'app4_status'       => NULL,
                      'app4_comp'         => NULL,
                      'comment_by'        => $app_by,
                      'comment_date'      => $app_date,
                      'comment_time'      => $app_time,
                      'comment_status'    => '1',
                      'comment'           => $comment
                    );
                } elseif ($app_position == 'app5') {
                  $data_app_update =
                    array(
                      'status_detail'     => '0',
                      'status_detailx'    => '0',
                      'app1_by'           => NULL,
                      'app1_date'         => NULL,
                      'app1_time'         => NULL,
                      'app1_position'     => NULL,
                      'app1_status'       => NULL,
                      'app1_comp'         => NULL,
                      'app2_by'           => NULL,
                      'app2_date'         => NULL,
                      'app2_time'         => NULL,
                      'app2_position'     => NULL,
                      'app2_status'       => NULL,
                      'app2_comp'         => NULL,
                      'app3_by'           => NULL,
                      'app3_date'         => NULL,
                      'app3_time'         => NULL,
                      'app3_position'     => NULL,
                      'app3_status'       => NULL,
                      'app3_comp'         => NULL,
                      'app4_by'           => NULL,
                      'app4_date'         => NULL,
                      'app4_time'         => NULL,
                      'app4_position'     => NULL,
                      'app4_status'       => NULL,
                      'app4_comp'         => NULL,
                      'app5_by'           => NULL,
                      'app5_date'         => NULL,
                      'app5_time'         => NULL,
                      'app5_position'     => NULL,
                      'app5_status'       => NULL,
                      'app5_comp'         => NULL,
                      'comment_by'        => $app_by,
                      'comment_date'      => $app_date,
                      'comment_time'      => $app_time,
                      'comment_status'    => '1',
                      'comment'           => $comment
                    );
                } elseif ($app_position == 'app6') {
                  $data_app_update =
                    array(
                      'status_detail'     => '0',
                      'status_detailx'    => '0',
                      'app1_by'           => NULL,
                      'app1_date'         => NULL,
                      'app1_time'         => NULL,
                      'app1_position'     => NULL,
                      'app1_status'       => NULL,
                      'app1_comp'         => NULL,
                      'app2_by'           => NULL,
                      'app2_date'         => NULL,
                      'app2_time'         => NULL,
                      'app2_position'     => NULL,
                      'app2_status'       => NULL,
                      'app2_comp'         => NULL,
                      'app3_by'           => NULL,
                      'app3_date'         => NULL,
                      'app3_time'         => NULL,
                      'app3_position'     => NULL,
                      'app3_status'       => NULL,
                      'app3_comp'         => NULL,
                      'app4_by'           => NULL,
                      'app4_date'         => NULL,
                      'app4_time'         => NULL,
                      'app4_position'     => NULL,
                      'app4_status'       => NULL,
                      'app4_comp'         => NULL,
                      'app5_by'           => NULL,
                      'app5_date'         => NULL,
                      'app5_time'         => NULL,
                      'app5_position'     => NULL,
                      'app5_status'       => NULL,
                      'app5_comp'         => NULL,
                      'app6_by'           => NULL,
                      'app6_date'         => NULL,
                      'app6_time'         => NULL,
                      'app6_position'     => NULL,
                      'app6_status'       => NULL,
                      'app6_comp'         => NULL,
                      'comment_by'        => $app_by,
                      'comment_date'      => $app_date,
                      'comment_time'      => $app_time,
                      'comment_status'    => '1',
                      'comment'           => $comment
                    );
                } elseif ($app_position == 'app7') {
                  $data_app_update =
                    array(
                      'status_detail'     => '0',
                      'status_detailx'    => '0',
                      'app1_by'           => NULL,
                      'app1_date'         => NULL,
                      'app1_time'         => NULL,
                      'app1_position'     => NULL,
                      'app1_status'       => NULL,
                      'app1_comp'         => NULL,
                      'app2_by'           => NULL,
                      'app2_date'         => NULL,
                      'app2_time'         => NULL,
                      'app2_position'     => NULL,
                      'app2_status'       => NULL,
                      'app2_comp'         => NULL,
                      'app3_by'           => NULL,
                      'app3_date'         => NULL,
                      'app3_time'         => NULL,
                      'app3_position'     => NULL,
                      'app3_status'       => NULL,
                      'app3_comp'         => NULL,
                      'app4_by'           => NULL,
                      'app4_date'         => NULL,
                      'app4_time'         => NULL,
                      'app4_position'     => NULL,
                      'app4_status'       => NULL,
                      'app4_comp'         => NULL,
                      'app5_by'           => NULL,
                      'app5_date'         => NULL,
                      'app5_time'         => NULL,
                      'app5_position'     => NULL,
                      'app5_status'       => NULL,
                      'app5_comp'         => NULL,
                      'app6_by'           => NULL,
                      'app6_date'         => NULL,
                      'app6_time'         => NULL,
                      'app6_position'     => NULL,
                      'app6_status'       => NULL,
                      'app6_comp'         => NULL,
                      'app7_by'           => NULL,
                      'app7_date'         => NULL,
                      'app7_time'         => NULL,
                      'app7_position'     => NULL,
                      'app7_status'       => NULL,
                      'app7_comp'         => NULL,
                      'comment_by'        => $app_by,
                      'comment_date'      => $app_date,
                      'comment_time'      => $app_time,
                      'comment_status'    => '1',
                      'comment'           => $comment
                    );
                } elseif ($app_position == 'app8') {
                  $data_app_update =
                    array(
                      'status_detail'     => '0',
                      'status_detailx'    => '0',
                      'app1_by'           => NULL,
                      'app1_date'         => NULL,
                      'app1_time'         => NULL,
                      'app1_position'     => NULL,
                      'app1_status'       => NULL,
                      'app1_comp'         => NULL,
                      'app2_by'           => NULL,
                      'app2_date'         => NULL,
                      'app2_time'         => NULL,
                      'app2_position'     => NULL,
                      'app2_status'       => NULL,
                      'app2_comp'         => NULL,
                      'app3_by'           => NULL,
                      'app3_date'         => NULL,
                      'app3_time'         => NULL,
                      'app3_position'     => NULL,
                      'app3_status'       => NULL,
                      'app3_comp'         => NULL,
                      'app4_by'           => NULL,
                      'app4_date'         => NULL,
                      'app4_time'         => NULL,
                      'app4_position'     => NULL,
                      'app4_status'       => NULL,
                      'app4_comp'         => NULL,
                      'app5_by'           => NULL,
                      'app5_date'         => NULL,
                      'app5_time'         => NULL,
                      'app5_position'     => NULL,
                      'app5_status'       => NULL,
                      'app5_comp'         => NULL,
                      'app6_by'           => NULL,
                      'app6_date'         => NULL,
                      'app6_time'         => NULL,
                      'app6_position'     => NULL,
                      'app6_status'       => NULL,
                      'app6_comp'         => NULL,
                      'app7_by'           => NULL,
                      'app7_date'         => NULL,
                      'app7_time'         => NULL,
                      'app7_position'     => NULL,
                      'app7_status'       => NULL,
                      'app7_comp'         => NULL,
                      'app8_by'           => NULL,
                      'app8_date'         => NULL,
                      'app8_time'         => NULL,
                      'app8_position'     => NULL,
                      'app8_status'       => NULL,
                      'app8_comp'         => NULL,
                      'comment_by'        => $app_by,
                      'comment_date'      => $app_date,
                      'comment_time'      => $app_time,
                      'comment_status'    => '1',
                      'comment'           => $comment
                    );
                } elseif ($app_position == 'app9') {
                  $data_app_update =
                    array(
                      'status_detail'     => '0',
                      'status_detailx'    => '0',
                      'app1_by'           => NULL,
                      'app1_date'         => NULL,
                      'app1_time'         => NULL,
                      'app1_position'     => NULL,
                      'app1_status'       => NULL,
                      'app1_comp'         => NULL,
                      'app2_by'           => NULL,
                      'app2_date'         => NULL,
                      'app2_time'         => NULL,
                      'app2_position'     => NULL,
                      'app2_status'       => NULL,
                      'app2_comp'         => NULL,
                      'app3_by'           => NULL,
                      'app3_date'         => NULL,
                      'app3_time'         => NULL,
                      'app3_position'     => NULL,
                      'app3_status'       => NULL,
                      'app3_comp'         => NULL,
                      'app4_by'           => NULL,
                      'app4_date'         => NULL,
                      'app4_time'         => NULL,
                      'app4_position'     => NULL,
                      'app4_status'       => NULL,
                      'app4_comp'         => NULL,
                      'app5_by'           => NULL,
                      'app5_date'         => NULL,
                      'app5_time'         => NULL,
                      'app5_position'     => NULL,
                      'app5_status'       => NULL,
                      'app5_comp'         => NULL,
                      'app6_by'           => NULL,
                      'app6_date'         => NULL,
                      'app6_time'         => NULL,
                      'app6_position'     => NULL,
                      'app6_status'       => NULL,
                      'app6_comp'         => NULL,
                      'app7_by'           => NULL,
                      'app7_date'         => NULL,
                      'app7_time'         => NULL,
                      'app7_position'     => NULL,
                      'app7_status'       => NULL,
                      'app7_comp'         => NULL,
                      'app8_by'           => NULL,
                      'app8_date'         => NULL,
                      'app8_time'         => NULL,
                      'app8_position'     => NULL,
                      'app8_status'       => NULL,
                      'app8_comp'         => NULL,
                      'app9_by'           => NULL,
                      'app9_date'         => NULL,
                      'app9_time'         => NULL,
                      'app9_position'     => NULL,
                      'app9_status'       => NULL,
                      'app9_comp'         => NULL,
                      'comment_by'        => $app_by,
                      'comment_date'      => $app_date,
                      'comment_time'      => $app_time,
                      'comment_status'    => '1',
                      'comment'           => $comment
                    );
                } elseif ($app_position == 'app10') {
                  $data_app_update =
                    array(
                      'status_detail'     => '0',
                      'status_detailx'    => '0',
                      'app1_by'           => NULL,
                      'app1_date'         => NULL,
                      'app1_time'         => NULL,
                      'app1_position'     => NULL,
                      'app1_status'       => NULL,
                      'app1_comp'         => NULL,
                      'app2_by'           => NULL,
                      'app2_date'         => NULL,
                      'app2_time'         => NULL,
                      'app2_position'     => NULL,
                      'app2_status'       => NULL,
                      'app2_comp'         => NULL,
                      'app3_by'           => NULL,
                      'app3_date'         => NULL,
                      'app3_time'         => NULL,
                      'app3_position'     => NULL,
                      'app3_status'       => NULL,
                      'app3_comp'         => NULL,
                      'app4_by'           => NULL,
                      'app4_date'         => NULL,
                      'app4_time'         => NULL,
                      'app4_position'     => NULL,
                      'app4_status'       => NULL,
                      'app4_comp'         => NULL,
                      'app5_by'           => NULL,
                      'app5_date'         => NULL,
                      'app5_time'         => NULL,
                      'app5_position'     => NULL,
                      'app5_status'       => NULL,
                      'app5_comp'         => NULL,
                      'app6_by'           => NULL,
                      'app6_date'         => NULL,
                      'app6_time'         => NULL,
                      'app6_position'     => NULL,
                      'app6_status'       => NULL,
                      'app6_comp'         => NULL,
                      'app7_by'           => NULL,
                      'app7_date'         => NULL,
                      'app7_time'         => NULL,
                      'app7_position'     => NULL,
                      'app7_status'       => NULL,
                      'app7_comp'         => NULL,
                      'app8_by'           => NULL,
                      'app8_date'         => NULL,
                      'app8_time'         => NULL,
                      'app8_position'     => NULL,
                      'app8_status'       => NULL,
                      'app8_comp'         => NULL,
                      'app9_by'           => NULL,
                      'app9_date'         => NULL,
                      'app9_time'         => NULL,
                      'app9_position'     => NULL,
                      'app9_status'       => NULL,
                      'app9_comp'         => NULL,
                      'app10_by'          => NULL,
                      'app10_date'        => NULL,
                      'app10_time'        => NULL,
                      'app10_position'    => NULL,
                      'app10_status'      => NULL,
                      'app10_comp'        => NULL,
                      'comment_by'        => $app_by,
                      'comment_date'      => $app_date,
                      'comment_time'      => $app_time,
                      'comment_status'    => '1',
                      'comment'           => $comment
                    );
                } else {
                  $data_app_update =
                    array(
                      'status_detail'     => '0',
                      'status_detailx'    => '0',
                      'comment_by'        => $app_by,
                      'comment_date'      => $app_date,
                      'comment_time'      => $app_time,
                      'comment_status'    => '1',
                      'comment'           => $comment
                    );
                }
              }
            } else {
              if ($app_position == 'app1') {
                $data_app_update =
                  array(
                    'status_detail'       => '0',
                    'status_detailx'      => '0',
                    'app1_by'             => NULL,
                    'app1_date'           => NULL,
                    'app1_time'           => NULL,
                    'app1_position'       => NULL,
                    'app1_status'         => NULL,
                    'app1_comp'           => NULL,
                    'app1_personalid'     => NULL,
                    'app1_personalstatus' => NULL,
                    'comment_by'          => $app_by,
                    'comment_date'        => $app_date,
                    'comment_time'        => $app_time,
                    'comment_status'      => '1',
                    'comment'             => $comment
                  );
              } elseif ($app_position == 'app2') {
                $data_app_update =
                  array(
                    'status_detail'       => '0',
                    'status_detailx'      => '0',
                    'app1_by'             => NULL,
                    'app1_date'           => NULL,
                    'app1_time'           => NULL,
                    'app1_position'       => NULL,
                    'app1_status'         => NULL,
                    'app1_comp'           => NULL,
                    'app2_by'             => NULL,
                    'app2_date'           => NULL,
                    'app2_time'           => NULL,
                    'app2_position'       => NULL,
                    'app2_status'         => NULL,
                    'app2_comp'           => NULL,
                    'app2_personalid'     => NULL,
                    'app2_personalstatus' => NULL,
                    'comment_by'          => $app_by,
                    'comment_date'        => $app_date,
                    'comment_time'        => $app_time,
                    'comment_status'      => '1',
                    'comment'             => $comment
                  );
              } elseif ($app_position == 'app3') {
                $data_app_update =
                  array(
                    'status_detail'       => '0',
                    'status_detailx'      => '0',
                    'app1_by'             => NULL,
                    'app1_date'           => NULL,
                    'app1_time'           => NULL,
                    'app1_position'       => NULL,
                    'app1_status'         => NULL,
                    'app1_comp'           => NULL,
                    'app2_by'             => NULL,
                    'app2_date'           => NULL,
                    'app2_time'           => NULL,
                    'app2_position'       => NULL,
                    'app2_status'         => NULL,
                    'app2_comp'           => NULL,
                    'app3_by'             => NULL,
                    'app3_date'           => NULL,
                    'app3_time'           => NULL,
                    'app3_position'       => NULL,
                    'app3_status'         => NULL,
                    'app3_comp'           => NULL,
                    'app3_personalid'     => NULL,
                    'app3_personalstatus' => NULL,
                    'comment_by'          => $app_by,
                    'comment_date'        => $app_date,
                    'comment_time'        => $app_time,
                    'comment_status'      => '1',
                    'comment'             => $comment
                  );
              } elseif ($app_position == 'app4') {
                $data_app_update =
                  array(
                    'status_detail'     => '0',
                    'status_detailx'    => '0',
                    'app1_by'           => NULL,
                    'app1_date'         => NULL,
                    'app1_time'         => NULL,
                    'app1_position'     => NULL,
                    'app1_status'       => NULL,
                    'app1_comp'         => NULL,
                    'app2_by'           => NULL,
                    'app2_date'         => NULL,
                    'app2_time'         => NULL,
                    'app2_position'     => NULL,
                    'app2_status'       => NULL,
                    'app2_comp'         => NULL,
                    'app3_by'           => NULL,
                    'app3_date'         => NULL,
                    'app3_time'         => NULL,
                    'app3_position'     => NULL,
                    'app3_status'       => NULL,
                    'app3_comp'         => NULL,
                    'app4_by'           => NULL,
                    'app4_date'         => NULL,
                    'app4_time'         => NULL,
                    'app4_position'     => NULL,
                    'app4_status'       => NULL,
                    'app4_comp'         => NULL,
                    'comment_by'        => $app_by,
                    'comment_date'      => $app_date,
                    'comment_time'      => $app_time,
                    'comment_status'    => '1',
                    'comment'           => $comment
                  );
              } elseif ($app_position == 'app5') {
                $data_app_update =
                  array(
                    'status_detail'     => '0',
                    'status_detailx'    => '0',
                    'app1_by'           => NULL,
                    'app1_date'         => NULL,
                    'app1_time'         => NULL,
                    'app1_position'     => NULL,
                    'app1_status'       => NULL,
                    'app1_comp'         => NULL,
                    'app2_by'           => NULL,
                    'app2_date'         => NULL,
                    'app2_time'         => NULL,
                    'app2_position'     => NULL,
                    'app2_status'       => NULL,
                    'app2_comp'         => NULL,
                    'app3_by'           => NULL,
                    'app3_date'         => NULL,
                    'app3_time'         => NULL,
                    'app3_position'     => NULL,
                    'app3_status'       => NULL,
                    'app3_comp'         => NULL,
                    'app4_by'           => NULL,
                    'app4_date'         => NULL,
                    'app4_time'         => NULL,
                    'app4_position'     => NULL,
                    'app4_status'       => NULL,
                    'app4_comp'         => NULL,
                    'app5_by'           => NULL,
                    'app5_date'         => NULL,
                    'app5_time'         => NULL,
                    'app5_position'     => NULL,
                    'app5_status'       => NULL,
                    'app5_comp'         => NULL,
                    'comment_by'        => $app_by,
                    'comment_date'      => $app_date,
                    'comment_time'      => $app_time,
                    'comment_status'    => '1',
                    'comment'           => $comment
                  );
              } elseif ($app_position == 'app6') {
                $data_app_update =
                  array(
                    'status_detail'     => '0',
                    'status_detailx'    => '0',
                    'app1_by'           => NULL,
                    'app1_date'         => NULL,
                    'app1_time'         => NULL,
                    'app1_position'     => NULL,
                    'app1_status'       => NULL,
                    'app1_comp'         => NULL,
                    'app2_by'           => NULL,
                    'app2_date'         => NULL,
                    'app2_time'         => NULL,
                    'app2_position'     => NULL,
                    'app2_status'       => NULL,
                    'app2_comp'         => NULL,
                    'app3_by'           => NULL,
                    'app3_date'         => NULL,
                    'app3_time'         => NULL,
                    'app3_position'     => NULL,
                    'app3_status'       => NULL,
                    'app3_comp'         => NULL,
                    'app4_by'           => NULL,
                    'app4_date'         => NULL,
                    'app4_time'         => NULL,
                    'app4_position'     => NULL,
                    'app4_status'       => NULL,
                    'app4_comp'         => NULL,
                    'app5_by'           => NULL,
                    'app5_date'         => NULL,
                    'app5_time'         => NULL,
                    'app5_position'     => NULL,
                    'app5_status'       => NULL,
                    'app5_comp'         => NULL,
                    'app6_by'           => NULL,
                    'app6_date'         => NULL,
                    'app6_time'         => NULL,
                    'app6_position'     => NULL,
                    'app6_status'       => NULL,
                    'app6_comp'         => NULL,
                    'comment_by'        => $app_by,
                    'comment_date'      => $app_date,
                    'comment_time'      => $app_time,
                    'comment_status'    => '1',
                    'comment'           => $comment
                  );
              } elseif ($app_position == 'app7') {
                $data_app_update =
                  array(
                    'status_detail'     => '0',
                    'status_detailx'    => '0',
                    'app1_by'           => NULL,
                    'app1_date'         => NULL,
                    'app1_time'         => NULL,
                    'app1_position'     => NULL,
                    'app1_status'       => NULL,
                    'app1_comp'         => NULL,
                    'app2_by'           => NULL,
                    'app2_date'         => NULL,
                    'app2_time'         => NULL,
                    'app2_position'     => NULL,
                    'app2_status'       => NULL,
                    'app2_comp'         => NULL,
                    'app3_by'           => NULL,
                    'app3_date'         => NULL,
                    'app3_time'         => NULL,
                    'app3_position'     => NULL,
                    'app3_status'       => NULL,
                    'app3_comp'         => NULL,
                    'app4_by'           => NULL,
                    'app4_date'         => NULL,
                    'app4_time'         => NULL,
                    'app4_position'     => NULL,
                    'app4_status'       => NULL,
                    'app4_comp'         => NULL,
                    'app5_by'           => NULL,
                    'app5_date'         => NULL,
                    'app5_time'         => NULL,
                    'app5_position'     => NULL,
                    'app5_status'       => NULL,
                    'app5_comp'         => NULL,
                    'app6_by'           => NULL,
                    'app6_date'         => NULL,
                    'app6_time'         => NULL,
                    'app6_position'     => NULL,
                    'app6_status'       => NULL,
                    'app6_comp'         => NULL,
                    'app7_by'           => NULL,
                    'app7_date'         => NULL,
                    'app7_time'         => NULL,
                    'app7_position'     => NULL,
                    'app7_status'       => NULL,
                    'app7_comp'         => NULL,
                    'comment_by'        => $app_by,
                    'comment_date'      => $app_date,
                    'comment_time'      => $app_time,
                    'comment_status'    => '1',
                    'comment'           => $comment
                  );
              } elseif ($app_position == 'app8') {
                $data_app_update =
                  array(
                    'status_detail'     => '0',
                    'status_detailx'    => '0',
                    'app1_by'           => NULL,
                    'app1_date'         => NULL,
                    'app1_time'         => NULL,
                    'app1_position'     => NULL,
                    'app1_status'       => NULL,
                    'app1_comp'         => NULL,
                    'app2_by'           => NULL,
                    'app2_date'         => NULL,
                    'app2_time'         => NULL,
                    'app2_position'     => NULL,
                    'app2_status'       => NULL,
                    'app2_comp'         => NULL,
                    'app3_by'           => NULL,
                    'app3_date'         => NULL,
                    'app3_time'         => NULL,
                    'app3_position'     => NULL,
                    'app3_status'       => NULL,
                    'app3_comp'         => NULL,
                    'app4_by'           => NULL,
                    'app4_date'         => NULL,
                    'app4_time'         => NULL,
                    'app4_position'     => NULL,
                    'app4_status'       => NULL,
                    'app4_comp'         => NULL,
                    'app5_by'           => NULL,
                    'app5_date'         => NULL,
                    'app5_time'         => NULL,
                    'app5_position'     => NULL,
                    'app5_status'       => NULL,
                    'app5_comp'         => NULL,
                    'app6_by'           => NULL,
                    'app6_date'         => NULL,
                    'app6_time'         => NULL,
                    'app6_position'     => NULL,
                    'app6_status'       => NULL,
                    'app6_comp'         => NULL,
                    'app7_by'           => NULL,
                    'app7_date'         => NULL,
                    'app7_time'         => NULL,
                    'app7_position'     => NULL,
                    'app7_status'       => NULL,
                    'app7_comp'         => NULL,
                    'app8_by'           => NULL,
                    'app8_date'         => NULL,
                    'app8_time'         => NULL,
                    'app8_position'     => NULL,
                    'app8_status'       => NULL,
                    'app8_comp'         => NULL,
                    'comment_by'        => $app_by,
                    'comment_date'      => $app_date,
                    'comment_time'      => $app_time,
                    'comment_status'    => '1',
                    'comment'           => $comment
                  );
              } elseif ($app_position == 'app9') {
                $data_app_update =
                  array(
                    'status_detail'     => '0',
                    'status_detailx'    => '0',
                    'app1_by'           => NULL,
                    'app1_date'         => NULL,
                    'app1_time'         => NULL,
                    'app1_position'     => NULL,
                    'app1_status'       => NULL,
                    'app1_comp'         => NULL,
                    'app2_by'           => NULL,
                    'app2_date'         => NULL,
                    'app2_time'         => NULL,
                    'app2_position'     => NULL,
                    'app2_status'       => NULL,
                    'app2_comp'         => NULL,
                    'app3_by'           => NULL,
                    'app3_date'         => NULL,
                    'app3_time'         => NULL,
                    'app3_position'     => NULL,
                    'app3_status'       => NULL,
                    'app3_comp'         => NULL,
                    'app4_by'           => NULL,
                    'app4_date'         => NULL,
                    'app4_time'         => NULL,
                    'app4_position'     => NULL,
                    'app4_status'       => NULL,
                    'app4_comp'         => NULL,
                    'app5_by'           => NULL,
                    'app5_date'         => NULL,
                    'app5_time'         => NULL,
                    'app5_position'     => NULL,
                    'app5_status'       => NULL,
                    'app5_comp'         => NULL,
                    'app6_by'           => NULL,
                    'app6_date'         => NULL,
                    'app6_time'         => NULL,
                    'app6_position'     => NULL,
                    'app6_status'       => NULL,
                    'app6_comp'         => NULL,
                    'app7_by'           => NULL,
                    'app7_date'         => NULL,
                    'app7_time'         => NULL,
                    'app7_position'     => NULL,
                    'app7_status'       => NULL,
                    'app7_comp'         => NULL,
                    'app8_by'           => NULL,
                    'app8_date'         => NULL,
                    'app8_time'         => NULL,
                    'app8_position'     => NULL,
                    'app8_status'       => NULL,
                    'app8_comp'         => NULL,
                    'app9_by'           => NULL,
                    'app9_date'         => NULL,
                    'app9_time'         => NULL,
                    'app9_position'     => NULL,
                    'app9_status'       => NULL,
                    'app9_comp'         => NULL,
                    'comment_by'        => $app_by,
                    'comment_date'      => $app_date,
                    'comment_time'      => $app_time,
                    'comment_status'    => '1',
                    'comment'           => $comment
                  );
              } elseif ($app_position == 'app10') {
                $data_app_update =
                  array(
                    'status_detail'     => '0',
                    'status_detailx'    => '0',
                    'app1_by'           => NULL,
                    'app1_date'         => NULL,
                    'app1_time'         => NULL,
                    'app1_position'     => NULL,
                    'app1_status'       => NULL,
                    'app1_comp'         => NULL,
                    'app2_by'           => NULL,
                    'app2_date'         => NULL,
                    'app2_time'         => NULL,
                    'app2_position'     => NULL,
                    'app2_status'       => NULL,
                    'app2_comp'         => NULL,
                    'app3_by'           => NULL,
                    'app3_date'         => NULL,
                    'app3_time'         => NULL,
                    'app3_position'     => NULL,
                    'app3_status'       => NULL,
                    'app3_comp'         => NULL,
                    'app4_by'           => NULL,
                    'app4_date'         => NULL,
                    'app4_time'         => NULL,
                    'app4_position'     => NULL,
                    'app4_status'       => NULL,
                    'app4_comp'         => NULL,
                    'app5_by'           => NULL,
                    'app5_date'         => NULL,
                    'app5_time'         => NULL,
                    'app5_position'     => NULL,
                    'app5_status'       => NULL,
                    'app5_comp'         => NULL,
                    'app6_by'           => NULL,
                    'app6_date'         => NULL,
                    'app6_time'         => NULL,
                    'app6_position'     => NULL,
                    'app6_status'       => NULL,
                    'app6_comp'         => NULL,
                    'app7_by'           => NULL,
                    'app7_date'         => NULL,
                    'app7_time'         => NULL,
                    'app7_position'     => NULL,
                    'app7_status'       => NULL,
                    'app7_comp'         => NULL,
                    'app8_by'           => NULL,
                    'app8_date'         => NULL,
                    'app8_time'         => NULL,
                    'app8_position'     => NULL,
                    'app8_status'       => NULL,
                    'app8_comp'         => NULL,
                    'app9_by'           => NULL,
                    'app9_date'         => NULL,
                    'app9_time'         => NULL,
                    'app9_position'     => NULL,
                    'app9_status'       => NULL,
                    'app9_comp'         => NULL,
                    'app10_by'          => NULL,
                    'app10_date'        => NULL,
                    'app10_time'        => NULL,
                    'app10_position'    => NULL,
                    'app10_status'      => NULL,
                    'app10_comp'        => NULL,
                    'comment_by'        => $app_by,
                    'comment_date'      => $app_date,
                    'comment_time'      => $app_time,
                    'comment_status'    => '1',
                    'comment'           => $comment
                  );
              } else {
                $data_app_update =
                  array(
                    'status_detail'     => '0',
                    'status_detailx'    => '0',
                    'comment_by'        => $app_by,
                    'comment_date'      => $app_date,
                    'comment_time'      => $app_time,
                    'comment_status'    => '1',
                    'comment'           => $comment
                  );
              }
            }
            if ($dt_parameter_jenis_approval == 'Shift') {
              $arr_st_detail = array(
                'status_detail_sf1'  => '0',
                'status_detailx_sf1' => '0',
                'status_detail_sf2'  => '0',
                'status_detailx_sf2' => '0',
                'status_detail_sf3'  => '0',
                'status_detailx_sf3' => '0',
              );
              $data_app_update = array_merge($data_app_update, $arr_st_detail);
            }

            $alert = 'di disapprove';
          } else if ($_POST['btnproses'] == 'btn_app') {
            if (trim($app_position2) != '') {
              if ($app_position2 < $dt_parameter_jlh_approval) {
                $data_app_update =
                  array(
                    'app' . $app_position2 . '_by'             => $app_by,
                    'app' . $app_position2 . '_date'           => $app_date,
                    'app' . $app_position2 . '_time'           => $app_time,
                    'app' . $app_position2 . '_position'       => $jabnm,
                    'app' . $app_position2 . '_status'         => '1',
                    'app' . $app_position2 . '_comp'           => $app_comp,
                    'app' . $app_position2 . '_personalid'     => $personalid,
                    'app' . $app_position2 . '_personalstatus' => $personalstatus

                  );
              } else {
                $data_app_update =
                  array(
                    'app' . $app_position2 . '_by'             => $app_by,
                    'app' . $app_position2 . '_date'           => $app_date,
                    'app' . $app_position2 . '_time'           => $app_time,
                    'app' . $app_position2 . '_position'       => $jabnm,
                    'app' . $app_position2 . '_status'         => '1',
                    'app' . $app_position2 . '_comp'           => $app_comp,
                    'app' . $app_position2 . '_personalid'     => $personalid,
                    'app' . $app_position2 . '_personalstatus' => $personalstatus,
                    'comment_by'                           => NULL,
                    'comment_date'                         => NULL,
                    'comment_time'                         => NULL,
                    'comment_status'                       => NULL,
                    'comment'                              => NULL
                  );
              }
            } else {
              if (substr($app_position, 3) < $dt_parameter_jlh_approval) {
               
                $data_app_update =
                  array(
                    $app_position . '_by'             => $app_by,
                    $app_position . '_date'           => $app_date,
                    $app_position . '_time'           => $app_time,
                    $app_position . '_position'       => $jabnm,
                    $app_position . '_status'         => '1',
                    $app_position . '_comp'           => $app_comp,
                    $app_position . '_personalid'     => $personalid,
                    $app_position . '_personalstatus' => $personalstatus
                  );
              } else {
                $data_app_update =
                  array(
                    $app_position . '_by'             => $app_by,
                    $app_position . '_date'           => $app_date,
                    $app_position . '_time'           => $app_time,
                    $app_position . '_position'       => $jabnm,
                    $app_position . '_status'         => '1',
                    $app_position . '_comp'           => $app_comp,
                    $app_position . '_personalid'     => $personalid,
                    $app_position . '_personalstatus' => $personalstatus,
                    'comment_by'                    => NULL,
                    'comment_date'                  => NULL,
                    'comment_time'                  => NULL,
                    'comment_status'                => NULL,
                    'comment'                       => NULL
                  );
                  if($frmkode == "frmfss319"){
                    if ($app_position == 'app3'){
                        $data_boiler = $this->M_approval->get_data_boiler($Hd);

                        foreach($data_boiler as $data_blr_row){
                            $detail_id_c[]            = $data_blr_row->detail_id_c;
                            $headerid[]               = $data_blr_row->headerid;
                            $stdtl[]                  = $data_blr_row->stdtl;
                            $dtlc_kode_boiler[]       = $data_blr_row->dtlc_kode_boiler;
                            $dtlc_total_jam[]         = $data_blr_row->dtlc_total_jam;
                            $dtlc_jam_akm[]           = $data_blr_row->dtlc_jam_akm;
                            $dtlc_tmpr_kg[]           = $data_blr_row->dtlc_tmpr_kg;
                            $dtlc_tmpr_akm[]          = $data_blr_row->dtlc_tmpr_akm;
                            $dtlc_steam_ton[]         = $data_blr_row->dtlc_steam_ton;
                            $dtlc_steam_akm[]         = $data_blr_row->dtlc_steam_akm;
                            $dtlc_total_air[]         = $data_blr_row->dtlc_total_air;
                            $dtlc_air_akm[]           = $data_blr_row->dtlc_air_akm;
                            $dtlc_item_id[]           = $data_blr_row->dtlc_item_id;
                            $dtlc_jam_akm_awal[]      = $data_blr_row->dtlc_jam_akm_awal;
                            $dtlc_tmpr_akm_awal[]     = $data_blr_row->dtlc_tmpr_akm_awal;
                            $dtlc_steam_akm_awal[]    = $data_blr_row->dtlc_steam_akm_awal;
                            $dtlc_air_akm_awal[]      = $data_blr_row->dtlc_air_akm_awal;
                            $create_date[]            = $data_blr_row->create_date;
                        }
                        // echo "<pre>";
                        // print_r ($data_boiler);exit();
                        // echo "</pre>";

                        $jml   = count($dtlc_kode_boiler);
                        if (isset($data_boiler)){
                        for ($i = 0; $i < $jml; $i++) {
                            $blr_data = array(
                                'detail_id'                => $detail_id_c[$i],
                                'headerid'                 => $headerid[$i],
                                'kode_boiler'              => $dtlc_kode_boiler[$i],
                                'jam_op_hari_ini'          => $dtlc_total_jam[$i],
                                'jam_op_akm'               => $dtlc_jam_akm[$i],
                                'pakai_tempurung_hari_ini' => $dtlc_tmpr_kg[$i],
                                'pakai_tempurung_akm'      => $dtlc_tmpr_akm[$i],
                                'output_steam_hari_ini'    => $dtlc_steam_ton[$i],
                                'output_steam_akm'         => $dtlc_steam_akm[$i],
                                'pakai_air_hari_ini'       => $dtlc_total_air[$i],
                                'pakai_air_akm'            => $dtlc_air_akm[$i],
                                'create_date'              => $create_date[$i],
                                'stdtl'                    => '1',
                            );
                            $this->M_approval->send_to_accounting($blr_data);
                        }
                    }

                    }
                }
              }
            }


            $alert = 'di approve';
          }

          $report =  $this->M_approval->update_approval($data_app_update, $Hd, $app_tabel);

          if ($report) {
            echo "<script>alert('Data berhasil $alert....!!!! ');</script>";
          } else {
            echo "<script>alert('Data batal $alert....!!!! ');</script>";
          }
        }
      }

      redirect("laporan/C_detail_laporan/opendetail/$frmkode/$frmvrs/dtlap/$Hd", "refresh");
    } else {
      //Jika tidak ada session di kembalikan ke halaman login
      redirect('C_login', 'refresh');
    }
  }
}
