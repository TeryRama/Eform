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
        $kode_mesin     = $header->kode_mesin;
        $nama_mesin     = $header->nama_mesin;
        $dept           = $header->dept;
        $deptabbr       = $header->deptabbr;
        $bulan          = $header->bulan;
    }
} else if (isset($message)) {
    $aksi           = "dtsave";

    $create_date    = $dtcreate_date;
    $docno          = $dtdocno;
    $kode_mesin     = $dtkode_mesin;
    $nama_mesin     = $dtnama_mesin;
    $dept           = $dtdept;
    $deptabbr       = $dtdeptabbr;
    $bulan          = $dtbulan;
} else {
    $aksi           = "dtsave";
    $create_date    = date("d-m-Y", strtotime($dtcreate_date));
    $tgl            = date("d-m-Y");
    $docno          = '';
    $kode           = '';
    $kode_name      = '';
    $dept           = '';
    $deptabbr       = '';
    $kode_mesin     = '';
    $nama_mesin     = '';
    $bulan          = '';
}

$base_url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$fcpath2   = str_replace('utl/', '', FCPATH);
$style_ttd = 'style="width:130px; height:80px; background-size:100%;"'; ?>


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

                        <form action="<?= base_url('form_input/C_formintwtd009_00/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss061" name="formfrmfss061" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
                            <div class="row mb-1">
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
                                            Jenis Trafo Las
                                        </div>
                                        <div class="col-md-6">
                                            <select name="jenis_trafo" id="jenis_trafo" class="form-control jenis_trafo select2 dtopen_blok2" required>

                                                <option value="">- Pilih -</option>
                                                <?php if (isset($dtheader)) {
                                                    foreach ($dtheader as $header) { ?>
                                                        <option value="<?= $header->nama_mesin ?>" <?= $header->nama_mesin == $nama_mesin ? 'selected' : ''; ?>> <?= $header->nama_mesin ?></option>
                                                    <?php }
                                                } else { ?>
                                                    <option value="">- Pilih -</option>
                                                    <option value="SMAW">SMAW</option>
                                                    <option value="TIG">TIG</option>
                                                    <option value="380 V">380 V</option>
                                                    <option value="14 - 36  kW">14 - 36 kW</option>
                                                <?php  } ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Nama Mesin
                                        </div>
                                        <div class="col-md-6">
                                            <select name="id_nama_mesin" id="id_nama_mesin" class="form-control id_nama_mesin select2 dtopen_blok2" required>
                                                <option value="">- Pilih -</option>
                                                <?php if (isset($dtheader)) {
                                                    foreach ($dtheader as $header) { ?>
                                                        <option value="<?= $header->nama_mesin ?>" <?= $header->nama_mesin == $nama_mesin ? 'selected' : ''; ?>> <?= $header->nama_mesin ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                            <input type="hidden" name="nama_mesin" id="nama_mesin" value="<?= $nama_mesin ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Kode Mesin
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="kode_mesin" id="kode_mesin" class="form-control kode_mesin" value="<?= isset($kode_mesin) ? $kode_mesin : ''  ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Bulan
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="bulan" class="form-control bulan dtopen_blok" id="bulan" value="<?= isset($bulan) ? $bulan : ''  ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- END HEADER -->

                            <div class="card-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive" id="scrolling_table_1" style="max-height: 800px;">
                                            <table class="table table-striped table-bordered">
                                                <thead id="thead" style="position:sticky;top: 0; z-index: 1;">
                                                    <tr>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">No.</th>
                                                        <!-- <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">Tanggal Inspeksi</th> -->
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">Bagian
                                                            <hr>
                                                            Code
                                                        </th>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">Tanggal</th>

                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Inspektur</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Keterangan</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Nama</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Paraf</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php if (isset($dtdetail)) {
                                                        $no = 1;
                                                        foreach ($dtdetail as $dtdetail_row) {
                                                            if (file_exists($fcpath2 . 'utl/assets/ttd/' . $dtdetail_row->pj_personalstatus . '_' . $dtdetail_row->pj_personalid . '.png')) {
                                                                $pj_ttd = '<img src="' . $base_url2 . 'utl/assets/ttd/' . $dtdetail_row->pj_personalstatus . '_' . $dtdetail_row->pj_personalid . '.png" ' . $style_ttd . ' alt="">';
                                                            } else if (
                                                                $dtdetail_row->pj_personalstatus == '1' && file_exists($fcpath2 . 'forviewfoto_pekerja/' . $dtdetail_row->pj_personalid . '_0_0.png')
                                                            ) {
                                                                $pj_ttd = '<img src="' . $base_url2 . 'forviewfoto_pekerja/' . $dtdetail_row->pj_personalid . '_0_0.png" ' . $style_ttd . ' alt="">';
                                                            } else if (
                                                                $dtdetail_row->pj_personalstatus == '2' && file_exists($fcpath2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row->pj_personalid . '.png')
                                                            ) {
                                                                $pj_ttd = '<img src="' . $base_url2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row->pj_personalid . '.png" ' . $style_ttd . ' alt="">';
                                                            } else if (!empty($dtdetail_row->pj_personalid)) {
                                                                $pj_ttd = '<img src="' . base_url('assets/images/approved.png') . '" width="85" height="85" background-size:100%;" alt="">';
                                                            } else {
                                                                $pj_ttd = '';
                                                            } ?>
                                                            <tr>
                                                                <input type="hidden" name="detail_id[]" id="detail_id" class="form-control detail_id" value="<?= $dtdetail_row->detail_id ?>">
                                                                <input type="hidden" name="dtl_a_nama_mesin[]" id="dtl_a_nama_mesin" class="dtl_a_nama_mesin" value="<?= $dtdetail_row->nama_mesin ?>">
                                                                <input type="hidden" name="dtl_a_kode_mesin[]" id="dtl_a_kode_mesin" class="dtl_a_kode_mesin" value="<?= $dtdetail_row->kode_mesin ?>">
                                                                <input type="hidden" name="dtl_a_frekuensi[]" id="dtl_a_frekuensi" class="dtl_a_frekuensi" value="<?= $dtdetail_row->frekuensi ?>">

                                                                <td class="fixed freeze_horizontal" style="background-color:white;" align="center"><?= $no++ ?></td>
                                                                <td class="fixed freeze_horizontal" style="background-color:white;" align="left"><?= $dtdetail_row->nama_mesin ?></td>
                                                                <td class="fixed freeze_horizontal" style="background-color:white;" align="center"><?= $dtdetail_row->kode_mesin ?></td>
                                                                <td class="fixed freeze_horizontal" style="background-color:white;" align="center"><?= $dtdetail_row->frekuensi ?></td>
                                                                <?php for ($i_komponen = 1; $i_komponen <= count($dtkomponenmesin); $i_komponen++) { ?>
                                                                    <td align="center">
                                                                        <?php if ($dtdetail_row->{'komponen' . $i_komponen} == 'NA') { ?>
                                                                            <input type="hidden" name="<?= 'dtl_a_komponen' . $i_komponen ?>[]" id="<?= 'dtl_a_komponen' . $i_komponen ?>" class="<?= 'dtl_a_komponen' . $i_komponen ?> form-control w-auto" value="<?= $dtdetail_row->{'komponen' . $i_komponen} ?>">
                                                                            <?= $dtdetail_row->{'komponen' . $i_komponen} ?>
                                                                        <?php } else { ?>
                                                                            <select name="<?= 'dtl_a_komponen' . $i_komponen ?>[]" id="<?= 'dtl_a_komponen' . $i_komponen ?>" class="<?= 'dtl_a_komponen' . $i_komponen ?> form-control w-auto">
                                                                                <option value=""></option>
                                                                                <option value="0" <?= $dtdetail_row->{'komponen' . $i_komponen} == '0' ? 'selected' : '' ?>>&#10004;</option>
                                                                                <option value="1" <?= $dtdetail_row->{'komponen' . $i_komponen} == '1' ? 'selected' : '' ?>>&#10006;</option>
                                                                                <option value="2" <?= $dtdetail_row->{'komponen' . $i_komponen} == '2' ? 'selected' : '' ?>>Δ</option>
                                                                            </select>
                                                                        <?php } ?>
                                                                    </td>
                                                                <?php } ?>
                                                                <!--<td align="center"><input type="text" name="dtl_a_jam_operasi[]" id="dtl_a_jam_operasi" class="dtl_a_jam_operasi form-control w-auto" size="5" value="</?= $dtdetail_row->jam_operasi ?>"></td>-->
                                                                <td>
                                                                    <select name="dtl_a_pj_id[]" id="dtl_a_pj_id" class="dtl_a_pj_id form-control w-auto">
                                                                        <option value="">- pilih -</option>
                                                                        <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                            <option value="<?= $list_pj_row->detail_id ?>" <?= $list_pj_row->detail_id == $dtdetail_row->pj_id ? "selected" : "" ?>><?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td align="center"><?= $pj_ttd ?></td>
                                                                <td align="center"><input type="text" name="dtl_a_ket[]" id="dtl_a_ket" class="dtl_a_ket form-control w-auto" size="28" value="<?= $dtdetail_row->ket ?>"></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" colspan="24" align="center"></td>
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
            var dept = $('#deptabbr').val();
            if (typeof(input_headerid) == "undefined" && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formintwtd009_00/get_docno/intwtd009/00",
                    data: {
                        create_date,
                        dept
                    },
                    async: false,
                    success: function(data) {
                        $('.docno').val(JSON.parse(data)['data']);
                    }
                });
            }
        }



        function get_nama_mesin(dept) {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            if (typeof(input_headerid) == "undefined" && dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formintwtd009_00/get_nama_mesin/intwtd009/00",
                    data: {
                        dept,
                        create_date
                    },
                    async: false,
                    dataType: "json",
                    success: function(data) {
                        var opt = '';
                        if (data.status == 0) {
                            $.each(data.data, function(key, dtl_val) {
                                opt += '<option value="' + dtl_val.detail_id + '">' + dtl_val.nama_mesin + '</option>';
                            })
                            $('.id_nama_mesin').find('option:not(:first)').remove();
                            $('.id_nama_mesin').append(opt);
                        }
                    }
                });
            }
        }

        function get_select_all() {
            $('.btn_day').click(function() {
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
                                for (let index = 0; index < $('select[class~=dtl_a_day' + days + ']').find("option").prevObject.length; index++) {
                                    $('select[class~=dtl_a_day' + days + ']').find("option").prevObject[index].value = value;
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

        function get_data() {
            var monthMapping = {
                'Januari': '1',
                'Februari': '02',
                'Maret': '03',
                'April': '04',
                'Mai': '05',
                'Juni': '06',
                'Juli': '07',
                'Augustus': '08',
                'September': '09',
                'Oktober': '10',
                'November': '11',
                'Desember': '12'
            };
            var create_date = $('.create_date').val();
            var bulan = $('.bulan').val();
            var monthNumber = monthMapping[bulan];
            var kode_mesin = $('.kode_mesin').val();
            // $('.kode_name').val($(this).find(':selected').text());
            console.log(monthNumber);
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formintwtd009_00/get_list_item/intwtd009/00",
                data: {
                    kode_mesin,
                    create_date,
                    monthNumber
                },
                dataType: "json",
                async: false,
                success: function(result) {
                    var thead = `<tr>
                                    <th class="fixed freeze_horizontal scrolling_table_1 table-primary align-middle text-center" rowspan="2">No</th>
                                    <th class="fixed freeze_horizontal scrolling_table_1 table-primary align-middle text-center" rowspan="2" colspan="2" >Nama / Bagian</th>
                                    <th class="table-primary align-middle text-center" rowspan="1" colspan="${result.dt_calender.length}">Tanggal</th>
                                    <th class="table-primary align-middle text-center" rowspan="2">Keterangan</th>
                                </tr>
                                <tr>`;
                    $.each(result.dt_calender, function(key_th_day, val_th_day) {
                        thead += `<th class="table-primary align-middle text-center" rowspan="1"><button type="button" class="btn bg-gradient-info btn_day" value="${val_th_day.day}">${val_th_day.day}</button></th>`;
                    });
                    thead += `</tr>`;
                    var tbody = '';
                    var no = 1;
                    $.each(JSON.parse('<?= json_encode($dtkomponenmesin) ?>'), function(key_komponen, val_komponen) {
                        tbody += `<tr>`;
                        if (val_komponen.no_urut_asc == 1) {
                            tbody += ` <td class="fixed freeze_horizontal scrolling_table_1" style="background-color:white;z-index:0;" align="center" rowspan = "${val_komponen.no_urut_desc}">${no++}</td>
                                            <td class="fixed freeze_horizontal scrolling_table_1" style="background-color:white;z-index:0;" align="center" rowspan = "${val_komponen.no_urut_desc}"><input type="hidden" name="dtl_a_nama_bagian[]" class="dtl_a_nama_bagian form-control" value="${val_komponen.item1}" style="width: 150px;"/>${val_komponen.item1}</td>`;
                        }
                        tbody += `<td class="fixed freeze_horizontal scrolling_table_1" style="background-color:white;z-index:0;" align="center"><input type="hidden" name="dtl_a_nama_bagian[]" class="dtl_a_nama_bagian form-control" value="${val_komponen.item2}" style="width: 150px;"/>${val_komponen.item2}</td>`;

                        $.each(result.dt_calender, function(key_day, val_day) {
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
                    });
                    tbody += `<tr>
                                <td class="fixed freeze_horizontal scrolling_table_1" style="background-color:white;z-index:0;" align="center"></td>
                                <td class="fixed freeze_horizontal scrolling_table_1" style="background-color:white;z-index:0;" align="center"></td>
                                <td class="fixed freeze_horizontal scrolling_table_1" style="background-color:white;z-index:0;" align="center" ><input type="hidden" name="dtl_a_nama_bagian[]" class="dtl_a_nama_bagian form-control" value="Nama Petugas" style="width: 150px;" />Nama Petugas</td>`;
                    $.each(result.dt_calender, function(key_day, val_day) {
                        tbody += `<td align="center"><input type="text" name="dtl_a_day${val_day.day}[]" class="dtl_a_day${val_day.day} form-control" style="width: 100px;"/></td>`;
                    });
                    tbody += `<td align="center"><input type="text" name="dtl_a_ket[]" class="dtl_a_ket form-control" value="" style="width: 150px;"/></td>
                            </tr>`;
                    $('#thead').empty().append(thead);
                    $('#tbody').empty().append(tbody);
                    get_select_all()
                }
            });

        }

        function get_kode_mesin(nama_mesin) {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            var dept = $('#deptabbr').val();
            if (typeof(input_headerid) == "undefined" && dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formintwtd009_00/get_kode_mesin/intwtd009/00",
                    data: {
                        dept,
                        create_date,
                        nama_mesin,
                    },
                    async: false,
                    dataType: "json",
                    success: function(data) {
                        var textOutput = '';
                        if (data.status == 0) {
                            $.each(data.data, function(key, dtl_val) {
                                textOutput += dtl_val.kode_mesin;
                            })
                            $('.kode_mesin').val(textOutput);
                        }
                    }
                });
            }
        }


        $('.create_date').change(function() {
            get_docno();
            get_bulan();

        });
        $('.dept').change(function() {
            $('#deptabbr').val($(this).find('option:selected').text());
            get_nama_mesin($(this).find('option:selected').text());
        });
        $('.id_nama_mesin').change(function() {
            $('#nama_mesin').val($(this).find('option:selected').text());
            get_kode_mesin($(this).find('option:selected').text());
            get_data();
        });
        $('.id_gugus').change(function() {
            $('#gugus').val($(this).find('option:selected').text());
            get_itemmesin($(this).val());
        });

        function get_hari() {
            let date = new Date();
            var create_date = $('#create_date').val()
            let jumlahHari = getDaysInMonth(create_date)
            console.log(jumlahHari);

            let dataRow = '';
            for (let i = 1; i <= jumlahHari; i++) {
                dataRow += `<th  class="table-primary align-middle text-center" id="tabelHari">${i}</th>`;
            }

            $("#tabelHari").html(dataRow);
        }

        function get_bulan() {
            let date = new Date();
            var create_date = $('#create_date').val()
            let nama_bulan = getMonthName(create_date)
            console.log(nama_bulan);

            $("#bulan").val(nama_bulan);
        }


        function getDaysInMonth(dateString) {
            var parts = dateString.split("-");
            var month = parseInt(parts[1], 10); // Mengambil bagian bulan dari inputan
            var year = parseInt(parts[2], 10); // Mengambil bagian tahun dari inputan

            // Mengembalikan jumlah hari dari bulan dan tahun tersebut
            return new Date(year, month, 0).getDate();
        }

        function getMonthName(dateString) {
            var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

            var parts = dateString.split("-");
            var monthIndex = parseInt(parts[1], 10) - 1; // Mengambil bagian bulan dari inputan dan mengurangi 1 (karena indeks array dimulai dari 0)

            return months[monthIndex];
        }

    });
</script>



<?php $this->load->view('template/footbarend'); ?>