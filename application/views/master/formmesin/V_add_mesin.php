<?php $this->load->view('template/headbar'); ?>


<!-- Content Header (Page header) -->
<!-- Main content -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $title; ?></h4>
                </div>

                <?php
                if ($aksi == 'aksi_add') {
                    $mesin_id     = "";
                    $nama_mesin   = "";
                    $kode_mesin   = "";
                    $lokasi_mesin = "";
                    $inactive     = "";
                    $bagian       = "";
                    $ket_mesin    = "";
                } else {
                    foreach ($dtmesin as $rowmesin) {
                        $mesin_id     = $rowmesin->mesin_id;
                        $nama_mesin   = $rowmesin->nama_mesin;
                        $kode_mesin   = $rowmesin->kode_mesin;
                        $lokasi_mesin = $rowmesin->lokasi_mesin;
                        $inactive     = $rowmesin->inactive;
                        $bagian       = $rowmesin->bagian;
                        $ket_mesin    = $rowmesin->ket_mesin;
                    }
                }
                ?>

                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <?php $this->session->flashdata('pesan') ?>
                        <form action="<?php echo base_url('master/formmesin/C_mesin/formInventarisMesin/' . $aksi) ?>" method="post">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    Nama Mesin
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" class="form-control" id="mesin_id" placeholder="" value="<?php echo $mesin_id; ?>" name="mesin_id">
                                    <input type="text" class="form-control" id="nama_mesin" placeholder="Nama Mesin" value="<?php echo $nama_mesin; ?>" name="nama_mesin" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    Kode Mesin
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="kode_mesin" placeholder="Kode Mesin" value="<?php echo $kode_mesin; ?>" name="kode_mesin" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    Lokasi
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="lokasi_mesin" placeholder="Lokasi Mesin" value="<?php echo $lokasi_mesin; ?>" name="lokasi_mesin" required><?php echo $lokasi_mesin; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    Keterangan
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="ket_mesin" placeholder="Keterangan" value="<?php echo $ket_mesin; ?>" name="ket_mesin"><?php echo $ket_mesin; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    Bagian
                                </div>
                                <div class="col-md-8">
                                    <select name="bagian" class="form-control" required="required">
                                        <option value="">- pilih -</option>
                                        <option value="CMP 1" <?php if ($bagian == 'CMP 1') {
                                                                    echo 'selected';
                                                                } ?>>CMP 1</option>
                                        <option value="CMP 2" <?php if ($bagian == 'CMP 2') {
                                                                    echo 'selected';
                                                                } ?>>CMP 2</option>
                                        <option value="CMP EVAPORATOR" <?php if ($bagian == 'CMP EVAPORATOR') {
                                                                            echo 'selected';
                                                                        } ?>>CMP EVAPORATOR</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    Status Mesin
                                </div>
                                <div class="col-md-8">
                                    <select name="inactive" class="form-control" required="required">
                                        <option value="">- pilih -</option>
                                        <option value="0" <?php if ($inactive == '0') {
                                                                echo 'selected';
                                                            } ?>>Active</option>
                                        <option value="1" <?php if ($inactive == '1') {
                                                                echo 'selected';
                                                            } ?>>Not Active</option>
                                    </select>
                                </div>
                            </div>

                            <br>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <button type="submit" class="btn bg-gradient-success" name="btnSave">Simpan</button>
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