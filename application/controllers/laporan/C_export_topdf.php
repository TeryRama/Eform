<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_export_topdf extends CI_Controller {

    function __construct() {
        parent::__construct();
        $frmkode = $this->uri->segment(4);
        $frmvrs = $this->uri->segment(5);
        $this->load->model(array('M_user', 'master/M_form','M_menu', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->library(array('table','form_validation','excel','pdf'));
        $this->load->helper('form');

        //////////////////////////////////
        /// prevent direct url accses
        $session_data = $this->session->userdata('logged_in');
        $leveluid     = $session_data['leveluserid'];
        $url_str      = uri_string();

        $akses_check = $this->M_user->check_akses_bylevelid($leveluid,$frmkode);
        if($akses_check==false){
            echo "<script>alert('Anda Tidak Memiliki Akses Untuk Data Ini..!!');
                          window.location.assign('";echo base_url();echo "C_login');
                       </script>"; 
        }
        /// end prevent direct url accses
        //////////////////////////////////
    }   
    function exporttopdf() {

        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $data['password'] = $session_data['password'];
        $data['jabid'] = $session_data['jabid'];
        $data['leveluserid'] = $session_data['leveluserid'];
        $data['nmdepan'] = $session_data['nmdepan'];
        $data['levelusernm'] = $session_data['levelusernm'];
        $data['bagnm'] = $session_data['bagnm'];
        $data['jabnm'] = $session_data['jabnm'];
        $data['Titel'] = 'Home';
        
        $LevelUser = $session_data['leveluserid'];
        $UserName = $session_data['username'];
        $LevelUserNm = $session_data['levelusernm'];

        $cekLevelUserNm = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);

        $menus = $this->M_menu->menus($LevelUser);
        $data2 = array('menus' => $menus);

        $frmkode = $this->uri->segment(4);
        $frmvrs = $this->uri->segment(5);

        $dtfrm = $this->M_forminput->get_dtform($frmkode, $frmvrs);
        $data3 = array('dtfrm' => $dtfrm);

        foreach ($dtfrm as $datafrm) {
            $frmkd = $datafrm->formkd;
            $frmjdl= $datafrm->formjudul;
        }

        $filekd = $this->uri->segment(6);
        $id = $this->uri->segment(7);

        $model = 'M_form'.$frmkd.'_'.$frmvrs;

        $pdf = new FPDF();
      
      switch($frmkode){
      // case $frmkode=="frmfss190":
      //   if($filekd=="export"){

      //       $data['dtheader']=$this->$model->get_header_byid($id);
      //       if ($cekLevelUserNm      == "Auditor") {
      //           $data['dtdetail'] = $this->$model->get_detail_byidx($id);
      //       }else{
      //           $data['dtdetail'] = $this->$model->get_detail_byid($id);
      //       }
      //       $dtfrm = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
      //       $data3 = array('dtfrm' => $dtfrm);
      //       $this->load->view('laporan/Ccp/V_pdf'.$frmkode.'_'.$frmvrs,array_merge($data,$data3));   
      //   }else{}

      case $frmkode=="frmfcc001":
        if($filekd=="export"){

            $data['dtheader']=$this->$model->get_header_byid($id);
            if ($cekLevelUserNm      == "Auditor") {
                $data['dtdetail'] = $this->$model->get_detail_byidx($id);
            }else{
                $data['dtdetail'] = $this->$model->get_detail_byid($id);
            }
            $dtfrm = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
            $data3 = array('dtfrm' => $dtfrm);
            $this->load->view('laporan/Ccp/V_pdf'.$frmkode.'_'.$frmvrs,array_merge($data,$data3));   
        }else{}
      break; 
	  case $frmkode=="frmfcu001":
        if($filekd=="export"){

            $data['dtheader']=$this->$model->get_header_byid($id);
            if ($cekLevelUserNm      == "Auditor") {
                $data['dtdetail'] = $this->$model->get_detail_byidx($id);
            }else{
                $data['dtdetail'] = $this->$model->get_detail_byid($id);
            }
            $dtfrm = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
            $data3 = array('dtfrm' => $dtfrm);
            $this->load->view('laporan/Ccp/V_pdf'.$frmkode.'_'.$frmvrs,array_merge($data,$data3));   
        }else{}
      break; 
      case $frmkode=="frmfpj001":
        if($filekd=="export"){

            $data['dtheader']=$this->$model->get_header_byid($id);
            if ($cekLevelUserNm      == "Auditor") {
                $data['dtdetail'] = $this->$model->get_detail_byidx($id);
            }else{
                $data['dtdetail'] = $this->$model->get_detail_byid($id);
            }
            $dtfrm = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
            $data3 = array('dtfrm' => $dtfrm);
            $this->load->view('laporan/Ccp/V_pdf'.$frmkode.'_'.$frmvrs,array_merge($data,$data3));   
        }else{}
      break; 
      case $frmkode=="frmfuc001":
        if($filekd=="export"){

            $data['dtheader']=$this->$model->get_header_byid($id);
            if ($cekLevelUserNm      == "Auditor") {
                $data['dtdetail'] = $this->$model->get_detail_byidx($id);
            }else{
                $data['dtdetail'] = $this->$model->get_detail_byid($id);
            }
            $dtfrm = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
            $data3 = array('dtfrm' => $dtfrm);
            $this->load->view('laporan/Ccp/V_pdf'.$frmkode.'_'.$frmvrs,array_merge($data,$data3));   
        }else{}
      break; 
      case $frmkode=="frmfac001":
        if($filekd=="export"){

            $data['dtheader']=$this->$model->get_header_byid($id);
            if ($cekLevelUserNm      == "Auditor") {
                $data['dtdetail'] = $this->$model->get_detail_byidx($id);
            }else{
                $data['dtdetail'] = $this->$model->get_detail_byid($id);
            }
            $dtfrm = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
            $data3 = array('dtfrm' => $dtfrm);
            $this->load->view('laporan/Ccp/V_pdf'.$frmkode.'_'.$frmvrs,array_merge($data,$data3));   
        }else{}
      break; 
      case $frmkode=="frmfdc001":
        if($filekd=="export"){

            $data['dtheader']=$this->$model->get_header_byid($id);
            if ($cekLevelUserNm      == "Auditor") {
                $data['dtdetail'] = $this->$model->get_detail_byidx($id);
            }else{
                $data['dtdetail'] = $this->$model->get_detail_byid($id);
            }
            $dtfrm = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
            $data3 = array('dtfrm' => $dtfrm);
            $this->load->view('laporan/Ccp/V_pdf'.$frmkode.'_'.$frmvrs,array_merge($data,$data3));   
        }else{}
      break;
      case $frmkode=="frmfdc002":
        if($filekd=="export"){

            $data['dtheader']=$this->$model->get_header_byid($id);
            if ($cekLevelUserNm      == "Auditor") {
                $data['dtdetail'] = $this->$model->get_detail_byidx($id);
            }else{
                $data['dtdetail'] = $this->$model->get_detail_byid($id);
            }
            $dtfrm = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
            $data3 = array('dtfrm' => $dtfrm);
            $this->load->view('laporan/Ccp/V_pdf'.$frmkode.'_'.$frmvrs,array_merge($data,$data3));   
        }else{}
      break;
      case $frmkode=="frmfdc003":
        if($filekd=="export"){
            $dtheader = $this->$model->get_header_byid($id);
            $data7 = array('dtheader' => $dtheader);
            foreach($dtheader as $row2_dtheader){
                // $data['headerid'] = $row2_dtheader->headerid;
                $tanggal_produksi = $row2_dtheader->tanggal_produksi;
                $jnsformtkk = $row2_dtheader->jnsformtkk;
            }
            if($cekLevelUserNm=="Auditor") {
                $dtdetail = $this->$model->get_detail_bydate_line1x($tanggal_produksi,'1',$jnsformtkk);
                $dtdetail2 = $this->$model->get_detail_bydate_line1x($tanggal_produksi,'3',$jnsformtkk);
            } else {
                $dtdetail = $this->$model->get_detail_bydate_line1($tanggal_produksi,'1',$jnsformtkk);
                $dtdetail2 = $this->$model->get_detail_bydate_line1($tanggal_produksi,'3',$jnsformtkk);
            }
            $data8 = array('dtdetail' => $dtdetail);
            $data9 = array('dtdetail2' => $dtdetail2);
            $dtfrm = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
            $data3 = array('dtfrm' => $dtfrm);
            $this->load->view('laporan/Ccp/V_pdf'.$frmkode.'_'.$frmvrs,array_merge($data3,$data7,$data8,$data9));   
        }else{}
      break;
      case $frmkode=="intqad018":
        if($filekd=="export"){
            $jenis_print = $this->uri->segment(8);
            $dtheader = $this->$model->get_header_byid($id);
            $data7 = array('dtheader' => $dtheader);
            foreach($dtheader as $dtheader_row){
                $data['headerid'] = $dtheader_row->headerid;
                $dtcreate_date    = $dtheader_row->create_date;
                $dtdeliv_date     = $dtheader_row->deliv_date;
                $dtjenis_produk   = $dtheader_row->jenis_produk;
                $dtno_po          = $dtheader_row->no_po;
            }
            if ($cekLevelUserNm      == "Auditor") {
              switch ($dtjenis_produk) {
                case 'Expeller Cake':
                  $dtdetail = $this->$model->get_dtsampelqad026x($dtcreate_date,$dtno_po);
                  $dt_no_po        = $this->$model->get_nopo_026();
                  $data['dt_tbl']  = 'exc';
                  break;
                case 'Crude Coconut Oil':
                  $dtdetail = $this->$model->get_dtsampelqad027x($dtcreate_date,$dtno_po);
                  $dt_no_po        = $this->$model->get_nopo_027();
                  $data['dt_tbl']  = 'cco';
                  break;
                default:
                  break;
              }
            } else {
              switch ($dtjenis_produk) {
                case 'Expeller Cake':
                  $dtdetail = $this->$model->get_dtsampelqad026($dtcreate_date,$dtno_po);
                  $dt_no_po        = $this->$model->get_nopo_026();
                  $data['dt_tbl']  = 'exc';
                  break;
                case 'Crude Coconut Oil':
                  $dtdetail = $this->$model->get_dtsampelqad027($dtcreate_date,$dtno_po);
                  $dt_no_po        = $this->$model->get_nopo_027();
                  $data['dt_tbl']  = 'cco';
                  break;
                default:
                  break;
              }
            }
            
            $data8           = array('dtdetail' => $dtdetail);
            $print           = array('print' => $jenis_print);
            
            $dt_jenis_produk = $this->$model->get_jenis_produk();
            $dataJP          = array('dt_jenis_produk' => $dt_jenis_produk);
            
            $dt_nokapal      = $this->$model->get_nokapal($dtno_po);
            $dataNK          = array('dt_nokapal' => $dt_nokapal);
            
            $dataPO          = array('dt_no_po' => $dt_no_po);
            $dtfrm           = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
            $data3           = array('dtfrm' => $dtfrm);
            
            $no_coa          = $this->$model->get_nocoa($dtdeliv_date,$dtjenis_produk,$dtno_po);
            $dataLNOCOA      = array('no_coa' => $no_coa);

            $this->load->view('laporan/Ccp/V_pdf'.$frmkode.'_'.$frmvrs,array_merge($data7,$data8,$data3,$dataNK,$dataJP,$dataPO,$dataLNOCOA,$print));   
        }else{}
      break; 
      case $frmkode=="frmnip001":
        if($filekd=="export"){
            $data['jenis_print'] = $this->uri->segment(8);
            $dtheader = $this->$model->get_header_byid($id);
            $data7 = array('dtheader' => $dtheader);
            foreach($dtheader as $dtheader_row){
                $dtformat_nip          = str_replace('/', '', $dtheader_row->format_nip);
            }

            if ($cekLevelUserNm      == "Auditor") {
                $data['dtdetail'] = $this->$model->get_detail_byidx($id);
            }else{
                $data['dtdetail'] = $this->$model->get_detail_byid($id);
            }
            $dtfrm = $this->M_forminput->get_dtform_by_level($frmkode,$frmvrs,$LevelUser);
            $data3 = array('dtfrm' => $dtfrm);
            $this->load->view('laporan/nip/V_pdf'.$frmkode.'_'.$dtformat_nip.'_'.$frmvrs,array_merge($data7,$data3,$data));  
        }else{}
      break; 
	  case $frmkode=="frmnon001": 	  
        if($filekd=="export") {
		
		$pdf->AddPage('L','A3');
		$logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";	    
		$a=$pdf->Image($logor,10,10,30,25);
		$dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
		 //$pdf->SetFillColor(230,230,230,230); 
		 $pdf->SetFillColor(110,180,230);
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30, 25, $a,1,0,'C',0);
		$dtheader1=$this->$model->get_header_byid($id);
		$pdf->cell(285, 25, $title, 1,0,'C',0);
		$pdf->SetFont('Arial','',10);

		foreach($dtheader1 as $dthdr1){
		$no_doc=$dthdr1->no_doc;
        $tgl_inproses = $dthdr1->tgl_inproses;
		$pdf->cell(55, 25, 'No.DOC :'.$no_doc.'',1,0,'L',0);
		}			
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30,6,'JUDUL',1,0,'C',0);
		$pdf->cell(285,6, $frmjdl, 1,0,'C',0);
		$pdf->cell(55,6, 'TGL:'.$tgl_inproses.'',1,0,'C',0);
		$pdf->Ln();
        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
        $pdf->cell(10,6,'No.',1,0,'C',0);    
        $pdf->cell(25,6,'kode Sample',1,0,'C',0);  
        $pdf->cell(25,6,'Jam Sampling',1,0,'C',0);   		
        $pdf->cell(140,6,'Analisis Parameters',1,0,'C',0); 
		
        $pdf->cell(15,6,'FCI',1,0,'C',0);
        $pdf->cell(15,6,'TDS',1,0,'C',0);
        $pdf->cell(15,6,'Colour',1,0,'C',0);
        $pdf->cell(25,6,'Turbidity',1,0,'C',0);
        $pdf->cell(25,6,'Residual Ozon',1,0,'C',0);
        $pdf->cell(25,6,'Odour falavour',1,0,'C',0);
        $pdf->cell(25,6,'Dianalisa',1,0,'C',0);
		$pdf->cell(25,6,'Remarks',1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(10,6,'',1,0,'C',0);    
        $pdf->cell(25,6,'',1,0,'C',0);  
        $pdf->cell(25,6,'',1,0,'C',0);  
		$pdf->cell(15,6,'pH',1,0,'C',0);
		$pdf->cell(70,6,'Chloride',1,0,'C',0);
		$pdf->cell(55,6,'TH',1,0,'C',0);		
		$pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
		$pdf->cell(25,6,'',1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(10,6,'',1,0,'C',0);    
        $pdf->cell(25,6,'',1,0,'C',0);  
        $pdf->cell(25,6,'',1,0,'C',0); 
		$pdf->cell(15,6,'',1,0,'C',0);		
		$pdf->cell(45,6,'Titran AgNo.3',1,0,'C',0);
		$pdf->cell(25,6,'HasilChloride',1,0,'C',0);
		$pdf->cell(30,6,'Titran EDTA',1,0,'C',0);
		$pdf->cell(25,6,'Hasil th (ppm)',1,0,'C',0);
		
		$pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,' ',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,' ',1,0,'C',0);
		$pdf->cell(25,6,'',1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(10,6,'',1,0,'C',0);    
        $pdf->cell(25,6,'',1,0,'C',0);  
        $pdf->cell(25,6,'',1,0,'C',0);  
		$pdf->cell(15,6,'',1,0,'C',0);
		$pdf->cell(15,6,'mL(s)',1,0,'C',0);
        $pdf->cell(15,6,'mL(b)',1,0,'C',0);
        $pdf->cell(15,6,'N',1,0,'C',0);
		$pdf->cell(25,6,'(ppm)',1,0,'C',0);	
		$pdf->cell(15,6,'mL.3',1,0,'C',0);
		$pdf->cell(15,6,'M',1,0,'C',0);
		$pdf->cell(25,6,'TH(ppm)',1,0,'C',0);		
		$pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,' ',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,' ',1,0,'C',0);
		$pdf->cell(25,6,'',1,0,'C',0);
		$pdf->Ln();		
        $no=1;
        foreach ($datadtl as $row1){         
        $pdf->SetFont('Arial','',10);
        $pdf->cell(10,6,$no, 1,'L');
       // $pdf->cell(5,6,$row1->detail_id, 1,'L');
	    $pdf->cell(25,6,$row1->kode_sample, 1,'L');
		$pdf->cell(25,6,$row1->jam_sampling, 1,'L');       
        $pdf->cell(15,6,$row1->ap_ph, 1,'L');
        $pdf->cell(15,6,$row1->cl_mls, 1,'L');
        $pdf->cell(15,6,$row1->cl_mlb, 1,'L');
        $pdf->cell(15,6,$row1->cl_n, 1,'L');
        $pdf->cell(25,6,$row1->cl_hppm, 1,'L');
        $pdf->cell(15,6,$row1->th_ml, 1,'L');
        $pdf->cell(15,6,$row1->th_m, 1,'L');
		$pdf->cell(25,6,$row1->th_hppm, 1,'L');
        $pdf->cell(15,6,$row1->fci, 1,'L');
        $pdf->cell(15,6,$row1->tds, 1,'L');
        $pdf->cell(15,6,$row1->color, 1,'L');
        $pdf->cell(25,6,$row1->turbidity, 1,'L');
		$pdf->cell(25,6,$row1->residual_ozon, 1,'L');
        $pdf->cell(25,6,$row1->odour_flavour, 1,'L');
        $pdf->cell(25,6,$row1->analisis_oleh, 1,'L');
        $pdf->cell(25,6,$row1->remarks, 1,'L');
        $pdf->Ln();
        $no++;   
        }
	  foreach($dtfrm as $dt_form){
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
		}
		$pdf->SetFont('Arial','',8);
		$pdf->cell(320,6, $frmefec,1,0,'L',0);
        $pdf->cell(50,6, $frmnm, 1,0,'R',0); 
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),290,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
		$pdf->Output($frmkode.'.pdf','I');
      
        }else{}
      
       break; 

       case $frmkode=="frmlqs002":
       if($filekd=="export") {

        $pdf->AddPage('L','A3');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
         //$pdf->SetFillColor(230,230,230,230); 
        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30, 25, $a,1,0,'C',0);
        $dtheader1=$this->$model->get_header_byid($id); 
        $pdf->cell(330, 25, $title, 1,0,'C',0);
        $pdf->SetFont('Arial','',10);
        foreach($dtheader1 as $dthdr1){
        $dttahun=substr($dthdr1->tgl_dokumen,0,4);
        $pdf->cell(40, 25, 'Tahun :'.$dttahun.'',1,0,'L',0);
        }
        $pdf->Ln();
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
        $pdf->cell(330,6, $frmjdl, 1,0,'C',0);
        foreach($dtheader1 as $dthdr1){
        $dtbulan=substr($dthdr1->tgl_dokumen,5,2);
        $pdf->cell(40, 6, 'Bulan:'.$dtbulan.'', 1,0,'L',0);
        }
        $pdf->Ln();
        foreach($dtheader1 as $dthdr1){
        $lab_penguji=$dthdr1->lab_penguji;
		$tipe_contoh=$dthdr1->tipe_contoh;
		$jns_produk=$dthdr1->jns_produk;
		$jp_keterangan=$dthdr1->jp_keterangan;
        $pdf->cell(400,6, 'Laboratorium Penguji:'.$lab_penguji.'',1,0,'L',0);
		$pdf->Ln();
		$pdf->cell(400,6, 'Tipe contoh:'.$tipe_contoh.'',1,0,'L',0);
		$pdf->Ln();
		$pdf->cell(400,6, 'Jenis Produk:'.$jns_produk.'',1,0,'L',0);
		$pdf->Ln();
		$pdf->cell(400,6, 'Keterangan Produk:'.$jp_keterangan.'',1,0,'L',0);
        }
        
        $pdf->Ln();
    

        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
       
      
        $pdf->cell(10,6,'No.',1,0,'C',0);           
        $pdf->cell(30,6,'Tanggal Antar ',1,0,'C',0);    
		$pdf->cell(30,6,'Tanggal Produksi ',1,0,'C',0);  
        $pdf->cell(30,6,'Jam Sampling',1,0,'C',0);
        $pdf->cell(30, 6, 'Kode/Deskripsi',1,0,'C',0);
        $pdf->cell(30, 6, 'Jumlah Contoh',1,0,'C',0);
        
        $pdf->SetFont('Arial','',8);
        $pdf->cell(90,6,'Laboratorium Kimia',0,0,'C',0);  
        
        $pdf->cell(30,6,'Keterangan ',1,0,'C',0);       
        $pdf->cell(90,6,'Laboratorium Mikro',0,0,'C',0);
        $pdf->cell(30, 6,'Keterangan',1,0,'C',0);
		$pdf->Ln();
		
		$pdf->cell(10,6,'',1,0,'C',0);           
        $pdf->cell(30,6,'',1,0,'C',0);    
		$pdf->cell(30,6,' ',1,0,'C',0);  
        $pdf->cell(30,6,'',1,0,'C',0);
        $pdf->cell(30, 6, '',1,0,'C',0);
		$pdf->cell(30, 6, '',1,0,'C',0);
 
		
		$pdf->cell(30,6,'Diantar',1,0,'C',0);
		$pdf->cell(60,6,'Diterima',1,0,'C',0);
		$pdf->cell(30,6,'',1,0,'C',0);  
		
		$pdf->cell(30,6,'Diantar',1,0,'C',0);
		$pdf->cell(60,6,'Diterima',1,0,'C',0);
		$pdf->cell(30,6,'',1,0,'C',0);  
		$pdf->Ln();
		
		$pdf->cell(10,6,'',1,0,'C',0);           
        $pdf->cell(30,6,' ',1,0,'C',0);    
		$pdf->cell(30,6,' ',1,0,'C',0);  
        $pdf->cell(30,6,'',1,0,'C',0);
        $pdf->cell(30, 6, '',1,0,'C',0);
		$pdf->cell(30, 6, '',1,0,'C',0);
		
		
		$pdf->cell(15,6,'Jam',1,0,'C',0);           
        $pdf->cell(15,6,'Oleh ',1,0,'C',0);    
		$pdf->cell(15,6,'Jam ',1,0,'C',0);  
        $pdf->cell(15,6,'Oleh',1,0,'C',0);
        $pdf->cell(30, 6, 'Kondisi Sampel',1,0,'C',0);
		$pdf->cell(30, 6,'',1,0,'C',0);
		

		$pdf->cell(15,6,'Jam',1,0,'C',0);           
        $pdf->cell(15,6,'Oleh ',1,0,'C',0);    
		$pdf->cell(15,6,'Jam ',1,0,'C',0);  
        $pdf->cell(15,6,'Oleh',1,0,'C',0);
        $pdf->cell(30, 6,'Kondisi Sampel',1,0,'C',0);
		$pdf->cell(30, 6,'',1,0,'C',0);
		$pdf->Ln();	
        $no=1;
      
        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');    
        $pdf->cell(30,6,$row1->tgl_antar, 1,'L');
        $pdf->cell(30,6,$row1->tgl_produksi, 1,'L');
        $pdf->cell(30,6,$row1->jam_sampling, 1,'L');
        $pdf->cell(30,6,$row1->deskripsi, 1,'L');
        $pdf->cell(30,6,$row1->jml_contoh, 1,'L');
		
        $pdf->cell(15,6,$row1->jam_antar, 1,'L');
        $pdf->cell(15,6,$row1->pengantar, 1,'L');
        $pdf->cell(15,6,$row1->jam_terima, 1,'L');
		$pdf->cell(15,6,$row1->pengantar2, 1,'L'); 
        $pdf->cell(30,6,$row1->kondisi_sampel, 1,'L');
        
        $pdf->cell(30,6,$row1->ket, 1,'L');
        $pdf->cell(15,6,$row1->jam_antar2, 1,'L');
        $pdf->cell(15,6,$row1->pengantar2, 1,'L');    
        $pdf->cell(15,6,$row1->jam_terima2, 1,'L');
        $pdf->cell(15,6,$row1->penerima2, 1,'L');
        $pdf->cell(30,6,$row1->kondisi_sampel2, 1,'L');
		$pdf->cell(30,6,$row1->ket2, 1,'L');
        $pdf->Ln();
        $no++;   
        }
      foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
        $pdf->SetFont('Arial','',8);
        $pdf->cell(360,6,'Mulai Berlaku:'.$frmefec.'',1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');
        }else{}
        break;

	   case $frmkode=="frmnon010":
	   if($filekd=="export"){
		   
		$pdf->AddPage('L','A3');
		$logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";	    
		$a=$pdf->Image($logor,10,10,30,25);
		$dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
		 //$pdf->SetFillColor(230,230,230,230); 
		$pdf->SetFillColor(230,230,230,230);
		$pdf->SetFont('Arial','B',10);
		$pdf->cell(30, 25, $a,1,0,'C',0);
		 
		$pdf->cell(325, 25, $title, 1,0,'C',0);
		$pdf->SetFont('Arial','',10);	
		$dtheader1=$this->$model->get_header_byid($id);
		foreach ($dtheader1 as $dthdr1 ){
		$tgl_laporan=$dthdr1->tgl_laporan;			
		$pdf->cell(45, 25, 'Tanggal:'.$tgl_laporan.'',1,0,'L',0);
		}
		
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30,6, 'JUDUL',1,0,'C',0);
		
		$pdf->cell(325,6, $frmjdl, 1,0,'C',0);
		$pdf->cell(45, 6, 'TGL.:'.$tgl_laporan.'', 1,0,'L',0);
				
		$pdf->Ln();
		
		$pdf->SetFillColor(230,230,230,230);
		$pdf->setFont('Arial','B',10);  
    
        $pdf->SetFillColor(230,230,230,230);
        $pdf->setFont('Arial','B',8);  
		$pdf->cell(10,12,'No',1,0,'C',0);
        $pdf->cell(50,12,'Sampling Point',1,0,'C',0);
        $pdf->cell(30,12, 'Time Of Swabbing',1,0,'C',0);
        $pdf->cell(70,6, 'Total Plate Count',1,0,'C',0);
        $pdf->cell(70, 6, 'Eneterobacterieceae',1,0,'C',0);
        $pdf->cell(70,6, 'E.coli',1,0,'C',0);
        $pdf->cell(70,6, 'Salmonella',1,0,'C',0);
		$pdf->cell(30,12, 'Remarks',1,0,'C',0);	
		$pdf->cell(0.5,6, '',0,0,'C',0);
		
		$pdf->Ln();
        $pdf->cell(10,6, '',0,0,'C',0);
        $pdf->cell(50,6, '',0,0,'C',0);
        $pdf->cell(30,6, '',0,0,'C',0);
        $pdf->cell(20,6, 'Floor',1,0,'C',0);
        $pdf->cell(20,6, 'Wall',1,0,'C',0);
        $pdf->cell(30,6, 'Drainage',1,0,'C',0);
        $pdf->cell(20,6, 'Floor',1,0,'C',0);
        $pdf->cell(20,6, 'Wall',1,0,'C',0);
        $pdf->cell(30,6, 'Drainage',1,0,'C',0);
        $pdf->cell(20,6, 'Floor',1,0,'C',0);
        $pdf->cell(20,6, 'Wall',1,0,'C',0);
        $pdf->cell(30,6, 'Drainage',1,0,'C',0);
        $pdf->cell(20,6, 'Floor',1,0,'C',0);
        $pdf->cell(20,6, 'Wall',1,0,'C',0);
        $pdf->cell(30,6, 'Drainage',1,0,'C',0);
                

        $pdf->Ln();
        $no=1;
       foreach ($datadtl as $row1){             
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');   
        $pdf->cell(50,6,$row1->sampling_point, 1,'L');
        $pdf->cell(30,6,$row1->sampling_jam, 1,'L');
        $pdf->cell(20,6,$row1->tpc_floor, 1,'L');
        $pdf->cell(20,6,$row1->tpc_wall, 1,'L');  
        $pdf->cell(30,6,$row1->tpc_drainage, 1,'L');
		if ($row1->operator=='0'){
			$operator="<";
		}elseif($row1->operator=='1'){
			$operator=">";
		}else{
			$operator="";
		}
        $pdf->cell(20,6,$operator.' '.$row1->entero_floor, 1,'L');
		if ($row1->operator2=='0'){
			$operator2="<";
		}elseif($row1->operator2=='1'){
			$operator2=">";
		}else{
			$operator2="";
		}
        $pdf->cell(20,6,$operator2.' '.$row1->entero_wall, 1,'L');
		
		if ($row1->operator3=='0'){
			$operator3="<";
		}elseif($row1->operator3=='1'){
			$operator3=">";
		}else{
			$operator3="";
		}
        $pdf->cell(30,6,$operator3.' '.$row1->entero_drainage, 1,'L');

        $pdf->cell(20,6,$row1->ecoli_floor, 1,'L');
        $pdf->cell(20,6,$row1->ecoli_wall, 1,'L');
        $pdf->cell(30,6,$row1->ecoli_drainage, 1,'L');
        $pdf->cell(20,6,$row1->salmonella_floor, 1,'L');
        $pdf->cell(20,6,$row1->salmonella_wall, 1,'L');
        $pdf->cell(30,6,$row1->salmonella_drainage, 1,'L');
        $pdf->cell(30,6,$row1->remarks, 1,'L');
		

        $pdf->Ln();
        $no++;   
        }
	  foreach($dtfrm as $dt_form){
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
		$pdf->SetFont('Arial','',8);
		$pdf->cell(370,6, 'Mulai Berlaku : '.$frmefec,1,0,'L',0);
        $pdf->cell(30,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');  
        }else{}
        break; 
	    
	    case $frmkode=="frmfss069": 	  
        if($filekd=="export") {
		
		$pdf->AddPage('L','A3');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
         //$pdf->SetFillColor(230,230,230,230); 
         $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30, 25, $a,1,0,'C',0);
       // $dtheader1=$this->$model->get_header_byid($id);
        
         
        $pdf->cell(330, 25, $title, 1,0,'C',0);
        $pdf->SetFont('Arial','',10);
    
        // foreach($dtheader1 as $dthdr1){
        // $docno=$dthdr1->docno;
        $pdf->cell(40, 25, 'Tgl :',1,0,'L',0);
        // 
            
        
        $pdf->Ln();
        $pdf->SetFont('Arial','B',8);
        $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
        
        $pdf->cell(330,6, $frmjdl, 1,0,'C',0);
        // $dtheader1=$this->$model->get_header_byid($id);
        // foreach($dtheader1 as $dthdr1){
        // $productiondate=$dthdr1->productiondate;
        $pdf->cell(40, 6, 'Dok:', 1,0,'L',0);
        // }
        $pdf->Ln();
		$pdf->SetFont('Arial','B',8);
        $pdf->cell(9,6,'No.',1,0,'C',0);    
        $pdf->cell(31,6,'Sampling Point',1,0,'C',0);
        $pdf->cell(15,6,'Time',1,0,'C',0);
        $pdf->cell(200,6,'Analysis Parameters',1,0,'C',0);
		
        $pdf->cell(5,6,'',0,0,'C',0);
		
        $pdf->cell(25,6,'Sampling Point',1,0,'C',0);
		$pdf->cell(15,6,'Time',1,0,'C',0);
        $pdf->cell(100,6,'Analysis Parameters',1,0,'C',0);  
       
		$pdf->Ln();	   	
       $pdf->cell(9,6,'',1,0,'C',0);  
	   $pdf->cell(31,6,'',1,0,'C',0);
       $pdf->cell(15,6,'',1,0,'C',0);
	   
	   $pdf->cell(25,6,'pH',1,0,'C',0);
	   $pdf->cell(25,6,'Chloride',1,0,'C',0);
	   $pdf->cell(25,6,'TDS',1,0,'C',0);
	   $pdf->cell(25,6,'TH',1,0,'C',0);
	   $pdf->cell(25,6,'TCL',1,0,'C',0);
	   $pdf->cell(25,6,'FCL',1,0,'C',0);
	   $pdf->cell(25,6,'Colour',1,0,'C',0);
	   $pdf->cell(25,6,'Odour',1,0,'C',0);
	   
	   $pdf->cell(5,6,'',0,0,'C',0);
	   
	   $pdf->cell(25,6,'',1,0,'C',0);
	   $pdf->cell(15,6,'',1,0,'C',0);
	   
	   $pdf->cell(25,6,'TPC',1,0,'C',0);
	   $pdf->cell(25,6,'TCC',1,0,'C',0);
	   $pdf->cell(25,6,'E.coli',1,0,'C',0);
	   $pdf->cell(25,6,'Salmonella',1,0,'C',0);
	   
	   $pdf->Ln();	
	   $pdf->cell(9,6,'',1,0,'C',0);  
	   $pdf->cell(31,6,'',1,0,'C',0);
       $pdf->cell(15,6,'',1,0,'C',0);
	   
	   $pdf->cell(25,6,'',1,0,'C',0);
	   $pdf->cell(25,6,'ppm',1,0,'C',0);
	   $pdf->cell(25,6,'ppm',1,0,'C',0);
	   $pdf->cell(25,6,'ppm',1,0,'C',0);
	   $pdf->cell(25,6,'ppm',1,0,'C',0);
	   $pdf->cell(25,6,'ppm',1,0,'C',0);
	   $pdf->cell(25,6,'PtCo',1,0,'C',0);
	   $pdf->cell(25,6,'&Flavour',1,0,'C',0);
	   
	   $pdf->cell(5,6,'',0,0,'C',0);
	   
	   $pdf->cell(25,6,'',1,0,'C',0);
	   $pdf->cell(15,6,'',1,0,'C',0);
	   
	   $pdf->cell(25,6,'cfu/mL',1,0,'C',0);
	   $pdf->cell(25,6,'cfu/mL',1,0,'C',0);
	   $pdf->cell(25,6,'Abs/25mL',1,0,'C',0);
	   $pdf->cell(25,6,'Abs/25mL',1,0,'C',0); 
       
            
        $pdf->Ln();

        $no=1;          
      // if(empty($datadtl)){}else{
        foreach ($datadtl as $row1){      
        $pdf->SetFont('Arial','',8);
        $pdf->cell(9,6,$no, 1,'L');
        $pdf->cell(31,6,$row1->nama_kimia, 1,'L');
        $pdf->cell(15,6,$row1->jam_sampling, 1,'L');
        $pdf->cell(25,6,$row1->ph, 1,'L');
        $pdf->cell(25,6,$row1->hasil_chloride, 1,'L');
        $pdf->cell(25,6,$row1->tds, 1,'L');
        $pdf->cell(25,6,$row1->hasil_th, 1,'L');
		$pdf->cell(25,6,$row1->tcl, 1,'L');
        $pdf->cell(25,6,$row1->fci, 1,'L');
        $pdf->cell(25,6,$row1->colour, 1,'L');
        $pdf->cell(25,6,$row1->odour, 1,'L');
        $pdf->cell(5,6,'', 0,'L'); 
		$pdf->cell(25,6,'', 1,'L');
        $pdf->cell(15,6,'', 1,'L');
		$pdf->cell(25,6,'', 1,'L');
        $pdf->cell(25,6,'', 1,'L');
        $pdf->cell(25,6,'', 1,'L');
        $pdf->cell(25,6,'', 1,'L');
        $pdf->Ln();
        $no++;   
        }
		$pdf->Ln(4);
		$pdf->SetFont('Arial','B',8);
		$pdf->cell(9,6,'No.',1,0,'C',0);    
        $pdf->cell(71,6,'Chemical Analysis ',1,0,'C',0);
		$pdf->cell(20,6,'Frequency',1,0,'C',0);
	    $pdf->cell(15,6,'pH',1,0,'C',0);
	    $pdf->cell(20,6,'Chloride',1,0,'C',0);
	    $pdf->cell(20,6,'Odour',1,0,'C',0);
	    $pdf->cell(20,6,'TDS',1,0,'C',0);
	    $pdf->cell(20,6,'TH',1,0,'C',0);
	    $pdf->cell(20,6,'TCL',1,0,'C',0);
		$pdf->cell(20,6,'FCL',1,0,'C',0);
		$pdf->cell(20,6,'Colour',1,0,'C',0);
		$pdf->cell(5,6,'',0,0,'C',0);
		$pdf->cell(35,6,'Microbiological Analysis ',1,0,'C',0);
	    $pdf->cell(25,6,'Frequency',1,0,'C',0);
	    $pdf->cell(15,6,'TPC',1,0,'C',0);
	    $pdf->cell(15,6,'TCC',1,0,'C',0);
	    $pdf->cell(25,6,'E.coli',1,0,'C',0);
	    $pdf->cell(25,6,'Salmonella',1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(9,6,'',1,0,'C',0);    
        $pdf->cell(71,6,'Specification ',1,0,'C',0);
		$pdf->cell(20,6,'',1,0,'C',0);
	    $pdf->cell(15,6,'',1,0,'C',0);
	    $pdf->cell(20,6,'ppm',1,0,'C',0);
	    $pdf->cell(20,6,'&Falvour',1,0,'C',0);
	    $pdf->cell(20,6,'ppm',1,0,'C',0);
	    $pdf->cell(20,6,'ppm',1,0,'C',0);
	    $pdf->cell(20,6,'ppm',1,0,'C',0);
		$pdf->cell(20,6,'ppm',1,0,'C',0);
		$pdf->cell(20,6,'PtCo',1,0,'C',0);
		$pdf->cell(5,6,'',0,0,'C',0);
		$pdf->cell(35,6,'Specification',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
	    $pdf->cell(15,6,'cfu/mL',1,0,'C',0);
	    $pdf->cell(15,6,'cfu/mL',1,0,'C',0);
	    $pdf->cell(25,6,'Abs/25mL',1,0,'C',0);
	    $pdf->cell(25,6,'Abs/25mL',1,0,'C',0);
        $pdf->Ln();
       // $no=1;
		//if(empty($datadtl2)){}else{
        //foreach($datadtl2 as $row1){ 
        $pdf->SetFont('Arial','',8);		
        $pdf->cell(9,6,'1', 1,'L');
        $pdf->cell(71,6,'Raw Water', 1,'L');
        $pdf->cell(20,6,'1 x/day', 1,'L');
        $pdf->cell(15,6,'4.0-6.0', 1,'L');
        $pdf->cell(20,6,'50 max', 1,'L');
		$pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'500 max', 1,'L');
        $pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'', 1,'L');  
		$pdf->cell(20,6,'', 1,'L');
        $pdf->cell(5,6,'', 0,'L'); 
		$pdf->cell(35,6,'After Softener',1,0,'C',0);
	    $pdf->cell(25,6,'1 x/day',1,0,'C',0);
	    $pdf->cell(15,6,'1000 max',1,0,'C',0);
	    $pdf->cell(15,6,'<1',1,0,'C',0);
	    $pdf->cell(25,6,'Abs',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);	
		$pdf->Ln();
		$pdf->cell(9,6,'2', 1,'L');
        $pdf->cell(71,6,'Equalisasi', 1,'L');
        $pdf->cell(20,6,'1 x/shift', 1,'L');
        $pdf->cell(15,6,'9.0-10.15', 1,'L');
        $pdf->cell(20,6,'', 1,'L');
		$pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'500 max', 1,'L');
        $pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'', 1,'L');  
		$pdf->cell(20,6,'', 1,'L');
        $pdf->cell(5,6,'', 0,'L'); 
		$pdf->cell(35,6,'After Reverse Osmosis',1,0,'C',0);
	    $pdf->cell(25,6,'1 x/day',1,0,'C',0);
	    $pdf->cell(15,6,'500 max',1,0,'C',0);
	    $pdf->cell(15,6,'<1',1,0,'C',0);
	    $pdf->cell(25,6,'Abs',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(9,6,'3', 1,'L');
        $pdf->cell(71,6,'After Carbon Filter 1/2', 1,'L');
        $pdf->cell(20,6,'1 x/shift', 1,'L');
        $pdf->cell(15,6,'6.5-8.5', 1,'L');
        $pdf->cell(20,6,'50 max', 1,'L');
		$pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'500 max', 1,'L');
        $pdf->cell(20,6,'150 max', 1,'L');
        $pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'0.1 max', 1,'L');  
		$pdf->cell(20,6,'40 max', 1,'L');
        $pdf->cell(5,6,'', 0,'L'); 
		$pdf->cell(35,6,'MPD Water',1,0,'C',0);
	    $pdf->cell(25,6,'1 x/day',1,0,'C',0);
	    $pdf->cell(15,6,'1000 max',1,0,'C',0);
	    $pdf->cell(15,6,'<1',1,0,'C',0);
	    $pdf->cell(25,6,'Abs',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(9,6,'4', 1,'L');
        $pdf->cell(71,6,'After Softener 1/2/3', 1,'L');
        $pdf->cell(20,6,'1 x/shift', 1,'L');
        $pdf->cell(15,6,'6.5-8.5', 1,'L');
        $pdf->cell(20,6,'', 1,'L');
		$pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'20 max', 1,'L');
        $pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'', 1,'L');  
		$pdf->cell(20,6,'', 1,'L');
        $pdf->cell(5,6,'', 0,'L'); 
		$pdf->cell(35,6,'SPD Water',1,0,'C',0);
	    $pdf->cell(25,6,'1 x/shift',1,0,'C',0);
	    $pdf->cell(15,6,'1000 max',1,0,'C',0);
	    $pdf->cell(15,6,'<1',1,0,'C',0);
	    $pdf->cell(25,6,'Abs',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(9,6,'5', 1,'L');
        $pdf->cell(71,6,'After Reverse Osmosis', 1,'L');
        $pdf->cell(20,6,'1 x/shift', 1,'L');
        $pdf->cell(15,6,'6.5-8.5', 1,'L');
        $pdf->cell(20,6,'30 max', 1,'L');
		$pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'250 max', 1,'L');
        $pdf->cell(20,6,'10 max', 1,'L');
        $pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'', 1,'L');  
		$pdf->cell(20,6,'20max', 1,'L');
        $pdf->cell(5,6,'', 0,'L'); 
		$pdf->cell(35,6,'Water Quality WTP',1,0,'C',0);
	    $pdf->cell(25,6,'1 x/day',1,0,'C',0);
	    $pdf->cell(15,6,'100 max',1,0,'C',0);
	    $pdf->cell(15,6,'<1',1,0,'C',0);
	    $pdf->cell(25,6,'Abs',1,0,'C',0);
	    $pdf->cell(25,6,'Abs',1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(9,6,'6', 1,'L');
        $pdf->cell(71,6,'MPD Water', 1,'L');
        $pdf->cell(20,6,'1 x/day', 1,'L');
        $pdf->cell(15,6,'6.5-8.5', 1,'L');
        $pdf->cell(20,6,'50 max', 1,'L');
		$pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'500 max', 1,'L');
        $pdf->cell(20,6,'150 max', 1,'L');
        $pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'0.1max', 1,'L');  
		$pdf->cell(20,6,'40max', 1,'L');
        $pdf->cell(5,6,'', 0,'L');
		$pdf->cell(35,6,'',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
	    $pdf->cell(15,6,'',1,0,'C',0);
	    $pdf->cell(15,6,'',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(9,6,'7', 1,'L');
        $pdf->cell(71,6,'Water Quality WTP', 1,'L');
        $pdf->cell(20,6,'1 x/shift', 1,'L');
        $pdf->cell(15,6,'6.5-8.5', 1,'L');
        $pdf->cell(20,6,'30 max', 1,'L');
		$pdf->cell(20,6,'No Taste', 1,'L');
        $pdf->cell(20,6,'250 max', 1,'L');
        $pdf->cell(20,6,'10 max', 1,'L');
        $pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'0.1max', 1,'L');  
		$pdf->cell(20,6,'20max', 1,'L');
        $pdf->cell(5,6,'', 0,'L');
		$pdf->cell(35,6,'',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
	    $pdf->cell(15,6,'',1,0,'C',0);
	    $pdf->cell(15,6,'',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(9,6,'8', 1,'L');
        $pdf->cell(71,6,'After Chlorine Exposure', 1,'L');
        $pdf->cell(20,6,'1 x/shift', 1,'L');
        $pdf->cell(15,6,'6.5-8.5', 1,'L');
        $pdf->cell(20,6,'50 max', 1,'L');
		$pdf->cell(20,6,'', 1,'L');
        $pdf->cell(20,6,'500 max', 1,'L');
        $pdf->cell(20,6,'150 max', 1,'L');
        $pdf->cell(20,6,'0.5-5.0', 1,'L');
        $pdf->cell(20,6,'', 1,'L');  
		$pdf->cell(20,6,'50max', 1,'L');
        $pdf->cell(5,6,'', 0,'L');
		$pdf->cell(35,6,'',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
	    $pdf->cell(15,6,'',1,0,'C',0);
	    $pdf->cell(15,6,'',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
	    $pdf->cell(25,6,'',1,0,'C',0);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->cell(25,6,'pH', 0,'L');
        $pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'_Log (H+)', 0,'L');
        $pdf->cell(25,6,'TPC', 0,'L');
		$pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'Total Plate Count', 0,'L');
		$pdf->Ln();
		$pdf->cell(25,6,'TDS', 0,'L');
        $pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'Total Disolved Solid', 0,'L');
        $pdf->cell(25,6,'TCC', 0,'L');
		$pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'Total Coliform Count', 0,'L');
		$pdf->Ln();
		$pdf->cell(25,6,'TH', 0,'L');
        $pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'Total Hardness', 0,'L');
        $pdf->cell(25,6,'Abs', 0,'L');
		$pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'Abssence', 0,'L');
		$pdf->Ln();
		$pdf->cell(25,6,'TCL', 0,'L');
        $pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'Total Chlorine', 0,'L');
        $pdf->cell(25,6,'NA', 0,'L');
		$pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'Not Available', 0,'L');
		$pdf->Ln();
		$pdf->cell(25,6,'FCL', 0,'L');
        $pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'Free Chlorine', 0,'L');
        $pdf->cell(25,6,'Cfu/Ml', 0,'L');
		$pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'coloni forming unit/ mililiter', 0,'L');
		$pdf->Ln();
		$pdf->cell(25,6,'ppm', 0,'L');
        $pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'parts per million', 0,'L');
        $pdf->cell(25,6,'', 0,'L');
		$pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'Not Analyzed', 0,'L');
		$pdf->Ln();
		$pdf->cell(25,6,'PtCo', 0,'L');
        $pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'Platinum Cobalt', 0,'L');
        $pdf->cell(25,6,'', 0,'L');
		$pdf->cell(5,6,':', 0,'L');
        $pdf->cell(50,6,'Analyzed',0,'L');
        $pdf->Ln();
        $no++;   
        
        
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
		$pdf->Output($frmkode.'.pdf','I');
        }else{}
      
       break; 

       //  case $frmkode=="frmfss190":
       //  $dtheader = $this->$model->get_header_byid($id);
       //  $data7 = array('dtheader' => $dtheader);
       //  foreach($dtheader as $dt_headerrow) {
       //      $dtcreate_date = $dt_headerrow->create_date;
       //      $dtcategoryproduct = $dt_headerrow->categoryproduct;
       //  }
       //  if($cekLevelUserNm=="Auditor") {
       //      $dtdetail1 = $this->M_formfrmfss190_03->get_detail_byidx($id);
       //      // $dtdetail2 = $this->M_formfrmfss121_01->get_dts052x($dttgl_produksi,$dtfiller);
       //      // $dtdetail3 = $this->M_formfrmfss121_01->get_dts083x($dttgl_produksi,$dtfiller);
       //  } else {
       //      $dtdetail1 = $this->M_formfrmfss190_03->get_detail_byid($id);
       //      // $dtdetail2 = $this->M_formfrmfss121_01->get_dts052($dttgl_produksi,$dtfiller);
       //      // $dtdetail3 = $this->M_formfrmfss121_01->get_dts083($dttgl_produksi,$dtfiller);
       //  }
        
       //  if($filekd=="export"){
       //  $pdf->AddPage('L','A3');
       //  $logor="assets/images/rlogopsg.png";
       //  $title="PT.PULAU SAMBU GUNTUNG";        
       //  $a=$pdf->Image($logor,10,10,30,25);
       //  $dates="Printed Date : ". date('d/m/y');
       //  $pdf->SetAutoPageBreak(true);  
       //   //$pdf->SetFillColor(230,230,230,230); 
       //  $pdf->SetFillColor(110,180,230);
       //  $pdf->SetFont('Arial','',10);
       //  $pdf->cell(30, 25, $a,1,0,'C',0);
       //  $dtheader1=$this->$model->get_header_byid($id);         
       //  $pdf->cell(325, 25, $title, 1,0,'C',0);
       //  $pdf->SetFont('Arial','',10);
       //  foreach($dtheader1 as $dthdr1){
       //  $docno=$dthdr1->docno;
       //  $tanggal=$dthdr1->create_date;
       //  $pdf->cell(45, 25, 'Doc :'.$docno.'',1,0,'L',0);
       //   }    
       //  $pdf->Ln();
       //  $pdf->SetFont('Arial','',10);
       //  $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
       //  $pdf->cell(325,6, $frmjdl, 1,0,'C',0);       
       //  $pdf->cell(45, 6, 'Date:'.$create_date.'', 1,0,'L',0);
       //  $pdf->Ln();
       //  $pdf->SetFont('Arial','',8);
       //  foreach($dtheader1 as $dthdr1){
       //  $activity=$dthdr1->activity;
       //  $fillingmachine=$dthdr1->fillingmachine;
       //  $productid=$dthdr1->productid;
       //  $expiredate=$dthdr1->expiredate;
       //  $machine=$dthdr1->machine;

       
       //  $pdf->cell(400,10, 'ACTIVITY :'.$activity.'',1,0,'L',0);
       //  $pdf->Ln();
       //  $pdf->cell(400,10, 'FILLING MACHINNE :'.$fillingmachine.'',1,0,'L',0);
       //  $pdf->Ln();
       //  $pdf->cell(400,10, 'PRODUCT ID :'.$productid.'',1,0,'L',0);
       //  $pdf->Ln();
       //  $pdf->cell(400,10, 'EXPIRED DATE :'.$expiredate.'',1,0,'L',0);
       //  $pdf->Ln();
       //  $pdf->cell(400,10, 'MACHINE :'.$machine.'',1,0,'L',0);
       //  $pdf->Ln();
       //  $pdf->SetFont('Arial','B',10);
       //  $pdf->cell(400,10, 'CARTON ',0,0,'L',0);
       //  $pdf->Ln();
       //  }
       //  // CARTON
       //  $pdf->SetFillColor(110,180,230);
       //  $pdf->SetFont('Arial','B',7);
       //  $pdf->cell(10,6,'No.',1,0,'C',0);           
       //  $pdf->cell(20,6,'Packer Name ',1,0,'C',0);       
       //  $pdf->cell(25,6,'Pallet No',1,0,'C',0);
       //  $pdf->cell(35, 6, 'Numbering By',1,0,'C',0);
       //  $pdf->cell(35, 6, 'Machine - Carton No ',1,0,'C',0);
       //  $pdf->cell(35, 6, 'Check',1,0,'C',0);
       //  $pdf->cell(30,6, 'Time',1,0,'C',0);
       //  $pdf->cell(35, 6, 'Dating & Check QAD',1,0,'C',0);
       //  $pdf->cell(15, 6, 'Stickering & Check QAD',1,0,'C',0);
       //  // $pdf->cell(40, 6, 'Qty of Packs ',1,0,'C',0);
       //  // $pdf->cell(40, 6, 'Weight of Packs (Average)    ',1,0,'C',0);
       //  // $pdf->cell(40, 6, 'Package Integrity Check',1,0,'C',0);
       //  // $pdf->cell(40, 6, 'Remarks',1,0,'C',0);
       //  $pdf->Ln();
       //  $no=1;
       //  $dtdetail1 = $this->$model->get_detail_byid($id);
       //  if ($dtdetail1){
       //  foreach($dtdetail1 as $row1){       
       //  $pdf->SetFont('Arial','',8);
       //  $pdf->cell(10,6,$no, 1,'L');    
       //  $pdf->cell(20,6,$row1->packername, 1,'L');
       //  $pdf->cell(25,6,$row1->palletno, 1,'L');
       //  $pdf->cell(35,6,$row1->numberingby, 1,'L');
       //  $pdf->cell(35,6,$row1->cartonno, 1,'L');
       //  $pdf->cell(35,6,$row1->stickeringcheckqad, 1,'L');
       //  $pdf->cell(30,6,$row1->checktime, 1,'L');
       //  $pdf->cell(35,6,$row1->datingcheckqad, 1,'L');
       //  $pdf->cell(15,6,$row1->stickeringcheckqad, 1,'L');
       //  // $pdf->cell(40,6,$row1->qty_pack, 1,'L');
       //  // $pdf->cell(40,6,$row1->weight_pack, 1,'L');
       //  // $pdf->cell(40,6,$row1->integrity, 1,'L');
       //  // $pdf->cell(40,6,$row1->remarks, 1,'L');
       //  $pdf->Ln();
       //  $no++;
       // }
       // }

	    case $frmkode=="frmfss121":
		$dtheader = $this->$model->get_header_byid($id);
        $data7 = array('dtheader' => $dtheader);
        foreach($dtheader as $dt_headerrow) {
            $dttgl_produksi = $dt_headerrow->tgl_produksi;
            $dtfiller = $dt_headerrow->filler;
        }
        if($cekLevelUserNm=="Auditor") {
            $dtdetail1 = $this->M_formfrmfss121_01->get_detail_byidx($id);
            $dtdetail2 = $this->M_formfrmfss121_01->get_dts052x($dttgl_produksi,$dtfiller);
            $dtdetail3 = $this->M_formfrmfss121_01->get_dts083x($dttgl_produksi,$dtfiller);
        } else {
            $dtdetail1 = $this->M_formfrmfss121_01->get_detail_byid($id);
            $dtdetail2 = $this->M_formfrmfss121_01->get_dts052($dttgl_produksi,$dtfiller);
            $dtdetail3 = $this->M_formfrmfss121_01->get_dts083($dttgl_produksi,$dtfiller);
        }
		
        if($filekd=="export"){
        $pdf->AddPage('L','A3');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
         //$pdf->SetFillColor(230,230,230,230); 
        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30, 25, $a,1,0,'C',0);
        $dtheader1=$this->$model->get_header_byid($id);         
        $pdf->cell(325, 25, $title, 1,0,'C',0);
        $pdf->SetFont('Arial','',10);
        foreach($dtheader1 as $dthdr1){
        $docno=$dthdr1->docno;
        $tanggal=$dthdr1->tanggal;
        $pdf->cell(45, 25, 'Doc :'.$docno.'',1,0,'L',0);
         }    
        $pdf->Ln();
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
        $pdf->cell(325,6, $frmjdl, 1,0,'C',0);       
        $pdf->cell(45, 6, 'Date:'.$tanggal.'', 1,0,'L',0);
        $pdf->Ln();
        $pdf->SetFont('Arial','',8);
        foreach($dtheader1 as $dthdr1){
        $no_formula=$dthdr1->no_formula;
        $tgl_produksi=$dthdr1->tgl_produksi;
        $tgl_analis=$dthdr1->tgl_analis;
        $filler=$dthdr1->filler;
       
        $pdf->cell(400,10, 'FORMULATION NO:'.$no_formula.'',1,0,'L',0);
        $pdf->Ln();
        $pdf->cell(400,10, 'PRODUCTION DATE/BEST BEFORE (EXPIRY DATE) :'.$tgl_produksi.'',1,0,'L',0);
        $pdf->Ln();
        $pdf->cell(400,10, 'DATE OF ANALYSIS :'.$tgl_analis.'',1,0,'L',0);
        $pdf->Ln();
        $pdf->cell(400,10, 'FILLER :'.$filler.'',1,0,'L',0);
        $pdf->Ln();
		$pdf->SetFont('Arial','B',10);
		$pdf->cell(400,10, 'A. WET PROCESS MONITORING - INCUBATION ANALYSIS RESULTS ',0,0,'L',0);
        $pdf->Ln();
        }
        //A. WET PROCESS MONITORING - INCUBATION ANALYSIS RESULTS
        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','B',7);
        $pdf->cell(10,6,'No.',1,0,'C',0);           
        $pdf->cell(20,6,'Product Code ',1,0,'C',0);       
        $pdf->cell(25,6,'Sampling Time',1,0,'C',0);
        $pdf->cell(35, 6, 'Product ID',1,0,'C',0);
        $pdf->cell(35, 6, 'Sample Type (R/A/Rspl) ',1,0,'C',0);
        $pdf->cell(35, 6, 'Incubation Temp/°C',1,0,'C',0);
        $pdf->cell(30,6, 'Odour and Flavour*',1,0,'C',0);
        $pdf->cell(35, 6, 'Colour and Appearance**',1,0,'C',0);
        $pdf->cell(15, 6, 'pH',1,0,'C',0);
        $pdf->cell(40, 6, 'Qty of Packs ',1,0,'C',0);
        $pdf->cell(40, 6, 'Weight of Packs (Average) 	',1,0,'C',0);
        $pdf->cell(40, 6, 'Package Integrity Check',1,0,'C',0);
        $pdf->cell(40, 6, 'Remarks',1,0,'C',0);
        $pdf->Ln();
        $no=1;
		$dtdetail1 = $this->$model->get_detail_byid($id);
        if ($dtdetail1){
        foreach($dtdetail1 as $row1){  		
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');    
        $pdf->cell(20,6,$row1->product_code, 1,'L');
        $pdf->cell(25,6,$row1->sampling_time, 1,'L');
        $pdf->cell(35,6,$row1->product_id, 1,'L');
        $pdf->cell(35,6,$row1->sample_type, 1,'L');
        $pdf->cell(35,6,$row1->temp, 1,'L');
        $pdf->cell(30,6,$row1->odour, 1,'L');
        $pdf->cell(35,6,$row1->colour, 1,'L');
        $pdf->cell(15,6,$row1->ph, 1,'L');
        $pdf->cell(40,6,$row1->qty_pack, 1,'L');
        $pdf->cell(40,6,$row1->weight_pack, 1,'L');
		$pdf->cell(40,6,$row1->integrity, 1,'L');
        $pdf->cell(40,6,$row1->remarks, 1,'L');
        $pdf->Ln();
        $no++;
       }
	   }
	   
	    //B. CHEMICAL LABORATORY - PHYSICO - CHEMICAL ANALYSIS
	    $pdf->SetFont('Arial','B',10);
	    $pdf->cell(400,10, 'B. CHEMICAL LABORATORY - PHYSICO - CHEMICAL ANALYSIS ',0,0,'L',0);
        $pdf->Ln();
	    $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','B',7);
        $pdf->cell(10,12,'No.',1,0,'C',0);           
        $pdf->cell(20,6,'Product  ',1,0,'C',0);       
        $pdf->cell(20,6,'Sampling',1,0,'C',0);
        $pdf->cell(35, 6, 'Product',1,0,'C',0);
        $pdf->cell(35, 6, 'Sample Type ',1,0,'C',0);
		$pdf->cell(15, 12, 'pH',1,0,'C',0);
		$pdf->cell(20, 6, 'Specify',1,0,'C',0);
		$pdf->cell(20,6, 'Odour',1,0,'C',0);
		$pdf->cell(35, 6, 'Colour and ',1,0,'C',0);
		$pdf->cell(20, 6, 'Fat ',1,0,'C',0);
        $pdf->cell(25, 6, 'Dry',1,0,'C',0);
        $pdf->cell(15, 6, 'Viscocity',1,0,'C',0);
        $pdf->cell(40, 6, 'Free Fatty Acids ',1,0,'C',0);
        $pdf->cell(30, 6, 'Peroxide ',1,0,'C',0);
        $pdf->cell(30, 12, 'Keterangan',1,0,'C',0);
        $pdf->cell(30, 12, 'Remarks',1,0,'C',0);
		$pdf->cell(0.5, 6, '',0,0,'C',0);
        $pdf->Ln();
        $pdf->cell(10,6,'',0,0,'C',0);           
        $pdf->cell(20,6,'Code ',1,0,'C',0);       
        $pdf->cell(20,6,' Time',1,0,'C',0);
        $pdf->cell(35, 6, 'ID',1,0,'C',0);
        $pdf->cell(35, 6, '(R/A/Rspl) ',1,0,'C',0);
		$pdf->cell(15, 6, '',0,0,'C',0);
		$pdf->cell(20, 6, 'Grafity',1,0,'C',0);
		$pdf->cell(20,6, 'and Flavour*',1,0,'C',0);
		$pdf->cell(35, 6, 'Appearance**',1,0,'C',0);
		$pdf->cell(20, 6, 'Content/%',1,0,'C',0);
        $pdf->cell(25, 6, 'Meter/%',1,0,'C',0);
        $pdf->cell(15, 6, '(cps)',1,0,'C',0);
        $pdf->cell(40, 6, '(%, As Lauric Acid) ',1,0,'C',0);
        $pdf->cell(30, 6, 'Value(meq/kg)',1,0,'C',0);
        $pdf->cell(30, 6, '',0,0,'C',0);
        $pdf->cell(30, 6, '',0,0,'C',0);
		$pdf->cell(0.5, 6, '',0,0,'C',0);
        $pdf->Ln();
		$no=1;
		$dtdetail2 = $this->$model->get_dts052($dttgl_produksi,$dtfiller);
		if(isset($dtdetail2)){
        foreach($dtdetail2 as $dtdetail2_row){ 		 
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');   
		$pdf->cell(20,6,$dtdetail2_row->filler, 1,'L');
        $pdf->cell(20,6,$dtdetail2_row->jam_sampel, 1,'L');
        $pdf->cell(35,6,$dtdetail2_row->product_id, 1,'L');
        $pdf->cell(35,6,$dtdetail2_row->kd_produk, 1,'L');
        $pdf->cell(15,6,$dtdetail2_row->ph_hasil, 1,'L');
        $pdf->cell(20,6,$dtdetail2_row->sg_hasil, 1,'L');
        $pdf->cell(20,6,$dtdetail2_row->odour_hasil, 1,'L');
        $pdf->cell(35,6,$dtdetail2_row->colour_hasil, 1,'L');
        $pdf->cell(20,6,$dtdetail2_row->fc_hasil, 1,'L');
        $pdf->cell(25,6,$dtdetail2_row->dm_hasil, 1,'L');
        $pdf->cell(15,6,$dtdetail2_row->visco_hasil, 1,'L');
		$pdf->cell(40,6,$dtdetail2_row->ffa_hasil, 1,'L');
        $pdf->cell(30,6,$dtdetail2_row->pv_hasil, 1,'L');
		$pdf->cell(30,6,$dtdetail2_row->keterangan, 1,'L');
		$pdf->cell(30,6,$dtdetail2_row->ket_monitoring, 1,'L');
		$pdf->cell(0.5, 6, '',0,0,'C',0);
        $pdf->Ln();
        $no++;
		}
		}	
		
		//C. MICROBIOLOGY LABORATORY - MICROBIOLOGICAL ANALYSIS
		$pdf->SetFont('Arial','B',10);
	    $pdf->cell(400,10, 'C. MICROBIOLOGY LABORATORY - MICROBIOLOGICAL ANALYSIS',0,0,'L',0);
        $pdf->Ln();
		$pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','B',7);
        $pdf->cell(10,18,'No.',1,0,'C',0);           
        $pdf->cell(30,12,'',1,0,'C',0);
		$pdf->cell(30,12,'',1,0,'C',0);
		$pdf->cell(35,12,'',1,0,'C',0);
		$pdf->cell(20,12,' ',1,0,'C',0);
		$pdf->cell(20,12,'',1,0,'C',0);
		$pdf->cell(195,6,'Commercial Sterility / Streak Test  ',1,0,'C',0);
		$pdf->cell(30,18,'Keterangan',1,0,'C',0);
		$pdf->cell(30,18,'Remarks',1,0,'C',0);
		$pdf->cell(0.5,6,'',0,0,'C',0);
		$pdf->Ln();
		$pdf->cell(10,6,'',0,0,'C',0);           
        $pdf->cell(30,6,'Product',0,0,'C',0);
		$pdf->cell(30,6,'Sampling',0,0,'C',0);
		$pdf->cell(35,6,'Sample Type',0,0,'C',0);
		$pdf->cell(20,6,'Incubation',0,0,'C',0);
		$pdf->cell(20,6,'Qty of',0,0,'C',0);
		$pdf->cell(50,6,'Commercial Sterile',1,0,'C',0);
		$pdf->cell(50,6,'Unsterile',1,0,'C',0);
		$pdf->cell(20,12,'TAB',1,0,'C',0);
		$pdf->cell(75,12,'Unsterile Packs Analysis (Rough Micro Identification)',1,0,'C',0);
		$pdf->cell(30,6,'',0,0,'C',0);
		$pdf->cell(30,6,'',0,0,'C',0);
		$pdf->cell(0.5,6,'',0,0,'C',0);
		$pdf->Ln();
		$pdf->cell(10,6,'',0,0,'C',0);           
        $pdf->cell(30,6,'Code',1,0,'C',0);
		$pdf->cell(30,6,'Time',1,0,'C',0);
		$pdf->cell(35,6,'(R/A/Rspl)',1,0,'C',0);
		$pdf->cell(20,6,'Temp/°C',1,0,'C',0);
		$pdf->cell(20,6,'Packs',1,0,'C',0);
		$pdf->cell(25,6,'Qty',1,0,'C',0);
		$pdf->cell(25,6,'pH',1,0,'C',0);
		$pdf->cell(25,6,'Qty',1,0,'C',0);
		$pdf->cell(25,6,'pH',1,0,'C',0);
		$pdf->cell(20,6,'',0,0,'C',0);
		$pdf->cell(75,6,'',0,0,'C',0);
		$pdf->cell(30,6,'',0,0,'C',0);
		$pdf->cell(30,6,'',0,0,'C',0);
		$pdf->cell(0.5,6,'',0,0,'C',0);
		$pdf->Ln();
		$no=1;
		$dtdetail3 = $this->M_formfrmfss121_01->get_dts083($dttgl_produksi,$dtfiller);
		if(isset($dtdetail3)){
        foreach($dtdetail3 as $row3){ 	
		$pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');         
        $pdf->cell(30,6,$row3->filler,1,0,'C',0);
		$pdf->cell(30,6,$row3->jam_sampling,1,0,'C',0);
		$pdf->cell(35,6,$row3->kode_sample,1,0,'C',0);
		$pdf->cell(20,6,$row3->suhu,1,0,'C',0);
		$pdf->cell(20,6,'1',1,0,'C',0);
		if(($row3->csp_la_35=='CS')&&($row3->csp_la_55=='CS')){
			$a="1";
		}else{
			$a="";
		}
		$pdf->cell(25,6,''.$a.'',1,0,'C',0);
		if (($row3->csp_la_35=='CS')&&($row3->csp_la_55=='US')){
			$a=$row3->ph;
			}else{}
		$pdf->cell(25,6,''.$a.'',1,0,'C',0);
		if (($row3->csp_la_35=='US')&&($row3->csp_la_55=='US')){
			$a='1';
		}else{}
		$pdf->cell(25,6,''.$a.'',1,0,'C',0);
		if(($row3->csp_la_35=='US') && ($row3->csp_la_55=='US')){
			$a=$row3->ph;
		}else{}
		$pdf->cell(25,6,''.$a.'',1,0,'C',0);
		if ($row3->operator=='0'){
			$operator="<";
		}elseif($row3->operator=='1'){
			$operator=">";
		}else{
			$operator=" ";
		}
		$pdf->cell(20,6,$operator.''.$row3->tab,1,0,'C',0);
		$pdf->cell(75,6,$row3->rough_mic,1,0,'C',0);
		$pdf->cell(30,6,$row3->keterangan,1,0,'C',0);
		$pdf->cell(30,6,$row3->ket_monitoring,1,0,'C',0);
		$pdf->cell(0.5,6,'',0,0,'C',0);
		$pdf->Ln();
		$no++;
		}
		}
		$pdf->Ln();
		$pdf->cell(20,6,'Definitions',0,0,'L',0);
		$pdf->Ln();
		$pdf->cell(50,6,'*) Normal',0,0,'L',0);
		$pdf->cell(30,6,':',0,0,'L',0);
		$pdf->cell(330,6,'Sweet natural coconut flavour, free from foreign or objectionable flavout/ odour',0,0,'L',0);
		$pdf->Ln();
		$pdf->cell(50,6,'**) Normal',0,0,'L',0);
		$pdf->cell(30,6,':',0,0,'L',0);
		$pdf->cell(330,6,'Creamy White',0,0,'L',0);
		$pdf->Ln();
		$no=1;
	 foreach($dtfrm as $dt_form){
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
        $pdf->SetFont('Arial','',8);
        $pdf->cell(360,6,'Mulai Berlaku:'.$frmefec.'',1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),410,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');

        }else{}
        break;  
	  
	  case $frmkode =="frmhcp003":
			if ($filekd=="export"){
		$pdf->AddPage('L','A4');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
         //$pdf->SetFillColor(230,230,230,230); 
        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','B',10);
        $pdf->cell(30, 25, $a,1,0,'C',0);
        $dtheader1=$this->$model->get_header_byid($id);
        $pdf->cell(210, 25, $title, 1,0,'C',0);
        $pdf->SetFont('Arial','',10);
        foreach($dtheader1 as $dthdr1){
        $no_doc=$dthdr1->no_doc;
        $tgl_doc=$dthdr1->tgl_doc;
        $pdf->cell(40, 25, 'Dok :'.$no_doc.'',1,0,'L',0);
        }
        $pdf->Ln();
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
        $pdf->cell(210,6, $frmjdl, 1,0,'C',0);       
        $pdf->cell(40, 6, 'Tgl:'.$tgl_doc.'', 1,0,'L',0);
        $pdf->Ln();
        $pdf->cell(10,6,'No.',1,0,'C',0);      
        $pdf->cell(40,6,'Checkingtime',1,0,'C',0);
        $pdf->cell(45,6,'Detection Ferrous(3.mm)',1,0,'C',0);
        $pdf->cell(45,6,'Non Ferrous Brass (3.mm)',1,0,'C',0);
        $pdf->cell(80,6,'CheckedBy(Name/Sign)',1,0,'C',0);
        $pdf->cell(60,6,'Remarks',1,0,'C',0);              
        $pdf->Ln();
        $pdf->cell(10,6,'',1,0,'C',0);      
        $pdf->cell(40,6,'',1,0,'C',0);
        $pdf->cell(45,6,'',1,0,'C',0);
        $pdf->cell(45,6,'',1,0,'C',0);
        $pdf->cell(40,6,'Cmp',1,0,'C',0);
        $pdf->cell(40,6,'Qad',1,0,'C',0);
        $pdf->cell(60,6,'',1,0,'C',0);
        $pdf->Ln();


        $no=0;
       /* $rslt=46;
        $rw=6;*/

        foreach ($datadtl as $row1){    

        $no++;  
        $pdf->SetFont('Arial','',10);
        $pdf->cell(10,6,$no, 1,'L');
        $pdf->cell(40,6,$row1->checkingtime, 1,'L');
        $pdf->cell(45,6,$row1->detection_ferrous, 1,'L');
        $pdf->cell(45,6,$row1->non_ferrous_brass, 1,'L');
        $pdf->cell(40,6,$row1->checked_by_cmp, 1,'L');
        $pdf->cell(40,6,$row1->checked_by_qad, 1,'L');
        $pdf->cell(60,6,$row1->remarks, 1,'L');
       
        $pdf->Ln();
        $no++;   
        }
      foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
        $pdf->SetFont('Arial','',8);
        $pdf->cell(240,6,'Mulai Berlaku:'.$frmefec.'',1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),290,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');

        }else{}
        break;

       case $frmkode=="frmfss087":
         if($filekd=="export"){
        $pdf->AddPage('L','A3');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
         //$pdf->SetFillColor(230,230,230,230); 
         $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30, 25, $a,1,0,'C',0);
        $dtheader1=$this->$model->get_header_byid($id);
                 
        $pdf->cell(330, 25, $title, 1,0,'C',0);
        $pdf->SetFont('Arial','',10);
        
        foreach($dtheader1 as $dthdr1){
        $dtdoc=$dthdr1->dtdoc;
        $pdf->cell(45, 25, 'Doc :'.$dtdoc.'',1,0,'L',0);
        }
		$pdf->cell(0.5, 25, '',0,0,'L',0);

            
        $pdf->Ln();
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
        
        $pdf->cell(330,6, $frmjdl, 1,0,'C',0);
        
        foreach($dtheader1 as $dthdr1){
        $dtdate=$dthdr1->dtdate;
        $pdf->cell(45, 6, 'Date:'.$dtdate.'', 1,0,'L',0);
        }
        $pdf->cell(0.5, 6, '',0,0,'L',0); 
        $pdf->Ln();
        $pdf->SetFont('Arial','',8);
        foreach($dtheader1 as $dthdr1){
        $formula=$dthdr1->formula;
        $productiondate=$dthdr1->productiondate;
        $bbd=$dthdr1->bbd;
        $filler=$dthdr1->filler;
        $pack_kosong=$dthdr1->pack_kosong;

        $pdf->cell(405,10, 'Formula:'.$formula.'',1,0,'L',0);
		$pdf->cell(0.5, 10, '',0,0,'L',0);
        $pdf->Ln();
        $pdf->cell(405,10, 'Production Date :'.$productiondate.'',1,0,'L',0);
		$pdf->cell(0.5, 10, '',0,0,'L',0);
        $pdf->Ln();
        $pdf->cell(405,10, 'Expire Date/ Best Before Date :'.$bbd.'',1,0,'L',0);
		$pdf->cell(0.5, 10, '',0,0,'L',0);
        $pdf->Ln();
        $pdf->cell(405,10, 'Filler :'.$filler.'',1,0,'L',0);
        $pdf->Ln();
        $pdf->cell(405,10, 'Berat Pack Kosong :'.$pack_kosong.'',1,0,'L',0);
        $pdf->Ln();
        
        }
        
       

        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','B',7);
       
        $pdf->cell(10,18,'No.',1,0,'C',0);           
        $pdf->cell(20,12,' ',1,0,'C',0);       
        $pdf->cell(25,12,' ',1,0,'C',0);
        $pdf->cell(35, 12, '',1,0,'C',0);
        $pdf->cell(20, 12, ' ',1,0,'C',0);
        $pdf->cell(20, 12, '',1,0,'C',0);
        $pdf->cell(160,6, 'Weight/Pack (g)',1,0,'C',0);
        $pdf->cell(45, 6, 'Packing Quality (TBA/TPA/TCA/CB)',1,0,'C',0);
        $pdf->cell(40, 6, 'Flap Sealing (TBA/TPA/CB)',1,0,'C',0);
        $pdf->cell(30, 18, 'Remarks ',1,0,'C',0);
		$pdf->cell(0.5, 6, '',0,0,'L',0);
        $pdf->Ln();
        $pdf->cell(10,6,'',0,0,'C',0);
        $pdf->cell(20,6,'Sampling ',0,0,'C',0);       
        $pdf->cell(25,6,'Sampling',0,0,'C',0);
        $pdf->cell(35, 6, 'Product ID',0,0,'C',0);
        $pdf->cell(20, 6, ' No',0,0,'C',0);
        $pdf->cell(20, 6, ' No',0,0,'C',0);
        $pdf->cell(80, 6, ' Right Jaw (TBA and TPA)/ Side 1 Jaw (TCA)/ ',1,0,'C',0);
        $pdf->cell(80, 6, ' Left Jaw (TBA and TPA)/ Side 2 Jaw (TCA)/ Track ',1,0,'C',0);
        $pdf->cell(10, 12, 'Dating',1,0,'C',0);
        $pdf->cell(10, 12, 'Form',1,0,'C',0);
        $pdf->cell(10, 12, 'Design',1,0,'C',0);
        $pdf->cell(15, 12, 'Over Lap',1,0,'C',0);


        $pdf->cell(20, 12, 'Upper',1,0,'C',0);
        $pdf->cell(20, 12, 'Bottom',1,0,'C',0);

        $pdf->cell(30, 6, ' ',0,0,'C',0);
		$pdf->cell(0.5, 6, ' ',0,0,'C',0);
      
        $pdf->Ln();
        $pdf->cell(10,6,'',0,0,'C',0);           
        $pdf->cell(20,6,'Time ',1,0,'C',0);       
        $pdf->cell(25,6,'Point',1,0,'C',0);
        $pdf->cell(35, 6, '/ Name',1,0,'C',0);
        $pdf->cell(20, 6, 'Palet',1,0,'C',0);
        $pdf->cell(20, 6, 'Carton',1,0,'C',0); 
        $pdf->cell(10, 6, '1',1,0,'C',0); 
        $pdf->cell(10, 6, '2',1,0,'C',0); 
        $pdf->cell(10, 6, '3',1,0,'C',0); 
        $pdf->cell(10, 6, '4',1,0,'C',0); 
        $pdf->cell(10, 6, '5',1,0,'C',0); 
        $pdf->cell(10, 6, '6',1,0,'C',0); 
        $pdf->cell(10, 6, '7',1,0,'C',0); 
        $pdf->cell(10, 6, '8',1,0,'C',0); 
        $pdf->cell(10, 6, '1',1,0,'C',0); 
        $pdf->cell(10, 6, '2',1,0,'C',0); 
        $pdf->cell(10, 6, '3',1,0,'C',0); 
        $pdf->cell(10, 6, '4',1,0,'C',0); 
        $pdf->cell(10, 6, '5',1,0,'C',0); 
        $pdf->cell(10, 6, '6',1,0,'C',0); 
        $pdf->cell(10, 6, '7',1,0,'C',0); 
        $pdf->cell(10, 6, '8',1,0,'C',0); 
        $pdf->cell(10, 6, '',0,0,'C',0);
        $pdf->cell(10, 6, '',0,0,'C',0);
        $pdf->cell(10, 6, '',0,0,'C',0);
        $pdf->cell(15, 6, '',0,0,'C',0);
        $pdf->cell(20, 6, '',0,0,'C',0);
        $pdf->cell(20, 6, '',0,0,'C',0);
        $pdf->cell(30, 6, '',0,0,'C',0);
		$pdf->cell(0.5, 6, ' ',0,0,'C',0);
        $pdf->Ln();
        $no=1;

		$dtdetail = $this->$model->get_detail_byid($id);
        if ($dtdetail){
        foreach($dtdetail as $row1){   
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');    
        $pdf->cell(20,6,$row1->sampling_time, 1,'L');
        $pdf->cell(25,6,$row1->sampling_point, 1,'L');
        $pdf->cell(35,6,$row1->product_id, 1,'L');
        $pdf->cell(20,6,$row1->no_pallet, 1,'L');
        $pdf->cell(20,6,$row1->no_carton, 1,'L');
        $pdf->cell(10,6,$row1->right_jaw1, 1,'L');
        $pdf->cell(10,6,$row1->right_jaw2, 1,'L');
        $pdf->cell(10,6,$row1->right_jaw3, 1,'L');
        $pdf->cell(10,6,$row1->right_jaw4, 1,'L');
        $pdf->cell(10,6,$row1->right_jaw5, 1,'L');
        $pdf->cell(10,6,$row1->right_jaw6, 1,'L');
        $pdf->cell(10,6,$row1->right_jaw7, 1,'L');    
        $pdf->cell(10,6,$row1->right_jaw8, 1,'L');
        $pdf->cell(10,6,$row1->left_jaw1, 1,'L');
        $pdf->cell(10,6,$row1->left_jaw2, 1,'L');
        $pdf->cell(10,6,$row1->left_jaw3, 1,'L');    
        $pdf->cell(10,6,$row1->left_jaw4, 1,'L');
        $pdf->cell(10,6,$row1->left_jaw5, 1,'L');
        $pdf->cell(10,6,$row1->left_jaw6, 1,'L');
        $pdf->cell(10,6,$row1->left_jaw7, 1,'L');
        $pdf->cell(10,6,$row1->left_jaw8, 1,'L');
        $pdf->cell(10,6,$row1->dating, 1,'L');
        $pdf->cell(10,6,$row1->form, 1,'L');
        $pdf->cell(10,6,$row1->design, 1,'L');
        $pdf->cell(15,6,$row1->overlap, 1,'L');
        $pdf->cell(20,6,$row1->upper, 1,'L');
        $pdf->cell(20,6,$row1->bottom, 1,'L');
        $pdf->cell(30,6,$row1->remarks, 1,'L');
		$pdf->cell(0.5, 6, ' ',0,0,'C',0);
        $pdf->Ln();
        $no++;
       }
   }
  $dtdetail1 = $this->$model->get_detail_byid($id);
  if(isset($dtdetail1)){
   foreach($dtdetail1 as $row1){
	$dt_rj1[] = $row1->right_jaw1;
	$dt_rj2[] = $row1->right_jaw2;
	$dt_rj3[] = $row1->right_jaw3;
	$dt_rj4[] = $row1->right_jaw4;
	$dt_rj5[] = $row1->right_jaw5;
	$dt_rj6[] = $row1->right_jaw6;
	$dt_rj7[] = $row1->right_jaw7;
	$dt_rj8[] = $row1->right_jaw8;
	$dt_lj1[] = $row1->left_jaw1;
	$dt_lj2[] = $row1->left_jaw2;
	$dt_lj3[] = $row1->left_jaw3;
	$dt_lj4[] = $row1->left_jaw4;
	$dt_lj5[] = $row1->left_jaw5;
	$dt_lj6[] = $row1->left_jaw6;
	$dt_lj7[] = $row1->left_jaw7;
	$dt_lj8[] = $row1->left_jaw8;
    $ndt_rj1 = array_diff($dt_rj1, array('',0));
    $ndt_rj2 = array_diff($dt_rj2, array('',0));
    $ndt_rj3 = array_diff($dt_rj3, array('',0));
    $ndt_rj4 = array_diff($dt_rj4, array('',0));
    $ndt_rj5 = array_diff($dt_rj5, array('',0));
    $ndt_rj6 = array_diff($dt_rj6, array('',0));
    $ndt_rj7 = array_diff($dt_rj7, array('',0));
    $ndt_rj8 = array_diff($dt_rj8, array('',0));
    $ndt_lj1 = array_diff($dt_lj1, array('',0));
    $ndt_lj2 = array_diff($dt_lj2, array('',0));
    $ndt_lj3 = array_diff($dt_lj3, array('',0));
    $ndt_lj4 = array_diff($dt_lj4, array('',0));
    $ndt_lj5 = array_diff($dt_lj5, array('',0));
    $ndt_lj6 = array_diff($dt_lj6, array('',0));
    $ndt_lj7 = array_diff($dt_lj7, array('',0));
    $ndt_lj8 = array_diff($dt_lj8, array('',0));
    if(is_array($ndt_rj1) && count ($ndt_rj1) > 0){$avg_dt_rj1=number_format((array_sum($ndt_rj1)) /(count($ndt_rj1)),2);$avg_vol_rj1=number_format(($avg_dt_rj1-$pack_kosong),2);}else{$avg_dt_rj1="";$avg_vol_rj1="";}
    if(is_array($ndt_rj2) && count ($ndt_rj2) > 0){$avg_dt_rj2=number_format((array_sum($ndt_rj2)) /(count($ndt_rj2)),2);$avg_vol_rj2=number_format(($avg_dt_rj2-$pack_kosong),2);}else{$avg_dt_rj2="";$avg_vol_rj2="";}
    if(is_array($ndt_rj3) && count ($ndt_rj3) > 0){$avg_dt_rj3=number_format((array_sum($ndt_rj3)) /(count($ndt_rj3)),2);$avg_vol_rj3=number_format(($avg_dt_rj3-$pack_kosong),2);}else{$avg_dt_rj3="";$avg_vol_rj3="";}
    if(is_array($ndt_rj4) && count ($ndt_rj4) > 0){$avg_dt_rj4=number_format((array_sum($ndt_rj4)) /(count($ndt_rj4)),2);$avg_vol_rj4=number_format(($avg_dt_rj4-$pack_kosong),2);}else{$avg_dt_rj4="";$avg_vol_rj4="";}
    if(is_array($ndt_rj5) && count ($ndt_rj5) > 0){$avg_dt_rj5=number_format((array_sum($ndt_rj5)) /(count($ndt_rj5)),2);$avg_vol_rj5=number_format(($avg_dt_rj5-$pack_kosong),2);}else{$avg_dt_rj5="";$avg_vol_rj5="";}
    if(is_array($ndt_rj6) && count ($ndt_rj6) > 0){$avg_dt_rj6=number_format((array_sum($ndt_rj6)) /(count($ndt_rj6)),2);$avg_vol_rj6=number_format(($avg_dt_rj6-$pack_kosong),2);}else{$avg_dt_rj6="";$avg_vol_rj6="";}
    if(is_array($ndt_rj7) && count ($ndt_rj7) > 0){$avg_dt_rj7=number_format((array_sum($ndt_rj7)) /(count($ndt_rj7)),2);$avg_vol_rj7=number_format(($avg_dt_rj7-$pack_kosong),2);}else{$avg_dt_rj7="";$avg_vol_rj7="";}
    if(is_array($ndt_rj8) && count ($ndt_rj8) > 0){$avg_dt_rj8=number_format((array_sum($ndt_rj8)) /(count($ndt_rj8)),2);$avg_vol_rj8=number_format(($avg_dt_rj8-$pack_kosong),2);}else{$avg_dt_rj8="";$avg_vol_rj8="";}
    if(is_array($ndt_lj1) && count ($ndt_lj1) > 0){$avg_dt_lj1=number_format((array_sum($ndt_lj1)) /(count($ndt_lj1)),2);$avg_vol_lj1=number_format(($avg_dt_lj1-$pack_kosong),2);}else{$avg_dt_lj1="";$avg_vol_lj1="";}
    if(is_array($ndt_lj2) && count ($ndt_lj2) > 0){$avg_dt_lj2=number_format((array_sum($ndt_lj2)) /(count($ndt_lj2)),2);$avg_vol_lj2=number_format(($avg_dt_lj2-$pack_kosong),2);}else{$avg_dt_lj2="";$avg_vol_lj2="";}
    if(is_array($ndt_lj3) && count ($ndt_lj3) > 0){$avg_dt_lj3=number_format((array_sum($ndt_lj3)) /(count($ndt_lj3)),2);$avg_vol_lj3=number_format(($avg_dt_lj3-$pack_kosong),2);}else{$avg_dt_lj3="";$avg_vol_lj3="";}
    if(is_array($ndt_lj4) && count ($ndt_lj4) > 0){$avg_dt_lj4=number_format((array_sum($ndt_lj4)) /(count($ndt_lj4)),2);$avg_vol_lj4=number_format(($avg_dt_lj4-$pack_kosong),2);}else{$avg_dt_lj4="";$avg_vol_lj4="";}
    if(is_array($ndt_lj5) && count ($ndt_lj5) > 0){$avg_dt_lj5=number_format((array_sum($ndt_lj5)) /(count($ndt_lj5)),2);$avg_vol_lj5=number_format(($avg_dt_lj5-$pack_kosong),2);}else{$avg_dt_lj5="";$avg_vol_lj5="";}
    if(is_array($ndt_lj6) && count ($ndt_lj6) > 0){$avg_dt_lj6=number_format((array_sum($ndt_lj6)) /(count($ndt_lj6)),2);$avg_vol_lj6=number_format(($avg_dt_lj6-$pack_kosong),2);}else{$avg_dt_lj6="";$avg_vol_lj6="";}
    if(is_array($ndt_lj7) && count ($ndt_lj7) > 0){$avg_dt_lj7=number_format((array_sum($ndt_lj7)) /(count($ndt_lj7)),2);$avg_vol_lj7=number_format(($avg_dt_lj7-$pack_kosong),2);}else{$avg_dt_lj7="";$avg_vol_lj7="";}
    if(is_array($ndt_lj8) && count ($ndt_lj8) > 0){$avg_dt_lj8=number_format((array_sum($ndt_lj8)) /(count($ndt_lj8)),2);$avg_vol_lj8=number_format(($avg_dt_lj8-$pack_kosong),2);}else{$avg_dt_lj8="";$avg_vol_lj8="";}
}

$pdf->SetFont('Arial','B',8);
$pdf->cell(130,6,'Average Weight/ Pack (g):',1,0,'C',0);
$pdf->cell(10,6,''.$avg_dt_rj1.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_rj2.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_rj3.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_rj4.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_rj5.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_rj6.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_rj7.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_rj8.'',1,0,'L',0);
//2
$pdf->cell(10,6,''.$avg_dt_lj1.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_lj2.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_lj3.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_lj4.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_lj5.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_lj6.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_lj7.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_dt_lj8.'',1,0,'L',0);
$pdf->cell(115,6,'',1,0,'L',0);

$pdf->Ln();

$pdf->SetFont('Arial','B',8);
$pdf->cell(130,6,'Average Volume/ Pack (ml):',1,0,'C',0);
$pdf->cell(10,6,''.$avg_vol_rj1.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_rj2.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_rj3.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_rj4.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_rj5.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_rj6.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_rj7.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_rj8.'',1,0,'L',0);
//2
$pdf->cell(10,6,''.$avg_vol_lj1.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_lj2.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_lj3.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_lj4.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_lj5.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_lj6.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_lj7.'',1,0,'L',0);
$pdf->cell(10,6,''.$avg_vol_lj8.'',1,0,'L',0);
$pdf->cell(115,6,'',1,0,'L',0);
$pdf->Ln();

$dtheader2=$this->$model->get_header_byid($id);  
if ($dtheader2) {   
foreach($dtheader2 as $dthdr2){
$qty_produced=$dthdr2->qty_produced;
$qty_taken=$dthdr2->qty_taken;
}

$pdf->SetFont('Arial','B',8);
$pdf->cell(130,6,'Quantity Produced',1,0,'C',0);
$pdf->cell(275,6,''.$qty_produced.'',1,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',8);
$pdf->cell(130,6,'Total Quantity of QA Samples Taken',1,0,'C',0);
$pdf->cell(275,6,''.$qty_taken.'',1,0,'L',0);
$pdf->Ln();
}
$pdf->SetFont('Arial','B',10); 
$pdf->cell(130,6,'Dating Check(Individual and Carton Box)',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',7); 
$pdf->cell(150,6,'Format Date Schedule',1,0,'C',0);
$pdf->cell(150,6,'Format Date Actual',1,0,'C',0);
$pdf->cell(35,6,'Reported By',1,0,'C',0);
$pdf->cell(35,6,'Checked BY',1,0,'C',0);
$pdf->cell(35,6,'Remarks',1,0,'C',0);
$pdf->Ln();


$dtdetail2 = $this->$model->get_detailB_byid($id);
if(!empty($dtdetail2)){
foreach($dtdetail2 as $dtdetailrow2){
$fd_schedule=$dtdetailrow2->fd_schedule;
$fd_actual=$dtdetailrow2->fd_actual;
$reportedby=$dtdetailrow2->reportedby;
$checkedby=$dtdetailrow2->checkedby;
$remark=$dtdetailrow2->remark;
}	
$pdf->cell(150,18,''.$fd_schedule.'',1,0,'C',0);
$pdf->cell(150,18,''.$fd_actual.'',1,0,'C',0);
$pdf->cell(35,18,''.$reportedby.'',1,0,'C',0);
$pdf->cell(35,18,''.$checkedby.'',1,0,'C',0);
$pdf->cell(35,18,''.$remark.'',1,0,'C',0);
$pdf->Ln();
}


$pdf->SetFont('Arial','B',10); 
$pdf->cell(130,6,'Non-confirmance Record',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',7);
$pdf->cell(40,6,'Time',1,0,'C',0); 
$pdf->cell(150,6,'Non-conformance',1,0,'C',0);
$pdf->cell(150,6,'Corrective Action',1,0,'C',0);
$pdf->cell(65,6,'Action By',1,0,'C',0);
$pdf->Ln();

$pdf->cell(130,6,'Remarks:',0,0,'L',0);
$pdf->Ln();
$pdf->cell(330,6,'Frequency Sampling refer to Pedoman Kerja Sampling Monitoring (GST-FSS-026):',0,0,'L',0);
$pdf->Ln();
      foreach($dtfrm as $dt_form){  
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
        }
        $pdf->SetFont('Arial','',8);
        $pdf->cell(365,6,'Mulai Berlaku : '.$frmefec.'',1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');
		}	
        }else{}
        break;		
		
		
		case $frmkode=="frmfss096":
           if($filekd=="export"){
        $pdf->AddPage('L','A3');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
         //$pdf->SetFillColor(230,230,230,230); 
         $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30, 25, $a,1,0,'C',0);
        $dtheader1=$this->$model->get_header_byid($id);
        
         
        $pdf->cell(340, 25, $title, 1,0,'C',0);
        $pdf->SetFont('Arial','',10);
    
        foreach($dtheader1 as $dthdr1){
        $dtdoc=$dthdr1->dtdoc;
        $pdf->cell(30, 25, 'Dok :'.$dtdoc.'',1,0,'L',0);
        }
                   
        $pdf->Ln();
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
        
        $pdf->cell(340,6, $frmjdl, 1,0,'C',0);
        
        foreach($dtheader1 as $dthdr1){
        $dtdate=$dthdr1->dtdate;
        $pdf->cell(30, 6, 'Tgl:'.$dtdate.'', 1,0,'L',0);
        }
        $pdf->Ln();
		
		
		

      
        $pdf->cell(10,6,'No.',1,0,'C',0);         
        $pdf->cell(200,6,'Sampling Detail',1,0,'C',0); 
		$pdf->cell(150,6,'Monitoring Check/ Visual Inspection',1,0,'C',0);
		$pdf->cell(40,6,'Remarks',1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(10,6,'',1,0,'C',0);
        $pdf->cell(50,6,'Sampling Time',1,0,'C',0); 
        $pdf->cell(50,6,'Sampling Code',1,0,'C',0);
        $pdf->cell(50,6,'Product Code',1,0,'C',0);
        $pdf->cell(50,6,'Product ID/Name',1,0,'C',0);
        $pdf->cell(30,6,'Lot Number (if any)',1,0,'C',0);
        $pdf->cell(30,6,'Weight',1,0,'C',0);
        $pdf->cell(30,6,'Coding',1,0,'C',0);
        $pdf->cell(30,6,'Spout Seal/cap',1,0,'C',0); 
		$pdf->cell(30,6,'bag Seal',1,0,'C',0);		
		$pdf->cell(40,6,'',1,0,'C',0);
        $pdf->Ln();

        $no=0;
        foreach ($datadtl as $row1){    
        $pdf->SetFont('Arial','',10);
        $pdf->cell(10,6,$no, 1,'L');
        $pdf->cell(50,6,$row1->sampling_time, 1,'L');
        $pdf->cell(50,6,$row1->sample_code, 1,'L');
        $pdf->cell(50,6,$row1->product_code, 1,'L');
        $pdf->cell(50,6,$row1->product_id, 1,'L');
        $pdf->cell(30,6,$row1->lot_number, 1,'L');
        $pdf->cell(30,6,$row1->weight, 1,'L');
        $pdf->cell(30,6,$row1->coding, 1,'L');
        $pdf->cell(30,6,$row1->spout, 1,'L');
        $pdf->cell(30,6,$row1->bag_seal, 1,'L');
        $pdf->cell(40,6,$row1->remarks, 1,'L');
    
        $pdf->Ln();
        $no++;   
        }


         if (empty($datadtl)){}else{
        foreach($datadtl as $row1){ 
        $avg_gross=$row1->avg_gross;
        $avg_net_empty=$row1->avg_net_empty;
        $avg_net=$row1->avg_net;   
    }
        $pdf->SetFont('Arial','B',8);
        $pdf->cell(240,6,'Average Gross Weight:',1,0,'C',0);
        $pdf->cell(30,6,''.$avg_gross.'',1,0,'L',0);
        $pdf->cell(130,6,'Kg/Bag Product',1,0,'C',0);


        $pdf->Ln();
        $pdf->cell(240,6,'Average Net Weight:',1,0,'C',0);
        $pdf->cell(30,6,''.$avg_net_empty.'',1,0,'L',0);
        $pdf->cell(130,6,'Kg/Bag (Empty)',1,0,'C',0);


        $pdf->Ln();
        $pdf->cell(240,6,'Average Net Weight:',1,0,'C',0);
        $pdf->cell(30,6,''.$avg_net.'',1,0,'L',0);
        $pdf->cell(130,6,'Kg/Bag Product',1,0,'C',0);
    }
        $pdf->Ln();
         foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
        $pdf->SetFont('Arial','',8);
        $pdf->cell(370,6,'Mulai Berlaku:'.$frmefec.'',1,0,'L',0);
        $pdf->cell(30,6, $frmnm, 1,0,'R',0); 



        $pdf->Ln();
        $pdf->Ln();
        $pdf->cell(240,6,'Non-Confirmance Record:',0,0,'L',0);
        $pdf->Ln();
        $pdf->cell(60,6,' Time',1,0,'C',0); 
        $pdf->cell(150,6,' Non-Conformance',1,0,'C',0); 
        $pdf->cell(140,6,' Corrective Action',1,0,'C',0); 
        $pdf->cell(50,6,' Action By',1,0,'C',0); 
        $pdf->Ln();
        $pdf->Ln();

        $pdf->cell(400,6,'Remarks:',0,0,'L',0);
        $pdf->Ln();
        $pdf->cell(400,6,'Frequency Sampling refer to Pedoman Kerja Sampling Monitoring (GST-FSS-026)',0,0,'L',0);
        $pdf->Ln();

     
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),410,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');

        }else{}
        break;





      case $frmkode=="frmnon004":
		   if($filekd=="export"){
		$pdf->AddPage('L','A4');
		$logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";	    
		$a=$pdf->Image($logor,10,10,30,25);
		$dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
		 //$pdf->SetFillColor(230,230,230,230); 
		 $pdf->SetFillColor(110,180,230);
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30, 25, $a,1,0,'C',0);
		$dtheader1=$this->$model->get_header_byid($id);
		
		 
		$pdf->cell(219, 25, $title, 1,0,'C',0);
		$pdf->SetFont('Arial','',10);
	
		foreach($dtheader1 as $dthdr1){
		$tgl_dok=$dthdr1->tgl_dok;
		$pdf->cell(30, 25, 'Tgl :'.$tgl_dok.'',1,0,'L',0);
		}
			
		
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30,6, 'JUDUL',1,0,'C',0);
		
		$pdf->cell(219,6, $frmjdl, 1,0,'C',0);
		
		foreach($dtheader1 as $dthdr1){
		$dokumen=$dthdr1->dokumen;
		$pdf->cell(30, 6, 'Dok:'.$dokumen.'', 1,0,'L',0);
		}
		$pdf->Ln();

      
        $pdf->cell(10,6,'No.',1,0,'C',0);         
        $pdf->cell(35,6,'Tgl Sampling',1,0,'C',0);      
        $pdf->cell(50,6,'kode_sample',1,0,'C',0); 
        $pdf->cell(15,6,'ph',1,0,'C',0);
        $pdf->cell(20,6,'tss',1,0,'C',0);
        $pdf->cell(25,6,'postpat',1,0,'C',0);
        $pdf->cell(12,6,'cod',1,0,'C',0);
        $pdf->cell(12,6,'bod',1,0,'C',0);
        $pdf->cell(50,6,'minyak_lemak',1,0,'C',0);
        $pdf->cell(50,6,'colour_visual',1,0,'C',0);        
        $pdf->Ln();

        $no=0;
        foreach ($datadtl as $row1){    

        $no++;  
        $pdf->SetFont('Arial','',10);
        $pdf->cell(10,6,$no, 1,'L');
        $pdf->cell(35,6,$row1->tgl_sampling, 1,'L');
        $pdf->cell(50,6,$row1->kode_sample, 1,'L');
        $pdf->cell(15,6,$row1->ph, 1,'L');
        $pdf->cell(20,6,$row1->tss, 1,'L');
        $pdf->cell(25,6,$row1->pospat, 1,'L');
        $pdf->cell(12,6,$row1->cod, 1,'L');
        $pdf->cell(12,6,$row1->bod, 1,'L');
        $pdf->cell(50,6,$row1->minyak_lemak, 1,'L');
        $pdf->cell(50,6,$row1->colour_visual, 1,'L');
    
       $pdf->Ln();
        $no++;   
        }
      foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
		$pdf->SetFont('Arial','',8);
		$pdf->cell(249,6,'Mulai Berlaku:'.$frmefec.'',1,0,'L',0);
        $pdf->cell(30,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),285,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
		$pdf->Output($frmkode.'.pdf','I');

        }else{}
		break;
		
      case $frmkode=="frmnon003":
        if($filekd=="export") {
		$pdf->AddPage('L','A3');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
         //$pdf->SetFillColor(230,230,230,230); 
         $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30, 25, $a,1,0,'C',0);
        $dtheader1=$this->$model->get_header_byid($id);
        
         
        $pdf->cell(330, 25, $title, 1,0,'C',0);
        $pdf->SetFont('Arial','',10);
    
        foreach($dtheader1 as $dthdr1){
        $tgl_dok=$dthdr1->tgl_dok;
        $pdf->cell(40, 25, 'Tgl :'.$tgl_dok.'',1,0,'L',0);
        }
       // $pdf->cell(0.5, 6, ' ',0,0,'C',0);    
        
        $pdf->Ln();
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
        
        $pdf->cell(330,6, $frmjdl, 1,0,'C',0);
        
        foreach($dtheader1 as $dthdr1){
        $dokumen=$dthdr1->dokumen;
        $pdf->cell(40, 6, 'Dok:'.$dokumen.'', 1,0,'L',0);
        }
      //  $pdf->cell(0.5, 6, ' ',0,0,'C',0);
        $pdf->Ln();
        
		$pdf->SetFont('Arial','',8);
        $pdf->cell(10,18,'No.',1,0,'C',0);  
        $pdf->cell(30,18,'Kode Sample',1,0,'C',0);
        $pdf->cell(30,18,'Tgl Analisa',1,0,'C',0);
        $pdf->cell(250,6,'Parameters Analysis',1,0,'C',0);
		$pdf->cell(40,18,'Colour',1,0,'C',0);
		$pdf->cell(40,18,'Dianalisa',1,0,'C',0);
        $pdf->cell(0.5, 6, ' ',0,0,'C',0);
		$pdf->Ln();
		
		$pdf->cell(10,6,'',0,0,'C',0);  
        $pdf->cell(30,6,'',0,0,'C',0);
        $pdf->cell(30,6,'',0,0,'C',0);
		
        $pdf->cell(15,12,'pH',1,0,'C',0);       
        $pdf->cell(15,12,'TSS',1,0,'C',0);
        $pdf->cell(15,12,'PO4',1,0,'C',0);  
		$pdf->cell(15,12,'COD',1,0,'C',0);       
        $pdf->cell(75,6,'BOD',1,0,'C',0);
        $pdf->cell(115,6,'Minyak dan Lemak',1,0,'C',0);  
		
		$pdf->cell(40,6,'',0,0,'C',0);
		$pdf->cell(40,6,'',0,0,'C',0);
        $pdf->cell(0.5, 6, ' ',0,0,'C',0);
		$pdf->Ln();

		$pdf->cell(10,6,'',0,0,'C',0);  
        $pdf->cell(30,6,'',0,0,'C',0);
        $pdf->cell(30,6,'',0,0,'C',0);


        $pdf->cell(15,6,'',0,0,'C',0);
        $pdf->cell(15,6,'',0,0,'C',0);  
		$pdf->cell(15,6,'',0,0,'C',0);  
		
        $pdf->cell(15,6,'',0,0,'C',0);
		

		$pdf->cell(15,6,'1Hari',1,0,'C',0);		
		$pdf->cell(15,6,'2Hari',1,0,'C',0);
		$pdf->cell(15,6,'3Hari',1,0,'C',0);
		$pdf->cell(15,6,'4Hari',1,0,'C',0);
		$pdf->cell(15,6,'5Hari',1,0,'C',0);
		
		$pdf->cell(30,6,'Kode Bottom',1,0,'C',0);
		$pdf->cell(30,6,'Bottom KOsong',1,0,'C',0);
        $pdf->cell(30,6,'Bottom Ekstrak',1,0,'C',0);
        $pdf->cell(25,6,'Hasil',1,0,'C',0);

        $pdf->cell(40,6,'',0,0,'C',0);
        $pdf->cell(40,6,'',0,0,'C',0);
		
		$pdf->cell(0.5, 6, ' ',0,0,'C',0);
        $pdf->Ln();
        $no=1;
		
        foreach ($datadtl as $row1){    
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no,1,'L'); 
		$pdf->cell(30,6,$row1->kode_sample,1,'L'); 
        $pdf->cell(30,6,$row1->tgl_analisa,1,'L');  
                  
        $pdf->cell(15,6,$row1->ph,1,'L');     
        $pdf->cell(15,6,$row1->tss,1,'L');
		$pdf->cell(15,6,$row1->po4,1,'L');
        $pdf->cell(15,6,$row1->cod,1,'L');
        $pdf->cell(15,6,$row1->hari1,1,'L');
        $pdf->cell(15,6,$row1->hari2,1,'L');
        $pdf->cell(15,6,$row1->hari3,1,'L');
        $pdf->cell(15,6,$row1->hari4,1,'L');
        $pdf->cell(15,6,$row1->hari5,1,'L');
        $pdf->cell(30,6,$row1->kode_bottom,1,'L');
        $pdf->cell(30,6,$row1->bottom_kosong,1,'L');
        $pdf->cell(30,6,$row1->bottom_ekstrak,1,'L');
        $pdf->cell(25,6,$row1->hasil_bottom,1,'L');
        $pdf->cell(40,6,$row1->color,1,'L');
        $pdf->cell(40,6,$row1->dilakukan_oleh,1,'L');
        $pdf->cell(0.5, 6, ' ',0,0,'C',0);
	
        $pdf->Ln();
        $no++;   
        }
      foreach($dtfrm as $dt_form){
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
       }

        $pdf->SetFont('Arial','',8);
        $pdf->cell(360,6,'Mulai Berlaku : ' .$frmefec,1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');

        }else{}
		break;

        case $frmkode=="frmlqs039":
        if($filekd=="export") {
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";
        $pdf->AddPage('L','A3');
        $pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);

        $pdf->cell(30);
        $pdf->setFont('Arial','B',14);        
        $pdf->cell(0,10,$title,0,1,'L');
        $pdf->cell(30);
        $pdf->setFont('Arial','B',12);  
        $pdf->Cell(0, 10, $frmjdl, 0, 1, 'L');
        $pdf->cell(30);     
        $pdf->cell(0,3,$dates,0,1,'L');        
        $pdf->cell(30);
        $pdf->setFont('Arial','B',12); 
        $pdf->cell(0,2," ",0,2,'L');       
        $pdf->SetLineWidth(1);
        $pdf->Line(10,36,415,36);
        $pdf->SetLineWidth(0);
        $pdf->Line(10,36,415,36);
        $pdf->Ln(4); 
        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',8);

        $pdf->cell(5,6,'No.',1,0,'C',1);  
        $pdf->cell(25,6,'tgl_produksi',1,0,'C',1);   
        $pdf->cell(25,6,'jenis_contoh',1,0,'C',1);       
        $pdf->cell(30,6,'jenis_produk',1,0,'C',1);       
        $pdf->cell(20,6,'completedate',1,0,'C',1);     
        $pdf->cell(20,6,'completetime',1,0,'C',1);
        $pdf->cell(20,6,'completeby',1,0,'C',1);
        $pdf->cell(20,6,'kode_sample',1,0,'C',1);
        $pdf->cell(10,6,'no_lab',1,0,'C',1);
        $pdf->cell(25,6,'tgl_analisa',1,0,'C',1);
        $pdf->cell(20,6,'jam_analisa',1,0,'C',1);
        $pdf->cell(20,6,'analisa_oleh',1,0,'C',1);
        $pdf->cell(15,6,'htpc_0',1,0,'C',1);
        $pdf->cell(15,6,'hec_0',1,0,'C',1);
        $pdf->cell(15,6,'hyeast_0',1,0,'C',1);
        $pdf->cell(15,6,'hmould_0',1,0,'C',1);
        $pdf->cell(15,6,'htsc_35_c',1,0,'C',1);
        $pdf->cell(15,6,'httr_35_c',1,0,'C',1);
        $pdf->cell(15,6,'httr_55_c',1,0,'C',1);
        $pdf->cell(20,6,'hdetect_egas',1,0,'C',1);       
        $pdf->cell(20,6,'hdetect_eindol',1,0,'C',1);    
        $pdf->cell(20,6,'hdetect_sal',1,0,'C',1);     
        $pdf->Ln();
        $no=1;

        foreach ($datadtl as $row1){    
        $pdf->SetFont('Arial','',8);
        $pdf->cell(5,6,$no,1,'L');  
        $pdf->cell(25,6,$row1->tgl_produksi,1,'L');   
        $pdf->cell(25,6,$row1->jenis_contoh,1,'L');       
        $pdf->cell(30,6,$row1->jenis_produk,1,'L');       
        $pdf->cell(20,6,$row1->completedate,1,'L');     
        $pdf->cell(20,6,$row1->completetime,1,'L');
        $pdf->cell(20,6,$row1->completeby,1,'L');
        $pdf->cell(20,6,$row1->kode_sample,1,'L');
        $pdf->cell(10,6,$row1->no_lab,1,'L');
        $pdf->cell(25,6,$row1->tgl_analisa,1,'L');
        $pdf->cell(20,6,$row1->jam_analisa,1,'L');
        $pdf->cell(20,6,$row1->analisa_oleh,1,'L');
        $pdf->cell(15,6,$row1->ham_tpc_0,1,'L');
        $pdf->cell(15,6,$row1->ham_ec_0,1,'L');
        $pdf->cell(15,6,$row1->ham_yeast_0,1,'L');
        $pdf->cell(15,6,$row1->ham_mould_0,1,'L');
        $pdf->cell(15,6,$row1->ham_tsc_35_celcius,1,'L');
        $pdf->cell(15,6,$row1->ham_ttr_35_celcius,1,'L');
        $pdf->cell(15,6,$row1->ham_ttr_55_celcius,1,'L');
        $pdf->cell(20,6,$row1->ham_detect_ecoll_gas,1,'L');  
        $pdf->cell(20,6,$row1->ham_detect_ecoll_indol,1,'L');
        $pdf->cell(20,6,$row1->ham_detect_salmonella_he,1,'L');  


    
        $pdf->Ln();
        $no++;   
        }
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');

        }else{}
        break;
      
       case $frmkode=="frmlqs038":
         if($filekd=="export"){
		$pdf->AddPage('L','A3');
		$logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";	    
		$pdf->Image($logor,10,10,30,25);
		$dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
		

         $pdf->cell(30);
        $pdf->setFont('Arial','B',14);        
        $pdf->cell(0,10,$title,0,1,'L');
        $pdf->cell(30);
        $pdf->setFont('Arial','B',12);  
        $pdf->Cell(0, 10, $frmjdl, 0, 1, 'L');
        $pdf->cell(30);     
        $pdf->cell(0,3,$dates,0,1,'L');        
        $pdf->cell(30);
        $pdf->setFont('Arial','B',12); 
        $pdf->cell(0,2," ",0,2,'L');       
        $pdf->SetLineWidth(1);
        $pdf->Line(10,36,415,36);
        $pdf->SetLineWidth(0);
        $pdf->Line(10,36,415,36);
        $pdf->Ln(4); 
        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
       
      
        $pdf->cell(9,6,'No.',1,0,'C',1); 
        $pdf->cell(25,6,'tgl_produksi',1,0,'C',1); 
	    $pdf->cell(25,6,'tgl_analisa',1,0,'C',1);             
        $pdf->cell(25,6,'jam_sampling',1,0,'C',1);       
        $pdf->cell(30,6,'jenis_contoh',1,0,'C',1);
        $pdf->cell(35,6,'jenis_produk',1,0,'C',1);
        $pdf->cell(25,6,'completedate',1,0,'C',1);
        $pdf->cell(25,6,'completetime',1,0,'C',1);
		
        $pdf->cell(20,6,'completeby',1,0,'C',1);     
        $pdf->cell(12,6,'no_lab',1,0,'C',1);
		
        $pdf->cell(28,6,'kode_sample',1,0,'C',1);  
        $pdf->cell(13,6,'h.tpc1',1,0,'C',1);    
		
        $pdf->cell(13,6,'h.tpc2',1,0,'C',1);    
        $pdf->cell(13,6,'h.ec1',1,0,'C',1); 
		
		
        $pdf->cell(13,6,'h.ec2',1,0,'C',1); 
        $pdf->cell(13,6,'h.cf1',1,0,'C',1); 
        $pdf->cell(13,6,'h.cf2',1,0,'C',1);      
        $pdf->cell(10,6,'h.gas',1,0,'C',1); 
		
		$pdf->cell(10,6,'h.indol',1,0,'C',1); 
		$pdf->cell(15,6,'h.mould1',1,0,'C',1); 
		$pdf->cell(15,6,'h.mould2',1,0,'C',1); 
		// $pdf->cell(15,6,'Ket',1,0,'C',1); 
		$pdf->cell(20,6,'ket',1,0,'C',1); 
	
        $pdf->Ln();

        $no=1;
      
        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','',10);
        $pdf->cell(9,6,$no, 1,'L');     
		$pdf->cell(25,6,$row1->tgl_produksi, 1,'L');
        $pdf->cell(25,6,$row1->tgl_analisa, 1,'L');
        $pdf->cell(25,6,$row1->jam_sampling, 1,'L');
        $pdf->cell(30,6,$row1->jenis_contoh, 1,'L');
        $pdf->cell(35,6,$row1->jenis_produk, 1,'L');
        $pdf->cell(25,6,$row1->completedate, 1,'L');
        $pdf->cell(25,6,$row1->completetime, 1,'L');
		
        $pdf->cell(20,6,$row1->completeby, 1,'L');
		$pdf->cell(12,6,$row1->no_lab, 1,'L');
        $pdf->cell(28,6,$row1->kode_sample, 1,'L');
		
		
        //$pdf->cell(15,6,$row1->dibuat_oleh, 1,'L');
        $pdf->cell(13,6,$row1->ha_tpc_1, 1,'L');
      
        $pdf->cell(13,6,$row1->ha_tpc_2, 1,'L');
		
        $pdf->cell(13,6,$row1->ha_ec_1, 1,'L');
        $pdf->cell(13,6,$row1->ha_ec_2, 1,'L');
        
        $pdf->cell(13,6,$row1->ha_cf_1, 1,'L');
        $pdf->cell(13,6,$row1->ha_cf_2, 1,'L');
        $pdf->cell(10,6,$row1->ha_detect_ecoli_gas, 1,'L');    
       	$pdf->cell(10,6,$row1->ha_detect_ecoli_indol, 1,'L');
		$pdf->cell(15,6,$row1->ha_mould_1, 1,'L');
	    $pdf->cell(15,6,$row1->ha_mould_2, 1,'L');
		$pdf->cell(20,6,$row1->keterangan, 1,'L');
			
       
        $pdf->Ln();
        $no++;   
        }
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
		$pdf->Output($frmkode.'.pdf','I');	
        }else{}
      break;
      
       case $frmkode=="intqad080":
         if($filekd=="export"){
		$pdf->AddPage('L','A3');
		$logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";	    
		$a=$pdf->Image($logor,10,10,30,25);
		$dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
		 //$pdf->SetFillColor(230,230,230,230); 
		 $pdf->SetFillColor(110,180,230);
		$pdf->SetFont('Arial','',8);
		$pdf->cell(30, 25, $a,1,0,'C',0);
		$dtheader1=$this->$model->get_header_byid($id);
		
		 
		$pdf->cell(330, 25, $title, 1,0,'C',0);
		 $pdf->SetFont('Arial','',10);
		
		
	
		foreach($dtheader1 as $dthdr1){
		$dttahun=$dthdr1->dttahun;
		$pdf->cell(40, 25, 'Tahun :'.$dttahun.'',1,0,'L',0);
		}
			
		
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30,6, 'JUDUL',1,0,'C',0);
		
		$pdf->cell(330,6, $frmjdl, 1,0,'C',0);
		
		foreach($dtheader1 as $dthdr1){
		$dtbulan=$dthdr1->dtbulan;
		$pdf->cell(40, 6, 'Bulan:'.$dtbulan.'', 1,0,'L',0);
		}
		$pdf->Ln();
		foreach($dtheader1 as $dthdr1){
		$id_larutan=$dthdr1->id_larutan;
		$pdf->cell(400,10, 'Nama Larutan:'.$id_larutan.'',1,0,'L',0);
		}
		
		
		$pdf->Ln();
	

        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
       
      
        $pdf->cell(10,6,'No.',1,0,'C',0);           
        $pdf->cell(115,6,'PEMBUATAN LARUTAN ',1,0,'C',0);       
        $pdf->cell(245,6,'SATANDARISASI LARUATAN',1,0,'C',0);
		$pdf->cell(30, 6, 'Keterangan',1,0,'C',0);
		$pdf->Ln();
		
		$pdf->SetFont('Arial','',8);
		$pdf->cell(10,6,'',1,0,'C',0);  
		
		$pdf->cell(25,6,'Tanggal ',1,0,'C',0);       
        $pdf->cell(25,6,'Berat Jumlah',1,0,'C',0);
		$pdf->cell(25, 6,'Volume Air',1,0,'C',0);
		$pdf->cell(20, 6,'Expired',1,0,'C',0);
		$pdf->cell(20, 6,'Dibuat ',1,0,'C',0);
		
		
		
		$pdf->cell(60,6,'Tanggal ',1,0,'C',0); 
		
		$pdf->cell(65,6,'Bahan Penguji ',1,0,'C',0);   
		$pdf->cell(30,6,'Volume Jumlah ',1,0,'C',0);   
		$pdf->cell(30,6,'Volume Titrasi ',1,0,'C',0);  
        $pdf->cell(30,6,'Hasil ',1,0,'C',0);   
        $pdf->cell(30,6,'Paraf ',1,0,'C',0);   
		$pdf->cell(30, 6, '',1,0,'C',0);  
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);
		$pdf->cell(10,6,'',1,0,'C',0);  
		
		$pdf->cell(25,6,' ',1,0,'C',0);       
        $pdf->cell(25,6,'(gr atau mL)',1,0,'C',0);
		$pdf->cell(25, 6,'Destilasi(mL)',1,0,'C',0);
		$pdf->cell(20, 6,'Date',1,0,'C',0);
		$pdf->cell(20, 6,'Oleh',1,0,'C',0);
		
		
		$pdf->cell(30,6,'Start ',1,0,'C',0);  
        $pdf->cell(30,6,'Finish ',1,0,'C',0); 		
		$pdf->cell(65,6,'Nama Bahan ',1,0,'C',0);   
		$pdf->cell(10,6,'gr ',1,0,'C',0); 
		$pdf->cell(10,6,'mL ',1,0,'C',0);
		$pdf->cell(10,6,'M ',1,0,'C',0);
		
		$pdf->cell(30,6,'(mL) ',1,0,'C',0);  
        $pdf->cell(30,6,'Normalitas ',1,0,'C',0);   
        $pdf->cell(30,6,'Oleh ',1,0,'C',0);   
		$pdf->cell(30, 6, '',1,0,'C',0);  
	
		
        $pdf->Ln();

        $no=1;
      
        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');    
        $pdf->cell(25,6,$row1->tgl_pembuatan, 1,'L');
		$pdf->cell(25,6,$row1->berat_jumlah, 1,'L');
        $pdf->cell(25,6,$row1->vol_air_destilasi, 1,'L');
	    $pdf->cell(20,6,$row1->expired_date, 1,'L');
		$pdf->cell(20,6,$row1->dibuat_oleh, 1,'L');
        $pdf->cell(30,6,$row1->tgl_start, 1,'L');
        $pdf->cell(30,6,$row1->tgl_finish, 1,'L');
     
        $pdf->cell(65,6,$row1->bahan_penguji, 1,'L');
        $pdf->cell(10,6,$row1->jml_gram, 1,'L');
        
        $pdf->cell(10,6,$row1->jml_ml, 1,'L');
        $pdf->cell(10,6,$row1->jml_m, 1,'L');
        $pdf->cell(30,6,$row1->vol_titrasi_ml, 1,'L');    
       	$pdf->cell(30,6,$row1->hasil_m, 1,'L');
		$pdf->cell(30,6,$row1->dilakukan_oleh, 1,'L');
		$pdf->cell(30,6,$row1->keterangan, 1,'L');
		
			
       
        $pdf->Ln();
        $no++;   
        }
      foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
		$pdf->SetFont('Arial','',8);
		$pdf->cell(360,6,'Mulai Berlaku:'.$frmefec.'',1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
		$pdf->Output($frmkode.'.pdf','I');

        }else{}
		break;
		
		
	 case $frmkode=="frmnon008":
         if($filekd=="export"){
		$pdf->AddPage('L','A3');
		$logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";	    
		$a=$pdf->Image($logor,10,10,30,25);
		$dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
		 //$pdf->SetFillColor(230,230,230,230); 
		 $pdf->SetFillColor(110,180,230);
		$pdf->SetFont('Arial','',8);
		$pdf->cell(30, 25, $a,1,0,'C',0);
		$dtheader1=$this->$model->get_header_byid($id);
		
		 
		$pdf->cell(330, 25, $title, 1,0,'C',0);
		 $pdf->SetFont('Arial','',10);
		
		
	
		foreach($dtheader1 as $dthdr1){
		$dttahun=$dthdr1->dttahun;
		$pdf->cell(40, 25, 'Tahun :'.$dttahun.'',1,0,'L',0);
		}
			
		
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30,6, 'JUDUL',1,0,'C',0);
		
		$pdf->cell(330,6, $frmjdl, 1,0,'C',0);
		
		foreach($dtheader1 as $dthdr1){
		$dtbulan=$dthdr1->dtbulan;
		$pdf->cell(40, 6, 'Bulan:'.$dtbulan.'', 1,0,'L',0);
		}
		$pdf->Ln();
		foreach($dtheader1 as $dthdr1){
		$id_larutan=$dthdr1->id_larutan;
		$pdf->cell(400,10, 'Nama Larutan:'.$id_larutan.'',1,0,'L',0);
		}
		
		
		$pdf->Ln();
	

        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
       
      
        $pdf->cell(10,6,'Sampling Date.',1,0,'C',0);           
        $pdf->cell(115,6,'PEMBUATAN LARUTAN ',1,0,'C',0);       
        $pdf->cell(245,6,'SATANDARISASI LARUATAN',1,0,'C',0);
		$pdf->cell(30, 6, 'Keterangan',1,0,'C',0);
		$pdf->Ln();
		
		$pdf->SetFont('Arial','',8);
		$pdf->cell(10,6,'',1,0,'C',0);  
		
		$pdf->cell(25,6,'Tanggal ',1,0,'C',0);       
        $pdf->cell(25,6,'Berat Jumlah',1,0,'C',0);
		$pdf->cell(25, 6,'Volume Air',1,0,'C',0);
		$pdf->cell(20, 6,'Expired',1,0,'C',0);
		$pdf->cell(20, 6,'Dibuat ',1,0,'C',0);
		
		
		
		$pdf->cell(60,6,'Tanggal ',1,0,'C',0); 
		
		$pdf->cell(65,6,'Bahan Penguji ',1,0,'C',0);   
		$pdf->cell(30,6,'Volume Jumlah ',1,0,'C',0);   
		$pdf->cell(30,6,'Volume Titrasi ',1,0,'C',0);  
        $pdf->cell(30,6,'Hasil ',1,0,'C',0);   
        $pdf->cell(30,6,'Paraf ',1,0,'C',0);   
		$pdf->cell(30, 6, '',1,0,'C',0);  
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);
		$pdf->cell(10,6,'',1,0,'C',0);  
		
		$pdf->cell(25,6,' ',1,0,'C',0);       
        $pdf->cell(25,6,'(gr atau mL)',1,0,'C',0);
		$pdf->cell(25, 6,'Destilasi(mL)',1,0,'C',0);
		$pdf->cell(20, 6,'Date',1,0,'C',0);
		$pdf->cell(20, 6,'Oleh',1,0,'C',0);
		
		
		$pdf->cell(30,6,'Start ',1,0,'C',0);  
        $pdf->cell(30,6,'Finish ',1,0,'C',0); 		
		$pdf->cell(65,6,'Nama Bahan ',1,0,'C',0);   
		$pdf->cell(10,6,'gr ',1,0,'C',0); 
		$pdf->cell(10,6,'mL ',1,0,'C',0);
		$pdf->cell(10,6,'M ',1,0,'C',0);
		
		$pdf->cell(30,6,'(mL) ',1,0,'C',0);  
        $pdf->cell(30,6,'Normalitas ',1,0,'C',0);   
        $pdf->cell(30,6,'Oleh ',1,0,'C',0);   
		$pdf->cell(30, 6, '',1,0,'C',0);  
	
		
        $pdf->Ln();

        $no=1;
      
        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');    
        $pdf->cell(25,6,$row1->tgl_pembuatan, 1,'L');
		$pdf->cell(25,6,$row1->berat_jumlah, 1,'L');
        $pdf->cell(25,6,$row1->vol_air_destilasi, 1,'L');
	    $pdf->cell(20,6,$row1->expired_date, 1,'L');
		$pdf->cell(20,6,$row1->dibuat_oleh, 1,'L');
        $pdf->cell(30,6,$row1->tgl_start, 1,'L');
        $pdf->cell(30,6,$row1->tgl_finish, 1,'L');
     
        $pdf->cell(65,6,$row1->bahan_penguji, 1,'L');
        $pdf->cell(10,6,$row1->jml_gram, 1,'L');
        
        $pdf->cell(10,6,$row1->jml_ml, 1,'L');
        $pdf->cell(10,6,$row1->jml_m, 1,'L');
        $pdf->cell(30,6,$row1->vol_titrasi_ml, 1,'L');    
       	$pdf->cell(30,6,$row1->hasil_m, 1,'L');
		$pdf->cell(30,6,$row1->dilakukan_oleh, 1,'L');
		$pdf->cell(30,6,$row1->keterangan, 1,'L');
		
			
       
        $pdf->Ln();
        $no++;   
        }
      foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
		$pdf->SetFont('Arial','',8);
		$pdf->cell(360,6,'Mulai Berlaku:'.$frmefec.'',1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
		$pdf->Output($frmkode.'.pdf','I');

        }else{}
		break;	
		
		
		
		

        case $frmkode=="intqad093":
         if($filekd=="export"){
        $pdf->AddPage('P','A4');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
         //$pdf->SetFillColor(230,230,230,230); 
         $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',8);
        $pdf->cell(30, 25, $a,1,0,'C',0);
        $dtheader1=$this->$model->get_header_byid($id);
        
         
        $pdf->cell(122, 25, $title, 1,0,'C',0);
         $pdf->SetFont('Arial','',10);
        
        
    
        foreach($dtheader1 as $dthdr1){
        $dttahun=$dthdr1->dttahun;
        $pdf->cell(40, 25, 'Tahun :'.$dttahun.'',1,0,'L',0);
        }
            
        
        $pdf->Ln();
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
        
        $pdf->cell(122,6, $frmjdl, 1,0,'C',0);
        
        foreach($dtheader1 as $dthdr1){
        $dtbulan=$dthdr1->dtbulan;
        $pdf->cell(40, 6, 'Bulan:'.$dtbulan.'', 1,0,'L',0);
        }
       
        
        
        $pdf->Ln();
    

        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
        $pdf->cell(20,6, 'Tanggal',1,0,'C',0);
        $pdf->cell(15,6, 'No',1,0,'C',0);
        $pdf->cell(30,6, 'Berat Picno ',1,0,'C',0);
        $pdf->cell(30,6, 'Berat Picno',1,0,'C',0); 
        $pdf->cell(35,6, 'Hasil ',1,0,'C',0); 
        $pdf->cell(30,6, 'Paraf',1,0,'C',0); 
        $pdf->cell(32,6, 'Keterangan',1,0,'C',0);
        $pdf->Ln(); 
        $pdf->cell(20,6, '',1,0,'C',0);
        $pdf->cell(15,6, '',1,0,'C',0);
        $pdf->cell(30,6, 'Kosong (gram) ',1,0,'C',0);
        $pdf->cell(30,6, '(gram)',1,0,'C',0); 
        $pdf->cell(35,6, '(gram) ',1,0,'C',0); 
        $pdf->cell(30,6, '',1,0,'C',0); 
        $pdf->cell(32,6, '',1,0,'C',0);
         $pdf->Ln(); 
     
    
        foreach($datadtl as $row1){  
           
           
        $pdf->SetFont('Arial','',8);  
        $pdf->cell(20,6,$row1->dttanggal, 1,'L');
        $pdf->cell(15,6,$row1->dtno, 1,'L');
        $pdf->cell(30,6,$row1->picno_kosong, 1,'L');
        $pdf->cell(30,6,$row1->picno_air, 1,'L');
        $pdf->cell(35,6,$row1->picno_hasil, 1,'L');
        $pdf->cell(30,6,$row1->createby, 1,'L');
        $pdf->cell(32,6,$row1->ket, 1,'L');
        $pdf->Ln(); 

            }
      foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
        }
        $pdf->SetFont('Arial','',8);
        $pdf->cell(152,6,'Mulai Berlaku:'.$frmefec.'',1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),207,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');

        }else{}

		break;
		 case $frmkode=="frmfss093":
		   $dtheader = $this->$model->get_header_byid($id);
           $data7 = array('dtheader' => $dtheader);
			foreach($dtheader as $dt_headerrow) {
				$dttgl = $dt_headerrow->tgl_data;
			}
			if($cekLevelUserNm=="Auditor") {
				$dtdetail1 = $this->$model->get_detail068_byidx($id);
				$dtdetail2 = $this->$model->get_detail066_byidx($dttgl);
				$dtdetail3 = $this->$model->get_detail010_byidx($dttgl);
			} else {
			   $dtdetail1 = $this->$model->get_detail068_byid($id);
			   $dtdetail2 = $this->$model->get_detail066_byid($dttgl);
			   $dtdetail3 = $this->$model->get_detail010_byid($dttgl);
			}
		 
         if($filekd=="export"){
		$pdf->AddPage('L','A3');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
         //$pdf->SetFillColor(230,230,230,230); 
        $pdf->SetFillColor(230,230,230,230);
        $pdf->SetFont('Arial','B',10);
        $pdf->cell(30, 25, $a,1,0,'C',0);
         
        $pdf->cell(325, 25, $title, 1,0,'C',0);
        $pdf->SetFont('Arial','',10);   
        $dtheader1=$this->$model->get_header_byid($id);
        foreach ($dtheader1 as $dthdr1 ){
        $tgl_data=$dthdr1->tgl_data;          
        $pdf->cell(45, 25, 'Bulan:'.$tgl_data.'',1,0,'L',0);
        }
        
        $pdf->Ln();
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
        
        $pdf->cell(325,6, $frmjdl, 1,0,'C',0);
        $pdf->cell(45, 6, 'Tahun.:', 1,0,'L',0);
                
        $pdf->Ln();
        
        $pdf->SetFillColor(230,230,230,230);
        $pdf->setFont('Arial','B',8); 
		$pdf->Cell(0,6,"A. Air Test",0,0,'L');
		$pdf->Ln();
		$pdf->setFont('Arial','',8); 
		$pdf->cell(150,6,'Sepecification',1,0,'L',0);
		$pdf->cell(80,6,'Total Plate Count',1,0,'L',0);
		$pdf->cell(80,6,'Enterobacteriaceae',1,0,'L',0);
		$pdf->cell(90,6,'Yeast and Mould',1,0,'L',0);
		$pdf->Ln();
		
		$pdf->cell(150,6,'Drp',1,0,'L',0);
		$pdf->cell(80,6,'',1,0,'L',0);
		$pdf->cell(80,6,'',1,0,'L',0);
		$pdf->cell(90,6,'',1,0,'L',0);
	    $pdf->Ln();
		$pdf->cell(150,6,'Dryer Discharge Area',1,0,'L',0);
		$pdf->cell(80,6,'Max 45cfu/15 min',1,0,'L',0);
		$pdf->cell(80,6,'-',1,0,'L',0);
		$pdf->cell(90,6,'Max 15 cfu/15 min',1,0,'L',0);
	
		$pdf->Ln();
		$pdf->cell(150,6,'Bag Filling  Room Area',1,0,'L',0);
		$pdf->cell(80,6,'Max 30cfu/15 min',1,0,'L',0);
		$pdf->cell(80,6,'-',1,0,'L',0);
		$pdf->cell(90,6,'Max 15 cfu/15 min',1,0,'L',0);
		
		$pdf->ln();
		$pdf->cell(150,6,'CMP:',1,0,'L',0);
		$pdf->cell(80,6,'',1,0,'L',0);
		$pdf->cell(80,6,'',1,0,'L',0);
		$pdf->cell(90,6,'',1,0,'L',0);
		
		$pdf->ln();
		$pdf->cell(150,6,'Filling*,Cooling,Fluidizer and Horizontal Packing Machine Room Area*',1,0,'L',0);
		$pdf->cell(80,6,'Max 30 cfu/15 min',1,0,'L',0);
		$pdf->cell(80,6,'< 1 cfu/15 min',1,0,'L',0);
		$pdf->cell(90,6,'Max 15 cfu/15 min',1,0,'L',0);
		
		$pdf->ln();
		$pdf->cell(150,6,'Cooler Room area(Second Floor)',1,0,'L',0);
		$pdf->cell(80,6,'Max 45 cfu/15 min',1,0,'L',0);
		$pdf->cell(80,6,'-',1,0,'L',0);
		$pdf->cell(90,6,'Max 15 cfu/15 min',1,0,'L',0);
		
		$pdf->ln();
		$pdf->cell(150,6,'Ducting Sterile Air area',1,0,'L',0);
		$pdf->cell(80,6,'Max 15 cfu/15 min ',1,0,'L',0);
		$pdf->cell(80,6,'-',1,0,'L',0);
		$pdf->cell(90,6,'Max 10 cfu/15 min ',1,0,'L',0);
		
		$pdf->ln();
		$pdf->cell(150,6,'WTP: Aseptic Filling Machine Area and Compressor Area',1,0,'L',0);
		$pdf->cell(80,6,'Max 15 cfu/15 min  ',1,0,'L',0);
		$pdf->cell(80,6,'-',1,0,'L',0);
		$pdf->cell(90,6,'< 5 cfu/15 min  ',1,0,'L',0);
		$pdf->ln();
		$pdf->cell(150,6,'DWP: Filling Area',1,0,'L',0);
		$pdf->cell(80,6,'Max 30 cfu/15 min  ',1,0,'L',0);
		$pdf->cell(80,6,'-',1,0,'L',0);
		$pdf->cell(90,6,'Max 15 cfu/15 min ',1,0,'L',0);
		$pdf->ln();
        $pdf->Ln();
		
			
        $pdf->cell(10,6,'No.',1,0,'C',0); 
        $pdf->cell(60,6,'Exposure TIme',1,0,'C',0); 
		$pdf->cell(80,6,'Sampling Point',1,0,'C',0); 
	    $pdf->cell(50,6,'Total Plate Count',1,0,'C',0);             
        $pdf->cell(50,6,'Enterobacteriaceae',1,0,'C',0);       
        $pdf->cell(100,6,'Yeast and Mould',1,0,'C',0);
        $pdf->cell(50,6,'Remarks',1,0,'C',0);
	
        
        $pdf->Ln();

        $no=1;
		$dtdetail1 = $this->$model->get_detail068_byid($id);
        if (empty($dtdetail1)){}else{
        foreach($dtdetail1 as $row1){  
           
           
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');     
		$pdf->cell(60,6,$row1->wkt_sampling, 1,'L');
        $pdf->cell(80,6,$row1->kd_samplingpoint, 1,'L');
        $pdf->cell(50,6,$row1->ha_tpc, 1,'L');
        $pdf->cell(50,6,$row1->ha_entero, 1,'L');
        $pdf->cell(50,6,$row1->ha_yeast, 1,'L');
        $pdf->cell(50,6,$row1->ha_mould, 1,'L');
        $pdf->cell(50,6,$row1->remarks, 1,'L');
		       
        $pdf->Ln();
        $no++;   
        }}
		
		$pdf->setFont('Arial','B',8); 
        $pdf->Cell(0,6,"B.Environment Swabbing/ Floor And Swabbing",0,0,'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);
      
        $pdf->cell(120,6,'Sepecification',1,0,'L',0);
		$pdf->cell(80,6,'Total Plate Count',1,0,'L',0);
		$pdf->cell(80,6,'Enterobacteriaceae',1,0,'L',0);
		$pdf->cell(60,6,'E.Coli',1,0,'L',0);
		$pdf->cell(60,6,'Salmonella',1,0,'L',0);
        $pdf->Ln();

        
		$pdf->cell(60,6,'1. Floor',1,0,'L',0);
        $pdf->cell(60,6,'DRP - Bag Filling Room Area',1,0,'L',0);
		$pdf->cell(80,6,'Max 3200 cfu/400 cm2',1,0,'L',0);
		$pdf->cell(80,6,'Max 200 cfu/400 cm2',1,0,'L',0);
		$pdf->cell(60,6,'Abs/400 cm2',1,0,'L',0);
		$pdf->cell(60,6,'Abs/400 cm2',1,0,'L',0);
        $pdf->Ln();

        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'CMP-Filling and Cooling Area',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);

        $pdf->Ln();
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'SPD - Santan Press Processing Area',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->Ln();
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'MPD - Meat Preparation Area',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->Ln();

        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'WTP - Wet Process Area ',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->Ln();

        $pdf->cell(60,6,'2. Wall',1,0,'L',0);
        $pdf->cell(60,6,'DRP - Bag Filling Room Area',1,0,'L',0);
        $pdf->cell(80,6,'Max 2500 cfu/400 cm2',1,0,'L',0);
        $pdf->cell(80,6,'Max 150 cfu/400 cm2',1,0,'L',0);
        $pdf->cell(60,6,'Abs/400 cm2',1,0,'L',0);
        $pdf->cell(60,6,'Abs/400 cm2',1,0,'L',0);
        $pdf->Ln();

        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'CMP-Filling and Cooling Area',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);

        $pdf->Ln();
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'SPD - Santan Press Processing Area',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->Ln();
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'MPD - Meat Preparation Area',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->Ln();

        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'WTP - Wet Process Area ',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(80,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->cell(60,6,'',1,0,'L',0);
        $pdf->Ln();

        $pdf->cell(60,6,'3.Selokan area filling',1,0,'L',0);
        $pdf->cell(60,6,'WTP - Aseptic Filling Machine Area',1,0,'L',0);
        $pdf->cell(80,6,'Max 3200 cfu/400 cm2',1,0,'L',0);
        $pdf->cell(80,6,'Max 200 cfu/400 cm2',1,0,'L',0);
        $pdf->cell(60,6,'Abs/400 cm2',1,0,'L',0);
        $pdf->cell(60,6,'Abs/400 cm2',1,0,'L',0);
        $pdf->Ln();
        $pdf->Ln();

        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,12,'No.',1,0,'L',0);
        $pdf->cell(50,12,'Sampling Points',1,0,'L',0);
        $pdf->cell(50,12,'Time of Swabbing',1,0,'L',0);
        $pdf->cell(60,6,'Total Plate Count',1,0,'C',0);
        $pdf->cell(60,6,'Enterobacteriaceae',1,0,'C',0);
        $pdf->cell(60,6,'E.coli',1,0,'C',0);
        $pdf->cell(60,6,'Salmonella',1,0,'C',0);	
        $pdf->cell(50,12,'Remarks',1,0,'L',0);
		$pdf->cell(0.5,6,'',0,0,'L',0);
        $pdf->Ln();

        $pdf->cell(10,6,'',0,0,'L',0);
        $pdf->cell(50,6,'',0,0,'L',0);
		$pdf->cell(50,6,'',0,0,'L',0);
        $pdf->cell(20,6,'Floor',1,0,'L',0);
        $pdf->cell(20,6,'Wall',1,0,'L',0);
        $pdf->cell(20,6,'Drainage',1,0,'L',0);

        $pdf->cell(20,6,'Floor',1,0,'L',0);
        $pdf->cell(20,6,'Wall',1,0,'L',0);
        $pdf->cell(20,6,'Drainage',1,0,'L',0);   

        $pdf->cell(20,6,'Floor',1,0,'L',0);
        $pdf->cell(20,6,'Wall',1,0,'L',0);
        $pdf->cell(20,6,'Drainage',1,0,'L',0);

        $pdf->cell(20,6,'Floor',1,0,'L',0);
        $pdf->cell(20,6,'Wall',1,0,'L',0);
        $pdf->cell(20,6,'Drainage',1,0,'L',0);


        $pdf->cell(50,6,'',0,0,'L',0);
		$pdf->cell(0.5,6,'',0,0,'L',0);
        $pdf->Ln();


        $dtdetail3 = $this->$model->get_detail010_byid($dttgl);
        $no=1;
        if (!empty($dtdetail3)){
        foreach ($dtdetail3 as $row1){             
           
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');     
        $pdf->cell(50,6,$row1->sampling_point, 1,'L');
        $pdf->cell(50,6,$row1->sampling_jam, 1,'L');	
        $pdf->cell(20,6,$row1->tpc_floor, 1,'L');		
        $pdf->cell(20,6,$row1->tpc_wall, 1,'L');		
        $pdf->cell(20,6,$row1->tpc_drainage, 1,'L');

		if ($row1->operator=='0'){
			$operator="<";
		}elseif($row1->operator=='1'){
			$operator=">";
		}else{
			$operator="";
		}
		
			
        $pdf->cell(20,6,$operator.''.$row1->entero_floor.'', 1,'L');
		if ($row1->operator2=='0'){
			$operator2="<";
		}elseif($row1->operator2=='1'){
			$operator2=">";
		}else{
			$operator2="";
		}
		
					
        $pdf->cell(20,6,$operator2.' '.$row1->entero_wall, 1,'L');   
		
		if($row1->operator3=='0'){	
			$operator3="<";
		}elseif($row1->operator3=='1'){
			$operator3=">";
		}else{
			$operator3="";
		}
		
				
		$pdf->cell(20,6,$operator3.''.$row1->entero_drainage, 1,'L');
		
		
        $pdf->cell(20,6,$row1->ecoli_floor, 1,'L');
		
		if ($row1->ecoli_wall==''){
			$ecoli_wall="-";
		}else{
			$ecoli_wall="";
		} 
		
        $pdf->cell(20,6,$ecoli_wall, 1,'L');
		
        $pdf->cell(20,6,$row1->ecoli_drainage, 1,'L');
		
		
        $pdf->cell(20,6,$row1->salmonella_floor, 1,'L');
		if ($row1->salmonella_wall==''){
			$salmonella_wall="-";
		}else{
			$salmonella_wall="";
		} 
        $pdf->cell(20,6,$row1->salmonella_wall, 1,'L'); 
		
		
        $pdf->cell(20,6,$row1->salmonella_drainage, 1,'L');

        $pdf->cell(50,6,$row1->remarks, 1,'L');
       
		
        $pdf->Ln();
        $no++;   
        }
      }
	  
	  $pdf->setFont('Arial','B',8); 
	  $pdf->Cell(0,6,"C.Personnel Swabbing/ Hand Swabbing",0,0,'L');
	  $pdf->Ln();
	  $pdf->SetFont('Arial','',8);
	  $pdf->cell(120,6,'Specification: Total Plate Count: Max 700 cfu/400 cm2',1,0,'L',0);
	  $pdf->cell(120,6,'Enterobacteriaceae: Max 55 cfu/400 cm2',1,0,'L',0);
	  $pdf->cell(80,6,'E. coli: Abs/400 cm2',1,0,'L',0);	
	  $pdf->cell(80,6,'Salmonella: Abs/400 cm2',1,0,'L',0);
	  $pdf->Ln();
	  
  
          
		$pdf->cell(10,6,'No.',1,0,'C',0); 
		$pdf->cell(80,6,'Name',1,0,'C',0); 
		$pdf->cell(60,6,'Time of Swabbing',1,0,'C',0);             
		$pdf->cell(60,6,'Total Plate Count',1,0,'C',0);       
		$pdf->cell(60,6,'Enterobacteriaceae',1,0,'C',0);
		$pdf->cell(40,6,'E.coli',1,0,'C',0);
		$pdf->cell(40,6,'Salmonella',1,0,'C',0);
		$pdf->cell(50,6,'Remarks',1,0,'C',0);
	
	    
  
	$pdf->Ln();
	$dtdetail2 = $this->$model->get_detail066_byid($dttgl);
	$no=1;
	if (empty($dtdetail2)){}else{
	foreach ($dtdetail2 as $row1){             
	   
	$pdf->SetFont('Arial','',8);
	$pdf->cell(10,6,$no, 1,'L');     
	$pdf->cell(40,6,$row1->lokasi_sampling, 1,'L');
	$pdf->cell(40,6,$row1->sampling_point, 1,'L');
	$pdf->cell(60,6,$row1->sampling_jam, 1,'L');

    if($row1->operator2=='0'){
        $operator2="<";
    }elseif($row1->operator2=='1'){
        $operator2=">";
    }else{
        $operator2="";
    }

	$pdf->cell(60,6,$operator2.' '.$row1->ha_tpc, 1,'L');
    if($row1->operator=='0'){
        $operator="<";
    }elseif($row1->operator=='1'){
        $operator=">";
    }else{
        $operator="";
    }
	$pdf->cell(60,6,$operator.' '.$row1->ha_entero, 1,'L');
	$pdf->cell(40,6,$row1->ha_ecoli_gas, 1,'L');
	$pdf->cell(40,6,$row1->ha_salmonella_he, 1,'L');
	$pdf->cell(50,6,$row1->remarks, 1,'L');
	
	$pdf->Ln();
	$no++;   
        }
      }
	 
	  $pdf->setFont('Arial','B',8); 
	  $pdf->Cell(0,6,"Definitions",0,1,'L');
	  $pdf->Ln();
	  $pdf->setFont('Arial','',8); 
	  $pdf->cell(120,6,'Cfu :',0,0,'L',0);
	  $pdf->cell(120,6,'Colony forming unit',0,0,'L',0);
	  $pdf->cell(80,6,'E.coli',0,0,'L',0);	
	  $pdf->cell(80,6,'Escherichia coli',0,0,'L',0);
	  $pdf->Ln();
	  $pdf->cell(120,6,'Min :',0,0,'L',0);
	  $pdf->cell(120,6,'Minute',0,0,'L',0);
	  $pdf->cell(80,6,'P/D :',0,0,'L',0);
	  $pdf->cell(80,6,'Production Date',0,0,'L',0);
	  $pdf->Ln();
	  $pdf->cell(120,6,'Doc :',0,0,'L',0);
	  $pdf->cell(120,6,'Document',0,0,'L',0);
	  $pdf->cell(80,6,'Max :',0,0,'L',0);
	  $pdf->cell(80,6,'Maximum',0,0,'L',0);
	  $pdf->Ln();
	  $pdf->cell(120,6,'Abs :',0,0,'L',0);
	  $pdf->cell(120,6,'Anbsence',0,0,'L',0);

	  $pdf->cell(80,6,'E.coli :',0,0,'L',0);
	  $pdf->cell(80,6,'Escherichia coli',0,0,'L',0);
	  $pdf->Ln();
		  
	
      foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
	}
        $pdf->SetFont('Arial','',8);
        $pdf->cell(360,6,'Mulai Berlaku:'.$frmefec.'',1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
	 
      $pdf->SetY(-10);
      $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
      $pdf->SetFont('Arial','I',9);
      $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
      $pdf->Ln();
      $pdf->Output($frmkode.'.pdf','I');

        }else{}
		break;
		
		 case $frmkode=="frmlqs095":
         if($filekd=="export"){
		$pdf->AddPage('L','A3');
		$logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";	    
		$a=$pdf->Image($logor,10,10,30,25);
		$dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
		 //$pdf->SetFillColor(230,230,230,230); 
		 $pdf->SetFillColor(110,180,230);
		$pdf->SetFont('Arial','',8);
		$pdf->cell(30, 25, $a,1,0,'C',0);
		$dtheader1=$this->$model->get_header_byid($id);
		
		 
		$pdf->cell(315, 25, $title, 1,0,'C',0);
		 $pdf->SetFont('Arial','',10);
		
		
	
		foreach($dtheader1 as $dthdr1){
		$tgl_data=$dthdr1->tgl_data;
		$pdf->cell(50, 25, 'TGL :'.$tgl_data.'',1,0,'L',0);
		}
			
		
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30,6, 'JUDUL',1,0,'C',0);
		
		$pdf->cell(315,6, $frmjdl, 1,0,'C',0);
		
		foreach($dtheader1 as $dthdr1){
		$tipe_produk=$dthdr1->tipe_produk;
		$pdf->cell(50, 6, 'Product:'.$tipe_produk.'', 1,0,'L',0);
		}
		$pdf->Ln();
	
		

        
		
       
      //baris1
	    $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,'No.',1,0,'C',0); 
        $pdf->cell(25,6,'Date Of Production',1,0,'C',0); 
	    $pdf->cell(25,6,'Code of Production',1,0,'C',0);             
        $pdf->cell(25,6,'Bag Number',1,0,'C',0);       
        $pdf->cell(25,6,'Date Of Rest',1,0,'C',0);
		
        $pdf->cell(75,6,'Test Parameter',1,0,'C',0);
        $pdf->cell(210,6,'Result',1,0,'C',0);
		$pdf->Ln();
		
		//baris2
		$pdf->cell(10,6,'.',1,0,'C',0); 
		
        $pdf->cell(25,6,'',1,0,'C',0); 
	    $pdf->cell(25,6,'',1,0,'C',0);             
        $pdf->cell(25,6,'',1,0,'C',0);       
        $pdf->cell(25,6,'',1,0,'C',0);
		
        $pdf->cell(15,6,'TPC',1,0,'C',0);
		$pdf->cell(15,6,'ENT',1,0,'C',0);
	    $pdf->cell(15,6,'Y&M',1,0,'C',0); 
	    $pdf->cell(15,6,'EC',1,0,'C',0);
		$pdf->cell(15,6,'SAL',1,0,'C',0);
		
		$pdf->cell(30,6,'TPC',1,0,'C',0);
		$pdf->cell(30,6,'ENtero',1,0,'C',0);
		$pdf->cell(30,6,'Yeast&Mould',1,0,'C',0);
		$pdf->cell(30,6,'E.coli',1,0,'C',0);
		$pdf->cell(30,6,'Salmonella',1,0,'C',0);
		$pdf->cell(30,6,'MPN Coliform',1,0,'C',0);
		$pdf->cell(30,6,'Staph Aureus',1,0,'C',0);
		$pdf->Ln();
		//baris3
		
		$pdf->cell(10,6,'.',1,0,'C',0); 
		
        $pdf->cell(25,6,'',1,0,'C',0); 
	    $pdf->cell(25,6,'',1,0,'C',0);             
        $pdf->cell(25,6,'',1,0,'C',0);       
        $pdf->cell(25,6,'',1,0,'C',0);
		
        $pdf->cell(15,6,'',1,0,'C',0);
		$pdf->cell(15,6,'',1,0,'C',0);
	    $pdf->cell(15,6,'',1,0,'C',0); 
	    $pdf->cell(15,6,'',1,0,'C',0);
		$pdf->cell(15,6,'',1,0,'C',0);
		
		$pdf->cell(30,6,'Cfu/g',1,0,'C',0);
		$pdf->cell(30,6,'Cfu',1,0,'C',0);
		$pdf->cell(30,6,'Cfu/g',1,0,'C',0);
		$pdf->cell(30,6,'Pre/Abs',1,0,'C',0);
		$pdf->cell(30,6,'Pre/Abs',1,0,'C',0);
		
		$pdf->cell(30,6,'MPN/g',1,0,'C',0);
		$pdf->cell(30,6,'Cfu/g',1,0,'C',0);
		
		$pdf->Ln();
		
		//baris4
		
		$pdf->cell(10,6,'.',1,0,'C',0); 
		
        $pdf->cell(25,6,'',1,0,'C',0); 
	    $pdf->cell(25,6,'',1,0,'C',0);             
        $pdf->cell(25,6,'',1,0,'C',0);       
        $pdf->cell(25,6,'',1,0,'C',0);
		
        $pdf->cell(15,6,'',1,0,'C',0);
		$pdf->cell(15,6,'',1,0,'C',0);
	    $pdf->cell(15,6,'',1,0,'C',0); 
	    $pdf->cell(15,6,'',1,0,'C',0);
		$pdf->cell(15,6,'',1,0,'C',0);
		
		
		$pdf->cell(10,6,'1st',1,0,'C',0);
		$pdf->cell(10,6,'2nd',1,0,'C',0);
		$pdf->cell(10,6,'3rd',1,0,'C',0);
		
		$pdf->cell(10,6,'1st',1,0,'C',0);
		$pdf->cell(10,6,'2nd',1,0,'C',0);
		$pdf->cell(10,6,'3rd',1,0,'C',0);
		
		$pdf->cell(10,6,'1st',1,0,'C',0);
		$pdf->cell(10,6,'2nd',1,0,'C',0);
		$pdf->cell(10,6,'3rd',1,0,'C',0);
		
		
		$pdf->cell(10,6,'1st',1,0,'C',0);
		$pdf->cell(10,6,'2nd',1,0,'C',0);
		$pdf->cell(10,6,'3rd',1,0,'C',0);
		
		$pdf->cell(10,6,'1st',1,0,'C',0);
		$pdf->cell(10,6,'2nd',1,0,'C',0);
		$pdf->cell(10,6,'3rd',1,0,'C',0);
		
		$pdf->cell(10,6,'1st',1,0,'C',0);
		$pdf->cell(10,6,'2nd',1,0,'C',0);
		$pdf->cell(10,6,'3rd',1,0,'C',0);
		
		$pdf->cell(10,6,'1st',1,0,'C',0);
		$pdf->cell(10,6,'2nd',1,0,'C',0);
		$pdf->cell(10,6,'3rd',1,0,'C',0);
		
		
		   
        $pdf->Ln();

        $no=1;
      
        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');     
		$pdf->cell(25,6,$row1->tgl_data, 1,'L');
        $pdf->cell(25,6,$row1->kd_produksi, 1,'L');
        $pdf->cell(25,6,$row1->bag_crt_pack_number, 1,'L');
        $pdf->cell(25,6,$row1->date_retest, 1,'L');
		
        $pdf->cell(15,6,$row1->tp_tpc, 1,'L');
        $pdf->cell(15,6,$row1->tp_ent, 1,'L');
        $pdf->cell(15,6,$row1->tp_ynm, 1,'L');
		
        $pdf->cell(15,6,$row1->tp_ec, 1,'L');
		$pdf->cell(15,6,$row1->tp_sal, 1,'L');
		
		
        $pdf->cell(10,6,$row1->r_tpc_1, 1,'L');
        $pdf->cell(10,6,$row1->r_tpc_2, 1,'L');
        $pdf->cell(10,6,$row1->r_tpc_3, 1,'L');
		
        $pdf->cell(10,6,$row1->r_etr_1, 1,'L');
        $pdf->cell(10,6,$row1->r_etr_2, 1,'L');
        $pdf->cell(10,6,$row1->r_etr_3, 1,'L');
		
        $pdf->cell(10,6,$row1->r_ynm_1, 1,'L');
        $pdf->cell(10,6,$row1->r_ynm_2, 1,'L');    
       	$pdf->cell(10,6,$row1->r_ynm_3, 1,'L');
		
		$pdf->cell(10,6,$row1->r_ec_1, 1,'L');
		$pdf->cell(10,6,$row1->r_ec_2, 1,'L');
		$pdf->cell(10,6,$row1->r_ec_3, 1,'L');
		
		$pdf->cell(10,6,$row1->r_salmo_1, 1,'L');
		$pdf->cell(10,6,$row1->r_salmo_2, 1,'L');
		$pdf->cell(10,6,$row1->r_salmo_3, 1,'L');
		
		
		$pdf->cell(10,6,$row1->r_mpn_coli_1, 1,'L');
		$pdf->cell(10,6,$row1->r_mpn_coli_2, 1,'L');
		$pdf->cell(10,6,$row1->r_mpn_coli_3, 1,'L');
		
		$pdf->cell(10,6, $row1->r_stph_aure_1, 1,'L');
		$pdf->cell(10,6, $row1->r_stph_aure_2, 1,'L');
		$pdf->cell(10,6, $row1->r_stph_aure_3, 1,'L');
		
        $pdf->Ln();
        $no++;   
        }
		
		foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
		$pdf->SetFont('Arial','',8);
		$pdf->cell(355,6, $frmefec,1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
		$pdf->Output($frmkode.'.pdf','I');

        }else{}
		break;
		
		
		
		
		 case $frmkode=="frmfss098":
        if ($filekd=="export"){
		 $logor='assets/images/rlogopsg.png';
        $title="PT.PULAU SAMBU GUNTUNG";
		$pdf->AddPage('L','A3');
		$a=$pdf->Image($logor,10,10,30,25);
		$dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true); 
		  
		  
		$pdf->SetFillColor(230,230,230,230);
		$pdf->SetFont('Arial','B',10);
		$pdf->cell(30, 25, $a,1,0,'C',0);
		
		
		
		 
		$pdf->cell(325, 25, $title, 1,0,'C',0);
		
		$pdf->SetFont('Arial','',7);
		$dtproduct=$this->$model->get_header_byid($id);
		foreach($dtproduct as $dtprd){
		$dok=$dtprd->dok;
	
		$pdf->cell(40, 25, 'Dok: '.$dok.'', 1,0,'L',0);
		}
		$pdf->Ln();
		$pdf->SetFont('Arial','',7);
		$pdf->cell(30,6, 'JUDUL',1,0,'C',0);
		
		$pdf->cell(325,6, $frmjdl, 1,0,'C',0);
		
		$dtproduct=$this->$model->get_header_byid($id);
		foreach($dtproduct as $dtprd){
		$tanggal=$dtprd->tanggal;
		$pdf->cell(40, 6,'Product: '.$tanggal.'', 1,0,'L',0);
		}		
		$pdf->Ln(6);
		
		
        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',8);
       
      
    //    $pdf->cell(10,6,'No.',1,0,'C',0); 
        $pdf->cell(185,6,'Boiler Water Chemical Analysis',1,0,'C',0); 
		$pdf->cell(210,6,'Steam Condensate Chemical Analysis',1,0,'C',0);
		$pdf->Ln();
		
		//$pdf->cell(10,6,'',1,0,'C',0); 
		$pdf->cell(60, 6,'Sampling',1,0,'C',0);
		$pdf->cell(25, 6,'pH',1,0,'C',0);
		$pdf->cell(25, 6,'Ta(ppm)',1,0,'C',0);
		$pdf->cell(25, 6,'Sulfile',1,0,'C',0);
		$pdf->cell(25, 6,'Phospate',1,0,'C',0);
		$pdf->cell(25, 6,'TDS(ppm)',1,0,'C',0);
		
		
		$pdf->cell(30, 6,'Sampling Time',1,0,'C',0);
		$pdf->cell(30, 6,'pH',1,0,'C',0);
		$pdf->cell(30, 6,'TDS(ppm)',1,0,'C',0);
		$pdf->cell(30, 6,'Colour)',1,0,'C',0);
		$pdf->cell(40, 6,'Odour and Taste',1,0,'C',0);
		$pdf->cell(50, 6,'Remarks',1,0,'C',0);
		$pdf->Ln();
		
		//$pdf->cell(10,6,'',1,0,'C',0); 
        $pdf->cell(30,6,'Point',1,0,'C',0); 
		$pdf->cell(30,6,'Time',1,0,'C',0); 
		
		$pdf->cell(25, 6,'10,5-11,5',1,0,'C',0);
		$pdf->cell(25, 6,'800 max',1,0,'C',0);
		$pdf->cell(25, 6,'10-60ppm',1,0,'C',0);
		$pdf->cell(25, 6,'10-60ppm',1,0,'C',0);
		$pdf->cell(25, 6,'3500max',1,0,'C',0);
		
		$pdf->cell(30, 6,'',1,0,'C',0);
		$pdf->cell(30, 6,'6.5-8.5',1,0,'C',0);
		$pdf->cell(30, 6,'20max',1,0,'C',0);
		$pdf->cell(30, 6,'(Clear)',1,0,'C',0);
		$pdf->cell(40, 6,'(Normal)',1,0,'C',0);
		$pdf->cell(50, 6,'',1,0,'C',0);
		
			
        $pdf->Ln();

        $no=1;
		$dtdetail1=$this->$model->get_detail_non006A_byid($id);
        $dtdetail2=$this->$model->get_detail_non006B_byid($id);
		if(isset($dtdetail1)){$jmldt1 = count($dtdetail1);}else{$jmldt1 ='0';}
		if(isset($dtdetail2)){$jmldt2 = count($dtdetail2);}else{$jmldt2 ='0';}
		if($jmldt1>$jmldt2){$count1=$jmldt1;}else{$count1=$jmldt2;}
		
		if((isset($dtdetail1))||(isset($dtdetail2))){
		foreach($dtdetail1 as $dtdetail1row){

        $pdf->cell(30,6,$dtdetail1row->nama_kimia, 1,'L');
        $pdf->cell(30,6,$dtdetail1row->jam_sampling, 1,'L');
        $pdf->cell(25,6,$dtdetail1row->ph, 1,'L');
        $pdf->cell(25,6,$dtdetail1row->ta_ppm, 1,'L');
        $pdf->cell(25,6,$dtdetail1row->sulfit_ppm, 1,'L');
        $pdf->cell(25,6,$dtdetail1row->phospat, 1,'L');
        $pdf->cell(25,6,$dtdetail1row->tds, 1,'L');


        $pdf->cell(30,6,$dtdetail1row->nama_kimia, 1,'L');
        $pdf->cell(30,6,$dtdetail1row->jam_sampling, 1,'L');
        $pdf->cell(25,6,$dtdetail1row->ph, 1,'L');
        $pdf->cell(30,6,$dtdetail1row->ta_ppm, 1,'L');
        $pdf->cell(30,6,$dtdetail1row->sulfit_ppm, 1,'L');
        $pdf->cell(40,6,$dtdetail1row->phospat, 1,'L');
        $pdf->cell(25,6,$dtdetail1row->tds, 1,'L');
        $pdf->Ln();
}

}
		
	   for($i=0;$i<$count1;$i++){
	   if(!isset($nama_kimia[$i])){}else{echo $nama_kimia[$i];}
	   if(!isset($jam_sampling[$i])){}else{echo $jam_sampling[$i];}
	   if(!isset($ph[$i])){}else{echo $ph[$i];}
	   if(!isset($ta_ppm[$i])){}else{echo $ta_ppm[$i];}
	   if(!isset($sulfit_ppm[$i])){}else{echo $sulfit_ppm[$i];}
	   if(!isset($phospat[$i])){}else{echo $phospat[$i];}
	   if(!isset($tds[$i])){}else{echo $tds[$i];}
	   if(!isset($jam_sampling2[$i])){}else{echo $jam_sampling2[$i];}
	   if(!isset($ph2[$i])){}else{echo $ph2[$i];}
	   if(!isset($tds2[$i])){}else{echo $tds2[$i];}
	   if(!isset($colour2[$i])){}else{echo $colour2[$i];}
	   if(!isset($odour2[$i])){}else{echo $odour2[$i];}
	   if(!isset($remarks2[$i])){}else{echo $remarks2[$i];}
	
       $pdf->Ln();  
        }
		
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
		$pdf->Output($frmkode.'.pdf','I');

        }else{}
		break;
		
		
		

       case $frmkode=="frmlqs037":
         if($filekd=="export"){
        $pdf->AddPage('L','A3');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
         //$pdf->SetFillColor(230,230,230,230); 
         $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',8);
        $pdf->cell(30, 25, $a,1,0,'C',0);
        $dtheader1=$this->$model->get_header_byid($id);
        
         
        $pdf->cell(315, 25, $title, 1,0,'C',0);
         $pdf->SetFont('Arial','',10);
        
        
    
        foreach($dtheader1 as $dthdr1){
        $docno=$dthdr1->docno;
        $pdf->cell(40, 25, 'DOK :'.$docno.'',1,0,'L',0);
        }
            
        
        $pdf->Ln();
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
        
        $pdf->cell(315,6, $frmjdl, 1,0,'C',0);
        
        foreach($dtheader1 as $dthdr1){
        $tgl_uji=$dthdr1->tgl_uji;
        $pdf->cell(40, 6, 'Tanggal :' .$tgl_uji.'', 1,0,'L',0);
        }
        $pdf->Ln();
        

        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
       
      
        $pdf->cell(10,6,'No.',1,0,'C',0);           
        $pdf->cell(30,6,'Kode Contoh ',1,0,'C',0);       
        $pdf->cell(30,6,'Tgl/ Kode Produksi',1,0,'C',0);
        $pdf->cell(60, 6, 'Analisa',1,0,'C',0);
		$pdf->cell(75, 6, 'Morfologi Koloni',1,0,'C',0);
		$pdf->cell(75, 6, 'Mikroskopik',1,0,'C',0);
		$pdf->cell(25, 6, 'Uji',1,0,'C',0);
		$pdf->cell(55, 6, 'Uji Biokimia',1,0,'C',0);
		$pdf->cell(25, 6, 'Keterangan',1,0,'C',0);
		
        $pdf->Ln();
        
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,'',1,0,'C',0);  
		$pdf->cell(30,6,'',1,0,'C',0);       
        $pdf->cell(30,6,'',1,0,'C',0);
        
        $pdf->cell(30,6,'Tanggal ',1,0,'C',0);       
        $pdf->cell(30,6,'Oleh',1,0,'C',0);
		
        $pdf->cell(25, 6,'Bentuk',1,0,'C',0);
        $pdf->cell(25, 6,'Penampilan',1,0,'C',0);
        $pdf->cell(25, 6,'Warna ',1,0,'C',0);
		
		$pdf->cell(25, 6,'Bentuk',1,0,'C',0);
        $pdf->cell(25, 6,'Warna',1,0,'C',0);
        $pdf->cell(25, 6,'Gram ',1,0,'C',0);
		
		$pdf->cell(25, 6,'Oksidase',1,0,'C',0);
		
        $pdf->cell(15, 6,'TSIA',1,0,'C',0);
        $pdf->cell(15, 6,'LIA ',1,0,'C',0);
		$pdf->cell(25, 6,'Mikrogeb/ Mikrobat ',1,0,'C',0);  
        $pdf->cell(25, 6, '',1,0,'C',0);
	    $pdf->Ln(6);
	 

        $no=1;
      
        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');    
        $pdf->cell(30,6,$row1->kd_contoh, 1,'L');
        $pdf->cell(30,6,$row1->tgl_kd_produksi 	, 1,'L');
        $pdf->cell(30,6,$row1->analisa_tgl, 1,'L');
        $pdf->cell(30,6,$row1->analisa_oleh, 1,'L');
        $pdf->cell(25,6,$row1->mk_bentuk, 1,'L');
        $pdf->cell(25,6,$row1->mk_penampilan, 1,'L');
     
        $pdf->cell(25,6,$row1->mk_warna, 1,'L');
        $pdf->cell(25,6,$row1->m_bentuk, 1,'L');
        
        $pdf->cell(25,6,$row1->m_warna, 1,'L');
        $pdf->cell(25,6,$row1->m_gram, 1,'L');
        $pdf->cell(25,6,$row1->uji_oxidase, 1,'L');  
		$pdf->cell(15,6,$row1->ub_tsia, 1,'L'); 
        $pdf->cell(15,6,$row1->ub_lia, 1,'L');
        $pdf->cell(25,6,$row1->ub_micro, 1,'L');
        $pdf->cell(25,6,$row1->keterangan, 1,'L');
        $pdf->Ln();
        $no++;   
        }
      foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
        $pdf->SetFont('Arial','',8);
        $pdf->cell(345,6,'Mulai Berlaku : ' .$frmefec.'',1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');

        }else{}
        break;

        
       case $frmkode=="frmehs037":
        if($filekd=="export"){
		$pdf->AddPage('P','A4');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
         //$pdf->SetFillColor(230,230,230,230); 
         $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30, 25, $a,1,0,'C',0);
        $dtheader1=$this->$model->get_header_byid($id);
        
         
        $pdf->cell(121, 25, $title, 1,0,'C',0);
        $pdf->SetFont('Arial','',10);
    
        foreach($dtheader1 as $dthdr1){
        $docno=$dthdr1->docno;
        $pdf->cell(40, 25, 'Tgl :'.$docno.'',1,0,'L',0);
        }
		
		$pdf->Ln();
        $pdf->SetFont('Arial','',10);
        $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
        
        $pdf->cell(121,6, $frmjdl, 1,0,'C',0);
        
        foreach($dtheader1 as $dthdr1){
        $tanggal=$dthdr1->tanggal;
        $pdf->cell(40, 6, 'Dok:'.$tanggal.'', 1,0,'L',0);
        }
        $pdf->Ln();
                
      
        $pdf->cell(9,6,'No.',1,0,'C',0);    
        $pdf->cell(42,6,'Parameter',1,0,'C',0);
		$pdf->cell(20,6,'Nilai Batas',1,0,'C',0);
        $pdf->cell(20,6,'Satuan',1,0,'C',0);
        $pdf->cell(20,6,'inlet',1,0,'C',0);
        $pdf->cell(20,6,'Outlet',1,0,'C',0);
        $pdf->cell(20,6,'Koreksi',1,0,'C',0);
        $pdf->cell(20,6,'Verifikasi',1,0,'C',0);
        $pdf->cell(20,6,'Verifikasi by',1,0,'C',0); 
             
        $pdf->Ln();

        $no=1;
               

        foreach ($datadtl as $row){             
           
        $pdf->SetFont('Arial','',8);
        $pdf->cell(9,6,$no, 1,'L');      
        $pdf->cell(42,6,$row->parameter, 1,'L');
        $pdf->cell(20,6,$row->nilaibatas, 1,'L');
        $pdf->cell(20,6,$row->satuan, 1,'L');
        $pdf->cell(20,6,$row->inlet, 1,'L');
        $pdf->cell(20,6,$row->outlet, 1,'L');
        $pdf->cell(20,6,$row->koreksi, 1,'L');
        $pdf->cell(20,6,$row->verifikasi, 1,'L');
        $pdf->cell(20,6,$row->verifikasiby, 1,'L');       

       
        $pdf->Ln();
        $no++;   
        }
      foreach($dtfrm as $dt_form){
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
       }

        $pdf->SetFont('Arial','',8);
        $pdf->cell(171,6,'Mulai Berlaku :' .$frmefec,1,0,'L',0);
        $pdf->cell(20,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');

        }else{}
		break;
		
        case $frmkode=="frmnon002":
         if($filekd=="export"){
		$pdf->AddPage('L','A3');
		$logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";	    
		$a=$pdf->Image($logor,10,10,30,25);
		$dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
		 //$pdf->SetFillColor(230,230,230,230); 
		 $pdf->SetFillColor(110,180,230);
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30, 25, $a,1,0,'C',0);
		$dtheader1=$this->$model->get_header_byid($id);
		$pdf->cell(270, 25, $title, 1,0,'C',0);
		 $pdf->SetFont('Arial','',10);

		foreach($dtheader1 as $dthdr1){
		$no_doc=$dthdr1->no_doc;
		$pdf->cell(55, 25, 'No.DOC :'.$no_doc.'',1,0,'L',0);
		}
			
		
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30,6,'JUDUL',1,0,'C',0);
		$pdf->cell(270,6, $frmjdl, 1,0,'C',0);
		foreach($dtheader1 as $dthdr1){
		$tgl_finish_product = $dthdr1->tgl_finish_product;
		
		$pdf->cell(55,6, 'TGL:'.$tgl_finish_product.'',1,0,'C',0);
		}
		
		$pdf->Ln();
		

        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
        $pdf->cell(10,6,'No.',1,0,'C',0);    
        $pdf->cell(25,6,'kode Sample',1,0,'C',0);  
        $pdf->cell(25,6,'Jam Sampling',1,0,'C',0);   		
        
        $pdf->cell(140,6,'Analisis Parameters',1,0,'C',0); 
		
       // $pdf->cell(15,6,'FCI',1,0,'C',1);
        $pdf->cell(15,6,'TDS',1,0,'C',0);
        $pdf->cell(15,6,'Colour',1,0,'C',0);
        $pdf->cell(25,6,'Turbidity',1,0,'C',0);
        $pdf->cell(25,6,'Residual Ozon',1,0,'C',0);
        $pdf->cell(25,6,'Odour/ Taste',1,0,'C',0);
        $pdf->cell(25,6,'Dianalisa',1,0,'C',0);
		$pdf->cell(25,6,'Remarks',1,0,'C',0);
		$pdf->Ln();
		
		$pdf->cell(10,6,'',1,0,'C',0);    
        $pdf->cell(25,6,'',1,0,'C',0);  
        $pdf->cell(25,6,'',1,0,'C',0);  

		$pdf->cell(15,6,'pH',1,0,'C',0);
		$pdf->cell(70,6,'Chloride',1,0,'C',0);
		$pdf->cell(55,6,'TH',1,0,'C',0);
		
		
	//	$pdf->cell(15,6,'',1,0,'C',1);
        $pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
		$pdf->cell(25,6,'',1,0,'C',0);
		$pdf->Ln();
		
		$pdf->cell(10,6,'',1,0,'C',0);    
        $pdf->cell(25,6,'',1,0,'C',0);  
        $pdf->cell(25,6,'',1,0,'C',0); 
		
		$pdf->cell(15,6,'',1,0,'C',0);
			
		$pdf->cell(45,6,'Titran AgNo.3',1,0,'C',0);
		$pdf->cell(25,6,'HasilChloride',1,0,'C',0);
		$pdf->cell(30,6,'Titran EDTA',1,0,'C',0);
		$pdf->cell(25,6,'Hasil th (ppm)',1,0,'C',0);
		
	//	$pdf->cell(15,6,'',1,0,'C',1);
        $pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,' ',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,' ',1,0,'C',0);
		$pdf->cell(25,6,'',1,0,'C',0);
		$pdf->Ln();
		
		$pdf->cell(10,6,'',1,0,'C',0);    
        $pdf->cell(25,6,'',1,0,'C',0);  
        $pdf->cell(25,6,'',1,0,'C',0);  
		
		$pdf->cell(15,6,'',1,0,'C',0);
		
		$pdf->cell(15,6,'mL(s)',1,0,'C',0);
        $pdf->cell(15,6,'mL(b)',1,0,'C',0);
        $pdf->cell(15,6,'N',1,0,'C',0);
		$pdf->cell(25,6,'(ppm)',1,0,'C',0);
		
		
		$pdf->cell(15,6,'mL.3',1,0,'C',0);
		$pdf->cell(15,6,'M',1,0,'C',0);
		$pdf->cell(25,6,'TH(ppm)',1,0,'C',0);
		
	//	$pdf->cell(15,6,'',1,0,'C',1);
        $pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,' ',1,0,'C',0);
        $pdf->cell(25,6,'',1,0,'C',0);
        $pdf->cell(25,6,' ',1,0,'C',0);
		$pdf->cell(25,6,'',1,0,'C',0);
		$pdf->Ln();
		
     

        $no=1;
               

        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','',10);
        $pdf->cell(10,6,$no, 1,'L');
        //$pdf->cell(5,6,$row1->detail_id, 1,'L');
		
        $pdf->cell(25,6,$row1->kode_sample, 1,'L');
        $pdf->cell(25,6,$row1->jam_sampling, 1,'L');
        $pdf->cell(15,6,$row1->ap_ph, 1,'L');
        $pdf->cell(15,6,$row1->cl_mls, 1,'L');
        $pdf->cell(15,6,$row1->cl_mlb, 1,'L');
        $pdf->cell(15,6,$row1->cl_n, 1,'L');
        $pdf->cell(25,6,$row1->cl_hppm, 1,'L');
        $pdf->cell(15,6,$row1->th_ml, 1,'L');
        $pdf->cell(15,6,$row1->th_m, 1,'L');
        $pdf->cell(25,6,$row1->th_hppm, 1,'L');
        /*$pdf->cell(10,6,$row1->ap_fci, 1,'L');*/
        $pdf->cell(15,6,$row1->tds, 1,'L');
        $pdf->cell(15,6,$row1->color, 1,'L');
        $pdf->cell(25,6,$row1->turbidity, 1,'L');
        
        $pdf->cell(25,6,$row1->residual_ozon, 1,'L');
        $pdf->cell(25,6,$row1->odour_taste, 1,'L');
        $pdf->cell(25,6,$row1->analisis_oleh, 1,'L');
        //$pdf->cell(10,6,$row1->headerid, 1,'L');
        $pdf->cell(25,6,$row1->remarks, 1,'L');
       
        $pdf->Ln();
        $no++;   
        }
		 foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
		}
		$pdf->SetFont('Arial','',8);
		$pdf->cell(305,6, $frmefec,1,0,'L',0);
        $pdf->cell(50,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),290,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
         $pdf->Ln();
		$pdf->Output($frmkode.'.pdf','I');
        }else{}
      break;
     
        
      case $frmkode=="frmnon006":
	  if ($filekd=="export"){
		 $logor='assets/images/rlogopsg.png';
        $title="PT.PULAU SAMBU GUNTUNG";
		$pdf->AddPage('L','A4');
		$a=$pdf->Image($logor,10,10,30,25);
		$dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true); 
		  
		  
		$pdf->SetFillColor(230,230,230,230);
		$pdf->SetFont('Arial','B',10);
		$pdf->cell(30, 25, $a,1,0,'C',0);
		
		
		
		 
		$pdf->cell(215, 25, $title, 1,0,'C',0);
		
		$pdf->SetFont('Arial','',7);
		$dtproduct=$this->$model->get_header_byid($id);
		foreach($dtproduct as $dtprd){
		$dok=$dtprd->dok;
	
		$pdf->cell(40, 25, 'Dok: '.$dok.'', 1,0,'L',0);
		}
		$pdf->Ln();
		$pdf->SetFont('Arial','',7);
		$pdf->cell(30,6, 'JUDUL',1,0,'C',0);
		
		$pdf->cell(215,6, $frmjdl, 1,0,'C',0);
		
		$dtproduct=$this->$model->get_header_byid($id);
		foreach($dtproduct as $dtprd){
		$tanggal=$dtprd->tanggal;
		$pdf->cell(40, 6,'Product: '.$tanggal.'', 1,0,'L',0);
		}		
		$pdf->Ln(6);
		  
       
        //line1
        $pdf->cell(10,6,'No.',1,0,'C',0); 
        $pdf->cell(20,6,'Kode Sampel',1,0,'C',0); 
        $pdf->cell(20,6,'Jam Sampling',1,0,'C',0);             
        $pdf->cell(235,6,'Ananlysis Parameters',1,0,'C',0);     
		$pdf->Ln();
		 //line2
		$pdf->cell(10,6,'',1,0,'C',0);  
        $pdf->cell(20,6,'',1,0,'C',0);
        $pdf->cell(20,6,'',1,0,'C',0);
		
        $pdf->cell(10,6,'pH',1,0,'C',0);
        $pdf->cell(35,6,'TA(ppm)20 max',1,0,'C',0);
		$pdf->cell(50,6,'SULFIT 10-60 ppm',1,0,'C',0);
		$pdf->cell(15,6,'PHOSPAT',1,0,'C',0);
        $pdf->cell(15,6,'TDS 20max',1,0,'C',0);
		
		$pdf->cell(35,6,'TH(ppm)20 max',1,0,'C',0);
		
		$pdf->cell(15,6,'Colour',1,0,'C',0);
		$pdf->cell(20,6,'Odour and',1,0,'C',0);
		$pdf->cell(20,6,'Analis',1,0,'C',0);
		$pdf->cell(20,6,'Remarks',1,0,'C',0);
		$pdf->Ln();
		
		//line3
		$pdf->cell(10,6,'',1,0,'C',0); 
        $pdf->cell(20,6,'',1,0,'C',0);
		$pdf->cell(20,6,'',1,0,'C',0);
		$pdf->cell(10,6,'',1,0,'C',0);
        $pdf->cell(20,6,'Titran HCL',1,0,'C',0);
		$pdf->cell(15,6,'Hasil(ppm)',1,0,'C',0);
		
		$pdf->cell(35,6,'Titran KIO3',1,0,'C',0);
        $pdf->cell(15,6,'Hasil(ppm)',1,0,'C',0);
		
		$pdf->cell(15,6,'10-60 ppm',1,0,'C',0);
		$pdf->cell(15,6,'(ppm)',1,0,'C',0);
		
		$pdf->cell(20,6,'Titran EDTA',1,0,'C',0);
		$pdf->cell(15,6,'Hasil(ppm)',1,0,'C',0);
		$pdf->cell(15,6,'(Clear)',1,0,'C',0);
		$pdf->cell(20,6,'Taste (Normal)',1,0,'C',0);
		$pdf->cell(20,6,'',1,0,'C',0);
		$pdf->cell(20,6,'',1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(10,6,'',1,0,'C',0); 
        $pdf->cell(20,6,'',1,0,'C',0);
		$pdf->cell(20,6,'',1,0,'C',0);
		$pdf->cell(10,6,'',1,0,'C',0);
        $pdf->cell(10,6,'mL',1,0,'C',0);
		$pdf->cell(10,6,'N',1,0,'C',0);
		$pdf->cell(15,6,'',1,0,'C',0);
		
		$pdf->cell(10,6,'mLs',1,0,'C',0); 
        $pdf->cell(10,6,'mlb',1,0,'C',0);
		$pdf->cell(15,6,'M',1,0,'C',0);
		$pdf->cell(15,6,'',1,0,'C',0);
		
		$pdf->cell(15,6,'',1,0,'C',0);
		$pdf->cell(15,6,'',1,0,'C',0);
		
		$pdf->cell(10,6,'mL',1,0,'C',0);
		$pdf->cell(10,6,'M',1,0,'C',0);
		$pdf->cell(15,6,'',1,0,'C',0);
		$pdf->cell(15,6,'',1,0,'C',0);
		$pdf->cell(20,6,'',1,0,'C',0);
		$pdf->cell(20,6,'',1,0,'C',0);
		$pdf->cell(20,6,'',1,0,'C',0);
		$pdf->Ln();
		
		
		
        $no=1;
      
        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','',7);
        $pdf->cell(10,6,$no, 1,'L');     
        $pdf->cell(20,6,$row1->kd_sampel, 1,'L');
        $pdf->cell(20,6,$row1->jam_sampling, 1,'L');
        $pdf->cell(10,6,$row1->ph, 1,'L');
        $pdf->cell(10,6,$row1->ta_ml, 1,'L');
        $pdf->cell(10,6,$row1->ta_n, 1,'L');
        $pdf->cell(15,6,$row1->ta_ppm, 1,'L');
        $pdf->cell(10,6,$row1->sulfit_mls, 1,'L');     
        $pdf->cell(10,6,$row1->sulfit_mlb, 1,'L');
        $pdf->cell(15,6,$row1->sulfit_m, 1,'L');
        $pdf->cell(15,6,$row1->sulfit_ppm, 1,'L');
        $pdf->cell(15,6,$row1->phospat, 1,'L');
        $pdf->cell(15,6,$row1->tds, 1,'L');
        $pdf->cell(10,6,$row1->th_ml, 1,'L');
        $pdf->cell(10,6,$row1->th_m, 1,'L');
        $pdf->cell(15,6,$row1->th_ppm, 1,'L');
        $pdf->cell(15,6,$row1->colour, 1,'L');
        $pdf->cell(20,6,$row1->odour, 1,'L');
		$pdf->cell(20,6,$row1->analis_by, 1,'L');
        $pdf->cell(20,6,$row1->remarks, 1,'L');
            
       
        $pdf->Ln();
        $no++;   
        }
         foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
		$pdf->SetFont('Arial','',8);
		$pdf->cell(245,6,'Mulai Berlaku:'.$frmefec.'',1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
		
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),285,$pdf->GetY());
        $pdf->SetFont('Arial','I',7);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');  
        }else{}
		
		break;
		case $frmkode=="intqad078":
		if ($filekd=="export"){
		$pdf->AddPage('L','A3');
		$logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";	    
		$a=$pdf->Image($logor,10,10,30,25);
		$dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
		 //$pdf->SetFillColor(230,230,230,230); 
		$pdf->SetFillColor(230,230,230,230);
		$pdf->SetFont('Arial','B',10);
		$pdf->cell(30, 25, $a,1,0,'C',0);
		
		
		
		 
		$pdf->cell(315, 25, $title, 1,0,'C',0);
		 $pdf->SetFont('Arial','',10);
		
		
	
		$dtheader1=$this->$model->get_header_byid($id);
		 foreach ($dtheader1 as $dthdr1 ){
		 $dokumen=$dthdr1->dokumen;
		
	
		$pdf->cell(45, 25, 'DOK.:'.$dokumen.'',1,0,'L',0);
		}
		
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30,6, 'JUDUL',1,0,'C',0);
		
		$pdf->cell(315,6, $frmjdl, 1,0,'C',0);
		
		$dtheader1=$this->$model->get_header_byid($id);
		 foreach ($dtheader1 as $dthdr1 ){
		 $tgl_dok=$dthdr1->tgl_dok;
		$pdf->cell(45, 6, 'TGL.:'.$tgl_dok.'', 1,0,'L',0);
		}		
		$pdf->Ln();
		
		$pdf->SetFillColor(230,230,230,230);
		$pdf->setFont('Arial','B',10);  
		
		 $pdf->cell(390,6,"ANALYSIS PARAMETER",1,0,'C',0);
                
                $pdf->Ln(1);
                $pdf->cell(390,6,'',0,0,0,0);
                $pdf->Ln(4);
                
                $pdf->SetFillColor(230,230,230,230);
                $pdf->setFont('Arial','B',8);  
                $pdf->cell(30,30,'Tanggal',1,0,'C',0);
                $pdf->cell(30, 30, 'Kode Sample',1,0,'C',0);
                $pdf->cell(30, 30, 'Jam Sampling',1,0,'C',0);
                $pdf->cell(10,24, '  pH',1,0,'C',0);
                $pdf->cell(70,18, 'Cloride Titran AgNo3',1,0,'C',0);
				$pdf->cell(30,30, 'TDS (ppm)',1,0,'C',0);
				
				
				$pdf->cell(70, 18, 'TH', 1,0,'C',0);
				$pdf->cell(30, 18, 'FCI (ppm)',1,0,'C',0);
				$pdf->cell(30, 18, 'TCL (ppm)',1,0,'C',0);
				$pdf->cell(30, 18, 'Color (PtCo)',1,0,'C',0);
				$pdf->cell(30, 18, 'Paraf Analis',1,0,'C',0);
				$pdf->Ln();
				$pdf->cell(90, 6,'',0,0,'C',0);
				$pdf->cell(10,6, ' ',0,0,'C',0);
				$pdf->cell(40, 6,'Titran AgNo3',1,0,'C',0);
				$pdf->cell(30, 6,'Hasil (ppm)',1,0,'C',0);
				
				$pdf->cell(30,6, '',0,0,'C',0);
				
				$pdf->cell(40, 6, 'Titran EDTA',1,0,'L',0);
				$pdf->cell(30, 6,'Hasil (ppm)',1,0,'C',0);
				$pdf->cell(30, 6,'',1,0,'C',0);
				$pdf->cell(30, 6,'',1,0,'C',0);
				$pdf->cell(30, 6,'',1,0,'C',0);
				$pdf->cell(30, 6,'',1,0,'C',0);
				
				$pdf->Ln();
				$pdf->cell(30, 6,'',0,0,'C',0);
				$pdf->cell(30, 6,'',0,0,'C',0);
				$pdf->cell(30, 6,'',0,0,'C',0);
				
				
				$pdf->cell(10,6, ' ',1,0,'C',0);
				$pdf->cell(13, 6,'mL(s)',1,0,'C',0);
				$pdf->cell(13, 6,'N',1,0,'C',0);
				$pdf->cell(14, 6,'mL(s)',1,0,'C',0);
				
				$pdf->cell(30,6, '',1,0,'C',0);
				
				$pdf->cell(30,6, '',0,0,'C',0);
				
				$pdf->cell(20, 6, 'mL',1,0,'L',0);
				$pdf->cell(20, 6,'N',1,0,'C',0);
				$pdf->cell(30, 6,'',1,0,'C',0);
				$pdf->cell(30, 6,'',1,0,'C',0);
				$pdf->cell(30, 6,'',1,0,'C',0);
				$pdf->cell(30, 6,'',1,0,'C',0);
				$pdf->cell(30, 6,'',1,0,'C',0);
				
				$pdf->Ln(1);
				
		
        $pdf->Ln();

        $no=1;
      
        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','',8);
        // $pdf->cell(9,6,$no, 1,'L');     
        $pdf->cell(30,6,$row1->tgl_dok, 1,'L');
        
        $pdf->cell(30,6,$row1->kode_sample, 1,'L');
		$pdf->cell(30,6,$row1->jam_sampling, 1,'L');
        $pdf->cell(10,6,$row1->ph, 1,'L');
        $pdf->cell(13,6,$row1->chloride_ml_s, 1,'L');
        $pdf->cell(13,6,$row1->chloride_ml_b, 1,'L');
      
        $pdf->cell(14,6,$row1->chloride_n, 1,'L');
        
        $pdf->cell(30,6,$row1->hasil_chloride, 1,'L');
        $pdf->cell(30,6,$row1->tds, 1,'L');
        
        $pdf->cell(20,6,$row1->th_ml_s, 1,'L');
        $pdf->cell(20,6,$row1->th_m, 1,'L');
        $pdf->cell(30,6,$row1->hasil_th, 1,'L');    
        $pdf->cell(30,6,$row1->fci, 1,'L');
        $pdf->cell(30,6,$row1->tcl, 1,'L');
        $pdf->cell(30,6,$row1->colour, 1,'L');
        // $pdf->cell(15,6,$row1->turbidity, 1,'L');
        $pdf->cell(30,6,$row1->dilakukan_oleh, 1,'L');
            
       
        $pdf->Ln();
        $no++;   
        }
	  foreach($dtfrm as $dt_form){
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
		}
		$pdf->SetFont('Arial','',8);
		$pdf->cell(360,6, $frmefec,1,0,'L',0);
        $pdf->cell(30,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');  
        }else{}
		
		
		break;
		case  $frmkode=="intqad068":
		if ($filekd=="export"){
    
        $logor='assets/images/rlogopsg.png';
        $title="PT.PULAU SAMBU GUNTUNG";
        $pdf->AddPage('L','A3');
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true); 

        $pdf->SetFillColor(230,230,230,230);
        $pdf->SetFont('Arial','B',8);
        $pdf->cell(30, 25, $a,1,0,'C',0);
        $pdf->cell(320, 25, $title, 1,0,'C',0);
        $dtheader1=$this->$model->get_header_byid($id);
        foreach($dtheader1 as $dthdr1){
        $tgl_data=$dthdr1->tgl_data;
        $pdf->cell(40, 25, 'Tanggal :'.$tgl_data.'',1,0,'L',0);
        }


        
        $pdf->Ln();
        $pdf->cell(30, 6, 'JUDUL', 1,0,'C',0);
        $pdf->cell(360, 6, $frmjdl, 1,0,'C',0);

        $pdf->Ln();
        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
       
      
        $pdf->cell(10,12,'No.',1,0,'C',0); 
        $pdf->cell(50,12,'Kode Sampling Point',1,0,'C',0); 
        $pdf->cell(35,12,'Waktu Sampling',1,0,'C',0);             
        $pdf->cell(50,12,'Analisis',1,0,'C',0);    
        $pdf->cell(25,12,'Line',1,0,'C',0);   
        $pdf->cell(25,12,'Shift',1,0,'C',0);      
        $pdf->cell(80,6,'Hasil Analisa',1,0,'C',0);
        $pdf->cell(65,6,'Pembacaan',1,0,'C',0);     
      
        $pdf->cell(50,12,'Keterangan',1,0,'C',0);  
		$pdf->cell(0.5,6,'',0,0,'C',0);
        $pdf->Ln();
        $pdf->cell(10,6,'',0,0,'C',0); 
        $pdf->cell(50,6,'',0,0,'C',0); 
        $pdf->cell(35,6,'',0,0,'C',0);             
        $pdf->cell(50,6,'',0,0,'C',0);    
        $pdf->cell(25,6,'',0,0,'C',0);   
        $pdf->cell(25,6,'',0,0,'C',0); 
        
        $pdf->cell(20,6,'TPC',1,0,'C',0); 
        $pdf->cell(20,6,'Entero',1,0,'C',0); 
        $pdf->cell(20,6,'Yeast',1,0,'C',0); 
        $pdf->cell(20,6,'Mould',1,0,'C',0); 
        
        $pdf->cell(35,6,'Oleh',1,0,'C',0); 
        $pdf->cell(30,6,'Tanggal',1,0,'C',0); 
        $pdf->cell(50,6,'',0,0,'C',0); 
		$pdf->cell(0.5,6,'',0,0,'C',0);
		
        $pdf->Ln();
    
        $no=1;
      
        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','',10);
        $pdf->cell(10,6,$no, 1,'L');     
        $pdf->cell(50,6,$row1->kd_samplingpoint, 1,'L'); 
        $pdf->cell(35,6,$row1->wkt_sampling, 1,'L');
        $pdf->cell(50,6,$row1->analis, 1,'L');
        $pdf->cell(25,6,$row1->line, 1,'L');
        $pdf->cell(25,6,$row1->shift, 1,'L');
      
        $pdf->cell(20,6,$row1->ha_tpc, 1,'L');
        $pdf->cell(20,6,$row1->ha_entero, 1,'L');
        $pdf->cell(20,6,$row1->ha_yeast, 1,'L');
        $pdf->cell(20,6,$row1->ha_mould, 1,'L');
    
        $pdf->cell(35,6,$row1->pbc_oleh, 1,'L');
        $pdf->cell(30,6,$row1->pbc_tgl, 1,'L');
        $pdf->cell(50,6,$row1->keterangan, 1,'L');
       
        $pdf->Ln();
		
        $no++;   
        }
		$pdf->Ln();
	$pdf->SetFont('Arial','',10);	
	$pdf->cell(77,6,'Sampling Point',1,0,'C',0); 
	$pdf->cell(20,6,'Kode',1,0,'C',0);
	$pdf->cell(77,6,'Sampling Point',1,0,'C',0);
	$pdf->cell(20,6,'Kode',1,0,'C',0);
	$pdf->cell(77,6,'Sampling Point',1,0,'C',0);
	$pdf->cell(20,6,'kode',1,0,'C',0);
	$pdf->cell(77,6,'Sampling Point',1,0,'C',0);
	$pdf->cell(22,6,'kode',1,0,'C',0);
	$pdf->Ln();
	$pdf->cell(77,6,'DRP :',1,0,'C',0); 
	$pdf->cell(20,6,' ',1,0,'C',0);
	$pdf->cell(77,6,'CMP :',1,0,'C',0);
	$pdf->cell(20,6,' ',1,0,'C',0);
	$pdf->cell(77,6,'CPS :',1,0,'C',0);
	$pdf->cell(20,6,' ',1,0,'C',0);
	$pdf->cell(77,6,'WTP :',1,0,'C',0);
	$pdf->cell(22,6,' ',1,0,'C',0);
	
	$pdf->Ln();
	
	$pdf->cell(77,6,'BFR Inspection Table ',1,0,'C',0); 
	$pdf->cell(20,6,'IT ',1,0,'C',0);
	$pdf->cell(77,6,'Filling Room :',1,0,'C',0);
	$pdf->cell(20,6,'FR ',1,0,'C',0);
	$pdf->cell(77,6,'Unloading Area :',1,0,'C',0);
	$pdf->cell(20,6,'UA ',1,0,'C',0);
	$pdf->cell(77,6,'Mesin..... :',1,0,'C',0);
	$pdf->cell(22,6,'Mesin..... ',1,0,'C',0);
	$pdf->Ln();
	$pdf->cell(77,6,'BFR Bagging Area ',1,0,'C',0); 
	$pdf->cell(20,6,'BA ',1,0,'C',0);
	$pdf->cell(77,6,'Fluidizer Room :',1,0,'C',0);
	$pdf->cell(20,6,'FDR ',1,0,'C',0);
	$pdf->cell(77,6,'Filling Area :',1,0,'C',0);
	$pdf->cell(20,6,'FA ',1,0,'C',0);
	$pdf->cell(77,6,'Catatan nama mesin..... :',1,0,'C',0);
	$pdf->cell(22,6,'',1,0,'C',0);
	
	$pdf->Ln();
	$pdf->cell(77,6,'Dry Discharge ',1,0,'C',0); 
	$pdf->cell(20,6,'DD ',1,0,'C',0);
	$pdf->cell(77,6,'Cooling Room :',1,0,'C',0);
	$pdf->cell(20,6,'CR ',1,0,'C',0);
	$pdf->cell(77,6,'Packing Area :',1,0,'C',0);
	$pdf->cell(20,6,'PA ',1,0,'C',0);
	$pdf->cell(77,6,' ',1,0,'C',0);
	$pdf->cell(22,6,'',1,0,'C',0);
	$pdf->Ln();
	
	
		
      foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
      }
        $pdf->SetFont('Arial','',8);
        $pdf->cell(350,6,'Mulai Berlaku : '.$frmefec.'',1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');  
        }else{}
         break;
		
		
	     case $frmkode=="intqad066":
    		if ($filekd=="export"){
    		$pdf->AddPage('L','A3');
    		$logor="assets/images/rlogopsg.png";
            $title="PT.PULAU SAMBU GUNTUNG";	    
    		$a=$pdf->Image($logor,10,10,30,25);
    		$dates="Printed Date : ". date('d/m/y');
            $pdf->SetAutoPageBreak(true);  
    		 //$pdf->SetFillColor(230,230,230,230); 
    		$pdf->SetFillColor(110,180,230);
    		$pdf->SetFont('Arial','B',10);
    		$pdf->cell(30, 25, $a,1,0,'C',0);
    		$dtheader1=$this->$model->get_header_byid($id);
    		
    		 
    		$pdf->cell(295, 25, $title, 1,0,'C',0);
    		 $pdf->SetFont('Arial','B',10);
    		
    		
    	
    		foreach($dtheader1 as $dthdr1){
    		$tgl_sampling=$dthdr1->tgl_sampling;
    		$pdf->cell(70, 25, 'Tgl Sampling :'.$tgl_sampling.'',1,0,'L',0);
    		}
    		$pdf->cell(0.5, 25, '',0,0,'L',0);
    			
    		
    		$pdf->Ln();
    		$pdf->SetFont('Arial','',10);
    		$pdf->cell(30,6, 'JUDUL',1,0,'C',0);
    		
    		$pdf->cell(295,6, $frmjdl, 1,0,'C',0);
    		
    		foreach($dtheader1 as $dthdr1){
    		$lokasi_sampling=$dthdr1->lokasi_sampling;
    		$pdf->cell(70, 6, 'Product:'.$lokasi_sampling.'', 1,0,'L',0);
    		}
    		$pdf->cell(0.5, 6, '',0,0,'L',0);
    		$pdf->Ln();
           
    	   
      
    		
    		$pdf->cell(10,18,'No.',1,0,'C',0);
    		$pdf->cell(20,18, 'No.Lab',1,0,'C',0);
    		 $pdf->cell(105,18, 'Sampling Point',1,0,'C',0);
    		 $pdf->cell(60,6, 'Sampling ',1,0,'C',0);
    		 
    		 $pdf->cell(15,18, 'Shift',1,0,'C',0);
    		 $pdf->cell(30,18,'Dianalisa oleh',1,0,'C',0);
             $pdf->cell(105,6,'Hasil Analisa',1,0,'C',0);  
             $pdf->cell(50,6,'Dilaporkan ',1,0,'C',0);  
    		 $pdf->cell(0.5, 6, '',0,0,'L',0);
    		 //$pdf->cell(45,6,'Area ',1,0,'C',0);  
    		 $pdf->Ln();
    		 
    		 $pdf->cell(10,6,'',0,0,'C',0);
    		 $pdf->cell(20,6, '',0,0,'C',0);
    		 $pdf->cell(105,6, '',0,0,'C',0);
    		 $pdf->cell(30,12, 'Jam',1,0,'C',0);
    		 $pdf->cell(30,12, 'Analis',1,0,'C',0);
    		 $pdf->cell(15,6, '',0,0,'C',0);
    		 
    		 $pdf->cell(30,6,'',0,0,'C',0);
             $pdf->cell(15,12,'TPC',1,0,'C',0);  
             $pdf->cell(15,12,'Entero ',1,0,'C',0); 
    		 $pdf->cell(30,6,'E.coli ',1,0,'C',0);
    		 $pdf->cell(45,6,'salmonela ',1,0,'C',0);		 
    		 $pdf->cell(25,12,'Oleh ',1,0,'C',0); 
    		 $pdf->cell(25,12,'Tgl ',1,0,'C',0); 
    		 $pdf->cell(0.5, 6, '',0,0,'L',0);
    		 $pdf->Ln();
    		 
    		 $pdf->cell(10,6,'',0,0,'C',0);
    		 $pdf->cell(20,6, '',0,0,'C',0);
    		 $pdf->cell(105,6, '',0,0,'C',0);
    		 $pdf->cell(30,6, '',0,0,'C',0);
    		 $pdf->cell(30,6, '',0,0,'C',0);
    		 $pdf->cell(15,6, '',0,0,'C',0);
    		 
    		 $pdf->cell(30,6,'',0,0,'C',0);
             $pdf->cell(15,6,'',0,0,'C',0);  
             $pdf->cell(15,6,' ',0,0,'C',0);
    		 
    		 
    		 $pdf->cell(15,6,'Gas ',1,0,'C',0);  
    		 $pdf->cell(15,6,'Indol ',1,0,'C',0);  
    		 $pdf->cell(15,6,'HE ',1,0,'C',0);  
    		 $pdf->cell(15,6,'XLD ',1,0,'C',0);  
    		 $pdf->cell(15,6,'BSA ',1,0,'C',0); 
    		 $pdf->cell(25,6,' ',0,0,'C',0); 
    		 $pdf->cell(25,6,' ',0,0,'C',0); 
    		 $pdf->cell(0.5, 6, '',0,0,'L',0);
    		 
    		// $pdf->cell(45,6,'',1,0,'C',0); 
    		 $pdf->Ln();
    		 
    		 
            $no=1;
          
            foreach ($datadtl as $row1){             
               
            $pdf->SetFont('Arial','',10);
            $pdf->cell(10,6,$no, 1,'L');     
    		$pdf->cell(20,6,$row1->no_lab,1,'L');
    		
    		$pdf->cell(45,6,$row1->area ,1); 
    		$pdf->cell(60,6,$row1->sampling_point, 1,'L');  
    		$pdf->cell(30,6,$row1->sampling_jam, 1,'L');
    		
    		$pdf->cell(30,6,$row1->sampling_analis, 1,'L');
    		
            
            $pdf->cell(15,6,$row1->shift, 1,'L');
    		$pdf->cell(30,6,$row1->dianalisa_oleh, 1,'L');
    		
    		if($row1->operator2=='0'){
    			$operator2="<";
    		}
    			elseif($row1->operator2=='1'){
    				$operator2=">";
    			}
    			else{ $operator2="";}
    		
    		
    		$pdf->cell(15,6,$operator2.''.$row1->ha_tpc, 1,'L');
    		if($row1->operator=='0'){
    			$operator="<";
    		}
    			elseif($row1->operator=='1'){
    				$operator=">";
    			}
    			else{ $operator="";}
    		$pdf->cell(15,6,$operator.''.$row1->ha_entero, 1,'L');
    		$pdf->cell(15,6,$row1->ha_ecoli_gas, 1,'L');
    		$pdf->cell(15,6,$row1->ha_ecoli_indol, 1,'L');
    		$pdf->cell(15,6,$row1->ha_salmonella_he, 1,'L');
    		$pdf->cell(15,6,$row1->ha_salmonella_xld, 1,'L');
    		$pdf->cell(15,6,$row1->ha_salmonella_bsa, 1,'L');
    		
    		$pdf->cell(25,6,$row1->dilaporkan_oleh, 1,'L');
    		$pdf->cell(25,6,$row1->dilaporkan_tgl, 1,'L');
    		$pdf->cell(0.5, 6, '',0,0,'L',0);
    		
    		 
    		
            $pdf->Ln();
            $no++;   
    		
            }
    		
    		  foreach($dtfrm as $dt_form){
          $frmefec  = $dt_form->formefective;
          $frmnm    = $dt_form->formnm;
         
          }
    		$pdf->SetFont('Arial','',8);
    		$pdf->cell(360,6,'Mulai Berlaku : ' .$frmefec,1,0,'L',0);
            $pdf->cell(35,6, $frmnm, 1,0,'R',0); 
    		$pdf->cell(0.5, 6, '',0,0,'L',0);
    		
          
            $pdf->SetY(-10);
            $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
            $pdf->SetFont('Arial','I',8);
            $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
            $pdf->Ln();
            $pdf->Output($frmkode.'.pdf','I');  
            }else{}
		break;			
		
		// case $frmkode=="frmfss115":
		// if ($filekd=="export"){
		// $pdf->AddPage('L','A3');
        // $logor="assets/images/rlogopsg.png";
        // $title="PT.PULAU SAMBU GUNTUNG";        
        // $pdf->Image($logor,10,10,30,25);
        // $dates="Printed Date : ". date('d/m/y');
        // $pdf->SetAutoPageBreak(true);  
        
        // $pdf->cell(30);
        // $pdf->setFont('Arial','B',14);        
        // $pdf->cell(0,10,$title,0,1,'L');
        // $pdf->cell(30);
        // $pdf->setFont('Arial','B',12);  
        // $pdf->Cell(0, 10, $frmjdl, 0, 1, 'L');
        // $pdf->cell(30);     
        // $pdf->cell(0,3,$dates,0,1,'L');        
        // $pdf->cell(30);
        // $pdf->setFont('Arial','B',12); 
        // $pdf->cell(0,2," ",0,2,'L');       
        // $pdf->SetLineWidth(1);
        // $pdf->Line(10,36,415,36);
        // $pdf->SetLineWidth(0);
        // $pdf->Line(10,36,415,36);
        // $pdf->Ln(4); 
        // $pdf->SetFillColor(110,180,230);
        // $pdf->SetFont('Arial','',7);
       
      
        // $pdf->cell(9,6,'No.',1,0,'C',1); 
        // $pdf->cell(23,6,'tgl_produksi',1,0,'C',1); 
        // $pdf->cell(23,6,'jenis_produk',1,0,'C',1);             
       //$pdf->cell(23,6,'sampling_tgl',1,0,'C',1);    
	    // $pdf->cell(23,6,'completedate',1,0,'C',1);   
        // $pdf->cell(23,6,'completetime',1,0,'C',1);      
        // $pdf->cell(20,6,'c.by',1,0,'C',1);
		
        // $pdf->cell(15,6,'jam',1,0,'C',1);  
        // $pdf->cell(35,6,'deskripsi_nc',1,0,'C',1);  
      // $pdf->cell(15,6,'s_analis',1,0,'C',1);    
        
        // $pdf->cell(20,6,'proposal_da',1,0,'C',1);    
        // $pdf->cell(20,6,'waktu_at',1,0,'C',1); 
        
        
        // $pdf->cell(15,6,'at_oleh',1,0,'C',1); 
        // $pdf->cell(15,6,'w.verifikasi',1,0,'C',1); 
        // $pdf->cell(15,6,'h.verifikasi',1,0,'C',1);      
        // $pdf->cell(17,6,'diverifikasi_oleh',1,0,'C',1); 
        
        // $pdf->cell(14,6,'app1_by',1,0,'C',1); 
     //   $pdf->cell(10,6,'hsal_xld',1,0,'C',1); 
	//	$pdf->cell(10,6,'hsal_bsa',1,0,'C',1); 
		// $pdf->cell(17,6,'app1_date',1,0,'C',1);
		// $pdf->cell(17,6,'app1_position',1,0,'C',1);
		
        // $pdf->cell(17,6,'app1_status',1,0,'C',1);
		// $pdf->cell(17,6,'app2_by',1,0,'C',1);
		// $pdf->cell(17,6,'app2_date',1,0,'C',1);
		// $pdf->cell(17,6,'app2_position',1,0,'C',1);
		// $pdf->cell(17,6,'app2_status',1,0,'C',1);
		// $pdf->cell(18,6,'app3_by',1,0,'C',1);
		// $pdf->cell(18,6,'app3_date',1,0,'C',1);
		// $pdf->cell(18,6,'app3_position',1,0,'C',1);
		// $pdf->cell(18,6,'app3_status',1,0,'C',1);
	   // $pdf->cell(17,6,'bagian',1,0,'C',1);
		
		
      
        
    
        // $pdf->Ln();

        // $no=1;
      
        // foreach ($datadtl as $row1){             
           
        // $pdf->SetFont('Arial','',7);
        // $pdf->cell(9,6,$no, 1,'L');     
        // $pdf->cell(23,6,$row1->tgl_produksi, 1,'L');
        // $pdf->cell(23,6,$row1->jenis_produk, 1,'L');
       // $pdf->cell(23,6,$row1->sampling_tgl, 1,'L');
        // $pdf->cell(23,6,$row1->completedate, 1,'L');
        // $pdf->cell(23,6,$row1->completetime, 1,'L');
        // $pdf->cell(20,6,$row1->completeby, 1,'L');
       
        
        // $pdf->cell(15,6,$row1->jam, 1,'L');       
        // $pdf->cell(35,6,$row1->deskripsi_nc, 1,'L');
            
        // $pdf->cell(20,6,$row1->proposal_da, 1,'L');
        // $pdf->cell(20,6,$row1->waktu_at, 1,'L');
        
        // $pdf->cell(15,6,$row1->at_oleh, 1,'L');
        // $pdf->cell(15,6,$row1->waktu_verifikasi, 1,'L');
        // $pdf->cell(15,6,$row1->hasil_verifikasi, 1,'L');		
        // $pdf->cell(17,6,$row1->diverifikasi_oleh, 1,'L');
		
        // $pdf->cell(14,6,$row1->app1_by, 1,'L');
		// $pdf->cell(17,6,$row1->app1_date, 1,'L');
		// $pdf->cell(17,6,$row1->app1_position, 1,'L');
        // $pdf->cell(17,6,$row1->app1_status, 1,'L');
		// $pdf->cell(17,6,$row1->app2_by, 1,'L');
        // $pdf->cell(17,6,$row1->app2_date, 1,'L');
		// $pdf->cell(17,6,$row1->app2_position, 1,'L');
		// $pdf->cell(17,6,$row1->app2_status, 1,'L');
		// $pdf->cell(18,6,$row1->app3_by, 1,'L');
        // $pdf->cell(18,6,$row1->app3_date, 1,'L');
		// $pdf->cell(18,6,$row1->app3_position, 1,'L');
		// $pdf->cell(18,6,$row1->app3_status, 1,'L');
		// $pdf->cell(17,6,$row1->bagian, 1,'L');
		
		
		
		
        // $pdf->Ln();
        // $no++;   
        // }
      
        // $pdf->SetY(-10);
        // $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        // $pdf->SetFont('Arial','I',8);
        // $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        // $pdf->Ln();
        // $pdf->Output($frmkode.'.pdf','I');  
        // }else{}
		// break;
		
        case $frmkode=="frmlqs083":
		if ($filekd=="export"){
		$pdf->AddPage('L','A3');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
        
        $pdf->cell(30);
        $pdf->setFont('Arial','B',14);        
        $pdf->cell(0,10,$title,0,1,'L');
        $pdf->cell(30);
        $pdf->setFont('Arial','B',12);  
        $pdf->Cell(0, 10, $frmjdl, 0, 1, 'L');
        $pdf->cell(30);     
        $pdf->cell(0,3,$dates,0,1,'L');        
        $pdf->cell(30);
        $pdf->setFont('Arial','B',12); 
        $pdf->cell(0,2," ",0,2,'L');       
        $pdf->SetLineWidth(1);
        $pdf->Line(10,36,415,36);
        $pdf->SetLineWidth(0);
        $pdf->Line(10,36,415,36);
        $pdf->Ln(4); 
        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',8);
       
      
        $pdf->cell(9,6,'No.',1,0,'C',1); 
        $pdf->cell(23,6,'tgl_produksi',1,0,'C',1); 
        $pdf->cell(50,6,'jenis_produk',1,0,'C',1);             
      //  $pdf->cell(23,6,'sampling_tgl',1,0,'C',1);    
	    $pdf->cell(23,6,'completedate',1,0,'C',1);   
        $pdf->cell(23,6,'completetime',1,0,'C',1);      
        $pdf->cell(20,6,'c.by',1,0,'C',1);
		
        $pdf->cell(20,6,'kode_samkple',1,0,'C',1);  
        $pdf->cell(25,6,'jam_sampling',1,0,'C',1);  
    //    $pdf->cell(15,6,'s_analis',1,0,'C',1);    
        
        $pdf->cell(25,6,'tgl_expired',1,0,'C',1);    
        $pdf->cell(15,6,'no_lab',1,0,'C',1); 
        $pdf->cell(25,6,'tgl_analisa',1,0,'C',1);
        
        $pdf->cell(15,6,'analis_oleh',1,0,'C',1); 
        $pdf->cell(10,6,'ph',1,0,'C',1); 
        $pdf->cell(15,6,'csp_la_35',1,0,'C',1);      
        $pdf->cell(17,6,'csp_la_55',1,0,'C',1); 
        
        $pdf->cell(14,6,'csp_ha_30',1,0,'C',1); 
		$pdf->cell(17,6,'tab',1,0,'C',1);
		$pdf->cell(17,6,'keterangan',1,0,'C',1);
		
        
		 
    
        $pdf->Ln();

        $no=1;
      
        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','',8);
        $pdf->cell(9,6,$no, 1,'L');     
        $pdf->cell(23,6,$row1->tgl_produksi, 1,'L');
        $pdf->cell(50,6,$row1->jenis_produk, 1,'L');
      //  $pdf->cell(23,6,$row1->sampling_tgl, 1,'L');
        $pdf->cell(23,6,$row1->completedate, 1,'L');
        $pdf->cell(23,6,$row1->completetime, 1,'L');
        $pdf->cell(20,6,$row1->completeby, 1,'L');
		
       
        $pdf->cell(20,6,$row1->kode_sample, 1,'L');
        $pdf->cell(25,6,$row1->jam_sampling, 1,'L');       
        $pdf->cell(25,6,$row1->tgl_expired, 1,'L');
            
        $pdf->cell(15,6,$row1->no_lab, 1,'L');
        $pdf->cell(25,6,$row1->tgl_analisa, 1,'L');
        
        $pdf->cell(15,6,$row1->analis_oleh, 1,'L');
        $pdf->cell(10,6,$row1->ph, 1,'L');
        $pdf->cell(15,6,$row1->csp_la_35, 1,'L');		
        $pdf->cell(17,6,$row1->csp_la_55, 1,'L');
		
        $pdf->cell(14,6,$row1->csp_ha_30, 1,'L');
		$pdf->cell(17,6,$row1->tab, 1,'L');
		$pdf->cell(17,6,$row1->keterangan, 1,'L');	
		
        $pdf->Ln();
        $no++;   
        }
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');  
        }else{}
		
		break;
        case $frmkode=="frmlqs077":
		if ($filekd=="export"){
		$pdf->AddPage('L','A3');
        $logor="assets/images/rlogopsg.png";
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true);  
         //$pdf->SetFillColor(230,230,230,230); 
         $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',8);
        $pdf->cell(33, 25, $a,1,0,'C',0);
        $dtheader1=$this->$model->get_header_byid($id);
        
         
        $pdf->cell(322, 25, $title, 1,0,'C',0);
         $pdf->SetFont('Arial','',8);
        
        
    
        foreach($dtheader1 as $dthdr1){
        $tgl_data=$dthdr1->tgl_data;
        $pdf->cell(50, 25, 'Tgl Uji :'.$tgl_data.'',1,0,'L',0);
        }
            
        
        $pdf->Ln();
        $pdf->SetFont('Arial','',10);
        $pdf->cell(33,6, 'JUDUL',1,0,'C',0);
        
        $pdf->cell(322,6, $frmjdl, 1,0,'C',0);
        
        $pdf->cell(50, 6, 'Halaman :' .$pdf->PageNo().'', 1,0,'L',0);
       
        $pdf->Ln();
        

        $pdf->SetFillColor(110,180,230);
        $pdf->SetFont('Arial','',10);
       
      
        $pdf->cell(10,18,'No.',1,0,'C',0); 
        $pdf->cell(23,18,'Kode Contoh',1,0,'C',0); 
        $pdf->cell(35,18,'Tgl Produksi',1,0,'C',0);            
	    $pdf->cell(40,6,'Dianalisa',1,0,'C',0);   
        $pdf->cell(10,18,'pH',1,0,'C',0);      		
        $pdf->cell(75,6,'Uji Streak',1,0,'C',0);  
        $pdf->cell(70,6,'Morfologi koloni',1,0,'C',0);  
 
        
        $pdf->cell(40,6,'Cerapan Mikroskopik',1,0,'C',0);    
        $pdf->cell(30,6,'Uji Biokimia',1,0,'C',0); 
        $pdf->cell(46,6,'Uji Pemanasan Contoh',1,0,'C',0);
        $pdf->cell(26,18,'Keterangan',1,0,'C',0); 
        $pdf->cell(0.5,6,'',0,0,'C',0); 

		$pdf->Ln();
		$pdf->cell(10,6,'',0,0,'C',0); 
		$pdf->cell(23,6,'',0,0,'C',0); 
        $pdf->cell(35,6,'',0,0,'C',0); 
        $pdf->cell(20,12,'Tanggal',1,0,'C',0); 
		$pdf->cell(20,12,'Oleh',1,0,'C',0); 

		$pdf->cell(10,6,'',0,0,'C',0); 
		
		$pdf->cell(25,6,'NA',1,0,'C',0); 
		$pdf->cell(25,6,'TGEA',1,0,'C',0); 
		$pdf->cell(25,6,'OSA',1,0,'C',0); 
		
		$pdf->cell(35,6,'Bentuk /Penampilan',1,0,'C',0); 
		$pdf->cell(35,6,'Bentuk /Penampilan',1,0,'C',0); 
		
		$pdf->cell(20,6,'Gram ',1,0,'C',0); 
		$pdf->cell(20,12,'Katalase',1,0,'C',0); 
		
		$pdf->cell(18,12,'Oksidase',1,0,'C',0);
		$pdf->cell(12,6,'T=80C',1,0,'C',0);
		
		$pdf->cell(46,6,'T=100C',1,0,'C',0);
		$pdf->cell(26,6,'',0,0,'C',0);
        $pdf->cell(0.5,6,'',0,0,'C',0); 
		$pdf->Ln();
		
		$pdf->cell(10,6,'',0,0,'C',0); 
        $pdf->cell(23,6,'',0,0,'C',0); 
		$pdf->cell(35, 6,'',0,0,'C',0);
		
		$pdf->cell(20, 6,'',0,0,'C',0);
		$pdf->cell(20, 6,'',0,0,'C',0);
		$pdf->cell(10,6,'',0,0,'C',0); 

		$pdf->cell(25,6,'INkubasi 35C',1,0,'C',0);  
		$pdf->cell(25,6,'Inkubasi 55C',1,0,'C',0);     
		$pdf->cell(25,6,'Inkubasi 30C',1,0,'C',0); 

		$pdf->cell(35,6,'Warna',1,0,'C',0);  
		$pdf->cell(35,6,'Berspora',1,0,'C',0);     
		
		
		$pdf->cell(20,6,'Stain',1,0,'C',0); 
		$pdf->cell(20,6,'',0,0,'C',0);
		
		$pdf->cell(18,6,'',0,0,'C',0); 
		$pdf->cell(12,6,'I/35C',1,0,'C',0);
		
		$pdf->cell(23,6,'I/35C',1,0,'C',0); 
		$pdf->cell(23,6,'I/55C',1,0,'C',0);
	
		$pdf->cell(26,6,'',0,0,'C',0); 
         $pdf->cell(0.5,6,'',0,0,'C',0); 
		$pdf->Ln();
		
		$no=1;
        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','B',6);
        $pdf->cell(10,6,$no, 1,'L');
        $pdf->cell(23,6,$row1->kd_contoh, 1,'L');
        $pdf->cell(35,6,$row1->tgl_kd_produksi, 1,'L');     
        $pdf->cell(20,6,$row1->analisa_tgl, 1,'L' );
        $pdf->cell(20,6,$row1->analisa_oleh, 1,'L');
        $pdf->cell(10,6,$row1->ph, 1,'L');
		
       
        $pdf->cell(25,6,$row1->us_na_i35, 1,'L');
        $pdf->cell(25,6,$row1->us_tgea_i55, 1,'L');                 
        $pdf->cell(25,6,$row1->us_osa_i30, 1,'L');
        $pdf->cell(35,6,$row1->mk_warna, 1,'L');		
        $pdf->cell(35,6,$row1->cm_spora, 1,'L');
		
        $pdf->cell(20,6,$row1->cm_gram, 1,'L');
		$pdf->cell(20,6,$row1->ub_katalase, 1,'L');
		$pdf->cell(18,6,$row1->ub_oksidase, 1,'L');	
		$pdf->cell(12,6,$row1->upj_t80_i35, 1,'L');	
		
		$pdf->cell(23,6,$row1->upj_t100_i35, 1,'L');	
		$pdf->cell(23,6,$row1->upj_t100_i55, 1,'L');	
		$pdf->cell(26,6,$row1->keterangan, 1,'L');	
		$pdf->cell(0.5,6,'',0,0,'C',0); 
        $pdf->Ln();
        $no++;   
        }
         foreach($dtfrm as $dt_form){
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
		$pdf->SetFont('Arial','',8);
		$pdf->cell(379,6,'Masa Berlaku :'.$frmefec.'',1,0,'L',0);
        $pdf->cell(26,6, $frmnm, 1,0,'R',0); 
		$pdf->Ln(6);
		
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');  
        }else{}
		
		break;
	
		case $frmkode=="intqad114":
		if ($filekd=="export"){
		$pdf->AddPage('L','A3');
        $logor='assets/images/rlogopsg.png';
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true); 

		$pdf->SetFillColor(230,230,230,230);
		$pdf->SetFont('Arial','',8);
		$pdf->cell(30, 25, $a,1,0,'C',0);
		$pdf->SetFont('Arial','B',10);
		$pdf->cell(330, 25, $title, 1,0,'C',0);
		$pdf->SetFont('Arial','',10);
		$dataheader=$this->$model->get_header_byid($id);
		foreach($dataheader as $dthdr){
		$bln_tahun=$dthdr->bln_tahun;
		$pdf->cell(45, 25, 'Bulan/Tahun.:'.$bln_tahun.'',1,0,'L',0);
		}
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30,6, 'JUDUL',1,0,'C',0);
		
		$pdf->cell(330,6, $frmjdl, 1,0,'C',0);
		$pdf->cell(45, 6, 'Halaman.:'.$pdf->PageNo().'', 1,0,'L',0);
				
		$pdf->Ln();	
		$pdf->SetFont('Arial','',6);
		$pdf->cell(10,6, 'No.',1,0,'C',0);
		$pdf->cell(20,6, 'Product Date', 1, 0, 'C',0);
		$pdf->cell(20, 6, 'Sampling Time',1,0,'C',0);
		$pdf->cell(20, 6, 'Sampling Coding',1,0,'C',0);
		$pdf->cell(20, 6, 'Testing Date',1,0,'C',0);
		$pdf->cell(20, 6, 'Analyzed By',1,0,'C', 0);
		$pdf->cell(84,6, 'MPN-Coliform (MPN/gr)',1,0,'C',0);
	    $pdf->cell(141,6, 'MPN-Coliform (MPN-100 Gr)', 1,0,'C',0);
		$pdf->cell(10,6, 'MPN/g ', 1,0,'C',0);
		$pdf->cell(10,6, 'MPN/g ', 1,0,'C',0);
		$pdf->cell(10,6, 'MPN/', 1,0,'C',0);
		$pdf->cell(10,6, 'MPN/', 1,0,'C',0);
		$pdf->cell(15,6, 'Total', 1,0,'C',0);
		$pdf->cell(15,6, 'Remarks', 1,0,'C',0);
		$pdf->Ln();
		
		$pdf->cell(10,6, '',1,0,'C',0);
		$pdf->cell(20,6, '',1,0,'C',0);
		$pdf->cell(20,6, '', 1, 0, 'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		$pdf->SetFont('Arial','',4);
		$pdf->cell(42, 6, 'No.Of Positive / Negative Tubes',1,0,'C',0);
		$pdf->cell(42, 6, 'Confirmation  No.Of Positive/ Negative Tubes',1,0,'C',0);
		
		$pdf->SetFont('Arial','',4);
		
		$pdf->cell(50, 6, 'No.Of Positive / Negative Tubes',1,0,'C',0);
		$pdf->cell(20, 6, 'Streaking on VBRA from ',1,0,'C',0);
		$pdf->cell(50, 6, 'Confirmation  No.Of Positive/ Negative Tubes',1,0,'C',0);
		$pdf->cell(21, 6, 'Streaking on VBRA from',1,0,'C',0);
		
				
		$pdf->cell(10,6, '(LST)', 1,0,'C',0);
		$pdf->cell(10,6, '(BGBB)', 1,0,'C',0);
		$pdf->cell(10,6, '100', 1,0,'C',0);
		$pdf->cell(10,6, '100g', 1,0,'C',0);
		$pdf->cell(15,6, 'Coliform', 1,0,'C',0);
		$pdf->cell(15,6, 'Remarks', 1,0,'C',0);
	
        $pdf->Ln();
		$pdf->cell(10,6, '',1,0,'C',0);
		$pdf->cell(20,6, '', 1, 0, 'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		
		$pdf->cell(14, 6, '0.1/10-1',1,0,'C',0);
		$pdf->cell(14, 6, '0.01/10-2',1,0,'C',0);
		$pdf->cell(14, 6, '0.001/10-3',1,0,'C',0);
		
		$pdf->cell(14, 6, '0.1/10-1',1,0,'C',0);
		$pdf->cell(14, 6, '0.01/10-2',1,0,'C',0);
		$pdf->cell(14, 6, '0.001/10-3',1,0,'C',0);
		
		
		$pdf->cell(16, 6, '0.1/10-1',1,0,'C',0);
		$pdf->cell(16, 6, '0.01/10-2',1,0,'C',0);
		$pdf->cell(18, 6, '0.001/10-3',1,0,'C',0);
		
		$pdf->cell(20, 6, 'LST Positive tubes',1,0,'C',0);
		
		$pdf->cell(16, 6, '0.1/10-1',1,0,'C',0);
		$pdf->cell(16, 6, '0.01/10-2',1,0,'C',0);
		$pdf->cell(18, 6, '0.001/10-3',1,0,'C',0);
		
		$pdf->cell(21, 6, 'BGBB Positive tubes',1,0,'C',0);
		$pdf->cell(10, 6, '',1,0,'C',0);
		$pdf->cell(10, 6, '',1,0,'C',0);
		$pdf->cell(10, 6, 'LST',1,0,'C',0);
		$pdf->cell(10, 6, '(BGBB)',1,0,'C',0);
		$pdf->cell(15, 6, 'Count',1,0,'C',0);
		$pdf->cell(15, 6, '',1,0,'C',0);
		
		$pdf->Ln();
		
		$pdf->cell(10,6, '',1,0,'C',0);
		$pdf->cell(20,6, '', 1, 0, 'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		$pdf->cell(20, 6, '',1,0,'C', 0);
		
		$pdf->cell(14, 6, 'LSB/10 ML',1,0,'C',0);
		$pdf->cell(14, 6, 'LSB/ 10 ML',1,0,'C',0);
		$pdf->cell(14, 6, 'LSB/ 10 ML',1,0,'C',0);
	
		$pdf->cell(14, 6, 'BGB/ 10 ML',1,0,'C',0);
		$pdf->cell(14, 6, 'BGB/ 10 ML',1,0,'C',0);
		$pdf->cell(14, 6, 'BGB/ 10 ML',1,0,'C',0);
		
		
		$pdf->cell(16, 6, 'LSB / 10 ML',1,0,'C',0);
		$pdf->cell(16, 6, 'LSB / 10 ML',1,0,'C',0);
		$pdf->cell(18, 6, 'LSB / 10 ML',1,0,'C',0);
		
		$pdf->cell(7, 6, '10(0)',1,0,'C',0);
		$pdf->cell(7, 6, '10(1)',1,0,'C',0);
		$pdf->cell(6, 6, '10(2)',1,0,'C',0);
		
		$pdf->cell(16, 6, 'BGBB/ 10 ML',1,0,'C',0);
		$pdf->cell(16, 6, 'BGBB/ 10 ML',1,0,'C',0);
		$pdf->cell(18, 6, 'BGBB/ 10 ML',1,0,'C',0);
		
		
		$pdf->cell(7, 6, '10 (0)',1,0,'C',0);
		$pdf->cell(7, 6, '10 (1)',1,0,'C',0);
		$pdf->cell(7, 6, '10 (2)',1,0,'C',0);
		
		$pdf->cell(10,6, ' ', 1,0,'C',0);
		$pdf->cell(10,6, '', 1,0,'C',0);
		$pdf->cell(10,6, '', 1,0,'C',0);
		$pdf->cell(10,6, '', 1,0,'C',0);
		$pdf->cell(15,6, '', 1,0,'C',0);
		$pdf->cell(15,6, '', 1,0,'C',0);
		$pdf->Ln();
		
		
		$pdf->cell(10,6, '',1,0,'C',0);
		$pdf->cell(20,6, '', 1, 0, 'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		$pdf->cell(20, 6, '',1,0,'C',0);
		
		$pdf->cell(7, 6, '24Jam',1,0,'C',0);
		$pdf->cell(7, 6, '48Jam',1,0,'C',0);		
		$pdf->cell(7, 6, '24Jam',1,0,'C',0);
		$pdf->cell(7, 6, '48Jam',1,0,'C',0);
		$pdf->cell(7, 6, '24Jam',1,0,'C',0);
		$pdf->cell(7, 6, '48Jam',1,0,'C',0);
		
		$pdf->cell(7, 6, '24Jam',1,0,'C',0);
		$pdf->cell(7, 6, '48Jam',1,0,'C',0);		
		$pdf->cell(7, 6, '24Jam',1,0,'C',0);
		$pdf->cell(7, 6, '48Jam',1,0,'C',0);
		$pdf->cell(7, 6, '24Jam',1,0,'C',0);
		$pdf->cell(7, 6, '48Jam',1,0,'C',0);
		
		$pdf->cell(8, 6, '24Jam',1,0,'C',0);
		$pdf->cell(8, 6, '48Jam',1,0,'C',0);
		
		$pdf->cell(8, 6, '24Jam',1,0,'C',0);
		$pdf->cell(8, 6, '48Jam',1,0,'C',0);
		
		$pdf->cell(9, 6, '24Jam',1,0,'C',0);
		$pdf->cell(9, 6, '48Jam',1,0,'C',0);
		
		$pdf->cell(20, 6, '24Jam',1,0,'C',0);
		
		$pdf->cell(8, 6, '24Jam',1,0,'C',0);
		$pdf->cell(8, 6, '48Jam',1,0,'C',0);		
		$pdf->cell(8, 6, '24Jam',1,0,'C',0);
		$pdf->cell(8, 6, '48Jam',1,0,'C',0);
		$pdf->cell(9, 6, '24Jam',1,0,'C',0);
		$pdf->cell(9, 6, '48Jam',1,0,'C',0);
		
		
		$pdf->cell(21, 6, '24Jam',1,0,'C',0);
		
		$pdf->cell(10,6, '', 1,0,'C',0);
		$pdf->cell(10,6, '', 1,0,'C',0);
		$pdf->cell(10,6, '', 1,0,'C',0);
		$pdf->cell(10,6, '', 1,0,'C',0);
		$pdf->cell(15,6, '10(-1)', 1,0,'C',0);
		$pdf->cell(15,6, '', 1,0,'C',0);
		
			
		
		$pdf->Ln();
		
        $no=1;
      
        foreach ($datadtl as $row1){             
           
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');     
        $pdf->cell(20,6,$row1->tgl_produksi, 1,'L');
        $pdf->cell(20,6,$row1->jam_sampling, 1,'L');
		
        $pdf->cell(20,6,$row1->kode_sample, 1,'L');
		$pdf->cell(20,6,$row1->tgl_tes, 1,'L');
        $pdf->cell(20,6,$row1->analisa_oleh, 1,'L');
		
		$pdf->cell(7,6,$row1->mpn_pn_101_lsb24, 1,'L');
        $pdf->cell(7,6,$row1->mpn_pn_101_lsb48, 1,'L');
		$pdf->cell(7,6,$row1->mpn_pn_102_lsb24, 1,'L');
        $pdf->cell(7,6,$row1->mpn_pn_102_lsb48, 1,'L');
		$pdf->cell(7,6,$row1->mpn_pn_103_lsb24, 1,'L');
        $pdf->cell(7,6,$row1->mpn_pn_103_lsb48, 1,'L');
		
		$pdf->cell(7,6,$row1->mpn_cpn_101_bgbb24, 1,'L');
        $pdf->cell(7,6,$row1->mpn_cpn_101_bgbb48, 1,'L');		
		$pdf->cell(7,6,$row1->mpn_cpn_102_bgbb24, 1,'L');
        $pdf->cell(7,6,$row1->mpn_cpn_102_bgbb48, 1,'L');
		$pdf->cell(7,6,$row1->mpn_cpn_103_bgbb24, 1,'L');
        $pdf->cell(7,6,$row1->mpn_cpn_103_bgbb48, 1,'L');
		
		$pdf->cell(8,6,$row1->mpn100_pn_10_lsb24, 1,'L');
        $pdf->cell(8,6,$row1->mpn100_pn_10_lsb48, 1,'L');
		$pdf->cell(8,6,$row1->mpn100_pn_101_lsb24, 1,'L');
        $pdf->cell(8,6,$row1->mpn100_pn_101_lsb48, 1,'L');
		$pdf->cell(9,6,$row1->mpn100_pn_102_lsb24, 1,'L');
        $pdf->cell(9,6,$row1->mpn100_pn_102_lsb48, 1,'L');
		
		$pdf->cell(6,6,'', 1,'L');
        $pdf->cell(8,6,$row1->mpn100_vrba_lst24, 1,'L');
        $pdf->cell(6,6,'', 1,'L');
		
        $pdf->cell(8,6,$row1->mpn100_cpn_10_bgbb24, 1,'L');
	    $pdf->cell(8,6,$row1->mpn100_cpn_10_bgbb48, 1,'L');
        $pdf->cell(8,6,$row1->mpn100_cpn_101_bgbb24, 1,'L');
		$pdf->cell(8,6,$row1->mpn100_cpn_101_bgbb48, 1,'L');
        $pdf->cell(9,6,$row1->mpn100_cpn_102_bgbb24, 1,'L');
		$pdf->cell(9,6,$row1->mpn100_cpn_102_bgbb48, 1,'L');
		
        $pdf->cell(7,6,'', 1,'L');
        $pdf->cell(7,6,$row1->mpn100_vrba_bgbb24, 1,'L');
        $pdf->cell(7,6,'', 1,'L');

		$pdf->cell(10,6,$row1->mpn_lst, 1,'L');
        $pdf->cell(10,6,$row1->mpn_bgbb, 1,'L');
		
		
		$pdf->cell(10,6,$row1->mpn100_lst, 1,'L');
        $pdf->cell(10,6,$row1->mpn100_bgbb, 1,'L');
		$pdf->cell(15,6,$row1->tpc_101, 1,'L');
        $pdf->cell(15,6,$row1->remark, 1,'L');
		
		$pdf->Ln();
        $no++;   
        }
		 foreach($dtfrm as $dt_form){
     
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
		$pdf->SetFont('Arial','',8);
		$pdf->cell(365,6,'Mulai Berlaku :'.$frmefec,1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
		
      
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),415,$pdf->GetY());
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');  
        }else{}
		
		break;


        case $frmkode=="intqad119":
        $dtheader=$this->$model->get_header_byid($id);
        $data7=array('dtheader'=>$dtheader);
            foreach($dtheader as $dt_headerrow){
                $dttgl=$dt_headerrow->tgl_sampling;
            }
            if($cekLevelUserNm=="Auditor"){
                $dtdetail1=$this->$model->get_detail_byidx($id);
            }else{
                 $dtdetail1=$this->$model->get_detail_byid($id);
            }
               $data8=array('dtdetail1'=>$dtdetail1); 
           
        if ($filekd=="export"){
        $pdf->AddPage('L','A3');
        $logor='assets/images/rlogopsg.png';
        $title="PT.PULAU SAMBU GUNTUNG";        
        $a=$pdf->Image($logor,10,10,30,25);
        $dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true); 

        $pdf->SetFillColor(230,230,230,230);
        $pdf->SetFont('Arial','',8);
        $pdf->cell(30, 25, $a,1,0,'C',0);
        $pdf->SetFont('Arial','B',10);
        $pdf->cell(330, 25, $title, 1,0,'C',0);
        $pdf->SetFont('Arial','',10);
        $dataheader=$this->$model->get_header_byid($id);
        foreach($dataheader as $dthdr){
        $tahun=$dthdr->tahun;
        $pdf->cell(45, 25, 'Tahun :'.$tahun.'',1,0,'L',0);
        }
        $pdf->Ln();

      

        $pdf->SetFont('Arial','',10);
        $pdf->cell(30,6, 'JUDUL',1,0,'C',0);
        
        $pdf->cell(330,6, $frmjdl, 1,0,'C',0);
          foreach($dataheader as $dthdr){
        $bulan=$dthdr->bulan;
        $pdf->cell(45, 6, 'bulan :'.$bulan.'',1,0,'L',0);
        }
    
                
        $pdf->Ln();
		$dataheader=$this->$model->get_header_byid($id);
        foreach($dataheader as $dthdr){
        $tgl_sampling=$dthdr->tgl_sampling;
		$shift=$dthdr->shift;
			
		$pdf->cell(405,6,'Tgl Sampling:' .$tgl_sampling, 1,0,'L',0);
		$pdf->Ln();
		$pdf->cell(405,6,'Shift :' .$shift, 1,0,'L',0);
        		
		}
		$pdf->Ln();
        $pdf->SetFillColor(230,230,230,230);
        $pdf->SetFont('Arial','',8);
       
      
        $pdf->cell(10,18,'No.',1,0,'C',0); 
        $pdf->cell(30,18,'Sampling Point',1,0,'C',0);
        $pdf->cell(110,6,'kantin A/Jam Sampling',1,0,'C',0);
        $pdf->cell(110,6,'kantin B/Jam Sampling',1,0,'C',0);
        $pdf->cell(110,6,'kantin C/Jam Sampling',1,0,'C',0);
        $pdf->cell(35,18,'Keterangan',1,0,'C',0);
        $pdf->cell(0.5,6,'',0,0,'C',0);
        $pdf->Ln();

        $pdf->cell(10,6,'',0,0,'C',0); 
        $pdf->cell(30,6,'',0,0,'C',0);
        $pdf->cell(110,6,'Hasil Pengamatan Secara Visual Setelah 24 Jam',1,0,'C',0);
        $pdf->cell(110,6,'Hasil Pengamatan Secara Visual Setelah 24 Jam',1,0,'C',0);
        $pdf->cell(110,6,'Hasil Pengamatan Secara Visual Setelah 24 Jam',1,0,'C',0);
        $pdf->cell(35,6,'',0,0,'C',0);
        $pdf->cell(0.5,6,'',0,0,'C',0);
        $pdf->Ln();




        $pdf->cell(10,6,'',0,0,'C',0);
        $pdf->cell(30,6,'',0,0,'C',0);
        $pdf->cell(35,6,'Sample Yang Disampling',1,0,'C',0); 
        $pdf->cell(30,6,'Jam sampling A',1,0,'C',0);  
        $pdf->cell(30,6,'Pertumbuhan jamur',1,0,'C',0);  
        $pdf->cell(15,6,'Aroma',1,0,'C',0); 

        $pdf->cell(35,6,'Sample Yg Disampling',1,0,'C',0);  
        $pdf->cell(30,6,'Jam sampling B',1,0,'C',0);  
        $pdf->cell(30,6,'Pertumbuhan jamur',1,0,'C',0); 
        $pdf->cell(15,6,'Aroma',1,0,'C',0); 
        $pdf->cell(35,6,'Sample Yang Disampling',1,0,'C',0);
        $pdf->cell(30,6,'Jam sampling C',1,0,'C',0);  
        $pdf->cell(30,6,'Pertumbuhan jamur',1,0,'C',0);  
        $pdf->cell(15,6,'Aroma',1,0,'C',0); 
        $pdf->cell(35,6,'',0,0,'C',0);
        $pdf->cell(0.5,6,'',0,0,'C',0);

        $pdf->Ln();
        $no=1;

        $dtdetail1=$this->$model->get_detail_byid($id);
        foreach($dtdetail1 as $row){
            $pdf->cell(10,6,$no,1,0,'L',0);
            $pdf->cell(30,6,$row->sampling_point,1,'L');
            $pdf->cell(35,6,$row->kantin_a_sampling,1,'L');
            $pdf->cell(30,6,$row->kantin_a_jam_sampling,1,'L');
            $pdf->cell(30,6,$row->kantin_a_pertumbuhan_jamur,1,'L');
            $pdf->cell(15,6,$row->kantin_a_aroma,1,'L');

            $pdf->cell(35,6,$row->kantin_b_sampling,1,'L');
            $pdf->cell(30,6,$row->kantin_b_jam_sampling,1,'L');
            $pdf->cell(30,6,$row->kantin_b_pertumbuhan_jamur,1,'L');
            $pdf->cell(15,6,$row->kantin_b_aroma,1,'L');

            $pdf->cell(35,6,$row->kantin_c_sampling,1,'L');
            $pdf->cell(30,6,$row->kantin_c_jam_sampling,1,'L');
            $pdf->cell(30,6,$row->kantin_c_pertumbuhan_jamur,1,'L');
            $pdf->cell(15,6,$row->kantin_c_aroma,1,'L');
            $pdf->cell(35,6,$row->keterangan,1,'L');
        $pdf->Ln();
        $no++;   
        }
      foreach($dtfrm as $dt_form){
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
        $pdf->SetFont('Arial','',8);
        $pdf->cell(365,6,'Masa Berlaku :'.$frmefec,1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
        
        
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),290,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
        $pdf->Output($frmkode.'.pdf','I');
      
        }else{}
        break;
		
		case $frmkode=="frmfss115":
	  if ($filekd=="export"){
		$logor='assets/images/rlogopsg.png';
        $title="PT.PULAU SAMBU GUNTUNG";
		$pdf->AddPage('L','A4');
		$a=$pdf->Image($logor,10,10,30,25);
		$dates="Printed Date : ". date('d/m/y');
        $pdf->SetAutoPageBreak(true); 
		  
		  
		$pdf->SetFillColor(230,230,230,230);
		$pdf->SetFont('Arial','B',10);
		$pdf->cell(30, 25, $a,1,0,'C',0);
		
		
		
		 
		$pdf->cell(215, 25, $title, 1,0,'C',0);
		
		$pdf->SetFont('Arial','',10);
		$dtproduct=$this->$model->get_header_byid($id);
		foreach($dtproduct as $dtprd){
		$tgl_produksi=$dtprd->tgl_produksi;
	
		$pdf->cell(40, 25, 'DATE:'.$tgl_produksi.'', 1,0,'L',0);
		}
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30,6, 'JUDUL',1,0,'C',0);
		
		$pdf->cell(215,6, $frmjdl, 1,0,'C',0);
		
		$dtproduct=$this->$model->get_header_byid($id);
		foreach($dtproduct as $dtprd){
		$jenis_produk=$dtprd->jenis_produk;
		$pdf->cell(40, 6,'Product:'.$jenis_produk.'', 1,0,'L',0);
		}		
		$pdf->Ln(6);
		  
		
        
       $pdf->SetFillColor(230,230,230,230);
       $pdf->SetFont('Arial','',8);
       
      
        $pdf->cell(10,6,'No.',1,0,'C',0);   
		
        $pdf->cell(15,6,'Time',1,0,'C',0);  		
        $pdf->cell(35,6,'Description of',1,0,'C',0);  
		
        $pdf->cell(35,6,'Proposed',1,0,'C',0);   		
       // $pdf->cell(5,6,'ID',1,0,'C',1);       
        $pdf->cell(30,6,'Informed By',1,0,'C',0);        
        $pdf->cell(30,6,'Received By',1,0,'C',0);
        $pdf->cell(40,6,'Action Taken',1,0,'C',0);
        $pdf->cell(60,6,'Verification',1,0,'C',0);
        $pdf->cell(30,6,'Remarks',1,0,'C',0);
		
		$pdf->Ln();
		
		$pdf->cell(10,6,'',1,0,'C',0);  
		$pdf->cell(15,6,'',1,0,'C',0);
        $pdf->cell(35,6,' Non-conformance',1,0,'C',0);  
		
        $pdf->cell(35,6,'Disposition Action',1,0,'C',0);   		
       // $pdf->cell(5,6,'ID',1,0,'C',1);       
        $pdf->cell(30,6,'',1,0,'C',0);        
        $pdf->cell(30,6,'',1,0,'C',0);
        $pdf->cell(25,6,'Time',1,0,'C',0);
        $pdf->cell(15,6,'By',1,0,'C',0);
        
		
		$pdf->cell(20,6,'Time',1,0,'C',0);
		$pdf->cell(20,6,'Result',1,0,'C',0);
		$pdf->cell(20,6,'By',1,0,'C',0);
	    $pdf->cell(30,6,'',1,0,'C',0);
            
        $pdf->Ln();

        $no=1;
           
       
         foreach ($datadtl as $row1){      
          		 
			
           
        $pdf->SetFont('Arial','',8);
        $pdf->cell(10,6,$no, 1,'L');
       // $pdf->cell(5,6,$row1->detail_id, 1,'L');
	    $pdf->cell(15,6,$row1->jam, 1,'L');
		$pdf->cell(35,6,$row1->deskripsi_nc, 1,'L');
		$pdf->cell(35,6,$row1->proposal_da, 1,'L');
        $pdf->cell(30,6,$row1->dilaporkan_oleh, 1,'L');        
        $pdf->cell(30,6,$row1->diterima_oleh, 1,'L');
        $pdf->cell(25,6,$row1->waktu_at, 1,'L');
        $pdf->cell(15,6,$row1->at_oleh, 1,'L');
        $pdf->cell(20,6,$row1->waktu_verifikasi, 1,'L');
        $pdf->cell(20,6,$row1->hasil_verifikasi, 1,'L');
        $pdf->cell(20,6,$row1->diverifikasi_oleh, 1,'L');
        $pdf->cell(30,6,$row1->remarks, 1,'L');
		
       
      
        $pdf->Ln();
        $no++;   
        }
      foreach($dtfrm as $dt_form){
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
		$pdf->SetFont('Arial','',8);
		$pdf->cell(245,6, $frmefec,1,0,'L',0);
        $pdf->cell(40,6, $frmnm, 1,0,'R',0); 
		
        
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),290,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
		$pdf->Output($frmkode.'.pdf','I');
      
        }else{}
		break;
		
	   case $frmkode=="frmfss120":
	   if ($filekd=="export"){
		$logor='assets/images/rlogopsg.png';
        $title="PT.PULAU SAMBU GUNTUNG";
		$pdf->AddPage('P','A3');
		$a=$pdf->Image($logor,10,10,30,20);
        $pdf->SetAutoPageBreak(true); 
		  
		  
		$pdf->SetFillColor(230,230,230,230);
		$pdf->SetFont('Arial','B',10);
		$pdf->cell(30, 20, $a,1,0,'C',0);
	
		$pdf->cell(203, 25, $title, 1,0,'C',0);
		
		$pdf->SetFont('Arial','',10);

		$dtproduct=$this->$model->get_header_byid($id);

		foreach($dtproduct as $dtprd){
		$tgl_sampling=$dtprd->tgl_sampling;	
		$pdf->cell(45, 20,'P/D:'.$tgl_sampling.'', 1,0,'L',0);
		}

		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->cell(30,6, 'JUDUL',1,0,'C',0);
		
		$pdf->cell(203,6, $frmjdl, 1,0,'C',0);
		
		$pdf->cell(45, 6,'Page:'.$pdf->PageNo().'of'.$pdf->PageNo().'', 1,0,'L',0);
        	
		$pdf->Ln(6);
		$pdf->SetFont('Arial','B',10);
		$pdf->cell(278,6,'Equipment Swabbing',1,0,'L',0);
		$pdf->Ln(6);
		
        $pdf->SetFillColor(230,230,230,230);
        $pdf->SetFont('Arial','B',8);
       
        $pdf->cell(70,6,'Specification .',1,0,'C',0);   
		
        $pdf->cell(50,6,'Total Plate Count',1,0,'C',0);  		
        $pdf->cell(50,6,'Enterobacteriaceae',1,0,'C',0);  
		
        $pdf->cell(50,6,'E.coli',1,0,'C',0);   	
		$pdf->cell(58,6,'Salmonella',1,0,'C',0); 
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);
		$pdf->cell(70,6, '1.DRP Processing Area',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 100cfu/50 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 20cfu/50 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs/50 cm2', 1,0,'C',0);
		$pdf->cell(58, 6, 'Abs/50 cm2', 1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(70,6, 'Processing Area',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 3200cfu/400 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 560cfu/400 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs/400 cm2', 1,0,'C',0);
		$pdf->cell(58, 6, 'Abs/400 cm2', 1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(70,6, 'SPD and MPD Processing Area',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 3200cfu/400 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 560cfu/400 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs/400 cm2', 1,0,'C',0);
		$pdf->cell(58, 6, 'Abs/400 cm2', 1,0,'C',0);
		$pdf->Ln();
        $pdf->cell(70,6, '',1,0,'C',0);
        $pdf->cell(50, 6, 'Max 100cfu/25 cm2', 1,0,'C',0);
        $pdf->cell(50, 6, 'Max 25cfu/25 cm2', 1,0,'C',0);
        $pdf->cell(50, 6, 'Abs/25 cm2', 1,0,'C',0);
        $pdf->cell(58, 6, 'Abs/25 cm2', 1,0,'C',0);
        $pdf->Ln();
		$pdf->cell(70,6, 'CMP Processing Area',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 250cfu/25 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 20cfu/25 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs 25 cm2', 1,0,'C',0);
		$pdf->cell(58, 6, 'Abs 25 cm2', 1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(70,6, '',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 2000cfu/400 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 150cfu/400 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs/400 cm2', 1,0,'C',0);
		$pdf->cell(58, 6, 'Abs/400 cm2', 1,0,'C',0);
		$pdf->Ln();
		
		$pdf->cell(70,6, '4.WTP Area:',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 100cfu/25 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 25cfu/25 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs/25 cm2', 1,0,'C',0);
		$pdf->cell(58, 6, 'Abs/25 cm2', 1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(70,6, 'PRC Area (After CIP)',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 100cfu/25 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 20cfu/25 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs/25 cm2', 1,0,'C',0);
		$pdf->cell(58, 6, 'Abs/25 cm2', 1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(70,6, 'VTIS Area(After CIP)',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 100cfu/25 swab', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 20cfu/25 swab', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs/swab', 1,0,'C',0);		
		$pdf->cell(58, 6, 'Abs/swab', 1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(70,6, 'AFM  Area(After CIP)',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 2000cfu/400 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 150cfu/400 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs/400 cm2', 1,0,'C',0);
		$pdf->cell(58, 6, 'Abs/400 cm2', 1,0,'C',0);
		$pdf->Ln();
		
		$pdf->cell(70,6, '5.QSD (Laundry)',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 3200cfu/400 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 560cfu/400 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs/400 cm2', 1,0,'C',0);
		$pdf->cell(58, 6, 'Abs/400 cm2', 1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(70,6, '6.DWP',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 200cfu/25 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 20cfu/25 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs/25 cm2', 1,0,'C',0);
		$pdf->cell(58, 6, 'Abs/25 cm2', 1,0,'C',0);
		$pdf->Ln();
		$pdf->cell(70,6, '-PRC Area',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 200cfu/25 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 20cfu/25 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs/25 cm2', 1,0,'C',0);
		$pdf->cell(58, 6, 'Abs/25 cm2', 1,0,'C',0);
		$pdf->Ln();
		
		$pdf->cell(70,6, '-Line in pipa transfer AMTK',1,0,'C',0);
		$pdf->cell(50, 6, '', 1,0,'C',0);
		$pdf->cell(50, 6, '', 1,0,'C',0);
		$pdf->cell(50, 6, '', 1,0,'C',0);
		$pdf->cell(58, 6, '', 1,0,'C',0);
		$pdf->Ln();
		
		$pdf->cell(70,6, '7.jalur Distribusi AMTK ',1,0,'C',0);
		$pdf->cell(50, 6, 'Max 200cfu/25 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Max 20cfu/25 cm2', 1,0,'C',0);
		$pdf->cell(50, 6, 'Abs/25 cm2', 1,0,'C',0);
		$pdf->cell(58, 6, 'Abs/25 cm2', 1,0,'C',0);
		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->SetFont('Arial','B',8);
		// $pdf->cell(10,6,'No',1,0,'C',0);
		$pdf->cell(60, 6, 'Equipment and Tools/Utensil',1,0,'C',0);
		$pdf->cell(30, 6, 'Time of Swabbing',1,0,'C',0);
		$pdf->cell(30, 6, 'Total Plate Count',1,0,'C',0);
		$pdf->cell(30, 6, 'Enterobacteriacea',1,0,'C',0);
		$pdf->cell(30, 6, 'E.coli',1,0,'C',0);
		$pdf->cell(30, 6, 'Salmonella',1,0,'C',0);
		$pdf->cell(68, 6, 'Remarks',1,0,'C',0);
		$pdf->Ln();
		
		
        $no=1;
           
       
        foreach ($datadtl as $row1){ 
  		
        $pdf->SetFont('Arial','',8);
		// $pdf->cell(10,6,$no,1,'L');
        $pdf->cell(60,6,$row1->lokasi_sampling.' | '.$row1->sampling_point, 1,'L');
	//	$pdf->cell(30,6,$row1->sampling_point, 1,'L');
		$pdf->cell(30,6,$row1->sampling_jam, 1,'L');
       // $pdf->cell(30,6,$row1->operator, 1,'L'); 

		if($row1->operator2=='0'){
			$operator2="<";
		}elseif($row1->operator2=='1'){
			$operator2=">";
		}else{
			$operator2="";
		}
		
		
        $pdf->cell(30,6,$operator2. ''.$row1->ha_tpc, 1,'L');
		if($row1->operator=='0'){
			$operator="<";
		}elseif($row1->operator=='1'){
			$operator=">";
		}else{
			$operator="";
		}
		
        $pdf->cell(30,6,$operator. ''.$row1->ha_entero, 1,'L');
        $pdf->cell(30,6,$row1->ha_ecoli_gas, 1,'L');
        $pdf->cell(30,6,$row1->ha_salmonella_he, 1,'L');
        $pdf->cell(68,6,$row1->remarks, 1,'L');
		
        $pdf->Ln();
        $no++;   
        }
		$pdf->Ln();
     
		
		$pdf->cell(94, 6,'CFU : Colony Forming Unit',1,0,'L',0);
		$pdf->cell(94, 6,'CIP : Cleaning In Peace',1,0,'L',0);
		$pdf->cell(30, 6,'Reported By:',1,0,'L',0);
		$pdf->cell(30, 6,'Checked By:',1,0,'L',0);
		$pdf->cell(30, 6,'Confirmed By:',1,0,'L',0);
		$pdf->cell(0.5, 6,'',0,0,'L',0);
		$pdf->Ln();
		
		$pdf->cell(94, 6,'Min :Minute',1,0,'L',0);
		$pdf->cell(94, 6,'DRP : DRY Process',1,0,'L',0);
		$pdf->cell(30, 18,'',1,0,'L',0);
		$pdf->cell(30, 18,'',1,0,'L',0);
		$pdf->cell(30, 18,'',1,0,'L',0);
		$pdf->cell(0.5, 6,'',0,0,'L',0);
		$pdf->Ln();
		$pdf->cell(94, 6,'PD :Production Date',1,0,'L',0);
		$pdf->cell(94, 6,'CMP : Coconut Milk Powder',1,0,'L',0);
		$pdf->cell(30, 6,'',0,0,'L',0);
		$pdf->cell(30, 6,'',0,0,'L',0);
		$pdf->cell(30, 6,'',0,0,'L',0);
		$pdf->cell(0.5, 6,'',0,0,'L',0);
		$pdf->Ln();
		$pdf->cell(94, 6,'DOC :Document',1,0,'L',0);
		$pdf->cell(94, 6,'WTP : Wet Process',1,0,'L',0);
		$pdf->cell(30, 6,'',0,0,'L',0);
		$pdf->cell(30, 6,'',0,0,'L',0);
		$pdf->cell(30, 6,'',0,0,'L',0);
		$pdf->cell(0.5, 6,'',0,0,'L',0);
		$pdf->Ln();
		$pdf->cell(94, 6,'MAX :Maximum',1,0,'L',0);
		$pdf->cell(94, 6,'VTIS : Vacum Termal Instant Steam',1,0,'L',0);
		$pdf->cell(30, 6,'Name:',1,0,'L',0);
		$pdf->cell(30, 6,'Name',1,0,'L',0);
		$pdf->cell(30, 6,'Name',1,0,'L',0);
		$pdf->Ln();
		$pdf->cell(94, 6,'ABS :Absence',1,0,'L',0);
		$pdf->cell(94, 6,'AFM : Aseptic Filling Machine',1,0,'L',0);
		$pdf->cell(30, 6,'Position:',1,0,'L',0);
		$pdf->cell(30, 6,'Position:',1,0,'L',0);
		$pdf->cell(30, 6,'Position:',1,0,'L',0);
		$pdf->Ln();
		$pdf->cell(94, 6,'E.coli:Escherichia coli',1,0,'L',0);
		$pdf->cell(94, 6,'',1,0,'L',0);
		$pdf->cell(30, 6,'Date:',1,0,'L',0);
		$pdf->cell(30, 6,'Date:',1,0,'L',0);
		$pdf->cell(30, 6,'Date:',1,0,'L',0);
		$pdf->Ln();
		 foreach($dtfrm as $dt_form){
      $frmefec  = $dt_form->formefective;
      $frmnm    = $dt_form->formnm;
     
  }
		$pdf->SetFont('Arial','',8);
		$pdf->cell(220,6,'Mulai Berlaku : '.$frmefec.'',1,0,'L',0);
        $pdf->cell(58,6, $frmnm, 1,0,'R',0); 
		$pdf->Ln(6);
	
	       
        $pdf->SetY(-10);
        $pdf->Line(10,$pdf->GetY(),290,$pdf->GetY());
        $pdf->SetFont('Arial','I',9);
        $pdf->Cell(0,10,'Page '.$pdf->PageNo().' Of : '.$pdf->PageNo().'',0,0,'R');
        $pdf->Ln();
		$pdf->Output($frmkode.'.pdf','I');
      
        }else{}
		break;
      
	}


}
}