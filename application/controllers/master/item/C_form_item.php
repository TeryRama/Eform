<?php
class C_form_item extends  CI_Controller
{
    function  __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
        // $this->load->helper('form','url');
        // $this->load->model(array('M_user', 'M_menu','master/item/M_form_item', 'form_input/M_forminput', 'master/M_mst_departemen', 'master/M_mesin', 'master/M_area'));

        $this->load->model(array('M_user', 'M_menu', 'master/item/M_form_item'));

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
        /// end prevent direct url accses
        //////////////////////////////////
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
            $data['Titel']          = 'MASTER - FORM ITEM';

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];

            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);

            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);

            $dt_item                = $this->M_form_item->get_records();
            $data3                  = array('dt_item' => $dt_item);

            $this->load->view('master/item/V_form_item', array_merge($data, $data2, $data3));
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function getdetail_spec()
    {
        $headerid         = trim($this->input->post('headerid'));
        $detail_id        = trim($this->input->post('detail_id'));

        $dt_spec_header   = $this->M_form_item->getdata_header($headerid);
        $dt_spec_detail_b = $this->M_form_item->getdata_detail_b($headerid, $detail_id);

        $data10 = "";
        if (count($dt_spec_detail_b) > 0) {
            foreach ($dt_spec_detail_b as $row) {
                $vtipe_cek2_0 = $row->tipe_cek2 == '0' ? 'selected' : '';
                $vtipe_cek2_1 = $row->tipe_cek2 == '1' ? 'selected' : '';
                $vtipe_cek2_2 = $row->tipe_cek2 == '2' ? 'selected' : '';
                if($row->detail_id_b!=''){
                    $html_detail_id = '<input type="hidden" name="detail_id_b[]" id="detail_id_b" value="' . $row->detail_id_b . '" size="1"/>';
                }else{
                    $html_detail_id = '';
                }
                $data10 .= '<tr>
                            '.$html_detail_id.'
                            <td><input name="modal_chk[]" type="checkbox" value="' . $row->detail_id_b . '"/></td>
                            <td><input type="hidden" size="20" name="modal_item1[]" id="modal_item1" class="modal_item1 form-control" value="' . $row->item1 . '"/>' . $row->item1 . '</td>
                            <td><input type="text" size="40" name="modal_item2[]" id="modal_item2" class="modal_item2 form-control" value="' . $row->item2 . '"/></td>
                            <td><input type="text" size="40" name="modal_spek2[]" id="modal_spek2" class="modal_spek2 form-control" value="' . $row->spek2 . '"/></td>
                            <td><select name="modal_tipe_cek2[]"
                                    id="modal_tipe_cek2" class="modal_tipe_cek2 form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="0" ' . $vtipe_cek2_0 . '>Default</option>
                                    <option value="1" ' . $vtipe_cek2_1 . '>Awal Saja</option>
                                    <option value="2" ' . $vtipe_cek2_2 . '>Akhir Saja</option>
                                </select></td>
                        </tr>';
            }
        }

        echo $headerid . "//" . $detail_id . "//" . $data10 . "//";

        //detail B
    }

    function getdetail_spec_c()
    {
        $headerid         = trim($this->input->post('headerid'));
        $detail_id_b      = trim($this->input->post('detail_id_b'));

        $dt_spec_header   = $this->M_form_item->getdata_header($headerid);
        $dt_spec_detail_c = $this->M_form_item->getdata_detail_c($headerid, $detail_id_b);

        $data10 = "";
        if (count($dt_spec_detail_c) > 0) {
            foreach ($dt_spec_detail_c as $row2) {
                $vtipe_cek3_0 = $row2->tipe_cek3 == '0' ? 'selected' : '';
                $vtipe_cek3_1 = $row2->tipe_cek3 == '1' ? 'selected' : '';
                $vtipe_cek3_2 = $row2->tipe_cek3 == '2' ? 'selected' : '';

                $data10 .= '<tr>
                            <td><input name="modal_chk_c[]" type="checkbox" value="' . $row2->detail_id_c . '"/><input type="hidden" name="detail_id_c[]" id="detail_id_c" value="' . $row2->detail_id_c . '" size="1"/></td>
                            <td><input type="hidden" size="20" name="modal_item1[]" id="modal_item1" class="modal_item1 form-control" value="' . $row2->item1 . '"/>' . $row2->item1 . '</td>
                            <td><input type="hidden" size="40" name="modal_item2[]" id="modal_item2" class="modal_item2 form-control" value="' . $row2->item2 . '"/>' . $row2->item2 . '</td>
                            <td><input type="text" size="40" name="modal_item3[]" id="modal_item3" class="modal_item3 form-control" value="' . $row2->item3 . '"/></td>
                            <td><input type="text" size="40" name="modal_spek3[]" id="modal_spek3" class="modal_spek3 form-control" value="' . $row2->spek3 . '"/></td>
                            <td><select name="modal_tipe_cek3[]"
                                    id="modal_tipe_cek3" class="modal_tipe_cek3 form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="0" ' . $vtipe_cek3_0 . '>Default</option>
                                    <option value="1" ' . $vtipe_cek3_1 . '>Awal Saja</option>
                                    <option value="2" ' . $vtipe_cek3_2 . '>Akhir Saja</option>
                                </select></td>
                        </tr>';
            }
        }

        echo $headerid . "//" . $detail_id_b . "//" . $data10 . "//";

        //detail C
    }

    function getdetail_spec_d()
    {
        $headerid         = trim($this->input->post('headerid'));
        $detail_id_c      = trim($this->input->post('detail_id_c'));

        $dt_spec_header   = $this->M_form_item->getdata_header($headerid);
        $dt_spec_detail_d = $this->M_form_item->getdata_detail_d($headerid, $detail_id_c);

        $data10 = "";
        if (count($dt_spec_detail_d) > 0) {
            foreach ($dt_spec_detail_d as $row3) {
                $vtipe_cek4_0 = $row3->tipe_cek4 == '0' ? 'selected' : '';
                $vtipe_cek4_1 = $row3->tipe_cek4 == '1' ? 'selected' : '';
                $vtipe_cek4_2 = $row3->tipe_cek4 == '2' ? 'selected' : '';

                $data10 .= '<tr>
                            <td><input name="modal_chk_d[]" type="checkbox" value="' . $row3->detail_id_d . '"/><input type="hidden" name="detail_id_d[]" id="detail_id_d" value="' . $row3->detail_id_d . '" size="1"/></td>
                            <td><input type="hidden" size="20" name="modal_item1[]" id="modal_item1" class="modal_item1 form-control" value="' . $row3->item1 . '"/>' . $row3->item1 . '</td>
                            <td><input type="hidden" size="40" name="modal_item2[]" id="modal_item2" class="modal_item2 form-control" value="' . $row3->item2 . '"/>' . $row3->item2 . '</td>
                            <td><input type="hidden" size="40" name="modal_item3[]" id="modal_item3" class="modal_item3 form-control" value="' . $row3->item3 . '"/>' . $row3->item3 . '</td>
                            <td><input type="text" size="40" name="modal_item4[]" id="modal_item4" class="modal_item4 form-control" value="' . $row3->item4 . '"/></td>
                            <td><input type="text" size="40" name="modal_spek4[]" id="modal_spek4" class="modal_spek4 form-control" value="' . $row3->spek4 . '"/></td>
                            <td><select name="modal_tipe_cek4[]"
                                    id="modal_tipe_cek4" class="modal_tipe_cek4 form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="0" ' . $vtipe_cek4_0 . '>Default</option>
                                    <option value="1" ' . $vtipe_cek4_1 . '>Awal Saja</option>
                                    <option value="2" ' . $vtipe_cek4_2 . '>Akhir Saja</option>
                                </select></td>
                        </tr>';
            }
        }

        echo $headerid . "//" . $detail_id_c . "//" . $data10 . "//";

        //detail d
    }

    function getdetail_spec_e()
    {
        $headerid         = trim($this->input->post('headerid'));
        $detail_id_d      = trim($this->input->post('detail_id_d'));

        $dt_spec_header   = $this->M_form_item->getdata_header($headerid);
        $dt_spec_detail_e = $this->M_form_item->getdata_detail_e($headerid, $detail_id_d);

        $data10 = "";
        if (count($dt_spec_detail_e) > 0) {
            foreach ($dt_spec_detail_e as $row4) {
                $vtipe_cek5_0 = $row4->tipe_cek5 == '0' ? 'selected' : '';
                $vtipe_cek5_1 = $row4->tipe_cek5 == '1' ? 'selected' : '';
                $vtipe_cek5_2 = $row4->tipe_cek5 == '2' ? 'selected' : '';

                $data10 .= '<tr>
                            <td><input name="modal_chk_e[]" type="checkbox" value="' . $row4->detail_id_e . '"/><input type="hidden" name="detail_id_e[]" id="detail_id_e" value="' . $row4->detail_id_e . '" size="1"/></td>
                            <td><input type="hidden" size="20" name="modal_item1[]" id="modal_item1" class="modal_item1 form-control" value="' . $row4->item1 . '"/>' . $row4->item1 . '</td>
                            <td><input type="hidden" size="40" name="modal_item2[]" id="modal_item2" class="modal_item2 form-control" value="' . $row4->item2 . '"/>' . $row4->item2 . '</td>
                            <td><input type="hidden" size="40" name="modal_item3[]" id="modal_item3" class="modal_item3 form-control" value="' . $row4->item3 . '"/>' . $row4->item3 . '</td>
                            <td><input type="hidden" size="40" name="modal_item4[]" id="modal_item4" class="modal_item4 form-control" value="' . $row4->item4 . '"/>' . $row4->item4 . '</td>
                            <td><input type="text" size="40" name="modal_item5[]" id="modal_item5" class="modal_item5 form-control" value="' . $row4->item5 . '"/></td>
                            <td><input type="text" size="40" name="modal_spek5[]" id="modal_spek5" class="modal_spek5 form-control" value="' . $row4->spek5 . '"/></td>
                            <td><select name="modal_tipe_cek5[]"
                                    id="modal_tipe_cek5" class="modal_tipe_cek5 form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="0" ' . $vtipe_cek5_0 . '>Default</option>
                                    <option value="1" ' . $vtipe_cek5_1 . '>Awal Saja</option>
                                    <option value="2" ' . $vtipe_cek5_2 . '>Akhir Saja</option>
                                </select></td>
                        </tr>';
            }
        }

        echo $headerid . "//" . $detail_id_d . "//" . $data10 . "//";

        //detail e
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
            $modal_item1            = $this->input->post('modal_item1');
            $modal_item2            = $this->input->post('modal_item2');
            $modal_spek2            = $this->input->post('modal_spek2');
            $modal_tipe_cek2        = $this->input->post('modal_tipe_cek2');

            // updet header dulu
            $completedate                 = date('Y-m-d');
            $completetime                 = date('H:i:s');
            $completeby                   = $session_data['username'];
            $computer                     = $_SERVER['REMOTE_ADDR'];

            $data_header = array(
                'updated_by'   => $completeby,
                'updated_date' => $completedate,
                'updated_time' => $completetime,
                'updated_comp' => $computer
            );

            $this->M_form_item->update_hdr($modal_headerid, $data_header);

            if ($jns_button == 'btnmodal_save') {
                $jml = count($this->input->post('modal_item2'));

                for ($i = 0; $i < $jml; $i++) {

                    if ($detail_id_b[$i] != '' && isset($detail_id_b[$i])) {
                        $modal_detail = array(
                            'item2'       => $modal_item2[$i],
                            'spek2'       => $modal_spek2[$i],
                            'tipe_cek2'       => $modal_tipe_cek2[$i],
                        );
                        $detailid = $detail_id_b[$i];
                        $this->M_form_item->update_detail_b($detailid, $modal_detail);
                    } else {
                        $modal_detail = array(
                            'headerid'    => $modal_headerid,
                            'detail_id_a' => $modal_detail_id_a,

                            'item2'       => $modal_item2[$i],
                            'spek2'       => $modal_spek2[$i],
                            'tipe_cek2'       => $modal_tipe_cek2[$i],
                        );
                        $this->M_form_item->insert_detail_b($modal_detail);
                    }
                }

                echo $pesan = "Data kategori B Berhasil Disimpan...!!";
            } elseif ($jns_button == 'btnmodal_delete') {
                $chk = $this->input->post('modal_chk');
                $jmlchk = count($this->input->post('modal_chk'));
                for ($i = 0; $i < $jmlchk; $i++) {
                    $modal_detail_id = $chk[$i];
                    $this->M_form_item->modal_delete_detail($modal_detail_id);
                }
                echo $pesan = "Data kategori B berhasil dihapus...!!";
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

            $modal_headerid_c        = $this->input->post('modal_headerid_c');
            $modal_detail_id_b      = $this->input->post('modal_detail_id_b');

            $detail_id_c            = $this->input->post('detail_id_c');
            $modal_item1            = $this->input->post('modal_item1');
            $modal_item2            = $this->input->post('modal_item2');
            $modal_item3            = $this->input->post('modal_item3');
            $modal_spek3            = $this->input->post('modal_spek3');
            $modal_tipe_cek3        = $this->input->post('modal_tipe_cek3');

            // updet header dulu
            $completedate                 = date('Y-m-d');
            $completetime                 = date('H:i:s');
            $completeby                   = $session_data['username'];
            $computer                     = $_SERVER['REMOTE_ADDR'];

            $data_header = array(
                'updated_by'   => $completeby,
                'updated_date' => $completedate,
                'updated_time' => $completetime,
                'updated_comp' => $computer
            );

            $this->M_form_item->update_hdr($modal_headerid_c, $data_header);

            if ($jns_button == 'btnmodal_save_c') {
                $jml = count($this->input->post('modal_item3'));

                for ($i = 0; $i < $jml; $i++) {

                    if ($detail_id_c[$i] != null) {
                        $modal_detail_c = array(
                            'item3'       => $modal_item3[$i],
                            'spek3'       => $modal_spek3[$i],
                            'tipe_cek3'   => $modal_tipe_cek3[$i],
                        );
                        $detailid_c   = $detail_id_c[$i];
                        $this->M_form_item->update_detail_c($detailid_c, $modal_detail_c);
                    } else {
                        $modal_detail_c = array(
                            'headerid'    => $modal_headerid_c,
                            'detail_id_b' => $modal_detail_id_b,

                            'item3'       => $modal_item3[$i],
                            'spek3'       => $modal_spek3[$i],
                            'tipe_cek3'   => $modal_tipe_cek3[$i],
                        );
                        $this->M_form_item->insert_detail_c($modal_detail_c);
                    }
                }

                echo $pesan = "Data kategori C Berhasil Disimpan...!!";
            } elseif ($jns_button == 'btnmodal_delete_c') {
                $chk = $this->input->post('modal_chk_c');
                $jmlchk = count($this->input->post('modal_chk_c'));
                for ($i = 0; $i < $jmlchk; $i++) {
                    $modal_detail_id_c = $chk[$i];
                    $this->M_form_item->modal_delete_detail_c($modal_detail_id_c);
                }
                echo $pesan = "Data kategori C berhasil dihapus...!!";
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function save_kategori_d()
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

            $modal_headerid_d         = $this->input->post('modal_headerid_d');
            $modal_detail_id_c      = $this->input->post('modal_detail_id_c');

            $detail_id_d            = $this->input->post('detail_id_d');
            $modal_item1            = $this->input->post('modal_item1');
            $modal_item2            = $this->input->post('modal_item2');
            $modal_item3            = $this->input->post('modal_item3');
            $modal_item4            = $this->input->post('modal_item4');
            $modal_spek4            = $this->input->post('modal_spek4');
            $modal_tipe_cek4            = $this->input->post('modal_tipe_cek4');

            // updet header dulu
            $completedate                 = date('Y-m-d');
            $completetime                 = date('H:i:s');
            $completeby                   = $session_data['username'];
            $computer                     = $_SERVER['REMOTE_ADDR'];

            $data_header = array(
                'updated_by'   => $completeby,
                'updated_date' => $completedate,
                'updated_time' => $completetime,
                'updated_comp' => $computer
            );

            $this->M_form_item->update_hdr($modal_headerid_d, $data_header);

            if ($jns_button == 'btnmodal_save_d') {
                $jml = count($this->input->post('modal_item4'));

                for ($i = 0; $i < $jml; $i++) {

                    if ($detail_id_d[$i] != null) {
                        $modal_detail_d = array(
                            'item4'       => $modal_item4[$i],
                            'spek4'       => $modal_spek4[$i],
                            'tipe_cek4'       => $modal_tipe_cek4[$i],
                        );
                        $detailid_d   = $detail_id_d[$i];
                        $this->M_form_item->update_detail_d($detailid_d, $modal_detail_d);
                    } else {
                        $modal_detail_d = array(
                            'headerid'    => $modal_headerid_d,
                            'detail_id_c' => $modal_detail_id_c,

                            'item4'       => $modal_item4[$i],
                            'spek4'       => $modal_spek4[$i],
                            'tipe_cek4'       => $modal_tipe_cek4[$i],
                        );
                        $this->M_form_item->insert_detail_d($modal_detail_d);
                    }
                }

                echo $pesan = "Data kategori D Berhasil Disimpan...!!";
            } elseif ($jns_button == 'btnmodal_delete_d') {
                $chk = $this->input->post('modal_chk_d');
                $jmlchk = count($this->input->post('modal_chk_d'));
                for ($i = 0; $i < $jmlchk; $i++) {
                    $modal_detail_id_d = $chk[$i];
                    $this->M_form_item->modal_delete_detail_d($modal_detail_id_d);
                }
                echo $pesan = "Data kategori D berhasil dihapus...!!";
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }

    function save_kategori_e()
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

            $modal_headerid_e        = $this->input->post('modal_headerid_e');
            $modal_detail_id_d      = $this->input->post('modal_detail_id_d');

            $detail_id_e            = $this->input->post('detail_id_e');
            $modal_item1            = $this->input->post('modal_item1');
            $modal_item2            = $this->input->post('modal_item2');
            $modal_item3            = $this->input->post('modal_item3');
            $modal_item4            = $this->input->post('modal_item4');
            $modal_item5            = $this->input->post('modal_item5');
            $modal_spek5            = $this->input->post('modal_spek5');
            $modal_tipe_cek5            = $this->input->post('modal_tipe_cek5');

            // updet header dulu
            $completedate                 = date('Y-m-d');
            $completetime                 = date('H:i:s');
            $completeby                   = $session_data['username'];
            $computer                     = $_SERVER['REMOTE_ADDR'];

            $data_header = array(
                'updated_by'   => $completeby,
                'updated_date' => $completedate,
                'updated_time' => $completetime,
                'updated_comp' => $computer
            );

            $this->M_form_item->update_hdr($modal_headerid_e, $data_header);

            if ($jns_button == 'btnmodal_save_e') {
                $jml = count($this->input->post('modal_spek5'));

                for ($i = 0; $i < $jml; $i++) {

                    if ($detail_id_e[$i] != null) {
                        $modal_detail_e = array(
                            'item5'       => $modal_spek5[$i],
                            'spek5'       => $modal_spek5[$i],
                            'tipe_cek5'       => $modal_tipe_cek5[$i],
                        );
                        $detailid_e   = $detail_id_e[$i];
                        $this->M_form_item->update_detail_e($detailid_e, $modal_detail_e);
                    } else {
                        $modal_detail_e = array(
                            'headerid'    => $modal_headerid_e,
                            'detail_id_d' => $modal_detail_id_d,

                            'item5'       => $modal_spek5[$i],
                            'spek5'       => $modal_spek5[$i],
                            'tipe_cek5'       => $modal_tipe_cek5[$i],
                        );
                        $this->M_form_item->insert_detail_e($modal_detail_e);
                    }
                }

                echo $pesan = "Data kategori E Berhasil Disimpan...!!";
            } elseif ($jns_button == 'btnmodal_delete_e') {
                $chk = $this->input->post('modal_chk_e');
                $jmlchk = count($this->input->post('modal_chk_e'));
                for ($i = 0; $i < $jmlchk; $i++) {
                    $modal_detail_id_e = $chk[$i];
                    $this->M_form_item->modal_delete_detail_e($modal_detail_id_e);
                }
                echo $pesan = "Data kategori E berhasil dihapus...!!";
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }


    function form()
    {
        $session_data                 = $this->session->userdata('logged_in');
        $data['username']             = $session_data['username'];
        $data['password']             = $session_data['password'];
        $data['jabid']                = $session_data['jabid'];
        $data['leveluserid']          = $session_data['leveluserid'];
        $data['nmdepan']              = $session_data['nmdepan'];
        $data['levelusernm']          = $session_data['levelusernm'];
        $data['bagnm']                = $session_data['bagnm'];
        $data['jabnm']                = $session_data['jabnm'];
        $data['ori_akses']            = $session_data['ori_akses'];
        $data['audit_akses']          = $session_data['audit_akses'];
        $data['on_audit']             = $session_data['on_audit'];
        $data['Titel']                = 'MASTER - FORM ITEM';

        $LevelUser                    = $session_data['leveluserid'];
        $UserName                     = $session_data['username'];
        $LevelUserNm                  = $session_data['levelusernm'];

        $cekLevelUserNm               = substr($LevelUserNm, 0, 7);
        $data['cekLevelUserNm']       = substr($LevelUserNm, 0, 7);

        $menus                        = $this->M_menu->menus($LevelUser);
        $data2                        = array('menus' => $menus);

        $headerid                     = addslashes($this->input->post('headerid'));
        $post_dtkode_form             = addslashes($this->input->post('dtkode_form'));
        $post_dtparameter             = addslashes($this->input->post('dtparameter'));
        $post_dtdepartemen            = addslashes($this->input->post('departemen'));
        $post_dttgl_efective          = addslashes($this->input->post('dttgl_efective'));

        if (trim($post_dtkode_form)    != '') {
            $dtkode_form = $post_dtkode_form;
        } else {
            $dtkode_form = NULL;
        }
        if (trim($post_dtparameter)    != '') {
            $dtparameter = $post_dtparameter;
        } else {
            $dtparameter = NULL;
        }
        if (trim($post_dtdepartemen)   != '') {
            $dtdepartemen = $post_dtdepartemen;
        } else {
            $dtdepartemen = NULL;
        }
        if (trim($post_dttgl_efective) != '') {
            $dttgl_efective = date("Y-m-d", strtotime($post_dttgl_efective));
        } else {
            $dttgl_efective = NULL;
        }

        $completedate                 = date('Y-m-d');
        $completetime                 = date('H:i:s');
        $completeby                   = $session_data['username'];
        $computer                     = $_SERVER['REMOTE_ADDR'];

        $detail_id_1st                = $this->input->post('detail_id_1st');
        $item1                        = $this->input->post('item1');
        $ket_item1                    = $this->input->post('ket_item1');
        $spek1                        = $this->input->post('spek1');
        $tipe_cek1                    = $this->input->post('tipe_cek1');

        //ambil variabel URL
        $mau_ke                       = $this->uri->segment(5);
        $idu                          = $this->uri->segment(6);
        // var_dump($dtnama_mesin);die;
        if ($mau_ke == "add") {
            //jika uri segmentnya add
            $data4['aksi']         = 'aksi_add';

            $data['dtdept']        = $this->M_form_item->get_records_payroll();
            $data['all_kode_form'] = $this->M_form_item->get_dt_form();

            $this->load->view('master/item/V_form_new_item', array_merge($data, $data2, $data4));
        } else if ($mau_ke == "view") {
            //jika uri segmentnya view
            $data4['aksi'] = 'view';

            $headerid      = $idu;

            $dtheader      = $this->M_form_item->getdata_header($headerid);
            $data5         = array('dtheader' => $dtheader);

            foreach ($dtheader as $dtheader_row) {
                $dtkode_form = $dtheader_row->form_kode;
            }

            $data['dtdetail5']     = $this->M_form_item->getdata_detail_e_view($headerid);

            $this->load->view('master/item/V_form_view_item', array_merge($data, $data2, $data4, $data5));
        } else if ($mau_ke == "edit") {
            //jika uri segmentnya edit
            $data4['aksi']         = 'aksi_edit';

            $headerid              = $idu;

            $dtheader              = $this->M_form_item->getdata_header($headerid);
            $data5                 = array('dtheader' => $dtheader);

            foreach ($dtheader as $dtheader_row) {
                $dtkode_form           = $dtheader_row->form_kode;
            }

            $data['dtdept']        = $this->M_form_item->get_records_payroll();

            $data['all_kode_form'] = $this->M_form_item->get_dt_form();

            $data['dtdetail']      = $this->M_form_item->getdata_detail($headerid);

            $data['dtdetail2']     = $this->M_form_item->getdata_detail_b_view($headerid);

            $data['dtdetail3']     = $this->M_form_item->getdata_detail_c_view($headerid);

            $data['dtdetail4']     = $this->M_form_item->getdata_detail_d_view($headerid);

            $data['dtdetail5']     = $this->M_form_item->getdata_detail_e_view($headerid);

            $this->load->view('master/item/V_form_new_item', array_merge($data, $data2, $data4, $data5));
        } else if ($mau_ke == "aksi_add") {
            //jika uri segmentnya aksi_add sebagai fungsi untuk insert
            $cek_spec = $this->M_form_item->cek_spec($dtkode_form, $dtparameter,  $dtdepartemen, $dttgl_efective);
            if ($cek_spec->num_rows() > 0) {
                $data4['aksi'] = 'aksi_add';
                echo "<script>alert('Maaf Data Item Sudah pernah disimpan...!!');</script>";

                $this->load->view('master/item/V_form_new_item', array_merge($data, $data2, $data4));
            } else {
                $data4['aksi'] = 'aksi_edit';
                $data_header = array(
                    'form_kode'    => $dtkode_form,
                    'parameter'    => $dtparameter,
                    'departemen'   => $dtdepartemen,
                    'tgl_efective' => $dttgl_efective,

                    'inactive'     => '0',

                    'create_by'    => $completeby,
                    'create_date'  => $completedate,
                    'create_time'  => $completetime,
                    'create_comp'  => $computer
                );

                $this->M_form_item->insert_hdr($data_header); //model insert data barang
                $maxid = $this->db1->insert_id();

                $jml = count($this->input->post('item1'));
                for ($i = 0; $i < $jml; $i++) {
                    $data_detail = array(
                        'headerid'      => $maxid,
                        'item1'         => $item1[$i],
                        'ket_item1'     => $ket_item1[$i],
                        'spek1  '       => $spek1[$i],
                        'tipe_cek1  '   => $tipe_cek1[$i],
                    );
                    $this->M_form_item->insert_detail($data_detail);
                }

                echo "<script>
                            alert('Data Berhasil Disimpan!!');
                            window.location.assign('";
                echo base_url();
                echo "index.php/master/item/C_form_item/form/edit/" . $maxid . "');
                        </script>";
            }
        } else if ($mau_ke == "aksi_copy") {
            $cek_spec = $this->M_form_item->cek_spec($dtkode_form, $dtparameter,  $dtdepartemen, $dttgl_efective);
            if ($cek_spec->num_rows() > 0) {
                echo "<script>
                            alert('Gagal. Data sudah pernah disimpan!!');
                            window.location.assign('";
                echo base_url();
                echo "index.php/master/item/C_form_item');
                        </script>";
            } else {
                $data_header = array(
                    'form_kode'    => $dtkode_form,
                    'parameter'    => $dtparameter,

                    'departemen'   => $dtdepartemen,
                    'tgl_efective' => $dttgl_efective,

                    'inactive'     => '0',

                    'create_by'    => $completeby,
                    'create_date'  => $completedate,
                    'create_time'  => $completetime,
                    'create_comp'  => $computer
                );

                $this->M_form_item->insert_hdr($data_header);
                $maxid    = $this->db1->insert_id();

                $dtdetail = $this->M_form_item->getdata_detail($headerid);

                if (count($dtdetail) > 0) {
                    foreach ($dtdetail as $dtdetail_row) {
                        $data_detail = array(
                            'item1'     => $dtdetail_row->item1,
                            'ket_item1' => $dtdetail_row->ket_item1,
                            'headerid'  => $maxid
                        );
                        $this->M_form_item->insert_detail($data_detail);
                        $max_detail_id = $this->db1->insert_id();

                        $dtdetail_b = $this->M_form_item->getdata_detail_b($headerid, $dtdetail_row->detail_id != '' ? $dtdetail_row->detail_id : 0);
                        if (count($dtdetail_b) > 0) {
                            foreach ($dtdetail_b as $dtdetail_b_row) {
                                $data_detail_b = array(
                                    'headerid'    => $maxid,
                                    'detail_id_a' => $max_detail_id,
                                    'item2'       => $dtdetail_b_row->item2,
                                );
                                $this->M_form_item->insert_detail_b($data_detail_b);
                                $max_detail_id_b = $this->db1->insert_id();

                                $dtdetail_c = $this->M_form_item->getdata_detail_c($headerid, $dtdetail_row->detail_id != '' ? $dtdetail_row->detail_id : 0, $dtdetail_b_row->detail_id_b != '' ? $dtdetail_b_row->detail_id_b : 0);
                                if (count($dtdetail_c) > 0) {
                                    foreach ($dtdetail_c as $dtdetail_c_row) {
                                        $data_detail_c = array(
                                            'headerid'    => $maxid,
                                            'detail_id_b' => $max_detail_id_b,
                                            'item3'       => $dtdetail_c_row->item3,
                                        );
                                        $this->M_form_item->insert_detail_c($data_detail_c);
                                        $max_detail_id_c = $this->db1->insert_id();

                                        $dtdetail_d = $this->M_form_item->getdata_detail_d($headerid, $dtdetail_row->detail_id != '' ? $dtdetail_row->detail_id : 0, $dtdetail_b_row->detail_id_b != '' ? $dtdetail_b_row->detail_id_b : 0, $dtdetail_c_row->detail_id_c != '' ? $dtdetail_c_row->detail_id_c : 0);
                                        if (count($dtdetail_d) > 0) {
                                            foreach ($dtdetail_d as $dtdetail_d_row) {
                                                $data_detail_d = array(
                                                    'headerid'    => $maxid,
                                                    'detail_id_c' => $max_detail_id_c,
                                                    'item4'       => $dtdetail_d_row->item4,
                                                );
                                                $this->M_form_item->insert_detail_d($data_detail_d);
                                                $max_detail_id_d = $this->db1->insert_id();

                                                $dtdetail_e = $this->M_form_item->getdata_detail_e($headerid, $dtdetail_row->detail_id != '' ? $dtdetail_row->detail_id : 0, $dtdetail_b_row->detail_id_b != '' ? $dtdetail_b_row->detail_id_b : 0, $dtdetail_c_row->detail_id_c != '' ? $dtdetail_c_row->detail_id_c : 0, $dtdetail_d_row->detail_id_d != '' ? $dtdetail_d_row->detail_id_d : 0);
                                                if (count($dtdetail_e) > 0) {
                                                    foreach ($dtdetail_e as $dtdetail_e_row) {
                                                        $data_detail_e = array(
                                                            'headerid'    => $maxid,
                                                            'detail_id_d' => $max_detail_id_d,
                                                            'item5'       => $dtdetail_e_row->item5,
                                                        );
                                                        $this->M_form_item->insert_detail_e($data_detail_e);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                echo "<script>
                            alert('Data berhasil disalin!!');
                            window.location.assign('";
                echo base_url();
                echo "index.php/master/item/C_form_item');
                        </script>";
            }
        } else if ($mau_ke == "aksi_edit") {
            $data4['aksi'] = 'aksi_edit';
            $data_header = array(
                'updated_by'   => $completeby,
                'updated_date' => $completedate,
                'updated_time' => $completetime,
                'updated_comp' => $computer
            );

            $this->M_form_item->update_hdr($headerid, $data_header);

            $jml = count($this->input->post('item1'));
            for ($i = 0; $i < $jml; $i++) {

                if (isset($detail_id_1st[$i])) {
                    $data6 = array(
                        'item1'       => $item1[$i],
                        'ket_item1  ' => $ket_item1[$i],
                        'spek1  '     => $spek1[$i],
                        'tipe_cek1  ' => $tipe_cek1[$i],
                    );

                    $dtdetail_id_1st = $detail_id_1st[$i];
                    $this->M_form_item->update_dtl($dtdetail_id_1st, $data6);
                } else {
                    $data6 = array(
                        'headerid'    => $headerid,
                        'item1'       => $item1[$i],
                        'ket_item1  ' => $ket_item1[$i],
                        'spek1  '     => $spek1[$i],
                        'tipe_cek1  ' => $tipe_cek1[$i],
                    );
                    $this->M_form_item->insert_detail($data6);
                }
            }

            echo "<script>
                        alert('Data Berhasil Diperbaharui!!');
                        window.location.assign('";
            echo base_url();
            echo "index.php/master/item/C_form_item/form/edit/" . $headerid . "');
                    </script>";
        } else if ($mau_ke == "aksi_delete") {
            $val_chk = $this->input->post('chk');
            $jmlchk = count($this->input->post('item1'));
            for ($i = 0; $i < $jmlchk; $i++) {
                if (isset($val_chk[$i])) {
                    if (trim($val_chk[$i]) != '') {
                        $detail_id = $val_chk[$i];
                        $this->M_form_item->delete_detail($detail_id);
                    }
                }
            }

            echo "<script>
                        alert('Data Berhasil Dihapus!!');
                        window.location.assign('";
            echo base_url();
            echo "index.php/master/item/C_form_item/form/edit/" . $headerid . "');
                    </script>";
        }
    }

    function delete($headerid)
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data_header = array(
                'inactive'     => '1',

                'updated_by'   => $session_data['nmdepan'],
                'updated_date' => date('Y-m-d'),
                'updated_time' => date('H:i:s'),
                'updated_comp' => $_SERVER['REMOTE_ADDR'],
            );

            if ($this->M_form_item->update_hdr($headerid, $data_header)) {
                echo "<script>
                            alert('Data Berhasil Dihapus!!');
                            window.location.assign('";
                echo base_url();
                echo "index.php/master/item/C_form_item');
                        </script>";
            }
        } else {
            //Jika tidak ada session di kembalikan ke halaman login
            redirect('C_login', 'refresh');
        }
    }
}
