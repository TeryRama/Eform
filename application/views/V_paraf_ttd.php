<?php $this->load->view('template/headbar'); ?>

<!-- Content Header (Page header) -->
<!-- Main content -->
<!-- Content Header (Page header) -->
<!-- Main content -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12 mb-1">
            <h4 class="text-uppercase"><?php echo $Titel; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">DATA TTD</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                    <a type="button" href="<?= base_url('master/C_paraf_ttd/form/add') ?>" class="btn btn-outline-primary" role="button">Tambah Sign Baru</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                                <thead>
                                    <tr>
                                        <th class="table-primary align-middle text-center" style="font-size: 14px;">No</th>
                                        <th class="table-primary align-middle text-center">Nama</th>
                                        <th class="table-primary align-middle text-center">Jabatan</th>
                                        <th class="table-primary align-middle text-center">TTD</th>
                                        <th class="table-primary align-middle text-center">Edit</th>
                                        <th class="table-primary align-middle text-center">Hapus User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no=0;
                                foreach($dt_sign as $dt_sign_row){ $no++;
                                    $base_url2 = 'http://'.$_SERVER['HTTP_HOST'].'/';
                                    $fcpath2   = str_replace('mpd/', '', FCPATH);

                                    if ($dt_sign_row->nama != '') {
                                        if (file_exists(FCPATH . 'assets/ttd/TD_NON_USER/' . $dt_sign_row->nama . '.png')) {
                                            $ttd_base_path = '<img src="' . $base_url2 . 'mpd/assets/ttd/TD_NON_USER/' . $dt_sign_row->nama . '.png" style="width:100; height:50px; background-size:100%;" alt="">';
                                        } elseif (file_exists(FCPATH . 'assets/ttd/TD_NON_USER/' . $dt_sign_row->nama . '.jpg') && !file_exists(FCPATH . 'assets/ttd/TD_NON_USER/' . $dt_sign_row->nama . '.png')) {
                                            $ttd_base_path = '<img src="' . $base_url2 . 'mpd/assets/ttd/TD_NON_USER/' . $dt_sign_row->nama . '_0_0.jpg" style="width:100; height:50px; background-size:100%;" alt="">';
                                        }
                                        else {
                                            $ttd_base_path = '';
                                        }
                                    } else {
                                        $ttd_base_path = '';
                                    }
                                    var_dump($dt_sign);
                                    die;

                                ?>
                                    <tr>
                                        <td style="text-align:center;"><?php echo $no; ?></td>
                                        <td style="text-align:center;"><?php echo $dt_sign_row->nama; ?></td>
                                        <td style="text-align:center;"><?php echo $dt_sign_row->jabatan; ?></td>
                                        <td align="center"><?= $ttd_base_path ?></td>
                                        <td align="center">
                                        <a href="<?php echo site_url('master/C_paraf_ttd/form/edit/' . $dt_sign_row->sign_id) ?>" target="_self" alt="Delete Data" onClick="return confirm('EDIT TANDA TANGAN ... ?')">
                                            <span class="btn btn-outline-info fa fa-pied-piper" style="font-size:13px; color:black"></span>
                                        </a>
                                        </td>
                                        <td align="center">
                                        <a href="<?= base_url('master/C_paraf_ttd/form/delete/'.$dt_sign_row->sign_id) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="btn btn-outline-danger feather icon-trash-2"></span></a>
                                        </td>
                                    </tr>
                                <?php } ?>
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