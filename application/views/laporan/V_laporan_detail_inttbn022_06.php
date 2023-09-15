<?php $this->load->view('template/headbar'); ?>

<?php foreach ($dtfrm as $dt_form) {
    $frmjdl       = $dt_form->formjudul;
    $frmefec      = date("d-m-Y", strtotime($dt_form->formefective));
    $frmnm        = $dt_form->formnm;
    $frmkd        = $dt_form->formkd;
    $frmvrs       = $dt_form->formversi;
    $akses_create = $dt_form->form_create;
    $akses_update = $dt_form->form_update;
    $akses_delete = $dt_form->form_delete;
    $akses_excel  = $dt_form->form_excel;
}

foreach ($dtheader as $header) {
    $headerid = $header->headerid;

    $comment      = $header->comment;
    $comment_by   = $header->comment_by;
    $comment_time = $header->comment_time;
    $comment_date = date("d-m-Y", strtotime($header->comment_date));

    $create_date     = date("d-m-Y", strtotime($header->create_date));
    $docno           = $header->docno;
    $notification    = $header->notification;
    $shift_1         = $header->shift_1;
    $shift_2         = $header->shift_2;
    $shift_3         = $header->shift_3;
    $total_usedwater = $header->total_usedwater;
}  ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content mt-2">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="col-md-2 content-center mt-1">
                            <table class="table table-condensed">
                                <tr>
                                    <td style="text-align:center; font-weight: bold;">
                                        <img src="<?= base_url('assets/images/PSG_logo_2022.png') ?>" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-7 d-flex content-center">
                            <table class="table table-condensed">
                                <tr>
                                    <td style="text-align:center; font-weight: bold;">
                                        <h2><?= $this->config->item("nama_perusahaan"); ?></h2>
                                        <h4>DEPARTEMEN PWP-TBN</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:center; font-weight: bold;">
                                        <h4><?= $frmjdl; ?></h4>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3 d-flex content-center">
                            <table class="table table-condensed">
                                <tr>
                                    <td style="text-align:left; font-weight: bold;">Date</td>
                                    <td style="text-align:left; font-weight: bold;">: <?php echo $create_date; ?> </td>
                                </tr>
                                <tr>
                                    <td style="text-align:left; font-weight: bold;">Doc</td>
                                    <td style="text-align:left; font-weight: bold;">: <?php echo $docno; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-12" align="left">
                        <?php if (isset($leftheader)) {
                            echo '<td style="text-align:left; font-weight: bold;"><b>';
                            foreach ($leftheader as $rowleft) {
                                echo $rowleft . '</br>';
                            }
                            echo "</b></td>"; ?>
                        <?php } elseif (isset($comment)) { ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Laporan ini Sebelumnya telah Disapprove oleh <?php echo $comment_by; ?>, pada
                                    <?php echo $comment_date; ?> <?php echo $comment_time; ?>, komentar : <?php echo $comment; ?></strong>
                            </div>
                        <?php
                        } ?>
                    </div>
                    <?php //$this->load->view('template/V_onprocess'); 
                    ?>

                    <div class="card-body">

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
                        <div class="col-12">
                            <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="fixed freeze_vertical">

                                        <?= $thead; ?>

                                    </thead>
                                    <tbody id="">
                                        <?php
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
                                                <input type="hidden" name="detail_id[]" id="detail_id" value="<?= $row->detail_id; ?>">

                                                <td style=" text-align: center;"><?= $row->a1_time; ?></td>
                                                <td style=" text-align: center;"><?= $row->a1_alkalinity; ?></td>
                                                <td style=" text-align: center;"><?= $row->a1_ph; ?></td>
                                                <td style=" text-align: center;"><?= $row->a1_conductivity; ?></td>
                                                <td style=" text-align: center;"><?= $row->a1_thardness; ?></td>
                                                <td style=" text-align: center;"><?= $row->a1_dissolvedoxygen; ?></td>
                                                <td style=" text-align: center; <?= $collor; ?>"><?= $row->a1_silica; ?></td>
                                                <td style=" text-align: center; <?= $collor; ?>"><?= $row->a1_fe; ?></td>

                                                <td style="text-align: center;"><?= $row->a2_time; ?></td>
                                                <td style="text-align: center;"><?= $row->a2_alkalinityp; ?></td>
                                                <td style="text-align: center;"><?= $row->a2_alkalinitym; ?></td>
                                                <td style="text-align: center;"><?= $row->a2_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->a2_conductivity; ?></td>
                                                <td style="text-align: center;"><?= $row->a2_ion; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->a2_silica; ?></td>

                                                <td style="text-align: center;"><?= $row->a3_time; ?></td>
                                                <td style="text-align: center;"><?= $row->a3_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->a3_conductivity; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->a3_silica; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->a3_fe; ?></td>

                                                <td style="text-align: center;"><?= $row->a4_time; ?></td>
                                                <td style="text-align: center;"><?= $row->a4_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->a4_conductivity; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->a4_silica; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->a4_fe; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <label for="" class="mb-1">B. Water Analyis Results : BOILER #2</label>
                        <div class="col-12">
                            <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="fixed freeze_vertical">

                                        <?= $thead; ?>

                                    </thead>
                                    <tbody id="">
                                        <?php
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
                                                <input type="hidden" name="detail_id_b[]" id="detail_id_b" class="detail_id_b form-control w-auto" style="text-align: center;" value="<?= $row->detail_id; ?>">

                                                <td style="text-align: center;"><?= $row->b1_time; ?></td>
                                                <td style="text-align: center;"><?= $row->b1_alkalinity; ?></td>
                                                <td style="text-align: center;"><?= $row->b1_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->b1_conductivity; ?></td>
                                                <td style="text-align: center;"><?= $row->b1_thardness; ?></td>
                                                <td style="text-align: center;"><?= $row->b1_dissolvedoxygen; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->b1_silica; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->b1_fe; ?></td>

                                                <td style="text-align: center;"><?= $row->b2_time; ?></td>
                                                <td style="text-align: center;"><?= $row->b2_alkalinityp; ?></td>
                                                <td style="text-align: center;"><?= $row->b2_alkalinitym; ?></td>
                                                <td style="text-align: center;"><?= $row->b2_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->b2_conductivity; ?></td>
                                                <td style="text-align: center;"><?= $row->b2_ion; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->b2_silica; ?></td>

                                                <td style="text-align: center;"><?= $row->b3_time; ?></td>
                                                <td style="text-align: center;"><?= $row->b3_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->b3_conductivity; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->b3_silica; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->b3_fe; ?></td>

                                                <td style="text-align: center;"><?= $row->b4_time; ?></td>
                                                <td style="text-align: center;"><?= $row->b4_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->b4_conductivity; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->b4_silica; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->b4_fe; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <label for="" class="mb-1">C. Water Analyis Results : BOILER #3</label>
                        <div class="col-12">
                            <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                <table class="table table-bordered table-striped table-hover">
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
                                            <th class="table-danger align-middle text-center">≤ 0,5 Max</th>
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
                                    <tbody id="">
                                        <?php
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
                                                <input type="hidden" name="detail_id_c[]" id="detail_id_c" class="detail_id_c form-control w-auto" style="text-align: center;" value="<?= $row->detail_id; ?>">

                                                <td style="text-align: center;"><?= $row->c1_time; ?></td>
                                                <td style="text-align: center;"><?= $row->c1_alkalinity; ?></td>
                                                <td style="text-align: center;"><?= $row->c1_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->c1_conductivity; ?></td>
                                                <td style="text-align: center;"><?= $row->c1_thardness; ?></td>
                                                <td style="text-align: center;"><?= $row->c1_dissolvedoxygen; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->c1_silica; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->c1_fe; ?></td>

                                                <td style="text-align: center;"><?= $row->c2_time; ?></td>
                                                <td style="text-align: center;"><?= $row->c2_alkalinityp; ?></td>
                                                <td style="text-align: center;"><?= $row->c2_alkalinitym; ?></td>
                                                <td style="text-align: center;"><?= $row->c2_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->c2_conductivity; ?></td>
                                                <td style="text-align: center;"><?= $row->c2_ion; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->c2_silica; ?></td>

                                                <td style="text-align: center;"><?= $row->c3_time; ?></td>
                                                <td style="text-align: center;"><?= $row->c3_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->c3_conductivity; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->c3_silica; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->c3_fe; ?></td>

                                                <td style="text-align: center;"><?= $row->c4_time; ?></td>
                                                <td style="text-align: center;"><?= $row->c4_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->c4_conductivity; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->c4_silica; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->c4_fe; ?></td>

                                                <td style="text-align: center;"><?= $row->c5_time; ?></td>
                                                <td style="text-align: center;"><?= $row->c5_conductivity; ?></td>
                                                <td style="text-align: center;"><?= $row->c5_thardness; ?></td>
                                                <td style="text-align: center;"><?= $row->c5_ph; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <label for="" class="mb-1">D. Water Analyis Results</label>
                        <div class="col-12">
                            <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                <table class="table table-bordered table-striped table-hover">
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
                                    <tbody id="">
                                        <?php
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
                                                <input type="hidden" name="detail_id_d[]" id="detail_id_d" class="detail_id_d form-control w-auto" style="text-align: center;" value="<?= $row->detail_id; ?>">

                                                <td style="text-align: center;"><?= $row->d1_time; ?></td>
                                                <td style="text-align: center;"><?= $row->d1_thardness; ?></td>
                                                <td style="text-align: center;"><?= $row->d1_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->d1_conductivity; ?></td>
                                                <td style="text-align: center;"><?= $row->d1_dissolvedoxygen; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->d1_silica; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->d1_fe; ?></td>

                                                <td style="text-align: center;"><?= $row->d2_time; ?></td>
                                                <td style="text-align: center;"><?= $row->d2_thardness; ?></td>
                                                <td style="text-align: center;"><?= $row->d2_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->d2_conductivity; ?></td>
                                                <td style="text-align: center;"><?= $row->d2_dissolvedoxygen; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->d2_silica; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->d2_fe; ?></td>

                                                <td style="text-align: center;"><?= $row->d3_time; ?></td>
                                                <td style="text-align: center;"><?= $row->d3_alkalinity; ?></td>
                                                <td style="text-align: center;"><?= $row->d3_conductivity; ?></td>
                                                <td style="text-align: center;"><?= $row->d3_thardness; ?></td>
                                                <td style="text-align: center;"><?= $row->d3_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->d3_suhu_inlet; ?></td>
                                                <td style="text-align: center;"><?= $row->d3_suhu_outlet; ?></td>
                                                <td style="text-align: center; <?= $collor_2; ?>"><?= $row->d3_turbuditi; ?></td>
                                                <td style="text-align: center; <?= $collor_2; ?>"><?= $row->d3_ci; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->d3_freeci2; ?></td>

                                                <td style="text-align: center;"><?= $row->d4_time; ?></td>
                                                <td style="text-align: center;"><?= $row->d4_thardness; ?></td>
                                                <td style="text-align: center;"><?= $row->d4_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->d4_conductivity; ?></td>
                                                <td style="text-align: center; <?= $collor_2; ?>"><?= $row->d4_turbuditi; ?></td>
                                                <td style="text-align: center; <?= $collor_2; ?>"><?= $row->d4_ci; ?></td>
                                                <td style="text-align: center; <?= $collor; ?>"><?= $row->d4_freeci2; ?></td>

                                                <td style="text-align: center;"><?= $row->d5_time; ?></td>
                                                <td style="text-align: center;"><?= $row->d5_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->d5_conductivity; ?></td>
                                                <td style="text-align: center;"><?= $row->d5_hardness; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <label for="" class="mb-1">E. Water Analysis Results : Chemical Water Treatment #1</label>
                        <div class="col-12">
                            <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="fixed freeze_vertical">
                                        <tr>
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
                                    <tbody id="">
                                        <?php foreach ($dtdetail_e as $row) { ?>
                                            <tr>
                                                <input type="hidden" name="detail_id_e[]" id="detail_id_e" class="detail_id_e form-control w-auto" style="text-align: center;" value="<?= $row->detail_id; ?>">

                                                <td style="text-align: center;"><?= $row->e1_time; ?></td>
                                                <td style="text-align: center;"><?= $row->e1_startstop; ?></td>
                                                <td style="text-align: center;"><?= $row->e1_turbuditi; ?></td>
                                                <td style="text-align: center;"><?= $row->e1_pressure; ?></td>
                                                <td style="text-align: center;"><?= $row->e1_flowmeter; ?></td>
                                                <td style="text-align: center;"><?= $row->e1_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->e1_conductivity; ?></td>

                                                <td style="text-align: center;"><?= $row->e2_acidion; ?></td>

                                                <td style="text-align: center;"><?= $row->e3_conductivity; ?></td>
                                                <td style="text-align: center;"><?= $row->e3_ph; ?></td>

                                                <td style="text-align: center;"><?= $row->e4_acidion; ?></td>

                                                <td style="text-align: center;"><?= $row->e5_conductivity; ?></td>
                                                <td style="text-align: center;"><?= $row->e5_ph; ?></td>
                                                <td style="text-align: center;"><?= $row->e5_silica; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <label for="" class="mb-1">F. Water Analysis Results : Chemical Water Treatment #2</label>
                        <div class="col-12">
                            <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="fixed freeze_vertical">
                                        <tr>
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
                                    <tbody id="">
                                        <?php foreach ($dtdetail_f as $row) { ?>
                                            <tr>
                                                <input type="hidden" name="detail_id_f[]" id="detail_id_f" class="detail_id_f form-control w-auto" style="text-align: center;" value="<?= $row->detail_id; ?>">

                                                <td style="text-align: center;"><?= $row->f1_timestart; ?></td>
                                                <td style="text-align: center;"><?= $row->f1_timestop; ?></td>
                                                <td style="text-align: center;"><?= $row->f1_ro; ?></td>
                                                <td style="text-align: center;"><?= $row->f1_flowstart; ?></td>
                                                <td style="text-align: center;"><?= $row->f1_flowstop; ?></td>
                                                <td style="text-align: center;"><?= $row->f1_total; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <label for="" class="mb-1">G. Water Analysis Results : Chemical Water Treatment #3</label>
                        <div class="col-12">
                            <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="fixed freeze_vertical">
                                        <tr>
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
                                    <tbody id="">
                                        <?php foreach ($dtdetail_g as $row) { ?>
                                            <tr>
                                                <input type="hidden" name="detail_id_g[]" id="detail_id_g" class="detail_id_g form-control w-auto" style="text-align: center;" value="<?= $row->detail_id; ?>">

                                                <td style="text-align: center;"><?= $row->g1_timestart; ?></td>
                                                <td style="text-align: center;"><?= $row->g1_timestop; ?></td>
                                                <td style="text-align: center;"><?= $row->g1_note; ?></td>
                                                <td style="text-align: center;"><?= $row->g1_flowstart; ?></td>
                                                <td style="text-align: center;"><?= $row->g1_flowstop; ?></td>
                                                <td style="text-align: center;"><?= $row->g1_total; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                    <table class="table table-bordered table-hover table-warning">
                                        <thead class="fixed freeze_vertical">
                                            <tr>
                                                <th>Notifications :</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            <tr>
                                                <td>
                                                    <textarea name="notification" id="notification" class="form-control notification" cols="30" rows="10" readonly><?= $notification; ?></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                    <table class="table table-bordered table-hover table-warning">
                                        <thead class="fixed freeze_vertical">
                                            <tr>
                                                <th colspan="3">Total of Used Water :</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            <tr>
                                                <td>SHIFT I ( Morning)</td>
                                                <td><input type="number" name="shift_1" id="shift_1" class="form-control shift_1" style="text-align: center;" value="<?= $shift_1; ?>" size="3" readonly></td>
                                                <td>M<sup>3</sup></td>
                                            </tr>
                                            <tr>
                                                <td>SHIFT II ( Afternoon)</td>
                                                <td><input type="number" name="shift_2" id="shift_2" class="form-control shift_2" style="text-align: center;" value="<?= $shift_2; ?>" size="3" readonly></td>
                                                <td>M<sup>3</sup></td>
                                            </tr>
                                            <tr>
                                                <td>SHIFT III ( Night)</td>
                                                <td><input type="number" name="shift_3" id="shift_3" class="form-control shift_3" style="text-align: center;" value="<?= $shift_3; ?>" size="3" readonly></td>
                                                <td>M<sup>3</sup></td>
                                            </tr>
                                            <tr>
                                                <th>TOTAL :</th>
                                                <td><input type="number" name="total_usedwater" id="total_usedwater" class="form-control total_usedwater" style="text-align: center;" value="<?= $total_usedwater; ?>" size="3" readonly></td>
                                                <td>M<sup>3</sup></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <?php $this->load->view('laporan/V_laporan_definisi'); ?>

                        <div class="row mt-2">
                            <div class="col-12" align="center">
                                <?php $this->load->view('approval/V_tabelapp'); ?>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12" align="right">
                                <?php if ($akses_excel == '1') { ?>
                                    <a class="btn bg-gradient-info" href="#" title="Export to Pdf" target="_blank" onclick="return confirm('EXPORT TO PDF... ?')"><i class="fa fa-file-pdf-o"></i> Export to Pdf</a>
                                    <a class="btn bg-gradient-success" href="<?= base_url('export_excel/C_export_toexcel_' . $frmkd . '_' . $frmvrs . '/exportxls/' . $frmkd . '/' . $frmvrs . '/' . $headerid) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
                                <?php } else {/*No Acess Excel*/
                                } ?>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <span class="pull-left">Effective date on <?= $frmefec; ?></span>
                                <a href="?#"><span class="pull-right"><?= $frmnm . '-' . $frmvrs; ?></span></a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->

<?php $this->load->view('template/footbar'); ?>

<?php $this->load->view('template/footbarend'); ?>