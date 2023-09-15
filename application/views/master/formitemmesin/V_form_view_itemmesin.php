<?php $this->load->view('template/headbar'); ?>

<?php

  if(isset($dtheader)){
      foreach ($dtheader as $row_header) {
          $headerid       = $row_header->headerid;
          $dtform_jenis   = $row_header->form_jenis;
          $dtkode_form    = $row_header->form_kode;
          $dtparameter    = $row_header->parameter;
          $dtparameter2   = $row_header->parameter2;
          $dtarea         = $row_header->area;
          $dtdeptemen         = $row_header->departemen;
          $dttgl_efective = date("d-m-Y",strtotime($row_header->tgl_efective));
      }
  }else{
      $dtform_jenis   = "";
      $dtkode_form    = "";
      $dtparameter    = "";
      $dtparameter2   = "";
      $dtarea         = "";
      $dtdeptemen         = "";
      $dttgl_efective = "";
  }        
    
?>


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
                            <h3><?php echo $this->config->item("nama_perusahaan"); ?><br>
                            <h2 class="box-title" ><?php echo 'MASTER FORM ITEM';?></h2></h3>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <br>
                <br>
                  <div class="box-body">
                      <div class="row">
                          <div class="col-md-6">
                              <table class="table table-condensed">
                                <tr>
                                  <td style="text-align:left; font-weight: bold;">Departemen</td>
                                  <td style="text-align:left; font-weight: bold;">: <?php echo $dtdeptemen; ?> </td>
                                </tr>
                                <tr>
                                  <td style="text-align:left; font-weight: bold;">Jenis Form</td>
                                  <td style="text-align:left; font-weight: bold;">: <?php echo $dtform_jenis; ?> </td>
                                </tr>
                                <tr>
                                  <td style="text-align:left; font-weight: bold;">Kode Form</td>
                                  <td style="text-align:left; font-weight: bold;">: <?php echo $dtkode_form; ?> </td>
                                </tr>
                                <tr>
                                  <td style="text-align:left; font-weight: bold;">Tipe Tabel</td>
                                  <td style="text-align:left; font-weight: bold;">: <?php echo $dtparameter; ?> </td>
                                </tr>
                                <tr>
                                  <td style="text-align:left; font-weight: bold;">Tanggal Efective</td>
                                  <td style="text-align:left; font-weight: bold;">: <?php echo $dttgl_efective; ?></td>
                                </tr>
                             </table>
                         </div>
                         <div class="col-md-6"></div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                              <table class="table table-border">
                                <tr>
                                  <td style="text-align: center;font-weight: bold;" class="table-primary">No</td>
                                  <td class="table-primary" style="text-align:left; font-weight: bold;" colspan="6">Section / Type Of Machine / Machine Name</td>
                                </tr>
                              <?php if(isset($all_item)){ 
                                $no = 0;
                                $no2 = 0;
                                ?>
                                    <?php
                                    foreach($all_item as $all_item_row){ $no++;?>
                                       
                                       <?php if(isset($all_item_row->children)){ 
                                        ?><tr>
                                         <td style="text-align:center; font-weight: bold;"><?php echo $no.'.';?></td>
                                         <td style="text-align:left; font-weight: bold;" colspan="6">SECTION : <?php echo $all_item_row->item1;?></td>
                                       </tr>
                                       <?php
                                        foreach($all_item_row->children as $children_row){
                                            if(isset($children_row->children2)){ 
                                              $part_komponen    = explode(",",$children_row->part_komponen);
                                              $nama_partkomponen = "";
                                                    foreach ($part_komponen as $item) {
                                                          foreach ($dt_partkomponen as $allpartkomponen) {
                                                              if ($item == $allpartkomponen->komponen_id) {
                                                              $nama_partkomponen .= $allpartkomponen->nama_komponen.", ";
                                                              }
                                                          }
                                                  }
                                              ?>
                                                <tr>
                                                 <td></td>
                                                 <td style="text-align:left; font-weight: bold;"></td>
                                                 <td style="text-align:left; font-weight: bold;" colspan="5">TYPE OF MACHINE : <?php echo $children_row->item2.' [ '.rtrim($nama_partkomponen,", ").' ] ';?></td>
                                                 <td></td>
                                               </tr>
                                               <tr>
                                                 <td></td>
                                                 <td style="text-align:left; font-weight: bold;"></td>
                                                 <td style="text-align:left; font-weight: bold;" colspan="2">MACHINE NAME : </td>
                                                 <td></td>
                                               </tr>
                                              <?php
                                              foreach($children_row->children2 as $children2_row){ $no2++;
                                                  if(isset($children2_row->children3)){ ?>
                                                   <tr>
                                                     <td></td>
                                                     <td style="text-align:left; font-weight: bold;"></td>
                                                     <td style="text-align:left; font-weight: bold;"></td>
                                                     <td style="text-align:left; font-weight: bold;" colspan="3"><?php echo $children2_row->item3;?></td>
                                                   </tr>
                                                  <?php
                                                  foreach($children2_row->children3 as $children3_row){ 
                                                      if(isset($children3_row->children4)){ ?>
                                                        <tr>
                                                         <td></td>
                                                         <td style="text-align:left; font-weight: bold;"></td>
                                                         <td style="text-align:left; font-weight: bold;"></td>
                                                         <td style="text-align:left; font-weight: bold;"></td>
                                                         <td style="text-align:left; font-weight: bold;" colspan="2"><?php echo $children3_row->item4;?></td>
                                                       </tr>
                                                      <?php
                                                        foreach($children3_row->children4 as $children4_row){ ?>
                                                           <tr>
                                                             <td></td>
                                                             <td style="text-align:left; font-weight: bold;"></td>
                                                             <td style="text-align:left; font-weight: bold;"></td>
                                                             <td style="text-align:left; font-weight: bold;"></td>
                                                             <td style="text-align:left; font-weight: bold;"></td>
                                                             <td style="text-align:left; font-weight: bold;"><?php echo $children4_row->item5;?></td>
                                                           </tr>
                                                        <?php
                                                        }
                                                      }else{ ?>
                                                        <tr>
                                                           <td></td>
                                                           <td style="text-align:left; font-weight: bold;"></td>
                                                           <td style="text-align:left; font-weight: bold;"></td>
                                                           <td style="text-align:left; font-weight: bold;"></td>
                                                           <td style="text-align:left; font-weight: bold;" colspan="2"><?php echo $children3_row->item4;?></td>
                                                         </tr>
                                                      <?php
                                                      }
                                                    ?>
                                                  <?php
                                                  }
                                                  }else{
                                                    $part_komponen_na = explode(",",$children2_row->part_komponen_na);
                                                    $nama_partkomponen_na = "";
                                                    foreach ($part_komponen_na as $item) {
                                                          foreach ($dt_partkomponen as $allpartkomponen) {
                                                              if ($item == $allpartkomponen->komponen_id) {
                                                              $nama_partkomponen_na .= $allpartkomponen->nama_komponen.", ";
                                                              }
                                                          }
                                                    }
                                                    if (isset($nama_partkomponen_na) && $nama_partkomponen_na != '') {
                                                      $nama_partkomponen_na = $nama_partkomponen_na;
                                                    } else {
                                                      $nama_partkomponen_na = '-';
                                                    }
                                                    ?>
                                                    <tr>
                                                     <td></td>
                                                     <td style="text-align:left; font-weight: bold;"></td>
                                                     <td width="3%" style="text-align:left; font-weight: bold;"></td>
                                                     <td style="text-align:left; font-weight: bold;" colspan="2"><?php echo $no2.'. '.$children2_row->kode_mesin.' - '.$children2_row->nama_mesin.' [ '.rtrim($nama_partkomponen_na,", ").' ] ';?></td>
                                                   </tr>
                                                  <?php
                                                  }
                                                ?>
                                              <?php
                                              }
                                            }else{ ?>
                                               <tr>
                                                 <td></td>
                                                 <td style="text-align:left; font-weight: bold;"></td>
                                                 <td style="text-align:left; font-weight: bold;" colspan="4">TYPE OF MACHINE : <?php echo $children_row->item2;?></td>
                                               </tr>
                                            <?php }
                                        }
                                       }else{ ?>
                                       <tr>
                                         <td style="text-align:center; font-weight: bold;"><?php echo $no;?></td>
                                         <td style="text-align:left; font-weight: bold;" colspan="5">SECTION : <?php echo $all_item_row->item1;?></td>
                                       </tr>
                                       <?php } ?>
                                    <?php
                                    }
                                    ?>
                              <?php }else{} ?>
                              <tfoot class="table-primary">
                                <tr>
                                  <td colspan="5"></td>
                                </tr>
                              </tfoot>
                              </table>
                          </div>
                      </div>

                  
                      <div class="box-footer">
                        <div align = "left"></div>
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#tipe_contoh').change(function(){
            var dtjc = $("#tipe_contoh").val();

            $("#jns_produk").prop('selectedIndex',0);
            $('#jns_produk_2').val('');
            $('#formula').prop('selectedIndex',0);

            if(dtjc.trim()!=''){
              $.ajax({
                type :"post",
                url : "<?php echo base_url();?>index.php/master/formitem/C_form_item/get_dtjenis_produk002",
                data : { tipe_contoh: dtjc},
                success: function(data){
                    console.log(data);
                    var datan = data.split("__");
                    $('#jns_produk').html(datan[0]);
                    $('.DivPar').html(datan[1]);
                }
              });
            }else{}
        });  

        $('#jns_produk').change(function(){
            var dttc  = $("#tipe_contoh").val();
            var dtjp  = $('#jns_produk').val();
            var dtjp2 = $("#jns_produk option:selected").text();

            $('#jns_produk_2').val(dtjp2);

            if(dtjp2.match(/\//ig)){var dtgetkd = dtjp2.substring(3,0);}
            else{var dtgetkd = dtjp2;}

            if(dttc.trim()==''){
              alert('Maaf Kolom Tipe Contoh Tidak Boleh Kosong!!');
            }else{
               if(dtjp.trim()!=''){
                    $.ajax({
                      type :"post",
                      url : "<?php echo base_url();?>index.php/master/formitem/C_form_item/get_formula002",
                      data : { tipe_contoh: dttc, jns_produk: dtjp, jns_produk_2:dtgetkd},
                            success: function(data2){
                            $('#formula').html(data2);
                      }
                    });  
               }
            }
        });   

        $('#formula').change(function(){
            var formula_selected = $("#formula option:selected").text();
            var arr_formula_selected = formula_selected.split('||');
            $('#deskripsi_formula').val(arr_formula_selected[1].trim());
        }); 

        $('#dtform_jenis').change(function(){
          $('#dtkode_form').prop('selectedIndex',0);
          $('#dtversi_form').prop('selectedIndex',0);
          var dtform_jenis = $("#dtform_jenis").val();

           $.ajax({
               type : "post",
               url  : "<?php echo base_url();?>index.php/master/formitem/C_form_item/get_form_code",
               data : { formjnsnm: dtform_jenis},
                      success: function(data3){   
                      $('#dtkode_form').html(data3);
                    }
          });  
      });

      // $('#dtkode_form').change(function(){
      //     $('#dtversi_form').prop('selectedIndex',0);

      //     var dtkode_form = $("#dtkode_form").val();

      //      $.ajax({
      //          type : "post",
      //          url  : "<?php //echo base_url();?>index.php/master/formitem/C_form_item/get_form_versi",
      //          data : { formnm: dtkode_form},
      //                 success: function(data4){   
      //                 $('#dtversi_form').html(data4);
      //               }
      //     });  
      // });   

      $('#dtkode_form').change(function(){
        var kode_form = $("#dtkode_form").val();
          if(kode_form.trim()!=''){
            $.ajax({
              type :"post",
              url : "<?php echo base_url();?>index.php/master/formitem/C_form_item/get_area",
              data : { dtkode_form:kode_form },
              success: function(data_area){
                  //console.log(data_area);
                  $('#area').html(data_area);
              }
            });
          }
      });

      $('#btndelete').click(function(){
            var action_url = '<?php echo base_url('master/formitem/C_form_item/form/aksi_delete') ?>';
            $("#form_item").attr('action', action_url);
            $("#form_item").closest('form').submit();
      });

       $('#btncopy').click(function(){
            var action_url = '<?php echo base_url('master/formitem/C_form_item/form/aksi_copy') ?>';
            $("#form_item").attr('action', action_url);
            $("#form_item").closest('form').submit();
      });

      $(document).on('click', '.btn_kategori_b', function() {
            var that = $(this);

            var valbutton     = $(this).attr("value");
            var dt_headerid   = $("#headerid").val();
            
            var col_chk       = that.closest('tr').find("input[class*='checkall']");
            var val_detail_id = col_chk.val();

            console.log(dt_headerid, val_detail_id);

            if(val_detail_id.trim()==''){
                alert("Maaf Data belum disimpan..!!");
            }else{

                $.ajax({
                type :"post",
                url : "<?php echo base_url();?>index.php/master/formitem/C_form_item/getdetail_spec",
                data : { headerid:dt_headerid, detail_id:val_detail_id},
                      success: function(datas){
                          console.log(datas);
                          $("#tbody_spec_modal").empty();

                          var datan = datas.split("//");
                            $("#modal_headerid").val(datan[0]);
                            $("#modal_detail_id_a").val(datan[1]);
                            $('#tbody_spec_modal').append(datan[2]);
                            $("#Modal1").modal();
                      }
                });
            }
             $("#SpecModal").modal();
      });

      //modal C
      $(document).on('click', '.btn_kategori_c', function() {
            var that = $(this);

            var valbutton       = $(this).attr("value");
            var dt_headerid     = $("#headerid").val();
            
            var col_chk         = that.closest('tr').find("input[class*='checkall']");
            var col_detail_id_a = that.closest('tr').find(".detail_id");
            
            var val_detail_id_a = col_detail_id_a.val();
            var val_detail_id_b = col_chk.val();

            console.log(dt_headerid, val_detail_id_b);

            if(val_detail_id_b.trim()==''){
                alert("Maaf Data belum disimpan..!!");
            }else{

                $.ajax({
                type :"post",
                url : "<?php echo base_url();?>index.php/master/formitem/C_form_item/getdetail_spec_c",
                data : { headerid:dt_headerid, detail_id:val_detail_id_a, detail_id_b:val_detail_id_b},
                      success: function(datas_c){
                          console.log(datas_c);
                          $("#tbody_spec_modalc").empty();

                          var datan = datas_c.split("//");
                            $("#modal_headeridc").val(datan[0]);
                            $("#modal_detail_id_b").val(datan[1]);
                            $('#tbody_spec_modalc').append(datan[2]);
                            $("#Modal2").modal();
                      }
                });
            }
             $("#SpecModalc").modal();
      });

      //modal d
      $(document).on('click', '.btn_kategori_d', function() {
            var that = $(this);

            var valbutton       = $(this).attr("value");
            var dt_headerid     = $("#headerid").val();
            
            var col_chk         = that.closest('tr').find("input[class*='checkall']");
            var col_detail_id_a = that.closest('tr').find(".detail_id");
            var col_detail_id_b = that.closest('tr').find(".detail_id_b");
            
            var val_detail_id_a = col_detail_id_a.val();
            var val_detail_id_b = col_detail_id_b.val();
            var val_detail_id_c = col_chk.val();

            console.log(dt_headerid, val_detail_id_a, val_detail_id_b, val_detail_id_c);

            if(val_detail_id_c.trim()==''){
                alert("Maaf Data belum disimpan..!!");
            }else{

                $.ajax({
                type :"post",
                url : "<?php echo base_url();?>index.php/master/formitem/C_form_item/getdetail_spec_d",
                data : { headerid:dt_headerid, detail_id:val_detail_id_a, detail_id_b:val_detail_id_b, detail_id_c:val_detail_id_c},
                      success: function(datas_d){
                          console.log(datas_d);
                          $("#tbody_spec_modald").empty();

                          var datan = datas_d.split("//");
                            $("#modal_headeridd").val(datan[0]);
                            $("#modal_detail_id_c").val(datan[1]);
                            $('#tbody_spec_modald').append(datan[2]);
                            $("#Modal3").modal();
                      }
                });
            }
             $("#SpecModald").modal();
      });

      //modal e
      $(document).on('click', '.btn_kategori_e', function() {
            var that = $(this);

            var valbutton       = $(this).attr("value");
            var dt_headerid     = $("#headerid").val();
            
            var col_chk         = that.closest('tr').find("input[class*='checkall']");
            var col_detail_id_a = that.closest('tr').find(".detail_id");
            var col_detail_id_b = that.closest('tr').find(".detail_id_b");
            var col_detail_id_c = that.closest('tr').find(".detail_id_c");
            
            var val_detail_id_a = col_detail_id_a.val();
            var val_detail_id_b = col_detail_id_b.val();
            var val_detail_id_c = col_detail_id_c.val();
            var val_detail_id_d = col_chk.val();

            console.log(dt_headerid, val_detail_id_a, val_detail_id_b, val_detail_id_c, val_detail_id_d);

            if(val_detail_id_d.trim()==''){
                alert("Maaf Data belum disimpan..!!");
            }else{

                $.ajax({
                type :"post",
                url : "<?php echo base_url();?>index.php/master/formitem/C_form_item/getdetail_spec_e",
                data : { headerid:dt_headerid, detail_id:val_detail_id_a, detail_id_b:val_detail_id_b, detail_id_c:val_detail_id_c, detail_id_d:val_detail_id_d},
                      success: function(datas_e){
                          console.log(datas_e);
                          $("#tbody_spec_modale").empty();

                          var datan = datas_e.split("//");
                            $("#modal_headeride").val(datan[0]);
                            $("#modal_detail_id_d").val(datan[1]);
                            $('#tbody_spec_modale').append(datan[2]);
                            $("#Modal4").modal();
                      }
                });
            }
             $("#SpecModale").modal();
      }); 

      //button save modal B
      $(".btnmodal_save").click(function(e){ 
          var valbutton = $(this).attr("value");
          var data055  = $("#form_modal").serialize();

              $.ajax({
                 url:"<?php echo base_url();?>index.php/master/formitem/C_form_item/save_kategori_b",
                 type: 'POST',
                 data: $("#form_modal").find("select, textarea, input").serialize() + "&valbutton=" + valbutton,
                 success: function(pesan){
                    alert('Data berhasil disimpan');
                        $("#Modal1").modal('hide');
                        window.location.reload();
                 },
                 error: function(){
                     alert("Fail")
                 }
             });
             e.preventDefault(); // could also use: return false;
      });

      //button save modal C
      $(".btnmodal_save_c").click(function(e){ 
          var valbutton = $(this).attr("value");
          var data055  = $("#form_modal_c").serialize();

              $.ajax({
                 url:"<?php echo base_url();?>index.php/master/formitem/C_form_item/save_kategori_c",
                 type: 'POST',
                 data: $("#form_modal_c").find("select, textarea, input").serialize() + "&valbutton=" + valbutton,
                 success: function(pesan){
                    alert('Data berhasil disimpan');
                        $("#Modal2").modal('hide');
                        window.location.reload();
                 },
                 error: function(){
                     alert("Fail")
                 }
             });
             e.preventDefault(); // could also use: return false;
      });

      //button save modal d
      $(".btnmodal_save_d").click(function(e){ 
          var valbutton = $(this).attr("value");
          var data055  = $("#form_modal_d").serialize();

              $.ajax({
                 url:"<?php echo base_url();?>index.php/master/formitem/C_form_item/save_kategori_d",
                 type: 'POST',
                 data: $("#form_modal_d").find("select, textarea, input").serialize() + "&valbutton=" + valbutton,
                 success: function(pesan){
                    alert('Data berhasil disimpan');
                        $("#Modal3").modal('hide');
                        window.location.reload();
                 },
                 error: function(){
                     alert("Fail")
                 }
             });
             e.preventDefault(); // could also use: return false;
      });

      //button save modal e
      $(".btnmodal_save_e").click(function(e){ 
          var valbutton = $(this).attr("value");
          var data055  = $("#form_modal_e").serialize();

              $.ajax({
                 url:"<?php echo base_url();?>index.php/master/formitem/C_form_item/save_kategori_e",
                 type: 'POST',
                 data: $("#form_modal_e").find("select, textarea, input").serialize() + "&valbutton=" + valbutton,
                 success: function(pesan){
                    alert('Data berhasil disimpan');
                        $("#Modal4").modal('hide');
                        window.location.reload();
                 },
                 error: function(){
                     alert("Fail")
                 }
             });
             e.preventDefault(); // could also use: return false;
      });

    });

    //bloking select option header, isset headerid
    $('#dtform_jenis').mousedown(function(){
          var headerid = $("#headerid").val();
            if(headerid.trim()!=""){
               $('#dtform_jenis > option').each(function() {
                    if(!this.selected) {
                        $(this).attr('disabled', true);
                    }
                }); 
            }else{
                $("#dtform_jenis option").removeAttr('disabled', false); 
            }
        });

    $('#dtkode_form').mousedown(function(){
          var headerid = $("#headerid").val();
            if(headerid.trim()!=""){
               $('#dtkode_form > option').each(function() {
                    if(!this.selected) {
                        $(this).attr('disabled', true);
                    }
                }); 
            }else{
                $("#dtkode_form option").removeAttr('disabled', false); 
            }
        });
</script>