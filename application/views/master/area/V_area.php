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
                    <h4 class="card-title">DATA AREA</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button type="button" class="btn bg-gradient-primary modal_forminput" name="btn_add" value=""><span class="feather icon-edit-1"> Tambah Baru</span></button></br></br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                              <thead>
                                <tr class="table-primary text-center">
                                  <th>No</th>
                                  <th>Area</th>
                                  <th>Form Penggunaan</th>
                                  <th>Tanggal Efektif</th>
                                  <th>Dibuat Oleh</th>
                                  <th>Diedit Oleh</th>
                                  <th>view</th>
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
                                      <td align="center"><?= $list_data_row->area ?></td>
                                      <td align="center"><?php foreach (explode(",", $list_data_row->form_penggunaan) as $form_penggunaan_row) {
                                            echo $form_penggunaan_row.'<br>';
                                          }  ?></td>
                                      <td align="center"><?= date("d-m-Y",strtotime($list_data_row->tgl_efektif)) ?></td>
                                      <td align="center"><?= $list_data_row->created_userid!='' ? $list_data_row->created_by.' ('.date("d-m-Y",strtotime($list_data_row->created_date)).' '.$list_data_row->created_time.')' : '-' ?></td>
                                      <td align="center"><?= $list_data_row->updated_userid!='' ? $list_data_row->updated_by.' ('.date("d-m-Y",strtotime($list_data_row->updated_date)).' '.$list_data_row->updated_time.')' : '-' ?></td>
                                      <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" id="btn_view" value="<?= $list_data_row->headerid ?>" title="Lihat Data"><span class="btn bg-gradient-info feather icon-edit"></span></a></td>
                                      <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" id="btn_update" value="<?= $list_data_row->headerid ?>" title="Edit Data"><span class="btn bg-gradient-success feather icon-edit"></span></a></td>
                                      <td align="center">
                                        <a href="<?= base_url('master/area/C_area/delete/'.$list_data_row->headerid) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="btn bg-gradient-danger feather icon-trash-2"></span></a></td>
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
                        <input type="hidden" name="mdl1_headerid" id="mdl1_headerid" class="form-control mdl1_headerid">
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
                                        <span>area</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl1_area" id="mdl1_area" class="form-control mdl1_area set_kosong" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Tanggal Efektif</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl1_tgl_efektif" id="mdl1_tgl_efektif" class="form-control mdl1_tgl_efektif datepicker maskdate set_kosong" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Form Penggunaan</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="mdl1_form_penggunaan[]" id="mdl1_form_penggunaan" class="form-control select2 mdl1_form_penggunaan set_kosong2" multiple >
                                            <?php foreach($list_kode_form as $list_kode_form_row){ ?>
                                                <option value="<?= $list_kode_form_row->formnm;?>"><?= $list_kode_form_row->formnm;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
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

        // $(document).on('change', '.cari_pekerja_info', function(){
        //     var that                = $(this);
        //     var mdl1_nik            = that.closest('tr').find(".mdl1_nik").val();
        //     var mdl1_personalstatus = that.closest('tr').find(".mdl1_personalstatus").val();

        //     that.closest('tr').find(".mdl1_personalid").val('');
        //     that.closest('tr').find(".mdl1_nama").val('');

        //     if(mdl1_personalstatus.trim()!='' && mdl1_nik.trim()!=''){
        //         $.ajax({
        //             url: "<?= base_url(); ?>/master/area/C_area/get_pekerja_by",
        //             type: 'post',
        //             data: {
        //                 mdl1_personalstatus,
        //                 mdl1_nik,
        //             },
        //             success: function(data){
        //                 if(JSON.parse(data)['status']==0){
        //                     that.closest('tr').find(".mdl1_personalid").val(JSON.parse(data)['data'][0].personalid);
        //                     that.closest('tr').find(".mdl1_nama").val(JSON.parse(data)['data'][0].nama);
        //                 }else{
        //                     alert(JSON.parse(data)['pesan']);
        //                 }
        //             },
        //             error: function(){
        //                 alert('fail');
        //             },
        //         });
        //     }else{

        //     }
        // });

        $(document).on('click', '.modal_forminput', function(){
            var headerid = $(this).attr("value").trim();
            $(".set_kosong").val('').trigger;
            $(".set_kosong2").val('').trigger('change');
            
            $('.btn_disable').prop('disabled', false);

            if($(this).attr("name")=='btn_update' && headerid!=''){
                $("#modal_form").attr("action", "<?= base_url('master/area/C_area/form/update') ?>");
                $("#mdl1_headerid").val(headerid);

                $.ajax({
                    url : "<?= base_url();?>/master/area/C_area/get_dt_update",
                    type :"post",
                    data : { headerid },
                    success : function(data){
                        if(JSON.parse(data)['status']==0){
                            $(".mdl1_area").val(JSON.parse(data)['data'][0].area);

                            var list_opsi = '';
                            $.each(JSON.parse('<?= json_encode($list_kode_form) ?>'), function(key, list_opsi_row){
                                var list_opsi_selected = '';
                                $.each(JSON.parse(data)['data'][0].form_penggunaan.split(','), function(key, list_opsi_selected_row){
                                    if(list_opsi_row.formnm==list_opsi_selected_row){
                                        list_opsi_selected = 'selected';
                                        return false; // break cok
                                    }
                                });
                                list_opsi += '<option value="'+list_opsi_row.formnm+'" '+list_opsi_selected+'>'+list_opsi_row.formnm+'</option>';
                            });

                            $('.mdl1_form_penggunaan').empty().append(list_opsi);

                            $(".mdl1_tgl_efektif").val(JSON.parse(data)['data'][0].tgl_efektif.split('-')[2]
                                                        +'-'+JSON.parse(data)['data'][0].tgl_efektif.split('-')[1]
                                                        +'-'+JSON.parse(data)['data'][0].tgl_efektif.split('-')[0]);
                        }else{
                            alert(JSON.parse(data)['pesan']);
                        }
                    }
                });

                if($(this).attr("id")=='btn_update' && confirm('Ubah data?')){
                    $("#judul_modal").empty().append('Edit area');
                    $("#ini_modal").modal();
                }else{
                    $("#judul_modal").empty().append('Lihat area');
                    $('.btn_disable').prop('disabled', true);
                    $("#ini_modal").modal();                    
                }
            }else if($(this).attr("name")=='btn_add'){
                $("#modal_form").attr("action", "<?= base_url('master/area/C_area/form/add') ?>");
                $("#mdl1_headerid").val('');
                $("#judul_modal").empty().append('Tambah area');
                $('.btncopy').prop('disabled', true);
                $("#ini_modal").modal();                
            }
        });
    });
</script> 

<?php $this->load->view('template/footbarend'); ?>