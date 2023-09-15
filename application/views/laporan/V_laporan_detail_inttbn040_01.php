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

    $create_date    = date("d-m-Y", strtotime($header->create_date));
    $docno          = $header->docno;
    $jam1_hdr       = $header->jam1_hdr;
    $jam2_hdr       = $header->jam2_hdr;
    $jam3_hdr       = $header->jam3_hdr;
    $jam4_hdr       = $header->jam4_hdr;
    $jam5_hdr       = $header->jam5_hdr;
    $jam6_hdr       = $header->jam6_hdr;
    $jam7_hdr       = $header->jam7_hdr;
    $jam8_hdr       = $header->jam8_hdr;
    $jam9_hdr       = $header->jam9_hdr;
    $jam10_hdr      = $header->jam10_hdr;
    $jam11_hdr      = $header->jam11_hdr;
    $jam12_hdr      = $header->jam12_hdr;
    $jam13_hdr      = $header->jam13_hdr;
    $jam14_hdr      = $header->jam14_hdr;
    $jam15_hdr      = $header->jam15_hdr;
    $jam16_hdr      = $header->jam16_hdr;
    $jam17_hdr      = $header->jam17_hdr;
    $jam18_hdr      = $header->jam18_hdr;
    $jam19_hdr      = $header->jam19_hdr;
    $jam20_hdr      = $header->jam20_hdr;
    $jam21_hdr      = $header->jam21_hdr;
    $jam22_hdr      = $header->jam22_hdr;
    $jam23_hdr      = $header->jam23_hdr;
    $jam24_hdr      = $header->jam24_hdr;
    $jam25_hdr      = $header->jam25_hdr;
    $jam26_hdr      = $header->jam26_hdr;
    $jam27_hdr      = $header->jam27_hdr;
    $jam28_hdr      = $header->jam28_hdr;
    $jam29_hdr      = $header->jam29_hdr;
    $jam30_hdr      = $header->jam30_hdr;
    $jam31_hdr      = $header->jam31_hdr;
    $jam32_hdr      = $header->jam32_hdr;
    $jam33_hdr      = $header->jam33_hdr;
    $jam34_hdr      = $header->jam34_hdr;
    $total_soft     = $header->total_soft;
    $total_pro      = $header->total_pro;
    $total_feed     = $header->total_feed;
    $total_product  = $header->total_product;
    $total_reject   = $header->total_reject;
    $keterangan_hdr = $header->keterangan_hdr;
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
                    <?php //$this->load->view('template/V_onprocess'); 
                    ?>

                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5>KONTROL PARAMETER OPERASIONAL MESIN REVERSE OSMOSIS 40 m3 / jam</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-primary align-middle text-center" rowspan="3">NAMA MESIN</th>
                                                <th class="table-primary align-middle text-center" rowspan="3">KODE</th>
                                                <th class="table-primary align-middle text-center" rowspan="3">PARAMETER</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="34">OPERASI (JAM)</th>
                                            </tr>
                                            <tr>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam1_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam2_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam3_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam4_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam5_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam6_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam7_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam8_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam9_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam10_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam11_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam12_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam13_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam14_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam15_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam16_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam17_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam18_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam19_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam20_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam21_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam22_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam23_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam24_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam25_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam26_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam27_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam28_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam29_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam30_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam31_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam32_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam33_hdr; ?></th>
                                                <th class="table-primary align-middle text-center w-auto"><?= $jam34_hdr; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody4">
                                            <?php
                                                foreach ($dtdetaild as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->nama_mesin; ?></td>
                                                        <td><?php echo $row->kode_mesin; ?></td>
                                                        <td><?php echo $row->parameter; ?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr1;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr2;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr3;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr4;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr5;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr6;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr7;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr8;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr9;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr10;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr11;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr12;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr13;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr14;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr15;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr16;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr17;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr18;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr19;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr20;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr21;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr22;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr23;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr24;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr25;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr26;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr27;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr28;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr29;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr30;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr31;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr32;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr33;?></td>
                                                        <td class="align-middle text-center"><?= $row->dtl_opr34;?></td>
                                                    </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-primary align-middle text-center" colspan="37" align="center">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-success align-middle text-center" colspan="1"><h4><b>FLOW METER</b></h4></th>
                                                <th class="table-success align-middle text-center" colspan="3"><h4><b>SOFTENER</b></h4></th>
                                                <th class="table-success align-middle text-center" colspan="3"><h4><b>PROSES DEMIN ( RO, AST)</b></h4></th>
                                            </tr>
                                            <tr>
                                                <th class="table-success align-middle text-center">SHIFT</th>
                                                <th class="table-success align-middle text-center">AWAL</th>
                                                <th class="table-success align-middle text-center">AKHIR</th>
                                                <th class="table-success align-middle text-center">TOTAL</th>
                                                <th class="table-success align-middle text-center">AWAL</th>
                                                <th class="table-success align-middle text-center">AKHIR</th>
                                                <th class="table-success align-middle text-center">TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody5">
                                            <?php
                                                foreach ($dtdetaile as $row2) { ?>
                                                    <tr>
                                                        <td class="align-middle text-center"><?= $row2->shift_e; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->soft_awal; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->soft_akhir; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->soft_total; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->pro_awal; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->pro_akhir; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->pro_total; ?></td>
                                                    </tr>
                                                <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-success align-middle text-center" align="center">TOTAL</td>
                                                <td class="table-success align-middle text-center" colspan="2" align="center"></td>
                                                <td class="table-success align-middle text-center"> <?= $total_soft; ?> </td>
                                                <td class="table-success align-middle text-center" colspan="2" align="center"></td>
                                                <td class="table-success align-middle text-center"> <?= $total_pro; ?> </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-danger align-middle text-center" colspan="1" rowspan="1"><h4><b>PROSES PRODUKSI</b></h4></th>
                                                <th class="table-danger align-middle text-center" colspan="1" rowspan="3"><h4><b>NO.POMPA</b></h4></th>
                                                <th class="table-danger align-middle text-center" colspan="3" rowspan="1"><h4><b>SOFTENER (FEED WATER)</b></h4></th>
                                                <th class="table-danger align-middle text-center" colspan="3" rowspan="1"><h4><b>PERMEATE ( PRODUCT )</b></h4></th>
                                                <th class="table-danger align-middle text-center" colspan="3" rowspan="1"><h4><b>CONSENTRATE ( REJECT)</b></h4></th>
                                            </tr>
                                            <tr>
                                                <th class="table-danger align-middle text-center">SHIFT</th>
                                                <th class="table-danger align-middle text-center">AWAL</th>
                                                <th class="table-danger align-middle text-center">AKHIR</th>
                                                <th class="table-danger align-middle text-center">Total (m3)</th>
                                                <th class="table-danger align-middle text-center">Flow (m3)</th>
                                                <th class="table-danger align-middle text-center">Waktu ( jam )</th>
                                                <th class="table-danger align-middle text-center">Total (m3)</th>
                                                <th class="table-danger align-middle text-center">Flow (m3)</th>
                                                <th class="table-danger align-middle text-center">Waktu ( jam )</th>
                                                <th class="table-danger align-middle text-center">Total (m3)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody6">
                                            <?php foreach ($dtdetailf as $row2) { ?>
                                                    <tr>
                                                        <td class="align-middle text-center"><?= $row2->shift_f; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->no_pompa; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->feed_awal; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->feed_akhir; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->feed_total; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->product_flow; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->product_waktu; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->product_total; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->reject_flow; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->reject_waktu; ?></td>
                                                        <td class="align-middle text-center"><?= $row2->reject_total; ?></td>
                                                    </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-danger align-middle text-center" align="center">TOTAL</td>
                                                <td class="table-danger align-middle text-center" colspan="3" align="center"></td>
                                                <td class="table-danger align-middle text-center"> <?= $total_feed; ?></td>
                                                <td class="table-danger align-middle text-center" colspan="2" align="center"></td>
                                                <td class="table-danger align-middle text-center"> <?= $total_product; ?></td>
                                                <td class="table-danger align-middle text-center" colspan="2" align="center"></td>
                                                <td class="table-danger align-middle text-center"> <?= $total_reject; ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                <!-- <div class="table-responsive table-scrolled"  style="max-height: 400px;"> -->
                                    <table class="table table-striped table-bordered">
                                    <thead>
                                            <tr>
                                                <th class="table-info align-middle text-center" colspan="1" rowspan="4"><h4><b>#</b></h4></th>
                                                <th class="table-info align-middle text-center" colspan="1" rowspan="4"><h4><b>WAKTU</b></h4></th>
                                                <th class="table-info align-middle text-center" colspan="1" rowspan="4"><h4><b>Start Stop</b></h4></th>
                                                <th class="table-info align-middle text-center" colspan="6" rowspan="1"><h4><b>FEED WATER ( SOFTENER )</b></h4></th>
                                                <th class="table-info align-middle text-center" colspan="2" rowspan="1"><h4><b>PERMEATE ( PRODUCT )</b></h4></th>
                                            </tr>
                                            <tr>
                                                <th class="table-info align-middle text-center">pH</th>
                                                <th class="table-info align-middle text-center">Konduktivity</th>
                                                <th class="table-info align-middle text-center">TH</th>
                                                <th class="table-info align-middle text-center">Turbidity</th>
                                                <th class="table-info align-middle text-center">Cl-</th>
                                                <th class="table-info align-middle text-center">FCl</th>
                                                <th class="table-info align-middle text-center">pH</th>
                                                <th class="table-info align-middle text-center">Konduktivity (µs/cm)</th>
                                            </tr>
                                            <tr>
                                                <th class="table-info align-middle text-center">6,5 - 8,5</th>
                                                <th class="table-info align-middle text-center">µs/cm</th>
                                                <th class="table-info align-middle text-center">µmol/L</th>
                                                <th class="table-info align-middle text-center">NTU</th>
                                                <th class="table-info align-middle text-center">ppm</th>
                                                <th class="table-info align-middle text-center">ppm</th>
                                                <th class="table-info align-middle text-center">6,5 - 8,5</th>
                                                <th class="table-info align-middle text-center">< 40</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody7">
                                            <?php
                                                foreach ($dtdetailg as $row3) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td class="align-middle text-center"><?= $row3->jam_waktu; ?></td>
                                                        <td class="align-middle text-center"><?= $row3->start_stop; ?></td>
                                                        <td class="align-middle text-center"><?= $row3->feed_ph; ?></td>
                                                        <td class="align-middle text-center"><?= $row3->feed_konduktivity; ?></td>
                                                        <td class="align-middle text-center"><?= $row3->feed_th; ?></td>
                                                        <td class="align-middle text-center"><?= $row3->feed_turbidity; ?></td>
                                                        <td class="align-middle text-center"><?= $row3->feed_cl; ?></td>
                                                        <td class="align-middle text-center"><?= $row3->feed_fcl; ?></td>
                                                        <td class="align-middle text-center"><?= $row3->product_ph; ?></td>
                                                        <td class="align-middle text-center"><?= $row3->product_konduktivity; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-info align-middle text-center" colspan="11" align="center">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-info">
                                        <tbody><tr>
                                            <th>Keterangan :</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <!-- <textarea name="keterangan_hdr" id="keterangan_hdr" class="form-control keterangan_hdr" cols="30" rows="10" style="height: 171px;"></textarea> -->
                                                <textarea type="text" name="keterangan_hdr" id="keterangan_hdr" class="form-control keterangan_hdr dtopen_blok" cols="30" rows="10" style="height: 171px;" value="<?= $keterangan_hdr; ?>" readonly><?= $keterangan_hdr; ?></textarea>
                                            </td>
                                        </tr><tr>
                                    </tr></tbody></table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h5>HASIL ANALISA PH SELAMA CIP</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-primary align-middle text-center">No</th>
                                                <th class="table-primary align-middle text-center">Waktu</th>
                                                <th class="table-primary align-middle text-center">Pressure</th>
                                                <th class="table-primary align-middle text-center">H-566 (pH 10-13)</th>
                                                <th class="table-primary align-middle text-center">Waktu</th>
                                                <th class="table-primary align-middle text-center">Pressure</th>
                                                <th class="table-primary align-middle text-center">pH bilas ≤ 10</th>
                                                <th class="table-primary align-middle text-center">Waktu</th>
                                                <th class="table-primary align-middle text-center">Pressure</th>
                                                <th class="table-primary align-middle text-center">H- 277 (pH 1-4 )</th>
                                                <th class="table-primary align-middle text-center">Waktu</th>
                                                <th class="table-primary align-middle text-center">Pressure</th>
                                                <th class="table-primary align-middle text-center">pH bilas (≥ 6,5)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody1">
                                            <?php
                                            $no = 1; 
                                            foreach ($dtdetail as $row) { ?>
                                                    <tr>
                                                        <td class="align-middle text-center"><?= $no++ ?></td>
                                                        <td class="align-middle text-center"><?= $row->jam1 ?></td>
                                                        <td class="align-middle text-center"><?= $row->pressure_1 ?></td>
                                                        <td class="align-middle text-center"><?= $row->h566 ?></td>
                                                        <td class="align-middle text-center"><?= $row->jam2 ?></td>
                                                        <td class="align-middle text-center"><?= $row->pressure2 ?></td>
                                                        <td class="align-middle text-center"><?= $row->ph_bilas ?></td>
                                                        <td class="align-middle text-center"><?= $row->jam3 ?></td>
                                                        <td class="align-middle text-center"><?= $row->pressure3 ?></td>
                                                        <td class="align-middle text-center"><?= $row->h277 ?></td>
                                                        <td class="align-middle text-center"><?= $row->jam4 ?></td>
                                                        <td class="align-middle text-center"><?= $row->pressure4 ?></td>
                                                        <td class="align-middle text-center"><?= $row->ph_bilas4 ?></td>
                                                    </tr>
                                                <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-primary align-middle text-center" colspan="13" align="center">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <h5>TABLE FLOW</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-success align-middle text-center">No</th>
                                                <th class="table-success align-middle text-center">Flow Awal</th>
                                                <th class="table-success align-middle text-center">Flow Akhir</th>
                                                <th class="table-success align-middle text-center">Total</th>
                                                <th class="table-success align-middle text-center">Formula</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody1">
                                            <?php
                                            $no = 1; 
                                            foreach ($dtdetailb as $rowb) { ?>
                                                    <tr>
                                                        <td class="align-middle text-center"><?= $no++ ?></td>
                                                        <td class="align-middle text-center"><?= $rowb->flow_awal ?></td>
                                                        <td class="align-middle text-center"><?= $rowb->flow_akhir ?></td>
                                                        <td class="align-middle text-center"><?= $rowb->total ?></td>
                                                        <td class="align-middle text-center"><?= $rowb->formula ?></td>
                                                    </tr>
                                                <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-success align-middle text-center" colspan="10" align="center">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-8">
                                <h5>CATATAN KETIDAKSESUAIAN</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-danger align-middle text-center">#</th>
                                                <th class="table-danger align-middle text-center">Jam</th>
                                                <th class="table-danger align-middle text-center">Uraian Ketidaksesuaian</th>
                                                <th class="table-danger align-middle text-center">Tindakan Perbaikan</th>
                                                <th class="table-danger align-middle text-center">Nama</th>
                                                <th class="table-danger align-middle text-center">Paraf</th>
                                                <th class="table-danger align-middle text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody1">
                                            <?php
                                            $no = 1; 
                                            if(isset($dtdetailc)){
                                                foreach ($dtdetailc as $rowc) { ?>
                                                    <tr>
                                                        <td class="align-middle text-center"><?= $no++ ?></td>
                                                        <td class="align-middle text-center"><?= $rowc->jam ?></td>
                                                        <td class="align-middle text-center"><?= $rowc->uraian ?></td>
                                                        <td class="align-middle text-center"><?= $rowc->tindakan ?></td>
                                                        <td class="align-middle text-center"><?= $rowc->nama ?></td>
                                                        <td class="align-middle text-center"><?= $rowc->paraf ?></td>
                                                        <td class="align-middle text-center"><?= $rowc->keterangan ?></td>
                                                    </tr>
                                                    <?php } 
                                                    } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-danger align-middle text-center" colspan="10" align="center">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
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