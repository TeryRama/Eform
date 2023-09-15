<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//    session_start(); //Memanggil fungsi session Codeigniter
class C_forminput extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $frmkode = $this->uri->segment(4);
        $frmvrs = $this->uri->segment(5);
        $this->load->model(array('M_user', 'master/M_form', 'M_menu', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs, 'master/M_mst_departemen'));
        $this->load->library(array('table', 'form_validation'));

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

    function openfrm()
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
            $data['bagian_akses']   = $session_data['bagian_akses'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['personalid']     = $session_data['personalid'];
            $data['personalstatus'] = $session_data['personalstatus'];
            $data['Titel']          = 'FORM INPUT';

            $BagianAkses            = $session_data['bagian_akses'];
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);

            $frmkode                = $this->uri->segment(4);
            $frmvrs                 = $this->uri->segment(5);

            $dtfrm                  = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
            $data3                  = array('dtfrm' => $dtfrm);

            foreach ($dtfrm as $dtfrm_row) {
                $formnm = $dtfrm_row->formnm;
            }

            $model                  = 'M_form' . $frmkode . '_' . $frmvrs;

            $this->model2 = $this->{'M_form' . $frmkode . '_' . $frmvrs};

            // $str_BagianAkses = "'".implode(",",$BagianAkses)."'";
            switch ($frmkode) {
                case 'frmfss064':
                case 'frmfss065':
                case 'frmfss187':
                case 'frmfss812':
                case 'frmfss846':
                    $data['dttahun']          = date('Y');
                    $data['dtcreate_date']    = date('Y-m-d');
                    $data['list_pj']          = $this->M_forminput->get_list_pj($data['dtcreate_date'], $formnm);
                    $data['dtdept']           = $this->M_forminput->get_records_payroll($BagianAkses);
                    $data['dtkomponenmesin']  = $this->M_forminput->get_all_komponenmesin($BagianAkses);
                    break;
                case 'intwtd009':
                    $data['dttahun']          = date('Y');
                    $data['dtcreate_date']    = date('Y-m-d');
                    $data['list_pj']          = $this->M_forminput->get_list_pj($data['dtcreate_date'], $formnm);
                    $data['dtdept']           = $this->M_forminput->get_records_payroll($BagianAkses);
                    $data['dtkomponenmesin']  = $this->M_forminput->get_all_komponenmesin_trafo();
                    // print_r($data['dtkomponenmesin']);
                    // die;
                    break;
                case 'frmfss054':
                case 'frmfss061':
                    $data['dtcreate_date'] = date('Y-m-d');
                    $data['dttahun']       = date('Y');
                    $data['dtdept']        = $this->M_forminput->get_records_payroll($BagianAkses);
                    $data['list_month']    = $this->$model->get_month(date('Y'));
                    break;
                case 'frmfss847':
                    $data['dttahun']          = date('Y');
                    $data['dtcreate_date']    = date('Y-m-d');
                    $data['list_pj']          = $this->M_forminput->get_list_pj($data['dtcreate_date'], $formnm);
                    $data['dtdept']           = $this->M_forminput->get_records_payroll($BagianAkses);
                    $data['dtkomponenmesin']  = $this->M_forminput->get_all_komponenmesin($BagianAkses);
                    // $data['list_month']    = $this->$model->get_month(date('Y'));
                    break;
                case 'frmfss317':
                    $data['dtcreate_date']    = date('Y-m-d');
                    $data['dtpersen']         = 0.9;
                    break;
                case 'frmfss188':
                    $data['dtcreate_date'] = date('Y-m-d');
                    $data['dtdept']        = $this->M_forminput->get_records_payroll($BagianAkses);
                    $data['list_pj']       = $this->M_forminput->get_list_pj($data['dtcreate_date'], $formnm);
                    break;
                case 'frmfss520':
                    $data['dtcreate_date'] = date('Y-m-d');
                    $data['page_shift']    = 'Shift 1';
                    $data['list_pj']       = $this->M_forminput->get_list_pj($data['dtcreate_date'], $formnm);
                    break;
                case 'frmfss031':
                    $data['dtcreate_date'] = date('Y-m-d');
                    $data['dtdept']           = $this->M_forminput->get_records_payroll($BagianAkses);
                    break;
                case 'frmfss062':
                case 'frmfss845':
                    $data['dtcreate_date'] = date('Y-m-d');
                    $data['dtdept']        = $this->M_forminput->get_records_payroll($BagianAkses);
                case 'frmfss060':
                    $data['dtcreate_date'] = date('Y-m-d');
                    $data['dtperiode']     = date('Y-m');
                    $data['dtdept']        = $this->M_forminput->get_records_payroll($BagianAkses);
                    break;
                case 'inttbn040':
                    $data['dtcreate_date'] = date('Y-m-d');
                    $data['list_pj']  = $this->$model->get_list_pj($data['dtcreate_date']);
                    break;
                case 'intwtd005':
                    $data['dtcreate_date'] = date('Y-m-d');
                    $data['dtbulan'] = date('m');
                    $data['dtkomponenmesin']  = $this->M_forminput->get_all_komponenmesin($BagianAkses);
                    break;
                default:
                    $data['dtcreate_date'] = date('Y-m-d');
                    $data['page_shift']    = 'Shift 1';
                    break;
            }

            $this->load->view('form_input/V_form' . $frmkode . '_' . $frmvrs, array_merge($data, $data2, $data3));
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function delete_file()
    {
        $session_data           = $this->session->userdata('logged_in');
        $data['username']       = $session_data['username'];
        $data['password']       = $session_data['password'];
        $data['jabid']          = $session_data['jabid'];
        $data['leveluserid']    = $session_data['leveluserid'];
        $data['nmdepan']        = $session_data['nmdepan'];
        $data['nmlengkap']      = $session_data['nmlengkap'];
        $data['levelusernm']    = $session_data['levelusernm'];
        $data['bagian_akses']   = $session_data['bagian_akses'];
        $data['bagnm']          = $session_data['bagnm'];
        $data['jabnm']          = $session_data['jabnm'];
        $data['personalid']     = $session_data['personalid'];
        $data['personalstatus'] = $session_data['personalstatus'];
        $data['Titel']          = 'FORM INPUT';

        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];

        $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
        $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

        $menus                  = $this->M_menu->menus($LevelUser);
        $data2                  = array('menus' => $menus);

        $frmkode                = $this->uri->segment(4);
        $frmvrs                 = $this->uri->segment(5);
        $aksi                   = $this->uri->segment(6);
        $id                     = $this->uri->segment(7);

        $dtfrm                  = $this->M_forminput->get_dtform_by_level($frmkode, $frmvrs, $LevelUser);
        $data3                  = array('dtfrm' => $dtfrm);

        foreach ($dtfrm as $datafrm) {
            $frmkd = $datafrm->formkd;
        }

        switch ($frmkode) {
            case 'frmfss187';
                $tablehead    = 'tblfrm' . $frmkd . 'hdr';

                switch ($aksi) {
                    case $aksi == 'dtdelete':
                        $delete = $this->M_forminput->delete_data_hdr($tablehead, $id, $UserName, $frmkode);
                        redirect('data_harian/C_dataharian/opendata/' . $frmkode . '/' . $frmvrs);
                        break;
                    case $aksi == 'lapdelete':
                        $this->M_forminput->delete_laporan_hdr($tablehead, $id, $UserName);
                        redirect('data_harian/C_dataharian/openlap/' . $frmkode . '/' . $frmvrs);
                        break;
                    case $aksi == 'appdelete':
                        $this->M_forminput->delete_approval($tablehead, $id);
                        redirect('data_harian/C_dataharian/openapp/' . $frmkode . '/' . $frmvrs);
                        break;
                    default:
                        break;
                }
                break;
            default:
                $tablehead    = 'tblfrm' . $frmkd . 'hdr';
                $tabledetail  = 'tblfrm' . $frmkd . 'dtl';
                $tabledetailx = 'tblfrm' . $frmkd . 'dtlx';

                switch ($aksi) {
                    case $aksi == 'dtdelete':
                        $delete = $this->M_forminput->delete_data($tablehead, $tabledetail, $tabledetailx, $id, $UserName, $frmkode);
                        redirect('data_harian/C_dataharian/opendata/' . $frmkode . '/' . $frmvrs);
                        break;
                    case $aksi == 'lapdelete':
                        $this->M_forminput->delete_laporan($tablehead, $tabledetail, $tabledetailx, $id, $UserName);
                        redirect('data_harian/C_dataharian/openlap/' . $frmkode . '/' . $frmvrs);
                        break;
                    case $aksi == 'appdelete':
                        $this->M_forminput->delete_approval($tablehead, $id);
                        redirect('data_harian/C_dataharian/openapp/' . $frmkode . '/' . $frmvrs);
                        break;
                    default:
                        break;
                }
                break;
        }
    }
}
