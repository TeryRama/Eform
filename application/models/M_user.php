<?php 
Class M_user extends CI_Model {

    function __construct(){
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1',TRUE);
    }

    function get_allcompany(){
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_company"));
    }

    function get_alldivisi(){
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_divisi"));
    }
    
    function get_alldepartemen(){
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_departemen"));
    }
    
    function get_allbagian(){
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_bagian"));
    }
    
    function get_alljabatan(){
        return json_decode($this->curl->simple_get(setAPI()."p1_get_all_jabatan2"));
    }

    function login($username, $password) {
        // cek status user app
        $query = $this -> db -> query("select *,
            CASE WHEN (select last_update_password + interval '3 month' from view_data_user
            where username='$username' AND password='$password' and inactive = '0') < current_date THEN 'Password Expired'
            ELSE 'Password Ok' END AS status_password
            from view_data_user
            where username='$username' AND password='$password' and inactive = '0'");

        if($query->num_rows() == 1) {
            $dtpersonalid     = $query->row()->personalid;
            $dtpersonalstatus = $query->row()->personalstatus;
        }else{
            $dtpersonalid     = '';
            $dtpersonalstatus = '';
        }

        $datapost       = array(
            'personalid'     => $dtpersonalid,
            'personalstatus' => $dtpersonalstatus
        );

        // cek status personal aktif
        $q2 = json_decode($this->curl->simple_post(setAPI2()."get_byno_personal",$datapost,array(CURLOPT_BUFFERSIZE => 10))); 

        if($query -> num_rows() == 1 && count($q2) > 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    function login_onelogin($personalid, $personalstatus) {
        $datapost       = array(
            'personalid'     => $personalid, 
            'personalstatus' => $personalstatus 
        );

        // cek status personal aktif
        $q2 = json_decode($this->curl->simple_post(setAPI2()."get_byno_personal",$datapost,array(CURLOPT_BUFFERSIZE => 10)));
        
        // cek status online onelogin
        $this->load->library(array('user_agent', 'Mobile_detect', 'Misc'));
        $detect = new Mobile_Detect();
        if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS()) {
            // cek status online onelogin andro (bg agung)
            $q3 = json_decode($this->curl->simple_post(setAPI3() . "WTPOneLogin/cekHistory", $datapost, array(CURLOPT_BUFFERSIZE => 10)));
        } else {
            // cek status online onelogin PC (pak heri)
            $q3 = json_decode($this->curl->simple_post(setAPI2() . "get_useron_onelogin", $datapost, array(CURLOPT_BUFFERSIZE => 10)));
        }

        // cek status user app
        if(count($q2) > 0 && count($q3) > 0) {
            $query = $this->db->query("select *, now()::date as status_password from view_data_user where personalid='$personalid' AND personalstatus='$personalstatus' and levelusernm not like 'Auditor%' and inactive = '0'");
        }

        if(isset($query) && $query->num_rows()==1) {
            return $query->result();
        } else{
            return false;
        }
    }

    function check_user_login($username, $ipaddr, $date_now)
    {
        $this->db->select('*');
        $this->db->from('tblmst_user_logonline');
        $this->db->where('username', $username);
        $this->db->where('ipaddress !=', $ipaddr);
        $this->db->where('status', 'online');
        $this->db->where('device !=', 'PC');
        $this->db->where('logdate', $date_now);
        $query = $this->db->get()->result();
        return $query;
    }

    function check_user_login2($username, $ipaddr, $date_now)
    {
        $this->db->select('*');
        $this->db->from('tblmst_user_logonline');
        $this->db->where('username !=', $username);
        $this->db->where('ipaddress', $ipaddr);
        $this->db->where('status', 'online');
        $this->db->where('device !=', 'PC');
        $this->db->where('logdate', $date_now);
        $query = $this->db->get()->result();
        return $query;
    }

    function cek_status_login($username, $ipaddr, $date_now)
    {
        $this->load->library(array('user_agent', 'Mobile_detect', 'Misc'));
        $detect = new Mobile_Detect();
        if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS()) {
            $this->db->select('*');
            $this->db->limit(1);
            $this->db->from('tblmst_user_logonline');
            $this->db->where('username', $username);
            $this->db->where('ipaddress', $ipaddr);
            $this->db->where('device !=', 'PC');
            $this->db->where('logdate', $date_now);
            $this->db->order_by('logid', 'DESC');
            $query = $this->db->get()->result();
        } else {
            $this->db->select('*');
            $this->db->limit(1);
            $this->db->from('tblmst_user_logonline');
            $this->db->where('username', $username);
            $this->db->where('ipaddress', $ipaddr);
            $this->db->where('device =', 'PC');
            $this->db->where('logdate', $date_now);
            $this->db->order_by('logid', 'DESC');
            $query = $this->db->get()->result();
        }
        return $query;
    }

    function cek_status_login_row($username, $ipaddr, $date_now)
    {
        $this->load->library(array('user_agent', 'Mobile_detect', 'Misc'));
        $detect = new Mobile_Detect();
        if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS()) {
            $this->db->select('*');
            $this->db->limit(1);
            $this->db->from('tblmst_user_logonline');
            $this->db->where('username', $username);
            $this->db->where('ipaddress', $ipaddr);
            $this->db->where('device !=', 'PC');
            $this->db->where('logdate', $date_now);
            $this->db->order_by('logid', 'DESC');
            $query = $this->db->get()->row();
        } else {
            $this->db->select('*');
            $this->db->limit(1);
            $this->db->from('tblmst_user_logonline');
            $this->db->where('username', $username);
            $this->db->where('ipaddress', $ipaddr);
            $this->db->where('device =', 'PC');
            $this->db->where('logdate', $date_now);
            $this->db->order_by('logid', 'DESC');
            $query = $this->db->get()->row();
        }
        return $query;
    }

    function simpan_log($info) {
        $this->db->trans_start();
        $this->db->insert('tblmst_user_logonline', $info);
        $signid = $this->db->insert_id();
        $this->db->trans_complete();
        return $signid;
    }

    function simpan_log_out($username,$logdate) {
        $this->db->trans_start();
        $this->db->query("Update tblmst_user_logonline set timeout=(select now()), status='offline' where username ='$username' and logdate='$logdate'");
        $this->db->trans_complete();
    }

    function check_jadwal_audit(){
        $query = $this ->db1->query("select * from tbltrn_jadwal_audit where jadwal_from <= current_date AND jadwal_to >= current_date");

        if($query -> num_rows() > 0) {
            return $query->result();
        }
        else {
            return false;
        }
    }

    function update_expired_password($new_password,$post_userid){
        $this->db->trans_start();
        $this->db->query("Update tblmst_user set password='$new_password', last_update_password=current_date where userid ='$post_userid'");
        $this->db->trans_complete();
        return TRUE;
    }

    function date_calculate($dt_date,$dt_shelf_life)
    {
        $this->db1->trans_begin();
        return $this->db1->query("SELECT * FROM fn_expiry_date('$dt_date','$dt_shelf_life')")->row();
        
    }
    
    function check_akses_bylevelid($leveluid,$url_str){
        if($leveluid!=null){            
            $query = $this ->db1->query("SELECT 
                                            x.* 
                                        FROM
                                            (select 
                                                a.leveluserid as leveluserid,
                                                a.menuid as id_1,
                                                a.submenuid as id_2,
                                                a.submenu2id as id_3,
                                                a.submenu3id as id_4,
                                                replace
                                                (case when b.menulink is null then '' else b.menulink end||
                                                case when b.submenulink is null then '' else b.submenulink end||
                                                case when b.submenu2link is null then '' else b.submenu2link end||
                                                case when b.submenu3link is null then '' else b.submenu3link end,'#','') as link
                                            from 
                                                tblmstsubmenu_akses2 as a 
                                            left join 
                                                (SELECT 
                                                    a.menuid, 
                                                    a.menunm, 
                                                    a.menulink, 
                                                    a.menufaicon, 
                                                    b.submenuid, 
                                                    b.submenunm, 
                                                    b.submenulink, 
                                                    c.submenu2id, 
                                                    c.submenu2nm, 
                                                    c.submenu2link, 
                                                    d.submenu3id, 
                                                    d.submenu3nm, 
                                                    d.submenu3link
                                                FROM 
                                                    tblmstmenu a
                                                LEFT JOIN 
                                                    tblmstsubmenu b 
                                                        ON a.menuid = b.menuid
                                                LEFT JOIN 
                                                    tblmstsubmenu2 c 
                                                        ON b.submenuid = c.submenuid
                                                LEFT JOIN 
                                                    tblmstsubmenu3 d 
                                                        ON c.submenu2id = d.submenu2id
                                                ORDER BY a.menuid, b.submenuid, c.submenu2id, d.submenu3id) as b
                                                    on coalesce(a.menuid,0) = coalesce(b.menuid,0)
                                                    and coalesce(a.submenuid,0) = coalesce(b.submenuid,0)
                                                    and coalesce(a.submenu2id,0) = coalesce(b.submenu2id,0)
                                                    and coalesce(a.submenu3id,0) = coalesce(b.submenu3id,0)
                                            where 
                                                a.leveluserid='$leveluid'
                                            union all
                                                select 
                                                    a.leveluserid as leveluserid, 
                                                    a.formid as id_1, 
                                                    a.formjnsid as id_2, 
                                                    a.formkategoriid as id_3, 
                                                    a.formkategori2id as id_4, 
                                                    b.formkd as link
                                                from 
                                                    tblmstform_akses2 as a 
                                                left join 
                                                    vwmst_form as b
                                                        on a.formid=b.formid where a.leveluserid='$leveluid')x
                                        WHERE 
                                            link like '%$url_str%'");
            if($query -> num_rows() > 0) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
        
}
    