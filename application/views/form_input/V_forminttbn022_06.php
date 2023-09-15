<?php $this->load->view('template/headbar'); ?>

<?php foreach ($dtfrm as $dt_form) {
    $frmjdl       = $dt_form->formjudul;
    $frmefec      = date("d-m-Y", strtotime($dt_form->formefective));
    $frmnm        = $dt_form->formnm;
    $frmkd        = $dt_form->formkd;
    $frmket       = $dt_form->formket;
    $frmvrs       = $dt_form->formversi;
    $createby     = $dt_form->createby;
    $akses_create = $dt_form->form_create;
    $akses_update = $dt_form->form_update;
    $akses_delete = $dt_form->form_delete;
    $akses_excel  = $dt_form->form_excel;
}

if (isset($dtheader)) {
    $aksi = "dtupdate";
    foreach ($dtheader as $row) {
        $headerid        = $row->headerid;
        $comment         = $row->comment;
        $comment_by      = $row->comment_by;
        $comment_time    = $row->comment_time;
        $comment_date    = date("d-m-Y", strtotime($row->comment_date));
        $create_date     = date("d-m-Y", strtotime($row->create_date));
        $docno           = $row->docno;
        $notification    = $row->notification;
        $shift_1         = $row->shift_1;
        $shift_2         = $row->shift_2;
        $shift_3         = $row->shift_3;
        $total_usedwater = $row->total_usedwater;
    }
} else if (isset($message)) {
    $aksi        = "dtsave";
    $create_date = $create_date;
    $docno       = $docno;
} else {
    $aksi            = "dtsave";
    $create_date     = date("d-m-Y", strtotime($dtcreate_date));
    $docno           = '';
    $notification    = '';
    $shift_1         = '';
    $shift_2         = '';
    $shift_3         = '';
    $total_usedwater = '';

    $a1_time            = '';
    $a1_alkalinity      = '';
    $a1_ph              = '';
    $a1_conductivity    = '';
    $a1_thardness       = '';
    $a1_dissolvedoxygen = '';
    $a1_silica          = '';
    $a1_fe              = '';
    $a2_time            = '';
    $a2_alkalinityp     = '';
    $a2_alkalinitym     = '';
    $a2_ph              = '';
    $a2_conductivity    = '';
    $a2_ion             = '';
    $a2_silica          = '';
    $a3_time            = '';
    $a3_ph              = '';
    $a3_conductivity    = '';
    $a3_silica          = '';
    $a3_fe              = '';
    $a4_time            = '';
    $a4_ph              = '';
    $a4_conductivity    = '';
    $a4_silica          = '';
    $a4_fe              = '';

    $b1_time            = '';
    $b1_alkalinity      = '';
    $b1_ph              = '';
    $b1_conductivity    = '';
    $b1_thardness       = '';
    $b1_dissolvedoxygen = '';
    $b1_silica          = '';
    $b1_fe              = '';
    $b2_time            = '';
    $b2_alkalinityp     = '';
    $b2_alkalinitym     = '';
    $b2_ph              = '';
    $b2_conductivity    = '';
    $b2_ion             = '';
    $b2_silica          = '';
    $b3_time            = '';
    $b3_ph              = '';
    $b3_conductivity    = '';
    $b3_silica          = '';
    $b3_fe              = '';
    $b4_time            = '';
    $b4_ph              = '';
    $b4_conductivity    = '';
    $b4_silica          = '';
    $b4_fe              = '';

    $c1_time            = '';
    $c1_alkalinity      = '';
    $c1_ph              = '';
    $c1_conductivity    = '';
    $c1_thardness       = '';
    $c1_dissolvedoxygen = '';
    $c1_silica          = '';
    $c1_fe              = '';
    $c2_time            = '';
    $c2_alkalinityp     = '';
    $c2_alkalinitym     = '';
    $c2_ph              = '';
    $c2_conductivity    = '';
    $c2_ion             = '';
    $c2_silica          = '';
    $c3_time            = '';
    $c3_ph              = '';
    $c3_conductivity    = '';
    $c3_silica          = '';
    $c3_fe              = '';
    $c4_time            = '';
    $c4_ph              = '';
    $c4_conductivity    = '';
    $c4_silica          = '';
    $c4_fe              = '';
    $c5_time            = '';
    $c5_conductivity    = '';
    $c5_thardness       = '';
    $c5_ph              = '';

    $d1_time            = '';
    $d1_thardness       = '';
    $d1_ph              = '';
    $d1_conductivity    = '';
    $d1_dissolvedoxygen = '';
    $d1_silica          = '';
    $d1_fe              = '';
    $d2_time            = '';
    $d2_thardness       = '';
    $d2_ph              = '';
    $d2_conductivity    = '';
    $d2_dissolvedoxygen = '';
    $d2_silica          = '';
    $d2_fe              = '';
    $d3_time            = '';
    $d3_alkalinity      = '';
    $d3_conductivity    = '';
    $d3_thardness       = '';
    $d3_ph              = '';
    $d3_suhu_inlet      = '';
    $d3_suhu_outlet     = '';
    $d3_turbuditi       = '';
    $d3_ci              = '';
    $d3_freeci2         = '';
    $d4_time            = '';
    $d4_thardness       = '';
    $d4_ph              = '';
    $d4_conductivity    = '';
    $d4_turbuditi       = '';
    $d4_ci              = '';
    $d4_freeci2         = '';
    $d5_time            = '';
    $d5_ph              = '';
    $d5_conductivity    = '';
    $d5_hardness        = '';

    $e1_time         = '';
    $e1_startstop    = '';
    $e1_turbuditi    = '';
    $e1_pressure     = '';
    $e1_flowmeter    = '';
    $e1_ph           = '';
    $e1_conductivity = '';
    $e2_acidion      = '';
    $e3_conductivity = '';
    $e3_ph           = '';
    $e4_acidion      = '';
    $e5_conductivity = '';
    $e5_ph           = '';
    $e5_silica       = '';

    $f1_timestart = '';
    $f1_timestop  = '';
    $f1_ro        = '';
    $f1_flowstart = '';
    $f1_flowstop  = '';
    $f1_total     = '';

    $g1_timestart = '';
    $g1_timestop  = '';
    $g1_note      = '';
    $g1_flowstart = '';
    $g1_flowstop  = '';
    $g1_total     = '';
} ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="mt-2 mb-1 d-flex justify-content-center">
                        <img src="<?= base_url('assets/images/PSG_logo_2022.png') ?>" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <h2><?= $this->config->item("nama_perusahaan"); ?></h2>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <h2>
                            <h4>DEPARTEMENT POWER PLANT (TURBINE)</h4>
                        </h2>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <h4><?= $frmjdl; ?></h4>
                    </div>

                    <div class="card-body">
                        <?php if (isset($message)) { ?>
                            <div class="alert alert-danger mb-3" role="alert">
                                <h4 class="alert-heading">Warning!</h4>
                                <p class="mb-0">
                                    <?= $message; ?>
                                </p>
                            </div>
                        <?php } elseif (isset($message2)) { ?>
                            <div class="alert alert-danger mb-3" role="alert">
                                <h4 class="alert-heading">Warning!</h4>
                                <p class="mb-0">
                                    <?= $message2; ?>
                                </p>
                            </div>

                        <?php } elseif (isset($comment)) { ?>
                            <div class="alert alert-danger mb-3" role="alert">
                                <h4 class="alert-heading">Warning!</h4>
                                <p class="mb-0">
                                    Laporan ini Sebelumnya telah Disapprove oleh <?= $comment_by; ?>, pada
                                    <?= $comment_date; ?> <?= $comment_time; ?>, komentar : <?= $comment; ?>
                                </p>
                            </div>
                        <?php } ?>

                        <?php $this->load->view('template/V_onprocess'); ?>

                        <form action="<?= base_url('form_input/C_forminttbn022_06/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="forminttbn022" name="forminttbn022" method="post" role="form" autocomplete="off" enctype="multipart/form-data">

                            <div class="row mb-1">
                                <div class="col-6">

                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?= $headerid; ?>" id="headerid" class="headerid">
                                    <?php } ?>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Date
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($dtheader) || isset($message)) { ?>
                                                <input type="text" name="create_date" id="create_date" class="form-control create_date" value="<?= $create_date; ?>" readonly required>
                                            <?php } else { ?>
                                                <input type="text" name="create_date" id="create_date" class="form-control datepicker maskdate create_date" value="<?= $create_date; ?>" required>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Doc
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="docno" id="docno" class="form-control docno dtopen_blok" value="<?= $docno; ?>" readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-content">

                                <?php $thead = '<tr>
                                                    <th class="table-danger align-middle text-center">Sampling Point</th>
                                                    <th class="table-danger align-middle text-center" colspan="7">Dearator 102 - 104 °C</th>
                                                    <th class="table-warning align-middle text-center">Sampling Point</th>
                                                    <th class="table-warning align-middle text-center" colspan="6">Boiler Water 120 - 150 °C</th>
                                                    <th class="table-success align-middle text-center">Sampling Point</th>
                                                    <th class="table-success align-middle text-center" colspan="4">Live Steam 300 - 350 °C</th>
                                                    <th class="table-secondary align-middle text-center">Sampling Point</th>
                                                    <th class="table-secondary align-middle text-center" colspan="4">Superheated Steam 420 - 450 °C</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-danger align-middle text-center" rowspan="3">Time</th>
                                                    <th class="table-danger align-middle text-center">Alkalinity</th>
                                                    <th class="table-danger align-middle text-center" rowspan="2">pH</th>
                                                    <th class="table-danger align-middle text-center" rowspan="2">Conduc- tivity <br> µs/ cm</th>
                                                    <th class="table-danger align-middle text-center" rowspan="2">T. Hardness <br> µmol/L</th>
                                                    <th class="table-danger align-middle text-center" rowspan="2">Dissolved Oxygen <br> ppb O2</th>
                                                    <th class="table-danger align-middle text-center" rowspan="2">Silica <br> ppm</th>
                                                    <th class="table-danger align-middle text-center" rowspan="2">Fe <br> ppm</th>

                                                    <th class="table-warning align-middle text-center" rowspan="3">Time</th>
                                                    <th class="table-warning align-middle text-center" colspan="2">Total Alkalinity</th>
                                                    <th class="table-warning align-middle text-center" rowspan="2">pH</th>
                                                    <th class="table-warning align-middle text-center" rowspan="2">Conductivity <br> µs/ cm</th>
                                                    <th class="table-warning align-middle text-center" rowspan="2">(PO4)³ֿ ion <br> ppm</br></th>
                                                    <th class="table-warning align-middle text-center" rowspan="2">Silica <br> ppm</th>

                                                    <th class="table-success align-middle text-center" rowspan="3">Time</th>
                                                    <th class="table-success align-middle text-center" rowspan="2">pH</th>
                                                    <th class="table-success align-middle text-center" rowspan="2">Conductivity <br> µs/ cm</th>
                                                    <th class="table-success align-middle text-center" rowspan="2">Fe <br> ppm</th>
                                                    <th class="table-success align-middle text-center" rowspan="2">Silica <br> ppm</th>

                                                    <th class="table-secondary align-middle text-center" rowspan="3">Time</th>
                                                    <th class="table-secondary align-middle text-center" rowspan="2">pH</th>
                                                    <th class="table-secondary align-middle text-center" rowspan="2">Conduc- tivity <br> µs/ cm</th>
                                                    <th class="table-secondary align-middle text-center" rowspan="2">Fe <br> ppm</th>
                                                    <th class="table-secondary align-middle text-center" rowspan="2">Silica <br> ppm</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-danger align-middle text-center">M <br> mmol/ L</th>

                                                    <th class="table-warning align-middle text-center">P <br> ppm</th>
                                                    <th class="table-warning align-middle text-center">M <br> ppm</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-danger align-middle text-center">≤0.5</th>
                                                    <th class="table-danger align-middle text-center">8.5 -9.3</th>
                                                    <th class="table-danger align-middle text-center">≤10</th>
                                                    <th class="table-danger align-middle text-center">≤5.0</th>
                                                    <th class="table-danger align-middle text-center">≤ 15</th>
                                                    <th class="table-danger align-middle text-center">0.5 Max</th>
                                                    <th class="table-danger align-middle text-center">≤0,10</th>

                                                    <th class="table-warning align-middle text-center">max 50</th>
                                                    <th class="table-warning align-middle text-center">max 100</th>
                                                    <th class="table-warning align-middle text-center">9,5 - 10,5</th>
                                                    <th class="table-warning align-middle text-center">≤500</th>
                                                    <th class="table-warning align-middle text-center">5 - 15</th>
                                                    <th class="table-warning align-middle text-center">30 Max</th>

                                                    <th class="table-success align-middle text-center">8,0 - 9,0</th>
                                                    <th class="table-success align-middle text-center">≤10</th>
                                                    <th class="table-success align-middle text-center">0,1 max</th>
                                                    <th class="table-success align-middle text-center">0,2 max</th>

                                                    <th class="table-secondary align-middle text-center">8,0 - 9,0</th>
                                                    <th class="table-secondary align-middle text-center">≤10</th>
                                                    <th class="table-secondary align-middle text-center">0,1 max</th>
                                                    <th class="table-secondary align-middle text-center">0,2 max</th>
                                                </tr>' ?>

                                <label for="" class="mb-1">A. Water Analyis Results : BOILER #1</label>
                                <div class="row">
                                    <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="fixed freeze_vertical">

                                                <?= $thead; ?>

                                            </thead>
                                            <tbody>
                                                <?php if (!isset($dtdetail)) {
                                                    if (isset($message)) { ?>
                                                        <!-- data dikosongkan -->
                                                        <?php } else {
                                                        for ($i = 1; $i <= 7; $i++) {
                                                            if ($i == 1) {
                                                                $time = "08.00";
                                                                $collor = "";
                                                                $collor_2 = "";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "";
                                                            } elseif ($i == 2) {
                                                                $time = "12.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 3) {
                                                                $time = "16.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 4) {
                                                                $time = "20.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 5) {
                                                                $time = "24.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 6) {
                                                                $time = "04.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 7) {
                                                                $time = "";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "";
                                                                $readonly_2 = "readonly";
                                                            }
                                                        ?>
                                                            <tr>
                                                                <td><input type="text" name="a1_time[]" id="a1_time" class="form-control a1_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="a1_alkalinity[]" id="a1_alkalinity" class="form-control w-auto a1_alkalinity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a1_ph[]" id="a1_ph" class="form-control w-auto a1_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a1_conductivity[]" id="a1_conductivity" class="form-control w-auto a1_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a1_thardness[]" id="a1_thardness" class="form-control w-auto a1_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a1_dissolvedoxygen[]" id="a1_dissolvedoxygen" class="form-control w-auto a1_dissolvedoxygen" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a1_silica[]" id="a1_silica" class="form-control w-auto a1_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="a1_fe[]" id="a1_fe" class="form-control w-auto a1_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="a2_time[]" id="a2_time" class="form-control a2_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="a2_alkalinityp[]" id="a2_alkalinityp" class="form-control w-auto a2_alkalinityp" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a2_alkalinitym[]" id="a2_alkalinitym" class="form-control w-auto a2_alkalinitym" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a2_ph[]" id="a2_ph" class="form-control w-auto a2_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a2_conductivity[]" id="a2_conductivity" class="form-control w-auto a2_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a2_ion[]" id="a2_ion" class="form-control w-auto a2_ion" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a2_silica[]" id="a2_silica" class="form-control w-auto a2_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="a3_time[]" id="a3_time" class="form-control a3_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="a3_ph[]" id="a3_ph" class="form-control w-auto a3_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a3_conductivity[]" id="a3_conductivity" class="form-control w-auto a3_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a3_silica[]" id="a3_silica" class="form-control w-auto a3_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type=" number" name="a3_fe[]" id="a3_fe" class="form-control w-auto a3_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type=" text" name="a4_time[]" id="a4_time" class="form-control a4_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="a4_ph[]" id="a4_ph" class="form-control w-auto a4_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a4_conductivity[]" id="a4_conductivity" class="form-control w-auto a4_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="a4_silica[]" id="a4_silica" class="form-control w-auto a4_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="a4_fe[]" id="a4_fe" class="form-control w-auto a4_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                } else {
                                                    $i = 1;
                                                    foreach ($dtdetail as $row) {
                                                        if ($i == 1) {
                                                            $collor = "";
                                                            $collor_2 = "";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "";
                                                        } elseif ($i == 2) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 3) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 4) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 5) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 6) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 7) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "";
                                                            $readonly_2 = "readonly";
                                                        }
                                                        $i++;
                                                        ?>

                                                        <tr>
                                                            <input type="hidden" name="detail_id[]" id="detail_id" class="detail_id" value="<?= $row->detail_id; ?>">
                                                            <td><input type="text" name="a1_time[]" id="a1_time" class="form-control a1_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->a1_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="a1_alkalinity[]" id="a1_alkalinity" class="form-control w-auto a1_alkalinity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a1_alkalinity; ?>"></td>
                                                            <td><input type="text" name="a1_ph[]" id="a1_ph" class="form-control w-auto a1_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a1_ph; ?>"></td>
                                                            <td><input type="text" name="a1_conductivity[]" id="a1_conductivity" class="form-control w-auto a1_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a1_conductivity; ?>"></td>
                                                            <td><input type="text" name="a1_thardness[]" id="a1_thardness" class="form-control w-auto a1_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a1_thardness; ?>"></td>
                                                            <td><input type="text" name="a1_dissolvedoxygen[]" id="a1_dissolvedoxygen" class="form-control w-auto a1_dissolvedoxygen" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a1_dissolvedoxygen; ?>"></td>
                                                            <td><input type="text" name="a1_silica[]" id="a1_silica" class="form-control w-auto a1_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->a1_silica; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="a1_fe[]" id="a1_fe" class="form-control w-auto a1_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->a1_fe; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="a2_time[]" id="a2_time" class="form-control a2_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->a2_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="a2_alkalinityp[]" id="a2_alkalinityp" class="form-control w-auto a2_alkalinityp" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a2_alkalinityp; ?>"></td>
                                                            <td><input type="text" name="a2_alkalinitym[]" id="a2_alkalinitym" class="form-control w-auto a2_alkalinitym" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a2_alkalinitym; ?>"></td>
                                                            <td><input type="text" name="a2_ph[]" id="a2_ph" class="form-control w-auto a2_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a2_ph; ?>"></td>
                                                            <td><input type="text" name="a2_conductivity[]" id="a2_conductivity" class="form-control w-auto a2_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a2_conductivity; ?>"></td>
                                                            <td><input type="text" name="a2_ion[]" id="a2_ion" class="form-control w-auto a2_ion" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a2_ion; ?>"></td>
                                                            <td><input type="text" name="a2_silica[]" id="a2_silica" class="form-control w-auto a2_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->a2_silica; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="a3_time[]" id="a3_time" class="form-control a3_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->a3_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="a3_ph[]" id="a3_ph" class="form-control w-auto a3_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a3_ph; ?>"></td>
                                                            <td><input type="text" name="a3_conductivity[]" id="a3_conductivity" class="form-control w-auto a3_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a3_conductivity; ?>"></td>
                                                            <td><input type="text" name="a3_silica[]" id="a3_silica" class="form-control w-auto a3_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->a3_silica; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="a3_fe[]" id="a3_fe" class="form-control w-auto a3_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->a3_fe; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="a4_time[]" id="a4_time" class="form-control a4_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->a4_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="a4_ph[]" id="a4_ph" class="form-control w-auto a4_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a4_ph; ?>"></td>
                                                            <td><input type="text" name="a4_conductivity[]" id="a4_conductivity" class="form-control w-auto a4_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->a4_conductivity; ?>"></td>
                                                            <td><input type="text" name="a4_silica[]" id="a4_silica" class="form-control w-auto a4_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->a4_silica; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="a4_fe[]" id="a4_fe" class="form-control w-auto a4_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->a4_fe; ?>" <?= $readonly_2; ?>></td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <hr>

                                <label for="" class="mb-1">B. Water Analyis Results : BOILER #2</label>
                                <div class="row">
                                    <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="fixed freeze_vertical">

                                                <?= $thead; ?>

                                            </thead>
                                            <tbody>
                                                <?php if (!isset($dtdetail_b)) {
                                                    if (isset($message)) { ?>
                                                        <!-- data dikosongkan -->
                                                        <?php } else {
                                                        for ($i = 1; $i <= 7; $i++) {
                                                            if ($i == 1) {
                                                                $time = "08.00";
                                                                $collor = "";
                                                                $collor_2 = "";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "";
                                                            } elseif ($i == 2) {
                                                                $time = "12.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 3) {
                                                                $time = "16.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 4) {
                                                                $time = "20.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 5) {
                                                                $time = "24.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 6) {
                                                                $time = "04.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 7) {
                                                                $time = "";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "";
                                                                $readonly_2 = "readonly";
                                                            }
                                                        ?>
                                                            <tr>
                                                                <td><input type="text" name="b1_time[]" id="b1_time" class="form-control b1_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="b1_alkalinity[]" id="b1_alkalinity" class="form-control w-auto b1_alkalinity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b1_ph[]" id="b1_ph" class="form-control w-auto b1_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b1_conductivity[]" id="b1_conductivity" class="form-control w-auto b1_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b1_thardness[]" id="b1_thardness" class="form-control w-auto b1_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b1_dissolvedoxygen[]" id="b1_dissolvedoxygen" class="form-control w-auto b1_dissolvedoxygen" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b1_silica[]" id="b1_silica" class="form-control w-auto b1_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="b1_fe[]" id="b1_fe" class="form-control w-auto b1_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="b2_time[]" id="b2_time" class="form-control b2_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="b2_alkalinityp[]" id="b2_alkalinityp" class="form-control w-auto b2_alkalinityp" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b2_alkalinitym[]" id="b2_alkalinitym" class="form-control w-auto b2_alkalinitym" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b2_ph[]" id="b2_ph" class="form-control w-auto b2_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b2_conductivity[]" id="b2_conductivity" class="form-control w-auto b2_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b2_ion[]" id="b2_ion" class="form-control w-auto b2_ion" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b2_silica[]" id="b2_silica" class="form-control w-auto b2_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="b3_time[]" id="b3_time" class="form-control b3_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="b3_ph[]" id="b3_ph" class="form-control w-auto b3_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b3_conductivity[]" id="b3_conductivity" class="form-control w-auto b3_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b3_silica[]" id="b3_silica" class="form-control w-auto b3_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="b3_fe[]" id="b3_fe" class="form-control w-auto b3_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="b4_time[]" id="b4_time" class="form-control b4_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="b4_ph[]" id="b4_ph" class="form-control w-auto b4_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b4_conductivity[]" id="b4_conductivity" class="form-control w-auto b4_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="b4_silica[]" id="b4_silica" class="form-control w-auto b4_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="b4_fe[]" id="b4_fe" class="form-control w-auto b4_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                } else {
                                                    $i = 1;
                                                    foreach ($dtdetail_b as $row) {
                                                        if ($i == 1) {
                                                            $collor = "";
                                                            $collor_2 = "";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "";
                                                        } elseif ($i == 2) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 3) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 4) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 5) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 6) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 7) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "";
                                                            $readonly_2 = "readonly";
                                                        }
                                                        $i++;
                                                        ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id_b[]" id="detail_id_b" class="detail_id_b" value="<?= $row->detail_id; ?>">
                                                            <td><input type="text" name="b1_time[]" id="b1_time" class="form-control b1_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->b1_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="b1_alkalinity[]" id="b1_alkalinity" class="form-control w-auto b1_alkalinity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b1_alkalinity; ?>"></td>
                                                            <td><input type="text" name="b1_ph[]" id="b1_ph" class="form-control w-auto b1_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b1_ph; ?>"></td>
                                                            <td><input type="text" name="b1_conductivity[]" id="b1_conductivity" class="form-control w-auto b1_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b1_conductivity; ?>"></td>
                                                            <td><input type="text" name="b1_thardness[]" id="b1_thardness" class="form-control w-auto b1_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b1_thardness; ?>"></td>
                                                            <td><input type="text" name="b1_dissolvedoxygen[]" id="b1_dissolvedoxygen" class="form-control w-auto b1_dissolvedoxygen" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b1_dissolvedoxygen; ?>"></td>
                                                            <td><input type="text" name="b1_silica[]" id="b1_silica" class="form-control w-auto b1_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->b1_silica; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="b1_fe[]" id="b1_fe" class="form-control w-auto b1_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->b1_fe; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="b2_time[]" id="b2_time" class="form-control b2_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->b2_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="b2_alkalinityp[]" id="b2_alkalinityp" class="form-control w-auto b2_alkalinityp" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b2_alkalinityp; ?>"></td>
                                                            <td><input type="text" name="b2_alkalinitym[]" id="b2_alkalinitym" class="form-control w-auto b2_alkalinitym" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b2_alkalinitym; ?>"></td>
                                                            <td><input type="text" name="b2_ph[]" id="b2_ph" class="form-control w-auto b2_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b2_ph; ?>"></td>
                                                            <td><input type="text" name="b2_conductivity[]" id="b2_conductivity" class="form-control w-auto b2_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b2_conductivity; ?>"></td>
                                                            <td><input type="text" name="b2_ion[]" id="b2_ion" class="form-control w-auto b2_ion" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b2_ion; ?>"></td>
                                                            <td><input type="text" name="b2_silica[]" id="b2_silica" class="form-control w-auto b2_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->b2_silica; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="b3_time[]" id="b3_time" class="form-control b3_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->b3_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="b3_ph[]" id="b3_ph" class="form-control w-auto b3_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b3_ph; ?>"></td>
                                                            <td><input type="text" name="b3_conductivity[]" id="b3_conductivity" class="form-control w-auto b3_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b3_conductivity; ?>"></td>
                                                            <td><input type="text" name="b3_silica[]" id="b3_silica" class="form-control w-auto b3_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->b3_silica; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="b3_fe[]" id="b3_fe" class="form-control w-auto b3_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->b3_fe; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="b4_time[]" id="b4_time" class="form-control b4_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->b4_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="b4_ph[]" id="b4_ph" class="form-control w-auto b4_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b4_ph; ?>"></td>
                                                            <td><input type="text" name="b4_conductivity[]" id="b4_conductivity" class="form-control w-auto b4_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->b4_conductivity; ?>"></td>
                                                            <td><input type="text" name="b4_silica[]" id="b4_silica" class="form-control w-auto b4_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->b4_silica; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="b4_fe[]" id="b4_fe" class="form-control w-auto b4_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->b4_fe; ?>" <?= $readonly_2; ?>></td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <hr>

                                <label for="" class="mb-1">C. Water Analyis Results : BOILER #3</label>
                                <div class="row">
                                    <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="fixed freeze_vertical">
                                                <tr>
                                                    <th class="table-danger align-middle text-center">Sampling Point</th>
                                                    <th class="table-danger align-middle text-center" colspan="7">Dearator 102 - 104 °C</th>
                                                    <th class="table-warning align-middle text-center">Sampling Point</th>
                                                    <th class="table-warning align-middle text-center" colspan="6">Boiler Water 120 - 150 °C</th>
                                                    <th class="table-success align-middle text-center">Sampling Point</th>
                                                    <th class="table-success align-middle text-center" colspan="4">Live Steam 300 - 350 °C</th>
                                                    <th class="table-secondary align-middle text-center">Sampling Point</th>
                                                    <th class="table-secondary align-middle text-center" colspan="4">Superheated Steam 420 - 450 °C</th>
                                                    <th class="table-primary align-middle text-center">Sampling Point</th>
                                                    <th class="table-primary align-middle text-center" colspan="3">Drain Tank</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-danger align-middle text-center" rowspan="3">Time</th>
                                                    <th class="table-danger align-middle text-center">Alkalinity</th>
                                                    <th class="table-danger align-middle text-center" rowspan="2">pH</th>
                                                    <th class="table-danger align-middle text-center" rowspan="2">Conduc- tivity <br> µs/ cm</th>
                                                    <th class="table-danger align-middle text-center" rowspan="2">T. Hardness <br> µmol/L</th>
                                                    <th class="table-danger align-middle text-center" rowspan="2">Dissolved Oxygen <br> ppb O2</th>
                                                    <th class="table-danger align-middle text-center" rowspan="2">Silica <br> ppm</th>
                                                    <th class="table-danger align-middle text-center" rowspan="2">Fe <br> ppm</th>

                                                    <th class="table-warning align-middle text-center" rowspan="3">Time</th>
                                                    <th class="table-warning align-middle text-center" colspan="2">Total Alkalinity</th>
                                                    <th class="table-warning align-middle text-center" rowspan="2">pH</th>
                                                    <th class="table-warning align-middle text-center" rowspan="2">Conductivity <br> µs/ cm</th>
                                                    <th class="table-warning align-middle text-center" rowspan="2">(PO4)³ֿ ion <br> ppm</br></th>
                                                    <th class="table-warning align-middle text-center" rowspan="2">Silica <br> ppm</th>

                                                    <th class="table-success align-middle text-center" rowspan="3">Time</th>
                                                    <th class="table-success align-middle text-center" rowspan="2">pH</th>
                                                    <th class="table-success align-middle text-center" rowspan="2">Conductivity <br> µs/ cm</th>
                                                    <th class="table-success align-middle text-center" rowspan="2">Fe <br> ppm</th>
                                                    <th class="table-success align-middle text-center" rowspan="2">Silica <br> ppm</th>

                                                    <th class="table-secondary align-middle text-center" rowspan="3">Time</th>
                                                    <th class="table-secondary align-middle text-center" rowspan="2">pH</th>
                                                    <th class="table-secondary align-middle text-center" rowspan="2">Conduc- tivity <br> µs/ cm</th>
                                                    <th class="table-secondary align-middle text-center" rowspan="2">Silica <br> ppm</th>
                                                    <th class="table-secondary align-middle text-center" rowspan="2">Fe <br> ppm</th>

                                                    <th class="table-primary align-middle text-center" rowspan="3">Time</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">Conductivity <br> µs/ cm</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">T. Hardness <br> µmol/L</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">pH</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-danger align-middle text-center">M <br> mmol/ L</th>

                                                    <th class="table-warning align-middle text-center">P <br> ppm</th>
                                                    <th class="table-warning align-middle text-center">M <br> ppm</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-danger align-middle text-center">≤0.5</th>
                                                    <th class="table-danger align-middle text-center">8.5 -9.3</th>
                                                    <th class="table-danger align-middle text-center">≤10</th>
                                                    <th class="table-danger align-middle text-center">≤5.0</th>
                                                    <th class="table-danger align-middle text-center">≤ 15</th>
                                                    <th class="table-danger align-middle text-center">0.5 Max</th>
                                                    <th class="table-danger align-middle text-center">≤0,10</th>

                                                    <th class="table-warning align-middle text-center">max 50</th>
                                                    <th class="table-warning align-middle text-center">max 100</th>
                                                    <th class="table-warning align-middle text-center">9,5 - 10,5</th>
                                                    <th class="table-warning align-middle text-center">≤500</th>
                                                    <th class="table-warning align-middle text-center">5 - 15</th>
                                                    <th class="table-warning align-middle text-center">30 Max</th>

                                                    <th class="table-success align-middle text-center">8,0 - 9,0</th>
                                                    <th class="table-success align-middle text-center">≤10</th>
                                                    <th class="table-success align-middle text-center">0,1 max</th>
                                                    <th class="table-success align-middle text-center">0,2 max</th>

                                                    <th class="table-secondary align-middle text-center">8,0 - 9,0</th>
                                                    <th class="table-secondary align-middle text-center">≤10</th>
                                                    <th class="table-secondary align-middle text-center">0,1 max</th>
                                                    <th class="table-secondary align-middle text-center">0,2 max</th>

                                                    <th class="table-primary align-middle text-center">≤10</th>
                                                    <th class="table-primary align-middle text-center">≤2.0</th>
                                                    <th class="table-primary align-middle text-center">8.0 - 9.0</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!isset($dtdetail_c)) {
                                                    if (isset($message)) { ?>
                                                        <!-- data dikosongkan -->
                                                        <?php } else {
                                                        for ($i = 1; $i <= 7; $i++) {
                                                            if ($i == 1) {
                                                                $time = "08.00";
                                                                $collor = "";
                                                                $collor_2 = "";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "";
                                                            } elseif ($i == 2) {
                                                                $time = "12.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 3) {
                                                                $time = "16.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 4) {
                                                                $time = "20.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 5) {
                                                                $time = "24.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 6) {
                                                                $time = "04.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 7) {
                                                                $time = "";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "";
                                                                $readonly_2 = "readonly";
                                                            }
                                                        ?>
                                                            <tr>
                                                                <td><input type="text" name="c1_time[]" id="c1_time" class="form-control c1_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="c1_alkalinity[]" id="c1_alkalinity" class="form-control w-auto c1_alkalinity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c1_ph[]" id="c1_ph" class="form-control w-auto c1_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c1_conductivity[]" id="c1_conductivity" class="form-control w-auto c1_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c1_thardness[]" id="c1_thardness" class="form-control w-auto c1_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c1_dissolvedoxygen[]" id="c1_dissolvedoxygen" class="form-control w-auto c1_dissolvedoxygen" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c1_silica[]" id="c1_silica" class="form-control w-auto c1_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="c1_fe[]" id="c1_fe" class="form-control w-auto c1_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="c2_time[]" id="c2_time" class="form-control c2_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="c2_alkalinityp[]" id="c2_alkalinityp" class="form-control w-auto c2_alkalinityp" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c2_alkalinitym[]" id="c2_alkalinitym" class="form-control w-auto c2_alkalinitym" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c2_ph[]" id="c2_ph" class="form-control w-auto c2_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c2_conductivity[]" id="c2_conductivity" class="form-control w-auto c2_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c2_ion[]" id="c2_ion" class="form-control w-auto c2_ion" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c2_silica[]" id="c2_silica" class="form-control w-auto c2_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="c3_time[]" id="c3_time" class="form-control c3_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="c3_ph[]" id="c3_ph" class="form-control w-auto c3_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c3_conductivity[]" id="c3_conductivity" class="form-control w-auto c3_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c3_silica[]" id="c3_silica" class="form-control w-auto c3_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="c3_fe[]" id="c3_fe" class="form-control w-auto c3_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="c4_time[]" id="c4_time" class="form-control c4_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="c4_ph[]" id="c4_ph" class="form-control w-auto c4_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c4_conductivity[]" id="c4_conductivity" class="form-control w-auto c4_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c4_silica[]" id="c4_silica" class="form-control w-auto c4_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="c4_fe[]" id="c4_fe" class="form-control w-auto c4_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="c5_time[]" id="c5_time" class="form-control c5_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="c5_conductivity[]" id="c5_conductivity" class="form-control w-auto c5_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c5_thardness[]" id="c5_thardness" class="form-control w-auto c5_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="c5_ph[]" id="c5_ph" class="form-control w-auto c5_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                } else {
                                                    $i = 1;
                                                    foreach ($dtdetail_c as $row) {
                                                        if ($i == 1) {
                                                            $collor = "";
                                                            $collor_2 = "";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "";
                                                        } elseif ($i == 2) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 3) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 4) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 5) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 6) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 7) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "";
                                                            $readonly_2 = "readonly";
                                                        }
                                                        $i++;
                                                        ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id_c[]" id="detail_id_c" class="detail_id_c" value="<?= $row->detail_id; ?>">
                                                            <td><input type="text" name="c1_time[]" id="c1_time" class="form-control c1_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->c1_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="c1_alkalinity[]" id="c1_alkalinity" class="form-control w-auto c1_alkalinity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c1_alkalinity; ?>"></td>
                                                            <td><input type="text" name="c1_ph[]" id="c1_ph" class="form-control w-auto c1_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c1_ph; ?>"></td>
                                                            <td><input type="text" name="c1_conductivity[]" id="c1_conductivity" class="form-control w-auto c1_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c1_conductivity; ?>"></td>
                                                            <td><input type="text" name="c1_thardness[]" id="c1_thardness" class="form-control w-auto c1_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c1_thardness; ?>"></td>
                                                            <td><input type="text" name="c1_dissolvedoxygen[]" id="c1_dissolvedoxygen" class="form-control w-auto c1_dissolvedoxygen" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c1_dissolvedoxygen; ?>"></td>
                                                            <td><input type="text" name="c1_silica[]" id="c1_silica" class="form-control w-auto c1_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->c1_silica; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="c1_fe[]" id="c1_fe" class="form-control w-auto c1_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->c1_fe; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="c2_time[]" id="c2_time" class="form-control c2_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->c2_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="c2_alkalinityp[]" id="c2_alkalinityp" class="form-control w-auto c2_alkalinityp" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c2_alkalinityp; ?>"></td>
                                                            <td><input type="text" name="c2_alkalinitym[]" id="c2_alkalinitym" class="form-control w-auto c2_alkalinitym" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c2_alkalinitym; ?>"></td>
                                                            <td><input type="text" name="c2_ph[]" id="c2_ph" class="form-control w-auto c2_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c2_ph; ?>"></td>
                                                            <td><input type="text" name="c2_conductivity[]" id="c2_conductivity" class="form-control w-auto c2_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c2_conductivity; ?>"></td>
                                                            <td><input type="text" name="c2_ion[]" id="c2_ion" class="form-control w-auto c2_ion" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c2_ion; ?>"></td>
                                                            <td><input type="text" name="c2_silica[]" id="c2_silica" class="form-control w-auto c2_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->c2_silica; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="c3_time[]" id="c3_time" class="form-control c3_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->c3_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="c3_ph[]" id="c3_ph" class="form-control w-auto c3_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c3_ph; ?>"></td>
                                                            <td><input type="text" name="c3_conductivity[]" id="c3_conductivity" class="form-control w-auto c3_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c3_conductivity; ?>"></td>
                                                            <td><input type="text" name="c3_silica[]" id="c3_silica" class="form-control w-auto c3_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->c3_silica; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="c3_fe[]" id="c3_fe" class="form-control w-auto c3_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->c3_fe; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="c4_time[]" id="c4_time" class="form-control c4_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->c4_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="c4_ph[]" id="c4_ph" class="form-control w-auto c4_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c4_ph; ?>"></td>
                                                            <td><input type="text" name="c4_conductivity[]" id="c4_conductivity" class="form-control w-auto c4_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c4_conductivity; ?>"></td>
                                                            <td><input type="text" name="c4_silica[]" id="c4_silica" class="form-control w-auto c4_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->c4_silica; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="c4_fe[]" id="c4_fe" class="form-control w-auto c4_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->c4_fe; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="c5_time[]" id="c5_time" class="form-control c5_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->c5_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="c5_conductivity[]" id="c5_conductivity" class="form-control w-auto c5_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c5_conductivity; ?>"></td>
                                                            <td><input type="text" name="c5_thardness[]" id="c5_thardness" class="form-control w-auto c5_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c5_thardness; ?>"></td>
                                                            <td><input type="text" name="c5_ph[]" id="c5_ph" class="form-control w-auto c5_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->c5_ph; ?>"></td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <hr>

                                <label for="" class="mb-1">D. Water Analyis Results</label>
                                <div class="row">
                                    <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="fixed freeze_vertical">
                                                <tr>
                                                    <th class="table-danger align-middle text-center">Sampling Point</th>
                                                    <th class="table-danger align-middle text-center" colspan="6">Condensed Turbine Water ( #1)</th>
                                                    <th class="table-warning align-middle text-center">Sampling Point</th>
                                                    <th class="table-warning align-middle text-center" colspan="6">Condensed Turbine Water ( #2)</th>
                                                    <th class="table-success align-middle text-center">Sampling Point</th>
                                                    <th class="table-success align-middle text-center" colspan="9">Cooling System Water</th>
                                                    <th class="table-secondary align-middle text-center">Sampling Point</th>
                                                    <th class="table-secondary align-middle text-center" colspan="6">Make Up Cooling System Water ( ASF )</th>
                                                    <th class="table-primary align-middle text-center">Sampling Point</th>
                                                    <th class="table-primary align-middle text-center" colspan="3">Demin Water</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-danger align-middle text-center" rowspan="2">Time</th>
                                                    <th class="table-danger align-middle text-center">T. Hardness <br> µmol/L</th>
                                                    <th class="table-danger align-middle text-center">pH</th>
                                                    <th class="table-danger align-middle text-center">Conduc- tivity <br> µs/ cm</th>
                                                    <th class="table-danger align-middle text-center">Dissolved Oxygen <br>ppb O2</th>
                                                    <th class="table-danger align-middle text-center">Silica <br> ppm</th>
                                                    <th class="table-danger align-middle text-center">Fe <br> ppm</th>

                                                    <th class="table-warning align-middle text-center" rowspan="2">Time</th>
                                                    <th class="table-warning align-middle text-center">T. Hardness <br> µmol/L</th>
                                                    <th class="table-warning align-middle text-center">pH</th>
                                                    <th class="table-warning align-middle text-center">Conduc- tivity <br> µs/ cm</th>
                                                    <th class="table-warning align-middle text-center">Dissolved Oxygen <br> ppb O2</br></th>
                                                    <th class="table-warning align-middle text-center">Silica <br> ppm</th>
                                                    <th class="table-warning align-middle text-center">Fe <br> ppm</th>

                                                    <th class="table-success align-middle text-center" rowspan="2">Time</th>
                                                    <th class="table-success align-middle text-center">Alkal-inity <br> M <br> ppm</th>
                                                    <th class="table-success align-middle text-center">Conduc- tivity <br> µs/ cm</th>
                                                    <th class="table-success align-middle text-center">T. Hardness <br> ppm</th>
                                                    <th class="table-success align-middle text-center">pH</th>
                                                    <th class="table-success align-middle text-center" colspan="2">Suhu <br> oC</th>
                                                    <th class="table-success align-middle text-center">Turbuditi <br> NTU</th>
                                                    <th class="table-success align-middle text-center">Cl- <br> ppm</th>
                                                    <th class="table-success align-middle text-center">Free Cl2 <br> ppm</th>

                                                    <th class="table-secondary align-middle text-center" rowspan="2">Time</th>
                                                    <th class="table-secondary align-middle text-center">T. Hardness <br> ppm (max)</th>
                                                    <th class="table-secondary align-middle text-center">pH</th>
                                                    <th class="table-secondary align-middle text-center">Conduc- tivity <br> µs/ cm</th>
                                                    <th class="table-secondary align-middle text-center">Turbuditi <br> NTU</th>
                                                    <th class="table-secondary align-middle text-center">Cl- <br> ppm</th>
                                                    <th class="table-secondary align-middle text-center">Free Cl2 <br> ppm</th>

                                                    <th class="table-primary align-middle text-center" rowspan="2">Time</th>
                                                    <th class="table-primary align-middle text-center">pH</th>
                                                    <th class="table-primary align-middle text-center">Conducti-vity <br> µs/ cm</th>
                                                    <th class="table-primary align-middle text-center">Hard-ness <br> mmol/ L</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-danger align-middle text-center">≤2.0</th>
                                                    <th class="table-danger align-middle text-center">8.0 -9.0</th>
                                                    <th class="table-danger align-middle text-center">≤10</th>
                                                    <th class="table-danger align-middle text-center">≤ 50</th>
                                                    <th class="table-danger align-middle text-center">0,2 max</th>
                                                    <th class="table-danger align-middle text-center">0,1 max</th>

                                                    <th class="table-warning align-middle text-center">≤3.0</th>
                                                    <th class="table-warning align-middle text-center">8.0 -9.0</th>
                                                    <th class="table-warning align-middle text-center">≤10</th>
                                                    <th class="table-warning align-middle text-center">≤ 50</th>
                                                    <th class="table-warning align-middle text-center">0,2 max</th>
                                                    <th class="table-warning align-middle text-center">0,1 max</th>

                                                    <th class="table-success align-middle text-center">≤ 800</th>
                                                    <th class="table-success align-middle text-center">max 3500</th>
                                                    <th class="table-success align-middle text-center">≤ 500</th>
                                                    <th class="table-success align-middle text-center">7,5 - 9,5</th>
                                                    <th class="table-success align-middle text-center">Inlet</th>
                                                    <th class="table-success align-middle text-center">Outlet</th>
                                                    <th class="table-success align-middle text-center">≤40</th>
                                                    <th class="table-success align-middle text-center">≤ 300</th>
                                                    <th class="table-success align-middle text-center">0,5 - 1,0</th>

                                                    <th class="table-secondary align-middle text-center">50</th>
                                                    <th class="table-secondary align-middle text-center">6,5 - 8,5</th>
                                                    <th class="table-secondary align-middle text-center">≤1000</th>
                                                    <th class="table-secondary align-middle text-center">≤5</th>
                                                    <th class="table-secondary align-middle text-center">≤ 250</th>
                                                    <th class="table-secondary align-middle text-center">0,1 - 0,6</th>

                                                    <th class="table-primary align-middle text-center">6,5 - 9,2</th>
                                                    <th class="table-primary align-middle text-center">≤10</th>
                                                    <th class="table-primary align-middle text-center">0</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!isset($dtdetail_d)) {
                                                    if (isset($message)) { ?>
                                                        <!-- data dikosongkan -->
                                                        <?php } else {
                                                        for ($i = 1; $i <= 7; $i++) {
                                                            if ($i == 1) {
                                                                $time = "08.00";
                                                                $collor = "";
                                                                $collor_2 = "";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "";
                                                            } elseif ($i == 2) {
                                                                $time = "12.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 3) {
                                                                $time = "16.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 4) {
                                                                $time = "20.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 5) {
                                                                $time = "24.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 6) {
                                                                $time = "04.00";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "readonly";
                                                                $readonly_2 = "readonly";
                                                            } elseif ($i == 7) {
                                                                $time = "";
                                                                $collor = "background-color: #BB8FCE; color: white;";
                                                                $collor_2 = "background-color: #85C1E9; color: white;";
                                                                $readonly = "";
                                                                $readonly_2 = "readonly";
                                                            }
                                                        ?>
                                                            <tr>
                                                                <td><input type="text" name="d1_time[]" id="d1_time" class="form-control d1_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="d1_thardness[]" id="d1_thardness" class="form-control w-auto d1_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d1_ph[]" id="d1_ph" class="form-control w-auto d1_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d1_conductivity[]" id="d1_conductivity" class="form-control w-auto d1_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d1_dissolvedoxygen[]" id="d1_dissolvedoxygen" class="form-control w-auto d1_dissolvedoxygen" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d1_silica[]" id="d1_silica" class="form-control w-auto d1_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="d1_fe[]" id="d1_fe" class="form-control w-auto d1_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="d2_time[]" id="d2_time" class="form-control d2_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="d2_thardness[]" id="d2_thardness" class="form-control w-auto d2_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d2_ph[]" id="d2_ph" class="form-control w-auto d2_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d2_conductivity[]" id="d2_conductivity" class="form-control w-auto d2_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d2_dissolvedoxygen[]" id="d2_dissolvedoxygen" class="form-control w-auto d2_dissolvedoxygen" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d2_silica[]" id="d2_silica" class="form-control w-auto d2_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="d2_fe[]" id="d2_fe" class="form-control w-auto d2_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="d3_time[]" id="d3_time" class="form-control d3_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="d3_alkalinity[]" id="d3_alkalinity" class="form-control w-auto d3_alkalinity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d3_conductivity[]" id="d3_conductivity" class="form-control w-auto d3_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d3_thardness[]" id="d3_thardness" class="form-control w-auto d3_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d3_ph[]" id="d3_ph" class="form-control w-auto d3_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d3_suhu_inlet[]" id="d3_suhu_inlet" class="form-control w-auto d3_suhu_inlet" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d3_suhu_outlet[]" id="d3_suhu_outlet" class="form-control w-auto d3_suhu_outlet" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d3_turbuditi[]" id="d3_turbuditi" class="form-control w-auto d3_turbuditi" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor_2; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="d3_ci[]" id="d3_ci" class="form-control w-auto d3_ci" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor_2; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="d3_freeci2[]" id="d3_freeci2" class="form-control w-auto d3_freeci2" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="d4_time[]" id="d4_time" class="form-control d4_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="d4_thardness[]" id="d4_thardness" class="form-control w-auto d4_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d4_ph[]" id="d4_ph" class="form-control w-auto d4_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d4_conductivity[]" id="d4_conductivity" class="form-control w-auto d4_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d4_turbuditi[]" id="d4_turbuditi" class="form-control w-auto d4_turbuditi" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor_2; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="d4_ci[]" id="d4_ci" class="form-control w-auto d4_ci" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor_2; ?>" value="" <?= $readonly_2; ?>></td>
                                                                <td><input type="text" name="d4_freeci2[]" id="d4_freeci2" class="form-control w-auto d4_freeci2" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="" <?= $readonly_2; ?>></td>

                                                                <td><input type="text" name="d5_time[]" id="d5_time" class="form-control d5_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $time; ?>" <?= $readonly; ?>></td>
                                                                <td><input type="text" name="d5_ph[]" id="d5_ph" class="form-control w-auto d5_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d5_conductivity[]" id="d5_conductivity" class="form-control w-auto d5_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                                <td><input type="text" name="d5_hardness[]" id="d5_hardness" class="form-control w-auto d5_hardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                } else {
                                                    $i = 1;
                                                    foreach ($dtdetail_d as $row) {
                                                        if ($i == 1) {
                                                            $collor = "";
                                                            $collor_2 = "";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "";
                                                        } elseif ($i == 2) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 3) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 4) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 5) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 6) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "readonly";
                                                            $readonly_2 = "readonly";
                                                        } elseif ($i == 7) {
                                                            $collor = "background-color: #BB8FCE; color: white;";
                                                            $collor_2 = "background-color: #85C1E9; color: white;";
                                                            $readonly = "";
                                                            $readonly_2 = "readonly";
                                                        }
                                                        $i++;
                                                        ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id_d[]" id="detail_id_d" class="detail_id_d" value="<?= $row->detail_id; ?>">
                                                            <td><input type="text" name="d1_time[]" id="d1_time" class="form-control d1_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->d1_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="d1_thardness[]" id="d1_thardness" class="form-control w-auto d1_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d1_thardness; ?>"></td>
                                                            <td><input type="text" name="d1_ph[]" id="d1_ph" class="form-control w-auto d1_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d1_ph; ?>"></td>
                                                            <td><input type="text" name="d1_conductivity[]" id="d1_conductivity" class="form-control w-auto d1_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d1_conductivity; ?>"></td>
                                                            <td><input type="text" name="d1_dissolvedoxygen[]" id="d1_dissolvedoxygen" class="form-control w-auto d1_dissolvedoxygen" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d1_dissolvedoxygen; ?>"></td>
                                                            <td><input type="text" name="d1_silica[]" id="d1_silica" class="form-control w-auto d1_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->d1_silica; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="d1_fe[]" id="d1_fe" class="form-control w-auto d1_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->d1_fe; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="d2_time[]" id="d2_time" class="form-control d2_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->d2_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="d2_thardness[]" id="d2_thardness" class="form-control w-auto d2_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d2_thardness; ?>"></td>
                                                            <td><input type="text" name="d2_ph[]" id="d2_ph" class="form-control w-auto d2_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d2_ph; ?>"></td>
                                                            <td><input type="text" name="d2_conductivity[]" id="d2_conductivity" class="form-control w-auto d2_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d2_conductivity; ?>"></td>
                                                            <td><input type="text" name="d2_dissolvedoxygen[]" id="d2_dissolvedoxygen" class="form-control w-auto d2_dissolvedoxygen" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d2_dissolvedoxygen; ?>"></td>
                                                            <td><input type="text" name="d2_silica[]" id="d2_silica" class="form-control w-auto d2_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->d2_silica; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="d2_fe[]" id="d2_fe" class="form-control w-auto d2_fe" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->d2_fe; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="d3_time[]" id="d3_time" class="form-control d3_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->d3_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="d3_alkalinity[]" id="d3_alkalinity" class="form-control w-auto d3_alkalinity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d3_alkalinity; ?>"></td>
                                                            <td><input type="text" name="d3_conductivity[]" id="d3_conductivity" class="form-control w-auto d3_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d3_conductivity; ?>"></td>
                                                            <td><input type="text" name="d3_thardness[]" id="d3_thardness" class="form-control w-auto d3_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d3_thardness; ?>"></td>
                                                            <td><input type="text" name="d3_ph[]" id="d3_ph" class="form-control w-auto d3_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d3_ph; ?>"></td>
                                                            <td><input type="text" name="d3_suhu_inlet[]" id="d3_suhu_inlet" class="form-control w-auto d3_suhu_inlet" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d3_suhu_inlet; ?>"></td>
                                                            <td><input type="text" name="d3_suhu_outlet[]" id="d3_suhu_outlet" class="form-control w-auto d3_suhu_outlet" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d3_suhu_outlet; ?>"></td>
                                                            <td><input type="text" name="d3_turbuditi[]" id="d3_turbuditi" class="form-control w-auto d3_turbuditi" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor_2; ?>" value="<?= $row->d3_turbuditi; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="d3_ci[]" id="d3_ci" class="form-control w-auto d3_ci" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor_2; ?>" value="<?= $row->d3_ci; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="d3_freeci2[]" id="d3_freeci2" class="form-control w-auto d3_freeci2" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->d3_freeci2; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="d4_time[]" id="d4_time" class="form-control d4_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->d4_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="d4_thardness[]" id="d4_thardness" class="form-control w-auto d4_thardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d4_thardness; ?>"></td>
                                                            <td><input type="text" name="d4_ph[]" id="d4_ph" class="form-control w-auto d4_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d4_ph; ?>"></td>
                                                            <td><input type="text" name="d4_conductivity[]" id="d4_conductivity" class="form-control w-auto d4_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d4_conductivity; ?>"></td>
                                                            <td><input type="text" name="d4_turbuditi[]" id="d4_turbuditi" class="form-control w-auto d4_turbuditi" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor_2; ?>" value="<?= $row->d4_turbuditi; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="d4_ci[]" id="d4_ci" class="form-control w-auto d4_ci" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor_2; ?>" value="<?= $row->d4_ci; ?>" <?= $readonly_2; ?>></td>
                                                            <td><input type="text" name="d4_freeci2[]" id="d4_freeci2" class="form-control w-auto d4_freeci2" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" value="<?= $row->d4_freeci2; ?>" <?= $readonly_2; ?>></td>

                                                            <td><input type="text" name="d5_time[]" id="d5_time" class="form-control d5_time clockpicker" data-autoclose="true" data-date-format="HH:mm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d5_time; ?>" <?= $readonly; ?>></td>
                                                            <td><input type="text" name="d5_ph[]" id="d5_ph" class="form-control w-auto d5_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d5_ph; ?>"></td>
                                                            <td><input type="text" name="d5_conductivity[]" id="d5_conductivity" class="form-control w-auto d5_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d5_conductivity; ?>"></td>
                                                            <td><input type="text" name="d5_hardness[]" id="d5_hardness" class="form-control w-auto d5_hardness" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->d5_hardness; ?>"></td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <hr>

                                <label for="" class="mb-1">E. Water Analysis Results : Chemical Water Treatment #1</label>
                                <div class="row">
                                    <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                        <table id="myTable" class="table table-bordered table-hover">

                                            <thead class="fixed freeze_vertical">
                                                <tr>
                                                    <th class="table-primary align-middle text-center" rowspan="3">#</th>
                                                    <th class="table-primary align-middle text-center" colspan="2">Sampling Point</th>
                                                    <th class="table-primary align-middle text-center" colspan="5">Reverse Osmosis</th>
                                                    <th class="table-primary align-middle text-center">Cation 1</th>
                                                    <th class="table-primary align-middle text-center" colspan="2">Anion 1</th>
                                                    <th class="table-primary align-middle text-center">Cation 2</th>
                                                    <th class="table-primary align-middle text-center" colspan="3">Anion 2</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-primary align-middle text-center" rowspan="2">Time</th>
                                                    <th class=" table-primary align-middle text-center" rowspan="2">Start / Stop</th>
                                                    <th class="table-primary align-middle text-center">Turbuditi <br> NTU</th>
                                                    <th class="table-primary align-middle text-center">Pressure <br> mPa</th>
                                                    <th class="table-primary align-middle text-center">Flow Meter</th>
                                                    <th class="table-primary align-middle text-center">pH</th>
                                                    <th class="table-primary align-middle text-center">Conduc- tivity <br> µs/ cm</th>

                                                    <th class="table-primary align-middle text-center">acid ion <br> mmol/ L</th>

                                                    <th class="table-primary align-middle text-center">Conduc- tivity <br> µs/ cm</th>
                                                    <th class="table-primary align-middle text-center">pH</th>

                                                    <th class="table-primary align-middle text-center">acid ion <br> mmol/ L</th>

                                                    <th class="table-primary align-middle text-center">Conduc- tivity <br>µs/ cm</br></th>
                                                    <th class="table-primary align-middle text-center">pH</th>
                                                    <th class="table-primary align-middle text-center">Silica <br> mg/ L</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-primary align-middle text-center">Max 3</th>
                                                    <th class="table-primary align-middle text-center">0,18 - 0,30</th>
                                                    <th class="table-primary align-middle text-center">ton/ h</th>
                                                    <th class="table-primary align-middle text-center">6.5 - 8.5</th>
                                                    <th class="table-primary align-middle text-center">≤40</th>

                                                    <th class="table-primary align-middle text-center">≥1,0</th>

                                                    <th class="table-primary align-middle text-center">≤200</th>
                                                    <th class="table-primary align-middle text-center">≥3,0</th>

                                                    <th class="table-primary align-middle text-center">>0.2</th>
                                                    <th class="table-primary align-middle text-center">≤10</th>
                                                    <th class="table-primary align-middle text-center">6,5 - 9.2</th>
                                                    <th class="table-primary align-middle text-center">≤ 0,2</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_e">
                                                <?php if (!isset($dtdetail_e)) {
                                                    if (isset($message)) { ?>
                                                        <!-- data dikosongkan -->
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td><input type="checkbox" name="chk_e[]" class="chk_e" /></td>
                                                            <td><input type="text" name="e1_time[]" id="e1_time" class="form-control w-auto e1_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="e1_startstop[]" id="e1_startstop" class="form-control w-auto e1_startstop" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="e1_turbuditi[]" id="e1_turbuditi " class="form-control w-auto e1_turbuditi " onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="e1_pressure[]" id="e1_pressure" class="form-control w-auto e1_pressure" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="e1_flowmeter[]" id="e1_flowmeter" class="form-control w-auto e1_flowmeter" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="e1_ph[]" id="e1_ph" class="form-control w-auto e1_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="e1_conductivity[]" id="e1_conductivity" class="form-control w-auto e1_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>

                                                            <td><input type="text" name="e2_acidion[]" id="e2_acidion" class="form-control w-auto e2_acidion" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>

                                                            <td><input type="text" name="e3_conductivity[]" id="e3_conductivity" class="form-control w-auto e3_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="e3_ph[]" id="e3_ph" class="form-control w-auto e3_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>

                                                            <td><input type="text" name="e4_acidion[]" id="e4_acidion" class="form-control w-auto e4_acidion" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>

                                                            <td><input type="text" name="e5_conductivity[]" id="e5_conductivity" class="form-control w-auto e5_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="e5_ph[]" id="e5_ph" class="form-control w-auto e5_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="e5_silica[]" id="e5_silica" class="form-control w-auto e5_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                        </tr>
                                                    <?php }
                                                } else {
                                                    foreach ($dtdetail_e as $row) { ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id_e[]" id="detail_id_e" class="detail_id_e" value="<?= $row->detail_id; ?>">
                                                            <td><input type="checkbox" name="chk_e[]" id="chk_e" class="chk_e" value="<?= $row->detail_id; ?>" /></td>
                                                            <td><input type="text" name="e1_time[]" id="e1_time" class="form-control w-auto e1_time clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->e1_time; ?>"></td>
                                                            <td><input type="text" name="e1_startstop[]" id="e1_startstop" class="form-control w-auto e1_startstop" style="text-align: center;" value="<?= $row->e1_startstop; ?>"></td>
                                                            <td><input type="text" name="e1_turbuditi[]" id="e1_turbuditi " class="form-control w-auto e1_turbuditi " onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->e1_turbuditi; ?>"></td>
                                                            <td><input type="text" name="e1_pressure[]" id="e1_pressure" class="form-control w-auto e1_pressure" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->e1_pressure; ?>"></td>
                                                            <td><input type="text" name="e1_flowmeter[]" id="e1_flowmeter" class="form-control w-auto e1_flowmeter" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->e1_flowmeter; ?>"></td>
                                                            <td><input type="text" name="e1_ph[]" id="e1_ph" class="form-control w-auto e1_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->e1_ph; ?>"></td>
                                                            <td><input type="text" name="e1_conductivity[]" id="e1_conductivity" class="form-control w-auto e1_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->e1_conductivity; ?>"></td>

                                                            <td><input type="text" name="e2_acidion[]" id="e2_acidion" class="form-control w-auto e2_acidion" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->e2_acidion; ?>"></td>

                                                            <td><input type="text" name="e3_conductivity[]" id="e3_conductivity" class="form-control w-auto e3_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->e3_conductivity; ?>"></td>
                                                            <td><input type="text" name="e3_ph[]" id="e3_ph" class="form-control w-auto e3_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->e3_ph; ?>"></td>

                                                            <td><input type="text" name="e4_acidion[]" id="e4_acidion" class="form-control w-auto e4_acidion" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->e4_acidion; ?>"></td>

                                                            <td><input type="text" name="e5_conductivity[]" id="e5_conductivity" class="form-control w-auto e5_conductivity" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->e5_conductivity; ?>"></td>
                                                            <td><input type="text" name="e5_ph[]" id="e5_ph" class="form-control w-auto e5_ph" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->e5_ph; ?>"></td>
                                                            <td><input type="text" name="e5_silica[]" id="e5_silica" class="form-control w-auto e5_silica" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->e5_silica; ?>"></td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-primary align-middle text-center" colspan="15" align="center">
                                                        <?php if (!isset($dtdetail)) {
                                                            if ($akses_create == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody_e')">Add Row</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody_e')">Delete Row</button>
                                                            <?php
                                                            }
                                                        } else {
                                                            if ($akses_update == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody_e')">Add Row</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody_e')">Delete Row</button>
                                                            <?php
                                                            }
                                                            if ($akses_delete == '1') { ?>
                                                                <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete_e" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Delete Data</button>
                                                        <?php
                                                            }
                                                        } ?>
                                                    </td>
                                                </tr>
                                            </tfoot>

                                        </table>
                                    </div>
                                </div>

                                <hr>

                                <label for="" class="mb-1">F. Water Analysis Results : Chemical Water Treatment #2</label>
                                <div class="row">
                                    <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                        <table id="myTable" class="table table-bordered table-hover">

                                            <thead class="fixed freeze_vertical">
                                                <tr>
                                                    <th class="table-primary align-middle text-center" rowspan="3">#</th>
                                                    <th class="table-primary align-middle text-center" colspan="6">Flowmeter Demin Process</th>

                                                </tr>
                                                <tr>
                                                    <th class="table-primary align-middle text-center" colspan="2">Time</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">RO</th>
                                                    <th class="table-primary align-middle text-center" colspan="2">Flow</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">Total (m<sup>3</sup>)</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-primary align-middle text-center">Start</th>
                                                    <th class="table-primary align-middle text-center">Stop</th>
                                                    <th class="table-primary align-middle text-center">Start</th>
                                                    <th class="table-primary align-middle text-center">Stop</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_f">
                                                <?php if (!isset($dtdetail_f)) {
                                                    if (isset($message)) { ?>
                                                        <!-- data dikosongkan -->
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td><input type="checkbox" name="chk_f[]" class="chk_f" /></td>
                                                            <td><input type="text" name="f1_timestart[]" id="f1_timestart" class="form-control w-auto f1_timestart clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="f1_timestop[]" id="f1_timestop" class="form-control w-auto f1_timestop clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="f1_ro[]" id="f1_ro" class="form-control w-auto f1_ro" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="f1_flowstart[]" id="f1_flowstart " class="form-control w-auto f1_flowstart hitung_f_total" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="f1_flowstop[]" id="f1_flowstop" class="form-control w-auto f1_flowstop hitung_f_total" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="f1_total[]" id="f1_total" class="form-control w-auto f1_total" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="" readonly></td>
                                                        </tr>
                                                    <?php }
                                                } else {
                                                    foreach ($dtdetail_f as $row) { ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id_f[]" id="detail_id_f" class="detail_id_f" value="<?= $row->detail_id; ?>">
                                                            <td><input type="checkbox" name="chk_f[]" id="chk_f" class="chk_f" value="<?= $row->detail_id; ?>" /></td>
                                                            <td><input type="text" name="f1_timestart[]" id="f1_timestart" class="form-control f1_timestart clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->f1_timestart; ?>"></td>
                                                            <td><input type="text" name="f1_timestop[]" id="f1_timestop" class="form-control f1_timestop clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->f1_timestop; ?>"></td>
                                                            <td><input type="text" name="f1_ro[]" id="f1_ro" class="form-control w-auto f1_ro" style="text-align: center;" value="<?= $row->f1_ro; ?>"></td>
                                                            <td><input type="text" name="f1_flowstart[]" id="f1_flowstart " class="form-control w-auto f1_flowstart hitung_f_total" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->f1_flowstart; ?>"></td>
                                                            <td><input type="text" name="f1_flowstop[]" id="f1_flowstop" class="form-control w-auto f1_flowstop hitung_f_total" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->f1_flowstop; ?>"></td>
                                                            <td><input type="text" name="f1_total[]" id="f1_total" class="form-control w-auto f1_total" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->f1_total; ?>" readonly></td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-primary align-middle text-center" colspan="15" align="center">
                                                        <?php if (!isset($dtdetail)) {
                                                            if ($akses_create == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody_f')">Add Row</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody_f')">Delete Row</button>
                                                            <?php
                                                            }
                                                        } else {
                                                            if ($akses_update == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody_f')">Add Row</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody_f')">Delete Row</button>
                                                            <?php
                                                            }
                                                            if ($akses_delete == '1') { ?>
                                                                <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete_f" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Delete Data</button>
                                                        <?php
                                                            }
                                                        } ?>
                                                    </td>
                                                </tr>
                                            </tfoot>

                                        </table>
                                    </div>
                                </div>

                                <hr>

                                <label for="" class="mb-1">G. Water Analysis Results : Chemical Water Treatment #3</label>
                                <div class="row">
                                    <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                        <table id="myTable" class="table table-bordered table-hover">

                                            <thead class="fixed freeze_vertical">
                                                <tr>
                                                    <th class="table-primary align-middle text-center" rowspan="3">#</th>
                                                    <th class="table-primary align-middle text-center" colspan="6">Flowmeter Blowdown Cooling Tower and Backwash Sand Filter</th>

                                                </tr>
                                                <tr>
                                                    <th class="table-primary align-middle text-center" colspan="2">Time</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">Note</th>
                                                    <th class="table-primary align-middle text-center" colspan="2">Flow</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">Total (m<sup>3</sup>)</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-primary align-middle text-center">Start</th>
                                                    <th class="table-primary align-middle text-center">Stop</th>
                                                    <th class="table-primary align-middle text-center">Start</th>
                                                    <th class="table-primary align-middle text-center">Stop</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_g">
                                                <?php if (!isset($dtdetail_g)) {
                                                    if (isset($message)) { ?>
                                                        <!-- data dikosongkan -->
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td><input type="checkbox" name="chk_g[]" class="chk_g" /></td>
                                                            <td><input type="text" name="g1_timestart[]" id="g1_timestart" class="form-control w-auto g1_timestart clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="g1_timestop[]" id="g1_timestop" class="form-control w-auto g1_timestop clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="g1_note[]" id="g1_note" class="form-control w-auto g1_note" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="g1_flowstart[]" id="g1_flowstart " class="form-control w-auto g1_flowstart hitung_g_total" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="g1_flowstop[]" id="g1_flowstop" class="form-control w-auto g1_flowstop hitung_g_total" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                            <td><input type="text" name="g1_total[]" id="g1_total" class="form-control w-auto g1_total" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="" readonly></td>
                                                        </tr>
                                                    <?php }
                                                } else {
                                                    foreach ($dtdetail_g as $row) { ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id_g[]" id="detail_id_g" class="detail_id_g" value="<?= $row->detail_id; ?>">
                                                            <td><input type="checkbox" name="chk_g[]" id="chk_g" class="chk_g" value="<?= $row->detail_id; ?>" /></td>
                                                            <td><input type="text" name="g1_timestart[]" id="g1_timestart" class="form-control g1_timestart clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->g1_timestart; ?>"></td>
                                                            <td><input type="text" name="g1_timestop[]" id="g1_timestop" class="form-control g1_timestop clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->g1_timestop; ?>"></td>
                                                            <td><input type="text" name="g1_note[]" id="g1_note" class="form-control w-auto g1_note" style="text-align: center;" value="<?= $row->g1_note; ?>"></td>
                                                            <td><input type="text" name="g1_flowstart[]" id="g1_flowstart " class="form-control w-auto g1_flowstart hitung_g_total" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->g1_flowstart; ?>"></td>
                                                            <td><input type="text" name="g1_flowstop[]" id="g1_flowstop" class="form-control w-auto g1_flowstop hitung_g_total" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->g1_flowstop; ?>"></td>
                                                            <td><input type="text" name="g1_total[]" id="g1_total" class="form-control w-auto g1_total" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $row->g1_total; ?>" readonly></td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-primary align-middle text-center" colspan="15" align="center">
                                                        <?php if (!isset($dtdetail)) {
                                                            if ($akses_create == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody_g')">Add Row</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody_g')">Delete Row</button>
                                                            <?php
                                                            }
                                                        } else {
                                                            if ($akses_update == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody_g')">Add Row</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody_g')">Delete Row</button>
                                                            <?php
                                                            }
                                                            if ($akses_delete == '1') { ?>
                                                                <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete_g" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Delete Data</button>
                                                        <?php
                                                            }
                                                        } ?>
                                                    </td>
                                                </tr>
                                            </tfoot>

                                        </table>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-8">
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-warning">
                                                <tr>
                                                    <th>Notifications :</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <textarea name="notification" id="notification" class="form-control notification" cols="30" rows="10"><?= $notification; ?></textarea>
                                                    </td>
                                                <tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-warning">
                                                <tr>
                                                    <th colspan="3">Total of Used Water :</th>
                                                </tr>
                                                <tr>
                                                    <td>SHIFT I ( Morning)</td>
                                                    <td><input type="text" name="shift_1" id="shift_1" class="form-control shift_1 hitung_total_usedwater" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $shift_1; ?>" size="3"></td>
                                                    <td>M<sup>3</sup></td>
                                                </tr>
                                                <tr>
                                                    <td>SHIFT II ( Afternoon)</td>
                                                    <td><input type="text" name="shift_2" id="shift_2" class="form-control shift_2 hitung_total_usedwater" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $shift_2; ?>" size="3"></td>
                                                    <td>M<sup>3</sup></td>
                                                </tr>
                                                <tr>
                                                    <td>SHIFT III ( Night)</td>
                                                    <td><input type="text" name="shift_3" id="shift_3" class="form-control shift_3 hitung_total_usedwater" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $shift_3; ?>" size="3"></td>
                                                    <td>M<sup>3</sup></td>
                                                </tr>
                                                <tr>
                                                    <th>TOTAL :</th>
                                                    <td><input type="text" name="total_usedwater" id="total_usedwater" class="form-control total_usedwater" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?= $total_usedwater; ?>" size="3" readonly></td>
                                                    <td>M<sup>3</sup></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-1">
                                <div class="col-12">
                                    <?php if (!isset($dtheader)) {
                                        if (!isset($message)) {
                                            if ($akses_create == '1') { ?>
                                                <button type="submit" class="btn bg-gradient-primary" id="btnsimpan">
                                                    <i class="feather icon-save"></i> Save</button>

                                                <button type="reset" class="btn bg-gradient-light">
                                                    <i class="feather icon-refresh-ccw"></i> Cancel</button>
                                            <?php }
                                        } else {/*No Acess Create*/
                                        }
                                    } else {
                                        // tombol sesuaikan dengan halaman shift
                                        if ($akses_update == '1') { ?>
                                            <button type="submit" class="btn bg-gradient-primary" name="btnproses" value="btnupdate" onclick="return confirm('Save Data ?')">
                                                <i class="feather icon-save"></i> Save
                                            </button>
                                            <button type="submit" class="btn bg-gradient-info" name="btnproses" value="btncomplete" onclick="return confirm('Complete Data ?')">
                                                <i class="feather icon-check-square"></i> Complete
                                            </button>
                                        <?php } else {/*No Acess Update*/
                                        }
                                        if ($akses_excel == '1') { ?>
                                            <a class="btn bg-gradient-success" href="<?= base_url('export_excel/C_export_toexcel_' . $frmkd . '_' . $frmvrs . '/exportxls/' . $frmkd . '/' . $frmvrs . '/' . $headerid) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
                                    <?php } else {/*No Acess Excel*/
                                        }
                                    } ?>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <span class="pull-left">Effective date on <?= $frmefec; ?></span>
                                    <a href="?#"><span class="pull-right"><?= $frmnm . '-' . $frmvrs; ?></span></a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

