<?php $this->load->view('template/headbar'); ?>

<?php if(isset($dtuser)){
    foreach ($dtuser as $dtuserrow){
        $id         = $dtuserrow->userid;
        $dtusername = $dtuserrow->username;
        $dtpass     = $dtuserrow->password;
    }
} ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Username & Password</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <form action="<?php echo base_url('master/C_changepsw/change') ?>" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Username</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="hidden" class="form-control" id="dtuserid" placeholder="" value="<?php if(isset($message)){echo set_value('dtuserid');}else{echo $id;} ?>" name="dtuserid" >
                                            <input type="text" class="form-control" id="dtusername" placeholder="Username" value="<?php if(isset($message)){echo set_value('dtusername');}else{echo $dtusername;} ?>" name="dtusername" required>
                                            <input type="hidden" class="form-control" id="dtoldusername" value="<?php if(isset($message)){echo set_value('dtoldusername');}else{echo $dtusername;} ?>" name="dtoldusername">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Password</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="password" class="form-control" id="dtoldpass" placeholder="Passsword" value="<?php if(isset($message)){echo set_value('dtoldpass');}else{echo $dtpass;} ?>" name="dtoldpass" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>New Password</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="password" class="form-control" id="dtpass" placeholder="New Passsword" name="dtpass" value="<?php if(isset($message)){echo set_value('dtpass');}else{}?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary" name="btnSave">Simpan</button>
                                            <button type="button" onclick="location.href='<?php echo base_url('C_home') ?>'" class="btn btn-dark">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->

<?php $this->load->view('template/footbar'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('keyup', "input[type=text]", function () {
            $(this).val(function (_, val) {
                return val.toUpperCase();
            });
        });
    });
</script>

<?php $this->load->view('template/footbarend'); ?>
