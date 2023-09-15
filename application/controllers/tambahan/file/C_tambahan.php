<?php

class C_tambahan extends CI_Controller {

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
                        $data1 = "<input type='text' id='product_id' class='product_id  name='product_id[]'/>";
                        $data2 = "ID Produk";
                        $data3 = "<input type='text' id='formula' class='formula' name='formula[]'/>";
                        $data4 = "Formula";
                    break;
                    case $dtnm_jns_produk=='CMB':
                        $data1 = "<input type='text' id='product_id' class='formula' name='product_id[]'/>";
                        $data2 = "ID Produk";
                        $data3 = "<input type='text' id='formula' name='formula[]'/>";
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
        $dttest6 = $this->M_tambahan->getdata_edta($tgltest);
        $dttest7 = $this->M_tambahan->getdata_na2s2o3_qad016($tgltest);
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
        foreach($dttest6 as $row6){
            $data8 .= "<option value=".$row6[hasil_m].">$row6[hasil_m]</option>";
            $data9 .= $row6[hasil_m];
        }
        foreach($dttest7 as $row7){
            $data10 .= "<option value=".$row7[hasil_m].">$row7[hasil_m]</option>";
            $data11 .= $row7[hasil_m];
        }
        $datas =  $data1.",".$data2.",".$data3.",".$data4.",".$data5.",".$data6.",".$data7.",".$data8.",".$data9.",".$data10.",".$data11;
        echo $datas;
    }

    function get_hasilN141(){
        $tgltest = trim($this->input->post('tanggal_produksi'));

        $dttest1 = $this->M_tambahan->getdata_naoh141($tgltest);
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
            $frmkod = rtrim(chunk_split(strtoupper($row['formkode']), 3, '-'),'-');
            $data .= "<option value=".$row[formkode].">".$frmkod."</option>\n";
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
                    case $jenis_produk=='UHT-CC' || $jenis_produk=='Coconut Water Baverages' || $jenis_produk=='Single Strength' || $jenis_produk=='Shelf Life':
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
                if($nm_produk=='Kara Coco' || $nm_produk=='The Coco Tree Original' || $nm_produk=='Aseptic Coconut Water - Single Strength' || $nm_produk=='Hydro Coco 100% CW Packing 330 mL' || $nm_produk=='KARA COCONUT WATER SINGLE STRENGTH'){
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

    function get_hasilNaOH_non035(){

        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dtnaoh = $this->M_tambahan->getdata_naoh2($tgltest);

        /*switch($jns_produk && $nm_jns_produk){
            case $jns_produk=='In-Process' && $nm_jns_produk=='CWB':
                if($nm_produk=='Kara Coco' || $nm_produk=='The Coco Tree Original' || $nm_produk=='Aseptic Coconut Water - Single Strength' || $nm_produk=='Hydro Coco 100% CW Packing 330 mL' || $nm_produk=='KARA COCONUT WATER SINGLE STRENGTH'){
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
        }*/

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

    // untuk kolom sulfur
    function get_std_naoh(){
        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $jns_produk = trim($this->input->post('jns_produk'));
        $nm_jns_produk = trim($this->input->post('nm_jns_produk'));
        $nm_produk = trim($this->input->post('nm_produk'));

        switch($jns_produk && $nm_jns_produk){
            case $jns_produk=='In-Process' && $nm_jns_produk=='CWB':
                if($nm_produk=='Kara Coco' || $nm_produk=='The Coco Tree Original' || $nm_produk=='Aseptic Coconut Water - Single Strength' || $nm_produk=='Hydro Coco 100% CW Packing 330 mL' || $nm_produk=='KARA COCONUT WATER SINGLE STRENGTH' || $nm_produk == 'Cocobella Straight Up' || $nm_produk == 'Aseptic Single Strenght - Coconut Water'){
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

        $data1 = 0;
        foreach($dtnaoh as $row){
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
                if($nm_produk=='Kara Coco' || $nm_produk=='The Coco Tree Original' || $nm_produk=='Aseptic Coconut Water - Single Strength' || $nm_produk=='Hydro Coco 100% CW Packing 330 mL' || $nm_produk=='KARA COCONUT WATER SINGLE STRENGTH'){
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
        //$data1 = 0;
        foreach($dtnaoh as $row){
            // $data1 += $row['hasil_m'];
            $data1 = floatval($row['hasil_m']);
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

    function get_data_picno_non039(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $no_picno = trim($this->input->post('no_picno'));

        $dtpicno = $this->M_tambahan->getdata_picno2($tgl_analisa,$no_picno);

        $data1 = 0;
        $data2 = 0;
        foreach($dtpicno as $row){
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['picno_kosong']);
            $data2 += floatval($row['picno_hasil']);
        }

        $datawp =  $data1.'/-/'.$data2;
        echo $datawp;
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
                if($nm_produk=='Kara Coco' || $nm_produk=='The Coco Tree Original' || $nm_produk=='Aseptic Coconut Water - Single Strength' || $nm_produk=='Hydro Coco 100% CW Packing 330 mL' || $nm_produk=='KARA COCONUT WATER SINGLE STRENGTH'){
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
                if($nm_produk =='Kara Coco' || $nm_produk=='The Coco Tree Original' || $nm_produk=='Aseptic Coconut Water - Single Strength' || $nm_produk=='Hydro Coco 100% CW Packing 330 mL' || $nm_produk=='KARA COCONUT WATER SINGLE STRENGTH'){
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
            $data1 += floatval($row['hasil_m']);
        }

        $vardata =  $data1;
        echo $vardata;

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
        echo $data;
    }

    function get_data_picno_lqs081(){

        $dttgl_analisa = trim($this->input->post('dttgl_analisa'));
        $dt_tgltest = trim($this->input->post('dttgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);
        $normalitas_naoh = trim($this->input->post('normalitas_naoh'));

        //$dtpicno = $this->M_tambahan->getdata_picno($dttgl_analisa,$dtno);
        $dtnaoh = $this->M_tambahan->getdata_naoh_lqs081($tgltest,$normalitas_naoh);
        //$dtna2s2o3 = $this->M_tambahan->getdata_na2s2o3($tgltest);

        // foreach($dtpicno as $row){
        //     $data1 .= "<option value=".$row[picno_kosong].">$row[picno_kosong]</option>";
        //     $data2 .= $row['picno_kosong'];
        //     $data3 .= $row['picno_hasil'];
        // }

        foreach($dtnaoh as $row2){
            $data4 = $row2['hasil_m'];
        }

        // foreach($dtna2s2o3 as $row3){
        //     $data5 .= $row3['hasil_m'];
        // }

        $data =  $data4;
        echo $data;
    }

    function get_data_noah_sulfur(){
        $dt_tgltest = trim($this->input->post('dttgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dtnaoh = $this->M_tambahan->getdata_naoh($tgltest);

        foreach($dtnaoh as $row){
            $data1 = $row['hasil_m'];
        }

        $data =  $data1;
        echo $data;
    }

    function get_data_forlqs076(){
        $dt_tgltest = trim($this->input->post('dttgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dtnaoh = $this->M_tambahan->getdata_naoh($tgltest);
        $dtna2s2o3 = $this->M_tambahan->getdata_na2s2o3($tgltest);

        foreach($dtnaoh as $row){
            $data1 = $row['hasil_m'];
        }

        foreach($dtna2s2o3 as $row2){
            $data2 = $row2['hasil_m'];
        }

        $data =  $data1.",".$data2;
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
                                                <th rowspan ="3">Jumlah Contoh</th>
                                                <th colspan="9">Laboratorium Kimia</th>
                                                <th rowspan ="3">Keterangan</th>
                                                <th colspan="9">Laboratorium Mikro</th>
                                                <th rowspan ="3">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th colspan ="2">Diantar</th>
                                                <th colspan ="7">Diterima</th>
                                                <th colspan ="2">Diantar</th>
                                                <th colspan ="7">Diterima</th>
                                            </tr>
                                            <tr>
                                                <th>Jam</th>
                                                <th>Oleh</th>
                                                <th>Jam</th>
                                                <th>Oleh</th>
                                                <th>Kondisi Sampel</th>
                                                <th>Kondisi Alat</th>
                                                <th>Ketersediaan Media Reagen</th>
                                                <th>Ketersediaan Personil</th>
                                                <th>Ketersediaan Refrence Culture</th>
                                                <th>Jam</th>
                                                <th>Oleh</th>
                                                <th>Jam</th>
                                                <th>Oleh</th>
                                                <th>Kondisi Sampel</th>
                                                <th>Kondisi Alat</th>
                                                <th>Ketersediaan Media Reagen</th>
                                                <th>Ketersediaan Personil</th>
                                                <th>Ketersediaan Refrence Culture</th>
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
                                                <td>
                                                   <select name="kondisi_alat[]" class="kondisi_alat" id="kondisi_alat">
                                                       <option value=""></option>
                                                       <option value="Sesuai">Sesuai</option>
                                                       <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                    </select>
                                                </td>
                                                <td>
                                                   <select name="ketersediaan_media[]" class="ketersediaan_media" id="ketersediaan_media">
                                                       <option value=""></option>
                                                       <option value="Sesuai">Sesuai</option>
                                                       <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                    </select>
                                                </td>
                                                <td>
                                                   <select name="ketersediaan_personil[]" class="ketersediaan_personil" id="ketersediaan_personil">
                                                       <option value=""></option>
                                                       <option value="Sesuai">Sesuai</option>
                                                       <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                    </select>
                                                </td>
                                                <td>
                                                   <select name="ketersediaan_culture[]" class="ketersediaan_culture" id="ketersediaan_culture">
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
                                                <td>
                                                   <select name="kondisi_alat2[]" class="kondisi_alat2" id="kondisi_alat2">
                                                       <option value=""></option>
                                                       <option value="Sesuai">Sesuai</option>
                                                       <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                    </select>
                                                </td>
                                                <td>
                                                   <select name="ketersediaan_media2[]" class="ketersediaan_media2" id="ketersediaan_media2">
                                                       <option value=""></option>
                                                       <option value="Sesuai">Sesuai</option>
                                                       <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                    </select>
                                                </td>
                                                <td>
                                                   <select name="ketersediaan_personil2[]" class="ketersediaan_personil2" id="ketersediaan_personil2">
                                                       <option value=""></option>
                                                       <option value="Sesuai">Sesuai</option>
                                                       <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                    </select>
                                                </td>
                                                <td>
                                                   <select name="ketersediaan_culture2[]" class="ketersediaan_culture2" id="ketersediaan_culture2">
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
                                            <td colspan="29" align="center">
                                                    <button type="button" class="btn btn-sm btn-info" onClick="addRow(\'dataTable\')">Tambah Baris</button>
                                                    <button type="button" class="btn btn-sm btn-warning" onClick="deleteRow(\'dataTable\')">Hapus Baris</button>

                                            </td>
                                        </tr>
                                    </tfoot>';

        $data = $data1.",".$data2;
        echo $data;
    }

    function get_dtjenis_produk003(){

        $tipe_contoh = $this->input->post('tipe_contoh');

        $dt_jenis_produk = $this->M_tambahan->get_jenis_produk2($tipe_contoh);
        $data1 = "<option value=''>--pilih--</option>";
        foreach($dt_jenis_produk as $row){
            if($row['jenis_produk']==$row['jenis_produk2']){
             $data1 .= '<option value="'.$row['id_jenis_produk'].'">' .$row['jenis_produk2']. '</option>';
            }else{
                if($row['jenis_produk2']==''){
                    $data1 .= '<option value="'.$row['id_jenis_produk'].'">' .$row['jenis_produk']. '</option>';
                }else{
                    $data1 .= '<option value="'.$row['id_jenis_produk'].'">' .$row['jenis_produk2'].' / '.$row['jenis_produk']. '</option>';
                }
            }
        }

            $data2 = '';

        $data = $data1.",".$data2;
        echo $data;
    }

    function get_dtjenis_proses(){

        $tipe_contoh = $this->input->post('tipe_contoh');
        $jns_produk  = $this->input->post('jenis_produk');
        $jns_proses  = $this->input->post('jenis_proses');

        $dt_jenis_proses = $this->M_tambahan->get_jenis_proses($tipe_contoh,$jns_produk);
        $data1 = "<option value=''>--pilih--</option>";
        foreach($dt_jenis_proses as $row){
            if($jns_proses==$row['jenis_proses2']){
                $data1 .= '<option value="'.$row['jenis_proses'].'" selected>' .$row['jenis_proses2']. '</option>';
            }else if($row['jenis_proses']==$row['jenis_proses2']){
                $data1 .= '<option value="'.$row['jenis_proses'].'">' .$row['jenis_proses2']. '</option>';
            }else{
                if($row['jenis_proses2']==''){
                    $data1 .= '<option value="'.$row['jenis_proses'].'">' .$row['jenis_proses']. '</option>';
                }else{
                    $data1 .= '<option value="'.$row['jenis_proses'].'">' .$row['jenis_proses2'].' / '.$row['jenis_proses']. '</option>';
                }
            }
        }
            $data2 = '';

        $data = $data1.",".$data2;
        echo $data;
    }


    function get_element_html_lqs002(){

    }


    function get_produkid(){

        $ndt_jns_produk = $this->input->post('jenis_produk');

        $dtproduk_id_hdr = $this->M_tambahan->get_produkid($ndt_jns_produk);
        $data_productid = "<option value=''>- pilih -</option>";
        foreach($dtproduk_id_hdr as $row){
             $data_productid .= '<option value="'.$row->ProductID.'">' .$row->ProductID. '</option>';
        }

        echo $data_productid;
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


    function get_dt_nm_productnon078(){

        $tipe_contoh = $this->input->post('tipe_contoh');

        $dt_nm_produk = $this->M_tambahan->get_jenis_produk_non078($tipe_contoh);
        $data1 = "<option value=''>--pilih--</option>";
        foreach($dt_nm_produk as $row){
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
        $data = $data1;
        echo $data;
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

    function get_opt_formula002(){
        $tipe_contoh = $this->input->post('tipe_contoh');
        $jns_produk = $this->input->post('jns_produk');
        $dtoptformula002 = $this->M_tambahan->getoptformula002($tipe_contoh,$jns_produk);

        $jml=count($dtoptformula002);
        $opt_formula = "";
        if($jml>0){
            foreach($dtoptformula002 as $rowdtoptformula002){
                 $opt_formula .= '<option value="'.$rowdtoptformula002['nama_formula'].'">' .$rowdtoptformula002['nama_formula']. '</option>';
            }
        }else{
            $opt_formula = "";
        }

        echo $opt_formula;
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
       echo $data;
    }

    function get_sampel_cip_wtpprocessing(){
        $tipe_contoh   = $this->input->post('tipe_contoh');
        $jns_produk    = $this->input->post('jns_produk');
        $tgl_produksi  = $this->input->post('tgl_produksi');

        $dtDivKdSampel002 = $this->M_tambahan->getDiv_sampel_cip_wtpprocessing($tgl_produksi);
        $jml_dt = count($dtDivKdSampel002);
        if($jml_dt>0){
            $data_sampel_wtp = "<select name='deskripsi[]' id='deskripsi' class='deskripsi'><option value=''>--pilih--</option>";
            foreach($dtDivKdSampel002 as $rowDivKdSampel002){
                 $data_sampel_wtp .= '<option value="'.$rowDivKdSampel002->kode_sample.'">'.$rowDivKdSampel002->kode_sample. '</option>';
            }
            $data_sampel_wtp .="</select>";
        }else{
            $data_sampel_wtp = "<input type='text' name='deskripsi[]' id='deskripsi' class='deskripsi'/>";
        }

        echo $data_sampel_wtp;
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

    function get_nopo(){
        $jns_produk = $this->input->post('jns_produk');

        $dt_nopo = $this->M_tambahan->get_nopo($jns_produk);
        $jml_dt2 = count($dt_nopo);
        if($jml_dt2>0){
            $data = "<option value=''>-pilih-</option>";
            foreach($dt_nopo as $rowdt_nopo){
                $data .= '<option value="'.$rowdt_nopo['no_po'].'">' .$rowdt_nopo['no_po']. '</option>';
            }
        }else{
            $data = "<option value=''>-pilih-</option>";
        }
       echo $data;
    }

    // function get_shelflife(){
    //     $dt_tipe_contoh = $this->input->post('tipe_contoh');
    //     $dt_jns_produk = $this->input->post('jns_produk');

    //     switch($dt_jns_produk){
    //        case $dt_jns_produk=='UHT-CC':
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
    //                 case $dt_jns_produk=='UHT-CC' || $dt_jns_produk=='Coconut Milk Powder' || $dt_jns_produk=='CWB' || $dt_jns_produk=='CMB':
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
                    case $dt_jns_produk=='UHT-CC':
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
                    break;
                }
            break;
            case $dt_tipe_contoh=='Finished Product':
                switch($dt_jns_produk){
                    case $dt_jns_produk=='UHT-CC' || $dt_jns_produk=='CWB' || $dt_jns_produk=='CMB' || $dt_jns_produk=='CMD' || $dt_jns_produk=='CWD' || $dt_jns_produk=='CWC' || $dt_jns_produk=='SEMI CWC':
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
                    break;
                    case $dt_jns_produk=='UHT-CC' || $dt_jns_produk=='Coconut Milk Powder':
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
                        $data11 = "<input type='text' id='qty_tank'  name='qty_tank[]'/>";
                        $data12 = "Quantity Tank";
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
                    break;
                }
            break;
            case $dt_tipe_contoh=='Shelf Life':
                    switch($dt_jns_produk){
                    case $dt_jns_produk=='UHT-CC' || $dt_jns_produk=='CWB' || $dt_jns_produk=='CMB'|| $dt_jns_produk=='CWD'|| $dt_jns_produk=='CMD':
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
            break;
        }

        $datas = $data1.",".$data2.",".$data3.",".$data4.",".$data5.",".$data6.",".$data7.",".$data8.",".$data9.",".$data10.",".$data11.",".$data12.",".$data13.",".$data14.",".$data15.",".$data16.",".$data17.",".$data18.",".$data19.",".$data20.",".$data21.",".$data22.",".$data23.",".$data24.",".$data25.",".$data26.",";
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
             $data_formula .= '<option value="'.trim($row['formula']).'">'.trim($row['formula']).' - '.$row['deskripsi_formula'].'</option>';
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

    function get_data_naoh_hcl_frmlqs142(){

        $tanggal = trim($this->input->post('tanggal'));
        $dt_tgltest = trim($this->input->post('tanggal'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dthcl1m = $this->M_tambahan->getdata_hcl1m($tgltest);
        $dtnaoh1m = $this->M_tambahan->getdata_naoh01000($tgltest);

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

    function get_data_naoh_hcl_labcmp2(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dthcl1m = $this->M_tambahan->getdata_hcl1m_labcmp2($tgltest);
        $dtnaoh1m = $this->M_tambahan->getdata_naoh1m_labcmp2($tgltest);

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

function get_data_naoh_hcl_induk2(){

        $tgl_analisa = trim($this->input->post('tgl_analisa'));
        $dt_tgltest = trim($this->input->post('tgl_analisa'));
        $tgltest = substr($dt_tgltest,6,4).'-'.substr($dt_tgltest,3,2).'-'.substr($dt_tgltest,0,2);

        $dthcl1m    = $this->M_tambahan->getdata_hcl1m_induk($tgltest);
        $dtnaoh1m   = $this->M_tambahan->getdata_naoh1m_induk($tgltest);
        $dtcation1m = $this->M_tambahan->getdata_naoh00100($tgltest);
        $dtanion1m  = $this->M_tambahan->getdata_hcl002($tgltest);

        $data1 = 0;
        foreach($dthcl1m as $row) {
            // $data1 .= $row[picno_kosong];
            $data1 += floatval($row['hasil_m']);
        }

        $data2 = 0;
        foreach($dtnaoh1m as $row) {
            // $data1 .= $row[picno_kosong];
            $data2 += floatval($row['hasil_m']);
        }

        $data3 = 0;
        foreach ($dtcation1m as $row) {
            $data3 += floatval($row['hasil_m']);
        }

        $data4 = 0;
        foreach ($dtanion1m as $row) {
            $data4 += floatval($row['hasil_m']);
        }

        $data =  $data1.",".$data2.",".$data3.",".$data4;

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
            $dtprid = $this->M_tambahan->get_data_lqs077_2($tgl_produksi,$filler,$jam_sampling,$suhu,$tipe_contoh,$jns_produk,$varian,$sample_type);
        }else{
            $dtprid = $this->M_tambahan->get_data_lqs077($tgl_produksi,$filler,$kode_pack,$jam_sampling,$suhu,$tipe_contoh,$jns_produk,$sample_type);
        }
        $datas1d='';

        if(count($dtprid)>0){
        foreach($dtprid as $row){
            $datas1 = $row['product_id'];
            $datas2 = $row['product_name'];
            $datas3 = $row['kode_sample'];
            $datas4 = $row['tgl_expired'];
            $datas5 = $row['ph'];
        }}else{
            $datas1 = '';
            $datas2 = '';
            $datas3 = '';
            $datas4 = '';
            $datas5 = '';
        }

        echo $data =  $datas1d.",".$datas1.",".$datas2.",".$datas3.",".$datas4.",".$datas5;
    }

    function get_data_product_id_lqs077_audit(){

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
            $dtprid = $this->M_tambahan->get_data_lqs077_2_audit($tgl_produksi,$filler,$jam_sampling,$suhu,$tipe_contoh,$jns_produk,$varian,$sample_type);
        }else{
            $dtprid = $this->M_tambahan->get_data_lqs077_audit($tgl_produksi,$filler,$kode_pack,$jam_sampling,$suhu,$tipe_contoh,$jns_produk,$sample_type);
        }
        $datas1d='';

        if(count($dtprid)>0){
        foreach($dtprid as $row){
            $datas1 = $row['product_id'];
            $datas2 = $row['product_name'];
            $datas3 = $row['kode_sample'];
            $datas4 = $row['tgl_expired'];
            $datas5 = $row['ph'];
        }}else{
            $datas1 = '';
            $datas2 = '';
            $datas3 = '';
            $datas4 = '';
            $datas5 = '';
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
                if($nm_produk=='Kara Coco' || $nm_produk=='The Coco Tree Original' || $nm_produk=='Aseptic Coconut Water - Single Strength' || $nm_produk=='Hydro Coco 100% CW Packing 330 mL' || $nm_produk=='KARA COCONUT WATER SINGLE STRENGTH'){
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

        $dt_nama_alat = $this->M_tambahan->getdata_nama_alat($nama_alat);
        echo '<option value=""></option>';
        foreach($dt_nama_alat as $row){
            echo '<option value="'.$row['no_inventaris'].'">'.$row['no_inventaris'].'</option>';
        }

    }

    function get_nama_form()
    {
        $kode_form = $this->input->post('kode_form');
        if ($kode_form == '') {
            echo '<option value="">-</option>';
        }else{
            $dt_kode_form = $this->M_tambahan->get_data_nama_form($kode_form);
            foreach($dt_kode_form as $row){
                echo '<option value="'.$row['formjudul'].'">'.$row['formjudul'].'</option>';
            }
        }

    }

    function get_range_pemakaian()
    {
        $kode_alat = $this->input->post('kode_alat');

        $dt_no_inventaris = $this->M_tambahan->get_dt_range_pemakaian($kode_alat);

        foreach($dt_no_inventaris as $row){
            echo $row['range_pemakaian'];
        }
    }

    function get_no_inventaris_a()
    {
       $nama_alat = $this->input->post('nm_alat');

       $dt_nama_alat = $this->M_tambahan->get_data_nama_alat_a($nama_alat);
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

    function get_listformula()
    {
        $dtformula = 'CMP';
        $dt_listformula = $this->M_tambahan->getlistformula_fss115($dtformula);
        echo '<option value="">- pilih -</option>';
        foreach($dt_listformula as $row){
            echo '<option value="'.$row['nama_formula'].'">'.$row['nama_formula'].'</option>';
        }

    }

    function get_parameter()
    {
        $dtjns_sample = $this->input->post('jns_sample');
        $dtparameter  = $this->input->post('parameter_uji');

        if ($dtjns_sample == 'Dessicated Coconut') {
            $ndtjns_sample = 'DSC';
        } elseif ($dtjns_sample == 'UHT-CC') {
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

    function get_koreksi_shu(){
        $no_inventaris = $this->input->post('no_inventaris');

        $dt_shu_koreksi = $this->M_tambahan->get_data_suhu_koreksi($no_inventaris);

        foreach($dt_shu_koreksi as $row_suhu){
            echo $row_suhu['dtl_u'];
        }
    }

    function get_koreksi_rh(){
        $no_inventaris = $this->input->post('no_inventaris');

        $dt_rh_koreksi = $this->M_tambahan->get_data_rh_koreksi($no_inventaris);

        foreach($dt_rh_koreksi as $row_rh){
            echo $row_rh['dtl_u'];
        }
    }

    function get_nm_alat(){
        $tgl_uji = trim($this->input->post('tgl_uji'));
        $dt_tgl_uji = trim($this->input->post('tgl_uji'));
        $tgluji = substr($dt_tgl_uji,6,4).'-'.substr($dt_tgl_uji,3,2).'-'.substr($dt_tgl_uji, 0,2);

        $dtnmalat   = $this->M_tambahan->get_dt_nmalat($tgluji);

            foreach($dtnmalat as $row){
            echo $row['nama_alat'];

        }
    }

    function get_faktor_koreksi_suhu(){
        $suhu1          = $this->input->post('suhu1');
        $nama_alat      = $this->input->post('nama_alat');
        $no_inventaris  = $this->input->post('no_inventaris');
        $dttgl_kontrol  = $this->input->post('tgl_kontrol');
        $tgl_kontrol = date("Y-m-d", strtotime($dttgl_kontrol));

        $dt_faktor = $this->M_tambahan->get_data_faktor_koreksi_suhu($suhu1,$nama_alat,$no_inventaris,$tgl_kontrol);

        foreach($dt_faktor as $row_fk){
            $data1 = $row_fk['koreksi'];
        }

        $data = $data1;
        echo $data;
    }

    function get_faktor_koreksi_rh(){
        $rh1 = $this->input->post('rh1');
        $nama_alat      = $this->input->post('nama_alat');
        $no_inventaris  = $this->input->post('no_inventaris');
        $dttgl_kontrol  = $this->input->post('tgl_kontrol');
        $tgl_kontrol = substr($dttgl_kontrol,6,4).'-'.substr($dttgl_kontrol,3,2).'-'.substr($dttgl_kontrol, 0,2);

        $dt_faktor2 = $this->M_tambahan->get_data_faktor_koreksi_rh($rh1,$nama_alat,$no_inventaris,$tgl_kontrol);

        foreach($dt_faktor2 as $row_fk2){
            $data3 = $row_fk2['koreksi'];
        }

        $data = $data3;
        echo $data;
    }

	 function get_lokasi()
    {
        $no_inventaris = $this->input->post('no_inventaris');

        $dt_lokasi = $this->M_tambahan->get_data_lokasi($no_inventaris);

        foreach($dt_lokasi as $row){
            echo $row['tempat_penyimpanan'];

        }
    }

    function get_batas_ph() {
        $nama_media     = $this->input->post('nama_media');

        $dt_batas_ph    = $this->M_tambahan->get_dtbatas_ph($nama_media);

        foreach($dt_batas_ph as $row){
            echo $row['batas_ph'];
        }
    }
    function get_jadwal()
    {
        $no_inventaris = $this->input->post('no_inventaris');

        $dt_jadwal = $this->M_tambahan->get_jadwal093($no_inventaris);
        $jadwal = "";

        foreach($dt_jadwal as $row){
             if($row->jdwl_prw_mingguan=='X'){
                $jadwal = 'Mingguan';
             }else if($row->jdwl_prw_bulanan=='X'){
                $jadwal = 'Bulanan';
             }
        } 
        echo $jadwal;
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


    function get_kdsampel002_lqs137(){
        $tipe_contoh = $this->input->post('tipe_contoh');
        $jns_produk = $this->input->post('jns_produk');

        $dtDivKdSampel002 = $this->M_tambahan->getDivKdSampel002($tipe_contoh,$jns_produk);
        $jml_dt = count($dtDivKdSampel002);
        if($jml_dt>0){
            $data_ops = '<option value="">- pilih test-</option>';
            foreach($dtDivKdSampel002 as $rowDivKdSampel002){
                 $data_ops .= '<option value="'.$rowDivKdSampel002['kode_sample'].'">' .$rowDivKdSampel002['kode_sample']. '</option>';
            }
        }else{
            $data_ops = '<option value=""></option>';
        }
       echo $data_ops;
    }

    function get_data_analisa_lqs137(){
        $tipe_contoh    = trim($this->input->post('tipe_contoh'));
        $jns_produk     = trim($this->input->post('jns_produk'));
        $date_received  = trim($this->input->post('date_received'));
        $vessel         = trim($this->input->post('vessel'));
        $shipment       = trim($this->input->post('shipment'));


        if($tipe_contoh=='PMK'){
                if($jns_produk=='Expeller Cake'){
                    $dtresult = $this->M_tambahan->getdata_result_pmk($tipe_contoh,$jns_produk,$date_received,$vessel,$shipment);

                    if(count($dtresult)>0){
                    foreach($dtresult as $result_row){
                         $data1 =  $result_row->tgl_analisa;
                         $data2 =  $result_row->mc_hasil;
                         $data3 =  $result_row->fc_hasil;
                         $data4 =  $result_row->ffa_hasil;
                         $data5 =  $result_row->qty_tank;
                         $data6 =  $result_row->detail_id_sampel087;
                         $data7 =  $result_row->detail_id087;
                         $data8 =  $result_row->headerid087;
                    }}else{
                        $data1 =  "";
                        $data2 =  "";
                        $data3 =  "";
                        $data4 =  "";
                        $data5 =  "";
                        $data6 =  "";
                        $data7 =  "";
                        $data8 =  "";
                    }

                }else{
                    $data1 =  "";
                    $data2 =  "";
                    $data3 =  "";
                    $data4 =  "";
                    $data5 =  "";
                    $data6 =  "";
                    $data7 =  "";
                    $data8 =  "";
                }
            }else{
                    $data1 =  "";
                    $data2 =  "";
                    $data3 =  "";
                    $data4 =  "";
                    $data5 =  "";
                    $data6 =  "";
                    $data7 =  "";
                    $data8 =  "";
            }

            $data_result =  $data1.",".$data2.", ".$data3.", ".$data4.", ".$data5.", ".$data6.", ".$data7.", ".$data8;
            echo $data_result;
            /*if(count($dtresult)>0){
                
            }else{

            }*/
    }

    function get_nodoc_lqs137(){
        $create_date   = trim($this->input->post('create_date'));
        $create_date_month = substr($create_date ,5,2);
        $create_date_year = substr($create_date ,0,4);

        $dtresult_nodoc = $this->M_tambahan->getdata_nodoc_lqs137($create_date_month,$create_date_year);

        foreach($dtresult_nodoc as $dtresult_nodoc_row){
            $nodoc = $dtresult_nodoc_row->nodoc;
        }

        switch($create_date_month){
            case $create_date_month=='01':
                $romawi_mmonth = 'I';
            break;
            case $create_date_month=='02':
                $romawi_mmonth = 'II';
            break;
            case $create_date_month=='03':
                $romawi_mmonth = 'III';
            break;
            case $create_date_month=='04':
                $romawi_mmonth = 'IV';
            break;
            case $create_date_month=='05':
                $romawi_mmonth = 'V';
            break;
            case $create_date_month=='06':
                $romawi_mmonth = 'VI';
            break;
            case $create_date_month=='07':
                $romawi_mmonth = 'VII';
            break;
            case $create_date_month=='08':
                $romawi_mmonth = 'VIII';
            break;
            case $create_date_month=='09':
                $romawi_mmonth = 'IX';
            break;
            case $create_date_month=='10':
                $romawi_mmonth = 'X';
            break;
            case $create_date_month=='11':
                $romawi_mmonth = 'XI';
            break;
            case $create_date_month=='12':
                $romawi_mmonth = 'XII';
            break;
            default:
                $romawi_mmonth = '';
            break;
        }

        if(strlen($nodoc)=='1'){
            $str_nodoc = '0'.$nodoc;
        }else{
            $str_nodoc = $nodoc;
        }

        echo $data_nodoc = $str_nodoc.'/QAD'.'/'.$romawi_mmonth.'/'.$create_date_year;
    }


    function get_nodoc_lqs136(){
        $create_date   = trim($this->input->post('create_date'));
        $create_date_month = substr($create_date ,5,2);
        $create_date_year = substr($create_date ,0,4);

        $dtresult_nodoc = $this->M_tambahan->getdata_nodoc_lqs136($create_date_month,$create_date_year);

        foreach($dtresult_nodoc as $dtresult_nodoc_row){
            $nodoc = $dtresult_nodoc_row->nodoc;
        }

        switch($create_date_month){
            case $create_date_month=='01':
                $romawi_mmonth = 'I';
            break;
            case $create_date_month=='02':
                $romawi_mmonth = 'II';
            break;
            case $create_date_month=='03':
                $romawi_mmonth = 'III';
            break;
            case $create_date_month=='04':
                $romawi_mmonth = 'IV';
            break;
            case $create_date_month=='05':
                $romawi_mmonth = 'V';
            break;
            case $create_date_month=='06':
                $romawi_mmonth = 'VI';
            break;
            case $create_date_month=='07':
                $romawi_mmonth = 'VII';
            break;
            case $create_date_month=='08':
                $romawi_mmonth = 'VIII';
            break;
            case $create_date_month=='09':
                $romawi_mmonth = 'IX';
            break;
            case $create_date_month=='10':
                $romawi_mmonth = 'X';
            break;
            case $create_date_month=='11':
                $romawi_mmonth = 'XI';
            break;
            case $create_date_month=='12':
                $romawi_mmonth = 'XII';
            break;
            default:
                $romawi_mmonth = '';
            break;
        }

        if(strlen($nodoc)=='1'){
            $str_nodoc = '0'.$nodoc;
        }else{
            $str_nodoc = $nodoc;
        }

        echo $data_nodoc = $str_nodoc.'/QAD'.'/'.$romawi_mmonth.'/'.$create_date_year;
    }

    function get_doc_hcc004(){
        $create_date   = trim($this->input->post('create_date'));
        // $product_name  = addslashes($this->input->post('product_name'));
        $create_date_day = substr($create_date ,8,2);
        $create_date_month = substr($create_date ,5,2);
        $create_date_year = substr($create_date ,0,4);

        $dtresult_doc = $this->M_tambahan->getdata_doc_hcc004($create_date_day,$create_date_month,$create_date_year);

        // $dtresult_pname = $this->M_tambahan->getdata_pname_hcc004($product_name);

        // foreach ($dtresult_pname as $pname) {
        //     $product_name = $pname->product_name;
        // }

        foreach($dtresult_doc as $dtresult_doc_row){
            $doc = $dtresult_doc_row->doc;
            // $product_name = $$dtresult_doc_row->product_name;
        }

        switch($create_date_month){
            case $create_date_month=='01':
                $romawi_mmonth = 'I';
            break;
            case $create_date_month=='02':
                $romawi_mmonth = 'II';
            break;
            case $create_date_month=='03':
                $romawi_mmonth = 'III';
            break;
            case $create_date_month=='04':
                $romawi_mmonth = 'IV';
            break;
            case $create_date_month=='05':
                $romawi_mmonth = 'V';
            break;
            case $create_date_month=='06':
                $romawi_mmonth = 'VI';
            break;
            case $create_date_month=='07':
                $romawi_mmonth = 'VII';
            break;
            case $create_date_month=='08':
                $romawi_mmonth = 'VIII';
            break;
            case $create_date_month=='09':
                $romawi_mmonth = 'IX';
            break;
            case $create_date_month=='10':
                $romawi_mmonth = 'X';
            break;
            case $create_date_month=='11':
                $romawi_mmonth = 'XI';
            break;
            case $create_date_month=='12':
                $romawi_mmonth = 'XII';
            break;
            default:
                $romawi_mmonth = '';
            break;
        }

        if(strlen($doc)=='1'){
            $str_doc = '0'.$doc;
        }else{
            $str_doc = $doc;
        }

        // if ($product_name == 'UHT-CC') {
        //     $p_name = 'CCM';
        // } else {
        //     $p_name = $p_name;
        // }

        // echo $data_doc = $str_doc.'/QAD'.'/'.$romawi_mmonth.'/'.$create_date_year;
        echo $data_doc = 'CP2/QAD'.'/'.$create_date_day.'/'.$romawi_mmonth.'/'.$create_date_year.'/'.'CCM';
    }

    function get_formula_forspect($jns_produk){
        /*$kategori_produk = $_POST['kategori_produk'];*/
        $dt_frml = $this->M_tambahan->get_dt_formula($jns_produk);

        $data_formula .= "<option value=''>- pilih -</option>";
        foreach($dt_frml as $row){
             $data_formula .= '<option value="'.trim($row['formula']).'">'.trim($row['formula']).' - '.$row['deskripsi_formula'].'</option>';
        }
        echo $data_formula;
    }

    function cek_aksi(){
        $val_folder         = $this->input->post('val_folder');
        $val_controller     = $this->input->post('val_controller');
        $val_fungsi         = $this->input->post('val_fungsi');
        $val_form_kd        = $this->input->post('val_form_kd');
        $val_form_versi     = $this->input->post('val_form_versi');
        $val_form_aksi      = $this->input->post('val_form_aksi');
        $val_headerid       = $this->input->post('val_headerid');
        $val_param          = $this->input->post('val_param');
        $val_comp           = gethostbyaddr($_SERVER['REMOTE_ADDR']);

        $go_aksi = $this->M_tambahan->cek_log_aksi($val_fungsi,$val_form_kd,$val_form_versi,$val_headerid,$val_param,$val_comp);

        if($go_aksi->num_rows() > 0 ){
            echo $hasil_aksi='1';
        }else{
            $val_by    = '';
            $val_date  = date('Y-m-d');
            
            $val_start = date('H:i:s');

            $detail_aksi = array(
                         'log_aksi_fungsi'          => $val_fungsi,
                         'log_aksi_form_kd'         => $val_form_kd,
                         'log_aksi_form_versi'      => $val_form_versi,
                         'log_aksi_form_aksi'       => $val_form_aksi,
                         'log_aksi_headerid'        => $val_headerid,
                         'log_aksi_param'           => $val_param,
                         'log_aksi_by'              => $val_by,
                         'log_aksi_date'            => $val_date,
                         'log_aksi_comp'            => $val_comp,
                         'log_aksi_start'           => $val_start
                    );
            $save_aksi = $this->M_tambahan->insert_log_aksi($detail_aksi);
            echo $hasil_aksi='0';
        }
    }


    function get_data_ster(){
        $val_timestamp         = $this->input->post('get_timestamp');
        $val_at                = $this->input->post('get_at');

        $val_data_ster = $this->M_tambahan->get_data_ster($val_timestamp,$val_at);
      
        if ( count($val_data_ster)>0) {
             foreach ($val_data_ster as $data_ster_row) {
            
            $data1 = $data_ster_row -> $at1_step; 
            $data2 = $data_ster_row -> $at1_timer; 
            $data3 = $data_ster_row -> $at1_TI150; 
            $data4 = $data_ster_row -> $at1_PS130; 
            $data5 = $data_ster_row -> $at1_TI140; 
            $data6 = $data_ster_row -> $at1_TI160; 
            $data7 = $data_ster_row -> $at1_TI170; 
            $data8 = $data_ster_row -> $at1_LT110; 
            $data9 = $data_ster_row -> $at1_PIC130; 
            }

        }else {
            $data1 = ''; 
            $data2 = ''; 
            $data3 = ''; 
            $data4 = ''; 
            $data5 = ''; 
            $data6 = ''; 
            $data7 = ''; 
            $data8 = ''; 
            $data9 = ''; 

        }
         
        $data=$data1.'/'.$data2.'/'.$data3.'/'.$data4.'/'.$data5.'/'.$data6.'/'.$data7.'/'.$data8.'/'.$data9;
        echo $data;
    }

    function getJamSampling()
    {
        $tipe_contoh      = $this->input->post('tipe_contoh');
        $jns_produk       = $this->input->post('jns_produk');
        $tanggal_antar    = $this->input->post('tanggal_antar');
        $tanggal_produksi = $this->input->post('tanggal_produksi');
        $filler           = $this->input->post('filler');
        $varian_produk    = $this->input->post('varian_produk');

        $list_jamSampling = $this->M_tambahan->getList_jamSampling($tipe_contoh,$jns_produk,$tanggal_antar,$tanggal_produksi,$filler,$varian_produk);
        $data_jam .= "<option value=''>- pilih -</option>";
        if (count($list_jamSampling) > 0) {
            foreach ($list_jamSampling as $value) {
                $data_jam .= '<option value="'.trim($value['jam_sampling']).'">'.$value['jam_sampling'].'</option>';
            }
        }else{
            $data_jam = "";
        }

        $data = $data_jam;
        echo $data;
    }

    function getJamSamplingx()
    {
        $tipe_contoh      = $this->input->post('tipe_contoh');
        $jns_produk       = $this->input->post('jns_produk');
        $tanggal_antar    = $this->input->post('tanggal_antar');
        $tanggal_produksi = $this->input->post('tanggal_produksi');
        $filler           = $this->input->post('filler');
        $varian_produk    = $this->input->post('varian_produk');

        $list_jamSampling = $this->M_tambahan->getList_jamSamplingx($tipe_contoh,$jns_produk,$tanggal_antar,$tanggal_produksi,$filler,$varian_produk);
        $data_jam .= "<option value=''>- pilih -</option>";
        if (count($list_jamSampling) > 0) {
            foreach ($list_jamSampling as $value) {
                $data_jam .= '<option value="'.trim($value['jam_sampling']).'">'.$value['jam_sampling'].'</option>';
            }
        }else{
            $data_jam = "";
        }

        $data = $data_jam;
        echo $data;
    }

    function getDataSamplingTime()
    {
        $tipe_contoh       = $this->input->post('tipe_contoh');
        $jns_produk        = $this->input->post('jns_produk');
        $tanggal_antar     = $this->input->post('tanggal_antar');
        $tanggal_produksi  = $this->input->post('tanggal_produksi');
        $filler            = $this->input->post('filler');
        $varian_produk     = $this->input->post('varian_produk');
        $sampling_time     = $this->input->post('sampling_time');
        $incubation_sample = $this->input->post('incubation_sample');

        $data_jamSampling = $this->M_tambahan->getData_jamSampling($tipe_contoh,$jns_produk,$tanggal_antar,$tanggal_produksi,$filler,$sampling_time,$incubation_sample,$varian_produk);
        if (count($data_jamSampling) > 0) {
            foreach ($data_jamSampling as $value) {
                $data1 = $value['detail_id002'];
                $data2 = $value['inkubasi083'];
                $data3 = $value['deskripsi002'];
                $data4 = $value['product_id002'];
                $data5 = $value['expiry_date002'];
                $data6 = $value['headerid002'];

                $data7 = $value['tgl_analisa'];
                $data8 = $value['ph'];
                $data9 = $value['csp_ha_30'];
                $data10 = $value['csp_la_35'];
                $data11 = $value['csp_la_55'];

                if ($value['op_tpc_hasil'] == '0') { $op_tpc_hasil = "<"; }elseif ($value['op_tpc_hasil'] == '1') { $op_tpc_hasil = ">"; }else{ $op_tpc_hasil = ""; }
                if ($value['op_tsc_35'] == '0') { $op_tsc_35 = "<"; }elseif ($value['op_tsc_35'] == '1') { $op_tsc_35 = ">"; }else{ $op_tsc_35 = ""; }
                if ($value['op_ttr_35'] == '0') { $op_ttr_35 = "<"; }elseif ($value['op_ttr_35'] == '1') { $op_ttr_35 = ">"; }else{ $op_ttr_35 = ""; }
                if ($value['op_ttr_55'] == '0') { $op_ttr_55 = "<"; }elseif ($value['op_ttr_55'] == '1') { $op_ttr_55 = ">"; }else{ $op_ttr_55 = ""; }

                $data12 = $op_tpc_hasil.' '.$value['tpc_hasil'];
                $data13 = $value['tpc_paraf'];

                $data14 = $op_tsc_35.' '.$value['tsc_35_hasil'];
                $data15 = $op_ttr_35.' '.$value['ttr_35_hasil'];
                $data16 = $op_ttr_55.' '.$value['ttr_55_hasil'];

                if ((($value['ham_tsc_paraf'] == '')||($value['ham_tsc_paraf'] == NULL))&&(($value['ham_ttr_paraf'] == '')||($value['ham_ttr_paraf'] == NULL))) {
                    $spore_count_paraf = "";
                } elseif ((($value['ham_tsc_paraf'] == '')||($value['ham_tsc_paraf'] == NULL))&&(($value['ham_ttr_paraf'] != '')||($value['ham_ttr_paraf'] != NULL))) {
                    $spore_count_paraf = $value['ham_ttr_paraf'];
                } elseif ((($value['ham_ttr_paraf'] == '')||($value['ham_ttr_paraf'] == NULL))&&(($value['ham_tsc_paraf'] != '')||($value['ham_tsc_paraf'] != NULL))) {
                    $spore_count_paraf = $value['ham_tsc_paraf'];
                } elseif ((($value['ham_tsc_paraf'] != '')||($value['ham_tsc_paraf'] != NULL))&&(($value['ham_ttr_paraf'] != '')||($value['ham_ttr_paraf'] != NULL))) {
                    $spore_count_paraf = $value['ham_tsc_paraf'].' / '.$value['ham_ttr_paraf'];
                }
                
                $data17 = $spore_count_paraf;

                if ((($value['keterangan'] == '')||($value['keterangan'] == NULL))&&(($value['ket_monitoring'] == '')||($value['ket_monitoring'] == NULL))) {
                    $remarks = "";
                } elseif ((($value['keterangan'] == '')||($value['keterangan'] == NULL))&&(($value['ket_monitoring'] != '')||($value['ket_monitoring'] != NULL))) {
                    $remarks = $value['ket_monitoring'];
                } elseif ((($value['ket_monitoring'] == '')||($value['ket_monitoring'] == NULL))&&((($value['keterangan'] != '')||($value['keterangan'] != NULL)))) {
                    $remarks = $value['keterangan'];
                } elseif ((($value['keterangan'] != '')||($value['keterangan'] != NULL))&&(($value['ket_monitoring'] != '')||($value['ket_monitoring'] != NULL))) {
                    $remarks = $value['keterangan'].' / '.$value['ket_monitoring'];
                }

                $data18 = $remarks;
            }
        }else{
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
                $data13 = "";

                $data14 = "";
                $data15 = "";
                $data16 = "";
                $data17 = "";

                $data18 = "";
        }

        $data = $data1.",".$data2.",".$data3.",".$data4.",".$data5.",".$data6.",".$data7.",".$data8.",".$data9.",".$data10.",".$data11.",".$data12.",".$data13.",".$data14.",".$data15.",".$data16.",".$data17.",".$data18;
        echo $data;
    }

    function getDataSamplingTimex()
    {
        $tipe_contoh       = $this->input->post('tipe_contoh');
        $jns_produk        = $this->input->post('jns_produk');
        $tanggal_antar     = $this->input->post('tanggal_antar');
        $tanggal_produksi  = $this->input->post('tanggal_produksi');
        $filler            = $this->input->post('filler');
        $varian_produk     = $this->input->post('varian_produk');
        $sampling_time     = $this->input->post('sampling_time');
        $incubation_sample = $this->input->post('incubation_sample');

        $data_jamSampling = $this->M_tambahan->getData_jamSamplingx($tipe_contoh,$jns_produk,$tanggal_antar,$tanggal_produksi,$filler,$sampling_time,$incubation_sample,$varian_produk);
        if (count($data_jamSampling) > 0) {
            foreach ($data_jamSampling as $value) {
                $data1 = $value['detail_id002'];
                $data2 = $value['inkubasi083'];
                $data3 = $value['deskripsi002'];
                $data4 = $value['product_id002'];
                $data5 = $value['expiry_date002'];
                $data6 = $value['headerid002'];

                $data7 = $value['tgl_analisa'];
                $data8 = $value['ph'];
                $data9 = $value['csp_ha_30'];
                $data10 = $value['csp_la_35'];
                $data11 = $value['csp_la_55'];

                if ($value['op_tpc_hasil'] == '0') { $op_tpc_hasil = "<"; }elseif ($value['op_tpc_hasil'] == '1') { $op_tpc_hasil = ">"; }else{ $op_tpc_hasil = ""; }
                if ($value['op_tsc_35'] == '0') { $op_tsc_35 = "<"; }elseif ($value['op_tsc_35'] == '1') { $op_tsc_35 = ">"; }else{ $op_tsc_35 = ""; }
                if ($value['op_ttr_35'] == '0') { $op_ttr_35 = "<"; }elseif ($value['op_ttr_35'] == '1') { $op_ttr_35 = ">"; }else{ $op_ttr_35 = ""; }
                if ($value['op_ttr_55'] == '0') { $op_ttr_55 = "<"; }elseif ($value['op_ttr_55'] == '1') { $op_ttr_55 = ">"; }else{ $op_ttr_55 = ""; }

                $data12 = $op_tpc_hasil.' '.$value['tpc_hasil'];
                $data13 = $value['tpc_paraf'];

                $data14 = $op_tsc_35.' '.$value['tsc_35_hasil'];
                $data15 = $op_ttr_35.' '.$value['ttr_35_hasil'];
                $data16 = $op_ttr_55.' '.$value['ttr_55_hasil'];

                if ((($value['ham_tsc_paraf'] == '')||($value['ham_tsc_paraf'] == NULL))&&(($value['ham_ttr_paraf'] == '')||($value['ham_ttr_paraf'] == NULL))) {
                    $spore_count_paraf = "";
                } elseif ((($value['ham_tsc_paraf'] == '')||($value['ham_tsc_paraf'] == NULL))&&(($value['ham_ttr_paraf'] != '')||($value['ham_ttr_paraf'] != NULL))) {
                    $spore_count_paraf = $value['ham_ttr_paraf'];
                } elseif ((($value['ham_ttr_paraf'] == '')||($value['ham_ttr_paraf'] == NULL))&&(($value['ham_tsc_paraf'] != '')||($value['ham_tsc_paraf'] != NULL))) {
                    $spore_count_paraf = $value['ham_tsc_paraf'];
                } elseif ((($value['ham_tsc_paraf'] != '')||($value['ham_tsc_paraf'] != NULL))&&(($value['ham_ttr_paraf'] != '')||($value['ham_ttr_paraf'] != NULL))) {
                    $spore_count_paraf = $value['ham_tsc_paraf'].' / '.$value['ham_ttr_paraf'];
                }
                
                $data17 = $spore_count_paraf;

                if ((($value['keterangan'] == '')||($value['keterangan'] == NULL))&&(($value['ket_monitoring'] == '')||($value['ket_monitoring'] == NULL))) {
                    $remarks = "";
                } elseif ((($value['keterangan'] == '')||($value['keterangan'] == NULL))&&(($value['ket_monitoring'] != '')||($value['ket_monitoring'] != NULL))) {
                    $remarks = $value['ket_monitoring'];
                } elseif ((($value['ket_monitoring'] == '')||($value['ket_monitoring'] == NULL))&&((($value['keterangan'] != '')||($value['keterangan'] != NULL)))) {
                    $remarks = $value['keterangan'];
                } elseif ((($value['keterangan'] != '')||($value['keterangan'] != NULL))&&(($value['ket_monitoring'] != '')||($value['ket_monitoring'] != NULL))) {
                    $remarks = $value['keterangan'].' / '.$value['ket_monitoring'];
                }

                $data18 = $remarks;
            }
        }else{
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
                $data13 = "";

                $data14 = "";
                $data15 = "";
                $data16 = "";
                $data17 = "";

                $data18 = "";
        }

        $data = $data1.",".$data2.",".$data3.",".$data4.",".$data5.",".$data6.",".$data7.",".$data8.",".$data9.",".$data10.",".$data11.",".$data12.",".$data13.",".$data14.",".$data15.",".$data16.",".$data17.",".$data18;
        echo $data;
    }

    function list_filler_productid(){
        $jenis_produk = $this->input->post('jenis_produk');

        $data_filler = $this->M_tambahan->getData_filler($jenis_produk);
        echo '<option value="">- pilih -</option>';
        foreach($data_filler as $row){
            echo '<option value="'.$row['filler_name'].'">'.$row['filler_name'].'</option>';
        }
    }

    function data_productid(){
        $jenis_produk = $this->input->post('jenis_produk');

        $data_prodid = $this->M_tambahan->get_productid091($jenis_produk);
        echo '<option value="">- pilih -</option>';
        foreach($data_prodid as $row){
            echo '<option value="'.$row['product_id'].'">'.$row['product_id'].'</option>';
        }
    }

    function data_filler_productid(){
        $jenis_produk = $this->input->post('jenis_produk');
        $filler       = $this->input->post('filler');

        $data_productid = $this->M_tambahan->getData_productid($jenis_produk,$filler);
        echo '<option value="">- pilih -</option>';
        foreach($data_productid as $row){
            echo '<option value="'.$row['product_id'].'">'.$row['product_id'].'</option>';
        }
    }

    function getresult_edta(){
        $normalitas = $this->input->post('normalitas');
        $tgl_analisa = $this->input->post('tgl_analisa');
        $tgltest = substr($tgl_analisa,6,4).'-'.substr($tgl_analisa,3,2).'-'.substr($tgl_analisa,0,2);
        $dtdetail = $this->M_tambahan->getdata_edta_qad150($tgltest,$normalitas);

        foreach ($dtdetail as $key) {
            $data = $key['hasil_m'];
        }
        
        echo $data;
    }

    function getresult_agno3(){
        $normalitas = $this->input->post('normalitas');
        $tgl_analisa = $this->input->post('tgl_analisa');
        $tgltest = substr($tgl_analisa,6,4).'-'.substr($tgl_analisa,3,2).'-'.substr($tgl_analisa,0,2);
        $dtdetail = $this->M_tambahan->getdata_agno3_qad150($tgltest,$normalitas);

        foreach ($dtdetail as $key) {
            $data = $key['hasil_m'];
        }
        
        echo $data;
    }

    function getresult_kio3(){
        $normalitas = $this->input->post('normalitas');
        $tgl_analisa = $this->input->post('tgl_analisa');
        $tgltest = substr($tgl_analisa,6,4).'-'.substr($tgl_analisa,3,2).'-'.substr($tgl_analisa,0,2);
        $dtdetail = $this->M_tambahan->getdata_KIO3_qad150($tgltest,$normalitas);

        foreach ($dtdetail as $key) {
            $data = $key['hasil_m'];
        }
        
        echo $data;
    }

    function getresult_naoh(){
        $normalitas = $this->input->post('normalitas');
        $tgl_analisa = $this->input->post('tgl_analisa');
        $tgltest = substr($tgl_analisa,6,4).'-'.substr($tgl_analisa,3,2).'-'.substr($tgl_analisa,0,2);
        $dtdetail = $this->M_tambahan->getdata_NaOH_qad150($tgltest,$normalitas);

        foreach ($dtdetail as $key) {
            $data = $key['hasil_m'];
        }
        
        echo $data;
    }

    function get_data_sg_kode_alat(){
        $dttgl_analisa = $this->input->post('dttgl_analisa');
        $tglanalisa = substr($dttgl_analisa,6,4).'-'.substr($dttgl_analisa,3,2).'-'.substr($dttgl_analisa,0,2);

        $data_kodealat = $this->M_tambahan->getData_sg_kode_alat($tglanalisa);
        echo '<option value="">- pilih -</option>';
        foreach($data_kodealat as $row){
            echo '<option value="'.$row['sg_kode_alat'].'">'.$row['sg_kode_alat'].'</option>';
        }
    }

    function get_data_sg_kode_alat2(){
        $dttgl_analisa = $this->input->post('dttgl_analisa');
        $dtsg_kode_alat = $this->input->post('dtsg_kode_alat');
        $tglanalisa = substr($dttgl_analisa,6,4).'-'.substr($dttgl_analisa,3,2).'-'.substr($dttgl_analisa,0,2);

        $data_kodealat2 = $this->M_tambahan->getData_sg_kode_alat2($tglanalisa,$dtsg_kode_alat);
        $data1 .= '<option value="">- pilih -</option>';
        foreach($data_kodealat2 as $row){
            $data1 .= '<option value="'.$row['sg_kode_alat2'].'">'.$row['sg_kode_alat2'].'</option>';
        }

        $data_bobot_air = $this->M_tambahan->getData_sg_bobot_air($tglanalisa,$dtsg_kode_alat);
        foreach ($data_bobot_air as $row2) {
            $data2 = $row2['picno_hasil'];
        }

        $data = $data1.",".$data2;
        echo $data;
    }

    function get_data_sg_kode_alat2_b(){
        $dttgl_analisa = $this->input->post('dttgl_analisa');
        $tglanalisa = substr($dttgl_analisa,6,4).'-'.substr($dttgl_analisa,3,2).'-'.substr($dttgl_analisa,0,2);

        $data_kodealat2 = $this->M_tambahan->getData_sg_kode_alat2_b($tglanalisa);
        $data1 .= '<option value="">- pilih -</option>';
        foreach($data_kodealat2 as $row){
            $data1 .= '<option value="'.$row['sg_kode_alat2'].'">'.$row['sg_kode_alat2'].'</option>';
        }

        echo $data1;
    }

    function get_data_sg_faktor_koreksi(){
        $dtsg_kode_alat2 = $this->input->post('dtsg_kode_alat2');

        $data_koreksi = $this->M_tambahan->getData_sg_faktor_koreksi($dtsg_kode_alat2);
        foreach ($data_koreksi as $row) {
            $data2 = $row['correction'];
        }

        $data = $data2;
        echo $data;
    }

    function get_data_mc_faktor_koreksi(){
        $dtmc_kode_ab = $this->input->post('dtmc_kode_ab');

        $data_koreksi = $this->M_tambahan->getData_mc_faktor_koreksi($dtmc_kode_ab);
        foreach ($data_koreksi as $row) {
            $data2 = $row['correction'];
        }

        $data = $data2;
        echo $data;
    }

    function get_kategori_alat_001(){  //kalibrasi
        $bagian_abbr = $this->input->post('bagian_abbr');
        $in_ex       = $this->input->post('in_ex');
        $data        = $this->M_tambahan->get_kategori_alat_001($bagian_abbr,$in_ex);
        echo json_encode($data);
    }

    function get_kategori_alat_002(){  //kalibrasi
        $bagian_abbr = $this->input->post('bagian_abbr');
        $data        = $this->M_tambahan->get_kategori_alat_002($bagian_abbr);
        echo json_encode($data);
    }

    function get_kategori_alat(){  //kalibrasi
        $bagian_abbr = $this->input->post('bagian_abbr');
        $tahun       = $this->input->post('tahun');
        $data        = $this->M_tambahan->get_kategori_alat($bagian_abbr,$tahun);
        echo json_encode($data);
    }

    function get_kategori_alat_cal_005(){  //kalibrasi
        $bagian_abbr = $this->input->post('bagian_abbr');
        $tahun       = $this->input->post('tahun');
        $bulan       = $this->input->post('bulan');
        $data        = $this->M_tambahan->get_kategori_alat_cal_005($bagian_abbr,$tahun,$bulan);
        echo json_encode($data);
    }

    function get_kategori_alat_006(){  //kalibrasi
        $bagian_abbr = $this->input->post('bagian_abbr');
        $tahun       = $this->input->post('tahun');
        $data        = $this->M_tambahan->get_kategori_alat_006($bagian_abbr,$tahun);
        echo json_encode($data);
    }

    function get_kategori_alat_007(){  //kalibrasi
        $bagian_abbr = $this->input->post('bagian_abbr');
        // $tahun       = $this->input->post('tahun');
        $status      = $this->input->post('status');
        $data        = $this->M_tambahan->get_kategori_alat_007($bagian_abbr,$status);
        echo json_encode($data);
    }

    function get_data_no_alat(){  //kalibrasi
        $bagian_abbr   = $this->input->post('bagian_abbr');
        $tahun         = $this->input->post('tahun');
        $kategori_alat = $this->input->post('kategori_alat');
        $data          = $this->M_tambahan->getData_no_alat($bagian_abbr,$tahun,$kategori_alat);
        echo json_encode($data);
    }

    function get_data_no_alat_005(){  //kalibrasi
        $bagian_abbr   = $this->input->post('bagian_abbr');
        $tahun         = $this->input->post('tahun');
        $bulan         = $this->input->post('bulan');
        $kategori_alat = $this->input->post('kategori_alat');
        $data          = $this->M_tambahan->getData_no_alat_005($bagian_abbr,$tahun,$bulan,$kategori_alat);
        echo json_encode($data);
    }

    function get_data_no_alat_006(){  //kalibrasi
        $bagian_abbr   = $this->input->post('bagian_abbr');
        $tahun         = $this->input->post('tahun');
        $kategori_alat = $this->input->post('kategori_alat');
        $data          = $this->M_tambahan->getData_no_alat_006($bagian_abbr,$tahun,$kategori_alat);
        echo json_encode($data);
    }

    function get_data_no_alat_007(){  //kalibrasi
        $bagian_abbr   = $this->input->post('bagian_abbr');
        $kategori_alat = $this->input->post('kategori_alat');
        $status        = $this->input->post('status');
        $data          = $this->M_tambahan->getData_no_alat_007($bagian_abbr,$kategori_alat,$status);
        echo json_encode($data);
    }

    function get_data_no_alat_007_date(){  //kalibrasi
        $bagian_abbr   = $this->input->post('bagian_abbr');
        $kategori_alat = $this->input->post('kategori_alat');
        $status        = $this->input->post('status');
        $tgl_awal      = $this->input->post('tgl_awal');
        $tgl_akhir     = $this->input->post('tgl_akhir');
        $data          = $this->M_tambahan->getData_no_alat_007_date($bagian_abbr,$kategori_alat,$status,$tgl_awal,$tgl_akhir);
        echo json_encode($data);
    }

   function get_spek_forminput(){
        if ($this->session->userdata('logged_in')){
            $session_data           = $this->session->userdata('logged_in');
            $data['userid']         = $session_data['userid'];
            $data['username']       = $session_data['username'];
            $data['password']       = $session_data['password'];
            $data['jabid']          = $session_data['jabid'];
            $data['leveluserid']    = $session_data['leveluserid'];
            $data['nmdepan']        = $session_data['nmdepan'];
            $data['nmlengkap']      = $session_data['nmlengkap'];
            $data['levelusernm']    = $session_data['levelusernm'];
            $data['bagnm']          = $session_data['bagnm'];
            $data['bagian_akses']   = $session_data['bagian_akses'];
            $data['jabnm']          = $session_data['jabnm'];
            $data['personalid']     = $session_data['personalid'];
            $data['personalstatus'] = $session_data['personalstatus'];
            $data['Titel']          = '';

            $LevelUser              = $session_data['leveluserid'];
            $UserName               = $session_data['username'];
            $LevelUserNm            = $session_data['levelusernm'];
            
            $cekLevelUserNm         = substr($LevelUserNm, 0, 7);
            $data['cekLevelUserNm'] = substr($LevelUserNm, 0, 7);
            
            $menus                  = $this->M_menu->menus($LevelUser);
            $data2                  = array('menus' => $menus);

            $up_create_date         = date("Y-m-d",strtotime(addslashes($this->input->post('up_create_date'))));
            $nilaiN                 = trim($this->input->post('nilaiN'));
            $parameter              = trim($this->input->post('parameter'));
            $tipe_contoh            = trim($this->input->post('tipe_contoh'));
            $jenis_produk           = trim($this->input->post('jenis_produk'));
            $form_kode              = trim($this->input->post('form_kode'));
            $form_versi             = trim($this->input->post('form_versi'));

            $dtspek_frommst         = $this->M_forminput->get_spek_forminput($up_create_date,$parameter,$tipe_contoh,$jenis_produk,$form_kode,$form_versi);
            // mode_audit      
            // mode_ori      
            foreach($dtspek_frommst as $cek_dtspek_frommst){
                if(is_numeric($cek_dtspek_frommst->spec_max) && is_numeric($nilaiN) && $nilaiN > $cek_dtspek_frommst->spec_max){
                  $nilaiN2 = $cek_dtspek_frommst->spec_max;
                  $data0   = '1';
                  $data1   = $cek_dtspek_frommst->spec_max;
                  $data2   = $cek_dtspek_frommst->spec_min;
                  break;
                }elseif(is_numeric($cek_dtspek_frommst->spec_min) && is_numeric($nilaiN) && $nilaiN < $cek_dtspek_frommst->spec_min){
                  $nilaiN2 = $cek_dtspek_frommst->spec_min;
                  $data0   = '1';
                  $data1   = $cek_dtspek_frommst->spec_max;
                  $data2   = $cek_dtspek_frommst->spec_min;
                  break;
                }else{
                  $nilaiN2 = $nilaiN;
                  $data0   = '0';
                  $data1   = $cek_dtspek_frommst->spec_max;
                  $data2   = $cek_dtspek_frommst->spec_min;
                }
            }

            echo $data0."//".$data1."//".$data2."//".$nilaiN2;
        }else{ // setelah session user berakhir atau logout
            redirect('C_login', 'refresh');
        }
    }

    ////////////////////////////// function untuk Laporan Master Coding Marking ///////////////////////

    function get_dataBuyer(){
        $jns_produk = $this->input->post('jns_produk');

        $dt_buyer = $this->M_tambahan->get_buyer($jns_produk);

        // print_r($dt_buyer);
        $dataBuyer = "<option value=''>--pilih--</option>";
        $dataBuyer_ = array();
        foreach($dt_buyer as $row2){
            if ( in_array($row2->buyer, $dataBuyer_) ) {
                continue;
            }
            $dataBuyer_[] = $row2->buyer;
            $dataBuyer .= '<option value="'.$row2->buyer.'">' .$row2->buyer. '</option>';
        }
        
        echo($dataBuyer);
    }

    function get_dataBrand(){
        $jns_produk = $this->input->post('jns_produk');
        $buyer = $this->input->post('buyer');

        $dt_brand = $this->M_tambahan->get_brand($jns_produk,$buyer);

        // print_r($dt_brand);
        
        $dataBrand_ = array();
        $dataBrand = "<option value=''>--pilih--</option>";
        foreach($dt_brand as $row2){
            if ( in_array($row2->brand, $dataBrand_) ) {
                continue;
            }
            $dataBrand_[] = $row2->brand;
               $dataBrand .= '<option value="'.$row2->brand.'">' .$row2->brand. '</option>';
        }

        echo($dataBrand);
    }

    function get_dataProduct(){
        $jns_produk = $this->input->post('jns_produk');
        $buyer = $this->input->post('buyer');
        $brand = $this->input->post('brand');

        $dt_product = $this->M_tambahan->get_product($jns_produk,$buyer,$brand);

        // print_r($dt_product);
        
        $dataProductId_ = array();
        $dataProductId = "<option value=''>-pilih-</option>";
        foreach($dt_product as $row2){
            if ( in_array($row2->product_id, $dataProductId_) ) {
                continue;
            }
            $dataProductId_[] = $row2->product_id;
            $dataProductId .= '<option value="'.$row2->product_id.'">' .$row2->product_id. '</option>';
        }

        $dataProductId2_ = array();
        $dataProductId2 = "<option value=''>-pilih-</option>";
        foreach($dt_product as $row2){
            if ( in_array($row2->product_id2, $dataProductId2_) ) {
                continue;
            }
            $dataProductId2_[] = $row2->product_id2;
            $dataProductId2 .= '<option value="'.$row2->product_id2.'">' .$row2->product_id2. '</option>';
        }

        $datas = $dataProductId."//".$dataProductId2."//";
        echo($datas);

        // echo($dataBrand);
    }

    function get_dataConsignee(){
        $jns_produk = $this->input->post('jns_produk');
        $buyer = $this->input->post('buyer');
        $brand = $this->input->post('brand');
        $product_id = $this->input->post('product_id');

        $dt_consignee = $this->M_tambahan->get_consignee($jns_produk,$buyer,$brand,$product_id);

        // print_r($dt_consignee);
        
        $dataConsignee_ = array();
        $dataConsignee = "<option value=''>--pilih--</option>";
        foreach($dt_consignee as $row2){
            if ( in_array($row2->consignee, $dataConsignee_) ) {
                continue;
            }
            $dataConsignee_[] = $row2->consignee;
               $dataConsignee .= '<option value="'.$row2->consignee.'">' .$row2->consignee. '</option>';
        }

        echo($dataConsignee);
    }

    function get_dataConsigneeNK(){
        $jns_produk = $this->input->post('jns_produk');
        $buyer = $this->input->post('buyer');
        $brand = $this->input->post('brand');
        $product_id2 = $this->input->post('product_id2');

        $dt_consignee = $this->M_tambahan->get_consigneeNK($jns_produk,$buyer,$brand,$product_id2);

        // print_r($dt_consignee);
        
        $dataConsignee_ = array();
        $dataConsignee = "<option value=''>--pilih--</option>";
        foreach($dt_consignee as $row2){
            if ( in_array($row2->consignee, $dataConsignee_) ) {
                continue;
            }
            $dataConsignee_[] = $row2->consignee;
               $dataConsignee .= '<option value="'.$row2->consignee.'">' .$row2->consignee. '</option>';
        }

        echo($dataConsignee);
    }

    function get_kode_sampling_point_intqad020(){
        $dt_area = $this->input->post('area');
        $sql_area = $this->M_tambahan->get_kode_sample_frmqad039($dt_area);
        $data = $dt_area;
        if(count($sql_area)>0){
            foreach($sql_area as $row2){
                   $data .= '<option value="'.$row2->kode_sample.'">'.$row2->kode_sample.'</option>';
            }
        }
        echo $data;
    }

    //////////////////////////////////// END laporan master Coding Marking ////////////////////////////

    /////////////////// Ini Punya Qad 051 ////////////////////

    function get_productID_frmqad051(){
        $jns_produk = $this->input->post('jns_produk');

        $dt_productCategory = $this->M_tambahan->get_productCategory($jns_produk);

        foreach($dt_productCategory as $dt_pc){
            $ProductCategoryName = $dt_pc->product_category;
            $ProductCategoryID = $dt_pc->id_product_category;
        }

        $getdataPID = array(
          'id_product_category'        => $ProductCategoryID
        );

        $dt_productID = $this->M_tambahan->get_productid051($getdataPID);

        // $data = "<option value=''>--pilih--</option>";
        //   foreach($dt_productID as $row2){
        //        $data .= '<option value="'.$row2->product_code.'">' .$row2->product_code. '</option>';
        //   }
        
        $jml_dt2 = count($dt_productID);
        if($jml_dt2>0){
            $data = "<option value=''>--Pilih product ID--</option>";
            foreach($dt_productID as $row_PID){
                $data .= '<option value="'.$row_PID->product_code.'">' .$row_PID->product_code. '</option>';
            }
        }else{
            $data = "<option value=''>-Pilih Product ID-</option>";
        }
       echo $data;
    }

    /////////////////// END FRM QAD 051 /////////////////////////////
}
?>