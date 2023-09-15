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
    $headerid     = $header->headerid;

    $comment      = $header->comment;
    $comment_by   = $header->comment_by;
    $comment_time = $header->comment_time;
    $comment_date = date("d-m-Y", strtotime($header->comment_date));

    $create_date  = date("d-m-Y", strtotime($header->create_date));
    $docno        = $header->docno;
}

$base_url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$fcpath2   = str_replace('utl/', '', FCPATH);
$style_ttd = 'style="width:130px; height:80px; background-size:100%;"'; ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content mt-2">
                    <div class="col-md-12 d-flex justify-content-center mb-1">
                        <div class="col-md-2 content-center mt-1">
                            <table class="table table-condensed">
                                <tr>
                                    <td style="text-align:center; font-weight: bold;"><img src="<?= base_url('assets/images/PSG_logo_2022.png') ?>" /></td>
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
                                    <td style="text-align:left; font-weight: bold;">Doc. No</td>
                                    <td style="text-align:left; font-weight: bold;">: <?= $docno; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left; font-weight: bold;">Tanggal Laporan </td>
                                    <td style="text-align:left; font-weight: bold;">: <?= $create_date; ?> </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12" align="left">
                            <?php if (isset($leftheader)) {
                                echo '<td style="text-align:left; font-weight: bold;"><b>';
                                foreach ($leftheader as $rowleft) {
                                    echo $rowleft . '</br>';
                                }
                                echo "</b></td>"; ?>
                            <?php
                            } elseif (isset($comment)) { ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Laporan ini Sebelumnya telah Disapprove oleh <?= $comment_by; ?>, pada
                                        <?= $comment_date; ?> <?= $comment_time; ?>, komentar : <?= $comment; ?></strong>
                                </div>
                            <?php
                            } ?>
                        </div>

                        <div class="col-12">
                            <div class="table-responsive scrolly_table" id="scrolling_table_1" style="max-height: 800px;">
                                <table class="table table-striped table-bordered sticky-header">
                                    <thead class="table-info sticky-top">
                                        <tr>
                                            <th class="table-info align-middle text-center" rowspan="4">No.</th>
                                            <th class="table-info align-middle text-center" rowspan="4">Nama Mesin</th>
                                            <th class="table-info align-middle text-center" rowspan="4">Kode</th>
                                            <th class="table-info align-middle text-center" rowspan="4">Parameter</th>

                                        </tr>
                                        <tr>
                                            <?php for ($i = 1; $i <= 3; $i++) { ?>
                                                <th class="table-info align-middle text-center" colspan="8">Shift <?= $i ?></th>
                                            <?php
                                            } ?>
                                            <th class="table-info align-middle text-center" rowspan="4">Keterangan</th>
                                        </tr>
                                        <tr>
                                            <?php $shift_jam = 6;
                                            for ($i = 1; $i <= 3; $i++) { ?>
                                                <th class="table-info align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                <th class="table-info align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                <th class="table-info align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                <th class="table-info align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                <th class="table-info align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                <th class="table-info align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                <th class="table-info align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                <th class="table-info align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        if (!empty($dtdetail)) {
                                            foreach ($dtdetail as $dtdetail_key => $dtdetail_row) {

                                                // ini mau nampilin list item aja 
                                                if ($dtdetail_row->shift == 'shift_1') { ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <?php if ($dtdetail_row->no_urut_mesin == 1) { // gabungin jadi satu kolom dan tulisan miring per nama mesin?>
                                                            <td align="center" rowspan="<?= ($dtdetail_row->jml_per_mesin * $dtdetail_row->jml_per_kode) ?>"><b><?= $dtdetail_row->nama_mesin ?></b></td> 
                                                        <?php } ?>
                                                        <?php if ($dtdetail_row->no_urut_kode == 1) { // gabungin jadi satu kolom dan tulisan miring per nama mesin?>
                                                            <td align="center" rowspan="<?= ($dtdetail_row->jml_per_kode) ?>"><b><?= $dtdetail_row->kode ?></b></td> 
                                                        <?php } ?>
                                                        <td align="left"><?= $dtdetail_row->parameter ?></td>

                                                        <?php for ($i = 1; $i <= 3; $i++) {
                                                            foreach ($dtdetail as ${'dtdetail_key_sf' . $i} => ${'dtdetail_row_sf' . $i}) {
                                                                // extrak isi data per shift
                                                                if (
                                                                    ${'dtdetail_row_sf' . $i}->shift == 'shift_' . $i
                                                                    && $dtdetail_row->nama_mesin == ${'dtdetail_row_sf' . $i}->nama_mesin
                                                                    && $dtdetail_row->kode == ${'dtdetail_row_sf' . $i}->kode
                                                                    && $dtdetail_row->parameter == ${'dtdetail_row_sf' . $i}->parameter
                                                                ) { ?>
                                                                    <td align="center"><?= ${'dtdetail_row_sf' . $i}->cek_shift_jam1 ?></td>
                                                                    <td align="center"><?= ${'dtdetail_row_sf' . $i}->cek_shift_jam2 ?></td>
                                                                    <td align="center"><?= ${'dtdetail_row_sf' . $i}->cek_shift_jam3 ?></td>
                                                                    <td align="center"><?= ${'dtdetail_row_sf' . $i}->cek_shift_jam4 ?></td>
                                                                    <td align="center"><?= ${'dtdetail_row_sf' . $i}->cek_shift_jam5 ?></td>
                                                                    <td align="center"><?= ${'dtdetail_row_sf' . $i}->cek_shift_jam6 ?></td>
                                                                    <td align="center"><?= ${'dtdetail_row_sf' . $i}->cek_shift_jam7 ?></td>
                                                                    <td align="center"><?= ${'dtdetail_row_sf' . $i}->cek_shift_jam8 ?></td>

                                                        <?php break;
                                                                }
                                                            }
                                                        }

                                                        echo $dtdetail_key == 0 ? '<td align="left" class="align-top" style="background-color:white;" rowspan="' . (count($dtdetail) / 3) . '">
                                                                                <br><br>
                                                                                CF = Carbon filter<br>
                                                                                ST = Softener<br>
                                                                                SF = Sand Filter<br>
                                                                            </td>' : ''; ?>
                                                    </tr>

                                        <?php }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="table-info align-middle text-center" colspan="51"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <br>

                        <div class="col-12 mb-3">
                            <b>
                                <p style="text-align:center">Catatan KetidakSesuaian</p>
                            </b>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="table-danger align-middle text-center">No.</th>
                                            <th class="table-danger align-middle text-center">Jam</th>
                                            <th class="table-danger align-middle text-center">Uraian Ketidaksesuaian</th>
                                            <th class="table-danger align-middle text-center">Tindakan Perbaikan</th>
                                            <th class="table-danger align-middle text-center">Hasil Analisa</th>
                                            <th class="table-danger align-middle text-center">Nama</th>
                                            <th class="table-danger align-middle text-center">Paraf</th>
                                            <th class="table-danger align-middle text-center">Air Recycle</th>
                                            <th class="table-danger align-middle text-center">Terbuang</th>
                                            <th class="table-danger align-middle text-center">Keterangan</th>
                                        </tr>
                                        <tr>

                                        </tr>
                                    </thead>
                                    <tbody id="tbody2">
                                        <?php $no2 = 1;
                                        foreach ($dtdetail_b as $dtdetail_row2) {
                                            if (file_exists($fcpath2 . 'utl/assets/ttd/' . $dtdetail_row2->pj_personalstatus . '_' . $dtdetail_row2->pj_personalid . '.png')) {
                                                $pj_ttd = '<img src="' . $base_url2 . 'utl/assets/ttd/' . $dtdetail_row2->pj_personalstatus . '_' . $dtdetail_row2->pj_personalid . '.png" ' . $style_ttd . ' alt="">';
                                            } else if (
                                                $dtdetail_row2->pj_personalstatus == '1' && file_exists($fcpath2 . 'forviewfoto_pekerja/' . $dtdetail_row2->pj_personalid . '_0_0.png')
                                            ) {
                                                $pj_ttd = '<img src="' . $base_url2 . 'forviewfoto_pekerja/' . $dtdetail_row2->pj_personalid . '_0_0.png" ' . $style_ttd . ' alt="">';
                                            } else if (
                                                $dtdetail_row2->pj_personalstatus == '2' && file_exists($fcpath2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row2->pj_personalid . '.png')
                                            ) {
                                                $pj_ttd = '<img src="' . $base_url2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row2->pj_personalid . '.png" ' . $style_ttd . ' alt="">';
                                            } else {
                                                $pj_ttd = '';
                                            } ?>
                                            <tr>
                                                <td align="center"><?= $no2++ ?></td>
                                                <td align="center"><?= $dtdetail_row2->jam ?></td>
                                                <td><?= $dtdetail_row2->uraian ?></td>
                                                <td><?= $dtdetail_row2->tindakan ?></td>
                                                <td><?= $dtdetail_row2->hasil_analisa ?></td>
                                                <td align="center"><?= $dtdetail_row2->pj_nama ?></td>
                                                <td align="center"><?= $pj_ttd ?></td>
                                                <td><?= $dtdetail_row2->air_recycle ?></td>
                                                <td><?= $dtdetail_row2->terbuang ?></td>
                                                <td><?= $dtdetail_row2->keterangan ?></td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="table-danger align-middle text-center" colspan="10">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>


                        <div class="row mb-1">
                            <div class="col-6">
                                <div class="form-group row">
                                    <div class="col-12 mt-1">
                                        <?php $this->load->view('laporan/V_laporan_definisi'); ?>
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
                                <?php
                                } ?>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <span class="pull-left">Mulai Berlaku: <?= $frmefec; ?></span>
                                <span class="pull-right"><?= $frmnm . '-' . $frmvrs; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('template/footbar'); ?>

<?php $this->load->view('template/footbarend'); ?>