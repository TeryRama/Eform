<?php

class C_tambahan_test extends CI_Controller {

    var $data = array();

    function __construct() {
        parent:: __construct();
        $this->load->helper('form', 'url');
        $this->load->model(array('M_user','M_menu','form_input/M_forminput','tambahan/M_tambahan'));

    }

    function get_element(){
        $dtjns_produk    = $this->input->post('jns_produk');
        $dtnm_jns_produk = $this->input->post('nm_jns_produk');

        switch($dtnm_jns_produk){
            case $dtnm_jns_produk=='CWB':
                $nm_jns_produk = 'CWB';
            break;
            case $dtnm_jns_produk=='CWB':
                 $nm_jns_produk = 'CMB';
            break;
            default:
                $nm_jns_produk = $dtnm_jns_produk;
            break;
        }

        switch($dtjns_produk){
            case $dtjns_produk=='Finished Product' || $dtjns_produk=='Single Strength':
                switch($dtnm_jns_produk){
                    case $dtnm_jns_produk=='CWB':
                        $data1 = "<input type='text' id='product_id'  class='product_id  name='product_id[]'/>";
                        $data2 = "ID Produk";
                        $data3 = "<input type='text' id='formula' class='formula'  name='formula[]'/>";
                        $data4 = "Formula";
                    break;
                    case $dtnm_jns_produk=='CMB':
                        $data1 = "<input type='text' id='product_id' class='formula'   name='product_id[]'/>";
                        $data2 = "ID Produk";
                        $data3 = "<input type='text' id='formula'  name='formula[]'/>";
                        $data4 = "Formula";
                    break;
                    default:
                        $data1 = "";
                        $data2 = "";
                        $data3 = "";
                        $data4 = "";
                    break;
                }
            break;
            default:
                $data1 = "";
                $data2 = "";
                $data3 = "";
                $data4 = "";
            break;
        }

        $data_element = $data1.",".$data2.",".$data3.",".$data4;
        echo $data_element;
    }

   function getFormKat(){

        $fjnsid = $this->input->post('formjnsid');

        $frmjns = $this->M_form->getFormKat($fjnsid);
        $data .= "<option value=''>--pilih--</option>";
        foreach($frmjns as $row){
            $data .= "<option value=".$row[formkategoriid].">$row[formkategorinm]</option>\n";
        }
        echo $data;
    }



    function get_hasilN(){
        $tgltest = trim($this->input->post('tgl_dok'));

        $dttest  = $this->M_tambahan->getdata_agno3($tgltest);
        $dttest2 = $this->M_tambahan->getdata_na2edta($tgltest);
        $dttest3 = $this->M_tambahan->getdata_hcl002($tgltest);
        $dttest4 = $this->M_tambahan->getdata_kio32083($tgltest);
        $dttest5 = $this->M_tambahan->getdata_naoh00100($tgltest);
        foreach($dttest as $row){
            $data1 .= "<option value=".$row[hasil_m].">$row[hasil_m]</option>";
            $data3 .= $row[hasil_m];
        }
        foreach($dttest2 as $row2){
            $data2 .= "<option value=".$row2[hasil_m].">$row2[hasil_m]</option>";
            $data4 .= $row2[hasil_m];
        }
        foreach($dttest3 as $row3){
            $data5 .= $row3[hasil_m];
        }
        foreach($dttest4 as $row4){
            $data6 .= $row4[hasil_m];
        }
        foreach($dttest5 as $row5){
            $data7 .= $row5[hasil_m];
        }
        $datas =  $data1.",".$data2.",".$data3.",".$data4.",".$data5.",".$data6.",".$data7;
        echo $datas;
    }

    function get_hasilN141(){
        $tgltest = trim($this->input->post('tanggal_produksi'));

        $dttest1 = $this->M_tambahan->getdata_naoh00100($tgltest);
        foreach($dttest1 as $row){
            $data1 = $row["hasil_m"];
        }
        $datas =  $data1;
        echo $datas;
    }

    function get_hasilNM(){
        $tgltest = trim($this->input->post('tgl_produksi'));

        $dt_na2s2o3 = $this->M_tambahan->getdata_na2s2o3($tgltest);
        $dt_naoh = $this->M_tambahan->getdata_naoh($tgltest);

        foreach($dt_na2s2o3 as $row){
            $data1 .= "<option value=".$row[hasil_m].">$row[hasil_m]</option>";
            $data2 .= $row[hasil_m];
        }

        foreach($dt_naoh as $row2){
            $data3 .= $row2[hasil_m];
        }

        $datas =  $data1.",".$data2.",".$data3;
        echo $datas;
    }

    function get_hasil_std_lqs087_lqs088(){
        $tgltest = trim($this->input->post('tgl_produksi'));

        $dt_na2s2o3 = $this->M_tambahan->getdata_na2s2o3_2($tgltest);
        $dt_naoh = $this->M_tambahan->getdata_naoh_2($tgltest);

        foreach($dt_na2s2o3 as $row){
            $data1 .= "<option value=".$row[hasil_m].">$row[hasil_m]</option>";
            $data2 .= $row[hasil_m];
        }

        foreach($dt_naoh as $row2){
            $data3 .= $row2[hasil_m];
        }

        $datas =  $data1.",".$data2.",".$data3;
        echo $datas;
    }

    function getNmBahan(){
        $id_larutan2 = $this->input->post('id_larutan2');

        $dtbahan = $this->M_forminput->getBahanUji($id_larutan2);
        $data .= "<option value=''>--pilih--</option>";
        foreach($dtbahan as $rowbhn){
            $data .= "<option value=".$rowbhn[bahan_penguji].">$rowbhn[bahan_penguji]</option>\n";
        }
        echo $data;
   }

   function get_FormKd(){

        $nm_lab = $this->input->post('nm_lab');

        $form_kode = $this->M_tambahan->get_form_kode($nm_lab);
        $data .= "<option value=''>--pilih--</option>";
        foreach($form_kode as $row){
            $data .= "<option value=".$row[formkode].">$row[formkode]</option>\n";
        }
        echo $data;
    }

    function getKodeSampleMikro(){
        $jenis_contoh = $this->input->post('jenis_contoh');
        $jenis_produk = $this->input->post('jenis_produk');

        switch($jenis_contoh){
            case $jenis_contoh=='Shelf Life':
                $data = "<input type='text' name='kode_sample[]'/>";
            break;
            case $jenis_contoh=='In-Proses':
                switch($jenis_produk){
                    case $jenis_produk=='Fruit Ice Pina' || $jenis_produk=='Fruit Ice Manggo' || $jenis_produk=='Fruit Ice Pink Guava' || $jenis_produk=='MAR' || $jenis_produk=='Simply Coconut' || $jenis_produk=='Lain-lain' :
                        $data = "<input type='text' name='kode_sample[]'/>";
                    break;
                    default:
                        $dtDivKdSampel = $this->M_tambahan->getDivKdSampel($jenis_contoh,$jenis_produk);
                        $data = "<select name='kode_sample[]'><option value=''>--pilih--</option>";
                        foreach($dtDivKdSampel as $rowDivKdSampel){
                            $data .= "<option value=".$rowDivKdSampel['nm_kd_samplemikro'].">$rowDivKdSampel[nm_kd_samplemikro]</option>\n";
                        }
                        $data .="</select>";
                    break;
                }
            break;
            case $jenis_contoh=='Produk Akhir':
                switch($jenis_produk){
                    case $jenis_produk=='Coconut Cream' || $jenis_produk=='Coconut Water Baverages' || $jenis_produk=='Single Strength' || $jenis_produk=='Shelf Life':
                        $dtDivKdSampel = $this->M_tambahan->getDivKdSampel($jenis_contoh,$jenis_produk);
                        $data = "<select name='kode_sample[]'><option value=''>--pilih--</option>";
                        foreach($dtDivKdSampel as $rowDivKdSampel){
                            $data .= "<option value=".$rowDivKdSampel['nm_kd_samplemikro'].">$rowDivKdSampel[nm_kd_samplemikro]</option>\n";
                        }
                        $data .="</select>";
                    break;
                    default:
                        $data = "<input type='text' name='kode_sample[]'/>";
                    break;
                }
            break;
            case $jenis_contoh=='Lain-lain':
                $data = "<input type='text' name='kode_sample[]'/>";
            break;
            default:
                $data = "<input type='text' name='kode_sample[]'/>";
            break;
        }
//        if($jenis_contoh=='Shelf Life'){
//            $data = "<input type='text' name='kode_sample[]'/>";
//        }elseif($jenis_contoh=='In Proses'){
//            if($jenis_produk=='Coconut Milk Powder'){
//                 $dtDivKdSampel = $this->M_tambahan->getDivKdSampel($jenis_contoh,$jenis_produk);
//                    $data = "<select name='kode_sample[]'><option value=''>--pilih--</option>";
//                    foreach($dtDivKdSampel as $rowDivKdSampel){
//                        $data .= "<option value=".$rowDivKdSampel['nm_kd_samplemikro'].">$rowDivKdSampel[nm_kd_samplemikro]</option>\n";
//                    }
//                    $data .="</select>";
//            }else{
//                 $data = "<input type='text' name='kode_sample[]'/>";
//            }
//        }else{
//            if($jenis_produk=='Lain-lain'){
//                $data = "<input type='text' name='kode_sample[]'/>";
//           }else{
//            $dtDivKdSampel = $this->M_tambahan->getDivKdSampel($jenis_contoh,$jenis_produk);
//            $data = "<select name='kode_sample[]'><option value=''>--pilih--</option>";
//            foreach($dtDivKdSampel as $rowDivKdSampel){
//                $data .= "<option value=".$rowDivKdSampel['nm_kd_samplemikro'].">$rowDivKdSampel[nm_kd_samplemikro]</option>\n";
//            }
//            $data .="</select>";
//            }
//       }
       echo $data;
    }

    ///////////////////////////////////////////////////////////////////
    ////////////////          LQS 082 dan 054 function  ///////////////
    ///////////////////////////////////////////////////////////////////

