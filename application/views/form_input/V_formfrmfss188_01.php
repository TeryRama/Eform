<?php $this->load->view('template/headbar'); ?>

<?php foreach ($dtfrm as $dt_form) {
    $frmjdl       = $dt_form->formjudul;
    $frmefec      = date("d-m-Y", strtotime($dt_form->formefective));
    $frmnm        = $dt_form->formnm;
    $frmkd        = $dt_form->formkd;
    $frmvrs       = $dt_form->formversi;
    $akses_create = $dt_form->form_create;
    $akses_update = $dt_form->form_update;
    $akses_delete = $dt_form->form_delete;
    $akses_excel  = $dt_form->form_excel;
}

if (isset($dtheader)) {
    $aksi  = "dtupdate";

    foreach ($dtheader as $header) {
        $headerid       = $header->headerid;

        $comment        = $header->comment;
        $comment_by     = $header->comment_by;
        $comment_time   = $header->comment_time;
        $comment_date   = date("d-m-Y", strtotime($header->comment_date));

        $create_date    = date("d-m-Y", strtotime($header->create_date));
        $docno          = $header->docno;
        $dept           = $header->dept;
        $deptabbr       = $header->deptabbr;
        $minggu         = $header->minggu;
    }
} else if (isset($message)) {
    $aksi           = "dtsave";

    $create_date    = $dtcreate_date;
    $docno          = $dtdocno;
    $dept           = $dtdept;
    $deptabbr       = $dtdeptabbr;
    $minggu         = $dtminggu;
} else {
    $aksi           = "dtsave";
    $create_date    = date("d-m-Y", strtotime($dtcreate_date));;
    $tgl            = date("d-m-Y");
    $docno          = '';
    $dept           = '';
    $deptabbr       = '';
    $minggu         = '';
} 
$base_url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$fcpath2   = str_replace('utl/', '', FCPATH);
$style_ttd = 'style="width:130px; height:80px; background-size:100%;"';
?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="mt-2 mb-1 d-flex justify-content-center">
                        <img src="<?= base_url('assets/images/PSG_logo_2022.png') ?>" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <h2><?= $this->config->item("nama_perusahaan"); ?></h2>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <h4><?= $frmjdl; ?></h4>
                    </div>

                    <div class="card-body">
                        <?php if (isset($message)) { ?>
                            <div class="alert alert-danger mb-3" role="alert">
                                <h4 class="alert-heading">Warning!</h4>
                                <p class="mb-0">
                                    <?= $message; ?>
                                </p>
                            </div>
                        <?php } elseif (isset($message2)) { ?>
                            <div class="alert alert-danger mb-3" role="alert">
                                <h4 class="alert-heading">Warning!</h4>
                                <p class="mb-0">
                                    <?= $message2; ?>
                                </p>
                            </div>

                        <?php } elseif (isset($comment)) { ?>
                            <div class="alert alert-danger mb-3" role="alert">
                                <h4 class="alert-heading">Warning!</h4>
                                <p class="mb-0">
                                    Laporan ini Sebelumnya telah Disapprove oleh <?= $comment_by; ?>, pada
                                    <?= $comment_date; ?> <?= $comment_time; ?>, komentar : <?= $comment; ?>
                                </p>
                            </div>
                        <?php } ?>
                        <?php $this->load->view('template/V_onprocess'); ?>

                        <form action="<?= base_url('form_input/C_form' . $frmkd . '_' . $frmvrs . '/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss188" name="formfrmfss188" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
                            <div class="row mb-1">
                                <div class="col-6">

                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?= $headerid; ?>" id="headerid" class="headerid">
                                    <?php } ?>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Tanggal Laporan
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($dtheader)) { ?>
                                                <input type="text" name="create_date" id="create_date" class="form-control create_date" value="<?= $create_date; ?>" required readonly>
                                            <?php } else { ?>
                                                <input type="text" name="create_date" id="create_date" class="form-control datepicker maskdate create_date" value="<?= $create_date; ?>" required>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            No. Dokumen
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="docno" id="docno" class="form-control docno dtopen_blok" value="<?= $docno; ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Minggu
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($dtheader)) { ?>
                                                <input type="number" name="minggu" id="minggu" class="form-control minggu" value="<?= $minggu; ?>" required readonly>
                                            <?php } else { ?>
                                                <input type="number" name="minggu" id="minggu" class="form-control minggu" value="<?= $minggu; ?>" required>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Departemen
                                        </div>
                                        <div class="col-md-6">
                                            <select name="dept" id="dept" class="form-control dept dtopen_blok2 select2" required>
                                                <option value="">- Pilih -</option>
                                                 <?php if (isset($dtdept)) {
                                                    foreach ($dtdept as $dtdepartemen_row) { ?>
                                                        <option value="<?php echo $dtdepartemen_row->deptid; ?>" <?php if ($dtdepartemen_row->deptid == $dept) { echo 'selected'; } ?>><?php echo $dtdepartemen_row->deptabbr; ?></option>
                                                <?php
                                                    }
                                                } ?>
                                            </select>
                                            <input type="hidden" name="deptabbr" id="deptabbr" value="<?= $deptabbr ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- END HEADER -->

                            <div class="card-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive scrolly_table" id="scrolling_table_1">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="2"></th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Point</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Kode</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Area</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Temuan</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2">Tindakan Koreksi</th>
                                                        <th class="table-primary align-middle text-center" colspan="2">Dilakukan oleh,</th>
                                                        <th class="table-primary align-middle text-center" colspan="2">Dicek oleh,</th>
                                                        <th class="table-primary align-middle text-center" colspan="3">Diverfikasi,</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" colspan="1">Nama</th>
                                                        <th class="table-primary align-middle text-center" colspan="1">Ttd</th>
                                                        <th class="table-primary align-middle text-center" colspan="1">Nama</th>
                                                        <th class="table-primary align-middle text-center" colspan="1">Ttd</th>
                                                        <th class="table-primary align-middle text-center" colspan="1">Nama</th>
                                                        <th class="table-primary align-middle text-center" colspan="1">Ttd</th>
                                                        <th class="table-primary align-middle text-center" colspan="1">Gagal/Lulus*)</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php if (isset($dtdetail)) {
                                                        foreach ($dtdetail as $dtdetail_row) { 
                                                            $arr_pj = array('dilakukan','dicek','verfikasi');
                                                            for ($i_pj=0; $i_pj < count($arr_pj); $i_pj++) { 
                                                                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $dtdetail_row->{'pj_personalstatus_'.$arr_pj[$i_pj]} . '_' . $dtdetail_row->{'pj_personalid_'.$arr_pj[$i_pj]} . '.png')) {
                                                                    ${'pj_ttd_'.$arr_pj[$i_pj]} = '<img src="' . $base_url2 . 'utl/assets/ttd/' . $dtdetail_row->{'pj_personalstatus_'.$arr_pj[$i_pj]} . '_' . $dtdetail_row->{'pj_personalid_'.$arr_pj[$i_pj]} . '.png" ' . $style_ttd . ' alt="">';
                                                                } else if (
                                                                    $dtdetail_row->{'pj_personalstatus_'.$arr_pj[$i_pj]} == '1' && file_exists($fcpath2 . 'forviewfoto_pekerja/' . $dtdetail_row->{'pj_personalid_'.$arr_pj[$i_pj]} . '_0_0.png')
                                                                ) {
                                                                    ${'pj_ttd_'.$arr_pj[$i_pj]} = '<img src="' . $base_url2 . 'forviewfoto_pekerja/' . $dtdetail_row->{'pj_personalid_'.$arr_pj[$i_pj]} . '_0_0.png" ' . $style_ttd . ' alt="">';
                                                                } else if (
                                                                    $dtdetail_row->{'pj_personalstatus_'.$arr_pj[$i_pj]} == '2' && file_exists($fcpath2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row->{'pj_personalid_'.$arr_pj[$i_pj]} . '.png')
                                                                ) {
                                                                    ${'pj_ttd_'.$arr_pj[$i_pj]} = '<img src="' . $base_url2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row->{'pj_personalid_'.$arr_pj[$i_pj]} . '.png" ' . $style_ttd . ' alt="">';
                                                                } else {
                                                                    ${'pj_ttd_'.$arr_pj[$i_pj]} = '<img src="' . base_url('assets/images/approved.png') . '" width="85" height="85" background-size:100%;" alt="">';
                                                                }
                                                            }
                                                            ?>
                                                            <tr>
                                                                <input type="hidden" name="detail_id[]" id="detail_id" class="form-control detail_id" value="<?= $dtdetail_row->detail_id ?>">
                                                                <td align="center"><input type="checkbox" name="dlta_chk[]" id="dlta_chk" class="dlta_chk" style="text-align: center;" size="10" value="<?= $dtdetail_row->detail_id ?>"></td>
                                                                <td align="center"><select name="dtl_a_point[]" id="dtl_a_point" class="dtl_a_point form-control w-auto">
                                                                        <option value="">- Pilih -</option>
                                                                        <?php if(isset($dt_list_point)){
                                                                            foreach ($dt_list_point as $dt_list_point_row) { ?>
                                                                                <option value="<?= $dt_list_point_row->detail_id; ?>" <?= $dt_list_point_row->detail_id == $dtdetail_row->point ? "selected":""; ?>><?= $dt_list_point_row->item1; ?></option>
                                                                        <?php } } ?>
                                                                    </select>
                                                                    <input type="hidden" class="val_point" value="<?= $dtdetail_row->point ?>">
                                                                </td>
                                                                <td align="center"><select name="dtl_a_kode[]" id="dtl_a_kode" class="dtl_a_kode form-control w-auto">
                                                                    <option value="">- Pilih -</option>
                                                                    <?php 
                                                                    if(isset($dtdetail_row->kode)){
                                                                        // get item kode pakai modal
                                                                        $list_kode = $this->M_formfrmfss188_01->get_list_item2($dtdetail_row->point); 
                                                                        foreach ($list_kode as $list_kode_row) { ?>
                                                                        <option value="<?= $list_kode_row->detail_id_b ?>" <?= $list_kode_row->detail_id_b == $dtdetail_row->kode ? "selected":""; ?>><?= $list_kode_row->item2 ?></option>
                                                                    <?php } } ?>
                                                                    </select>
                                                                </td>
                                                                <td align="center"><select name="dtl_a_area[]" id="dtl_a_area" class="dtl_a_area form-control w-auto">
                                                                        <option value="">- Pilih -</option>
                                                                        <option value="WTD Baru" <?= $dtdetail_row->area=='WTD Baru' ? "selected" : ""; ?>>WTD Baru</option>
                                                                        <option value="WTD Lama" <?= $dtdetail_row->area=='WTD Lama' ? "selected" : ""; ?>>WTD Lama</option>
                                                                        <option value="Sedimen" <?= $dtdetail_row->area=='Sedimen' ? "selected" : ""; ?>>Sedimen</option>
                                                                        <option value="RO" <?= $dtdetail_row->area=='RO' ? "selected" : ""; ?>>RO</option>
                                                                        <option value="Cone Clarifier" <?= $dtdetail_row->area=='Cone Clarifier' ? "selected" : ""; ?>>Cone Clarifier</option>
                                                                    </select>
                                                                </td>
                                                                <td align="center"><textarea name="dtl_a_temuan[]" id="dtl_a_temuan" class="dtl_a_temuan form-control w-auto" row="4" col="10" onkeyup="this.value = this.value.toUpperCase()"><?= $dtdetail_row->temuan ?></textarea></td>
                                                                <td align="center"><textarea name="dtl_a_tindakan_koreksi[]" id="dtl_a_tindakan_koreksi" class="dtl_a_tindakan_koreksi form-control w-auto" row="4" col="10" onkeyup="this.value = this.value.toUpperCase()"><?= $dtdetail_row->tindakan_koreksi ?></textarea></td>
                                                                <td align="center"><select name="dtl_a_pj_id_dilakukan[]" id="dtl_a_pj_id_dilakukan" class="dtl_a_pj_id_dilakukan form-control w-auto">
                                                                    <option value="">- pilih -</option>
                                                                    <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                        <option value="<?= $list_pj_row->detail_id ?>" <?= $dtdetail_row->pj_id_dilakukan==$list_pj_row->detail_id ? "selected" : ""; ?>><?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?></option>
                                                                    <?php
                                                                    } ?>
                                                                </select></td>
                                                                <td align="center"><?= $pj_ttd_dilakukan ?></td>
                                                                <td align="center"><select name="dtl_a_pj_id_dicek[]" id="dtl_a_pj_id_dicek" class="dtl_a_pj_id_dicek form-control w-auto">
                                                                    <option value="">- pilih -</option>
                                                                    <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                        <option value="<?= $list_pj_row->detail_id ?>" <?= $dtdetail_row->pj_id_dicek==$list_pj_row->detail_id ? "selected" : ""; ?>><?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?></option>
                                                                    <?php
                                                                    } ?>
                                                                </select></td>
                                                                <td align="center"><?= $pj_ttd_dicek ?></td>
                                                                <td align="center"><select name="dtl_a_pj_id_verfikasi[]" id="dtl_a_pj_id_verfikasi" class="dtl_a_pj_id_verfikasi form-control w-auto">
                                                                    <option value="">- pilih -</option>
                                                                    <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                        <option value="<?= $list_pj_row->detail_id ?>" <?= $dtdetail_row->pj_id_verfikasi==$list_pj_row->detail_id ? "selected" : ""; ?>><?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?></option>
                                                                    <?php
                                                                    } ?>
                                                                </select></td>
                                                                <td align="center"><?= $pj_ttd_verfikasi ?></td>
                                                                <td align="center"><select name="dtl_a_gagal_lulus[]" id="dtl_a_gagal_lulus" class="dtl_a_gagal_lulus form-control w-auto">
                                                                        <option value="">- Pilih -</option>
                                                                        <option value="Gagal" <?= $dtdetail_row->gagal_lulus=='Gagal' ? "selected" : ""; ?>>Gagal</option>
                                                                        <option value="Lulus" <?= $dtdetail_row->gagal_lulus=='Lulus' ? "selected" : ""; ?>>Lulus</option>
                                                                    </select></td>
                                                            </tr>
                                                    <?php }
                                                    }else{ ?>
                                                        <tr>
                                                            <td align="center"><input type="checkbox" name="ket[]" id="ket" class="ket" style="text-align: center;" size="10" value=""></td>
                                                            <td align="center"><select name="dtl_a_point[]" id="dtl_a_point" class="dtl_a_point form-control w-auto">
                                                                    <option value="">- Pilih -</option>
                                                                </select>
                                                            </td>
                                                            <td align="center"><select name="dtl_a_kode[]" id="dtl_a_kode" class="dtl_a_kode form-control w-auto">
                                                                    <option value="">- Pilih -</option>
                                                                </select>
                                                            </td>
                                                            <td align="center"><select name="dtl_a_area[]" id="dtl_a_area" class="dtl_a_area form-control w-auto">
                                                                    <option value="">- Pilih -</option>
                                                                    <option value="WTD Baru">WTD Baru</option>
                                                                    <option value="WTD Lama">WTD Lama</option>
                                                                    <option value="Sedimen">Sedimen</option>
                                                                    <option value="RO">RO</option>
                                                                    <option value="Cone Clarifier">Cone Clarifier</option>
                                                                </select>
                                                            </td>
                                                            <td align="center"><textarea name="dtl_a_temuan[]" id="dtl_a_temuan" class="dtl_a_temuan form-control w-auto" row="4" col="10" onkeyup="this.value = this.value.toUpperCase()"></textarea></td>
                                                            <td align="center"><textarea name="dtl_a_tindakan_koreksi[]" id="dtl_a_tindakan_koreksi" class="dtl_a_tindakan_koreksi form-control w-auto" row="4" col="10" onkeyup="this.value = this.value.toUpperCase()"></textarea></td>
                                                            <td align="center"><select name="dtl_a_pj_id_dilakukan[]" id="dtl_a_pj_id_dilakukan" class="dtl_a_pj_id_dilakukan form-control w-auto">
                                                                <option value="">- pilih -</option>
                                                                <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                    <option value="<?= $list_pj_row->detail_id ?>"><?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?></option>
                                                                <?php
                                                                } ?>
                                                            </select></td>
                                                            <td align="center"></td>
                                                            <td align="center"><select name="dtl_a_pj_id_dicek[]" id="dtl_a_pj_id_dicek" class="dtl_a_pj_id_dicek form-control w-auto">
                                                                <option value="">- pilih -</option>
                                                                <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                    <option value="<?= $list_pj_row->detail_id ?>"><?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?></option>
                                                                <?php
                                                                } ?>
                                                            </select></td>
                                                            <td align="center"></td>
                                                            <td align="center"><select name="dtl_a_pj_id_verfikasi[]" id="dtl_a_pj_id_verfikasi" class="dtl_a_pj_id_verfikasi form-control w-auto">
                                                                <option value="">- pilih -</option>
                                                                <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                    <option value="<?= $list_pj_row->detail_id ?>"><?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?></option>
                                                                <?php
                                                                } ?>
                                                            </select></td>
                                                            <td align="center"></td>
                                                            <td align="center"><select name="dtl_a_gagal_lulus[]" id="dtl_a_gagal_lulus" class="dtl_a_gagal_lulus form-control w-auto">
                                                                    <option value="">- Pilih -</option>
                                                                    <option value="Gagal">Gagal</option>
                                                                    <option value="Lulus">Lulus</option>
                                                                </select></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" colspan="13" align="center">
                                                            <?php if (!isset($dtdetail)) {
                                                                if ($akses_create == '1') { ?>
                                                                    <button type="button" class="btn btn-sm bg-gradient-info btn_tbody3_sf" id="tambah_baris" onClick="addRow('tbody')">Tambah
                                                                        Baris</button>
                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody')">Hapus
                                                                        Baris</button>
                                                                <?php } else {/*No Acess Create*/
                                                                }
                                                            } else {
                                                                if ($akses_update == '1') { ?>
                                                                    <button type="button" class="btn btn-sm bg-gradient-info btn_tbody3_sf" id="tambah_baris" onClick="addRow('tbody')">Tambah
                                                                        Baris</button>
                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody')">Hapus
                                                                        Baris</button>
                                                                <?php } else {/*No Acess Update*/
                                                                }
                                                                if ($akses_delete == '1') { ?>
                                                                    <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus
                                                                        Data</button>
                                                            <?php } else {/*No Acess Delete*/
                                                                }
                                                            } ?>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?php $this->load->view('laporan/V_laporan_definisi'); ?>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <?php if (!isset($dtheader)) {
                                        if ($akses_create == '1') { ?>
                                            <button type="submit" class="btn bg-gradient-primary" id="btnsimpan">
                                                <i class="feather icon-save"></i> Simpan</button>

                                            <button type="reset" class="btn bg-gradient-light">
                                                <i class="feather icon-refresh-ccw"></i> Batal</button>
                                        <?php } else {/*No Acess Create*/
                                        }
                                    } else {
                                        // tombol sesuaikan dengan halaman shift
                                        if ($akses_update == '1') { ?>
                                            <button type="submit" class="btn bg-gradient-primary" name="btnproses" value="btnupdate" onclick="return confirm('Simpan Data ?')">
                                                <i class="feather icon-save"></i> Simpan
                                            </button>
                                            <button type="submit" class="btn bg-gradient-info" name="btnproses" value="btncomplete" onclick="return confirm('Komplit Data ?')">
                                                <i class="feather icon-check-square"></i> Komplit
                                            </button>
                                        <?php } else {/*No Acess Update*/
                                        }
                                        if ($akses_excel == '1') { ?>
                                            <a class="btn bg-gradient-success" href="<?= base_url('export_excel/C_export_toexcel_' . $frmkd . '_' . $frmvrs . '/exportxls/' . $frmkd . '/' . $frmvrs . '/' . $headerid) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
                                    <?php } else {/*No Acess Excel*/
                                        }
                                    } ?>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <span class="pull-left">Mulai Berlaku: <?= $frmefec; ?></span>
                                    <a href="?#"><span class="pull-right"><?= $frmnm . '-' . $frmvrs; ?></span></a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

