<?php $this->load->view('template/headbar'); ?>

<?php if ($aksi == 'aksi_add') {
    $subid   = "";
    $subkode = "";
    $subnama = "";
    $sublink = "";
    $menuid  = "";
} else {
    foreach ($dtsubmenu as $rowmenu) {
        $subid   = $rowmenu->submenuid;
        $subnama = $rowmenu->submenunm;
        $sublink = $rowmenu->submenulink;
        $menuid  = $rowmenu->menuid;
    }
} ?>

<section class="content">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">FORM SUB MENU</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <?php $this->session->flashdata('pesan') ?>
                        <form action="<?php echo base_url('master/menu/C_sub_menu/form2/' . $aksi) ?>" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Sub Menu Nama</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="hidden" class="form-control" id="submenuid" placeholder="" value="<?php echo $subid; ?>" name="submenuid">
                                            <input type="text" class="form-control" id="submenunm" placeholder="Sub Menu Nama" value="<?php echo $subnama; ?>" name="submenunm">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Sub Menu Link</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="submenulink" placeholder="Sub Menu Link" value="<?php echo $sublink; ?>" name="submenulink">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Menu</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="menuid" class="form-control">
                                                <option value="">- pilih -</option>
                                                <?php foreach($dtmenu as $rowdtmenu){ ?>
                                                    <option value="<?php echo $rowdtmenu->menuid?>" <?php if($menuid==$rowdtmenu->menuid){echo'selected';}?>><?php echo $rowdtmenu->menunm?></option>
                                                <?php } ?>
                                            </select>
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