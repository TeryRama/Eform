<?php $this->load->view('template/headbar'); ?>
<!-- Content Header (Page header) -->
<!-- Main content -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12 mb-1">
            <h4 class="text-uppercase"><?php echo $Titel; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Item Mesin</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <a type="button" href="<?php echo base_url('master/item/C_form_item_mesin/form/add') ?>" class="btn bg-gradient-primary modal_forminput waves-effect waves-light" role="button"><span class="feather icon-edit-1"> New Item</span></a><br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                                <thead>
                                    <tr>
                                        <th class="table-primary align-middle text-center" rowspan="2">No</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Departemen</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Jenis Form</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Kategori Form</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Kode Form</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Parameter I</th>

                                        <th class="table-primary align-middle text-center" rowspan="2">Tanggal Efective</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Create Info</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Update Info</th>
                                        <th class="table-primary align-middle text-center" colspan="3">Action</th>
                                    </tr>
                                    <tr>
                                        <th class="table-primary align-middle text-center">View</th>
                                        <th class="table-primary align-middle text-center">Update</th>
                                        <th class="table-primary align-middle text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($dt_spec)) { ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                    } else {
                                        $no = 0;
                                        foreach ($dt_spec as $row) {
                                            $no++;
                                            $headerid = $row->headerid;
                                            $create_date = substr($row->create_date, 8, 2) . '-' . substr($row->create_date, 5, 2) . '-' . substr($row->create_date, 0, 4);
                                            $updated_date = substr($row->updated_date, 8, 2) . '-' . substr($row->updated_date, 5, 2) . '-' . substr($row->updated_date, 0, 4);
                                            $tgl_efective = substr($row->tgl_efective, 8, 2) . '-' . substr($row->tgl_efective, 5, 2) . '-' . substr($row->tgl_efective, 0, 4);
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $no; ?></td>
                                                <td class="text-center"><?php echo $row->departemen; ?></td>
                                                <td class="text-center"><?php echo $row->form_jenis; ?></td>
                                                <td class="text-center"><?php echo $row->form_kategori; ?></td>
                                                <td class="text-center"><?php echo $row->form_kode; ?></td>
                                                <td class="text-center"><?php echo $row->parameter; ?></td>
                                                <td class="text-center"><?php echo $tgl_efective; ?></td>
                                                <td class="text-center"><?php echo $row->create_by . ' / ' . $create_date . ' / ' . $row->create_time; ?></td>
                                                <td class="text-center"><?php if (trim($row->updated_by) != '') {
                                                                            echo $row->updated_by . ' / ' . $updated_date . ' / ' . $row->updated_time;
                                                                        } else {
                                                                            echo '-';
                                                                        } ?></td>
                                                <td class="text-center"><?php echo anchor('master/item/C_form_item_mesin/form/view/' . $headerid, '<span class="btn bg-gradient-success btn-md waves-effect waves-light fa fa-search"></span>'); ?></td>
                                                <td class="text-center"><?php echo anchor('master/item/C_form_item_mesin/form/edit/' . $headerid, '<span class="btn bg-gradient-info btn-md waves-effect waves-light fa fa-edit"></span>'); ?></td>
                                                <td class="text-center"><?php echo anchor('master/item/C_form_item_mesin/delete/' . $headerid, '<span class="btn bg-gradient-danger btn-md waves-effect waves-light fa fa-trash"></span>', array('onclick' => "return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')")); ?></td>
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Komponen</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button type="button" class="btn bg-gradient-primary modal_forminput" name="btn_add" value=""><span class="feather icon-edit-1"> Tambah Baru</span></button></br></br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                                <thead>
                                    <tr>
                                        <th class="table-primary align-middle text-center" rowspan="2">No</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Departemen</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Nama Komponen</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Kode Komponen</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Create Info</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Update Info</th>
                                        <th class="table-primary align-middle text-center" colspan="3">Action</th>
                                    </tr>
                                    <tr>
                                        <th class="table-primary align-middle text-center">View</th>
                                        <th class="table-primary align-middle text-center">Update</th>
                                        <th class="table-primary align-middle text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($dt_komponen)) { ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                    } else {
                                        $no = 0;
                                        foreach ($dt_komponen as $row) {
                                            $no++;
                                            $created_date = substr($row->created_date, 8, 2) . '-' . substr($row->created_date, 5, 2) . '-' . substr($row->created_date, 0, 4);
                                            $updated_date = substr($row->updated_date, 8, 2) . '-' . substr($row->updated_date, 5, 2) . '-' . substr($row->updated_date, 0, 4);
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $no; ?></td>
                                                <td class="text-center"><?php echo $row->deptabbr; ?></td>
                                                <td class="text-center"><?php echo $row->nama_komponen; ?></td>
                                                <td class="text-center"><?php echo $row->kode_komponen; ?></td>
                                                <td class="text-center"><?php if (trim($row->created_by) != '') {
                                                                            echo $row->created_by . ' / ' . $created_date . ' / ' . $row->created_time;
                                                                        } else {
                                                                            echo '-';
                                                                        } ?></td>
                                                <td class="text-center"><?php if (trim($row->updated_by) != '') {
                                                                            echo $row->updated_by . ' / ' . $updated_date . ' / ' . $row->updated_time;
                                                                        } else {
                                                                            echo '-';
                                                                        } ?></td>
                                                <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" id="btn_view" value="<?= $row->komponen_id ?>" title="Lihat Data"><span class="btn bg-gradient-info feather icon-edit"></span></a></td>
                                                <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" id="btn_update" value="<?= $row->komponen_id ?>" title="Edit Data"><span class="btn bg-gradient-success feather icon-edit"></span></a></td>
                                                <td align="center">
                                                    <a href="<?= base_url('master/item/C_form_item_mesin/delete_komponen/' . $row->komponen_id) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="btn bg-gradient-danger feather icon-trash-2"></span></a>
                                                </td>
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
                        <input type="hidden" name="mdl1_komponen_id" id="mdl1_komponen_id" class="form-control mdl1_komponen_id">
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
                                        <span>Departemen</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="mdl1_dept" id="mdl1_dept" class="mdl1_dept form-control select2 set_kosong2" required>
                                            <option value="">- pilih -</option>
                                            <?php if (isset($dtdept)) {
                                                foreach ($dtdept as $dtdepartemen_row) { ?>
                                                    <option value="<?php echo $dtdepartemen_row->deptid; ?>"><?php echo $dtdepartemen_row->deptabbr; ?></option>
                                            <?php
                                                }
                                            } ?>
                                        </select>
                                        <input type="hidden" name="mdl1_deptabbr" id="mdl1_deptabbr" class="form-control mdl1_deptabbr set_kosong">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Nama Komponen</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl1_komponen" id="mdl1_komponen" class="form-control mdl1_komponen set_kosong" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Kode Komponen</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl1_kode_komponen" id="mdl1_kode_komponen" class="form-control mdl1_kode_komponen set_kosong">
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

<script>
    $(function() {
        $("#example1").DataTable();
    });

    $(document).ready(function() {

        $(document).on('click', '.modal_forminput', function() {
            var komponen_id = $(this).attr("value").trim();
            $(".set_kosong").val('').trigger;
            $(".set_kosong2").val('').trigger('change');

            $('.btn_disable').prop('disabled', false);

            if ($(this).attr("name") == 'btn_update' && komponen_id != '') {
                $("#modal_form").attr("action", "<?= base_url('master/item/C_form_item_mesin/form_komponen/update') ?>");
                $("#mdl1_komponen_id").val(komponen_id);

                $.ajax({
                    url: "<?= base_url(); ?>/master/item/C_form_item_mesin/get_dt_update",
                    type: "post",
                    data: {
                        komponen_id
                    },
                    success: function(data) {
                        if (JSON.parse(data)['status'] == 0) {
                            var list_opsi = '';
                            var list_opsi_selected = '';
                            $.each(JSON.parse('<?= json_encode($dtdept) ?>'), function(key, list_opsi_row) {
                                console.log(list_opsi_row)
                                if (list_opsi_row.deptid == JSON.parse(data)['data'][0].deptid) {
                                    list_opsi_selected = 'selected';
                                } else {
                                    list_opsi_selected = '';
                                }
                                list_opsi += '<option value="' + list_opsi_row.deptid + '" ' + list_opsi_selected + '>' + list_opsi_row.deptabbr + '</option>';
                            });
                            $(".mdl1_dept").empty().append(list_opsi);
                            $(".mdl1_deptabbr").val(JSON.parse(data)['data'][0].deptabbr);
                            $(".mdl1_komponen").val(JSON.parse(data)['data'][0].nama_komponen);
                            $(".mdl1_kode_komponen").val(JSON.parse(data)['data'][0].kode_komponen);
                        } else {
                            alert(JSON.parse(data)['pesan']);
                        }
                    }
                });

                if ($(this).attr("id") == 'btn_update' && confirm('Ubah data?')) {
                    $("#judul_modal").empty().append('Edit Komponen');
                    $("#ini_modal").modal();
                } else {
                    $("#judul_modal").empty().append('Lihat Komponen');
                    $('.btn_disable').prop('disabled', true);
                    $("#ini_modal").modal();
                }
            } else if ($(this).attr("name") == 'btn_add') {
                $("#modal_form").attr("action", "<?= base_url('master/item/C_form_item_mesin/form_komponen/add') ?>");
                $("#mdl1_komponen_id").val('');
                $("#judul_modal").empty().append('Tambah Komponen');
                $('.btncopy').prop('disabled', true);
                $("#ini_modal").modal();
            }
        });
        $(document).on('change', '.mdl1_dept', function() {
            var that_val = $(this).find('option:selected').text();
            $('.mdl1_deptabbr').val(that_val);
        });
    });
</script>

<?php $this->load->view('template/footbarend'); ?>