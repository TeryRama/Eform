
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
                                           <th>No</th>
                                           <th>Tanggal</th>
                                           <th>Jam</th>
                                           <th>Komputer</th>
                                           <th>User</th>
                                           <th>Bagian</th>
                                           <th>Kode Form</th>
                                           <th>Versi Form</th>
                                           <th>Parameter</th>
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
                                            ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $list_history_row->history_date;?></td>
                                            <td><?php echo $list_history_row->history_time;?></td>
                                            <td><?php echo $list_history_row->history_comp;?></td>
                                            <td><?php echo $list_history_row->history_by;?></td>
                                            <td><?php echo $list_history_row->history_bagnm;?></td>
                                            <td><?php echo strtoupper(implode('-', str_split($list_history_row->history_formkd,3)));?></td>
                                            <td><?php echo $list_history_row->history_formvrs;?></td>
                                            <td><?php echo str_replace("[]","",$list_history_row->history_param);?></td>
                                            <td><?php echo $list_history_row->history_data_old;?></td>
                                            <td><?php echo $list_history_row->history_data_new;?></td>
                                            <td></td>
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
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot class="bg-primary">
                                        <tr>
                                            <td colspan="20"></td>
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
            $('#example1').dataTable( {
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": {
                            "sSwfPath": "<?php echo base_url()?>assets/TableTools-2.2.4/swf/copy_csv_xls_pdf.swf"
                    }
            } );
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

