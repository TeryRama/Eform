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
        $gugus          = $header->gugus;
        $id_gugus       = $header->id_gugus;
        $id_jns_mesin   = $header->id_jns_mesin;
        $jns_mesin      = $header->jns_mesin;
    }
} else if (isset($message)) {
    $aksi           = "dtsave";

    $create_date    = $dtcreate_date;
    $docno          = $dtdocno;
    $rev            = $dtrev;
    $dept           = $dtdept;
    $deptabbr       = $dtdeptabbr;
    $gugus          = $dtgugus;
    $id_gugus       = $dtid_gugus;
    $id_jns_mesin   = $dtid_jns_mesin;
    $jns_mesin      = $dtjns_mesin;
} else {
    $aksi           = "dtsave";
    $create_date    = date("d-m-Y", strtotime($dtcreate_date));
    $docno          = '';
    $rev            = '';
    $dept           = '';
    $deptabbr       = '';
    $gugus          = '';
    $id_gugus       = NULL;
    $id_jns_mesin   = NULL;
    $jns_mesin      = '';
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

                        <form action="<?= base_url('form_input/C_formfrmfss812_00/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss061" name="formfrmfss061" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                        <div class="col-md-6">
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
                                            Jenis Mesin
                                        </div>
                                        <div class="col-md-6">
                                            <select name="id_jns_mesin" id="id_jns_mesin" class="form-control id_jns_mesin select2 dtopen_blok2" required>
                                                <option value="">- Pilih -</option>
                                                <?php if(isset($dtjenis_mesin)){ 
                                                    foreach ($dtjenis_mesin as $dtjenis_mesin_row) { ?>
                                                    <option value="<?= $dtjenis_mesin_row->detail_id ?>" <?= $dtjenis_mesin_row->detail_id==$id_jns_mesin ? 'selected' : ''; ?>><?= $dtjenis_mesin_row->item1 ?></option>
                                                <?php } } ?>
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
                                                <?php if(isset($dtgugus)){ 
                                                    foreach ($dtgugus as $dtgugus_row) { ?>
                                                    <option value="<?= $dtgugus_row->detail_id ?>" <?= $dtgugus_row->detail_id==$id_gugus ? 'selected' : ''; ?>><?= $dtgugus_row->item2 ?></option>
                                                <?php } } ?>
                                            </select>
                                            <input type="hidden" name="gugus" id="gugus" value="<?= $gugus ?>">
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
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">Nama Mesin</th>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">Bagian
                                                            <hr> 
                                                            Code
                                                        </th>
                                                        <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="2">Frekuensi</th>
                                                        <?php if(isset($dtitem_mesin)){
                                                            foreach ($dtitem_mesin as $dtitem_mesin_row) {
                                                                $part_komponen = explode(",", $dtitem_mesin_row->part_komponen);
                                                            }
                                                            foreach ($dtkomponenmesin as $dtkomponenmesin_row) {
                                                                foreach ($part_komponen as $part_komponen_row) {
                                                                    if($dtkomponenmesin_row->komponen_id == $part_komponen_row){ ?>
                                                                        <th class="table-primary align-middle text-center" rowspan="2"><?= $dtkomponenmesin_row->nama_komponen ?></th>
                                                                <?php }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Jam operasi (jam)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Inspektur</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Keterangan</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Nama</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Paraf</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php 
                                                    if (isset($dtdetail)) {
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
                                                            } else if(!empty($dtdetail_row->pj_personalid)){
                                                                $pj_ttd = '<img src="' . base_url('assets/images/approved.png') . '" width="85" height="85" background-size:100%;" alt="">';
                                                            }else{
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
                                                                <?php for ($i_komponen=1; $i_komponen <= count($part_komponen); $i_komponen++) { ?>
                                                                    <td align="center">
                                                                        <?php if($dtdetail_row->{'komponen'.$i_komponen} == 'NA') { ?>
                                                                            <input type="hidden" name="<?= 'dtl_a_komponen'.$i_komponen ?>[]" id="<?= 'dtl_a_komponen'.$i_komponen ?>" class="<?= 'dtl_a_komponen'.$i_komponen ?> form-control w-auto" value="<?= $dtdetail_row->{'komponen'.$i_komponen} ?>">
                                                                            <?= $dtdetail_row->{'komponen'.$i_komponen} ?>
                                                                        <?php }else{ ?>
                                                                            <select name="<?= 'dtl_a_komponen'.$i_komponen ?>[]" id="<?= 'dtl_a_komponen'.$i_komponen ?>" class="<?= 'dtl_a_komponen'.$i_komponen ?> form-control w-auto">
                                                                                <option value=""></option>
                                                                                <option value="0" <?= $dtdetail_row->{'komponen'.$i_komponen} == '0' ? 'selected' : '' ?>>&#10004;</option>
                                                                                <option value="1" <?= $dtdetail_row->{'komponen'.$i_komponen} == '1' ? 'selected' : '' ?>>&#10006;</option>
                                                                                <option value="2" <?= $dtdetail_row->{'komponen'.$i_komponen} == '2' ? 'selected' : '' ?>>Δ</option>
                                                                            </select>
                                                                        <?php } ?>
                                                                    </td>
                                                                <?php } ?>
                                                                <td align="center"><input type="text" name="dtl_a_jam_operasi[]" id="dtl_a_jam_operasi" class="dtl_a_jam_operasi form-control w-auto" size="5" value="<?= $dtdetail_row->jam_operasi ?>"></td>
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
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss812_00/get_docno/frmfss812/00",
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

        function get_jenis_mesin_by(dept) {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            if (typeof(input_headerid) == "undefined" && dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss812_00/get_jenis_mesin_by/frmfss812/00",
                    data: {
                        dept,
                        create_date
                    },
                    async: false,
                    dataType : "json",
                    success: function(data) {
                        var opt = '';
                        if(data.status==0){
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
                    dataType : "json",
                    success: function(data) {
                        var opt = '';
                        var list_mesin = '';
                        if(data.status==0){
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
        function get_itemmesin(id_gugus) {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            var id_jns_mesin = $('.id_jns_mesin').val();
            var dept = $('#deptabbr').val();
            if (typeof(input_headerid) == "undefined" && dept != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss812_00/get_itemmesin/frmfss812/00",
                    data: {
                        dept,
                        create_date,
                        id_jns_mesin,
                        id_gugus
                    },
                    async: false,
                    dataType : "json",
                    success: function(result) {
                        var list_thead_mesin = '';
                        var list_mesin = '';
                        var status = '';
                        var val_operasi_akumulasi = 0;
                        if(result.status==0){
                            list_mesin = `<tr>
                                            <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                        </tr>`;
                            if(result.data.length){
                                list_mesin = '';
                                list_thead_mesin += `<tr>
                                                        <th class="table-primary align-middle text-center" rowspan="2">No.</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Nama Mesin</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Bagian
                                                            <hr> 
                                                            Code
                                                        </th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Frekuensi</th>`;
                                                        $.each(JSON.parse('<?= json_encode($dtkomponenmesin) ?>'), function(list_komponen_key, list_komponen_row){
                                                            $.each(result.data[0].part_komponen.split(','), function(list_partkomponen_key, list_partkomponen_row){
                                                                if(list_komponen_row.komponen_id==list_partkomponen_row){
                                                                    list_thead_mesin += `<th class="table-primary align-middle text-center" rowspan="2">`+list_komponen_row.nama_komponen+`</th>`;
                                                                }
                                                            });
                                                        });
                                    list_thead_mesin += `<th class="table-primary align-middle text-center" rowspan="2">Jam operasi (jam)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Inspektur</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Keterangan</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Nama</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">Paraf</th>
                                                    </tr>`;
                                $.each(result.data, function(dtl_mesin_key, dtl_val_mesin) {
                                    $.each(result.data_akumulasi, function (dtl_akumulasi_key, dtl_val_akumulasi) {
                                        if(dtl_val_akumulasi.nama_mesin == dtl_val_mesin.nama_mesin){
                                            val_operasi_akumulasi = dtl_val_akumulasi.akumulasi_operasi;
                                        }
                                    })
                                    list_mesin += `<tr>
                                                        <input type="hidden" name="dtl_a_nama_mesin[]" id="dtl_a_nama_mesin" class="dtl_a_nama_mesin form-control w-auto" size="15" value="`+ dtl_val_mesin.nama_mesin.trim() +`">
                                                        <input type="hidden" name="dtl_a_kode_mesin[]" id="dtl_a_kode_mesin" class="dtl_a_kode_mesin form-control w-auto" size="15" value="`+ dtl_val_mesin.kode_mesin.trim() +`">
                                                        <input type="hidden" name="dtl_a_frekuensi[]" id="dtl_a_frekuensi" class="dtl_a_frekuensi form-control w-auto" size="15" value="1 Hari 1x">
                                                        <td align="center">`+ eval(dtl_mesin_key+1) +`</td>
                                                        <td align="left">`+ dtl_val_mesin.nama_mesin +`</td>
                                                        <td align="center">`+ dtl_val_mesin.kode_mesin +`</td>
                                                        <td align="center">1 Hari 1x</td>`;
                                                        $.each(dtl_val_mesin.part_komponen.split(','), function(list_partkomponen_key, list_partkomponen_row){
                                                            if(dtl_val_mesin.part_komponen_na != null){
                                                                status = '';
                                                                $.each(dtl_val_mesin.part_komponen_na.split(','), function(list_partkomponen_na_key, list_partkomponen_na_row){
                                                                    if(list_partkomponen_row==list_partkomponen_na_row){
                                                                        status = 'NA';
                                                                    }
                                                                });
                                                                if(status == 'NA'){
                                                                    list_mesin += `<td align="center">
                                                                                        <input type="hidden" name="dtl_a_komponen`+eval(list_partkomponen_key+1)+`[]" id="dtl_a_komponen`+eval(list_partkomponen_key+1)+`" class="dtl_a_komponen`+eval(list_partkomponen_key+1)+` form-control w-auto" size="15" value="NA">
                                                                                        NA
                                                                                    </td>`;
                                                                }else{
                                                                    list_mesin += `<td align="center">
                                                                                        <select name="dtl_a_komponen`+eval(list_partkomponen_key+1)+`[]" id="dtl_a_komponen`+eval(list_partkomponen_key+1)+`" class="dtl_a_komponen`+eval(list_partkomponen_key+1)+` form-control w-auto">
                                                                                            <option value=""></option>
                                                                                            <option value="0" selected>&#10004;</option>
                                                                                            <option value="1">&#10006;</option>
                                                                                            <option value="2">Δ</option>
                                                                                        </select>
                                                                                    </td>`;
                                                                }
                                                            }else{
                                                                list_mesin += `<td align="center">
                                                                                    <select name="dtl_a_komponen`+eval(list_partkomponen_key+1)+`[]" id="dtl_a_komponen`+eval(list_partkomponen_key+1)+`" class="dtl_a_komponen`+eval(list_partkomponen_key+1)+` form-control w-auto">
                                                                                        <option value=""></option>
                                                                                        <option value="0" selected>&#10004;</option>
                                                                                        <option value="1">&#10006;</option>
                                                                                        <option value="2">Δ</option>
                                                                                    </select>
                                                                                </td>`;
                                                            }
                                                        });
                                    list_mesin += `<td align="center"><input type="text" name="dtl_a_jam_operasi[]" id="dtl_a_jam_operasi" class="dtl_a_jam_operasi form-control w-auto" size="5" value=""></td>
                                                    <td align="center">
                                                        <select name="dtl_a_pj_id[]" id="dtl_a_pj_id" class="form-control dtl_a_pj_id select2">
                                                            <option value="">- pilih -</option>`;
                                                            $.each(JSON.parse('<?= json_encode($list_pj) ?>'), function(list_pj_key, list_pj_row){
                                                                list_mesin += `<option value="`+ list_pj_row.detail_id+`" >`+ list_pj_row.nik +` - `+ list_pj_row.nama+`</option>`;
                                                            })
                                    list_mesin += `</select>
                                                </td>
                                                <td align="center"></td>
                                                <td align="center"><input type="text" name="dtl_a_ket[]" id="dtl_a_ket" class="dtl_a_ket form-control w-auto" size="20" value=""></td>
                                            </tr>`;
                                });
                            }
                            $('#thead').empty().append(list_thead_mesin);
                            $('#tbody').empty().append(list_mesin);
                            operasi_akumulasi();
                            $('.select2').select2();
                        }
                        notif_btnconfirm_custom(result.vstatus, result.pesan);
                    }
                });
            }
        }
        // operasi_akumulasi()
        $('.create_date').change(function() {
            get_docno();
        });
        $('.dept').change(function() {
            $('#deptabbr').val($(this).find('option:selected').text());
            get_jenis_mesin_by($(this).find('option:selected').text());
        });
        $('.id_jns_mesin').change(function() {
            $('#jns_mesin').val($(this).find('option:selected').text());
            get_gugus_by($(this).val());
        });
        $('.id_gugus').change(function() {
            $('#gugus').val($(this).find('option:selected').text());
            get_itemmesin($(this).val());
        });
    });
    
    $(window).on('load', function() {
        // operasi_akumulasi()
        // $('.dtl_a_jam_operasi').trigger('keyup');
    });
    function operasi_akumulasi() {
        $('.dtl_a_jam_operasi').keyup(function() {
            let that = $(this);
            let that_val = that.val();

            var id = $(this).attr('id');
            var id_akm = that.closest('tr').find('.dtl_a_akumulasi').attr('id');

            let dtl_a_akumulatif_awal = that.closest('tr').find('.dtl_a_akumulasi_awal').val();
            
            let dtl_a_akumulatif = (parseFloat(that_val) + parseFloat(dtl_a_akumulatif_awal));
            that.closest('tr').find('.dtl_a_akumulasi').val(parseFloat(isNaN(dtl_a_akumulatif) ? dtl_a_akumulatif_awal : dtl_a_akumulatif).toFixed(1))
        });
    }
</script>



<?php $this->load->view('template/footbarend'); ?>