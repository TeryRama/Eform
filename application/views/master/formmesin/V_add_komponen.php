<?php $this->load->view('template/headbar'); ?>


<!-- Content Header (Page header) -->
<!-- Main content -->
<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"><?= $title ?></h4>
        </div>

        <?php
        if ($aksi == 'aksi_add') {
          $komponen_id     = "";
          $nama_komponen   = "";
          $kode_komponen   = "";
        } else {
          foreach ($dtkomponenmesin as $row) {
            $komponen_id     = $row->komponen_id;
            $nama_komponen   = $row->nama_komponen;
            $kode_komponen   = $row->kode_komponen;
          }
        }
        ?>

        <div class="card-content">
          <div class="card-body card-dashboard">
            <?php $this->session->flashdata('pesan') ?>
            <form action="<?php echo base_url('master/formmesin/C_mesin/formKomponenMesin/' . $aksi) ?>" method="post">
              <div class="form-group row">
                <div class="col-md-2">
                  Nama Komponen
                </div>
                <div class="col-md-5">
                  <input type="hidden" class="form-control" id="komponen_id" placeholder="" value="<?php echo $komponen_id; ?>" name="komponen_id">
                  <input type="text" class="form-control" id="nama_komponen" placeholder="Nama Komponen" value="<?php echo $nama_komponen; ?>" name="nama_komponen" required>
                </div>
              </div><div class="form-group row">
                <div class="col-md-2">
                  Kode Komponen
                </div>
                <div class="col-md-5">
                  <input type="text" class="form-control" id="kode_komponen" placeholder="Kode Komponen" value="<?php echo $kode_komponen; ?>" name="nama_komponen" required>
                </div>
              </div>

              <br>
              <div class="form-group row">
                <div class="col-sm-3">
                  <button type="submit" class="btn bg-gradient-primary" name="btnSave">Simpan</button>
                  <button type="button" onclick="location.href='<?php echo base_url('master/formmesin/C_mesin') ?>'" class="btn bg-gradient-dark">Kembali</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- /.content -->

<?php $this->load->view('template/footbar'); ?>
<?php $this->load->view('template/footbarend'); ?>