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
                                                if ($dtdetail_row->parameter == 'Operasi ( menit )') {
                                                    $tr_color = 'bg-secondary';
                                                    $no = 1; // reset no per operasi menit

                                                    $vnama_mesin = '';
                                                    $vkode       = '';
                                                } else {
                                                    $tr_color = '';

                                                    $vnama_mesin = $dtdetail_row->nama_mesin;
                                                    $vkode       = $dtdetail_row->kode;
                                                }

                                                if ($no <= 2) {
                                                    $vitem1 = '<td align="center" rowspan="' . $dtdetail_row->jml_per_mesin . '"><b>' . $vnama_mesin . '</b></td>'; // gabungin jadi satu kolom dan tulisan miring per nama mesin
                                                } else {
                                                    $vitem1 = '';
                                                }
                                                // ini mau nampilin list item aja 
                                                if ($dtdetail_row->shift == 'shift_1') { ?>
                                                    <tr class="<?= $tr_color ?>">
                                                        <td><?= $no++ ?></td>
                                                        <?= $vitem1 ?>
                                                        <td align="center"><?= $vkode ?></td>
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
                                                                                PG : Pressure Gauge<br>
                                                                                DP  : Dosing Pump<br>
                                                                                FM :  Flow Meter<br>
                                                                                M3 : Meter kubik<br>
                                                                                <br><br>
                                                                                * CIP dilakukan jika :<br>
                                                                                a. Product turun10-15 % performa awal Min 17 m3/jam<br>
                                                                                b. Riject  Naik  5-10 % performa awal 8 m3/jam  Max<br>
                                                                                c. ∆P Pressure stage 1 dan stage 2 dan recovery<br>
                                                                                pressure naik 30% dari performa awal 12 Bar max<br>
                                                                                d. Maximum Selisih pressure stage 2<br> 
                                                                                dan Recovery  pressure  = 10 Bar max )<br>
                                                                                <br><br>
                                                                                Range :<br>
                                                                                FM :  Flow Meter<br>
                                                                                Inlet Pressure ( 1,8-2,2 )<br>
                                                                                outlet Pressure ( 1,8-2,2 )<br>
                                                                                Stage I ( 7,5-10 bar )<br>
                                                                                Stage II ( 6,5-9,0 bar )<br>
                                                                                Stage III ( 6,0-9,0 bar )<br>
                                                                                Riject pressure (5,0 -6,0) bar<br>
                                                                                product water I ( 0,4-0,8 ) bar<br>
                                                                                product water II( 0,4-0,8 ) bar<br>
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
                        <div class="col-6 mb-3">
                            <table class="table table-condensed table-borderless">
                                <thead>
                                    <tr>
                                        <th><b><i>Keterangan :</i></b></th>
                                        <th>√ = Sesuai Spesifikasi</th>
                                        <th>X = Tidak Sesuai Spesifikasi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="col-12">
                            <b>
                                <p style="text-align:center">Hasil Analisa Sebelum CIP</p>
                            </b>
                            <div class="table-responsive scrolly_table" id="scrolling_table_2" style="max-height: 800px;">
                                <table class="table table-striped table-bordered sticky-header">
                                    <thead class="table-success sticky-top">
                                        <tr>
                                            <?php for ($i = 1; $i <= 3; $i++) { ?>
                                                <th class="table-success align-middle text-center" colspan="6">Shift <?= $i ?></th>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <?php for ($i = 1; $i <= 3; $i++) { ?>
                                                <th class="table-success align-middle text-center" colspan="1">Time Check </th>
                                                <th class="table-success align-middle text-center" colspan="1">pH air</th>
                                                <th class="table-success align-middle text-center" colspan="2">Setelah Caustic</th>
                                                <th class="table-success align-middle text-center" colspan="2">setelah ACID</th>
                                            <?php } ?>
                                        </tr>

                                        <tr>
                                            <?php for ($i = 1; $i <= 3; $i++) { ?>
                                                <th class="table-success align-middle text-center" colspan="1">CIP</th>
                                                <th class="table-success align-middle text-center" colspan="1">(6,5-8,5)</th>
                                                <th class="table-success align-middle text-center" colspan="1">pH (10,5-12,0)</th>
                                                <th class="table-success align-middle text-center" colspan="1">Temp (40-45'C)</th>
                                                <th class="table-success align-middle text-center" colspan="1">pH (3,0-5,0)</th>
                                                <th class="table-success align-middle text-center" colspan="1">Temp (40-45'C)</th>
                                            <?php } ?>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($dtdetail_b)) {
                                            $tbl_b_max = max(count($dtdetail_b['shift_1']), count($dtdetail_b['shift_2']), count($dtdetail_b['shift_3']));
                                            for ($tbl_b_i = 0; $tbl_b_i < $tbl_b_max; $tbl_b_i++) { ?>
                                                <tr>
                                                    <?php for ($tbl_b_i2 = 1; $tbl_b_i2 <= 3; $tbl_b_i2++) { ?>
                                                        <td align="center"><?= !empty($dtdetail_b['shift_' . $tbl_b_i2][$tbl_b_i]) ? $dtdetail_b['shift_' . $tbl_b_i2][$tbl_b_i]->time_check : '' ?></td>
                                                        <td align="center"><?= !empty($dtdetail_b['shift_' . $tbl_b_i2][$tbl_b_i]) ? $dtdetail_b['shift_' . $tbl_b_i2][$tbl_b_i]->ph_air : '' ?></td>
                                                        <td align="center"><?= !empty($dtdetail_b['shift_' . $tbl_b_i2][$tbl_b_i]) ? $dtdetail_b['shift_' . $tbl_b_i2][$tbl_b_i]->ph_caustic : '' ?></td>
                                                        <td align="center"><?= !empty($dtdetail_b['shift_' . $tbl_b_i2][$tbl_b_i]) ? $dtdetail_b['shift_' . $tbl_b_i2][$tbl_b_i]->temp_caustic : '' ?></td>
                                                        <td align="center"><?= !empty($dtdetail_b['shift_' . $tbl_b_i2][$tbl_b_i]) ? $dtdetail_b['shift_' . $tbl_b_i2][$tbl_b_i]->ph_acid : '' ?></td>
                                                        <td align="center"><?= !empty($dtdetail_b['shift_' . $tbl_b_i2][$tbl_b_i]) ? $dtdetail_b['shift_' . $tbl_b_i2][$tbl_b_i]->temp_acid : '' ?></td>
                                                    <?php } ?>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="table-success align-middle text-center" colspan="18"></th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <br>

                        <div class="col-12">
                            <b>
                                <p style="text-align:center">Hasil Analisa Sesudah CIP</p>
                            </b>
                            <div class="table-responsive scrolly_table" id="scrolling_table_1" style="max-height: 800px;">
                                <table class="table table-striped table-bordered sticky-header">
                                    <thead class="table-success sticky-top">
                                        <tr>
                                            <?php for ($i3 = 1; $i3 <= 3; $i3++) { ?>
                                                <th class="table-success align-middle text-center" colspan="4">Shift <?= $i3 ?></th>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <?php for ($i3 = 1; $i3 <= 3; $i3++) { ?>
                                                <th class="table-success align-middle text-center" colspan="1">Time Check </th>
                                                <th class="table-success align-middle text-center" colspan="1">pH air</th>
                                                <th class="table-success align-middle text-center" colspan="1">Residu Caustic</th>
                                                <th class="table-success align-middle text-center" colspan="1">Residu Acid</th>
                                            <?php } ?>
                                        </tr>

                                        <tr>
                                            <?php for ($i3 = 1; $i3 <= 3; $i3++) { ?>
                                                <th class="table-success align-middle text-center" colspan="1">CIP</th>
                                                <th class="table-success align-middle text-center" colspan="1">(6,5-8,5)</th>
                                                <th class="table-success align-middle text-center" colspan="1">% Konsentrasi</th>
                                                <th class="table-success align-middle text-center" colspan="1">% Konsentrasi</th>
                                            <?php } ?>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php
                                        if (!empty($dtdetail_c)) {
                                            $tbl_b_max = max(count($dtdetail_c['shift_1']), count($dtdetail_c['shift_2']), count($dtdetail_c['shift_3']));
                                            for ($tbl_c_i = 0; $tbl_c_i < $tbl_b_max; $tbl_c_i++) { ?>
                                                <tr>
                                                    <?php for ($tbl_c_i2 = 1; $tbl_c_i2 <= 3; $tbl_c_i2++) { ?>
                                                        <td align="center"><?= !empty($dtdetail_c['shift_' . $tbl_c_i2][$tbl_c_i]) ? $dtdetail_c['shift_' . $tbl_c_i2][$tbl_c_i]->time_check : '' ?></td>
                                                        <td align="center"><?= !empty($dtdetail_c['shift_' . $tbl_c_i2][$tbl_c_i]) ? $dtdetail_c['shift_' . $tbl_c_i2][$tbl_c_i]->ph : '' ?></td>
                                                        <td align="center"><?= !empty($dtdetail_c['shift_' . $tbl_c_i2][$tbl_c_i]) ? $dtdetail_c['shift_' . $tbl_c_i2][$tbl_c_i]->residu_caustic : '' ?></td>
                                                        <td align="center"><?= !empty($dtdetail_c['shift_' . $tbl_c_i2][$tbl_c_i]) ? $dtdetail_c['shift_' . $tbl_c_i2][$tbl_c_i]->residu_acid : '' ?></td>
                                                    <?php } ?>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="table-success align-middle text-center" colspan="18"></th>

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
                                            <th class="table-danger align-middle text-center"></th>
                                            <th class="table-danger align-middle text-center">Jam</th>
                                            <th class="table-danger align-middle text-center">Uraian ketidaksesuaian</th>
                                            <th class="table-danger align-middle text-center">Tindakan Perbaikan</th>
                                            <th class="table-danger align-middle text-center">Nama</th>
                                            <th class="table-danger align-middle text-center">TTD/ Paraf</th>
                                            <th class="table-danger align-middle text-center">Ket</th>
                                        </tr>
                                        <tr>

                                        </tr>
                                    </thead>
                                    <tbody id="tbody2">
                                        <?php $no2 = 1;
                                        foreach ($dtdetail_d as $dtdetail_row4) {
                                            if (file_exists($fcpath2 . 'utl/assets/ttd/' . $dtdetail_row4->pj_personalstatus . '_' . $dtdetail_row4->pj_personalid . '.png')) {
                                                $pj_ttd = '<img src="' . $base_url2 . 'utl/assets/ttd/' . $dtdetail_row4->pj_personalstatus . '_' . $dtdetail_row4->pj_personalid . '.png" ' . $style_ttd . ' alt="">';
                                            } else if (
                                                $dtdetail_row4->pj_personalstatus == '1' && file_exists($fcpath2 . 'forviewfoto_pekerja/' . $dtdetail_row4->pj_personalid . '_0_0.png')
                                            ) {
                                                $pj_ttd = '<img src="' . $base_url2 . 'forviewfoto_pekerja/' . $dtdetail_row4->pj_personalid . '_0_0.png" ' . $style_ttd . ' alt="">';
                                            } else if (
                                                $dtdetail_row4->pj_personalstatus == '2' && file_exists($fcpath2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row4->pj_personalid . '.png')
                                            ) {
                                                $pj_ttd = '<img src="' . $base_url2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row4->pj_personalid . '.png" ' . $style_ttd . ' alt="">';
                                            } else {
                                                $pj_ttd = '';
                                            } ?>
                                            <tr>
                                                <td align="center"><?= $no2++ ?></td>
                                                <td align="center"><?= $dtdetail_row4->jam ?></td>
                                                <td><?= $dtdetail_row4->uraian ?></td>
                                                <td><?= $dtdetail_row4->tindakan ?></td>
                                                <td align="center">
                                                    <?= $dtdetail_row4->pj_nama ?></td>
                                                <td align="center"><?= $pj_ttd ?></td>
                                                <td><?= $dtdetail_row4->keterangan ?></td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="table-danger align-middle text-center" colspan="9">
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