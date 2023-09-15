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
    $frmket       = $dt_form->formket;
    $createby     = $dt_form->createby;
    $updateby     = $dt_form->updateby;
}

if (isset($dtheader)) {
    $aksi  = "dtupdate";

    foreach ($dtheader as $header) {
        $headerid       = $header->headerid;

        $comment        = $header->comment;
        $comment_by     = $header->comment_by;
        $comment_time   = $header->comment_time;
        $comment_date   = date("d-m-Y", strtotime($header->comment_date));

        $create_date    = date("d-m-Y", strtotime($header->create_date));
        $docno          = $header->docno;
        $jam1_hdr       = $header->jam1_hdr;
        $jam2_hdr       = $header->jam2_hdr;
        $jam3_hdr       = $header->jam3_hdr;
        $jam4_hdr       = $header->jam4_hdr;
        $jam5_hdr       = $header->jam5_hdr;
        $jam6_hdr       = $header->jam6_hdr;
        $jam7_hdr       = $header->jam7_hdr;
        $jam8_hdr       = $header->jam8_hdr;
        $jam9_hdr       = $header->jam9_hdr;
        $jam10_hdr      = $header->jam10_hdr;
        $jam11_hdr      = $header->jam11_hdr;
        $jam12_hdr      = $header->jam12_hdr;
        $jam13_hdr      = $header->jam13_hdr;
        $jam14_hdr      = $header->jam14_hdr;
        $jam15_hdr      = $header->jam15_hdr;
        $jam16_hdr      = $header->jam16_hdr;
        $jam17_hdr      = $header->jam17_hdr;
        $jam18_hdr      = $header->jam18_hdr;
        $jam19_hdr      = $header->jam19_hdr;
        $jam20_hdr      = $header->jam20_hdr;
        $jam21_hdr      = $header->jam21_hdr;
        $jam22_hdr      = $header->jam22_hdr;
        $jam23_hdr      = $header->jam23_hdr;
        $jam24_hdr      = $header->jam24_hdr;
        $jam25_hdr      = $header->jam25_hdr;
        $jam26_hdr      = $header->jam26_hdr;
        $jam27_hdr      = $header->jam27_hdr;
        $jam28_hdr      = $header->jam28_hdr;
        $jam29_hdr      = $header->jam29_hdr;
        $jam30_hdr      = $header->jam30_hdr;
        $jam31_hdr      = $header->jam31_hdr;
        $jam32_hdr      = $header->jam32_hdr;
        $jam33_hdr      = $header->jam33_hdr;
        $jam34_hdr      = $header->jam34_hdr;
        $total_soft     = $header->total_soft;
        $total_pro      = $header->total_pro;
        $total_feed     = $header->total_feed;
        $total_product  = $header->total_product;
        $total_reject   = $header->total_reject;
        $keterangan_hdr = $header->keterangan_hdr;
    }
} else if (isset($message)) {
    $aksi           = "dtsave";
    $create_date    = '';
    $docno          = '';
    $jam1_hdr       = '';
    $jam2_hdr       = '';
    $jam3_hdr       = '';
    $jam4_hdr       = '';
    $jam5_hdr       = '';
    $jam6_hdr       = '';
    $jam7_hdr       = '';
    $jam8_hdr       = '';
    $jam9_hdr       = '';
    $jam10_hdr      = '';
    $jam11_hdr      = '';
    $jam12_hdr      = '';
    $jam13_hdr      = '';
    $jam14_hdr      = '';
    $jam15_hdr      = '';
    $jam16_hdr      = '';
    $jam17_hdr      = '';
    $jam18_hdr      = '';
    $jam19_hdr      = '';
    $jam20_hdr      = '';
    $jam21_hdr      = '';
    $jam22_hdr      = '';
    $jam23_hdr      = '';
    $jam24_hdr      = '';
    $jam25_hdr      = '';
    $jam26_hdr      = '';
    $jam27_hdr      = '';
    $jam28_hdr      = '';
    $jam29_hdr      = '';
    $jam30_hdr      = '';
    $jam31_hdr      = '';
    $jam32_hdr      = '';
    $jam33_hdr      = '';
    $jam34_hdr      = '';
    $total_soft     = '';
    $total_pro      = '';
    $total_feed     = '';
    $total_product  = '';
    $total_reject   = '';
    $keterangan_hdr = '';
} else {
    $aksi           = "dtsave";
    $create_date    = date("d-m-Y", strtotime($dtcreate_date));;
    $docno          = '';
    $jam1_hdr       = '';
    $jam2_hdr       = '';
    $jam3_hdr       = '';
    $jam4_hdr       = '';
    $jam5_hdr       = '';
    $jam6_hdr       = '';
    $jam7_hdr       = '';
    $jam8_hdr       = '';
    $jam9_hdr       = '';
    $jam10_hdr      = '';
    $jam11_hdr      = '';
    $jam12_hdr      = '';
    $jam13_hdr      = '';
    $jam14_hdr      = '';
    $jam15_hdr      = '';
    $jam16_hdr      = '';
    $jam17_hdr      = '';
    $jam18_hdr      = '';
    $jam19_hdr      = '';
    $jam20_hdr      = '';
    $jam21_hdr      = '';
    $jam22_hdr      = '';
    $jam23_hdr      = '';
    $jam24_hdr      = '';
    $jam25_hdr      = '';
    $jam26_hdr      = '';
    $jam27_hdr      = '';
    $jam28_hdr      = '';
    $jam29_hdr      = '';
    $jam30_hdr      = '';
    $jam31_hdr      = '';
    $jam32_hdr      = '';
    $jam33_hdr      = '';
    $jam34_hdr      = '';
    $total_soft     = '';
    $total_pro      = '';
    $total_feed     = '';
    $total_product  = '';
    $total_reject   = '';
    $keterangan_hdr = '';
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

                        <form action="<?= base_url('form_input/C_form' . $frmkd . '_' . $frmvrs . '/' . 'form' . '/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="<?= $frmkd ?>" name="<?= $frmkd ?>" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
                            <div class="row mb-1">
                                <div class="col-6">
                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?= $headerid; ?>" id="headerid" class="headerid">
                                    <?php
                                    } ?>

                                    <input type="hidden" name="frmkd" value="<?= $frmkd; ?>" id="frmkd" class="frmkd">
                                    <input type="hidden" name="frmvrs" value="<?= $frmvrs; ?>" id="frmvrs" class="frmvrs">

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Tanggal Laporan
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($dtheader)) { ?>
                                                <input type="text" name="create_date" id="create_date" class="form-control create_date" value="<?= $create_date; ?>" required>
                                            <?php
                                            } else { ?>
                                                <input type="text" name="create_date" id="create_date" class="form-control datepicker maskdate create_date" value="<?= $create_date; ?>" required>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            No. Dokumen
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="docno" id="docno" class="form-control docno dtopen_blok" value="<?= $docno; ?>" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h5>KONTROL PARAMETER OPERASIONAL MESIN REVERSE OSMOSIS 40 m3 / jam</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="table-primary align-middle text-center" rowspan="3">NAMA MESIN</th>
                                                    <th class="table-primary align-middle text-center" rowspan="3">KODE</th>
                                                    <th class="table-primary align-middle text-center" rowspan="3">PARAMETER</th>
                                                    <th class="table-primary align-middle text-center" rowspan="1" colspan="34">OPERASI (JAM)</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam1_hdr" id="jam1_hdr" class=" form-control jam1_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam1_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam2_hdr" id="jam2_hdr" class=" form-control jam2_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam2_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam3_hdr" id="jam3_hdr" class=" form-control jam3_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam3_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam4_hdr" id="jam4_hdr" class=" form-control jam4_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam4_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam5_hdr" id="jam5_hdr" class=" form-control jam5_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam5_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam6_hdr" id="jam6_hdr" class=" form-control jam6_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam6_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam7_hdr" id="jam7_hdr" class=" form-control jam7_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam7_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam8_hdr" id="jam8_hdr" class=" form-control jam8_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam8_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam9_hdr" id="jam9_hdr" class=" form-control jam9_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam9_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam10_hdr" id="jam10_hdr" class=" form-control jam10_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam10_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam11_hdr" id="jam11_hdr" class=" form-control jam11_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam11_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam12_hdr" id="jam12_hdr" class=" form-control jam12_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam12_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam13_hdr" id="jam13_hdr" class=" form-control jam13_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam13_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam14_hdr" id="jam14_hdr" class=" form-control jam14_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam14_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam15_hdr" id="jam15_hdr" class=" form-control jam15_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam15_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam16_hdr" id="jam16_hdr" class=" form-control jam16_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam16_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam17_hdr" id="jam17_hdr" class=" form-control jam17_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam17_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam18_hdr" id="jam18_hdr" class=" form-control jam18_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam18_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam19_hdr" id="jam19_hdr" class=" form-control jam19_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam19_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam20_hdr" id="jam20_hdr" class=" form-control jam20_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam20_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam21_hdr" id="jam21_hdr" class=" form-control jam21_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam21_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam22_hdr" id="jam22_hdr" class=" form-control jam22_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam22_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam23_hdr" id="jam23_hdr" class=" form-control jam23_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam23_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam24_hdr" id="jam24_hdr" class=" form-control jam24_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam24_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam25_hdr" id="jam25_hdr" class=" form-control jam25_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam25_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam26_hdr" id="jam26_hdr" class=" form-control jam26_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam26_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam27_hdr" id="jam27_hdr" class=" form-control jam27_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam27_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam28_hdr" id="jam28_hdr" class=" form-control jam28_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam28_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam29_hdr" id="jam29_hdr" class=" form-control jam29_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam29_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam30_hdr" id="jam30_hdr" class=" form-control jam30_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam30_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam31_hdr" id="jam31_hdr" class=" form-control jam31_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam31_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam32_hdr" id="jam32_hdr" class=" form-control jam32_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam32_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam33_hdr" id="jam33_hdr" class=" form-control jam33_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam33_hdr; ?>"></th>
                                                    <th class="table-primary align-middle text-center w-auto"> <input type="text" name="jam34_hdr" id="jam34_hdr" class=" form-control jam34_hdr dtopen_blok masktime w-auto" style="text-align: center;" size="10" value="<?= $jam34_hdr; ?>"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody4">
                                                <?php if (!isset($dtdetaild)) {
                                                    if (isset($message)) {
                                                        for ($i = 0; $i < $jmldtl_4; $i++) { ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control w-auto nama_mesin" name="nama_mesin[]" id="nama_mesin" style="text-align: center;" value="<?php echo set_value('nama_mesin[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto kode_mesin" name="kode_mesin[]" id="kode_mesin" style="text-align: center;" value="<?php echo set_value('kode_mesin[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto parameter" name="parameter[]" id="parameter" style="text-align: center;" value="<?php echo set_value('parameter[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr1" name="dtl_opr1[]" id="dtl_opr1" style="text-align: center;" value="<?php echo set_value('dtl_opr1[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr2" name="dtl_opr2[]" id="dtl_opr2" style="text-align: center;" value="<?php echo set_value('dtl_opr2[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr3" name="dtl_opr3[]" id="dtl_opr3" style="text-align: center;" value="<?php echo set_value('dtl_opr3[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr4" name="dtl_opr4[]" id="dtl_opr4" style="text-align: center;" value="<?php echo set_value('dtl_opr4[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr5" name="dtl_opr5[]" id="dtl_opr5" style="text-align: center;" value="<?php echo set_value('dtl_opr5[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr6" name="dtl_opr6[]" id="dtl_opr6" style="text-align: center;" value="<?php echo set_value('dtl_opr6[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr7" name="dtl_opr7[]" id="dtl_opr7" style="text-align: center;" value="<?php echo set_value('dtl_opr7[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr8" name="dtl_opr8[]" id="dtl_opr8" style="text-align: center;" value="<?php echo set_value('dtl_opr8[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr9" name="dtl_opr9[]" id="dtl_opr9" style="text-align: center;" value="<?php echo set_value('dtl_opr9[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr10" name="dtl_opr10[]" id="dtl_opr10" style="text-align: center;" value="<?php echo set_value('dtl_opr10[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr11" name="dtl_opr11[]" id="dtl_opr11" style="text-align: center;" value="<?php echo set_value('dtl_opr11[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr12" name="dtl_opr12[]" id="dtl_opr12" style="text-align: center;" value="<?php echo set_value('dtl_opr12[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr13" name="dtl_opr13[]" id="dtl_opr13" style="text-align: center;" value="<?php echo set_value('dtl_opr13[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr14" name="dtl_opr14[]" id="dtl_opr14" style="text-align: center;" value="<?php echo set_value('dtl_opr14[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr15" name="dtl_opr15[]" id="dtl_opr15" style="text-align: center;" value="<?php echo set_value('dtl_opr15[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr16" name="dtl_opr16[]" id="dtl_opr16" style="text-align: center;" value="<?php echo set_value('dtl_opr16[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr17" name="dtl_opr17[]" id="dtl_opr17" style="text-align: center;" value="<?php echo set_value('dtl_opr17[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr18" name="dtl_opr18[]" id="dtl_opr18" style="text-align: center;" value="<?php echo set_value('dtl_opr18[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr19" name="dtl_opr19[]" id="dtl_opr19" style="text-align: center;" value="<?php echo set_value('dtl_opr19[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr20" name="dtl_opr20[]" id="dtl_opr20" style="text-align: center;" value="<?php echo set_value('dtl_opr20[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr21" name="dtl_opr21[]" id="dtl_opr21" style="text-align: center;" value="<?php echo set_value('dtl_opr21[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr22" name="dtl_opr22[]" id="dtl_opr22" style="text-align: center;" value="<?php echo set_value('dtl_opr22[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr23" name="dtl_opr23[]" id="dtl_opr23" style="text-align: center;" value="<?php echo set_value('dtl_opr23[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr24" name="dtl_opr24[]" id="dtl_opr24" style="text-align: center;" value="<?php echo set_value('dtl_opr24[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr25" name="dtl_opr25[]" id="dtl_opr25" style="text-align: center;" value="<?php echo set_value('dtl_opr25[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr26" name="dtl_opr26[]" id="dtl_opr26" style="text-align: center;" value="<?php echo set_value('dtl_opr26[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr27" name="dtl_opr27[]" id="dtl_opr27" style="text-align: center;" value="<?php echo set_value('dtl_opr27[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr28" name="dtl_opr28[]" id="dtl_opr28" style="text-align: center;" value="<?php echo set_value('dtl_opr28[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr29" name="dtl_opr29[]" id="dtl_opr29" style="text-align: center;" value="<?php echo set_value('dtl_opr29[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr30" name="dtl_opr30[]" id="dtl_opr30" style="text-align: center;" value="<?php echo set_value('dtl_opr30[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr31" name="dtl_opr31[]" id="dtl_opr31" style="text-align: center;" value="<?php echo set_value('dtl_opr31[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr32" name="dtl_opr32[]" id="dtl_opr32" style="text-align: center;" value="<?php echo set_value('dtl_opr32[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr33" name="dtl_opr33[]" id="dtl_opr33" style="text-align: center;" value="<?php echo set_value('dtl_opr33[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime dtl_opr34" name="dtl_opr34[]" id="dtl_opr34" style="text-align: center;" value="<?php echo set_value('dtl_opr34[' . $i . ']'); ?>"></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
                                                        <tr>
                                                            <td><input type="text" class="form-control w-auto nama_mesin" name="nama_mesin[]" id="nama_mesin" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto kode_mesin" name="kode_mesin[]" id="kode_mesin" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto parameter" name="parameter[]" id="parameter" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr1" name="dtl_opr1[]" id="dtl_opr1" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr2" name="dtl_opr2[]" id="dtl_opr2" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr3" name="dtl_opr3[]" id="dtl_opr3" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr4" name="dtl_opr4[]" id="dtl_opr4" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr5" name="dtl_opr5[]" id="dtl_opr5" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr6" name="dtl_opr6[]" id="dtl_opr6" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr7" name="dtl_opr7[]" id="dtl_opr7" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr8" name="dtl_opr8[]" id="dtl_opr8" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr9" name="dtl_opr9[]" id="dtl_opr9" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr10" name="dtl_opr10[]" id="dtl_opr10" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr11" name="dtl_opr11[]" id="dtl_opr11" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr12" name="dtl_opr12[]" id="dtl_opr12" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr13" name="dtl_opr13[]" id="dtl_opr13" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr14" name="dtl_opr14[]" id="dtl_opr14" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr15" name="dtl_opr15[]" id="dtl_opr15" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr16" name="dtl_opr16[]" id="dtl_opr16" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr17" name="dtl_opr17[]" id="dtl_opr17" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr18" name="dtl_opr18[]" id="dtl_opr18" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr19" name="dtl_opr19[]" id="dtl_opr19" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr20" name="dtl_opr20[]" id="dtl_opr20" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr21" name="dtl_opr21[]" id="dtl_opr21" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr22" name="dtl_opr22[]" id="dtl_opr22" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr23" name="dtl_opr23[]" id="dtl_opr23" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr24" name="dtl_opr24[]" id="dtl_opr24" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr25" name="dtl_opr25[]" id="dtl_opr25" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr26" name="dtl_opr26[]" id="dtl_opr26" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr27" name="dtl_opr27[]" id="dtl_opr27" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr28" name="dtl_opr28[]" id="dtl_opr28" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr29" name="dtl_opr29[]" id="dtl_opr29" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr30" name="dtl_opr30[]" id="dtl_opr30" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr31" name="dtl_opr31[]" id="dtl_opr31" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr32" name="dtl_opr32[]" id="dtl_opr32" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr33" name="dtl_opr33[]" id="dtl_opr33" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime dtl_opr34" name="dtl_opr34[]" id="dtl_opr34" style="text-align: center;" value=""></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    foreach ($dtdetaild as $row) { ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_idd[]" id="detail_idd" class="detail_idd" style="text-align: center;" value="<?= $row->detail_id ?>">
                                                            <td><input type="hidden" class="form-control w-auto nama_mesin" name="nama_mesin[]" id="nama_mesin" style="text-align: center;" value="<?php echo $row->nama_mesin; ?>"><?php echo $row->nama_mesin; ?></td>
                                                            <td><input type="hidden" class="form-control w-auto kode_mesin" name="kode_mesin[]" id="kode_mesin" style="text-align: center;" value="<?php echo $row->kode_mesin; ?>"><?php echo $row->kode_mesin; ?></td>
                                                            <td><input type="hidden" class="form-control w-auto parameter" name="parameter[]" id="parameter" style="text-align: center;" value="<?php echo $row->parameter; ?>"><?php echo $row->parameter; ?></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr1" size="10" name="dtl_opr1[]" id="dtl_opr1" style="text-align: center;" value="<?php echo $row->dtl_opr1; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr2" size="10" name="dtl_opr2[]" id="dtl_opr2" style="text-align: center;" value="<?php echo $row->dtl_opr2; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr3" size="10" name="dtl_opr3[]" id="dtl_opr3" style="text-align: center;" value="<?php echo $row->dtl_opr3; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr4" size="10" name="dtl_opr4[]" id="dtl_opr4" style="text-align: center;" value="<?php echo $row->dtl_opr4; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr5" size="10" name="dtl_opr5[]" id="dtl_opr5" style="text-align: center;" value="<?php echo $row->dtl_opr5; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr6" size="10" name="dtl_opr6[]" id="dtl_opr6" style="text-align: center;" value="<?php echo $row->dtl_opr6; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr7" size="10" name="dtl_opr7[]" id="dtl_opr7" style="text-align: center;" value="<?php echo $row->dtl_opr7; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr8" size="10" name="dtl_opr8[]" id="dtl_opr8" style="text-align: center;" value="<?php echo $row->dtl_opr8; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr9" size="10" name="dtl_opr9[]" id="dtl_opr9" style="text-align: center;" value="<?php echo $row->dtl_opr9; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr10" size="10" name="dtl_opr10[]" id="dtl_opr10" style="text-align: center;" value="<?php echo $row->dtl_opr10; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr11" size="10" name="dtl_opr11[]" id="dtl_opr11" style="text-align: center;" value="<?php echo $row->dtl_opr11; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr12" size="10" name="dtl_opr12[]" id="dtl_opr12" style="text-align: center;" value="<?php echo $row->dtl_opr12; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr13" size="10" name="dtl_opr13[]" id="dtl_opr13" style="text-align: center;" value="<?php echo $row->dtl_opr13; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr14" size="10" name="dtl_opr14[]" id="dtl_opr14" style="text-align: center;" value="<?php echo $row->dtl_opr14; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr15" size="10" name="dtl_opr15[]" id="dtl_opr15" style="text-align: center;" value="<?php echo $row->dtl_opr15; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr16" size="10" name="dtl_opr16[]" id="dtl_opr16" style="text-align: center;" value="<?php echo $row->dtl_opr16; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr17" size="10" name="dtl_opr17[]" id="dtl_opr17" style="text-align: center;" value="<?php echo $row->dtl_opr17; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr18" size="10" name="dtl_opr18[]" id="dtl_opr18" style="text-align: center;" value="<?php echo $row->dtl_opr18; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr19" size="10" name="dtl_opr19[]" id="dtl_opr19" style="text-align: center;" value="<?php echo $row->dtl_opr19; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr20" size="10" name="dtl_opr20[]" id="dtl_opr20" style="text-align: center;" value="<?php echo $row->dtl_opr20; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr21" size="10" name="dtl_opr21[]" id="dtl_opr21" style="text-align: center;" value="<?php echo $row->dtl_opr21; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr22" size="10" name="dtl_opr22[]" id="dtl_opr22" style="text-align: center;" value="<?php echo $row->dtl_opr22; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr23" size="10" name="dtl_opr23[]" id="dtl_opr23" style="text-align: center;" value="<?php echo $row->dtl_opr23; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr24" size="10" name="dtl_opr24[]" id="dtl_opr24" style="text-align: center;" value="<?php echo $row->dtl_opr24; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr25" size="10" name="dtl_opr25[]" id="dtl_opr25" style="text-align: center;" value="<?php echo $row->dtl_opr25; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr26" size="10" name="dtl_opr26[]" id="dtl_opr26" style="text-align: center;" value="<?php echo $row->dtl_opr26; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr27" size="10" name="dtl_opr27[]" id="dtl_opr27" style="text-align: center;" value="<?php echo $row->dtl_opr27; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr28" size="10" name="dtl_opr28[]" id="dtl_opr28" style="text-align: center;" value="<?php echo $row->dtl_opr28; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr29" size="10" name="dtl_opr29[]" id="dtl_opr29" style="text-align: center;" value="<?php echo $row->dtl_opr29; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr30" size="10" name="dtl_opr30[]" id="dtl_opr30" style="text-align: center;" value="<?php echo $row->dtl_opr30; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr31" size="10" name="dtl_opr31[]" id="dtl_opr31" style="text-align: center;" value="<?php echo $row->dtl_opr31; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr32" size="10" name="dtl_opr32[]" id="dtl_opr32" style="text-align: center;" value="<?php echo $row->dtl_opr32; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr33" size="10" name="dtl_opr33[]" id="dtl_opr33" style="text-align: center;" value="<?php echo $row->dtl_opr33; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto dtl_opr34" size="10" name="dtl_opr34[]" id="dtl_opr34" style="text-align: center;" value="<?php echo $row->dtl_opr34; ?>"></td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-primary align-middle text-center" colspan="37" align="center">
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="table-success align-middle text-center" colspan="1"><h4><b>FLOW METER</b></h4></th>
                                                    <th class="table-success align-middle text-center" colspan="3"><h4><b>SOFTENER</b></h4></th>
                                                    <th class="table-success align-middle text-center" colspan="3"><h4><b>PROSES DEMIN ( RO, AST)</b></h4></th>
                                                </tr>
                                                <tr>
                                                    <th class="table-success align-middle text-center">SHIFT</th>
                                                    <th class="table-success align-middle text-center">AWAL</th>
                                                    <th class="table-success align-middle text-center">AKHIR</th>
                                                    <th class="table-success align-middle text-center">TOTAL</th>
                                                    <th class="table-success align-middle text-center">AWAL</th>
                                                    <th class="table-success align-middle text-center">AKHIR</th>
                                                    <th class="table-success align-middle text-center">TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody5">
                                                <?php if (!isset($dtdetaile)) {
                                                    if (isset($message)) {
                                                        for ($i = 0; $i < $jmldtl_5; $i++) { ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control w-auto shift_e" size="30" name="shift_e[]" id="shift_e" style="text-align: center;" value="<?php echo set_value('shift_e[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto rumus_rumus soft_awal" size="30" name="soft_awal[]" id="soft_awal" style="text-align: center;" value="<?php echo set_value('soft_awal[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto rumus_rumus soft_akhir" size="30" name="soft_akhir[]" id="soft_akhir" style="text-align: center;" value="<?php echo set_value('soft_akhir[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto soft_total" size="30" name="soft_total[]" id="soft_total" style="text-align: center;" value="<?php echo set_value('soft_total[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto rumus_rumus pro_awal" size="30" name="pro_awal[]" id="pro_awal" style="text-align: center;" value="<?php echo set_value('pro_awal[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto rumus_rumus pro_akhir" size="30" name="pro_akhir[]" id="pro_akhir" style="text-align: center;" value="<?php echo set_value('pro_akhir[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto pro_total" size="30" name="pro_total[]" id="pro_total" style="text-align: center;" value="<?php echo set_value('pro_total[' . $i . ']'); ?>"></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { 
                                                        for($i = 1; $i <= 3; $i++){
                                                            if ($i==1) {
                                                                $isi = 'PAGI';
                                                            } elseif ($i == 2) {
                                                                $isi = 'SORE';
                                                            } elseif ($i == 3) {
                                                                $isi = 'MALAM';
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control w-auto shift_e" size="30"name="shift_e[]" id="shift_e" style="text-align: center;" value="<?= $isi; ?>" readonly></td>
                                                                <td><input type="text" class="form-control w-auto rumus_rumus soft_awal" size="30"name="soft_awal[]" id="soft_awal" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto rumus_rumus soft_akhir" size="30"name="soft_akhir[]" id="soft_akhir" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto soft_total" size="30"name="soft_total[]" id="soft_total" style="text-align: center;" value="" readonly></td>
                                                                <td><input type="text" class="form-control w-auto rumus_rumus  pro_awal" size="30"name="pro_awal[]" id="pro_awal" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto rumus_rumus  pro_akhir" size="30"name="pro_akhir[]" id="pro_akhir" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto pro_total" size="30"name="pro_total[]" id="pro_total" style="text-align: center;" value="" readonly></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    }
                                                } else {
                                                    foreach ($dtdetaile as $row2) { ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_ide[]" id="detail_ide" class="detail_ide" style="text-align: center;" value="<?= $row2->detail_id ?>">
                                                            <td><input type="text" class="form-control w-auto shift_e" size="30" name="shift_e[]" id="shift_e" style="text-align: center;" value="<?php echo $row2->shift_e; ?>" readonly></td>
                                                            <td><input type="text" class="form-control w-auto rumus_rumus soft_awal" size="30" name="soft_awal[]" id="soft_awal" style="text-align: center;" value="<?php echo $row2->soft_awal; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto rumus_rumus soft_akhir" size="30" name="soft_akhir[]" id="soft_akhir" style="text-align: center;" value="<?php echo $row2->soft_akhir; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto soft_total" size="30" name="soft_total[]" id="soft_total" style="text-align: center;" value="<?php echo $row2->soft_total; ?>" readonly></td>
                                                            <td><input type="text" class="form-control w-auto rumus_rumus pro_awal" size="30" name="pro_awal[]" id="pro_awal" style="text-align: center;" value="<?php echo $row2->pro_awal; ?>" ></td>
                                                            <td><input type="text" class="form-control w-auto rumus_rumus pro_akhir" size="30" name="pro_akhir[]" id="pro_akhir" style="text-align: center;" value="<?php echo $row2->pro_akhir; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto pro_total" size="30" name="pro_total[]" id="pro_total" style="text-align: center;" value="<?php echo $row2->pro_total; ?>" readonly></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-success align-middle text-center" align="center">TOTAL</td>
                                                    <td class="table-success align-middle text-center" colspan="2" align="center"></td>
                                                    <td class="table-success align-middle text-center"> <input type="text" name="total_soft" id="total_soft" class=" form-control total_soft dtopen_blok w-auto" style="text-align: center;" size="30" value="<?= $total_soft; ?>" readonly></td>
                                                    <td class="table-success align-middle text-center" colspan="2" align="center"></td>
                                                    <td class="table-success align-middle text-center"> <input type="text" name="total_pro" id="total_pro" class=" form-control total_pro dtopen_blok w-auto" style="text-align: center;" size="30" value="<?= $total_pro; ?>" readonly></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="table-danger align-middle text-center" colspan="1" rowspan="1"><h4><b>PROSES PRODUKSI</b></h4></th>
                                                    <th class="table-danger align-middle text-center" colspan="1" rowspan="3"><h4><b>NO.POMPA</b></h4></th>
                                                    <th class="table-danger align-middle text-center" colspan="3" rowspan="1"><h4><b>SOFTENER (FEED WATER)</b></h4></th>
                                                    <th class="table-danger align-middle text-center" colspan="3" rowspan="1"><h4><b>PERMEATE ( PRODUCT )</b></h4></th>
                                                    <th class="table-danger align-middle text-center" colspan="3" rowspan="1"><h4><b>CONSENTRATE ( REJECT)</b></h4></th>
                                                </tr>
                                                <tr>
                                                    <th class="table-danger align-middle text-center">SHIFT</th>
                                                    <th class="table-danger align-middle text-center">AWAL</th>
                                                    <th class="table-danger align-middle text-center">AKHIR</th>
                                                    <th class="table-danger align-middle text-center">Total (m3)</th>
                                                    <th class="table-danger align-middle text-center">Flow (m3)</th>
                                                    <th class="table-danger align-middle text-center">Waktu ( jam )</th>
                                                    <th class="table-danger align-middle text-center">Total (m3)</th>
                                                    <th class="table-danger align-middle text-center">Flow (m3)</th>
                                                    <th class="table-danger align-middle text-center">Waktu ( jam )</th>
                                                    <th class="table-danger align-middle text-center">Total (m3)</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody6">
                                                <?php if (!isset($dtdetailf)) {
                                                    if (isset($message)) {
                                                        for ($i = 0; $i < $jmldtl_6; $i++) { ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus shift_f" size="30" name="shift_f[]" id="shift_f" style="text-align: center;" value="<?php echo set_value('shift_f[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus no_pompa" size="30" name="no_pompa[]" id="no_pompa" style="text-align: center;" value="<?php echo set_value('no_pompa[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus feed_awal" size="30" name="feed_awal[]" id="feed_awal" style="text-align: center;" value="<?php echo set_value('feed_awal[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus feed_akhir" size="30" name="feed_akhir[]" id="feed_akhir" style="text-align: center;" value="<?php echo set_value('feed_akhir[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus feed_total" size="30" name="feed_total[]" id="feed_total" style="text-align: center;" value="<?php echo set_value('feed_total[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus product_flow" size="30" name="product_flow[]" id="product_flow" style="text-align: center;" value="<?php echo set_value('product_flow[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus product_waktu" size="30" name="product_waktu[]" id="product_waktu" style="text-align: center;" value="<?php echo set_value('product_waktu[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus product_total" size="30" name="product_total[]" id="product_total" style="text-align: center;" value="<?php echo set_value('product_total[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus reject_flow" size="30" name="reject_flow[]" id="reject_flow" style="text-align: center;" value="<?php echo set_value('reject_flow[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus reject_waktu" size="30" name="reject_waktu[]" id="reject_waktu" style="text-align: center;" value="<?php echo set_value('reject_waktu[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus reject_total" size="30" name="reject_total[]" id="reject_total" style="text-align: center;" value="<?php echo set_value('reject_total[' . $i . ']'); ?>"></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { 
                                                        for($i = 1; $i <= 3; $i++){
                                                            if ($i==1) {
                                                                $isi = 'PAGI';
                                                            } elseif ($i == 2) {
                                                                $isi = 'SORE';
                                                            } elseif ($i == 3) {
                                                                $isi = 'MALAM';
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus shift_f" size="30" name="shift_f[]" id="shift_f" style="text-align: center;" value="<?= $isi; ?>" readonly></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus no_pompa" size="30" name="no_pompa[]" id="no_pompa" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus feed_awal" size="30" name="feed_awal[]" id="feed_awal" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus feed_akhir" size="30" name="feed_akhir[]" id="feed_akhir" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus feed_total" size="30" name="feed_total[]" id="feed_total" style="text-align: center;" value=""readonly></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus product_flow" size="30" name="product_flow[]" id="product_flow" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus product_waktu" size="30" name="product_waktu[]" id="product_waktu" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus product_total" size="30" name="product_total[]" id="product_total" style="text-align: center;" value="" readonly></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus reject_flow" size="30" name="reject_flow[]" id="reject_flow" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus reject_waktu" size="30" name="reject_waktu[]" id="reject_waktu" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto produksi_rumus reject_total" size="30" name="reject_total[]" id="reject_total" style="text-align: center;" value="" readonly></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    }
                                                } else {
                                                    foreach ($dtdetailf as $row2) { ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_idf[]" id="detail_idf" class="detail_idf" style="text-align: center;" value="<?= $row2->detail_id ?>">
                                                            <td><input type="text" class="form-control w-auto produksi_rumus shift_f" size="30" name="shift_f[]" id="shift_f" style="text-align: center;" value="<?php echo $row2->shift_f; ?>" readonly></td>
                                                            <td><input type="text" class="form-control w-auto produksi_rumus no_pompa" size="30" name="no_pompa[]" id="no_pompa" style="text-align: center;" value="<?php echo $row2->no_pompa; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto produksi_rumus feed_awal" size="30" name="feed_awal[]" id="feed_awal" style="text-align: center;" value="<?php echo $row2->feed_awal; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto produksi_rumus feed_akhir" size="30" name="feed_akhir[]" id="feed_akhir" style="text-align: center;" value="<?php echo $row2->feed_akhir; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto produksi_rumus feed_total" size="30" name="feed_total[]" id="feed_total" style="text-align: center;" value="<?php echo $row2->feed_total; ?>" readonly></td>
                                                            <td><input type="text" class="form-control w-auto produksi_rumus product_flow" size="30" name="product_flow[]" id="product_flow" style="text-align: center;" value="<?php echo $row2->product_flow; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto produksi_rumus product_waktu" size="30" name="product_waktu[]" id="product_waktu" style="text-align: center;" value="<?php echo $row2->product_waktu; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto produksi_rumus product_total" size="30" name="product_total[]" id="product_total" style="text-align: center;" value="<?php echo $row2->product_total; ?>" readonly></td>
                                                            <td><input type="text" class="form-control w-auto produksi_rumus reject_flow" size="30" name="reject_flow[]" id="reject_flow" style="text-align: center;" value="<?php echo $row2->reject_flow; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto produksi_rumus reject_waktu" size="30" name="reject_waktu[]" id="reject_waktu" style="text-align: center;" value="<?php echo $row2->reject_waktu; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto produksi_rumus reject_total" size="30" name="reject_total[]" id="reject_total" style="text-align: center;" value="<?php echo $row2->reject_total; ?>" readonly></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-danger align-middle text-center" align="center">TOTAL</td>
                                                    <td class="table-danger align-middle text-center" colspan="3" align="center"></td>
                                                    <td class="table-danger align-middle text-center"> <input type="text" name="total_feed" id="total_feed" class=" form-control total_feed dtopen_blok w-auto" style="text-align: center;" size="30" value="<?= $total_feed; ?>" readonly></td>
                                                    <td class="table-danger align-middle text-center" colspan="2" align="center"></td>
                                                    <td class="table-danger align-middle text-center"> <input type="text" name="total_product" id="total_product" class=" form-control total_product dtopen_blok w-auto" style="text-align: center;" size="30" value="<?= $total_product; ?>" readonly></td>
                                                    <td class="table-danger align-middle text-center" colspan="2" align="center"></td>
                                                    <td class="table-danger align-middle text-center"> <input type="text" name="total_reject" id="total_reject" class=" form-control total_reject dtopen_blok w-auto" style="text-align: center;" size="30" value="<?= $total_reject; ?>" readonly></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                    <!-- <div class="table-responsive table-scrolled"  style="max-height: 400px;"> -->
                                        <table class="table table-striped table-bordered">
                                        <thead>
                                                <tr>
                                                    <th class="table-info align-middle text-center" colspan="1" rowspan="4"><h4><b>#</b></h4></th>
                                                    <th class="table-info align-middle text-center" colspan="1" rowspan="4"><h4><b>WAKTU</b></h4></th>
                                                    <th class="table-info align-middle text-center" colspan="1" rowspan="4"><h4><b>Start Stop</b></h4></th>
                                                    <th class="table-info align-middle text-center" colspan="6" rowspan="1"><h4><b>FEED WATER ( SOFTENER )</b></h4></th>
                                                    <th class="table-info align-middle text-center" colspan="2" rowspan="1"><h4><b>PERMEATE ( PRODUCT )</b></h4></th>
                                                </tr>
                                                <tr>
                                                    <th class="table-info align-middle text-center">pH</th>
                                                    <th class="table-info align-middle text-center">Konduktivity</th>
                                                    <th class="table-info align-middle text-center">TH</th>
                                                    <th class="table-info align-middle text-center">Turbidity</th>
                                                    <th class="table-info align-middle text-center">Cl-</th>
                                                    <th class="table-info align-middle text-center">FCl</th>
                                                    <th class="table-info align-middle text-center">pH</th>
                                                    <th class="table-info align-middle text-center">Konduktivity (µs/cm)</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-info align-middle text-center">6,5 - 8,5</th>
                                                    <th class="table-info align-middle text-center">µs/cm</th>
                                                    <th class="table-info align-middle text-center">µmol/L</th>
                                                    <th class="table-info align-middle text-center">NTU</th>
                                                    <th class="table-info align-middle text-center">ppm</th>
                                                    <th class="table-info align-middle text-center">ppm</th>
                                                    <th class="table-info align-middle text-center">6,5 - 8,5</th>
                                                    <th class="table-info align-middle text-center">< 40</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody7">
                                                <?php if (!isset($dtdetailg)) {
                                                    if (isset($message)) {
                                                        for ($i = 0; $i < $jmldtl_7; $i++) { ?>
                                                            <tr>
                                                                <td class="fixed freeze_horizontal" style="background-color: #ffffff ! important;"><input name="dtl_chkg[]" type="checkbox" /></td>
                                                                <td><input type="text" class="form-control w-auto read_only masktime jam_waktu" size="15" name="jam_waktu[]" id="jam_waktu" style="text-align: center;" value="<?php echo set_value('jam_waktu[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto read_only start_stop" size="15" name="start_stop[]" id="start_stop" style="text-align: center;" value="<?php echo set_value('start_stop[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto read_only feed_ph" size="15" name="feed_ph[]" id="feed_ph" style="text-align: center;" value="<?php echo set_value('feed_ph[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto read_only feed_konduktivity" size="15" name="feed_konduktivity[]" id="feed_konduktivity" style="text-align: center;" value="<?php echo set_value('feed_konduktivity[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto read_only feed_th" size="15" name="feed_th[]" id="feed_th" style="text-align: center;" value="<?php echo set_value('feed_th[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto read_only feed_turbidity" size="15" name="feed_turbidity[]" id="feed_turbidity" style="text-align: center;" value="<?php echo set_value('feed_turbidity[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto read_only feed_cl" size="15" name="feed_cl[]" id="feed_cl" style="text-align: center;" value="<?php echo set_value('feed_cl[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto read_only feed_fcl" size="15" name="feed_fcl[]" id="feed_fcl" style="text-align: center;" value="<?php echo set_value('feed_fcl[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto read_only product_ph" size="15" name="product_ph[]" id="product_ph" style="text-align: center;" value="<?php echo set_value('product_ph[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto read_only product_konduktivity" size="15" name="product_konduktivity[]" id="product_konduktivity" style="text-align: center;" value="<?php echo set_value('product_konduktivity[' . $i . ']'); ?>"></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
                                                            <tr>
                                                                <td><input name="dtl_chkg[]" class="chkg" type="checkbox" /></td>
                                                                <td><input type="text" class="form-control w-auto read_only masktime jam_waktu" size="15" name="jam_waktu[]" id="jam_waktu" style="text-align: center;" value="" ></td>
                                                                <td><input type="text" class="form-control w-auto read_only start_stop" size="15" name="start_stop[]" id="start_stop" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto read_only feed_ph" size="15" name="feed_ph[]" id="feed_ph" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto read_only feed_konduktivity" size="15" name="feed_konduktivity[]" id="feed_konduktivity" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto read_only feed_th" size="15" name="feed_th[]" id="feed_th" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto read_only feed_turbidity" size="15" name="feed_turbidity[]" id="feed_turbidity" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto read_only feed_cl" size="15" name="feed_cl[]" id="feed_cl" style="text-align: center;" value="" ></td>
                                                                <td><input type="text" class="form-control w-auto read_only feed_fcl" size="15" name="feed_fcl[]" id="feed_fcl" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto read_only product_ph" size="15" name="product_ph[]" id="product_ph" style="text-align: center;" value=""></td>
                                                                <td><input type="text" class="form-control w-auto read_only product_konduktivity" size="15" name="product_konduktivity[]" id="product_konduktivity" style="text-align: center;" value="" ></td>
                                                            </tr>
                                                    <?php } 
                                                } else {
                                                    foreach ($dtdetailg as $dtdetailg_row) { ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_idg[]" id="detail_idg" class="detail_idg" style="text-align: center;" value="<?= $dtdetailg_row->detail_id ?>">
                                                            <td><input name="dtl_chkg[]" id="dtl_chkg" type="checkbox" class="chkg" value="<?= $dtdetailg_row->detail_id ?>" /></td>
                                                            <td><input type="text" class="form-control w-auto read_only masktime jam_waktu" size="15" name="jam_waktu[]" id="jam_waktu" style="text-align: center;" value="<?= $dtdetailg_row->jam_waktu ?>" ></td>
                                                            <td><input type="text" class="form-control w-auto read_only start_stop" size="15" name="start_stop[]" id="start_stop" style="text-align: center;" value="<?= $dtdetailg_row->start_stop ?>"></td>
                                                            <td><input type="text" class="form-control w-auto read_only feed_ph" size="15" name="feed_ph[]" id="feed_ph" style="text-align: center;" value="<?= $dtdetailg_row->feed_ph ?>"></td>
                                                            <td><input type="text" class="form-control w-auto read_only feed_konduktivity" size="15" name="feed_konduktivity[]" id="feed_konduktivity" style="text-align: center;" value="<?= $dtdetailg_row->feed_konduktivity ?>" ></td>
                                                            <td><input type="text" class="form-control w-auto read_only feed_th" size="15" name="feed_th[]" id="feed_th" style="text-align: center;" value="<?= $dtdetailg_row->feed_th ?>"></td>
                                                            <td><input type="text" class="form-control w-auto read_only feed_turbidity" size="15" name="feed_turbidity[]" id="feed_turbidity" style="text-align: center;" value="<?= $dtdetailg_row->feed_turbidity ?>"></td>
                                                            <td><input type="text" class="form-control w-auto read_only feed_cl" size="15" name="feed_cl[]" id="feed_cl" style="text-align: center;" value="<?= $dtdetailg_row->feed_cl ?>" ></td>
                                                            <td><input type="text" class="form-control w-auto read_only feed_fcl" size="15" name="feed_fcl[]" id="feed_fcl" style="text-align: center;" value="<?= $dtdetailg_row->feed_fcl ?>"></td>
                                                            <td><input type="text" class="form-control w-auto read_only product_ph" size="15" name="product_ph[]" id="product_ph" style="text-align: center;" value="<?= $dtdetailg_row->product_ph ?>"></td>
                                                            <td><input type="text" class="form-control w-auto read_only product_konduktivity" size="15" name="product_konduktivity[]" id="product_konduktivity" style="text-align: center;" value="<?= $dtdetailg_row->product_konduktivity; ?>" ></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-info align-middle text-center" colspan="11" align="center">
                                                    <?php if (!isset($dtdetailg)) {
                                                            if ($akses_create == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody7')">Tambah Baris</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody7')">Hapus Baris</button>
                                                            <?php
                                                            }
                                                        } else {
                                                            if ($akses_update == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody7')">Tambah Baris</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody7')">Hapus Baris</button>
                                                            <?php
                                                            }
                                                            if ($akses_delete == '1') { ?>
                                                                <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete_dtl_g" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus Data</button>
                                                        <?php
                                                            }
                                                        } ?>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-info">
                                            <tbody><tr>
                                                <th>Keterangan :</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <!-- <textarea name="keterangan_hdr" id="keterangan_hdr" class="form-control keterangan_hdr" cols="30" rows="10" style="height: 171px;"></textarea> -->
                                                    <textarea type="text" name="keterangan_hdr" id="keterangan_hdr" class="form-control keterangan_hdr dtopen_blok" cols="30" rows="10" style="height: 171px;" value="<?= $keterangan_hdr; ?>"><?= $keterangan_hdr; ?></textarea>
                                                </td>
                                            </tr><tr>
                                        </tr></tbody></table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>HASIL ANALISA PH SELAMA CIP</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="table-primary align-middle text-center">#</th>
                                                    <th class="table-primary align-middle text-center">Waktu</th>
                                                    <th class="table-primary align-middle text-center">Pressure</th>
                                                    <th class="table-primary align-middle text-center">H-566 (pH 10-13)</th>
                                                    <th class="table-primary align-middle text-center">Waktu</th>
                                                    <th class="table-primary align-middle text-center">Pressure</th>
                                                    <th class="table-primary align-middle text-center">pH bilas ≤ 10</th>
                                                    <th class="table-primary align-middle text-center">Waktu</th>
                                                    <th class="table-primary align-middle text-center">Pressure</th>
                                                    <th class="table-primary align-middle text-center">H- 277 (pH 1-4 )</th>
                                                    <th class="table-primary align-middle text-center">Waktu</th>
                                                    <th class="table-primary align-middle text-center">Pressure</th>
                                                    <th class="table-primary align-middle text-center">pH bilas (≥ 6,5)</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody1">
                                                <?php if (!isset($dtdetail)) {
                                                    if (isset($message)) {
                                                        for ($i = 0; $i < $jmldtl; $i++) { ?>
                                                            <tr>
                                                                <td class="fixed freeze_horizontal" style="background-color: #ffffff ! important;"><input name="dtl_chk[]" type="checkbox" /></td>
                                                                <td><input type="text" class="form-control w-auto masktime jam1" name="jam1[]" id="jam1" style="text-align: center;" value="<?php echo set_value('jam1[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto pressure_1" name="pressure_1[]" id="pressure_1" style="text-align: center;" value="<?php echo set_value('pressure_1[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto h566" name="h566[]" id="h566" style="text-align: center;" value="<?php echo set_value('h566[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime jam2" name="jam2[]" id="jam2" style="text-align: center;" value="<?php echo set_value('jam2[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto pressure2" name="pressure2[]" id="pressure2" style="text-align: center;" value="<?php echo set_value('pressure2[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto ph_bilas" name="ph_bilas[]" id="ph_bilas" style="text-align: center;" value="<?php echo set_value('ph_bilas[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime jam3" name="jam3[]" id="jam3" style="text-align: center;" value="<?php echo set_value('jam3[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto pressure3" name="pressure3[]" id="pressure3" style="text-align: center;" value="<?php echo set_value('pressure3[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto h277" name="h277[]" id="h277" style="text-align: center;" value="<?php echo set_value('h277[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto masktime jam4" name="jam4[]" id="jam4" style="text-align: center;" value="<?php echo set_value('jam4[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto pressure4" name="pressure4[]" id="pressure4" style="text-align: center;" value="<?php echo set_value('pressure4[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto ph_bilas4" name="ph_bilas4[]" id="ph_bilas4" style="text-align: center;" value="<?php echo set_value('ph_bilas4[' . $i . ']'); ?>"></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
                                                        <tr>
                                                            <td><input name="dtl_chk[]" class="chk" type="checkbox" /></td>
                                                            <td><input type="text" class="form-control w-auto masktime jam1" name="jam1[]" id="jam1" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto pressure_1" name="pressure_1[]" id="pressure_1" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto h566" name="h566[]" id="h566" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime jam2" name="jam2[]" id="jam2" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto pressure2" name="pressure2[]" id="pressure2" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto ph_bilas" name="ph_bilas[]" id="ph_bilas" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime jam3" name="jam3[]" id="jam3" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto pressure3" name="pressure3[]" id="pressure3" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto h277" name="h277[]" id="h277" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto masktime jam4" name="jam4[]" id="jam4" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto pressure4" name="pressure4[]" id="pressure4" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto ph_bilas4" name="ph_bilas4[]" id="ph_bilas4" style="text-align: center;" value=""></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    foreach ($dtdetail as $row) { ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id[]" id="detail_id" class="detail_id" style="text-align: center;" value="<?= $row->detail_id ?>">
                                                            <td><input name="dtl_chk[]" id="dtl_chk" type="checkbox" class="chk" value="<?php echo $row->detail_id; ?>" /></td>
                                                            <td><input type="text" class="form-control w-auto masktime jam1" name="jam1[]" id="jam1" style="text-align: center;" value="<?php echo $row->jam1; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto pressure_1" name="pressure_1[]" id="pressure_1" style="text-align: center;" value="<?php echo $row->pressure_1; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto h566" name="h566[]" id="h566" style="text-align: center;" value="<?php echo $row->h566; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto masktime jam2" name="jam2[]" id="jam2" style="text-align: center;" value="<?php echo $row->jam2; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto pressure2" name="pressure2[]" id="pressure2" style="text-align: center;" value="<?php echo $row->pressure2; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto ph_bilas" name="ph_bilas[]" id="ph_bilas" style="text-align: center;" value="<?php echo $row->ph_bilas; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto masktime jam3" name="jam3[]" id="jam3" style="text-align: center;" value="<?php echo $row->jam3; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto pressure3" name="pressure3[]" id="pressure3" style="text-align: center;" value="<?php echo $row->pressure3; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto h277" name="h277[]" id="h277" style="text-align: center;" value="<?php echo $row->h277; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto masktime jam4" name="jam4[]" id="jam4" style="text-align: center;" value="<?php echo $row->jam4; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto pressure4" name="pressure4[]" id="pressure4" style="text-align: center;" value="<?php echo $row->pressure4; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto ph_bilas4" name="ph_bilas4[]" id="ph_bilas4" style="text-align: center;" value="<?php echo $row->ph_bilas4; ?>"></td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-primary align-middle text-center" colspan="13" align="center">
                                                        <?php if (!isset($dtdetail)) {
                                                            if ($akses_create == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody1')">Tambah Baris</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody1')">Hapus Baris</button>
                                                            <?php
                                                            }
                                                        } else {
                                                            if ($akses_update == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody1')">Tambah Baris</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody1')">Hapus Baris</button>
                                                            <?php
                                                            }
                                                            if ($akses_delete == '1') { ?>
                                                                <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete_dtl" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus Data</button>
                                                        <?php
                                                            }
                                                        } ?>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-5">
                                    <h5>TABLE FLOW CIP RO</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="table-success align-middle text-center">#</th>
                                                    <th class="table-success align-middle text-center">Flow Awal</th>
                                                    <th class="table-success align-middle text-center">Flow Akhir</th>
                                                    <th class="table-success align-middle text-center">Total</th>
                                                    <th class="table-success align-middle text-center">Formula</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody2">
                                                <?php if (!isset($dtdetailb)) {
                                                    if (isset($message)) {
                                                        for ($i = 0; $i < $jmldtl_2; $i++) { ?>
                                                            <tr>
                                                                <td class="fixed freeze_horizontal" style="background-color: #ffffff ! important;"><input name="dtl_chkb[]" type="checkbox" /></td>
                                                                <td><input type="text" class="form-control w-auto table_flow flow_awal" name="flow_awal[]" id="flow_awal" style="text-align: center;" value="<?php echo set_value('flow_awal[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto table_flow flow_akhir" name="flow_akhir[]" id="flow_akhir" style="text-align: center;" value="<?php echo set_value('flow_akhir[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto table_flow total" name="total[]" id="total" style="text-align: center;" value="<?php echo set_value('total[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto table_flow formula" name="formula[]" id="formula" style="text-align: center;" value="<?php echo set_value('formula[' . $i . ']'); ?>" readonly></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
                                                        <tr>
                                                            <td><input name="dtl_chkb[]" class="chkb" type="checkbox" /></td>
                                                            <td><input type="text" class="form-control w-auto table_flow flow_awal" name="flow_awal[]" id="flow_awal" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto table_flow flow_akhir" name="flow_akhir[]" id="flow_akhir" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto table_flow total" name="total[]" id="total" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto table_flow formula" name="formula[]" id="formula" style="text-align: center;" value="" readonly></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    foreach ($dtdetailb as $row2) { ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_idb[]" id="detail_idb" class="detail_idb" style="text-align: center;" value="<?= $row2->detail_id ?>">
                                                            <td><input name="dtl_chkb[]" id="dtl_chkb" type="checkbox" class="chkb" value="<?php echo $row2->detail_id; ?>" /></td>
                                                            <td><input type="text" class="form-control w-auto table_flow flow_awal" name="flow_awal[]" id="flow_awal" style="text-align: center;" value="<?php echo $row2->flow_awal; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto table_flow flow_akhir" name="flow_akhir[]" id="flow_akhir" style="text-align: center;" value="<?php echo $row2->flow_akhir; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto table_flow total" name="total[]" id="total" style="text-align: center;" value="<?php echo $row2->total; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto table_flow formula" name="formula[]" id="formula" style="text-align: center;" value="<?php echo $row2->formula; ?>" readonly></td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-success align-middle text-center" colspan="10" align="center">
                                                        <?php if (!isset($dtdetailb)) {
                                                            if ($akses_create == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody2')">Tambah Baris</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody2')">Hapus Baris</button>
                                                            <?php
                                                            }
                                                        } else {
                                                            if ($akses_update == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody2')">Tambah Baris</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody2')">Hapus Baris</button>
                                                            <?php
                                                            }
                                                            if ($akses_delete == '1') { ?>
                                                                <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete_dtl_b" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus Data</button>
                                                        <?php
                                                            }
                                                        } ?>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <h5>CATATAN KETIDAK SESUAIAN</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="table-danger align-middle text-center" rowspan="4" colspan="1">#</th>
                                                    <th class="table-danger align-middle text-center" rowspan="4" colspan="1">Jam</th>
                                                    <th class="table-danger align-middle text-center" rowspan="4" colspan="1">Uraian Ketidaksesuaian</th>
                                                    <th class="table-danger align-middle text-center" rowspan="4" colspan="1">Tindakan Perbaikan</th>
                                                    <th class="table-danger align-middle text-center" rowspan="4" colspan="1">Nama</th>
                                                    <th class="table-danger align-middle text-center" rowspan="4" colspan="1">Shift</th>
                                                    <th class="table-danger align-middle text-center" rowspan="1" colspan="3">Kondisi Pengecekan</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Benda Asing</th>
                                                    <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Kotoran / Najis</th>
                                                    <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody3">
                                                <?php if (!isset($dtdetailc)) {
                                                    if (isset($message)) {
                                                        for ($i = 0; $i < $jmldtl_3; $i++) { ?>
                                                            <tr>
                                                                <td class="fixed freeze_horizontal" style="background-color: #ffffff ! important;"><input name="dtl_chkc[]" type="checkbox" /></td>
                                                                <td><input type="text" class="form-control w-auto masktime jam" name="jam[]" id="jam" style="text-align: center;" value="<?php echo set_value('jam[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto uraian" name="uraian[]" id="uraian" style="text-align: center;" value="<?php echo set_value('uraian[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto tindakan" name="tindakan[]" id="tindakan" style="text-align: center;" value="<?php echo set_value('tindakan[' . $i . ']'); ?>"></td>
                                                                <td><input type="text" class="form-control w-auto nama" name="nama[]" id="nama" style="text-align: center;" value="<?php echo set_value('nama[' . $i . ']'); ?>"></td>
                                                                <td align="center">
                                                                    <select name="shift[]" class="form-control w-auto shift" id="shift">
                                                                        <option value="">- pilih -</option>
                                                                        <option value="Shift A">Shift A</option>
                                                                        <option value="Shift B">Shift B</option>
                                                                        <option value="Shift C">Shift C</option>
                                                                    </select>
                                                                </td>
                                                                <!-- <td align="center"><select name="dtlc_pj_id[]" id="dtlc_pj_id" class="form-control w-auto dtlc_pj_id">
                                                                                    <option value="">- pilih -</option>
                                                                                    <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                                        <option value="<?= $list_pj_row->detail_id  ?>">
                                                                                            <?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?>
                                                                                        </option>
                                                                                    <?php } ?>
                                                                                </select></td>
                                                                <td align="center"></td> -->
                                                                <td align="center">
                                                                    <select name="benda_asing[]" class="form-control w-auto benda_asing" id="benda_asing">
                                                                        <option value="">- pilih -</option>
                                                                        <option value="normal">✓</option>
                                                                        <option value="tidak normal">✘</option>
                                                                    </select>
                                                                </td>
                                                                <td align="center">
                                                                    <select name="kotoran[]" class="form-control w-auto kotoran" id="kotoran">
                                                                        <option value="">- pilih -</option>
                                                                        <option value="normal">✓</option>
                                                                        <option value="tidak normal">✘</option>
                                                                    </select>
                                                                </td>
                                                                <td align="center">
                                                                    <select name="keterangan[]" class="form-control w-auto keterangan" id="keterangan">
                                                                        <option value="">- pilih -</option>
                                                                        <option value="OK">OK</option>
                                                                        <option value="NOT OK">NOT OK</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
                                                        <tr>
                                                            <td><input name="dtl_chkc[]" class="chkc" type="checkbox" /></td>
                                                            <td><input type="text" class="form-control w-auto masktime jam" name="jam[]" id="jam" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto uraian" name="uraian[]" id="uraian" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto tindakan" name="tindakan[]" id="tindakan" style="text-align: center;" value=""></td>
                                                            <td><input type="text" class="form-control w-auto nama" name="nama[]" id="nama" style="text-align: center;" value=""></td>
                                                            <td align="center">
                                                                <select name="shift[]" class="form-control w-auto shift" id="shift">
                                                                    <option value="">- pilih -</option>
                                                                    <option value="Shift A">Shift A</option>
                                                                    <option value="Shift B">Shift B</option>
                                                                    <option value="Shift C">Shift C</option>
                                                                </select>
                                                            </td>
                                                            <!-- <td align="center"><select name="dtlc_pj_id[]" id="dtlc_pj_id" class="form-control w-auto dtlc_pj_id">
                                                                                <option value="">- pilih -</option>
                                                                                <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                                    <option value="<?= $list_pj_row->detail_id  ?>">
                                                                                        <?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?>
                                                                                    </option>
                                                                                <?php } ?>
                                                                            </select></td>
                                                            <td></td> -->
                                                            <td align="center">
                                                                <select name="benda_asing[]" class="form-control w-auto benda_asing" id="benda_asing">
                                                                    <option value="">- pilih -</option>
                                                                    <option value="normal">✓</option>
                                                                    <option value="tidak normal">✘</option>
                                                                </select>
                                                            </td>
                                                            <td align="center">
                                                                <select name="kotoran[]" class="form-control w-auto kotoran" id="kotoran">
                                                                    <option value="">- pilih -</option>
                                                                    <option value="normal">✓</option>
                                                                    <option value="tidak normal">✘</option>
                                                                </select>
                                                            </td>
                                                            <td align="center">
                                                                <select name="keterangan[]" class="form-control w-auto keterangan" id="keterangan">
                                                                    <option value="">- pilih -</option>
                                                                    <option value="OK">OK</option>
                                                                    <option value="NOT OK">NOT OK</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    // $base_url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/';
                                                    // $fcpath2   = str_replace('utl/', '', FCPATH);
                                                    foreach ($dtdetailc as $row3) { 
                                                        // if(file_exists($fcpath2 .'utl/assets/ttd/'.$row3->pj_personalstatus.'_'.$row3->pj_personalid.'.png')){
                                                        //     $ttd_base_path = '<img src="'.$base_url2.'utl/assets/ttd/'.$row3->pj_personalstatus.'_'.$row3->pj_personalid.'.png?timestamp='.time().'" style="width:130px; height:80px; background-size:100%;" alt="">';
                                                        // }else{
                                                        //     if($row3->pj_personalid!='' && $row3->pj_personalstatus==2 && file_exists($fcpath2 .'forviewfoto_pekerja/TTD_TK/'.$row3->pj_personalid.'.png')){
                                                        //         $ttd_base_path = '<img src="'.$base_url2.'forviewfoto_pekerja/TTD_TK/'.$row3->pj_personalid.'.png?timestamp='.time().'" style="width:130px; height:80px; background-size:100%;" alt="">';
                                                        //     }else if($row3->pj_personalid!='' && $row3->pj_personalstatus==1 && file_exists($fcpath2 .'forviewfoto_mypsg/TTD_KRY/'.$row3->pj_personalid.'_0_0.png')){
                                                        //         $ttd_base_path = '<img src="'.$base_url2.'forviewfoto_pekerja/TTD_KRY/'.$row3->pj_personalid.'_0_0.png?timestamp='.time().'" style="width:130px; height:80px; background-size:100%;" alt="">';
                                                        //     }else if($row3->pj_personalid!='' && $row3->pj_personalstatus==1 && file_exists($fcpath2 .'forviewfoto_mypsg/'.$row3->pj_personalid.'_0_0.png')){
                                                        //         $ttd_base_path = '<img src="'.$base_url2.'forviewfoto_pekerja/'.$row3->pj_personalid.'_0_0.png?timestamp='.time().'" style="width:130px; height:80px; background-size:100%;" alt="">';
                                                        //     }else{
                                                        //         $ttd_base_path = '';
                                                        //     }
                                                        // }
                                                        ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_idc[]" id="detail_idc" class="detail_idc" style="text-align: center;" value="<?= $row3->detail_id ?>">
                                                            <td><input name="dtl_chkc[]" id="dtl_chkc" type="checkbox" class="chkc" value="<?php echo $row3->detail_id; ?>" /></td>
                                                            <td><input type="text" class="form-control w-auto masktime jam" name="jam[]" id="jam" style="text-align: center;" value="<?php echo $row3->jam; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto uraian" name="uraian[]" id="uraian" style="text-align: center;" value="<?php echo $row3->uraian; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto tindakan" name="tindakan[]" id="tindakan" style="text-align: center;" value="<?php echo $row3->tindakan; ?>"></td>
                                                            <td><input type="text" class="form-control w-auto nama" name="nama[]" id="nama" style="text-align: center;" value="<?php echo $row3->nama; ?>"></td>
                                                            <td align="center">
                                                                <select name=" shift[]" class="form-control w-auto shift" id="shift">
                                                                    <option value="">- pilih -</option>
                                                                    <option value="Shift A" <?php if ($row3->shift == "Shift A") {
                                                                                                echo "selected";
                                                                                            } ?>>Shift A
                                                                    </option>
                                                                    <option value="Shift B" <?php if ($row3->shift == "Shift B") {
                                                                                                echo "selected";
                                                                                            } ?>>Shift B
                                                                    </option>
                                                                    <option value="Shift C" <?php if ($row3->shift == "Shift C") {
                                                                                                echo "selected";
                                                                                            } ?>>Shift C
                                                                    </option>
                                                                </select>
                                                            </td>
                                                            <!-- <td align="center"><select name="dtlc_pj_id[]" id="dtlc_pj_id" class="form-control w-auto dtlc_pj_id">
                                                                                <option value="">- pilih -</option>
                                                                                <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                                    <option value="<?= $list_pj_row->detail_id  ?>" <?php if ($list_pj_row->detail_id == $row3->pj_id) {
                                                                                                                                        echo 'selected';
                                                                                                                                    } ?>>
                                                                                        <?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?>
                                                                                    </option>
                                                                                <?php } ?>
                                                                            </select></td>
                                                                        <td align="center"><?= $ttd_base_path ?></td> -->
                                                            <td align="center">
                                                                <select name=" benda_asing[]" class="form-control w-auto benda_asing" id="benda_asing">
                                                                    <option value="">- pilih -</option>
                                                                    <option value="normal" <?php if ($row3->benda_asing == "normal") {
                                                                                                echo "selected";
                                                                                            } ?>>✓
                                                                    </option>
                                                                    <option value="tidak normal" <?php if ($row3->benda_asing == "tidak normal") {
                                                                                                echo "selected";
                                                                                            } ?>>✘
                                                                    </option>
                                                                </select>
                                                            </td>
                                                            <td align="center">
                                                                <select name=" kotoran[]" class="form-control w-auto kotoran" id="kotoran">
                                                                    <option value="">- pilih -</option>
                                                                    <option value="normal" <?php if ($row3->kotoran == "normal") {
                                                                                                echo "selected";
                                                                                            } ?>>✓
                                                                    </option>
                                                                    <option value="tidak normal" <?php if ($row3->kotoran == "tidak normal") {
                                                                                                echo "selected";
                                                                                            } ?>>✘
                                                                    </option>
                                                                </select>
                                                            </td>
                                                            <td align="center">
                                                                <select name=" keterangan[]" class="form-control w-auto keterangan" id="keterangan">
                                                                    <option value="">- pilih -</option>
                                                                    <option value="OK" <?php if ($row3->keterangan == "OK") {
                                                                                                echo "selected";
                                                                                            } ?>>OK
                                                                    </option>
                                                                    <option value="NOT OK" <?php if ($row3->keterangan == "NOT OK") {
                                                                                                echo "selected";
                                                                                            } ?>>NOT OK
                                                                    </option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="table-danger align-middle text-center" colspan="10" align="center">
                                                        <?php if (!isset($dtdetailc)) {
                                                            if ($akses_create == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody3')">Tambah Baris</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody3')">Hapus Baris</button>
                                                            <?php
                                                            }
                                                        } else {
                                                            if ($akses_update == '1') { ?>
                                                                <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody3')">Tambah Baris</button>
                                                                <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody3')">Hapus Baris</button>
                                                            <?php
                                                            }
                                                            if ($akses_delete == '1') { ?>
                                                                <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete_dtl_c" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus Data</button>
                                                        <?php
                                                            }
                                                        } ?>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <!-- <?php $this->load->view('laporan/V_laporan_definisi'); ?> -->
                            </div>

                            <div class="row mt-1">
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
                                            <button type="submit" class="btn bg-gradient-info" name="btnproses" value="btncomplete" onclick="return confirm('Komplit Data ?')"><i class="feather icon-check-square"></i> Komplit</button>
                                        <?php
                                        }
                                        if ($akses_excel == '1') { ?>
                                            <a class="btn bg-gradient-success" href="<?= base_url('export_excel/C_export_toexcel_' . $frmkd . '_' . $frmvrs . '/exportxls/' . $frmkd . '/' . $frmvrs . '/' . $headerid) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
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

    $(document).ready(function() {

        get_docno();

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
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn040_03/get_docno/inttbn040/03",
                data: {
                    create_date
                },
                async: false,
                success: function(data) {
                    $('.docno').val(JSON.parse(data)['data']);
                    get_item();
                }
            });
        }
    }

        $(document).on('keyup', '[class*=jam]', function() {
            let that = $(this);
            let val_jam = that.val();

            if (val_jam != '') {
                let val = $('[class*=jam]').mask('00:00');
            }
        });

        function get_item(){
            let input_headerid = $(".headerid").val();
            let create_date = $(".create_date").val();

            $("#tbody4").empty();

            if(typeof(input_headerid) == "undefined" && create_date != ''){
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_forminttbn040_03/get_item/inttbn040/03",
                    data: {
                        create_date
                    },
                    dataType: "json",
                    success: function(res) {

                        if(res.status == 1){
                            let list_dtl = '';
                            $.each(res.data, function(key,list_item_row) {
                                list_dtl += `
                                        <tr>
                                            <td><input type="hidden" class="form-control w-auto nama_mesin" name="nama_mesin[]" id="nama_mesin" style="text-align: center;" value="${list_item_row.item1}">${list_item_row.item1}</td>
                                            <td><input type="hidden" class="form-control w-auto kode_mesin" name="kode_mesin[]" id="kode_mesin" style="text-align: center;" value="${list_item_row.item2}">${list_item_row.item2}</td>
                                            <td><input type="hidden" class="form-control w-auto parameter" name="parameter[]" id="parameter" style="text-align: center;" value="${list_item_row.item3}">${list_item_row.item3}</td>
                                            <td><input type="text" class="form-control w-auto dtl_opr1" size="10" name="dtl_opr1[]" id="dtl_opr1" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr2" size="10" name="dtl_opr2[]" id="dtl_opr2" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr3" size="10" name="dtl_opr3[]" id="dtl_opr3" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr4" size="10" name="dtl_opr4[]" id="dtl_opr4" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr5" size="10" name="dtl_opr5[]" id="dtl_opr5" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr6" size="10" name="dtl_opr6[]" id="dtl_opr6" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr7" size="10" name="dtl_opr7[]" id="dtl_opr7" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr8" size="10" name="dtl_opr8[]" id="dtl_opr8" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr9" size="10" name="dtl_opr9[]" id="dtl_opr9" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr10" size="10" name="dtl_opr10[]" id="dtl_opr10" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr11" size="10" name="dtl_opr11[]" id="dtl_opr11" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr12" size="10" name="dtl_opr12[]" id="dtl_opr12" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr13" size="10" name="dtl_opr13[]" id="dtl_opr13" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr14" size="10" name="dtl_opr14[]" id="dtl_opr14" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr15" size="10" name="dtl_opr15[]" id="dtl_opr15" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr16" size="10" name="dtl_opr16[]" id="dtl_opr16" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr17" size="10" name="dtl_opr17[]" id="dtl_opr17" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr18" size="10" name="dtl_opr18[]" id="dtl_opr18" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr19" size="10" name="dtl_opr19[]" id="dtl_opr19" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr20" size="10" name="dtl_opr20[]" id="dtl_opr20" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr21" size="10" name="dtl_opr21[]" id="dtl_opr21" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr22" size="10" name="dtl_opr22[]" id="dtl_opr22" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr23" size="10" name="dtl_opr23[]" id="dtl_opr23" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr24" size="10" name="dtl_opr24[]" id="dtl_opr24" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr25" size="10" name="dtl_opr25[]" id="dtl_opr25" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr26" size="10" name="dtl_opr26[]" id="dtl_opr26" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr27" size="10" name="dtl_opr27[]" id="dtl_opr27" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr28" size="10" name="dtl_opr28[]" id="dtl_opr28" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr29" size="10" name="dtl_opr29[]" id="dtl_opr29" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr30" size="10" name="dtl_opr30[]" id="dtl_opr30" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr31" size="10" name="dtl_opr31[]" id="dtl_opr31" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr32" size="10" name="dtl_opr32[]" id="dtl_opr32" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr33" size="10" name="dtl_opr33[]" id="dtl_opr33" style="text-align: center;" value=""></td>
                                            <td><input type="text" class="form-control w-auto dtl_opr34" size="10" name="dtl_opr34[]" id="dtl_opr34" style="text-align: center;" value=""></td>
                                        </tr>
                                `;
                            })
                            $("#tbody4").append(list_dtl);
                            notif_btnconfirm_custom('success', res.pesan);
                        } else {
                            notif_btnconfirm_custom('success', res.pesan);
                        }
                    }
                });
            }
        }

        $(document).on('keyup', '.rumus_rumus', function () {
            let that       = $(this);
            let soft_awal  = that.closest('tr').find('.soft_awal').val();
            let soft_akhir = that.closest('tr').find('.soft_akhir').val();
            let pro_awal   = that.closest('tr').find('.pro_awal').val();
            let pro_akhir  = that.closest('tr').find('.pro_akhir').val();
            let soft_total = 0;
            let pro_total  = 0;

            soft_total = soft_akhir - soft_awal;
            that.closest('tr').find('.soft_total').val(soft_total);

            pro_total = pro_akhir - pro_awal;
            that.closest('tr').find('.pro_total').val(pro_total);
            console.log(pro_total)

            hitung_total('.soft_total', '.total_soft');
            hitung_total('.pro_total', '.total_pro');
        });

        $(document).on('keyup', '.produksi_rumus', function(){
            let that          = $(this);
            let feed_awal     = that.closest('tr').find('.feed_awal').val();
            let feed_akhir    = that.closest('tr').find('.feed_akhir').val();
            let product_flow  = that.closest('tr').find('.product_flow').val();
            let product_waktu = that.closest('tr').find('.product_waktu').val();
            let reject_flow   = that.closest('tr').find('.reject_flow').val();
            let reject_waktu  = that.closest('tr').find('.reject_waktu').val();

            let feed_total    = 0;
            let product_total = 0;
            let reject_total  = 0;

            feed_total = (feed_akhir - feed_awal).toFixed(2);
            that.closest('tr').find('#feed_total').val(feed_total);
            
            product_total = (product_waktu * product_flow).toFixed(2);
            that.closest('tr').find('#product_total').val(product_total);
            
            reject_total = (reject_waktu * reject_flow).toFixed(2);
            that.closest('tr').find('#reject_total').val(reject_total);

            hitung_total('.feed_total','.total_feed');
            hitung_total('.product_total','.total_product');
            hitung_total('.reject_total','.total_reject');
        });

        $(document).on('keyup', '.table_flow', function(){
            let that    = $(this);
            let flow_awal = that.closest('tr').find('.flow_awal').val();
            let flow_akhir = that.closest('tr').find('.flow_akhir').val();
            let awala = '';
            let akhira = '';
            let formula = '0';
            if (flow_awal == ''){
                awala = '0';
            } else {
                awala = flow_awal;
            }
            if (flow_akhir == ''){
                akhira = '0';
            } else {
                akhira = flow_akhir;
            }

            formula = (parseFloat(akhira) - parseFloat(awala));
            that.closest('tr').find('.formula').val(formula);
        });
        // $(document).on('change', '.read_only', function(){
        //     readonly('.feed_cl');
        // });

        // function readonly(awal){
        //     let kolom_awal = $(awal);
        //     let length_kol = kolom_awal.length;

        //     for (let array = 0; array < kolom_awal.length; array++){
        //         console.log(array);
        //         if (array == '0'){
        //             $(awal).prop('readonly', false);
        //         } else{
        //             $(awal).prop('readonly', true);
        //         }
        //     }
        // }

        function hitung_total(awal, akhir){
            let nilai_awal  = $(awal);
            let nilai_akhir = 0;

            for (let i = 0; i < nilai_awal.length; i++){
                let isi_nilai = 0;
                if(nilai_awal[i].value !== ""){
                    isi_nilai = nilai_awal[i].value;
                }
                nilai_akhir += parseFloat(isi_nilai);
                // total = (nilai_akhir).toFixed(2);
            }
            $(akhir).val(isNaN(nilai_akhir) ? '0' : nilai_akhir);
        }

    });
</script>

<?php $this->load->view('template/footbarend'); ?>