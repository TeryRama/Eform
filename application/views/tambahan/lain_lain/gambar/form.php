<?php
  $this->load->view('template/head');
?>

<!--tambahkan custom css disini-->
<!-- iCheck -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/flat/blue.css') ?>" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.css') ?>" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet" type="text/css" />
<!-- Date Picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />

<?php
  $this->load->view('template/topbar2');
?>


<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-lg-12">
        <div class='box box-warning'>
            <div class='box-header'>
                <h3 class='box-title'>FORM INTERPOLASI</h3>
            </div>

<?php
    if ($aksi == 'aksi_add') {
        $id_photo = "";
        $photos   = "";
        $caption       = "";
        $form_kode           = "";
        $ukuran_file  = "";
        $tipe_file     = "";
    } else {
        foreach ($dtphoto as $rowsample) {
            $id_photo = $rowsample->id_photo;
            $photos   = $rowsample->photos;
            $caption       = $rowsample->caption;
            $form_kode           = $rowsample->form_kode;
            $ukuran_file  = $rowsample->ukuran_file;
            $tipe_file     = $rowsample->tipe_file;
        }
    }
?>

<div class="row">
    <div class="col-lg-12">
    <?php $this->session->flashdata('pesan') ?>
        <form action="<?php echo base_url('tambahan/lain_lain/C_crosscheck/form/' . $aksi) ?>" method="post">
            <div class="row">
                <div class="col-lg-10">
                    <div class="form-group">
                    <br>
                        <label for="KodeSample" class="col-sm-2 control-label">Photo</label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-3">
                                <input type="hidden" class="form-control" id="id_photo" placeholder="" value="<?php echo $id_photo; ?>" name="id_photo">
                                <input type="file" name="input_gambar">
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <div class="form-group">
                    <br>
                        <label for="caption" class="col-sm-2 control-label">Caption</label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="caption" placeholder="Caption" value="<?php echo $caption; ?>" name="caption" required>
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <div class="form-group">
                    <br>
                        <label for="form_kode" class="col-sm-2 control-label">Form Kode</label>
                            <div class="col-sm-1">:</div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="form_kode" placeholder="Form Kode" value="<?php echo $form_kode; ?>" name="form_kode" required>
                            </div>
                    </div>
                </div>
            </div>
            <!-- <input type="hidden" name="created_date" value="<?php echo date('Y-m-d');?>" id="created_date">
            <input type="hidden" name="created_time" value="<?php echo date('H:i:s');?>" id="created_time">
            <input type="hidden" name="created_by" value="<?php echo $username;?>" id="created_by">

            <input type="hidden" name="update_date" value="<?php echo date('Y-m-d');?>" id="update_date">
            <input type="hidden" name="update_time" value="<?php echo date('H:i:s');?>" id="update_time">
            <input type="hidden" name="update_by" value="<?php echo $username;?>" id="update_by"> -->

            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary" name="btnSave">Simpan</button>
                            <button type="button" onclick="location.href='<?php echo base_url('tambahan/lain_lain/C_crosscheck') ?>'" class="btn btn-success">Kembali</button>
                        </div>
                    </div>
                </div>
            </div><br>
        </form>
    </div>
    </div>
</div>
</div>
</div>

</section><!-- /.content -->
<?php
    $this->load->view('template/js2');
?>


<!--tambahkan custom js disini-->
<!-- Sparkline -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/sparkline/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/chartjs/Chart.min.js') ?>" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/pages/dashboard2.js') ?>" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/demo.js') ?>" type="text/javascript"></script>

<?php
    $this->load->view('template/foot2');
?>
