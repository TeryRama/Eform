<?php
foreach ($dtfrm as $dt_form) {
    $frmjdl  = $dt_form->formjudul;
    $frmefec = $dt_form->formefective;
    $frmkd   = $dt_form->formkd;
    $frmvrs  = $dt_form->formversi;
    $frmnm   = $dt_form->formnm;
}
switch ($frmkd && $frmvrs) {

    case $frmkd == 'frmfss315': ?>
        <div class="row">
            <div class="col-12">
                <table class="table table-condensed table-borderless">
                    <tr>
                        <td style="text-align:left;"><b>Definisi :</b></td>
                        <td style="text-align:left;">WTD</td>
                        <td style="text-align:left;">= Water Treatment</td>
                        <td style="text-align:left;">ASF</td>
                        <td style="text-align:left;">= After Sand Filter</td>
                        <td style="text-align:left;">Kg</td>
                        <td style="text-align:left;">= Kilo Gram</td>
                        <td style="text-align:left;">ACH</td>
                        <td style="text-align:left;">= Alumunium Chloro Hydrate</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;"></td>
                        <td style="text-align:left;">M3</td>
                        <td style="text-align:left;">= Meter kubik</td>
                        <td style="text-align:left;">ACF</td>
                        <td style="text-align:left;">= After Carbon Filter</td>
                        <td style="text-align:left;">AST</td>
                        <td style="text-align:left;">= After Water Softener</td>
                        <td style="text-align:left;">BSF</td>
                        <td style="text-align:left;">= Before Sand Filter</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;"></td>
                        <td style="text-align:left;">FM</td>
                        <td style="text-align:left;">= Flow Meter</td>
                        <td style="text-align:left;">ARO</td>
                        <td style="text-align:left;">= After Reverse Osmosis</td>
                        <td style="text-align:left;">MC</td>
                        <td style="text-align:left;">= Membran Cleaner</td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:left;"></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php break;

    case $frmkd == 'frmfss317': ?>
        <div class="row mt-3">
            <div class="col-4">
                <strong>Definisi :</strong>
                <table class="table table-condensed table-borderless">
                    <tr>
                        <td style="text-align:left;">RO</td>
                        <td style="text-align:left;">: Reverse Osmosis</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">ACF</td>
                        <td style="text-align:left;">: After carbon Filter </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">M3</td>
                        <td style="text-align:left;">: Meter Kubik</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">Eff</td>
                        <td style="text-align:left;">: Effisiensi</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">RW</td>
                        <td style="text-align:left;">: Raw Water</td>
                    </tr>
                </table>
            </div>
        </div>
    <?php break;

    case $frmkd == 'frmfss188': ?>
        <div class="row mt-3">
            <div class="col-12">
                <strong>Definisi :</strong>
                <table class="table table-condensed table-borderless">
                    <tr>
                        <td style="text-align:left;">*) : Di isi gagal atau lulus (Jika gagal catat ulang <b>Kegiatan Pembersihan</b> sampai verfikasi Lulus</td>
                    </tr>
                </table>
            </div>
        </div>
    <?php break;

    case $frmkd == 'intwtd016': ?>
        <div class="row mt-3">
            <div class="col-12">
                <strong>Note :</strong>
                <table class="table table-condensed table-borderless">
                    <tr>
                        <td style="text-align:left;">- Sch harus dilaksanakan,jika tertunda/maju di tulis, alasan harus jelas, sesuai waktu pelaksanaannya</td>
                    </tr>
                </table>
            </div>
        </div>
    <?php break;

    case $frmkd == 'frmfss812': 
    case $frmkd == 'intwtd005': 
    ?>
        <div class="row mt-3">
            <div class="col-12">
                <strong>Di Isi Dengan :</strong>
                <table class="table table-condensed table-borderless">
                    <tr>
                        <td style="text-align:left;">NA</td>
                        <td style="text-align:left;">: Not Applicable</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">&#10004;</td>
                        <td style="text-align:left;">: Baik/Normal</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">Δ</td>
                        <td style="text-align:left;">: Ada Masalah Langsung Action </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">&#10006;</td>
                        <td style="text-align:left;">: Ada Masalah Tertunda</td>
                    </tr>
                </table>
            </div>
        </div>
    <?php break;

    case $frmkd == 'frmfss065': 
    ?>
        <div class="row mt-3">
            <div class="col-12">
                <strong>Keterangan :</strong>
                <table class="table table-condensed table-borderless">
                    <tr>
                        <td style="text-align:left;">Unplanned</td>
                        <td style="text-align:left;"> : Perbaikan tidak Direncanakan</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">Planned</td>
                        <td style="text-align:left;"> : Perbaikan yang Direncanakan</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">Beri Tanda &#10004; pada salah satu kolom Unplanned/Planned</td>
                    </tr>
                </table>
            </div>
        </div>
    <?php break;

    case $frmkd == 'inttbn022': ?>
        <div class="row">
            <div class="col-12">
                <strong>Notifications :</strong>
                <table class="table table-condensed table-borderless">
                    <tr>
                        <td style="width: 1%;"><button style="background-color: #3498DB;" class="btn"></button></td>
                        <td>: Not analyzed</td>
                    </tr>
                    <tr>
                        <td><button style="background-color: #9B59B6;" class="btn"></button></td>
                        <td>: Analysis once a month</td>
                    </tr>
                </table>
            </div>
        </div>
    <?php break;

    case $frmkd == 'inttbn020': ?>
        <div class="row">
            <div class="col-md-3">
                <table>
                    <tr>
                        <th>Catatan :</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td>NaOH (Soda Kaustik)</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp;</td>
                        <td>25 Kg/ Sak</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>HCL (Asam Klorida) Drum</td>
                        <td></td>
                        <td>250 Kg/ Drum</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Nalco 2556</td>
                        <td></td>
                        <td>25 Kg/ Jrg</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Nalco 3273</td>
                        <td></td>
                        <td>15 Kg/ Jrg</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Hydro 606</td>
                        <td></td>
                        <td>200 Kg/ Drum</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Hydro 379</td>
                        <td></td>
                        <td>20 Kg/ Pail</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Hydro 377</td>
                        <td></td>
                        <td>200 Kg/ Drum</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Hydro 280</td>
                        <td></td>
                        <td>200 Kg/ Drum</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Hydro 277</td>
                        <td></td>
                        <td>200 Kg/ Drum</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Hydro 566</td>
                        <td></td>
                        <td>200 Kg/ Drum</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Hydro 600</td>
                        <td></td>
                        <td>200 Kg/ Drum</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Filter Cartridge</td>
                        <td></td>
                        <td>Pcs</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Hydro 200</td>
                        <td></td>
                        <td>25 Kg/ Jrg</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table>
                    <tr>
                        <th>Keterangan : </th>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pemakaian bahan kimia dan air tergantung operasional steam dan operasioanal demin di wt turbin.</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pemakaian bahan kimia terdiri dari pemakaian bahan kimia untuk cooling tower, operasional boiler, dan operasional demin.</td>
                    </tr>
                </table>
            </div>
        </div>
<?php break;

    default:
        break;
} ?>