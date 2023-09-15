<?php $this->load->view('template/headbar'); ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12 mb-1">
            <h4 class="text-uppercase"><?= $Titel ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">DATA MENU</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button type="button" class="btn bg-gradient-primary modal_forminput" name="btn_add_menu" value=""><span class="feather icon-edit-1"> Tambah Menu</span></button></br></br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                              <thead>
                                <tr class="table-primary text-center">
                                  <th>No</th>
                                  <th>Menu ID</th>
                                  <th>Menu Nama</th>
                                  <th>Manu Link</th>
                                  <th>Menu Fa Icon</th>
                                  <th>Ubah</th>
                                  <th>Hapus</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if(!empty($query)){ 
                                  $no = 0;
                                  foreach($query->result_array() as $row){
                                    $no++; ?>
                                    <tr>
                                      <td align="center"><?= $no;?></td>
                                      <td><?= $row['menuid'] ?></td>
                                      <td><?= $row['menunm'] ?></td>
                                      <td><?= $row['menulink'] ?></td>
                                      <td><?= $row['menufaicon'] ?></td>
                                      <td align="center"><a type="button" class="btn modal_forminput" name="btn_update_menu" value="<?= $row['menuid'] ?>" title="Edit Data"><span class="btn bg-gradient-success feather icon-edit"></span></a></td>
                                      <td align="center">
                                        <a href="<?= base_url('master/menu/C_sub_menu/delete/'.$row['menuid']) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="btn bg-gradient-danger feather icon-trash-2"></span></a></td>
                                    </tr>
                                  <?php } 
                                } ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">DATA SUB MENU</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button type="button" class="btn bg-gradient-primary modal_forminput2" name="btn_add_submenu" value=""><span class="feather icon-edit-1"> Tambah Sub Menu</span></button></br></br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                              <thead>
                                <tr class="table-primary text-center">
                                  <th>No</th>
                                  <th>Sub Menu ID</th>
                                  <th>Sub Menu Nama</th>
                                  <th>Sub Menu Link</th>
                                  <th>Menu Nama</th>
                                  <th>Ubah</th>
                                  <th>Hapus</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if(!empty($query2)){ 
                                  $no2=0;
                                  foreach($query2->result_array() as $row2){
                                    $no2++; ?>
                                    <tr>
                                      <td align="center"><?= $no2;?></td>
                                      <td><?= $row2['submenuid'] ?></td>
                                      <td><?= $row2['submenunm'] ?></td>
                                      <td><?= $row2['submenulink'] ?></td>
                                      <td><?= $row2['menunm'] ?></td>
                                      <td align="center"><a type="button" class="btn modal_forminput2" name="btn_update_submenu" value="<?= $row2['submenuid'] ?>" title="Edit Data"><span class="btn bg-gradient-success feather icon-edit"></span></a></td>
                                      <td align="center"><a href="<?= base_url('master/menu/C_sub_menu/delete_sub/'.$row2['submenuid']) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="btn bg-gradient-danger feather icon-trash-2"></span></a></td>
                                    </tr>
                                  <?php } 
                                } ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">DATA SUB MENU 2</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button type="button" class="btn bg-gradient-primary modal_forminput3" name="btn_add_submenu2" value=""><span class="feather icon-edit-1"> Tambah Sub Menu 2</span></button></br></br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                              <thead>
                                <tr class="table-primary text-center">
                                  <th>No</th>
                                  <th>Sub Menu 2 ID</th>
                                  <th>Sub Menu 2 Nama</th>
                                  <th>Sub Menu 2 Link</th>
                                  <th>Sub Menu Nama</th>
                                  <th>Ubah</th>
                                  <th>Hapus</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if(!empty($query3)){ 
                                    $no3=0;
                                    foreach($query3->result_array() as $row3){
                                      $no3++; ?>
                                      <tr>
                                          <td align="center"><?= $no3;?></td>
                                          <td><?= $row3['submenu2id'] ?></td>
                                          <td><?= $row3['submenu2nm'] ?></td>
                                          <td><?= $row3['submenu2link'] ?></td>
                                          <td><?= $row3['submenunm'] ?></td>
                                          <td align="center"><a type="button" class="btn modal_forminput3" name="btn_update_submenu2" value="<?= $row3['submenu2id'] ?>" title="Edit Data"><span class="btn bg-gradient-success feather icon-edit"></span></a></td>
                                          <td align="center"><a href="<?= base_url('master/menu/C_sub_menu/delete_sub2/'.$row3['submenu2id']) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="btn bg-gradient-danger feather icon-trash-2"></span></a></td>
                                      </tr>
                                    <?php } 
                                  } ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">DATA SUB MENU 3</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button type="button" class="btn bg-gradient-primary modal_forminput4" name="btn_add_submenu3" value=""><span class="feather icon-edit-1"> Tambah Sub Menu 3</span></button></br></br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                              <thead>
                                <tr class="table-primary text-center">
                                  <th>No</th>
                                  <th>Sub Menu 3 ID</th>
                                  <th>Sub Menu 3 Nama</th>
                                  <th>Sub Menu 3 Link</th>
                                  <th>Sub Menu 2 Nama</th>
                                  <th>Ubah</th>
                                  <th>Hapus</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if(!empty($query4)){ 
                                  $no4=0;
                                  foreach($query4->result_array() as $row4){
                                    $no4++; ?>
                                    <tr>
                                        <td align="center"><?= $no4;?></td>
                                        <td><?= $row4['submenu3id'] ?></td>
                                        <td><?= $row4['submenu3nm'] ?></td>
                                        <td><?= $row4['submenu3link'] ?></td>
                                        <td><?= $row4['submenu2nm']; ?></td>
                                        <td align="center"><a type="button" class="btn modal_forminput4" name="btn_update_submenu3" value="<?= $row4['submenu3id'] ?>" title="Edit Data"><span class="btn bg-gradient-success feather icon-edit"></span></a></td>
                                        <td align="center"><a href="<?= base_url('master/menu/C_sub_menu/delete_sub3/'.$row4['submenu3id']) ?>" target="_self" title="Delete Data" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><span class="btn bg-gradient-danger feather icon-trash-2"></span>
                                          </a>
                                        </td>
                                    </tr>
                                  <?php } 
                                } ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ini_modal" tabindex="-1" role="dialog" aria-labelledby="modal_form" aria-hidden="true">
        <form action="" id="modal_form" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="hidden" name="mdl1_detail_id" id="mdl1_detail_id" class="form-control mdl1_detail_id">
                        <h4 class="modal-title" id="judul_modal"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Nama Menu</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl1_menunm" id="mdl1_menunm" class="form-control mdl1_menunm" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Menu Link</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl1_menulink" id="mdl1_menulink" class="form-control mdl1_menulink" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Menu Faicon</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl1_menufaicon" id="mdl1_menufaicon" class="form-control mdl1_menufaicon" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        <button type="button" class="btn bg-gradient-dark" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="ini_modal2" tabindex="-1" role="dialog" aria-labelledby="modal_form2" aria-hidden="true">
        <form action="" id="modal_form2" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="hidden" name="mdl2_detail_id" id="mdl2_detail_id" class="form-control mdl2_detail_id">
                        <h4 class="modal-title" id="judul_modal2"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Sub Menu Nama</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl2_submenunm" id="mdl2_submenunm" class="form-control mdl2_submenunm" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Sub Menu Link</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl2_submenulink" id="mdl2_submenulink" class="form-control mdl2_submenulink" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Menu</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="mdl2_menuid" id="mdl2_menuid" class="form-control mdl2_menuid" required>
                                            <option value="">- pilih -</option>
                                            <?php foreach($dtmenu as $rowdtmenu){ ?>
                                                <option value="<?php echo $rowdtmenu->menuid?>"><?php echo $rowdtmenu->menunm?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        <button type="button" class="btn bg-gradient-dark" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="ini_modal3" tabindex="-1" role="dialog" aria-labelledby="modal_form3" aria-hidden="true">
        <form action="" id="modal_form3" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="hidden" name="mdl3_detail_id" id="mdl3_detail_id" class="form-control mdl3_detail_id">
                        <h4 class="modal-title" id="judul_modal3"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Sub Menu 2 Nama</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl3_submenu2nm" id="mdl3_submenu2nm" class="form-control mdl3_submenu2nm" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Sub Menu 2 Link</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl3_submenu2link" id="mdl3_submenu2link" class="form-control mdl3_submenu2link" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Sub Menu</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="mdl3_submenuid" id="mdl3_submenuid" class="form-control mdl3_submenuid" required>
                                            <option value="">- pilih -</option>
                                            <?php foreach($dtsubmenu as $rowdtsubmenu){ ?>
                                                <option value="<?php echo $rowdtsubmenu->submenuid?>"><?php echo $rowdtsubmenu->submenunm?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        <button type="button" class="btn bg-gradient-dark" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="ini_modal4" tabindex="-1" role="dialog" aria-labelledby="modal_form4" aria-hidden="true">
        <form action="" id="modal_form4" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="hidden" name="mdl4_detail_id" id="mdl4_detail_id" class="form-control mdl4_detail_id">
                        <h4 class="modal-title" id="judul_modal4"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Sub Menu 3 Nama</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl4_submenu3nm" id="mdl4_submenu3nm" class="form-control mdl4_submenu3nm" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Sub Menu 3 Link</span>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="mdl4_submenu3link" id="mdl4_submenu3link" class="form-control mdl4_submenu3link" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Sub Menu 2</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="mdl4_submenu2id" id="mdl4_submenu2id" class="form-control mdl4_submenu2id" required>
                                            <option value="">- pilih -</option>
                                            <?php foreach($dtsubmenu2 as $rowdtsubmenu2){ ?>
                                                <option value="<?php echo $rowdtsubmenu2->submenu2id?>"><?php echo $rowdtsubmenu2->submenunm.' - '.$rowdtsubmenu2->submenu2nm?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        <button type="button" class="btn bg-gradient-dark" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section><!-- /.content -->

<?php $this->load->view('template/footbar'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.modal_forminput', function(){
            var detail_id = $(this).attr("value").trim();
            if($(this).attr("name")=='btn_update_menu' && detail_id!='' && confirm('Ubah data?')){
                $("#modal_form").attr("action", "<?= base_url('master/menu/C_sub_menu/form_modal_menu/update') ?>");
                $("#mdl1_detail_id").val(detail_id);
                $("#judul_modal").empty().append('Update Form Menu');

                $.ajax({
                    type :"post",
                    url : "<?php echo base_url();?>/master/menu/C_sub_menu/get_dt_update_menu",
                    data : "id=" + detail_id,
                    success : function(data){
                        $("#mdl1_menunm").val(data.trim().split('//')[0]);
                        $("#mdl1_menulink").val(data.trim().split('//')[1]);
                        $("#mdl1_menufaicon").val(data.trim().split('//')[2]);
                    }
                });

                $("#ini_modal").modal();
            }else if($(this).attr("name")=='btn_add_menu'){
                $("#modal_form").attr("action", "<?= base_url('master/menu/C_sub_menu/form_modal_menu/add') ?>");
                $("#mdl1_detail_id").val('');
                $("#judul_modal").empty().append('Tambah Form Menu');
                $("#mdl1_menunm").val('');
                $("#mdl1_menulink").val('');
                $("#mdl1_menufaicon").val('');
                $("#ini_modal").modal();                
            }
        });

        $(document).on('click', '.modal_forminput2', function(){
            var detail_id = $(this).attr("value").trim();
            if($(this).attr("name")=='btn_update_submenu' && detail_id!='' && confirm('Ubah data?')){
                $("#modal_form2").attr("action", "<?= base_url('master/menu/C_sub_menu/form_modal_submenu/update') ?>");
                $("#mdl2_detail_id").val(detail_id);
                $("#judul_modal2").empty().append('Update Form Sub Menu');

                $.ajax({
                    type :"post",
                    url : "<?php echo base_url();?>/master/menu/C_sub_menu/get_dt_update_submenu",
                    data : "id=" + detail_id,
                    success : function(data){
                        $("#mdl2_submenunm").val(data.trim().split('//')[0]);
                        $("#mdl2_submenulink").val(data.trim().split('//')[1]);
                        $("#mdl2_menuid").val(data.trim().split('//')[2]);
                    }
                });

                $("#ini_modal2").modal();
            }else if($(this).attr("name")=='btn_add_submenu'){
                $("#modal_form2").attr("action", "<?= base_url('master/menu/C_sub_menu/form_modal_submenu/add') ?>");
                $("#mdl2_detail_id").val('');
                $("#judul_modal2").empty().append('Tambah Form Sub Menu');
                $("#mdl2_submenunm").val('');
                $("#mdl2_submenulink").val('');
                $("#mdl2_menuid").val('');
                $("#ini_modal2").modal();                
            }
        });

        $(document).on('click', '.modal_forminput3', function(){
            var detail_id = $(this).attr("value").trim();
            if($(this).attr("name")=='btn_update_submenu2' && detail_id!='' && confirm('Ubah data?')){
                $("#modal_form3").attr("action", "<?= base_url('master/menu/C_sub_menu/form_modal_submenu2/update') ?>");
                $("#mdl3_detail_id").val(detail_id);
                $("#judul_modal3").empty().append('Update Form Sub Menu 2');

                $.ajax({
                    type :"post",
                    url : "<?php echo base_url();?>/master/menu/C_sub_menu/get_dt_update_submenu2",
                    data : "id=" + detail_id,
                    success : function(data){
                        $("#mdl3_submenu2nm").val(data.trim().split('//')[0]);
                        $("#mdl3_submenu2link").val(data.trim().split('//')[1]);
                        $("#mdl3_submenuid").val(data.trim().split('//')[2]);
                    }
                });

                $("#ini_modal3").modal();
            }else if($(this).attr("name")=='btn_add_submenu2'){
                $("#modal_form3").attr("action", "<?= base_url('master/menu/C_sub_menu/form_modal_submenu2/add') ?>");
                $("#mdl3_detail_id").val('');
                $("#judul_modal3").empty().append('Tambah Form Sub Menu 2');
                $("#mdl3_submenu2nm").val('');
                $("#mdl3_submenu2link").val('');
                $("#mdl3_submenuid").val('');
                $("#ini_modal3").modal();                
            }
        });

        $(document).on('click', '.modal_forminput4', function(){
            var detail_id = $(this).attr("value").trim();
            if($(this).attr("name")=='btn_update_submenu3' && detail_id!='' && confirm('Ubah data?')){
                $("#modal_form4").attr("action", "<?= base_url('master/menu/C_sub_menu/form_modal_submenu3/update') ?>");
                $("#mdl4_detail_id").val(detail_id);
                $("#judul_modal4").empty().append('Update Form Sub Menu 3');

                $.ajax({
                    type :"post",
                    url : "<?php echo base_url();?>/master/menu/C_sub_menu/get_dt_update_submenu3",
                    data : "id=" + detail_id,
                    success : function(data){
                        $("#mdl4_submenu3nm").val(data.trim().split('//')[0]);
                        $("#mdl4_submenu3link").val(data.trim().split('//')[1]);
                        $("#mdl4_submenu2id").val(data.trim().split('//')[2]);
                    }
                });

                $("#ini_modal4").modal();
            }else if($(this).attr("name")=='btn_add_submenu3'){
                $("#modal_form4").attr("action", "<?= base_url('master/menu/C_sub_menu/form_modal_submenu3/add') ?>");
                $("#mdl4_detail_id").val('');
                $("#judul_modal4").empty().append('Tambah Form Sub Menu 3');
                $("#mdl4_submenu3nm").val('');
                $("#mdl4_submenu3link").val('');
                $("#mdl4_submenu2id").val('');
                $("#ini_modal4").modal();                
            }
        });
    });
</script> 

<?php $this->load->view('template/footbarend'); ?>