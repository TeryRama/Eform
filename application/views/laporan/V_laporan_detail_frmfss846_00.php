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
    $rev            = $header->rev;
}

$base_url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$fcpath2   = str_replace('utl/', '', FCPATH);
$style_ttd = 'style="width:130px; height:80px; background-size:100%;"';
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
                                    <td style="text-align:left; font-weight: bold;">Rev. </td>
                                    <td style="text-align:left; font-weight: bold;">: <?= $rev; ?> </td>
                                </tr>
                                <tr>
                                    <td style="text-align:left; font-weight: bold;">Tanggal Laporan </td>
                                    <td style="text-align:left; font-weight: bold;">: <?= $create_date; ?> </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php $this->load->view('template/V_onprocess');?>
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
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive scrolly_table" style="max-height: 600px;">
                                    <table class="table table-bordered sticky-header">
                                        <thead style="position:sticky;top: 0; z-index: 1;">
                                            <tr>
                                                <th class="fixed freeze_horizontal table-info align-middle text-center" rowspan="6">No.</th>
                                                <th class="fixed freeze_horizontal table-info align-middle text-center" colspan="2">Waktu</th>
                                                <th class="fixed freeze_horizontal table-info align-middle text-center" colspan="<?= isset($dtitem_mesin) ? count($dtitem_mesin)*2+2 : '2' ?>">Temperatur ( °C ) dan Arus ( A ) Aktual</th>
                                                <th class="fixed freeze_horizontal table-info align-middle text-center" colspan="4">Kondisi</th>
                                                <th class="fixed freeze_horizontal table-info align-middle text-center" colspan="1" rowspan="5">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th class="fixed freeze_horizontal table-info align-middle text-center" rowspan="2">Tanggal</th>
                                                <th class="fixed freeze_horizontal table-info align-middle text-center" rowspan="2">Jam</th>
                                                <th class="fixed freeze_horizontal table-info align-middle text-center" colspan="2" rowspan="1">Kabel Induk</th>
                                                <?php if(isset($dtitem_mesin)){
                                                    foreach ($dtitem_mesin as $dtitem_mesinrow) { ?>
                                                    <th class="fixed freeze_horizontal table-info align-middle text-center" colspan="2" rowspan="1"><?= $dtitem_mesinrow->nama_komponen ?></th>
                                                <?php } } ?>
                                                <th class="table-info align-middle vertical_text" rowspan="5">Busbar</th>
                                                <th class="table-info align-middle vertical_text" rowspan="5">Ampere Meter</th>
                                                <th class="table-info align-middle vertical_text" rowspan="5">Volt Meter</th>
                                                <th class="table-info align-middle vertical_text" rowspan="5">Kebersihan</th>
                                            </tr>
                                            <tr>
                                                <th class="table-info align-middle text-center" rowspan="1">A</th>
                                                <th class="table-info align-middle text-center" rowspan="1">°C</th>
                                                <?php if(isset($dtitem_mesin)){
                                                    foreach ($dtitem_mesin as $dtitem_mesinrow) { ?>
                                                    <th class="table-info align-middle text-center" rowspan="1">A</th>
                                                    <th class="table-info align-middle text-center" rowspan="1">°C</th>
                                                <?php } } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($dtdetail)){
                                                    $no = 1;
                                                    foreach ($dtdetail as $dtdetail_row) { ?>
                                                        <tr>
                                                            <td align="center"><?= $no++; ?></td>
                                                            <td align="center"><?= date("d-m-Y", strtotime($dtdetail_row->waktu_tanggal)); ?></td>
                                                            <td align="center"><?= $dtdetail_row->waktu_jam; ?></td>
                                                            <td align="center"><?= $dtdetail_row->kabel_induk_a ?></td>
                                                            <td align="center"><?= $dtdetail_row->kabel_induk_c ?></td>
                                                            <?php if(isset($dtitem_mesin)){
                                                                foreach ($dtitem_mesin as $dtitem_mesin_key => $dtitem_mesinrow) { ?>
                                                                    <td align="center"><?= $dtdetail_row->{'kabel_induk_a'.($dtitem_mesin_key+1)} ?></td>
                                                                    <td align="center"><?= $dtdetail_row->{'kabel_induk_c'.($dtitem_mesin_key+1)} ?></td>
                                                            <?php } } ?>
                                                            <td align="center">
                                                                <?= $dtdetail_row->busbar == '0' ? "&#10004;" : ""; ?>
                                                                <?= $dtdetail_row->busbar == '1' ? "&#10006;" : ""; ?>
                                                                <?= $dtdetail_row->busbar == '2' ? "Δ" : ""; ?>
                                                                <?= $dtdetail_row->busbar == '3' ? "NA" : ""; ?>
                                                            </td>
                                                            <td align="center">
                                                                <?= $dtdetail_row->ampere_meter == '0' ? "&#10004;" : ""; ?>
                                                                <?= $dtdetail_row->ampere_meter == '1' ? "&#10006;" : ""; ?>
                                                                <?= $dtdetail_row->ampere_meter == '2' ? "Δ" : ""; ?>
                                                                <?= $dtdetail_row->ampere_meter == '3' ? "NA" : ""; ?>
                                                            </td>
                                                            <td align="center">
                                                                <?= $dtdetail_row->volt_meter == '0' ? "&#10004;" : ""; ?>
                                                                <?= $dtdetail_row->volt_meter == '1' ? "&#10006;" : ""; ?>
                                                                <?= $dtdetail_row->volt_meter == '2' ? "Δ" : ""; ?>
                                                                <?= $dtdetail_row->volt_meter == '3' ? "NA" : ""; ?>
                                                            </td>
                                                            <td align="center">
                                                                <?= $dtdetail_row->kebersihan == '0' ? "&#10004;" : ""; ?>
                                                                <?= $dtdetail_row->kebersihan == '1' ? "&#10006;" : ""; ?>
                                                                <?= $dtdetail_row->kebersihan == '2' ? "Δ" : ""; ?>
                                                                <?= $dtdetail_row->kebersihan == '3' ? "NA" : ""; ?>
                                                            </td>
                                                            <td align="center"><?= $dtdetail_row->ket; ?></td>
                                                        </tr>
                                                <?php } } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-info align-middle text-center" colspan="38" align="center"></td>
                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="col-6">
                                <?php $this->load->view('laporan/V_laporan_definisi'); ?>
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