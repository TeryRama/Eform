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

foreach ($dtheader as $header) {
    $headerid     = $header->headerid;

    $comment      = $header->comment;
    $comment_by   = $header->comment_by;
    $comment_time = $header->comment_time;
    $comment_date = date("d-m-Y", strtotime($header->comment_date));

    $create_date  = date("d-m-Y", strtotime($header->create_date));
    $docno        = $header->docno;
    $remark       = $header->remark;
}

$shift_romawi = [
    'shift_1' => 'I',
    'shift_2' => 'II',
    'shift_3' => 'III',
]; ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content mt-2">
                    <div class="col-md-12 d-flex justify-content-center mb-1">
                        <div class="col-md-2 content-center mt-1">
                            <table class="table table-condensed">
                                <tr>
                                    <td style="text-align:center; font-weight: bold;"><img src="<?= base_url('assets/images/PSG_logo_2022.png') ?>" /></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-7 d-flex content-center">
                            <table class="table table-condensed">
                                <tr>
                                    <td style="text-align:center; font-weight: bold;">
                                        <h2><?= $this->config->item("nama_perusahaan"); ?></h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:center; font-weight: bold;">
                                        <h4><?= $frmjdl; ?></h4>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3 d-flex content-center">
                            <table class="table table-condensed">
                                <tr>
                                    <td style="text-align:left; font-weight: bold;">Doc. No</td>
                                    <td style="text-align:left; font-weight: bold;">: <?= $docno; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left; font-weight: bold;">Tanggal Laporan </td>
                                    <td style="text-align:left; font-weight: bold;">: <?= $create_date; ?> </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12" align="left">
                            <?php if (isset($leftheader)) {
                                echo '<td style="text-align:left; font-weight: bold;"><b>';
                                foreach ($leftheader as $rowleft) {
                                    echo $rowleft . '</br>';
                                }
                                echo "</b></td>"; ?>
                            <?php
                            } elseif (isset($comment)) { ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Laporan ini Sebelumnya telah Disapprove oleh <?= $comment_by; ?>, pada
                                        <?= $comment_date; ?> <?= $comment_time; ?>, komentar : <?= $comment; ?></strong>
                                </div>
                            <?php
                            } ?>
                        </div>
                         <?php $this->load->view('template/V_onprocess'); ?>

                        <div class="col-12">
                            <div class="table-responsive scrolly_table" id="scrolling_table_1" style="max-height: 800px;">
                                <table class="table table-striped table-bordered sticky-header">
                                    <thead class="table-info">
                                        <tr>
                                            <th class="table-primary align-middle text-center" colspan="1" rowspan="2">SHIFT</th>
                                            <th class="table-primary align-middle text-center" colspan="5">Proses Raw Water 1</th>
                                            <th class="table-primary align-middle text-center" colspan="5">Proses Raw Water 2</th>
                                            <th class="table-primary align-middle text-center" colspan="5">Proses Cone 1 - 2</th>
                                            <!-- <th class="table-primary align-middle text-center" colspan="5">Proses Cone 3 - 4</th> -->
                                        </tr>
                                        <tr>
                                            <?php for ($dtl_a_th = 0; $dtl_a_th < 3; $dtl_a_th++) { ?>
                                                <th class="table-primary align-middle text-center">Total (Jam)</th>
                                                <th class="table-primary align-middle text-center">FM Awal (M<sup>3</sup>)</th>
                                                <th class="table-primary align-middle text-center">FM Akhir (M<sup>3</sup>)</th>
                                                <th class="table-primary align-middle text-center">TotaL (M<sup>3</sup>)</th>
                                                <th class="table-primary align-middle text-center">Drain (M<sup>3</sup>)</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($dtdetail)) {
                                            foreach ($dtdetail as $dtdetail_key => $dtdetail_row) { ?>
                                                <tr>
                                                    <td align="center"><?= $shift_romawi[$dtdetail_row->shift] ?></td>
                                                    <td align="center"><?= $dtdetail_row->rw_1_total_jam ?></td>
                                                    <td align="center"><?= $dtdetail_row->rw_1_fm_awal ?></td>
                                                    <td align="center"><?= $dtdetail_row->rw_1_fm_akhir ?></td>
                                                    <td align="center"><?= $dtdetail_row->rw_1_total ?></td>
                                                    <td align="center"><?= $dtdetail_row->rw_1_drain ?></td>
                                                    <td align="center"><?= $dtdetail_row->rw_2_total_jam ?></td>
                                                    <td align="center"><?= $dtdetail_row->rw_2_fm_awal ?></td>
                                                    <td align="center"><?= $dtdetail_row->rw_2_fm_akhir ?></td>
                                                    <td align="center"><?= $dtdetail_row->rw_2_total ?></td>
                                                    <td align="center"><?= $dtdetail_row->rw_2_drain ?></td>
                                                    <td align="center"><?= $dtdetail_row->cone_1_2_total_jam ?></td>
                                                    <td align="center"><?= $dtdetail_row->cone_1_2_fm_awal ?></td>
                                                    <td align="center"><?= $dtdetail_row->cone_1_2_fm_akhir ?></td>
                                                    <td align="center"><?= $dtdetail_row->cone_1_2_total ?></td>
                                                    <td align="center"><?= $dtdetail_row->cone_1_2_drain ?></td>
                                                    <!-- <td align="center"><?= $dtdetail_row->cone_3_4_total_jam ?></td>
                                                    <td align="center"><?= $dtdetail_row->cone_3_4_fm_awal ?></td>
                                                    <td align="center"><?= $dtdetail_row->cone_3_4_fm_akhir ?></td>
                                                    <td align="center"><?= $dtdetail_row->cone_3_4_total ?></td>
                                                    <td align="center"><?= $dtdetail_row->cone_3_4_drain ?></td> -->
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="table-info align-middle text-center" colspan="21"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="table-responsive scrolly_table" id="scrolling_table_2" style="max-height: 800px;">
                                <table class="table table-striped table-bordered sticky-header">
                                    <thead class="table-success">
                                        <tr>
                                            <th class="table-success align-middle text-center" colspan="2" rowspan="3">Bahan Kimia</th>
                                            <?php for ($dtl_b_i = 1; $dtl_b_i <= 3; $dtl_b_i++) {
                                                echo '<th class="table-success align-middle text-center" colspan="6" rowspan="1">SHIFT ' . $shift_romawi['shift_' . $dtl_b_i] . '</th>';
                                            } ?>
                                        </tr>
                                        <tr>
                                            <?php for ($dtl_b_i = 1; $dtl_b_i <= 3; $dtl_b_i++) {
                                                echo '<th class="table-success align-middle text-center" colspan="3" rowspan="1">Bahan kimia Baku ( KG )</th>';
                                                echo '<th class="table-success align-middle text-center" colspan="3" rowspan="1">Bahan Kimia larutan ( liter)</th>';
                                            } ?>
                                        </tr>
                                        <tr>
                                            <?php for ($dtl_b_i = 1; $dtl_b_i <= 3 * 2; $dtl_b_i++) {
                                                echo '<th class="table-success align-middle text-center">Terima</th>';
                                                echo '<th class="table-success align-middle text-center">Pakai</th>';
                                                echo '<th class="table-success align-middle text-center">stok</th>';
                                            } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($dtdetail_b)) {
                                            // list item dulu
                                            foreach ($dtdetail_b as $dtdetail_b_row) {
                                                if ($dtdetail_b_row->shift == 'shift_1') {
                                                    if ($dtdetail_b_row->id_item2 != '') {
                                                        $dtl_b_td      = '<td align="center">' . $dtdetail_b_row->val_item2 . ' ' . $dtdetail_b_row->val_spek2 . '</td>';
                                                        $dtl_b_td_cols = '1';
                                                    } else {
                                                        $dtl_b_td      = '';
                                                        $dtl_b_td_cols = '2';
                                                    }

                                                    echo '<tr>';
                                                    echo $dtdetail_b_row->rnum_item1 == '1' ? '<td align="center" rowspan="' . $dtdetail_b_row->rnum_item1_desc . '" colspan="' . $dtl_b_td_cols . '">' . (($dtdetail_b_row->id_item1 == '23') ? $dtdetail_b_row->val_item1 . " " . $dtdetail_b_row->val_spek2 :  $dtdetail_b_row->val_item1) . '</td>' . $dtl_b_td : $dtl_b_td;

                                                    // list isi per shift
                                                    for ($dtl_b_i = 1; $dtl_b_i <= 3; $dtl_b_i++) {
                                                        foreach ($dtdetail_b as $dtdetail_b_row2) {
                                                            if ($dtl_b_i == substr($dtdetail_b_row2->shift, -1) && $dtdetail_b_row->id_item1 == $dtdetail_b_row2->id_item1 && $dtdetail_b_row->id_item2 == $dtdetail_b_row2->id_item2) {
                                                                echo '<td align="center">' . $dtdetail_b_row2->baku_terima . '</td>';
                                                                echo '<td align="center">' . $dtdetail_b_row2->baku_pakai . '</td>';
                                                                echo '<td align="center">' . $dtdetail_b_row2->baku_stok . '</td>';
                                                                echo '<td align="center">' . $dtdetail_b_row2->larutan_terima . '</td>';
                                                                echo '<td align="center">' . $dtdetail_b_row2->larutan_pakai . '</td>';
                                                                echo '<td align="center">' . $dtdetail_b_row2->larutan_stok . '</td>';
                                                                break;
                                                            }
                                                        }
                                                    }

                                                    echo '</tr>';
                                                }
                                            }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="table-success align-middle text-center" colspan="20"></th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <br>

                        <div class="col-12">
                            <div class="table-responsive scrolly_table" id="scrolling_table_1" style="max-height: 800px;">
                                <table class="table table-striped table-bordered sticky-header">
                                    <thead class="table-warning">
                                        <tr>
                                            <th class="table-warning align-middle text-center" rowspan="4" colspan="1">SHIFT</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="14">Raw Water (M³)</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="5">BSF (M³)</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="8">After Sand Filter (M³)</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="5">ACF (M³)</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="3">AST (M³)</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="3">ARO (M³)</th>
                                        </tr>
                                        <tr>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="12">Sedimen</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="2">Cone clarifier</th>

                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="2">Sedimen</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="3">Bak</th>

                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">ASF A</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">ASF B</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">ASF 1A</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">ASF 1B</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Bak 2</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Bak 3</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Tower TBN</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Tower Mess</th>

                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">ACF A</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">ACF B</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Bak IV</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Bak CIP 1</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Bak CIP 2</th>

                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">AST</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Bak Demin</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Tangki ST Mes</th>

                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Tangki RO Mes</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Tangki RO</th>
                                            <th class="table-warning align-middle text-center" rowspan="2" colspan="1">RO WTP</th>
                                        </tr>
                                        <tr>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">A1</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">A2</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">A3</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">A4</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">A5</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">A6</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">B1</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">B2</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">B3</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">B4</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">B5</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">B6</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1 - 2</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">3 - 4</th>

                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">C1</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">C2</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">V-Notch</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Reyclce</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">CW</th>
                                        </tr>
                                        <tr>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1898</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1998</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1887</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1963</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">2106</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">2015</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1909</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1900</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1900</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1752</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1357</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1632</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">600</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">600</th>

                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1080</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">1215</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">120</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">200</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">180</th>

                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">300</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">175</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">350</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">94</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">200</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">180</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">50</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">50</th>

                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">150</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">165</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">180</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">180</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">90</th>

                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">150</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">90</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">20</th>

                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">10</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">60</th>
                                            <th class="table-warning align-middle text-center" rowspan="1" colspan="1">75</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($dtdetail_c)) {
                                            foreach ($dtdetail_c as $dtdetail_c_key => $dtdetail_c_row) { ?>
                                                <tr>
                                                    <td align="center"><?= $shift_romawi[$dtdetail_c_row->shift] ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_sedimen_a1 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_sedimen_a2 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_sedimen_a3 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_sedimen_a4 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_sedimen_a5 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_sedimen_a6 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_sedimen_b1 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_sedimen_b2 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_sedimen_b3 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_sedimen_b4 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_sedimen_b5 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_sedimen_b6 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_cone_clarifier_1_2 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->rw_cone_clarifier_3_4 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->bsf_sedimen_c1 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->bsf_sedimen_c2 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->bsf_bak_v_notch ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->bsf_bak_reyclce ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->bsf_bak_cw ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->asf_asf_a ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->asf_asf_b ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->asf_asf_1a ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->asf_asf_1b ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->asf_bak_2 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->asf_bak_3 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->asf_tower_tbn ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->asf_tower_mess ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->acf_acf_a ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->acf_acf_b ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->acf_bak_iv ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->acf_bak_cip_1 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->acf_bak_cip_2 ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->ast_ast ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->ast_bak_demin ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->ast_tangki_st_mes ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->aro_tangki_ro_mes ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->aro_tangki_ro ?></td>
                                                    <td align="center"><?= $dtdetail_c_row->aro_ro_wtp ?></td>
                                                </tr>

                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="table-warning align-middle text-center" colspan="50"></th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <strong>Remark :</strong><br>
                                <textarea name="remark" id="remark" cols="50" rows="0" readonly><?= $remark ?></textarea>
                        </div>
                        <br>

                        <!-- <div class="col-12 mb-3">
                            <b>
                                <p style="text-align:center">Drain</p>
                            </b>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="table-danger align-middle text-center">No. </th>
                                            <th class="table-danger align-middle text-center">SHIFT</th>
                                            <th class="table-danger align-middle text-center">Jika ada drain</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no_d = 1;
                                        foreach ($dtdetail_d as $dtdetail_d_row) { ?>
                                            <tr>
                                                <td align="center"><?= $no_d++ ?></td>
                                                <td align="center"><?= $shift_romawi[$dtdetail_d_row->shift] ?></td>
                                                <td align="center"><?= $dtdetail_d_row->drain ?></td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="table-danger align-middle text-center" colspan="9">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div> -->


                        <div class="row mb-1">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-12 mt-1">
                                        <?php $this->load->view('laporan/V_laporan_definisi'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12" align="center">
                                <?php $this->load->view('approval/V_tabelapp'); ?>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12" align="right">
                                <?php if ($akses_excel == '1') { ?>
                                    <a class="btn bg-gradient-info" href="#" title="Export to Pdf" target="_blank" onclick="return confirm('EXPORT TO PDF... ?')"><i class="fa fa-file-pdf-o"></i> Export to Pdf</a>
                                    <a class="btn bg-gradient-success" href="<?= base_url('export_excel/C_export_toexcel_' . $frmkd . '_' . $frmvrs . '/exportxls/' . $frmkd . '/' . $frmvrs . '/' . $headerid) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
                                <?php
                                } ?>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <span class="pull-left">Mulai Berlaku: <?= $frmefec; ?></span>
                                <span class="pull-right"><?= $frmnm . '-' . $frmvrs; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('template/footbar'); ?>

<?php $this->load->view('template/footbarend'); ?>