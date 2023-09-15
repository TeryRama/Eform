<?php
foreach ($dtfrm as $dt_form) {
    $frmjdl     = $dt_form->formjudul;
    $frmefec    = $dt_form->formefective;
    $frmkd      = $dt_form->formkd;
    $frmvrs     = $dt_form->formversi;
    $frmnm      = $dt_form->formnm;

    $frmparefec = $dt_form->efective_parameter;

    $status_app      = $dt_form->status_app;
}

if ($status_app == 1) {
    foreach ($dtheader as $dtheader_row) {

        $base_url2 = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        $fcpath2   = str_replace('utl/', '', FCPATH);

        $style_ttd = 'style="width:130px; height:80px; background-size:100%;"';

        for ($i = 1; $i <= 10; $i++) {
            ${'app' . $i . '_by'}             = $dtheader_row->{'app' . $i . '_by'} ?? '';
            ${'app' . $i . '_position'}       = $dtheader_row->{'app' . $i . '_position'} ?? '';
            ${'app' . $i . '_status'}         = $dtheader_row->{'app' . $i . '_status'} ?? '';
            ${'app' . $i . '_date'}           = $dtheader_row->{'app' . $i . '_date'} ?? '';
            ${'app' . $i . '_personalid'}     = $dtheader_row->{'app' . $i . '_personalid'} ?? '';
            ${'app' . $i . '_personalstatus'} = $dtheader_row->{'app' . $i . '_personalstatus'} ?? '';
            ${'app' . $i . '_ttd'}            = $dtheader_row->{'app' . $i . '_ttd'} ?? '';

            if (${'app' . $i . '_status'} == '1' && file_exists($fcpath2 . 'utl/assets/ttd/' . ${'app' . $i . '_personalstatus'} . '_' . ${'app' . $i . '_personalid'} . '.png')) {
                ${'app' . $i . '_ttd'} = '<img src="' . $base_url2 . 'utl/assets/ttd/' . ${'app' . $i . '_personalstatus'} . '_' . ${'app' . $i . '_personalid'} . '.png" ' . $style_ttd . ' alt="">';
            } else if (${'app' . $i . '_status'} == '1' && ${'app' . $i . '_personalstatus'} == '1' && file_exists($fcpath2 . 'forviewfoto_pekerja/' . ${'app' . $i . '_personalid'} . '_0_0.png')) {
                ${'app' . $i . '_ttd'} = '<img src="' . $base_url2 . 'forviewfoto_pekerja/' . ${'app' . $i . '_personalid'} . '_0_0.png" ' . $style_ttd . ' alt="">';
            } else if (${'app' . $i . '_status'} == '2' && ${'app' . $i . '_personalstatus'} == '2' && file_exists($fcpath2 . 'forviewfoto_pekerja/TTD_TK/' . ${'app' . $i . '_personalid'} . '.png')) {
                ${'app' . $i . '_ttd'} = '<img src="' . $base_url2 . 'forviewfoto_pekerja/TTD_TK/' . ${'app' . $i . '_personalid'} . '.png" ' . $style_ttd . ' alt="">';
            } else if (${'app' . $i . '_status'} == '1' && file_exists($fcpath2 . 'forviewfoto_pekerja/TTD_KRY/' . ${'app' . $i . '_personalid'} . '_0_0.png')) {
                ${'app' . $i . '_ttd'} = '<img src="' . $base_url2 . 'forviewfoto_pekerja/TTD_KRY/' . ${'app' . $i . '_personalid'} . '_0_0.png" ' . $style_ttd . ' alt="">';
            } else {
                if (${'app' . $i . '_status'} == '1') {
                    ${'app' . $i . '_ttd'} = '<img src="' . base_url('assets/images/approved.png') . '" width="200" height="200" background-size:100%;" alt="">';
                } else {
                    ${'app' . $i . 'ttd'} = '';
                    $kategori_status_detail = 'Non Shift';
                }
            }
            if (isset($dtheader_row->status_detail_sf1) || isset($dtheader_row->status_detail_sf2) || isset($dtheader_row->status_detail_sf3)) {
                $kategori_status_detail = 'Shift';
            } else {
                $kategori_status_detail = 'Non Shift';
            }
        }
    }

    // if ($app1_status == '1') {
    //     $app1_ttd = '<img src="' . base_url('assets/images/approved.png') . '" width="200" height="200" background-size:100%;" alt="">';
    // } else {
    //     $app1_ttd = '';
    // }

    switch (true) {
            // form shift opr + shift kr + 2 app (total 8 app)
        case $frmkd == 'frmfss315': ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh shift 1,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh shift 2,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh shift 3,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Diketahui oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                    <td colspan="2"><?= $app3_ttd ?></td>
                                    <td colspan="2"><?= $app4_ttd ?></td>
                                    <td colspan="2"><?= $app5_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app3_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app4_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app5_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app3_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app4_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app5_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app3_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app3_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app4_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app4_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app5_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app5_date)) : '' ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;

        case $frmkd == 'frmfss316': ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Diketahui oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                    <td colspan="2"><?= $app3_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app3_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app3_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app3_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app3_date)) : '' ?></td>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;

        case $frmkd == 'frmfss317': ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Diketahui oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                    <td colspan="2"><?= $app3_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app3_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app3_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app3_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app3_date)) : '' ?></td>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;

        case $frmkd == 'frmfss031': ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;


        case $frmkd == 'frmfss319': ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Diketahui oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                    <td colspan="2"><?= $app3_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app3_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app3_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app3_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app3_date)) : '' ?></td>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;

        case $frmkd == 'frmfss318':
        case $frmkd == 'frmfss520':
        ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh shift 1,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh shift 2,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh shift 3,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Diketahui oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                    <td colspan="2"><?= $app3_ttd ?></td>
                                    <td colspan="2"><?= $app4_ttd ?></td>
                                    <td colspan="2"><?= $app5_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app3_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app4_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app5_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app3_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app4_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app5_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app3_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app3_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app4_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app4_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app5_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app5_date)) : '' ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;


        case $frmkd == 'intwtd014': ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh shift 1,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh shift 2,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh shift 3,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Diketahui oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                    <td colspan="2"><?= $app3_ttd ?></td>
                                    <td colspan="2"><?= $app4_ttd ?></td>
                                    <td colspan="2"><?= $app5_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app3_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app4_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app5_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app3_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app4_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app5_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app3_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app3_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app4_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app4_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app5_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app5_date)) : '' ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;
        case $frmkd == 'intwtd017': ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh shift 1,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh shift 2,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh shift 3,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Diketahui oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                    <td colspan="2"><?= $app3_ttd ?></td>
                                    <td colspan="2"><?= $app4_ttd ?></td>
                                    <td colspan="2"><?= $app5_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app3_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app4_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app5_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app3_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app4_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app5_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app3_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app3_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app4_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app4_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app5_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app5_date)) : '' ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;
        case $frmkd == 'inttbn040': ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">SHIFT PAGI</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">SHIFT SORE</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">SHIFT MALAM</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">DIKETAHUI</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">DISETUJUI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                    <td colspan="2"><?= $app3_ttd ?></td>
                                    <td colspan="2"><?= $app4_ttd ?></td>
                                    <td colspan="2"><?= $app5_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app3_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app4_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app5_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app3_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app4_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app5_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app3_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app3_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app4_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app4_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app5_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app5_date)) : '' ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;


        case $frmkd == 'frmfss188': ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Diperiksa oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;


        case $frmkd == 'frmfss031': ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;


        case $frmkd == 'frmfss062':
        case $frmkd == 'frmfss060':
        ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;
        case $frmkd == 'frmfss812': ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dilaporkan oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;
        case $frmkd == 'inttbn022':
        ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">SHIFT I</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">SHIFT II</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">SHIFT III</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Known by</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Approved by</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                    <td colspan="2"><?= $app3_ttd ?></td>
                                    <td colspan="2"><?= $app4_ttd ?></td>
                                    <td colspan="2"><?= $app5_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Name</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Name</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                    <td style="text-align: left">Name</td>
                                    <td style="text-align: left">: <?= $app3_by; ?></td>
                                    <td style="text-align: left">Name</td>
                                    <td style="text-align: left">: <?= $app4_by; ?></td>
                                    <td style="text-align: left">Name</td>
                                    <td style="text-align: left">: <?= $app5_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Position</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Position</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                    <td style="text-align: left">Position</td>
                                    <td style="text-align: left">: <?= $app3_position; ?></td>
                                    <td style="text-align: left">Position</td>
                                    <td style="text-align: left">: <?= $app4_position; ?></td>
                                    <td style="text-align: left">Position</td>
                                    <td style="text-align: left">: <?= $app5_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Date</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Date</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                    <td style="text-align: left">Date</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app3_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app3_date)) : '' ?></td>
                                    <td style="text-align: left">Date</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app4_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app4_date)) : '' ?></td>
                                    <td style="text-align: left">Date</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app5_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app5_date)) : '' ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;
        case $frmkd == 'inttbn020':
        ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat Oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Diketahui Oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui Oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                    <td colspan="2"><?= $app3_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app3_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app3_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app3_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app3_date)) : '' ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;
        case $frmkd == 'intwtd032':
        ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dibuat Oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Diketahui Oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui Oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td colspan="2"><?= $app1_ttd ?></td>
                                    <td colspan="2"><?= $app2_ttd ?></td>
                                    <td colspan="2"><?= $app3_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app3_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app3_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app3_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app3_date)) : '' ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="16"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php
            break;
        default:  // default di deklar 3 app aja yak 
        ?>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" border="6">
                            <thead style="text-align: center;" class="bg-gradient-light">
                                <tr>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Dilaporkan Oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Diketahui Oleh,</th>
                                    <th class="align-middle text-center" rowspan="1" colspan="2">Disetujui Oleh,</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: center;" colspan="2"><?= $app1_ttd ?></td>
                                    <td style="text-align: center;" colspan="2"><?= $app2_ttd ?></td>
                                    <td style="text-align: center;" colspan="2"><?= $app3_ttd ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app1_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app2_by; ?></td>
                                    <td style="text-align: left">Nama</td>
                                    <td style="text-align: left">: <?= $app3_by; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app1_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app2_position; ?></td>
                                    <td style="text-align: left">Jabatan</td>
                                    <td style="text-align: left">: <?= $app3_position; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app1_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app1_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app2_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app2_date)) : '' ?></td>
                                    <td style="text-align: left">Tanggal</td>
                                    <td style="text-align: left">: <?= date("d-m-Y", strtotime($app3_date)) != '01-01-1970' ? date("d-m-Y", strtotime($app3_date)) : '' ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-light">
                                    <th colspan="6"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php break;
    }

    if ((!empty($app_pos)) || (!empty($app_pos2))) {

        $app_pos = !empty($app_pos2) ? 'app' . $app_pos2 : $app_pos;

        if (empty(${$app_pos . '_status'})) { ?>
            <div class="row justify-content-center">
                <div class="col-5">
                    <form action="<?= base_url('approval/C_approval/approve/' . $frmkd . '/' . $frmvrs) ?>" id="form_app" name="form_app" method="post" role="form_app" class="form-horizontal">
                        <input type="hidden" name="headerid" value="<?= $headerid ?>" />
                        <input type="hidden" name="app_by" value="<?= $nmlengkap ?>" />
                        <input type="hidden" name="app_date" value="<?= date('Y-m-d') ?>" />
                        <input type="hidden" name="app_time" value="<?= date('H:i:s') ?>" />
                        <input type="hidden" name="app_position" value="<?= $app_pos ?>" />
                        <input type="hidden" name="app_position2" value="<?= $app_pos2 ?>" />
                        <input type="hidden" name="personalid" value="<?= $personalid ?>" />
                        <input type="hidden" name="personalstatus" value="<?= $personalstatus ?>" />

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" border="6">
                                <thead style="text-align: center;" class="bg-gradient-light">
                                    <tr>
                                        <th class="align-middle text-center" rowspan="1" colspan="1">Komentar :</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><textarea class="form-control" rows="5" name="comment" id="comment"></textarea></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gradient-light">
                                        <th style="text-align: center;">
                                            <button type="submit" class="btn bg-gradient-danger" name="btnproses" value="btn_disapp" onclick="return confirm('Disapprove Laporan?');">Disapprove</button>
                                            <button type="submit" class="btn bg-gradient-success" name="btnproses" value="btn_app" onclick="return confirm('Approve Laporan?')">Approve</button>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </form>
                </div>
            </div>
<?php }
    }
}
?>