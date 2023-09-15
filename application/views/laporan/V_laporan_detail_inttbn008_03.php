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
    $bulan        = $header->bulan;
    $docno        = $header->docno;
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
                                        <img src="<?= base_url('assets/images/Logo_PSG.gif') ?>" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-7 d-flex content-center">
                            <table class="table table-condensed">
                                <tr>
                                    <td style="text-align:center; font-weight: bold;">
                                        <h2><?= $this->config->item("nama_perusahaan"); ?></h2>
                                        <h4>DEPARTEMEN PWP-TBN</h4>
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
                                    <td style="text-align:left; font-weight: bold;">Bulan </td>
                                    <td style="text-align:left; font-weight: bold;">: <?php echo $bulan; ?> </td>
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
                    <?php //$this->load->view('template/V_onprocess'); 
                    ?>
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-12">
                                <!-- Tabel ditarik dari form 009 -->
                                <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="fixed freeze_vertical">
                                            <tr>
                                                <th class="fixed align-middle text-center" style="background-color: white;" rowspan="2" colspan="1">No.</th>
                                                <th class="fixed align-middle text-center" style="background-color: white;" rowspan="2" colspan="1">Tanggal</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="4">Batubara</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="2">Debu Arang</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="4">Tempurung</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="4">Sabut</th>
                                                <th class="table-secondary align-middle text-center" rowspan="1" colspan="2">Cocopiet</th>
                                                <th class="align-middle text-center" style="background-color: white;" rowspan="2" colspan="1">Total Pakai <br> Bahan Bakar <br> (a+b+c+d)</th>
                                            </tr>
                                            <tr>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Stock Awal <br> Batubara</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Terima <br> Batubara</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Pakai <br> Batubara (a)</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Stock Akhir <br> Batubara</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Terima <br> Debu Arang</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Pakai <br> Debu Arang (b)</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Stock Awal <br> Tempurung</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Terima <br> Tempurung</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Pakai <br> Tempurung (c)</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Stock Akhir <br> Tempurung</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Stock Awal <br> Sabut</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Terima <br> Sabut</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Pakai <br> Sabut</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Stock Akhir <br> Sabut</th>
                                                <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Terima <br> Cocopiet</th>
                                                <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Pakai <br> Cocopiet (d)</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tbody_dtl">
                                            <?php $no = 1; ?>
                                            <?php if (!isset($dtdetail_b)) {
                                                foreach ($dtdetail as $row) { ?>
                                                    <tr>
                                                        <input type="hidden" name="detail_id[]" id="detail_id" class="detail_id form-control w-auto" style="text-align: center;" value="<?= $row->detail_id; ?>">

                                                        <td align="center"><?= $no++; ?></td>
                                                        <td align="center">
                                                            <?= $row->tanggal_bahan_bakar; ?>
                                                        </td>

                                                        <!-- batubara -->
                                                        <td align="center" class="table-danger"><?= $row->batubara_stock_awal; ?></td>
                                                        <td align="center" class="table-danger"><?= $row->batubara_terima; ?></td>
                                                        <td align="center" class="table-danger"><?= $row->batubara_pakai; ?></td>
                                                        <td align="center" class="table-danger">
                                                            <?= $row->batubara_stock_akhir; ?>
                                                        </td>
                                                        <!-- akhir batubara -->
                                                        <!-- debu arang -->
                                                        <td align="center" class="table-warning"><?= $row->debu_arang_terima; ?></td>
                                                        <td align="center" class="table-warning">
                                                            <?= $row->debu_arang_terima; ?>
                                                        </td>
                                                        <!-- akhir debu arang -->
                                                        <!-- tempurung -->
                                                        <td align="center" class="table-success"><?= $row->tempurung_stock_awal; ?></td>
                                                        <td align="center" class="table-success"><?= $row->tempurung_terima; ?></td>
                                                        <td align="center" class="table-success"><?= $row->tempurung_pakai; ?></td>
                                                        <td align="center" class="table-success">
                                                            <?= $row->tempurung_stock_akhir; ?>
                                                        </td>
                                                        <!-- akhir tempurung -->
                                                        <!-- sabut -->
                                                        <td align="center" class="table-primary"><?= $row->sabut_stock_awal; ?></td>
                                                        <td align="center" class="table-primary"><?= $row->sabut_terima; ?></td>
                                                        <td align="center" class="table-primary"><?= $row->sabut_pakai; ?></td>
                                                        <td align="center" class="table-primary">
                                                            <?= $row->sabut_stock_akhir; ?>
                                                        </td>
                                                        <!-- akhir sabut -->
                                                        <!-- cocopiet -->
                                                        <td align="center" class="table-secondary"><?= $row->cocopiet_terima; ?></td>
                                                        <td align="center" class="table-secondary">
                                                            <?= $row->cocopiet_pakai; ?>
                                                        </td>
                                                        <td align="center"><?= $row->total_pakai_bahan_bakar; ?></td>
                                                        <!-- akhir cocopiet -->
                                                    </tr>
                                            <?php
                                                }
                                            } ?>
                                        </tbody>

                                        <tfoot>
                                            <?php if (isset($dtheader)) {
                                                foreach ($dtheader as $row) { ?>
                                                    <tr>
                                                        <td class="align-middle text-center" style="background-color: white;" rowspan="1" colspan="2">Total</td>
                                                        <!-- batubara -->
                                                        <td class="table-danger align-middle text-center">
                                                            <?= $row->batubara_stock_awal_total; ?>
                                                        </td>
                                                        <td class="table-danger align-middle text-center">
                                                            <?= $row->batubara_terima_total; ?>
                                                        </td>
                                                        <td class="table-danger align-middle text-center">
                                                            <?= $row->batubara_pakai_total; ?>
                                                        </td>
                                                        <td class="table-danger align-middle text-center">
                                                            <?= $row->batubara_stock_akhir_total; ?>
                                                        </td>
                                                        <!-- akhir batubara -->
                                                        <!-- debu arang -->
                                                        <td class="table-warning align-middle text-center">
                                                            <?= $row->debu_arang_terima_total; ?>
                                                        </td>
                                                        <td class="table-warning align-middle text-center">
                                                            <?= $row->debu_arang_pakai_total; ?>
                                                        </td>
                                                        <!-- akhir debu arang -->
                                                        <!-- tempurung -->
                                                        <td class="table-success align-middle text-center">
                                                            <?= $row->tempurung_stock_awal_total; ?>
                                                        </td>
                                                        <td class="table-success align-middle text-center">
                                                            <?= $row->tempurung_terima_total; ?>
                                                        </td>
                                                        <td class="table-success align-middle text-center">
                                                            <?= $row->tempurung_pakai_total; ?>
                                                        </td>
                                                        <td class="table-success align-middle text-center">
                                                            <?= $row->tempurung_stock_akhir_total; ?>
                                                        </td>
                                                        <!-- akhir tempurung -->
                                                        <!-- sabut -->
                                                        <td class="table-primary align-middle text-center">
                                                            <?= $row->sabut_stock_awal_total; ?>
                                                        </td>
                                                        <td class="table-primary align-middle text-center">
                                                            <?= $row->sabut_terima_total; ?>
                                                        </td>
                                                        <td class="table-primary align-middle text-center">
                                                            <?= $row->sabut_pakai_total; ?>
                                                        </td>
                                                        <td class="table-primary align-middle text-center">
                                                            <?= $row->sabut_stock_akhir_total; ?>
                                                        </td>
                                                        <!-- akhir sabut -->
                                                        <!-- cocopiet -->
                                                        <td class="table-secondary align-middle text-center">
                                                            <?= $row->cocopiet_terima_total; ?>
                                                        </td>
                                                        <td class="table-secondary align-middle text-center">
                                                            <?= $row->cocopiet_pakai_total; ?>
                                                        </td>
                                                        <!-- akhir cocopiet -->
                                                        <!-- total pakai bahan bakar -->
                                                        <td class="align-middle text-center" style="background-color: white;">
                                                            <?= $row->total_pakai_bahan_bakar_total; ?>
                                                        </td>
                                                        <!-- akhir total pakai bahan bakar -->
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle text-center" style="background-color: white;" rowspan="1" colspan="2">Rata-Rata</td>
                                                        <!-- batubara -->
                                                        <td class="table-danger align-middle text-center">
                                                            <?= $row->batubara_stock_awal_rata2; ?>
                                                        </td>
                                                        <td class="table-danger align-middle text-center">
                                                            <?= $row->batubara_terima_rata2; ?>
                                                        </td>
                                                        <td class="table-danger align-middle text-center">
                                                            <?= $row->batubara_pakai_rata2; ?>
                                                        </td>
                                                        <td class="table-danger align-middle text-center">
                                                            <?= $row->batubara_stock_akhir_rata2; ?>
                                                        </td>
                                                        <!-- akhir batubara -->
                                                        <!-- debu arang -->
                                                        <td class="table-warning align-middle text-center">
                                                            <?= $row->debu_arang_terima_rata2; ?>
                                                        </td>
                                                        <td class="table-warning align-middle text-center">
                                                            <?= $row->debu_arang_pakai_rata2; ?>
                                                        </td>
                                                        <!-- akhir debu arang -->
                                                        <!-- tempurung -->
                                                        <td class="table-success align-middle text-center">
                                                            <?= $row->tempurung_stock_awal_rata2; ?>
                                                        </td>
                                                        <td class="table-success align-middle text-center">
                                                            <?= $row->tempurung_terima_rata2; ?>
                                                        </td>
                                                        <td class="table-success align-middle text-center">
                                                            <?= $row->tempurung_pakai_rata2; ?>
                                                        </td>
                                                        <td class="table-success align-middle text-center">
                                                            <?= $row->tempurung_stock_akhir_rata2; ?>
                                                        </td>
                                                        <!-- akhir tempurung -->
                                                        <!-- sabut -->
                                                        <td class="table-primary align-middle text-center">
                                                            <?= $row->sabut_stock_awal_rata2; ?>
                                                        </td>
                                                        <td class="table-primary align-middle text-center">
                                                            <?= $row->sabut_terima_rata2; ?>
                                                        </td>
                                                        <td class="table-primary align-middle text-center">
                                                            <?= $row->sabut_pakai_rata2; ?>
                                                        </td>
                                                        <td class="table-primary align-middle text-center">
                                                            <?= $row->sabut_stock_akhir_rata2; ?>
                                                        </td>
                                                        <!-- akhir sabut -->
                                                        <!-- cocopiet -->
                                                        <td class="table-secondary align-middle text-center">
                                                            <?= $row->cocopiet_terima_rata2; ?>
                                                        </td>
                                                        <td class="table-secondary align-middle text-center">
                                                            <?= $row->cocopiet_pakai_rata2; ?>
                                                        </td>
                                                        <!-- akhir cocopiet -->
                                                        <!-- total pakai bahan bakar -->
                                                        <td class="align-middle text-center" style="background-color: white;">
                                                            <?= $row->total_pakai_bahan_bakar_rata2; ?>
                                                        </td>
                                                        <!-- akhir total pakai bahan bakar -->
                                                    </tr>
                                            <?php
                                                }
                                            } ?>
                                        </tfoot>
                                    </table>
                                </div>
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