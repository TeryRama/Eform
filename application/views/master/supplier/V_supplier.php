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
                    <h4 class="card-title">DATA DEPARTEMEN PEMAKAIAN AIR</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button type="button" class="btn bg-gradient-primary modal_forminput" name="btn_add" value=""><span class="feather icon-edit-1"> Tambah Baru</span></button></br></br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                                <thead>
                                    <tr class="table-primary text-center">
                                        <th>No</th>
                                        <th>Tanggal Efektif</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Diedit Oleh</th>
                                        <th>View</th>
                                        <th>Ubah</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($list_data)) {
                                        $no = 0;
                                        foreach ($list_data as $list_data_row) {
                                            $no++; ?>
                                            <tr>
                                                <td align="center"><?= $no; ?></td>
                                                <td align="center"><?= date("d-m-Y", strtotime($list_data_row->tgl_efektif)) ?></td>
                                                <td align="center"><?= $list_data_row->created_userid != '' ? $list_data_row->created_by . ' (' . date("d-m-Y", strtotime($list_data_row->created_date)) . ' ' . $list_data_row->created_time .   ')' : '-' ?></td>
                                                <td align="center"><?= $list_data_row->updated_userid != '' ? $list_data_row->updated_by . ' (' . date("d-m-Y", strtotime($list_data_row->updated_date)) . ' ' . $list_data_row->updated_time .   ')' : '-' ?></td>
                                                <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" id="btn_view" value="<?= $list_data_row->headerid ?>" title="Lihat Data"><span class="btn bg-gradient-info feather icon-edit"></span></a></td>
                                                <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" id="btn_update" value="<?= $list_data_row->headerid ?>" title="Edit Data"><span class="btn bg-gradient-success feather icon-edit"></span></a></td>
                                                <td align="center">
                                                    <a href="<?= base_url('master/supplier/C_supplier/delete/' . $list_data_row->headerid) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN    MENGHAPUS DATA PENTING INI ... ?')"><span class="btn bg-gradient-danger feather icon-trash-2"></span></a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
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
                                        <span>Tanggal Efektif</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl1_tgl_efektif" id="mdl1_tgl_efektif" class="form-control mdl1_tgl_efektif datepicker maskdate set_kosong" required>
                                    </div>
                                </div>

                                <div class="table-responsive mt-1">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-warning">
                                            <tr>
                                                <th class="table-primary align-middle text-center"></th>
                                                <th class="table-primary align-middle text-center">Dept - Jenis Air - Flowmeter</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_mdl1">
                                            <tr>
                                                <td><input name="mdl1_chk[]" class="checkall" type="checkbox" value="" /></td>
                                                <td><select name="mdl1_id_flow_meter[]" id="mdl1_id_flow_meter" class="form-control mdl1_id_flow_meter cari_dept_info select_satu_aja set_kosong" required>
                                                        <option value="">- pilih -</option>
                                                        <?php foreach ($list_flow_meter as $list_flow_meter_key => $list_flow_meter_value) {
                                                            echo '<option value="' . $list_flow_meter_value->headerid . '">' . $list_flow_meter_value->air . ' - ' . $list_flow_meter_value->nama_dept . ' - ' . $list_flow_meter_value->nama_flow . '</option>';
                                                        } ?>
                                                    </select></td>
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
    $(document).ready(function() {
        $('.angkasaja_6digit').mask("000000", {
            reverse: false
        });

        $('.text_upper').keyup(function() {
            this.value = this.value.toUpperCase();
        });

        $(".readonly").keydown(function(e) {
            e.preventDefault();
        });

        $(document).on('click', '.modal_forminput', function() {
            var headerid = $(this).attr("value").trim();
            $(".set_kosong").val('');
            $(".set_kosong2").val('').trigger('change');

            $('.btn_disable').prop('disabled', false);

            if ($(this).attr("name") == 'btn_update' && headerid != '') {
                $("#modal_form").attr("action", "<?= base_url('master/supplier/C_supplier/form/update') ?>");
                $("#mdl1_headerid").val(headerid);

                $.ajax({
                    url: "<?php echo base_url(); ?>/master/supplier/C_supplier/get_dt_update",
                    type: "post",
                    data: {
                        headerid
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.status == 0) {
                            $(".mdl1_tgl_efektif").val(result.data[0].tgl_efektif.split('-')[2] + '-' + result.data[0].tgl_efektif.split('-')[1] + '-' + result.data[0].tgl_efektif.split('-')[0]);

                            let list_dtl = '';
                            $.each(result.data, function(key, list_dtl_row) {
                                let list_opsi_flow_meter = '';
                                let id_selected = '';
                                $.each(<?= json_encode($list_flow_meter) ?>, function(list_flow_meter_key, list_flow_meter_value) {
                                    id_selected = list_flow_meter_value.headerid == list_dtl_row.id_flow_meter ? 'selected' : '';
                                    list_opsi_flow_meter += '<option value="' + list_flow_meter_value.headerid + '" ' + id_selected + '>' + list_flow_meter_value.air + ' - ' + list_flow_meter_value.nama_dept + ' - ' + list_flow_meter_value.nama_flow + '</option>';
                                });

                                list_dtl += `<tr>
                                                <input type="hidden" name="mdl1_detail_id[]" id="mdl1_detail_id" value="` + list_dtl_row.detail_id + `" size="1"/>
                                                <td><input name="mdl1_chk[]" class="checkall" type="checkbox" value="` + list_dtl_row.detail_id + `"/></td>
                                                <td><select name="mdl1_id_flow_meter[]" id="mdl1_id_flow_meter" class="form-control mdl1_id_flow_meter cari_dept_info select_satu_aja set_kosong" required>
                                                        <option value="">- pilih -</option>
                                                        ` + list_opsi_flow_meter + `
                                                    </select></td>
                                            <tr>`;
                            });
                            $('#tbody_mdl1').empty().append(list_dtl);
                        } else {
                            alert(result.pesan);
                        }
                    }
                });

                if ($(this).attr("id") == 'btn_update' && confirm('Ubah data?')) {
                    $("#judul_modal").empty().append('Edit Supplier');
                    $("#ini_modal").modal();
                } else {
                    $("#judul_modal").empty().append('Lihat Supplier');
                    $('.btn_disable').prop('disabled', true);
                    $("#ini_modal").modal();
                }
            } else if ($(this).attr("name") == 'btn_add') {
                $("#modal_form").attr("action", "<?= base_url('master/supplier/C_supplier/form/add') ?>");
                $("#mdl1_headerid").val('');
                $("#judul_modal").empty().append('Tambah Supplier');
                $('.btncopy').prop('disabled', true);
                $("#ini_modal").modal();
            }
        });
    });

    $(document).on('mousedown', '.select_satu_aja', function() {
        $(".select_satu_aja option").show();

        var v = [];
        $('.select_satu_aja').each(function() {
            if ($(this).val() != '') {
                v.push($(this).val());
            }
        });

        v.forEach(function(opsi_hilang) {
            $(".select_satu_aja option[value='" + opsi_hilang + "']").hide();
        });
    });
</script>

<?php $this->load->view('template/footbarend'); ?>