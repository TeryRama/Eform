
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
                        <h2 class="box-title" ><b><?php echo 'SCHEDULE BUYER VISIT AND AUDIT';?> </b></h2></h3>
                    </div>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <br/>

                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <form action="<?php echo base_url('tambahan/lain_lain/C_jadwal_audit/get_by_date') ?>" id="form1" name="form1" method="post" role="form" class="form-horizontal">
                            <div class="box" style="padding: 15px; font-size: 12px; border: solid 1px;">
                                <div class="row">
                                    <label for="date_from" class="col-sm-3 control-label" style="text-align:left;">Periode</label>
                                     <div class="form-group col-sm-3">
                                            <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd">
                                    <input name="date_from" type="text" id="date_from" value="<?php echo $date_from;?>" class="date_from form-control" required>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                     <label for="date_to" class="col-sm-1 control-label" style="text-align:left;">s/d</label>
                                    <div class="form-group col-sm-3">
                                            <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd">
                                    <input name="date_to" type="text" id="date_to" value="<?php echo $date_to;?>" class="date_to form-control" required>
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
                              <button type="button" name="btn_modal" value="0" class="btn_ncmodal btn btn-info">Add Schedule</button>
                              <button type="button" name="btnmodal_delete" value="0" class="btnmodal_delete btn btn-danger" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI... ?')">Delete Schedule</button>
                            </div>
                              <a href="<?php echo base_url('export_excel/C_export_toexcel_jadwal_audit/exportxls/'.$date_from.'/'.$date_to) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><span class="btn btn-success glyphicon glyphicon-export"></span></a>
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
                                           <th><input type="checkbox" class="checkall" onClick="toggle(this)"/></th>
                                           <th>No</th>
                                           <th>From<br/>Date</th>
                                           <th>To<br/>Date</th>
                                           <th>Guest</th>
                                           <th>Remarks</th>
                                           <th>Create Info</th>
                                           <th>Update Info</th>
                                           <th>Edit</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($jadwal_audit)){ 
                                            $no=0;
                                            foreach($jadwal_audit as $jadwal_audit_row){$no++;
                                            ?>
                                        <tr>
                                            <td><?php if($jadwal_audit_row->jadwal_from >= date('Y-m-d')){?><input name="chk[]" type="checkbox" class="checkall" value="<?php echo $jadwal_audit_row->jadwal_id;?>"/><?php } ?></td>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $jadwal_audit_row->jadwal_from;?></td>
                                            <td><?php echo $jadwal_audit_row->jadwal_to;?></td>
                                            <td><?php echo $jadwal_audit_row->jadwal_guest;?></td>
                                            <td><?php echo $jadwal_audit_row->jadwal_remarks;?></td>
                                            <td><?php echo $jadwal_audit_row->create_by; echo '<br/>'; echo $jadwal_audit_row->create_date.' '.$jadwal_audit_row->create_time; echo '<br/>'; echo  $jadwal_audit_row->create_comp;?></td>
                                            <td><?php echo $jadwal_audit_row->update_by; echo '<br/>'; echo $jadwal_audit_row->update_date.' '.$jadwal_audit_row->update_time; echo '<br/>'; echo  $jadwal_audit_row->update_comp;?></td>
                                            <td><?php if($jadwal_audit_row->jadwal_from >= date('Y-m-d')){?>
                                                <button type="button" name="btn_edit" value="<?php echo $jadwal_audit_row->jadwal_id;?>" class="btn_ncmodal btn btn-primary"><span class="glyphicon glyphicon-pencil" ></span></button> <?php } ?></td>
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
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot class="bg-primary">
                                        <tr>
                                            <td colspan="9"></td>
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
                          <a href="<?php //echo base_url('export_excel/C_export_toexcel_jadwal_audit/exportxls/'.$date_from.'/'.$date_to) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><span class="btn btn-success glyphicon glyphicon-export"></span></a>
                        </div> -->
                    </div>
                    <br>
                    <div class="panel-footer">
                        <div class="clearfix">
                          <span class="pull-left"></span>
                          <a href="#"><span class="pull-right"></span></a>
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
            <form class="form-horizontal" role="form" action="#" name="form_modal" id="form_modal" method="post">
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
                    var judul = 'INPUT DETAIL SCHEDULE BUYER VISIT AND AUDIT';
                    $.ajax({
                    type :"post",
                    url : "<?php echo base_url();?>index.php/tambahan/lain_lain/C_jadwal_audit/addjadwal",
                    data : { id:valbutton},
                          success: function(html_jadwal){
                             // console.log(html_jadwal);

                              $("#NCJudul").empty();
                              $("#NCBody").empty();
                              $("#NCBody").html(html_jadwal);
                              $("#NCJudul").html(judul);
                              $("#NCModal").modal();
                          }
                    });
                }else{
                     if(namebutton=='btn_edit'){
                        var judul = 'INPUT DETAIL SCHEDULE BUYER VISIT AND AUDIT';
                        $.ajax({
                        type :"post",
                        url : "<?php echo base_url();?>index.php/tambahan/lain_lain/C_jadwal_audit/addjadwal",
                        data : { id:valbutton},
                              success: function(html_jadwal){
                                 // console.log(html_jadwal);
                                  $("#NCJudul").empty();
                                  $("#NCBody").empty();
                                  $("#NCBody").html(html_jadwal);
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
                 if($('.modal_jadwal_from').val()=='' || $('.modal_jadwal_to').val()==''){
                    alert('Maaf Kolom From Date dan To Date Tidak Boleh Kosong..!!');
                 }else{
                   $.ajax({
                       url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_jadwal_audit/savejadwal",
                       type: 'post',
                       data: $('#form_modal input, select, textarea').serialize() + "&valbutton=" + valbutton,
                       success: function(pesan){
                            $("#NCModal").modal('hide');
                            var baseurl = "<?php print base_url(); ?>";
                            window.location.href = baseurl+'index.php/tambahan/lain_lain/C_jadwal_audit';
                       },
                       error: function(){
                           alert('fail');
                       }
                   });
                   e.preventDefault(); // could also use: return false;
                 }
                  
           });

        $(".btnmodal_delete").click(function(e){  // passing down the event
            $.ajax({
                 url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_jadwal_audit/delete_jadwal",
                 type: 'post',
                 data: $('#form1 input').serialize(),
                 success: function(pesan){
                    //console.log(pesan);
                      $("#NCModal").modal('hide');
                      var baseurl = "<?php print base_url(); ?>";
                      window.location.href = baseurl+'index.php/tambahan/lain_lain/C_jadwal_audit';
                 },
                 error: function(){
                     alert('fail');
                 }
             });
             e.preventDefault(); // could also use: return false;
        });

        $(document).on('change', '.modal_jadwal_from', function() {
            var that = $(this);
            var that_val = that.val();
            if(that_val.trim()!=''){
                var regPattern = /^(19|20)\d\d(-)(0[1-9]|1[012])(-)(0[1-9]|[12][0-9]|3[01])$/;
                var checkArray = that_val.match(regPattern);
                if (checkArray == null){
                       alert('Maaf Format Tanggal Yang Anda Input Tidak Sesuai, Format Tanggal Pembuatan Laporan : YYYY-MM-DD');
                       that.val('');
                       that.focus();
                }else{
                    that.val(that_val);
                }
            }
        });

        $(document).on('change', '.modal_jadwal_to', function() {
            var that = $(this);
            var that_val = that.val();
            if(that_val.trim()!=''){
                var regPattern = /^(19|20)\d\d(-)(0[1-9]|1[012])(-)(0[1-9]|[12][0-9]|3[01])$/;
                var checkArray = that_val.match(regPattern);
                if (checkArray == null){
                       alert('Maaf Format Tanggal Yang Anda Input Tidak Sesuai, Format Tanggal Pembuatan Laporan : YYYY-MM-DD');
                       that.val('');
                       that.focus();
                }else{
                    that.val(that_val);
                }
            }
        });

        $(document).on('change', '.date_from', function() {
            var that = $(this);
            var that_val = that.val();
            if(that_val.trim()!=''){
                var regPattern = /^(19|20)\d\d(-)(0[1-9]|1[012])(-)(0[1-9]|[12][0-9]|3[01])$/;
                var checkArray = that_val.match(regPattern);
                if (checkArray == null){
                       alert('Maaf Format Tanggal Yang Anda Input Tidak Sesuai, Format Tanggal Pembuatan Laporan : YYYY-MM-DD');
                       that.val('');
                       that.focus();
                }else{
                    that.val(that_val);
                }
            }
        });

        $(document).on('change', '.date_to', function() {
            var that = $(this);
            var that_val = that.val();
            if(that_val.trim()!=''){
                var regPattern = /^(19|20)\d\d(-)(0[1-9]|1[012])(-)(0[1-9]|[12][0-9]|3[01])$/;
                var checkArray = that_val.match(regPattern);
                if (checkArray == null){
                       alert('Maaf Format Tanggal Yang Anda Input Tidak Sesuai, Format Tanggal Pembuatan Laporan : YYYY-MM-DD');
                       that.val('');
                       that.focus();
                }else{
                    that.val(that_val);
                }
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

