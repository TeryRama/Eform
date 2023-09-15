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
    $headerid       = $header->headerid;

    $comment        = $header->comment;
    $comment_by     = $header->comment_by;
    $comment_time   = $header->comment_time;
    $comment_date   = date("d-m-Y", strtotime($header->comment_date));

    $create_date    = date("d-m-Y", strtotime($header->create_date));
    $docno          = $header->docno;
    $date_before    = $header->date_before;
    $date_today     = $header->date_today;
    $date_next      = $header->date_next;
}  ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content mt-2">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="col-md-2 content-center mt-1">
                            <table class="table table-condensed">
                                <tr>
                                    <td style="text-align:center; font-weight: bold;">
                                        <img src="<?= base_url('assets/images/PSG_logo_2022.png') ?>" />
                                    </td>
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
                                    <td style="text-align:left; font-weight: bold;">: <?php echo $docno; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left; font-weight: bold;">Tanggal Laporan </td>
                                    <td style="text-align:left; font-weight: bold;">: <?php echo $create_date; ?> </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-12" align="left">
                        <?php if (isset($leftheader)) {
                            echo '<td style="text-align:left; font-weight: bold;"><b>';
                            foreach ($leftheader as $rowleft) {
                                echo $rowleft . '</br>';
                            }
                            echo "</b></td>"; ?>
                        <?php } elseif (isset($comment)) { ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Laporan ini Sebelumnya telah Disapprove oleh <?php echo $comment_by; ?>, pada
                                    <?php echo $comment_date; ?> <?php echo $comment_time; ?>, komentar : <?php echo $comment; ?></strong>
                            </div>
                        <?php
                        } ?>
                    </div>
                    <?php $this->load->view('template/V_onprocess'); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <strong>A. Data Bulanan</strong>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="fixed freeze_vertical">
                                            <tr>
                                                <td class="table-primary align-middle text-center" rowspan="2" colspan="1">No.</td>
                                                <td class="table-primary align-middle text-center" rowspan="2" colspan="1">Uraian</td>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="2"><?= $date_before; ?></td>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="4"><?= $date_today; ?></td>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="2"><?= $date_next; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">REALISASI</td>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">%</td>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">TARGET</td>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">%</td>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">REALISASI</td>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">%</td>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">TARGET</td>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1">%</td>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_a">
                                            <?php
                                            $no = 0;
                                            $no_dis_air = 1;
                                            $dtl_a_relasasi_before_total_akumulatif = 0;
                                            $dtl_a_relasasi_persen_before_total_persen = 0;
                                            $dtl_a_target_today_total_akumulatif = 0;
                                            $dtl_a_target_persen_today_total_persen = 0;
                                            $dtl_a_relasasi_today_total_akumulatif = 0;
                                            $dtl_a_relasasi_today_total_persen = 0;
                                            $dtl_a_target_next_total_akumulatif = 0;
                                            $dtl_a_target_persen_next_total_persen = 0;

                                            $dtl_a_2relasasi_before_total_all_akumulatif = 0;
                                            $dtl_a_2relasasi_persen_before_total_all_persen = 0;
                                            $dtl_a_2target_today_total_all_akumulatif = 0;
                                            $dtl_a_2target_persen_today_total_all_persen = 0;
                                            $dtl_a_2relasasi_today_total_all_akumulatif = 0;
                                            $dtl_a_2relasasi_today_total_all_persen = 0;
                                            $dtl_a_2target_next_total_all_akumulatif = 0;
                                            $dtl_a_2target_persen_next_total_all_persen = 0;

                                            $dtl_a_6relasasi_before_total_all_akumulatif = 0;
                                            $dtl_a_6relasasi_persen_before_total_all_persen = 0;
                                            $dtl_a_6target_today_total_all_akumulatif = 0;
                                            $dtl_a_6target_persen_today_total_all_persen = 0;
                                            $dtl_a_6relasasi_today_total_all_akumulatif = 0;
                                            $dtl_a_6relasasi_today_total_all_persen = 0;
                                            $dtl_a_6target_next_total_all_akumulatif = 0;
                                            $dtl_a_6target_persen_next_total_all_persen = 0;

                                            $dtl_a_7relasasi_before_total_all_akumulatif = 0;
                                            $dtl_a_7relasasi_persen_before_total_all_persen = 0;
                                            $dtl_a_7target_today_total_all_akumulatif = 0;
                                            $dtl_a_7target_persen_today_total_all_persen = 0;
                                            $dtl_a_7relasasi_today_total_all_akumulatif = 0;
                                            $dtl_a_7relasasi_today_total_all_persen = 0;
                                            $dtl_a_7target_next_total_all_akumulatif = 0;
                                            $dtl_a_7target_persen_next_total_all_persen = 0;

                                            if (isset($dtdetail)) {
                                                foreach ($dtdetail as $dtdetail_key => $dtdetail_value) {
                                                    if ($dtdetail_value->no_urut == 1) {
                                                        $no++;
                                                    }

                                                    // condition item 1
                                                    if ($dtdetail_value->dtl_a_definisi_1 == 'Biaya Operasional ( Rp )') {
                                                        $dtl_a_2relasasi_before_total_all_akumulatif       += $dtdetail_value->dtl_a_relasasi_before;
                                                        $dtl_a_2relasasi_persen_before_total_all_persen    += $dtdetail_value->dtl_a_relasasi_persen_before;
                                                        $dtl_a_2target_today_total_all_akumulatif          += $dtdetail_value->dtl_a_target_today;
                                                        $dtl_a_2target_persen_today_total_all_persen       += $dtdetail_value->dtl_a_target_persen_today;
                                                        $dtl_a_2relasasi_today_total_all_akumulatif        += $dtdetail_value->dtl_a_relasasi_today;
                                                        $dtl_a_2relasasi_today_total_all_persen            += $dtdetail_value->dtl_a_relasasi_persen_today;
                                                        $dtl_a_2target_next_total_all_akumulatif           += $dtdetail_value->dtl_a_target_next;
                                                        $dtl_a_2target_persen_next_total_all_persen        += $dtdetail_value->dtl_a_target_persen_next;
                                                        $attr_2readonly = '';
                                                    } else {
                                                        $attr_2readonly = 'readonly';
                                                    }

                                                    if ($dtdetail_value->dtl_a_definisi_1 == 'Distribusi Air') {
                                                        $dtl_a_6relasasi_before_total_all_akumulatif       += $dtdetail_value->dtl_a_relasasi_before;
                                                        $dtl_a_6relasasi_persen_before_total_all_persen    += $dtdetail_value->dtl_a_relasasi_persen_before;
                                                        $dtl_a_6target_today_total_all_akumulatif          += $dtdetail_value->dtl_a_target_today;
                                                        $dtl_a_6target_persen_today_total_all_persen       += $dtdetail_value->dtl_a_target_persen_today;
                                                        $dtl_a_6relasasi_today_total_all_akumulatif        += $dtdetail_value->dtl_a_relasasi_today;
                                                        $dtl_a_6relasasi_today_total_all_persen            += $dtdetail_value->dtl_a_relasasi_persen_today;
                                                        $dtl_a_6target_next_total_all_akumulatif           += $dtdetail_value->dtl_a_target_next;
                                                        $dtl_a_6target_persen_next_total_all_persen        += $dtdetail_value->dtl_a_target_persen_next;
                                                        $attr_6readonly = '';
                                                    } else {
                                                        $attr_6readonly = 'readonly';
                                                    }

                                                    if ($dtdetail_value->dtl_a_definisi_1 == 'Tenaga kerja') {
                                                        $dtl_a_7relasasi_before_total_all_akumulatif       += $dtdetail_value->dtl_a_relasasi_before;
                                                        $dtl_a_7relasasi_persen_before_total_all_persen    += $dtdetail_value->dtl_a_relasasi_persen_before;
                                                        $dtl_a_7target_today_total_all_akumulatif          += $dtdetail_value->dtl_a_target_today;
                                                        $dtl_a_7target_persen_today_total_all_persen       += $dtdetail_value->dtl_a_target_persen_today;
                                                        $dtl_a_7relasasi_today_total_all_akumulatif        += $dtdetail_value->dtl_a_relasasi_today;
                                                        $dtl_a_7relasasi_today_total_all_persen            += $dtdetail_value->dtl_a_relasasi_persen_today;
                                                        $dtl_a_7target_next_total_all_akumulatif           += $dtdetail_value->dtl_a_target_next;
                                                        $dtl_a_7target_persen_next_total_all_persen        += $dtdetail_value->dtl_a_target_persen_next;
                                                        $attr_7readonly = '';
                                                    } else {
                                                        $attr_7readonly = 'readonly';
                                                    }

                                                    // condition item 2
                                                    if ($dtdetail_value->dtl_a_definisi_2 == '1.1 PROSES AIR') {
                                                        $bg_style = 'class="table-danger align-middle text-left"';
                                                        $colspan_style = 'colspan="9"';
                                                        $text_bold = '<b>' . $dtdetail_value->dtl_a_definisi_2 . '</b>';
                                                        $td_input = '';
                                                    } else if (preg_match("~Biaya Lain-lain~", $dtdetail_value->dtl_a_definisi_2)) {
                                                        $bg_style = 'class="table-danger align-middle text-left"';
                                                        $colspan_style = 'colspan="9"';
                                                        $text_bold = '<b>' . $dtdetail_value->dtl_a_definisi_2 . '</b>';
                                                        $td_input = '';
                                                    } else if (preg_match("~After ~", $dtdetail_value->dtl_a_definisi_2)) {
                                                        $bg_style = 'class="table-danger align-middle text-left"';
                                                        $colspan_style = 'colspan="9"';
                                                        $text_bold = '<b>' . $dtdetail_value->dtl_a_definisi_2 . '</b>';
                                                        $td_input = '';
                                                    } else if ($dtdetail_value->dtl_a_definisi_2 == '5.1 Total Proses Air WTD') {
                                                        $bg_style = 'class="table-danger align-middle text-left"';
                                                        $colspan_style = 'colspan="9"';
                                                        $text_bold = '<b>' . $dtdetail_value->dtl_a_definisi_2 . '</b>';
                                                        $td_input = '';
                                                    } else if ($dtdetail_value->dtl_a_definisi_2 == '5.2 Pemakaian Air Efektif ( Total Pakai air - pemakaian oleh WTD )') {
                                                        $bg_style = 'class="table-danger align-middle text-left"';
                                                        $colspan_style = 'colspan="9"';
                                                        $text_bold = '<b>' . $dtdetail_value->dtl_a_definisi_2 . '</b>';
                                                        $td_input = '';
                                                    } else {
                                                        $bg_style = '';
                                                        $colspan_style = '';
                                                        $text_bold = $dtdetail_value->dtl_a_definisi_2;
                                                        $td_input = '
                                                                    <td align="center">' . $dtdetail_value->dtl_a_relasasi_before . '</td>
                                                                    <td align="center">' . $dtdetail_value->dtl_a_relasasi_persen_before . '</td>
                                                                    <td align="center">' . $dtdetail_value->dtl_a_target_today . '</td>
                                                                    <td align="center">' . $dtdetail_value->dtl_a_target_persen_today . '</td>
                                                                    <td align="center">' . $dtdetail_value->dtl_a_relasasi_today . '</td>
                                                                    <td align="center">' . $dtdetail_value->dtl_a_relasasi_persen_today . '</td>
                                                                    <td align="center">' . $dtdetail_value->dtl_a_target_next . '</td>
                                                                    <td align="center">' . $dtdetail_value->dtl_a_target_persen_next . '</td>';
                                                    }

                                                    // condition item 3
                                                    if ($dtdetail_value->dtl_a_definisi_3 != '' && preg_match("~Biaya Lain-lain~", $dtdetail_value->dtl_a_definisi_3)) {
                                                        $type_input3 = 'hidden';
                                                        $bg_style3 = 'class="table-danger align-middle text-center"';
                                                    } else {
                                                        $type_input3 = 'text';
                                                        $bg_style3 = '';
                                                    } ?>

                                                    <?php if ($dtdetail_value->no_urut == 1) { ?>
                                                        <tr class="table-warning align-middle text-left">
                                                            <td><?= $no; ?></td>
                                                            <td colspan="9"><b><?= $dtdetail_value->dtl_a_definisi_1 ?></b></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    if ($dtdetail_value->no_urut_b == 1) { ?>
                                                        <tr <?= $bg_style; ?>>
                                                            <td></td>
                                                            <td <?= $colspan_style ?>><?= $text_bold ?></td>
                                                            <?= $td_input ?>
                                                        </tr>
                                                    <?php
                                                    }
                                                    if ($dtdetail_value->dtl_a_definisi_3 != '') { ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><?= $dtdetail_value->dtl_a_definisi_3 ?></td>
                                                            <td align="center"><?= $dtdetail_value->dtl_a_relasasi_before ?></td>
                                                            <td align="center"><?= $dtdetail_value->dtl_a_relasasi_persen_before ?></td>
                                                            <td align="center"><?= $dtdetail_value->dtl_a_target_today ?></td>
                                                            <td align="center"><?= $dtdetail_value->dtl_a_target_persen_today ?></td>
                                                            <td align="center"><?= $dtdetail_value->dtl_a_relasasi_today  ?></td>
                                                            <td align="center"><?= $dtdetail_value->dtl_a_relasasi_persen_today; ?></td>
                                                            <td align="center"><?= $dtdetail_value->dtl_a_target_next ?></td>
                                                            <td align="center"><?= $dtdetail_value->dtl_a_target_persen_next ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    // total Distribusi Air per jenis air 
                                                    if (($no_dis_air++) == 1) {
                                                        $dtl_a_relasasi_before_total_akumulatif       = $dtdetail_value->dtl_a_relasasi_before;
                                                        $dtl_a_relasasi_persen_before_total_persen    = $dtdetail_value->dtl_a_relasasi_persen_before;
                                                        $dtl_a_target_today_total_akumulatif          = $dtdetail_value->dtl_a_target_today;
                                                        $dtl_a_target_persen_today_total_persen       = $dtdetail_value->dtl_a_target_persen_today;
                                                        $dtl_a_relasasi_today_total_akumulatif        = $dtdetail_value->dtl_a_relasasi_today;
                                                        $dtl_a_relasasi_today_total_persen            = $dtdetail_value->dtl_a_relasasi_persen_today;
                                                        $dtl_a_target_next_total_akumulatif           = $dtdetail_value->dtl_a_target_next;
                                                        $dtl_a_target_persen_next_total_persen        = $dtdetail_value->dtl_a_target_persen_next;
                                                    } else {
                                                        if ($dtdetail_value->dtl_a_definisi_2 == $dtdetail[$dtdetail_key - 1]->dtl_a_definisi_2) {
                                                            $dtl_a_relasasi_before_total_akumulatif       += $dtdetail_value->dtl_a_relasasi_before;
                                                            $dtl_a_relasasi_persen_before_total_persen    += $dtdetail_value->dtl_a_relasasi_persen_before;
                                                            $dtl_a_target_today_total_akumulatif          += $dtdetail_value->dtl_a_target_today;
                                                            $dtl_a_target_persen_today_total_persen       += $dtdetail_value->dtl_a_target_persen_today;
                                                            $dtl_a_relasasi_today_total_akumulatif        += $dtdetail_value->dtl_a_relasasi_today;
                                                            $dtl_a_relasasi_today_total_persen            += $dtdetail_value->dtl_a_relasasi_persen_today;
                                                            $dtl_a_target_next_total_akumulatif           += $dtdetail_value->dtl_a_target_next;
                                                            $dtl_a_target_persen_next_total_persen        += $dtdetail_value->dtl_a_target_persen_next;
                                                        } else {
                                                            $dtl_a_relasasi_before_total_akumulatif       = $dtdetail_value->dtl_a_relasasi_before;
                                                            $dtl_a_relasasi_persen_before_total_persen    = $dtdetail_value->dtl_a_relasasi_persen_before;
                                                            $dtl_a_target_today_total_akumulatif          = $dtdetail_value->dtl_a_target_today;
                                                            $dtl_a_target_persen_today_total_persen       = $dtdetail_value->dtl_a_target_persen_today;
                                                            $dtl_a_relasasi_today_total_akumulatif        = $dtdetail_value->dtl_a_relasasi_today;
                                                            $dtl_a_relasasi_today_total_persen            = $dtdetail_value->dtl_a_relasasi_persen_today;
                                                            $dtl_a_target_next_total_akumulatif           = $dtdetail_value->dtl_a_target_next;
                                                            $dtl_a_target_persen_next_total_persen        = $dtdetail_value->dtl_a_target_persen_next;
                                                        }
                                                    }

                                                    if ($dtdetail_value->no_urut_b_desc == 1) {
                                                        if ($dtdetail_value->dtl_a_definisi_1 == 'Distribusi Air') { ?>
                                                            <tr>
                                                                <td class="table-secondary align-middle text-left" colspan="2"><b>Total <?= preg_replace('/[\d.]/', '', $dtdetail_value->dtl_a_definisi_2) ?></b></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_relasasi_before_total_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_relasasi_persen_before_total_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_target_today_total_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_target_persen_today_total_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_relasasi_today_total_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_relasasi_today_total_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_target_next_total_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_target_persen_next_total_persen, 1); ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        if ($dtdetail_value->dtl_a_definisi_1 == 'Rp / ton air') { ?>
                                                            <tr>
                                                                <td class="table-secondary align-middle text-left" colspan="2"><b><?php if ($dtdetail_value->dtl_a_definisi_2 == '5.1 Total Proses Air WTD') {
                                                                                                                                        echo 'Total (Non Efektif)';
                                                                                                                                    } else {
                                                                                                                                        echo "Total HPP Efektif";
                                                                                                                                    } ?></b></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_relasasi_before_total_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_relasasi_persen_before_total_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_target_today_total_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_target_persen_today_total_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_relasasi_today_total_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_relasasi_today_total_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_target_next_total_akumulatif; ?> </td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_target_persen_next_total_persen, 1); ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    }
                                                    // total seluruhnya
                                                    if ($dtdetail_value->no_urut_desc == 1) {
                                                        if ($dtdetail_value->dtl_a_definisi_1 == 'Distribusi Air') { ?>
                                                            <tr>
                                                                <td class="table-secondary align-middle text-left" colspan="2"><b>Total <?= $dtdetail_value->dtl_a_definisi_1 ?></b></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_6relasasi_before_total_all_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_6relasasi_persen_before_total_all_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_6target_today_total_all_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_6target_persen_today_total_all_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_6relasasi_today_total_all_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_6relasasi_today_total_all_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_6target_next_total_all_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_6target_persen_next_total_all_persen, 1); ?></td>
                                                            </tr>
                                                        <?php } else if ($dtdetail_value->dtl_a_definisi_1 == 'Biaya Operasional ( Rp )') { ?>
                                                            <tr>
                                                                <td class="table-secondary align-middle text-left" colspan="2"><b>Total <?= $dtdetail_value->dtl_a_definisi_1 ?></b></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_2relasasi_before_total_all_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_2relasasi_persen_before_total_all_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_2target_today_total_all_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_2target_persen_today_total_all_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_2relasasi_today_total_all_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_2relasasi_today_total_all_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_2target_next_total_all_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_2target_persen_next_total_all_persen, 1); ?></td>
                                                            </tr>
                                                        <?php
                                                        } else if ($dtdetail_value->dtl_a_definisi_1 == 'Tenaga kerja') { ?>
                                                            <tr>
                                                                <td class="table-secondary align-middle text-left" colspan="2"><b>Total <?= $dtdetail_value->dtl_a_definisi_1 ?></b></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_7relasasi_before_total_all_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_7relasasi_persen_before_total_all_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_7target_today_total_all_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_7target_persen_today_total_all_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_7relasasi_today_total_all_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_7relasasi_today_total_all_persen, 1); ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= $dtl_a_7target_next_total_all_akumulatif; ?></td>
                                                                <td class="table-secondary align-middle text-center"><?= number_format($dtl_a_7target_persen_next_total_all_persen, 1); ?></td>
                                                            </tr>
                                            <?php
                                                        }
                                                    }
                                                }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-primary align-middle text-center" colspan="12"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-6">
                                    <?php $this->load->view('laporan/V_laporan_definisi'); ?>
                                </div> -->
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
                    <?php } else {/*No Acess Excel*/
                    } ?>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <span class="pull-left">Mulai Berlaku: <?= $frmefec; ?></span>
                    <a href="?#"><span class="pull-right"><?= $frmnm . '-' . $frmvrs; ?></span></a>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    </div>
</section><!-- /.content -->

<?php $this->load->view('template/footbar'); ?>


<?php $this->load->view('template/footbarend'); ?>