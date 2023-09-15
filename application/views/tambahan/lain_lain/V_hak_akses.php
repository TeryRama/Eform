
<?php
date_default_timezone_set("Asia/Jakarta");
?>

<?php
$this->load->view('template/head');
?>
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />

<?php
$this->load->view('template/topbar2');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-warning">
                <div class="box-header" style="text-align:center;">
                    <div class="row">
                    <div class="col-md-12" style="text-align:center;">
                        <img src="<?php echo base_url('assets/images/Logo_PSG.gif')?>"/>
                        <br>
                        <h3><b><?php echo $this->config->item("nama_perusahaan"); ?></b><br>
                        <h2 class="box-title" ><b><?php echo 'DAFTAR HAK AKSES FORM PADA APLIKASI E-Form WHS';?> </b></h2></h3>
                    </div>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <br/>

                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <form action="<?php echo base_url('tambahan/lain_lain/C_hak_akses/get_hak_akses') ?>" id="form1" name="form1" method="post" role="form" class="form-horizontal">
                            <div class="box" style="padding: 15px; font-size: 12px; border: solid 1px;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="bagian" class="col-sm-5 control-label" style="text-align:left;"><b><u>Bagian</u></b><br/><i>Part of</i></label>
                                            <div class="col-sm-6">
                                                <input type="hidden" name="bagian" id="bagian" class="form-control" value="<?php echo $bagian;?>"/>
                                                <select name="bagianid" id="bagianid" class="form-control">
                                                    <option value="">- pilih -</option>
                                                    <?php
                                                    foreach($list_bagian as $list_bagian_row){?>
                                                    <option value="<?php echo $list_bagian_row->bagid;?>" <?php if($list_bagian_row->bagid==$bagianid){echo 'selected';}?>><?php echo $list_bagian_row->bagnm;?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="posisi" class="col-sm-5 control-label" style="text-align:left;"><b><u>Jabatan</u></b><br/><i>Position</i></label>
                                            <div class="col-sm-6">
                                                <select name="posisi" id="posisi" class="form-control">
                                                    <option value="">- pilih -</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="level" class="col-sm-5 control-label" style="text-align:left;"><b><u>Level Pengguna</u></b><br/><i>User Level</i></label>
                                            <div class="col-sm-6">
                                                <select name="level" id="level" class="form-control">
                                                    <option value="">- pilih -</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik" class="col-sm-5 control-label" style="text-align:left;"><b><u>Nomor Induk Karyawan (NIK)</u></b><br/><i>Registration Number of Employees</i></label>
                                            <div class="col-sm-6">
                                                <div id="html_nik">
                                                    <input type="text" name="nik" id="nik" class="form-control" value="" />
                                                </div>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-5 control-label" style="text-align:left;"><b><u>Nama</u></b><br/><i>Name</i></label>
                                            <div class="col-sm-6">
                                                <div id="html_nama">
                                                    <input type="text" name="nama" id="nama" class="form-control" value="" />
                                                </div>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="col-sm-1"></div>
                                            <label for="form_bagian" class="col-sm-5 control-label" style="text-align:left;"><b><u>Jenis Form</u></b><br/><i>Form Type</i></label>
                                            <div class="col-sm-6">
                                                <select name="form_bagian" id="form_bagian" class="form-control">
                                                    <option value="">- pilih -</option>
                                                    <option value="Form Lab Kimia">Form Lab Kimia</option>
                                                    <option value="Form Lab Kimia & Mikro">Form Lab Kimia & Mikro</option>
                                                    <option value="Form Lab Kimia, Mikro & Monitoring">Form Lab Kimia, Mikro & Monitoring</option>
                                                    <option value="Form Lab Mikro">Form Lab Mikro</option>
                                                    <option value="Form Monitoring">Form Monitoring</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-1"></div>
                                            <label for="form_kategori" class="col-sm-5 control-label" style="text-align:left;"><b><u>Kategori Form</u></b><br/><i>Form Category</i></label>
                                            <div class="col-sm-6">
                                                <select name="form_kategori" id="form_kategori" class="form-control">
                                                    <option value="">- pilih -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-1"></div>
                                            <label for="form_subkategori" class="col-sm-5 control-label" style="text-align:left;"><b><u>Sub Kategori Form</u></b><br/><i>Form Sub Category</i></label>
                                            <div class="col-sm-6">
                                                <select name="form_subkategori" id="form_subkategori" class="form-control">
                                                    <option value="">- pilih -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-1"></div>
                                            <label for="form_kode" class="col-sm-5 control-label" style="text-align:left;"><b><u>Nama Form</u></b><br/><i>Form Name</i></label>
                                            <div class="col-sm-6">
                                                <input type="hidden" name="form_nama" id="form_nama" class="form-control" value=""/>
                                                <select name="form_kode" id="form_kode" class="form-control">
                                                    <option value="">- pilih -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-1"></div>
                                            <label for="form_versi" class="col-sm-5 control-label" style="text-align:left;"><b><u>Versi Form</u></b><br/><i>Form Version</i></label>
                                            <div class="col-sm-6">
                                                <select name="form_versi" id="form_versi" class="form-control">
                                                    <option value="">- pilih -</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                          <span class="input-group-addon" style="background-color: #CCCCC;">
                                            Tampilkan Semua (Show All) <input type="checkbox" aria-label="..." name="showall" id="showall"> 
                                          </span>
                                          <span class="input-group-btn">
                                            <button class="btn btn-info" type="submit">Tampil (Show)</button>
                                          </span>
                                        </div><!-- /input-group -->
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>

                    <?php if (isset($message)) {
                        if($message!=''){
                    ?>
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <span class="glyphicon glyphicon-warning-sign"></span>
                                    <?php echo $message; ?>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    <?php } } ?>


                    <div class="row">
                        <br/><br/>
                        <div class="col-lg-12">
                            <?php if(isset($hak_akses)){  ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped sticky-header" id="example2">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th rowspan="2">Bagian</th>
                                                <th rowspan="2">Jabatan</th>
                                                <th rowspan="2">Level Pengguna</th>
                                                <th rowspan="2">NIK</th>
                                                <th rowspan="2">Nama</th>
                                                <th rowspan="2">Jenis Form</th>
                                                <th rowspan="2">Kategori Form</th>
                                                <th rowspan="2">Sub Kategori Form</th>
                                                <th rowspan="2">Nama Form</th>
                                                <th rowspan="2">Versi Form</th>
                                                <th rowspan="2">Tanggal Efective Form</th>
                                                <th rowspan="2">Judul Form</th>
                                                <th colspan="4">Akses</th>
                                            </tr>
                                            <tr>
                                                <th>Create</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                                <th>Export Excel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach($hak_akses as $hak_akses_row){
                                                if($hak_akses_row->form_create=='1'){$form_create = '&#10004;';}else{$form_create = '&#10006;';}
                                                if($hak_akses_row->form_update=='1'){$form_update = '&#10004;';}else{$form_update = '&#10006;';}
                                                if($hak_akses_row->form_delete=='1'){$form_delete = '&#10004;';}else{$form_delete = '&#10006;';}
                                                if($hak_akses_row->form_excel=='1'){$form_excel = '&#10004;';}else{$form_excel = '&#10006;';}
                                                ?>
                                            <tr>
                                                <td><?php echo $hak_akses_row->bagnm;?></td>
                                                <td><?php echo $hak_akses_row->jabnm;?></td>
                                                <td><?php echo $hak_akses_row->levelusernm;?></td>
                                                <td><?php echo $hak_akses_row->nik;?></td>
                                                <td><?php echo $hak_akses_row->nmlengkap;?></td>
                                                <td><?php echo $hak_akses_row->formjnsnm;?></td>
                                                <td><?php echo $hak_akses_row->formkategorinm;?></td>
                                                <td><?php echo $hak_akses_row->formkategori2nm;?></td>
                                                <td><?php echo $hak_akses_row->formnm;?></td>
                                                <td><?php echo $hak_akses_row->formversi;?></td>
                                                <td><?php echo $hak_akses_row->formefective;?></td>
                                                <td><?php echo $hak_akses_row->formjudul;?></td>
                                                <td><?php echo $form_create;?></td>
                                                <td><?php echo $form_update;?></td>
                                                <td><?php echo $form_delete;?></td>
                                                <td><?php echo $form_excel;?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div align = "right">
                        <!-- <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" name="btn_modal" value="0" class="btn_ncmodal btn btn-info">Add Report</button>
                          <button type="button" name="btndelete" value="0" class="btndelete btn btn-danger">Delete Report</button>
                        </div>
                          <a href="<?php //echo base_url('export_excel/C_export_toexcel_ketidaksesuaian/exportxls/'.$date_from.'/'.$date_to) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><span class="btn btn-success glyphicon glyphicon-export"></span></a> -->
                        </div>
                    </div>
                    <br>
                    <div class="panel-footer">
                        <div class="clearfix">
                          <!-- <span class="pull-left">Mulai Berlaku: 02-08-2018</span>
                          <a href="#"><span class="pull-right">INT-QAD-169-00</span></a> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- /.box-body -->
</section><!-- /.content -->



<?php
$this->load->view('template/js2');
?>

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>

<!-- page script -->

<script type="text/javascript">
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#form1').submit(function() {
            var bagian = $('#bagian').val();
            var posisi = $('#posisi').val();
            var level = $('#level').val();
            var nik = $('#nik').val();
            var nama = $('#nama').val();
            var username = $('#username').val();
            if ($('input:checkbox', this).is(':checked')) {
                alert('Anda Ingin menampilkan semua data..?');
                    return true;
            }else {
                if( bagian=='' && posisi=='' && level=='' && nik=='' && nama=='' && username==''){
                    alert('Maaf Anda Belum menginput salah satu parameter pencarian data..!');
                    return false;
                }else{} 
            }
        });

        $(document).on('change', '#form_bagian', function() {
            var that = $(this);
            var dtbagian = $(this).val();

            $('#form_kategori').prop('selectedIndex',0);
            $('#form_kategori').find('option:not(:first)').remove();
            $('#form_subkategori').prop('selectedIndex',0);
            $('#form_subkategori').find('option:not(:first)').remove();
            $('#form_nama').val('');
            $('#form_kode').prop('selectedIndex',0);
            $('#form_kode').find('option:not(:first)').remove();
            $('#form_versi').prop('selectedIndex',0);
            $('#form_versi').find('option:not(:first)').remove();

            if(dtbagian!=''){
                $.ajax({
                     url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_hak_akses/get_form_kategori",
                     type: 'post',
                     data: { bagian:dtbagian},
                     success: function(html_kategori){
                        //console.log(html_kategori);
                        $("#form_kategori").append(html_kategori);
                     },
                     error: function(){
                         alert('fail');
                     }
                 });
            }
        });

        $(document).on('change', '#form_kategori', function() {
            var that = $(this);
            var dtform_kategori = $(this).val();
            var dtbagian = $('#form_bagian').val();

            $('#form_subkategori').prop('selectedIndex',0);
            $('#form_subkategori').find('option:not(:first)').remove();
            $('#form_nama').val('');
            $('#form_kode').prop('selectedIndex',0);
            $('#form_kode').find('option:not(:first)').remove();
            $('#form_versi').prop('selectedIndex',0);
            $('#form_versi').find('option:not(:first)').remove();

            if(dtform_kategori!=''){
                $.ajax({
                     url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_hak_akses/get_form_subkategori",
                     type: 'post',
                     data: { bagian:dtbagian, form_kategori:dtform_kategori},
                     success: function(html_subkategori){
                        //console.log(html_subkategori);
                        $("#form_subkategori").append(html_subkategori);
                     },
                     error: function(){
                         alert('fail');
                     }
                 });
            }
        });

        $(document).on('change', '#form_subkategori', function() {
            var that = $(this);
            var dtform_subkategori = $(this).val();
            var dtform_kategori = $('#form_kategori').val();
            var dtbagian = $('#form_bagian').val();

            $('#form_nama').val('');
            $('#form_kode').prop('selectedIndex',0);
            $('#form_kode').find('option:not(:first)').remove();
            $('#form_versi').prop('selectedIndex',0);
            $('#form_versi').find('option:not(:first)').remove();

            if(dtform_kategori!=''){
                $.ajax({
                     url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_hak_akses/get_form_kode",
                     type: 'post',
                     data: { bagian:dtbagian, form_kategori:dtform_kategori, form_subkategori:dtform_subkategori},
                     success: function($html_formkode){
                        console.log($html_formkode);
                        $("#form_kode").append($html_formkode);
                     },
                     error: function(){
                         alert('fail');
                     }
                 });
            }
        });

        $(document).on('change', '#form_kode', function() {
            var that = $(this);
            var dtnm = $(this).find('option:selected').text();

            $('#form_nama').val(dtnm);

            var dtform_kode = $(this).val();

            $('#form_versi').prop('selectedIndex',0);
            $('#form_versi').find('option:not(:first)').remove();

            if(dtform_kode!=''){
                $.ajax({
                     url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_hak_akses/get_form_versi",
                     type: 'post',
                     data: { form_kode:dtform_kode},
                     success: function($html_formversi){
                        console.log($html_formversi);
                        $("#form_versi").append($html_formversi);
                     },
                     error: function(){
                         alert('fail');
                     }
                 });
            }
        });

        $(document).on('change', '#bagianid', function() {
            var that = $(this);
            var dtdeptid = $(this).val();
            var dtbagian = $(this).find('option:selected').text();

            $('#bagian').val();
            
            $('#posisi').prop('selectedIndex',0);
            $('#posisi').find('option:not(:first)').remove();
            $('#level').prop('selectedIndex',0);
            $('#level').find('option:not(:first)').remove();
            $("#html_nik").empty();
            $('#html_nik').append('<input type="text" name="nik" id="nik" class="form-control" value="" />');
            $("#html_nama").val('');

            if(dtbagian!=''){
                $.ajax({
                     url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_hak_akses/get_posisi",
                     type: 'post',
                     data: { deptid:dtdeptid},
                     success: function(html_posisi){
                        //console.log(html_posisi);
                        var html_poslev = html_posisi.split("//");
                        $("#posisi").append(html_poslev[0]);
                        $("#level").append(html_poslev[1]);
                     },
                     error: function(){
                         alert('fail');
                     }
                 });
            }
        });


        /*$(document).on('focusin', 'input, select, textarea', function(){
            console.log("Saving value " + $(this).val());
            if($(this).prop('type')=='select-one'){
                $(this).data('val', $(this).find('option:selected').text());
            }else{
                $(this).data('val', $(this).val());
            }
        }).on('change','input, select, textarea', function(){
            var prev = $(this).data('val');
            if($(this).prop('type')=='select-one'){
                var current = $(this).find('option:selected').text();
            }else{
                var current = $(this).val();
            }
            var current = $(this).val();
            var elemen_name = $(this).prop('name');
            console.log("Prev value " + prev);
            console.log("New value " + current);
            console.log("name " + elemen_name);
        });*/
    });
</script>


<?php
$this->load->view('template/foot2');
?>

