<?php $this->load->view('template/headbar'); ?>

<?php foreach ($dtfrm as $dt_form) {
    $frmjdl       = $dt_form->formjudul;
    $frmefec      = date("d-m-Y", strtotime($dt_form->formefective));
    $frmnm        = $dt_form->formnm;
    $frmkd        = $dt_form->formkd;
    $frmket       = $dt_form->formket;
    $frmvrs       = $dt_form->formversi;
    $createby     = $dt_form->createby;
    $akses_create = $dt_form->form_create;
    $akses_update = $dt_form->form_update;
    $akses_delete = $dt_form->form_delete;
    $akses_excel  = $dt_form->form_excel;
}
$session_data           = $this->session->userdata('logged_in');
$userid     = $session_data['userid'];
if (isset($dtheader)) {
    $aksi  = "dtupdate";

    foreach ($dtheader as $dtheader_row) {
        $headerid                           = $dtheader_row->headerid;

        $comment                            = $dtheader_row->comment;
        $comment_by                         = $dtheader_row->comment_by;
        $comment_time                       = $dtheader_row->comment_time;
        $comment_date                       = date("d-m-Y", strtotime($dtheader_row->comment_date));

        $create_date                        = date("d-m-Y", strtotime($dtheader_row->create_date));
        $persen                             = $dtheader_row->persen;
        $docno                              = $dtheader_row->docno;

        $dtsampel_frmfss315_headerid        = $dtheader_row->dtsampel_frmfss315_headerid;
        $dtsampel_frmfss315_complete_date   = $dtheader_row->dtsampel_frmfss315_complete_date;
        $dtsampel_frmfss315_complete_time   = $dtheader_row->dtsampel_frmfss315_complete_time;
        $dtsampel_frmfss316_headerid        = $dtheader_row->dtsampel_frmfss316_headerid;
        $dtsampel_frmfss316_complete_date   = $dtheader_row->dtsampel_frmfss316_complete_date;
        $dtsampel_frmfss316_complete_time   = $dtheader_row->dtsampel_frmfss316_complete_time;
        $dtsampel_frmfss317_headerid        = $dtheader_row->dtsampel_frmfss317_headerid;
        $dtsampel_frmfss317_complete_date   = $dtheader_row->dtsampel_frmfss317_complete_date;
        $dtsampel_frmfss317_complete_time   = $dtheader_row->dtsampel_frmfss317_complete_time;
        $dtsampel_frmfss520_headerid        = $dtheader_row->dtsampel_frmfss520_headerid;
        $dtsampel_frmfss520_complete_date   = $dtheader_row->dtsampel_frmfss520_complete_date;
        $dtsampel_frmfss520_complete_time   = $dtheader_row->dtsampel_frmfss520_complete_time;
    }
} else if (isset($message)) {
    $aksi                               = "dtsave";

    $create_date                        = $dtcreate_date;
    $persen                             = $dtpersen;
    $docno                              = $dtdocno;

    $dtsampel_frmfss315_headerid        = '';
    $dtsampel_frmfss315_complete_date   = '';
    $dtsampel_frmfss315_complete_time   = '';
    $dtsampel_frmfss316_headerid        = '';
    $dtsampel_frmfss316_complete_date   = '';
    $dtsampel_frmfss316_complete_time   = '';
    $dtsampel_frmfss317_headerid        = '';
    $dtsampel_frmfss317_complete_date   = '';
    $dtsampel_frmfss317_complete_time   = '';
    $dtsampel_frmfss520_headerid        = '';
    $dtsampel_frmfss520_complete_date   = '';
    $dtsampel_frmfss520_complete_time   = '';
} else {
    $aksi        = "dtsave";
    $create_date = date("d-m-Y", strtotime($dtcreate_date));;
    $docno       = '';
    $persen      = $dtpersen;

    $dtsampel_frmfss315_headerid      = '';
    $dtsampel_frmfss315_complete_date = '';
    $dtsampel_frmfss315_complete_time = '';
    $dtsampel_frmfss316_headerid      = '';
    $dtsampel_frmfss316_complete_date = '';
    $dtsampel_frmfss316_complete_time = '';
    $dtsampel_frmfss317_headerid      = '';
    $dtsampel_frmfss317_complete_date = '';
    $dtsampel_frmfss317_complete_time = '';
    $dtsampel_frmfss520_headerid      = '';
    $dtsampel_frmfss520_complete_date = '';
    $dtsampel_frmfss520_complete_time = '';
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

                        <form action="<?= base_url('form_input/C_formfrmfss317_16/form/' . $frmkd . '/' . $frmvrs . '/' . $aksi) ?>" id="formfrmfss317" name="formfrmfss317" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
                            <div class="row mb-1">
                                <div class="col-6">

                                    <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?= $headerid; ?>" id="headerid" class="headerid">
                                    <?php } ?>

                                    <input type="hidden" name="dtsampel_frmfss315_headerid" id="dtsampel_frmfss315_headerid" class="form-control dtsampel_frmfss315_headerid" value="<?= $dtsampel_frmfss315_headerid ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss315_complete_date" id="dtsampel_frmfss315_complete_date" class="form-control dtsampel_frmfss315_complete_date" value="<?= $dtsampel_frmfss315_complete_date ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss315_complete_time" id="dtsampel_frmfss315_complete_time" class="form-control dtsampel_frmfss315_complete_time" value="<?= $dtsampel_frmfss315_complete_time ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss316_headerid" id="dtsampel_frmfss316_headerid" class="form-control dtsampel_frmfss316_headerid" value="<?= $dtsampel_frmfss316_headerid ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss316_complete_date" id="dtsampel_frmfss316_complete_date" class="form-control dtsampel_frmfss316_complete_date" value="<?= $dtsampel_frmfss316_complete_date ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss316_complete_time" id="dtsampel_frmfss316_complete_time" class="form-control dtsampel_frmfss316_complete_time" value="<?= $dtsampel_frmfss316_complete_time ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss317_headerid" id="dtsampel_frmfss317_headerid" class="form-control dtsampel_frmfss317_headerid" value="<?= $dtsampel_frmfss317_headerid ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss317_complete_date" id="dtsampel_frmfss317_complete_date" class="form-control dtsampel_frmfss317_complete_date" value="<?= $dtsampel_frmfss317_complete_date ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss317_complete_time" id="dtsampel_frmfss317_complete_time" class="form-control dtsampel_frmfss317_complete_time" value="<?= $dtsampel_frmfss317_complete_time ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss520_headerid" id="dtsampel_frmfss520_headerid" class="form-control dtsampel_frmfss520_headerid" value="<?= $dtsampel_frmfss520_headerid ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss520_complete_date" id="dtsampel_frmfss520_complete_date" class="form-control dtsampel_frmfss520_complete_date" value="<?= $dtsampel_frmfss520_complete_date ?>" required>
                                    <input type="hidden" name="dtsampel_frmfss520_complete_time" id="dtsampel_frmfss520_complete_time" class="form-control dtsampel_frmfss520_complete_time" value="<?= $dtsampel_frmfss520_complete_time ?>" required>

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

                                    <!--</?php if ($userid  == '846' || $userid == '844') { ?>-->
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            Persen
                                        </div>
                                        <div class="col-md-6">
                                            <?php if (isset($dtheader)) { ?>
                                                <input type="text" name="persen" id="persen" class="form-control persen" value="<?= $persen; ?>" required>
                                            <?php } else { ?>
                                                <input type="text" name="persen" id="persen" class="form-control persen" value="<?= $persen; ?>" required>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!--</?php } ?>-->

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            No. Dokumen
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="docno" id="docno" class="form-control docno dtopen_blok" value="<?= $docno; ?>" readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END HEADER -->

                            <div class="card-content">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Tabel A ditarik dari form 316 -->
                                        <strong>A. Data Harian Pemakaian Air WTD</strong>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="2" colspan="1">No.</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Uraian</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2" colspan="1">Pemakaian (M³)</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2" colspan="1">%</th>
                                                        <th class="table-primary align-middle text-center" rowspan="2" colspan="1">Akumulatif</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Supplay Air</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Departemen Pemakai</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_a">
                                                    <?php
                                                    $dtl_a_grand_total_pemakaian = '';
                                                    $dtl_a_grand_total_persen = '';
                                                    $dtl_a_grand_total_akumulatif = '';
                                                    $dtl_a_total_pemakaian = 0;
                                                    $dtl_a_total_persen = 0;
                                                    $dtl_a_total_akumulatif = 0;
                                                    if (isset($dtdetail)) {
                                                        $no = 1;
                                                        foreach ($dtdetail as $dtdetail_row_key => $dtdetail_row) {
                                                            $dtl_a_grand_total_pemakaian    += $dtdetail_row->pemakaian;
                                                            $dtl_a_grand_total_persen       += $dtdetail_row->persen;
                                                            $dtl_a_grand_total_akumulatif   += $dtdetail_row->akumulatif;

                                                            if ($no == 1) {
                                                                $dtl_a_total_pemakaian = $dtdetail_row->pemakaian;
                                                                $dtl_a_total_persen = number_format($dtdetail_row->persen, 1);
                                                                $dtl_a_total_akumulatif = $dtdetail_row->akumulatif;
                                                            } else {
                                                                if ($dtdetail_row->nama_jenis_air == $dtdetail[$dtdetail_row_key - 1]->nama_jenis_air) {
                                                                    $dtl_a_total_pemakaian += $dtdetail_row->pemakaian;
                                                                    $dtl_a_total_persen += number_format($dtdetail_row->persen, 1);
                                                                    $dtl_a_total_akumulatif += $dtdetail_row->akumulatif;
                                                                } else {
                                                                    $dtl_a_total_pemakaian = $dtdetail_row->pemakaian;
                                                                    $dtl_a_total_persen = number_format($dtdetail_row->persen, 1);
                                                                    $dtl_a_total_akumulatif = $dtdetail_row->akumulatif;
                                                                }
                                                            }
                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_a_detail_id[]" id="dtl_a_detail_id" class="form-control dtl_a_detail_id" value="<?= $dtdetail_row->detail_id ?>">
                                                                <input type="hidden" name="dtl_a_id_flow_meter[]" id="dtl_a_id_flow_meter" class="dtl_a_id_flow_meter form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->id_flow_meter ?>">
                                                                <input type="hidden" name="dtl_a_nama_jenis_air[]" id="dtl_a_nama_jenis_air" class="dtl_a_nama_jenis_air form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->nama_jenis_air ?>">
                                                                <input type="hidden" name="dtl_a_nama_departemen[]" id="dtl_a_nama_departemen" class="dtl_a_nama_departemen form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->nama_departemen ?>">
                                                                <input type="hidden" name="dtl_a_nama_flow[]" id="dtl_a_nama_flow" class="dtl_a_nama_flow form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->nama_flow ?>">
                                                                <td align="center"><?= $no++; ?></td>
                                                                <?php if ($dtdetail_row->no_urut == '1') {
                                                                ?>
                                                                    <td align="center" rowspan="<?= $dtdetail_row->no_urut_desc ?>"><?= $dtdetail_row->nama_jenis_air ?></td>
                                                                <?php  } ?>
                                                                <td align="center" rowspan="1"><?= $dtdetail_row->nama_departemen ?></td>
                                                                <td align="center"><input type="text" name="dtl_a_pemakaian[]" id="dtl_a_pemakaian" class="dtl_a_pemakaian form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->pemakaian ?>" required readonly></td>
                                                                <td align="center"><input type="hidden" name="dtl_a_persen[]" id="dtl_a_persen" class="dtl_a_persen form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->persen ?>" required readonly>
                                                                    <input type="text" class="form-control w-auto" style="text-align: center;" value="<?= number_format($dtdetail_row->persen, 1) ?>" required readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_a_akumulatif[]" id="dtl_a_akumulatif" class="dtl_a_akumulatif form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row->akumulatif ?>" required readonly></td>
                                                            </tr>
                                                            <?php if ($dtdetail_row->no_urut_desc == '1') { ?>
                                                                <tr>
                                                                    <td class="table-secondary align-middle text-center" colspan="3">Total <?= $dtdetail_row->nama_jenis_air ?></td>
                                                                    <td class="table-secondary align-middle text-center dtl_a_total_pemakaian"><?= $dtl_a_total_pemakaian ?></td>
                                                                    <td class="table-secondary align-middle text-center dtl_a_total_persen"><?= $dtl_a_total_persen ?></td>
                                                                    <td class="table-secondary align-middle text-center dtl_a_total_akumulatif"><?= $dtl_a_total_akumulatif ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="3">Grand Total</td>
                                                        <td class="table-primary align-middle text-center dtl_a_grand_total_pemakaian" rowspan="1" colspan="1"><?= $dtl_a_grand_total_pemakaian ?></td>
                                                        <td class="table-primary align-middle text-center dtl_a_grand_total_persen" rowspan="1" colspan="1"><?= $dtl_a_grand_total_persen ?></td>
                                                        <td class="table-primary align-middle text-center dtl_a_grand_total_akumulatif" rowspan="1" colspan="1"><?= $dtl_a_grand_total_akumulatif ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel B ditarik dari form 315 -->
                                        <strong>B. Operasional (Proses)</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Pemakaian</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_b">
                                                    <?php
                                                    if (isset($dtdetail_b)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_b as $dtdetail_row_b) { ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_b_detail_id[]" id="dtl_b_detail_id" class="form-control dtl_b_detail_id" value="<?= $dtdetail_row_b->detail_id ?>">
                                                                <input type="hidden" name="dtl_b_operasi_jenis[]" id="dtl_b_operasi_jenis" class="dtl_b_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_b->operasi_jenis ?>">
                                                                <input type="hidden" name="dtl_b_operasi_satuan[]" id="dtl_b_operasi_satuan" class="dtl_b_operasi_satuan form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_b->operasi_satuan ?>">
                                                                <?php if ($dtdetail_row_b->operasi_jenis == 'Jam Operasi (Proses)') { ?>
                                                                    <td align="center"><?= $no++ ?></td>
                                                                    <td align="center"><?= $dtdetail_row_b->operasi_jenis ?></td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_row_b->operasi_nilai ?>"></td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_b->operasi_akumulatif ?>" required></td>
                                                                    <td align="center"><?= $dtdetail_row_b->operasi_satuan ?></td>
                                                                <?php } else if ($dtdetail_row_b->operasi_jenis == 'Total Air Gambut') { ?>
                                                                    <td class="table-info align-middle text-center"></td>
                                                                    <td class="table-info align-middle text-center"><?= $dtdetail_row_b->operasi_jenis ?></td>
                                                                    <td class="table-info align-middle text-center"><input type="hidden" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai_wtd form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_row_b->operasi_nilai ?>"><?= $dtdetail_row_b->operasi_nilai ?></td>
                                                                    <td class="table-info align-middle text-center">
                                                                        <input type="hidden" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif_hasil" class="dtl_b_operasi_akumulatif_hasil form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_b->operasi_akumulatif ?>" required><?= $dtdetail_row_b->operasi_akumulatif ?>
                                                                        <input type="hidden" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_b->operasi_akumulatif ?>" required>
                                                                    </td>
                                                                    <td class="table-info align-middle text-center"><?= $dtdetail_row_b->operasi_satuan ?></td>
                                                                    <!--</?php } else if ($dtdetail_row_b->operasi_jenis == 'Pemakaian WTD') { ?>
                                                                    <td align="center"></?= '1' ?></td>
                                                                    <td align="center"></?= $dtdetail_row_b->operasi_jenis ?></td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai_wtd form-control w-auto angkadantitik" style="text-align: center;" value="</?= $dtdetail_row_b->operasi_nilai ?>"></td>
                                                                    <td align="center">
                                                                        <input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif_hasil" class="dtl_b_operasi_akumulatif_hasil form-control w-auto" style="text-align: center;" value="</?= $dtdetail_row_b->operasi_akumulatif ?>" required>
                                                                        <input type="hidden" id="dtl_b_operasi_akumulatif_awal[]" class="dtl_b_operasi_akumulatif_awal form-control w-auto" style="text-align: center;" value="</?= $dtdetail_row_b->operasi_akumulatif ?>" required>
                                                                    </td>
                                                                    <td align="center"></?= $dtdetail_row_b->operasi_satuan ?></td>-->
                                                                <?php } else { ?>
                                                                    <td align="center"><?= $no++ ?></td>
                                                                    <td align="center"><?= $dtdetail_row_b->operasi_jenis ?></td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_row_b->operasi_nilai ?>" readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_b->operasi_akumulatif ?>" required readonly></td>
                                                                    <td align="center"><?= $dtdetail_row_b->operasi_satuan ?></td>
                                                                <?php } ?>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="2"></td>
                                                        <td class="table-info align-middle text-center dtl_b_total_operasi_nilai" rowspan="1" colspan="1"></td>
                                                        <td class="table-info align-middle text-center dtl_b_total_operasi_akumulatif" rowspan="1" colspan="1"></td>
                                                        <td class="table-info align-middle text-center dtl_b_total_operasi_satuan" rowspan="1" colspan="1"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel C ditarik dari form 520 -->
                                        <strong>C. Proses RO</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Pemakaian</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_c">
                                                    <?php
                                                    if (isset($dtdetail_c)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_c as $dtdetail_row_c) { ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_c_detail_id[]" id="dtl_c_detail_id" class="form-control dtl_c_detail_id" value="<?= $dtdetail_row_c->detail_id ?>">
                                                                <input type="hidden" name="dtl_c_operasi_jenis[]" id="dtl_c_operasi_jenis" class="dtl_c_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_c->operasi_jenis ?>">
                                                                <input type="hidden" name="dtl_c_operasi_satuan[]" id="dtl_c_operasi_satuan" class="dtl_c_operasi_satuan form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_c->operasi_satuan ?>">
                                                                <input type="hidden" name="dtl_c_operasi_status[]" id="dtl_c_operasi_status" class="dtl_c_operasi_status form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_c->operasi_status ?>">
                                                                <td align="center"><?= $no++; ?></td>
                                                                <td align="center"><?= $dtdetail_row_c->operasi_jenis ?></td>
                                                                <td align="center"><input type="text" name="dtl_c_operasi_nilai[]" id="dtl_c_operasi_nilai" class="dtl_c_operasi_nilai form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_c->operasi_nilai ?>" required readonly></td>
                                                                <td align="center"><input type="text" name="dtl_c_operasi_akumulatif[]" id="dtl_c_operasi_akumulatif" class="dtl_c_operasi_akumulatif form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_c->operasi_akumulatif ?>" required readonly></td>
                                                                <td align="center"><?= $dtdetail_row_c->operasi_satuan ?></td>
                                                            </tr>
                                                    <?php }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="5"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel C ditarik dari form 520 -->
                                        <strong>D. Proses UF</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Pemakaian</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_c_uf">
                                                    <?php
                                                    if (isset($dtdetail_c_uf)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_c_uf as $dtdetail_row_c) { ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_c_detail_id[]" id="dtl_c_detail_id" class="form-control dtl_c_detail_id" value="<?= $dtdetail_row_c->detail_id ?>">
                                                                <input type="hidden" name="dtl_c_operasi_jenis[]" id="dtl_c_operasi_jenis" class="dtl_c_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_c->operasi_jenis ?>">
                                                                <input type="hidden" name="dtl_c_operasi_satuan[]" id="dtl_c_operasi_satuan" class="dtl_c_operasi_satuan form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_c->operasi_satuan ?>">
                                                                <input type="hidden" name="dtl_c_operasi_status[]" id="dtl_c_operasi_status" class="dtl_c_operasi_status form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_c->operasi_status ?>">
                                                                <td align="center"><?= $no++; ?></td>
                                                                <td align="center"><?= $dtdetail_row_c->operasi_jenis ?></td>
                                                                <td align="center"><input type="text" name="dtl_c_operasi_nilai[]" id="dtl_c_operasi_nilai" class="dtl_c_operasi_nilai form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_c->operasi_nilai ?>" required></td>
                                                                <td align="center"><input type="text" name="dtl_c_operasi_akumulatif[]" id="dtl_c_operasi_akumulatif" class="dtl_c_operasi_akumulatif form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_c->operasi_akumulatif ?>" required></td>
                                                                <td align="center"><?= $dtdetail_row_c->operasi_satuan ?></td>
                                                            </tr>
                                                    <?php }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="5"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel D ditarik dari form 317 tabel E stok air akhir -->
                                        <strong>E. Stok Air Awal</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_d">
                                                    <?php
                                                    if (isset($dtdetail_d)) {
                                                        foreach ($dtdetail_d as $dtdetail_row_d) {
                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_d_detail_id[]" id="dtl_d_detail_id" class="form-control dtl_d_detail_id" value="<?= $dtdetail_row_d->detail_id ?>">
                                                                <td align="center">1</td>
                                                                <td align="center">Total stok</td>
                                                                <td align="center"><input type="text" name="dtl_d_stok_air_awal[]" id="dtl_d_stok_air_awal" class="dtl_d_stok_air_awal form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_d->stok_air_awal; ?>" readonly></td>
                                                                <td align="center">M3</td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-warning align-middle text-center" rowspan="1" colspan="4"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel E ditarik dari form 520 -->
                                        <strong>F. Stok Air Akhir</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Pemakaian</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_e">
                                                    <?php
                                                    $dtl_e_total_operasi_nilai = '';
                                                    $dtl_e_total_operasi_akumulatif = '';
                                                    $dtl_e_total_operasi_satuan = '';
                                                    if (isset($dtdetail_e)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_e as $dtdetail_row_e) {
                                                            $dtl_e_total_operasi_nilai += $dtdetail_row_e->operasi_nilai;
                                                            $dtl_e_total_operasi_akumulatif += $dtdetail_row_e->operasi_akumulatif;
                                                            $dtl_e_total_operasi_satuan = $dtdetail_row_e->operasi_satuan;
                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_e_detail_id[]" id="dtl_e_detail_id" class="form-control dtl_e_detail_id" value="<?= $dtdetail_row_e->detail_id ?>">
                                                                <input type="hidden" name="dtl_e_operasi_jenis[]" id="dtl_e_operasi_jenis" class="dtl_e_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_e->operasi_jenis ?>">
                                                                <input type="hidden" name="dtl_e_operasi_satuan[]" id="dtl_e_operasi_satuan" class="dtl_e_operasi_satuan form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_e->operasi_satuan ?>">
                                                                <td align="center"><?= $no++ ?></td>
                                                                <td align="center"><?= $dtdetail_row_e->operasi_jenis ?></td>
                                                                <td align="center"><input type="text" name="dtl_e_operasi_nilai[]" id="dtl_e_operasi_nilai" class="dtl_e_operasi_nilai form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_e->operasi_nilai ?>" required readonly></td>
                                                                <td align="center"><input type="text" name="dtl_e_operasi_akumulatif[]" id="dtl_e_operasi_akumulatif" class="dtl_e_operasi_akumulatif form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_e->operasi_akumulatif ?>" required readonly></td>
                                                                <td align="center"><?= $dtdetail_row_e->operasi_satuan ?></td>
                                                            </tr>
                                                    <?php  }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-danger align-middle text-center" rowspan="1" colspan="2">Total Stok </td>
                                                        <td class="table-danger align-middle text-center dtl_e_total_operasi_nilai" rowspan="1" colspan="1"><?= $dtl_e_total_operasi_nilai ?></td>
                                                        <td class="table-danger align-middle text-center dtl_e_total_operasi_akumulatif" rowspan="1" colspan="1"><?= $dtl_e_total_operasi_akumulatif ?></td>
                                                        <td class="table-danger align-middle text-center dtl_e_total_operasi_satuan" rowspan="1" colspan="1"><?= $dtl_e_total_operasi_satuan ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel F ditarik dari form 315 -->
                                        <strong>G. Proses Air Recycle</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Stok Proses Air Recycle</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_f">
                                                    <?php $no = 1;
                                                    $total_dtl_f_operasi_nilai = '';
                                                    $total_dtl_f_operasi_akumulatif = '';
                                                    if (isset($dtdetail_f)) {
                                                        foreach ($dtdetail_f as $dtdetail_row_f) {
                                                            $total_dtl_f_operasi_nilai += $dtdetail_row_f->operasi_nilai;
                                                            $total_dtl_f_operasi_akumulatif += $dtdetail_row_f->operasi_akumulatif;
                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_f_detail_id[]" id="dtl_f_detail_id" class="form-control dtl_f_detail_id" value="<?= $dtdetail_row_f->detail_id ?>">
                                                                <input type="hidden" name="dtl_f_operasi_jenis[]" id="dtl_f_operasi_jenis" class="dtl_f_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_f->operasi_jenis ?>">
                                                                <input type="hidden" name="dtl_f_operasi_satuan[]" id="dtl_f_operasi_satuan" class="dtl_f_operasi_satuan form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_f->operasi_satuan ?>">
                                                                <td align="center"><?= $no++; ?></td>
                                                                <td align="center"><?= $dtdetail_row_f->operasi_jenis ?></td>
                                                                <td align="center"><input type="text" name="dtl_f_operasi_nilai[]" id="dtl_f_operasi_nilai" class="dtl_f_operasi_nilai form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_row_f->operasi_nilai ?>"></td>
                                                                <td align="center"><input type="hidden" name="dtl_f_operasi_akumulatif_awal[]" id="dtl_f_operasi_akumulatif_awal" class="dtl_f_operasi_akumulatif_awal form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_row_f->operasi_akumulatif_awal ?>">
                                                                    <input type="text" name="dtl_f_operasi_akumulatif[]" id="dtl_f_operasi_akumulatif" class="dtl_f_operasi_akumulatif form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_row_f->operasi_akumulatif ?>">
                                                                </td>
                                                                <td align="center"><?= $dtdetail_row_f->operasi_satuan ?></td>
                                                            </tr>

                                                        <?php
                                                        }
                                                    } else {

                                                        ?>
                                                        <tr>
                                                            <td align="center" colspan="4"><i>Data belum tersedia!</i></td>
                                                        </tr>
                                                    <?php  } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="2">Total</td>
                                                        <td class="dtl_f_operasi_nilai_total table-primary align-middle text-center" rowspan="1" colspan="1"><?= $total_dtl_f_operasi_nilai ?></td>
                                                        <td class="dtl_f_operasi_akumulatif_total table-primary align-middle text-center" rowspan="1" colspan="1"><?= $total_dtl_f_operasi_akumulatif ?></td>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="1"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel G ditarik dari form 315 -->
                                        <strong>H. Stok Balance</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Stok Air Akhir + Recycle</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">T. Distribusi</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Stok Air Awal</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Total Proses</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_g">
                                                    <?php
                                                    $dtl_g_total_bawah = 0;
                                                    if (isset($dtdetail_g)) {
                                                        foreach ($dtdetail_g as $dtdetail_row_g) {
                                                            $dtl_g_total_bawah = $dtdetail_row_g->stok_air_akhir + $dtdetail_row_g->t_distribusi - $dtdetail_row_g->stok_air_awal - $dtdetail_row_g->total_proses;
                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_g_detail_id[]" id="dtl_g_detail_id" class="form-control dtl_g_detail_id" value="<?= $dtdetail_row_g->detail_id ?>">
                                                                <td align="center">
                                                                    <input type="text" name="dtl_g_stok_air_akhir[]" id="dtl_g_stok_air_akhir" class="dtl_g_stok_air_akhir form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_g->stok_air_akhir ?>" required readonly>
                                                                    <input type="hidden" name="dtl_g_stok_air_akhir_awal[]" id="dtl_g_stok_air_akhir_awal" class="dtl_g_stok_air_akhir_awal form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_g->stok_air_akhir_awal ?>" required readonly>
                                                                </td>
                                                                <td align="center"><input type="text" name="dtl_g_t_distribusi[]" id="dtl_g_t_distribusi" class="dtl_g_t_distribusi form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_g->t_distribusi ?>" required readonly></td>
                                                                <td align="center"><input type="text" name="dtl_g_stok_air_awal[]" id="dtl_g_stok_air_awal" class="dtl_g_stok_air_awal form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_g->stok_air_awal ?>" required <?= $dtdetail_row_g->stok_air_awal == '0' ? "" : "readonly"; ?>></td>
                                                                <td align="center"><input type="text" name="dtl_g_total_proses[]" id="dtl_g_total_proses" class="dtl_g_total_proses form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_g->total_proses ?>" required readonly></td>
                                                            </tr>
                                                    <?php    }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="3"> </td>
                                                        <td class="table-info align-middle text-center dtl_g_total_bawah" rowspan="1" colspan="1"><?= number_format($dtl_g_total_bawah, 1); ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel H input manual -->
                                        <strong>I. Catatan</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Drain (M3)</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Backwash Tangki / CIP (M3)</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Cleaning Bak (M3)</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Operasional WTD (M3)</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_h">
                                                    <?php
                                                    if (isset($dtdetail_h)) {
                                                        foreach ($dtdetail_h as $dtdetail_row_h) { ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_h_detail_id[]" id="dtl_h_detail_id" class="form-control dtl_h_detail_id" value="<?= $dtdetail_row_h->detail_id ?>">
                                                                <td align="center"><input type="text" name="dtl_h_drain_sedimen[]" id="dtl_h_drain_sedimen" class="dtl_h_drain_sedimen form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_row_h->drain_sedimen ?>"></td>
                                                                <td align="center"><input type="text" name="dtl_h_backwash_tanki[]" id="dtl_h_backwash_tanki" class="dtl_h_backwash_tanki form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_row_h->backwash_tanki ?>"></td>
                                                                <td align="center"><input type="text" name="dtl_h_cleaning_bak[]" id="dtl_h_cleaning_bak" class="dtl_h_cleaning_bak form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_row_h->cleaning_bak ?>"></td>
                                                                <td align="center"><input type="text" name="dtl_h_operasional[]" id="dtl_h_operasional" class="dtl_h_operasional form-control w-auto angkadantitik" style="text-align: center;" value="<?= $dtdetail_row_h->operasional ?>"></td>
                                                            </tr>
                                                    <?php    }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="4"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel I ditarik dari form 315 -->
                                        <strong>J. Bahan Baku Larutan ( Liter )</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Bahan Kimia</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Pakai</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Efisiensi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_i">
                                                    <?php
                                                    $total_opreasi_nilai = 0;
                                                    $total_operasi_effisiensi = 0;
                                                    if (isset($dtdetail_i)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_i as $dtdetail_row_i) {

                                                            $total_opreasi_nilai        += $dtdetail_row_i->operasi_nilai;
                                                            $total_operasi_effisiensi   += $dtdetail_row_i->operasi_effisiensi;
                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_i_detail_id[]" id="dtl_i_detail_id" class="form-control dtl_i_detail_id" value="<?= $dtdetail_row_i->detail_id ?>">
                                                                <input type="hidden" name="dtl_i_operasi_jenis[]" id="dtl_i_operasi_jenis" class="dtl_i_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_i->operasi_jenis ?>">
                                                                <input type="hidden" name="dtl_i_operasi_stok[]" id="dtl_i_operasi_stok" class="dtl_i_operasi_stok form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_i->operasi_stok ?>" required readonly>
                                                                <td align="center"><?= $no++ ?></td>
                                                                <td align="center"><?= $dtdetail_row_i->operasi_jenis ?></td>
                                                                <td align="center"><input type="text" name="dtl_i_operasi_nilai[]" id="dtl_i_operasi_nilai" class="dtl_i_operasi_nilai form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_i->operasi_nilai ?>" required readonly></td>
                                                                <td align="center"><input type="text" name="dtl_i_operasi_effisiensi[]" id="dtl_i_operasi_effisiensi" class="dtl_i_operasi_effisiensi form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_i->operasi_effisiensi ?>" required readonly></td>
                                                            </tr>
                                                    <?php }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-warning align-middle text-center" rowspan="1" colspan="4"></td>
                                                        <!-- <td class="table-warning align-middle text-center dtl_i_total_opreasi_nilai" rowspan="1"><?= $total_opreasi_nilai; ?></td> -->
                                                        <!-- <td class="table-warning align-middle text-center dtl_i_total_operasi_effisiensi" rowspan="1"><?= $total_operasi_effisiensi; ?></td> -->
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel J ditarik dari form 315 -->
                                        <strong>K. Target Bahan Baku Larutan ( KG )</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                        <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Target</th>
                                                        <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_j">
                                                    <?php
                                                    if (isset($dtdetail_j)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_j as $dtdetail_row_j) { ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_j_detail_id[]" id="dtl_j_detail_id" class="form-control dtl_j_detail_id" value="<?= $dtdetail_row_j->detail_id ?>">
                                                                <input type="hidden" name="dtl_j_operasi_jenis[]" id="dtl_j_operasi_jenis" class="dtl_j_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_j->operasi_jenis ?>">
                                                                <input type="hidden" name="dtl_j_operasi_satuan[]" id="dtl_j_operasi_satuan" class="dtl_j_operasi_satuan form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_j->operasi_satuan ?>">
                                                                <td align="center"><?= $no++ ?></td>
                                                                <td align="center"><?= $dtdetail_row_j->operasi_jenis ?></td>
                                                                <td align="center"><input type="text" name="dtl_j_target[]" id="dtl_j_target" class="dtl_j_target form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_j->target ?>" required readonly></td>
                                                                <td align="center"><?= $dtdetail_row_j->operasi_satuan ?></td>
                                                            </tr>
                                                    <?php    }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-secondary align-middle text-center" rowspan="1" colspan="5"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel K ditarik dari form 315 -->
                                        <strong>L. Pemakaian Bahan Kimia Sand Filter</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Bahan Kimia</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Pakai</th>
                                                        <!-- <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Effisiensi</th> -->
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Stock</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_k">
                                                    <?php
                                                    if (isset($dtdetail_k)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_k as $dtdetail_row_k) {

                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_k_detail_id[]" id="dtl_k_detail_id" class="form-control dtl_k_detail_id" value="<?= $dtdetail_row_k->detail_id ?>">
                                                                <input type="hidden" name="dtl_k_operasi_jenis[]" id="dtl_k_operasi_jenis" class="dtl_k_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_k->operasi_jenis ?>">
                                                                <input type="hidden" name="dtl_k_effisiensi[]" id="dtl_k_effisiensi" class="dtl_k_effisiensi form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_k->effisiensi ?>" required readonly>
                                                                <td align="center"><?= $no++ ?></td>
                                                                <td align="center"><?= $dtdetail_row_k->operasi_jenis ?></td>
                                                                <td align="center"><input type="text" name="dtl_k_operasi_nilai[]" id="dtl_k_operasi_nilai" class="dtl_k_operasi_nilai form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_k->operasi_nilai ?>" required readonly></td>
                                                                <td align="center"><input type="text" name="dtl_k_operasi_akumulatif[]" id="dtl_k_operasi_akumulatif" class="dtl_k_operasi_akumulatif form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_k->operasi_akumulatif ?>" required readonly></td>
                                                                <td align="center"><input type="text" name="dtl_k_stock[]" id="dtl_k_stock" class="dtl_k_stock form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_k->stock ?>" required readonly></td>
                                                            </tr>
                                                    <?php    }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-danger align-middle text-center" rowspan="1" colspan="6"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel L ditarik dari form 315 -->
                                        <strong>M. Pemakaian Bahan Kimia Softener</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Bahan Kimia</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Pakai</th>
                                                        <!-- <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Effisiensi</th> -->
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-primary align-middle text-center" rowspan="1" colspan="1">stok</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_l">
                                                    <?php
                                                    if (isset($dtdetail_l)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_l as $dtdetail_row_l) {
                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_l_detail_id[]" id="dtl_l_detail_id" class="form-control dtl_l_detail_id" value="<?= $dtdetail_row_l->detail_id ?>">
                                                                <input type="hidden" name="dtl_l_operasi_jenis[]" id="dtl_l_operasi_jenis" class="dtl_l_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_l->operasi_jenis ?>">
                                                                <input type="hidden" name="dtl_l_effisiensi[]" id="dtl_l_effisiensi" class="dtl_l_effisiensi form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_l->effisiensi ?>" readonly>
                                                                <td align="center"><?= $no++ ?></td>
                                                                <td align="center"><?= $dtdetail_row_l->operasi_jenis ?></td>
                                                                <td align="center"><input type="text" name="dtl_l_operasi_nilai[]" id="dtl_l_operasi_nilai" class="dtl_l_operasi_nilai form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_l->operasi_nilai ?>" required readonly></td>
                                                                <td align="center"><input type="text" name="dtl_l_operasi_akumulatif[]" id="dtl_l_operasi_akumulatif" class="dtl_l_operasi_akumulatif form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_l->operasi_akumulatif ?>" required readonly></td>
                                                                <td align="center"><input type="text" name="dtl_l_operasi_stok[]" id="dtl_l_operasi_stok" class="dtl_l_operasi_stok form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_l->operasi_stok ?>" readonly></td>
                                                            </tr>
                                                    <?php    }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-primary align-middle text-center" rowspan="1" colspan="6"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel M ditarik dari form 315 -->
                                        <strong>N. Pemakaian Bahan Kimia RO & UF</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Bahan Kimia</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Pakai</th>
                                                        <!-- <th class="table-info align-middle text-center" rowspan="1" colspan="1">Effisiensi</th> -->
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-info align-middle text-center" rowspan="1" colspan="1">stok</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_m">
                                                    <?php
                                                    if (isset($dtdetail_m)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_m as $dtdetail_row_m) {
                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_m_detail_id[]" id="dtl_m_detail_id" class="form-control dtl_m_detail_id" value="<?= $dtdetail_row_m->detail_id ?>">
                                                                <input type="hidden" name="dtl_m_operasi_jenis[]" id="dtl_m_operasi_jenis" class="dtl_m_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_m->operasi_jenis ?>">
                                                                <input type="hidden" name="dtl_m_effisiensi[]" id="dtl_m_effisiensi" class="dtl_m_effisiensi form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_m->effisiensi ?>" required readonly>
                                                                <td align="center"><?= $no++ ?></td>
                                                                <td align="center"><?= $dtdetail_row_m->operasi_jenis ?></td>
                                                                <td align="center"><input type="text" name="dtl_m_operasi_nilai[]" id="dtl_m_operasi_nilai" class="dtl_m_operasi_nilai form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_m->operasi_nilai ?>" required readonly></td>
                                                                <td align="center"><input type="text" name="dtl_m_operasi_akumulatif[]" id="dtl_m_operasi_akumulatif" class="dtl_m_operasi_akumulatif form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_m->operasi_akumulatif ?>" required readonly></td>
                                                                <td align="center"><input type="text" name="dtl_m_operasi_stok[]" id="dtl_m_operasi_stok" class="dtl_m_operasi_stok form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_m->operasi_stok ?>" required readonly></td>
                                                            </tr>
                                                    <?php    }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="6"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel N ditarik dari form 315 -->
                                        <strong>O. Pemakaian Filter RO & UF</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">item</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Pakai</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                        <th class="table-success align-middle text-center" rowspan="1" colspan="1">stok</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_n">
                                                    <?php
                                                    if (isset($dtdetail_n)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_n as $dtdetail_row_n) {
                                                    ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_n_detail_id[]" id="dtl_n_detail_id" class="form-control dtl_n_detail_id" value="<?= $dtdetail_row_n->detail_id ?>">
                                                                <input type="hidden" name="dtl_n_operasi_jenis[]" id="dtl_n_operasi_jenis" class="dtl_n_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_n->operasi_jenis ?>">
                                                                <td align="center"><?= $no++ ?></td>
                                                                <td align="center"><?= $dtdetail_row_n->operasi_jenis ?></td>
                                                                <td align="center"><input type="text" name="dtl_n_operasi_nilai[]" id="dtl_n_operasi_nilai" class="dtl_n_operasi_nilai form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_n->operasi_nilai ?>" required readonly></td>
                                                                <td align="center"><input type="text" name="dtl_n_operasi_akumulatif[]" id="dtl_n_operasi_akumulatif" class="dtl_n_operasi_akumulatif form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_n->operasi_akumulatif ?>" required readonly></td>
                                                                <td align="center"><input type="text" name="dtl_n_operasi_stok[]" id="dtl_n_operasi_stok" class="dtl_n_operasi_stok form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_n->operasi_stok ?>" required readonly></td>
                                                            </tr>
                                                    <?php    }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-success align-middle text-center" rowspan="1" colspan="5"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel O ditarik dari form 315 -->
                                        <strong>P. Keterangan Proses RO & UF</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Proses RO & UF</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="1">M3</th>
                                                        <th class="table-warning align-middle text-center" rowspan="1" colspan="2">Jam</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_o">
                                                    <?php
                                                    $dtl_o_total_m3     = '';
                                                    $dtl_o_total_jam    = '';
                                                    $dtl_o_total_satuan = '';
                                                    $dtl_o_uf_total_m3     = '';
                                                    $dtl_o_uf_total_jam    = '';
                                                    $dtl_o_uf_total_satuan = '';
                                                    if (isset($dtdetail_o)) {
                                                        $no = 1;
                                                        foreach ($dtdetail_o as $dtdetail_row_o) {
                                                            if ($dtdetail_row_o->operasi_jenis == 'Proses UF') {
                                                                $dtl_o_uf_total_m3     += $dtdetail_row_o->operasi_produk;
                                                                $dtl_o_uf_total_jam    += $dtdetail_row_o->operasi_jam;
                                                                $dtl_o_uf_total_satuan = $dtdetail_row_o->operasi_satuan;
                                                            } else {
                                                                $dtl_o_total_m3     += $dtdetail_row_o->operasi_produk;
                                                                $dtl_o_total_jam    += $dtdetail_row_o->operasi_jam;
                                                                $dtl_o_total_satuan = $dtdetail_row_o->operasi_satuan;
                                                            }
                                                            if ($dtdetail_row_o->operasi_jenis == 'Proses UF') { ?>
                                                                <tr>
                                                                    <td class="table-warning align-middle text-center" rowspan="1" colspan="2">Total</td>
                                                                    <td class="table-warning align-middle text-center dtl_o_total_m3" rowspan="1" colspan="1"><?= $dtl_o_total_m3 ?></td>
                                                                    <td class="table-warning align-middle text-center dtl_o_total_jam" rowspan="1" colspan="1"><?= $dtl_o_total_jam ?></td>
                                                                    <td class="table-warning align-middle text-center dtl_o_total_satuan" rowspan="1" colspan="1"><?= $dtl_o_total_satuan ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <input type="hidden" name="dtl_o_detail_id[]" id="dtl_o_detail_id" class="form-control dtl_o_detail_id" value="<?= $dtdetail_row_o->detail_id ?>">
                                                                    <input type="hidden" name="dtl_o_operasi_jenis[]" id="dtl_o_operasi_jenis" class="dtl_o_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_o->operasi_jenis ?>">
                                                                    <input type="hidden" name="dtl_o_operasi_satuan[]" id="dtl_o_operasi_satuan" class="dtl_o_operasi_satuan form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_o->operasi_satuan ?>">
                                                                    <td align="center"><?= $no++ ?></td>
                                                                    <td align="center"><?= $dtdetail_row_o->operasi_jenis ?></td>
                                                                    <td align="center"><input type="text" name="dtl_o_operasi_produk[]" id="dtl_o_operasi_produk" class="dtl_o_operasi_produk form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_o->operasi_produk ?>" required readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_o_operasi_jam[]" id="dtl_o_operasi_jam" class="dtl_o_operasi_jam form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_o->operasi_jam ?>" required readonly></td>
                                                                    <td align="center"><?= $dtdetail_row_o->operasi_satuan ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="table-warning align-middle text-center" rowspan="1" colspan="2">Total</td>
                                                                    <td class="table-warning align-middle text-center dtl_o_total_m3" rowspan="1" colspan="1"><?= $dtl_o_uf_total_m3 ?></td>
                                                                    <td class="table-warning align-middle text-center dtl_o_total_jam" rowspan="1" colspan="1"><?= $dtl_o_uf_total_jam ?></td>
                                                                    <td class="table-warning align-middle text-center dtl_o_total_satuan" rowspan="1" colspan="1"><?= $dtl_o_uf_total_satuan ?></td>
                                                                </tr>
                                                            <?php } else {
                                                                // $dtl_o_total_m3 += $dtdetail_row_o->operasi_produk;
                                                                // $dtl_o_total_jam += $dtdetail_row_o->operasi_jam;
                                                                // $dtl_o_total_satuan = $dtdetail_row_o->operasi_satuan; 
                                                            ?>
                                                                <tr>
                                                                    <input type="hidden" name="dtl_o_detail_id[]" id="dtl_o_detail_id" class="form-control dtl_o_detail_id" value="<?= $dtdetail_row_o->detail_id ?>">
                                                                    <input type="hidden" name="dtl_o_operasi_jenis[]" id="dtl_o_operasi_jenis" class="dtl_o_operasi_jenis form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_o->operasi_jenis ?>">
                                                                    <input type="hidden" name="dtl_o_operasi_satuan[]" id="dtl_o_operasi_satuan" class="dtl_o_operasi_satuan form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_o->operasi_satuan ?>">
                                                                    <td align="center"><?= $no++ ?></td>
                                                                    <td align="center"><?= $dtdetail_row_o->operasi_jenis ?></td>
                                                                    <td align="center"><input type="text" name="dtl_o_operasi_produk[]" id="dtl_o_operasi_produk" class="dtl_o_operasi_produk form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_o->operasi_produk ?>" required readonly></td>
                                                                    <td align="center"><input type="text" name="dtl_o_operasi_jam[]" id="dtl_o_operasi_jam" class="dtl_o_operasi_jam form-control w-auto" style="text-align: center;" value="<?= $dtdetail_row_o->operasi_jam ?>" required readonly></td>
                                                                    <td align="center"><?= $dtdetail_row_o->operasi_satuan ?></td>
                                                                </tr>
                                                    <?php }
                                                        }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <!-- <td class="table-warning align-middle text-center" rowspan="1" colspan="2">Total</td>
                                                        <td class="table-warning align-middle text-center dtl_o_total_m3" rowspan="1" colspan="1"><?= $dtl_o_total_m3 ?></td>
                                                        <td class="table-warning align-middle text-center dtl_o_total_jam" rowspan="1" colspan="1"><?= $dtl_o_total_jam ?></td>
                                                        <td class="table-warning align-middle text-center dtl_o_total_satuan" rowspan="1" colspan="1"><?= $dtl_o_total_satuan ?></td> -->
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <!-- Tabel P input manual -->
                                        <strong>Q. Outspec analisa</strong>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="table-secondary align-middle text-center" rowspan="1" colspan="1"></th>
                                                        <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">pH</th>
                                                        <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Turbidity</th>
                                                        <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">colour</th>
                                                        <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_dtl_p">
                                                    <?php $list_dtl_p_item = ['ASF', 'ACF', 'ALCIP'];
                                                    if (!empty($dtdetail_p)) {
                                                        foreach ($dtdetail_p as $dtdetail_p_row_bsf) { ?>
                                                            <tr>
                                                                <input type="hidden" name="dtl_p_detail_id[]" id="dtl_p_detail_id" class="form-control dtl_p_detail_id" value="<?= $dtdetail_p_row_bsf->detail_id ?>">
                                                                <td align="center"><input type="hidden" name="dtl_p_item[]" id="dtl_p_item" class="form-control w-auto dtl_p_item" style="text-align: center;" value="<?= $dtdetail_p_row_bsf->item ?>"><?= $dtdetail_p_row_bsf->item ?></td>
                                                                <td align="center"><input type="text" name="dtl_p_ph[]" id="dtl_p_ph" class="form-control angkadantitik w-auto dtl_p_ph" style="text-align: center;" value="<?= $dtdetail_p_row_bsf->ph ?>"></td>
                                                                <td align="center"><input type="text" name="dtl_p_turbidity[]" id="dtl_p_turbidity" class="form-control angkadantitik w-auto dtl_p_turbidity" style="text-align: center;" value="<?= $dtdetail_p_row_bsf->turbidity ?>"></td>
                                                                <td align="center"><input type="text" name="dtl_p_colour[]" id="dtl_p_colour" class="form-control angkadantitik w-auto dtl_p_colour" style="text-align: center;" value="<?= $dtdetail_p_row_bsf->colour ?>"></td>
                                                                <td align="center"><input type="text" name="dtl_p_ket[]" id="dtl_p_ket" class="form-control  w-auto dtl_p_ket" style="text-align: center;" value="<?= $dtdetail_p_row_bsf->ket ?>"></td>
                                                            </tr>
                                                        <?php }
                                                    } else {
                                                        for ($dtl_p_i = 0; $dtl_p_i < count($list_dtl_p_item); $dtl_p_i++) { ?>
                                                            <tr>
                                                                <td align="center"><input type="hidden" name="dtl_p_item[]" id="dtl_p_item" class="form-control w-auto dtl_p_item" style="text-align: center;" value="<?= $list_dtl_p_item[$dtl_p_i] ?>"><?= $list_dtl_p_item[$dtl_p_i] ?></td>
                                                                <td align="center"><input type="text" name="dtl_p_ph[]" id="dtl_p_ph" class="form-control angkadantitik w-auto dtl_p_ph" style="text-align: center;" value=""></td>
                                                                <td align="center"><input type="text" name="dtl_p_turbidity[]" id="dtl_p_turbidity" class="form-control angkadantitik w-auto dtl_p_turbidity" style="text-align: center;" value=""></td>
                                                                <td align="center"><input type="text" name="dtl_p_colour[]" id="dtl_p_colour" class="form-control angkadantitik w-auto dtl_p_colour" style="text-align: center;" value=""></td>
                                                                <td align="center"><input type="text" name="dtl_p_ket[]" id="dtl_p_ket" class="form-control  w-auto dtl_p_ket" style="text-align: center;" value=""></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="table-secondary align-middle text-center" rowspan="1" colspan="5"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php $this->load->view('laporan/V_laporan_definisi'); ?>

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
                                            <button type="submit" class="btn bg-gradient-warning" name="btnrefresh" value="btnrefresh" onclick="return confirm('Refresh Data ?')">
                                                <i class="feather icon-refresh-ccw"></i> Refresh
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
            dtl_g_cari_total_bawah();
        }

        get_docno();
        if (typeof($('#headerid').val()) == "undefined") {
            get_forminput();
        }

        function get_docno() {
            var input_headerid = $(".headerid").val();
            var create_date = $('.create_date').val();
            if (typeof(input_headerid) == "undefined" && create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss317_16/get_docno/frmfss317/16",
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
            var input_headerid = $(".headerid").val();

            get_docno();
            if (typeof(input_headerid) == "undefined") {
                get_forminput();
            }
        });

        // $('.persen').change(function() {

        // });

        function get_forminput() {
            var create_date = $('.create_date').val();
            var persen = $('.persen').val();
            console.log(persen)

            if (create_date != '') {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>index.php/form_input/C_formfrmfss317_16/get_forminput/frmfss317/16",
                    data: {
                        create_date,
                        persen
                    },
                    dataType: "json",
                    async: false,
                    success: function(result) {
                        if (result.status == 0) {

                            let dtsampel_frmfss315_headerid = '';
                            let dtsampel_frmfss315_complete_date = '';
                            let dtsampel_frmfss315_complete_time = '';
                            let dtsampel_frmfss316_headerid = '';
                            let dtsampel_frmfss316_complete_date = '';
                            let dtsampel_frmfss316_complete_time = '';
                            let dtsampel_frmfss317_headerid = '';
                            let dtsampel_frmfss317_complete_date = '';
                            let dtsampel_frmfss317_complete_time = '';
                            let dtsampel_frmfss520_headerid = '';
                            let dtsampel_frmfss520_complete_date = '';
                            let dtsampel_frmfss520_complete_time = '';

                            // dtl a
                            let list_dtl_a = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;

                            let dtl_a_total_pemakaian = 0;
                            let dtl_a_total_persen = 0;
                            let dtl_a_total_akumulatif = 0;

                            let dtl_a_grand_total_pemakaian = 0;
                            let dtl_a_grand_total_persen = 0;
                            let dtl_a_grand_total_akumulatif = 0;

                            if (result.data.result_frmfss316.length) {
                                list_dtl_a = '';
                                $.each(result.data.result_frmfss316, function(dtl_a_key, dtl_a_row) {
                                    let vnama_jenis_air = dtl_a_row.no_urut_asc == 1 ? `<td align="center" rowspan="` + dtl_a_row.no_urut_desc + `">` + dtl_a_row.nama_jenis_air + `</td>` : ``;

                                    list_dtl_a += `<tr>
                                                    <input type="hidden" name="dtl_a_id_flow_meter[]" id="dtl_a_id_flow_meter" class="dtl_a_id_flow_meter form-control w-auto" style="text-align: center;" value="">
                                                    <input type="hidden" name="dtl_a_nama_jenis_air[]" id="dtl_a_nama_jenis_air" class="dtl_a_nama_jenis_air form-control w-auto" style="text-align: center;" value="` + dtl_a_row.nama_jenis_air + `">
                                                    <input type="hidden" name="dtl_a_nama_departemen[]" id="dtl_a_nama_departemen" class="dtl_a_nama_departemen form-control w-auto" style="text-align: center;" value="` + dtl_a_row.nama_departemen + `">
                                                    <input type="hidden" name="dtl_a_nama_flow[]" id="dtl_a_nama_flow" class="dtl_a_nama_flow form-control w-auto" style="text-align: center;" value="">
                                                    <td align="center">` + (dtl_a_key + 1) + `</td>
                                                    ` + vnama_jenis_air + `
                                                    <td align="center" rowspan="1">` + dtl_a_row.nama_departemen + `</td>
                                                    <td align="center"><input type="text" name="dtl_a_pemakaian[]" id="dtl_a_pemakaian" class="dtl_a_pemakaian form-control w-auto" style="text-align: center;" value="` + parseFloat(dtl_a_row.total).toFixed(1) + `" required readonly></td>
                                                    <td align="center"><input type="hidden" name="dtl_a_persen[]" id="dtl_a_persen" class="dtl_a_persen form-control w-auto" style="text-align: center;" value="` + parseFloat(dtl_a_row.persen) + `">
                                                                        <input type="text" class="form-control w-auto" style="text-align: center;" value="` + parseFloat(dtl_a_row.persen).toFixed(1) + `" required readonly></td>
                                                    <td align="center"><input type="text" name="dtl_a_akumulatif[]" id="dtl_a_akumulatif" class="dtl_a_akumulatif form-control w-auto" style="text-align: center;" value="` + parseFloat(dtl_a_row.akumulatif).toFixed(1) + `" required readonly></td>
                                                </tr>`;

                                    dtl_a_grand_total_pemakaian += parseFloat(dtl_a_row.total);
                                    dtl_a_grand_total_persen += parseFloat(dtl_a_row.persen);
                                    dtl_a_grand_total_akumulatif += parseFloat(dtl_a_row.akumulatif);

                                    // total per jenis air 
                                    if (dtl_a_key == 0) {
                                        dtl_a_total_pemakaian = parseFloat(dtl_a_row.total);
                                        dtl_a_total_persen = parseFloat(dtl_a_row.persen);
                                        dtl_a_total_akumulatif = parseFloat(dtl_a_row.akumulatif);
                                    } else {
                                        if (dtl_a_row.nama_jenis_air == result.data.result_frmfss316[dtl_a_key - 1].nama_jenis_air) {
                                            dtl_a_total_pemakaian += parseFloat(dtl_a_row.total);
                                            dtl_a_total_persen += parseFloat(dtl_a_row.persen);
                                            dtl_a_total_akumulatif += parseFloat(dtl_a_row.akumulatif);
                                        } else {
                                            dtl_a_total_pemakaian = parseFloat(dtl_a_row.total);
                                            dtl_a_total_persen = parseFloat(dtl_a_row.persen);
                                            dtl_a_total_akumulatif = parseFloat(dtl_a_row.akumulatif);
                                        }
                                    }


                                    if (dtl_a_row.no_urut_desc == 1) {
                                        list_dtl_a += `<tr>
                                                            <td class="table-secondary align-middle text-center" colspan="3">Total ` + dtl_a_row.nama_jenis_air + `</td>
                                                            <td class="table-secondary align-middle text-center dtl_a_total_pemakaian">` + parseFloat(dtl_a_total_pemakaian).toFixed(1) + `</td>
                                                            <td class="table-secondary align-middle text-center dtl_a_total_persen">` + parseFloat(dtl_a_total_persen).toFixed(1) + `</td>
                                                            <td class="table-secondary align-middle text-center dtl_a_total_akumulatif">` + parseFloat(dtl_a_total_akumulatif).toFixed(1) + `</td>
                                                        </tr>`;
                                    }
                                });

                                dtsampel_frmfss316_headerid = result.data.result_frmfss316[0].headerid;
                                dtsampel_frmfss316_complete_date = result.data.result_frmfss316[0].complete_date;
                                dtsampel_frmfss316_complete_time = result.data.result_frmfss316[0].complete_time;
                            }

                            $('.dtl_a_grand_total_pemakaian').empty().append(parseFloat(dtl_a_grand_total_pemakaian).toFixed(1));
                            $('.dtl_a_grand_total_persen').empty().append(parseFloat(dtl_a_grand_total_persen).toFixed(1));
                            $('.dtl_a_grand_total_akumulatif').empty().append(parseFloat(dtl_a_grand_total_akumulatif).toFixed(1));
                            $('#tbody_dtl_a').empty().append(list_dtl_a);
                            // dtl a end

                            // dtl b
                            let list_dtl_b = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;
                            const list_dtl_b_item = ['dtl_b_jam_operasi', 'dtl_b_air_gambut_sedimen', 'dtl_b_air_gambut_cone', 'dtl_b_air_gambut_total'];
                            const list_dtl_b_item_total = ['dtl_b_air_gambut_total'];

                            let dtl_b_total_operasi_nilai = 0;
                            let dtl_b_total_operasi_akumulatif = 0;
                            let dtl_b_total_operasi_satuan = '';


                            if (result.data.result_frmfss315.length) {
                                // console.log(result.data);
                                list_dtl_b = '';
                                for (let dtl_b_i = 0; dtl_b_i < list_dtl_b_item.length; dtl_b_i++) {
                                    if (list_dtl_b_item[dtl_b_i] == 'dtl_b_air_gambut_total') {
                                        list_dtl_b += `<tr>
                                                        <input type="hidden" name="dtl_b_operasi_jenis[]" id="dtl_b_operasi_jenis" class="dtl_b_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_jenis'] + `">                                    
                                                        <input type="hidden" name="dtl_b_operasi_satuan[]" id="dtl_b_operasi_satuan" class="dtl_b_operasi_satuan form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_satuan'] + `">
                                                        <input type="hidden" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai form-control w-auto angkadantitik" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_nilai']).toFixed(1) + `"  >
                                                        <input type="hidden" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_akumulatif']).toFixed(1) + `" required readonly>
                                                        <td class="table-info align-middle text-center" align="center"></td>
                                                        <td class="table-info align-middle text-center" align="center">` + result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_jenis'] + `</td>
                                                        <td class="table-info align-middle text-center" align="center">` + parseFloat(result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_nilai']).toFixed(1) + `</td>
                                                        <td class="table-info align-middle text-center" align="center">` + parseFloat(result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_akumulatif']).toFixed(1) + `</td>
                                                        <td class="table-info align-middle text-center" align="center">` + result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_satuan'] + `</td>
                                                    </tr>`;
                                    } else if (list_dtl_b_item[dtl_b_i] == 'dtl_b_jam_operasi') {
                                        list_dtl_b += `<tr>
                                                        <input type="hidden" name="dtl_b_operasi_jenis[]" id="dtl_b_operasi_jenis" class="dtl_b_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_jenis'] + `">                                    
                                                        <input type="hidden" name="dtl_b_operasi_satuan[]" id="dtl_b_operasi_satuan" class="dtl_b_operasi_satuan form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_satuan'] + `">
                                                        <td align="center">` + (dtl_b_i + 1) + `</td>
                                                        <td align="center">` + result.data.result_operasi_jam[0][list_dtl_b_item[dtl_b_i] + '_jenis'] + `</td>
                                                        <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai form-control w-auto angkadantitik" style="text-align: center;" value="` + parseFloat(result.data.result_operasi_jam[0][list_dtl_b_item[dtl_b_i] + '_nilai']).toFixed(1) + `"  ></td>
                                                        <td align="center"><input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_operasi_jam[0][list_dtl_b_item[dtl_b_i] + '_akumulatif']).toFixed(1) + `" required></td>
                                                        <td align="center">` + result.data.result_operasi_jam[0][list_dtl_b_item[dtl_b_i] + '_satuan'] + `</td>
                                                    </tr>`;
                                    } else {
                                        list_dtl_b += `<tr>
                                                        <input type="hidden" name="dtl_b_operasi_jenis[]" id="dtl_b_operasi_jenis" class="dtl_b_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_jenis'] + `">                                    
                                                        <input type="hidden" name="dtl_b_operasi_satuan[]" id="dtl_b_operasi_satuan" class="dtl_b_operasi_satuan form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_satuan'] + `">
                                                        <td align="center">` + (dtl_b_i + 1) + `</td>
                                                        <td align="center">` + result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_jenis'] + `</td>
                                                        <td align="center"><input type="text" name="dtl_b_operasi_nilai[]" id="dtl_b_operasi_nilai" class="dtl_b_operasi_nilai form-control w-auto angkadantitik" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_nilai']).toFixed(1) + `"  ></td>
                                                        <td align="center"><input type="text" name="dtl_b_operasi_akumulatif[]" id="dtl_b_operasi_akumulatif" class="dtl_b_operasi_akumulatif form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_akumulatif']).toFixed(1) + `" required readonly></td>
                                                        <td align="center">` + result.data.result_frmfss315[0][list_dtl_b_item[dtl_b_i] + '_satuan'] + `</td>
                                                    </tr>`;
                                    }
                                }



                                for (let dtl_b_i2 = 0; dtl_b_i2 < list_dtl_b_item_total.length; dtl_b_i2++) {
                                    dtl_b_total_operasi_nilai += parseFloat(result.data.result_frmfss315[0][list_dtl_b_item_total[dtl_b_i2] + '_nilai'])
                                    dtl_b_total_operasi_akumulatif += parseFloat(result.data.result_frmfss315[0][list_dtl_b_item_total[dtl_b_i2] + '_akumulatif'])
                                    dtl_b_total_operasi_satuan = result.data.result_frmfss315[0][list_dtl_b_item_total[dtl_b_i2] + '_satuan'];
                                }

                                dtsampel_frmfss315_headerid = result.data.result_frmfss315[0].headerid;
                                dtsampel_frmfss315_complete_date = result.data.result_frmfss315[0].complete_date;
                                dtsampel_frmfss315_complete_time = result.data.result_frmfss315[0].complete_time;
                            }
                            $('#tbody_dtl_b').empty().append(list_dtl_b);
                            dtl_b_operasi_nilai();
                            // dtl b end

                            // dtl c
                            let list_dtl_c = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;
                            const list_dtl_c_item = ['jam_operasi', 'proses', 'reject'];
                            const list_dtl_c_uf_item = ['jam_operasi_uf', 'proses_uf'];
                            // console.log(result.data.result_frmfss520)
                            if (result.data.result_frmfss520.length) {
                                list_dtl_c = '';
                                for (let dtl_c_i = 0; dtl_c_i < list_dtl_c_item.length; dtl_c_i++) {
                                    list_dtl_c += `<tr>
                                                        <input type="hidden" name="dtl_c_operasi_jenis[]" id="dtl_c_operasi_jenis" class="dtl_c_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss520[0][list_dtl_c_item[dtl_c_i] + '_jenis'] + `">                                    
                                                        <input type="hidden" name="dtl_c_operasi_satuan[]" id="dtl_c_operasi_satuan" class="dtl_c_operasi_satuan form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss520[0][list_dtl_c_item[dtl_c_i] + '_satuan'] + `">
                                                        <input type="hidden" name="dtl_c_operasi_status[]" id="dtl_c_operasi_status" class="dtl_c_operasi_status form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss520[0]['tabel_status'] + `">
                                                        <td align="center">` + (dtl_c_i + 1) + `</td>
                                                        <td align="center">` + result.data.result_frmfss520[0][list_dtl_c_item[dtl_c_i] + '_jenis'] + `</td>
                                                        <td align="center"><input type="text" name="dtl_c_operasi_nilai[]" id="dtl_c_operasi_nilai" class="dtl_c_operasi_nilai form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss520[0][list_dtl_c_item[dtl_c_i] + '_nilai']).toFixed(1) + `" required readonly></td>
                                                        <td align="center"><input type="text" name="dtl_c_operasi_akumulatif[]" id="dtl_c_operasi_akumulatif" class="dtl_c_operasi_akumulatif form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss520[0][list_dtl_c_item[dtl_c_i] + '_akumulatif']).toFixed(1) + `" required readonly></td>
                                                        <td align="center">` + result.data.result_frmfss520[0][list_dtl_c_item[dtl_c_i] + '_satuan'] + `</td>
                                                    </tr>`;

                                }

                                dtsampel_frmfss520_headerid = result.data.result_frmfss520[0].headerid;
                                dtsampel_frmfss520_complete_date = result.data.result_frmfss520[0].complete_date;
                                dtsampel_frmfss520_complete_time = result.data.result_frmfss520[0].complete_time;
                            }
                            $('#tbody_dtl_c').empty().append(list_dtl_c);

                            let list_dtl_c_uf = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;

                            if (result.data.result_intwtd014.length) {
                                list_dtl_c_uf = '';
                                for (let dtl_c_i_uf = 0; dtl_c_i_uf < list_dtl_c_uf_item.length; dtl_c_i_uf++) {
                                    list_dtl_c_uf += `<tr>
                                                            <input type="hidden" name="dtl_c_operasi_jenis[]" id="dtl_c_operasi_jenis" class="dtl_c_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_intwtd014[0][list_dtl_c_uf_item[dtl_c_i_uf] + '_jenis'] + `">                                    
                                                            <input type="hidden" name="dtl_c_operasi_satuan[]" id="dtl_c_operasi_satuan" class="dtl_c_operasi_satuan form-control w-auto" style="text-align: center;" value="` + result.data.result_intwtd014[0][list_dtl_c_uf_item[dtl_c_i_uf] + '_satuan'] + `">
                                                            <input type="hidden" name="dtl_c_operasi_status[]" id="dtl_c_operasi_status" class="dtl_c_operasi_status form-control w-auto" style="text-align: center;" value="` + result.data.result_intwtd014[0]['tabel_uf_status'] + `">
                                                            <td align="center">` + (dtl_c_i_uf + 1) + `</td>
                                                            <td align="center">` + result.data.result_intwtd014[0][list_dtl_c_uf_item[dtl_c_i_uf] + '_jenis'] + `</td>
                                                            <td align="center"><input type="text" name="dtl_c_operasi_nilai[]" id="dtl_c_operasi_nilai" class="dtl_c_operasi_nilai form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_intwtd014[0][list_dtl_c_uf_item[dtl_c_i_uf] + '_nilai']).toFixed(2) + `" required readonly></td>
                                                            <td align="center"><input type="text" name="dtl_c_operasi_akumulatif[]" id="dtl_c_operasi_akumulatif" class="dtl_c_operasi_akumulatif form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_intwtd014[0][list_dtl_c_uf_item[dtl_c_i_uf] + '_akumulatif']).toFixed(2) + `" required readonly></td>
                                                            <td align="center">` + result.data.result_intwtd014[0][list_dtl_c_uf_item[dtl_c_i_uf] + '_satuan'] + `</td>
                                                        </tr>`;

                                }
                            }

                            $('#tbody_dtl_c_uf').empty().append(list_dtl_c_uf);
                            // dtl c end

                            // dtl d
                            let list_dtl_d = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;

                            let dtl_d_stok_air_awal_nilai = 0;
                            let dtl_d_readonly = '';


                            $stok_air_awal = result.data.stok_air[0].total_stok_awal_kemarin == null ? 0 : result.data.stok_air[0].total_stok_awal_kemarin;
                            list_dtl_d = `<tr>
                                            <td align="center">1</td>
                                            <td align="center">Total stok</td>
                                            <td align="center"><input type="text" name="dtl_d_stok_air_awal[]" id="dtl_d_stok_air_awal" class="dtl_d_stok_air_awal form-control w-auto angkadantitik" style="text-align: center;" value="` + $stok_air_awal + `" required ` + dtl_d_readonly + `></td>
                                            <td align="center">M3</td>
                                        </tr>`;


                            $('#tbody_dtl_d').empty().append(list_dtl_d);
                            // dtl d end

                            // dtl e
                            let list_dtl_e = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;
                            const list_dtl_e_item = ['dtl_e_pre_treatment', 'dtl_e_asf', 'dtl_e_acf', 'dtl_e_ast', 'dtl_e_ro'];
                            let dtl_e_total_operasi_nilai = 0;
                            let dtl_e_total_operasi_akumulatif = 0;
                            let dtl_e_total_operasi_satuan = '';

                            if (result.data.result_frmfss315.length) {
                                list_dtl_e = '';
                                for (let dtl_e_i = 0; dtl_e_i < list_dtl_e_item.length; dtl_e_i++) {
                                    list_dtl_e += `<tr>
                                                        <input type="hidden" name="dtl_e_operasi_jenis[]" id="dtl_e_operasi_jenis" class="dtl_e_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_e_item[dtl_e_i] + '_jenis'] + `">                                    
                                                        <input type="hidden" name="dtl_e_operasi_satuan[]" id="dtl_e_operasi_satuan" class="dtl_e_operasi_satuan form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_e_item[dtl_e_i] + '_satuan'] + `">
                                                        <td align="center">` + (dtl_e_i + 1) + `</td>
                                                        <td align="center">` + result.data.result_frmfss315[0][list_dtl_e_item[dtl_e_i] + '_jenis'] + `</td>
                                                        <td align="center"><input type="text" name="dtl_e_operasi_nilai[]" id="dtl_e_operasi_nilai" class="dtl_e_operasi_nilai form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_e_item[dtl_e_i] + '_nilai']).toFixed(1) + `" required readonly></td>
                                                        <td align="center"><input type="text" name="dtl_e_operasi_akumulatif[]" id="dtl_e_operasi_akumulatif" class="dtl_e_operasi_akumulatif form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_e_item[dtl_e_i] + '_akumulatif']).toFixed(1) + `" required readonly></td>
                                                        <td align="center">` + result.data.result_frmfss315[0][list_dtl_e_item[dtl_e_i] + '_satuan'] + `</td>
                                                    </tr>`;

                                    dtl_e_total_operasi_nilai += parseFloat(result.data.result_frmfss315[0][list_dtl_e_item[dtl_e_i] + '_nilai']);
                                    dtl_e_total_operasi_akumulatif += parseFloat(result.data.result_frmfss315[0][list_dtl_e_item[dtl_e_i] + '_akumulatif']);
                                    dtl_e_total_operasi_satuan = result.data.result_frmfss315[0][list_dtl_e_item[dtl_e_i] + '_satuan'];
                                }
                            }

                            $('.dtl_e_total_operasi_nilai').empty().append(parseFloat(dtl_e_total_operasi_nilai).toFixed(1));
                            $('.dtl_e_total_operasi_akumulatif').empty().append(parseFloat(dtl_e_total_operasi_akumulatif).toFixed(1));
                            $('.dtl_e_total_operasi_satuan').empty().append(dtl_e_total_operasi_satuan);
                            $('#tbody_dtl_e').empty().append(list_dtl_e);
                            // dtl e end

                            // dtl f
                            const list_dtl_f_item = ['dtl_f_asf', 'dtl_f_acf', 'dtl_f_ast', 'dtl_f_ro', 'dtl_f_konen'];
                            let dtl_f_total = 0;
                            let dtl_f_total_akumulatif = 0;
                            let list_dtl_f = '';
                            let dtl_f_val_nilai = '';
                            let dtl_f_val_akumulatif = '';
                            if (result.data.result_frmfss315.length && result.data.result_frmfss520.length && result.data.result_frmfss317_f.length) {
                                for (let dtl_f_i = 0; dtl_f_i < list_dtl_f_item.length; dtl_f_i++) {
                                    if (result.data.result_frmfss317_f[0][list_dtl_f_item[dtl_f_i] + '_jenis'] == 'Reject RO') {
                                        dtl_f_val_nilai = parseFloat(result.data.result_frmfss520[0].reject_nilai).toFixed(1);
                                    } else {
                                        dtl_f_val_nilai = 0;
                                    }
                                    if (result.data.result_frmfss317_f[0][list_dtl_f_item[dtl_f_i] + '_akumulatif'] != null) {
                                        dtl_f_val_akumulatif = parseFloat(result.data.result_frmfss317_f[0][list_dtl_f_item[dtl_f_i] + '_akumulatif']).toFixed(1);
                                    } else {
                                        dtl_f_val_akumulatif = 0;
                                    }
                                    list_dtl_f += `<tr>
                                                        <input type="hidden" name="dtl_f_operasi_jenis[]" id="dtl_f_operasi_jenis" class="dtl_f_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss520[0][list_dtl_f_item[dtl_f_i] + '_jenis'] + `">                                    
                                                        <input type="hidden" name="dtl_f_operasi_satuan[]" id="dtl_f_operasi_satuan" class="dtl_f_operasi_satuan form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss520[0][list_dtl_f_item[dtl_f_i] + '_satuan'] + `">
                                                        <td align="center">` + (dtl_f_i + 1) + `</td>
                                                        <td align="center">` + result.data.result_frmfss520[0][list_dtl_f_item[dtl_f_i] + '_jenis'] + `</td>
                                                        <td align="center"><input type="text" name="dtl_f_operasi_nilai[]" id="dtl_f_operasi_nilai" class="dtl_f_operasi_nilai form-control w-auto angkadantitik" style="text-align: center;" value="` + dtl_f_val_nilai + `"></td>
                                                        <td align="center"><input type="hidden" name="dtl_f_operasi_akumulatif_awal[]" id="dtl_f_operasi_akumulatif_awal" class="dtl_f_operasi_akumulatif_awal form-control w-auto angkadantitik" style="text-align: center;" value="` + dtl_f_val_akumulatif + `" readonly>
                                                                            <input type="text" name="dtl_f_operasi_akumulatif[]" id="dtl_f_operasi_akumulatif" class="dtl_f_operasi_akumulatif form-control w-auto angkadantitik" style="text-align: center;" value="` + dtl_f_val_akumulatif + `" readonly></td>
                                                        <td align="center">` + result.data.result_frmfss520[0][list_dtl_f_item[dtl_f_i] + '_satuan'] + `</td>
                                                    </tr>`;

                                    dtl_f_total += parseFloat(dtl_f_val_nilai);
                                    dtl_f_total_akumulatif += parseFloat(result.data.result_frmfss317_f[0][list_dtl_f_item[dtl_f_i] + '_akumulatif']);
                                }
                            }

                            $('.dtl_f_operasi_nilai_total').empty().append(dtl_f_total.toFixed(1));
                            $('.dtl_f_operasi_akumulatif_total').empty().append(dtl_f_total_akumulatif.toFixed(1));
                            $('#tbody_dtl_f').empty().append(list_dtl_f);
                            dtl_f_operasi_nilai_konservasi_energi();
                            // dtl f end

                            // dtl g
                            let nilai_stok_akhir_dan_Recycle = parseFloat(dtl_e_total_operasi_nilai) + parseFloat(dtl_f_total);
                            let list_dtl_g = `<tr>
                                                <td align="center">
                                                    <input type="text" name="dtl_g_stok_air_akhir[]" id="dtl_g_stok_air_akhir" class="dtl_g_stok_air_akhir form-control w-auto" style="text-align: center;" value="` + parseFloat(dtl_e_total_operasi_nilai) + `" required readonly>
                                                    <input type="hidden" name="dtl_g_stok_air_akhir_awal[]" id="dtl_g_stok_air_akhir_awal" class="dtl_g_stok_air_akhir_awal form-control w-auto" style="text-align: center;" value="` + parseFloat(dtl_e_total_operasi_nilai) + `" required readonly>
                                                </td>
                                                <td align="center"><input type="text" name="dtl_g_t_distribusi[]" id="dtl_g_t_distribusi" class="dtl_g_t_distribusi form-control w-auto" style="text-align: center;" value="` + parseFloat(dtl_a_grand_total_pemakaian).toFixed(1) + `" required readonly></td>
                                                <td align="center"><input type="text" name="dtl_g_stok_air_awal[]" id="dtl_g_stok_air_awal" class="dtl_g_stok_air_awal form-control w-auto" style="text-align: center;" value="` + $stok_air_awal + `" required readonly></td>
                                                <td align="center"><input type="text" name="dtl_g_total_proses[]" id="dtl_g_total_proses" class="dtl_g_total_proses form-control w-auto" style="text-align: center;" value="` + parseFloat(dtl_b_total_operasi_nilai).toFixed(1) + `" required readonly></td>
                                            </tr>`;
                            $('#tbody_dtl_g').empty().append(list_dtl_g);
                            dtl_g_cari_total_bawah();
                            // dtl g end

                            // dtl h
                            let list_dtl_h = '';

                            let dtl_h_drain_sedimen = '';
                            let dtl_h_backwash_tanki = '';
                            let dtl_h_cleaning_bak = '';
                            let dtl_h_operasional = '';


                            list_dtl_h = `<tr>
                                            <td align="center"><input type="text" name="dtl_h_drain_sedimen[]" id="dtl_h_drain_sedimen" class="dtl_h_drain_sedimen form-control w-auto angkadantitik" style="text-align: center;" value="` + dtl_h_drain_sedimen + `"></td>
                                            <td align="center"><input type="text" name="dtl_h_backwash_tanki[]" id="dtl_h_backwash_tanki" class="dtl_h_backwash_tanki form-control w-auto angkadantitik" style="text-align: center;" value="` + dtl_h_backwash_tanki + `"></td>
                                            <td align="center"><input type="text" name="dtl_h_cleaning_bak[]" id="dtl_h_cleaning_bak" class="dtl_h_cleaning_bak form-control w-auto angkadantitik" style="text-align: center;" value="` + dtl_h_cleaning_bak + `"></td>
                                            <td align="center"><input type="text" name="dtl_h_operasional[]" id="dtl_h_operasional" class="dtl_h_operasional form-control w-auto angkadantitik" style="text-align: center;" value="` + dtl_h_operasional + `"></td>
                                        </tr>`;

                            $('#tbody_dtl_h').empty().append(list_dtl_h);
                            // dtl h end     

                            // dtl i
                            let list_dtl_i = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;

                            const list_dtl_i_item = ['dtl_i_tawas', 'dtl_i_caustic_soda', 'dtl_i_ach'];
                            let dtl_i_nilai = 0;
                            let dtl_i_effisiensi = 0;
                            let dtl_i_total_opreasi_nilai = 0;
                            let dtl_i_total_operasi_effisiensi = 0;
                            if (result.data.result_frmfss315.length) {
                                list_dtl_i = '';
                                for (let dtl_i_i = 0; dtl_i_i < list_dtl_i_item.length; dtl_i_i++) {
                                    if (result.data.result_frmfss315[0][list_dtl_i_item[dtl_i_i] + '_jenis'] == 'Tawas (15%)') {
                                        dtl_i_nilai = parseFloat(result.data.result_frmfss315[0][list_dtl_i_item[dtl_i_i] + '_nilai']).toFixed(1);
                                        dtl_i_effisiensi = ((parseFloat(result.data.result_frmfss315[0][list_dtl_i_item[dtl_i_i] + '_nilai']).toFixed(1) * 0.15) / parseFloat(result.data.result_frmfss315[0]['dtl_b_air_gambut_sedimen_nilai_efisiensi']).toFixed(1)).toFixed(2);
                                    } else if (result.data.result_frmfss315[0][list_dtl_i_item[dtl_i_i] + '_jenis'] == 'Caustic soda (10%)') {
                                        dtl_i_nilai = parseFloat(result.data.result_frmfss315[0][list_dtl_i_item[dtl_i_i] + '_nilai']).toFixed(1);
                                        dtl_i_effisiensi = ((parseFloat(result.data.result_frmfss315[0][list_dtl_i_item[dtl_i_i] + '_nilai']).toFixed(1) * 0.1) / parseFloat(result.data.result_frmfss315[0]['dtl_b_air_gambut_total_nilai_efisiensi']).toFixed(1)).toFixed(2);
                                    } else if (result.data.result_frmfss315[0][list_dtl_i_item[dtl_i_i] + '_jenis'] == 'ACH (15%)') {
                                        dtl_i_nilai = parseFloat(result.data.result_frmfss315[0][list_dtl_i_item[dtl_i_i] + '_nilai']).toFixed(1);
                                        dtl_i_effisiensi = ((parseFloat(result.data.result_frmfss315[0][list_dtl_i_item[dtl_i_i] + '_nilai']).toFixed(1) * 0.15) / parseFloat(result.data.result_frmfss315[0]['dtl_b_air_gambut_cone_nilai_efisiensi']).toFixed(1)).toFixed(2);
                                    }

                                    list_dtl_i += `<tr>
                                                    <input type="hidden" name="dtl_i_operasi_jenis[]" id="dtl_i_operasi_jenis" class="dtl_i_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_i_item[dtl_i_i] + '_jenis'] + `">
                                                    <input type="hidden" name="dtl_i_operasi_akumulatif[]" id="dtl_i_operasi_akumulatif" class="dtl_i_operasi_akumulatif form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_i_item[dtl_i_i] + '_akumulatif']).toFixed(1) + `" required readonly>
                                                    <td align="center">` + (dtl_i_i + 1) + `</td>
                                                    <td align="center">` + result.data.result_frmfss315[0][list_dtl_i_item[dtl_i_i] + '_jenis'] + `</td>
                                                    <td align="center"><input type="text" name="dtl_i_operasi_nilai[]" id="dtl_i_operasi_nilai" class="dtl_i_operasi_nilai form-control w-auto" style="text-align: center;" value="` + dtl_i_nilai + `" required readonly></td>
                                                    <td align="center"><input type="text" name="dtl_i_operasi_effisiensi[]" id="dtl_i_operasi_effisiensi" class="dtl_i_operasi_effisiensi form-control w-auto" style="text-align: center;" value="` + dtl_i_effisiensi + `" required readonly></td>
                                                  </tr>`;

                                    dtl_i_total_opreasi_nilai += parseFloat(dtl_i_nilai);
                                    dtl_i_total_operasi_effisiensi += parseFloat(dtl_i_effisiensi);
                                }
                            }

                            $('.dtl_i_total_opreasi_nilai').empty().append(dtl_i_total_opreasi_nilai);
                            $('.dtl_i_total_operasi_effisiensi').empty().append(dtl_i_total_operasi_effisiensi);
                            $('#tbody_dtl_i').empty().append(list_dtl_i);
                            // dtl i end      

                            // dtl j
                            let list_dtl_j = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;


                            const list_dtl_j_item = ['dtl_j_alum', 'dtl_j_caustic'];

                            if (result.data.result_frmfss315.length) {
                                list_dtl_j = '';
                                for (let dtl_j_i = 0; dtl_j_i < list_dtl_j_item.length; dtl_j_i++) {
                                    list_dtl_j += `<tr>
                                                  <input type="hidden" name="dtl_j_operasi_jenis[]" id="dtl_j_operasi_jenis" class="dtl_j_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_j_item[dtl_j_i] + '_jenis'] + `">                                    
                                                  <input type="hidden" name="dtl_j_operasi_satuan[]" id="dtl_j_operasi_satuan" class="dtl_j_operasi_satuan form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_j_item[dtl_j_i] + '_satuan'] + `">
                                                  <td align="center">` + (dtl_j_i + 1) + `</td>
                                                  <td align="center">` + result.data.result_frmfss315[0][list_dtl_j_item[dtl_j_i] + '_jenis'] + `</td>
                                                  <td align="center"><input type="text" name="dtl_j_target[]" id="dtl_j_target" class="dtl_j_target form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_j_item[dtl_j_i] + '_target'] + `" required readonly></td>
                                                  <td align="center">` + result.data.result_frmfss315[0][list_dtl_j_item[dtl_j_i] + '_satuan'] + `</td>
                                                  </tr>`;
                                }
                            }

                            $('#tbody_dtl_j').empty().append(list_dtl_j);
                            // dtl j end

                            // dtl k
                            let list_dtl_k = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;
                            const list_dtl_k_item = ['dtl_k_tawas', 'dtl_k_caustic_soda', 'dtl_k_tcca', 'dtl_k_flokulan', 'dtl_k_ach'];
                            let dtl_k_effisiensi = 0;
                            let dtl_k_nilai = 0;
                            let dtl_k_akumulatif = 0;
                            if (result.data.result_frmfss315.length) {
                                list_dtl_k = '';
                                for (let dtl_k_i = 0; dtl_k_i < list_dtl_k_item.length; dtl_k_i++) {
                                    dtl_k_nilai = parseFloat(result.data.result_frmfss315[0][list_dtl_k_item[dtl_k_i] + '_nilai']).toFixed(1);
                                    dtl_k_akumulatif = parseFloat(result.data.result_frmfss315[0][list_dtl_k_item[dtl_k_i] + '_akumulatif']).toFixed(1);
                                    list_dtl_k += `<tr>
                                                        <input type="hidden" name="dtl_k_operasi_jenis[]" id="dtl_k_operasi_jenis" class="dtl_k_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_k_item[dtl_k_i] + '_jenis'] + `">   
                                                        <input type="hidden" name="dtl_k_effisiensi[]" id="dtl_k_effisiensi" class="dtl_k_effisiensi form-control w-auto" style="text-align: center;" value="` + dtl_k_effisiensi + `" required readonly>                                 
                                                        <td align="center">` + (dtl_k_i + 1) + `</td>
                                                        <td align="center">` + result.data.result_frmfss315[0][list_dtl_k_item[dtl_k_i] + '_jenis'] + `</td>
                                                        <td align="center"><input type="text" name="dtl_k_operasi_nilai[]" id="dtl_k_operasi_nilai" class="dtl_k_operasi_nilai form-control w-auto" style="text-align: center;" value="` + dtl_k_nilai + `" required readonly></td>
                                                        <td align="center"><input type="text" name="dtl_k_operasi_akumulatif[]" id="dtl_k_operasi_akumulatif" class="dtl_k_operasi_akumulatif form-control w-auto" style="text-align: center;" value="` + dtl_k_akumulatif + `" required readonly></td>
                                                        <td align="center"><input type="text" name="dtl_k_stock[]" id="dtl_k_stock" class="dtl_k_stock form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_k_item[dtl_k_i] + '_stok'] + `"></td>
                                                    </tr>`;
                                }
                            }

                            $('#tbody_dtl_k').empty().append(list_dtl_k);
                            // dtl k end

                            // dtl l
                            let list_dtl_l = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;

                            const list_dtl_l_item = ['dtl_l_garam'];

                            if (result.data.result_frmfss315.length) {
                                list_dtl_l = '';
                                for (let dtl_l_i = 0; dtl_l_i < list_dtl_l_item.length; dtl_l_i++) {
                                    list_dtl_l += `<tr>
                                                        <input type="hidden" name="dtl_l_operasi_jenis[]" id="dtl_l_operasi_jenis" class="dtl_l_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_l_item[dtl_l_i] + '_jenis'] + `">                                    
                                                        <input type="hidden" name="dtl_l_effisiensi[]" id="dtl_l_effisiensi" class="dtl_l_effisiensi form-control w-auto" style="text-align: center;" value="` + (parseFloat(result.data.result_frmfss315[0][list_dtl_l_item[dtl_l_i] + '_nilai']).toFixed(1) / parseFloat(result.data.result_frmfss315[0]['dtl_b_air_gambut_nilai']).toFixed(1)).toFixed(4) + `"readonly>
                                                        <td align="center">` + (dtl_l_i + 1) + `</td>
                                                        <td align="center">` + result.data.result_frmfss315[0][list_dtl_l_item[dtl_l_i] + '_jenis'] + `</td>
                                                        <td align="center"><input type="text" name="dtl_l_operasi_nilai[]" id="dtl_l_operasi_nilai" class="dtl_l_operasi_nilai form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_l_item[dtl_l_i] + '_nilai']).toFixed(1) + `" required readonly></td>
                                                        <td align="center"><input type="text" name="dtl_l_operasi_akumulatif[]" id="dtl_l_operasi_akumulatif" class="dtl_l_operasi_akumulatif form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_l_item[dtl_l_i] + '_akumulatif']).toFixed(1) + `" required readonly></td>
                                                        <td align="center"><input type="text" name="dtl_l_operasi_stok[]" id="dtl_l_operasi_stok" class="dtl_l_operasi_stok form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_l_item[dtl_l_i] + '_stok']).toFixed(1) + `"readonly></td>
                                                </tr>`;

                                }
                            }

                            $('#tbody_dtl_l').empty().append(list_dtl_l);
                            // dtl l end

                            // dtl m
                            let list_dtl_m = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;


                            const list_dtl_m_item = ['dtl_m_as', 'dtl_m_mcal', 'dtl_m_mcd', 'dtl_m_bcd'];

                            if (result.data.result_frmfss315.length) {
                                list_dtl_m = '';
                                for (let dtl_m_i = 0; dtl_m_i < list_dtl_m_item.length; dtl_m_i++) {
                                    list_dtl_m += `<tr>
                                                        <input type="hidden" name="dtl_m_operasi_jenis[]" id="dtl_m_operasi_jenis" class="dtl_m_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_m_item[dtl_m_i] + '_jenis'] + `">
                                                        <input type="hidden" name="dtl_m_effisiensi[]" id="dtl_m_effisiensi" class="dtl_m_effisiensi form-control w-auto" style="text-align: center;" value="` + (parseFloat(result.data.result_frmfss315[0][list_dtl_m_item[dtl_m_i] + '_nilai']).toFixed(1) / parseFloat(result.data.result_frmfss315[0]['dtl_b_air_gambut_nilai']).toFixed(1)).toFixed(4) + `" required readonly>
                                                        <td align="center">` + (dtl_m_i + 1) + `</td>
                                                        <td align="center">` + result.data.result_frmfss315[0][list_dtl_m_item[dtl_m_i] + '_jenis'] + `</td>
                                                        <td align="center"><input type="text" name="dtl_m_operasi_nilai[]" id="dtl_m_operasi_nilai" class="dtl_m_operasi_nilai form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_m_item[dtl_m_i] + '_nilai']).toFixed(1) + `" required readonly></td>
                                                        <td align="center"><input type="text" name="dtl_m_operasi_akumulatif[]" id="dtl_m_operasi_akumulatif" class="dtl_m_operasi_akumulatif form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_m_item[dtl_m_i] + '_akumulatif']).toFixed(1) + `" required readonly></td>
                                                        <td align="center"><input type="text" name="dtl_m_operasi_stok[]" id="dtl_m_operasi_stok" class="dtl_m_operasi_stok form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_m_item[dtl_m_i] + '_stok']).toFixed(1) + `" required readonly></td>
                                                </tr>`;

                                }
                            }

                            $('#tbody_dtl_m').empty().append(list_dtl_m);
                            // dtl m end

                            // dtl n
                            let list_dtl_n = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;

                            const list_dtl_n_item = ['dtl_n_cf', 'dtl_n_bf'];

                            if (result.data.result_frmfss315.length) {
                                list_dtl_n = '';
                                for (let dtl_n_i = 0; dtl_n_i < list_dtl_n_item.length; dtl_n_i++) {
                                    list_dtl_n += `<tr>
                                                        <input type="hidden" name="dtl_n_operasi_jenis[]" id="dtl_n_operasi_jenis" class="dtl_n_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss315[0][list_dtl_n_item[dtl_n_i] + '_jenis'] + `">                                    
                                                        <td align="center">` + (dtl_n_i + 1) + `</td>
                                                        <td align="center">` + result.data.result_frmfss315[0][list_dtl_n_item[dtl_n_i] + '_jenis'] + `</td>
                                                        <td align="center"><input type="text" name="dtl_n_operasi_nilai[]" id="dtl_n_operasi_nilai" class="dtl_n_operasi_nilai form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_n_item[dtl_n_i] + '_nilai']).toFixed(1) + `" required readonly></td>
                                                        <td align="center"><input type="text" name="dtl_n_operasi_akumulatif[]" id="dtl_n_operasi_akumulatif" class="dtl_n_operasi_akumulatif form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_n_item[dtl_n_i] + '_akumulatif']).toFixed(1) + `" required readonly></td>
                                                        <td align="center"><input type="text" name="dtl_n_operasi_stok[]" id="dtl_n_operasi_stok" class="dtl_n_operasi_stok form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss315[0][list_dtl_n_item[dtl_n_i] + '_stok']).toFixed(1) + `" required readonly></td>
                                                </tr>`;

                                }
                            }

                            $('#tbody_dtl_n').empty().append(list_dtl_n);
                            // dtl n end


                            // dtl o
                            let list_dtl_o = `<tr>
                                                <td align="center" colspan="20"><i>Data belum tersedia!</i></td>
                                            </tr>`;
                            const list_dtl_o_item = ['dtl_o_ro1', 'dtl_o_ro2', 'dtl_o_ro3'];

                            let dtl_o_total_m3 = 0;
                            let dtl_o_total_jam = 0;
                            let dtl_o_total_satuan = '';
                            let dtl_o_uf_total_m3 = 0;
                            let dtl_o_uf_total_jam = 0;
                            let dtl_o_uf_total_satuan = '';

                            if (result.data.result_frmfss520.length) {
                                list_dtl_o = '';
                                for (let dtl_o_i = 0; dtl_o_i < list_dtl_o_item.length; dtl_o_i++) {
                                    list_dtl_o += `<tr>
                                                    <input type="hidden" name="dtl_o_operasi_jenis[]" id="dtl_o_operasi_jenis" class="dtl_o_operasi_jenis form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss520[0][list_dtl_o_item[dtl_o_i] + '_jenis'] + `">                                    
                                                    <input type="hidden" name="dtl_o_operasi_satuan[]" id="dtl_o_operasi_satuan" class="dtl_o_operasi_satuan form-control w-auto" style="text-align: center;" value="` + result.data.result_frmfss520[0][list_dtl_o_item[dtl_o_i] + '_satuan'] + `">
                                                    <td align="center">` + (dtl_o_i + 1) + `</td>
                                                    <td align="center">` + result.data.result_frmfss520[0][list_dtl_o_item[dtl_o_i] + '_jenis'] + `</td>
                                                    <td align="center"><input type="text" name="dtl_o_operasi_produk[]" id="dtl_o_operasi_produk" class="dtl_o_operasi_produk form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss520[0][list_dtl_o_item[dtl_o_i] + '_produk']).toFixed(1) + `" required readonly></td>
                                                    <td align="center"><input type="text" name="dtl_o_operasi_jam[]" id="dtl_o_operasi_jam" class="dtl_o_operasi_jam form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_frmfss520[0][list_dtl_o_item[dtl_o_i] + '_jam']).toFixed(1) + `" required readonly></td>
                                                    <td align="center">` + result.data.result_frmfss520[0][list_dtl_o_item[dtl_o_i] + '_satuan'] + `</td>
                                                    </tr>`;

                                    dtl_o_total_m3 += parseFloat(result.data.result_frmfss520[0][list_dtl_o_item[dtl_o_i] + '_produk']);
                                    dtl_o_total_jam += parseFloat(result.data.result_frmfss520[0][list_dtl_o_item[dtl_o_i] + '_jam']);
                                    dtl_o_total_satuan = result.data.result_frmfss520[0][list_dtl_o_item[dtl_o_i] + '_satuan'];
                                }
                                list_dtl_o += `
                                            <tr>
                                                <td class="table-warning align-middle text-center" rowspan="1" colspan="2">Total</td>
                                                <td class="table-warning align-middle text-center dtl_o_total_m3" rowspan="1" colspan="1">` + parseFloat(dtl_o_total_m3).toFixed(1) + `</td>
                                                <td class="table-warning align-middle text-center dtl_o_total_jam" rowspan="1" colspan="1">` + parseFloat(dtl_o_total_jam).toFixed(1) + `</td>
                                                <td class="table-warning align-middle text-center dtl_o_total_satuan" rowspan="1" colspan="1"></td>
                                            </tr>`;
                            }
                            if (result.data.result_intwtd014.length) {
                                list_dtl_o += `<tr>
                                                    <input type="hidden" name="dtl_o_operasi_jenis[]" id="dtl_o_operasi_jenis" class="dtl_o_operasi_jenis form-control w-auto" style="text-align: center;" value="Proses UF">                                    
                                                    <input type="hidden" name="dtl_o_operasi_satuan[]" id="dtl_o_operasi_satuan" class="dtl_o_operasi_satuan form-control w-auto" style="text-align: center;" value="Jam">
                                                    <td align="center">1</td>
                                                    <td align="center">Proses UF</td>
                                                    <td align="center"><input type="text" name="dtl_o_operasi_produk[]" id="dtl_o_operasi_produk" class="dtl_o_operasi_produk form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_intwtd014[0]['proses_uf_nilai']).toFixed(2) + `" readonly></td>
                                                    <td align="center"><input type="text" name="dtl_o_operasi_jam[]" id="dtl_o_operasi_jam" class="dtl_o_operasi_jam form-control w-auto" style="text-align: center;" value="` + parseFloat(result.data.result_intwtd014[0]['jam_operasi_uf_nilai']).toFixed(2) + `" readonly></td>
                                                    <td align="center">Jam</td>
                                                </tr>`;
                                dtl_o_uf_total_m3 += parseFloat(result.data.result_intwtd014[0]['proses_uf_nilai']);
                                dtl_o_uf_total_jam += parseFloat(result.data.result_intwtd014[0]['jam_operasi_uf_nilai']);
                                dtl_o_uf_total_satuan = 'Jam';

                                list_dtl_o += `<tr>
                                                    <td class="table-warning align-middle text-center" rowspan="1" colspan="2">Total</td>
                                                    <td class="table-warning align-middle text-center dtl_o_total_m3" rowspan="1" colspan="1">` + dtl_o_uf_total_m3 + `</td>
                                                    <td class="table-warning align-middle text-center dtl_o_total_jam" rowspan="1" colspan="1">` + dtl_o_uf_total_jam + `</td>
                                                    <td class="table-warning align-middle text-center dtl_o_total_satuan" rowspan="1" colspan="1">` + dtl_o_uf_total_satuan + `</td>
                                                </tr>`;
                            } else {
                                list_dtl_o += `<tr>
                                                <td align="center" colspan="20"><i>Data Proses UF belum tersedia!</i></td>
                                            </tr>`;
                            }
                            // $('.dtl_o_total_m3').empty().append(parseFloat(dtl_o_total_m3).toFixed(1));
                            // $('.dtl_o_total_jam').empty().append(parseFloat(dtl_o_total_jam).toFixed(1));
                            // $('.dtl_o_total_satuan').empty().append(dtl_o_total_satuan);
                            $('#tbody_dtl_o').empty().append(list_dtl_o);
                            // dtl o end



                            $('.dtsampel_frmfss315_headerid').val(dtsampel_frmfss315_headerid);
                            $('.dtsampel_frmfss315_complete_date').val(dtsampel_frmfss315_complete_date);
                            $('.dtsampel_frmfss315_complete_time').val(dtsampel_frmfss315_complete_time);
                            $('.dtsampel_frmfss316_headerid').val(dtsampel_frmfss316_headerid);
                            $('.dtsampel_frmfss316_complete_date').val(dtsampel_frmfss316_complete_date);
                            $('.dtsampel_frmfss316_complete_time').val(dtsampel_frmfss316_complete_time);
                            $('.dtsampel_frmfss317_headerid').val(dtsampel_frmfss317_headerid);
                            $('.dtsampel_frmfss317_complete_date').val(dtsampel_frmfss317_complete_date);
                            $('.dtsampel_frmfss317_complete_time').val(dtsampel_frmfss317_complete_time);
                            $('.dtsampel_frmfss520_headerid').val(dtsampel_frmfss520_headerid);
                            $('.dtsampel_frmfss520_complete_date').val(dtsampel_frmfss520_complete_date);
                            $('.dtsampel_frmfss520_complete_time').val(dtsampel_frmfss520_complete_time);
                        }

                        notif_btnconfirm_custom(result.vstatus, result.pesan);
                    }
                });
            }
        }
        dtl_b_operasi_nilai();
        dtl_f_operasi_nilai_konservasi_energi();

    });


    function dtl_b_operasi_nilai() {
        $('.dtl_b_operasi_nilai_wtd').keyup(function() {
            let that = $(this);
            let that_val = that.val();

            let akumulatif = that.closest('tr').find('.dtl_b_operasi_akumulatif').val();
            let hasil_akumulatif_wtd = (parseFloat(that_val) + parseFloat(akumulatif)).toFixed(1);

            var akm_operasi = that.closest('tr').find('.dtl_b_operasi_akumulatif_wtd_awal').val();
            var akm_wtd_fix = (parseFloat(akm_operasi) + parseFloat(that_val)).toFixed(1);
            that.closest('tr').find('.dtl_b_operasi_akumulatif_wtd').val(isNaN(akm_wtd_fix) ? akm_operasi : akm_wtd_fix);

            let grand_total_pemakaian = 0;
            $('.dtl_a_pemakaian').each(function(list_dtl_row) {
                grand_total_pemakaian += parseFloat($(this).val());
            });

            let val_distribusi = parseFloat(that_val) + parseFloat(grand_total_pemakaian);

            $('#dtl_g_t_distribusi').val(val_distribusi.toFixed(1));

            let dtl_g_stok_air_akhir = $('#dtl_g_stok_air_akhir').val();
            let dtl_g_stok_air_awal = $('#dtl_g_stok_air_awal').val();
            let dtl_g_total_proses = $('#dtl_g_total_proses').val();

            let dtl_g_total_bawah = parseFloat(dtl_g_stok_air_akhir) + parseFloat(val_distribusi) - parseFloat(dtl_g_stok_air_awal) - parseFloat(dtl_g_total_proses);
            $('.dtl_g_total_bawah').empty().append(parseFloat(dtl_g_total_bawah).toFixed(1));
        });
    }

    // total dtl f 
    function dtl_f_operasi_nilai_konservasi_energi() {
        $('.dtl_f_operasi_nilai').keyup(function() {
            let that = $(this);
            let that_val = $(this).val();
            var id = $(this).attr('id');
            var id_akm = that.closest('tr').find('.dtl_f_operasi_akumulatif').attr('id');

            hitung_total(id);

            let dtl_f_akumulatif_awal = that.closest('tr').find('.dtl_f_operasi_akumulatif_awal').val();

            let dtl_f_akumulatif = (parseFloat(that_val) + parseFloat(dtl_f_akumulatif_awal));
            that.closest('tr').find('.dtl_f_operasi_akumulatif').val(parseFloat(isNaN(dtl_f_akumulatif) ? dtl_f_akumulatif_awal : dtl_f_akumulatif).toFixed(1))

            hitung_total(id_akm);

            let val_total_f = $('.dtl_f_operasi_nilai_total').text();
            let val_dtl_g_stok_air_akhir = $('.dtl_g_stok_air_akhir').val();
            let val_dtl_g_stok_air_akhir_awal = $('.dtl_g_stok_air_akhir_awal').val();
            let val_stok_akhir_recycle = (parseFloat(val_total_f) + parseFloat(val_dtl_g_stok_air_akhir_awal));
            // console.log(val_stok_akhir_recycle)
            $('.dtl_g_stok_air_akhir').val(parseFloat(isNaN(val_stok_akhir_recycle) ? val_dtl_g_stok_air_akhir_awal : val_stok_akhir_recycle).toFixed(1));
            dtl_g_cari_total_bawah()
        });
    }

    function hitung_total(id) {
        var v = [];
        $('.' + id).each(function() {
            if ($(this).val() != '') {
                v.push($(this).val());
            }
        });
        var jml = 0;
        var total = 0;
        for (var i = 0; i < v.length; i++) {
            if (v[i] != '') {
                jml++;
                total += (parseFloat(v[i]));
            }
        }
        if (total != 0) {
            $('.' + id + '_total').empty().append((total).toFixed(1));
        } else {
            $('.' + id + '_total').empty().append('0');
        }
    }
    // total dtl g 
    function dtl_g_cari_total_bawah() {
        let grand_total_pemakaian = $('.dtl_a_grand_total_pemakaian').text();
        // let grand_total_pemakaian = 0;
        // $('.dtl_a_pemakaian').each(function(list_dtl_row) {
        //     grand_total_pemakaian += parseFloat($(this).val());
        // });

        let dtl_g_stok_air_akhir = $('#dtl_g_stok_air_akhir').val();
        let dtl_g_t_distribusi = $('#dtl_g_t_distribusi').val(parseFloat(grand_total_pemakaian).toFixed(1));
        let dtl_g_stok_air_awal = $('#dtl_g_stok_air_awal').val();
        let dtl_g_total_proses = $('#dtl_g_total_proses').val();

        let dtl_g_total_bawah = parseFloat(dtl_g_stok_air_akhir) + parseFloat(grand_total_pemakaian) - parseFloat(dtl_g_stok_air_awal) - parseFloat(dtl_g_total_proses);
        // console.log(dtl_g_stok_air_akhir, grand_total_pemakaian, dtl_g_stok_air_awal, parseFloat(dtl_g_total_proses), parseFloat(dtl_g_total_bawah).toFixed(1))
        $('.dtl_g_total_bawah').empty().append(parseFloat(dtl_g_total_bawah).toFixed(1));
    };
    // total dtl g end
</script>



<?php $this->load->view('template/footbarend'); ?>