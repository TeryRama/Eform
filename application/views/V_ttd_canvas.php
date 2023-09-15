<?php
$this->load->view('template/head');
?>
        <!-- DATA TABLES -->
    	
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
<legend class="text-warning">Tambah Tanda Tangan</legend>
</fieldset>
</div>
</div>

    
                <div id="signature-pad" class="m-signature-pad">
                <div class="m-signature-pad--body">
                  <canvas></canvas>
                </div>
                <div class="m-signature-pad--footer">
                  <div class="description">Sign above</div>
                  <button type="button" class="button clear" data-action="clear">Clear</button>
                  <button type="button" class="button save" data-action="save">Save</button>
                </div>
              </div>



</section><!-- /.content -->

<?php
$this->load->view('template/js2');
?>

<!-- DATA TABES SCRIPT -->
<!--<script src="<?php echo base_url('assets/AdminLTE-2.0.5/js/signature_pad.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/js/app.js')?>" type="text/javascript"></script>-->

<!-- page script -->


<?php
$this->load->view('template/foot2');
?>