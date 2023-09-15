<?php $this->load->view('template/headbar'); ?>

<?php if ($aksi == 'aksi_add') {
    $id       = "";
    $kode     = "";
    $mnnama   = "";
    $mnlink   = "";
    $mnfaicon = "";
} else {
    foreach ($dtmenu as $rowmenu) {
        $id       = $rowmenu->menuid;
        $mnnama   = $rowmenu->menunm;
        $mnlink   = $rowmenu->menulink;
        $mnfaicon = $rowmenu->menufaicon;
    }
} ?>

<section class="content">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">FORM MENU</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <?php $this->session->flashdata('pesan') ?>
                        <form action="<?php echo base_url('master/menu/C_sub_menu/form/' . $aksi) ?>" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Nama Menu</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="hidden" class="form-control" id="menuid" placeholder="" value="<?php echo $id; ?>" name="menuid">
                                            <input type="text" class="form-control" id="menunm" placeholder="Nama Menu" value="<?php echo $mnnama; ?>" name="menunm">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Menu Link</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="menulink" placeholder="Link Menu" value="<?php echo $mnlink; ?>" name="menulink">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Menu Faicon</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="menufaicon" placeholder="Menu Faicon" value="<?php echo $mnfaicon; ?>" name="menufaicon">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary" name="btnSave">Simpan</button>
                                            <button type="button" onclick="location.href='<?php echo base_url('master/menu/C_sub_menu') ?>'" class="btn btn-dark">Kembali</button>
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
<?php $this->load->view('template/footbarend'); ?>