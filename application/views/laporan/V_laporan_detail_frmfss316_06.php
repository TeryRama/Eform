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
                                <div class="table-responsive scrolly_table">
                                    <table class="table table-bordered sticky-header">
                                        <thead>
                                            <tr>
                                                <th class="table-info align-middle text-center">No All</th>
                                                <th class="table-info align-middle text-center">Supplay Air</th>
                                                <th class="table-info align-middle text-center">No</th>
                                                <th class="table-info align-middle text-center">Dept</th>
                                                <th class="table-info align-middle text-center">Nama Flow Meter</th>
                                                <th class="table-info align-middle text-center">FM Awal</th>
                                                <th class="table-info align-middle text-center">FM akhir</th>
                                                <th class="table-info align-middle text-center">Total</th>
                                                <th class="table-info align-middle text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total_bawah = 0;
                                            $no_all = 0;
                                            if (!empty($dtdetail)) {
                                                foreach ($dtdetail as $dtdetail_row) { $no_all++;
                                                    $total_bawah += $dtdetail_row->total; ?>
                                                    <tr>
                                                        <td align="center"><?= $no_all ?></td>
                                                        <?php if ($dtdetail_row->no_urut == '1') { ?>
                                                            <td align="center" rowspan="<?= $dtdetail_row->no_urut_desc ?>"><?= $dtdetail_row->nama_jenis_air ?></td>
                                                        <?php } 
                                                        if ($dtdetail_row->nama_jenis_air == "ASF" && $dtdetail_row->nama_departemen == "WTD" && $dtdetail_row->nama_flow == "WTD") {?>
                                                            <td align="center"><?= $dtdetail_row->no_urut ?></td>
                                                            <td align="center"><?= $dtdetail_row->nama_departemen ?></td>
                                                            <td align="center"><?= $dtdetail_row->nama_flow ?></td>
                                                            <td align="center"><?= $dtdetail_row->fm_awal ?></td>
                                                            <td align="center"><?= $dtdetail_row->fm_akhir ?></td>
                                                            <td align="center"><?= $dtdetail_row->total ?></td>
                                                            <td align="center"><?= $dtdetail_row->ket ?></td>
                                                        <?php }else{?>
                                                            <td align="center"><?= $dtdetail_row->no_urut ?></td>
                                                            <td align="center"><?= $dtdetail_row->nama_departemen ?></td>
                                                            <td align="center"><?= $dtdetail_row->nama_flow ?></td>
                                                            <td align="center"><?= $dtdetail_row->fm_awal ?></td>
                                                            <td align="center"><?= $dtdetail_row->fm_akhir ?></td>
                                                            <td align="center"><?= $dtdetail_row->total ?></td>
                                                            <td align="center"><?= $dtdetail_row->ket ?></td>
                                                       <?php  }?>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-info align-middle text-right" colspan="5" align="center">Total</td>
                                                <td class="table-info align-middle text-center" colspan="1" align="center"><?= $total_bawah ?></td>
                                                <td class="table-info align-middle text-center" colspan="1" align="center"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    </div>
                            <strong>Remark :</strong><br>
                                <textarea name="remark" id="remark" cols="50" rows="0" readonly><?= $remark ?></textarea>
                        </div>
                        <br>
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