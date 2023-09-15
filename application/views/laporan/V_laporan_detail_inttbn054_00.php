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
    $headerid           = $header->headerid;
    $comment            = $header->comment;
    $comment_by         = $header->comment_by;
    $comment_time       = $header->comment_time;
    $comment_date       = date("d-m-Y", strtotime($header->comment_date));
    $create_date        = date("d-m-Y", strtotime($header->create_date));
    $bulan              = $header->bulan;
    $tahun              = $header->tahun;
    $docno              = $header->docno;
    $supply_awal_total  = $header->supply_awal_total;
    $supply_akhir_total = $header->supply_akhir_total;
    $supply_total_total = $header->supply_total_total;
    $asf_awal_total     = $header->asf_awal_total;
    $asf_akhir_total    = $header->asf_akhir_total;
    $asf_total_total    = $header->asf_total_total;
    $soft_awal_total    = $header->soft_awal_total;
    $soft_akhir_total   = $header->soft_akhir_total;
    $soft_total_total   = $header->soft_total_total;
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
                                                <th class="table-warning align-middle text-center" rowspan="2" colspan="1">No.</th>
                                                <th class="table-warning align-middle text-center" rowspan="2" colspan="1">Tanggal</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="3">SUPPLY DEMIN TO DEARATOR</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="3">Flow ASF-WTD</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="3">SOFTENER (AST) - WTD</th>
                                            </tr>
                                            <tr>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Flow Awal</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Flow Akhir</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Total</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Flow Awal</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Flow Akhir</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Total</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Flow Awal</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Flow Akhir</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Total</th>
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

                                                        <td align="center"><?= $row->supply_flow_awal; ?></td>
                                                        <td align="center"><?= $row->supply_flow_akhir; ?></td>
                                                        <td align="center"><?= $row->supply_total; ?></td>
                                                        <td align="center"><?= $row->asf_flow_awal; ?></td>
                                                        <td align="center"><?= $row->asf_flow_akhir; ?></td>
                                                        <td align="center"><?= $row->asf_total; ?></td>
                                                        <td align="center"><?= $row->soft_flow_awal; ?></td>
                                                        <td align="center"><?= $row->soft_flow_akhir; ?></td>
                                                        <td align="center"><?= $row->soft_total; ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            } ?>
                                        </tbody>

                                        <tfoot>
                                            <?php if (isset($dtheader)) {
                                                foreach ($dtheader as $row) { ?>
                                                    <tr>
                                                        <td class="table-warning align-middle text-center" rowspan="1" colspan="2">Total</td>
                                                        <td class="table-danger align-middle text-center"><?= $row->supply_awal_total; ?></td>
                                                        <td class="table-danger align-middle text-center"><?= $row->supply_akhir_total; ?></td>
                                                        <td class="table-danger align-middle text-center"><?= $row->supply_total_total; ?></td>
                                                        <td class="table-warning align-middle text-center"><?= $row->asf_awal_total; ?></td>
                                                        <td class="table-warning align-middle text-center"><?= $row->asf_akhir_total; ?></td>
                                                        <td class="table-warning align-middle text-center"><?= $row->asf_total_total; ?></td>
                                                        <td class="table-danger align-middle text-center"><?= $row->soft_awal_total; ?></td>
                                                        <td class="table-danger align-middle text-center"><?= $row->soft_akhir_total; ?></td>
                                                        <td class="table-danger align-middle text-center"><?= $row->soft_total_total; ?></td>
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