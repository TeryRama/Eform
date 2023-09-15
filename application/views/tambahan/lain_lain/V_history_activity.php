
<?php
date_default_timezone_set("Asia/Jakarta");
?>

<?php
$this->load->view('template/head');
?>
<link href="<?php echo base_url()?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/TableTools-2.2.4/css/dataTables.tableTools.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/TableTools-2.2.4/css/dataTables.tableTools.min.css') ?>" rel="stylesheet" type="text/css" />
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
                        <br/>
                        <h3><b><?php echo $this->config->item("nama_perusahaan"); ?></b><br/>
                        <h2 class="box-title" ><b><?php echo 'HISTORY ACTIVITY APLIKASI E-Form WHS';?> </b></h2></h3>
                    </div>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <br/>

                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <form action="<?php echo base_url('tambahan/lain_lain/C_history_activity/get_history_by_date') ?>" id="form1" name="form1" method="post" role="form" class="form-horizontal">
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
                                <div class="row">
                                    <label for="date_from" class="col-sm-3 control-label" style="text-align:left;">Form Lab</label>
                                     <div class="form-group col-sm-3">
                                            <select name="formjnsnm" id="formjnsnm" class="form-control">
                                                <option value="">- pilih -</option>
                                                <option value="Form Lab Kimia" <?php if($formjnsnm=='Form Lab Kimia'){echo 'selected';}?>>Form Lab Kimia</option>
                                                <option value="Form Lab Kimia & Mikro" <?php if($formjnsnm=='Form Lab Kimia & Mikro'){echo 'selected';}?>>Form Lab Kimia & Mikro</option>
                                                <option value="Form Lab Kimia, Mikro & Monitoring" <?php if($formjnsnm=='Form Lab Kimia, Mikro & Monitoring'){echo 'selected';}?>>Form Lab Kimia, Mikro & Monitoring</option>
                                                <option value="Form Lab Mikro" <?php if($formjnsnm=='Form Lab Mikro'){echo 'selected';}?>>Form Lab Mikro</option>
                                                <option value="Form Lab Monitoring" <?php if($formjnsnm=='Form Lab Monitoring'){echo 'selected';}?>>Form Lab Monitoring</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                    <div class="row">
                        <form class="form-horizontal" role="form1" action="#" name="form1" id="form1" method="post">
                        <div class="col-lg-12">
                            <p class="text-warning"><i>Note : Data History Activity yang ditampilkan merupakan 100 record perubahan terakhir</i></p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped sticky-header" id="example1">
                                    <thead class="bg-primary">
                                        <tr>
                                           <th colspan="13">UPDATE ACTION</th>
                                        </tr>
                                        <tr>
                                           <th><input type="checkbox" class="checkall" onClick="toggle(this)"/></th>
                                           <th>No</th>
                                           <th>Tanggal</th>
                                           <th>Jam</th>
                                           <th>Komputer</th>
                                           <th>User</th>
                                           <th>Kode Form</th>
                                           <th>Jenis Form</th>
                                           <th>Kategori Form</th>
                                           <th>Sub Kategori Form</th>
                                           <th>Data Lama</th>
                                           <th>Data Baru</th>
                                           <th>Lihat Laporan</th>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($list_history)){ 
                                            $no=0;
                                            foreach($list_history as $list_history_row){$no++;
                                                $old = implode(", ",array_unique(explode(',', str_replace(' ', '', $list_history_row->data_old))));
                                                $new = implode(", ",array_unique(explode(',', str_replace(' ', '', $list_history_row->data_new))));
                                            ?>
                                        <tr>
                                            <td><input name="chk[]" type="checkbox" class="checkall" value="<?php echo $list_history_row->id_header.'//'.$list_history_row->id_detail;?>" <?php if(isset($status_au)){if($status_au=='yes'){echo 'disabled="disabled"';}}?>/></td>
                                            <td><?php echo $no;?>
                                                <input name="post_no[]" type="hidden" class="post_no" value="<?php echo $no;?>"/>
                                            </td>
                                            <td><?php echo $list_history_row->action_date;?>
                                                <input name="post_tanggal[]" type="hidden" class="post_tanggal" value="<?php echo $list_history_row->action_date;?>"/>
                                            </td>
                                            <td><?php echo $list_history_row->action_time;?>
                                                <input name="post_jam[]" type="hidden" class="post_jam" value="<?php echo $list_history_row->action_time;?>"/>
                                            </td>
                                            <td><?php echo $list_history_row->action_comp;?>
                                                <input name="post_komputer[]" type="hidden" class="post_komputer" value="<?php echo $list_history_row->action_comp;?>"/>
                                            </td>
                                            <td><?php echo $list_history_row->action_by;?>
                                                <input name="post_user[]" type="hidden" class="post_user" value="<?php if(isset($status_au)){if($status_au=='yes'){echo str_replace('2', '', $list_history_row->action_by);}else{echo $list_history_row->action_by;}}?>"/>
                                            </td>
                                            <td><?php echo rtrim(chunk_split(strtoupper(substr($list_history_row->table_name,6,9)),3,'-'),'-');?>
                                                <input name="post_form_kode[]" type="hidden" class="post_form_kode" value="<?php echo rtrim(chunk_split(strtoupper(substr($list_history_row->table_name,6,9)),3,'-'),'-');?>"/>
                                            </td>
                                            <td><?php echo $list_history_row->formjnsnm;?>
                                                <input name="post_form_jenis[]" type="hidden" class="post_form_jenis" value="<?php echo $list_history_row->formjnsnm;?>"/>
                                            </td>
                                            <td><?php echo $list_history_row->formkategorinm;?>
                                                <input name="post_form_kategori[]" type="hidden" class="post_form_kategori" value="<?php echo $list_history_row->formkategorinm;?>"/>
                                            </td>
                                            <td><?php echo $list_history_row->formkategori2nm;?>
                                                <input name="post_form_subkategori[]" type="hidden" class="post_form_subkategori" value="<?php echo $list_history_row->formkategori2nm;?>"/>
                                            </td>
                                            <td><?php echo $old;?>
                                                <input name="post_data_old[]" type="hidden" class="post_data_old" value="<?php echo $old;?>"/>
                                            </td>
                                            <td><?php echo $new;?>
                                                <input name="post_data_new[]" type="hidden" class="post_data_new" value="<?php echo $new;?>"/>
                                            </td>
                                            <td><button type="button" class="open_data btn btn-info btn-sm" id="open_data" value="<?php echo rtrim(chunk_split(strtoupper(substr($list_history_row->table_name,6,9)),3,'-'),'-').'//'.$list_history_row->id_header.'//'.$list_history_row->id_detail.'//';?>"><span class="glyphicon glyphicon-search"></span></button></td>
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
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot class="bg-primary">
                                        <tr>
                                            <td colspan="13"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            </div>
                        </form>
                        
                    </div>

                    <br/>
                    <div class="row">
                        <form class="form-horizontal" role="form1" action="#" name="form1" id="form1" method="post">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped sticky-header" id="example1">
                                    <thead class="bg-primary">
                                        <tr>
                                           <th colspan="11">DELETE ACTION</th>
                                        </tr>
                                        <tr>
                                           <th><input type="checkbox" class="checkall2" onClick="toggle(this)"/></th>
                                           <th>No</th>
                                           <th>Tanggal</th>
                                           <th>Jam</th>
                                           <th>Komputer</th>
                                           <th>User</th>
                                           <th>Kode Form</th>
                                           <th>Jenis Form</th>
                                           <th>Kategori Form</th>
                                           <th>Sub Kategori Form</th>
                                           <th>Detail Data</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($list_history_delete)){ 
                                            $no=0;
                                            foreach($list_history_delete as $list_history_delete_row){$no++;
                                            ?>
                                        <tr>
                                            <td><input name="chk[]" type="checkbox" class="checkall2" value="" <?php if(isset($status_au)){if($status_au=='yes'){echo 'disabled="disabled"';}}?>/></td>
                                            <td><?php echo $no;?>
                                                 <input name="delete_no[]" type="hidden" class="delete_no" value="<?php echo $no;?>"/>
                                            </td>
                                            <td><?php echo $list_history_delete_row->action_date;?>
                                                <input name="delete_tanggal[]" type="hidden" class="delete_tanggal" value="<?php echo $list_history_delete_row->action_date;?>"/>
                                            </td>
                                            <td><?php echo $list_history_delete_row->action_time;?>
                                                <input name="delete_jam[]" type="hidden" class="delete_jam" value="<?php echo $list_history_delete_row->action_time;?>"/>
                                            </td>
                                            <td><?php echo $list_history_delete_row->action_comp;?>
                                                <input name="delete_komputer[]" type="hidden" class="delete_komputer" value="<?php echo $list_history_delete_row->action_comp;?>"/>
                                            </td>
                                            <td><?php echo $list_history_delete_row->action_by;?>
                                                <input name="delete_user[]" type="hidden" class="delete_user" value="<?php echo $list_history_delete_row->action_by;?>"/>
                                            </td>
                                            <td><?php echo rtrim(chunk_split(strtoupper(substr($list_history_delete_row->table_name,6,9)),3,'-'),'-');?>
                                                <input name="delete_form_kode[]" type="hidden" class="delete_form_kode" value="<?php echo rtrim(chunk_split(strtoupper(substr($list_history_delete_row->table_name,6,9)),3,'-'),'-');?>"/>
                                            </td>
                                            <td><?php echo $list_history_delete_row->formjnsnm;?>
                                                <input name="delete_form_jenis[]" type="hidden" class="delete_form_jenis" value="<?php echo $list_history_delete_row->formjnsnm;?>"/>
                                            </td>
                                            <td><?php echo $list_history_delete_row->formkategorinm;?>
                                                <input name="delete_form_kategori[]" type="hidden" class="delete_form_kategori" value="<?php echo $list_history_delete_row->formkategorinm;?>"/>
                                            </td>
                                            <td><?php echo $list_history_delete_row->formkategori2nm;?>
                                                <input name="delete_form_subkategori[]" type="hidden" class="delete_form_subkategori" value="<?php echo $list_history_delete_row->formkategori2nm;?>"/>
                                            </td>
                                            <td><?php echo str_replace(',', ', ', $list_history_delete_row->data_old);?>
                                                <input name="delete_data_old[]" type="hidden" class="delete_data_old" value="<?php echo str_replace(',', ', ', $list_history_delete_row->data_old);?>"/>
                                            </td>
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
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot class="bg-primary">
                                        <tr>
                                            <td colspan="11"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            </div>
                        </form>
                        
                    </div>
                    <br/>
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


<?php
$this->load->view('template/js2');
?>

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url()?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script type="text/javascript" charset="utf-8">
    $(document).ready( function () {
            $('#example1,#example2').dataTable( {
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": {
                            "sSwfPath": "<?php echo base_url()?>assets/TableTools-2.2.4/swf/copy_csv_xls_pdf.swf"
                    }
            });

            $(document).on("change", ".checkall", function() {
                $('.checkall').not(this).prop('checked', false);
                //var historyArray = [];
                  if($(this).is(':checked'))
                  {
                    var that = $(this);
                    var data_id = that.val();
                    var arr_id = data_id.split('//');
                    var post_headerid = arr_id[0];
                    var post_detail_id = arr_id[1];

                    var col_post_no                 = that.parent().next().find('.post_no');
                    var col_post_tanggal            = col_post_no.parent().next().find('.post_tanggal');
                    var col_post_jam                = col_post_tanggal.parent().next().find('.post_jam');
                    var col_post_komputer           = col_post_jam.parent().next().find('.post_komputer');
                    var col_post_user               = col_post_komputer.parent().next().find('.post_user');
                    var col_post_form_kode          = col_post_user.parent().next().find('.post_form_kode');
                    var col_post_form_jenis         = col_post_form_kode.parent().next().find('.post_form_jenis');
                    var col_post_form_kategori      = col_post_form_jenis.parent().next().find('.post_form_kategori');
                    var col_post_form_subkategori   = col_post_form_kategori.parent().next().find('.post_form_subkategori');
                    var col_post_data_old           = col_post_form_subkategori.parent().next().find('.post_data_old');
                    var col_post_data_new           = col_post_data_old.parent().next().find('.post_data_new');

                    var post_no                 = col_post_no.val();
                    var post_tanggal            = col_post_tanggal.val();
                    var post_jam                = col_post_jam.val();
                    var post_komputer           = col_post_komputer.val();
                    var post_user               = col_post_user.val();
                    var post_form_kode          = col_post_form_kode.val();
                    var post_form_jenis         = col_post_form_jenis.val();
                    var post_form_kategori      = col_post_form_kategori.val();
                    var post_form_subkategori   = col_post_form_subkategori.val();
                    var post_data_old           = col_post_data_old.val();
                    var post_data_new           = col_post_data_new.val();

                    //console.log(post_headerid+'//'+post_detail_id+'//'+post_no+'//'+post_tanggal+'//'+post_jam+'//'+post_komputer+'//'+post_user+'//'+post_form_kode+'//'+post_form_jenis+'//'+post_form_kategori+'//'+post_form_subkategori+'//'+post_data_old+'//'+post_data_new);

                    $.ajax({
                          type :"post",
                          url : "<?php echo base_url();?>index.php/tambahan/lain_lain/C_history_activity/move_history",
                          data : { post_no:post_no, post_tanggal:post_tanggal,post_jam:post_jam,post_komputer:post_komputer,post_user:post_user,post_form_kode:post_form_kode,post_form_jenis:post_form_jenis,post_form_kategori:post_form_kategori,post_form_subkategori:post_form_subkategori,post_data_old:post_data_old,post_data_new:post_data_new,post_headerid:post_headerid,post_detail_id:post_detail_id },
                          success: function(move){
                            //console.log(move);
                          },
                           error: function(){
                               alert("Fail")
                           }
                      });
                    //console.log(historyArray);
                  }
            });

            $(document).on("change", ".checkall2", function() {
                $('.checkall2').not(this).prop('checked', false);
                //var historyArray = [];
                  if($(this).is(':checked'))
                  {
                    var that = $(this);

                    var col_delete_no                 = that.parent().next().find('.delete_no');
                    var col_delete_tanggal            = col_delete_no.parent().next().find('.delete_tanggal');
                    var col_delete_jam                = col_delete_tanggal.parent().next().find('.delete_jam');
                    var col_delete_komputer           = col_delete_jam.parent().next().find('.delete_komputer');
                    var col_delete_user               = col_delete_komputer.parent().next().find('.delete_user');
                    var col_delete_form_kode          = col_delete_user.parent().next().find('.delete_form_kode');
                    var col_delete_form_jenis         = col_delete_form_kode.parent().next().find('.delete_form_jenis');
                    var col_delete_form_kategori      = col_delete_form_jenis.parent().next().find('.delete_form_kategori');
                    var col_delete_form_subkategori   = col_delete_form_kategori.parent().next().find('.delete_form_subkategori');
                    var col_delete_data_old           = col_delete_form_subkategori.parent().next().find('.delete_data_old');

                    var delete_no                 = col_delete_no.val();
                    var delete_tanggal            = col_delete_tanggal.val();
                    var delete_jam                = col_delete_jam.val();
                    var delete_komputer           = col_delete_komputer.val();
                    var delete_user               = col_delete_user.val();
                    var delete_form_kode          = col_delete_form_kode.val();
                    var delete_form_jenis         = col_delete_form_jenis.val();
                    var delete_form_kategori      = col_delete_form_kategori.val();
                    var delete_form_subkategori   = col_delete_form_subkategori.val();
                    var delete_data_old           = col_delete_data_old.val();

                    //console.log(delete_no+'//'+delete_tanggal+'//'+delete_jam+'//'+delete_komputer+'//'+delete_user+'//'+delete_form_kode+'//'+delete_form_jenis+'//'+delete_form_kategori+'//'+delete_form_subkategori+'//'+delete_data_old);

                    $.ajax({
                          type :"post",
                          url : "<?php echo base_url();?>index.php/tambahan/lain_lain/C_history_activity/move_history_delete",
                          data : { delete_no:delete_no, delete_tanggal:delete_tanggal,delete_jam:delete_jam,delete_komputer:delete_komputer,delete_user:delete_user,delete_form_kode:delete_form_kode,delete_form_jenis:delete_form_jenis,delete_form_kategori:delete_form_kategori,delete_form_subkategori:delete_form_subkategori,delete_data_old:delete_data_old },
                          success: function(move){
                            //console.log(move);
                          },
                           error: function(){
                               alert("Fail")
                           }
                      });
                    //console.log(historyArray);
                  }
            });

            $(document).on('click', '.open_data', function() {
                var that = $(this);

                var valbutton = $(this).attr("value");
                

                if(valbutton==''){
                    alert('Maaf, Data Tidak Tersedia!!');
                }else{
                    $.ajax({
                    type :"post",
                    url : "<?php echo base_url();?>index.php/tambahan/lain_lain/C_history_activity/open_data",
                    data : { valbutton : valbutton},
                          success: function(show){
                            //console.log(show);
                            var feedback   = show.split("//");
                            var dthdr      = feedback[1];
                            var dtform_kd  = feedback[0];
                            var dtform_vrs = feedback[2];
                            var baseurl = "<?php print base_url(); ?>";
                            //window.location.href = baseurl+'index.php/form_input/C_form'+dtform_kd+'_'+dtform_vrs+'/form/'+dtform_kd+'/'+dtform_vrs+'/dtopen/'+dthdr;
                            var test = baseurl+'index.php/form_input/C_form'+dtform_kd+'_'+dtform_vrs+'/form/'+dtform_kd+'/'+dtform_vrs+'/dtopen/'+dthdr;
                            window.open(test);
                          }
                    });
                }
        });
    } );
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