    // untuk kolom sulfur
    function get_hasilNaOH(){
        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $no_picno = trim($this->input->post('no_picno'));


        $jns_produk = trim($this->input->post('jns_produk'));
        $nm_jns_produk = trim($this->input->post('nm_jns_produk'));
        $nm_produk = trim($this->input->post('nm_produk'));

        switch($jns_produk && $nm_jns_produk){
            case $jns_produk=='In-Process' && $nm_jns_produk=='CWB':
                if($nm_produk=='Kara Coco' || $nm_produk=='The Coco Tree Original' || $nm_produk=='Aseptic Coconut Water - Single Strength' || $nm_produk=='Hydro Coco 100% CW Packing 330 mL'){
                    $dtnaoh = $this->M_tambahan->getdata_naoh2($tgltest);
                }else{
                    $dtnaoh = $this->M_tambahan->getdata_naoh2_mini($tgltest);
                }
            break;
            case $jns_produk=='In-Process' && $nm_jns_produk=='Raw Material':
                    $dtnaoh = $this->M_tambahan->getdata_naoh2_mini($tgltest);
            break;
            default:
                $dtnaoh = $this->M_tambahan->getdata_naoh2($tgltest);
            break;
        }

        // var_dump($dtnaoh);
        // print_r($dtnaoh);
        $data1 = 0;
        foreach($dtnaoh as $row){
            // $data1 += $row['hasil_m'];
            $data1 += floatval($row['hasil_m']);
        }

        $datanaoh =  $data1;
        echo $datanaoh;

    }

    function get_hasilNaOH084(){
        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $no_picno = trim($this->input->post('no_picno'));

        $dtnaoh = $this->M_tambahan->getdata_naoh2($tgltest);

        // var_dump($dtnaoh);
        // print_r($dtnaoh);
        $data1 = 0;
        foreach($dtnaoh as $row){
            // $data1 += $row['hasil_m'];
            $data1 += floatval($row['hasil_m']);
        }

        $datanaoh =  $data1;
        echo $datanaoh;

    }

    // untuk kolom acidity
    function get_hasilNaOH1000(){
        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $no_picno = trim($this->input->post('no_picno'));

        $jns_produk = trim($this->input->post('jns_produk'));
        $nm_jns_produk = trim($this->input->post('nm_jns_produk'));
        $nm_produk = trim($this->input->post('nm_produk'));

        switch($jns_produk && $nm_jns_produk){
            case $jns_produk=='In-Process' && $nm_jns_produk=='CWB':
                if($nm_produk=='Kara Coco' || $nm_produk=='The Coco Tree Original' || $nm_produk=='Aseptic Coconut Water - Single Strength'){
                    $dtnaoh = $this->M_tambahan->getdata_naoh1000($tgltest);
                }else{
                    $dtnaoh = $this->M_tambahan->getdata_naoh1000_mini($tgltest);
                }
            break;
            case $jns_produk=='In-Process' && $nm_jns_produk=='Raw Material':
                    $dtnaoh = $this->M_tambahan->getdata_naoh1000_mini($tgltest);
            break;
            default:
               $dtnaoh = $this->M_tambahan->getdata_naoh1000($tgltest);
            break;
        }


        // var_dump($dtnaoh);
        // print_r($dtnaoh);
        $data1 = 0;
        foreach($dtnaoh as $row){
            // $data1 += $row['hasil_m'];
            $data1 += floatval($row['hasil_m']);
        }

        $dataacidity =  $data1;
        echo $dataacidity;

    }

    function get_hasilNaOH5000(){
        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $no_picno = trim($this->input->post('no_picno'));

        $dtnaoh = $this->M_tambahan->getdata_naoh5000($tgltest);
        // var_dump($dtnaoh);
        // print_r($dtnaoh);
        $data1 = 0;
        foreach($dtnaoh as $row){
            // $data1 += $row['hasil_m'];
            $data1 += floatval($row['hasil_m']);
        }

        $datanaoh =  $data1;
        echo $datanaoh;

    }

    // untuk gravity wp

    function get_data_picno_kosong(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $no_picno = trim($this->input->post('no_picno'));

        $dtpicno = $this->M_tambahan->getdata_picno2($tgl_analisa,$no_picno);

        $data1 = 0;
        foreach($dtpicno as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['picno_kosong']);
            // $data2 += floatval($row['picno_hasil']);
        }

