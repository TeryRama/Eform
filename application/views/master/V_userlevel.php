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
                    <h4 class="card-title">DATA LEVEL USER</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <a type="button" href="<?= base_url('master/C_userlevel/form/add') ?>" class="btn bg-gradient-primary" target="_blank" role="button"><span class="feather icon-edit-1"> Tambah Data</span></a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                                <thead>
                                    <tr>
                                      <th class="table-primary align-middle text-center" rowspan="2" colspan="1">No</th>
                                      <th class="table-primary align-middle text-center" rowspan="2" colspan="1">Company</th>
                                      <th class="table-primary align-middle text-center" rowspan="2" colspan="1">Divisi</th>
                                      <th class="table-primary align-middle text-center" rowspan="2" colspan="1">Departemen</th>
                                      <th class="table-primary align-middle text-center" rowspan="2" colspan="1">Bagian</th>
                                      <th class="table-primary align-middle text-center" rowspan="2" colspan="1">Level Akses</th>
                                      <th class="table-primary align-middle text-center" rowspan="2" colspan="1">Bagian Akses</th>
                                      <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Data Akses</th>
                                      <th class="table-primary align-middle text-center" rowspan="2" colspan="1">Ubah</th>
                                      <th class="table-primary align-middle text-center" rowspan="2" colspan="1">Hapus</th>
                                    </tr>
                                    <tr>
                                      <!-- <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Pengguna 1</th>
                                      <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Pengguna 2</th> -->
                                      <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Original</th>
                                      <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Audit</th>                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(empty($dtlevel)){ ?>
                                      <tr>
                                        <td colspan="9"><?= "Tidak ada data!!"?></td>
                                      </tr>
                                    <?php }else{
                                      $no=0;
                                      foreach($dtlevel as $rowlevel){ $no++; ?>
                                        <tr>
                                          <td align="center"><?= $no;?></td>
                                          <td align="center"><?php foreach($dtcompany as $dtcompany_row) { if($dtcompany_row->id_company == $rowlevel->id_company){ echo $dtcompany_row->company;  break; } } ?></td>
                                          <td align="center"><?php foreach($dtdivisi as $dtdivisi_row) { if($dtdivisi_row->kodedivisi == $rowlevel->id_divisi){ echo $dtdivisi_row->namadivisi;  break; } } ?></td>
                                          <td align="center"><?php foreach($dtdepartemen as $dtdepartemen_row) { if($dtdepartemen_row->deptid == $rowlevel->id_dept){ echo $dtdepartemen_row->deptabbr;  break; } } ?>
                                          <td align="center"><?php foreach($dtbagian as $dtbagian_row) { if($dtbagian_row->bagianid == $rowlevel->id_bagian){ echo $dtbagian_row->bagianabbr;  break; } } ?></td>
                                          <td align="center"><b><?= $rowlevel->levelusernm;?></b></td>
                                          <td><?php if(strlen($rowlevel->bagian_akses)>20){ echo substr($rowlevel->bagian_akses,0,19).'...'; }else{ echo $rowlevel->bagian_akses; }?></td>
                                          <td align="center"><?php if($rowlevel->ori_akses=='1'){echo '&#10004;';}elseif($rowlevel->ori_akses=='0'){echo '&#10006;';}else{echo $rowlevel->ori_akses;}?></td>
                                          <td align="center"><?php if($rowlevel->audit_akses=='1'){echo '&#10004;';}elseif($rowlevel->audit_akses=='0'){echo '&#10006;';}else{echo $rowlevel->audit_akses;}?></td>
                                          <td align="center"><a href="<?= base_url('master/C_userlevel/form/edit/'.$rowlevel->leveluserid) ?>" target="_blank" title="Edit Data"><span class="btn bg-gradient-success feather icon-edit"></span></a></td>
                                          <td align="center"><a href="<?= base_url('master/C_userlevel/hapus/'.$rowlevel->leveluserid.'/'.($rowlevel->leveluserid+1)) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="btn bg-gradient-danger feather icon-trash-2"></span></a></td>
                                        </tr>
                                    <?php } } ?>
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