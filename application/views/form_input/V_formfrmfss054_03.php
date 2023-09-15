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
        $tahun          = $header->tahun;
        $gugus          = $header->gugus;
    }
} else if (isset($message)) {
    $aksi           = "dtsave";

    $create_date    = $dtcreate_date;
    $docno          = $dtdocno;
    $rev            = $dtrev;
    $dept           = $dtdept;
    $deptabbr       = $dtdeptabbr;
    $tahun          = $dttahun;
    $gugus          = $dtgugus;
} else {
    $aksi           = "dtsave";
    $create_date    = date("d-m-Y", strtotime($dtcreate_date));
    $docno          = '';
    $rev            = '';
    $dept           = '';
    $deptabbr       = '';
    $tahun          = date("Y", strtotime($dttahun));
    $gugus          = '';
}
$bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
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

                        <form action="<?= base_url('form_input/C_formfrmfss054_03/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss054" name="formfrmfss054" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                </div>

                                <div class="col-6">
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
                                    <!--<div class="form-group row">
                                        <div class="col-md-3">
                                            Gugus
                                        </div>
                                        <div class="col-md-6">
                                            <select name="gugus" id="gugus" class="form-control gugus select2 dtopen_blok2" required>
                                                <option value="">- Pilih -</option>
                                                </?php if(isset($headerid)){ 
                                                    foreach ($list_gugus as $list_gugus_row) { ?>
                                                        <option value="</?= $list_gugus_row->detail_id ?>" </?= $list_gugus_row->detail_id == $gugus ? 'selected' : ''; ?>></?= $list_gugus_row->gugus ?></option>
                                                </?php } } ?>
                                            </select>
                                        </div>
                                    </div>-->
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Tahun
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($dtheader)) { ?>
                                                <input type="text" name="tahun" id="tahun" class="form-control tahun" value="<?= $tahun; ?>" required readonly>
                                            <?php } else { ?>
                                                <input type="text" name="tahun" id="tahun" class="form-control datepicker_year maskyear tahun" value="<?= $tahun; ?>" required>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- END HEADER -->

                            <?php if (isset($dtheader)) { ?>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn bg-gradient-info" id="add_sch">
                                            <i class="feather icon-edit"></i> Month Schedule
                                        </button>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive" id="scrolling_table_1" style="max-height: 600px;">
                                            <table class="table table-striped table-bordered">
                                                <thead class="fixed freeze_vertical">
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="2"></th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Nama Mesin</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Kode Mesin</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Frekuensi</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Gugus</th>
                                                        <th class="table-primary align-middle text-center" colspan="<?= count($list_month) ?>">Bulan</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Keterangan</th>
                                                    </tr>
                                                    <tr>
                                                        <?php if (isset($list_month)) {
                                                            foreach ($list_month as $list_month_row) { ?>
                                                                <th class="table-primary align-middle text-center" rowspan="1"><?= $bulan[$list_month_row->month]; ?></th>
                                                        <?php }
                                                        } ?>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php if (isset($dtdetail)) {
                                                        $no = 1;
                                                        foreach ($dtdetail as $dtdetail_row) { ?>
                                                            <tr>
                                                                <input type="hidden" name="detail_id[]" id="detail_id" class="form-control detail_id" value="<?= $dtdetail_row->detail_id ?>">
                                                                <td align="center"><input type="checkbox" name="dtl_a_chk[]" id="dtl_a_chk" class="dtl_a_chk" value="<?= $dtdetail_row->detail_id ?>"></td>
                                                                <td align="center"><input type="text" name="dtl_a_nama_mesin[]" id="dtl_a_nama_mesin" class="dtl_a_nama_mesin form-control w-auto" value="<?= $dtdetail_row->nama_mesin ?>" readonly /></td>
                                                                <td align="center"><input type="text" name="dtl_a_kode_mesin[]" id="dtl_a_kode_mesin" class="dtl_a_kode_mesin form-control w-auto" value="<?= $dtdetail_row->kode_mesin ?>" readonly /></td>
                                                                <td align="center"><input type="text" name="dtl_a_frekuensi[]" id="dtl_a_frekuensi" class="dtl_a_frekuensi form-control w-auto" value="<?= $dtdetail_row->frekuensi ?>" readonly /></td>
                                                                <td align="center"><input type="text" name="dtl_a_gugus[]" id="dtl_a_gugus" class="dtl_a_gugus form-control w-auto" value="<?= $dtdetail_row->gugus ?>" readonly /></td>
                                                                <?php if (isset($list_month)) {
                                                                    foreach ($list_month as $list_month_row) { ?>
                                                                        <td align="centar" <?php
                                                                                            if (isset($dtdetail_row->children)) {
                                                                                                foreach ($dtdetail_row->children as $child_row) {
                                                                                                    $arr_tgl_sch = explode(',', $child_row->tgl_schedule);
                                                                                                    foreach ($arr_tgl_sch as $arr_tgl_sch_row) {
                                                                                                        if ($arr_tgl_sch_row == $list_month_row->month) { ?> class="bg-gradient-primary" <?php
                                                                                                                                                                                        }
                                                                                                                                                                                    }
                                                                                                                                                                                }
                                                                                                                                                                            }
                                                                                                                                                                                            ?>>
                                                                            <input type="text" name="<?= 'dtl_a_month' . $list_month_row->month ?>[]" id="<?= 'dtl_a_month' . $list_month_row->month ?>" size="12" class="form-control w-auto datepicker_row maskdate <?= 'dtl_a_month' . $list_month_row->month ?>" value="<?= date('d-m-Y', strtotime($dtdetail_row->{'month' . $list_month_row->month})) == '01-01-1970' ? '' : date('d-m-Y', strtotime($dtdetail_row->{'month' . $list_month_row->month})) ?>">
                                                                        </td>
                                                                <?php }
                                                                } ?>
                                                                <td align="center"><input type="text" name="dtl_a_ket[]" id="dtl_a_ket" class="dtl_a_ket form-control w-auto" size="28" value=""></td>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                    <?php } ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" colspan="18" align="center"></td>
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

        <!-- start modal select day -->
        <div class="modal fade bd-example-modal-lg" id="MonthModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <form class="form-horizontal" role="form" action="" name="form_modal" id="form_modal" method="POST">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="modal_headerid" id="modal_headerid" class="form-control" value="" />
                                    <input type="hidden" name="modal_kodeform" id="modal_kodeform" class="form-control" value="" />

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead class="table-primary" id="th_thead">
                                                <tr>
                                                    <th class="table-primary align-middle text-center" rowspan="1">No</th>
                                                    <th class="table-primary align-middle text-center" rowspan="1">Nama</th>
                                                    <th class="table-primary align-middle text-center" rowspan="1">Kode</th>
                                                    <th class="table-primary align-middle text-center" rowspan="1">Frequency</th>
                                                    <th class="table-primary align-middle text-center" rowspan="1" width="250px">Month</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_modal">
                                            </tbody>
                                            <tfoot align="center" class="table-primary">
                                                <tr>
                                                    <td colspan="38"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-dark" data-dismiss="modal">Batal</button>
                            <button type="button" name="btnmodal_save" id="btnmodal_save" value="btnmodal_save" class="btnmodal_save btn bg-gradient-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal select day -->
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
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss054_03/get_docno/frmfss054/03",
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
        $('.dept').change(function() {
            var txt_dept = $(this).find('option:selected').text();
            $('#deptabbr').val(txt_dept);
            get_gugus_by(txt_dept)
        });
        // $('.gugus').change(function() {
        //     var that_val = $(this).val();
        //     var deptabbr = $('#deptabbr').val();
        //     get_list_mesin_by(deptabbr, that_val)
        // })
        $('.dept').change(function() {
            var that_val = $(this).val();
            var deptabbr = $('#deptabbr').val();
            get_list_mesin_by(deptabbr, that_val)
        })
        $(document).on('click', '#add_sch', function() {
            var headerid = $('#headerid').val();
            var tahun = $('#tahun').val();
            var dept = $('.dept').val();
            var kode_form = '<?= $frmkd ?>';

            $('#modal_headerid').val(headerid);
            $('#modal_kodeform').val(kode_form);

            var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            if (dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss054_03/get_add_sch/frmfss054/03",
                    data: {
                        headerid,
                        tahun,
                        dept,
                        kode_form
                    },
                    async: false,
                    dataType: "json",
                    success: function(data) {
                        let list_td = '';
                        if (data.status == 0) {
                            $('#myModalLabel').empty().append('Edit Month Schedule')
                            let no = 1;
                            let nocek = -1;
                            let detail_id = '';
                            list_td = `<tr>
                                            <td align="center" colspan="5"><i>Data belum tersedia!</i></td>
                                        </tr>`;
                            if (data.data) {
                                list_td = '';
                                $.each(data.data, function(key, list_dtl_row) {
                                    nocek++;
                                    if (typeof(list_dtl_row.children[0]) != "undefined") {
                                        detail_id = list_dtl_row.children[0].detail_id;
                                    } else {
                                        detail_id = '';
                                    }
                                    list_td += `<tr>
                                                        <input type="hidden" name="mdl1_detail_id[]" id="mdl1_detail_id" class="form-control mdl1_detail_id" style="text-align: center;" value="` + detail_id + `">
                                                        <input type="hidden" name="mdl1_detail_id_form[]" id="mdl1_detail_id_form" class="form-control mdl1_detail_id_form" style="text-align: center;" value="${list_dtl_row.detail_id}">
                                                        <td align="center" rowspan="1">${no++}</td>
                                                        <td align="center" rowspan="1"><input type="hidden" name="mdl1_point[]" id="mdl1_point" class="form-control w-auto mdl1_point" style="text-align: center;" value="${list_dtl_row.nama_mesin}">${list_dtl_row.nama_mesin}</td>
                                                        <td align="center" rowspan="1"><input type="hidden" name="mdl1_kode[]" id="mdl1_kode" class="form-control w-auto mdl1_kode" style="text-align: center;" value="${list_dtl_row.kode_mesin}">${list_dtl_row.kode_mesin}</td>
                                                        <td align="center" rowspan="1"><input type="hidden" name="mdl1_frequency[]" id="mdl1_frequency" class="form-control w-auto mdl1_frequency" style="text-align: center;" value="${list_dtl_row.frekuensi}">${list_dtl_row.frekuensi}</td>
                                                        <td align="center">
                                                            <select name="mdl1_tgl_schedule[${nocek}][]" class="mdl1_tgl_schedule form-control select2" multiple="multiple" data-placeholder="" style="width: 100%;">`;
                                    $.each(data.list_month, function(key_opt, list_dtl_opt) {
                                        list_td += `<option value="${list_dtl_opt.month}"`;
                                        if (typeof(list_dtl_row.children[0]) != "undefined") {
                                            if (list_dtl_row.children[0].tgl_schedule != null) {
                                                let arr_selected_tgl = list_dtl_row.children[0].tgl_schedule.split(',');
                                                $.each(arr_selected_tgl, function(ket_selected, list_opt_selected) {
                                                    if (list_opt_selected == list_dtl_opt.month) {
                                                        list_td += 'selected';
                                                    } else {
                                                        list_td += '';
                                                    }
                                                });
                                            }
                                        }
                                        list_td += `>${bulan[eval(list_dtl_opt.month)-1]}</option>`;
                                    });
                                    list_td += `</select>
                                                        </td>
                                                    </tr>`;
                                });
                            }
                            $('#tbody_modal').empty().append(list_td);
                            $('.mdl1_tgl_schedule').select2();
                            $('#MonthModal').modal();
                        } else {
                            notif_btnconfirm_custom('error', 'Gagal, Nama Mesin, Kode Mesin dan Frekuensi belum terisi..!')
                        }
                    }
                });
            }
        });

        $('#btnmodal_save').click(function(e) {
            var valbutton = $(this).attr("value");

            Swal.fire({
                title: 'Are You Sure ?',
                text: '',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/form_input/C_formfrmfss054_03/save_modal_schedule/frmfss054/03",
                        type: 'POST',
                        dataType: 'json',
                        data: $('#form_modal').find("select, textarea, input").serialize() + "&valbutton=" + valbutton,
                        success: function(data) {
                            $('#SelectDayModal').modal('hide');
                            if (data.vstatus == 'success') {
                                Swal.fire(
                                    data.pesan,
                                    '',
                                    'success'
                                ).then(function() {
                                    var baseurl = "<?php print base_url(); ?>";
                                    window.location.href = baseurl + 'index.php/form_input/C_formfrmfss054_03/form/frmfss054/03/dtopen/' + data.headerid;
                                });
                            }
                        },
                        error: function() {
                            alert("Fail")
                        }
                    });
                }
            });
            e.preventDefault(); // could also use: return false;
        });
    });

    function get_gugus_by(dept) {
        if (dept != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss054_03/get_gugus_by/frmfss054/03",
                data: {
                    dept
                },
                async: false,
                dataType: "json",
                success: function(data) {
                    var opt = '';
                    if (data.status == 0) {
                        $.each(data.data, function(key, dtl_val) {
                            opt += '<option value="' + dtl_val.detail_id + '">' + dtl_val.gugus + '</option>';
                        })
                        $('#gugus').find('option:not(:first)').remove();
                        $('#gugus').append(opt);
                    }
                }
            });
        }
    }

    function get_list_mesin_by(dept) {
        if (dept == 'WTD') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss054_03/get_list_mesin_by/frmfss054/03",
                data: {
                    dept
                },
                async: false,
                dataType: "json",
                success: function(data) {
                    if (data.status == 0) {
                        var list_dtl = '';
                        $.each(data.data, function(key, dtl_val) {
                            list_dtl += `<tr>
                                            <td align="center"><input type="checkbox" name="dtl_a_chk[]" id="dtl_a_chk" class="dtl_a_chk" value=""></td>
                                            <td align="center"><input type="text" name="dtl_a_nama_mesin[]" id="dtl_a_nama_mesin" class="dtl_a_nama_mesin form-control w-auto" readonly value="` + dtl_val.nama_mesin + `"/></td>
                                            <td align="center"><input type="text" name="dtl_a_kode_mesin[]" id="dtl_a_kode_mesin" class="dtl_a_kode_mesin form-control w-auto" readonly value="` + dtl_val.kode_mesin + `"/></td>
                                            <td align="center"><input type="text" name="dtl_a_frekuensi[]" id="dtl_a_frekuensi" class="dtl_a_frekuensi form-control w-auto" readonly value="6 Bulan"></td>
                                            <td align="center"><input type="text" name="dtl_a_gugus[]" id="dtl_a_gugus" class="dtl_a_gugus form-control w-auto" readonly value="` + dtl_val.gugus + `"></td>
                                            <?php if (isset($list_month)) {
                                                foreach ($list_month as $list_month_row) { ?>
                                                    <td align="centar"><input type="text" name="<?= 'month' . $list_month_row->month ?>[]" id="<?= 'month' . $list_month_row->month ?>" size="12" class="form-control w-auto datepicker_row maskdate <?= 'month' . $list_month_row->month ?>" value=""></td>
                                            <?php }
                                            } ?>
                                            <td align="center"><input type="text" name="dtl_a_ket[]" id="dtl_a_ket" class="dtl_a_ket form-control w-auto" size="28" value=""></td>
                                        </tr>`;
                        });

                        $('#tbody').empty().append(list_dtl);

                        $('.maskdate').mask("00-00-0000", {
                            placeholder: "dd-mm-yyyy"
                        });
                    }
                }
            });
        }
    }
</script>



<?php $this->load->view('template/footbarend'); ?>