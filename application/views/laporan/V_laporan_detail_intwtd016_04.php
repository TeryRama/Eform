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
    $rev            = $header->rev;
    $periode        = $header->periode;
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
                                                <th class="table-info align-middle text-center" rowspan="2">Nama</th>
                                                <th class="table-info align-middle text-center" rowspan="2">Kode</th>
                                                <th class="table-info align-middle text-center" rowspan="2">Frequency</th>
                                                <th class="table-info align-middle text-center" rowspan="2">PIC</th>
                                                <th class="table-info align-middle text-center" rowspan="1">SCH</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="<?= count($date_calender);?>">Tanggal</th>
                                                <th class="table-info align-middle text-center" rowspan="2">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th class="table-info align-middle text-center">ACH</th>
                                                <?php if(isset($date_calender)){
                                                    foreach ($date_calender as $date_calender_row) { ?>
                                                        <th class="table-info align-middle text-center"><?= $date_calender_row->day ?></th>
                                                <?php } } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($dtdetail_b)){
                                                    $no = 1;
                                                    foreach ($dtdetail_b as $dtdetail_b_row) { 
                                                        $vnama_point = $dtdetail_b_row->no_urut == 1 ? '<td align="center" rowspan="' . ($dtdetail_b_row->no_urut_desc*2) . '">'.$no++.'</td><td align="left" rowspan="' . ($dtdetail_b_row->no_urut_desc*2) . '">' . $dtdetail_b_row->v_point . '</td>' : ''; ?>
                                                        <tr>
                                                            <?= $vnama_point ?>
                                                            <td align="center" rowspan="2"><?= $dtdetail_b_row->v_kode ?></td>
                                                            <td align="center" rowspan="2"><?= $dtdetail_b_row->frequency ?></td>
                                                            <td align="center" rowspan="2"><?= $dtdetail_b_row->v_pic ?></td>
                                                            <td align="center">SCH</td>
                                                    
                                                            <?php if(isset($dtdetail_b_row->children)){
                                                                foreach ($dtdetail_b_row->children as $child_row) { ?>
                                                                    <td align="center"
                                                                        <?php if(isset($child_row->children3)){
                                                                            foreach ($child_row->children3 as $child3_row) {
                                                                                if($child3_row->tgl_schedule != NULL){
                                                                                    $tgl_schedule = explode(',',$child3_row->tgl_schedule);
                                                                                    foreach ($tgl_schedule as $tgl_schedule_row) {
                                                                                        if($tgl_schedule_row == $child_row->date){
                                                                                            echo 'class="bg-gradient-info"';
                                                                                        }else{
                                                                                            echo "";
                                                                                        }
                                                                                    }
                                                                                }
                                                                            } 
                                                                        } ?>
                                                                    ></td>
                                                            <?php }
                                                            } ?>
                                                            <td align="center"><?= $dtdetail_b_row->ket ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center">ACH</td>
                                                            <?php if(isset($dtdetail_b_row->children)){
                                                                foreach ($dtdetail_b_row->children as $child_row) { ?>
                                                                    <td align="center">
                                                                        <?php if(isset($child_row->children2)){
                                                                            foreach ($child_row->children2 as $child2_row) {
                                                                                if($child2_row->gagal_lulus == "Lulus"){
                                                                                    echo '&#10004;';
                                                                                }else{
                                                                                    echo "";
                                                                                }
                                                                            } 
                                                                        } ?>
                                                                    </td>
                                                            <?php }
                                                            } ?>
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
                            <div class="col-12 mb-3">
                                <b>
                                    <p style="text-align:center">Catatan KetidakSesuaian</p>
                                </b>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-danger align-middle text-center"></th>
                                                <th class="table-danger align-middle text-center">Tanggal</th>
                                                <th class="table-danger align-middle text-center">Jam</th>
                                                <th class="table-danger align-middle text-center">Uraian ketidaksesuaian</th>
                                                <th class="table-danger align-middle text-center">Tindakan Perbaikan</th>
                                                <th class="table-danger align-middle text-center">Nama</th>
                                                <th class="table-danger align-middle text-center">TTD/ Paraf</th>
                                                <th class="table-danger align-middle text-center">Ket</th>
                                            </tr>
                                            <tr>

                                            </tr>
                                        </thead>
                                        <tbody id="tbody2">
                                            <?php if(isset($dtdetail)){
                                            $no2 = 1;
                                            foreach ($dtdetail as $dtdetail_row4) {
                                                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $dtdetail_row4->pj_personalstatus . '_' . $dtdetail_row4->pj_personalid . '.png')) {
                                                    $pj_ttd = '<img src="' . $base_url2 . 'utl/assets/ttd/' . $dtdetail_row4->pj_personalstatus . '_' . $dtdetail_row4->pj_personalid . '.png" ' . $style_ttd . ' alt="">';
                                                } else if (
                                                    $dtdetail_row4->pj_personalstatus == '1' && file_exists($fcpath2 . 'forviewfoto_pekerja/' . $dtdetail_row4->pj_personalid . '_0_0.png')
                                                ) {
                                                    $pj_ttd = '<img src="' . $base_url2 . 'forviewfoto_pekerja/' . $dtdetail_row4->pj_personalid . '_0_0.png" ' . $style_ttd . ' alt="">';
                                                } else if (
                                                    $dtdetail_row4->pj_personalstatus == '2' && file_exists($fcpath2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row4->pj_personalid . '.png')
                                                ) {
                                                    $pj_ttd = '<img src="' . $base_url2 . 'forviewfoto_pekerja/TTD_TK/' . $dtdetail_row4->pj_personalid . '.png" ' . $style_ttd . ' alt="">';
                                                } else {
                                                    $pj_ttd = '';
                                                } ?>
                                                <tr>
                                                    <td align="center"><?= $no2++ ?></td>
                                                    <td align="center"><?= date('d-m-Y',strtotime($dtdetail_row4->tanggal)) == '01-01-1970' ? '' : date('d-m-Y',strtotime($dtdetail_row4->tanggal)); ?></td>
                                                    <td align="center"><?= $dtdetail_row4->jam ?></td>
                                                    <td><?= $dtdetail_row4->uraian ?></td>
                                                    <td><?= $dtdetail_row4->tindakan ?></td>
                                                    <td align="center">
                                                        <?= $dtdetail_row4->pj_nama ?></td>
                                                    <td align="center"><?= $pj_ttd ?></td>
                                                    <td><?= $dtdetail_row4->keterangan ?></td>
                                                </tr>
                                            <?php }
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