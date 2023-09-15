<?php $this->load->view('template/headbar'); ?>

<?php
if ($aksi == 'aksi_add') {
    $dtkode_form    = "";
    $dtparameter    = "";
    $dtdepartemen   = "";
    $dttgl_efective = "";
} else {
    if (isset($dtheader)) {
        foreach ($dtheader as $row_header) {
            $headerid       = $row_header->headerid;
            $dtkode_form    = $row_header->form_kode;
            $dtparameter    = $row_header->parameter;
            $dtdepartemen   = $row_header->departemen;
            $dttgl_efective = date("d-m-Y", strtotime($row_header->tgl_efective));
        }
    } else {
        $dtkode_form    = "";
        $dtparameter    = "";
        $dtdepartemen   = "";
        $dttgl_efective = "";
    }
}
?>


<section class="content-header">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="mt-2 mb-1 d-flex justify-content-center">
                        <img src="<?php echo base_url('assets/images/PSG_logo_2022.png') ?>" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <h2><?php echo $this->config->item("nama_perusahaan"); ?></h2>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <h4>MASTER FORM ITEM</h4>
                    </div>

                    <div class="card-body">
                        <?php if (isset($message)) { ?>
                            <div class="alert alert-error">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Warning!</strong>
                                <?php echo $message; ?>
                            </div>
                        <?php
                        } elseif (isset($message2)) { ?>
                            <div class="alert alert-error">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Warning!</strong>
                                <?php echo $message2; ?>
                            </div>
                        <?php
                        } ?>

                        <form action="<?php echo base_url('master/item/C_form_item/form/' . $aksi) ?>" id="form_item" name="form_item" method="post" role="form" class="form-horizontal" autocomplete="off">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?php echo $headerid; ?>" id="headerid">
                                    <?php
                                    } ?>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Departemen
                                        </div>
                                        <div class="col-md-6">
                                            <select name="departemen" id="departemen" class="departemen form-control select2">
                                                <option value="">- pilih -</option>
                                                <?php if (isset($dtdept)) {
                                                    foreach ($dtdept as $dtdepartemen_row) { ?>
                                                        <option value="<?php echo $dtdepartemen_row->deptabbr; ?>" <?php if ($dtdepartemen_row->deptabbr == $dtdepartemen) {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>>
                                                            <?php echo $dtdepartemen_row->deptabbr; ?></option>
                                                <?php
                                                    }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Kode Form
                                        </div>
                                        <div class="col-md-6">
                                            <select name="dtkode_form" id="dtkode_form" class="form-control select2" required>
                                                <option value="">- pilih -</option>
                                                <?php if (isset($all_kode_form)) {
                                                    foreach ($all_kode_form as $all_kode_form_row) { ?>
                                                        <option value="<?php echo $all_kode_form_row->formnm; ?>" <?php if ($all_kode_form_row->formnm == $dtkode_form) {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>>
                                                            <?php echo $all_kode_form_row->formnm; ?></option>
                                                <?php
                                                    }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Tipe Tabel
                                        </div>
                                        <div class="col-md-6">
                                            <select name="dtparameter" id="dtparameter" class="form-control select2" required>
                                                <option value="">- pilih -</option>
                                                <option value="Tipe 1" <?php if ($dtparameter == 'Tipe 1') {
                                                                            echo 'selected';
                                                                        } ?>>Tipe 1</option>
                                                <option value="Tipe 2" <?php if ($dtparameter == 'Tipe 2') {
                                                                            echo 'selected';
                                                                        } ?>>Tipe 2</option>
                                                <option value="Tipe 3" <?php if ($dtparameter == 'Tipe 3') {
                                                                            echo 'selected';
                                                                        } ?>>Tipe 3</option>
                                                <option value="Tipe 4" <?php if ($dtparameter == 'Tipe 4') {
                                                                            echo 'selected';
                                                                        } ?>>Tipe 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-3">
                                            Tanggal Efective
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="dttgl_efective" id="dttgl_efective" class="form-control datepicker maskdate dttgl_efective" value="<?= $dttgl_efective ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h4><b>Item</b></h4>
                            <div class="row">
                                <div class="col-md-12" style="text-align:center;">
                                    <div class="table-responsive scrolly_table" id="scrolling_table_1" style="max-height: 600px;">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead class="table-primary <?= isset($headerid) ? 'sticky-top' : '' ?>">
                                                <tr>
                                                    <th></th>
                                                    <th>Item 1</th>
                                                    <th>Spesifikasi</th>
                                                    <th>Tipe Pengecekan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="TBody_a" class="dataTable">
                                                <?php if (!isset($dtdetail)) {;
                                                    if (isset($message)) {
                                                        for ($i = 0; $i < $jmldtl; $i++) { ?>
                                                            <tr>
                                                                <td valign="top"><input name="chk[]" type="checkbox" /></td>
                                                                <td><input type="text" name="item1[]" id="item1" size="20" class="form-control" value="<?php echo set_value('item1[' . $i . ']'); ?>" /></td>
                                                                <td><input type="text" name="spek1[]" id="spek1" size="20" class="form-control" value="<?php echo set_value('spek1[' . $i . ']'); ?>" /></td>
                                                                <td>
                                                                    <select name="tipe_cek1[]" id="tipe_cek1" class="tipe_cek1 form-control">
                                                                        <option value="">- Pilih -</option>
                                                                        <option value="0">Default</option>
                                                                        <option value="1">Awal Saja</option>
                                                                        <option value="2">Akhir Saja</option>
                                                                    </select>
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
                                                        <tr>
                                                            <td valign="top"><input name="chk[]" type="checkbox" /></td>
                                                            <td><input type="text" name="item1[]" id="item1" size="20" class="form-control" value="<?php $a = set_value('item1[0]');
                                                                                                                                                    echo $a; ?>" /></td>
                                                            <td><input type="text" name="spek1[]" id="spek1" size="20" class="form-control" value="<?php $a = set_value('spek1[0]');
                                                                                                                                                    echo $a; ?>" /></td>
                                                            <td>
                                                                <select name="tipe_cek1[]" id="tipe_cek1" class="tipe_cek1 form-control">
                                                                    <option value="">- Pilih -</option>
                                                                    <option value="0">Default</option>
                                                                    <option value="1">Awal Saja</option>
                                                                    <option value="2">Akhir Saja</option>
                                                                </select>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    $num_chk = -1;
                                                    foreach ($dtdetail as $detail) {
                                                        $num_chk++; ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id_1st[]" id="detail_id_1st" value="<?php echo $detail->detail_id; ?>" size="1" />
                                                            <td><input name="<?php echo 'chk[' . $num_chk . ']'; ?>" class="checkall" type="checkbox" value="<?php echo $detail->detail_id; ?>" />
                                                            </td>
                                                            <td style="text-align:left"><input name="item1[]" type="text" size="20" class="form-control" value="<?php echo $detail->item1; ?>" /></td>
                                                            <td style="text-align:left"><input name="spek1[]" type="text" size="20" class="form-control" value="<?php echo $detail->spek1; ?>" /></td>
                                                            <td style="text-align:left">
                                                                <select name="tipe_cek1[]" id="tipe_cek1" class="tipe_cek1 form-control">
                                                                    <option value="">- Pilih -</option>
                                                                    <option value="0" <?= $detail->tipe_cek1 == '0' ? 'selected' : '' ?>>Default</option>
                                                                    <option value="1" <?= $detail->tipe_cek1 == '1' ? 'selected' : '' ?>>Awal Saja</option>
                                                                    <option value="2" <?= $detail->tipe_cek1 == '2' ? 'selected' : '' ?>>Akhir Saja</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn_kategori_b btn bg-gradient-info btn-md" id="btn_kategori_b" value="<?php echo $detail->detail_id; ?>">Item - 2</button>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot class="table-primary">
                                                <tr>
                                                    <td colspan="8" align="center">
                                                        <?php if (!isset($dtdetail)) { ?>
                                                            <button type="button" class="btn bg-gradient-info btn-md" onClick="addRow('TBody_a')">Tambah Baris</button>
                                                            <button type="button" class="btn bg-gradient-warning btn-md" onClick="deleteRow('TBody_a')">Hapus Baris</button>
                                                        <?php
                                                        } else { ?>
                                                            <button type="button" class="btn bg-gradient-info btn-md" onClick="addRow('TBody_a')">Tambah Baris</button>
                                                            <button type="button" class="btn bg-gradient-success btn-md" onClick="InsertRow('TBody_a')">Sisip Baris</button>
                                                            <button type="button" class="btn bg-gradient-warning btn-md" onClick="deleteRow('TBody_a')">Hapus Baris</button>
                                                            <button type="button" class="btn bg-gradient-danger btn-md" name="btndelete" id="btndelete">Hapus Data</button>
                                                        <?php
                                                        } ?>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.row-->
                            <!-- tabel view Item - 2 -->
                            <br>
                            <h4><b>Item - 2</b></h4>
                            <div class="row">
                                <div class="col-md-12" style="text-align:center;">
                                    <div class="table-responsive scrolly_table" id="scrolling_table_2" style="max-height: 600px;">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead class="table-primary sticky-top">
                                                <tr>
                                                    <th>Item 1</th>
                                                    <th>Item 2</th>
                                                    <th>Spesifikasi</th>
                                                    <th>Tipe Pengecekan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="TBody" class="dataTable">
                                                <?php if (isset($dtdetail2)) {
                                                    $num_chk_b = -1;
                                                    foreach ($dtdetail2 as $detail2) {
                                                        $num_chk_b++; ?>
                                                        <tr>
                                                            <td style="text-align:left"><?= $detail2->item1_dtl; ?></td>
                                                            <td style="text-align:left"><?= $detail2->item2_dtl_b; ?></td>
                                                            <td style="text-align:left"><?= $detail2->spek2; ?></td>
                                                            <td style="text-align:center">
                                                                <?php if ($detail2->tipe_cek2 == '0') {
                                                                    echo 'Default';
                                                                } else if ($detail2->tipe_cek2 == '1') {
                                                                    echo 'Awal Saja';
                                                                } else if ($detail2->tipe_cek2 == '2') {
                                                                    echo 'Akhir Saja';
                                                                } ?></td>
                                                            <td>
                                                                <button type="button" class="btn_kategori_c btn bg-gradient-info btn-md" id="btn_kategori_c" value="<?= $detail2->detail_id_b; ?>">Item - 3</button>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot class="table-primary">
                                                <tr>
                                                    <td colspan="8"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end table Item - 2 -->
                            <!-- tabel view Item - 3 -->
                            <br>
                            <h4><b>Item - 3</b></h4>
                            <div class="row">
                                <div class="col-md-12" style="text-align:center;">
                                    <div class="table-responsive scrolly_table" id="freeze_1" style="max-height: 600px;">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead class="table-primary sticky-top">
                                                <tr>
                                                    <th>Item 1</th>
                                                    <th>Item 2</th>
                                                    <th>Item 3</th>
                                                    <th>Spesifikasi</th>
                                                    <th>Tipe Pengecekan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="TBody" class="dataTable">
                                                <?php if (isset($dtdetail3)) {
                                                    $num_chk_c = -1;
                                                    foreach ($dtdetail3 as $detail3) {
                                                        $num_chk_c++; ?>
                                                        <tr>
                                                            <td style="text-align:left"><?php echo $detail3->item1_dtl; ?></td>
                                                            <td style="text-align:left"><?php echo $detail3->item2_dtl_b; ?></td>
                                                            <td style="text-align:left"><?php echo $detail3->item3_dtl_c; ?></td>
                                                            <td style="text-align:left"><?php echo $detail3->spek3; ?></td>
                                                            <td style="text-align:center">
                                                                <?php if ($detail3->tipe_cek3 == '0') {
                                                                    echo 'Default';
                                                                } else if ($detail3->tipe_cek3 == '1') {
                                                                    echo 'Awal Saja';
                                                                } else if ($detail3->tipe_cek3 == '2') {
                                                                    echo 'Akhir Saja';
                                                                } ?></td>
                                                            <td>
                                                                <button type="button" class="btn_kategori_d btn bg-gradient-info btn-md" id="btn_kategori_d" value="<?= $detail3->detail_id_c; ?>">Item - 4</button>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot class="table-primary">
                                                <tr>
                                                    <td colspan="8"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end table Item - 3 -->
                            <!-- tabel view Item - 3 -->
                            <br>
                            <h4><b>Item - 4</b></h4>
                            <div class="row">
                                <div class="col-md-12" style="text-align:center;">
                                    <div class="table-responsive scrolly_table" id="freeze_2" style="max-height: 600px;">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead class="table-primary sticky-top">
                                                <tr>
                                                    <th>Item 1</th>
                                                    <th>Item 2</th>
                                                    <th>Item 3</th>
                                                    <th>Item 4</th>
                                                    <th>Spesifikasi</th>
                                                    <th>Tipe Pengecekan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="TBody" class="dataTable">
                                                <?php if (isset($dtdetail4)) {
                                                    $num_chk_d = -1;
                                                    foreach ($dtdetail4 as $detail4) {
                                                        $num_chk_d++; ?>
                                                        <tr>
                                                            <td style="text-align:left"><?= $detail4->item1_dtl; ?></td>
                                                            <td style="text-align:left"><?= $detail4->item2_dtl_b; ?></td>
                                                            <td style="text-align:left"><?= $detail4->item3_dtl_c; ?></td>
                                                            <td style="text-align:left"><?= $detail4->item4_dtl_d; ?></td>
                                                            <td style="text-align:left"><?= $detail4->spek4; ?></td>
                                                            <td style="text-align:center">
                                                                <?php if ($detail4->tipe_cek4 == '0') {
                                                                    echo 'Default';
                                                                } else if ($detail4->tipe_cek4 == '1') {
                                                                    echo 'Awal Saja';
                                                                } else if ($detail4->tipe_cek4 == '2') {
                                                                    echo 'Akhir Saja';
                                                                } ?></td>
                                                            <td>
                                                                <button type="button" class="btn_kategori_e btn bg-gradient-info btn-md" id="btn_kategori_e" value="<?= $detail4->detail_id_d; ?>">Item - 5</button>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot class="table-primary">
                                                <tr>
                                                    <td colspan="8"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end table Item - 3 -->
                            <!-- tabel view Item - 4 -->
                            <br>
                            <?php if (isset($dtdetail5)) { ?>
                                <h4><b>List Item</b></h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive scrolly_table" id="freeze_3" style="max-height: 600px;">
                                            <table class="table table-bordered table-striped" border="6">
                                                <thead class="bg-gradient-primary sticky-top">
                                                    <tr>
                                                        <th class="align-middle text-center" colspan="8">List Item <?php //echo $dtkode_form; 
                                                                                                                    ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle text-center">No.</th>
                                                        <th class="align-middle text-center">Item 1</th>
                                                        <th class="align-middle text-center">Item 2</th>
                                                        <th class="align-middle text-center">Item 3</th>
                                                        <th class="align-middle text-center">Item 4</th>
                                                        <th class="align-middle text-center">Item 5</th>
                                                        <th class="align-middle text-center">Spesifikasi</th>
                                                        <th class="align-middle text-center">Tipe Pengecekan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php $no = 1;
                                                    foreach ($dtdetail5 as $detail5) {
                                                        if ($detail5->detail_id_e != '') {
                                                            $spek       = $detail5->spek5;
                                                            $tipe_cek   = $detail5->tipe_cek5;
                                                        } else if ($detail5->detail_id_d != '') {
                                                            $spek       = $detail5->spek4;
                                                            $tipe_cek   = $detail5->tipe_cek4;
                                                        } else if ($detail5->detail_id_c != '') {
                                                            $spek       = $detail5->spek3;
                                                            $tipe_cek   = $detail5->tipe_cek3;
                                                        } else if ($detail5->detail_id_b != '') {
                                                            $spek       = $detail5->spek2;
                                                            $tipe_cek   = $detail5->tipe_cek2;
                                                        } else if ($detail5->detail_id != '') {
                                                            $spek       = $detail5->spek1;
                                                            $tipe_cek   = $detail5->tipe_cek1;
                                                        } ?>
                                                        <tr>
                                                            <td align="center"><?= $detail5->rnum == '1' ? $no++ : '' ?></td>
                                                            <td style="text-align:left"><?= $detail5->rnum == '1' ? $detail5->item1_dtl : '' ?></td>
                                                            <td style="text-align:left"> <?= $detail5->rnum2 == '1' ? $detail5->item2_dtl_b : '' ?></td>
                                                            <td style="text-align:left"> <?= $detail5->rnum3 == '1' ? $detail5->item3_dtl_c : '' ?></td>
                                                            <td style="text-align:left"> <?= $detail5->rnum4 == '1' ? $detail5->item4_dtl_d : '' ?></td>
                                                            <td style="text-align:left"> <?= $detail5->rnum5 == '1' ? $detail5->item5_dtl_e : '' ?></td>
                                                            <td style="text-align:left"> <?= $spek ?>
                                                            </td>
                                                            <td style="text-align:center">
                                                                <?php if ($tipe_cek == '0') {
                                                                    echo 'Default';
                                                                } else if ($tipe_cek == '1') {
                                                                    echo 'Awal Saja';
                                                                } else if ($tipe_cek == '2') {
                                                                    echo 'Akhir Saja';
                                                                } ?>
                                                            </td>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    } ?>
                                                </tbody>
                                                <tfoot class="bg-gradient-primary">
                                                    <tr>
                                                        <td colspan="8"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div> <!-- end table Item - 3 -->
                            <?php
                            } ?>
                            <div class="box-footer">
                                <div align="left">
                                    <?php if (!isset($dtheader)) { ?>
                                        <button type="submit" class="btn bg-gradient-primary btn-md">Simpan</button>
                                        <button type="reset" class="btn bg-gradient-dark btn-md" onclick="location.href='<?php echo base_url('master/item/C_form_item/form/add') ?>'">Batal</button>
                                    <?php
                                    } else { ?>
                                        <button type="submit" class="btn bg-gradient-primary btn-md" name="btnproses" value="btnupdate" onclick="return confirm('Simpan Data ?')">Simpan</button>
                                        <button type="button" class="btn bg-gradient-success btn-md" name="btnproses" id="btncopy" value="btncopy">Salin</button>
                                        <button type="reset" class="btn bg-gradient-dark btn-md" onclick="location.href='<?php echo base_url('master/item/C_form_item/form/add') ?>'">Batal</button>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.columnbox-primary-->
            </div><!-- /.col-->
        </div><!-- /.row -->
</section><!-- /.content -->

<!-- start modal tambah Item - 2 -->
<div class="modal fade bd-example-modal-xl" id="SpecModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <form class="form-horizontal" role="form" action="" name="form_modal" id="form_modal" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah/Ubah Data Item - 2</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="modal_headerid" id="modal_headerid" class="form-control" value="" />
                            <input type="hidden" name="modal_detail_id_a" id="modal_detail_id_a" class="form-control" value="" />
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="align-middle text-center"></th>
                                            <th class="align-middle text-center">Item</th>
                                            <th class="align-middle text-center">Item - 2</th>
                                            <th class="align-middle text-center">Spesifikasi</th>
                                            <th class="align-middle text-center">Tipe Pengecekan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_spec_modal">
                                    </tbody>
                                    <tfoot align="center" class="table-primary">
                                        <tr>
                                            <td colspan="8">
                                                <button type="button" class="btn bg-gradient-info btn-md" onClick="addRow('tbody_spec_modal')">Tambah Baris</button>
                                                <button type="button" class="btn bg-gradient-success btn-md" onClick="InsertRow('tbody_spec_modal')">Sisip Baris</button>
                                                <button type="button" class="btn bg-gradient-warning btn-md" onClick="deleteRow('tbody_spec_modal')">Hapus Baris</button>
                                                <button type="button" name="btnmodal_save" id="btnmodal_delete" value="btnmodal_delete" class="btnmodal_save btn bg-gradient-danger btn-md">Hapus
                                                    Data</button>
                                            </td>
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
<!-- end modal tambah Item - 2 -->

<!-- start modal tambah Item - 3 -->
<div class="modal fade bd-example-modal-xl" id="SpecModalc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <form class="form-horizontal" role="form" action="" name="form_modal_c" id="form_modal_c" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah/Ubah Data Item - 3</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="modal_headerid_c" id="modal_headerid_c" class="form-control" value="" />
                            <input type="hidden" name="modal_detail_id_b" id="modal_detail_id_b" class="form-control" value="" />
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="align-middle text-center"></th>
                                            <th class="align-middle text-center">Item</th>
                                            <th class="align-middle text-center">Item - 2</th>
                                            <th class="align-middle text-center">Item - 3</th>
                                            <th class="align-middle text-center">Spesifikasi</th>
                                            <th class="align-middle text-center">Tipe Pengecekan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_spec_modalc">
                                    </tbody>
                                    <tfoot align="center" class="table-primary">
                                        <tr>
                                            <td colspan="8">
                                                <button type="button" class="btn bg-gradient-info btn-md" onClick="addRow('tbody_spec_modalc')">Tambah Baris</button>
                                                <button type="button" class="btn bg-gradient-warning btn-md" onClick="deleteRow('tbody_spec_modalc')">Hapus Baris</button>
                                                <button type="button" name="btnmodal_save_c" id="btnmodal_delete_c" value="btnmodal_delete_c" class="btnmodal_save_c btn bg-gradient-danger btn-md">Hapus
                                                    Data</button>
                                            </td>
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
                    <button type="button" name="btnmodal_save_c" id="btnmodal_save_c" value="btnmodal_save_c" class="btnmodal_save_c btn bg-gradient-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal tambah Item - 3 -->

<!-- start modal tambah Item - 3 -->
<div class="modal fade bd-example-modal-xl" id="SpecModald" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <form class="form-horizontal" role="form" action="" name="form_modal_d" id="form_modal_d" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah/Ubah Data Item - 3</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="modal_headerid_d" id="modal_headerid_d" class="form-control" value="" />
                            <input type="hidden" name="modal_detail_id_c" id="modal_detail_id_c" class="form-control" value="" />
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="align-middle text-center"></th>
                                            <th class="align-middle text-center">Item</th>
                                            <th class="align-middle text-center">Item - 2</th>
                                            <th class="align-middle text-center">Item - 3</th>
                                            <th class="align-middle text-center">Item - 4</th>
                                            <th class="align-middle text-center">Spesifikasi</th>
                                            <th class="align-middle text-center">Tipe Pengecekan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_spec_modald">
                                    </tbody>
                                    <tfoot align="center" class="table-primary">
                                        <tr>
                                            <td colspan="8">
                                                <button type="button" class="btn bg-gradient-info btn-md" onClick="addRow('tbody_spec_modald')">Tambah Baris</button>
                                                <button type="button" class="btn bg-gradient-warning btn-md" onClick="deleteRow('tbody_spec_modald')">Hapus Baris</button>
                                                <button type="button" name="btnmodal_save_d" id="btnmodal_delete_d" value="btnmodal_delete_d" class="btnmodal_save_d btn bg-gradient-danger btn-md">Hapus
                                                    Data</button>
                                            </td>
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
                    <button type="button" name="btnmodal_save_d" id="btnmodal_save_d" value="btnmodal_save_d" class="btnmodal_save_d btn bg-gradient-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal tambah Item - 3 -->

<!-- start modal tambah Item - 4 -->
<div class="modal fade bd-example-modal-xl" id="SpecModale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <form class="form-horizontal" role="form" action="" name="form_modal_e" id="form_modal_e" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah/Ubah Data Item - 4</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="modal_headerid_e" id="modal_headerid_e" class="form-control" value="" />
                            <input type="hidden" name="modal_detail_id_d" id="modal_detail_id_d" class="form-control" value="" />
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="align-middle text-center"></th>
                                            <th class="align-middle text-center">Item</th>
                                            <th class="align-middle text-center">Item - 2</th>
                                            <th class="align-middle text-center">Item - 3</th>
                                            <th class="align-middle text-center">Item - 4</th>
                                            <th class="align-middle text-center">Item - 5</th>
                                            <th class="align-middle text-center">Spesifikasi</th>
                                            <th class="align-middle text-center">Tipe Pengecekan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_spec_modale">
                                    </tbody>
                                    <tfoot align="center" class="table-primary">
                                        <tr>
                                            <td colspan="8">
                                                <button type="button" class="btn bg-gradient-info btn-md" onClick="addRow('tbody_spec_modale')">Tambah Baris</button>
                                                <button type="button" class="btn bg-gradient-warning btn-md" onClick="deleteRow('tbody_spec_modale')">Hapus Baris</button>
                                                <button type="button" name="btnmodal_save_d" id="btnmodal_delete_d" value="btnmodal_delete_e" class="btnmodal_save_d btn bg-gradient-danger btn-md">Hapus
                                                    Data</button>
                                            </td>
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
                    <button type="button" name="btnmodal_save_e" id="btnmodal_save_e" value="btnmodal_save_e" class="btnmodal_save_e btn bg-gradient-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal tambah Item - 4 -->
<?php $this->load->view('template/footbar'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#btndelete').click(function() {
            var action_url = '<?php echo base_url('master/item/C_form_item/form/aksi_delete') ?>';
            $("#form_item").attr('action', action_url);
            $("#form_item").closest('form').submit();
        });

        $('#btncopy').click(function() {
            if (confirm('Salin Data ?')) {
                var action_url = '<?php echo base_url('master/item/C_form_item/form/aksi_copy') ?>';
                $("#form_item").attr('action', action_url);
                $("#form_item").closest('form').submit();
            }
        });

        $(document).on('click', '.btn_kategori_b', function() {
            var that = $(this);

            var headerid = $("#headerid").val();
            var detail_id = $(this).val();

            if (detail_id.trim() == '') {
                alert("Maaf Data belum disimpan..!!");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>index.php/master/item/C_form_item/getdetail_spec",
                    data: {
                        headerid,
                        detail_id,
                    },
                    success: function(datas) {
                        $("#tbody_spec_modal").empty();

                        var datan = datas.split("//");
                        $("#modal_headerid").val(datan[0]);
                        $("#modal_detail_id_a").val(datan[1]);
                        $('#tbody_spec_modal').append(datan[2]);
                        $("#Modal1").modal();
                    }
                });
            }

            $("#SpecModal").modal();
        });

        //modal C
        $(document).on('click', '.btn_kategori_c', function() {
            var that = $(this);

            var headerid = $("#headerid").val();
            var detail_id_b = $(this).val();

            if (detail_id_b.trim() == '') {
                alert("Maaf Data belum disimpan..!!");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>index.php/master/item/C_form_item/getdetail_spec_c",
                    data: {
                        headerid,
                        detail_id_b,
                    },
                    success: function(datas_c) {
                        $("#tbody_spec_modalc").empty();

                        var datan = datas_c.split("//");
                        $("#modal_headerid_c").val(datan[0]);
                        $("#modal_detail_id_b").val(datan[1]);
                        $('#tbody_spec_modalc').append(datan[2]);
                        $("#Modal2").modal();
                    }
                });
            }
            $("#SpecModalc").modal();
        });

        //modal d
        $(document).on('click', '.btn_kategori_d', function() {
            var that = $(this);

            var headerid = $("#headerid").val();
            var detail_id_c = $(this).val();

            if (detail_id_c.trim() == '') {
                alert("Maaf Data belum disimpan..!!");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>index.php/master/item/C_form_item/getdetail_spec_d",
                    data: {
                        headerid,
                        detail_id_c,
                    },
                    success: function(datas_d) {
                        console.log(datas_d);
                        $("#tbody_spec_modald").empty();

                        var datan = datas_d.split("//");
                        $("#modal_headerid_d").val(datan[0]);
                        $("#modal_detail_id_c").val(datan[1]);
                        $('#tbody_spec_modald').append(datan[2]);
                        $("#Modal3").modal();
                    }
                });
            }
            $("#SpecModald").modal();
        });

        //modal e
        $(document).on('click', '.btn_kategori_e', function() {
            var that = $(this);

            var headerid = $("#headerid").val();
            var detail_id_d = $(this).val();

            if (detail_id_d.trim() == '') {
                alert("Maaf Data belum disimpan..!!");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>index.php/master/item/C_form_item/getdetail_spec_e",
                    data: {
                        headerid,
                        detail_id_d,
                    },
                    success: function(datas_e) {
                        console.log(datas_e);
                        $("#tbody_spec_modale").empty();

                        var datan = datas_e.split("//");
                        $("#modal_headerid_e").val(datan[0]);
                        $("#modal_detail_id_d").val(datan[1]);
                        $('#tbody_spec_modale').append(datan[2]);
                        $("#Modal4").modal();
                    }
                });
            }
            $("#SpecModale").modal();
        });

        //button save modal B
        $(".btnmodal_save").click(function(e) {

            var valbutton = $(this).attr("value");

            Swal.fire({
                title: 'Are you sure?',
                text: valbutton == "btnmodal_save" ? "Simpan Data" : "Hapus Data",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/master/item/C_form_item/save_kategori_b",
                        type: 'POST',
                        data: $("#form_modal").find("select, textarea, input").serialize() + "&valbutton=" +
                            valbutton,
                        success: function(pesan) {
                            Swal.fire({
                                title: pesan,
                                icon: 'info',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.reload();
                            })
                        },
                        error: function() {
                            notif_btnconfirm_custom("error", "Aksi gagal, silahkan hubungi administrator!")
                            alert("Fail")
                        }
                    });
                }
            })

            e.preventDefault(); // could also use: return false;
        });

        //button save modal C
        $(".btnmodal_save_c").click(function(e) {
            var valbutton = $(this).attr("value");

            Swal.fire({
                title: 'Are you sure?',
                text: valbutton == "btnmodal_save_c" ? "Simpan Data" : "Hapus Data",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/master/item/C_form_item/save_kategori_c",
                        type: 'POST',
                        data: $("#form_modal_c").find("select, textarea, input").serialize() +
                            "&valbutton=" + valbutton,
                        success: function(pesan) {
                            Swal.fire({
                                title: pesan,
                                icon: 'info',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.reload();
                            })
                        },
                        error: function() {
                            notif_btnconfirm_custom("error", "Aksi gagal, silahkan hubungi administrator!")
                            alert("Fail")
                        }
                    });
                }
            });

            e.preventDefault(); // could also use: return false;
        });

        //button save modal d
        $(".btnmodal_save_d").click(function(e) {
            var valbutton = $(this).attr("value");

            Swal.fire({
                title: 'Are you sure?',
                text: valbutton == "btnmodal_save_d" ? "Simpan Data" : "Hapus Data",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/master/item/C_form_item/save_kategori_d",
                        type: 'POST',
                        data: $("#form_modal_d").find("select, textarea, input").serialize() +
                            "&valbutton=" + valbutton,
                        success: function(pesan) {
                            Swal.fire({
                                title: pesan,
                                icon: 'info',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.reload();
                            })
                        },
                        error: function() {
                            notif_btnconfirm_custom("error", "Aksi gagal, silahkan hubungi administrator!")
                            alert("Fail")
                        }
                    });
                }
            });
            e.preventDefault(); // could also use: return false;
        });

        //button save modal e
        $(".btnmodal_save_e").click(function(e) {
            var valbutton = $(this).attr("value");

            Swal.fire({
                title: 'Are you sure?',
                text: valbutton == "btnmodal_save_e" ? "Simpan Data" : "Hapus Data",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/master/item/C_form_item/save_kategori_e",
                        type: 'POST',
                        data: $("#form_modal_e").find("select, textarea, input").serialize() +
                            "&valbutton=" + valbutton,
                        success: function(pesan) {
                            Swal.fire({
                                title: pesan,
                                icon: 'info',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.reload();
                            })
                        },
                        error: function() {
                            notif_btnconfirm_custom("error", "Aksi gagal, silahkan hubungi administrator!")
                            alert("Fail")
                        }
                    });
                }
            });

            e.preventDefault(); // could also use: return false;
        });
    });

    //bloking select option header, isset headerid
    $('#dtform_jenis').mousedown(function() {
        var headerid = $("#headerid").val();
        if (headerid.trim() != "") {
            $('#dtform_jenis > option').each(function() {
                if (!this.selected) {
                    $(this).attr('disabled', true);
                }
            });
        } else {
            $("#dtform_jenis option").removeAttr('disabled', false);
        }
    });

    $('#dtkode_form').mousedown(function() {
        var headerid = $("#headerid").val();
        if (headerid.trim() != "") {
            $('#dtkode_form > option').each(function() {
                if (!this.selected) {
                    $(this).attr('disabled', true);
                }
            });
        } else {
            $("#dtkode_form option").removeAttr('disabled', false);
        }
    });
</script>

<?php $this->load->view('template/footbarend'); ?>