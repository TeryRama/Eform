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
    $frmket       = $dt_form->formket;
    $createby     = $dt_form->createby;
    $updateby     = $dt_form->updateby;
}

if (isset($dtheader)) {
    $aksi = "dtupdate";
    foreach ($dtheader as $header) {
        $headerid          = $header->headerid;
        $comment           = $header->comment;
        $comment_by        = $header->comment_by;
        $comment_time      = $header->comment_time;
        $comment_date      = date("d-m-Y", strtotime($header->comment_date));
        $create_date       = date("d-m-Y", strtotime($header->create_date));
        $docno             = $header->docno;
    }
} else if (isset($message)) {
    $aksi              = "dtsave";
    $create_date       = date("d-m-Y", strtotime($dtcreate_date));
    $docno             = '';
    $item_kimia        = '';
    $satuan            = '';
    $stock_awal        = '';
    $terima            = '';
    $terima_akum       = '';
    $pakai             = '';
    $pakai_akum        = '';
    $kirim             = '';
    $kirim_akum        = '';
    $minimum_stock     = '';
    $stock_akhir       = '';
    $ratarata_perbulan = '';
    $ratarata_perhari  = '';
    $outstanding_ppb   = '';
    $keterangan        = '';
} else {
    $aksi              = "dtsave";
    $create_date       = date("d-m-Y", strtotime($dtcreate_date));
    $docno             = '';
    $item_kimia        = '';
    $satuan            = '';
    $stock_awal        = '';
    $terima            = '';
    $terima_akum       = '';
    $pakai             = '';
    $pakai_akum        = '';
    $kirim             = '';
    $kirim_akum        = '';
    $minimum_stock     = '';
    $stock_akhir       = '';
    $ratarata_perbulan = '';
    $ratarata_perhari  = '';
    $outstanding_ppb   = '';
    $keterangan        = '';
} ?>

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
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <h4 class="alert-heading">Warning!</h4>
                                <p class="mb-0">
                                    <?= $message; ?>
                                </p>
                            </div>
                        <?php
                        } elseif (isset($message2)) { ?>
                            <div class="alert alert-danger mb-3" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <h4 class="alert-heading">Warning!</h4>
                                <p class="mb-0">
                                    <?= $message2; ?>
                                </p>
                            </div>
                        <?php
                        } elseif (isset($comment)) { ?>
                            <div class="alert alert-danger mb-3" role="alert">
                                <h4 class="alert-heading">Warning!</h4>
                                <p class="mb-0">
                                    Laporan ini Sebelumnya telah Disapprove oleh <?= $comment_by; ?>, pada
                                    <?= $comment_date; ?> <?= $comment_time; ?>, komentar : <?= $comment; ?>
                                </p>
                            </div>
                        <?php
                        } ?>
                        <div align="center">
                            <?php if ($frmket == 'In-Progress') { ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <h4 class="alert-heading">Just Info !!</h4>
                                    <strong>Eform ini Masih Dalam Prosess Development oleh <i><?= $createby; ?> </i> ( Programmer ) !!</strong>
                                </div>
                            <?php
                            } elseif ($frmket == 'Trial') {
                            ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <h4 class="alert-heading">Just Info !!</h4>
                                    <strong>Eform Ini Masih dalam Prosess Trial !!</strong>
                                </div>
                            <?php
                            } elseif ($frmket == "Modified") {
                            ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <!-- <h4 class="alert-heading">Just Info !!</h4>
                                    <strong>Eform Ini Masih Prosess Revisi oleh <i><?= $createby; ?></i> ( Programmer ) !!</strong> -->
                                    <h1 class="alert-heading">Just Info !!</h1>
                                    <h1><strong>Eform Ini Masih Prosess Revisi oleh Programmer !!</strong></h1>
                                </div>
                            <?php
                            } elseif ($frmket == 'Trial') {
                            ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <h4 class="alert-heading">Just Info !!</h4>
                                    <strong>Eform Ini Masih dalam Prosess Trial !!</strong>
                                </div>
                            <?php
                            }?>
                        </div>

                        <form action="<?= base_url('form_input/C_forminttbn020_03/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="inttbn020" name="inttbn020" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
                            <div class="row mb-1">
                                <div class="col-6">
                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?= $headerid; ?>" id="headerid" class="headerid">
                                    <?php
                                    } ?>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Tanggal
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
                                            Dokumen
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="docno" id="docno" class="form-control docno dtopen_blok" value="<?= $docno; ?>" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="table-primary align-middle text-center" rowspan="2">No</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">ITEM BAHAN KIMIA</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">Satuan</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">Stock Awal</th>
                                                    <th class="table-primary align-middle text-center" colspan="6">HARI INI</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">Minimum Stock</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">STOCK AKHIR</th>
                                                    <th class="table-primary align-middle text-center bulan" rowspan="2"></th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">Pemakaian Rata-Rata Perhari</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">Outstanding <br> PPB</th>
                                                    <th class="table-primary align-middle text-center" rowspan="2">KET</th>
                                                </tr>
                                                <tr>
                                                    <th class="table-primary align-middle text-center">TERIMA</th>
                                                    <th class="table-primary align-middle text-center">Akum</th>
                                                    <th class="table-primary align-middle text-center">PAKAI</th>
                                                    <th class="table-primary align-middle text-center">Akum</th>
                                                    <th class="table-primary align-middle text-center">KIRIM</th>
                                                    <th class="table-primary align-middle text-center">Akum</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_dtl">
                                                <?php if (!isset($dtdetail)) {
                                                    if (isset($message)) {
                                                        for ($i = 0; $i < $jmldtl; $i++) {
                                                            $id_item = set_value('detail_id_item[' . $i . ']');
                                                            if (($id_item == 120) || ($id_item == 121) || ($id_item == 122)) {
                                                                $readonly = 'readonly';
                                                                $collor = 'background-color: #D5D8DC;';
                                                                $minimum_stock = '';
                                                                $outstanding_ppb = '';
                                                            } else {
                                                                $readonly = '';
                                                                $collor = '';
                                                                $minimum_stock = set_value('minimum_stock[' . $i . ']');
                                                                $outstanding_ppb = set_value('outstanding_ppb[' . $i . ']');
                                                            }

                                                ?>
                                                            <tr>
                                                                <input type="hidden" class="detail_id_item" name="detail_id_item[]" id="detail_id_item" value="<?php echo set_value('detail_id_item[' . $i . ']'); ?>">
                                                                <td>
                                                                    <input type="text" class="form-control lign-middle w-auto text-left item_kimia" name="item_kimia[]" id="item_kimia" style="text-align: center;" value="<?php echo set_value('item_kimia[' . $i . ']'); ?>" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto satuan" name="satuan[]" id="satuan" style="text-align: center;" size="1" value="<?php echo set_value('satuan[' . $i . ']'); ?>" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto stock_awal hitung_stock_akhir" name="stock_awal[]" id="stock_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo set_value('stock_awal[' . $i . ']'); ?>" <?= $readonly; ?>>
                                                                    <input type="hidden" class="stock_awal_awal" name="stock_awal_awal[]" id="stock_awal_awal" value="<?php echo set_value('stock_awal[' . $i . ']'); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto terima hitung_stock_akhir hitung_outstanding_ppb" name="terima[]" id="terima" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo set_value('terima[' . $i . ']'); ?>" <?= $readonly; ?>>
                                                                    <input type="hidden" class="terima_awal" name="terima_awal[]" id="terima_awal" value="<?php echo set_value('terima[' . $i . ']'); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto terima_akum" name="terima_akum[]" id="terima_akum" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo set_value('terima_akum[' . $i . ']'); ?>" readonly>
                                                                    <input type="hidden" class="terima_akum_awal" name="terima_akum_awal[]" id="terima_akum_awal" value="<?php echo set_value('terima_akum[' . $i . ']'); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto pakai hitung_stock_akhir hitung_ratarata_pakai" name="pakai[]" id="pakai" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo set_value('pakai[' . $i . ']'); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto pakai_akum" name="pakai_akum[]" id="pakai_akum" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo set_value('pakai_akum[' . $i . ']'); ?>" readonly>
                                                                    <input type="hidden" class="pakai_akum_awal" name="pakai_akum_awal[]" id="pakai_akum_awal" value="<?php echo set_value('pakai_akum[' . $i . ']'); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto kirim hitung_stock_akhir" name="kirim[]" id="kirim" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo set_value('kirim[' . $i . ']'); ?>" <?= $readonly; ?>>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto kirim_akum" name="kirim_akum[]" id="kirim_akum" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo set_value('kirim_akum[' . $i . ']'); ?>" readonly>
                                                                    <input type="hidden" class="kirim_akum_awal" name="kirim_akum_awal[]" id="kirim_akum_awal" value="<?php echo set_value('kirim_akum[' . $i . ']'); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto minimum_stock hitung_minimum_stock" name="minimum_stock[]" id="minimum_stock" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo $minimum_stock; ?>" <?= $readonly; ?>>
                                                                    <input type="hidden" class="minimum_stock_awal" name="minimum_stock_awal[]" id="minimum_stock_awal" value="<?php echo set_value('minimum_stock[' . $i . ']'); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto stock_akhir" name="stock_akhir[]" id="stock_akhir" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo set_value('stock_akhir[' . $i . ']'); ?>" readonly>
                                                                    <input type="hidden" class="stock_akhir_awal" name="stock_akhir_awal[]" id="stock_akhir_awal" value="<?php echo set_value('stock_akhir[' . $i . ']'); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto ratarata_perbulan" name="ratarata_perbulan[]" id="ratarata_perbulan" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo set_value('ratarata_perbulan[' . $i . ']'); ?>">
                                                                    <!-- <input type="hidden" class="ratarata_perbulan_awal" name="ratarata_perbulan_awal[]" id="ratarata_perbulan_awal" value="<?php echo set_value('ratarata_perbulan[' . $i . ']'); ?>"> -->
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto ratarata_perhari" name="ratarata_perhari[]" id="ratarata_perhari" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo set_value('ratarata_perhari[' . $i . ']'); ?>" readonly>
                                                                    <input type="hidden" class="ratarata_perhari_awal" name="ratarata_perhari_awal[]" id="ratarata_perhari_awal" value="<?php echo set_value('ratarata_perhari[' . $i . ']'); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto outstanding_ppb" name="outstanding_ppb[]" id="outstanding_ppb" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo $outstanding_ppb; ?>" <?= $readonly; ?>>
                                                                    <input type="hidden" class="outstanding_ppb_awal" name="outstanding_ppb_awal[]" id="outstanding_ppb_awal" value="<?php echo set_value('outstanding_ppb[' . $i . ']'); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control align-middle w-auto keterangan" name="keterangan[]" id="keterangan" style="text-align: center;" value="<?php echo set_value('keterangan[' . $i . ']'); ?>">
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
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
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    $no = 1;
                                                    foreach ($dtdetail as $row) {
                                                        $id_item = $row->detail_id_item;
                                                        if (($id_item == 120) || ($id_item == 121) || ($id_item == 122)) {
                                                            $readonly = 'readonly';
                                                            $collor = 'background-color: #D5D8DC;';
                                                            $minimum_stock = '';
                                                            $outstanding_ppb = '';
                                                        } else {
                                                            $readonly = '';
                                                            $collor = '';
                                                            $minimum_stock = $row->minimum_stock;
                                                            $outstanding_ppb = $row->outstanding_ppb;
                                                        }
                                                    ?>
                                                        <tr>
                                                            <input type="hidden" name="detail_id[]" id="detail_id" value="<?= $row->detail_id ?>">
                                                            <input type="hidden" name="detail_id_item[]" id="detail_id_item" value="<?= $row->detail_id_item ?>">
                                                            <td><?= $no++; ?></td>
                                                            <td>
                                                                <input type="text" class="form-control lign-middle w-auto text-left item_kimia" name="item_kimia[]" id="item_kimia" style="text-align: center;" value="<?php echo $row->item_kimia; ?>" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto satuan" name="satuan[]" id="satuan" style="text-align: center;" size="1" value="<?php echo $row->satuan; ?>" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto stock_awal hitung_stock_akhir" name="stock_awal[]" id="stock_awal" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo $row->stock_awal; ?>" <?= $readonly; ?>>
                                                                <input type="hidden" class="stock_awal_awal" name="stock_awal_awal[]" id="stock_awal_awal" value="<?php echo $row->stock_awal; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto terima hitung_stock_akhir hitung_outstanding_ppb" name="terima[]" id="terima" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo $row->terima; ?>" <?= $readonly; ?>>
                                                                <input type="hidden" class="terima_awal" name="terima_awal[]" id="terima_awal" value="<?php echo $row->terima; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto terima_akum" name="terima_akum[]" id="terima_akum" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo $row->terima_akum; ?>" readonly>
                                                                <input type="hidden" class="terima_akum_awal" name="terima_akum_awal[]" id="terima_akum_awal" value="<?php echo $row->terima_akum; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto pakai hitung_stock_akhir hitung_ratarata_pakai" name="pakai[]" id="pakai" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->pakai; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto pakai_akum" name="pakai_akum[]" id="pakai_akum" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->pakai_akum; ?>" readonly>
                                                                <input type="hidden" class="pakai_akum_awal" name="pakai_akum_awal[]" id="pakai_akum_awal" value="<?php echo $row->pakai_akum; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto kirim hitung_stock_akhir" name="kirim[]" id="kirim" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo $row->kirim; ?>" <?= $readonly; ?>>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto kirim_akum" name="kirim_akum[]" id="kirim_akum" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo $row->kirim_akum; ?>" readonly>
                                                                <input type="hidden" class="kirim_akum_awal" name="kirim_akum_awal[]" id="kirim_akum_awal" value="<?php echo $row->kirim_akum; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto minimum_stock hitung_minimum_stock" name="minimum_stock[]" id="minimum_stock" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?= $minimum_stock; ?>" <?= $readonly; ?>>
                                                                <input type="hidden" class="minimum_stock_awal" name="minimum_stock_awal[]" id="minimum_stock_awal" value="<?= $minimum_stock; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto stock_akhir" name="stock_akhir[]" id="stock_akhir" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo $row->stock_akhir; ?>" readonly>
                                                                <input type="hidden" class="stock_akhir_awal" name="stock_akhir_awal[]" id="stock_akhir_awal" value="<?php echo $row->stock_akhir; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto ratarata_perbulan" name="ratarata_perbulan[]" id="ratarata_perbulan" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->ratarata_perbulan; ?>">
                                                                <!-- <input type="hidden" class="ratarata_perbulan_awal" name="ratarata_perbulan_awal[]" id="ratarata_perbulan_awal" value="<?php echo $row->ratarata_perbulan; ?>"> -->
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto ratarata_perhari" name="ratarata_perhari[]" id="ratarata_perhari" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center;" size="10" value="<?php echo $row->ratarata_perhari; ?>" readonly>
                                                                <input type="hidden" class="ratarata_perhari_awal" name="ratarata_perhari_awal[]" id="ratarata_perhari_awal" value="<?php echo $row->ratarata_perhari; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto outstanding_ppb" name="outstanding_ppb[]" id="outstanding_ppb" onkeypress="return DisableKey(event, 'desimal')" style="text-align: center; <?= $collor; ?>" size="10" value="<?php echo $outstanding_ppb; ?>" <?= $readonly; ?>>
                                                                <input type="hidden" class="outstanding_ppb_awal" name="outstanding_ppb_awal[]" id="outstanding_ppb_awal" value="<?php echo $row->outstanding_ppb; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control align-middle w-auto keterangan" name="keterangan[]" id="keterangan" style="text-align: center;" value="<?php echo $row->keterangan; ?>">
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

                            <div class=" row mt-1">
                                <div class="col-12">
                                    <?php if (!isset($dtheader)) {
                                        if ($akses_create == '1') { ?>
                                            <button type="submit" class="btn bg-gradient-primary" id="btnsimpan"><i class="feather icon-save"></i> Simpan</button>
                                            <button type="reset" class="btn bg-gradient-light"><i class="feather icon-refresh-ccw"></i> Batal</button>
                                        <?php
                                        }
                                    } else {
                                        if ($akses_update == '1') { ?>
                                            <button type="submit" class="btn bg-gradient-primary" name="btnproses" value="btnupdate" onclick="return confirm('Simpan Data ?')"><i class="feather icon-save"></i> Simpan</button>
                                            <span class="pull-right">
                                                <button type="submit" class="btn bg-gradient-info" name="btnproses" value="btncomplete" onclick="return confirm('Komplit Data ?')"><i class="feather icon-check-square"></i> Komplit</button>

                                            <?php
                                        }
                                        if ($akses_excel == '1') { ?>
                                                <a class="btn bg-gradient-success" href="<?= base_url('export_excel/C_export_toexcel_' . $frmkd . '_' . $frmvrs . '/exportxls/' . $frmkd . '/' . $frmvrs . '/' . $headerid) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
                                            </span>
                                    <?php
                                        }
                                    } ?>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <span class="pull-left">Mulai Berlaku : <?= $frmefec; ?></span>
                                    <a href="?#"><span class="pull-right"><?= $frmnm . '-' . $frmvrs; ?></span></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('template/footbar'); ?>

<script>
    $(document).ready(function() {
        get_docno();
        get_bulan();
    });

    $('.create_date').change(function() {
        var that = $(this);
        var id = $(this).attr('id');
        get_docno();
        get_bulan();
    });

    function get_docno() {
        var input_headerid = $(".headerid").val();
        var create_date = $('.create_date').val();
        if (typeof(input_headerid) == "undefined" && create_date != '') {

            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn020_03/get_docno/inttbn020/03",
                dataType: "json",
                data: {
                    create_date,
                },
                success: function(result) {
                    if (result.status == true) {
                        $('.docno').val(result.data);
                    }
                    get_item();
                }
            });
        }
    }

    function get_bulan() {
        var create_date = $('.create_date').val();
        $.ajax({
            type: "post",
            url: "<?= base_url(); ?>index.php/form_input/C_forminttbn020_03/get_bulan/inttbn020/03",
            data: {
                create_date
            },
            async: false,
            success: function(data) {
                $('.bulan').text(JSON.parse(data)['data']);
            }
        });

    }

    function get_item() {
        let input_headerid = $(".headerid").val();
        let create_date = $(".create_date").val();

        $('#tbody').empty();
        $('#tbody_dtl').empty();

        if (typeof(input_headerid) == "undefined" && create_date != '') {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>index.php/form_input/C_forminttbn020_03/get_list_item/inttbn020/03",
                data: {
                    create_date
                },
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        let no = 1;
                        let list_dtl_2 = ``;

                        $.each(res.data, function(key, list_item_row) {

                            if (list_item_row.children != '') {
                                $.each(list_item_row.children, function(key2, list_item_row_2) {
                                    let stock_awal = (`${list_item_row_2.dt_stock_awal}`) == 'null' ? '' : (`${list_item_row_2.dt_stock_awal}`);
                                    let terima = (`${list_item_row_2.dt_terima}`) == 'null' ? '' : (`${list_item_row_2.dt_terima}`);
                                    let terima_akum = (`${list_item_row_2.dt_terima_akum}`) == 'null' ? 0 : (`${list_item_row_2.dt_terima_akum}`);
                                    let pakai_akum = (`${list_item_row_2.dt_pakai_akum}`) == 'null' ? 0 : (`${list_item_row_2.dt_pakai_akum}`);
                                    let kirim_akum = (`${list_item_row_2.dt_kirim_akum}`) == 'null' ? 0 : (`${list_item_row_2.dt_kirim_akum}`);
                                    let minimum_stock = (`${list_item_row_2.dt_minimum_stock}`) == 'null' ? 0 : (`${list_item_row_2.dt_minimum_stock}`);
                                    // let ratarata_perbulan = (`${list_item_row_2.dt_ratarata_perbulan}`) == 'null' ? 0 : (`${list_item_row_2.dt_ratarata_perbulan}`);
                                    let ratarata_perhari = (`${list_item_row_2.dt_ratarata_perhari}`) == 'null' ? 0 : (`${list_item_row_2.dt_ratarata_perhari}`);
                                    let outstanding_ppb = (`${list_item_row_2.dt_outstanding_ppb}`) == 'null' ? 0 : (`${list_item_row_2.dt_outstanding_ppb}`);

                                    terima = parseFloat(terima).toFixed(2);
                                    stock_awal = parseFloat(stock_awal).toFixed(2);
                                    terima_akum = parseFloat(terima_akum).toFixed(2);
                                    pakai_akum = parseFloat(pakai_akum).toFixed(2);
                                    kirim_akum = parseFloat(kirim_akum).toFixed(2);
                                    minimum_stock = parseFloat(minimum_stock).toFixed(2);
                                    // ratarata_perbulan = parseFloat(ratarata_perbulan).toFixed(2);
                                    ratarata_perhari = parseFloat(ratarata_perhari).toFixed(2);
                                    outstanding_ppb = parseFloat(outstanding_ppb).toFixed(2);

                                    let id_item = list_item_row.detail_id;
                                    if ((id_item == 120) || (id_item == 121) || (id_item == 122)) {
                                        var readonly = 'readonly';
                                        var collor = 'background-color: #D5D8DC;';
                                        stock_awal = '';
                                        terima_akum = '';
                                        kirim_akum = '';
                                        minimum_stock = '';
                                        outstanding_ppb = '';
                                    }

                                    // console.log(list_item_row);

                                    if (list_item_row_2.children2 != '') {
                                        $.each(list_item_row_2.children2, function(key3, list_item_row_3) {
                                            let stock_akhir = (`${list_item_row_3.stock_akhir}`) == 'null' ? 0 : (`${list_item_row_3.stock_akhir}`);

                                            list_dtl_2 += `
                                        <tr>
                                                <input type="hidden" class="detail_id_item" name="detail_id_item[]" id="detail_id_item" value="${list_item_row.detail_id}" readonly>
                                            <td>${no++}</td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto text-left item_kimia" name="item_kimia[]" id="item_kimia" style="text-align: center;" value="${list_item_row.item1}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto satuan" name="satuan[]" id="satuan" style="text-align: center;" size="1" value="${list_item_row.item2}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto stock_awal hitung_stock_akhir" name="stock_awal[]" id="stock_awal" style="text-align: center; ${collor}" size="10" value="${stock_akhir}" ${readonly}>
                                                <input type="hidden" class="stock_awal_awal" name="stock_awal_awal[]" id="stock_awal_awal" value="${stock_akhir}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto terima hitung_stock_akhir hitung_outstanding_ppb" onkeypress="return DisableKey(event, 'desimal')" name="terima[]" id="terima" style="text-align: center; ${collor}" size="10" value="" ${readonly}>
                                                <input type="hidden" class="terima_awal" name="terima_awal[]" id="terima_awal" value="${terima}" ${readonly}>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto terima_akum" onkeypress="return DisableKey(event, 'desimal')" name="terima_akum[]" id="terima_akum" style="text-align: center; ${collor}" size="10" value="${terima_akum}" readonly>
                                                <input type="hidden" class="terima_akum_awal" name="terima_akum_awal[]" id="terima_akum_awal" value="${terima_akum}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto pakai hitung_stock_akhir hitung_ratarata_pakai" onkeypress="return DisableKey(event, 'desimal')" name="pakai[]" id="pakai" style="text-align: center;" size="10" value="">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto pakai_akum" onkeypress="return DisableKey(event, 'desimal')" name="pakai_akum[]" id="pakai_akum" style="text-align: center;" size="10" value="${pakai_akum}" readonly>
                                                <input type="hidden" class="pakai_akum_awal" name="pakai_akum_awal[]" id="pakai_akum_awal" value="${pakai_akum}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto kirim hitung_stock_akhir" onkeypress="return DisableKey(event, 'desimal')" name="kirim[]" id="kirim" style="text-align: center; ${collor}" size="10" value="" ${readonly}>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto kirim_akum" onkeypress="return DisableKey(event, 'desimal')" name="kirim_akum[]" id="kirim_akum" style="text-align: center; ${collor}" size="10" value="${kirim_akum}" readonly>
                                                <input type="hidden" class="kirim_akum_awal" name="kirim_akum_awal[]" id="kirim_akum_awal" value="${kirim_akum}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto minimum_stock hitung_minimum_stock" onkeypress="return DisableKey(event, 'desimal')" name="minimum_stock[]" id="minimum_stock" style="text-align: center; ${collor}" size="10" value="${minimum_stock}" ${readonly}>
                                                <input type="hidden" class="minimum_stock_awal" name="minimum_stock_awal[]" id="minimum_stock_awal" value="${minimum_stock}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto stock_akhir" onkeypress="return DisableKey(event, 'desimal')" name="stock_akhir[]" id="stock_akhir" style="text-align: center; ${collor}" size="10" value="${stock_akhir}" readonly>
                                                <input type="hidden" class="stock_akhir_awal" name="stock_akhir_awal[]" id="stock_akhir_awal" value="${stock_akhir}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto ratarata_perbulan" onkeypress="return DisableKey(event, 'desimal')" name="ratarata_perbulan[]" id="ratarata_perbulan" style="text-align: center;" size="10" value="" >
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto ratarata_perhari" onkeypress="return DisableKey(event, 'desimal')" name="ratarata_perhari[]" id="ratarata_perhari" style="text-align: center;" size="10" value="${ratarata_perhari}" readonly>
                                                <input type="hidden" class="ratarata_perhari_awal" name="ratarata_perhari_awal[]" id="ratarata_perhari_awal" value="${ratarata_perhari}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto outstanding_ppb" onkeypress="return DisableKey(event, 'desimal')" name="outstanding_ppb[]" id="outstanding_ppb" style="text-align: center; ${collor}" size="10" value="${outstanding_ppb}" ${readonly}>
                                                <input type="hidden" class="outstanding_ppb_awal" name="outstanding_ppb_awal[]" id="outstanding_ppb_awal" value="${outstanding_ppb}" ${readonly}>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto keterangan" name="keterangan[]" id="keterangan" style="text-align: center;"  value="">
                                            </td>
                                        </tr>
                                            `;
                                        })

                                    } else {
                                        list_dtl_2 += `
                                        <tr>
                                                <input type="hidden" class="detail_id_item" name="detail_id_item[]" id="detail_id_item" value="${list_item_row.detail_id}" readonly>
                                            <td>${no++}</td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto text-left item_kimia" name="item_kimia[]" id="item_kimia" style="text-align: center;" value="${list_item_row.item1}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto satuan" name="satuan[]" id="satuan" style="text-align: center;" size="1" value="${list_item_row.item2}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto stock_awal hitung_stock_akhir" name="stock_awal[]" id="stock_awal" style="text-align: center; ${collor}" size="10" value="" ${readonly}>
                                                <input type="hidden" class="stock_awal_awal" name="stock_awal_awal[]" id="stock_awal_awal" value="">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto terima hitung_stock_akhir hitung_outstanding_ppb" onkeypress="return DisableKey(event, 'desimal')" name="terima[]" id="terima" style="text-align: center; ${collor}" size="10" value="" ${readonly}>
                                                <input type="hidden" class="terima_awal" name="terima_awal[]" id="terima_awal" value="${terima}" ${readonly}>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto terima_akum" onkeypress="return DisableKey(event, 'desimal')" name="terima_akum[]" id="terima_akum" style="text-align: center; ${collor}" size="10" value="${terima_akum}" readonly>
                                                <input type="hidden" class="terima_akum_awal" name="terima_akum_awal[]" id="terima_akum_awal" value="${terima_akum}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto pakai hitung_stock_akhir hitung_ratarata_pakai" onkeypress="return DisableKey(event, 'desimal')" name="pakai[]" id="pakai" style="text-align: center;" size="10" value="">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto pakai_akum" onkeypress="return DisableKey(event, 'desimal')" name="pakai_akum[]" id="pakai_akum" style="text-align: center;" size="10" value="${pakai_akum}" readonly>
                                                <input type="hidden" class="pakai_akum_awal" name="pakai_akum_awal[]" id="pakai_akum_awal" value="${pakai_akum}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto kirim hitung_stock_akhir" onkeypress="return DisableKey(event, 'desimal')" name="kirim[]" id="kirim" style="text-align: center; ${collor}" size="10" value="" ${readonly}>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto kirim_akum" onkeypress="return DisableKey(event, 'desimal')" name="kirim_akum[]" id="kirim_akum" style="text-align: center; ${collor}" size="10" value="${kirim_akum}" readonly>
                                                <input type="hidden" class="kirim_akum_awal" name="kirim_akum_awal[]" id="kirim_akum_awal" value="${kirim_akum}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto minimum_stock hitung_minimum_stock" onkeypress="return DisableKey(event, 'desimal')" name="minimum_stock[]" id="minimum_stock" style="text-align: center; ${collor}" size="10" value="${minimum_stock}" ${readonly}>
                                                <input type="hidden" class="minimum_stock_awal" name="minimum_stock_awal[]" id="minimum_stock_awal" value="${minimum_stock}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto stock_akhir" onkeypress="return DisableKey(event, 'desimal')" name="stock_akhir[]" id="stock_akhir" style="text-align: center; ${collor}" size="10" value="" readonly>
                                                <input type="hidden" class="stock_akhir_awal" name="stock_akhir_awal[]" id="stock_akhir_awal" value="">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto ratarata_perbulan" onkeypress="return DisableKey(event, 'desimal')" name="ratarata_perbulan[]" id="ratarata_perbulan" style="text-align: center;" size="10" value="">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto ratarata_perhari" onkeypress="return DisableKey(event, 'desimal')" name="ratarata_perhari[]" id="ratarata_perhari" style="text-align: center;" size="10" value="${ratarata_perhari}" readonly>
                                                <input type="hidden" class="ratarata_perhari_awal" name="ratarata_perhari_awal[]" id="ratarata_perhari_awal" value="${ratarata_perhari}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto outstanding_ppb" onkeypress="return DisableKey(event, 'desimal')" name="outstanding_ppb[]" id="outstanding_ppb" style="text-align: center; ${collor}" size="10" value="${outstanding_ppb}" ${readonly}>
                                                <input type="hidden" class="outstanding_ppb_awal" name="outstanding_ppb_awal[]" id="outstanding_ppb_awal" value="${outstanding_ppb}" ${readonly}>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control align-middle w-auto keterangan" name="keterangan[]" id="keterangan" style="text-align: center;"  value="">
                                            </td>
                                        </tr>
                                            `;
                                    };

                                });

                            }

                        });

                        $('#tbody_dtl').append(list_dtl_2);

                        notif_btnconfirm_custom('success', res.pesan);

                    }

                },
            });
        }
    }


    // MENCARI NILAI STOCK AWAL
    // $(document).on('change', '.hitung_stock_awal', function() {
    //     let stock_awal = $(this).closest('tr').find('.stock_awal').val();
    //     let stock_akhir_awal = $(this).closest('tr').find('.stock_akhir_awal').val();

    //     let stock_awal_fix = parseFloat(stock_awal).toFixed(2);
    //     $(this).closest('tr').find('.stock_awal').val(isNaN(stock_awal_fix) ? stock_akhir_awal : stock_awal_fix);
    // });
    // AKHIR MENCARI NILAI STOCK AWAL

    // MENCARI NILAI AKUM
    $(document).on('keyup', '.terima', function() {
        var terima = $(this).closest('tr').find('.terima').val();
        var terima_akum_awal = $(this).closest('tr').find('.terima_akum_awal').val();
        var terima_akum_fix = (parseFloat(terima_akum_awal) + parseFloat(terima)).toFixed(2);
        $(this).closest('tr').find('.terima_akum').val(isNaN(terima_akum_fix) ? terima_akum_awal : terima_akum_fix);
    });

    $(document).on('keyup', '.pakai', function() {
        var pakai = $(this).closest('tr').find('.pakai').val();
        var pakai_akum_awal = $(this).closest('tr').find('.pakai_akum_awal').val();
        var pakai_akum_fix = (parseFloat(pakai_akum_awal) + parseFloat(pakai)).toFixed(2);
        $(this).closest('tr').find('.pakai_akum').val(isNaN(pakai_akum_fix) ? pakai_akum_awal : pakai_akum_fix);
    });

    $(document).on('keyup', '.kirim', function() {
        var kirim = $(this).closest('tr').find('.kirim').val();
        var kirim_akum_awal = $(this).closest('tr').find('.kirim_akum_awal').val();
        var kirim_akum_fix = (parseFloat(kirim_akum_awal) + parseFloat(kirim)).toFixed(2);
        $(this).closest('tr').find('.kirim_akum').val(isNaN(kirim_akum_fix) ? kirim_akum_awal : kirim_akum_fix);
    });
    // AKHIR MENCARI NILAI AKUM

    // MENCARI NILAI RATA-RATA
    $(document).on('keyup', '.hitung_ratarata_pakai', function() {
        var pakai_akum = $(this).closest('tr').find('.pakai_akum').val();
        // var ratarata_perbulan_awal = $(this).closest('tr').find('.ratarata_perbulan_awal').val();
        var ratarata_perhari_awal = $(this).closest('tr').find('.ratarata_perhari_awal').val();

        let create_date = $('.create_date').val();
        let tanggal_split = create_date.split('-');
        let arr_tanggal = (tanggal_split[0]);
        let arr_bulan = (tanggal_split[1]);

        // rata-rata perbulan
        // ratarata_perbulan_fix = (parseFloat(pakai_akum) / arr_bulan).toFixed(2);
        // $(this).closest('tr').find('.ratarata_perbulan').val(isNaN(ratarata_perbulan_fix) ? ratarata_perbulan_awal : ratarata_perbulan_fix);

        // rata-rata perhari
        ratarata_perhari_fix = (parseFloat(pakai_akum) / arr_tanggal).toFixed(2);
        $(this).closest('tr').find('.ratarata_perhari').val(isNaN(ratarata_perhari_fix) ? ratarata_perhari_awal : ratarata_perhari_fix);
    });
    // AKHIR MENCARI NILAI RATA-RATA

    // MENCARI NILAI STOCK AKHIR
    $(document).on('keyup', '.hitung_stock_akhir', function() {
        let stock_awal = $(this).closest('tr').find('.stock_awal').val();
        let terima = $(this).closest('tr').find('.terima').val();
        let pakai = $(this).closest('tr').find('.pakai').val();
        let kirim = $(this).closest('tr').find('.kirim').val();
        let stock_akhir = $(this).closest('tr').find('.stock_akhir').val();
        let stock_akhir_awal = $(this).closest('tr').find('.stock_akhir_awal').val();

        if (stock_awal == '') {
            var stock_awal_n = '0';
        } else {
            stock_awal_n = stock_awal;
            if (terima == '') {
                var terima_n = '0';
            } else {
                var terima_n = terima;
            }
            if (pakai == '') {
                var pakai_n = '0';
            } else {
                var pakai_n = pakai;
            }
            if (kirim == '') {
                var kirim_n = '0';
            } else {
                var kirim_n = kirim;
            }
        }
        let stock_akhir_fix = (parseFloat(stock_awal_n) + parseFloat(terima_n) - parseFloat(pakai_n) - parseFloat(kirim_n)).toFixed(2);
        $(this).closest('tr').find('.stock_akhir').val(isNaN(stock_akhir_fix) ? stock_akhir_awal : stock_akhir_fix);
    });
    // AKHIR MENCARI NILAI STOCK AKHIR

    // MENCARI NILAI MINIMUM STOCK
    $(document).on('change', '.hitung_minimum_stock', function() {
        let minimum_stock = $(this).closest('tr').find('.minimum_stock').val();
        let minimum_stock_awal = $(this).closest('tr').find('.minimum_stock_awal').val();

        let minimum_stock_fix = parseFloat(minimum_stock).toFixed(2);
        $(this).closest('tr').find('.minimum_stock').val(isNaN(minimum_stock_fix) ? minimum_stock_awal : minimum_stock_fix);
    });
    // AKHIR MENCARI NILAI MINIMUM STOCK

    // MENCARI NILAI OUTSTANDING PBB
    $(document).on('keyup', '.hitung_outstanding_ppb', function() {
        var terima = $(this).closest('tr').find('.terima').val();
        var terima_awal = $(this).closest('tr').find('.terima_awal').val();
        var outstanding_ppb_awal = $(this).closest('tr').find('.outstanding_ppb_awal').val();

        if (terima_awal != 0) {
            var outstanding_ppb_fix = (parseFloat(outstanding_ppb_awal) - parseFloat(terima)).toFixed(2);
            $(this).closest('tr').find('.outstanding_ppb').val(isNaN(outstanding_ppb_fix) ? outstanding_ppb_awal : outstanding_ppb_fix);
        }

    });
    // AKHIR MENCARI NILAI OUTSTANDING PBB

    function DisableKey(e, type) {
        let desimal = e.charCode ? e.charCode : e.keyCode;

        // decimal
        if (type == 'alphabet') {
            // tombol Backspace, Tap, titik, slash, tanda hubung, spcae, dan petik dua diperbolehkan
            // desimal == 39 ' desimal == 44 , desimal == 45 - desimal == 46 . desimal == 47 / desimal == 96 ` desimal == 32 spasi desimal == 34 " 
            if (desimal == 34 || desimal == 8 || desimal == 9 || desimal == 32 || desimal == 45 || desimal == 46 || desimal == 96) {
                return true;
            } else {
                // jika bukan huruf
                if ((desimal < 65 || desimal > 90) && (desimal < 97 || desimal > 122)) {
                    return false; // matikan tombol
                }
            }
        } else {
            if (desimal == 45 || desimal == 46 || desimal == 8 || desimal == 9) {
                // jika menekan tombol Backspace, Tap, titik diperbolehkan
                return true;
            } else {
                // jika bukan angka
                if (desimal < 48 || desimal > 57) {
                    return false; // matikan tombol
                }
            }
        }
    }

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode >= 46 && charCode <= 57)
            if (charCode != 47) {
                return true;
            } else {
                return false;
            }
        return false;
    }
</script>

<?php $this->load->view('template/footbarend'); ?>