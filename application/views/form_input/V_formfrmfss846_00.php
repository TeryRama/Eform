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
        $headerid      = $header->headerid;

        $comment       = $header->comment;
        $comment_by    = $header->comment_by;
        $comment_time  = $header->comment_time;
        $comment_date  = date("d-m-Y", strtotime($header->comment_date));

        $create_date   = date("d-m-Y", strtotime($header->create_date));
        $docno         = $header->docno;
        $rev           = $header->rev;
        $dept          = $header->dept;
        $deptabbr      = $header->deptabbr;
        $kode_panel    = $header->kode_panel;
        $id_kode_panel = $header->id_kode_panel;
        $nama_panel    = $header->nama_panel;
        $id_nama_panel = $header->id_nama_panel;
        $lokasi_panel  = $header->lokasi_panel;
    }
} else if (isset($message)) {
    $aksi           = "dtsave";

    $create_date    = $dtcreate_date;
    $docno          = $dtdocno;
    $rev            = $dtrev;
    $dept           = $dtdept;
    $deptabbr       = $dtdeptabbr;
    $kode_panel     = $dtkode_panel;
    $id_kode_panel  = $dtid_kode_panel;
    $nama_panel     = $dtnama_panel;
    $id_nama_panel  = $dtid_nama_panel;
    $lokasi_panel   = $dtlokasi_panel;
} else {
    $aksi           = "dtsave";
    $create_date    = date("d-m-Y", strtotime($dtcreate_date));
    $docno          = '';
    $rev            = '';
    $dept           = '';
    $deptabbr       = '';
    $kode_panel     = '';
    $id_kode_panel  = NULL;
    $nama_panel     = '';
    $id_nama_panel  = NULL;
    $lokasi_panel   = '';
}
$base_url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$fcpath2   = str_replace('utl/', '', FCPATH);
$style_ttd = 'style="width:130px; height:80px; background-size:100%;"';
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

                        <form action="<?= base_url('form_input/C_formfrmfss846_00/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss061" name="formfrmfss061" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                            <input type="text" name="rev" id="rev" class="form-control rev dtopen_blok angkadantitik" value="<?= $rev; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Departemen
                                        </div>
                                        <div class="col-md-8">
                                            <select name="dept" id="dept" class="form-control dept select2 dtopen_blok2" required>
                                                <option value="">- Pilih -</option>
                                                    <?php if (isset($dtdept)) {
                                                    foreach ($dtdept as $dtdepartemen_row) { ?>
                                                        <option value="<?php echo $dtdepartemen_row->deptid; ?>" <?php if ($dtdepartemen_row->deptid == $dept) { echo 'selected'; } ?>><?php echo $dtdepartemen_row->deptabbr; ?></option>
                                                    <?php
                                                    }
                                                } ?>
                                            </select>
                                            <input type="hidden" name="deptabbr" id="deptabbr" value="<?= $deptabbr ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Nama Panel / Kode Panel
                                        </div>
                                        <div class="col-md-5">
                                            <select name="id_nama_panel" id="id_nama_panel" class="form-control id_nama_panel select2 dtopen_blok2" required>
                                                <option value="">- Pilih Nama Panel -</option>
                                                <?php if(isset($dtjenis_mesin)){ 
                                                    foreach ($dtjenis_mesin as $dtjenis_mesin_row) { ?>
                                                    <option value="<?= $dtjenis_mesin_row->detail_id ?>" <?= $dtjenis_mesin_row->detail_id==$id_nama_panel ? 'selected' : ''; ?>><?= $dtjenis_mesin_row->nama_mesin ?></option>
                                                <?php } } ?>
                                            </select>
                                            <input type="hidden" name="nama_panel" id="nama_panel" value="<?= $nama_panel ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <select name="id_kode_panel" id="id_kode_panel" class="form-control id_kode_panel select2 dtopen_blok2" required>
                                                <option value="">- Pilih Kode Panel -</option>
                                                <?php if(isset($dtkode)){ 
                                                    foreach ($dtkode as $dtkode_row) { ?>
                                                    <option value="<?= $dtkode_row->detail_id ?>" <?= $dtkode_row->detail_id==$id_kode_panel ? 'selected' : ''; ?>><?= $dtkode_row->kode_mesin ?></option>
                                                <?php } } ?>
                                            </select>
                                            <input type="hidden" name="kode_panel" id="kode_panel" value="<?= $kode_panel ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Lokasi Panel
                                        </div>
                                        <div class="col-md-8">
                                            <select name="lokasi_panel" id="lokasi_panel" class="form-control lokasi_panel select2 dtopen_blok2" required>
                                                <option value="">- Pilih -</option>
                                                <?php if(isset($dtlokasi)){ 
                                                    foreach ($dtlokasi as $dtlokasi_row) { ?>
                                                    <option value="<?= $dtlokasi_row->lokasi_panel ?>" <?= $dtlokasi_row->lokasi_panel==$lokasi_panel ? 'selected' : ''; ?>><?= $dtlokasi_row->lokasi_panel ?></option>
                                                <?php } } ?>
                                            </select>
                                            <!-- <input type="text" name="lokasi_panel" id="lokasi_panel" class="form-control" value="<?= $lokasi_panel ?>"> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- END HEADER -->
                            <!--</?php if (isset($dtheader)) { ?>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn bg-gradient-info" id="btn_select_komponen">
                                                <i class="feather icon-edit"></i> Komponen Panel
                                            </button>
                                    </div>
                                </div>
                            </?php } ?>-->
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive" id="scrolling_table_1" style="max-height: 800px;">
                                            <table class="table table-striped table-bordered">
                                                <thead id="thead" style="position:sticky;top: 0; z-index: 1;">
                                                    <tr>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="6">No.</th>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" colspan="2">Waktu</th>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" colspan="<?= isset($dtitem_mesin) ? count($dtitem_mesin)*2+2 : '2' ?>">Temperatur ( °C ) dan Arus ( A ) Aktual</th>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" colspan="4">Kondisi</th>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" colspan="1" rowspan="5">Keterangan</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">Tanggal</th>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">Jam</th>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" colspan="2" rowspan="1">Kabel Induk</th>
                                                        <?php if(isset($dtitem_mesin)){
                                                            foreach ($dtitem_mesin as $dtitem_mesinrow) { ?>
                                                            <th class="fixed freeze_horizontal table-primary align-middle text-center" colspan="2" rowspan="1"><?= $dtitem_mesinrow->nama_komponen ?></th>
                                                        <?php } } ?>
                                                        <th class="table-primary align-middle text-center" rowspan="5">Busbar</th>
                                                        <th class="table-primary align-middle text-center" rowspan="5">Ampere Meter</th>
                                                        <th class="table-primary align-middle text-center" rowspan="5">Volt Meter</th>
                                                        <th class="table-primary align-middle text-center" rowspan="5">Kebersihan</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="1">A</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">°C</th>
                                                        <?php if(isset($dtitem_mesin)){
                                                            foreach ($dtitem_mesin as $dtitem_mesinrow) { ?>
                                                            <th class="table-primary align-middle text-center" rowspan="1">A</th>
                                                            <th class="table-primary align-middle text-center" rowspan="1">°C</th>
                                                        <?php } } ?>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php 
                                                    if (isset($dtdetail)) {
                                                        $no = 1;                                                        
                                                        foreach ($dtdetail as $dtdetail_row) { ?>
                                                            <tr>
                                                                <input type="hidden" name="detail_id[]" id="detail_id" class="form-control detail_id" value="<?= $dtdetail_row->detail_id ?>">
                                                                <td align="center"><?= $no++; ?></td>
                                                                <td align="center"><input type="text" name="dtl_a_waktu_tanggal[]" class="dtl_a_waktu_tanggal form-control" size="15" style="text-align: center;" value="<?= date("d-m-Y", strtotime($dtdetail_row->waktu_tanggal)); ?>" readonly ></td>
                                                                <td align="center"><input type="text" name="dtl_a_waktu_jam[]" class="dtl_a_waktu_jam form-control masktime" size="5" style="text-align: center;" value="<?= $dtdetail_row->waktu_jam; ?>"/></td>
                                                                <td align="center"><input type="text" name="dtl_a_kabel_induk_a[]" class="dtl_a_kabel_induk_a form-control" value="<?= $dtdetail_row->kabel_induk_a ?>" size="5"/></td>
                                                                <td align="center"><input type="text" name="dtl_a_kabel_induk_c[]" class="dtl_a_kabel_induk_c form-control" value="<?= $dtdetail_row->kabel_induk_c ?>" size="5"/></td>
                                                                <?php if(isset($dtitem_mesin)){
                                                                    foreach ($dtitem_mesin as $dtitem_mesin_key => $dtitem_mesinrow) { ?>
                                                                        <td align="center"><input type="text" name="<?= 'dtl_a_kabel_induk_a'.($dtitem_mesin_key+1) ?>[]" class="<?= 'dtl_a_kabel_induk_a'.($dtitem_mesin_key+1) ?> form-control" value="<?= $dtdetail_row->{'kabel_induk_a'.($dtitem_mesin_key+1)} ?>" size="5"/></td>
                                                                        <td align="center"><input type="text" name="<?= 'dtl_a_kabel_induk_c'.($dtitem_mesin_key+1) ?>[]" class="<?= 'dtl_a_kabel_induk_c'.($dtitem_mesin_key+1) ?> form-control" value="<?= $dtdetail_row->{'kabel_induk_c'.($dtitem_mesin_key+1)} ?>" size="5"/></td>
                                                                <?php } } ?>
                                                                <td align="center">
                                                                    <select name="dtl_a_busbar[]" class="dtl_a_busbar form-control" style="width: 105px;">
                                                                        <option value="">-Pilih-</option>
                                                                        <option value="0" <?= $dtdetail_row->busbar == '0' ? "selected" : ""; ?>>&#10004;</option>
                                                                        <option value="1" <?= $dtdetail_row->busbar == '1' ? "selected" : ""; ?>>&#10006;</option>
                                                                        <option value="2" <?= $dtdetail_row->busbar == '2' ? "selected" : ""; ?>>Δ</option>
                                                                        <option value="3" <?= $dtdetail_row->busbar == '3' ? "selected" : ""; ?>>NA</option>
                                                                    </select>
                                                                </td>
                                                                <td align="center">
                                                                    <select name="dtl_a_ampere_meter[]" class="dtl_a_ampere_meter form-control" style="width: 105px;">
                                                                        <option value="">-Pilih-</option>
                                                                        <option value="0" <?= $dtdetail_row->ampere_meter == '0' ? "selected" : ""; ?>>&#10004;</option>
                                                                        <option value="1" <?= $dtdetail_row->ampere_meter == '1' ? "selected" : ""; ?>>&#10006;</option>
                                                                        <option value="2" <?= $dtdetail_row->ampere_meter == '2' ? "selected" : ""; ?>>Δ</option>
                                                                        <option value="3" <?= $dtdetail_row->ampere_meter == '3' ? "selected" : ""; ?>>NA</option>
                                                                    </select>
                                                                </td>
                                                                <td align="center">
                                                                    <select name="dtl_a_volt_meter[]" class="dtl_a_volt_meter form-control" style="width: 105px;">
                                                                        <option value="">-Pilih-</option>
                                                                        <option value="0" <?= $dtdetail_row->volt_meter == '0' ? "selected" : ""; ?>>&#10004;</option>
                                                                        <option value="1" <?= $dtdetail_row->volt_meter == '1' ? "selected" : ""; ?>>&#10006;</option>
                                                                        <option value="2" <?= $dtdetail_row->volt_meter == '2' ? "selected" : ""; ?>>Δ</option>
                                                                        <option value="3" <?= $dtdetail_row->volt_meter == '3' ? "selected" : ""; ?>>NA</option>
                                                                    </select>
                                                                </td>
                                                                <td align="center">
                                                                    <select name="dtl_a_kebersihan[]" class="dtl_a_kebersihan form-control" style="width: 105px;">
                                                                        <option value="">-Pilih-</option>
                                                                        <option value="0" <?= $dtdetail_row->kebersihan == '0' ? "selected" : ""; ?>>&#10004;</option>
                                                                        <option value="1" <?= $dtdetail_row->kebersihan == '1' ? "selected" : ""; ?>>&#10006;</option>
                                                                        <option value="2" <?= $dtdetail_row->kebersihan == '2' ? "selected" : ""; ?>>Δ</option>
                                                                        <option value="3" <?= $dtdetail_row->kebersihan == '3' ? "selected" : ""; ?>>NA</option>
                                                                    </select>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_ket[]" class="dtl_a_ket form-control" value="" size="5"/></td>
                                                            </tr>
                                                    <?php } } ?>
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
        <!-- start modal select day -->
    <div class="modal fade bd-example-modal-xl" id="ModalKomponen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <form class="form-horizontal" role="form" action="" name="form_modal" id="form_modal" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        
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
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss846_00/get_docno/frmfss846/00",
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

        function get_jenis_mesin_by(dept, item) {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            if (typeof(input_headerid) == "undefined" && dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss846_00/get_jenis_mesin_by/frmfss846/00",
                    data: {
                        dept,
                        create_date,
                        item
                    },
                    async: false,
                    dataType : "json",
                    success: function(data) {
                        var opt = '';
                        var input_kode = '';
                        if(data.status==0){
                            $.each(data.data, function(key, dtl_val) {
                                opt += '<option value="' + dtl_val.detail_id + '">' + dtl_val.nama_mesin + '</option>';
                            })
                            $('.id_nama_panel').find('option:not(:first)').remove();
                            $('.id_nama_panel').append(opt);
                        }
                    }
                });
            }
        }
        function get_kode_by(id_nama_panel) {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            var dept = $('#dept').val();
            if (typeof(input_headerid) == "undefined" && dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss846_00/get_kode_by/frmfss846/00",
                    data: {
                        dept,
                        create_date,
                        id_nama_panel
                    },
                    async: false,
                    dataType : "json",
                    success: function(data) {
                        var opt = '';
                        var list_mesin = '';
                        if(data.status==0){
                            $.each(data.data, function(key, dtl_val) {
                                opt += '<option value="' + dtl_val.detail_id + '">' + dtl_val.kode_mesin + '</option>';
                            })
                            $('.id_kode_panel').find('option:not(:first)').remove();
                            $('.id_kode_panel').append(opt);
                        }
                    }
                });
            }
        }
        function get_lokasi_by(id_nama_panel) {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            var dept = $('#dept').val();
            if (typeof(input_headerid) == "undefined" && dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss846_00/get_lokasi_by/frmfss846/00",
                    data: {
                        dept,
                        create_date,
                        id_nama_panel
                    },
                    async: false,
                    dataType : "json",
                    success: function(data) {
                        var opt = '';
                        var list_mesin = '';
                        if(data.status==0){
                            $.each(data.data, function(key, dtl_val) {
                                opt += '<option value="' + dtl_val.lokasi_panel + '">' + dtl_val.lokasi_panel + '</option>';
                            })
                            $('.lokasi_panel').find('option:not(:first)').remove();
                            $('.lokasi_panel').append(opt);
                        }
                    }
                });
            }
        }
        function get_itemmesin(id_kode_panel) {
            var input_headerid    = $(".headerid").val();
            var create_date       = $('.create_date').val();
            var id_nama_panel     = $('.id_nama_panel').val();
            var kode_panel        = $('#kode_panel').val();
            var lokasi_panel      = $('.lokasi_panel').val();
            var dept              = $('.dept').val();
            if (typeof(input_headerid) == "undefined" && dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss846_00/get_itemmesin/frmfss846/00",
                    data: {
                        dept,
                        create_date,
                        id_nama_panel,
                        kode_panel,
                        lokasi_panel,
                    },
                    async: false,
                    dataType : "json",
                    success: function(result) {
                        var list_thead_mesin = '';
                        var list_thead_mesin2 = '';
                        var list_mesin = '';
                        var status = '';
                        var val_operasi_akumulasi = 0;
                        $.each(result.data, function(dtl_key, dtl_val) {
                            list_thead_mesin += `<th class="fixed freeze_horizontal table-primary align-middle text-center" colspan="2" rowspan="1">${dtl_val.nama_komponen}</th>`;
                            list_thead_mesin2 += `<th class="table-primary align-middle text-center" rowspan="1">A</th>
                                                    <th class="table-primary align-middle text-center" rowspan="1">°C</th>`;
                        });
                        $.each(result.data_date, function (dtl_date_key, dtl_date_val) {
                            list_mesin += `<tr>
                                                <td align="center">`+eval(dtl_date_key+1)+`</td>
                                                <td align="center"><input type="text" name="dtl_a_waktu_tanggal[]" class="dtl_a_waktu_tanggal form-control" size="15" value="${zeroPad(dtl_date_val.date, 2) + '-' + result.bulan + '-' +result.tahun}" readonly ></td>
                                                <td align="center"><input type="text" name="dtl_a_waktu_jam[]" class="dtl_a_waktu_jam form-control masktime" value="" size="5"/></td>
                                                <td align="center"><input type="text" name="dtl_a_kabel_induk_a[]" class="dtl_a_kabel_induk_a form-control" value="" size="5"/></td>
                                                <td align="center"><input type="text" name="dtl_a_kabel_induk_c[]" class="dtl_a_kabel_induk_c form-control" value="" size="5"/></td>`;
                                                $.each(result.data, function(dtl_key, dtl_val) {
                                                    list_mesin += `<td align="center"><input type="text" name="dtl_a_kabel_induk_a${dtl_key}[]" class="dtl_a_kabel_induk_a${dtl_key} form-control" value="" size="5"/></td>
                                                                    <td align="center"><input type="text" name="dtl_a_kabel_induk_c${dtl_key}[]" class="dtl_a_kabel_induk_c${dtl_key} form-control" value="" size="5"/></td>`;
                                                });
                                list_mesin += `<td align="center">
                                                    <select name="dtl_a_busbar[]" class="dtl_a_busbar form-control" style="width: 105px;">
                                                        <option value="">-Pilih-</option>
                                                        <option value="0">&#10004;</option>
                                                        <option value="1">&#10006;</option>
                                                        <option value="2">Δ</option>
                                                        <option value="3">NA</option>
                                                    </select>
                                                </td>
                                                <td align="center">
                                                    <select name="dtl_a_ampere_meter[]" class="dtl_a_ampere_meter form-control" style="width: 105px;">
                                                        <option value="">-Pilih-</option>
                                                        <option value="0">&#10004;</option>
                                                        <option value="1">&#10006;</option>
                                                        <option value="2">Δ</option>
                                                        <option value="3">NA</option>
                                                    </select>
                                                </td>
                                                <td align="center">
                                                    <select name="dtl_a_volt_meter[]" class="dtl_a_volt_meter form-control" style="width: 105px;">
                                                        <option value="">-Pilih-</option>
                                                        <option value="0">&#10004;</option>
                                                        <option value="1">&#10006;</option>
                                                        <option value="2">Δ</option>
                                                        <option value="3">NA</option>
                                                    </select>
                                                </td>
                                                <td align="center">
                                                    <select name="dtl_a_kebersihan[]" class="dtl_a_kebersihan form-control" style="width: 105px;">
                                                        <option value="">-Pilih-</option>
                                                        <option value="0">&#10004;</option>
                                                        <option value="1">&#10006;</option>
                                                        <option value="2">Δ</option>
                                                        <option value="3">NA</option>
                                                    </select>
                                                </td>
                                                <td align="center"><input type="text" name="dtl_a_ket[]" class="dtl_a_ket form-control" value="" size="5"/></td>
                                            </tr>`;
                        })
                        $('#thead').empty().append(`<tr>
                                                <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="6">No.</th>
                                                <th class="fixed freeze_horizontal table-primary align-middle text-center" colspan="2">Waktu</th>
                                                <th class="fixed freeze_horizontal table-primary align-middle text-center" colspan="${eval(result.data.length*2+2)}">Temperatur ( °C ) dan Arus ( A ) Aktual</th>
                                                <th class="fixed freeze_horizontal table-primary align-middle text-center" colspan="4">Kondisi</th>
                                                <th class="fixed freeze_horizontal table-primary align-middle text-center" colspan="1" rowspan="5">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">Tanggal</th>
                                                <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">Jam</th>
                                                <th class="fixed freeze_horizontal table-primary align-middle text-center" colspan="2" rowspan="1">Kabel Induk</th>
                                                ${list_thead_mesin}
                                                <th class="table-primary align-middle text-center" rowspan="5">Busbar</th>
                                                <th class="table-primary align-middle text-center" rowspan="5">Ampere Meter</th>
                                                <th class="table-primary align-middle text-center" rowspan="5">Volt Meter</th>
                                                <th class="table-primary align-middle text-center" rowspan="5">Kebersihan</th>
                                            </tr>
                                            <tr>
                                                <th class="table-primary align-middle text-center" rowspan="1">A</th>
                                                <th class="table-primary align-middle text-center" rowspan="1">°C</th>
                                                ${list_thead_mesin2}
                                            </tr>`);
                        $('#tbody').append(list_mesin);
                        $('.masktime').mask("00:00", {
                            placeholder: "__:__"
                        });
                        notif_btnconfirm_custom(result.vstatus, result.pesan);
                    }
                });
            }
        }
        $('.create_date').change(function() {
            get_docno();
        });
        $('.dept').change(function() {
            $('#deptabbr').val($(this).find('option:selected').text());
            var deptabbr_val = $('#deptabbr').val();
            get_jenis_mesin_by($(this).val());
        });
        $('.id_nama_panel').change(function() {
            $('#nama_panel').val($(this).find('option:selected').text());
            get_kode_by($(this).val());
        });
        $('.id_kode_panel').change(function() {
            $('#kode_panel').val($(this).find('option:selected').text());
            get_lokasi_by($('.id_nama_panel').val());
        });
        $('.lokasi_panel').change(function() {
            get_itemmesin($('.id_nama_panel').val());
        })
        $('#btn_select_komponen').click(function() {
            var headerid = $('#headerid').val();
            var create_date = $('#create_date').val();
            var id_nama_panel = $('#id_nama_panel').val();
            var kode_panel = $('#kode_panel').val();
            var dept = $('#dept').val();

            $.ajax({
                url : "<?= base_url() ?>index.php/form_input/C_formfrmfss846_00/get_detail_komponen/frmfss846/00",
                type : "POST",
                data : {
                    headerid,
                    create_date,
                    dept,
                    id_nama_panel,
                    kode_panel
                },
                dataType : "json",
                success : function (result) {
                    var tbody_dtl = '';
                    if(result.list_detail_b){
                        tbody_dtl = ``;
                    }else{
                        tbody_dtl += `<tr>
                                        <td align="center"><input type="checkbox" name="mdl_chk[]" value=""></td>
                                        <td align="center"><select name="mdl_nama_komponen[]" class="form-control mdl_nama_komponen select2" style="width:210px">
                                                <option value="">- Pilih -</option>`;
                                                $.each(result.list_komponen, function (dtl_komponen_key,dtl_komponen_val){
                                                    tbody_dtl += `<option value="${dtl_komponen_val.nama_komponen}">${dtl_komponen_val.nama_komponen}</option>`;
                                                });
                            tbody_dtl += `</select></td>
                                        <td align="center"><select name="mdl_kode_komponen[]" class="form-control mdl_kode_komponen" style="width:210px">
                                            <option value="">- Pilih -</option>
                                        </select></td>
                                        <td align="center"><input type="text" name="mdl_ampere_komponen[]" class="form-control mdl_ampere_komponen" value=""></td>
                                        <td align="center"><input type="text" name="mdl_ampere[]" class="form-control mdl_ampere" value=""></td>
                                        <td align="center"><input type="text" name="mdl_suhu[]" class="form-control mdl_suhu" value=""></td>
                                    </tr>`;
                    }
                    $('.select2').select2()
                    $('#ModalKomponen').modal();
                    $('.modal-title').empty().append(`Detail Komponen (${nama_panel+' - '+kode_panel})`)
                    $('.modal-body').empty().append(`<div class="row">
                                                        <div class="col-md-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover table-striped">
                                                                    <thead class="table-primary" id="th_thead">
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center" rowspan="2"></th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">Nama Komponen</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">Kode Komponen</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">Arus (Ampere)</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Temperatur ( °C ) dan Arus ( A ) Aktual</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center" rowspan="1">A</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="1">°C</th>
                                                                        </tr>
                                                                        
                                                                    </thead>
                                                                    <tbody id="tbody_modal">
                                                                    ${tbody_dtl}
                                                                    </tbody>
                                                                    <tfoot align="center" class="table-primary">
                                                                        <tr>
                                                                            <td colspan="6">
                                                                                <button type="button" class="btn bg-gradient-info btn-sm waves-effect waves-light" onClick="addRowselect2('tbody_modal')">Tambah Baris</button>
                                                                                <button type="button" class="btn bg-gradient-warning btn-sm waves-effect waves-light" onClick="deleteRow('tbody_modal')">Hapus Baris</button>
                                                                                <button type="button" name="btnmodal_save_c" id="btnmodal_delete_c" value="btnmodal_delete_c" class="btnmodal_save_c btn bg-gradient-danger btn-sm waves-effect waves-light" onclick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus Data</button>
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>`);
                }

            })
        });
    });
</script>



<?php $this->load->view('template/footbarend'); ?>