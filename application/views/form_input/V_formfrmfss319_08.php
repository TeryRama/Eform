<?php $this->load->view('template/headbar'); ?>

<?php foreach ($dtfrm as $dt_form) {
    $frmjdl                   = $dt_form->formjudul;
    $frmefec                  = date("d-m-Y", strtotime($dt_form->formefective));
    $frmnm                    = $dt_form->formnm;
    $frmkd                    = $dt_form->formkd;
    $frmvrs                   = $dt_form->formversi;
    $akses_create             = $dt_form->form_create;
    $akses_update             = $dt_form->form_update;
    $akses_delete             = $dt_form->form_delete;
    $akses_excel              = $dt_form->form_excel;
    $frmket                   = $dt_form->formket;
    $createby                 = $dt_form->createby;
    $updateby                 = $dt_form->updateby;
}

if (isset($dtheader)) {
    $aksi                     = "dtupdate";

    foreach ($dtheader as $header) {
        $headerid                   = $header->headerid;

        $comment                    = $header->comment;
        $comment_by                 = $header->comment_by;
        $comment_time               = $header->comment_time;
        $comment_date               = date("d-m-Y", strtotime($header->comment_date));

        $create_date                = date("d-m-Y", strtotime($header->create_date));
        $bulan                      = date('M', strtotime($header->create_date));
        $docno                      = $header->docno;

        $selisih_opname             = $header->selisih_opname;
        $total_dtlb_penerimaan_kg   = $header->total_dtlb_penerimaan_kg;
        $total_dtlb_penerimaan_akm  = $header->total_dtlb_penerimaan_akm;
        $total_dtlb_pemakaian_kg    = $header->total_dtlb_pemakaian_kg;
        $total_dtlb_pemakaian_akm   = $header->total_dtlb_pemakaian_akm;
        $stock_akhir_tmp            = $header->stock_akhir_tmp;

        $total_dtlc_total_jam       = $header->total_dtlc_total_jam;
        $total_dtlc_jam_akm         = $header->total_dtlc_jam_akm;
        $total_dtlc_tmpr_kg         = $header->total_dtlc_tmpr_kg;
        $total_dtlc_tmpr_akm        = $header->total_dtlc_tmpr_akm;
        $total_dtlc_steam_ton       = $header->total_dtlc_steam_ton;
        $total_dtlc_steam_akm       = $header->total_dtlc_steam_akm;
        $total_dtlc_total_air       = $header->total_dtlc_total_air;
        $total_dtlc_air_akm         = $header->total_dtlc_air_akm;

        $total_dtld_tmpr_kg         = $header->total_dtld_tmpr_kg;
        $total_dtld_tmpr_akm        = $header->total_dtld_tmpr_akm;
        $total_dtld_steam_ton       = $header->total_dtld_steam_ton;
        $total_dtld_steam_akm       = $header->total_dtld_steam_akm;
        $total_dtld_total_air       = $header->total_dtld_total_air;
        $total_dtld_air_akm         = $header->total_dtld_air_akm;

        $air_dearator               = $header->air_dearator;
        $air_wtd                    = $header->air_wtd;
        $air_condensate             = $header->air_condensate;
        $air_blr                    = $header->air_blr;
        $total_return               = $header->total_return;
        $prsn_air_wtd               = $header->prsn_air_wtd;
        $prsn_air_condensate        = $header->prsn_air_condensate;
        $prsn_air_blr               = $header->prsn_air_blr;
        $realisasi                  = $header->realisasi;
        $temp_bulan_lalu            = $header->temp_bulan_lalu;
        $stock_awal_temp            = $header->stock_awal_temp;
    }
} else if (isset($message)) {
    $aksi                       = "dtsave";

    $create_date                = '';
    $bulan                      = '';
    $docno                      = '';
    $selisih_opname             = '';
    $total_dtlb_penerimaan_kg   = '';
    $total_dtlb_penerimaan_akm  = '';
    $total_dtlb_pemakaian_kg    = '';
    $total_dtlb_pemakaian_akm   = '';
    $stock_akhir_tmp            = '';

    $total_dtlc_total_jam       = '';
    $total_dtlc_jam_akm         = '';
    $total_dtlc_tmpr_kg         = '';
    $total_dtlc_tmpr_akm        = '';
    $total_dtlc_steam_ton       = '';
    $total_dtlc_steam_akm       = '';
    $total_dtlc_total_air       = '';
    $total_dtlc_air_akm         = '';

    $total_dtld_tmpr_kg         = '';
    $total_dtld_tmpr_akm        = '';
    $total_dtld_steam_ton       = '';
    $total_dtld_steam_akm       = '';
    $total_dtld_total_air       = '';
    $total_dtld_air_akm         = '';

    $air_dearator               = '';
    $air_wtd                    = '';
    $air_condensate             = '';
    $air_blr                    = '';
    $total_return               = '';
    $prsn_air_wtd               = '';
    $prsn_air_condensate        = '';
    $prsn_air_blr               = '';
    $realisasi                  = '';
    $temp_bulan_lalu            = '';
    $stock_awal_temp            = '';
} else {
    $aksi                       = "dtsave";
    $create_date                = date("d-m-Y", strtotime($dtcreate_date));
    $bulan                      = date('M', strtotime($dtcreate_date));
    $docno                      = '';
    $selisih_opname             = '';
    $total_dtlb_penerimaan_kg   = '';
    $total_dtlb_penerimaan_akm  = '';
    $total_dtlb_pemakaian_kg    = '';
    $total_dtlb_pemakaian_akm   = '';
    $stock_akhir_tmp            = '';

    $total_dtlc_total_jam       = '';
    $total_dtlc_jam_akm         = '';
    $total_dtlc_tmpr_kg         = '';
    $total_dtlc_tmpr_akm        = '';
    $total_dtlc_steam_ton       = '';
    $total_dtlc_steam_akm       = '';
    $total_dtlc_total_air       = '';
    $total_dtlc_air_akm         = '';

    $total_dtld_tmpr_kg         = '';
    $total_dtld_tmpr_akm        = '';
    $total_dtld_steam_ton       = '';
    $total_dtld_steam_akm       = '';
    $total_dtld_total_air       = '';
    $total_dtld_air_akm         = '';

    $air_dearator               = '';
    $air_wtd                    = '';
    $air_condensate             = '';
    $air_blr                    = '';
    $total_return               = '';
    $prsn_air_wtd               = '';
    $prsn_air_condensate        = '';
    $prsn_air_blr               = '';
    $realisasi                  = '';
    $temp_bulan_lalu            = '';
    $stock_awal_temp            = '';
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
                        <?php
                        } elseif (isset($message2)) { ?>
                            <div class="alert alert-danger mb-3" role="alert">
                                <h4 class="alert-heading">Warning!</h4>
                                <p class="mb-0">
                                    <?= $message2; ?>
                                </p>
                            </div>
                        <?php
                        } elseif (isset($comment)) { ?>
                            <div class="alert alert-danger mb-3" role="alert">
                                <h4 class="alert-heading">Warning!</h4>
                                <p class="mb-0">
                                    Laporan ini Sebelumnya telah Disapprove oleh <?= $comment_by; ?>, pada
                                    <?= $comment_date; ?> <?= $comment_time; ?>, komentar : <?= $comment; ?>
                                </p>
                            </div>
                        <?php
                        } ?>

                        <div class="col-12" align="center">
                            <?php if ($frmket == 'In-Progress') { ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Eform ini Masih Dalam Prosess Development oleh <i><?= $createby; ?> </i> ( Programmer ) !!</strong>
                                </div>
                            <?php
                            } elseif ($frmket == 'Trial') {
                            ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Eform Ini Masih dalam Prosess Trial !!</strong>
                                </div>
                            <?php
                            } elseif ($frmket == "Modified") {
                            ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Eform Ini Masih Prosess Revisi oleh <i><?= $createby; ?></i> ( Programmer ) !!</strong>
                                </div>
                            <?php
                            } ?>
                        </div>

                        <form action="<?= base_url('form_input/C_formfrmfss319_08/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="frmfss319" name="frmfss319" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
                            <div class="row mb-1">
                                <div class="col-6">
                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?= $headerid; ?>" id="headerid" class="headerid">
                                    <?php
                                    } ?>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Tanggal Laporan
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($dtheader)) { ?>
                                                <input type="text" name="create_date" id="create_date" class="form-control create_date" value="<?= $create_date; ?>" required readonly>
                                            <?php } else { ?>
                                                <input type="text" name="create_date" id="create_date" class="form-control datepicker maskdate create_date" value="<?= $create_date; ?>" required>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            No. Dokumen
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="docno" id="docno" class="form-control docno dtopen_blok" value="<?= $docno; ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <!-- <th class="table-primary align-middle text-center" rowspan="3">#</th> -->
                                                    <th class="table-primary align-middle text-center" rowspan="3">Operasional Boiler</th>
                                                    <th class="table-primary align-middle text-center" rowspan="1" colspan="24">Tekanan Perjam</th>
                                                    <th class="table-primary align-middle text-center" rowspan="3">Keterangan</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-primary align-middle text-center">07</th>
                                                    <th class="table-primary align-middle text-center">08</th>
                                                    <th class="table-primary align-middle text-center">09</th>
                                                    <th class="table-primary align-middle text-center">10</th>
                                                    <th class="table-primary align-middle text-center">11</th>
                                                    <th class="table-primary align-middle text-center">12</th>
                                                    <th class="table-primary align-middle text-center">13</th>
                                                    <th class="table-primary align-middle text-center">14</th>
                                                    <th class="table-primary align-middle text-center">15</th>
                                                    <th class="table-primary align-middle text-center">16</th>
                                                    <th class="table-primary align-middle text-center">17</th>
                                                    <th class="table-primary align-middle text-center">18</th>
                                                    <th class="table-primary align-middle text-center">19</th>
                                                    <th class="table-primary align-middle text-center">20</th>
                                                    <th class="table-primary align-middle text-center">21</th>
                                                    <th class="table-primary align-middle text-center">22</th>
                                                    <th class="table-primary align-middle text-center">23</th>
                                                    <th class="table-primary align-middle text-center">24</th>
                                                    <th class="table-primary align-middle text-center">01</th>
                                                    <th class="table-primary align-middle text-center">02</th>
                                                    <th class="table-primary align-middle text-center">03</th>
                                                    <th class="table-primary align-middle text-center">04</th>
                                                    <th class="table-primary align-middle text-center">05</th>
                                                    <th class="table-primary align-middle text-center">06</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php if (!isset($dtdetail)) {
                                                    if (isset($message)) {
                                                        for ($i = 0; $i < $jmldtl; $i++) { ?>
                                                            <tr>
                                                                <!-- <td class="fixed freeze_horizontal" style="background-color: #ffffff ! important;"><input name="dtl_chk[]" type="checkbox" /></td> -->
                                                                <td><input type="text" class="form-control w-auto boiler" name="boiler[]" id="boiler" style="text-align: center;" value="<?php echo set_value('boiler[' . $i . ']'); ?>" readonly></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_07" name="tekanan_07[]" id="tekanan_07" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_07[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_08" name="tekanan_08[]" id="tekanan_08" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_08[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_09" name="tekanan_09[]" id="tekanan_09" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_09[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_10" name="tekanan_10[]" id="tekanan_10" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_10[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_11" name="tekanan_11[]" id="tekanan_11" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_11[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_12" name="tekanan_12[]" id="tekanan_12" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_12[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_13" name="tekanan_13[]" id="tekanan_13" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_13[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_14" name="tekanan_14[]" id="tekanan_14" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_14[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_15" name="tekanan_15[]" id="tekanan_15" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_15[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_16" name="tekanan_16[]" id="tekanan_16" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_16[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_17" name="tekanan_17[]" id="tekanan_17" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_17[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_18" name="tekanan_18[]" id="tekanan_18" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_18[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_19" name="tekanan_19[]" id="tekanan_19" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_19[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_20" name="tekanan_20[]" id="tekanan_20" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_20[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_21" name="tekanan_21[]" id="tekanan_21" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_21[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_22" name="tekanan_22[]" id="tekanan_22" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_22[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_23" name="tekanan_23[]" id="tekanan_23" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_23[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_24" name="tekanan_24[]" id="tekanan_24" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_24[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_01" name="tekanan_01[]" id="tekanan_01" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_01[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_02" name="tekanan_02[]" id="tekanan_02" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_02[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_03" name="tekanan_03[]" id="tekanan_03" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_03[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_04" name="tekanan_04[]" id="tekanan_04" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_04[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_05" name="tekanan_05[]" id="tekanan_05" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_05[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tekanan_06" name="tekanan_06[]" id="tekanan_06" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('tekanan_06[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto keterangan" name="keterangan[]" id="keterangan" style="text-align: center;" value="<?php echo set_value('keterangan[' . $i . ']'); ?>"></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
                                                        <tr>
                                                            <!-- <td><input name="dtl_chk[]" class="chk" type="checkbox" /></td> -->
                                                            <td><input type="text" class="form-control w-auto boiler" name="boiler[]" id="boiler" style="text-align: center;" value="" readonly></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_07" name="tekanan_07[]" id="tekanan_07" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_08" name="tekanan_08[]" id="tekanan_08" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_09" name="tekanan_09[]" id="tekanan_09" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_10" name="tekanan_10[]" id="tekanan_10" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_11" name="tekanan_11[]" id="tekanan_11" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_12" name="tekanan_12[]" id="tekanan_12" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_13" name="tekanan_13[]" id="tekanan_13" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_14" name="tekanan_14[]" id="tekanan_14" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_15" name="tekanan_15[]" id="tekanan_15" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_16" name="tekanan_16[]" id="tekanan_16" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_17" name="tekanan_17[]" id="tekanan_17" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_18" name="tekanan_18[]" id="tekanan_18" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_19" name="tekanan_19[]" id="tekanan_19" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_20" name="tekanan_20[]" id="tekanan_20" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_21" name="tekanan_21[]" id="tekanan_21" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_22" name="tekanan_22[]" id="tekanan_22" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_23" name="tekanan_23[]" id="tekanan_23" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_24" name="tekanan_24[]" id="tekanan_24" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_01" name="tekanan_01[]" id="tekanan_01" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_02" name="tekanan_02[]" id="tekanan_02" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_03" name="tekanan_03[]" id="tekanan_03" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_04" name="tekanan_04[]" id="tekanan_04" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_05" name="tekanan_05[]" id="tekanan_05" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_06" name="tekanan_06[]" id="tekanan_06" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                                            <td><input type="text" class="form-control w-auto keterangan" name="keterangan[]" id="keterangan" style="text-align: center;" size="20" value=""></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    foreach ($dtdetail as $row) { ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id[]" id="detail_id" class="detail_id" style="text-align: center;" value="<?= $row->detail_id ?>">
                                                            <input type="hidden" class="form-control w-auto item_id" name="item_id[]" id="item_id" style="text-align: center;" size="20" value="<?= $row->item_id; ?>" readonly>
                                                            <td><input type="text" class="form-control w-auto boiler" name="boiler[]" id="boiler" style="text-align: center;" size="20" value="<?php echo $row->boiler; ?>" readonly></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_07" name="tekanan_07[]" id="tekanan_07" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_07; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_08" name="tekanan_08[]" id="tekanan_08" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_08; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_09" name="tekanan_09[]" id="tekanan_09" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_09; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_10" name="tekanan_10[]" id="tekanan_10" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_10; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_11" name="tekanan_11[]" id="tekanan_11" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_11; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_12" name="tekanan_12[]" id="tekanan_12" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_12; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_13" name="tekanan_13[]" id="tekanan_13" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_13; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_14" name="tekanan_14[]" id="tekanan_14" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_14; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_15" name="tekanan_15[]" id="tekanan_15" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_15; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_16" name="tekanan_16[]" id="tekanan_16" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_16; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_17" name="tekanan_17[]" id="tekanan_17" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_17; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_18" name="tekanan_18[]" id="tekanan_18" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_18; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_19" name="tekanan_19[]" id="tekanan_19" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_19; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_20" name="tekanan_20[]" id="tekanan_20" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_20; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_21" name="tekanan_21[]" id="tekanan_21" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_21; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_22" name="tekanan_22[]" id="tekanan_22" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_22; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_23" name="tekanan_23[]" id="tekanan_23" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_23; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_24" name="tekanan_24[]" id="tekanan_24" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_24; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_01" name="tekanan_01[]" id="tekanan_01" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_01; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_02" name="tekanan_02[]" id="tekanan_02" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_02; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_03" name="tekanan_03[]" id="tekanan_03" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_03; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_04" name="tekanan_04[]" id="tekanan_04" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_04; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_05" name="tekanan_05[]" id="tekanan_05" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_05; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tekanan_06" name="tekanan_06[]" id="tekanan_06" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value="<?php echo $row->tekanan_06; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto keterangan" name="keterangan[]" id="keterangan" style="text-align: center;" size="20" value="<?php echo $row->keterangan; ?>"></td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-primary align-middle text-center" colspan="27" align="center">
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <!-- TABLE C -->

                            <div class="row">
                                <div class="col-9">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <!-- <th class="table-success align-middle text-center" rowspan="3">#</th> -->
                                                    <th class="table-warning align-middle text-center" rowspan="3">KODE BOILER</th>
                                                    <th class="table-warning align-middle text-center" rowspan="1" colspan="2">Jam Operasi</th>
                                                    <th class="table-warning align-middle text-center" rowspan="1" colspan="2">PEMAKAIAN TEMPURUNG</th>
                                                    <th class="table-warning align-middle text-center" rowspan="1" colspan="2">OUTPUT STEAM</th>
                                                    <th class="table-warning align-middle text-center" rowspan="1" colspan="2">PEMAKAIAN AIR</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-warning align-middle text-center">Hari ini</th>
                                                    <th class="table-warning align-middle text-center">AKM</th>
                                                    <th class="table-warning align-middle text-center">Hari ini (Kg)</th>
                                                    <th class="table-warning align-middle text-center">Akumulatif</th>
                                                    <th class="table-warning align-middle text-center">Hari ini (Ton)</th>
                                                    <th class="table-warning align-middle text-center">Akumulatif</th>
                                                    <th class="table-warning align-middle text-center">Hari ini (㎥)</th>
                                                    <th class="table-warning align-middle text-center">Akumulatif</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_3">
                                                <?php if (!isset($dtdetail_c)) {
                                                    if (isset($message)) {
                                                        for ($i3 = 0; $i3 < $jmldtlc; $i3++) { ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlc_kode_boiler" name="dtlc_kode_boiler[]" id="dtlc_kode_boiler" style="text-align: center;" value="<?php echo set_value('dtlc_kode_boiler[' . $i3 . ']'); ?>" readonly></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlc_total_jam hitung_total_jam hitung_akm" name="dtlc_total_jam[]" id="dtlc_total_jam" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('dtlc_total_jam[' . $i3 . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlc_jam_akm hitung_total_jam" name="dtlc_jam_akm[]" id="dtlc_jam_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('dtlc_jam_akm[' . $i3 . ']'); ?>" readonly>
                                                                    <input type="hidden" class="form-control align-middle w-auto dtlc_jam_akm_awal hitung_total_jam" name="dtlc_jam_akm_awal[]" id="dtlc_jam_akm_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('dtlc_jam_akm_awal[' . $i3 . ']'); ?>" readonly>
                                                                </td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlc_tmpr_kg hitung_total_temp hitung_akm" name="dtlc_tmpr_kg[]" id="dtlc_tmpr_kg" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('dtlc_tmpr_kg[' . $i3 . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlc_tmpr_akm hitung_total_temp" name="dtlc_tmpr_akm[]" id="dtlc_tmpr_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('dtlc_tmpr_akm[' . $i3 . ']'); ?>" readonly>
                                                                    <input type="hidden" class="form-control align-middle w-auto dtlc_tmpr_akm_awal hitung_total_temp" name="dtlc_tmpr_akm_awal[]" id="dtlc_tmpr_akm_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('dtlc_tmpr_akm_awal[' . $i3 . ']'); ?>" readonly>
                                                                </td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlc_steam_ton hitung_total_steam hitung_akm" name="dtlc_steam_ton[]" id="dtlc_steam_ton" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('dtlc_steam_ton[' . $i3 . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlc_steam_akm hitung_total_steam" name="dtlc_steam_akm[]" id="dtlc_steam_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('dtlc_steam_akm[' . $i3 . ']'); ?>" readonly>
                                                                    <input type="hidden" class="form-control align-middle w-auto dtlc_steam_akm_awal hitung_total_steam" name="dtlc_steam_akm_awal[]" id="dtlc_steam_akm_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('dtlc_steam_akm_awal[' . $i3 . ']'); ?>" readonly>
                                                                </td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlc_total_air hitung_total_ayir hitung_akm" name="dtlc_total_air[]" id="dtlc_total_air" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('dtlc_total_air[' . $i3 . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlc_air_akm hitung_total_ayir" name="dtlc_air_akm[]" id="dtlc_air_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('dtlc_air_akm[' . $i3 . ']'); ?>" readonly>
                                                                    <input type="hidden" class="form-control align-middle w-auto dtlc_air_akm_awal hitung_total_ayir" name="dtlc_air_akm_awal[]" id="dtlc_air_akm_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="<?php echo set_value('dtlc_air_akm_awal[' . $i3 . ']'); ?>" readonly>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
                                                        <tr>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlc_kode_boiler" name="dtlc_kode_boiler[]" id="dtlc_kode_boiler" style="text-align: center;" size="20" value="" readonly></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlc_total_jam hitung_total_jam hitung_akm" name="dtlc_total_jam[]" id="dtlc_total_jam" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value=""></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlc_jam_akm hitung_total_jam" name="dtlc_jam_akm[]" id="dtlc_jam_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlc_jam_akm_awal hitung_total_jam" name="dtlc_jam_akm_awal[]" id="dtlc_jam_akm_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="" readonly>
                                                            </td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlc_tmpr_kg hitung_total_temp hitung_akm" name="dtlc_tmpr_kg[]" id="dtlc_tmpr_kg" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value=""></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlc_tmpr_akm hitung_total_temp" name="dtlc_tmpr_akm[]" id="dtlc_tmpr_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlc_tmpr_akm_awal hitung_total_temp" name="dtlc_tmpr_akm_awal[]" id="dtlc_tmpr_akm_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="" readonly>
                                                            </td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlc_steam_ton hitung_total_steam hitung_akm" name="dtlc_steam_ton[]" id="dtlc_steam_ton" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value=""></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlc_steam_akm hitung_total_steam" name="dtlc_steam_akm[]" id="dtlc_steam_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlc_steam_akm_awal hitung_total_steam" name="dtlc_steam_akm_awal[]" id="dtlc_steam_akm_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="" readonly>
                                                            </td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlc_total_air hitung_total_ayir hitung_akm" name="dtlc_total_air[]" id="dtlc_total_air" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value=""></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlc_air_akm hitung_total_ayir" name="dtlc_air_akm[]" id="dtlc_air_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlc_air_akm_awal hitung_total_ayir" name="dtlc_air_akm_awal[]" id="dtlc_air_akm_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="" readonly>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    foreach ($dtdetail_c as $row) { ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id_c[]" id="detail_id_c" class="detail_id_c" style="text-align: center;" value="<?= $row->detail_id_c ?>">
                                                            <input type="hidden" class="form-control align-middle w-auto dtlc_item_id" name="dtlc_item_id[]" id="dtlc_item_id" style="text-align: center;" size="40" value="<?= $row->dtlc_item_id ?>" readonly>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto dtlc_kode_boiler" name="dtlc_kode_boiler[]" id="dtlc_kode_boiler" style="text-align: center;" size="40" value="<?php echo $row->dtlc_kode_boiler; ?>" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto dtlc_total_jam hitung_total_jam hitung_akm" name="dtlc_total_jam[]" id="dtlc_total_jam" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->dtlc_total_jam; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto dtlc_jam_akm hitung_total_jam" name="dtlc_jam_akm[]" id="dtlc_jam_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->dtlc_jam_akm; ?>" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlc_jam_akm_awal hitung_total_jam" name="dtlc_jam_akm_awal[]" id="dtlc_jam_akm_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->dtlc_jam_akm_awal; ?>" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto dtlc_tmpr_kg hitung_total_temp hitung_akm" name="dtlc_tmpr_kg[]" id="dtlc_tmpr_kg" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->dtlc_tmpr_kg; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto dtlc_tmpr_akm hitung_total_temp" name="dtlc_tmpr_akm[]" id="dtlc_tmpr_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->dtlc_tmpr_akm; ?>" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlc_tmpr_akm_awal hitung_total_temp" name="dtlc_tmpr_akm_awal[]" id="dtlc_tmpr_akm_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->dtlc_tmpr_akm_awal; ?>" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto dtlc_steam_ton hitung_total_steam hitung_akm" name="dtlc_steam_ton[]" id="dtlc_steam_ton" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->dtlc_steam_ton; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto dtlc_steam_akm hitung_total_steam" name="dtlc_steam_akm[]" id="dtlc_steam_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->dtlc_steam_akm; ?>" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlc_steam_akm_awal hitung_total_steam" name="dtlc_steam_akm_awal[]" id="dtlc_steam_akm_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->dtlc_steam_akm_awal; ?>" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto dtlc_total_air hitung_total_ayir hitung_akm" name="dtlc_total_air[]" id="dtlc_total_air" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->dtlc_total_air; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto dtlc_air_akm hitung_total_ayir" name="dtlc_air_akm[]" id="dtlc_air_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->dtlc_air_akm; ?>" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlc_air_akm_awal hitung_total_ayir" name="dtlc_air_akm_awal[]" id="dtlc_air_akm_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->dtlc_air_akm_awal; ?>" readonly>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-warning align-middle text-center"><strong>TOTAL</strong> :</td>
                                                    <td class="table-warning"><input type="text" name="total_dtlc_total_jam" id="total_dtlc_total_jam" class="form-control total_jam dtopen_blok" style="text-align: center;" value="<?= $total_dtlc_total_jam; ?>" required readonly></td>
                                                    <td class="table-warning"><input type="text" name="total_dtlc_jam_akm" id="total_dtlc_jam_akm" class="form-control total_jam_akm dtopen_blok" style="text-align: center;" value="<?= $total_dtlc_jam_akm; ?>" readonly></td>
                                                    <td class="table-warning"><input type="text" name="total_dtlc_tmpr_kg" id="total_dtlc_tmpr_kg" class="form-control total_dtlc_tmpr_kg dtopen_blok" style="text-align: center;" value="<?= $total_dtlc_tmpr_kg; ?>" required readonly></td>
                                                    <td class="table-warning"><input type="text" name="total_dtlc_tmpr_akm" id="total_dtlc_tmpr_akm" class="form-control total_tmpr_akm dtopen_blok" style="text-align: center;" value="<?= $total_dtlc_tmpr_akm; ?>" required readonly></td>
                                                    <td class="table-warning"><input type="text" name="total_dtlc_steam_ton" id="total_dtlc_steam_ton" class="form-control total_dtlc_steam_ton dtopen_blok" style="text-align: center;" value="<?= $total_dtlc_steam_ton; ?>" required readonly></td>
                                                    <td class="table-warning"><input type="text" name="total_dtlc_steam_akm" id="total_dtlc_steam_akm" class="form-control total_steam_akm dtopen_blok" style="text-align: center;" value="<?= $total_dtlc_steam_akm; ?>" required readonly></td>
                                                    <td class="table-warning"><input type="text" name="total_dtlc_total_air" id="total_dtlc_total_air" class="form-control total_dtlc_total_air dtopen_blok" style="text-align: center;" value="<?= $total_dtlc_total_air; ?>" required readonly></td>
                                                    <td class="table-warning"><input type="text" name="total_dtlc_air_akm" id="total_dtlc_air_akm" class="form-control total_air_akm dtopen_blok" style="text-align: center;" value="<?= $total_dtlc_air_akm; ?>" required readonly></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless">
                                            <tr>
                                                <td colspan="3">
                                                    <strong>
                                                        <h2>KETERANGAN</h2>
                                                    </strong>
                                                </td colspan="3">
                                            </tr>
                                            <tr>
                                                <td>Air Dearator</td>
                                                <td><input type="text" name="air_dearator" id="air_dearator" class="form-control air_dearator dtopen_blok" style="text-align: center;" value="<?= $air_dearator; ?>" size="3"></td>
                                                <td>M3</td>
                                            </tr>
                                            <tr>
                                            <tr>
                                                <td></td>
                                                <td style="text-align: center;">M3</td>
                                                <td style="text-align: center;">%</td>
                                            </tr>
                                            <td>Air dari WTD</td>
                                            <td><input type="text" name="air_wtd" id="air_wtd" class="form-control air_wtd dtopen_blok" style="text-align: center;" value="<?= $air_wtd; ?>" size="3"></td>
                                            <td><input type="text" name="prsn_air_wtd" id="prsn_air_wtd" class="form-control prsn_air_wtd dtopen_blok" style="text-align: center;" value="<?= $prsn_air_wtd; ?>" size="3" readonly></td>
                                            </tr>
                                            <tr>
                                                <td>Air Condensate</td>
                                                <td><input type="text" name="air_condensate" id="air_condensate" class="form-control air_condensate dtopen_blok" style="text-align: center;" value="<?= $air_condensate; ?>" size="3" readonly></td>
                                                <td><input type="text" name="prsn_air_condensate" id="prsn_air_condensate" class="form-control prsn_air_condensate dtopen_blok" style="text-align: center;" value="<?= $prsn_air_condensate; ?>" size="3" readonly></td>
                                            </tr>
                                            <tr>
                                                <td>Total Air utk BLR</td>
                                                <td><input type="text" name="air_blr" id="air_blr" class="form-control air_blr dtopen_blok" style="text-align: center;" value="<?= $air_blr; ?>" size="3"></td>
                                                <td><input type="text" name="prsn_air_blr" id="prsn_air_blr" class="form-control prsn_air_blr dtopen_blok" style="text-align: center;" value="<?= $prsn_air_blr; ?>" size="3" readonly></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3><strong>Return Condensate </strong></h3>
                                                </td>
                                                <td><input type="text" name="total_return" id="total_return" class="form-control total_return dtopen_blok" style="text-align: center;" value="<?= $total_return; ?>" size="3"></td>
                                                <td>M3</td>
                                            </tr>
                                        </table>
                                        <hr style="border: 0;height: 3px;background: #333;background-image: -webkit-linear-gradient(left, #ccc, #333, #ccc);background-image: -moz-linear-gradient(left, #ccc, #333, #ccc);background-image: -ms-linear-gradient(left, #ccc, #333, #ccc);background-image: -o-linear-gradient(left, #ccc, #333, #ccc);">
                                        <table class="table table-striped table-borderless">
                                            <tr>
                                                <td>Tempurung (Kg/Jam) = Max 900</td>
                                                <td>Realisasi =</td>
                                                <td><input type="text" name="realisasi" id="realisasi" class="form-control realisasi dtopen_blok" style="text-align: center;" value="<?= $realisasi; ?>" size="3" readonly></td>
                                            </tr>
                                            <tr>
                                                <td>Tempurung (Kg/Jam) Bulan <?= $bulan; ?> =</td>
                                                <td><input type="text" name="temp_bulan_lalu" id="temp_bulan_lalu" class="form-control temp_bulan_lalu dtopen_blok" style="text-align: center;" value="<?= $temp_bulan_lalu; ?>" size="3" readonly></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- TABLE D -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="table-danger align-middle text-center" rowspan="3">Uraian</th>
                                                    <th class="table-danger align-middle text-center" rowspan="1">Jam</th>
                                                    <th class="table-danger align-middle text-center" rowspan="1" colspan="2">PEMAKAIAN TEMPURUNG</th>
                                                    <th class="table-danger align-middle text-center" rowspan="1" colspan="2">PEMAKAIAN STEAM</th>
                                                    <th class="table-danger align-middle text-center" rowspan="1" colspan="2">PEMAKAIAN AIR</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-danger align-middle text-center">Hari ini</th>
                                                    <th class="table-danger align-middle text-center">Hari ini (Kg)</th>
                                                    <th class="table-danger align-middle text-center">Akumulatif</th>
                                                    <th class="table-danger align-middle text-center">Hari ini (Ton)</th>
                                                    <th class="table-danger align-middle text-center">Akumulatif</th>
                                                    <th class="table-danger align-middle text-center">Hari ini (㎥)</th>
                                                    <th class="table-danger align-middle text-center">Akumulatif</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_4">
                                                <?php if (!isset($dtdetail_d)) {
                                                    if (isset($message)) {
                                                        for ($id = 0; $id < $jmldtld; $id++) { ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control align-middle w-auto dtld_uraian" name="dtld_uraian[]" id="dtld_uraian" style="text-align: center;" value="<?php echo set_value('dtld_uraian[' . $id . ']'); ?>" readonly></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtld_total_jam" name="dtld_total_jam[]" id="dtld_total_jam" style="text-align: center;" value="<?php echo set_value('dtld_total_jam[' . $id . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtld_tmpr_kg hitung_total_dtemp hitung_akm" name="dtld_tmpr_kg[]" id="dtld_tmpr_kg" style="text-align: center;" value="<?php echo set_value('dtld_tmpr_kg[' . $id . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtld_tmpr_akm hitung_total_dtemp" name="dtld_tmpr_akm[]" id="dtld_tmpr_akm" style="text-align: center;" value="<?php echo set_value('dtld_tmpr_akm[' . $id . ']'); ?>" readonly>
                                                                    <input type="hidden" class="form-control align-middle w-auto dtld_tmpr_akm_awal hitung_total_dtemp" name="dtld_tmpr_akm_awal[]" id="dtld_tmpr_akm_awal" style="text-align: center;" value="<?php echo set_value('dtld_tmpr_akm_awal[' . $id . ']'); ?>" readonly>
                                                                </td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtld_steam_ton hitung_total_dsteam hitung_akm" name="dtld_steam_ton[]" id="dtld_steam_ton" style="text-align: center;" value="<?php echo set_value('dtld_steam_ton[' . $id . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtld_steam_akm hitung_total_dsteam" name="dtld_steam_akm[]" id="dtld_steam_akm" style="text-align: center;" value="<?php echo set_value('dtld_steam_akm[' . $id . ']'); ?>" readonly>
                                                                    <input type="hidden" class="form-control align-middle w-auto dtld_steam_akm_awal hitung_total_dsteam" name="dtld_steam_akm_awal[]" id="dtld_steam_akm_awal" style="text-align: center;" value="<?php echo set_value('dtld_steam_akm_awal[' . $id . ']'); ?>" readonly>
                                                                </td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtld_total_air hitung_total_dayir hitung_akm" name="dtld_total_air[]" id="dtld_total_air" style="text-align: center;" value="<?php echo set_value('dtld_total_air[' . $id . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtld_air_akm hitung_total_dayir" name="dtld_air_akm[]" id="dtld_air_akm" style="text-align: center;" value="<?php echo set_value('dtld_air_akm[' . $id . ']'); ?>" readonly>
                                                                    <input type="hidden" class="form-control align-middle w-auto dtld_air_akm_awal hitung_total_dayir" name="dtld_air_akm_awal[]" id="dtld_air_akm_awal" style="text-align: center;" value="<?php echo set_value('dtld_air_akm_awal[' . $id . ']'); ?>" readonly>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
                                                        <tr>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_uraian" name="dtld_uraian[]" id="dtld_uraian" style="text-align: center;" size="40" value="" readonly></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_total_jam" name="dtld_total_jam[]" id="dtld_total_jam" style="text-align: center;" size="15" value=""></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_tmpr_kg hitung_total_dtemp hitung_akm" name="dtld_tmpr_kg[]" id="dtld_tmpr_kg" style="text-align: center;" size="15" value=""></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_tmpr_akm hitung_total_dtemp" name="dtld_tmpr_akm[]" id="dtld_tmpr_akm" style="text-align: center;" size="15" value="" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtld_tmpr_akm_awal hitung_total_dtemp" name="dtld_tmpr_akm_awal[]" id="dtld_tmpr_akm_awal" style="text-align: center;" size="15" value="" readonly>
                                                            </td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_steam_ton hitung_total_dsteam hitung_akm" name="dtld_steam_ton[]" id="dtld_steam_ton" style="text-align: center;" size="15" value=""></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_steam_akm hitung_total_dsteam" name="dtld_steam_akm[]" id="dtld_steam_akm" style="text-align: center;" size="15" value="" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtld_steam_akm_awal hitung_total_dsteam" name="dtld_steam_akm_awal[]" id="dtld_steam_akm_awal" style="text-align: center;" size="15" value="" readonly>
                                                            </td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_total_air hitung_total_dayir hitung_akm" name="dtld_total_air[]" id="dtld_total_air" style="text-align: center;" size="15" value=""></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_air_akm hitung_total_dayir" name="dtld_air_akm[]" id="dtld_air_akm" style="text-align: center;" size="15" value="" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtld_air_akm_awal hitung_total_dayir" name="dtld_air_akm_awal[]" id="dtld_air_akm_awal" style="text-align: center;" size="15" value="" readonly>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    foreach ($dtdetail_d as $row) {
                                                    ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id_d[]" id="detail_id_d" class="detail_id_d" style="text-align: center;" value="<?= $row->detail_id_d ?>">
                                                            <input type="hidden" class="form-control align-middle w-auto dtld_item_id " name="dtld_item_id[]" id="dtld_item_id" value="<?= $row->dtld_item_id ?>" readonly>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_uraian" name="dtld_uraian[]" id="dtld_uraian" style="text-align: center;" size="40" value="<?php echo $row->dtld_uraian; ?>" readonly></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_total_jam" name="dtld_total_jam[]" id="dtld_total_jam" style="text-align: center;" size="15" value="<?php echo $row->dtld_total_jam; ?>"></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_tmpr_kg hitung_total_dtemp hitung_akm" name="dtld_tmpr_kg[]" id="dtld_tmpr_kg" style="text-align: center;" size="15" value="<?php echo $row->dtld_tmpr_kg; ?>"></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_tmpr_akm hitung_total_dtemp" name="dtld_tmpr_akm[]" id="dtld_tmpr_akm" style="text-align: center;" size="15" value="<?php echo $row->dtld_tmpr_akm; ?>" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtld_tmpr_akm_awal hitung_total_dtemp" name="dtld_tmpr_akm_awal[]" id="dtld_tmpr_akm_awal" style="text-align: center;" size="15" value="<?php echo $row->dtld_tmpr_akm_awal; ?>" readonly>
                                                            </td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_steam_ton hitung_total_dsteam hitung_akm" name="dtld_steam_ton[]" id="dtld_steam_ton" style="text-align: center;" size="15" value="<?php echo $row->dtld_steam_ton; ?>"></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_steam_akm hitung_total_dsteam" name="dtld_steam_akm[]" id="dtld_steam_akm" style="text-align: center;" size="15" value="<?php echo $row->dtld_steam_akm; ?>" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtld_steam_akm_awal hitung_total_dsteam" name="dtld_steam_akm_awal[]" id="dtld_steam_akm_awal" style="text-align: center;" size="15" value="<?php echo $row->dtld_steam_akm_awal; ?>" readonly>
                                                            </td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_total_air hitung_total_dayir hitung_akm" name="dtld_total_air[]" id="dtld_total_air" style="text-align: center;" size="15" value="<?php echo $row->dtld_total_air; ?>"></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtld_air_akm hitung_total_dayir" name="dtld_air_akm[]" id="dtld_air_akm" style="text-align: center;" size="15" value="<?php echo $row->dtld_air_akm; ?>" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtld_air_akm_awal hitung_total_dayir" name="dtld_air_akm_awal[]" id="dtld_air_akm_awal" style="text-align: center;" size="15" value="<?php echo $row->dtld_air_akm_awal; ?>" readonly>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-danger align-middle text-center" colspan="2"><strong>TOTAL</strong> :</td>
                                                    <td class="table-danger"><input type="text" name="total_dtld_tmpr_kg" id="total_dtld_tmpr_kg" class="form-control total_dtld_tmpr_kg dtopen_blok" style="text-align: center;" value="<?= $total_dtld_tmpr_kg; ?>" required readonly></td>
                                                    <td class="table-danger"><input type="text" name="total_dtld_tmpr_akm" id="total_dtld_tmpr_akm" class="form-control total_dtld_tmpr_akm dtopen_blok" style="text-align: center;" value="<?= $total_dtld_tmpr_akm; ?>" required readonly></td>
                                                    <td class="table-danger"><input type="text" name="total_dtld_steam_ton" id="total_dtld_steam_ton" class="form-control total_dtld_steam_ton dtopen_blok" style="text-align: center;" value="<?= $total_dtld_steam_ton; ?>" required readonly></td>
                                                    <td class="table-danger"><input type="text" name="total_dtld_steam_akm" id="total_dtld_steam_akm" class="form-control total_dtld_steam_akm dtopen_blok" style="text-align: center;" value="<?= $total_dtld_steam_akm; ?>" required readonly></td>
                                                    <td class="table-danger"><input type="text" name="total_dtld_total_air" id="total_dtld_total_air" class="form-control total_dtld_total_air dtopen_blok" style="text-align: center;" value="<?= $total_dtld_total_air; ?>" required readonly></td>
                                                    <td class="table-danger"><input type="text" name="total_dtld_air_akm" id="total_dtld_air_akm" class="form-control total_dtld_air_akm dtopen_blok" style="text-align: center;" value="<?= $total_dtld_air_akm; ?>" required readonly></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <!-- TABLE B -->

                            <div class="row">
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead id="table_tempurung">
                                                <?php if (isset($dtheader)) { ?>
                                                    <tr>
                                                        <td class="table-success align-middle text-center">STOCK TEMPURUNG SEBELUMNYA</td>
                                                        <td class="table-success"><input type="text" name="stock_awal_temp" id="stock_awal_temp" class="form-control stock_awal_temp dtopen_blok stock_temp_hilang" style="text-align: center;" value="<?= $stock_awal_temp; ?>" readonly required></td>
                                                    </tr>
                                                <?php } else { ?>
                                                    <tr>
                                                        <td class="table-success align-middle text-center">STOCK TEMPURUNG SEBELUMNYA</td>
                                                        <td class="table-success"><input type="text" name="stock_awal_temp" id="stock_awal_temp" class="form-control stock_awal_temp dtopen_blok stock_temp_hilang" style="text-align: center;" value="<?= $stock_awal_temp; ?>" required></td>
                                                    </tr>
                                                <?php } ?>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <!-- <th class="table-success align-middle text-center" rowspan="3">#</th> -->
                                                    <th class="table-success align-middle text-center" rowspan="3">URAIAN</th>
                                                    <th class="table-success align-middle text-center" rowspan="1" colspan="2">PENERIMAAN</th>
                                                    <th class="table-success align-middle text-center" rowspan="1" colspan="2">PEMAKAIAN</th>
                                                    <th class="table-success align-middle text-center" rowspan="3">STOCK TEMPURUNG SEBELUMNYA (Kg)</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-success align-middle text-center">Kg</th>
                                                    <th class="table-success align-middle text-center">Akumulatif</th>
                                                    <th class="table-success align-middle text-center">Kg</th>
                                                    <th class="table-success align-middle text-center">Akumulatif</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_b">
                                                <?php if (!isset($dtdetail_b)) {
                                                    if (isset($message)) {
                                                        for ($ib = 0; $ib < $jmldtlb; $ib++) { ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_uraian" name="dtlb_uraian[]" id="dtlb_uraian" style="text-align: center;" value="<?php echo set_value('dtlb_uraian[' . $ib . ']'); ?>" readonly></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_penerimaan_kg hitung_total_bpenerimaan hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_kg[]" id="dtlb_penerimaan_kg" style="text-align: center;" value="<?php echo set_value('dtlb_penerimaan_kg[' . $ib . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_penerimaan_akm hitung_total_bpenerimaan" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_akm[]" id="dtlb_penerimaan_akm" style="text-align: center;" value="<?php echo set_value('dtlb_penerimaan_akm[' . $ib . ']'); ?>" readonly></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_pemakaian_kg hitung_total_bpemakaian hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_kg[]" id="dtlb_pemakaian_kg" style="text-align: center;" value="<?php echo set_value('dtlb_pemakaian_kg[' . $ib . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_pemakaian_akm hitung_total_bpemakaian" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_akm[]" id="dtlb_pemakaian_akm" style="text-align: center;" value="<?php echo set_value('dtlb_pemakaian_akm[' . $ib . ']'); ?>"></td>
                                                                <td></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    foreach ($dtdetail_b as $row) {
                                                        if ($row->dtlb_uraian != 'Kirim TPR') {
                                                        ?>
                                                            <tr>
                                                                <input type="hidden" name="detail_id_b[]" id="detail_id_b" class="detail_id_b" style="text-align: center;" value="<?= $row->detail_id_b ?>">
                                                                <input type="hidden" class="form-control align-middle w-auto dtlb_item_id" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_item_id[]" id="dtlb_item_id" style="text-align: center;" size="40" value="<?= $row->dtlb_item_id ?>">
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_uraian" name="dtlb_uraian[]" id="dtlb_uraian" style="text-align: center;" value="<?= $row->dtlb_uraian ?>" readonly></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_penerimaan_kg hitung_total_bpenerimaan hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_kg[]" id="dtlb_penerimaan_kg" style="text-align: center;" value="<?= $row->dtlb_penerimaan_kg ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_penerimaan_akm hitung_total_bpenerimaan" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_akm[]" id="dtlb_penerimaan_akm" style="text-align: center;" value="<?= $row->dtlb_penerimaan_akm ?>" readonly></td>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlb_penerimaan_akm_awal hitung_total_bpenerimaan" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_akm_awal[]" id="dtlb_penerimaan_akm_awal" style="text-align: center;" value="<?= $row->dtlb_penerimaan_akm_awal ?>" readonly>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_pemakaian_kg hitung_total_bpemakaian hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_kg[]" id="dtlb_pemakaian_kg" style="text-align: center;" value="<?= $row->dtlb_pemakaian_kg ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_pemakaian_akm hitung_total_bpemakaian" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_akm[]" id="dtlb_pemakaian_akm" style="text-align: center;" value="<?= $row->dtlb_pemakaian_akm ?>" readonly></td>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlb_pemakaian_akm_awal hitung_total_bpemakaian" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_akm_awal[]" id="dtlb_pemakaian_akm_awal" style="text-align: center;" value="<?= $row->dtlb_pemakaian_akm_awal ?>">
                                                                <td></td>
                                                            </tr>

                                                        <?php
                                                        } else { ?>
                                                            <tr>
                                                                <input type="hidden" name="detail_id_b[]" id="detail_id_b" class="detail_id_b" style="text-align: center;" value="<?= $row->detail_id_b ?>">
                                                                <input type="hidden" class="form-control align-middle w-auto dtlb_item_id" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_item_id[]" id="dtlb_item_id" style="text-align: center;" size="40" value="<?= $row->dtlb_item_id ?>">
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_uraian" name="dtlb_uraian[]" id="dtlb_uraian" style="text-align: center;" value="<?= $row->dtlb_uraian ?>" readonly></td>
                                                                <td><input type="hidden" class="form-control align-middle w-auto dtlb_penerimaan_kg hitung_total_bpenerimaan hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_kg[]" id="dtlb_penerimaan_kg" style="text-align: center;" value="<?= $row->dtlb_penerimaan_kg ?>"></td>
                                                                <td><input type="hidden" class="form-control align-middle w-auto dtlb_penerimaan_akm hitung_total_bpenerimaan" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_akm[]" id="dtlb_penerimaan_akm" style="text-align: center;" value="<?= $row->dtlb_penerimaan_akm ?>"></td>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlb_penerimaan_akm_awal hitung_total_bpenerimaan" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_akm_awal[]" id="dtlb_penerimaan_akm_awal" style="text-align: center;" value="<?= $row->dtlb_penerimaan_akm_awal ?>">
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_pemakaian_kg hitung_total_bpemakaian hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_kg[]" id="dtlb_pemakaian_kg" style="text-align: center;" value="<?= $row->dtlb_pemakaian_kg ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb_pemakaian_akm hitung_total_bpemakaian" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_akm[]" id="dtlb_pemakaian_akm" style="text-align: center;" value="<?= $row->dtlb_pemakaian_akm ?>" readonly></td>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlb_pemakaian_akm_awal hitung_total_bpemakaian" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_akm_awal[]" id="dtlb_pemakaian_akm_awal" style="text-align: center;" value="<?= $row->dtlb_pemakaian_akm_awal ?>">
                                                                <td></td>
                                                            </tr>
                                                <?php }
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-success align-middle text-center"><strong>Selisih Opname</strong> </td>
                                                    <td class="table-success" colspan="4"></td>
                                                    <td class="table-success"><input type="text" name="selisih_opname" id="selisih_opname" class="form-control selisih_opname dtopen_blok" style="text-align: center;" value="<?= $selisih_opname; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td class="table-success align-middle text-center"><strong>TOTAL TPR</strong> </td>
                                                    <td class="table-success"><input type="text" name="total_dtlb_penerimaan_kg" id="total_dtlb_penerimaan_kg" class="form-control total_dtlb_penerimaan_kg dtopen_blok" style="text-align: center;" value="<?= $total_dtlb_penerimaan_kg; ?>" required readonly></td>
                                                    <td class="table-success"><input type="text" name="total_dtlb_penerimaan_akm" id="total_dtlb_penerimaan_akm" class="form-control total_penerimaan_akm dtopen_blok" style="text-align: center;" value="<?= $total_dtlb_penerimaan_akm; ?>" readonly></td>
                                                    <td class="table-success"><input type="text" name="total_dtlb_pemakaian_kg" id="total_dtlb_pemakaian_kg" class="form-control total_dtlb_pemakaian_kg dtopen_blok" style="text-align: center;" value="<?= $total_dtlb_pemakaian_kg; ?>" required readonly></td>
                                                    <td class="table-success"><input type="text" name="total_dtlb_pemakaian_akm" id="total_dtlb_pemakaian_akm" class="form-control total_pemakaian_akm dtopen_blok" style="text-align: center;" value="<?= $total_dtlb_pemakaian_akm; ?>" required readonly></td>
                                                    <td class="table-success"><input type="text" name="stock_akhir_tmp" id="stock_akhir_tmp" class="form-control stock_akhir_tmp dtopen_blok" style="text-align: center;" value="<?= $stock_akhir_tmp; ?>" required></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="table-success align-middle text-center" colspan="7">BAHAN KIMIA (Kg)</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-success align-middle text-center">URAIAN</th>
                                                    <th class="table-success align-middle text-center">TERIMA</th>
                                                    <th class="table-success align-middle text-center">PAKAI</th>
                                                    <th class="table-success align-middle text-center">AKUMULATIF</th>
                                                    <th class="table-success align-middle text-center">EFF (%)</th>
                                                    <th class="table-success align-middle text-center">STOCK</th>
                                                    <th class="table-success align-middle text-center">NO. DO</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_2b">
                                                <?php if (!isset($dtdetail_b2)) {
                                                    if (isset($message)) {
                                                        for ($i2b = 0; $i2b < $jmldtlb2; $i2b++) { ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_uraian" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_uraian[]" id="dtlb2_uraian" style="text-align: center;" value="<?php echo set_value('dtlb2_uraian[' . $i2b . ']'); ?>" readonly></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_terima" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_terima[]" id="dtlb2_terima" style="text-align: center;" value="<?php echo set_value('dtlb2_terima[' . $i2b . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_pakai hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_pakai[]" id="dtlb2_pakai" style="text-align: center;" value="<?php echo set_value('dtlb2_pakai[' . $i2b . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_akm[]" id="dtlb2_akm" style="text-align: center;" value="<?php echo set_value('dtlb2_akm[' . $i2b . ']'); ?>" readonly></td>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlb2_akm_awal" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_akm_awal[]" id="dtlb2_akm_awal" style="text-align: center;" value="<?php echo set_value('dtlb2_akm_awal[' . $i2b . ']'); ?>" readonly>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_eff" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_eff[]" id="dtlb2_eff" style="text-align: center;" value="<?php echo set_value('dtlb2_eff[' . $i2b . ']'); ?>" readonly></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_stock" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_stock[]" id="dtlb2_stock" style="text-align: center;" value="<?php echo set_value('dtlb2_stock[' . $i2b . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_nodo" name="dtlb2_nodo[]" id="dtlb2_nodo" style="text-align: center;" value="<?php echo set_value('dtlb2_nodo[' . $i2b . ']'); ?>"></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
                                                        <tr>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_uraian" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_uraian[]" id="dtlb2_uraian" style="text-align: center;" value="" readonly></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_terima" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_terima[]" id="dtlb2_terima" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_pakai hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_pakai[]" id="dtlb2_pakai" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_akm[]" id="dtlb2_akm" style="text-align: center;" value="" readonly></td>
                                                            <input type="hidden" class="form-control align-middle w-auto dtlb2_akm_awal" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_akm_awal[]" id="dtlb2_akm_awal" style="text-align: center;" value="" readonly>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_eff" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_eff[]" id="dtlb2_eff" style="text-align: center;" value="" readonly></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_stock" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_stock[]" id="dtlb2_stock" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_nodo" name="dtlb2_nodo[]" id="dtlb2_nodo" style="text-align: center;" value=""></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    foreach ($dtdetail_b2 as $row) { ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id_b2[]" id="detail_id_b2" class="detail_id_b2" style="text-align: center;" value="<?= $row->detail_id_b2 ?>">
                                                            <input type="hidden" class="form-control align-middle w-auto dtlb2_item_id" name="dtlb2_item_id[]" id="dtlb2_item_id" value="<?= $row->dtlb2_item_id ?>">
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_uraian" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_uraian[]" id="dtlb2_uraian" style="text-align: center;" value="<?= $row->dtlb2_uraian ?>" readonly></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_terima" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_terima[]" id="dtlb2_terima" style="text-align: center;" value="<?= $row->dtlb2_terima ?>"></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_pakai hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_pakai[]" id="dtlb2_pakai" style="text-align: center;" value="<?= $row->dtlb2_pakai ?>"></td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto dtlb2_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_akm[]" id="dtlb2_akm" style="text-align: center;" value="<?= $row->dtlb2_akm ?>" readonly>
                                                                <input type="hidden" class="form-control align-middle w-auto dtlb2_akm_awal" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_akm_awal[]" id="dtlb2_akm_awal" style="text-align: center;" value="<?= $row->dtlb2_akm_awal ?>" readonly>
                                                            </td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_eff" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_eff[]" id="dtlb2_eff" style="text-align: center;" value="<?= $row->dtlb2_eff ?>" readonly></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_stock" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_stock[]" id="dtlb2_stock" style="text-align: center;" value="<?= $row->dtlb2_stock ?>"></td>
                                                            <td><input type="text" class="form-control align-middle w-auto dtlb2_nodo" name="dtlb2_nodo[]" id="dtlb2_nodo" style="text-align: center;" value="<?= $row->dtlb2_nodo ?>"></td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-success align-middle text-center" colspan="8"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <br>
                            <div class=" row mt-1">
                                <div class="col-12">
                                    <?php if (!isset($dtheader)) {
                                        if ($akses_create == '1') { ?>
                                            <button type="submit" class="btn bg-gradient-primary" id="btnsimpan"><i class="feather icon-save"></i> Simpan</button>
                                            <button type="reset" class="btn bg-gradient-light"><i class="feather icon-refresh-ccw"></i> Batal</button>
                                        <?php
                                        }
                                    } else {
                                        if ($akses_update == '1') { ?>
                                            <button type="submit" class="btn bg-gradient-primary" name="btnproses" value="btnupdate" onclick="return confirm('Simpan Data ?')"><i class="feather icon-save"></i> Simpan</button>
                                            <span class="pull-right">
                                                <button type="submit" class="btn bg-gradient-info" name="btnproses" value="btncomplete" onclick="return confirm('Komplit Data ?')"><i class="feather icon-check-square"></i> Komplit</button>

                                            <?php
                                        }
                                        if ($akses_excel == '1') { ?>
                                                <a class="btn bg-gradient-success" href="<?= base_url('export_excel/C_export_toexcel_' . $frmkd . '_' . $frmvrs . '/exportxls/' . $frmkd . '/' . $frmvrs . '/' . $headerid) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
                                            </span>
                                    <?php
                                        }
                                    } ?>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <span class="pull-left">Mulai Berlaku: <?= $frmefec; ?></span>
                                    <a href="?#"><span class="pull-right"><?= $frmnm . '-' . $frmvrs; ?></span></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('template/footbar'); ?>

<script>
    $(document).ready(function() {


        get_docno();

        hitung('.hitung_total_jam', '.dtlc_total_jam', '.total_jam', '.dtlc_jam_akm', '.total_jam_akm');
        hitung('.hitung_total_temp', '.dtlc_tmpr_kg', '.total_dtlc_tmpr_kg', '.dtlc_tmpr_akm', '.total_tmpr_akm');
        hitung('.hitung_total_steam', '.dtlc_steam_ton', '.total_dtlc_steam_ton', '.dtlc_steam_akm', '.total_steam_akm');
        hitung('.hitung_total_ayir', '.dtlc_total_air', '.total_dtlc_total_air', '.dtlc_air_akm', '.total_air_akm');

        hitung('.hitung_total_dtemp', '.dtld_tmpr_kg', '.total_dtld_tmpr_kg', '.dtld_tmpr_akm', '.total_dtld_tmpr_akm');
        hitung('.hitung_total_dsteam', '.dtld_steam_ton', '.total_dtld_steam_ton', '.dtld_steam_akm', '.total_dtld_steam_akm');
        hitung('.hitung_total_dayir', '.dtld_total_air', '.total_dtld_total_air', '.dtld_air_akm', '.total_dtld_air_akm');

        hitung('.hitung_total_bpenerimaan', '.dtlb_penerimaan_kg', '.total_dtlb_penerimaan_kg', '.dtlb_penerimaan_akm', '.total_penerimaan_akm');
        hitung('.hitung_total_bpemakaian', '.dtlb_pemakaian_kg', '.total_dtlb_pemakaian_kg', '.dtlb_pemakaian_akm', '.total_pemakaian_akm');

    });


    function hitung(class_hitung, dtl_biasa, dtl_total, dtl_akm, total_akm) {
        $(document).on('change', class_hitung, function() {
            total_hitung(dtl_biasa, dtl_total);
            total_hitung(dtl_akm, total_akm);
        });
    }

    function total_hitung(kelas, class_total) {
        // let create_date = $(".create_date").val();
        // let tanggal_split = create_date.split('-');
        // let arr_tanggal = (tanggal_split[0]);

        let stock_awal = $('.stock_awal_temp').val();
        let penerimaan_temp = $('.total_dtlb_penerimaan_kg').val();
        let pemakaian_temp = $('.total_dtlb_pemakaian_kg').val();

        let stock_temp = parseFloat(stock_awal) + parseFloat(penerimaan_temp) - parseFloat(pemakaian_temp);
        $('.stock_akhir_tmp').val(isNaN(stock_temp) ? '0' : stock_temp);
        let nilai = 0;

        let x = $(kelas);


        for (let i = 0; i < x.length; i++) {
            let isi_nilai = 0;
            if (x[i].value !== "") {
                isi_nilai = x[i].value;
            }
            nilai += parseFloat(isi_nilai);
        }

        $(class_total).val((Math.round(nilai)).toFixed(2));
    }

    function hitung_total(id) {

        var v = [];
        $('.' + id).each(function() {
            if ($(this).val() != '') {
                v.push($(this).val());
            }
        });

        var jml = 0;
        var total = 0;
        for (var i = 0; i < v.length; i++) {
            if (v[i] != '') {
                jml++;
                total += (parseFloat(v[i]));
            }
        }


        if (total != 0) {
            $('.total_' + id).val(Math.round(total).toFixed(2));
        } else {
            $('.total_' + id).val('0');
        }
    }

    $('.create_date').change(function() {
        var that = $(this);
        var id = $(this).attr('id');
        get_docno();
    });

    function get_docno() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (typeof(input_headerid) == "undefined" && create_date != '') {

            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss319_08/get_docno/frmfss319/08",
                dataType: "json",
                data: {
                    create_date,
                },
                success: function(result) {
                    if (result.status == true) {
                        $('.docno').val(result.data);
                    }
                    get_item();
                }
            });
        }
    }

    $(document).on('keyup', '.jam', function() {
        let that = $(this);
        let val_jam = that.val();

        if (val_jam != '') {
            let val = $('.jam').mask('00:00');
        }
    });

    // $(document).on('change', '.selisih_opname', function() {
    //     let selisih_opname = $(this).val();
    //     let stock_akhir_tmp = $('.stock_akhir_tmp').val();

    //     $('#stock_akhir_tmp').prop('readonly', false);
    // });


    function get_item() {
        let input_headerid = $(".headerid").val();
        let create_date = $(".create_date").val();

        $('#tbody').empty();
        $('#tbody_3').empty();

        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss319_08/get_list_item/frmfss319/08",
                data: {
                    create_date
                },
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        let no = 1;
                        let list_dtl = ``;
                        let list_dtl3 = ``;
                        let akm_jam_tot = 0;
                        let akm_temp_tot = 0;
                        let akm_steam_tot = 0;
                        let akm_air_tot = 0;
                        $.each(res.data, function(key, list_item_row) {
                            list_dtl += `
                                    <tr>
                                        <input type="hidden" class="form-control w-auto item_id" name="item_id[]" id="item_id" style="text-align: center;" size="20" value=" ${list_item_row.detail_id}" readonly>
                                        <td><input type="text" class="form-control w-auto boiler" name="boiler[]" id="boiler" style="text-align: center;" size="20" value=" ${list_item_row.item1}" readonly></td>
                                        <td><input type="text" class="form-control w-auto tekanan_07" name="tekanan_07[]" id="tekanan_07" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_08" name="tekanan_08[]" id="tekanan_08" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_09" name="tekanan_09[]" id="tekanan_09" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_10" name="tekanan_10[]" id="tekanan_10" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_11" name="tekanan_11[]" id="tekanan_11" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_12" name="tekanan_12[]" id="tekanan_12" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_13" name="tekanan_13[]" id="tekanan_13" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_14" name="tekanan_14[]" id="tekanan_14" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_15" name="tekanan_15[]" id="tekanan_15" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_16" name="tekanan_16[]" id="tekanan_16" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_17" name="tekanan_17[]" id="tekanan_17" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_18" name="tekanan_18[]" id="tekanan_18" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_19" name="tekanan_19[]" id="tekanan_19" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_20" name="tekanan_20[]" id="tekanan_20" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_21" name="tekanan_21[]" id="tekanan_21" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_22" name="tekanan_22[]" id="tekanan_22" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_23" name="tekanan_23[]" id="tekanan_23" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_24" name="tekanan_24[]" id="tekanan_24" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_01" name="tekanan_01[]" id="tekanan_01" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_02" name="tekanan_02[]" id="tekanan_02" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_03" name="tekanan_03[]" id="tekanan_03" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_04" name="tekanan_04[]" id="tekanan_04" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_05" name="tekanan_05[]" id="tekanan_05" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto tekanan_06" name="tekanan_06[]" id="tekanan_06" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="5" value=""></td>
                                        <td><input type="text" class="form-control w-auto keterangan" name="keterangan[]" id="keterangan" style="text-align: center;" size="20" value=""></td>
                                    </tr>
                                `;

                            if (list_item_row.children) {
                                $.each(list_item_row.children, function(key2, list_item_row2) {
                                    let akm_jam = (`${list_item_row2.akumulatif_jam}`) == 'null' ? 0 : (`${list_item_row2.akumulatif_jam}`);
                                    let akm_tempurung = (`${list_item_row2.akumulatif_tempurung}`) == 'null' ? 0 : (`${list_item_row2.akumulatif_tempurung}`);
                                    let akm_steam = (`${list_item_row2.akumulatif_steam}`) == 'null' ? 0 : (`${list_item_row2.akumulatif_steam}`);
                                    let akm_ayir = (`${list_item_row2.akumulatif_air}`) == 'null' ? 0 : (`${list_item_row2.akumulatif_air}`);

                                    akm_jam = parseFloat(akm_jam).toFixed(2);
                                    akm_tempurung = parseFloat(akm_tempurung).toFixed(2);
                                    akm_steam = parseFloat(akm_steam).toFixed(2);
                                    akm_ayir = parseFloat(akm_ayir).toFixed(2);

                                    akm_jam_tot += parseFloat(akm_jam);
                                    akm_temp_tot += parseFloat(akm_tempurung);
                                    akm_steam_tot += parseFloat(akm_steam);
                                    akm_air_tot += parseFloat(akm_ayir);

                                    list_dtl3 += `
                                                <tr>
                                                    <input type="hidden" class="form-control align-middle w-auto dtlc_item_id" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_item_id[]" id="dtlc_item_id" style="text-align: center;" size="40" value="${list_item_row.detail_id}" readonly>
                                                    <td>
                                                      <input type="text" class="form-control align-middle w-auto dtlc_kode_boiler" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_kode_boiler[]" id="dtlc_kode_boiler" style="text-align: center;" size="40" value="${list_item_row.item2}" readonly></td>
                                                    <td>
                                                     <input type="text" class="form-control align-middle w-auto dtlc_total_jam hitung_total_jam hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_total_jam[]" id="dtlc_total_jam" style="text-align: center;" size="10" value="">\
                                                    </td>
                                                    <td>
                                                      <input type="text" class="form-control align-middle w-auto dtlc_jam_akm hitung_total_jam" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_jam_akm[]" id="dtlc_jam_akm" style="text-align: center;" size="10" value="${akm_jam}" readonly>
                                                      <input type="hidden" class="form-control align-middle w-auto dtlc_jam_akm_awal hitung_total_jam" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_jam_akm_awal[]" id="dtlc_jam_akm_awal" style="text-align: center;" size="10" value="${akm_jam}" readonly>
                                                    </td>
                                                    <td>
                                                      <input type="text" class="form-control align-middle w-auto dtlc_tmpr_kg hitung_total_temp hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_tmpr_kg[]" id="dtlc_tmpr_kg" style="text-align: center;" size="10" value="">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control align-middle w-auto dtlc_tmpr_akm hitung_total_temp" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_tmpr_akm[]" id="dtlc_tmpr_akm" style="text-align: center;" size="10" value="${akm_tempurung}" readonly>
                                                        <input type="hidden" class="form-control align-middle w-auto dtlc_tmpr_akm_awal hitung_total_temp" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_tmpr_akm_awal[]" id="dtlc_tmpr_akm_awal" style="text-align: center;" size="10" value="${akm_tempurung}" readonly>
                                                    </td>
                                                    <td>
                                                       <input type="text" class="form-control align-middle w-auto dtlc_steam_ton hitung_total_steam hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_steam_ton[]" id="dtlc_steam_ton" style="text-align: center;" size="10" value="">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control align-middle w-auto dtlc_steam_akm hitung_total_steam" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_steam_akm[]" id="dtlc_steam_akm" style="text-align: center;" size="10" value="${akm_steam}" readonly>
                                                        <input type="hidden" class="form-control align-middle w-auto dtlc_steam_akm_awal hitung_total_steam" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_steam_akm_awal[]" id="dtlc_steam_akm_awal" style="text-align: center;" size="10" value="${akm_steam}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control align-middle w-auto dtlc_total_air hitung_total_ayir hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_total_air[]" id="dtlc_total_air" style="text-align: center;" size="10" value="">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control align-middle w-auto dtlc_air_akm hitung_total_ayir" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_air_akm[]" id="dtlc_air_akm" style="text-align: center;" size="10" value="${akm_ayir}" readonly>
                                                        <input type="hidden" class="form-control align-middle w-auto dtlc_air_akm_awal hitung_total_ayir" onkeypress="return DisableKey(event, 'desimal')" name="dtlc_air_akm_awal[]" id="dtlc_air_akm_awal" style="text-align: center;" size="10" value="${akm_ayir}" readonly>
                                                    </td>
                                                </tr>
                                            `;
                                });

                            }

                        });

                        $('#tbody').append(list_dtl);
                        $('#tbody_3').append(list_dtl3);

                        // Masukkan ke AKM Total
                        $('#total_dtlc_total_jam').val(0);
                        $('#total_dtlc_jam_akm').val(akm_jam_tot.toFixed(2));

                        $('#total_dtlc_tmpr_kg').val(0);
                        $('#total_dtlc_tmpr_akm').val(akm_temp_tot.toFixed(2));

                        $('#total_dtlc_steam_ton').val(0);
                        $('#total_dtlc_steam_akm').val(akm_steam_tot.toFixed(2));

                        $('#total_dtlc_total_air ').val(0);
                        $('#total_dtlc_air_akm').val(akm_air_tot.toFixed(2));

                        // load getItem2()
                        get_item2();
                    }

                },
            });
        }
    }

    function get_item2() {
        let input_headerid = $(".headerid").val();
        let create_date = $(".create_date").val();

        let tanggal_split = create_date.split('-');
        let arr_tanggal = (tanggal_split[0]);
        let arr1_tanggal = (tanggal_split[1]);
        let arr2_tanggal = (tanggal_split[2]);


        $('#tbody_b').empty();

        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss319_08/get_list_item2/frmfss319/08",
                data: {
                    create_date
                },
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        let no = 1;
                        let dtl_list = ``;
                        let dtl_list2 = ``;
                        let akumulatif_tot = 0;
                        let akm_penerimaan_tot = 0;
                        let akm_pemakaian_tot = 0;
                        $.each(res.data, function(key, list_item) {


                            if (list_item.children) {
                                $.each(list_item.children, function(key2, list_item2) {

                                    let akumulatif = (`${list_item2.b2_akumulatif}`) == 'null' ? 0 : (`${list_item2.b2_akumulatif}`);
                                    let akm_penerimaan = (`${list_item2.akm_penerimaan}`) == 'null' ? 0 : (`${list_item2.akm_penerimaan}`);
                                    let akm_pemakaian = (`${list_item2.akm_pemakaian}`) == 'null' ? 0 : (`${list_item2.akm_pemakaian}`);

                                    akumulatif = parseFloat(akumulatif).toFixed(2);
                                    akm_penerimaan = parseFloat(akm_penerimaan).toFixed(2);
                                    akm_pemakaian = parseFloat(akm_pemakaian).toFixed(2);


                                    akumulatif_tot += parseFloat(akumulatif);
                                    akm_penerimaan_tot += parseFloat(akm_penerimaan);
                                    akm_pemakaian_tot += parseFloat(akm_pemakaian);



                                    if (list_item.item1 != 'Kirim TPR') {
                                        dtl_list2 += `
                                            <tr>
                                                <input type="hidden" class="form-control align-middle w-auto dtlb_item_id" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_item_id[]" id="dtlb_item_id" style="text-align: center;" size="40" value="${list_item.detail_id}" readonly>
                                                <td>
                                                   <input type="text" class="form-control align-middle w-auto dtlb_uraian" name="dtlb_uraian[]" id="dtlb_uraian" style="text-align: center;" value="${list_item.item1}" readonly>
                                                </td>
                                                <td>
                                                   <input type="text" class="form-control align-middle w-auto dtlb_penerimaan_kg hitung_total_bpenerimaan hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_kg[]" id="dtlb_penerimaan_kg" style="text-align: center;" value="">
                                                </td>
                                                <td>
                                                   <input type="text" class="form-control align-middle w-auto dtlb_penerimaan_akm hitung_total_bpenerimaan" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_akm[]" id="dtlb_penerimaan_akm" style="text-align: center;" value="${akm_penerimaan}" readonly>
                                                   <input type="hidden" class="form-control align-middle w-auto dtlb_penerimaan_akm_awal" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_akm_awal[]" id="dtlb_penerimaan_akm_awal" style="text-align: center;" value="${akm_penerimaan}" readonly>
                                                </td>
                                                <td>
                                                  <input type="text" class="form-control align-middle w-auto dtlb_pemakaian_kg hitung_total_bpemakaian hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_kg[]" id="dtlb_pemakaian_kg" style="text-align: center;" value=""></td>
                                                <td>
                                                  <input type="text" class="form-control align-middle w-auto dtlb_pemakaian_akm hitung_total_bpemakaian" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_akm[]" id="dtlb_pemakaian_akm" style="text-align: center;" value="${akm_pemakaian}" readonly>
                                                </td>
                                                <input type="hidden" class="form-control align-middle w-auto dtlb_pemakaian_akm_awal" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_akm_awal[]" id="dtlb_pemakaian_akm_awal" style="text-align: center;" value="${akm_pemakaian}" readonly>
                                                <td class="table-success"></td>
                                            </tr>
                                            `;
                                    } else {
                                        dtl_list2 += `
                                                <tr>
                                                    <input type="hidden" class="form-control align-middle w-auto dtlb_item_id" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_item_id[]" id="dtlb_item_id" style="text-align: center;" size="40" value="${list_item.detail_id}" readonly>
                                                    <td><input type="text" class="form-control align-middle w-auto dtlb_uraian" name="dtlb_uraian[]" id="dtlb_uraian" style="text-align: center;" value="${list_item.item1}" readonly></td>
                                                    <td><input type="hidden" class="form-control align-middle w-auto dtlb_penerimaan_kg hitung_total_bpenerimaan" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_kg[]" id="dtlb_penerimaan_kg" style="text-align: center;" value=""></td>
                                                    <td><input type="hidden" class="form-control align-middle w-auto dtlb_penerimaan_akm hitung_total_bpenerimaan" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_akm[]" id="dtlb_penerimaan_akm" style="text-align: center;" value="" readonly></td>
                                                    <input type="hidden" class="form-control align-middle w-auto dtlb_penerimaan_akm_awal" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_penerimaan_akm_awal[]" id="dtlb_penerimaan_akm_awal" style="text-align: center;" value="" readonly>
                                                    <td><input type="text" class="form-control align-middle w-auto dtlb_pemakaian_kg hitung_total_bpemakaian hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_kg[]" id="dtlb_pemakaian_kg" style="text-align: center;" value=""></td>
                                                    <td><input type="text" class="form-control align-middle w-auto dtlb_pemakaian_akm hitung_total_bpemakaian" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_akm[]" id="dtlb_pemakaian_akm" style="text-align: center;" value="${akm_pemakaian}" readonly></td>
                                                    <input type="hidden" class="form-control align-middle w-auto dtlb_pemakaian_akm_awal" onkeypress="return DisableKey(event, 'desimal')" name="dtlb_pemakaian_akm_awal[]" id="dtlb_pemakaian_akm_awal" style="text-align: center;" value="${akm_pemakaian}" readonly>
                                                    <td class="table-success"></td>
                                                </tr>
                                                `;
                                    }
                                });
                            }

                        });
                        $('#tbody_b').append(dtl_list2);

                        $('#total_dtlb_penerimaan_kg').val(0);
                        $('#total_dtlb_penerimaan_akm').val(akm_penerimaan_tot.toFixed(2));
                        $('#total_dtlb_pemakaian_kg').val(0);
                        $('#total_dtlb_pemakaian_akm').val(akm_pemakaian_tot.toFixed(2));
                        get_item3();
                        get_stock_temp();
                        // notif_btnconfirm_custom('success', res.pesan);
                    }
                },
            });
        }
    }

    function get_stock_temp() {
        let input_headerid = $(".headerid").val();
        let create_date = $(".create_date").val();
        let stock_akhir_tmp = $(".stock_akhir_tmp").val();
        let selisih_opname = $(".selisih_opname").val();

        let tanggal_split = create_date.split('-');
        let arr_tanggal = (tanggal_split[0]);
        let arr1_tanggal = (tanggal_split[1]);
        let arr2_tanggal = (tanggal_split[2]);


        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss319_08/get_stock_temp/frmfss319/08",
                data: {
                    create_date
                },
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        let no = 1;
                        let temp_list = ``;
                        let stock_temp = res.data.stock_temp;
                        let stock_akhir = res.data.stock_akhir;
                        let tgl = res.data.create_date;

                        temp_list = `
                                <tr>
                                    <td class="table-success align-middle text-center">STOCK TEMPURUNG SEBELUMNYA</td>
                                    <td class="table-success"><input type="text" name="stock_awal_temp" id="stock_awal_temp" class="form-control stock_awal_temp dtopen_blok stock_temp_hilang" style="text-align: center;" value="${stock_akhir}" readonly required></td>
                                </tr>
                            `;
                        $('#table_tempurung').empty();
                        $('#table_tempurung').append(temp_list);

                    } else {
                        temp_list = `
                                <tr>
                                    <td class="table-success align-middle text-center">STOCK TEMPURUNG SEBELUMNYA</td>
                                    <td class="table-success"><input type="text" name="stock_awal_temp" id="stock_awal_temp" class="form-control stock_awal_temp dtopen_blok stock_temp_hilang" style="text-align: center;" value="" required></td>
                                </tr>
                            `;
                        $('#table_tempurung').empty();
                        $('#table_tempurung').append(temp_list);
                    }
                },
            });
        }
    }

    function get_item3() {
        let input_headerid = $(".headerid").val();
        let create_date = $(".create_date").val();

        $('#tbody_4').empty();

        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss319_08/get_list_item3/frmfss319/08",
                data: {
                    create_date
                },
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        let no = 1;
                        let list_dtl4 = ``;
                        let dtld_akm_temp_tot = 0;
                        let dtld_akm_steam_tot = 0;
                        let dtld_akm_ayir_tot = 0;
                        $.each(res.data, function(key, list_item_row) {


                            if (list_item_row.children != '') {
                                $.each(list_item_row.children, function(key2, list_item_row2) {

                                    let akm_tempurung_2 = (`${list_item_row2.d_akumulatif_tempurung}`) == 'null' ? 0 : (`${list_item_row2.d_akumulatif_tempurung}`);
                                    let akm_steam_2 = (`${list_item_row2.d_akumulatif_steam}`) == 'null' ? 0 : (`${list_item_row2.d_akumulatif_steam}`);
                                    let akm_ayir_2 = (`${list_item_row2.d_akumulatif_air}`) == 'null' ? 0 : (`${list_item_row2.d_akumulatif_air}`);

                                    akm_tempurung_2 = parseFloat(akm_tempurung_2).toFixed(1);
                                    akm_steam_2 = parseFloat(akm_steam_2).toFixed(1);
                                    akm_ayir_2 = parseFloat(akm_ayir_2).toFixed(1);

                                    dtld_akm_temp_tot += parseFloat(akm_tempurung_2);
                                    dtld_akm_steam_tot += parseFloat(akm_steam_2);
                                    dtld_akm_ayir_tot += parseFloat(akm_ayir_2);

                                    list_dtl4 += `
                                        <tr>
                                            <input type="hidden" class="form-control align-middle w-auto dtld_item_id hitung_total" onkeypress="return DisableKey(event, 'desimal')" name="dtld_item_id[]" id="dtld_item_id" style="text-align: center;" size="40" value="${list_item_row.detail_id}" readonly>
                                            <td>
                                              <input type="text" class="form-control align-middle w-auto dtld_uraian hitung_total" onkeypress="return DisableKey(event, 'desimal')" name="dtld_uraian[]" id="dtld_uraian" style="text-align: center;" size="40" value="${list_item_row.item1}" readonly>
                                            </td>
                                            <td>
                                               <input type="text" class="form-control align-middle w-auto dtld_total_jam hitung_total" onkeypress="return DisableKey(event, 'desimal')" name="dtld_total_jam[]" id="dtld_total_jam" style="text-align: center;" size="10" value="">
                                            </td>
                                            <td>
                                               <input type="text" class="form-control align-middle w-auto dtld_tmpr_kg hitung_total_dtemp hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtld_tmpr_kg[]" id="dtld_tmpr_kg" style="text-align: center;" size="10" value="">
                                            </td>
                                            <td>
                                               <input type="text" class="form-control align-middle w-auto dtld_tmpr_akm hitung_total_dtemp" onkeypress="return DisableKey(event, 'desimal')" name="dtld_tmpr_akm[]" id="dtld_tmpr_akm" style="text-align: center;" size="10" value="${akm_tempurung_2}" readonly>
                                                <input type="hidden" class="form-control align-middle w-auto dtld_tmpr_akm_awal hitung_total_dtemp" onkeypress="return DisableKey(event, 'desimal')" name="dtld_tmpr_akm_awal[]" id="dtld_tmpr_akm_awal" style="text-align: center;" size="10" value="${akm_tempurung_2}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto dtld_steam_ton hitung_total_dsteam hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtld_steam_ton[]" id="dtld_steam_ton" style="text-align: center;" size="10" value=""></td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto dtld_steam_akm hitung_total_dsteam" onkeypress="return DisableKey(event, 'desimal')" name="dtld_steam_akm[]" id="dtld_steam_akm" style="text-align: center;" size="10" value="${akm_steam_2}" readonly>
                                                <input type="hidden" class="form-control align-middle w-auto dtld_steam_akm_awal hitung_total_dsteam" onkeypress="return DisableKey(event, 'desimal')" name="dtld_steam_akm_awal[]" id="dtld_steam_akm_awal" style="text-align: center;" size="10" value="${akm_steam_2}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto dtld_total_air hitung_total_dayir hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtld_total_air[]" id="dtld_total_air" style="text-align: center;" size="10" value=""></td>
                                            <td>
                                            <input type="text" class="form-control align-middle w-auto dtld_air_akm hitung_total_dayir" onkeypress="return DisableKey(event, 'desimal')" name="dtld_air_akm[]" id="dtld_air_akm" style="text-align: center;" size="10" value="${akm_ayir_2}" readonly>
                                                <input type="hidden" class="form-control align-middle w-auto dtld_air_akm_awal hitung_total_dayir" onkeypress="return DisableKey(event, 'desimal')" name="dtld_air_akm_awal[]" id="dtld_air_akm_awal" style="text-align: center;" size="10" value="${akm_ayir_2}" readonly>
                                            </td>
                                        </tr>
                                        `;

                                });
                            } else {

                                // $.each(list_item_row.children, function(key2, list_item_row2) {

                                let akm_tempurung_2 = 0;
                                let akm_steam_2 = 0;
                                let akm_ayir_2 = 0;

                                akm_tempurung_2 = parseFloat(akm_tempurung_2).toFixed(1);
                                akm_steam_2 = parseFloat(akm_steam_2).toFixed(1);
                                akm_ayir_2 = parseFloat(akm_ayir_2).toFixed(1);

                                dtld_akm_temp_tot += parseFloat(akm_tempurung_2);
                                dtld_akm_steam_tot += parseFloat(akm_steam_2);
                                dtld_akm_ayir_tot += parseFloat(akm_ayir_2);
                                list_dtl4 += `
                                        <tr>
                                            <input type="hidden" class="form-control align-middle w-auto dtld_item_id hitung_total" onkeypress="return DisableKey(event, 'desimal')" name="dtld_item_id[]" id="dtld_item_id" style="text-align: center;" size="40" value="${list_item_row.detail_id}" readonly>
                                            <td>
                                              <input type="text" class="form-control align-middle w-auto dtld_uraian hitung_total" onkeypress="return DisableKey(event, 'desimal')" name="dtld_uraian[]" id="dtld_uraian" style="text-align: center;" size="40" value="${list_item_row.item1}" readonly>
                                            </td>
                                            <td>
                                               <input type="text" class="form-control align-middle w-auto dtld_total_jam hitung_total" onkeypress="return DisableKey(event, 'desimal')" name="dtld_total_jam[]" id="dtld_total_jam" style="text-align: center;" size="10" value="">
                                            </td>
                                            <td>
                                               <input type="text" class="form-control align-middle w-auto dtld_tmpr_kg hitung_total_dtemp hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtld_tmpr_kg[]" id="dtld_tmpr_kg" style="text-align: center;" size="10" value="">
                                            </td>
                                            <td>
                                               <input type="text" class="form-control align-middle w-auto dtld_tmpr_akm hitung_total_dtemp" onkeypress="return DisableKey(event, 'desimal')" name="dtld_tmpr_akm[]" id="dtld_tmpr_akm" style="text-align: center;" size="10" value="${akm_tempurung_2}" readonly>
                                                <input type="hidden" class="form-control align-middle w-auto dtld_tmpr_akm_awal hitung_total_dtemp" onkeypress="return DisableKey(event, 'desimal')" name="dtld_tmpr_akm_awal[]" id="dtld_tmpr_akm_awal" style="text-align: center;" size="10" value="${akm_tempurung_2}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto dtld_steam_ton hitung_total_dsteam hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtld_steam_ton[]" id="dtld_steam_ton" style="text-align: center;" size="10" value=""></td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto dtld_steam_akm hitung_total_dsteam" onkeypress="return DisableKey(event, 'desimal')" name="dtld_steam_akm[]" id="dtld_steam_akm" style="text-align: center;" size="10" value="${akm_steam_2}" readonly>
                                                <input type="hidden" class="form-control align-middle w-auto dtld_steam_akm_awal hitung_total_dsteam" onkeypress="return DisableKey(event, 'desimal')" name="dtld_steam_akm_awal[]" id="dtld_steam_akm_awal" style="text-align: center;" size="10" value="${akm_steam_2}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto dtld_total_air hitung_total_dayir hitung_akm" onkeypress="return DisableKey(event, 'desimal')" name="dtld_total_air[]" id="dtld_total_air" style="text-align: center;" size="10" value=""></td>
                                            <td>
                                            <input type="text" class="form-control align-middle w-auto dtld_air_akm hitung_total_dayir" onkeypress="return DisableKey(event, 'desimal')" name="dtld_air_akm[]" id="dtld_air_akm" style="text-align: center;" size="10" value="${akm_ayir_2}" readonly>
                                                <input type="hidden" class="form-control align-middle w-auto dtld_air_akm_awal hitung_total_dayir" onkeypress="return DisableKey(event, 'desimal')" name="dtld_air_akm_awal[]" id="dtld_air_akm_awal" style="text-align: center;" size="10" value="${akm_ayir_2}" readonly>
                                            </td>
                                        </tr>
                                        `;
                                // });

                            }
                            console.log(dtld_akm_temp_tot)

                        });

                        $('#tbody_4').append(list_dtl4);

                        $('#total_dtld_tmpr_kg').val(0);
                        $('#total_dtld_tmpr_akm').val((Math.round(dtld_akm_temp_tot)).toFixed(2));
                        $('#total_dtld_steam_ton').val(0);
                        $('#total_dtld_steam_akm').val((Math.round(dtld_akm_steam_tot)).toFixed(2));
                        $('#total_dtld_total_air').val(0);
                        $('#total_dtld_air_akm').val((Math.round(dtld_akm_ayir_tot)).toFixed(2));

                        get_item4();
                        notif_btnconfirm_custom('success', res.pesan);
                    }
                },
            });
        }
    }

    function get_item4() {
        let input_headerid = $(".headerid").val();
        let create_date = $(".create_date").val();

        $('#tbody_2b').empty();

        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss319_08/get_list_item4/frmfss319/08",
                data: {
                    create_date
                },
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        let no = 1;
                        let dtl_list = ``;
                        $.each(res.data, function(key, list_item) {

                            if (list_item.children) {
                                $.each(list_item.children, function(key2, list_item2) {

                                    let akumulatif = (`${list_item2.b2_akumulatif}`) == 'null' ? 0 : (`${list_item2.b2_akumulatif}`);
                                    akumulatif = parseFloat(akumulatif).toFixed(2);
                                    dtl_list += `
                                            <tr>
                                                <input type="hidden" class="form-control align-middle w-auto dtlb2_item_id" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_item_id[]" id="dtlb2_item_id" style="text-align: center;" size="40" value="${list_item.detail_id}" readonly>
                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_uraian" name="dtlb2_uraian[]" id="dtlb2_uraian" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="${list_item.item1}" readonly></td>
                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_terima" name="dtlb2_terima[]" id="dtlb2_terima" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_pakai hitung_akm" name="dtlb2_pakai[]" id="dtlb2_pakai" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_akm" name="dtlb2_akm[]" id="dtlb2_akm" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=" ${akumulatif}" readonly>
                                                    <input type="hidden" class="form-control align-middle w-auto dtlb2_akm_awal" onkeypress="return DisableKey(event, 'desimal')" name="dtlb2_akm_awal[]" id="dtlb2_akm_awal" style="text-align: center;" value=" ${akumulatif}" readonly>
                                                </td>
                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_eff" name="dtlb2_eff[]" id="dtlb2_eff" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value="" readonly></td>
                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_stock" name="dtlb2_stock[]" id="dtlb2_stock" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" value=""></td>
                                                <td><input type="text" class="form-control align-middle w-auto dtlb2_nodo" name="dtlb2_nodo[]" id="dtlb2_nodo" style="text-align: center;" value=""></td>
                                                </tr>
                                                `;
                                });
                            }

                        });
                        $('#tbody_2b').append(dtl_list);

                        notif_btnconfirm_custom('success', res.pesan);
                    }
                },
            });
        }
    }

    function get_akumulasi() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();

        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss319_08/get_akumulasi/frmfss319?08",
                dataType: "json",
                data: {
                    create_date,
                },
                success: function(result) {
                    if (result.status == 1) {

                    }
                }
            });
        }
    }



    $(document).on('keyup', '.hitung_akm', function() {
        var that = $(this);
        //    TABLE B
        var penerimaan_b = that.closest('tr').find('.dtlb_penerimaan_kg').val();
        var pemakaian_b = that.closest('tr').find('.dtlb_pemakaian_kg').val();
        var akm_penerimaan_b = that.closest('tr').find('.dtlb_penerimaan_akm_awal').val();
        var akm_pemakaian_b = that.closest('tr').find('.dtlb_pemakaian_akm_awal').val();
        var akm_penerimaan_b_fix = (parseFloat(akm_penerimaan_b) + parseFloat(penerimaan_b)).toFixed(2);
        var akm_pemakaian_b_fix = (parseFloat(akm_pemakaian_b) + parseFloat(pemakaian_b)).toFixed(2);
        that.closest('tr').find('.dtlb_penerimaan_akm').val(isNaN(akm_penerimaan_b_fix) ? akm_penerimaan_b : akm_penerimaan_b_fix);
        that.closest('tr').find('.dtlb_pemakaian_akm').val(isNaN(akm_pemakaian_b_fix) ? akm_pemakaian_b : akm_pemakaian_b_fix);


        //   TABLE B2
        var pemakaian_b2 = that.closest('tr').find('.dtlb2_pakai').val();
        var akm_pemakaian_b2 = that.closest('tr').find('.dtlb2_akm_awal').val();
        var akm_pemakaian_b2_fix = (parseFloat(akm_pemakaian_b2) + parseFloat(pemakaian_b2)).toFixed(2);
        that.closest('tr').find('.dtlb2_akm').val(isNaN(akm_pemakaian_b2_fix) ? akm_pemakaian_b2 : akm_pemakaian_b2_fix);
        /* EFF RUMUS */
        var total_ayir = $('.total_dtlc_total_air').val();
        var eff_kimia = ((parseFloat(pemakaian_b2) / parseFloat(total_ayir)) * 100).toFixed(2);
        that.closest('tr').find('.dtlb2_eff').val(isNaN(eff_kimia) ? '0' : eff_kimia);

        //   TABLE C
        var jam_c = that.closest('tr').find('.dtlc_total_jam').val();
        var jam_akm_c = that.closest('tr').find('.dtlc_jam_akm_awal').val();
        var tempurung_c = that.closest('tr').find('.dtlc_tmpr_kg').val();
        var tempurung_akm_c = that.closest('tr').find('.dtlc_tmpr_akm_awal').val();
        var steam_c = that.closest('tr').find('.dtlc_steam_ton').val();
        var steam_akm_c = that.closest('tr').find('.dtlc_steam_akm_awal').val();
        var ayir_c = that.closest('tr').find('.dtlc_total_air').val();
        var ayir_akm_c = that.closest('tr').find('.dtlc_air_akm_awal').val();
        var jam_akm_c_fix = (parseFloat(jam_akm_c) + parseFloat(jam_c)).toFixed(2);
        var tempurung_akm_c_fix = (parseFloat(tempurung_akm_c) + parseFloat(tempurung_c)).toFixed(2);
        var steam_akm_c_fix = (parseFloat(steam_akm_c) + parseFloat(steam_c)).toFixed(2);
        var ayir_akm_c_fix = (parseFloat(ayir_akm_c) + parseFloat(ayir_c)).toFixed(2);
        that.closest('tr').find('.dtlc_jam_akm').val(isNaN(jam_akm_c_fix) ? jam_akm_c : jam_akm_c_fix);
        that.closest('tr').find('.dtlc_tmpr_akm').val(isNaN(tempurung_akm_c_fix) ? tempurung_akm_c : tempurung_akm_c_fix);
        that.closest('tr').find('.dtlc_steam_akm').val(isNaN(steam_akm_c_fix) ? steam_akm_c : steam_akm_c_fix);
        that.closest('tr').find('.dtlc_air_akm').val(isNaN(ayir_akm_c_fix) ? ayir_akm_c : ayir_akm_c_fix);

        //  TABLE D
        var tempurung_d = that.closest('tr').find('.dtld_tmpr_kg').val();
        var tempurung_akm_d = that.closest('tr').find('.dtld_tmpr_akm_awal').val();
        var steam_d = that.closest('tr').find('.dtld_steam_ton').val();
        var steam_akm_d = that.closest('tr').find('.dtld_steam_akm_awal').val();
        var ayir_d = that.closest('tr').find('.dtld_total_air').val();
        var ayir_akm_d = that.closest('tr').find('.dtld_air_akm_awal').val();
        var tempurung_akm_d_fix = (parseFloat(tempurung_akm_d) + parseFloat(tempurung_d)).toFixed(1);
        var steam_akm_d_fix = (parseFloat(steam_akm_d) + parseFloat(steam_d)).toFixed(1);
        var ayir_akm_d_fix = (parseFloat(ayir_akm_d) + parseFloat(ayir_d)).toFixed(1);
        that.closest('tr').find('.dtld_tmpr_akm').val(isNaN(tempurung_akm_d_fix) ? tempurung_akm_d : tempurung_akm_d_fix);
        that.closest('tr').find('.dtld_steam_akm').val(isNaN(steam_akm_d_fix) ? steam_akm_d : steam_akm_d_fix);
        that.closest('tr').find('.dtld_air_akm').val(isNaN(ayir_akm_d_fix) ? ayir_akm_d : ayir_akm_d_fix);
    });

    $(document).on('keyup', '.air_blr', function() {
        var that = $(this);
        var total_air = that.val();
        var air_wtd = $('.air_wtd').val();
        var total_jam = $('.total_jam').val();
        var total_jam_akm = $('.total_jam_akm').val();
        var total_dtlc_tmpr_kg = $('.total_dtlc_tmpr_kg').val();
        var total_tmpr_akm = $('.total_tmpr_akm').val();

        var prsn_ayir_wtd = parseFloat(air_wtd / total_air * 100).toFixed(2);
        var air_conden = parseFloat(total_air - air_wtd);
        var prsn_ayir_conden = parseFloat(air_conden / total_air * 100).toFixed(2);
        var prsn_ayir_blr = parseFloat(prsn_ayir_wtd) + parseFloat(prsn_ayir_conden);
        var realisasi = parseFloat(total_dtlc_tmpr_kg / total_jam).toFixed(2);
        var tempurung_akm = parseFloat(total_tmpr_akm / total_jam_akm).toFixed(2)

        $('.prsn_air_condensate').val(prsn_ayir_conden);
        $('.air_condensate').val(air_conden);
        $('.prsn_air_wtd').val(prsn_ayir_wtd);
        $('.prsn_air_blr').val(prsn_ayir_blr);
        $('.realisasi').val(isNaN(realisasi) ? '0' : realisasi);
        $('.temp_bulan_lalu').val(isNaN(tempurung_akm) ? '0' : tempurung_akm);

    });



    // function total_akm() {

    //     let create_date = $(".create_date").val();
    //     let tanggal_split = create_date.split('-');
    //     let arr_tanggal = (tanggal_split[0]);

    //     let val_jam = 0;
    //     let val_jam_akm = 0;
    //     let val_tmpr_akm = 0;
    //     let val_steam_akm = 0;
    //     let val_air_akm = 0;

    //     let val_tmpr_akm_d = 0;
    //     let val_steam_akm_d = 0;
    //     let val_air_akm_d = 0;

    //     let val_terima_akm = 0;
    //     let val_pakai_akm = 0;
    //     // let val_stock_temp    = 0;

    //     //let jam = $('.dtlc_total_jam');
    //     let jam_akm = $('.dtlc_jam_akm');
    //     let tmpr_akm = $('.dtlc_tmpr_akm');
    //     let steam_akm = $('.dtlc_steam_akm');
    //     let air_akm = $('.dtlc_air_akm');
    //     let tmpr_akm_d = $('.dtld_tmpr_akm');
    //     let steam_akm_d = $('.dtld_steam_akm');
    //     let air_akm_d = $('.dtld_air_akm');
    //     let terima_akm = $('.dtlb_penerimaan_akm');
    //     let terima_kg = $('.dtlb_penerimaan_kg');
    //     let pakai_akm = $('.dtlb_pemakaian_akm');

    // let stock_awal = $('.stock_awal_temp').val();
    // let penerimaan_temp = $('.total_dtlb_penerimaan_kg').val();
    // let pemakaian_temp = $('.total_dtlb_pemakaian_kg').val();

    // let stock_temp = parseFloat(stock_awal) + parseFloat(penerimaan_temp) - parseFloat(pemakaian_temp);
    // $('.stock_akhir_tmp').val(isNaN(stock_temp) ? '0' : stock_temp);

    //     for (let i = 0; i < terima_akm.length; i++) {
    //         if (terima_akm[i].value) {
    //             val_terima_akm = (parseFloat(val_terima_akm) + parseFloat(terima_akm[i].value)).toFixed(2);
    //         }
    //     }

    //     for (let i = 0; i < pakai_akm.length; i++) {
    //         if (pakai_akm[i].value) {
    //             val_pakai_akm = (parseFloat(val_pakai_akm) + parseFloat(pakai_akm[i].value)).toFixed(2);
    //         }
    //     }

    //     for (let i = 0; i < jam.length; i++) {
    //         if (jam[i].value) {
    //             val_jam = (parseFloat(val_jam) + parseFloat(jam[i].value)).toFixed(2);
    //         }
    //     }

    //     for (let i = 0; i < jam_akm.length; i++) {
    //         if (jam_akm[i].value) {
    //             val_jam_akm = (parseFloat(val_jam_akm) + parseFloat(jam_akm[i].value)).toFixed(2);
    //         }
    //     }
    //     for (let i = 0; i < tmpr_akm.length; i++) {
    //         if (tmpr_akm[i].value) {
    //             val_tmpr_akm = (parseFloat(val_tmpr_akm) + parseFloat(tmpr_akm[i].value)).toFixed(1);
    //         }
    //     }
    //     for (let i = 0; i < steam_akm.length; i++) {
    //         if (steam_akm[i].value) {
    //             val_steam_akm = (parseFloat(val_steam_akm) + parseFloat(steam_akm[i].value)).toFixed(2);
    //         }
    //     }
    //     for (let i = 0; i < air_akm.length; i++) {
    //         if (air_akm[i].value) {
    //             val_air_akm = (parseFloat(val_air_akm) + parseFloat(air_akm[i].value)).toFixed(2);
    //         }
    //     }

    //     if (arr_tanggal == '01') {
    //         for (let i = 0; i < tmpr_akm_d.length; i++) {
    //             if (tmpr_akm_d[i].value) {
    //                 val_tmpr_akm_d = (parseFloat(val_tmpr_akm_d) + parseFloat(tmpr_akm_d[i].value)).toFixed(1);
    //             }
    //         }
    //     } else {
    //         for (let i = 0; i < tmpr_akm_d.length; i++) {
    //             if (tmpr_akm_d[i].value) {
    //                 val_tmpr_akm_d = Math.round(parseFloat(val_tmpr_akm_d) + parseFloat(tmpr_akm_d[i].value)).toFixed(1);
    //             }
    //         }
    //     }

    //     for (let i = 0; i < steam_akm_d.length; i++) {
    //         if (steam_akm_d[i].value) {
    //             val_steam_akm_d = (parseFloat(val_steam_akm_d) + (parseFloat(steam_akm_d[i].value))).toFixed(2);
    //         }
    //     }
    //     for (let i = 0; i < air_akm_d.length; i++) {
    //         if (air_akm_d[i].value) {
    //             val_air_akm_d = (parseFloat(val_air_akm_d) + parseFloat(air_akm_d[i].value)).toFixed(2);
    //         }
    //     }


    //     $('.total_jam').val(val_jam);
    //     $('.total_jam_akm').val(val_jam_akm);
    //     $('.total_tmpr_akm').val(val_tmpr_akm);
    //     $('.total_steam_akm').val(val_steam_akm);
    //     $('.total_air_akm').val(val_air_akm);
    //     $('.totald_tmpr_akm').val(val_tmpr_akm_d);
    //     $('.totald_steam_akm').val(val_steam_akm_d);
    //     $('.totald_air_akm').val(val_air_akm_d);
    //     $('.total_penerimaan_akm').val(val_terima_akm);
    //     $('.total_pemakaian_akm').val(val_pakai_akm);
    //     $('.stock_akhir_tmp').val(isNaN(stock_temp) ? '0' : stock_temp);

    // }



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