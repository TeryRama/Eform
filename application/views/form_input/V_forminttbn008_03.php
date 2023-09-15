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
        $headerid                      = $row->headerid;
        $comment                       = $row->comment;
        $comment_by                    = $row->comment_by;
        $comment_time                  = $row->comment_time;
        $comment_date                  = date("d-m-Y", strtotime($row->comment_date));
        $create_date                   = date("d-m-Y", strtotime($row->create_date));
        $bulan                         = $row->bulan;
        $tahun                         = $row->tahun;
        $docno                         = $row->docno;
        $batubara_stock_awal_total     = $row->batubara_stock_awal_total;
        $batubara_terima_total         = $row->batubara_terima_total;
        $batubara_pakai_total          = $row->batubara_pakai_total;
        $batubara_stock_akhir_total    = $row->batubara_stock_akhir_total;
        $debu_arang_terima_total       = $row->debu_arang_terima_total;
        $debu_arang_pakai_total        = $row->debu_arang_pakai_total;
        $tempurung_stock_awal_total    = $row->tempurung_stock_awal_total;
        $tempurung_terima_total        = $row->tempurung_terima_total;
        $tempurung_pakai_total         = $row->tempurung_pakai_total;
        $tempurung_stock_akhir_total   = $row->tempurung_stock_akhir_total;
        $sabut_stock_awal_total        = $row->sabut_stock_awal_total;
        $sabut_terima_total            = $row->sabut_terima_total;
        $sabut_pakai_total             = $row->sabut_pakai_total;
        $sabut_stock_akhir_total       = $row->sabut_stock_akhir_total;
        $cocopiet_terima_total         = $row->cocopiet_terima_total;
        $cocopiet_pakai_total          = $row->cocopiet_pakai_total;
        $total_pakai_bahan_bakar_total = $row->total_pakai_bahan_bakar_total;
        $batubara_stock_awal_rata2     = $row->batubara_stock_awal_rata2;
        $batubara_terima_rata2         = $row->batubara_terima_rata2;
        $batubara_pakai_rata2          = $row->batubara_pakai_rata2;
        $batubara_stock_akhir_rata2    = $row->batubara_stock_akhir_rata2;
        $debu_arang_terima_rata2       = $row->debu_arang_terima_rata2;
        $debu_arang_pakai_rata2        = $row->debu_arang_pakai_rata2;
        $tempurung_stock_awal_rata2    = $row->tempurung_stock_awal_rata2;
        $tempurung_terima_rata2        = $row->tempurung_terima_rata2;
        $tempurung_pakai_rata2         = $row->tempurung_pakai_rata2;
        $tempurung_stock_akhir_rata2   = $row->tempurung_stock_akhir_rata2;
        $sabut_stock_awal_rata2        = $row->sabut_stock_awal_rata2;
        $sabut_terima_rata2            = $row->sabut_terima_rata2;
        $sabut_pakai_rata2             = $row->sabut_pakai_rata2;
        $sabut_stock_akhir_rata2       = $row->sabut_stock_akhir_rata2;
        $cocopiet_terima_rata2         = $row->cocopiet_terima_rata2;
        $cocopiet_pakai_rata2          = $row->cocopiet_pakai_rata2;
        $total_pakai_bahan_bakar_rata2 = $row->total_pakai_bahan_bakar_rata2;
    }
} else if (isset($message)) {
    $aksi                          = "dtsave";
    $create_date                   = $create_date;
    $bulan                         = $bulan;
    $docno                         = $docno;
    $batubara_stock_awal_total     = $batubara_stock_awal_total;
    $batubara_terima_total         = $batubara_terima_total;
    $batubara_pakai_total          = $batubara_pakai_total;
    $batubara_stock_akhir_total    = $batubara_stock_akhir_total;
    $debu_arang_terima_total       = $debu_arang_terima_total;
    $debu_arang_pakai_total        = $debu_arang_pakai_total;
    $tempurung_stock_awal_total    = $tempurung_stock_awal_total;
    $tempurung_terima_total        = $tempurung_terima_total;
    $tempurung_pakai_total         = $tempurung_pakai_total;
    $tempurung_stock_akhir_total   = $tempurung_stock_akhir_total;
    $sabut_stock_awal_total        = $sabut_stock_awal_total;
    $sabut_terima_total            = $sabut_terima_total;
    $sabut_pakai_total             = $sabut_pakai_total;
    $sabut_stock_akhir_total       = $sabut_stock_akhir_total;
    $cocopiet_terima_total         = $cocopiet_terima_total;
    $cocopiet_pakai_total          = $cocopiet_pakai_total;
    $total_pakai_bahan_bakar_total = $total_pakai_bahan_bakar_total;
    $batubara_stock_awal_rata2     = $batubara_stock_awal_rata2;
    $batubara_terima_rata2         = $batubara_terima_rata2;
    $batubara_pakai_rata2          = $batubara_pakai_rata2;
    $batubara_stock_akhir_rata2    = $batubara_stock_akhir_rata2;
    $debu_arang_terima_rata2       = $debu_arang_terima_rata2;
    $debu_arang_pakai_rata2        = $debu_arang_pakai_rata2;
    $tempurung_stock_awal_rata2    = $tempurung_stock_awal_rata2;
    $tempurung_terima_rata2        = $tempurung_terima_rata2;
    $tempurung_pakai_rata2         = $tempurung_pakai_rata2;
    $tempurung_stock_akhir_rata2   = $tempurung_stock_akhir_rata2;
    $sabut_stock_awal_rata2        = $sabut_stock_awal_rata2;
    $sabut_terima_rata2            = $sabut_terima_rata2;
    $sabut_pakai_rata2             = $sabut_pakai_rata2;
    $sabut_stock_akhir_rata2       = $sabut_stock_akhir_rata2;
    $cocopiet_terima_rata2         = $cocopiet_terima_rata2;
    $cocopiet_pakai_rata2          = $cocopiet_pakai_rata2;
    $total_pakai_bahan_bakar_rata2 = $total_pakai_bahan_bakar_rata2;
} else {
    $aksi                          = "dtsave";
    $create_date                   = date("d-m-Y", strtotime($dtcreate_date));
    $tahun                         = '';
    $bulan                         = '';
    $docno                         = '';
    $batubara_stock_awal_total     = '0.00';
    $batubara_terima_total         = '0.00';
    $batubara_pakai_total          = '0.00';
    $batubara_stock_akhir_total    = '0.00';
    $debu_arang_terima_total       = '0.00';
    $debu_arang_pakai_total        = '0.00';
    $tempurung_stock_awal_total    = '0.00';
    $tempurung_terima_total        = '0.00';
    $tempurung_pakai_total         = '0.00';
    $tempurung_stock_akhir_total   = '0.00';
    $sabut_stock_awal_total        = '0.00';
    $sabut_terima_total            = '0.00';
    $sabut_pakai_total             = '0.00';
    $sabut_stock_akhir_total       = '0.00';
    $cocopiet_terima_total         = '0.00';
    $cocopiet_pakai_total          = '0.00';
    $total_pakai_bahan_bakar_total = '0.00';
    $batubara_stock_awal_rata2     = '0.00';
    $batubara_terima_rata2         = '0.00';
    $batubara_pakai_rata2          = '0.00';
    $batubara_stock_akhir_rata2    = '0.00';
    $debu_arang_terima_rata2       = '0.00';
    $debu_arang_pakai_rata2        = '0.00';
    $tempurung_stock_awal_rata2    = '0.00';
    $tempurung_terima_rata2        = '0.00';
    $tempurung_pakai_rata2         = '0.00';
    $tempurung_stock_akhir_rata2   = '0.00';
    $sabut_stock_awal_rata2        = '0.00';
    $sabut_terima_rata2            = '0.00';
    $sabut_pakai_rata2             = '0.00';
    $sabut_stock_akhir_rata2       = '0.00';
    $cocopiet_terima_rata2         = '0.00';
    $cocopiet_pakai_rata2          = '0.00';
    $total_pakai_bahan_bakar_rata2 = '0.00';
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
                        <h2>
                            <h4>DEPARTEMEN PWP-TBN</h4>
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

                        <form action="<?= base_url('form_input/C_forminttbn008_03/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="forminttbn008" name="forminttbn008" method="post" role="form" autocomplete="off" enctype="multipart/form-data">

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
                                            <?php if (isset($dtheader) || isset($message)) { ?>
                                                <input type="text" name="create_date" id="create_date" class="form-control create_date" value="<?= $create_date; ?>" readonly required>
                                            <?php } else { ?>
                                                <input type="text" name="create_date" id="create_date" class="form-control datepicker maskdate create_date" value="<?= $create_date; ?>" required>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Bulan
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="bulan" id="bulan" class="form-control bulan dtopen_blok" value="<?= $bulan; ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Tahun
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="tahun" id="tahun" class="form-control tahun dtopen_blok" value="<?= $tahun; ?>" readonly required>
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

                            <div class="card-content">
                                <div class="row">
                                    <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                        <table id="myTable" class="table table-bordered table-hover">

                                            <?php if (!isset($message)) { ?>
                                                <thead class="fixed freeze_vertical">
                                                    <tr>
                                                        <th class="align-middle text-center" style="background-color: white;" rowspan="2" colspan="1">No.</th>
                                                        <th class="align-middle text-center" style="background-color: white;" rowspan="2" colspan="1">Tanggal</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="4">Batubara</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="2">Debu Arang</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="4">Tempurung</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="4">Sabut</th>
                                                        <th class="table-secondary align-middle text-center" rowspan="1" colspan="2">Cocopiet</th>
                                                        <th class="align-middle text-center" style="background-color: white;" rowspan="2" colspan="1">Total Pakai <br> Bahan Bakar <br> (a+b+c+d)</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Stock Awal <br> Batubara</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Terima <br> Batubara</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Pakai <br> Batubara (a)</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Stock Akhir <br> Batubara</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Terima <br> Debu Arang</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Pakai <br> Debu Arang (b)</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Stock Awal <br> Tempurung</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Terima <br> Tempurung</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Pakai <br> Tempurung (c)</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Stock Akhir <br> Tempurung</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Stock Awal <br> Sabut</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Terima <br> Sabut</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Pakai <br> Sabut</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Stock Akhir <br> Sabut</th>
                                                        <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Terima <br> Cocopiet</th>
                                                        <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Pakai <br> Cocopiet (d)</th>
                                                    </tr>
                                                </thead>
                                            <?php } ?>

                                            <?php $no = 1; ?>
                                            <?php if (!isset($dtdetail)) {
                                                if (isset($message)) { ?>

                                                <?php } else { ?>
                                                    <tbody id="tbody_2">
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                <?php }
                                            } else { ?>
                                                <tbody>
                                                    <?php foreach ($dtdetail as $row) {
                                                        $tanggal_bahan_bakar = $row->tanggal_bahan_bakar;
                                                        $hari = substr($tanggal_bahan_bakar, 0, 2);
                                                        $trimhari = trim($hari, '-'); ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id[]" id="detail_id" class="detail_id form-control w-auto" style="text-align: center;" value="<?= $row->detail_id; ?>">
                                                            <td align="center" class="fixed"><?= $no++; ?></td>
                                                            <td align="center"><input type="text" name="tanggal_bahan_bakar[]" id="tanggal_bahan_bakar" class="tanggal_bahan_bakar form-control w-auto" style="text-align: center;" value="<?= $row->tanggal_bahan_bakar; ?>" readonly></td>

                                                            <td align="center"><input type="number" name="batubara_stock_awal[]" id="batubara_stock_awal" class="rumus rumus_row_bb batubara_stock_awal batubara_awal<?= $trimhari ?> form-control w-auto" style="text-align: center;" value="<?= $row->batubara_stock_awal; ?>"></td>
                                                            <td align="center"><input type="number" name="batubara_terima[]" id="batubara_terima" class="rumus rumus_row_bb batubara_terima form-control w-auto" style="text-align: center;" value="<?= $row->batubara_terima; ?>"></td>
                                                            <td align="center"><input type="number" name="batubara_pakai[]" id="batubara_pakai" class="rumus rumus_row_bb rumus_row_tpbb batubara_pakai form-control w-auto" style="text-align: center;" value="<?= $row->batubara_pakai; ?>"></td>
                                                            <td align="center"><input type="number" name="batubara_stock_akhir[]" id="batubara_stock_akhir" class="rumus batubara_stock_akhir batubara_akhir<?= $trimhari ?> form-control w-auto" style="text-align: center;" value="<?= $row->batubara_stock_akhir; ?>" readonly></td>

                                                            <td align="center"><input type="number" name="debu_arang_terima[]" id="debu_arang_terima" class="rumus rumus_row_da rumus_row_tpbb debu_arang_terima form-control w-auto" style="text-align: center;" value="<?= $row->debu_arang_terima; ?>"></td>
                                                            <td align="center"><input type="number" name="debu_arang_pakai[]" id="debu_arang_pakai" class="rumus debu_arang_pakai form-control w-auto" style="text-align: center;" value="<?= $row->debu_arang_terima; ?>" readonly></td>

                                                            <td align="center"><input type="number" name="tempurung_stock_awal[]" id="tempurung_stock_awal" class="rumus rumus_row_t tempurung_stock_awal tempurung_awal<?= $trimhari ?> form-control w-auto" style="text-align: center;" value="<?= $row->tempurung_stock_awal; ?>"></td>
                                                            <td align="center"><input type="number" name="tempurung_terima[]" id="tempurung_terima" class="rumus rumus_row_t tempurung_terima form-control w-auto" style="text-align: center;" value="<?= $row->tempurung_terima; ?>"></td>
                                                            <td align="center"><input type="number" name="tempurung_pakai[]" id="tempurung_pakai" class="rumus rumus_row_t rumus_row_tpbb tempurung_pakai form-control w-auto" style="text-align: center;" value="<?= $row->tempurung_pakai; ?>"></td>
                                                            <td align="center"><input type="number" name="tempurung_stock_akhir[]" id="tempurung_stock_akhir" class="rumus tempurung_stock_akhir tempurung_akhir<?= $trimhari ?> form-control w-auto" style="text-align: center;" value="<?= $row->tempurung_stock_akhir; ?>" readonly></td>

                                                            <td align="center"><input type="number" name="sabut_stock_awal[]" id="sabut_stock_awal" class="rumus rumus_row_s sabut_stock_awal sabut_awal<?= $trimhari ?> form-control w-auto" style="text-align: center;" value="<?= $row->sabut_stock_awal; ?>"></td>
                                                            <td align="center"><input type="number" name="sabut_terima[]" id="sabut_terima" class="rumus rumus_row_s sabut_terima form-control w-auto" style="text-align: center;" value="<?= $row->sabut_terima; ?>"></td>
                                                            <td align="center"><input type="number" name="sabut_pakai[]" id="sabut_pakai" class="rumus rumus_row_s sabut_pakai form-control w-auto tes_hsl" style="text-align: center;" value="<?= $row->sabut_pakai; ?>"></td>
                                                            <td align="center"><input type="number" name="sabut_stock_akhir[]" id="sabut_stock_akhir" class="rumus sabut_stock_akhir sabut_akhir<?= $trimhari ?> form-control w-auto" style="text-align: center;" value="<?= $row->sabut_stock_akhir; ?>" readonly></td>

                                                            <td align="center"><input type="number" name="cocopiet_terima[]" id="cocopiet_terima" class="rumus rumus_row_c rumus_row_tpbb cocopiet_terima form-control w-auto" style="text-align: center;" value="<?= $row->cocopiet_terima; ?>"></td>
                                                            <td align="center"><input type="number" name="cocopiet_pakai[]" id="cocopiet_pakai" class="rumus cocopiet_pakai  form-control w-auto" style="text-align: center;" value="<?= $row->cocopiet_pakai; ?>" readonly></td>

                                                            <td align="center"><input type="number" name="total_pakai_bahan_bakar[]" id="total_pakai_bahan_bakar" class="rumus total_pakai_bahan_bakar form-control w-auto" style="text-align: center;" value="<?= $row->total_pakai_bahan_bakar; ?>" readonly>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            <?php } ?>

                                            <?php if (!isset($message)) { ?>
                                                <tfoot>
                                                    <tr>
                                                        <td class="align-middle text-center" style="background-color: white;" rowspan="1" colspan="2">Total</td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="batubara_stock_awal_total" id="batubara_stock_awal_total" class="batubara_stock_awal_total form-control" style="text-align: center;" value="<?= $batubara_stock_awal_total; ?>" readonly></td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="batubara_terima_total" id="batubara_terima_total" class="batubara_terima_total form-control" style="text-align: center;" value="<?= $batubara_terima_total; ?>" readonly></td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="batubara_pakai_total" id="batubara_pakai_total" class="batubara_pakai_total form-control" style="text-align: center;" value="<?= $batubara_pakai_total; ?>" readonly></td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="batubara_stock_akhir_total" id="batubara_stock_akhir_total" class="batubara_stock_akhir_total form-control" style="text-align: center;" value="<?= $batubara_stock_akhir_total; ?>" readonly></td>

                                                        <td class="table-warning align-middle text-center"><input type="number" name="debu_arang_terima_total" id="debu_arang_terima_total" class="debu_arang_terima_total form-control" style="text-align: center;" value="<?= $debu_arang_terima_total; ?>" readonly></td>
                                                        <td class="table-warning align-middle text-center"><input type="number" name="debu_arang_pakai_total" id="debu_arang_pakai_total" class="debu_arang_pakai_total form-control" style="text-align: center;" value="<?= $debu_arang_pakai_total; ?>" readonly></td>

                                                        <td class="table-success align-middle text-center"><input type="number" name="tempurung_stock_awal_total" id="tempurung_stock_awal_total" class="tempurung_stock_awal_total form-control" style="text-align: center;" value="<?= $tempurung_stock_awal_total; ?>" readonly></td>
                                                        <td class="table-success align-middle text-center"><input type="number" name="tempurung_terima_total" id="tempurung_terima_total" class="tempurung_terima_total form-control" style="text-align: center;" value="<?= $tempurung_terima_total; ?>" readonly></td>
                                                        <td class="table-success align-middle text-center"><input type="number" name="tempurung_pakai_total" id="tempurung_pakai_total" class="tempurung_pakai_total form-control" style="text-align: center;" value="<?= $tempurung_pakai_total; ?>" readonly></td>
                                                        <td class="table-success align-middle text-center"><input type="number" name="tempurung_stock_akhir_total" id="tempurung_stock_akhir_total" class="tempurung_stock_akhir_total form-control" style="text-align: center;" value="<?= $tempurung_stock_akhir_total; ?>" readonly></td>

                                                        <td class="table-primary align-middle text-center"><input type="number" name="sabut_stock_awal_total" id="sabut_stock_awal_total" class="sabut_stock_awal_total form-control" style="text-align: center;" value="<?= $sabut_stock_awal_total; ?>" readonly></td>
                                                        <td class="table-primary align-middle text-center"><input type="number" name="sabut_terima_total" id="sabut_terima_total" class="sabut_terima_total form-control" style="text-align: center;" value="<?= $sabut_terima_total; ?>" readonly></td>
                                                        <td class="table-primary align-middle text-center"><input type="number" name="sabut_pakai_total" id="sabut_pakai_total" class="sabut_pakai_total form-control" style="text-align: center;" value="<?= $sabut_pakai_total; ?>" readonly></td>
                                                        <td class="table-primary align-middle text-center"><input type="number" name="sabut_stock_akhir_total" id="sabut_stock_akhir_total" class="sabut_stock_akhir_total form-control" style="text-align: center;" value="<?= $sabut_stock_akhir_total; ?>" readonly></td>

                                                        <td class="table-secondary align-middle text-center"><input type="number" name="cocopiet_terima_total" id="cocopiet_terima_total" class="cocopiet_terima_total form-control" style="text-align: center;" value="<?= $cocopiet_terima_total; ?>" readonly></td>
                                                        <td class="table-secondary align-middle text-center"><input type="number" name="cocopiet_pakai_total" id="cocopiet_pakai_total" class="cocopiet_pakai_total form-control" style="text-align: center;" value="<?= $cocopiet_pakai_total; ?>" readonly></td>

                                                        <td class="align-middle text-center" style="background-color: white;"><input type="number" name="total_pakai_bahan_bakar_total" id="total_pakai_bahan_bakar_total" class="total_pakai_bahan_bakar_total form-control" style="text-align: center;" value="<?= $total_pakai_bahan_bakar_total; ?>" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle text-center" style="background-color: white;" rowspan="1" colspan="2">Rata-Rata</td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="batubara_stock_awal_rata2" id="batubara_stock_awal_rata2" class="batubara_stock_awal_rata2 form-control" style="text-align: center;" value="<?= $batubara_stock_awal_rata2; ?>" readonly></td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="batubara_terima_rata2" id="batubara_terima_rata2" class="batubara_terima_rata2 form-control" style="text-align: center;" value="<?= $batubara_terima_rata2; ?>" readonly></td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="batubara_pakai_rata2" id="batubara_pakai_rata2" class="batubara_pakai_rata2 form-control" style="text-align: center;" value="<?= $batubara_pakai_rata2; ?>" readonly></td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="batubara_stock_akhir_rata2" id="batubara_stock_akhir_rata2" class="batubara_stock_akhir_rata2 form-control" style="text-align: center;" value="<?= $batubara_stock_akhir_rata2; ?>" readonly></td>

                                                        <td class="table-warning align-middle text-center"><input type="number" name="debu_arang_terima_rata2" id="debu_arang_terima_rata2" class="debu_arang_terima_rata2 form-control" style="text-align: center;" value="<?= $debu_arang_terima_rata2; ?>" readonly></td>
                                                        <td class="table-warning align-middle text-center"><input type="number" name="debu_arang_pakai_rata2" id="debu_arang_pakai_rata2" class="debu_arang_pakai_rata2 form-control" style="text-align: center;" value="<?= $debu_arang_pakai_rata2; ?>" readonly></td>

                                                        <td class="table-success align-middle text-center"><input type="number" name="tempurung_stock_awal_rata2" id="tempurung_stock_awal_rata2" class="tempurung_stock_awal_rata2 form-control" style="text-align: center;" value="<?= $tempurung_stock_awal_rata2; ?>" readonly></td>
                                                        <td class="table-success align-middle text-center"><input type="number" name="tempurung_terima_rata2" id="tempurung_terima_rata2" class="tempurung_terima_rata2 form-control" style="text-align: center;" value="<?= $tempurung_terima_rata2; ?>" readonly></td>
                                                        <td class="table-success align-middle text-center"><input type="number" name="tempurung_pakai_rata2" id="tempurung_pakai_rata2" class="tempurung_pakai_rata2 form-control" style="text-align: center;" value="<?= $tempurung_pakai_rata2; ?>" readonly></td>
                                                        <td class="table-success align-middle text-center"><input type="number" name="tempurung_stock_akhir_rata2" id="tempurung_stock_akhir_rata2" class="tempurung_stock_akhir_rata2 form-control" style="text-align: center;" value="<?= $tempurung_stock_akhir_rata2; ?>" readonly></td>

                                                        <td class="table-primary align-middle text-center"><input type="number" name="sabut_stock_awal_rata2" id="sabut_stock_awal_rata2" class="sabut_stock_awal_rata2 form-control" style="text-align: center;" value="<?= $sabut_stock_awal_rata2; ?>" readonly></td>
                                                        <td class="table-primary align-middle text-center"><input type="number" name="sabut_terima_rata2" id="sabut_terima_rata2" class="sabut_terima_rata2 form-control" style="text-align: center;" value="<?= $sabut_terima_rata2; ?>" readonly></td>
                                                        <td class="table-primary align-middle text-center"><input type="number" name="sabut_pakai_rata2" id="sabut_pakai_rata2" class="sabut_pakai_rata2 form-control" style="text-align: center;" value="<?= $sabut_pakai_rata2; ?>" readonly></td>
                                                        <td class="table-primary align-middle text-center"><input type="number" name="sabut_stock_akhir_rata2" id="sabut_stock_akhir_rata2" class="sabut_stock_akhir_rata2 form-control" style="text-align: center;" value="<?= $sabut_stock_akhir_rata2; ?>" readonly></td>

                                                        <td class="table-secondary align-middle text-center"><input type="number" name="cocopiet_terima_rata2" id="cocopiet_terima_rata2" class="cocopiet_terima_rata2 form-control" style="text-align: center;" value="<?= $cocopiet_terima_rata2; ?>" readonly></td>
                                                        <td class="table-secondary align-middle text-center"><input type="number" name="cocopiet_pakai_rata2" id="cocopiet_pakai_rata2" class="cocopiet_pakai_rata2 form-control" style="text-align: center;" value="<?= $cocopiet_pakai_rata2; ?>" readonly></td>

                                                        <td class="align-middle text-center" style="background-color: white;"><input type="number" name="total_pakai_bahan_bakar_rata2" id="total_pakai_bahan_bakar_rata2" class="total_pakai_bahan_bakar_rata2 form-control" style="text-align: center;" value="<?= $total_pakai_bahan_bakar_rata2; ?>" readonly></td>
                                                    </tr>
                                                </tfoot>
                                            <?php } ?>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            <?php $this->load->view('laporan/V_laporan_definisi'); ?>

                            <div class="row mt-1">
                                <div class="col-12">
                                    <?php if (!isset($dtheader)) {
                                        if (!isset($message)) {
                                            if ($akses_create == '1') { ?>
                                                <button type="submit" class="btn bg-gradient-primary" id="btnsimpan">
                                                    <i class="feather icon-save"></i> Simpan</button>

                                                <button type="reset" class="btn bg-gradient-light">
                                                    <i class="feather icon-refresh-ccw"></i> Batal</button>
                                            <?php }
                                        } else {/*No Acess Create*/
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
            placeholder: ""
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
        get_bulan();
        get_tahun()
        get_tanggal_bahan_bakar();
        check_data();
    });

    $('.create_date').change(function() {
        get_docno();
        get_bulan();
        get_tahun()
        get_tanggal_bahan_bakar();
        check_data();
    });

    function get_docno() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn008_03/get_docno/inttbn008/03",
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

    function get_bulan() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn008_03/get_bulan/inttbn008/03",
                data: {
                    create_date
                },
                async: false,
                success: function(data) {
                    $('.bulan').val(JSON.parse(data)['data']);
                }
            });
        }
    }

    function get_tahun() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn008_03/get_tahun/inttbn008/03",
                data: {
                    create_date
                },
                async: false,
                success: function(data) {
                    $('.tahun').val(JSON.parse(data)['data']);
                }
            });
        }
    }

    function get_tanggal_bahan_bakar() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn008_03/get_tanggal_bahan_bakar/inttbn008/03",
                data: {
                    create_date
                },
                dataType: "json",
                async: false,
                success: function(data) {
                    let list_dtl_1 = '';
                    let no = 1;
                    if (data.status == 0) {
                        $.each(data.data, function(key, list_dtl_row) {
                            list_dtl_1 += `
                                            <tr>
                                                <input type="hidden" name="detail_id[]" id="detail_id" class="detail_id form-control w-auto" style="text-align: center;" value="">
                                                <td>${no++}</td>
                                                <td align="center" class="fixed"><input type="text" name="tanggal_bahan_bakar[]" id="tanggal_bahan_bakar" class="tanggal_bahan_bakar dtopen_blok form-control w-auto" style="text-align: center;" value="${list_dtl_row.hari}-${list_dtl_row.bulan}-${list_dtl_row.tahun}" readonly></td>
                                                
                                                <td align="center"><input type="number" name="batubara_stock_awal[]" id="batubara_stock_awal" class="rumus rumus_row_bb batubara_stock_awal batubara_awal${list_dtl_row.hari} form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="batubara_terima[]" id="batubara_terima" class="rumus rumus_row_bb batubara_terima form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="batubara_pakai[]" id="batubara_pakai" class="rumus rumus_row_bb rumus_row_tpbb batubara_pakai form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="batubara_stock_akhir[]" id="batubara_stock_akhir" class="rumus rumus_row_bb batubara_stock_akhir batubara_akhir${list_dtl_row.hari} form-control w-auto" style="text-align: center;" value="" readonly></td>

                                                <td align="center"><input type="number" name="debu_arang_terima[]" id="debu_arang_terima" class="rumus rumus_row_da rumus_row_tpbb debu_arang_terima form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="debu_arang_pakai[]" id="debu_arang_pakai" class="rumus debu_arang_pakai form-control w-auto" style="text-align: center;" value="" readonly></td>

                                                <td align="center"><input type="number" name="tempurung_stock_awal[]" id="tempurung_stock_awal" class="rumus rumus_row_t tempurung_stock_awal tempurung_awal${list_dtl_row.hari} form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="tempurung_terima[]" id="tempurung_terima" class="rumus rumus_row_t tempurung_terima form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="tempurung_pakai[]" id="tempurung_pakai" class="rumus rumus_row_t rumus_row_tpbb tempurung_pakai form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="tempurung_stock_akhir[]" id="tempurung_stock_akhir" class="rumus tempurung_stock_akhir tempurung_akhir${list_dtl_row.hari} form-control w-auto" style="text-align: center;" value="" readonly></td>

                                                <td align="center"><input type="number" name="sabut_stock_awal[]" id="sabut_stock_awal" class="rumus rumus_row_s sabut_stock_awal sabut_awal${list_dtl_row.hari} form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="sabut_terima[]" id="sabut_terima" class="rumus rumus_row_s sabut_terima form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="sabut_pakai[]" id="sabut_pakai" class="rumus rumus_row_s sabut_pakai form-control w-auto tes_hsl" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="sabut_stock_akhir[]" id="sabut_stock_akhir" class="rumus sabut_stock_akhir sabut_akhir${list_dtl_row.hari} form-control w-auto" style="text-align: center;" value="" readonly></td>

                                                <td align="center"><input type="number" name="cocopiet_terima[]" id="cocopiet_terima" class="rumus rumus_row_c rumus_row_tpbb cocopiet_terima form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="cocopiet_pakai[]" id="cocopiet_pakai" class="rumus cocopiet_pakai form-control w-auto" style="text-align: center;" value="" readonly></td>

                                                <td align="center"><input type="number" name="total_pakai_bahan_bakar[]" id="total_pakai_bahan_bakar" class="rumus total_pakai_bahan_bakar form-control w-auto" style="text-align: center;" value="" readonly></td>
                                            </tr>
                                         `;
                        });
                        $('#tbody_2').empty().append(list_dtl_1);
                    }
                    // console.log(data.vstatus)
                    // notif_btnconfirm_custom(data.vstatus, data.pesan);
                }
            });
        }
    }

    function check_data() {
        var input_headerid = $(".headerid").val();
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();

        // jika form input
        if (typeof(input_headerid) == "undefined" && bulan != '' && tahun != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn008_03/check_data/inttbn008/03",
                data: {
                    bulan,
                    tahun
                },
                dataType: "json",
                async: false,
                success: function(result) {
                    notif_btnconfirm_custom(result.vstatus, result.pesan);
                }
            });
        }
    }

    /* MENCARI NILAI ROW */
    $(document).on('input', '.rumus_row_bb', function() {
        let batubara_stock_awal = $(this).closest('tr').find('.batubara_stock_awal').val();
        let batubara_terima = $(this).closest('tr').find('.batubara_terima').val();
        let batubara_pakai = $(this).closest('tr').find('.batubara_pakai').val();
        let total = (parseFloat(batubara_stock_awal) + parseFloat(batubara_terima) - parseFloat(batubara_pakai)).toFixed(2);
        $(this).closest('tr').find('.batubara_stock_akhir').val(total);
    });

    $(document).on('input', '.rumus_row_da', function() {
        let debu_arang_terima = $(this).closest('tr').find('.debu_arang_terima').val();
        let total = (parseFloat(debu_arang_terima)).toFixed(2);
        $(this).closest('tr').find('.debu_arang_pakai').val(total);
    });

    $(document).on('input', '.rumus_row_t', function() {
        let tempurung_stock_awal = $(this).closest('tr').find('.tempurung_stock_awal').val();
        let tempurung_terima = $(this).closest('tr').find('.tempurung_terima').val();
        let tempurung_pakai = $(this).closest('tr').find('.tempurung_pakai').val();
        let total = (parseFloat(tempurung_stock_awal) + parseFloat(tempurung_terima) - parseFloat(tempurung_pakai)).toFixed(2);
        $(this).closest('tr').find('.tempurung_stock_akhir').val(total);
    });

    $(document).on('input', '.rumus_row_s', function() {
        let sabut_stock_awal = $(this).closest('tr').find('.sabut_stock_awal').val();
        let sabut_terima = $(this).closest('tr').find('.sabut_terima').val();
        let sabut_pakai = $(this).closest('tr').find('.sabut_pakai').val();
        let total = (parseFloat(sabut_stock_awal) + parseFloat(sabut_terima) - parseFloat(sabut_pakai)).toFixed(2);
        $(this).closest('tr').find('.sabut_stock_akhir').val(total);
    });

    $(document).on('input', '.rumus_row_c', function() {
        let cocopiet_terima = $(this).closest('tr').find('.cocopiet_terima').val();
        let total = (parseFloat(cocopiet_terima));
        $(this).closest('tr').find('.cocopiet_pakai').val(total).toFixed(2);
    });

    $(document).on('change', '.rumus_row_tpbb ', function() {
        let batubara_pakai = $(this).closest('tr').find('.batubara_pakai').val();
        let debu_arang_terima = $(this).closest('tr').find('.debu_arang_terima').val();
        let tempurung_pakai = $(this).closest('tr').find('.tempurung_pakai').val();
        let cocopiet_terima = $(this).closest('tr').find('.cocopiet_terima').val();
        let total = (parseFloat(batubara_pakai) + parseFloat(debu_arang_terima) + parseFloat(tempurung_pakai) + parseFloat(cocopiet_terima)).toFixed(2);
        $(this).closest('tr').find('.total_pakai_bahan_bakar').val(total);
    });
    /* AKHIR MENCARI NILAI ROW */

    $(document).on('change', '.rumus', function() {
        let date_length = $('.tanggal_bahan_bakar');
        for (let i = 1; i <= date_length.length; i++) {
            cari_nilai_awal('.batubara_akhir' + i, '.batubara_awal' + (parseFloat(i) + 1));
            cari_nilai_awal('.tempurung_akhir' + i, '.tempurung_awal' + (parseFloat(i) + 1));
            cari_nilai_awal('.sabut_akhir' + i, '.sabut_awal' + (parseFloat(i) + 1));
        }
        hitung_total('.batubara_stock_awal', '.batubara_stock_awal_total');
        hitung_total('.batubara_terima', '.batubara_terima_total');
        hitung_total('.batubara_pakai', '.batubara_pakai_total');
        hitung_total('.batubara_stock_akhir', '.batubara_stock_akhir_total');
        hitung_total('.debu_arang_terima', '.debu_arang_terima_total');
        hitung_total('.debu_arang_pakai', '.debu_arang_pakai_total');
        hitung_total('.tempurung_stock_awal', '.tempurung_stock_awal_total');
        hitung_total('.tempurung_terima', '.tempurung_terima_total');
        hitung_total('.tempurung_pakai', '.tempurung_pakai_total');
        hitung_total('.tempurung_stock_akhir', '.tempurung_stock_akhir_total');
        hitung_total('.sabut_stock_awal', '.sabut_stock_awal_total');
        hitung_total('.sabut_terima', '.sabut_terima_total');
        hitung_total('.sabut_pakai', '.sabut_pakai_total');
        hitung_total('.sabut_stock_akhir', '.sabut_stock_akhir_total');
        hitung_total('.cocopiet_terima', '.cocopiet_terima_total');
        hitung_total('.cocopiet_pakai', '.cocopiet_pakai_total');
        hitung_total('.total_pakai_bahan_bakar', '.total_pakai_bahan_bakar_total');
        hitung_rata2('.batubara_stock_awal', '.batubara_stock_awal_rata2');
        hitung_rata2('.batubara_terima', '.batubara_terima_rata2');
        hitung_rata2('.batubara_pakai', '.batubara_pakai_rata2');
        hitung_rata2('.batubara_stock_akhir', '.batubara_stock_akhir_rata2');
        hitung_rata2('.debu_arang_terima', '.debu_arang_terima_rata2');
        hitung_rata2('.debu_arang_pakai', '.debu_arang_pakai_rata2');
        hitung_rata2('.tempurung_stock_awal', '.tempurung_stock_awal_rata2');
        hitung_rata2('.tempurung_terima', '.tempurung_terima_rata2');
        hitung_rata2('.tempurung_pakai', '.tempurung_pakai_rata2');
        hitung_rata2('.tempurung_stock_akhir', '.tempurung_stock_akhir_rata2');
        hitung_rata2('.sabut_stock_awal', '.sabut_stock_awal_rata2');
        hitung_rata2('.sabut_terima', '.sabut_terima_rata2');
        hitung_rata2('.sabut_pakai', '.sabut_pakai_rata2');
        hitung_rata2('.sabut_stock_akhir', '.sabut_stock_akhir_rata2');
        hitung_rata2('.cocopiet_terima', '.cocopiet_terima_rata2');
        hitung_rata2('.cocopiet_pakai', '.cocopiet_pakai_rata2');
        hitung_rata2('.total_pakai_bahan_bakar', '.total_pakai_bahan_bakar_rata2');
        // hitung_row('.batubara_stock_awal', '.batubara_stock_akhir');
    });

    /* MENCARI NILAI ROW */
    // function hitung_row(awal, akhir) {
    //     let total = 0;
    //     let x = $(awal);
    //     for (let i = 0; i < x; i++) {
    //         let isi_nilai = 0;
    //         if (x[i].value !== "") {
    //             isi_nilai = x[i].value;
    //         }
    //         total += parseFloat(isi_nilai);
    //     }
    //     $(akhir).val(isNaN(total) ? '0.00' : total);
    // }
    /* AKHIR MENCARI NILAI ROW */

    /* MENCARI NILAI AWAL */
    function cari_nilai_awal(akhir, awal) {
        let stock_akhir = $(akhir).val();
        $(awal).val(stock_akhir);
        $(awal).attr('readonly', true);
    }
    /* AKHIR MENCARI NILAI AWAL */

    /* MENCARI NILAI TOTAL */
    function hitung_total(awal, akhir) {
        let nilai_awal = $(awal);
        let nilai_akhir = 0;
        for (let i = 0; i < nilai_awal.length; i++) {
            let isi_nilai = 0;
            if (nilai_awal[i].value !== "") {
                isi_nilai = nilai_awal[i].value;
            }
            nilai_akhir += parseFloat(isi_nilai);
            total = (nilai_akhir).toFixed(2);
        }
        $(akhir).val(isNaN(total) ? '0.00' : total);
    }
    /* AKHIR MENCARI NILAI TOTAL */

    /* MENCARI NILAI RATA - RATA */
    function hitung_rata2(awal, akhir) {
        let total = 0;
        let jml_row = 0;
        let rata_rata = 0;
        $(awal).each(function() {
            let val = parseInt(this.value, 10);
            if (!isNaN(val)) {
                jml_row += 1;
                total += val;
            }
        });
        rata_rata = (total / jml_row).toFixed(2);
        $(akhir).val(isNaN(rata_rata) ? '0.00' : rata_rata);
    }
    /* AKHIR MENCARI NILAI RATA - RATA */
</script>

<?php $this->load->view('template/footbarend'); ?>