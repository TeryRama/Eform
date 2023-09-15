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

                        <form action="<?= base_url('form_input/C_formfrmfss318_10/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss520" name="formfrmfss520" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                    <div class="card collapse-icon accordion-icon-rotate">
                                        <div class="accordion" id="accordion_dtl">
                                            <?php $shift_jam = 6; // start jam shift per hari

                                            $no2 = 0;
                                            for ($i = 1; $i <= 3; $i++) {

                                                $no2++; ?>

                                                <div class="collapse-margin">
                                                    <div class="card-header bg-gradient-info" id="<?= 'heading_dtl_' . $i ?>" data-toggle="collapse" role="button" data-target="<?= '#collapse_dtl_' . $i ?>" aria-expanded="false" aria-controls="<?= 'collapse_dtl_' . $i ?>">
                                                        <h4>Shift <?= $i ?>
                                                        </h4>
                                                    </div>
                                                    <div id="<?= 'collapse_dtl_' . $i ?>" class="collapse" aria-labelledby="<?= 'heading_dtl_' . $i ?>" data-parent="#accordion_dtl">
                                                        <div class="card-body">
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead class="table-primary <?= isset($dtheader) ? 'sticky-top' : '' ?> ">
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center">No.</th>
                                                                            <th class="table-primary align-middle text-center">NAMA MESIN</th>
                                                                            <th class="table-primary align-middle text-center">KODE</th>
                                                                            <th class="table-primary align-middle text-center">PARAMETER</th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbody_sf<?= $i ?>">

                                                                        <?php if (isset($dtdetail)) {
                                                                            $no = 1;
                                                                            $no_bg = 0;
                                                                            foreach ($dtdetail as $dtdetail_row) {
                                                                                if ($dtdetail_row->shift == 'shift_' . $i) { //perulangan kolom dishift dijadikan 1 kolom 
                                                                        ?>
                                                                                    <tr>
                                                                                        <input type="hidden" name="dtl_detail_id[]" id="dtl_detail_id" class="form-control w-auto dtl_detail_id" style="text-align: center;" value="<?= $dtdetail_row->detail_id ?>">
                                                                                        <td align="center"><?= $no++ ?>
                                                                                            <input type="hidden" name="dtl_shift[]" id="dtl_shift" class="form-control w-auto dtl_shift" style="text-align: center;" value="<?= $dtdetail_row->shift ?>">
                                                                                            <input type="hidden" name="dtl_nama_mesin[]" id="dtl_nama_mesin" class="form-control w-auto dtl_nama_mesin" style="text-align: center;" value="<?= $dtdetail_row->nama_mesin ?>">
                                                                                            <input type="hidden" name="dtl_kode[]" id="dtl_kode" class="form-control w-auto dtl_kode" style="text-align: center;" value="<?= $dtdetail_row->kode ?>">
                                                                                            <input type="hidden" name="dtl_parameter[]" id="dtl_parameter" class="form-control w-auto dtl_parameter" style="text-align: center;" value="<?= $dtdetail_row->parameter ?>">
                                                                                            <input type="hidden" name="dtl_jml_per_mesin[]" id="dtl_jml_per_mesin" class="form-control w-auto dtl_jml_per_mesin" style="text-align: center;" value="<?= $dtdetail_row->jml_per_mesin ?>">
                                                                                        </td>
                                                                                        <?php if ($dtdetail_row->no_urut_mesin == 1) { // gabungin jadi satu kolom dan tulisan miring per nama mesin
                                                                                        ?>
                                                                                            <td align="center" rowspan="<?= ($dtdetail_row->jml_per_mesin * $dtdetail_row->jml_per_kode) ?>"><b><?= $dtdetail_row->nama_mesin ?></b></td>
                                                                                        <?php } ?>
                                                                                        <?php if ($dtdetail_row->no_urut_kode == 1) { // gabungin jadi satu kolom dan tulisan miring per nama mesin
                                                                                        ?>
                                                                                            <td align="center" rowspan="<?= ($dtdetail_row->jml_per_kode) ?>"><b><?= $dtdetail_row->kode ?></b></td>
                                                                                        <?php } ?>
                                                                                        <td align="left"><?= $dtdetail_row->parameter ?></td>

                                                                                        <?php
                                                                                        for ($j = 1; $j <= 8; $j++) {  ?>
                                                                                            <td align="center"><input type="text" name="<?= 'dtl_cek_shift_jam' . $j ?>[]" id="<?= 'dtl_cek_shift_jam' . $j ?> font" class="<?= 'form-control angkadantitik w-auto dtl_cek_shift_jam' . $j ?>" style="text-align: center;" value="<?= $dtdetail_row->{'cek_shift_jam' . $j} ?>"></td>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </tr>
                                                                        <?php
                                                                                }
                                                                            }
                                                                        } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center" colspan="19"></th>
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
                                    <div class="row">
                                        <div class="col-2">
                                            <table class="table table-condensed table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Keterangan :</th>
                                                    </tr>
                                                    <tr>
                                                        <th>CF = Carbon filter</th>
                                                    </tr>
                                                    <tr>
                                                        <th>ST = Softener </th>
                                                    </tr>
                                                    <tr>
                                                        <th>SF = Sand Filter </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr>

                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="card collapse-icon accordion-icon-rotate">
                                        <div class="accordion" id="accordion_dtl_d">
                                            <div class="collapse-margin">
                                                <div class="card-header bg-gradient-danger" id="heading_dtlc_d" data-toggle="collapse" role="button" data-target="#collapse_dtlc_d" aria-expanded="false" aria-controls="collapse_dtlc_d">
                                                    <strong>Catatan KetidakSesuaian</strong>
                                                </div>
                                                <div id="collapse_dtlc_d" class="collapse" aria-labelledby="heading_dtlc_d" data-parent="#accordion_dtl_d">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="table-danger align-middle text-center"></th>
                                                                        <th class="table-danger align-middle text-center">Shift</th>
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
                                                                </thead>
                                                                <tbody id="tbody4">
                                                                    <?php if (isset($dtdetail_b)) {
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
                                                                                <input type="hidden" name="dtl_b_detail_id[]" id="dtl_b_detail_id" class="form-control dtl_detail_id_b" style="text-align: center;" value="<?= $dtdetail_row2->detail_id ?>">
                                                                                <td><input name="dtl_b_chk[]" type="checkbox" value="<?= $dtdetail_row2->shift . ' ' . $dtdetail_row2->detail_id ?>"></td>
                                                                                <td><select name="dtl_b_shift[]" class="form-control dtl_b_shift" id="dtl_b_shift">
                                                                                        <option value="">- pilih -</option>
                                                                                        <option value="shift_1" <?= $dtdetail_row2->shift == "shift_1" ? "selected" : ""  ?>>Shift 1</option>
                                                                                        <option value="shift_2" <?= $dtdetail_row2->shift == "shift_2" ? "selected" : ""  ?>>Shift 2</option>
                                                                                        <option value="shift_3" <?= $dtdetail_row2->shift == "shift_3" ? "selected" : ""  ?>>Shift 3</option>
                                                                                    </select></td>
                                                                                <td align="center"><input type="text" name="dtl_b_jam[]" id="dtl_b_jam" class=" masktime form-control dtl_b_jam" style="text-align: center;" value="<?= $dtdetail_row2->jam ?>"></td>
                                                                                <td align="center"><input type="text" name="dtl_b_uraian[]" id="dtl_b_uraian" class="form-control dtl_b_uraian" value="<?= $dtdetail_row2->uraian ?>"></td>
                                                                                <td align="center"><input type="text" name="dtl_b_tindakan[]" id="dtl_b_tindakan" class="form-control dtl_b_tindakan" value="<?= $dtdetail_row2->tindakan ?>"></td>
                                                                                <td align="center"><input type="text" name="dtl_b_hasil_analisa[]" id="dtl_b_hasil_analisa" class="form-control dtl_b_hasil_analisa" style="text-align: center;" value="<?= $dtdetail_row2->hasil_analisa ?>"></td>
                                                                                <td>
                                                                                    <select name="dtl_b_pj_id[]" id="dtl_b_pj_id" class="form-control dtl_b_pj_id">
                                                                                        <option value="">- pilih -</option>
                                                                                        <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                                            <option value="<?= $list_pj_row->detail_id ?>" <?= $list_pj_row->detail_id == $dtdetail_row2->pj_id ? "selected" : "" ?>><?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                                <td align="center"><?= $pj_ttd ?></td>
                                                                                <td align="center"><input type="text" name="dtl_b_air_recycle[]" id="dtl_b_air_recycle" class="form-control dtl_b_air_recycle" style="text-align: center;" value="<?= $dtdetail_row2->air_recycle ?>"></td>
                                                                                <td align="center"><input type="text" name="dtl_b_terbuang[]" id="dtl_b_terbuang" class="form-control dtl_b_terbuang" style="text-align: center;" value="<?= $dtdetail_row2->terbuang ?>"></td>
                                                                                <td align="center"><input type="text" name="dtl_b_keterangan[]" id="dtl_b_keterangan" class="form-control dtl_b_keterangan" style="text-align: center;" value="<?= $dtdetail_row2->keterangan ?>"></td>
                                                                            </tr>
                                                                        <?php }
                                                                    } else { ?>

                                                                        <tr>
                                                                            <td><input name="dtlb_chk[]" type="checkbox" value=""></td>
                                                                            <td><select name="dtl_b_shift[]" class="form-control dtl_b_shift" id="dtl_b_shift">
                                                                                    <option value="">- pilih -</option>
                                                                                    <option value="shift_1">Shift 1</option>
                                                                                    <option value="shift_2">Shift 2</option>
                                                                                    <option value="shift_3">Shift 3</option>
                                                                                </select></td>
                                                                            <td align="center"><input type="text" name="dtl_b_jam[]" id="dtl_b_jam" class=" masktime form-control angkadantitik  dtl_b_jam" style="text-align: center;" value=""></td>
                                                                            <td align="center"><input type="text" name="dtl_b_uraian[]" id="dtl_b_uraian" class="form-control dtl_b_uraian" value=""></td>
                                                                            <td align="center"><input type="text" name="dtl_b_tindakan[]" id="dtl_b_tindakan" class="form-control dtl_b_tindakan" value=""></td>
                                                                            <td align="center"><input type="text" name="dtl_b_hasil_analisa[]" id="dtl_b_hasil_analisa" class="form-control dtl_b_hasil_analisa" style="text-align: center;" value=""></td>
                                                                            <td>
                                                                                <select name="dtl_b_pj_id[]" id="dtl_b_pj_id" class="form-control dtl_b_pj_id">
                                                                                    <option value="">- pilih -</option>
                                                                                    <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                                        <option value="<?= $list_pj_row->detail_id ?>"><?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?></option>
                                                                                    <?php
                                                                                    } ?>
                                                                                </select>
                                                                            </td>
                                                                            <td align="center"></td>
                                                                            <td align="center"><input type="text" name="dtl_b_air_recycle[]" id="dtl_b_air_recycle" class="form-control dtl_b_air_recycle" style="text-align: center;" value=""></td>
                                                                            <td align="center"><input type="text" name="dtl_b_buterang[]" id="dtl_b_terbuang" class="form-control dtl_b_terbuang" style="text-align: center;" value=""></td>
                                                                            <td align="center"><input type="text" name="dtl_b_keterangan[]" id="dtl_b_keterangan" class="form-control dtl_b_keterangan" style="text-align: center;" value=""></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td class="table-danger align-middle text-center" colspan="11" align="center">
                                                                            <?php if (!isset($dtdetail_b)) {
                                                                                if ($akses_create == '1') { ?>
                                                                                    <button type="button" class="btn btn-sm bg-gradient-info btn_tbody3_sf" id="tambah_baris" onClick="addRow('tbody4')">Tambah
                                                                                        Baris</button>
                                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody4')">Hapus
                                                                                        Baris</button>
                                                                                <?php } else {/*No Acess Create*/
                                                                                }
                                                                            } else {
                                                                                if ($akses_update == '1') { ?>
                                                                                    <button type="button" class="btn btn-sm bg-gradient-info btn_tbody3_sf" id="tambah_baris" onClick="addRow('tbody4')">Tambah
                                                                                        Baris</button>
                                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody4')">Hapus
                                                                                        Baris</button>
                                                                                <?php } else {/*No Acess Update*/
                                                                                }
                                                                                if ($akses_delete == '1') { ?>
                                                                                    <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete_dtlb" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus
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
                            </div>

                            <hr>
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

        $('.4angkasaja').mask("0000", {
            placeholder: "0"
        });

        $(document).on('keyup', '.angkadantitik', function() {
            this.value = this.value.replace(/[^\d.]|\.(?=.*\.)/g, '');
            // console.log('dfdsfdsfdsf');
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
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss318_10/get_docno/frmfss318/10",
                    data: {
                        create_date
                    },
                    success: function(data) {
                        $('.docno').val(JSON.parse(data)['data']);
                    }
                });

                get_item('dtl', 'tbody_sf1', 'Tipe 1');
                get_item('dtl', 'tbody_sf2', 'Tipe 1');
                get_item('dtl', 'tbody_sf3', 'Tipe 1');
            }
        }

        function get_item(tbl, tbody, tipe_dtl) {
            let input_headerid = $(".headerid").val();
            let create_date = $('.create_date').val();

            $('#' + tbody).empty();

            if (typeof(input_headerid) == "undefined" && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss318_10/get_list_item/frmfss318/10",
                    dataType: "json",
                    data: {
                        tipe_dtl,
                        create_date
                    },
                    success: function(result) {
                        if (result.status == 0) {
                            // console.log(result.data);

                            let no = 1;
                            let list_dtl = '';

                            let no3 = 0;
                            $.each(result.data, function(key, list_item_row) {
                                if (result.data[key].children) {
                                    $.each(result.data[key].children, function(key2, children_row) {
                                        if (result.data[key].children[key2].children2) {

                                            let vitem1 = '';
                                            if (key2 == 0) {
                                                vitem1 = `<td align="center" rowspan="` + (result.data[key].children.length * result.data[key].children[key2].children2.length) + `"><b>` + list_item_row.item1 + `</b></td>`;
                                            }
                                            $.each(result.data[key].children[key2].children2, function(key3, children2_row) {
                                                no3++;
                                                let vitem2 = '';
                                                if (key3 == 0) {
                                                    vitem2 = vitem1 + `<td align="center" rowspan="` + result.data[key].children[key2].children2.length + `"><b>` + children_row.item2 + `</b></td>`;
                                                }
                                                list_dtl += `<tr> 
                                                                <td align="center">` + eval(no3) + `
                                                                    <input type="hidden" name="dtl_shift[]" id="dtl_shift" class="form-control w-auto dtl_shift" style="text-align: center;" value="shift_` + tbody.substr(-1) + `">
                                                                    <input type="hidden" name="dtl_nama_mesin[]" id="dtl_nama_mesin" class="form-control w-auto dtl_nama_mesin" style="text-align: center;" value="` + list_item_row.item1 + `">
                                                                    <input type="hidden" name="dtl_kode[]" id="dtl_kode" class="form-control w-auto dtl_kode" style="text-align: center;" value="` + children_row.item2 + `">
                                                                    <input type="hidden" name="dtl_parameter[]" id="dtl_parameter" class="form-control w-auto dtl_parameter" style="text-align: center;" value="` + children2_row.item3 + `">
                                                                    <input type="hidden" name="dtl_jml_per_mesin[]" id="dtl_jml_per_mesin" class="form-control w-auto dtl_jml_per_mesin" style="text-align: center;" value="` + result.data[key].children.length + `"></td>
                                                                    <input type="hidden" name="dtl_jml_per_kode[]" id="dtl_jml_per_kode" class="form-control w-auto dtl_jml_per_kode" style="text-align: center;" value="` + result.data[key].children[key2].children2.length + `"></td>
                                                                ` + vitem2 + `
                                                                <td align="center">` + children2_row.item3 + `</td>`;
                                                for (let j = 1; j <= 8; j++) {
                                                    list_dtl += `<td align="center"><input type="text" name="dtl_cek_shift_jam${j}[]" id="dtl_cek_shift_jam${j}" class="form-control angkadantitik w-auto dtl_cek_shift_jam${j}" style="text-align: center;" value=""></td>`;

                                                }
                                                list_dtl += '</tr>';
                                            });
                                        }

                                    });
                                }
                            });

                            $('#' + tbody).append(list_dtl);
                            // get_plus_row();
                            // get_divided_row();
                        }
                    }
                });
            }
        }

        get_docno();

        $('.create_date').change(function() {
            get_docno();
        });

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

    });
</script>

<?php $this->load->view('template/footbarend'); ?>