<?php $this->load->view('template/headbar'); ?>

<?php foreach ($dtfrm as $dt_form) {
    $frmjdl  = $dt_form->formjudul;
    $frmefec = date("d-m-Y", strtotime($dt_form->formefective));
    $frmkd   = $dt_form->formkd;
    $frmvrs  = $dt_form->formversi;
    $frmnm   = $dt_form->formnm;
}

if ($createtable == "") {
    $dtstart  = "";
    $dtfinish = "";
    $dtmonth_year = "";
    $dttahun = "";
}

if (isset($tipeform)) {
    $vtipeform = $tipeform;
} else {
    $vtipeform = '';
} ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12 mb-5">
            <h4 class="text-uppercase"><?= $Titel ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="text-center mt-5 mb-5">
                    <h5 class="card-title"><?= $frmjdl; ?></h5>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <form action="<?= base_url('laporan/C_laporan/openlap/' . $frmkd . '/' . $frmvrs . '/show' . $vtipeform) ?>" id="form1" name="form1" method="post" role="form" class="form-horizontal" autocomplete="off">
                            <?php
                            switch ($frmkd) {
                                case 'intwtd028':
                                case 'intwtd024':
                                ?>
                                    <div class="form-group row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-1"><strong>Periode</strong></div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" name="dtmonth_year" id="dtmonth_year" class="form-control datepicker_monthandyear maskmonthandyear" value="<?= $dtmonth_year; ?>" style="text-align: center;" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn bg-gradient-primary btn-block" id="btnsimpan">Tampil</button>
                                        </div>
                                    </div>
                                    <?php 
                                    break;
                                default: ?>
                                    <div class="form-group row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-1"><strong>Periode</strong></div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" name="dtstart" id="dtstart" class="form-control datepicker dtstart maskdate" value="<?= $dtstart; ?>" style="text-align: center;" required>
                                                <span class="input-group-append"><strong>&emsp;S/D&emsp;</strong></span>
                                                <input type="text" name="dtfinish" id="dtfinish" class="form-control datepicker dtfinish maskdate" value="<?= $dtfinish; ?>" style="text-align: center;" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn bg-gradient-primary btn-block" id="btnsimpan">Tampil</button>
                                        </div>
                                    </div>
                                    <?php 
                                    break;
                            } ?>
                        </form>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php if (isset($createtable)) {
                                echo $createtable;
                            } ?>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <span class="pull-left">Form Efective : <?= $frmefec; ?></span>
                                <a href="?#"><span class="pull-right"><?= $frmnm . '-' . $frmvrs; ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $this->load->view('template/footbar'); ?>
<?php $this->load->view('template/footbarend'); ?>


<script type="text/javascript">
    jQuery(function($) {
        $('.month').datepicker({
            format: 'mm',
            todayBtn: "linked",
            todayHighlight: 'TRUE',
            autoclose: true,
            orientation: "bottom",
        });
    });

    jQuery(function($) {
        $('.year').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy'

        });
    });
</script>