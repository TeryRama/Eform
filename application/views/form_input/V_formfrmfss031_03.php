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
        $headerid           = $header->headerid;
        $comment            = $header->comment;
        $comment_by         = $header->comment_by;
        $comment_time       = $header->comment_time;
        $comment_date       = date("d-m-Y", strtotime($header->comment_date));
        $create_date        = date("d-m-Y", strtotime($header->create_date));
        $docno              = $header->docno;
        $dept               = $header->dept;
        $item               = $header->item;
        $deptabbr           = $header->deptabbr;
        $nama_mesin         = $header->nama_mesin;
        $kode_mesin         = $header->kode_mesin;
        $jam                = $header->jam;
        $total_operasi      = $header->total_operasi;
        $hasil_pengujian    = $header->hasil_pengujian;
    }
} else if (isset($message)) {
    $aksi               = "dtsave";
    $create_date        = $dtcreate_date;
    $docno              = $dtdocno;
    $dept               = $dtdept;
    $item               = $dtitem;
    $deptabbr           = $dtdeptabbr;
    $nama_mesin         = $dtnama_mesin;
    $kode_mesin         = $dtkode_mesin;
    $jam                = $dtjam;
    $total_operasi      = $dttotal_operasi;
    $hasil_pengujian    = $dthasil_pengujian;
} else {
    $aksi            = "dtsave";
    $create_date     = date("d-m-Y", strtotime($dtcreate_date));;
    $docno           = '';
    $dept            = '';
    $item            = '';
    $deptabbr        = '';
    $nama_mesin      = '';
    $kode_mesin      = '';
    $jam             = '';
    $total_operasi   = '';
    $hasil_pengujian = '';
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
                        <h4 class="judul"><?= $frmjdl . ' ' . strtoupper($item);  ?></h4>
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

                        <form action="<?= base_url('form_input/C_formfrmfss031_03/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss031" name="formfrmfss031" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                            <select name="dept" id="dept" class="form-control dept select2" required>
                                                <option value="">- Pilih -</option>
                                                <?php foreach ($dtdept as $dtdept_row) { ?>
                                                    <option value="<?php echo $dtdept_row->deptid; ?>" <?php if ($dtdept_row->deptid == $dept) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo $dtdept_row->deptabbr; ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" name="deptabbr" id="deptabbr" class="form-control deptabbr" value="<?= $deptabbr ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Item
                                        </div>
                                        <div class="col-md-6">
                                            <select name="item" id="item" class="form-control item select2" required>
                                                <?php if ($dtheader) { ?>
                                                    <option value="">- Pilih -</option>
                                                    <option value="mesin" <?= $item == "mesin" ? "selected" : ""  ?>>Mesin</option>
                                                    <option value="panel" <?= $item == "panel" ? "selected" : ""  ?>>Panel</option>
                                                <?php  } else { ?>
                                                    <option value="">- Pilih -</option>
                                                    <option value="mesin">Mesin</option>
                                                    <option value="panel">Panel</option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <div class="nama">
                                                Nama <?= ucwords($item) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="nama_mesin" id="nama_mesin" class="form-control nama_mesin select2" required>
                                                <option value="">- Pilih -</option>
                                                <?php
                                                foreach ($dtmesin as $dtmesin_row) { ?>
                                                    <option value="<?php echo $dtmesin_row->nama_mesin; ?>" <?php if ($dtmesin_row->nama_mesin == $nama_mesin) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?php echo $dtmesin_row->nama_mesin; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Kode
                                        </div>
                                        <div class="col-md-6">
                                            <select name="kode_mesin" id="kode_mesin" class="form-control kode_mesin select2" required>
                                                <option value="">- Pilih -</option>
                                                <?php if (isset($dtdetail)) { ?>
                                                    <option value="<?php echo $kode_mesin; ?>" <?php if ($kode_mesin == $kode_mesin) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $kode_mesin; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Total Operasi (Jam)
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="total_operasi" id="total_operasi" class="form-control total_operasi" value="<?= $total_operasi; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Jam
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="jam" id="jam" class="form-control jam masktime" value="<?= $jam; ?>" required>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- END HEADER -->

                            <div class="card-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="2"></th>
                                                        <th class="table-primary align-middle text-center nama_bagian" rowspan="2">Nama <?= ucwords($item) ?>/Bagian <?= ucwords($item) ?></th>
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
                                                <tbody id="tbody">
                                                    <?php if (isset($dtdetail)) {
                                                        foreach ($dtdetail as $dtdetail_row) {  ?>
                                                            <tr>
                                                                <input type="hidden" name="detail_id[]" id="detail_id" class="form-control detail_id" value="<?= $dtdetail_row->detail_id ?>">
                                                                <td align="center"><input type="checkbox" name="chk[]" id="chk" class="chk" value="<?= $dtdetail_row->detail_id ?>"></td>
                                                                <td align="center"><input type="text" name="bagian_mesin[]" id="bagian_mesin" class="form-control bagian_mesin w-auto" size="30" value="<?= $dtdetail_row->bagian_mesin ?>"></td>
                                                                <td align="center"><input type="text" name="kondisi_masalah[]" id="kondisi_masalah" class="form-control kondisi_masalah w-auto" size="30" value="<?= $dtdetail_row->kondisi_masalah ?>"></td>
                                                                <td align="center"><input type="text" name="tindakan[]" id="tindakan" class="form-control tindakan w-auto" size="30" value="<?= $dtdetail_row->tindakan ?>"></td>
                                                                <td align="center"><input type="text" name="suku_cadang_jenis[]" id="suku_cadang_jenis" class="form-control suku_cadang_jenis w-auto" size="15" value="<?= $dtdetail_row->suku_cadang_jenis ?>"></td>
                                                                <td align="center"><input type="text" name="suku_cadang_jumlah[]" id="suku_cadang_jumlah" class="form-control suku_cadang_jumlah w-auto" size="15" value="<?= $dtdetail_row->suku_cadang_jumlah ?>"></td>
                                                                <td align="center"><input type="text" name="keterangan[]" id="keterangan" class="form-control keterangan w-auto" size="30" value="<?= $dtdetail_row->keterangan ?>"></td>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                        <tr>
                                                            <td align="center"><input type="checkbox" name="chk[]" id="chk" class="chk" value=""></td>
                                                            <td align="center"><input type="text" name="bagian_mesin[]" id="bagian_mesin" class="form-control bagian_mesin w-auto" size="30" value=""></td>
                                                            <td align="center"><input type="text" name="kondisi_masalah[]" id="kondisi_masalah" class="form-control kondisi_masalah w-auto" size="30" value=""></td>
                                                            <td align="center"><input type="text" name="tindakan[]" id="tindakan" class="form-control tindakan w-auto" size="30" value=""></td>
                                                            <td align="center"><input type="text" name="suku_cadang_jenis[]" id="suku_cadang_jenis" class="form-control suku_cadang_jenis w-auto" size="15" value=""></td>
                                                            <td align="center"><input type="text" name="suku_cadang_jumlah[]" id="suku_cadang_jumlah" class="form-control suku_cadang_jumlah w-auto" size="15" value=""></td>
                                                            <td align="center"><input type="text" name="keterangan[]" id="keterangan" class="form-control keterangan w-auto" size="30" value=""></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" colspan="15" align="center">
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
                                                                    <button type="button" class="btn btn-sm bg-gradient-success" id="sisip_baris" onClick="InsertRow('tbody')">Sisip
                                                                        Baris</button>
                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody')">Hapus
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
                                <div class="row mt-1">
                                    <div class="col-6">

                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                Hasil Pengujian/Running Test (coret yang tidak perlu)
                                            </div>
                                            <div class="col-md-6">
                                                <select name="hasil_pengujian" id="hasil_pengujian" class="form-control hasil_pengujian select2" required>
                                                    <option value="">- Pilih -</option>
                                                    <option value="Layak Operasi" <?= $hasil_pengujian == 'Layak Operasi' ? 'selected' : ''; ?>>Layak Operasi</option>
                                                    <option value="Belum Layak Operasi" <?= $hasil_pengujian == 'Belum Layak Operasi' ? 'selected' : ''; ?>>Belum Layak Operasi</option>
                                                </select>
                                            </div>
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

        function get_docno() {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            if (typeof(input_headerid) == "undefined" && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss031_03/get_docno/frmfss031/03",
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

        $(document).on('change', '.item', function() {
            var that = $(this);
            var item = that.val();
            var dept = $('#dept').val();

            // $('.item').val($(this).find('option:selected').text());
            if (item != '') {
                if (item == "mesin") {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss031_03/get_nama_mesin/frmfss031/03",
                        data: {
                            item,
                            dept
                        },
                        async: false,
                        dataType: "json",
                        success: function(data) {
                            var opt = '';
                            if (data.status == 0) {
                                $.each(data.data, function(key, dtl_val) {
                                    opt += '<option value="' + dtl_val.nama_mesin + '">' + dtl_val.nama_mesin + '</option>';
                                });
                                $('[class*=nama_mesin]').find('option:not(:first)').remove();
                                $('[class*=nama_mesin]').append(opt);
                            }
                        }
                    });
                } else if (item == "panel") {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss031_03/get_nama_panel/frmfss031/03",
                        data: {
                            item,
                            dept
                        },
                        async: false,
                        dataType: "json",
                        success: function(data) {
                            var opt = '';
                            if (data.status == 0) {
                                $.each(data.data, function(key, dtl_val) {
                                    opt += '<option value="' + dtl_val.nama_panel + '">' + dtl_val.nama_panel + '</option>';
                                });
                                $('[class*=nama_mesin]').find('option:not(:first)').remove();
                                $('[class*=nama_mesin]').append(opt);
                            }
                        }
                    });
                } else {}

            }
            if (item == "mesin") {
                $('.judul').html("LAPORAN TINDAKAN PERAWATAN MESIN")
                $('.nama_bagian').html(" Nama Mesin / Bagian Mesin")
                $('.nama').html(" Nama Mesin")
            } else if (item == "panel") {
                $('.judul').html("LAPORAN TINDAKAN PERAWATAN PANEL")
                $('.nama_bagian').html(" Nama Panel / Bagian Panel")
                $('.nama').html(" Nama Panel")
            } else {
                $('.judul').html("LAPORAN TINDAKAN PERAWATAN")
            }
        });
        $(document).on('change', '.dept', function() {
            var that = $(this);
            var dept = that.val();
            // var deptabbr = $('#deptabbr').val();
            $('.deptabbr').val($(this).find('option:selected').text());
        });
        $(document).on('change', '.nama_mesin', function() {
            var that = $(this);
            var nama_mesin = that.val();
            var item = $('#item').val();
            console.log(item);
            // var deptabbr = $('#deptabbr').val();
            if (nama_mesin != '') {

                if (item == "mesin") {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss031_03/get_kode_mesin/frmfss031/03",
                        data: {
                            nama_mesin
                        },
                        async: false,
                        dataType: "json",
                        success: function(data) {
                            var opt = '';
                            if (data.status == 0) {
                                $.each(data.data, function(key, dtl_val) {
                                    opt += '<option value="' + dtl_val.kode_mesin + '">' + dtl_val.kode_mesin + '</option>';
                                });
                                $('[class*=kode_mesin]').find('option:not(:first)').remove();
                                $('[class*=kode_mesin]').append(opt);
                            }
                        }
                    });
                } else if (item == "panel") {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss031_03/get_kode_panel/frmfss031/03",
                        data: {
                            nama_mesin
                        },
                        async: false,
                        dataType: "json",
                        success: function(data) {
                            var opt = '';
                            if (data.status == 0) {
                                $.each(data.data, function(key, dtl_val) {
                                    opt += '<option value="' + dtl_val.kode_panel + '">' + dtl_val.kode_panel + '</option>';
                                });
                                $('[class*=kode_mesin]').find('option:not(:first)').remove();
                                $('[class*=kode_mesin]').append(opt);
                            }
                        }
                    });
                } else {}
            }
        });
        $(document).on('change', '.kode_mesin', function() {
            var that = $(this);
            var kode_mesin = that.val();
            var nama_mesin = $('.nama_mesin').val();
            var deptabbr = $('#deptabbr').val();
            var item = $('#item').val();


            if (item == "mesin") {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss031_03/get_partkomponen/frmfss031/03",
                    data: {
                        deptabbr,
                        nama_mesin,
                        kode_mesin
                    },
                    async: false,
                    dataType: "json",
                    success: function(data) {
                        var opt = '';
                        var status = '';
                        var ronly = '';
                        var jml = 1
                        if (data.status == 0) {
                            $.each(data.data_komponen, function(key, dtl_val) {
                                console.log(data.data_na_komponen)
                                if (data.data_na_komponen != "") {
                                    $.each(data.data_na_komponen[0].part_komponen.split(','), function(key_komponen, val_komponen) {
                                        if (dtl_val.komponen_id == val_komponen) {
                                            if (data.data_na_komponen[0].part_komponen_na != null) {
                                                ronly = '';
                                                status = '';
                                                $.each(data.data_na_komponen[0].part_komponen_na.split(','), function(key_komponen_na, val_komponen_na) {
                                                    if (val_komponen == val_komponen_na) {
                                                        ronly = 'readonly';
                                                        status = 'NA';
                                                    }
                                                });
                                                if (status == 'NA') {
                                                    opt += `<tr>
                                                        <td align="center"><input type="checkbox" name="chk[]" id="chk" class="chk" value=""></td>
                                                        <td align="center"><input type="text" name="bagian_mesin[]" id="bagian_mesin" class="form-control bagian_mesin w-auto" size="30" readonly value="` + dtl_val.nama_komponen + `"/></td>
                                                        <td align="center"><input type="text" name="kondisi_masalah[]" id="kondisi_masalah" class="form-control kondisi_masalah w-auto" size="30" value="${status}" ${ronly}></td>
                                                        <td align="center"><input type="text" name="tindakan[]" id="tindakan" class="form-control tindakan w-auto" size="30" value="${status}" ${ronly}></td>
                                                        <td align="center"><input type="text" name="suku_cadang_jenis[]" id="suku_cadang_jenis" class="form-control suku_cadang_jenis w-auto" size="15" value="${status}" ${ronly}></td>
                                                        <td align="center"><input type="text" name="suku_cadang_jumlah[]" id="suku_cadang_jumlah" class="form-control suku_cadang_jumlah w-auto" size="15" value="${status}" ${ronly}></td>
                                                        <td align="center"><input type="text" name="keterangan[]" id="keterangan" class="form-control keterangan w-auto" size="30" value="${status}" ${ronly}></td>
                                                    </tr>`;
                                                } else {
                                                    opt += `<tr>
                                                        <td align="center"><input type="checkbox" name="chk[]" id="chk" class="chk" value=""></td>
                                                        <td align="center"><input type="text" name="bagian_mesin[]" id="bagian_mesin" class="form-control bagian_mesin w-auto" size="30" readonly value="` + dtl_val.nama_komponen + `"/></td>
                                                        <td align="center"><input type="text" name="kondisi_masalah[]" id="kondisi_masalah" class="form-control kondisi_masalah w-auto" size="30" value="${status}" ${ronly}></td>
                                                        <td align="center"><input type="text" name="tindakan[]" id="tindakan" class="form-control tindakan w-auto" size="30" value="${status}" ${ronly}></td>
                                                        <td align="center"><input type="text" name="suku_cadang_jenis[]" id="suku_cadang_jenis" class="form-control suku_cadang_jenis w-auto" size="15" value="${status}" ${ronly}></td>
                                                        <td align="center"><input type="text" name="suku_cadang_jumlah[]" id="suku_cadang_jumlah" class="form-control suku_cadang_jumlah w-auto" size="15" value="${status}" ${ronly}></td>
                                                        <td align="center"><input type="text" name="keterangan[]" id="keterangan" class="form-control keterangan w-auto" size="30" value="${status}" ${ronly}></td>
                                                    </tr>`;
                                                }
                                            } else {
                                                opt += `<tr>
                                                    <td align="center"><input type="checkbox" name="chk[]" id="chk" class="chk" value=""></td>
                                                    <td align="center"><input type="text" name="bagian_mesin[]" id="bagian_mesin" class="form-control bagian_mesin w-auto" size="30" readonly value="` + dtl_val.nama_komponen + `"/></td>
                                                    <td align="center"><input type="text" name="kondisi_masalah[]" id="kondisi_masalah" class="form-control kondisi_masalah w-auto" size="30" value="${status}" ${ronly}></td>
                                                    <td align="center"><input type="text" name="tindakan[]" id="tindakan" class="form-control tindakan w-auto" size="30" value="${status}" ${ronly}></td>
                                                    <td align="center"><input type="text" name="suku_cadang_jenis[]" id="suku_cadang_jenis" class="form-control suku_cadang_jenis w-auto" size="15" value="${status}" ${ronly}></td>
                                                    <td align="center"><input type="text" name="suku_cadang_jumlah[]" id="suku_cadang_jumlah" class="form-control suku_cadang_jumlah w-auto" size="15" value="${status}" ${ronly}></td>
                                                    <td align="center"><input type="text" name="keterangan[]" id="keterangan" class="form-control keterangan w-auto" size="30" value="${status}" ${ronly}></td>
                                                </tr>`;
                                            }
                                        }
                                    });
                                } else {
                                    opt += `<tr>
                                                    <td align="center"><input type="checkbox" name="chk[]" id="chk" class="chk" value=""></td>
                                                    <td align="center"><input type="text" name="bagian_mesin[]" id="bagian_mesin" class="form-control bagian_mesin w-auto" size="30" readonly value="` + dtl_val.nama_komponen + `"/></td>
                                                    <td align="center"><input type="text" name="kondisi_masalah[]" id="kondisi_masalah" class="form-control kondisi_masalah w-auto" size="30" ></td>
                                                    <td align="center"><input type="text" name="tindakan[]" id="tindakan" class="form-control tindakan w-auto" size="30" ></td>
                                                    <td align="center"><input type="text" name="suku_cadang_jenis[]" id="suku_cadang_jenis" class="form-control suku_cadang_jenis w-auto" size="15" ></td>
                                                    <td align="center"><input type="text" name="suku_cadang_jumlah[]" id="suku_cadang_jumlah" class="form-control suku_cadang_jumlah w-auto" size="15" ></td>
                                                    <td align="center"><input type="text" name="keterangan[]" id="keterangan" class="form-control keterangan w-auto" size="30" ></td>
                                                </tr>`;
                                }
                            });
                            // $.each(data.data_komponen, function(key, dtl_val) {
                            // opt += `<tr>
                            //             <td align="center"><input type="checkbox" name="chk[]" id="chk" class="chk" value=""></td>
                            //             <td align="center"><input type="text" name="bagian_mesin[]" id="bagian_mesin" class="form-control bagian_mesin w-auto" size="30" readonly value="` + dtl_val.nama_komponen + `"/></td>
                            //             <td align="center"><input type="text" name="kondisi_masalah[]" id="kondisi_masalah" class="form-control kondisi_masalah w-auto" size="30" value="${isi}" ${ronly}></td>
                            //             <td align="center"><input type="text" name="tindakan[]" id="tindakan" class="form-control tindakan w-auto" size="30" value="${isi}" ${ronly}></td>
                            //             <td align="center"><input type="text" name="suku_cadang_jenis[]" id="suku_cadang_jenis" class="form-control suku_cadang_jenis w-auto" size="15" value="${isi}" ${ronly}></td>
                            //             <td align="center"><input type="text" name="suku_cadang_jumlah[]" id="suku_cadang_jumlah" class="form-control suku_cadang_jumlah w-auto" size="15" value="${isi}" ${ronly}></td>
                            //             <td align="center"><input type="text" name="keterangan[]" id="keterangan" class="form-control keterangan w-auto" size="30" value="${isi}" ${ronly}></td>
                            //         </tr>`;
                            // });
                            $('#tbody').empty().append(opt);
                        }
                    }
                });
            } else if (item == "panel") {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss031_03/get_partkomponen_panel/frmfss031/03",
                    data: {
                        deptabbr,
                        nama_mesin,
                        kode_mesin
                    },
                    async: false,
                    dataType: "json",
                    success: function(data) {
                        var opt = '';
                        if (data.status == 0) {
                            $.each(data.data_komponen, function(key, dtl_val) {
                                opt += `<tr>
                                                    <td align="center"><input type="checkbox" name="chk[]" id="chk" class="chk" value=""></td>
                                                    <td align="center"><input type="text" name="bagian_mesin[]" id="bagian_mesin" class="form-control bagian_mesin w-auto" size="30" readonly value="` + dtl_val.nama_komponen + `"/></td>
                                                    <td align="center"><input type="text" name="kondisi_masalah[]" id="kondisi_masalah" class="form-control kondisi_masalah w-auto" size="30" ></td>
                                                    <td align="center"><input type="text" name="tindakan[]" id="tindakan" class="form-control tindakan w-auto" size="30" ></td>
                                                    <td align="center"><input type="text" name="suku_cadang_jenis[]" id="suku_cadang_jenis" class="form-control suku_cadang_jenis w-auto" size="15" ></td>
                                                    <td align="center"><input type="text" name="suku_cadang_jumlah[]" id="suku_cadang_jumlah" class="form-control suku_cadang_jumlah w-auto" size="15" ></td>
                                                    <td align="center"><input type="text" name="keterangan[]" id="keterangan" class="form-control keterangan w-auto" size="30" ></td>
                                                </tr>`;

                            });
                            $('#tbody').empty().append(opt);
                        }
                    }
                });
            } else {}


        })
    });
</script>



<?php $this->load->view('template/footbarend'); ?>