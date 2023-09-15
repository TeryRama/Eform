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
        $rev            = $header->rev;
        $dept           = $header->dept;
        $deptabbr       = $header->deptabbr;
        $nama_panel     = $header->nama_panel;
        $kode_panel     = $header->kode_panel;
        $id_nama_panel  = $header->id_nama_panel;
        $id_kode_panel  = $header->id_kode_panel;
        $lokasi_panel   = $header->lokasi_panel;
    }
} else if (isset($message)) {
    $aksi           = "dtsave";

    $create_date    = $dtcreate_date;
    $docno          = $dtdocno;
    $rev            = $dtrev;
    $dept           = $dtdept;
    $deptabbr       = $dtdeptabbr;
    $nama_panel     = $dtnama_panel;
    $kode_panel     = $dtkode_panel;
    $id_nama_panel  = $dtid_nama_panel;
    $id_kode_panel  = $dtid_kode_panel;
    $lokasi_panel   = $dtlokasi_panel;
} else {
    $aksi           = "dtsave";
    $create_date    = date("d-m-Y", strtotime($dtcreate_date));;
    $docno          = '';
    $rev            = '';
    $dept           = '';
    $deptabbr       = '';
    $nama_panel     = '';
    $kode_panel     = '';
    $id_nama_panel  = '';
    $id_kode_panel  = '';
    $lokasi_panel   = '';
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

                        <form action="<?= base_url('form_input/C_formfrmfss845_00/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss064" name="formfrmfss064" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                            Revisi
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="rev" id="rev" class="form-control rev dtopen_blok" value="<?= $rev; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Departemen
                                        </div>
                                        <div class="col-md-6">
                                            <select name="dept" id="dept" class="form-control dept dtopen_blok2 select2" required>
                                                <option value="">- Pilih -</option>
                                                <?php
                                                if (isset($dtdept)) {
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
                                            Nama Panel
                                        </div>
                                        <div class="col-md-6">
                                            <select name="id_nama_panel" id="id_nama_panel" class="form-control id_nama_panel dtopen_blok2 select2" required>
                                                <option value="">- Pilih -</option>
                                                <?php if (isset($headerid)) {
                                                    foreach ($dtnamapanel as $dtnamapanel_row) { ?>
                                                        <option value="<?= $dtnamapanel_row->id_nama_panel ?>" <?= $dtnamapanel_row->id_nama_panel == $id_nama_panel ? "selected" : ""; ?>><?= $dtnamapanel_row->nama_panel ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                            <input type="hidden" name="nama_panel" id="nama_panel" value="<?= $nama_panel ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Kode Panel
                                        </div>
                                        <div class="col-md-6">
                                            <select name="kode_panel" id="kode_panel" class="form-control kode_panel dtopen_blok2 select2" required>
                                                <option value="">- Pilih -</option>
                                                <?php if (isset($headerid)) {
                                                    foreach ($dtkodepanel as $dtkodepanel_row) { ?>?>
                                                <option value="<?= $dtkodepanel_row->kode_panel ?>" <?= $dtkodepanel_row->kode_panel == $kode_panel ? "selected" : ""; ?>><?= $dtkodepanel_row->kode_panel ?></option>
                                        <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Lokasi Panel
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="lokasi_panel" id="lokasi_panel" class="form-control lokasi_panel" value="<?= $lokasi_panel; ?>" required>
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
                                                        <th class="table-primary align-middle text-center" rowspan="1"></th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Nama Komponen</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Kode Komponen</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Type (Spesifikasi)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Merek</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Standard</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Arus (Ampere)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Tenaga (Volt)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php if (isset($dtdetail)) {
                                                        $no = 1;
                                                        foreach ($dtdetail as $dtdetail_row) {  ?>
                                                            <tr>
                                                                <input type="hidden" name="detail_id[]" id="detail_id" class="form-control detail_id" value="<?= $dtdetail_row->detail_id ?>">
                                                                <td align="center"><input type="checkbox" name="chk[]" id="chk" class="chk" value="<?= $dtdetail_row->detail_id ?>"></td>
                                                                <td align="center"><input type="text" name="nama_komponen[]" id="nama_komponen" class="nama_komponen form-control w-auto" size="28" value="<?= $dtdetail_row->nama_komponen ?>"></td>
                                                                <td align="center"><input type="text" name="kode_komponen[]" id="kode_komponen" class="kode_komponen form-control w-auto" size="15" value="<?= $dtdetail_row->kode_komponen ?>"></td>
                                                                <td align="center"><input type="text" name="type_komponen[]" id="type_komponen" class="type_komponen form-control w-auto" size="12" value="<?= $dtdetail_row->type_komponen ?>"></td>
                                                                <td align="center"><input type="text" name="merek[]" id="merek" class="merek form-control w-auto" size="12" value="<?= $dtdetail_row->merek ?>"></td>
                                                                <td align="center"><input type="text" name="standard[]" id="standard" class="standard form-control w-auto" size="12" value="<?= $dtdetail_row->standard ?>"></td>
                                                                <td align="center"><input type="text" name="arus[]" id="arus" class="arus form-control w-auto" size="12" value="<?= $dtdetail_row->arus ?>"></td>
                                                                <td align="center"><input type="text" name="tenaga[]" id="tenaga" class="tenaga form-control w-auto" size="12" value="<?= $dtdetail_row->tenaga ?>"></td>
                                                                <td align="center"><input type="text" name="keterangan[]" id="keterangan" class="keterangan form-control w-auto" size="12" value="<?= $dtdetail_row->keterangan ?>"></td>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                        <tr>
                                                            <td align="center"><input type="checkbox" name="chk[]" id="chk" class="chk" value=""></td>
                                                            <td align="center"><input type="text" name="nama_komponen[]" id="nama_komponen" class="nama_komponen form-control w-auto" size="28" value=""></td>
                                                            <td align="center"><input type="text" name="kode_komponen[]" id="kode_komponen" class="kode_komponen form-control w-auto" size="15" value=""></td>
                                                            <td align="center"><input type="text" name="type_komponen[]" id="type_komponen" class="type_komponen form-control w-auto" size="12" value=""></td>
                                                            <td align="center"><input type="text" name="merek[]" id="merek" class="merek form-control w-auto" size="12" value=""></td>
                                                            <td align="center"><input type="text" name="standard[]" id="standard" class="standard form-control w-auto" size="12" value=""></td>
                                                            <td align="center"><input type="text" name="arus[]" id="arus" class="arus form-control w-auto" size="12" value=""></td>
                                                            <td align="center"><input type="text" name="tenaga[]" id="tenaga" class="tenaga form-control w-auto" size="12" value=""></td>
                                                            <td align="center"><input type="text" name="keterangan[]" id="keterangan" class="keterangan form-control w-auto" size="12" value=""></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" colspan="15" align="center">
                                                            <?php if (!isset($dtdetail)) {
                                                                if ($akses_create == '1') { ?>
                                                                    <button type="button" class="btn btn-sm bg-gradient-info btn_tbody3_sf" id="tambah_baris" onClick="addRow('tbody')">Tambah
                                                                        Baris</button>
                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody')">Hapus
                                                                        Baris</button>
                                                                <?php } else {/*No Acess Create*/
                                                                }
                                                            } else {
                                                                if ($akses_update == '1') { ?>
                                                                    <button type="button" class="btn btn-sm bg-gradient-info btn_tbody3_sf" id="tambah_baris" onClick="addRow('tbody')">Tambah
                                                                        Baris</button>
                                                                    <button type="button" class="btn btn-sm bg-gradient-success" id="sisip_baris" onClick="InsertRow('tbody')">Sisip
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

        // get_docno();

        function get_docno() {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            var deptabbr = $('#deptabbr').val();
            if (typeof(input_headerid) == "undefined" && create_date != '' && deptabbr != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss845_00/get_docno/frmfss845/00",
                    data: {
                        create_date,
                        deptabbr
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
        $('.dept').change(function() {
            var that = $(this);
            var dept = that.val();

            $('#deptabbr').val(that.find(':selected').text());
            get_docno();

            $.ajax({
                url: "<?php echo base_url() ?>form_input/C_formfrmfss845_00/get_namapanel/frmfss845/00",
                type: 'post',
                data: {
                    dept
                },
                dataType: 'json',
                success: function(data) {
                    var opt_panel = '';
                    $.each(data, function(key_panel, value_panel) {
                        opt_panel += '<option value="' + value_panel.id_nama_panel + '">' + value_panel.nama_panel + '</option>';
                    });
                    $('.id_nama_panel').find('option:not(:first)').remove();
                    $('.id_nama_panel').append(opt_panel);
                }
            });
        });
        $('.id_nama_panel').change(function() {
            var nama_panel = $(this).val();
            var dept = $('.dept').val();
            $('#nama_panel').val($(this).find(':selected').text());

            $.ajax({
                url: "<?php echo base_url() ?>form_input/C_formfrmfss845_00/get_kodepanel/frmfss845/00",
                type: 'post',
                data: {
                    dept,
                    nama_panel
                },
                dataType: 'json',
                success: function(data) {
                    var opt_kode_panel = '';
                    $.each(data, function(key_panel, value_panel) {
                        opt_kode_panel += '<option value="' + value_panel.kode_panel + '">' + value_panel.kode_panel + '</option>';
                    });
                    $('.kode_panel').find('option:not(:first)').remove();
                    $('.kode_panel').append(opt_kode_panel);
                }
            });
        });
        $('.kode_panel').change(function() {
            var kode_panel = $(this).val();
            var dept = $('.dept').val();
            var nama_panel = $('.id_nama_panel').val();

        })
    });
</script>



<?php $this->load->view('template/footbarend'); ?>