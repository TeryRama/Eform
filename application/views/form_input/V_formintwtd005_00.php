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
        $kode           = $header->kode;
        $kode_name      = $header->kode_name;
        $bulan          = $header->bulan;
    }
} else if (isset($message)) {
    $aksi           = "dtsave";

    $create_date    = $dtcreate_date;
    $docno          = $dtdocno;
    $kode           = $dtkode;
    $kode_name      = $dtkode_name;
    $bulan          = $dtbulan;
} else {
    $aksi           = "dtsave";
    $create_date    = date("d-m-Y", strtotime($dtcreate_date));
    $tgl            = date("d-m-Y");
    $docno          = '';
    $kode           = '';
    $kode_name      = '';
    $bulan          = $dtbulan;
} 
$base_url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$fcpath2   = str_replace('utl/', '', FCPATH);
$style_ttd = 'style="width:130px; height:80px; background-size:100%;"';?>

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

                        <form action="<?= base_url('form_input/C_formintwtd005_00/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formintwtd024" name="formintwtd024" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                            Kode
                                        </div>
                                        <div class="col-md-6">
                                            <select name="kode" id="kode" class="form-control kode dtopen_blok2 select2" required>
                                                <option value="">- Pilih -</option>
                                                <?php foreach ($dthand_pallet as $dthand_pallet_row) { ?>
                                                    <option value="<?= $dthand_pallet_row->item3 ?>" <?= $dthand_pallet_row->item3 == $kode ? "selected" : ""; ?>><?= $dthand_pallet_row->kode_mesin ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" name="kode_name" class="kode_name" value="<?= $kode_name ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Bulan
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($dtheader)) { ?>
                                                <input type="text" name="bulan" id="bulan" class="form-control bulan" value="<?= $bulan; ?>" required readonly>
                                            <?php } else { ?>
                                                <input type="text" name="bulan" id="bulan" class="form-control datepicker_month maskmonth bulan" value="<?= $bulan; ?>" required>
                                            <?php } ?>
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
                                                <thead id="thead" style="position:sticky;top: 0; z-index: 1;">
                                                    <tr>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">No</th>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">Nama / Bagian</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="<?= isset($headerid) ? count($date_calender) : '1'; ?>">Tanggal</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Keterangan</th>
                                                    </tr>
                                                    <tr>
                                                        <?php if(isset($date_calender)){
                                                            foreach ($date_calender as $date_calender_row) { ?>
                                                                <th class="table-primary align-middle text-center"><button type="button" class="btn bg-gradient-info btn_day" value="<?= $date_calender_row->day ?>"><?= $date_calender_row->day ?></button></th>
                                                        <?php } }else{ ?>
                                                                <th class="table-primary align-middle text-center"></th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php if(isset($dtdetail)){ 
                                                        $no = 1;
                                                        foreach ($dtdetail as $dtdetail_row) { 
                                                            if($dtdetail_row->nama_bagian == 'Nama Petugas'){ ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_a_detail_id[]" class="dtl_a_detail_id" value="<?= $dtdetail_row->detail_id; ?>">
                                                                <td class="fixed freeze_horizontal" style="background-color:white;z-index:0;" align="center"><?= $no++; ?></td>
                                                                <td class="fixed freeze_horizontal" style="background-color:white;z-index:0;" align="center">
                                                                    <input type="hidden" name="dtl_a_nama_bagian[]" class="dtl_a_nama_bagian form-control" value="<?= $dtdetail_row->nama_bagian ?>" style="width: 150px;"/><?= $dtdetail_row->nama_bagian ?>
                                                                </td>
                                                            <?php if(isset($date_calender)){
                                                                $no2 = 0;
                                                                foreach ($date_calender as $date_calender_row) { $no2++; ?>
                                                                    <td align="center"><input type="text" name="dtl_a_day<?= $no2; ?>[]" class="dtl_a_day<?= $no2; ?> form-control" style="width: 100px;" value="<?= $dtdetail_row->{'day'.$no2} ?>"></td>
                                                            <?php } } ?>
                                                                <td align="center"><input type="text" name="dtl_a_ket[]" class="dtl_a_ket form-control" value="<?= $dtdetail_row->ket ?>" style="width: 150px;"/></td>
                                                            </tr>
                                                        <?php }else{ ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_a_detail_id[]" class="dtl_a_detail_id" value="<?= $dtdetail_row->detail_id; ?>">
                                                                <td class="fixed freeze_horizontal" style="background-color:white;z-index:0;" align="center"><?= $no++; ?></td>
                                                                <td class="fixed freeze_horizontal" style="background-color:white;z-index:0;" align="center">
                                                                    <input type="hidden" name="dtl_a_nama_bagian[]" class="dtl_a_nama_bagian form-control" value="<?= $dtdetail_row->nama_bagian ?>" style="width: 150px;"/><?= $dtdetail_row->nama_bagian ?>
                                                                </td>
                                                            <?php if(isset($date_calender)){
                                                                $no2 = 0;
                                                                foreach ($date_calender as $date_calender_row) { $no2++; ?>
                                                                    <td align="center">
                                                                        <select name="dtl_a_day<?= $no2; ?>[]" class="dtl_a_day<?= $no2; ?> form-control" style="width: 100px;">
                                                                            <option value="">- Pilih -</option>
                                                                            <option value="0" <?= $dtdetail_row->{'day'.$no2} == '0' ? "selected" : ""; ?>>✔</option>
                                                                            <option value="1" <?= $dtdetail_row->{'day'.$no2} == '1' ? "selected" : ""; ?>>✖</option>
                                                                            <option value="2" <?= $dtdetail_row->{'day'.$no2} == '2' ? "selected" : ""; ?>>Δ</option>
                                                                            <option value="3" <?= $dtdetail_row->{'day'.$no2} == '3' ? "selected" : ""; ?>>NA</option>
                                                                        </select>
                                                                    </td>
                                                            <?php } } ?>
                                                                <td align="center"><input type="text" name="dtl_a_ket[]" class="dtl_a_ket form-control" value="<?= $dtdetail_row->ket ?>" style="width: 150px;"/></td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" colspan="38" align="center"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-12 mt-1">
                                            <?php $this->load->view('laporan/V_laporan_definisi'); ?>
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
                    url: "<?= base_url(); ?>index.php/form_input/C_formintwtd005_00/get_docno/intwtd005/00",
                    data: {
                        create_date
                    },
                    async: false,
                    success: function(data) {
                        $('.docno').val(JSON.parse(data)['data']);
                        var opt_pallet = '';
                        $.each(JSON.parse(data)['data_hand_pallet'], function(key, value) {
                            opt_pallet += '<option value="' + value.item3 + '">' + value.kode_mesin + '</option>';
                        });
                        $('.kode').find('option:not(:first)').remove();
                        $('.kode').append(opt_pallet);
                        $('.select2').select2();
                    }
                });
            }
        }
        function get_select_all() {
            $('.btn_day').click(function(){
                var days = $(this).val();
                Swal.fire({
                    title: 'Select All 1 Column',
                    input: 'select',
                    inputOptions: {
                        0: '✔',
                        1: '✖',
                        2: 'Δ',
                        3: 'NA'
                    },
                    inputPlaceholder: '- Pilih -',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        return new Promise((resolve) => {
                            if (value !== '') {
                                for (let index = 0; index < $('select[class~=dtl_a_day'+days+']').find("option").prevObject.length; index++) {
                                    $('select[class~=dtl_a_day'+days+']').find("option").prevObject[index].value = value;
                                }
                                resolve()
                            } else {
                                resolve('Data Kosong')
                            }
                        });
                    }
                });
            });
        }
        get_select_all()
        $('.create_date').change(function() {
            get_docno();
        });
        $('.kode').change(function() {
            var kode_pallet = $(this).val();
            var create_date = $('.create_date').val();
            var bulan = $('.bulan').val();
            $('.kode_name').val($(this).find(':selected').text());
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formintwtd005_00/get_list_item/intwtd005/00",
                data: {
                    kode_pallet,
                    create_date,
                    bulan
                },
                dataType: "json",
                async: false,
                success: function(result) {
                    var thead = `<tr>
                                    <th class="fixed freeze_horizontal scrolling_table_1 table-primary align-middle text-center" rowspan="2">No</th>
                                    <th class="fixed freeze_horizontal scrolling_table_1 table-primary align-middle text-center" rowspan="2">Nama / Bagian</th>
                                    <th class="table-primary align-middle text-center" rowspan="1" colspan="${result.dt_calender.length}">Tanggal</th>
                                    <th class="table-primary align-middle text-center" rowspan="2">Keterangan</th>
                                </tr>
                                <tr>`;
                                $.each(result.dt_calender, function (key_th_day, val_th_day) {
                                    thead += `<th class="table-primary align-middle text-center" rowspan="1"><button type="button" class="btn bg-gradient-info btn_day" value="${val_th_day.day}">${val_th_day.day}</button></th>`;
                                });
                    thead += `</tr>`;
                    var tbody = '';
                    $.each(JSON.parse('<?= json_encode($dtkomponenmesin) ?>'), function(key_komponen, val_komponen) {
                        $.each(result.data[0].part_komponen.split(','), function(key_part_komponen, val_part_komponen) {
                            if(val_part_komponen == val_komponen.komponen_id){
                                tbody += `<tr>
                                            <td class="fixed freeze_horizontal scrolling_table_1" style="background-color:white;z-index:0;" align="center">${eval(key_part_komponen+1)}</td>
                                            <td class="fixed freeze_horizontal scrolling_table_1" style="background-color:white;z-index:0;" align="center"><input type="hidden" name="dtl_a_nama_bagian[]" class="dtl_a_nama_bagian form-control" value="${val_komponen.nama_komponen}" style="width: 150px;"/>${val_komponen.nama_komponen}</td>`;
                                            $.each(result.dt_calender, function (key_day, val_day) {
                                                tbody += `<td align="center"><select name="dtl_a_day${val_day.day}[]" class="dtl_a_day${val_day.day} form-control" style="width: 100px;">
                                                                <option value="">- Pilih -</option>
                                                                <option value="0">✔</option>
                                                                <option value="1">✖</option>
                                                                <option value="2">Δ</option>
                                                                <option value="3">NA</option>
                                                            </select></td>`;
                                            });
                                tbody += `<td align="center"><input type="text" name="dtl_a_ket[]" class="dtl_a_ket form-control" value="" style="width: 150px;"/></td>
                                        </tr>`;
                            }
                        });
                    });
                    tbody += `<tr>
                                <td class="fixed freeze_horizontal scrolling_table_1" style="background-color:white;z-index:0;" align="center"></td>
                                <td class="fixed freeze_horizontal scrolling_table_1" style="background-color:white;z-index:0;" align="center"><input type="hidden" name="dtl_a_nama_bagian[]" class="dtl_a_nama_bagian form-control" value="Nama Petugas" style="width: 150px;"/>Nama Petugas</td>`;
                                $.each(result.dt_calender, function (key_day, val_day) {
                                    tbody += `<td align="center"><input type="text" name="dtl_a_day${val_day.day}[]" class="dtl_a_day${val_day.day} form-control" style="width: 100px;"/></td>`;
                                });
                    tbody += `<td align="center"><input type="text" name="dtl_a_ket[]" class="dtl_a_ket form-control" value="" style="width: 150px;"/></td>
                            </tr>`;
                    $('#thead').empty().append(thead);
                    $('#tbody').empty().append(tbody);
                    get_select_all()
                }
            });
        });
    });
</script>



<?php $this->load->view('template/footbarend'); ?>