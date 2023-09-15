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
          $section_id     = "";
          $nama_section   = "";
          $no_urut   = "";
        } else {
          foreach ($dtsection as $section) {
            $section_id   = $section->section_id;
            $nama_section = $section->nama_section;
            $no_urut      = $section->no_urut;
          }
        }
        ?>

        <div class="card-content">
          <div class="card-body card-dashboard">
            <?php $this->session->flashdata('pesan') ?>
            <form action="<?php echo base_url('master/formmesin/C_mesin/formSectionMesin/' . $aksi) ?>" method="post">
              <div class="form-group row">
                <div class="col-md-1">
                  No Urut
                </div>
                <div class="col-md-1">
                  <input type="number" class="form-control" id="no_urut" placeholder="Nomor Urut" value="<?php echo $no_urut; ?>" name="no_urut" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-1">
                  Nama Section
                </div>
                <div class="col-md-6">
                  <input type="hidden" class="form-control" id="section_id" placeholder="" value="<?php echo $section_id; ?>" name="section_id">
                  <input type="text" class="form-control" id="nama_section" placeholder="Nama Section" value="<?php echo $nama_section; ?>" name="nama_section" required>
                </div>
              </div>
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