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

                        <?php $this->load->view('template/V_onprocess'); ?>

                        <form action="<?= base_url('form_input/C_formintwtd017_00/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formintwtd017" name="formintwtd017" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
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
                                            <?php
                                            $jam = "08"; // start jam 
                                            $menit = "00"; //menit untuk tampilan doang
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
                                                                        <!-- 1 -->
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center" rowspan="3">Jam</th>
                                                                            <th class="table-primary align-middle text-center" colspan="6">Sedimen</th>
                                                                            <th class="table-primary align-middle text-center" colspan="3">Cone Clarifier</th>
                                                                            <th class="table-primary align-middle text-center" colspan="14">TANGKI SAND FILTER</th>
                                                                            <th class="table-primary align-middle text-center" colspan="12">TANGKI CARBON FILTER</th>
                                                                            <th class="table-primary align-middle text-center" colspan="5">TANGKI SOFTENER</th>
                                                                            <th class="table-primary align-middle text-center" colspan="3">BAK DEMIN</th>
                                                                            <th class="table-primary align-middle text-center" colspan="3">BAK 2</th>
                                                                            <th class="table-primary align-middle text-center" colspan="3">BAK 3</th>
                                                                            <th class="table-primary align-middle text-center" colspan="3">BAK 4</th>
                                                                        </tr>
                                                                        <!-- 2 -->
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center" colspan="2">PH</th>
                                                                            <th class="table-primary align-middle text-center" colspan="2">COLOUR</th>
                                                                            <th class="table-primary align-middle text-center" colspan="2">TDS</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">PH</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">COLOUR</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">TDS</th>
                                                                            <th class="table-primary align-middle text-center" colspan="7">COLOUR</th>
                                                                            <th class="table-primary align-middle text-center" colspan="7">TURBIDITY</th>
                                                                            <th class="table-primary align-middle text-center" colspan="6">COLOUR</th>
                                                                            <th class="table-primary align-middle text-center" colspan="6">TURBIDITY</th>
                                                                            <th class="table-primary align-middle text-center" colspan="5">TOTAL HARDNESS</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">PH</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">COLOUR</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">TBD</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">PH</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">COLOUR</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">TBD</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">PH</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">COLOUR</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">TBD</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">PH</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">COLOUR</th>
                                                                            <th class="table-primary align-middle text-center" rowspan="2">TBD</th>
                                                                        </tr>
                                                                        <!-- 3 -->
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center">6A</th>
                                                                            <th class="table-primary align-middle text-center">6B</th>
                                                                            <th class="table-primary align-middle text-center">6A</th>
                                                                            <th class="table-primary align-middle text-center">6B</th>
                                                                            <th class="table-primary align-middle text-center">6A</th>
                                                                            <th class="table-primary align-middle text-center">6B</th>
                                                                            <?php for ($k = 1; $k <= 7; $k++) { ?>
                                                                                <th class="table-primary align-middle text-center">SF<?= $k ?></th>
                                                                            <?php } ?>
                                                                            <?php for ($k = 1; $k <= 7; $k++) { ?>
                                                                                <th class="table-primary align-middle text-center">SF<?= $k ?></th>
                                                                            <?php } ?>
                                                                            <?php for ($k = 1; $k <= 6; $k++) { ?>
                                                                                <th class="table-primary align-middle text-center">CF<?= $k ?></th>
                                                                            <?php } ?>
                                                                            <?php for ($k = 1; $k <= 6; $k++) { ?>
                                                                                <th class="table-primary align-middle text-center">CF<?= $k ?></th>
                                                                            <?php } ?>
                                                                            <?php for ($k = 1; $k <= 5; $k++) { ?>
                                                                                <th class="table-primary align-middle text-center">ST<?= $k ?></th>
                                                                            <?php } ?>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="table-primary align-middle text-center">SPECIFICATION</th>
                                                                            <th class="table-primary align-middle text-center" colspan="2">4.5 - 6.5</th>
                                                                            <th class="table-primary align-middle text-center" colspan="2">80-110</th>
                                                                            <th class="table-primary align-middle text-center" colspan="2">500 max</th>
                                                                            <th class="table-primary align-middle text-center">5.0 - 7.0</th>
                                                                            <th class="table-primary align-middle text-center">80 - 110</th>
                                                                            <th class="table-primary align-middle text-center">500 max</th>
                                                                            <?php for ($k = 1; $k <= 7; $k++) { ?>
                                                                                <th class="table-primary align-middle text-center">50</th>
                                                                            <?php } ?>
                                                                            <?php for ($k = 1; $k <= 7; $k++) { ?>
                                                                                <th class="table-primary align-middle text-center">5</th>
                                                                            <?php } ?>
                                                                            <?php for ($k = 1; $k <= 6; $k++) { ?>
                                                                                <th class="table-primary align-middle text-center">50</th>
                                                                            <?php } ?>
                                                                            <?php for ($k = 1; $k <= 6; $k++) { ?>
                                                                                <th class="table-primary align-middle text-center">3</th>
                                                                            <?php } ?>
                                                                            <?php for ($k = 1; $k <= 5; $k++) { ?>
                                                                                <th class="table-primary align-middle text-center">20</th>
                                                                            <?php } ?>
                                                                            <th class="table-primary align-middle text-center">6.5-8.5</th>
                                                                            <th class="table-primary align-middle text-center">50</th>
                                                                            <th class="table-primary align-middle text-center">3</th>
                                                                            <th class="table-primary align-middle text-center">6.5-8.5</th>
                                                                            <th class="table-primary align-middle text-center">50</th>
                                                                            <th class="table-primary align-middle text-center">5</th>
                                                                            <th class="table-primary align-middle text-center">6.5-8.5</th>
                                                                            <th class="table-primary align-middle text-center">50</th>
                                                                            <th class="table-primary align-middle text-center">3</th>
                                                                            <th class="table-primary align-middle text-center">6.5-8.5</th>
                                                                            <th class="table-primary align-middle text-center">50</th>
                                                                            <th class="table-primary align-middle text-center">3</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbody_sf<?= $i ?>">
                                                                        <?php
                                                                        $jam = "08";
                                                                        $menit = "00";
                                                                        ?>
                                                                        <?php if ($jam == "24") {
                                                                            $jam = "00";
                                                                        }
                                                                        if (isset($dtheader)) {
                                                                            # code...
                                                                            foreach ($dtdetail as $dtdetail_row) {
                                                                                # code...
                                                                                if ($dtdetail_row->shift == 'shift_' . $i) { ?>
                                                                                    <tr>
                                                                                        <input type="hidden" name="dtl_shift[]" id="dtl_shift" class="form-control w-auto dtl_shift" style="text-align: center;" value="<?= $dtdetail_row->shift ?>">
                                                                                        <input type="hidden" name="dtl_detail_id[]" id="dtl_detail_id" class="form-control w-auto dtl_detail_id" style="text-align: center;" value="<?= $dtdetail_row->detail_id ?>">
                                                                                        <td><input type="hidden" name="dtl_jam[]" class="form-control angkadantitik w-auto dtl_jam" style="max-width: 50px;" id="dtl_jam" value="<?= $dtdetail_row->jam ?>"><?= $dtdetail_row->jam ?></td>
                                                                                        <td align="center"><input type="text" name="dtl_sedimen_ph_6a[]" class="form-control angkadantitik w-auto dtl_sedimen_ph_6a" style="max-width: 50px;" id="dtl_sedimen_ph_6a" value="<?= $dtdetail_row->sedimen_ph_6a ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_sedimen_ph_6b[]" class="form-control angkadantitik w-auto dtl_sedimen_ph_6b" style="max-width: 50px;" id="dtl_sedimen_ph_6b" value="<?= $dtdetail_row->sedimen_ph_6b ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_sedimen_colour_6a[]" class="form-control angkadantitik w-auto dtl_sedimen_colour_6a" style="max-width: 50px;" id="dtl_sedimen_colour_6a" value="<?= $dtdetail_row->sedimen_colour_6a ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_sedimen_colour_6b[]" class="form-control angkadantitik w-auto dtl_sedimen_colour_6b" style="max-width: 50px;" id="dtl_sedimen_colour_6b" value="<?= $dtdetail_row->sedimen_colour_6b ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_sedimen_tds_6a[]" class="form-control angkadantitik w-auto dtl_sedimen_tds_6a" style="max-width: 50px;" id="dtl_sedimen_tds_6a" value="<?= $dtdetail_row->sedimen_tds_6a ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_sedimen_tds_6b[]" class="form-control angkadantitik w-auto dtl_sedimen_tds_6b" style="max-width: 50px;" id="dtl_sedimen_tds_6b" value="<?= $dtdetail_row->sedimen_tds_6b ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_cone_ph[]" class="form-control angkadantitik w-auto dtl_cone_ph" style="max-width: 50px;" id="dtl_cone_ph" value="<?= $dtdetail_row->cone_ph ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_cone_colour[]" class="form-control angkadantitik w-auto dtl_cone_colour" style="max-width: 50px;" id="dtl_cone_colour" value="<?= $dtdetail_row->cone_colour ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_cone_tds[]" class="form-control angkadantitik w-auto dtl_cone_tds" style="max-width: 50px;" id="dtl_cone_tds" value="<?= $dtdetail_row->cone_tds ?>"></td>
                                                                                        <?php for ($j = 1; $j <= 7; $j++) { ?>
                                                                                            <td align="center"><input type="text" name="<?= 'dtl_tsf_colour_sf' . $j ?>[]" class="form-control angkadantitik w-auto <?= 'dtl_tsf_colour_sf' . $j ?>" style="max-width: 50px;" id="<?= 'dtl_tsf_colour_sf' . $j ?>" value="<?= $dtdetail_row->{'tsf_colour_sf' . $j}  ?>"></td>
                                                                                        <?php } ?>
                                                                                        <?php for ($j = 1; $j <= 7; $j++) { ?>
                                                                                            <td align="center"><input type="text" name="<?= 'dtl_tsf_turbidity_sf' . $j ?>[]" class="form-control angkadantitik w-auto <?= 'dtl_tsf_turbidity_sf' . $j ?>" style="max-width: 50px;" id="<?= 'dtl_tsf_turbidity_sf' . $j ?>" value="<?= $dtdetail_row->{'tsf_turbidity_sf' . $j}  ?>"></td>
                                                                                        <?php } ?>
                                                                                        <?php for ($j = 1; $j <= 6; $j++) { ?>
                                                                                            <td align="center"><input type="text" name="<?= 'dtl_tcf_colour_cf' . $j ?>[]" class="form-control angkadantitik w-auto <?= 'dtl_tcf_colour_cf' . $j ?>" style="max-width: 50px;" id="<?= 'dtl_tcf_colour_cf' . $j ?>" value="<?= $dtdetail_row->{'tcf_colour_cf' . $j}  ?>"></td>
                                                                                        <?php } ?>
                                                                                        <?php for ($j = 1; $j <= 6; $j++) { ?>
                                                                                            <td align="center"><input type="text" name="<?= 'dtl_tcf_turbidity_cf' . $j ?>[]" class="form-control angkadantitik w-auto <?= 'dtl_tcf_turbidity_cf' . $j ?>" style="max-width: 50px;" id="<?= 'dtl_tcf_turbidity_cf' . $j ?>" value="<?= $dtdetail_row->{'tcf_turbidity_cf' . $j}  ?>"></td>
                                                                                        <?php } ?>
                                                                                        <?php for ($j = 1; $j <= 5; $j++) { ?>
                                                                                            <td align="center"><input type="text" name="<?= 'dtl_ts_th_st' . $j ?>[]" class="form-control angkadantitik w-auto <?= 'dtl_ts_th_st' . $j ?>" style="max-width: 50px;" id="<?= 'dtl_ts_th_st' . $j ?>" value="<?= $dtdetail_row->{'ts_th_st' . $j}  ?>"></td>
                                                                                        <?php } ?>
                                                                                        <td align="center"><input type="text" name="dtl_bak_demin_ph[]" class="form-control angkadantitik w-auto dtl_bak_demin_ph" style="max-width: 50px;" id="dtl_bak_demin_ph" value="<?= $dtdetail_row->bak_demin_ph ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_bak_demin_colour[]" class="form-control angkadantitik w-auto dtl_bak_demin_colour" style="max-width: 50px;" id="dtl_bak_demin_colour" value="<?= $dtdetail_row->bak_demin_colour ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_bak_demin_tbd[]" class="form-control angkadantitik w-auto dtl_bak_demin_tbd" style="max-width: 50px;" id="dtl_bak_demin_tbd" value="<?= $dtdetail_row->bak_demin_tbd ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_bak2_ph[]" class="form-control angkadantitik w-auto dtl_bak2_ph" style="max-width: 50px;" id="dtl_bak2_ph" value="<?= $dtdetail_row->bak2_ph ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_bak2_colour[]" class="form-control angkadantitik w-auto dtl_bak2_colour" style="max-width: 50px;" id="dtl_bak2_colour" value="<?= $dtdetail_row->bak2_colour ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_bak2_tbd[]" class="form-control angkadantitik w-auto dtl_bak2_tbd" style="max-width: 50px;" id="dtl_bak2_tbd" value="<?= $dtdetail_row->bak2_tbd ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_bak3_ph[]" class="form-control angkadantitik w-auto dtl_bak3_ph" style="max-width: 50px;" id="dtl_bak3_ph" value="<?= $dtdetail_row->bak3_ph ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_bak3_colour[]" class="form-control angkadantitik w-auto dtl_bak3_colour" style="max-width: 50px;" id="dtl_bak3_colour" value="<?= $dtdetail_row->bak3_colour ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_bak3_tbd[]" class="form-control angkadantitik w-auto dtl_bak3_tbd" style="max-width: 50px;" id="dtl_bak3_tbd" value="<?= $dtdetail_row->bak3_tbd ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_bak4_ph[]" class="form-control angkadantitik w-auto dtl_bak4_ph" style="max-width: 50px;" id="dtl_bak4_ph" value="<?= $dtdetail_row->bak4_ph ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_bak4_colour[]" class="form-control angkadantitik w-auto dtl_bak4_colour" style="max-width: 50px;" id="dtl_bak4_colour" value="<?= $dtdetail_row->bak4_colour ?>"></td>
                                                                                        <td align="center"><input type="text" name="dtl_bak4_tbd[]" class="form-control angkadantitik w-auto dtl_bak4_tbd" style="max-width: 50px;" id="dtl_bak4_tbd" value="<?= $dtdetail_row->bak4_tbd ?>"></td>

                                                                                    </tr>
                                                                                    <?php
                                                                                    $jam = $jam + "02"; ?>

                                                                    </tbody>
                                                        <?php }
                                                                            }
                                                                        } ?>
                                                        <tfoot>
                                                            <tr>
                                                                <th class="table-primary align-middle text-center" colspan="53"></th>
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
                                                                        <th class="table-danger align-middle text-center">Jam</th>
                                                                        <th class="table-danger align-middle text-center">Ketidaksesuaian</th>
                                                                        <th class="table-danger align-middle text-center">Corrective Action</th>
                                                                        <th class="table-danger align-middle text-center">Keterangan</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody4">
                                                                    <?php if (isset($dtdetail_b)) {
                                                                        foreach ($dtdetail_b as $dtdetail_row2) {
                                                                    ?>
                                                                            <tr>
                                                                                <input type="hidden" name="dtl_b_detail_id[]" id="dtl_b_detail_id" class="form-control dtl_detail_id_b" style="text-align: center;" value="<?= $dtdetail_row2->detail_id ?>">
                                                                                <!-- <td><input name="dtl_b_chk[]" type="checkbox" value="<?= $dtdetail_row2->shift . ' ' . $dtdetail_row2->detail_id ?>"></td> -->
                                                                                <td><input name="dtl_b_chk[]" type="checkbox" value="<?= $dtdetail_row2->detail_id ?>"></td>

                                                                                <td align="center"><input type="text" name="dtl_b_jam[]" id="dtl_b_jam" class=" masktime form-control dtl_b_jam" style="text-align: center;" value="<?= $dtdetail_row2->jam ?>"></td>
                                                                                <td align="center"><input type="text" name="dtl_b_uraian[]" id="dtl_b_uraian" class="form-control dtl_b_uraian" value="<?= $dtdetail_row2->uraian ?>"></td>
                                                                                <td align="center"><input type="text" name="dtl_b_tindakan[]" id="dtl_b_tindakan" class="form-control dtl_b_tindakan" value="<?= $dtdetail_row2->tindakan ?>"></td>
                                                                                <td align="center"><input type="text" name="dtl_b_keterangan[]" id="dtl_b_keterangan" class="form-control dtl_b_keterangan" style="text-align: center;" value="<?= $dtdetail_row2->keterangan ?>"></td>
                                                                            </tr>
                                                                        <?php }
                                                                    } else { ?>

                                                                        <tr>
                                                                            <td><input name="dtlb_chk[]" type="checkbox" value=""></td>

                                                                            <td align="center"><input type="text" name="dtl_b_jam[]" id="dtl_b_jam" class=" masktime form-control angkadantitik  dtl_b_jam" style="text-align: center;" value=""></td>
                                                                            <td align="center"><input type="text" name="dtl_b_uraian[]" id="dtl_b_uraian" class="form-control dtl_b_uraian" value=""></td>
                                                                            <td align="center"><input type="text" name="dtl_b_tindakan[]" id="dtl_b_tindakan" class="form-control dtl_b_tindakan" value=""></td>
                                                                            <td align="center"><input type="text" name="dtl_b_keterangan[]" id="dtl_b_keterangan" class="form-control dtl_b_keterangan" style="text-align: center;" value=""></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td class="table-danger align-middle text-center" colspan="11" align="center">
                                                                            <?php if (!isset($dtdetail_b)) {
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
                    url: "<?= base_url(); ?>index.php/form_input/C_formintwtd017_00/get_docno/intwtd017/00",
                    data: {
                        create_date
                    },
                    success: function(data) {
                        $('.docno').val(JSON.parse(data)['data']);
                    }
                });

                get_item('dtl', '', '');
            }
        }


        function get_item(tbl, tbody, tipe_dtl) {
            let input_headerid = $(".headerid").val();
            let create_date = $('.create_date').val();

            $('#tbody_sf1').empty();
            $('#tbody_sf2').empty();
            $('#tbody_sf3').empty();

            if (typeof(input_headerid) == "undefined" && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formintwtd017_00/get_docno/intwtd017/00",
                    dataType: "json",
                    data: {
                        create_date
                    },
                    success: function(result) {
                        let jam_sf1 = 8;
                        let jam_sf2 = 16;
                        let jam_sf3 = 0;
                        let menit = "00";
                        let list_dtl_sf1 = '';
                        let list_dtl_sf2 = '';
                        let list_dtl_sf3 = '';
                        for (let i = 1; i <= 4; i++) {
                            list_dtl_sf1 += `<tr> 
                                            <input type="hidden" name="dtl_shift[]" id="dtl_shift" class="form-control w-auto dtl_shift" style="text-align: center;" value="shift_1">
                                            <td><input type="hidden" name="dtl_jam[]" class="form-control angkadantitik w-auto dtl_jam" style="max-width: 50px;" id="dtl_jam" value='${jam_sf1}:${menit}'>${jam_sf1}:${menit}</td>
                                            <td align="center"><input type="text" name="dtl_sedimen_ph_6a[]" class="form-control angkadantitik w-auto dtl_sedimen_ph_6a" style="max-width: 50px;" id="dtl_sedimen_ph_6a"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_ph_6b[]" class="form-control angkadantitik w-auto dtl_sedimen_ph_6b" style="max-width: 50px;" id="dtl_sedimen_ph_6b"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_colour_6a[]" class="form-control angkadantitik w-auto dtl_sedimen_colour_6a" style="max-width: 50px;" id="dtl_sedimen_colour_6a"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_colour_6b[]" class="form-control angkadantitik w-auto dtl_sedimen_colour_6b" style="max-width: 50px;" id="dtl_sedimen_colour_6b"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_tds_6a[]" class="form-control angkadantitik w-auto dtl_sedimen_tds_6a" style="max-width: 50px;" id="dtl_sedimen_tds_6a"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_tds_6b[]" class="form-control angkadantitik w-auto dtl_sedimen_tds_6b" style="max-width: 50px;" id="dtl_sedimen_tds_6b"></td>
                                            <td align="center"><input type="text" name="dtl_cone_ph[]" class="form-control angkadantitik w-auto dtl_cone_ph" style="max-width: 50px;" id="dtl_cone_ph"></td>
                                            <td align="center"><input type="text" name="dtl_cone_colour[]" class="form-control angkadantitik w-auto dtl_cone_colour" style="max-width: 50px;" id="dtl_cone_colour"></td>
                                            <td align="center"><input type="text" name="dtl_cone_tds[]" class="form-control angkadantitik w-auto dtl_cone_tds" style="max-width: 50px;" id="dtl_cone_tds"></td>`;
                            for (let j = 1; j <= 7; j++) {
                                list_dtl_sf1 += `<td align="center"><input type="text" name="dtl_tsf_colour_sf${j}[]" class="form-control angkadantitik w-auto dtl_tsf_colour_sf${j}" style="max-width: 50px;" id="dtl_tsf_colour_sf${j}"></td>`;
                            }
                            for (let j = 1; j <= 7; j++) {
                                list_dtl_sf1 += `<td align="center"><input type="text" name="dtl_tsf_turbidity_sf${j}[]" class="form-control angkadantitik w-auto dtl_tsf_turbidity_sf${j}" style="max-width: 50px;" id="dtl_tsf_turbidity_sf${j}"></td>`;
                            }
                            for (let j = 1; j <= 6; j++) {
                                list_dtl_sf1 += `<td align="center"><input type="text" name="dtl_tcf_colour_cf${j}[]" class="form-control angkadantitik w-auto dtl_tcf_colour_cf${j}" style="max-width: 50px;" id="dtl_tcf_colour_cf${j}"></td>`;
                            }
                            for (let j = 1; j <= 6; j++) {
                                list_dtl_sf1 += `<td align="center"><input type="text" name="dtl_tcf_turbidity_cf${j}[]" class="form-control angkadantitik w-auto dtl_tcf_turbidity_cf${j}" style="max-width: 50px;" id="dtl_tcf_turbidity_cf${j}"></td>`;
                            }
                            for (let j = 1; j <= 5; j++) {
                                list_dtl_sf1 += `<td align="center"><input type="text" name="dtl_ts_th_st${j}[]" class="form-control angkadantitik w-auto dtl_ts_th_st${j}" style="max-width: 50px;" id=" dtl_ts_th_st${j} "></td>`;
                            }
                            list_dtl_sf1 += `<td align="center"><input type="text" name="dtl_bak_demin_ph[]" class="form-control angkadantitik w-auto dtl_bak_demin_ph" style="max-width: 50px;" id="dtl_bak_demin_ph"></td>
                                        <td align="center"><input type="text" name="dtl_bak_demin_colour[]" class="form-control angkadantitik w-auto dtl_bak_demin_colour" style="max-width: 50px;" id="dtl_bak_demin_colour"></td>
                                        <td align="center"><input type="text" name="dtl_bak_demin_tbd[]" class="form-control angkadantitik w-auto dtl_bak_demin_tbd" style="max-width: 50px;" id="dtl_bak_demin_tbd"></td>
                                        <td align="center"><input type="text" name="dtl_bak2_ph[]" class="form-control angkadantitik w-auto dtl_bak2_ph" style="max-width: 50px;" id="dtl_bak2_ph"></td>
                                        <td align="center"><input type="text" name="dtl_bak2_colour[]" class="form-control angkadantitik w-auto dtl_bak2_colour" style="max-width: 50px;" id="dtl_bak2_colour"></td>
                                        <td align="center"><input type="text" name="dtl_bak2_tbd[]" class="form-control angkadantitik w-auto dtl_bak2_tbd" style="max-width: 50px;" id="dtl_bak2_tbd"></td>
                                        <td align="center"><input type="text" name="dtl_bak3_ph[]" class="form-control angkadantitik w-auto dtl_bak3_ph" style="max-width: 50px;" id="dtl_bak3_ph"></td>
                                        <td align="center"><input type="text" name="dtl_bak3_colour[]" class="form-control angkadantitik w-auto dtl_bak3_colour" style="max-width: 50px;" id="dtl_bak3_colour"></td>
                                        <td align="center"><input type="text" name="dtl_bak3_tbd[]" class="form-control angkadantitik w-auto dtl_bak3_tbd" style="max-width: 50px;" id="dtl_bak3_tbd"></td>
                                        <td align="center"><input type="text" name="dtl_bak4_ph[]" class="form-control angkadantitik w-auto dtl_bak4_ph" style="max-width: 50px;" id="dtl_bak4_ph"></td>
                                        <td align="center"><input type="text" name="dtl_bak4_colour[]" class="form-control angkadantitik w-auto dtl_bak4_colour" style="max-width: 50px;" id="dtl_bak4_colour"></td>
                                        <td align="center"><input type="text" name="dtl_bak4_tbd[]" class="form-control angkadantitik w-auto dtl_bak4_tbd" style="max-width: 50px;" id="dtl_bak4_tbd"></td>`;
                            list_dtl_sf1 += '</tr>';

                            jam_sf1 = jam_sf1 + 2;

                            list_dtl_sf2 += `<tr> 
                                            <input type="hidden" name="dtl_shift[]" id="dtl_shift" class="form-control w-auto dtl_shift" style="text-align: center;" value="shift_2">
                                            <td><input type="hidden" name="dtl_jam[]" class="form-control angkadantitik w-auto dtl_jam" style="max-width: 50px;" id="dtl_jam" value='${jam_sf2}:${menit}'>${jam_sf2}:${menit}</td>
                                            <td align="center"><input type="text" name="dtl_sedimen_ph_6a[]" class="form-control angkadantitik w-auto dtl_sedimen_ph_6a" style="max-width: 50px;" id="dtl_sedimen_ph_6a"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_ph_6b[]" class="form-control angkadantitik w-auto dtl_sedimen_ph_6b" style="max-width: 50px;" id="dtl_sedimen_ph_6b"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_colour_6a[]" class="form-control angkadantitik w-auto dtl_sedimen_colour_6a" style="max-width: 50px;" id="dtl_sedimen_colour_6a"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_colour_6b[]" class="form-control angkadantitik w-auto dtl_sedimen_colour_6b" style="max-width: 50px;" id="dtl_sedimen_colour_6b"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_tds_6a[]" class="form-control angkadantitik w-auto dtl_sedimen_tds_6a" style="max-width: 50px;" id="dtl_sedimen_tds_6a"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_tds_6b[]" class="form-control angkadantitik w-auto dtl_sedimen_tds_6b" style="max-width: 50px;" id="dtl_sedimen_tds_6b"></td>
                                            <td align="center"><input type="text" name="dtl_cone_ph[]" class="form-control angkadantitik w-auto dtl_cone_ph" style="max-width: 50px;" id="dtl_cone_ph"></td>
                                            <td align="center"><input type="text" name="dtl_cone_colour[]" class="form-control angkadantitik w-auto dtl_cone_colour" style="max-width: 50px;" id="dtl_cone_colour"></td>
                                            <td align="center"><input type="text" name="dtl_cone_tds[]" class="form-control angkadantitik w-auto dtl_cone_tds" style="max-width: 50px;" id="dtl_cone_tds"></td>`;
                            for (let j = 1; j <= 7; j++) {
                                list_dtl_sf2 += `<td align="center"><input type="text" name="dtl_tsf_colour_sf${j}[]" class="form-control angkadantitik w-auto dtl_tsf_colour_sf${j}" style="max-width: 50px;" id="dtl_tsf_colour_sf${j}"></td>`;
                            }
                            for (let j = 1; j <= 7; j++) {
                                list_dtl_sf2 += `<td align="center"><input type="text" name="dtl_tsf_turbidity_sf${j}[]" class="form-control angkadantitik w-auto dtl_tsf_turbidity_sf${j}" style="max-width: 50px;" id="dtl_tsf_turbidity_sf${j}"></td>`;
                            }
                            for (let j = 1; j <= 6; j++) {
                                list_dtl_sf2 += `<td align="center"><input type="text" name="dtl_tcf_colour_cf${j}[]" class="form-control angkadantitik w-auto dtl_tcf_colour_cf${j}" style="max-width: 50px;" id="dtl_tcf_colour_cf${j}"></td>`;
                            }
                            for (let j = 1; j <= 6; j++) {
                                list_dtl_sf2 += `<td align="center"><input type="text" name="dtl_tcf_turbidity_cf${j}[]" class="form-control angkadantitik w-auto dtl_tcf_turbidity_cf${j}" style="max-width: 50px;" id="dtl_tcf_turbidity_cf${j}"></td>`;
                            }
                            for (let j = 1; j <= 5; j++) {
                                list_dtl_sf2 += `<td align="center"><input type="text" name="dtl_ts_th_st${j}[]" class="form-control angkadantitik w-auto dtl_ts_th_st${j}" style="max-width: 50px;" id=" dtl_ts_th_st${j} "></td>`;
                            }
                            list_dtl_sf2 += `<td align="center"><input type="text" name="dtl_bak_demin_ph[]" class="form-control angkadantitik w-auto dtl_bak_demin_ph" style="max-width: 50px;" id="dtl_bak_demin_ph"></td>
                                        <td align="center"><input type="text" name="dtl_bak_demin_colour[]" class="form-control angkadantitik w-auto dtl_bak_demin_colour" style="max-width: 50px;" id="dtl_bak_demin_colour"></td>
                                        <td align="center"><input type="text" name="dtl_bak_demin_tbd[]" class="form-control angkadantitik w-auto dtl_bak_demin_tbd" style="max-width: 50px;" id="dtl_bak_demin_tbd"></td>
                                        <td align="center"><input type="text" name="dtl_bak2_ph[]" class="form-control angkadantitik w-auto dtl_bak2_ph" style="max-width: 50px;" id="dtl_bak2_ph"></td>
                                        <td align="center"><input type="text" name="dtl_bak2_colour[]" class="form-control angkadantitik w-auto dtl_bak2_colour" style="max-width: 50px;" id="dtl_bak2_colour"></td>
                                        <td align="center"><input type="text" name="dtl_bak2_tbd[]" class="form-control angkadantitik w-auto dtl_bak2_tbd" style="max-width: 50px;" id="dtl_bak2_tbd"></td>
                                        <td align="center"><input type="text" name="dtl_bak3_ph[]" class="form-control angkadantitik w-auto dtl_bak3_ph" style="max-width: 50px;" id="dtl_bak3_ph"></td>
                                        <td align="center"><input type="text" name="dtl_bak3_colour[]" class="form-control angkadantitik w-auto dtl_bak3_colour" style="max-width: 50px;" id="dtl_bak3_colour"></td>
                                        <td align="center"><input type="text" name="dtl_bak3_tbd[]" class="form-control angkadantitik w-auto dtl_bak3_tbd" style="max-width: 50px;" id="dtl_bak3_tbd"></td>
                                        <td align="center"><input type="text" name="dtl_bak4_ph[]" class="form-control angkadantitik w-auto dtl_bak4_ph" style="max-width: 50px;" id="dtl_bak4_ph"></td>
                                        <td align="center"><input type="text" name="dtl_bak4_colour[]" class="form-control angkadantitik w-auto dtl_bak4_colour" style="max-width: 50px;" id="dtl_bak4_colour"></td>
                                        <td align="center"><input type="text" name="dtl_bak4_tbd[]" class="form-control angkadantitik w-auto dtl_bak4_tbd" style="max-width: 50px;" id="dtl_bak4_tbd"></td>`;
                            list_dtl_sf2 += '</tr>';

                            jam_sf2 = jam_sf2 + 2;

                            list_dtl_sf3 += `<tr> 
                                            <input type="hidden" name="dtl_shift[]" id="dtl_shift" class="form-control w-auto dtl_shift" style="text-align: center;" value="shift_3">
                                            <td><input type="hidden" name="dtl_jam[]" class="form-control angkadantitik w-auto dtl_jam" style="max-width: 50px;" id="dtl_jam" value='${jam_sf3}:${menit}'>${jam_sf3}:${menit}</td>
                                            <td align="center"><input type="text" name="dtl_sedimen_ph_6a[]" class="form-control angkadantitik w-auto dtl_sedimen_ph_6a" style="max-width: 50px;" id="dtl_sedimen_ph_6a"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_ph_6b[]" class="form-control angkadantitik w-auto dtl_sedimen_ph_6b" style="max-width: 50px;" id="dtl_sedimen_ph_6b"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_colour_6a[]" class="form-control angkadantitik w-auto dtl_sedimen_colour_6a" style="max-width: 50px;" id="dtl_sedimen_colour_6a"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_colour_6b[]" class="form-control angkadantitik w-auto dtl_sedimen_colour_6b" style="max-width: 50px;" id="dtl_sedimen_colour_6b"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_tds_6a[]" class="form-control angkadantitik w-auto dtl_sedimen_tds_6a" style="max-width: 50px;" id="dtl_sedimen_tds_6a"></td>
                                            <td align="center"><input type="text" name="dtl_sedimen_tds_6b[]" class="form-control angkadantitik w-auto dtl_sedimen_tds_6b" style="max-width: 50px;" id="dtl_sedimen_tds_6b"></td>
                                            <td align="center"><input type="text" name="dtl_cone_ph[]" class="form-control angkadantitik w-auto dtl_cone_ph" style="max-width: 50px;" id="dtl_cone_ph"></td>
                                            <td align="center"><input type="text" name="dtl_cone_colour[]" class="form-control angkadantitik w-auto dtl_cone_colour" style="max-width: 50px;" id="dtl_cone_colour"></td>
                                            <td align="center"><input type="text" name="dtl_cone_tds[]" class="form-control angkadantitik w-auto dtl_cone_tds" style="max-width: 50px;" id="dtl_cone_tds"></td>`;
                            for (let j = 1; j <= 7; j++) {
                                list_dtl_sf3 += `<td align="center"><input type="text" name="dtl_tsf_colour_sf${j}[]" class="form-control angkadantitik w-auto dtl_tsf_colour_sf${j}" style="max-width: 50px;" id="dtl_tsf_colour_sf${j}"></td>`;
                            }
                            for (let j = 1; j <= 7; j++) {
                                list_dtl_sf3 += `<td align="center"><input type="text" name="dtl_tsf_turbidity_sf${j}[]" class="form-control angkadantitik w-auto dtl_tsf_turbidity_sf${j}" style="max-width: 50px;" id="dtl_tsf_turbidity_sf${j}"></td>`;
                            }
                            for (let j = 1; j <= 6; j++) {
                                list_dtl_sf3 += `<td align="center"><input type="text" name="dtl_tcf_colour_cf${j}[]" class="form-control angkadantitik w-auto dtl_tcf_colour_cf${j}" style="max-width: 50px;" id="dtl_tcf_colour_cf${j}"></td>`;
                            }
                            for (let j = 1; j <= 6; j++) {
                                list_dtl_sf3 += `<td align="center"><input type="text" name="dtl_tcf_turbidity_cf${j}[]" class="form-control angkadantitik w-auto dtl_tcf_turbidity_cf${j}" style="max-width: 50px;" id="dtl_tcf_turbidity_cf${j}"></td>`;
                            }
                            for (let j = 1; j <= 5; j++) {
                                list_dtl_sf3 += `<td align="center"><input type="text" name="dtl_ts_th_st${j}[]" class="form-control angkadantitik w-auto dtl_ts_th_st${j}" style="max-width: 50px;" id=" dtl_ts_th_st${j} "></td>`;
                            }
                            list_dtl_sf3 += `<td align="center"><input type="text" name="dtl_bak_demin_ph[]" class="form-control angkadantitik w-auto dtl_bak_demin_ph" style="max-width: 50px;" id="dtl_bak_demin_ph"></td>
                                        <td align="center"><input type="text" name="dtl_bak_demin_colour[]" class="form-control angkadantitik w-auto dtl_bak_demin_colour" style="max-width: 50px;" id="dtl_bak_demin_colour"></td>
                                        <td align="center"><input type="text" name="dtl_bak_demin_tbd[]" class="form-control angkadantitik w-auto dtl_bak_demin_tbd" style="max-width: 50px;" id="dtl_bak_demin_tbd"></td>
                                        <td align="center"><input type="text" name="dtl_bak2_ph[]" class="form-control angkadantitik w-auto dtl_bak2_ph" style="max-width: 50px;" id="dtl_bak2_ph"></td>
                                        <td align="center"><input type="text" name="dtl_bak2_colour[]" class="form-control angkadantitik w-auto dtl_bak2_colour" style="max-width: 50px;" id="dtl_bak2_colour"></td>
                                        <td align="center"><input type="text" name="dtl_bak2_tbd[]" class="form-control angkadantitik w-auto dtl_bak2_tbd" style="max-width: 50px;" id="dtl_bak2_tbd"></td>
                                        <td align="center"><input type="text" name="dtl_bak3_ph[]" class="form-control angkadantitik w-auto dtl_bak3_ph" style="max-width: 50px;" id="dtl_bak3_ph"></td>
                                        <td align="center"><input type="text" name="dtl_bak3_colour[]" class="form-control angkadantitik w-auto dtl_bak3_colour" style="max-width: 50px;" id="dtl_bak3_colour"></td>
                                        <td align="center"><input type="text" name="dtl_bak3_tbd[]" class="form-control angkadantitik w-auto dtl_bak3_tbd" style="max-width: 50px;" id="dtl_bak3_tbd"></td>
                                        <td align="center"><input type="text" name="dtl_bak4_ph[]" class="form-control angkadantitik w-auto dtl_bak4_ph" style="max-width: 50px;" id="dtl_bak4_ph"></td>
                                        <td align="center"><input type="text" name="dtl_bak4_colour[]" class="form-control angkadantitik w-auto dtl_bak4_colour" style="max-width: 50px;" id="dtl_bak4_colour"></td>
                                        <td align="center"><input type="text" name="dtl_bak4_tbd[]" class="form-control angkadantitik w-auto dtl_bak4_tbd" style="max-width: 50px;" id="dtl_bak4_tbd"></td>`;
                            list_dtl_sf3 += '</tr>';

                            jam_sf3 = jam_sf3 + 2;
                        }
                        $('#tbody_sf1').append(list_dtl_sf1);
                        $('#tbody_sf2').append(list_dtl_sf2);
                        $('#tbody_sf3').append(list_dtl_sf3);
                    }
                });
            }
        }

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
    
        
    $(window).on('load', function() {
        get_spec_per_col_forminput('.dtl_sedimen_ph_6a', 'sedimen_ph', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_sedimen_ph_6b', 'sedimen_ph', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_sedimen_colour_6a', 'sedimen_colour', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_sedimen_colour_6b', 'sedimen_colour', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_sedimen_tds_6a', 'sedimen_tds', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_sedimen_tds_6b', 'sedimen_tds', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_cone_ph', 'cone_ph', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_cone_colour', 'cone_colour', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_cone_tds', 'cone_tds', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        <?php for ($j = 1; $j <= 7; $j++) { ?>
            get_spec_per_col_forminput("<?= '.dtl_tsf_colour_sf' . $j ?>", 'tsf_colour', '<?= $frmkd ?>', '<?= $frmvrs ?>')
            get_spec_per_col_forminput("<?= '.dtl_tsf_turbidity_sf' . $j ?>", 'tsf_turbidity', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        <?php }
        for ($j = 1; $j <= 6; $j++) { ?>
            get_spec_per_col_forminput("<?= '.dtl_tcf_colour_cf' . $j ?>", 'tcf_colour', '<?= $frmkd ?>', '<?= $frmvrs ?>')
            get_spec_per_col_forminput("<?= '.dtl_tcf_turbidity_cf' . $j ?>", 'tcf_turbidity', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        <?php }
        for ($j = 1; $j <= 5; $j++) { ?>
            get_spec_per_col_forminput("<?= '.dtl_ts_th_st' . $j ?>", 'ts_hardness', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        <?php } ?>
        get_spec_per_col_forminput('.dtl_bak_demin_ph', 'bak_demin_ph', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_bak_demin_colour', 'bak_demin_colour', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_bak_demin_tbd', 'bak_demin_tbd', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_bak2_ph', 'bak2_ph', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_bak2_colour', 'bak2_colour', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_bak2_tbd', 'bak2_tbd', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_bak3_ph', 'bak3_ph', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_bak3_colour', 'bak3_colour', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_bak3_tbd', 'bak3_tbd', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_bak4_ph', 'bak4_ph', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_bak4_colour', 'bak4_colour', '<?= $frmkd ?>', '<?= $frmvrs ?>')
        get_spec_per_col_forminput('.dtl_bak4_tbd', 'bak4_tbd', '<?= $frmkd ?>', '<?= $frmvrs ?>')
    });
</script>

<?php $this->load->view('template/footbarend'); ?>