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
                <div class="text-center mt-3 mb-3">
                    <h5 class="card-title">Filter Laporan <?= $Titel ?></h5>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <form action="<?php echo base_url('approval/C_approval_pengganti/openlap/show' ) ?>" id="form1"
                            name="form1" method="post" role="form" class="form-horizontal" autocomplete="off">

                            <div class="form-group row">
                                <div class="col-md-3"></div>
                                <div class="col-md-1"><strong>Kode Form</strong></div>
                                <div class="col-md-4">
                                    <select class="frm_kode form-control select2" name="frm_kode" id="frm_kode"
                                        required>
                                        <option value="">- pilih -</option>
                                        <?php if(isset($all_kode_form)){
                                            foreach($all_kode_form as $all_kode_form_row){ ?>
                                        <option value="<?php echo $all_kode_form_row['formkd'];?>"
                                            <?php if($all_kode_form_row['formkd']==$frm_kode){echo 'selected';}?>>
                                            <?php echo $all_kode_form_row['formnm'];?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3"></div>
                                <div class="col-md-1"><strong>Kode Versi</strong></div>
                                <div class="col-md-4">
                                    <select class="frm_versi form-control select2" name="frm_versi" id="frm_versi"
                                        required>
                                        <option value="">- pilih -</option>
                                        <?php if(isset($all_versi_form)){
                                          foreach($all_versi_form as $all_versi_form_row){ ?>
                                        <option value="<?php echo $all_versi_form_row['formversi'];?>"
                                            <?php if($all_versi_form_row['formversi']==$frm_versi){echo 'selected';}?>>
                                            <?php echo $all_versi_form_row['formversi'];?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3"></div>
                                <div class="col-md-1"><strong>Approval Sebagai</strong></div>
                                <div class="col-md-4">
                                    <select name="lvlapp" id="lvlapp" class="lvlapp form-control select2" required>
                                        <option value="">- pilih -</option>
                                        <?php if(isset($all_jmlapp)){ 
                                          foreach($all_jmlapp as $all_jmlapp_row){ ?>
                                        <option value="<?php echo $all_jmlapp_row['listapp'];?>"
                                            <?php if($all_jmlapp_row['listapp']==$lvlapp){echo 'selected';}?>>Approval
                                            <?php echo $all_jmlapp_row['listapp'];?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3"></div>
                                <div class="col-md-1"><strong>Periode</strong></div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" name="dtstart" id="dtstart"
                                            class="form-control datepicker dtstart maskdate" value="<?= $dtstart; ?>"
                                            style="text-align: center;" required>
                                        <span class="input-group-append"><strong>&emsp;S/D&emsp;</strong></span>
                                        <input type="text" name="dtfinish" id="dtfinish"
                                            class="form-control datepicker dtfinish maskdate" value="<?= $dtfinish; ?>"
                                            style="text-align: center;" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn bg-gradient-primary btn-block"
                                        id="btnsimpan">Tampil</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if($lvlapp!=null){ ?>
                <form
                    action="<?php echo base_url('approval/C_approval_pengganti/approved_all/' .$frm_kode.'/'.$frm_versi.'/'.$lvlapp) ?>"
                    target="_blank" id="form2" name="form2" method="post" role="form2" class="form-horizontal">
                    <div class="card-content mt-3 mb-1">
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if(isset($createtable)){echo $createtable;}?>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-4">
                                    <input type="hidden" name="redirect" value="<?= $this->uri->uri_string() ?>" />
                                    <input type="hidden" name="app_by" value="<?php echo $nmlengkap;?>" />
                                    <input type="hidden" name="app_date" value="<?php echo date('Y-m-d');?>" />
                                    <input type="hidden" name="app_position" value="app<?php echo $lvlapp;?>" />
                                    <input type="hidden" name="app_form" value="<?php echo $frm_kode;?>" />

                                    <input type="hidden" name="dtstart" value="<?php echo $dtstart;?>" />
                                    <input type="hidden" name="dtfinish" value="<?php echo $dtfinish;?>" />
                                    <input type="hidden" name="frm_kode" value="<?php echo $frm_kode;?>" />
                                    <input type="hidden" name="frm_versi" value="<?php echo $frm_versi;?>" />
                                    <input type="hidden" name="lvlapp" value="<?php echo $lvlapp;?>" />
                                    <?php if(!empty($createtable)){ ?>
                                    <button type="submit" class="btn bg-gradient-success col-lg-12" name="btn_appall"
                                        value="btn_appall" onclick="return confirm('Approve Semua Laporan?')">Approve
                                        All
                                        <?php echo rtrim(chunk_split(strtoupper($frm_kode), 3, '-'),'-').'-'.$frm_versi;?></button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</section>


<?php $this->load->view('template/footbar'); ?>

<!-- page script -->
<script type="text/javascript">
$(document).ready(function() {

    $('#frm_jenis').change(function() {
        $('#frm_kode').prop('selectedIndex', 0);
        var frm_jenis = $("#frm_jenis").val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url();?>index.php/approval/C_approval_pengganti/get_form_code",
            data: "formjnsnm=" + frm_jenis,
            success: function(data1) {
                $("#frm_kode").empty().html(data1);
            }
        });
    });

    $('#frm_kode').change(function() {
        $('#frm_versi').prop('selectedIndex', 0);
        var frm_kode = $("#frm_kode").val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url();?>index.php/approval/C_approval_pengganti/get_form_versi",
            data: "formkodenm=" + frm_kode,
            success: function(data2) {
                $('#frm_versi').empty().html(data2);
            }
        });
    });

    $('#frm_versi').change(function() {
        $('#lvlapp').prop('selectedIndex', 0);
        var frm_kode = $("#frm_kode").val();
        var frm_versi = $("#frm_versi").val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url();?>index.php/approval/C_approval_pengganti/get_form_jmlapp",
            data: {
                formkodenm: frm_kode,
                formversi: frm_versi
            },
            success: function(data3) {
                $('#lvlapp').empty().html(data3);
            }
        });
    });

});

function toggle(source) {
    var aInputs = document.getElementsByTagName('input');
    for (var i = 0; i < aInputs.length; i++) {
        if (aInputs[i] != source && aInputs[i].className == source.className) {
            aInputs[i].checked = source.checked;
        }
    }
}
</script>


<?php $this->load->view('template/footbarend'); ?>