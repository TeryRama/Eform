<?php $this->load->view('template/headbar'); ?>


<!-- Content Header (Page header) -->
<!-- Main content -->

<!-- Section Komponen Mesin -->
<section id="section-mesin">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Data Komponen Mesin</h4>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <a type="button" href="<?php echo base_url('master/formmesin/C_mesin/formKomponenMesin/add') ?>" class="btn bg-gradient-primary" role="button">Tambah Data</a></br></br>
            <div class="table-responsive">
              <table class="table table-striped table-bordered complex-headers">
                <thead>
                  <tr>
                    <th class="table-primary align-middle text-center">No</th>
                    <th class="table-primary align-middle text-center">Nama Komponen</th>
                    <th class="table-primary align-middle text-center">Updated By</th>
                    <th class="table-primary align-middle text-center">Ubah</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($komponenmesin) {
                    $no = 1;
                    foreach ($komponenmesin as $komponen) { ?>
                      <tr>
                        <td style="text-align:center;"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $komponen->nama_komponen ?></td>
                        <td class="text-center"><?php echo $komponen->update_by ?></td>
                        <td align="center">
                          <a href="<?php echo base_url('master/formmesin/C_mesin/formKomponenMesin/edit/' . $komponen->komponen_id) ?>" alt="Edit Data">
                            <span class="btn btn-outline-success feather icon-edit" style="font-size:13px; color:black"></span>
                          </a>
                        </td>
                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Section Komponen Mesin -->

<!--<section id="inventaris-mesin">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Data Inventaris Mesin</h4>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <a type="button" href="</?php echo base_url('master/formmesin/C_mesin/formInventarisMesin/add') ?>" class="btn bg-gradient-primary" role="button">Tambah Data</a></br></br>
            <div class="table-responsive">
              <table class="table table-striped table-bordered complex-headers">
                <thead>
                  <tr>
                    <th class="table-primary align-middle text-center">No</th>
                    <th class="table-primary align-middle text-center">Nama Mesi</th>
                    <th class="table-primary align-middle text-center">Kode Mesin</th>
                    <th class="table-primary align-middle text-center">Lokasi Mesin</th>
                    <th class="table-primary align-middle text-center">Bagian</th>
                    <th class="table-primary align-middle text-center">Updated By</th>
                    <th class="table-primary align-middle text-center">Status</th>
                    <th class="table-primary align-middle text-center">Ubah</th>
                    <th class="table-primary align-middle text-center">Hapus</th>
                  </tr>
                </thead>
                <tbody>
                  </?php if (empty($query)) { ?>
                    <tr>
                      <td class="text-center" colspan="8">
                        </?php
                        echo "Tidak ada data!!"
                        ?>
                      </td>
                    </tr>
                    </?php
                  } else {
                    $no = 0;
                    foreach ($query as $row) {
                      $no++; ?>
                      <tr>
                        <td style="text-align:center;"></?php echo $no; ?></td>
                        <td class="text-center"></?php echo $row->nama_mesin ?></td>
                        <td class="text-center"></?php echo $row->kode_mesin ?></td>
                        <td class="text-center"></?php echo $row->lokasi_mesin ?></td>
                        <td class="text-center"></?php echo $row->bagian ?></td>
                        <td style="text-align:center;"></?php echo $row->update_by . '<br>' . $row->update_date . '<br>' . $row->update_time  ?></td>
                        <td style="text-align:center;"></?php if ($row->inactive == '1') {
                                                          echo 'Non Active';
                                                        } elseif ($row->inactive == '0') {
                                                          echo 'Active';
                                                        } else {
                                                          echo $row->inactive;
                                                        } ?></td>
                        <td align="center">
                          <a href="</?php echo base_url('master/formmesin/C_mesin/formInventarisMesin/edit/' . $row->mesin_id) ?>" alt="Edit Data">
                            <span class="btn btn-outline-success feather icon-edit" style="font-size:13px; color:black"></span>
                          </a>
                        </td>
                        <td align="center">
                          <a href="</?php echo base_url('master/formmesin/C_mesin/formInventarisMesin/delete/' . $row->mesin_id) ?>" target="_self" alt="Delete Data" onClick="return confirm('ANDA YAKIN INGIN MENGHAPUS MESIN INI ?')">
                            <span class="btn btn-outline-danger feather icon-trash-2" style="font-size:13px; color:black"></span>
                          </a>
                        </td>
                      </tr>
                  </?php }
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>/.content-->

<!--<section id="Section-mesin">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Data Section Mesin</h4>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <a type="button" href="</?php echo base_url('master/formmesin/C_mesin/formSectionMesin/add') ?>" class="btn bg-gradient-primary" role="button">Tambah Data</a></br></br>
            <div class="table-responsive">
              <table class="table table-striped table-bordered complex-headers">
                <thead>
                  <tr>
                    <th class="table-primary align-middle text-center">No</th>
                    <th class="table-primary align-middle text-center">Nama Section</th>
                    <th class="table-primary align-middle text-center">No Urut</th>
                    <th class="table-primary align-middle text-center">Updated By</th>
                    <th class="table-primary align-middle text-center">Ubah</th>
                    <th class="table-primary align-middle text-center">Hapus</th>
                  </tr>
                </thead>
                <tbody>
                  </?php if (empty($query)) { ?>
                    <tr>
                      <td class="text-center" colspan="8">
                        </?php
                        echo "Tidak ada data!!"
                        ?>
                      </td>
                    </tr>
                    </?php
                  } else {
                    $no = 0;
                    foreach ($query as $row) {
                      $no++; ?>
                      <tr>
                        <td style="text-align:center;"></?php echo $no; ?></td>
                        <td class="text-center"></?php echo $row->nama_section ?></td>
                        <td class="text-center"></?php echo $row->no_urut ?></td>
                        <td style="text-align:center;"></?php echo $row->update_by . '<br>' . $row->update_date . '<br>' . $row->update_time  ?></td>
                        <td align="center">
                          <a href="</?php echo base_url('master/formmesin/C_mesin/formSectionMesin/edit/' . $row->section_id) ?>" alt="Edit Data">
                            <span class="btn btn-outline-success feather icon-edit" style="font-size:13px; color:black"></span>
                          </a>
                        </td>
                        <td align="center">
                          <a href="</?php echo base_url('master/formmesin/C_mesin/formSectionMesin/delete/' . $row->section_id) ?>" target="_self" alt="Delete Data" onClick="return confirm('ANDA YAKIN INGIN MENGHAPUS MESIN INI ?')">
                            <span class="btn btn-outline-danger feather icon-trash-2" style="font-size:13px; color:black"></span>
                          </a>
                        </td>
                      </tr>
                  </?php }
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>/.content-->

<?php $this->load->view('template/footbar'); ?>
<?php $this->load->view('template/footbarend'); ?>