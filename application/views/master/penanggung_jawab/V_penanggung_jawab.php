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
                    <h4 class="card-title">DATA PENGAWAS/ PENANGGUNG JAWAB</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button type="button" class="btn bg-gradient-primary modal_forminput" name="btn_add" value=""><span class="feather icon-edit-1"> Tambah Baru</span></button></br></br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                              <thead>
                                <tr class="table-primary text-center">
                                  <th>No</th>
                                  <th>Kode Form</th>
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
                                      <td align="center"><?= $list_data_row->form_kode ?></td>
                                      <td align="center"><?= date("d-m-Y",strtotime($list_data_row->tgl_efektif)) ?></td>
                                      <td align="center"><?= $list_data_row->created_userid!='' ? $list_data_row->created_by.' ('.date("d-m-Y",strtotime($list_data_row->created_date)).' '.$list_data_row->created_time.')' : '-' ?></td>
                                      <td align="center"><?= $list_data_row->updated_userid!='' ? $list_data_row->updated_by.' ('.date("d-m-Y",strtotime($list_data_row->updated_date)).' '.$list_data_row->updated_time.')' : '-' ?></td>
                                      <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" id="btn_view" value="<?= $list_data_row->headerid ?>" title="Lihat Data"><span class="btn bg-gradient-info feather icon-edit"></span></a></td>
                                      <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" id="btn_update" value="<?= $list_data_row->headerid ?>" title="Edit Data"><span class="btn bg-gradient-success feather icon-edit"></span></a></td>
                                      <td align="center">
                                        <a href="<?= base_url('master/penanggung_jawab/C_penanggung_jawab/delete/'.$list_data_row->headerid) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="btn bg-gradient-danger feather icon-trash-2"></span></a></td>
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
                                        <span>Kode Form</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="mdl1_form_kode" id="mdl1_form_kode" class="form-control select2 mdl1_form_kode set_kosong2" required>
                                            <option value="">- pilih -</option>
                                            <?php foreach($list_form_kode as $list_form_kode_row){ ?>
                                                <option value="<?php echo $list_form_kode_row->formnm;?>"><?php echo $list_form_kode_row->formnm;?></option>
                                            <?php } ?>
                                        </select>
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
                                <code class="mt-1">**Silahkan masukan NIK terbaru, dapat di cek pada Master => Cek Pekerja</code>
                                <div class="table-responsive mt-1">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-warning">
                                            <tr>
                                                <th class="table-primary align-middle text-center"></th>
                                                <th class="table-primary align-middle text-center">Personal Status</th>
                                                <th class="table-primary align-middle text-center">NIK</th>
                                                <th class="table-primary align-middle text-center">Nama</th>
                                                <th class="table-primary align-middle text-center">Departemen</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_mdl1">
                                            <tr>
                                                <td><input name="mdl1_chk[]" type="checkbox" value=""/></td>
                                                <td><select name="mdl1_personalstatus[]" id="mdl1_personalstatus" class="form-control mdl1_personalstatus cari_pekerja_info set_kosong" required>
                                                        <option value="">- pilih -</option>
                                                        <option value="1">Karyawan</option>
                                                        <option value="2">Tenaga Kerja</option>
                                                    </select></td>
                                                <td><input type="text" name="mdl1_nik[]" id="mdl1_nik" class="mdl1_nik form-control angkasaja_6digit cari_pekerja_info set_kosong" value="" required/></td>
                                                <td><input type="hidden" name="mdl1_personalid[]" id="mdl1_personalid" class="mdl1_personalid form-control set_kosong" value=""/>
                                                    <input type="text" name="mdl1_nama[]" id="mdl1_nama" class="mdl1_nama form-control readonly set_kosong" value="" required/></td>
                                                <td><input type="text" name="mdl1_dept[]" id="mdl1_dept" class="mdl1_dept form-control readonly set_kosong" value="" required/></td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="table-primary align-middle text-center">
                                            <tr>
                                                <td colspan="7">
                                                    <button type="button" class="btn bg-gradient-info btn-md btn_disable" onClick="addRow('tbody_mdl1')">Tambah Baris</button>
                                                    <button type="button" class="btn bg-gradient-warning btn-md btn_disable" onClick="deleteRow('tbody_mdl1')">Hapus Baris</button>
                                                    <button type="submit" class="btn bg-gradient-danger btn-md btn_disable" name="btndelete_dtl" onclick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus Data</button>
                                            </tr>
                                        </tfoot>
                                    </table>
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

        $(document).on('change', '.cari_pekerja_info', function(){
            var that                = $(this);
            var mdl1_nik            = that.closest('tr').find(".mdl1_nik").val();
            var mdl1_personalstatus = that.closest('tr').find(".mdl1_personalstatus").val();

            that.closest('tr').find(".mdl1_personalid").val('');
            that.closest('tr').find(".mdl1_nama").val('');

            if(mdl1_personalstatus.trim()!='' && mdl1_nik.trim()!=''){
                $.ajax({
                    url: "<?= base_url(); ?>/master/penanggung_jawab/C_penanggung_jawab/get_pekerja_by",
                    type: 'post',
                    data: {
                        mdl1_personalstatus,
                        mdl1_nik,
                    },
                    success: function(data){
                        if(JSON.parse(data)['status']==0){
                            that.closest('tr').find(".mdl1_personalid").val(JSON.parse(data)['data'][0].personalid);
                            that.closest('tr').find(".mdl1_nama").val(JSON.parse(data)['data'][0].nama);
                            that.closest('tr').find(".mdl1_deptid").val(JSON.parse(data)['data'][0].id_dept);
                            that.closest('tr').find(".mdl1_dept").val(JSON.parse(data)['data'][0].dept_abbr);
                        }else{
                            alert(JSON.parse(data)['pesan']);
                        }
                    },
                    error: function(){
                        alert('fail');
                    },
                });
            }else{

            }
        });

        $(document).on('click', '.modal_forminput', function(){
            var headerid = $(this).attr("value").trim();
            $(".set_kosong").val('');
            $(".set_kosong2").val('').trigger('change');
            
            $('.btn_disable').prop('disabled', false);

            if($(this).attr("name")=='btn_update' && headerid!=''){
                $("#modal_form").attr("action", "<?= base_url('master/penanggung_jawab/C_penanggung_jawab/form/update') ?>");
                $("#mdl1_headerid").val(headerid);

                $.ajax({
                    url : "<?php echo base_url();?>/master/penanggung_jawab/C_penanggung_jawab/get_dt_update",
                    type :"post",
                    data : { headerid },
                    success : function(data){
                        if(JSON.parse(data)['status']==0){
                            $(".mdl1_form_kode").val(JSON.parse(data)['data'][0].form_kode).trigger('change');
                            $(".mdl1_tgl_efektif").val(JSON.parse(data)['data'][0].tgl_efektif.split('-')[2]
                                                        +'-'+JSON.parse(data)['data'][0].tgl_efektif.split('-')[1]
                                                        +'-'+JSON.parse(data)['data'][0].tgl_efektif.split('-')[0]);
                            var list_dtl = '';
                            $.each(JSON.parse(data)['data'], function(key, list_dtl_row){
                                var sel_personalstatus1 = list_dtl_row.personalstatus=='1' ? 'selected' : '';
                                var sel_personalstatus2 = list_dtl_row.personalstatus=='2' ? 'selected' : '';
                                list_dtl += `<tr>
                                                <input type="hidden" name="mdl1_detail_id[]" id="mdl1_detail_id" value="`+list_dtl_row.detail_id+`" size="1"/>
                                                <td><input name="mdl1_chk[]" type="checkbox" value="`+list_dtl_row.detail_id+`"/></td>
                                                <td><select name="mdl1_personalstatus[]" id="mdl1_personalstatus" class="form-control mdl1_personalstatus cari_pekerja_info set_kosong" required>
                                                        <option value="">- pilih -</option>
                                                        <option value="1" `+sel_personalstatus1+`>Karyawan</option>
                                                        <option value="2" `+sel_personalstatus2+`>Tenaga Kerja</option>
                                                    </select></td>
                                                <td><input type="text" name="mdl1_nik[]" id="mdl1_nik" class="mdl1_nik form-control angkasaja_6digit cari_pekerja_info set_kosong" value="`+list_dtl_row.nik+`" required/></td>
                                                <td><input type="hidden" name="mdl1_personalid[]" id="mdl1_personalid" class="mdl1_personalid form-control set_kosong" value="`+list_dtl_row.personalid+`"/>
                                                    <input type="text" name="mdl1_nama[]" id="mdl1_nama" class="mdl1_nama form-control readonly set_kosong" value="`+list_dtl_row.nama+`" required/></td>
                                                <td><input type="hidden" name="mdl1_deptid[]" id="mdl1_deptid" class="mdl1_deptid form-control readonly set_kosong" value="`+list_dtl_row.dept_id+`" required/>
                                                    <input type="text" name="mdl1_dept[]" id="mdl1_dept" class="mdl1_dept form-control readonly set_kosong" value="`+list_dtl_row.dept+`" required/></td>
                                            <tr>`;
                            });
                            $('#tbody_mdl1').empty().append(list_dtl);
                        }else{
                            alert(JSON.parse(data)['pesan']);
                        }
                    }
                });

                if($(this).attr("id")=='btn_update' && confirm('Ubah data?')){
                    $("#judul_modal").empty().append('Edit Penanggung Jawab');
                    $("#ini_modal").modal();
                }else{
                    $("#judul_modal").empty().append('Lihat Penanggung Jawab');
                    $('.btn_disable').prop('disabled', true);
                    $("#ini_modal").modal();                    
                }
            }else if($(this).attr("name")=='btn_add'){
                $("#modal_form").attr("action", "<?= base_url('master/penanggung_jawab/C_penanggung_jawab/form/add') ?>");
                $("#mdl1_headerid").val('');
                $("#judul_modal").empty().append('Tambah Penanggung Jawab');
                $('.btncopy').prop('disabled', true);
                $("#ini_modal").modal();                
            }
        });
    });
</script> 

<?php $this->load->view('template/footbarend'); ?>