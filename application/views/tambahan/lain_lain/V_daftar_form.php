<?php $this->load->view('template/headbar'); ?>

<!-- Content Header (Page header) -->
<!-- Main content -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12 mb-1">
            <h4 class="text-uppercase">DAFTAR FORM MPD</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-content">
                    <?php if (empty($daftar_form)) { echo "Tidak ada data!!";} else { 
                        foreach($daftar_form as $daftar_form1){ ?>
                            <div class="card-body">
                                    <div  class="table-responsive">
                                        <table class="table sticky-header">
                                            <thead class="bg-gradient-dark">
                                                <tr>
                                                    <th colspan="13" style="text-align: center; font-size: 16px"><?php echo $daftar_form1->formjnsnm;?></th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center; font-size: 16px"><?php if(isset($daftar_form1->children5)){echo 'Form Bagian';print_r($daftar_form1->children5);}else{echo 'Form Bagian';}?></th>
                                                    <th style="text-align: center; font-size: 16px">Form Kategori</th>
                                                    <th style="text-align: center; font-size: 16px">Form Sub Kategori</th>
                                                    <th style="text-align: center; font-size: 16px">Form Nama</th>
                                                    <th style="text-align: center; font-size: 16px">Form Versi</th>
                                                    <th style="text-align: center; font-size: 16px">Form Judul</th>
                                                    <th style="text-align: center; font-size: 16px">Form Status</th>
                                                    <th style="text-align: center; font-size: 16px">Form Input Status</th>
                                                    <th style="text-align: center; font-size: 16px">Form Data Harian Status</th>
                                                    <th style="text-align: center; font-size: 16px">Form Laporan Status</th>
                                                    <th style="text-align: center; font-size: 16px">Form Approval Status</th>
                                                    <th style="text-align: center; font-size: 16px">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($daftar_form1->children)) {
                                                    foreach($daftar_form1->children as $child){
                                                        if (isset($child->children2)) {
                                                            foreach($child->children2 as $child2){
                                                                if (isset($child2->children3)) {
                                                                    foreach($child2->children3 as $child3){

                                                                        if($child3->formstatus=='0'){
                                                                            $stform = 'Not Active';
                                                                        }elseif($child3->formstatus=='1'){
                                                                            $stform = 'Active';
                                                                        }else{
                                                                            $stform = $child3->formstatus;
                                                                        }

                                                                        if($child3->status_input=='0'){
                                                                            $stinput = '-';
                                                                        }elseif($child3->status_input=='1'){
                                                                            $stinput = '&#10004';
                                                                        }else{
                                                                            $stinput = $child3->status_input;
                                                                        }

                                                                        if($child3->status_dataharian=='0'){
                                                                            $stdh = '-';
                                                                        }elseif($child3->status_dataharian=='1'){
                                                                            $stdh = '&#10004';
                                                                        }else{
                                                                            $stdh = $child3->status_dataharian;
                                                                        }

                                                                        if($child3->status_lap=='0'){
                                                                            $stlap = '-';
                                                                        }elseif($child3->status_lap=='1'){
                                                                            $stlap = '&#10004';
                                                                        }else{
                                                                            $stlap = $child3->status_lap;
                                                                        }

                                                                        if($child3->status_app=='0'){
                                                                            $stapp = '-';
                                                                        }elseif($child3->status_app=='1'){
                                                                            $stapp = '&#10004';
                                                                        }else{
                                                                            $stapp = $child3->status_app;
                                                                        }   

                                                                        echo '<tr>';
                                                                            echo '<td align="center">'.$daftar_form1->formjnsnm.'</td>';
                                                                            echo '<td align="center">'.$child->formkategorinm.'</td>';
                                                                            echo '<td align="center">'.$child2->formkategori2nm.'</td>';
                                                                            echo '<td align="center">'.$child3->formnm.'</td>';
                                                                            echo '<td align="center">'.$child3->formversi.'</td>';
                                                                            echo '<td style="text-align:left;">'.$child3->formjudul.'</td>';
                                                                            echo '<td align="center">'.$stform.'</td>';
                                                                            echo '<td align="center">'.$stinput.'</td>';
                                                                            echo '<td align="center">'.$stdh.'</td>';
                                                                            echo '<td align="center">'.$stlap.'</td>';
                                                                            echo '<td align="center">'.$stapp.'</td>';
                                                                            echo '<td align="center">'.$child3->formket.'</td>';
                                                                        echo '</tr>';
                                                                    } 
                                                                }else{
                                                                /*===== NO $child2->children3 ===== DISINIIIII*/
                                                                    foreach($child->children4 as $child4){
                                                                        var_dump ($child2->children3);die;

                                                                        if($child4->formstatus=='0'){
                                                                            $stform = 'Not Active';
                                                                        }elseif($child4->formstatus=='1'){
                                                                            $stform = 'Active';
                                                                        }else{
                                                                            $stform = $child4->formstatus;
                                                                        }

                                                                        if($child4->status_input=='0'){
                                                                            $stinput = '-';
                                                                        }elseif($child4->status_input=='1'){
                                                                            $stinput = '&#10004';
                                                                        }else{
                                                                            $stinput = $child4->status_input;
                                                                        }

                                                                        if($child4->status_dataharian=='0'){
                                                                            $stdh = '-';
                                                                        }elseif($child4->status_dataharian=='1'){
                                                                            $stdh = '&#10004';
                                                                        }else{
                                                                            $stdh = $child4->status_dataharian;
                                                                        }

                                                                        if($child4->status_lap=='0'){
                                                                            $stlap = '-';
                                                                        }elseif($child4->status_lap=='1'){
                                                                            $stlap = '&#10004';
                                                                        }else{
                                                                            $stlap = $child4->status_lap;
                                                                        }

                                                                        if($child4->status_app=='0'){
                                                                            $stapp = '-';
                                                                        }elseif($child4->status_app=='1'){
                                                                            $stapp = '&#10004';
                                                                        }else{
                                                                            $stapp = $child4->status_app;
                                                                        }

                                                                        echo '<tr>';
                                                                            echo '<td align="center">'.$daftar_form1->formjnsnm.'</td>';
                                                                            echo '<td align="center">'.$child->formkategorinm.'</td>';
                                                                            echo '<td align="center">'.$child2->formkategori2nm.'</td>';
                                                                            echo '<td align="center">'.$child4->formkd.'</td>';
                                                                            echo '<td align="center">'.$child4->formversi.'</td>';
                                                                            echo '<td style="text-align:left;">'.$child4->formjudul.'</td>';
                                                                            echo '<td align="center">'.$stform.'</td>';
                                                                            echo '<td align="center">'.$stinput.'</td>';
                                                                            echo '<td align="center">'.$stdh.'</td>';
                                                                            echo '<td align="center">'.$stlap.'</td>';
                                                                            echo '<td align="center">'.$stapp.'</td>';
                                                                            echo '<td align="center">'.$child4->formket.'</td>';
                                                                        echo '</tr>';
                                                                    }
                                                                }
                                                            } 
                                                        }else{
                                                            /*===== NO $child->children2 =====*/
                                                            foreach($child->children4 as $child4){
                                                                if($child4->formstatus=='0'){
                                                                    $stform = 'Not Active';
                                                                }elseif($child4->formstatus=='1'){
                                                                    $stform = 'Active';
                                                                }else{
                                                                    $stform = $child4->formstatus;
                                                                }

                                                                if($child4->status_input=='0'){
                                                                    $stinput = '-';
                                                                }elseif($child4->status_input=='1'){
                                                                    $stinput = '&#10004';
                                                                }else{
                                                                    $stinput = $child4->status_input;
                                                                }

                                                                if($child4->status_dataharian=='0'){
                                                                    $stdh = '-';
                                                                }elseif($child4->status_dataharian=='1'){
                                                                    $stdh = '&#10004';
                                                                }else{
                                                                    $stdh = $child4->status_dataharian;
                                                                }

                                                                if($child4->status_lap=='0'){
                                                                    $stlap = '-';
                                                                }elseif($child4->status_lap=='1'){
                                                                    $stlap = '&#10004';
                                                                }else{
                                                                    $stlap = $child4->status_lap;
                                                                }

                                                                if($child4->status_app=='0'){
                                                                    $stapp = '-';
                                                                }elseif($child4->status_app=='1'){
                                                                    $stapp = '&#10004';
                                                                }else{
                                                                    $stapp = $child4->status_app;
                                                                }

                                                                echo '<tr>';
                                                                    echo '<td align="center">'.$daftar_form1->formjnsnm.'</td>';
                                                                    echo '<td align="center">'.$child->formkategorinm.'</td>';
                                                                    echo '<td align="center">'.$child2->formkategori2nm.'</td>';
                                                                    echo '<td align="center">'.$child4->formkd.'</td>';
                                                                    echo '<td align="center">'.$child4->formversi.'</td>';
                                                                    echo '<td style="text-align:left;">'.$child4->formjudul.'</td>';
                                                                    echo '<td align="center">'.$stform.'</td>';
                                                                    echo '<td align="center">'.$stinput.'</td>';
                                                                    echo '<td align="center">'.$stdh.'</td>';
                                                                    echo '<td align="center">'.$stlap.'</td>';
                                                                    echo '<td align="center">'.$stapp.'</td>';
                                                                    echo '<td align="center">'.$child4->formket.'</td>';
                                                                echo '</tr>';
                                                            }
                                                        }
                                                    } 
                                                }else{
                                                    /*===== NO $daftar_form1->children =====*/
                                                    foreach($daftar_form1->children5 as $child5){
                                                        if($child5->formstatus=='0'){
                                                            $stform = 'Not Active';
                                                        }elseif($child5->formstatus=='1'){
                                                            $stform = 'Active';
                                                        }else{
                                                            $stform = $child5->formstatus;
                                                        }

                                                        if($child5->status_input=='0'){
                                                            $stinput = '-';
                                                        }elseif($child5->status_input=='1'){
                                                            $stinput = '&#10004';
                                                        }else{
                                                            $stinput = $child5->status_input;
                                                        }

                                                        if($child5->status_dataharian=='0'){
                                                            $stdh = '-';
                                                        }elseif($child5->status_dataharian=='1'){
                                                            $stdh = '&#10004';
                                                        }else{
                                                            $stdh = $child5->status_dataharian;
                                                        }

                                                        if($child5->status_lap=='0'){
                                                            $stlap = '-';
                                                        }elseif($child5->status_lap=='1'){
                                                            $stlap = '&#10004';
                                                        }else{
                                                            $stlap = $child5->status_lap;
                                                        }

                                                        if($child5->status_app=='0'){
                                                            $stapp = '-';
                                                        }elseif($child5->status_app=='1'){
                                                            $stapp = '&#10004';
                                                        }else{
                                                            $stapp = $child5->status_app;
                                                        }

                                                        echo '<tr>';
                                                            echo '<td align="center">'.$daftar_form1->formjnsnm.'</td>';
                                                            echo '<td align="center">'.$child->formkategorinm.'</td>';
                                                            echo '<td align="center">'.$child2->formkategori2nm.'</td>';
                                                            echo '<td align="center">'.$child5->formkd.'</td>';
                                                            echo '<td align="center">'.$child5->formversi.'</td>';
                                                            echo '<td style="text-align:left;">'.$child5->formjudul.'</td>';
                                                            echo '<td align="center">'.$stform.'</td>';
                                                            echo '<td align="center">'.$stinput.'</td>';
                                                            echo '<td align="center">'.$stdh.'</td>';
                                                            echo '<td align="center">'.$stlap.'</td>';
                                                            echo '<td align="center">'.$stapp.'</td>';
                                                            echo '<td align="center">'.$child5->formket.'</td>';
                                                        echo '</tr>';

                                                    }
                                                }
                                            ?>
                                            </tbody>
                                            <tfoot class="bg-gradient-dark">
                                                <tr>
                                                    <td colspan="20"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                        <?php } 
                    } ?>
                </div>
            </div>
        </div>
    </div>

</section><!-- /.content -->

<?php $this->load->view('template/footbar'); ?>

<!-- DATA TABES SCRIPT -->
<!-- <script src="<?php //echo base_url('assets/fixedtblhdrlftcol/jquery.fixedTblHdrLftCol.js')?>" type="text/javascript"></script>
 -->

<!-- page script -->

<!-- <script>
      $(function() {
        $('table').fixedTblHdrLftCol({
          scroll: {
            height: '200px',
            width: '550px'
          }
        });
      });
    </script> -->

<?php $this->load->view('template/footbarend'); ?>