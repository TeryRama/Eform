<?php
$this->load->view('template/head');
?>
        <!-- DATA TABLES -->
    	<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
	<!-- Theme style -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

<?php
$this->load->view('template/topbar2');
?>

<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">


<div class="row">
    <div class="col-lg-12">
	<fieldset>
<legend class="text-warning">TANDA TANGAN</legend>
</fieldset>
</div>
</div>

    <div class="row">
        <div class="col-lg-12">
            <a type="button" href="<?php echo base_url('C_tandatangan/get_canvas_ttd') ?>" class="btn btn-primary" role="button">Tambah Tanda Tangan</a>
        </div>
    </div>
    <br>
     <div class="row">
        <div class="col-lg-12">
          <div class="table-responsive">
             <table id="example1" class="table table-bordered table-hover table-striped">
         <thead class="bg-primary">
      <tr>
        <th><b>No</b></th>
        <th><b>Nama</b></th>
        <th><b>Dept / Bagian</b></th>
        <th><b>User Level</b></th>
        <th><b>Tanda Tangan</b></th>
        <th colspan="2">Aksi</th>
      </tr></thead>
      <tbody>
          <?php if(empty($dt_ttd)){ ?>
          <tr>
                <td></td>
                <td style="text-align:left"></td>
                <td style="text-align:left"></td>
                <td style="text-align:left"></td>
                <td style="text-align:left"></td>
                <td style="text-align:center"></td>
                <td style="text-align:center"></td>
           </tr>
          <?php }else{
              $no=0;
                foreach($dt_ttd as $dt_ttd_row){ $no++;?>
           <tr>
                <td><?php echo $no;?></td>
                <td style="text-align:left"><?php echo $dt_ttd_row->nmlengkap; ?></td>
                <td style="text-align:left"><?php echo $dt_ttd_row->bagnm; ?></td>
                <td style="text-align:left"><?php echo $dt_ttd_row->levelusernm; ?></td>
                <td style="text-align:left"><?php echo $dt_ttd_row->ttd; ?></td>
                <td style="text-align:center"><a href="<?php echo base_url('master/C_tandatangan/form/edit/'.$dt_ttd_row->ttd_id) ?>" target="_self" alt="Edit Data"><span class="glyphicon glyphicon-pencil" style="font-size:13px; color:black"></span></a></td>
                <td style="text-align:center"><a href="<?php echo base_url('master/C_tandatangan/form/hapus/'.$dt_ttd_row->ttd_id) ?>" target="_self" alt="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="glyphicon glyphicon-trash" style="font-size:13px; color:black"></span></a></td>
           </tr>
          <?php }} ?>
      </tbody>
       </table>
        </div>
	   </div>
	   </div>


</section><!-- /.content -->

<?php
$this->load->view('template/js2');
?>

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>

<!-- page script -->

<script>
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

<?php
$this->load->view('template/foot2');
?>