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
                    <h4 class="card-title">JABATAN</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <p class="card-text"><code>**Data ditampilkan berasal dari Payroll</code></p>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                                <thead>
                                    <tr class="table-primary text-center">
                                      <th rowspan="1" colspan="1">No</th>
                                      <th rowspan="1" colspan="1">Company</th>
                                      <th rowspan="1" colspan="1">Divisi</th>
                                      <th rowspan="1" colspan="1">Departemen</th>
                                      <th rowspan="1" colspan="1">Bagian</th>
                                      <th rowspan="1" colspan="1">Jabatan Abbr</th>
                                      <th rowspan="1" colspan="1">Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($dt_jabatan)>0){ 
                                      $no=1;
                                      foreach($dt_jabatan as $row){ ?>
                                        <tr>
                                            <td align="center"><?php echo $no++; ?></td>
                                            <td align="center"><?php echo $row->company; ?></td>
                                            <td align="center"><?php echo $row->divisi; ?></td>
                                            <td align="center"><?php echo $row->deptabbr; ?></td>
                                            <td align="center"><?php echo $row->bagianabbr; ?></td>
                                            <td align="center"><?php echo $row->jabatanabbr; ?></td>
                                            <td><?php echo $row->namajabatan; ?></td>
                                        </tr>
                                    <?php } }else{ ?>
                                      <tr>
                                        <td rowspan="1" colspan="4"></td>
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