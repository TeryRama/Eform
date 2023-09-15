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
    $aksi  = "dtupdate";

    foreach ($dtheader as $dtheader_row) {
        $headerid                                = $dtheader_row->headerid;
        $comment                                 = $dtheader_row->comment;
        $comment_by                              = $dtheader_row->comment_by;
        $comment_time                            = $dtheader_row->comment_time;
        $comment_date                            = date("d-m-Y", strtotime($dtheader_row->comment_date));
        $create_date                             = date("d-m-Y", strtotime($dtheader_row->create_date));
        $docno                                   = $dtheader_row->docno;
        $supplay_pwh                             = $dtheader_row->supplay_pwh;
        $total_dtl_e_kwh_nilai                   = $dtheader_row->total_dtl_e_kwh_nilai;
        $total_dtl_e_kwh_akumulatif              = $dtheader_row->total_dtl_e_kwh_akumulatif;
        $total_dtl_a_steam_nilai                 = $dtheader_row->total_dtl_a_steam_nilai;
        $total_dtl_a_steam_akumulatif            = $dtheader_row->total_dtl_a_steam_akumulatif;
        $total_dtl_a_press_nilai                 = $dtheader_row->total_dtl_a_press_nilai;
        $total_dtl_a_press_akumulatif            = $dtheader_row->total_dtl_a_press_akumulatif;
        $total_dtl_a_batubara_nilai              = $dtheader_row->total_dtl_a_batubara_nilai;
        $total_dtl_a_batubara_akumulatif         = $dtheader_row->total_dtl_a_batubara_akumulatif;
        $total_dtl_a_debu_nilai                  = $dtheader_row->total_dtl_a_debu_nilai;
        $total_dtl_a_debu_akumulatif             = $dtheader_row->total_dtl_a_debu_akumulatif;
        $total_dtl_a_cocopit_nilai               = $dtheader_row->total_dtl_a_cocopit_nilai;
        $total_dtl_a_cocopit_akumulatif          = $dtheader_row->total_dtl_a_cocopit_akumulatif;
        $total_dtl_a_tempurung_nilai             = $dtheader_row->total_dtl_a_tempurung_nilai;
        $total_dtl_a_tempurung_akumulatif        = $dtheader_row->total_dtl_a_tempurung_akumulatif;
        $total_dtl_a_bb_nilai                    = $dtheader_row->total_dtl_a_bb_nilai;
        $total_dtl_a_bb_akumulatif               = $dtheader_row->total_dtl_a_bb_akumulatif;
        $total_dtl_a_sabut_nilai                 = $dtheader_row->total_dtl_a_sabut_nilai;
        $total_dtl_a_sabut_akumulatif            = $dtheader_row->total_dtl_a_sabut_akumulatif;
        $total_dtl_a_steam_batubara_nilai        = $dtheader_row->total_dtl_a_steam_batubara_nilai;
        $total_dtl_a_steam_batubara_akumulatif   = $dtheader_row->total_dtl_a_steam_batubara_akumulatif;
        $total_dtl_a_steam_bahanbakar_nilai      = $dtheader_row->total_dtl_a_steam_bahanbakar_nilai;
        $total_dtl_a_steam_bahanbakar_akumulatif = $dtheader_row->total_dtl_a_steam_bahanbakar_akumulatif;
        $total_dtl_a_operasi_nilai               = $dtheader_row->total_dtl_a_operasi_nilai;
        $total_dtl_a_operasi_akumulatif          = $dtheader_row->total_dtl_a_operasi_akumulatif;
        $total_dtl_a_dearator_nilai              = $dtheader_row->total_dtl_a_dearator_nilai;
        $total_dtl_a_dearator_akumulatif         = $dtheader_row->total_dtl_a_dearator_akumulatif;
        $total_dtl_a_demian_nilai                = $dtheader_row->total_dtl_a_demian_nilai;
        $total_dtl_a_demian_akumulatif           = $dtheader_row->total_dtl_a_demian_akumulatif;
        $total_dtl_a_ct_nilai                    = $dtheader_row->total_dtl_a_ct_nilai;
        $total_dtl_a_ct_akumulatif               = $dtheader_row->total_dtl_a_ct_akumulatif;
        $total_2generator                        = $dtheader_row->total_2generator;
        $total_2generator_akumulatif             = $dtheader_row->total_2generator_akumulatif;
        $selisih_kwh_generator                   = $dtheader_row->selisih_kwh_generator;
        $total_dtl_b_kwh_nilai                   = $dtheader_row->total_dtl_b_kwh_nilai;
        $total_dtl_b_kwh_akumulatif              = $dtheader_row->total_dtl_b_kwh_akumulatif;
        $total_dtl_b_bahanbakar_nilai            = $dtheader_row->total_dtl_b_bahanbakar_nilai;
        $total_dtl_b_bahanbakar_akumulatif       = $dtheader_row->total_dtl_b_bahanbakar_akumulatif;
        $total_dtl_b_kwh_efisiensi_nilai         = $dtheader_row->total_dtl_b_kwh_efisiensi_nilai;
        $total_dtl_b_kwh_efisiensi_akumulatif    = $dtheader_row->total_dtl_b_kwh_efisiensi_akumulatif;
        $total_dtl_b_operasi_nilai               = $dtheader_row->total_dtl_b_operasi_nilai;
        $total_dtl_b_operasi_akumulatif          = $dtheader_row->total_dtl_b_operasi_akumulatif;
        $total_dtl_b_solar_nilai                 = $dtheader_row->total_dtl_b_solar_nilai;
        $total_dtl_b_solar_akumulatif            = $dtheader_row->total_dtl_b_solar_akumulatif;
        $total_real_pakai                        = $dtheader_row->total_real_pakai;
        $total_kwh_generator1_nilai              = $dtheader_row->total_kwh_generator1_nilai;
        $total_kwh_generator2_nilai              = $dtheader_row->total_kwh_generator2_nilai;
        $total_star_genset                       = $dtheader_row->total_star_genset;
        $total_generator                         = $dtheader_row->total_generator;
        $total_kwh_loss_nilai                    = $dtheader_row->total_kwh_loss_nilai;
        $total_dtl_d_pemakai_kwh                 = $dtheader_row->total_dtl_d_pemakai_kwh;
        $total_dtl_d_pemakai_kwh_loss            = $dtheader_row->total_dtl_d_pemakai_kwh_loss;
        $total_dtl_d_pemakai_kwh_total           = $dtheader_row->total_dtl_d_pemakai_kwh_total;
        $total_dtl_d_pemakai_persen              = $dtheader_row->total_dtl_d_pemakai_persen;
        $total_dtl_d_pemakai_akumulatif          = $dtheader_row->total_dtl_d_pemakai_akumulatif;
        $total_dtl_d_bahan_bakar_kwh             = $dtheader_row->total_dtl_d_bahan_bakar_kwh;
        $total_dtl_d_bahan_bakar_persen          = $dtheader_row->total_dtl_d_bahan_bakar_persen;
        $total_dtl_d_bahan_bakar_akumulatif      = $dtheader_row->total_dtl_d_bahan_bakar_akumulatif;
        $ef_ton_steam                            = $dtheader_row->ef_ton_steam;
        $ef_kg_bb                                = $dtheader_row->ef_kg_bb;
        $stock_batubara                          = $dtheader_row->stock_batubara;
        $ef_kwh                                  = $dtheader_row->ef_kwh;
        $ef_bb                                   = $dtheader_row->ef_bb;
        $ef_kwh2                                 = $dtheader_row->ef_kwh2;
        $ef_bb2                                  = $dtheader_row->ef_bb2;
        // $loss_kwh                                = $dtheader_row->loss_kwh;
        // $loss_kwh_akm                            = $dtheader_row->loss_kwh_akm;
        // $loss_bb                                 = $dtheader_row->loss_bb;
        // $loss_bb_akm                             = $dtheader_row->loss_bb_akm;
        // $loss_efisiensi                          = $dtheader_row->loss_efisiensi;
        // $loss_efisiensi_akm                      = $dtheader_row->loss_efisiensi_akm;
        // $loss_jam                                = $dtheader_row->loss_jam;
        // $loss_jam_akm                            = $dtheader_row->loss_jam_akm;
        // $loss_solar                              = $dtheader_row->loss_solar;
        // $loss_solar_akm                          = $dtheader_row->loss_solar_akm;
    }
} else if (isset($message)) {
    $aksi                                    = "dtsave";
    $create_date                             = $dtcreate_date;
    $docno                                   = $dtdocno;
    $supplay_pwh                             = $dtsupplay_pwh;
    $total_dtl_e_kwh_nilai                   = $dttotal_dtl_e_kwh_nilai;
    $total_dtl_e_kwh_akumulatif              = $dttotal_dtl_e_kwh_akumulatif;
    $total_dtl_a_steam_nilai                 = $dttotal_dtl_a_steam_nilai;
    $total_dtl_a_steam_akumulatif            = $dttotal_dtl_a_steam_akumulatif;
    $total_dtl_a_press_nilai                 = $dttotal_dtl_a_press_nilai;
    $total_dtl_a_press_akumulatif            = $dttotal_dtl_a_press_akumulatif;
    $total_dtl_a_batubara_nilai              = $dttotal_dtl_a_batubara_nilai;
    $total_dtl_a_batubara_akumulatif         = $dttotal_dtl_a_batubara_akumulatif;
    $total_dtl_a_debu_nilai                  = $dttotal_dtl_a_debu_nilai;
    $total_dtl_a_debu_akumulatif             = $dttotal_dtl_a_debu_akumulatif;
    $total_dtl_a_cocopit_nilai               = $dttotal_dtl_a_cocopit_nilai;
    $total_dtl_a_cocopit_akumulatif          = $dttotal_dtl_a_cocopit_akumulatif;
    $total_dtl_a_tempurung_nilai             = $dttotal_dtl_a_tempurung_nilai;
    $total_dtl_a_tempurung_akumulatif        = $dttotal_dtl_a_tempurung_akumulatif;
    $total_dtl_a_bb_nilai                    = $dttotal_dtl_a_bb_nilai;
    $total_dtl_a_bb_akumulatif               = $dttotal_dtl_a_bb_akumulatif;
    $total_dtl_a_sabut_nilai                 = $dttotal_dtl_a_sabut_nilai;
    $total_dtl_a_sabut_akumulatif            = $dttotal_dtl_a_sabut_akumulatif;
    $total_dtl_a_steam_batubara_nilai        = $dttotal_dtl_a_steam_batubara_nilai;
    $total_dtl_a_steam_batubara_akumulatif   = $dttotal_dtl_a_steam_batubara_akumulatif;
    $total_dtl_a_steam_bahanbakar_nilai      = $dttotal_dtl_a_steam_bahanbakar_nilai;
    $total_dtl_a_steam_bahanbakar_akumulatif = $dttotal_dtl_a_steam_bahanbakar_akumulatif;
    $total_dtl_a_operasi_nilai               = $dttotal_dtl_a_operasi_nilai;
    $total_dtl_a_operasi_akumulatif          = $dttotal_dtl_a_operasi_akumulatif;
    $total_dtl_a_dearator_nilai              = $dttotal_dtl_a_dearator_nilai;
    $total_dtl_a_dearator_akumulatif         = $dttotal_dtl_a_dearator_akumulatif;
    $total_dtl_a_demian_nilai                = $dttotal_dtl_a_demian_nilai;
    $total_dtl_a_demian_akumulatif           = $dttotal_dtl_a_demian_akumulatif;
    $total_dtl_a_ct_nilai                    = $dttotal_dtl_a_ct_nilai;
    $total_dtl_a_ct_akumulatif               = $dttotal_dtl_a_ct_akumulatif;
    $total_2generator                        = $dttotal_2generator;
    $total_2generator_akumulatif             = $dttotal_2generator_akumulatif;
    $dtl_b_kwh_nilai                         = $dtdtl_b_kwh_nilai;
    $selisih_kwh_generator                   = $dtselisih_kwh_generator;
    $total_dtl_b_kwh_akumulatif              = $dttotal_dtl_b_kwh_akumulatif;
    $total_dtl_b_bahanbakar_nilai            = $dttotal_dtl_b_bahanbakar_nilai;
    $total_dtl_b_bahanbakar_akumulatif       = $dttotal_dtl_b_bahanbakar_akumulatif;
    $total_dtl_b_kwh_efisiensi_nilai         = $dttotal_dtl_b_kwh_efisiensi_nilai;
    $total_dtl_b_kwh_efisiensi_akumulatif    = $dttotal_dtl_b_kwh_efisiensi_akumulatif;
    $total_dtl_b_operasi_nilai               = $dttotal_dtl_b_operasi_nilai;
    $total_dtl_b_operasi_akumulatif          = $dttotal_dtl_b_operasi_akumulatif;
    $total_dtl_b_solar_nilai                 = $dttotal_dtl_b_solar_nilai;
    $total_dtl_b_solar_akumulatif            = $dttotal_dtl_b_solar_akumulatif;
    $total_real_pakai                        = $dttotal_real_pakai;
    $total_kwh_generator1_nilai              = $dttotal_kwh_generator1_nilai;
    $total_kwh_generator2_nilai              = $dttotal_kwh_generator2_nilai;
    $total_star_genset                       = $dttotal_star_genset;
    $total_generator                         = $dttotal_generator;
    $total_kwh_loss_nilai                    = $dttotal_kwh_loss_nilai;
    $total_dtl_d_pemakai_kwh                 = $dttotal_dtl_d_pemakai_kwh;
    $total_dtl_d_pemakai_kwh_loss            = $dttotal_dtl_d_pemakai_kwh_loss;
    $total_dtl_d_pemakai_kwh_total           = $dttotal_dtl_d_pemakai_kwh_total;
    $total_dtl_d_pemakai_persen              = $dttotal_dtl_d_pemakai_persen;
    $total_dtl_d_pemakai_akumulatif          = $dttotal_dtl_d_pemakai_akumulatif;
    $total_dtl_d_bahan_bakar_kwh             = $dttotal_dtl_d_bahan_bakar_kwh;
    $total_dtl_d_bahan_bakar_persen          = $dttotal_dtl_d_bahan_bakar_persen;
    $total_dtl_d_bahan_bakar_akumulatif      = $dttotal_dtl_d_bahan_bakar_akumulatif;
    $ef_ton_steam                            = $dtef_ton_steam;
    $ef_kg_bb                                = $dtef_kg_bb;
    $stock_batubara                          = $dtstock_batubara;
    $ef_kwh                                  = $dtef_kwh;
    $ef_bb                                   = $dtef_bb;
    $ef_kwh2                                 = $dtef_kwh2;
    $ef_bb2                                  = $dtef_bb2;
    // $loss_kwh                                = $dtloss_kwh;
    // $loss_kwh_akm                            = $dtloss_kwh_akm;
    // $loss_bb                                 = $dtloss_bb;
    // $loss_bb_akm                             = $dtloss_bb_akm;
    // $loss_efisiensi                          = $dtloss_efisiensi;
    // $loss_efisiensi_akm                      = $dtloss_efisiensi_akm;
    // $loss_jam                                = $dtloss_jam;
    // $loss_jam_akm                            = $dtloss_jam_akm;
    // $loss_solar                              = $dtloss_solar;
    // $loss_solar_akm                          = $dtloss_solar_akm;
} else {
    $aksi                                    = "dtsave";
    $create_date                             = date("d-m-Y", strtotime($dtcreate_date));;
    $docno                                   = '';
    $supplay_pwh                             = 0;
    $total_dtl_e_kwh_nilai                   = 0;
    $total_dtl_e_kwh_akumulatif              = 0;
    $total_dtl_a_steam_nilai                 = 0;
    $total_dtl_a_steam_akumulatif            = 0;
    $total_dtl_a_press_nilai                 = 0;
    $total_dtl_a_press_akumulatif            = 0;
    $total_dtl_a_batubara_nilai              = 0;
    $total_dtl_a_batubara_akumulatif         = 0;
    $total_dtl_a_debu_nilai                  = 0;
    $total_dtl_a_debu_akumulatif             = 0;
    $total_dtl_a_cocopit_nilai               = 0;
    $total_dtl_a_cocopit_akumulatif          = 0;
    $total_dtl_a_tempurung_nilai             = 0;
    $total_dtl_a_tempurung_akumulatif        = 0;
    $total_dtl_a_bb_nilai                    = 0;
    $total_dtl_a_bb_akumulatif               = 0;
    $total_dtl_a_sabut_nilai                 = 0;
    $total_dtl_a_sabut_akumulatif            = 0;
    $total_dtl_a_steam_batubara_nilai        = 0;
    $total_dtl_a_steam_batubara_akumulatif   = 0;
    $total_dtl_a_steam_bahanbakar_nilai      = 0;
    $total_dtl_a_steam_bahanbakar_akumulatif = 0;
    $total_dtl_a_operasi_nilai               = 0;
    $total_dtl_a_operasi_akumulatif          = 0;
    $total_dtl_a_dearator_nilai              = 0;
    $total_dtl_a_dearator_akumulatif         = 0;
    $total_dtl_a_demian_nilai                = 0;
    $total_dtl_a_demian_akumulatif           = 0;
    $total_dtl_a_ct_nilai                    = 0;
    $total_dtl_a_ct_akumulatif               = 0;
    $total_2generator                        = 0;
    $total_2generator_akumulatif             = 0;
    $selisih_kwh_generator                   = 0;
    $total_dtl_b_kwh_nilai                   = 0;
    $total_dtl_b_kwh_akumulatif              = 0;
    $total_dtl_b_bahanbakar_nilai            = 0;
    $total_dtl_b_bahanbakar_akumulatif       = 0;
    $total_dtl_b_kwh_efisiensi_nilai         = 0;
    $total_dtl_b_kwh_efisiensi_akumulatif    = 0;
    $total_dtl_b_operasi_nilai               = 0;
    $total_dtl_b_operasi_akumulatif          = 0;
    $total_dtl_b_solar_nilai                 = 0;
    $total_dtl_b_solar_akumulatif            = 0;
    $total_real_pakai                        = 0;
    $total_kwh_generator1_nilai              = 0;
    $total_kwh_generator2_nilai              = 0;
    $total_star_genset                       = 0;
    $total_generator                         = 0;
    $total_kwh_loss_nilai                    = 0;
    $total_dtl_d_pemakai_kwh                 = 0;
    $total_dtl_d_pemakai_kwh_loss            = 0;
    $total_dtl_d_pemakai_kwh_total           = 0;
    $total_dtl_d_pemakai_persen              = 0;
    $total_dtl_d_pemakai_akumulatif          = 0;
    $total_dtl_d_bahan_bakar_kwh             = 0;
    $total_dtl_d_bahan_bakar_persen          = 0;
    $total_dtl_d_bahan_bakar_akumulatif      = 0;
    $ef_ton_steam                            = 0;
    $ef_kg_bb                                = 0;
    $stock_batubara                          = 0;
    $ef_kwh                                  = 0;
    $ef_bb                                   = 0;
    $ef_kwh2                                 = 0;
    $ef_bb2                                  = 0;
    // $loss_kwh                                = 0;
    // $loss_kwh_akm                            = 0;
    // $loss_bb                                 = 0;
    // $loss_bb_akm                             = 0;
    // $loss_efisiensi                          = 0;
    // $loss_efisiensi_akm                      = 0;
    // $loss_jam                                = 0;
    // $loss_jam_akm                            = 0;
    // $loss_solar                              = 0;
    // $loss_solar_akm                          = 0;
} ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="mt-2 mb-1 d-flex justify-content-center">
                        <img src="<?= base_url('assets/images/Logo_PSG.gif') ?>" />
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

                        <form action="<?= base_url('form_input/C_forminttbn009_02/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="forminttbn009" name="forminttbn009" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
                            <div class="row mb-1">
                                <div class="col-6">

                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?= $headerid; ?>" id="headerid" class="headerid">
                                    <?php } ?>

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
                                            <input type="text" name="docno" id="docno" class="form-control docno dtopen_blok" value="<?= $docno; ?>" readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END HEADER -->

                            <div class="card-content">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Tabel A ditarik dari form 009 -->
                                        <strong>A. Catatan KWH Generator</strong>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <!-- <th class="table-danger align-middle text-center" rowspan="1" colspan="1" style="position: sticky;left: 0;top: auto;">No.</th> -->
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">GENERATOR</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">SHIFT</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">READ CT</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">PUTARAN</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">KWH</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">AKUMULATIF</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_e">
                                                    <?php if (isset($dtdetail_e)) { ?>
                                                        <?php foreach ($dtdetail_e as $dtdetail_e_row) {  ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_e_generator[]" id="dtl_e_generator" class="dtl_e_generator form-control w-auto" style="text-align: center;" value="<?= $dtdetail_e_row->generator; ?>">
                                                                <input type="hidden" name="dtl_e_item_id[]" id="dtl_e_item_id" class="dtl_e_item_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_e_row->item_id; ?>">
                                                                <input type="hidden" name="dtl_e_detail_id[]" id="dtl_e_detail_id" class="dtl_e_detail_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_e_row->detail_id; ?>">
                                                                <?php if ($dtdetail_e_row->nourut == '1') { ?>
                                                                    <td class="table-danger align-middle text-center" rowspan="<?= $dtdetail_e_row->nourutdesc ?>"><?= $dtdetail_e_row->generator ?></td>
                                                                <?php  } ?>
                                                                <td align="center"><input type="text" name="dtl_e_shift[]" id="dtl_e_shift" class="dtl_e_shift form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_e_row->shift; ?>" readonly></td>
                                                                <td align="center"><input type="text" name="dtl_e_read_ct[]" id="dtl_e_read_ct" class="dtl_e_read_ct  form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_e_row->read_ct; ?>"></td>
                                                                <td align="center"><input type="text" name="dtl_e_putaran[]" id="dtl_e_putaran" class="dtl_e_putaran form-control w-auto angkadantitik kwh_harian" style="text-align: center;" value="<?= $dtdetail_e_row->putaran; ?>"></td>
                                                                <td align="center"><input type="text" name="dtl_e_kwh_nilai[]" id="dtl_e_kwh_nilai" class="dtl_e_kwh_nilai form-control hitung_akm w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_e_row->kwh_nilai; ?>" readonly></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_e_kwh_akumulatif[]" id="dtl_e_kwh_akumulatif" class="dtl_e_kwh_akumulatif form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_e_row->kwh_akumulatif ?>" readonly>
                                                                    <input type="hidden" name="dtl_e_kwh_akumulatif_awal[]" id="dtl_e_kwh_akumulatif_awal" class="dtl_e_kwh_akumulatif_awal form-control w-auto" style="text-align: center;" value="<?= $dtdetail_e_row->kwh_akumulatif_awal ?>" readonly>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="table-danger align-middle text-left" rowspan="1" colspan="4" style="position: sticky;left: 0;top: auto;">Total 2 Generator</th>
                                                        <th class="table-danger align-middle text-left">
                                                            <input type="text" name="total_dtl_e_kwh_nilai" id="total_dtl_e_kwh_nilai" class="form-control total_dtl_e_kwh_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_e_kwh_nilai; ?>" readonly required>
                                                        </th>
                                                        <th class="table-danger align-middle text-left">
                                                            <input type="text" name="total_dtl_e_kwh_akumulatif" id="total_dtl_e_kwh_akumulatif" class="form-control total_dtl_e_kwh_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_e_kwh_akumulatif; ?>" readonly required>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-danger align-middle text-left" rowspan="1" colspan="4" style="position: sticky;left: 0;top: auto;">Supply Dari PWH</th>
                                                        <th class="table-danger align-middle text-left">
                                                            <input type="text" name="supplay_pwh" id="supplay_pwh" class="form-control supplay_pwh" style="text-align: center;" value="<?= $supplay_pwh; ?>" required>
                                                        </th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1"></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Tabel A ditarik dari form 009 -->
                                        <strong>B. Data Harian Pemakaian Steam</strong>
                                        <div class="table-responsive" id="scrolling_table_2">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="3" colspan="1">No.</th>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="3" colspan="1">Departemen</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="4">STEAM</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="12">BAHAN BAKAR</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2" colspan="2">EFFESIENSI<br />Steam Kg/ Kg Batu Bara</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2" colspan="2">EFFESIENSI<br />Steam Kg/ Kg Bahan Bakar</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2" colspan="2">Jam Operasi</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2" colspan="2">Air Deator</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2" colspan="2">Air Demin</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2" colspan="2">Air CT</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Steam (Ton)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Press (Bar)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Batubara (Kg)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Debu Arang (Kg)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Cocopit (Kg)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Tempurung (kg)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Pakai Bahan Bakar (a+b+c+d)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Sabut (Kg)</th>
                                                    </tr>
                                                    <tr>
                                                        <?php for ($i = 1; $i <= 14; $i++) { ?>
                                                            <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Hari ini</th>
                                                            <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_a">
                                                    <?php
                                                    if (isset($dtdetail)) {
                                                        $no = 1;
                                                        foreach ($dtdetail as $dtdetail_row) {
                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_a_detail_id[]" id="dtl_a_detail_id" class="dtl_a_detail_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->detail_id; ?>">
                                                                <input type="hidden" name="dtl_a_dept_steam[]" id="dtl_a_dept_steam" class="dtl_a_dept_steam form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->dept_steam; ?>">
                                                                <td align="center" class="fixed freeze_horizontal" style="background-color: #ffffff !important;"><?= $no++; ?></td>
                                                                <td align="center" class="fixed freeze_horizontal" style="background-color: #ffffff !important;"><?= $dtdetail_row->dept_steam; ?></td>
                                                                <td align="center"><input type="text" name="dtl_a_steam_nilai[]" id="dtl_a_steam_nilai" class="dtl_a_steam_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->steam_nilai; ?>"></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_steam_akumulatif[]" id="dtl_a_steam_akumulatif" class="dtl_a_steam_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->steam_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_steam_akumulatif_awal[]" id="dtl_a_steam_akumulatif_awal" class="dtl_a_steam_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->steam_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_press_nilai[]" id="dtl_a_press_nilai" class="dtl_a_press_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->press_nilai; ?>"></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_press_akumulatif[]" id="dtl_a_press_akumulatif" class="dtl_a_press_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->press_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_press_akumulatif_awal[]" id="dtl_a_press_akumulatif_awal" class="dtl_a_press_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->press_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_batubara_nilai[]" id="dtl_a_batubara_nilai" class="dtl_a_batubara_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->batubara_nilai; ?>"></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_batubara_akumulatif[]" id="dtl_a_batubara_akumulatif" class="dtl_a_batubara_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->batubara_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_batubara_akumulatif_awal[]" id="dtl_a_batubara_akumulatif_awal" class="dtl_a_batubara_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->batubara_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_debu_nilai[]" id="dtl_a_debu_nilai" class="dtl_a_debu_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->debu_nilai; ?>"></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_debu_akumulatif[]" id="dtl_a_debu_akumulatif" class="dtl_a_debu_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->debu_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_debu_akumulatif_awal[]" id="dtl_a_debu_akumulatif_awal" class="dtl_a_debu_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->debu_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_cocopit_nilai[]" id="dtl_a_cocopit_nilai" class="dtl_a_cocopit_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->cocopit_nilai; ?>"></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_cocopit_akumulatif[]" id="dtl_a_cocopit_akumulatif" class="dtl_a_cocopit_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->cocopit_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_cocopit_akumulatif_awal[]" id="dtl_a_cocopit_akumulatif_awal" class="dtl_a_cocopit_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->cocopit_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_tempurung_nilai[]" id="dtl_a_tempurung_nilai" class="dtl_a_tempurung_nilai hitung_total hitung_akm angkadantitik hitung_2generator form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->tempurung_nilai; ?>"></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_tempurung_akumulatif[]" id="dtl_a_tempurung_akumulatif" class="dtl_a_tempurung_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->tempurung_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_tempurung_akumulatif_awal[]" id="dtl_a_tempurung_akumulatif_awal" class="dtl_a_tempurung_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->tempurung_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_bb_nilai[]" id="dtl_a_bb_nilai" class="dtl_a_bb_nilai hitung_total hitung_akm angkadantitik form-control w-auto tes_hsl" style="text-align: center;" value="<?= $dtdetail_row->bb_nilai; ?>"></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_bb_akumulatif[]" id="dtl_a_bb_akumulatif" class="dtl_a_bb_akumulatif hitung_total angkadantitik form-control w-auto tes_akm" style="text-align: center;" value="<?= $dtdetail_row->bb_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_bb_akumulatif_awal[]" id="dtl_a_bb_akumulatif_awal" class="dtl_a_bb_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->bb_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_sabut_nilai[]" id="dtl_a_sabut_nilai" class="dtl_a_sabut_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->sabut_nilai; ?>"></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_sabut_akumulatif[]" id="dtl_a_sabut_akumulatif" class="dtl_a_sabut_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->sabut_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_sabut_akumulatif_awal[]" id="dtl_a_sabut_akumulatif_awal" class="dtl_a_sabut_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->sabut_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_steam_batubara_nilai[]" id="dtl_a_steam_batubara_nilai" class="dtl_a_steam_batubara_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->steam_batubara_nilai; ?>" readonly></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_steam_batubara_akumulatif[]" id="dtl_a_steam_batubara_akumulatif" class="dtl_a_steam_batubara_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->steam_batubara_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_steam_batubara_akumulatif_awal[]" id="dtl_a_steam_batubara_akumulatif_awal" class="dtl_a_steam_batubara_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->steam_batubara_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_steam_bahanbakar_nilai[]" id="dtl_a_steam_bahanbakar_nilai" class="dtl_a_steam_bahanbakar_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->steam_bahanbakar_nilai; ?>" readonly></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_steam_bahanbakar_akumulatif[]" id="dtl_a_steam_bahanbakar_akumulatif" class="dtl_a_steam_bahanbakar_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->steam_bahanbakar_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_steam_bahanbakar_akumulatif_awal[]" id="dtl_a_steam_bahanbakar_akumulatif_awal" class="dtl_a_steam_bahanbakar_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->steam_bahanbakar_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_operasi_nilai[]" id="dtl_a_operasi_nilai" class="dtl_a_operasi_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->operasi_nilai; ?>"></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_operasi_akumulatif[]" id="dtl_a_operasi_akumulatif" class="dtl_a_operasi_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->operasi_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_operasi_akumulatif_awal[]" id="dtl_a_operasi_akumulatif_awal" class="dtl_a_operasi_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->operasi_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_dearator_nilai[]" id="dtl_a_dearator_nilai" class="dtl_a_dearator_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->dearator_nilai; ?>"></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_dearator_akumulatif[]" id="dtl_a_dearator_akumulatif" class="dtl_a_dearator_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->dearator_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_dearator_akumulatif_awal[]" id="dtl_a_dearator_akumulatif_awal" class="dtl_a_dearator_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->dearator_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_demian_nilai[]" id="dtl_a_demian_nilai" class="dtl_a_demian_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->demian_nilai; ?>"></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_demian_akumulatif[]" id="dtl_a_demian_akumulatif" class="dtl_a_demian_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->demian_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_demian_akumulatif_awal[]" id="dtl_a_demian_akumulatif_awal" class="dtl_a_demian_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->demian_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_ct_nilai[]" id="dtl_a_ct_nilai" class="dtl_a_ct_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->ct_nilai; ?>"></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_a_ct_akumulatif[]" id="dtl_a_ct_akumulatif" class="dtl_a_ct_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->ct_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_a_ct_akumulatif_awal[]" id="dtl_a_ct_akumulatif_awal" class="dtl_a_ct_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->ct_akumulatif_awal; ?>" readonly>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-left" rowspan="1" colspan="2" style="position: sticky;left: 0;top: auto;">Total 2 Generator</td>
                                                        <td class="table-primary align-middle text-left" rowspan="1" colspan="12"></td>
                                                        <td class="table-primary align-middle text-center">
                                                            <input type="text" name="total_2generator" id="total_2generator" class="form-control total_2generator dtopen_blok" style="text-align: center;" value="<?= $total_2generator; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center">
                                                            <input type="text" name="total_2generator_akumulatif" id="total_2generator_akumulatif" class="form-control total_2generator_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_2generator_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-left" rowspan="1" colspan="14"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="2" style="position: sticky;left: 0;top: auto;">Total</td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_steam_nilai" id="total_dtl_a_steam_nilai" class="form-control total_dtl_a_steam_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_steam_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_steam_akumulatif" id="total_dtl_a_steam_akumulatif" class="form-control total_dtl_a_steam_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_steam_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_press_nilai" id="total_dtl_a_press_nilai" class="form-control total_dtl_a_press_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_press_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_press_akumulatif" id="total_dtl_a_press_akumulatif" class="form-control total_dtl_a_press_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_press_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_batubara_nilai" id="total_dtl_a_batubara_nilai" class="form-control total_dtl_a_batubara_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_batubara_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_batubara_akumulatif" id="total_dtl_a_batubara_akumulatif" class="form-control total_dtl_a_batubara_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_batubara_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_debu_nilai" id="total_dtl_a_debu_nilai" class="form-control total_dtl_a_debu_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_debu_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_debu_akumulatif" id="total_dtl_a_debu_akumulatif" class="form-control total_dtl_a_debu_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_debu_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_cocopit_nilai" id="total_dtl_a_cocopit_nilai" class="form-control total_dtl_a_cocopit_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_cocopit_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_cocopit_akumulatif" id="total_dtl_a_cocopit_akumulatif" class="form-control total_dtl_a_cocopit_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_cocopit_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_tempurung_nilai" id="total_dtl_a_tempurung_nilai" class="form-control total_dtl_a_tempurung_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_tempurung_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_tempurung_akumulatif" id="total_dtl_a_tempurung_akumulatif" class="form-control total_dtl_a_tempurung_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_tempurung_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_bb_nilai" id="total_dtl_a_bb_nilai" class="form-control total_dtl_a_bb_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_bb_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_bb_akumulatif" id="total_dtl_a_bb_akumulatif" class="form-control total_dtl_a_bb_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_bb_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_sabut_nilai" id="total_dtl_a_sabut_nilai" class="form-control total_dtl_a_sabut_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_sabut_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_sabut_akumulatif" id="total_dtl_a_sabut_akumulatif" class="form-control total_dtl_a_sabut_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_sabut_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_steam_batubara_nilai" id="total_dtl_a_steam_batubara_nilai" class="form-control total_dtl_a_steam_batubara_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_steam_batubara_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_steam_batubara_akumulatif" id="total_dtl_a_steam_batubara_akumulatif" class="form-control total_dtl_a_steam_batubara_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_steam_batubara_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_steam_bahanbakar_nilai" id="total_dtl_a_steam_bahanbakar_nilai" class="form-control total_dtl_a_steam_bahanbakar_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_steam_bahanbakar_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_steam_bahanbakar_akumulatif" id="total_dtl_a_steam_bahanbakar_akumulatif" class="form-control total_dtl_a_steam_bahanbakar_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_steam_bahanbakar_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_operasi_nilai" id="total_dtl_a_operasi_nilai" class="form-control total_dtl_a_operasi_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_operasi_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_operasi_akumulatif" id="total_dtl_a_operasi_akumulatif" class="form-control total_dtl_a_operasi_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_operasi_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_dearator_nilai" id="total_dtl_a_dearator_nilai" class="form-control total_dtl_a_dearator_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_dearator_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_dearator_akumulatif" id="total_dtl_a_dearator_akumulatif" class="form-control total_dtl_a_dearator_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_dearator_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_demian_nilai" id="total_dtl_a_demian_nilai" class="form-control total_dtl_a_demian_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_demian_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_demian_akumulatif" id="total_dtl_a_demian_akumulatif" class="form-control total_dtl_a_demian_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_demian_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_ct_nilai" id="total_dtl_a_ct_nilai" class="form-control total_dtl_a_ct_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_ct_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_a_ct_akumulatif" id="total_dtl_a_ct_akumulatif" class="form-control total_dtl_a_ct_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_a_ct_akumulatif; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel B ditarik dari form 009 -->
                                        <strong>C. Pemakaian Trafo</strong>
                                        <div class="table-responsive" id="scrolling_table_4" style="max-height: 850px;">
                                            <table class="table table-striped table-bordered">
                                                <thead class="fixed freeze_vertical">
                                                    <tr>
                                                        <th class="fixed freeze_horizontal table-info align-middle text-center" rowspan="3" colspan="1">No.</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="11">CATATAN KWH TRAFO</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="2">REKAP BAHAN BAKAR</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="2">EFISIENSI</th>
                                                        <th class="table-info align-middle text-center" rowspan="2" colspan="2">Jam Operasi</th>
                                                        <th class="table-info align-middle text-center" rowspan="2" colspan="2">Solar</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="fixed freeze_horizontal table-info align-middle text-center" rowspan="3" colspan="1">Kode Trafo</th>
                                                        <th class="fixed freeze_horizontal table-info align-middle text-center" rowspan="3" colspan="1">Nama Trafo</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="3">6k5 & 6k6</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="6">6K1,6K3,6K4,6K8,6K9,6K10,6K11,6K12,6K13,611,622,633,1#IDF,2#IDF,3IDF,1PAF,2#PAF,3PAF</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="2">Bahan Bakar</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="2">KWH / Kg Bahan Bakar</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Rata2/hari</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Jam</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">KWH</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">READ CT</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">AWAL</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">AKHIR</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">PUTARAN</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">KWH HARI INI</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif KWH</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Hari ini</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Hari ini</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Hari ini</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Hari ini</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_b">
                                                    <?php
                                                    if (isset($dtdetail_b)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_b as $dtdetail_b_row) {
                                                            // echo "<pre>";
                                                            // print_r($dtdetail_b);exit();
                                                            // echo "</pre>";
                                                            if (($dtdetail_b_row->read_ct_trafo != '')  && ($dtdetail_b_row->trafo != 'LOSS')) { ?>
                                                                <tr>
                                                                    <input type="hidden" name="dtl_b_detail_id[]" id="dtl_b_detail_id" class="dtl_b_detail_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->detail_id; ?>">
                                                                    <input type="hidden" name="dtl_b_trafo[]" id="dtl_b_trafo" class="dtl_b_trafo form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->trafo; ?>">
                                                                    <input type="hidden" name="dtl_b_nama_trafo[]" id="dtl_b_nama_trafo" class="dtl_b_nama_trafo form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->nama_trafo; ?>">
                                                                    <input type="hidden" name="dtl_b_read_ct_trafo[]" id="dtl_b_read_ct_trafo" class="dtl_b_read_ct_trafo form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->read_ct_trafo; ?>">
                                                                    <td align="center"><?= $no++; ?></td>
                                                                    <td align="center"><?= $dtdetail_b_row->trafo; ?></td>
                                                                    <td align="left"><?= $dtdetail_b_row->nama_trafo; ?></td>
                                                                    <td align="center"><input type="text" name="dtl_b_rata_hari[]" id="dtl_b_rata_hari" class="dtl_b_rata_hari hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->rata_hari; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_b_jam[]" id="dtl_b_jam" class="dtl_b_jam hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->jam; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_6k5_nilai[]" id="dtl_b_kwh_6k5_nilai" class="dtl_b_kwh_6k5_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_6k5_nilai; ?>" readonly></td>
                                                                    <td align="center"><?= $dtdetail_b_row->read_ct_trafo; ?></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_awal[]" id="dtl_b_trafo_awal" class="dtl_b_trafo_awal hitung_total hitung_akm hitung_selisih form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->trafo_awal; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_akhir[]" id="dtl_b_trafo_akhir" class="dtl_b_trafo_akhir hitung_total hitung_akm hitung_selisih form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->trafo_akhir; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_putaran[]" id="dtl_b_trafo_putaran" class="dtl_b_trafo_putaran hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->trafo_putaran; ?>" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_nilai[]" id="dtl_b_kwh_nilai" class="dtl_b_kwh_nilai hitung_selisih hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_nilai; ?>"></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_akumulatif[]" id="dtl_b_kwh_akumulatif" class="dtl_b_kwh_akumulatif hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_akumulatif_awal[]" id="dtl_b_kwh_akumulatif_awal" class="dtl_b_kwh_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_bahanbakar_nilai[]" id="dtl_b_bahanbakar_nilai" class="dtl_b_bahanbakar_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->bahanbakar_nilai; ?>"></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_bahanbakar_akumulatif[]" id="dtl_b_bahanbakar_akumulatif" class="dtl_b_bahanbakar_akumulatif hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->bahanbakar_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_bahanbakar_akumulatif_awal[]" id="dtl_b_bahanbakar_akumulatif_awal" class="dtl_b_bahanbakar_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->bahanbakar_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_efisiensi_nilai[]" id="dtl_b_kwh_efisiensi_nilai" class="dtl_b_kwh_efisiensi_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_efisiensi_nilai; ?>" readonly></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_efisiensi_akumulatif[]" id="dtl_b_kwh_efisiensi_akumulatif" class="dtl_b_kwh_efisiensi_akumulatif hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_efisiensi_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_efisiensi_akumulatif_awal[]" id="dtl_b_kwh_efisiensi_akumulatif_awal" class="dtl_b_kwh_efisiensi_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_efisiensi_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->operasi_nilai; ?>"></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->operasi_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_operasi_akumulatif_awal[]" id="dtl_b_operasi_akumulatif_awal" class="dtl_b_operasi_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->operasi_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_solar_nilai[]" id="dtl_b_solar_nilai" class="dtl_b_solar_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->solar_nilai; ?>"></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_solar_akumulatif[]" id="dtl_b_solar_akumulatif" class="dtl_b_solar_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->solar_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_solar_akumulatif_awal[]" id="dtl_b_solar_akumulatif_awal" class="dtl_b_solar_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->solar_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                </tr>
                                                            <?php } else if (($dtdetail_b_row->read_ct_trafo == '') && ($dtdetail_b_row->trafo == 'LOSS')) { ?>
                                                                <tr>
                                                                    <input type="hidden" name="dtl_b_detail_id[]" id="dtl_b_detail_id" class="dtl_b_detail_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->detail_id; ?>">
                                                                    <input type="hidden" name="dtl_b_trafo[]" id="dtl_b_trafo" class="dtl_b_trafo form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->trafo; ?>">
                                                                    <input type="hidden" name="dtl_b_nama_trafo[]" id="dtl_b_nama_trafo" class="dtl_b_nama_trafo form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->nama_trafo; ?>">
                                                                    <input type="hidden" name="dtl_b_read_ct_trafo[]" id="dtl_b_read_ct_trafo" class="dtl_b_read_ct_trafo form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->read_ct_trafo; ?>">
                                                                    <td align="center"><?= $no++; ?></td>
                                                                    <td align="center"><?= $dtdetail_b_row->trafo; ?></td>
                                                                    <td align="left"><?= $dtdetail_b_row->nama_trafo; ?></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_rata_hari[]" id="dtl_b_rata_hari" class="dtl_b_rata_hari hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->rata_hari; ?>"></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_jam[]" id="dtl_b_jam" class="dtl_b_jam hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->jam; ?>"></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_kwh_6k5_nilai[]" id="dtl_b_kwh_6k5_nilai" class="dtl_b_kwh_6k5_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_6k5_nilai; ?>" readonly></td>
                                                                    <td align="center"><?= $dtdetail_b_row->read_ct_trafo; ?></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_trafo_awal[]" id="dtl_b_trafo_awal" class="dtl_b_trafo_awal hitung_total hitung_akm hitung_selisih form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->trafo_awal; ?>"></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_trafo_akhir[]" id="dtl_b_trafo_akhir" class="dtl_b_trafo_akhir hitung_total hitung_akm hitung_selisih form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->trafo_akhir; ?>"></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_trafo_putaran[]" id="dtl_b_trafo_putaran" class="dtl_b_trafo_putaran hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->trafo_putaran; ?>" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_nilai[]" id="dtl_b_kwh_nilai" class="dtl_b_kwh_nilai hitung_selisih hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_nilai; ?>"></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_akumulatif[]" id="dtl_b_kwh_akumulatif" class="dtl_b_kwh_akumulatif hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_akumulatif_awal[]" id="dtl_b_kwh_akumulatif_awal" class="dtl_b_kwh_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_bahanbakar_nilai[]" id="dtl_b_bahanbakar_nilai" class="dtl_b_bahanbakar_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->bahanbakar_nilai; ?>"></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_bahanbakar_akumulatif[]" id="dtl_b_bahanbakar_akumulatif" class="dtl_b_bahanbakar_akumulatif hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->bahanbakar_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_bahanbakar_akumulatif_awal[]" id="dtl_b_bahanbakar_akumulatif_awal" class="dtl_b_bahanbakar_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->bahanbakar_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_efisiensi_nilai[]" id="dtl_b_kwh_efisiensi_nilai" class="dtl_b_kwh_efisiensi_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_efisiensi_nilai; ?>" readonly></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_efisiensi_akumulatif[]" id="dtl_b_kwh_efisiensi_akumulatif" class="dtl_b_kwh_efisiensi_akumulatif hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_efisiensi_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_efisiensi_akumulatif_awal[]" id="dtl_b_kwh_efisiensi_akumulatif_awal" class="dtl_b_kwh_efisiensi_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_efisiensi_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->operasi_nilai; ?>"></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->operasi_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_operasi_akumulatif_awal[]" id="dtl_b_operasi_akumulatif_awal" class="dtl_b_operasi_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->operasi_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_solar_nilai[]" id="dtl_b_solar_nilai" class="dtl_b_solar_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->solar_nilai; ?>"></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_solar_akumulatif[]" id="dtl_b_solar_akumulatif" class="dtl_b_solar_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->solar_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_solar_akumulatif_awal[]" id="dtl_b_solar_akumulatif_awal" class="dtl_b_solar_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->solar_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                </tr>
                                                            <?php } else { ?>
                                                                <tr>
                                                                    <input type="hidden" name="dtl_b_detail_id[]" id="dtl_b_detail_id" class="dtl_b_detail_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->detail_id; ?>">
                                                                    <input type="hidden" name="dtl_b_trafo[]" id="dtl_b_trafo" class="dtl_b_trafo form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->trafo; ?>">
                                                                    <input type="hidden" name="dtl_b_nama_trafo[]" id="dtl_b_nama_trafo" class="dtl_b_nama_trafo form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->nama_trafo; ?>">
                                                                    <input type="hidden" name="dtl_b_read_ct_trafo[]" id="dtl_b_read_ct_trafo" class="dtl_b_read_ct_trafo form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->read_ct_trafo; ?>">
                                                                    <td align="center"><?= $no++; ?></td>
                                                                    <td align="center"><?= $dtdetail_b_row->trafo; ?></td>
                                                                    <td align="left"><?= $dtdetail_b_row->nama_trafo; ?></td>
                                                                    <td align="center"><input type="text" name="dtl_b_rata_hari[]" id="dtl_b_rata_hari" class="dtl_b_rata_hari hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->rata_hari; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_b_jam[]" id="dtl_b_jam" class="dtl_b_jam hitung_total hitung_akm form-control w-auto angkadantitik hitung_selisih" style="text-align: center;" value="<?= $dtdetail_b_row->jam; ?>"></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_kwh_6k5_nilai[]" id="dtl_b_kwh_6k5_nilai" class="dtl_b_kwh_6k5_nilai hitung_total hitung_akm hitung_selisih form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_6k5_nilai; ?>" readonly></td>
                                                                    <td align="center"><?= $dtdetail_b_row->read_ct_trafo; ?></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_awal[]" id="dtl_b_trafo_awal" class="dtl_b_trafo_awal hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->trafo_awal; ?>" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_akhir[]" id="dtl_b_trafo_akhir" class="dtl_b_trafo_akhir hitung_total hitung_akm hitung_selisih form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->trafo_akhir; ?>" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_putaran[]" id="dtl_b_trafo_putaran" class="dtl_b_trafo_putaran hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_b_row->trafo_putaran; ?>" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_nilai[]" id="dtl_b_kwh_nilai" class="dtl_b_kwh_nilai hitung_selisih hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_nilai; ?>" readonly></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_akumulatif[]" id="dtl_b_kwh_akumulatif" class="dtl_b_kwh_akumulatif hitung_total hitung_akm angkadantitik  form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_akumulatif_awal[]" id="dtl_b_kwh_akumulatif_awal" class="dtl_b_kwh_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_bahanbakar_nilai[]" id="dtl_b_bahanbakar_nilai" class="dtl_b_bahanbakar_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->bahanbakar_nilai; ?>"></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_bahanbakar_akumulatif[]" id="dtl_b_bahanbakar_akumulatif" class="dtl_b_bahanbakar_akumulatif hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->bahanbakar_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_bahanbakar_akumulatif_awal[]" id="dtl_b_bahanbakar_akumulatif_awal" class="dtl_b_bahanbakar_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->bahanbakar_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_efisiensi_nilai[]" id="dtl_b_kwh_efisiensi_nilai" class="dtl_b_kwh_efisiensi_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_efisiensi_nilai; ?>" readonly></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_efisiensi_akumulatif[]" id="dtl_b_kwh_efisiensi_akumulatif" class="dtl_b_kwh_efisiensi_akumulatif hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_efisiensi_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_efisiensi_akumulatif_awal[]" id="dtl_b_kwh_efisiensi_akumulatif_awal" class="dtl_b_kwh_efisiensi_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->kwh_efisiensi_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->operasi_nilai; ?>"></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->operasi_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_operasi_akumulatif_awal[]" id="dtl_b_operasi_akumulatif_awal" class="dtl_b_operasi_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->operasi_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_solar_nilai[]" id="dtl_b_solar_nilai" class="dtl_b_solar_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->solar_nilai; ?>"></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_solar_akumulatif[]" id="dtl_b_solar_akumulatif" class="dtl_b_solar_akumulatif hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->solar_akumulatif; ?>" readonly>
                                                                        <input type="hidden" name="dtl_b_solar_akumulatif_awal[]" id="dtl_b_solar_akumulatif_awal" class="dtl_b_solar_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_b_row->solar_akumulatif_awal; ?>" readonly>
                                                                    </td>
                                                                </tr>
                                                    <?php }
                                                        }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <!-- <tr>
                                                        <td class="table-info align-middle text-left" rowspan="1" colspan="10">LOSS</td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="loss_kwh" id="loss_kwh" class="form-control" style="text-align: center;" value="<?= $loss_kwh; ?>">
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="loss_kwh_akm" id="loss_kwh_akm" class="form-control" style="text-align: center;" value="<?= $loss_kwh_akm; ?>">
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="loss_bb" id="loss_bb" class="form-control dtopen_blok" style="text-align: center;" value="<?= $loss_bb; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="loss_bb_akm" id="loss_bb_akm" class="form-control dtopen_blok" style="text-align: center;" value="<?= $loss_bb_akm; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="loss_efisiensi" id="loss_efisiensi" class="form-control dtopen_blok" style="text-align: center;" value="<?= $loss_efisiensi; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="loss_efisiensi_akm" id="loss_efisiensi_akm" class="form-control dtopen_blok" style="text-align: center;" value="<?= $loss_efisiensi_akm; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="loss_jam" id="loss_jam" class="form-control dtopen_blok" style="text-align: center;" value="<?= $loss_jam; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="loss_jam_akm" id="loss_jam_akm" class="form-control dtopen_blok" style="text-align: center;" value="<?= $loss_jam_akm; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="loss_solar" id="loss_solar" class="form-control dtopen_blok" style="text-align: center;" value="<?= $loss_solar; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="loss_solar_akm" id="loss_solar_akm" class="form-control dtopen_blok" style="text-align: center;" value="<?= $loss_solar_akm; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="8"></td> -->
                                                    </tr>
                                                    <tr>
                                                        <td class="table-info align-middle text-left" rowspan="1" colspan="10">SELISIH KWH TRAFO DAN GENERATOR</td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="selisih_kwh_generator" id="selisih_kwh_generator" class="form-control total_tralala dtopen_blok hitung_total hitung_akm" style="text-align: center;" value="<?= $selisih_kwh_generator; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="9"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-info align-middle text-left" rowspan="1" colspan="10">Total</td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_b_kwh_nilai" id="total_dtl_b_kwh_nilai" class="form-control total_total_total dtopen_blok" style="text-align: center;" value="<?= $total_dtl_b_kwh_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_b_kwh_akumulatif" id="total_dtl_b_kwh_akumulatif" class="form-control total_dtl_b_kwh_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_b_kwh_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_b_bahanbakar_nilai" id="total_dtl_b_bahanbakar_nilai" class="form-control total_dtl_b_bahanbakar_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_b_bahanbakar_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_b_bahanbakar_akumulatif" id="total_dtl_b_bahanbakar_akumulatif" class="form-control total_dtl_b_bahanbakar_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_b_bahanbakar_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_b_kwh_efisiensi_nilai" id="total_dtl_b_kwh_efisiensi_nilai" class="form-control total_dtl_b_kwh_efisiensi_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_b_kwh_efisiensi_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_b_kwh_efisiensi_akumulatif" id="total_dtl_b_kwh_efisiensi_akumulatif" class="form-control total_dtl_b_kwh_efisiensi_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_b_kwh_efisiensi_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_b_operasi_nilai" id="total_dtl_b_operasi_nilai" class="form-control total_dtl_b_operasi_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_b_operasi_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_b_operasi_akumulatif" id="total_dtl_b_operasi_akumulatif" class="form-control total_dtl_b_operasi_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_b_operasi_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_b_solar_nilai" id="total_dtl_b_solar_nilai" class="form-control total_dtl_b_solar_nilai dtopen_blok" style="text-align: center;" value="<?= $total_dtl_b_solar_nilai; ?>" readonly>
                                                        </td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_b_solar_akumulatif" id="total_dtl_b_solar_akumulatif" class="form-control total_dtl_b_solar_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_b_solar_akumulatif; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel C ditarik dari form 520 -->
                                        <strong>D. Panel Lokasi</strong>
                                        <div class="table-responsive table-hover" id="scrolling_table_1" style="max-height: 800px;">
                                            <table class="table table-striped table-bordered">
                                                <thead style="position:sticky;top: 0; z-index: 1;">
                                                    <tr>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="4">Departemen</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="3">6k6</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="2">Belum Ada Meteran Sendiri</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="4">Catatan KWH</th>
                                                        <th class="table-success align-middle text-center" rowspan="2" colspan="1">Pakai KWh real hari ini</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">KODE KWH</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Reading CT</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Nama</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Rata2/hari</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">JAM Operasi</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">KWH</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Beban Tetap/hari Berdasarkan %</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Beban Tetap/hari</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Awal</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Akhir</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Putaran</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">KWH</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_c">
                                                    <?php
                                                    if (isset($dtdetail_c)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_c as $dtdetail_c_row) {
                                                            if (($dtdetail_c_row->beban) != '') { ?>
                                                                <tr>
                                                                    <input type="hidden" name="dtl_c_detail_id[]" id="dtl_c_detail_id" class="dtl_c_detail_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->detail_id; ?>">
                                                                    <input type="hidden" name="dtl_c_reading_ct[]" id="dtl_c_reading_ct" class="dtl_c_reading_ct form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->reading_ct; ?>">
                                                                    <input type="hidden" name="dtl_c_item_id[]" id="dtl_c_item_id" class="dtl_c_item_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->dtl_c_item_id; ?>">
                                                                    <input type="hidden" name="dtl_c_dept_panel[]" id="dtl_c_dept_panel" class="dtl_c_dept_panel form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->dept_panel; ?>">
                                                                    <input type="hidden" name="dtl_c_dept_user[]" id="dtl_c_dept_user" class="dtl_c_dept_user form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->dept_user; ?>">
                                                                    <input type="hidden" name="dtl_c_status_beban[]" id="dtl_c_status_beban" class="dtl_c_status_beban form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->status_beban; ?>">
                                                                    <td align="center" class="dtl_c_nomor"><?= $no++; ?></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kode[]" id="dtl_c_kode" class="dtl_c_kode form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kode_kwh; ?>" readonly></td>
                                                                    <td align="center"><?= $dtdetail_c_row->reading_ct; ?></td>
                                                                    <td align="left"><?= $dtdetail_c_row->dept_panel; ?></td>
                                                                    <td align="center"><input type="text" name="dtl_c_rata_hari[]" id="dtl_c_rata_hari" class="dtl_c_rata_hari form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->rata_hari; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_jam_operasi[]" id="dtl_c_jam_operasi" class="dtl_c_jam_operasi form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->jam_operasi; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_6k6_hasil[]" id="dtl_c_kwh_6k6_hasil" class="dtl_c_kwh_6k6_hasil form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_6k6_hasil; ?>" readonly></td>
                                                                    <td align="center">
                                                                        <input type="hidden" name="dtl_c_beban_persen[]" id="dtl_c_beban_persen" class="dtl_c_beban_persen_<?= $dtdetail_c_row->dtl_c_item_id; ?> form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->beban_persen; ?>" readonly>
                                                                        <input type="text" name="dtl_c_beban_persen_fix[]" id="dtl_c_beban_persen_fix" class="dtl_c_beban_persen_fix_<?= $dtdetail_c_row->dtl_c_item_id; ?> form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->beban_persen_fix; ?>" readonly>
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_c_beban[]" id="dtl_c_beban" class="dtl_c_beban form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->beban; ?>"></td>
                                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_awal[]" id="dtl_c_kwh_awal" class="dtl_c_kwh_awal form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_awal; ?>"></td>
                                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_akhir[]" id="dtl_c_kwh_akhir" class="dtl_c_kwh_akhir form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_akhir; ?>"></td>
                                                                    <td align="center"><input type="hidden" name="dtl_c_putaran_hasil[]" id="dtl_c_putaran_hasil" class="dtl_c_putaran_hasil form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->putaran_hasil; ?>"></td>
                                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_nilai[]" id="dtl_c_kwh_nilai" class="dtl_c_kwh_nilai form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_nilai; ?>" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_real_nilai[]" id="dtl_c_kwh_real_nilai" class="dtl_c_kwh_real_nilai_<?= $dtdetail_c_row->dtl_c_item_id; ?> dept_kwh<?= $dtdetail_c_row->dept_user; ?>_<?= $dtdetail_c_row->status_beban; ?> total_total_nilai_<?= $dtdetail_c_row->status_beban; ?> form-control w-auto" size="10 " style="text-align: center;" value="<?= $dtdetail_c_row->kwh_real_nilai; ?>" readonly></td>
                                                                </tr>
                                                            <?php } else if (($dtdetail_c_row->beban_persen) != '') { ?>
                                                                <tr>
                                                                    <input type="hidden" name="dtl_c_detail_id[]" id="dtl_c_detail_id" class="dtl_c_detail_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->detail_id; ?>">
                                                                    <input type="hidden" name="dtl_c_reading_ct[]" id="dtl_c_reading_ct" class="dtl_c_reading_ct form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->reading_ct; ?>">
                                                                    <input type="hidden" name="dtl_c_item_id[]" id="dtl_c_item_id" class="dtl_c_item_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->dtl_c_item_id; ?>">
                                                                    <input type="hidden" name="dtl_c_dept_panel[]" id="dtl_c_dept_panel" class="dtl_c_dept_panel form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->dept_panel; ?>">
                                                                    <input type="hidden" name="dtl_c_dept_user[]" id="dtl_c_dept_user" class="dtl_c_dept_user form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->dept_user; ?>">
                                                                    <input type="hidden" name="dtl_c_status_beban[]" id="dtl_c_status_beban" class="dtl_c_status_beban form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->status_beban; ?>">
                                                                    <td align="center" class="dtl_c_nomor"><?= $no++; ?></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kode[]" id="dtl_c_kode" class="dtl_c_kode form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kode_kwh; ?>" readonly></td>
                                                                    <td align="center"><?= $dtdetail_c_row->reading_ct; ?></td>
                                                                    <td align="left"><?= $dtdetail_c_row->dept_panel; ?></td>
                                                                    <td align="center"><input type="text" name="dtl_c_rata_hari[]" id="dtl_c_rata_hari" class="dtl_c_rata_hari form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->rata_hari; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_jam_operasi[]" id="dtl_c_jam_operasi" class="dtl_c_jam_operasi form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->jam_operasi; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_6k6_hasil[]" id="dtl_c_kwh_6k6_hasil" class="dtl_c_kwh_6k6_hasil form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_6k6_hasil; ?>" readonly></td>
                                                                    <td align="center">
                                                                        <input type="hidden" name="dtl_c_beban_persen[]" id="dtl_c_beban_persen" class="dtl_c_beban_persen_<?= $dtdetail_c_row->dtl_c_item_id; ?> form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->beban_persen; ?>">
                                                                        <input type="text" name="dtl_c_beban_persen_fix[]" id="dtl_c_beban_persen_fix" class="dtl_c_beban_persen_fix_<?= $dtdetail_c_row->dtl_c_item_id; ?> form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->beban_persen_fix; ?>">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_c_beban[]" id="dtl_c_beban" class="dtl_c_beban form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_awal[]" id="dtl_c_kwh_awal" class="dtl_c_kwh_awal form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_awal; ?>"></td>
                                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_akhir[]" id="dtl_c_kwh_akhir" class="dtl_c_kwh_akhir form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_akhir; ?>"></td>
                                                                    <td align="center"><input type="hidden" name="dtl_c_putaran_hasil[]" id="dtl_c_putaran_hasil" class="dtl_c_putaran_hasil form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->putaran_hasil; ?>"></td>
                                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_nilai[]" id="dtl_c_kwh_nilai" class="dtl_c_kwh_nilai form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_nilai; ?>" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_real_nilai[]" id="dtl_c_kwh_real_nilai" class="dtl_c_kwh_real_nilai_<?= $dtdetail_c_row->dtl_c_item_id; ?> dept_kwh<?= $dtdetail_c_row->dept_user; ?>_<?= $dtdetail_c_row->status_beban; ?> total_total_nilai_<?= $dtdetail_c_row->status_beban; ?> form-control w-auto" size="10 " style="text-align: center;" value="<?= $dtdetail_c_row->kwh_real_nilai; ?>" readonly></td>
                                                                </tr>
                                                            <?php } else if (($dtdetail_c_row->status_beban) == 'TIDAK') { ?>
                                                                <tr>
                                                                    <input type="hidden" name="dtl_c_detail_id[]" id="dtl_c_detail_id" class="dtl_c_detail_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->detail_id; ?>">
                                                                    <input type="hidden" name="dtl_c_reading_ct[]" id="dtl_c_reading_ct" class="dtl_c_reading_ct form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->reading_ct; ?>">
                                                                    <input type="hidden" name="dtl_c_item_id[]" id="dtl_c_item_id" class="dtl_c_item_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->dtl_c_item_id; ?>">
                                                                    <input type="hidden" name="dtl_c_dept_panel[]" id="dtl_c_dept_panel" class="dtl_c_dept_panel form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->dept_panel; ?>">
                                                                    <input type="hidden" name="dtl_c_dept_user[]" id="dtl_c_dept_user" class="dtl_c_dept_user form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->dept_user; ?>">
                                                                    <input type="hidden" name="dtl_c_status_beban[]" id="dtl_c_status_beban" class="dtl_c_status_beban form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->status_beban; ?>">
                                                                    <td align="center" class="dtl_c_nomor"><?= $no++; ?></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kode[]" id="dtl_c_kode" class="dtl_c_kode form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kode_kwh; ?>" readonly></td>
                                                                    <td align="center"><?= $dtdetail_c_row->reading_ct; ?></td>
                                                                    <td align="left"><?= $dtdetail_c_row->dept_panel; ?></td>
                                                                    <td align="center"><input type="text" name="dtl_c_rata_hari[]" id="dtl_c_rata_hari" class="dtl_c_rata_hari form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->rata_hari; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_jam_operasi[]" id="dtl_c_jam_operasi" class="dtl_c_jam_operasi form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->jam_operasi; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_6k6_hasil[]" id="dtl_c_kwh_6k6_hasil" class="dtl_c_kwh_6k6_hasil form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_6k6_hasil; ?>" readonly></td>
                                                                    <td align="center">
                                                                        <input type="hidden" name="dtl_c_beban_persen[]" id="dtl_c_beban_persen" class="dtl_c_beban_persen_<?= $dtdetail_c_row->dtl_c_item_id; ?> form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;">
                                                                        <input type="hidden" name="dtl_c_beban_persen_fix[]" id="dtl_c_beban_persen_fix" class="dtl_c_beban_persen_fix_<?= $dtdetail_c_row->dtl_c_item_id; ?> form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;">
                                                                    </td>
                                                                    <td align="center"><input type="hidden" name="dtl_c_beban[]" id="dtl_c_beban" class="dtl_c_beban form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_awal[]" id="dtl_c_kwh_awal" class="dtl_c_kwh_awal form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_awal; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_akhir[]" id="dtl_c_kwh_akhir" class="dtl_c_kwh_akhir form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_akhir; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_putaran_hasil[]" id="dtl_c_putaran_hasil" class="dtl_c_putaran_hasil form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->putaran_hasil; ?>" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_nilai[]" id="dtl_c_kwh_nilai" class="dtl_c_kwh_nilai form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_nilai; ?>" readonly></td>
                                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_real_nilai[]" id="dtl_c_kwh_real_nilai" class="dtl_c_kwh_real_nilai_<?= $dtdetail_c_row->dtl_c_item_id; ?> dept_kwh<?= $dtdetail_c_row->dept_user; ?>_<?= $dtdetail_c_row->status_beban; ?> total_total_nilai_<?= $dtdetail_c_row->status_beban; ?> form-control w-auto" size="10   " style="text-align: center;" value="<?= $dtdetail_c_row->kwh_real_nilai; ?>"></td>
                                                                </tr>
                                                            <?php } else { ?>
                                                                <tr>
                                                                    <input type="hidden" name="dtl_c_detail_id[]" id="dtl_c_detail_id" class="dtl_c_detail_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->detail_id; ?>">
                                                                    <input type="hidden" name="dtl_c_reading_ct[]" id="dtl_c_reading_ct" class="dtl_c_reading_ct form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->reading_ct; ?>">
                                                                    <input type="hidden" name="dtl_c_item_id[]" id="dtl_c_item_id" class="dtl_c_item_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->dtl_c_item_id; ?>">
                                                                    <input type="hidden" name="dtl_c_dept_panel[]" id="dtl_c_dept_panel" class="dtl_c_dept_panel form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->dept_panel; ?>">
                                                                    <input type="hidden" name="dtl_c_dept_user[]" id="dtl_c_dept_user" class="dtl_c_dept_user form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->dept_user; ?>">
                                                                    <input type="hidden" name="dtl_c_status_beban[]" id="dtl_c_status_beban" class="dtl_c_status_beban form-control w-auto" style="text-align: center;" value="<?= $dtdetail_c_row->status_beban; ?>">
                                                                    <td align="center" class="dtl_c_nomor"><?= $no++; ?></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kode[]" id="dtl_c_kode" class="dtl_c_kode form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kode_kwh; ?>" readonly></td>
                                                                    <td align="center"><?= $dtdetail_c_row->reading_ct; ?></td>
                                                                    <td align="left"><?= $dtdetail_c_row->dept_panel; ?></td>
                                                                    <td align="center"><input type="text" name="dtl_c_rata_hari[]" id="dtl_c_rata_hari" class="dtl_c_rata_hari form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->rata_hari; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_jam_operasi[]" id="dtl_c_jam_operasi" class="dtl_c_jam_operasi form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->jam_operasi; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_6k6_hasil[]" id="dtl_c_kwh_6k6_hasil" class="dtl_c_kwh_6k6_hasil form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="5" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_6k6_hasil; ?>" readonly></td>
                                                                    <td align="center">
                                                                        <input type="hidden" name="dtl_c_beban_persen[]" id="dtl_c_beban_persen" class="dtl_c_beban_persen_<?= $dtdetail_c_row->dtl_c_item_id; ?> form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->beban_persen; ?>">
                                                                        <input type="hidden" name="dtl_c_beban_persen_fix[]" id="dtl_c_beban_persen_fix" class="dtl_c_beban_persen_fix_<?= $dtdetail_c_row->dtl_c_item_id; ?> form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->beban_persen_fix; ?>">
                                                                    </td>
                                                                    <td align="center"><input type="hidden" name="dtl_c_beban[]" id="dtl_c_beban" class="dtl_c_beban form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->beban; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_awal[]" id="dtl_c_kwh_awal" class="dtl_c_kwh_awal form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_awal; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_akhir[]" id="dtl_c_kwh_akhir" class="dtl_c_kwh_akhir form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_akhir; ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_c_putaran_hasil[]" id="dtl_c_putaran_hasil" class="dtl_c_putaran_hasil form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->putaran_hasil; ?>" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_nilai[]" id="dtl_c_kwh_nilai" class="dtl_c_kwh_nilai form-control kwh_harian_<?= $dtdetail_c_row->dtl_c_item_id; ?> w-auto angkadantitik" size="10" data-id="<?= $dtdetail_c_row->dtl_c_item_id; ?>" style="text-align: center;" value="<?= $dtdetail_c_row->kwh_nilai; ?>" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_c_kwh_real_nilai[]" id="dtl_c_kwh_real_nilai" class="dtl_c_kwh_real_nilai_<?= $dtdetail_c_row->dtl_c_item_id; ?> dept_kwh<?= $dtdetail_c_row->dept_user; ?>_<?= $dtdetail_c_row->status_beban; ?> total_total_nilai_<?= $dtdetail_c_row->status_beban; ?> form-control w-auto" size="10 " style="text-align: center;" value="<?= $dtdetail_c_row->kwh_real_nilai; ?>"></td>
                                                                </tr>
                                                    <?php }
                                                        }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-success align-middle text-right" rowspan="1" colspan="13">Total Real Pakai merupakan akumulatif keseluruhan</td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_real_pakai" id="total_real_pakai" class="form-control total_real_pakai dtopen_blok" style="text-align: center;" value="<?= $total_real_pakai; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-success align-middle text-right" rowspan="1" colspan="13">Kwh Generator 1</td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_kwh_generator1_nilai" id="total_kwh_generator1_nilai" class="form-control total_kwh_generator1_nilai dtopen_blok" style="text-align: center;" value="<?= $total_kwh_generator1_nilai; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-success align-middle text-right" rowspan="1" colspan="13">Kwh Generator 2</td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_kwh_generator2_nilai" id="total_kwh_generator2_nilai" class="form-control total_kwh_generator2_nilai dtopen_blok" style="text-align: center;" value="<?= $total_kwh_generator2_nilai; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-success align-middle text-right" rowspan="1" colspan="13">Star Genset</td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_star_genset" id="total_star_genset" class="form-control total_star_genset dtopen_blok" style="text-align: center;" value="<?= $total_star_genset; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-success align-middle text-right" rowspan="1" colspan="13">Total</td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_generator" id="total_generator" class="form-control total_generator dtopen_blok" style="text-align: center;" value="<?= $total_generator; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-success align-middle text-right" rowspan="1" colspan="13">Total Loss Merupakan Selisih dari output Generator 1 + Generator 2 + Star genset dikurang total pakai kwh real hari ini</td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_kwh_loss_nilai" id="total_kwh_loss_nilai" class="form-control total_kwh_loss_nilai dtopen_blok" style="text-align: center;" value="<?= $total_kwh_loss_nilai; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button class="btn bg-gradient-danger" id="btn_refresh" class="btn_refresh" type='button' onclick="return confirm('Refresh Data ?')"><i class="feather icon-refresh-cw"></i> REFRESH DATA</button>
                                        </br></br>
                                        <strong>E. Panel Per Departemen</strong>
                                        <div class="table-responsive table-hover" style="max-height: 800px;">
                                            <table class="table table-striped table-bordered">
                                                <thead style="position:sticky;top: 0; z-index: 1;">
                                                    <tr>
                                                        <th class="table-success align-middle text-center" rowspan="2" colspan="1">No.</th>
                                                        <th class="table-success align-middle text-center" rowspan="2" colspan="1">Departemen</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="3">Pemakaian<br>KWH</th>
                                                        <th class="table-success align-middle text-center" rowspan="2" colspan="1">%</th>
                                                        <th class="table-success align-middle text-center" rowspan="2" colspan="1">Akumulatif<br>KWH</th>
                                                        <th class="table-success align-middle text-center" rowspan="2" colspan="1">%</th>
                                                        <th class="table-success align-middle text-center" rowspan="2" colspan="1">Pemakaian<br>Bahan Bakar</th>
                                                        <th class="table-success align-middle text-center" rowspan="2" colspan="1">Akumulatif<br>Bahan Bakar</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">KWH REAL HARI</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">LOSS KWH HARI INI</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">TOTAL KWH HARI INI</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_d">
                                                    <?php
                                                    if (isset($dtdetail_d)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_d as $dtdetail_d_row) {
                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_d_detail_id[]" id="dtl_d_detail_id" class="dtl_d_detail_id form-control w-auto" style="text-align: center;" value="<?= $dtdetail_d_row->detail_id; ?>">
                                                                <input type="hidden" name="dtl_d_id_pemakai_panel[]" id="dtl_d_id_pemakai_panel" class="dtl_d_id_pemakai_panel form-control w-auto" style="text-align: center;" value="<?= $dtdetail_d_row->id_pemakai_panel; ?>">
                                                                <input type="hidden" name="dtl_d_pemakai_panel[]" id="dtl_d_pemakai_panel" class="dtl_d_pemakai_panel form-control w-auto" style="text-align: center;" value="<?= $dtdetail_d_row->pemakai_panel; ?>">
                                                                <td align="center"><?= $no++; ?></td>
                                                                <td align="center"><?= $dtdetail_d_row->pemakai_panel; ?></td>
                                                                <td align="center"><input type="text" name="dtl_d_pemakai_kwh[]" id="dtl_d_pemakai_kwh" class="dtl_d_pemakai_kwh_<?= $dtdetail_d_row->id_pemakai_panel; ?> angkadantitik form-control w-auto total_kwh" style="text-align: center;" value="<?= $dtdetail_d_row->pemakai_kwh; ?>" readonly></td>
                                                                <td align="center"><input type="text" name="dtl_d_pemakai_kwh_loss[]" id="dtl_d_pemakai_kwh_loss" class="dtl_d_pemakai_kwh_loss_<?= $dtdetail_d_row->id_pemakai_panel; ?> angkadantitik form-control w-auto total_loss_kwh" style="text-align: center;" value="<?= $dtdetail_d_row->pemakai_kwh_loss; ?>" readonly></td>
                                                                <td align="center"><input type="text" name="dtl_d_pemakai_kwh_total[]" id="dtl_d_pemakai_kwh_total" class="dtl_d_pemakai_kwh_total_<?= $dtdetail_d_row->id_pemakai_panel; ?> angkadantitik form-control w-auto total_total" style="text-align: center;" value="<?= $dtdetail_d_row->pemakai_kwh_total; ?>" readonly></td>
                                                                <td align="center"><input type="text" name="dtl_d_pemakai_persen[]" id="dtl_d_pemakai_persen" class="dtl_d_pemakai_persen_<?= $dtdetail_d_row->id_pemakai_panel; ?> angkadantitik form-control w-auto total_persen_kwh" style="text-align: center;" value="<?= $dtdetail_d_row->pemakai_persen; ?>" readonly></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_d_pemakai_akumulatif[]" id="dtl_d_pemakai_akumulatif" class="dtl_d_pemakai_akumulatif_<?= $dtdetail_d_row->id_pemakai_panel; ?>  angkadantitik form-control w-auto total_akm_kwh" style="text-align: center;" value="<?= $dtdetail_d_row->pemakai_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_d_pakai_akumulatif_sementara[]" id="dtl_d_pakai_akumulatif_sementara" class="dtl_d_pakai_akumulatif_sementara_<?= $dtdetail_d_row->id_pemakai_panel; ?>  angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_d_row->dtl_d_pakai_akumulatif_sementara; ?>" readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_d_bahan_bakar_persen[]" id="dtl_d_bahan_bakar_persen" class="dtl_d_bahan_bakar_persen_<?= $dtdetail_d_row->id_pemakai_panel; ?>  angkadantitik form-control w-auto total_prsn_kwh" style="text-align: center;" value="<?= $dtdetail_d_row->bahan_bakar_persen; ?>" readonly></td>
                                                                <td align="center"><input type="text" name="dtl_d_bahan_bakar_kwh[]" id="dtl_d_bahan_bakar_kwh" class="dtl_d_bahan_bakar_kwh_<?= $dtdetail_d_row->id_pemakai_panel; ?>  angkadantitik form-control w-auto total_bb" style="text-align: center;" value="<?= $dtdetail_d_row->bahan_bakar_kwh; ?>" readonly></td>
                                                                <td align="center">
                                                                    <input type="text" name="dtl_d_bahan_bakar_akumulatif[]" id="dtl_d_bahan_bakar_akumulatif" class="dtl_d_bahan_bakar_akumulatif_<?= $dtdetail_d_row->id_pemakai_panel; ?>  angkadantitik form-control w-auto total_akm_bb" style="text-align: center;" value="<?= $dtdetail_d_row->bahan_bakar_akumulatif; ?>" readonly>
                                                                    <input type="hidden" name="dtl_d_bahan_bakar_akumulatif_sementara[]" id="dtl_d_bahan_bakar_akumulatif_sementara" class="dtl_d_bahan_bakar_akumulatif_sementara_<?= $dtdetail_d_row->id_pemakai_panel; ?>  angkadantitik form-control w-auto" style="text-align: center;" value="<?= $dtdetail_d_row->dtl_d_bahan_bakar_akumulatif_sementara; ?>" readonly>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="2">Total</td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_d_pemakai_kwh" id="total_dtl_d_pemakai_kwh" class="form-control total_dtl_d_pemakai_kwh dtopen_blok" style="text-align: center;" value="<?= $total_dtl_d_pemakai_kwh; ?>" readonly>
                                                        </td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_d_pemakai_kwh_loss" id="total_dtl_d_pemakai_kwh_loss" class="form-control total_dtl_d_pemakai_kwh_loss dtopen_blok" style="text-align: center;" value="<?= $total_dtl_d_pemakai_kwh_loss; ?>" readonly>
                                                        </td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_d_pemakai_kwh_total" id="total_dtl_d_pemakai_kwh_total" class="form-control total_dtl_d_pemakai_kwh_total dtopen_blok" style="text-align: center;" value="<?= $total_dtl_d_pemakai_kwh_total; ?>" readonly>
                                                        </td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_d_pemakai_persen" id="total_dtl_d_pemakai_persen" class="form-control total_dtl_d_pemakai_persen dtopen_blok" style="text-align: center;" value="<?= $total_dtl_d_pemakai_persen; ?>" readonly>
                                                        </td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_d_pemakai_akumulatif" id="total_dtl_d_pemakai_akumulatif" class="form-control total_dtl_d_pemakai_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_d_pemakai_akumulatif; ?>" readonly>
                                                        </td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_d_bahan_bakar_persen" id="total_dtl_d_bahan_bakar_persen" class="form-control total_dtl_d_bahan_bakar_persen dtopen_blok" style="text-align: center;" value="<?= $total_dtl_d_bahan_bakar_persen; ?>" readonly>
                                                        </td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_d_bahan_bakar_kwh" id="total_dtl_d_bahan_bakar_kwh" class="form-control total_dtl_d_bahan_bakar_kwh dtopen_blok" style="text-align: center;" value="<?= $total_dtl_d_bahan_bakar_kwh; ?>" readonly>
                                                        </td>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="1">
                                                            <input type="text" name="total_dtl_d_bahan_bakar_akumulatif" id="total_dtl_d_bahan_bakar_akumulatif" class="form-control total_dtl_d_bahan_bakar_akumulatif dtopen_blok" style="text-align: center;" value="<?= $total_dtl_d_bahan_bakar_akumulatif; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-borderless table-warning">
                                                <tr>
                                                    <td colspan="3">
                                                        <strong>
                                                            <h2>EFISIENSI BAHAN BAKAR STEAM</h2>
                                                        </strong>
                                                    </td colspan="3">
                                                </tr>
                                                <tr>
                                                    <td>* 1 Ton Steam</td>
                                                    <td><input type="text" name="ef_ton_steam" id="ef_ton_steam" class="form-control ef_ton_steam dtopen_blok" style="text-align: center;" value="<?= $ef_ton_steam; ?>" size="3"></td>
                                                    <td>KG BB</td>
                                                </tr>
                                                <tr>
                                                    <td>* 1 KG BB</td>
                                                    <td><input type="text" name="ef_kg_bb" id="ef_kg_bb" class="form-control ef_kg_bb dtopen_blok" style="text-align: center;" value="<?= $ef_kg_bb; ?>" size="3"></td>
                                                    <td>KG Steam</td>
                                                <tr>
                                                <tr>
                                                </tr>
                                                <td>
                                                    <strong>
                                                        <h2>Stock Batubara</h2>
                                                    </strong>
                                                </td>
                                                <td><input type="text" name="stock_batubara" id="stock_batubara" class="form-control stock_batubara dtopen_blok" style="text-align: center;" value="<?= $stock_batubara; ?>" size="3"></td>
                                                <td>Ton</td>
                                                <tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-borderless table-warning">
                                                <tr>
                                                    <td colspan="3">
                                                        <strong>
                                                            <h2>EFISIENSI BAHAN BAKAR KWH</h2>
                                                        </strong>
                                                    </td colspan="3">
                                                </tr>
                                                <tr>
                                                    <td>* 1 KWH</td>
                                                    <td><input type="text" name="ef_kwh" id="ef_kwh" class="form-control ef_kwh dtopen_blok" style="text-align: center;" value="<?= $ef_kwh; ?>" size="3"></td>
                                                    <td>KG BB</td>
                                                </tr>
                                                <tr>
                                                    <td>* 1 KG BB</td>
                                                    <td><input type="text" name="ef_bb" id="ef_bb" class="form-control ef_bb dtopen_blok" style="text-align: center;" value="<?= $ef_bb; ?>" size="3"></td>
                                                    <td>KWH</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <strong>
                                                            <h2>EFISIENSI BAHAN BAKAR KWH</h2>
                                                        </strong>
                                                    </td colspan="3">
                                                </tr>
                                                <tr>
                                                    <td>* 1 KWH</td>
                                                    <td><input type="text" name="ef_kwh2" id="ef_kwh2" class="form-control ef_kwh2 dtopen_blok" style="text-align: center;" value="<?= $ef_kwh2; ?>" size="3"></td>
                                                    <td>KG BB</td>
                                                </tr>
                                                <tr>
                                                    <td>* 1 KG BB</td>
                                                    <td><input type="text" name="ef_bb2" id="ef_bb2" class="form-control ef_bb2 dtopen_blok" style="text-align: center;" value="<?= $ef_bb2; ?>" size="3"></td>
                                                    <td>KWH</td>
                                                <tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php $this->load->view('laporan/V_laporan_definisi'); ?>

                            <div class="row mt-1">
                                <div class="col-12">
                                    <?php if (!isset($dtheader)) {
                                        if ($akses_create == '1') { ?>
                                            <button type="submit" class="btn bg-gradient-primary" id="btnsimpan">
                                                <i class="feather icon-save"></i> Simpan</button>

                                            <button type="reset" class="btn bg-gradient-light">
                                                <i class="feather icon-refresh-ccw"></i> Batal</button>
                                        <?php } else {/*No Acess Create*/
                                        }
                                    } else {
                                        // tombol sesuaikan dengan halaman shift
                                        if ($akses_update == '1') { ?>
                                            <button type="submit" class="btn bg-gradient-primary" name="btnproses" value="btnupdate" onclick="return confirm('Simpan Data ?')">
                                                <i class="feather icon-save"></i> Simpan
                                            </button>
                                            <button type="submit" class="btn bg-gradient-info" name="btnproses" value="btncomplete" onclick="return confirm('Komplit Data ?')">
                                                <i class="feather icon-check-square"></i> Komplit
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
                                    <span class="pull-left">Mulai Berlaku: <?= $frmefec; ?></span>
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
            placeholder: "0"
        });

        $(document).on('keyup', '.angkadantitik', function() {
            this.value = this.value.replace(/[^\d.]/g, '');
        });

        if (typeof($('#headerid').val()) != "undefined") {
            $('.dtopen_blok').prop('readonly', true);
            $('.dtopen_blok2 > option').each(function() {
                if (!this.selected) {
                    $(this).attr('disabled', true);
                }
            });
        }

        get_docno();
        getkwh_real_perdept();
    });

    $('.create_date').change(function() {

        // let create_date = $(this).val();
        // let curr_date = create_date;

        // console.log(curr_date);
        get_docno();
        // getDaysinMointh();

        // get_all_dates(curr_date.getFullYear(), curr_date.getMonth());
    });

    function get_all_dates(year, month) {

        let date = new Date(year, month, 1);
        let dates = [];
        let i = 0;

        while (date.getMonth() === month) {
            dates.push(new Date(date));
            date.setDate(date.getDate() + 1);
            console.log(dates[i]);
            i++;
        }
    }
    // let curr_date = $('.create_date').val();
    let curr_date = new Date();
    // console.log(curr_date)
    console.log("For this month:");
    console.log("\n");
    get_all_dates(curr_date.getFullYear(), curr_date.getMonth());

    function get_docno() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn009_02/get_docno/inttbn009/02",
                data: {
                    create_date
                },
                async: false,
                success: function(data) {
                    $('.docno').val(JSON.parse(data)['data']);
                    get_forminput();
                }
            });
        }
    }

    function getkwh_real_perdept() {
        var total_kwh_perdept = 0;
        $('.dtl_c_kwh_nilai').each(function(key, row) {

            var dept_user_before = typeof($('.dtl_c_dept_user')[key - 1]) != "undefined" ? $('.dtl_c_dept_user')[key - 1].value : "";
            var id_dept_user = $(this).closest('tr').find('.dtl_c_dept_user').val();
            var status_beban = $(this).closest('tr').find('.dtl_c_status_beban').val();

            if (row.value != '' && status_beban == 'YA') {
                if ($(this) == 0) {
                    total_kwh_perdept = (parseFloat(row.value));
                } else {
                    if (id_dept_user == dept_user_before) {
                        total_kwh_perdept += (parseFloat(row.value));
                    } else {
                        total_kwh_perdept = (parseFloat(row.value));
                    }
                }
                $('.dtl_d_pemakai_kwh_' + id_dept_user).val(total_kwh_perdept);
            }
        });

        // $('.dtl_d_id_pemakai_panel').each(function() {
        //     var id_val = $(this).val();
        //     var dt_kwh = $(this).closest('tr').find('.dtl_d_pemakai_kwh_' + id_val).val();
        //     var dt_total_all_kwh = $('.total_dtl_d_pemakai_kwh').text();
        //     var dt_total_kwh_loss_nilai = $('.total_kwh_loss_nilai').text();

        //     if (dt_total_all_kwh > 0 && dt_total_kwh_loss_nilai > 0) {
        //         var val_kwh_loss = $(this).closest('tr').find('.dtl_d_pemakai_kwh_loss_' + id_val).val(((dt_kwh / dt_total_all_kwh) * dt_total_kwh_loss_nilai));

        //         if (dt_kwh != '' && val_kwh_loss.val() != '') {
        //             $(this).closest('tr').find('.dtl_d_pemakai_kwh_total_' + id_val).val((parseFloat(dt_kwh) + parseFloat(val_kwh_loss.val())));
        //         } else {
        //             $(this).closest('tr').find('.dtl_d_pemakai_kwh_total_' + id_val).val(0);
        //         }

        //     }
        // });
        // $('.total_dtl_d_pemakai_kwh').empty().append(total_kwh_alldept)
    }

    function get_forminput() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();

        if (create_date != '' && input_headerid == undefined) {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn009_02/get_forminput/inttbn009/02",
                data: {
                    create_date
                },
                dataType: "json",
                async: false,
                success: function(result) {
                    if (result.status == 0) {
                        // dtl a
                        let list_dtl_a = `<tr>
                                            <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                        </tr>`;

                        if (result.data.result_master_steam.length) {
                            list_dtl_a = '';
                            $.each(result.data.result_master_steam, function(dtl_a_key, dtl_a_row) {
                                if (dtl_a_row.children) {
                                    $.each(dtl_a_row.children, function(dtl_a_key2, dtl_a_row2) {

                                        let steam_akm = (`${dtl_a_row2.steam_akm}`) == 'null' ? 0 : (`${dtl_a_row2.steam_akm}`);
                                        let press_akm = (`${dtl_a_row2.press_akm}`) == 'null' ? 0 : (`${dtl_a_row2.press_akm}`);
                                        let batubara_akm = (`${dtl_a_row2.batubara_akm}`) == 'null' ? 0 : (`${dtl_a_row2.batubara_akm}`);
                                        let cocopit_akm = (`${dtl_a_row2.cocopit_akm}`) == 'null' ? 0 : (`${dtl_a_row2.cocopit_akm}`);
                                        let tempurung_akm = (`${dtl_a_row2.tempurung_akm}`) == 'null' ? 0 : (`${dtl_a_row2.tempurung_akm}`);
                                        let bb_akm = (`${dtl_a_row2.bb_akm}`) == 'null' ? 0 : (`${dtl_a_row2.bb_akm}`);
                                        let sabut_akm = (`${dtl_a_row2.sabut_akm}`) == 'null' ? 0 : (`${dtl_a_row2.sabut_akm}`);
                                        let steam_batubara_akm = (`${dtl_a_row2.steam_batubara_akm}`) == 'null' ? 0 : (`${dtl_a_row2.steam_batubara_akm}`);
                                        let steam_bahanbakar_akm = (`${dtl_a_row2.steam_bahanbakar_akm}`) == 'null' ? 0 : (`${dtl_a_row2.steam_bahanbakar_akm}`);
                                        let operasi_akm = (`${dtl_a_row2.operasi_akm}`) == 'null' ? 0 : (`${dtl_a_row2.operasi_akm}`);
                                        let dearator_akm = (`${dtl_a_row2.dearator_akm}`) == 'null' ? 0 : (`${dtl_a_row2.dearator_akm}`);
                                        let demian_akm = (`${dtl_a_row2.demian_akm}`) == 'null' ? 0 : (`${dtl_a_row2.demian_akm}`);
                                        let dabu_akm = (`${dtl_a_row2.dabu_akm}`) == 'null' ? 0 : (`${dtl_a_row2.dabu_akm}`);
                                        let ct_akm = (`${dtl_a_row2.ct_akm}`) == 'null' ? 0 : (`${dtl_a_row2.ct_akm}`);

                                        list_dtl_a += `<tr>
                                                            <input type="hidden" name="dtl_a_dept_steam[]" id="dtl_a_dept_steam" class="dtl_a_dept_steam form-control w-auto" style="text-align: center;" value="${dtl_a_row.dept_steam}">
                                                            <td align="center" style="background-color: #ffffff !important;" class="fixed freeze_horizontal scrolling_table_2">${(dtl_a_key + 1) }</td>
                                                            <td align="center" style="background-color: #ffffff !important;" class="fixed freeze_horizontal scrolling_table_2">${dtl_a_row.dept_steam}</td>
                                                            <td align="center"><input type="text" name="dtl_a_steam_nilai[]" id="dtl_a_steam_nilai" class="dtl_a_steam_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_steam_akumulatif[]" id="dtl_a_steam_akumulatif" class="dtl_a_steam_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${steam_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_steam_akumulatif_awal[]" id="dtl_a_steam_akumulatif_awal" class="dtl_a_steam_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${steam_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_press_nilai[]" id="dtl_a_press_nilai" class="dtl_a_press_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_press_akumulatif[]" id="dtl_a_press_akumulatif" class="dtl_a_press_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${press_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_press_akumulatif_awal[]" id="dtl_a_press_akumulatif_awal" class="dtl_a_press_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${press_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_batubara_nilai[]" id="dtl_a_batubara_nilai" class="dtl_a_batubara_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_batubara_akumulatif[]" id="dtl_a_batubara_akumulatif" class="dtl_a_batubara_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${batubara_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_batubara_akumulatif_awal[]" id="dtl_a_batubara_akumulatif_awal" class="dtl_a_batubara_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${batubara_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_debu_nilai[]" id="dtl_a_debu_nilai" class="dtl_a_debu_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_debu_akumulatif[]" id="dtl_a_debu_akumulatif" class="dtl_a_debu_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${dabu_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_debu_akumulatif_awal[]" id="dtl_a_debu_akumulatif_awal" class="dtl_a_debu_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${dabu_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_cocopit_nilai[]" id="dtl_a_cocopit_nilai" class="dtl_a_cocopit_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_cocopit_akumulatif[]" id="dtl_a_cocopit_akumulatif" class="dtl_a_cocopit_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${cocopit_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_cocopit_akumulatif_awal[]" id="dtl_a_cocopit_akumulatif_awal" class="dtl_a_cocopit_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${cocopit_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_tempurung_nilai[]" id="dtl_a_tempurung_nilai" class="dtl_a_tempurung_nilai hitung_total hitung_akm angkadantitik form-control w-auto hitung_2generator" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_tempurung_akumulatif[]" id="dtl_a_tempurung_akumulatif" class="dtl_a_tempurung_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${tempurung_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_tempurung_akumulatif_awal[]" id="dtl_a_tempurung_akumulatif_awal" class="dtl_a_tempurung_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${tempurung_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_bb_nilai[]" id="dtl_a_bb_nilai" class="dtl_a_bb_nilai hitung_total hitung_akm angkadantitik form-control w-auto tes_hsl" style="text-align: center;" value="" readonly></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_bb_akumulatif[]" id="dtl_a_bb_akumulatif" class="dtl_a_bb_akumulatif hitung_total angkadantitik form-control w-auto tes_akm" style="text-align: center;" value="${bb_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_bb_akumulatif_awal[]" id="dtl_a_bb_akumulatif_awal" class="dtl_a_bb_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${bb_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_sabut_nilai[]" id="dtl_a_sabut_nilai" class="dtl_a_sabut_nilai hitung_total hitung_akm angkadantitik form-control w-auto hitung_2generator" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_sabut_akumulatif[]" id="dtl_a_sabut_akumulatif" class="dtl_a_sabut_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${sabut_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_sabut_akumulatif_awal[]" id="dtl_a_sabut_akumulatif_awal" class="dtl_a_sabut_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${sabut_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_steam_batubara_nilai[]" id="dtl_a_steam_batubara_nilai" class="dtl_a_steam_batubara_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="" readonly></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_steam_batubara_akumulatif[]" id="dtl_a_steam_batubara_akumulatif" class="dtl_a_steam_batubara_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${steam_batubara_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_steam_batubara_akumulatif_awal[]" id="dtl_a_steam_batubara_akumulatif_awal" class="dtl_a_steam_batubara_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${steam_batubara_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_steam_bahanbakar_nilai[]" id="dtl_a_steam_bahanbakar_nilai" class="dtl_a_steam_bahanbakar_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value="" readonly></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_steam_bahanbakar_akumulatif[]" id="dtl_a_steam_bahanbakar_akumulatif" class="dtl_a_steam_bahanbakar_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${steam_bahanbakar_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_steam_bahanbakar_akumulatif_awal[]" id="dtl_a_steam_bahanbakar_akumulatif_awal" class="dtl_a_steam_bahanbakar_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${steam_bahanbakar_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_operasi_nilai[]" id="dtl_a_operasi_nilai" class="dtl_a_operasi_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_operasi_akumulatif[]" id="dtl_a_operasi_akumulatif" class="dtl_a_operasi_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${operasi_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_operasi_akumulatif_awal[]" id="dtl_a_operasi_akumulatif_awal" class="dtl_a_operasi_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${operasi_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_dearator_nilai[]" id="dtl_a_dearator_nilai" class="dtl_a_dearator_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_dearator_akumulatif[]" id="dtl_a_dearator_akumulatif" class="dtl_a_dearator_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${dearator_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_dearator_akumulatif_awal[]" id="dtl_a_dearator_akumulatif_awal" class="dtl_a_dearator_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${dearator_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_demian_nilai[]" id="dtl_a_demian_nilai" class="dtl_a_demian_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_demian_akumulatif[]" id="dtl_a_demian_akumulatif" class="dtl_a_demian_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${demian_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_demian_akumulatif_awal[]" id="dtl_a_demian_akumulatif_awal" class="dtl_a_demian_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${demian_akm}">
                                                            </td>
                                                            <td align="center"><input type="text" name="dtl_a_ct_nilai[]" id="dtl_a_ct_nilai" class="dtl_a_ct_nilai hitung_total hitung_akm angkadantitik form-control w-auto" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_a_ct_akumulatif[]" id="dtl_a_ct_akumulatif" class="dtl_a_ct_akumulatif hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${ct_akm}" readonly>
                                                                <input type="hidden" name="dtl_a_ct_akumulatif_awal[]" id="dtl_a_ct_akumulatif_awal" class="dtl_a_ct_akumulatif_awal hitung_total angkadantitik form-control w-auto" style="text-align: center;" value="${ct_akm}">
                                                            </td>
                                                        </tr>`;
                                    });
                                }
                            });
                        }

                        $('#tbody_dtl_a').empty().append(list_dtl_a);
                        // dtl a end
                        // dtl b
                        let list_dtl_b = `<tr>
                                            <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                        </tr>`;

                        let dtl_b_grand_total_pemakaian = 0;
                        let dtl_b_grand_total_akumulatif = 0;

                        let create_date = $('.create_date').val();
                        let stock_akhir = $('.dtl_b_trafo_akhir').val();

                        let tanggal_split = create_date.split('-');
                        let arr_tanggal = (tanggal_split[0]);

                        if (result.data.result_master_trafo.length) {
                            list_dtl_b = '';
                            $.each(result.data.result_master_trafo, function(dtl_b_key, dtl_b_row) {
                                if (dtl_b_row.children) {
                                    $.each(dtl_b_row.children, function(dtl_b_key2, dtl_b_row2) {
                                        let kwh_akm = (`${dtl_b_row2.kwh_akm}`) == 'null' || (`${dtl_b_row2.kwh_akm}`) == '' ? 0 : (`${dtl_b_row2.kwh_akm}`);
                                        let bahanbakar_akm = (`${dtl_b_row2.bahanbakar_akm}`) == 'null' ? 0 : (`${dtl_b_row2.bahanbakar_akm}`);
                                        let kwh_efisien_akm = (`${dtl_b_row2.kwh_efisien_akm}`) == 'null' ? 0 : (`${dtl_b_row2.kwh_efisien_akm}`);
                                        let operasi_akm = (`${dtl_b_row2.operasi_akm}`) == 'null' ? 0 : (`${dtl_b_row2.operasi_akm}`);
                                        let solar_akm = (`${dtl_b_row2.solar_akm}`) == 'null' ? 0 : (`${dtl_b_row2.solar_akm}`);
                                        if (dtl_b_row2.children2 != '') {
                                            $.each(dtl_b_row2.children2, function(dtl_b_key3, dtl_b_row_3) {
                                                let trafo_akhir = (`${dtl_b_row_3.trafo_akhir}`) == 'null' ? 0 : (`${dtl_b_row_3.trafo_akhir}`);

                                                if ((dtl_b_row.read_ct_trafo != '') && (dtl_b_row.trafo != 'LOSS')) {
                                                    list_dtl_b += `<tr>
                                                                    <input type="hidden" name="dtl_b_trafo[]" id="dtl_b_trafo" class="dtl_b_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.trafo}">
                                                                    <input type="hidden" name="dtl_b_nama_trafo[]" id="dtl_b_nama_trafo" class="dtl_b_nama_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.nama_trafo}">
                                                                    <input type="hidden" name="dtl_b_read_ct_trafo[]" id="dtl_b_read_ct_trafo" class="dtl_b_read_ct_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.read_ct_trafo}">
                                                                    <td align="center" style="background-color: #ffffff !important;">${dtl_b_key + 1}</td>
                                                                    <td align="center" style="background-color: #ffffff !important;">${dtl_b_row.trafo}</td>
                                                                    <td align="left" style="background-color: #ffffff !important;">${dtl_b_row.nama_trafo}</td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_rata_hari[]" id="dtl_b_rata_hari" class="dtl_b_rata_hari form-control hitung_akm w-auto angkadantitik fixed freeze_horizontal" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_jam[]" id="dtl_b_jam" class="dtl_b_jam form-control w-auto hitung_akm angkadantitik hitung_selisih" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_kwh_6k5_nilai[]" id="dtl_b_kwh_6k5_nilai" class="dtl_b_kwh_6k5_nilai hitung_selisih form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center">${dtl_b_row.read_ct_trafo}</td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_awal[]" id="dtl_b_trafo_awal" class="dtl_b_trafo_awal hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="${trafo_akhir}"></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_akhir[]" id="dtl_b_trafo_akhir" class="dtl_b_trafo_akhir hitung_total hitung_selisih hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_putaran[]" id="dtl_b_trafo_putaran" class="dtl_b_trafo_putaran hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_nilai[]" id="dtl_b_kwh_nilai" class="dtl_b_kwh_nilai hitung_selisih hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_akumulatif[]" id="dtl_b_kwh_akumulatif" class="dtl_b_kwh_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_akumulatif_awal[]" id="dtl_b_kwh_akumulatif_awal" class="dtl_b_kwh_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_bahanbakar_nilai[]" id="dtl_b_bahanbakar_nilai" class="dtl_b_bahanbakar_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_bahanbakar_akumulatif[]" id="dtl_b_bahanbakar_akumulatif" class="dtl_b_bahanbakar_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${bahanbakar_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_bahanbakar_akumulatif_awal[]" id="dtl_b_bahanbakar_akumulatif_awal" class="dtl_b_bahanbakar_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${bahanbakar_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_efisiensi_nilai[]" id="dtl_b_kwh_efisiensi_nilai" class="dtl_b_kwh_efisiensi_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_efisiensi_akumulatif[]" id="dtl_b_kwh_efisiensi_akumulatif" class="dtl_b_kwh_efisiensi_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_efisien_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_efisiensi_akumulatif_awal[]" id="dtl_b_kwh_efisiensi_akumulatif_awal" class="dtl_b_kwh_efisiensi_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_efisien_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${operasi_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_operasi_akumulatif_awal[]" id="dtl_b_operasi_akumulatif_awal" class="dtl_b_operasi_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${operasi_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_solar_nilai[]" id="dtl_b_solar_nilai" class="dtl_b_solar_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_solar_akumulatif[]" id="dtl_b_solar_akumulatif" class="dtl_b_solar_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${solar_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_solar_akumulatif_awal[]" id="dtl_b_solar_akumulatif_awal" class="dtl_b_solar_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${solar_akm}">
                                                                    </td>
                                                                </tr>`;
                                                } else if ((dtl_b_row.read_ct_trafo == '') && (dtl_b_row.trafo == 'LOSS')) {
                                                    list_dtl_b += `<tr>
                                                                    <input type="hidden" name="dtl_b_trafo[]" id="dtl_b_trafo" class="dtl_b_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.trafo}">
                                                                    <input type="hidden" name="dtl_b_nama_trafo[]" id="dtl_b_nama_trafo" class="dtl_b_nama_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.nama_trafo}">
                                                                    <input type="hidden" name="dtl_b_read_ct_trafo[]" id="dtl_b_read_ct_trafo" class="dtl_b_read_ct_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.read_ct_trafo}">
                                                                    <td align="center" style="background-color: #ffffff !important;">${dtl_b_key + 1}</td>
                                                                    <td align="center" style="background-color: #ffffff !important;">${dtl_b_row.trafo}</td>
                                                                    <td align="left" style="background-color: #ffffff !important;">${dtl_b_row.nama_trafo}</td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_rata_hari[]" id="dtl_b_rata_hari" class="dtl_b_rata_hari form-control hitung_akm w-auto angkadantitik fixed freeze_horizontal" style="text-align: center;" value=""></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_jam[]" id="dtl_b_jam" class="dtl_b_jam form-control w-auto hitung_akm angkadantitik hitung_selisih" style="text-align: center;" value=""></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_kwh_6k5_nilai[]" id="dtl_b_kwh_6k5_nilai" class="dtl_b_kwh_6k5_nilai hitung_selisih form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center">${dtl_b_row.read_ct_trafo}</td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_trafo_awal[]" id="dtl_b_trafo_awal" class="dtl_b_trafo_awal hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_trafo_akhir[]" id="dtl_b_trafo_akhir" class="dtl_b_trafo_akhir hitung_total hitung_selisih hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_trafo_putaran[]" id="dtl_b_trafo_putaran" class="dtl_b_trafo_putaran hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_nilai[]" id="dtl_b_kwh_nilai" class="dtl_b_kwh_nilai hitung_selisih hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_akumulatif[]" id="dtl_b_kwh_akumulatif" class="dtl_b_kwh_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_akumulatif_awal[]" id="dtl_b_kwh_akumulatif_awal" class="dtl_b_kwh_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_bahanbakar_nilai[]" id="dtl_b_bahanbakar_nilai" class="dtl_b_bahanbakar_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_bahanbakar_akumulatif[]" id="dtl_b_bahanbakar_akumulatif" class="dtl_b_bahanbakar_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${bahanbakar_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_bahanbakar_akumulatif_awal[]" id="dtl_b_bahanbakar_akumulatif_awal" class="dtl_b_bahanbakar_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${bahanbakar_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_efisiensi_nilai[]" id="dtl_b_kwh_efisiensi_nilai" class="dtl_b_kwh_efisiensi_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_efisiensi_akumulatif[]" id="dtl_b_kwh_efisiensi_akumulatif" class="dtl_b_kwh_efisiensi_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_efisien_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_efisiensi_akumulatif_awal[]" id="dtl_b_kwh_efisiensi_akumulatif_awal" class="dtl_b_kwh_efisiensi_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_efisien_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${operasi_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_operasi_akumulatif_awal[]" id="dtl_b_operasi_akumulatif_awal" class="dtl_b_operasi_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${operasi_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_solar_nilai[]" id="dtl_b_solar_nilai" class="dtl_b_solar_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_solar_akumulatif[]" id="dtl_b_solar_akumulatif" class="dtl_b_solar_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${solar_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_solar_akumulatif_awal[]" id="dtl_b_solar_akumulatif_awal" class="dtl_b_solar_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${solar_akm}">
                                                                    </td>
                                                                </tr>`;
                                                } else {
                                                    list_dtl_b += `<tr>
                                                                    <input type="hidden" name="dtl_b_trafo[]" id="dtl_b_trafo" class="dtl_b_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.trafo}">
                                                                    <input type="hidden" name="dtl_b_nama_trafo[]" id="dtl_b_nama_trafo" class="dtl_b_nama_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.nama_trafo}">
                                                                    <input type="hidden" name="dtl_b_read_ct_trafo[]" id="dtl_b_read_ct_trafo" class="dtl_b_read_ct_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.read_ct_trafo}">
                                                                    <td align="center" style="background-color: #ffffff !important;">${dtl_b_key + 1}</td>
                                                                    <td align="center" style="background-color: #ffffff !important;">${dtl_b_row.trafo}</td>
                                                                    <td align="left" style="background-color: #ffffff !important;">${dtl_b_row.nama_trafo}</td>
                                                                    <td align="center"><input type="text" name="dtl_b_rata_hari[]" id="dtl_b_rata_hari" class="dtl_b_rata_hari form-control hitung_akm w-auto angkadantitik fixed freeze_horizontal" style="text-align: center;" value=""></td>
                                                                    <td align="center"><input type="text" name="dtl_b_jam[]" id="dtl_b_jam" class="dtl_b_jam form-control w-auto hitung_akm angkadantitik hitung_selisih" style="text-align: center;" value=""></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_kwh_6k5_nilai[]" id="dtl_b_kwh_6k5_nilai" class="dtl_b_kwh_6k5_nilai hitung_selisih form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center">${dtl_b_row.read_ct_trafo}</td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_awal[]" id="dtl_b_trafo_awal" class="dtl_b_trafo_awal hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_akhir[]" id="dtl_b_trafo_akhir" class="dtl_b_trafo_akhir hitung_total hitung_selisih hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_putaran[]" id="dtl_b_trafo_putaran" class="dtl_b_trafo_putaran hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_nilai[]" id="dtl_b_kwh_nilai" class="dtl_b_kwh_nilai hitung_selisih hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_akumulatif[]" id="dtl_b_kwh_akumulatif" class="dtl_b_kwh_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_akumulatif_awal[]" id="dtl_b_kwh_akumulatif_awal" class="dtl_b_kwh_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_bahanbakar_nilai[]" id="dtl_b_bahanbakar_nilai" class="dtl_b_bahanbakar_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_bahanbakar_akumulatif[]" id="dtl_b_bahanbakar_akumulatif" class="dtl_b_bahanbakar_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${bahanbakar_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_bahanbakar_akumulatif_awal[]" id="dtl_b_bahanbakar_akumulatif_awal" class="dtl_b_bahanbakar_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${bahanbakar_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_efisiensi_nilai[]" id="dtl_b_kwh_efisiensi_nilai" class="dtl_b_kwh_efisiensi_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_efisiensi_akumulatif[]" id="dtl_b_kwh_efisiensi_akumulatif" class="dtl_b_kwh_efisiensi_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_efisien_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_efisiensi_akumulatif_awal[]" id="dtl_b_kwh_efisiensi_akumulatif_awal" class="dtl_b_kwh_efisiensi_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_efisien_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${operasi_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_operasi_akumulatif_awal[]" id="dtl_b_operasi_akumulatif_awal" class="dtl_b_operasi_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${operasi_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_solar_nilai[]" id="dtl_b_solar_nilai" class="dtl_b_solar_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_solar_akumulatif[]" id="dtl_b_solar_akumulatif" class="dtl_b_solar_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${solar_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_solar_akumulatif_awal[]" id="dtl_b_solar_akumulatif_awal" class="dtl_b_solar_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${solar_akm}">
                                                                    </td>
                                                                </tr>`;
                                                }
                                            });
                                        } else {
                                            if ((dtl_b_row.read_ct_trafo != '') && (dtl_b_row.trafo != 'LOSS')) {
                                                list_dtl_b += `<tr>
                                                                    <input type="hidden" name="dtl_b_trafo[]" id="dtl_b_trafo" class="dtl_b_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.trafo}">
                                                                    <input type="hidden" name="dtl_b_nama_trafo[]" id="dtl_b_nama_trafo" class="dtl_b_nama_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.nama_trafo}">
                                                                    <input type="hidden" name="dtl_b_read_ct_trafo[]" id="dtl_b_read_ct_trafo" class="dtl_b_read_ct_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.read_ct_trafo}">
                                                                    <td align="center" style="background-color: #ffffff !important;">${dtl_b_key + 1}</td>
                                                                    <td align="center" style="background-color: #ffffff !important;">${dtl_b_row.trafo}</td>
                                                                    <td align="left" style="background-color: #ffffff !important;">${dtl_b_row.nama_trafo}</td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_rata_hari[]" id="dtl_b_rata_hari" class="dtl_b_rata_hari form-control hitung_akm w-auto angkadantitik fixed freeze_horizontal" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_jam[]" id="dtl_b_jam" class="dtl_b_jam form-control w-auto hitung_akm angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_kwh_6k5_nilai[]" id="dtl_b_kwh_6k5_nilai" class="dtl_b_kwh_6k5_nilai form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center">${dtl_b_row.read_ct_trafo}</td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_awal[]" id="dtl_b_trafo_awal" class="dtl_b_trafo_awal hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_akhir[]" id="dtl_b_trafo_akhir" class="dtl_b_trafo_akhir hitung_total hitung_selisih hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_putaran[]" id="dtl_b_trafo_putaran" class="dtl_b_trafo_putaran hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_nilai[]" id="dtl_b_kwh_nilai" class="dtl_b_kwh_nilai hitung_selisih hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_akumulatif[]" id="dtl_b_kwh_akumulatif" class="dtl_b_kwh_akumulatif hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_akumulatif_awal[]" id="dtl_b_kwh_akumulatif_awal" class="dtl_b_kwh_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_bahanbakar_nilai[]" id="dtl_b_bahanbakar_nilai" class="dtl_b_bahanbakar_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_bahanbakar_akumulatif[]" id="dtl_b_bahanbakar_akumulatif" class="dtl_b_bahanbakar_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${bahanbakar_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_bahanbakar_akumulatif_awal[]" id="dtl_b_bahanbakar_akumulatif_awal" class="dtl_b_bahanbakar_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${bahanbakar_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_efisiensi_nilai[]" id="dtl_b_kwh_efisiensi_nilai" class="dtl_b_kwh_efisiensi_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_efisiensi_akumulatif[]" id="dtl_b_kwh_efisiensi_akumulatif" class="dtl_b_kwh_efisiensi_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_efisien_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_efisiensi_akumulatif_awal[]" id="dtl_b_kwh_efisiensi_akumulatif_awal" class="dtl_b_kwh_efisiensi_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_efisien_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${operasi_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_operasi_akumulatif_awal[]" id="dtl_b_operasi_akumulatif_awal" class="dtl_b_operasi_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${operasi_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_solar_nilai[]" id="dtl_b_solar_nilai" class="dtl_b_solar_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_solar_akumulatif[]" id="dtl_b_solar_akumulatif" class="dtl_b_solar_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${solar_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_solar_akumulatif_awal[]" id="dtl_b_solar_akumulatif_awal" class="dtl_b_solar_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${solar_akm}">
                                                                    </td>
                                                                </tr>`;
                                            } else if ((dtl_b_row.read_ct_trafo == '') && (dtl_b_row.trafo == 'LOSS')) {
                                                list_dtl_b += `<tr>
                                                                    <input type="hidden" name="dtl_b_trafo[]" id="dtl_b_trafo" class="dtl_b_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.trafo}">
                                                                    <input type="hidden" name="dtl_b_nama_trafo[]" id="dtl_b_nama_trafo" class="dtl_b_nama_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.nama_trafo}">
                                                                    <input type="hidden" name="dtl_b_read_ct_trafo[]" id="dtl_b_read_ct_trafo" class="dtl_b_read_ct_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.read_ct_trafo}">
                                                                    <td align="center" style="background-color: #ffffff !important;">${dtl_b_key + 1}</td>
                                                                    <td align="center" style="background-color: #ffffff !important;">${dtl_b_row.trafo}</td>
                                                                    <td align="left" style="background-color: #ffffff !important;">${dtl_b_row.nama_trafo}</td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_rata_hari[]" id="dtl_b_rata_hari" class="dtl_b_rata_hari form-control hitung_akm w-auto angkadantitik fixed freeze_horizontal" style="text-align: center;" value=""></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_jam[]" id="dtl_b_jam" class="dtl_b_jam form-control w-auto hitung_akm angkadantitik hitung_selisih" style="text-align: center;" value=""></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_kwh_6k5_nilai[]" id="dtl_b_kwh_6k5_nilai" class="dtl_b_kwh_6k5_nilai hitung_selisih form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center">${dtl_b_row.read_ct_trafo}</td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_trafo_awal[]" id="dtl_b_trafo_awal" class="dtl_b_trafo_awal hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_trafo_akhir[]" id="dtl_b_trafo_akhir" class="dtl_b_trafo_akhir hitung_total hitung_selisih hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_trafo_putaran[]" id="dtl_b_trafo_putaran" class="dtl_b_trafo_putaran hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_nilai[]" id="dtl_b_kwh_nilai" class="dtl_b_kwh_nilai hitung_selisih hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_akumulatif[]" id="dtl_b_kwh_akumulatif" class="dtl_b_kwh_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_akumulatif_awal[]" id="dtl_b_kwh_akumulatif_awal" class="dtl_b_kwh_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_bahanbakar_nilai[]" id="dtl_b_bahanbakar_nilai" class="dtl_b_bahanbakar_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_bahanbakar_akumulatif[]" id="dtl_b_bahanbakar_akumulatif" class="dtl_b_bahanbakar_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${bahanbakar_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_bahanbakar_akumulatif_awal[]" id="dtl_b_bahanbakar_akumulatif_awal" class="dtl_b_bahanbakar_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${bahanbakar_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_efisiensi_nilai[]" id="dtl_b_kwh_efisiensi_nilai" class="dtl_b_kwh_efisiensi_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_efisiensi_akumulatif[]" id="dtl_b_kwh_efisiensi_akumulatif" class="dtl_b_kwh_efisiensi_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_efisien_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_efisiensi_akumulatif_awal[]" id="dtl_b_kwh_efisiensi_akumulatif_awal" class="dtl_b_kwh_efisiensi_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_efisien_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${operasi_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_operasi_akumulatif_awal[]" id="dtl_b_operasi_akumulatif_awal" class="dtl_b_operasi_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${operasi_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_solar_nilai[]" id="dtl_b_solar_nilai" class="dtl_b_solar_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_solar_akumulatif[]" id="dtl_b_solar_akumulatif" class="dtl_b_solar_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${solar_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_solar_akumulatif_awal[]" id="dtl_b_solar_akumulatif_awal" class="dtl_b_solar_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${solar_akm}">
                                                                    </td>
                                                                </tr>`;
                                            } else {
                                                list_dtl_b += `<tr>
                                                                    <input type="hidden" name="dtl_b_trafo[]" id="dtl_b_trafo" class="dtl_b_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.trafo}">
                                                                    <input type="hidden" name="dtl_b_nama_trafo[]" id="dtl_b_nama_trafo" class="dtl_b_nama_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.nama_trafo}">
                                                                    <input type="hidden" name="dtl_b_read_ct_trafo[]" id="dtl_b_read_ct_trafo" class="dtl_b_read_ct_trafo form-control w-auto" style="text-align: center;" value="${dtl_b_row.read_ct_trafo}">
                                                                    <td align="center" style="background-color: #ffffff !important;">${dtl_b_key + 1}</td>
                                                                    <td align="center" style="background-color: #ffffff !important;">${dtl_b_row.trafo}</td>
                                                                    <td align="left" style="background-color: #ffffff !important;">${dtl_b_row.nama_trafo}</td>
                                                                    <td align="center"><input type="text" name="dtl_b_rata_hari[]" id="dtl_b_rata_hari" class="dtl_b_rata_hari form-control hitung_akm w-auto angkadantitik fixed freeze_horizontal" style="text-align: center;" value=""></td>
                                                                    <td align="center"><input type="text" name="dtl_b_jam[]" id="dtl_b_jam" class="dtl_b_jam form-control w-auto hitung_akm angkadantitik hitung_selisih" style="text-align: center;" value=""></td>
                                                                    <td align="center"><input type="hidden" name="dtl_b_kwh_6k5_nilai[]" id="dtl_b_kwh_6k5_nilai" class="dtl_b_kwh_6k5_nilai hitung_selisih form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center">${dtl_b_row.read_ct_trafo}</td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_awal[]" id="dtl_b_trafo_awal" class="dtl_b_trafo_awal hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_akhir[]" id="dtl_b_trafo_akhir" class="dtl_b_trafo_akhir hitung_total hitung_selisih hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_trafo_putaran[]" id="dtl_b_trafo_putaran" class="dtl_b_trafo_putaran hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_nilai[]" id="dtl_b_kwh_nilai" class="dtl_b_kwh_nilai hitung_selisih hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_akumulatif[]" id="dtl_b_kwh_akumulatif" class="dtl_b_kwh_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_akumulatif_awal[]" id="dtl_b_kwh_akumulatif_awal" class="dtl_b_kwh_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_bahanbakar_nilai[]" id="dtl_b_bahanbakar_nilai" class="dtl_b_bahanbakar_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_bahanbakar_akumulatif[]" id="dtl_b_bahanbakar_akumulatif" class="dtl_b_bahanbakar_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${bahanbakar_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_bahanbakar_akumulatif_awal[]" id="dtl_b_bahanbakar_akumulatif_awal" class="dtl_b_bahanbakar_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${bahanbakar_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_kwh_efisiensi_nilai[]" id="dtl_b_kwh_efisiensi_nilai" class="dtl_b_kwh_efisiensi_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value="" readonly></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_kwh_efisiensi_akumulatif[]" id="dtl_b_kwh_efisiensi_akumulatif" class="dtl_b_kwh_efisiensi_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_efisien_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_kwh_efisiensi_akumulatif_awal[]" id="dtl_b_kwh_efisiensi_akumulatif_awal" class="dtl_b_kwh_efisiensi_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${kwh_efisien_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${operasi_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_operasi_akumulatif_awal[]" id="dtl_b_operasi_akumulatif_awal" class="dtl_b_operasi_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${operasi_akm}">
                                                                    </td>
                                                                    <td align="center"><input type="text" name="dtl_b_solar_nilai[]" id="dtl_b_solar_nilai" class="dtl_b_solar_nilai hitung_total hitung_akm form-control w-auto angkadantitik" style="text-align: center;" value=""></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_solar_akumulatif[]" id="dtl_b_solar_akumulatif" class="dtl_b_solar_akumulatif hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${solar_akm}" readonly>
                                                                        <input type="hidden" name="dtl_b_solar_akumulatif_awal[]" id="dtl_b_solar_akumulatif_awal" class="dtl_b_solar_akumulatif_awal hitung_total form-control w-auto angkadantitik" style="text-align: center;" value="${solar_akm}">
                                                                    </td>
                                                                </tr>`;
                                            }
                                        }
                                    });
                                }
                            });
                            /* DISINI SELISIH KWH DAN GENERATOR */
                        }

                        $('#tbody_dtl_b').empty().append(list_dtl_b);
                        // dtl b end
                        // dtl c
                        let list_dtl_c = `<tr>
                                            <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                        </tr>`;

                        if (result.data.result_master_meteran.length) {
                            list_dtl_c = '';
                            $.each(result.data.result_master_meteran, function(dtl_c_key, dtl_c_row) {
                                if (dtl_c_row.children != '') {
                                    $.each(dtl_c_row.children, function(dtl_c_key2, dtl_c_row2) {
                                        let kwh_akhir = (`${dtl_c_row2.kwh_akhir}`) == 'null' ? 0 : (`${dtl_c_row2.kwh_akhir}`);
                                        if ((dtl_c_row.beban_tetap) != '') {
                                            list_dtl_c += `<tr>
                                                        <input type="hidden" name="dtl_c_reading_ct[]" id="dtl_c_reading_ct" class="dtl_c_reading_ct form-control w-auto" style="text-align: center;" value="${dtl_c_row.read_ct}">
                                                        <input type="hidden" name="dtl_c_item_id[]" id="dtl_c_item_id" class="dtl_c_item_id form-control w-auto" style="text-align: center;" value="${dtl_c_row.detail_id}">
                                                        <input type="hidden" name="dtl_c_dept_panel[]" id="dtl_c_dept_panel" class="dtl_c_dept_panel form-control w-auto" style="text-align: center;" value="${dtl_c_row.nama_meteran}">
                                                        <input type="hidden" name="dtl_c_dept_user[]" id="dtl_c_dept_user" class="dtl_c_dept_user form-control w-auto" style="text-align: center;" value="${dtl_c_row.dept_pengguna}">
                                                        <input type="hidden" name="dtl_c_status_beban[]" id="dtl_c_status_beban" class="dtl_c_status_beban form-control w-auto" style="text-align: center;" value="${dtl_c_row.status_beban}">
                                                        <td align="center" class="dtl_c_nomor">${(dtl_c_key + 1)}</td>
                                                        <td align="center"><input type="text" name="dtl_c_kode[]" id="dtl_c_kode" class="dtl_c_kode form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="${dtl_c_row.kode_kwh}" readonly></td>
                                                        <td align="center">${dtl_c_row.read_ct}</td>
                                                        <td align="left">${dtl_c_row.nama_meteran}</td>
                                                        <td align="center"><input type="text" name="dtl_c_rata_hari[]" id="dtl_c_rata_hari" class="dtl_c_rata_hari form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" style="text-align: center;" size="5" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_c_jam_operasi[]" id="dtl_c_jam_operasi" class="dtl_c_jam_operasi form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_6k6_hasil[]" id="dtl_c_kwh_6k6_hasil" class="dtl_c_kwh_6k6_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="" readonly></td>
                                                        <td align="center">
                                                            <input type="hidden" name="dtl_c_beban_persen[]" id="dtl_c_beban_persen" class="dtl_c_beban_persen_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" style="text-align: center;" value="" readonly>
                                                            <input type="text" name="dtl_c_beban_persen_fix[]" id="dtl_c_beban_persen_fix" class="dtl_c_beban_persen_fix_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="" readonly>
                                                        </td>
                                                        <td align="center"><input type="text" name="dtl_c_beban[]" id="dtl_c_beban" class="dtl_c_beban form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="${dtl_c_row.beban_tetap}"></td>
                                                        <td align="center"><input type="hidden" name="dtl_c_kwh_awal[]" id="dtl_c_kwh_awal" class="dtl_c_kwh_awal form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="${kwh_akhir}" readonly></td>
                                                        <td align="center"><input type="hidden" name="dtl_c_kwh_akhir[]" id="dtl_c_kwh_akhir" class="dtl_c_kwh_akhir form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;"></td>
                                                        <td align="center"><input type="hidden" name="dtl_c_putaran_hasil[]" id="dtl_c_putaran_hasil" class="dtl_c_putaran_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;"></td>
                                                        <td align="center"><input type="hidden" name="dtl_c_kwh_nilai[]" id="dtl_c_kwh_nilai" class="dtl_c_kwh_nilai form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" readonly></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_real_nilai[]" id="dtl_c_kwh_real_nilai" class="dtl_c_kwh_real_nilai_${dtl_c_row.detail_id} dept_kwh${dtl_c_row.dept_pengguna}_${dtl_c_row.status_beban} total_total_nilai_${dtl_c_row.status_beban} form-control w-auto angkadantitik" size="10" style="text-align: center;" value="${dtl_c_row.beban_tetap}" readonly></td>
                                                    </tr>`;
                                        } else if ((dtl_c_row.persen_beban_tetap) != '') {
                                            list_dtl_c += `<tr>
                                                        <input type="hidden" name="dtl_c_reading_ct[]" id="dtl_c_reading_ct" class="dtl_c_reading_ct form-control w-auto" style="text-align: center;" value="${dtl_c_row.read_ct}">
                                                        <input type="hidden" name="dtl_c_item_id[]" id="dtl_c_item_id" class="dtl_c_item_id form-control w-auto" style="text-align: center;" value="${dtl_c_row.detail_id}">
                                                        <input type="hidden" name="dtl_c_dept_panel[]" id="dtl_c_dept_panel" class="dtl_c_dept_panel form-control w-auto" style="text-align: center;" value="${dtl_c_row.nama_meteran}">
                                                        <input type="hidden" name="dtl_c_dept_user[]" id="dtl_c_dept_user" class="dtl_c_dept_user form-control w-auto" style="text-align: center;" value="${dtl_c_row.dept_pengguna}">
                                                        <input type="hidden" name="dtl_c_status_beban[]" id="dtl_c_status_beban" class="dtl_c_status_beban form-control w-auto" style="text-align: center;" value="${dtl_c_row.status_beban}">
                                                        <td align="center" class="dtl_c_nomor">${(dtl_c_key + 1)}</td>
                                                        <td align="center"><input type="text" name="dtl_c_kode[]" id="dtl_c_kode" class="dtl_c_kode form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="${dtl_c_row.kode_kwh}" readonly></td>
                                                        <td align="center">${dtl_c_row.read_ct}</td>
                                                        <td align="left">${dtl_c_row.nama_meteran}</td>
                                                        <td align="center"><input type="text" name="dtl_c_rata_hari[]" id="dtl_c_rata_hari" class="dtl_c_rata_hari form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" style="text-align: center;" size="5" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_c_jam_operasi[]" id="dtl_c_jam_operasi" class="dtl_c_jam_operasi form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_6k6_hasil[]" id="dtl_c_kwh_6k6_hasil" class="dtl_c_kwh_6k6_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="" readonly></td>
                                                        <td align="center">
                                                            <input type="hidden" name="dtl_c_beban_persen[]" id="dtl_c_beban_persen" class="dtl_c_beban_persen_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" style="text-align: center;" value="${dtl_c_row.persen_beban_tetap}">
                                                            <input type="text" name="dtl_c_beban_persen_fix[]" id="dtl_c_beban_persen_fix" class="dtl_c_beban_persen_fix_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="">
                                                        </td>
                                                        <td align="center"><input type="text" name="dtl_c_beban[]" id="dtl_c_beban" class="dtl_c_beban form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value=""readonly></td>
                                                        <td align="center"><input type="hidden" name="dtl_c_kwh_awal[]" id="dtl_c_kwh_awal" class="dtl_c_kwh_awal form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="${kwh_akhir}" readonly></td>
                                                        <td align="center"><input type="hidden" name="dtl_c_kwh_akhir[]" id="dtl_c_kwh_akhir" class="dtl_c_kwh_akhir form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;"></td>
                                                        <td align="center"><input type="hidden" name="dtl_c_putaran_hasil[]" id="dtl_c_putaran_hasil" class="dtl_c_putaran_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;"></td>
                                                        <td align="center"><input type="hidden" name="dtl_c_kwh_nilai[]" id="dtl_c_kwh_nilai" class="dtl_c_kwh_nilai form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" readonly></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_real_nilai[]" id="dtl_c_kwh_real_nilai" class="dtl_c_kwh_real_nilai_${dtl_c_row.detail_id} dept_kwh${dtl_c_row.dept_pengguna}_${dtl_c_row.status_beban} total_total_nilai_${dtl_c_row.status_beban} form-control w-auto angkadantitik" size="10" style="text-align: center;" value="" readonly></td>
                                                    </tr>`;
                                        } else if ((dtl_c_row.status_beban) == 'TIDAK') {
                                            list_dtl_c += `<tr>
                                                        <input type="hidden" name="dtl_c_reading_ct[]" id="dtl_c_reading_ct" class="dtl_c_reading_ct form-control w-auto" style="text-align: center;" value="${dtl_c_row.read_ct}">
                                                        <input type="hidden" name="dtl_c_item_id[]" id="dtl_c_item_id" class="dtl_c_item_id form-control w-auto" style="text-align: center;" value="${dtl_c_row.detail_id}">
                                                        <input type="hidden" name="dtl_c_dept_panel[]" id="dtl_c_dept_panel" class="dtl_c_dept_panel form-control w-auto" style="text-align: center;" value="${dtl_c_row.nama_meteran}">
                                                        <input type="hidden" name="dtl_c_dept_user[]" id="dtl_c_dept_user" class="dtl_c_dept_user form-control w-auto" style="text-align: center;" value="${dtl_c_row.dept_pengguna}">
                                                        <input type="hidden" name="dtl_c_status_beban[]" id="dtl_c_status_beban" class="dtl_c_status_beban form-control w-auto" style="text-align: center;" value="${dtl_c_row.status_beban}">
                                                        <td align="center" class="dtl_c_nomor">${(dtl_c_key + 1)}</td>
                                                        <td align="center"><input type="text" name="dtl_c_kode[]" id="dtl_c_kode" class="dtl_c_kode form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="${dtl_c_row.kode_kwh}" readonly></td>
                                                        <td align="center">${dtl_c_row.read_ct}</td>
                                                        <td align="left">${dtl_c_row.nama_meteran}</td>
                                                        <td align="center"><input type="text" name="dtl_c_rata_hari[]" id="dtl_c_rata_hari" class="dtl_c_rata_hari form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" style="text-align: center;" size="5" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_c_jam_operasi[]" id="dtl_c_jam_operasi" class="dtl_c_jam_operasi form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_6k6_hasil[]" id="dtl_c_kwh_6k6_hasil" class="dtl_c_kwh_6k6_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="" readonly></td>
                                                        <td align="center">
                                                            <input type="hidden" name="dtl_c_beban_persen[]" id="dtl_c_beban_persen" class="dtl_c_beban_persen_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" style="text-align: center;">
                                                            <input type="hidden" name="dtl_c_beban_persen_fix[]" id="dtl_c_beban_persen_fix" class="dtl_c_beban_persen_fix_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;">
                                                        </td>
                                                        <td align="center"><input type="hidden" name="dtl_c_beban[]" id="dtl_c_beban" class="dtl_c_beban form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;"></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_awal[]" id="dtl_c_kwh_awal" class="dtl_c_kwh_awal form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="${kwh_akhir}" readonly></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_akhir[]" id="dtl_c_kwh_akhir" class="dtl_c_kwh_akhir form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_c_putaran_hasil[]" id="dtl_c_putaran_hasil" class="dtl_c_putaran_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="" readonly></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_nilai[]" id="dtl_c_kwh_nilai" class="dtl_c_kwh_nilai form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="" readonly></td>
                                                        <td align="center"><input type="hidden" name="dtl_c_kwh_real_nilai[]" id="dtl_c_kwh_real_nilai" class="dtl_c_kwh_real_nilai_${dtl_c_row.detail_id} dept_kwh${dtl_c_row.dept_pengguna}_${dtl_c_row.status_beban} total_total_nilai_${dtl_c_row.status_beban} form-control w-auto angkadantitik" size="10" style="text-align: center;" value="0"></td>
                                                    </tr>`;
                                        } else {
                                            list_dtl_c += `<tr>
                                                        <input type="hidden" name="dtl_c_reading_ct[]" id="dtl_c_reading_ct" class="dtl_c_reading_ct form-control w-auto" style="text-align: center;" value="${dtl_c_row.read_ct}">
                                                        <input type="hidden" name="dtl_c_item_id[]" id="dtl_c_item_id" class="dtl_c_item_id form-control w-auto" style="text-align: center;" value="${dtl_c_row.detail_id}">
                                                        <input type="hidden" name="dtl_c_dept_panel[]" id="dtl_c_dept_panel" class="dtl_c_dept_panel form-control w-auto" style="text-align: center;" value="${dtl_c_row.nama_meteran}">
                                                        <input type="hidden" name="dtl_c_dept_user[]" id="dtl_c_dept_user" class="dtl_c_dept_user form-control w-auto" style="text-align: center;" value="${dtl_c_row.dept_pengguna}">
                                                        <input type="hidden" name="dtl_c_status_beban[]" id="dtl_c_status_beban" class="dtl_c_status_beban form-control w-auto" style="text-align: center;" value="${dtl_c_row.status_beban}">
                                                        <td align="center" class="dtl_c_nomor">${(dtl_c_key + 1)}</td>
                                                        <td align="center"><input type="text" name="dtl_c_kode[]" id="dtl_c_kode" class="dtl_c_kode form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="${dtl_c_row.kode_kwh}" readonly></td>
                                                        <td align="center">${dtl_c_row.read_ct}</td>
                                                        <td align="left">${dtl_c_row.nama_meteran}</td>
                                                        <td align="center"><input type="text" name="dtl_c_rata_hari[]" id="dtl_c_rata_hari" class="dtl_c_rata_hari form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" style="text-align: center;" size="5" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_c_jam_operasi[]" id="dtl_c_jam_operasi" class="dtl_c_jam_operasi form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_6k6_hasil[]" id="dtl_c_kwh_6k6_hasil" class="dtl_c_kwh_6k6_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="" readonly></td>
                                                        <td align="center">
                                                            <input type="hidden" name="dtl_c_beban_persen[]" id="dtl_c_beban_persen" class="dtl_c_beban_persen_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" style="text-align: center;" value="">
                                                            <input type="hidden" name="dtl_c_beban_persen_fix[]" id="dtl_c_beban_persen_fix" class="dtl_c_beban_persen_fix_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="">
                                                        </td>
                                                        <td align="center"><input type="hidden" name="dtl_c_beban[]" id="dtl_c_beban" class="dtl_c_beban form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="${dtl_c_row.beban_tetap}"></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_awal[]" id="dtl_c_kwh_awal" class="dtl_c_kwh_awal form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="${kwh_akhir}" readonly></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_akhir[]" id="dtl_c_kwh_akhir" class="dtl_c_kwh_akhir form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_c_putaran_hasil[]" id="dtl_c_putaran_hasil" class="dtl_c_putaran_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="" readonly></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_nilai[]" id="dtl_c_kwh_nilai" class="dtl_c_kwh_nilai form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="" readonly></td>
                                                        <td align="center"><input type="text" name="dtl_c_kwh_real_nilai[]" id="dtl_c_kwh_real_nilai" class="dtl_c_kwh_real_nilai_${dtl_c_row.detail_id} dept_kwh${dtl_c_row.dept_pengguna}_${dtl_c_row.status_beban} total_total_nilai_${dtl_c_row.status_beban} form-control w-auto angkadantitik" size="10" style="text-align: center;" value=""></td>
                                                    </tr>`;
                                        }
                                    });
                                } else {
                                    if ((dtl_c_row.beban_tetap) != '') {
                                        list_dtl_c += `<tr>
                                                    <input type="hidden" name="dtl_c_reading_ct[]" id="dtl_c_reading_ct" class="dtl_c_reading_ct form-control w-auto" style="text-align: center;" value="${dtl_c_row.read_ct}">
                                                    <input type="hidden" name="dtl_c_item_id[]" id="dtl_c_item_id" class="dtl_c_item_id form-control w-auto" style="text-align: center;" value="${dtl_c_row.detail_id}">
                                                    <input type="hidden" name="dtl_c_dept_panel[]" id="dtl_c_dept_panel" class="dtl_c_dept_panel form-control w-auto" style="text-align: center;" value="${dtl_c_row.nama_meteran}">
                                                    <input type="hidden" name="dtl_c_dept_user[]" id="dtl_c_dept_user" class="dtl_c_dept_user form-control w-auto" style="text-align: center;" value="${dtl_c_row.dept_pengguna}">
                                                    <input type="hidden" name="dtl_c_status_beban[]" id="dtl_c_status_beban" class="dtl_c_status_beban form-control w-auto" style="text-align: center;" value="${dtl_c_row.status_beban}">
                                                    <td align="center" class="dtl_c_nomor">${(dtl_c_key + 1)}</td>
                                                    <td align="center"><input type="text" name="dtl_c_kode[]" id="dtl_c_kode" class="dtl_c_kode form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="${dtl_c_row.kode_kwh}" readonly></td>
                                                    <td align="center">${dtl_c_row.read_ct}</td>
                                                    <td align="left">${dtl_c_row.nama_meteran}</td>
                                                    <td align="center"><input type="text" name="dtl_c_rata_hari[]" id="dtl_c_rata_hari" class="dtl_c_rata_hari form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" style="text-align: center;" size="5" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_c_jam_operasi[]" id="dtl_c_jam_operasi" class="dtl_c_jam_operasi form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_6k6_hasil[]" id="dtl_c_kwh_6k6_hasil" class="dtl_c_kwh_6k6_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="" readonly></td>
                                                    <td align="center">
                                                        <input type="hidden" name="dtl_c_beban_persen[]" id="dtl_c_beban_persen" class="dtl_c_beban_persen_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" style="text-align: center;" value="" readonly>
                                                        <input type="text" name="dtl_c_beban_persen_fix[]" id="dtl_c_beban_persen_fix" class="dtl_c_beban_persen_fix_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="" readonly>
                                                    </td>
                                                    <td align="center"><input type="text" name="dtl_c_beban[]" id="dtl_c_beban" class="dtl_c_beban form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="${dtl_c_row.beban_tetap}"></td>
                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_awal[]" id="dtl_c_kwh_awal" class="dtl_c_kwh_awal form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;"></td>
                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_akhir[]" id="dtl_c_kwh_akhir" class="dtl_c_kwh_akhir form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;"></td>
                                                    <td align="center"><input type="hidden" name="dtl_c_putaran_hasil[]" id="dtl_c_putaran_hasil" class="dtl_c_putaran_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;"></td>
                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_nilai[]" id="dtl_c_kwh_nilai" class="dtl_c_kwh_nilai form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" readonly></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_real_nilai[]" id="dtl_c_kwh_real_nilai" class="dtl_c_kwh_real_nilai_${dtl_c_row.detail_id} dept_kwh${dtl_c_row.dept_pengguna}_${dtl_c_row.status_beban} total_total_nilai_${dtl_c_row.status_beban} form-control w-auto angkadantitik" size="10" style="text-align: center;" value="${dtl_c_row.beban_tetap}" readonly></td>
                                                </tr>`;
                                    } else if ((dtl_c_row.persen_beban_tetap) != '') {
                                        list_dtl_c += `<tr>
                                                    <input type="hidden" name="dtl_c_reading_ct[]" id="dtl_c_reading_ct" class="dtl_c_reading_ct form-control w-auto" style="text-align: center;" value="${dtl_c_row.read_ct}">
                                                    <input type="hidden" name="dtl_c_item_id[]" id="dtl_c_item_id" class="dtl_c_item_id form-control w-auto" style="text-align: center;" value="${dtl_c_row.detail_id}">
                                                    <input type="hidden" name="dtl_c_dept_panel[]" id="dtl_c_dept_panel" class="dtl_c_dept_panel form-control w-auto" style="text-align: center;" value="${dtl_c_row.nama_meteran}">
                                                    <input type="hidden" name="dtl_c_dept_user[]" id="dtl_c_dept_user" class="dtl_c_dept_user form-control w-auto" style="text-align: center;" value="${dtl_c_row.dept_pengguna}">
                                                    <input type="hidden" name="dtl_c_status_beban[]" id="dtl_c_status_beban" class="dtl_c_status_beban form-control w-auto" style="text-align: center;" value="${dtl_c_row.status_beban}">
                                                    <td align="center" class="dtl_c_nomor">${(dtl_c_key + 1)}</td>
                                                    <td align="center"><input type="text" name="dtl_c_kode[]" id="dtl_c_kode" class="dtl_c_kode form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="${dtl_c_row.kode_kwh}" readonly></td>
                                                    <td align="center">${dtl_c_row.read_ct}</td>
                                                    <td align="left">${dtl_c_row.nama_meteran}</td>
                                                    <td align="center"><input type="text" name="dtl_c_rata_hari[]" id="dtl_c_rata_hari" class="dtl_c_rata_hari form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" style="text-align: center;" size="5" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_c_jam_operasi[]" id="dtl_c_jam_operasi" class="dtl_c_jam_operasi form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_6k6_hasil[]" id="dtl_c_kwh_6k6_hasil" class="dtl_c_kwh_6k6_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="" readonly></td>
                                                    <td align="center">
                                                        <input type="hidden" name="dtl_c_beban_persen[]" id="dtl_c_beban_persen" class="dtl_c_beban_persen_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" style="text-align: center;" value="${dtl_c_row.persen_beban_tetap}">
                                                        <input type="text" name="dtl_c_beban_persen_fix[]" id="dtl_c_beban_persen_fix" class="dtl_c_beban_persen_fix_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="">
                                                    </td>
                                                    <td align="center"><input type="text" name="dtl_c_beban[]" id="dtl_c_beban" class="dtl_c_beban form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value=""readonly></td>
                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_awal[]" id="dtl_c_kwh_awal" class="dtl_c_kwh_awal form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;"></td>
                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_akhir[]" id="dtl_c_kwh_akhir" class="dtl_c_kwh_akhir form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;"></td>
                                                    <td align="center"><input type="hidden" name="dtl_c_putaran_hasil[]" id="dtl_c_putaran_hasil" class="dtl_c_putaran_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;"></td>
                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_nilai[]" id="dtl_c_kwh_nilai" class="dtl_c_kwh_nilai form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" readonly></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_real_nilai[]" id="dtl_c_kwh_real_nilai" class="dtl_c_kwh_real_nilai_${dtl_c_row.detail_id} dept_kwh${dtl_c_row.dept_pengguna}_${dtl_c_row.status_beban} total_total_nilai_${dtl_c_row.status_beban} form-control w-auto angkadantitik" size="10" style="text-align: center;" value="" readonly></td>
                                                </tr>`;
                                    } else if ((dtl_c_row.status_beban) == 'TIDAK') {
                                        list_dtl_c += `<tr>
                                                    <input type="hidden" name="dtl_c_reading_ct[]" id="dtl_c_reading_ct" class="dtl_c_reading_ct form-control w-auto" style="text-align: center;" value="${dtl_c_row.read_ct}">
                                                    <input type="hidden" name="dtl_c_item_id[]" id="dtl_c_item_id" class="dtl_c_item_id form-control w-auto" style="text-align: center;" value="${dtl_c_row.detail_id}">
                                                    <input type="hidden" name="dtl_c_dept_panel[]" id="dtl_c_dept_panel" class="dtl_c_dept_panel form-control w-auto" style="text-align: center;" value="${dtl_c_row.nama_meteran}">
                                                    <input type="hidden" name="dtl_c_dept_user[]" id="dtl_c_dept_user" class="dtl_c_dept_user form-control w-auto" style="text-align: center;" value="${dtl_c_row.dept_pengguna}">
                                                    <input type="hidden" name="dtl_c_status_beban[]" id="dtl_c_status_beban" class="dtl_c_status_beban form-control w-auto" style="text-align: center;" value="${dtl_c_row.status_beban}">
                                                    <td align="center" class="dtl_c_nomor">${(dtl_c_key + 1)}</td>
                                                    <td align="center"><input type="text" name="dtl_c_kode[]" id="dtl_c_kode" class="dtl_c_kode form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="${dtl_c_row.kode_kwh}" readonly></td>
                                                    <td align="center">${dtl_c_row.read_ct}</td>
                                                    <td align="left">${dtl_c_row.nama_meteran}</td>
                                                    <td align="center"><input type="text" name="dtl_c_rata_hari[]" id="dtl_c_rata_hari" class="dtl_c_rata_hari form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" style="text-align: center;" size="5" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_c_jam_operasi[]" id="dtl_c_jam_operasi" class="dtl_c_jam_operasi form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_6k6_hasil[]" id="dtl_c_kwh_6k6_hasil" class="dtl_c_kwh_6k6_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="" readonly></td>
                                                    <td align="center">
                                                        <input type="hidden" name="dtl_c_beban_persen[]" id="dtl_c_beban_persen" class="dtl_c_beban_persen_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" style="text-align: center;">
                                                        <input type="hidden" name="dtl_c_beban_persen_fix[]" id="dtl_c_beban_persen_fix" class="dtl_c_beban_persen_fix_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;">
                                                    </td>
                                                    <td align="center"><input type="hidden" name="dtl_c_beban[]" id="dtl_c_beban" class="dtl_c_beban form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;"></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_awal[]" id="dtl_c_kwh_awal" class="dtl_c_kwh_awal form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_akhir[]" id="dtl_c_kwh_akhir" class="dtl_c_kwh_akhir form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_c_putaran_hasil[]" id="dtl_c_putaran_hasil" class="dtl_c_putaran_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="" readonly></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_nilai[]" id="dtl_c_kwh_nilai" class="dtl_c_kwh_nilai form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="" readonly></td>
                                                    <td align="center"><input type="hidden" name="dtl_c_kwh_real_nilai[]" id="dtl_c_kwh_real_nilai" class="dtl_c_kwh_real_nilai_${dtl_c_row.detail_id} dept_kwh${dtl_c_row.dept_pengguna}_${dtl_c_row.status_beban} total_total_nilai_${dtl_c_row.status_beban} form-control w-auto angkadantitik" size="10" style="text-align: center;" value="0"></td>
                                                </tr>`;
                                    } else {
                                        list_dtl_c += `<tr>
                                                    <input type="hidden" name="dtl_c_reading_ct[]" id="dtl_c_reading_ct" class="dtl_c_reading_ct form-control w-auto" style="text-align: center;" value="${dtl_c_row.read_ct}">
                                                    <input type="hidden" name="dtl_c_item_id[]" id="dtl_c_item_id" class="dtl_c_item_id form-control w-auto" style="text-align: center;" value="${dtl_c_row.detail_id}">
                                                    <input type="hidden" name="dtl_c_dept_panel[]" id="dtl_c_dept_panel" class="dtl_c_dept_panel form-control w-auto" style="text-align: center;" value="${dtl_c_row.nama_meteran}">
                                                    <input type="hidden" name="dtl_c_dept_user[]" id="dtl_c_dept_user" class="dtl_c_dept_user form-control w-auto" style="text-align: center;" value="${dtl_c_row.dept_pengguna}">
                                                    <input type="hidden" name="dtl_c_status_beban[]" id="dtl_c_status_beban" class="dtl_c_status_beban form-control w-auto" style="text-align: center;" value="${dtl_c_row.status_beban}">
                                                    <td align="center" class="dtl_c_nomor">${(dtl_c_key + 1)}</td>
                                                    <td align="center"><input type="text" name="dtl_c_kode[]" id="dtl_c_kode" class="dtl_c_kode form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="${dtl_c_row.kode_kwh}" readonly></td>
                                                    <td align="center">${dtl_c_row.read_ct}</td>
                                                    <td align="left">${dtl_c_row.nama_meteran}</td>
                                                    <td align="center"><input type="text" name="dtl_c_rata_hari[]" id="dtl_c_rata_hari" class="dtl_c_rata_hari form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" style="text-align: center;" size="5" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_c_jam_operasi[]" id="dtl_c_jam_operasi" class="dtl_c_jam_operasi form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_6k6_hasil[]" id="dtl_c_kwh_6k6_hasil" class="dtl_c_kwh_6k6_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="5" style="text-align: center;" value="" readonly></td>
                                                    <td align="center">
                                                        <input type="hidden" name="dtl_c_beban_persen[]" id="dtl_c_beban_persen" class="dtl_c_beban_persen_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto" data-id="${dtl_c_row.detail_id}" style="text-align: center;" value="">
                                                        <input type="hidden" name="dtl_c_beban_persen_fix[]" id="dtl_c_beban_persen_fix" class="dtl_c_beban_persen_fix_${dtl_c_row.detail_id} form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="">
                                                    </td>
                                                    <td align="center"><input type="hidden" name="dtl_c_beban[]" id="dtl_c_beban" class="dtl_c_beban form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="${dtl_c_row.beban_tetap}"></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_awal[]" id="dtl_c_kwh_awal" class="dtl_c_kwh_awal form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_akhir[]" id="dtl_c_kwh_akhir" class="dtl_c_kwh_akhir form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_c_putaran_hasil[]" id="dtl_c_putaran_hasil" class="dtl_c_putaran_hasil form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="" readonly></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_nilai[]" id="dtl_c_kwh_nilai" class="dtl_c_kwh_nilai form-control kwh_harian_${dtl_c_row.detail_id} w-auto angkadantitik" data-id="${dtl_c_row.detail_id}" size="10" style="text-align: center;" value="" readonly></td>
                                                    <td align="center"><input type="text" name="dtl_c_kwh_real_nilai[]" id="dtl_c_kwh_real_nilai" class="dtl_c_kwh_real_nilai_${dtl_c_row.detail_id} dept_kwh${dtl_c_row.dept_pengguna}_${dtl_c_row.status_beban} total_total_nilai_${dtl_c_row.status_beban} form-control w-auto angkadantitik" size="10" style="text-align: center;" value=""></td>
                                                </tr>`;
                                    }
                                }
                            });
                        }

                        $('#tbody_dtl_c').empty().append(list_dtl_c);
                        // dtl c end
                        // dtl d
                        let list_dtl_d = `<tr>
                                            <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                        </tr>`;

                        if (result.data.result_master_dept_pengguna.length) {
                            list_dtl_d = '';
                            $.each(result.data.result_master_dept_pengguna, function(dtl_d_key, dtl_d_row) {
                                if (dtl_d_row.children) {
                                    $.each(dtl_d_row.children, function(dtl_d_key2, dtl_d_row2) {

                                        let d_kwh_akm = (`${dtl_d_row2.d_kwh_akm}`) == 'null' ? 0 : (`${dtl_d_row2.d_kwh_akm}`);
                                        let d_bahanbakar_akm = (`${dtl_d_row2.d_bahanbakar_akm}`) == 'null' ? 0 : (`${dtl_d_row2.d_bahanbakar_akm}`);

                                        list_dtl_d += `<tr>
                                                <input type="hidden" name="dtl_d_id_pemakai_panel[]" id="dtl_d_id_pemakai_panel" class="dtl_d_id_pemakai_panel form-control w-auto" style="text-align: center;" value="${dtl_d_row.headerid}">
                                                <input type="hidden" name="dtl_d_pemakai_panel[]" id="dtl_d_pemakai_panel" class="dtl_d_pemakai_panel form-control w-auto" style="text-align: center;" value="${dtl_d_row.dept_pengguna}">
                                                <td align="center">${(dtl_d_key + 1)}</td>
                                                <td align="center">${dtl_d_row.dept_pengguna}</td>
                                                <td align="center"><input type="text" name="dtl_d_pemakai_kwh[]" id="dtl_d_pemakai_kwh" class="dtl_d_pemakai_kwh_${dtl_d_row.headerid} form-control w-auto total_kwh" style="text-align: center;" value="" readonly></td>
                                                <td align="center"><input type="text" name="dtl_d_pemakai_kwh_loss[]" id="dtl_d_pemakai_kwh_loss" class="dtl_d_pemakai_kwh_loss_${dtl_d_row.headerid} form-control w-auto total_loss_kwh" style="text-align: center;" value="" readonly></td>
                                                <td align="center"><input type="text" name="dtl_d_pemakai_kwh_total[]" id="dtl_d_pemakai_kwh_total" class="dtl_d_pemakai_kwh_total_${dtl_d_row.headerid} form-control w-auto total_total" style="text-align: center;" value="" readonly></td>
                                                <td align="center"><input type="text" name="dtl_d_pemakai_persen[]" id="dtl_d_pemakai_persen" class="dtl_d_pemakai_persen_${dtl_d_row.headerid} form-control w-auto total_persen_kwh" style="text-align: center;" value="" readonly></td>
                                                <td align="center">
                                                    <input type="text" name="dtl_d_pemakai_akumulatif[]" id="dtl_d_pemakai_akumulatif" class="dtl_d_pemakai_akumulatif_${dtl_d_row.headerid} form-control w-auto total_akm_kwh" style="text-align: center;" value="${d_kwh_akm}" readonly>
                                                    <input type="hidden" name="dtl_d_pakai_akumulatif_sementara[]" id="dtl_d_pakai_akumulatif_sementara" class="dtl_d_pakai_akumulatif_sementara_${dtl_d_row.headerid} form-control w-auto" style="text-align: center;" value="${d_kwh_akm}" readonly>
                                                </td>
                                                <td align="center"><input type="text" name="dtl_d_bahan_bakar_persen[]" id="dtl_d_bahan_bakar_persen" class="dtl_d_bahan_bakar_persen_${dtl_d_row.headerid} form-control w-auto total_prsn_kwh" style="text-align: center;" value="" readonly></td>
                                                <td align="center"><input type="text" name="dtl_d_bahan_bakar_kwh[]" id="dtl_d_bahan_bakar_kwh" class="dtl_d_bahan_bakar_kwh_${dtl_d_row.headerid} form-control w-auto total_bb" style="text-align: center;" value="" readonly></td>
                                                <td align="center">
                                                <input type="text" name="dtl_d_bahan_bakar_akumulatif[]" id="dtl_d_bahan_bakar_akumulatif" class="dtl_d_bahan_bakar_akumulatif_${dtl_d_row.headerid} form-control w-auto total_akm_bb" style="text-align: center;" value="${d_bahanbakar_akm}" readonly>
                                                <input type="hidden" name="dtl_d_bahan_bakar_akumulatif_sementara[]" id="dtl_d_bahan_bakar_akumulatif_sementara" class="dtl_d_bahan_bakar_akumulatif_sementara_${dtl_d_row.headerid} form-control w-auto" style="text-align: center;" value="${d_bahanbakar_akm}" readonly>
                                                </td>
                                            </tr>`;
                                    });
                                }
                            });
                        }

                        $('#tbody_dtl_d').empty().append(list_dtl_d);
                        // dtl d end
                        // dtl e

                        if (result.data.result_master_generator.length) {
                            list_dtl_e = '';
                            $.each(result.data.result_master_generator, function(dtl_e_key, dtl_e_row) {
                                if (dtl_e_row.children) {
                                    $.each(dtl_e_row.children, function(dtl_e_key2, dtl_e_row2) {

                                        let generator = dtl_e_row.nourut == 1 ? `<td align="center" class="table-danger align-middle text-center" rowspan="` + dtl_e_row.nourutdesc + `">` + dtl_e_row.item1 + `</td>` : ``;
                                        let akumulatif_kwh = (`${dtl_e_row2.kwh_akm}`) == 'null' ? 0 : (`${dtl_e_row2.kwh_akm}`);

                                        list_dtl_e += `<tr>
                                                            <input type="hidden" name="dtl_e_generator[]" id="dtl_e_generator" class="dtl_e_generator form-control w-auto" style="text-align: center;" value="${dtl_e_row.item1}">
                                                            <input type="hidden" name="dtl_e_item_id[]" id="dtl_e_item_id" class="dtl_e_item_id form-control w-auto" style="text-align: center;" value="${dtl_e_row.detail_id_c}">
                                                            ${generator}
                                                            <td align="center"><input type="text" name="dtl_e_shift[]" id="dtl_e_shift" class="dtl_e_shift form-control w-auto angkadantitik" style="text-align: center;" value="${dtl_e_row.item2}" readonly></td>
                                                            <td align="center"><input type="text" name="dtl_e_read_ct[]" id="dtl_e_read_ct" class="dtl_e_read_ct form-control w-auto angkadantitik" style="text-align: center;" value="${dtl_e_row.item3}"></td>
                                                            <td align="center"><input type="text" name="dtl_e_putaran[]" id="dtl_e_putaran" class="dtl_e_putaran form-control w-auto kwh_harian angkadantitik" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                            <input type="text" name="dtl_e_kwh_nilai[]" id="dtl_e_kwh_nilai" class="dtl_e_kwh_nilai form-control hitung_akm w-auto angkadantitik" style="text-align: center;" value="" readonly>
                                                            </td>
                                                            <td align="center">
                                                                <input type="text" name="dtl_e_kwh_akumulatif[]" id="dtl_e_kwh_akumulatif" class="dtl_e_kwh_akumulatif form-control w-auto angkadantitik" style="text-align: center;" value="${akumulatif_kwh}" readonly>
                                                                <input type="hidden" name="dtl_e_kwh_akumulatif_awal[]" id="dtl_e_kwh_akumulatif_awal" class="dtl_e_kwh_akumulatif_awal form-control w-auto" style="text-align: center;" value="${akumulatif_kwh}" readonly>
                                                            </td>
                                                        </tr>`;
                                    });
                                }

                            });
                        }
                        $('#tbody_dtl_e').empty().append(list_dtl_e);
                        // dtl e end
                    }
                    notif_btnconfirm_custom(result.vstatus, result.pesan);
                    // get_trafo_awal();
                }
            });
        }
    }


    // rumus table A
    $(document).on('change', '.hitung_2generator', function() {
        let batubara_nilai = $(this).closest('tr').find('.dtl_a_batubara_nilai').val();
        let debu_nilai = $(this).closest('tr').find('.dtl_a_debu_nilai').val();
        let cocopit_nilai = $(this).closest('tr').find('.dtl_a_cocopit_nilai').val();
        let tempurung_nilai = $(this).val();

        let total_bahanbakar_nilai = parseFloat(batubara_nilai) + parseFloat(debu_nilai) + parseFloat(cocopit_nilai) + parseFloat(tempurung_nilai);
        (isNaN(total_bahanbakar_nilai)) ? $(this).closest('tr').find('.dtl_a_bb_nilai').val(): $(this).closest('tr').find('.dtl_a_bb_nilai').val(total_bahanbakar_nilai);

        $('.dtl_a_batubara_nilai').trigger('change');
        $('.dtl_a_bb_nilai').trigger('change');

        filterHasil();
        // hasil2();
    });

    function filterHasil(that) {
        let obj = $('[class*=tes_hsl]');
        let obj2 = $('.tes_akm');
        let nilai1 = obj[1].value;
        let nilai2 = obj[4].value;
        let akm1 = obj2[1].value;
        let akm2 = obj2[4].value;
        let final = parseFloat(nilai1) + parseFloat(nilai2);
        let final2 = parseFloat(akm1) + parseFloat(akm2);

        (isNaN(final)) ? $('.total_2generator').val(): $('.total_2generator').val(final);
        (isNaN(final2)) ? $('.total_2generator_akumulatif').val(): $('.total_2generator_akumulatif').val(final2);
    }

    function hasil2(that, BB) {
        let id = that.attr('id');
        let sumberBB = that.closest('tr').find('[class*=tes_hsl]').val() == '' ? 0 : that.closest('tr').find('[class*=tes_hsl]').val();
        let hasilBB = that.closest('tr').find(`[class*=${BB}]`).val() == '' ? 0 : that.closest('tr').find(`[class*=${BB}]`).val();
    }

    $(document).on('change', '.dtl_a_bb_nilai', function() {
        let bahanbakar_nilai = $(this).val();
        let steam_nilai = $(this).closest('tr').find('.dtl_a_steam_nilai').val();
        if (bahanbakar_nilai != '' && steam_nilai != '') {
            var nilai = $(this).closest('tr').find('.dtl_a_steam_bahanbakar_nilai').val((steam_nilai / bahanbakar_nilai).toFixed(2));
            var akumulatif = $(this).closest('tr').find('.dtl_a_steam_batubara_akumulatif_awal').val();
            var akumulatif_fix = parseFloat(akumulatif) + parseFloat(nilai.val());
            $(this).closest('tr').find('.dtl_a_steam_batubara_akumulatif').val(isNaN(akumulatif_fix) ? nilai.val() : akumulatif_fix);
        } else {
            $(this).val('');
            $(this).closest('tr').find('.dtl_a_steam_bahanbakar_nilai').val('');
        }
    });

    $(document).on('change', '.dtl_a_batubara_nilai', function() {
        let bahanbakar_nilai = $(this).val();
        let steam_nilai = $(this).closest('tr').find('.dtl_a_steam_nilai').val();
        if (bahanbakar_nilai != '' && steam_nilai != '') {
            var nilai = $(this).closest('tr').find('.dtl_a_steam_batubara_nilai').val((steam_nilai / bahanbakar_nilai).toFixed(2));
            var akumulatif = $(this).closest('tr').find('.dtl_a_steam_batubara_akumulatif_awal').val();
            var akumulatif_fix = parseFloat(akumulatif) + parseFloat(nilai.val());
            $(this).closest('tr').find('.dtl_a_steam_batubara_akumulatif').val(isNaN(akumulatif_fix) ? nilai.val() : akumulatif_fix);
        } else {
            $(this).val('');
            $(this).closest('tr').find('.dtl_a_steam_batubara_nilai').val('');
        }
    });
    // rumus END table A
    // rumus table B
    $(document).on('change', '.dtl_b_trafo_awal', function() {
        let trafo_awal = $(this).val();
        let trafo_akhir = $(this).closest('tr').find('.dtl_b_trafo_akhir').val();
        if (trafo_akhir != '') {
            $(this).closest('tr').find('.dtl_b_trafo_akhir').trigger('change')
        }
    });
    $(document).on('change', '.dtl_b_trafo_akhir', function() {
        let trafo_akhir = $(this).val();
        let trafo_awal = $(this).closest('tr').find('.dtl_b_trafo_awal').val();
        // if (trafo_awal >= trafo_akhir) {
        //     notif_btnconfirm_custom('warning', 'KWH Awal lebih dari KWH Akhir');
        //     $(this).closest('tr').find('.dtl_b_trafo_akhir').val('');
        //     $(this).closest('tr').find('.dtl_b_trafo_putaran').val('');
        //     $(this).closest('tr').find('.dtl_b_kwh_nilai').val('');
        // } else {
        let val_reading_ct = $(this).closest('tr').find('.dtl_b_read_ct_trafo').val();
        let val_putaran = $(this).closest('tr').find('.dtl_b_trafo_putaran').val((eval(trafo_akhir) - eval(trafo_awal)).toFixed(2));
        $(this).closest('tr').find('.dtl_b_kwh_nilai').val((val_putaran.val() * val_reading_ct).toFixed(2));
        // }
    });

    $(document).on('change', '.dtl_b_bahanbakar_nilai', function() {
        let bahanbakar_nilai = $(this).val();
        let kwh_nilai = $(this).closest('tr').find('.dtl_b_kwh_nilai').val();
        if (bahanbakar_nilai != '' && kwh_nilai != '') {
            var nilai = $(this).closest('tr').find('.dtl_b_kwh_efisiensi_nilai').val((kwh_nilai / bahanbakar_nilai).toFixed(2));
            var akumulatif = $(this).closest('tr').find('.dtl_b_kwh_efisiensi_akumulatif_awal').val();
            var akumulatif_fix = parseFloat(akumulatif) + parseFloat(nilai.val());
            $(this).closest('tr').find('.dtl_b_kwh_efisiensi_akumulatif').val(isNaN(akumulatif_fix) ? nilai.val() : akumulatif_fix);
        } else {
            $(this).val('');
            $(this).closest('tr').find('.dtl_b_kwh_nilai').val('');
        }
    });
    // rumus end table B

    // rumus table C
    $(document).on('change', '.dtl_c_kwh_awal', function() {
        let dtl_c_kwh_awal = $(this).val();
        let dtl_c_kwh_akhir = $(this).closest('tr').find('.dtl_c_kwh_akhir').val();
        if (dtl_c_kwh_akhir != '') {
            $(this).closest('tr').find('.dtl_c_kwh_akhir').trigger('change')
        }
    });

    $(document).on('change', '.dtl_c_kwh_akhir', function() {
        let dtl_c_kwh_akhir = $(this).val();
        let dtl_c_kwh_awal = $(this).closest('tr').find('.dtl_c_kwh_awal').val();
        // if (dtl_c_kwh_awal > dtl_c_kwh_akhir) {
        //     notif_btnconfirm_custom('warning', 'KWH Awal lebih dari KWH Akhir');
        //     $(this).closest('tr').find('.dtl_c_kwh_akhir').val('');
        //     $(this).closest('tr').find('.dtl_c_putaran_hasil').val('');
        //     $(this).closest('tr').find('.dtl_c_kwh_nilai').val('');
        //     return false;
        // }
        let that = $(this);
        let id_kwh = that.data('id');
        let kwh_85 = $('.dtl_c_kwh_real_nilai_85').val();

        if (dtl_c_kwh_awal == '') {
            notif_btnconfirm_custom('warning', 'KWH Awal Kosong !');
            $(this).closest('tr').find('.dtl_c_kwh_akhir').val('');
            $(this).closest('tr').find('.dtl_c_putaran_hasil').val('');
            $(this).closest('tr').find('.dtl_c_kwh_nilai').val('');
            return false;
        }

        let val_reading_ct = $(this).closest('tr').find('.dtl_c_reading_ct').val();
        let val_putaran = $(this).closest('tr').find('.dtl_c_putaran_hasil').val((eval(dtl_c_kwh_akhir) - eval(dtl_c_kwh_awal)).toFixed(2));

        if (id_kwh == '192') {
            $(this).closest('tr').find('.dtl_c_kwh_nilai').val(((val_putaran.val() * val_reading_ct - kwh_85)).toFixed(2));
            $(this).closest('tr').find('#dtl_c_kwh_real_nilai').val(((val_putaran.val() * val_reading_ct - kwh_85)).toFixed(2));
        } else {
            $(this).closest('tr').find('.dtl_c_kwh_nilai').val(((val_putaran.val() * val_reading_ct)).toFixed(2));
            $(this).closest('tr').find('#dtl_c_kwh_real_nilai').val(((val_putaran.val() * val_reading_ct)).toFixed(2));
        }

    });
    // end rumus table C
    // rumus table E
    let total_kwh_nilai = 0;
    let total_kwh_akumulatif = 0;

    $(document).on('change', '.dtl_e_putaran', function() {
        let val_putaran = $(this).val();
        let val_reading_ct = $(this).closest('tr').find('.dtl_e_read_ct').val();

        var nilai = $(this).closest('tr').find('.dtl_e_kwh_nilai').val(val_putaran * val_reading_ct);
        var akumulatif = $(this).closest('tr').find('.dtl_e_kwh_akumulatif_awal').val();
        var akumulatif_fix = parseFloat(akumulatif) + parseFloat(nilai.val());
        $(this).closest('tr').find('.dtl_e_kwh_akumulatif').val(isNaN(akumulatif_fix) ? nilai.val() : akumulatif_fix);

        let kwh_nilai = $(this).closest('tr').find('.dtl_e_kwh_nilai').val();
        let kwh_akm = $(this).closest('tr').find('.dtl_e_kwh_akumulatif').val();

        kwh_nilai = parseFloat(kwh_nilai).toFixed(2);
        kwh_akm = parseFloat(kwh_akm).toFixed(2);
        total_kwh_nilai += parseFloat(kwh_nilai);
        total_kwh_akumulatif += parseFloat(kwh_akm);

        $('#total_dtl_e_kwh_nilai').val(total_kwh_nilai.toFixed(2));
        $('#total_dtl_e_kwh_akumulatif').val(total_kwh_akumulatif.toFixed(2));

        let kwh_generator = $(this).closest('tr').find('.dtl_e_kwh_nilai').val();
        let kwh1 = kwh_generator[3];

        let nilai_kwh = $('.dtl_e_kwh_nilai');
        let nilai_gen1 = 0;
        let nilai_gen2 = 0;
        for (let i = 0; i < 3; i++) {
            let isi_nilai = 0;

            if (nilai_kwh[i].value !== "") {
                isi_nilai = nilai_kwh[i].value;
            }
            nilai_gen1 += parseFloat(isi_nilai);
        }
        $('.total_kwh_generator1_nilai').val(nilai_gen1);

        for (let i = 3; i < 6; i++) {
            let isi_nilai = 0;

            if (nilai_kwh[i].value !== "") {
                isi_nilai = nilai_kwh[i].value;
            }
            nilai_gen2 += parseFloat(isi_nilai);
        }
        $('.total_kwh_generator2_nilai').val(nilai_gen2);
        // $('.total_real_pakai').val((nilai).toFixed(2));


        total_dtl_c();
    })
    // end rumus table E

    //====================== RUMUS AKUMULATIF & TOTAL HASIL =============================//

    const column_dtl_a = ['steam', 'press', 'batubara', 'debu', 'cocopit', 'tempurung', 'bb', 'sabut', 'steam_batubara', 'steam_bahanbakar', 'operasi', 'dearator', 'demian', 'ct'];

    const column_dtl_b = ['kwh', 'bahanbakar', 'kwh_efisiensi', 'operasi', 'solar'];

    for (let col_a = 0; col_a < column_dtl_a.length; col_a++) {
        total_akm('dtl_a_' + column_dtl_a[col_a] + '_akumulatif');
        hitung_total('dtl_a_' + column_dtl_a[col_a] + '_nilai');
    }

    for (let col_b = 0; col_b < column_dtl_b.length; col_b++) {
        total_akm('dtl_b_' + column_dtl_b[col_b] + '_akumulatif');
        hitung_total('dtl_b_' + column_dtl_b[col_b] + '_nilai');
    }

    $(document).on('change', '.hitung_total', function() {
        var that = $(this);
        var id = $(this).attr('id');

        hitung_total(id);
        total_akm();
    });

    $(document).on('change', '.dtl_b_jam', function() {
        let dtl_b_jam = $(this).closest('tr').find('.dtl_b_jam').val();
        let dtl_b_rata_hari = $(this).closest('tr').find('.dtl_b_rata_hari').val();
        let dtl_b_kwh_6k5_nilai = dtl_b_rata_hari * dtl_b_jam;

        if (dtl_b_rata_hari != '') {
            $(this).closest('tr').find('.dtl_b_kwh_nilai').val(dtl_b_kwh_6k5_nilai);
            $(this).closest('tr').find('.dtl_b_kwh_6k5_nilai').val(dtl_b_kwh_6k5_nilai);
        } else {
            notif_btnconfirm_custom('warning', 'Kolom Rata-rata belum diisi');
            $(this).closest('tr').find('.dtl_b_jam').val('');
        }

        // hitung_akm();
    });

    // function hitung_akm(){
    $(document).on('keyup', '.hitung_akm', function() {
        var that = $(this);
        /* DETAIL A */
        var steam_a = that.closest('tr').find('.dtl_a_steam_nilai').val();
        var press = that.closest('tr').find('.dtl_a_press_nilai').val();
        var batubara = that.closest('tr').find('.dtl_a_batubara_nilai').val();
        var debu = that.closest('tr').find('.dtl_a_debu_nilai').val();
        var cocopit = that.closest('tr').find('.dtl_a_cocopit_nilai').val();
        var tempurung = that.closest('tr').find('.dtl_a_tempurung_nilai').val();
        var bb = that.closest('tr').find('.dtl_a_bb_nilai').val();
        var sabut = that.closest('tr').find('.dtl_a_sabut_nilai').val();
        var steam_batubara = that.closest('tr').find('.dtl_a_steam_batubara_nilai').val();
        var steam_bahanbakar = that.closest('tr').find('.dtl_a_steam_bahanbakar_nilai').val();
        var operasi = that.closest('tr').find('.dtl_a_operasi_nilai').val();
        var dearator = that.closest('tr').find('.dtl_a_dearator_nilai').val();
        var demian = that.closest('tr').find('.dtl_a_demian_nilai').val();
        var ct = that.closest('tr').find('.dtl_a_ct_nilai').val();

        var akm_steam_a = that.closest('tr').find('.dtl_a_steam_akumulatif_awal').val();
        var akm_press = that.closest('tr').find('.dtl_a_press_akumulatif_awal').val();
        var akm_batubara = that.closest('tr').find('.dtl_a_batubara_akumulatif_awal').val();
        var akm_debu = that.closest('tr').find('.dtl_a_debu_akumulatif_awal').val();
        var akm_cocopit = that.closest('tr').find('.dtl_a_cocopit_akumulatif_awal').val();
        var akm_tempurung = that.closest('tr').find('.dtl_a_tempurung_akumulatif_awal').val();
        var akm_bb = that.closest('tr').find('.dtl_a_bb_akumulatif_awal').val();
        var akm_sabut = that.closest('tr').find('.dtl_a_sabut_akumulatif_awal').val();
        var akm_steam_batubara = that.closest('tr').find('.dtl_a_steam_batubara_akumulatif_awal').val();
        var akm_steam_bahanbakar = that.closest('tr').find('.dtl_a_steam_bahanbakar_akumulatif_awal').val();
        var akm_operasi = that.closest('tr').find('.dtl_a_operasi_akumulatif_awal').val();
        var akm_dearator = that.closest('tr').find('.dtl_a_dearator_akumulatif_awal').val();
        var akm_demian = that.closest('tr').find('.dtl_a_demian_akumulatif_awal').val();
        var akm_ct = that.closest('tr').find('.dtl_a_ct_akumulatif_awal').val();

        var akm_steam_a_fix = (parseFloat(akm_steam_a) + parseFloat(steam_a)).toFixed(2);
        var akm_press_fix = (parseFloat(akm_press) + parseFloat(press)).toFixed(2);
        var akm_batubara_fix = (parseFloat(akm_batubara) + parseFloat(batubara)).toFixed(2);
        var akm_debu_fix = (parseFloat(akm_debu) + parseFloat(debu)).toFixed(2);
        var akm_cocopit_fix = (parseFloat(akm_cocopit) + parseFloat(cocopit)).toFixed(2);
        var akm_tempurung_fix = (parseFloat(akm_tempurung) + parseFloat(tempurung)).toFixed(2);
        var akm_bb_fix = (parseFloat(akm_bb) + parseFloat(bb)).toFixed(2);
        var akm_sabut_fix = (parseFloat(akm_sabut) + parseFloat(sabut)).toFixed(2);
        var akm_steam_batubara_fix = (parseFloat(akm_steam_batubara) + parseFloat(steam_batubara)).toFixed(2);
        var akm_steam_bahanbakar_fix = (parseFloat(akm_steam_bahanbakar) + parseFloat(steam_bahanbakar)).toFixed(2);
        var akm_operasi_fix = (parseFloat(akm_operasi) + parseFloat(operasi)).toFixed(2);
        var akm_dearator_fix = (parseFloat(akm_dearator) + parseFloat(dearator)).toFixed(2);
        var akm_demian_fix = (parseFloat(akm_demian) + parseFloat(demian)).toFixed(2);
        var akm_ct_fix = (parseFloat(akm_ct) + parseFloat(ct)).toFixed(2);

        that.closest('tr').find('.dtl_a_steam_akumulatif').val(isNaN(akm_steam_a_fix) ? akm_steam_a : akm_steam_a_fix);
        that.closest('tr').find('.dtl_a_press_akumulatif').val(isNaN(akm_press_fix) ? akm_press : akm_press_fix);
        that.closest('tr').find('.dtl_a_batubara_akumulatif').val(isNaN(akm_batubara_fix) ? akm_batubara : akm_batubara_fix);
        that.closest('tr').find('.dtl_a_debu_akumulatif').val(isNaN(akm_debu_fix) ? akm_debu : akm_debu_fix);
        that.closest('tr').find('.dtl_a_cocopit_akumulatif').val(isNaN(akm_cocopit_fix) ? akm_cocopit : akm_cocopit_fix);
        that.closest('tr').find('.dtl_a_tempurung_akumulatif').val(isNaN(akm_tempurung_fix) ? akm_tempurung : akm_tempurung_fix);
        that.closest('tr').find('.dtl_a_bb_akumulatif').val(isNaN(akm_bb_fix) ? akm_bb : akm_bb_fix);
        that.closest('tr').find('.dtl_a_sabut_akumulatif').val(isNaN(akm_sabut_fix) ? akm_sabut : akm_sabut_fix);
        that.closest('tr').find('.dtl_a_steam_batubara_akumulatif').val(isNaN(akm_steam_batubara_fix) ? akm_steam_batubara : akm_steam_batubara_fix);
        that.closest('tr').find('.dtl_a_steam_bahanbakar_akumulatif').val(isNaN(akm_steam_bahanbakar_fix) ? akm_steam_bahanbakar : akm_steam_bahanbakar_fix);
        that.closest('tr').find('.dtl_a_operasi_akumulatif').val(isNaN(akm_operasi_fix) ? akm_operasi : akm_operasi_fix);
        that.closest('tr').find('.dtl_a_dearator_akumulatif').val(isNaN(akm_dearator_fix) ? akm_dearator : akm_dearator_fix);
        that.closest('tr').find('.dtl_a_demian_akumulatif').val(isNaN(akm_demian_fix) ? akm_demian : akm_demian_fix);
        that.closest('tr').find('.dtl_a_ct_akumulatif').val(isNaN(akm_ct_fix) ? akm_ct : akm_ct_fix);

        /* DETAIL B */
        var kwh_b = that.closest('tr').find('.dtl_b_kwh_nilai').val();
        var bahanbakar = that.closest('tr').find('.dtl_b_bahanbakar_nilai').val();
        var operasi = that.closest('tr').find('.dtl_b_operasi_nilai').val();
        var solar = that.closest('tr').find('.dtl_b_solar_nilai').val();
        var akm_kwh_b = that.closest('tr').find('.dtl_b_kwh_akumulatif_awal').val();
        var akm_bahanbakar = that.closest('tr').find('.dtl_b_bahanbakar_akumulatif_awal').val();
        var akm_operasi = that.closest('tr').find('.dtl_b_operasi_akumulatif_awal').val();
        var akm_solar = that.closest('tr').find('.dtl_b_solar_akumulatif_awal').val();
        var akm_kwh_b_fix = (parseFloat(akm_kwh_b) + parseFloat(kwh_b)).toFixed(2);
        var akm_bahanbakar_fix = (parseFloat(akm_bahanbakar) + parseFloat(bahanbakar)).toFixed(2);
        var akm_operasi_fix = (parseFloat(akm_operasi) + parseFloat(operasi)).toFixed(2);
        var akm_solar_fix = (parseFloat(akm_solar) + parseFloat(solar)).toFixed(2);
        that.closest('tr').find('.dtl_b_kwh_akumulatif').val(isNaN(akm_kwh_b_fix) ? akm_kwh_b : akm_kwh_b_fix);
        that.closest('tr').find('.dtl_b_bahanbakar_akumulatif').val(isNaN(akm_bahanbakar_fix) ? akm_bahanbakar : akm_bahanbakar_fix);
        that.closest('tr').find('.dtl_b_operasi_akumulatif').val(isNaN(akm_operasi_fix) ? akm_operasi : akm_operasi_fix);
        that.closest('tr').find('.dtl_b_solar_akumulatif').val(isNaN(akm_solar_fix) ? akm_solar : akm_solar_fix);
        // console.log(akm_kwh_b_fix)
    });
    // }




    $(document).on('change', '.dtl_c_jam_operasi', function() {
        let dtl_c_jam_operasi = $(this).closest('tr').find('.dtl_c_jam_operasi').val();
        let dtl_c_rata_hari = $(this).closest('tr').find('.dtl_c_rata_hari').val();
        let kwh_dtlc = dtl_c_rata_hari * dtl_c_jam_operasi;

        if (dtl_c_rata_hari != '') {
            $(this).closest('tr').find('.dtl_c_kwh_6k6_hasil').val(kwh_dtlc);
        } else {
            notif_btnconfirm_custom('warning', 'Kolom Rata-rata belum diisi');
            $(this).closest('tr').find('.dtl_c_jam_operasi').val('');
        }
    });

    /* hitung selisih  */
    $(document).on('change', '.hitung_selisih', function() {
        let selisih1 = 0;
        let selisih2 = 0;
        let read_ct = $(this).closest('tr').find('.dtl_b_read_ct_trafo').val();
        $.each($('.dtl_b_read_ct_trafo'), function(index, val) {
            let kwh_harian = $(val).closest('tr').find('.dtl_b_kwh_nilai').val();
            let set_nol_kwh = (kwh_harian == '') ? '0' : kwh_harian;

            let kwh_6k5_nilai = $(val).closest('tr').find('.dtl_b_kwh_6k5_nilai').val();
            let set_nol_kwh_6k5 = (kwh_6k5_nilai == '') ? '0' : kwh_6k5_nilai;
            // console.log(set_nol_kwh_6k5)

            if ((val.value) != '') {
                selisih1 += parseFloat(set_nol_kwh);
            } else {
                selisih2 += parseFloat(set_nol_kwh_6k5);
            }
            let lalala = parseFloat(selisih1) - parseFloat(selisih2);

            let trilili = selisih1 + selisih2 + lalala;
            // console.log(trilili)
            $('.total_selisih').val(lalala.toFixed(2));
            $('.total_tralala').val(trilili.toFixed(2));
        });

        total_seluruh();
    });

    function total_seluruh() {
        let kwh_hariini = $('.dtl_b_kwh_nilai');
        let kwh_6k5 = $('.dtl_b_kwh_6k5_nilai');
        let hasil_kwh_hariini = 0;
        let hasil_kwh_6k5 = 0;
        let hasil_akhir = 0;

        for (let i = 0; i < kwh_hariini.length; i++) {
            let isi_nilai = 0;
            if (kwh_hariini[i].value !== "") {
                isi_nilai = kwh_hariini[i].value;
            }
            hasil_kwh_hariini += parseFloat(isi_nilai);
        }

        for (let arr = 0; arr < kwh_6k5.length; arr++) {
            let nilai_isi = 0;
            if (kwh_6k5[arr].value !== "") {
                nilai_isi = kwh_6k5[arr].value;
            }
            hasil_kwh_6k5 += parseFloat(nilai_isi);
        }

        hasil_akhir = hasil_kwh_hariini + hasil_kwh_6k5;

        $('.total_total_total').val((hasil_akhir).toFixed(2));
    }


    $(document).on('change', '[class*=kwh_harian]', function() {
        let that = $(this);
        let id_kwh = that.data('id');

        let hasil = 0;
        let hasil2 = 0;
        let hasil3 = 0;
        let hasil4 = 0;
        let hasil5 = 0;
        let hasil6 = 0;
        let hasil7 = 0;
        let hasil8 = 0;
        let hasil9 = 0;
        let hasil10 = 0;
        let hasil11 = 0;
        let hasil12 = 0;

        let tujuan_kwh = that.closest('tr').find('.dtl_c_kwh_nilai').val();

        let angka_tetap_persen_11 = $('.dtl_c_beban_persen_11').val();
        let angka_tetap_persen_27 = $('.dtl_c_beban_persen_27').val();
        let angka_tetap_persen_32 = $('.dtl_c_beban_persen_32').val();
        let angka_tetap_persen_66 = $('.dtl_c_beban_persen_66').val();
        let angka_tetap_persen_74 = $('.dtl_c_beban_persen_74').val();
        let angka_tetap_persen_81 = $('.dtl_c_beban_persen_81').val();
        let angka_tetap_persen_193 = $('.dtl_c_beban_persen_193').val();
        let angka_tetap_persen_225 = $('.dtl_c_beban_persen_225').val();
        let angka_tetap_persen_233 = $('.dtl_c_beban_persen_233').val();
        let angka_tetap_persen_234 = $('.dtl_c_beban_persen_234').val();
        let angka_tetap_persen_235 = $('.dtl_c_beban_persen_235').val();
        let angka_tetap_persen_236 = $('.dtl_c_beban_persen_236').val();
        let angka_tetap_persen_237 = $('.dtl_c_beban_persen_237').val();
        let angka_tetap_persen_238 = $('.dtl_c_beban_persen_238').val();
        let angka_tetap_persen_240 = $('.dtl_c_beban_persen_240').val();
        let angka_tetap_persen_242 = $('.dtl_c_beban_persen_242').val();
        let angka_tetap_persen_243 = $('.dtl_c_beban_persen_243').val();
        let angka_tetap_persen_244 = $('.dtl_c_beban_persen_244').val();

        let kwh_nilai10 = $('.kwh_harian_10').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_nilai23 = $('.kwh_harian_23').closest('tr').find('.dtl_c_kwh_nilai').val();
        // let kwh_nilai36    = $('.kwh_harian_36').closest('tr').find('.dtl_c_kwh_nilai').val();
        // let kwh_nilai49    = $('.kwh_harian_49').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_nilai77 = $('.kwh_harian_77').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_nilai78 = $('.kwh_harian_78').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_nilai79 = $('.kwh_harian_79').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_nilai80 = $('.kwh_harian_80').closest('tr').find('.dtl_c_kwh_nilai').val();

        let kwh_nilai48 = $('.kwh_harian_48').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_nilai167 = $('.kwh_harian_167').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_nilai260 = $('.kwh_harian_260').closest('tr').find('.dtl_c_kwh_nilai').val();
        let val_putaran = $('.kwh_harian_232').closest('tr').find('.dtl_c_putaran_hasil').val();
        let val_reading_ct = $('.kwh_harian_232').closest('tr').find('.dtl_c_reading_ct').val();

        if (id_kwh == '232' || id_kwh == '10' || id_kwh == '23' || id_kwh == '36' || id_kwh == '49' || id_kwh == '77' || id_kwh == '78' || id_kwh == '79' || id_kwh == '80' || id_kwh == '81' || id_kwh == '233' || id_kwh == '234' || id_kwh == '235' || id_kwh == '236' || id_kwh == '237' || id_kwh == '238' || id_kwh == '240' || id_kwh == '242' || id_kwh == '243' || id_kwh == '244') {
            hasil12 = (val_putaran * val_reading_ct - kwh_nilai10 - kwh_nilai23 - kwh_nilai77 - kwh_nilai78 - kwh_nilai79 - kwh_nilai80 - kwh_nilai48 - kwh_nilai167 - kwh_nilai260);
            $('.kwh_harian_232').closest('tr').find('.dtl_c_kwh_nilai').val((hasil12).toFixed(2));

            hasil = (parseFloat((angka_tetap_persen_81 / 100) * hasil12));
            $('.dtl_c_kwh_real_nilai_81').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
            $('.dtl_c_beban_persen_fix_81').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));

            hasil2 = (parseFloat((angka_tetap_persen_233 / 100) * hasil12));
            $('.dtl_c_kwh_real_nilai_233').val(isNaN(hasil2) ? '0' : (hasil2).toFixed(2));
            $('.dtl_c_beban_persen_fix_233').val(isNaN(hasil2) ? '0' : (hasil2).toFixed(2));

            hasil3 = (parseFloat((angka_tetap_persen_234 / 100) * hasil12));
            $('.dtl_c_kwh_real_nilai_234').val(isNaN(hasil3) ? '0' : (hasil3).toFixed(2));
            $('.dtl_c_beban_persen_fix_234').val(isNaN(hasil3) ? '0' : (hasil3).toFixed(2));

            hasil4 = (parseFloat((angka_tetap_persen_235 / 100) * hasil12));
            $('.dtl_c_kwh_real_nilai_235').val(isNaN(hasil4) ? '0' : (hasil4).toFixed(2));
            $('.dtl_c_beban_persen_fix_235').val(isNaN(hasil4) ? '0' : (hasil4).toFixed(2));

            hasil5 = (parseFloat((angka_tetap_persen_236 / 100) * hasil12));
            $('.dtl_c_kwh_real_nilai_236').val(isNaN(hasil5) ? '0' : (hasil5).toFixed(2));
            $('.dtl_c_beban_persen_fix_236').val(isNaN(hasil5) ? '0' : (hasil5).toFixed(2));

            hasil6 = (parseFloat((angka_tetap_persen_237 / 100) * hasil12));
            $('.dtl_c_kwh_real_nilai_237').val(isNaN(hasil6) ? '0' : (hasil6).toFixed(2));
            $('.dtl_c_beban_persen_fix_237').val(isNaN(hasil6) ? '0' : (hasil6).toFixed(2));

            hasil7 = (parseFloat((angka_tetap_persen_238 / 100) * hasil12));
            $('.dtl_c_kwh_real_nilai_238').val(isNaN(hasil7) ? '0' : (hasil7).toFixed(2));
            $('.dtl_c_beban_persen_fix_238').val(isNaN(hasil7) ? '0' : (hasil7).toFixed(2));

            hasil8 = (parseFloat((angka_tetap_persen_240 / 100) * hasil12));
            $('.dtl_c_kwh_real_nilai_240').val(isNaN(hasil8) ? '0' : (hasil8).toFixed(2));
            $('.dtl_c_beban_persen_fix_240').val(isNaN(hasil8) ? '0' : (hasil8).toFixed(2));

            hasil9 = (parseFloat((angka_tetap_persen_242 / 100) * hasil12));
            $('.dtl_c_kwh_real_nilai_242').val(isNaN(hasil9) ? '0' : (hasil9).toFixed(2));
            $('.dtl_c_beban_persen_fix_242').val(isNaN(hasil9) ? '0' : (hasil9).toFixed(2));

            hasil10 = (parseFloat((angka_tetap_persen_243 / 100) * hasil12));
            $('.dtl_c_kwh_real_nilai_243').val(isNaN(hasil10) ? '0' : (hasil10).toFixed(2));
            $('.dtl_c_beban_persen_fix_243').val(isNaN(hasil10) ? '0' : (hasil10).toFixed(2));

            hasil11 = (parseFloat((angka_tetap_persen_244 / 100) * hasil12));
            $('.dtl_c_kwh_real_nilai_244').val(isNaN(hasil11) ? '0' : (hasil11).toFixed(2));
            $('.dtl_c_beban_persen_fix_244').val(isNaN(hasil11) ? '0' : (hasil11).toFixed(2));
        }

        if ((id_kwh == '11') || (id_kwh == '32') || (id_kwh == '66') || (id_kwh == '179')) {
            hasil = (parseFloat(tujuan_kwh)) * (parseFloat(angka_tetap_persen_11 / 100));
            $('.dtl_c_kwh_real_nilai_11').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
            $('.dtl_c_beban_persen_fix_11').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));

            hasil2 = (parseFloat(tujuan_kwh)) * (parseFloat(angka_tetap_persen_32 / 100));
            $('.dtl_c_kwh_real_nilai_32').val(isNaN(hasil2) ? '0' : (hasil2).toFixed(2));
            $('.dtl_c_beban_persen_fix_32').val(isNaN(hasil2) ? '0' : (hasil2).toFixed(2));

            hasil3 = (parseFloat(tujuan_kwh)) * (parseFloat(angka_tetap_persen_66 / 100));
            $('.dtl_c_kwh_real_nilai_66').val(isNaN(hasil3) ? '0' : (hasil3).toFixed(2));
            $('.dtl_c_beban_persen_fix_66').val(isNaN(hasil3) ? '0' : (hasil3).toFixed(2));

        }

        if ((id_kwh == '27') || (id_kwh == '30')) {
            hasil = (parseFloat(tujuan_kwh)) * (parseFloat(angka_tetap_persen_27 / 100));
            $('.dtl_c_kwh_real_nilai_27').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
            $('.dtl_c_beban_persen_fix_27').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        if ((id_kwh == '74') || (id_kwh == '192') || (id_kwh == '193')) {
            hasil = (parseFloat(tujuan_kwh)) * (parseFloat(angka_tetap_persen_74 / 100));
            $('.dtl_c_kwh_real_nilai_74').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
            $('.dtl_c_beban_persen_fix_74').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));

            hasil2 = (parseFloat(tujuan_kwh)) * (parseFloat(angka_tetap_persen_193 / 100));
            $('.dtl_c_kwh_real_nilai_193').val(isNaN(hasil2) ? '0' : (hasil2).toFixed(2));
            $('.dtl_c_beban_persen_fix_193').val(isNaN(hasil2) ? '0' : (hasil2).toFixed(2));
        }

        //  if ((id_kwh == '81') || (id_kwh == '232') || (id_kwh == '233') || (id_kwh == '234') ||
        // (id_kwh == '235') || (id_kwh == '236') || (id_kwh == '237') || (id_kwh == '238') || (id_kwh == '240') ||
        // (id_kwh == '242') || (id_kwh == '243') || (id_kwh == '244')){

        // }
        let kwh_nilai28 = $('.kwh_harian_28').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_nilai98 = $('.kwh_harian_98').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_88 = $('.kwh_harian_88').closest('tr').find('.dtl_c_beban').val();
        let kwh_real_89 = $('.kwh_harian_89').closest('tr').find('.dtl_c_beban').val();
        let putaran_83 = $('.kwh_harian_83').closest('tr').find('.dtl_c_putaran_hasil').val();
        let reading_ct_83 = $('.kwh_harian_83').closest('tr').find('.dtl_c_reading_ct').val();


        if ((id_kwh == '225') || (id_kwh == '83') || (id_kwh == '28') || (id_kwh == '88') || (id_kwh == '89') || (id_kwh == '98')) {

            hasil2 = reading_ct_83 * putaran_83 - kwh_nilai28 - kwh_nilai98 - kwh_real_88 - kwh_real_89;
            $('.kwh_harian_83').closest('tr').find('.dtl_c_kwh_nilai').val(isNaN(hasil2) ? '0' : (hasil2).toFixed(2))

            hasil = (parseFloat(angka_tetap_persen_225 / 100) * hasil2);
            $('.dtl_c_kwh_real_nilai_225').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
            $('.dtl_c_beban_persen_fix_225').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        let kwh_real_14 = $('.kwh_harian_14').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_202 = $('.kwh_harian_202').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_210 = $('.kwh_harian_210').closest('tr').find('.dtl_c_beban').val();
        let kwh_real_250 = $('.kwh_harian_250').closest('tr').find('.dtl_c_beban').val();

        let kwh_real_17 = $('.kwh_harian_17').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_110 = $('.kwh_harian_110').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_111 = $('.kwh_harian_111').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_112 = $('.kwh_harian_112').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_200 = $('.kwh_harian_200').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_209 = $('.kwh_harian_209').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_261 = $('.kwh_harian_261').closest('tr').find('.dtl_c_beban').val();

        let kwh_real_30 = $('.kwh_harian_30').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_27 = $('.dtl_c_beban_persen_fix_27').val();
        let kwh_real_32 = $('.dtl_c_beban_persen_fix_32').val();
        let kwh_real_33 = $('.kwh_harian_33').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_139 = $('.kwh_harian_139').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_230 = $('.kwh_harian_230').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_179 = $('.kwh_harian_179').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_178 = $('.kwh_harian_178').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_11 = $('.dtl_c_beban_persen_fix_11').val();
        let kwh_real_66 = $('.dtl_c_beban_persen_fix_66').val();

        let kwh_real_35 = $('.kwh_harian_35').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_68 = $('.dtl_c_kwh_real_nilai_68').val();
        let kwh_real_207 = $('.kwh_harian_207').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_101 = $('.kwh_harian_101').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_31 = $('.kwh_harian_31').closest('tr').find('.dtl_c_beban').val();
        let kwh_real_37 = $('.dtl_c_kwh_real_nilai_37').val();

        let kwh_reals_37 = $('.kwh_harian_37').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_191 = $('.kwh_harian_191').closest('tr').find('.dtl_c_beban').val();
        let kwh_reals_68 = $('.kwh_harian_68').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_173 = $('.kwh_harian_173').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_248 = $('.kwh_harian_248').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_166 = $('.kwh_harian_166').closest('tr').find('.dtl_c_kwh_nilai').val();

        let kwh_real_39 = $('.kwh_harian_39').closest('tr').find('.dtl_c_kwh_6k6_hasil').val();
        let kwh_real_168 = $('.kwh_harian_168').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_169 = $('.kwh_harian_169').closest('tr').find('.dtl_c_kwh_nilai').val();

        /* WH60 */
        if ((id_kwh == '14') || (id_kwh == '202') || (id_kwh == '210') || (id_kwh == '250')) {
            hasil = (kwh_real_14) - (kwh_real_202) - (kwh_real_210) - (kwh_real_250);
            $('.dtl_c_kwh_real_nilai_14').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        /* WH169 */
        if ((id_kwh == '17') || (id_kwh == '110') || (id_kwh == '111') || (id_kwh == '112') || (id_kwh == '200') || (id_kwh == '209') || (id_kwh == '261')) {
            hasil = kwh_real_17 - kwh_real_110 - kwh_real_111 - kwh_real_112 - kwh_real_200 - kwh_real_209 - kwh_real_261;
            $('.dtl_c_kwh_real_nilai_17').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        /* WH96   &&   WH101*/
        if ((id_kwh == '30') || (id_kwh == '27') || (id_kwh == '32') || (id_kwh == '179') || (id_kwh == '178') || (id_kwh == '11') || (id_kwh == '66') || (id_kwh == '33') || (id_kwh == '139') || (id_kwh == '230')) {
            hasil = kwh_real_30 - kwh_real_27 - kwh_real_33 - kwh_real_139 - kwh_real_230
            $('.dtl_c_kwh_real_nilai_30').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));

            hasil2 = kwh_real_179 - kwh_real_11 - kwh_real_32 - kwh_real_66 - kwh_real_178;
            $('.dtl_c_kwh_real_nilai_179').val(isNaN(hasil2) ? '0' : (hasil2).toFixed(2));
        }

        let kwh_real_43 = $('.kwh_harian_43').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_194 = $('.kwh_harian_194').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_71 = $('.kwh_harian_71').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_226 = $('.kwh_harian_226').closest('tr').find('.dtl_c_kwh_nilai').val();

        // let kwh_real_62   = $('.kwh_harian_62').closest('tr').find('.dtl_c_kwh_nilai').val();
        // let kwh_real_59   = $('.kwh_harian_59').closest('tr').find('.dtl_c_kwh_nilai').val();

        let kwh_real_64 = $('.kwh_harian_64').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_84 = $('.kwh_harian_84').closest('tr').find('.dtl_c_kwh_nilai').val();

        let kwh_real_82 = $('.kwh_harian_82').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_245 = $('.kwh_harian_245').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_246 = $('.kwh_harian_246').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_247 = $('.kwh_harian_247').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_249 = $('.kwh_harian_249').closest('tr').find('.dtl_c_kwh_nilai').val();
        // let kwh_reals_68 = $('.kwh_harian_68').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_22 = $('.kwh_harian_22').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_24 = $('.kwh_harian_24').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_25 = $('.kwh_harian_25').closest('tr').find('.dtl_c_kwh_nilai').val();

        let kwh_real_100 = $('.kwh_harian_100').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_46 = $('.kwh_harian_46').closest('tr').find('.dtl_c_kwh_nilai').val();

        /*  NO. 20   &&     WH31     &&     WH34 */
        if ((id_kwh == '35') || (id_kwh == '68') || (id_kwh == '207') || (id_kwh == '101') || (id_kwh == '31') || (id_kwh == '37') || (id_kwh == '191') || (id_kwh == '173') || (id_kwh == '248') || (id_kwh == '68') || (id_kwh == '82') || (id_kwh == '245') || (id_kwh == '246') || (id_kwh == '247') || (id_kwh == '249') || (id_kwh == '22') || (id_kwh == '24') || (id_kwh == '25') || (id_kwh == '166')) {
            hasil = kwh_real_35 - kwh_real_37 - kwh_real_68 - kwh_real_207 - kwh_real_101 - kwh_real_31;
            $('.dtl_c_kwh_real_nilai_262').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));

            hasil2 = kwh_reals_37 - kwh_real_191 - kwh_real_166 - kwh_real_173 - kwh_real_248;
            $('.dtl_c_kwh_real_nilai_37').val(isNaN(hasil2) ? '0' : (hasil2).toFixed(2));

            /* WH34 */
            hasil3 = kwh_reals_68 - kwh_real_82 - kwh_real_245 - kwh_real_246 - kwh_real_247 - kwh_real_249 - kwh_real_22 - kwh_real_24 - kwh_real_25;
            $('.dtl_c_kwh_real_nilai_68').val(isNaN(hasil3) ? '0' : (hasil3).toFixed(2));
        }

        /* WH34 */

        /* WH31 */
        // if((id_kwh =='37') || (id_kwh == '25') || (id_kwh == '166') || (id_kwh == '173') || (id_kwh == '191')){
        //     hasil = kwh_reals_37 - kwh_real_25 -kwh_real_166 - kwh_real_173 - kwh_real_191;
        //     $('.dtl_c_kwh_real_nilai_37').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        // }

        /* WH6K6 */
        if ((id_kwh == '39') || (id_kwh == '168') || (id_kwh == '169')) {
            hasil = kwh_real_39 - kwh_real_168 - kwh_real_169;
            $('.dtl_c_kwh_real_nilai_39').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }




        /* WH17     &&        WH21 */
        if ((id_kwh == '43') || (id_kwh == '194') || (id_kwh == '71') || (id_kwh == '226')) {
            hasil = kwh_real_43 - kwh_real_194;
            $('.dtl_c_kwh_real_nilai_43').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));

            hasil2 = kwh_real_71 - kwh_real_226;
            $('.dtl_c_kwh_real_nilai_71').val(isNaN(hasil2) ? '0' : (hasil2).toFixed(2));
        }

        // /* WH190 */
        // if((id_kwh == '62') || (id_kwh == '59')){
        //     hasil = kwh_real_62 - kwh_real_59;
        //     $('.dtl_c_kwh_real_nilai_62').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        // }

        /* WH11 */
        if ((id_kwh == '64') || (id_kwh == '84')) {
            hasil = kwh_real_64 - kwh_real_84;
            $('.dtl_c_kwh_real_nilai_64').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        /* WH215 */
        if ((id_kwh == '100') || (id_kwh == '46')) {
            hasil = kwh_real_100 - kwh_real_46;
            $('.dtl_c_kwh_real_nilai_100').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        let kwh_real_116 = $('.kwh_harian_116').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_73 = $('.kwh_harian_73').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_192 = $('.kwh_harian_192').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_203 = $('.kwh_harian_203').closest('tr').find('.dtl_c_beban').val();

        let kwh_real_118 = $('.kwh_harian_118').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_47 = $('.kwh_harian_47').closest('tr').find('.dtl_c_beban').val();
        let kwh_real_29 = $('.kwh_harian_29').closest('tr').find('.dtl_c_beban').val();

        let kwh_real_138 = $('.kwh_harian_138').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_205 = $('.kwh_harian_205').closest('tr').find('.dtl_c_beban').val();

        let kwh_real_140 = $('.kwh_harian_140 ').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_160 = $('.kwh_harian_160 ').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_161 = $('.kwh_harian_161 ').closest('tr').find('.dtl_c_kwh_nilai').val();

        let kwh_real_141 = $('.kwh_harian_141 ').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_162 = $('.kwh_harian_162 ').closest('tr').find('.dtl_c_kwh_nilai').val();


        /* WH18 */
        if ((id_kwh == '116') || (id_kwh == '73') || (id_kwh == '192') || (id_kwh == '203')) {
            hasil = kwh_real_116 - kwh_real_73 - kwh_real_192 - kwh_real_203;
            $('.dtl_c_kwh_real_nilai_116').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        /* WH6K9 */
        if ((id_kwh == '118') || (id_kwh == '47') || (id_kwh == '29')) {
            hasil = kwh_real_118 - kwh_real_47 - kwh_real_29;
            $('.dtl_c_kwh_real_nilai_118').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        /* WH6K10 */
        if ((id_kwh == '138') || (id_kwh == '205')) {
            hasil = kwh_real_138 - kwh_real_205;
            $('.dtl_c_kwh_real_nilai_138').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        /* WH1 */
        if ((id_kwh == '140') || (id_kwh == '160') || (id_kwh == '161')) {
            hasil = kwh_real_140 - kwh_real_160 - kwh_real_161;
            $('.dtl_c_kwh_real_nilai_140').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        /* WH4 */
        if ((id_kwh == '141') || (id_kwh == '162')) {
            hasil = kwh_real_141 - kwh_real_162;
            $('.dtl_c_kwh_real_nilai_141').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        // let kwh_real_205    = $('.kwh_harian_205').closest('tr').find('.dtl_c_beban').val();

        let kwh_real_172 = $('.kwh_harian_172').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_36 = $('.kwh_harian_36').closest('tr').find('.dtl_c_kwh_nilai').val();

        let kwh_real_181 = $('.kwh_harian_181').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_198 = $('.kwh_harian_198').closest('tr').find('.dtl_c_beban').val();

        let kwh_real_255 = $('.kwh_harian_255').closest('tr').find('.dtl_c_kwh_nilai').val();

        let kwh_real_211 = $('.kwh_harian_211').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_150 = $('.kwh_harian_150').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_151 = $('.kwh_harian_151').closest('tr').find('.dtl_c_kwh_nilai').val();

        let kwh_real_218 = $('.kwh_harian_218').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_253 = $('.kwh_harian_253').closest('tr').find('.dtl_c_kwh_nilai').val();

        let kwh_real_155 = $('.kwh_harian_155 ').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_212 = $('.kwh_harian_212').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_188 = $('.kwh_harian_188').closest('tr').find('.dtl_c_beban').val();
        let kwh_real_189 = $('.kwh_harian_189').closest('tr').find('.dtl_c_beban').val();
        let kwh_real_146 = $('.kwh_harian_146').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_147 = $('.kwh_harian_147').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_148 = $('.kwh_harian_148').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_152 = $('.kwh_harian_152').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_153 = $('.kwh_harian_153').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_154 = $('.kwh_harian_154').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_201 = $('.kwh_harian_201').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_229 = $('.kwh_harian_229').closest('tr').find('.dtl_c_beban').val();

        /* WH156 */
        if ((id_kwh == '172') || (id_kwh == '36')) {
            hasil = kwh_real_172 - kwh_real_36;
            $('.dtl_c_kwh_real_nilai_172').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        /* WH104 */
        if ((id_kwh == '181') || (id_kwh == '198')) {
            hasil = kwh_real_181 - kwh_real_198;
            $('.dtl_c_kwh_real_nilai_181').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        /* WH146 */
        if ((id_kwh == '201') || (id_kwh == '255')) {
            hasil = kwh_real_201 - kwh_real_255;
            $('.dtl_c_kwh_real_nilai_201').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        let kwh_reals_201 = $('.dtl_c_kwh_real_nilai_201').val();
        /* WH191  &&   WH6K12*/
        if ((id_kwh == '155') || (id_kwh == '146') || (id_kwh == '212') || (id_kwh == '188') ||
            (id_kwh == '189') || (id_kwh == '147') || (id_kwh == '148') || (id_kwh == '152') ||
            (id_kwh == '153') || (id_kwh == '154') || (id_kwh == '201') || (id_kwh == '229')) {
            hasil = kwh_real_155 - kwh_real_146;
            $('.dtl_c_kwh_real_nilai_155').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));

            hasil2 = kwh_real_212 - kwh_real_188 - kwh_real_189 - kwh_real_146 - kwh_real_147 - kwh_real_148 - kwh_real_152 - kwh_real_153 - kwh_real_154 - kwh_reals_201 - kwh_real_229;
            $('.dtl_c_kwh_real_nilai_212').val(isNaN(hasil2) ? '0' : (hasil2).toFixed(2));
        }

        /* WH6K2 */
        if ((id_kwh == '211') || (id_kwh == '150') || (id_kwh == '151')) {
            hasil = kwh_real_211 - kwh_real_150 - kwh_real_151;
            $('.dtl_c_kwh_real_nilai_211').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));

        }


        /* WH116 */
        if ((id_kwh == '218') || (id_kwh == '253')) {
            hasil = kwh_real_218 - kwh_real_253;
            $('.dtl_c_kwh_real_nilai_218').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }


        let kwh_real_228 = $('.kwh_harian_228').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_220 = $('.kwh_harian_220').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_258 = $('.kwh_harian_258').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_157 = $('.kwh_harian_157').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_184 = $('.kwh_harian_184').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_185 = $('.kwh_harian_185').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_186 = $('.kwh_harian_186').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_259 = $('.kwh_harian_259').closest('tr').find('.dtl_c_kwh_nilai').val();

        let kwh_real_231 = $('.kwh_harian_231').closest('tr').find('.dtl_c_kwh_nilai').val();
        let kwh_real_76 = $('.kwh_harian_76').closest('tr').find('.dtl_c_kwh_nilai').val();

        /* WH6k7   &&    WH203*/
        if ((id_kwh == '228') || (id_kwh == '220') || (id_kwh == '258') || (id_kwh == '157') || (id_kwh == '184') || (id_kwh == '185') || (id_kwh == '186') || (id_kwh == '259')) {
            hasil2 = kwh_real_258 - kwh_real_259;
            $('.dtl_c_kwh_real_nilai_258').val(isNaN(hasil2) ? '0' : (hasil2).toFixed(2));

            let kwh_reals_258 = $('.dtl_c_kwh_real_nilai_258').val();

            hasil = kwh_real_228 - kwh_real_220 - kwh_real_157 - kwh_real_184 - kwh_real_185 - kwh_real_186 - kwh_reals_258;
            $('.dtl_c_kwh_real_nilai_228').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));

        }

        /* WH128 */
        if ((id_kwh == '231') || (id_kwh == '76')) {
            hasil = kwh_real_231 - kwh_real_76;
            $('.dtl_c_kwh_real_nilai_231').val(isNaN(hasil) ? '0' : (hasil).toFixed(2));
        }

        total_dtl_c();
    });

    function total_dtl_c() {
        let nilai_akhir = $('.total_total_nilai_YA');
        // let nilai_akhir = $('[class*=dtl_c_kwh_real_nilai]');
        let nilai = 0;
        for (let i = 0; i < nilai_akhir.length; i++) {
            let isi_nilai = 0;

            if (nilai_akhir[i].value !== "") {
                isi_nilai = nilai_akhir[i].value;
            }
            nilai += parseFloat(isi_nilai);
            // console.log(nilai_akhir.length);
        }
        $('.total_real_pakai').val((nilai).toFixed(2));


        let gengset = $('.supplay_pwh').val();
        $('.total_star_genset').val(isNaN(gengset) ? '0' : gengset);

        let total_real = $('.total_real_pakai').val();
        let kwh_gen1 = $('.total_kwh_generator1_nilai').val();
        let kwh_gen2 = $('.total_kwh_generator2_nilai').val();
        let star_gensent = $('.total_star_genset').val();
        let total = 0;
        let total_loss = 0;

        total = parseFloat(kwh_gen1) + parseFloat(kwh_gen2) + parseFloat(star_gensent);
        $('.total_generator').val(total);

        total_loss = (parseFloat(kwh_gen1) + parseFloat(kwh_gen2) + parseFloat(star_gensent)) - total_real;
        $('.total_kwh_loss_nilai').val((total_loss).toFixed(2));


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
            $('.total_' + id).empty().val((total).toFixed(2));
        } else {
            $('.total_' + id).empty().val('0');
        }
    }

    function total_akm() {

        // TABLE A
        const column_dtl_a = ['steam', 'press', 'batubara', 'debu', 'cocopit', 'tempurung', 'bb', 'sabut', 'steam_batubara', 'steam_bahanbakar', 'operasi', 'dearator', 'demian', 'ct'];

        for (let col_a = 0; col_a < column_dtl_a.length; col_a++) {
            let val_akumulatif = 0;
            let akumulatif = $('.dtl_a_' + column_dtl_a[col_a] + '_akumulatif');
            for (let i = 0; i < akumulatif.length; i++) {
                if (akumulatif[i].value) {
                    val_akumulatif = (parseFloat(val_akumulatif) + parseFloat(akumulatif[i].value)).toFixed(2);
                }
            }
            $('.total_dtl_a_' + column_dtl_a[col_a] + '_akumulatif').empty().val(val_akumulatif)
        }
        // TABLE B
        const column_dtl_b = ['kwh', 'bahanbakar', 'kwh_efisiensi', 'operasi', 'solar'];

        for (let col_b = 0; col_b < column_dtl_b.length; col_b++) {
            let val_akumulatif = 0;
            let akumulatif = $('.dtl_b_' + column_dtl_b[col_b] + '_akumulatif');
            for (let i = 0; i < akumulatif.length; i++) {
                if (akumulatif[i].value) {
                    val_akumulatif = (parseFloat(val_akumulatif) + parseFloat(akumulatif[i].value)).toFixed(2);
                }
            }
            $('.total_dtl_b_' + column_dtl_b[col_b] + '_akumulatif').empty().val(val_akumulatif)
        }

    }

    ///* ----------- *///
    ///* TABLE AKHIR *///
    ///* ----------- *///


    $('#btn_refresh').click(function() {
        let create_date = $('.create_date').val();
        for (alala = 1; alala < 73; alala++) {
            table_akhir('.dept_kwh' + alala + '_YA', '.dtl_d_pemakai_kwh_' + alala);
        }

        hitung_table_akhir();
        keterangan();
    });

    function keterangan() {
        let total_steam = $('.total_dtl_a_steam_nilai').val();
        let total_batubara = $('.total_dtl_a_batubara_nilai').val();
        let akm_total_steam = $('.total_dtl_a_steam_akumulatif').val();
        let akm_total_batubara = $('.total_dtl_a_batubara_akumulatif').val();
        let total_akm_hari_ini = $('#total_dtl_b_kwh_nilai').val();
        let total_rekap_bb = $('#total_dtl_b_bahanbakar_nilai').val();
        let ton_steam = 0;
        let kg_bb = 0;
        let ef_kwh = 0;
        let ef_bb = 0;
        let ef_kwh2 = 0;
        let ef_bb2 = 0;

        ton_steam = parseFloat(total_batubara) / parseFloat(total_steam);
        kg_bb = (parseFloat(akm_total_steam) / parseFloat(akm_total_batubara)) * 1000;
        ef_kwh = parseFloat(total_rekap_bb) / parseFloat(total_akm_hari_ini);
        ef_bb = parseFloat(total_akm_hari_ini) / parseFloat(total_rekap_bb);
        ef_kwh2 = parseFloat(total_batubara) / parseFloat(total_rekap_bb);
        ef_bb2 = parseFloat(total_rekap_bb) / parseFloat(total_batubara);

        $('.ef_ton_steam').val(isNaN(ton_steam) ? '0' : (ton_steam).toFixed(2));
        $('.ef_kg_bb').val(isNaN(kg_bb) ? '0' : (kg_bb).toFixed(2));
        $('.ef_kwh').val(isNaN(ef_kwh) ? '0' : (ef_kwh).toFixed(2));
        $('.ef_bb').val(isNaN(ef_bb) ? '0' : (ef_bb).toFixed(2));
        $('.ef_kwh2').val(isNaN(ef_kwh2) ? '0' : (ef_kwh2).toFixed(2));
        $('.ef_bb2').val(isNaN(ef_bb2) ? '0' : (ef_bb2).toFixed(2));

        // console.log(total_steam)
        // console.log(total_batubara)
    }

    function table_akhir(lala1, lala2) {
        let total = 0;
        let x = $(lala1);

        for (let i = 0; i < x.length; i++) {
            let isi_nilai = 0;
            if (x[i].value !== "") {
                isi_nilai = x[i].value;
            }
            total += parseFloat(isi_nilai);
        }
        $(lala2).val(total);
    }

    function hitung_table_akhir() {
        let kwh_dtld = $('.total_kwh');
        let total_akhir_kwh = 0;

        for (let l = 0; l < kwh_dtld.length; l++) {
            let isi_nilai = 0;
            if (kwh_dtld[l].value !== "") {
                isi_nilai = kwh_dtld[l].value;
            }
            total_akhir_kwh += parseFloat(isi_nilai);
        }
        $('.total_dtl_d_pemakai_kwh').val((total_akhir_kwh).toFixed(2));

        for (let nde = 1; nde < 73; nde++) {
            cari_loss_kwh('.dtl_d_pemakai_kwh_' + nde, '.dtl_d_pemakai_kwh_loss_' + nde);
        }

        for (ck = 1; ck < 73; ck++) {
            cari_total_kwh('.dtl_d_pemakai_kwh_' + ck, '.dtl_d_pemakai_kwh_loss_' + ck, '.dtl_d_pemakai_kwh_total_' + ck);
            akm_kwh('.dtl_d_pemakai_kwh_total_' + ck, '.dtl_d_pakai_akumulatif_sementara_' + ck, '.dtl_d_pemakai_akumulatif_' + ck);
        }

        total_loss_kwh();

        for (lol = 1; lol < 73; lol++) {
            bhn_bkr_akm('.dtl_d_bahan_bakar_kwh_' + lol, '.dtl_d_bahan_bakar_akumulatif_sementara_' + lol, '.dtl_d_bahan_bakar_akumulatif_' + lol);
        }

        total_akm_bb();
    }

    function cari_loss_kwh(kelaaas, tujuan) {
        let loss_kwh = 0;
        let kelas = $(kelaaas).val();
        let total_kwh = $('.total_dtl_d_pemakai_kwh').val();
        let total_loss = $('.total_kwh_loss_nilai').val();

        loss_kwh = (kelas / total_kwh) * total_loss;

        $(tujuan).val((loss_kwh).toFixed(2));
    }

    function akm_kwh(ini, cls2, tjn) {
        let akm_kwh = 0;
        let kelas1 = $(ini).val();
        let kelas2 = $(cls2).val();

        akm_kwh = parseFloat(kelas1) + parseFloat(kelas2);

        $(tjn).val((akm_kwh).toFixed(2));
    }

    function bhn_bkr_akm(itu, kelees2, tejean) {
        let bhn_bkr_akm = 0;
        let kelas1 = $(itu).val();
        let kelas2 = $(kelees2).val();

        bhn_bkr_akm = parseFloat(kelas1) + parseFloat(kelas2);

        $(tejean).val((bhn_bkr_akm).toFixed(2));
    }

    function cari_total_kwh(param1, param2, param3) {
        let kwh_hari_ini = $(param1).val();
        let loss_kwh_hari_ini = $(param2).val();
        let total_kwh = 0;

        total_kwh = parseFloat(kwh_hari_ini) + parseFloat(loss_kwh_hari_ini);

        $(param3).val((total_kwh).toFixed(2));

    }

    function total_loss_kwh() {
        let total = 0;
        let total2 = 0;
        let x = $('.total_loss_kwh');
        let total_total = $('.total_total');

        for (let i = 0; i < x.length; i++) {
            let isi_nilai = 0;
            if (x[i].value !== "") {
                isi_nilai = x[i].value;
            }
            total += parseFloat(isi_nilai);
        }

        for (let ls = 0; ls < total_total.length; ls++) {
            let nilai = 0;
            if (total_total[ls].value !== "") {
                nilai = total_total[ls].value;
            }
            total2 += parseFloat(nilai);
        }

        $('.total_dtl_d_pemakai_kwh_loss').val((total).toFixed(2));
        $('.total_dtl_d_pemakai_kwh_total').val((total2).toFixed(2));


        /* trigger table bawah */
        for (let gigi = 1; gigi < 73; gigi++) {
            persen_kwh('.dtl_d_pemakai_kwh_total_' + gigi, '.dtl_d_pemakai_persen_' + gigi);
        }

        for (let gaga = 1; gaga < 73; gaga++) {
            pakai_bahan_bakar('.dtl_d_pemakai_kwh_total_' + gaga, '.dtl_d_bahan_bakar_kwh_' + gaga);
        }
        // pakai_bahan_bakar('.dtl_d_pemakai_kwh_total_1' ,'.dtl_d_bahan_bakar_kwh_1');

        total_persen_kwh();
        total_akm_kwh();
        total_pakai_bahan_bakar();
        for (let kakiku = 1; kakiku < 73; kakiku++) {
            prsn_bhn_bkr('.dtl_d_pemakai_akumulatif_' + kakiku, '.dtl_d_bahan_bakar_persen_' + kakiku);
        }
        total_prsn_kwh();
    }

    // KOLOM PERSEN

    function persen_kwh(pararam, padadang) {
        let kwh_sebelah = $(pararam).val();
        let total_kwh_bawah = $('.total_dtl_d_pemakai_kwh_total').val();
        let hasil = 0;

        hasil = (parseFloat(kwh_sebelah) / parseFloat(total_kwh_bawah)) * 100;
        // console.log(total_kwh_bawah)
        $(padadang).val((hasil).toFixed(2));
    }

    function total_persen_kwh() {
        let persen = $('.total_persen_kwh');
        let hasil_persen = 0;

        for (let i = 0; i < persen.length; i++) {
            let isi_nilai = 0;
            if (persen[i].value !== "") {
                isi_nilai = persen[i].value;
            }
            hasil_persen += parseFloat(isi_nilai);
        }

        $('.total_dtl_d_pemakai_persen').val((hasil_persen).toFixed(2));
    }

    function total_akm_kwh() {
        let akm_kwh = $('.total_akm_kwh');
        let hasil_akm_kwh = 0;

        for (let i = 0; i < akm_kwh.length; i++) {
            let isi_nilai = 0;
            if (akm_kwh[i].value !== "") {
                isi_nilai = akm_kwh[i].value;
            }
            hasil_akm_kwh += parseFloat(isi_nilai);
        }

        $('.total_dtl_d_pemakai_akumulatif').val((hasil_akm_kwh).toFixed(2));
    }

    function persen_akm_kwh(parmet, dudidam) {
        let kwh_sebelah = $(parmet).val();
        let total_kwh_bawah = $('.total_dtl_d_pemakai_kwh_loss').val();
        let hasil = 0;

        hasil = kwh_sebelah / total_kwh_bawah * 100;

        $(dudidam).val((hasil).toFixed(2));
    }


    // KOLOM BAHAN BAKAR

    function pakai_bahan_bakar(para, parara) {
        let total_2_gen = $('.total_2generator').val();
        let kwh_sebelahnya = $(para).val();
        let total_kwh_sebelahnya = $('.total_dtl_d_pemakai_kwh_total').val();
        let cari_bb = 0;

        cari_bb = (parseFloat(kwh_sebelahnya) / parseFloat(total_kwh_sebelahnya)) * total_2_gen;
        // console.log(cari_bb)
        $(parara).val((cari_bb).toFixed(2));

    }

    function total_pakai_bahan_bakar() {

        let bb = $('.total_bb');
        let hasil_bb = 0;

        for (let bbb = 0; bbb < bb.length; bbb++) {
            let nilai_bb = 0;
            if (bb[bbb].value !== "") {
                nilai_bb = bb[bbb].value;
            }
            hasil_bb += parseFloat(nilai_bb);
        }

        $('.total_dtl_d_bahan_bakar_kwh').val((hasil_bb).toFixed(2));
    }

    function prsn_bhn_bkr(dudu, lele) {
        let kwh_sebelah = $(dudu).val();
        let total_kwh_bawah = $('.total_dtl_d_pemakai_akumulatif').val();
        let hasil = 0;

        hasil = kwh_sebelah / total_kwh_bawah * 100;

        $(lele).val((hasil).toFixed(2));
    }


    function total_prsn_kwh() {
        let prsn_kwh = $('.total_prsn_kwh');
        let hasil_prsn_kwh = 0;

        for (let i = 0; i < prsn_kwh.length; i++) {
            let isi_nilai = 0;
            if (prsn_kwh[i].value !== "") {
                isi_nilai = prsn_kwh[i].value;
            }
            hasil_prsn_kwh += parseFloat(isi_nilai);
        }

        $('.total_dtl_d_bahan_bakar_persen').val((hasil_prsn_kwh).toFixed(2));
    }

    function total_akm_bb() {
        let akm_bb = $('.total_akm_bb');
        let hasil_akm_bb = 0;

        for (let i = 0; i < akm_bb.length; i++) {
            let isi_nilai = 0;
            if (akm_bb[i].value !== "") {
                isi_nilai = akm_bb[i].value;
            }
            hasil_akm_bb += parseFloat(isi_nilai);
        }

        $('.total_dtl_d_bahan_bakar_akumulatif').val((hasil_akm_bb).toFixed(2));
    }
</script>


<?php $this->load->view('template/footbarend'); ?>