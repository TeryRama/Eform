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
        $headerid     = $header->headerid;

        $comment      = $header->comment;
        $comment_by   = $header->comment_by;
        $comment_time = $header->comment_time;
        $comment_date = date("d-m-Y", strtotime($header->comment_date));

        $create_date  = date("d-m-Y", strtotime($header->create_date));
        $docno        = $header->docno;
    }
} else if (isset($message)) {
    $aksi        = "dtsave";

    $create_date = $dtcreate_date;
    $docno       = $dtdocno;
} else {
    $aksi        = "dtsave";

    $create_date = date("d-m-Y", strtotime($dtcreate_date));
    $docno       = '';
}

$base_url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$fcpath2   = str_replace('utl/', '', FCPATH);
$style_ttd = 'style="width:130px; height:80px; background-size:100%;"'; ?>

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

                        <form action="<?= base_url('form_input/C_formintwtd014_01/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formintwtd014" name="formintwtd014" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
                            <div class="row mb-1">
                                <div class="col-6">

                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?= $headerid; ?>" id="headerid" class="headerid">
                                    <?php } ?>

                                    <!-- input page shift -->
                                    <input type="hidden" name="page_shift" value="<?= $page_shift; ?>" id="page_shift" class="page_shift">

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
                                            No. Dokumen/ Rev
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="docno" id="docno" class="form-control docno dtopen_blok" value="<?= $docno; ?>" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card collapse-icon accordion-icon-rotate">
                                        <div class="accordion" id="accordion_dtl">
                                            <?php $shift_jam = 6; // start jam shift per hari

                                            $no2 = 0;
                                            for ($i = 1; $i <= 3; $i++) {

                                                $no2++; ?>

                                                <div class="collapse-margin">
                                                    <div class="card-header bg-gradient-info" id="<?= 'heading_dtl_' . $i ?>" data-toggle="collapse" role="button" data-target="<?= '#collapse_dtl_' . $i ?>" aria-expanded="false" aria-controls="<?= 'collapse_dtl_' . $i ?>">
                                                        <h4>Shift <?= $i ?>
                                                        </h4>
                                                    </div>
                                                    <div id="<?= 'collapse_dtl_' . $i ?>" class="collapse" aria-labelledby="<?= 'heading_dtl_' . $i ?>" data-parent="#accordion_dtl">
                                                        <div class="card-body">
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead class="table-primary <?= isset($dtheader) ? 'sticky-top' : '' ?> ">
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center">No.</th>
                                                                            <th class="table-primary align-middle text-center">NAMA MESIN</th>
                                                                            <th class="table-primary align-middle text-center">KODE</th>
                                                                            <th class="table-primary align-middle text-center">PARAMETER</th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                            <th class="table-primary align-middle text-center"><?= str_pad(($shift_jam++ >= 24 ? $shift_jam - 24 : $shift_jam), 2, '0', STR_PAD_LEFT) ?></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbody_sf<?= $i ?>">

                                                                        <?php if (isset($dtdetail)) {
                                                                            $no = 1;
                                                                            $no_bg = 0;
                                                                            foreach ($dtdetail as $dtdetail_row) {
                                                                                if ($dtdetail_row->shift == 'shift_' . $i) {         //perulangan kolom dishift dijadikan 1 kolom
                                                                                    if ($dtdetail_row->parameter == 'Operasi ( menit )') {
                                                                                        $no_bg++;
                                                                                        $tr_color = 'bg-secondary';
                                                                                        $no       = 1;               // reset no per operasi menit

                                                                                        $vnama_mesin = '';
                                                                                        $vkode       = '';
                                                                                    } else {
                                                                                        $tr_color = '';

                                                                                        $vnama_mesin = $dtdetail_row->nama_mesin;
                                                                                        $vkode       = $dtdetail_row->kode;
                                                                                    }

                                                                                    if ($no <= 2) {
                                                                                        $vitem1 = '<td align="center" rowspan="' . $dtdetail_row->jml_per_mesin . '"><b>' . $vnama_mesin . '</b></td>'; // gabungin jadi satu kolom dan tulisan miring per nama mesin
                                                                                    } else {
                                                                                        $vitem1 = '';
                                                                                    } ?>
                                                                                    <tr class="<?= $tr_color ?>">
                                                                                        <input type="hidden" name="dtl_detail_id[]" id="dtl_detail_id" class="form-control w-auto dtl_detail_id" style="text-align: center;" value="<?= $dtdetail_row->detail_id ?>">
                                                                                        <td align="center"><?= $no++ ?>
                                                                                            <input type="hidden" name="dtl_shift[]" id="dtl_shift" class="form-control w-auto dtl_shift" style="text-align: center;" value="<?= $dtdetail_row->shift ?>">
                                                                                            <input type="hidden" name="dtl_nama_mesin[]" id="dtl_nama_mesin" class="form-control w-auto dtl_nama_mesin" style="text-align: center;" value="<?= $dtdetail_row->nama_mesin ?>">
                                                                                            <input type="hidden" name="dtl_kode[]" id="dtl_kode" class="form-control w-auto dtl_kode" style="text-align: center;" value="<?= $dtdetail_row->kode ?>">
                                                                                            <input type="hidden" name="dtl_parameter[]" id="dtl_parameter" class="form-control w-auto dtl_parameter" style="text-align: center;" value="<?= $dtdetail_row->parameter ?>">
                                                                                            <input type="hidden" name="dtl_jml_per_mesin[]" id="dtl_jml_per_mesin" class="form-control w-auto dtl_jml_per_mesin" style="text-align: center;" value="<?= $dtdetail_row->jml_per_mesin ?>">
                                                                                        </td>
                                                                                        <?= $vitem1 ?>
                                                                                        <td align="center"><?= $vkode ?></td>
                                                                                        <td align="left"><?= $dtdetail_row->parameter ?></td>

                                                                                        <?php
                                                                                        $alphabet = ["", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

                                                                                        for ($j = 1; $j <= 8; $j++) {  
                                                                                            if ($dtdetail_row->parameter == 'UF Feed Pressure (Bar)') { ?>
                                                                                                 <td align="center"><input type="text" name="<?= 'dtl_cek_shift_jam' . $j ?>[]" id="hasil_<?= $alphabet[$j] ?>_shift_<?= $no2 . '_' . $no_bg ?>" class="<?= 'form-control angkadantitik w-auto dtl_cek_shift_jam' . $j . ' hasil_' . $alphabet[$j] . '_shift_' . $no2 . '_' . $no_bg ?> kurang1" style="text-align: center;" value="<?= $dtdetail_row->{'cek_shift_jam' . $j} ?>"></td>
                                                                                        <?php }
                                                                                            else if ($dtdetail_row->parameter == 'UF Filtrate Pressure (Bar)') { ?>
                                                                                                <td align="center"><input type="text" name="<?= 'dtl_cek_shift_jam' . $j ?>[]" id="hasil_<?= $alphabet[$j] ?>_shift_<?= $no2 . '_' . $no_bg ?>" class="<?= 'form-control angkadantitik w-auto dtl_cek_shift_jam' . $j . ' hasil_' . $alphabet[$j] . '_shift_' . $no2 . '_' . $no_bg ?> kurang2" style="text-align: center;" value="<?= $dtdetail_row->{'cek_shift_jam' . $j} ?>"></td>
                                                                                        <?php }
                                                                                            else if ($dtdetail_row->parameter == 'TMP (Bar)') { ?>
                                                                                                <td align="center"><input type="text" name="<?= 'dtl_cek_shift_jam' . $j ?>[]" id="hasil_<?= $alphabet[$j] ?>_shift_<?= $no2 . '_' . $no_bg ?>" class="<?= 'form-control angkadantitik w-auto dtl_cek_shift_jam' . $j . ' hasil_' . $alphabet[$j] . '_shift_' . $no2 . '_' . $no_bg ?> total_kurang" style="text-align: center;" value="<?= $dtdetail_row->{'cek_shift_jam' . $j} ?>"></td>
                                                                                        <?php } 
                                                                                            else{?>
                                                                                            <td align="center"><input type="text" name="<?= 'dtl_cek_shift_jam' . $j ?>[]" id="<?= 'dtl_cek_shift_jam' . $j ?> font" class="<?= 'form-control angkadantitik w-auto dtl_cek_shift_jam' . $j ?>" style="text-align: center;" value="<?= $dtdetail_row->{'cek_shift_jam' . $j} ?>"></td>
                                                                                        <?php } 
                                                                                    } ?>
                                                                                    </tr>
                                                                        <?php
                                                                                }
                                                                            }
                                                                        } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center" colspan="19"></th>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <table class="table table-condensed table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>CIP dilakukan jika :</th>
                                                    </tr>
                                                    <tr>
                                                        <th>- TMP mencapai 1 bar</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <!-- <div class="col-4">
                                            <table class="table table-condensed table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Range : </th>
                                                    </tr>
                                                    <tr>
                                                        <th>FM : Flow Meter</th>
                                                        <th>Inlet Pressure ( 1,8-2,2 )</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Stage I ( 7,5-10 bar )</th>
                                                        <th>Stage II ( 6,5-9,0 bar )</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Stage III ( 6,0-9,0 bar )</th>
                                                        <th>Riject pressure (5,0 -6,0) bar</th>
                                                    </tr>
                                                    <tr>
                                                        <th>product water I ( 0,4-0,8 ) bar</th>
                                                        <th>product water II( 0,4-0,8 ) bar</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div> -->
                                    </div>

                                </div>
                            </div>

                            <hr>

                            <div class="row mt-1">
                                <div class="col-12">
                                    <strong>Hasil Analisa Sebelum CIP</strong>
                                    <div class="card collapse-icon accordion-icon-rotate">
                                        <div class="accordion" id="accordion_dtl_b">
                                            <?php for ($i = 1; $i <= 3; $i++) { ?>
                                                <div class="collapse-margin">
                                                    <div class="card-header bg-gradient-success" id="<?= 'heading_dtl_b_' . $i ?>" data-toggle="collapse" role="button" data-target="<?= '#collapse_dtl_b_' . $i ?>" aria-expanded="false" aria-controls="<?= 'collapse_dtl_b_' . $i ?>">
                                                        <h4>Shift <?= $i ?>
                                                        </h4>
                                                    </div>
                                                    <div id="<?= 'collapse_dtl_b_' . $i ?>" class="collapse" aria-labelledby="<?= 'heading_dtl_b_' . $i ?>" data-parent="#accordion_dtl_b">
                                                        <div class="card-body">
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead class="table-success ">
                                                                        <tr>
                                                                            <th class="table-success align-middle text-center" colspan="1">Time Check</th>
                                                                            <th class="table-success align-middle text-center" colspan="1">pH air</th>
                                                                            <th class="table-success align-middle text-center" colspan="2">Setelah Caustic</th>
                                                                            <th class="table-success align-middle text-center" colspan="2">Setelah Acid</th>
                                                                        </tr>
                                                                        <tr>

                                                                            <th class="table-success align-middle text-center">CIP</th>
                                                                            <th class="table-success align-middle text-center">(6,5-8,5)</th>
                                                                            <th class="table-success align-middle text-center">pH (10,5-12,0)</th>
                                                                            <th class="table-success align-middle text-center">Temp (40-45'C)</th>
                                                                            <th class="table-success align-middle text-center">pH (3,0-5,0)</th>
                                                                            <th class="table-success align-middle text-center">Temp (40-45'C)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbody2_sf<?= $i ?>">
                                                                        <?php if (isset($dtdetail_b)) {
                                                                            foreach ($dtdetail_b as $dtdetail_row2) {
                                                                                if ($dtdetail_row2->shift == 'shift_' . $i) {  ?>
                                                                                    <tr>
                                                                                        <input type="hidden" name="dtl_b_detail_id[]" id="dtl_b_detail_id" class="form-control dtl_detail_id_b" style="text-align: center;" value="<?= $dtdetail_row2->detail_id ?>">
                                                                                        <td align="center">
                                                                                            <input type="hidden" name="dtl_b_shift[]" id="dtl_b_shift" class="form-control dtl_b_shift" style="text-align: center;" value="<?= $dtdetail_row2->shift ?>">
                                                                                            <input type="text" name="dtl_b_time_check[]" id="dtl_b_time_check" class="form-control angkadantitik  dtl_time_check" style="text-align: center;" value="<?= $dtdetail_row2->time_check ?>">
                                                                                        </td>

                                                                                        <td align="center"><input type="text" name="dtl_b_ph_air[]" id="dtl_b_ph_air" class="form-control angkadantitik  dtl_ph_air" style="text-align: center;" value="<?= $dtdetail_row2->ph_air ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_b_ph_caustic[]" id="dtl_b_ph_caustic" class="form-control angkadantitik  dtl_ph_caustic" style="text-align: center;" value="<?= $dtdetail_row2->ph_caustic ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_b_temp_caustic[]" id="dtl_b_temp_caustic" class="form-control angkadantitik  dtl_temp_caustic" style="text-align: center;" value="<?= $dtdetail_row2->temp_caustic ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_b_ph_acid[]" id="dtl_b_ph_acid" class="form-control angkadantitik  dtl_ph_acid" style="text-align: center;" value="<?= $dtdetail_row2->ph_acid ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_b_temp_acid[]" id="dtl_b_temp_acid" class="form-control angkadantitik  dtl_temp_acid" style="text-align: center;" value="<?= $dtdetail_row2->temp_acid ?>"></td>
                                                                                    </tr>
                                                                            <?php
                                                                                }
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td align="center">
                                                                                    <input type="hidden" name="dtl_b_shift[]" id="dtl_b_shift" class="form-control dtl_b_shift" style="text-align: center;" value="<?= 'shift_' . $i ?>">
                                                                                    <input type="text" name="dtl_b_time_check[]" id="dtl_b_time_check" class="form-control angkadantitik  dtl_time_check" style="text-align: center;" value="">
                                                                                </td>
                                                                                <td align="center"><input type="text" name="dtl_b_ph_air[]" id="dtl_b_ph_air" class="form-control angkadantitik  dtl_ph_air" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_b_ph_caustic[]" id="dtl_b_ph_caustic" class="form-control angkadantitik  dtl_ph_caustic" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_b_temp_caustic[]" id="dtl_b_temp_caustic" class="form-control angkadantitik  dtl_temp_caustic" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_b_ph_acid[]" id="dtl_b_ph_acid" class="form-control angkadantitik  dtl_ph_acid" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_b_temp_acid[]" id="dtl_b_temp_acid" class="form-control angkadantitik  dtl_temp_acid" style="text-align: center;" value=""></td>
                                                                            </tr>
                                                                        <?php
                                                                        } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td class="table-success align-middle text-center" colspan="15" align="center"></td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>


                            <div class="row mt-1">
                                <div class="col-12">
                                    <strong>Hasil Analisa Sesudah CIP</strong>
                                    <div class="card collapse-icon accordion-icon-rotate">
                                        <div class="accordion" id="accordion_dtl_c">
                                            <?php for ($i = 1; $i <= 3; $i++) { ?>
                                                <div class="collapse-margin">
                                                    <div class="card-header bg-gradient-warning" id="<?= 'heading_dtl_c_' . $i ?>" data-toggle="collapse" role="button" data-target="<?= '#collapse_dtl_c_' . $i ?>" aria-expanded="false" aria-controls="<?= 'collapse_dtl_b_' . $i ?>">
                                                        <h4>Shift <?= $i ?>
                                                        </h4>
                                                    </div>
                                                    <div id="<?= 'collapse_dtl_c_' . $i ?>" class="collapse" aria-labelledby="<?= 'heading_dtl_c_' . $i ?>" data-parent="#accordion_dtl_c">
                                                        <div class="card-body">
                                                            <div class="table-responsive scrolly_table" id="<?= 'scrolling_table_' . $i ?>" style="max-height: 800px;">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead class="table-warning <?= isset($dtheader) ? 'sticky-top' : '' ?> ">
                                                                        <tr>
                                                                            <th class="table-warning align-middle text-center" colspan="1">Time Check</th>
                                                                            <th class="table-warning align-middle text-center" colspan="1">pH air</th>
                                                                            <th class="table-warning align-middle text-center" colspan="1">Residu Caustic</th>
                                                                            <th class="table-warning align-middle text-center" colspan="1">Residu Acid</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="table-warning align-middle text-center">CIP</th>
                                                                            <th class="table-warning align-middle text-center">(6,5-8,5)</th>
                                                                            <th class="table-warning align-middle text-center">% Konsentrasi</th>
                                                                            <th class="table-warning align-middle text-center">% Konsentrasi</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbody3_sf<?= $i ?>">
                                                                        <?php if (isset($dtdetail_c)) {
                                                                            foreach ($dtdetail_c as $dtdetail_row3) {
                                                                                if ($dtdetail_row3->shift == 'shift_' . $i) {  ?>
                                                                                    <tr>
                                                                                        <input type="hidden" name="dtl_c_detail_id[]" id="dtl_c_detail_id" class="form-control dtl_detail_id_b" style="text-align: center;" value="<?= $dtdetail_row3->detail_id ?>">
                                                                                        <td align="center">
                                                                                            <input type="hidden" name="dtl_c_shift[]" id="dtl_c_shift" class="form-control dtl_c_shift" style="text-align: center;" value="<?= $dtdetail_row3->shift ?>">
                                                                                            <input type="text" name="dtl_c_time_check[]" id="dtl_c_time_check" class="form-control angkadantitik  dtl_time_check" style="text-align: center;" value="<?= $dtdetail_row3->time_check ?>">
                                                                                        </td>
                                                                                        <td align="center"><input type="text" name="dtl_c_ph[]" id="dtl_c_ph" class="form-control angkadantitik  dtl_c_ph" style="text-align: center;" value="<?= $dtdetail_row3->ph ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_residu_caustic[]" id="dtl_c_residu_caustic" class="form-control angkadantitik  dtl_c_residu_caustic" style="text-align: center;" value="<?= $dtdetail_row3->residu_caustic ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_c_residu_acid[]" id="dtl_c_residu_acid" class="form-control angkadantitik  dtl_c_residu_acid" style="text-align: center;" value="<?= $dtdetail_row3->residu_acid ?>"></td>
                                                                                    </tr>
                                                                            <?php
                                                                                }
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td align="center">
                                                                                    <input type="hidden" name="dtl_c_shift[]" id="dtl_c_shift" class="form-control dtl_c_shift" style="text-align: center;" value="<?= 'shift_' . $i ?>">
                                                                                    <input type="text" name="dtl_c_time_check[]" id="dtl_c_time_check" class="form-control angkadantitik  dtl_c_time_check" style="text-align: center;" value="">
                                                                                </td>
                                                                                <td align="center"><input type="text" name="dtl_c_ph[]" id="dtl_c_ph" class="form-control angkadantitik  dtl_c_ph" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_residu_caustic[]" id="dtl_c_residu_caustic" class="form-control angkadantitik  dtl_c_residu_caustic" style="text-align: center;" value=""></td>
                                                                                <td align="center"><input type="text" name="dtl_c_residu_acid[]" id="dtl_c_residu_acid" class="form-control angkadantitik  dtl_c_residu_acid" style="text-align: center;" value=""></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td class="table-warning align-middle text-center" colspan="15" align="center"></td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="card collapse-icon accordion-icon-rotate">
                                        <div class="accordion" id="accordion_dtl_d">
                                            <div class="collapse-margin">
                                                <div class="card-header bg-gradient-danger" id="heading_dtlc_d" data-toggle="collapse" role="button" data-target="#collapse_dtlc_d" aria-expanded="false" aria-controls="collapse_dtlc_d">
                                                    <strong>Catatan KetidakSesuaian</strong>
                                                </div>
                                                <div id="collapse_dtlc_d" class="collapse" aria-labelledby="heading_dtlc_d" data-parent="#accordion_dtl_d">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="table-danger align-middle text-center"></th>
                                                                        <th class="table-danger align-middle text-center">Shift</th>
                                                                        <th class="table-danger align-middle text-center">Jam</th>
                                                                        <th class="table-danger align-middle text-center">Urutan Ketidaksesuaian</th>
                                                                        <th class="table-danger align-middle text-center">Tindakan Perbaikan</th>
                                                                        <th class="table-danger align-middle text-center">Nama</th>
                                                                        <th class="table-danger align-middle text-center">Paraf</th>
                                                                        <th class="table-danger align-middle text-center">Keterangan</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody4">
                                                                    <?php if (isset($dtdetail_d)) {
                                                                        foreach ($dtdetail_d as $dtdetail_row4) {
                                                                            if (file_exists($fcpath2 . 'utl/assets/ttd/' . $dtdetail_row4->pj_personalstatus . '_' . $dtdetail_row4->pj_personalid . '.png')) {
                                                                                $pj_ttd = '<img src="' . $base_url2 . 'utl/assets/ttd/' . $dtdetail_row4->pj_personalstatus . '_' . $dtdetail_row4->pj_personalid . '.png" ' . $style_ttd . ' alt="">';
                                                                            } else if (
                                                                                $dtdetail_row4->pj_personalstatus == '1' && file_exists($fcpath2 . 'forviewfoto_pekerja/' . $dtdetail_row4->pj_personalid . '_0_0.png')
                                                                            ) {
                                                                                $pj_ttd = '<img src="' . $base_url2 . 'forviewfoto_pekerja/' . $dtdetail_row4->pj_personalid . '_0_0.png" ' . $style_ttd . ' alt="">';
                                                                            } else if (
                                                                                $dtdetail_row4->pj_personalstatus == '2' && file_exists($fcpath2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row4->pj_personalid . '.png')
                                                                            ) {
                                                                                $pj_ttd = '<img src="' . $base_url2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row4->pj_personalid . '.png" ' . $style_ttd . ' alt="">';
                                                                            } else {
                                                                                $pj_ttd = '';
                                                                            } ?>
                                                                            <tr>
                                                                                <input type="hidden" name="dtl_d_detail_id[]" id="dtl_d_detail_id" class="form-control dtl_detail_id_b" style="text-align: center;" value="<?= $dtdetail_row4->detail_id ?>">
                                                                                <td><input name="dtl_d_chk[]" type="checkbox" value="<?= $dtdetail_row4->shift . ' ' . $dtdetail_row4->detail_id ?>"></td>
                                                                                <td><select name="dtl_d_shift[]" class="form-control dtl_d_shift" id="dtl_d_shift">
                                                                                        <option value="">- pilih -</option>
                                                                                        <option value="shift_1" <?= $dtdetail_row4->shift == "shift_1" ? "selected" : ""  ?>>Shift 1</option>
                                                                                        <option value="shift_2" <?= $dtdetail_row4->shift == "shift_2" ? "selected" : ""  ?>>Shift 2</option>
                                                                                        <option value="shift_3" <?= $dtdetail_row4->shift == "shift_3" ? "selected" : ""  ?>>Shift 3</option>
                                                                                    </select></td>
                                                                                <td align="center"><input type="text" name="dtl_d_jam[]" id="dtl_d_jam" class=" masktime form-control angkadantitik dtl_d_jam" style="text-align: center;" value="<?= $dtdetail_row4->jam ?>"></td>
                                                                                <td align=" center"><input type="text" name="dtl_d_uraian[]" id="dtl_d_uraian" class="form-control dtl_d_uraian" value="<?= $dtdetail_row4->uraian ?>"></td>
                                                                                <td align="center"><input type="text" name="dtl_d_tindakan[]" id="dtl_d_tindakan" class="form-control dtl_d_tindakan" value="<?= $dtdetail_row4->tindakan ?>"></td>
                                                                                <td>
                                                                                    <select name="dtl_d_pj_id[]" id="dtl_d_pj_id" class="form-control dtl_d_pj_id">
                                                                                        <option value="">- pilih -</option>
                                                                                        <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                                            <option value="<?= $list_pj_row->detail_id ?>" <?= $list_pj_row->detail_id == $dtdetail_row4->pj_id ? "selected" : "" ?>><?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                                <td align="center"><?= $pj_ttd ?></td>
                                                                                <td align="center"><input type="text" name="dtl_d_keterangan[]" id="dtl_d_keterangan" class="form-control dtl_d_keterangan" style="text-align: center;" value="<?= $dtdetail_row4->keterangan ?>"></td>
                                                                            </tr>
                                                                        <?php }
                                                                    } else { ?>

                                                                        <tr>
                                                                            <td><input name="dtlb_chk[]" type="checkbox" value=""></td>
                                                                            <td><select name="dtl_d_shift[]" class="form-control dtl_d_shift" id="dtl_d_shift">
                                                                                    <option value="">- pilih -</option>
                                                                                    <option value="shift_1">Shift 1</option>
                                                                                    <option value="shift_2">Shift 2</option>
                                                                                    <option value="shift_3">Shift 3</option>
                                                                                </select></td>
                                                                            <td align="center"><input type="text" name="dtl_d_jam[]" id="dtl_d_jam" class=" masktime form-control angkadantitik  dtl_d_jam" style="text-align: center;" value=""></td>
                                                                            <td align="center"><input type="text" name="dtl_d_uraian[]" id="dtl_d_uraian" class="form-control dtl_d_uraian" value=""></td>
                                                                            <td align="center"><input type="text" name="dtl_d_tindakan[]" id="dtl_d_tindakan" class="form-control dtl_d_tindakan" value=""></td>

                                                                            <td>
                                                                                <select name="dtl_d_pj_id[]" id="dtl_d_pj_id" class="form-control dtl_d_pj_id">
                                                                                    <option value="">- pilih -</option>
                                                                                    <?php foreach ($list_pj as $list_pj_row) { ?>
                                                                                        <option value="<?= $list_pj_row->detail_id ?>"><?= $list_pj_row->nik . ' - ' . $list_pj_row->nama ?></option>
                                                                                    <?php
                                                                                    } ?>
                                                                                </select>
                                                                            </td>
                                                                            <td align="center"></td>
                                                                            <td align="center"><input type="text" name="dtl_d_keterangan[]" id="dtl_d_keterangan" class="form-control dtl_d_keterangan" style="text-align: center;" value=""></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td class="table-danger align-middle text-center" colspan="9" align="center">
                                                                            <?php if (!isset($dtdetail_d)) {
                                                                                if ($akses_create == '1') { ?>
                                                                                    <button type="button" class="btn btn-sm bg-gradient-info btn_tbody3_sf" id="tambah_baris" onClick="addRow('tbody4')">Tambah
                                                                                        Baris</button>
                                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody4')">Hapus
                                                                                        Baris</button>
                                                                                <?php } else {/*No Acess Create*/
                                                                                }
                                                                            } else {
                                                                                if ($akses_update == '1') { ?>
                                                                                    <button type="button" class="btn btn-sm bg-gradient-info btn_tbody3_sf" id="tambah_baris" onClick="addRow('tbody4')">Tambah
                                                                                        Baris</button>
                                                                                    <button type="button" class="btn btn-sm bg-gradient-danger" id="hapus_baris" onClick="deleteRow('tbody4')">Hapus
                                                                                        Baris</button>
                                                                                <?php } else {/*No Acess Update*/
                                                                                }
                                                                                if ($akses_delete == '1') { ?>
                                                                                    <button type="submit" class="btn btn-sm bg-gradient-dark" name="btndelete_dtlb" id="hapus_data_baris" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <br>

                            <div class="row mt-1">
                                <div class="col-12">
                                    <?php if (!isset($dtheader)) {
                                        if ($akses_create == '1') { ?>
                                            <button type="submit" class="btn bg-gradient-primary" id="btnsimpan"><i class="feather icon-save"></i> Simpan <?= $page_shift ?></button>
                                            <button type="reset" class="btn bg-gradient-light"><i class="feather icon-refresh-ccw"></i> Batal</button>
                                        <?php } else {/*No Acess Create*/
                                        }
                                    } else {
                                        // tombol sesuaikan dengan halaman shift
                                        if ($akses_update == '1' && $page_shift != 'Shift Komplit') {
                                            $sf = 'sf' . explode(" ", $page_shift)[1]; ?>
                                            <button type="submit" class="btn bg-gradient-primary" name="btnproses" value="btnupdate_<?= $sf ?>" onclick="return confirm('Simpan Data ?')"><i class="feather icon-save"></i> Simpan <?= $page_shift ?></button>
                                            <button type="submit" class="btn bg-gradient-info" name="btnproses" value="btncomplete_<?= $sf ?>" onclick="return confirm('Komplit Data ?')"><i class="feather icon-check-square"></i> Komplit <?= $page_shift ?></button>
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
                                    <span class="pull-right"><?= $frmnm . '-' . $frmvrs; ?></span>
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
            // console.log('dfdsfdsfdsf');
        });

        if (typeof($('#headerid').val()) != "undefined") {
            $('.dtopen_blok').prop('readonly', true);
            $('.dtopen_blok2 > option').each(function() {
                if (!this.selected) {
                    $(this).attr('disabled', true);
                }
            });
        }

        function alert_req_hdr() {
            notif_btnconfirm_custom('error', 'Silahkan lengkapi header dahulu!!!');
        }

        function get_docno() {

            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            if (typeof(input_headerid) == "undefined" && create_date != '') {

                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formintwtd014_01/get_docno/intwtd014/01",
                    data: {
                        create_date
                    },
                    success: function(data) {
                        $('.docno').val(JSON.parse(data)['data']);
                    }
                });

                get_item('dtl', 'tbody_sf1', 'Tipe 1');
                get_item('dtl', 'tbody_sf2', 'Tipe 1');
                get_item('dtl', 'tbody_sf3', 'Tipe 1');
            }
        }

        function get_item(tbl, tbody, tipe_dtl) {
            let input_headerid = $(".headerid").val();
            let create_date = $('.create_date').val();

            $('#' + tbody).empty();

            if (typeof(input_headerid) == "undefined" && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formintwtd014_01/get_list_item/intwtd014/01",
                    dataType: "json",
                    data: {
                        tipe_dtl,
                        create_date
                    },
                    success: function(result) {
                        if (result.status == 0) {
                            // console.log(result.data);

                            let no = 1;
                            let list_dtl = '';

                            let no2 = 0;
                            $.each(result.data, function(key, list_item_row) {
                                if (result.data[key].children) {
                                    no2++;
                                    $.each(result.data[key].children, function(key2, children_row) {
                                        let vitem1 = '';

                                        if (key2 == 0) {
                                            list_dtl += `<tr class="bg-secondary">
                                            <td align="center">1
                                                    <input type="hidden" name="dtl_shift[]" id="dtl_shift" class="form-control w-auto dtl_shift" style="text-align: center;" value="shift_` + tbody.substr(-1) + `">
                                                    <input type="hidden" name="dtl_nama_mesin[]" id="dtl_nama_mesin" class="form-control w-auto dtl_nama_mesin" style="text-align: center;" value="` + list_item_row.item1 + `">
                                                    <input type="hidden" name="dtl_kode[]" id="dtl_kode" class="form-control w-auto dtl_kode" style="text-align: center;" value="` + children_row.item2 + `">
                                                    <input type="hidden" name="dtl_parameter[]" id="dtl_parameter" class="form-control w-auto dtl_parameter" style="text-align: center;" value="Operasi ( menit )">
                                                    <input type="hidden" name="dtl_jml_per_mesin[]" id="dtl_jml_per_mesin" class="form-control w-auto dtl_jml_per_mesin" style="text-align: center;" value="1"></td>
                                                <td align="center"></td>
                                                <td align="center"></td>
                                                <td align="center">Operasi ( menit )</td>
                                                <td align="center"><input type="text" name="dtl_cek_shift_jam1[]" id="dtl_cek_shift_jam1" class="form-control angkadantitik w-auto dtl_cek_shift_jam1" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="text" name="dtl_cek_shift_jam2[]" id="dtl_cek_shift_jam2" class="form-control angkadantitik w-auto dtl_cek_shift_jam2" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="text" name="dtl_cek_shift_jam3[]" id="dtl_cek_shift_jam3" class="form-control angkadantitik w-auto dtl_cek_shift_jam3" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="text" name="dtl_cek_shift_jam4[]" id="dtl_cek_shift_jam4" class="form-control angkadantitik w-auto dtl_cek_shift_jam4" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="text" name="dtl_cek_shift_jam5[]" id="dtl_cek_shift_jam5" class="form-control angkadantitik w-auto dtl_cek_shift_jam5" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="text" name="dtl_cek_shift_jam6[]" id="dtl_cek_shift_jam6" class="form-control angkadantitik w-auto dtl_cek_shift_jam6" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="text" name="dtl_cek_shift_jam7[]" id="dtl_cek_shift_jam7" class="form-control angkadantitik w-auto dtl_cek_shift_jam7" style="text-align: center;" value=""></td>
                                                <td align="center"><input type="text" name="dtl_cek_shift_jam8[]" id="dtl_cek_shift_jam8" class="form-control angkadantitik w-auto dtl_cek_shift_jam8" style="text-align: center;" value=""></td>
                                                </tr>`;

                                            vitem1 = `<td align="center" rowspan="` + result.data[key].children.length + `"><b>` + list_item_row.item1 + `</b></td>`;
                                        }
                                        if (children_row.spek2 == 'CEB') {
                                            list_dtl += `<tr class="bg-secondary"> 
                                                            <td align="center">` + eval(key2 + 2) + `
                                                                <input type="hidden" name="dtl_shift[]" id="dtl_shift" class="form-control w-auto dtl_shift" style="text-align: center;" value="shift_` + tbody.substr(-1) + `">
                                                                <input type="hidden" name="dtl_nama_mesin[]" id="dtl_nama_mesin" class="form-control w-auto dtl_nama_mesin" style="text-align: center;" value="` + list_item_row.item1 + `">
                                                                <input type="hidden" name="dtl_kode[]" id="dtl_kode" class="form-control w-auto dtl_kode" style="text-align: center;" value="` + children_row.item2 + `">
                                                                <input type="hidden" name="dtl_parameter[]" id="dtl_parameter" class="form-control w-auto dtl_parameter" style="text-align: center;" value="` + children_row.spek2 + `">
                                                                <input type="hidden" name="dtl_jml_per_mesin[]" id="dtl_jml_per_mesin" class="form-control w-auto dtl_jml_per_mesin" style="text-align: center;" value="` + result.data[key].children.length + `"></td>
                                                            ` + vitem1 + `
                                                            <td align="center">` + children_row.item2 + `</td>
                                                            <td align="left">` + children_row.spek2 + `</td>`;
                                            let alphabet = ["", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
                                            for (let j = 1; j <= 8; j++) {
                                                list_dtl += `<td align="center"><input type="hidden" name="dtl_cek_shift_jam${j}[]" id="dtl_cek_shift_jam${j}" class="form-control angkadantitik w-auto dtl_cek_shift_jam${j}" style="text-align: center;" value=""></td>`;
                                            }
                                            list_dtl += '</tr>';
                                        } else {
                                            list_dtl += `<tr> 
                                                    <td align="center">` + eval(key2 + 2) + `
                                                        <input type="hidden" name="dtl_shift[]" id="dtl_shift" class="form-control w-auto dtl_shift" style="text-align: center;" value="shift_` + tbody.substr(-1) + `">
                                                        <input type="hidden" name="dtl_nama_mesin[]" id="dtl_nama_mesin" class="form-control w-auto dtl_nama_mesin" style="text-align: center;" value="` + list_item_row.item1 + `">
                                                        <input type="hidden" name="dtl_kode[]" id="dtl_kode" class="form-control w-auto dtl_kode" style="text-align: center;" value="` + children_row.item2 + `">
                                                        <input type="hidden" name="dtl_parameter[]" id="dtl_parameter" class="form-control w-auto dtl_parameter" style="text-align: center;" value="` + children_row.spek2 + `">
                                                        <input type="hidden" name="dtl_jml_per_mesin[]" id="dtl_jml_per_mesin" class="form-control w-auto dtl_jml_per_mesin" style="text-align: center;" value="` + result.data[key].children.length + `"></td>
                                                    ` + vitem1 + `
                                                    <td align="center">` + children_row.item2 + `</td>
                                                    <td align="left">` + children_row.spek2 + `</td>`;
                                            let alphabet = ["", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
                                            for (let j = 1; j <= 8; j++) {
                                                if (children_row.spek2 == 'UF Feed Pressure (Bar)') {
                                                    list_dtl += `
                                                        <td align="center"><input type="text" name="dtl_cek_shift_jam${j}[]" id="hasil_` + alphabet[j] + `_` + no2 + `" class="form-control angkadantitik w-auto dtl_cek_shift_jam${j} hasil_` + alphabet[j] + `_` + no2 + ` kurang1" style="text-align: center;" value=""></td>
                                                        `;
                                                } else if (children_row.spek2 == 'UF Filtrate Pressure (Bar)') {
                                                    list_dtl += `
                                                        <td align="center"><input type="text" name="dtl_cek_shift_jam${j}[]" id="hasil_` + alphabet[j] + `_` + no2 + `" class="form-control angkadantitik w-auto dtl_cek_shift_jam${j} hasil_` + alphabet[j] + `_` + no2 + ` kurang2" style="text-align: center;" value=""></td>
                                                        `;
                                                } else if (children_row.spek2 == 'TMP (Bar)') {
                                                    list_dtl += `
                                                        <td align="center"><input type="text" name="dtl_cek_shift_jam${j}[]" id="hasil_` + alphabet[j] + `_` + no2 + `" class="form-control angkadantitik w-auto dtl_cek_shift_jam${j} hasil_` + alphabet[j] + `_` + no2 + ` total_kurang" style="text-align: center;" value=""></td>
                                                        `;
                                                } else {
                                                list_dtl += `<td align="center"><input type="text" name="dtl_cek_shift_jam${j}[]" id="dtl_cek_shift_jam${j}" class="form-control angkadantitik w-auto dtl_cek_shift_jam${j}" style="text-align: center;" value=""></td>`;
                                                }
                                            }
                                            list_dtl += '</tr>';
                                        }
                                    });
                                }
                            });

                            $('#' + tbody).append(list_dtl);
                            get_minus_row();
                            // get_plus_row();
                            // get_divided_row();
                        }
                    }
                });
            }
        }

        function get_minus_row() {

            //fungssi Pengurangan
            $(document).on('change', '.kurang1', function() {
                var id = $(this).attr('id');
                hitung_rata2(id);
            });

            $(document).on('change', '.kurang2', function() {
                var id = $(this).attr('id');
                hitung_rata2(id);
            });

            function hitung_rata2(id) {
                var kurang1 = $('[class~=' + id + '][class~=kurang1]').val();
                var kurang2 = $('[class~=' + id + '][class~=kurang2]').val();
                console.log(kurang1, kurang2);
                var hasil = '';
                //hasil Pengurangan
                if (kurang1 != '' && kurang2 != '') {
                    hasil = (parseFloat(kurang1) - parseFloat(kurang2));
                }
                console.log(hasil, kurang1, kurang2);
                $('[class~=' + id + '][class~=total_kurang]').val(hasil);


                }
            }

        function get_plus_row() {

            //fungssi penambahan
            $(document).on('change', '.tambah1', function() {
                var id = $(this).attr('id');
                hitung_rata2(id);
            });

            $(document).on('change', '.tambah2', function() {
                var id = $(this).attr('id');
                hitung_rata2(id);
            });

            function hitung_rata2(id) {
                var tambah1 = $('[class~=' + id + '][class~=tambah1]').val();
                var tambah2 = $('[class~=' + id + '][class~=tambah2]').val();
                console.log(tambah1, tambah2);
                var hasil = '';
                //hasil penambahan
                if (tambah1 != '' && tambah2 != '') {
                    hasil = (parseFloat(tambah1) + parseFloat(tambah2));
                }
                console.log(hasil, tambah1, tambah2);
                $('[class~=' + id + '][class~=total_tambah]').val(hasil);

                //hasil pembagian
                if (tambah1 != '' && tambah2 != '' && hasil != '') {
                    hasil_bagi = Math.round((parseFloat(tambah1) / parseFloat(hasil)) * 100);
                    $('[class~=' + id + '][class~=total_bagi]').val(hasil_bagi);
                    // $('[class~=' + id + '][class~=total_bagi]').val(hasil_bagi + ' %');
                }


            }
        }

        get_plus_row();
        get_minus_row();
        get_docno();

        $('.create_date').change(function() {
            get_docno();
        });

        // info halaman per shift
        info_laman();

        function info_laman() {
            var shift = $('#page_shift').val();

            switch (shift) {
                case 'Shift 1':
                case 'Shift 2':
                case 'Shift 3':
                    toastr.info('Halaman ' + shift, '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    break;

                default:
                    break;
            }

            switch (shift) {
                case 'Shift 2':
                    toastr.success('Shift 1 telah komplit', '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    break;
                case 'Shift 3':
                    toastr.success('Shift 1 telah komplit', '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    toastr.success('Shift 2 telah komplit', '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    break;
                case 'Shift Komplit':
                    toastr.success('Shift 1 telah komplit', '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    toastr.success('Shift 2 telah komplit', '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    toastr.success('Shift 3 telah komplit', '', {
                        "closeButton": true,
                        "timeOut": 0,
                    });
                    break;

                default:
                    break;
            }
        }
        // end info halaman per shift

    });
</script>

<?php $this->load->view('template/footbarend'); ?>