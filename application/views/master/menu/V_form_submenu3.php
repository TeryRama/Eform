<?php $this->load->view('template/headbar'); ?>

<?php if ($aksi == 'aksi_add') {
    $submenu3id   = "";
    $submenu3kode = "";
    $submenu3nama = "";
    $submenu3link = "";
    $submenu2id   = "";
} else {
    foreach ($dtmenu as $rowmenu) {
        $submenu3id   = $rowmenu->submenu3id;
        $submenu3nama = $rowmenu->submenu3nm;
        $submenu3link = $rowmenu->submenu3link;
        $submenu2id   = $rowmenu->submenu2id;
    }
} ?>

<section class="content">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">FORM SUB MENU 3</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <?php $this->session->flashdata('pesan') ?>
                        <form action="<?php echo base_url('master/menu/C_sub_menu/form4/' . $aksi) ?>" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Sub Menu 3 Nama</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="hidden" class="form-control" id="submenu3id" placeholder="" value="<?php echo $submenu3id; ?>" name="submenu3id">
                                            <input type="text" class="form-control" id="submenu3nm" placeholder="Sub Menu 3 Nama" value="<?php echo $submenu3nama; ?>" name="submenu3nm">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Sub Menu 3 Link</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="submenu3link" placeholder="Sub Menu 3 Link" value="<?php echo $submenu3link; ?>" name="submenu3link">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Sub Menu 2</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="submenu2id" class="form-control">
                                                <option value="">- pilih -</option>
                                                <?php foreach($dtsubmenu2 as $rowdtsubmenu2){ ?>
                                                    <option value="<?php echo $rowdtsubmenu2->submenu2id?>" <?php if($submenu2id==$rowdtsubmenu2->submenu2id){echo'selected';}?>><?php echo $rowdtsubmenu2->submenunm.' - '.$rowdtsubmenu2->submenu2nm?></option>
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