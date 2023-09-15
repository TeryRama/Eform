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
                                                    <a href="<?= base_url('master/meter_pembebanan/C_meteran/delete/' . $list_data_row->headerid) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN    MENGHAPUS DATA PENTING INI ... ?')"><span class="btn bg-gradient-danger feather icon-trash-2"></span></a>
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
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
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
                                        <thead style="position:sticky;top: 0; z-index: 1;">
                                            <tr>
                                                <th class="table-primary align-middle text-center"></th>
                                                <th class="table-primary align-middle text-center">KODE KWH</th>
                                                <th class="table-primary align-middle text-center">RATIO CT</th>
                                                <th class="table-primary align-middle text-center">READ CT</th>
                                                <th class="table-primary align-middle text-center">NAMA</th>
                                                <th class="table-primary align-middle text-center">PANEL INDUK</th>
                                                <th class="table-primary align-middle text-center">DEPARTEMEN (PENGGUNA)</th>
                                                <th class="table-primary align-middle text-center">STATUS BEBAN</th>
                                                <th class="table-primary align-middle text-center">BEBAN TETAP / HARI</th>
                                                <th class="table-primary align-middle text-center">BEBAN TETAP / HARI BERDASARKAN %</th>
                                                <th class="table-primary align-middle text-center">LOKASI PANEL</th>
                                                <th class="table-primary align-middle text-center">KETERANGAN</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_mdl1">
                                            <tr>
                                                <td><input name="mdl1_chk[]" class="checkall" type="checkbox" value="" /></td>
                                                <td><input type="text" name="mdl1_kode_kwh[]" id="mdl1_kode_kwh" class="form-control mdl1_id_kode_kwh set_kosong"></td>
                                                <td><input type="text" name="mdl1_ratio_ct[]" id="mdl1_ratio_ct" class="form-control mdl1_id_ratio_ct set_kosong"></td>
                                                <td><input type="text" name="mdl1_read_ct[]" id="mdl1_read_ct" class="form-control mdl1_id_read_ct set_kosong"></td>
                                                <td><input type="text" name="mdl1_nama_meteran[]" id="mdl1_nama_meteran" class="form-control mdl1_id_nama_meteran set_kosong"></td>
                                                <td><select name="mdl1_panel_induk[]" id="mdl1_panel_induk" class="form-control mdl1_panel_induk cari_dept_info set_kosong">
                                                    <option value="">- pilih -</option>
                                                    <?php foreach ($list_panel as $list_panel_key => $list_panel_value) {
                                                        echo '<option value="' . $list_panel_value->headerid . '">' . $list_panel_value->trafo . '</option>';
                                                    } ?>
                                                    </select></td>
                                                    <td><select name="mdl1_dept_pengguna[]" id="mdl1_dept_pengguna" class="form-control mdl1_dept_pengguna cari_dept_info set_kosong">
                                                        <option value="">- pilih -</option>
                                                        <?php foreach ($list_dept as $list_dept_key => $list_dept_value) {
                                                            echo '<option value="' . $list_dept_value->headerid . '">' . $list_dept_value->dept_pengguna . '</option>';
                                                        } ?>
                                                    </select></td>
                                                    <td><select name="mdl1_status_beban[]" id="mdl1_status_beban" class="form-control mdl1_status_beban cari_dept_info set_kosong">
                                                        <option value="">- pilih -</option>
                                                        <option value="YA">YA</option>
                                                        <option value="TIDAK">TIDAK</option>
                                                    </select></td>
                                                <td><input type="text" name="mdl1_beban_tetap[]" id="mdl1_beban_tetap" class="form-control mdl1_id_beban_tetap set_kosong"></td>
                                                <td><input type="text" name="mdl1_persen_beban_tetap[]" id="mdl1_persen_beban_tetap" class="form-control mdl1_id_persen_beban_tetap set_kosong"></td>
                                                <!-- <td><input type="text" name="mdl1_panel_lokasi[]" id="mdl1_panel_lokasi" class="form-control mdl1_id_panel_lokasi set_kosong"></td>
                                                <td><input type="text" name="mdl1_keterangan[]" id="mdl1_keterangan" class="form-control mdl1_id_keterangan set_kosong"></td> -->
                                                <td><textarea class="form-control" rows="5" name="mdl1_panel_lokasi[]" id="mdl1_panel_lokasi" class="form-control mdl1_id_panel_lokasi set_kosong"></textarea></td>
                                                <td><textarea class="form-control" rows="5" name="mdl1_keterangan[]" id="mdl1_keterangan" class="form-control mdl1_id_keterangan set_kosong"></textarea></td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="table-primary align-middle text-center">
                                            <tr>
                                                <td colspan="10">
                                                    <button type="button" class="btn bg-gradient-info btn-md btn_disable" onClick="addRow('tbody_mdl1')">Tambah Baris</button>
                                                    <!-- <button type="button" class="btn bg-gradient-success btn-md btn_disable" onClick="InsertRow('tbody_mdl1')">Sisip Baris</button> -->
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
                $("#modal_form").attr("action", "<?= base_url('master/meter_pembebanan/C_meteran/form/update') ?>");
                $("#mdl1_headerid").val(headerid);

                $.ajax({
                    url: "<?php echo base_url(); ?>/master/meter_pembebanan/C_meteran/get_dt_update",
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
                                let list_opsi_dept = '';
                                let id_selected = '';
                                let list_opsi_panel = '';
                                let id_panel_selected = '';

                                $.each(<?= json_encode($list_panel) ?>, function(list_panel_key, list_panel_value) {
                                    id_selected = list_panel_value.headerid == list_dtl_row.panel_induk ? 'selected' : '';
                                    list_opsi_panel += '<option value="' + list_panel_value.headerid + '" ' + id_selected + '>' + list_panel_value.trafo + '</option>';
                                });

                                $.each(<?= json_encode($list_dept) ?>, function(list_dept_key, list_dept_value) {
                                    id_selected = list_dept_value.headerid == list_dtl_row.dept_pengguna ? 'selected' : '';
                                    list_opsi_dept += '<option value="' + list_dept_value.headerid + '" ' + id_selected + '>' + list_dept_value.dept_pengguna + '</option>';
                                });
                                var list_status_ya = list_dtl_row.status_beban == 'YA' ? 'selected' : '';
                                var list_status_tidak = list_dtl_row.status_beban == 'TIDAK' ? 'selected' : '';
                                list_dtl += `<tr>
                                                <input type="hidden" name="mdl1_detail_id[]" id="mdl1_detail_id" value="` + list_dtl_row.detail_id + `" size="1"/>
                                                <td><input name="mdl1_chk[]" class="checkall" type="checkbox" value="` + list_dtl_row.detail_id + `"/></td>]
                                                <td><input type="text" name="mdl1_kode_kwh[]" id="mdl1_kode_kwh" class="form-control mdl1_id_kode_kwh set_kosong" value="` + list_dtl_row.kode_kwh + `"></td>
                                                <td><input type="text" name="mdl1_ratio_ct[]" id="mdl1_ratio_ct" class="form-control mdl1_id_ratio_ct set_kosong" value="` + list_dtl_row.ratio_ct + `"></td>
                                                <td><input type="text" name="mdl1_read_ct[]" id="mdl1_read_ct" class="form-control mdl1_id_read_ct set_kosong" value="` + list_dtl_row.read_ct + `"></td>
                                                <td><input type="text" name="mdl1_nama_meteran[]" id="mdl1_nama_meteran" class="form-control mdl1_id_nama_meteran set_kosong" value="` + list_dtl_row.nama_meteran + `"></td>
                                                <td><select name="mdl1_panel_induk[]" id="mdl1_panel_induk" class="form-control mdl1_panel_induk cari_dept_info set_kosong">
                                                <option value="">- pilih -</option>
                                                ` + list_opsi_panel + `
                                                </select></td>
                                                <td><select name="mdl1_dept_pengguna[]" id="mdl1_dept_pengguna" class="form-control mdl1_dept_pengguna cari_dept_info set_kosong">
                                                <option value="">- pilih -</option>
                                                ` + list_opsi_dept + `
                                                </select></td>
                                                <td>
                                                    <select name="mdl1_status_beban[]" id="mdl1_status_beban" class="form-control mdl1_status_beban cari_dept_info set_kosong">
                                                        <option value="">- pilih -</option>
                                                        <option value="YA" ` + list_status_ya + `>YA</option>
                                                        <option value="TIDAK" ` + list_status_tidak + `>TIDAK</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="mdl1_beban_tetap[]" id="mdl1_beban_tetap" class="form-control mdl1_id_beban_tetap set_kosong" value="` + list_dtl_row.beban_tetap + `"></td>
                                                <td><input type="text" name="mdl1_persen_beban_tetap[]" id="mdl1_persen_beban_tetap" class="form-control mdl1_id_persen_beban_tetap set_kosong" value="` + list_dtl_row.persen_beban_tetap + `"></td>
                                                <td><textarea class="form-control" rows="5" name="mdl1_panel_lokasi[]" id="mdl1_panel_lokasi"class="form-control mdl1_id_panel_lokasi set_kosong" value="` + list_dtl_row.panel_lokasi + `">` + list_dtl_row.panel_lokasi + `</textarea></td>
                                                <td><textarea class="form-control" rows="5" name="mdl1_keterangan[]" id="mdl1_keterangan"class="form-control mdl1_id_keterangan set_kosong" value="` + list_dtl_row.keterangan + `">` + list_dtl_row.keterangan + `</textarea></td>
                                            <tr>`;
                            });
                            $('#tbody_mdl1').empty().append(list_dtl);
                        } else {
                            alert(result.pesan);
                        }
                    }
                });

                if ($(this).attr("id") == 'btn_update' && confirm('Ubah data?')) {
                    $("#judul_modal").empty().append('Edit Meteran');
                    $("#ini_modal").modal();
                } else {
                    $("#judul_modal").empty().append('Lihat Meteran');
                    $('.btn_disable').prop('disabled', true);
                    $("#ini_modal").modal();
                }
            } else if ($(this).attr("name") == 'btn_add') {
                $("#modal_form").attr("action", "<?= base_url('master/meter_pembebanan/C_meteran/form/add') ?>");
                $("#mdl1_headerid").val('');
                $("#judul_modal").empty().append('Tambah Meteran');
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