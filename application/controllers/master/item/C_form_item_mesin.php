<?php
class C_form_item_mesin extends  CI_Controller
{
    function  __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
        $this->load->helper('form', 'url');
        $this->load->model(array('M_user', 'M_menu', 'master/item/M_form_item_mesin', 'form_input/M_forminput'));

        //////////////////////////////////
        /// prevent direct url accses
        $session_data = $this->session->userdata('logged_in');
        $leveluid     = $session_data['leveluserid'];
        $url_str      = uri_string();

        $akses_check = $this->M_user->check_akses_bylevelid($leveluid, 'C_form_item');
        if ($akses_check == false) {
            echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini..!!');
                          window.location.assign('";
            echo base_url();
            echo "C_login');
                       </script>";
        }
    }

    function index()
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
            $data['Titel']          = 'MASTER - FORM ITEM MESIN';

            $BagianAkses            = $session_data['bagian_akses'];
            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);

            $dt_spec                = $this->M_form_item_mesin->get_records();
            $data3                  = array('dt_spec' => $dt_spec);

            $data['dt_komponen']    = $this->M_form_item_mesin->get_partkomponen($BagianAkses);
            $data['dtdept']         = $this->M_form_item_mesin->get_records_payroll($BagianAkses);

            $this->load->view('master/formitemmesin/V_form_item_mesin', array_merge($data, $data2, $data3));
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_kategori_form()
    {

        $formjnsnm     = $this->input->post('formjnsnm');

        $dt_formkategori = $this->M_form_item_mesin->get_formkategori($formjnsnm);
        $data2 = "";
        $data2 .= "<option value=''>- Pilih -</option>";
        foreach ($dt_formkategori as $row) {
            $data2 .= '<option value="' . $row->formkategorinm . '">' . $row->formkategorinm . '</option>';
        }
        echo $data2;
    }

    function get_form_code()
    {

        $formjnsnm     = $this->input->post('formjnsnm');
        $formkategorinm     = $this->input->post('formkategorinm');

        $dt_formjnsnm = $this->M_form_item_mesin->get_dt_formjnsnm($formjnsnm, $formkategorinm);
        $data3 = "";
        $data3 .= "<option value=''>- Pilih -</option>";
        foreach ($dt_formjnsnm as $row) {
            $data3 .= '<option value="' . $row->formnm . '">' . $row->formnm . '</option>';
        }
        echo $data3;
    }

    function getdetail_item_b()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data           = $this->session->userdata('logged_in');
            $BagianAkses            = $session_data['bagian_akses'];

            $headerid         = trim($this->input->post('headerid'));
            $detail_id        = trim($this->input->post('detail_id'));
            $dept             = trim($this->input->post('dept'));

            $dt_spec_header   = $this->M_form_item_mesin->getdata_header($headerid);
            $dt_spec_detail_b = $this->M_form_item_mesin->getdata_detail_b($headerid, $detail_id);
            $dt_partkomponen  = $this->M_form_item_mesin->get_partkomponen($BagianAkses);

            $data = [
                'headerid' => $headerid,
                'detail_id_a' => $detail_id,
                'dt_spec_detail_b' => $dt_spec_detail_b,
                'dt_partkomponen' => $dt_partkomponen,
            ];

            echo json_encode($data);
            //detail B
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function getdetail_item_c()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data           = $this->session->userdata('logged_in');
            $BagianAkses            = $session_data['bagian_akses'];
            $headerid    = trim($this->input->post('headerid'));
            $detail_id   = trim($this->input->post('detail_id'));
            $detail_id_b = trim($this->input->post('detail_id_b'));
            $bagian      = trim($this->input->post('bagian'));

            $dt_spec_header   = $this->M_form_item_mesin->getdata_header($headerid);
            $dt_spec_detail_c = $this->M_form_item_mesin->getdata_detail_c($headerid, $detail_id, $detail_id_b);
            $dt_mesin         = $this->M_form_item_mesin->get_mesin();
            $dt_partkomponen  = $this->M_form_item_mesin->get_partkomponen($BagianAkses);

            $datas_c = [
                'headerid'         => $headerid,
                'detail_id_b'      => $detail_id_b,
                'dt_spec_detail_c' => $dt_spec_detail_c,
                'dt_mesin'         => $dt_mesin,
                'dt_partkomponen'  => $dt_partkomponen,
            ];

            echo json_encode($datas_c);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }

        //detail C
    }

    function save_kategori_b()
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

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);

            $jns_button             = $this->input->post('valbutton');

            $modal_headerid         = $this->input->post('modal_headerid');
            $modal_detail_id_a      = $this->input->post('modal_detail_id_a');

            $detail_id_b            = $this->input->post('detail_id_b');
            $modal_item1_dtl        = $this->input->post('modal_item1_dtl');
            $modal_item2_dtl_b      = $this->input->post('modal_item2_dtl_b');
            $part_komponen          = $this->input->post('part_komponen');
            if (isset($part_komponen)) {
                foreach ($part_komponen as $key => $part_komponen_item) {
                    $arr_val_part_komponen = $part_komponen_item;
                    $part_komponen2[$key] = implode(',', $arr_val_part_komponen);
                }
            }



            if ($jns_button == 'btnmodal_save_b') {
                $jml = count($this->input->post('modal_item2_dtl_b'));

                for ($i = 0; $i < $jml; $i++) {
                    if (isset($part_komponen2[$i])) {
                        $v_part_komponen2[$i] = $part_komponen2[$i];
                    } else {
                        $v_part_komponen2[$i] = NULL;
                    }
                    if ($detail_id_b[$i] != null) {
                        $modal_detail = array(
                            'item2'         => $modal_item2_dtl_b[$i],
                            'part_komponen' => $v_part_komponen2[$i]
                        );

                        $detailid = $detail_id_b[$i];
                        $this->M_form_item_mesin->update_detail_b($detailid, $modal_detail);
                    } else {
                        $modal_detail = array(
                            'headerid'      => $modal_headerid,
                            'detail_id_a'   => $modal_detail_id_a,
                            'item2'         => $modal_item2_dtl_b[$i],
                            'part_komponen' => $v_part_komponen2[$i]
                        );
                        $this->M_form_item_mesin->insert_detail_b($modal_detail);
                    }
                }
                echo $pesan = "Data Item 2 Berhasil Disimpan...!!";
            } elseif ($jns_button == 'btnmodal_delete_b') {
                $chk = $this->input->post('modal_chk');
                $jmlchk = count($this->input->post('modal_chk'));
                for ($i = 0; $i < $jmlchk; $i++) {
                    $modal_detail_id = $chk[$i];
                    $this->M_form_item_mesin->modal_delete_detail_b($modal_detail_id);
                }
                echo $pesan = "Data Item 2 berhasil Dihapus...!!";
            } else {
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function save_kategori_c()
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

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);

            $jns_button             = $this->input->post('valbutton');

            $modal_headeridc        = $this->input->post('modal_headeridc');
            $modal_detail_id_b      = $this->input->post('modal_detail_id_b');

            $detail_id_c            = $this->input->post('detail_id_c');
            $modal_item1_dtl        = $this->input->post('modal_item1_dtl');
            $modal_item2_dtl_b      = $this->input->post('modal_item2_dtl_b');
            $modal_item3_dtl_c      = $this->input->post('modal_item3_dtl_c');
            $part_komponen_na       = $this->input->post('part_komponen');
            if (isset($part_komponen_na)) {
                foreach ($part_komponen_na as $key => $part_komponen_na_item) {
                    $arr_val_part_komponen_na = $part_komponen_na_item;
                    $part_komponen_na2[$key] = implode(',', $arr_val_part_komponen_na);
                }
            }

            if ($jns_button == 'btnmodal_save_c') {
                $jml = count($this->input->post('modal_item3_dtl_c'));
                for ($i = 0; $i < $jml; $i++) {
                    if (isset($part_komponen_na2[$i])) {
                        $v_part_komponen_na2[$i] = $part_komponen_na2[$i];
                    } else {
                        $v_part_komponen_na2[$i] = NULL;
                    }
                    if (isset($detail_id_c[$i]) && $detail_id_c[$i] != "") {
                        $modal_detail_c = array(
                            'item3'            => $modal_item3_dtl_c[$i],
                            'part_komponen_na' => $v_part_komponen_na2[$i]
                        );
                        $detailid_c   = $detail_id_c[$i];
                        $this->M_form_item_mesin->update_detail_c($detailid_c, $modal_detail_c);
                    } else {
                        $modal_detail_c = array(
                            'headerid'         => $modal_headeridc,
                            'detail_id_b'      => $modal_detail_id_b,
                            'item3'            => $modal_item3_dtl_c[$i],
                            'part_komponen_na' => $v_part_komponen_na2[$i]
                        );
                        $this->M_form_item_mesin->insert_detail_c($modal_detail_c);
                    }
                }

                echo $pesan = "Data Item 3 Berhasil Disimpan...!!";
            } elseif ($jns_button == 'btnmodal_delete_c') {
                $chk = $this->input->post('modal_chk_c');
                $jmlchk = count($this->input->post('modal_chk_c'));
                for ($i = 0; $i < $jmlchk; $i++) {
                    $modal_detail_id_c = $chk[$i];
                    $this->M_form_item_mesin->modal_delete_detail_c($modal_detail_id_c);
                }
                echo $pesan = "Data Item 3 berhasil dihapus...!!";
            } else {
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function form()
    {
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

        $BagianAkses            = $session_data['bagian_akses'];
        $LevelUser              = $session_data['leveluserid'];
        $UserName               = $session_data['username'];
        $LevelUserNm            = $session_data['levelusernm'];

        $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
        $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

        $menus                  = $this->M_menu->menus($LevelUser);
        $data2                  = array('menus' => $menus);

        $data['get_formjenis']  = $this->M_form_item_mesin->get_formjenis();

        $headerid               = addslashes($this->input->post('headerid'));
        $post_dtform_jenis      = addslashes($this->input->post('dtform_jenis'));
        $post_dtkategori_form   = addslashes($this->input->post('dtkategori_form'));
        $post_dtkode_form       = addslashes($this->input->post('dtkode_form'));
        $post_dtparameter       = addslashes($this->input->post('dtparameter'));
        $post_dtdepartemen      = addslashes($this->input->post('dtdepartemen'));
        $post_dttgl_efective    = addslashes($this->input->post('dttgl_efective'));

        if (trim($post_dtform_jenis) != '') {
            $dtform_jenis = $post_dtform_jenis;
        } else {
            $dtform_jenis = NULL;
        }
        if (trim($post_dtkategori_form) != '') {
            $dtkategori_form = $post_dtkategori_form;
        } else {
            $dtkategori_form = NULL;
        }
        if (trim($post_dtkode_form) != '') {
            $dtkode_form = $post_dtkode_form;
        } else {
            $dtkode_form = NULL;
        }
        if (trim($post_dtparameter) != '') {
            $dtparameter = $post_dtparameter;
        } else {
            $dtparameter = NULL;
        }
        if (trim($post_dtdepartemen) != '') {
            $dtdepartemen = $post_dtdepartemen;
        } else {
            $dtdepartemen = NULL;
        }
        if (trim($post_dttgl_efective) != '') {
            $dttgl_efective = substr($post_dttgl_efective, 6, 4) . '-' . substr($post_dttgl_efective, 3, 2) . '-' . substr($post_dttgl_efective, 0, 2);
        } else {
            $dttgl_efective = NULL;
        }

        $completedate  = date('Y-m-d');
        $completetime  = date('H:i:s');
        $completeby    = $session_data['username'];
        $computer      = $_SERVER['REMOTE_ADDR'];

        $detail_id_1st = $this->input->post('detail_id_1st');
        $item1         = $this->input->post('item1');

        $detail_id_b   = $this->input->post('detail_id_b');
        $item1_b       = $this->input->post('item1_b');
        $item2_b       = $this->input->post('item2_b');

        $detail_id_c   = $this->input->post('detail_id_c');
        $item1_c       = $this->input->post('item1_c');
        $item2_c       = $this->input->post('item2_c');
        $item3_c       = $this->input->post('item3_c');

        $detail_id_d   = $this->input->post('detail_id_d');
        $item1_d       = $this->input->post('item1_d');
        $item2_d       = $this->input->post('item2_d');
        $item3_d       = $this->input->post('item3_d');
        $item4_d       = $this->input->post('item4_d');

        $detail_id_e   = $this->input->post('detail_id_e');
        $item1_e       = $this->input->post('item1_e');
        $item2_e       = $this->input->post('item2_e');
        $item3_e       = $this->input->post('item3_e');
        $item4_e       = $this->input->post('item4_e');
        $item4_e       = $this->input->post('item4_e');

        //ambil variabel URL
        $mau_ke        = $this->uri->segment(5);
        $idu           = $this->uri->segment(6);

        if ($mau_ke == "add") { //jika uri segmentnya add
            $data4['aksi'] = 'aksi_add';

            $data['dtdept']            = $this->M_form_item_mesin->get_records_payroll($BagianAkses);
            $this->load->view('master/formitemmesin/V_form_new_itemmesin', array_merge($data, $data2, $data4));
        } else if ($mau_ke == "aksi_add") { //jika uri segmentnya aksi_add sebagai fungsi untuk insert
            $cek_header = $this->M_form_item_mesin->cek_header($dtform_jenis, $dtkategori_form, $dtkode_form, $dtparameter, $dtdepartemen, $dttgl_efective);
            if ($cek_header->num_rows() > 0) {
                $data4['aksi'] = 'aksi_add';
                echo "<script>alert('Maaf Data Item Sudah pernah disimpan...!!');</script>";

                $this->load->view('master/item/V_form_new_itemmesin', array_merge($data, $data2, $data4));
            } else {
                $data4['aksi'] = 'aksi_edit';
                $data_header = array(
                    'form_jenis'    => $dtform_jenis,
                    'form_kategori' => $dtkategori_form,
                    'form_kode'     => $dtkode_form,
                    'parameter'     => $dtparameter,
                    'departemen'     => $dtdepartemen,
                    'tgl_efective'  => $dttgl_efective,
                    'create_by'     => $completeby,
                    'create_date'   => $completedate,
                    'create_time'   => $completetime,
                    'create_comp'   => $computer
                );

                $this->M_form_item_mesin->insert_hdr($data_header); //model insert data
                $maxid = $this->db1->insert_id();

                $jml = count($this->input->post('item1'));
                for ($i = 0; $i < $jml; $i++) {
                    $data_detail = array(
                        'item1'         => $item1[$i],
                        'headerid'      => $maxid
                    );
                    $this->M_form_item_mesin->insert_detail($data_detail);
                }

                echo "<script>
                   alert('Data Berhasil Disimpan!!');
                   window.location.assign('";
                echo base_url();
                echo "index.php/master/item/C_form_item_mesin/form/edit/" . $maxid . "');
                   </script>";
            }
        } else if ($mau_ke == "edit") {         //jika uri segmentnya edit

            $data4['aksi']      = 'aksi_edit';

            $headerid = $idu;

            $dtheader  = $this->M_form_item_mesin->getdata_header($headerid);
            $data5 = array('dtheader' => $dtheader);

            foreach ($dtheader as $dtheader_row) {
                $formjnsnm        = $dtheader_row->form_jenis;
                $formkategorinm   = $dtheader_row->form_kategori;
                $dtkode_form      = $dtheader_row->form_kode;
                $dtdepartemen     = $dtheader_row->departemen;
            }

            $data['dt_partkomponen']   = $this->M_form_item_mesin->get_partkomponen($dtdepartemen);

            $data['dtdept']            = $this->M_form_item_mesin->get_records_payroll($BagianAkses);

            $dtdetail                  = $this->M_form_item_mesin->getdata_detail($headerid);
            $data6                     = array('dtdetail'  => $dtdetail);

            $dtdetail2                 = $this->M_form_item_mesin->getdata_detail_b_view($headerid);
            $data7                     = array('dtdetail2' => $dtdetail2);

            $dtdetail5                 = $this->M_form_item_mesin->getdata_detail_e_view($headerid);
            $data10                    = array('dtdetail5' => $dtdetail5);

            $data['all_kategori_form'] = $this->M_form_item_mesin->get_formkategori($formjnsnm);

            $data['all_kode_form']     = $this->M_form_item_mesin->get_dt_formjnsnm($formjnsnm, $formkategorinm);


            $this->load->view('master/formitemmesin/V_form_new_itemmesin', array_merge($data, $data2, $data4, $data5, $data6, $data7, $data10));
        } else if ($mau_ke == "aksi_edit") {
            $data4['aksi'] = 'aksi_edit';
            $data_header = array(
                'parameter'    => $dtparameter,
                'departemen'   => $dtdepartemen,
                'tgl_efective' => $dttgl_efective,
                'updated_by'   => $completeby,
                'updated_date' => $completedate,
                'updated_time' => $completetime,
                'updated_comp' => $computer
            );

            $this->M_form_item_mesin->update_hdr($headerid, $data_header);

            $val_chk = $this->input->post('chk');
            $jml     = count($this->input->post('item1'));
            for ($i = 0; $i < $jml; $i++) {
                if (isset($detail_id_1st[$i])) {
                    if (isset($val_chk[$i])) {
                        if (trim($val_chk[$i]) != '') {
                            $detailid = $val_chk[$i];
                            $data_detail = array(
                                'item1'         => $item1[$i]
                            );
                            $this->M_form_item_mesin->update_dtl($detailid, $data_detail);
                        }
                    }
                } else {
                    $data_detail = array(
                        'item1'         => $item1[$i],
                        'headerid'      => $headerid
                    );
                    $this->M_form_item_mesin->insert_detail($data_detail);
                }
            }

            echo "<script>
                    alert('Data Berhasil Diperbaharui!!');
                    window.location.assign('";
            echo base_url();
            echo "index.php/master/item/C_form_item_mesin/form/edit/" . $headerid . "');
                    </script>";
        } else if ($mau_ke == "aksi_delete") {
            $val_chk = $this->input->post('chk');
            $jmlchk = count($this->input->post('item1'));
            for ($i = 0; $i < $jmlchk; $i++) {
                if (isset($val_chk[$i])) {
                    if (trim($val_chk[$i]) != '') {
                        $detail_id = $val_chk[$i];
                        $this->M_form_item_mesin->delete_detail($detail_id);
                    } else {
                    }
                }
            }

            echo "<script>
                    alert('Data Berhasil Dihapus!!');
                    window.location.assign('";
            echo base_url();
            echo "index.php/master/item/C_form_item_mesin/form/edit/" . $headerid . "');
                    </script>";
        } else if ($mau_ke == "view") {         //jika uri segmentnya edit

            $data4['aksi']      = 'view';

            $headerid = $idu;

            $dtheader  = $this->M_form_item_mesin->getdata_header($headerid);
            $data5 = array('dtheader' => $dtheader);
            foreach ($dtheader as $dtheader_row) {
                $formjnsnm      = $dtheader_row->form_jenis;
                $formkategorinm = $dtheader_row->form_kategori;
                $dtkode_form    = $dtheader_row->form_kode;
                $dtdepartemen    = $dtheader_row->departemen;
            }
            $data['dt_partkomponen']  = $this->M_form_item_mesin->get_partkomponen($dtdepartemen);

            foreach ($dtheader as $dtheader_row) {
                $formjnsnm   = $dtheader_row->form_jenis;
                $dtkode_form = $dtheader_row->form_kode;
            }

            $all_item  = $this->M_form_item_mesin->get_all_item($headerid);
            $data6                  = array('all_item' => $all_item);

            // $all_kode_form  = $this->M_form_item_mesin->get_dt_formjnsnm_2($formjnsnm);
            // $data_all_kode_form = array('all_kode_form' => $all_kode_form);

            $this->load->view('master/formitemmesin/V_form_view_itemmesin', array_merge($data, $data2, $data4, $data5, $data6, $all_item/*,$data_all_kode_form*/));
        }
    }

    function delete($headerid)
    {
        if ($this->M_form_item_mesin->delete_header($headerid)) {
            echo "<script>
               alert('Data Berhasil Dihapus!!');
               window.location.assign('";
            echo base_url();
            echo "index.php/master/item/C_form_item_mesin');
               </script>";
        }
    }
    function form_komponen()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data       = $this->session->userdata('logged_in');

            $mdl1_komponen_id   = $this->input->post('mdl1_komponen_id');
            $mdl1_dept          = $this->input->post('mdl1_dept');
            $mdl1_deptabbr      = $this->input->post('mdl1_deptabbr');
            $mdl1_komponen      = $this->input->post('mdl1_komponen');
            $mdl1_kode_komponen      = $this->input->post('mdl1_kode_komponen');

            if ((isset($_POST['btnproses']) && $this->uri->segment(5) == 'add') || (isset($_POST['btncopy']) && $this->uri->segment(5) == 'update')) {
                if ($this->M_form_item_mesin->cek_header_komponen($mdl1_dept, $mdl1_komponen, $mdl1_kode_komponen)->num_rows() == 0) {
                    $data['deptid']          = $mdl1_dept;
                    $data['deptabbr']   = $mdl1_deptabbr;
                    $data['nama_komponen']   = $mdl1_komponen;
                    $data['kode_komponen']   = $mdl1_kode_komponen;

                    $data['created_userid']  = $session_data['userid'];
                    $data['created_by']      = $session_data['nmlengkap'];
                    $data['created_date']    = date('Y-m-d');
                    $data['created_time']    = date('H:i:s');
                    $data['created_comp']    = $_SERVER['REMOTE_ADDR'];

                    if ($this->M_form_item_mesin->insert_hdr_komponen($data)) {
                        if (isset($_POST['btncopy'])) {
                            echo "<script>alert('Data berhasil dicopy....!!!! ');</script>";
                        } else {
                            echo "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                        }
                    }
                } else {
                    echo '<script>alert("Gagal menyimpan!!!\nData dengan Departemen : ' . $mdl1_deptabbr . ', dan Nama Komponen : ' . $mdl1_komponen . ' sudah pernah disimpan.");</script>';
                }
            } else if (isset($_POST['btnproses']) && $this->uri->segment(5) == 'update') {
                if ($this->M_form_item_mesin->cek_header2_komponen($mdl1_dept, $mdl1_komponen, $mdl1_kode_komponen, $mdl1_komponen_id)->num_rows() == 0) {
                    $data['deptid']          = $mdl1_dept;
                    $data['nama_komponen']   = $mdl1_komponen;
                    $data['deptabbr']         = $mdl1_deptabbr;
                    $data['kode_komponen']   = $mdl1_kode_komponen;

                    $data['updated_userid']  = $session_data['userid'];
                    $data['updated_by']      = $session_data['nmlengkap'];
                    $data['updated_date']    = date('Y-m-d');
                    $data['updated_time']    = date('H:i:s');
                    $data['updated_comp']    = $_SERVER['REMOTE_ADDR'];

                    if ($this->M_form_item_mesin->update_hdr_komponen($mdl1_komponen_id, $data)) {
                        echo "<script>alert('Data berhasil disimpan....!!!! ');</script>";
                    }
                } else {
                    echo '<script>alert("Gagal menyimpan!!!\nData dengan Departemen : ' . $mdl1_deptabbr . ', dan Nama Komponen : ' . $mdl1_komponen . ' sudah pernah disimpan.");</script>';
                }
            } else {
                echo "<script>alert('Gagal, tidak ada aksi!!');</script>";
            }

            redirect('master/item/C_form_item_mesin', 'refresh');
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function get_dt_update()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $komponen_id     = $this->input->post('komponen_id');

            $dtdetail     = $this->M_form_item_mesin->get_records_by_komponen($komponen_id);

            if (count($dtdetail) > 0) {
                $hasil = array(
                    'status'  => 0,
                    'vstatus' => 'berhasil',
                    'pesan'   => 'berhasil',
                    'data'    => $dtdetail,
                );
            } else {
                $hasil = array(
                    'status'  => 1,
                    'vstatus' => 'gagal',
                    'pesan'   => 'Data detail tidak ditemukan!!!',
                );
            }

            echo json_encode($hasil);
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function delete_komponen($id)
    {
        if ($this->M_form_item_mesin->delete_komponen($id)) {
            echo "<script>
               alert('Data Berhasil Dihapus!!');
               window.location.assign('";
            echo base_url();
            echo "index.php/master/item/C_form_item_mesin');
               </script>";
        }
    }
}
