<?php $this->load->view('template_v2/headbar'); ?>


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
          $tipe_mesin_id   = "";
          $nama_tipe_mesin = "";
          $section_id      = "";
          $no_urut         = "";
        } else {
          foreach ($dttipemesin as $tipe) {
            $tipe_mesin_id   = $tipe->tipe_mesin_id;
            $part_komponen   = json_decode($tipe->part_komponen);
            $nama_tipe_mesin = $tipe->nama_tipe_mesin;
            $section_id      = $tipe->section_id;
            $no_urut         = $tipe->no_urut;
          }
        }
        ?>

        <div class="card-content">
          <div class="card-body card-dashboard">
            <?php $this->session->flashdata('pesan') ?>
            <form action="<?php echo base_url('master/formmesin/C_mesin/formTipeMesin/' . $aksi) ?>" method="post">
              <div class="form-group row">
                <div class="col-md-2">
                  No Urut
                </div>
                <div class="col-md-1">
                  <input type="number" class="form-control" id="no_urut" placeholder="Nomor Urutan" value="<?php echo $no_urut; ?>" name="no_urut" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-2">
                  Nama Tipe Mesin
                </div>
                <div class="col-md-6">
                  <input type="hidden" class="form-control" id="tipe_mesin_id" placeholder="" value="<?php echo $tipe_mesin_id; ?>" name="tipe_mesin_id">
                  <input type="text" class="form-control" id="nama_tipe_mesin" placeholder="Nama Tipe Mesin" value="<?php echo $nama_tipe_mesin; ?>" name="nama_tipe_mesin" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-2">
                  Section Mesin
                </div>
                <div class="col-md-6">
                  <select name="section_id" id="section_id" class="form-control" required="required">
                    <option value="">-Pilih-</option>
                    <?php
                    if ($section_mesin) {
                      foreach ($section_mesin as $section) { ?>
                        <option value="<?= $section->section_id ?>" <?= $section_id == $section->section_id ? "selected" : '' ?>>
                          <?= $section->nama_section ?>
                        </option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-2">
                  Komponen Mesin
                </div>
                <div class="col-md-6">
                  <select name="part_komponen[]" id="part_komponen" class="form-control select2" multiple="multiple" required="required">
                    <option value="">-Pilih-</option>
                    <?php
                    if ($aksi == 'aksi_add') {
                      if ($komponen_mesin) {
                        foreach ($komponen_mesin as $row) { ?>
                          <option value="<?= $row->komponen_id ?>">
                            <?= $row->nama_komponen ?>
                          </option>
                        <?php
                        }
                      }
                    } else {
                      foreach ($komponen_mesin as $row) { ?>
                        <option value="<?= $row->komponen_id ?>" <?php
                                                                  if ($part_komponen) {
                                                                    foreach ($part_komponen as $val) {
                                                                      echo $row->komponen_id == $val ? "selected" : '';
                                                                    }
                                                                  } ?>>
                          <?= $row->nama_komponen ?>
                        </option>
                    <?php
                      }
                    }
                    ?>
                  </select>
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

<?php $this->load->view('template_v2/footbar'); ?>
<script>
  $('#part_komponen').select2();
</script>
<?php $this->load->view('template_v2/footbarend'); ?>