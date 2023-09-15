<?php $this->load->view('template/headbar'); ?>

<?php
if ($aksi == 'aksi_add') {
    $dtform_jenis    = "";
    $dtform_kategori = "";
    $dtkode_form     = "";
    $dtparameter     = "";
    $dttgl_efective  = "";
    $dtdepartemen  = "";
} else {
    if (isset($dtheader)) {
        foreach ($dtheader as $row_header) {
            $headerid        = $row_header->headerid;
            $dtform_jenis    = $row_header->form_jenis;
            $dtform_kategori = $row_header->form_kategori;
            $dtkode_form     = $row_header->form_kode;
            $dtparameter     = $row_header->parameter;
            $dtdepartemen     = $row_header->departemen;
            $dttgl_efective  = date("d-m-Y", strtotime($row_header->tgl_efective));
        }
    } else {
        $dtform_jenis    = "";
        $dtform_kategori = "";
        $dtkode_form     = "";
        $dtparameter     = "";
        $dtdepartemen     = "";
        $dttgl_efective  = "";
    }
}
?>

<style>
    td {
        text-align: center;
    }

    /* .select2-container {
        width: 100% !important;
    }

    .select2-search--dropdown .select2-search__field {
        width: 98%;
    } */
</style>
<section class="content-header">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
                <div class="card-content" style="text-align:center;">
                    <div class="mt-2 mb-1 d-flex justify-content-center">
                        <img src="<?php echo base_url('assets/images/PSG_logo_2022.png') ?>" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <h2><?php echo $this->config->item("nama_perusahaan"); ?></h2>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <h4 class="box-title"><?php echo 'MASTER FORM ITEM MESIN'; ?></h4>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <br>
                <div class="card-body">
                    <?php
                    if (isset($message)) {
                    ?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Warning!</strong>
                            <?php echo $message; ?>
                        </div>
                    <?php } elseif (isset($message2)) { ?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Warning!</strong>
                            <?php echo $message2; ?>
                        </div>
                    <?php } ?>



                    <form action="<?php echo base_url('master/item/C_form_item_mesin/form/' . $aksi) ?>" id="form_item" name="form_item" method="post" role="form" class="form-horizontal">
                        <?php if (isset($dtheader)) { ?>
                            <input type="hidden" name="headerid" value="<?php echo $headerid; ?>" id="headerid">
                        <?php } ?>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        Departemen
                                    </div>
                                    <div class="col-md-6">
                                        <select name="dtdepartemen" id="dtdepartemen" class="dtdepartemen form-control select2">
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
                                        Jenis Form
                                    </div>
                                    <div class="col-md-6">
                                        <select name="dtform_jenis" id="dtform_jenis" class="dtform_jenis form-control select2" required>
                                            <option value="">- pilih -</option>
                                            <?php if (isset($get_formjenis)) {
                                                foreach ($get_formjenis as $frmjenis) { ?>
                                                    <option value="<?= $frmjenis->formjnsnm; ?>" <?php if ($frmjenis->formjnsnm == $dtform_jenis) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= $frmjenis->formjnsnm; ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        Kategori Form
                                    </div>
                                    <div class="col-md-6">
                                        <select name="dtkategori_form" id="dtkategori_form" class="dtkategori_form form-control select2">
                                            <option value="">- pilih -</option>
                                            <?php
                                            if (isset($all_kategori_form)) {
                                                foreach ($all_kategori_form as $all_kategori_form_row) { ?>
                                                    <option value="<?php echo $all_kategori_form_row->formkategorinm; ?>" <?php if ($all_kategori_form_row->formkategorinm == $dtform_kategori) {
                                                                                                                                echo 'selected';
                                                                                                                            } ?>><?php echo $all_kategori_form_row->formkategorinm; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        Kode Form
                                    </div>
                                    <div class="col-md-6">
                                        <select name="dtkode_form" id="dtkode_form" class="dtkode_form form-control select2" required>
                                            <option value="">- pilih -</option>
                                            <?php
                                            if (isset($all_kode_form)) {
                                                foreach ($all_kode_form as $all_kode_form_row) { ?>
                                                    <option value="<?php echo $all_kode_form_row->formnm; ?>" <?php if ($all_kode_form_row->formnm == $dtkode_form) {
                                                                                                                    echo 'selected';
                                                                                                                } ?>><?php echo $all_kode_form_row->formnm; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
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

                        <h4><b>Header</b></h4>
                        <div class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <div class="table-responsive scrolly_table" id="scrolling_table_1" style="max-height: 600px;">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th width="3%" class="fixed freeze_vertical" rowspan="3"></th>
                                                <th width="90%" class="fixed freeze_vertical" rowspan="3">Item 1</th>
                                                <th width="7%" class="fixed freeze_vertical" rowspan="3">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="TBody_a" class="dataTable">
                                            <?php if (!isset($dtdetail)) {
                                                if (isset($message)) {
                                                    for ($i = 0; $i < $jmldtl; $i++) { ?>
                                                        <tr>
                                                            <td valign="top"><input name="chk[]" type="checkbox" /></td>
                                                            <td><input type="text" name="item1[]" id="item1" size="20" class="form-control" value="<?php echo set_value('item1[' . $i . ']'); ?>" /></td>
                                                            <td></td>
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td valign="top"><input name="chk[]" type="checkbox" /></td>
                                                        <td><input type="text" name="item1[]" id="item1" size="20" class="form-control" value=""></td>
                                                        <td></td>
                                                    </tr>
                                                <?php }
                                            } else {
                                                $num_chk = -1;
                                                foreach ($dtdetail as $detail) {
                                                    $num_chk++; ?>
                                                    <tr>
                                                        <input type="hidden" name="detail_id_1st[]" id="detail_id_1st" value="<?php echo $detail->detail_id; ?>" size="1" />
                                                        <td><input name="<?php echo 'chk[' . $num_chk . ']'; ?>" class="checkall" type="checkbox" value="<?php echo $detail->detail_id; ?>" /></td>
                                                        <td style="text-align:left"><input name="item1[]" type="text" size="20" class="form-control" value="<?php echo $detail->item1; ?>" /></td>
                                                        <td><button type="button" class="btn_kategori_b btn bg-gradient-info btn-sm waves-effect waves-light" id="btn_kategori_b"><i class="fa fa-plus-circle"></i> Item 2</button></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot class="table-primary">
                                            <tr>
                                                <td colspan="4" align="center">
                                                    <?php if (!isset($dtdetail)) { ?>
                                                        <button type="button" class="btn bg-gradient-info btn-sm waves-effect waves-light" onClick="addRow('TBody_a')">Tambah Baris</button>
                                                        <button type="button" class="btn bg-gradient-warning btn-sm waves-effect waves-light" onClick="deleteRow('TBody_a')">Hapus Baris</button>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn bg-gradient-info btn-sm waves-effect waves-light" onClick="addRow('TBody_a')">Tambah Baris</button>
                                                        <button type="button" class="btn bg-gradient-primary btn-sm waves-effect waves-light" onClick="InsertRow('TBody_a')">Sisip Baris</button>
                                                        <button type="button" class="btn bg-gradient-warning btn-sm waves-effect waves-light" onClick="deleteRow('TBody_a')">Hapus Baris</button>
                                                        <button type="button" class="btn bg-gradient-danger btn-sm waves-effect waves-light" name="btndelete" id="btndelete">Hapus Data</button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div><!-- /.row-->

                        <!-- Tabel View Item 2 -->
                        <h4><b>Sub Header</b></h4>
                        <div class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <div class="table-responsive scrolly_table" id="scrolling_table_2" style="max-height: 600px;">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th width="5%" class="fixed freeze_vertical"></th>
                                                <th width="46%" class="fixed freeze_vertical">Item 1</th>
                                                <th width="47%" class="fixed freeze_vertical">Item 2</th>
                                                <th width="10%" class="fixed freeze_vertical">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="TBody" class="dataTable">
                                            <?php if (!isset($dtdetail2)) {;
                                                if (isset($message)) {

                                                    for ($i = 0; $i < $jmldtl; $i++) { ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><input type="hidden" name="item1_b[]" id="item1_b" size="20" class="form-control" value="<?php echo set_value('item1_b[' . $i . ']'); ?>" /><?php echo set_value('item1_b[' . $i . ']'); ?></td>
                                                            <td><input type="hidden" name="item2_b[]" id="item2_b" size="20" class="form-control" value="<?php echo set_value('item2_b[' . $i . ']'); ?>" /><?php echo set_value('item2_b[' . $i . ']'); ?></td>
                                                            <td></td>
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><input type="hidden" name="item1_b[]" id="item1_b" size="20" class="form-control" value="<?php $a = set_value('item1_b[0]');
                                                                                                                                                        echo $a; ?>" /><?php $a = set_value('item1_b[0]');
                                                                                                                                                                        echo $a; ?></td>
                                                        <td><input type="hidden" name="item2_b[]" id="item2_b" size="20" class="form-control" value="<?php $a = set_value('item2_b[0]');
                                                                                                                                                        echo $a; ?>" /><?php $a = set_value('item2_b[0]');
                                                                                                                                                                        echo $a; ?></td>
                                                        <td></td>
                                                    </tr>
                                                <?php }
                                            } else {
                                                $num_chk_b = -1;
                                                foreach ($dtdetail2 as $detail2) {
                                                    $num_chk_b++; ?>
                                                    <tr>
                                                        <input type="hidden" name="detail_id_b[]" id="detail_id_b" class="detail_id_b" value="<?php echo $detail2->detail_id_b; ?>" size="1" />
                                                        <input type="hidden" name="detail_id[]" id="detail_id" class="detail_id" value="<?php echo $detail2->detail_id; ?>" />
                                                         <td>
                                                              <input name="<?php echo 'chk_b[' . $num_chk_b . ']'; ?>" class="checkall" type="checkbox" value="<?php echo $detail2->detail_id_b; ?>"/>
                                                            </td> 
                                                        <td style="text-align:left"><input name="item1_b[]" type="hidden" size="20" class="form-control" value="<?php echo $detail2->item1_dtl; ?>" /><?php echo $detail2->item1_dtl; ?></td>
                                                        <td style="text-align:left"><input name="item2_b[]" type="hidden" size="20" class="form-control" value="<?php echo $detail2->item2_dtl_b; ?>" /><?php echo $detail2->item2_dtl_b; ?></td>
                                                        <td><button type="button" class="btn_kategori_c btn bg-gradient-info btn-sm waves-effect waves-light" id="btn_kategori_c"><i class="fa fa-plus-circle"></i> Item 3</button></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot class="table-primary">
                                            <tr>
                                                <td colspan="4"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div> <!-- end Tabel View Item 2 -->
                        <!-- Tabel View Item ALL -->
                        <br>
                        <hr>
                        <h4><b>List All Item Mesin</b></h4>
                        <div class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <div class="table-responsive scrolly_table" id="freeze_3" style="max-height: 600px;">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th class="fixed freeze_vertical table-primary" colspan="6">List Item Mesin</th>
                                            </tr>
                                            <tr>
                                                <th class="fixed freeze_vertical table-primary" rowspan="3">No</th>
                                                <th class="fixed freeze_vertical table-primary" rowspan="3">Item 1</th>
                                                <th class="fixed freeze_vertical table-primary" rowspan="3">Item 2</th>
                                                <th class="fixed freeze_vertical table-primary" rowspan="3">Komponen</th>
                                                <th class="fixed freeze_vertical table-primary" rowspan="3">Item 3</th>
                                                <th class="fixed freeze_vertical table-primary" rowspan="3">Part Komponen Inactive ( NA )</th>
                                            </tr>
                                        </thead>
                                        <tbody id="TBody" class="dataTable">
                                            <?php if (isset($dtdetail5)) {
                                                $num_chk_e = 0;
                                                foreach ($dtdetail5 as $detail5) {
                                                    $num_chk_e++;
                                                    $part_komponen    = explode(",", $detail5->part_komponen);
                                                    $part_komponen_na = explode(",", $detail5->part_komponen_na);
                                            ?>
                                                    <tr>
                                                        <td><?php echo $num_chk_e; ?></td>
                                                        <td style="text-align:left"><input name="item1_e[]" type="hidden" size="20" class="form-control" value="<?php echo $detail5->item1_dtl; ?>" /><?php echo $detail5->item1_dtl; ?></td>
                                                        <td style="text-align:left"><input name="item2_e[]" type="hidden" size="20" class="form-control" value="<?php echo $detail5->item2_dtl_b; ?>" /><?php echo $detail5->item2_dtl_b; ?></td>
                                                        <td style="text-align:left"><input name="part_komponen[]" type="hidden" size="20" class="form-control" value="<?php echo $detail5->part_komponen; ?>" />
                                                            <?php
                                                            $nama_partkomponen = "";
                                                            if ($part_komponen[0] != '') {
                                                                foreach ($part_komponen as $item) {
                                                                    foreach ($dt_partkomponen as $allpartkomponen) {
                                                                        if ($item == $allpartkomponen->komponen_id) {
                                                                            if($allpartkomponen->kode_komponen != NULL || $allpartkomponen->kode_komponen != ''){
                                                                                $nama_partkomponen .= $allpartkomponen->nama_komponen ." - ".$allpartkomponen->kode_komponen . ",";
                                                                            }else{
                                                                                $nama_partkomponen .= $allpartkomponen->nama_komponen . ",";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            echo rtrim($nama_partkomponen, ","); ?>
                                                        </td>
                                                        <td style="text-align:left"><input name="item3_e[]" type="hidden" size="20" class="form-control" value="<?php echo $detail5->item3_dtl_c; ?>" /><?php echo $detail5->kode_mesin . ' - ' . $detail5->nama_mesin; ?></td>
                                                        <td style="text-align:left"><input name="part_komponen_na[]" type="hidden" size="20" class="form-control" value="<?php echo $detail5->part_komponen_na; ?>" />
                                                            <?php
                                                            $nama_partkomponen_na = "";
                                                            if ($part_komponen_na[0] != '') {
                                                                foreach ($part_komponen_na as $item) {
                                                                    foreach ($dt_partkomponen as $allpartkomponen) {
                                                                        if ($item == $allpartkomponen->komponen_id) {
                                                                            $nama_partkomponen_na .= $allpartkomponen->nama_komponen." - ".$allpartkomponen->kode_komponen . ",";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            echo rtrim($nama_partkomponen_na, ","); ?>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot class="table-primary">
                                            <tr>
                                                <td colspan="6"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div> <!-- end Tabel View Item ALL -->
                        <br>
                        <hr>
                        <div class="box-footer">
                            <div align="left">
                                <?php if (!isset($dtheader)) { ?>
                                    <button type="submit" class="btn bg-gradient-primary btn-md waves-effect waves-light">Save</button>
                                    <button type="reset" class="btn bg-gradient-success btn-md waves-effect waves-light" onclick="location.href='<?php echo base_url('master/item/C_form_item_mesin') ?>'">Cancel</button>
                                <?php } else { ?>
                                    <button type="submit" class="btn bg-gradient-primary btn-md waves-effect waves-light" name="btnproses" value="btnupdate" onclick="return confirm('Simpan Data ?')">Simpan</button>
                                    <button type="reset" class="btn bg-gradient-black btn-md waves-effect waves-light" onclick="location.href='<?php echo base_url('master/item/C_form_item_mesin') ?>'">Batal</button>
                                    <!-- <button type="submit" class="btn bg-gradient-success btn-md waves-effect waves-light" name="btnproses" id="btncopy" value="btncopy" onclick="return confirm('Salin Data ?')">Copy</button> -->
                                    <!-- <a href="<?php //echo base_url('export_excel/C_export_toexcel_'.$frmkd.'_'.$frmvrs.'/exportxls/'.$frmkd.'/'.$frmvrs.'/'.$headerid) 
                                                    ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><span class="btn btn-success glyphicon glyphicon-export"></span></a> -->
                                <?php } ?>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="clearfix"></div>
                        </div>

                </div><!-- /.box-body -->
                </form>
            </div><!-- /.columnbox-primary-->
        </div><!-- /.col-->
    </div><!-- /.row -->
</section><!-- /.content -->

<!-- start modal tambah Item 2 -->
<div class="modal fade bd-example-modal-xl" id="SpecModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <form class="form-horizontal" role="form" action="" name="form_modal" id="form_modal" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah/Ubah Data Item 2</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                                            <th></th>
                                            <th style="text-align: center;">Item 1</th>
                                            <th style="text-align: center;">Item 2</th>
                                            <th style="text-align: center;">Komponen</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_spec_modal">
                                    </tbody>
                                    <tfoot align="center" class="table-primary">
                                        <tr>
                                            <td colspan="6">
                                                <button type="button" class="btn bg-gradient-info btn-sm waves-effect waves-light" onClick="addRowselect2('tbody_spec_modal');">Tambah Baris</button>
                                                <!-- <button type="button" class="btn bg-gradient-warning btn-sm waves-effect waves-light" onClick="deleteRow('tbody_spec_modal')">Hapus Baris</button> -->
                                                <button type="button" name="btnmodal_save_b" id="btnmodal_delete_b" value="btnmodal_delete_b" class="btnmodal_save_b btn bg-gradient-danger btn-sm waves-effect waves-light" onclick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus Data</button>
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
                    <button type="button" name="btnmodal_save_b" id="btnmodal_save_b" value="btnmodal_save_b" class="btnmodal_save_b btn bg-gradient-primary" onclick="return confirm('Simpan Data ?')">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal tambah Item 2 -->

<!-- start modal tambah Item 3 -->
<div class="modal fade bd-example-modal-xl" id="SpecModalc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <form class="form-horizontal" role="form" action="" name="form_modal_c" id="form_modal_c" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Tambah/Ubah Data Item 3</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="modal_headeridc" id="modal_headeridc" class="form-control" value="" />
                            <input type="hidden" name="modal_detail_id_b" id="modal_detail_id_b" class="form-control" value="" />
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="text-center"></th>
                                            <th class="text-center">Item 1</th>
                                            <th class="text-center">Item 2</th>
                                            <th class="text-center">Item 3</th>
                                            <th class="text-center">Komponen Inactive (NA)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_spec_modalc">
                                    </tbody>
                                    <tfoot align="center" class="table-primary">
                                        <tr>
                                            <td colspan="6">
                                                <button type="button" class="btn bg-gradient-info btn-sm waves-effect waves-light" onClick="addRowselect2('tbody_spec_modalc')">Tambah Baris</button>
                                                <!-- <button type="button" class="btn bg-gradient-warning btn-sm waves-effect waves-light" onClick="deleteRow('tbody_spec_modalc')">Hapus Baris</button> -->
                                                <button type="button" name="btnmodal_save_c" id="btnmodal_delete_c" value="btnmodal_delete_c" class="btnmodal_save_c btn bg-gradient-danger btn-sm waves-effect waves-light" onclick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus Data</button>
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
                    <button type="button" name="btnmodal_save_c" id="btnmodal_save_c" value="btnmodal_save_c" class="btnmodal_save_c btn bg-gradient-primary" onclick="return confirm('Simpan Data ?')">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal tambah Item 3 -->

<?php $this->load->view('template/footbar'); ?>
<?php $this->load->view('template/footbarend'); ?>

<script type="text/javascript">
    function renderselect2() {
        $('[class*="selectaddrow"]').select2({
            placeholder: "Select Machine Name",
            allowClear: true,
            width: '100%'
        });
        $('[class*="part_komponen"]').select2({
            placeholder: "Select Part Komponen",
            allowClear: true,
            width: '100%'
        });
    }
    $(document).ready(function() {

        $('#dtform_jenis').change(function() {
            var dtform_jenis = $(this).val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>index.php/master/item/C_form_item_mesin/get_kategori_form",
                data: {
                    formjnsnm: dtform_jenis
                },
                success: function(data3) {
                    $('#dtkategori_form').html(data3);
                }
            });
        });

        $('#dtform_jenis').change(function() {
            var dtform_jenis = $(this).val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>index.php/master/item/C_form_item_mesin/get_form_code",
                data: {
                    formjnsnm: dtform_jenis
                },
                success: function(data3) {
                    $('#dtkode_form').html(data3);
                }
            });
        });

        $('#dtkategori_form').change(function() {
            var dtform_jenis = $("#dtform_jenis").val();
            var dtkategori_form = $(this).val();
            console.log(dtform_jenis, dtkategori_form);
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>index.php/master/item/C_form_item_mesin/get_form_code",
                data: {
                    formjnsnm: dtform_jenis,
                    formkategorinm: dtkategori_form
                },
                success: function(data3) {
                    $('#dtkode_form').html(data3);
                }
            });
        });

        $('#btndelete').click(function() {
            var action_url = '<?php echo base_url('master/item/C_form_item_mesin/form/aksi_delete') ?>';
            $("#form_item").attr('action', action_url);
            $("#form_item").closest('form').submit();
        });

        $(document).on('click', '.btn_kategori_b', function() {
            var that = $(this);

            var valbutton = $(this).attr("value");
            var dt_headerid = $("#headerid").val();
            var dt_dept = $("#dtdepartemen").val();

            var col_chk = that.closest('tr').find("input[class*='checkall']");
            var val_detail_id = col_chk.val();

            if (val_detail_id.trim() == '') {
                alert("Maaf Data belum disimpan..!!");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>index.php/master/item/C_form_item_mesin/getdetail_item_b",
                    dataType: "json",
                    data: {
                        headerid: dt_headerid,
                        dept: dt_dept,
                        detail_id: val_detail_id
                    },
                    success: function(datas) {
                        if (datas['dt_spec_detail_b']) {
                            var nocek = -1;
                            var tabel_b = '';
                            var a = [];
                            datas['dt_spec_detail_b'].forEach(element => {
                                nocek++;
                                if (element.detail_id_b == null) {
                                    $modal_detail_id_b = "";
                                } else {
                                    $modal_detail_id_b = element.detail_id_b;
                                }
                                if (element.item2_dtl_b == null) {
                                    $modal_item2_dtl_b = "";
                                } else {
                                    $modal_item2_dtl_b = element.item2_dtl_b;
                                }
                                tabel_b += `<tr>
                                                <td width="3%" class="text-center"><input name="modal_chk[]" type="checkbox" value="${$modal_detail_id_b}"/><input type="hidden" name="detail_id_b[]" id="detail_id_b" value="${$modal_detail_id_b}" size="1"/></td>
                                                <td width="15%" class="text-center"><input type="hidden" size="15" name="modal_item1_dtl[]" id="modal_item1_dtl" value="${element.item1_dtl}"/>${element.item1_dtl}</td>
                                                <td width="15%" class="text-center"><input type="text" size="40" name="modal_item2_dtl_b[]" class="modal_item2_dtl_b form-control" id="modal_item2_dtl_b" value="${$modal_item2_dtl_b}"/></td>
                                                <td width="67%" class="text-center"><select name="part_komponen[${nocek}][]" id="part_komponen${nocek}" class="part_komponen${nocek} form-control multiselect" multiple required="required">`;
                                if (datas['dt_partkomponen'] != null) {
                                    datas['dt_partkomponen'].forEach(element2 => {
                                        tabel_b += `<option value="${element2.komponen_id}"`;
                                        if (element.part_komponen != null) {
                                            var items = element.part_komponen.split(",");
                                            items.forEach(item => {
                                                if (element2.komponen_id == item) {
                                                    tabel_b += `selected`;
                                                }
                                            });
                                        }
                                            tabel_b += `>${element2.nama_komponen} ${element2.kode_komponen == null || element2.kode_komponen == '' ? '' : ' - '+element2.kode_komponen}</option>`;
                                    });
                                }
                                tabel_b += `</select></td></tr>`;
                            });
                            $("#tbody_spec_modal").empty();
                            $("#tbody_spec_modalc").empty();
                            $("#modal_headerid").val(datas['headerid']);
                            $("#modal_detail_id_a").val(datas['detail_id_a']);
                            $('#tbody_spec_modal').html(tabel_b);
                            renderselect2();
                            $("#Modal1").modal();
                        }
                    }
                });
            }
            $("#SpecModal").modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        //modal C
        $(document).on('click', '.btn_kategori_c', function() {
            var that = $(this);

            var valbutton = $(this).attr("value");
            var dt_headerid = $("#headerid").val();
            var dt_form_jenis = $("#dtform_jenis").val().replace("FORM ", "");

            // var col_chk         = that.closest('tr').find("input[class*='checkall']");
            var col_detail_id_a = that.closest('tr').find(".detail_id");
            var col_detail_id_b = that.closest('tr').find(".detail_id_b");

            var val_detail_id_a = col_detail_id_a.val();
            var val_detail_id_b = col_detail_id_b.val();

            if (val_detail_id_b.trim() == '') {
                alert("Maaf Data belum disimpan..!!");
            } else {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>index.php/master/item/C_form_item_mesin/getdetail_item_c",
                    dataType: "json",
                    data: {
                        headerid: dt_headerid,
                        detail_id: val_detail_id_a,
                        detail_id_b: val_detail_id_b,
                        bagian: dt_form_jenis
                    },
                    success: function(datas_c) {
                        if (datas_c['dt_spec_detail_c']) {
                            var nocek = -1;
                            var tabel_c = '';
                            datas_c['dt_spec_detail_c'].forEach(elements => {
                                nocek++;
                                if (elements.detail_id_c == null) {
                                    $modal_detail_c = "";
                                } else {
                                    $modal_detail_c = elements.detail_id_c;
                                }
                                tabel_c += `<tr>
                                                <td width="3%"><input name="modal_chk_c[]" type="checkbox" value="${$modal_detail_c}"/><input type="hidden" name="detail_id_c[]" id="detail_id_c" value="${$modal_detail_c}" size="1"/></td>
                                                <td width="15%">
                                                    <input type="hidden" size="20" name="modal_item1_dtl[]" id="modal_item1_dtl" value="${elements.item1_dtl}"/>${elements.item1_dtl}
                                                </td>
                                                <td width="15%">
                                                    <input type="hidden" size="40" name="modal_item2_dtl_b[]" id="modal_item2_dtl_b" value="${elements.item2_dtl_b}"/>${elements.item2_dtl_b}
                                                </td>
                                                <td width="30%">
                                                    <select name="modal_item3_dtl_c[]" id="selectaddrow${nocek}" class="form-control selectaddrow${nocek}" required>`;
                                tabel_c += `<option value="">- Pilih - </option>`;
                                datas_c['dt_mesin'].forEach(elements2 => {
                                    tabel_c += `<option value="${elements2.detail_id}"`;
                                    if (elements.item3_dtl_c == elements2.detail_id) {
                                        tabel_c += `selected`;
                                    }
                                    tabel_c += `>${elements2.kode_mesin} - ${elements2.nama_mesin}</option>`;
                                });
                                tabel_c += `</select></td>
                                                <td width="37%" class="text-center"><select name="part_komponen[${nocek}][]" id="part_komponen${nocek}" class="part_komponen${nocek} form-control multiselect" multiple>`;
                                if (elements.part_komponen != null) {
                                    var items = elements.part_komponen.split(",");
                                    items.forEach(elements3 => {
                                        datas_c['dt_partkomponen'].forEach(elements4 => {
                                            if (elements3 == elements4.komponen_id) {
                                                tabel_c += `<option value="${elements4.komponen_id}"`;
                                                if (elements.part_komponen_na != null) {
                                                    var items_na = elements.part_komponen_na.split(",");
                                                    items_na.forEach(item => {
                                                        if (elements3 == item) {
                                                            tabel_c += `selected`;
                                                        }
                                                    });
                                                }
                                                tabel_c += `>${elements4.nama_komponen} ${elements4.kode_komponen == null || elements4.kode_komponen == '' ? '' : ' - '+elements4.kode_komponen}</option>`;
                                            }
                                        });

                                    });
                                    tabel_c += `</select>`;
                                }
                                tabel_c += `</td></tr>`;
                            });
                            $("#tbody_spec_modal").empty();
                            $("#tbody_spec_modalc").empty();
                            $("#modal_headeridc").val(datas_c['headerid']);
                            $("#modal_detail_id_b").val(datas_c['detail_id_b']);
                            $('#tbody_spec_modalc').append(tabel_c);
                            renderselect2();
                            $("#Modal2").modal();
                        }
                    }
                });
            }
            $("#SpecModalc").modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        //button save modal B
        $(".btnmodal_save_b").click(function(e) {
            var valbutton = $(this).attr("value");
            var data055 = $("#form_modal").serialize();

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/master/item/C_form_item_mesin/save_kategori_b",
                type: 'POST',
                data: $("#form_modal").find("select, textarea, input").serialize() + "&valbutton=" + valbutton,
                success: function(pesan) {
                    alert(pesan);
                    $("#Modal1").modal('hide');
                    window.location.reload();
                },
                error: function() {
                    alert("Fail")
                }
            });
            e.preventDefault(); // could also use: return false;
        });

        //button save modal C
        $(".btnmodal_save_c").click(function(e) {
            var valbutton = $(this).attr("value");
            var data055 = $("#form_modal_c").serialize();

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/master/item/C_form_item_mesin/save_kategori_c",
                type: 'POST',
                data: $("#form_modal_c").find("select, textarea, input").serialize() + "&valbutton=" + valbutton,
                success: function(pesan) {
                    alert(pesan);
                    $("#Modal2").modal('hide');
                    window.location.reload();
                },
                error: function() {
                    alert("Fail")
                }
            });
            e.preventDefault(); // could also use: return false;
        });

    });
</script>