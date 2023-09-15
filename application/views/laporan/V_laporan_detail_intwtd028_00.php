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

$no = 1;
$arr_parent = -1;
foreach ($dtlaporan as $dtlaporan_row) {
    $arr_parent++;
    $number[]           = $no++;
    $nama_jenis_air[]   = $dtlaporan_row->nama_jenis_air;
    $nama_departemen[]  = $dtlaporan_row->nama_departemen;
    $nama_flow[]        = $dtlaporan_row->nama_flow;
    $no_urut_desc[]     = $dtlaporan_row->no_urut_desc;
    $no_urut[]          = $dtlaporan_row->no_urut;
    if (isset($dtlaporan_row->children)) {
        foreach ($dtlaporan_row->children as $child_row) {
            $pemakaian[$arr_parent][]       = $child_row->pemakaian;
            $day_date                       = $child_row->day_date;
            $arr_day_date[$arr_parent][]    = $child_row->day_date;
            $month_date                     = $child_row->month_date;
        }
    } else {
        $arr_day_date[$arr_parent][]    = '';
    }
    if (isset($dtlaporan_row->children2)) {
        foreach ($dtlaporan_row->children2 as $child_row2) {
            $dtl_a_total_pemakaian[$arr_parent][]    = $child_row2->total_pemakaian;
        }
    }
    if (isset($dtlaporan_row->children3)) {
        foreach ($dtlaporan_row->children3 as $child_row3) {
            $dtl_a_total_grand_pemakaian[]    = $child_row3->total_grand_pemakaian;
        }
    }
    if (isset($dtlaporan_row->children4)) {
        foreach ($dtlaporan_row->children4 as $child_row4) {
            $dtl_a_pemakaian_akumulatif[]    = $child_row4->pemakaian_akumulatif;
        }
    }
    if (isset($dtlaporan_row->children5)) {
        foreach ($dtlaporan_row->children5 as $child_row5) {
            $dtl_a_pemakaian_akumulatif_per_jenis[]    = $child_row5->pemakaian_akumulatif_per_jenis;
        }
    }
    if (isset($dtlaporan_row->children6)) {
        foreach ($dtlaporan_row->children6 as $child_row6) {
            $dtl_a_pemakaian_akumulatif_seluruhan    = $child_row6->pemakaian_akumulatif_seluruhan;
        }
    }
}
if (isset($dtlaporan_date)) {
    foreach ($dtlaporan_date as $dtlaporan_date_row) {
        $date[] = $dtlaporan_date_row->date;
    }
}
?>
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
                        <div class="col-md-10 d-flex content-center">
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
                                <!-- <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Laporan ini Sebelumnya telah Disapprove oleh <?php echo $comment_by; ?>, pada
                                    <?php echo $comment_date; ?> <?php echo $comment_time; ?>, komentar : <?php echo $comment; ?></strong> -->
                            </div>
                        <?php
                        } ?>
                    </div>
                    <?php $this->load->view('template/V_onprocess');

                    $bulan = $month_date;
                    if ($bulan == 1) {
                        $NamaBulan = "JANUARI";
                    } else if ($bulan == 2) {
                        $NamaBulan = "FEBRUARI";
                    } else if ($bulan == 3) {
                        $NamaBulan = "MARET";
                    } else if ($bulan == 4) {
                        $NamaBulan = "APRIL";
                    } else if ($bulan == 5) {
                        $NamaBulan = "MEI";
                    } else if ($bulan == 6) {
                        $NamaBulan = "JUNI";
                    } else if ($bulan == 7) {
                        $NamaBulan = "JULI";
                    } else if ($bulan == 8) {
                        $NamaBulan = "AGUSTUS";
                    } else if ($bulan == 9) {
                        $NamaBulan = "SEPTEMBER";
                    } else if ($bulan == 10) {
                        $NamaBulan = "OKTOBER";
                    } else if ($bulan == 11) {
                        $NamaBulan = "NOVEMBER";
                    } else if ($bulan == 12) {
                        $NamaBulan = "DESEMBER";
                    }

                    ?>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive scrolly_table">
                                    <table class="table table-bordered sticky-header">
                                        <thead>
                                            <tr>
                                                <th class="table-info align-middle text-center" rowspan="4">No</th>
                                                <th class="table-info align-middle text-center" rowspan="3">Jenis Air</th>
                                            </tr>
                                            <tr>
                                                <th class="table-info align-middle text-center" colspan="2"><?= $NamaBulan ?></th>
                                                <?php
                                                $lastday = $day_date;
                                                for ($i = 1; $i <= $lastday; $i++) { ?>
                                                    <th class="table-info align-middle text-center" rowspan="2"> <?= $i ?> </th>
                                                <?php
                                                } ?>
                                                <th class="table-info align-middle text-center" rowspan="2">Akumulatif</th>
                                            </tr>
                                            <tr>
                                                <th class="table-info align-middle text-center" colspan="2">Departemen Pemakai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($arr = 0; $arr < count($dtlaporan); $arr++) { ?>
                                                <tr>
                                                    <td><?= $number[$arr]; ?></td>
                                                    <?php if ($no_urut[$arr] == 1) { ?>
                                                        <td rowspan="<?= $no_urut_desc[$arr] ?>"><?= $nama_jenis_air[$arr]; ?></td>
                                                    <?php } ?>
                                                    <td><?= $nama_departemen[$arr]; ?></td>
                                                    <td><?= $nama_flow[$arr]; ?></td>
                                                    <?php for ($arr2 = 0; $arr2 < $day_date; $arr2++) { ?>
                                                        <td align="center"><?= isset($pemakaian[$arr][$arr2]) ? $pemakaian[$arr][$arr2] : 0; ?></td>
                                                    <?php } ?>
                                                    <td align="center"><?= isset($dtl_a_pemakaian_akumulatif[$arr]) ? $dtl_a_pemakaian_akumulatif[$arr] : 0; ?></td>
                                                </tr>
                                                <?php
                                                if ($no_urut_desc[$arr] == 1) { ?>
                                                    <tr class="bg-secondary">
                                                        <td align="center" colspan="4">Total <?= $nama_jenis_air[$arr]; ?></td>
                                                        <?php for ($arr2 = 0; $arr2 < $day_date; $arr2++) { ?>
                                                            <td align="center"><?= isset($dtl_a_total_pemakaian[$arr][$arr2]) ? $dtl_a_total_pemakaian[$arr][$arr2] : 0; ?></td>
                                                        <?php } ?>
                                                        <td align="center"><?= isset($dtl_a_pemakaian_akumulatif_per_jenis[$arr]) ? $dtl_a_pemakaian_akumulatif_per_jenis[$arr] : 0; ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-info align-middle text-center" colspan="4" align="center">Total</td>
                                                <?php
                                                for ($arr2 = 0; $arr2 < $day_date; $arr2++) { ?>
                                                    <td class="table-info align-middle text-center" colspan="1" align="center"><?= isset($dtl_a_total_grand_pemakaian[$arr2]) ? $dtl_a_total_grand_pemakaian[$arr2] : 0; ?></td>
                                                <?php } ?>
                                                <td class="table-info align-middle text-center" colspan="1" align="center"><?= isset($dtl_a_pemakaian_akumulatif_seluruhan) ? $dtl_a_pemakaian_akumulatif_seluruhan : 0; ?></td>
                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <?php $this->load->view('laporan/V_laporan_definisi'); ?>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12" align="center">
                                <?php $this->load->view('approval/V_tabelapp'); ?>
                            </div>
                        </div>
                        <?php

                        $newUri = '';
                        if (trim($bulan) <> '') {
                            if($bulan >= '01' && $bulan <= '09'){
                                $newUri = '0'.urlencode($bulan);
                            }else{
                                $newUri = urlencode($bulan);
                            }
                        } else {
                            $newUri = "-";
                        }

                        $newUri2 = '';
                        if (trim($tahun) <> '') {
                            $newUri2 = urlencode($tahun);
                        } else {
                            $newUri2 = "-";
                        }
                        ?>
                        <div class="row mt-2">
                            <div class="col-12" align="right">
                                <?php if ($akses_excel == '1') { ?>
                                    <a class="btn bg-gradient-info" href="#" title="Export to Pdf" target="_blank" onclick="return confirm('EXPORT TO PDF... ?')"><i class="fa fa-file-pdf-o"></i> Export to Pdf</a>
                                    <a class="btn bg-gradient-success" href="<?= base_url('export_excel/C_export_toexcel_' . $frmkd . '_' . $frmvrs . '/exportxls/' . $frmkd . '/' . $frmvrs . '/' . $newUri . '/' . $newUri2) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
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