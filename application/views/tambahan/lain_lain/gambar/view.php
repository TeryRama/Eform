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
            <legend class="text-warning">DATA INTERPOLASI</legend>
        </fieldset>
    </div>
</div>

<br>
  <div class="row">
    <div class="col-lg-12">
        <a type="button" href="<?php echo base_url('tambahan/lain_lain/C_crosscheck/form/add') ?>" class="btn btn-primary" role="button">Tambah Data Baru</a></br></br>
        <div class="table-responsive">
          <table id="table" class="table table-bordered table-hover table-striped">
            <thead class="bg-primary">
              <tr>
                <th><b>No</b></th>
                <th><b>Photo<b></th>
                <th><b>Caption</b></th>
                <th><b>Form Code</b></th>
                <th><b>File Size</b></th>
                <th><b>File Type</b></th>
                <th><b>Ubah</b></th>
                <th><b>Hapus</b></th>
              </tr>
            </thead>
            <tbody>
              <?php if(empty($query)) { ?>
                <tr>
                    <td colspan="8">
                        <?php 
                           echo "Tidak ada data!!"
                        ?>
                    </td>
                </tr>
              <?php 
                    } else {
                      $no=0;
                      foreach($query->result_array() as $row) {
                         $no++;?>
                            <tr>
                            <td><?php echo $no;?></td>
                                    <td><?php echo $row['photos'] ?></td>
                                    <td><?php echo $row['caption'] ?></td>
                        <td><?php echo $row['form_kode'] ?></td>
                        <td><?php echo $row['ukuran_file'] ?></td>
                        <td><?php echo $row['tipe_file'] ?></td>
                             <td align="center">
                                 <a href="<?php echo base_url('tambahan/lain_lain/C_crosscheck/form/edit/'.$row['id_photo']) ?>" target="" alt="Edit Data">
                                       <span class="glyphicon glyphicon-pencil" style="font-size:13px; color:black"></span>
                                   </a>
                             </td>
                             <td align="center">
                                 <a href="<?php echo base_url('tambahan/lain_lain/C_crosscheck/form/delete/'.$row['id_photo']) ?>" target="_self" alt="Delete Data" onClick="return confirm('ANDA YAKIN INGIN MENGHAPUS DATA INI ?')">
                                       <span class="glyphicon glyphicon-trash" style="font-size:13px; color:black"></span>
                                   </a>
                             </td>
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
        $("#table").DataTable();
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
