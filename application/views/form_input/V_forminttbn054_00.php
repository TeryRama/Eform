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
        $headerid           = $row->headerid;
        $comment            = $row->comment;
        $comment_by         = $row->comment_by;
        $comment_time       = $row->comment_time;
        $comment_date       = date("d-m-Y", strtotime($row->comment_date));
        $create_date        = date("d-m-Y", strtotime($row->create_date));
        $bulan              = $row->bulan;
        $tahun              = $row->tahun;
        $docno              = $row->docno;
        $supply_awal_total  = $row->supply_awal_total;
        $supply_akhir_total = $row->supply_akhir_total;
        $supply_total_total = $row->supply_total_total;
        $asf_awal_total     = $row->asf_awal_total;
        $asf_akhir_total    = $row->asf_akhir_total;
        $asf_total_total    = $row->asf_total_total;
        $soft_awal_total    = $row->soft_awal_total;
        $soft_akhir_total   = $row->soft_akhir_total;
        $soft_total_total   = $row->soft_total_total;
    }
} else if (isset($message)) {
    $aksi               = "dtsave";
    $create_date        = $create_date;
    $bulan              = $bulan;
    $docno              = $docno;
    $supply_awal_total  = $supply_awal_total;
    $supply_akhir_total = $supply_akhir_total;
    $supply_total_total = $supply_total_total;
    $asf_awal_total     = $asf_awal_total;
    $asf_akhir_total    = $asf_akhir_total;
    $asf_total_total    = $asf_total_total;
    $soft_awal_total    = $soft_awal_total;
    $soft_akhir_total   = $soft_akhir_total;
    $soft_total_total   = $soft_total_total;
} else {
    $aksi               = "dtsave";
    $create_date        = date("d-m-Y", strtotime($dtcreate_date));
    $tahun              = '';
    $bulan              = '';
    $docno              = '';
    $supply_awal_total  = '0.00';
    $supply_akhir_total = '0.00';
    $supply_total_total = '0.00';
    $asf_awal_total     = '0.00';
    $asf_akhir_total    = '0.00';
    $asf_total_total    = '0.00';
    $soft_awal_total    = '0.00';
    $soft_akhir_total   = '0.00';
    $soft_total_total   = '0.00';
} ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="mt-2 mb-1 d-flex justify-content-center">
                        <img src="<?= base_url('assets/images/Logo_PSG.gif') ?>" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <h2><?= $this->config->item("nama_perusahaan"); ?></h2>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <h2>
                            <h4>DEPARTEMEN PWP-TBN</h4>
                        </h2>
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

                        <form action="<?= base_url('form_input/C_forminttbn054_00/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="forminttbn054" name="forminttbn054" method="post" role="form" autocomplete="off" enctype="multipart/form-data">

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
                                            <?php if (isset($dtheader) || isset($message)) { ?>
                                                <input type="text" name="create_date" id="create_date" class="form-control create_date" value="<?= $create_date; ?>" readonly required>
                                            <?php } else { ?>
                                                <input type="text" name="create_date" id="create_date" class="form-control datepicker maskdate create_date" value="<?= $create_date; ?>" required>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Bulan
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="bulan" id="bulan" class="form-control bulan dtopen_blok" value="<?= $bulan; ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Tahun
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="tahun" id="tahun" class="form-control tahun dtopen_blok" value="<?= $tahun; ?>" readonly required>
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
                            </div>

                            <div class="card-content">
                                <div class="row">
                                    <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                        <table id="myTable" class="table table-bordered table-hover">

                                            <?php if (!isset($message)) { ?>
                                                <thead class="fixed freeze_vertical">
                                                    <tr>
                                                        <th class="table-warning align-middle text-center" rowspan="2" colspan="1">No.</th>
                                                        <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Tanggal</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="3">SUPPLY DEMIN TO DEARATOR</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="3">Flow ASF-WTD</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="3">SOFTENER (AST) - WTD</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Flow Awal</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Flow Akhir</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Total</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Flow Awal</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Flow Akhir</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Total</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Flow Awal</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Flow Akhir</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Total</th>
                                                    </tr>
                                                </thead>
                                            <?php } ?>

                                            <?php $no = 1; ?>
                                            <?php if (!isset($dtdetail)) {
                                                if (isset($message)) { ?>

                                                <?php } else { ?>
                                                    <tbody id="tbody_2">
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                <?php }
                                            } else { ?>
                                                <tbody>
                                                    <?php foreach ($dtdetail as $row) {
                                                        $tanggal_bahan_bakar = $row->tanggal_bahan_bakar;
                                                        $hari = substr($tanggal_bahan_bakar, 0, 2);
                                                        $trimhari = trim($hari, '-'); ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id[]" id="detail_id" class="detail_id form-control w-auto" style="text-align: center;" value="<?= $row->detail_id; ?>">
                                                            <td align="center" class="fixed"><?= $no++; ?></td>
                                                            <td align="center"><input type="text" name="tanggal_bahan_bakar[]" id="tanggal_bahan_bakar" class="tanggal_bahan_bakar form-control w-auto" style="text-align: center;" value="<?= $row->tanggal_bahan_bakar; ?>" readonly></td>

                                                            <td align="center"><input type="number" name="supply_flow_awal[]" id="supply_flow_awal" class="rumus rumus_row_bb supply_flow_awal supply_awal<?= $trimhari ?> form-control w-auto" style="text-align: center;" value="<?= $row->supply_flow_awal; ?>"></td>
                                                            <td align="center"><input type="number" name="supply_flow_akhir[]" id="supply_flow_akhir" class="rumus rumus_row_bb supply_flow_akhir batubara_akhir<?= $trimhari ?> form-control w-auto" style="text-align: center;" value="<?= $row->supply_flow_akhir; ?>"></td>
                                                            <td align="center"><input type="number" name="supply_total[]" id="supply_total" class="rumus supply_total  form-control w-auto" style="text-align: center;" value="<?= $row->supply_total; ?>" readonly></td>

                                                            <td align="center"><input type="number" name="asf_flow_awal[]" id="asf_flow_awal" class="rumus rumus_row_t asf_flow_awal asf_awal<?= $trimhari ?> form-control w-auto" style="text-align: center;" value="<?= $row->asf_flow_awal; ?>"></td>
                                                            <td align="center"><input type="number" name="asf_flow_akhir[]" id="asf_flow_akhir" class="rumus rumus_row_t asf_flow_akhir tempurung_akhir<?= $trimhari ?> form-control w-auto" style="text-align: center;" value="<?= $row->asf_flow_akhir; ?>"></td>
                                                            <td align="center"><input type="number" name="asf_total[]" id="asf_total" class="rumus asf_total  form-control w-auto" style="text-align: center;" value="<?= $row->asf_total; ?>" readonly></td>

                                                            <td align="center"><input type="number" name="soft_flow_awal[]" id="soft_flow_awal" class="rumus rumus_row_s soft_flow_awal soft_awal<?= $trimhari ?> form-control w-auto" style="text-align: center;" value="<?= $row->soft_flow_awal; ?>"></td>
                                                            <td align="center"><input type="number" name="soft_flow_akhir[]" id="soft_flow_akhir" class="rumus rumus_row_s soft_flow_akhir sabut_akhir<?= $trimhari ?> form-control w-auto" style="text-align: center;" value="<?= $row->soft_flow_akhir; ?>"></td>
                                                            <td align="center"><input type="number" name="soft_total[]" id="soft_total" class="rumus soft_total form-control w-auto" style="text-align: center;" value="<?= $row->soft_total; ?>" readonly></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            <?php } ?>

                                            <?php if (!isset($message)) { ?>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-warning align-middle text-center" rowspan="1" colspan="2">Total</td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="supply_awal_total" id="supply_awal_total" class="supply_awal_total form-control" style="text-align: center;" value="<?= $supply_awal_total; ?>" readonly></td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="supply_akhir_total" id="supply_akhir_total" class="supply_akhir_total form-control" style="text-align: center;" value="<?= $supply_akhir_total; ?>" readonly></td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="supply_total_total" id="supply_total_total" class="supply_total_total form-control" style="text-align: center;" value="<?= $supply_total_total; ?>" readonly></td>
                                                        
                                                        <td class="table-warning align-middle text-center"><input type="number" name="asf_awal_total" id="asf_awal_total" class="asf_awal_total form-control" style="text-align: center;" value="<?= $asf_awal_total; ?>" readonly></td>
                                                        <td class="table-warning align-middle text-center"><input type="number" name="asf_akhir_total" id="asf_akhir_total" class="asf_akhir_total form-control" style="text-align: center;" value="<?= $asf_akhir_total; ?>" readonly></td>
                                                        <td class="table-warning align-middle text-center"><input type="number" name="asf_total_total" id="asf_total_total" class="asf_total_total form-control" style="text-align: center;" value="<?= $asf_total_total; ?>" readonly></td>

                                                        <td class="table-danger align-middle text-center"><input type="number" name="soft_awal_total" id="soft_awal_total" class="soft_awal_total form-control" style="text-align: center;" value="<?= $soft_awal_total; ?>" readonly></td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="soft_akhir_total" id="soft_akhir_total" class="soft_akhir_total form-control" style="text-align: center;" value="<?= $soft_akhir_total; ?>" readonly></td>
                                                        <td class="table-danger align-middle text-center"><input type="number" name="soft_total_total" id="soft_total_total" class="soft_total_total form-control" style="text-align: center;" value="<?= $soft_total_total; ?>" readonly></td>
                                                    </tr>
                                                </tfoot>
                                            <?php } ?>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            <?php $this->load->view('laporan/V_laporan_definisi'); ?>

                            <div class="row mt-1">
                                <div class="col-12">
                                    <?php if (!isset($dtheader)) {
                                        if (!isset($message)) {
                                            if ($akses_create == '1') { ?>
                                                <button type="submit" class="btn bg-gradient-primary" id="btnsimpan">
                                                    <i class="feather icon-save"></i> Simpan</button>

                                                <button type="reset" class="btn bg-gradient-light">
                                                    <i class="feather icon-refresh-ccw"></i> Batal</button>
                                            <?php }
                                        } else {/*No Acess Create*/
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
            placeholder: ""
        });

        $(document).on('keyup', '.angkadantitik', function() {
            this.value = this.value.replace(/[^\d.]/g, '');
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
        get_bulan();
        get_tahun()
        get_tanggal_bahan_bakar();
        check_data();
    });

    $('.create_date').change(function() {
        get_docno();
        get_bulan();
        get_tahun()
        get_tanggal_bahan_bakar();
        check_data();
    });

    function get_docno() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn054_00/get_docno/inttbn054/00",
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

    function get_bulan() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn054_00/get_bulan/inttbn054/00",
                data: {
                    create_date
                },
                async: false,
                success: function(data) {
                    $('.bulan').val(JSON.parse(data)['data']);
                }
            });
        }
    }

    function get_tahun() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn054_00/get_tahun/inttbn054/00",
                data: {
                    create_date
                },
                async: false,
                success: function(data) {
                    $('.tahun').val(JSON.parse(data)['data']);
                }
            });
        }
    }

    function get_tanggal_bahan_bakar() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn054_00/get_tanggal_bahan_bakar/inttbn054/00",
                data: {
                    create_date
                },
                dataType: "json",
                async: false,
                success: function(data) {
                    let list_dtl_1 = '';
                    let no = 1;
                    if (data.status == 0) {
                        $.each(data.data, function(key, list_dtl_row) {
                            list_dtl_1 += `
                                            <tr>
                                                <input type="hidden" name="detail_id[]" id="detail_id" class="detail_id form-control w-auto" style="text-align: center;" value="">
                                                <td>${no++}</td>
                                                <td align="center" class="fixed"><input type="text" name="tanggal_bahan_bakar[]" id="tanggal_bahan_bakar" class="tanggal_bahan_bakar dtopen_blok form-control w-auto" style="text-align: center;" value="${list_dtl_row.hari}-${list_dtl_row.bulan}-${list_dtl_row.tahun}" readonly></td>
                                                
                                                <td align="center"><input type="number" name="supply_flow_awal[]" id="supply_flow_awal" class="rumus rumus_row_bb supply_flow_awal supply_awal${list_dtl_row.hari} form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="supply_flow_akhir[]" id="supply_flow_akhir" class="rumus rumus_row_bb supply_flow_akhir form-control batubara_akhir${list_dtl_row.hari} w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="supply_total[]" id="supply_total" class="rumus rumus_row_bb supply_total  form-control w-auto" style="text-align: center;" value="" readonly></td>

                                                <td align="center"><input type="number" name="asf_flow_awal[]" id="asf_flow_awal" class="rumus rumus_row_t asf_flow_awal asf_awal${list_dtl_row.hari} form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="asf_flow_akhir[]" id="asf_flow_akhir" class="rumus rumus_row_t asf_flow_akhir form-control tempurung_akhir${list_dtl_row.hari} w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="asf_total[]" id="asf_total" class="rumus asf_total  form-control w-auto" style="text-align: center;" value="" readonly></td>

                                                <td align="center"><input type="number" name="soft_flow_awal[]" id="soft_flow_awal" class="rumus rumus_row_s soft_flow_awal soft_awal${list_dtl_row.hari} form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="soft_flow_akhir[]" id="soft_flow_akhir" class="rumus rumus_row_s soft_flow_akhir sabut_akhir${list_dtl_row.hari} form-control w-auto" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="number" name="soft_total[]" id="soft_total" class="rumus soft_total  form-control w-auto" style="text-align: center;" value="" readonly></td>
                                            </tr>
                                         `;
                        });
                        $('#tbody_2').empty().append(list_dtl_1);
                    }
                    // console.log(data.vstatus)
                    // notif_btnconfirm_custom(data.vstatus, data.pesan);
                }
            });
        }
    }

    function check_data() {
        var input_headerid = $(".headerid").val();
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();

        // jika form input
        if (typeof(input_headerid) == "undefined" && bulan != '' && tahun != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn054_00/check_data/inttbn054/00",
                data: {
                    bulan,
                    tahun
                },
                dataType: "json",
                async: false,
                success: function(result) {
                    notif_btnconfirm_custom(result.vstatus, result.pesan);
                }
            });
        }
    }

    /* MENCARI NILAI ROW */
    $(document).on('input', '.rumus_row_bb', function() {
        let supply_flow_awal = $(this).closest('tr').find('.supply_flow_awal').val();
        let supply_flow_akhir = $(this).closest('tr').find('.supply_flow_akhir').val();
        let total = (parseFloat(supply_flow_akhir) - parseFloat(supply_flow_awal)).toFixed(2);
        $(this).closest('tr').find('.supply_total').val(total);
    });

    $(document).on('input', '.rumus_row_t', function() {
        let asf_flow_awal = $(this).closest('tr').find('.asf_flow_awal').val();
        let asf_flow_akhir = $(this).closest('tr').find('.asf_flow_akhir').val();
        let total = ((parseFloat(asf_flow_akhir) - parseFloat(asf_flow_awal)) * 10 ).toFixed(2);
        $(this).closest('tr').find('.asf_total').val(total);
    });

    $(document).on('input', '.rumus_row_s', function() {
        let soft_flow_awal = $(this).closest('tr').find('.soft_flow_awal').val();
        let soft_flow_akhir = $(this).closest('tr').find('.soft_flow_akhir').val();
        let total = (parseFloat(soft_flow_akhir) - parseFloat(soft_flow_awal)).toFixed(2);
        $(this).closest('tr').find('.soft_total').val(total);
    });

    /* AKHIR MENCARI NILAI ROW */

    $(document).on('change', '.rumus', function() {
        let date_length = $('.tanggal_bahan_bakar');
        for (let i = 1; i <= date_length.length; i++) {
            cari_nilai_awal('.batubara_akhir' + i, '.supply_awal' + (parseFloat(i) + 1));
            // cari_nilai_awal('.tempurung_akhir' + i, '.asf_awal' + (parseFloat(i) + 1));
            cari_nilai_awal('.sabut_akhir' + i, '.soft_awal' + (parseFloat(i) + 1));
        }
        hitung_total('.supply_flow_awal', '.supply_awal_total');
        hitung_total('.supply_flow_akhir', '.supply_akhir_total');
        hitung_total('.supply_total', '.supply_total_total');
        hitung_total('.asf_flow_awal', '.asf_awal_total');
        hitung_total('.asf_flow_akhir', '.asf_akhir_total');
        hitung_total('.asf_total', '.asf_total_total');
        hitung_total('.soft_flow_awal', '.soft_awal_total');
        hitung_total('.soft_flow_akhir', '.soft_akhir_total');
        hitung_total('.soft_total', '.soft_total_total');
        // hitung_rata2('.supply_flow_awal', '.batubara_stock_awal_rata2');
        // hitung_row('.supply_flow_awal', '.supply_total');
    });

    /* MENCARI NILAI ROW */
    // function hitung_row(awal, akhir) {
    //     let total = 0;
    //     let x = $(awal);
    //     for (let i = 0; i < x; i++) {
    //         let isi_nilai = 0;
    //         if (x[i].value !== "") {
    //             isi_nilai = x[i].value;
    //         }
    //         total += parseFloat(isi_nilai);
    //     }
    //     $(akhir).val(isNaN(total) ? '0.00' : total);
    // }
    /* AKHIR MENCARI NILAI ROW */

    /* MENCARI NILAI AWAL */
    function cari_nilai_awal(akhir, awal) {
        let stock_akhir = $(akhir).val();
        $(awal).val(stock_akhir);
        $(awal).attr('readonly', true);
    }
    /* AKHIR MENCARI NILAI AWAL */

    /* MENCARI NILAI TOTAL */
    function hitung_total(awal, akhir) {
        let nilai_awal = $(awal);
        let nilai_akhir = 0;
        for (let i = 0; i < nilai_awal.length; i++) {
            let isi_nilai = 0;
            if (nilai_awal[i].value !== "") {
                isi_nilai = nilai_awal[i].value;
            }
            nilai_akhir += parseFloat(isi_nilai);
            total = (nilai_akhir).toFixed(2);
        }
        $(akhir).val(isNaN(total) ? '0.00' : total);
    }
    /* AKHIR MENCARI NILAI TOTAL */

    /* MENCARI NILAI RATA - RATA */

    // function hitung_rata2(awal, akhir) {
    //     let total = 0;
    //     let jml_row = 0;
    //     let rata_rata = 0;
    //     $(awal).each(function() {
    //         let val = parseInt(this.value, 10);
    //         if (!isNaN(val)) {
    //             jml_row += 1;
    //             total += val;
    //         }
    //     });
    //     rata_rata = (total / jml_row).toFixed(2);
    //     $(akhir).val(isNaN(rata_rata) ? '0.00' : rata_rata);
    // }

    /* AKHIR MENCARI NILAI RATA - RATA */
</script>

<?php $this->load->view('template/footbarend'); ?>