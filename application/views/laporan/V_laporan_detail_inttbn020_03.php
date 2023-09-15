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
                                    <td style="text-align:left; font-weight: bold;">DOK.</td>
                                    <td style="text-align:left; font-weight: bold;">: <?php echo $docno; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left; font-weight: bold;">TGL.</td>
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

                    <div class="card-body">
                        <?php $this->load->view('template/V_onprocess'); ?>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <?php
                                            $this->model = $this->{'M_form' . $frmkd . '_' . $frmvrs};
                                            $bulan = $this->model->get_tanggal_indo(date('Y-m-', strtotime($create_date)));
                                            ?>
                                            <?php
                                            // $bulan = date("M Y", strtotime($create_date));
                                            ?>
                                            <tr>
                                                <th class="table-primary align-middle text-center" rowspan="2">No</th>
                                                <th class="table-primary align-middle text-center" rowspan="2">ITEM BAHAN KIMIA</th>
                                                <th class="table-primary align-middle text-center" rowspan="2">Satuan</th>
                                                <th class="table-primary align-middle text-center" rowspan="2">Stock Awal</th>
                                                <th class="table-primary align-middle text-center" colspan="6">HARI INI</th>
                                                <th class="table-primary align-middle text-center" rowspan="2">Minimum Stock</th>
                                                <th class="table-primary align-middle text-center" rowspan="2">STOCK AKHIR</th>
                                                <th class="table-primary align-middle text-center bulan" rowspan="2">Pemakaian Rata-Rata <?= $bulan; ?></th>
                                                <th class="table-primary align-middle text-center" rowspan="2">Pemakaian Rata-Rata Perhari</th>
                                                <th class="table-primary align-middle text-center" rowspan="2">Outstanding <br> PPB</th>
                                                <th class="table-primary align-middle text-center" rowspan="2">KET</th>
                                            </tr>
                                            <tr>
                                                <th class="table-primary align-middle text-center">TERIMA</th>
                                                <th class="table-primary align-middle text-center">Akum</th>
                                                <th class="table-primary align-middle text-center">PAKAI</th>
                                                <th class="table-primary align-middle text-center">Akum</th>
                                                <th class="table-primary align-middle text-center">KIRIM</th>
                                                <th class="table-primary align-middle text-center">Akum</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            <?php if (isset($dtdetail)) {
                                                $no = 1;
                                                foreach ($dtdetail as $row) { ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td style="text-align: left;"><?= $row->item_kimia ?></td>
                                                        <td style="text-align: center;"><?= $row->satuan ?></td>
                                                        <td style="text-align: center;"><?= $row->stock_awal ?></td>
                                                        <td style="text-align: center;"><?= $row->terima ?></td>
                                                        <td style="text-align: center;"><?= $row->terima_akum ?></td>
                                                        <td style="text-align: center;"><?= $row->pakai ?></td>
                                                        <td style="text-align: center;"><?= $row->pakai_akum ?></td>
                                                        <td style="text-align: center;"><?= $row->kirim ?></td>
                                                        <td style="text-align: center;"><?= $row->kirim_akum ?></td>
                                                        <td style="text-align: center;"><?= $row->minimum_stock ?></td>
                                                        <td style="text-align: center;"><?= $row->stock_akhir ?></td>
                                                        <td style="text-align: center;"><?= $row->ratarata_perbulan ?></td>
                                                        <td style="text-align: center;"><?= $row->ratarata_perhari ?></td>
                                                        <td style="text-align: center;"><?= $row->outstanding_ppb ?></td>
                                                        <td style="text-align: center;"><?= $row->keterangan ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <?php $this->load->view('laporan/V_laporan_definisi'); ?>
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