
<?php
date_default_timezone_set("Asia/Jakarta");
?>

<?php
$this->load->view('template/head');
?>
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />

<?php
$this->load->view('template/topbar2');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-warning">
                <div class="box-header" style="text-align:center;">
                    <div class="row">
                    <div class="col-md-12" style="text-align:center;">
                        <img src="<?php echo base_url('assets/images/Logo_PSG.gif')?>"/>
                        <br>
                        <h3><b><?php echo $this->config->item("nama_perusahaan"); ?></b><br>
                        <h2 class="box-title" ><b><?php echo 'MANAGEMEN INFORMASI LABORATORIUM';?> </b></h2></h3>
                    </div>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <br/>

                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- TO DO List -->
                              <div class="box box-warning">
                                <div class="box-header">
                                  <i class="ion ion-clipboard"></i>
                                  <h3 class="box-title">
                                    <?php
                                    if($file_kategori=='document'){
                                      if($file_kategorisub=='id'){
                                        echo 'Document - Bahasa Indonesia';
                                      }elseif($file_kategorisub=='en'){
                                        echo 'Document - Bahasa Inggris';
                                      }else{}
                                    }elseif($file_kategori=='fss'){
                                      if($file_kategorisub=='id'){
                                        echo 'Document Food Safety Security- Bahasa Indonesia';
                                      }elseif($file_kategorisub=='en'){
                                        echo 'Document Food Safety Security- Bahasa Inggris';
                                      }else{}  
                                    }elseif($file_kategori=='metode'){
                                      echo 'Referensi Metode Analisa';
                                    }elseif($file_kategori=='temuan'){
                                      if($file_kategorisub=='survailen1'){
                                        echo 'Temuan Ketidaksesuaian Audit Eksternal - Survailen I';
                                      }elseif($file_kategorisub=='survailen2'){
                                        echo 'Temuan Ketidaksesuaian Audit Eksternal - Survailen II';
                                      }elseif($file_kategorisub=='reakreditasi'){
                                        echo 'Temuan Ketidaksesuaian Audit Eksternal - Re- Akreditasi';
                                      }elseif($file_kategorisub=='perluasan'){
                                        echo 'Temuan Ketidaksesuaian Audit Eksternal - Perluasan Ruang Lingkup';
                                      }else{}
                                    }elseif($file_kategori=='evaluasi'){
                                      if($file_kategorisub=='kimia'){
                                        echo 'Laporan Evaluasi Ketidakpastian Pengujian - Laboratorium Kimia';
                                      }elseif($file_kategorisub=='mikro'){
                                        echo 'Laporan Evaluasi Ketidakpastian Pengujian - Laboratorium Mikrobiologi';
                                      }else{}
                                    }elseif($file_kategori=='validasi'){
                                      if($file_kategorisub=='kimia'){
                                        echo 'Laporan Validasi/Verifikasi Metode Pengujian - Laboratorium Kimia';
                                      }elseif($file_kategorisub=='mikro'){
                                        echo 'Laporan Validasi/Verifikasi Metode Pengujian - Laboratorium Mikrobiologi'; 
                                      }else{}
                                    }elseif($file_kategori=='sertifikat'){
                                      if($file_kategorisub=='current'){
                                        echo 'Sertifikat Kalibrasi Alat Tahun Berjalan';
                                      }elseif($file_kategorisub=='before'){
                                        echo 'Sertifikat Kalibrasi Alat Tahun Sebelumnya';
                                      }else{}
                                      
                                    }elseif($file_kategori=='legalitas'){
                                      echo 'Dokumen Legalitas Hukum PT. Pulau Sambu';
                                    }elseif($file_kategori=='audit_internal'){
                                      echo 'Audit Internal Laboratorium';
                                    }elseif($file_kategori=='inco'){
                                      echo 'Interlaboratory Comparison';
                                    }elseif($file_kategori=='iclab'){
                                       if($file_kategorisub=='kimia'){
                                        echo 'Interlaboratory Comparisons Laboratorium Pengujian - Laboratorium Kimia';
                                      }elseif($file_kategorisub=='mikro'){
                                        echo 'Interlaboratory Comparisons Laboratorium Pengujian - Laboratorium Mikrobiologi'; 
                                      }else{}
                                    }elseif($file_kategori=='analisa_eksternal'){
                                      if($file_kategorisub=='gmo'){
                                        echo 'Laporan Analisa Eksternal GMO';
                                      }elseif($file_kategorisub=='gluten'){
                                        echo 'Laporan Analisa Eksternal Gluten Test';
                                      }elseif($file_kategorisub=='aflatoxin'){
                                        echo 'Laporan Analisa Eksternal Aflatoxin';
                                      }elseif($file_kategorisub=='amdk'){
                                        echo 'Laporan Analisa Eksternal AMDK';
                                      }elseif($file_kategorisub=='chlorate'){
                                        echo 'Laporan Analisa Eksternal Chlorate/Perchlorate';
                                      }elseif($file_kategorisub=='clostridium'){
                                        echo 'Laporan Analisa Eksternal Clostridium Testing';
                                      }elseif($file_kategorisub=='heavy_metal'){
                                        echo 'Laporan Analisa Eksternal Heavy Metal';
                                      }elseif($file_kategorisub=='micro_analysis'){
                                        echo 'Laporan Analisa Eksternal Microbiological Analysis Report';
                                      }elseif($file_kategorisub=='milk_allergen'){
                                        echo 'Laporan Analisa Eksternal Milk Allergen';
                                      }elseif($file_kategorisub=='patulin'){
                                        echo 'Laporan Analisa Eksternal Patulin';
                                      }elseif($file_kategorisub=='residual_pestide'){
                                        echo 'Laporan Analisa Eksternal Residual Pestide';
                                      }elseif($file_kategorisub=='suziwan'){
                                        echo 'Laporan Analisa Eksternal Suziwan Testing Report';
                                      }elseif($file_kategorisub=='water_quality'){
                                        echo 'Laporan Analisa Eksternal Water Quality';
                                      }elseif($file_kategorisub=='water_activity'){
                                        echo 'Laporan Analisa Eksternal Water Activity';
                                      }elseif($file_kategorisub=='composition_testing'){
                                        echo 'Laporan Analisa Eksternal Composition Testing';
                                      }else{}
                                    }elseif($file_kategori=='profisiensi'){
                                      echo 'Uji Profisiensi';
                                    }elseif($file_kategori=='supplier'){
                                      echo 'Supplier Layanan Eksternal';
                                    }elseif($file_kategori=='management_review'){
                                      echo 'Management Review';
                                    }elseif($file_kategori=='survey'){
                                      echo 'Survey Kepuasan Pelanggan';
                                    }elseif($file_kategori=='assesment'){
                                      if($file_kategorisub=='kimia'){
                                        echo 'Assesment Kualifikasi Personil - Laboratorium Kimia';
                                      }elseif($file_kategorisub=='mikro'){
                                        echo 'Assesment Kualifikasi Personil - Laboratorium Mikrobiologi';
                                      }else{}
                                    }elseif($file_kategori=='iso_17025'){
                                        echo 'Sertifikat ISO 17025';
                                    }elseif($file_kategori=='pernyataan'){
                                      if($file_kategorisub=='kimia'){
                                        echo 'Surat Pernyataan Personil (Ketidakberpahakan dan Kerahasiaan) - Laboratorium Kimia';
                                      }elseif($file_kategorisub=='mikro'){
                                        echo 'Surat Pernyataan Personil (Ketidakberpahakan dan Kerahasiaan) - Laboratorium Mikrobiologi';
                                      }else{}
                                    }elseif($file_kategori=='cek_antar'){
                                       echo 'Laporan Cek Antar';
                                    }elseif($file_kategori=='kan'){
                                       echo 'Dokumen Komite Akreditasi Nasional';
                                    }elseif($file_kategori=='tujuan_mutu'){
                                      if($file_kategorisub=='kimia'){
                                        echo 'Tujuan Mutu - Laboratorium Kimia';
                                      }elseif($file_kategorisub=='mikro'){
                                        echo 'Tujuan Mutu - Laboratorium Mikrobiologi';
                                      }else{}
                                    }elseif($file_kategori=='backup'){
                                       echo 'Backup Database';
                                    }elseif($file_kategori=='analisa_lab'){
                                       if($file_kategorisub=='kimia'){
                                        echo 'Laporan Hasil Analisa - Laboratorium Kimia';
                                      }elseif($file_kategorisub=='mikro'){
                                        echo 'Laporan Hasil Analisa - Laboratorium Mikrobiologi';
                                      }else{}
                                    }else{}
                                    ?>
                                  </h3>
                                  <div class="box-tools pull-right">
                                  </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                  <ul class="ul_dokumen todo-list">
                                    <?php
                                    if($file_kategori=='backup'){ 
                                      $this->load->helper('directory');
                                      $map = directory_map("./upload_backup/");
                                      function print_dir($in,$depth)
                                      {
                                          foreach ($in as $k => $v)
                                          {
                                              if (!is_array($v)){    
                                              }else{
                                                 for($t=0;$t<count($v);$t++){
                                                      echo $v[$t]."<br/>";
                                                 }
                                              }
                                          }
                                      }
                                      print_dir($map,0);
                                      ?>
                                    <?php
                                    }else{ 
                                      if(isset($all_dokumen)){ 
                                      foreach($all_dokumen as $row){
                                      ?>
                                      <li>
                                        <span class="handle">
                                          <i class="fa fa-ellipsis-v"></i>
                                          <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                        <!-- <a href="<?php// echo base_url('uploadfile_managemen_lab/'.$row->file_id.'.'.$row->file_ext.'')?>" target="_blank">
                                           <span class="file_desc text"><u><?php// echo $row->file_description;?></u></span>
                                        </a> -->
                                        <?php 
                                        $url = base_url();
                                        $base_path = str_replace('qad/','',$url);
                                        ?>
                                        <a href="<?php echo $base_path.'foruploads/'.$row->file_id.'.'.$row->file_ext.'';?>" target="_blank">
                                           <span class="file_desc text"><u><?php echo $row->file_description;?></u></span>
                                        </a>
                                        <small class="label">
                                          <?php if($row->file_ext=='pdf'){
                                            echo '<i class="fa fa-file-pdf-o" style="font-size:12px;color:red"></i>';
                                          }elseif($row->file_ext=='xls' || $row->file_ext=='xlsx' || $row->file_ext=='xml'){
                                            echo '<i class="fa fa-file-excel-o" style="font-size:12px;color:green"></i>';
                                          }else{
                                            echo '<i class="fa fa-file-text-o" style="font-size:12px;color:blue"></i>';
                                          }?>
                                          </small>

                                        <div class="tools">
                                          <?php
                                          if($levelusernm=='KS CHE' || $levelusernm=='KS CHE 1' || $levelusernm=='KR CHE 2' || $levelusernm=='KR MIC 1' || $levelusernm=='Document Control' || $levelusernm=='WKB MIC' || $levelusernm=='Administrator' || $levelusernm=='KR MIC 1' || $levelusernm=='Auditor KS CHE' || $levelusernm=='Auditor KS CHE 1' || $levelusernm=='Auditor Document Control' || $levelusernm=='Auditor WKB MIC' || $levelusernm=='Auditor Administrator' || $levelusernm=='Auditor KR MIC 1' || $levelusernm=='DCR QA' || $levelusernm=='Auditor DCR QA'){ ?>
                                          <button type="button" name="btn_modal" class="btn_docmodal btn btn-success pull-right btn-sm" value="<?php echo $row->file_id.'//'.$file_kategori.'//'.$file_kategorisub.'//';?>"><i class="fa fa-edit"></i></button>
                                          <button type="button" name="btn_modal" class="btnmodal_delete btn btn-warning pull-right btn-sm" value="<?php echo $row->file_id.'//'.$row->file_ext.'//'.$file_kategori.'//'.$file_kategorisub.'//';?>"><i class="fa fa-trash-o"></i></button>
                                          <?php  } ?>
                                        </div>
                                      </li>
                                    <?php
                                      }
                                      }
                                    }
                                    ?>
                                    
                                  </ul>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix no-border bg-info">
                                  <?php if($file_kategori=='backup'){ ?>
                                  <?php
                                  }else{ ?>
                                      <?php if($levelusernm=='KS CHE' || $levelusernm=='KS CHE 1' || $levelusernm=='KR CHE 2' || $levelusernm=='KR MIC 1' || $levelusernm=='Document Control' || $levelusernm=='WKB MIC' || $levelusernm=='Administrator' || $levelusernm=='KR MIC 1' || $levelusernm=='Auditor KS CHE' || $levelusernm=='Auditor KS CHE 1' || $levelusernm=='Auditor Document Control' || $levelusernm=='Auditor WKB MIC' || $levelusernm=='Auditor Administrator' || $levelusernm=='Auditor KR MIC 1' || $levelusernm=='DCR QA' || $levelusernm=='Auditor DCR QA'){ ?>
                                       <button type="button" name="btn_modal" class="btn_docmodal btn btn-info pull-right" value="<?php echo '0//'.$file_kategori.'//'.$file_kategorisub.'//';?>"><i class="fa fa-plus"></i> Add Document</button>
                                   <?php  } ?>
                                  <?php  
                                  } ?>
                                   
                                </div>
                              </div><!-- /.box -->
                        </div>
                    </div>

                    <?php if($levelusernm=='Administrator'){ ?>
                      <div class="row">
                        <div class="col-lg-12">
                          <?php
                          /*$this->load->helper('directory');
                          $map = directory_map("./upload_backup/");

                              function print_dir($in,$depth)
                              {
                                  foreach ($in as $k => $v)
                                  {
                                      if (!is_array($v)){echo "<p>",str_repeat("&nbsp;&nbsp;&nbsp;",$depth)," ",$v," [file]</p>";}
                                          
                                      else{
                                         //echo "<p>",str_repeat("&nbsp;&nbsp;&nbsp;",$depth)," <b>",$k,"</b> [directory]</p>",
                                         print_dir($v,$depth+1);
                                      }
                                  }
                              }

                              print_dir($map,0);*/
                           ?>
                        </div>
                      </div>
                    <?php } ?>

                      

                      <div class="modal fade bd-example-modal-lg" id="DocModal" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <form class="form-horizontal" role="form" action="#" name="form_modal" id="form_modal" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <button type="button" class="close"
                                       data-dismiss="modal">
                                           <span aria-hidden="true">&times;</span>
                                           <span class="sr-only">Close</span>
                                    </button>
                                    <h4 class="modal-title text-warning" id="myModalLabel">
                                        <div id="DocJudul"></div>
                                    </h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">  
                                                      <div id="DocBody">

                                                      </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                    <button type="button" name="btnmodal_save"  id="btnmodal_save" value="btnmodal_save" class="btnmodal_save btn btn-primary" onclick="return confirm('Simpan Documen ?')">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>    
                    </div>

                    <div class="box-footer">
                        <div align = "right">
                        <!-- <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" name="btn_modal" value="0" class="btn_Docmodal btn btn-info">Add Report</button>
                          <button type="button" name="btndelete" value="0" class="btndelete btn btn-danger">Delete Report</button>
                        </div>
                          <a href="<?php //echo base_url('export_excel/C_export_toexcel_ketidaksesuaian/exportxls/'.$date_from.'/'.$date_to) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><span class="btn btn-success glyphicon glyphicon-export"></span></a> -->
                        </div>
                    </div>
                    <br>
                    <div class="panel-footer">
                        <div class="clearfix">
                          <!-- <span class="pull-left">Mulai Berlaku: 02-08-2018</span>
                          <a href="#"><span class="pull-right">INT-QAD-169-00</span></a> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- /.box-body -->
