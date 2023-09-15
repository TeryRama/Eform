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
        $headerid                           = $dtheader_row->headerid;

        $comment                            = $dtheader_row->comment;
        $comment_by                         = $dtheader_row->comment_by;
        $comment_time                       = $dtheader_row->comment_time;
        $comment_date                       = date("d-m-Y", strtotime($dtheader_row->comment_date));

        $create_date                        = date("d-m-Y", strtotime($dtheader_row->create_date));
        $docno                              = $dtheader_row->docno;
        $date_before                        = date("m-Y", strtotime($dtheader_row->date_before . '-01'));
        $date_today                         = date("m-Y", strtotime($dtheader_row->date_today . '-01'));
        $date_next                          = date("m-Y", strtotime($dtheader_row->date_next . '-01'));

        $dtsampel_frmfss317_headerid        = $dtheader_row->dtsampel_frmfss317_headerid;
        $dtsampel_frmfss317_complete_date   = $dtheader_row->dtsampel_frmfss317_complete_date;
        $dtsampel_frmfss317_complete_time   = $dtheader_row->dtsampel_frmfss317_complete_time;
    }
} else if (isset($message)) {
    $aksi                               = "dtsave";

    $create_date                        = $dtcreate_date;
    $docno                              = $dtdocno;
    $date_before                        = $dtdate_before;
    $date_today                         = $dtdate_today;
    $date_next                          = $dtdate_next;

    $dtsampel_frmfss317_headerid        = '';
    $dtsampel_frmfss317_complete_date   = '';
    $dtsampel_frmfss317_complete_time   = '';
} else {
    $aksi                               = "dtsave";
    $create_date                        = date("d-m-Y", strtotime($dtcreate_date));;
    $docno                              = '';
    $date_before                        = '';
    $date_today                         = '';
    $date_next                          = '';

    $dtsampel_frmfss317_headerid        = '';
    $dtsampel_frmfss317_complete_date   = '';
    $dtsampel_frmfss317_complete_time   = '';
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

                        <form action="<?= base_url('form_input/C_formintwtd023_00/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formintwtd023" name="formintwtd023" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
                            <div class="row mb-1">
                                <div class="col-6">

                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?= $headerid; ?>" id="headerid" class="headerid">
                                    <?php } ?>

                                    <input type="hidden" name="dtsampel_frmfss317_headerid" id="dtsampel_frmfss317_headerid" class="form-control dtsampel_frmfss317_headerid" value="<?= $dtsampel_frmfss317_headerid ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss317_complete_date" id="dtsampel_frmfss317_complete_date" class="form-control dtsampel_frmfss317_complete_date" value="<?= $dtsampel_frmfss317_complete_date ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss317_complete_time" id="dtsampel_frmfss317_complete_time" class="form-control dtsampel_frmfss317_complete_time" value="<?= $dtsampel_frmfss317_complete_time ?>" required>

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
                                        <div class="card collapse-icon accordion-icon-rotate">
                                            <div class="accordion" id="accordion_dtl">
                                                <!-- Tabel A 317 -->
                                                <strong>A. Data Bulanan</strong>
                                                <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                                    <table class="table table-bordered">
                                                        <thead class="fixed freeze_vertical">
                                                            <tr>
                                                                <td class="table-primary align-middle text-center" rowspan="2" colspan="1">No.</td>
                                                                <td class="table-primary align-middle text-center" rowspan="2" colspan="1">Uraian</td>
                                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="2"><input type="text" name="date_before" id="date_before" class="form-control maskmonthandyear date_before" style="text-align: center;" value="<?= $date_before; ?>" required></td>
                                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="4"><input type="text" name="date_today" id="date_today" class="form-control maskmonthandyear date_today" style="text-align: center;" value="<?= $date_today; ?>" required></td>
                                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="2"><input type="text" name="date_next" id="date_next" class="form-control maskmonthandyear date_next" style="text-align: center;" value="<?= $date_next; ?>" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">REALISASI</td>
                                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">%</td>
                                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">TARGET</td>
                                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">%</td>
                                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">REALISASI</td>
                                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">%</td>
                                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">TARGET</td>
                                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">%</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody_dtl_a">
                                                            <?php
                                                            $no = 0;
                                                            $no_dis_air = 1;
                                                            $dtl_a_realisai_before_total_akumulatif = 0;
                                                            $dtl_a_realisai_persen_before_total_persen = 0;
                                                            $dtl_a_target_today_total_akumulatif = 0;
                                                            $dtl_a_target_persen_today_total_persen = 0;
                                                            $dtl_a_realisai_today_total_akumulatif = 0;
                                                            $dtl_a_realisai_today_total_persen = 0;
                                                            $dtl_a_target_next_total_akumulatif = 0;
                                                            $dtl_a_target_persen_next_total_persen = 0;

                                                            $dtl_a_2realisai_before_total_all_akumulatif = 0;
                                                            $dtl_a_2realisai_persen_before_total_all_persen = 0;
                                                            $dtl_a_2target_today_total_all_akumulatif = 0;
                                                            $dtl_a_2target_persen_today_total_all_persen = 0;
                                                            $dtl_a_2realisai_today_total_all_akumulatif = 0;
                                                            $dtl_a_2realisai_today_total_all_persen = 0;
                                                            $dtl_a_2target_next_total_all_akumulatif = 0;
                                                            $dtl_a_2target_persen_next_total_all_persen = 0;

                                                            $dtl_a_6realisai_before_total_all_akumulatif = 0;
                                                            $dtl_a_6realisai_persen_before_total_all_persen = 0;
                                                            $dtl_a_6target_today_total_all_akumulatif = 0;
                                                            $dtl_a_6target_persen_today_total_all_persen = 0;
                                                            $dtl_a_6realisai_today_total_all_akumulatif = 0;
                                                            $dtl_a_6realisai_today_total_all_persen = 0;
                                                            $dtl_a_6target_next_total_all_akumulatif = 0;
                                                            $dtl_a_6target_persen_next_total_all_persen = 0;

                                                            $dtl_a_7realisai_before_total_all_akumulatif = 0;
                                                            $dtl_a_7realisai_persen_before_total_all_persen = 0;
                                                            $dtl_a_7target_today_total_all_akumulatif = 0;
                                                            $dtl_a_7target_persen_today_total_all_persen = 0;
                                                            $dtl_a_7realisai_today_total_all_akumulatif = 0;
                                                            $dtl_a_7realisai_today_total_all_persen = 0;
                                                            $dtl_a_7target_next_total_all_akumulatif = 0;
                                                            $dtl_a_7target_persen_next_total_all_persen = 0;

                                                            if (isset($dtdetail)) {
                                                                foreach ($dtdetail as $dtdetail_key => $dtdetail_value) {
                                                                    if ($dtdetail_value->no_urut == 1) {
                                                                        $no++;
                                                                    }
                                                                    $class_item1 = $no . preg_replace('/[.*+?^${}()|[\/]|[ ]|[\d|-]/', '', strtolower($dtdetail_value->dtl_a_definisi_1));
                                                                    $class_item2 = $no . preg_replace('/[.*+?^${}()|[\/]|[ ]|[\d|-]/', '', strtolower($dtdetail_value->dtl_a_definisi_1)) . '_' . preg_replace('/[.*+?^${}()|[\/]|[ ]|[\d|-]/', '', strtolower($dtdetail_value->dtl_a_definisi_2));
                                                                    $class_item3 = $no . preg_replace('/[.*+?^${}()|[\/]|[ ]|[\d|-]/', '', strtolower($dtdetail_value->dtl_a_definisi_1)) . '_' . preg_replace('/[.*+?^${}()|[\/]|[ ]|[\d|-]/', '', strtolower($dtdetail_value->dtl_a_definisi_2)) . '_' . preg_replace('/[.*+?^${}()|[\/]|[ ]|[\d|-]/', '', strtolower($dtdetail_value->dtl_a_definisi_3));

                                                                    // condition item 1
                                                                    if ($dtdetail_value->dtl_a_definisi_1 == 'Biaya Operasional ( Rp )') {
                                                                        $dtl_a_2realisai_before_total_all_akumulatif       += $dtdetail_value->dtl_a_realisai_before;
                                                                        $dtl_a_2realisai_persen_before_total_all_persen    += $dtdetail_value->dtl_a_realisai_persen_before;
                                                                        $dtl_a_2target_today_total_all_akumulatif          += $dtdetail_value->dtl_a_target_today;
                                                                        $dtl_a_2target_persen_today_total_all_persen       += $dtdetail_value->dtl_a_target_persen_today;
                                                                        $dtl_a_2realisai_today_total_all_akumulatif        += $dtdetail_value->dtl_a_realisai_today;
                                                                        $dtl_a_2realisai_today_total_all_persen            += $dtdetail_value->dtl_a_realisai_persen_today;
                                                                        $dtl_a_2target_next_total_all_akumulatif           += $dtdetail_value->dtl_a_target_next;
                                                                        $dtl_a_2target_persen_next_total_all_persen        += $dtdetail_value->dtl_a_target_persen_next;
                                                                        $attr_readonly = '';
                                                                        $value1 = number_format((float)$dtdetail_value->dtl_a_realisai_before, 2, ',', '.');
                                                                        $value2 = number_format((float)$dtdetail_value->dtl_a_target_today, 2, ',', '.');
                                                                        $value3 = number_format((float)$dtdetail_value->dtl_a_realisai_today, 2, ',', '.');
                                                                        $value4 = number_format((float)$dtdetail_value->dtl_a_target_next, 2, ',', '.');
                                                                    } else if ($dtdetail_value->dtl_a_definisi_1 == 'Distribusi Air') {
                                                                        $dtl_a_6realisai_before_total_all_akumulatif       += $dtdetail_value->dtl_a_realisai_before;
                                                                        $dtl_a_6realisai_persen_before_total_all_persen    += $dtdetail_value->dtl_a_realisai_persen_before;
                                                                        $dtl_a_6target_today_total_all_akumulatif          += $dtdetail_value->dtl_a_target_today;
                                                                        $dtl_a_6target_persen_today_total_all_persen       += $dtdetail_value->dtl_a_target_persen_today;
                                                                        $dtl_a_6realisai_today_total_all_akumulatif        += $dtdetail_value->dtl_a_realisai_today;
                                                                        $dtl_a_6realisai_today_total_all_persen            += $dtdetail_value->dtl_a_realisai_persen_today;
                                                                        $dtl_a_6target_next_total_all_akumulatif           += $dtdetail_value->dtl_a_target_next;
                                                                        $dtl_a_6target_persen_next_total_all_persen        += $dtdetail_value->dtl_a_target_persen_next;
                                                                        $attr_readonly = '';
                                                                        $value1 = $dtdetail_value->dtl_a_realisai_before;
                                                                        $value2 = $dtdetail_value->dtl_a_target_today;
                                                                        $value3 = $dtdetail_value->dtl_a_realisai_today;
                                                                        $value4 = $dtdetail_value->dtl_a_target_next;
                                                                    } else if ($dtdetail_value->dtl_a_definisi_1 == 'Tenaga kerja') {
                                                                        $dtl_a_7realisai_before_total_all_akumulatif       += $dtdetail_value->dtl_a_realisai_before;
                                                                        $dtl_a_7realisai_persen_before_total_all_persen    += $dtdetail_value->dtl_a_realisai_persen_before;
                                                                        $dtl_a_7target_today_total_all_akumulatif          += $dtdetail_value->dtl_a_target_today;
                                                                        $dtl_a_7target_persen_today_total_all_persen       += $dtdetail_value->dtl_a_target_persen_today;
                                                                        $dtl_a_7realisai_today_total_all_akumulatif        += $dtdetail_value->dtl_a_realisai_today;
                                                                        $dtl_a_7realisai_today_total_all_persen            += $dtdetail_value->dtl_a_realisai_persen_today;
                                                                        $dtl_a_7target_next_total_all_akumulatif           += $dtdetail_value->dtl_a_target_next;
                                                                        $dtl_a_7target_persen_next_total_all_persen        += $dtdetail_value->dtl_a_target_persen_next;
                                                                        $attr_readonly = '';
                                                                        $value1 = number_format((float)$dtdetail_value->dtl_a_realisai_before, 2, ',', '.');
                                                                        $value2 = number_format((float)$dtdetail_value->dtl_a_target_today, 2, ',', '.');
                                                                        $value3 = number_format((float)$dtdetail_value->dtl_a_realisai_today, 2, ',', '.');
                                                                        $value4 = number_format((float)$dtdetail_value->dtl_a_target_next, 2, ',', '.');
                                                                    } else {
                                                                        $attr_readonly = 'readonly';
                                                                        $value1 = number_format((float)$dtdetail_value->dtl_a_realisai_before, 2, ',', '.');
                                                                        $value2 = number_format((float)$dtdetail_value->dtl_a_target_today, 2, ',', '.');
                                                                        $value3 = number_format((float)$dtdetail_value->dtl_a_realisai_today, 2, ',', '.');
                                                                        $value4 = number_format((float)$dtdetail_value->dtl_a_target_next, 2, ',', '.');
                                                                    }

                                                                    // condition item 2
                                                                    if ($dtdetail_value->dtl_a_definisi_2 == '1.1 PROSES AIR') {
                                                                        $bg_style = 'class="table-danger align-middle text-left"';
                                                                        $colspan_style = 'colspan="9"';
                                                                        $text_bold = '<b>' . $dtdetail_value->dtl_a_definisi_2 . '</b>';
                                                                        $td_input = '<input type="hidden" name="dtl_a_detail_id[]" id="dtl_a_detail_id" class="form-control dtl_a_detail_id" value="' . $dtdetail_value->detail_id . '"/>
                                                                                    <input type="hidden" name="dtl_a_definisi_1[]" id="dtl_a_definisi_1" class="form-control dtl_a_definisi_1" value="' . $dtdetail_value->dtl_a_definisi_1 . '"/>
                                                                                    <input type="hidden" name="dtl_a_definisi_2[]" id="dtl_a_definisi_2" class="form-control dtl_a_definisi_2" value="' . $dtdetail_value->dtl_a_definisi_2 . '"/>
                                                                                    <input type="hidden" name="dtl_a_definisi_3[]" id="dtl_a_definisi_3" class="form-control dtl_a_definisi_3" value="' . $dtdetail_value->dtl_a_definisi_3 . '"/>
                                                                                    <input type="hidden" name="dtl_a_realisai_before[]" id="dtl_a_realisai_before" class="dtl_a_realisai_before form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_realisai_persen_before[]" id="dtl_a_realisai_persen_before" class="dtl_a_realisai_persen_before form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_target_today[]" id="dtl_a_target_today" class="dtl_a_target_today form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_target_persen_today[]" id="dtl_a_target_persen_today" class="dtl_a_target_persen_today form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_realisai_today[]" id="dtl_a_realisai_today" class="dtl_a_realisai_today form-control angkadantitik w-auto hitung_total hitung_persen" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_realisai_persen_today[]" id="dtl_a_realisai_persen_today" class="dtl_a_realisai_persen_today form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_target_next[]" id="dtl_a_target_next" class="dtl_a_target_next form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_target_persen_next[]" id="dtl_a_target_persen_next" class="dtl_a_target_persen_next form-control angkadantitik w-auto" style="text-align: center;" value="">';
                                                                    } else if (preg_match("~Biaya Lain-lain~", $dtdetail_value->dtl_a_definisi_2)) {
                                                                        $bg_style = 'class="table-danger align-middle text-left"';
                                                                        $colspan_style = 'colspan="9"';
                                                                        $text_bold = '<b>' . $dtdetail_value->dtl_a_definisi_2 . '</b>';
                                                                        $td_input = '<input type="hidden" name="dtl_a_detail_id[]" id="dtl_a_detail_id" class="form-control dtl_a_detail_id" value="' . $dtdetail_value->detail_id . '"/>
                                                                                    <input type="hidden" name="dtl_a_definisi_1[]" id="dtl_a_definisi_1" class="form-control dtl_a_definisi_1" value="' . $dtdetail_value->dtl_a_definisi_1 . '"/>
                                                                                    <input type="hidden" name="dtl_a_definisi_2[]" id="dtl_a_definisi_2" class="form-control dtl_a_definisi_2" value="' . $dtdetail_value->dtl_a_definisi_2 . '"/>
                                                                                    <input type="hidden" name="dtl_a_definisi_3[]" id="dtl_a_definisi_3" class="form-control dtl_a_definisi_3" value="' . $dtdetail_value->dtl_a_definisi_3 . '"/>
                                                                                    <input type="hidden" name="dtl_a_realisai_before[]" id="dtl_a_realisai_before" class="dtl_a_realisai_before form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_realisai_persen_before[]" id="dtl_a_realisai_persen_before" class="dtl_a_realisai_persen_before form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_target_today[]" id="dtl_a_target_today" class="dtl_a_target_today form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_target_persen_today[]" id="dtl_a_target_persen_today" class="dtl_a_target_persen_today form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_realisai_today[]" id="dtl_a_realisai_today" class="dtl_a_realisai_today form-control angkadantitik w-auto hitung_total hitung_persen" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_realisai_persen_today[]" id="dtl_a_realisai_persen_today" class="dtl_a_realisai_persen_today form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_target_next[]" id="dtl_a_target_next" class="dtl_a_target_next form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                                                    <input type="hidden" name="dtl_a_target_persen_next[]" id="dtl_a_target_persen_next" class="dtl_a_target_persen_next form-control angkadantitik w-auto" style="text-align: center;" value="">';
                                                                    } else if (preg_match("~After ~", $dtdetail_value->dtl_a_definisi_2)) {
                                                                        $bg_style = 'class="table-danger align-middle text-left"';
                                                                        $colspan_style = 'colspan="9"';
                                                                        $text_bold = '<b>' . $dtdetail_value->dtl_a_definisi_2 . '</b>';
                                                                        $td_input = '';
                                                                    } else if ($dtdetail_value->dtl_a_definisi_2 == '5.1 Total Proses Air WTD') {
                                                                        $bg_style = 'class="table-danger align-middle text-left"';
                                                                        $colspan_style = 'colspan="9"';
                                                                        $text_bold = '<b>' . $dtdetail_value->dtl_a_definisi_2 . '</b>';
                                                                        $td_input = '';
                                                                    } else if ($dtdetail_value->dtl_a_definisi_2 == '5.2 Pemakaian Air Efektif ( Total Pakai air - pemakaian oleh WTD )') {
                                                                        $bg_style = 'class="table-danger align-middle text-left"';
                                                                        $colspan_style = 'colspan="9"';
                                                                        $text_bold = '<b>' . $dtdetail_value->dtl_a_definisi_2 . '</b>';
                                                                        $td_input = '';
                                                                    } else {
                                                                        $bg_style = '';
                                                                        $colspan_style = '';
                                                                        $text_bold = $dtdetail_value->dtl_a_definisi_2;
                                                                        $td_input = '
                                                                                    <input type="hidden" name="dtl_a_detail_id[]" id="dtl_a_detail_id" class="form-control dtl_a_detail_id" value="' . $dtdetail_value->detail_id . '"/>
                                                                                    <input type="hidden" name="dtl_a_definisi_1[]" id="dtl_a_definisi_1" class="form-control dtl_a_definisi_1" value="' . $dtdetail_value->dtl_a_definisi_1 . '"/>
                                                                                    <input type="hidden" name="dtl_a_definisi_2[]" id="dtl_a_definisi_2" class="form-control dtl_a_definisi_2" value="' . $dtdetail_value->dtl_a_definisi_2 . '"/>
                                                                                    <input type="hidden" name="dtl_a_definisi_3[]" id="dtl_a_definisi_3" class="form-control dtl_a_definisi_3" value="' . $dtdetail_value->dtl_a_definisi_3 . '"/>
                                                                                    <td align="center">
                                                                                        <input type="hidden" name="dtl_a_realisai_before[]" id="dtl_a_realisai_before" class="dtl_a_realisai_before form-control angkadantitik w-auto hitung_total hitung_persen ' . $class_item2 . '_today" style="text-align: center;" value="' . $dtdetail_value->dtl_a_realisai_before . '">
                                                                                        <input type="text" id="dtl_a_realisai_before" class="dtl_a_realisai_before form-control angkadantitik w-auto hitung_total hitung_persen ' . $class_item2 . '_today" style="text-align: center;" value="' . $value1 . '">
                                                                                    </td>
                                                                                    <td align="center"><input type="text" name="dtl_a_realisai_persen_before[]" id="dtl_a_realisai_persen_before" class="dtl_a_realisai_persen_before form-control angkadantitik w-auto ' . $class_item2 . '_persen" style="text-align: center;" value="' . $dtdetail_value->dtl_a_realisai_persen_before . '" readonly></td>
                                                                                    <td align="center">
                                                                                        <input type="hidden" name="dtl_a_target_today[]" id="dtl_a_target_today" class="dtl_a_target_today form-control angkadantitik w-auto hitung_total hitung_persen ' . $class_item2 . '_today" style="text-align: center;" value="' . $dtdetail_value->dtl_a_target_today . '">
                                                                                        <input type="text" id="dtl_a_target_today" class="dtl_a_target_today form-control angkadantitik w-auto hitung_total hitung_persen ' . $class_item2 . '_today" style="text-align: center;" value="' . $value2 . '">
                                                                                    </td>
                                                                                    <td align="center"><input type="text" name="dtl_a_target_persen_today[]" id="dtl_a_target_persen_today" class="dtl_a_target_persen_today form-control angkadantitik w-auto ' . $class_item2 . '_persen" style="text-align: center;" value="' . $dtdetail_value->dtl_a_target_persen_today . '" readonly></td>
                                                                                    <td align="center">
                                                                                        <input type="hidden" name="dtl_a_realisai_today[]" id="dtl_a_realisai_today" class="dtl_a_realisai_today form-control angkadantitik w-auto hitung_total hitung_persen ' . $class_item2 . '_today" style="text-align: center;" value="' . $dtdetail_value->dtl_a_realisai_today . '">
                                                                                        <input type="text" id="dtl_a_realisai_today" class="dtl_a_realisai_today form-control angkadantitik w-auto hitung_total hitung_persen ' . $class_item2 . '_today" style="text-align: center;" value="' . $value3 . '" ' . $attr_readonly . '>
                                                                                    </td>
                                                                                    <td align="center"><input type="text" name="dtl_a_realisai_persen_today[]" id="dtl_a_realisai_persen_today" class="dtl_a_realisai_persen_today form-control angkadantitik w-auto ' . $class_item2 . '_persen" style="text-align: center;" value="' . $dtdetail_value->dtl_a_realisai_persen_today . '" readonly></td>
                                                                                    <td align="center">
                                                                                        <input type="hidden" name="dtl_a_target_next[]" id="dtl_a_target_next" class="dtl_a_target_next form-control angkadantitik w-auto hitung_total hitung_persen ' . $class_item2 . '_today" style="text-align: center;" value="' . $dtdetail_value->dtl_a_target_next . '" readonly>
                                                                                        <input type="text" id="dtl_a_target_next" class="dtl_a_target_next form-control angkadantitik w-auto hitung_total hitung_persen ' . $class_item2 . '_today" style="text-align: center;" value="' . $value4 . '" readonly>
                                                                                    </td>
                                                                                    <td align="center"><input type="text" name="dtl_a_target_persen_next[]" id="dtl_a_target_persen_next" class="dtl_a_target_persen_next form-control angkadantitik w-auto ' . $class_item2 . '_persen" style="text-align: center;" value="' . $dtdetail_value->dtl_a_target_persen_next . '" readonly></td>';
                                                                    }

                                                                    // condition item 3
                                                                    if ($dtdetail_value->dtl_a_definisi_3 != '' && preg_match("~Biaya Lain-lain~", $dtdetail_value->dtl_a_definisi_3)) {
                                                                        $type_input3 = 'hidden';
                                                                        $bg_style3 = 'class="table-danger align-middle text-center"';
                                                                    } else {
                                                                        $type_input3 = 'text';
                                                                        $bg_style3 = '';
                                                                    } ?>

                                                                    <?php if ($dtdetail_value->no_urut == 1) { ?>
                                                                        <tr class="table-warning align-middle text-left">
                                                                            <td><?= $no; ?></td>
                                                                            <td colspan="9"><b><?= $dtdetail_value->dtl_a_definisi_1 ?></b></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    if ($dtdetail_value->no_urut_b == 1) { ?>
                                                                        <tr <?= $bg_style; ?>>
                                                                            <td></td>
                                                                            <td <?= $colspan_style ?>><?= $text_bold ?></td>
                                                                            <?= $td_input ?>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    if ($dtdetail_value->dtl_a_definisi_3 != '') { ?>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td><?= $dtdetail_value->dtl_a_definisi_3 ?></td>
                                                                            <input type="hidden" name="dtl_a_detail_id[]" id="dtl_a_detail_id" class="dtl_a_detail_id" value="<?= $dtdetail_value->detail_id; ?>">
                                                                            <input type="hidden" name="dtl_a_definisi_1[]" id="dtl_a_definisi_1" class="form-control dtl_a_definisi_1" value="<?= $dtdetail_value->dtl_a_definisi_1 ?>" />
                                                                            <input type="hidden" name="dtl_a_definisi_2[]" id="dtl_a_definisi_2" class="form-control dtl_a_definisi_2" value="<?= $dtdetail_value->dtl_a_definisi_2 ?>" />
                                                                            <input type="hidden" name="dtl_a_definisi_3[]" id="dtl_a_definisi_3" class="form-control dtl_a_definisi_3" value="<?= $dtdetail_value->dtl_a_definisi_3 ?>" />
                                                                            <td align="center">
                                                                                <input type="hidden" name="dtl_a_realisai_before[]" id="dtl_a_realisai_before" class="dtl_a_realisai_before form-control angkadantitik w-auto hitung_total hitung_persen <?= $class_item3 ?>_today" style="text-align: center;" value="<?= $dtdetail_value->dtl_a_realisai_before ?>" readonly>
                                                                                <input type="<?= $type_input3; ?>" id="dtl_a_realisai_before" class="dtl_a_realisai_before form-control angkadantitik w-auto hitung_total hitung_persen <?= $class_item3 ?>_today" style="text-align: center;" value="<?= number_format((float)$dtdetail_value->dtl_a_realisai_before, 2, ',', '.') ?>" readonly>
                                                                            </td>
                                                                            <td align="center"><input type="<?= $type_input3; ?>" name="dtl_a_realisai_persen_before[]" id="dtl_a_realisai_persen_before" class="dtl_a_realisai_persen_before form-control angkadantitik w-auto <?= $class_item3 ?>_persen" style="text-align: center;" value="<?= $dtdetail_value->dtl_a_realisai_persen_before ?>" readonly></td>
                                                                            <td align="center">
                                                                                <input type="hidden" name="dtl_a_target_today[]" id="dtl_a_target_today" class="dtl_a_target_today form-control angkadantitik w-auto hitung_total hitung_persen <?= $class_item3 ?>_today" style="text-align: center;" value="<?= $dtdetail_value->dtl_a_target_today ?>" readonly>
                                                                                <input type="<?= $type_input3; ?>" id="dtl_a_target_today" class="dtl_a_target_today form-control angkadantitik w-auto hitung_total hitung_persen <?= $class_item3 ?>_today" style="text-align: center;" value="<?= number_format((float)$dtdetail_value->dtl_a_target_today, 2, ',', '.') ?>" readonly>
                                                                            </td>
                                                                            <td align="center"><input type="<?= $type_input3; ?>" name="dtl_a_target_persen_today[]" id="dtl_a_target_persen_today" class="dtl_a_target_persen_today form-control angkadantitik w-auto <?= $class_item3 ?>_persen" style="text-align: center;" value="<?= $dtdetail_value->dtl_a_target_persen_today ?>" readonly></td>
                                                                            <td align="center">
                                                                                <input type="hidden" name="dtl_a_realisai_today[]" id="dtl_a_realisai_today" class="dtl_a_realisai_today form-control angkadantitik w-auto hitung_total hitung_persen <?= $class_item3 ?>_today" style="text-align: center;" value="<?= $dtdetail_value->dtl_a_realisai_today  ?>" readonly>
                                                                                <input type="<?= $type_input3; ?>" id="dtl_a_realisai_today" class="dtl_a_realisai_today form-control angkadantitik w-auto hitung_total hitung_persen <?= $class_item3 ?>_today" style="text-align: center;" value="<?= number_format((float)$dtdetail_value->dtl_a_realisai_today, 2, ',', '.');  ?>" readonly>
                                                                            </td>
                                                                            <td align="center"><input type="<?= $type_input3; ?>" name="dtl_a_realisai_persen_today[]" id="dtl_a_realisai_persen_today" class="dtl_a_realisai_persen_today form-control angkadantitik w-auto <?= $class_item3 ?>_persen" style="text-align: center;" value="<?= $dtdetail_value->dtl_a_realisai_persen_today; ?>" readonly></td>
                                                                            <td align="center">
                                                                                <input type="hidden" name="dtl_a_target_next[]" id="dtl_a_target_next" class="dtl_a_target_next form-control angkadantitik w-auto hitung_total hitung_persen <?= $class_item3 ?>_today" style="text-align: center;" value="<?= $dtdetail_value->dtl_a_target_next ?>" readonly>
                                                                                <input type="<?= $type_input3; ?>" id="dtl_a_target_next" class="dtl_a_target_next form-control angkadantitik w-auto hitung_total hitung_persen <?= $class_item3 ?>_today" style="text-align: center;" value="<?= number_format((float)$dtdetail_value->dtl_a_target_next, 2, ',', '.'); ?>" readonly>
                                                                            </td>
                                                                            <td align="center"><input type="<?= $type_input3; ?>" name="dtl_a_target_persen_next[]" id="dtl_a_target_persen_next" class="dtl_a_target_persen_next form-control angkadantitik w-auto <?= $class_item3 ?>_persen" style="text-align: center;" value="<?= $dtdetail_value->dtl_a_target_persen_next ?>" readonly></td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                    // total Distribusi Air per jenis air 
                                                                    if (($no_dis_air++) == 1) {
                                                                        $dtl_a_realisai_before_total_akumulatif       = $dtdetail_value->dtl_a_realisai_before;
                                                                        $dtl_a_realisai_persen_before_total_persen    = $dtdetail_value->dtl_a_realisai_persen_before;
                                                                        $dtl_a_target_today_total_akumulatif          = $dtdetail_value->dtl_a_target_today;
                                                                        $dtl_a_target_persen_today_total_persen       = $dtdetail_value->dtl_a_target_persen_today;
                                                                        $dtl_a_realisai_today_total_akumulatif        = $dtdetail_value->dtl_a_realisai_today;
                                                                        $dtl_a_realisai_today_total_persen            = $dtdetail_value->dtl_a_realisai_persen_today;
                                                                        $dtl_a_target_next_total_akumulatif           = $dtdetail_value->dtl_a_target_next;
                                                                        $dtl_a_target_persen_next_total_persen        = $dtdetail_value->dtl_a_target_persen_next;
                                                                    } else {
                                                                        if ($dtdetail_value->dtl_a_definisi_2 == $dtdetail[$dtdetail_key - 1]->dtl_a_definisi_2) {
                                                                            $dtl_a_realisai_before_total_akumulatif       += $dtdetail_value->dtl_a_realisai_before;
                                                                            $dtl_a_realisai_persen_before_total_persen    += $dtdetail_value->dtl_a_realisai_persen_before;
                                                                            $dtl_a_target_today_total_akumulatif          += $dtdetail_value->dtl_a_target_today;
                                                                            $dtl_a_target_persen_today_total_persen       += $dtdetail_value->dtl_a_target_persen_today;
                                                                            $dtl_a_realisai_today_total_akumulatif        += $dtdetail_value->dtl_a_realisai_today;
                                                                            $dtl_a_realisai_today_total_persen            += $dtdetail_value->dtl_a_realisai_persen_today;
                                                                            $dtl_a_target_next_total_akumulatif           += $dtdetail_value->dtl_a_target_next;
                                                                            $dtl_a_target_persen_next_total_persen        += $dtdetail_value->dtl_a_target_persen_next;
                                                                        } else {
                                                                            $dtl_a_realisai_before_total_akumulatif       = $dtdetail_value->dtl_a_realisai_before;
                                                                            $dtl_a_realisai_persen_before_total_persen    = $dtdetail_value->dtl_a_realisai_persen_before;
                                                                            $dtl_a_target_today_total_akumulatif          = $dtdetail_value->dtl_a_target_today;
                                                                            $dtl_a_target_persen_today_total_persen       = $dtdetail_value->dtl_a_target_persen_today;
                                                                            $dtl_a_realisai_today_total_akumulatif        = $dtdetail_value->dtl_a_realisai_today;
                                                                            $dtl_a_realisai_today_total_persen            = $dtdetail_value->dtl_a_realisai_persen_today;
                                                                            $dtl_a_target_next_total_akumulatif           = $dtdetail_value->dtl_a_target_next;
                                                                            $dtl_a_target_persen_next_total_persen        = $dtdetail_value->dtl_a_target_persen_next;
                                                                        }
                                                                    }

                                                                    if ($dtdetail_value->no_urut_b_desc == 1) {
                                                                        if ($dtdetail_value->dtl_a_definisi_1 == 'Distribusi Air') { ?>
                                                                            <tr>
                                                                                <td class="table-secondary align-middle text-left" colspan="2"><b>Total <?= preg_replace('/[\d.]/', '', $dtdetail_value->dtl_a_definisi_2) ?></b></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_before_total_<?= $class_item2; ?>_akumulatif"><?= number_format((float)$dtl_a_realisai_before_total_akumulatif, 2, ',', '.'); ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_before_total_<?= $class_item2; ?>_persen"><?= $dtl_a_realisai_persen_before_total_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_today_total_<?= $class_item2; ?>_akumulatif"><?= number_format((float)$dtl_a_target_today_total_akumulatif, 2, ',', '.'); ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_today_total_<?= $class_item2; ?>_persen"><?= $dtl_a_target_persen_today_total_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_today_total_<?= $class_item2; ?>_akumulatif"><?= number_format((float)$dtl_a_realisai_today_total_akumulatif, 2, ',', '.'); ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_today_total_<?= $class_item2; ?>_persen"><?= $dtl_a_realisai_today_total_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_next_total_<?= $class_item2; ?>_akumulatif"><?= number_format((float)$dtl_a_target_next_total_akumulatif, 2, ',', '.'); ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_next_total_<?= $class_item2; ?>_persen"><?= $dtl_a_target_persen_next_total_persen; ?></td>
                                                                            </tr>
                                                                        <?php
                                                                        }
                                                                        if ($dtdetail_value->dtl_a_definisi_1 == 'Rp / ton air') { ?>
                                                                            <tr>
                                                                                <td class="table-secondary align-middle text-left" colspan="2"><b><?php if ($dtdetail_value->dtl_a_definisi_2 == '5.1 Total Proses Air WTD') {
                                                                                                                                                        echo 'Total (Non Efektif)';
                                                                                                                                                    } else {
                                                                                                                                                        echo "Total HPP Efektif";
                                                                                                                                                    } ?></b></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_before_total_<?= $class_item2; ?>_akumulatif"><?= $dtl_a_realisai_before_total_akumulatif; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_before_total_<?= $class_item2; ?>_persen"><?= $dtl_a_realisai_persen_before_total_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_today_total_<?= $class_item2; ?>_akumulatif"><?= $dtl_a_target_today_total_akumulatif; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_today_total_<?= $class_item2; ?>_persen"><?= $dtl_a_target_persen_today_total_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_today_total_<?= $class_item2; ?>_akumulatif"><?= $dtl_a_realisai_today_total_akumulatif; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_today_total_<?= $class_item2; ?>_persen"><?= $dtl_a_realisai_today_total_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_next_total_<?= $class_item2; ?>_akumulatif"><?= $dtl_a_target_next_total_akumulatif; ?> </td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_next_total_<?= $class_item2; ?>_persen"><?= $dtl_a_target_persen_next_total_persen; ?></td>
                                                                            </tr>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    // total seluruhnya
                                                                    if ($dtdetail_value->no_urut_desc == 1) {
                                                                        if ($dtdetail_value->dtl_a_definisi_1 == 'Distribusi Air') { ?>
                                                                            <tr>
                                                                                <td class="table-secondary align-middle text-left" colspan="2"><b>Total <?= $dtdetail_value->dtl_a_definisi_1 ?></b></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_before_total_all_<?= $class_item1 ?>_akumulatif"><?= number_format((float)$dtl_a_6realisai_before_total_all_akumulatif, 2, ',', '.'); ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_before_total_all_<?= $class_item1 ?>_persen"><?= $dtl_a_6realisai_persen_before_total_all_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_today_total_all_<?= $class_item1 ?>_akumulatif"><?= number_format((float)$dtl_a_6target_today_total_all_akumulatif, 2, ',', '.'); ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_today_total_all_<?= $class_item1 ?>_persen"><?= $dtl_a_6target_persen_today_total_all_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_today_total_all_<?= $class_item1 ?>_akumulatif"><?= number_format((float)$dtl_a_6realisai_today_total_all_akumulatif, 2, ',', '.'); ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_today_total_all_<?= $class_item1 ?>_persen"><?= $dtl_a_6realisai_today_total_all_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_next_total_all_<?= $class_item1 ?>_akumulatif"><?= number_format((float)$dtl_a_6target_next_total_all_akumulatif, 2, ',', '.'); ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_next_total_all_<?= $class_item1 ?>_persen"><?= $dtl_a_6target_persen_next_total_all_persen; ?></td>
                                                                            </tr>
                                                                        <?php } else if ($dtdetail_value->dtl_a_definisi_1 == 'Biaya Operasional ( Rp )') { ?>
                                                                            <tr>
                                                                                <td class="table-secondary align-middle text-left" colspan="2"><b>Total <?= $dtdetail_value->dtl_a_definisi_1 ?></b></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_before_total_all_<?= $class_item1 ?>_akumulatif"><?= $dtl_a_2realisai_before_total_all_akumulatif; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_before_total_all_<?= $class_item1 ?>_persen"><?= $dtl_a_2realisai_persen_before_total_all_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_today_total_all_<?= $class_item1 ?>_akumulatif"><?= $dtl_a_2target_today_total_all_akumulatif; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_today_total_all_<?= $class_item1 ?>_persen"><?= $dtl_a_2target_persen_today_total_all_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_today_total_all_<?= $class_item1 ?>_akumulatif"><?= number_format((float)$dtl_a_2realisai_today_total_all_akumulatif, 2, ',', '.'); ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_today_total_all_<?= $class_item1 ?>_persen"><?= $dtl_a_2realisai_today_total_all_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_next_total_all_<?= $class_item1 ?>_akumulatif"><?= $dtl_a_2target_next_total_all_akumulatif; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_next_total_all_<?= $class_item1 ?>_persen"><?= $dtl_a_2target_persen_next_total_all_persen; ?></td>
                                                                            </tr>
                                                                        <?php
                                                                        } else if ($dtdetail_value->dtl_a_definisi_1 == 'Tenaga kerja') { ?>
                                                                            <tr>
                                                                                <td class="table-secondary align-middle text-left" colspan="2"><b>Total <?= $dtdetail_value->dtl_a_definisi_1 ?></b></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_before_total_all_<?= $class_item1 ?>_akumulatif"><?= $dtl_a_7realisai_before_total_all_akumulatif; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_before_total_all_<?= $class_item1 ?>_persen"><?= $dtl_a_7realisai_persen_before_total_all_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_today_total_all_<?= $class_item1 ?>_akumulatif"><?= $dtl_a_7target_today_total_all_akumulatif; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_today_total_all_<?= $class_item1 ?>_persen"><?= $dtl_a_7target_persen_today_total_all_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_today_total_all_<?= $class_item1 ?>_akumulatif"><?= $dtl_a_7realisai_today_total_all_akumulatif; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_today_total_all_<?= $class_item1 ?>_persen"><?= $dtl_a_7realisai_today_total_all_persen; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_next_total_all_<?= $class_item1 ?>_akumulatif"><?= $dtl_a_7target_next_total_all_akumulatif; ?></td>
                                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_next_total_all_<?= $class_item1 ?>_persen"><?= $dtl_a_7target_persen_next_total_all_persen; ?></td>
                                                                            </tr>
                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            } ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td class="table-primary align-middle text-center" colspan="12"></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
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
<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script> -->
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
            this.value = this.value.replace(/[A-Z]|[a-z]/g, '');
        });

        if (typeof($('#headerid').val()) != "undefined") {
            $('.dtopen_blok').prop('readonly', true);
            $('.dtopen_blok2 > option').each(function() {
                if (!this.selected) {
                    $(this).attr('disabled', true);
                }
            });

            get_rp_proses_air();
            get_target_rumus();

            total_penggunaan_air('dtl_a_target_next', '2biayaoperasionalrp');

            total_penggunaan_per_air('dtl_a_target_next', '5rptonair_totalprosesairwtd');
            total_penggunaan_per_air('dtl_a_target_next', '5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd');

            persen_rp_air('dtl_a_target_next', '2biayaoperasionalrp', 'dtl_a_target_persen_next');
            // persen_rp_air('dtl_a_target_next', '5rptonair_totalprosesairwtd', 'dtl_a_target_persen_next');
            // persen_rp_air('dtl_a_target_next', '5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd', 'dtl_a_target_persen_next');
            persen_rp_air('dtl_a_target_next', '6distribusiair', 'dtl_a_target_persen_next');
            persen_rp_air('dtl_a_target_next', '7tenagakerja', 'dtl_a_target_persen_next');
        }

        get_docno();

        function get_docno() {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            if (typeof(input_headerid) == "undefined" && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formintwtd023_00/get_docno/intwtd023/00",
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

        $('.create_date').change(function() {
            get_docno();
        });
        $('.date_today').change(function() {
            get_forminput();
        });
        $('.date_before').change(function() {
            get_forminput();
        });


        function get_forminput() {
            var input_headerid = $(".headerid").val();

            var split_bulantahun = $('.date_today').val().split('-');
            var bulantahun = split_bulantahun[1] + split_bulantahun[0];

            var date_today = $('.date_today').val();
            var date_before = $('.date_before').val();
            var date_next = $('.date_next').val();

            var create_date = $('.create_date').val();
            if (create_date != '' && input_headerid == undefined && date_today != '' && date_before != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formintwtd023_00/get_forminput/intwtd023/00",
                    data: {
                        create_date,
                        date_today,
                        date_before,
                        date_next,
                        bulantahun
                    },
                    dataType: "json",
                    async: false,
                    success: function(result) {
                        if (result.status == 0) {

                            let dtsampel_frmfss317_headerid = '';
                            let dtsampel_frmfss317_complete_date = '';
                            let dtsampel_frmfss317_complete_time = '';
                            // console.log(result.data.result_frmfss317)
                            // dtl a
                            let list_dtl_a = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;
                            let no = 0;
                            let akumulatif = 0;
                            let persen = 0;
                            let satuan_persen = 0;
                            let target_akumulatif = 0;
                            let target_persen = 0;
                            let realisai_akumulatif = 0;
                            let realisai_persen = 0;

                            let dtl_a_realisai_before_total = 0;
                            let dtl_a_realisai_persen_before_total = 0;
                            let dtl_a_target_today_total = 0;
                            let dtl_a_target_persen_today_total = 0;
                            let dtl_a_realisai_today_total = 0;
                            let dtl_a_realisai_persen_today_total = 0;
                            let dtl_a_target_next_total = 0;
                            let dtl_a_target_persen_next_total = 0;

                            let dtl_a_total_all_akumulatif = 0;
                            let dtl_a_total_all_persen = 0;
                            let dtl_a_total_all_target_akumulatif = 0;
                            let dtl_a_total_all_target_persen = 0;
                            let dtl_a_total_all_realisai_akumulatif = 0;
                            let dtl_a_total_all_realisai_persen = 0;

                            let type_input = '';
                            let type_input3 = '';
                            let attr_readonly = '';
                            let class_item1 = '';
                            let class_item2 = '';
                            let class_item3 = '';
                            let td_total = '';

                            if (result.data.result_frmfss317.length > 0) {
                                list_dtl_a = ``;
                                $.each(result.data.result_frmfss317, function(dtl_a_key, dtl_a_row) {
                                    akumulatif = dtl_a_row.operasi_akumulatif == null ? 0 : parseFloat(dtl_a_row.operasi_akumulatif).toFixed(2);
                                    persen = dtl_a_row.operasi_persen == null ? 0 : parseFloat(dtl_a_row.operasi_persen).toFixed(1);
                                    satuan_persen = dtl_a_row.operasi_satuan == null ? 0 : dtl_a_row.operasi_satuan;
                                    dtl_a_row_item3 = dtl_a_row.item3 == null ? '' : dtl_a_row.item3;

                                    target_akumulatif = dtl_a_row.target_today == null || dtl_a_row.target_today == '' ? 0 : parseFloat(dtl_a_row.target_today).toFixed(2);
                                    if (dtl_a_row.target_persen_today == null) {
                                        target_persen = dtl_a_row.operasi_satuan == null ? 0 : dtl_a_row.operasi_satuan;
                                    } else if (dtl_a_row.target_persen_today != null) {
                                        target_persen = dtl_a_row.target_persen_today;
                                    } else {
                                        target_persen = 0;
                                    }

                                    realisai_akumulatif = dtl_a_row.realisai_before == null || dtl_a_row.realisai_before == '' ? 0 : parseFloat(dtl_a_row.realisai_before).toFixed(2);
                                    if (dtl_a_row.target_persen_today == null) {
                                        realisai_persen = dtl_a_row.operasi_satuan == null ? 0 : dtl_a_row.operasi_satuan;
                                    } else if (dtl_a_row.realisai_persen_today != null) {
                                        realisai_persen = dtl_a_row.realisai_persen_today;
                                    } else {
                                        realisai_persen = 0;
                                    }

                                    if (dtl_a_row.num_row == 1) {
                                        no++;
                                        list_dtl_a += `<tr class="table-warning align-middle text-center">
                                                            <td align="center"><b>${no}</b></td>
                                                            <td align="left" colspan="9"><b>${dtl_a_row.item1}</b></td>
                                                        </tr>`;
                                    }

                                    class_item1 = no + dtl_a_row.item1.replace(/[.*+?^${}()|[\]\\|[ ]|[/\d./-]/g, '').toLowerCase();
                                    class_item2 = no + dtl_a_row.item1.replace(/[.*+?^${}()|[\]\\|[ ]|[/\d./-]/g, '').toLowerCase() + '_' + dtl_a_row.item2.replace(/[.*+?^${}()|[\]\\|[ ]|[/\d./-]/g, '').toLowerCase();
                                    class_item3 = no + dtl_a_row.item1.replace(/[.*+?^${}()|[\]\\|[ ]|[/\d./-]/g, '').toLowerCase() + '_' + dtl_a_row.item2.replace(/[.*+?^${}()|[\]\\|[ ]|[/\d./-]/g, '').toLowerCase() + '_' + dtl_a_row_item3.replace(/[.*+?^${}()|[\]\\|[ ]|[/\d./-]/g, '').toLowerCase();

                                    // condition item 1
                                    if (dtl_a_row.item1 == 'Biaya Operasional ( Rp )') {
                                        dtl_a_total_all_target_akumulatif += parseFloat(target_akumulatif);
                                        dtl_a_total_all_realisai_akumulatif += parseFloat(realisai_akumulatif);
                                        dtl_a_total_all_akumulatif += parseFloat(akumulatif);
                                        dtl_a_total_all_persen += parseFloat(persen);
                                        dtl_a_total_all_target_persen += parseFloat(target_persen);
                                        dtl_a_total_all_realisai_persen += parseFloat(realisai_persen);
                                        attr_readonly = '';
                                        dt_akumulatif = '';
                                        dt_akumulatif2 = '';
                                    } else if (dtl_a_row.item1 == 'Distribusi Air') {
                                        dtl_a_total_all_target_akumulatif += parseFloat(target_akumulatif);
                                        dtl_a_total_all_realisai_akumulatif += parseFloat(realisai_akumulatif);
                                        dtl_a_total_all_akumulatif += parseFloat(akumulatif);
                                        dtl_a_total_all_persen += parseFloat(persen);
                                        dtl_a_total_all_target_persen += parseFloat(target_persen);
                                        dtl_a_total_all_realisai_persen += parseFloat(realisai_persen);
                                        attr_readonly = '';
                                        dt_akumulatif = '';
                                        dt_akumulatif2 = '';
                                    } else if (dtl_a_row.item1 == 'Rp / ton air') {
                                        dtl_a_total_all_target_akumulatif += parseFloat(target_akumulatif);
                                        dtl_a_total_all_realisai_akumulatif += parseFloat(realisai_akumulatif);
                                        dtl_a_total_all_akumulatif += parseFloat(akumulatif);
                                        dtl_a_total_all_persen += parseFloat(persen);
                                        dtl_a_total_all_target_persen += parseFloat(target_persen);
                                        dtl_a_total_all_realisai_persen += parseFloat(realisai_persen);
                                        attr_readonly = '';
                                        dt_akumulatif = '';
                                        dt_akumulatif2 = '';
                                    } else if (dtl_a_row.item1 == 'Tenaga kerja') {
                                        dtl_a_total_all_akumulatif = 0;
                                        dtl_a_total_all_persen = 0;
                                        attr_readonly = '';
                                        dt_akumulatif = '';
                                        dt_akumulatif2 = '';
                                    } else {
                                        attr_readonly = 'readonly';
                                        dt_akumulatif = akumulatif;
                                        dt_akumulatif2 = parseFloat(dtl_a_row.operasi_akumulatif).toLocaleString('id-ID');
                                    }
                                    // condition item 2
                                    if (dtl_a_row.item2 == '1.1 PROSES AIR') {
                                        bg_style = 'class="table-danger align-middle text-center"';
                                        colspan_style = 'colspan="9"';
                                        text_bold = '<b>' + dtl_a_row.item2 + '</b>';
                                        td_input = `<input type="hidden" name="dtl_a_definisi_1[]" id="dtl_a_definisi_1" class="form-control dtl_a_definisi_1" value="` + dtl_a_row.item1 + `"/>
                                                    <input type="hidden" name="dtl_a_definisi_2[]" id="dtl_a_definisi_2" class="form-control dtl_a_definisi_2" value="` + dtl_a_row.item2 + `"/>
                                                    <input type="hidden" name="dtl_a_definisi_3[]" id="dtl_a_definisi_3" class="form-control dtl_a_definisi_3" value="` + dtl_a_row_item3 + `"/>
                                                    <input type="hidden" name="dtl_a_realisai_before[]" id="dtl_a_realisai_before" class="dtl_a_realisai_before form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_realisai_persen_before[]" id="dtl_a_realisai_persen_before" class="dtl_a_realisai_persen_before form-control w-auto" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_target_today[]" id="dtl_a_target_today" class="dtl_a_target_today form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_target_persen_today[]" id="dtl_a_target_persen_today" class="dtl_a_target_persen_today form-control w-auto" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_realisai_today[]" id="dtl_a_realisai_today" class="dtl_a_realisai_today form-control angkadantitik w-auto hitung_total hitung_persen" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_realisai_persen_today[]" id="dtl_a_realisai_persen_today" class="dtl_a_realisai_persen_today form-control w-auto" style="text-align: center;" value="" readonly>
                                                    <input type="hidden" name="dtl_a_target_next[]" id="dtl_a_target_next" class="dtl_a_target_next form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_target_persen_next[]" id="dtl_a_target_persen_next" class="dtl_a_target_persen_next form-control w-auto" style="text-align: center;" value="">`;

                                    } else if (dtl_a_row.item2.indexOf('Biaya Lain-lain') != -1) {
                                        bg_style = 'class="table-danger align-middle text-center"';
                                        colspan_style = 'colspan="9"';
                                        text_bold = '<b>' + dtl_a_row.item2 + '</b>';
                                        td_input = `<input type="hidden" name="dtl_a_definisi_1[]" id="dtl_a_definisi_1" class="form-control dtl_a_definisi_1" value="` + dtl_a_row.item1 + `"/>
                                                    <input type="hidden" name="dtl_a_definisi_2[]" id="dtl_a_definisi_2" class="form-control dtl_a_definisi_2" value="` + dtl_a_row.item2 + `"/>
                                                    <input type="hidden" name="dtl_a_definisi_3[]" id="dtl_a_definisi_3" class="form-control dtl_a_definisi_3" value="` + dtl_a_row_item3 + `"/>
                                                    <input type="hidden" name="dtl_a_realisai_before[]" id="dtl_a_realisai_before" class="dtl_a_realisai_before form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_realisai_persen_before[]" id="dtl_a_realisai_persen_before" class="dtl_a_realisai_persen_before form-control w-auto" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_target_today[]" id="dtl_a_target_today" class="dtl_a_target_today form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_target_persen_today[]" id="dtl_a_target_persen_today" class="dtl_a_target_persen_today form-control w-auto" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_realisai_today[]" id="dtl_a_realisai_today" class="dtl_a_realisai_today form-control angkadantitik w-auto hitung_total hitung_persen" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_realisai_persen_today[]" id="dtl_a_realisai_persen_today" class="dtl_a_realisai_persen_today form-control w-auto" style="text-align: center;" value="" readonly>
                                                    <input type="hidden" name="dtl_a_target_next[]" id="dtl_a_target_next" class="dtl_a_target_next form-control angkadantitik w-auto" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_target_persen_next[]" id="dtl_a_target_persen_next" class="dtl_a_target_persen_next form-control w-auto" style="text-align: center;" value="">`;

                                    } else if (dtl_a_row.item2.indexOf('After ') != -1) {
                                        bg_style = 'class="table-danger align-middle text-center"';
                                        colspan_style = 'colspan="9"';
                                        text_bold = '<b>' + dtl_a_row.item2 + '</b>';
                                        td_input = '';

                                    } else if (dtl_a_row.item2 == '5.1 Total Proses Air WTD') {
                                        bg_style = 'class="table-danger align-middle text-center"';
                                        colspan_style = 'colspan="9"';
                                        text_bold = '<b>' + dtl_a_row.item2 + '</b>';
                                        td_input = '';

                                    } else if (dtl_a_row.item2 == '5.2 Pemakaian Air Efektif ( Total Pakai air - pemakaian oleh WTD )') {
                                        bg_style = 'class="table-danger align-middle text-center"';
                                        colspan_style = 'colspan="9"';
                                        text_bold = '<b>' + dtl_a_row.item2 + '</b>';
                                        td_input = '';

                                    } else {
                                        bg_style = '';
                                        colspan_style = '';
                                        text_bold = dtl_a_row.item2;
                                        td_input = `<input type="hidden" name="dtl_a_definisi_1[]" id="dtl_a_definisi_1" class="form-control dtl_a_definisi_1" value="${dtl_a_row.item1}"/>
                                                    <input type="hidden" name="dtl_a_definisi_2[]" id="dtl_a_definisi_2" class="form-control dtl_a_definisi_2" value="${dtl_a_row.item2}"/>
                                                    <input type="hidden" name="dtl_a_definisi_3[]" id="dtl_a_definisi_3" class="form-control dtl_a_definisi_3" value="${dtl_a_row_item3}"/>
                                                    <td align="center">
                                                        <input type="text" id="dtl_a_realisai_before" class="dtl_a_realisai_before form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item2 + `_today" style="text-align: center;" value="${realisai_akumulatif}">
                                                        <input type="hidden" name="dtl_a_realisai_before[]" id="dtl_a_realisai_before" class="dtl_a_realisai_before form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item2 + `_today" style="text-align: center;" value="${realisai_akumulatif}">
                                                    </td>
                                                    <td align="center"><input type="text" name="dtl_a_realisai_persen_before[]" id="dtl_a_realisai_persen_before" class="dtl_a_realisai_persen_before form-control angkadantitik w-auto ` + class_item2 + `_persen" style="text-align: center;" value="${realisai_persen}" readonly></td>
                                                    <td align="center">
                                                        <input type="text" id="dtl_a_target_today" class="dtl_a_target_today form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item2 + `_today" style="text-align: center;" value="${target_akumulatif}">
                                                        <input type="hidden" name="dtl_a_target_today[]" id="dtl_a_target_today" class="dtl_a_target_today form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item2 + `_today" style="text-align: center;" value="${target_akumulatif}">
                                                    </td>
                                                    <td align="center"><input type="text" name="dtl_a_target_persen_today[]" id="dtl_a_target_persen_today" class="dtl_a_target_persen_today form-control angkadantitik w-auto ` + class_item2 + `_persen" style="text-align: center;" value="${target_persen}" readonly></td>
                                                    <td align="center">
                                                        <input type="hidden" name="dtl_a_realisai_today[]" id="dtl_a_realisai_today" class="dtl_a_realisai_today form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item2 + `_today" style="text-align: center;" value="${dt_akumulatif}" ` + attr_readonly + `>
                                                        <input type="text" id="dtl_a_realisai_today" class="dtl_a_realisai_today form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item2 + `_today" style="text-align: center;" value="${dt_akumulatif2}" ` + attr_readonly + `>
                                                    </td>
                                                    <td align="center"><input type="text" name="dtl_a_realisai_persen_today[]" id="dtl_a_realisai_persen_today" class="dtl_a_realisai_persen_today form-control angkadantitik w-auto ` + class_item2 + `_persen" style="text-align: center;" value="${satuan_persen}" readonly></td>
                                                    <td align="center">
                                                        <input type="text" id="dtl_a_target_next" class="dtl_a_target_next form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item2 + `_today" style="text-align: center;" value="" ` + attr_readonly + `>
                                                        <input type="hidden" name="dtl_a_target_next[]" id="dtl_a_target_next" class="dtl_a_target_next form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item2 + `_today" style="text-align: center;" value="" ` + attr_readonly + `>
                                                    </td>
                                                    <td align="center"><input type="text" name="dtl_a_target_persen_next[]" id="dtl_a_target_persen_next" class="dtl_a_target_persen_next form-control angkadantitik w-auto ` + class_item2 + `_persen" style="text-align: center;" value="${satuan_persen}" readonly></td>`;
                                    }

                                    // condition item 3
                                    if (dtl_a_row.item3 != null && dtl_a_row.item3.indexOf('Biaya Lain-lain') != -1) {
                                        type_input3 = 'hidden';
                                        bg_style3 = 'class="table-danger align-middle text-center"';
                                    } else {
                                        type_input3 = 'text';
                                        bg_style3 = '';
                                    }

                                    if (dtl_a_row.num_row_b == 1) {
                                        list_dtl_a += `<tr ` + bg_style + `>
                                                            <td align="center"></td>
                                                            <td align="left" ` + colspan_style + `>${text_bold}</td>
                                                            ` + td_input + `
                                                        </tr>`;
                                    }
                                    if (dtl_a_row.item3 != null) {
                                        list_dtl_a += `<tr ` + bg_style3 + `>
                                                            <input type="hidden" name="dtl_a_definisi_1[]" id="dtl_a_definisi_1" class="form-control dtl_a_definisi_1" value="${dtl_a_row.item1}"/>
                                                            <input type="hidden" name="dtl_a_definisi_2[]" id="dtl_a_definisi_2" class="form-control dtl_a_definisi_2" value="${dtl_a_row.item2}"/>
                                                            <input type="hidden" name="dtl_a_definisi_3[]" id="dtl_a_definisi_3" class="form-control dtl_a_definisi_3" value="${dtl_a_row.item3}"/>
                                                            <td align="center"></td>
                                                            <td align="left">${dtl_a_row.item3}</td>
                                                            <td align="center">
                                                                <input type="` + type_input3 + `" id="dtl_a_realisai_before" class="dtl_a_realisai_before form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item3 + `_today"" style="text-align: center;" value="${realisai_akumulatif}" readonly>
                                                                <input type="hidden" name="dtl_a_realisai_before[]" id="dtl_a_realisai_before" class="dtl_a_realisai_before form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item3 + `_today"" style="text-align: center;" value="${realisai_akumulatif}" readonly>
                                                            </td>
                                                            <td align="center"><input type="` + type_input3 + `" name="dtl_a_realisai_persen_before[]" id="dtl_a_realisai_persen_before" class="dtl_a_realisai_persen_before form-control w-auto ` + class_item3 + `_persen" style="text-align: center;" value="${realisai_persen}" readonly></td>
                                                            <td align="center">
                                                                <input type="` + type_input3 + `" id="dtl_a_target_today" class="dtl_a_target_today form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item3 + `_today"" style="text-align: center;" value="${target_akumulatif}" readonly>
                                                                <input type="hidden" name="dtl_a_target_today[]" id="dtl_a_target_today" class="dtl_a_target_today form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item3 + `_today"" style="text-align: center;" value="${target_akumulatif}" readonly>
                                                            </td>
                                                            <td align="center"><input type="` + type_input3 + `" name="dtl_a_target_persen_today[]" id="dtl_a_target_persen_today" class="dtl_a_target_persen_today form-control w-auto ` + class_item3 + `_persen" style="text-align: center;" value="${target_persen}" readonly></td>
                                                            <td align="center">
                                                                <input type="` + type_input3 + `" id="dtl_a_realisai_today" class="dtl_a_realisai_today form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item3 + `_today" style="text-align: center;" value="${akumulatif}" readonly>
                                                                <input type="hidden" name="dtl_a_realisai_today[]" id="dtl_a_realisai_today" class="dtl_a_realisai_today form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item3 + `_today" style="text-align: center;" value="${akumulatif}" readonly>
                                                            </td>
                                                            <td align="center"><input type="` + type_input3 + `" name="dtl_a_realisai_persen_today[]" id="dtl_a_realisai_persen_today" class="dtl_a_realisai_persen_today form-control w-auto ` + class_item3 + `_persen" style="text-align: center;" value="${persen}" readonly></td>
                                                            <td align="center">
                                                                <input type="` + type_input3 + `" id="dtl_a_target_next" class="dtl_a_target_next form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item3 + `_today"" style="text-align: center;" value="0" readonly>
                                                                <input type="hidden" name="dtl_a_target_next[]" id="dtl_a_target_next" class="dtl_a_target_next form-control angkadantitik w-auto hitung_total hitung_persen ` + class_item3 + `_today"" style="text-align: center;" value="0" readonly>
                                                            </td>
                                                            <td align="center"><input type="` + type_input3 + `" name="dtl_a_target_persen_next[]" id="dtl_a_target_persen_next" class="dtl_a_target_persen_next form-control w-auto ` + class_item3 + `_persen" style="text-align: center;" value="0" readonly></td>
                                                        </tr>`;
                                    } else {}
                                    // total Distribusi Air per jenis air 
                                    if (dtl_a_key == 0) {
                                        dtl_a_total_realisai_akumulatif = parseFloat(realisai_akumulatif);
                                        dtl_a_total_target_akumulatif = parseFloat(target_akumulatif);
                                        dtl_a_total_akumulatif = parseFloat(akumulatif);
                                        dtl_a_total_persen = parseFloat(persen);
                                        dtl_a_total_target_persen = parseFloat(target_persen);
                                        dtl_a_total_realisai_persen = parseFloat(realisai_persen);
                                    } else {
                                        let dt_tes = typeof(result.data.result_frmfss317[dtl_a_key - 1]) == 'undefined' ? '' : result.data.result_frmfss317[dtl_a_key - 1].item2;
                                        if (dtl_a_row.item2 == dt_tes) {
                                            dtl_a_total_realisai_akumulatif += parseFloat(realisai_akumulatif);
                                            dtl_a_total_target_akumulatif += parseFloat(target_akumulatif);
                                            dtl_a_total_akumulatif += parseFloat(akumulatif);
                                            dtl_a_total_persen += parseFloat(persen);
                                            dtl_a_total_target_persen += parseFloat(target_persen);
                                            dtl_a_total_realisai_persen += parseFloat(realisai_persen);
                                        } else {
                                            dtl_a_total_realisai_akumulatif = parseFloat(realisai_akumulatif);
                                            dtl_a_total_target_akumulatif = parseFloat(target_akumulatif);
                                            dtl_a_total_akumulatif = parseFloat(akumulatif);
                                            dtl_a_total_persen = parseFloat(persen);
                                            dtl_a_total_target_persen = parseFloat(target_persen);
                                            dtl_a_total_realisai_persen = parseFloat(realisai_persen);
                                        }
                                    }
                                    if (dtl_a_row.num_row_b_desc == 1) {
                                        if (dtl_a_row.item1 == 'Distribusi Air') {
                                            list_dtl_a += `<tr>
                                                                <td class="table-secondary align-middle text-left" colspan="2"><b>Total ${dtl_a_row.item2.replace(/[\d.]/g,'')}</b></td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_before_total_` + class_item2 + `_akumulatif">` + parseFloat(dtl_a_total_realisai_akumulatif).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_before_total_` + class_item2 + `_persen">` + parseFloat(dtl_a_total_target_persen).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_today_total_` + class_item2 + `_akumulatif">` + parseFloat(dtl_a_total_target_akumulatif).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_today_total_` + class_item2 + `_persen">` + parseFloat(dtl_a_total_realisai_persen).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_today_total_` + class_item2 + `_akumulatif">` + parseFloat(dtl_a_total_akumulatif).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_today_total_` + class_item2 + `_persen">` + parseFloat(dtl_a_total_persen).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_next_total_` + class_item2 + `_akumulatif"></td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_next_total_` + class_item2 + `_persen"></td>
                                                            </tr>`;
                                        } else if (dtl_a_row.item1 == 'Rp / ton air') {
                                            if (dtl_a_row.item2 == '5.1 Total Proses Air WTD') {
                                                td_total = '<b>Total (Non Efektif)</b>';
                                            } else {
                                                td_total = '<b>Total HPP Efektif</b>';
                                            }
                                            list_dtl_a += `<tr>
                                                                    <td class="table-secondary align-middle text-left" colspan="2">` + td_total + `</td>
                                                                    <td class="table-secondary align-middle text-center dtl_a_realisai_before_total_` + class_item2 + `_akumulatif">` + parseFloat(dtl_a_total_realisai_akumulatif).toFixed(1) + `</td>
                                                                    <td class="table-secondary align-middle text-center dtl_a_realisai_persen_before_total_` + class_item2 + `_persen">` + parseFloat(dtl_a_total_target_persen).toFixed(1) + `</td>
                                                                    <td class="table-secondary align-middle text-center dtl_a_target_today_total_` + class_item2 + `_akumulatif">` + parseFloat(dtl_a_total_target_akumulatif).toFixed(1) + `</td>
                                                                    <td class="table-secondary align-middle text-center dtl_a_target_persen_today_total_` + class_item2 + `_persen">` + parseFloat(dtl_a_total_realisai_persen).toFixed(1) + `</td>
                                                                    <td class="table-secondary align-middle text-center dtl_a_realisai_today_total_` + class_item2 + `_akumulatif">` + parseFloat(dtl_a_total_akumulatif).toFixed(1) + `</td>
                                                                    <td class="table-secondary align-middle text-center dtl_a_realisai_persen_today_total_` + class_item2 + `_persen">` + parseFloat(dtl_a_total_persen).toFixed(1) + `</td>
                                                                    <td class="table-secondary align-middle text-center dtl_a_target_next_total_` + class_item2 + `_akumulatif"></td>
                                                                    <td class="table-secondary align-middle text-center dtl_a_target_persen_next_total_` + class_item2 + `_persen"></td>
                                                                </tr>`;
                                        }
                                    }
                                    // total seluruhnya
                                    if (dtl_a_row.num_row_desc == 1) {
                                        if (dtl_a_row.item1 == 'Distribusi Air') {
                                            list_dtl_a += `<tr>
                                                                <td class="table-secondary align-middle text-left" colspan="2"><b>Total ${dtl_a_row.item1}</b></td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_before_total_all_` + class_item1 + `_akumulatif">` + parseFloat(dtl_a_total_all_target_akumulatif).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_before_total_all_` + class_item1 + `_persen">` + parseFloat(dtl_a_total_all_target_persen).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_today_total_all_` + class_item1 + `_akumulatif">` + parseFloat(dtl_a_total_all_realisai_akumulatif).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_today_total_all_` + class_item1 + `_persen">` + parseFloat(dtl_a_total_all_realisai_persen).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_today_total_all_` + class_item1 + `_akumulatif">` + parseFloat(dtl_a_total_all_akumulatif).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_today_total_all_` + class_item1 + `_persen">` + parseFloat(dtl_a_total_all_persen).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_next_total_all_` + class_item1 + `_akumulatif"></td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_next_total_all_` + class_item1 + `_persen"></td>
                                                            </tr>`;
                                        } else if (dtl_a_row.item1 == 'Biaya Operasional ( Rp )') {
                                            list_dtl_a += `<tr>
                                                                <td class="table-secondary align-middle text-left" colspan="2"><b>Total ${dtl_a_row.item1}</b></td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_before_total_all_` + class_item1 + `_akumulatif">` + parseFloat(dtl_a_total_all_target_akumulatif).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_before_total_all_` + class_item1 + `_persen">` + parseFloat(dtl_a_total_all_target_persen).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_today_total_all_` + class_item1 + `_akumulatif">` + parseFloat(dtl_a_total_all_realisai_akumulatif).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_today_total_all_` + class_item1 + `_persen">` + parseFloat(dtl_a_total_all_realisai_persen).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_today_total_all_` + class_item1 + `_akumulatif">` + parseFloat(dtl_a_total_all_akumulatif).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_today_total_all_` + class_item1 + `_persen">` + parseFloat(dtl_a_total_all_persen).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_next_total_all_` + class_item1 + `_akumulatif"></td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_next_total_all_` + class_item1 + `_persen"></td>
                                                            </tr>`;
                                        } else if (dtl_a_row.item1 == 'Tenaga kerja') {
                                            list_dtl_a += `<tr>
                                                                <td class="table-secondary align-middle text-left" colspan="2"><b>Total ${dtl_a_row.item1}</b></td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_before_total_all_` + class_item1 + `_akumulatif">` + parseFloat(dtl_a_total_all_target_akumulatif).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_before_total_all_` + class_item1 + `_persen">` + parseFloat(dtl_a_total_all_target_persen).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_today_total_all_` + class_item1 + `_akumulatif">` + parseFloat(dtl_a_total_all_realisai_akumulatif).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_today_total_all_` + class_item1 + `_persen">` + parseFloat(dtl_a_total_all_realisai_persen).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_today_total_all_` + class_item1 + `_akumulatif">` + parseFloat(dtl_a_total_all_akumulatif).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_realisai_persen_today_total_all_` + class_item1 + `_persen">` + parseFloat(dtl_a_total_all_persen).toFixed(1) + `</td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_next_total_all_` + class_item1 + `_akumulatif"></td>
                                                                <td class="table-secondary align-middle text-center dtl_a_target_persen_next_total_all_` + class_item1 + `_persen"></td>
                                                            </tr>`;
                                        }
                                    }
                                });
                            }
                            $('#tbody_dtl_a').empty().append(list_dtl_a);
                            // dtl a end

                            $('.dtsampel_frmfss317_headerid').val(dtsampel_frmfss317_headerid);
                            $('.dtsampel_frmfss317_complete_date').val(dtsampel_frmfss317_complete_date);
                            $('.dtsampel_frmfss317_complete_time').val(dtsampel_frmfss317_complete_time);
                        }

                        notif_btnconfirm_custom(result.vstatus, result.pesan);
                        get_rp_proses_air();
                        get_target_rumus();
                        get_air_efektif();
                        get_rata2_jam('dtl_a_target_next');
                        get_rata2_jam('dtl_a_realisai_today');
                        get_rata2_jam('dtl_a_target_today');
                        get_rata2_jam('dtl_a_realisai_before');
                        get_effs('dtl_a_realisai_before');
                        get_effs('dtl_a_target_today');

                        total_penggunaan_air('dtl_a_target_next', '2biayaoperasionalrp');
                        total_penggunaan_air('dtl_a_target_next', '6distribusiair');

                        total_penggunaan_per_air('dtl_a_target_next', '5rptonair_totalprosesairwtd');
                        total_penggunaan_per_air('dtl_a_target_next', '5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd');
                        total_penggunaan_per_air('dtl_a_target_next', '6distribusiair_aftersandfilter');
                        total_penggunaan_per_air('dtl_a_target_next', '6distribusiair_aftercarbonfilter');
                        total_penggunaan_per_air('dtl_a_target_next', '6distribusiair_aftersoftener');
                        total_penggunaan_per_air('dtl_a_target_next', '6distribusiair_afterreverseosmosis');
                        total_penggunaan_per_air('dtl_a_target_next', '6distribusiair_afterultrafilter');

                        persen_rp_air('dtl_a_target_next', '2biayaoperasionalrp', 'dtl_a_target_persen_next');
                        persen_rp_air('dtl_a_target_next', '6distribusiair', 'dtl_a_target_persen_next');
                        persen_rp_air('dtl_a_target_next', '7tenagakerja', 'dtl_a_target_persen_next');
                    }
                });
            }
        }

        $('input:text[class~=dtl_a_realisai_before]').change(function() {
            var val_relasai_before = $(this).val().replace('.', '').replace('.', '');
            var val_relasai_today = $(this).closest('tr').find('input:hidden[class~=dtl_a_realisai_today]').val();

            var dt_target_next = (parseFloat(val_relasai_before) + parseFloat(val_relasai_today)) / 2;
            if (!isNaN(dt_target_next)) {
                $(this).closest('tr').find('input:hidden[class~=dtl_a_target_next]').val(dt_target_next);
                $(this).closest('tr').find('input:text[class~=dtl_a_target_next]').val(formatRupiah(dt_target_next.toString(), ''));
            }
        });
        $('input:text[class~=dtl_a_realisai_today]').change(function() {
            if ($(this).closest('tr').find('input:text[class~=dtl_a_realisai_before]').val() != '') {
                $(this).closest('tr').find('input:text[class~=dtl_a_realisai_before]').trigger('change');
            }
        });
    });

    function get_rata2_jam(class_dtl_rata2) {
        var total_proses_air = $('[class~=' + class_dtl_rata2 + '][class*=1outputair_totalprosesair_today]').val();
        var lama_produksi = $('[class~=' + class_dtl_rata2 + '][class*=1outputair_lamaproduksi_today]').val();

        var rata2_jam = (parseFloat(total_proses_air) / parseFloat(lama_produksi)).toFixed(2);
        if (!isNaN(rata2_jam)) {
            $('[class~=' + class_dtl_rata2 + '][class*=1outputair_rataratajam_today]').val(rata2_jam);
        }
    }

    function get_effs(class_dtl_a) {
        $('[class~=' + class_dtl_a + '][class*=3pemakaianbahankimia_alsulfattawas_today]').change(function() {
            var that_val = $(this).val();
            var total_penggunaan_air = $('[class~=' + class_dtl_a + '][class*=1outputair_totalprosesair_today]').val();

            var total_eff = (parseFloat(total_penggunaan_air) / parseFloat(that_val)).toFixed(2);
            $('[class~=' + class_dtl_a + '][class*=4effs_alsulfattawas_today]').val(total_eff);
        });
        $('[class~=' + class_dtl_a + '][class*=3pemakaianbahankimia_cousticesoda_today]').change(function() {
            var that_val = $(this).val();
            var total_penggunaan_air = $('[class~=' + class_dtl_a + '][class*=1outputair_totalprosesair_today]').val();

            var total_eff = (parseFloat(total_penggunaan_air) / parseFloat(that_val)).toFixed(2);
            $('[class~=' + class_dtl_a + '][class*=4effs_cousticesoda_today]').val(total_eff);
        });
        $('[class~=' + class_dtl_a + '][class*=3pemakaianbahankimia_tcca_today]').change(function() {
            var that_val = $(this).val();
            var total_penggunaan_air = $('[class~=' + class_dtl_a + '][class*=1outputair_totalprosesair_today]').val();

            var total_eff = (parseFloat(total_penggunaan_air) / parseFloat(that_val)).toFixed(2);
            $('[class~=' + class_dtl_a + '][class*=4effs_tcca_today]').val(total_eff);
        });
    }

    function get_air_efektif() {
        $('[class~=dtl_a_realisai_before][class*=1outputair_totalpakaiair_today]').change(function() {
            var that_val = $(this).val();
            var val_air_wtd = $('[class*=1outputair_pemakaianairolehwtd_today]').val();

            var total_air_efektif = eval(that_val) - eval(val_air_wtd);
            if (!isNaN(total_air_efektif)) {
                $('input:hidden[class~=dtl_a_realisai_before][class*=1outputair_pemakaianairefektiftotalpakaiairpemakaianairolehwtd_today]').val(total_air_efektif)
                $('input:text[class~=dtl_a_realisai_before][class*=1outputair_pemakaianairefektiftotalpakaiairpemakaianairolehwtd_today]').val(formatRupiah(total_air_efektif.toString(), ''))
            }
        });
        $('[class~=dtl_a_realisai_before][class*=1outputair_pemakaianairolehwtd_today]').change(function() {
            var val_total_air = $('[class~=dtl_a_realisai_before][class*=1outputair_totalpakaiair_today]').val();
            if (val_total_air != '') {
                $('[class~=dtl_a_realisai_before][class*=1outputair_totalpakaiair_today]').trigger('change');
            }
        })
    }
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined || prefix == '' ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function get_rp_proses_air() {
        $(document).on('keyup', '[class*=2biayaoperasionalrp]', function() {
            var class_attr = $(this).attr('class').split(' ');
            var id_item1 = $(this).attr('id');
            var class_item2 = class_attr[6].split('_');
            $(this).closest('tr').find('input:text[class~=' + id_item1 + '][class*=2biayaoperasionalrp_' + class_item2[1] + '_today]').val(formatRupiah($(this).val(), ''));

        });
        $(document).on('change', '[class*=2biayaoperasionalrp]', function() {
            var val_oprasional = $(this).val().replace('.', '').replace('.', '');

            var class_attr = $(this).attr('class').split(' ');
            var id_item1 = $(this).attr('id');
            var class_item2 = class_attr[6].split('_')[1];

            $(this).closest('tr').find('input:hidden[class~=' + id_item1 + '][class*=2biayaoperasionalrp_' + class_item2 + '_today]').val(val_oprasional);
            var val_total_pakai_air = $('input:hidden[class~=' + id_item1 + '][class*=1outputair_totalpakaiair]').val();
            var val_total_pakai_air_efektif = $('input:hidden[class~=' + id_item1 + '][class*=1outputair_pemakaianairefektiftotalpakaiairpemakaianairolehwtd]').val();
            if (val_total_pakai_air == '' && val_total_pakai_air_efektif == '') {
                $('[class~=' + id_item1 + '][class*=5rptonair_totalprosesairwtd_' + class_item2 + '_today]').val('0');
                $('[class~=' + id_item1 + '][class*=5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd_' + class_item2 + '_today]').val('0');
                $('.' + id_item1 + '_total_5rptonair_totalprosesairwtd_akumulatif').empty().append('0');
                $('.' + id_item1 + '_total_5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd_akumulatif').empty().append('0');
                notif_btnconfirm_custom('error', 'Maaf Total Pakai Air dan Pemakaian air Efektif Tidak Boleh Kosong...!');
            } else {
                // get proses air
                var rp_ton_air = (parseFloat(val_total_pakai_air) / parseFloat(val_oprasional)).toFixed(2);
                $('input:hidden[class~=' + id_item1 + '][class*=5rptonair_totalprosesairwtd_' + class_item2 + '_today]').val(rp_ton_air);
                $('input:text[class~=' + id_item1 + '][class*=5rptonair_totalprosesairwtd_' + class_item2 + '_today]').val(formatRupiah(rp_ton_air.toString(), ''));

                // get pemakaian air
                var rp_ton_air_efektif = (parseFloat(val_total_pakai_air_efektif) / parseFloat(val_oprasional)).toFixed(2);

                $('input:hidden[class~=' + id_item1 + '][class*=5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd_' + class_item2 + '_today]').val(rp_ton_air_efektif);

                $('input:text[class~=' + id_item1 + '][class*=5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd_' + class_item2 + '_today]').val(formatRupiah(rp_ton_air_efektif.toString(), ''));

                // get total proses air
                var total_proses_air_wtd = 0;
                $('input:hidden[class~=' + id_item1 + '][class*=5rptonair_totalprosesairwtd]').each(function() {
                    total_proses_air_wtd += parseFloat($(this).val());
                });
                $('.' + id_item1 + '_total_5rptonair_totalprosesairwtd_akumulatif').empty().append(total_proses_air_wtd);
                // get total pemakaian air
                var total_pemakaian_air = 0;
                $('input:hidden[class~=' + id_item1 + '][class*=5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd]').each(function() {
                    total_pemakaian_air += parseFloat($(this).val());
                });
                $('.' + id_item1 + '_total_5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd_akumulatif').empty().append(total_pemakaian_air);
            }

            // get total all pemakaian air
            var total_all_rp_air = 0;
            $('[class~=' + id_item1 + '][class*=5rptonair]').each(function() {
                if ($(this).val() != '') {
                    total_all_rp_air += parseFloat($(this).val());
                }
            });
            $('.' + id_item1 + '_total_all_5rptonair_akumulatif').empty().append(total_all_rp_air);
        });
        $(document).on('change', '[class*=hitung_total]', function() {
            var id = $(this).attr('id');
            var class_name = $(this).attr('class').split(' ')[6].split('_')[0];
            // get total all
            if (class_name != '1outputair' && class_name != '3pemakaianbahankimia' && class_name != '4effs') {
                total_penggunaan_air(id, class_name);
            }
        });
        $(document).on('change', '[class*=hitung_persen]', function() {
            var id = $(this).attr('id');
            var class_name = $(this).attr('class').split(' ')[6].split('_')[0];
            var class_name2 = $(this).closest('td').next().find('input').attr('class').split(' ')[0];
            // get total persen
            if (class_name != '1outputair' && class_name != '3pemakaianbahankimia' && class_name != '4effs') {
                persen_rp_air(id, class_name, class_name2);
            }
        });
    }

    function get_target_rumus() {
        var total_all_target = 0;
        $.each($('input:text[class~=dtl_a_realisai_today]'), function() {
            var val_relasai_today = $(this).val().replace('.', '').replace('.', '');
            var val_relasai_before = $(this).closest('tr').find('input:hidden[class~=dtl_a_realisai_before]').val();

            var dt_target_next = (parseFloat(val_relasai_before) + parseFloat(val_relasai_today)) / 2;
            if (!isNaN(dt_target_next)) {
                $(this).closest('tr').find('input:hidden[class~=dtl_a_target_next]').val(dt_target_next);
                $(this).closest('tr').find('input:text[class~=dtl_a_target_next]').val(formatRupiah((dt_target_next).toString(), ''));
            }
        });
    }

    function persen_rp_air(id, class_name, class_name2) {
        var total_all_persen = 0;
        var type_total = '';
        var col = '';
        var arr = [];
        $('input:hidden[class~=' + id + '][class*=' + class_name + ']').each(function() {

            var col_class = $(this).attr('class').split(' ')[6].split('_')[1];
            var col_class2 = $(this).attr('class').split(' ')[6].split('_')[2];
            var col_class3 = $(this).attr('class').split(' ')[6].split('_')[3];
            var that_val = $(this).val() == '' ? 0 : $(this).val();
            var text_total_all = $('.' + id + '_total_all_' + class_name + '_akumulatif').text().replace('.', '').replace('.', '');
            var val_persen = (parseFloat(that_val) / parseFloat(text_total_all) * 100).toFixed(1);
            if (!isNaN(val_persen)) {
                if (col_class2 == 'today' || col_class3 == 'today') {
                    $('[class~=' + class_name2 + '][class*=' + class_name + '_' + col_class + '_persen]').val(val_persen);
                    type_total = '_all';
                    total_all_persen += parseFloat(val_persen);
                } else {
                    $('[class~=' + class_name2 + '][class*=' + class_name + '_' + col_class + '_' + col_class2 + '_persen]').val(val_persen);
                    total_all_persen += parseFloat(val_persen);
                    type_total = '';
                    arr.push(col_class);
                }
            }
        });
        $('.' + class_name2 + '_total' + type_total + '_' + class_name + '_persen').empty().append(total_all_persen.toFixed(1));


        // persen total proses air wtd
        var total_all2_persen = 0;
        $('input:hidden[class~=' + id + '][class*=5rptonair_totalprosesairwtd]').each(function() {
            var col_class = $(this).attr('class').split(' ')[6].split('_')[2];
            var that_val = $(this).val() == '' ? 0 : $(this).val();
            var text_total_all = $('.' + id + '_total_5rptonair_totalprosesairwtd_akumulatif').text().replace('.', '').replace('.', '');
            var val_persen = (parseFloat(that_val) / parseFloat(text_total_all) * 100).toFixed(1);
            if (!isNaN(val_persen)) {
                $('[class~=' + class_name2 + '][class*=5rptonair_totalprosesairwtd_' + col_class + '_persen]').val(val_persen);
                total_all2_persen += parseFloat(val_persen);
            } else {}

        });
        $('.' + class_name2 + '_total_5rptonair_totalprosesairwtd_persen').empty().append((total_all2_persen).toFixed(1));

        // persen total proses air wtd
        var total_all3_persen = 0;
        $('input:hidden[class~=' + id + '][class*=5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd]').each(function() {
            var col_class = $(this).attr('class').split(' ')[6].split('_')[2];
            var that_val = $(this).val() == '' ? 0 : $(this).val();
            var text_total_all = $('.' + id + '_total_5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd_akumulatif').text().replace('.', '').replace('.', '');
            var val_persen = (parseFloat(that_val) / parseFloat(text_total_all) * 100).toFixed(1);
            if (!isNaN(val_persen)) {
                $('[class~=' + class_name2 + '][class*=5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd_' + col_class + '_persen]').val(val_persen);
                total_all3_persen += parseFloat(val_persen);
            } else {}
        });
        $('.' + class_name2 + '_total_5rptonair_pemakaianairefektiftotalpakaiairpemakaianolehwtd_persen').empty().append((total_all3_persen).toFixed(1));

        // persen total distribusi air
        var total_all4_persen = 0;
        $('input:hidden[class~=' + id + '][class*=6distribusiair_aftersandfilter]').each(function() {
            var col_class = $(this).attr('class').split(' ')[6].split('_')[2];
            var that_val = $(this).val() == '' ? 0 : $(this).val();
            var text_total_all = $('.' + id + '_total_all_6distribusiair_akumulatif').text().replace('.', '').replace('.', '');
            var val_persen = (parseFloat(that_val) / parseFloat(text_total_all) * 100).toFixed(1);
            if (!isNaN(val_persen)) {
                $('[class~=' + class_name2 + '][class*=6distribusiair_aftersandfilter_' + col_class + '_persen]').val(val_persen);
                total_all4_persen += parseFloat(val_persen);
            } else {}
        });
        $('.' + class_name2 + '_total_6distribusiair_aftersandfilter_persen').empty().append((total_all4_persen).toFixed(1));
        var total_all5_persen = 0;
        $('input:hidden[class~=' + id + '][class*=6distribusiair_aftercarbonfilter]').each(function() {
            var col_class = $(this).attr('class').split(' ')[6].split('_')[2];
            var that_val = $(this).val() == '' ? 0 : $(this).val();
            var text_total_all = $('.' + id + '_total_all_6distribusiair_akumulatif').text().replace('.', '').replace('.', '');
            var val_persen = (parseFloat(that_val) / parseFloat(text_total_all) * 100).toFixed(1);
            if (!isNaN(val_persen)) {
                $('[class~=' + class_name2 + '][class*=6distribusiair_aftercarbonfilter_' + col_class + '_persen]').val(val_persen);
                total_all5_persen += parseFloat(val_persen);
            } else {}
        });
        $('.' + class_name2 + '_total_6distribusiair_aftercarbonfilter_persen').empty().append((total_all5_persen).toFixed(1));
        var total_all6_persen = 0;
        $('input:hidden[class~=' + id + '][class*=6distribusiair_aftersoftener]').each(function() {
            var col_class = $(this).attr('class').split(' ')[6].split('_')[2];
            var that_val = $(this).val() == '' ? 0 : $(this).val();
            var text_total_all = $('.' + id + '_total_all_6distribusiair_akumulatif').text().replace('.', '').replace('.', '');
            var val_persen = (parseFloat(that_val) / parseFloat(text_total_all) * 100).toFixed(1);
            if (!isNaN(val_persen)) {
                $('[class~=' + class_name2 + '][class*=6distribusiair_aftersoftener_' + col_class + '_persen]').val(val_persen);
                total_all6_persen += parseFloat(val_persen);
            } else {}
        });
        $('.' + class_name2 + '_total_6distribusiair_aftersoftener_persen').empty().append((total_all6_persen).toFixed(1));
        var total_all7_persen = 0;
        $('input:hidden[class~=' + id + '][class*=6distribusiair_afterreverseosmosis]').each(function() {
            var col_class = $(this).attr('class').split(' ')[6].split('_')[2];
            var that_val = $(this).val() == '' ? 0 : $(this).val();
            var text_total_all = $('.' + id + '_total_all_6distribusiair_akumulatif').text().replace('.', '').replace('.', '');
            var val_persen = (parseFloat(that_val) / parseFloat(text_total_all) * 100).toFixed(1);
            if (!isNaN(val_persen)) {
                $('[class~=' + class_name2 + '][class*=6distribusiair_afterreverseosmosis_' + col_class + '_persen]').val(val_persen);
                total_all7_persen += parseFloat(val_persen);
            } else {}
        });
        $('.' + class_name2 + '_total_6distribusiair_afterreverseosmosis_persen').empty().append((total_all7_persen).toFixed(1));
        var total_all8_persen = 0;
        $('input:hidden[class~=' + id + '][class*=6distribusiair_afterultrafilter]').each(function() {
            var col_class = $(this).attr('class').split(' ')[6].split('_')[2];
            var that_val = $(this).val() == '' ? 0 : $(this).val();
            var text_total_all = $('.' + id + '_total_all_6distribusiair_akumulatif').text().replace('.', '').replace('.', '');
            var val_persen = (parseFloat(that_val) / parseFloat(text_total_all) * 100).toFixed(1);
            if (!isNaN(val_persen)) {
                $('[class~=' + class_name2 + '][class*=6distribusiair_afterultrafilter_' + col_class + '_persen]').val(val_persen);
                total_all8_persen += parseFloat(val_persen);
            } else {}
        });
        $('.' + class_name2 + '_total_6distribusiair_afterultrafilter_persen').empty().append((total_all8_persen).toFixed(1));
    }

    function total_penggunaan_air(id, class_name) {
        var v = [];
        $('input:hidden[class~=' + id + '][class*=' + class_name + ']').each(function() {
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
        if (total != 0 || !isNaN(total)) {
            $('.' + id + '_total_all_' + class_name + '_akumulatif').empty().append(formatRupiah((total).toString(), ''));
        } else {
            $('.' + id + '_total_all_' + class_name + '_akumulatif').empty().append('0');
        }
    }

    function total_penggunaan_per_air(id, class_name) {

        var v = [];
        $('[class~=' + id + '][class*=' + class_name + ']').each(function() {
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
        if (total != 0 || !isNaN(total)) {
            $('.' + id + '_total_' + class_name + '_akumulatif').empty().append((total).toFixed(1));
        } else {
            $('.' + id + '_total_' + class_name + '_akumulatif').empty().append('0');
        }
    }
</script>



<?php $this->load->view('template/footbarend'); ?>