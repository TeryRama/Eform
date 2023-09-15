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
                            <strong>A. Catatan KWH Generator</strong>
                                <!-- Tabel E ditarik dari form 009 -->
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                    <thead>
                                                    <tr>
                                                        <!-- <th class="table-danger align-middle text-center" rowspan="1" colspan="1" style="position: sticky;left: 0;top: auto;">No.</th> -->
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">GENERATOR</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">SHIFT</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">READ CT</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">PUTARAN</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">KWH</th>
                                                        <th class="table-danger align-middle text-center" rowspan="1" colspan="1">AKUMULATIF</th>
                                                    </tr>
                                                </thead>
                                                    <tbody id="tbody_dtl_e">
                                                        <?php if (isset($dtdetail_e)) { ?>
                                                            <?php foreach ($dtdetail_e as $dtdetail_e_row) {  ?>
                                                                <tr>
                                                                    <?php if ($dtdetail_e_row->nourut == '1') { ?>
                                                                        <td class="table-danger align-middle text-center" rowspan="<?= $dtdetail_e_row->nourutdesc ?>"><?= $dtdetail_e_row->generator ?></td>
                                                                    <?php  } ?>
                                                                    <td align="center"><?= $dtdetail_e_row->shift; ?></td>
                                                                    <td align="center"><?= $dtdetail_e_row->read_ct; ?></td>
                                                                    <td align="center"><?= $dtdetail_e_row->putaran; ?></td>
                                                                    <td align="center"><?= $dtdetail_e_row->kwh_nilai; ?></td>
                                                                    <td align="center"><?= $dtdetail_e_row->kwh_akumulatif ?></td>
                                                                </tr>
                                                        <?php }
                                                        } ?>
                                                    </tbody>
                                                <tfoot>    
                                                    <?php if(isset($dtheader)) { ?>
                                                        <?php foreach($dtheader as $header){ ?>
                                                            <tr>
                                                                <th class="table-danger align-middle text-left" rowspan="1" colspan="4" style="position: sticky;left: 0;top: auto;">Total 2 Generator</th>
                                                                <th class="table-danger align-middle text-center"><?= $header->total_dtl_e_kwh_nilai; ?></th>
                                                                <th class="table-danger align-middle text-center"><?= $header->total_dtl_e_kwh_akumulatif; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th class="table-danger align-middle text-left" rowspan="1" colspan="4" style="position: sticky;left: 0;top: auto;">Supply Dari PWH</th>
                                                                <th class="table-danger align-middle text-center"><?= $header->supplay_pwh; ?></th>
                                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1"></th>
                                                            </tr>
                                                        
                                                        <?php } }?> 
                                                    
                                                </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- Tabel A ditarik dari form 009 -->
                                <strong>B. Data Harian Pemakaian Steam</strong>
                                <div class="table-responsive" id="scrolling_table_2">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="3" colspan="1">No.</th>
                                                <th class="fixed freeze_horizontal table-primary align-middle text-center" rowspan="3" colspan="1">Departemen</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="4">STEAM</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="12">BAHAN BAKAR</th>
                                                <th class="table-primary align-middle text-center" rowspan="2" colspan="2">EFFESIENSI<br />Steam Kg/ Kg Batu Bara</th>
                                                <th class="table-primary align-middle text-center" rowspan="2" colspan="2">EFFESIENSI<br />Steam Kg/ Kg Bahan Bakar</th>
                                                <th class="table-primary align-middle text-center" rowspan="2" colspan="2">Jam Operasi</th>
                                                <th class="table-primary align-middle text-center" rowspan="2" colspan="2">Air Deator</th>
                                                <th class="table-primary align-middle text-center" rowspan="2" colspan="2">Air Demin</th>
                                                <th class="table-primary align-middle text-center" rowspan="2" colspan="2">Air CT</th>
                                            </tr>
                                            <tr>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Steam (Ton)</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Press (Bar)</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Batubara (Kg)</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Debu Arang (Kg)</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Cocopit (Kg)</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Tempurung (kg)</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Pakai Bahan Bakar (a+b+c+d)</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Sabut (Kg)</th>
                                            </tr>
                                            <tr>
                                                <?php for ($i = 1; $i <= 14; $i++) { ?>
                                                    <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Hari ini</th>
                                                    <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_a">
                                            <?php
                                            $total_steam_nilai                  = 0;
                                            $total_steam_akumulatif             = 0;
                                            $total_press_nilai                  = 0;
                                            $total_press_akumulatif             = 0;
                                            $total_batubara_nilai               = 0;
                                            $total_batubara_akumulatif          = 0;
                                            $total_debu_nilai                   = 0;
                                            $total_debu_akumulatif              = 0;
                                            $total_cocopit_nilai                = 0;
                                            $total_cocopit_akumulatif           = 0;
                                            $total_tempurung_nilai              = 0;
                                            $total_tempurung_akumulatif         = 0;
                                            $total_bb_nilai                     = 0;
                                            $total_bb_akumulatif                = 0;
                                            $total_sabut_nilai                  = 0;
                                            $total_sabut_akumulatif             = 0;
                                            $total_steam_batubara_nilai         = 0;
                                            $total_steam_batubara_akumulatif    = 0;
                                            $total_steam_bahanbakar_nilai       = 0;
                                            $total_steam_bahanbakar_akumulatif  = 0;
                                            $total_operasi_nilai                = 0;
                                            $total_operasi_akumulatif           = 0;
                                            $total_dearator_nilai               = 0;
                                            $total_dearator_akumulatif          = 0;
                                            $total_demian_nilai                 = 0;
                                            $total_demian_akumulatif            = 0;
                                            $total_ct_nilai                     = 0;
                                            $total_ct_akumulatif                = 0;
                                            if (isset($dtdetail)) {
                                                $no = 1;
                                                foreach ($dtdetail as $dtdetail_row) {
                                                    $total_steam_nilai                  += $dtdetail_row->steam_nilai;
                                                    $total_steam_akumulatif             += $dtdetail_row->steam_akumulatif;
                                                    $total_press_nilai                  += $dtdetail_row->press_nilai;
                                                    $total_press_akumulatif             += $dtdetail_row->press_akumulatif;
                                                    $total_batubara_nilai               += $dtdetail_row->batubara_nilai;
                                                    $total_batubara_akumulatif          += $dtdetail_row->batubara_akumulatif;
                                                    $total_debu_nilai                   += $dtdetail_row->debu_nilai;
                                                    $total_debu_akumulatif              += $dtdetail_row->debu_akumulatif;
                                                    $total_cocopit_nilai                += $dtdetail_row->cocopit_nilai;
                                                    $total_cocopit_akumulatif           += $dtdetail_row->cocopit_akumulatif;
                                                    $total_tempurung_nilai              += $dtdetail_row->tempurung_nilai;
                                                    $total_tempurung_akumulatif         += $dtdetail_row->tempurung_akumulatif;
                                                    $total_bb_nilai                     += $dtdetail_row->bb_nilai;
                                                    $total_bb_akumulatif                += $dtdetail_row->bb_akumulatif;
                                                    $total_sabut_nilai                  += $dtdetail_row->sabut_nilai;
                                                    $total_sabut_akumulatif             += $dtdetail_row->sabut_akumulatif;
                                                    $total_steam_batubara_nilai         += $dtdetail_row->steam_batubara_nilai;
                                                    $total_steam_batubara_akumulatif    += $dtdetail_row->steam_batubara_akumulatif;
                                                    $total_steam_bahanbakar_nilai       += $dtdetail_row->steam_bahanbakar_nilai;
                                                    $total_steam_bahanbakar_akumulatif  += $dtdetail_row->steam_bahanbakar_akumulatif;
                                                    $total_operasi_nilai                += $dtdetail_row->operasi_nilai;
                                                    $total_operasi_akumulatif           += $dtdetail_row->operasi_akumulatif;
                                                    $total_dearator_nilai               += $dtdetail_row->dearator_nilai;
                                                    $total_dearator_akumulatif          += $dtdetail_row->dearator_akumulatif;
                                                    $total_demian_nilai                 += $dtdetail_row->demian_nilai;
                                                    $total_demian_akumulatif            += $dtdetail_row->demian_akumulatif;
                                                    $total_ct_nilai                     += $dtdetail_row->ct_nilai;
                                                    $total_ct_akumulatif                += $dtdetail_row->ct_akumulatif;
                                            ?>
                                                    <tr>
                                                        <td align="center" class="fixed freeze_horizontal" style="background-color: #ffffff !important;"><?= $no++; ?></td>
                                                        <td align="center" class="fixed freeze_horizontal" style="background-color: #ffffff !important;"><?= $dtdetail_row->dept_steam; ?></td>
                                                        <td align="center"><?= $dtdetail_row->steam_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->steam_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->press_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->press_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->batubara_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->batubara_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->debu_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->debu_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->cocopit_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->cocopit_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->tempurung_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->tempurung_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->bb_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->bb_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->sabut_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->sabut_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->steam_batubara_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->steam_batubara_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->steam_bahanbakar_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->steam_bahanbakar_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->operasi_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->operasi_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->dearator_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->dearator_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->demian_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->demian_akumulatif; ?></td>
                                                        <td align="center"><?= $dtdetail_row->ct_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_row->ct_akumulatif; ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <?php if(isset($dtheader)){ 
                                                foreach($dtheader as $header) {?>
                                            <tr>
                                                <td class="table-primary align-middle text-left" rowspan="1" colspan="2" style="position: sticky;left: 0;top: auto;">Total 2 Generator</td>
                                                <td class="table-primary align-middle text-left" rowspan="1" colspan="12"></td>
                                                <td class="table-primary align-middle text-center"><?= $header->total_2generator; ?></td>
                                                <td class="table-primary align-middle text-center"><?= $header->total_2generator_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-left" rowspan="1" colspan="14"></td>
                                            </tr>
                                            <tr>
                                                <?php } }?>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="2" style="position: sticky;left: 0;top: auto;">Total</td>
                                                <td class="table-primary align-middle text-center total_dtl_a_steam_nilai" rowspan="1" colspan="1"><?= $total_steam_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_steam_akumulatif" rowspan="1" colspan="1"><?= $total_steam_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_press_nilai" rowspan="1" colspan="1"><?= $total_press_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_press_akumulatif" rowspan="1" colspan="1"><?= $total_press_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_batubara_nilai" rowspan="1" colspan="1"><?= $total_batubara_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_batubara_akumulatif" rowspan="1" colspan="1"><?= $total_batubara_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_debu_nilai" rowspan="1" colspan="1"><?= $total_debu_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_debu_akumulatif" rowspan="1" colspan="1"><?= $total_debu_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_cocopit_nilai" rowspan="1" colspan="1"><?= $total_cocopit_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_cocopit_akumulatif" rowspan="1" colspan="1"><?= $total_cocopit_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_tempurung_nilai" rowspan="1" colspan="1"><?= $total_tempurung_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_tempurung_akumulatif" rowspan="1" colspan="1"><?= $total_tempurung_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_bb_nilai" rowspan="1" colspan="1"><?= $total_bb_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_bb_akumulatif" rowspan="1" colspan="1"><?= $total_bb_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_sabut_nilai" rowspan="1" colspan="1"><?= $total_sabut_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_sabut_akumulatif" rowspan="1" colspan="1"><?= $total_sabut_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_steam_batubara_nilai" rowspan="1" colspan="1"><?= $total_steam_batubara_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_steam_batubara_akumulatif" rowspan="1" colspan="1"><?= $total_steam_batubara_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_steam_bahanbakar_nilai" rowspan="1" colspan="1"><?= $total_steam_bahanbakar_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_steam_bahanbakar_akumulatif" rowspan="1" colspan="1"><?= $total_steam_bahanbakar_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_operasi_nilai" rowspan="1" colspan="1"><?= $total_operasi_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_operasi_akumulatif" rowspan="1" colspan="1"><?= $total_operasi_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_dearator_nilai" rowspan="1" colspan="1"><?= $total_dearator_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_dearator_akumulatif" rowspan="1" colspan="1"><?= $total_dearator_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_demian_nilai" rowspan="1" colspan="1"><?= $total_demian_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_demian_akumulatif" rowspan="1" colspan="1"><?= $total_demian_akumulatif; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_ct_nilai" rowspan="1" colspan="1"><?= $total_ct_nilai; ?></td>
                                                <td class="table-primary align-middle text-center total_dtl_a_ct_akumulatif" rowspan="1" colspan="1"><?= $total_ct_akumulatif; ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <!-- Tabel B ditarik dari form 009 -->
                                <strong>C. Pemakaian Trafo</strong>
                                <div class="table-responsive" id="scrolling_table_1" style="max-height: 850px;">
                                    <table class="table table-striped table-bordered">
                                        <thead class="fixed freeze_vertical">
                                            <tr>
                                                <th class="table-info align-middle text-center" rowspan="3" colspan="1">No.</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="11">CATATAN KWH TRAFO</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="2">REKAP BAHAN BAKAR</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="2">EFISIENSI</th>
                                                <th class="table-info align-middle text-center" rowspan="2" colspan="2">Jam Operasi</th>
                                                <th class="table-info align-middle text-center" rowspan="2" colspan="2">Solar</th>
                                            </tr>
                                            <tr>
                                                <th class="table-info align-middle text-center" rowspan="3" colspan="1">Kode Trafo</th>
                                                <th class="table-info align-middle text-center" rowspan="3" colspan="1">Nama Trafo</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="3">6k5 & 6k6</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="6">6K1,6K3,6K4,6K8,6K9,6K10,6K11,6K12,6K13,611,622,633,1#IDF,2#IDF,3IDF,1PAF,2#PAF,3PAF</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="2">Bahan Bakar</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="2">KWH / Kg Bahan Bakar</th>
                                            </tr>
                                            <tr>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Rata2/hari</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Jam</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">KWH</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">READ CT</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">AWAL</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">AKHIR</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">PUTARAN</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">KWH HARI INI</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif KWH</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Hari ini</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Hari ini</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Hari ini</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Hari ini</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_b">
                                            <?php
                                            if (isset($dtdetail_b)) {
                                                $no = 1;
                                                foreach ($dtdetail_b as $dtdetail_b_row) {?>
                                                        <tr>
                                                            <td align="center"><?= $no++; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->trafo; ?></td>
                                                            <td align="left"><?= $dtdetail_b_row->nama_trafo; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->rata_hari; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->jam; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->kwh_6k5_nilai; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->read_ct_trafo; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->trafo_awal; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->trafo_akhir; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->trafo_putaran; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->kwh_nilai; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->kwh_akumulatif; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->bahanbakar_nilai; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->bahanbakar_akumulatif; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->kwh_efisiensi_nilai; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->kwh_efisiensi_akumulatif; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->operasi_nilai; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->operasi_akumulatif; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->solar_nilai; ?></td>
                                                            <td align="center"><?= $dtdetail_b_row->solar_akumulatif; ?></td>
                                                        </tr>
                                            <?php }
                                                } ?>
                                        </tbody>
                                        <tfoot>
                                            <?php if(isset($dtheader)){
                                                foreach($dtheader as $header){ ?>
                                                    <tr>
                                                        <td class="table-info align-middle text-left" rowspan="1" colspan="10">SELISIH KWH TRAFO DAN GENERATOR</td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1"><?= $header->selisih_kwh_generator; ?></td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="9"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="table-info align-middle text-left" rowspan="1" colspan="10">Total</td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_b_kwh_nilai; ?></td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_b_kwh_akumulatif; ?></td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_b_bahanbakar_nilai; ?></td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_b_bahanbakar_akumulatif; ?></td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_b_kwh_efisiensi_nilai; ?></td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_b_kwh_efisiensi_akumulatif; ?></td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_b_operasi_nilai; ?></td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_b_operasi_akumulatif; ?></td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_b_solar_nilai; ?></td>
                                                        <td class="table-info align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_b_solar_akumulatif; ?></td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <!-- Tabel C ditarik dari form 520 -->
                                <strong>D. Panel Lokasi</strong>
                                <div class="table-responsive" id="scrolling_table_1" style="max-height: 800px;">
                                    <table class="table table-striped table-bordered">
                                        <thead style="position:sticky;top: 0; z-index: 1;">
                                            <tr>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="4">Departemen</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="3">6k6</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="2">Belum Ada Meteran Sendiri</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="4">Catatan KWH</th>
                                                <th class="table-success align-middle text-center" rowspan="2" colspan="1">Pakai KWh real hari ini</th>
                                            </tr>
                                            <tr>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">KODE KWH</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Reading CT</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Nama</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Rata2/hari</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">JAM Operasi</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">KWH</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Beban Tetap/hari Berdasarkan %</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Beban Tetap/hari</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Awal</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Akhir</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Putaran</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">KWH</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_c">
                                            <?php
                                            if (isset($dtdetail_c)) {
                                                $no = 1;
                                                foreach ($dtdetail_c as $dtdetail_c_row) {
                                            ?>
                                                    <tr>
                                                        <td align="center"><?= $no++; ?></td>
                                                        <td align="center"><?= $dtdetail_c_row->kode_kwh; ?></td>
                                                        <td align="center"><?= $dtdetail_c_row->reading_ct; ?></td>
                                                        <td align="left"><?= $dtdetail_c_row->dept_panel; ?></td>
                                                        <td align="center"><?= $dtdetail_c_row->rata_hari; ?></td>
                                                        <td align="center"><?= $dtdetail_c_row->jam_operasi; ?></td>
                                                        <td align="center"><?= $dtdetail_c_row->kwh_6k6_hasil; ?></td>
                                                        <td align="center"><?= $dtdetail_c_row->beban_persen; ?></td>
                                                        <td align="center"><?= $dtdetail_c_row->beban; ?></td>
                                                        <td align="center"><?= $dtdetail_c_row->kwh_awal; ?></td>
                                                        <td align="center"><?= $dtdetail_c_row->kwh_akhir; ?></td>
                                                        <td align="center"><?= $dtdetail_c_row->putaran_hasil; ?></td>
                                                        <td align="center"><?= $dtdetail_c_row->kwh_nilai; ?></td>
                                                        <td align="center"><?= $dtdetail_c_row->kwh_real_nilai; ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <?php if(isset($dtheader)){ 
                                                foreach($dtheader as $header){ ?>
                                                <tr>
                                                    <td class="table-success align-middle text-right" rowspan="1" colspan="13">Total Real Pakai merupakan akumulatif keseluruhan</td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_real_pakai; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="table-success align-middle text-right" rowspan="1" colspan="13">Kwh Generator 1</td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_kwh_generator1_nilai; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="table-success align-middle text-right" rowspan="1" colspan="13">Kwh Generator 2</td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_kwh_generator2_nilai; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="table-success align-middle text-right" rowspan="1" colspan="13">Star Genset</td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_star_genset; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="table-success align-middle text-right" rowspan="1" colspan="13">Total</td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_generator; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="table-success align-middle text-right" rowspan="1" colspan="13">Total Loss Merupakan Selisih dari output Generator 1 + Generator 2 + Star genset dikurang total pakai kwh real hari ini</td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_kwh_loss_nilai; ?></td>
                                                </tr>
                                                
                                            <?php } } ?>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <!-- Tabel C ditarik dari form 520 -->
                                <strong>E. Panel Per Departemen</strong>
                                <div class="table-responsive" style="max-height: 800px;">
                                    <table class="table table-striped table-bordered">
                                        <thead style="position:sticky;top: 0; z-index: 1;">
                                            <tr>
                                                <th class="table-success align-middle text-center" rowspan="2" colspan="1">No.</th>
                                                <th class="table-success align-middle text-center" rowspan="2" colspan="1">Departemen</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="3">Pemakaian<br>KWH</th>
                                                <th class="table-success align-middle text-center" rowspan="2" colspan="1">%</th>
                                                <th class="table-success align-middle text-center" rowspan="2" colspan="1">Akumulatif<br>KWH</th>
                                                <th class="table-success align-middle text-center" rowspan="2" colspan="1">%</th>
                                                <th class="table-success align-middle text-center" rowspan="2" colspan="1">Pemakaian<br>Bahan Bakar</th>
                                                <th class="table-success align-middle text-center" rowspan="2" colspan="1">Akumulatif<br>Bahan Bakar</th>
                                            </tr>
                                            <tr>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">KWH REAL HARI</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">LOSS KWH HARI INI</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">TOTAL KWH HARI INI</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_d">
                                            <?php
                                            $total_pemakai_kwh = 0;
                                            $total_pemakai_kwh_loss = 0;
                                            $total_pemakai_kwh_total = 0;
                                            $total_pemakai_persen = 0;
                                            $total_pemakai_akumulatif = 0;
                                            $total_bahan_bakar_kwh = 0;
                                            $total_bahan_bakar_persen = 0;
                                            $total_bahan_bakar_akumulatif = 0;
                                            if (isset($dtdetail_d)) {
                                                $no = 1;
                                                foreach ($dtdetail_d as $dtdetail_d_row) { ?>
                                                    <tr>
                                                        <td align="center"><?= $no++; ?></td>
                                                        <td align="center"><?= $dtdetail_d_row->pemakai_panel; ?></td>
                                                        <td align="center"><?= $dtdetail_d_row->pemakai_kwh;?></td>
                                                        <td align="center"><?= $dtdetail_d_row->pemakai_kwh_loss;?></td>
                                                        <td align="center"><?= $dtdetail_d_row->pemakai_kwh_total;?></td>
                                                        <td align="center"><?= $dtdetail_d_row->pemakai_persen;?></td>
                                                        <td align="center"><?= $dtdetail_d_row->pemakai_akumulatif;?></td>
                                                        <td align="center"><?= $dtdetail_d_row->bahan_bakar_persen;?></td>
                                                        <td align="center"><?= $dtdetail_d_row->bahan_bakar_kwh;?></td>
                                                        <td align="center"><?= $dtdetail_d_row->bahan_bakar_akumulatif;?></td>
                                                        
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <?php if(isset($dtheader)){
                                                foreach($dtheader as $header){?>
                                                <tr>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="2">Total</td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_d_pemakai_kwh; ?></td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_d_pemakai_kwh_loss; ?></td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_d_pemakai_kwh_total; ?></td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_d_pemakai_persen; ?></td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_d_pemakai_akumulatif; ?></td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_d_bahan_bakar_persen; ?></td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_d_bahan_bakar_kwh; ?></td>
                                                    <td class="table-success align-middle text-center" rowspan="1" colspan="1"><?= $header->total_dtl_d_bahan_bakar_akumulatif; ?></td>
                                                </tr>
                                            <?php }
                                            }?>
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