</section><!-- /.content -->



<?php
$this->load->view('template/js2');
?>

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>

<!-- page script -->

<script type="text/javascript">
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('click', '.btn_docmodal', function() {
            var that = $(this);

            var valbutton = $(this).attr("value");
            var namebutton = $(this).attr("name");

            if(valbutton==''){
                alert('Sorry..Failed!!');
            }else{
                if(valbutton=='0'){
                    var judul = 'INPUT DETAIL DOKUMEN';
                    $.ajax({
                    type :"post",
                    url : "<?php echo base_url();?>index.php/tambahan/lain_lain/C_managemen_lab/adddocument",
                    data : { id:valbutton},
                          success: function(html_dok){
                             // console.log(html_dok);

                              $("#DocJudul").empty();
                              $("#DocBody").empty();
                              $("#DocBody").html(html_dok);
                              $("#DocJudul").html(judul);
                              $("#DocModal").modal();
                          }
                    });
                }else{
                        var judul = 'EDIT DETAIL DOKUMEN';
                        $.ajax({
                        type :"post",
                        url : "<?php echo base_url();?>index.php/tambahan/lain_lain/C_managemen_lab/adddocument",
                        data : { id:valbutton},
                              success: function(html_dok){
                                 // console.log(html_dok);
                                  $("#DocJudul").empty();
                                  $("#DocBody").empty();
                                  $("#DocBody").html(html_dok);
                                  $("#DocJudul").html(judul);
                                  $("#DocModal").modal();
                              }
                        });
                } 
            }
        });

        $(".btnmodal_save").click(function(e){  // passing down the event
             var postData = new FormData($("#form_modal")[0]);
             console.log(postData);
              $.ajax({
                   url: "<?php echo base_url();?>index.php/tambahan/lain_lain/C_managemen_lab/savedokumen",
                   type: "POST",
                   data: postData,
                   processData: false,  // tell jQuery not to process the data
                   contentType: false
              }).done(function(pesan) {
                    //console.log(pesan);
                    var arr_pesan = pesan.split('//');
                    alert(arr_pesan[1]);
                    var file_kategori = arr_pesan[2];
                    if(arr_pesan[3]==''){$file_kategorisub = '-';}else{$file_kategorisub = arr_pesan[3];}

                    $('#DocModal').modal('hide');
                    var baseurl = "<?php print base_url(); ?>";
                    window.location.href = baseurl+'index.php/tambahan/lain_lain/C_managemen_lab/getall/'+file_kategori+'/'+$file_kategorisub;
               });
                 e.preventDefault(); // could also use: return false;
           });

        $(".btnmodal_delete").click(function(e){  // passing down the event
            var that = $(this);
            var valbutton = $(this).attr("value").split("//");
            var id = valbutton[0];
            var ext = valbutton[1];
            var post_file_kategori = valbutton[2];
            var post_file_kategorisub = valbutton[3];

            $.ajax({
                 url:"<?php echo base_url();?>index.php/tambahan/lain_lain/C_managemen_lab/delete_dokumen",
                 type: 'post',
                 data: {id:id, ext:ext, file_kategori:post_file_kategori, file_kategorisub:post_file_kategorisub},
                 success: function(pesan){
                      //console.log(pesan);
                      var arr_pesan = pesan.split('//');
                      alert(arr_pesan[1]);
                      var file_kategori = arr_pesan[2];
                      if(arr_pesan[3]==''){$file_kategorisub = '-';}else{$file_kategorisub = arr_pesan[3];}

                      $("#DocModal").modal('hide');
                      var baseurl = "<?php print base_url(); ?>";
                      window.location.href = baseurl+'index.php/tambahan/lain_lain/C_managemen_lab/getall/'+file_kategori+'/'+$file_kategorisub;
                 },
                 error: function(){
                     alert('fail');
                 }
             });
             e.preventDefault(); // could also use: return false;
        });

    });
</script>

<?php
$this->load->view('template/foot2');
?>

