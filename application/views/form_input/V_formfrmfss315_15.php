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

if (isset($dtheader)) {
    $aksi  = "dtupdate";

    foreach ($dtheader as $header) {
        $headerid     = $header->headerid;

        $comment      = $header->comment;
        $comment_by   = $header->comment_by;
        $comment_time = $header->comment_time;
        $comment_date = date("d-m-Y", strtotime($header->comment_date));

        $create_date  = date("d-m-Y", strtotime($header->create_date));
        $docno        = $header->docno;
    }
} else if (isset($message)) {
    $aksi        = "dtsave";

    $create_date = $dtcreate_date;
    $docno       = $dtdocno;
} else {
    $aksi        = "dtsave";

    $create_date = date("d-m-Y", strtotime($dtcreate_date));
    $docno       = '';
}

$base_url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$fcpath2   = str_replace('utl/', '', FCPATH);
$style_ttd = 'style="width:130px; height:80px; background-size:100%;"'; ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="mt-2 mb-1 d-flex justify-content-center">
                        <img src="<?= base_url('assets/images/Logo_PSG.gif') ?>" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <h2><?= $this->config->item("nama_perusahaan2"); ?></h2>
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

                        <form action="<?= base_url('form_input/C_formfrmfss315_15/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss315" name="formfrmfss315" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
                            <div class="row mb-1">
                                <div class="col-6">

                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?= $headerid; ?>" id="headerid" class="headerid">
                                    <?php } ?>

                                    <!-- input page shift -->
                                    <input type="hidden" name="page_shift" value="<?= $page_shift; ?>" id="page_shift" class="page_shift">

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
                                            No. Dokumen/ Rev
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="docno" id="docno" class="form-control docno dtopen_blok" value="<?= $docno; ?>" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <strong>Proses Raw Water & Cone</strong>
                                    <div class="card collapse-icon accordion-icon-rotate">
                                        <div class="accordion" id="accordion_dtl">
                                            <?php $shift_jam = 6; // start jam shift per hari
                                            for ($i = 1; $i <= 3; $i++) { ?>
                                                <div class="collapse-margin">
                                                    <div class="card-header bg-gradient-info" id="<?= 'heading_dtl_a_' . $i ?>" data-toggle="collapse" role="button" data-target="<?= '#collapse_dtl_a_' . $i ?>" aria-expanded="false" aria-controls="<?= 'collapse_dtl_a_' . $i ?>">
                                                        <h4><?= 'Shift ' . $i ?></h4>
                                                        <input type="hidden" name="dtl_a_shift[]" id="dtl_a_shift" class="form-control w-auto dtl_a_shift <?= 'dtl_a_shift_' . $i ?>" style="text-align: center;" value="<?= 'shift_' . $i ?>">
                                                    </div>
                                                    <div id="<?= 'collapse_dtl_a_' . $i ?>" class="collapse" aria-labelledby="<?= 'heading_dtl_a_' . $i ?>" data-parent="#accordion_dtl">
                                                        <div class="card-body">
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_rw_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead class="table-primary">
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center" colspan="5">Proses Raw Water 1</th>
                                                                            <th class="table-primary align-middle text-center" colspan="5">Proses Raw Water 2</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <?php for ($dtl_a_th = 0; $dtl_a_th < 2; $dtl_a_th++) { ?>
                                                                                <th class="table-primary align-middle text-center">Total (Jam)</th>
                                                                                <th class="table-primary align-middle text-center">FM Awal (M³)</th>
                                                                                <th class="table-primary align-middle text-center">FM Akhir (M³)</th>
                                                                                <th class="table-primary align-middle text-center">TotaL (M³)</th>
                                                                                <th class="table-primary align-middle text-center">Drain (M³)</th>
                                                                            <?php } ?>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="<?= 'tbody_dtl_a_rw_' . $i ?>">
                                                                        <?php if (!empty($dtdetail)) {
                                                                            foreach ($dtdetail as $dtdetail_a_row) {
                                                                                if ($dtdetail_a_row->shift == 'shift_' . $i) { ?>
                                                                                    <tr>
                                                                                        <input type="hidden" id="dtl_a_shift" class="form-control w-auto dtl_a_shift <?= 'dtl_a_shift_' . $i ?>" style="text-align: center;" value="<?= 'shift_' . $i ?>">
                                                                                        <input type="hidden" name="dtl_a_detail_id[]" id="dtl_a_detail_id" class="form-control w-auto dtl_a_detail_id" style="text-align: center;" value="<?= $dtdetail_a_row->detail_id ?>">

                                                                                        <td align="center"><input type="text" name="dtl_a_rw_1_total_jam[]" id="dtl_a_rw_1_total_jam" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_1_total_jam" style="text-align: center;" value="<?= $dtdetail_a_row->rw_1_total_jam ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_rw_1_fm_awal[]" id="dtl_a_rw_1_fm_awal" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_1_fm_awal dtl_a_cari_total" style="text-align: center;" value="<?= $dtdetail_a_row->rw_1_fm_awal ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_rw_1_fm_akhir[]" id="dtl_a_rw_1_fm_akhir" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_1_fm_akhir dtl_a_cari_total" style="text-align: center;" value="<?= $dtdetail_a_row->rw_1_fm_akhir ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_rw_1_total[]" id="dtl_a_rw_1_total" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_1_total" style="text-align: center;" value="<?= $dtdetail_a_row->rw_1_total ?>" readonly></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_rw_1_drain[]" id="dtl_a_rw_1_drain" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_1_drain" style="text-align: center;" value="<?= $dtdetail_a_row->rw_1_drain ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_rw_2_total_jam[]" id="dtl_a_rw_2_total_jam" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_2_total_jam" style="text-align: center;" value="<?= $dtdetail_a_row->rw_2_total_jam ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_rw_2_fm_awal[]" id="dtl_a_rw_2_fm_awal" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_2_fm_awal dtl_a_cari_total" style="text-align: center;" value="<?= $dtdetail_a_row->rw_2_fm_awal ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_rw_2_fm_akhir[]" id="dtl_a_rw_2_fm_akhir" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_2_fm_akhir dtl_a_cari_total" style="text-align: center;" value="<?= $dtdetail_a_row->rw_2_fm_akhir ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_rw_2_total[]" id="dtl_a_rw_2_total" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_2_total" style="text-align: center;" value="<?= $dtdetail_a_row->rw_2_total ?>" readonly></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_rw_2_drain[]" id="dtl_a_rw_2_drain" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_2_drain" style="text-align: center;" value="<?= $dtdetail_a_row->rw_2_drain ?>"></td>
                                                                                    </tr>
                                                                            <?php }
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <input type="hidden" id="dtl_a_shift" class="form-control w-auto dtl_a_shift <?= 'dtl_a_shift_' . $i ?>" style="text-align: center;" value="<?= 'shift_' . $i ?>">
                                                                                <td align="center"><input type="text" name="dtl_a_rw_1_total_jam[]" id="dtl_a_rw_1_total_jam" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_1_total_jam" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_rw_1_fm_awal[]" id="dtl_a_rw_1_fm_awal" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_1_fm_awal dtl_a_cari_total" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_rw_1_fm_akhir[]" id="dtl_a_rw_1_fm_akhir" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_1_fm_akhir dtl_a_cari_total" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_rw_1_total[]" id="dtl_a_rw_1_total" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_1_total" style="text-align: center;" value="" readonly></td>
                                                                                <td align="center"><input type="text" name="dtl_a_rw_1_drain[]" id="dtl_a_rw_1_drain" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_1_drain" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_rw_2_total_jam[]" id="dtl_a_rw_2_total_jam" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_2_total_jam" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_rw_2_fm_awal[]" id="dtl_a_rw_2_fm_awal" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_2_fm_awal dtl_a_cari_total" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_rw_2_fm_akhir[]" id="dtl_a_rw_2_fm_akhir" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_2_fm_akhir dtl_a_cari_total" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_rw_2_total[]" id="dtl_a_rw_2_total" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_2_total" style="text-align: center;" value="" readonly></td>
                                                                                <td align="center"><input type="text" name="dtl_a_rw_2_drain[]" id="dtl_a_rw_2_drain" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_rw_2_drain" style="text-align: center;" value=""></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center" colspan="20"></th>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                            <hr>
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_cone_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead class="table-primary">
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center" colspan="5">Proses Cone 1 - 2</th>
                                                                            <!-- <th class="table-primary align-middle text-center" colspan="5">Proses Cone 3 - 4</th> -->
                                                                        </tr>
                                                                        <tr>
                                                                            <?php for ($dtl_a_th = 0; $dtl_a_th < 1; $dtl_a_th++) { ?>
                                                                                <th class="table-primary align-middle text-center">Total (Jam)</th>
                                                                                <th class="table-primary align-middle text-center">FM Awal (M³)</th>
                                                                                <th class="table-primary align-middle text-center">FM Akhir (M³)</th>
                                                                                <th class="table-primary align-middle text-center">TotaL (M³)</th>
                                                                                <th class="table-primary align-middle text-center">Drain (M³)</th>
                                                                            <?php } ?>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="<?= 'tbody_dtl_a_cone_' . $i ?>">
                                                                        <?php if (!empty($dtdetail)) {
                                                                            foreach ($dtdetail as $dtdetail_a_row2) {
                                                                                if ($dtdetail_a_row2->shift == 'shift_' . $i) { ?>
                                                                                    <tr>
                                                                                        <input type="hidden" id="dtl_a_shift" class="form-control w-auto dtl_a_shift <?= 'dtl_a_shift_' . $i ?>" style="text-align: center;" value="<?= 'shift_' . $i ?>">
                                                                                        <td align="center"><input type="text" name="dtl_a_cone_1_2_total_jam[]" id="dtl_a_cone_1_2_total_jam" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_1_2_total_jam" style="text-align: center;" value="<?= $dtdetail_a_row2->cone_1_2_total_jam ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_cone_1_2_fm_awal[]" id="dtl_a_cone_1_2_fm_awal" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_1_2_fm_awal dtl_a_cari_total" style="text-align: center;" value="<?= $dtdetail_a_row2->cone_1_2_fm_awal ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_cone_1_2_fm_akhir[]" id="dtl_a_cone_1_2_fm_akhir" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_1_2_fm_akhir dtl_a_cari_total" style="text-align: center;" value="<?= $dtdetail_a_row2->cone_1_2_fm_akhir ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_cone_1_2_total[]" id="dtl_a_cone_1_2_total" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_1_2_total" style="text-align: center;" value="<?= $dtdetail_a_row2->cone_1_2_total ?>" readonly></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_cone_1_2_drain[]" id="dtl_a_cone_1_2_drain" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> <?= 'required_shift_' . $i ?> dtl_a_cone_1_2_drain" style="text-align: center;" value="<?= $dtdetail_a_row2->cone_1_2_drain ?>"></td>
                                                                                        <!-- <td align="center"><input type="text" name="dtl_a_cone_3_4_total_jam[]" id="dtl_a_cone_3_4_total_jam" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_3_4_total_jam" style="text-align: center;" value="<?= $dtdetail_a_row2->cone_3_4_total_jam ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_cone_3_4_fm_awal[]" id="dtl_a_cone_3_4_fm_awal" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_3_4_fm_awal dtl_a_cari_total" style="text-align: center;" value="<?= $dtdetail_a_row2->cone_3_4_fm_awal ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_cone_3_4_fm_akhir[]" id="dtl_a_cone_3_4_fm_akhir" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_3_4_fm_akhir dtl_a_cari_total" style="text-align: center;" value="<?= $dtdetail_a_row2->cone_3_4_fm_akhir ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_cone_3_4_total[]" id="dtl_a_cone_3_4_total" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_3_4_total" style="text-align: center;" value="<?= $dtdetail_a_row2->cone_3_4_total ?>" readonly></td>
                                                                                        <td align="center"><input type="text" name="dtl_a_cone_3_4_drain[]" id="dtl_a_cone_3_4_drain" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_3_4_drain" style="text-align: center;" value="<?= $dtdetail_a_row2->cone_3_4_drain ?>"></td> -->
                                                                                    </tr>
                                                                            <?php }
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <input type="hidden" id="dtl_a_shift" class="form-control w-auto dtl_a_shift <?= 'dtl_a_shift_' . $i ?>" style="text-align: center;" value="<?= 'shift_' . $i ?>">
                                                                                <td align="center"><input type="text" name="dtl_a_cone_1_2_total_jam[]" id="dtl_a_cone_1_2_total_jam" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_1_2_total_jam" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_cone_1_2_fm_awal[]" id="dtl_a_cone_1_2_fm_awal" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_1_2_fm_awal dtl_a_cari_total" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_cone_1_2_fm_akhir[]" id="dtl_a_cone_1_2_fm_akhir" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_1_2_fm_akhir dtl_a_cari_total" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_cone_1_2_total[]" id="dtl_a_cone_1_2_total" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_1_2_total" style="text-align: center;" value="" readonly></td>
                                                                                <td align="center"><input type="text" name="dtl_a_cone_1_2_drain[]" id="dtl_a_cone_1_2_drain" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> <?= 'required_shift_' . $i ?> dtl_a_cone_1_2_drain" style="text-align: center;" value=""></td>
                                                                                <!-- <td align="center"><input type="text" name="dtl_a_cone_3_4_total_jam[]" id="dtl_a_cone_3_4_total_jam" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_3_4_total_jam" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_cone_3_4_fm_awal[]" id="dtl_a_cone_3_4_fm_awal" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_3_4_fm_awal dtl_a_cari_total" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_cone_3_4_fm_akhir[]" id="dtl_a_cone_3_4_fm_akhir" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_3_4_fm_akhir dtl_a_cari_total" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_a_cone_3_4_total[]" id="dtl_a_cone_3_4_total" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_3_4_total" style="text-align: center;" value="" readonly></td>
                                                                                <td align="center"><input type="text" name="dtl_a_cone_3_4_drain[]" id="dtl_a_cone_3_4_drain" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_a_cone_3_4_drain" style="text-align: center;" value=""></td> -->
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center" colspan="20"></th>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr>

                            <div class="row mt-1">
                                <div class="col-12">
                                    <strong>Bahan Kimia</strong>
                                    <div class="card collapse-icon accordion-icon-rotate">
                                        <div class="accordion" id="accordion_dtl_b">
                                            <?php for ($i = 1; $i <= 3; $i++) { ?>
                                                <div class="collapse-margin">
                                                    <div class="card-header bg-gradient-success" id="<?= 'heading_dtl_b_' . $i ?>" data-toggle="collapse" role="button" data-target="<?= '#collapse_dtl_b_' . $i ?>" aria-expanded="false" aria-controls="<?= 'collapse_dtl_b_' . $i ?>">
                                                        <h4>Shift <?= $i ?>
                                                        </h4>
                                                    </div>
                                                    <div id="<?= 'collapse_dtl_b_' . $i ?>" class="collapse" aria-labelledby="<?= 'heading_dtl_b_' . $i ?>" data-parent="#accordion_dtl_b">
                                                        <div class="card-body">
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead class="table-success ">
                                                                        <tr>
                                                                            <th class="table-success align-middle text-center" colspan="2" rowspan="2">Bahan Kimia</th>
                                                                            <th class="table-success align-middle text-center" colspan="3" rowspan="1">Bahan kimia Baku ( KG )</th>
                                                                            <th class="table-success align-middle text-center" colspan="3" rowspan="1">Bahan Kimia larutan ( liter)</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="table-success align-middle text-center">Terima</th>
                                                                            <th class="table-success align-middle text-center">Pakai</th>
                                                                            <th class="table-success align-middle text-center">stok</th>
                                                                            <th class="table-success align-middle text-center">Terima</th>
                                                                            <th class="table-success align-middle text-center">Pakai</th>
                                                                            <th class="table-success align-middle text-center">stok</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="<?= 'tbody_dtl_b_' . $i ?>">
                                                                        <?php if (!empty($dtdetail_b)) {
                                                                            foreach ($dtdetail_b as $dtdetail_b_row) {
                                                                                if ($dtdetail_b_row->shift == 'shift_' . $i) {
                                                                                    if ($dtdetail_b_row->id_item2 != '') {
                                                                                        $dtl_b_td      = '<td align="center">' . $dtdetail_b_row->val_item2 . ' ' . $dtdetail_b_row->val_spek2 . '</td>';
                                                                                        $dtl_b_td_cols = '1';
                                                                                    } else {
                                                                                        $dtl_b_td      = '';
                                                                                        $dtl_b_td_cols = '2';
                                                                                    }

                                                                                    $dtl_b_td = $dtdetail_b_row->rnum_item1 == '1' ? '<td align="center" rowspan="' . $dtdetail_b_row->rnum_item1_desc . '" colspan="' . $dtl_b_td_cols . '">' . (($dtdetail_b_row->val_item1 == 'Anti scalant') ? $dtdetail_b_row->val_item1 . " " . $dtdetail_b_row->val_spek2 :  $dtdetail_b_row->val_item1) . '</td>' . $dtl_b_td : $dtl_b_td; ?>

                                                                                    <tr>
                                                                                        <input type="hidden" name="dtl_b_detail_id[]" id="dtl_b_detail_id" class="form-control w-auto dtl_b_detail_id" style="text-align: center;" value="<?= $dtdetail_b_row->detail_id ?>">
                                                                                        <input type="hidden" name="dtl_b_shift[]" id="dtl_b_shift" class="form-control w-auto dtl_b_shift <?= 'dtl_b_shift_' . $i . '_' . $dtdetail_b_row->id_item1 . '_' . $dtdetail_b_row->id_item2 ?>" style="text-align: center;" value="<?= $dtdetail_b_row->shift ?>">
                                                                                        <input type="hidden" name="dtl_b_id_item1[]" id="dtl_b_id_item1" class="form-control w-auto dtl_b_id_item1" style="text-align: center;" value="<?= $dtdetail_b_row->id_item1 ?>">
                                                                                        <input type="hidden" name="dtl_b_id_item2[]" id="dtl_b_id_item2" class="form-control w-auto dtl_b_id_item2" style="text-align: center;" value="<?= $dtdetail_b_row->id_item2 ?>">
                                                                                        <input type="hidden" name="dtl_b_val_spek2[]" id="dtl_b_val_spek2" class="form-control w-auto dtl_b_val_spek2" style="text-align: center;" value="<?= $dtdetail_b_row->val_spek2 ?>">

                                                                                        <?= $dtl_b_td ?>

                                                                                        <!-- KG -->
                                                                                        <td align="center"><input type="text" name="dtl_b_baku_terima[]" id="dtl_b_baku_terima" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_b_baku_terima dtl_b_cari_stok" style="text-align: center;" value="<?= $dtdetail_b_row->baku_terima ?>" <?= $i > 1 ? 'readonly' : '' ?>></td>
                                                                                        <td align="center"><input type="text" name="dtl_b_baku_pakai[]" id="dtl_b_baku_pakai" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_b_baku_pakai dtl_b_cari_stok" style="text-align: center;" value="<?= $dtdetail_b_row->baku_pakai ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_b_baku_stok[]" id="dtl_b_baku_stok" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_b_baku_stok" style="text-align: center;" value="<?= $dtdetail_b_row->baku_stok ?>" readonly></td>

                                                                                        <!-- LTR -->
                                                                                        <td align="center"><input type="text" name="dtl_b_larutan_terima[]" id="dtl_b_larutan_terima" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_b_larutan_terima dtl_b2_cari_stok" style="text-align: center;" value="<?= $dtdetail_b_row->larutan_terima ?>" <?= $i > 1 ? 'readonly' : '' ?>></td>
                                                                                        <td align="center"><input type="text" name="dtl_b_larutan_pakai[]" id="dtl_b_larutan_pakai" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_b_larutan_pakai " style="text-align: center;" value="<?= $dtdetail_b_row->larutan_pakai ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_b_larutan_stok[]" id="dtl_b_larutan_stok" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_b_larutan_stok dtl_b2_cari_stok" style="text-align: center;" value="<?= $dtdetail_b_row->larutan_stok ?>"></td>
                                                                                    </tr>
                                                                        <?php }
                                                                            }
                                                                        } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td class="table-success align-middle text-center" colspan="15" align="center"></td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row mt-1">
                                <div class="col-12">
                                    <strong>Stok Air</strong>
                                    <div class="card collapse-icon accordion-icon-rotate">
                                        <div class="accordion" id="accordion_dtl_c">
                                            <?php for ($i = 1; $i <= 3; $i++) { ?>
                                                <div class="collapse-margin">
                                                    <div class="card-header bg-gradient-warning" id="<?= 'heading_dtl_c_' . $i ?>" data-toggle="collapse" role="button" data-target="<?= '#collapse_dtl_c_' . $i ?>" aria-expanded="false" aria-controls="<?= 'collapse_dtl_b_' . $i ?>">
                                                        <h4><?= 'Shift ' . $i ?></h4>
                                                        <input type="hidden" name="dtl_c_shift[]" id="dtl_c_shift" class="form-control dtl_c_shift" style="text-align: center;" value="<?= 'shift_' . $i ?>">
                                                    </div>
                                                    <div id="<?= 'collapse_dtl_c_' . $i ?>" class="collapse" aria-labelledby="<?= 'heading_dtl_c_' . $i ?>" data-parent="#accordion_dtl_c">
                                                        <div class="card-body">
                                                            <strong>Raw Water (M³)</strong>
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_rw_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead id="<?= 'thead_dtl_c_rw_' . $i ?>" class="table-warning">
                                                                        <tr>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="12">Sedimen</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="2">Cone clarifier</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">A1 (1898)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">A2 (1998)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">A3 (1887)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">A4 (1963)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">A5 (2106)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">A6 (2015)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">B1 (1909)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">B2 (1900)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">B3 (1900)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">B4 (1752)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">B5 (1357)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">B6 (1632)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1 - 2 (600)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">3 - 4 (600)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="<?= 'tbody_dtl_c_rw_' . $i ?>">
                                                                        <?php if (!empty($dtdetail_c)) {
                                                                            foreach ($dtdetail_c as $dtdetail_c_row_rw) {
                                                                                if ($dtdetail_c_row_rw->shift == 'shift_' . $i) { ?>
                                                                                    <tr>
                                                                                        <input type="hidden" name="dtl_c_detail_id[]" id="dtl_c_detail_id" class="form-control w-auto dtl_c_detail_id" style="text-align: center;" value="<?= $dtdetail_c_row_rw->detail_id ?>">

                                                                                        <td align="center"><input type="text" name="dtl_c_rw_sedimen_a1[]" id="dtl_c_rw_sedimen_a1" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_a1" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_sedimen_a1 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_sedimen_a2[]" id="dtl_c_rw_sedimen_a2" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_a2" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_sedimen_a2 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_sedimen_a3[]" id="dtl_c_rw_sedimen_a3" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_a3" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_sedimen_a3 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_sedimen_a4[]" id="dtl_c_rw_sedimen_a4" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_a4" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_sedimen_a4 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_sedimen_a5[]" id="dtl_c_rw_sedimen_a5" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_a5" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_sedimen_a5 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_sedimen_a6[]" id="dtl_c_rw_sedimen_a6" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_a6" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_sedimen_a6 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_sedimen_b1[]" id="dtl_c_rw_sedimen_b1" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_b1" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_sedimen_b1 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_sedimen_b2[]" id="dtl_c_rw_sedimen_b2" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_b2" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_sedimen_b2 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_sedimen_b3[]" id="dtl_c_rw_sedimen_b3" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_b3" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_sedimen_b3 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_sedimen_b4[]" id="dtl_c_rw_sedimen_b4" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_b4" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_sedimen_b4 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_sedimen_b5[]" id="dtl_c_rw_sedimen_b5" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_b5" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_sedimen_b5 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_sedimen_b6[]" id="dtl_c_rw_sedimen_b6" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_b6" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_sedimen_b6 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_cone_clarifier_1_2[]" id="dtl_c_rw_cone_clarifier_1_2" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_cone_clarifier_1_2" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_cone_clarifier_1_2 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_rw_cone_clarifier_3_4[]" id="dtl_c_rw_cone_clarifier_3_4" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_cone_clarifier_3_4" style="text-align: center;" value="<?= $dtdetail_c_row_rw->rw_cone_clarifier_3_4 ?>"></td>
                                                                                    </tr>
                                                                            <?php }
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_sedimen_a1[]" id="dtl_c_rw_sedimen_a1" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_a1" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_sedimen_a2[]" id="dtl_c_rw_sedimen_a2" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_a2" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_sedimen_a3[]" id="dtl_c_rw_sedimen_a3" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_a3" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_sedimen_a4[]" id="dtl_c_rw_sedimen_a4" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_a4" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_sedimen_a5[]" id="dtl_c_rw_sedimen_a5" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_a5" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_sedimen_a6[]" id="dtl_c_rw_sedimen_a6" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_a6" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_sedimen_b1[]" id="dtl_c_rw_sedimen_b1" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_b1" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_sedimen_b2[]" id="dtl_c_rw_sedimen_b2" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_b2" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_sedimen_b3[]" id="dtl_c_rw_sedimen_b3" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_b3" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_sedimen_b4[]" id="dtl_c_rw_sedimen_b4" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_b4" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_sedimen_b5[]" id="dtl_c_rw_sedimen_b5" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_b5" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_sedimen_b6[]" id="dtl_c_rw_sedimen_b6" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_sedimen_b6" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_cone_clarifier_1_2[]" id="dtl_c_rw_cone_clarifier_1_2" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_cone_clarifier_1_2" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_rw_cone_clarifier_3_4[]" id="dtl_c_rw_cone_clarifier_3_4" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_rw_cone_clarifier_3_4" style="text-align: center;" value=""></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td class="table-warning align-middle text-center" colspan="40" align="center"></td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                            <hr>
                                                            <strong>BSF (M³)</strong>
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_bsf_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead id="<?= 'thead_dtl_c_bsf_' . $i ?>" class="table-warning">
                                                                        <tr>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="2">Sedimen</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="3">Bak</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">C1 (BY FM)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">C2 (1215)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">V-Notch (120)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Recycle (200)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">CW (180)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="<?= 'tbody_dtl_c_bsf_' . $i ?>">
                                                                        <?php if (!empty($dtdetail_c)) {
                                                                            foreach ($dtdetail_c as $dtdetail_c_row_bsf) {
                                                                                if ($dtdetail_c_row_bsf->shift == 'shift_' . $i) { ?>
                                                                                    <tr>
                                                                                        <td align="center"><input type="text" name="dtl_c_bsf_sedimen_c1[]" id="dtl_c_bsf_sedimen_c1" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_bsf_sedimen_c1" style="text-align: center;" value="<?= $dtdetail_c_row_bsf->bsf_sedimen_c1 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_bsf_sedimen_c2[]" id="dtl_c_bsf_sedimen_c2" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_bsf_sedimen_c2" style="text-align: center;" value="<?= $dtdetail_c_row_bsf->bsf_sedimen_c2 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_bsf_bak_v_notch[]" id="dtl_c_bsf_bak_v_notch" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_bsf_bak_v_notch" style="text-align: center;" value="<?= $dtdetail_c_row_bsf->bsf_bak_v_notch ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_bsf_bak_reyclce[]" id="dtl_c_bsf_bak_reyclce" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_bsf_bak_reyclce" style="text-align: center;" value="<?= $dtdetail_c_row_bsf->bsf_bak_reyclce ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_bsf_bak_cw[]" id="dtl_c_bsf_bak_cw" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_bsf_bak_cw" style="text-align: center;" value="<?= $dtdetail_c_row_bsf->bsf_bak_cw ?>"></td>
                                                                                    </tr>
                                                                            <?php }
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td align="center"><input type="text" name="dtl_c_bsf_sedimen_c1[]" id="dtl_c_bsf_sedimen_c1" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_bsf_sedimen_c1" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_bsf_sedimen_c2[]" id="dtl_c_bsf_sedimen_c2" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_bsf_sedimen_c2" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_bsf_bak_v_notch[]" id="dtl_c_bsf_bak_v_notch" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_bsf_bak_v_notch" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_bsf_bak_reyclce[]" id="dtl_c_bsf_bak_reyclce" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_bsf_bak_reyclce" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_bsf_bak_cw[]" id="dtl_c_bsf_bak_cw" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_bsf_bak_cw" style="text-align: center;" value=""></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td class="table-warning align-middle text-center" colspan="40" align="center"></td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                            <hr>
                                                            <strong>After Sand Filter (M³)</strong>
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_asf_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead id="<?= 'thead_dtl_c_asf_' . $i ?>" class="table-warning">
                                                                        <tr>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">ASF A (300)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">ASF B (175)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">ASF 1A (350)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">ASF 1B (94)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Bak 2 (200)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Bak 3 (180)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Tower TBN (50)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Tower Mess (50)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="<?= 'tbody_dtl_c_asf_' . $i ?>">
                                                                        <?php if (!empty($dtdetail_c)) {
                                                                            foreach ($dtdetail_c as $dtdetail_c_row_asf) {
                                                                                if ($dtdetail_c_row_asf->shift == 'shift_' . $i) { ?>
                                                                                    <tr>
                                                                                        <td align="center"><input type="text" name="dtl_c_asf_asf_a[]" id="dtl_c_asf_asf_a" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_asf_a" style="text-align: center;" value="<?= $dtdetail_c_row_asf->asf_asf_a ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_asf_asf_b[]" id="dtl_c_asf_asf_b" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_asf_b" style="text-align: center;" value="<?= $dtdetail_c_row_asf->asf_asf_b ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_asf_asf_1a[]" id="dtl_c_asf_asf_1a" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_asf_1a" style="text-align: center;" value="<?= $dtdetail_c_row_asf->asf_asf_1a ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_asf_asf_1b[]" id="dtl_c_asf_asf_1b" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_asf_1b" style="text-align: center;" value="<?= $dtdetail_c_row_asf->asf_asf_1b ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_asf_bak_2[]" id="dtl_c_asf_bak_2" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_bak_2" style="text-align: center;" value="<?= $dtdetail_c_row_asf->asf_bak_2 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_asf_bak_3[]" id="dtl_c_asf_bak_3" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_bak_3" style="text-align: center;" value="<?= $dtdetail_c_row_asf->asf_bak_3 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_asf_tower_tbn[]" id="dtl_c_asf_tower_tbn" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_tower_tbn" style="text-align: center;" value="<?= $dtdetail_c_row_asf->asf_tower_tbn ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_asf_tower_mess[]" id="dtl_c_asf_tower_mess" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_tower_mess" style="text-align: center;" value="<?= $dtdetail_c_row_asf->asf_tower_mess ?>"></td>
                                                                                    </tr>
                                                                            <?php }
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td align="center"><input type="text" name="dtl_c_asf_asf_a[]" id="dtl_c_asf_asf_a" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_asf_a" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_asf_asf_b[]" id="dtl_c_asf_asf_b" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_asf_b" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_asf_asf_1a[]" id="dtl_c_asf_asf_1a" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_asf_1a" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_asf_asf_1b[]" id="dtl_c_asf_asf_1b" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_asf_1b" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_asf_bak_2[]" id="dtl_c_asf_bak_2" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_bak_2" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_asf_bak_3[]" id="dtl_c_asf_bak_3" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_bak_3" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_asf_tower_tbn[]" id="dtl_c_asf_tower_tbn" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_tower_tbn" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_asf_tower_mess[]" id="dtl_c_asf_tower_mess" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_asf_tower_mess" style="text-align: center;" value=""></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td class="table-warning align-middle text-center" colspan="40" align="center"></td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                            <hr>
                                                            <strong>ACF (M³)</strong>
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_acf_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead id="<?= 'thead_dtl_c_acf_' . $i ?>" class="table-warning">
                                                                        <tr>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">ACF A (150)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">ACF B (165)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Bak IV (180)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Bak CIP 1 (180)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Bak CIP 2 (90)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="<?= 'tbody_dtl_c_acf_' . $i ?>">
                                                                        <?php if (!empty($dtdetail_c)) {
                                                                            foreach ($dtdetail_c as $dtdetail_c_row_acf) {
                                                                                if ($dtdetail_c_row_acf->shift == 'shift_' . $i) { ?>
                                                                                    <tr>
                                                                                        <td align="center"><input type="text" name="dtl_c_acf_acf_a[]" id="dtl_c_acf_acf_a" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_acf_acf_a" style="text-align: center;" value="<?= $dtdetail_c_row_acf->acf_acf_a ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_acf_acf_b[]" id="dtl_c_acf_acf_b" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_acf_acf_b" style="text-align: center;" value="<?= $dtdetail_c_row_acf->acf_acf_b ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_acf_bak_iv[]" id="dtl_c_acf_bak_iv" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_acf_bak_iv" style="text-align: center;" value="<?= $dtdetail_c_row_acf->acf_bak_iv ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_acf_bak_cip_1[]" id="dtl_c_acf_bak_cip_1" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_acf_bak_cip_1" style="text-align: center;" value="<?= $dtdetail_c_row_acf->acf_bak_cip_1 ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_acf_bak_cip_2[]" id="dtl_c_acf_bak_cip_2" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_acf_bak_cip_2" style="text-align: center;" value="<?= $dtdetail_c_row_acf->acf_bak_cip_2 ?>"></td>
                                                                                    </tr>
                                                                            <?php }
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td align="center"><input type="text" name="dtl_c_acf_acf_a[]" id="dtl_c_acf_acf_a" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_acf_acf_a" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_acf_acf_b[]" id="dtl_c_acf_acf_b" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_acf_acf_b" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_acf_bak_iv[]" id="dtl_c_acf_bak_iv" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_acf_bak_iv" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_acf_bak_cip_1[]" id="dtl_c_acf_bak_cip_1" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_acf_bak_cip_1" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_acf_bak_cip_2[]" id="dtl_c_acf_bak_cip_2" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_acf_bak_cip_2" style="text-align: center;" value=""></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td class="table-warning align-middle text-center" colspan="40" align="center"></td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                            <hr>
                                                            <strong>AST (M³)</strong>
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_ast_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead id="<?= 'thead_dtl_c_ast_' . $i ?>" class="table-warning">
                                                                        <tr>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">AST (150)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Bak Demin (90)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Tangki ST Mes (20)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="<?= 'tbody_dtl_c_ast_' . $i ?>">
                                                                        <?php if (!empty($dtdetail_c)) {
                                                                            foreach ($dtdetail_c as $dtdetail_c_row_ast) {
                                                                                if ($dtdetail_c_row_ast->shift == 'shift_' . $i) { ?>
                                                                                    <tr>
                                                                                        <td align="center"><input type="text" name="dtl_c_ast_ast[]" id="dtl_c_ast_ast" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_ast_ast" style="text-align: center;" value="<?= $dtdetail_c_row_ast->ast_ast ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_ast_bak_demin[]" id="dtl_c_ast_bak_demin" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_ast_bak_demin" style="text-align: center;" value="<?= $dtdetail_c_row_ast->ast_bak_demin ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_ast_tangki_st_mes[]" id="dtl_c_ast_tangki_st_mes" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_ast_tangki_st_mes" style="text-align: center;" value="<?= $dtdetail_c_row_ast->ast_tangki_st_mes ?>"></td>
                                                                                    </tr>
                                                                            <?php }
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td align="center"><input type="text" name="dtl_c_ast_ast[]" id="dtl_c_ast_ast" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_ast_ast" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_ast_bak_demin[]" id="dtl_c_ast_bak_demin" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_ast_bak_demin" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_ast_tangki_st_mes[]" id="dtl_c_ast_tangki_st_mes" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_ast_tangki_st_mes" style="text-align: center;" value=""></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td class="table-warning align-middle text-center" colspan="40" align="center"></td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                            <hr>
                                                            <strong>ARO (M³)</strong>
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_aro_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead id="<?= 'thead_dtl_c_aro_' . $i ?>" class="table-warning">
                                                                        <tr>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Tangki RO Mes (10)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Tangki RO (60)</th>
                                                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">RO WTP (75)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="<?= 'tbody_dtl_c_aro_' . $i ?>">
                                                                        <?php if (!empty($dtdetail_c)) {
                                                                            foreach ($dtdetail_c as $dtdetail_c_row_aro) {
                                                                                if ($dtdetail_c_row_aro->shift == 'shift_' . $i) { ?>
                                                                                    <tr>
                                                                                        <td align="center"><input type="text" name="dtl_c_aro_tangki_ro_mes[]" id="dtl_c_aro_tangki_ro_mes" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_aro_tangki_ro_mes" style="text-align: center;" value="<?= $dtdetail_c_row_aro->aro_tangki_ro_mes ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_aro_tangki_ro[]" id="dtl_c_aro_tangki_ro" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_aro_tangki_ro" style="text-align: center;" value="<?= $dtdetail_c_row_aro->aro_tangki_ro ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_aro_ro_wtp[]" id="dtl_c_aro_ro_wtp" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_aro_ro_wtp" style="text-align: center;" value="<?= $dtdetail_c_row_aro->aro_ro_wtp ?>"></td>
                                                                                    </tr>
                                                                            <?php }
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td align="center"><input type="text" name="dtl_c_aro_tangki_ro_mes[]" id="dtl_c_aro_tangki_ro_mes" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_aro_tangki_ro_mes" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_aro_tangki_ro[]" id="dtl_c_aro_tangki_ro" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_aro_tangki_ro" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_aro_ro_wtp[]" id="dtl_c_aro_ro_wtp" class="form-control angkadantitik w-auto <?= 'required_shift_' . $i ?> dtl_c_aro_ro_wtp" style="text-align: center;" value=""></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td class="table-warning align-middle text-center" colspan="40" align="center"></td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php $this->load->view('laporan/V_laporan_definisi'); ?>
                            <hr>

                            <!-- <div class="row mt-1">
                                <div class="col-12">
                                    <div class="card collapse-icon accordion-icon-rotate">
                                        <div class="accordion" id="accordion_dtl_d">
                                            <div class="collapse-margin">
                                                <div class="card-header bg-gradient-danger" id="heading_dtlc_d" data-toggle="collapse" role="button" data-target="#collapse_dtlc_d" aria-expanded="false" aria-controls="collapse_dtlc_d">
                                                    <strong>Drain</strong>
                                                </div>
                                                <div id="collapse_dtlc_d" class="collapse" aria-labelledby="heading_dtlc_d" data-parent="#accordion_dtl_d">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="table-danger align-middle text-center">✓</th>
                                                                        <th class="table-danger align-middle text-center">Shift</th>
                                                                        <th class="table-danger align-middle text-center">Jika ada drain</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody4">
                                                                    <?php if (!empty($dtdetail_d)) {
                                                                        foreach ($dtdetail_d as $dtdetail_d_row) { ?>
                                                                            <tr>
                                                                                <input type="hidden" name="dtl_d_detail_id[]" id="dtl_d_detail_id" class="form-control dtl_detail_id_b" style="text-align: center;" value="<?= $dtdetail_d_row->detail_id ?>">
                                                                                <td><input name="dtl_d_chk[]" type="checkbox" value="<?= $dtdetail_d_row->shift . ' ' . $dtdetail_d_row->detail_id ?>"></td>
                                                                                <td><select name="dtl_d_shift[]" class="form-control dtl_d_shift" id="dtl_d_shift">
                                                                                        <option value="">- pilih -</option>
                                                                                        <option value="shift_1" <?= $dtdetail_d_row->shift == "shift_1" ? "selected" : ""  ?>>Shift 1</option>
                                                                                        <option value="shift_2" <?= $dtdetail_d_row->shift == "shift_2" ? "selected" : ""  ?>>Shift 2</option>
                                                                                        <option value="shift_3" <?= $dtdetail_d_row->shift == "shift_3" ? "selected" : ""  ?>>Shift 3</option>
                                                                                    </select></td>
                                                                                <td align="center"><input type="text" name="dtl_d_drain[]" id="dtl_d_drain" class="form-control dtl_d_drain" style <?= 'required_shift_' . $i ?>="text-align: left;" value="<?= $dtdetail_d_row->drain ?>"></td>
                                                                            </tr>
                                                                        <?php }
                                                                    } else { ?>
                                                                        <tr>
                                                                            <td><input name="dtl_d_chk[]" type="checkbox" value=""></td>
                                                                            <td><select name="dtl_d_shift[]" class="form-control dtl_d_shift" id="dtl_d_shift">
                                                                                    <option value="">- pilih -</option>
                                                                                    <option value="shift_1">Shift 1</option>
                                                                                    <option value="shift_2">Shift 2</option>
                                                                                    <option value="shift_3">Shift 3</option>
                                                                                </select></td>
                                                                            <td align="center"><input type="text" name="dtl_d_drain[]" id="dtl_d_drain" class="form-control dtl_d_drain" style <?= 'required_shift_' . $i ?>="text-align: left;" value=""></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td class="table-danger align-middle text-center" colspan="9" align="center">
                                                                            <?php if (!!empty($dtdetail_d)) {
                                                                                if ($akses_create == '1') { ?>
                                                                                    <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody4')">Tambah
                                                                                        Baris</button>
                                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody4')">Hapus
                                                                                        Baris</button>
                                                                                <?php } else {/*No Acess Create*/
                                                                                }
                                                                            } else {
                                                                                if ($akses_update == '1') { ?>
                                                                                    <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody4')">Tambah
                                                                                        Baris</button>
                                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody4')">Hapus
                                                                                        Baris</button>
                                                                                <?php } else {/*No Acess Update*/
                                                                                }
                                                                                if ($akses_delete == '1') { ?>
                                                                                    <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete_dtl_d" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus
                                                                                        Data</button>
                                                                            <?php } else {/*No Acess Delete*/
                                                                                }
                                                                            } ?>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <hr> -->
                            <br>

                            <div class="row mt-1">
                                <div class="col-12">
                                    <?php if (!isset($dtheader)) {
                                        if ($akses_create == '1') { ?>
                                            <button type="submit" class="btn bg-gradient-primary" id="btnsimpan"><i class="feather icon-save"></i> Simpan <?= $page_shift ?></button>
                                            <button type="reset" class="btn bg-gradient-light"><i class="feather icon-refresh-ccw"></i> Batal</button>
                                        <?php } else {/*No Acess Create*/
                                        }
                                    } else {
                                        // tombol sesuaikan dengan halaman shift
                                        if ($akses_update == '1' && $page_shift != 'Shift Komplit') {
                                            $sf = 'sf' . explode(" ", $page_shift)[1]; ?>
                                            <button type="submit" class="btn bg-gradient-primary" name="btnproses" value="btnupdate_<?= $sf ?>" onclick="return confirm('Simpan Data ?')"><i class="feather icon-save"></i> Simpan <?= $page_shift ?></button>
                                            <button type="submit" class="btn bg-gradient-info" name="btnproses" value="btncomplete_<?= $sf ?>" onclick="return confirm('Komplit Data ?')"><i class="feather icon-check-square"></i> Komplit <?= $page_shift ?></button>
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
                                    <span class="pull-right"><?= $frmnm . '-' . $frmvrs; ?></span>
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

        $('form').submit(function() {
            var input_headerid = $('#headerid').val();
            if (typeof(input_headerid) == "undefined") {
                $(this).find("button[type='submit']").prop('disabled', true);
            }
        });

        $('.angkasaja').mask("0000", {
            placeholder: "0"
        });

        $(document).on('keyup', '.angkadantitik', function() {
            this.value = this.value.replace(/[^\d.]|\.(?=.*\.)/g, '');
        });

        if (typeof($('#headerid').val()) != "undefined") {
            $('.dtopen_blok').prop('readonly', true);
            $('.dtopen_blok2 > option').each(function() {
                if (!this.selected) {
                    $(this).attr('disabled', true);
                }
            });
        }

        function alert_req_hdr() {
            notif_btnconfirm_custom('error', 'Silahkan lengkapi header dahulu!!!');
        }

        function get_docno() {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            if (typeof(input_headerid) == "undefined" && create_date != '') {

                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss315_15/get_docno/frmfss315/15",
                    dataType: "json",
                    data: {
                        create_date,
                    },
                    success: function(result) {
                        if (result.status == true) {
                            $('.docno').val(result.data);
                        }
                    }
                });

                get_item();
            }
        }

        function get_item() {
            let input_headerid = $(".headerid").val();
            let create_date = $('.create_date').val();

            if (typeof(input_headerid) == "undefined" && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss315_15/get_list_item/frmfss315/15",
                    dataType: "json",
                    data: {
                        create_date
                    },
                    success: function(result) {
                        if (result.status == true) {
                            // ambil data kemrain di tabel Proses Raw Water & Cone
                            $.each(result.data_raw[0], function(dtl_a_key, dtl_a_val) {
                                let col_dtl_a_awal = dtl_a_key.replace('akhir', 'awal');
                                $('.required_shift_1').closest('tr').find('.dtl_a_' + col_dtl_a_awal).val(dtl_a_val);
                            });
                            // ambil item bahan_kimia
                            for (let i = 1; i <= 3; i++) {
                                let list_dtl_b = '';

                                $.each(result.data, function(dtl_b_key, dtl_b_val) {
                                    let dtl_b_td2 = `<td align="center"><input type="text" name="dtl_b_baku_terima[]" id="dtl_b_baku_terima" class="form-control angkadantitik w-auto required_shift_` + i + ` dtl_b_baku_terima dtl_b_cari_stok" style="text-align: center;" value="" ` + (i > 1 ? `readonly` : ``) + `></td>
                                                    <td align="center"><input type="text" name="dtl_b_baku_pakai[]" id="dtl_b_baku_pakai" class="form-control angkadantitik w-auto required_shift_` + i + ` dtl_b_baku_pakai dtl_b_cari_stok" style="text-align: center;" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_b_baku_stok[]" id="dtl_b_baku_stok" class="form-control angkadantitik w-auto required_shift_` + i + ` dtl_b_baku_stok" style="text-align: center;" value="" readonly></td>
                                                    <td align="center"><input type="text" name="dtl_b_larutan_terima[]" id="dtl_b_larutan_terima" class="form-control angkadantitik w-auto required_shift_` + i + ` dtl_b_larutan_terima dtl_b2_cari_stok" style="text-align: center;" value="" ` + (i > 1 ? `readonly` : ``) + `></td>
                                                    <td align="center"><input type="text" name="dtl_b_larutan_pakai[]" id="dtl_b_larutan_pakai" class="form-control angkadantitik w-auto required_shift_` + i + ` dtl_b_larutan_pakai" style="text-align: center;" value=""></td>
                                                    <td align="center"><input type="text" name="dtl_b_larutan_stok[]" id="dtl_b_larutan_stok" class="form-control angkadantitik w-auto required_shift_` + i + ` dtl_b_larutan_stok dtl_b2_cari_stok" style="text-align: center;" value=""></td>`;

                                    if (dtl_b_val.children) {
                                        $.each(dtl_b_val.children, function(dtl_b_key2, dtl_b_val2) {
                                            let dtl_b_td = '';

                                            if (dtl_b_key2 == 0) {
                                                dtl_b_td = `<td align="center" rowspan="` + dtl_b_val.children.length + `">
                                                        ` + dtl_b_val.item1 + `
                                                    </td>`;
                                            }

                                            list_dtl_b += `<tr>
                                                            ` + dtl_b_td + `
                                                            <td align="center">
                                                                <input type="hidden" name="dtl_b_shift[]" id="dtl_b_shift" class="form-control w-auto dtl_b_shift dtl_b_shift_` + i + `_` + dtl_b_val.detail_id + `_` + dtl_b_val2.detail_id_b + `" style="text-align: center;" value="shift_` + i + `">
                                                                <input type="hidden" name="dtl_b_id_item1[]" id="dtl_b_id_item1" class="form-control w-auto dtl_b_id_item1" style="text-align: center;" value="` + dtl_b_val.detail_id + `">
                                                                <input type="hidden" name="dtl_b_val_item1[]" id="dtl_b_val_item1" class="form-control w-auto dtl_b_val_item1" style="text-align: center;" value="` + dtl_b_val.item1 + `">
                                                                <input type="hidden" name="dtl_b_id_item2[]" id="dtl_b_id_item2" class="form-control w-auto dtl_b_id_item2" style="text-align: center;" value="` + dtl_b_val2.detail_id_b + `">
                                                                <input type="hidden" name="dtl_b_val_item2[]" id="dtl_b_val_item2" class="form-control w-auto dtl_b_val_item2" style="text-align: center;" value="` + dtl_b_val2.item2 + `">
                                                                <input type="hidden" name="dtl_b_val_spek2[]" id="dtl_b_val_spek2" class="form-control w-auto dtl_b_val_spek2" style="text-align: center;" value="` + dtl_b_val2.spek2 + `">
                                                                ` + dtl_b_val2.item2 + ` ` + dtl_b_val2.spek2 + `
                                                            </td>
                                                            ` + dtl_b_td2 + `
                                                        </tr>`;
                                        });
                                    } else {
                                        list_dtl_b += `<tr>
                                                        <td align="center" colspan="2">
                                                            <input type="hidden" name="dtl_b_shift[]" id="dtl_b_shift" class="form-control w-auto dtl_b_shift dtl_b_shift_` + i + `_` + dtl_b_val.detail_id + `_" style="text-align: center;" value="shift_` + i + `">
                                                            <input type="hidden" name="dtl_b_id_item1[]" id="dtl_b_id_item1" class="form-control w-auto dtl_b_id_item1" style="text-align: center;" value="` + dtl_b_val.detail_id + `">
                                                            <input type="hidden" name="dtl_b_val_item1[]" id="dtl_b_val_item1" class="form-control w-auto dtl_b_val_item1" style="text-align: center;" value="` + dtl_b_val.item1 + `">
                                                            <input type="hidden" name="dtl_b_id_item2[]" id="dtl_b_id_item2" class="form-control w-auto dtl_b_id_item2" style="text-align: center;" value="">
                                                            <input type="hidden" name="dtl_b_val_item2[]" id="dtl_b_val_item2" class="form-control w-auto dtl_b_val_item2" style="text-align: center;" value="">
                                                            <input type="hidden" name="dtl_b_val_spek2[]" id="dtl_b_val_spek2" class="form-control w-auto dtl_b_val_spek2" style="text-align: center;" value="` + dtl_b_val.spek1 + `">
                                                            ` + dtl_b_val.item1 + ` ` + dtl_b_val.spek1 + `
                                                        </td>
                                                        ` + dtl_b_td2 + `
                                                    </tr>`;
                                    }
                                });

                                $('#tbody_dtl_b_' + i).empty().append(list_dtl_b);
                                input_required();
                            }
                            // ambil data kemrain di tabel Bahan Kimia
                            for (let i = 0; i < result.data_kimia.length; i++) {
                                $.each(result.data_kimia[0], function(dtl_b_key, dtl_b_val) {
                                    let col_dtl_b_terima = dtl_b_key.replace('stok', 'terima');

                                    let id_item1 = result.data_kimia[i].id_item1 == null ? "" : result.data_kimia[i].id_item1;
                                    let id_item2 = result.data_kimia[i].id_item2 == null ? "" : result.data_kimia[i].id_item2;
                                    if (col_dtl_b_terima == 'baku_terima') {
                                        $('.dtl_b_shift_1_' + id_item1 + '_' + id_item2).closest('tr').find('.dtl_b_' + col_dtl_b_terima).val(result.data_kimia[i].baku_stok);
                                    }
                                    if (col_dtl_b_terima == 'larutan_terima') {
                                        $('.dtl_b_shift_1_' + id_item1 + '_' + id_item2).closest('tr').find('.dtl_b_' + col_dtl_b_terima).val(result.data_kimia[i].larutan_stok);
                                    }
                                });


                            }
                        }
                        notif_btnconfirm_custom(result.vstatus, result.pesan);
                    }
                });

            }
        }

        get_docno();

        $('.create_date').change(function() {
            get_docno();
        });







        // detail a 
        $(document).on('change', '.dtl_a_cari_total', function() {
            let cari_total_id = $(this).attr('id');
            let cari_total_key = cari_total_id.replace('fm_awal', '').replace('fm_akhir', '');

            let shift = $(this).closest('tr').find('.dtl_a_shift').val().replace('shift_', '');
            let fm_awal = $(this).closest('tr').find('.' + cari_total_key + 'fm_awal').val();
            let fm_akhir = $(this).closest('tr').find('.' + cari_total_key + 'fm_akhir').val();
            // console.log(shift)
            if (fm_awal.length && fm_akhir.length) {
                let fm_total = parseFloat(fm_akhir) - parseFloat(fm_awal);

                if (fm_total >= 0) {
                    $(this).closest('tr').find('.' + cari_total_key + 'total').val(fm_total.toFixed(1));
                } else {
                    $(this).closest('tr').find('.' + cari_total_key + 'fm_akhir').val(fm_awal).focus();
                    $(this).closest('tr').find('.' + cari_total_key + 'total').val(0);
                    notif_btnconfirm_custom("error", "Nilai tidak valid!");
                }
                $('.required_shift_' + (parseFloat(shift) + 1)).closest('tr').find('.' + cari_total_key + 'fm_awal').val(fm_akhir).trigger('change');
            }
        });
        // end detail a 

        // detail b 
        $(document).on('change', '.dtl_b_cari_stok', function() {
            let dtl_b_cari_stok_id = $(this).attr('id');
            let dtl_b_cari_stok_key = dtl_b_cari_stok_id.replace('terima', '').replace('pakai', '');

            let shift = $(this).closest('tr').find('.dtl_b_shift').val().replace('shift_', '');
            let id_item1 = $(this).closest('tr').find('.dtl_b_id_item1').val();
            let id_item2 = $(this).closest('tr').find('.dtl_b_id_item2').val();
            let terima = $(this).closest('tr').find('.' + dtl_b_cari_stok_key + 'terima').val();
            let pakai = $(this).closest('tr').find('.' + dtl_b_cari_stok_key + 'pakai').val();

            if (terima.length && pakai.length) {
                let stok = parseFloat(terima) - parseFloat(pakai);

                if (stok >= 0) {
                    $(this).closest('tr').find('.' + dtl_b_cari_stok_key + 'stok').val(stok.toFixed(1));
                } else {
                    $(this).closest('tr').find('.' + dtl_b_cari_stok_key + 'pakai').val(stok = 0).focus();
                    $(this).closest('tr').find('.' + dtl_b_cari_stok_key + 'stok').val(terima);
                    notif_btnconfirm_custom("error", "Nilai tidak valid!");
                }

                // nilai stok dilanjut ke shift berikutnya
                $('.dtl_b_shift_' + (parseFloat(shift) + 1) + '_' + id_item1 + '_' + id_item2).closest('tr').find('.' + dtl_b_cari_stok_key + 'terima').val(stok).trigger('change');
            }
        });

        $(document).on('change', '.dtl_b2_cari_stok', function() {
            let dtl_b2_cari_stok_id = $(this).attr('id');
            let dtl_b2_cari_stok_key = dtl_b2_cari_stok_id.replace('terima', '').replace('stok', '');

            let shift = $(this).closest('tr').find('.dtl_b_shift').val().replace('shift_', '');
            let id_item1 = $(this).closest('tr').find('.dtl_b_id_item1').val();
            let id_item2 = $(this).closest('tr').find('.dtl_b_id_item2').val();

            let terima = $(this).closest('tr').find('.' + dtl_b2_cari_stok_key + 'terima').val();
            let stok = $(this).closest('tr').find('.' + dtl_b2_cari_stok_key + 'stok').val();

            let dtl_b_cari_stok_id = $('.dtl_b_cari_stok').attr('id');
            let dtl_b_cari_stok_key = dtl_b_cari_stok_id.replace('terima', '').replace('pakai', '');
            let pakai_kimia = $(this).closest('tr').find('.' + dtl_b_cari_stok_key + 'pakai').val();

            let dtl_b2_cari_stok_spek = $(this).closest('tr').find('.dtl_b_val_spek2').val().replace('(', '').replace(')', '').replace('%', '');
            let dtl_b2_cari_stok_persen = parseFloat(dtl_b2_cari_stok_spek) / 100;

            if (terima.length && stok.length && pakai_kimia.length) {
                if (dtl_b2_cari_stok_spek.length) {
                    let pakai = (parseFloat(terima) + (parseFloat(pakai_kimia) / parseFloat(dtl_b2_cari_stok_persen)) - parseFloat(stok));

                    if (pakai >= 0) {
                        $(this).closest('tr').find('.' + dtl_b2_cari_stok_key + 'pakai').val(pakai.toFixed(1));
                    } else {
                        $(this).closest('tr').find('.' + dtl_b2_cari_stok_key + 'terima').val(pakai = 0).focus();
                        $(this).closest('tr').find('.' + dtl_b2_cari_stok_key + 'pakai').val(stok);
                        notif_btnconfirm_custom("error", "Nilai tidak valid!");
                    }

                    // nilai stok dilanjut ke shift berikutnya
                    $('.dtl_b_shift_' + (parseFloat(shift) + 1) + '_' + id_item1 + '_' + id_item2).closest('tr').find('.' + dtl_b2_cari_stok_key + 'terima').val(stok).trigger('change');
                }
            }
        });
        // end detail b 

        // info halaman per shift
        info_laman();

        function info_laman() {
            var shift = $('#page_shift').val();

            switch (shift) {
                case 'Shift 1':
                case 'Shift 2':
                case 'Shift 3':
                    toastr.info('Halaman ' + shift, '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    break;

                default:
                    break;
            }

            switch (shift) {
                case 'Shift 2':
                    toastr.success('Shift 1 telah komplit', '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    break;
                case 'Shift 3':
                    toastr.success('Shift 1 telah komplit', '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    toastr.success('Shift 2 telah komplit', '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    break;
                case 'Shift Komplit':
                    toastr.success('Shift 1 telah komplit', '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    toastr.success('Shift 2 telah komplit', '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    toastr.success('Shift 3 telah komplit', '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    break;

                default:
                    break;
            }
        }
        // end info halaman per shift

        // pada sesuai shift required
        input_required();

        function input_required() {
            var shift = $('#page_shift').val();
            // $(".required_shift_" + shift.substr(-1)).prop('required', true);
        }
        // end pada sesuai shift required

    });
</script>

<?php $this->load->view('template/footbarend'); ?>