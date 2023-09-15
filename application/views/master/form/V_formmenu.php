<?php $this->load->view('template/headbar'); ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12 mb-1">
            <h4 class="text-uppercase"><?= $Titel ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">DATA FORM</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button type="button" class="btn bg-gradient-primary modal_forminput" name="btn_add" value=""><span class="feather icon-edit-1"> Tambah Form Baru</span></button>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                                <thead>
                                    <tr>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">No.</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Form ID</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Form Nama</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Form Kode</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Form Versi</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Form Efective </th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Form Judul (id)</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Form Judul (en)</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Form Ket</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Form Status</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Form Jenis</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Form Kategori</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Form Kategori 2</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Parameter Tanggal Efective</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Jumlah Approval</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Parameter Tanggal Approval</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Parameter Jenis Approval</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Status Input</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Status Data Harian</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Status Laporan</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Status Approval</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Create Info</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Update Info</th>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Edit</th>
                                    <?php if ($bagnm == 'ITD') {?>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Delete</th>
                                        <?php } ?>
                                    <?php if ($bagnm == 'ITD') {?>
                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Copy</th>
                                        <?php } ?>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($query)) { ?>
                                        <tr>
                                            <td colspan="25">tidak ada data</td>
                                        </tr>
                                    <?php } else {
                                        $no = 0;

                                        foreach ($query->result() as $row) {
                                            $no++;
                                                if($row->formstatus=='1'){
                                                    $frmstatus ='<div class="badge badge-pill badge-success">Aktif</div>';
                                                }else if($row->formstatus=='2'){
                                                    $frmstatus ='<div class="badge badge-pill badge-warning">obsolet</div>';
                                                }else{
                                                    $frmstatus ='<div class="badge badge-pill badge-danger">Tidak Aktif</div>';
                                                } ?>
                                            <tr>
                                                <td align="center"><?= $no ?></td>
                                                <td><?= $row->formid ?></td>
                                                <td><?= $row->formnm ?></td>
                                                <td><?= $row->formkd ?></td>
                                                <td><?= $row->formversi ?></td>
                                                <td><?= date("d-m-Y",strtotime($row->formefective)) ?></td>
                                                <td><?= $row->formjudul ?></td>
                                                <td><?= $row->formjudul_english ?></td>
                                                <td><?= $row->formket ?></td>
                                                <td><?= $frmstatus ?></td>
                                                <td><?= $row->formjnsnm ?></td>
                                                <td><?= $row->formkategorinm ?></td>
                                                <td><?= $row->formkategori2nm ?></td>
                                                <td><?= $row->efective_parameter ?></td>
                                                <td><?php if(isset($row->parameter_jlh_approval)) { echo $row->parameter_jlh_approval.' App'; } ?> </td>
                                                <td><?= $row->parameter_approval ?></td>
                                                <td><?= $row->parameter_jenis_approval ?></td>
                                                <td><?php if($row->status_input=='1'){echo 'Yes';}else{echo 'No';}?></td>
                                                <td><?php if($row->status_dataharian=='1'){echo 'Yes';}else{echo 'No';}?></td>
                                                <td><?php if($row->status_lap=='1'){echo 'Yes';}else{echo 'No';}?></td>
                                                <td><?php if($row->status_app=='1'){echo 'Yes';}else{echo 'No';}?></td>
                                                <td><?php if($row->createby!=''){echo $row->createby.' '.$row->createdate.' '.$row->createcomp;}?></td>
                                                <td><?php if($row->updateby!=''){echo $row->updateby.' '.$row->updatedate.' '.$row->updatecomp;}?></td>
                                                <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" value="<?= $row->formid ?>" title="Edit Data"><span class="btn bg-gradient-success feather icon-edit"></span></a></td>
                                                <td align="center"><a href="<?= base_url('master/form/C_formmenu/delete/'.$row->formid); ?>" title="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ?');"> <?= form_close(); ?><span class="btn bg-gradient-danger feather icon-trash-2"></span></a></td>
                                                <?php if ($bagnm == 'ITD') { ?>
                                                    <td align="center"><a type="button" class="btn modal_forminput" name="btn_copy" value="<?= $row->formid ?>" title="Copy Data"><span class="btn bg-gradient-warning feather icon-copy"></span></a></td>
                                                <?php } ?>
                                            </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ini_modal" tabindex="-1" role="dialog" aria-labelledby="modal_form" aria-hidden="true">
        <form action="" id="modal_form" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="hidden" name="formid" id="formid" class="form-control formid">
                        <h4 class="modal-title" id="judul_modal"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Form Nama</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="formnm" id="formnm" class="form-control formnm" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Form Kode</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="formkd" id="formkd" class="form-control formkd" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Form Versi</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="formversi" id="formversi" class="form-control formversi" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Form Efective</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="formefective" id="formefective" class="form-control datepicker maskdate formefective" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Form Judul (id)</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="formjudul" id="formjudul" class="form-control formjudul" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Form Judul (en)</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="formjudul_english" id="formjudul_english" class="form-control formjudul_english" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Form Keterangan</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="formket" id="formket" class="form-control select2 formket" required>
                                            <option value="">- pilih -</option>
                                            <option value="Complete">Complete</option>
                                            <option value="In-Progress">In-Progress</option>
                                            <option value="Modified">Modified</option>
                                            <option value="Not Applicable">Not Applicable</option>
                                            <option value="Prioritas">Prioritas</option>
                                            <option value="Ready">Ready</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Form Status</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="formstatus" id="formstatus" class="form-control select2 formstatus" required>
                                            <option value="">- pilih -</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Non Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Form Jenis</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="formjnsid" id="formjnsid" class="form-control select2 formjnsid" required>
                                            <option value="">- pilih -</option>
                                            <?php foreach ($jnsid as $jnsid_row) { ?>
                                                <option value="<?= $jnsid_row->submenuid ?>"><?= $jnsid_row->submenunm ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Form Kategori</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="formkategoriid" id="formkategoriid" class="form-control select2 formkategoriid">
                                            <option value="">- pilih -</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Form Kategori 2</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="formkategori2id" id="formkategori2id" class="form-control select2 formkategori2id">
                                            <option value="">- pilih -</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Parameter Tanggal Laporan</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="efective_parameter" id="efective_parameter" class="form-control select2 efective_parameter">
                                            <option value="">- pilih -</option>
                                            <option value="create_date">create_date</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Parameter Jenis Approval</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="parameter_jenis_approval" id="parameter_jenis_approval" class="form-control select2 parameter_jenis_approval">
                                            <option value="">- pilih -</option>
                                            <option value="Non-Shift">Non-Shift</option>
                                            <option value="Shift">Shift</option>
                                            <option value="Pengecekan">Pengecekan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Jumlah Approval</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="parameter_jlh_approval" id="parameter_jlh_approval" class="form-control select2 parameter_jlh_approval">
                                            <option value="">- pilih -</option>
                                            <option value="1">1 Approval</option>
                                            <option value="2">2 Approval</option>
                                            <option value="3">3 Approval</option>
                                            <option value="4">4 Approval</option>
                                            <option value="5">5 Approval</option>
                                            <option value="6">6 Approval</option>
                                            <option value="7">7 Approval</option>
                                            <option value="8">8 Approval</option>
                                            <option value="9">9 Approval</option>
                                            <option value="10">10 Approval</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Parameter Tanggal Approval</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="parameter_approval" id="parameter_approval" class="form-control select2 parameter_approval">
                                            <option value="">- pilih -</option>
                                            <option value="create_date">create_date</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Status</span>
                                    </div>
                                    <div class="col-md-8">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-inline-block mr-2">
                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="status_input" id="status_input">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">Form Input</span>
                                                    </div>
                                                </fieldset>
                                            </li>
                                            <li class="d-inline-block mr-2">
                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="status_dataharian" id="status_dataharian">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">Data Harian</span>
                                                    </div>
                                                </fieldset>
                                            </li>
                                            <li class="d-inline-block mr-2">
                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="status_lap" id="status_lap">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">Laporan</span>
                                                    </div>
                                                </fieldset>
                                            </li>
                                            <li class="d-inline-block mr-2">
                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="status_app" id="status_app">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">Approval</span>
                                                    </div>
                                                </fieldset>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        <button type="button" class="btn bg-gradient-dark" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</section><!-- /.content -->

<?php $this->load->view('template/footbar'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('.formnm').mask("AAA-AAA-000", {reverse : false});
        $('.formkd').mask("AAAAAA000", {reverse : false});
        $('.formversi').mask("00", {reverse : false});

        $(document).on('click', '.modal_forminput', function() {
            if($(this).attr("name")=='btn_update' && $(this).attr("value").trim()!='' && confirm('Ubah data?')){
                $("#modal_form").attr("action", "<?= base_url('master/form/C_formmenu/form_modal/update') ?>");
                $("#formid").val($(this).attr("value").trim());
                $("#judul_modal").empty();
                $("#judul_modal").append('Update Form');

                $.ajax({
                    type :"post",
                    url : "<?php echo base_url();?>/master/form/C_formmenu/get_dt_update",
                    data : "id=" + $(this).attr("value").trim(),
                    success : function(data){
                        console.log(data.trim().split('//')[21]);
                        $("#formnm").val(data.trim().split('//')[0]);
                        $("#formkd").val(data.trim().split('//')[1]);
                        $("#formversi").val(data.trim().split('//')[2]);
                        $("#formefective").val(data.trim().split('//')[3]);
                        $("#formjudul").val(data.trim().split('//')[4]);
                        $("#formjudul_english").val(data.trim().split('//')[5]);
                        $("#formket").val(data.trim().split('//')[6]).trigger('change');
                        $("#formstatus").val(data.trim().split('//')[7]).trigger('change');
                        $("#formjnsid").empty().html(data.trim().split('//')[21]);
                        $("#formkategoriid").empty().html(data.trim().split('//')[19]);
                        $("#formkategori2id").empty().html(data.trim().split('//')[20]);
                        $("#efective_parameter").val(data.trim().split('//')[11]).trigger('change');
                        $("#parameter_jenis_approval").val(data.trim().split('//')[12]).trigger('change');
                        $("#parameter_jlh_approval").val(data.trim().split('//')[13]).trigger('change');
                        $("#parameter_approval").val(data.trim().split('//')[14]).trigger('change');

                        if(data.trim().split('//')[15]==1){
                            $("#status_input").prop('checked', true);
                        }else{
                            $("#status_input").prop('checked', false);                            
                        }

                        if(data.trim().split('//')[16]==1){
                            $("#status_dataharian").prop('checked', true);
                        }else{
                            $("#status_dataharian").prop('checked', false);                            
                        }

                        if(data.trim().split('//')[17]==1){
                            $("#status_lap").prop('checked', true);
                        }else{
                            $("#status_lap").prop('checked', false);                            
                        }

                        if(data.trim().split('//')[18]==1){
                            $("#status_app").prop('checked', true);
                        }else{
                            $("#status_app").prop('checked', false);                            
                        }
                    }
                });

                $("#ini_modal").modal();
            }else if($(this).attr("name")=='btn_copy' && $(this).attr("value").trim()!='' && confirm('Copy data?')){
                $("#modal_form").attr("action", "<?= base_url('master/form/C_formmenu/form_modal/copy') ?>");
                $("#formid").val($(this).attr("value").trim());
                $("#judul_modal").empty();
                $("#judul_modal").append('Copy Form');

                $.ajax({
                    type :"post",
                    url : "<?php echo base_url();?>/master/form/C_formmenu/get_dt_copy",
                    data : "id=" + $(this).attr("value").trim(),
                    success : function(data){
                        console.log(data.trim().split('//')[21]);
                        $("#formnm").val(data.trim().split('//')[0]);
                        $("#formkd").val(data.trim().split('//')[1]);
                        $("#formversi").val(data.trim().split('//')[2]);
                        $("#formefective").val(data.trim().split('//')[3]);
                        $("#formjudul").val(data.trim().split('//')[4]);
                        $("#formjudul_english").val(data.trim().split('//')[5]);
                        $("#formket").val(data.trim().split('//')[6]).trigger('change');
                        $("#formstatus").val(data.trim().split('//')[7]).trigger('change');
                        $("#formjnsid").empty().html(data.trim().split('//')[21]);
                        $("#formkategoriid").empty().html(data.trim().split('//')[19]);
                        $("#formkategori2id").empty().html(data.trim().split('//')[20]);
                        $("#efective_parameter").val(data.trim().split('//')[11]).trigger('change');
                        $("#parameter_jenis_approval").val(data.trim().split('//')[12]).trigger('change');
                        $("#parameter_jlh_approval").val(data.trim().split('//')[13]).trigger('change');
                        $("#parameter_approval").val(data.trim().split('//')[14]).trigger('change');

                        if(data.trim().split('//')[15]==1){
                            $("#status_input").prop('checked', true);
                        }else{
                            $("#status_input").prop('checked', false);                            
                        }

                        if(data.trim().split('//')[16]==1){
                            $("#status_dataharian").prop('checked', true);
                        }else{
                            $("#status_dataharian").prop('checked', false);                            
                        }

                        if(data.trim().split('//')[17]==1){
                            $("#status_lap").prop('checked', true);
                        }else{
                            $("#status_lap").prop('checked', false);                            
                        }

                        if(data.trim().split('//')[18]==1){
                            $("#status_app").prop('checked', true);
                        }else{
                            $("#status_app").prop('checked', false);                            
                        }
                    }
                });

                $("#ini_modal").modal();
            }else if($(this).attr("name")=='btn_add'){
                $("#modal_form").attr("action", "<?= base_url('master/form/C_formmenu/form_modal/add') ?>");
                $("#formid").val('');
                $("#judul_modal").empty();
                $("#judul_modal").append('Tambah Form');
                $("#ini_modal").modal();                
            }
        });

        $('#formjnsid').change(function(){
            var formjnsid = $("#formjnsid").val();
            $.ajax({
                type :"post",
                url : "<?php echo base_url();?>/master/form/C_formmenu/getFormKat",
                data : "formjnsid=" + formjnsid,
                success : function(data){
                    $("#formkategoriid").empty().html(data);
                }
            });
        });

        $('#formkategoriid').change(function(){
            var formkategoriid = $("#formkategoriid").val();
            $.ajax({
                type :"post",
                url : "<?php echo base_url();?>/master/form/C_formmenu/getFormKat2",
                data : "formkategoriid=" + formkategoriid,
                success : function(data){
                    $("#formkategori2id").empty().html(data);
                }
            });
        });
    });
    $('.btn_copy').click(function() {
      var that = $(this);
      var that_val = that.val();
      
      $.ajax({
        type: "GET",
        url: "C_formmenu/copy_from/" + that_val,
        beforeSend: function() {
          Swal.fire({
            html: '<h5>Memuat...</h5>',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
              swal.showLoading();
            }
          });
        },
        success: function(data) {
          Swal.close();
          $('#html_modal_body3').empty().append(data);
          $("#Modal3").modal();
        }
      });
    });
</script>

<?php $this->load->view('template/footbarend'); ?>