<?php $this->load->view('template/footbar'); ?>

<script>
    $(document).ready(function() {
        $('form').submit(function() {
            var input_headerid = $('#headerid').val();
            if (typeof(input_headerid) == "undefined") {
                $(this).find("button[type='submit']").prop('disabled', true);
            }
        });

        $('.4angkasaja').mask("0000", {
            placeholder: ""
        });

        $(document).on('keyup', '.angkadantitik', function() {
            this.value = this.value.replace(/[^\d.]/g, '');
        });

        get_docno();
    });

    $('.create_date').change(function() {
        get_docno();
    });

    function get_docno() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn022_06/get_docno/inttbn022/06",
                data: {
                    create_date
                },
                async: false,
                success: function(data) {
                    $('.docno').val(JSON.parse(data)['data']);
                }
            });
        }
    }

    // MENCARI NILAI TOTAL
    $(document).on('keyup', '.hitung_f_total', function() {
        let f1_flowstop = $(this).closest('tr').find('.f1_flowstop').val();
        let f1_flowstart = $(this).closest('tr').find('.f1_flowstart').val();

        let f_total_fix = (parseFloat(f1_flowstop) - parseFloat(f1_flowstart)).toFixed(2);
        $(this).closest('tr').find('.f1_total').val(isNaN(f_total_fix) ? '' : f_total_fix);
    });
    $(document).on('keyup', '.hitung_g_total', function() {
        let g1_flowstop = $(this).closest('tr').find('.g1_flowstop').val();
        let g1_flowstart = $(this).closest('tr').find('.g1_flowstart').val();

        let g_total_fix = (parseFloat(g1_flowstop) - parseFloat(g1_flowstart)).toFixed(2);
        $(this).closest('tr').find('.g1_total').val(isNaN(g_total_fix) ? '' : g_total_fix);
    });
    // AKHIR MENCARI NILAI TOTAL

    // MENCARI NILAI TOTAL USED WATER
    $(document).on('keyup', '.hitung_total_usedwater', function() {
        let shift_1 = $('.shift_1').val();
        let shift_2 = $('.shift_2').val();
        let shift_3 = $('.shift_3').val();
        if (shift_1 == '') {
            var shift_1_n = '0';
        } else {
            var shift_1_n = shift_1;
        }
        if (shift_2 == '') {
            var shift_2_n = '0';
        } else {
            var shift_2_n = shift_2;
        }
        if (shift_3 == '') {
            var shift_3_n = '0';
        } else {
            var shift_3_n = shift_3;
        }

        let total_usedwater_fix = (parseFloat(shift_1_n) + parseFloat(shift_2_n) + parseFloat(shift_3_n)).toFixed(2);
        $('#total_usedwater').val(total_usedwater_fix);
    });
    // AKHIR MENCARI NILAI TOTAL USED WATER

    function DisableKey(e, type) {
        let desimal = e.charCode ? e.charCode : e.keyCode;
        // decimal
        if (type == 'alphabet') {
            // tombol Backspace, Tap, titik, slash, tanda hubung, spcae, dan petik dua diperbolehkan
            // desimal == 39 ' desimal == 44 , desimal == 45 - desimal == 46 . desimal == 47 / desimal == 96 ` desimal == 32 spasi desimal == 34 " 
            if (desimal == 34 || desimal == 8 || desimal == 9 || desimal == 32 || desimal == 45 || desimal == 46 || desimal == 96) {
                return true;
            } else {
                // jika bukan huruf
                if ((desimal < 65 || desimal > 90) && (desimal < 97 || desimal > 122)) {
                    return false; // matikan tombol
                }
            }
        } else {
            if (desimal == 45 || desimal == 46 || desimal == 8 || desimal == 9) {
                // jika menekan tombol Backspace, Tap, titik diperbolehkan
                return true;
            } else {
                // jika bukan angka
                if (desimal < 48 || desimal > 57) {
                    return false; // matikan tombol
                }
            }
        }
    }

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode >= 46 && charCode <= 57)
            if (charCode != 47) {
                return true;
            } else {
                return false;
            }
        return false;
    }
</script>

<?php $this->load->view('template/footbarend'); ?>