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
                    <h4 class="card-title">DATA PRODUCT SPESIFICATION</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button type="button" class="btn bg-gradient-primary modal_forminput" name="btn_add" value=""><span class="feather icon-edit-1"> Tambah Baru</span></button></br></br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                              <thead>
                                <tr class="table-primary text-center">
                                        <th>No</th>
                                        <th>Jenis Form</th>
                                        <th>Kode Form</th>
                                        <th>Versi</th>
                                        <th>Tanggal Efective Spec</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Diedit Oleh</th>
                                        <th>View</th>
                                        <th>Ubah</th>
                                        <th>Hapus</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if(!empty($list_data)){ 
                                  $no = 0;
                                  foreach($list_data as $list_data_row){
                                    $no++; ?>
                                    <tr>
                                      <td align="center"><?= $no;?></td>
                                      <td align="center"><?= $list_data_row->bagian ?></td>
                                      <td align="center"><?= $list_data_row->form_kode ?></td>
                                      <td align="center"><?= $list_data_row->form_versi ?></td>
                                      <td align="center"><?= date("d-m-Y",strtotime($list_data_row->tgl_start)) ?></td>
                                      <td align="center"><?= $list_data_row->create_by!='' ? $list_data_row->create_by.' ('.date("d-m-Y",strtotime($list_data_row->create_date)).' '.$list_data_row->create_time.')' : '-' ?></td>
                                      <td align="center"><?= $list_data_row->update_by!='' ? $list_data_row->update_by.' ('.date("d-m-Y",strtotime($list_data_row->update_date)).' '.$list_data_row->update_time.')' : '-' ?></td>
                                      <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" id="btn_view" value="<?= $list_data_row->headerid ?>" title="Lihat Data"><span class="btn bg-gradient-info feather icon-edit"></span></a></td>
                                      <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" id="btn_update" value="<?= $list_data_row->headerid ?>" title="Edit Data"><span class="btn bg-gradient-success feather icon-edit"></span></a></td>
                                      <td align="center">
                                        <a href="<?= base_url('master/product_spec/C_product_spec/delete/'.$list_data_row->headerid) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="btn bg-gradient-danger feather icon-trash-2"></span></a></td>
                                    </tr>
                                  <?php } 
                                } ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ini_modal" tabindex="-1" role="dialog" aria-labelledby="modal_form" aria-hidden="true">
        <form action="" id="modal_form" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="judul_modal"></h4>
                        <input type="hidden" name="mdl_headerid" id="mdl_headerid" class="form-control" value=""/>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Jenis Form</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="mdl_dtbagian" id="mdl_dtbagian" class="form-control set_kosong">
                                            <option value="">- pilih -</option>
                                            <?php 
                                            if(isset($dt_formjnsnm)){
                                                foreach ($dt_formjnsnm as $dt_formjnsnm_row) { ?>
                                                    <option value="<?= $dt_formjnsnm_row->formjnsnm ?>"><?= $dt_formjnsnm_row->formjnsnm ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Kode Form</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="hidden" id="val_kode_form" value="">
                                        <select name="mdl_dtkode_form" id="mdl_dtkode_form" class="form-control set_kosong">
                                            <option value="">- pilih -</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Versi Form</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="hidden" id="val_versi_form" value="">
                                        <select name="mdl_dtversi_form" id="mdl_dtversi_form" class="form-control set_kosong">
                                            <option value="">- pilih -</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr/>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Tanggal Efektif</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl_tgl_start" id="mdl_tgl_start" class="form-control mdl_tgl_start datepicker maskdate set_kosong" required>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>s/d</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl_tgl_finish" id="mdl_tgl_finish" class="form-control mdl_tgl_finish datepicker maskdate set_kosong">
                                    </div>
                                </div>
                            </div> -->
                            <div class="table-responsive mt-1">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-warning">
                                        <tr>
                                            <th class="table-primary align-middle text-center"></th>
                                            <th class="table-primary align-middle text-center">Parameter</th>
                                            <th class="table-primary align-middle text-center">Spec Minimal</th>
                                            <th class="table-primary align-middle text-center">Spec Maximal</th>
                                            <th class="table-primary align-middle text-center">Status Analisa</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_mdl1">
                                            <tr>
                                                <td><input name="chk[]" type="checkbox" value=""/></td>
                                                <td><input type="text" size="20" name="dt_parameter[]" id="dt_parameter" class="form-control set_kosong" value=""/></td>
                                                <td><input type="text" size="10" name="dt_spec_minimal[]" id="dt_spec_minimal" class="form-control set_kosong" value=""/></td>
                                                <td><input type="text" size="10" name="dt_spec_maximal[]" id="dt_spec_maximal" class="form-control set_kosong" value=""/></td>
                                                <td><select name="status_analisa[]" id="status_analisa" class="form-control set_kosong">
                                                        <option value="">- pilih -</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Non Active">Non Active</option>
                                                    </select>
                                                </td>
                                            </tr>
                                    </tbody>
                                    <tfoot class="table-primary align-middle text-center">
                                        <tr>
                                            <td colspan="6">
                                                <button type="button" class="btn bg-gradient-info btn-md btn_disable" onClick="addRow('tbody_mdl1')">Tambah Baris</button>
                                                <button type="button" class="btn bg-gradient-success btn-md btn_disable" onClick="InsertRow('tbody_mdl1')">Sisip Baris</button>
                                                <button type="button" class="btn bg-gradient-warning btn-md btn_disable" onClick="deleteRow('tbody_mdl1')">Hapus Baris</button>
                                                <button type="submit" class="btn bg-gradient-danger btn-md btn_disable" name="btndelete_dtl" onclick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus Data</button>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-primary btn_disable" name="btnproses">Simpan</button>
                        <button type="submit" class="btn bg-gradient-success btn_disable btncopy" name="btncopy">Copy</button>
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
        $('.angkasaja_6digit').mask("000000", {reverse : false}); 

        $('.text_upper').keyup(function(){
            this.value = this.value.toUpperCase();
        });

        $(".readonly").keydown(function(e){
            e.preventDefault();
        });
        
        $(document).on('change', '#mdl_dtbagian', function(){
            var dtbagian    = $(this).val();
            $.ajax({
                type : "post",
                url  : "<?php echo base_url();?>index.php/master/product_spec/C_product_spec/get_form_code",
                data : { formjnsnm: dtbagian},
                dataType : 'json',
                success: function(data3){   
                    var dtkode_form = $('#val_kode_form').val();
                    
                    var opt_selected = '';
                    var list_ops_kode_form = '';
                    $.each(data3, function(key, val){
                        opt_selected = val.formkd == dtkode_form ? "selected" : "";
                        list_ops_kode_form += '<option value="'+val.formkd+'" '+opt_selected+'>'+val.formnm+'</option>';
                    });
                    $('#mdl_dtkode_form').find('option:not(:first)').remove();
                    $('#mdl_dtkode_form').append(list_ops_kode_form);
                }
            });
        });
        $(document).on('change', '#mdl_dtkode_form', function(){
            if( $(this).val()==''){
                var dtkode_form = $('#val_kode_form').val();
            }else{
                var dtkode_form = $(this).val();
            }

            $.ajax({
                type : "post",
                url  : "<?php echo base_url();?>index.php/master/product_spec/C_product_spec/get_form_versi",
                data : { formkd: dtkode_form},
                dataType : 'json',
                success: function(data4){                    
                    var dtversi_form = $('#val_versi_form').val();

                    var opt_selected = '';
                    var list_ops_versi_form = '';
                    
                    $.each(data4, function(key, val){
                        opt_selected = val.formversi == dtversi_form ? "selected" : "";
                        list_ops_versi_form += '<option value="'+val.formversi+'" '+opt_selected+'>'+val.formversi+'</option>';
                    });

                    $('#mdl_dtversi_form').find('option:not(:first)').remove();
                    $('#mdl_dtversi_form').append(list_ops_versi_form);
                }
            });
        });
        $(document).on('click', '.modal_forminput', function(){
            var headerid = $(this).attr("value").trim();
            $(".set_kosong").val('').trigger;
            $(".set_kosong2").val('').trigger('change');
            
            $('.btn_disable').prop('disabled', false);

            if($(this).attr("name")=='btn_update' && headerid!=''){
                $("#modal_form").attr("action", "<?= base_url('master/product_spec/C_product_spec/form/update') ?>");
                $("#mdl_headerid").val(headerid);

                $.ajax({
                    url : "<?= base_url();?>/master/product_spec/C_product_spec/get_dt_update",
                    type :"post",
                    data : { headerid },
                    dataType : 'json',
                    success : function(data){
                        if(data.status==0){
                            if(data.data_hdr.length){
                                $.each(data.data_hdr, function(key, val_hdr){
                                    let list_opsi_formjnsnm = '';
                                    let id_selected = '';
                                    
                                    $.each(<?= json_encode($dt_formjnsnm) ?>, function(dt_formjnsnm_key, dt_formjnsnm_value) {
                                        id_selected = dt_formjnsnm_value.formjnsnm == val_hdr.bagian ? 'selected' : '';
                                        list_opsi_formjnsnm += '<option value="' + dt_formjnsnm_value.formjnsnm + '" ' + id_selected + '>' + dt_formjnsnm_value.formjnsnm + '</option>';
                                    });
                                    $('#mdl_dtbagian').empty().append(list_opsi_formjnsnm);
                                    $('#mdl_dtbagian').trigger('change');
                                    $('#val_kode_form').val(val_hdr.form_kode)
                                    $('#mdl_dtkode_form').trigger('change');
                                    $('#val_versi_form').val(val_hdr.form_versi)
                                    $('#mdl_headerid').val(val_hdr.headerid)
                                    $('#mdl_tgl_start').val(val_hdr.tgl_start)
                                    $('#mdl_tgl_finish').val(val_hdr.tgl_finish)
                                });
                            }
                            
                            if(data.data_dtl.length){
                                let list_dtl = '';
                                let opt_dtl_selected_active = '';
                                let opt_dtl_selected_non_active = '';
                                $.each(data.data_dtl, function(key, val_dtl){
                                    opt_dtl_selected_active = val_dtl.status_analisa =='Active' ? ' selected="selected"' :"";
                                    opt_dtl_selected_non_active = val_dtl.status_analisa =='Non Active' ? ' selected="selected"' :"";
    
                                    list_dtl += `<tr>
                                                    <input type="hidden" size="20" name="detail_id[]" id="detail_id" class="form-control set_kosong" value="${val_dtl.detail_id}"/>
                                                    <td><input name="chk[]" type="checkbox" value="${val_dtl.detail_id}"/></td>
                                                    <td><input type="text" size="20" name="dt_parameter[]" id="dt_parameter" class="form-control set_kosong" value="${val_dtl.parameter}"/></td>
                                                    <td><input type="text" size="10" name="dt_spec_minimal[]" id="dt_spec_minimal" class="form-control set_kosong" value="${val_dtl.spec_min}"/></td>
                                                    <td><input type="text" size="10" name="dt_spec_maximal[]" id="dt_spec_maximal" class="form-control set_kosong" value="${val_dtl.spec_max}"/></td>
                                                    <td><select name="status_analisa[]" id="status_analisa" class="form-control set_kosong">
                                                            <option value="">- pilih -</option>
                                                            <option value="Active" ${opt_dtl_selected_active}>Active</option>
                                                            <option value="Non Active" ${opt_dtl_selected_non_active}>Non Active</option>
                                                        </select>
                                                    </td>
                                                </tr>`;
                                });
                                $('#tbody_mdl1').empty().append(list_dtl);
                            }
                        }else{
                            alert(data.pesan);
                        }
                    }
                });

                if($(this).attr("id")=='btn_update' && confirm('Ubah data?')){
                    $("#judul_modal").empty().append('Edit product_spec');
                    $("#ini_modal").modal();
                }else{
                    $("#judul_modal").empty().append('Lihat product_spec');
                    $('.btn_disable').prop('disabled', true);
                    $("#ini_modal").modal();                    
                }
            }else if($(this).attr("name")=='btn_add'){
                $("#modal_form").attr("action", "<?= base_url('master/product_spec/C_product_spec/form/add') ?>");
                $("#mdl_headerid").val('');
                $("#judul_modal").empty().append('Tambah product_spec');
                $('.btncopy').prop('disabled', true);
                $("#ini_modal").modal();                
            }
        });
    });
</script> 

<?php $this->load->view('template/footbarend'); ?>