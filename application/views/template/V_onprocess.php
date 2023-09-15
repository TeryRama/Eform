<?php foreach ($dtfrm as $dt_form) {
    $frmjdl       = $dt_form->formjudul;
    $frmefec      = date("d-m-Y", strtotime($dt_form->formefective));
    $frmnm        = $dt_form->formnm;
    $frmkd        = $dt_form->formkd;
    $frmket       = $dt_form->formket;
    $frmvrs       = $dt_form->formversi;
    $createby     = $dt_form->createby;
    $updateby     = $dt_form->updateby;
    $akses_create = $dt_form->form_create;
    $akses_update = $dt_form->form_update;
    $akses_delete = $dt_form->form_delete;
    $akses_excel  = $dt_form->form_excel;
}

if ($frmket == 'In-Progress') { ?>
    <div class="alert alert-warning mb-3" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading">Just Info !!</h4>
        <p class="mb-0"> Eform / Laporan ini Masih Dalam Prosess Development oleh <i><?= $createby; ?> </i> ( <?= $levelusernm; ?> ) !! </p>
    </div>
<?php
} elseif ($frmket == 'Trial') { ?>
    <div class="alert alert-warning mb-3" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading">Just Info !!</h4>
        <p class="mb-0"> Eform / Laporan Ini Masih dalam Prosess Trial !!</p>
    </div>
<?php
} elseif ($frmket == "Modified") { ?>
    <!-- <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Eform Ini Masih Prosess Revisi oleh <i><?= $updateby; ?></i> ( Programmer ) !!</strong>
    </div> -->
    <div class="alert alert-warning mb-3" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading">Just Info !!</h4>
        <p class="mb-0"> Eform / Laporan Ini Masih dalam Prosess Revisi oleh <i><?= $updateby; ?></i> ( <?= $levelusernm; ?> ) !!</p>
    </div>
<?php
} else {
} ?>