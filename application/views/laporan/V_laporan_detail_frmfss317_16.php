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
                                <strong>A. Data Harian Pemakaian Air WTD</strong>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-primary align-middle text-center" rowspan="2" colspan="1">No.</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="2">Uraian</th>
                                                <th class="table-primary align-middle text-center" rowspan="2" colspan="1">Pemakaian (M³)</th>
                                                <th class="table-primary align-middle text-center" rowspan="2" colspan="1">%</th>
                                                <th class="table-primary align-middle text-center" rowspan="2" colspan="1">Akumulatif</th>
                                            </tr>
                                            <tr>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Supplay Air</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Departemen Pemakai</th>
                                                <!-- <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Nama Flow Meter</th> -->
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_a"><?php
                                                                $dtl_a_grand_total_pemakaian = '';
                                                                $dtl_a_grand_total_persen = '';
                                                                $dtl_a_grand_total_akumulatif = '';
                                                                $dtl_a_total_pemakaian = 0;
                                                                $dtl_a_total_persen = 0;
                                                                $dtl_a_total_akumulatif = 0;
                                                                if (isset($dtdetail)) {
                                                                    $no = 1;
                                                                    foreach ($dtdetail as $dtdetail_row_key => $dtdetail_row) {
                                                                        $dtl_a_grand_total_pemakaian    += $dtdetail_row->pemakaian;
                                                                        $dtl_a_grand_total_persen       += $dtdetail_row->persen;
                                                                        $dtl_a_grand_total_akumulatif   += $dtdetail_row->akumulatif;

                                                                        if ($no == 1) {
                                                                            $dtl_a_total_pemakaian = $dtdetail_row->pemakaian;
                                                                            $dtl_a_total_persen = $dtdetail_row->persen;
                                                                            $dtl_a_total_akumulatif = $dtdetail_row->akumulatif;
                                                                        } else {
                                                                            if ($dtdetail_row->nama_jenis_air == $dtdetail[$dtdetail_row_key - 1]->nama_jenis_air) {
                                                                                $dtl_a_total_pemakaian += $dtdetail_row->pemakaian;
                                                                                $dtl_a_total_persen += $dtdetail_row->persen;
                                                                                $dtl_a_total_akumulatif += $dtdetail_row->akumulatif;
                                                                            } else {
                                                                                $dtl_a_total_pemakaian = $dtdetail_row->pemakaian;
                                                                                $dtl_a_total_persen = $dtdetail_row->persen;
                                                                                $dtl_a_total_akumulatif = $dtdetail_row->akumulatif;
                                                                            }
                                                                        }
                                                                ?>
                                                    <tr>
                                                        <td align="center"><?= $no++; ?></td>
                                                        <?php if ($dtdetail_row->no_urut == '1') { ?>
                                                            <td align="center" rowspan="<?= $dtdetail_row->no_urut_desc ?>"><?= $dtdetail_row->nama_jenis_air ?></td>
                                                        <?php  } ?>
                                                        <td align="center" rowspan="1"><?= $dtdetail_row->nama_departemen ?></td>
                                                        <td align="center"><?= $dtdetail_row->pemakaian ?></td>
                                                        <td align="center"><?= number_format($dtdetail_row->persen,1) ?></td>
                                                        <td align="center"><?= $dtdetail_row->akumulatif ?></td>
                                                    </tr>
                                                    <?php if ($dtdetail_row->no_urut_desc == '1') { ?>
                                                        <tr>
                                                            <td class="table-secondary align-middle text-center" colspan="3">Total <?= $dtdetail_row->nama_jenis_air ?></td>
                                                            <td class="table-secondary align-middle text-center dtl_a_total_pemakaian"><?= $dtl_a_total_pemakaian ?></td>
                                                            <td class="table-secondary align-middle text-center dtl_a_total_persen"><?= number_format($dtl_a_total_persen,1) ?></td>
                                                            <td class="table-secondary align-middle text-center dtl_a_total_akumulatif"><?= $dtl_a_total_akumulatif ?></td>
                                                        </tr>
                                                    <?php } ?>
                                            <?php
                                                                    }
                                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="3">Grand Total</td>
                                                <td class="table-primary align-middle text-center dtl_a_grand_total_pemakaian" rowspan="1" colspan="1"><?= $dtl_a_grand_total_pemakaian ?></td>
                                                <td class="table-primary align-middle text-center dtl_a_grand_total_persen" rowspan="1" colspan="1"><?= number_format($dtl_a_grand_total_persen,1) ?></td>
                                                <td class="table-primary align-middle text-center dtl_a_grand_total_akumulatif" rowspan="1" colspan="1"><?= $dtl_a_grand_total_akumulatif ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>B. Operasional (Proses)</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Pemakaian</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_b">
                                            <?php
                                            if (isset($dtdetail_b)) {
                                                $no = 1;
                                                foreach ($dtdetail_b as $dtdetail_row_b) { ?>
                                                    <tr><?php if ($dtdetail_row_b->operasi_jenis == 'Jam Operasi (Proses)') { ?>
                                                            <td align="center"><?= $no++ ?></td>
                                                            <td align="center"><?= $dtdetail_row_b->operasi_jenis ?></td>
                                                            <td align="center"><?= $dtdetail_row_b->operasi_nilai ?></td>
                                                            <td align="center"><?= $dtdetail_row_b->operasi_akumulatif ?></td>
                                                            <td align="center"><?= $dtdetail_row_b->operasi_satuan ?></td>
                                                        <?php } else if ($dtdetail_row_b->operasi_jenis == 'Total Air Gambut') { ?>
                                                            <td class="table-info align-middle text-center"></td>
                                                            <td class="table-info align-middle text-center"><?= $dtdetail_row_b->operasi_jenis ?></td>
                                                            <td class="table-info align-middle text-center"><?= $dtdetail_row_b->operasi_nilai ?></td>
                                                            <td class="table-info align-middle text-center"><?= $dtdetail_row_b->operasi_akumulatif ?></td>
                                                            <td class="table-info align-middle text-center"><?= $dtdetail_row_b->operasi_satuan ?></td>
                                                        <?php } else if ($dtdetail_row_b->operasi_jenis == 'WTD') { ?>
                                                            <td align="center"><?= '1' ?></td>
                                                            <td align="center"><?= $dtdetail_row_b->operasi_jenis ?></td>
                                                            <td align="center"><?= $dtdetail_row_b->operasi_nilai ?></td>
                                                            <td align="center"><?= $dtdetail_row_b->operasi_akumulatif ?></td>
                                                            <td align="center"><?= $dtdetail_row_b->operasi_satuan ?></td>
                                                        <?php  } else { ?>
                                                            <td align="center"><?= $no++ ?></td>
                                                            <td align="center"><?= $dtdetail_row_b->operasi_jenis ?></td>
                                                            <td align="center"><?= $dtdetail_row_b->operasi_nilai ?></td>
                                                            <td align="center"><?= $dtdetail_row_b->operasi_akumulatif ?></td>
                                                            <td align="center"><?= $dtdetail_row_b->operasi_satuan ?></td>
                                                        <?php } ?>
                                                    </tr>
                                            <?php }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-info align-middle text-center" rowspan="1" colspan="2"></td>
                                                <td class="table-info align-middle text-center dtl_b_total_operasi_nilai" rowspan="1" colspan="1"></td>
                                                <td class="table-info align-middle text-center dtl_b_total_operasi_akumulatif" rowspan="1" colspan="1"></td>
                                                <td class="table-info align-middle text-center dtl_b_total_operasi_satuan" rowspan="1" colspan="1"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>C. Proses RO</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Pemakaian</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_c">
                                            <?php
                                            if (isset($dtdetail_c)) {
                                                $no = 1;
                                                foreach ($dtdetail_c as $dtdetail_row_c) { ?>
                                                    <tr>
                                                        <td align="center"><?= $no++; ?></td>
                                                        <td align="center"><?= $dtdetail_row_c->operasi_jenis ?></td>
                                                        <td align="center"><?= $dtdetail_row_c->operasi_nilai ?></td>
                                                        <td align="center"><?= $dtdetail_row_c->operasi_akumulatif ?></td>
                                                        <td align="center"><?= $dtdetail_row_c->operasi_satuan ?></td>
                                                    </tr>
                                            <?php }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-success align-middle text-center" rowspan="1" colspan="5"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>D. Proses UF</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Pemakaian</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_c">
                                            <?php
                                            if (isset($dtdetail_c_uf)) {
                                                $no = 1;
                                                foreach ($dtdetail_c_uf as $dtdetail_row_c) { ?>
                                                    <tr>
                                                        <td align="center"><?= $no++; ?></td>
                                                        <td align="center"><?= $dtdetail_row_c->operasi_jenis ?></td>
                                                        <td align="center"><?= $dtdetail_row_c->operasi_nilai ?></td>
                                                        <td align="center"><?= $dtdetail_row_c->operasi_akumulatif ?></td>
                                                        <td align="center"><?= $dtdetail_row_c->operasi_satuan ?></td>
                                                    </tr>
                                            <?php }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-success align-middle text-center" rowspan="1" colspan="5"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>E. Stok Air Awal</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_d">
                                            <?php
                                            if (isset($dtdetail_d)) {
                                                foreach ($dtdetail_d as $dtdetail_row_d) {
                                            ?>
                                                    <tr>
                                                        <input type="hidden" name="dtl_d_detail_id[]" id="dtl_d_detail_id" class="form-control dtl_d_detail_id" value="<?= $dtdetail_row_d->detail_id ?>">
                                                        <td align="center">1</td>
                                                        <td align="center">Total stok</td>
                                                        <td align="center"><?= $dtdetail_row_d->stok_air_awal; ?></td>
                                                        <td align="center">M3</td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            // echo '<pre>';
                                            // print_r($dtdetail_d);die; 
                                            // echo '</pre>';
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-warning align-middle text-center" rowspan="1" colspan="4"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>F. Stok Air Akhir</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Pemakaian</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_e">
                                            <?php
                                            $dtl_e_total_operasi_nilai = '';
                                            $dtl_e_total_operasi_akumulatif = '';
                                            $dtl_e_total_operasi_satuan = '';
                                            if (isset($dtdetail_e)) {
                                                $no = 1;
                                                foreach ($dtdetail_e as $dtdetail_row_e) {
                                                    $dtl_e_total_operasi_nilai += $dtdetail_row_e->operasi_nilai;
                                                    $dtl_e_total_operasi_akumulatif += $dtdetail_row_e->operasi_akumulatif;
                                                    $dtl_e_total_operasi_satuan = $dtdetail_row_e->operasi_satuan;
                                            ?>
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td align="center"><?= $dtdetail_row_e->operasi_jenis ?></td>
                                                        <td align="center"><?= $dtdetail_row_e->operasi_nilai ?></td>
                                                        <td align="center"><?= $dtdetail_row_e->operasi_akumulatif ?></td>
                                                        <td align="center"><?= $dtdetail_row_e->operasi_satuan ?></td>
                                                    </tr>
                                            <?php  }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-danger align-middle text-center" rowspan="1" colspan="2">Total Stok </td>
                                                <td class="table-danger align-middle text-center dtl_e_total_operasi_nilai" rowspan="1" colspan="1"><?= $dtl_e_total_operasi_nilai ?></td>
                                                <td class="table-danger align-middle text-center dtl_e_total_operasi_akumulatif" rowspan="1" colspan="1"><?= $dtl_e_total_operasi_akumulatif ?></td>
                                                <td class="table-danger align-middle text-center dtl_e_total_operasi_satuan" rowspan="1" colspan="1"><?= $dtl_e_total_operasi_satuan ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>G. Proses Air Recycle</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Stok Proses Air Recycle</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_f">
                                            <?php $no = 1;
                                            $total_dtl_f_operasi_nilai = '';
                                            if (isset($dtdetail_f)) {
                                                // $list_dtl_f_item = ['dtl_f_asf', 'dtl_f_acf', 'dtl_f_ast', 'dtl_f_ro'];
                                                foreach ($dtdetail_f as $dtdetail_row_f) {
                                                    $total_dtl_f_operasi_nilai += $dtdetail_row_f->operasi_nilai;
                                            ?>
                                                    <tr>
                                                        <td align="center"><?= $no++; ?></td>
                                                        <td align="center"><?= $dtdetail_row_f->operasi_jenis ?></td>
                                                        <td align="center"><?= $dtdetail_row_f->operasi_nilai ?></td>
                                                        <td align="center"><?= $dtdetail_row_f->operasi_satuan ?></td>
                                                    </tr>

                                                <?php
                                                }
                                            } else {

                                                ?>
                                                <tr>
                                                    <td align="center" colspan="4"><i>Data belum tersedia!</i></td>
                                                </tr>
                                            <?php  } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="2">Total</td>
                                                <td class="dtl_f_total table-primary align-middle text-center" rowspan="1" colspan="1"><?= $total_dtl_f_operasi_nilai ?></td>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="1"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>H. stok Balance</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">stok Air Akhir</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">T. Distribusi</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">stok Air Awal</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Total Proses</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_g">
                                            <?php
                                            $dtl_g_total_bawah = 0;
                                            if (isset($dtdetail_g)) {
                                                foreach ($dtdetail_g as $dtdetail_row_g) {
                                                    $dtl_g_total_bawah = $dtdetail_row_g->stok_air_akhir + $dtdetail_row_g->t_distribusi - $dtdetail_row_g->stok_air_awal - $dtdetail_row_g->total_proses;
                                            ?>
                                                    <tr>
                                                        <td align="center"><?= $dtdetail_row_g->stok_air_akhir ?></td>
                                                        <td align="center"><?= $dtdetail_row_g->t_distribusi ?></td>
                                                        <td align="center"><?= $dtdetail_row_g->stok_air_awal ?></td>
                                                        <td align="center"><?= $dtdetail_row_g->total_proses ?></td>
                                                    </tr>
                                            <?php    }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-info align-middle text-center" rowspan="1" colspan="3"> </td>
                                                <td class="table-info align-middle text-center dtl_g_total_bawah" rowspan="1" colspan="1"><?= number_format($dtl_g_total_bawah, 1) ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>I. Catatan</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Drain (M3)</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Backwash Tangki / CIP (M3)</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Cleaning Bak (M3)</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Operasional WTD (M3)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_h">
                                            <?php
                                            if (isset($dtdetail_h)) {
                                                foreach ($dtdetail_h as $dtdetail_row_h) { ?>
                                                    <tr>
                                                        <td align="center"><?= $dtdetail_row_h->drain_sedimen ?></td>
                                                        <td align="center"><?= $dtdetail_row_h->backwash_tanki ?></td>
                                                        <td align="center"><?= $dtdetail_row_h->cleaning_bak ?></td>
                                                        <td align="center"><?= $dtdetail_row_h->operasional ?></td>
                                                    </tr>
                                            <?php    }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-success align-middle text-center" rowspan="1" colspan="4"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>J. Bahan Baku Larutan ( Liter )</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Bahan Kimia</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Pakai</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Efisiensi</th>
                                                <!-- <th class="table-warning align-middle text-center" rowspan="1" colspan="1">stok Aplikasi</th> -->
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_i">
                                            <?php
                                            if (isset($dtdetail_i)) {
                                                $no = 1;


                                                foreach ($dtdetail_i as $dtdetail_row_i) { ?>
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td align="center"><?= $dtdetail_row_i->operasi_jenis ?></td>
                                                        <td align="center"><?= $dtdetail_row_i->operasi_nilai ?></td>
                                                        <td align="center"><?= $dtdetail_row_i->operasi_effisiensi ?></td>
                                                        <!-- <td align="center"><?= $dtdetail_row_i->operasi_stok ?></td> -->
                                                    </tr>
                                            <?php    }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-warning align-middle text-center" rowspan="1" colspan="5"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>K. Target Bahan Baku Larutan ( KG )</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Item</th>
                                                <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Target</th>
                                                <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_j">
                                            <?php
                                            if (isset($dtdetail_j)) {
                                                $no = 1;
                                                foreach ($dtdetail_j as $dtdetail_row_j) { ?>
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td align="center"><?= $dtdetail_row_j->operasi_jenis ?></td>
                                                        <td align="center"><?= $dtdetail_row_j->target ?></td>
                                                        <td align="center"><?= $dtdetail_row_j->operasi_satuan ?></td>
                                                    </tr>
                                            <?php    }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-secondary align-middle text-center" rowspan="1" colspan="5"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>L. Pemakaian Bahan Kimia Sand Filter (Kg)</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Bahan Kimia</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Pakai</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <th class="table-danger align-middle text-center" rowspan="1" colspan="1">stok</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_k">
                                            <?php
                                            if (isset($dtdetail_k)) {
                                                $no = 1;
                                                foreach ($dtdetail_k as $dtdetail_row_k) {

                                            ?>
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td align="center"><?= $dtdetail_row_k->operasi_jenis ?></td>
                                                        <td align="center"><?= $dtdetail_row_k->operasi_nilai ?></td>
                                                        <td align="center"><?= $dtdetail_row_k->operasi_akumulatif ?></td>
                                                        <td align="center"><?= $dtdetail_row_k->stock ?></td>
                                                    </tr>
                                            <?php    }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-danger align-middle text-center" rowspan="1" colspan="6"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>M. Pemakaian Bahan Kimia Softener (KG)</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Bahan Kimia</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Pakai</th>
                                                <!-- <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Effisiensi</th> -->
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <th class="table-primary align-middle text-center" rowspan="1" colspan="1">stok</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_l">
                                            <?php
                                            if (isset($dtdetail_l)) {
                                                $no = 1;
                                                foreach ($dtdetail_l as $dtdetail_row_l) {
                                            ?>
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td align="center"><?= $dtdetail_row_l->operasi_jenis ?></td>
                                                        <td align="center"><?= $dtdetail_row_l->operasi_nilai ?></td>
                                                        <!-- <td align="center"><?= $dtdetail_row_l->effisiensi ?></td> -->
                                                        <td align="center"><?= $dtdetail_row_l->operasi_akumulatif ?></td>
                                                        <td align="center"><?= $dtdetail_row_l->operasi_stok ?></td>
                                                    </tr>
                                            <?php    }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-primary align-middle text-center" rowspan="1" colspan="6"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>N. Pemakaian Bahan Kimia Reverse Osmosis (KG)</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Bahan Kimia</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Pakai</th>
                                                <!-- <th class="table-info align-middle text-center" rowspan="1" colspan="1">Effisiensi</th> -->
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <th class="table-info align-middle text-center" rowspan="1" colspan="1">stok</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_m">
                                            <?php
                                            if (isset($dtdetail_m)) {
                                                $no = 1;
                                                foreach ($dtdetail_m as $dtdetail_row_m) {
                                            ?>
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td align="center"><?= $dtdetail_row_m->operasi_jenis ?></td>
                                                        <td align="center"><?= $dtdetail_row_m->operasi_nilai ?></td>
                                                        <!-- <td align="center"><?= $dtdetail_row_m->effisiensi ?></td> -->
                                                        <td align="center"><?= $dtdetail_row_m->operasi_akumulatif ?></td>
                                                        <td align="center"><?= $dtdetail_row_m->operasi_stok ?></td>
                                                    </tr>
                                            <?php    }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-info align-middle text-center" rowspan="1" colspan="6"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>O. Pemakaian Filter Reverse Osmosis (Pcs)</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">item</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Pakai</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">Akumulatif</th>
                                                <th class="table-success align-middle text-center" rowspan="1" colspan="1">stok</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_n">
                                            <?php
                                            if (isset($dtdetail_n)) {
                                                $no = 1;
                                                foreach ($dtdetail_n as $dtdetail_row_n) {
                                            ?>
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td align="center"><?= $dtdetail_row_n->operasi_jenis ?></td>
                                                        <td align="center"><?= $dtdetail_row_n->operasi_nilai ?></td>
                                                        <td align="center"><?= $dtdetail_row_n->operasi_akumulatif ?></td>
                                                        <td align="center"><?= $dtdetail_row_n->operasi_stok ?></td>
                                                    </tr>
                                            <?php    }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-success align-middle text-center" rowspan="1" colspan="5"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>P. Keterangan Proses RO</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">No.</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">Proses RO</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="1">M3</th>
                                                <th class="table-warning align-middle text-center" rowspan="1" colspan="2">Jam</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_o">
                                            <?php
                                            $dtl_o_total_m3     = '';
                                            $dtl_o_total_jam    = '';
                                            $dtl_o_total_satuan = '';
                                            if (isset($dtdetail_o)) {
                                                $no = 1;
                                                foreach ($dtdetail_o as $dtdetail_row_o) {
                                                    $dtl_o_total_m3     += $dtdetail_row_o->operasi_produk;
                                                    $dtl_o_total_jam    += $dtdetail_row_o->operasi_jam;
                                                    $dtl_o_total_satuan = $dtdetail_row_o->operasi_satuan;
                                            ?>
                                                    <tr>
                                                        <td align="center"><?= $no++ ?></td>
                                                        <td align="center"><?= $dtdetail_row_o->operasi_jenis ?></td>
                                                        <td align="center"><?= $dtdetail_row_o->operasi_produk ?></td>
                                                        <td align="center"><?= $dtdetail_row_o->operasi_jam ?></td>
                                                        <td align="center"><?= $dtdetail_row_o->operasi_satuan ?></td>
                                                    </tr>
                                            <?php    }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-warning align-middle text-center" rowspan="1" colspan="2">Total</td>
                                                <td class="table-warning align-middle text-center dtl_o_total_m3" rowspan="1" colspan="1"><?= $dtl_o_total_m3 ?></td>
                                                <td class="table-warning align-middle text-center dtl_o_total_jam" rowspan="1" colspan="1"><?= $dtl_o_total_jam ?></td>
                                                <td class="table-warning align-middle text-center dtl_o_total_satuan" rowspan="1" colspan="1"><?= $dtl_o_total_satuan ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>Q. Outspec analisa</strong>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="table-secondary align-middle text-center" rowspan="1" colspan="1"></th>
                                                <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">pH</th>
                                                <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Turbidity</th>
                                                <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">colour</th>
                                                <th class="table-secondary align-middle text-center" rowspan="1" colspan="1">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_dtl_p">
                                            <?php $list_dtl_p_item = ['ASF', 'ACF', 'ALCIP'];
                                            if (!empty($dtdetail_p)) {
                                                foreach ($dtdetail_p as $dtdetail_p_row_bsf) { ?>
                                                    <tr>
                                                        <td align="center"><?= $dtdetail_p_row_bsf->item ?></td>
                                                        <td align="center"><?= $dtdetail_p_row_bsf->ph ?></td>
                                                        <td align="center"><?= $dtdetail_p_row_bsf->turbidity ?></td>
                                                        <td align="center"><?= $dtdetail_p_row_bsf->colour ?></td>
                                                        <td align="center"><?= $dtdetail_p_row_bsf->ket ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="table-secondary align-middle text-center" rowspan="1" colspan="5"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
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