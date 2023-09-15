<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_onelogin_verifikasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_user', '', TRUE); //nantinya diteruskan di user.php pada folder models
        $this->load->helper(array('date', 'url'));
    }

    function index()
    {
        //validasi field terhadap database
        $personalid     = $this->input->get('personalid');
        $personalstatus = $this->input->get('personalstatus');
        $appkey         = $this->input->get('appkey');
        //query ke database
        $result         = $this->M_user->login_onelogin($personalid, $personalstatus);

        if ($appkey == 'psgp1_eformutl' && $result) {
            $sess_array    = array();
            $dtcompany     = $this->M_user->get_allcompany();
            $dtdivisi      = $this->M_user->get_alldivisi();
            $dtdepartemen  = $this->M_user->get_alldepartemen();
            $dtbagian      = $this->M_user->get_allbagian();
            $dtjabatan     = $this->M_user->get_alljabatan();
            $result_jadwal = $this->M_user->check_jadwal_audit();

            foreach ($result as $result_row) {
                $userid = $result_row->userid;

                $companyid = $result_row->id_company;
                $companynm = '';
                foreach ($dtcompany as $dtcompany_row) {
                    if ($dtcompany_row->id_company == $result_row->id_company) {
                        $companynm = $dtcompany_row->company;
                        break;
                    }
                }

                $divisiid = $result_row->id_divisi;
                $divisinm = '';
                foreach ($dtdivisi as $dtdivisi_row) {
                    if ($dtdivisi_row->kodedivisi == $result_row->id_divisi) {
                        $divisinm = $dtdivisi_row->namadivisi;
                        break;
                    }
                }

                $deptid = $result_row->id_dept;
                $deptnm = '';
                foreach ($dtdepartemen as $dtdepartemen_row) {
                    if ($dtdepartemen_row->deptid == $result_row->id_dept) {
                        $deptnm = $dtdepartemen_row->deptabbr;
                        break;
                    }
                }

                $bagid = $result_row->id_bagian;
                $bagnm = '';
                foreach ($dtbagian as $dtbagian_row) {
                    if ($dtbagian_row->bagianid == $result_row->id_bagian) {
                        $bagnm = $dtbagian_row->bagianabbr;
                        break;
                    }
                }

                $jabid = $result_row->id_jabatan;
                $jabnm = '';
                foreach ($dtjabatan as $dtjabatan_row) {
                    if ($dtjabatan_row->jabatanid == $result_row->id_jabatan) {
                        $jabnm = $dtjabatan_row->namajabatan;
                        break;
                    }
                }

                $leveluserid     = $result_row->leveluserid;
                $levelusernm     = $result_row->levelusernm;

                $bagian_akses    = $result_row->bagian_akses;
                $ori_akses       = $result_row->ori_akses;
                $audit_akses     = $result_row->audit_akses;

                $username        = $result_row->username;
                $password        = $result_row->password;
                $nmdepan         = $result_row->nmdepan;
                $nmlengkap       = $result_row->nmlengkap;
                $status_password = $result_row->status_password;
                $personalid      = $result_row->personalid;
                $personalstatus  = $result_row->personalstatus;
            }

            if ($result_jadwal) {
                if (!preg_match('~MPD~', $bagnm) && !preg_match('~ITD~', $bagnm)) {
                    $vset_level = 'Auditor';
                    $von_audit  = '1';
                } else {
                    $vset_level = '';
                    $von_audit  = '1';
                }
            } else {
                $vset_level = '';
                $von_audit  = '0';
            }

            $sess_array = array(
                'userid'          => $userid,

                'companyid'       => $companyid,
                'companynm'       => $companynm,
                'divisiid'        => $divisiid,
                'divisinm'        => $divisinm,
                'deptid'          => $deptid,
                'deptnm'          => $deptnm,
                'bagid'           => $bagid,
                'bagnm'           => $bagnm,
                'jabid'           => $jabid,
                'jabnm'           => $jabnm,

                'leveluserid'     => $vset_level . $leveluserid,
                'levelusernm'     => $levelusernm,

                'bagian_akses'    => $bagian_akses,
                'ori_akses'       => $ori_akses,
                'audit_akses'     => $audit_akses,
                'on_audit'        => $von_audit,

                'username'        => $username,
                'password'        => $password,
                'nmdepan'         => $nmdepan,
                'nmlengkap'       => $nmlengkap,
                'status_password' => $status_password,
                'personalid'      => $personalid,
                'personalstatus'  => $personalstatus,
            );

            $this->session->set_userdata('logged_in', $sess_array);

            $this->set_info_device();
            $this->simpan_log();
            redirect('C_home', 'refresh');
        } else {
            redirect('/C_onelogin_logout/invalidaccess', 'refresh');
        }
    }

    function set_info_device()
    {
        $ipaddr = $_SERVER['REMOTE_ADDR'];
        $this->session->set_userdata('ipaddress', $ipaddr);

        // $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $hostname = $_SERVER['REMOTE_ADDR'];
        $this->session->set_userdata('hostname', $hostname);
    }

    function simpan_log()
    {

        date_default_timezone_set("Asia/Jakarta");

        $this->load->library(array('user_agent', 'Mobile_detect', 'Misc'));

        $detect = new Mobile_detect();

        $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? '' : '') : 'PC');

        foreach ($detect->getRules() as $name => $regex) :
            $check = $detect->{'is' . $name}();
            if ($check == 'true') {
                $deviceType .= $name . ' ';
            }
        endforeach;

        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser() . ' ' . $this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        $session_data = $this->session->userdata('logged_in');
        $username     = $session_data['username'];
        $logdate      = date("Y-m-d");
        $timein       = date("H:i d M Y");
        $timeout      = 'logged';
        $status       = 'online';

        $info = array(
            'username'  => strtoupper($username),
            'logdate'   => $logdate,
            'timein'    => $timein,
            'timeout'   => $timeout,
            'hostname'  => $this->session->userdata('hostname'),
            'ipaddress' => $this->session->userdata('ipaddress'),
            'device'    => $deviceType,
            'browser'   => $agent,
            'platform'  => $this->misc->platform(),
            'useragent' => $this->agent->agent_string(),
            'status'    => $status
        );

        $signid = $this->M_user->simpan_log($info);
    }
}
