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
    $kode           = $header->kode;
    $kode_name      = $header->kode_name;
    $bulan          = $header->bulan;
}

    // $bulan = explode('-',$periode)[0];
    if ($bulan == 1) {
        $NamaBulan = "Januari";
    } else if ($bulan == 2) {
        $NamaBulan = "Februari";
    } else if ($bulan == 3) {
        $NamaBulan = "Maret";
    } else if ($bulan == 5) {
        $NamaBulan = "April";
    } else if ($bulan == 5) {
        $NamaBulan = "Mei";
    } else if ($bulan == 6) {
        $NamaBulan = "Juni";
    } else if ($bulan == 7) {
        $NamaBulan = "Juli";
    } else if ($bulan == 8) {
        $NamaBulan = "Agustus";
    } else if ($bulan == 9) {
        $NamaBulan = "September";
    } else if ($bulan == 10) {
        $NamaBulan = "Oktober";
    } else if ($bulan == 11) {
        $NamaBulan = "November";
    } else if ($bulan == 12) {
        $NamaBulan = "Desember";
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
                                    <td style="text-align:left; font-weight: bold;">Dept. </td>
                                    <td style="text-align:left; font-weight: bold;">: <?= "WTD"; ?> </td>
                                </tr>
                                <tr>
                                    <td style="text-align:left; font-weight: bold;">Tanggal Laporan </td>
                                    <td style="text-align:left; font-weight: bold;">: <?= $create_date; ?> </td>
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
                    <?php $this->load->view('template/V_onprocess');?>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive scrolly_table" style="max-height: 600px;">
                                    <table class="table table-bordered sticky-header">
                                        <thead style="position:sticky;top: 0; z-index: 1;">
                                            <tr>
                                                <th class="table-info align-middle text-center" rowspan="2">No</th>
                                                <th class="table-info align-middle text-center" rowspan="2">Nama / Bagian</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="<?= count($date_calender);?>">Tanggal</th>
                                                <th class="table-info align-middle text-center" rowspan="2">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <?php if(isset($date_calender)){
                                                    foreach ($date_calender as $date_calender_row) { ?>
                                                        <th class="table-info align-middle text-center"><?= $date_calender_row->day ?></th>
                                                <?php } } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($dtdetail)){ 
                                                $no = 1;
                                                foreach ($dtdetail as $dtdetail_row) { 
                                                    if($dtdetail_row->nama_bagian == 'Nama Petugas'){ ?>
                                                    <tr>
                                                        <th class="fixed freeze_horizontal" style="background-color:white;z-index:0;" align="center"></th>
                                                        <th class="fixed freeze_horizontal" style="background-color:white;z-index:0;" align="center"><?= $dtdetail_row->nama_bagian ?></th>
                                                    <?php if(isset($date_calender)){
                                                        $no2 = 0;
                                                        foreach ($date_calender as $date_calender_row) { $no2++; ?>
                                                            <th align="center"><?= $dtdetail_row->{'day'.$no2} ?></th>
                                                    <?php } } ?>
                                                        <th align="center"><?= $dtdetail_row->ket ?></th>
                                                    </tr>
                                                <?php }else{ ?>
                                                    <tr>
                                                        <td class="fixed freeze_horizontal" style="background-color:white;z-index:0;" align="center"><?= $no++; ?></td>
                                                        <td class="fixed freeze_horizontal" style="background-color:white;z-index:0;" align="center"><?= $dtdetail_row->nama_bagian ?></td>
                                                    <?php if(isset($date_calender)){
                                                        $no2 = 0;
                                                        foreach ($date_calender as $date_calender_row) { $no2++; ?>
                                                            <td align="center">
                                                                <?php if($dtdetail_row->{'day'.$no2} == '0'){
                                                                    echo "✔";
                                                                }elseif($dtdetail_row->{'day'.$no2} == '1'){
                                                                    echo "✖";
                                                                }elseif($dtdetail_row->{'day'.$no2} == '2'){
                                                                    echo "Δ";
                                                                }elseif($dtdetail_row->{'day'.$no2} == '3'){
                                                                    echo "NA";
                                                                } ?>
                                                            </td>
                                                    <?php } } ?>
                                                        <td align="center"><?= $dtdetail_row->ket ?></td>
                                                    </tr>
                                                <?php } ?>
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