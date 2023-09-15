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
    $headerid                   = $header->headerid;

    $comment                    = $header->comment;
    $comment_by                 = $header->comment_by;
    $comment_time               = $header->comment_time;
    $comment_date               = date("d-m-Y", strtotime($header->comment_date));

    $create_date                = date("d-m-Y", strtotime($header->create_date));
    $docno                      = $header->docno;

    $selisih_opname             = $header->selisih_opname;
    $total_dtlb_penerimaan_kg   = $header->total_dtlb_penerimaan_kg;
    $total_dtlb_penerimaan_akm  = $header->total_dtlb_penerimaan_akm;
    $total_dtlb_pemakaian_kg    = $header->total_dtlb_pemakaian_kg;
    $total_dtlb_pemakaian_akm   = $header->total_dtlb_pemakaian_akm;
    $stock_akhir_tmp            = $header->stock_akhir_tmp;

    $total_dtlc_total_jam       = $header->total_dtlc_total_jam;
    $total_dtlc_jam_akm         = $header->total_dtlc_jam_akm;
    $total_dtlc_tmpr_kg         = $header->total_dtlc_tmpr_kg;
    $total_dtlc_tmpr_akm        = $header->total_dtlc_tmpr_akm;
    $total_dtlc_steam_ton       = $header->total_dtlc_steam_ton;
    $total_dtlc_steam_akm       = $header->total_dtlc_steam_akm;
    $total_dtlc_total_air       = $header->total_dtlc_total_air;
    $total_dtlc_air_akm         = $header->total_dtlc_air_akm;
    
    $total_dtld_tmpr_kg         = $header->total_dtld_tmpr_kg;
    $total_dtld_tmpr_akm        = $header->total_dtld_tmpr_akm;
    $total_dtld_steam_ton       = $header->total_dtld_steam_ton;
    $total_dtld_steam_akm       = $header->total_dtld_steam_akm;
    $total_dtld_total_air       = $header->total_dtld_total_air;
    $total_dtld_air_akm         = $header->total_dtld_air_akm;

    $air_dearator               = $header->air_dearator;
    $air_wtd                    = $header->air_wtd;
    $air_condensate             = $header->air_condensate;
    $air_blr                    = $header->air_blr;
    $total_return               = $header->total_return;
    $prsn_air_wtd               = $header->prsn_air_wtd;
    $prsn_air_condensate        = $header->prsn_air_condensate;
    $prsn_air_blr               = $header->prsn_air_blr;
    $realisasi                  = $header->realisasi;
    $temp_bulan_lalu            = $header->temp_bulan_lalu;
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
                                            <!-- <th class="table-primary align-middle text-center" rowspan="3">#</th> -->
                                            <th class="table-primary align-middle text-center" rowspan="3">Operasional Boiler</th>
                                            <th class="table-primary align-middle text-center" rowspan="1" colspan="24">Tekanan Perjam</th>
                                            <th class="table-primary align-middle text-center" rowspan="3">Keterangan</th>
                                        </tr>
                                        <tr>
                                            <th class="table-primary align-middle text-center">07</th>
                                            <th class="table-primary align-middle text-center">08</th>
                                            <th class="table-primary align-middle text-center">09</th>
                                            <th class="table-primary align-middle text-center">10</th>
                                            <th class="table-primary align-middle text-center">11</th>
                                            <th class="table-primary align-middle text-center">12</th>
                                            <th class="table-primary align-middle text-center">13</th>
                                            <th class="table-primary align-middle text-center">14</th>
                                            <th class="table-primary align-middle text-center">15</th>
                                            <th class="table-primary align-middle text-center">16</th>
                                            <th class="table-primary align-middle text-center">17</th>
                                            <th class="table-primary align-middle text-center">18</th>
                                            <th class="table-primary align-middle text-center">19</th>
                                            <th class="table-primary align-middle text-center">20</th>
                                            <th class="table-primary align-middle text-center">21</th>
                                            <th class="table-primary align-middle text-center">22</th>
                                            <th class="table-primary align-middle text-center">23</th>
                                            <th class="table-primary align-middle text-center">24</th>
                                            <th class="table-primary align-middle text-center">01</th>
                                            <th class="table-primary align-middle text-center">02</th>
                                            <th class="table-primary align-middle text-center">03</th>
                                            <th class="table-primary align-middle text-center">04</th>
                                            <th class="table-primary align-middle text-center">05</th>
                                            <th class="table-primary align-middle text-center">06</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php $total_bawah = 0;
                                            if (!empty($dtdetail)) {
                                                foreach ($dtdetail as $row) { ?>
                                                    <tr>
                                                        <td style="text-align: center;"> <?php echo $row->boiler; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_07; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_08; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_09; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_10; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_11; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_12; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_13; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_14; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_15; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_16; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_17; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_18; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_19; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_20; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_21; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_22; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_23; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_24; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_01; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_02; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_03; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_04; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_05; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->tekanan_06; ?></td>
                                                        <td style="text-align: center;"> <?php echo $row->keterangan; ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-info" colspan="26"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- <div class="col-6">
                                </div> -->
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <!-- <th class="table-success align-middle text-center" rowspan="3">#</th> -->
                                                <th class="table-success align-middle text-center" rowspan="3">URAIAN</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="2">PENERIMAAN</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="2">PEMAKAIAN</th>
                                                <th class="table-success align-middle text-center" rowspan="3">STOCK TEMPURUNG (Kg)</th>
                                            </tr>
                                            <tr>
                                                <th class="table-success align-middle text-center">Kg</th>
                                                <th class="table-success align-middle text-center">Akumulatif</th>
                                                <th class="table-success align-middle text-center">Kg</th>
                                                <th class="table-success align-middle text-center">Akumulatif</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_b">
                                            <?php if (isset($dtdetail_b)) {
                                                foreach ($dtdetail_b as $row) { 
                                                    if ($row->dtlb_uraian === 'Kirim TPR') {
                                                        ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?= $row->dtlb_uraian ?></td>
                                                        <td class="table-success"></td>
                                                        <td class="table-success"></td>
                                                        <td style="text-align: center;"><?= $row->dtlb_pemakaian_kg ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlb_pemakaian_akm ?></td>
                                                        <td></td>
                                                    </tr>
                                            <?php
                                                } else { ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?= $row->dtlb_uraian ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlb_penerimaan_kg ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlb_penerimaan_akm ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlb_pemakaian_kg ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlb_pemakaian_akm ?></td>
                                                        <td></td>
                                                    </tr>
                                                <?php } } }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-success align-middle text-center"><strong>Selisih Opname</strong> </td>
                                                <td class="table-success" colspan="4"></td>
                                                <td class="table-warning" style="text-align: center;"><?= $selisih_opname; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="table-success align-middle text-center"><strong>TOTAL TPR</strong> </td>
                                                <td class="table-success" style="text-align: center;"><?= $total_dtlb_penerimaan_kg; ?></td>
                                                <td class="table-success" style="text-align: center;"><?= $total_dtlb_penerimaan_akm; ?></td>
                                                <td class="table-success" style="text-align: center;"><?= $total_dtlb_pemakaian_kg; ?></td>
                                                <td class="table-success" style="text-align: center;"><?= $total_dtlb_pemakaian_akm; ?></td>
                                                <td class="table-success" style="text-align: center;"><?= $stock_akhir_tmp; ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-success align-middle text-center" colspan="7">BAHAN KIMIA (Kg)</th>
                                            </tr>
                                            <tr>
                                                <th class="table-success align-middle text-center">URAIAN</th>
                                                <th class="table-success align-middle text-center">TERIMA</th>
                                                <th class="table-success align-middle text-center">PAKAI</th>
                                                <th class="table-success align-middle text-center">AKUMULATIF</th>
                                                <th class="table-success align-middle text-center">EFF (%)</th>
                                                <th class="table-success align-middle text-center">STOCK</th>
                                                <th class="table-success align-middle text-center">NO. DO</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_2b">
                                            <?php
                                            if(isset($dtdetail_b2)){
                                                foreach ($dtdetail_b2 as $row) { ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?= $row->dtlb2_uraian ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlb2_terima ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlb2_pakai ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlb2_akm ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlb2_eff ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlb2_stock ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlb2_nodo ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-success align-middle text-center" colspan="8"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>  

                        </br>
                        <div class="row">
                            <div class="col-9">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <!-- <th class="table-success align-middle text-center" rowspan="3">#</th> -->
                                                <th class="table-success align-middle text-center" rowspan="3">KODE BOILER</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="2">Jam Operasi</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="2">PEMAKAIAN TEMPURUNG</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="2">OUTPUT STEAM</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="2">PEMAKAIAN AIR</th>
                                            </tr>
                                            <tr>
                                                <th class="table-success align-middle text-center">Hari ini</th>
                                                <th class="table-success align-middle text-center">AKM</th>
                                                <th class="table-success align-middle text-center">Hari ini (Kg)</th>
                                                <th class="table-success align-middle text-center">Akumulatif</th>
                                                <th class="table-success align-middle text-center">Hari ini (Ton)</th>
                                                <th class="table-success align-middle text-center">Akumulatif</th>
                                                <th class="table-success align-middle text-center">Hari ini (㎥)</th>
                                                <th class="table-success align-middle text-center">Akumulatif</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_3">
                                          <?php if(isset($dtdetail_c)){
                                                foreach ($dtdetail_c as $row) { ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?= $row->dtlc_kode_boiler; ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlc_total_jam; ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlc_jam_akm; ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlc_tmpr_kg; ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlc_tmpr_akm; ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlc_steam_ton; ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlc_steam_akm; ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlc_total_air; ?></td>
                                                        <td style="text-align: center;"><?= $row->dtlc_air_akm; ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-success align-middle text-center"><strong>TOTAL</strong> :</td>
                                                <td class="table-success" style="text-align: center;"><?= $total_dtlc_total_jam; ?></td>
                                                <td class="table-success" style="text-align: center;"><?= $total_dtlc_jam_akm; ?></td>
                                                <td class="table-success" style="text-align: center;"><?= $total_dtlc_tmpr_kg; ?></td>
                                                <td class="table-success" style="text-align: center;"><?= $total_dtlc_tmpr_akm; ?></td>
                                                <td class="table-success" style="text-align: center;"><?= $total_dtlc_steam_ton; ?></td>
                                                <td class="table-success" style="text-align: center;"><?= $total_dtlc_steam_akm; ?></td>
                                                <td class="table-success" style="text-align: center;"><?= $total_dtlc_total_air; ?></td>
                                                <td class="table-success" style="text-align: center;"><?= $total_dtlc_air_akm; ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-3">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless">
                                                <tr>
                                                    <td colspan="3"><strong><h2>KETERANGAN</h2></strong></td colspan="3">
                                                </tr>
                                                <tr>
                                                    <td>Air Dearator</td>
                                                    <td><?= $air_dearator; ?></td>
                                                    <td>M3</td>
                                                </tr>
                                                <tr>
                                                    <tr>
                                                        <td></td>
                                                        <td style="text-align: center;">M3</td>
                                                        <td style="text-align: center;">%</td>
                                                    </tr>
                                                    <td>Air dari WTD</td>
                                                    <td><?= $air_wtd; ?></td>
                                                    <td><?= $prsn_air_wtd; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Air Condensate</td>
                                                    <td><?= $air_condensate; ?></td>
                                                    <td><?= $prsn_air_condensate; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Air utk BLR</td>
                                                    <td><?= $air_blr; ?></td>
                                                    <td><?= $prsn_air_blr; ?></td>
                                                </tr>
                                                <tr><td></td></tr>
                                                <tr>
                                                    <td><h3><strong>Return Condensate </strong></h3></td>
                                                    <td><?= $total_return; ?></td>
                                                    <td>M3</td>
                                                </tr>
                                            </table>
                                            <hr style="border: 0;height: 3px;background: #333;background-image: -webkit-linear-gradient(left, #ccc, #333, #ccc);background-image: -moz-linear-gradient(left, #ccc, #333, #ccc);background-image: -ms-linear-gradient(left, #ccc, #333, #ccc);background-image: -o-linear-gradient(left, #ccc, #333, #ccc);">
                                            <table class="table table-striped table-borderless">
                                                <tr>
                                                    <td>Tempurung (Kg/Jam) = Max 900</td>
                                                    <td>Realisasi =</td>
                                                    <td><?= $realisasi; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tempurung (Kg/Jam) Bulan Sept  =</td>
                                                    <td><?= $temp_bulan_lalu; ?></td>
                                                </tr>
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
                                                <th class="table-danger align-middle text-center" rowspan="3">Uraian</th>
                                                <th class="table-danger align-middle text-center" rowspan="1">Jam</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="2">PEMAKAIAN TEMPURUNG</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="2">PEMAKAIAN STEAM</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="2">PEMAKAIAN AIR</th>
                                            </tr>
                                            <tr>
                                                <th class="table-danger align-middle text-center">Hari ini</th>
                                                <th class="table-danger align-middle text-center">Hari ini (Kg)</th>
                                                <th class="table-danger align-middle text-center">Akumulatif</th>
                                                <th class="table-danger align-middle text-center">Hari ini (Ton)</th>
                                                <th class="table-danger align-middle text-center">Akumulatif</th>
                                                <th class="table-danger align-middle text-center">Hari ini (㎥)</th>
                                                <th class="table-danger align-middle text-center">Akumulatif</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_4">
                                            <?php if(isset($dtdetail_d)){
                                                foreach ($dtdetail_d as $row) { 
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: center;"> <?= $row->dtld_uraian; ?></td>
                                                        <td style="text-align: center;"> <?= $row->dtld_total_jam; ?></td>
                                                        <td style="text-align: center;"> <?= $row->dtld_tmpr_kg; ?></td>
                                                        <td style="text-align: center;"> <?= $row->dtld_tmpr_akm; ?></td>
                                                        <td style="text-align: center;"> <?= $row->dtld_steam_ton; ?></td>
                                                        <td style="text-align: center;"> <?= $row->dtld_steam_akm; ?></td>
                                                        <td style="text-align: center;"> <?= $row->dtld_total_air; ?></td>
                                                        <td style="text-align: center;"> <?= $row->dtld_air_akm; ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-danger align-middle text-center" colspan="2"><strong>TOTAL</strong> :</td>
                                                <td class="table-danger" style="text-align: center;"> <?= $total_dtld_tmpr_kg; ?></td>
                                                <td class="table-danger" style="text-align: center;"> <?= $total_dtld_tmpr_akm; ?></td>
                                                <td class="table-danger" style="text-align: center;"> <?= $total_dtld_steam_ton; ?></td>
                                                <td class="table-danger" style="text-align: center;"> <?= $total_dtld_steam_akm; ?></td>
                                                <td class="table-danger" style="text-align: center;"> <?= $total_dtld_total_air; ?></td>
                                                <td class="table-danger" style="text-align: center;"> <?= $total_dtld_air_akm; ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>


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