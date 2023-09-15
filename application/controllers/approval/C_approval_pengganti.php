<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

//    session_start(); //Memanggil fungsi session Codeigniter
class C_approval_pengganti extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model(array('M_user', 'master/M_form', 'M_menu', 'form_input/M_forminput', 'approval/M_approval_pengganti'));
    $this->load->library(array('table', 'form_validation'));
    $this->load->helper('form');

    //////////////////////////////////
    /// prevent direct url accses
    $session_data = $this->session->userdata('logged_in');
    $leveluid     = $session_data['leveluserid'];
    $url_str      = uri_string();

    $akses_check = $this->M_user->check_akses_bylevelid($leveluid, 'C_approval_pengganti');
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

  function get_form_versi()
  {
    $formkodenm    = $this->input->post('formkodenm');
    $dt_formkodenm = $this->M_approval_pengganti->get_dt_formversi($formkodenm);
    $data2         = '';
    $data2 .= "<option value=''>- pilih -</option>";
    foreach ($dt_formkodenm as $row) {
      $data2   .= '<option value="' . $row['formversi'] . '">' . $row['formversi'] . '</option>';
    }
    echo $data2;
  }

  function get_form_jmlapp()
  {
    $formkodenm    = $this->input->post('formkodenm');
    $formversi     = $this->input->post('formversi');
    $dt_formjmlapp = $this->M_approval_pengganti->get_dt_jmlapp($formkodenm, $formversi);
    $data3         = '';
    $data3         .= "<option value=''>- pilih -</option>";
    foreach ($dt_formjmlapp as $row) {
      $data3   .= '<option value="' . $row['listapp'] . '">Approval ' . $row['listapp'] . '</option>';
    }
    echo $data3;
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
      $data['nmlengkap']      = $session_data['nmlengkap'];
      $data['levelusernm']    = $session_data['levelusernm'];
      $data['bagnm']          = $session_data['bagnm'];
      $data['jabnm']          = $session_data['jabnm'];
      $data['Titel']          = 'Approval - Pengganti';

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

      $fileaksi               = $this->uri->segment(4);

      foreach ($dtbutton as $dtbuttonrow) {
        $btn_create         = $dtbuttonrow->btn_create;
        $btn_update         = $dtbuttonrow->btn_update;
        $btn_delete         = $dtbuttonrow->btn_delete;
        $btn_delete_dh      = $dtbuttonrow->btn_delete_dh;
        $btn_export_pdf     = $dtbuttonrow->btn_export_pdf;
        $btn_export_excel   = $dtbuttonrow->btn_export_excel;
        $btn_restore        = $dtbuttonrow->btn_restore;
      }

      $head_restore = "";

      if (!isset($fileaksi)) {
        $data['createtable'] = "";

        $data['dtstart']  = "";
        $data['dtfinish'] = "";

        $data['frm_kode']  = "";
        $data['frm_versi'] = "";
        $data['lvlapp']    = "";

        $data['all_kode_form'] = $this->M_approval_pengganti->get_dt_formjnsnm();
        $this->load->view('approval/V_approval_pengganti', array_merge($data, $data2));
      } else {

        $data['dtstart']        = addslashes($this->input->post('dtstart'));
        $data['dtfinish']       = addslashes($this->input->post('dtfinish'));

        $data['frm_kode']       = addslashes($this->input->post('frm_kode'));
        $data['frm_versi']      = addslashes($this->input->post('frm_versi'));
        $data['lvlapp']         = addslashes($this->input->post('lvlapp'));

        $dtstart                = date("Y-m-d", strtotime(addslashes($this->input->post('dtstart'))));
        $dtfinish               = date("Y-m-d", strtotime(addslashes($this->input->post('dtfinish'))));

        $frmkode                = addslashes($this->input->post('frm_kode'));
        $frmvrs                 = addslashes($this->input->post('frm_versi'));
        $lvlapp                 = addslashes($this->input->post('lvlapp'));

        $data['all_kode_form']  = $this->M_approval_pengganti->get_dt_formjnsnm();
        $data['all_versi_form'] = $this->M_approval_pengganti->get_dt_formversi($frmkode);
        $data['all_jmlapp']     = $this->M_approval_pengganti->get_dt_jmlapp($frmkode, $frmvrs);

        $dtfrm                  = $this->M_forminput->get_dtform($frmkode, $frmvrs);
        $data3                  = array('dtfrm' => $dtfrm);

        foreach ($dtfrm as $datafrm) {
          $frmkd                 = $datafrm->formkd;
          $frm_vrs               = $datafrm->formversi;
          $frmefective_parameter = $datafrm->efective_parameter;
          $app_kategori = $datafrm->parameter_jenis_approval;
        }
        $tablehead = 'tblfrm' . $frmkd . 'hdr';

        switch ($lvlapp) {
          case $lvlapp == '1':
            $con_app = 'AND app1_status IS NULL';
            break;
          case $lvlapp == '2':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NULL';
            break;
          case $lvlapp == '3':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NULL';
            break;
          case $lvlapp == '4':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NULL';
            break;
          case $lvlapp == '5':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NULL';
            break;
          case $lvlapp == '6':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NULL';
            break;
          case $lvlapp == '7':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NULL';
            break;
          case $lvlapp == '8':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NULL';
            break;
          case $lvlapp == '9':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NOT NULL AND app9_status IS NULL';
            break;
          case $lvlapp == '10':
            $con_app = 'AND app1_status IS NOT NULL AND app2_status IS NOT NULL AND app3_status IS NOT NULL AND app4_status IS NOT NULL AND app5_status IS NOT NULL AND app6_status IS NOT NULL AND app7_status IS NOT NULL AND app8_status IS NOT NULL AND app9_status IS NOT NULL AND app10_status IS NULL';
            break;
          default:
            $con_app = '';
            break;
        }

        $head_checkbox = '<input type="checkbox" class="app_all_' . $frmkode . '" onClick="toggle(this)"/>';

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

        $dtquery = "select * from tblfrm" . $frmkode . "hdr where " . $frmefective_parameter . " >= '$dtstart' and " . $frmefective_parameter . " <= '$dtfinish' and $dtl='1' $con_app order by " . $frmefective_parameter . " desc";

        switch ($frmkode) {
          case $frmkode == "frmfss315":
          case $frmkode == "frmfss316":
          case $frmkode == "frmfss520":
            $itemhead = array('No', 'Tanggal Pembuatan Laporan', 'Doc No', 'Lihat Laporan', 'Export to Pdf', 'Export to excel', $head_restore);
            break;

          default:
            $itemhead = array('No', 'Tanggal Pembuatan Laporan', 'Lihat Laporan', 'Export to Pdf', 'Export to excel', $head_restore);
            break;
        }

        if ($cekLevelUserNm == 'Auditor') {
          $head_create_info = array();
        } else {
          switch (true) {
            case $frmkode == 'frmfss315':
            case $frmkode == 'frmfss520':
              $head_create_info = array('Komentar Disapprove <br> Sebelumnya', 'Dicek oleh shift 1 (OPR)', 'Dicek oleh shift 1 (KR)', 'Dicek oleh shift 2 (OPR)', 'Dicek oleh shift 2 (KR)', 'Dicek oleh shift 3 (OPR)', 'Dicek oleh shift 3 (KR)', 'Diketahui oleh', 'Disetujui oleh');
              break;

            default:
              $head_create_info = array('Komentar Disapprove <br> Sebelumnya', 'Dikomplit Oleh', 'Diketahui oleh', 'Disetujui oleh');
              break;
          }
        }

        array_splice($itemhead, -4, 0, $head_create_info);

        $dtlaporan = $this->M_forminput->get_datalaporan($dtquery);

        if (isset($dtlaporan)) {
          $tmpl = array('table_open'  => '<table id="example1" class="table table-striped table-bordered complex-headers">');
          $this->table->set_template($tmpl);
          $this->table->set_heading($itemhead);
          $no   = 0;

          foreach ($dtlaporan->result() as $row) {
            $tgl_parameter = $row->$frmefective_parameter;
            $dt_form_versi = $this->M_forminput->get_frmversi($frmkode, $tgl_parameter);
            $frm_vrs       = !empty($dt_form_versi) ? $dt_form_versi[0]->formversi : '';

            $no++;

            $links   = anchor_popup('laporan/C_detail_laporan/opendetail/' . $frmkode . '/' . $frm_vrs . '/dtlap/' . $row->headerid . '/app' . $lvlapp, '<span class="btn bg-gradient-info feather icon-search"></span>');
            $links2  = anchor('laporan/C_export_topdf/exporttopdf/' . $frmkode . '/' . $frm_vrs . '/export/' . $row->headerid, '<span class="btn bg-gradient-dark feather icon-download"></span>');
            $links3  = anchor('laporan/C_export_toexcel/exportxls/' . $frmkode . '/' . $frm_vrs . '/export/' . $row->headerid, '<span class="btn bg-gradient-success feather icon-download"></span>');
            $links4  = anchor('export_excel/C_export_toexcel_' . $frmkode . '_' . $frm_vrs . '/exportxls/' . $frmkode . '/' . $frm_vrs . '/' . $row->headerid, '<span class="btn bg-gradient-success feather icon-download"></span>');
            $links5  = anchor('laporan/C_restore/restore_laporan/' . $frmkode . '/' . $frm_vrs . '/export/' . $row->headerid, '<span class="btn bg-gradient-danger feather icon-rotate-ccw"></span>');

            if ($btn_restore == '1') {
              $item_restore = $links5;
            } else {
              $item_restore = "";
            }

            if ($cekLevelUserNm == 'Auditor') {
              $complete_date = $row->complete_datex;
              $complete_time = $row->complete_timex;
              $complete_by   = $row->complete_byx;
            } else {
              $complete_date = $row->complete_date;
              $complete_time = $row->complete_time;
              $complete_by   = $row->complete_by;
            }

            $chk_data = array(
              'name'    => 'app_all_' . $frmkode . '[]',
              'class'   => 'app_all_' . $frmkode,
              'value'   => $row->headerid,
              'checked' => False
            );

            $links_chk  = form_checkbox($chk_data);

            for ($i = 1; $i <= 10; $i++) {
              ${'str_app' . $i} = !empty($row->{'app' . $i . '_status'}) && $row->{'app' . $i . '_status'} == '1' ? $row->{'app' . $i . '_by'} . '<br/>' . date("d-m-Y", strtotime($row->{'app' . $i . '_date'})) . ' ' . $row->{'app' . $i . '_time'} : '';
            }

            $str_comment = !empty($row->comment_status) && $row->comment_status == '1' ? $row->comment . ' <br/>(' . $row->comment_by . ' ' . date("d-m-Y", strtotime($row->comment_date)) . ' ' . $row->comment_time . ')' : '';

            switch ($frmkode) {
              case $frmkode == "frmfss315":
              case $frmkode == "frmfss316":
              case $frmkode == "frmfss520":
                $itemarray = array(
                  $no,
                  date("d-m-Y", strtotime($row->create_date)),
                  $row->docno,
                  $links,
                  $links2,
                  $links4,
                  $links_chk
                );
                break;

              default:
                $itemarray = array(
                  $no,
                  date("d-m-Y", strtotime($row->$frmefective_parameter)),
                  $links,
                  $links2,
                  $links4,
                  $links_chk
                );
                break;
            }

            if ($cekLevelUserNm == 'Auditor') {
              $val_create_info = array();
            } else {
              switch (true) {
                case $frmkode == 'frmfss315':
                case $frmkode == 'frmfss520':
                  $val_create_info = array($str_comment, $str_app1, $str_app2, $str_app3, $str_app4, $str_app5, $str_app6, $str_app7, $str_app8);
                  break;

                default:
                  $val_create_info = array($str_comment, $complete_by . '<br/>' . date("d-m-Y", strtotime($complete_date)) . ' ' . $complete_time, $str_app1, $str_app2);
                  break;
              }
            }

            array_splice($itemarray, -4, 0, $val_create_info);

            $this->table->add_row($itemarray);
          }

          $data['createtable'] = $this->table->generate();
        } else {
          $data['createtable'] = '';
        }

        switch ($frmkode) {
          default:
            $this->load->view('approval/V_approval_pengganti', array_merge($data, $data2, $data3));
            break;
        }
      }
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
      $data['Titel']          = 'Home';

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

      $app_by                 = $this->input->post('app_by');
      $app_date               = date('Y-m-d');
      $app_time               = date('H:i:s');
      $app_position           = $this->input->post('app_position');
      $app_comp               = gethostbyaddr($_SERVER['REMOTE_ADDR']);
      $app_form               = $this->input->post('app_form');
      $app_tabel              = 'tblfrm' . $app_form . 'hdr';
      $app_headerid           = $this->input->post('app_all_' . $app_form);

      if (count($app_headerid) > 0) {
        $data_app_update =
          array(
            $app_position . '_by'        => $app_by,
            $app_position . '_date'      => $app_date,
            $app_position . '_time'      => $app_time,
            $app_position . '_position'  => $jabnm,
            $app_position . '_status'    => '1',
            $app_position . '_comp'      => $app_comp
          );

        foreach ($app_headerid as $Hd) {
          $report =  $this->M_approval_pengganti->update_approval($data_app_update, $Hd, $app_tabel);
          if ($report) {
            echo "<script>alert('Data berhasil diapprove....!!!! ');</script>";
          }
        }
      }

      echo "<script>
                    window.onunload = refreshParent;
                    function refreshParent() {
                        window.opener.location.reload();
                    }
                    window.close();
                </script>";
    } else {
      //Jika tidak ada session di kembalikan ke halaman login
      redirect('C_login', 'refresh');
    }
  }
}
