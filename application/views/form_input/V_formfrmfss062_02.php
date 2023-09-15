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
    $aksi = "dtupdate";

    foreach ($dtheader as $header) {
        $headerid = $header->headerid;

        $comment      = $header->comment;
        $comment_by   = $header->comment_by;
        $comment_time = $header->comment_time;
        $comment_date = date("d-m-Y", strtotime($header->comment_date));

        $create_date = date("d-m-Y", strtotime($header->create_date));
        $docno       = $header->docno;
        $periode     = $header->periode;
        $dept        = $header->dept;
        $deptabbr    = $header->deptabbr;
    }
} else if (isset($message)) {
    $aksi = "dtsave";

    $create_date = $dtcreate_date;
    $docno       = $dtdocno;
    $periode     = $dtperiode;
    $dept        = $dtdept;
    $deptabbr    = $dtdeptabbr;
} else {
    $aksi        = "dtsave";
    $create_date = date("d-m-Y", strtotime($dtcreate_date));
    $docno       = '';
    $periode     = '';
    $dept        = '';
    $deptabbr    = '';
}
?>

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

                        <form action="<?= base_url('form_input/C_formfrmfss062_02/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss062" name="formfrmfss062" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Periode
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="periode" id="periode" class="form-control periode dtopen_blok" value="<?= $periode; ?>" readonly required>
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
                                </div>
                            </div>

                            <!-- END HEADER -->
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive" id="scrolling_table_1" style="max-height: 600px;">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="2"></th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Nama Mesin</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Kode Mesin</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Oli</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Tanggal</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Total Operasi (jam)</th>
                                                        <th class="table-primary align-middle text-center" colspan="2">Oli/Grease</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Keterangan</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Jenis</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php if (isset($dtdetail)) {
                                                        $no = 1;
                                                        foreach ($dtdetail as $dtdetail_row) { ?>
                                                            <tr>
                                                                <input type="hidden" name="detail_id[]" id="detail_id" class="form-control detail_id" value="<?= $dtdetail_row->detail_id ?>">
                                                                <td align="center"><input type="checkbox" name="dtl_a_chk[]" id="dtl_a_chk" class="dtl_a_chk" value="<?= $dtdetail_row->detail_id ?>"></td>
                                                                <td align="center"><select name="nama_mesin[]" id="nama_mesin" class="nama_mesin form-control w-auto">
                                                                        <option value="">- Pilih -</option>
                                                                        <?php foreach ($list_mesin_frmfss064 as $list_mesin_frmfss064_row) { ?>
                                                                            <option value="<?= $list_mesin_frmfss064_row->nama_mesin ?>" <?= $dtdetail_row->nama_mesin == $list_mesin_frmfss064_row->nama_mesin ? "selected" : ""; ?>><?= $list_mesin_frmfss064_row->nama_mesin ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td align="center"><select name="kode_mesin[]" id="kode_mesin" class="form-control kode_mesin w-auto">
                                                                        <option value="">- Pilih -</option>
                                                                        <option value="<?= $dtdetail_row->kode_mesin ?>" selected><?= $dtdetail_row->kode_mesin ?></option>
                                                                    </select>
                                                                </td>
                                                                <td align="center"><select name="oli[]" id="oli" class="form-control oli w-auto">
                                                                        <option value="">- Pilih -</option>
                                                                        <?php if ($dtdetail_row->oli != "") { ?>
                                                                            <option value="<?= $dtdetail_row->oli ?>" selected><?= ucwords($dtdetail_row->oli) ?></option>
                                                                        <?php } else { ?>
                                                                            <option value="oli"> Oli </option>
                                                                        <?php  } ?>
                                                                    </select>
                                                                </td>
                                                                <td align="center"><input type="text" name="tanggal[]" id="tanggal" class="form-control tanggal datepicker_row maskdate w-auto" size="15" value="<?= date('d-m-Y', strtotime($dtdetail_row->tanggal)) == '01-01-1970' ? NULL : date('d-m-Y', strtotime($dtdetail_row->tanggal)) ?>"></td>
                                                                <td align="center"><input type="number" name="total_operasi[]" id="total_operasi" class="form-control total_operasi w-auto" size="15" value="<?= $dtdetail_row->total_operasi ?>"></td>
                                                                <td align="center"><input type="text" name="oli_jenis[]" id="oli_jenis" class="form-control oli_jenis w-auto" size="15" value="<?= $dtdetail_row->oli_jenis ?>"></td>
                                                                <td align="center"><input type="text" name="oli_jumlah[]" id="oli_jumlah" class="form-control oli_jumlah w-auto" size="28" value="<?= $dtdetail_row->oli_jumlah ?>"></td>
                                                                <td align="center"><input type="text" name="keterangan[]" id="keterangan" class="form-control keterangan w-auto" size="28" value="<?= $dtdetail_row->keterangan ?>"></td>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                        <tr>
                                                            <td align="center"><input type="checkbox" name="dtl_a_chk[]" id="dtl_a_chk" class="dtl_a_chk" value=""></td>
                                                            <td align="center"><select name="nama_mesin[]" id="nama_mesin" class="form-control nama_mesin w-auto">
                                                                    <option value="">- Pilih -</option>
                                                                </select></td>
                                                            <td align=" center"><select name="kode_mesin[]" id="kode_mesin" class="form-control kode_mesin w-auto">
                                                                    <option value="">- Pilih -</option>
                                                                </select></td>
                                                            <td align=" center"><select name="oli[]" id="oli" class="form-control oli w-auto">
                                                                    <option value="">- Pilih -</option>
                                                                </select></td>
                                                            <td align="center"><input type="text" name="tanggal[]" id="tanggal" class="form-control tanggal datepicker_row w-auto" size="15" value=""></td>
                                                            <td align="center"><input type="number" name="total_operasi[]" id="total_operasi" class="form-control total_operasi w-auto" size="15" value=""></td>
                                                            <td align="center"><input type="text" name="oli_jenis[]" id="oli_jenis" class="form-control oli_jenis w-auto" size="15" value=""></td>
                                                            <td align="center"><input type="text" name="oli_jumlah[]" id="oli_jumlah" class="form-control oli_jumlah w-auto" size="15" value=""></td>
                                                            <td align="center"><input type="text" name="keterangan[]" id="keterangan" class="form-control keterangan w-auto" size="30" value=""></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" colspan="19" align="center">
                                                            <?php if (!isset($dtdetail)) {
                                                                if ($akses_create == '1') { ?>
                                                                    <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody')">Tambah
                                                                        Baris</button>
                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody')">Hapus
                                                                        Baris</button>
                                                                <?php } else {/*No Acess Create*/
                                                                }
                                                            } else {
                                                                if ($akses_update == '1') { ?>
                                                                    <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody')">Tambah
                                                                        Baris</button>
                                                                    <button type="button" class="btn btn-sm bg-gradient-success" id="sisip_baris" onClick="InsertRow('TBody_a')">Sisip
                                                                        Baris</button>
                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody')">Hapus
                                                                        Baris</button>
                                                                <?php } else {/*No Acess Update*/
                                                                }
                                                                if ($akses_delete == '1') { ?>
                                                                    <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus
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
        get_periode();
        // check_data();

        $('.create_date').change(function() {
            get_docno();
            get_periode();
            // check_data();
        });

        $('.dept').change(function() {
            $('#deptabbr').val($(this).find('option:selected').text());
            get_mesin_frmfss064();
            // check_data();
        });

        function get_docno() {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            if (typeof(input_headerid) == "undefined" && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss062_02/get_docno/frmfss062/02",
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

        function get_periode() {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            if (typeof(input_headerid) == "undefined" && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss062_02/get_periode/frmfss062/02",
                    data: {
                        create_date
                    },
                    async: false,
                    success: function(data) {
                        $('.periode').val(JSON.parse(data)['data']);
                    }
                });
            }
        }

        function get_mesin_frmfss064() {
            var input_headerid = $(".headerid").val();
            var dept = $('.dept').val();
            if (dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss062_02/get_mesin_frmfss064/frmfss062/02",
                    data: {
                        dept
                    },
                    async: false,
                    dataType: "json",
                    success: function(data) {
                        var opt = '';
                        if (data.status == 0) {
                            $.each(data.data, function(key, dtl_val) {
                                opt += '<option value="' + dtl_val.nama_mesin + '">' + dtl_val.nama_mesin + '</option>';
                            })
                            $('.nama_mesin').find('option:not(:first)').remove();
                            $('.nama_mesin').append(opt);
                        }
                    }
                });
            }
        }

        $(document).on('change', '.nama_mesin', function() {
            var that = $(this);
            var nama_mesin = that.val();
            var dept = $('.dept').val();
            if (dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss062_02/get_kode_frmfss064/frmfss062/02",
                    data: {
                        dept,
                        nama_mesin
                    },
                    async: false,
                    dataType: "json",
                    success: function(data) {
                        var opt = '';
                        var opt1 = '';
                        if (data.status == 0) {
                            $.each(data.data, function(key, dtl_val) {
                                opt += '<option value="' + dtl_val.kode_mesin + '">' + dtl_val.kode_mesin + '</option>';
                            })
                            that.closest('tr').find('[class*=kode_mesin]').find('option:not(:first)').remove();
                            that.closest('tr').find('[class*=kode_mesin]').append(opt);
                        }
                        if (data.status == 0) {
                            $.each(data.data, function(key, dtl_val) {
                                opt1 += '<option value="' + dtl_val.oli + '">' + dtl_val.oli + '</option>';
                            })
                            that.closest('tr').find('[class*=oli]').find('option:not(:first)').remove();
                            that.closest('tr').find('[class*=oli]').append(opt1);
                        }
                    }
                });
            }
            if ($(this).val() != '') {
                $('.kode_mesin').trigger('change');
                $('.oli').trigger('change');
            }
        });

    });
</script>

<?php $this->load->view('template/footbarend'); ?>