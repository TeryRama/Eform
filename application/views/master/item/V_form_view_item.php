<?php $this->load->view('template/headbar'); ?>

<?php
if (isset($dtheader)) {
    foreach ($dtheader as $row_header) {
        $headerid       = $row_header->headerid;
        $dtkode_form    = $row_header->form_kode;
        $dtparameter    = $row_header->parameter;
        $dtdepartemen   = $row_header->departemen;
        $dttgl_efective = date("d-m-Y", strtotime($row_header->tgl_efective));
    }
} else {
    $dtkode_form    = "";
    $dtparameter    = "";
    $dtdepartemen   = "";
    $dttgl_efective = "";
} ?>

<section class="content-header">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="mt-2 mb-1 d-flex justify-content-center">
                        <img src="<?php echo base_url('assets/images/Logo_PSG.gif') ?>" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <h2><?php echo $this->config->item("nama_perusahaan"); ?></h2>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <h4>MASTER FORM ITEM</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-condensed">
                                    <tr>
                                        <td style="text-align:left; font-weight: bold;">Kode Form</td>
                                        <td style="text-align:left; font-weight: bold;">: <?php echo $dtkode_form; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; font-weight: bold;">Parameter 1</td>
                                        <td style="text-align:left; font-weight: bold;">: <?php echo $dtparameter; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; font-weight: bold;">Departemen</td>
                                        <td style="text-align:left; font-weight: bold;">: <?php echo $dtdepartemen; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; font-weight: bold;">Tanggal Efective</td>
                                        <td style="text-align:left; font-weight: bold;">: <?php echo $dttgl_efective; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-8"></div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive scrolly_table" id="scrolling_table_1" style="max-height: 1000px;">
                                    <table class="table table-bordered table-striped" border="6">
                                        <thead class="bg-gradient-primary sticky-top" style="text-align: center;">
                                            <tr>
                                                <th class="align-middle text-center" colspan="8">List Item</th>
                                            </tr>
                                            <tr>
                                                <th class="align-middle text-center" rowspan="3">No.</th>
                                                <th class="align-middle text-center" rowspan="3">Item 1</th>
                                                <th class="align-middle text-center" rowspan="3">Item 2</th>
                                                <th class="align-middle text-center" rowspan="3">Item 3</th>
                                                <th class="align-middle text-center" rowspan="3">Item 4</th>
                                                <th class="align-middle text-center" rowspan="3">Item 5</th>
                                                <th class="align-middle text-center">Spesifikasi</th>
                                                <th class="align-middle text-center">Tipe Pengecekan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <?php if (isset($dtdetail5)) {
                                                $no = 1;
                                                foreach ($dtdetail5 as $detail5) {
                                                    if ($detail5->detail_id_e != '') {
                                                        $spek = $detail5->spek5;
                                                        $tipe_cek = $detail5->tipe_cek5;
                                                    } else if ($detail5->detail_id_d != '') {
                                                        $spek = $detail5->spek4;
                                                        $tipe_cek = $detail5->tipe_cek4;
                                                    } else if ($detail5->detail_id_c != '') {
                                                        $spek = $detail5->spek3;
                                                        $tipe_cek = $detail5->tipe_cek3;
                                                    } else if ($detail5->detail_id_b != '') {
                                                        $spek = $detail5->spek2;
                                                        $tipe_cek = $detail5->tipe_cek2;
                                                    } else if ($detail5->detail_id != '') {
                                                        $spek = $detail5->spek1;
                                                        $tipe_cek = $detail5->tipe_cek1;
                                                    } ?>
                                                    <tr>
                                                        <td align="center"><?= $detail5->rnum == '1' ? $no++ : '' ?></td>
                                                        <td style="text-align:left">
                                                            <?= $detail5->rnum == '1' ? $detail5->item1_dtl : '' ?></td>
                                                        <td style="text-align:left">
                                                            <?= $detail5->rnum2 == '1' ? $detail5->item2_dtl_b : '' ?></td>
                                                        <td style="text-align:left">
                                                            <?= $detail5->rnum3 == '1' ? $detail5->item3_dtl_c : '' ?></td>
                                                        <td style="text-align:left">
                                                            <?= $detail5->rnum4 == '1' ? $detail5->item4_dtl_d : '' ?></td>
                                                        <td style="text-align:left">
                                                            <?= $detail5->rnum5 == '1' ? $detail5->item5_dtl_e : '' ?></td>
                                                        <td style="text-align:left">
                                                            <?= $spek ?>
                                                        </td>
                                                        <td style="text-align:center">
                                                            <?php if ($tipe_cek == '0') {
                                                                echo 'Default';
                                                            } else if ($tipe_cek == '1') {
                                                                echo 'Awal Saja';
                                                            } else if ($tipe_cek == '2') {
                                                                echo 'Akhir Saja';
                                                            } ?></td>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot class="bg-gradient-primary">
                                            <tr>
                                                <td colspan="8"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div> <!-- end table kategori D -->


                        <div class="box-footer">
                            <div align="left"></div>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="panel-footer">
                        <div class="clearfix"></div>
                    </div>
                </div><!-- /.columnbox-primary-->
            </div><!-- /.col-->
        </div><!-- /.row -->
</section><!-- /.content -->

<?php $this->load->view('template/footbar'); ?>
<?php $this->load->view('template/footbarend'); ?>