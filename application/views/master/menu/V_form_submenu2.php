<?php $this->load->view('template/headbar'); ?>

<?php if ($aksi == 'aksi_add') {
    $submenu2id   = "";
    $submenu2kode = "";
    $submenu2nama = "";
    $submenu2link = "";
    $submenuid    ="";
} else {
    foreach ($dtmenu as $rowmenu) {
        $submenu2id   = $rowmenu->submenu2id;
        $submenu2nama = $rowmenu->submenu2nm;
        $submenu2link = $rowmenu->submenu2link;
        $submenuid    = $rowmenu->submenuid;
    }
} ?>

<section class="content">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">FORM SUB MENU 2</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <?php $this->session->flashdata('pesan') ?>
                        <form action="<?php echo base_url('master/menu/C_sub_menu/form3/' . $aksi) ?>" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Sub Menu 2 Nama</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="hidden" class="form-control" id="submenu2id" placeholder="" value="<?php echo $submenu2id; ?>" name="submenu2id">
                                            <input type="text" class="form-control" id="submenu2nm" placeholder="Sub Menu 2 Nama" value="<?php echo $submenu2nama; ?>" name="submenu2nm">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Sub Menu 2 Link</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="submenulink" placeholder="Sub Menu 2 Link" value="<?php echo $submenu2link; ?>" name="submenu2link">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Sub Menu</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="submenuid" class="form-control">
                                                <option value="">- pilih -</option>
                                                <?php foreach($dtsubmenu as $rowdtsubmenu){ ?>
                                                    <option value="<?php echo $rowdtsubmenu->submenuid?>" <?php if($submenuid==$rowdtsubmenu->submenuid){echo'selected';}?>><?php echo $rowdtsubmenu->submenunm?></option>
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