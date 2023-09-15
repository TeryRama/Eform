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
    $dept           = $header->dept;
    $deptabbr       = $header->deptabbr;
    $minggu         = $header->minggu;
} 
$base_url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$fcpath2   = str_replace('utl/', '', FCPATH);
$style_ttd = 'style="width:130px; height:80px; background-size:100%;"';

$model = 'M_form' . $frmkd . '_' . $frmvrs;
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
                                    <td style="text-align:left; font-weight: bold;">: <?php echo $docno; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left; font-weight: bold;">Tanggal Laporan </td>
                                    <td style="text-align:left; font-weight: bold;">: <?php echo $create_date; ?> </td>
                                </tr>
                                <tr>
                                    <td style="text-align:left; font-weight: bold;">Minggu </td>
                                    <td style="text-align:left; font-weight: bold;">: <?php echo $minggu; ?> </td>
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
                    
                    <div class="col-12" align="left">
                        <td style="text-align:left; font-weight: bold;"><b>Departemen : <?= $deptabbr ?></b></td>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive scrolly_table">
                                    <table class="table table-bordered sticky-header">
                                        <thead>
                                            <tr>
                                                <th class="table-info align-middle text-center" rowspan="2">No</th>
                                                <th class="table-info align-middle text-center" rowspan="2">Point</th>
                                                <th class="table-info align-middle text-center" rowspan="2">Kode</th>
                                                <th class="table-info align-middle text-center" rowspan="2">Area</th>
                                                <th class="table-info align-middle text-center" rowspan="2">Temuan</th>
                                                <th class="table-info align-middle text-center" rowspan="2">Tindakan Koreksi</th>
                                                <th class="table-info align-middle text-center" colspan="2">Dilakukan oleh,</th>
                                                <th class="table-info align-middle text-center" colspan="2">Dicek oleh,</th>
                                                <th class="table-info align-middle text-center" colspan="3">Diverfikasi,</th>
                                            </tr>
                                            <tr>
                                                <th class="table-info align-middle text-center" colspan="1">Nama</th>
                                                <th class="table-info align-middle text-center" colspan="1">Ttd</th>
                                                <th class="table-info align-middle text-center" colspan="1">Nama</th>
                                                <th class="table-info align-middle text-center" colspan="1">Ttd</th>
                                                <th class="table-info align-middle text-center" colspan="1">Nama</th>
                                                <th class="table-info align-middle text-center" colspan="1">Ttd</th>
                                                <th class="table-info align-middle text-center" colspan="1">Gagal/Lulus*)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            if (!empty($dtdetail)) {
                                                foreach ($dtdetail as $dtdetail_row) { 
                                                    $arr_pj = array('dilakukan','dicek','verfikasi');
                                                    for ($i_pj=0; $i_pj < count($arr_pj); $i_pj++) { 
                                                        if (file_exists($fcpath2 . 'utl/assets/ttd/' . $dtdetail_row->{'pj_personalstatus_'.$arr_pj[$i_pj]} . '_' . $dtdetail_row->{'pj_personalid_'.$arr_pj[$i_pj]} . '.png')) {
                                                            ${'pj_ttd_'.$arr_pj[$i_pj]} = '<img src="' . $base_url2 . 'utl/assets/ttd/' . $dtdetail_row->{'pj_personalstatus_'.$arr_pj[$i_pj]} . '_' . $dtdetail_row->{'pj_personalid_'.$arr_pj[$i_pj]} . '.png" ' . $style_ttd . ' alt="">';
                                                        } else if (
                                                            $dtdetail_row->{'pj_personalstatus_'.$arr_pj[$i_pj]} == '1' && file_exists($fcpath2 . 'forviewfoto_pekerja/' . $dtdetail_row->{'pj_personalid_'.$arr_pj[$i_pj]} . '_0_0.png')
                                                        ) {
                                                            ${'pj_ttd_'.$arr_pj[$i_pj]} = '<img src="' . $base_url2 . 'forviewfoto_pekerja/' . $dtdetail_row->{'pj_personalid_'.$arr_pj[$i_pj]} . '_0_0.png" ' . $style_ttd . ' alt="">';
                                                        } else if (
                                                            $dtdetail_row->{'pj_personalstatus_'.$arr_pj[$i_pj]} == '2' && file_exists($fcpath2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row->{'pj_personalid_'.$arr_pj[$i_pj]} . '.png')
                                                        ) {
                                                            ${'pj_ttd_'.$arr_pj[$i_pj]} = '<img src="' . $base_url2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row->{'pj_personalid_'.$arr_pj[$i_pj]} . '.png" ' . $style_ttd . ' alt="">';
                                                        } else {
                                                            ${'pj_ttd_'.$arr_pj[$i_pj]} = '<img src="' . base_url('assets/images/approved.png') . '" width="85" height="85" background-size:100%;" alt="">';
                                                        }
                                                    }
                                                ?>
                                                <tr>
                                                    <td align="center"><?= $no++; ?></td>
                                                    <td align="left"><?= $this->$model->get_item_by($dtdetail_row->point)->item1; ?></td>
                                                    <td align="center"><?= $this->$model->get_item2_by($dtdetail_row->kode)->item2; ?></td>
                                                    <td align="center"><?= $dtdetail_row->area ?></td>
                                                    <td align="center"><?= $dtdetail_row->temuan ?></td>
                                                    <td align="center"><?= $dtdetail_row->tindakan_koreksi ?></td>
                                                    <td align="center"><?= $dtdetail_row->pj_nama_dilakukan ?></td>
                                                    <td align="center"><?= $pj_ttd_dilakukan ?></td>
                                                    <td align="center"><?= $dtdetail_row->pj_nama_dicek ?></td>
                                                    <td align="center"><?= $pj_ttd_dicek ?></td>
                                                    <td align="center"><?= $dtdetail_row->pj_nama_verfikasi ?></td>
                                                    <td align="center"><?= $pj_ttd_verfikasi ?></td>
                                                    <td align="center"><?= $dtdetail_row->gagal_lulus ?></td>
                                                </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-info align-middle text-right" colspan="13" align="center"></td>
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