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
                    <h4 class="card-title">DATA FLOW METER</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button type="button" class="btn bg-gradient-primary modal_forminput" name="btn_add" value=""><span class="feather icon-edit-1"> Tambah Baru</span></button></br></br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                                <thead>
                                    <tr class="table-primary text-center">
                                        <th>No</th>
                                        <th>Jenis Air</th>
                                        <th>Dept</th>
                                        <th>Nama</th>
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
                                                <td align="center"><?= $list_data_row->air ?></td>
                                                <td align="center"><?= $list_data_row->nama_dept ?></td>
                                                <td align="center"><?= $list_data_row->nama_flow ?></td>
                                                <td align="center"><?= date("d-m-Y", strtotime($list_data_row->tgl_efektif)) ?></td>
                                                <td align="center"><?= $list_data_row->created_userid != '' ? $list_data_row->created_by . ' (' . date("d-m-Y", strtotime($list_data_row->created_date)) . ' ' . $list_data_row->created_time .   ')' : '-' ?></td>
                                                <td align="center"><?= $list_data_row->updated_userid != '' ? $list_data_row->updated_by . ' (' . date("d-m-Y", strtotime($list_data_row->updated_date)) . ' ' . $list_data_row->updated_time .   ')' : '-' ?></td>
                                                <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" id="btn_view" value="<?= $list_data_row->headerid ?>" title="Lihat Data"><span class="btn   bg-gradient-info feather icon-edit"></span></a></td>
                                                <td align="center"><a type="button" class="btn modal_forminput" name="btn_update" id="btn_update" value="<?= $list_data_row->headerid ?>" title="Edit Data"><span class="btn  bg-gradient-success feather icon-edit"></span></a></td>
                                                <td align="center">
                                                    <a href="<?= base_url('master/flowmeter/C_flowmeter/delete/' . $list_data_row->headerid) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN    MENGHAPUS DATA PENTING INI ... ?')"><span class="btn bg-gradient-danger feather icon-trash-2"></span></a>
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
                                        <span>Jenis Air</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="mdl1_id_jenis_air" id="mdl1_id_jenis_air" class="form-control select2 mdl1_id_jenis_air set_kosong2" required>
                                            <option value="">- Pilih -</option>
                                            <?php foreach ($list_air as $list_air_row) { ?>
                                                <option value="<?= $list_air_row->headerid ?>"><?= $list_air_row->air ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Departemen</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="hidden" name="mdl1_nama_dept" id="mdl1_nama_dept" class="form-control mdl1_nama_dept set_kosong" required>
                                        <select name="mdl1_id_dept" id="mdl1_id_dept" class="form-control select2 mdl1_id_dept set_kosong2" required>
                                            <option value="">- Pilih -</option>
                                            <?php foreach ($dt_departemen as $list_dept_row) { ?>
                                                <option value="<?= $list_dept_row->deptid ?>"><?= $list_dept_row->deptabbr ?></option>
                                            <?php } ?>
                                            <?php foreach ($dt_dept as $list_dept2_row) { ?>
                                                <option value="<?= $list_dept2_row->id_dept ?>"><?= $list_dept2_row->area?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Nama Flow</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl1_nama_flow" id="mdl1_nama_flow" class="form-control mdl1_nama_flow set_kosong" required>
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
            $(".set_kosong").val('').trigger;
            $(".set_kosong2").val('').trigger('change');

            $('.btn_disable').prop('disabled', false);

            if ($(this).attr("name") == 'btn_update' && headerid != '') {
                $("#modal_form").attr("action", "<?= base_url('master/flowmeter/C_flowmeter/form/update') ?>");
                $("#mdl1_headerid").val(headerid);

                $.ajax({
                    url: "<?= base_url(); ?>/master/flowmeter/C_flowmeter/get_dt_update",
                    type: "post",
                    data: {
                        headerid
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.status == 0) {
                            $(".mdl1_nama_flow").val(result.data[0].nama_flow).trigger('change');
                            $(".mdl1_id_dept").val(result.data[0].id_dept).trigger('change');
                            $(".mdl1_id_jenis_air").val(result.data[0].id_jenis_air).trigger('change');
                            $(".mdl1_tgl_efektif").val(result.data[0].tgl_efektif.split('-')[2] + '-' + result.data[0].tgl_efektif.split('-')[1] + '-' + result.data[0].tgl_efektif.split('-')[0]);

                        } else {
                            alert(result.pesan);
                        }
                    }
                });

                if ($(this).attr("id") == 'btn_update' && confirm('Ubah data?')) {
                    $("#judul_modal").empty().append('Edit Flow Meter');
                    $("#ini_modal").modal();
                } else {
                    $("#judul_modal").empty().append('Lihat Flow Meter');
                    $('.btn_disable').prop('disabled', true);
                    $("#ini_modal").modal();
                }
            } else if ($(this).attr("name") == 'btn_add') {
                $("#modal_form").attr("action", "<?= base_url('master/flowmeter/C_flowmeter/form/add') ?>");
                $("#mdl1_headerid").val('');
                $("#judul_modal").empty().append('Tambah Flow Meter');
                $('.btncopy').prop('disabled', true);
                $("#ini_modal").modal();
            }
        });
    });

    $(document).on('change', '.mdl1_id_dept', function() {
        let nama_dept = '';
        $(this).val() != '' ? $(".mdl1_nama_dept").val($(this).select2('data')[0].text) : '';
    });
</script>

<?php $this->load->view('template/footbarend'); ?>