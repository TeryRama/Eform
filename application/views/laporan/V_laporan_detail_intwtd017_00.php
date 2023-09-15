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
}

$base_url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$fcpath2   = str_replace('utl/', '', FCPATH);
$style_ttd = 'style="width:130px; height:80px; background-size:100%;"'; ?>

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

                        <div class="col-12">
                            <div class="table-responsive scrolly_table" id="scrolling_table_1" style="max-height: 800px;">
                                <table class="table table-striped table-bordered sticky-header">
                                    <thead class="table-info sticky-top">
                                        <tr>
                                            <th class="table-primary align-middle text-center" rowspan="3">No.</th>
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
                                            <th class="table-primary align-middle text-center" colspan="2">SPECIFICATION</th>
                                            <th class="table-primary align-middle text-center" colspan="2">4,5 - 6,5</th>
                                            <th class="table-primary align-middle text-center" colspan="2">80-110</th>
                                            <th class="table-primary align-middle text-center" colspan="2">500 max</th>
                                            <th class="table-primary align-middle text-center">5,0 - 7,0</th>
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
                                            <th class="table-primary align-middle text-center">6,5-8,5</th>
                                            <th class="table-primary align-middle text-center">50</th>
                                            <th class="table-primary align-middle text-center">3</th>
                                            <th class="table-primary align-middle text-center">6,5-8,5</th>
                                            <th class="table-primary align-middle text-center">50</th>
                                            <th class="table-primary align-middle text-center">5</th>
                                            <th class="table-primary align-middle text-center">6,5-8,5</th>
                                            <th class="table-primary align-middle text-center">50</th>
                                            <th class="table-primary align-middle text-center">3</th>
                                            <th class="table-primary align-middle text-center">6,5-8,5</th>
                                            <th class="table-primary align-middle text-center">50</th>
                                            <th class="table-primary align-middle text-center">3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        if (!empty($dtdetail)) {
                                            foreach ($dtdetail as $dtdetail_key => $dtdetail_row) {
                                        ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $dtdetail_row->jam ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'sedimen_ph')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->sedimen_ph_6a) && $dtdetail_row->sedimen_ph_6a > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->sedimen_ph_6a) && $dtdetail_row->sedimen_ph_6a < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->sedimen_ph_6a;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'sedimen_ph')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->sedimen_ph_6b) && $dtdetail_row->sedimen_ph_6b > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->sedimen_ph_6b) && $dtdetail_row->sedimen_ph_6b < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->sedimen_ph_6b;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'sedimen_colour')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->sedimen_colour_6a) && $dtdetail_row->sedimen_colour_6a > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->sedimen_colour_6a) && $dtdetail_row->sedimen_colour_6a < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->sedimen_colour_6a;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'sedimen_colour')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->sedimen_colour_6b) && $dtdetail_row->sedimen_colour_6b > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->sedimen_colour_6b) && $dtdetail_row->sedimen_colour_6b < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->sedimen_colour_6b;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'sedimen_tds')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->sedimen_tds_6a) && $dtdetail_row->sedimen_tds_6a > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->sedimen_tds_6a) && $dtdetail_row->sedimen_tds_6a < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->sedimen_tds_6a;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'sedimen_tds')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->sedimen_tds_6b) && $dtdetail_row->sedimen_tds_6b > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->sedimen_tds_6b) && $dtdetail_row->sedimen_tds_6b < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->sedimen_tds_6b;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'cone_ph')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->cone_ph) && $dtdetail_row->cone_ph > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->cone_ph) && $dtdetail_row->cone_ph < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->cone_ph;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'cone_colour')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->cone_colour) && $dtdetail_row->cone_colour > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->cone_colour) && $dtdetail_row->cone_colour < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->cone_colour;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'cone_tds')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->cone_tds) && $dtdetail_row->cone_tds > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->cone_tds) && $dtdetail_row->cone_tds < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->cone_tds;
                                                                } ?></td>
                                                    <?php for ($j = 1; $j <= 7; $j++) { ?>
                                                        <td <?php if (isset($dtspek_frommst)) {
                                                                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                    $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                    unset($red);
                                                                    if (($cek_dtspek_frommst->parameter == 'tsf_colour')) {
                                                                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->{'tsf_colour_sf' . $j}) && $dtdetail_row->{'tsf_colour_sf' . $j} > $cek_dtspek_frommst->spec_max) {
                                                                            // if ($mode_akses == 'mode_audit') {
                                                                            //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                            // } else {
                                                                            $red = 'style="background-color: #fe7e7e;"';
                                                                            // }
                                                                            break;
                                                                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->{'tsf_colour_sf' . $j}) && $dtdetail_row->{'tsf_colour_sf' . $j} < $cek_dtspek_frommst->spec_min) {
                                                                            // if ($mode_akses == 'mode_audit') {
                                                                            //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                            // } else {
                                                                            $red = 'style="background-color: #fe7e7e;"';
                                                                            // }
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            if (isset($red)) {
                                                                echo $red;
                                                                unset($red);
                                                            } ?>><?php if (isset($autoinspek)) {
                                                                        echo $autoinspek;
                                                                        unset($autoinspek);
                                                                    } else {
                                                                        echo $dtdetail_row->{'tsf_colour_sf' . $j};
                                                                    } ?></td>
                                                    <?php } ?>
                                                    <?php for ($j = 1; $j <= 7; $j++) { ?>
                                                        <td <?php if (isset($dtspek_frommst)) {
                                                                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                    $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                    unset($red);
                                                                    if (($cek_dtspek_frommst->parameter == 'tsf_turbidity')) {
                                                                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->{'tsf_turbidity_sf' . $j}) && $dtdetail_row->{'tsf_turbidity_sf' . $j} > $cek_dtspek_frommst->spec_max) {
                                                                            // if ($mode_akses == 'mode_audit') {
                                                                            //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                            // } else {
                                                                            $red = 'style="background-color: #fe7e7e;"';
                                                                            // }
                                                                            break;
                                                                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->{'tsf_turbidity_sf' . $j}) && $dtdetail_row->{'tsf_turbidity_sf' . $j} < $cek_dtspek_frommst->spec_min) {
                                                                            // if ($mode_akses == 'mode_audit') {
                                                                            //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                            // } else {
                                                                            $red = 'style="background-color: #fe7e7e;"';
                                                                            // }
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            if (isset($red)) {
                                                                echo $red;
                                                                unset($red);
                                                            } ?>><?php if (isset($autoinspek)) {
                                                                        echo $autoinspek;
                                                                        unset($autoinspek);
                                                                    } else {
                                                                        echo $dtdetail_row->{'tsf_turbidity_sf' . $j};
                                                                    } ?></td>
                                                    <?php } ?>
                                                    <?php for ($j = 1; $j <= 6; $j++) { ?>
                                                        <td <?php if (isset($dtspek_frommst)) {
                                                                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                    $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                    unset($red);
                                                                    if (($cek_dtspek_frommst->parameter == 'tcf_colour')) {
                                                                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->{'tcf_colour_cf' . $j}) && $dtdetail_row->{'tcf_colour_cf' . $j} > $cek_dtspek_frommst->spec_max) {
                                                                            // if ($mode_akses == 'mode_audit') {
                                                                            //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                            // } else {
                                                                            $red = 'style="background-color: #fe7e7e;"';
                                                                            // }
                                                                            break;
                                                                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->{'tcf_colour_cf' . $j}) && $dtdetail_row->{'tcf_colour_cf' . $j} < $cek_dtspek_frommst->spec_min) {
                                                                            // if ($mode_akses == 'mode_audit') {
                                                                            //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                            // } else {
                                                                            $red = 'style="background-color: #fe7e7e;"';
                                                                            // }
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            if (isset($red)) {
                                                                echo $red;
                                                                unset($red);
                                                            } ?>><?php if (isset($autoinspek)) {
                                                                        echo $autoinspek;
                                                                        unset($autoinspek);
                                                                    } else {
                                                                        echo $dtdetail_row->{'tcf_colour_cf' . $j};
                                                                    } ?></td>
                                                    <?php } ?>
                                                    <?php for ($j = 1; $j <= 6; $j++) { ?>
                                                        <td <?php if (isset($dtspek_frommst)) {
                                                                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                    $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                    unset($red);
                                                                    if (($cek_dtspek_frommst->parameter == 'tcf_turbidity')) {
                                                                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->{'tcf_turbidity_cf' . $j}) && $dtdetail_row->{'tcf_turbidity_cf' . $j} > $cek_dtspek_frommst->spec_max) {
                                                                            // if ($mode_akses == 'mode_audit') {
                                                                            //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                            // } else {
                                                                            $red = 'style="background-color: #fe7e7e;"';
                                                                            // }
                                                                            break;
                                                                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->{'tcf_turbidity_cf' . $j}) && $dtdetail_row->{'tcf_turbidity_cf' . $j} < $cek_dtspek_frommst->spec_min) {
                                                                            // if ($mode_akses == 'mode_audit') {
                                                                            //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                            // } else {
                                                                            $red = 'style="background-color: #fe7e7e;"';
                                                                            // }
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            if (isset($red)) {
                                                                echo $red;
                                                                unset($red);
                                                            } ?>><?php if (isset($autoinspek)) {
                                                                        echo $autoinspek;
                                                                        unset($autoinspek);
                                                                    } else {
                                                                        echo $dtdetail_row->{'tcf_turbidity_cf' . $j};
                                                                    } ?></td>
                                                    <?php } ?>
                                                    <?php for ($j = 1; $j <= 5; $j++) { ?>
                                                        <td <?php if (isset($dtspek_frommst)) {
                                                                foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                    $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                    unset($red);
                                                                    if (($cek_dtspek_frommst->parameter == 'ts_hardness')) {
                                                                        if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->{'ts_th_st' . $j}) && $dtdetail_row->{'ts_th_st' . $j} > $cek_dtspek_frommst->spec_max) {
                                                                            // if ($mode_akses == 'mode_audit') {
                                                                            //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                            // } else {
                                                                            $red = 'style="background-color: #fe7e7e;"';
                                                                            // }
                                                                            break;
                                                                        } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->{'ts_th_st' . $j}) && $dtdetail_row->{'ts_th_st' . $j} < $cek_dtspek_frommst->spec_min) {
                                                                            // if ($mode_akses == 'mode_audit') {
                                                                            //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                            // } else {
                                                                            $red = 'style="background-color: #fe7e7e;"';
                                                                            // }
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            if (isset($red)) {
                                                                echo $red;
                                                                unset($red);
                                                            } ?>><?php if (isset($autoinspek)) {
                                                                        echo $autoinspek;
                                                                        unset($autoinspek);
                                                                    } else {
                                                                        echo $dtdetail_row->{'ts_th_st' . $j};
                                                                    } ?></td>
                                                    <?php } ?>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'bak_demin_ph')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak_demin_ph) && $dtdetail_row->bak_demin_ph > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak_demin_ph) && $dtdetail_row->bak_demin_ph < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->bak_demin_ph;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'bak_demin_colour')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak_demin_colour) && $dtdetail_row->bak_demin_colour > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak_demin_colour) && $dtdetail_row->bak_demin_colour < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->bak_demin_colour;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'bak_demin_tbd')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak_demin_tbd) && $dtdetail_row->bak_demin_tbd > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak_demin_tbd) && $dtdetail_row->bak_demin_tbd < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->bak_demin_tbd;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'bak2_ph')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak2_ph) && $dtdetail_row->bak2_ph > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak2_ph) && $dtdetail_row->bak2_ph < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->bak2_ph;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'bak2_colour')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak2_colour) && $dtdetail_row->bak2_colour > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak2_colour) && $dtdetail_row->bak2_colour < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->bak2_colour;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'bak2_tbd')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak2_tbd) && $dtdetail_row->bak2_tbd > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak2_tbd) && $dtdetail_row->bak2_tbd < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->bak2_tbd;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'bak3_ph')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak3_ph) && $dtdetail_row->bak3_ph > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak3_ph) && $dtdetail_row->bak3_ph < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->bak3_ph;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'bak3_colour')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak3_colour) && $dtdetail_row->bak3_colour > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak3_colour) && $dtdetail_row->bak3_colour < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->bak3_colour;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'bak3_tbd')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak3_tbd) && $dtdetail_row->bak3_tbd > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak3_tbd) && $dtdetail_row->bak3_tbd < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->bak3_tbd;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'bak4_ph')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak4_ph) && $dtdetail_row->bak4_ph > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak4_ph) && $dtdetail_row->bak4_ph < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->bak4_ph;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'bak4_colour')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak4_colour) && $dtdetail_row->bak4_colour > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak4_colour) && $dtdetail_row->bak4_colour < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->bak4_colour;
                                                                } ?></td>
                                                    <td <?php if (isset($dtspek_frommst)) {
                                                            foreach ($dtspek_frommst as $cek_dtspek_frommst) {
                                                                $ikispek = 'min =' . $cek_dtspek_frommst->spec_min . ' 
                                                                        || max =' . $cek_dtspek_frommst->spec_max;
                                                                unset($red);
                                                                if (($cek_dtspek_frommst->parameter == 'bak4_tbd')) {
                                                                    if (is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($dtdetail_row->bak4_tbd) && $dtdetail_row->bak4_tbd > $cek_dtspek_frommst->spec_max) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_max;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    } elseif (is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($dtdetail_row->bak4_tbd) && $dtdetail_row->bak4_tbd < $cek_dtspek_frommst->spec_min) {
                                                                        // if ($mode_akses == 'mode_audit') {
                                                                        //     $autoinspek = $cek_dtspek_frommst->spec_min;
                                                                        // } else {
                                                                        $red = 'style="background-color: #fe7e7e;"';
                                                                        // }
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if (isset($red)) {
                                                            echo $red;
                                                            unset($red);
                                                        } ?>><?php if (isset($autoinspek)) {
                                                                    echo $autoinspek;
                                                                    unset($autoinspek);
                                                                } else {
                                                                    echo $dtdetail_row->bak4_tbd;
                                                                } ?></td>

                                                </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="table-info align-middle text-center" colspan="51"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <br>

                        <div class="col-12 mb-3">
                            <b>
                                <p style="text-align:center">Catatan KetidakSesuaian</p>
                            </b>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="table-danger align-middle text-center">No.</th>
                                            <th class="table-danger align-middle text-center">Jam</th>
                                            <th class="table-danger align-middle text-center">Uraian Ketidaksesuaian</th>
                                            <th class="table-danger align-middle text-center">Tindakan Perbaikan</th>
                                            <th class="table-danger align-middle text-center">Keterangan</th>
                                        </tr>
                                        <tr>

                                        </tr>
                                    </thead>
                                    <tbody id="tbody2">
                                        <?php $no2 = 1;
                                        foreach ($dtdetail_b as $dtdetail_row2) {
                                        ?>
                                            <tr>
                                                <td align="center"><?= $no2++ ?></td>
                                                <td align="center"><?= $dtdetail_row2->jam ?></td>
                                                <td><?= $dtdetail_row2->uraian ?></td>
                                                <td><?= $dtdetail_row2->tindakan ?></td>
                                                <td><?= $dtdetail_row2->keterangan ?></td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="table-danger align-middle text-center" colspan="10">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>


                        <div class="row mb-1">
                            <div class="col-6">
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