<?php $this->load->view('template/headbar'); ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12 mb-1">
            <h4 class="text-uppercase"><?= $Titel ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">DATA USER</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <a type="button" href="<?= base_url('master/user/C_menu_user/form/add') ?>"
                            class="btn bg-gradient-primary" role="button"><span class="feather icon-edit-1"> Tambah User
                                Baru</span></a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                                <thead>
                                    <tr>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">No</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">NIK</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">NamaDepan</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Nama Lengkap</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Username</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Password</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Company</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Divisi</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Departemen</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Bagian</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Jabatan</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Level User</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Status User</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Penerima OTP</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">TTD</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Ubah</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">TTD</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                            <?php if($jabnm=='Programmer'){ ?>Hapus User<?php } ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(empty($list_user)){ ?>
                                        <tr>
                                            <td colspan="16">Tidak ada data!!</td>
                                        </tr>
                                        <?php
                                    }else{
                                        $no=0;
                                        foreach($list_user as $list_user_row){
                                            $base_url2 = 'http://'.$_SERVER['HTTP_HOST'].'/';
                                            $fcpath2   = str_replace('utl/', '', FCPATH);

                                            if(file_exists($fcpath2 .'utl/assets/ttd/'.$list_user_row->personalstatus.'_'.$list_user_row->personalid.'.png')){
                                                $ttd_base_path = '<img src="'.$base_url2.'utl/assets/ttd/'.$list_user_row->personalstatus.'_'.$list_user_row->personalid.'.png?timestamp='.time().'" style="width:130px; height:80px; background-size:100%;" alt="">';
                                            }else{
                                                if($list_user_row->personalid!='' && $list_user_row->personalstatus==2 && file_exists($fcpath2 .'forviewfoto_pekerja/TTD_TK/'.$list_user_row->personalid.'.png')){
                                                    $ttd_base_path = '<img src="'.$base_url2.'forviewfoto_pekerja/TTD_TK/'.$list_user_row->personalid.'.png?timestamp='.time().'" style="width:130px; height:80px; background-size:100%;" alt="">';
                                                }else if($list_user_row->personalid!='' && $list_user_row->personalstatus==1 && file_exists($fcpath2 .'forviewfoto_mypsg/TTD_KRY/'.$list_user_row->personalid.'_0_0.png')){
                                                    $ttd_base_path = '<img src="'.$base_url2.'forviewfoto_pekerja/TTD_KRY/'.$list_user_row->personalid.'_0_0.png?timestamp='.time().'" style="width:130px; height:80px; background-size:100%;" alt="">';
                                                }else if($list_user_row->personalid!='' && $list_user_row->personalstatus==1 && file_exists($fcpath2 .'forviewfoto_mypsg/'.$list_user_row->personalid.'_0_0.png')){
                                                    $ttd_base_path = '<img src="'.$base_url2.'forviewfoto_pekerja/'.$list_user_row->personalid.'_0_0.png?timestamp='.time().'" style="width:130px; height:80px; background-size:100%;" alt="">';
                                                }else{
                                                    $ttd_base_path = '';
                                                }
                                            }

                                            $no++; ?>

                                            <tr>
                                                <td align="center"><?= $no;?></td>
                                                <td><?= $list_user_row->nik ?></td>
                                                <td><?= $list_user_row->nmdepan ?></td>
                                                <td><?= $list_user_row->nmlengkap ?></td>
                                                <td><?= $list_user_row->username ?></td>
                                                <td><?php if($jabnm=='Programmer'){ echo $list_user_row->password; }else{ echo sha1($list_user_row->password); } ?></td>
                                                <td align="center"><?= $list_user_row->tblpekerja_company ?></td>
                                                <td align="center"><?= $list_user_row->tblpekerja_divisi_abbr ?></td>
                                                <td align="center"><?= $list_user_row->tblpekerja_dept_abbr ?></td>
                                                <td align="center"><?= $list_user_row->tblpekerja_bagian_abbr ?></td>
                                                <td align="center"><?= $list_user_row->tblpekerja_jabatan_nama ?></td>
                                                <td align="center"><b><?= $list_user_row->levelusernm ?></b></td>
                                                <td align="center">
                                                    <?php if($list_user_row->tblpekerja_personalid!='' && $list_user_row->tblonelogin_personalid!='' && $list_user_row->inactive=='0'){echo '<div class="badge badge-pill badge-success">Aktif</div>';}else{echo '<div class="badge badge-pill badge-danger">Tidak Aktif</div>';}?>
                                                </td>
                                                <td align="center">
                                                    <?php if($list_user_row->status_otp=='0'){echo '<div class="badge badge-pill badge-success">Aktif</div>';}else{echo '<div class="badge badge-pill badge-danger">Tidak Aktif</div>';}?>
                                                </td>
                                                <td align="center"><?= $ttd_base_path ?></td>
                                                <td align="center"><a href="<?= base_url('master/user/C_menu_user/form/edit/'.$list_user_row->userid) ?>" target="" title="Edit Data"><span class="btn bg-gradient-success feather icon-edit"></span></a></td>
                                                <td align="center"><a href="<?= base_url('master/C_tandatangan/sign/'.$list_user_row->userid) ?>" target="" title="Edit TTD"><span class="btn bg-gradient-info fa fa-pied-piper mr-1"></span></a></td>
                                                <td align="center"><?php if($jabnm=='Programmer'){ ?>
                                                    <a href="<?= base_url('master/user/C_menu_user/delete/'.$list_user_row->userid) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')">
                                                        <span class="btn bg-gradient-danger feather icon-trash-2"></span>
                                                    </a>
                                                    <?php
                                                } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->

<?php $this->load->view('template/footbar'); ?>
<?php $this->load->view('template/footbarend'); ?>