<?php $this->load->view('template/headbar'); ?>

<?php foreach ($dtfrm as $dt_form) {
    $frmjdl       = $dt_form->formjudul;
    $frmefec      = date("d-m-Y", strtotime($dt_form->formefective));
    $frmnm        = $dt_form->formnm;
    $frmkd        = $dt_form->formkd;
    $frmket       = $dt_form->formket;
    $frmvrs       = $dt_form->formversi;
    $createby     = $dt_form->createby;
    $akses_create = $dt_form->form_create;
    $akses_update = $dt_form->form_update;
    $akses_delete = $dt_form->form_delete;
    $akses_excel  = $dt_form->form_excel;
}

if (isset($dtheader)) {
    $aksi = "dtupdate";
    foreach ($dtheader as $row) {
        $headerid         = $row->headerid;
        $comment          = $row->comment;
        $comment_by       = $row->comment_by;
        $comment_time     = $row->comment_time;
        $comment_date     = $row->comment_date;
        $create_date      = $row->create_date;
        $docno            = $row->docno;
        $equipment_name   = $row->equipment_name;
        $equipment_code   = $row->equipment_code;
        $running_test     = $row->running_test;
        $operational_date = $row->operational_date;
    }
} else if (isset($message)) {
    $aksi        = "dtsave";

    $create_date = $dtcreate_date;
    $docno       = $dtdocno;
} else {
    $aksi             = "dtsave";
    $create_date      = "";
    $docno            = "";
    $equipment_name   = "";
    $equipment_code   = "";
    $running_test     = "";
    $operational_date = "";
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

                        <form action="<?= base_url('form_input/C_form' . $frmkd . '_' . $frmvrs . '/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?= $headerid; ?>" id="headerid" class="headerid">
                                    <?php } ?>
                                    <div class="form-group row">
                                        <div class="col-md-3">Tanggal</div>
                                        <div class="col-md-6">
                                            <input type="text" name="create_date" id="create_date" class="form-control create_date datepicker" value="<?= isset($message) ? set_value('create_date') :  $create_date; ?>" <?= isset($dtheader) ? "readonly" :  ""; ?> required>
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
                                <div class="col-md-6">
                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?= $headerid; ?>" id="headerid" class="headerid">
                                    <?php } ?>
                                    <div class="form-group row">
                                        <div class="col-md-3">Nama Alat</div>
                                        <div class="col-md-6">
                                            <input type="text" name="equipment_name" id="equipment_name" class="form-control equipment_name" value="<?= isset($message) ? set_value('equipment_name') :  $equipment_name; ?>" <?= isset($dtheader) ? "readonly" :  ""; ?> required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">Kode Alat</div>
                                        <div class="col-md-6">
                                            <input type="text" name="equipment_code" id="equipment_code" class="form-control equipment_code" value="<?= isset($message) ? set_value('equipment_code') :  $equipment_code; ?>" <?= isset($dtheader) ? "readonly" :  ""; ?> required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" id="scrolling_table_1" style="max-height: 550px;">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead class="fixed freeze_vertical">
                                        <tr>
                                            <th class="table-primary align-middle text-center" rowspan="2">#</th>
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
                                    <tbody id="dta_table">
                                        <?php if (!isset($dtdetail)) {
                                            if (isset($message)) {
                                                for ($i = 0; $i < $dta_count; $i++) { ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="dta_chk[]" class="dta_chk" /></td>
                                                        <td><input type="text" name="dta_problem_condition[]" id="dta_problem_condition" class="form-control" value="<?= set_value('dta_problem_condition[' . $i . ']'); ?>"></td>
                                                        <td><input type="text" name="dta_problem_solving[]" id="dta_problem_solving" class="form-control" value="<?= set_value('dta_problem_solving[' . $i . ']'); ?>"></td>
                                                        <td><input type="text" name="dta_start[]" id="dta_start" class="form-control clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= set_value('dta_start[' . $i . ']'); ?>"></td>
                                                        <td><input type="text" name="dta_finish[]" id="dta_finish" class="form-control clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= set_value('dta_finish[' . $i . ']'); ?>"></td>
                                                        <td><input type="text" name="dta_usage_material[]" id="dta_usage_material" class="form-control" value="<?= set_value('dta_usage_material[' . $i . ']'); ?>"></td>
                                                        <td><input type="text" name="dta_total[]" id="dta_total" class="form-control" onkeypress="return DisableKey(event, 'desimal')" value="<?= set_value('dta_total[' . $i . ']'); ?>"></td>
                                                        <td><input type="text" name="dta_remark[]" id="dta_remark" class="form-control" value="<?= set_value('dta_remark[' . $i . ']'); ?>"></td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td><input type="checkbox" name="dta_chk[]" class="dta_chk" /></td>
                                                    <td><input type="text" name="dta_problem_condition[]" id="dta_problem_condition" class="form-control" value=""></td>
                                                    <td><input type="text" name="dta_problem_solving[]" id="dta_problem_solving" class="form-control" value=""></td>
                                                    <td><input type="text" name="dta_start[]" id="dta_start" class="form-control clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value=""></td>
                                                    <td><input type="text" name="dta_finish[]" id="dta_finish" class="form-control clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value=""></td>
                                                    <td><input type="text" name="dta_usage_material[]" id="dta_usage_material" class="form-control" value=""></td>
                                                    <td><input type="text" name="dta_total[]" id="dta_total" class="form-control" onkeypress="return DisableKey(event, 'desimal')" value=""></td>
                                                    <td><input type="text" name="dta_remark[]" id="dta_remark" class="form-control" value=""></td>
                                                </tr>
                                            <?php }
                                        } else {
                                            $i = 1;
                                            foreach ($dtdetail as $row) {  ?>
                                                <tr>
                                                    <input type="hidden" name="dta_id[]" id="dta_id" class="dta_id" value="<?= $row->detail_id; ?>">
                                                    <td><input type="checkbox" name="dta_chk[]" id="dta_chk" class="dta_chk" value="<?= $row->detail_id; ?>" /></td>
                                                    <td><input type="text" name="dta_problem_condition[]" id="dta_problem_condition" class="form-control" value="<?= $row->dta_problem_condition; ?>"></td>
                                                    <td><input type="text" name="dta_problem_solving[]" id="dta_problem_solving" class="form-control" value="<?= $row->dta_problem_solving; ?>"></td>
                                                    <td><input type="text" name="dta_start[]" id="dta_start" class="form-control clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->dta_start; ?>"></td>
                                                    <td><input type="text" name="dta_finish[]" id="dta_finish" class="form-control clockpicker" data-autoclose="true" data-date-format="HH:mm" style="text-align: center;" value="<?= $row->dta_finish; ?>"></td>
                                                    <td><input type="text" name="dta_usage_material[]" id="dta_usage_material" class="form-control" value="<?= $row->dta_usage_material; ?>"></td>
                                                    <td><input type="text" name="dta_total[]" id="dta_total" class="form-control" onkeypress="return DisableKey(event, 'desimal')" value="<?= $row->dta_total; ?>"></td>
                                                    <td><input type="text" name="dta_remark[]" id="dta_remark" class="form-control" value="<?= $row->dta_remark; ?>"></td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="table-primary align-middle text-center" colspan="8" align="center">
                                                <?php if (!isset($dtdetail)) {
                                                    if ($akses_create == '1') { ?>
                                                        <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('dta_table')">Add Row</button>
                                                        <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('dta_table')">Delete Row</button>
                                                    <?php
                                                    }
                                                } else {
                                                    if ($akses_update == '1') { ?>
                                                        <button type="button" class="btn btn-sm bg-gradient-info" id="tambah_baris" onClick="addRow('dta_table')">Add Row</button>
                                                        <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('dta_table')">Delete Row</button>
                                                    <?php
                                                    }
                                                    if ($akses_delete == '1') { ?>
                                                        <button type="submit" class="btn btn-sm bg-gradient-dark" name="dta_btndelete" id="hapus_data_baris" onClick="return confirm('Anda yakin menghapus data penting ini?')">Delete Data</button>
                                                <?php }
                                                } ?>
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
                                                <td><input type="text" name="running_test" id="running_test" class="form-control datepicker" style="text-align: center;" value="<?= isset($message) ? set_value('running_test') :  $running_test; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>Layak operasi tanggal</td>
                                                <td><input type="text" name="operational_date" id="operational_date" class="form-control datepicker" style="text-align: center;" value="<?= isset($message) ? set_value('operational_date') :  $operational_date; ?>"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if (!isset($dtheader)) {
                                        if (isset($message)) {
                                            if ($akses_create == '1') { ?>
                                                <button type="submit" class="btn bg-gradient-primary" id="btnsimpan"><i class="feather icon-save"></i> Save</button>
                                                <button type="reset" class="btn bg-gradient-light"><i class="feather icon-refresh-ccw"></i> Cancel</button>
                                            <?php }
                                        } else {
                                            if ($akses_create == '1') { ?>
                                                <button type="submit" class="btn bg-gradient-primary" id="btnsimpan"><i class="feather icon-save"></i> Save</button>
                                                <button type="reset" class="btn bg-gradient-light"><i class="feather icon-refresh-ccw"></i> Cancel</button>
                                            <?php }
                                        }
                                    } else {
                                        // tombol sesuaikan dengan halaman shift
                                        if ($akses_update == '1') { ?>
                                            <button type="submit" class="btn bg-gradient-primary" name="btnproses" value="btnupdate" onclick="return confirm('Save Data ?')">
                                                <i class="feather icon-save"></i> Save
                                            </button>
                                            <button type="submit" class="btn bg-gradient-info" name="btnproses" value="btncomplete" onclick="return confirm('Complete Data ?')">
                                                <i class="feather icon-check-square"></i> Complete
                                            </button>
                                        <?php }
                                        if ($akses_excel == '1') { ?>
                                            <a class="btn bg-gradient-success" href="<?= base_url('export_excel/C_export_toexcel_' . $frmkd . '_' . $frmvrs . '/exportxls/' . $frmkd . '/' . $frmvrs . '/' . $headerid) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
                                    <?php }
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
            placeholder: ""
        });

        $(document).on('keyup', '.angkadantitik', function() {
            this.value = this.value.replace(/[^\d.]/g, '');
        });

        get_docno();
    });

    $('.create_date').change(function() {
        get_docno();
    });

    function get_docno() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (create_date != '') {

            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formintwtd032_00/get_docno/intwtd032/00",
                dataType: "json",
                data: {
                    create_date,
                },
                success: function(result) {
                    if (result.status == true) {
                        $('.docno').val(result.data);
                    }
                }
            });
        }
    }

    function DisableKey(e, type) {
        let desimal = e.charCode ? e.charCode : e.keyCode;
        // decimal
        if (type == 'alphabet') {
            // tombol Backspace, Tap, titik, slash, tanda hubung, spcae, dan petik dua diperbolehkan
            // desimal == 39 ' desimal == 44 , desimal == 45 - desimal == 46 . desimal == 47 / desimal == 96 ` desimal == 32 spasi desimal == 34 " 
            if (desimal == 34 || desimal == 8 || desimal == 9 || desimal == 32 || desimal == 45 || desimal == 46 || desimal == 96) {
                return true;
            } else {
                // jika bukan huruf
                if ((desimal < 65 || desimal > 90) && (desimal < 97 || desimal > 122)) {
                    return false; // matikan tombol
                }
            }
        } else {
            if (desimal == 45 || desimal == 46 || desimal == 8 || desimal == 9) {
                // jika menekan tombol Backspace, Tap, titik diperbolehkan
                return true;
            } else {
                // jika bukan angka
                if (desimal < 48 || desimal > 57) {
                    return false; // matikan tombol
                }
            }
        }
    }

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode >= 46 && charCode <= 57)
            if (charCode != 47) {
                return true;
            } else {
                return false;
            }
        return false;
    }

    // MENCARI NILAI TOTAL
    $(document).on('keyup', '.hitung_f_total', function() {
        let f1_flowstop = $(this).closest('tr').find('.f1_flowstop').val();
        let f1_flowstart = $(this).closest('tr').find('.f1_flowstart').val();

        let f_total_fix = (parseFloat(f1_flowstop) - parseFloat(f1_flowstart)).toFixed(2);
        $(this).closest('tr').find('.f1_total').val(isNaN(f_total_fix) ? '' : f_total_fix);
    });
    $(document).on('keyup', '.hitung_g_total', function() {
        let g1_flowstop = $(this).closest('tr').find('.g1_flowstop').val();
        let g1_flowstart = $(this).closest('tr').find('.g1_flowstart').val();

        let g_total_fix = (parseFloat(g1_flowstop) - parseFloat(g1_flowstart)).toFixed(2);
        $(this).closest('tr').find('.g1_total').val(isNaN(g_total_fix) ? '' : g_total_fix);
    });
    // AKHIR MENCARI NILAI TOTAL

    // MENCARI NILAI TOTAL USED WATER
    $(document).on('keyup', '.hitung_total_usedwater', function() {
        let shift_1 = $('.shift_1').val();
        let shift_2 = $('.shift_2').val();
        let shift_3 = $('.shift_3').val();
        if (shift_1 == '') {
            var shift_1_n = '0';
        } else {
            var shift_1_n = shift_1;
        }
        if (shift_2 == '') {
            var shift_2_n = '0';
        } else {
            var shift_2_n = shift_2;
        }
        if (shift_3 == '') {
            var shift_3_n = '0';
        } else {
            var shift_3_n = shift_3;
        }

        let total_usedwater_fix = (parseFloat(shift_1_n) + parseFloat(shift_2_n) + parseFloat(shift_3_n)).toFixed(2);
        $('#total_usedwater').val(total_usedwater_fix);
    });
    // AKHIR MENCARI NILAI TOTAL USED WATER
</script>

<?php $this->load->view('template/footbarend'); ?>