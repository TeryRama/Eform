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
    $headerid         = $header->headerid;
    $comment          = $header->comment;
    $comment_by       = $header->comment_by;
    $comment_time     = $header->comment_time;
    $comment_date     = date("d-m-Y", strtotime($header->comment_date));
    $create_date      = date("d-m-Y", strtotime($header->create_date));
    $docno            = $header->docno;
    $equipment_name   = $header->equipment_name;
    $equipment_code   = $header->equipment_code;
    $running_test     = $header->running_test;
    $operational_date = $header->operational_date;
}  ?>

<section id="basic-datatable">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 content-center justify-content-center">
                    <table class="table table-condensed">
                        <tr>
                            <td style="text-align:center; font-weight: bold;">
                                <img src="<?= base_url('assets/images/PSG_logo_2022.png') ?>" />
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-7 content-center">
                    <table class="table table-condensed">
                        <tr>
                            <td style="text-align:center; font-weight: bold;">
                                <h2><?= $this->config->item("nama_perusahaan"); ?></h2>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center; font-weight: bold;">
                                <h4><?= $frmjdl; ?></h4>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3">
                    <table>
                        <tr>
                            <td style="text-align:left; font-weight: bold;">Tanggal</td>
                            <td style="text-align:left; font-weight: bold;">: <?php echo $create_date; ?> </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; font-weight: bold;">Dokumen</td>
                            <td style="text-align:left; font-weight: bold;">: <?php echo $docno; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <?php if (isset($comment)) { ?>
                <div class="alert alert-danger mb-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4 class="alert-heading">Warning!</h4>
                    <p>Laporan ini Sebelumnya telah Disapprove oleh <?= $comment_by; ?>, pada <?= $comment_date; ?> <?= $comment_time; ?>, komentar : <?= $comment; ?></p>
                </div>
            <?php } ?>
            <?php $this->load->view('template/V_onprocess'); ?>
            <table>
                <tr>
                    <td style="text-align:left; font-weight: bold;">Nama Alat</td>
                    <td style="text-align:left; font-weight: bold;">: <?= $equipment_name; ?> </td>
                </tr>
                <tr>
                    <td style="text-align:left; font-weight: bold;">Kode Alat</td>
                    <td style="text-align:left; font-weight: bold;">: <?= $equipment_code; ?></td>
                </tr>
            </table>
            <br>
            <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="fixed freeze_vertical">
                        <tr>
                            <th class="table-primary align-middle text-center" rowspan="2">No</th>
                            <th class="table-primary align-middle text-center" rowspan="2">KONDISI MASALAH</th>
                            <th class="table-primary align-middle text-center" rowspan="2">TINDAKAN</th>
                            <th class="table-primary align-middle text-center" colspan="2">WAKTU</th>
                            <th class="table-primary align-middle text-center" rowspan="2">PEMAKAIAN </th>
                            <th class="table-primary align-middle text-center" rowspan="2">JUMLAH</th>
                            <th class="table-primary align-middle text-center" rowspan="2">KETERANGAN</th>
                        </tr>
                        <tr>
                            <th class="table-primary align-middle text-center">MULAI</th>
                            <th class="table-primary align-middle text-center">SELESAI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dtdetail as $row) { ?>
                            <tr>
                                <td style=" text-align: center;"><?= $no++; ?></td>
                                <td style=" text-align: center;"><?= $row->dta_problem_condition; ?></td>
                                <td style=" text-align: center;"><?= $row->dta_problem_solving; ?></td>
                                <td style=" text-align: center;"><?= $row->dta_start; ?></td>
                                <td style=" text-align: center;"><?= $row->dta_finish; ?></td>
                                <td style=" text-align: center;"><?= $row->dta_usage_material; ?></td>
                                <td style=" text-align: center;"><?= $row->dta_total; ?></td>
                                <td style=" text-align: center;"><?= $row->dta_remark; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="table-primary align-middle text-center" colspan="8" align="center">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <div class="table-responsive">
                        <table class="table table-borderless table-secondary">
                            <tr>
                                <td>Masa uji/running test</td>
                                <td><input type="text" name="running_test" id="running_test" class="form-control" style="text-align: center;" value="<?= $running_test; ?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Layak operasi tanggal</td>
                                <td><input type="text" name="operational_date" id="operational_date" class="form-control" style="text-align: center;" value="<?= $operational_date; ?>" readonly></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <?php $this->load->view('laporan/V_laporan_definisi'); ?>
            <?php $this->load->view('approval/V_tabelapp'); ?>
            <br>
            <div class="row">
                <div class="col-12" align="right">
                    <?php if ($akses_excel == '1') { ?>
                        <a class="btn bg-gradient-info" href="#" title="Export to Pdf" target="_blank" onclick="return confirm('EXPORT TO PDF... ?')"><i class="fa fa-file-pdf-o"></i> Export to Pdf</a>
                        <a class="btn bg-gradient-success" href="<?= base_url('export_excel/C_export_toexcel_' . $frmkd . '_' . $frmvrs . '/exportxls/' . $frmkd . '/' . $frmvrs . '/' . $headerid) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
                    <?php } else {
                        /*No Acess Excel*/
                    } ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <span class="pull-left">Mulai Berlaku : <?= $frmefec; ?></span>
                    <a href="?#"><span class="pull-right"><?= $frmnm . '-' . $frmvrs; ?></span></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('template/footbar'); ?>

<?php $this->load->view('template/footbarend'); ?>