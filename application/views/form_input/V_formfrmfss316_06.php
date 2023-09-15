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

        $tgl            = date("d-m-Y", strtotime($header->tgl));
        $create_date    = date("d-m-Y", strtotime($header->create_date));
        $docno          = $header->docno;
        $remark          = $header->remark;
    }
} else if (isset($message)) {
    $aksi           = "dtsave";

    $create_date    = $dtcreate_date;
    $docno          = $dtdocno;
} else {
    $aksi           = "dtsave";
    $create_date    = date("d-m-Y", strtotime($dtcreate_date));;
    $tgl            = date("d-m-Y");;
    $docno          = '';
    $remark          = '';
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

                        <form action="<?= base_url('form_input/C_formfrmfss316_06/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss316" name="formfrmfss316" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                            Tanggal Laporan Sebelumnya
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($dtheader)) { ?>
                                                <input type="text" name="tgl" id="tgl" class="form-control tgl" value="<?= $tgl; ?>" required readonly>
                                            <?php } else { ?>
                                                <input type="text" name="tgl" id="tgl" class="form-control datepicker maskdate tgl" value="<?= $tgl; ?>" required>
                                            <?php } ?>
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
                                                        <th class="table-primary align-middle text-center">No</th>
                                                        <th class="table-primary align-middle text-center">Supplay Air</th>
                                                        <th class="table-primary align-middle text-center">Departemen Pemakai</th>
                                                        <th class="table-primary align-middle text-center">Nama Flow Meter</th>
                                                        <th class="table-primary align-middle text-center">FM Awal</th>
                                                        <th class="table-primary align-middle text-center">FM akhir</th>
                                                        <th class="table-primary align-middle text-center">Total</th>
                                                        <th class="table-primary align-middle text-center">Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php if (isset($dtdetail)) {
                                                        $no = 1;
                                                        foreach ($dtdetail as $dtdetail_row) { ?>
                                                            <tr>
                                                                <input type="hidden" name="detail_id[]" id="detail_id" class="form-control detail_id" value="<?= $dtdetail_row->detail_id ?>">
                                                                <td align="center"><?= $no++ ?></td>
                                                                <td align="center">
                                                                    <input type="hidden" name="id_flow_meter[]" id="id_flow_meter" class="id_flow_meter form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->id_flow_meter ?>">
                                                                    <input type="text" name="nama_jenis_air[]" id="nama_jenis_air" class="nama_jenis_air form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->nama_jenis_air ?>" required readonly>
                                                                </td>

                                                                <td align="center"><input type="text" name="nama_departemen[]" id="nama_departemen" class="nama_departemen form-control w-auto" style="text-align: center;" size="10" value="<?= $dtdetail_row->nama_departemen ?>" required readonly>
                                                                <td align="center"><input type="text" name="nama_flow[]" id="nama_flow" class="nama_flow form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->nama_flow ?>" required readonly>
                                                                <td align="center"><input type="text" name="fm_awal[]" id="fm_awal" class="fm_awal angkadantitik form-control w-auto" style="text-align: center;" size="10" value="<?= $dtdetail_row->fm_awal ?>">
                                                                <td align="center"><input type="text" name="fm_akhir[]" id="fm_akhir" class="fm_akhir angkadantitik form-control w-auto" style="text-align: center;" size="10" value="<?= $dtdetail_row->fm_akhir ?>">
                                                                <td align="center"><input type="text" name="total[]" id="total" class="total form-control w-auto" style="text-align: center;" size="10" value="<?= $dtdetail_row->total ?>" required readonly>
                                                                <td align="center"><input type="text" name="ket[]" id="ket" class="ket form-control w-auto" style="text-align: center;" size="10" value="<?= $dtdetail_row->ket ?>"></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" colspan="6" align="center">Total</td>
                                                        <td class="table-primary align-middle text-center total_bawah" colspan="1" align="center"></td>
                                                        <td class="table-primary align-middle text-center" colspan="1" align="center"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <strong>Remark :</strong><br>
                                    <?php if (isset($remark)){ ?>
                                    <textarea name="remark" id="remark" cols="80" rows="10"><?=  $remark  ?></textarea>
                                    <?php } else{ ?>
                                    <textarea name="remark" id="remark" cols="80" rows="10"></textarea>
                                    <?php } ?>
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
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss316_06/get_docno/frmfss316/06",
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
        $('#tgl').change(function() {
            get_list_dept_pemakaian_air();
        });

        get_list_dept_pemakaian_air();

        function get_list_dept_pemakaian_air() {
            var input_headerid = $(".headerid").val();
            var create_date = $('#create_date').val();
            var tgl = $('#tgl').val();

            // jika form input
            if (typeof(input_headerid) == "undefined" && tgl != '' && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss316_06/get_list_dept_pemakaian_air/frmfss316/06",
                    data: {
                        tgl,
                        create_date
                    },
                    dataType: "json",
                    async: false,
                    success: function(result) {

                        let list_dtl = '';
                        let type_input = '';

                        if (result.status == 0) {
                            $.each(result.data, function(key, list_dtl_row) {
                                //let fm_awal_readonly = list_dtl_row.headerid_frmfss316 !== null ? "readonly" : "";
                                // if (list_dtl_row.nama_dept == 'WTD' && list_dtl_row.nama_flow == 'WTD') {
                                //     type_input = 'hidden';
                                // } else {
                                    type_input = 'text';
                                // }
                                list_dtl += `<tr>
                                                <td align="center">` + (key + 1) + `</td>
                                                <td align="center">
                                                    <input type="hidden" name="id_flow_meter[]" id="id_flow_meter" class="id_flow_meter form-control w-auto" style="text-align: center;" value="` + list_dtl_row.id_flow_meter + `">
                                                    <input type="` + type_input + `" name="nama_jenis_air[]" id="nama_jenis_air" class="nama_jenis_air form-control w-auto" style="text-align: center;" value="` + list_dtl_row.air + `" required readonly>
                                                </td>
                                                <td align="center"><input type="` + type_input + `" name="nama_departemen[]" id="nama_departemen" class="nama_departemen form-control w-auto" style="text-align: center;" size="10" value="` + list_dtl_row.nama_dept + `" required readonly>
                                                <td align="center"><input type="` + type_input + `" name="nama_flow[]" id="nama_flow" class="nama_flow form-control w-auto" style="text-align: center;" value="` + list_dtl_row.nama_flow + `" required readonly>
                                                <td align="center"><input type="` + type_input + `" name="fm_awal[]" id="fm_awal" class="fm_awal angkadantitik form-control w-auto" style="text-align: center;" size="10" value="` + list_dtl_row.fm_akhir + `">
                                                <td align="center"><input type="` + type_input + `" name="fm_akhir[]" id="fm_akhir" class="fm_akhir angkadantitik form-control w-auto" style="text-align: center;" size="10" value="">
                                                <td align="center"><input type="` + type_input + `" name="total[]" id="total" class="total form-control w-auto" style="text-align: center;" size="10" value="0" required readonly>
                                                <td align="center"><input type="` + type_input + `" name="ket[]" id="ket" class="ket form-control w-auto" style="text-align: center;" size="10" value="">
                                                    </td>
                                            </tr>`;
                            });
                            $('#tbody').empty().append(list_dtl);
                        }

                        notif_btnconfirm_custom(result.vstatus, result.pesan);
                    }
                });
            }
        }

        $(document).on('change', '.fm_akhir', function() {
            let fm_awal = $(this).closest('tr').find(".fm_awal").val();
            let fm_akhir = $(this).val();

            let total_pemakaian = 0;
            if (parseInt(fm_akhir) >= parseInt(fm_awal)) {
                total_pemakaian = fm_akhir - fm_awal;
            } else {
                notif_btnconfirm_custom("error", "Nilai yang anda inputkan salah!");
                $(this).val("");
            }

            $(this).closest('tr').find(".total").val(total_pemakaian.toFixed(1));
            cari_total_bawah();
        });

        cari_total_bawah();

        function cari_total_bawah() {
            var total_bawah = 0;
            $('[class~=total]').each(function() {
                if ($(this).val() != '') {
                    total_bawah += parseFloat($(this).val()) << 0;
                }
            });

            $('.total_bawah').empty().append(total_bawah);
        }
    });
</script>



<?php $this->load->view('template/footbarend'); ?>