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
        $headerid       = $header->headerid;

        $comment        = $header->comment;
        $comment_by     = $header->comment_by;
        $comment_time   = $header->comment_time;
        $comment_date   = date("d-m-Y", strtotime($header->comment_date));

        $create_date    = date("d-m-Y", strtotime($header->create_date));
        $docno          = $header->docno;
        $periode        = date("m-Y", strtotime($header->periode . '-01'));
        $dept           = $header->dept;
        $deptabbr       = $header->deptabbr;
        $kategori       = $header->kategori;
    }
} else if (isset($message)) {
    $aksi           = "dtsave";

    $create_date    = $dtcreate_date;
    $docno          = $dtdocno;
    $periode        = $dtperiode;
    $dept           = $dtdept;
    $deptabbr       = $dtdeptabbr;
    $kategori       = $dtkategori;
} else {
    $aksi           = "dtsave";
    $create_date    = date("d-m-Y", strtotime($dtcreate_date));
    $docno          = '';
    $periode        = date("m-Y", strtotime($dtperiode));
    $dept           = '';
    $deptabbr       = '';
    $kategori       = '';
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

                        <form action="<?= base_url('form_input/C_form' . $frmkd . '_' . $frmvrs . '/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss060" name="formfrmfss060" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Departemen
                                        </div>
                                        <div class="col-md-6">
                                            <select name="dept" id="dept" class="form-control dept dtopen_blok2 select2" required>
                                                <option value="">- Pilih -</option>
                                                <?php if (isset($dtdept)) {
                                                    foreach ($dtdept as $dtdepartemen_row) { ?>
                                                        <option value="<?php echo $dtdepartemen_row->deptid; ?>" <?php if ($dtdepartemen_row->deptid == $dept) {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>><?php echo $dtdepartemen_row->deptabbr; ?></option>
                                                <?php
                                                    }
                                                } ?>
                                            </select>
                                            <input type="hidden" name="deptabbr" id="deptabbr" value="<?= $deptabbr ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Kategori
                                        </div>
                                        <div class="col-md-6">
                                            <select name="kategori" id="kategori" class="form-control kategori dtopen_blok2 select2" required>
                                                <option value="">- Pilih -</option>
                                                <option value="mesin" <?= $kategori == 'mesin' ? "selected" : ""; ?>>Mesin</option>
                                                <option value="panel" <?= $kategori == 'panel' ? "selected" : ""; ?>>Panel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Periode
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($dtheader)) { ?>
                                                <input type="text" name="periode" id="periode" class="form-control periode" value="<?= $periode; ?>" required readonly>
                                            <?php } else { ?>
                                                <input type="text" name="periode" id="periode" class="form-control datepicker_monthandyear maskmonthandyear periode" value="<?= $periode; ?>" required>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- END HEADER -->

                            <div class="card-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive scrolly_table" id="scrolling_table_1" style="max-height: 800px;">
                                            <table class="table table-striped table-bordered">
                                                <thead style="position:sticky;top: 0; z-index: 1;">
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="2">No.</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Nama Mesin</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Kode Mesin</th>
                                                        <th class="table-primary align-middle text-center" colspan="2">Start</th>
                                                        <th class="table-primary align-middle text-center" colspan="2">Stop</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Durasi Kerusakan & Perbaikan (Jam)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Status Perbaikan</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Planned/Unplanned</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Listrik/Mekanik</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Perbaikan</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Analisa Sebab Kerusakan</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Tindakan Koreksi & Pencegahan</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Keterangan</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Tanggal</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Waktu Kejadian</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Tanggal</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Waktu Kejadian</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php if (isset($dtdetail)) {
                                                        $no = 1;
                                                        foreach ($dtdetail as $dtdetail_row) {
                                                            $tgl_start = date('d-m-Y', strtotime($dtdetail_row->tgl_start)) == '01-01-1970' ? NULL : date('d-m-Y', strtotime($dtdetail_row->tgl_start));
                                                            $tgl_stop = date('d-m-Y', strtotime($dtdetail_row->tgl_stop)) == '01-01-1970' ? NULL : date('d-m-Y', strtotime($dtdetail_row->tgl_stop));
                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_a_nama_mesin[]" id="dtl_a_nama_mesin" class="dtl_a_nama_mesin form-control" value="<?= $dtdetail_row->nama_mesin; ?>">
                                                                <input type="hidden" name="dtl_a_kode_mesin[]" id="dtl_a_kode_mesin" class="dtl_a_kode_mesin form-control" value="<?= $dtdetail_row->kode_mesin; ?>">
                                                                <input type="hidden" name="dtl_a_tgl_start[]" id="dtl_a_tgl_start" class="dtl_a_tgl_start form-control" value="<?= $tgl_start; ?>">
                                                                <input type="hidden" name="detail_id[]" id="detail_id" class="form-control detail_id" value="<?= $dtdetail_row->detail_id ?>">
                                                                <input type="hidden" name="detail_id_812[]" id="detail_id_812" class="form-control detail_id_812" value="<?= $dtdetail_row->detail_id_812 ?>">
                                                                <input type="hidden" name="headerid_812[]" id="headerid_812" class="form-control headerid_812" value="<?= $dtdetail_row->headerid_812 ?>">

                                                                <td align="center"><input type="checkbox" name="chk[]" id="chk" class="chk" value="<?= $dtdetail_row->detail_id ?>"></td>
                                                                <td align="center"><?= $dtdetail_row->nama_mesin; ?></td>
                                                                <td align="center"><?= $dtdetail_row->kode_mesin; ?></td>
                                                                <td align="center"><?= $tgl_start; ?></td>
                                                                <td align="center"><input type="text" name="dtl_a_waktu_start[]" id="dtl_a_waktu_start" class="dtl_a_waktu_start form-control w-auto masktime" size="5" value="<?= $dtdetail_row->waktu_start; ?>"></td>
                                                                <td align="center"><input type="text" name="dtl_a_tgl_stop[]" id="dtl_a_tgl_stop" class="dtl_a_tgl_stop form-control w-auto datepicker maskdate" size="15" value="<?= $tgl_stop; ?>"></td>
                                                                <td align="center"><input type="text" name="dtl_a_waktu_stop[]" id="dtl_a_waktu_stop" class="dtl_a_waktu_stop form-control w-auto masktime" size="5" value="<?= $dtdetail_row->waktu_stop; ?>"></td>
                                                                <td align="center"><input type="text" name="dtl_a_durasi[]" id="dtl_a_durasi" class="dtl_a_durasi form-control w-auto" size="15" value="<?= $dtdetail_row->durasi; ?>"></td>
                                                                <td align="center"><select name="dtl_a_status_perbaikan[]" id="dtl_a_status_perbaikan" class="dtl_a_status_perbaikan form-control w-auto">
                                                                        <option value="">- Pilih -</option>
                                                                        <option value="Penggantian" <?= $dtdetail_row->status_perbaikan == 'Penggantian' ? 'selected' : ''; ?>>Penggantian</option>
                                                                        <option value="Perbaikan" <?= $dtdetail_row->status_perbaikan == 'Perbaikan' ? 'selected' : ''; ?>>Perbaikan</option>
                                                                    </select></td>
                                                                <td align="center"><select name="dtl_a_planned[]" id="dtl_a_planned" class="dtl_a_planned form-control w-auto">
                                                                        <option value="">- Pilih -</option>
                                                                        <option value="Planned" <?= $dtdetail_row->planned == 'Planned' ? 'selected' : ''; ?>>Planned</option>
                                                                        <option value="Unplanned" <?= $dtdetail_row->planned == 'Unplanned' ? 'selected' : ''; ?>>Unplanned</option>
                                                                    </select></td>
                                                                <td align="center"><select name="dtl_a_kategori[]" id="dtl_a_kategori" class="dtl_a_kategori form-control w-auto">
                                                                        <option value="">- Pilih -</option>
                                                                        <option value="Listrik" <?= $dtdetail_row->kategori == 'Listrik' ? 'selected' : ''; ?>>Listrik</option>
                                                                        <option value="Mekanik" <?= $dtdetail_row->kategori == 'Mekanik' ? 'selected' : ''; ?>>Mekanik</option>
                                                                    </select></td>
                                                                <td align="center"><textarea name="dtl_a_perbaikan[]" id="dtl_a_perbaikan" class="dtl_a_perbaikan form-control w-auto" row="4"><?= $dtdetail_row->perbaikan; ?></textarea></td>
                                                                <td align="center"><textarea name="dtl_a_analisa[]" id="dtl_a_analisa" class="dtl_a_analisa form-control w-auto" row="4"><?= $dtdetail_row->analisa; ?></textarea></td>
                                                                <td align="center"><textarea name="dtl_a_tindakan[]" id="dtl_a_tindakan" class="dtl_a_tindakan form-control w-auto" row="4"><?= $dtdetail_row->tindakan; ?></textarea></td>
                                                                <td align="center"><textarea name="dtl_a_keterangan[]" id="dtl_a_keterangan" class="dtl_a_keterangan form-control w-auto" row="4"><?= $dtdetail_row->keterangan; ?>"></textarea></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" colspan="15" align="center"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                            <button type="submit" class="btn bg-gradient-warning" name="btnrefresh" value="btnrefresh" onclick="return confirm('Refresh Data ?')">
                                                <i class="feather icon-refresh-ccw"></i> Refresh
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

        get_docno();

        function get_docno() {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            if (typeof(input_headerid) == "undefined" && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss060_04/get_docno/frmfss060/04",
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
        get_frmfss812();

        function get_frmfss812() {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            var periode = $('.periode').val();
            var dept = $('.dept').val();
            if (typeof(input_headerid) == "undefined" && create_date != '' && periode != '' && dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss060_04/get_frmfss812/frmfss060/04",
                    data: {
                        create_date,
                        periode,
                        dept
                    },
                    async: false,
                    dataType: 'json',
                    success: function(result) {
                        let list_dtl_a = `<tr>
                                            <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                        </tr>`;
                        if(result.status == 0){
                            if (result.result_frmfss812.length) {
                                list_dtl_a = '';
                                $.each(result.result_frmfss812, function(dtl_a_key, dtl_a_val) {
                                    list_dtl_a += `<tr>
                                                        <input type="hidden" name="dtl_a_nama_mesin[]" id="dtl_a_nama_mesin" class="dtl_a_nama_mesin form-control w-auto" size="28" value="` + dtl_a_val.nama_mesin.trim() + `">
                                                        <input type="hidden" name="dtl_a_kode_mesin[]" id="dtl_a_kode_mesin" class="dtl_a_kode_mesin form-control w-auto" size="15" value="` + dtl_a_val.kode_mesin.trim() + `">
                                                        <input type="hidden" name="detail_id_812[]" id="detail_id_812" class="detail_id_812 form-control w-auto" size="15" value="` + dtl_a_val.detail_id.trim() + `">
                                                        <input type="hidden" name="headerid_812[]" id="headerid_812" class="headerid_812 form-control w-auto" size="15" value="` + dtl_a_val.headerid.trim() + `">
                                                        <td align="center">` + eval(dtl_a_key + 1) + `</td>
                                                        <td align="center">` + dtl_a_val.nama_mesin.trim() + `</td>
                                                        <td align="center">` + dtl_a_val.kode_mesin.trim() + `</td>
                                                        <td align="center"><input type="text" name="dtl_a_tgl_start[]" id="dtl_a_tgl_start" class="dtl_a_tgl_start form-control w-auto maskdate" size="15" value="` + formatDateId(dtl_a_val.create_date) + `" readonly></td>
                                                        <td align="center"><input type="text" name="dtl_a_waktu_start[]" id="dtl_a_waktu_start" class="dtl_a_waktu_start form-control w-auto masktime" size="5" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_a_tgl_stop[]" id="dtl_a_tgl_stop" class="dtl_a_tgl_stop form-control w-auto datepicker maskdate" size="15" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_a_waktu_stop[]" id="dtl_a_waktu_stop" class="dtl_a_waktu_stop form-control w-auto masktime" size="5" value=""></td>
                                                        <td align="center"><input type="text" name="dtl_a_durasi[]" id="dtl_a_durasi" class="dtl_a_durasi form-control w-auto" size="15" value="" readonly></td>
                                                        <td align="center"><select name="dtl_a_status_perbaikan[]" id="dtl_a_status_perbaikan" class="dtl_a_status_perbaikan form-control w-auto">
                                                            <option value="">- Pilih -</option>
                                                            <option value="Penggantian">Penggantian</option>
                                                            <option value="Perbaikan">Perbaikan</option>
                                                        </select></td>
                                                        <td align="center"><select name="dtl_a_planned[]" id="dtl_a_planned" class="dtl_a_planned form-control w-auto">
                                                            <option value="">- Pilih -</option>
                                                            <option value="Planned">Planned</option>
                                                            <option value="Unplanned">Unplanned</option>
                                                        </select></td>
                                                        <td align="center"><select name="dtl_a_kategori[]" id="dtl_a_kategori" class="dtl_a_kategori form-control w-auto">
                                                            <option value="">- Pilih -</option>
                                                            <option value="Listrik">Listrik</option>
                                                            <option value="Mekanik">Mekanik</option>
                                                        </select></td>
                                                        <td align="center"><textarea name="dtl_a_perbaikan[]" id="dtl_a_perbaikan" class="dtl_a_perbaikan form-control w-auto"></textarea></td>
                                                        <td align="center"><textarea name="dtl_a_analisa[]" id="dtl_a_analisa" class="dtl_a_analisa form-control w-auto"></textarea></td>
                                                        <td align="center"><textarea name="dtl_a_tindakan[]" id="dtl_a_tindakan" class="dtl_a_tindakan form-control w-auto"></textarea></td>
                                                        <td align="center"><textarea name="dtl_a_keterangan[]" id="dtl_a_keterangan" class="dtl_a_keterangan form-control w-auto">` + dtl_a_val.ket.trim() + `</textarea></td>
                                                    </tr>`;
                                });
                            }
                            $('#tbody').empty().append(list_dtl_a);
                        }else{
                            $('#tbody').empty().append(list_dtl_a);
                        }

                        notif_btnconfirm_custom(result.vstatus, result.pesan);
                    }
                });
            }

            $('.masktime').mask("00:00", {
                placeholder: "__:__"
            });
            $('.maskdate').mask("00-00-0000", {
                placeholder: "dd-mm-yyyy"
            });
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                todayBtn: "linked",
                todayHighlight: 'TRUE',
                autoclose: true,
                orientation: "bottom",
            });
        }

        $('.create_date').change(function() {
            get_docno();
        });
        $('.dept').change(function() {
            $('#deptabbr').val($(this).find('option:selected').text());
        });
        $('#kategori').change(function() {
            get_frmfss812();
        })
        $('#periode').change(function() {
            get_frmfss812();
        })

        // =========================== TOTAL TIME ============================ //
        $(document).on('change', '.dtl_a_waktu_stop', function() {
            var that = $(this);
            var jam_selesai = that.val();
            var tgl_mulai = that.closest('tr').find(".dtl_a_tgl_start").val().split('-');
            var tgl_selesai = that.closest('tr').find(".dtl_a_tgl_stop").val().split('-');
            var jam_mulai = that.closest('tr').find(".dtl_a_waktu_start").val();

            var vtgl_mulai = tgl_mulai[2] + '-' + tgl_mulai[1] + '-' + tgl_mulai[0];
            var vtgl_selesai = tgl_selesai[2] + '-' + tgl_selesai[1] + '-' + tgl_selesai[0];

            if ((vtgl_mulai.trim() != '') && (jam_mulai.trim() != '') && (vtgl_selesai.trim() != '') && (jam_selesai.trim() != '')) {
                fDate = Date.parse(vtgl_mulai + ' ' + jam_mulai);
                lDate = Date.parse(vtgl_selesai + ' ' + jam_selesai);

                if (fDate > lDate) {
                    Swal.fire('Maaf......!!', 'Tanggal Jam Selesai Tidak Boleh Dibawah Tanggal Jam Mulai', 'warning');
                    that.closest('tr').find(".dtl_a_waktu_stop").val('');
                    that.closest('tr').find(".dtl_a_tgl_start").val('');
                    that.closest('tr').find(".dtl_a_tgl_stop").val('');
                    that.closest('tr').find(".dtl_a_waktu_start").val('');
                    that.closest('tr').find(".dtl_a_durasi").val('');
                } else {
                    var lama_jam = eval(lDate - fDate);
                }
                // console.log(lama_jam / 86400000);
                // console.log(lDate);
                // console.log(fDate);
                // console.log(lama_jam);
                if (lama_jam / 86400000 >= 1) {
                    that.closest('tr').find(".dtl_a_durasi").val(Math.floor(lama_jam / 86400000) + ' HARI ' + new Date(1609434000000 + lama_jam).toLocaleTimeString("id-ID", {
                        hour: '2-digit'
                    }) + ' JAM ' + new Date(1609434000000 + lama_jam).toLocaleTimeString("id-ID", {
                        minute: '2-digit'
                    }) + ' MENIT');
                } else if (lama_jam / 3600000 >= 1) {
                    that.closest('tr').find(".dtl_a_durasi").val(new Date(1609434000000 + lama_jam).toLocaleTimeString("id-ID", {
                        hour: '2-digit'
                    }) + ' JAM ' + new Date(1609434000000 + lama_jam).toLocaleTimeString("id-ID", {
                        minute: '2-digit'
                    }) + ' MENIT');
                } else {
                    that.closest('tr').find(".dtl_a_durasi").val(new Date(1609434000000 + lama_jam).toLocaleTimeString("id-ID", {
                        minute: '2-digit'
                    }) + ' MENIT');
                }
            }
        });

        $(document).on('change', '.dtl_a_tgl_stop', function() {
            if ($(".dtl_a_waktu_stop").val() != '') {
                $(".dtl_a_waktu_stop").trigger('change');
            }
        });

        $(document).on('change', '.dtl_a_waktu_start', function() {
            if ($(".dtl_a_waktu_stop").val() != '') {
                $(".dtl_a_waktu_stop").trigger('change');
            }
        });
        // =========================== END TOTAL TIME ============================ //
    });

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }
</script>



<?php $this->load->view('template/footbarend'); ?>