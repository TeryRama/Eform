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
        $dept           = $header->dept;
        $deptabbr       = $header->deptabbr;
        $tahun         = $header->tahun;
    }
} else if (isset($message)) {
    $aksi           = "dtsave";

    $create_date    = $dtcreate_date;
    $docno          = $dtdocno;
    $dept           = $dtdept;
    $deptabbr       = $dtdeptabbr;
    $tahun          = $dttahun;
} else {
    $aksi           = "dtsave";
    $create_date    = date("d-m-Y", strtotime($dtcreate_date));
    $docno          = '';
    $dept           = '';
    $deptabbr       = '';
    $tahun          = date("Y", strtotime($dttahun));
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

                        <form action="<?= base_url('form_input/C_form' . $frmkd . '_' . $frmvrs . '/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss188" name="formfrmfss188" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                                <input type="number" name="tahun" id="tahun" class="form-control tahun" value="<?= $tahun; ?>" required readonly>
                                            <?php } else { ?>
                                                <input type="number" name="tahun" id="tahun" class="form-control tahun datepicker_year maskyear" value="<?= $tahun; ?>" required>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Departemen
                                        </div>
                                        <div class="col-md-6">
                                            <select name="dept" id="dept" class="form-control dept dtopen_blok2 select2" required>
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
                                </div>
                            </div>

                            <!-- END HEADER -->

                            
                            <?php if (isset($dtheader)) { ?>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn bg-gradient-info" id="btn_select_day">
                                                <i class="feather icon-edit"></i> Week Schedule
                                            </button>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive" id="scrolling_table_1" style="max-height: 600px;">
                                            <table class="table table-striped table-bordered">
                                                <thead id="thead" style="position:sticky;top: 0; z-index: 1;">
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="2">No</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Nama</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Kode</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Frequency</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">PIC</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1">SCH</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="<?= isset($headerid) ? count($list_week) : '1'; ?>">Week</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Keterangan</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center">ACH</th>
                                                        <?php if(isset($list_week)){
                                                            foreach ($list_week as $list_week_row) { ?>
                                                                <th class="table-primary align-middle text-center"><?= $list_week_row->week ?></th>
                                                        <?php } } ?>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php if(isset($dtdetail)){ 
                                                        $no = 1;
                                                        foreach ($dtdetail as $dtdetail_row) { 
                                                            $vnama_point = $dtdetail_row->no_urut == 1 ? '<td align="center" rowspan="' . ($dtdetail_row->no_urut_desc*2) . '">'.$no++.'</td><td align="left" rowspan="' . ($dtdetail_row->no_urut_desc*2) . '">' . $dtdetail_row->v_point . '</td>' : ''; ?>
                                                            <tr>
                                                                <?= $vnama_point ?>
                                                                <td align="center" rowspan="2"><?= $dtdetail_row->v_kode ?></td>
                                                                <td align="center" rowspan="2"><?= $dtdetail_row->frequency ?></td>
                                                                <td align="center" rowspan="2"><?= $dtdetail_row->v_pic ?></td>
                                                                <td align="center">SCH</td>
                                                        
                                                                <?php if(isset($dtdetail_row->children)){
                                                                    foreach ($dtdetail_row->children as $child_row) { ?>
                                                                        <td align="center"
                                                                            <?php if(isset($child_row->children3)){
                                                                                foreach ($child_row->children3 as $child3_row) {
                                                                                    if($child3_row->tgl_schedule != NULL){
                                                                                        $tgl_schedule = explode(',',$child3_row->tgl_schedule);
                                                                                        foreach ($tgl_schedule as $tgl_schedule_row) {
                                                                                            if($tgl_schedule_row == $child_row->week){
                                                                                                echo 'class="bg-gradient-info"';
                                                                                            }else{
                                                                                                echo "";
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                } 
                                                                            } ?>
                                                                        ></td>
                                                                <?php }
                                                                } ?>
                                                                <td align="center"><?= $dtdetail_row->ket ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">ACH</td>
                                                                <?php if(isset($dtdetail_row->children)){
                                                                    foreach ($dtdetail_row->children as $child_row) { ?>
                                                                        <td align="center">
                                                                            <?php if(isset($child_row->children2)){
                                                                                foreach ($child_row->children2 as $child2_row) {
                                                                                    if($child2_row->gagal_lulus == "Lulus"){
                                                                                        echo '&#10004;';
                                                                                    }else{
                                                                                        echo "";
                                                                                    }
                                                                                } 
                                                                            } ?>
                                                                        </td>
                                                                <?php }
                                                                } ?>
                                                            </tr>
                                                    <?php } } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" colspan="<?= isset($headerid) ? count($list_week)+7 : '8' ?>" align="center"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?php $this->load->view('laporan/V_laporan_definisi'); ?>
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
    <div class="modal fade bd-example-modal-lg" id="SelectDayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <form class="form-horizontal" role="form" action="" name="form_modal" id="form_modal" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add/Edit Week Schedule</h4>
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
                                                <th class="table-primary align-middle text-center" rowspan="1">PIC</th>
                                                <th class="table-primary align-middle text-center" rowspan="1">SCH</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" width="250px">Week</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_modal">
                                            <?php if(isset($result_list_item)){ 
                                                $no = 1;
                                                $nocek = -1;
                                                foreach ($result_list_item as $result_list_item_row) { $nocek++;
                                                    $vnama_point = $result_list_item_row->no_urut == 1 ? '<td align="center" rowspan="' . $result_list_item_row->no_urut_desc . '">'.$no++.'</td><td align="left" rowspan="' . $result_list_item_row->no_urut_desc . '">' . $result_list_item_row->v_point . '</td>' : ''; ?>

                                                    <tr>
                                                        <?= $vnama_point ?>
                                                        <td align="center" rowspan="1"><?= $result_list_item_row->v_kode ?></td>
                                                        <td align="center" rowspan="1"><?= $result_list_item_row->frequency ?></td>
                                                        <td align="center" rowspan="1"><?= $result_list_item_row->v_pic ?></td>
                                                        <td align="center">SCH</td>
                                                        <td align="center">
                                                            <input type="hidden" name="mdl1_point[]" id="mdl1_point" class="form-control mdl1_point" style="text-align: center;" value="<?= $result_list_item_row->point ?>">
                                                            <input type="hidden" name="mdl1_kode[]" id="mdl1_kode" class="form-control mdl1_kode" style="text-align: center;" value="<?= $result_list_item_row->kode ?>">
                                                            <input type="hidden" name="mdl1_frequency[]" id="mdl1_frequency" class="form-control mdl1_frequency" style="text-align: center;" value="<?= $result_list_item_row->frequency ?>">
                                                            <input type="hidden" name="mdl1_pic[]" id="mdl1_pic" class="form-control mdl1_pic" style="text-align: center;" value="<?= $result_list_item_row->pic ?>">
                                                            <select name="mdl1_tgl_schedule[<?= $nocek; ?>][]" class="mdl1_tgl_schedule form-control select2" multiple="multiple" data-placeholder="" style="width: 100%;">
                                                                <option value=""></option>
                                                                <?php foreach ($list_week as $list_week_row) { ?>
                                                                    <option value="<?= $list_week_row->week ?>"><?= $list_week_row->week ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                            <?php } } ?>
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
    $(window).on('load', function() {
        // $('.dtl_a_kode').trigger('change');
        $('#dept').trigger('change');
    });
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
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss187_00/get_docno/frmfss187/00",
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
            let that_val = $(this).find('option:selected').text();
            console.log(that_val)
            $('#deptabbr').val(that_val)
        });
        
        // ================================================================================================= //
        // ===================================INPUT SCHEDULE================================================ //
        // ================================================================================================= //
        $('#btn_select_day').click(function() {
            
            var input_headerid    = $('#headerid').val();
            var create_date       = $('#create_date').val();
            var tahun             = $('#tahun').val();
            var frmkd             = '<?= $frmkd ?>';

            $('#modal_headerid').val(input_headerid)
            $('#modal_kodeform').val(frmkd)
            if(typeof(input_headerid) != "undefined" && tahun != ''){
                // $('#tbody_modal').empty();

                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss187_00/get_list_item/frmfss187/00",
                    data: {
                        headerid_form : input_headerid,
                        kode_form : frmkd,
                        tahun : tahun,
                    },
                    dataType: "json",
                    async: false,
                    success: function(result) {
                        let list_td = ``;
                        if (result.status == 0) {                                
                            if(result.data.length){
                                let no = 1;
                                let nocek = -1;
                                $.each(result.data, function(key, list_dtl_row) { nocek++;
                                    let vnama_point = list_dtl_row.no_urut == 1 ? `<td align="center" rowspan="` + list_dtl_row.no_urut_desc + `">${no++}</td><td align="left" rowspan="` + list_dtl_row.no_urut_desc + `">` + list_dtl_row.v_nama + `</td>` : ``;
                                    list_td += `<tr>
                                                    <input type="hidden" name="mdl1_detail_id[]" id="mdl1_detail_id" class="form-control mdl1_detail_id" style="text-align: center;" value="${list_dtl_row.detail_id}">
                                                    `+ vnama_point +`
                                                    <td align="center" rowspan="1">${list_dtl_row.v_kode}</td>
                                                    <td align="center" rowspan="1">${list_dtl_row.frequency}</td>
                                                    <td align="center" rowspan="1">${list_dtl_row.v_pic}</td>
                                                    <td align="center">SCH</td>
                                                    <td align="center">
                                                        <input type="hidden" name="mdl1_point[]" id="mdl1_point" class="form-control mdl1_point" style="text-align: center;" value="${list_dtl_row.nama}">
                                                        <input type="hidden" name="mdl1_kode[]" id="mdl1_kode" class="form-control mdl1_kode" style="text-align: center;" value="${list_dtl_row.kode}">
                                                        <input type="hidden" name="mdl1_frequency[]" id="mdl1_frequency" class="form-control mdl1_frequency" style="text-align: center;" value="${list_dtl_row.frequency}">
                                                        <input type="hidden" name="mdl1_pic[]" id="mdl1_pic" class="form-control mdl1_pic" style="text-align: center;" value="${list_dtl_row.pic}">
                                                        <select name="mdl1_tgl_schedule[${nocek}][]" class="mdl1_tgl_schedule form-control select2" multiple="multiple" data-placeholder="" style="width: 100%;">`;
                                                        $.each(result.list_week, function(key_opt, list_dtl_opt) {
                                                            list_td += `<option value="${list_dtl_opt.week}"`;
                                                            if(list_dtl_row.tgl_schedule != null){
                                                                let arr_selected_tgl = list_dtl_row.tgl_schedule.split(',');
                                                                $.each(arr_selected_tgl, function(ket_selected, list_opt_selected) {
                                                                    if(list_opt_selected == list_dtl_opt.week){
                                                                        list_td += 'selected';
                                                                    }else{
                                                                        list_td += '';
                                                                    }
                                                                });
                                                            }
                                                            list_td += `>${list_dtl_opt.week}</option>`;
                                                        });
                                            list_td += `</select>
                                                    </td>
                                                </tr>`;
                                });
                                $('#tbody_modal').empty().append(list_td);
                                $('.mdl1_tgl_schedule').select2();
                            }
                        }
                    }
                });
                $('#SelectDayModal').modal()
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
                        url: "<?php echo base_url(); ?>index.php/form_input/C_formfrmfss187_00/save_modal_schedule/frmfss187/00",
                        type: 'POST',
                        dataType: 'json',
                        data: $('#form_modal').find("select, textarea, input").serialize() + "&valbutton=" + valbutton,
                        success: function(data) {
                            $('#SelectDayModal').modal('hide');
                            if(data.vstatus == 'success'){
                                Swal.fire(
                                    data.pesan,
                                    '',
                                    'success'
                                ).then(function() {
                                    var baseurl = "<?php print base_url(); ?>";
                                    window.location.href = baseurl + 'index.php/form_input/C_formfrmfss187_00/form/frmfss187/00/dtopen/' + data.headerid;
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
</script>



<?php $this->load->view('template/footbarend'); ?>