
<?php
date_default_timezone_set("Asia/Jakarta");
?>

<?php
$this->load->view('template/head');
?>

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
                        <h2 class="box-title" ><b><?php echo 'DAFTAR KETIDAKSESUAIAN FORM PADA APLIKASI E-Form WHS';?> </b></h2></h3>
                    </div>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <br/>

                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <form action="<?php echo base_url('tambahan/lain_lain/C_ketidaksesuaian/get_by_date') ?>" id="form1" name="form1" method="post" role="form" class="form-horizontal">
                            <div class="box" style="padding: 15px; font-size: 12px; border: solid 1px;">
                                <div class="row">
                                    <label for="date_from" class="col-sm-3 control-label" style="text-align:left;">Periode</label>
                                     <div class="form-group col-sm-3">
                                            <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd">
                                    <input name="date_from" type="text" id="date_from" value="<?php echo $date_from;?>" class="form-control" required>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                     <label for="date_to" class="col-sm-1 control-label" style="text-align:left;">s/d</label>
                                    <div class="form-group col-sm-3">
                                            <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd">
                                    <input name="date_to" type="text" id="date_to" value="<?php echo $date_to;?>" class="form-control" required>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                     <label for="" class="col-sm-1 control-label" style="text-align:left;"></label>
                                     <div class="form-group col-sm-1" style="text-align:right;">
                                    <button type="submit" class="btn btn-primary" id="btnsimpan">Tampil</button>
                                     </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                        <div align = "right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <button type="button" name="btn_modal" value="0" class="btn_ncmodal btn btn-info">Add Report</button>
                              <button type="button" name="btnmodal_delete" value="0" class="btnmodal_delete btn btn-danger">Delete Report</button>
                            </div>
                              <a href="<?php echo base_url('export_excel/C_export_toexcel_ketidaksesuaian/exportxls/'.$date_from.'/'.$date_to) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><span class="btn btn-success glyphicon glyphicon-export"></span></a>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-lg-12">
                        <form class="form-horizontal" role="form1" action="#" name="form1" id="form1" method="post">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped sticky-header">
                                    <thead class="bg-primary">
                                        <tr>
                                           <th rowspan="2"><input type="checkbox" class="checkall" onClick="toggle(this)"/></th>
                                           <th rowspan="2">No</th>
                                           <th rowspan="2">Bagian</th>
                                           <th rowspan="2">Form Kategori</th>
                                           <th rowspan="2">Form Sub Kategori</th>
                                           <th rowspan="2">Form Nama</th>
                                           <th rowspan="2">Form Versi</th>
                                           <th rowspan="2">Form Judul</th>
                                           <th rowspan="2">Foto Ketidaksesuaian</th>
                                           <th rowspan="2" colspan="2">Ketidaksesuaian</th>
                                           <th rowspan="2">Dilaporkan Oleh</th>
                                           <th colspan="4">Tindakan</th>
                                           <th colspan="<?php if($on_audit=='1'){echo '4';}else{echo '5';}?>">Verifikasi</th>    
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Oleh</th>
                                            <th>Action</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <?php if($on_audit=='1'){}else{?> <th>Hidden</th><?php } ?>
                                            <th>Oleh</th>
                                            <th>Verify</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($ketidaksesuaian)){ 
                                            $no=0;
                                            foreach($ketidaksesuaian as $ketidaksesuaian_row){$no++;
                                                if($ketidaksesuaian_row->form_kategori!=''){
                                                    if($ketidaksesuaian_row->form_kategori!='-'){$val_kategori=$ketidaksesuaian_row->form_kategori;}else{$val_kategori='-';}
                                                }else{$val_kategori='';}
                                                if($ketidaksesuaian_row->form_subkategori!=''){
                                                    if($ketidaksesuaian_row->form_subkategori!='-'){$val_subkategori=$ketidaksesuaian_row->form_subkategori;}else{$val_subkategori='-';}
                                                }else{$val_subkategori='';}

                                                if($ketidaksesuaian_row->report_date!=''){
                                                    $val_report_date = date("d-m-Y",strtotime($ketidaksesuaian_row->report_date));
                                                }else{$val_report_date = '';}

                                                if($ketidaksesuaian_row->action_date!=''){
                                                    $val_action_date = date("d-m-Y",strtotime($ketidaksesuaian_row->action_date));
                                                }else{$val_action_date = '';}

                                                if($ketidaksesuaian_row->verifi_date!=''){
                                                    $val_verifi_date = date("d-m-Y",strtotime($ketidaksesuaian_row->verifi_date));
                                                }else{$val_verifi_date = '';}
                                            ?>
                                        <tr>
                                            <td><?php if($ketidaksesuaian_row->verifi_status!='OK'){?><input name="chk[]" type="checkbox" class="checkall" value="<?php echo $ketidaksesuaian_row->id;?>"/><?php } ?></td>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $ketidaksesuaian_row->bagian;?></td>
                                            <td><?php echo $val_kategori;?></td>
                                            <td><?php echo $val_subkategori;?></td>
                                            <td><?php echo $ketidaksesuaian_row->form_nama;?></td>
                                            <td><?php echo $ketidaksesuaian_row->form_versi;?></td>
                                            <td><?php echo $ketidaksesuaian_row->form_judul;?></td>
                                            <td><?php if(isset($ketidaksesuaian_row->foto_ketidaksesuaian)) { 
                                                $url = base_url();
                                                $base_path = str_replace('qa/','',$url); ?>
                                                <img id="zoom_08" src="<?php echo base_url();?>upload_foto/frmketidaksesuaian/<?php echo $ketidaksesuaian_row->foto_ketidaksesuaian;?>" data-zoom-image="" width="250px" height="100px"/>
                                                <a href="<?php echo $base_path.'upload_foto/frmketidaksesuaian/'.preg_replace("/[\s_]/", "_", $ketidaksesuaian_row->foto_ketidaksesuaian); ?>" target="_blank"><?php echo $ketidaksesuaian_row->foto_ketidaksesuaian.' - ';?>View file</a>
                                                  <br/>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $ketidaksesuaian_row->ketidaksesuaian;?></td>
                                            <td><?php if($ketidaksesuaian_row->verifi_status!='OK'){?>
                                                <button type="button" name="btn_edit" value="<?php echo $ketidaksesuaian_row->id;?>" class="btn_ncmodal btn btn-primary"><span class="glyphicon glyphicon-pencil" ></span></button> <?php } ?></td>
                                            <td><?php echo $ketidaksesuaian_row->report_by.'<br/>'.$val_report_date.'<br/>'.$ketidaksesuaian_row->report_time;?></td>
                                            <td><?php echo $ketidaksesuaian_row->action_ket;?></td>
                                            <td><?php echo $ketidaksesuaian_row->action_status;?></td>
                                            <td><?php echo $ketidaksesuaian_row->action_by.'<br/>'.$val_action_date.'<br/>'.$ketidaksesuaian_row->action_time;?></td>
                                            <td><?php if($ketidaksesuaian_row->verifi_status!='OK'){?>
                                                <button type="button" name="btn_action" value="<?php echo $ketidaksesuaian_row->id;?>" class="btn_ncmodal btn btn-info"><span class="glyphicon glyphicon-pencil" ></span></button> <?php } ?></td>
                                            <td><?php echo $ketidaksesuaian_row->verifi_ket;?></td>
                                            <td><?php echo $ketidaksesuaian_row->verifi_status;?></td>
                                            <?php if($on_audit=='1'){}else{?> 
                                            <td><?php if($ketidaksesuaian_row->verifi_hidden=='1'){echo 'Hidden';}elseif($ketidaksesuaian_row->verifi_hidden=='0'){echo 'Show';}else{};?></td> 
                                            <?php } ?>
                                            <td><?php echo $ketidaksesuaian_row->verifi_by.'<br/>'.$val_verifi_date.'<br/>'.$ketidaksesuaian_row->verifi_time;?></td>
                                            <td><?php if($ketidaksesuaian_row->verifi_status!='OK'){?>
                                                <button type="button" name="btn_verify" value="<?php echo $ketidaksesuaian_row->id;?>" class="btn_ncmodal btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></button> <?php } ?></td>
                                        </tr>    
                                        <?php } }else{ ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <?php if($on_audit=='1'){}else{?> 
                                            <td></td> 
                                            <?php } ?>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot class="bg-primary">
                                        <tr>
                                            <td colspan="<?php if($on_audit=='1'){echo '20';}else{echo '21';}?>"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                        </div>
                    </div>

                    <div class="box-footer">
                        <!-- <div align = "right">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" name="btn_modal" value="0" class="btn_ncmodal btn btn-info">Add Report</button>
                          <button type="button" name="btnmodal_delete" value="0" class="btnmodal_delete btn btn-danger">Delete Report</button>
                        </div>
                          <a href="<?php //echo base_url('export_excel/C_export_toexcel_ketidaksesuaian/exportxls/'.$date_from.'/'.$date_to) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><span class="btn btn-success glyphicon glyphicon-export"></span></a>
                        </div> -->
                    </div>
                    <br>
                    <div class="panel-footer">
                        <div class="clearfix">
                          <span class="pull-left">Mulai Berlaku: 02-08-2018</span>
                          <a href="#"><span class="pull-right">INT-QAD-169-00</span></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- /.box-body -->
</section><!-- /.content -->

<div class="modal fade bd-example-modal-lg" id="NCModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <form class="form-horizontal" role="form" action="#" name="form_modal" id="form_modal" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <button type="button" class="close"
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title text-warning" id="myModalLabel">
                    <div id="NCJudul"></div>
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">  
                                
                                 
                                  <div id="NCBody">

                                  </div>
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                <button type="button" name="btnmodal_save"  id="btnmodal_save" value="btnmodal_save" class="btnmodal_save btn btn-primary" onclick="return confirm('Simpan Data ?')">Simpan</button>
            </div>
            </form>
        </div>
    </div>    
</div>


<?php
$this->load->view('template/js2');
?>
<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('click', '.btn_ncmodal', function() {
            var that = $(this);

            var valbutton = $(this).attr("value");
            var namebutton = $(this).attr("name");

            if(valbutton==''){
                alert('Sorry..Failed!!');
            }else{
                if(valbutton=='0'){
                    var judul = 'INPUT DETAIL KETIDAKSESUAIAN';
                    $.ajax({
                    type :"post",
                    url : "<?php echo base_url();?>index.php/tambahan/lain_lain/C_ketidaksesuaian/addreport",
                    data : { id:valbutton},
                          success: function(html_nc){
                             // console.log(html_nc);

                              $("#NCJudul").empty();
                              $("#NCBody").empty();
                              $("#NCBody").html(html_nc);
                              $("#NCJudul").html(judul);
                              $("#NCModal").modal();
                          }
                    });
                }else{
                    if(namebutton=='btn_action'){
                        var judul = 'INPUT DETAIL TINDAKAN';
                        $.ajax({
                        type :"post",
                        url : "<?php echo base_url();?>index.php/tambahan/lain_lain/C_ketidaksesuaian/addaction",
                        data : { id:valbutton},
                              success: function(html_nc){
                                 // console.log(html_nc);
                                  $("#NCJudul").empty();
                                  $("#NCBody").empty();
                                  $("#NCBody").html(html_nc);
                                  $("#NCJudul").html(judul);
                                  $("#NCModal").modal();
                              }
                        });
                    }else if(namebutton=='btn_verify'){
                        var judul = 'INPUT DETAIL VERIFIKASI';
                        $.ajax({
                        type :"post",
                        url : "<?php echo base_url();?>index.php/tambahan/lain_lain/C_ketidaksesuaian/addverifi",
                        data : { id:valbutton},
                              success: function(html_nc){
                                 // console.log(html_nc);
                                  $("#NCJudul").empty();
                                  $("#NCBody").empty();
                                  $("#NCBody").html(html_nc);
                                  $("#NCJudul").html(judul);
                                  $("#NCModal").modal();
                              }
                        });
                    }else if(namebutton=='btn_edit'){
                        var judul = 'INPUT DETAIL KETIDAKSESUAIAN';
                        $.ajax({
                        type :"post",
                        url : "<?php echo base_url();?>index.php/tambahan/lain_lain/C_ketidaksesuaian/addreport",
                        data : { id:valbutton},
                              success: function(html_nc){
                                 // console.log(html_nc);
                                  $("#NCJudul").empty();
                                  $("#NCBody").empty();
                                  $("#NCBody").html(html_nc);
                                  $("#NCJudul").html(judul);
                                  $("#NCModal").modal();
                              }
                        });
                    }else{}
                } 
            }
        });

        $(".btnmodal_save").click(function(e){  // passing down the event
                 var valbutton = $(this).attr("value");
                  $.ajax({
                     url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_ketidaksesuaian/savereport",
                     type: 'post',
                     data: $('#form_modal input, select, textarea').serialize() + "&valbutton=" + valbutton,
                     success: function(pesan){
                        //console.log(pesan);
                          $("#NCModal").modal('hide');
                          var baseurl = "<?php print base_url(); ?>";
                          window.location.href = baseurl+'index.php/tambahan/lain_lain/C_ketidaksesuaian';
                     },
                     error: function(){
                         alert('fail');
                     }
                 });
                 e.preventDefault(); // could also use: return false;
           });

        $(".btnmodal_delete").click(function(e){  // passing down the event
            $.ajax({
                 url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_ketidaksesuaian/delete_report",
                 type: 'post',
                 data: $('#form1 input').serialize(),
                 success: function(pesan){
                    //console.log(pesan);
                      $("#NCModal").modal('hide');
                      var baseurl = "<?php print base_url(); ?>";
                      window.location.href = baseurl+'index.php/tambahan/lain_lain/C_ketidaksesuaian';
                 },
                 error: function(){
                     alert('fail');
                 }
             });
             e.preventDefault(); // could also use: return false;
        });

        $(document).on('change', '#modal_bagian', function() {
            var that = $(this);
            var dtbagian = $(this).val();

            $('#modal_form_kategori').prop('selectedIndex',0);
            $('#modal_form_kategori').find('option:not(:first)').remove();
            $('#modal_form_subkategori').prop('selectedIndex',0);
            $('#modal_form_subkategori').find('option:not(:first)').remove();
            $('#modal_form_nama').val('');
            $('#modal_form_kode').prop('selectedIndex',0);
            $('#modal_form_kode').find('option:not(:first)').remove();
            $('#modal_form_versi').prop('selectedIndex',0);
            $('#modal_form_versi').find('option:not(:first)').remove();
            $('#modal_form_judul').val('');

            if(dtbagian!=''){
                $.ajax({
                     url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_ketidaksesuaian/get_form_kategori",
                     type: 'post',
                     data: { bagian:dtbagian},
                     success: function(html_kategori){
                        //console.log(html_kategori);
                        $("#modal_form_kategori").append(html_kategori);
                     },
                     error: function(){
                         alert('fail');
                     }
                 });
            }
        });

        $(document).on('change', '#modal_form_kategori', function() {
            var that = $(this);
            var dtform_kategori = $(this).val();
            var dtbagian = $('#modal_bagian').val();

            $('#modal_form_subkategori').prop('selectedIndex',0);
            $('#modal_form_subkategori').find('option:not(:first)').remove();
            $('#modal_form_nama').val('');
            $('#modal_form_kode').prop('selectedIndex',0);
            $('#modal_form_kode').find('option:not(:first)').remove();
            $('#modal_form_versi').prop('selectedIndex',0);
            $('#modal_form_versi').find('option:not(:first)').remove();
            $('#modal_form_judul').val('');

            if(dtform_kategori!=''){
                $.ajax({
                     url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_ketidaksesuaian/get_form_subkategori",
                     type: 'post',
                     data: { bagian:dtbagian, form_kategori:dtform_kategori},
                     success: function(html_subkategori){
                        //console.log(html_subkategori);
                        $("#modal_form_subkategori").append(html_subkategori);
                     },
                     error: function(){
                         alert('fail');
                     }
                 });
            }
        });

        $(document).on('change', '#modal_form_subkategori', function() {
            var that = $(this);
            var dtform_subkategori = $(this).val();
            var dtform_kategori = $('#modal_form_kategori').val();
            var dtbagian = $('#modal_bagian').val();

            $('#modal_form_nama').val('');
            $('#modal_form_kode').prop('selectedIndex',0);
            $('#modal_form_kode').find('option:not(:first)').remove();
            $('#modal_form_versi').prop('selectedIndex',0);
            $('#modal_form_versi').find('option:not(:first)').remove();
            $('#modal_form_judul').val('');

            if(dtform_kategori!=''){
                $.ajax({
                     url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_ketidaksesuaian/get_form_kode",
                     type: 'post',
                     data: { bagian:dtbagian, form_kategori:dtform_kategori, form_subkategori:dtform_subkategori},
                     success: function($html_formkode){
                        console.log($html_formkode);
                        $("#modal_form_kode").append($html_formkode);
                     },
                     error: function(){
                         alert('fail');
                     }
                 });
            }
        });

        $(document).on('change', '#modal_form_kode', function() {
            var that = $(this);
            var dtnm = $(this).find('option:selected').text();

            $('#modal_form_nama').val(dtnm);

            var dtform_kode = $(this).val();

            $('#modal_form_versi').prop('selectedIndex',0);
            $('#modal_form_versi').find('option:not(:first)').remove();
            $('#modal_form_judul').val('');

            if(dtform_kode!=''){
                $.ajax({
                     url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_ketidaksesuaian/get_form_versi",
                     type: 'post',
                     data: { form_kode:dtform_kode},
                     success: function($html_formversi){
                        console.log($html_formversi);
                        $("#modal_form_versi").append($html_formversi);
                     },
                     error: function(){
                         alert('fail');
                     }
                 });
            }
        });

        $(document).on('change', '#modal_form_versi', function() {
            var that = $(this);
            var dtversi = $(this).val();

            var dtform_kode = $('#modal_form_kode').val();

            $('#modal_form_judul').val('');

            if(dtversi!=''){
                $.ajax({
                     url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_ketidaksesuaian/get_form_judul",
                     type: 'post',
                     data: { form_kode:dtform_kode, form_versi:dtversi},
                     success: function($html_formjudul){
                        console.log($html_formjudul);
                        $("#modal_form_judul").val($html_formjudul);
                     },
                     error: function(){
                         alert('fail');
                     }
                 });
            }
        });

    });
</script>

<script type="text/javascript">
    function toggle(source) {
        var aInputs = document.getElementsByTagName('input');
        for (var i=0;i<aInputs.length;i++) {
            if (aInputs[i] != source && aInputs[i].className == source.className) {
                aInputs[i].checked = source.checked;
            }
        }
    }
 </script>
<?php
$this->load->view('template/foot2');
?>

