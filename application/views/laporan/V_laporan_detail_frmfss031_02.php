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
    $headerid           = $header->headerid;

    $comment            = $header->comment;
    $comment_by         = $header->comment_by;
    $comment_time       = $header->comment_time;
    $comment_date       = date("d-m-Y", strtotime($header->comment_date));

    $create_date        = date("d-m-Y", strtotime($header->create_date));
    $docno              = $header->docno;
    $nama_mesin         = $header->nama_mesin;
    $kode_mesin         = $header->kode_mesin;
    $jam                = $header->jam;
    $total_operasi      = $header->total_operasi;
    $hasil_pengujian    = $header->hasil_pengujian;
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
                                    <td style="text-align:left; font-weight: bold;">Dok</td>
                                    <td style="text-align:left; font-weight: bold;">: <?php echo $docno; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left; font-weight: bold;">Tanggal Laporan </td>
                                    <td style="text-align:left; font-weight: bold;">: <?php echo $create_date; ?> </td>
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
                    <?php $this->load->view('template/V_onprocess'); ?>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="col-md-3 content-center mt-1">
                                    <table class="table table-condensed">
                                        <tr>
                                            <td style="text-align:left; font-weight: bold;">Nama Mesin</td>
                                            <td style="text-align:left; font-weight: bold;">: <?php echo $nama_mesin; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left; font-weight: bold;">Kode </td>
                                            <td style="text-align:left; font-weight: bold;">: <?php echo $kode_mesin; ?> </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left; font-weight: bold;">Total Operasi (jam) </td>
                                            <td style="text-align:left; font-weight: bold;">: <?php echo $total_operasi; ?> </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6 d-flex content-center">
                                    <!-- blank -->
                                </div>
                                <div class="col-md-3 content-center">
                                    <table class="table table-condensed">
                                        <tr>
                                            <td style="text-align:left; font-weight: bold;">Tanggal</td>
                                            <td style="text-align:left; font-weight: bold;">: <?php echo $create_date; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left; font-weight: bold;">Jam </td>
                                            <td style="text-align:left; font-weight: bold;">: <?php echo $jam; ?> </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive scrolly_table">
                                    <table class="table table-bordered sticky-header">
                                        <thead>
                                            <tr>
                                                <th class="table-primary align-middle text-center" rowspan="2">No.</th>
                                                <th class="table-primary align-middle text-center" rowspan="2">Bagian Mesin</th>
                                                <th class="table-primary align-middle text-center" rowspan="2">Kondisi/Masalah</th>
                                                <th class="table-primary align-middle text-center" rowspan="2">Tindakan</th>
                                                <th class="table-primary align-middle text-center" colspan="2">Suku Cadang</th>
                                                <th class="table-primary align-middle text-center" rowspan="2">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th class="table-primary align-middle text-center" rowspan="1">Jenis</th>
                                                <th class="table-primary align-middle text-center" rowspan="1">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($dtdetail)) {
                                                $no = 1;
                                                foreach ($dtdetail as $dtdetail_row) { ?>
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td align="center"><?= $dtdetail_row->bagian_mesin ?></td>
                                                        <td align="center"><?= $dtdetail_row->kondisi_masalah ?></td>
                                                        <td align="center"><?= $dtdetail_row->tindakan ?></td>
                                                        <td align="center"><?= $dtdetail_row->suku_cadang_jenis ?></td>
                                                        <td align="center"><?= $dtdetail_row->suku_cadang_jumlah ?></td>
                                                        <td align="center"><?= $dtdetail_row->keterangan ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-info align-middle text-right" colspan="13" align="center"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- <div class="col-6">
                                    <?php $this->load->view('laporan/V_laporan_definisi'); ?>
                                </div> -->
                        </div>

                        <div class="row mt-1">
                            <div class="col-6">

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        Hasil Pengujian/Running Test (coret yang tidak perlu)
                                    </div>
                                    <div class="col-md-6">
                                        <p>: <?= $hasil_pengujian; ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>

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
                                <span class="pull-left">Mulai Berlaku: <?= $frmefec; ?></span>
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