        $datawp =  $data1;
        echo $datawp;
    }

    // untuk gravity wa
    function get_data_picno_hasil(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $no_picno = trim($this->input->post('no_picno'));

        $dtpicno = $this->M_tambahan->getdata_picno2($tgl_analisa,$no_picno);

        $data1 = 0;
        foreach($dtpicno as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['picno_hasil']);
        }

        $datawa =  $data1;
        echo $datawa;
    }

    // untuk acidity
    function get_data_hasil_na2s2o3(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $no_picno = trim($this->input->post('no_picno'));

        $dtna2s2o3 = $this->M_tambahan->getdata_na2s2o3($tgltest);

        $data1 = 0;
        foreach($dtna2s2o3 as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['hasil_m']);
        }

        $dataacidity =  $data1;
        echo $dataacidity;
    }

    function get_data_hasil_na2s2o3puregene(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dtna2s2o3 = $this->M_tambahan->getdata_na2s2o3puregene($tgltest);

        $data1 = 0;
        foreach($dtna2s2o3 as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['hasil_m']);
        }

        $dataacidity =  $data1;
        echo $dataacidity;
    }

    function get_data_hasil_na2s2o3puregene2(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dtna2s2o3 = $this->M_tambahan->getdata_na2s2o3puregene2($tgltest);

        $data1 = 0;
        foreach($dtna2s2o3 as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['hasil_m']);
        }

        $dataacidity =  $data1;
        echo $dataacidity;
    }

    function get_data_hasil_hcl1m(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dthcl1m = $this->M_tambahan->getdata_hcl1m($tgltest);

        $data1 = 0;
        foreach($dthcl1m as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['hasil_m']);
        }

        $datahcl1m =  $data1;
        echo $datahcl1m;
    }

    function get_data_hasil_naoh1m(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dtnaoh1m = $this->M_tambahan->getdata_naoh1m($tgltest);

        $data1 = 0;
        foreach($dtnaoh1m as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['hasil_m']);
        }

        $datanaoh1m =  $data1;
        echo $datanaoh1m;
    }

    function get_hasilHCl1m(){
        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dtnaoh = $this->M_tambahan->getdata_hcl1000($tgltest);

        $data1 = 0;
        foreach($dtnaoh as $row){
            $data1 += floatval($row['hasil_m']);
        }

        $datahcl =  $data1;
        echo $datahcl;

    }

    function get_hasilNaOH5m(){
        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $no_picno = trim($this->input->post('no_picno'));

        $dtnaoh = $this->M_tambahan->getdata_naoh5000($tgltest);
        // var_dump($dtnaoh);
        // print_r($dtnaoh);
        $data1 = 0;
        foreach($dtnaoh as $row){
            // $data1 += $row['hasil_m'];
            $data1 += floatval($row['hasil_m']);
        }

        $datanaoh =  $data1;
        echo $datanaoh;

    }

    // untuk vitamin c
    function get_data_hasil_i2(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $no_picno = trim($this->input->post('no_picno'));

        $jns_produk = trim($this->input->post('jns_produk'));
        $nm_jns_produk = trim($this->input->post('nm_jns_produk'));
        $nm_produk = trim($this->input->post('nm_produk'));

        switch($jns_produk && $nm_jns_produk){
            case $jns_produk=='In-Process' && $nm_jns_produk=='CWB':
                if($nm_produk=='Kara Coco' || $nm_produk=='The Coco Tree Original' || $nm_produk=='Aseptic Coconut Water - Single Strength'){
                    $dti2 = $this->M_tambahan->getdata_i2($tgltest);
                }else{
                    $dti2 = $this->M_tambahan->getdata_i2_mini($tgltest);
                }
            break;
            case $jns_produk=='In-Process' && $nm_jns_produk=='Raw Material':
                   $dti2 = $this->M_tambahan->getdata_i2_mini($tgltest);
            break;
            default:
                $dti2 = $this->M_tambahan->getdata_i2($tgltest);
            break;
        }



        $data1 = 0;
        foreach($dti2 as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['hasil_m']);
        }

        $datavitc =  $data1;
        echo $datavitc;
    }

    // untuk chloride
    function get_data_hasil_chlo(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $no_picno = trim($this->input->post('no_picno'));

        $jns_produk = trim($this->input->post('jns_produk'));
        $nm_jns_produk = trim($this->input->post('nm_jns_produk'));
        $nm_produk = trim($this->input->post('nm_produk'));

        switch($jns_produk && $nm_jns_produk){
            case $jns_produk=='In-Process' && $nm_jns_produk=='CWB':
                if($nm_produk=='Kara Coco' || $nm_produk=='The Coco Tree Original' || $nm_produk=='Aseptic Coconut Water - Single Strength'){
                    $dtclo = $this->M_tambahan->getdata_agno3_chlo($tgltest);
                }else{
                    $dtclo = $this->M_tambahan->getdata_agno3_chlo_mini($tgltest);
                }
            break;
            case $jns_produk=='In-Process' && $nm_jns_produk=='Raw Material':
                   $dtclo = $this->M_tambahan->getdata_agno3_chlo_mini($tgltest);
            break;
            default:
                $dtclo = $this->M_tambahan->getdata_agno3_chlo($tgltest);
            break;
        }

        $data1 = 0;
        foreach($dtclo as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['hasil_m']);
        }

        $datachlo =  $data1;
        echo $datachlo;
    }

    function get_hasilHCl(){
        $tanggal = trim($this->input->post('tanggal'));
        $dt_tgltest = trim($this->input->post('tanggal'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dtnaoh = $this->M_tambahan->getdata_hcl1000($tgltest);

        $data1 = 0;
        foreach($dtnaoh as $row){
            $data1 += floatval($row['hasil_m']);
        }

        $datahcl =  $data1;
        echo $datahcl;

    }


    ///////////////////////////////////////////////////////////////////
    ////////////////     End LQS 082 dan 054 function   ///////////////
    ///////////////////////////////////////////////////////////////////

    function get_hasilffalqs074(){
        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dtnaoh = $this->M_tambahan->getdata_naoh2($tgltest);

        $data1 = 0;
        foreach($dtnaoh as $row){
            // $data1 += $row['hasil_m'];
            $data1 += floatval($row['hasil_m']);
        }

        $datanaoh =  $data1;
        echo $datanaoh;

    }

    function get_data_picno(){

        $dttgl_analisa = trim($this->input->post('dttgl_analisa'));
        $dt_tgltest = trim($this->input->post('dttgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $dtno = trim($this->input->post('dtno'));

        $dtpicno = $this->M_tambahan->getdata_picno($dttgl_analisa,$dtno);
        $dtnaoh = $this->M_tambahan->getdata_naoh($tgltest);
        $dtna2s2o3 = $this->M_tambahan->getdata_na2s2o3($tgltest);

        foreach($dtpicno as $row){
            $data1 .= "<option value=".$row[picno_kosong].">$row[picno_kosong]</option>";
            $data2 .= $row['picno_kosong'];
            $data3 .= $row['picno_hasil'];
        }

        foreach($dtnaoh as $row2){
            $data4 .= $row2['hasil_m'];
        }

        foreach($dtna2s2o3 as $row3){
            $data5 .= $row3['hasil_m'];
        }

        $data =  $data1.",".$data2.", ".$data3.", ".$data4.", ".$data5;
//        $datas = $dttgl_analisa;
        echo $data;
    }




    function get_dtjenis_produk002(){

        $tipe_contoh = $this->input->post('tipe_contoh');

        $dt_jenis_produk = $this->M_tambahan->get_jenis_produk($tipe_contoh);
        $data1 = "<option value=''>--pilih--</option>";
        foreach($dt_jenis_produk as $row){
            if($row['jenis_produk']==$row['jenis_produk2']){
             $data1 .= '<option value="'.$row['jenis_produk'].'">' .$row['jenis_produk2']. '</option>';
            }else{
                if($row['jenis_produk2']==''){
                    $data1 .= '<option value="'.$row['jenis_produk'].'">' .$row['jenis_produk']. '</option>';
                }else{
                    $data1 .= '<option value="'.$row['jenis_produk'].'">' .$row['jenis_produk2'].' / '.$row['jenis_produk']. '</option>';
                }
            }
        }
            $data2 = '<table class="table table-bordered table-hover table-striped sticky-header">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th rowspan ="3"></th>
                                                <th rowspan ="3">Jam Sampling</th>
                                                <th rowspan ="3">Kode/ Deskripsi Contoh</th>
                                                <th rowspan ="3"><div id="th_PID"></div></th>
                                                <th rowspan ="3"><div id="th_PID2"></div></th>
                                                <th rowspan ="3"><div id="th_PID3"></div></th>
                                                <th rowspan ="3"><div id="th_PID4"></div></th>
                                                <th rowspan ="3"><div id="th_PID5"></div></th>
                                                <th rowspan ="3"><div id="th_PID6"></div></th>
                                                <th rowspan ="3"><div id="th_PID7"></div></th>
                                                <th rowspan ="3"><div id="th_PID8"></div></th>
                                                <th rowspan ="3"><div id="th_PID9"></div></th>
                                                <th rowspan ="3"><div id="th_PID10"></div></th>
                                                <th rowspan ="3"><div id="th_PID11"></div></th>
                                                <th rowspan ="3"><div id="th_PID12"></div></th>
                                                <th rowspan ="3"><div id="th_PID13"></div></th>
                                                <th rowspan ="3"><div id="th_PID14"></div></th>
                                                <th rowspan ="3">Jumlah Contoh</th>
                                                <th colspan="5">Laboratorium Kimia</th>
                                                <th rowspan ="3">Keterangan</th>
                                                <th colspan="5">Laboratorium Mikro</th>
                                                <th rowspan ="3">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th colspan ="2">Diantar</th>
                                                <th colspan ="3">Diterima</th>
                                                <th colspan ="2">Diantar</th>
                                                <th colspan ="3">Diterima</th>
                                            </tr>
                                            <tr>
                                                <th>Jam</th>
                                                <th>Oleh</th>
                                                <th>Jam</th>
                                                <th>Oleh</th>
                                                <th>Kondisi Sampel</th>
                                                <th>Jam</th>
                                                <th>Oleh</th>
                                                <th>Jam</th>
                                                <th>Oleh</th>
                                                <th>Kondisi Sampel</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataTable"><tr><td valign="top"><input name="chk[]" type="checkbox"/></td>
                                                <td>
                                                    <input type="hidden" name="detail_id_sampel[]" id="detail_id_sampel" value="0" size="1"/>
                                                    <input type="text" name="jam_sampling[]" id="jam_sampling" size="10"/>
                                                </td>
                                                <td><div class="DivKd"></div></td>
                                                <td><div class="td_PID"></div></td>
                                                <td><div class="td_PID2"></div></td>
                                                <td><div class="td_PID3"></div></td>
                                                <td><div class="td_PID4"></div></td>
                                                <td><div class="td_PID5"></div></td>
                                                <td><div class="td_PID6"></div></td>
                                                <td><div class="td_PID7"></div></td>
                                                <td><div class="td_PID8"></div></td>
                                                <td><div class="td_PID9"></div></td>
                                                <td><div class="td_PID10"></div></td>
                                                <td><div class="td_PID11"></div></td>
                                                <td><div class="td_PID12"></div></td>
                                                <td><div class="td_PID13"></div></td>
                                                <td><div class="td_PID14"></div></td>
                                                <td><div class="td_PID15"></div></td>
                                                <td><input type="text" name="jml_contoh[]"  id="jml_contoh" size="6"/></td>
                                                <td><input type="text" name="jam_antar[]"  id="jam_antar" onkeyup="get_values();" size="6"/></td>
                                                <td><input type="text" name="pengantar[]"  id="pengantar" size="10"/></td>
                                                <td><input type="text" name="jam_terima[]" id="jam_terima" onkeyup="get_values();" size="6"/></td>
                                                <td><input type="text" name="penerima[]" id="penerima" size="10"/></td>
                                                <td>
                                                   <select name="kondisi_sampel[]" class="kondisi_sampel" id="kondisi_sampel">
                                                       <option value=""></option>
                                                       <option value="Sesuai">Sesuai</option>
                                                       <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="keterangan[]" id="keterangan" size="30"/></td>
                                                <td><input type="text" name="jam_antar2[]"  id="jam_antar2" onkeyup="get_values();" size="6"/></td>
                                                <td><input type="text" name="pengantar2[]"  id="pengantar2" size="10"/></td>
                                                <td><input type="text" name="jam_terima2[]" id="jam_terima2" onkeyup="get_values();" size="6"/></td>
                                                <td><input type="text" name="penerima2[]" id="penerima2" size="10"/></td>
                                                <td>
                                                   <select name="kondisi_sampel2[]" class="kondisi_sampel2" id="kondisi_sampel">
                                                       <option value=""></option>
                                                       <option value="Sesuai">Sesuai</option>
                                                       <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="keterangan2[]" id="keterangan2" size="30"/></td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="bg-primary">
                                        <tr>
                                            <td colspan="30" align="center">
                                                    <button type="button" class="btn btn-sm btn-info" onClick="addRow(\'dataTable\')">Tambah Baris</button>
                                                    <button type="button" class="btn btn-sm btn-warning" onClick="deleteRow(\'dataTable\')">Hapus Baris</button>

                                            </td>
                                        </tr>
                                    </tfoot>';

        $data = $data1.",".$data2;
        echo $data;
    }


    function get_element_html_lqs002(){

    }


    function get_dt_nm_product(){

        $jns_produk2 = $this->input->post('jns_produk2');

        $dt_nm_produk = $this->M_tambahan->get_nmproduk($jns_produk2);
        $data_nm_pr = "<option value=''>- pilih -</option>";
        foreach($dt_nm_produk as $row){
             $data_nm_pr .= '<option value="'.$row['deskripsi_formula'].'">' .$row['deskripsi_formula']. '</option>';
        }

        echo $data_nm_pr;
    }

    function get_dt_nm_productByJP(){

        $jp = $this->input->post('jp');

        $dt_jns_produk = $this->M_tambahan->get_nmprodukByJP($jp);
        $data_nm_pr .= "<option value=''>- pilih -</option>";
        foreach($dt_jns_produk as $row){
             $data_nm_pr .= '<option value="'.$row['deskripsi_formula'].'">' .$row['deskripsi_formula']. '</option>';
        }

        echo $data_nm_pr;
    }

    function get_dt_nm_product_byformula(){

        $kategori_produk = $this->input->post('kategori_produk');
        $formula = $this->input->post('formula');

        $dt_nm_produk = $this->M_tambahan->get_nmproduk_byformula($kategori_produk, $formula);
        $data_nm_pr2 .= "<option value=''>- pilih -</option>";
        foreach($dt_nm_produk as $row){
             $data_nm_pr2 .= '<option value="'.$row['deskripsi_formula'].'">' .$row['deskripsi_formula']. '</option>';
        }

        echo $data_nm_pr2;
    }

    function get_kdsampel002(){
        $tipe_contoh = $this->input->post('tipe_contoh');
        $jns_produk = $this->input->post('jns_produk');

        $dtDivKdSampel002 = $this->M_tambahan->getDivKdSampel002($tipe_contoh,$jns_produk);
        $jml_dt = count($dtDivKdSampel002);
        if($jml_dt>0){
            $data = "<select name='deskripsi[]' id='deskripsi' class='deskripsi'><option value=''>--pilih--</option>";
            foreach($dtDivKdSampel002 as $rowDivKdSampel002){
                 $data .= '<option value="'.$rowDivKdSampel002['kode_sample'].'">' .$rowDivKdSampel002['kode_sample']. '</option>';
            }
            $data .="</select>";
        }else{
            $data = "<input type='text' name='deskripsi[]' id='deskripsi' class='deskripsi'/>";
        }

//        switch($tipe_contoh){
//            case $tipe_contoh=='In-Process':
//                switch($jns_produk){
//                    case $jns_produk=='Coconut Cream' || $jns_produk=='DWP' || $jns_produk=='CWB' || $jns_produk=='CMB' || $jns_produk=='Single Strength' || $jns_produk=='Shelf Life':
//                        $dtDivKdSampel002 = $this->M_tambahan->getDivKdSampel002($tipe_contoh,$jns_produk);
//                        $data = "<select name='deskripsi[]'><option value=''>--pilih--</option>";
//                        foreach($dtDivKdSampel002 as $rowDivKdSampel002){
//                            $data .= '<option value="'.$rowDivKdSampel002['kode_sample'].'">' .$rowDivKdSampel002['kode_sample']. '</option>';
//                        }
//                        $data .="</select>";
//                    break;
//                    default:
//                       $data = "<input type='text' name='deskripsi[]' id='deskripsi'/>";
//                    break;
//                }
//            break;
//            case $tipe_contoh=='Finished Product':
//                switch($jns_produk){
//                    case $jns_produk=='Coconut Cream':
////                        $dtDivKdSampel002 = $this->M_tambahan->getDivKdSampel002($tipe_contoh,$jns_produk);
////                        $data = "<select name='deskripsi[]'><option value=''>--pilih--</option>";
////                        foreach($dtDivKdSampel002 as $rowDivKdSampel002){
////                            $data .= '<option value="'.$rowDivKdSampel002['kode_sample'].'">' .$rowDivKdSampel002['kode_sample']. '</option>';
////                        }
////                        $data .="</select>";
//                        $data = "<input type='text' name='deskripsi[]' id='deskripsi'/>";
//                    break;
//                    case $jns_produk=='CWB':
//                        $data = "<input type='text' name='deskripsi[]' id='deskripsi'/>";
//                    break;
//                    case $jns_produk=='CMB':
//                        $data = "<input type='text' name='deskripsi[]' id='deskripsi'/>";
//                    break;
//                    case $jns_produk=='Single Strength':
//                        $data = "<input type='text' name='deskripsi[]' id='deskripsi'/>";
//                    break;
//                    case $jns_produk=='Shelf Life':
//                        $data = "<input type='text' name='deskripsi[]' id='deskripsi'/>";
//                    break;
//                    default:
//
//                        $data = "<input type='text' name='deskripsi[]' id='deskripsi'/>";
//                    break;
//                }
//            break;
//            case $tipe_contoh=='Utility':
//                switch($jns_produk){
//                    case $jns_produk=='Water Treatment' || $jns_produk=='Boiler':
//                        $dtDivKdSampel002 = $this->M_tambahan->getDivKdSampel002($tipe_contoh,$jns_produk);
//                        $data = "<select name='deskripsi[]'><option value=''>--pilih--</option>";
//                        foreach($dtDivKdSampel002 as $rowDivKdSampel002){
//                            $data .= '<option value="'.$rowDivKdSampel002['kode_sample'].'">' .$rowDivKdSampel002['kode_sample']. '</option>';
//                        }
//                        $data .="</select>";
//                    break;
//                    default:
//                        $data = "<input type='text' name='deskripsi[]' id='deskripsi'/>";
//                    break;
//                }
//            break;
//            case $tipe_contoh=='PMK':
//                switch($jns_produk){
//                    case $jns_produk=='Expeller Cake':
//                        $dtDivKdSampel002 = $this->M_tambahan->getDivKdSampel002($tipe_contoh,$jns_produk);
//                        $data = "<select name='deskripsi[]'><option value=''>--pilih--</option>";
//                        foreach($dtDivKdSampel002 as $rowDivKdSampel002){
//                            $data .= '<option value="'.$rowDivKdSampel002['kode_sample'].'">' .$rowDivKdSampel002['kode_sample']. '</option>';
//                        }
//                        $data .="</select>";
//                    break;
//                    case $jns_produk=='Crude Coconut Oil':
//                        $dtDivKdSampel002 = $this->M_tambahan->getDivKdSampel002($tipe_contoh,$jns_produk);
//                        $data = "<select name='deskripsi[]'><option value=''>--pilih--</option>";
//                        foreach($dtDivKdSampel002 as $rowDivKdSampel002){
//                            $data .= '<option value="'.$rowDivKdSampel002['kode_sample'].'">' .$rowDivKdSampel002['kode_sample']. '</option>';
//                        }
//                        $data .="</select>";
//                    break;
//                    default:
//                        $data = "<input type='text' name='deskripsi[]' id='deskripsi'/>";
//                    break;
//                }
//            break;
//            default:
//                $data = "<input type='text' name='deskripsi[]' id='deskripsi'/>";
//            break;
//        }
       echo $data;
    }

        function get_formula002(){
        $tipe_contoh = $this->input->post('tipe_contoh');
        $jns_produk = $this->input->post('jns_produk');
        $jns_produk_2 = $this->input->post('jns_produk_2');

        $dtDivFormula002 = $this->M_tambahan->getDivFormula002($tipe_contoh,$jns_produk,$jns_produk_2);
        $jml_dt2 = count($dtDivFormula002);
        if($jml_dt2>0){
            $data2 = "<option value=''>--pilih--</option>";
            foreach($dtDivFormula002 as $rowdtDivFormula002){
                 $data2 .= '<option value="'.$rowdtDivFormula002['nama_formula'].'">' .$rowdtDivFormula002['nama_formula']. '</option>';
            }
        }else{
            $data2 = "<option value=''>--pilih--</option>";
        }
       echo $data2;
    }

    // function get_shelflife(){
    //     $dt_tipe_contoh = $this->input->post('tipe_contoh');
    //     $dt_jns_produk = $this->input->post('jns_produk');

    //     switch($dt_jns_produk){
    //        case $dt_jns_produk=='Coconut Cream':
    //            $jns_produk = 'CC';
    //        break;
    //        case $dt_jns_produk=='Coconut Water Baverages':
    //            $jns_produk = 'CWB';
    //        break;
    //        case $dt_jns_produk=='Coconut Milk Baverages':
    //            $jns_produk = 'CMB';
    //        break;
    //        case $dt_jns_produk=='Single Strength':
    //            $jns_produk = 'Single Strength';
    //        break;
    //        case $dt_jns_produk=='Shelf Life':
    //            $jns_produk = 'Shelf Life';
    //        break;
    //        default:
    //            $jns_produk = $dt_jns_produk;
    //        break;
    //     }

    //     switch($dt_tipe_contoh){
    //         case $dt_tipe_contoh=='Shelf Life':
    //             switch($dt_jns_produk){
    //                 case $dt_jns_produk=='Coconut Cream' || $dt_jns_produk=='Coconut Milk Powder' || $dt_jns_produk=='CWB' || $dt_jns_produk=='CMB':
    //                     $data1 = "<input type='text' id='shelf_life_month'  name='shelf_life_month[]'/>";
    //                     $data2 = "Shelf Life (Month)";
    //                 break;
    //                 default:
    //                     $data1 = "";
    //                     $data2="";
    //                 break;
    //             }
    //         break;
    //         default:
    //             $data1 = "";
    //             $data2="";
    //         break;
    //     }

    //     $datas = $data1.",".$data2;
    //     echo $datas;
    // }

    function get_productid002(){
        $dt_tipe_contoh = $this->input->post('tipe_contoh');
        $dt_jns_produk = $this->input->post('jns_produk');

        switch($dt_tipe_contoh){
            case $dt_tipe_contoh=='In-Process':
                switch($dt_jns_produk){
                    case $dt_jns_produk=='Coconut Cream':
                        $data1 = "";
                        $data2 = "";
                        $data3 = "";
                        $data4 = "";
                        $data5 = "";
                        $data6 = "";
                        $data7 = "";
                        $data8 = "";
                        $data9 = " <select name='remarks_monitoring[]' id='remarks_monitoring'><option value=''></option><option value='117'>117</option><option value='122'>122</option><option value='124'>124</option><option value='217'>217</option><option value='230'>230</option><option value='724'>724</option></select>";
                        $data10 = "Remarks Monitoring";
                        $data11 = "";
                        $data12 = "";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "";
                        $data16 = "";
                        $data17 = "<input type='text' id='dtl_suhu'  name='dtl_suhu[]' size='5'/>";
                        $data18 = "Temp";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                    default:
                        $data1 = "";
                        $data2="";
                        $data3 = "";
                        $data4="";
                        $data5 = "";
                        $data6 = "";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "";
                        $data12 = "";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "";
                        $data16 = "";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                }
            break;
            case $dt_tipe_contoh=='Finished Product':
                switch($dt_jns_produk){
                    case $dt_jns_produk=='Coconut Cream' || $dt_jns_produk=='CWB' || $dt_jns_produk=='CMB' || $dt_jns_produk=='CMD' || $dt_jns_produk=='CWD' || $dt_jns_produk=='CWC' || $dt_jns_produk=='SEMI CWC':
                        $data1 = "<input type='text' id='product_id'  name='product_id[]' class='product_id'/>";
                        $data2 = "Product ID / Product Name";
                        $data3 = "<input type='text' id='formula'  name='formula[]'/>";
                        $data4 = "Formula";
                        $data5 = "";
                        $data6 = "";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "<input type='text' id='remarks_monitoring'  name='remarks_monitoring[]' size='30'/>";
                        $data10 = "Remarks Monitoring";
                        $data11 = "";
                        $data12 = "";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "";
                        $data16 = "";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                    case $dt_jns_produk=='Coconut Cream' || $dt_jns_produk=='Coconut Milk Powder':
                        $data1 = "";
                        $data2 = "";
                        $data3 = "";
                        $data4 = "";
                        $data5 = "";
                        $data6 = "";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "<input type='text' id='dtl_tanggal_produksi'  name='dtl_tanggal_produksi[]' class='dttgl input-group date' data-date='' data-date-format='yyyy-mm-dd' />";
                        $data12 = "Tanggal Produksi";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "";
                        $data16 = "";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                    case $dt_jns_produk=='Desiccated Coconut':
                        $data1 = "";
                        $data2 = "";
                        $data3 = "";
                        $data4 = "";
                        $data5 = "";
                        $data6 = "";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "<input type='text' id='dtl_tanggal_produksi'  name='dtl_tanggal_produksi[]' class='dttgl input-group date' data-date='' data-date-format='yyyy-mm-dd' />";
                        $data12 = "Tanggal Produksi";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "";
                        $data16 = "";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "<input type='hidden' name='dtl_kode_produksi[]' id='dtl_kode_produksi' value='' size='10'/>";
                        $data28 = "Kode Produksi";
                        $data29 = "";
                        $data30 = "";
                    break;
                    default:
                        $data1 = "";
                        $data2="";
                        $data3 = "";
                        $data4="";
                        $data5 = "";
                        $data6 = "";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "";
                        $data12 = "";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "";
                        $data16 = "";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                }
            break;
            case $dt_tipe_contoh=='PMK':
                switch($dt_jns_produk){
                    case $dt_jns_produk=='Crude Coconut Oil' || $dt_jns_produk=='Expeller Cake':
                        $data1 = "";
                        $data2 = "";
                        $data3 = "";
                        $data4 = "";
                        $data5 = "";
                        $data6 = "";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "";
                        $data12 = "";
                        $data13 = "<input type='text' id='qty_tank'  name='qty_tank[]'/>";
                        $data14 = "Quantity Tank";
                        $data15 = "";
                        $data16 = "";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                    default:
                        $data1 = "";
                        $data2="";
                        $data3 = "";
                        $data4="";
                        $data5 = "";
                        $data6 = "";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "";
                        $data12 = "";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "";
                        $data16 = "";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                }
            break;
            case $dt_tipe_contoh=='Shelf Life':
                    switch($dt_jns_produk){
                    case $dt_jns_produk=='Coconut Cream' || $dt_jns_produk=='CWB' || $dt_jns_produk=='CMB'|| $dt_jns_produk=='CWD'|| $dt_jns_produk=='CMD':
                        $data1 = "<input type='text' id='product_id'  name='product_id[]' class='product_id' placeholder=''/>";
                        $data2 = "Product ID / Product Name";
                        $data3 = "<input type='text' id='formula'  name='formula[]' class='formula'/>";
                        $data4 = "Formula";
                        $data5 = "<input type='text' id='dtl_month'  name='dtl_month[]'/>";
                        $data6 = "Shelf Life (Month)";
                        $data7 = "<input type='text' id='dtl_filler'  name='dtl_filler[]'/>";
                        $data8 = "Filler";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "<input type='text' id='dtl_tanggal_produksi'  name='dtl_tanggal_produksi[]' class='dttgl input-group date' data-date='' data-date-format='yyyy-mm-dd' />";
                        $data12 = "Tanggal Produksi";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "<input type='text' id='expiry_date'  name='expiry_date[]'/>";
                        $data16 = "Expiry Date";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                    case $dt_jns_produk=='DWP':
                        $data1 = "<input type='text' id='product_id'  name='product_id[]' class='product_id' placeholder=''/>";
                        $data2 = "Product ID / Product Name";
                        $data3 = "<select name='formula[]' id='formula' class='formula'><option value=''>- pilih -</option></select>";
                        $data4 = "Formula";
                        $data5 = "<input type='text' id='dtl_month'  name='dtl_month[]'/>";
                        $data6 = "Shelf Life (Month)";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "<input type='text' id='dtl_tanggal_produksi'  name='dtl_tanggal_produksi[]' class='dttgl input-group date' data-date='' data-date-format='yyyy-mm-dd' />";
                        $data12 = "Tanggal Produksi";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "<input type='text' id='expiry_date'  name='expiry_date[]' class='dttgl input-group date' data-date='' data-date-format='yyyy-mm-dd'/>";
                        $data16 = "Expiry Date";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                    case $dt_jns_produk=='Desiccated Coconut':
                        $data1 = '<input type="text" name="product_id[]" id="product_id" class="product_id" value="" size="25"/>';
                        $data2 = "Product ID / Product Name";
                        $data3 = "<select name='formula[]' id='formula' class='formula'><option value=''>- pilih -</option></select>";
                        $data4 = "Formula";
                        $data5 = "<input type='text' id='dtl_month'  name='dtl_month[]'/>";
                        $data6 = "Shelf Life (Month)";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "<input type='text' id='dtl_tanggal_produksi'  name='dtl_tanggal_produksi[]' class='dttgl input-group date' data-date='' data-date-format='yyyy-mm-dd' />";
                        $data12 = "Tanggal Produksi";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "<input type='text' id='expiry_date'  name='expiry_date[]' class='dttgl input-group date' data-date='' data-date-format='yyyy-mm-dd'/>";
                        $data16 = "Expiry Date";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "<select name='dtl_product_type[]' id='dtl_product_type'><option value=''>- pilih -</option><option value='Full Fat'>Full Fat</option><option value='Low Fat'>Low Fat</option></select>";
                        $data20 = "Product Type";
                        $data21 = "<select name='dtl_grade[]' id='dtl_grade'><option value=''>- pilih -</option><option value='Blend'>Blend</option><option value='Extra Fine'>Extra Fine</option><option value='Fine'>Fine</option><option value='Medium'>Medium</option></select>";
                        $data22 = "Grade";
                        $data23 = "<select name='dtl_line[]' id='dtl_line'><option value=''>- pilih -</option><option value='1'>1</option><option value='2'>2</option><option value='4'>4</option><option value='5'>5</option></select>";
                        $data24 = "Line";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                    case $dt_jns_produk=='Coconut Milk Powder':
                        $data1 = "<input type='text' id='product_id'  name='product_id[]' class='product_id' placeholder='cmp'/>";
                        $data2 = "Product ID / Product Name";
                        $data3 = "<select name='formula[]' id='formula' class='formula'><option value=''>- pilih -</option></select>";
                        $data4 = "Formula";
                        $data5 = "<input type='text' id='dtl_month'  name='dtl_month[]'/>";
                        $data6 = "Shelf Life (Month)";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "<input type='text' id='dtl_tanggal_produksi'  name='dtl_tanggal_produksi[]' class='dttgl input-group date' data-date='' data-date-format='yyyy-mm-dd' />";
                        $data12 = "Tanggal Produksi";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "<input type='text' id='expiry_date'  name='expiry_date[]'/>";
                        $data16 = "Expiry Date";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "<select name='dtl_packing_size[]' id='dtl_packing_size'><option value=''>- pilih -</option><option value='Bag 20Kg'>Bag 20Kg</option><option value='Carton 1Kg'>Carton 1Kg</option><option value='Carton 15Kg'>Carton 15Kg</option><option value='Pack 20gr'>Pack 20gr</option><option value='Pack 20gr (Filler A)'>Pack 20gr (Filler A)</option><option value='Pack 20gr (Filler B)'>Pack 20gr (Filler B)</option><option value='Pack 50gr'>Pack 50gr</option></select>";
                        $data26 = "Packing Size";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                    default:
                        $data1 = "";
                        $data2="";
                        $data3 = "";
                        $data4="";
                        $data5 = "";
                        $data6 = "";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "";
                        $data12 = "";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "";
                        $data16 = "";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                }
            break;
            case $dt_tipe_contoh=='Single Strength':
                    switch($dt_jns_produk){
                    case $dt_jns_produk=='Single Strength':
                        $data1 = "<input type='text' id='product_id'  name='product_id[]' class='product_id'/>";
                        $data2 = "Product ID / Product Name";
                        $data3 = "<input type='text' id='formula'  name='formula[]'/>";
                        $data4 = "Formula";
                        $data5 = "";
                        $data6 = "";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "";
                        $data12 = "";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "";
                        $data16 = "";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                    default:
                        $data1 = "";
                        $data2="";
                        $data3 = "";
                        $data4="";
                        $data5 = "";
                        $data6 = "";
                        $data7 = "";
                        $data8 = "";
                        $data9 = "";
                        $data10 = "";
                        $data11 = "";
                        $data12 = "";
                        $data13 = "";
                        $data14 = "";
                        $data15 = "";
                        $data16 = "";
                        $data17 = "";
                        $data18 = "";
                        $data19 = "";
                        $data20 = "";
                        $data21 = "";
                        $data22 = "";
                        $data23 = "";
                        $data24 = "";
                        $data25 = "";
                        $data26 = "";
                        $data27 = "";
                        $data28 = "";
                        $data29 = "";
                        $data30 = "";
                    break;
                }
            break;
            default:
                $data1  = "";
                $data2  = "";
                $data3  = "";
                $data4  = "";
                $data5 = "";
                $data6 = "";
                $data7 = "";
                $data8 = "";
                $data9 = "";
                $data10 = "";
                $data11 = "";
                $data12 = "";
                $data13 = "";
                $data14 = "";
                $data15 = "";
                $data16 = "";
                $data17 = "";
                $data18 = "";
                $data19 = "";
                $data20 = "";
                $data21 = "";
                $data22 = "";
                $data23 = "";
                $data24 = "";
                $data25 = "";
                $data26 = "";
                $data27 = "";
                $data28 = "";
                $data29 = "";
                $data30 = "";
            break;
        }

        $datas = $data1.",".$data2.",".$data3.",".$data4.",".$data5.",".$data6.",".$data7.",".$data8.",".$data9.",".$data10.",".$data11.",".$data12.",".$data13.",".$data14.",".$data15.",".$data16.",".$data17.",".$data18.",".$data19.",".$data20.",".$data21.",".$data22.",".$data23.",".$data24.",".$data25.",".$data26.",".$data27.",".$data28.",".$data29.",".$data30.",";
        echo $datas;
        print_r($datas);
    }


    function get_product_id087(){

        $filler = $this->input->post('filler');
        $kategori_produk = $this->input->post('kategori_produk');

        $data='';
        $dt_filler = $this->M_tambahan->get_dt_product_id087($filler,$kategori_produk);
        $data .= "<option value=''>- pilih -</option>";
        foreach($dt_filler as $row){
             $data .= '<option value="'.$row['product_id'].'">' .$row['product_id']. '</option>';
        }
        echo $data;
    }

    function get_product_id087_gk(){

        $filler = $this->input->post('filler');
        $kategori_produk = $this->input->post('kategori_produk');

        $data='';
        $dt_filler = $this->M_tambahan->get_dt_product_id087_gk($filler,$kategori_produk);
        $data .= "<option value=''>- pilih -</option>";
        foreach($dt_filler as $row){
             $data .= '<option value="'.$row['product_id'].'">' .$row['product_id']. '</option>';
        }
        echo $data;
    }

    function get_product_id037(){

        $tipe_contoh = $this->input->post('tipe_contoh');
        $kategori_produk = $this->input->post('jns_produk');
        $nm_produk = $this->input->post('nm_produk');

        $dt_pdid = $this->M_tambahan->get_dt_product_id037($tipe_contoh, $kategori_produk, $nm_produk);
        $datapd = "<option value=''>- pilih -</option>";
        foreach($dt_pdid as $row){
             $datapd .= '<option value="'.$row['product_id'].'">' .$row['product_id']. '</option>';
        }
        echo $datapd;
    }

    function get_product_id091(){
        $kategori_produk = $this->input->post('kategori_produk');

        $dt_prdid = $this->M_tambahan->get_dt_product_id091($kategori_produk);

        $data = "<select name='product_type[]' id='product_type' class='product_type'><option value=''>--pilih--</option>";
        foreach($dt_prdid as $row){
             $data .= '<option value="'.$row['product_id'].'">' .$row['product_id']. '</option>';
        }
        $data .="</select>";
        echo $data;
    }

    function get_formula(){
        $kategori_produk = $_POST['kategori_produk'];
        $dt_frml = $this->M_tambahan->get_dt_formula($kategori_produk);

        $data_formula .= "<option value=''>- pilih -</option>";
        foreach($dt_frml as $row){
             $data_formula .= '<option value="'.trim($row['formula']).'">' .trim($row['formula']). '</option>';
        }
        echo $data_formula;
    }


    function get_data_naoh_hcl_intqad081(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dthcl1m = $this->M_tambahan->getdata_hcl1m($tgltest);
        $dtnaoh1m = $this->M_tambahan->getdata_naoh1m($tgltest);

        $data1 = 0;
        foreach($dthcl1m as $row){
            $data1 += $row['hasil_m'];
        }

        $data2 = 0;
        foreach($dtnaoh1m as $row){
            $data2 += floatval($row['hasil_m']);
        }

        $data =  $data1.",".$data2;

        echo $data;
    }

    function get_data_naoh_hcl_frmlqs122(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dthcl1m = $this->M_tambahan->getdata_hcl1m($tgltest);
        $dtnaoh1m = $this->M_tambahan->getdata_naoh1m($tgltest);

        $data1 = 0;
        foreach($dthcl1m as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['hasil_m']);
        }

        $data2 = 0;
        foreach($dtnaoh1m as $row){
            // $data1 .= $row[picno_kosong];
            $data2 += floatval($row['hasil_m']);
        }

        $data =  $data1.",".$data2;

        echo $data;
    }

    function get_data_naoh_hcl_induk(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dthcl1m = $this->M_tambahan->getdata_hcl1m_induk($tgltest);
        $dtnaoh1m = $this->M_tambahan->getdata_naoh1m_induk($tgltest);

        $data1 = 0;
        foreach($dthcl1m as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['hasil_m']);
        }

        $data2 = 0;
        foreach($dtnaoh1m as $row){
            // $data1 .= $row[picno_kosong];
            $data2 += floatval($row['hasil_m']);
        }

        $data =  $data1.",".$data2;

        echo $data;
    }



    function get_data_naoh_hcl_intqad116(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dthcl1m = $this->M_tambahan->getdata_hcl1000($tgltest);
        $dtnaoh = $this->M_tambahan->getdata_naoh5000($tgltest);

        $data1 = 0;
        foreach($dthcl1m as $row){
            $data1 += $row['hasil_m'];
        }

        $data2 = 0;
        foreach($dtnaoh as $row){
            $data2 += floatval($row['hasil_m']);
        }

        $data =  $data1.",".$data2;

        echo $data;
    }

    function get_data_ph_acf_frmlqs122(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $jam = trim($this->input->post('dt_jam'));

        if((substr($jam,0,2)=='08')||(substr($jam,0,2)=='09')||(substr($jam,0,2)=='10')||(substr($jam,0,2)=='11')||(substr($jam,0,2)=='12')||(substr($jam,0,2)=='13')||(substr($jam,0,2)=='14')||(substr($jam,0,2)=='15')){$dt_jam_awal='08';}
        elseif((substr($jam,0,2)=='16')||(substr($jam,0,2)=='17')||(substr($jam,0,2)=='18')||(substr($jam,0,2)=='19')||(substr($jam,0,2)=='20')||(substr($jam,0,2)=='21')||(substr($jam,0,2)=='22')||(substr($jam,0,2)=='23')){$dt_jam_awal='16';}
        elseif((substr($jam,0,2)=='00')||(substr($jam,0,2)=='01')||(substr($jam,0,2)=='02')||(substr($jam,0,2)=='03')||(substr($jam,0,2)=='04')||(substr($jam,0,2)=='05')||(substr($jam,0,2)=='06')||(substr($jam,0,2)=='07')){$dt_jam_awal='00';}
        else{$dt_jam_awal=substr($jam,0,2);}

        $dt_jam_akhir = '00';

        $dtphacf = $this->M_tambahan->getdata_phacf($tgl_analisa,$dt_jam_awal,$dt_jam_akhir);

        foreach($dtphacf as $row){
            $datas = $row['ph_acf'];
        }
        echo $datas;
    }

    function get_data_product_id_lqs077(){

        $ntgl_produksi   = trim($this->input->post('dttgl_produksi'));
        $tgl_produksi    = substr($ntgl_produksi, 6, 4).'-'.substr($ntgl_produksi, 3, 2).'-'.substr($ntgl_produksi, 0, 2);
        $filler          = trim($this->input->post('dtfiller'));
        $kode_pack       = trim($this->input->post('dtkode_pack'));
        $jam_sampling    = trim($this->input->post('dtjam_sampling'));
        $suhu            = trim($this->input->post('dtsuhu'));
        $ntipe_contoh    = trim($this->input->post('dttipe_contoh'));
        $varian          = trim($this->input->post('dtvarian'));
        $sample_type     = trim($this->input->post('dtsample_type'));

        if($ntipe_contoh=='Finished Product'){$tipe_contoh='Produk Akhir';}else{$tipe_contoh=$ntipe_contoh;}
        $jns_produk      = trim($this->input->post('dtjns_produk'));
        if(($ntipe_contoh=='Finished Product')&&(($jns_produk=='CWB')||($jns_produk=='CMB')||($jns_produk=='CMD'))){
            $dtprid = $this->M_tambahan->get_data_lqs077_2($tgl_produksi,$filler,$kode_pack,$jam_sampling,$suhu,$tipe_contoh,$jns_produk,$varian,$sample_type);
        }else{
            $dtprid = $this->M_tambahan->get_data_lqs077($tgl_produksi,$filler,$kode_pack,$jam_sampling,$suhu,$tipe_contoh,$jns_produk,$sample_type);
        }
        $datas1d='';

        foreach($dtprid as $row){
            $datas1 .= $row['product_id'];
            $datas2 .= $row['product_name'];
            $datas3 .= $row['kode_sample'];
            $datas4 .= $row['tgl_expired'];
            $datas5 .= $row['ph'];
        }

        echo $data =  $datas1d.",".$datas1.",".$datas2.",".$datas3.",".$datas4.",".$datas5;
    }


    function get_nama_alat() {
        $param = $this->input->post('param');
        $records_alat = $this->M_tambahan->get_data_alat($param);

        $list_alat = '<ul id="daftarAlat">';
        foreach($records_alat as $row) {
            $list_alat .= '<li onClick="selectAlat(\''.$row["nama_alat"].'\');">'.$row["nama_alat"].'</li>';
        }

        $list_alat .='</ul>';

        echo $list_alat;
    }

    function get_kode_alat() {
        $param = $this->input->post('param');
        $kode = $this->input->post('kode');
        // echo "ini param".$param;
        // echo "ini kode".$kode;
        $records_kodealat = $this->M_tambahan->get_data_kodealat($param,$kode);
        // print_r($records_kodealat);

        $list_kodealat = '<ul id="daftarKodeAlat">';
        foreach($records_kodealat as $row) {
            $list_kodealat .= '<li onClick="selectKodeAlat(\''.$row["no_inventaris"].'\');">'.$row["no_inventaris"].'</li>';
        }

        $list_kodealat .='</ul>';

        echo $list_kodealat;
    }

    function get_lokasi_alat() {
        $param = $this->input->post('param');
        $lokasi = $this->input->post('lokasi');

        $records_lokasialat = $this->M_tambahan->get_data_lokasialat($param,$lokasi);

        $list_lokasialat = '<ul id="daftarLokasiAlat">';
        foreach($records_lokasialat as $row) {
            $list_lokasialat .= '<li onClick="selectLokasiAlat(\''.$row["tempat_penyimpanan"].'\');">'.$row["tempat_penyimpanan"].'</li>';
        }

        $list_lokasialat .='</ul>';

        echo $list_lokasialat;
    }

    function get_penanggung_jawab_alat() {
        $param = $this->input->post('param');
        $penanggung_jawab = $this->input->post('penanggung_jawab');

        $records_penanggung_jawabalat = $this->M_tambahan->get_data_penanggung_jawabalat($param,$penanggung_jawab);

        $list_penanggung_jawabalat = '<ul id="daftarPenanggungJawab">';
        foreach($records_penanggung_jawabalat as $row) {
            $list_penanggung_jawabalat .= '<li onClick="selectPenanggungJawab(\''.$row["penanggung_jawab"].'\');">'.$row["penanggung_jawab"].'</li>';
        }

        $list_penanggung_jawabalat .='</ul>';

        echo $list_penanggung_jawabalat;
    }

    function get_kode_alat1() {

        $kode = $this->input->post('kode');
        // echo "ini param".$param;
        // echo "ini kode".$kode;
        $records_kodealat = $this->M_tambahan->get_data_kodealat1($kode);
        // print_r($records_kodealat);

        $list_kodealat = '<ul id="daftarKodeAlat">';
        foreach($records_kodealat as $row) {
            $list_kodealat .= '<li onClick="selectKodeAlat(\''.$row["no_inventaris"].'\');">'.$row["no_inventaris"].'</li>';
        }

        $list_kodealat .='</ul>';

        echo $list_kodealat;
    }

    function get_data_picno_only(){

        $dttgl_analisa = trim($this->input->post('dttgl_analisa'));
        $dtno = trim($this->input->post('dtno'));

        $dtpicno = $this->M_tambahan->getdata_picno_only($dttgl_analisa,$dtno);

        foreach($dtpicno as $row){
            $data1 .= "<option value=".$row[picno_kosong].">$row[picno_kosong]</option>";
            $data2 .= $row['picno_kosong'];
            $data3 .= $row['picno_hasil'];
        }
        $data =  $data1.",".$data2.", ".$data3;
//        $datas = $dttgl_analisa;
        echo $data;
    }

    // function get_kd_alat (){
    //    $data['kode_alat']=$this->M_formfrmnon040_00->get_kodealat();
    // }

    function get_data_std_naoh_na2s2o3(){

        $dt_tgltest = trim($this->input->post('dttgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dtnaoh = $this->M_tambahan->getdata_naoh($tgltest);
        $dtna2s2o3 = $this->M_tambahan->getdata_na2s2o3($tgltest);


        foreach($dtnaoh as $row2){
            $data1 = $row2['hasil_m'];
        }

        foreach($dtna2s2o3 as $row3){
            $data2 = $row3['hasil_m'];
        }

        $datas =  $data1.",".$data2;
//        $datas = $dttgl_analisa;
        echo $datas;
    }

    function getFormula()
    {
        $kode = $this->input->post('kode');
        // echo "ini param".$param;
        // echo "ini kode".$kode;
        $records_kodealat = $this->M_tambahan->getFormula($kode);
        // print_r($records_kodealat);

        $list_kodealat = '<ul id="daftarKodeAlat">';
        foreach($records_kodealat as $row) {
            $list_kodealat .= '<li onClick="selectKodeAlat(\''.$row["nama_formula"].'\');">'.$row["nama_formula"].'</li>';
        }

        $list_kodealat .='</ul>';

        echo $list_kodealat;
    }

    function get_standarisasi_lqs082(){
        $dt_tgl_analisa = trim($this->input->post('tgl_analisa'));
        $tgltest        = substr($dt_tgl_analisa,6,4).'-'.substr($dt_tgl_analisa,3,2).'-'.substr($dt_tgl_analisa,0,2);

        $jns_produk = trim($this->input->post('jns_produk'));
        $nm_jns_produk = trim($this->input->post('nm_jns_produk'));
        $nm_produk = trim($this->input->post('nm_produk'));

        /*switch($jns_produk && $nm_jns_produk){
            case $jns_produk=='Finished Product' && $nm_jns_produk=='CWB':
                if($nm_produk=='Kara Coco' || $nm_produk=='The Coco Tree Original' || $nm_produk=='Aseptic Coconut Water - Single Strength'){
                    $dtnaoh = $this->M_tambahan->getdata_naoh1000($tgltest);
                    $dti2   = $this->M_tambahan->getdata_i2($tgltest);
                    $dtclo  = $this->M_tambahan->getdata_agno3_chlo($tgltest);
                }else{
                    $dtnaoh = $this->M_tambahan->getdata_naoh1000_mini($tgltest);
                    $dti2   = $this->M_tambahan->getdata_i2_mini($tgltest);
                    $dtclo  = $this->M_tambahan->getdata_agno3_chlo_mini($tgltest);
                }
            break;
            case $jns_produk=='Finished Product' && $nm_jns_produk=='Raw Material':
                    $dtnaoh = $this->M_tambahan->getdata_naoh1000_mini($tgltest);
                    $dti2   = $this->M_tambahan->getdata_i2_mini($tgltest);
                    $dtclo  = $this->M_tambahan->getdata_agno3_chlo_mini($tgltest);
            break;
            default:*/
                   $dtnaoh  = $this->M_tambahan->getdata_naoh1000($tgltest);
                   $dti2    = $this->M_tambahan->getdata_i2($tgltest);
                   $dtclo   = $this->M_tambahan->getdata_agno3_chlo($tgltest);
            /*break;
        }*/

        $dtnaoh2 = $this->M_tambahan->getdata_naoh2($tgltest);

        $data1 = 0;
        $data2 = 0;
        $data3 = 0;
        $data4 = 0;

        foreach($dtnaoh as $row){
            $data1 += floatval($row['hasil_m']);
        }

        foreach($dti2 as $row){
            $data2 += floatval($row['hasil_m']);
        }

        foreach($dtclo as $row){
            $data3 += floatval($row['hasil_m']);
        }

        foreach($dtnaoh2 as $row){
            $data4 += floatval($row['hasil_m']);
        }

        $data_std =  $data1.",".$data2.",".$data3.",".$data4;
        echo $data_std;

        }

    function get_picno_lqs082(){
        $dt_tgl_analisa     = trim($this->input->post('tgl_analisa'));
        $tgl_analisa        = substr($dt_tgl_analisa,6,4).'-'.substr($dt_tgl_analisa,3,2).'-'.substr($dt_tgl_analisa,0,2);
        $no_picno           = trim($this->input->post('no_picno'));

        $dtpicno = $this->M_tambahan->getdata_picno2($tgl_analisa,$no_picno);

        $data1 = 0;
        $data2 = 0;
        foreach($dtpicno as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['picno_kosong']);
            $data2 += floatval($row['picno_hasil']);
            // $data2 += floatval($row['picno_hasil']);
        }

        $data_picno =  $data1.",".$data2;
        echo $data_picno;
    }

    function get_nomor_inventaris()
    {
        $nama_alat = $this->input->post('nama_alat');

        $dt_nama_alat = $this->M_tambahan->getdata_nama_alat($nama_alat);

        foreach($dt_nama_alat as $row){

            echo '<option value="'.$row['no_inventaris'].'">'.$row['no_inventaris'].'</option>';
        }
    }
    function get_dept()
    {
        $dept = $this->input->post('dept');

        $dt_dept = $this->M_tambahan->get_kode_sampel($dept);
        echo '<option value=""></option>';
        foreach($dt_dept as $row){

            echo '<option value="'.$row['kode_sample'].'">'.$row['kode_sample'].'</option>';
            //$data = array('kode_sample'=>$row['kode_sample']);
            //echo json_encode($data);
        }

        //var_dump($j_data);
    }
    function get_no_inventaris()
    {
        $nama_alat = $this->input->post('nama_alat');

        $dt_nama_alat = $this->M_tambahan->get_data_nama_alat($nama_alat);
        echo '<option value=""></option>';
        foreach($dt_nama_alat as $row){
            echo '<option value="'.$row['no_inventaris'].'">'.$row['no_inventaris'].'</option>';
        }

    }

    function get_kodeform()
    {
        $dtbagian = $this->input->post('bagian');
        $dttipe_contoh = $this->input->post('tipe_contoh');

        if ($dtbagian == 'Monitoring (MTR)') {
            $ndtbagian = 'Form Monitoring';
        } elseif ($dtbagian == 'Laboratorium Kimia (CHE)') {
            $ndtbagian = 'Form Lab Kimia';
        } elseif ($dtbagian == 'Laboratorium Mikro (MIC)') {
            $ndtbagian = 'Form Lab Mikro';
        } else {
            $ndtbagian = $dtbagian;
        }

        $dt_kodeform = $this->M_tambahan->getkodeform_fss115($ndtbagian,$dttipe_contoh);
        echo '<option value=""></option>';
        foreach($dt_kodeform as $row){
            echo '<option value="'.$row['formkd'].'">'.$row['formnm'].'/'.$row['formjudul'].'</option>';
        }

    }

    function get_parameter()
    {
        $dtjns_sample = $this->input->post('jns_sample');
        $dtparameter  = $this->input->post('parameter_uji');

        if ($dtjns_sample == 'Dessicated Coconut') {
            $ndtjns_sample = 'DSC';
        } elseif ($dtjns_sample == 'Coconut Cream') {
            $ndtjns_sample = 'CCU';
        } elseif ($dtjns_sample == 'Coconut Milk Powder') {
            $ndtjns_sample = 'CMP';
        } else {
            $ndtjns_sample = $dtjns_sample;
        }

        $data['list_paramuji']    = $this->M_tambahan->getParamCmp($ndtjns_sample);
        $data['list_subparamuji'] = $this->M_tambahan->getSubParamCmp($ndtjns_sample, $dtparameter);
        echo json_encode($data);

    }

    function get_parameterlqs092()
    {

        $this->load->view('tambahan/lain_lain/formlqs092_dc');
        echo json_encode(array("status" => TRUE));

    }

    function get_penanggung_jawab()
    {
        $no_inventaris = $this->input->post('no_inventaris');

        $dt_penanggung_jawab = $this->M_tambahan->get_data_penanggung_jawab($no_inventaris);

        foreach($dt_penanggung_jawab as $row){
            echo $row['penanggung_jawab'];

        }
    }
	 function get_lokasi()
    {
        $no_inventaris = $this->input->post('no_inventaris');

        $dt_lokasi = $this->M_tambahan->get_data_lokasi($no_inventaris);

        foreach($dt_lokasi as $row){
            echo $row['tempat_penyimpanan'];

        }
    }
    function get_nama_sample()
    {
        $kode_sample = $this->input->post('kode_sample');

        $dt_kode_sample = $this->M_tambahan->getdata_kode_sample($kode_sample);

        foreach($dt_nama_alat as $row){

            echo '<option value="'.$row['nama_sample'].'">'.$row['nama_sample'].'</option>';
        }
    }


    function get_datanon055(){
        $jns_inspeksi         = trim($this->input->post('jns_inspeksi'));
        $dt_tgl_terima        = trim($this->input->post('tgl_terima'));
        $tgl_terima           = substr($dt_tgl_terima,6,4).'-'.substr($dt_tgl_terima,3,2).'-'.substr($dt_tgl_terima,0,2);
        $dt_tgl_produksi      = trim($this->input->post('tgl_produksi'));
        $tgl_produksi         = substr($dt_tgl_produksi,6,4).'-'.substr($dt_tgl_produksi,3,2).'-'.substr($dt_tgl_produksi,0,2);
        $kode_pm              = trim($this->input->post('kode_pm'));
        $delivery_for         = trim($this->input->post('delivery_for'));

        $dt005 = $this->M_tambahan->getdata_non005($tgl_terima,$jns_inspeksi,$kode_pm,$tgl_produksi,$delivery_for);

        $data1 = $dt_tgl_terima;
        $data2 = $jns_inspeksi;
        $data3 = $kode_pm;
        $data5 = $delivery_for;
            $data4 ="";

                foreach($dt005 as $row){
                    $data4 .= '<tr>
                                  <input type="hidden" name="detail_id[]" id="detail_id" value="'.$row['detail_id'].'" size="1"/>
                                  <td><input name="chk[]" type="checkbox" value="'.$row['detail_id'].'"/></td>
                                  <td><input type="text" size="10" name="dt_panjang[]" id="dt_panjang" value="'.$row['dt_panjang'].'"/></td>
                                  <td><input type="text" size="10" name="dt_lebar[]" id="dt_lebar" value="'.$row['dt_lebar'].'"/></td>
                                  <td><input type="text" size="10" name="dt_tinggi[]" id="dt_tinggi" value="'.$row['dt_tinggi'].'"/></td>
                                  <td><input type="text" size="10" name="dt_volume[]" id="dt_volume" value="'.$row['dt_volume'].'"/></td>
                              </tr>';
                }


        $data = $data1.",".$data2.",".$data3.",".$data4.",".$data5;
        echo $data;
    }

    function get_kode_pm() {

        $kode = $this->input->post('kode');
        // echo "ini param".$param;
        // echo "ini kode".$kode;
        $records_kodealat = $this->M_tambahan->get_data_kode_pm($param,$kode);
        // print_r($records_kodealat);

        $list_kodealat = '<ul id="daftarKodeAlat">';
        foreach($records_kodealat as $row) {
            $list_kodealat .= '<li onClick="selectKodeAlat(\''.$row["kode_pm"].'\');">'.$row["kode_pm"].'</li>';
        }

        $list_kode_pm .='</ul>';

        echo $list_kode_pm;
    }


    function get_elemen_fss090(){
        $kategori_produk = $_POST['kategori_produk'];
        $dt_frml = $this->M_tambahan->get_dt_formula($kategori_produk);
        $dt_product_id = $this->M_tambahan->get_dt_product_id_fss090($kategori_produk);

        $data_formula .= "<option value=''>- pilih -</option>";
        $data_nm_produk .= "<option value=''>- pilih -</option>";
        foreach($dt_frml as $row){
             $data_formula .= '<option value="'.trim($row['formula']).'">' .trim($row['formula']). '</option>';
             $data_nm_produk .= '<option value="'.trim($row['deskripsi_formula']).'">' .trim($row['deskripsi_formula']). '</option>';
        }

        $data_product_id .= "<option value=''>- pilih -</option>";
        foreach($dt_product_id as $row2){
             $data_product_id .= '<option value="'.trim($row2['product_id']).'">' .trim($row2['product_id']). '</option>';
        }


        echo $data_fss090 = $data_formula.','.$data_nm_produk.','.$data_product_id;
    }

    function get_dimensi_non055(){
        $jns_inspeksi         = trim($this->input->post('jns_inspeksi'));
        $delivery_for         = trim($this->input->post('delivery_for'));
        $dt_tgl_terima        = trim($this->input->post('tgl_terima'));
        $tgl_terima           = substr($dt_tgl_terima,6,4).'-'.substr($dt_tgl_terima,3,2).'-'.substr($dt_tgl_terima,0,2);
        $dt_tgl_produksi      = trim($this->input->post('tgl_produksi'));
        $tgl_produksi         = substr($dt_tgl_produksi,6,4).'-'.substr($dt_tgl_produksi,3,2).'-'.substr($dt_tgl_produksi,0,2);
        $kode_pm              = trim($this->input->post('kode_pm'));

        $dimensi_005 = $this->M_tambahan->getdata_dimensi_non005($tgl_terima,$jns_inspeksi,$kode_pm,$tgl_produksi,$delivery_for);

        if(count($dimensi_005) > 0 ){
            foreach($dimensi_005 as $row){
                $dt_panjang[]   = $row->dt_panjang;
                $dt_lebar[]     = $row->dt_lebar;
                $dt_tinggi[]    = $row->dt_tinggi;
                $dt_volume[]    = $row->dt_volume;
            }

            $ndt_panjang = array_diff($dt_panjang, array('',0));
            $ndt_lebar = array_diff($dt_lebar, array('',0));
            $ndt_tinggi = array_diff($dt_tinggi, array('',0));
            $ndt_volume = array_diff($dt_volume, array('',0));

            if(is_array($ndt_panjang) && count ($ndt_panjang) > 0){
                $nilai_avg_panjang=round((array_sum($ndt_panjang)) /(count($ndt_panjang)),0);
                if($nilai_avg_panjang > 0){$avg_panjang=$nilai_avg_panjang;}else{$avg_panjang='-';}
            }else{$avg_panjang='-';}
            if(is_array($ndt_lebar) && count ($ndt_lebar) > 0){
                $nilai_avg_lebar=round((array_sum($ndt_lebar)) /(count($ndt_lebar)),0);
                if($nilai_avg_lebar > 0){$avg_lebar=$nilai_avg_lebar;}else{$avg_lebar='-';}
            }else{$avg_lebar='-';}
            if(is_array($ndt_tinggi) && count ($ndt_tinggi) > 0){
                $nilai_avg_tinggi=round((array_sum($ndt_tinggi)) /(count($ndt_tinggi)),0);
                if($nilai_avg_tinggi > 0){$avg_tinggi=$nilai_avg_tinggi;}else{$avg_tinggi='-';}
            }else{$avg_tinggi='-';}
            if(is_array($ndt_volume) && count ($ndt_volume) > 0){
                $nilai_avg_volume=round((array_sum($ndt_volume)) /(count($ndt_volume)),0);
                if($nilai_avg_volume > 0){$avg_volume=$nilai_avg_volume;}else{$avg_volume='-';}
            }else{$avg_volume='-';}


            $dt_jml_dimensi = count($dt_panjang);
            if($dt_jml_dimensi=='0'){$jml_dimensi='-';}else{$jml_dimensi=$dt_jml_dimensi;}

            $dimensi=$avg_panjang.'/'.$avg_lebar.'/'.$avg_tinggi.'/'.$avg_volume;
        }else{
            $jml_dimensi='-';
            $dimensi='-';
        }

        /*$data_formula .= "<option value=''>- pilih -</option>";
        $data_nm_produk .= "<option value=''>- pilih -</option>";
        foreach($dt_frml as $row){
             $data_formula .= '<option value="'.trim($row['formula']).'">' .trim($row['formula']). '</option>';
             $data_nm_produk .= '<option value="'.trim($row['deskripsi_formula']).'">' .trim($row['deskripsi_formula']). '</option>';
        }

        $data_product_id .= "<option value=''>- pilih -</option>";
        foreach($dt_product_id as $row2){
             $data_product_id .= '<option value="'.trim($row2['product_id']).'">' .trim($row2['product_id']). '</option>';
        }


        echo $data_fss090 = $data_formula.','.$data_nm_produk.','.$data_product_id;*/
        echo $data2 = $jml_dimensi.','.$dimensi;
    }

    function get_dtl_nm_produk(){
        $tipe_contoh        = trim($this->input->post('ndtjc'));
        $jenis_produk       = trim($this->input->post('ndtjp'));
        $deskripsi          = trim($this->input->post('ndt_deskripsi'));

        $data_nmproduk = $this->M_tambahan->getdata_dtl_nm_produk($tipe_contoh, $jenis_produk,$deskripsi);
        $data1 = '';
       // if(count($data_nmproduk) > 0 ){
            foreach($data_nmproduk as $row){
                $data1 .= $row['nama_kimia'];
            }
        //}else{
          //  $data1 = '';
        //}
        echo $data = $data1;
    }

    // Untuk form formfss482_03
    // function get_tipe_contoh() {
    //     $abbr_kategori = $this->input->post('abbr_kategori');

    //     $dt_abbr_kategori = $this->M_tambahan->get_tipe_contoh($abbr_kategori);
    //     echo '<option value=""></option>';
    //     foreach ($dt_abbr_kategori as $row) {
    //         echo '<option value="'.$row['product_id'].'">'.$row['product_id'].'</option>';
    //     }
    // }

}
?>