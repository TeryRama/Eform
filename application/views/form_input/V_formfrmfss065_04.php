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
        $tahun          = date("Y", strtotime($header->tahun));
        $docno          = $header->docno;
        $dept           = $header->dept;
        $deptabbr       = $header->deptabbr;
        $item           = $header->item;
        $gugus          = $header->gugus;
        $id_gugus          = $header->id_gugus;
        $nama_mesin     = $header->nama_mesin;
        $id_jns_mesin   = $header->id_jns_mesin;
        $jns_mesin      = $header->jns_mesin;
    }
} else if (isset($message)) {
    $aksi           = "dtsave";

    $create_date    = $dtcreate_date;
    $tahun          = $dttahun;
    $docno          = $dtdocno;
    $dept           = $dtdept;
    $deptabbr       = $dtdeptabbr;
    $item           = $dtitem;
    $gugus          = $dtgugus;
    $id_gugus          = $dtid_gugus;
    $nama_mesin     = $dtnama_mesin;
    $id_jns_mesin   = $dtid_jns_mesin;
    $jns_mesin      = $dtjns_mesin;
} else {
    $aksi           = "dtsave";
    $create_date    = date("d-m-Y", strtotime($dtcreate_date));
    $tahun          = date("Y", strtotime($dttahun));
    $docno          = '';
    $dept           = '';
    $deptabbr       = '';
    $item           = '';
    $gugus          = '';
    $id_gugus          = '';
    $nama_mesin     = '';
    $id_jns_mesin   = NULL;
    $jns_mesin      = '';
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

                        <form action="<?= base_url('form_input/C_formfrmfss065_04/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss065" name="formfrmfss065" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                            Tahun
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($dtheader)) { ?>
                                                <input type="text" name="tahun" id="tahun" class="form-control tahun" value="<?= $tahun; ?>" required readonly>
                                            <?php } else { ?>
                                                <input type="text" name="tahun" id="tahun" class="form-control datepicker_tahun tahun" value="<?= $tahun; ?>" required>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Departemen
                                        </div>
                                        <div class="col-md-6">
                                            <select name="dept" id="dept" class="form-control dept select2 dtopen_blok2" required>
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


                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Item
                                        </div>
                                        <div class="col-md-6">
                                            <select name="item" id="item" class="form-control select2 item" required>
                                                <?php if (isset($dtheader)) { ?>
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

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Jenis Mesin
                                        </div>
                                        <div class="col-md-6">
                                            <select name="id_jns_mesin" id="id_jns_mesin" class="form-control id_jns_mesin select2 dtopen_blok2" required>
                                                <option value="">- Pilih -</option>
                                                <?php if (isset($dtjenis_mesin)) {
                                                    foreach ($dtjenis_mesin as $dtjenis_mesin_row) { ?>
                                                        <option value="<?= $dtjenis_mesin_row->detail_id ?>" <?= $dtjenis_mesin_row->detail_id == $id_jns_mesin ? 'selected' : ''; ?>><?= $dtjenis_mesin_row->item1 ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                            <input type="hidden" name="jns_mesin" id="jns_mesin" value="<?= $jns_mesin ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Gugus
                                        </div>
                                        <div class="col-md-6">
                                            <select name="id_gugus" id="id_gugus" class="form-control id_gugus select2 dtopen_blok2" required>
                                                <option value="">- Pilih -</option>
                                                <?php if (isset($dtgugus)) {
                                                    foreach ($dtgugus as $dtgugus_row) { ?>
                                                        <option value="<?= $dtgugus_row->detail_id ?>" <?= $dtgugus_row->detail_id == $id_gugus ? 'selected' : ''; ?>><?= $dtgugus_row->gugus ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                            <input type="hidden" name="gugus" id="gugus" value="<?= $gugus ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Nama Mesin
                                        </div>
                                        <div class="col-md-6">
                                            <select name="nama_mesin" id="nama_mesin" class="form-control nama_mesin select2 dtopen_blok2">
                                                <option value="">- Pilih -</option>
                                                <?php if (isset($list_mesin_frmfss064)) {
                                                    foreach ($list_mesin_frmfss064 as $list_mesin_frmfss064_row) { ?>
                                                        <option value="<?= $list_mesin_frmfss064_row->nama_mesin ?>" <?= $nama_mesin == $list_mesin_frmfss064_row->nama_mesin ? 'selected' : ''; ?>><?= $list_mesin_frmfss064_row->nama_mesin ?></option>
                                                <?php
                                                    }
                                                } ?>
                                            </select>
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
                                                        <th class="table-primary align-middle text-center" rowspan="2">Tanggal</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Kategori</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Tindakan</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Waktu</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Unplanned/Planned</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody" align="center">
                                                    <?php if (isset($dtdetail)) {
                                                        foreach ($dtdetail as $dtdetail_row) { ?>
                                                            <tr>
                                                                <input type="hidden" name="detail_id[]" id="detail_id" class="form-control detail_id" value="<?= $dtdetail_row->detail_id ?>">
                                                                <input type="hidden" name="detail_id_060[]" id="detail_id_060" class="form-control detail_id_060" value="<?= $dtdetail_row->detail_id_060 ?>">
                                                                <input type="hidden" name="headerid_060[]" id="headerid_060" class="form-control headerid_060" value="<?= $dtdetail_row->headerid_060 ?>">
                                                                <td><input type="checkbox" name="dtl_a_chk[]" id="dtl_a_chk" class="dtl_a_chk" value="<?= $dtdetail_row->detail_id ?>"></td>
                                                                <td><input type="text" name="dtl_a_tanggal[]" id="dtl_a_tanggal" class="dtl_a_tanggal form-control datepicker_row maskdate w-auto" value="<?= date('d-m-Y', strtotime($dtdetail_row->tanggal)) == '01-01-1970' ? '' : date('d-m-Y', strtotime($dtdetail_row->tanggal)) ?>"></td>
                                                                <td><select name="dtl_a_kategori[]" id="dtl_a_kategori" class="dtl_a_kategori form-control w-auto">
                                                                        <option value="">- Pilih -</option>
                                                                        <option value="Mekanik" <?= $dtdetail_row->kategori == 'Mekanik' ? 'selected' : ''; ?>>Mekanik</option>
                                                                        <option value="Listrik" <?= $dtdetail_row->kategori == 'Listrik' ? 'selected' : ''; ?>>Listrik</option>
                                                                    </select></td>
                                                                <td><textarea name="dtl_a_tindakan[]" id="dtl_a_tindakan" class="dtl_a_tindakan form-control w-auto" row="3" col="25"><?= $dtdetail_row->tindakan ?></textarea></td>
                                                                <td><input type="text" name="dtl_a_waktu[]" id="dtl_a_waktu" class="dtl_a_waktu form-control w-auto" value="<?= $dtdetail_row->waktu ?>" size="5"></td>
                                                                <td><select name="dtl_a_plan[]" id="dtl_a_plan" class="dtl_a_plan form-control w-auto">
                                                                        <option value="">- Pilih -</option>
                                                                        <option value="Unplanned" <?= $dtdetail_row->planned == 'Unplanned' ? 'selected' : ''; ?>>Unplanned</option>
                                                                        <option value="Planned" <?= $dtdetail_row->planned == 'Planned' ? 'selected' : ''; ?>>Planned</option>
                                                                    </select></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" colspan="19" align="center">
                                                            <!--</?php if (!isset($dtdetail)) {
                                                                if ($akses_create == '1') { ?>
                                                                    <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody')">Tambah
                                                                        Baris</button>
                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody')">Hapus
                                                                        Baris</button>
                                                                </?php } else {/*No Acess Create*/
                                                                }
                                                            } else {
                                                                if ($akses_update == '1') { ?>
                                                                    <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('tbody')">Tambah
                                                                        Baris</button>
                                                                    <button type="button" class="btn btn-sm bg-gradient-success" id="sisip_baris" onClick="InsertRow('TBody_a')">Sisip 
                                                                        Baris</button>
                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody')">Hapus
                                                                        Baris</button>
                                                                </?php } else {/*No Acess Update*/
                                                                }
                                                                if ($akses_delete == '1') { ?>
                                                                    <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus
                                                                        Data</button>
                                                            </?php } else {/*No Acess Delete*/
                                                                }
                                                            } ?>-->
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php $this->load->view('laporan/V_laporan_definisi'); ?>
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
                                                <i class="fa fa-refresh"></i> Refresh
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
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss065_04/get_docno/frmfss065/04",
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

        function get_jenis_mesin_by(item) {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();

            var dept = $('#deptabbr').val();
            console.log(item);
            if (dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss065_04/get_jenis_mesin_by/frmfss065/04",
                    data: {
                        dept,
                        item,
                        create_date,
                    },
                    async: false,
                    dataType: "json",
                    success: function(data) {
                        var opt = '';
                        if (data.status == 0) {
                            $.each(data.data, function(key, dtl_val) {
                                opt += '<option value="' + dtl_val.detail_id + '">' + dtl_val.item1 + '</option>';
                            })
                            $('.id_jns_mesin').find('option:not(:first)').remove();
                            $('.id_jns_mesin').append(opt);
                        }
                    }
                });
            }
        }

        function get_gugus_by(id_jns_mesin) {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            var dept = $('#deptabbr').val();
            if (typeof(input_headerid) == "undefined" && dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss812_00/get_gugus_by/frmfss812/00",
                    data: {
                        dept,
                        create_date,
                        id_jns_mesin
                    },
                    async: false,
                    dataType: "json",
                    success: function(data) {
                        var opt = '';
                        var list_mesin = '';
                        if (data.status == 0) {
                            $.each(data.data, function(key, dtl_val) {
                                opt += '<option value="' + dtl_val.detail_id + '">' + dtl_val.item2 + '</option>';
                            })
                            $('.id_gugus').find('option:not(:first)').remove();
                            $('.id_gugus').append(opt);
                        }
                    }
                });
            }
        }

        function get_mesin_frmfss064(gugus) {
            var input_headerid = $(".headerid").val();
            var item = $("#item").val();
            var dept = $('#deptabbr').val();
            if (dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss065_04/get_mesin_frmfss064/frmfss065/04",
                    data: {
                        dept,
                        gugus,
                        item
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

        function get_frmfss060() {
            var input_headerid = $(".headerid").val();
            var tahun = $('.tahun').val();
            var dept = $('.dept').val();
            var nama_mesin = $('.nama_mesin').val().trim();
            if (typeof(input_headerid) == "undefined" && tahun != '' && dept != '' && nama_mesin != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss065_04/get_frmfss060/frmfss065/04",
                    data: {
                        tahun,
                        dept,
                        nama_mesin
                    },
                    async: false,
                    dataType: "json",
                    success: function(result) {
                        let list_dtl_a = `<tr>
                                            <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                        </tr>`;
                        if (result.status == 0) {
                            if (result.data.length) {
                                list_dtl_a = '';
                                $.each(result.data, function(key, dtl_val) {
                                    list_dtl_a += `<tr>
                                                        <td>
                                                            <input type="hidden" name="detail_id_060[]" id="detail_id_060" class="detail_id_060" value="${dtl_val.detail_id}">
                                                            <input type="hidden" name="headerid_060[]" id="headerid_060" class="headerid_060" value="${dtl_val.headerid}">
                                                            <input type="checkbox" name="dtl_a_chk[]" id="dtl_a_chk" class="dtl_a_chk" value=""></td>
                                                        <td><input type="text" name="dtl_a_tanggal[]" id="dtl_a_tanggal" class="dtl_a_tanggal form-control datepicker_row maskdate w-auto" value="` + formatDateId(dtl_val.tgl_start) + `" readonly></td>
                                                        <td><select name="dtl_a_kategori[]" id="dtl_a_kategori" class="dtl_a_kategori form-control w-auto">
                                                            <option value="" ` + ((dtl_val.kategori == '') ? 'selected' : 'disabled') + `>- Pilih -</option>
                                                            <option value="Mekanik" ` + ((dtl_val.kategori == 'Mekanik') ? 'selected' : 'disabled') + `>Mekanik</option>
                                                            <option value="Listrik" ` + ((dtl_val.kategori == 'Listrik') ? 'selected' : 'disabled') + `>Listrik</option>
                                                        </select></td>
                                                        <td><textarea name="dtl_a_tindakan[]" id="dtl_a_tindakan" class="dtl_a_tindakan form-control w-auto" row="3" col="25" readonly>` + dtl_val.tindakan + `</textarea></td>
                                                        <td><input type="text" name="dtl_a_waktu[]" id="dtl_a_waktu" class="dtl_a_waktu form-control w-auto" value="` + dtl_val.waktu_start + `" size="5" readonly></td>
                                                        <td><select name="dtl_a_plan[]" id="dtl_a_plan" class="dtl_a_plan form-control w-auto">
                                                            <option value="" ` + ((dtl_val.planned == '') ? 'selected' : 'disabled') + `>- Pilih -</option>
                                                            <option value="Unplanned" ` + ((dtl_val.planned == 'Unplanned') ? 'selected' : 'disabled') + `>Unplanned</option>
                                                            <option value="Planned" ` + ((dtl_val.planned == 'Planned') ? 'selected' : 'disabled') + `>Planned</option>
                                                        </select></td>
                                                    </tr>`;
                                });
                            }
                            $('#tbody').empty().append(list_dtl_a);
                        }
                    }
                });
            }
        }

        $('.create_date').change(function() {
            get_docno();
        });
        // get_jenis_mesin_by
        // $('.dept').change(function() {
        //     $('#deptabbr').val($(this).find('option:selected').text());
        //     get_mesin_frmfss064();
        // });
        $('.dept').change(function() {
            $('#deptabbr').val($(this).find('option:selected').text());
            ($(this).find('option:selected').text());
        });
        $('.item').change(function() {
            get_jenis_mesin_by($(this).val());
        });
        $('.id_jns_mesin').change(function() {
            $('#jns_mesin').val($(this).find('option:selected').text());
            get_gugus_by($(this).val());
        });
        $('.id_gugus').change(function() {
            $('#gugus').val($(this).find('option:selected').text());
            get_mesin_frmfss064($(this).val());
            // get_itemmesin($(this).val());
        });
        $('.nama_mesin').change(function() {
            get_frmfss060();
        });
    });


    $('.datepicker_tahun').datepicker({
        format: 'yyyy',
        autoclose: true,
        todayHighlight: true,
        startView: 'year',
        minViewMode: 'years'
    }).on('changeDate', function(e) {
        var year = e.date.getFullYear();
        console.log(year);
    });
</script>



<?php $this->load->view('template/footbarend'); ?>