<?php $this->load->view('template/footbar'); ?>

<script>
    $(window).on('load', function() {
        // $('.dtl_a_kode').trigger('change');
        $('#dept').trigger('change');
    });
    $(document).ready(function() {

        $('form').submit(function() {
            var input_headerid = $('#headerid').val();
            if (typeof(input_headerid) == "undefined") {
                $(this).find("button[type='submit']").prop('disabled', true);
            }
        });

        $('.4angkasaja').mask("0000", {
            placeholder: "0"
        });

        $(document).on('keyup', '.angkadantitik', function() {
            this.value = this.value.replace(/[^\d.]|\.(?=.*\.)/g, '');
        });

        if (typeof($('#headerid').val()) != "undefined") {
            $('.dtopen_blok').prop('readonly', true);
            $('.dtopen_blok2 > option').each(function() {
                if (!this.selected) {
                    $(this).attr('disabled', true);
                }
            });
        }
        
        get_docno();
        
        function get_docno() {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            if (typeof(input_headerid) == "undefined" && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss188_01/get_docno/frmfss188/01",
                    data: {
                        create_date
                    },
                    async: false,
                    success: function(data) {
                        $('.docno').val(JSON.parse(data)['data']);
                    }
                });
            }
        }

        $('.create_date').change(function() {
            get_docno();
        });
        $('#dept').change(function() {
            var input_headerid = $(".headerid").val();
            var create_date = $('#create_date').val();
            var dept = $(this).find("option:selected").text();
            var deptabbr = $("#deptabbr").val(dept);
            
            // jika form input
            if (typeof(input_headerid) == "undefined" && dept != '' && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss188_01/get_list_point/frmfss188/01",
                    data: {
                        create_date,
                        dept,
                    },
                    dataType: "json",
                    async: false,
                    success: function(result) {
                        let list_dtl = '';
                        let opt_selected = '';

                        if (result.status == 0) {
                            $.each(result.data, function (key_a, value_a) {
                                list_dtl += '<option value="'+value_a.detail_id+'">'+value_a.item1+'</option>';
                            })
                            $('.dtl_a_point').find('option:not(:first)').remove();
                            $('.dtl_a_point').append(list_dtl);
                        }

                        // notif_btnconfirm_custom(result.vstatus, result.pesan);
                    }
                });
            }
        });
        
        $(document).on('change', '.dtl_a_point', function() {
            let that = $(this);
            let detail_id = $(this).val();

            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss188_01/get_list_kode/frmfss188/01",
                data: {
                    detail_id
                },
                dataType: "json",
                async: false,
                success: function(result) {
                    let list_kode = '';
                    if (result.status == 0) {
                        $.each(result.data, function (key_b, value_b) {
                            list_kode += '<option value="'+value_b.detail_id_b+'">'+value_b.item2+'</option>';
                        })
                        that.closest('tr').find('.dtl_a_kode option:not(:first)').remove();
                        that.closest('tr').find('.dtl_a_kode').append(list_kode);
                    }
    
                    // notif_btnconfirm_custom(result.vstatus, result.pesan);
                }
            });
        });
    });
</script>



<?php $this->load->view('template/footbarend'); ?>